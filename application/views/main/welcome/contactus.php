<div class="relative" style="margin-top:70px;">
    <img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-12 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-18 weight-800 margin-bottom-5 ipad_size">联系我们</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="jq_weather">
        <img src="<?php echo base_url() ?>ui/img/mobile/weather.png"  />
    </div>

</div>
<div class="contact_con">
    <div class="contact_a">
        <div class="contact_left">
            <p>服务热线：</p>
        </div>
        <div class="contact_right">
            <p>瑶琳公园：5071-69966666<br>瑶琳酒店：5071-69966666<br>瑶琳总机：5071-69966666</p>
        </div>
    </div>
    <div class="contact_a">
        <div class="contact_left">
            <p>电子邮箱：</p>
        </div>
        <div class="contact_right">
            <p>qiwei@clubjoin.cn</p>
        </div>
    </div>
    <img src="<?php echo base_url() ?>ui/img/mobile/contact_1.jpg"  />
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