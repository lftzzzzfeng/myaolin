<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:01
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
        $this->content['pageTitle'] = '游在瑶琳';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function routes()
    {
        $this->content['pageTitle'] = '行在瑶琳';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }
}
