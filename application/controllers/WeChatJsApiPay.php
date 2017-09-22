<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/28
 * Time: 15:44
 */
require_once dirname(__FILE__) . '/../util/WeChatJsApiPay.php';

class WeChatJsApiPay extends MainController
{
    public $publicViewPath = 'main/wechat/pay/jsapi';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
//        o5p6C1a5mmG6VZRJIzA-dbuUfsME
        \util\WeChatJsApiPay::getJsApiP-arameters('o5p6C1a5mmG6VZRJIzA-dbuUfsME', '哈哈哈', 20170830140665, 1, base_url() . 'weChatJsApiPay/notify', 660011);
//        \util\WeChatNativePay::getCodeUrl('商品', 20170827140815, 1, base_url() . 'weChatNativePay/notify', 110011);
    }

    public function notify()
    {

    }
}