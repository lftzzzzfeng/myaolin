<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/21
 * Time: 17:58
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class ProductModel extends CI_Model
{
    const TABLE_PRODUCT = 'product';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储产品
     *
     * @param int $id
     * @param string $name 标题
     * @param string $description 描述
     * @param string $coverImage 封面照片
     * @param int $originalUnitPrice 原始单价
     * @param int $status 状态
     *
     * @return int
     */
    public function saveProduct($id, $name, $description, $coverImage, $originalUnitPrice, $status)
    {
        $data = [];

        $data['name'] = $name;
        $data['description'] = $description;
        if ($coverImage) {
            $data['coverImage'] = $coverImage;
        }
        $data['originalUnitPrice'] = $originalUnitPrice * 100;
        $data['status'] = $status;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_PRODUCT, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_PRODUCT, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 获取产品通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getProductById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_PRODUCT)->row_array();
    }

    /**
     * 获取产品列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getProducts($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
//        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`name` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_PRODUCT)->result_array());
        $result['products'] = $this->db->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_PRODUCT)->result_array();

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
