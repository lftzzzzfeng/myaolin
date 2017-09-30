<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/31
 * Time: 9:17
 * 景区相册
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicArea extends MainController
{
    public $mainTemplatePath = 'main/scenicarea/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicAreaModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '景区相册';
        $content = $this->scenicAreaModel->getScenicAreasM('','',8);
        $data = $this->scenicAreaModel->getScenicAreasM(3,'',4);
        if($data['scenicAreas']){
            $content['num'] = 1;
        }else{
            $content['num'] = 2;
        }
        $content['weather'] = $this->scenicAreaModel->weather();
//        var_dump($content);
//        die;
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }
    
    //景区相册加载更多
    public function ajaxScenic()
    {
        $p = $this->input->get('p');
        $scenicviews = $this->scenicAreaModel->getScenicAreasM($p,'',4);
        $data = $this->scenicAreaModel->getScenicAreasM(($p+1),'',4);
        if($data['scenicAreas']){
            $num = 1;
        }else{
            $num = 2;
        }
        $html = '';
        foreach ($scenicviews['scenicAreas'] as $k => $v){
            $html .= '<li class="li_i"><a href="'.base_url().'scenicarea/areaList?id='.$v['id'].'"><img src="'.$v['coverImage'].'" style="height:200px;" /></a><div class="li_bt"><p><a href="'.base_url().'scenicarea/areaList?id='.$v['id'].'">'.$v['title'].'<br /><span>'.$v['description'].'</span><br />('.$v['num'].'张)</a></p></div></li>';
        }
        $rst['html'] = $html;
        $rst['num'] = $num;
        echo json_encode($rst);
    }
    
    //景区相册列表
    public function areaList()
    {
        $id = $this->input->get('id');
        $content = $this->scenicAreaImageModel->getScenicAreaImagesM($id);
        $content['pageTitle'] = '景区相册 - 瑶琳国家森林公园';
//        var_dump($content);
//        die;
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
}
