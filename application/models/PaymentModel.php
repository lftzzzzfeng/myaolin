<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/21
 * Time: 16:47
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class PaymentModel extends CI_Model
{
    const TABLE_PAYMENT = 'payment';

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
     * 存储付款
     *
     * @param string $orderId 订单号
     * @param string $openId 微信openId
     * @param string $merchantId 商户id
     * @param int $totalFee 订单价格
     * @param string $transactionId 微信订单号
     * @param string $bankType
     * @param string $responseData
     * @param int $status 状态
     *
     * @return int
     */
    public function savePayment($orderId, $openId, $merchantId, $totalFee, $transactionId = null, $bankType = null, $responseData = null, $status = 2)
    {
        $data = [];

        if ($this->isExistByOrderId($orderId)) {
            $savedId = $openId;

            if ($transactionId) {
                $data['transactionId'] = $transactionId;
            }
            if ($openId) {
                $data['openId'] = $openId;
            }
            if ($merchantId) {
                $data['merchantId'] = $merchantId;
            }
            if ($totalFee) {
                $data['totalFee'] = $totalFee;
            }
            if ($totalFee) {
                $data['bankType'] = $bankType;
            }
            if ($responseData) {
                $data['responseData'] = $responseData;
            }
            if ($status) {
                $data['status'] = $status;
            }

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('orderId', $orderId);
            $this->db->update(self::TABLE_PAYMENT, $data);
        } else {
            $data['orderId'] = $orderId;
            if ($transactionId) {
                $data['transactionId'] = $transactionId;
            }
            $data['openId'] = $openId;
            $data['merchantId'] = $merchantId;
            $data['totalFee'] = $totalFee;
            if ($bankType) {
                $data['bankType'] = $bankType;
            }
            if ($responseData) {
                $data['responseData'] = $responseData;
            }
            $data['status'] = self::STATUS_PENDING;

            $data['creatorId'] = $openId;
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_PAYMENT, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 获取付款通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getPaymentById($id)
    {
        $select = '';
        $select .= 'payment.id AS paymentId, payment.orderId, payment.openId, member.username AS nickName,';
        $select .= 'payment.merchantId, merchantdetail.name AS merchantName, payment.totalFee, payment.bankType,';
        $select .= '(CASE payment.status WHEN 1 THEN "成功" WHEN 2 THEN "待处理" WHEN 3 THEN "取消" WHEN 4 THEN "失败" ELSE "" END) AS status';
        return $this->db->select($select)
            ->join('member', 'member.uid = payment.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = payment.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where(['id' => $id])->get(self::TABLE_PAYMENT)->row_array();
    }

    /**
     * 获取付款通过orderId
     *
     * @param int $orderId
     *
     * @return array
     */
    public function getPaymentByOrderId($orderId)
    {
        return $this->db->select('id, status')->where(['orderId' => $orderId])->get(self::TABLE_PAYMENT)->row_array();
    }

    /**
     * 微信回调后，更改付款信息
     *
     * @param int $id
     * @param string $transactionId
     * @param string $bankType
     * @param string $responseData
     * @param int $status
     *
     * @return boolean
     */
    public function updateWxPayment($id, $status, $transactionId = null, $bankType = null, $responseData = null)
    {
        if ($transactionId) {
            $data['transactionId'] = $transactionId;
        }
        if ($bankType) {
            $data['bankType'] = $bankType;
        }
        if ($responseData) {
            $data['responseData'] = $responseData;
        }
        $data['status'] = $status;

        $this->db->where('id', intval($id));
        $this->db->update(self::TABLE_PAYMENT, $data);
    }

    /**
     * @param $orderId
     *
     * @return boolean
     */
    public function isExistByOrderId($orderId)
    {
        $condition = [];

        $condition['orderId'] = $orderId;
        $condition['isDeleted'] = \util\Constant::IS_DELETED_NO;

        if ($this->db->select('id')->where($condition)->get(self::TABLE_PAYMENT)->row()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取付款列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getPayments($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`payment.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND ((`payment`.`orderId` LIKE "%' . $keyword . '%" OR `member`.`username` LIKE "%' . $keyword . '%"';
            $condition .= ' OR `payment`.`transactionId` LIKE "%' . $keyword . '%" OR `merchantdetail`.`name` LIKE "%' . $keyword . '%"';
            $condition .= '))';
        }

        $result['count'] = count($this->db->select('payment.id')
            ->join('member', 'member.uid = payment.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = payment.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where($condition)->get(self::TABLE_PAYMENT)->result_array());

        $select = '';
        $select .= 'payment.id AS paymentId, payment.orderId, payment.openId, member.username AS nickName,';
        $select .= 'payment.merchantId, merchantdetail.name AS merchantName, payment.totalFee, payment.bankType,';
        $select .= '(CASE payment.status WHEN 1 THEN "成功" WHEN 2 THEN "待处理" WHEN 3 THEN "取消" WHEN 4 THEN "失败" ELSE "" END) AS status';

        $result['payments'] = $this->db
            ->select($select)
            ->join('member', 'member.uid = payment.openId AND member.sourceType = 2', 'LEFT')
            ->join('merchant', 'merchant.id = payment.merchantId', 'LEFT')
            ->join('merchantdetail', 'merchantdetail.merchantId = merchant.id', 'LEFT')
            ->where($condition)->order_by('payment.id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_PAYMENT)->result_array();

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
