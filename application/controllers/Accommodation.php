<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:04
 * 住在瑶琳
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodation extends MainController
{
    public $mainTemplatePath = 'main/accommodation/';

    public function __construct()
    {

        parent::__construct();
        $this->load->model('accommodationCategoryModel');
        $this->load->model('accommodationCategoryImageModel');
        $this->load->model('accommodationModel');
        $this->load->model('accommodationImageModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $content['pageTitle'] = '住在瑶琳 - 瑶琳国家森林公园';
        $content['accommodation'] = $this->accommodationCategoryModel->getAllAccommodationCategoriesDetail();
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
    
    //住在瑶琳详情
    public function accommodationinfo()
    {
        $id = $this->input->get('id');
        $content['pageTitle'] = '住在瑶琳详情 - 瑶琳国家森林公园';
        $content['accommodationinfo'] = $this->accommodationCategoryModel->getAccommodationInfo($id);
        $this->load->view($this->mainTemplatePath . $this->router->fetch_method(), $content);
        $this->load->view('main/template/footer');
    }
}
