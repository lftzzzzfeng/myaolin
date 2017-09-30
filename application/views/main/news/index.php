<!--banner-->
<div class="relative" style="margin-top:70px !important;">
    <img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">景区资讯</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="jq_weather">
        <img src="<?php echo base_url() ?>ui/img/weather/<?php echo $weather['weatherCode'] ?>.png"/>
        <p>
            <span><?php echo $weather['temperature'] ?>℃ </span><span> <?php echo $weather['weatherText'] ?></span><br>
            <span>(瑶琳/实时)</span>
        </p>
    </div>

</div>
	<div class="index_zx jing_con">
		<div class="index_zxcon" id="new">
            <?php foreach ($news['news'] as $k => $v){ ?>
                <div class="zx_left jing_a">
                    <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><img src="<?php echo $v['coverImage']; ?>" style="height:160px;" /></a>
                    <a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><p class="zx_p"><?php echo $v['title']; ?></p></a>
                    <div class="zx_bot">
                        <div class="zx_botleft">
                            <p class="l_p"><?php echo date('Y-m-d',$v['publishedTimestamp']); ?></p>
                            <p class="l_p"><img src="<?php echo base_url() ?>ui/img/mobile/eye.png" /><?php echo $v['hits']; ?></p>
                        </div>
                        <div class="zx_botleft zx_botright"><a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>">了解详情</a></div>
                    </div>
                </div>
            <?php } ?>
		</div>
        <?php if($num == 1){ ?>
            <div class="le_btn" id="jzgds">
                <input id="news" value="1" type="hidden">
                <a onclick="news()"><span id="jzgd">加载更多</span><img style="width:18px;" src="<?php echo base_url() ?>ui/img/mobile/icon_btn_03.png" /></a>
            </div>
        <?php } ?>
	</div>
	<script type="text/javascript">
            var url = "<?php echo base_url(); ?>";
            function news() {
                var p = $('#news').val();
                var ps = parseInt(p)+1
                $('#news').val(ps);
                $.post(url+'news/ajaxNews?p='+ps,function(data){
                    $('#new').append(data.html);
                    if(data.num == 2){
                        $('#jzgd').html('没有更多了');
                        $('#jzgds').css('background-color','#808080');
                        $("#jzgds").attr("onclick","");
                    }
                },'json');
            }
            
            $(document).ready(function(){
              $('#sideMenu').sideToggle({
                moving: '#sideMenuContainer',
		direction: 'left'
              });
	
            });
	</script>