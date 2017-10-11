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
        $content['weather'] = $this->websiteModel->weather();
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }

    public function aboutUs()
    {
        $this->content['pageTitle'] = '关于我们';
        $content['weather'] = $this->websiteModel->weather();
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }

    public function contactUs()
    {
        $this->content['pageTitle'] = '联系我们';
        $content['weather'] = $this->websiteModel->weather();
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }

    //搜索
    public function search()
    {
        $content['pageTitle'] = '搜索列表 - 瑶琳国家森林公园';
        $content['keyword'] = $this->input->post('search');
        $content['search'] = $this->websiteModel->searchs($content['keyword'],4);
        $content['num'] = $this->websiteModel->searchs($content['keyword'],4,1);
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }

    //搜索列表景区咨询加载更多
    public function ajaxnews()
    {
        $p = $this->input->get('p');
        $key = $this->input->get('key');
        $content = $this->websiteModel->searchs($key,2,$p);
        $data = $this->websiteModel->searchs($key,2,($p+1));
        if($data['news']){
            $num = 1;
        }else{
            $num = 2;
        }
        $html = '';
        foreach ($content['news'] as $k => $v){
            $html .= '<div class="zx_left jing_a" style="padding-bottom:5px;padding-top:5px;"><a href="'.base_url().'news/detail?id='.$v['id'].'"><img src="'.$v['coverImage'].'"/></a><a href="'.base_url().'news/detail?id="'.$v['id'].'"><p class="zx_p">'.$v['title'].'<br/>'.$v['description'].'</p></a><div class="zx_bot"><div class="zx_botleft"><p class="l_p">'.date('Y-m-d',$v['publishedTimestamp']).'</p><p class="l_p"><img src="'.base_url().'ui/img/mobile/eye.png" />'.$v['hits'].'人浏览</p></div><div class="zx_botleft zx_botright"><a href="'.base_url().'news/detail?id='.$v['id'].'">了解详情</a></div></div></div>';
        }
        $rst['html'] = $html;
        $rst['num'] = $num;
        echo json_encode($rst);
    }

    //搜索列表景区咨询加载更多
    public function ajaxScenic()
    {
        $p = $this->input->get('p');
        $key = $this->input->get('key');
        $content = $this->websiteModel->searchs($key,2,$p);
        $data = $this->websiteModel->searchs($key,2,($p+1));
        if($data['scenicview']){
            $num = 1;
        }else{
            $num = 2;
        }
        $html = '';
        foreach ($content['scenicview'] as $k => $v){
            $html .= '<div class="nature_box bg-white padding-15 clearfix" style="margin-top: 5px;"><h4>'.$v['title'].'</h4><p class="margin-bottom-15" style="color: #333;">'.$v['description'].'</p><div class="my-simple-gallery clearfix img_box" itemscope itemtype="http://schema.org/ImageGallery"><figure class="img-1  col-xs-6" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v['coverImage'].'" itemprop="contentUrl" data-size="1024x1024"><img src="'.$v['coverImage'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
	        foreach ($v['img'] as $k1 => $v1){
                if($k1 == 0){
                    $html .= '<figure class="img-2  col-xs-3" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="964x1024"><img src="'.$v1['image'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                }else if($k1 == 1){
                    $html .= '<figure class="img-3  col-xs-3" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="964x1024"><img src="'.$v1['image'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                }else{
                    $html .= '<figure class="img-4  col-xs-6" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="964x1024"><img src="'.$v1['image'] .'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                }
            }
            $html .= '</div></div>';
        }

        $rst['html'] = $html;
        $rst['num'] = $num;
        echo json_encode($rst);
    }

    //瑶琳地图
    public function map()
    {
        $content['pageTitle'] = '地图 - 瑶琳国家森林公园';
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }
}
