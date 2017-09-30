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
    <img src="<?php echo base_url() ?>ui/img/mobile/chi_banner.jpg" width="100%" alt=""/>
    <div class="banner_txt_food  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">吃在瑶琳</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="you_fh" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png" style="height:80%;width: 70%"/></a></div>
</div>
	<div class="chi_con">
		 <div class="chi_top">
		 	<p class="chi_p">瑶琳美食 (DELICIOUS FOODS)</p>
		 	<p class="chi_pa">特色小吃是中国饮食不可缺少的一部分，并成为中国饮食生活的主要内容之一。在中国的每个地区都有着其独特的小吃，被称为当地的特色小吃。这种小吃，已经是一种在当地的饮食文化，绝非只是在三餐之间填饱肚子，追求不饿肚子的层次。<br />
瑶琳特色美食将瑶琳文化展现的淋漓尽致，那我们就来看看瑶琳美食吧。</p>
			<img src="<?php echo base_url() ?>ui/img/mobile/chi_1.jpg"  />
		 </div>
		 <div class="chi_meau">
		 	<p class="meau_p">菜单(MENU)</p>
                        <div class="meau_con" style="width:100%; padding: 15px 1%;">
		 		<ul class="meau_ul" id="foods">
                                    <?php foreach ($food['food'] as $k => $v){ ?>
                                        <li>
                                            <img src="<?php echo $v['coverImage'] ?>" style="height:115px;"/>
                                            <p class="mli_p"><a href="#"><?php echo $v['title'] ?></a></p>
                                            <p class="mli_pa"><?php echo $v['description'] ?></p>
		 			                    </li>
                                    <?php } ?>
		 		</ul>
		 	 </div>
             <?php if($num == 1){ ?>
                 <div class="look_more text-center margin-bottom-10 clearfix" style="background:#f8f8f8;">
                     <input id="food" value="1" type="hidden">
                     <button class="flex_box margin-0-auto btn radius-0 size-16" onclick="food()" id="jzgds"><span id="jzgd">加载更多 &nbsp;</span> <img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_03.png" width="13%" alt=""/></button>
                 </div>
             <?php } ?>
		 </div>
		 <div class="chi_zs">
		 	<div id="myCarousel" class="carousel slide">
			    <!-- 轮播（Carousel）指标 -->
			    <ol class="carousel-indicators" style="bottom: 0;">
			        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			        <li data-target="#myCarousel" data-slide-to="1"></li>
			        <li data-target="#myCarousel" data-slide-to="2"></li>
			    </ol>   
			    <!-- 轮播（Carousel）项目 -->
			    <div class="carousel-inner">
			        <div class="item active">
			            <img src="<?php echo base_url() ?>ui/img/mobile/chi_4.jpg" alt="First slide">
			        </div>
			        <div class="item">
			            <img src="<?php echo base_url() ?>ui/img/mobile/chi_4.jpg" alt="Second slide">
			        </div>
			        <div class="item">
			            <img src="<?php echo base_url() ?>ui/img/mobile/chi_4.jpg" alt="Third slide">
			        </div>
			    </div>
			    
			</div>
		 </div>
		 <div class="chi_dc">
		 	<div class="chi_dcl"><img src="<?php echo base_url() ?>ui/img/mobile/chi_dc.jpg" /></div>
		 	<div class="chi_dcr">
		 		<p class="dc_p">瑶琳大厨</p>
		 		<p class="dc_pa">董华建</p>
		 		<p class="dc_pb"> 2000年1月——2017年任职瑶琳国家森林公园行政总厨，期间成功策划过湖南穗满圆大酒店，昆明湘水人家，大连鱼鹅港大饭店等等，并在此间多次参加全国烹饪大赛。</p>
		 	</div>
		 </div>
	</div>
        <script type="text/javascript">
                var url = "<?php echo base_url(); ?>";
                function food() {
                    var p = $('#food').val();
                    var ps = parseInt(p)+1
                    $('#food').val(ps);
                    $.post(url+'food/ajaxFood?p='+ps,function(data){
                        $('#foods').append(data.html);
                        if(data.num == 2){
                            $('#jzgd').html('没有更多了');
                            $('#jzgds').css('background-color','#808080');
                            $("#jzgds").attr("onclick","");
                        }
                    },'json');
                }
        </script>