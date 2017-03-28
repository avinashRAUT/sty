
<?php
//print_r($_SESSION['user_id']);

if ($_SERVER['HTTPS'] == "on")
{
	$https_url="https://www.stylior.com/stylior/";
	$bas_ul = "https://www.stylior.com/";
	$https_url_large_img="https://www.stylior.com/stylior/upload/products1/";
	$image_url = "https://www.stylior.com/stylior/site/";
}
else {
	$bas_ul = "http://www.stylior.com/";
	$https_url="http://www.stylior.com/";
	$https_url_large_img="http://www.stylior.com/upload/products1/";
	$image_url = "http://www.stylior.com/stylior/site/";
}
session_start();
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
    $ip = $_SERVER<div class="button-options" id="trouser_button_options" style="display: none">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="AC1FD311">
				<a class="changeOption" href="#" data="STBBLACK" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/black.png">
					</a>
				<div class="option-info">
					<h4>BLACK</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="E4D8E807">
				<a class="changeOption" href="#" data="STBBROWN" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/brown.png">
				</a>
				<div class="option-info">
					<h4>BROWN </h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="B697A8D2">
				<a class="changeOption" href="#" data="STBGRAY" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/gray.png">
				</a>
				<div class="option-info">
					<h4>GREY</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="B83C5994">
				<a class="changeOption" href="#" data="STBNAVY" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/navy.png">
				</a>
				<div class="option-info">
					<h4>NAVY</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="16770C30">
				<a class="changeOption" href="#" data="STBWHITE" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/white.png">
				</a>
				<div class="option-info">
					<h4>WHITE</h4>
				</div>
		</div>
	</div>
</div>['HTTP_X_FORWARDED_FOR'];
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
?>

<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="UTF-8">
	<title>Custom Suit|Stylior</title>
	<link rel="shortcut icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="32x32" />
	<!--  non-retina iPhone pre iOS 7 -->
	<link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="57x57" />
	<!--  non-retina iPad iOS 7 -->
	<link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="76x76" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/bootstrap.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/swiper.min.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>/site/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>/site/css/ionicons.min.css">
	<link rel="stylesheet" href="https://www.stylior.com/stylior/site/css/remodal.css">
	<link rel="stylesheet" href="https://www.stylior.com/stylior/site/css/remodal-default-theme.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/3d_page_css.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/3d-suit.css">
    
    


</head>
<body>
<!-- Header Section Here -->
<!-- Content Section -->
<!-- start container-fluid Section -->
<div class="col-sm-12 col-xs-12 visible-xs visible-sm">
<div class="stylior-logo-mobile">
	<a href="https://www.stylior.com/">
		<img class="img-responsive"  src="https://www.stylior.com/stylior/site/images/relaunch/logo.png" alt="">
	</a>
