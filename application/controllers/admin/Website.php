<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/24
 * Time: 15:00
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends AdminController
{
    public $publicViewPath = 'admin/website/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('websiteModel');
        $this->load->library('session');
    }

    public function edit()
    {
        $this->session->set_flashdata('savedResult', 0);
        $data['administratorId'] = $_SESSION['user']['id'];
        $data['username'] = $_SESSION['user']['username'];

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            $content['backgroundImage'] = !empty($_FILES['backgroundImage']['name']) ? $_FILES['backgroundImage']['name'] : '';

            $this->websiteModel->saveWebsite($content['title'], $content['content'], $content['backgroundImage']);

            if (!empty($_FILES['backgroundImage']['name'])) {
                $info = pathinfo($_FILES['backgroundImage']['name']);
                $ext = $info['extension'];
                $websiteImagePublicPath = dirname(__FILE__) . '/../../../ui/img/website/';
                $newName = '1.' . $ext;
                $target = $websiteImagePublicPath . $newName;
                move_uploaded_file($_FILES['backgroundImage']['tmp_name'], $target);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        $website = $this->websiteModel->getWebsiteById();
        $content['id'] = $website['id'];
        $content['title'] = $website['title'];
        $content['content'] = $website['content'];
        if ($website['backgroundImage']) {
            $content['backgroundImage'] = base_url() . 'ui/img/website/1' . '.' . explode('.', $website['backgroundImage'])[1] . '?' . time();
        } else {
            $content['backgroundImage'] = '';
        }
        $content['lastEditorId'] = $website['lastEditorId'];
        $content['lastEditedTimestamp'] = $website['lastEditedTimestamp'];

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
