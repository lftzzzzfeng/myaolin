<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/10
 * Time: 16:27
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class AdministratorModel extends CI_Model
{
    const TABLE_ADMINISTRATOR = 'administrator';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 登陆
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

        $administrator = $this->db->select('id, username')->where($condition)->get(self::TABLE_ADMINISTRATOR)->result_array();

        if ($administrator) {
            $_SESSION['user'] = [
                'id' => $administrator[0]['id'],
                'username' => $administrator[0]['username']
            ];
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检查该管理员是否存在
     *
     * @param string $username
     *
     * @return boolean
     */
    public function existAdministrator($username)
    {
        $condition = [
            'username' => $username
        ];

        $administrator = $this->db->select('id, username')->where($condition)->get(self::TABLE_ADMINISTRATOR)->result_array();

        if ($administrator) {
            return true;
        } else {
            return false;
        }
    }
}
