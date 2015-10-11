<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "dotmorison@gmail.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "bd3490" );

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
    $public_functions = false !== strpos('|phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
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

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
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
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

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
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#22190f;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
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
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
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


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
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
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'8E26' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WANEQxlCGaY6IImJTBFpYHR0CAhAEgtoFWlgbQh0EEBTxwAUQ3bf0qipYatWZqZmIbkPrK6VEcM8himMDiLoYgGoYmC3ODCg6AW5mTU0AMXNAxV+VIRY3AcAu0LLAHQiIuAAAAAASUVORK5CYII=',
			'E7F2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkNEQ11DA6Y6IIkFNDA0ujYwBARgiDE6iKCKtbICaREk94VGrZq2NHTVqigk9wHVBQDVNaLawegAFGtlQBFjBUKGKahiIiCxAFQ3g8QYQ0MGQfhREWJxHwBOpMzXNQl/nQAAAABJRU5ErkJggg==',
			'26DA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGVqRxUSmsLayNjpMdUASC2gVaWRtCAgIQNbdKtLA2hDoIILsvmnTwpauisyahuy+ANFWJHVgyOgg0ujaEBgaguyWBrAYijqgDUC3OKKIhYaC3MyIIjZQ4UdFiMV9AKpOy6uP4pPcAAAAAElFTkSuQmCC',
			'F010' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkMZAhimMLQiiwU0MIYwhDBMdUARY20FigYEoIiJNDpMYXQQQXJfaNS0lVkghOQ+NHV4xFhbgW5BswNo6xR0tzAEMIY6oLh5oMKPihCL+wB9icyTH9eRnQAAAABJRU5ErkJggg==',
			'2451' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYWllDHVqRxUSmMExlbWCYiiwW0MoQChQLRdHdyujKOpUBphfipmlLly7NzFqK4r4AkVawCUh6GR1EQx3QxIDmt7KiiYmAbHFEdV9oKNDOUIbQgEEQflSEWNwHAJvRywWJjPosAAAAAElFTkSuQmCC',
			'B48E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgMYWhlCGUMDkMQCpjBMZXR0dEBWFwBUxdoQiCo2hdEVSR3YSaFRS5euCl0ZmoXkvoApIq2Y5omGuqKb18rQimkHA4ZebG4eqPCjIsTiPgBisMrPLgZDPwAAAABJRU5ErkJggg==',
			'A1F5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDA0MDkMRYAxgDWEEySGIiU1gxxAJaGUBirg5I7otaCkShK6OikNwHUQc0A0lvaCimGNQ8B0wxhoAAFDHWUKDYVIdBEH5UhFjcBwC5k8kIhS8oEQAAAABJRU5ErkJggg==',
			'1E91' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGVqRxVgdRBoYHR2mIouJAsVYGwJCUfWCxWB6wU5amTU1bGVm1FJk94HUMYQEtKLrZWjAFGPEJubogCImGgJ2c2jAIAg/KkIs7gMAtfHIt+MmCVwAAAAASUVORK5CYII=',
			'852D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7WANEQxlCGUMdkMREpog0MDo6OgQgiQW0ijSwNgQ6iKCqC2FAiIGdtDRq6tJVKzOzpiG5T2QKQ6NDKyOK3oBWoNgUdDGRRocARjQ7WIE6GVHcwhrAGMIaGoji5oEKPypCLO4DALkDywAXSMdaAAAAAElFTkSuQmCC',
			'EB0E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7QkNEQximMIYGIIkFNIi0MoQyOjCgijU6Ojqii7WyNgTCxMBOCo2aGrZ0VWRoFpL70NTBzXPFIobNDnS3YHPzQIUfFSEW9wEAMabLa6efkscAAAAASUVORK5CYII=',
			'ED98' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QkNEQxhCGaY6IIkFNIi0Mjo6BASgijW6NgQ6iGCIBcDUgZ0UGjVtZWZm1NQsJPeB1DmEBGCY54DFPEdMMQy3YHPzQIUfFSEW9wEA4IvOWYfhidIAAAAASUVORK5CYII=',
			'CFD0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7WENEQ11DGVqRxURaRRpYGx2mOiCJBTQCxRoCAgKQxRpAYoEOIkjui1o1NWzpqsisaUjuQ1OHWwyLHdjcwhoCFENz80CFHxUhFvcBANGBzX5xZZQmAAAAAElFTkSuQmCC',
			'90F9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA6Y6IImJTGEMYW1gCAhAEgtoZW1lbWB0EEERE2l0RYiBnTRt6rSVqaGrosKQ3MfqClLHMBVZLwNYL9AuJDEBsB0MKHZgcwvYzUDzkN08UOFHRYjFfQBXHMqliH/AWQAAAABJRU5ErkJggg==',
			'E93F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QkMYQxhDGUNDkMQCGlhbWRsdHRhQxEQaHRoCMcUQ6sBOCo1aujRr6srQLCT3BTQwBjpgmMeAxTwWLGKYboG6GUVsoMKPihCL+wAqaMwJSaHmigAAAABJRU5ErkJggg==',
			'83FC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WANYQ1hDA6YGIImJTBFpZW1gCBBBEgtoZWh0bWB0YEFRxwBUx+iA7L6lUavCloauzEJ2H5o6FPOwiaHagekWsJsbGFDcPFDhR0WIxX0AT+HKrNBk30YAAAAASUVORK5CYII=',
			'6CBB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDGUMdkMREprA2ujY6OgQgiQW0iDS4NgQ6iCCLNYg0sCLUgZ0UGTVt1dLQlaFZSO4LmYKiDqK3FSiGbl4rph3Y3ILNzQMVflSEWNwHAFwyzSaKi5aTAAAAAElFTkSuQmCC',
			'D0A4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QgMYAhimMDQEIIkFTGEMYQhlaEQRa2VtZXR0aEUVE2l0BaoOQHJf1NJpK1NXRUVFIbkPoi7QAUNvaGBoCJodrECXoLsFXQzkZnSxgQo/KkIs7gMAppvQAStKX1kAAAAASUVORK5CYII=',
			'CE82' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WENEQxlCGaY6IImJtIo0MDo6BAQgiQU0ijSwNgQ6iCCLNYDVNYgguS9q1dSwVaEgGuE+qLpGBzS9rA0BrQwYdgRMYcDiFkw3M4aGDILwoyLE4j4AJHDMIPjfx0wAAAAASUVORK5CYII=',
			'B463' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QgMYWhlCGUIdkMQCpjBMZXR0dAhAFgOqYm1waBBBUcfoygqikdwXGrV06dKpq5ZmIbkvYIpIK6ujQwOqeaKhrkAREVQ7WlnRxaYwtKK7BZubByr8qAixuA8AOvXN57PAgm4AAAAASUVORK5CYII=',
			'CDD5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WENEQ1hDGUMDkMREWkVaWRsdHZDVBTSKNLo2BKKKNYDFXB2Q3Be1atrK1FWRUVFI7oOoA5IYetHEoHaIYLjFIQDZfRA3M0x1GAThR0WIxX0AAuzN1ogpd58AAAAASUVORK5CYII=',
			'7AE3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkMZAlhDHUIdkEVbGUNYGxgdAlDEWFtZgbQIstgUkUZXIB2A7L6oaStTQ1ctzUJyH6MDijowZG0QDXVFM0+kAaIOWSwALIbqFrAYupsHKPyoCLG4DwBplszE4n/I+QAAAABJRU5ErkJggg==',
			'9855' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHUMDkMREprC2sjYwOiCrC2gVaXTFEAOqm8ro6oDkvmlTV4YtzcyMikJyH6sraytQdYMIss1A8xzQxATAdgQ6iKC5hdHRIQDZfSA3M4QyTHUYBOFHRYjFfQC4yssjBT6tWwAAAABJRU5ErkJggg==',
			'5406' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMYWhmmMEx1QBILaGCYyhDKEBCAKhbK6OjoIIAkFhjA6MraEOiA7L6waUuXLl0VmZqF7L5WkVagOhTzGFpFQ12BekWQ7WhlaAXZgSwmMgXoPjS3sAZgunmgwo+KEIv7AD24y2HAH6SoAAAAAElFTkSuQmCC',
			'ADE7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDHUNDkMRYA0RaWYG0CJKYyBSRRlc0sYBWiFgAkvuilk5bmRq6amUWkvug6lqR7Q0NBYtNYcA0LwBNDOgWRgdUMbCbUcQGKvyoCLG4DwCwzMyigX7gFAAAAABJRU5ErkJggg==',
			'2BB3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGUIdkMREpoi0sjY6OgQgiQW0ijS6NgQ0iCDrbgWpc2gIQHbftKlhS0NXLc1Cdl8AijowZHTANI+1AVNMpAHTLaGhmG4eqPCjIsTiPgDBYs18CE2ElgAAAABJRU5ErkJggg==',
			'3080' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7RAMYAhhCGVqRxQKmMIYwOjpMdUBW2craytoQEBCALDZFpNHR0dFBBMl9K6OmrcwKXZk1Ddl9qOqg5ok0ujYEoolh2oHNLdjcPFDhR0WIxX0A8+XLPydMEHwAAAAASUVORK5CYII=',
			'DAAA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgMYAhimMLQiiwVMYQxhCGWY6oAs1srayujoEBCAIibS6NoQ6CCC5L6opdNWpq6KzJqG5D40dVAx0VDX0MDQENzmQd2CKRYagCk2UOFHRYjFfQDwH865R4QP8AAAAABJRU5ErkJggg==',
			'2B7D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7WANEQ1hDA0MdkMREpoi0MjQEOgQgiQW0ijQ6AMVEkHW3AtU1OsLEIG6aNjVs1dKVWdOQ3RcAVDeFEUUvkNfoEIAqxtogAjQNVUykQaSVFaga2S2hoUA3NzCiuHmgwo+KEIv7APrMyv/Q+WMNAAAAAElFTkSuQmCC',
			'133B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB1YQxhDGUMdkMRYHURaWRsdHQKQxEQdGBodGgIdRFD0MrQyINSBnbQya1XYqqkrQ7OQ3IemDiaGzTwsYljcEoLp5oEKPypCLO4DAIpsyVindVWBAAAAAElFTkSuQmCC',
			'DB86' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7QgNEQxhCGaY6IIkFTBFpZXR0CAhAFmsVaXRtCHQQQBUDqnN0QHZf1NKpYatCV6ZmIbkPqg6reSKExLC4BZubByr8qAixuA8A1dnNlGNj/8wAAAAASUVORK5CYII=',
			'2C6D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxlCGUMdkMREprA2Ojo6OgQgiQW0ijS4Njg6iCDrBoqxNjDCxCBumjZt1dKpK7OmIbsvAKjOEVUvSBdrQyCKGGsDyA5UMaAqDLeEhmK6eaDCj4oQi/sAx5bLFJvnsUkAAAAASUVORK5CYII=',
			'F787' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNFQx1CGUNDkMQCGhgaHR0dGkTQxFyBJJpYKyNQXQCS+0KjVk1bFbpqZRaS+4DyAUB1rQwoehkdWBsCpqCKsQJhQACqmEgDI9Ax6GIMoYwoYgMVflSEWNwHAFdRzM2rjKUdAAAAAElFTkSuQmCC',
			'866C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGaYGIImJTGFtZXR0CBBBEgtoFWlkbXB0YEFRJ9LA2sDogOy+pVHTwpZOXZmF7D6RKaKtrI6ODgxo5rk2BGIVQ7UD0y3Y3DxQ4UdFiMV9AMN+yyigZk/JAAAAAElFTkSuQmCC',
			'86A0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYQximMLQii4lMYW1lCGWY6oAkFtAq0sjo6BAQgKJOpIG1IdBBBMl9S6OmhS1dFZk1Dcl9IlNEW5HUwc1zDcUi1hCAZgcrUG8AiltAbgaKobh5oMKPihCL+wDRYc0DOKtaPgAAAABJRU5ErkJggg==',
			'D1B8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QgMYAlhDGaY6IIkFTGEMYG10CAhAFmtlDWBtCHQQQRFjQFYHdlLUUiAKXTU1C8l9aOoQYtjMQxebgqk3FOhidDcPVPhREWJxHwCSvsyAmkShIQAAAABJRU5ErkJggg==',
			'62B9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGaY6IImJTGFtZW10CAhAEgtoEWl0bQh0EEEWa2BodG10hImBnRQZtWrp0tBVUWFI7guZwjAFaN5UFL2tDAGsQBNQxRgdgGIodgDd0oDuFtYA0VBXNDcPVPhREWJxHwA1mc0KaKl40QAAAABJRU5ErkJggg==',
			'D157' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgMYAlhDHUNDkMQCpjAGsAJpEWSxVlYsYkC9U4E0kvuilgJRZtbKLCT3gdSBSTS9IJvQxVgbAgJQxKYwBDA6Ojqgupk1lCGUEUVsoMKPihCL+wAQj8sLhzo/IQAAAABJRU5ErkJggg==',
			'31ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7RAMYAlhDHUMdkMQCpjAGsDYwOgQgq2xlBYuJIItNYUAWAztpZdSqqKWhK7OmIbsPVR3UPOLEAqB6kd0iCnQxupsHKvyoCLG4DwDbiMfsVLobTwAAAABJRU5ErkJggg==',
			'F09E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QkMZAhhCGUMDkMQCGhhDGB0dHRhQxFhbWRsC0cREGl0RYmAnhUZNW5mZGRmaheQ+kDqHEEy9DhjmsbYyYohhcwummwcq/KgIsbgPAHQwytrDlXBfAAAAAElFTkSuQmCC',
			'00E8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDHaY6IImxBjCGsDYwBAQgiYlMYW1lBaoWQRILaBVpdEWoAzspaum0lamhq6ZmIbkPTR2SGKp52OzA5hZsbh6o8KMixOI+AGTbysTK1yxQAAAAAElFTkSuQmCC',
			'F5A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkNFQxmmMEx1QBILaBBpYAhlCAhAE2N0dHQQQRULYW0IhImBnRQaNXXp0lVRUWFI7gOa0+jaEDAVVS9QLBRsE7J5IHVodrC2sjYEoLmFEWhvAIqbByr8qAixuA8AXXbOSuqw/RkAAAAASUVORK5CYII=',
			'28BF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGUNDkMREprC2sjY6OiCrC2gVaXRtCEQRY2hFUQdx07SVYUtDV4ZmIbsvANM8RgdM81gbMMVEGjD1hoaC3YzqlgEKPypCLO4DAG8zyeVUuvomAAAAAElFTkSuQmCC',
			'E21D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMYQximMIY6IIkFNLC2MoQwOgSgiIk0OgLFRFDEGBodpsDFwE4KjVq1dNW0lVnTkNwHVDeFYQqG3gBMMUYHTDHWBpAYsltCQ0RDHYEQ2c0DFX5UhFjcBwB+fsurb5zHzAAAAABJRU5ErkJggg==',
			'7AB2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDGaY6IIu2MoawNjoEBKCIsbayNgQ6iCCLTRFpdG10aBBBdl/UtJWpoUAKyX2MDmB1jch2sDaIhro2BLQiu0WkAaiuIWAKslhAA1hvAIZYKGNoyCAIPypCLO4DAKgKzbd+0trfAAAAAElFTkSuQmCC',
			'C499' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WEMYWhlCGaY6IImJtDJMZXR0CAhAEgtoZAhlbQh0EEEWa2B0RRIDOylq1dKlKzOjosKQ3BcAMjEkYCqqXtFQB5AMqh2tjA0BKHYAdbaiuwWbmwcq/KgIsbgPAMPIy/TZEO5HAAAAAElFTkSuQmCC',
			'F004' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkMZAhimMDQEIIkFNDCGMIQyNKKKsbYyOjq0ooqJNLo2BEwJQHJfaNS0lamroqKikNwHURfogKk3MDQE0w5sbkETw3TzQIUfFSEW9wEAPybOt9pDDqYAAAAASUVORK5CYII=',
			'C3D4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WEOAMJShIQBJTKRVpJW10aERWSygkaHRtSGgFUWsgaGVtSFgSgCS+6JWrQpbuioqKgrJfRB1gQ5oeoHmBYaGYNqBzS0oYtjcPFDhR0WIxX0A80bPQTBdM+AAAAAASUVORK5CYII=',
			'2C0B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WAMYQxmmMIY6IImJTGFtdAhldAhAEgtoFWlwdHR0EEHWDRRjbQiEqYO4adq0VUtXRYZmIbsvAEUdGDI6QMSQzWNtwLQDqArDLaGhmG4eqPCjIsTiPgADuss9znsqOgAAAABJRU5ErkJggg==',
			'BC12' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QgMYQxmmMEx1QBILmMLa6BDCEBCALNYq0uAYwugggqIOyJvC0CCC5L7QqGmrVgFRFJL7oOoaHdDMA4q1MqCJOUwBmYjmlikMAehuZgx1DA0ZBOFHRYjFfQB3984GORchFAAAAABJRU5ErkJggg==',
			'2913' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WAMYQximMIQ6IImJTGFtZQhhdAhAEgtoFWl0DAHKIesGijlMAcohu2/a0qVZ01YtzUJ2XwBjIJI6MGR0YADrRTaPtYEFQ0ykAeiWKahuCQ1lDGEMdUBx80CFHxUhFvcBAPxFzBiPPLpmAAAAAElFTkSuQmCC',
			'3AF9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RAMYAlhDA6Y6IIkFTGEMYW1gCAhAVtnK2srawOgggiw2RaTRFSEGdtLKqGkrU0NXRYUhuw+sjmEqit5W0VCgWAOqGFgdih0BEL0obhENgJiH7OaBCj8qQizuAwBxmMvjR3neQwAAAABJRU5ErkJggg==',
			'57DB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNEQ11DGUMdkMQCGhgaXRsdHQLQxRoCHUSQxAIDGFpZgWIBSO4Lm7Zq2tJVkaFZyO5rZQhAUgcVY3RgRTMvAGgaupjIFJEGVjS3sAYAxdDcPFDhR0WIxX0AzqPMa3sWTrwAAAAASUVORK5CYII=',
			'B4AE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QgMYWhmmMIYGIIkFTGGYyhDK6ICsLqAVKOLoiCo2hdGVtSEQJgZ2UmjU0qVLV0WGZiG5L2CKSCuSOqh5oqGuoehiDJjqpmCKgdwMFENx80CFHxUhFvcBAHOPy9zVZrVIAAAAAElFTkSuQmCC',
			'1696' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxOrC2Mjo6BAQgiYk6iDSyNgQ6CKDoFWkAiSG7b2XWtLCVmZGpWUjuY3QQbWUICUQxD6i30QGoVwRNzBFDDItbQjDdPFDhR0WIxX0AhojInFBreLsAAAAASUVORK5CYII=',
			'6409' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WAMYWhmmMEx1QBITAfIZQhkCApDEAloYQhkdHR1EkMUaGF1ZGwJhYmAnRUYtXbp0VVRUGJL7QqaItLI2BExF0dsqGuoKNAFVjKGV0dEBxQ6gW1rR3YLNzQMVflSEWNwHAJPpy9LPy/pzAAAAAElFTkSuQmCC',
			'F15A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDHVqRxQIaGANYGximOqCIsYLEAgJQxIB6pzI6iCC5LzRqVdTSzMysaUjuA6ljaAiEqUMWCw1BNw+LOkZHRzQx1lCGUEYUsYEKPypCLO4DAAbbylZW6yJdAAAAAElFTkSuQmCC',
			'5E65' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkNEQxlCGUMDkMQCGkQaGB0dHRjQxFgbUMUCA0BijK4OSO4LmzY1bOnUlVFRyO5rBapzdACagKQbJAY2FckOsFigA7KYyBSQWxwCkN3HGgByM8NUh0EQflSEWNwHAM8dyycWHJoTAAAAAElFTkSuQmCC',
			'73A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7QkNZQximMEx1QBZtFWllCGUICEARY2h0dHR0EEEWm8LQytoQCBODuClqVdjSVVFRYUjuY3QAqQuYiqyXtYGh0TU0oAFZTAQk1hCAYgdQBUgvilsCGlhDQOahuHmAwo+KEIv7ABEZzH4mp0LEAAAAAElFTkSuQmCC',
			'A685' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGUMDkMRYA1hbGR0dHZDViUwRaWRtCEQRC2gVaQCqc3VAcl/U0mlhq0JXRkUhuS+gVRRonkODCJLe0FCRRteGABQxoHlAsUAHVDGQWxwCAlDEQG5mmOowCMKPihCL+wDKUsuf17ipEQAAAABJRU5ErkJggg==',
			'9E3C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7WANEQxlDGaYGIImJTBFpYG10CBBBEgtoBfECHVjQxRodHZDdN23q1LBVU1dmIbuP1RVFHQRCzUMWE8BiBza3YHPzQIUfFSEW9wEALW/LTnlMSBMAAAAASUVORK5CYII=',
			'3B43' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7RANEQxgaHUIdkMQCpoi0MrQ6OgQgq2wVaXSY6tAggiwGUhfo0BCA5L6VUVPDVmZmLc1Cdh9QHWsjXB3cPNfQAFTzQHY0otoBdksjqluwuXmgwo+KEIv7AHIozgleuSW4AAAAAElFTkSuQmCC',
			'CD22' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WENEQxhCGaY6IImJtIq0Mjo6BAQgiQU0ijS6NgQ6iCCLNYg0OoBIJPdFrZq2MmtlFpBGuA+srpWh0QFd7xSGVgY0OxwCGKYwoLvFgSEA3c2soYGhIYMg/KgIsbgPAJyvzTQnQal8AAAAAElFTkSuQmCC',
			'0BBC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDGaYGIImxBoi0sjY6BIggiYlMEWl0bQh0YEESC2gFqXN0QHZf1NKpYUtDV2Yhuw9NHUwMbB4DATuwuQWbmwcq/KgIsbgPAJv2y8aXe36mAAAAAElFTkSuQmCC',
			'2CE7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDHUNDkMREprA2uoJoJLGAVpEGdDEGoBgrSA7ZfdOmrVoaumplFrL7AsDqWpHtZXQAi01BcUsD2I4AZDGgKqBbGB2QxUJDwW5GERuo8KMixOI+AEBnyy3HEf/UAAAAAElFTkSuQmCC',
			'D9A7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgMYQximMIaGIIkFTGFtZQhlaBBBFmsVaXR0dMAQc20IAEKE+6KWLl2auipqZRaS+wJaGQOB6loZUPQyNLqGBkxBFWMBmRfAgOYW1oZAB3Q3o4sNVPhREWJxHwA90M6W1BeEbQAAAABJRU5ErkJggg==',
			'A492' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QvQ2AQAiFH8VtcO6DhT0m0twGboEFG+gIV+iUWuJPqYm87nsJfAHbbQx/yid+xHAoFg4sCRZqWSSwPEOT9ZwDE6cumVgOfqXWuo5lK8FPPDsGmeIN1Ub5aHDaByeT+cYOlyuDkg4/+N+LefDbASD1zGvfPzK9AAAAAElFTkSuQmCC',
			'9DB4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGRoCkMREpoi0sjY6NCKLBbSKNLoCSQyxRocpAUjumzZ12srU0FVRUUjuY3UFqXN0QNbLADYvMDQESUwAYgc2t6CIYXPzQIUfFSEW9wEAJeHPUlV4fqwAAAAASUVORK5CYII=',
			'076E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGUMDkMRYAxgaHR0dHZDViUxhaHRtQBULaGVoZQWagOy+qKWrpi2dujI0C8l9QHUBrI7oehkdWBsC0exgbUAXYw0QaWBE08voINLAgObmgQo/KkIs7gMAuZDJUQ7tyksAAAAASUVORK5CYII=',
			'9432' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM2QMQ6AIAxFPwO7A96nC3tNZPE0MPQG4A1YOKWwleioif1TX5r2pWi3ivhTPvGzDDEBhRRzGcUmYlaMBQFxIzcx45EoOuV3llpbae1QftY76XNJ34CsgcZWxRZB7zljdpHhcnc2Yf/B/17Mg98FzPbMmOg8GRYAAAAASUVORK5CYII=',
			'5494' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7QkMYWhlCGRoCkMSA7KmMjg6NaGKhrA0BrchigQGMrkCxKQFI7gubtnTpysyoqChk97WKtDKEBDog62VoFQ11aAgMDUG2o5WhlRFoE7I6kSlAMUcHFDHWAEw3D1T4URFicR8A/A/NkIhk33IAAAAASUVORK5CYII=',
			'A2AC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeElEQVR4nGNYhQEaGAYTpIn7GB0YQximMEwNQBJjDWBtZQhlCBBBEhOZItLo6OjowIIkFtDK0OjaEOiA7L6opauWLl0VmYXsPqC6KawIdWAYCjSfNRRVLKCV0QGkDtUO1gbWhgAUtwS0ioa6NgSguHmgwo+KEIv7AMENzEytXNfoAAAAAElFTkSuQmCC',
			'EEFF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAR0lEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDA0NDkMQCGkQaWBsYHRhIEwM7KTRqatjS0JWhWUjuI9M8nGJgN6OJDVT4URFicR8AQurJrS2aBrYAAAAASUVORK5CYII=',
			'9E10' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQxmmMLQii4lMEWlgCGGY6oAkFtAq0sAYwhAQgCbGMIXRQQTJfdOmTg1bNW1l1jQk97G6oqiDwFZMMQGwGKodYLdMQXULyM2MoQ4obh6o8KMixOI+AIH6ytyHH6ODAAAAAElFTkSuQmCC',
			'0536' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB1EQxlDGaY6IImxBog0sDY6BAQgiYlMEQGSgQ4CSGIBrSIhDI2ODsjui1o6demqqStTs5DcF9DK0OjQ6IhiHlgMaJ4Iqh0YYqwBrK3obmF0YAxBd/NAhR8VIRb3AQBC4cxXbhaKCgAAAABJRU5ErkJggg==',
			'F09A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZAhhCGVqRxQIaGEMYHR2mOqCIsbayNgQEBKCIiTS6NgQ6iCC5LzRq2srMzMisaUjuA6lzCIGrQ4g1BIaGoNnB2ICuDuQWRzQxkJsZUcQGKvyoCLG4DwCDGMxVGf7r9QAAAABJRU5ErkJggg==',
			'5269' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkMYQxhCGaY6IIkFNLC2Mjo6BASgiIk0ujY4OoggiQUGMADFGGFiYCeFTVu1dOnUVVFhyO5rZZjC6ugwFVkvUCyAFWQqsh2tjA5AMRQ7RKawNqC7hTVANNQBzc0DFX5UhFjcBwAI5sv21gGZjAAAAABJRU5ErkJggg==',
			'1D3A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7GB1EQxhDGVqRxVgdRFpZGx2mOiCJiTqINDo0BAQEoOgFijU6OogguW9l1rSVWVOBJJL70NQhxBoCQ0MwxdDVAd2Cqlc0BORmRhSxgQo/KkIs7gMAJqXKcn9WtJEAAAAASUVORK5CYII=',
			'800F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WAMYAhimMIaGIImJTGEMYQhldEBWF9DK2sro6IgiJjJFpNG1IRAmBnbS0qhpK1NXRYZmIbkPTR3UPGxi2OzAdAvUzShiAxV+VIRY3AcAxkjJXU5j34UAAAAASUVORK5CYII=',
			'DA41' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYAhgaHVqRxQKmMIYwtDpMRRFrZW1lmOoQiiom0ugQCNcLdlLU0mkrMzOzliK7D6TOFd2OVtFQ19CAVgzzMNyCKRYaABYLDRgE4UdFiMV9AAnjz51hyGSPAAAAAElFTkSuQmCC',
			'3CFE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7RAMYQ1lDA0MDkMQCprA2ujYwOqCobBVpwBCbItLAihADO2ll1LRVS0NXhmYhuw9VHdw8bGLodmBzC9jNDYwobh6o8KMixOI+ADFmybqKV2jzAAAAAElFTkSuQmCC',
			'D37D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QgNYQ1hDA0MdkMQCpoi0MjQEOgQgi7UyNDoAxURQxYCijjAxsJOilq4KW7V0ZdY0JPeB1U1hRNfb6BCAKebogCYGdAtrAyOKW8BubmBEcfNAhR8VIRb3AQBVaszf3ytz1gAAAABJRU5ErkJggg==',
			'9E4B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQxkaHUMdkMREpog0MLQ6OgQgiQW0AsWmOjqIoIsFwtWBnTRt6tSwlZmZoVlI7mN1FWlgbUQ1jwGolzU0EMU8AZB5jah2gN2Cphebmwcq/KgIsbgPAH9hy5FWG9LXAAAAAElFTkSuQmCC',
			'27CD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WANEQx1CHUMdkMREpjA0OjoEOgQgiQW0MjS6Ngg6iCDrbmVoZW1ghIlB3DRt1bSlq1ZmTUN2XwBDAJI6MGR0YHRAF2MFQ1Q7RICQEc0toaFAFWhuHqjwoyLE4j4AFXzKWUKOGaAAAAAASUVORK5CYII=',
			'8BD3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGUIdkMREpoi0sjY6OgQgiQW0ijS6NgQ0iKCrA4oFILlvadTUsKWropZmIbkPTR1O83DageYWbG4eqPCjIsTiPgD7cs582SigAQAAAABJRU5ErkJggg==',
			'D795' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGUMDkMQCpjA0Ojo6OiCrC2hlaHRtCEQXa2VtCHR1QHJf1NJV01ZmRkZFIbkPqC6AISSgQQRFLyPQLHQx1gZGoB0oYlNEGhgdHQKQ3RcaAFQRyjDVYRCEHxUhFvcBAD/+zRACMxMOAAAAAElFTkSuQmCC',
			'2C68' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxlCGaY6IImJTGFtdHR0CAhAEgtoFWlwbXB0EEHWDRRjbWCAqYO4adq0VUunrpqahey+AKA6NPMYHUB6A1HMY20A2YEqBlSF4ZbQUEw3D1T4URFicR8ASCnMRnEnT3AAAAAASUVORK5CYII=',
			'77D1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNFQ11DGVpRRFsZGl0bHaZiiDUEhKKITWFoZW0IgOmFuClq1bSlq6KWIruP0YEhAEkdGLICRdHFRICi6GIBINFGB0yxUIbQgEEQflSEWNwHAOxszM5K5E2wAAAAAElFTkSuQmCC',
			'8C35' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ0EwAElMZApro2ujowOyuoBWkQaHhkAUMZEpIg0MjY6uDkjuWxo1bdWqqSujopDcB1Hn0CCCZh6QxBAD2SHSgO4WhwBk90HczDDVYRCEHxUhFvcBAGKpzVUVToJvAAAAAElFTkSuQmCC',
			'1809' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB0YQximMEx1QBJjdWBtZQhlCAhAEhN1EGl0dHR0EEHRy9rK2hAIEwM7aWXWyrClq6KiwpDcB1EXMBVVr0ija0NAA7oY0AoMOzDcEoLp5oEKPypCLO4DABZlyQoZfA+FAAAAAElFTkSuQmCC',
			'447C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpI37pjC0soYGTA1AFgthmMrQEBAggiTGGMIQytAQ6MCCJMY6hdGVodHRAdl906YtXbpq6cosZPcFTBFpZZjC6IBsb2ioaKhDAKoYyC2MDowodoDd18CA4haoGKqbByr8qAexuA8AQxfKjYbMT6QAAAAASUVORK5CYII=',
			'E6A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMYQximMEx1QBILaGBtZQhlCAhAERNpZHR0dBBBFWtgbQiEiYGdFBo1LWzpqqioMCT3BTSItrI2BExF09voGgoyAU2sIQDNDlaQXhS3gNwMMg/ZzQMVflSEWNwHAMfizc9rcu8/AAAAAElFTkSuQmCC',
			'00A4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB0YAhimMDQEIImxBjCGMIQyNCKLiUxhbWV0dGhFFgtoFWl0bQiYEoDkvqil01amroqKikJyH0RdoAOG3tDA0BA0O1iBLkF3C7oYyM3oYgMVflSEWNwHAM34zcGm7gzZAAAAAElFTkSuQmCC',
			'8F52' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQ11DHaY6IImJTBFpYG1gCAhAEgtoBYkxOoigq5sKpJHctzRqatjSzKxVUUjuA6kDmtDogGYeiGTAsCNgCgOaHYyODgGobgbqDWUMDRkE4UdFiMV9AKgozICn94wjAAAAAElFTkSuQmCC',
			'DEF3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7QgNEQ1lDA0IdkMQCpog0sDYwOgQgi7WCxBgaRLCIBSC5L2rp1LCloauWZiG5D00dQfNQxLC4BezmBgYUNw9U+FERYnEfAN/jzX20N1l+AAAAAElFTkSuQmCC',
			'48BB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpI37pjCGsIYyhjogi4WwtrI2OjoEIIkxhog0ujYEOoggibFOQVEHdtK0aSvDloauDM1Ccl/AFEzzQkMxzWOYgk0MUy9WNw9U+FEPYnEfAMhIzANI6bO+AAAAAElFTkSuQmCC',
			'D11D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QgMYAhimMIY6IIkFTGEMYAhhdAhAFmtlDWAEiomgiIH1wsTATopauipq1bSVWdOQ3IemjjSxKRAxZLeEBrCGMoY6orh5oMKPihCL+wBbZMoAlyu+/AAAAABJRU5ErkJggg==',
			'EC38' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7QkMYQxlDGaY6IIkFNLA2ujY6BASgiIk0ODQEOoigiTEg1IGdFBo1bdWqqaumZiG5D00dQgyLeZh2YLoFm5sHKvyoCLG4DwDM/s8TWjVqMwAAAABJRU5ErkJggg==',
			'0E89' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGaY6IImxBog0MDo6BAQgiYlMEWlgbQh0EEESC2gFqXOEiYGdFLV0atiq0FVRYUjug6hzmIqul7UhoEEEw44AFDuwuQWbmwcq/KgIsbgPAEQFyr+X2jxVAAAAAElFTkSuQmCC',
			'43EC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpI37prCGsIY6TA1AFgsRaWVtYAgQQRJjDGFodG1gdGBBEmOdwgBUx+iA7L5p01aFLQ1dmYXsvgBUdWAYGgoxD9UtmHYwTMF0C1Y3D1T4UQ9icR8AkJ3KNb3FiJQAAAAASUVORK5CYII=',
			'7F66' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNFQx1CGaY6IIu2ijQwOjoEBKCJsTY4Ogggi00BiTE6oLgvamrY0qkrU7OQ3MfoAFTn6IhiHmsDSG8gUAYhJoJFLKAB0y0gMQZ0Nw9Q+FERYnEfAAefy2eSn7YRAAAAAElFTkSuQmCC'        
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
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
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
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
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


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
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
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
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
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
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
        default: 
            $ctype="application/x-download";
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
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>