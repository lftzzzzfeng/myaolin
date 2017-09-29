<div class="relative" style="margin-top:70px;">
<img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
<div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
    <p class="p1 size-12 margin-bottom-5">
        <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
        <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
    </p>

    <p class="size-18 weight-800 margin-bottom-5 ipad_size">关于我们</p>

    <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
</div>
<div class="jq_weather">
    <img src="<?php echo base_url() ?>ui/img/mobile/weather.png"  />
</div>

</div>
<div class="about_con">
    <p class="about_p">
        瑶琳国家森林公园是瑶琳森林公园始建于1993年，2004年通过招商引资，成立桐庐瑶琳森林公园旅游有限公司，2008年12月被
        国家林业局批准定名为“浙江桐庐瑶琳国家森林公园”，是继桐庐县大奇山国家森林公园后的又一个国家级森林公园，是集溶洞、石林、密林、古村宅等自然景观和人文景观融合一体的生态型森林公
        园。</p>

    <p class="about_p">一期投资3亿元，建设范围10000㎡，开发了以山、水、洞为特色的景区，由于区位为中亚热带北缘，冬暖夏凉、四季皆宜，是旅
        游消夏避暑最佳胜地，素有“小庐山”的美称；二期预计总投入5亿元，规划范围26000㎡，以休闲度假、科考探险及商务会展为主题。
    </p>
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