<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<head>
    <title>PHP FormMail Generator - A free tool to create ready-to-use web email forms with file upload, auto-response email, and dependent dropdowns.</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="PHP FormMail Generator, Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">
</head>
<body>

<style type='text/css'>

body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #ffffff;
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
	width: 372px
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:grey;
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

#one_entry_msg{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

    



</style>



<div class='form_description'>

</div>



<form name="frmFormMail" action='' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onsubmit(this);'>
<input type='hidden' name='formmail_submit' value='Y'>
<div id='err_required' class="form_error" style='display:none;'>
    <label class='form_error_title'>Please check the required fields</label>
</div>

            
            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_0"  id="field_0" value="" class='text_box'>
	<div id='field_0_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>Email:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_1"  id="field_1" value="" class='text_box'>
	<div id='field_1_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>Contact Number:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_2"  id="field_2" value="" class='text_box'>
	<div id='field_2_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_3_div'><div class='col_label'>
	<label class='form_field'>Query:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<textarea name="field_3" id="field_3" rows=4 cols=25 class='text_area'></textarea>

	<div id='field_3_tip' class='instruction'></div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'><label class='form_field'>Security Code:</label> <label class='form_required' >*</label> </div><div class='col_field'>
	<a href='http://www.formmail-maker.com' onclick="document.getElementById('phpfmg_captcha_image').src='admin.php?mod=captcha&amp;func=get&amp;tid='+Math.random();return false;"  title="Free Mail Form Tool">
	<img id="phpfmg_captcha_image" src="http://www.dotzdesignz.com/20120920-06e5/admin.php?mod=captcha&amp;func=get&amp;tid=1348149178"  border=0 style="cursor:pointer;" alt="Click the image to reload. PHP FormMail Generator at http://phpfmg.sourceforge.net"></a>
<a href='http://phpfmg.sourceforge.net' onclick="document.getElementById('phpfmg_captcha_image').src='admin.php?mod=captcha&amp;func=get&amp;tid='+Math.random();return false;"  style="color:#474747;" title="Reload PHP FormMail Generator Security Image" >Reload Image</a><br>
<input type='text' name='e23ce6f3' value='' class='fmgCaptchCode' style='width:73px;' >
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
            <div class='form_submit_block col_field'>
	
                <input type='submit' value='Submit' class='form_button'>
                <span id='phpfmg_processing' style='display:none;'>
                    <img id='phpfmg_processing_gif' src='http://www.dotzdesignz.com/20120920-06e5/admin.php?mod=image&amp;func=processing' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>
            
</ol>
            
            


</form>




<script type="text/javascript">
 /**
*
*  UTF-8 data encode / decode
*  http://www.webtoolkit.info/
*
**/
 
var Utf8 = {
 
	// public method for url encoding
	encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// public method for url decoding
	decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}

 function dd_change( n, max, prefix ){
    if( n >= max-1 )
        return; // the last dropdown, no need to query
    
    //var prefix = 'dd_' ;
    // reset all other dropdown options
    var next = n+1; 
    for( var i = next; i < max; i ++ ){
        var dd = document.getElementById(prefix +'_' + i );
        if( dd && dd.length >= 1 ) dd.length = 1 ; // keep the first one '- select -'
    };


    // request drop down data from server
    var me = this;
    var http;
    var isIE = navigator.appName == "Microsoft Internet Explorer";
    if(isIE){
        me.http = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        me.http = new XMLHttpRequest();
    };
    
    
    // build query string
    var lookup = [];
    for( var i = 0; i < next; i ++ ){
        var v = document.getElementById(prefix +'_' +  i ).value ; 
        lookup.push( "lookup[" + i + "]=" + escape( isIE ? Utf8.encode(v) : v ) );
    };
    lookup = lookup.join('&');
    
    var url = 'admin.php?mod=dd&func=lookup&n='+next+ '&field_name=' + prefix + '&' + lookup;
    me.http.open('get', url);
    me.http.onreadystatechange = function(){
    
        if( me.http.readyState == 4 ){
            // rebuild the next dropdown options
            var eNext = document.getElementById(prefix +'_' + next );
            if( !eNext )
                return;
            
            var data = me.http.responseText;    
            var opts = String(data).split("\n");
            for( var j = 0, J = opts.length; j < J; j ++ ){
                eNext.options[ eNext.length ] = new Option( opts[j], opts[j], false, false );                
            }; // for
        }; //if
        
    }; 
    me.http.send(null);

 }
 
    
