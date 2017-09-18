<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/11
 * Time: 14:41
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../../util/QRCodeTool.php';

class Distributor extends AdminController
{
    public $publicViewPath = 'admin/distributor/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('distributorModel');
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

        $distributorPagination = $this->distributorModel->getDistributors($content['currentPageNumber'], $keyword);
        $content['distributors'] = $distributorPagination['distributors'];
        $content['count'] = $distributorPagination['count'];
        $content['totalPageNumber'] = $distributorPagination['totalPageNumber'];

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
        $content['creatorId'] = null;
        $content['createdTimestamp'] = null;
        $content['lastEditorId'] = null;
        $content['lastEditedTimestamp'] = null;

        if (!$id) {
            $content['id'] = null;
            $content['incharge'] = null;
            $content['mobile'] = null;
            $content['name'] = null;
            $content['description'] = null;
            $content['content'] = null;
            $content['address'] = null;
            $content['status'] = \util\Constant::STATUS_ACTIVE;
            $content['logo'] = null;
            $content['coverImage'] = null;
            $content['qrCode'] = null;
        } else {
            $content['id'] = $id;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if (!$id) {
                $content['creatorId'] = $_SESSION['user']['id'];
                $content['createdTimestamp'] = time();
            } else {
                $content['id'] = $id;
                $content['lastEditorId'] = $_SESSION['user']['id'];
                $content['lastEditedTimestamp'] = time();
            }

            $content['incharge'] = $this->input->post('incharge');
            $content['mobile'] = $this->input->post('mobile');
            $content['name'] = $this->input->post('name');
            $content['description'] = $this->input->post('description');
            $content['content'] = $this->input->post('content');
            $content['address'] = $this->input->post('address');
            $content['status'] = $this->input->post('status');
            $content['logo'] = !empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : '';
            $content['coverImage'] = !empty($_FILES['coverImage']['name']) ? $_FILES['coverImage']['name'] : '';

            $savedId = $this->distributorModel->saveDistributor($content['id'], $content['incharge'], $content['mobile'],
                $content['name'], $content['description'], $content['content'], $content['address'], $content['status'],
                $content['creatorId'], $content['createdTimestamp'], $content['lastEditorId'], $content['lastEditedTimestamp'],
                $content['logo'], $content['coverImage']);

            if ($id) {
                $saveId = $id;
            } else {
                $saveId = $savedId;
            }
            $content['id'] = $savedId;

            if (!empty($_FILES['logo']['name'])) {
                $this->distributorModel->saveQRCode($saveId);

                $info = pathinfo($_FILES['logo']['name']);
                $ext = $info['extension'];
                $distributorLogoPublicPath = dirname(__FILE__) . '/../../../ui/img/distributorlogo/';
                $logoName = $saveId . '.' . $ext;
                $target = $distributorLogoPublicPath . $logoName;
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);

                \util\QRCodeTool::generateQRCode(base_url() . 'qrCode/index/' . $saveId, $saveId . '.png', $logoName);
            }

            if (!empty($_FILES['coverImage']['name'])) {
                $info = pathinfo($_FILES['coverImage']['name']);
                $ext = $info['extension'];
                $distributorCoverImagePublicPath = dirname(__FILE__) . '/../../../ui/img/distributorcoverimage/';
                $newName = $saveId . '.' . $ext;
                $target = $distributorCoverImagePublicPath . $newName;
                move_uploaded_file($_FILES['coverImage']['tmp_name'], $target);
            }

            $this->session->set_flashdata('savedResult', 1);
        }

        if ($content['id']) {
            $distributor = $this->distributorModel->getDistributorById($content['id']);
            $content['id'] = $distributor['id'];
            $content['incharge'] = $distributor['incharge'];
            $content['mobile'] = $distributor['mobile'];
            $content['name'] = $distributor['name'];
            $content['description'] = $distributor['description'];
            $content['content'] = $distributor['content'];
            $content['address'] = $distributor['address'];
            $content['status'] = $distributor['status'];
            if ($distributor['logo']) {
                $content['logo'] = base_url() . 'ui/img/distributorlogo/' . $content['id'] . '.' . explode('.', $distributor['logo'])[1] . '?' . time();
            } else {
                $content['logo'] = '';
            }
            if ($distributor['coverImage']) {
                $content['coverImage'] = base_url() . 'ui/img/distributorcoverimage/' . $content['id'] . '.' . explode('.', $distributor['coverImage'])[1] . '?' . time();
            } else {
                $content['coverImage'] = '';
            }
            if ($distributor['logo']) {
                $content['qrCode'] = base_url() . 'ui/img/distributorqrcode/' . $content['id'] . '.' . explode('.', $distributor['qrCode'])[1] . '?' . time();
            } else {
                $content['qrCode'] = '';
            }
            $content['creatorId'] = $distributor['creatorId'];
            $content['createdTimestamp'] = $distributor['createdTimestamp'];
            $content['lastEditorId'] = $distributor['lastEditorId'];
            $content['lastEditedTimestamp'] = $distributor['lastEditedTimestamp'];
        }

        $this->load->view($this->adminTemplateHeaderPath, $data);
        $this->load->view($this->publicViewPath . 'edit', $content);
        $this->load->view($this->adminTemplateFooterPath);
    }
}
