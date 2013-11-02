/*
* This file contains all global js-code.
*/


function genc(a, b, c, d) {
   var e = dec(a), f = dec(b), g = dec(c), h = dec(d), i = f+"@"+h+"."+e, j = g == "" ? i : g;
   
   document.write("<a href=\"mailto:"+i+"\">"+j+"</a>");
   
   function dec(s) {
       return s.replace(/[a-zA-Z]/g, function(c){
           return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
       });
   };
   
}

function MainNav(){
	var ths = this;
	
	/*------------------------------------- INIT */
	ths.init = function(){
		ths.fallback = !Modernizr.csstransforms3d;
		ths.speed = 12;
		ths.tweening = false;
		ths.nav_perc = 1;
		ths.opened = false;
		ths.mainnav = $("#mainnav");
		ths.panel = $(".panel", ths.mainnav)[0];
		ths.slice1 = $(".slice.s1", ths.panel)[0];
		ths.slice2 = $(".slice.s2", ths.panel)[0];
		ths.slice3 = $(".slice.s3", ths.panel)[0];
		ths.menu_content = $(".menu .content", ths.panel);
		ths.blocks = $("#container .blocks")[0];
		ths.sliceWidth = getCss(ths.slice1, "width");
		ths.sliceWidth_slice3 = getCss(ths.slice3, "width");
		ths.openedWidth = ths.sliceWidth*2 + ths.sliceWidth_slice3;
		ths.offsetX = -3;		// offset .blocks
		
		if(!ths.fallback)	ths.setClosed();
		
		// hide menu content
		forEach(ths.menu_content, function($i, $elem){ setCss($elem, "display", "none"); })
		
		// set initial width
		setCss(ths.mainnav, "width", ths.sliceWidth_slice3);
		
		//---- add rollover for both menu items (menu exists twice for folding effect):
		var menu1 = $("a",ths.menu_content[0]);
		var menu2 = $("a",ths.menu_content[1]);
		
		forEach(menu1, function($i){
			menu1[$i].sibling = menu2[$i];
			menu2[$i].sibling = menu1[$i];
			
			menu1[$i].onmouseover = menu2[$i].onmouseover = function(){
				addClass(this, "hover");
				addClass(this.sibling, "hover");
			}
			menu1[$i].onmouseout = menu2[$i].onmouseout = function(){
				removeClass(this, "hover");
				removeClass(this.sibling, "hover");
			}
		})
		
		//---- show menu texts:
		setCss($("#menu_button"), "display", "block");
		if(!getCookie("yr_menuclicked")){
			addClass($("#menu_button"), "intro");
			addClass($("#jumpToMenu"), "intro");
		}
		
		// no support for 3D transforms:
		if(ths.fallback){
			addClass(ths.mainnav, "fallback");
			removeClass(ths.panel, "closed");
		}
	}
	
	
	/*------------------------------------- OPEN MENU */
	ths.openMenu = function(){
		ths.opened = true;
		ths.tweening = true;
		CONTAINER.updateContainerWidth();	// adds space at the end of the page.
		removeClass(ths.panel, "closed");
		setCookie("yr_menuclicked", true);
		setCss(ths.mainnav, "width", ths.openedWidth);
		forEach(ths.menu_content, function($i, $elem){ setCss($elem, "display", "block"); });
		proto.tween(ths, {prop:"nav_perc", end:0, onProgress:ths.onMenuMove, onComplete:ths.onMenuOpened, duration:ths.speed});
	}
	
	ths.onMenuOpened = function(){
		ths.tweening = false;
	}
	
	
	/*------------------------------------- CLOSE MENU */
	ths.closeMenu = function(){
		ths.opened = false;
		ths.tweening = true;
		if(!ths.fallback)	addClass(ths.panel, "closed");
		proto.tween(ths, {prop:"nav_perc", end:1, onProgress:ths.onMenuMove, onComplete:ths.onMenuClosed, duration:ths.speed});
	}
	
	ths.onMenuClosed = function(){
		forEach(ths.menu_content, function($i, $elem){ setCss($elem, "display", "none"); })
		CONTAINER.updateContainerWidth();	// remove space at the end of the page.
		ths.tweening = false;
		setCss(ths.mainnav, "width", ths.sliceWidth_slice3);
	}
	
	ths.setClosed = function(){		// fixes background visibility slice1+2
		ths.slice1.style[Modernizr.prefixed("transform")] = "translate3d(-"+ths.sliceWidth+"px,0,0)";
		ths.slice2.style[Modernizr.prefixed("transform")] = "translate3d(-"+ths.sliceWidth+"px,0,0)";
		ths.slice3.style[Modernizr.prefixed("transform")] = "translate3d("+ths.sliceWidth*2+"px,0,0)";
	}
	
	ths.toggleMenu = function(){
		if(ths.opened)		ths.closeMenu();
		else					ths.openMenu();
	}
	
	ths.onMenuMove = function(){
		if(!ths.fallback){		// CSS 3D-TRANSFORM
			var angle = 90*ths.nav_perc;
			var menuWidth = Math.round(ths.get3dRotatedWidth(angle, ths.sliceWidth)*2 + ths.sliceWidth_slice3 +(ths.offsetX*(1-ths.nav_perc)));
			setCss(ths.blocks, "margin-left", menuWidth);
			
			// update 3D transformation:
			if(ths.nav_perc==1){
				ths.setClosed();
			}else{
				ths.slice1.style[Modernizr.prefixed("transform")] = "translate3d(0,0,0) rotateY("+(90*ths.nav_perc)+"deg)";
				ths.slice2.style[Modernizr.prefixed("transform")] = "translate3d("+Math.max(0,(ths.sliceWidth-1))+"px,0,0) rotateY("+(-180*ths.nav_perc)+"deg)";
				ths.slice3.style[Modernizr.prefixed("transform")] = "translate3d("+Math.max(0,(ths.sliceWidth-2))+"px,0,0) rotateY("+(90*ths.nav_perc)+"deg)";
			}
			
		}else{					// FALLBACK
			var posX = -(ths.sliceWidth*2)*ths.nav_perc;
			setCss(ths.panel, "left", posX);
			setCss(ths.blocks, "margin-left", posX+ ths.openedWidth +ths.offsetX);
		}
	}
	
	
	/*------------------------------------- RESIZE */
	ths.resize = function($totH){
		if(ths.tweening && !agent.mobile){
			proto.endTween(ths, "nav_perc");
			ths.onMenuMove();
		}
	}
	
	
	/*------------------------------------- VARIOUS */
	ths.getWidth = function(){		// triggered in container
		if(ths.opened)		return ths.openedWidth +ths.offsetX;
		else					return ths.sliceWidth_slice3;
	}
	
	ths.get3dRotatedWidth = function($angle, $width){
		if($angle==90 || $angle==270)	return 0;
		else									return Math.abs(Math.cos($angle*Math.PI/180)*$width);
	}
	
}



