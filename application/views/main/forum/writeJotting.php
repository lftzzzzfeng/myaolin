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
                
                 function submits(){
                    $('#forms').submit();
                }
    </script>
</head>
<body style="background: #fff;">
<a id="a"><div class="top"></div></a>
<div class="yj_top" style="background: #f8f8f8;">
	<p>写游记</p>
	<div class="yj_left" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/yj_fh.png" style="height:80%;width: 70%"/></a></div>
	<div class="yj_righta" onclick="submits()"><a class="yj_f">发送</a></div>
</div>
<div class="yjx_con">
    <form action="<?php echo base_url(); ?>forum/addJotting" method="post" name="comment" id="forms" enctype="multipart/form-data">
	<input type="text" name="title" id="textfield" placeholder="标题" />
	<div class="yjx_cona">
		<textarea name="content" id="textarea" cols="45" rows="5" placeholder="说点什么吧......"></textarea>
		<div id="fileList"></div>
		<div class="yj_sc" style="background:url('<?php echo base_url();?>ui/img/mobile/pic.png') no-repeat;background-size:58% 48%;margin-left:2%;margin-top:2%; ">
        	<input type="file" id="fileElem" name="images[]" onchange="handleFiles(this)" style="height: 48px;left: 0;opacity: 0;top: 0;width: 58%;z-index: 2; margin: 0px 0px;"/>
		</div>
	</div>
    </form>
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
<script>
	window.URL = window.URL || window.webkitURL;
	var fileElem = document.getElementById("fileElem"),
		fileList = document.getElementById("fileList");
	function handleFiles(obj) {
		var div = $(obj).parent();
		var newdiv = div.clone();
		div.after(newdiv);
		div.css('display','none');
		var files = obj.files,
			img = new Image();
		if(window.URL){
			//File API
			img.src = window.URL.createObjectURL(files[0]); //创建一个objectURL，并不是你的本地路径
			img.width = 60;
			img.style='margin-left:2%;';
			img.onload = function(e) {
				window.URL.revokeObjectURL(this.src); //图片加载后，释放object URL
			}
			fileList.appendChild(img);
		}else if(window.FileReader){
			//opera不支持createObjectURL/revokeObjectURL方法。我们用FileReader对象来处理
			var reader = new FileReader();
			reader.readAsDataURL(files[0]);
			reader.onload = function(e){
				alert(files[0].name + "," +e.total + " bytes");
				img.src = this.result;
				img.width = 60;
				img.style='margin-left:2%;';
				fileList.appendChild(img);
			}
		}else{
			//ie
			obj.select();
			obj.blur();
			var nfile = document.selection.createRange().text;
			document.selection.empty();
			img.src = nfile;
			img.width = 60;
			img.style='margin-left:2%;';
			img.onload=function(){
				alert(nfile+","+img.fileSize + " bytes");
			}
			fileList.appendChild(img);
		}
	}
</script>
</html>