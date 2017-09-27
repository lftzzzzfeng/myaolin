<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/17
 * Time: 14:24
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class FoodModel extends CI_Model
{
    const TABLE_FOOD = 'food';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储吃在姚琳
     *
     * @param int $id
     * @param string $title 标题
     * @param string $coverImage 封面照片
     * @param string $description 描述
     * @param string $content 内容
     * @param int $isRecommended 是否推荐
     * @param int $status 状态
     *
     * @return int
     */
    public function saveFood($id, $title, $coverImage, $description, $content, $isRecommended, $status)
    {
        $data = [];

        if ($id) {
            $food = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_FOOD)->row_array();
            if (!$food) {
                echo '非法参数';
                exit;
            }
        }

        $data['title'] = $title;
        if ($coverImage) {
            $data['coverImage'] = $coverImage;
        }
        if ($description) {
            $data['description'] = $description;
        }
        if ($content) {
            $data['content'] = $content;
        }
        $data['isRecommended'] = $isRecommended;
        $data['status'] = $status;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_FOOD, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_FOOD, $data);
            $savedId = $this->db->insert_id();

            if ($savedId) {
                $this->db->set('orderNumber', $savedId);
                $this->db->where('id', intval($savedId));
                $this->db->update(self::TABLE_FOOD);
            }
        }

        return $savedId;
    }

    /**
     * 获取吃在瑶琳通过id
     *
     * @param int $id
     *
     * @return array
     */
        public function getFoodById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_FOOD)->row_array();
    }

    /**
     * 获取吃在瑶琳列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getFood($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
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

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_FOOD)->result_array());
        $result['food'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_FOOD)->result_array();

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
     * 移动端
     * 获取吃在瑶琳列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getFoodM($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_FOOD)->result_array());
        $result['food'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_FOOD)->result_array();
        foreach($result['food'] as $k => &$v){
            $v['coverImage'] = $this->baseUrl . 'ui/img/food/' . $v['id']
                . '.' . explode('.', $v['coverImage'])[1] .'?' . time();
        }
        if ($result['count'] > 0) {
            if ($result['count'] % $pageNumber == 0) {
                $result['totalPageNumber'] = $result['count'] / $pageNumber;
            } else {
                $result['totalPageNumber'] = intval($result['count'] / $pageNumber) + 1;
            }
        }

        return $result;
    }
}
