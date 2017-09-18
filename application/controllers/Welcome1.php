<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/../util/WeiBo.php';
require_once dirname(__FILE__) . '/../util/WeatherForecast.php';

class Welcome1 extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
	{
//	    $weatherForecast = \util\WeatherForecast::getWeatherReport('桐庐');
	    $weatherForecast = '{
    "resultcode": "200",
    "reason": "successed!",
    "result": {
        "sk": {
            "temp": "36",
            "wind_direction": "南风",
            "wind_strength": "2级",
            "humidity": "45%",
            "time": "14:41"
        },
        "today": {
            "temperature": "27℃~37℃",
            "weather": "晴",
            "weather_id": {
                "fa": "00",
                "fb": "00"
            },
            "wind": "南风微风",
            "week": "星期四",
            "city": "桐庐",
            "date_y": "2017年08月24日",
            "dressing_index": "炎热",
            "dressing_advice": "天气炎热，建议着短衫、短裙、短裤、薄型T恤衫等清凉夏季服装。",
            "uv_index": "很强",
            "comfort_index": "",
            "wash_index": "较适宜",
            "travel_index": "较不宜",
            "exercise_index": "较不宜",
            "drying_index": ""
        },
        "future": [
            {
                "temperature": "27℃~37℃",
                "weather": "晴",
                "weather_id": {
                    "fa": "00",
                    "fb": "00"
                },
                "wind": "南风微风",
                "week": "星期四",
                "date": "20170824"
            },
            {
                "temperature": "27℃~37℃",
                "weather": "雷阵雨转多云",
                "weather_id": {
                    "fa": "04",
                    "fb": "01"
                },
                "wind": "东南风微风",
                "week": "星期五",
                "date": "20170825"
            },
            {
                "temperature": "26℃~35℃",
                "weather": "雷阵雨转晴",
                "weather_id": {
                    "fa": "04",
                    "fb": "00"
                },
                "wind": "东南风微风",
                "week": "星期六",
                "date": "20170826"
            },
            {
                "temperature": "25℃~37℃",
                "weather": "晴",
                "weather_id": {
                    "fa": "00",
                    "fb": "00"
                },
                "wind": "北风微风",
                "week": "星期日",
                "date": "20170827"
            },
            {
                "temperature": "25℃~37℃",
                "weather": "晴",
                "weather_id": {
                    "fa": "00",
                    "fb": "00"
                },
                "wind": "东风微风",
                "week": "星期一",
                "date": "20170828"
            },
            {
                "temperature": "27℃~37℃",
                "weather": "雷阵雨转多云",
                "weather_id": {
                    "fa": "04",
                    "fb": "01"
                },
                "wind": "东南风微风",
                "week": "星期二",
                "date": "20170829"
            },
            {
                "temperature": "25℃~37℃",
                "weather": "晴",
                "weather_id": {
                    "fa": "00",
                    "fb": "00"
                },
                "wind": "北风微风",
                "week": "星期三",
                "date": "20170830"
            }
        ]
    },
    "error_code": 0
}';
        var_dump(json_decode($weatherForecast, true)['result']);
        $weather = json_decode($weatherForecast, true)['result'];
        $content['weather']['current']['temp'] = $weather['sk']['temp'];
        $content['weather']['current']['windDirection'] = $weather['sk']['wind_direction'];
        $content['weather']['current']['windStrength'] = $weather['sk']['wind_strength'];
        $content['weather']['current']['humidity'] = $weather['sk']['humidity'];
        $content['weather']['current']['time'] = $weather['sk']['time'];

	    $content['weiBoAuthorizeUrl'] = \util\WeiBo::authorize();
//        if ($this->checkLogin()) {
//            $content['member'] = $_SESSION['member'];
//        }
//
	    $this->load->view('header');
	    $this->load->view('welcome', $content);
	    $this->load->view('footer');
	}
}