</div>
</div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left-panel design-left-panel hidden-xs hidden-sm">
        <div class="desing-cloth-leftpanel">
            <div class="navs-list ">
                <ul class="main-options">
                    <li class="left-panel-option fabric_icon active">
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_fabric_icon">
                                <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_fabric">
                                <h4>Fabric</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option jacket_style_icon"  >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_jacket_style_icon">
                <img src="<?= $image_url ?>upload/suit/jacket-style/single_button_active.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_jacket_style">
                                <h4>Jacket Style</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option lapel_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_lapel_icon">
        
                        <img  src="<?= $image_url; ?>upload/suit/lapel/notch_active.png">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_lapel">
                                <h4>Lapel</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option jacket_button_icon"  >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_jacket_button_icon">
                                <img src="<?= $image_url; ?>upload/suit/jacket_button/black_button.png" alt="">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_jacket_button">
                                <h4>Jacket Button</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option vents_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_vents_icon" >
                                <img src="<?= $image_url; ?>upload/suit/vents/single_vent_active.png" alt="">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_vents">
                                <h4>Vents</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option pocket_icon">
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_suit_pocket_icon">
                                <img src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_active.png" alt="">
        
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_suit_pocket">
                                <h4>Suit pocket</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option chest_pocket_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_chest_pocket_icon">
                                <img src="<?= $image_url ?>upload/suit/chest_pocket/chest_standard_pocket_active.png" alt="">
        
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_chest_pocket">
                                <h4>Chest pocket</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option lapel_button_hole_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_lapel_button_hole_icon">
                                <img  src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_active.png">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_lapel_button_hole">
                                <h4>Lapel Button Hole</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
        <!--
        .... we are hidding this for temporary will enable this feature for store....
        ....
        -->
        
                <!-- 	<li class="left-panel-option cuff_accent_stitching_icon" >
                        <div class="row">
                            <div class="col-md-6 left-panel-icon" id="selected_cuff_accent_stitching_icon">
                                <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
                            </div>
                            <div class="col-md-6 left-panel-icon-info" id="selected_cuff_accent_stitching">
                                <h4>Cuff Accent Stitching</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
        -->
                    <li class="left-panel-option cuff_button_style_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_cuff_button_style_icon">
                                <img  src="<?= $image_url; ?>upload/suit/cuff_button_style/show_button_active.png">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_cuff_button_style">
                                <h4>Cuff Button Style</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option pleat_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_pleat_icon">
                                <img src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_pleat">
                                <h4>Pleat</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option cuffs_icon"  >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_cuff_icon">
                                <img src="<?= $image_url; ?>upload/trouser/cuffs/no_cuff_active.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_cuff">
                                <h4>Trouser Cuffs</h4>
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option pocket_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_pocket_icon" >
                                <img src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_pocket">
                                <h4>Trouser Pocket</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option belt_icon">
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_belt_icon">
                                <img src="<?= $image_url; ?>upload/trouser/belt/belt_loop_active.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_belt">
                                <h4>Belt</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option button_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_button_icon">
                                <img src="<?= $image_url ?>upload/trouser/buttons/gray.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_button">
                                <h4>Trouser Button</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                    <li class="left-panel-option selected_inner_lining_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_inner_lining_icon">
                                <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
                            </div>
                            <div  class="col-md-8 left-panel-icon-info changeLining" id="changeLining selected_inner_lining">
                                <h4>Inner Lining</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                 <!--    <li class="left-panel-option selected_tie_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_tie_icon">
                                <img  src="<?= $image_url; ?>upload/suit/tie/tie.png" alt="tie image">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_tie">
                                <h4>Tie</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
         -->
                    <li class="left-panel-option selected_vest_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_vest_icon">
                                <img src="<?= $image_url ?>upload/suit/vest/vest_default.png" alt="">
        
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_vest">
                                <h4>Vest</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
        
                    <li class="left-panel-option selected_suspender_button_icon" >
                        <div class="row">
                            <div class="col-md-4 left-panel-icon" id="selected_suspender_button_icon">
        
                            <img  src="<?= $image_url; ?>upload/suit/suspender/no_suspender_active.png" alt="suspender_button">
                            </div>
                            <div class="col-md-8 left-panel-icon-info" id="selected_suspender_button">
                                <h4>Suspender Button</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
        
                </ul>
            </div>
        </div>
    </div>
	<div class="col-sm-12 col-xs-12 left-panel visible-xs visible-sm virtual-mobile-view">
		<ul class="main-options">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"   >
                        <li class="left-panel-option fabric_icon"  >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_fabric_icon_mobile">
                                    <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
                                </div>
                                <div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_fabric">
                                    <h4>Fabric</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option jacket_style_icon"  >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_jacket_style_icon_mobile">
                                    <img src="<?= $image_url ?>upload/suit/jacket-style/single_button_active.png" alt="">
        
                                </div>
                                <div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_jacket_style">
                                    <h4>Jacket Style</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide"  >
                        <li class="left-panel-option lapel_icon" >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_lapel_icon_mobile">
                                    <img  src="<?= $image_url; ?>upload/suit/lapel/notch_active.png">
                                </div>
                                <div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_lapel">
                                    <h4>Lapel</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide"  >
                        <li class="left-panel-option jacket_button_icon"  >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_jacket_button_icon_mobile">
                                <img src="<?= $image_url; ?>upload/suit/jacket_button/black_button.png" alt="">
                                </div>
                                <div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_jacket_button">
                                    <h4>Jacket Button</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide">
                        <li class="left-panel-option vents_icon" >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_vents_icon_mobile" >
                                            <img src="<?= $image_url; ?>upload/suit/vents/single_vent_active.png" alt="">
                                </div>
                                <div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_vents">
                                    <h4>Vents</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option pocket_icon">
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_suit_pocket_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_suit_pocket">
                                    <h4>Suit pocket</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                    <li class="left-panel-option chest_pocket_icon" >
                        <div class="row">
                            <div class="col-md-6 left-panel-icon" id="selected_chest_pocket_icon_mobile">
                                <img src="<?= $image_url ?>upload/suit/chest_pocket/chest_standard_pocket_active.png" alt="">
                            </div>
                            <div class="col-md-6 left-panel-icon-info" id="selected_chest_pocket">
                                <h4>Chest pocket</h4>
                                <span> </span>
                            </div>
                        </div>
                    </li>
                </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option lapel_button_hole_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_lapel_button_hole_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_lapel_button_hole">
                                    <h4>Lapel Button Hole</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option cuff_button_style_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_cuff_button_style_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/suit/cuff_button_style/show_button_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_cuff_button_style">
                                    <h4>Cuff Button Style</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option pleat_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_pleat_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_pleat">
                                    <h4>Trouser Pleat</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option cuffs_icon"  >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_cuff_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/trouser/cuffs/cuff_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_cuff">
                                    <h4>Trouser Cuffs</h4>
                                    <span></span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option pocket_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_pocket_icon_mobile" >
                                    <img src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_pocket">
                                    <h4>Pocket</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option belt_icon">
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_belt_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/trouser/belt/belt_loop_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_belt">
                                    <h4>Belt</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option button_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_button_icon_mobile">
                                    <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_button">
                                    <h4>Trouser Button</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
                        <li class="left-panel-option selected_inner_lining_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_inner_lining_icon_mobile">
                                    <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_inner_lining">
                                    <h4>Inner Lining</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                  <!--   <div class="swiper-slide" >
                        <li class="left-panel-option selected_tie_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_tie_icon_mobile">
                                    <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_tie">
                                    <h4>Tie</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
            </div> -->
                    <div class="swiper-slide" >
                        <li class="left-panel-option selected_vest_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_vest_icon_mobile">
                                    <img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_vest">
                                    <h4>Vest</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="swiper-slide" >
            
                        <li class="left-panel-option selected_suspender_button_icon" >
                            <div class="row">
                                <div class="col-md-6 left-panel-icon" id="selected_suspender_button_icon_mobile">
                                    <img src="<?= $image_url; ?>upload/suit/suspender/no_suspender_active.png" alt="">
                                </div>
                                <div class="col-md-6 left-panel-icon-info" id="selected_suspender_button">
                                    <h4>Suspender Button</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </li>
            </div>
            
                </div>
            <!-- Add Pagination -->
            <!--<div class="swiper-pagination"></div>-->
            <div class="swiper-scrollbar"></div>
            </div>
		</ul>
	</div>
 <!-- main option panel end -->
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12  nopadding ">
    	<div class="option-select">
            <div class="filter-options" id="filter_options" >
                <div class="" >
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">
                        <div class="dropdown">
                            <div class="dropbtn">Color</div>
                            <div class="dropdown-content">
                            <ul class="color_select_list"  style="list-style: none;">
                                <?php
                                // echo "fabric colors comming here";
                                // print_r($fabric_colors);
                            
								foreach($fabric_colors as $value) {
                                    echo '<li value="'.$value->id.'" id="color_'.$value->id .'" ><a href="javascript:filterData(`color`,`'.$value->id.'`);">'.$value->colourname.'</a></li>';
                                } 
								?>
                
                            </ul>
                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">
                        <div class="dropdown">
                            <div class="dropbtn">Pattern</div>
                            <div class="dropdown-content">
                            <ul class="pattern_select_list"  style="list-style: none;">
                            <?php
                            foreach($fabric_patterns as $value){
                                    echo '<li id="pattern_'.$value->id .'" value="'.$value->id.'"><a href="javascript:filterData(`pattern`,`'.$value->id.'`);">'.$value->designname.'</a></li>';
                            }
                            ?>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">
                        <div class="dropdown">
                            <div class="dropbtn">Price</div>
                            <div class="dropdown-content">
                                <ul  class="price_range_select" style="list-style: none;">
                                    <li><a href="javascript:filterData('range','ASC');">Low-to-High<!--<option value="ASC">Low-to-High</option>--></a></li>
                                    <li><a href="javascript:filterData('range','DESC');">High-to-Low<!--<option value="DESC">High-to-Low</option>--></a></li>
                                </ul>
                
                            </div>
                        </div>
                
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" id="clear_class">
                    <div class="clear_class">
                            <a  title="Reset filters" class="clear" href="javascript:filterData('clear',this);">Reset Filters</a>
                    </div>
                </div>
        
            </div><!-- end  of filter-option -->
        
            <div class="fabric-options right-options" id="fabric_options" >
                    <?php
                    $i = 0;
                    // echo "This is tersting";
                    //print_r($fabric);
                    //foreach($fabric as $fabric_options)
                    
                    foreach($fabric as $key => $value) {
                        //	print_r($value);
                     $product_id=$value[0]->id;
                     $image=$value[0]->image;
                     $texto_key=$key;
                     $custom_key=$value[0]->custom_key;
                     $product_name=$value[0]->name;
                    
                     $price=$value[0]->price;
                     if($this->session->userdata('currencycode')=="" ||$this->session->userdata('currencycode') == 'INR')
                     {
                             //echo "INR ".$cmsf->price;
                             $price=$value[0]->INR;
                     }
                     else if($this->session->userdata('currencycode') == 'USD')
                     {
                             //echo "USD ".$cmsf->USD;
                             $price=$value[0]->USD;
                     }
                     else if($this->session->userdata('currencycode') == 'BHD')
                     {
                             //echo "BHD ".$cmsf->BHD;
                             $price=$value[0]->BHD;
                     }
                     else if($this->session->userdata('currencycode') == 'SAR')
                     {
                             //echo "SAR ".$cmsf->SAR;
                             $price=$value[0]->SAR;
                     }
                     else if($this->session->userdata('currencycode') == 'QAR')
                     {
                             //echo "QAR ".$cmsf->QAR;
                             $price=$value[0]->QAR;
                     }
                     else if($this->session->userdata('currencycode') == 'EUR')
                     {
                             //echo "EUR ".$cmsf->EUR;
                             $price=$value[0]->EUR;
                     }
                     else if($this->session->userdata('currencycode') == 'AED')
                     {
                             //echo "AED ".$cmsf->AED;
                             $price=$value[0]->AED;
                     }
                     else if($this->session->userdata('currencycode') == 'AUD')
                     {
                             //echo "AUD ".$cmsf->AUD;
                             $price=$value[0]->AUD;
                     }
                     else
                     {
                       //echo $this->session->userdata('currencycode')."";
                    
                      //echo ceil(( $image['result'][$i]->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
                     }
                     if($i==0)
                     {
                         $default_price = $price ;
                     }
                    
                     $threadCount=$value[0]->threadcount;
                     $fabric_color=$value[0]->colour;
                     $fabric_pattern=$value[0]->designid;
                      ?>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 displayfitler" data-color="<?= $fabric_color; ?>" data-pattern="<?= $fabric_pattern; ?>" data-price="<?= $price; ?>">
                    <div class="fabric-details" id="<?= $custom_key;?>" >
                        <a  class="swatchchangeOption" href="#" data-part="<?= $key;?>" data-key="<?= $custom_key;?>">
                            <img class="img-responsive" src="<?= $image_url."".$image;?>">
                    
                                <div class="option-info">
                                <h4 class="product-title-<?= $key; ?>" ><?= $product_name;?></h4>
                                <span class="product-price-<?= $key; ?>" ><?= $this->session->userdata('currencycode') .' '.$price;?></span>
                                <button class="fabric_swatch hidden-xs hidden-sm" data-image="<?= $image_url."".$image;?>" type="button"  data-toggle="modal" data-target="#suitFabric">
                                    <i class="fa fa-search-plus fa-lg"></i>
                                </button>
                            </a>
                                <div style="display:none;">
                                    <span class="product-color-<?= $key; ?>" > <?= $fabric_color;?></span>
                                    <span class="product-pattern-<?= $key; ?>" > <?= $fabric_pattern;?></span>
                                    <span class="product-threadcount-<?= $key; ?>" > <?= $threadCount;?></span>
                                <span class="product-id-<?= $key; ?>" > <?= $product_id;?></span>
                    
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php $i++;} ?>
                </div>
        
            <div class="jacket-style-options right-options" id="jacket_style_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
                    <div class="jacket-style-details" id="ONEBTN">
                            <a class="changeOption" href="#" data="1BTN" data-key="jacket_style">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/jacket-style/single_button_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/jacket-style/single_button_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>SINGLE BUTTON</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-style-details" id="TWOBTN">
                            <a class="changeOption" href="#" data="2BTN" data-key="jacket_style">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/jacket-style/two_button_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/jacket-style/two_button_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>2 BUTTON</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-style-details" id="THREEBTN">
                            <a class="changeOption" href="#" data="3BTN" data-key="jacket_style">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/jacket-style/three_button_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/jacket-style/three_button_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>3 BUTTON</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-style-details" id="FOURBTNDB">
                            <a class="changeOption" href="#" data="4BTNDB" data-key="jacket_style">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/jacket-style/four_button_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/jacket-style/four_button_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>4 BUTTON DOUBLE BREASTED</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-style-details" id="SIXBTNDB">
                            <a class="changeOption" href="#" data="6BTNDB" data-key="jacket_style">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/jacket-style/six_button_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/jacket-style/six_button_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>6 BUTTON DOUBLE BREASTED</h4>
                            </div>
                        </a>
                    </div>
                </div>
        
            </div>
            <!--Lapel Option Start -->
        
            <div class="lapel-options right-options" id="lapel_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-details" id="NOTCH">
                            <a class="changeOption" href="#" data="NOTCH" data-key="lapel">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/lapel/notch_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/lapel/notch_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>NOTCH</h4>
                            </div>
                            </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-details" id="PEAK">
                            <a class="changeOption" href="#" data="PEAK" data-key="lapel">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/lapel/peak_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/lapel/peak_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>PEAK</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-details" id="SHAWL">
                            <a class="changeOption" href="#" data="SHAWL" data-key="lapel">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/lapel/shawl_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/lapel/shawl_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>SHAWL</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!--jacket button Option Start -->
        
            <div class="jacket-button-options right-options" id="jacket_button_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-button-details" id="JBLACK">
                            <a class="changeOption" href="#" data="JBLACK" data-key="jacket_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload//suit/jacket_button/black_button.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload//suit/jacket_button/black_button.png" style="display:none;">
        
                            <div class="option-info">
                                <h4>BLACK</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-button-details" id="JBROWN">
                            <a class="changeOption" href="#" data="JBROWN" data-key="jacket_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload//suit/jacket_button/cream_button.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload//suit/jacket_button/cream_button.png" style="display:none;">
                            <div class="option-info">
                                <h4>BROWN</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-button-details" id="JGREY">
                            <a class="changeOption" href="#" data="JGREY" data-key="jacket_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload//suit/jacket_button/gray_button.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload//suit/jacket_button/gray_button.png" style="display:none;">
        
                                <div class="option-info">
                                <h4>GREY</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="jacket-button-details" id="JNAVY">
                            <a class="changeOption" href="#" data="JNAVY" data-key="jacket_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload//suit/jacket_button/navy_button.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload//suit/jacket_button/navy_button.png" style="display:none;">
        
                            <div class="option-info">
                                <h4>NAVY</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="jacket-button-details" id="JWHITE">
                            <a class="changeOption" href="#" data="JWHITE" data-key="jacket_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload//suit/jacket_button/white_button.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload//suit/jacket_button/white_button.png" style="display:none;">
                            <div class="option-info">
                                <h4>WHITE</h4>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        
            <!--Vents Option Start -->
        
            <div class="vents-options right-options" id="vents_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="vents-details" id="SINGLEVENT">
                            <a class="changeOption" href="#" data="SINGLEVENT" data-key="vents">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/vents/single_vent_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/vents/single_vent_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>SINGLE VENT</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="vents-details" id="DOUBLEVENT">
                            <a class="changeOption" href="#" data="DOUBLEVENT" data-key="vents">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/vents/double_vent_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/vents/double_vent_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>DOUBLE VENT</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="vents-details" id="NOVENT">
                            <a class="changeOption" href="#" data="NOVENT" data-key="vents">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/vents/no_vent_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/vents/no_vent_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>NO VENT</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        
            <!--Suit Pocket Option Start -->
        
            <div class="suit-pocket-options right-options" id="suit_pocket_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suit-pocket-details" id="STRAIGHTPOCKET">
                            <a class="changeOption" href="#" data="STRAIGHTPOCKET" data-key="suit_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>STRAIGHT POCKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suit-pocket-details" id="STRAIGHTTICKET">
                            <a class="changeOption" href="#" data="STRAIGHTTICKET" data-key="suit_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_with_ticket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suit_pocket/straight_pocket_with_ticket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>STRAIGHT POCKET WITH TICKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suit-pocket-details" id="STDPOCKET">
                            <a class="changeOption" href="#" data="STDPOCKET" data-key="suit_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suit_pocket/standared_pocket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suit_pocket/standared_pocket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>STANDARD POCKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suit-pocket-details" id="STDTICKET">
                            <a class="changeOption" href="#" data="STDTICKET" data-key="suit_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suit_pocket/standared_pocket_with_ticket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suit_pocket/standared_pocket_with_ticket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>STANDARD POCKET WITH TICKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suit-pocket-details" id="PATCH">
                            <a class="changeOption" href="#" data="PATCH" data-key="suit_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suit_pocket/patch_pocket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suit_pocket/patch_pocket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>PATCH POCKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
        
            </div>
        
            <!--Chest Pocket Option Start -->
            <div class="chest-pocket-options right-options" id="chest_pocket_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="chest-pocket-details" id="CHESTPATCH">
                            <a class="changeOption" href="#" data="CHESTPATCH" data-key="chest_pocket">
                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/chest_pocket/chest_patch_pocket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/chest_pocket/chest_patch_pocket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>PATCH POCKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="chest-pocket-details" id="CHESTSTD">
                            <a class="changeOption" href="#" data="CHESTSTD" data-key="chest_pocket">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/chest_pocket/chest_standard_pocket_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/chest_pocket/chest_standard_pocket_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>STANDARD POCKET</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        
            <!--Lapel button hole Option Start -->
        
            <div class="lapel-button-hole-options right-options" id="lapel_button_hole_options" style="display: none">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                        <div class="lapel-button-hole-details" id="LBLACK">
                                <a class="changeOption" href="#" data="LBLACK" data-key="lapel_button_hole">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_black_active.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_black_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>BLACK</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                        <div class="lapel-button-hole-details" id="LBROWN">
                                <a class="changeOption" href="#" data="LBROWN" data-key="lapel_button_hole">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>BROWN</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                        <div class="lapel-button-hole-details" id="LGREY">
                                <a class="changeOption" href="#" data="LGREY" data-key="lapel_button_hole">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_active.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>GREY</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                        <div class="lapel-button-hole-details" id="LNAVY">
                                <a class="changeOption" href="#" data="LNAVY" data-key="lapel_button_hole">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_navy_active.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_navy_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>NAVY</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                        <div class="lapel-button-hole-details" id="LWHITE">
                                <a class="changeOption" href="#" data="LWHITE" data-key="lapel_button_hole">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>WHITE</h4>
                                </div>
                            </a>
                        </div>
                    </div>
        
        <!-- 		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-button-hole-details" id="LBLACK">
                            <a class="changeOption" href="#" data="LBLACK" data-key="lapel_button_hole">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>BLACK</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-button-hole-details" id="LBROWN">
                            <a class="changeOption" href="#" data="LBROWN" data-key="lapel_button_hole">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>BROWN</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-button-hole-details" id="LGREY">
                            <a class="changeOption" href="#" data="LGREY" data-key="lapel_button_hole">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>GREY</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-button-hole-details" id="LNAVY">
                            <a class="changeOption" href="#" data="LNAVY" data-key="lapel_button_hole">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>NAVY</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="lapel-button-hole-details" id="LWHITE">
                            <a class="changeOption" href="#" data="LWHITE" data-key="lapel_button_hole">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>WHITE</h4>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        
                <!--cuff accent stitching Option Start -->
            <div class="cuff-accent-stitching-options right-options" id="cuff_accent_stitching_options" style="display: none">
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-accent-stitching-details" id="CABLACK">
                                <a class="changeOption" href="#" data="CABLACK" data-key="cuff_accent_stitching">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_black_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_black_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>BLACK</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-accent-stitching-details" id="CABROWN">
                                <a class="changeOption" href="#" data="CABROWN" data-key="cuff_accent_stitching">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>BROWN</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-accent-stitching-details" id="CAGREY">
                                <a class="changeOption" href="#" data="CAGREY" data-key="cuff_accent_stitching">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_gray_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>GREY</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-accent-stitching-details" id="CANAVY">
                                <a class="changeOption" href="#" data="CANAVY" data-key="cuff_accent_stitching">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_navy_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_navy_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>NAVY</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-accent-stitching-details" id="CAWHITE">
                                <a class="changeOption" href="#" data="CAWHITE" data-key="cuff_accent_stitching">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_accent_stitch/accent_stitch_white_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>WHITE</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
        
                <!--cuff accent stitching Option Start -->
            <div class="cuff-button-style-options right-options" id="cuff_button_style_options" style="display: none">
        
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
                    <div class="cuff-button-style-details" id="CF7EA093">
                        <a class="changeOption" href="#" data="CS" data-key="cuff_button_style">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_button_style/show_button_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_button_style/show_button_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
                    </a>
                    </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="cuff-button-style-details" id="7470C5AE">
                                <a class="changeOption" href="#" data="CK" data-key="cuff_button_style">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/cuff_button_style/kissing_button_default.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/cuff_button_style/kissing_button_active.png" style="display:none;">
                                <div class="option-info">
                                    <h4>KISSING BUTTON</h4>
                                </div>
                            </a>
                        </div>
                    </div>
        <!-- start new butto0ns -->
        
        
        
                <!-- 	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
                    <div class="cuff-button-style-details" id="CF7EA093">
                        <a class="changeOption" href="#" data="CF7EA093" data-key="cuff_button_style">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
                    </a>
                    </div>
                    </div>
        
        
        
        
        
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CKBLACK">
        
        
                        <a class="changeOption" href="#" data="CKBLACK" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        </div>
        </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CKBROWN">
        
        
        
        
        
                        <a class="changeOption" href="#" data="CKBROWN" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        
        
        </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CSBROWN">
        
        
        
                        <a class="changeOption" href="#" data="CSBROWN" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        </div>
        </div>
        
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CKGREY">
        
        
        
        
        
                        <a class="changeOption" href="#" data="CKGREY" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        
        </div>
        </div>
        
        
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CSGREY">
        
        
        
        
                        <a class="changeOption" href="#" data="CSGREY" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CKNAVY">
        
        
        
        
                        <a class="changeOption" href="#" data="CKNAVY" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        
        
        </div>
        </div>
        
        
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CSNAVY">
        
        
        
        
        
        
                        <a class="changeOption" href="#" data="CSNAVY" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        
        </div>
        </div>
        
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
        <div class="cuff-button-style-details" id="CSWHITE">
        
        
                        <a class="changeOption" href="#" data="CSWHITE" data-key="cuff_button_style">
                <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        <div class="option-info">
                            <h4>SHOW BUTTON</h4>
                        </div>
        
                        </a>
        
        
        
        
        </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
        
            <div class="cuff-button-style-details" id="CKWHITE">
        
                            <a class="changeOption" href="#" data="CKWHITE" data-key="cuff_button_style">
                    <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                            <div class="option-info">
                                <h4>SHOW BUTTON</h4>
                            </div>
        
                            </a>
        
            </div>
         -->
        
        
        
        <!-- end new buttns -->
        
        
        
        
        
                </div>
        
                <!--cuff accent stitching Option Start -->
        
            <div class="inner-lining-options right-options" id="inner_lining_options" style="display: none">
        
        
        
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6" >
                    <a class="subfabric" href="#" data-part="1A9AFF93" data-key="03800311-07">
                        <img class="img-responsive" src="https://www.stylior.com/stylior/site/upload/fabric_swatch/SGG175031002.jpg">
        
                    </a>
                    <div class="option-info">
                        <h4>Black</h4>
                    </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6" >
                    <a class="subfabric" href="#" data-part="479D1E2F" data-key="03900016">
                        <img class="img-responsive" src="https://www.stylior.com/stylior/site//upload/fabric_swatch/SGG170239202.jpg">
        
                    </a>
                    <div class="option-info">
                        <h4>Blue</h4>
                    </div>
                    </div>
        
        
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
                    <a class="subfabric" href="#" data-part="ED543432" data-key="04700032-67">
                        <img class="img-responsive" src="https://www.stylior.com/stylior/site/upload/fabric_swatch/SGG17003252.jpg">
        
                    </a>
                    <div class="option-info">
                        <h4>Grey</h4>
                    </div>
                    </div>
        
        <!--
                <ul >
                    <li class="list-group-item"><a class="subfabric" href="#" data-part="1A9AFF93" data-key="03800311-07">03800311-07-1A9AFF93</a></li>
                    <li class="list-group-item"><a class="subfabric" href="#" data-part="479D1E2F" data-key="03900016">03900016-479D1E2F</a></li>
                    <li class="list-group-item"><a class="subfabric" href="#" data-part="AD822A6F" data-key="04700032-052">04700032-052-AD822A6F</a></li>
                    <li class="list-group-item"><a class="subfabric" href="#" data-part="69147CD4" data-key="04700032-63">04700032-63-69147CD4</a></li>
                    <li class="list-group-item"><a class="subfabric" href="#" data-part="ED543432" data-key="04700032-67">04700032-67-ED543432</a>
                    </li>
                </ul>
         -->
        
                    <!-- <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE01">
                                <a class="changeOption" href="#" data="SHADE01" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-01.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-01.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 1</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE02">
                                <a class="changeOption" href="#" data="SHADE02" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-02.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-02.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 2</h4>
                                </div>
                            </a>
                        </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE03">
                                <a class="changeOption" href="#" data="SHADE03" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-03.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-03.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 3</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE04">
                                <a class="changeOption" href="#" data="SHADE04" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-04.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-04.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 4</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE05">
                                <a class="changeOption" href="#" data="SHADE05" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-05.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-05.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 5</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE06">
                                <a class="changeOption" href="#" data="SHADE06" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-06.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-06.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 6</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE07">
                                <a class="changeOption" href="#" data="SHADE07" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-07.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-07.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 7</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE08">
                                <a class="changeOption" href="#" data="SHADE08" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-08.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-08.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 8</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE09">
                                <a class="changeOption" href="#" data="SHADE09" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-09.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-09.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 09</h4>
                                </div>
                            </a>
                        </div>
                    </div><div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE10">
                                <a class="changeOption" href="#" data="SHADE10" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-10.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-10.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 10</h4>
                                </div>
                            </a>
                        </div>
                    </div><div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE11">
                                <a class="changeOption" href="#" data="SHADE11" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-11.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-11.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 11</h4>
                                </div>
                            </a>
                        </div>
                    </div><div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="inner-lining-details" id="SHADE12">
                                <a class="changeOption" href="#" data="SHADE12" data-key="inner_lining">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/shade-12.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/shade-12.png" style="display:none;">
                                <div class="option-info">
                                    <h4>Shade 12</h4>
                                </div>
                            </a>
                        </div>
                    </div>
         -->
        
        
                </div>
                <!--Tie Option Start -->
        
        
            <!-- <div class="tie-options right-options" id="tie_options" style="display: none">
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="tie-details" id="BTIE">
                                <a class="changeOption" href="#" data="BTIE" data-key="tie">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/tie/tie.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/tie/tie.png" style="display:none;">
                                </a>
                                <div class="option-info">
                                    <h4>YES</h4>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="tie-details" id="NOTIE">
                                <a class="changeOption" href="#" data="NOTIE" data-key="tie">
                                    <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/tie/notie.png">
                                    <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/tie/notie.png" style="display:none;">
                                </a>
                                <div class="option-info">
                                    <h4>NO</h4>
                                </div>
                        </div>
                    </div>
                </div>
             -->   
              <!--Pleats Option Start -->
                <!--Vest Option Start -->
                <!-- vest/vest_active.png
                vest/vest_default.png -->
        
            <div class="vest-options right-options" id="vest_options" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                <div class="vest-details" id="NOCOAT">
                        <a class="changeOption" href="#" data="NOCOAT" data-key="vest coat">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/vest/vest_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/vest/vest_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>NO</h4>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                <div class="vest-details" id="VESTCOAT">
                        <a class="changeOption" href="#" data="VESTCOAT" data-key="vest coat">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/vest/vest_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/vest/vest_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>YES</h4>
                        </div>
                </div>
            </div>
        </div>
        
            <div class="suspender-button-options right-options" id="suspender_button_options" style="display: none">
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suspender-button-details" id="SSBUTTONNO">
                            <a class="changeOption" href="#" data="SSBUTTONNO" data-key="suspender_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suspender/no_suspender_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suspender/no_suspender_active.png" style="display:none;">
                            </a>
                            <div class="option-info">
                                <h4>NO</h4>
                            </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                    <div class="suspender-button-details" id="SSBUTTON">
                            <a class="changeOption" href="#" data="SSBUTTON" data-key="suspender_button">
                                <img class="img-responsive default" src="<?= $image_url; ?>upload/suit/suspender/suspender_default.png">
                                <img class="img-responsive active" src="<?= $image_url; ?>upload/suit/suspender/suspender_active.png" style="display:none;">
                            </a>
                            <div class="option-info">
                                <h4>YES</h4>
                            </div>
                    </div>
                </div>
            </div>
        
        
            <div class="pleat-options right-options" id="pleat_options" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pleats-details" id="SNOPLEAT">
                        <a class="changeOption" href="#" data="SNOPLEAT" data-key="pleats">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>NO PLEATS</h4>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pleats-details" id="SSPLEAT">
                        <a class="changeOption" href="#" data="SSPLEAT" data-key="pleats">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>SINGLE PLEAT</h4>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pleats-details" id="SDPLEAT">
                        <a class="changeOption" href="#" data="SDPLEAT" data-key="pleats">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/double_pleat_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/double_pleat_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>DOUBLE PLEAT</h4>
                        </div>
                </div>
            </div>
        </div>
        
            <!-- bottom cuffs start -->
            <div class="cuffs-options right-options" id="trouser_cuffs_options" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
                <div class="cuffs-details" id="BCYES">
                        <a class="changeOption" href="#" data="BCYES" data-key="bottom_cuff">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/cuffs/cuff_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/cuffs/cuff_active.png" style="display:none">
                        </a>
                        <div class="option-info">
                            <h4>YES</h4>
                        </div>
                </div>
            </div>
        
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
                <div class="cuffs-details" id="BCNO">
                        <a class="changeOption" href="#" data="BCNO" data-key="bottom_cuff">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/cuffs/no_cuff_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/cuffs/no_cuff_active.png" style="display:none">
        </a>
                        <div class="option-info">
                            <h4>NO</h4>
                        </div>
                </div>
            </div>
        </div>
        
            <!-- back pocket -->
            <div class="pocket-options right-options" id="trouser_pocket_options" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pocket-details" id="BPNO">
                        <a class="changeOption" href="#" data="BPNO" data-key="back_pocket">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" style="display:none;">
        </a>
                        <div class="option-info">
                            <h4>NONE</h4>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pocket-details" id="BPSINGLE">
                        <a class="changeOption" href="#" data="BPSINGLE" data-key="back_pocket">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" style="display:none;">
        </a>
                        <div class="option-info">
                            <h4>SINGLE POCKET</h4>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="pocket-details" id="BPDOUBLE">
                        <a class="changeOption" href="#" data="BPDOUBLE" data-key="back_pocket">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pocket/Back_double_pocket_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pocket/Back_double_pocket_active.png" style="display:none;">
                        </a>
                        <div class="option-info">
                            <h4>DOUBLE POCKET</h4>
                        </div>
                </div>
            </div>
        
        </div>
        
            <!-- Belt Loop -->
        
            <div class="belt-options right-options" id="belt_options" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
                <div class="belt-details" id="SWITHLOOP">
                        <a class="changeOption" href="#" data="SWITHLOOP" data-key="Belt">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/belt_loop_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/belt_loop_active.png" style="display:none;">
                            </a>
                        <div class="option-info">
                            <h4>SIDE TAB WITH LOOP</h4>
                        </div>
                </div>
            </div>
        
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
                <div class="belt-details" id="SWTHOUTLPST">
                        <a class="changeOption" href="#" data="SWTHOUTLPST" data-key="Belt">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/belt_no_loop_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/belt_no_loop_active.png" style="display:none">
                    </a>
                        <div class="option-info">
                            <h4>SIDE TAB WITHOUT LOOP</h4>
                        </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="belt-details" id="CF0D1B75">
                        <a class="changeOption" href="#" data="CF0D1B75" data-key="Belt">
                            <img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/side_tab_default.png">
                            <img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/side_tab_active.png" style="display:none;">
        
                        <div class="option-info">
                            <h4>WITH SIDETAB</h4>
                        </div>
                </div>
            </div>
         -->
        </div>
        
            <!-- Button Options -->
		</div>
	</div>



	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">


	<div class="rendered-trouser">
		<img class="img-responsive processimage" src="">





		<div class="back-face-icon">
			  <img src="https://www.stylior.com/stylior/site/images/rotate-icon.png"  id="backface" class="backface">
		</div>

 	</div>
