<?php  

   include("./_lib/counter.php");

   $counter = new Counter;

   $counter->add($counter->getinfo());

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

<meta charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Resurgence 2012 : the cultural and Sports festival | SMVDU.</title>

  <meta name="robots" content="index,follow" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta name="copyright" content="Saurabh Kumar and contributors (http://github.com/smvdu/resurgence-website)" />

  <meta name="distribution" content="global" />

  <meta name="author" content="Saurabh Kumar and contributors (http://github.com/smvdu/resurgence-website)" />

  <meta name="keywords" content="Resurgence, smvdu, resurgence smvdu, Cultural fest, fest, Jammu, Katra, events, sports festival 2012" />

  <meta name="description" content="Resurgence 2012, visit the official website of cultural and sports festival 2012, Shri Mata Vaishno Devi University (SMVDU), Katra, J&amp;K" />


  <link rel="stylesheet" href="assests/css/style.css">
  
  <link rel="stylesheet" href="_css/styles.css">

  <link rel="stylesheet" href="_js/jcurtains/curtain.css">

<?php /*?>IE 6 fixes <?php */?>

<?php /*?><!-- PNG fix ---><?php */?>

<style>

img, div { behavior: url(iepngfix.htc) }

</style>





<?php if (strcmp($_SERVER['SERVER_NAME'],"localhost"))

	echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>';

else 

	echo '<script src="_js/jscript-core.js"></script>'

?>


<!-- outside misc codes-->

<script src="_js/disable.js"></script>

<script src="_js/countdowntimer.js"></script>



<!--	fancy box -->

<script src="./fancybox/jquery.mousewheel-3.0.2.pack.js"></script>

<script src="./fancybox/jquery.fancybox-1.3.1.js"></script>

<link rel="stylesheet" href="./fancybox/jquery.fancybox-1.3.1.css" />

<script src="_js/jcurtains/easing.1.3.js"></script>



<?php /*?><!-- twitter init --><?php */?>

<script src="_js/jquery.twitter/jquery.twitter.js"></script>

<link rel="stylesheet" href="_js/jquery.twitter/jquery.twitter.css">



</head><body>

</body>

      <?php /*?><!--curtain datas --><?php */?>

      <div class="leftcurtain">

      		<?php /*?><img src="_js/jcurtains/images/frontcurtain.jpg"/><?php */?>

      </div>

      <div class="rightcurtain">

      		<?php /*?><img src="_js/jcurtains/images/frontcurtain.jpg" ><?php */?>

      </div>

      <a class="rope" href="#"><img src="_js/jcurtains/images/rope.png" /></a>





<div class="container_16" id="content">



<?php /*?>		

<!--Header row 16 [6 + 10]-->

<?php */?>  

	<div class="grid_6"  id="share_link">

    <div align="center">

      <!--Share link-->

       <a class="a2a_dd transpar" href="http://www.addtoany.com/share_save?linkname=Resurgence%202011%20%3A%20SMVDU&amp;linkurl=http%3A%2F%2Fsmvdu.ac.in%2Fresurgence%2Findex.html"><img src="http://static.addtoany.com/buttons/share_save_256_24.png" width="256" height="24" border="0" alt="Share/Bookmark"/></a>

      <script>a2a_linkname="Resurgence 2011 : SMVDU";a2a_linkurl="http://resurgence.smvdu.net.in/";</script>

      <script src="http://static.addtoany.com/menu/page.js"></script>

                       <br  />

      <!--countdown timer-->

                       <div id="countdowncontainer"></div>

                       <br />

                       <div id="countdowncontainer2"></div>

      <script>                         

		var futuredate=new cdtime("countdowncontainer", "April 8, 2012 18:25:00")

		futuredate.displaycountdown("days", formatresults)

                                     

		var currentyear=new Date().getFullYear()

		<?php /*?>//dynamically get this Christmas' year value. If Christmas already passed, then year=current year+1<?php */?>

		var thischristmasyear=(new Date().getMonth()>=11 && new Date().getDate()>25)? currentyear+1 : currentyear

		var christmas=new cdtime("countdowncontainer2", "April 6, "+2012+" 1:0:00")

		christmas.displaycountdown("days", formatresults2)

		</script>      

                        <br  />

<?php /*?>		<!--registration buttorn -->

<?php */?>                                 

	<a id="registrationForm_btn"   style="font-size: 24px;" href="_pages/registrationForm/f/form.php">  

			<img src="_img/btnRegister.png" alt="Registration Form : Resurgence 2010" border="0"/>

    </a>


    </div>

                     

  </div>



      <?php /*?>sec 2 [10] top right (the logo)<?php */?>

		<div class="grid_10 header" ><img id="logo" src="_img/_logos/logoResurgence2011.png" alt="Resurgence 2011 logo" /></div>

	

