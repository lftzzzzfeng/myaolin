<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/9
 * Time: 16:00
 */
require_once dirname(__FILE__) . '/../util/WeatherForecast.php';
require_once dirname(__FILE__) . '/../util/Constant.php';

class MY_Controller extends CI_Controller
{

}

class AdminController extends MY_Controller
{
    public $adminTemplateHeaderPath = 'admin/template/header';
    public $adminTemplateFooterPath = 'admin/template/footer';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        redirect(\util\Constant::PC_DOMAIN . 'admin/login');
        $this->checkLogin();
    }

    public function checkLogin()
    {
        $this->load->model('administratorModel');
        if (isset($_SESSION['user']) && (!empty($_SESSION['user'])) && $this->administratorModel->existAdministrator($_SESSION['user']['username'])) {
            return true;
        } else {
            redirect(base_url() . 'admin/login');
        }
    }
}

class MainController extends MY_Controller
{
    public $mainTemplateHeaderPath = 'main/template/header';
    public $mainTemplateFooterPath = 'main/template/footer';
    public $content = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $weatherForecast = \util\WeatherForecast::getWeatherReport('桐庐');
        $weather = json_decode($weatherForecast, true)['result'];
        $this->content['weather']['temperature'] = $weather['today']['temperature'];
        $this->content['weather']['status'] = $weather['today']['weather'];
    }

    public function checkLogin()
    {
        $this->load->model('memberModel');
        if (isset($_SESSION['member']) && (!empty($_SESSION['member']))
            && $this->memberModel->existMember($_SESSION['member']['sourceType'], $_SESSION['member']['memberName'])) {
            return true;
        } else {
            return false;
        }
    }

    public function renderView($viewPath, $data = null)
    {
        $this->content['pageTitle'] =  $this->content['pageTitle'] . ' - 瑶琳国家森林公园';

        $this->load->view($this->mainTemplateHeaderPath, $this->content);
        $this->load->view($viewPath, $data);
        $this->load->view($this->mainTemplateFooterPath);
    }

    public function checkMerchantLogin()
    {
        $this->load->model('merchantModel');
        if (isset($_SESSION['merchant']) && (!empty($_SESSION['merchant']))
            && $this->merchantModel->existUsername($_SESSION['merchant']['username'])) {
            return true;
        } else {
            return false;
        }
    }
}
