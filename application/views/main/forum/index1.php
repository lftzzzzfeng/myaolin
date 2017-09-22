<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>写游记</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/essentials.css"/>    
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/jd.css"/>
    <link href="<?php echo base_url() ?>ui/css/mobile/css.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/demo.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/style.css">
	<script src="<?php echo base_url() ?>ui/js/mobile/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
    	
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
   			
   		});
   		function add_img(obj,checkbox){
			if(obj.style.background){
				obj.style.background = "";
				obj.style.border = "";
				document.getElementById(checkbox).checked = false;
			}else{
				obj.style.background = "url(<?php echo base_url() ?>ui/img/mobile/x_sina.png) bottom right no-repeat";
				obj.style.border = "";
				document.getElementById(checkbox).checked = true;
			}
		}
   		function add_imga(obj,checkbox){
			if(obj.style.background){
				obj.style.background = "";
				obj.style.border = "";
				document.getElementById(checkbox).checked = false;
			}else{
				obj.style.background = "url(<?php echo base_url() ?>ui/img/mobile/x_weixin.png) bottom right no-repeat";
				obj.style.border = "";
				document.getElementById(checkbox).checked = true;
			}
		}
   		function add_imgb(obj,checkbox){
			if(obj.style.background){
				obj.style.background = "";
				obj.style.border = "";
				document.getElementById(checkbox).checked = false;
			}else{
				obj.style.background = "url(<?php echo base_url() ?>ui/img/mobile/x_py.png) bottom right no-repeat";
				obj.style.border = "";
				document.getElementById(checkbox).checked = true;
			}
		}
    </script>
</head>
<body style="background: #fff;">
<a id="a"><div class="top"></div></a>
<div class="yj_top" style="background: #f8f8f8;">
	<p>写游记</p>
        <div class="yj_left"><a onclick="window.history.go(-1);"><img src="<?php echo base_url() ?>ui/img/mobile/yj_fh.png" /></a></div>
	<div class="yj_righta"><a class="yj_f" href="#">发送</a></div>
</div>
<div class="yjx_con">
	<input type="text" name="textfield" id="textfield" placeholder="标题" />
	<div class="yjx_cona">
		<textarea name="textarea" id="textarea" cols="45" rows="5" placeholder="说点什么吧......"></textarea>
		<div class="yj_sc"><a href="#"><img src="<?php echo base_url() ?>ui/img/mobile/pic.png" /></a></div>
	</div>
	<div class="yjx_conb">
		<p>同步到：</p>
		<ul>
			
			<li>
				<input name="checkbox1" class="input_class" id="checkbox_1" type="checkbox">
      			<div class="checkboxborderm" onClick="add_img(this,'checkbox_1')"></div>
			</li>
			<li>
				<input name="checkbox1" class="input_class" id="checkbox_1" type="checkbox">
      			<div class="checkboxborderma" onClick="add_imga(this,'checkbox_1')"></div>
			</li>
			<li>
				<input name="checkbox1" class="input_class" id="checkbox_1" type="checkbox">
      			<div class="checkboxbordermb" onClick="add_imgb(this,'checkbox_1')"></div>
			</li>
		</ul>
	</div>
</div>





	
	
	
	<!--
    	作者：offline
    	时间：2017-09-12
    	描述：
    
	<div class="index_bg"><img src="<?php echo base_url() ?>ui/img/mobile/dbg.png" /></div>
	<footer>
		<img class="foot_logo" src="<?php echo base_url() ?>ui/img/mobile/logo.png"  />
		<div class="foot_con">
			<div class="foot_conl">
				<p><a style="padding-right: 10px;" href="#">关于我们</a>| <a style="padding-left: 10px;" href="#">联系我们</a></p>
				<p>总机：0571-69966666<br />电子邮件：qiwei@clubjoin.cn<br />地址：中国浙西桐庐瑶琳国家森林公园景区<br />邮编：050000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <a style="color: #fffc00;" href="#">查看地图>></a></p>
			</div>
			<div class="foot_conr"><img src="<?php echo base_url() ?>ui/img/mobile/footer_07.png" /></div>
		</div>
		<div class="foot_p">
			浙ICP备16001322号 版权所有·华映资本管理有限公司<br />Copyright 2005-2016 yaolin.com 浙ICP备16001322号
		</div>
	</footer>
	<div class="foot_nav">
		<div class="foot_navl">
			<a href="#">
				<img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_13.png"  />预定
			</a>
		</div>
		<div class="foot_navl foot_navr">
			<a href="#">
				<img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_15.png"  />热线
			</a>
		</div>
	</div>
	<div class="index_ftop"><a href="#a"><img src="<?php echo base_url() ?>ui/img/mobile/index_top.jpg" /></a></div>
	-->
	
	
	

    <script src="<?php echo base_url() ?>ui/js/mobile/bootstrap.min.js"></script>

	<script src='<?php echo base_url() ?>ui/js/mobile/sideToggleExtended.js'></script>

</body>
</html>