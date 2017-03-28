<!DOCTYPE html>

<?php include_once("analyticstracking.php") ?>
<?php
if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";
}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/large/";

}

$this->load->library('session');
/*if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

108.162.221.136
50.7.103.155
*/


//var start
function getIPAddress($deep_detect){
//$ip="86.96.201.72";
	 if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];

        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }

$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
return $addrDetailsArr;

}

/*
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
*/


if(!isset($_SESSION['currencycode']))
{

	$addrDetailsArr = getIPAddress(false);
	if($addrDetailsArr['geoplugin_status']==404 || $addrDetailsArr['geoplugin_status']==200){
	$addrDetailsArr =getIPAddress(true);
	}

}

//end avr
/*Get user ip address details with geoplugin.net*/
// $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
// $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
//print_r($addrDetailsArr);
/*Get City name by return array*/
$city = $addrDetailsArr['geoplugin_city'];

/*Get Country name by return array*/
$country = $addrDetailsArr['geoplugin_countryName'];

$currency = $addrDetailsArr['geoplugin_currencyCode'];
//geoplugin_currencyCode]
/*Comment out these line to see all the posible details*/
/*echo '<pre>';
print_r($addrDetailsArr);
die();*/
if(!$country)
{
   $country='Not Define';
}
//echo '<strong>IP Address</strong>:- '.$ip.'<br/>';
//echo '<strong>Country</strong>:- '.$country.'<br/>';
//echo '<strong>currency</strong>:- '.$currency.'<br/>';
//$_SESSION['currencycode']=$currency;
//echo $ip;
//echo '<pre>';
//print_r($_SESSION['currencycode']);
//die();

if(!($_SESSION['currencycode']))
{
	//echo 'hi';
	//$currency = $_SESSION['currencycode'];
  $this->session->set_userdata('currencycode',$currency);
      //echo "sessionnotset";
	  	//echo '<script type="text/javascript">' .'changecurrency("'.$currency.'");' . '</script>';
}
else
{
	//echo 'hiytryrt';
	 $currency= $_SESSION['currencycode'];
	//echo '<script type="text/javascript">' .'changecurrency("'.$currency.'");' . '</script>';


}
	$c = $this->home_model->changecurrency($currency);
	$cvalue = $c->stylior_roc;
    $multiplier = $c->multiplier;
	$ceiling = $c->ceiling;
    $this->session->set_userdata('currencyvalue',$cvalue);
	$this->session->set_userdata('multiplier',$multiplier);
	$this->session->set_userdata('ceiling',$ceiling);
?>
 <html lang="en">
 <head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="32x32" />
    <!--  non-retina iPhone pre iOS 7 -->
    <link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="57x57" />
    <!--  non-retina iPad iOS 7 -->
<link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="76x76" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="<?= $https_url ?>/site/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= $https_url ?>/site/css/ionicons.min.css">
<!-- 3d page css  -->
<?php
$data=explode('/', $_SERVER['REQUEST_URI']);
if($data[1]=="home" && $data[2]=="new_custom" ||$data[2]=="new_custom_demo"){?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=$https_url ?>/site/css/3d_page_css.css">
<link type="text/css" href="<?=$https_url ?>scroll/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src=<?=base_url() ?>js/remodal.js></script>
<link rel="stylesheet" href="<?=$https_url ?>site/css/remodal.css">
<link rel="stylesheet" href="<?=$https_url ?>site/css/remodal-default-theme.css">
<link href="<?=$https_url ?>3D/3dicons/css/style.css" rel="stylesheet">
<!-- ebd 3d page css -->
<?php }else if($data[1]=="details" || $data[1]=="shirt-collections" || $data[1]=="mens-shirts" || $data[1]=="mens-suits" || $data[1]=="mens-trousers" || $data[1]=="mens-vests" || $data[1]=="mens-ties" || $data[1]=="mens-blazers" || $data[1]=="mens-cuff-links" ){?>
  <link rel="stylesheet" href="<?=$https_url ?>site/css/3d_page_css.css">
  <script src=<?= $bas_ul ?>site/js/remodal.js></script>
  <link rel="stylesheet" href="https://www.stylior.com/site/css/remodal.css">
  <link rel="stylesheet" href="https://www.stylior.com/site/css/remodal-default-theme.css">
  <link href="<?=$https_url ?>site/css/bootstrap.css" rel="stylesheet" />
  <link href="<?=$https_url ?>site/css/details_style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/animate.css">
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/font-awesome.min.css" />
  <link href="<?=$https_url ?>site/css/simple-lightbox.min.css" rel="stylesheet" />
 <?php }else if($data[1]=="trial-shirt"){?>
<link href="<?=$https_url ?>site/css/bootstrap.css" rel="stylesheet" />
<script src=<?= $bas_ul ?>site/js/remodal.js></script>
<link rel="stylesheet" href="https://www.stylior.com/site/css/remodal.css">
<link rel="stylesheet" href="https://www.stylior.com/site/css/remodal-default-theme.css">
<link rel="stylesheet" href="<?=$https_url ?>site/css/3d_page_css.css">
<?php }else if($data[1]=="cart" && $data[2]=="lum_view_cart"){?>
<script src=<?= $bas_ul ?>site/js/remodal.js></script>
<link rel="stylesheet" href="https://www.stylior.com/site/css/remodal.css">
<link rel="stylesheet" href="https://www.stylior.com/site/css/remodal-default-theme.css">
<link rel="stylesheet" href="<?=$https_url ?>site/css/3d_page_css.css">
<?php } else { ?>
  <link rel="stylesheet" type="text/css" href="<?= $https_url ?>site/css/animate.css">
  <link rel="stylesheet" type="text/css" href="<?= $https_url ?>site/css/owl.carousel.css">
  <link href="<?=$https_url ?>site/css/bootstrap.css" rel="stylesheet" />
<?php } ?>
<?php if(isset($title)){?>
  <title><?php echo $title;?></title>
	<meta property="og:url"           content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?php echo $title;?>" />
	<meta property="og:description"   content="<?php echo $fb_description; ?>" />
	<meta property="og:image"         content="<?php echo $https_url_large_img."".$fb_image; ?>" />



  <meta name="keywords" content="<?php echo $metakeywords;?>"/>
  <meta name="description" content="<?php echo $metadescription;?>"/>
<?php } ?>


<link href="<?=$https_url ?>site/css/style.css" rel="stylesheet" />
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3GEN2SShCeWCch4n28FuaCrneMO1i03e";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1248172288528875');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1248172288528875&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-66956406-1', 'auto');

  ga('send', 'pageview');

</script>


