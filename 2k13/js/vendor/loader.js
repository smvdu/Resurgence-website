$(document).ready(function() {
	
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
							document.onkeydown=function(a){
								openSesame();};
						}
					}
		},delay);
	}
	
});