</div>
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
	<div class="stylior-logo hidden-xs hidden-sm">
		<a href="https://www.stylior.com/">
			<img class="img-responsive"  src="https://www.stylior.com/stylior/site/images/relaunch/logo.png" alt="">
		</a>
	</div>
	<div class="details-suit">
		<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 nopadding">
		<div class="suit-info">
			<ul>
          		<li ><h4 class="current_title">Zargoza Blue Checks Shirt</h4></li>
           		<li><strong>Fabric :</strong> <span  class="current_fabric" >Egyptian Giza Cotton</span></li>
            	<li ><strong>Pattern :</strong><span class="current_pattern" > Checks</span></li>
            	<li ><strong>Colour :</strong> <span class="current_color">Blues</span></li>
            	<li ><strong>Thread Count :</strong> <span class="current_threadcount" >120</span></li>
            	<li><strong>Price :</strong> <span  class="current_price" ></span></li>
				<input type="hidden" name="current_product_id" id="current_product_id" value=""/>
				<input type="hidden" name="current_product_price" id="current_product_price" value=""/>
			</ul>

		</div>
	</div>
		<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 nopadding">
		<div class="summary-button">
		  <button type="button"  data-toggle="modal" data-target="#suitSummary">SUMMARY</button>
		</div>
		<div class="add-measurement">
		  <a href="#" onclick="addToCart('<?= $_SESSION['user_id']; ?>');">ADD MEASUREMENT</a>
		</div>
		<div class="back-to-home">
		  <a href="#" >BACK TO HOME</a>
		</div>
	</div>

	</div>
