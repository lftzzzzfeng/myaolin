<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/25
 * Time: 10:50
 */
require_once dirname(__FILE__) . '/../util/WeChat.php';

class WeChat extends MainController
{
    public $publicViewPath = 'main/wechat/';

    public function __construct()
    {
        parent::__construct();
//        $this->load->model('memberModel');
        $this->load->library('session');
    }

    public function index()
    {
        $url = \util\WeChat::authorize();
        header("Location: $url");
    }

    public function login()
    {
        $code = $this->input->get('code');
        $memberInfo = \util\WeChat::getWeChatMemberInfo($code);

        $memberString = '{
    "openid": "o5p6C1a5mmG6VZRJIzA-dbuUfsME",
    "nickname": "劉峰",
    "sex": 0,
    "language": "en",
    "city": "",
    "province": "",
    "country": "",
    "headimgurl": "http://wx.qlogo.cn/mmopen/baxgtnQ3iazvUrM0ZeV3ibWibTKiaLK7My4vpibDHfbZuWebwMXR4wQm8U6d9iae0eaX9oicO1Qib6X1VqxibRzH64UqbbhgptxAWSwOia/0",
    "privilege": []
}';
    }
}
