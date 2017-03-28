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

if(!($_SESSION['currencycode']))
{
  $this->session->set_userdata('currencycode',$currency);
}
else
{
	 $currency= $_SESSION['currencycode'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Custom Vest|Stylior</title>

	<link rel="shortcut icon" href="https://www.stylior.com/stylior/site/images/favicon.jpg" sizes="32x32" />
	<!--  non-retina iPhone pre iOS 7 -->
	<link rel="apple-touch-icon" href="https://www.stylior.com/stylior/site/images/favicon.jpg" sizes="57x57" />
	<!--  non-retina iPad iOS 7 -->
	<link rel="apple-touch-icon" href="https://www.stylior.com/stylior/site/images/favicon.jpg" sizes="76x76" />
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
						<div class="col-md-6 left-panel-icon" id="selected_fabric_icon">
							<img src="<?= $bas_ul ?>stylior/site/images/shirt-icons/fabric.png" alt="">
						</div>
						<div class="col-md-6 left-panel-icon-info" id="selected_fabric">
							<h4>Fabric</h4>
							<span></span>
						</div>
					</div>
				</li>
				<li class="left-panel-option front_bottom_icon"  >
					<div class="row">
						<div class="col-md-6 left-panel-icon" id="selected_front_bottom_icon">
						<img src="<?= $image_url; ?>upload/vest/normal_cut_active.png" alt="">


						</div>
						<div class="col-md-6 left-panel-icon-info" id="selected_front_bottom">
							<h4>Front Bottom</h4>
							<span></span>
						</div>
					</div>
				</li>
				<li class="left-panel-option jacket_button_icon"  >
					<div class="row">
						<div class="col-md-6 left-panel-icon" id="selected_vest_button_icon">
							<img src="<?= $image_url; ?>upload/vest/3button_active.png" alt="">
						</div>
						<div class="col-md-6 left-panel-icon-info" id="selected_vest_button">
							<h4>Vest Button</h4>
							<span></span>
						</div>
					</div>
				</li>
				<li class="left-panel-option back_details_icon" >
					<div class="row">
						<div class="col-md-6 left-panel-icon" id="selected_back_details_icon" >
							<img src="<?= $image_url; ?>upload/vest/plain_active.png" alt="">
						</div>
						<div class="col-md-6 left-panel-icon-info" id="selected_back_details">
							<h4>Back Details</h4>
							<span> </span>
						</div>
					</div>
				</li>
				<li class="left-panel-option pocket_icon">
					<div class="row">
						<div class="col-md-6 left-panel-icon" id="selected_vest_pocket_icon">
							<img src="<?= $image_url; ?>upload/vest/2flap_pocket_active.png" alt="">


						</div>
						<div class="col-md-6 left-panel-icon-info" id="selected_vest_pocket">
							<h4>Vest pocket</h4>
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
					<li class="left-panel-option front_bottom_icon"  >
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_front_bottom_icon_mobile">
				<img src="<?= $image_url; ?>upload/vest/normal_cut_active.png" alt="">


							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_front_bottom">
								<h4>Front Bottom</h4>
								<span></span>
							</div>
						</div>
					</li>
				</div>
				<div class="swiper-slide"  >
					<li class="left-panel-option back_details_icon" >
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_back_details_icon_mobile" >
								<img src="<?= $image_url; ?>upload/vest/plain_active.png" alt="">
							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_back_details">
								<h4>Back Details</h4>
								<span> </span>
							</div>
						</div>
					</li>
			</div>
			<div class="swiper-slide"  >
				<li class="left-panel-option jacket_button_icon"  >
					<div class="row">
						<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_vest_button_icon_mobile">
						<img src="<?= $image_url; ?>upload/vest/3button_active.png" alt="">
						</div>
						<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_vest_button">
							<h4>Vest Button</h4>
							<span></span>
						</div>
					</div>
				</li>

		</div>
				<div class="swiper-slide">
					<li class="left-panel-option pocket_icon">
						<div class="row">
							<div class="col-xs-12 col-sm-12 left-panel-icon" id="selected_vest_pocket_icon">
								<img src="<?= $image_url; ?>upload/vest/2flap_pocket_active.png" alt="">


							</div>
							<div class="col-xs-12 col-sm-12 left-panel-icon-info" id="selected_vest_pocket">
								<h4>Vest pocket</h4>
								<span> </span>
							</div>
						</div>
					</li>
				</div>


</ul>

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

	<!-- <a class="swatchchangeOption" href="#" data-part="ED543432" data-key="04700032-67">04700032-67-ED543432</a>
	<div class="fit-options" id="fit_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRSLIM">
					<a class="changeOption" href="#" data="TRSLIM" data-key="trouser_fit">
						<img class="img-responsive" src="">
					<div class="option-info">
						<h4>SLIM</h4>
					</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRTAIL">
					<a class="changeOption" href="#" data="TRTAIL" data-key="trouser_fit">
						<img class="img-responsive" src="">
					<div class="option-info">
						<h4>TAILORED</h4>
					</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
			<div class="fit-details" id="TRREG">
					<a class="changeOption" href="#" data="TRREG" data-key="trouser_fit">
						<img class="img-responsive" src="">
					<div class="option-info">
						<h4>REGULAR</h4>
					</div>
			</div>
		</div>
	</div>
	< !- jacket style Option Start -->




	<div class="front-bottom-options right-options" id="front_bottom_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="front-bottom-details" id="WCNORMALCUT">
					<a class="changeOption" href="#" data="WCNORMALCUT" data-key="front_bottom">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/normal_cut_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/normal_cut_active.png" style="display:none;">
					<div class="option-info">
						<h4>NORMAL CUT</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="front-bottom-details" id="WCSTRAIGHTCUT">
					<a class="changeOption" href="#" data="WCSTRAIGHTCUT" data-key="front_bottom">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/straight_cut_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/straight_cut_active.png" style="display:none;">
					<div class="option-info">
						<h4>STRAIGHT CUT</h4>
					</div>
				</a>
			</div>
		</div>
	</div>

	<!--Lapel Option Start -->
	<div class="back-detail-options right-options" id="back_details_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="back-details" id="WCPLAIN">
					<a class="changeOption" href="#" data="WCPLAIN" data-key="back_detail">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/plain_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/plain_active.png" style="display:none;">
					<div class="option-info">
						<h4>PLAIN</h4>
					</div>
					</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="back-details" id="WCBUCKET">
					<a class="changeOption" href="#" data="WCBUCKET" data-key="back_detail">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/bucket_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/bucket_active.png" style="display:none;">
					<div class="option-info">
						<h4>BUCKET</h4>
					</div>
					</a>
			</div>
		</div>
	</div>

	<!--jacket button Option Start -->

	<div class="vest-button-options right-options" id="vest_button_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-button-details" id="WC3BTN">
					<a class="changeOption" href="#" data="WC3BTN" data-key="jacket_button">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/3button_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/3button_active.png" style="display:none;">

					<div class="option-info">
						<h4>3 BUTTON</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-button-details" id="WC4BTN">
					<a class="changeOption" href="#" data="WC4BTN" data-key="jacket_button">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/4button_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/4button_active.png" style="display:none;">
					<div class="option-info">
						<h4>4 BUTTON</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-button-details" id="WC5BTN">
					<a class="changeOption" href="#" data="WC5BTN" data-key="jacket_button">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/5button_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/5button_active.png" style="display:none;">

						<div class="option-info">
						<h4>5 BUTTON</h4>
					</div>
				</a>
			</div>
		</div>

	</div>



	<!--Vest Pocket Option Start -->

	<div class="vest-pocket-options right-options" id="vest_pocket_options" style="display: none">
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-pocket-details" id="WCNOPOCKET">
					<a class="changeOption" href="#" data="WCNOPOCKET" data-key="pocket">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/no_pocket_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/no_pocket_active.png" style="display:none;">
					<div class="option-info">
						<h4>NO POCKET</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-pocket-details" id="WC2POCKET">
					<a class="changeOption" href="#" data="WC2POCKET" data-key="pocket">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/2flap_pocket_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/2flap_pocket_active.png" style="display:none;">
					<div class="option-info">
						<h4>2 FLAP POCKET</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-3 col-xs-6 ">
			<div class="vest-pocket-details" id="WC2FLAP">
					<a class="changeOption" href="#" data="WC2FLAP" data-key="pocket">
						<img class="img-responsive default" src="<?= $image_url; ?>upload/vest/2flap_pocket_std_default.png">
						<img class="img-responsive active" src="<?= $image_url; ?>upload/vest/2flap_pocket_std_active.png" style="display:none;">
					<div class="option-info">
						<h4> 2 FLAP & STD BR</h4>
					</div>
				</a>
			</div>
		</div>

	</div>

</div>
</div>

<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">


	<div class="rendered-trouser">
		<img class="img-responsive processimage" src="">
<!--		<img src="http://www.tsg.ge/images/loading.gif" class="loadingmessage">-->




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
          		<li ><h4 class="current_title"></h4></li>
           		<li><strong>Fabric :</strong> <span  class="current_fabric" >Wool</span></li>
            	<li ><strong>Pattern :</strong><span class="current_pattern" >Solids</span></li>
            	<li ><strong>Colour :</strong> <span class="current_color">Grey</span></li>
            	<li ><strong>Thread Count :</strong> <span class="current_threadcount" ></span></li>
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
        <h4 class="modal-title">Vest Summary</h4>
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
		          		<li ><h4 class="current_title_modal"></h4></li>
									<li ><strong>Pattern :</strong><span class="current_pattern" ></span></li>
		            	<li ><strong>Colour :</strong> <span class="current_color"></span></li>
									<li ><strong>Thread Count :</strong> <span class="current_threadcount" ></span></li>




						</ul>
				 	</div>
				</div>
      </div>
		</div>
    </div>

  </div>
</div>

<div id="suitFabric" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content noradius" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body" id="suitFabricImage">
				<img class="img-responsive" src="">

      </div>

    </div>

  </div>
</div>

<!-- mesurments start  -->
	<?php 	$uid=$_SESSION['user_id'];?>
	<div style="max-width:inherit !important;" class="remodal" data-remodal-id="vest_measurements" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" data-remodal-options="closeOnEscape:false,closeOnOutsideClick: false">
    <?php if(isset($uid)){	include("measurements-vest.php");}?>
    </div>
		<!--  measurements end -->
</body>

<script src="<?= $bas_ul ?>site/js/jquery-2.1.1.js"></script>
<script src="<?= $bas_ul ?>site/js/bootstrap.min.js"></script>
<script src="<?= $bas_ul ?>site/js/swiper.min.js"></script>
<script src="https://www.stylior.com/stylior/site/js/remodal.js"></script>

<script src="https://www.stylior.com/site/js/remodal.js"></script>
<script src="https://www.stylior.com/site/js/jquery.slimscroll.js"></script>
<script src="<?= $bas_ul ?>site/js/vest_3d_js.php"></script>
<script src="<?= $bas_ul ?>site/js/3d-vest.js"></script>

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
      var vestMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","standardsize":"NO","shoulder":"","backlength":"","chest":"","upperwaist":""};

      /***********
      ****** to get standard measurements based on size selection
      ****** stylior.com : 18 Oct 2016
      */
      $('select#size_select_vest').change(function(){
      var selected_size=$("#size_select_vest option:selected").text();
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


      $("#quick_save").click(function(){
        var measureid ="";
        if("<?= $_GET['update'] ?>"=="vest"){
         measureid = '<?php echo $_GET['mid'];?>';
        }
        var height_select=$('#height_select').val();
        var body_weight=$('#body_weight').val();
        //var yourfit=$('input[name="yourfit"]:checked').val();
        var yourlength=$('input[name="yourlength"]:checked').val();
        //console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);   //alert($('input[name="yourlength"]:checked').val());
        vestMeasure.HEIGHTinch=height_select;
        vestMeasure.WEIGHTkg=body_weight;
        //vestMeasure.fitype=yourfit;
        vestMeasure.length=yourlength;
        vestMeasure.standardsize=$("#size_select_vest").val();
        /*added by var for standard measurements*/
        vestMeasure.shoulder=$("#lum_input_required1").val();
        vestMeasure.backlength=$("#lum_input_required2").val();
        vestMeasure.chest=$("#lum_input_required3").val();
        vestMeasure.upperwaist=$("#lum_input_required4").val();
        vestMeasure.sleeve=$("#lum_input_required5").val();
        /*end by var*/
        //ajax call to server420
        // alert(vestMeasure);
        // console.log(vestMeasure);
        // return false;

        var result ="imagedata";
        //var imgData = getBase64Image($('#saveImg').attr('src')));
        base_url = '<?php echo $bas_ul; ?>';
        // var exact_price = $("#prd_price").val();
        // var product_id = $("#prd_id").val();
        var subcatid='18';
        var ordertype;
        //alert("tyoe"+subcatid);
        //var fabric_nameshirt = $("#prd_namme").val();
        var loginUser='<?php echo $_SESSION['user_id']; ?>';
        console.log(base_url);
        if(loginUser)
        {
          $.ajax({
              url: base_url+"cart/updatecart",
              type: 'POST',
              data:
              {
                details_up : JSON.stringify(vestMeasure),
                measureid :  measureid
                  },
              success: function(response) {
                  console.log("AVR"+response);
                   //return false;


                   window.location.href= base_url+"cart/lum_view_cart";
              }
            });
        }
        });

        $("#quick_skip").click(function(){
                     window.location.href= base_url+"cart/lum_view_cart";

          });

      /** Add Measurement data collect from here.
      *******
      *****
      ***/
      base_url = '<? echo $bas_ul?>';

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

                    location.href='<? echo $bas_ul?>/cart/lum_view_cart';

                  }
                 });

      });

      /*change the instruction on body part*/
      /*date 14 sep 2016*/

      $(".entry").click(function(){
      var base_url='<? echo $bas_ul?>';
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


      </script>

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
