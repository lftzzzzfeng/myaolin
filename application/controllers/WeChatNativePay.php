<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/26
 * Time: 9:49
 */
require_once dirname(__FILE__) . '/../util/WeChatNativePay.php';
require_once dirname(__FILE__) . '/../util/QRCodeTool.php';
require_once dirname(__FILE__) . '/../util/XmlTool.php';
require_once dirname(__FILE__) . '/../util/RandomTool.php';

class WeChatNativePay extends MainController
{
    public $publicViewPath = 'main/wechat/pay';

    public function __construct()
    {
        parent::__construct();
//        $this->load->model('memberModel');
        $this->load->library('session');
    }

    public function index()
    {
        $params = [];

//        \util\WeChatNativePay::getCodeUrl('商品', 20170827140815, 1, base_url() . 'weChatNativePay/notify', 110011);

//        \util\QRCodeTool::generateQRCode('weixin://wxpay/bizpayurl?pr=RxCpulL', '100.png', '1.jpg');
//        \util\WeChatNativePay::getSandBoxAPIkey();
    }

    public function notify()
    {
        $postBackData = $_POST;
        $data = \util\XmlTool::xml2Array($postBackData);
        if (!array_key_exists("transaction_id", $data)) {
            return false;
        }
        if (\util\WeChatNativePay::orderQuery($data["transaction_id"], $data['out_trade_no'])) {
            return false;
        }

        return true;
    }
}