<style>
body
{
	margin:0;
	padding:0;
}
.but_lum_ang
{
	padding:3px 15px;
	color:#fff;
	background-color:#282c3e;
	border:1px solid #282c3e;
	font-size:12px;
}
.but_lum_ang:hover
{
	padding:3px 15px;
	color:#282c3e;
	background-color:#fff;
	border:1px solid #282c3e;
}
@media (min-width: 769px){
.pop_up_font_col
{
	background-color:#fff;padding:20px;text-rendering: optimizeLegibility !important;-webkit-font-smoothing: antialiased !important;line-height:30px;letter-spacing:1px;
}
.pop_up_font_col_head
{ font-size:20px;font-weight:bold;padding:10px; }
.lum_cur_size_cl
{text-align:center;width:15%;}
.footer_bottom
{
	height:30px;background-color:#eee;padding-top:15px;font-size:12px;color:#808080;
}
.new_lum_footer_change_left
{
	display:inline-block;text-align:left;width:47%;padding-left:20px;
}
.new_lum_footer_change_right
{
	display:inline-block;text-align:right;width:50%;
}
.lum_header
{
font-family:Century Gothic;
height:70px;
padding:0;
margin:0;
font-size:12px;
border-bottom:1px solid #ccc;
}
.lum_logo
{
text-align:center;
display:inline-block;
width:25%;
position:relative;
}
.lum_logo_img
{
	width:180px;
}
.lum_left_menu
{
display:inline-block;
width:37.5%;
position:relative;
padding-top:25px;
}



.lum_right_menu
{
display:inline-block;
width:37.5%;
position:relative;
padding-top:25px;
}

.lum_dropbtn {
    color: #191919;
    padding: 12px;
    font-size: 12px;
    border: none;
    cursor: pointer;
	background-color:#fff;
}

.lum_dropdown {
    position: relative;
    display: inline-block;
}

.lum_dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    min-width: 160px;
    box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.2);
	background-color:rgba(256,256,256,0.7);
}

.lum_dropdown-content a {
    color: #191919;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.lum_dropdown-content a:hover {background-color: #f1f1f1;color:#000;}

.lum_dropdown:hover .lum_dropdown-content {
    display: block;
}

.lum_dropdown:hover .lum_dropbtn {
}
.lum_footer
{
	padding-top:10px;
	border-top:1px solid #eee;
	font-size:12px;
	font-family:Century Gothic;
	color:#191919
}
.lum_content
{
	min-height:200px;
}

.lum_column_small
{
	width:30%;
	display:inline-block;
	padding-left:2%;
	vertical-align:top;
	font-weight:normal;
}
a
{
	text-decoration:none;
	color:#191919;
}
.lum_column_small_head
{
	text-decoration:underline;
	padding-bottom:10px;
	padding-left:30px;
	font-weight:bold;
}
.lum_column_big
{
	width:24%;
	display:inline-block;
	vertical-align:top;
}
.lum_column_big_img
{
	width:25px;
	padding:0px 1px;
}
.lum_column_small_img
{
	width:13px;
	padding:2px 0px;
	position:relative;top:2px;
}

.lum_column_big_input_join
{
	border-color:#eee;
	border-width:0 0 1px 0;
	border-style:solid;
	padding:2px 5px;
	margin:12px 0;
	width: 250px;
}
.lum_column_big_input_join:hover
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_input_join:focus
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_button_join
{
	margin:12px 0;
	background-color:#757575;
	color:#fff;
	border:1px solid #757575;
	padding:1.5px 5px;
	position:relative;
	top:1px;
	font-weight:bold;
	letter-spacing:2px;
}
.lum_column_big_button_join:hover
{
	background-color:#0099ff;
	border:1px solid #0099ff;
}
.lum_column_small>div
{
	padding:3px 0;
	height:30px;
}
.lum_column_big>div
{
	padding:3px 0;
}
.lum_column_small_head_link
{
	width:26px;height:22px;float:left;position:relative;top:-2px;
}
.new_lum_footer_change
{
	min-height:70px;background-color:#000;padding-top:10px;
}
.new_lum_footer_change_space
{
	padding:10px 0px 0px 50px;
}
}

@media screen and (max-width: 768px) and (min-width: 421px) {

.new_lum_footer_change_right
{
	margin-top:20px;
}
.pop_up_font_col
{
	background-color:#fff;padding:20px;text-rendering: optimizeLegibility !important;-webkit-font-smoothing: antialiased !important;line-height:20px;letter-spacing:1px;
}
.pop_up_font_col_head
{ font-size:16px;font-weight:bold;padding:10px; }
.pop_up_font_col_content
{
	display:none;
}
.lum_cur_size_cl
{display:none;text-align:center;width:40%;background-color:#fff;}
.footer_bottom
{
	min-height:23px;background-color:#eee;padding:15px 0px;font-size:10px;color:#808080;
}
.lum_logo
{
text-align:center;
float:left;
width:79%;
height:60px;
}

.lum_left_menu
{
float:left;
width:10%;
height:60px;
}
.lum_logo_img
{
	width:150px;
}
.lum_right_menu
{
float:left;
width:10%;
height:60px;
}
.lum_footer
{
	padding-top:6px;
	border-top:1px solid #eee;
	font-size:12px;
	font-family:Century Gothic;
	color:#191919
}
.lum_content
{
	min-height:100px;
}
.lum_column_small
{
	width:49%;
	display:inline-block;
	vertical-align:top;
	font-weight:normal;
}
.lum_column_small_head
{
	text-decoration:underline;
	padding: 0 0 5px 5px;
	font-weight:bold;
}
.lum_column_big
{
	width:49%;
	display:inline-block;
}
.lum_column_big_img
{
	width:26px;
	padding:2px;
}

.lum_column_small_img
{
	width:13px;

	position:relative;top:2px;
}
.lum_column_big_input
{
	padding:2px 0;

}
.lum_column_small>div
{
	padding:3px 0;
	height:30px;
}
.lum_column_big>div
{
	padding:3px 0;
}
a
{
	text-decoration:none;
	color:#191919;
}
.lum_column_big_input_join
{
	border-color:#eee;
	border-width:0 0 1px 0;
	border-style:solid;
	padding:2px 5px;
}
.lum_column_big_input_join:hover
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_input_join:focus
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_button_join
{
	background-color:#757575;
	color:#fff;
	border:1px solid #757575;
	padding:1px 5px;
	font-weight:bold;
	letter-spacing:2px;
}
.lum_column_big_button_join:hover
{
	background-color:#0099ff;
	border:1px solid #0099ff;
}
.lum_column_small_head_link
{
	width:26px;height:26px;float:left;position:relative;top:-4px;
}
.new_lum_footer_change
{
	background-color:#000;padding:30px 0px;
	text-align:center;
}
/*.new_lum_footer_change_space
{
	display:none;
}*/


}


@media screen and (max-width: 420px) and (min-width: 280px) {

.new_lum_footer_change_right
{
	margin-top:20px;
}
.pop_up_font_col
{
	background-color:#fff;padding:20px;text-rendering: optimizeLegibility !important;-webkit-font-smoothing: antialiased !important;line-height:20px;letter-spacing:1px;
}
.pop_up_font_col_head
{ font-size:14px;font-weight:bold;padding:10px; }
.pop_up_font_col_content
{
	display:none;
}
.new_lum_footer_change
{
	background-color:#000;padding:30px 0px;
	text-align:center;
}
/*.new_lum_footer_change_space
{
	display:none;
}*/
.lum_cur_size_cl
{display:none;text-align:center;width:40%;background-color:#fff;}
.footer_bottom
{
	min-height:20px;background-color:#eee;padding:10px 0px;font-size:9px;color:#808080;
}

.lum_logo
{
text-align:center;
float:left;
width:79%;
height:60px;
}

.lum_left_menu
{
float:left;
width:10%;
height:60px;
}
.lum_logo_img
{
	width:150px;
}
.lum_right_menu
{
float:left;
width:10%;
height:60px;
}
.lum_footer
{
	padding-top:4px;
	border-top:1px solid #eee;
	font-size:10px;
	font-family:Century Gothic;
	color:#191919
}
.lum_content
{
	min-height:100px;
}
.lum_column_small
{
	width:49%;
	display:inline-block;
	vertical-align:top;
	font-weight:normal;
}
.lum_column_small_head
{
	text-decoration:underline;
	padding: 0 0 5px 5px;
	font-weight:bold;
}
.lum_column_big
{
	width:49%;
	display:inline-block;
}
.lum_column_big_img
{
	width:26px;
	padding:2px;
}

.lum_column_small_img
{
	width:15px;

	position:relative;top:1px;
}
.lum_column_big_input
{
	padding:2px 0;

}
.lum_column_small>div
{
	padding:2px 0;
	height:30px;
}
.lum_column_big>div
{
	padding:1px 0;
}
a
{
	text-decoration:none;
	color:#191919;
}
.lum_column_big_input_join
{
	border-color:#eee;
	border-width:0 0 1px 0;
	border-style:solid;
	padding:2px 5px;
}
.lum_column_big_input_join:hover
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_input_join:focus
{
	border-color:#0099ff;
	color:#0099ff;
}
.lum_column_big_button_join
{
	background-color:#757575;
	color:#fff;
	border:1px solid #757575;
	padding:1px 5px;
	font-weight:bold;
	letter-spacing:2px;
	font-size:10px;
}
.lum_column_big_button_join:hover
{
	background-color:#0099ff;
	border:1px solid #0099ff;
}
.lum_column_small_head_link
{
	width:26px;height:26px;float:left;position:relative;top:-4px;
}
}
</style>

<style>

/*STYLES FOR CSS POPUP*/

#blanket {
   background-color:#111;
   opacity: 0.65;
   *background:none;
   position:absolute;
   z-index: 9999998;
   top:0px;
   left:0px;
   width:100%;
}
@media (min-width: 1900px){
.hidden-xss
{
	display:none !important;
}
.hidden-xs
{
	display:block;
	font-size:12px;
}
 #container {
	background: #FFFFFF;
	margin: 0 auto;
	font-size:14px;
	font-family:Century Gothic;
	text-align: left;
}
}
@media screen and (max-width: 1899px) and (min-width: 769px) {
.hidden-xss
{
	display:none !important;
}
.hidden-xs
{
	display:block;
	font-size:12px;
}
 #container {
	margin: 0 auto;
	font-size:14px;
	font-family:Century Gothic;
	text-align: left;
}

}
@media screen and (max-width: 768px) and (min-width: 421px) {
.hidden-xss
{
	display:block;

}
.hidden-xs
{
	display:none;
}
 #container {
	margin: 0 auto;
	font-size:14px;
	font-family:Century Gothic;
	text-align: left;
}

}
@media screen and (max-width: 420px) and (min-width: 280px) {
	.hidden-xss
{
	display:block;
}
.hidden-xs
{
	display:none;
}
 #container {

	margin: 0 auto;
	font-size:14px;
	font-family:Century Gothic;
	text-align: left;
}

}


