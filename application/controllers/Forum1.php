<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/23
 * Time: 09:00
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum1 extends MainController
{
    public $publicViewPath = 'main/forum/';

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
        $jotting = $this->jottingModel->getJottingById(12);
        $content['id'] = $jotting['id'];
        $content['title'] = $jotting['title'];
        $content['content'] = $jotting['content'];
        $images = $this->jottingImageModel->getJottingImages($content['id']);

        if (count($images) > 0) {
            foreach ($images as $image) {
                $content['showJottingImages'][] = $this->baseUrl . 'ui/img/jotting/images/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
            }
        } else {
            $content['showJottingImages'] = [];
        }

        $this->load->view($this->publicViewPath . $this->router->fetch_method(), $content);
    }

    public function writeJotting()
    {

    }

    public function addJotting()
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $images = $_FILES['images'];

        $jottingId = $this->jottingModel->saveJotting(null, $title, $content);
        $this->jottingImageModel->saveJottingImages($jottingId, $images);
        echo true;
    }

    public function loadComments()
    {
        $comments = $this->commentModel->getCommentsByJottingId(12);
        echo json_encode($comments);
    }

    public function addComment()
    {

    }
}
