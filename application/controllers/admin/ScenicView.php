<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/18
 * Time: 14:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicView extends AdminController
{
    public $publicViewPath = 'admin/scenicview/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicViewModel');
        $this->load->model('scenicViewImageModel');
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

        $scenicViewPagination = $this->scenicViewModel->getScenicViews($content['currentPageNumber'], $keyword);
        $content['scenicViews'] = $scenicViewPagination['scenicViews'];
        $content['count'] = $scenicViewPagination['count'];
        $content['totalPageNumber'] = $scenicViewPagination['totalPageNumber'];

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
            $content['isRecommended'] = util\Constant::IS_RECOMMENDED_NO;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['description'] = $this->input->post('description');
            $content['isRecommended'] = $this->input->post('isRecommended') ? 1 : 0;
            $content['status'] = $this->input->post('status');
            $content['coverImage'] = !empty($_FILES['coverImage']['name']) ? $_FILES['coverImage']['name'] : '';
            $content['scenicViewImages'] = count($_FILES['scenicViewImages']) > 0 ? $_FILES['scenicViewImages'] : "";

            $savedId = $this->scenicViewModel->saveScenicView($content['id'], $content['title'], $content['coverImage'],
                $content['description'], $content['isRecommended'], $content['status']);

            if ($id) {
                $saveId = $id;
            } else {
                $saveId = $savedId;
            }

            $content['id'] = $savedId;

            if (!empty($_FILES['coverImage']['name'])) {
                $info = pathinfo($_FILES['coverImage']['name']);
                $ext = $info['extension'];
                $scenicViewCoverImagePublicPath = dirname(__FILE__) . '/../../../ui/img/scenicview/coverimage/';
                $newName = $saveId . '.' . $ext;
                $target = $scenicViewCoverImagePublicPath . $newName;
                move_uploaded_file($_FILES['coverImage']['tmp_name'], $target);
            }

            if (count($content['scenicViewImages']) > 0) {
                $this->scenicViewImageModel->saveScenicViewImages($savedId, $content['scenicViewImages']);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $scenicView = $this->scenicViewModel->getScenicViewById($content['id']);
            $content['id'] = $scenicView['id'];
            $content['title'] = $scenicView['title'];
            $content['description'] = $scenicView['description'];
            $content['isRecommended'] = $scenicView['isRecommended'];
            $content['status'] = $scenicView['status'];
            if ($scenicView['coverImage']) {
                $content['coverImage'] = base_url() . 'ui/img/scenicview/coverimage/' . $content['id'] . '.' . explode('.', $scenicView['coverImage'])[1] . '?' . time();
            } else {
                $content['coverImage'] = '';
            }
            $content['creatorId'] = $scenicView['creatorId'];
            $content['createdTimestamp'] = $scenicView['createdTimestamp'];
            $content['lastEditorId'] = $scenicView['lastEditorId'];
            $content['lastEditedTimestamp'] = $scenicView['lastEditedTimestamp'];
            $images = $this->scenicViewImageModel->getScenicViewImages($content['id']);

            if (count($images) > 0) {
                foreach ($images as $image) {
                    $content['showScenicViewImages'][] = base_url() . 'ui/img/scenicview/images/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
                }
            } else {
                $content['showScenicViewImages'] = [];
            }
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
