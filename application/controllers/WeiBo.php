<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/21
 * Time: 16:57
 */
require_once dirname(__FILE__) . '/../util/WeiBo.php';

class WeiBo extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('memberModel');
        $this->load->library('session');
    }

    public function index()
    {
        $userInfo = json_decode(\util\WeiBo::getUserInfo('8d502a5b822d02ad47a64529bfa278ef'), true);
        $this->memberModel->saveMember(MemberModel::SOURCE_TYPE_WEIBO, $userInfo['id'], $userInfo['screen_name']);
        $member = $this->memberModel->getMemberInWeiBo($userInfo['id']);

        $_SESSION['member']['id'] = $member['id'];
        $_SESSION['member']['sourceType'] = MemberModel::SOURCE_TYPE_WEIBO;
        $_SESSION['member']['uid'] = $member['uid'];
        $_SESSION['member']['memberName'] = $member['username'];

        redirect(base_url());
    }

    public function share()
    {
        var_dump(\util\WeiBo::share('2.00rAs7eGSVMK4Efc5f76b7321kpHyD', 'http://clubjoin.cn/'));
    }
}
