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
    <img src="<?php echo base_url() ?>ui/img/mobile/zhu_banner.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-12 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-18 weight-800 margin-bottom-5 ipad_size">住在瑶琳</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="you_fh"  onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png"  style="height:80%;width: 70%"/></a></div>
		<div class="jq_weather">
			<img src="<?php echo base_url() ?>ui/img/mobile/weathera.png"  />
		</div>

</div>
	<div class="zhu_con zhuz_con">
            <?php foreach ($accommodation as $k => $v){ ?>
                <?php if(!empty($v['items'])){ ?>
                    <div class="zhu_a">
                            <p class="zhu_ap"><?php echo $v['title']; ?></p>
                            <p class="zhu_spa">房间类型（ROOM TYPE）</p>
                            <div class="zhu_bab">
                                    <div id="myCarousel" class="carousel slide">
                                            <div class="carousel-inner">
                                                <?php foreach ($v['items'] as $k2 => $v2){ ?>
                                                    <?php if($k2 == 0){ ?>
                                                        <div class="item active zhu_l">
                                                                <img src="<?php echo $v2['images'][0]['image']; ?>" alt="First slide" style="height:245px;">
                                                                <div class="zhu_la">
                                                                        <div class="zhu_lac">
                                                                                <p class="zhu_hh"><?php echo $v2['title']; ?></p>
                                                                                <p class="zhu_hha"><?php echo $v2['description']; ?></p>
                                                                        </div>
                                                                        <a href="<?php echo base_url() ?>accommodation/accommodationinfo?id=<?php echo $v2['id']; ?>" class="zhu_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                                                                </div>
                                                         </div>
                                                    <?php }else{ ?>
                                                         <div class="item">
                                                                <img src="<?php echo $v2['images'][0]['image']; ?>" alt="Second slide"  style="height:245px;">
                                                                <div class="zhu_la">
                                                                        <div class="zhu_lac">
                                                                                <p class="zhu_hh"><?php echo $v2['title']; ?></p>
                                                                                <p class="zhu_hha"><?php echo $v2['description']; ?></p>
                                                                        </div>
                                                                        <a href="<?php echo base_url() ?>accommodation/accommodationinfo?id=<?php echo $v2['id']; ?>" class="zhu_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                                                                </div>
                                                         </div>
                                                    <?php } ?>
                                                 <?php } ?>
                                            </div>
                                            <!-- 轮播（Carousel）导航 -->
                                            <a class="carousel-control left" href="#myCarousel" 
                                               data-slide="prev"><img src="<?php echo base_url() ?>ui/img/mobile/pr.png" /></a>
                                            <a class="carousel-control right" href="#myCarousel" 
                                               data-slide="next"><img src="<?php echo base_url() ?>ui/img/mobile/ne.png" /></a>
                                    </div> 
                            </div>
                            <p class="zhu_spa">特殊提供（OFFER SPECIALLY）</p>
                            <div class="zhu_bb">
                                    <ul>
                                        <?php foreach ($v['images'] as $k1 => $v1){ ?>
                                            <li>
                                                <img src="<?php echo $v1['image'] ?>" style="height:106px;"/>
                                                <p><?php echo $v1['title'] ?></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                            </div>
                    </div>
                <?php } ?>
            <?php } ?>
	</div>