<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/31
 * Time: 9:17
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicArea extends MainController
{
    public $mainTemplatePath = 'main/scenicarea/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicAreaModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '景区相册';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function loadScenicAreas()
    {
        $result = [];

        $currentPageNumber = $this->input->post('currentPageNumber');
        $scenicAreas = $this->scenicAreaModel->getScenicAreas($currentPageNumber, null, 1);
        foreach ($scenicAreas['scenicAreas'] as $scenicArea) {
            $result[] = $this->scenicAreaModel->getDetailScenicAreaById($scenicArea['id']);
        }
        echo json_encode($result);
    }
}
