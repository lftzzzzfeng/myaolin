<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/14
 * Time: 10:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends MainController
{
    public $mainTemplatePath = 'main/merchant/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('merchantModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '商户中心';

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method());
    }

    public function agreement()
    {
        $this->content['pageTitle'] = '声明';

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method());
    }

    public function detail()
    {
        $this->content['pageTitle'] = '商户资料';

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method());
    }

    public function order()
    {
        $this->content['pageTitle'] = '商户订单';

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function signUp()
    {
        $result = ['code' => 0, 'message' => '', 'content' => []];

        $this->content['pageTitle'] = '商户注册';
        $result['content']['username'] = '';
        $result['content']['password'] = '';
        $result['content']['type'] = '';

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result['content']['username'] = $this->input->post('username');
            $result['content']['password'] = $this->input->post('password');
            $result['content']['type'] = $this->input->post('type');

            if ($this->merchantModel->existUsername($result['content']['username'])) {
                $result = ['code' => 1, 'message' => '此商户名已存在'];
            }

            $savedMerchantId = $this->merchantModel->saveMerchant($result['content']['username'], $result['content']['password'], $result['content']['type']);

            if ($savedMerchantId > 0) {
                $result = ['code' => -1, 'message' => '注册成功, 即将跳转至登陆页面'];
            } else {
                $result = ['code' => 1, 'message' => '注册失败'];
            }
        }

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $result);
    }

    public function login()
    {
        $result = ['code' => 0, 'message' => '', 'content' => []];

        $this->content['pageTitle'] = '商户登陆';
        $result['content']['username'] = '';

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result['content']['username'] = $this->input->post('username');
            $result['content']['password'] = $this->input->post('password');

        }

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method());
    }
}