</div>

<!-- Footer Section Here -->
<div id="suitSummary" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="suitContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Suit Summary</h4>
      </div>
			<div class="row">
      <div class="modal-body">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="rendered-shirt">
						<img class="img-responsive processimage" src="">
				 	</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="suit-info">
						<ul>
		          		<li ><h4 class="current_title_modal">A Dream Solid White Shirt</h4></li>
									<li ><strong>Pattern :</strong><span class="current_pattern_modal" > Solids</span></li>
		            	<li ><strong>Colour :</strong> <span class="current_color_modal">Whites</span></li>
									<li ><strong>Thread Count :</strong> <span class="current_threadcount_modal" >120</span></li>
									<li ><strong>Sleeves :</strong> <span class="current_sleeves_modal">Full Sleeves</span></li>
									<li ><strong>Collar :</strong> <span class="current_collar_modal">Regular</span></li>



						</ul>
				 	</div>
				</div>
      </div>
		</div>
    </div>

  </div>
</div>

<div id="suitFabric" class="modal fade fabricModal" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content noradius" >
            <div id="suitFabricImage" class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            <img class="img-responsive" src="">
            </div>
        </div>
    
    </div>
</div>

<!-- mesurments start  -->
	<?php 	$uid=$_SESSION['user_id'];?>
	<div style="max-width:inherit !important;" class="remodal" data-remodal-id="suit_measurements" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" data-remodal-options="closeOnEscape:false,closeOnOutsideClick: false">
    <?php if(isset($uid)){	include("measurements-suit.php");}?>
    </div>
		<!--  measurements end -->
