<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/17
 * Time: 15:54
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicArea extends AdminController
{
    public $publicViewPath = 'admin/scenicarea/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicAreaModel');
        $this->load->model('scenicAreaImageModel');
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

        $scenicAreaPagination = $this->scenicAreaModel->getScenicAreas($content['currentPageNumber'], $keyword);
        $content['scenicAreas'] = $scenicAreaPagination['scenicAreas'];
        $content['count'] = $scenicAreaPagination['count'];
        $content['totalPageNumber'] = $scenicAreaPagination['totalPageNumber'];

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
            $content['scenicAreaImages'] = count($_FILES['scenicAreaImages']) > 0 ? $_FILES['scenicAreaImages'] : "";

            $savedId = $this->scenicAreaModel->saveScenicArea($content['id'], $content['title'], $content['coverImage'],
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
                $scenicAreaCoverImagePublicPath = dirname(__FILE__) . '/../../../ui/img/scenicarea/coverimage/';
                $newName = $saveId . '.' . $ext;
                $target = $scenicAreaCoverImagePublicPath . $newName;
                move_uploaded_file($_FILES['coverImage']['tmp_name'], $target);
            }

            if (count($content['scenicAreaImages']) > 0) {
                $this->scenicAreaImageModel->saveScenicAreaImages($savedId, $content['scenicAreaImages']);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $scenicArea = $this->scenicAreaModel->getScenicAreaById($content['id']);
            $content['id'] = $scenicArea['id'];
            $content['title'] = $scenicArea['title'];
            $content['description'] = $scenicArea['description'];
            $content['isRecommended'] = $scenicArea['isRecommended'];
            $content['status'] = $scenicArea['status'];
            if ($scenicArea['coverImage']) {
                $content['coverImage'] = base_url() . 'ui/img/scenicarea/coverimage/' . $content['id'] . '.' . explode('.', $scenicArea['coverImage'])[1] . '?' . time();
            } else {
                $content['coverImage'] = '';
            }
            $content['creatorId'] = $scenicArea['creatorId'];
            $content['createdTimestamp'] = $scenicArea['createdTimestamp'];
            $content['lastEditorId'] = $scenicArea['lastEditorId'];
            $content['lastEditedTimestamp'] = $scenicArea['lastEditedTimestamp'];
            $images = $this->scenicAreaImageModel->getScenicAreaImages($content['id']);

            if (count($images) > 0) {
                foreach ($images as $image) {
                    $content['showScenicAreaImages'][] = base_url() . 'ui/img/scenicarea/images/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
                }
            } else {
                $content['showScenicAreaImages'] = [];
            }
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
