<!--banner-->
<div class="relative">
    <img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center" style="height:50%;">
        <p class="p1 size-12 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-18 weight-800 margin-bottom-5 ipad_size">瑶琳景区相册</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="team_name text-center vertical-align-middle">
	        <p class="margin-bottom-5 margin-top-20 size-14" style="color: #333; font-size: 0.9rem;">为您呈现瑶琳国家森林公园丰富的文化和自然风貌。</p>
	
	        <p class="flex_box margin-bottom-5"><span></span><span class="yuan_blue"></span><span></span></p>
	    </div>
	<div class="jq_weather">
		<img src="<?php echo base_url() ?>ui/img/mobile/weathera.png"  />
	</div>
</div>
	<div class="jq_con">
		
	    <div class="jq_cona">
                <ul id="scenics">
                    <?php foreach ($scenicAreas as $k => $v){ ?>
	    		<li class="li_i">
                            <a href="<?php echo base_url() ?>scenicarea/areaList?id=<?php echo $v['id']; ?>"><img src="<?php echo $v['coverImage']; ?>" style="height:200px;" /></a>
                            <div class="li_bt"><a href="<?php echo base_url() ?>scenicarea/areaList?id=<?php echo $v['id']; ?>"><p><?php echo $v['title']; ?><br /><span><?php echo $v['description']; ?></span><br />(<?php echo $v['num']; ?>张)</p></a></div>
	    		</li>
                    <?php } ?>
	    	</ul>
	    </div>
        <div class="look_more margin-top-20 text-center margin-bottom-10 clearfix">
            <input id="scenic" value="1" type="hidden">
            <button class="flex_box margin-0-auto btn radius-0 size-16" onclick="scenic()" id="jzgds"><span id="jzgd">加载更多 &nbsp;</span> <img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_03.png" width="13%" alt=""/></button>
        </div>
	</div>
	<script type="text/javascript">
                var url = "<?php echo base_url(); ?>";
                function scenic() {
                    var p = $('#scenic').val();
                    var ps = parseInt(p)+1
                    $('#scenic').val(ps);
                    $.post(url+'scenicarea/ajaxScenic?p='+ps,function(data){
                        if(data){
                            $('#scenics').append(data);
                        }else{ 
                            $('#jzgd').html('没有更多了');
                            $('#jzgds').css('background-color','#808080');
                            $("#jzgds").attr("onclick","");
                        } 
                    });
                }
            
		$(document).ready(function(){
		  $('#sideMenu').sideToggle({
			moving: '#sideMenuContainer',
			direction: 'left'
		  });
	
		});
	</script>