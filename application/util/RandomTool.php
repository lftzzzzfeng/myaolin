<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/26
 * Time: 10:12
 */
namespace util;

class RandomTool
{
    /**
     * 生成指定长度的随机字符串
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateString($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }
}
