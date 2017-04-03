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
// print_r($_SESSION);
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Custom Trouser|Stylior</title>
	 <link rel="shortcut icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="32x32" />
	    <!--  non-retina iPhone pre iOS 7 -->
	    <link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="57x57" />
	    <!--  non-retina iPad iOS 7 -->
	<link rel="apple-touch-icon" href="<?= $bas_ul ?>stylior/site/images/favicon.jpg" sizes="76x76" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/bootstrap.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/swiper.min.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>/site/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
	<link rel="stylesheet" href="<?= $bas_ul ?>/site/css/ionicons.min.css">
	<link rel="stylesheet" href="https://www.stylior.com/stylior/site/css/remodal.css">
	<link rel="stylesheet" href="https://www.stylior.com/stylior/site/css/remodal-default-theme.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/3d-trouser.css">
	<link rel="stylesheet" href="<?= $bas_ul ?>site/css/3d-suit.css">



</head>
<body>
<!-- Header Section Here -->
<!-- Content Section -->
<!-- start container-fluid Section -->

<div class="se-pre-con"  style="background: url(<?=base_url()."images/loading_new.gif";?>) no-repeat center"></div>

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
					<div class="">
						<div class="col-md-4 left-panel-icon" id="selected_fabric_icon">
							<img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
						</div>
						<div class="col-md-8 left-panel-icon-info" id="selected_fabric">
							<h4>FABRIC</h4>
							<span></span>
						</div>
					</div>
				</li>
				<li class="left-panel-option pleat_icon" >
					<div class="row">
						<div class="col-md-4 left-panel-icon" id="selected_pleat_icon">
							<img src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_active.png" alt="">
						</div>
						<div class="col-md-8 left-panel-icon-info" id="selected_pleat">
							<h4>PLEAT</h4>
							<span></span>
						</div>
					</div>
				</li>
				<li class="left-panel-option cuffs_icon"  >
					<div class="row">
						<div class="col-md-4 left-panel-icon" id="selected_cuff_icon">
							<img src="<?= $image_url; ?>upload/trouser/cuffs/cuff_active.png" alt="">
						</div>
						<div class="col-md-8 left-panel-icon-info" id="selected_cuff">
							<h4>CUFFS</h4>
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
							<h4>POCKET</h4>
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
							<h4>BELT</h4>
							<span> </span>
						</div>
					</div>
				</li>
				<li class="left-panel-option button_icon" >
					<div class="row">
						<div class="col-md-4 left-panel-icon" id="selected_button_icon">
							<img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
						</div>
						<div class="col-md-8 left-panel-icon-info" id="selected_button">
							<h4>BUTTON</h4>
							<span> </span>
						</div>
					</div>
				</li>

			</ul>
		</div>
 </div>
  </div>
	<div class="col-xs-12 left-panel visible-xs visible-sm virtual-mobile-view">
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
								<h4>FABRIC</h4>
								<span></span>
							</div>
						</div>
					</li>
				</div>
				<div class="swiper-slide" >
				<li class="left-panel-option pleat_icon" >
					<div class="row">
						<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_pleat_icon_mobile">
							<img src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_active.png" alt="">
						</div>
						<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_pleat">
							<h4>PLEAT</h4>
							<span></span>
						</div>
					</div>
				</li>
				</div>
				<div class="swiper-slide"  >
					<li class="left-panel-option cuffs_icon"  >
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_cuff_icon_mobile">
								<img src="<?= $image_url; ?>upload/trouser/cuffs/cuff_active.png" alt="">
							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_cuff">
								<h4>CUFFS</h4>
								<span></span>
							</div>
						</div>
					</li>
			</div>
			<div class="swiper-slide"  >
			<li class="left-panel-option pocket_icon" >
				<div class="row">
					<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_pocket_icon_mobile" >
						<img src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" alt="">
					</div>
					<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_pocket">
						<h4>POCKET</h4>
						<span> </span>
					</div>
				</div>
			</li>
		</div>
				<div class="swiper-slide">
					<li class="left-panel-option belt_icon">
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_belt_icon_mobile">
								<img src="<?= $image_url; ?>upload/trouser/belt/belt_loop_active.png" alt="">
							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_belt">
								<h4>BELT</h4>
								<span> </span>
							</div>
						</div>
					</li>
				</div>
				<div class="swiper-slide" >
					<li class="left-panel-option button_icon" >
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_button_icon_mobile">
								<img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/button.png" alt="">
							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_button">
								<h4>BUTTON</h4>
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
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 nopadding ">
<div class="option-select">

	<div class="filter-options" id="filter_options">
	<div class="row" >
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">
			<div class="dropdown">
  				<div class="dropbtn">Color</div>
  				<div class="dropdown-content">
    			<ul class="color_select_list"  style="list-style: none;">
					<?php
					// echo "fabric colors comming here";
					// print_r($fabric_colors);
					foreach($fabric_colors as $value) {
						echo '<a href="javascript:filterData(`color`,`'.$value->id.'`);"><li value="'.$value->id.'" id="color_'.$value->id .'" >'.$value->colourname.'</li></a>';
						} ?>

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
						echo '<a href="javascript:filterData(`pattern`,`'.$value->id.'`);"><li id="pattern_'.$value->id .'" value="'.$value->id.'">'.$value->designname.'</li></a>';
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
						<a href="javascript:filterData('range','ASC');"><option value="ASC">Low-to-High</option></a>
						<a href="javascript:filterData('range','DESC');"><option value="DESC">High-to-Low</option></a>
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



	<div class="fabric-options" id="fabric_options" >
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
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 displayfitler" data-color="<?= $fabric_color; ?>" data-pattern="<?= $fabric_pattern; ?>" data-price="<?= $price; ?>">
	 	<div class="fabric-details" id="<?= $custom_key;?>" >
			<a  class="swatchchangeOption" href="#" data-part="<?= $key;?>" data-key="<?= $custom_key;?>">
				<img class="img-responsive" src="<?= $image_url."".$image;?>">

					<div class="option-info">
					<h4 class="product-title-<?= $key; ?>" ><?= $product_name;?></h4>
					<span class="product-price-<?= $key; ?>" ><?= $this->session->userdata('currencycode') .' '.$price;?></span>
					<button class="fabric_swatch hidden-xs hidden-sm" data-image="<?= $image_url."".$image;?>" type="button"  data-toggle="modal" data-target="#trouserFabric">
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


	<!-- <a class="swatchchangeOption" href="#" data-part="ED543432" data-key="04700032-67">04700032-67-ED543432</a> -->
	<div class="fit-options" id="fit_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRSLIM">
					<a class="changeOption" href="#" data="TRSLIM" data-key="trouser_fit">
						<img class="img-responsive" src="">
						</a>
					<div class="option-info">
						<h4>SLIM</h4>
					</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRTAIL">
					<a class="changeOption" href="#" data="TRTAIL" data-key="trouser_fit">
						<img class="img-responsive" src="">
						</a>
					<div class="option-info">
						<h4>TAILORED</h4>
					</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRREG">
					<a class="changeOption" href="#" data="TRREG" data-key="trouser_fit">
						<img class="img-responsive" src="">
					</a>
					<div class="option-info">
						<h4>REGULAR</h4>
					</div>
			</div>
		</div>
	</div>
