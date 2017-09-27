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
        <nav>

          <div id="sideMenu">
                <span class="fa fa-navicon" id="sideMenuClosed"></span>

          </div>
          <div class="nav_logo">
                <img style="width:100px;" src="<?php echo base_url() ?>ui/img/mobile/logo.png"  />
          </div>
          <div class="nav_ss"><a href="javascript:void(0);"><img src="<?php echo base_url() ?>ui/img/mobile/ss.png" /></a></div>
        </nav>


        <div id="sideMenuContainer">
          <ul>
          <li><a href="<?php echo base_url() ?>">首页</a></li>
          <li><a href="<?php echo base_url() ?>scenicview">景点介绍</a></li>
          <li><a href="<?php echo base_url() ?>scenicarea">景区相册</a></li>
          <li><a href="<?php echo base_url() ?>trip">畅游瑶琳</a></li>
          <li><a href="<?php echo base_url() ?>news">景区资讯</a></li>
          <li><a href="<?php echo base_url() ?>forum">写游记(赢奖励)<img src="<?php echo base_url() ?>ui/img/mobile/liwu.png"></a></li>
          </ul>
        </div>
        <div class="login">
            <div class="ss_top">
                <div class="ss_topa">
                    <form action="<?php echo base_url(); ?>Welcome/search" method="post" id="forms">
                        <div class="ss_topal">
                                <div class="ss_topala">
                                        <input type="text" name="search" value="" id="textfield" placeholder="搜索景点/咨询" />
                                </div>
                                <div class="ss_topalb">
                                        <a onclick="$('#forms').submit();"><img src="<?php echo base_url() ?>ui/img/mobile/ss.png" /></a>
                                </div>
                        </div>
                    </form>
                    <a href="javascript:void(0);" class="close-login">取消</a>
                </div>
            </div>
<!--            <div class="del_con">-->
<!--                <p><span><a href="#"><img src="--><?php //echo base_url() ?><!--ui/img/mobile/del.png" /></a></span>历史搜索</p>-->
<!--                <ul>-->
<!--                        <li>仰天洞</li>-->
<!--                        <li>老屋饭庄</li>-->
<!--                        <li>路线</li>-->
<!--                        <li>路线1</li>-->
<!--                        <li>老屋饭庄</li>-->
<!--                        <li>路线</li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>