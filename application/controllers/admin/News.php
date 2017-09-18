<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/11
 * Time: 14:48
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends AdminController
{
    public $publicViewPath = 'admin/news/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('newsModel');
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

        $newsPagination = $this->newsModel->getNews($content['currentPageNumber'], $keyword);
        $content['news'] = $newsPagination['news'];
        $content['count'] = $newsPagination['count'];
        $content['totalPageNumber'] = $newsPagination['totalPageNumber'];

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
            $content['hits'] = null;
            $content['publishedTimestamp'] = null;
            $content['isRecommended'] = util\Constant::IS_RECOMMENDED_NO;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['description'] = $this->input->post('description');
            $content['content'] = $this->input->post('content');
            $content['hits'] = $this->input->post('hits');
            $content['publishedTimestamp'] = $this->input->post('publishedTimestamp');
            $date = date_create_from_format('Y年m月d日 H:i', $content['publishedTimestamp']);
            $content['publishedTimestamp']= $date->getTimestamp();
            $content['isRecommended'] = $this->input->post('isRecommended') ? 1 : 0;
            $content['status'] = $this->input->post('status');
            $content['coverImage'] = !empty($_FILES['coverImage']['name']) ? $_FILES['coverImage']['name'] : '';

            $savedId = $this->newsModel->saveNews($content['id'], $content['title'], $content['coverImage'],
                $content['description'], $content['content'], $content['hits'], $content['publishedTimestamp'],
                $content['isRecommended'], $content['status']);

            if ($id) {
                $saveId = $id;
            } else {
                $saveId = $savedId;
            }
            $content['id'] = $savedId;

            if (!empty($_FILES['coverImage']['name'])) {
                $info = pathinfo($_FILES['coverImage']['name']);
                $ext = $info['extension'];
                $newsCoverImagePublicPath = dirname(__FILE__) . '/../../../ui/img/news/';
                $newName = $saveId . '.' . $ext;
                $target = $newsCoverImagePublicPath . $newName;
                move_uploaded_file($_FILES['coverImage']['tmp_name'], $target);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $news = $this->newsModel->getNewsById($content['id']);
            $content['id'] = $news['id'];
            $content['title'] = $news['title'];
            $content['description'] = $news['description'];
            $content['content'] = $news['content'];
            $content['hits'] = $news['hits'];
            if ($news['publishedTimestamp']) {
                $content['publishedTimestamp'] = date('Y年m月d日 H:i', $news['publishedTimestamp']);
            } else {
                $content['publishedTimestamp'] = '';
            }
            $content['isRecommended'] = $news['isRecommended'];
            $content['status'] = $news['status'];
            if ($news['coverImage']) {
                $content['coverImage'] = base_url() . 'ui/img/news/' . $content['id'] . '.' . explode('.', $news['coverImage'])[1] . '?' . time();
            } else {
                $content['coverImage'] = '';
            }
            $content['creatorId'] = $news['creatorId'];
            $content['createdTimestamp'] = $news['createdTimestamp'];
            $content['lastEditorId'] = $news['lastEditorId'];
            $content['lastEditedTimestamp'] = $news['lastEditedTimestamp'];
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