<!--Pleats Option Start -->

<div class="pleat-options" id="pleat_options" style="display: none">
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pleats-details" id="TRNOPLEAT">
				<a class="changeOption" href="#" data="TRNOPLEAT" data-key="pleats">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/no_pleat_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>NO PLEATS</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pleats-details" id="TRSINGLEPLEAT">
				<a class="changeOption" href="#" data="TRSINGLEPLEAT" data-key="pleats">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pleats/single_pleat_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>SINGLE PLEAT</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pleats-details" id="TRSOUBLEPLEAT">
				<a class="changeOption" href="#" data="TRDOUBLEPLEAT" data-key="pleats">
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
<div class="cuffs-options" id="cuffs_options" style="display: none">
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="cuffs-details" id="TRCUFFYES">
				<a class="changeOption" href="#" data="TRCUFFYES" data-key="bottom_cuff">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/cuffs/cuff_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/cuffs/cuff_active.png" style="display:none">
				</a>
				<div class="option-info">
					<h4>YES</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="cuffs-details" id="TRCUFFNO">
				<a class="changeOption" href="#" data="TRCUFFNO" data-key="bottom_cuff">
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
<div class="pocket-options" id="pocket_options" style="display: none">
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pocket-details" id="TRNOPOCKET">
				<a class="changeOption" href="#" data="TRNOPOCKET" data-key="back_pocket">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>NONE</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pocket-details" id="TRSINGLEPOCKET">
				<a class="changeOption" href="#" data="TRSINGLEPOCKET" data-key="back_pocket">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/pocket/back_single_pocket_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>SINGLE POCKET</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="pocket-details" id="TRDOUBLEPOCKET">
				<a class="changeOption" href="#" data="TRDBLPOCKET" data-key="back_pocket">
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

