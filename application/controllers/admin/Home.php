<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/9
 * Time: 15:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include dirname(__FILE__) . '/../../util/QRCodeTool.php';

class Home extends AdminController
{
    public $publicViewPath = 'admin/home/';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
//        \util\QRCodeTool::generateQRCode('http://www.baidu.com', 'feng.png', 'tiger.jpg');

        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'index');
        $this->load->view($this->adminTemplateFooterPath);
    }

    public function logout()
    {
        $_SESSION = [];
        redirect(base_url() . 'admin/login');
    }
}
