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
	<style>
		#myCarousel ol{ margin-bottom: 0;}
		.carousel-indicators li{width:13px; height: 13px; border-radius: 50%;}
		.carousel-indicators .active{width:13px; height: 13px; border-radius: 50%; margin-top: 1px;}
	</style>
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
<body style="background: #fff;">
	<div class="login" style="display: block;height:0%;">
		<div class="ss_top">
			<div class="ss_topa">
				<form action="<?php echo base_url(); ?>Welcome/search" method="post" id="forms">
					<div class="ss_topal">
						<div class="ss_topala">
							<input type="text" name="search" value="" id="textfield" placeholder="搜索景点/资讯" />
						</div>
						<div class="ss_topalb">
							<a onclick="$('#forms').submit();"><img src="<?php echo base_url() ?>ui/img/mobile/ss.png" /></a>
						</div>
					</div>
				</form>
				<a href="<?php echo base_url(); ?>Welcome" class="close-login">取消</a>
			</div>
		</div>
	</div>
	<div id="scenics" style="margin-top: 20%;">
		<?php if(empty($search['scenicview']) && empty($search['news'])){ ?>
			<a  style="color: #05b1bb; font-size: 1rem; margin-left:13px;font-weight: 100;">未搜索到相关内容</a>
		<?php } ?>
		<?php if($search['scenicview']){ ?>
			<a  style="color: #05b1bb; font-size: 1rem; margin-left:13px;font-weight: 100;">景点介绍相关内容</a>
		<?php } ?>
		<?php foreach ($search['scenicview'] as $k => $v){ ?>
			<div class="nature_box bg-white padding-15 clearfix" style="margin-top: 5px;">
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
	<?php if($search['news']){ ?>
		<a  style="color: #05b1bb; font-size: 1rem; margin-left:6px;font-weight: 100;">景区资讯相关内容</a>
	<div class="index_zx" style="margin-top:5px;">
		<div class="index_zxcon" id="new">
			<?php foreach ($search['news'] as $k => $v){ ?>
				<div class="zx_left jing_a" style="padding-bottom:5px;padding-top:5px;">
					<a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><img src="<?php echo $v['coverImage']; ?>" style="height:160px;" /></a>
					<a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>"><p class="zx_p"><?php echo $v['title']; ?><br/><?php echo $v['description']; ?></p></a>
					<div class="zx_bot">
						<div class="zx_botleft">
							<p class="l_p"><?php echo date('Y-m-d',$v['publishedTimestamp']); ?></p>
							<p class="l_p"><img src="<?php echo base_url() ?>ui/img/mobile/eye.png" /><?php echo $v['hits']; ?>人浏览</p>
						</div>
						<div class="zx_botleft zx_botright"><a href="<?php echo base_url() ?>news/detail?id=<?php echo $v['id']; ?>">了解详情</a></div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
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
</body>
</html>