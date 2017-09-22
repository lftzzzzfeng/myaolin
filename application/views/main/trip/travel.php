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
   		$(function(){	
			$('.you_con ul li').click(function(){
				$(this).addClass('y_ta').siblings().removeClass('y_ta');
				$('.panesaa>div:eq('+$(this).index()+')').show().siblings().hide();	
			})
		})
    </script>
</head>
<body style="background: #e5e5e5;">
<a id="a"><div class="top"></div></a>
<!--banner-->
<div class="relative">
    <img src="<?php echo base_url() ?>ui/img/mobile/you_banner.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-12 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-18 weight-800 margin-bottom-5 ipad_size">游在瑶琳</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    		
    </div>
   <div class="you_fh" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png" style="height:60%;width: 50%"/></a></div>
		<div class="jq_weather">
			<img src="<?php echo base_url() ?>ui/img/mobile/weathera.png"  />
		</div>

</div>
	<div class="you_con">
		<ul>
			<li class="y_ta">推荐路线</li>
			<li>路线1</li>
			<li>路线2</li>
			<li class="y_r">路线3</li>
		</ul>
	    <div class="panesaa">
			<div class="paness" style="display:block;">
				<p>首先走入的就是索桥，索桥是瑶琳的一个重要景观。站在索桥上，仿佛置身人间仙境。1</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_1.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>穿过索桥进入天坑树林，别有一番特色。停下脚步享受一下他的凉爽。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_2.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>从天坑树林出来，来到月牙湖欣赏一下荷花吧，保您心情舒畅。接天莲叶无穷碧，映日荷花别样红。留下脚印，带走美照！</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_3.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>走了这么长时间，您一定饿了吧，想欣赏美景还能吃到美食那就是老屋了。拍几张老屋的美景，吃饭的心情也会不一样。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_4.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>玩了一天想必您也累了，那就来泡个温泉，做做SPA吧</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_5.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>来别墅舒舒服服睡一觉，明天继续游玩。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_6.jpg"  />
			</div>
			<div class="paness">
				<p>首先走入的就是索桥，索桥是瑶琳的一个重要景观。站在索桥上，仿佛置身人间仙境。2</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_1.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>穿过索桥进入天坑树林，别有一番特色。停下脚步享受一下他的凉爽。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_2.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>从天坑树林出来，来到月牙湖欣赏一下荷花吧，保您心情舒畅。接天莲叶无穷碧，映日荷花别样红。留下脚印，带走美照！</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_3.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>走了这么长时间，您一定饿了吧，想欣赏美景还能吃到美食那就是老屋了。拍几张老屋的美景，吃饭的心情也会不一样。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_4.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>玩了一天想必您也累了，那就来泡个温泉，做做SPA吧</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_5.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>来别墅舒舒服服睡一觉，明天继续游玩。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_6.jpg"  />
			</div>
            <div class="paness">
            	<p>首先走入的就是索桥，索桥是瑶琳的一个重要景观。站在索桥上，仿佛置身人间仙境。3</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_1.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>穿过索桥进入天坑树林，别有一番特色。停下脚步享受一下他的凉爽。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_2.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>从天坑树林出来，来到月牙湖欣赏一下荷花吧，保您心情舒畅。接天莲叶无穷碧，映日荷花别样红。留下脚印，带走美照！</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_3.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>走了这么长时间，您一定饿了吧，想欣赏美景还能吃到美食那就是老屋了。拍几张老屋的美景，吃饭的心情也会不一样。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_4.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>玩了一天想必您也累了，那就来泡个温泉，做做SPA吧</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_5.jpg"  />
				<img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
				<p>来别墅舒舒服服睡一觉，明天继续游玩。</p>
				<img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_6.jpg"  />
            </div>
                <div class="paness">
                    <p>首先走入的就是索桥，索桥是瑶琳的一个重要景观。站在索桥上，仿佛置身人间仙境。4</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_1.jpg"  />
                                    <img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
                                    <p>穿过索桥进入天坑树林，别有一番特色。停下脚步享受一下他的凉爽。</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_2.jpg"  />
                                    <img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
                                    <p>从天坑树林出来，来到月牙湖欣赏一下荷花吧，保您心情舒畅。接天莲叶无穷碧，映日荷花别样红。留下脚印，带走美照！</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_3.jpg"  />
                                    <img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
                                    <p>走了这么长时间，您一定饿了吧，想欣赏美景还能吃到美食那就是老屋了。拍几张老屋的美景，吃饭的心情也会不一样。</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_4.jpg"  />
                                    <img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
                                    <p>玩了一天想必您也累了，那就来泡个温泉，做做SPA吧</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_5.jpg"  />
                                    <img class="pab_img" src="<?php echo base_url() ?>ui/img/mobile/bot_jt.png"  />
                                    <p>来别墅舒舒服服睡一觉，明天继续游玩。</p>
                                    <img class="pa_img" src="<?php echo base_url() ?>ui/img/mobile/you_6.jpg"  />
                </div>
            </div>
	</div>
