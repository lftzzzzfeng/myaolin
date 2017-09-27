<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/9 0009
 * Time: 16:57
 */
include dirname(__FILE__) . '/../../util/Encryption.php';
include dirname(__FILE__) . '/../../util/Constant.php';
class Login extends CI_Controller
{
    public $publicViewPath = 'admin/login/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administratorModel');
        $this->load->helper('url');

        if (isset($_SESSION['user']) && (!empty($_SESSION['user'])) && $this->administratorModel->existAdministrator($_SESSION['user']['username'])) {
            redirect(base_url() . 'admin/home');
        }
    }

    public function index()
    {
        redirect(\util\Constant::PC_DOMAIN);
        
        $data = [];
        $data['username'] = '';
        $data['responseCode'] = 1;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');

            if (!$this->administratorModel->login($data['username'], $data['password'])) {
                $data['responseCode'] = 2;
            } else {
                redirect(base_url() . 'admin/home');
            }
        }

        $this->load->view($this->publicViewPath . 'index', $data);
    }
}