</body>


<script src="<?= $bas_ul ?>site/js/jquery-2.1.1.js"></script>
<script src="<?= $bas_ul ?>site/js/bootstrap.min.js"></script>
<script src="<?= $bas_ul ?>site/js/swiper.min.js"></script>
<script src="https://www.stylior.com/stylior/site/js/remodal.js"></script>
<script src="https://www.stylior.com/site/js/remodal.js"></script>
<script src="https://www.stylior.com/site/js/jquery.slimscroll.js"></script>
<script src="<?= $bas_ul ?>site/js/suit_new_3d_js.php"></script>
<script src="<?= $bas_ul ?>site/js/3d-suit.js"></script>



<script type="text/javascript">

function showExistingMeasure(measureid){
	$(".bodymeasure").hide();
	$('#bodymeasure-'+measureid).show();

}


// <!-- Events -->
	$(document).on('opening', '.remodal', function () {
		console.log('opening');
	});

	$(document).on('opened', '.remodal', function () {
		console.log('opened');
	});

	$(document).on('closing', '.remodal', function (e) {
		console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
	});

	$(document).on('closed', '.remodal', function (e) {
		console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
	});

	$(document).on('confirmation', '.remodal', function () {
		console.log('confirmation');
	});

	$(document).on('cancellation', '.remodal', function () {
		console.log('cancellation');
	});

	//The second way to initialize:
	$('[data-remodal-id=modal2]').remodal({
		modifier: 'with-red-theme'
	});


