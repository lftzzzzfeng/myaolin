<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 15:03
 * 景点介绍
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicView extends MainController
{
    public $mainTemplatePath = 'main/scenicview/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicViewModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '景点介绍';
        $content = $this->scenicViewModel->getScenicViewsM('','',4);
//        var_dump($content);
//        die;
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }

    public function loadScenicViews()
    {
        $result = [];

        $currentPageNumber = $this->input->post('currentPageNumber');
        $scenicViews = $this->scenicViewModel->getScenicViewsM($currentPageNumber, null, 1);
        foreach ($scenicViews['scenicViews'] as $scenicView) {
            $result[] = $this->scenicViewModel->getDetailScenicViewById($scenicView['id']);
        }
        echo json_encode($result);
    }
    
     //景点介绍加载更多
    public function ajaxScenic()
    {
        $p = $this->input->get('p');
        $scenicviews = $this->scenicViewModel->getScenicViewsM($p,'',2);
        $data = $this->scenicViewModel->getScenicViewsM(($p+1),'',2);
        if($data['scenicViews']){
            $num = 1;
        }else{
            $num = 2;
        }
        $html = '';
        foreach ($scenicviews['scenicViews'] as $k => $v){
            $html .= '<div class="nature_box bg-white margin-top-20 padding-15 clearfix"><h4>'.$v['title'].'</h4><p class="margin-bottom-15" style="color: #333;">'.$v['description'].'</p><div class="my-simple-gallery clearfix img_box" itemscope itemtype="http://schema.org/ImageGallery"><figure class="img-1  col-xs-6" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v['coverImage'].'" itemprop="contentUrl" data-size="1024x1024"><img src="'.$v['coverImage'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
            foreach ($v['img'] as $k1 => $v1){ 
                if($k1 == 0){
                    $html .= '<figure class="img-2  col-xs-3" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="960x1024"><img src="'.$v1['image'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                }else if($k1 == 1){
                    $html .= '<figure class="img-3  col-xs-3" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="960x1024"><img src="'.$v1['image'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                }else{
                    $html .= '<figure class="img-4  col-xs-6" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1['image'].'" itemprop="contentUrl" data-size="960x1024"><img src="'.$v1['image'].'" class=" padding-1" itemprop="thumbnail" alt="Image description"/></a></figure>';
                } 
            }
            $html .= '</div></div>';
        }
        $rst['html'] = $html;
        $rst['num'] = $num;
        echo json_encode($rst);
    }
}
