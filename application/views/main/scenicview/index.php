<!--banner-->
<style>
    .pswp__zoom-wrap {height: 1024px;width: 1024px;}
    .pswp__zoom-wrap img{height: 100%;width: 100%;}
</style>
<div class="relative">
    <img src="<?php echo base_url() ?>ui/img/mobile/banner_02.jpg" width="100%" alt=""/>
    <div class="banner_txta  col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4 tex-white text-center">
        <p class="p1 size-12 margin-bottom-5">
            <span class="block margin-bottom-6"><img src="<?php echo base_url() ?>ui/img/mobile/icon_yuan_03.png" alt=""/></span>
            <span class="">YAOLIN</span><br/><span>INTO NATURE</span>
        </p>

        <p class="size-18 weight-800 margin-bottom-5 ipad_size">瑶琳观光胜地</p>

        <p class="p3 size-12 color_blue margin-bottom-5"><span>NICE TRIP</span><br/><span>TRAVEL SERVICE</span></p>
    </div>
    <div class="team_name text-center vertical-align-middle">
        <p class="margin-bottom-5 margin-top-20 size-14" style="color: #333;">为您呈现瑶琳国家森林公园丰富的文化和自然风貌。</p>

        <p class="flex_box margin-bottom-5"><span></span><span class="yuan_blue"></span><span></span></p>
    </div>
	<div class="jq_weather">
		<img src="<?php echo base_url() ?>ui/img/mobile/weather.png"  />
	</div>
</div>
<!--景点-->
<!--仰天洞-->
<div id="scenics">
 <?php foreach ($scenicViews as $k => $v){ ?>
    <div class="nature_box bg-white margin-top-20 padding-15 clearfix">
        <h4><?php echo $v['title'] ?></h4>
        <p class="margin-bottom-15" style="color: #333;"><?php echo $v['description'] ?></p>
        <div class="my-simple-gallery clearfix img_box" itemscope itemtype="http://schema.org/ImageGallery">

            <figure class="img-1  col-xs-6" itemscope itemtype="http://schema.org/ImageObject">
                <a href="<?php echo $v['coverImage'] ?>" itemprop="contentUrl" data-size="1024x1024">
                    <img src="<?php echo $v['coverImage'] ?>" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                </a>
            </figure>
            <?php foreach ($v['img'] as $k1 => $v1){ 
                if($k1 == 0){
             ?>
                    <figure class="img-2  col-xs-3" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $v1['image'] ?>" itemprop="contentUrl" data-size="964x1024">
                            <img src="<?php echo $v1['image'] ?>" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                        </a>
                    </figure>
                <?php }else if($k1 == 1){ ?>
                    <figure class="img-3  col-xs-3" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $v1['image'] ?>" itemprop="contentUrl" data-size="964x1024">
                            <img src="<?php echo $v1['image'] ?>" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                        </a>
                    </figure>
                <?php }else{ ?>
                    <figure class="img-4  col-xs-6" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $v1['image'] ?>" itemprop="contentUrl" data-size="964x1024">
                            <img src="<?php echo $v1['image'] ?>" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                        </a>
                    </figure>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
 <?php } ?>
</div>
<!--查看更多-->
<div class="look_more margin-top-20 text-center margin-bottom-10 clearfix">
    <input id="scenic" value="1" type="hidden">
    <button class="flex_box margin-0-auto btn radius-0 size-16" onclick="scenic()" id="jzgds"><span id="jzgd">加载更多 &nbsp;</span> <img src="<?php echo base_url() ?>ui/img/mobile/icon_btn_03.png" width="13%" alt=""/></button>
</div>
<!--插件按钮-->
<!-- Root element of PhotoSwipe. Must have class pswp. -->
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

            <!--<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">-->
            </button>

            <!--<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">-->
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<div class="index_ftop"><a href="#a"><img src="<?php echo base_url() ?>ui/img/mobile/index_top.jpg" /></a></div>
<!--天气插件-->
<!--<script src="js/simple-weather.js"></script>-->
<script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
    function scenic() {
        var p = $('#scenic').val();
        var ps = parseInt(p)+1
        $('#scenic').val(ps);
        $.post(url+'scenicview/ajaxScenic?p='+ps,function(data){
            if(data){
                $('#scenics').append(data);
                initPhotoSwipeFromDOM('.my-simple-gallery');
            }else{ 
                $('#jzgd').html('没有更多了');
                $('#jzgds').css('background-color','#808080');
                $("#jzgds").attr("onclick","");
            } 
        });
    }

    var initPhotoSwipeFromDOM = function (gallerySelector) {
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
	<script type="text/javascript">
		$(document).ready(function(){
		  $('#sideMenu').sideToggle({
			moving: '#sideMenuContainer',
			direction: 'left'
		  });
	
		});
	</script>