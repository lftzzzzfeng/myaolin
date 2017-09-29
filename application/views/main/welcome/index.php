<!-- banner1-->
<div class="index_banner lunbo_one" style="margin-top:70px;">
    <div class="container">
    	<div class="row">
    		<div class="span12">
    			<div class="owl-carousel">
    				<div class="item darkCyan">
    					<img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="Touch">
    				</div>
    				<div class="item forestGreen">
    					<img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="Grab">
    				</div>
    				<div class="item orange">
    					<img src="<?php echo base_url() ?>ui/img/mobile/index_banner.jpg" alt="Responsive">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

<!--文字轮播
<div id="broadcast" class="bar" name="giftactive">
        <div id="demo" style="overflow:hidden;height:22px;line-height:22px;">
          <ul class="mingdan" id="holder">
            <li><a href="#" target="_blank">第十六届（国际）精功模特大赛选手在瑶琳森林公园举行</a></li>
            <li><a href="#" target="_blank">标题 2</a></li>
            <li><a href="#" target="_blank">标题 3</a></li>
          </ul>
        </div>
      </div>

</div>
-->

<div class="index_about">
    <img class="ab_img" src="<?php echo base_url() ?>ui/img/mobile/index_a.jpg" />
    <p><?php echo $website['content']; ?></p>
    <img class="a_img" src="<?php echo $website['backgroundImage']; ?>" />
</div>

<!-- banner2-->
<div class="index_pin">
    <img class="pin_i" src="<?php echo base_url() ?>ui/img/mobile/index_f.jpg"/>

    <div class="pin_ba">
        <div class="index_banner">
        	<div class="container2">
        		<div class="row">
        			<div class="span12">
        				<div class="owl-carousel">

                        <?php foreach ($scenicAreaResult['scenicAreaImages'] as $k => $v){ ?>
        					<div class="item">
        						<img src="<?php echo $v['image'] ?>" alt="Touch" style="width:100%;">
        					</div>
        				<?php } ?>

        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>

<div class="index_le">
    <img class="le_a" src="<?php echo base_url() ?>ui/img/mobile/index_h.jpg" />
    <div class="le_con">
        <?php foreach ($scenicViews as $k => $v){ ?>
            <div class="le_left">
                <img src="<?php echo $v['coverImage'] ?>" style="height: 160px;" />
                <div class="le_pa">景点</div>
                <p class="le_p"><a><?php echo $v['title'] ?></a></p>
            </div>
        <?php } ?>
    </div>
    <div class="le_btn"><a href="<?php echo base_url(); ?>scenicview">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/index_xx.png" /></a></div>
</div>

<!-- banner3-->
<div class="index_you">
    <div class="pin_ba">
        <div class="index_banner">
        		<div  class="container3">
        			<div class="owl-carousel">
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_1.jpg" />
        					<!-- txt-->
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">游在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">尝试一下景区的不同旅行方式吧</p>

        						<a href="<?php echo base_url() ?>trip/travel" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
        				</div>
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_2.jpg" />
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">吃在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">快来瞧瞧景区的风味美食</p>

        						<a href="<?php echo base_url() ?>food" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
        				</div>
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_3.jpg" />
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">住在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">暂不开放</p>

        						<a href="<?php echo base_url() ?>accommodation" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
        				</div>
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_4.jpg" />
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">行在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">去景区的几种路线方式</p>

        						<a href="<?php echo base_url() ?>routes" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
        				</div>
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_5.jpg" />
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">购在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">暂不开放</p>

        						<a href="<?php echo base_url() ?>shopping" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
        				</div>
        				<div class="item">
        					<img src="<?php echo base_url() ?>ui/img/mobile/cy_6.jpg" />
        					<div class="item_txt" style="top:8%;">
        						<p class="item_txt_p1">娱在瑶琳</p>

        						<p class="item_txt_p2"></p>

        						<p class="item_txt_p3" style="font-size: 13px;">快来享受吧</p>

        						<a href="<?php echo base_url() ?>entertainment" class="item_txt_btn">查看详情 &nbsp;<img style="width:20px;" src="<?php echo base_url() ?>ui/img/mobile/index_xx.png"></a>
        					</div>
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
                <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><img src="<?php echo $v['coverImage'];?>" style="width:100%;" /></a>
                <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><p class="zx_p"><?php echo $v['title']; ?><br/><?php echo $v['description']; ?></p></a>
                <div class="zx_bot">
                    <div class="zx_botleft">
                        <p class="l_p"><?php echo $v['publishedTimestamp']; ?></p>
                        <p class="l_p"><img src="<?php echo base_url() ?>ui/img/mobile/eye.png" /><?php echo $v['hits']; ?></p>
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

    //轮播
    $(document).ready(function($) {
    	$(".owl-carousel").owlCarousel({
    	itemsMobile:[479,1],
    	itemsTablet:[768,1],
    	navigation:true,
    	autoPlay:3000
    	});
    });

    //文字滚动轮播
//    function AutoScroll(obj) {
//        $(obj).find("ul:first").animate({
//            marginTop: "-22px"
//        },
//        500,
//        function() {
//            $(this).css({
//                marginTop: "0px"
//            }).find("li:first").appendTo(this);
//        });
//    }
//    $(document).ready(function() {
//        setInterval('AutoScroll("#demo")', 3000)
//    });
</script>
