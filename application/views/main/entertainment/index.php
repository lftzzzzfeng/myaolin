<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/bootstrap.css"/>   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/demo.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/style.css">
    <link href="<?php echo base_url() ?>ui/css/mobile/css.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/essentials.css"/>   
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/photoswipe.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/default-skin.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/jd.css"/>
        
    <script src="<?php echo base_url() ?>ui/js/mobile/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/bootstrap.min.js"></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/jquery-2.1.4.min.js'></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/velocity.min.js'></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/sideToggleExtended.js'></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/ss.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/photoswipe.min.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/photoswipe-ui-default.min.js"></script>
    <script type="text/javascript">
    	
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
   			
   		});
   		
    </script>
</head>
<body style="background: #e5e5e5;">
<a id="a"><div class="top"></div></a>
<!--banner-->
<div class="relative">
    <img src="<?php echo base_url() ?>ui/img/mobile/yu_banner.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">娱在瑶琳</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    		
    </div>
   <div class="you_fh" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png" style="height:80%;width: 70%"/></a></div>
		<div class="jq_weather">
			<img src="<?php echo base_url() ?>ui/img/mobile/weathera.png"  />
		</div>

    </div>
	<div class="yu_con">
		<div class="yu_top">
			<div class="yu_topl">
				<p class="tl_p">景区会所</p>
				<p class="tl_pa">Scenic Club</p>
				<p class="tl_pb">可供大家放松娱乐</p>
			</div>
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_6.jpg"  />
		</div>
		<div class="yu_cona">
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_1.jpg"  />
			<div class="yu_aleft"><p>夜晚来会所玩一圈<br /> 缓解一天的疲劳<br /> 喝杯红酒 <br />结识四面八方的朋友<br /> 保你不虚此行</p></div>
		</div>
		<div class="yu_cona">
			<div class="yu_aleft"><p>夜晚来会所玩一圈<br /> 缓解一天的疲劳<br /> 喝杯红酒 <br />结识四面八方的朋友<br /> 保你不虚此行</p></div>
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_1.jpg"  />
		</div>
		<div class="yu_top yu_topa">
			<div class="yu_topla" style="right: 0;">
				<p class="tl_p">汤泉中心</p>
				<p class="tl_pa">The hot spring center</p>
				<p class="tl_pb">汤泉区分为：浪漫休 闲区、美容香薰养颜 区、特色汤泉区、娱 乐游戏动感区、御医 养生区。</p>
			</div>
			<img style="float: left;" src="<?php echo base_url() ?>ui/img/mobile/yu_6.jpg"  />
		</div>
		<div class="yu_cona">
			<div class="yu_aleft"><p>夜晚来会所玩一圈<br /> 缓解一天的疲劳<br /> 喝杯红酒 <br />结识四面八方的朋友<br /> 保你不虚此行</p></div>
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_1.jpg"  />
		</div>
		<div class="yu_cona">
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_2.jpg"  />
			<div class="yu_aleft">
				<p class="ya_p">美容香薰养颜区</p>
				<p>旅游之余 <br>别忘了保养自己</p>
			</div>
		</div>
		<div class="yu_cona">
			
			<div class="yu_aleft">
				<p class="ya_p">特色汤泉区</p>
				<p>来泡会儿温泉吧 <br>赶走一身疲劳</p>
			</div>
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_3.jpg"  />
		</div>
		<div class="yu_cona">
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_4.jpg"  />
			<div class="yu_aleft">
				<p class="ya_p">娱乐游戏动感区</p>
				<p>来游戏区玩会吧 <br> 释放天性 <br>嗨到爆</p>
			</div>
		</div>
		<div class="yu_cona">
			
			<div class="yu_aleft">
				<p class="ya_p">御医养生区</p>
				<p>来泡会儿温泉吧 <br>赶走一身疲劳</p>
			</div>
			<img src="<?php echo base_url() ?>ui/img/mobile/yu_5.jpg"  />
		</div>
	</div>