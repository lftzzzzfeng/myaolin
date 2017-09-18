<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/1
 * Time: 15:40
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class AccommodationModel extends CI_Model
{
    const TABLE_ACCOMMODATION = 'accommodation';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储住在瑶琳
     *
     * @param int $id
     * @param int $accommodationCategoryId
     * @param string $title 标题
     * @param string $description 描述
     * @param int $status 状态
     *
     * @return int
     */
    public function saveAccommodation($id, $accommodationCategoryId, $title, $description, $status)
    {
        $data = [];

        if ($id) {
            $accommodation = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_ACCOMMODATION)->row_array();
            if (!$accommodation) {
                echo '非法参数';
                exit;
            }
        }

        $data['accommodationCategoryId'] = $accommodationCategoryId;
        $data['title'] = $title;
        if ($description) {
            $data['description'] = $description;
        }
        $data['status'] = $status;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_ACCOMMODATION, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_ACCOMMODATION, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 获取住在瑶琳通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getAccommodationById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_ACCOMMODATION)->row_array();
    }

    /**
     * 获取住在瑶琳列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getAccommodations($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`accommodation.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `accommodation.status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`accommodation.title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_ACCOMMODATION)->result_array());
        $result['accommodations'] = $this->db->select('accommodation.id, accommodationCategory.title as category, accommodation.title, accommodation.description, accommodation.status')->where($condition)->order_by('id DESC')
            ->join('accommodationCategory', 'accommodationCategory.id = accommodation.accommodationCategoryId', 'LEFT')
            ->limit($pageNumber, $start)->get(self::TABLE_ACCOMMODATION)->result_array();

        if ($result['count'] > 0) {
            if ($result['count'] % $pageNumber == 0) {
                $result['totalPageNumber'] = $result['count'] / $pageNumber;
            } else {
                $result['totalPageNumber'] = intval($result['count'] / $pageNumber) + 1;
            }
        }

        return $result;
    }

    /**
     * 获取住在瑶琳通过类别id
     *
     * @param int $accommodationCategoryId
     *
     * @return array
     */
    public function getAccommodationsDetailByAccommodationCategoryId($accommodationCategoryId)
    {
        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition .= ' AND `accommodationCategoryId` = ' . $accommodationCategoryId;

        $accommodations = $this->db->select('id, accommodationCategoryId, title, description')->where($condition)->get(self::TABLE_ACCOMMODATION)->result_array();

        if (count($accommodations) > 0) {
            foreach ($accommodations as &$accommodation) {
                $images = $this->accommodationImageModel->getAccommodationImages($accommodation['id']);
                $accommodation['images'] = [];

                if (count($images) > 0) {
                    foreach ($images as $image) {
                        $element = [];
                        $element['image'] = base_url() . 'ui/img/accommodation/' . $accommodation['id'] . '_' .$image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();

                        array_push($accommodation['images'], $element);
                    }
                }
            }
        }

        return $accommodations;
    }
}