<div class="belt-options" id="belt_options" style="display: none">
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="belt-details" id="TRWITHLOOP">
				<a class="changeOption" href="#" data="TRSIDETABWL" data-key="Belt">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/belt_loop_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/belt_loop_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>WITH LOOP</h4>
				</div>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="belt-details" id="TRWITHOUTLOOP">
				<a class="changeOption" href="#" data="TRSIDETAB" data-key="Belt">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/belt_no_loop_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/belt_no_loop_active.png" style="display:none">
				</a>
				<div class="option-info">
					<h4>WITHOUT LOOP</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
		<div class="belt-details" id="TRSIDETAB">
				<a class="changeOption" href="#" data="TRSIDETAB" data-key="Belt">
					<img class="img-responsive default" src="<?= $image_url; ?>upload/trouser/belt/side_tab_default.png">
					<img class="img-responsive active" src="<?= $image_url; ?>upload/trouser/belt/side_tab_active.png" style="display:none;">
				</a>
				<div class="option-info">
					<h4>WITH SIDETAB</h4>
				</div>
		</div>
	</div>

</div>

<!-- Button Options -->

<div class="button-options" id="button_options" style="display: none">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="AC1FD311">
				<a class="changeOption" href="#" data="TBBLACK" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/black.png">
				</a>
				<div class="option-info">
					<h4>BLACK</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="E4D8E807">
				<a class="changeOption" href="#" data="TBBROWN" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/brown.png">
				</a>
				<div class="option-info">
					<h4>BROWN </h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="B697A8D2">
				<a class="changeOption" href="#" data="TBGRAY" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/gray.png">
				</a>
				<div class="option-info">
					<h4>GREY</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="B83C5994">
				<a class="changeOption" href="#" data="TBNAVY" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/navy.png">
				</a>
				<div class="option-info">
					<h4>NAVY</h4>
				</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
		<div class="button-details" id="16770C30">
				<a class="changeOption" href="#" data="TBWHITE" data-key="Trouser Button">
					<img class="img-responsive" src="<?= $image_url; ?>upload/trouser/buttons/white.png">
				</a>
				<div class="option-info">
					<h4>WHITE</h4>
				</div>
		</div>
	</div>
</div>
</div>
</div>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
	<div class="rendered-trouser">
		<img class="img-responsive processimage" src="">
		<div class="back-face-icon">
			  <img src="https://www.stylior.com/stylior/site/images/rotate-icon.png"  id="backface_trouser">
		</div>
 	</div>
</div>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	<div class="stylior-logo hidden-xs hidden-sm">
		<a href="https://www.stylior.com/">
			<img class="img-responsive"  src="https://www.stylior.com/stylior/site/images/relaunch/logo.png" alt="">
		</a>
	</div>
	<div class="details-trouser">
<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 nopadding">
		<div class="trouser-info">
			<ul>
          		<li ><h4 class="current_title">Classic Solid Ash Grey Trouser</h4></li>
           		<li><strong>Fabric :</strong> <span  class="current_fabric" >Wool</span></li>
            	<li ><strong>Pattern :</strong><span class="current_pattern" >Solids</span></li>
            	<li ><strong>Colour :</strong> <span class="current_color">Blue</span></li>
            	<li ><strong>Thread Count :</strong> <span class="current_threadcount" >120</span></li>
            <li><strong>Price :</strong> <span  class="current_price" ><?= $this->session->userdata('currencycode') .' '.$default_price;?></span></li>
				<input type="hidden" name="current_product_id" id="current_product_id" value=""/>
				<input type="hidden" name="current_product_price" id="current_product_price" value=""/>
			</ul>

		</div>