/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// CONTAINER */
function Container($pageID){
	var ths = this;
	ths.pageID = $pageID;
	ths.boxes = [];		// contains all box instances
	
	ths.container = $("#container");
	ths.centered = $(".centered", ths.container)[0];
	
	/*------------------------------------- ADD BOX */
	ths.addBox = function($config, $skip){
		if($config.elem){
			switch($config.type){
				case "wideImage": 					ths.boxes.push(new Box_wideImage($config)); 			break;
				case "fullscreenVideo": 			ths.boxes.push(new Box_fullscreenVideo($config)); 	break;
				case "imageText": 					ths.boxes.push(new Box_imageText($config)); 			break;
				case "doubleBlock1": 				ths.boxes.push(new Box_doubleBlock1($config)); 		break;
				case "doubleBlock2": 				ths.boxes.push(new Box_doubleBlock2($config)); 		break;
				case "workThumbs": 					ths.boxes.push(new Box_workThumbs($config)); 		break;
				case "workInfo": 						ths.boxes.push(new Box_workInfo($config)); 			break;
				case "clientList": 					ths.boxes.push(new Box_clientList($config)); 		break;
				case "contactInfo": 					ths.boxes.push(new Box_contactInfo($config)); 		break;
				case "yarubarFilters": 				ths.boxes.push(new Box_yarubarFilters($config)); 	break;
				case "loadMore": 						ths.boxes.push(new Box_loadMore($config)); 			break;
				case "showAll": 						ths.boxes.push(new Box_showAll($config)); 			break;
				case "workOverview": 				ths.boxes.push(new Box_workOverview($config));		break;
				case "newsletter":					ths.boxes.push(new Box_newsletter($config)); 		break;
				case "newsletter_unsubscribe":	ths.boxes.push(new Box_newsletter_unsubscribe($config)); 	break;
				case "fourohfour": 					ths.boxes.push(new Box_fourohfour($config)); 		break;
			}
		}else{
			tracer("WARNING: Invalid $config.elem!", $config);
		}
		
		if(!$skip)	ths.onResize();		// adding a box might create a horizontal browser scrollbar. Skipped in startup.
	}
	
	
	/*------------------------------------- REMOVE BOX */
	ths.removeBox = function($elem){
		for(var i=0; i<ths.boxes.length; i++){
			if(ths.boxes[i].elem === $elem){
				ths.boxes.splice(i,1);
				$elem.parentNode.removeChild($elem);
				ths.updateContainerWidth();
			}
		}
	}
	
	
	/*------------------------------------- RESIZE */
	ths.minH = 610;
	ths.maxH = 900;	// also set in components.css
	ths.screenH;
	ths.totalW;			// calculated container-width
	ths.totalH;			// calculated container-height
	
	ths.onResize = function(){
		// container height:
		ths.screenH = getWindowSize().h;
		ths.totalH = Math.max(ths.minH,Math.min(ths.maxH,ths.screenH));
		
		setCss(ths.centered, "height", ths.totalH);
		setCss(ths.centered, "top", Math.round(Math.max(0, (ths.screenH-ths.totalH)/2)));
		
		// resize boxes:
		forEach(ths.boxes, function($i){  ths.boxes[$i].resize(ths.totalH);  })
		
		// resize main menu:
		if(MAIN_NAV)	MAIN_NAV.resize(ths.totalH);
		
		// container width:
		ths.updateContainerWidth();
	}	
	
	ths.updateContainerWidth = function(){		// scale container to the width of the content
		ths.totalW = 0;
		if(MAIN_NAV)	ths.totalW += MAIN_NAV.getWidth();
		forEach(ths.boxes, function($i){  ths.totalW += getCss(ths.boxes[$i].elem, "width"); });
		ths.totalW = Math.ceil(ths.totalW);
		// width cannot be less than viewport width.
		// fix for contact page 
		var setWidth = Math.max(ths.totalW, getWindowSize().w);
		setCss(ths.container, "width", setWidth/1.3);
	}
	
	proto.registerResize(ths.onResize);
	
	
	/*------------------------------------- MOUSE SCROLL */
	ths.scrollMove = 50;
	ths.scrollDuration = 5;
	ths.scrollPosX_end = null; 
	window.scrollPosX = 0;
	ths.scrollStopped = true;
	
	if((agent.browser=="ie" && (agent.version==8 || agent.version==7)))	ths.scrollDuration = 1;
	
	ths.onMouseWheel = function($val){
		var moveX = -$val*ths.scrollMove;
		var currX = getScrollLeft();
		
		if(ths.scrollPosX_end===null)	ths.scrollPosX_end = scrollPosX = currX;
		var newX = ths.scrollPosX_end +moveX;
		
		// check if scrollbars were used (check difference between current and target value):
		if(ths.scrollStopped){
			var diffX = Math.abs(currX-newX);
			if(diffX>Math.abs(moveX)){
				newX = currX +moveX;
				window.scrollPosX = currX;
			}
		}
		
		ths.scrollPosX_end = newX = Math.min(Math.max(0,newX), getDocumentSize().w-getWindowSize().w);
		
		if(newX != window.scrollPosX){
			ths.scrollStopped = false;
			proto.tween(window, {prop:"scrollPosX", end:newX, duration:ths.scrollDuration,
				onProgress:function(){
					document.documentElement.scrollLeft = window.scrollPosX;
					document.body.scrollLeft = window.scrollPosX;
				},
				onComplete:function(){
					ths.scrollStopped = true;
				}
			})
		}
	}
	
	if(!Modernizr.touch)	addMousewheelListener(ths.container, ths.onMouseWheel, true);
	
	
	/*------------------------------------- JUMPTOMENU + SCROLLRIGHT */
	ths.jumpToMenu = $("#jumpToMenu");
	$(".content",ths.jumpToMenu)[0].onclick = function(){ 	scrollToPos(0, null, 10, ths.onJumpedToMenu);	}
	
	ths.scrollRight = $("#scrollRight");
	ths.scrollRight_needed = true;	// only needed for pages with a scrollbar.
	
	ths.onPageScroll = function(){
		// jumpToMenu button:
		if(getScrollLeft() > 100)	addClass(ths.jumpToMenu, "show");
		else								removeClass(ths.jumpToMenu, "show");
		
		// scrollRight arrow:
		setCookie("yr_scrolled", true);
	}
	
	ths.onJumpedToMenu = function(){
		proto.wait("onScrolledHome", {func:MAIN_NAV.openMenu, duration:5});
		window.scrollPosX = ths.scrollPosX_end = 0;
	}
	
	proto.registerScroll(ths.onPageScroll);
	
	
	/*------------------------------------- INIT (executed after all boxes are added and onResize() is called for first time - see blocks.php) */
	ths.init = function(){
		/*proto.wait(null, {loop:"forever", duration:80, func:function(){
				ths.scrollRight_needed = (getDocumentSize().w > getWindowSize().w);
				if(getCookie("yr_scrolled")=="true")	ths.scrollRight_needed = false;
				if(ths.scrollRight_needed && getScrollLeft()==0){		// bounce scrollRight label
					var speed = 8;
					var bumps = 8;
					var moveX = 30;
					proto.tween(ths.scrollRight, {prop:"right", start:0, end:moveX, ease:"out", duration:speed});
					
					var delay = speed;
					for(var i=0; i<bumps; i++){
						proto.wait(null, {duration:delay, func:function(){ proto.tween(ths.scrollRight, {prop:"right", end:0, ease:"in", duration:speed}); }})
						proto.wait(null, {duration:delay+speed, func:function(){ proto.tween(ths.scrollRight, {prop:"right", end:moveX, ease:"out", duration:speed}); }})
						delay += speed*2;
					}
					
					proto.wait(null, {duration:delay, func:function(){ proto.tween(ths.scrollRight, {prop:"right", end:0, ease:"in", duration:speed}); }})
					proto.wait(null, {duration:delay, func:function(){ proto.tween(ths.scrollRight, {prop:"opacity", end:0, duration:speed}); }})
				}
			}
		})*/
	}
	
	
	/*------------------------------------- PAGE SCROLL: DEEP LINKS (unfinished!) */
	//window.history.replaceState(“object or string”, “Title”, “/another-new-url”);
	
	/*ths.onPageScroll = function(){
		proto.wait("pageScroll", {duration:1, func:function(){	// add delay to prevent constant execution from scroll-tween
			var scrollLeft = getScrollLeft();
			tracer("scrollLeft", scrollLeft)
			forEach(ths.boxes, function($i,$inst){
				if($inst.data.link){
					tracer(getCss($inst.elem, "
				}
			})
		}})
	}
	
	if(ths.pageID=="news" || ths.pageID=="yarubar")	proto.registerScroll(ths.onPageScroll);
	*/
}



