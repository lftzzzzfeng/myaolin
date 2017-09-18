<div class="index_banner">
    <section class="cd-hero">
        <ul class="cd-hero-slider"><!-- autoplay -->
            <li class="selected"><!-- cd-bg-video -->
                <div class="cd-full-width">
                    <h2>瑶琳国家森林公园</h2>
                    <p></p>
                </div>
                <div class="cd-bg-video-wrapper" data-video="ui/assets/video/video"></div>
            </li>
            <li style="background-image: url(<?php echo base_url() . 'ui/img/main/bg1.jpg' ?>);">
                <div class="cd-full-width">
                    <h2>瑶琳国家森林公园</h2>
                    <p>住过瑶琳的青春才完整，在爱的驿站等待属于你的未来。</p>
                    <!--<a  class="cd-btn">查看更多</a>-->
                </div>
            </li>
        </ul>
        <div class="cd-slider-nav">
<!--            <nav>-->
<!--                <span class="cd-marker item-1"></span>-->
<!--                <ul>-->
<!--                    <li class="selected"><a href="#0">介绍</a></li>-->
<!--                    <li><a href="#0">生活</a></li>-->
<!--                </ul>-->
<!--            </nav>-->
        </div>
    </section>
</div>
<div class="index_about">
    <div class="index_aboutc">
        <img class="a_img" src="<?php echo base_url() ?>ui/img/main/index_about.png" />
        <p><?php echo $website['content'] ?></p>
        <img src="<?php echo $website['backgroundImage'] ?>" class="a_imga" />
    </div>
</div>
<div class="index_pin">
    <img class="p_img" src="<?php echo base_url() ?>ui/img/main/index_pin.png" />
<?php if ($scenicAreaResult): ?>
    <div class="pin_img">
        <div class="panes">
    <?php if (isset($scenicAreaResult['scenicAreaImages'])): ?>
        <?php foreach ($scenicAreaResult['scenicAreaImages'] as $key => $scenicAreaImage) :?>
            <?php if ($key == 0): ?>
            <div class="pane" style="display:block;">
                <div class="p_img">
                    <img src="<?php echo $scenicAreaImage['image'] ?>" style="width:835px;height: 440px" />
                </div>
                <img src="<?php echo $scenicAreaResult['scenicArea']['coverImage'] ?>" style="width: 364px; height: 440px" />
            </div>
            <?php else: ?>
            <div class="pane">
                <div class="p_img">
                    <img src="<?php echo $scenicAreaImage['image'] ?>" style="width: 224px; height: 150px" />
                </div>
                <img src="<?php echo $scenicAreaResult['scenicArea']['coverImage'] ?>" style="width: 364px; height: 440px" />
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
        </div>
        <ul>
    <?php if (isset($scenicAreaResult['scenicAreaImages'])): ?>
        <?php foreach ($scenicAreaResult['scenicAreaImages'] as $key => $scenicAreaImage) :?>
            <?php if ($key == 0) :?>
            <li class="hit"><img src="<?php echo $scenicAreaImage['image'] ?>"></li>
            <?php elseif ($key > 0 && $key < count($scenicAreaResult['scenicAreaImages'])): ?>
            <li><img src="<?php echo $scenicAreaImage['image'] ?>"></li>
            <?php else: ?>
            <li class="hits"><img src="<?php echo $scenicAreaImage['image'] ?>"></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>
</div>
<div class="index_le">
    <div class="index_lecon">
        <img class="le_img" src="<?php echo base_url() ?>ui/img/main/index_le.png" />
        <div class="le_dimg">
<?php if (count($scenicViews) > 0) :?>
    <?php foreach ($scenicViews as $scenicView): ?>
            <div class="le_li">
                <img src="<?php echo $scenicView['coverImage'] ?>" style="width: 400px; height: 300px;" />
                <div class="le_dimga" style="top: 0; opacity: 0;">
                    <p class="le_dt"><?php echo $scenicView['title'] ?></p>
                    <p class="le_dta"><?php echo $scenicView['description'] ?></p>
                    <div class="le_btn">
                        <a href="<?php echo base_url() . 'scenicView' ?>">查看更多<img src="<?php echo base_url() ?>ui/img/main/le_btn.png" /></a>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