/*   ----------- styles for login popup -----------*/

.btn-login1:after {
	content: '';
	position: absolute;
	z-index: -1;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

/* Button 1 */
.btn-login1 {
	border: none;
	font-family: century Gothic;
	font-size: 14px;
	color: inherit;
	background: none;
	cursor: pointer;

	display: inline-block;
	margin: 5px 0px;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 100;
	outline: none;
	position: relative;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
    border: 1px solid #000;
    color: #282C3E;
    background: #FFFFFF;
    width: 100%;


}

/* Button 1a */
.btn-login1a:hover,
.btn-login1a:active {

	background: #282C3E;
    color: #fff;
}

.popup_login{

background-color:#fff;
vertical-align:top;
height:500px;
position:relative;
}

.login_fb {
	width: 50%;
	height: 75px;
	float: left;
	cursor: pointer;
}
.login_gmail{
	width: 50%;
	height: 75px;
	float: right;
	cursor: pointer;
}
.signup_fb {
	width: 50%;
	height: 75px;
	float: left;
	cursor: pointer;
}
.signup_gmail{
	width: 50%;
	height: 75px;
	float: right;
	cursor: pointer;
}
.login_fb img{
	width:150px;
	height: 50px;
	padding:5% 2%
}
.login_gmail img{
	width: 150px;
	height: 50px;
	padding:5% 2%;
}
.signup_fb img{
	width:150px;
	height: 50px;
	padding:5% 2%
}
.signup_gmail img{
	width: 150px;
	height: 50px;
	padding:5% 2%;
}
.login_image img{width: 100%;height: 100%;}
.logo_image img{width: 250px;height: 50px;}
.col-md-5,.col-sm-5{
	padding: 0px;
}
.col-md-7,.col-sm-7{
	padding: 0px;
}

@media only screen and (min-width: 320px) {

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:100%;
    padding: 1%;
}
.login_image{
	display: none;
}

#login-step-choose{
	padding: 5%;
}

#login-step-info{
	padding: 5%;
}
.login_fb {
    width: 100%;height: 60px;
    float: left;
    cursor: pointer;
}
.login_gmail {
    width: 100%;
    height: 50px;
    float: left;
    cursor: pointer;
}
.login_fb img{
	width:100%;
	padding:3% 12% ;
	height: 50px;
}
.login_gmail img{
	width: 100%;
	padding:3% 12%;
	height: 50px;
}
.signup_fb {
    width: 100%;
    height: 50px;
    float: left;
    cursor: pointer;
}
.signup_gmail {
    width: 100%;
    height: 50px;
    float: left;
    cursor: pointer;
}
.signup_fb img{
	width:100%;
	padding:3% 12% ;
	height: 50px;
}
.signup_gmail img{
	width: 100%;
	padding:3% 12%;
	height: 50px;
}
.logo_image{
	padding-top: 12%;
}
#popUpDiv_login {
	position:absolute;
	width:260px;
	display:inline-block;
	z-index: 9999999;
}

#popUpDiv_currency {
	position:absolute;
	width:200px;
	display:inline-block;
	z-index: 9999999;
	left:20%;
	top:70px !important;
}
}

@media only screen and (min-width: 480px) {

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:100%;
}

#popUpDiv_login {
	position:absolute;
	width:600px;
	display:inline-block;
	z-index: 9999999;
}
#popUpDiv_currency {
	position:absolute;
	width:200px;
	display:inline-block;
	z-index: 9999999;
}
}
@media only screen and (min-width: 768px) {

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:100%;

	margin-top: 4%;
}
.login_image{
	display: block;
}


}
@media only screen and (min-width: 1024px) {

#login-box {

    position:absolute;
    display:inline-block;
    padding-left: 10%;
    padding-right: 10%;
    z-index:10;
}

#popUpDiv_login {
	position:absolute;
	width:1000px;
	display:inline-block;
	z-index: 9999999;

}
#popUpDiv_currency {
	position:absolute;
	width:500px;
	display:inline-block;
	z-index: 9999999;
	left:35%;
	top:100px !important;

}
}
@media only screen and (min-width: 1200px) {

	#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width: 80%
    margin-left: 10%
	}

#popUpDiv_login {
	position:absolute;
	width:1000px;
	display:inline-block;
	z-index: 9999999;

}

#popUpDiv_currency {
	position:absolute;
	width:600px;
	display:inline-block;
	z-index: 9999999;
	left:27%;
	top:100px !important;

}


}