jQuery(document).ready(function($){
	var tabItems = $('.cd-tabs-navigation a'),
		tabContentWrapper = $('.cd-tabs-content');

	tabItems.on('click', function(event){
		event.preventDefault();
		var selectedItem = $(this);
		if( !selectedItem.hasClass('selected') ) {
			var selectedTab = selectedItem.data('content'),
				selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
				slectedContentHeight = selectedContent.innerHeight();

			tabItems.removeClass('selected');
			selectedItem.addClass('selected');
			selectedContent.addClass('selected').siblings('li').removeClass('selected');
			//animate tabContentWrapper height when content changes
			tabContentWrapper.animate({
				'height': slectedContentHeight
			}, 200);
		}
	});

	//hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
	checkScrolling($('.cd-tabs nav'));
	$(window).on('resize', function(){
		checkScrolling($('.cd-tabs nav'));
		tabContentWrapper.css('height', 'auto');
	});
	$('.cd-tabs nav').on('scroll', function(){
		checkScrolling($(this));
	});

	function checkScrolling(tabs){
		var totalTabWidth = parseInt(tabs.children('.cd-tabs-navigation').width()),
			tabsViewport = parseInt(tabs.width());
		if( tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
			tabs.parent('.cd-tabs').addClass('is-ended');
		} else {
			tabs.parent('.cd-tabs').removeClass('is-ended');
		}
	}
});



