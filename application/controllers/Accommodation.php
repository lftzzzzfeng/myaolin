<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 9:04
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
        $this->content['pageTitle'] = '住在瑶琳';

        $content['accommodationCategories'] = $this->accommodationCategoryModel->getAllAccommodationCategoriesDetail();

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method(), $content);
    }
}
