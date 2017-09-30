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

    const API_KEY = '';

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

    public static function getWeatherReport2()
    {
        $url = 'https://free-api.heweather.com/v5/now';
        $url .= '?city=tonglu';
        $url .= '&key=325fae0e24fc4c46b5825ed9c312e980';

        return CurlTool::get($url);
    }

    public function getWeatherDetail($code)
    {
        $array = [
            '100' => ['晴', 'https://cdn.heweather.com/cond_icon/100.png'],
            '101' => ['多云', 'https://cdn.heweather.com/cond_icon/101.png'],
            '102' => ['少云', 'https://cdn.heweather.com/cond_icon/102.png'],
            '103' => ['晴间多云', 'https://cdn.heweather.com/cond_icon/103.png'],
            '104' => ['阴', 'https://cdn.heweather.com/cond_icon/104.png'],
            '200' => ['有风', 'https://cdn.heweather.com/cond_icon/200.png'],
            '201' => ['平静', 'https://cdn.heweather.com/cond_icon/201.png'],
            '202' => ['微风', 'https://cdn.heweather.com/cond_icon/202.png'],
            '203' => ['和风', 'https://cdn.heweather.com/cond_icon/203.png'],
            '204' => ['清风', 'https://cdn.heweather.com/cond_icon/204.png'],
            '205' => ['强风', 'https://cdn.heweather.com/cond_icon/205.png'],
            '206' => ['疾风', 'https://cdn.heweather.com/cond_icon/206.png'],
            '207' => ['大风', 'https://cdn.heweather.com/cond_icon/207.png'],
            '208' => ['烈风', 'https://cdn.heweather.com/cond_icon/208.png'],
        ];
    }
}
