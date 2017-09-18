<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 10:43
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends MainController
{
    public $mainTemplatePath = 'main/food/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('foodModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($currentPageNumber = null)
    {
        $this->content['pageTitle'] = '吃在瑶琳';

        $content['currentPageNumber'] = $currentPageNumber ? $currentPageNumber : 1;
        $content['food'] = $this->foodModel->getFood($currentPageNumber, null, 8);

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }

    public function detail($id)
    {
        $content['item'] = $this->foodModel->getFoodById($id);

        $this->content['pageTitle'] = $content['item']['title'];

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }
}
