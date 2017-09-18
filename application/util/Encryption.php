<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/10
 * Time: 17:24
 */
namespace util;

class Encryption
{
    /**
     * 使用MD5加密
     *
     * @param string $content
     *
     * @return string
     */
    public static function encryptByMd5($content)
    {
        return md5($content);
    }

    /**
     * 生成10000-99999随机数字
     *
     * @return string
     */
    public static function generateRandomString()
    {
        return rand(10000, 99999);
    }
}
