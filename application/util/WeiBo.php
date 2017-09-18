<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/22
 * Time: 14:44
 */
namespace util;
require_once 'CurlTool.php';

class WeiBo
{
    const CLIENT_ID = '4006818404';
    const CLIENT_SECRET = '1f2d22a892a6c3552751bd2f5b59b9b6';
    const PUBLIC_REDIRECT_URI = 'http://www.meijiaxia.online/';

    /**
     * 请求用户授权Token
     *
     * @return string
     */
    public static function authorize()
    {
        $url = 'https://api.weibo.com/oauth2/authorize';
        $url .= '?client_id=' . self::CLIENT_ID;
        $url .= '&redirect_uri=' . self::PUBLIC_REDIRECT_URI;
        $url .= '&response_type=code';

        return $url;
    }

    /**
     * 获取授权过的AccessToken，并获取用户信息
     *
     * @param string $code
     *
     * @return string
     */
    public static function getUserInfo($code)
    {
        $url = "https://api.weibo.com/oauth2/access_token";
        $postData = 'client_id=' . self::CLIENT_ID;
        $postData .= '&client_secret=' . self::CLIENT_SECRET;
        $postData .= '&grant_type=authorization_code';
        $postData .= '&code=' . $code;
        $postData .= '&redirect_uri=' . self::PUBLIC_REDIRECT_URI;

//        $content = CurlTool::post($url, $postData);
        $content = '{"access_token":"2.00rAs7eGSVMK4Efc5f76b7321kpHyD","remind_in":"157679999","expires_in":157679999,"uid":"6094254589"}';
        $accessToken = json_decode($content, true)['access_token'];
        $uid = json_decode($content, true)['uid'];

        return self::userShow($accessToken, $uid);
    }

    /**
     * 授权信息查询接口
     *
     * @param string $accessToken 令牌
     *
     * @return string
     */
    public static function getTokenInfo($accessToken)
    {
        $url = 'https://api.weibo.com/oauth2/get_token_info';
        $postData = 'access_token=' . $accessToken;

        return CurlTool::post($url, $postData);
    }

    /**
     * 根据用户ID获取用户信息
     *
     * @param string $accessToken 令牌
     * @param string $uid 需要查询的用户ID
     *
     * @return array
     */
    public static function userShow($accessToken, $uid)
    {
        $url = 'https://api.weibo.com/2/users/show.json';
        $url .= '?access_token=' . $accessToken;
        $url .= '&uid=' . $uid;

        return CurlTool::get($url);
    }

    /**
     * 分享
     *
     * @param string $accessToken 令牌
     * @param string $status
     * @param string $pic
     * @param string $ip
     *
     * @return array
     */
    public static function share($accessToken, $status, $pic = null, $ip = null)
    {
        $url = 'https://api.weibo.com/2/statuses/share.json';
        $postData = 'access_token=' . $accessToken;
        $postData .= '&status=' . $status;
        if ($pic) {
            $postData .= '&pic=' . $pic;
        }
        if ($ip) {
            $postData .= '&ip=' . $ip;
        }

        return CurlTool::post($url, $postData);
    }
}
