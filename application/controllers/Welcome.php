<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/29
 * Time: 10:05
 * 首页
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../util/Constant.php';
require_once dirname(__FILE__) . '/../util/WeatherForecast.php';
require_once dirname(__FILE__) . '/../util/CurlTool.php';

class Welcome extends MainController
{
    public $mainTemplatePath = 'main/welcome/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('websiteModel');
        $this->load->model('scenicAreaModel');
        $this->load->model('scenicViewModel');
        $this->load->model('newsModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '首页';
        $content['website'] = $this->websiteModel->getWebsiteById();
        $content['website']['backgroundImage'] = $this->baseUrl . 'ui/img/website/' . $content['website']['id'] . '.' . explode('.', $content['website']['backgroundImage'])[1] .'?' . time();
        $content['scenicAreaResult'] = $this->scenicAreaModel->getDetailScenicAreaById(null, \util\Constant::IS_RECOMMENDED_YES);
        $content['scenicViews'] = $this->scenicViewModel->getCertainNumberScenicViews(4);
        $content['news'] = $this->newsModel->getLatestNewsM(4);
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }

    public function aboutUs()
    {
        $this->content['pageTitle'] = '关于我们';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function contactUs()
    {
        $this->content['pageTitle'] = '联系我们';

        $this->content['pageTitle'] = '首页';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    //搜索
    public function search()
    {
        $this->content['pageTitle'] = '搜索列表';
        $search = $this->input->post('search');
        $content['search'] = $this->websiteModel->search($search);
//        var_dump($content);
//        die;
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }
}
