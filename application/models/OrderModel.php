<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/21
 * Time: 15:17
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class OrderModel extends CI_Model
{
    const TABLE_ORDER = 'order';

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 2;
    const STATUS_CANCEL = 3;
    const STATUS_FAIL = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储订单
     *
     * @param int $id
     * @param string $orderId 订单号
     * @param string $openId 微信openId
     * @param string $merchantId 商户id
     * @param int $productId 商品id
     * @param int $purchaseQuantity 购买数量
     * @param int $productUnitPrice 商品单价
     * @param int $totalFee 订单价格
     * @param int $status 状态
     *
     * @return int
     */
    public function saveOrder($id, $orderId, $openId, $merchantId, $productId, $purchaseQuantity, $productUnitPrice, $totalFee, $status = 2)
    {
        $data = [];

        $data['orderId'] = $orderId;
        $data['openId'] = $openId;
        $data['merchantId'] = $merchantId;
        $data['productId'] = $productId;
        $data['purchaseQuantity'] = $purchaseQuantity;
        $data['productUnitPrice'] = $productUnitPrice;
        $data['totalFee'] = $totalFee;
        $data['status'] = $status;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_ORDER, $data);
        } else {
            $data['creatorId'] = $openId;
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_ORDER, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 更改订单状态
     *
     * @param int $id
     * @param int $status
     *
     * @return boolean
     */
    public function updateOrderStatus($id, $status)
    {
        $data['status'] = $status;

        $this->db->where('id', intval($id));
        $this->db->update(self::TABLE_ORDER, $data);
    }

    /**
     * 获取订单通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getOrderById($id)
    {
        return $this->db->select('order.id, order.orderId, member.username, merchantdetail.name, order.totalFee')
            ->join('member', 'member.uid = order.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = order.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where(['id' => $id])->get(self::TABLE_ORDER)->row_array();
    }

    /**
     * 获取订单通过orderId
     *
     * @param int $orderId
     *
     * @return array
     */
    public function getOrderByOrderId($orderId)
    {
        return $this->db->select('order.id, order.orderId, member.username, merchantdetail.name, order.totalFee, order.status')
            ->join('member', 'member.uid = order.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = order.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where(['order.orderId' => $orderId])->get(self::TABLE_ORDER)->row_array();
    }

    /**
     * 获取订单列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getOrders($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`order.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND ((`order`.`orderId` LIKE "%' . $keyword . '%" OR `member`.`username` LIKE "%' . $keyword . '%"))';
        }

        $result['count'] = count($this->db->select('order.id')
            ->join('member', 'member.uid = order.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = order.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where($condition)->get(self::TABLE_ORDER)->result_array());
        $result['orders'] = $this->db
            ->select('order.id, order.orderId, member.username, merchantdetail.name, order.totalFee')
            ->join('member', 'member.uid = order.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = order.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where($condition)->order_by('order.id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_ORDER)->result_array();

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