/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] WIDE IMAGE */
function Box_wideImage($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.mainImage = $(".mainImage", ths.elem)[0];
		
	ths.resize = function($totH){
		var imgW = ths.data.img.normal.width;
		var imgH = ths.data.img.normal.height;
		var newW = Math.floor(imgW*($totH/imgH));
		
		// resize image:
		setCss(ths.mainImage, "width", newW);
		setCss(ths.mainImage, "height", $totH);
		
		// resize box div:
		setCss(ths.elem, "width", newW);
		setCss(ths.elem, "height", $totH);
	}
	
	preloadBox(ths.elem);
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] FULLSCREEN VIDEO */
function Box_fullscreenVideo($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.mainImage = $(".mainImage", ths.elem)[0];
	ths.videoHolder = $(".video", ths.elem)[0];
	ths.textblock = $(".textblock", ths.elem)[0];
	ths.iframe;
	ths.playButton = $(".play", ths.elem)[0];
	ths.inited = false;
	
	// vimeo video:
	ths.playButton.onclick = function(){
		if(!ths.inited)	ths.initVideo();
		setCss(ths.playButton, "display", "none");
	}
	
	ths.initVideo = function(){
		ths.inited = true;
		ths.videoHolder.innerHTML = getVimeoEmbed(ths.data.vimeo_id);
		ths.iframe = $("iframe", ths.videoholder)[0];
		
		proto.wait(null, {func:ths.onVideoReady, duration:10});
		setCss(ths.iframe, "display", "none");
	}
	
	ths.onVideoReady = function(){
		setCss(ths.iframe, "display", "block");
		setCss(ths.mainImage, "display", "none");
		setCss(ths.videoHolder, "display", "block");
	}
	
	ths.resize = function($totH){
		var imgW = ths.data.img.normal.width;
		var imgH = ths.data.img.normal.height;
		var newW = Math.floor(imgW*($totH/imgH));
		
		// resize image:
		setCss(ths.mainImage, "width", newW);
		setCss(ths.mainImage, "height", $totH);
		
		// resize box div:
		setCss(ths.elem, "width", newW);
		setCss(ths.elem, "height", $totH);
		
		// position textblock:
		var textblockH = getCss(ths.textblock, "height");
		setCss(ths.textblock, "top", -15+($totH-textblockH)/2);
	}
	
	preloadBox(ths.elem);
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] IMAGETEXT */
function Box_imageText($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.mainImage = $(".mainImage", ths.elem)[0];
	
	ths.resize = function($totH){
		var imgW = ths.data.img.normal.width;
		var imgH = ths.data.img.normal.height;
		var newW = Math.floor(imgW*($totH/imgH));
		
		// resize image:
		setCss(ths.mainImage, "width", newW);
		setCss(ths.mainImage, "height", $totH);
		
		// resize box div:
		setCss(ths.elem, "width", newW);
		setCss(ths.elem, "height", $totH);
	}
	
	preloadBox(ths.elem);
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] DOUBLEBLOCK 1 */
function Box_doubleBlock1($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.mainImage = $(".mainImage", ths.elem)[0];

	// text only item:
	if(!ths.data.img)	setCss(ths.mainImage, "visibility", "hidden");
	
	// init video:
	if(ths.data.vimeo_id){
		ths.iframe;
		ths.videoHolder = $(".video", ths.elem)[0];
		ths.playButton = $(".play", ths.elem)[0];
		ths.inited = false;
		
		ths.playButton.onclick = function(){
			if(!ths.inited)	ths.initVideo();
			setCss(ths.playButton, "display", "none");
		}
		
		ths.initVideo = function(){
			ths.inited = true;
			ths.videoHolder.innerHTML = getVimeoEmbed(ths.data.vimeo_id);
			ths.iframe = $("iframe", ths.videoholder)[0];
			proto.wait(null, {func:ths.onVideoReady, duration:10});
			setCss(ths.iframe, "display", "none");
		}
		
		ths.onVideoReady = function(){
			setCss(ths.iframe, "display", "block");
			setCss($("img",ths.mainImage)[0], "display", "none");
			setCss(ths.videoHolder, "display", "block");
		}
	}
	
	ths.resize = function($totH){
		var halfH = Math.floor($totH/2);
		var newW;
		
		if(ths.data.img){
			var imgW = ths.data.img.normal.width;
			var imgH = ths.data.img.normal.height;
			newW = Math.floor(imgW*(halfH/imgH));
		}else{
			newW = parseInt(ths.data.width)+100;
		}
		
		// resize image:
		setCss(ths.mainImage, "width", newW);
		setCss(ths.mainImage, "height", halfH);
		
		// resize box div:
		setCss(ths.elem, "width", newW);
		setCss(ths.elem, "height", $totH);
	}
	
	preloadBox(ths.elem);
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] DOUBLEBLOCK 2 (news+yarubar) */
function Box_doubleBlock2($config){
	var ths = this;
	ths.data = $config.data;
	ths.orientation = ths.data.orientation;
	ths.elem = $config.elem;
	ths.mainImage = $(".mainImage", ths.elem)[0];
	ths.textblock = $(".textblock", ths.elem)[0];
	ths.textW = getTotalWidth(ths.textblock);
	ths.slideshow_div;
	ths.slideshow_prev
	ths.slideshow_next;
	ths.slider;
	// max image sizes:
	ths.maxImageWidth = 1;
	ths.maxImageHeight = 1;
	
	if(ths.data.images){
		for(var i=0; i<ths.data.images.length; i++){
			var w = ths.data.images[i].normal.width;
			var h = ths.data.images[i].normal.height;
			if(w > ths.maxImageWidth){
				ths.maxImageWidth = w;
				ths.maxImageHeight = h;
			}
		}
	}
	
	
	// init video:
	if(ths.data.vimeo_id){
		ths.iframe;
		ths.videoHolder = $(".video", ths.elem)[0];
		ths.playButton = $(".play", ths.elem)[0];
		ths.inited = false;
		
		ths.playButton.onclick = function(){
			if(!ths.inited)	ths.initVideo();
			setCss(ths.playButton, "display", "none");
		}
		
		ths.initVideo = function(){
			ths.inited = true;
			ths.videoHolder.innerHTML = getVimeoEmbed(ths.data.vimeo_id);
			ths.iframe = $("iframe", ths.videoholder)[0];
			proto.wait(null, {func:ths.onVideoReady, duration:10});
			setCss(ths.iframe, "display", "none");
		}
		
		ths.onVideoReady = function(){
			setCss(ths.iframe, "display", "block");
			setCss($("img",ths.mainImage)[0], "display", "none");
		}
	}
	
	
	// init slideshow:
	ths.slideshow_div = $(".slideshow", ths.elem)[0];
	ths.slideshow_prev = $(".prev", ths.slideshow_div)[0];
	ths.slideshow_next = $(".next", ths.slideshow_div)[0];
	if(ths.slideshow_div){	// next/prev buttons:
		ths.slider = new Slideshow_doubleblock2(ths.slideshow_div, false);
		if(ths.slideshow_prev && ths.slideshow_next){
			ths.slideshow_prev.onclick = ths.slider.previous;
			ths.slideshow_next.onclick = ths.slider.next;
			ths.slideshow_prev.onselectstart = ths.slideshow_next.onselectstart = function(){ return false };
		}
	}
	
	
	ths.resize = function($totH){		
		var newW;
		
		// VERTICAL: (image above text)
		if(ths.orientation == "vertical"){
			var halfH = Math.floor($totH/2);
			newW = Math.floor(ths.maxImageWidth*(halfH/ths.maxImageHeight));
			// resize image:
			setCss(ths.mainImage, "width", newW);
			setCss(ths.mainImage, "height", halfH);
		
			// resize box div:
			setCss(ths.elem, "width", newW);
			setCss(ths.elem, "height", $totH);
		}
		
		// HORIZONTAL: (images next to text)
		else if(ths.orientation == "horizontal"){
			newW = Math.floor(ths.maxImageWidth*($totH/ths.maxImageHeight));
			// resize image:
			setCss(ths.mainImage, "width", newW);
			setCss(ths.mainImage, "height", $totH);
		
			// resize box div:
			setCss(ths.elem, "width", newW + ths.textW);
			setCss(ths.elem, "height", $totH);
		}
		
		if(ths.slider)	ths.slider.resize(newW);
	}
	
	preloadBox(ths.elem);		// preload top image of slideshow
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] WORK THUMBS */
function Box_workThumbs($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.thumb_items = [];
	ths.filter = $(".filter", ths.elem)[0];
	ths.related = $(".related", ths.elem)[0];
	ths.fallback = !Modernizr.csstransforms3d;
	
	// ADD THUMB ITEMS:
	forEach($(".thumbs .item", ths.elem), function($i,$elem){
		ths.thumb_items.push(new Box_workThumbs_item($elem, ths.data.children[$i]));
	})
	
	// ADD THUMBS FILTER:
	if(ths.filter){
		var filters = [];
		var filter_handler = new Box_workThumbs_filter();
		var all_work = $("li.all a",ths.filter)[0];
		
		// init filter list:
		forEach($("li.category a",ths.filter), function($i, $elem){
			$elem.cnt = $i;
			$elem.onclick = function(){	filter_handler.toggleFilter(this.cnt);	}
			filters.push({elem:$elem, id:parseInt($elem.getAttribute("data")), active:false})
		})
		
		// 'all work'-button:
		all_work.onclick = filter_handler.deactivateAll;
		
		// init with data & thumbs:
		filter_handler.init(filters, ths.thumb_items, all_work);
	}

	ths.resize = function($totH){
		var totW = 0;
		if(ths.filter)		totW += getCss(ths.filter, "width");
		if(ths.related)	totW += getCss(ths.related, "width");
		
		// resize each thumb:
		forEach(ths.thumb_items, function($i, $item){
			$item.resize($totH);
			if($i%3==0)	totW += $item.boxW;
		})
		// resize box div:
		setCss(ths.elem, "width", totW);
		setCss(ths.elem, "height", $totH);
	}
	
	// preload all work thumb images:
	forEach(ths.thumb_items, function($i, $item){
		preloadBox($item.elem);
	})
	
	// fallback none-3dtransform-browsers:
	if(ths.fallback)	addClass(ths.elem, "fallback");
	
	// mobile support:
	//if(agent.mobile)	addClass(ths.elem, "mobile");
}


