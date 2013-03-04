var interval=0,delay=30;

$(document).ready(function() {

	var imgs=[];
    var imgsLength=7;
    
    var imgSrc = ["../img/s1.jpg",
    	"../img/s2.jpg",
    	"../img/s3.jpg"
    	"../img/s4.jpg"
    	"../img/s5.jpg"
    	"../img/s6.jpg"
    	"../img/s7.jpg"]

    var imgsLoaded=0;

	pcLoadImg=document.getElementById('pcLoadImg');
	pcLoadImg2=document.getElementById('pcLoadImg2');
	pcLoadHr=document.getElementById('pcLoadHr');
	
	function loadIndicate()
	{
	if(interval) return;
	interval = setInterval (function() {
					num=parseInt($('#pc').text());
					if(num<pc){
						pcLoadImg.style.width=(4.5*num+1)+'px';
						pcLoadImg2.style.width=(447-4.5*num)+'px';
						pcLoadHr.style.width=(4.5*num+1)+'px';
						$('#pc').text(num+1);
					}
					else{
						clearInterval(interval);
						interval=0;
						if(pc>=100){
							$('.loadtemp').animate({opacity:0},500,'linear',function(){
								$('.loadperm').animate({opacity:1},500);
							});
							
						}
					}
		},delay);
	}

	function imageLoaded(){
	imgsLoaded=imgsLoaded+1;
	pc=Math.round((imgsLoaded/imgsLength)*100);
	if(pc<100)
		loadIndicate();
	}


	imgsLength = imgSrc.length;

	for(var b=0; b < imgSrc.length; b++)
	{
		if(imgSrc[b]==='undefined')continue;
		var c = new Image();
		c.onload=function(){
			imageLoaded();};

		c.onerror=function(){imageLoaded();};

		c.src=imgSrc[b];
	}
});