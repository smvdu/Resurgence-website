<?php

# This block must be placed at the very top of page.
# --------------------------------------------------
require_once( dirname(__FILE__).'/form.lib.php' );
phpfmg_display_form();
# --------------------------------------------------



function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>

<form name="frmFormMail" action='' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onsubmit();'>
<div style="padding-left:20px;">
<div >
<h1 style="background-color:#990000; color:#FFFFFF; padding-top:-2px; padding-bottom:10px;  "> Registration Form : Resurgence 2010 (Inter-University)
</h1>
</div>
<input type='hidden' name='formmail_submit' value='Y'>
<div id='err_required' class="form_error" style='display:none;'>
    <label class='form_error_title'>Please check the required fields</label>
</div>
            
            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Name of the Institute</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0"); ?>" class='text_box'>
	<div id='field_0_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>Address</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<textarea name="field_1" id="field_1" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_1"); ?></textarea>

	<div id='field_1_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>E-mail</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2"); ?>" class='text_box'>
	<div id='field_2_tip' class='instruction'>Enter your regular email address for contact purpose.</div>
	</div>
</li>

<li class='field_block' id='field_14_div'><div class='col_label'>
	<label class='form_field'>Name and Phone no. of the accompanying Faculty (if any))</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_14" id="field_14" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_14"); ?></textarea>

	<div id='field_14_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_3_div'><hr class='sectionbreak'>
Team Details </li>
<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>Name of the Contingent Leader</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4"); ?>" class='text_box'>
	<div id='field_4_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>Phone no. </label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_5"  id="field_5" value="<?php  phpfmg_hsc("field_5"); ?>" class='text_box'>
	<div id='field_5_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_6_div'><div class='col_label'>
	<label class='form_field'>No. of Female Participants</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_6"  id="field_6" value="<?php  phpfmg_hsc("field_6"); ?>" class='text_box'>
	<div id='field_6_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_7_div'><div class='col_label'>
	<label class='form_field'>No. of Male Participants</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_7"  id="field_7" value="<?php  phpfmg_hsc("field_7"); ?>" class='text_box'>
	<div id='field_7_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_8_div'><div class='col_label'>
	<label class='form_field'>Events of Participation</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_8', "Tarang (Light Vocal (Indian))|Cadenza (Western Vocal)|Dhama Chaukadi (Folk Dance)|Dance Pe Chance (Solo Dance)|Bheja Fry (Quiz)|Verbose (Debate)|Poetry|Rangmanch (Skit)|Mime|Alpana (Rangoli)|Cartooning" );?>
	<div id='field_8_tip' class='instruction'>These are the core events for inter-university competitions.</div>
	</div>
</li>

<li class='field_block' id='field_9_div'><div class='col_label'>
	<label class='form_field'>If Boarding Required</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_9', "Yes|No" );?>
	<div id='field_9_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_10_div'><hr class='sectionbreak'>
</li>
<li class='field_block' id='field_11_div'><div class='col_label'>
	<label class='form_field'>Queries / Suggestions</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_11" id="field_11" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_11"); ?></textarea>

	<div id='field_11_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_12_div'><div class='col_label'>
	<label class='form_field'>What's the probablity of your attending the fest?</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_12', "Definitely|Probably|Not Sure|Probably Not|Definitely Not" );?>
	<div id='field_12_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_13_div'><div class='col_label'>
	<label class='form_field'>How do got to know about resurgence</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_radios( 'field_13', "Friends|Website|E-mail|Advertisement|others" );?>
	<div id='field_13_tip' class='instruction'></div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'><label class='form_field'>Security Code:</label> <label class='form_required' >*</label> </div><div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
            <div class='form_submit_block col_field'>
	
                <input type='submit' value='Submit' class='form_button'>
                <span id='phpfmg_processing' style='display:none;'>
                    <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '../20100402-2aa4/?mod=image&amp;func=processing' ;?>' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>
            
</ol>
            
            

</div>
</form>




<?php
			
    phpfmg_javascript($sErr);

} 
# end of form




function phpfmg_form_css(){
?>
<style type='text/css'>

body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #474747;
    background-color: transparent;
}

select, option{
    font-size:13px;
}

ol.phpfmg_form{
    list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:red;
    margin-right:8px;
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

.text_box, .text_area, .text_select {
    width:300px;
}

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: red;
}

.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
}

div.instruction_error{
    color: red;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ccc;
}




<?php

    phpfmg_text_align();
    echo "</style>\n";

}
# end of css
 
# By: formmail-maker.com
?>