/*//////////////////////////////////////////////////////////////////////// WORK THUMBS: ITEM */
function Box_workThumbs_item($elem, $data){
	var ths = this;
	ths.elem = $elem;
	ths.data = $data;
	ths.filter_cats = [];	// array with coresponding filter id's for this item
	ths.filter_cats_active = 0;
	ths.dimmed = false;
	ths.mainImage = $(".mainImage", ths.elem)[0];
	ths.link = $("a",ths.elem)[0];
	ths.boxW;
	
	forEach(ths.data.categories, function($i, $elem){
		ths.filter_cats.push($elem.id);
	})
	
	ths.resize = function($totH){
		var thirdH = Math.floor($totH/3);
		var img = ths.mainImage;
		var imgW = ths.data.thumb.normal.width;
		var imgH = ths.data.thumb.normal.height;
		ths.boxW = Math.floor(imgW*(thirdH/imgH));
		
		// resize image
		setCss(img, "width", ths.boxW);
		setCss(img, "height", thirdH);
	}
	
	ths.setDimmed = function(){
		if(!ths.dimmed){
			removeClass(ths.elem, "active");
			addClass(ths.elem, "inactive");
			ths.dimmed = true;
		}
	}
	
	ths.setUndimmed = function(){
		if(ths.dimmed){
			removeClass(ths.elem, "inactive");
			addClass(ths.elem, "active");
			ths.dimmed = false;
		}
	}
	
	// mobile support: delay opening link until back if shown:
	if(agent.browser=="safari_mobile"){
		ths.link.src2 = ths.link.getAttribute("href");
		ths.link.setAttribute("href", "javascript:void(0)");
		ths.link.onmouseover = function(){
			proto.wait(null, {func:function(){
				ths.link.setAttribute("href", ths.link.src2);
			}, duration:5});
		}
		ths.link.onmouseout = function(){
			ths.link.setAttribute("href", "javascript:void(0)");
		}
	}
}

