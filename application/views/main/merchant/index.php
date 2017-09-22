<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>瑶琳首页</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/ui/myaolin/css/bootstrap.css"/>   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/ui/myaolin/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/ui/myaolin/css/demo.css">
	<link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url() ?>/ui/myaolin/css/style.css">
	<link href="css/css.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>/ui/myaolin/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url() ?>/ui/myaolin/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
    	
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
   			
   		});
   		
    </script>
</head>
<body style="background: #e5e5e5;">
	<!--
    	作者：offline
    	时间：2017-09-06
    	描述：
    
	<a id="a">
	<div class="nav_top">
		<img class="mav_a" src="img/logo.png" />
		<div class="nav_topleft"><a href="#"><img class="mav_b" src="img/nav.png" /></a></div>
		<div class="nav_topright"><a href="#"><img class="mav_b" src="img/ss.png"></a></div>
	</div>
	</a>-->
<a id="a"><div class="top"></div></a>
<nav>
  
  <div id="sideMenu">
	<span class="fa fa-navicon" id="sideMenuClosed"></span>
	
  </div>
  <div class="nav_logo">
  	<img style="width:100px;" src="img/logo.png"  />
  </div>
  <div class="nav_ss"><a href="javascript:void(0);"><img src="img/ss.png" /></a></div>
</nav>


<div id="sideMenuContainer">
  <ul>
  <li><a href="#">首页</a></li>
  <li><a href="#">景点介绍</a></li>
  <li><a href="#">景区相册</a></li>
  <li><a href="#">畅游瑶琳</a></li>
  <li><a href="#">景区资讯</a></li>
  <li><a href="#">写游记(赢奖励)<img src="img/liwu.png"></a></li>
  </ul>
</div>
<div class="login">
    <div class="ss_top">
    	<div class="ss_topa">
    		<div class="ss_topal">
    			<div class="ss_topala">
    				<input type="text" name="textfield" id="textfield" placeholder="搜索景点/酒店/游记" />
    			</div>
    			<div class="ss_topalb">
    				<a href="#"><img src="img/ss.png" /></a>
    			</div>
    		</div>
    		<a href="javascript:void(0);" class="close-login">取消</a>
    	</div>
    </div>
    <div class="del_con">
    	<p><span><a href="#"><img src="img/del.png" /></a></span>历史搜索</p>
    	<ul>
    		<li>仰天洞</li>
    		<li>老屋饭庄</li>
    		<li>路线</li>
    		<li>路线1</li>
    		<li>老屋饭庄</li>
    		<li>路线</li>
    	</ul>
    </div>
</div>

	<!-- banner1-->
	<div class="index_banner">
		<div id="myCarousel" class="carousel slide">
			<!-- 轮播（Carousel）指标 -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- 轮播（Carousel）项目 -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="img/index_banner.jpg" alt="First slide">
					<div class="carousel-caption">2017-07-30 | 第十六届（国际）精功模特大赛选手在瑶琳森林</div>
				</div>
				<div class="item">
					<img src="img/index_banner.jpg" alt="Second slide">
					<div class="carousel-caption">标题 2</div>
				</div>
				<div class="item">
					<img src="img/index_banner.jpg" alt="Third slide">
					<div class="carousel-caption">标题 3</div>
				</div>
			</div>
			
		</div> 

	</div>
	<div class="index_about">
		<img class="ab_img" src="img/index_a.jpg" />
		<p>瑶琳国家森林公园是瑶琳森林公园始建于1993年，2004年通过招商引资，成立桐庐瑶琳森林公园旅游有限公司，2008年12月被国家林业局批准定名为“浙江桐庐瑶琳国家森林公园”，是继桐庐县大奇山国家森林公园后的又一个国家级森林公园，是集溶洞、石
