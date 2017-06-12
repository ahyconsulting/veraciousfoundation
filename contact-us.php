<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'shashank@zetabyte.in';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website Enquiry Form';
   $message = 'Values submitted from web site form:';
   $success_url = '';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));

   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }

   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }

   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }

   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veracious Foundation : Welcome</title>
<meta name="generator" content="Zetabyte Solutions Private Limited">
<style>
div#container
{
   width: 970px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   background-image: url(images/tail.gif);
   color: #000000;
   font-family: Arial;
   font-size: 8px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
</style>
<style>
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style>
#Shape1
{
   width: 977px;
   height: 1205px;
   background-color: #FFFFFF;
   border: 0px #A0A0A0 solid;
   -moz-border-radius: 20px;
   -webkit-border-radius: 20px;
   border-radius: 20px;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   -ms-border-radius: 20px;
   border-radius: 20px;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text5 div
{
   text-align: left;
   white-space: nowrap;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#Line1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
}
#Image10
{
   border: 0px #000000 solid;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text9 div
{
   text-align: left;
   white-space: nowrap;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: right;
}
#wb_Text10 div
{
   text-align: right;
   white-space: nowrap;
}
#wb_Form1
{
   background-color: #F5F5F5;
   border: 0px #000000 solid;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox3
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   border: 1px #08497E solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #08497E;
   color: #FFFFFF;
   font-family: Arial;
   font-size: 12px;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text6 div
{
   text-align: left;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text7 div
{
   text-align: left;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text13 div
{
   text-align: left;
   white-space: nowrap;
}
#TextArea1
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   resize: none;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text8 div
{
   text-align: left;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_CssMenu1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_CssMenu1 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
}
#wb_CssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 0px 0px 0px;
   width: 163px;
}
#wb_CssMenu1 a
{
   display: block;
   float: left;
   color: #FFFFFF;
   border: 1px #C0C0C0 solid;
   background-color: #08497E;
   background: -moz-linear-gradient(top,#08497E 0%,#03365B 100%);
   background: -webkit-linear-gradient(top,#08497E 0%,#03365B 100%);
   background: -o-linear-gradient(top,#08497E 0%,#03365B 100%);
   background: -ms-linear-gradient(top,#08497E 0%,#03365B 100%);
   background: linear-gradient(top,#08497E 0%,#03365B 100%);
   font-family: Verdana;
   font-size: 16px;
   font-weight: bold;
   font-style: normal;
   text-decoration: none;
   width: 151px;
   height: 38px;
   padding: 0px 5px 0px 5px;
   vertical-align: middle;
   line-height: 38px;
   text-align: center;
}
#wb_CssMenu1 li:hover a, #wb_CssMenu1 a:hover
{
   color: #08497E;
   background-color: #D3D3D3;
   background: -moz-linear-gradient(top,#D3D3D3 0%,#A9A9A9 100%);
   background: -webkit-linear-gradient(top,#D3D3D3 0%,#A9A9A9 100%);
   background: -o-linear-gradient(top,#D3D3D3 0%,#A9A9A9 100%);
   background: -ms-linear-gradient(top,#D3D3D3 0%,#A9A9A9 100%);
   background: linear-gradient(top,#D3D3D3 0%,#A9A9A9 100%);
   border: 1px #C0C0C0 solid;
}
#wb_CssMenu1 li.firstmain
{
   padding-left: 0px;
}
#wb_CssMenu1 li.lastmain
{
   padding-right: 0px;
}
#wb_CssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#Image11
{
   border: 0px #000000 solid;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text11 div
{
   text-align: left;
   white-space: nowrap;
}
#SlideShow1 .image
{
   border-width: 0;
   left: 0;
   top: 0;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text12 div
{
   text-align: left;
   white-space: nowrap;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text14 div
{
   text-align: left;
}
</style>
<script src="scripts/jquery-1.7.2.min.js"></script>
<script>
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.Editbox1.value == "")
   {
      alert("Please enter a value for the \"Name\" field.");
      theForm.Editbox1.focus();
      return false;
   }
   regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
   if (!regexp.test(theForm.Editbox2.value))
   {
      alert("Please enter a valid email address.");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.Editbox2.value == "")
   {
      alert("Please enter a value for the \"Email\" field.");
      theForm.Editbox2.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.Editbox3.value))
   {
      alert("Please enter only digit characters in the \"Contact\" field.");
      theForm.Editbox3.focus();
      return false;
   }
   if (theForm.Editbox3.value == "")
   {
      alert("Please enter a value for the \"Contact\" field.");
      theForm.Editbox3.focus();
      return false;
   }
   if (theForm.TextArea1.value == "")
   {
      alert("Please enter a value for the \"\" field.");
      theForm.TextArea1.focus();
      return false;
   }
   return true;
}
</script>
<script src="nivo-slider/jquery.nivo.slider.pack.js"></script>
<link rel="stylesheet" href="nivo-slider/nivo-slider.css">
<link rel="stylesheet" href="nivo-slider/theme_default.css">
<script>
$(document).ready(function()
{
   $("a[data-rel='SlideShow1']").attr('rel', 'SlideShow1');
   $('#wb_SlideShow1,#SlideShow1').addClass('theme-default');$('#wb_SlideShow1,#SlideShow1').nivoSlider({});
});
</script>
</head>
<body>
<div id="container">
<div id="wb_Shape1" style="position:absolute;left:0px;top:32px;width:977px;height:1205px;z-index:10;">
<div id="Shape1"></div></div>
<div id="wb_Shape2" style="position:absolute;left:13px;top:231px;width:250px;height:296px;z-index:11;">
<img src="images/contact-us_0010.png" id="Shape2" alt="" style="border-width:0;width:250px;height:296px;"></div>
<div id="wb_Text5" style="position:absolute;left:25px;top:289px;width:227px;height:204px;z-index:12;text-align:left;">
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>&gt;</strong> To train teachers to teach the </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">children below 8 years of age through </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">fun-filled and interesting teaching </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">activities taking care of the </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">developmental milestones.</span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>&gt;</strong> To provide employment to women </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">through training&nbsp; and guidance for </span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">opening pre schools.</span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:17px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>&gt;</strong> To develop a&nbsp; stress free society&nbsp; </span></div>
<div style="line-height:16px;"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">through counseling&nbsp; sessions.</span></div>
</div>
<div id="wb_Shape3" style="position:absolute;left:14px;top:540px;width:948px;height:49px;z-index:13;">
<img src="images/contact-us_0011.png" id="Shape3" alt="" style="border-width:0;width:948px;height:49px;"></div>
<div id="wb_Text3" style="position:absolute;left:24px;top:548px;width:566px;height:32px;z-index:14;text-align:left;">
<span style="color:#08497E;font-family:Verdana;font-size:27px;"><strong>Contact Us</strong></span></div>
<div id="wb_Text4" style="position:absolute;left:22px;top:244px;width:243px;height:18px;z-index:15;text-align:left;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:15px;"><strong>Key Objectives of Veracious</strong></span></div>
<hr id="Line1" style="margin:0;padding:0;position:absolute;left:22px;top:276px;width:232px;height:1px;z-index:16;">
<div id="wb_Image10" style="position:absolute;left:0px;top:1180px;width:959px;height:11px;z-index:17;">
<img src="images/contact-us_0012.png" id="Image10" alt="" style="width:959px;height:11px;"></div>
<div id="wb_Text9" style="position:absolute;left:12px;top:1204px;width:436px;height:19px;z-index:18;text-align:left;">
<div style="line-height:16px;"><span style="color:#696969;font-family:Verdana;font-size:13px;">&#0169; Copyrights 2014 Veracious Foundation. All Rights Reserved.</span></div>
</div>
<div id="wb_Text10" style="position:absolute;left:613px;top:1203px;width:338px;height:19px;text-align:right;z-index:19;">
<div style="line-height:16px;"><span style="color:#696969;font-family:Verdana;font-size:13px;">Powered by Zetabyte Solutions Private Limited</span></div>
</div>
<div id="wb_Form1" style="position:absolute;left:545px;top:606px;width:415px;height:390px;z-index:20;">
<form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="formid" value="form1">
<input type="text" id="Editbox1" style="position:absolute;left:85px;top:53px;width:314px;height:29px;line-height:29px;z-index:0;" name="Name" value="">
<input type="text" id="Editbox2" style="position:absolute;left:85px;top:100px;width:314px;height:29px;line-height:29px;z-index:1;" name="Email" value="">
<input type="text" id="Editbox3" style="position:absolute;left:85px;top:147px;width:314px;height:29px;line-height:29px;z-index:2;" name="Contact" value="">
<input type="submit" id="Button1" name="" value="Submit Enquiry" style="position:absolute;left:304px;top:335px;width:96px;height:25px;z-index:3;">
<div id="wb_Text6" style="position:absolute;left:34px;top:107px;width:51px;height:16px;z-index:4;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">E-mail :</span></div>
<div id="wb_Text1" style="position:absolute;left:36px;top:61px;width:51px;height:16px;z-index:5;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Name :</span></div>
<div id="wb_Text7" style="position:absolute;left:36px;top:156px;width:51px;height:16px;z-index:6;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Phone :</span></div>
<textarea name="Message" id="TextArea1" style="position:absolute;left:87px;top:194px;width:314px;height:125px;z-index:7;" rows="6" cols="47"></textarea>
<div id="wb_Text8" style="position:absolute;left:20px;top:197px;width:70px;height:16px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Message :</span></div>
<div id="wb_Text2" style="position:absolute;left:16px;top:16px;width:371px;height:18px;z-index:9;text-align:left;">
<span style="color:#08497E;font-family:Verdana;font-size:16px;"><strong>LEAVE US YOUR VALUABLE MESSAGE</strong></span></div>
</form>
</div>
<div id="wb_Text13" style="position:absolute;left:23px;top:615px;width:526px;height:462px;z-index:21;text-align:left;">
<div style="line-height:21px;"><span style="color:#08497E;font-family:Verdana;font-size:16px;"><strong>VERACIOUS FOUNDATION CONTACT CENTRES</strong></span></div>
<div style="line-height:21px;"><span style="color:#08497E;font-family:Verdana;font-size:16px;"><strong><br></strong></span></div>
<div style="line-height:21px;"><span style="color:#CF5507;font-family:Verdana;font-size:15px;"><strong>Early Childhood Care and Education Centre</strong></span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Udaan Early Childhood Academy </span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Shop No. 01 Nandlal Compound, </span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Opp- Everest World, Kolshet Road,</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Thane West - 400 607</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><strong>Contact :</strong> Mrs. Jyoti - 9920-978-008</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><br></span></div>
<div style="line-height:21px;"><span style="color:#CF5507;font-family:Verdana;font-size:15px;"><strong>Early Childhood Care and Education Centre</strong></span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Harshdeep Activity Centre,</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">304 B-1, Mansarovar, Bhiwandi,</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Dist - Thane</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><strong>Contact :</strong> Mrs. Deepa H. Nayak - 8421-556-226 / 7745-030-666</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><br></span></div>
<div style="line-height:21px;"><span style="color:#CF5507;font-family:Verdana;font-size:15px;"><strong>Montessori</strong></span><span style="color:#696969;font-family:Verdana;font-size:15px;"> </span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">IMTTI at Podar Jumbo Kids Plus,</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Bungalow No.7, Tejashree, Near KMC Hospital,</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;">Near Waghbil Flyover, Dongripada, GB Road, Thane - 400 607</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><strong>Contact :</strong> 9819-727-577 / 8976-016-889</span></div>
<div style="line-height:21px;"><span style="color:#696969;font-family:Verdana;font-size:15px;"><br></span></div>
<div style="line-height:17px;"><span style="color:#CF5507;font-family:Verdana;font-size:15px;"><strong>E-mail ID :</strong></span><span style="color:#696969;font-family:Verdana;font-size:15px;"> veraciousfoundation@gmail.com</span></div>
</div>
<div id="wb_CssMenu1" style="position:absolute;left:0px;top:179px;width:978px;height:94px;z-index:22;">
<ul>
<li class="firstmain"><a href="./index.html" target="_self">Home</a>
</li>
<li><a href="./about-us.html" target="_self">About&nbsp;Us</a>
</li>
<li><a href="./our-courses.html" target="_self">Our&nbsp;Courses</a>
</li>
<li><a href="./achievements.html" target="_self">Achievements</a>
</li>
<li><a href="./gallery.html" target="_self">Gallery</a>
</li>
<li><a href="./contact-us.php" target="_self">Contact&nbsp;Us</a>
</li>
</ul>
<br>
</div>
<div id="wb_Image11" style="position:absolute;left:17px;top:37px;width:125px;height:131px;z-index:23;">
<a href="./index.html"><img src="images/vf-logo-web.jpg" id="Image11" alt="" style="width:125px;height:131px;"></a></div>
<div id="wb_Text11" style="position:absolute;left:624px;top:61px;width:340px;height:100px;z-index:24;text-align:left;">
<div style="line-height:20px;"><span style="color:#FF0F00;font-family:Verdana;font-size:13px;"><strong>FRANCHISEE AVAILABLE</strong></span></div>
<div style="line-height:20px;"><span style="color:#FF0F00;font-family:Verdana;font-size:13px;">We offer Franchisee for Early Childhood Care and </span></div>
<div style="line-height:20px;"><span style="color:#FF0F00;font-family:Verdana;font-size:13px;">Education, a pre-school Teacher Training Course. </span></div>
<div style="line-height:20px;"><span style="color:#FF0F00;font-family:Verdana;font-size:13px;"><strong>Call Us now on (+91) 9819-727-577</strong></span></div>
</div>
<div id="SlideShow1" style="position:absolute;left:275px;top:231px;width:687px;height:296px;z-index:25;">
<a href="images/vera_slide01.jpg" data-rel=""><img class="image" style="width:687px;height:296px;" src="images/vera_slide01.jpg" alt="" title=""></a>
<a href="images/vera_slide02.jpg" data-rel=""><img class="image" style="width:687px;height:296px;display:none;" src="images/vera_slide02.jpg" alt="" title=""></a>
<a href="images/vera_slide03.jpg" data-rel=""><img class="image" style="width:687px;height:296px;display:none;" src="images/vera_slide03.jpg" alt="" title=""></a>
</div>
<div id="wb_Text12" style="position:absolute;left:160px;top:53px;width:442px;height:137px;z-index:26;text-align:left;">
<div style="line-height:27px;"><span style="color:#08497E;font-family:Verdana;font-size:21px;"><strong>VERACIOUS FOUNDATION</strong></span></div>
<div style="line-height:19px;"><span style="color:#08497E;font-family:Verdana;font-size:15px;"><em>Offers courses for Pre-school Teachers and Mothers</em></span></div>
<div style="line-height:15px;"><span style="color:#08497E;font-family:Verdana;font-size:12px;"><strong>Government Registered </strong></span><span style="color:#FF0F00;font-family:Verdana;font-size:12px;"><strong>(Regn No.: E-8279/Thane)</strong></span></div>
<div style="line-height:15px;"><span style="color:#08497E;font-family:Verdana;font-size:12px;">Internationally Accredited and Certified by ;</span></div>
<div style="line-height:19px;"><span style="color:#FF0F00;font-family:Verdana;font-size:15px;"><strong>International Accreditation Organization (IAO)</strong></span><strong></strong></div>
<div style="line-height:15px;"><span style="color:#FF0F00;font-family:Verdana;font-size:12px;"><strong><br></strong></span></div>
</div>
<div id="wb_Text14" style="position:absolute;left:656px;top:555px;width:306px;height:19px;z-index:27;text-align:left;">
<span style="color:#FF0000;font-family:Arial;font-size:17px;"><strong><a href="http://#">DOWNLOAD OUR PROSPECTUS</a></strong></span></div>
</div>
</body>
</html>