/*avr measurements functions here.*/
var suitMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","fitype":"NO","standardsize":"NO","length":"NO","shoulder":"","backlength":"","chest":"","upperwaist":"","sleeve":"","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};
/***********
****** to get standard measurements based on size selection
****** stylior.com : 18 Oct 2016*/


$('select#size_select_jacket').change(function(){
var selected_size=$("#size_select_jacket option:selected").text();
var     base_url = '<?php echo $bas_ul ?>';

if(selected_size!=undefined){
			console.log("var testing."+selected_size+"url"+base_url);
			$.ajax({
				url: base_url+"home/get_tbl_size/"+selected_size+"/16",
				type:'GET',
				data:
					{
						size : selected_size,
						category :  '16'
					},
				success: function(response) {
					console.log(response.length);
					if(response !== null && response !== undefined && response.length > 100){
					var var_result= $.parseJSON(response);
					var measurement = $.parseJSON(var_result.measurement);
					$("#lum_input_required1").val(measurement.shoulder);
					$("#lum_input_required2").val(measurement.backlength);
					$("#lum_input_required3").val(measurement.chest);
					$("#lum_input_required4").val(measurement.upperwaist);
					$("#lum_input_required5").val(measurement.sleeve);

					}
					else{

					$("#lum_input_required1").val("");
					$("#lum_input_required2").val("");
					$("#lum_input_required3").val("");
					$("#lum_input_required5").val("");
					$("#lum_input_required6").val("");
					$("#lum_input_required8").val("");

					}


				}
			});
	}
});

