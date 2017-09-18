<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/26
 * Time: 10:50
 */
namespace util;

class XmlTool
{
    /**
     * 转换数组为XML
     *
     * @param $array
     *
     * @return string
     */
    public static function array2Xml($array)
    {
        $xml = "<xml>" . PHP_EOL;
        foreach ($array as $k => $v) {
            if($v && trim($v)!='')
                $xml .= "<$k><![CDATA[$v]]></$k>" . PHP_EOL;
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 转换Xml为数组
     *
     * @param $xml
     *
     * @return array
     */
    public static function xml2Array($xml) {
        file_get_contents(dirname(__FILE__) . '/../../log/wxpay.txt', $xml);
        $array = array();
        $tmp = null;

        try {
            $tmp = (array) simplexml_load_string($xml);
        } catch (\Exception $e) { }

        if ($tmp && is_array($tmp)) {
            foreach ($tmp as $k => $v) {
                $array[$k] = (string) $v;
            }
        }

        return $array;
    }
}