<?php /*?><!--clear---><?php */?>

	   <div class="clear"> </div>



<?php /*?>		middle section [16]<?php */?>

      <?php /*?><!--sec 1 [6]--><?php */?>

	   <div class="grid_6">

           <?php /*?><!--twitter updates--><?php */?>

           <div id="twitter"><p><a href="http://twitter.com/resurgenceSMVDU">Click for updates...</a></p></div>

		 

				<a href="http://twitter.com/resurgenceSMVDU" target="_blank">Show all updates...</a>

           <br />



	   </div>      

        

<?php /*?><!--sec 2 [10]-->      <?php */?>

  <div class="grid_10 transpar"> 

            <?php /*?><!--contain middle paragraph--><?php */?>

            <h1 id="headerBig">Welcome to Resurgence</h1>

                <p align="justify"> Resurgence, cultural and sports festival of Shri Mata Vaishno Devi University (SMVDU), Katra, J&amp;K, is one of the most popular fest in the northern India. Students of various institutes gather for competing with one another in various cultural, sports and informal events.

               </p>

               <p align="justify">

                  The three day celebration marks events of dance, drama, music, fine arts and literary. Informal events always remain the crowd puller with prof-nites and DJ nites to name a few.</p>

    <p align="justify">

    Thanks for being the <?php  $counter->display(); ?><sup>th</sup> visitor. We extend our invitation to be part of this crazy event.<strong> Come and join us.</strong></p>

    

    

                

             

					 <a id="photo" href="javascript:;" title="Photo Stream from Resurgence 2010"><img src="_img/btnPhotoStream.png" alt="Photos" /> </a>

					 <a id="medal_tally" href="_pages/medalTally_resurgence.html" title="Medal's Tally for Resurgence 2011"><img src="_img/btnMedalstally.png" alt="Medal's Tally" /> </a>

                 <a id="videos" href="_pages/videos.html" title="Videos | Resurgence"><img src="_img/btnvideo.png" alt="Veiw Videos" /> </a>



    <hr style="width:30%; margin-top: 20px;"  align="center" />

                

  <div class="tagCloud" align="center">

  

   <a id="schedule"   

     style="font-size: 26px;"

       href="http://www.google.com/calendar/embed?title=Schedule%20%3A%20Resurgence%202010%20&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=d02nt5iabhqebfhh7af1igqr5g%40group.calendar.google.com&amp;color=%23B1440E&amp;ctz=Asia%2FCalcutta" >  

     Schedule</a>

       

                

  <a id="cultural_events_list"

  style="font-size: 15px;"

  href="_pages/cultural_events_resugence10.html" >Events</a>

  

  <a id="contacts" 

  style="font-size: 30px;"

  href="_pages/contacts.html">

  Contacts</a>

  

 

  <a id="map" 

  style="font-size:22px;" 

  href="http://local.google.co.in/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;ll=32.936369,74.969501&amp;spn=0.095951,0.181446&amp;t=h&amp;msid=113862330647469523415.0004832d74ff1e9d41841&amp;output=embed">  

   Map</a> 



  <a id="registrationForm" 

  style="font-size: 20px;" 

  href="_pages/registrationForm/f/form.php">  

   Register</a>      

<br/>

  <a id="rulebook_cultural" 

  style="font-size: 24px;" 

  href="http://docs.google.com/View?id=dmkq5pn_127c854d6hp">  

   Rules Cultural</a>

   

  <a id="sports_brochure" 

  style="font-size: 18px;" 

  href="http://docs.google.com/View?id=dmkq5pn_123g59gvff3">  

   Sports Brochure</a>



   </div> 

  <?php /*?><!--end of tagcloud --><?php */?>

  <?php /*?><!--notifications--><?php */?>



<?php /*?> <div align="center" class="notification" style=" margin-top:10px; color: #000000; background:#00FF00; border:#000000 medium; font-size:large;">

    Resurgence 2011 is on it's way... get ready...</div> <?php */?>

    

    

    

  </div><div class="grid_6" id="footer">&nbsp;

  </div><div class="grid_10 transpar" id="footer" style="background-color:#FFFFFF;" align="center">

<?php /*?><!--			footer datas  --><?php */?>

<?php /*?><!--<fb:comments> </fb:comments>			 --><?php */?>  

</div>

  

  <div class="clear"></div>

  <div class="grid_16" id="footer" style="color:#999999">

<?php /*?><!--			footer datas  --><?php */?>

<br  />

  Copyright &copy; Resurgence <?php date('Y'); ?></div>

</div>



</div> 

<script><?php include ('_js/initialize.js.php')?></script>


</body></html>

