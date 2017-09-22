<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:06
 * 购在瑶琳
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends MainController
{
    public $mainTemplatePath = 'main/shopping/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $content['pageTitle'] = '购在瑶琳 - 瑶琳国家森林公园';
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
}