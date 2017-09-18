<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/6
 * Time: 9:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Jotting extends AdminController
{
    public $publicViewPath = 'admin/jotting/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jottingModel');
        $this->load->model('jottingImageModel');
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

        $jottingPagination = $this->jottingModel->getJottings($content['currentPageNumber'], $keyword, JottingModel::TYPE_ADMINISTRATOR);
        $content['jottings'] = $jottingPagination['jottings'];
        $content['count'] = $jottingPagination['count'];
        $content['totalPageNumber'] = $jottingPagination['totalPageNumber'];

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
            $content['content'] = null;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            $content['status'] = $this->input->post('status');

            $savedId = $this->jottingModel->saveJotting($content['id'], $content['title'], $content['content'], $content['status'], JottingModel::TYPE_ADMINISTRATOR);
            $content['id'] = $savedId;

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $jotting = $this->jottingModel->getJottingById($content['id']);
            $content['id'] = $jotting['id'];
            $content['title'] = $jotting['title'];
            $content['content'] = $jotting['content'];
            $content['status'] = $jotting['status'];
            $content['creatorId'] = $jotting['creatorId'];
            $content['createdTimestamp'] = $jotting['createdTimestamp'];
            $content['lastEditorId'] = $jotting['lastEditorId'];
            $content['lastEditedTimestamp'] = $jotting['lastEditedTimestamp'];
            $images = $this->jottingImageModel->getJottingImages($content['id']);

            if (count($images) > 0) {
                foreach ($images as $image) {
                    $content['showJottingImages'][] = base_url() . 'ui/img/jotting/images/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
                }
            } else {
                $content['showJottingImages'] = [];
            }
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
