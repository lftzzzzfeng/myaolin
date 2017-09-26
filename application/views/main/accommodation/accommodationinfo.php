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
	<div class="jq_banner">
		<img src="<?php echo$accommodationinfo['img'][0] ?>"  />
		<div class="you_fh" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png" style="height:80%;width: 70%"/></a></div>
		
	</div>
	<div class="zhu_con">
		<p class="zhu_p"><?php echo $accommodationinfo['title']; ?></p>
		<p class="zhu_pa"><?php echo $accommodationinfo['description']; ?></p>
                <?php foreach ($accommodationinfo['img'] as $k => $v){ ?>
                    <?php if($k != 0){ ?>
                        <img src="<?php echo $v; ?>"  />
                    <?php } ?>
                <?php } ?>
<!--		<img src="<?php echo base_url() ?>ui/img/mobile/zhu_3.jpg"  />
		<img src="<?php echo base_url() ?>ui/img/mobile/zhu_1.jpg"  />-->
	</div>