<?php endif; ?>
        </div>
        <div class="ple_btn"><a href="<?php echo base_url() . 'scenicView' ?>">查看更多<img src="<?php echo base_url() ?>ui/img/main/jiantou.png" /></a></div>
    </div>
</div>
<div class="index_you">
    <div class="callbacks_container">
        <ul class="rslides" id="slider">
            <li>
                <a href="<?php echo base_url() . 'trip/travel' ?>">
                    <img src="<?php echo base_url() ?>ui/img/main/index_you.jpg" alt="">
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'food' ?>">
                    <img src="<?php echo base_url() ?>ui/img/main/index_you1.jpg" alt="">
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'accommodation' ?>">
                    <img src="<?php echo base_url() ?>ui/img/main/index_you2.jpg" alt="">
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'trip/routes' ?>">
                    <img src="<?php echo base_url() ?>ui/img/main/index_you3.jpg" alt="">
                </a>
            </li>
<!--            <li>-->
<!--                <a href="--><?php //echo base_url() . 'shopping' ?><!--">-->
<!--                    <img src="--><?php //echo base_url() ?><!--ui/img/main/index_you4.jpg" alt="">-->
<!--                </a>-->
<!--            </li>-->
            <li>
                <a href="<?php echo base_url() . 'entertainment' ?>">
                    <img src="<?php echo base_url() ?>ui/img/main/index_you5.jpg" alt="">
                </a>
            </li>
        </ul>
    </div>
</div>
<?php if (count($news) > 0): ?>
<div class="index_zx">
    <img class="index_zxa" src="<?php echo base_url() ?>ui/img/main/index_zz.png" />
    <ul class="inzx_li">
    <?php foreach ($news as $key => $new): ?>
        <li class="<?php echo ($key == 2 ? 'li_li' : '' ) ?>">
            <img src="<?php echo $new['coverImage'] ?>" style="width: 384px; height: 258px;" />
            <p class="l_p"><a href="<?php echo (base_url() . 'news/detail/' . $new['id']) ?>"><?php echo $new['title'] ?></a></p>
            <div class="li_z">
                <div class="li_zl">
                    <p class="l_pp"><?php echo $new['publishedTimestamp'] ?></p>
<!--                    <p class="l_pp"><img src="--><?php //echo base_url() ?><!--ui/img/main/eye.png">78人浏览</p>-->
                </div>
                <div class="li_zl"><a href="<?php echo (base_url() . 'news/detail/' . $new['id']) ?>">了解详情</a></div>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
    <div class="ple_btn"><a href="<?php echo (base_url() . 'news') ?>">查看更多<img src="<?php echo base_url() ?>ui/img/main/jiantou.png" /></a></div>
</div>
<?php endif; ?>
<div class="index_bg"></div>
<script type="text/javascript">
    $(function () {
        // Slideshow
        $("#slider").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 500,
            timeout:4000,
            pager: true,
            pauseControls: true,
            namespace: "callbacks"
        });
    });
</script>
<script type="text/javascript">
    $(function(){
        $('.pin_img ul li').click(function(){
            $(this).addClass('hit').siblings().removeClass('hit');
            $('.panes>div:eq('+$(this).index()+')').show().siblings().hide();
        })
    });
    $(function(){
        $('.le_li').hover(function(){
            $(this).children('.le_dimga').stop(true,true).delay(50).animate({'top':0,opacity:1},300);
        },function(){
            $(this).children('.le_dimga').stop(true,true).animate({'top':0,opacity:0},200);
        })
    });
    //$(".playbox a").hover(function(){
    //	$(this).find(".txt").stop().animate({height:"360px"},200);
    //	$(this).find(".txt h3").stop().animate({paddingTop:"60px"},200);
    //},function(){
    //	$(this).find(".txt").stop().animate({height:"45px"},200);
    //	$(this).find(".txt h3").stop().animate({paddingTop:"0px"},200);
    //})
</script>

