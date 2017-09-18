<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/30
 * Time: 15:03
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ScenicView extends MainController
{
    public $mainTemplatePath = 'main/scenicview/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scenicViewModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->content['pageTitle'] = '景点介绍';

        $this->renderView($this->mainTemplatePath . $this->router->fetch_method());
    }

    public function loadScenicViews()
    {
        $result = [];

        $currentPageNumber = $this->input->post('currentPageNumber');
        $scenicViews = $this->scenicViewModel->getScenicViews($currentPageNumber, null, 1);
        foreach ($scenicViews['scenicViews'] as $scenicView) {
            $result[] = $this->scenicViewModel->getDetailScenicViewById($scenicView['id']);
        }
        echo json_encode($result);
    }
}
