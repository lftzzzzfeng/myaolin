<!--banner-->
<div class="relative" style="margin-top:70px !important;">
    <img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txt2  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center" style="height:50%;">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">畅游瑶琳</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="team_name text-center vertical-align-middle">
        <p class="margin-bottom-5 margin-top-20 size-14" style="color: #333;">为您呈现瑶琳国家森林公园丰富的文化和自然风貌。</p>

        <p class="flex_box margin-bottom-5"><span></span><span class="yuan_blue"></span><span></span></p>
    </div>
	<div class="jq_weather">
		<img src="<?php echo base_url() ?>ui/img/weather/<?php echo $weather['weatherCode'] ?>.png"/>
		<p>
			<span><?php echo $weather['temperature'] ?>℃ </span><span> <?php echo $weather['weatherText'] ?></span><br>
			<span>(瑶琳/实时)</span>
		</p>
	</div>
</div>
	<div class="cy_con">
		
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_1.jpg"  />
	    	<div class="cy_c">
	    		<div class="cy_c_box">
	    			<p class="cy_p">游在瑶琳</p>
	    			<span></span>
	    			<p class="cy_pa">尝试一下景区的不同旅行方式吧</p>
                    <div class="cy_btn"><a href="<?php echo base_url() ?>trip/travel">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    		</div>
	    	</div>
	    </div>
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_2.jpg"  />
	    	<div class="cy_c">
	    		<p class="cy_p">吃在瑶琳</p>
	    		<span></span>
	    		<p class="cy_pa">快来瞧瞧景区的风味美食</p>
	    		<div class="cy_btn"><a href="<?php echo base_url() ?>food">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    	</div>
	    </div>
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_3.jpg"  />
	    	<div class="cy_c">
	    		<p class="cy_p">住在瑶琳</p>
	    		<span></span>
	    		<p class="cy_pa">暂不开放</p>
	    		<div class="cy_btn"><a href="<?php echo base_url() ?>accommodation">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    	</div>
	    </div>
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_4.jpg"  />
	    	<div class="cy_c">
	    		<p class="cy_p">行在瑶琳</p>
	    		<span></span>
	    		<p class="cy_pa">去景区的几种路线方式</p>
	    		<div class="cy_btn"><a href="<?php echo base_url() ?>routes">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    	</div>
	    </div>
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_5.jpg"  />
	    	<div class="cy_c">
	    		<p class="cy_p">购在瑶琳</p>
	    		<span></span>
	    		<p class="cy_pa">暂不开放</p>
	    		<div class="cy_btn"><a href="<?php echo base_url() ?>shopping">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    	</div>
	    </div>
	    <div class="cy_a">
	    	<img src="<?php echo base_url() ?>ui/img/mobile/cy_6.jpg"  />
	    	<div class="cy_c">
	    		<p class="cy_p">娱在瑶琳</p>
	    		<span></span>
	    		<p class="cy_pa">快来享受吧</p>
	    		<div class="cy_btn"><a href="<?php echo base_url() ?>entertainment">查看详情<img src="<?php echo base_url() ?>ui/img/mobile/jt.png" /></a></div>
	    	</div>
	    </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		  $('#sideMenu').sideToggle({
			moving: '#sideMenuContainer',
			direction: 'left'
		  });
	
		});
	</script>