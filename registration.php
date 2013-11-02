<?php
	//require_once('php/connect.php');
	
    $missing=array();
    $successful=false;
	if(isset($_POST['submit']))
	{
		
    	include("php/functions.php");
    	if( check_fields($_POST,$missing)==true )
    	{
    		if( check_accomodation_value($_POST['accomodation'],$missing)==true)
    		{
    			
    			if( check_email_register($_POST['email_id'],$missing)==true )
    			{
    				$sql = "INSERT INTO register(`email_id`,`college`,`accomodation`) 
    			        VALUES(
    			        	'".$_POST['email_id']."',
    			        	'".$_POST['college']."',
    			        	'".$_POST['accomodation']."')";
					$query = mysql_query($sql) or die(mysql_error());
				
					$successful=true;
    			}
    			else
    			{
    				$msg="This email id is already registered.";
    				$successful=false;
    			}
    			
    			
    		}	
    		else
    		{
    			$msg="Please enter YES/NO in accomodation field.";
    			$successful=false;

    		}
    	}
    	else
    	{
    		$msg="Please enter correct values in fields. ";
    		$successful=false;
    	}
    	
	}
?>
<!DOCTYPE html>
<html style="background-color:#000;"  class="chrome" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		
		<title>Resurgence 2k13 | Annual Cultural, Literary and Sports fest of SMVDU</title>
		<meta name="description" content="Resurgence is an annual cultural, Literary and Sports fest of Shri Mata Vaishno Devi University, Katra, Jammu, J & K"/>
		<meta name="keywords" content="Resurgence, annual fest, cultural, Literary, Sports, SMVDU, Shri Mata Vaishno Devi University, Katra, Jammu"/>

		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<meta http-equiv="content-language" content="en"/>
		<meta http-equiv="cache-control" content="no-cache"/>
		<meta http-equiv="expires" content="-1"/>
		<meta http-equiv="pragma" content="no-cache"/>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1"/>

		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/components.css" />
		<link rel="stylesheet" type="text/css" href="css/1.css" />

		<script type="text/javascript">
			var agent = {"browser":"chrome","version":26,"version_long":"26.0.1410.43","os":"windows","mobile":false,"device":"desktop","string":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.31 (KHTML, like Gecko) Chrome\/26.0.1410.43 Safari\/537.31"};
			var DEVEL = false;
			var SITE_ID = "Resurgence_2k13";
			var VERSION = "desktop";
			var FULL_URL = "http://resurgence.smvdu.net.in/";
			var URL = "about.php";
			var QUERY = "";
			var LANGUAGE = "en";
			var ISO = "en_gb";
			var SITE_COOKIE_ID = "Resurgence_2k13_site_cookie";
			var USER_COOKIE_ID = "Resurgence_2k13_user_cookie";
			var WEBROOT = "http://resurgence.smvdu.net.in/";
			var URLROOT = "http://resurgence.smvdu.net.in/";
			var LIBRARY = "http://resurgence.smvdu.net.in/library/";
			var IMG = "http://resurgence.smvdu.net.in/img/";
			var SWF = "http://resurgence.smvdu.net.in/swf/";
			var PHP = "http://resurgence.smvdu.net.in/php/";
			var DICT = {"newsletter_error":"An error has occurred, please try again.","newsletter_invalidemail":"Please enter a valid email address"};
		</script>

		<script type="text/javascript" src="js/836b4db5-2dd1-41e0-8954-6259cf540421.js"></script>	<!-- didot font -->
		<script type="text/javascript" src="js/proto.js"></script>
		<script type="text/javascript" src="js/components.js"></script>
		<script type="text/javascript" src="js/preloadImages.js"></script>
		<script type="text/javascript" src="js/slideshow_doubleblock2.js"></script>
		<script type="text/javascript" src="js/forms.js"></script>




		<link rel="shortcut icon" href="favicon.ico"/>
		<link rel="apple-touch-icon" sizes="114x114 icon" href="apple_touch_logo.png"/>

		<meta property="og:title" content="Resurgence 2k13"/>
		<meta property="og:image" content="library/share-C0ZJ.jpg?cache=865970469"/>
		<meta property="og:description" content="Resurgence is an annual cultural, Literary and Sports fest of Shri Mata Vaishno Devi University, Katra, Jammu, J & K"/>
		<meta property="og:site_name" content="Resurgence"/>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-39966921-1', 'smvdu.net.in');
		  ga('send', 'pageview');

		</script>
		
			</head>

	<body>
		
				
		
		<div id="container" style="overflow:hidden; background: url('img/back.png') repeat;">
			<script type="text/javascript">
				// immediately hide container until init:
				setCss($("#container"), "display", "none");
			</script>
			
			<div class="centered">
				
						
				
		<div id="mainnav">
			<div class="panel closed">
				<div class="slice s1">
					<div class="menu">
						<div class="content">
									
									<ul>
										<li class="active"><a href="index.php">Home</a></li>
										<li><a href="registration.php">Registration</a></li>
										<li><a href="events.php">Events</a></li>
										<li><a href="schedule.php">Schedule</a></li>
										<li><a href="gallery.php">Gallery</a></li>
										<li><a href="contact.php">Contact</a></li>
										<br/>
										
									</ul>
								</div>
							</div>					
							<div class="slice s2">
								<div class="menu">
									<div class="content">
										
										<ul>
											<li class="active"><a href="index.php">Home</a></li>
											<li><a href="registration.php">Registration</a></li>
											<li><a href="events.php">Events</a></li>
											<li><a href="schedule.php">Schedule</a></li>
											<li><a href="gallery.php">Gallery</a></li>
											<li><a href="contact.php">Contact</a></li>
											<br/>
											
										</ul></div></div>						
						<div class="slice s3">
							<a id="menu_button" href="javascript:void(0)" onclick="javascript:MAIN_NAV.toggleMenu()">
								<span class="content">
									<img src="img/logo.png" width="42"/>
									<p>menu<br/></p>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="jumpToMenu">
			<div class="image">
				<div class="content">
					<img src="http:///img/logo.png" width="42"/>
					<p>menu<br /></p>
				</div>
			</div>
		</div>
		
		
		
		<script type="text/javascript">
			var MAIN_NAV = new MainNav();
			proto.registerInit(MAIN_NAV.init);
			setCss($("#mainnav"), "overflow", "hidden");
		</script>
		
						
		<div class="blocks">

            <!-- ldsfjlsadkjf -->
            <form name='registration' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  >
	            <div id="container">

	            	<?php if($successful==true){  ?>
	              <div id="message">
					<span class="big">Thanks</span> for registering for <span class="resurgence"> RESURGENCE 2K13</span>.<br><br>
					<span class="small">You will be notified with the latest updates for resurgence 2k13.</span><br>

	              </div>
	              <?php }?>
	              <?php if($successful==false){  ?>
	              <!--<div class="message">* Online Registrations will be started from 12th of april after 5 pm .</div>-->
				  <div class="labels">
				  <!--  <div id="fName_label"><label for="first_name">First Name:</label></div>
				    <div id="lName_label"><label for="last_name">Last Name:</label></div>-->
				    <div id="email_label"><label for="email_id">Email id of Registrant:</label></div>
				    <div id="college_lable"><label for="college">College/University:</label></div>
				    <div id="accomodation_label"><label for="accomodation">Accomodation Required:</label></div>
				  </div>
				  
				  <div class="details">
				      
				   <!--   <div class="field_block"><input type="text" name="first_name" placeholder="Your First Name" required="required"/></div>
				      <div class="field_block"><input type="text" name="last_name" placeholder="Your Last Name" required="required"/></div>-->
				      <div class="field_block"><input type="email" name="email_id" placeholder="email address" required="required"/></div>
				      <div class="field_block"><input type="text" name="college" placeholder="University/College" required="required"/></div>
				      <div class="field_block"><input type="text" name="accomodation" placeholder="Yes/No" required="required"/></div>
				       
				  </div>

				  <?php } ?>
				  <div id="register_tag"><p>Register</p></div>
				  <?php
				   if($successful==false){  

				   		if( !empty($missing) )
				   		{
				   ?>
				   		<div class="warning"><?php echo $msg;?></div>
				   	<?php }?>

				  <div id="submit">
				  	<input  type="submit" name="submit" value="Submit"  />
				  </div>
				  <?php }?>
				</div>
			</form>

            <!-- slajdfljsdaf -->


					<div class="box wideImage" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src=""/></div><div class="textblock"></div></div>

<div class="box doubleBlock1 bottom" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src=""/></div><div class="textblock" style="width:300px;">
</h2></div></div>

<div class="box imageText" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/JW-31OI.jpg"/></div><div class="textblock"><h4 class="black">PASSIONATE</h4><h2 class="gray">Our founding partners <br />
have been pursuing <br />
creative excellence and <br />
innovation for some of <br />
the world's largest and <br />
smallest organisations <br />
for over 26 years. </h2></div></div>

<div class="box doubleBlock1 top" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/strategy-6GZZ.jpg"/></div><div class="textblock" style="width:400px;"><h4>strategic</h4><h2>Our team works closely with clients <br />
to define the strategies, ideas and actions <br />
needed to deliver commercial success<br />
in an ever changing world.</h2></div></div>

<div class="box wideImage" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/tiger_2-HBUX.jpg"/></div><div class="textblock"><div class="content"><h1 class="white">East & West</h1><h2 class="white">Our European and Asian offices work as one on every project</h2></div></div></div>

<div class="box doubleBlock1 bottom" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/ipad_KEF-copy-YKYV.jpg"/><div class="play"><div class="holder"><div class="image"></div></div></div><div class="video"></div></div><div class="textblock" style="width:300px;"><h4>COMPELLING</h4><h2>We have earned a reputation <br />
for connecting brands to people <br />
through memorable and emotional <br />
creative at every touchpoint.</h2></div></div>

<div class="box imageText" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/STYLE_COVER-RSSL.jpg"/></div><div class="textblock"><h4 class="white">CONCISE</h4><h2 class="white">Often it’s what <br />
we don’t say <br />
that speaks <br />
volumes.</h2></div></div>

<div class="box imageText" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/ABOUT14-EB1L.jpg"/></div><div class="textblock"><h4 class="white">R&D</h4><h2 class="gray">We create and produce <br />
rare and distinctive <br />
customer experiences <br />
because - although time <br />
consuming to research <br />
and develop - they make<br />
our clients stand out.</h2></div></div>

<div class="box imageText" style="display:none;"><div class="mainImage"><img class="loader" src="http:///img/loader2.gif" width="14" height="14"/><img class="main" src="http:///library/YR_LONDON-UIBI.jpg"/></div><div class="textblock"><h4 class="white">Services</h4><h2 class="gray">Brand Strategy:<br />
Brand DNA<br />
Positioning<br />
Brand Expression<br />
Naming<br />
<br />
Brand Design:<br />
Identity<br />
Brand Language<br />
Environment<br />
Packaging<br />
Print <br />
Publication<br />
Structural Design<br />
Signage<br />
<br />
Communication:<br />
Advertising<br />
Brand Experience<br />
Marketing Collateral<br />
Website & Interactive<br />
Art Direction<br />
Film & Photography<br />
Copywriting<br />
Theming<br />
Guidelines</h2></div></div>

<div class="box clientlist" style="display:none;"><div class="content"><h4>our clients</h4><h2>Select a client or project to view our work</h2><div class="columns clearfix"><div class="column"><h4>Hospitality</h4><p class="bodytext">A Curious Group of Hotels</p><p class="bodytext">City of Dreams</p><p class="bodytext"><a href="http:///en/work/cowley-manor" target="_self">Cowley Manor</a></p><p class="bodytext"><a href="http:///en/work/east-beijing" target="_self">EAST Beijing</a></p><p class="bodytext">EAST Hong Kong</p><p class="bodytext"><a href="http:///en/work/hotel-icon" target="_self">Hotel Icon</a></p><p class="bodytext"><a href="http:///en/work/hyde-hotels" target="_self">Hyde Hotels</a></p><p class="bodytext"><a href="http:///en/work/l-hotel" target="_self">L'Hotel Paris</a></p><p class="bodytext"><a href="http:///en/work/new-world-hospitality" target="_self">New World Hospitality</a></p><p class="bodytext"><a href="http:///en/work/rosewood-hotels-resorts" target="_self">Rosewood Hotels and Resorts</a></p><p class="bodytext">Sands Casino & Resorts</p><p class="bodytext">Shangri-La Magazine</p><p class="bodytext"><a href="http:///en/work/swire-hotels" target="_self">Swire Hotels</a></p><p class="bodytext"><a href="http:///en/work/the-opposite-house" target="_self">The Opposite House</a></p><p class="bodytext"><a href="http:///en/work/upper-house" target="_self">The Upper House</a></p><p class="bodytext"><a href="http:///en/work/the-workshop" target="_self">The Workshop</a></p><p class="bodytext"><a href="http:///en/work/u-hotels" target="_self">U Hotels</a></p></div><div class="column"><h4>Restaurants & Bars</h4><p class="bodytext"><a href="http:///en/work/above-beyond" target="_self">Above & Beyond</a></p><p class="bodytext">Bei</p><p class="bodytext"><a href="http:///en/work/domain" target="_self">Domain</a></p><p class="bodytext"><a href="http:///en/work/feast" target="_self">Feast</a></p><p class="bodytext">Green</p><p class="bodytext"><a href="http:///en/work/hagaki" target="_self">Hagaki</a></p><p class="bodytext">Le Restaurant Paris</p><p class="bodytext">Punk - Beijing</p><p class="bodytext"><a href="http:///en/work/sugar" target="_self">Sugar</a></p><p class="bodytext">Sureno</p><p class="bodytext">The Market</p><p class="bodytext"><a href="http:///en/work/xian" target="_self">Xian</a></p></div><div class="column"><h4>Real Estate</h4><p class="bodytext"><a href="http:///en/work/two-two-six" target="_self">226</a></p><p class="bodytext">Blake's Advisors</p><p class="bodytext">BLV Realty Organisation Inc</p><p class="bodytext">Chow Tai Fook</p><p class="bodytext">CTF Guanghzou</p><p class="bodytext">Fantasia Holdings</p><p class="bodytext">Gammon Construction</p><p class="bodytext"><a href="http:///en/work/grosvenor-crescent" target="_self">Grosvenor Crescent</a></p><p class="bodytext"><a href="http:///en/work/karma-lakelands" target="_self">Karma Lakelands</a></p><p class="bodytext">Nan Fung Group</p><p class="bodytext">New World Development</p><p class="bodytext"><a href="http:///en/work/ocean-3651" target="_self">Ocean 3651</a></p><p class="bodytext">Summer Group</p><p class="bodytext">Swire Properties</p><p class="bodytext">Unitech Group</p><p class="bodytext"><a href="http:///en/work/winfield" target="_self">Winfield</a></p><p class="bodytext">World Resorts</p></div><div class="column"><h4>Fashion & Retail</h4><p class="bodytext">Debenhams</p><p class="bodytext">Gee</p><p class="bodytext"><a href="http:///en/work/givenchy" target="_self">Givenchy</a></p><p class="bodytext">Hugo Boss</p><p class="bodytext"><a href="http:///en/work/wwwjosephinehomecouk" target="_self">Josephine Home</a></p><p class="bodytext">LVMH</p><p class="bodytext">Moss Bros Group</p><p class="bodytext"><a href="http:///en/work/ozwald-boateng" target="_self">Ozwald Boateng</a></p><p class="bodytext"><a href="http:///en/work/pacific-place" target="_self">Pacific Place</a></p></div><div class="column"><h4>Products & Services</h4><p class="bodytext"><a href="http:///en/work/essenza-style" target="_self">Essenza Style</a></p><p class="bodytext"><a href="http:///en/work/kef-blade" target="_self">KEF Blade</a></p><p class="bodytext"><a href="http:///en/work/kef-ls50" target="_self">KEF LS50</a></p><p class="bodytext"><a href="http:///en/work/kef-r-series" target="_self">KEF R-Series</a></p><p class="bodytext">KEF The Fifty</p><p class="bodytext">KEF X300</p><p class="bodytext"><a href="http:///en/work/ozwald-boateng-perfume" target="_self">Ozwald Boateng Fragrance</a></p><p class="bodytext"><a href="http:///en/work/rda" target="_self">RDA Organic</a></p></div><div class="column"><h4>Finance & Institutions</h4><p class="bodytext">Advent International</p><p class="bodytext">American Express</p><p class="bodytext">Argentum Consulting</p><p class="bodytext">Casa Dei Bambini</p><p class="bodytext"><a href="http:///en/work/cis-huangzhou" target="_self">Chinese International School</a></p><p class="bodytext"><a href="http:///en/work/coutts" target="_self">Coutts World Card</a></p><p class="bodytext">Habour Business Forum</p><p class="bodytext">Hong Kong Government</p><p class="bodytext">Made in Africa Foundation</p><p class="bodytext">Mirae Asset</p><p class="bodytext"><a href="http:///en/work/tiger-cub-funds" target="_self">Tiger Cub Funds</a></p></div><div class="column"><h4>Others</h4><p class="bodytext">10 Design</p><p class="bodytext">Aedas</p><p class="bodytext"><a href="http:///en/work/rmjm" target="_self">RMJM</a></p><p class="bodytext"><a href="http:///en/work/south-china-morning-post" target="_self">South China Morning Post</a></p><p class="bodytext">Strata</p><p class="bodytext"><a href="http:///en/work/style-magazine" target="_self">Style Magazine</a></p></div></div></div></div>

<div class="box contactinfo" style="display:none;"><div class="content"><h4>our world</h4><h2>Global projects from <br />
two timezones.</h2><div class="item clearfix"><div class="left"><h4>Hong Kong</h4><p class="bodytext">13F Fung Lok Commercial&nbsp;Building<br />
163 Wing Lok Street<br />
Sheung Wan<br />
Hong Kong<br />
Tel +852 2850 6262<br />
<a class="map" href="http://maps.google.com/maps?q=Fung+Lok+Commercial+Building,+Wing+Lok+Street,+163,+Sheung+Wan,+Hong+Kong&amp;hl=nl&amp;sll=37.0625,-95.677068&amp;sspn=68.848233,107.138672&amp;hnear=Fung+Lok+Commercial+Bldg,+163+Wing+Lok+St,+Hongkong&amp;t=m&amp;z=17" target="_blank">map</a></p></div><div class="right"><div class="clock" data-time="Wed Apr 03 2013 21:53:40 GMT"><div class="minute"><img class="line" src="http:///img/clock_line.png" width="1" height="28"/></div><div class="hour"><img class="line" src="http:///img/clock_line.png" width="1" height="28"/></div><img src="http:///img/clock_outline.png" width="70" height="70" class="outline"/><div class="ampm"></div></div></div></div><div class="item clearfix"><div class="left"><h4>London</h4><p class="bodytext">25 Chelsham Road<br />
London SW4 6NR<br />
United Kingdom<br />
Tel +44 207 622 5788<br />
<a class="map" href="https://maps.google.com/maps?q=25+Chelsham+Road,+London+SW4+6NR,+UK&amp;hl=en&amp;sll=22.286744,114.149591&amp;sspn=0.009649,0.013078&amp;oq=25+Chelsham+Road+London+SW4+6NR+UK&amp;hnear=25+Chelsham+Rd,+London+SW4+6NR,+United+Kingdom&amp;t=m&amp;z=17" target="_blank">map</a><br />
<br />
<br />
<script type="text/javascript">genc("pbz", "perngr", "", "lnatehguresbeq");</script></p></div><div class="right"><div class="clock" data-time="Wed Apr 03 2013 14:53:40 GMT"><div class="minute"><img class="line" src="http:///img/clock_line.png" width="1" height="28"/></div><div class="hour"><img class="line" src="http:///img/clock_line.png" width="1" height="28"/></div><img src="http:///img/clock_outline.png" width="70" height="70" class="outline"/><div class="ampm"></div></div></div></div><p class="bodytext"><a class="link" href="http://www.facebook.com/resurgence2013" target="_blank"><img src="http:///img/contact_facebook.png" width="14" height="14"/>facebook</a></p><p class="bodytext"><a class="link" href="http://www.linkedin.com/company/-" target="_blank"><img src="http:///img/contact_linkedin.png" width="14" height="14"/>linkedin</a></p></div></div>

				</div>
				
				<span class="clear"></span>
			</div>
		</div>
		
		
		
		
		<script type="text/javascript">
		var CONTAINER;		// global instance
		
		(function(){
			function init(){
				CONTAINER = new Container("about");
				var blocks_arr = [{"id":408,"status":false,"date":"2012-11-23 16:43:20","title":"Unexpected","type":"wideImage","catchphrase":"Global Branding Design","img":{"main":{"size":"226 kB","height":1800,"width":2300,"src":"--KEF--GA6G@2x.jpg","ext":".jpg","name":"--KEF--GA6G","suffix":"@2x"},"normal":{"size":"282 kB","height":900,"width":1150,"src":"--KEF--GA6G.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"--KEF--GA6G_tn.jpg","suffix":"_tn"}},"more_url":null,"textcolor":"white","class":"module_block_big_img"},{"id":38,"status":false,"date":"2012-10-01 23:28:51","type":"doubleBlock1","vimeo_id":"","img":{"main":{"size":"121 kB","height":900,"width":1396,"src":"--Rose-R1IP@2x.jpg","ext":".jpg","name":"--Rose-R1IP","suffix":"@2x"},"normal":{"size":"64 kB","height":450,"width":698,"src":"--Rose-R1IP.jpg","suffix":""},"admin":{"size":"2 kB","height":54,"width":96,"src":"-f-Rose-R1IP_tn.jpg","suffix":"_tn"}},"caption":"EXPERTISE","catchphrase":"  create, <br \/>\r\nre-launch and communicate <br \/>\r\noutstanding luxury, premium <br \/>\r\nand niche brands.","more_url":null,"more_text":null,"position":"1","width":"300","class":"module_block_halves"},{"id":84,"status":false,"date":"2012-11-23 02:01:48","type":"imageText","img":{"main":{"size":"354 kB","height":1800,"width":1463,"src":"JW-31OI@2x.jpg","ext":".jpg","name":"JW-31OI","suffix":"@2x"},"normal":{"size":"50 kB","height":900,"width":731,"src":"JW-31OI.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"JW-31OI_tn.jpg","suffix":"_tn"}},"caption":"PASSIONATE","caption_textcolor":"black","catchphrase":"Our founding partners <br \/>\r\nhave been pursuing <br \/>\r\ncreative excellence and <br \/>\r\ninnovation for some of <br \/>\r\nthe world's largest and <br \/>\r\nsmallest organisations <br \/>\r\nfor over 26 years. ","catchphrase_textcolor":"gray","more_url":null,"more_text":null,"more_textcolor":"white","class":"module_block_small_img"},{"id":45,"status":false,"date":"2012-10-17 16:30:37","type":"doubleBlock1","vimeo_id":"","img":{"main":{"size":"153 kB","height":900,"width":1500,"src":"strategy-6GZZ@2x.jpg","ext":".jpg","name":"strategy-6GZZ","suffix":"@2x"},"normal":{"size":"73 kB","height":450,"width":750,"src":"strategy-6GZZ.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"strategy-6GZZ_tn.jpg","suffix":"_tn"}},"caption":"strategic","catchphrase":"Our team works closely with clients <br \/>\r\nto define the strategies, ideas and actions <br \/>\r\nneeded to deliver commercial success<br \/>\r\nin an ever changing world.","more_url":null,"more_text":null,"position":"0","width":"400","class":"module_block_halves"},{"id":197,"status":false,"date":"2012-10-18 12:10:41","title":"East & West","type":"wideImage","catchphrase":"Our European and Asian offices work as one on every project","img":{"main":{"size":"1 MB","height":1800,"width":2709,"src":"tiger_2-HBUX@2x.jpg","ext":".jpg","name":"tiger_2-HBUX","suffix":"@2x"},"normal":{"size":"441 kB","height":900,"width":1354,"src":"tiger_2-HBUX.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"tiger_2-HBUX_tn.jpg","suffix":"_tn"}},"more_url":null,"textcolor":"white","class":"module_block_big_img"},{"id":66,"status":false,"date":"2013-01-08 18:58:54","type":"doubleBlock1","vimeo_id":"30444137","img":{"main":{"size":"115 kB","height":900,"width":1353,"src":"ipad_KEF-copy-YKYV@2x.jpg","ext":".jpg","name":"ipad_KEF-copy-YKYV","suffix":"@2x"},"normal":{"size":"49 kB","height":450,"width":676,"src":"ipad_KEF-copy-YKYV.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"ipad_KEF-copy-YKYV_tn.jpg","suffix":"_tn"}},"caption":"COMPELLING","catchphrase":"We have earned a reputation <br \/>\r\nfor connecting brands to people <br \/>\r\nthrough memorable and emotional <br \/>\r\ncreative at every touchpoint.","more_url":null,"more_text":null,"position":"1","width":"300","class":"module_block_halves"},{"id":56,"status":false,"date":"2012-10-18 14:38:00","type":"imageText","img":{"main":{"size":"413 kB","height":1800,"width":1490,"src":"STYLE_COVER-RSSL@2x.jpg","ext":".jpg","name":"STYLE_COVER-RSSL","suffix":"@2x"},"normal":{"size":"155 kB","height":900,"width":745,"src":"STYLE_COVER-RSSL.jpg","suffix":""},"admin":{"size":"3 kB","height":54,"width":96,"src":"STYLE_COVER-RSSL_tn.jpg","suffix":"_tn"}},"caption":"CONCISE","caption_textcolor":"white","catchphrase":"Often it\u2019s what <br \/>\r\nwe don\u2019t say <br \/>\r\nthat speaks <br \/>\r\nvolumes.","catchphrase_textcolor":"white","more_url":null,"more_text":null,"more_textcolor":"white","class":"module_block_small_img"},{"id":89,"status":false,"date":"2012-11-23 20:23:55","type":"imageText","img":{"main":{"size":"335 kB","height":1800,"width":1997,"src":"ABOUT14-EB1L@2x.jpg","ext":".jpg","name":"ABOUT14-EB1L","suffix":"@2x"},"normal":{"size":"128 kB","height":900,"width":998,"src":"ABOUT14-EB1L.jpg","suffix":""},"admin":{"size":"2 kB","height":54,"width":96,"src":"ABOUT14-EB1L_tn.jpg","suffix":"_tn"}},"caption":"R&D","caption_textcolor":"white","catchphrase":"We create and produce <br \/>\r\nrare and distinctive <br \/>\r\ncustomer experiences <br \/>\r\nbecause - although time <br \/>\r\nconsuming to research <br \/>\r\nand develop - they make<br \/>\r\nour clients stand out.","catchphrase_textcolor":"gray","more_url":null,"more_text":null,"more_textcolor":"gray","class":"module_block_small_img"},{"id":85,"status":false,"date":"2012-11-23 04:01:56","type":"imageText","img":{"main":{"size":"159 kB","height":1800,"width":1424,"src":"YR_LONDON-UIBI@2x.jpg","ext":".jpg","name":"YR_LONDON-UIBI","suffix":"@2x"},"normal":{"size":"113 kB","height":900,"width":712,"src":"YR_LONDON-UIBI.jpg","suffix":""},"admin":{"size":"2 kB","height":54,"width":96,"src":"YR_LONDON-UIBI_tn.jpg","suffix":"_tn"}},"caption":"Services","caption_textcolor":"white","catchphrase":"Brand Strategy:<br \/>\r\nBrand DNA<br \/>\r\nPositioning<br \/>\r\nBrand Expression<br \/>\r\nNaming<br \/>\r\n<br \/>\r\nBrand Design:<br \/>\r\nIdentity<br \/>\r\nBrand Language<br \/>\r\nEnvironment<br \/>\r\nPackaging<br \/>\r\nPrint <br \/>\r\nPublication<br \/>\r\nStructural Design<br \/>\r\nSignage<br \/>\r\n<br \/>\r\nCommunication:<br \/>\r\nAdvertising<br \/>\r\nBrand Experience<br \/>\r\nMarketing Collateral<br \/>\r\nWebsite & Interactive<br \/>\r\nArt Direction<br \/>\r\nFilm & Photography<br \/>\r\nCopywriting<br \/>\r\nTheming<br \/>\r\nGuidelines","catchphrase_textcolor":"gray","more_url":null,"more_text":null,"more_textcolor":"white","class":"module_block_small_img"},{"type":"clientList","children":{"2":{"title":"Hospitality","children":[{"id":75,"title":"A Curious Group of Hotels","url":null},{"id":33,"title":"City of Dreams","url":null},{"id":28,"title":"Cowley Manor","url":{"url":"http:\/\/\/en\/work\/cowley-manor","title":"Cowley Manor","target":"_self"}},{"id":23,"title":"EAST Beijing","url":{"url":"http:\/\/\/en\/work\/east-beijing","title":"EAST Beijing","target":"_self"}},{"id":76,"title":"EAST Hong Kong","url":null},{"id":26,"title":"Hotel Icon","url":{"url":"http:\/\/\/en\/work\/hotel-icon","title":"Hotel Icon","target":"_self"}},{"id":27,"title":"Hyde Hotels","url":{"url":"http:\/\/\/en\/work\/hyde-hotels","title":"Hyde Hotels","target":"_self"}},{"id":29,"title":"L'Hotel Paris","url":{"url":"http:\/\/\/en\/work\/l-hotel","title":"L'Hotel Paris","target":"_self"}},{"id":31,"title":"New World Hospitality","url":{"url":"http:\/\/\/en\/work\/new-world-hospitality","title":"New World Hospitality","target":"_self"}},{"id":30,"title":"Rosewood Hotels and Resorts","url":{"url":"http:\/\/\/en\/work\/rosewood-hotels-resorts","title":"Rosewood Hotels and Resorts","target":"_self"}},{"id":77,"title":"Sands Casino & Resorts","url":null},{"id":97,"title":"Shangri-La Magazine","url":null},{"id":2,"title":"Swire Hotels","url":{"url":"http:\/\/\/en\/work\/swire-hotels","title":"Swire Hotels","target":"_self"}},{"id":25,"title":"The Opposite House","url":{"url":"http:\/\/\/en\/work\/the-opposite-house","title":"The Opposite House","target":"_self"}},{"id":24,"title":"The Upper House","url":{"url":"http:\/\/\/en\/work\/upper-house","title":"The Upper House","target":"_self"}},{"id":57,"title":"The Workshop","url":{"url":"http:\/\/\/en\/work\/the-workshop","title":"The Workshop","target":"_self"}},{"id":22,"title":"U Hotels","url":{"url":"http:\/\/\/en\/work\/u-hotels","title":"U Hotels","target":"_self"}}]},"11":{"title":"Restaurants & Bars","children":[{"id":100,"title":"Above & Beyond","url":{"url":"http:\/\/\/en\/work\/above-beyond","title":"Above & Beyond","target":"_self"}},{"id":74,"title":"Bei","url":null},{"id":70,"title":"Domain","url":{"url":"http:\/\/\/en\/work\/domain","title":"Domain","target":"_self"}},{"id":68,"title":"Feast","url":{"url":"http:\/\/\/en\/work\/feast","title":"Feast","target":"_self"}},{"id":102,"title":"Green","url":null},{"id":67,"title":"Hagaki","url":{"url":"http:\/\/\/en\/work\/hagaki","title":"Hagaki","target":"_self"}},{"id":72,"title":"Le Restaurant Paris","url":null},{"id":73,"title":"Punk - Beijing","url":null},{"id":69,"title":"Sugar","url":{"url":"http:\/\/\/en\/work\/sugar","title":"Sugar","target":"_self"}},{"id":71,"title":"Sureno","url":null},{"id":101,"title":"The Market","url":null},{"id":66,"title":"Xian","url":{"url":"http:\/\/\/en\/work\/xian","title":"Xian","target":"_self"}}]},"3":{"title":"Real Estate","children":[{"id":7,"title":"226","url":{"url":"http:\/\/\/en\/work\/two-two-six","title":"226","target":"_self"}},{"id":35,"title":"Blake's Advisors","url":null},{"id":20,"title":"BLV Realty Organisation Inc","url":null},{"id":99,"title":"Chow Tai Fook","url":null},{"id":12,"title":"CTF Guanghzou","url":null},{"id":78,"title":"Fantasia Holdings","url":null},{"id":94,"title":"Gammon Construction","url":null},{"id":8,"title":"Grosvenor Crescent","url":{"url":"http:\/\/\/en\/work\/grosvenor-crescent","title":"Grosvenor Crescent","target":"_self"}},{"id":11,"title":"Karma Lakelands","url":{"url":"http:\/\/\/en\/work\/karma-lakelands","title":"Karma Lakelands","target":"_self"}},{"id":6,"title":"Nan Fung Group","url":null},{"id":14,"title":"New World Development","url":null},{"id":9,"title":"Ocean 3651","url":{"url":"http:\/\/\/en\/work\/ocean-3651","title":"Ocean 3651","target":"_self"}},{"id":13,"title":"Summer Group","url":null},{"id":19,"title":"Swire Properties","url":null},{"id":16,"title":"Unitech Group","url":null},{"id":5,"title":"Winfield","url":{"url":"http:\/\/\/en\/work\/winfield","title":"Winfield","target":"_self"}},{"id":10,"title":"World Resorts","url":null}]},"4":{"title":"Fashion & Retail","children":[{"id":90,"title":"Debenhams","url":null},{"id":86,"title":"Gee","url":null},{"id":83,"title":"Givenchy","url":{"url":"http:\/\/\/en\/work\/givenchy","title":"Givenchy","target":"_self"}},{"id":38,"title":"Hugo Boss","url":null},{"id":39,"title":"Josephine Home","url":{"url":"http:\/\/\/en\/work\/wwwjosephinehomecouk","title":"Josephine Home","target":"_self"}},{"id":84,"title":"LVMH","url":null},{"id":82,"title":"Moss Bros Group","url":null},{"id":36,"title":"Ozwald Boateng","url":{"url":"http:\/\/\/en\/work\/ozwald-boateng","title":"Ozwald Boateng","target":"_self"}},{"id":21,"title":"Pacific Place","url":{"url":"http:\/\/\/en\/work\/pacific-place","title":"Pacific Place","target":"_self"}}]},"5":{"title":"Products & Services","children":[{"id":91,"title":"Essenza Style","url":{"url":"http:\/\/\/en\/work\/essenza-style","title":"Essenza Style","target":"_self"}},{"id":103,"title":"KEF Blade","url":{"url":"http:\/\/\/en\/work\/kef-blade","title":"KEF Blade","target":"_self"}},{"id":81,"title":"KEF LS50","url":{"url":"http:\/\/\/en\/work\/kef-ls50","title":"KEF LS50","target":"_self"}},{"id":79,"title":"KEF R-Series","url":{"url":"http:\/\/\/en\/work\/kef-r-series","title":"KEF R-Series","target":"_self"}},{"id":89,"title":"KEF The Fifty","url":null},{"id":80,"title":"KEF X300","url":null},{"id":41,"title":"Ozwald Boateng Fragrance","url":{"url":"http:\/\/\/en\/work\/ozwald-boateng-perfume","title":"Ozwald Boateng Fragrance","target":"_self"}},{"id":62,"title":"RDA Organic","url":{"url":"http:\/\/\/en\/work\/rda","title":"RDA Organic","target":"_self"}}]},"6":{"title":"Finance & Institutions","children":[{"id":98,"title":"Advent International","url":null},{"id":85,"title":"American Express","url":null},{"id":92,"title":"Argentum Consulting","url":null},{"id":45,"title":"Casa Dei Bambini","url":null},{"id":44,"title":"Chinese International School","url":{"url":"http:\/\/\/en\/work\/cis-huangzhou","title":"Chinese International School","target":"_self"}},{"id":43,"title":"Coutts World Card","url":{"url":"http:\/\/\/en\/work\/coutts","title":"Coutts World Card","target":"_self"}},{"id":96,"title":"Habour Business Forum","url":null},{"id":95,"title":"Hong Kong Government","url":null},{"id":88,"title":"Made in Africa Foundation","url":null},{"id":93,"title":"Mirae Asset","url":null},{"id":42,"title":"Tiger Cub Funds","url":{"url":"http:\/\/\/en\/work\/tiger-cub-funds","title":"Tiger Cub Funds","target":"_self"}}]},"9":{"title":"Others","children":[{"id":52,"title":"10 Design","url":null},{"id":50,"title":"Aedas","url":null},{"id":51,"title":"RMJM","url":{"url":"http:\/\/\/en\/work\/rmjm","title":"RMJM","target":"_self"}},{"id":48,"title":"South China Morning Post","url":{"url":"http:\/\/\/en\/work\/south-china-morning-post","title":"South China Morning Post","target":"_self"}},{"id":53,"title":"Strata","url":null},{"id":49,"title":"Style Magazine","url":{"url":"http:\/\/\/en\/work\/style-magazine","title":"Style Magazine","target":"_self"}}]}}},{"type":"contactInfo","is_yarubar":false,"items":[{"id":1,"title":"Hong Kong","info":"13F Fung Lok Commercial&nbsp;Building<br \/>\r\n163 Wing Lok Street<br \/>\r\nSheung Wan<br \/>\r\nHong Kong<br \/>\r\nTel +852 2850 6262<br \/>\r\n<a class=\"map\" href=\"http:\/\/maps.google.com\/maps?q=Fung+Lok+Commercial+Building,+Wing+Lok+Street,+163,+Sheung+Wan,+Hong+Kong&amp;hl=nl&amp;sll=37.0625,-95.677068&amp;sspn=68.848233,107.138672&amp;hnear=Fung+Lok+Commercial+Bldg,+163+Wing+Lok+St,+Hongkong&amp;t=m&amp;z=17\" target=\"_blank\">map<\/a>","time":"Wed Apr 03 2013 21:53:40 GMT","map":{},"class":"module_contacts"},{"id":2,"title":"London","info":"25 Chelsham Road<br \/>\r\nLondon SW4 6NR<br \/>\r\nUnited Kingdom<br \/>\r\nTel +44 207 622 5788<br \/>\r\n<a class=\"map\" href=\"https:\/\/maps.google.com\/maps?q=25+Chelsham+Road,+London+SW4+6NR,+UK&amp;hl=en&amp;sll=22.286744,114.149591&amp;sspn=0.009649,0.013078&amp;oq=25+Chelsham+Road+London+SW4+6NR+UK&amp;hnear=25+Chelsham+Rd,+London+SW4+6NR,+United+Kingdom&amp;t=m&amp;z=17\" target=\"_blank\">map<\/a><br \/>\r\n<br \/>\r\n<br \/>\r\n<script type=\"text\/javascript\">genc(\"pbz\", \"perngr\", \"\", \"lnatehguresbeq\");<\/script>","time":"Wed Apr 03 2013 14:53:40 GMT","map":{},"class":"module_contacts"}]}];
				
				for(var i=0; i<blocks_arr.length; i++){
					var config = {};
					config.data = blocks_arr[i];
					config.type = blocks_arr[i].type;
					config.elem = $(".box")[i];
					CONTAINER.addBox(config, true);
				}
				
				setCss($("#container"), "display", "block");
				CONTAINER.onResize();
				CONTAINER.init();
			}
			
			proto.registerInit(init);
		})()
		</script>
		
		
		
		
	</body>
</html>

<?php
	
	require_once('php/close.php');
?>