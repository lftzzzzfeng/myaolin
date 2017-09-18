<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/4
 * Time: 14:43
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodation extends AdminController
{
    public $publicViewPath = 'admin/accommodation/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('accommodationCategoryModel');
        $this->load->model('accommodationModel');
        $this->load->model('accommodationImageModel');
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

        $accommodationPagination = $this->accommodationModel->getAccommodations($content['currentPageNumber'], $keyword);
        $content['accommodations'] = $accommodationPagination['accommodations'];
        $content['count'] = $accommodationPagination['count'];
        $content['totalPageNumber'] = $accommodationPagination['totalPageNumber'];

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
            $content['accommodationCategoryId'] = null;
            $content['title'] = null;
            $content['description'] = null;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }
        $content['accommodationCategories'] = $this->accommodationCategoryModel->getAccommodationCategoriesSelection();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['accommodationCategoryId'] = $this->input->post('accommodationCategoryId');
            $content['title'] = $this->input->post('title');
            $content['description'] = $this->input->post('description');
            $content['status'] = $this->input->post('status');
            $content['accommodationImages'] = count($_FILES['accommodationImages']) > 0 ? $_FILES['accommodationImages'] : "";

            $savedId = $this->accommodationModel->saveAccommodation($content['id'], $content['accommodationCategoryId'], $content['title'], $content['description'], $content['status']);

            $content['id'] = $savedId;

            if (count($content['accommodationImages']) > 0) {
                $this->accommodationImageModel->saveAccommodationImages($savedId, $content['accommodationImages']);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $accommodation = $this->accommodationModel->getAccommodationById($content['id']);
            $content['id'] = $accommodation['id'];
            $content['accommodationCategoryId'] = $accommodation['accommodationCategoryId'];
            $content['title'] = $accommodation['title'];
            $content['description'] = $accommodation['description'];
            $content['status'] = $accommodation['status'];
            $content['creatorId'] = $accommodation['creatorId'];
            $content['createdTimestamp'] = $accommodation['createdTimestamp'];
            $content['lastEditorId'] = $accommodation['lastEditorId'];
            $content['lastEditedTimestamp'] = $accommodation['lastEditedTimestamp'];
            $images = $this->accommodationImageModel->getAccommodationImages($content['id']);

            if (count($images) > 0) {
                foreach ($images as $image) {
                    $content['showAccommodationImages'][] = base_url() . 'ui/img/accommodation/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
                }
            } else {
                $content['showAccommodationImages'] = [];
            }
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
