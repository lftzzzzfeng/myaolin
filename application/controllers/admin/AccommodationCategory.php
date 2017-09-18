<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/1
 * Time: 16:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class AccommodationCategory extends AdminController
{
    public $publicViewPath = 'admin/accommodationcategory/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('accommodationCategoryModel');
        $this->load->model('accommodationCategoryImageModel');
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

        $accommodationCategoryPagination = $this->accommodationCategoryModel->getAccommodationCategories($content['currentPageNumber'], $keyword);
        $content['accommodationCategories'] = $accommodationCategoryPagination['accommodationCategories'];
        $content['count'] = $accommodationCategoryPagination['count'];
        $content['totalPageNumber'] = $accommodationCategoryPagination['totalPageNumber'];

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
            $content['description'] = null;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['description'] = $this->input->post('description');
            $content['status'] = $this->input->post('status');
            $content['specialImagesText'] = $this->input->post('specialImagesText');
            $content['specialImages'] = isset($_FILES['specialImages']) ? (count($_FILES['specialImages']) > 0 ? $_FILES['specialImages'] : "") : "";
            $savedId = $this->accommodationCategoryModel->saveAccommodationCategory($content['id'], $content['title'], $content['description'], $content['status']);
            $content['id'] = $savedId;

            if (count($content['specialImages']) > 0) {
                $this->accommodationCategoryImageModel->saveAccommodationCategoryImages($savedId, $content['specialImagesText'], $content['specialImages']);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $news = $this->accommodationCategoryModel->getAccommodationCategoryById($content['id']);
            $content['id'] = $news['id'];
            $content['title'] = $news['title'];
            $content['description'] = $news['description'];
            $content['status'] = $news['status'];
            $content['creatorId'] = $news['creatorId'];
            $content['createdTimestamp'] = $news['createdTimestamp'];
            $content['lastEditorId'] = $news['lastEditorId'];
            $content['lastEditedTimestamp'] = $news['lastEditedTimestamp'];

            $images = $this->accommodationCategoryImageModel->getAccommodationCategoryImages($content['id']);
            $content['showAccommodationCategoryImages'] = [];

            if (count($images) > 0) {
                foreach ($images as $image) {
                    $element = [];
                    $element['id'] = $image['id'];
                    $element['text'] = $image['text'];
                    $element['image'] = base_url() . 'ui/img/accommodation/category/' . $content['id'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();

                    array_push($content['showAccommodationCategoryImages'], $element);
                }
            }
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
