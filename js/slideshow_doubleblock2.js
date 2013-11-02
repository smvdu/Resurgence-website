/*
* Slideshow v1.0 (dec 20, 2011)
* Copyright 2011 group94 - http://www.group94.com
* Unauthorised use, copying and/or redistributing is strictly prohibited
*
* ---- MODIFIED FOR YANG RUTHERFORD ----
*
*/

function Slideshow_doubleblock2($div, $autoSwitch, $switchTime){
	var ths = this;
	
	// SETTINGS
	ths.moveSpeed = 15;
	ths.defaultSwitchTime = 8*30;
	ths.imageWidth;		// updated in resize
	ths.imageMargin = 0;
	ths.waitID = "_slideshow"+Math.random().toString(36).substr(2,10);
	ths.blocked = false;
	
	// GET ELEMENTS
	ths.div = $div;
	ths.images = $("img.main", ths.div);
	
	// SET VARS
	ths.total = ths.images.length;
	ths.actID = null;
	ths.isPlaying = true;
	ths.autoSwitch = $autoSwitch;
	ths.switchTime = $switchTime ? $switchTime : ths.defaultSwitchTime;
	
	
	/*------------------------------------- showImage */
	ths.showImage = function($id, $auto, $dir){
		if($id != ths.actID && !ths.blocked){
			// calculate positions
			var pos_end = -(ths.imageWidth+ths.imageMargin);
			var pos_start = ths.imageWidth+ths.imageMargin;
			if(($id < ths.actID && $dir != "next") || $dir=="prev"){		// switch pos_end & pos_start values
				var p=pos_end; pos_end=pos_start; pos_start=p;
			}
			
			if(ths.actID !== null){
				var oldImg = ths.images[ths.actID];
				var newImg = ths.images[$id];
				
				//---------------------------- webkit animation:
				if(Modernizr.csstransitions){
					// move OLD image:
					if($dir){
						addClass(oldImg, "move");
						proto.wait("move_old", {duration:1, func:function(){ setCss(oldImg, "left", pos_end); }})
					}else{
						setCss(oldImg, "left", pos_end);
					}
					
					// move NEW image:
					if($dir){
						removeClass(newImg, "move");
						setCss(newImg, "left", pos_start);
						proto.wait("move_new", {duration:1, func:function(){
							addClass(newImg, "move");
							setCss(newImg, "left", 0);
						}})
					}else{
						setCss(newImg, "left", 0);
					}
					
				//---------------------------- javascript fallback:	
				}else{
					// old image
					if(ths.actID != null)	proto.tween(oldImg, {prop:"left", end:pos_end, round:1, duration:ths.moveSpeed});
					
					// new image
					proto.tween(newImg, {prop:"left", start:pos_start, end:0, round:1, duration:ths.moveSpeed});
				}
				
				// temporarily block:
				ths.blocked = true;
				proto.wait(null, {duration:ths.moveSpeed, func:function(){ ths.blocked = false; }})
			}
			
			ths.actID = $id;
			
			// autoswitch:
			if(ths.autoSwitch && ths.total>1){
				if($auto)	ths.addWait();
				else			ths.pause();
			}
		}
	}
	
	
	/*------------------------------------- next / prev */
	ths.next = function($auto){
		if(!ths.blocked){
			var id = ths.actID+1;
			if(id>=ths.total)	id = 0;
			ths.showImage(id, $auto, "next");
		}
	}
	ths.previous = function(){
		if(!ths.blocked){
			var id = ths.actID-1;
			if(id<0)	id = ths.total-1;
			ths.showImage(id, false, "prev");
		}
	}
	
	
	/*------------------------------------- resize */
	ths.resize = function($totW){
		ths.imageWidth = $totW;
	}
	
	
	/*------------------------------------- pause / play */
	ths.pause = function(){
		if(ths.isPlaying){
			proto.disposeWait(ths.waitID);
			ths.autoSwitch = false;
			ths.isPlaying = false;
			if(ths.pauseBtn)	setCss(ths.pauseBtn, "display", "none");
			if(ths.playBtn)	setCss(ths.playBtn, "display", "inline");
		}
	}
	ths.play = function($skip){
		if(!ths.isPlaying){
			ths.addWait();
			ths.autoSwitch = true;
			ths.isPlaying = true;
			if(ths.pauseBtn)	setCss(ths.pauseBtn, "display", "inline");
			if(ths.playBtn)	setCss(ths.playBtn, "display", "none");
			if(!$skip)	ths.next(true);
		}
	}
	
	ths.addWait = function(){
		proto.wait(ths.waitID, {func:ths.next, duration:ths.switchTime, args:[true], scope:this})
	}
	
	
	/*------------------------------------- init */
	ths.showImage(0, true);		// show first image
}