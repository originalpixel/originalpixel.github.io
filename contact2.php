<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<head>
    <title></title>
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
	<img id="phpfmg_captcha_image" src="http://www.dotzdesignz.com/20120920-06e5/admin.php?mod=captcha&amp;func=get&amp;tid=1348148660"  border=0 style="cursor:pointer;" alt="Click the image to reload. PHP FormMail Generator at http://phpfmg.sourceforge.net"></a>
<a href='http://phpfmg.sourceforge.net' onclick="document.getElementById('phpfmg_captcha_image').src='admin.php?mod=captcha&amp;func=get&amp;tid='+Math.random();return false;"  style="color:#474747;" title="Reload PHP FormMail Generator Security Image" >Reload Image</a><br>
<input type='text' name='963418ef' value='' class='fmgCaptchCode' style='width:73px;' >
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
            <div class='form_submit_block col_field'>
	
                <input type='submit' value='Submit' class='form_button'>
                </div>
            </li>
            
</ol>
            
            


</form>
	
	
 </body>
</html>
