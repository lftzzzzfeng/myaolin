<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:22
 * 瑶琳资讯
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
        $content['news'] = $this->newsModel->getNewsM($currentPageNumber, null, 8);
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }

    public function detail()
    {
        $id = $this->input->get('id');
        $content['pageTitle'] = '资讯详情 - 瑶琳国家森林公园';
        $content['item'] = $this->newsModel->getNewsById($id);
        $content['item']['UpDown'] = $this->newsModel->getNewsUpM($content['item']['orderNumber']);
        $content['item']['coverImage'] = $this->baseUrl . 'ui/img/news/' .  $content['item']['id'] . '.' . explode('.', $content['item']['coverImage'])[1] .'?' . time();
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
    
    //景区咨询加载更多
    public function ajaxNews()
    {
        $p = $this->input->get('p');
        $news = $this->newsModel->getNewsM($p,'',4);
        $html = '';
        foreach ($news['news'] as $k => $v){ 
            $html .= '<div class="zx_left zx_right jing_a" style="padding-right:10px;padding-bottom:5px;"><a href="'. base_url().'news/detail?id='.$v['id'].'"><img src="'.$v['coverImage'].'" style="height:160px;" /></a><a href="'. base_url().'news/detail?id='.$v['id'].'"><p class="zx_p">'.$v['title'].'<br/>'.$v['description'].'</p></a><div class="zx_bot"><div class="zx_botleft"><p class="l_p">'.date('Y-m-d',$v['publishedTimestamp']).'</p><p class="l_p"><img src="'.base_url().'ui/img/mobile/eye.png" />'.$v['hits'].'人浏览</p></div><div class="zx_botleft zx_botright"><a href="'. base_url().'news/detail?id='.$v['id'].'">了解详情</a></div></div></div>';
        } 
        echo $html;
    }
}
