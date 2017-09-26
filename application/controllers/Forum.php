<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/6
 * Time: 17:16
 * 游记随笔
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../util/TimeTool.php';

class Forum extends MainController
{
    public $mainTemplatePath = 'main/forum/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jottingModel');
        $this->load->model('jottingImageModel');
        $this->load->model('commentModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '游记随笔';
        $result['data'] = [];

        $currentPageNumber = $this->input->post('currentPageNumber');
        $jottings = $this->jottingModel->getJottingsM($currentPageNumber, null);

        if ($jottings['count'] > 0) {
            foreach ($jottings['jottings'] as $jotting) {
                $result['data'][] = $this->jottingModel->getDetailJottingById($jotting);
            }
        }
        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(),$result);
    }
    
    //写游记列表加载更多
    public function ajaxForum()
    {
        $p = $this->input->get('p');
        $jottings = $this->jottingModel->getJottingsM($p);
        $result['data'] = [];
        if ($jottings['count'] > 0) {
            foreach ($jottings['jottings'] as $jotting) {
                $result['data'][] = $this->jottingModel->getDetailJottingById($jotting);
            }
        }
        $html = '';
        foreach ($result['data'] as $k => $v){
            if(strlen($v['jottingContent']) > 219){
                $contents = mb_substr($v['jottingContent'],0,73,'utf-8').'...';
                $quanwen = '全文';
            }else{
                $contents = $v['jottingContent'];
                $quanwen = '';
            }
            
            $html .= '<div class="news margin-top-6 clearfix"><div class="header_img col-xs-12 col-sm-12 col-md-12 margin-top-10"><img class="col-xs-4 col-sm-4 col-md-2 text-center radius-8" src="'.base_url().'ui/img/mobile/yj_1.png" alt=""/><div class="col-xs-8 col-sm-8 col-md-10 text-left color_000 weight-700">'.$v['creatorName'].'</div><div class="col-xs-8 col-sm-8 col-md-10 text-left color_666 size-12 margin-top-10">'.$v['jottingTime'].'</div></div><h4 class="col-xs-12 col-sm-12 col-md-12 text-lef margin-top-10 margin-bottom-6 color_000 weight-500">'.$v['jottingTitle'].'</h4><p class="branddesc col-xs-12 col-sm-12 col-md-12 color_666 size-14"><span id="shouqi">'.$contents.'</span><span style="display:none" id="quanbu">'.$v['jottingContent'].'&nbsp;</span><span class="more" onclick="quanwen()" id="quanwen">'.$quanwen.'</span></p><div class="clearfix"></div><div class="my-simple-gallery flex_box_num clearfix padding-15" itemscope itemtype="http://schema.org/ImageGallery">';
            foreach ($v['jottingImages'] as $k1 => $v1){
                $html .= '<figure class="img-1" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$v1.'" itemprop="contentUrl" data-size="1024x1024"><img src="'.$v1.'" width="100%" class=" padding-1" itemprop="thumbnail" alt="Image description" style="width:115px; height:105px;" /></a></figure>';
            }
            $html .= '</div><div class="share_look col-xs-12 col-sm-12 col-md-12 margin-top-10"><div class="share_look_box  clearfix "><div class="look_num col-xs-4 col-sm-4 col-md-4 padding-0 text-center"><a href="#"><img src="'.base_url().'ui/img/mobile/yj_2.png" width="20%" alt=""/> &nbsp;'.$v['jottingHits'].'</a></div><div class="pingLun_num col-xs-4 col-sm-4 col-md-4 padding-0 text-center"><a href="#"><img src="'.base_url().'ui/img/mobile/yj_3.png" width="15%" alt=""/> &nbsp;'.$v['jottingCommentsCount'].'</a></div><div class="share col-xs-4 col-sm-4 col-md-4 padding-0 text-center"><a href="javascript:;"><img src="'.base_url().'ui/img/mobile/icon_share_2_03.png" width="12%" alt=""/> &nbsp;分享</a></div><div class="share_hid_box hidden"><div class="flex_box_between height-50"><a href="#"><img width="60%" src="'.base_url().'ui/img/mobile/icon_weibo.png" alt=""/></a><a href="#"><img width="60%" src="'.base_url().'ui/img/mobile/icon_weixin.png" alt=""/></a><a href="#"><img width="60%" src="'.base_url().'ui/img/mobile/icon_kongjian.png" alt=""/></a></div></div></div></div></div>';
        }
        echo $html;
    }
    
