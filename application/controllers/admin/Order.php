<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/11
 * Time: 14:41
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends AdminController
{
    public $publicViewPath = 'admin/order/';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'index');
        $this->load->view($this->adminTemplateFooterPath);
    }

    public function edit()
    {
        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        $content['id'] = $this->input->get('id');

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