林、密林、古村宅等自然景观和人文景观融合一体的生态型森林公园。</p>
		<img class="a_img" src="img/index_b.jpg" />
	</div>

	<!-- banner2-->
	<div class="index_pin">
		<img class="pin_i" src="img/index_f.jpg"/>

		<div class="pin_ba">
			<div id="myCarouse2" class="carousel slide">
				<!-- 轮播（Carousel）指标 -->
				<ol class="carousel-indicators ca_li">
					<li data-target="#myCarouse2" data-slide-to="0" class="active2"></li>
					<li data-target="#myCarouse2" data-slide-to="1"></li>
					<li data-target="#myCarouse2" data-slide-to="2"></li>
				</ol>
				<!-- 轮播（Carousel）项目 -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="img/index_g.jpg" alt="First slide">
					</div>
					<div class="item">
						<img src="img/index_g.jpg" alt="Second slide">
					</div>
					<div class="item">
						<img src="img/index_g.jpg" alt="Third slide">
					</div>
				</div>

				<!-- 轮播（Carousel）导航
                <a class="carousel-control left" href="#myCarouse2"
                    data-slide="prev">&lsaquo;
                </a>
                <a class="carousel-control right" href="#myCarouse2"
                    data-slide="next">&rsaquo;
                </a>-->
			</div>

		</div>
	</div>

	<div class="index_le">
		<img class="le_a" src="img/index_h.jpg" />
		<div class="le_con">
			<div class="le_left">
				<img src="img/index_i.jpg" />
				<div class="le_pa">景点</div>
				<p class="le_p"><a href="#">老屋饭庄</a></p>
			</div>
			<div class="le_left le_right">
				<img src="img/index_j.jpg" />
				<div class="le_pa">景点</div>
				<p class="le_p"><a href="#">仰天洞</a></p>
			</div>
			<div class="le_left">
				<img src="img/index_k.jpg" />
				<div class="le_pa">景点</div>
				<p class="le_p"><a href="#">小木屋景观</a></p>
			</div>
			<div class="le_left le_right">
				<img src="img/index_l.jpg" />
				<div class="le_pa">景点</div>
				<p class="le_p"><a href="#">天坑树林</a></p>
			</div>
		</div>
		<div class="le_btn"><a href="#">查看更多<img src="img/more.png" /></a></div>
	</div>

	<!-- banner3-->
	<div class="index_you">
		<div class="pin_ba">
			<div id="myCarouse3" class="carousel slide">
				<!-- 轮播（Carousel）指标 -->
				<ol class="carousel-indicators ca_li">
					<li data-target="#myCarouse3" data-slide-to="0" class="active2"></li>
					<li data-target="#myCarouse3" data-slide-to="1"></li>
					<li data-target="#myCarouse3" data-slide-to="2"></li>
				</ol>
				<!-- 轮播（Carousel）项目 -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="img/index_m.jpg" />
						<!-- txt-->
						<div class="item_txt">
							<p class="item_txt_p1">游在瑶琳</p>

							<p class="item_txt_p2"></p>

							<p class="item_txt_p3">尝试一下景区的不同旅行方式吧</p>

							<a href="#" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="img/index_xx.png"></a>
						</div>
					</div>
					<div class="item">
						<img src="img/index_m.jpg" />
					</div>
					<div class="item">
						<img src="img/index_m.jpg" />
					</div>
				</div>

				<!-- 轮播（Carousel）导航
                <a class="carousel-control left" href="#myCarouse2"
                    data-slide="prev">&lsaquo;
                </a>
                <a class="carousel-control right" href="#myCarouse2"
                    data-slide="next">&rsaquo;
                </a>-->
			</div>

		</div>
	</div>

	<div class="index_zx">
		<img class="pin_i" src="img/index_n.jpg" />
		<div class="index_zxcon">
			<div class="zx_left">
				<img src="img/index_c.jpg" />
				<p class="zx_p">瑶琳人间天堂度假村表彰优<br /> 秀员工</p>
				<div class="zx_bot">
					<div class="zx_botleft">
						<p class="l_p">2017-08-03</p>
						<p class="l_p"><img src="img/eye.png" />78人浏览</p>
					</div>
					<div class="zx_botleft zx_botright"><a href="#">了解详情</a></div>
				</div>
			</div>
			<div class="zx_left zx_right">
				<img src="img/index_d.jpg" />
				<p class="zx_p">第十六届（国际）精功模特<br />大赛选手在瑶琳国家森林大赛选手在瑶琳国家森林...</p>
				<div class="zx_bot">
					<div class="zx_botleft">
						<p class="l_p">2017-08-03</p>
						<p class="l_p"><img src="img/eye.png" />78人浏览</p>
					</div>
					<div class="zx_botleft zx_botright"><a href="#">了解详情</a></div>
				</div>
			</div>
			<div class="zx_left">
				<img src="img/index_e.jpg" />
				<p class="zx_p">瑶琳人间天堂度假村表彰优<br /> 秀员工</p>
				<div class="zx_bot">
					<div class="zx_botleft">
						<p class="l_p">2017-08-03</p>
						<p class="l_p"><img src="img/eye.png" />78人浏览</p>
					</div>
					<div class="zx_botleft zx_botright"><a href="#">了解详情</a></div>
				</div>
			</div>
			<div class="zx_left zx_right">
				<img src="img/index_c.jpg" />
				<p class="zx_p">第十六届（国际）精功模特<br />大赛选手在瑶琳国家森林大赛选手在瑶琳国家森林...</p>
				<div class="zx_bot">
					<div class="zx_botleft">
						<p class="l_p">2017-08-03</p>
						<p class="l_p"><img src="img/eye.png" />78人浏览</p>
					</div>
					<div class="zx_botleft zx_botright"><a href="#">了解详情</a></div>
				</div>
			</div>
		</div>
		<div class="le_btn"><a href="#">查看更多<img src="img/index_xx.png" /></a></div>
	</div>
	<div class="index_bg"><img src="img/dbg.png" /></div>
	<footer>
		<img class="foot_logo" src="img/logo.png"  />
		<div class="foot_con">
			<div class="foot_conl">
				<p><a style="padding-right: 10px;" href="#">关于我们</a>| <a style="padding-left: 10px;" href="#">联系我们</a></p>
				<p>总机：0571-69966666<br />电子邮件：qiwei@clubjoin.cn<br />地址：中国浙西桐庐瑶琳国家森林公园景区<br />邮编：050000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <a style="color: #fffc00;" href="#">查看地图>></a></p>
			</div>
			<div class="foot_conr"><img src="img/footer_07.png" /></div>
		</div>
		<div class="foot_p">
			浙ICP备16001322号 版权所有·华映资本管理有限公司<br />Copyright 2005-2016 yaolin.com 浙ICP备16001322号
		</div>
	</footer>
	<div class="foot_nav">
		<div class="foot_navl">
			<a href="#">
				<img src="img/icon_btn_13.png"  />预定
			</a>
		</div>
		<div class="foot_navl foot_navr">
			<a href="#">
				<img src="img/icon_btn_15.png"  />热线
			</a>
		</div>
	</div>
	<div class="index_ftop"><a href="#a"><img src="img/index_top.jpg" /></a></div>
	<script src='js/jquery-2.1.4.min.js'></script>
	<script src='js/velocity.min.js'></script>
	<script src='js/sideToggleExtended.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
		  $('#sideMenu').sideToggle({
			moving: '#sideMenuContainer',
			direction: 'left'
		  });
	
		});
	</script>
	<script src="js/ss.js"></script>
	<script type="text/javascript">
		$(".ca_li").on("click","li",function(){
			$(".ca_li li").removeClass("active2");
			$(this).addClass("active2");
		});
	</script>
</body>
</html>