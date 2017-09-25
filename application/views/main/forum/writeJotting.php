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
	<div class="yj_left" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/yj_fh.png" style="height:60%;width: 50%"/></a></div>
	<div class="yj_righta"><a class="yj_f" href="#">发送</a></div>
</div>
<div class="yjx_con">
    <form>
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
</body>
</html>