</div>
		<div class="summary-button">
		  <button type="button"  data-toggle="modal" data-target="#trouserSummary">SUMMARY</button>
		</div>

		<div class="add-measurement">
		  <a href="#" onclick="addToCart('<?= $_SESSION['user_id']; ?>');">ADD MEASUREMENT</a>
		</div>


	</div>
</div>
	</div>
</div>
<!-- Footer Section Here -->
<div id="trouserSummary" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="trouserContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Trouser Summary</h4>
      </div>
			<div class="row">
      <div class="modal-body">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="rendered-shirt">
						<img class="img-responsive processimage" src="">
				 	</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="trouser-info">
						<ul>
		          		<li ><h4 class="current_title">Classic Solid Ash Grey Trouser</h4></li>
									<li ><strong>Pattern :</strong><span class="current_pattern" > Solids</span></li>
		            	<li ><strong>Colour :</strong> <span class="current_color">Grey</span></li>
									<li ><strong>Thread Count :</strong> <span class="current_threadcount" >120</span></li>




						</ul>
				 	</div>
				</div>
      </div>
		</div>
    </div>

  </div>
</div>

<div id="trouserFabric" class="modal fade fabricModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content noradius" >
        <div class="modal-body" id="trouserFabricImage">
            <img class="img-responsive" src="">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

    </div>

  </div>
</div>

<!-- mesurments start  -->
	<?php 	$uid=$_SESSION['user_id'];?>
	<div style="max-width:inherit !important;" class="remodal" data-remodal-id="trouser_measurements" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" data-remodal-options="closeOnEscape:false,closeOnOutsideClick: false">
    <?php if(isset($uid)){	include("measurements-trouser.php");}?>
    </div>
		<!--  measurements end -->
</body>


<script src="<?= $bas_ul ?>site/js/jquery-2.1.1.js"></script>
<script src="<?= $bas_ul ?>site/js/bootstrap.min.js"></script>
<script src="<?= $bas_ul ?>site/js/swiper.min.js"></script>
<script src="https://www.stylior.com/stylior/site/js/remodal.js"></script>
<script src="https://www.stylior.com/site/js/remodal.js"></script>
<script src="https://www.stylior.com/site/js/jquery.slimscroll.js"></script>
<script src="<?= $bas_ul ?>site/js/trouser_new_3d_js.php"></script>
<script src="<?= $bas_ul ?>site/js/3d-trouser.js"></script>



<script type="text/javascript">
/*avr measurements functions here.*/
var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};

/*********** ::: TROUSER TYPE
****** to get standard measurements based on size selection
****** stylior.com : 18 Oct 2016
*/
$('select#size_select').change(function(){
var selected_size=$("#size_select option:selected").text();
var base_url = 'https://www.stylior.com/';

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
	          $("#lum_input_required0").val(measurement.waist);
	          $("#lum_input_required1").val(measurement.hip);
	          $("#lum_input_required3").val(measurement.rise);
	          $("#lum_input_required4").val(measurement.bottom);
	          $("#lum_input_required5").val(measurement.knee);
	          $("#lum_input_required6").val(measurement.thigh);
	      }
          else{
	          $("#lum_input_required0").val("");
	          $("#lum_input_required1").val("");
	          $("#lum_input_required3").val("");
	          $("#lum_input_required4").val("");
	          $("#lum_input_required5").val("");
	          $("#lum_input_required6").val("");

          }
       
       }
      });
  }
});



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
var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};

var trouserDimension={"pleats":"Nil", "cuffs":"Yes", "pocket":"None","beltloop":"Yes","fitype":"None", "standardsize":"None", "length":"None","product_details_page":"<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"};




