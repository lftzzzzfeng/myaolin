<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/28
 * Time: 15:55
 */
namespace util;
require_once 'CurlTool.php';
require_once 'RandomTool.php';

class WeChatJsApiPay
{
    const APP_ID = 'wx7c0adb91597ff4e8';
    const APP_SECRET = '1a8361f95c1547d5adb211cdc9aa6f43'; //1a8361f95c1547d5adb211cdc9aa6f43
    const MERCHANT_ID  = '1486544382';
    const API_KEY = 'e4f6328a76004ee7cd102436bb9dc05e'; //biEFhE1rdxZK1ZqivWb8go2J1D0CxDyH

    const PUBLIC_REDIRECT_URI = 'http://clubjoin.cn/';
    const TRADE_TYPE_JS_API = 'JSAPI';
    const URL_UNIFIED_ORDER = "https://api.mch.weixin.qq.com/pay/unifiedorder";
    const URL_ORDER_QUERY = "https://api.mch.weixin.qq.com/pay/orderquery";
    const URL_CLOSE_ORDER = 'https://api.mch.weixin.qq.com/pay/closeorder';

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
        $data["openid"] = isset($params['openid']) ? $params['openid'] : null;//required when trade_type = JSAPI
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
     * 公众号支付JsApi参数
     * @param $openId
     * @param $body
     * @param $outTradeNo
     * @param $totalFee
     * @param $notifyUrl
     * @param $productId
     *
     * @return string | null
     */
    public static function getJsApiParameters($openId, $body, $outTradeNo, $totalFee, $notifyUrl, $productId) {
        $data = array();
        $data['openid'] = $openId;
        $data["nonce_str"] = RandomTool::generateString(32);
        $data["body"] = $body;
        $data["out_trade_no"] = $outTradeNo;
        $data["total_fee"] = $totalFee;
        $data["spbill_create_ip"] = gethostbyname(gethostname());
        $data["notify_url"] = $notifyUrl;
        $data["trade_type"] = self::TRADE_TYPE_JS_API;
        $data["product_id"] = $productId;
        $result = self::unifiedOrder($data);

        if ($result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS") {
//            $data = [];
            $_data['appId'] = $result['appid'];
            $_data['timeStamp'] = "" . time();
            $_data['nonceStr'] = RandomTool::generateString(32);
            $_data['package'] = 'prepay_id=' . $result['prepay_id'];
            $_data['signType'] = 'MD5';
            $_data['paySign'] = self::sign($_data);
//            $data['device_info'] = $result['device_info'];

//            $data['sign'] = $result['sign'];
//            $data['result_code'] = $result['result_code'];
//            $data['prepay_id'] = $result['prepay_id'];
//            $data['trade_type'] = $result['trade_type'];
            return $_data;
        } else {
            $error = $result["return_code"] == "SUCCESS" ? $result["err_code_des"] : $result["return_msg"];
            return $error;
        }
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
}