//    public function loadJottings()
//    {
//        $result = [];
//
//        $currentPageNumber = $this->input->post('currentPageNumber');
//        $jottings = $this->jottingModel->getJottings($currentPageNumber, null);
//
//        if ($jottings['count'] > 0) {
//            foreach ($jottings['jottings'] as $jotting) {
//                $result[] = $this->jottingModel->getDetailJottingById($jotting);
//            }
//        }
//
//        echo json_encode($result);
//    }

    public function loadJottingComments()
    {
        $jottingId = $this->input->post('jottingId');
        $comments = $this->commentModel->getFirstLevelComment($jottingId);
        $comments['jottingId'] = $jottingId;

        foreach ($comments['comments'] as &$comment) {
            $comment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($comment['createdTimestamp']);
            $comment['subComments'] = $this->commentModel->getSecondLevelJottingComments($comment['id']);
            if ($comment['subComments']['count'] > 0) {
                foreach ($comment['subComments']['comments'] as &$subComment) {
                    $subComment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($subComment['createdTimestamp']);
                }
            }
        }
//        var_dump($comments['comments'][4]['subComments']['comments'][0]);
        echo json_encode($comments);
    }

    public function loadAddJottingComment()
    {
        $result = [];

        $result['jottingId'] = $this->input->post('jottingId');
        $result['subCommentId'] = $this->input->post('subCommentId');
        $result['content'] = $this->input->post('content');
        $result['commentType'] = $this->input->post('commentType');

        $result['newCommentId'] = $this->commentModel->saveComment($result['jottingId'], $result['content'], $result['subCommentId']);
        $result['jottingCommentCount'] = $this->commentModel->getCountOfJottingComment($result['jottingId']);
        $result['newComment'] = $this->commentModel->getCommentById($result['newCommentId']);

        echo json_encode($result);
    }
    
    //写游记
    public function writeJotting()
    {
        $content['pageTitle'] = '写游记 - 瑶琳国家森林公园';
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }
    
    //添加游记
    public function addJotting()
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $images = $_FILES['images'];

        $jottingId = $this->jottingModel->saveJotting(null, $title, $content);
        $this->jottingImageModel->saveJottingImages($jottingId, $images);

        $result = [];
        $result['jotting']['id'] = $jottingId;
        $result['jotting']['title'] = $title;
        $result['jotting']['content'] = $content;
        echo json_encode($result);
    }
    
    //游记随笔正文、评论
    public function showJotting()
    {
        $id = $this->input->get('id');
        $content['jottingId'] = $id;
        $content['pageTitle'] = $this->jottingModel->getJottingById($id)['title'];
        $this->jottingModel->updateHits($id);
        $jottings = $this->jottingModel->getJottings(0, null, 1, 1, $id);
        foreach ($jottings['jottings'] as $jotting) {
            $content['data'] = $this->jottingModel->getDetailJottingById($jotting);
        }
        $content['comment'] = $this->commentModel->getFirstLevelComment($id, 0, 30);
        $content['jottingId'] = $id;
        foreach ($content['comment']['comments'] as &$comment) {
            $comment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($comment['createdTimestamp']);
            $comment['subComments'] = $this->commentModel->getSecondLevelJottingComments($comment['id'], 0, 30);
            if ($comment['subComments']['count'] > 0) {
                foreach ($comment['subComments']['comments'] as &$subComment) {
                    $subComment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($subComment['createdTimestamp']);
                }
            }
        }
//        var_dump($content);
//        die;
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(),$content);
    }

    public function loadJottingById()
    {
        $result = [];

        $jottingId = $this->input->post('jottingId');
        $jottings = $this->jottingModel->getJottings(0, null, 1, 1, $jottingId);

        if ($jottings['count'] > 0) {
            foreach ($jottings['jottings'] as $jotting) {
                $result[] = $this->jottingModel->getDetailJottingById($jotting);
            }
        }
        echo json_encode($result);
    }

    public function loadShowJottingComments()
    {
        $jottingId = $this->input->get('jottingId');
        $comments = $this->commentModel->getFirstLevelComment($jottingId, 0, 30);
        $comments['jottingId'] = $jottingId;

        foreach ($comments['comments'] as &$comment) {
            $comment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($comment['createdTimestamp']);
            $comment['subComments'] = $this->commentModel->getSecondLevelJottingComments($comment['id'], 0, 30);
            if ($comment['subComments']['count'] > 0) {
                foreach ($comment['subComments']['comments'] as &$subComment) {
                    $subComment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($subComment['createdTimestamp']);
                }
            }
        }
        echo json_encode($comments);
    }

    public function test() {
//        $jottings = $this->jottingModel->getJottings(1, null);
//        foreach ($jottings['jottings'] as $jotting) {
//            $result[] = $this->jottingModel->getDetailJottingById($jotting);
//        }
        $result = [];

//        $comments = $this->commentModel->getFirstLevelComment(11);
//
//        foreach ($comments['comments'] as &$comment) {
//            $comment['subComments'] = $this->commentModel->getSecondLevelJottingComments($comment['id']);
//        }
//        var_dump($comments['comments'][4]['subComments']['comments'][0]);

//        $comment = $this->commentModel->getCommentById(2);
//        var_dump($comment['creatorMemberId']);

//        var_dump($this->commentModel->getCommentById(11)['sender']);
//        $result['newCommentId'] = $this->commentModel->saveComment(11, 'abc', 4);
//        $result['jottingCommentCount'] = $this->commentModel->getCountOfJottingComment(11);
//        $result['newComment'] = $this->commentModel->getCommentById(12);
//        var_dump($result);
//        $jotting = $this->jottingModel->getJottings(0, null, 1, 1, 11);
//        var_dump($jotting);

        $jottingId = $this->input->post('jottingId');
        $jottingId = 11;
        $comments = $this->commentModel->getFirstLevelComment($jottingId, 0, 30);
        $comments['jottingId'] = $jottingId;

        foreach ($comments['comments'] as &$comment) {
            $comment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($comment['createdTimestamp']);
            $comment['subComments'] = $this->commentModel->getSecondLevelJottingComments($comment['id'], 0, 30);
            if ($comment['subComments']['count'] > 0) {
                foreach ($comment['subComments']['comments'] as &$subComment) {
                    $subComment['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($subComment['createdTimestamp']);
                }
            }
        }
        var_dump($comments);
        exit;
    }
}
