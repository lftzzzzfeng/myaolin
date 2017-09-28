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
                <img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="First slide">
                <div class="carousel-caption">第十六届（国际）精功模特大赛选手在瑶琳森林公园举行</div>
            </div>
            <div class="item">
                <img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="Second slide">
                <div class="carousel-caption">标题 2</div>
            </div>
            <div class="item">
                <img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="Third slide">
                <div class="carousel-caption">标题 3</div>
            </div>
        </div>
			
    </div>

</div>
<div class="index_about">
    <img class="ab_img" src="<?php echo base_url() ?>ui/img/mobile/index_a.jpg" />
    <p><?php echo $website['content']; ?></p>
    <img class="a_img" src="<?php echo $website['backgroundImage']; ?>" />
</div>

<!-- banner2-->
<div class="index_pin">
    <img class="pin_i" src="<?php echo base_url() ?>ui/img/mobile/index_f.jpg"/>

    <div class="pin_ba">
        <div id="myCarouse2" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators ca_li">
                <?php foreach ($scenicAreaResult['scenicAreaImages'] as $k => $v){ ?>
                    <?php if($k == 0){ ?>
                        <li data-target="#myCarouse2" data-slide-to="<?php echo $k; ?>" class="active2"></li>
                    <?php }else{ ?>
                        <li data-target="#myCarouse2" data-slide-to="<?php echo $k; ?>"></li>
                    <?php } ?>
                <?php } ?>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <?php foreach ($scenicAreaResult['scenicAreaImages'] as $k => $v){ ?>
                    <?php if($k == 0){ ?>
                        <div class="item active">
                            <img src="<?php echo $v['image'] ?>" alt="Third slide" style="height:280px;">
                        </div>
                    <?php }else{ ?>
                        <div class="item">
                            <img src="<?php echo $v['image'] ?>" alt="Third slide" style="height:280px;">
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="index_le">
    <img class="le_a" src="<?php echo base_url() ?>ui/img/mobile/index_h.jpg" />
    <div class="le_con">
        <?php foreach ($scenicViews as $k => $v){ ?>
            <div class="le_left le_right" style="padding-right:10px;padding-bottom:5px;">
                <img src="<?php echo $v['coverImage'] ?>" style="height: 160px;" />
                <div class="le_pa">景点</div>
                <p class="le_p"><a><?php echo $v['title'] ?></a></p>
            </div>
        <?php } ?>
    </div>
    <div class="le_btn"><a href="<?php echo base_url(); ?>scenicview">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/more.png" /></a></div>
</div>

<!-- banner3-->
<div class="index_you">
    <div class="pin_ba">
        <div id="myCarouse3" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators ca_li" style="margin-bottom: -6px;">
                <li data-target="#myCarouse3" data-slide-to="0" class="active2"></li>
                <li data-target="#myCarouse3" data-slide-to="1"></li>
                <li data-target="#myCarouse3" data-slide-to="2"></li>
                <li data-target="#myCarouse3" data-slide-to="3"></li>
                <li data-target="#myCarouse3" data-slide-to="4"></li>
                <li data-target="#myCarouse3" data-slide-to="5"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_1.jpg" />
                    <!-- txt-->
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">游在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">尝试一下景区的不同旅行方式吧</p>

                        <a href="<?php echo base_url() ?>trip/travel" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_2.jpg" />
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">吃在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">快来瞧瞧景区的风味美食</p>

                        <a href="<?php echo base_url() ?>food" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_3.jpg" />
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">住在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">暂不开放</p>

                        <a href="<?php echo base_url() ?>accommodation" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_4.jpg" />
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">行在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">去景区的几种路线方式</p>

                        <a href="<?php echo base_url() ?>routes" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_5.jpg" />
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">购在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">暂不开放</p>

                        <a href="<?php echo base_url() ?>shopping" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>ui/img/mobile/cy_6.jpg" />
                    <div class="item_txt" style="top:8%;">
                        <p class="item_txt_p1">娱在瑶琳</p>

                        <p class="item_txt_p2"></p>

                        <p class="item_txt_p3">快来享受吧</p>

                        <a href="<?php echo base_url() ?>entertainment" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="index_zx">
    <img class="pin_i" src="<?php echo base_url() ?>ui/img/mobile/index_n.jpg" />
    <div class="index_zxcon">
        <?php foreach ($news as $k => $v){ ?>
            <div class="zx_left">
                <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><img src="<?php echo $v['coverImage'];?>" style="height:160px;" /></a>
                <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><p class="zx_p"><?php echo $v['title']; ?><br/><?php echo $v['description']; ?></p></a>
                <div class="zx_bot">
                    <div class="zx_botleft">
                        <p class="l_p"><?php echo $v['publishedTimestamp']; ?></p>
                        <p class="l_p"><img src="<?php echo base_url() ?>ui/img/mobile/eye.png" /><?php echo $v['hits']; ?>人浏览</p>
                    </div>
                    <div class="zx_botleft zx_botright"><a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>">了解详情</a></div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="le_btn"><a href="<?php echo base_url(); ?>news">查看更多<img src="<?php echo base_url() ?>ui/img/mobile/index_xx.png" /></a></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#sideMenu').sideToggle({
            moving: '#sideMenuContainer',
            direction: 'left'
        });
	
    });
</script>
<script type="text/javascript">
    $(".ca_li").on("click","li",function(){
        $(".ca_li li").removeClass("active2");
        $(this).addClass("active2");
    });
</script>
