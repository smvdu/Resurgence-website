/*
* PreloadImages v1.4 (sept 14, 2012)
* Copyright (c) group94 - http://www.group94.com
* Unauthorised use, copying and/or redistributing is strictly prohibited.
*
* CHANGELOG
v1.4		Added init() functions.
v1.3		Added support for IE7/8 (skips preloading).
			Removed reference to new Image() instance after completion (memory optimisation).

*
* USAGE:
	//----------------------- MULTIPLE IMAGES
	proto.registerInit(function(){
		var imgs_arr = ["library/image1.jpg","library/image2.jpg"]
		var preloader = new PreloadImages(imgs_arr)
		
		preloader.onProgress = function($num, $ok){}		// $num = number of image loaded // $ok = loadstatus
		preloader.onComplete = function(){}					// all requested images loaded
		preloader.init();
	})
	
	//----------------------- SINGLE IMAGE
	proto.registerInit(function(){
		var img = $(".itemke img")[0];
		setCss(img, "opacity", 0);
		
		var preloader = new PreloadImage(img.src);
		preloader.imgRef = img;
		preloader.onComplete = function($ok){
			setCss(this.imgRef, "opacity", 1);
		}
		preloader.init();
	}
*/

function PreloadImages($images){
	var ths = this;
	
	ths.images = $images;
	ths.total = ths.images.length;
	ths.loaded = 0;
	ths.progress = 0;
	
	ths.imageLoaded = function($ok){
		ths.loaded++
		ths.progress = ths.loaded/ths.total
		if(ths.onProgress)	ths.onProgress(ths.progress, $ok)
		if(ths.loaded == ths.total && ths.onComplete)	ths.onComplete()
	}
	
	ths.init = function(){
		for(var i=0; i<ths.images.length; i++){
			var img = new PreloadImage(ths.images[i]);
			img.onComplete = ths.imageLoaded;
			img.init();
		}
	}
}


function PreloadImage($img){
	var ths = this;
	
	ths.imageLoaded = function($ok){
		if(ths.onComplete)	ths.onComplete($ok);
	}
	
	ths.init = function(){
		if(agent.browser=="ie" && agent.version<9){		// preloading does not work here
			ths.imageLoaded(true);
			
		}else{
			var img = new Image();
			
			img.onload = function(){
				ths.imageLoaded(true);
				img = null;
			}
			img.onerror = function(){
				ths.imageLoaded(false);
				img = null;
			}
			img.src = $img;
		}
	}
}