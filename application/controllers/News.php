<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:22
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MainController
{
    public $mainTemplatePath = 'main/news/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('newsModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($currentPageNumber = null)
    {
        $this->content['pageTitle'] = '瑶琳资讯';

        $content['currentPageNumber'] = $currentPageNumber ? $currentPageNumber : 1;
        $content['news'] = $this->newsModel->getNews($currentPageNumber, null, 8);

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }

    public function detail($id)
    {
        $content['item'] = $this->newsModel->getNewsById($id);

        $this->content['pageTitle'] = $content['item']['title'];

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }
}
