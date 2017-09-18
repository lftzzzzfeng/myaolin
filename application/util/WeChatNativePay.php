<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/26
 * Time: 9:51
 */
namespace util;
require_once 'CurlTool.php';
require_once 'RandomTool.php';

class WeChatNativePay
{
//    const APP_ID = 'wx7c0adb91597ff4e8';
//    const APP_SECRET = '1a8361f95c1547d5adb211cdc9aa6f43';
//    const MERCHANT_ID  = '1486544382';
//    const API_KEY = '';

//SDK
//    const APP_ID = 'wx426b3015555a46be';
//    const MERCHANT_ID = '1900009851';
//    const API_KEY = '8934e7d15453e97507ef794cf7b0519d';
//    const APP_SECRET = '7813490da6f1265e4901ffb80afaa36f';

//MeiJiaXia
    const APP_ID = 'wx3118d9e60248a077';
    const MERCHANT_ID = '1358424302';
    const API_KEY = 'e4f6328a76004ee7cd102436bb9dc05e';
    const APP_SECRET = '01c6d59a3f9024db6336662ac95c8e74';

    const SAND_BOX_API_KEY = '';

    const PUBLIC_REDIRECT_URI = 'http://m.clubjoin.cn/';
    const TRADE_TYPE_JS_API = 'JSAPI';
    const TRADE_TYPE_NATIVE = 'NATIVE';
    const TRADE_TYPE_APP = 'APP';
    const URL_UNIFIED_ORDER = "https://api.mch.weixin.qq.com/pay/unifiedorder";
//    const URL_UNIFIED_ORDER = "https://api.mch.weixin.qq.com/sandboxnew/pay/unifiedorder";
    const URL_ORDER_QUERY = "https://api.mch.weixin.qq.com/pay/orderquery";
    const URL_CLOSE_ORDER = 'https://api.mch.weixin.qq.com/pay/closeorder';

    public static function getSandBoxAPIkey()
    {
        $url = 'https://api.mch.weixin.qq.com/sandboxnew/pay/getsignkey';

        $data = [];
        $data['mch_id'] = self::MERCHANT_ID;
        $data['nonce_str'] = RandomTool::generateString(32);
        $data["sign"] = self::sign($data);

        file_put_contents(dirname(__FILE__) . '/../../log/wxpay.txt', CurlTool::xmlPost($url, $data));
    }

    /**
     * 统一下单接口
     *
     * @param array $params
     *
     * @return mixed
     */
    public static function unifiedOrder($params) {
        $data = array();
        $data["appid"] = self::APP_ID;
//        $data["attach"] = isset($params['attach']) ? $params['attach'] : null;//optional
        $data["body"] = $params['body'];
//        $data["detail"] = isset($params['detail']) ? $params['detail'] : null;//optional
        $data["device_info"] = 'WEB';
        $data["fee_type"] = 'CNY';
//        $data["goods_tag"] = isset($params['goods_tag']) ? $params['goods_tag'] : null;
        $data["mch_id"] = self::MERCHANT_ID;
        $data["nonce_str"] = $params['nonce_str'];
        $data["notify_url"] = $params['notify_url'];
//        $data["openid"] = isset($params['openid']) ? $params['openid'] : null;//required when trade_type = JSAPI
        $data["out_trade_no"] = isset($params['out_trade_no']) ? '' . $params['out_trade_no'] : null;
        $data["product_id"] = isset($params['product_id']) ? $params['product_id'] : null;//required when trade_type = NATIVE
        $data["spbill_create_ip"] = $params['spbill_create_ip'];
        $data["time_expire"] = '20171227161910';//optional
        $data["time_start"] = '20161226161910';//optional
        $data["total_fee"] = intval($params['total_fee']);
        $data["trade_type"] = $params['trade_type'];

        $data["sign"] = self::sign($data);
        $result = CurlTool::xmlPost(self::URL_UNIFIED_ORDER, $data);
        return $result;
    }

    /**
     * 数据签名
     *
     * @param $data
     *
     * @return string
     */
    public static function sign($data)
    {
        ksort($data);
        $string1 = "";
        foreach ($data as $k => $v) {
            if ($v && trim($v)!='') {
                $string1 .= "$k=$v&";
            }
        }
        $stringSignTemp = $string1 . "key=" . self::API_KEY;
        $sign = strtoupper(md5($stringSignTemp));
        return $sign;
    }

    /**
     * 扫码支付(模式二)获取支付二维码
     * @param $body
     * @param $outTradeNo
     * @param $totalFee
     * @param $notifyUrl
     * @param $productId
     *
     * @return string | null
     */
    public static function getCodeUrl($body, $outTradeNo, $totalFee, $notifyUrl, $productId) {
        $data = array();
        $data["nonce_str"] = RandomTool::generateString(32);
        $data["body"] = $body;
        $data["out_trade_no"] = $outTradeNo;
        $data["total_fee"] = $totalFee;
        $data["spbill_create_ip"] = gethostbyname(gethostname());
        $data["notify_url"] = $notifyUrl;
        $data["trade_type"] = self::TRADE_TYPE_NATIVE;
        $data["product_id"] = $productId;
        $result = self::unifiedOrder($data);

        if ($result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS") {
            $array = '{ ["trade_type"]=> string(6) "NATIVE" ["prepay_id"]=> string(22) "wx20170826162857898443" ["nonce_str"]=> string(32) "Z2quNIJdF5LOXceX1WXtgocr6X8D3UVU" ["return_code"]=> string(7) "SUCCESS" ["err_code_des"]=> string(2) "ok" ["sign"]=> string(32) "693B41E2336E0732F8F1E8C37DD118B3" ["mch_id"]=> string(10) "1358424302" ["return_msg"]=> string(2) "OK" ["appid"]=> string(18) "wx3118d9e60248a077" ["device_info"]=> string(7) "sandbox" ["code_url"]=> string(24) "weixin://wxpay/s/An4baqw" ["result_code"]=> string(7) "SUCCESS" ["err_code"]=> string(7) "SUCCESS" }';
            var_dump($result);
            exit;
        } else {
            var_dump($result);
            exit;
            $error = $result["return_code"] == "SUCCESS" ? $result["err_code_des"] : $result["return_msg"];
            return null;
        }
    }

    /**
     * 查询订单
     *
     * @param $transactionId
     * @param $outTradeNo
     *
     * @return array
     */
    public static function orderQuery($transactionId, $outTradeNo) {
        $data = array();
        $data["appid"] = self::APP_ID;
        $data["mch_id"] = self::MERCHANT_ID;
        $data["transaction_id"] = $transactionId;
        $data["out_trade_no"] = $outTradeNo;
        $data["nonce_str"] = RandomTool::generateString(32);
        $result = CurlTool::xmlPost(self::URL_ORDER_QUERY, $data);

        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS") {
            return true;
        }
        return false;
    }
    /**
     * 关闭订单
     *
     * @param $outTradeNo
     *
     * @return array
     */
    public function closeOrder($outTradeNo) {
        $data = array();
        $data["appid"] = self::APP_ID;
        $data["mch_id"] = self::MERCHANT_ID;
        $data["out_trade_no"] = $outTradeNo;
        $data["nonce_str"] = RandomTool::generateString(32);
        $result = CurlTool::xmlPost(self::URL_CLOSE_ORDER, $data);
        return $result;
    }
}
