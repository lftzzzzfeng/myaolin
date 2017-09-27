<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/25
 * Time: 10:25
 */
namespace util;
require_once 'CurlTool.php';

class WeChat
{
    const APP_ID = 'wx7c0adb91597ff4e8';
    const APP_SECRET = '1a8361f95c1547d5adb211cdc9aa6f43';

    const PUBLIC_REDIRECT_URI = 'http://m.clubjoin.cn/';


    /**
     * 请求用户授权Token
     *
     * @param int $merchantId
     * @param string $state 返回参数
     *
     * @return string
     */
    public static function authorize($merchantId, $state = null)
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize';
        $url .= '?appid=' . self::APP_ID;
        $url .= '&redirect_uri=' . self::PUBLIC_REDIRECT_URI . 'merchants/shop/products/' . $merchantId;
        $url .= '&response_type=code';
        $url .= '&scope=snsapi_userinfo';
        if ($state) {
            $url .= '&state=' . $state;
        } else {
            $url .= '&state=STATE';
        }
        $url .= '#wechat_redirect';

        return $url;
    }

    /**
     * 获取access_token
     *
     * @param string $code
     * @param string $merchantId
     *
     * @return string
     */
    public static function getWeChatMemberInfo($code, $merchantId)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $url .= '?appid=' . self::APP_ID;
        $url .= '&secret=' . self::APP_SECRET;
        $url .= '&code=' . $code;
        $url .= '&grant_type=authorization_code';

        $result = CurlTool::get($url);
        $accessTokenResponse = json_decode($result, true);
        if (array_key_exists('errcode', $accessTokenResponse) && $accessTokenResponse['errcode'] > 0) {
            redirect(base_url() . 'merchants/shop/index/' . $merchantId);
        }
        $accessToken = $accessTokenResponse['access_token'];
        $refreshToken = $accessTokenResponse['refresh_token'];
        $openId = $accessTokenResponse['openid'];

        return self::getMemberInfo($accessToken, $openId);
    }

    /**
     * 令牌刷新
     *
     * @param string $refreshToken 刷新令牌
     *
     */
    public static function refreshToken($refreshToken)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token';
        $url .= '?appid=' . self::APP_ID;
        $url .= '&grant_type=refresh_token';
        $url .= '&refresh_token=' . $refreshToken;
    }

    /**
     * 拉取用户信息
     *
     * @param string $accessToken 令牌
     * @param string $openId 微信公众号id
     *
     * @return string
     */
    public static function getMemberInfo($accessToken, $openId)
    {
        $url = 'https://api.weixin.qq.com/sns/userinfo';
        $url .= '?access_token=' . $accessToken;
        $url .= '&openid=' . $openId;
        $url .= '&lang=zh_CN';

        return CurlTool::get($url);
    }
}
