<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/14
 * Time: 10:18
 * 商户中心
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../util/QRCodeTool.php';

class Merchant extends MainController
{
    public $mainTemplatePath = 'main/merchant/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('merchantModel');
        $this->load->model('merchantDetailModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        if (!$this->checkMerchantLogin()) {
            redirect(base_url() . 'merchant/login');
        }
        $this->content['pageTitle'] = '商户中心';
        $result['merchantType'] = $_SESSION['merchant']['type'];

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method(), $result);
    }

    public function agreement()
    {
        if (!$this->checkMerchantLogin()) {
            redirect(base_url() . 'merchant/login');
        }

        $this->content['pageTitle'] = '声明';

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method());
    }

    public function individualDetail()
    {
        if (!$this->checkMerchantLogin()) {
            redirect(base_url() . 'merchant/login');
        }
        $this->session->set_flashdata('savedResult', 0);

        $result = [];

        $this->content['pageTitle'] = '商户资料';

        $result['merchant'] = [];
        $result['merchant']['id'] = $_SESSION['merchant']['id'];
        $result['merchant']['merchantType'] = $_SESSION['merchant']['type'];
        $result['merchantDetail']['id'] = null;
        $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchant']['id']);

        if ($merchantDetail) {
            $result['merchantDetail']['id'] = $merchantDetail->merchantId;
        } else {
            $result['merchant']['type'] = '';
            $result['merchant']['name'] = '';
            $result['merchant']['ic'] = '';
            $result['merchant']['contactNumber'] = '';
            $result['merchant']['bankCardNumber'] = '';
            $result['merchant']['image'] = '';
            $result['merchant']['logo'] = '';
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result['merchant']['type'] = $this->input->post('type');
            $result['merchant']['username'] = $this->input->post('username');
            $result['merchant']['ic'] = $this->input->post('ic');
            $result['merchant']['contactNumber'] = $this->input->post('contactNumber');
            $result['merchant']['bankCardNumber'] = $this->input->post('bankCardNumber');
            $result['merchant']['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
            $result['merchant']['logo'] = !empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : '';

            $result['merchantDetail']['id'] = $this->merchantDetailModel->saveMerchantDetail($result['merchant']['id'],
                MerchantModel::TYPE_INDIVIDUAL, $result['merchant']['type'], $result['merchant']['username'], $result['merchant']['bankCardNumber'],
                $result['merchant']['contactNumber'], $result['merchant']['image'], null, $result['merchant']['ic'], $result['merchant']['logo']);

            if (!empty($_FILES['image']['name'])) {
                $info = pathinfo($_FILES['image']['name']);
                $ext = $info['extension'];
                $imagePublicPath = dirname(__FILE__) . '/../../ui/img/merchant/license/';
                $newName = $result['merchantDetail']['id'] . '.' . $ext;
                $target = $imagePublicPath . $newName;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            // base_url() . 'merchant/shop/' . $result['merchantDetail']['id']
            if (!empty($_FILES['logo']['name'])) {
                $info = pathinfo($_FILES['logo']['name']);
                $ext = $info['extension'];
                $logoPublicPath = dirname(__FILE__) . '/../../ui/img/merchant/logo/';
                $logoName = $result['merchantDetail']['id'] . '.' . $ext;
                $target = $logoPublicPath . $logoName;
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                \util\QRCodeTool::generateQRCode(base_url() . 'merchants/shop/' . $result['merchant']['id'], $result['merchantDetail']['id'] . '.png', $logoName);
            } else {
                $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchantDetail']['id']);
                if (!$merchantDetail->logo) {
                    $logoName = 'logo.png';
                    \util\QRCodeTool::generateQRCode(base_url() . 'merchants/shop/' . $result['merchant']['id'], $result['merchantDetail']['id'] . '.png', $logoName);
                }
            }


            $this->session->set_flashdata('savedResult', -1);
        }

        if ($result['merchantDetail']['id']) {
            $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchantDetail']['id']);
            $result['merchant']['type'] = $merchantDetail->type;
            $result['merchant']['name'] = $merchantDetail->name;
            $result['merchant']['ic'] = $merchantDetail->ic;
            $result['merchant']['contactNumber'] = $merchantDetail->contactNumber;
            $result['merchant']['bankCardNumber'] = $merchantDetail->bankCardNumber;
            if ($merchantDetail->image) {
                $result['merchant']['image'] = base_url() . 'ui/img/merchant/license/' . $result['merchantDetail']['id'] . '.' . explode('.', $merchantDetail->image)[1] . '?' . time();
            } else {
                $result['merchant']['image'] = '';
            }
            if ($merchantDetail->logo) {
                $result['merchant']['logo'] = base_url() . 'ui/img/merchant/logo/' . $result['merchantDetail']['id'] . '.' . explode('.', $merchantDetail->logo)[1] . '?' . time();
            } else {
                $result['merchant']['logo'] = '';
            }
            $result['merchant']['qrcode'] = base_url() . 'ui/img/merchant/qrcode/' . $result['merchantDetail']['id'] . '.png?' . time();
        }

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method(), $result);
    }

    public function companyDetail()
    {
        if (!$this->checkMerchantLogin()) {
            redirect(base_url() . 'merchant/login');
        }
        $this->session->set_flashdata('savedResult', 0);

        $result = [];

        $this->content['pageTitle'] = '商户资料';

        $result['merchant'] = [];
        $result['merchant']['id'] = $_SESSION['merchant']['id'];
        $result['merchant']['merchantType'] = $_SESSION['merchant']['type'];
        $result['merchantDetail']['id'] = null;
        $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchant']['id']);

        if ($merchantDetail) {
            $result['merchantDetail']['id'] = $merchantDetail->merchantId;
        } else {
            $result['merchant']['type'] = '';
            $result['merchant']['name'] = '';
            $result['merchant']['companyContactName'] = '';
            $result['merchant']['contactNumber'] = '';
            $result['merchant']['bankCardNumber'] = '';
            $result['merchant']['image'] = '';
            $result['merchant']['logo'] = '';
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result['merchant']['type'] = $this->input->post('type');
            $result['merchant']['username'] = $this->input->post('username');
            $result['merchant']['companyContactName'] = $this->input->post('companyContactName');
            $result['merchant']['contactNumber'] = $this->input->post('contactNumber');
            $result['merchant']['bankCardNumber'] = $this->input->post('bankCardNumber');
            $result['merchant']['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
            $result['merchant']['logo'] = !empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : '';

            $result['merchantDetail']['id'] = $this->merchantDetailModel->saveMerchantDetail($result['merchant']['id'],
                MerchantModel::TYPE_COMPANY, $result['merchant']['type'], $result['merchant']['username'], $result['merchant']['bankCardNumber'],
                $result['merchant']['contactNumber'], $result['merchant']['image'], $result['merchant']['companyContactName'], null, $result['merchant']['logo']);

            if (!empty($_FILES['image']['name'])) {
                $info = pathinfo($_FILES['image']['name']);
                $ext = $info['extension'];
                $imagePublicPath = dirname(__FILE__) . '/../../ui/img/merchant/license/';
                $newName = $result['merchantDetail']['id'] . '.' . $ext;
                $target = $imagePublicPath . $newName;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            // base_url() . 'merchant/shop/' . $result['merchantDetail']['id']
            if (!empty($_FILES['logo']['name'])) {
                $info = pathinfo($_FILES['logo']['name']);
                $ext = $info['extension'];
                $logoPublicPath = dirname(__FILE__) . '/../../ui/img/merchant/logo/';
                $logoName = $result['merchantDetail']['id'] . '.' . $ext;
                $target = $logoPublicPath . $logoName;
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                \util\QRCodeTool::generateQRCode(base_url() . 'merchants/shop/' . $result['merchant']['id'], $result['merchantDetail']['id'] . '.png', $logoName);
            } else {
                $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchantDetail']['id']);
                if (!$merchantDetail->logo) {
                    $logoName = 'logo.png';
                    \util\QRCodeTool::generateQRCode(base_url() . 'merchants/shop/' . $result['merchant']['id'], $result['merchantDetail']['id'] . '.png', $logoName);
                }
            }

            $this->session->set_flashdata('savedResult', -1);
        }

        if ($result['merchantDetail']['id']) {
            $merchantDetail = $this->merchantDetailModel->getMerchantDetailById($result['merchantDetail']['id']);
            $result['merchant']['type'] = $merchantDetail->type;
            $result['merchant']['name'] = $merchantDetail->name;
            $result['merchant']['companyContactName'] = $merchantDetail->companyContactName;
            $result['merchant']['contactNumber'] = $merchantDetail->contactNumber;
            $result['merchant']['bankCardNumber'] = $merchantDetail->bankCardNumber;
            if ($merchantDetail->image) {
                $result['merchant']['image'] = base_url() . 'ui/img/merchant/license/' . $result['merchantDetail']['id'] . '.' . explode('.', $merchantDetail->image)[1] . '?' . time();
            } else {
                $result['merchant']['image'] = '';
            }
            if ($merchantDetail->logo) {
                $result['merchant']['logo'] = base_url() . 'ui/img/merchant/logo/' . $result['merchantDetail']['id'] . '.' . explode('.', $merchantDetail->logo)[1] . '?' . time();
            } else {
                $result['merchant']['logo'] = '';
            }
            $result['merchant']['qrcode'] = base_url() . 'ui/img/merchant/qrcode/' . $result['merchantDetail']['id'] . '.png?' . time();
        }

        $this->load->view($this->mainTemplatePath .$this->router->fetch_method(), $result);
    }

    public function order()
    {
        if (!$this->checkMerchantLogin()) {
            redirect(base_url() . 'merchant/login');
        }

        $this->content['pageTitle'] = '商户订单';

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function signUp()
    {
        $result = ['code' => 0, 'message' => '', 'content' => []];

        $this->content['pageTitle'] = '商户注册';
        $result['content']['username'] = '';
        $result['content']['password'] = '';
        $result['content']['type'] = '';

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $type = $this->input->post('type');

            if ($this->merchantModel->existUsername($result['content']['username'])) {
                $result = ['code' => 1, 'message' => '此商户名已存在'];
            }

            $savedMerchantId = $this->merchantModel->saveMerchant($username, $password, $type);

            if ($savedMerchantId > 0) {
                $result = ['code' => -1, 'message' => '注册成功, 即将跳转至登陆页面'];
            } else {
                $result = ['code' => 1, 'message' => '注册失败'];
            }
        }

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $result);
    }

    public function login()
    {
        $result = ['code' => 0, 'message' => '', 'content' => []];

        $this->content['pageTitle'] = '商户登陆';
        $result['content']['username'] = '';

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result['content']['username'] = $this->input->post('username');
            $result['content']['password'] = $this->input->post('password');

            if (!$this->merchantModel->login($result['content']['username'], $result['content']['password'])) {
                $result['code'] = 1;
                $result['message'] = '用户名或密码不正确';
            } else {
                redirect(base_url() . 'merchant/index');
            }
        }

        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $result);
    }
}