function PHPFMG( formID ){
    var frmID = formID;
    var exts = {
        'upload_control' : '',
        'harmful_exts'  : '.php, .html, .css, .js, .exe, .com, .bat, .vb, .vbs, scr, .inf, .reg, .lnk, .pif, .ade, .adp, .app, .bas, .chm, .cmd, .cpl, .crt, .csh, .fxp, .hlp, .hta, .ins, .isp, .jse, .ksh, .Lnk, .mda, .mdb, .mde, .mdt, .mdw, .mdz, .msc, .msi, .msp, .mst, .ops, .pcd, .prf, .prg, .pst, .scf, .scr, .sct, .shb, .shs, .url, .vbe, .wsc, .wsf, .wsh',
        'harmful_errmsg': "File is potential harmful. Upload is not allowed.",
        'allow_exts'  : '.jpg, .gif, .png, .bmp',
        'allow_errmsg': "Upload is not allowed. Please check your file type."
    };

    var Form = null;
    var err_fields=null;
    
    function $( id ){
        return document.getElementById(id);
    }

    function get_form( id ){
        var frm = 'object' == typeof($(id)) ? $(id) : eval( 'document.' + id ) ;
        return frm ? frm : document.forms[0];
    }
    
    function file_ext( f ){
        var n = f.lastIndexOf(".");
        return -1 == n ? '' : f.substr( n ).toLowerCase();
    }
    
    function addLabelEvents(){
        var labels = document.body.getElementsByTagName('LABEL');
        for( var i = 0, N = labels.length; i < N; i ++ ){
            var e = labels[i];
            if( -1 != String(e.className).indexOf('form_choice_text') ){
                var oid = e.getAttribute('oid'); 
                if( !oid ) continue;

                e.onmouseout = function(){ this.className = 'form_choice_text'; };
                e.onmouseover = function(){ this.className = 'form_choice_text form_choice_over'; };
                e.onclick = function(){
                    try{
                        var oid = this.getAttribute('oid'); 
                        var O = document.getElementById(oid);
                        O.checked = !O.checked;
                    }
                    catch(E){};
                };
            }; // if
        }; // for
    } 


    function addFieldBlockEvents(){
        var divs = document.body.getElementsByTagName('DIV');
        for( var i = 0, N = divs.length; i < N; i ++ ){
            var e = divs[i];
            if( -1 != String(e.className).indexOf('field_block') ){
                e.onmouseout = function(){  if( String(this.className).indexOf('form_error_highlight') == -1 ) this.className = 'field_block'; };
                e.onmouseover = function(){ if( String(this.className).indexOf('form_error_highlight') == -1 ) this.className = 'field_block field_block_over'; };
            }; // if
        }; // for
    } 

    function removeHighlight( elements ){
        var divs = typeof(elements) == 'object' ? elements : document.body.getElementsByTagName('DIV');
        for( var i = 0, N = divs.length; i < N; i ++ ){
            var e = divs[i];
            var cn = String(e.className);
            if( -1 != cn.indexOf('form_error_highlight') ){
                e.className = cn.replace('form_error_highlight','');
            }; // if
        }; // for
    } 
    
    function showProcessing(){
        try{
            var E = $('phpfmg_processing');
            if( !E ) return ;
            if( -1 != navigator.userAgent.toLowerCase().indexOf('msie') ){
                E.style.backgroundColor='#2960AF';
                $('phpfmg_processing_gif').style.display = 'none';
                setInterval( 'fmgHandler.dots()', 380 );
            };
            E.style.display = '' ;
        }catch(e){};
        
    }
    
    
    this.highlight_fields = function( fields ){
        var A = fields.split(',');
        for( var i = 0, N = A.length; i < N; i ++ ){
            var E = $( A[i] + '_div' );
            if( E ){
                E.className += ' form_error_highlight'; 
            };
            var T = $( A[i] + '_tip' );
            if( T ){
                T.className += ' instruction_error'; 
            };
        };
        
        if( A.length > 0 ) {
            $('err_required').style.display= has_entry( fields ) ? 'none' : '';
        };
    }
    
    function has_entry( fields ){
        var div = $('one_entry_msg'); 
        if( !div )
            return false;

        div.style.display = fields.indexOf('phpfmg_found_entry') != -1 ? '' : 'none';
        if( typeof(found_entry) != 'undefined' ){
            div.innerHTML = div.innerHTML.replace(/%Entry%/gi,found_entry);
            return true;
        };
        
        return false ;
    }
    
    
    this.choice_clicked = function( id ){
        $(id).checked = !$(id).checked ;
    }
    
    
    this.init = function(){
        //addLabelEvents();
        addFieldBlockEvents();
    }

    this.harmful = function(e){
        if( 'deny' != exts['upload_control'] || e.value == '' ){
            return true; 
        };
        
        var div = $(e.id+'_div');
        removeHighlight( [div] );
        var ext = file_ext(e.value);
        if( -1 != exts['harmful_exts'].toLowerCase().indexOf(ext) ){
            this.highlight_fields(e.id);
            alert( exts['harmful_errmsg'] );
            return false ;
        };
        return true;
    }
    
     
        
    this.is_allow = function(e){
        if( 'allow' != exts['upload_control'] || e.value == '' ){
            return true; 
        };
        
        var div = $(e.id+'_div');
        removeHighlight( [div] );
        var ext = file_ext(e.value);
        if( -1 == exts['allow_exts'].toLowerCase().indexOf(ext) ){
            this.highlight_fields(e.id);
            alert( exts['allow_errmsg'] );
            return false ;
        };
        return true;
    } 

    this.check_upload = function(e){
        if( '' == exts['upload_control'] )
            return true;
        else
            return ( 'deny' == exts['upload_control'] ) 
                   ? this.harmful(e) 
                   : this.is_allow(e);
    }

    this.dots = function(){
        $('phpfmg_processing_dots').innerHTML += '.';
		if( $('phpfmg_processing_dots').innerHTML.length >= 38 ) {
			$('phpfmg_processing_dots').innerHTML = '.';
		};
    }
    
    this.check_fields = function(){
        if( !Form )
            return true ;

        var pass = true ;
        for( var i=0, n=Form.elements.length; i < n ; i ++ ){
          var field = Form.elements[i];
          var type = field.length != undefined && field.type == undefined ? 'radio' : field.type ;
          switch( type.toLowerCase() ){
            case 'file':
                pass = this.check_upload(field);
                break;
          };
          if( !pass ) return false ;
        };
        
        return true;
    }
    
    this.onsubmit = function( form ){
        Form = form ? form : get_form(frmID) ;
        Form.action = location.href.replace('#error','');
        if( !this.check_fields() )
            return false ;
            
        showProcessing();
        return true;
    }
    
}

