<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/8
 * Time: 18:48
 */
namespace util;

class TimeTool
{
    /**
     * 转换Epoch 时间去中式博客时间
     *
     * @param $timestamp
     *
     * @return string
     */
    public static function convertUnixTimestampToChineseBlogTime($timestamp)
    {
        $elapsedTime = time() - (int)$timestamp;

//        $format = array('31536000' => '年', '2592000' => '个月', '604800' => '星期', '86400' => '天',
//            '3600' => '小时', '60' => '分钟', '1' => '秒');

        if ($elapsedTime < 60) {
            return $elapsedTime . '秒前';
        } else if ($elapsedTime < (60 * 60)) {
            $showTime = floor($elapsedTime / 60);
            return $showTime . '分钟前';
        } else if ($elapsedTime < (60 * 60 * 24)) {
            $showTime = floor($elapsedTime / (60 * 60));
            return $showTime . '小时前';
        } else if ($elapsedTime < (60 * 60 * 24 * 7)) {
            $showTime = floor($elapsedTime / (60 * 60 * 24));
            return $showTime . '天前';
        } else {
            $showTime = date('Y年m月d日 H:i', $timestamp);
            return $showTime;
        }
    }

    /**
     * 目前不能用
     *
     * @param $the_time
     *
     * @return string
     */
    public static function time_trans($the_time)
    {
        $now_time = time();
        $show_time = strtotime($the_time);

        $dur = $now_time - $show_time;

        if($dur < 60){
            return $dur.'秒前';
        }else if($dur < 3600){
            return floor($dur/60).'分钟前';
        }else if($dur < 86400) {
            return floor($dur/3600).'小时前';
        }else if($dur < 259200) {//3天内
            return floor($dur / 86400) . '天前';
        }else{
            return $the_time;
        }
    }
}