/*//////////////////////////////////////////////////////////////////////// WORK THUMBS: FILTER */
/*
$filters = [{elem, id, active},..]
$thumbs = [thumbitem-instance, ..]
*/
function Box_workThumbs_filter(){
	var ths = this;
	ths.filters;
	ths.thumbs;
	ths.all_work;
	ths.totalActive = 0;
	ths.allowMultiple = false;
	
	ths.init = function($filters, $thumbs, $all_work){
		ths.filters = $filters; 
		ths.thumbs = $thumbs;
		ths.all_work = $all_work;
	}
	
	ths.toggleFilter = function($id){
		if(!ths.filters[$id].active){
			ths.activateFilter($id);
		}else{
			if(ths.allowMultiple)	ths.deactivateFilter($id);
		} 
	}
	
	ths.activateFilter = function($id){
		var filter = ths.filters[$id];
		if(!filter.active){
			ths.totalActive++;
			filter.active = true;
		 	addClass(filter.elem, "active");
		 	
		 	if(!ths.allowMultiple){
				forEach(ths.filters, function($i,$item){
					if($item != filter && $item.active)	ths.deactivateFilter($i, true);
				})
			}
			
			forEach(ths.thumbs, function($i,$item){
				if($item.filter_cats.indexOf(filter.id) >-1)		$item.filter_cats_active++;
				ths.checkDimming($item);
			})
			
			ths.checkFilterNav();
		}
	}
	
	ths.deactivateFilter = function($id, $skip){
		var filter = ths.filters[$id];
		if(filter.active){
			ths.totalActive--;
			filter.active = false;
			removeClass(filter.elem, "active");
			
			forEach(ths.thumbs, function($i,$item){
				if($item.filter_cats.indexOf(filter.id) >-1)		$item.filter_cats_active--;
				if(!$skip)	ths.checkDimming($item);
			})
			if(!$skip)	ths.checkFilterNav();
		}
	}
	
	ths.deactivateAll = function(){
		ths.totalActive=0;
		// enable all buttons:
		forEach(ths.filters, function($i,$item){
			$item.active = false;
			removeClass($item.elem, "active");
		})
		
		forEach(ths.thumbs, function($i,$item){
			$item.filter_cats_active = 0;
			ths.checkDimming($item);
		})
		ths.checkFilterNav();
	}
	
	ths.checkDimming = function($item){
		if($item.filter_cats_active==0 && ths.totalActive>0)	$item.setDimmed();		
		else																	$item.setUndimmed();
	}
	
	ths.checkFilterNav = function(){
		if(ths.totalActive==0){
			addClass(ths.all_work, "active");
		}else{
			removeClass(ths.all_work, "active");
		}
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] WORK INFO */
function Box_workInfo($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] CLIENT LIST */
function Box_clientList($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	if(agent.browser=="ie" && agent.version==7){
		var w = 0;
		forEach($(".column", ths.elem), function($i,$elem){ w += getTotalWidth($elem, true); })
		if(w)	setCss($(".content",ths.elem)[0], "width", w);
	}
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] CONTACT INFO */
function Box_contactInfo($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	if(Modernizr.csstransforms){
		forEach($(".clock", ths.elem), function($i,$elem){
			setCss($elem, "display", "block");
			new Clock($elem);
		})
	}
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] CONTACT INFO */
function Box_yarubarFilters($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] LOAD MORE */
function Box_loadMore($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.blocked = false;
	
	ths.plus = $("span.plus", ths.elem)[0];
	ths.loader = $("span.loader", ths.elem)[0];
	
	// RESIZE:
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
	
	// READ VARIABLES:
	ths.method = ths.data.link.json.method;
	ths.filter_id = ths.data.link.json.filter_id;
	ths.next = ths.data.pagination.next;
	
	$("a",ths.elem)[0].onclick = function(){
		if(!ths.blocked){
			ths.blocked = true;
			ths.showLoader();
			
			var json = {};
			json.filter_id = ths.filter_id;
			json.method = ths.method;
			json.page = ths.next;
			json.iso = ISO;
			
			var loader = new Loader();
			loader.onComplete = function($response){
				var json;
				try{ json = JSON.parse($response); }catch($e){ json = {error:"unparseable json"}; }
				if(DEVEL) tracer("--- load more json", json)
				if(!json || json.error)		ths.onLoadError(json.error);
				else								proto.wait(null, {func:ths.onLoadOK, args:[json], duration:5});	// delayed show
			}
			
			loader.onError = function($error){ ths.onLoadError($error) };
			loader.load(PHP+'api.php?json='+encodeURIComponent(JSON.stringify(json)));
		}
	}
		
	/*------------------------------------- ON OK */
	ths.onLoadOK = function($json){
		for(var i=0; i<$json.blocks.length; i++){
			var block_data = $json.blocks[i];
			
			var node = createNode(block_data.response_html);
			insertNodeBefore(node, ths.elem);
			
			// add boxes in container:
			var config = {};
			config.data = block_data;
			config.type = block_data.type;
			config.elem = node;
			CONTAINER.addBox(config);
		}
		
		ths.next++;
		ths.blocked = false;
		ths.hideLoader();
		
		// end reached? remove more button:
		if($json.pagination.next==null)	ths.dispose();
	}
	
	/*------------------------------------- ON ERROR */
	ths.onLoadError = function($error){
		tracer("Box_loadMore error", $error);
		setCss(ths.plus, "display", "inline-block");
		setCss(ths.loader, "display", "none");
		ths.blocked = false;
	}
	
	/*------------------------------------- SHOW/HIDE LOADER */
	ths.showLoader = function(){
		setCss(ths.plus, "display", "none");
		setCss(ths.loader, "display", "inline-block");
	}
	ths.hideLoader = function(){
		setCss(ths.plus, "display", "inline-block");
		setCss(ths.loader, "display", "none");
	}
	
	/*------------------------------------- DISPOSE */
	ths.dispose = function(){
		CONTAINER.removeBox(ths.elem);
	}
	
	// no more items? remove 'more'-box:
	proto.wait(null, {duration:1, func:function(){
		if(ths.next===null)	ths.dispose();
	}})
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] SHOW ALL */
function Box_showAll($config){
	var ths = this;
	ths.elem = $config.elem;
	
	// RESIZE:
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] WORK OVERVIEW */
function Box_workOverview($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] NEWSLETTER */
function Box_newsletter($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	ths.button = $(".button", ths.elem)[0];
	ths.field_email = $("input", ths.elem)[0];
	ths.error = $(".error", ths.elem)[0];
	ths.blocked = false;
	ths.step1 = $(".form_step1", ths.elem)[0];
	ths.step2 = $(".form_step2", ths.elem)[0];
	
	/*------------------------------------- SUBMIT */
	ths.form_submit = function(){
		if(!ths.blocked){
			ths.blocked = true;
			setCss(ths.error, "visibility", "hidden");
			
			// VALIDATE FIELDS (forms.js):
			var ok = true
			if(ok)	ok = validateField(ths.field_email, "email", ths.form_onError, DICT.newsletter_invalidemail);
			
			// SUBMIT:
			if(ok){
				var json = new Object();
				json.method = ths.data.link.json.method;
				json.email = getFieldValue(ths.field_email);
				json.iso = ISO;
				
				var loader = new Loader();
				loader.onComplete = function($response){	// onComplete:
					$json = JSON.parse($response);
					if($json.status=="ok")	ths.form_onSubmitted($json);
					else							ths.form_onError(DICT.newsletter_error);
				}
				
				loader.onError = function($error){			// onError:
					ths.form_onError(DICT.newsletter_error + " (" +$error+ ")");
				}
				
				//------ init load:
				loader.load(PHP+'api.php?json='+encodeURIComponent(JSON.stringify(json)));
			}
		}
	}
	
	/*------------------------------------- SUBMIT: OK */
	ths.form_onSubmitted = function($json){
		setCss(ths.step1, "display", "none");
		setCss(ths.step2, "display", "block");
		proto.tween(ths.step2, {prop:"opacity", start:0, end:1, delay:15}) 
		ths.blocked = false;
	}
	
	/*------------------------------------- SUBMIT: ERROR */
	ths.form_onError = function($error){
		insertHtml(ths.error, $error);
		setCss(ths.error, "visibility", "visible");
		proto.tween(ths.error, {prop:"opacity", start:0, end:1, duration:5});
		ths.blocked = false;
	}
	
	/*------------------------------------- RESIZE */
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
	
	/*------------------------------------- INIT */
	ths.field_email.onkeypress = function(){	if(event.keyCode==13||event.which==13)	ths.form_submit(); }
	ths.button.onclick = ths.form_submit;
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] 404 */
function Box_fourohfour($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// [BOX] 404 */
function Box_newsletter_unsubscribe($config){
	var ths = this;
	ths.data = $config.data;
	ths.elem = $config.elem;
	
	ths.resize = function($totH){
		setCss(ths.elem, "height", $totH);
	}
}


/* //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// VARIOUS */
/*------------------------------------- PRELOAD MAIN IMAGE */
function preloadBox($elem){
	var mainImage = $(".mainImage img.main", $elem)[0];
	if(mainImage){
		setCss(mainImage, "opacity", "0");
		
		var preloader = new PreloadImage(mainImage.src);
		preloader.mainImage = mainImage;
		preloader.onComplete = function($ok){
			if(Modernizr.csstransitions){
				addClass(this.mainImage, "fadein");
				proto.wait(null, {func:setCss, args:[this.mainImage, "opacity", "1"], duration:1});
			}else{
				setCss(this.mainImage, "opacity", 1);
			}
		}
		preloader.init();
	}
}


/*------------------------------------- ANALOG CLOCK */
function Clock($elem){
	var ths = this;
	ths.elem = $elem;
	ths.ampm = $(".ampm", ths.elem)[0];
	ths.date = new Date(ths.elem.getAttribute("data-time"));
	ths.date = new Date( ths.date.getTime() + new Date().getTimezoneOffset()*60*1000 );		// new date that is converted to local timezone.
	
	ths.hour = ths.date.getHours();
	ths.minute = ths.date.getMinutes();
	
	ths.setClock = function(){
		var ampm = "AM";
		var hour = ths.hour;
		if(ths.hour >= 12){
			if(ths.hour > 12)	hour -= 12;
			ampm = "PM";
		}
		var hourAngle = (360/12)*hour + (360/(12*60))*ths.minute;
		var minuteAngle = (360/60)*ths.minute;
		
		hourAngle = Math.round(hourAngle/12)*12;
		minuteAngle = Math.round(minuteAngle/12)*12;
		
		setCss($(".minute", ths.elem)[0], "rotate", minuteAngle, null, true);
		setCss($(".hour", ths.elem)[0], "rotate", hourAngle);
		
		//insertHtml(ths.ampm, addDigits(hour) + ":"+addDigits(ths.minute) + " " +ampm);
		insertHtml(ths.ampm, ampm);
	}
	
	ths.tick = function(){
		ths.minute++;
		if(ths.minute>59){
			ths.hour++
			ths.minute=0;
		}
		if(ths.hour >= 24)	ths.hour -= 24;
		ths.setClock()
	}
	
	setInterval(ths.tick, 60*1000);	// 60*1000
	ths.setClock();
}


/*------------------------------------- VIMEO STUFF */
function getVimeoEmbed($vimeo_id){
	return '<iframe id=vid_'+$vimeo_id+' src="http://player.vimeo.com/video/'+$vimeo_id+'?api=1&autoplay=1&player_id=vid_'+$vimeo_id+'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}

/* Vimeo event handling - ONLY WORKS WITH HTML5 PLAYER ! */
/*
function onVimeoMessage($e){
	var data = JSON.parse($e.data);
	var iframe = $("#"+data.player_id);
	var url = iframe.getAttribute('src').split("?")[0];
	switch(data.event){
		case 'ready':
			//post(iframe, url, 'addEventListener', 'pause');
			//post(iframe, url, 'addEventListener', 'finish');
			//post(iframe, url, 'addEventListener', 'playProgress');
			if(iframe.onReady)	iframe.onReady();
		break;
		case 'playProgress':
			//iframe.onPlayProgress(data)
		break;
		case 'pause':
			//iframe.onPause()
		break;
		case 'finish':
			//iframe.onFinish()
		break;
	}
}
addEvent(window, "message", onVimeoMessage);

function post($iframe, $url, action, value){
	var data = { method:action };
	if(value) data.value = value;
	$iframe.totalWindow.postMessage(JSON.stringify(data), $url);
}
*/