$("#quick_save").click(function(){
    var measureid ="";
    // if(""=="shirt"){
    //  measureid = '';
    // }

    var height_select=$('#height_select').val();
    var body_weight=$('#body_weight').val();
    var yourfit=trouserDimension.fitype;
	var standardsize = trouserDimension.standardsize ;
	var length = trouserDimension.length ;
    
    //console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);   //alert($('input[name="yourlength"]:checked').val());
    trouserMeasure.standardsize=standardsize;
    trouserMeasure.WEIGHTkg=body_weight;
	trouserMeasure.HEIGHTinch=height_select;
    //trouserMeasure.fitype=yourfit;
	//trouserMeasure.length=length;
    
    /*added by var for standard measurements*/
    trouserMeasure.waist=$("#lum_input_required0").val();
    trouserMeasure.hip=$("#lum_input_required1").val();
    trouserMeasure.rise=$("#lum_input_required3").val();
    trouserMeasure.bottom=$("#lum_input_required4").val();
    trouserMeasure.knee=$("#lum_input_required5").val();
    trouserMeasure.thigh=$("#lum_input_required6").val();



      //ajax call to server420
    var result ="imagedata";
  
    var base_url = 'https://www.stylior.com/';
    // var exact_price = $("#prd_price").val();
    // var product_id = $("#prd_id").val();
      var subcatid='11';
    var ordertype;
      //var fabric_nameshirt = $("#prd_namme").val();
    var loginUser='<?php echo $_SESSION["user_id"]; ?>';
    if(loginUser)
    {
      $.ajax({
          url: base_url+"cart/updatecart",
          type: 'POST',
          data:
          {
            details_up : JSON.stringify(trouserMeasure),
            measureid :  measureid,
            subcatid:11
          },
          success: function(response) {
              console.log("AVR"+response);
              window.location.href=base_url+"cart/lum_view_cart";
          }
        });
    }

});

/** Add Measurement data collect from here.
*******
*****
***/
base_url = 'https://www.stylior.com/';
$("#add-mesurement").click(function(){
        /*alert("var testing");
        console.log("thid is data tesitng");
        */
       
         var data = $(".mesure-form").serialize();
          console.log("var Data"+data);
           $.ajax({
            url:base_url+'cart/new_mvalue' ,
            method: "POST",
            data: {
            	'data': $(".mesure-form").serialize()
            },
            success:function(data){
              console.log("this is data"+data);
              location.href='https://www.stylior.com//cart/lum_view_cart';
            }
           });

});

/*change the instruction on body part*/
/*date 14 sep 2016*/

$(".entry,#entry-standard").click(function(){
var current_id=this.id;
var base_url='https://www.stylior.com/';
var i = $(this).find(" input");
var name = $(i).attr("name");
var m = name.substring(14,16);
$("#guideDescription").html("");
$("#guideDescription-standard").html("");
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




$(".measure-outer").on("click",function()
{
	var data_this=$("#"+$(this).attr("rel")).val();
    console.log(data_this);  
    //var added:your_fit and your_length

     var ur_fit = ["slim_fit", "tailored", "comfort"];
     var ur_length = ["length_short", "length_regular", "length_high"];
	    if(ur_fit.indexOf(data_this)!=-1){
			trouserMeasure.fitype=data_this;
	    }
		else if(ur_length.indexOf(data_this)!=-1){  	
			trouserMeasure.length=data_this;    	

	    }
	//end of var your_fit and your_legth...

    $("#"+$(this).attr("rel")).trigger("click");
    $('.measure-outer').each(function() {
      if(!$("#"+$(this).attr("rel")).is(':checked'))
      {

        $(this).css({"border": ""});
        $("."+$(this).attr("rel")).remove();

      }
      else
      {
        $("."+$(this).attr("rel")).remove();
        $(this).css({"border": "1px solid black"});
        //$(this).css({"background": "#15A6D6","color":"#fff"});

      }
    });
});


function getSelectedMeasure(idtype,number){
    $("#"+idtype).val(number);
}

function showExistingMeasure(measureid){
  $(".bodymeasure").hide();
  $('#bodymeasure-'+measureid).show();

}

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