/*********
***end of standard measurement function...
*/
$('select#size_select_trouser').change(function(){
var selected_size=$("#size_select_trouser option:selected").text();
var     base_url = '<?php echo $bas_ul ?>';

if(selected_size!=undefined){
			console.log("var testing."+selected_size+"url"+base_url);
			$.ajax({
				url: base_url+"home/get_tbl_size/",
				type:'GET',
				data:
					{
						size : selected_size,
						category :  '11'
					},
				success: function(response) {
					console.log(response.length);
					if(response !== null && response !== undefined && response.length > 100){
					var var_result= $.parseJSON(response);
					var measurement = $.parseJSON(var_result.measurement);
					$("#lum_input_required6").val(measurement.waist);
					$("#lum_input_required7").val(measurement.hip);
					$("#lum_input_required8").val(measurement.rise);
					$("#lum_input_required9").val(measurement.bottom);
					$("#lum_input_required10").val(measurement.knee);
					$("#lum_input_required11").val(measurement.thigh);
					}
					else{
					$("#lum_input_required6").val("");
					$("#lum_input_required7").val("");
					$("#lum_input_required8").val("");
					$("#lum_input_required9").val("");
					$("#lum_input_required10").val("");
					$("#lum_input_required11").val("");

					}
				}
			});
	}
});
$("#quick_skip").click(function(){
			 window.location.href= base_url+"cart/lum_view_cart";
});

$("#quick_save").click(function(){

	var measureid ="";
	if("<?= $_GET['update'] ?>"=="shirt"){
	 measureid = '<?php echo $_GET['mid'];?>';
	}
	var height_select=$('#height_select').val();
	var body_weight=$('#body_weight').val();
	
	//var yourfit=$('input[name="yourfit"]:checked').val();
	//var yourlength=$('input[name="yourlength"]:checked').val();
	//console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);   //alert($('input[name="yourlength"]:checked').val());
	suitMeasure.HEIGHTinch=height_select;
	suitMeasure.WEIGHTkg=body_weight;
	//suitMeasure.fitype=yourfit;
	//suitMeasure.length=yourlength;
	suitMeasure.standardsize=$("#size_select_jacket").val();
	suitMeasure.standardsize=$("#size_select_jacket").val();
	/*added by var for standard measurements*/
	suitMeasure.shoulder=$("#lum_input_required1").val();
	suitMeasure.backlength=$("#lum_input_required2").val();
	suitMeasure.chest=$("#lum_input_required3").val();
	suitMeasure.uppperwaist=$("#lum_input_required4").val();
	suitMeasure.sleeve=$("#lum_input_required5").val();
	suitMeasure.waist=$("#lum_input_required6").val();
	suitMeasure.hip=$("#lum_input_required7").val();
	suitMeasure.raise=$("#lum_input_required8").val();
	suitMeasure.bottom=$("#lum_input_required9").val();
	suitMeasure.knee=$("#lum_input_required10").val();
	suitMeasure.thigh=$("#lum_input_required11").val();
	// console.log(suitMeasure);
	// return false;
	/*end by var*/
	//ajax call to server420
	var result ="imagedata";
	//var imgData = getBase64Image($('#saveImg').attr('src')));
	base_url='<?php echo $bas_ul ?>';
	// var exact_price = $("#prd_price").val();
	// var product_id = $("#prd_id").val();
	var subcatid='17';
	var ordertype;
	ordertype="suit";
	var loginUser='<?php echo $_SESSION['user_id']; ?>';
	console.log(base_url);
	var	details_up = JSON.stringify(suitMeasure);
// alert(details_up);
// return false;

	if(loginUser)
	{
		$.ajax({
				url: base_url+"cart/updatecart",
				type: 'POST',
				data:
				{
					details_up : JSON.stringify(suitMeasure),
					measureid :  measureid
						},
				success: function(response) {
						console.log("AVR"+response);
			         
             // return false;

			           window.location.href= base_url+"cart/lum_view_cart";
				}
			});
	}
	});

/** Add Measurement dtaa collect from here.
*******
*****
***/
base_url = '<?= $bas_ul ?>';
$("#add-mesurement").click(function(){
				/*alert("var testing");
				console.log("thid is data tesitng");
				*/

				var data = $(".mesure-form").serialize();
					console.log("var Data"+data);

					 $.ajax({
						url:base_url+'cart/new_mvalue' ,
						method: "POST",
						data: {'data': $(".mesure-form").serialize(),
					'subcatid': 17 , },
						success:function(data){
							console.log("this is data"+data);

							location.href='<? echo $bas_ul ?>cart/lum_view_cart';

						}
					 });

});

/*change the instruction on body part*/
/*date 14 sep 2016*/
$(".entry").click(function(){
var base_url='<? echo $bas_ul ?>';
var current_id = this.id ;
var i = $(this).find(" input");
var name = $(i).attr("name");
var m = name.substring(14, 16);
$("#guideDescription").html("");

$("#guideDescription-standard").html("");
	console.log("m valuye"+m);
	$.ajax({
	url:base_url+'home/getbodypart' ,
	method: "POST",
	data: {'bid': m},
	success:function(data){
	data = JSON.parse(data);
	var youtubeurl = base_url+""+data.youtubeurl;
	var description = "<p>"+data.desc+"</p>";

	var source_video='<video id="lum_input_required_video1" class="lum_video-new" controls><source src="'+youtubeurl+'" type="video/mp4"><source src="'+youtubeurl+'" type="video/ogg"></video>'+description;
	if(current_id == "entry-standard"){
			$("#guideDescription-standard").append(source_video);
	}
	else{
			$("#guideDescription").append(source_video);
	}
	var vidd = document.getElementById("lum_input_required_video1");
		vidd.play();

	}
	});



});

function getSelectedMeasure(idtype,number){
		$("#"+idtype).val(number);
}
/*****VAR date : 17 Nov 2016
*** Get vest price
***/
function addVestPrice(val_vest){
	var itemcode=$("#itemcode").val();
	var price= $(".price_top").text();

	console.log("itemcode"+itemcode+"vest-yes-no"+price);
	$.ajax({
					url: base_url+"cart/get_vest_price",
					type: 'POST',
					data:
					 {
						itemcode:itemcode,
						val_vest:val_vest
					 },
					success: function(response)
					{

						var res = response.split(" ");
						//console.log(res[0]);
						$(".price_top").text(response);
						$(".frontprice").text(response);
						$("#prd_price").val(res[1]);
					}
		});
}
$(".back-to-home").on('click', function(){

	var     base_url = '<? echo $bas_ul ?>';
	var loginUser='<?php echo $_SESSION['user_id']; ?>';
	if(loginUser)
	{
		user = loginUser;
	}
	else {
		user = "guest";
	}
	var image = 		$("img.processimage").attr('src');
	console.log(base_url);
	//var option = srce.substr(0, srce.indexOf('.')) + "_600x600.jpg";
				$.ajax({
				url: base_url+"custom/savedata",
				type: 'POST',
				data:
				{
					user : user,
					image :  image
				},
				success: function(response) {
						//console.log(response);
						 window.location.href= base_url;
				}
			});

});

</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.desing-cloth-leftpanel, .option-select').slimScroll({
			height: '100vh',
			color: 'rgb(1, 47, 66)',
			disableFadeOut: true
      });

    });
</script>

</html>
