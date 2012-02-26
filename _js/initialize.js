/*
http://resurgence.smvdu.net.in
@author: Saurabh Kumar
		 (http://saurabhworld.in)
*/
$(document).ready(function() {

			
			 var content = $('#content');
			 content.css({opacity: 0, marginTop: '300px'});
			 $load=true;
			 $('body').mousemove(function(){
				if($load == true){
					$(".rope").trigger('click');
					$load = false;
				}
			});
			 
			 //curtain
			$curtainopen = false;
		
			$(".rope").click(function(){
				$(this).blur();
				var width=$(document).width();
				var width= -width/2*0.9;
				if ($curtainopen == false){ 
					$(this).stop().animate({top: '0px' }, {queue:false, duration:350, easing:'easeOutBack'}); 
					//$(".leftcurtain").stop().animate({width:'60px'}, 2000 );
					//$(".rightcurtain").stop().animate({width:'60px'},2000 );
					$(".leftcurtain").stop().animate({left: width}, 2000,'linear');
					$(".rightcurtain").stop().animate({right:width}, 2000,'linear');
					$curtainopen = true;
					content.stop().animate({marginTop:0, opacity: '1'},1500,'easeOutBack');
					
					
				}else{
					$(this).stop().animate({top: '-30px' }, {queue:false, duration:350, easing:'easeInBack'}); 
//					$(".leftcurtain").stop().animate({width:'50%'}, 2000 );
//					$(".rightcurtain").stop().animate({width:'51%'}, 2000 );
					$(".leftcurtain").stop().animate({left:'0'}, 2000, 'linear' );
					$(".rightcurtain").stop().animate({right:'0'}, 2000,'linear' );

					$curtainopen = false;
					content.stop().animate({marginTop:'300px', opacity: '0'},1500, 'easeInBack');
					
				}
				return false;
			});
			
			//twitter updates
			$("#twitter").getTwitter({
				userName: "resurgenceSMVDU",
				numTweets: 5,
				loaderText: "Loading updates...",
				slideIn: true,
				slideDuration: 750,
				showHeading: true,
				headingText: "Latest Updates",
				showProfileLink: false,
				showTimestamp: true
			});	
			
			
			//pop-ups fancy box
			//$.fancybox.showActivity
			
			$("#schedule").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});

			$("#cultural_events_list").fancybox({
				'width'				: '60%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});	
			
			$("#contacts").fancybox({
				'width'				: '60%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});	

			$("#map").fancybox({
				'width'				: '60%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});
			$("#registrationForm").fancybox({
				'width'				: '60%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});
			
			$("#medal_tally").fancybox({
				'width'				: '80%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});

			$("#videos").fancybox({
				'autodimensions'	: true,
				'width'				: 740,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});

			$("#registrationForm_btn").fancybox({
				'width'				: '60%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});			
   
			$("#sports_brochure").fancybox({
				'width'				: '70%',
				'height'			: '70%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});	
			$("#rulebook_cultural").fancybox({
				'width'				: '70%',
				'height'			: '70%',
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
			});	
		//photo Gallery			
		$("#photo").click(function() {
		$.fancybox([
			 'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383420742740_374421127740_4291268_4580507_n.jpg',			
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420757740_374421127740_4291271_3442371_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420762740_374421127740_4291272_8092622_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420777740_374421127740_4291274_6759768_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383420857740_374421127740_4291286_3157880_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420862740_374421127740_4291287_2672788_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420702740_374421127740_4291261_7263078_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420692740_374421127740_4291259_4022945_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420802740_374421127740_4291278_5558803_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420807740_374421127740_4291279_2679602_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420822740_374421127740_4291281_7138071_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383420832740_374421127740_4291282_5263489_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383420882740_374421127740_4291291_2902524_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383041947740_374421127740_4284870_7271228_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383042022740_374421127740_4284884_5990577_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383042052740_374421127740_4284888_5238073_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383042032740_374421127740_4284885_6133795_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383041977740_374421127740_4284875_912443_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383420712740_374421127740_4291262_1152735_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420867740_374421127740_4291288_6248589_n.jpg',  
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383041972740_374421127740_4284874_6472128_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383042042740_374421127740_4284887_1654878_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383042072740_374421127740_4284891_3389646_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383042007740_374421127740_4284881_6388017_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-ash1/hs424.ash1/23475_383042092740_374421127740_4284893_4556369_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383042102740_374421127740_4284894_3162695_n.jpg',
			'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs384.snc3/23475_383041927740_374421127740_4284867_2916212_n.jpg',
						{  'href'	: 'http://sphotos.ak.fbcdn.net/hphotos-ak-snc3/hs364.snc3/23475_383420737740_374421127740_4291267_8046578_n.jpg',
				'title'	: '....thnk u :)'}
		], {
			'padding'			: 3,
			'centerOnScroll'	: true,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'type'              : 'image',
			'changeFade'        : 5,
			'titlePosition' 	: 'over',
			'onComplete'	:	function() {
				$("#fancybox-wrap").hover(function() {
					$("#fancybox-title").show();
				}, function() {
					$("#fancybox-title").hide();
				});
			}
		});
});
});


var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

try {
var pageTracker = _gat._getTracker("UA-16351077-3");
pageTracker._trackPageview();
} catch(err) {}