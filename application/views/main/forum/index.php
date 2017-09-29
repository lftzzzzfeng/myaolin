<!--banner-->
<div class="relative">
    <img src="<?php echo base_url() ?>ui/img/mobile/youji_banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txt  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-10 margin-bottom-5">
            <span class="block"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-25 weight-800 margin-bottom-5 ipad_size">游记随笔</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="jq_weather">
		<img src="<?php echo base_url() ?>ui/img/mobile/weather.png"  />
	</div>
</div>

<!--写游记赢奖励-->
<a href="<?php echo base_url() ?>Forum/writeJotting" class="write_something">
    <img class="write_img" src="<?php echo base_url() ?>ui/img/mobile/xyj.png">&nbsp;写游记赢奖励&nbsp;<img class="gift_img" src="<?php echo base_url() ?>ui/img/mobile/xyj_gift_03.png">
</a>

<!--动态说说-->
<div id="forums">
    <?php foreach ($data as $k => $v){ ?>
        <div class="news margin-top-6 clearfix">
            <!-- 作者信息-->
            <div class="header_img col-xs-12 col-sm-12 col-md-12 margin-top-10">
                <!-- 头像-->
                <img class="col-xs-4 col-sm-4 col-md-2 text-center radius-8" src="<?php echo base_url() ?>ui/img/mobile/yj_1.png" alt=""/>
                <!-- 昵称-->
                <div class="col-xs-8 col-sm-8 col-md-10 text-left color_000 weight-700"><?php echo $v['creatorName']; ?></div>
                <!--发布时间-->
                <div class="col-xs-8 col-sm-8 col-md-10 text-left color_666 size-12 margin-top-10"><?php echo $v['jottingTime']; ?></div>
            </div>
            <!-- 标题-->
            <h4 class="col-xs-12 col-sm-12 col-md-12 text-lef margin-top-10 margin-bottom-6 color_000 weight-500"><?php echo $v['jottingTitle']; ?></h4>
            <!-- 内容-->
            <p class="branddesc col-xs-12 col-sm-12 col-md-12 color_666 size-14">
                <?php echo $v['jottingContent']; ?>
            </p>
            <div class="clearfix"></div>
            <!--可预览图片-->
            <div class="my-simple-gallery flex_box_num clearfix padding-15" itemscope itemtype="http://schema.org/ImageGallery">
                <?php foreach ($v['jottingImages'] as $k1 => $v1){ ?>
                <figure class="img-1" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $v1; ?>" itemprop="contentUrl" data-size="964x1024">
                            <img src="<?php echo $v1; ?>" width="100%" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                        </a>
                    </figure>
                <?php } ?>
            </div>
            <!-- 分享、评论次数、查看次数-->
            <div class="share_look col-xs-12 col-sm-12 col-md-12 margin-top-10">
                <div class="share_look_box  clearfix ">
                    <!--查看次数-->
                    <div class="look_num col-xs-4 col-sm-4 col-md-4 padding-0 text-center">
                        <a>
                            <img src="<?php echo base_url() ?>ui/img/mobile/yj_2.png" width="20%" alt=""/> &nbsp;<?php echo $v['jottingHits']; ?>
                        </a>
                    </div>
                    <!--评论次数-->
                    <div class="pingLun_num col-xs-4 col-sm-4 col-md-4 padding-0 text-center">
                        <a href="<?php echo base_url() ?>forum/showJotting?id=<?php echo $v['jottingId'];?>">
                            <img src="<?php echo base_url() ?>ui/img/mobile/yj_3.png" width="15%" alt=""/> &nbsp;<?php echo $v['jottingCommentsCount']; ?>
                        </a>
                    </div>
                    <!--分享-->
                    <div class="share col-xs-4 col-sm-4 col-md-4 padding-0 text-center">
                        <a href="javascript:;">
                            <img src="<?php echo base_url() ?>ui/img/mobile/icon_share_2_03.png" width="12%" alt=""/> &nbsp;分享
                        </a>
                    </div>

                    <!-- 分享隐藏弹框-->
                    <div class="share_hid_box hidden">
                        <div class="flex_box_between height-50">
                            <a href="#"><img width="60%" src="<?php echo base_url() ?>ui/img/mobile/icon_weibo.png" alt=""/></a>
                            <a href="#"><img width="60%" src="<?php echo base_url() ?>ui/img/mobile/icon_weixin.png" alt=""/></a>
                            <a href="#"><img width="60%" src="<?php echo base_url() ?>ui/img/mobile/icon_kongjian.png" alt=""/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="look_more margin-top-20 text-center margin-bottom-10 clearfix">
    <input id="forum" value="1" type="hidden">
    <button class="flex_box margin-0-auto btn radius-0 size-16" onclick="forum()" id="jzgds"><span id="jzgd">加载更多 &nbsp;</span> <img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_03.png" width="13%" alt=""/></button>
</div>
<!--底部banner-->

<!--图片预览插件按钮-->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <div class="pswp__container">
            <!-- don't modify these 3 pswp__item elements, data is added later on -->
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <!--<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>-->

                <!--  <button class="pswp__button pswp__button--share" title="Share"></button> -->

                <!--<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> -->

                <!--<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>-->

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <!--  <div class="pswp__preloader__donut"></div>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

<!--            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>-->

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<style>
    .pswp__zoom-wrap {height: 1024px;width: 1024px;}
    .pswp__zoom-wrap img{height: 100%;width: 100%;}
</style>
<script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
    function forum() {
        var p = $('#forum').val();
        var ps = parseInt(p)+1
        $('#forum').val(ps);
        $.post(url+'forum/ajaxForum?p='+ps,function(data){
            $('#forums').append(data.html);
            initPhotoSwipeFromDOM('.my-simple-gallery');
            if(data.num == 2){
                $('#jzgd').html('没有更多了');
                $('#jzgds').css('background-color','#808080');
                $("#jzgds").attr("onclick","");
            }
        },'json');
    }
    
    function quanwen() {
        var stutas = $('#quanwen').html();
        if(stutas == '全文'){
            $('#shouqi').css('display','none');
            $('#quanbu').css('display','');
            $('#quanwen').html('收起');
        }else{
            $('#shouqi').css('display','');
            $('#quanbu').css('display','none');
            $('#quanwen').html('全文');
        }
    }
    
    $(document).ready(function () {
        $('#sideMenu').sideToggle({
            moving: '#sideMenuContainer',
            direction: 'left'
        });

//        文字超出显示隐藏功能调用方法
        $(function(){
            //调用
            $(".news").moreText({
                maxLength: 90, //默认最大显示字数，超过...
                mainCell: '.branddesc' //文字容器
            });
        });


        //    图片自适应排列
        var data = $(".my-simple-gallery");
        for(var i=0;i<data.length;i++){
            var num = $(data[i]).children().length;
            if(num == 1){
                $(data[i]).children().addClass("col-xs-12 col-sm-12");
            }
            if(num == 2){
                $(data[i]).children().addClass("col-xs-6 col-sm-6");
            }
            if(num == 3){
                $(data[i]).children().addClass("col-xs-4 col-sm-4");
            }
            if(num == 4){
                $(data[i]).children().addClass("col-xs-6 col-sm-6");
            }
            if(num > 4){
                $(data[i]).children().addClass("col-xs-4 col-sm-4");
            }
        }

                //点击分享显示隐藏效果
            $(".share").on("click","a",function(){
                var show_box = $(this).parent().siblings("div.share_hid_box");

                if (show_box.hasClass("hidden")==true){
                    //先将其他显示效果还原后再执行
                    $(".share_hid_box").addClass("hidden");
                    $(".share a").removeClass("active_share");
                    $(".share a img").attr("src", "<?php echo base_url() ?>ui/img/mobile/icon_share_2_03.png");

                    show_box.removeClass("hidden");
                    $(this).addClass("active_share");
                    $(this).find("img").attr("src", "<?php echo base_url() ?>ui/img/mobile/icon_share.png");

                }else{
                    show_box.addClass("hidden");
                    $(this).removeClass("active_share");
                    $(this).find("img").attr("src", "<?php echo base_url() ?>ui/img/mobile/icon_share_2_03.png");

                }

            });


    });

</script>
<!--图片预览-->
<script type="text/javascript">
    var initPhotoSwipeFromDOM = function(gallerySelector) {

        // parse slide data (url, title, size ...) from DOM elements
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                    numNodes = thumbElements.length,
                    items = [],
                    figureEl,
                    childElements,
                    linkEl,
                    size,
                    item;

            for(var i = 0; i < numNodes; i++) {


                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes
                if(figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if(figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if(linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            var clickedListItem = closest(eTarget, function(el) {
                return el.tagName === 'FIGURE';
            });

            if(!clickedListItem) {
                return;
            }


            // find index of clicked item
            var clickedGallery = clickedListItem.parentNode,
                    childNodes = clickedListItem.parentNode.childNodes,
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i].nodeType !== 1) {
                    continue;
                }

                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if(index >= 0) {
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                    params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            if(!params.hasOwnProperty('pid')) {
                return params;
            }
            params.pid = parseInt(params.pid, 10);
            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {
                index: index,

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of docs for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                },

                // history & focus options are disabled on CodePen
                // remove these lines in real life:
                historyEnabled: false,
                focus: false

            };

            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll( gallerySelector );

        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid > 0 && hashData.gid > 0) {
            openPhotoSwipe( hashData.pid - 1 ,  galleryElements[ hashData.gid - 1 ], true );
        }
    };

    // execute above function
    initPhotoSwipeFromDOM('.my-simple-gallery');
</script>