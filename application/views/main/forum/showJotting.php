<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/bootstrap.css"/>   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>ui/css/mobile/demo.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/style.css">
    <link href="<?php echo base_url() ?>ui/css/mobile/css.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/essentials.css"/>   
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/photoswipe.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/default-skin.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>ui/css/mobile/jd.css"/>
        
    <script src="<?php echo base_url() ?>ui/js/mobile/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/bootstrap.min.js"></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/jquery-2.1.4.min.js'></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/velocity.min.js'></script>
    <script src='<?php echo base_url() ?>ui/js/mobile/sideToggleExtended.js'></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/ss.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/photoswipe.min.js"></script>
    <script src="<?php echo base_url() ?>ui/js/mobile/photoswipe-ui-default.min.js"></script>
    <script type="text/javascript">
    	
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
   			
   		});
   		
    </script>
    <style>
        .pswp__zoom-wrap {height: 1024px;width: 1024px;}
        .pswp__zoom-wrap img{height: 100%;width: 100%;}
    </style>
</head>
<body style="background: #f0f0f0;">
<a id="a"><div class="top"></div></a>
<div class="yj_top">
	<p>游记正文</p>
	<div class="yj_left" onclick="window.location.href='<?php echo base_url() ?>forum'"><a><img src="<?php echo base_url() ?>ui/img/mobile/yj_fh.png"  style="height:80%;width: 70%"/></a></div>
	<div class="yj_right"><a href="#"><img src="<?php echo base_url() ?>ui/img/mobile/yj_share.png" /></a></div>
</div>
<div class="yj_con">
	<div class="yj_cona">
		<div class="yj_conat">
			<img src="<?php echo base_url() ?>ui/img/mobile/yj_1.png"  />
			<div class="yj_cr">
				<p class="cr_p"><?php echo $data['creatorName']; ?></p>
				<p class="cr_pa"><?php echo $data['jottingTime']; ?></p>
			</div>
		</div>
		<div class="yj_crcon">
			<p class="crp_p"><?php echo $data['jottingTitle']; ?></p>
			<p class="crp_pa"><?php echo $data['jottingContent']; ?></p>
			
                        <div class="my-simple-gallery flex_box_num clearfix" itemscope itemtype="http://schema.org/ImageGallery">
                            <?php foreach($data['jottingImages'] as $k => $v){ ?>
                                <figure class="img-1" itemscope itemtype="http://schema.org/ImageObject">
                                    <a href="<?php echo $v; ?>" itemprop="contentUrl" data-size="960x1024">
                                        <img src="<?php echo $v; ?>" width="100%" class=" padding-1" itemprop="thumbnail" alt="Image description"/>
                                    </a>
                                </figure>
                            <?php } ?>
                            
                        </div>
                </div>
	</div>
	
</div>

<div class="yj_conb">
	<div class="yjc_p">
		<p class="yjcp_p">浏览 <?php echo $data['jottingHits']; ?></p>
		<p class="yjcp_pa">评论 <?php echo $data['jottingCommentsCount']; ?></p>
	</div>
        <?php foreach ($comment['comments'] as $k => $v){ ?>
            <div class="yj_pz" style="min-height: 100px;">
                    <div class="yj_pzleft">
                            <img src="<?php echo base_url() ?>ui/img/mobile/mr_tx.png"  />
                    </div>
                    <div class="yj_pzright">
                            <div class="yj_rl">
                                    <p class="pz_p"><?php echo $v['sender']; ?></p>
                                    <p class="pz_pa"><span><?php echo $v['createdTimestamp']; ?></span></p>
                            </div>
                            <p class="yr_p"><?php echo $v['content']; ?></p>
                    </div>
            </div>
         <?php } ?>
</div>
<form action="<?php echo base_url(); ?>forum/loadAddJottingComment" method="post" name="comment">
    <div class="yj_ping">
        <input type="hidden" name="jottingId" value="<?php echo $jottingId; ?>">
        <input class="input_a" type="text" value="" name="textfield" id="textfield" placeholder="评论" />
        <input class="input_b" type="submit" name="button" id="button" value="评论" />
    </div>
</form>
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

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<script>
    // 图片自适应排列
    $(document).ready(function () {
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
       });
       $(document).ready(function(){
        var box = $(".yj_plm");
        for(var q=0;q<box.length;q++) {
            var line = $(box[q]).find("p");
            console.log(line.length)

                if (line.length <= 2) {
                    line.show();
                    $(box[q]).find(".p_show").text("共" + line.length + "条回复");
                } else if (line.length > 2) {
                    line.hide();
                    $(line[0]).show();
                    $(line[1]).show();
                    $(box[q]).find(".p_show").html("共" + line.length + "条回复," + "<a>" + "点击展开" + "</a>" + "<img" + " src=" + "<?php echo base_url() ?>ui/img/mobile/mor.png" + ">");
					
                    $(box[q]).find(".p_show").on("click", "a", function () {
                        if ($(this).html() == "点击展开") {
                            $(this).parent().parent().find("p").show();
                            //$(this).html("点击收起");
                            $(this).parent().html("共" + line.length + "条回复," + "<a>" + "点击收起" + "</a>" + "<img" + " src=" + "<?php echo base_url() ?>ui/img/mobile/mora.png" + ">");
                        
                        } else if ($(this).html() == "点击收起") {
                            $(this).parent().parent().find("p").hide();
                            $($(this).parent().parent().find("p")[0]).show();
                            $($(this).parent().parent().find("p")[1]).show();
//                          $(this).html("点击展开");
                            $(this).parent().html("共" + line.length + "条回复," + "<a>" + "点击展开" + "</a>" + "<img" + " src=" + "<?php echo base_url() ?>ui/img/mobile/mor.png" + ">");
                            
                            
                        }


                    });

                }


        }

    });
	</script>
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
</body>
</html>