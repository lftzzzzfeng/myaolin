<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:01
 * 畅游瑶琳
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Trip extends MainController
{
    public $mainTemplatePath = 'main/trip/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '畅游瑶琳';
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function travel()
    {
        $content['pageTitle'] = '游在瑶琳 - 瑶琳国家森林公园';
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
}
