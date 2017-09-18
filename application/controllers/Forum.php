<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/6
 * Time: 17:16
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

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function loadJottings()
    {
        $result = [];

        $currentPageNumber = $this->input->post('currentPageNumber');
        $jottings = $this->jottingModel->getJottings($currentPageNumber, null);

        if ($jottings['count'] > 0) {
            foreach ($jottings['jottings'] as $jotting) {
                $result[] = $this->jottingModel->getDetailJottingById($jotting);
            }
        }

        echo json_encode($result);
    }

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

    public function writeJotting()
    {
        $this->content['pageTitle'] = '写游记';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

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

    public function showJotting($id)
    {
        $content['jottingId'] = $id;
        $this->content['pageTitle'] = $this->jottingModel->getJottingById($id)['title'];
        $content['title'] = $this->jottingModel->getJottingById($id)['title'];
        $this->jottingModel->updateHits($id);

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
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
        $jottingId = $this->input->post('jottingId');
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
