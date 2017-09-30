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
    <img src="<?php echo $item['coverImage']; ?>" style="height:225px;width:100%;" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">资讯详情</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="you_fh" onclick="window.history.go(-1);"><a><img src="<?php echo base_url() ?>ui/img/mobile/fanhui.png" style="height:80%;width: 70%" /></a></div>

</div>
	<div class="xq_con">
		<div class="xq_top">
			<p class="xq_p"><?php echo $item['title']; ?></p>
			<p class="xq_pa">发布日期：<?php echo date('Y-m-d',$item['publishedTimestamp']); ?>  浏览数：<?php echo $item['hits']; ?></p>
		</div>		
                <span style="color: #555;padding:0 15px;"><p><?php echo $item['content']; ?></p></span>
		<div class="xq_share">
                    <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>	
		</div>
		<div class="xq_ne">
                    <?php if($item['UpDown']['upper']['title'] != ''){ ?>
			<p class="xq_nep">上一篇：<a href="<?php echo base_url() ?>news/detail?id=<?php echo $item['UpDown']['upper']['id']; ?>"><?php echo $item['UpDown']['upper']['title']; ?></a></p>
                    <?php } ?>
                    <?php if($item['UpDown']['lower']['title'] != ''){ ?>
                        <p class="xq_nepa">下一篇：<a href="<?php echo base_url() ?>news/detail?id=<?php echo $item['UpDown']['lower']['id']; ?>"><?php echo $item['UpDown']['lower']['title']; ?></a></p>
                    <?php } ?>
		</div>
	</div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","twi","linkedin","h163","evernotecn","copy","print"],"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
