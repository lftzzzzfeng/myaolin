<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="购票">
    <!-- The styles -->
    <link id="bs-css" href="<?php echo base_url(); ?>ui/css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>ui/css/charisma-app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link href='<?php echo base_url(); ?>ui/plugins/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>ui/plugins/bower_components/jquery/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard-all/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>/ui/plugins/datetimepicker/zh-cn.js"></script>
    <script src="<?php echo base_url();?>/ui/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>/ui/plugins/layui/pop.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/ui/img/favicon.ico">
</head>
<body>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">
    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url()?>admin/home"> <img alt="Charisma Logo" src="<?php echo base_url(); ?>ui/img/logo20.png" class="hidden-xs"/>
            <span>瑶琳</span></a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $username ?></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="<?php echo base_url() ?>admin/home/logout">登出</a></li>
            </ul>
        </div>
        <!-- user dropdown ends -->
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            <li><a href="<?php echo base_url(); ?>" target="_blank"><i class="glyphicon glyphicon-globe"></i>&nbsp;官网</a></li>
        </ul>
    </div>
</div>
<!-- topbar ends -->
<div class="ch-container">
    <div class="row">

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">
                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">目录</li>
                        <li class="<?php echo (($this->router->fetch_class() == 'home') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/home"><i class="glyphicon glyphicon-home"></i><span>&nbsp;仪表盘</span></a></li></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'website') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/website/edit"><i class="glyphicon glyphicon-file"></i><span>&nbsp;网站首页信息</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'news') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/news"><i class="glyphicon glyphicon-edit"></i><span>&nbsp;景区资讯</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'scenicView') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/scenicView"><i class="glyphicon glyphicon-list-alt"></i><span>&nbsp;景点介绍</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'scenicArea') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/scenicArea"><i class="glyphicon glyphicon-globe"></i><span>&nbsp;景区相册</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'food') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/food"><i class="glyphicon glyphicon-cutlery"></i><span>&nbsp;吃在瑶琳</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'accommodationCategory') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/accommodationCategory"><i class="glyphicon glyphicon-tree-deciduous"></i><span>&nbsp;住在瑶琳类别</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'accommodation') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/accommodation"><i class="glyphicon glyphicon-th-list"></i><span>&nbsp;住在瑶琳</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'jotting') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/jotting"><i class="glyphicon glyphicon-envelope"></i><span>&nbsp;游记</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'distributor') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/distributor"><i class="glyphicon glyphicon-qrcode"></i><span>&nbsp;分销商</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'order') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/order"><i class="glyphicon glyphicon-shopping-cart"></i><span>&nbsp;订单</span></a></li>
                        <li class="<?php echo (($this->router->fetch_class() == 'payment') ? "active" : "") ?>"><a href="<?php echo base_url(); ?>admin/payment"><i class="glyphicon glyphicon-lock"></i><span>&nbsp;付款</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->
        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>