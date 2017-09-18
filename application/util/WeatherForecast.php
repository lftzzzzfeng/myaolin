<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/24
 * Time: 14:42
 */
namespace util;
require_once 'CurlTool.php';

class WeatherForecast
{
    const APP_KEY = 'a27713b7d042029374b5238cd4435349';

    /**
     * 获取天气预报
     *
     * @param string $cityName 城市名称
     *
     * @return string
     */
    public static function getWeatherReport($cityName)
    {
        $url = 'http://v.juhe.cn/weather/index';
        $url .= '?format=2';
        $url .= '&cityname=' . urlencode($cityName);
        $url .= '&key=' . self::APP_KEY;

        return CurlTool::get($url);
    }
}
