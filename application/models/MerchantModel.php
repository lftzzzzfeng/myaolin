<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/16
 * Time: 11:38
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class MerchantModel extends CI_Model
{
    const TABLE_MERCHANT = 'merchant';

    const TYPE_INDIVIDUAL = 1;
    const TYPE_COMPANY = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储商户
     *
     * @param string $username
     * @param string $password
     * @param int $type
     *
     * @return int
     */
    public function saveMerchant($username, $password, $type)
    {
        $data = [];

        $data['username'] = $username;
        $data['password'] = md5($password);
        $data['type'] = $type;
        //$_SESSION['merchant']['id']
        $data['creatorId'] = 2;
        $data['createdTimestamp'] = time();
        $data['status'] = \util\Constant::STATUS_UNACTIVATED;

        $this->db->insert(self::TABLE_MERCHANT, $data);
        return $this->db->insert_id();
    }

    /**
     * 商户登陆
     *
     * @param string $username
     * @param string $password
     *
     * @return boolean
     */
    public function login($username, $password)
    {
        $condition = [
            'username' => $username,
            'password' => md5($password)
        ];

        $merchant = $this->db->select('id, username, type')->where($condition)->get(self::TABLE_MERCHANT)->result_array();
//var_dump($merchant);
//exit;
        if ($merchant) {
            $_SESSION['merchant'] = [
                'id' => $merchant[0]['id'],
                'username' => $merchant[0]['username'],
                'type' => $merchant[0]['type']
            ];
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否存在此商户名
     *
     * @param string $username
     *
     * @return boolean
     */
    public function existUsername($username)
    {
//        $condition = '`status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition = ' `isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `username` = "' . $username . '"';

        if ($this->db->select('id')->where($condition)->get(self::TABLE_MERCHANT)->row()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否可以显示
     *
     * @param $merchantId 商户id
     *
     * @return bool
     */
    public function checkPermission($merchantId)
    {
        $condition = '`status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition .= ' AND `isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `id` = ' . $merchantId . '';

        if ($this->db->select('id')->where($condition)->get(self::TABLE_MERCHANT)->row()) {
            return true;
        } else {
            return false;
        }
    }
}
