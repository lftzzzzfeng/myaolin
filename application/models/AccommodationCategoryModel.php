<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/1
 * Time: 11:33
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class AccommodationCategoryModel extends CI_Model
{
    const TABLE_ACCOMMODATION_CATEGORY = 'accommodationcategory';
    const TABLE_ACCOMMODATION_IMAGE = 'accommodationimage';
    const TABLE_ACCOMMODATION = 'accommodation';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储住在瑶琳类别
     *
     * @param int $id
     * @param string $title 标题
     * @param string $description 描述
     * @param int $status 状态
     *
     * @return int
     */
    public function saveAccommodationCategory($id, $title, $description, $status)
    {
        $data = [];

        if ($id) {
            $accommodationCategory = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_ACCOMMODATION_CATEGORY)->row_array();
            if (!$accommodationCategory) {
                echo '非法参数';
                exit;
            }
        }

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
            $this->db->update(self::TABLE_ACCOMMODATION_CATEGORY, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_ACCOMMODATION_CATEGORY, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 获取住在瑶琳类别通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getAccommodationCategoryById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_ACCOMMODATION_CATEGORY)->row_array();
    }

    /**
     * 获取住在瑶琳类别列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getAccommodationCategories($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_ACCOMMODATION_CATEGORY)->result_array());
        $result['accommodationCategories'] = $this->db->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_ACCOMMODATION_CATEGORY)->result_array();

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
     * 获取住在瑶琳类别选项
     *
     * @return array
     */
    public function getAccommodationCategoriesSelection()
    {
        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;

        return $this->db->select('id, title, description')->where($condition)->order_by('id DESC')->get(self::TABLE_ACCOMMODATION_CATEGORY)->result_array();
    }

    /**
     * 获取所有住在瑶琳类别详细信息
     *
     * @return array
     */
    public function getAllAccommodationCategoriesDetail() {
        $accommodationCategories = $this->getAccommodationCategoriesSelection();

        if (count($accommodationCategories) > 0) {
            foreach ($accommodationCategories as &$accommodationCategory) {
                $images = $this->accommodationCategoryImageModel->getAccommodationCategoryImages($accommodationCategory['id']);
                $accommodationCategory['images'] = [];

                if (count($images) > 0) {
                    foreach ($images as $image) {
                        $element = [];
                        $element['id'] = $image['id'];
                        $element['title'] = $image['text'];
                        $element['image'] = $this->baseUrl . 'ui/img/accommodation/category/' . $accommodationCategory['id'] . '_' .$image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();

                        array_push($accommodationCategory['images'], $element);
                    }
                }

                $accommodationCategory['items'] = $this->accommodationModel->getAccommodationsDetailByAccommodationCategoryId($accommodationCategory['id']);
            }
        }

        return $accommodationCategories;
    }
    
    /**
     * 获取住在瑶琳详细信息
     *
     * @return array
     */
    public function getAccommodationInfo($id) {
        $condition = [];
        $condition['id'] = $id;
        $condition1['accommodationId'] = $id;
        $accommodation = $this->db->where($condition)->get(self::TABLE_ACCOMMODATION)->row_array();
        $accommodationimg = $this->db->where($condition1)->get(self::TABLE_ACCOMMODATION_IMAGE)->result_array();
        foreach ($accommodationimg as $k => $v){
            $accommodation['img'][] = $this->baseUrl . 'ui/img/accommodation/' . $id . '_' .$v['id'] . '.' . explode('.', $v['image'])[1] . '?' . time();
        }
        return $accommodation;
    }
}
