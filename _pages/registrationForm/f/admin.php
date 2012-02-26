<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "resurgence.smvdu@gmail.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "smvdu321" );

?>
<?php
/**
 * Copyright (C) : http://www.formmail-maker.com
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|");
    $public_functions = false !== strpos('|phpfmg_mail_password||phpfmg_filman_download||phpfmg_image_processing|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a>
</div>


<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onClick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo phpfmg_formini(); ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>Resurgence | Admin Panel </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="generator" content="">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="" target="_blank" title="" style="color:#cccccc;font-weight:bold;text-decoration:none;">Copyright &copy 2010 Resurgence 2010</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    $_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}



function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // predefined random images
    function getImage(){
        $images = array(
			'D30D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QgNYQximMIY6IIkFTBFpZQhldAhAFmtlaHR0dHQQQRVrZW0IhImBnRS1dFXY0lWRWdOQ3IemDm6eKxYxDDuwuAWbmwcq/KgIsbgPAMMCzKro3oVqAAAAAElFTkSuQmCC',
			'A41D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YWhmmMIY6IImxBjBMZQhhdAhAEhOZwhDKCBQTQRILaGV0BeqFiYGdFLV06dJV01ZmTUNyX0CrSCuSOjAMDRUNdZiCbh4DhjqYWACaGGOoI4qbByr8qAixuA8A4zjKw0MkJDcAAAAASUVORK5CYII=',
			'52CD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMYQxhCHUMdkMQCGlhbGR0CHQJQxEQaXRsEHUSQxAIDGIBijDAxsJPCpq1aunTVyqxpyO5rZZjCilAHEwtAFwsA2sqKZocIWCeqW1gDREMd0Nw8UOFHRYjFfQD+Q8sJtCSiZQAAAABJRU5ErkJggg==',
			'9ED6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGaY6IImJTBFpYG10CAhAEgtoBYo1BDoIYBFDdt+0qVPDlq6KTM1Cch+rK1gdinkMUL0iSGICWMSwuQWbmwcq/KgIsbgPAOqjy/D4oeSLAAAAAElFTkSuQmCC',
			'9FCA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WANEQx1CHVqRxUSmiDQwOgRMdUASC2gVaWBtEAgIwBBjdBBBct+0qVPDlq5amTUNyX2srijqIBCiNzQESUwALCaIog7ilkAUMdYAIC/UEdW8AQo/KkIs7gMADCzK/Z5tnfMAAAAASUVORK5CYII=',
			'FFB9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7QkNFQ11DGaY6IIkFNIg0sDY6BASgizUEOohgqHOEiYGdFBo1NWxp6KqoMCT3Qc2biqEXTGKIYbEDi1vQ3DxQ4UdFiMV9AHzDzh0SNH6JAAAAAElFTkSuQmCC',
			'21FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA0MDkMREpjAGsDYwOiCrC2hlxRBjaGVAFoO4adqqqKWhK0OzkN0XwIChF8jDEGNtwBQTwSIWGsoaChRDcfNAhR8VIRb3AQD/AMZhT/fdMwAAAABJRU5ErkJggg==',
			'7923' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM3QMQ6AMAhAUUjsDXogHNwxKYtH6Cno0Bv0Ch30lHaE6KhR2P5AXoDjMgp/2ld8IphAQMjWGirOM7FrsSzKGm1rsdBobH1b73nPPRsfEq5UQe29oFCogbsXdSrEvrEOC6GzsGIKwt780f8e3BvfCWQMzF/TVzPVAAAAAElFTkSuQmCC',
			'9346' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WANYQxgaHaY6IImJTBFpZWh1CAhAEgtoBalydBBAFWtlCHR0QHbftKmrwlZmZqZmIbmP1ZWhlbXREcU8oM5G19BABxEkMQGQHY2OKGJgtzSiugWbmwcq/KgIsbgPAG93zF/KD1xzAAAAAElFTkSuQmCC',
			'1769' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGaY6IImxOjA0Ojo6BAQgiYkCxVwbHB1EUPQytLICSREk963MWjVt6dRVUWFI7gOqC2B1dJiKqpfRgbUhoAFVjLUBKIZmh0gDI7pbQoAq0Nw8UOFHRYjFfQAsKMj36YPdhgAAAABJRU5ErkJggg==',
			'5FD2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkNEQ11DGaY6IIkFNIg0sDY6BASgizUEOoggiQUGgMRAMgj3hU2bGrZ0VRQQIrmvFayuEdkOqFgrslsCIGJTkMVEpkDcgizGCrI3lDE0ZBCEHxUhFvcBAA5RzXo0UgflAAAAAElFTkSuQmCC',
			'8F52' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQ11DHaY6IImJTBFpYG1gCAhAEgtoBYkxOoigq5sKpJHctzRqatjSzKxVUUjuA6kDmtDogGYeiGTAsCNgCgOaHYyODgGobgbqDWUMDRkE4UdFiMV9AKgozICn94wjAAAAAElFTkSuQmCC',
			'4A17' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37pjAEMExhDA1BFgthDGEIYWgQQRJjDGFtZUQTY50i0ugwhaEhAMl906ZNW5k1bdXKLCT3BUDUtSLbGxoqGgoUm4LqFrC6AEwxRgd0McdQR1SxgQo/6kEs7gMAddnL2b/KSwoAAAAASUVORK5CYII=',
			'4EFB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpI37poiGsoYGhjogi4WINLA2MDoEIIkxQsVEkMRYp6CoAztp2rSpYUtDV4ZmIbkvYAqmeaGhmOYxTMEtFoAiBnRzAyOqmwcq/KgHsbgPAGc6ygXduBhKAAAAAElFTkSuQmCC',
			'027B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDA0MdkMRYA1hbGRoCHQKQxESmiDQ6AMVEkMQCWhkaHRodYerATopaugoIV4ZmIbkPqG4KwxRGFPOAYgEMAYwo5okA1YCgCKpbGlgbUPUyOoiGujYworh5oMKPihCL+wC6kMq9m7GAygAAAABJRU5ErkJggg==',
			'18A3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YQximMIQ6IImxOrC2MoQyOgQgiYk6iDQ6Ojo0iKDoZW1lbQhoCEBy38qslWFLV0UtzUJyH5o6qJhIo2toAJp5QLEGdDGQ3kBUt4QwhgDNQ3HzQIUfFSEW9wEAGujK1aaCVmYAAAAASUVORK5CYII=',
			'DFE1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAU0lEQVR4nGNYhQEaGAYTpIn7QgNEQ11DHVqRxQKmiDSwNjBMRRFrBYuFYhGD6QU7KWrp1LCloauWIrsPTR1pYlMwxUIDgGKhDqEBgyD8qAixuA8AbVLNMcX439oAAAAASUVORK5CYII=',
			'D684' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGRoCkMQCprC2Mjo6NKKItYo0sgJJNLEGoLopAUjui1o6LWxV6KqoKCT3BbSKAs1zdEA3z7UhMDQEQywAm1tQxLC5eaDCj4oQi/sAzVLPL+tf8nUAAAAASUVORK5CYII=',
			'418C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpI37pjAEMIQyTA1AFgthDGB0dAgQQRJjDGENYG0IdGBBEmMF6mV0dHRAdt+0aauiVoWuzEJ2XwCqOjAMDWUAm4fuFnQ7GMB6Ud3CMIU1FMPNAxV+1INY3AcAIPvIR/Rsam8AAAAASUVORK5CYII=',
			'12BA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDGVqRxVgdWFtZGx2mOiCJiTqINLo2BAQEoOhlaHRtdHQQQXLfyqxVS5eGrsyahuQ+oLoprAh1MLEA1obA0BBUtzgAxdDUsTag6xUNEQ11DWVEERuo8KMixOI+AK/uyTr99Jv6AAAAAElFTkSuQmCC',
			'2ECC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WANEQxlCHaYGIImJTBFpYHQICBBBEgtoFWlgbRB0YEHWDRZjdEBx37SpYUtXrcxCcV8AijowZHTAFGNtwLRDpAHTLaGhmG4eqPCjIsTiPgBoq8nx02rGEAAAAABJRU5ErkJggg==',
			'559E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNEQxlCGUMDkMQCGkQaGB0dHRjQxFgbAlHEAgNEQpDEwE4KmzZ16crMyNAsZPe1MjQ6hKDqBYuhmRfQKtLoiCYmMoW1Fd0trAGMIehuHqjwoyLE4j4A5D3KQaubtOAAAAAASUVORK5CYII=',
			'41FA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpI37pjAEsIYGtKKIhTAGsDYwTHVAEmMMYQWJBQQgibGC9DYwOogguW/atFVRS0NXZk1Dcl8AqjowDA0Fi4WGoLsFTR12MdZQDLGBCj/qQSzuAwBij8g9wFYzeQAAAABJRU5ErkJggg==',
			'E3AC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkNYQximMEwNQBILaBBpZQhlCBBBEWNodHR0dGBBFWtlbQh0QHZfaNSqsKWrIrOQ3YemDm6eaygWMaA6VDtEgHoDUNwCcjNQDMXNAxV+VIRY3AcA7RvNBrM1pw4AAAAASUVORK5CYII=',
			'6B76' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WANEQ1hDA6Y6IImJTBFpZWgICAhAEgtoEWl0aAh0EEAWawCqa3R0QHZfZNTUsFVLV6ZmIbkvBGTeFEZU81qB5gUwOoigiTk6oIqB3MLawICiF+zmBgYUNw9U+FERYnEfAOXszJaKxCpuAAAAAElFTkSuQmCC',
			'C5EF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WENEQ1lDHUNDkMREWkUaWBsYHZDVBTRiEWsQCUESAzspatXUpUtDV4ZmIbkvoIGh0RVDLxaxRhEMMZFW1lZ0e1lDGEOAbkYRG6jwoyLE4j4AEfPJmuBtFQcAAAAASUVORK5CYII=',
			'E20C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkMYQximMEwNQBILaGBtZQhlCBBBERNpdHR0dGBBEWNodG0IdEB2X2jUqqVLV0VmIbsPqG4KK0IdTCwAU4zRgRHDDtYGdLeEhoiGOqC5eaDCj4oQi/sACEDMBPaxQwUAAAAASUVORK5CYII=',
			'4033' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpI37pjAEMIYyhDogi4UwhrA2OjoEIIkBRVoZGgIaRJDEWKeINDo0OjQEILlv2rRpK7OmrlqaheS+AFR1YBgaKgIWEUFxC6YdDFMw3YLVzQMVftSDWNwHAFUlzT3C4hXyAAAAAElFTkSuQmCC',
			'0230' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7GB0YQxhDGVqRxVgDWFtZGx2mOiCJiUwRaXRoCAgIQBILaGVodGh0dBBBcl/U0lVLV01dmTUNyX1AdVMYEOpgYgEMDYEoYiJTGB0Y0OwAuqUB3S2MDqKhjmhuHqjwoyLE4j4AdG/MYrok7N4AAAAASUVORK5CYII=',
			'59EC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHaYGIIkFNLC2sjYwBIigiIk0ujYwOrAgiQUGQMSQ3Rc2benS1NCVWSjua2UMRFIHFWNoRBcLaGXBsENkCqZbWAMw3TxQ4UdFiMV9ANmnyvREjOMBAAAAAElFTkSuQmCC',
			'FB3C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7QkNFQxhDGaYGIIkFNIi0sjY6BIigijU6NAQ6sKCpY2h0dEB2X2jU1LBVU1dmIbsPTR2KedjE0O3AdAummwcq/KgIsbgPABmGzcnLadVZAAAAAElFTkSuQmCC',
			'F68A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZQxhCGVqRxQIaWFsZHR2mOqCIiTSyNgQEBKCKNTA6OjqIILkvNGpa2KrQlVnTkNwX0CDaiqQObp5rQ2BoCKYYmjpWLHpBbmZEERuo8KMixOI+AHiSzGHj9/kuAAAAAElFTkSuQmCC',
			'C925' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WEMYQxhCGUMDkMREWllbGR0dHZDVBTSKNLo2BKKKNYg0OjQEujoguS9q1dKlWSszo6KQ3BfQwBjo0Ao0F0UvQ6PDFDSxRpZGhwBGBxF0tzgwBCC7D+Rm1tCAqQ6DIPyoCLG4DwB0esuvw4S4OgAAAABJRU5ErkJggg==',
			'FB27' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkNFQxhCGUNDkMQCGkRaGR0dGkRQxRpdQSSaOhAZgOS+0KipYatWZq3MQnIfWB0IopnnMIVhCoZYAEMAA7pbHBgdUMVEQ1hDA1HEBir8qAixuA8AcMLM8VWEKcQAAAAASUVORK5CYII=',
			'4DF6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpI37poiGsIYGTHVAFgsRaWVtYAgIQBJjDBFpdG1gdBBAEmOdAhFDdt+0adNWpoauTM1Ccl8ARB2KeaGhEL0iKG7BKobhFrCbGxhQ3TxQ4Uc9iMV9AJYoy850Uz5TAAAAAElFTkSuQmCC',
			'3FF8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7RANEQ11DA6Y6IIkFTBFpYG1gCAhAVtkKEmN0EEEWQ1UHdtLKqKlhS0NXTc1Cdh+x5mERw+YW0QCwGIqbByr8qAixuA8AUYPLajFBjDgAAAAASUVORK5CYII=',
			'D6BC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDGaYGIIkFTGFtZW10CBBBFmsVaWRtCHRgQRVrYG10dEB2X9TSaWFLQ1dmIbsvoFW0FUkd3DxXoHnYxFDswOIWbG4eqPCjIsTiPgC7p819Fmcx6QAAAABJRU5ErkJggg==',
			'74C5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMZWhlCHUMDkEVbGaYyOgQ6MKCKhbI2CKKKTWF0ZW1gdHVAdl/U0qVLV62MikJyH6ODSCsrkBZB0svaIBrqiiYGZLeC7EAWA7qrldEhICAATYwh1GGqwyAIPypCLO4DAPImyrOpU2IiAAAAAElFTkSuQmCC',
			'C416' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WEMYWhmmMEx1QBITaWWYyhDCEBCAJBbQyBDKGMLoIIAs1sDoyjCF0QHZfVGrli5dNW1lahaS+wJAJk5hRDWvQTTUAahXBNUOkDoUMaBOkPtQ9ILczBjqgOLmgQo/KkIs7gMA31nLTG8utOsAAAAASUVORK5CYII=',
			'4FBE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpI37poiGuoYyhgYgi4WINLA2Ojogq2MEiTUEooixTkFRB3bStGlTw5aGrgzNQnJfwBRM80JDMc1jmIJDDE0vWAzdzQMVftSDWNwHAAUPyozfBAOZAAAAAElFTkSuQmCC',
			'2BD7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGUNDkMREpoi0sjY6NIggiQW0ijS6NgSgiDG0AtUBxQKQ3TdtatjSVVErs5DdFwBW14psL6MD2LwpKG5pAIsFIIuJNIDc4uiALBYaCnYzithAhR8VIRb3AQDiLsyIA9p04QAAAABJRU5ErkJggg==',
			'E478' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkMYWllDA6Y6IIkFNDBMBZIBAahioQwNgQ4iKGKMrgyNDjB1YCeFRi1dumrpqqlZSO4LaBBpZZjCgGaeaKhDACOaeQytjA6YYqwNqHrBbga6EdnNAxV+VIRY3AcAppDNKDgftoAAAAAASUVORK5CYII=',
			'7DA7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkNFQximMIaGIIu2irQyhDI0iKCKNTo6OqCKTRFpdG0IAEIk90VNW5m6KmplFpL7GB3A6lqR7WVtAIqFBkxBFhNpAKsLQBYLaBBpZW0IdEAVEw1BFxuo8KMixOI+AGtXzUST2SFnAAAAAElFTkSuQmCC',
			'20ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUMdkMREpjCGsDYwOgQgiQW0sraCxESQdbeKNLoixCBumjZtZWroyqxpyO4LQFEHhkAehhhrA6YdIg2YbgkNxXTzQIUfFSEW9wEA2EnJgwF8ry0AAAAASUVORK5CYII=',
			'4062' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpI37pjAEMIQyTHVAFgthDGF0dAgIQBJjDGFtZW1wdBBBEmOdItLoCqRFkNw3bdq0lalTV62KQnJfAEido0Mjsh2hoSC9Aa2obgHZETAFVQziFkw3M4aGDIbwox7E4j4AeZvLtbq8nYMAAAAASUVORK5CYII=',
			'4958' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpI37pjCGsIY6THVAFgthbWVtYAgIQBJjDBFpdG1gdBBBEmOdAhSbClcHdtK0aUuXpmZmTc1Ccl/AFMZAh4YAFPNCQxkaHRoCUcxjmMICtANdjLWV0dEBRS/IzQyhDKhuHqjwox7E4j4ANbTMS/DWPYsAAAAASUVORK5CYII=',
			'CCEC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7WEMYQ1lDHaYGIImJtLI2ujYwBIggiQU0ijS4NjA6sCCLNYg0sALFkN0XtWraqqWhK7OQ3YemDrcYFjuwuQWbmwcq/KgIsbgPAGtry46QL51eAAAAAElFTkSuQmCC',
			'B21F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QgMYQximMIaGIIkFTGFtZQhhdEBWF9Aq0uiILjaFodFhClwM7KTQqFVLV01bGZqF5D6gOiBEN48hAFMMyEcXm8LagC4WGiAa6hjqiCI2UOFHRYjFfQAuxMp83iEstQAAAABJRU5ErkJggg==',
			'154A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQxkaHVqRxVgdRBoYWh2mOiCJiYLEpjoEBKDoFQlhCHQEycDdtzJr6tKVmZlZ05Dcx+jA0OjaCFeHEAsNDA1BNa/RAUMdaysDmphoCGMIuthAhR8VIRb3AQAykcm4OLp+6AAAAABJRU5ErkJggg==',
			'3B82' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7RANEQxhCGaY6IIkFTBFpZXR0CAhAVtkq0ujaEOgggiwGUdcgguS+lVFTw1aFrloVhew+iLpGBwzzAloZMMWmMGBxC6abGUNDBkH4URFicR8AT2jMR0g7E1oAAAAASUVORK5CYII=',
			'CA96' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WEMYAhhCGaY6IImJtDKGMDo6BAQgiQU0srayNgQ6CCCLNYg0ugLFkN0XtWrayszMyNQsJPeB1DmEBKKa1yAa6gDUK4Jih0ijI5qYSCtQDM0trCFA89DcPFDhR0WIxX0ApnfM5GLJ0LIAAAAASUVORK5CYII=',
			'E558' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDHaY6IIkFNIg0sDYwBARgiDE6iKCKhbBOhasDOyk0aurSpZlZU7OQ3AeUb3RoCEAzDyQWiG5eoyuGGGsro6MDit7QEMYQhlAGFDcPVPhREWJxHwDbpM2QQAty7wAAAABJRU5ErkJggg==',
			'C3A4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WENYQximMDQEIImJtIq0MoQyNCKLBTQyNDo6OrSiiDUwtLI2BEwJQHJf1KpVYUtXRUVFIbkPoi7QAU1vo2toYGgImh2uQBl0t7CiiYHcjC42UOFHRYjFfQB4jc8Wx+ELRwAAAABJRU5ErkJggg==',
			'51B0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkMYAlhDGVqRxQIaGANYGx2mOqCIsQawNgQEBCCJBQYA9TY6OogguS9s2qqopaErs6Yhu68VRR1CrCEQRSwALIZqh8gUBgy3AF0Siu7mgQo/KkIs7gMAh7rKwhA6EJ8AAAAASUVORK5CYII=',
			'FA77' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA0NDkMQCGhhDQKQIihhrK6aYSKNDowOQRrgvNGrayqylq1ZmIbkPrG4KQysDil7RUIcAhikMaOY5OjAEoIu5NjA6EBIbqPCjIsTiPgCaAM34ivCb+wAAAABJRU5ErkJggg==',
			'6AFD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA0MdkMREpjCGsDYwOgQgiQW0sLaCxESQxRpEGl0RYmAnRUZNW5kaujJrGpL7QqagqIPobRUNxRTDVCcC1YvsFtYAsBiKmwcq/KgIsbgPACEIy5vyXKxLAAAAAElFTkSuQmCC',
			'3197' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nM2QsQ2AMAwE7SIbwD5kgy+SJhvAFG6yQZZIpsSisoESBP7u9NKfTONyQn/KK34zCJQ5J8PQGBwXmWyzBgSBZ40OBuPXyyh9LX2zftqjhOqWqzJdOjMWgJyLshgX7xyyOjv21f8ezI3fDqtpySRigQSXAAAAAElFTkSuQmCC',
			'64C4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WAMYWhlCHRoCkMREpjBMZXQIaEQWC2hhCGVtEGhFEWtgdGVtYJgSgOS+yKilS5euWhUVheS+kCkirawNQBOR9baKhro2MIaGoIgxANUJoLulFaQTWQybmwcq/KgIsbgPAACUzbY0hBtyAAAAAElFTkSuQmCC',
			'DD9F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QgNEQxhCGUNDkMQCpoi0Mjo6OiCrC2gVaXRtCMQnBnZS1NJpKzMzI0OzkNwHUucQgqnXAYt5juhiWNwCdTOK2ECFHxUhFvcBAFFczCqLMpZfAAAAAElFTkSuQmCC',
			'AFD2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1EQ11DGaY6IImxBog0sDY6BAQgiYlMAYo1BDqIIIkFtILEAhpEkNwXtXRq2NJVUUCIcB9UXSOyHaGhYLFWBkzzpmCIAd2CIRbKGBoyCMKPihCL+wD9QM3Y8CAGKAAAAABJRU5ErkJggg==',
			'FF21' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkNFQx1CGVqRxQIaRBoYHR2moouxNgSEoosBSZhesJNCo6aGrVqZtRTZfWB1rZh2MEzBIhaAxS0OmGKsoQGhAYMg/KgIsbgPAA5dzOJDfWFgAAAAAElFTkSuQmCC',
			'62FC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDA6YGIImJTGFtZW1gCBBBEgtoEWl0bWB0YEEWa2AAiyG7LzJq1dKloSuzkN0XMoVhCitCHURvK0MAphijAyuaHUC3NKC7hTVANNS1gQHFzQMVflSEWNwHAGj8yq6fwMCJAAAAAElFTkSuQmCC',
			'26A5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nM2QsQ2AQAhFoWAD3AcLe0wOE50Gi9tAbwMbp/TsMFpqIr974YcXYL+Nw5/yiR8pJljQNDBeKIOhxD3NPGPbXhhkdvK+k+hXyrDt4zRFP20yuTqHLgrPnV0ZeWXeS2T1wtnV6GeGqbJVfvC/F/PgdwDKTsuHIyq2dwAAAABJRU5ErkJggg==',
			'6AED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUMdkMREpjCGsDYwOgQgiQW0sLaCxESQxRpEGl0RYmAnRUZNW5kaujJrGpL7QqagqIPobRUNxRTDVCcC1YvsFtYAoBiamwcq/KgIsbgPABoRy6BlurYWAAAAAElFTkSuQmCC',
			'70D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMZAlhDGUMDkEVbGUNYGx0dUFS2srayNgSiik0RaXRtCHR1QHZf1LSVqasio6KQ3MfoAFIX0CCCpJe1AVNMpAFiB7JYQAPILQ4BAShiIDczTHUYBOFHRYjFfQBcjsvSG6PqnwAAAABJRU5ErkJggg==',
			'0050' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YAlhDHVqRxVgDGENYGximOiCJiUxhbQWKBQQgiQW0ijS6TmV0EEFyX9TSaStTMzOzpiG5D6TOoSEQpg6nGMSOABQ7QG5hdHRAcQvIzQyhDChuHqjwoyLE4j4AwoTLFdw1U2IAAAAASUVORK5CYII=',
			'6826' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGaY6IImJTGFtZXR0CAhAEgtoEWl0bQh0EEAWa2BtZQCKIbsvMmpl2KqVmalZSO4LAZrH0MqIal6rSKPDFEYHEXSxAFQxsFscGFD0gtzMGhqA4uaBCj8qQizuAwB6r8ugrHZcvAAAAABJRU5ErkJggg==',
			'DAB1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgMYAlhDGVqRxQKmMIawNjpMRRFrZW1lbQgIRRUTaXRtdIDpBTspaum0lamhq5Yiuw9NHVRMNNQVSGKYhy42BVNvaABQLJQhNGAQhB8VIRb3AQDQ+89x1TbmZgAAAABJRU5ErkJggg==',
			'CA7A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WEMYAlhDA1qRxURaGUMYGgKmOiCJBTSyAtUEBAQgizWINDo0OjqIILkvatW0lVlLV2ZNQ3IfWN0URpg6qJhoqEMAY2gIih0iQNNQ1Ym0ijS6NqCKsYZgig1U+FERYnEfABFGzMWijLb9AAAAAElFTkSuQmCC',
			'608E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGUMDkMREpjCGMDo6OiCrC2hhbWVtCEQVaxBpdESoAzspMmrayqzQlaFZSO4LmYKiDqK3VaTRFd28Vkw7sLkFm5sHKvyoCLG4DwAGZMm1UdxxMAAAAABJRU5ErkJggg==',
			'448C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpI37pjC0MoQyTA1AFgthmMro6BAggiTGGMIQytoQ6MCCJMY6hdGV0dHRAdl906YtXboqdGUWsvsCpoi0IqkDw9BQ0VBXoHnobkG3AySG7hasbh6o8KMexOI+AHyOyjR1F/b2AAAAAElFTkSuQmCC',
			'600C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WAMYAhimMEwNQBITmcIYwhDKECCCJBbQwtrK6OjowIIs1iDS6NoQ6IDsvsioaStTV0VmIbsvZAqKOojeVmximHZgcws2Nw9U+FERYnEfAKNPyvp7rZQRAAAAAElFTkSuQmCC',
			'93F0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WANYQ1hDA1qRxUSmiLSyNjBMdUASA6podG1gCAhAFQOqY3QQQXLftKmrwpaGrsyahuQ+VlcUdRAINg9VTACLHdjcAnYzyIRBEH5UhFjcBwDu8MsX7Tg2WgAAAABJRU5ErkJggg==',
			'834E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WANYQxgaHUMDkMREpoi0MrQ6OiCrC2hlaHSYiiomMoWhlSEQLgZ20tKoVWErMzNDs5DcB1LH2ohpnmtoIKYdjeh2AN2CJobNzQMVflSEWNwHAOLYyzBAvSUAAAAAAElFTkSuQmCC',
			'8124' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGRoCkMREpjAGMDo6NCKLBbSyBrACSVR1QL0NAVMCkNy3NGpV1KqVWVFRSO4Dq2tldEA1Dyg2hTE0BF0sAN0tDAGMDqhiQJeEsoYGoIgNVPhREWJxHwAJsMs9hU2TMwAAAABJRU5ErkJggg==',
			'50A7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7QkMYAhimMIaGIIkFNDCGMIQyNIigiLG2Mjo6oIgFBog0ugJlApDcFzZt2srUVVErs5Dd1wpW14piM0gsNGAKslhAK2sra0NAALKYyBTGENaGQAdkMdYAhgB0sYEKPypCLO4DAJjSzGBVnKHFAAAAAElFTkSuQmCC',
			'1109' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YAhimMEx1QBJjdWAMYAhlCAhAEhN1YA1gdHR0EEHTy9oQCBMDO2ll1qqopauiosKQ3AdRFzAVU29AA7oYo6MDhh0YbglhDUV380CFHxUhFvcBABZCxp579F+tAAAAAElFTkSuQmCC',
			'DBD2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgNEQ1hDGaY6IIkFTBFpZW10CAhAFmsVaXRtCHQQQRVrZW0IaBBBcl/U0qlhS1dFASHCfVB1jQ4Y5gW0MmCKTWHA4hZMNzOGhgyC8KMixOI+AEfEz22E0mcqAAAAAElFTkSuQmCC',
			'D782' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGaY6IIkFTGFodHR0CAhAFmtlaHRtCHQQQRVrZXR0aBBBcl/U0lXTVoUCaST3AdUFANU1otjRyujACpJBEWNtYAXZjuIWkQag3gBUNwNtDGUMDRkE4UdFiMV9AGL8zcSAwbBUAAAAAElFTkSuQmCC',
			'D72D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGUMdkMQCpjA0Ojo6OgQgi7UyNLo2BDqIoIq1MiDEwE6KWrpq2qqVmVnTkNwHVBfA0MqIppfRgWEKuhhrA0MAmtgUkQZGB0YUt4QGiDSwhgaiuHmgwo+KEIv7AIAUzDdOWxb6AAAAAElFTkSuQmCC',
			'5D6A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkNEQxhCGVqRxQIaRFoZHR2mOqCKNbo2OAQEIIkFBoDEGB1EkNwXNm3aytSpK7OmIbuvFajO0RGmDiHWEBgagmwHRAxFncgUkFtQ9bIGgNzMiGreAIUfFSEW9wEA7FPMgbfIs4oAAAAASUVORK5CYII=',
			'04BD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YWllDGUMdkMRYAximsjY6OgQgiYlMYQhlbQh0EEESC2hldAWpE0FyX9RSIAhdmTUNyX0BrSKtSOqgYqKhrmjmAe1oRbcD6JZWdLdgc/NAhR8VIRb3AQCVKsr7MOA7RAAAAABJRU5ErkJggg==',
			'39E5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDHUMDkMQCprC2sjYwOqCobBVpdEUXmwIWc3VAct/KqKVLU0NXRkUhu28KY6ArkBZBMY+hEVOMBWwHshjELQwByO6DuNlhqsMgCD8qQizuAwBwhsrv5qqupwAAAABJRU5ErkJggg==',
			'350A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7RANEQxmmMLQiiwVMEWlgCGWY6oCsslWkgdHRISAAWWyKSAhrQ6CDCJL7VkZNXbp0VWTWNGT3TWFodEWog5oHFgsNQbWj0dHREUVdwBTWVoZQRhQx0QDGEIYpqGIDFX5UhFjcBwA7MstLyY9SKgAAAABJRU5ErkJggg==',
			'5FD9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNEQ11DGaY6IIkFNIg0sDY6BASgizUEOoggiQUGoIiBnRQ2bWrY0lVRUWHI7msFqQuYiqwXKtaALBYAEUOxQ2QKpltYQfaiuXmgwo+KEIv7AHH3zRliKvS8AAAAAElFTkSuQmCC',
			'480A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpI37pjCGMExhaEURC2FtZQhlmOqAJMYYItLo6OgQEIAkxjqFtZW1IdBBBMl906atDFu6KjJrGpL7AlDVgWFoqEija0NgaAiKW0B2OKKoY5gCcgsjmhjIzWhiAxV+1INY3AcA+07LMXTmb6kAAAAASUVORK5CYII=',
			'2EBF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGUNDkMREpog0sDY6OiCrC2gFijUEoogxtKKog7hp2tSwpaErQ7OQ3ReAaR6jA6Z5rA2YYiINmHpDQ8FuRnXLAIUfFSEW9wEA0Q3JYIr7iAUAAAAASUVORK5CYII=',
			'9980' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGVqRxUSmsLYyOjpMdUASC2gVaXRtCAgIQBNzdHR0EEFy37SpS5dmha7MmobkPlZXxkAkdRDYygA0LxBFTKCVBcMObG7B5uaBCj8qQizuAwDPN8vUlgRQZgAAAABJRU5ErkJggg==',
			'D7A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7QgNEQx2mMEx1QBILmMLQ6BDKEBCALNbK0Ojo6OgggirWytoQCBMDOylq6appS1dFRYUhuQ+oLoC1IWAqql5GB9bQgAZUMdYGoDpUO6aIgMRQ3BIaABZDcfNAhR8VIRb3AQDXgc5whm7H2gAAAABJRU5ErkJggg==',
			'3B61' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7RANEQxhCGVqRxQKmiLQyOjpMRVHZKtLo2uAQiiIGVMfaANcLdtLKqKlhS6euWoriPpA6R4dWTPMCCIpB3YIiBnVzaMAgCD8qQizuAwAg1cw/nXIDjgAAAABJRU5ErkJggg==',
			'73FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDA0MDkEVbRVpZGxgdUFS2MjS6ootNYUBWB3FT1KqwpaErQ7OQ3AdUgWEeawOmeSJYxAIaMN0S0AB0cwMjqpsHKPyoCLG4DwApQMkJS6lH5wAAAABJRU5ErkJggg==',
			'F0EB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDHUMdkMQCGhhDWBsYHQJQxFhbQWIiKGIija4IdWAnhUZNW5kaujI0C8l9aOpQxEQI2oHNLZhuHqjwoyLE4j4AeCnLqBX1pIYAAAAASUVORK5CYII=',
			'D116' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QgMYAhimMEx1QBILmMIYwBDCEBCALNbKGsAYwugggCIG0svogOy+qKWrolZNW5maheQ+qDo08yB6RQiJTQG7D0VvaABrKGOoA4qbByr8qAixuA8AGFjKnzm1EmkAAAAASUVORK5CYII=',
			'4E2A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpI37poiGMoQytKKIhYg0MDo6THVAEmMEirE2BAQEIImxThEBkoEOIkjumzZtatiqlZlZ05DcFwBS18oIUweGoaFA3hTG0BAUtwDFAlDVgcQYHdDFRENZQwNRxQYq/KgHsbgPAOlXyjspcXZoAAAAAElFTkSuQmCC',
			'4E61' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpI37poiGMoQytKKIhYg0MDo6TEUWYwSKsTY4hCKLsU4BicH1gp00bdrUsKVTVy1Fdl8ASJ2jA4odoaEgvQGo9k7BLsaIphfq5tCAwRB+1INY3AcA+lbLaiCELPkAAAAASUVORK5CYII=',
			'E3B9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkNYQ1hDGaY6IIkFNIi0sjY6BASgiDE0ujYEOoigigHVOcLEwE4KjVoVtjR0VVQYkvsg6hymimCYB7QJUwzNDky3YHPzQIUfFSEW9wEARF7N8R/IsPoAAAAASUVORK5CYII=',
			'126F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGUNDkMRYHVhbGR0dHZDViTqINLo2oIoxOjAAxRhhYmAnrcxatXTp1JWhWUjuA6qYwuqIoTeAtSEQTYzRAVOMtQHDLSGioQ6hjChiAxV+VIRY3AcALbPGe6S/5ioAAAAASUVORK5CYII=',
			'6574' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQ1lDAxoCkMREpogAyYBGZLGAFrBYK4pYg0gIQ6PDlAAk90VGTV26aumqqCgk94VMAalidEDR2woUC2AMDUERE2l0dGBAcwtrK2sDqhhrAGMIuthAhR8VIRb3AQBN4s6E28nSjwAAAABJRU5ErkJggg==',
			'8BCC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7WANEQxhCHaYGIImJTBFpZXQICBBBEgtoFWl0bRB0YEFTx9rA6IDsvqVRU8OWrlqZhew+NHVI5mETw7QD3S3Y3DxQ4UdFiMV9AHi6y6MW8/XXAAAAAElFTkSuQmCC',
			'F907' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkMZQximMIaGIIkFNLC2MoQyNIigiIk0Ojo6YIi5AskAJPeFRi1dmroqamUWkvsCGhgDgepaGVD0MoD0TkEVYwHZEcCA4RZGB1QxsJtRxAYq/KgIsbgPANZMzUyBQdbxAAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && PHPFMG_USER == $_POST['Username'] &&
            defined( 'PHPFMG_PW' )   && PHPFMG_PW   == $_POST['Password']
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=password">I forgot my password</a>    
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        mail( PHPFMG_USER, "Your password", "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created aumotically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => 'email-traffics-log.php',
        2 => 'form-data-log.php',
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => 'email-traffics-log.php',
        2 => 'form-data-log.php',
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, 'form-data-log.php' == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}



function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);
    while (@ob_end_clean()); // no output buffering !
    
    $len = filesize($file);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: $ctype="application/force-download";
    }
    
    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);

    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp) && (0 == connection_status()) ) { 


        flush();
        $i ++ ;
        if( $toCSV ){ 
            $line = fgets($fp);
            if($i > $skipN){ // skip lines
                $line = str_replace( chr(0x09), ',', $line );
                echo phpfmg_data2record( $line, false );
            }; 
            
        }else{
            print( fread($fp, 1024*100) );
        };
        
    }; 
    fclose ($fp);
    
    return true ;
}
?>
<?php
function phpfmg_formini(){
    return "ZXNoX2Zvcm1tYWlsX2RvbWFpbm5hbWUJCmVzaF9mb3JtbWFpbF9kZXNjcmlwdGlvbgkKZXNoX2Zvcm1tYWlsX2Zvb3RlcgkKZXNoX2Zvcm1tYWlsX2ZpZWxkX251bXMJMjAKZXNoX2Zvcm1tYWlsX3JlY2lwaWVudAlyZXN1cmdlbmNlLnNtdmR1QGdtYWlsLmNvbQplc2hfZm9ybW1haWxfY2MJCmVzaF9mb3JtbWFpbF9iY2MJCmVzaF9mb3JtbWFpbF9zdWJqZWN0CVt3ZWJdIFJlZ2lzdHJhdGlvbiA6IFJlc3VyZ2VuY2UgMjAxMAplc2hfbWFpbF90eXBlCWh0bWwKZXNoX2Zvcm1tYWlsX3JlZGlyZWN0CQplc2hfZm9ybW1haWxfcmV0dXJuX21zZwkKZXNoX2Zvcm1tYWlsX2NvbmZpcm1fbXNnCVlvdXIgZm9ybSBoYXMgYmVlbiBzZW50LiBUaGFuayB5b3UhCmVzaF9mb3JtbWFpbF9yZXR1cm5fc3ViamVjdAkKZXNoX21haWxfdGVtcGxhdGUJCmVzaF9mb3JtbWFpbF9jaGFyc2V0CQplc2hfYWN0aW9uCW1haWxhbmRmaWxlCmVzaF90ZXh0X2FsaWduCXRvcAplc2hfc2F2ZUF0dGFjaG1lbnRzCQplc2hfbm9fZnJvbV9oZWFkZXIJCmVzaF9zZWN1cml0eV9pbWFnZQlZCnNlbmRtYWlsX2Zyb20JCnNtdHAJCmVzaF9ibG9ja19oYXJtZnVsCQplc2hfaGFybWZ1bF9leHRzCS5leGUsIC5jb20sIC5iYXQsIC5qcywgLnZiLCAudmJzLCBzY3IsIC5pbmYsIC5yZWcsIC5sbmssIC5waWYsIC5hZGUsIC5hZHAsIC5hcHAsIC5iYXMsIC5jaG0sIC5jbWQsIC5jcGwsIC5jcnQsIC5jc2gsIC5meHAsIC5obHAsIC5odGEsIC5pbnMsIC5pc3AsIC5qc2UsIC5rc2gsIC5MbmssIC5tZGEsIC5tZGIsIC5tZGUsIC5tZHQsIC5tZHcsIC5tZHosIC5tc2MsIC5tc2ksIC5tc3AsIC5tc3QsIC5vcHMsIC5wY2QsIC5wcmYsIC5wcmcsIC5wc3QsIC5zY2YsIC5zY3IsIC5zY3QsIC5zaGIsIC5zaHMsIC51cmwsIC52YmUsIC53c2MsIC53c2YsIC53c2gKZXNoX2FudGlfaG90bGlua2luZwkKZXNoX3JlZmVyZXJzX2FsbG93CQplc2hfcmVmZXJlcnNfZGVuaWVkX21zZwkKZXNoX2ZpbGUybGlua19zaXplCQpOYW1lIG9mIHRoZSBJbnN0aXR1dGUJZmllbGRfMAlTZW5kZXIncyBuYW1lCQlSZXF1aXJlZAkKQWRkcmVzcwlmaWVsZF8xCVRleHRBcmVhCQlSZXF1aXJlZAkKRS1tYWlsCWZpZWxkXzIJU2VuZGVyJ3MgZW1haWwJCVJlcXVpcmVkCUVudGVyIHlvdXIgcmVndWxhciBlbWFpbCBhZGRyZXNzIGZvciBjb250YWN0IHB1cnBvc2UuCk5hbWUgYW5kIFBob25lIG5vLiBvZiB0aGUgYWNjb21wYW55aW5nIEZhY3VsdHkgKGlmIGFueSkpCWZpZWxkXzE0CVRleHRBcmVhCQkJClRlYW0gRGV0YWlscyAJZmllbGRfMwlTZWN0aW9uQnJlYWsJCQkKTmFtZSBvZiB0aGUgQ29udGluZ2VudCBMZWFkZXIJZmllbGRfNAlUZXh0CQlSZXF1aXJlZAkKUGhvbmUgbm8uIAlmaWVsZF81CVRleHQJCVJlcXVpcmVkCQpOby4gb2YgRmVtYWxlIFBhcnRpY2lwYW50cwlmaWVsZF82CVRleHQJCVJlcXVpcmVkCQpOby4gb2YgTWFsZSBQYXJ0aWNpcGFudHMJZmllbGRfNwlUZXh0CQlSZXF1aXJlZAkKRXZlbnRzIG9mIFBhcnRpY2lwYXRpb24JZmllbGRfOAlDaGVja0JveAlUYXJhbmcgKExpZ2h0IFZvY2FsIChJbmRpYW4pKXxDYWRlbnphIChXZXN0ZXJuIFZvY2FsKXxEaGFtYSBDaGF1a2FkaSAoRm9sayBEYW5jZSl8RGFuY2UgUGUgQ2hhbmNlIChTb2xvIERhbmNlKXxCaGVqYSBGcnkgKFF1aXopfFZlcmJvc2UgKERlYmF0ZSl8UG9ldHJ5fFJhbmdtYW5jaCAoU2tpdCl8TWltZXxBbHBhbmEgKFJhbmdvbGkpfENhcnRvb25pbmcJUmVxdWlyZWQJVGhlc2UgYXJlIHRoZSBjb3JlIGV2ZW50cyBmb3IgaW50ZXItdW5pdmVyc2l0eSBjb21wZXRpdGlvbnMuCklmIEJvYXJkaW5nIFJlcXVpcmVkCWZpZWxkXzkJQ2hlY2tCb3gJWWVzfE5vCVJlcXVpcmVkCQoJZmllbGRfMTAJU2VjdGlvbkJyZWFrCQkJClF1ZXJpZXMgLyBTdWdnZXN0aW9ucwlmaWVsZF8xMQlUZXh0QXJlYQkJCQpXaGF0J3MgdGhlIHByb2JhYmxpdHkgb2YgeW91ciBhdHRlbmRpbmcgdGhlIGZlc3Q/CWZpZWxkXzEyCUNoZWNrQm94CURlZmluaXRlbHl8UHJvYmFibHl8Tm90IFN1cmV8UHJvYmFibHkgTm90fERlZmluaXRlbHkgTm90CQkKSG93IGRvIGdvdCB0byBrbm93IGFib3V0IHJlc3VyZ2VuY2UJZmllbGRfMTMJUmFkaW8JRnJpZW5kc3xXZWJzaXRlfEUtbWFpbHxBZHZlcnRpc2VtZW50fG90aGVycwkJCg==";
}
?>