@media only screen and (min-width: 320px) {
	.popupbox{
	display:inline-block;
	min-width:300px;
	width: 90%;
	vertical-align:top;

	position:relative;
	z-index:9999;
	padding-left: 3%;
    left: 5px;
}

.close-symbol{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:-15px;
	left:100px;
	z-index: 99999999;
}
.close-symbol1{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:15px;
	left:110%;
	z-index: 99999999;
}
.lum_hid_pop_img
{
	display:none;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
}
@media only screen and (min-width: 375px) {
	.popupbox {
    display: inline-block;
    min-width: 320px;
    width: 90%;
    vertical-align: top;
    position: relative;
    z-index: 9999;
    padding-left: 3%;
    left: 20px;
    top: 58px;
}

.close-symbol{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:-15px;left:100px;
}
.close-symbol1{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:70px;left:125%;
}
.lum_hid_pop_img
{
	display:none;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
}

@media only screen and (min-width: 480px) {
	.popupbox{
	display:inline-block;
	width:90%;
	vertical-align:top;
	position:relative;
	z-index:9999;
	padding-left: 3%;
    max-width: 350px;
    left: 70px;
    top: 50px;
}

.close-symbol{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:-15px;left:100px;
}
.close-symbol1{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:60px;left:87%;
}
.lum_hid_pop_img
{
	display:none;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
}
@media only screen and (min-width: 768px) {
	.popupbox{
	display:inline-block;
	width:69%;
	vertical-align:top;
	position:relative;
	z-index:9999;
	padding-left: 3%;
    left: 150px;
    top: 50px;
    min-width: 750px;
}

.lum_hid_pop_img
{
	display:none;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
.logo_image {
    padding-top: 3%;
}

.close-symbol{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:-15px;left:100px;
}
.close-symbol1{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:60px;left:101%;
	z-index:999999;
}
.login_image img {
    width: 100%;
    height: 500px;
}
.login_fb img{
	width:100%;
	padding:3% 12% ;
	height: 60px;
}
.login_gmail img{
	width: 100%;
	padding:3% 12%;
	height: 60px;
}
}
@media only screen and (min-width: 1024px) {
	.popupbox{
	display:inline-block;
	width:69%;
	vertical-align:top;
	position:relative;
	z-index:9999;

}
.popup_login{
background-color:#fff;
vertical-align:top;
height:500px;
position:relative;
width: 658px;
}

.close-symbol{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top: 10px;
    left: 315px;
}
.close-symbol1{
	background-color:#000;
	color:#fff;
	border-radius:50%;
	font-weight:bold;
	text-decoration:none;
	display:block;
	height:27px;
	width:27px;
	text-align:center;
	;position:relative;
	top:60px;left:101%;
	z-index:999999;
}
.lum_hid_pop_img
{
	display:inline-block;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
}
@media only screen and (min-width: 1400px) {
	.popupbox{
	display:inline-block;
	width:69%;
	vertical-align:top;
	position:relative;
	z-index:9999;
	left: 203px;
    top: 138px;
    min-width: 720px;
}
.popup_login{

background-color:#fff;
vertical-align:top;
height:500px;
position:relative;
width: 780px;
}

.close-symbol {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    text-decoration: none;
    display: block;
    height: 27px;
    width: 27px;
    text-align: center;
    position: relative;
    top: 10px !important;
    left: 100px;
}
.close-symbol1 {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    text-decoration: none;
    display: block;
    height: 27px;
    width: 27px;
    text-align: center;
    position: relative;
    top: 154px;
    left: 110%;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:91%;
}
}

@media only screen and (min-width: 1900px) {
.lum_hid_pop_img
{
	display:inline-block;width:45%;vertical-align:top;text-align:right;
}
.lum_hid_pop_cont
{
	display:block;display:inline-block;width:52%;vertical-align:top;text-align:left;
}
.popupbox{
	display:inline-block;
	width:100%;
	vertical-align:top;
	position:relative;
	z-index:9999;
	left:44%;
}
.popup_login{

background-color:#fff;
vertical-align:top;
height:500px;
position:relative;

}
.close-symbol {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    text-decoration: none;
    display: block;
    height: 27px;
    width: 27px;
    text-align: center;
    position: relative;
    top: 10px !important;
    left: 100px;
}
.close-symbol1 {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    text-decoration: none;
    display: block;
    height: 27px;
    width: 27px;
    text-align: center;
    position: relative;
    top: 154px;
    left: 138%;
}
.close_pop_lum
{
	text-align:right;display:inline-block;width:100%;
}
}
.globle-tagline {
font-size:12px; position:absolute;top:10px; left:10px;
}
.globle-tagline a{
color:#282C3E;
font-family: Century Gothic ;}
.globle-tagline a:hover{
text-decoration:none;color:#000000; }

@media (max-width: 767px) {
 .hidden-xs {
   display: none !important;
 }
}
@media (min-width: 768px) and (max-width: 991px) {
 .hidden-sm {
   display: none !important;
 }
}
.menu > ul > li > ul > li > ul > li a:hover{
	color:rgba(239,239,239,1.00)
	}
/* new css */
/* new css */
.top-nav-1{
   float: right;
    z-index: 999999;
    position: absolute;
    top: 15px;
    right: 15px;
    display: block;
	font-size:12px;
	}
.top-nav-1 i{
	margin-right:3px;}
.top-nav-1 ul{ float:left; padding-left:0; margin:0 0}
.top-nav-1 ul li{ list-style:none; display:inline-block;}
.top-nav-1 ul li{ border-right: 1px solid rgba(212,212,212,1.00);}
 .top-nav-1 ul li a{padding: 0px 5px; margin-left: 5px; border:none }

aside.top   {
			float:left;}
 .handle{
                width:115px;
                /*background:#333333;*/
                text-align: left;
                box-sizing: border-box;
                padding:0px 5px;
                cursor: pointer;
                color: white;
                box-sizing: border-box;
				/*background-color:rgba(240,240,240,1.00);
				border:1px solid #D4D4D4;*/
				position: relative;
				text-align:center;
				/*float:left;*/
				  border-right:1px solid rgba(212,212,212,1.00)
            }
ul.hide-1 {
	list-style:none; padding-left:0; margin-top:0; background-color:rgba(240,240,240,1.00);border:1px solid #D4D4D4; /*margin-top:-1px;*/border-top:0;}
ul.hide-1 li{ display:inline-block; margin:5px 5px; border:none}
            .hide-1 {
                display: none; width:115px;
            }
aside div.handle a{
				background-repeat:no-repeat; background-position:left; padding-left:19px;/*background-image:url(<?= $bas_ul ?>site/images/img/icon-flag-india.jpg)*/ color:#333333;
				}
ul.hide-1 li a{ background-repeat:no-repeat; background-position:left; padding-left:19px;/*background-image:url(<?= $bas_ul ?>site/images/img/icon-flag-india.jpg)*/ color:#333333; padding-right: 0; margin:0 0}
			a.cart{
	 padding: 0px 5px;
    margin-left: 5px;
    margin-top: 0;
    display: inline-block; color:#333333;}
	a.cart:hover{
		text-decoration:none; color:rgba(140,140,140,1.00)}
a.cart span{
	background-color:rgba(199,199,199,1.00); color:#000000; padding:5px; border-radius:50px; width:10px; height:10px; font-size:12px; font-weight:bold; border:1px solid #AAAAAA; margin-left:5px}
a.log-in{
	 padding: 0px 5px;
    margin-left: 5px;
    margin-top: 0;
    display: inline-block; float:left; color:#333333;   border-right:1px solid rgba(212,212,212,1.00)}
a.log-in:hover{
		text-decoration:none; color:rgba(140,140,140,1.00)}
.inr{background-image:url(<?= $bas_ul ?>stylior/site/images/img/icon-flag-india.jpg); }
.usd{background-image:url(<?= $bas_ul ?>stylior/site/images/img/icon-flag-en_US.jpg)}
.bhd{background-image:url(<?= $bas_ul ?>stylior/site/images/img/bhd-flag.jpg)}
.sar{background-image:url(<?= $bas_ul ?>stylior/site/images/img/sar-flag.jpg)}
.qar{background-image:url(<?= $bas_ul ?>stylior/site/images/img/qar-flag.jpg)}
.eur{background-image:url(<?= $bas_ul ?>stylior/site/images/img/eur-flag.jpg)}
.aed{background-image:url(<?= $bas_ul ?>stylior/site/images/img/aed-flag.jpg)}
.aud{background-image:url(<?= $bas_ul ?>stylior/site/images/img/aud-flag.jpg)}
.visible-xs,
.visible-sm,
.visible-md,
.visible-lg {
  display: none !important;
}
@media screen and (max-width: 768px) and (min-width: 300px) {
	/*.logo {
    margin-top: 50px;

	}*/}
@media (max-width: 767px) {
  .visible-xs {
    display: block !important;
  }}

	#cssmenu{
		width: 920px;
	}

/*end new css */
</style>
<link href="<?=$https_url ?>site/css/style.css" rel="stylesheet" />

<body>
<div style="border-bottom:1px solid #ccc;background-color: #ffffff;" class="">
<div class="globle-tagline hidden-xs hidden-sm"><i class="fa fa-globe" aria-hidden="true"></i> Global Shipping, Incredibly Easy Returns</div>
<div class="logo"><a href="<?php echo $bas_ul;?>"><img src="<?=base_url() ?>images/relaunch/logo.png" class="img1 new-logo" width="240" alt=""/></a>
</div>
<div class="top-nav visible-xs">
 <ul>
  <?php if($this->session->userdata('user_id')  == "" || $this->session->userdata('usertype')=="Guest")
     { ?>

 <li class="hidden-xs" onclick="popup('popUpDiv_login')"><a style="position:relative;top:0px;" href="#" >LOGIN</i></a></li>

  <?php } else { ?>

    <li class="hidden-xs hidden-sm"><a  href="<?= $bas_ul ?>home/lum_my_account">MY ACCOUNT</a></li>
    <li class="hidden-xs hidden-sm"><a  href="<?= $bas_ul ?>hauth/logout">LOG OUT</a></li>
    <?php } ?>

 <li onclick="popup('popUpDiv_currency')">

 <div class="dropdown">
  <a class="dropdown-toggle" type="button" id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0px;">
  <?php if($this->session->userdata('currencycode') == "EUR")
				{

				?>
					<img src="<?=base_url() ?>images/img/eur-flag.jpg"  /> <?php }

				else if($this->session->userdata('currencycode') == "INR")
				{

			   ?>
				<img src="<?=base_url() ?>images/img/icon-flag-india.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "AED")
				{

				?>
				<img src="<?=base_url() ?>images/img/aed-flag.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "AUD")
				{
					?>
					<img src="<?=base_url() ?>images/img/aud-flag.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "USD")
				{

			?>
				<img src="<?=base_url() ?>images/img/icon-flag-en_US.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "BHD")
				{
					?>
					<img src="<?=base_url() ?>images/img/bhd-flag.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "SAR")
				{

				?> <img src="<?=base_url() ?>images/img/sar-flag.jpg" /> <?php }
				else if($this->session->userdata('currencycode') == "QAR")
				{


				?>
				<img src="<?=base_url() ?>images/img/qar-flag.jpg" /> <?php }
				else
				{


			?> <img src="<?=base_url() ?>images/img/icon-flag-india.jpg" />
	<?php } ?>



  </a>

 </div>
 </li>
 <li><a class="cart-destop" href="<?php echo $bas_ul;?>cart/lum_view_cart"><?php echo $this->cart->total_items();?></a></li>
 </ul>
</div>

<div class="top-nav-1 hidden-xs">
<ul>

  <?php if($this->session->userdata('user_id')  == "" || $this->session->userdata('usertype')=="Guest")
     { ?>
       <li class="hidden-xs" onclick="popup('popUpDiv_login')"><a href="#" >LOGIN</i></a></li>

        <?php } else { ?>



    <li class=""><a  href="<?= $bas_ul ?>home/lum_my_account" class="hidden-xs"> <i class="fa fa-user" aria-hidden="true"></i>MY ACCOUNT</a>
    <a  href="<?= $bas_ul ?>home/lum_my_account" class="visible-xs"> <i class="fa fa-user" aria-hidden="true"></i></a>
    </li>
    <li class=""><a  href="<?= $bas_ul ?>hauth/logout" class="hidden-xs"> <i class="fa fa-user" aria-hidden="true"></i> LOG OUT</a></li>
  <?php } ?>
  </ul>

        <aside class="top">
          <?php if($this->session->userdata('currencycode') == "EUR")
                {

                ?>
                  <div class="handle"><a href="#" class="eur">EUR</a></div> <?php }

                else if($this->session->userdata('currencycode') == "INR")
                {

                 ?>
                <div class="handle"><a href="#" class="inr">INR</a></div><?php }
                else if($this->session->userdata('currencycode') == "AED")
                {

                ?>
                <div class="handle"><a href="#" class="aed">AED</a></div> <?php }
                else if($this->session->userdata('currencycode') == "AUD")
                {
                  ?>
                  <div class="handle"><a href="#" class="aud">AUD</a></div> <?php }
                else if($this->session->userdata('currencycode') == "USD")
                {

              ?>
              <div class="handle"><a href="#" class="usd">USD</a></div> <?php }
                else if($this->session->userdata('currencycode') == "BHD")
                {
                  ?>
                  <div class="handle"><a href="#" class="bhd">BHD</a></div><?php }
                else if($this->session->userdata('currencycode') == "SAR")
                {

                ?> <div class="handle"><a href="#" class="sar">SAR</a></div> <?php }
                else if($this->session->userdata('currencycode') == "QAR")
                {


                ?>
                <div class="handle"><a href="#" class="qar">QAR</a></div> <?php }
                else
                {


              ?> <div class="handle"><a href="#" class="inr">INR</a></div>
          <?php } ?>
            <ul class="hide-1">
                 <li><a href="javascript:void(0);" onClick="changecurrency('USD');" class="usd">USD</a></li>
                 <li><a href="javascript:void(0);" onClick="changecurrency('BHD');" class="bhd">BHD</a></li>
                     <li><a href="javascript:void(0);" onClick="changecurrency('SAR');" class="sar">SAR</a></li>
                      <li><a href="javascript:void(0);" onClick="changecurrency('QAR');" class="qar">QAR</a></li>
                      <li><a href="javascript:void(0);" onClick="changecurrency('EUR');" class="eur">EUR</a></li>
                      <li><a href="javascript:void(0);" onClick="changecurrency('INR');" class="inr">INR</a></li>
                      <li><a href="javascript:void(0);" onClick="changecurrency('AED');" class="aed">AED</a></li>
                      <li><a href="javascript:void(0);" onClick="changecurrency('AUD');" class="aud">AUD</a></li>
            </ul>
        </aside>
        <ul>
       <li>
        <a href="<?php echo $bas_ul;?>cart/lum_view_cart" class="cart hidden-xs"><i class="fa fa-shopping-cart" aria-hidden="true"></i> My Bag  <span><?php echo $this->cart->total_items();?></span></a>
       </li>
       </ul>


</div>
<!-- new navbar design -->
<div id="cssmenu" class="">
<ul>
   <li class="has-sub"><a href="#">SHIRT</a>
    <ul>
      <li><a href="<?php echo $bas_ul;?>mens-shirts"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">FORMAL SHIRTS</div></a></li>
			<!--<li><a href="<?php echo $bas_ul;?>shirt-collections"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">COLLECTIONS</div></a></li>-->
			<li><a href="<?php echo $bas_ul;?>custom-shirt"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">DESIGN YOUR SHIRT</div></a></li>
			<li><a href="<?php echo $bas_ul;?>trial-shirt"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">TRIAL SHIRT</div></a></li>


      </ul>
      </li>

			<li class="has-sub"><a href="#">SUIT</a>
			 <ul>
				<li><a href="<?php echo $bas_ul;?>mens-suits"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"> SUITS </div></a></li>
<li><a href="<?php echo $bas_ul;?>custom-suit"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"> Design Your Suit </div></a></li>



				<li><a href="<?php echo $bas_ul;?>mens-blazers"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"> BLAZERS </div></a></li>

<li><a href="<?php echo $bas_ul;?>custom-blazer"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"> Design Your Blazer </div></a></li>



				<li><a href="<?php echo $bas_ul;?>mens-vests"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"> VESTS </div></a></li>
<li><a href="<?php echo $bas_ul;?>custom-vest"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/suit-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">Design Your Vest </div></a></li>

				 </ul>
			</li>
			 <li class="has-sub"><a href="#">TROUSERS</a>
				<ul>
				 <li><a href="<?php echo $bas_ul;?>mens-trousers"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">FORMAL TROUSERS</div></a></li>
				 <li><a href="<?php echo $bas_ul;?>custom-trouser"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/shirt-hover.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">DESIGN YOUR TROUSER</div></a></li>
			 </ul>
			<!--<li><a href="<?php echo $bas_ul;?>mens-trousers"> TROUSERS</a></li>-->

			<li class="has-sub"><a href="#">ACCESSORIES</a>
			 <ul>
		<li> <a href="<?php echo $bas_ul;?>mens-ties"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/accessories-hover.png" width="25" height="25" alt=""/></div>
		<div style="display:inline-block;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"><span style=""> TIES </span></div></a></li>
		<li> <a href="<?php echo $bas_ul;?>mens-cuff-links"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/accessories-hover.png" width="25" height="25" alt=""/></div>
		<div style="display:inline-block;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px"><span style=""> CUFF LINKS </span></div></a></li>
				 </ul>

				 </li>
				 <li><a href="<?php echo $bas_ul;?>book-a-home-visit">BOOK A HOME VISIT</a></li>

    <li ><a href="<?php echo $bas_ul;?>how-it-works">HOW IT WORKS</a></li>
   <li><a href="<?php echo $bas_ul;?>wedding-suit">WEDDING</a></li>
	 <li><a href="http://www.blog.stylior.com" target="_blank">BLOG</a></li>

    <li  class="has-sub"><a href="#">MORE</a>
    <ul>
      <!--<li><a href=""><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/reffer_earn.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;">REFER AND EARN</div></a></li>-->
	  <li><a href="<?php echo $bas_ul;?>fit-guide"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/fit_guide.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">FIT GUIDE</div></a></li>
	  <li><a href="<?php echo $bas_ul;?>fabric-guide"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/fabric_guide.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">FABRIC GUIDE</div></a></li>
	  <li><a href="<?php echo $bas_ul;?>faq"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/faq.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">FAQ</div></a></li>
	  <li><a href="<?php echo $bas_ul;?>why-custom"><div style="display:inline-block;"><img src="<?=base_url() ?>images/relaunch/blog.png" width="25" height="25" alt=""/></div><div style="display:inline-block;position:ralative;top:-5px;vertical-align:top;position:relative;top:7px;left:5px;font-size:12px">WHY CUSTOM</div></a></li>

      </ul>
    </li>
	  <?php if($this->session->userdata('user_id')  == "" || $this->session->userdata('usertype')=="Guest")
     { ?>

 <li class="hidden-xss" onclick="popup('popUpDiv_login')"><a style="position:relative;top:5px;" href="#" >Login</i></a></li>

  <?php } else { ?>

    <li class="hidden-xss" ><a href="<?= $bas_ul ?>home/lum_my_account">MY ACCOUNT</a></li>
    <li class="hidden-xss" ><a href="<?=$base_url_temp ?>hauth/logout">LOGOUT</a></li>
    <?php } ?>
</ul>
</div>

<? /* ?><div class="container-fluid hidden-xs">
<div class="row">
    <div class="menu-container">
        <div class="menu">
            <ul>

                <li><a href="#">SHOP</a>
                    <ul>
                        <li><a href="#">SHIRT</a>
                           <ul>
                                <li><a href="<?php echo $bas_ul;?>mens-shirts"><img src="<?=base_url() ?>images/shirt-nav-img.jpg" width="242" height="180" alt=""/></a></li>
                                <!--<li><a href="<?php echo $bas_ul;?>mens-shirts">Customised Shirt</a></li>-->
                                  <li><a href="<?php echo $bas_ul;?>home/new_custom/9/10/2015222">Design Your Shirt</a></li>


                            </ul>
                        </li>
                        <li><a href="#">Trial Shirt</a>
                         <ul>
                                <li><a href="<?php echo $bas_ul;?>trial-shirt"><img src="<?=base_url() ?>images/trail-nav-img.jpg" width="240" height="180" alt=""/></a></li>

                            </ul>

                        </li>
                        <li><a href="#">TROUSER</a>
                           <ul>
                                <li><a href="<?php echo $bas_ul;?>mens-trousers"><img src="<?=base_url() ?>images/pant-nav-img.jpg" width="240" height="180" alt=""/></a></li>

                            </ul>
                        </li>
                        <li><a href="#">SUIT</a>
                           <ul>
                                <li><a href="<?php echo $bas_ul;?>mens-suits"><img src="<?=base_url() ?>images/suit-nav-img.jpg" width="240" height="180" alt=""/></a></li>
                                <!--<li><a href="#">blazer </a></li>
                                <li><a href="#">Vest</a></li>-->

                            </ul>
                        </li>
                          <li><a href="#"> TIES</a>
                            <ul>
                                <li><a href="<?php echo $bas_ul;?>mens-ties"><img src="<?=base_url() ?>images/tie-nav-img.jpg" width="240" height="180" alt=""/></a></li>



                            </ul>
                        </li>
                          <li><a href="#"> CUFF LINKS</a>
                            <ul>
                                <li><a href="<?php echo $bas_ul;?>mens-cuff-links"><img src="<?=base_url() ?>images/cuffling-nav-img.jpg" width="240" height="180" alt=""/></a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
             <!--    <li><a href="http://marioloncarek.com">News</a>
                    <ul>
                        <li><a href="http://marioloncarek.com">Today</a></li>
                        <li><a href="#">Calendar</a></li>
                        <li><a href="#">Sport</a></li>
                    </ul>
                </li>
                <li><a href="http://marioloncarek.com">Contact</a>
                    <ul>
                        <li><a href="#">School</a>
                            <ul>
                                <li><a href="#">Lidership</a></li>
                                <li><a href="#">History</a></li>
                                <li><a href="#">Locations</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Study</a>
                            <ul>
                                <li><a href="#">Undergraduate</a></li>
                                <li><a href="#">Masters</a></li>
                                <li><a href="#">International</a></li>
                                <li><a href="#">Online</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Study</a>
                            <ul>
                                <li><a href="#">Undergraduate</a></li>
                                <li><a href="#">Masters</a></li>
                                <li><a href="#">International</a></li>
                                <li><a href="#">Online</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Empty sub</a></li>
                    </ul>
                </li> -->


<li><a href="<?php echo $bas_ul;?>how-it-works">HOW IT WORKS</a></li>
<li><a href="<?php echo $bas_ul;?>book-a-home-visit">BOOK A HOME VISIT</a></li>
<li><a href="<?php echo $bas_ul;?>wedding">WEDDING</a></li>

<li><a href="<?php echo $bas_ul;?>fit-guide">FIT GUIDE</a></li>
<li><a href="<?php echo $bas_ul;?>fabric-guide">FABRIC GUIDE</a></li>
<li><a href="<?php echo $bas_ul;?>faq">FAQ</a></li>
<li><a href="<?php echo $bas_ul;?>why-custom">WHY CUSTOM</a></li>
<li><a href="http://www.blog.stylior.com">BLOG</a></li>
<?php if($this->session->userdata('user_id')  == "" || $this->session->userdata('usertype')=="Guest")
 { ?>

<li class="hidden-xss" onclick="popup('popUpDiv_login')"><a style="position:relative;top:5px;" href="#" >Login</i></a></li>

<?php } else { ?>

<li class="hidden-xss" ><a href="<?= $bas_ul ?>home/lum_my_account">MY ACCOUNT</a></li>
<li class="hidden-xss" ><a href="<?= $bas_ul ?>hauth/logout">LOGOUT</a></li>
<?php } ?>
            </ul>
        </div>
    </div>
    </div>
	</div><? */ ?>
</div>



<div id="container">
	<div id="mainContent">
		<div id="blanket" style="display:none;"></div>
			<div id="popUpDiv_login" style="display:none;text-align:center;">
				<div class="close_pop_lum">
					<a class="close-symbol1" href="javascript:void(0)" onclick="popup('popUpDiv_login')">
					<div style="">X</div>
					</a>
				</div>

				<div class="popupbox">
					<div style="background-color:#fff;">
						<div class="lum_hid_pop_img">
							<div>
								<img width="100%" src="<?=base_url() ?>images/login_images/login_image.png">
							</div>
						</div>
						<div class="lum_hid_pop_cont">
							<div style="padding:5px;">
								<img width="90%" src="<?=base_url() ?>images/relaunch/logo.png">
							</div>
							<div class="for_pass_hide">
								<div id="login-step-choose" style="display: block;text-align:center;">

									<form  method="post" action="/home/auth">

									<div style="padding:5px;">
										<input type="email" name="email" id="inputEmail" placeholder="EMAIL" required>
									</div>
									<div style="padding:5px;">
										<input type="password" name="password" id="inputPassword"  placeholder="PASSWORD" required>
									</div>
									<div style="padding:5px;">
										<button class="but_lum_ang" type="submit">LOG IN </button>
									</div>
									</form>
									<!--<a href="/home/lum_login">-->
									<button id="fgt_pswd" class="but_lum_ang">FORGOT PASSWORD </button>
									<!--</a>-->




									 <div style="padding:5px;">
									  <a href="/hauth/signin_with_hybridauth/facebook" ><img width="70%" src="<?=base_url() ?>images/login_images/login_facebook.png"></a>
									 </div>
									 <div style="padding:5px;">
									  <a href="/hauth/signin_with_hybridauth/google" ><img width="70%" src="<?=base_url() ?>images/login_images/login_gmail.png"></a>
									 </div>



									<button id="create_new" class="but_lum_ang">CREATE NEW ACCOUNT</button>
								</div>
								<div id="login-step-info" style="display: none;text-align:center">

									<form action="<?= $base_url_temp ?>home/registration" method="post" id="regform">
									<input name="action" value="registration" type="hidden">
									<div style="padding:5px;">

											<div class="error_msg_pp"></div>


									</div>

									<div style="padding:5px;">
										<input type="text" name="reg_username" id="reg_username" placeholder="NAME" required>
									</div>
									<div style="padding:5px;">
										<input type="email" name="reg_email"  id="reg_email" placeholder="EMAIL" required>
									</div>
									<div style="padding:5px;">
										<input type="password" name="reg_password" id="reg_password" placeholder="PASSWORD" required>
									</div>
									<div style="padding:5px;">
										<input type="password" name="c_password"  id="c_password" placeholder="CONFIRM PASSWORD" required>
									</div>
									<button class="but_lum_ang">REGISTER </button>
									</form>

									<div style="padding:5px;">
										<a href="/hauth/signin_with_hybridauth/facebook" ><img width="70%" src="<?=base_url() ?>images/login_images/signup_facebook.png"></a>
									</div>
									<div style="padding:5px;">
										<a href="/hauth/signin_with_hybridauth/google" ><img width="70%" src="<?=base_url() ?>images/login_images/signup_gmail.png"></a>
									</div>
									<button class="but_lum_ang" id="login_old">CLICK HERE TO LOG IN</button>
								</div>
								</div>
								<form>
								<div class="for_pass_show" style="display:none;">
									<div> Forgot Password</div>
									<div class="forgotpswd">
									<input style="width:79%;" type="email" class="inputfieldf" name="forgotpassword"  id="f_pswd" placeholder="Please Enter Email " required>
									<button class="forgot" name="forgotpasswordbutton" class="btn-info">Submit </button>

									</div>
									 <a href="#" class="but_lum_ang" id="login_back">BACK</a>
								</div>
							</form>

								<script>
								 $("#fgt_pswd").on("click",function()
								 {
									 $(".for_pass_hide").hide(0);
									 $(".for_pass_show").show(0);
								 });

								</script>
						</div>
					</div>
				</div>
			</div>

		<div id="popUpDiv_currency" class="lum_cur_size_cl" style="display:none;font-family:Century Gothic;">
				<div style="text-align:right;display:inline-block;width:10%;">
					<a class="close-symbol" href="javascript:void(0)" onclick="popup('popUpDiv_currency')">
					<div style="">X</div>
					</a>
				</div>
				<div class="pop_up_font_col">
				<div class="pop_up_font_col_head">
					Select your currency
				</div>
				<div class="pop_up_font_col_content">
					Stylior ships worldwide. Select your currency from below. If your currency is not found select our default currency USD.
				</div>
				<div style="display:inline-block;">
					<div class="popup_currency_values">
					<div style="display:inline-block;">
					<!-- 	<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('USD');">
								<div style="border-bottom:1px solid #eee;">
									<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/icon-flag-en_US.jpg" /></div>
									<div style="display:inline-block;padding:5px;">USD</div>
								</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('BHD');">
								<div style="border-bottom:1px solid #eee;">
									<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/bhd-flag.jpg" /></div>
									<div style="display:inline-block;padding:5px;">BHD</div>
								</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('SAR');">
								<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/sar-flag.jpg" /></div>
								<div style="display:inline-block;padding:5px;">SAR</div>
								</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('QAR');">
							<div style="border-bottom:1px solid #eee;">
							<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/qar-flag.jpg" /></div>
							<div style="display:inline-block;padding:5px;">	QAR</div>
							</div>
							</a>
						</div>
					</div>
					<div style="display:inline-block;">
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('EUR');">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/eur-flag.jpg" /></div>
								<div style="display:inline-block;padding:5px;">EUR</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('INR');">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/icon-flag-india.jpg" /></div>
								<div style="display:inline-block;padding:5px;">INR</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('AED');" style="position:relative;z-index:873;">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/aed-flag.jpg" /></div>
								<div style="display:inline-block;padding:5px;">AED</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('AUD');">
							<div>
								<div style="display:inline-block;padding:5px;"><img src="<?=base_url() ?>images/img/aud-flag.jpg" /></div>
								<div style="display:inline-block;padding:5px;"> AUD</div>
							</div>
							</a>

						</div> -->

						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('SAR');">
								<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/sar-flag.jpg" /></div>
								<div style="display:inline-block;padding:7px;">SAR</div>
								</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('QAR');">
							<div style="border-bottom:1px solid #eee;">
							<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/qar-flag.jpg" /></div>
							<div style="display:inline-block;padding:7px;">QAR</div>
							</div>
							</a>
						</div>
					</div>
					<div style="display:inline-block;">
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('EUR');">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/eur-flag.jpg" /></div>
								<div style="display:inline-block;padding:7px;">EUR</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('INR');">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/icon-flag-india.jpg" /></div>
								<div style="display:inline-block;padding:7px;">INR</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('AED');" style="position:relative;z-index:873;">
							<div style="border-bottom:1px solid #eee;">
								<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/aed-flag.jpg" /></div>
								<div style="display:inline-block;padding:7px;">AED</div>
							</div>
							</a>
						</div>
						<div style="padding:0px 20px;">
							<a href="javascript:void(0);" onClick="changecurrency('AUD');">
							<div>
								<div style="display:inline-block;padding:7px;"><img src="<?=base_url() ?>images/img/aud-flag.jpg" /></div>
								<div style="display:inline-block;padding:7px;"> AUD</div>
							</div>
							</a>

						</div>

					</div>
				</div>
			</div>
			</div>



		</div>
</div>
<script>
		 function changecurrency(val)
	{
 			jQuery("#currencylist").hide();
 			jQuery("#loadingimage").show();
			console.log("changing" + val);
			jQuery.ajax({
			type: 'POST',
			url: '<?= $bas_ul ?>home/changenewcurrency',
			data: "val="+val,
			success:
				function(result)
				{
					window.location.reload();
				}
			});
	}

$(".error_msg_pp").html("");
$("#c_password").blur(function()
{
	var password = $("#reg_password").val();
	var confirmPassword = $("#c_password").val();
	if (password != confirmPassword)
	{
	$("#reg_password").val("");
	$("#c_password").val("");

	$(".error_msg_pp").html('<div class="alert alert-danger">Passwords do not match.</div>');
	// alert("Passwords do not match.");
	return false;
	}
	return true;


});




function toggle(div_id) {
	var el = document.getElementById(div_id);
	if ( el.style.display == 'none' ) {	el.style.display = 'block';}
	else {el.style.display = 'none';}
}
function blanket_size(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportheight = window.innerHeight;
	} else {
		viewportheight = document.documentElement.clientHeight;
	}
	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
		blanket_height = viewportheight;
	} else {
		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
			blanket_height = document.body.parentNode.clientHeight;
		} else {
			blanket_height = document.body.parentNode.scrollHeight;
		}
	}
	var blanket = document.getElementById('blanket');
	blanket.style.height = blanket_height + 'px';
	var popUpDiv = document.getElementById(popUpDivVar);
	popUpDiv_height=blanket_height/200;//200 is half popup's height
	popUpDiv.style.top = popUpDiv_height + 'px';
	popUpDiv_login.style.top = popUpDiv_height + 'px';
	popUpDiv_currency.style.top = popUpDiv_height + 'px';


}
function window_pos(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportwidth = window.innerHeight;
	} else {
		viewportwidth = document.documentElement.clientHeight;
	}
	if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
		window_width = viewportwidth;
	} else {
		if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
			window_width = document.body.parentNode.clientWidth;
		} else {
			window_width = document.body.parentNode.scrollWidth;
		}
	}
	var popUpDiv = document.getElementById(popUpDivVar);
	if(window_width>=320)
	{
	window_width=window_width/2-popUpDiv.width/2;//200 is half popup's width
	}
	if(window_width>=480)
	{
		window_width=window_width/2 - 200;
	}
	if(window_width>=768)
	{
		window_width=window_width/2 - 300;
	}
	if(window_width>=1024)
	{
		window_width=window_width/2 - 350;
	}
	if(window_width>=1800)
	{
		window_width=window_width/2 - 300;
	}


	popUpDiv.style.left = window_width + 'px';

	popUpDiv_login.style.left = window_width + 'px';

	popUpDiv_currency.style.left = window_width + 'px';

}

function popup(windowname) {
	blanket_size(windowname);
	window_pos(windowname);
	toggle('blanket');
	toggle(windowname);
}

	$('.lum_switch').hover(function() {
        $(this).find('.lum_avg_words').hide();
        $(this).find('.lum_avg_num').show();
    });
	$('.lum_switch').mouseleave(function() {
			$(this).find('.lum_avg_num').hide();
			$(this).find('.lum_avg_words').show();
			//$('.lum_avg_words').addClass('active').siblings().removeClass('active');
	});

$(document).ready(function(){
    $("#create_new").click(function(){
        $("#login-step-choose").hide(0);
        $("#login-step-info").show(0);

    });
    $("#login_old").click(function(){
        $("#login-step-info").hide(0);
        $("#login-step-choose").show(0);

    });
/*var added for go back*/
$("#login_back").click(function(){
	//alert("This is testing");
        $(".for_pass_hide").show();
        //$("#login-step-choose").show(0);
        $(".for_pass_show").hide();

});
/*end var*/


});
</script>

<script>
	$(".forgot").on("click",function()
	{

		 var email_recovery = $("#f_pswd").val();
		 //alert(email_recovery);

	//var addrId=$(this).attr("data-attr");
	//alert("hai");
	$.ajax({
		url:'<?= $bas_ul ?>home/forgotten_passwor',
		method:'POST',
		data:{recmail : email_recovery},

		success: function(response)
				{
					//alert('Your PASSWORD Send to Your Register Mail');
					//document.location.href='<?= $bas_ul ?>home/lum_login;
					//$(".se-pre-con").fadeOut("slow");
					alert(response);
					window.location.href="https://www.stylior.com/";
			        //alert(response);

	   		    }
	});

});
</script>
<script src="<?=base_url()?>js/megamenu.js"></script>
<script>
   $('.handle').on('click', function() {
                    $('aside ul').slideToggle();
                });
                </script>
