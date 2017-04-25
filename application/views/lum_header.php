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

 <link href="<?=$https_url ?>site/css/bootstrap.min.css" rel="stylesheet" />
 <link href="<?= $https_url ?>/site/css/bootsnav.css" rel="stylesheet">

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
  <link href="<?=$https_url ?>site/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?=$https_url ?>site/css/details_style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/animate.css">
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="<?=$https_url ?>site/css/font-awesome.min.css" />
  <link href="<?=$https_url ?>site/css/simple-lightbox.min.css" rel="stylesheet" />
  <style>
     .stylior-header .wrap-sticky nav.navbar.bootsnav {
      z-index: 10000;
    
    }
    .top-header .nav-right .dropdown-menu {
        z-index: 10002;
    }
  </style>
  
 <?php }else if($data[1]=="trial-shirt"){?>
<link href="<?=$https_url ?>site/css/bootstrap.min.css" rel="stylesheet" />
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
  <link href="<?=$https_url ?>site/css/bootstrap.min.css" rel="stylesheet" />
<?php } ?>
<?php if(isset($title)){ ?>
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
<link href="<?= $https_url ?>/site/css/mega_menu.css" rel="stylesheet">
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

<body>

<?php ?>

<!-- start header -->
<header id="header" class="header stylior-header">
	<div class="top-header">
    	<div class="container custom-container">
        	<div class="header-bar">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                    	<div class="globle-tagline hidden-xs hidden-sm"><i class="fa fa-globe" aria-hidden="true"></i> Global Shipping, Incredibly Easy Returns</div>
                    </div>
                    <div class="col-md-6 col-xs-12 nav-right">
                    <div class="cart right">
                    	<a href="<?= $bas_ul ?>cart/lum_view_cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge"><?php echo $this->cart->total_items();?></span></a>
                    </div>
                    <div class="dropdown right flag-dropdown">
                      <!-- start var flag selection --> 
                    <?php 
                    if($this->session->userdata('currencycode')!="")
                    {
                    $currency_value=$this->session->userdata("currencycode");
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="sprite flag flag-<?= strtolower($currency_value) ?>" ></span><?= $currency_value ?><i class="fa fa-angle-down"></i>
                    </a>
                    <?php }?>
                    <!-- end var -->
                        <ul class="dropdown-menu">
                        	<li><a href="javascript:void(0);" onclick="changecurrency('AED');" class="aed"><span class="sprite flag flag-aed"></span>AED</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('AUD');" class="aud"><span class="sprite flag flag-aud"></span>AUD</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('BHD');" class="bhd"><span class="sprite flag flag-bhd"></span>BHD</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('EUR');" class="eur"><span class="sprite flag flag-eur"></span>EUR</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('INR');" class="inr"><span class="sprite flag flag-inr"></span>INR</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('QAR');" class="qar"><span class="sprite flag flag-qar"></span>QAR</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('SAR');" class="sar"><span class="sprite flag flag-sar"></span>SAR</a></li>
                            <li><a href="javascript:void(0);" onclick="changecurrency('USD');" class="usd"><span class="sprite flag flag-usd"></span>USD</a></li>
                        </ul> 
                    </div>

                      <div class="right">
        							<ul>
                      <?php if($this->session->userdata('user_id')){  ?>
          			      <li><a href="<?= $bas_ul ?>home/lum_my_account" data-toggle=""><i class="fa fa-user"></i>My Account</a></li>
                      <li class="hidden-xs"><a  href="<?= $bas_ul ?>hauth/logout">Logout</i></a></li>

              				<?php } 
        							else {?>
        							<li class="" ><a  href="<?= $bas_ul ?>home/lum_login" >LOGIN</i></a></li>
                      <!--onclick="popup('popUpDiv_login')" -->
        							<?php  }?>
                    </ul>
                      </div>
                      </div><!-- end of pull-right < login -->
                    </div> 
                </div>
            </div>
        </div>
    </div>         
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-mobile navbar-sticky bootsnav">
    <div class="container custom-container">      
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?php echo $bas_ul;?>"><img src="https://www.stylior.com/stylior/site/images/relaunch/logo.png" class="logo" alt=""></a>
        </div>
        <!-- End Header Navigation -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                <li><a href="<?php echo $bas_ul;?>">Home</a></li>  
                 <li class="dropdown megamenu-fw">
                 	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop</a>
                    <ul class="dropdown-menu megamenu-content" role="menu">
                    	<li class="shop_menu">
                        	<div class="row">
                            	<div class="col-menu col-md-3 col-xs-12 shop_Category">
                                	<h4 class="title">Shop by category</h4>
                                    <div class="content">
                                        <ul class="menu-col">
                                            <li><a href="<?php echo $bas_ul;?>mens-shirts">Shirts</a></li>
                                            <li><a href="<?php echo $bas_ul;?>mens-suits">suits</a></li>
                                            <li><a href="<?php echo $bas_ul;?>mens-blazers">blazers</a></li>
                                            <li><a href="<?php echo $bas_ul;?>mens-trousers">trousers</a></li>
                                            <li><a href="<?php echo $bas_ul;?>mens-vests">vests</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-menu col-md-3 col-xs-12 shop_Accessories">
                                  <h4 class="title">Accessories</h4>
                                  <div class="content">
                                      <ul class="menu-col">
                                            <li><a href="<?php echo $bas_ul;?>mens-ties">ties</a></li>
                                            <li><a href="<?php echo $bas_ul;?>mens-cuff-links">cuff links</a></li>
                                            <li class="coming_soon"><a href="javascript:void(0);">Leather<span class="label label-default">coming soon</span></a></li>
                                      </ul>    
                                </div>
                                </div>
                                <div class="col-menu col-md-6 col-xs-12 offer_image">
                                <img src="<?= $https_url ?>site/images/header/offer-image.jpg" class="" alt="shop">
                                </div>
                            </div>
                        </li>
                    </ul>
                 </li>
                <li class="dropdown megamenu-fw suvb studioNav">
                 	<a href="#" class="dropdown-toggle" data-toggle="dropdown">studio</a>
                    <ul class="dropdown-menu megamenu-content" role="menu">
                    	<li>
                            <div class="row">
                                    <div class="col-menu col-md-4 col-xs-12 nav-offerImage offer_image">
                                    <!--<img src="<?= $https_url ?>site/images/header/nav_studio_1.jpg" class="img-responsive" alt="shop" >-->
                                        <a href="<?php echo $bas_ul;?>trial-shirt"><img src="<?= $https_url ?>site/images/header/first-shirt.jpg" class="img-responsive" alt="shop" ></a>
                                    </div>
                                    <div class="col-menu col-md-4 col-xs-12 studio-customize">
										<h5 class="title">customise your wardrobe</h5>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="<?php echo $bas_ul;?>custom-shirt">Shirts</a></li>
                                                <li><a href="<?php echo $bas_ul;?>custom-suit">suits</a></li>
                                                <li><a href="<?php echo $bas_ul;?>custom-blazer">blazers</a></li>
                                                <li><a href="<?php echo $bas_ul;?>custom-trouser">trousers</a></li>
                                                <li><a href="<?php echo $bas_ul;?>custom-vest">vests</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-4 col-xs-12 nav-offerImage offer_image">
                                    <img src="<?= $https_url ?>site/images/header/nav_studio_2.jpg" class="img-responsive" alt="shop">
                                    </div>
                            </div>
                        </li>
                    </ul>
                </li>
            	<li><a href="<?php echo $bas_ul;?>book-a-home-visit">BOOK A HOME VISIT</a></li>
                <li><a href="<?php echo $bas_ul;?>wedding-suit">WEDDING</a></li>
                <li><a href="#">STORE</a></li>
                <li><a href="http://www.blog.stylior.com" target="_blank">BLOG</a></li>
                <li class="dropdown megamenu-fw moreMenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">MORE</a>
                    <ul class="dropdown-menu megamenu-content" role="menu">
                    	<li ><a href="<?php echo $bas_ul;?>how-it-works">HOW IT WORKS</a></li>
                   		<li><a href="https://www.stylior.com/fit-guide">FIT GUIDE</a></li>
	  					<li><a href="https://www.stylior.com/fabric-guide">FABRIC GUIDE</a></li>
	  					<li><a href="https://www.stylior.com/faq">FAQ</a></li>
	  					<li><a href="https://www.stylior.com/why-custom">WHY CUSTOM</a></li>
                    </ul>
   
                </li>
				<?php if($this->session->userdata('user_id')){  ?>
                <li class="visible-xs"><a  href="<?= $bas_ul ?>hauth/logout">Logout</i></a></li>
                <?php } ?>
            
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>   
</nav>
    <!-- End Navigation -->

    <div class="clearfix"></div>

</header>
<!-- end header -->


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
