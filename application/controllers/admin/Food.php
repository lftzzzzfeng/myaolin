<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/16
 * Time: 15:56
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends AdminController
{
    public $publicViewPath = 'admin/food/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('foodModel');
        $this->load->library('session');
    }

    public function index($page = null, $keyword = null)
    {
        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        $content['keyword'] = urldecode($keyword);
        $content['currentPageNumber'] = $page;
        if (!$content['currentPageNumber']) {
            $content['currentPageNumber'] = 1;
        }

        $foodPagination = $this->foodModel->getFood($content['currentPageNumber'], $keyword);
        $content['food'] = $foodPagination['food'];
        $content['count'] = $foodPagination['count'];
        $content['totalPageNumber'] = $foodPagination['totalPageNumber'];

        if (($content['currentPageNumber'] == 1) || (!$content['currentPageNumber'])) {
            $content['previous'] = '';
            $content['next'] = ($content['totalPageNumber'] == 1) ? 1 : $content['currentPageNumber'] + 1;
        } else if ($content['currentPageNumber'] > 1 && $content['currentPageNumber'] < $content['totalPageNumber']) {
            $content['previous'] = $content['currentPageNumber'] - 1;
            $content['next'] = $content['currentPageNumber'] + 1;
        } else if ($content['currentPageNumber'] == $content['totalPageNumber']) {
            $content['previous'] = $content['currentPageNumber'] - 1;
            $content['next'] = '';
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'index', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }

    public function edit($id = null)
    {
        $this->session->set_flashdata('savedResult', 0);
        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        if (!$id) {
            $content['id'] = null;
            $content['title'] = null;
            $content['coverImage'] = null;
            $content['description'] = null;
            $content['content'] = null;
            $content['isRecommended'] = util\Constant::IS_RECOMMENDED_NO;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['description'] = $this->input->post('description');
            $content['content'] = $this->input->post('content');
            $content['isRecommended'] = $this->input->post('isRecommended') ? 1 : 0;
            $content['status'] = $this->input->post('status');
            $content['coverImage'] = !empty($_FILES['coverImage']['name']) ? $_FILES['coverImage']['name'] : '';

            $savedId = $this->foodModel->saveFood($content['id'], $content['title'], $content['coverImage'],
                $content['description'], $content['content'], $content['isRecommended'], $content['status']);

            if ($id) {
                $saveId = $id;
            } else {
                $saveId = $savedId;
            }
            $content['id'] = $savedId;

            if (!empty($_FILES['coverImage']['name'])) {
                $info = pathinfo($_FILES['coverImage']['name']);
                $ext = $info['extension'];
                $foodCoverImagePublicPath = dirname(__FILE__) . '/../../../ui/img/food/';
                $newName = $saveId . '.' . $ext;
                $target = $foodCoverImagePublicPath . $newName;
                move_uploaded_file($_FILES['coverImage']['tmp_name'], $target);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $food = $this->foodModel->getFoodById($content['id']);
            $content['id'] = $food['id'];
            $content['title'] = $food['title'];
            $content['description'] = $food['description'];
            $content['content'] = $food['content'];
            $content['isRecommended'] = $food['isRecommended'];
            $content['status'] = $food['status'];
            if ($food['coverImage']) {
                $content['coverImage'] = base_url() . 'ui/img/food/' . $content['id'] . '.' . explode('.', $food['coverImage'])[1] . '?' . time();
            } else {
                $content['coverImage'] = '';
            }
            $content['creatorId'] = $food['creatorId'];
            $content['createdTimestamp'] = $food['createdTimestamp'];
            $content['lastEditorId'] = $food['lastEditorId'];
            $content['lastEditedTimestamp'] = $food['lastEditedTimestamp'];
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
