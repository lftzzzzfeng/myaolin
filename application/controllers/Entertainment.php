<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Entertainment extends MainController
{
    public $mainTemplatePath = 'main/entertainment/';

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '娱在瑶琳';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }
}