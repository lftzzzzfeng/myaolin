<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/31
 * Time: 17:00
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends MainController
{
    public $mainTemplatePath = 'main/routes/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }
}