function toggleOtherInputBox( name, type, id ){
    var field = document.getElementById(id);
    if( !field ) return ;
    var box = document.getElementById(name+'_other');
    var other_check = document.getElementById(name+'_other_check'); 
    if( !box || !other_check ) return ;
    
    switch( type.toLowerCase() ){
        case 'checkbox':
            box.style.display = field.checked ? '' : 'none';
            other_check.value = field.checked ? 1 : 0 ; 
            break;
        case 'radio':
            for( var i=0,n=document.forms.length; i < n; i ++ ){
                try{
                    var r = eval( 'document.forms['+i+'].'+name );
                    if( r ){
                        box.style.display = r[r.length-1].checked ? '' : 'none';
                        other_check.value = r[r.length-1].checked ? 1 : 0 ; 
                    };
                }catch(err){};
            };
            break;
        case 'select':
            box.style.display = field.options[field.options.length-1].selected ? '' : 'none';
            other_check.value = field.options[field.options.length-1].selected ? 1 : 0 ;
            break;
    };
    
}



var fmgHandler = new PHPFMG();
fmgHandler.init();


</script>

<div class='form_footer'>

</div>

	<br><br>
	
	<div style="padding-left:10px; font-size:11px;color:#cccccc;text-decoration:none;">
		&nbsp;<a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash" style="color:#22190f;text-decoration:none;font-weight:bold;">PHP FormMail Generator</a>&nbsp;
	</div>

 </body>
</html>
