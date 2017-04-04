<?php
if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/medium/";
}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/medium/";

}


?>
<link rel="stylesheet" type="text/css" href="<?= $https_url ?>site/css/animate.css">
<link rel="stylesheet" type="text/css" href="<?= $https_url ?>site/css/owl.carousel.css">
<link href="<?= $https_url ?>site/css/bootstrap.css" rel="stylesheet" />

<title> Create and Design your very own Custom Tailored Dress & Shirts at Stylior Fashion, India
</title>
<meta name="description" content="At Stylior Fashion, you will get Luxury to make your own shirt or you can create your very own custom shirt with the help of our experts.
"/>
<meta name="keywords" content="Custom Shirts, Shirts, Suits, Men Accessories, Trousers, Tailored, Dress, Own Shirts, Design Dress, Shirts for Man, Create, Stylor Fashion, India"/>
<meta name="msvalidate.01" content="3329622651CA6FCF4425CAF6AD27F8EC" />

 <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "https://www.stylior.com",
      "logo": "https://www.stylior.com/stylior/site/images/relaunch/logo.png"
    }
</script>

<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "url" : "https://www.stylior.com",
  "contactPoint" : [{
    "@type" : "ContactPoint",
    "telephone" : "+91 80556 70670",
    "contactType" : "customer service"
  }]
}
</script>

<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "Stylior",
  "url" : "https://www.stylior.com",
  "sameAs" : [
    "https://www.facebook.com/styliorfashion/",
    "https://plus.google.com/100002617149579103996",
    "https://www.instagram.com/styliorfashion/",
    "https://www.linkedin.com/company/stylior-com?trk=biz-companies-cym",
    "https://www.pinterest.com/styliorfashion/",
    "https://m.youtube.com/channel/UCFwHuzx8WXKzjminQXJglWw"

  ]
}
</script>




  <style>
    .wow:first-child {
      visibility: hidden;
    }

  </style>
<style>
.suit-caption{
    margin-top: -26px;
}
.bust_but_lum
{
	padding:5px 50px;background-color:#fff;border:1px solid #282c3e;color:#282c3e;
}
.bust_but_lum:hover
{
	padding:5px 50px;background-color:#282c3e;border:1px solid #282c3e;color:#fff;
}
@media (min-width: 768px){
.lum_content {
    min-height: 600px;
}
#desk_show_lum
{
	display:block;
}
#mob_show_lum
{
	display:none;
}
}
@media screen and (max-width: 767px) and (min-width: 421px) {
#desk_show_lum
{
	display:block;
}
#mob_show_lum
{
	display:none;
}
}
@media screen and (max-width: 420px) and (min-width: 280px) {
#desk_show_lum
{
	display:none;
}
#mob_show_lum
{
	display:block;
}
}
.bag_pop_up{
	width: 310px;
	float: right;
	font-family: Century Gothic;
	top:0px;
	z-index: 99;
	margin: 5px;

	border: 3px solid #f1f1f1 ;


}
}
.bag_details{
	padding-bottom: 5px;
	overflow-y: scroll;
	max-height:600px;
}
.product_img
{
	width: 30%;
	float: left;
}


.product_img img{
	width: 100%;
	height: 120px;
}
.product_info
{
	width:68%;
	float: right;
	vertical-align: bottom;
    text-align: center;
}
.product_info h3{
	color: rgba(128, 128, 128, 0.5);
    font-weight: 100;
    font-size: 12px;
    letter-spacing: 1px;

}
.product_qty{
	width: 100%;
}

.product_qty img{
	margin: 6%;
}
.product_qty h2
{
	background-color: rgba(128, 128, 128, 0.2);
	padding: 5px;
    font-size: 12px;
   	width: 50%;
    font-weight: normal;
    float: left;
}
.product_qty h2:hover
{
	font-weight: bold;
}
.product_qty img:hover
{

	background-repeat: no-repeat;
	cursor: pointer;

}
.subtotal{
	width: 100%;
}
.subtotal h2{
	background-color: rgba(128, 128, 128, 0.3);

    font-size: 12px;
   	width: 100%;
    font-weight: normal;
   text-align: center;

}

/* General button style (reset) */
.btn {
	border: none;
	font-family: century Gothic;
	font-size: 14px;
	color: inherit;
	background: none;
	cursor: pointer;

	display: inline-block;
	margin: 5px 15px;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 100;
	outline: none;
	position: relative;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

.btn:after {
	content: '';
	position: absolute;
	z-index: -1;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

/* Button 1 */
.btn-1 {

    border: 1px solid #000;
    color: #282C3E;
    background: #FFFFFF;

}

/* Button 1a */
.btn-1a:hover,
.btn-1a:active {

	background: #282C3E;
    color: #fff;
}

.image:hover {
-webkit-transform:scale(1.2);
transform:scale(1.2);
}
.image {
-webkit-transition: all 0.7s ease;
transition: all 0.7s ease;
}
hr{
 border-top: 1px solid #ccc;
}
.review-carousel{
min-height:260px;
}
.carousel-indicators{
  bottom: -10px;
}
.homeSlider .carousel-caption{text-align: right;right: 22%;}
.homeSlider .carousel-caption a{text-align: center;margin-top: 53px;}
</style>
<?php

$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";

 /*
<div class="lum_content">
	<div class="bag_pop_up">
 		<div class="bag_details">
 			<div class="product">
 			<table>
 			<?php for($i =3 ; $i>0; $i--) { ?>
 			<tr>
 				<td class="product_img">
 					<img src="img/cart_shirt.png">
 				</td>
 				<td class="product_info">

 					<h3>Light Blue Ginham Broadcloth Custom Dress Shirt</h3>
 					<div class="product_qty">
 						<h2>1Pcs x ₹ 2699 </h2>

 						<img class="image" src="img/grey_delete.png">
 						<!--<img class="bottom" src="img/black_delete.png">-->

					</div>

 				</td>

 			</tr>
 			<?php if($i>1){?>
 			<tr>
 			<td colspan="2">
 			<hr>
 			</td>
 			</tr>
 			<?php } ?>
			<?php }?>
			<tr class="subtotal">
				<td colspan="2">
					<h2><b>SubTotal : </b>₹ 8063</h2>
				</td>
			</tr>
			</table>


 	</div>
 	<table>
 	<tr>
 	<td>
 	<button class="btn btn-1 btn-1a">SHOP MORE</button>
 	</td>
 	<td>
 	<button class="btn btn-1 btn-1a">CHECK OUT</button>
 	</td></tr></table>


</div>

</div>
</div>
*/?>
 <!-- Carousel
    ================================================== -->



    <div id="myCarousel" class="carousel slide homeSlider">

<div class="carousel-inner">
<div class="item imgbanner active ">
   <!--<img src="img/slider/Fotolia_30977559_XS.jpg" alt="slide 1">-->
   <a href="#"><img src="<?= base_url() ?>images/home-banner-bangalore-mobile.jpg" class="visible-xs" alt="Stylior Store Launch in Bangalore, India"/></a>
   <a href="#"> <img src="<?= base_url() ?>images/home-banner-bangalore.jpg" class="hidden-xs" alt="Stylior Store Launch in Bangalore, India" ></a>
</div>

<div class="item imgbanner">
   <a href="<?= $base_url_temp ?>mens-ties"> <img src="<?= base_url() ?>images/stylior-mobile-banner-inspired.jpg" alt="Slide3"  class="visible-xs"></a>
   <a href="<?= $base_url_temp ?>mens-ties"> <img src="<?= base_url() ?>images/web-banner-inspired.jpg" class="hidden-xs" alt="Slide1" ></a>
</div>





<div class="item imgbanner">
   <a href="<?= $base_url_temp ?>custom-shirt"> <img src="<?= base_url() ?>images/shirt-mobile.jpg" alt="Customize Shirts"  class="visible-xs"></a>
   <a href="<?= $base_url_temp ?>custom-shirt"> <img src="<?= base_url() ?>images/shirt_banner.jpg" class="hidden-xs" alt="Customize Shirts" ></a>
</div>

<? /*<div class="item imgbanner">
   <a href="<?= $base_url_temp ?>mens-suits"> <img src="<?= base_url() ?>images/wedding-mobile.jpg" alt="Slide3"  class="visible-xs"></a>
   <a href="<?= $base_url_temp ?>wedding-suit"> <img src="<?= base_url() ?>images/weding_banner.jpg" class="hidden-xs" alt="Slide1" ></a>
   <!--<div class="carousel-caption ">
     <a href="#" class="btn2 btn-1">
      SHOP NOW   </a>
    </div>-->
</div> */?>





</div>
       <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>

      </ol>
      <? /*
      <!-- Controls -->
     <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="fa fa-chevron-left fa-2x hidden"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="fa fa-chevron-right fa-2x hidden"></span></a>*/?>
    </div>


    <!-- /.carousel -->
    <!-- /.carousel -->
     <!-- <div class="video-gap"></div> -->


<div class="gap13 hidden-xs hidden-sm "></div>
<!-- image 1st end -->
 <div class="carousel slide wow fadeIn" data-wow-delay=".3s">
   <div class="carousel-inner">
      <div class="item active" id="desk_show_lum">
         <?php /*<img src="<?=base_url() ?>images/relaunch/refer-earn.jpg" alt="Slide1">*/?>
         <div class="container">
            <div class="carousel-caption ">
               <h2><span>REFER & EARN</span></h2>
               <p class="caption"><span>Get a chance to win Flat 20% off on all your orders forever!</span></p>
               <p><!-- <a class="btn btn-danger" href="#">UNLOCK YOUR CODE</a> -->

      <a href="#" class="btn2 btn-1">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
    UNLOCK YOUR CODE
    </a>
               </p>

            </div>
         </div>
      </div>
	   <div class="item active" id="mob_show_lum">
		<?php /* <img src="<?=base_url() ?>images/relaunch/refer-earn1.jpg" alt="Slide1">*/?>
         <div class="container">
            <div class="carousel-caption " style="padding-top:50px;">
               <h2><span>REFER & EARN</span></h2>
               <p class="caption"><span>Get a chance to win Flat 20% off on all your orders forever!</span></p>
               <p><!-- <a class="btn btn-danger" href="#">UNLOCK YOUR CODE</a> -->

              <a href="#" class="btn2 btn-1">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
    UNLOCK YOUR CODE
    </a>
               </p>

            </div>
         </div>
      </div>
   </div>
</div>



<div class="gap10"></div>
<div class="container-fluid wow fadeIn" data-wow-delay=".3s">
  <div class="row">

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pad-R0">
       <h2 class="text-center text-uppercase">YOUR DESIGN OUR CRAFTSMANSHIP </h2>
      <p class="text-center">Try custom made with confidence, classic service modern style </p>
        <div class="carousel slide">
          <div class="carousel-inner">
            <div class="item active">
                <a href="<?=$bas_url;?>mens-suits" >
                  <img src="<?=base_url() ?>images/suit.jpg" alt="Customize Suites">
                </a>
              <?/*<div class="container">

                <div class="carousel-caption small-caption  no2">
                    <p class="caption suit-caption"><!--<span>Just Launched</span><br><span> Custom Suits</span>--></p>
                    <p>
                    <a href="<?=$bas_url;?>mens-suits" class="btn2 btn-1 sm">
                    <svg>
                    <rect x="0" y="0" fill="none" width="100%" height="100%"/>
                    </svg>
                    Shop Now
                    </a>
                  </p>
                </div>

            </div><? */ ?>
          </div>
        </div>
      </div>
    </div>

   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pad-R0">
     <h2 class="text-center text-uppercase">MEN'S TROUSERS
</h2>
    <p class="text-center">Whatever the occasion, our collection of men's trouser offers an array of classy finishing touches.</p>
      <div class="carousel slide">
        <div class="carousel-inner">
          <div class="item active">
            <a href="<?php echo $bas_ul;?>mens-trousers">
              <img src="<?= $https_url ?>site/images/trouser-home.jpg" alt="Men's Trouser">
            </a>
          <?/*  <div class="container">
              <div class="carousel-caption small-caption  no2">
                <!-- <h2><span>
YOUR DESIGN OUR CREAFTSMANSHIP</span></h2>-->
                <p class="caption"><!--<span>Complete Your Look</span></p>-->
                <p>

              <a href="<?php echo $bas_ul;?>mens-trousers" class="btn2 btn-1 sm">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
    Shop Now
    </a>
              </p></div>
          </div><? */ ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pad-L0">
   <h1 class="text-center  text-uppercase">Design your own shirt </h1>
  <p class="text-center">Having a custom made outfit is always gives you an edge.</p>
    <div class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <a href="<?php echo $bas_ul;?>mens-shirts"><img  src="<?= $https_url ?>site/images/shirts.jpg" alt="Men's Shirts"></a>
          <?          /*<div class="container">
                <div class="carousel-caption small-caption no1 " >
                  <!--<h2><span>Get Fitted Today</span></h2>
                  <p class="caption"><span>Classic Tailoring</span></p>-->
                  <p>

                <a href="<?php echo $bas_ul;?>mens-shirts" class="btn2 btn-1 sm">
              <svg>
              <rect x="0" y="0" fill="none" width="100%" height="100%"/>
              </svg>
              Shop Now
              </a>
                </p></div>
              </div><? */

           ?>
        </div>
      </div>
    </div>
    <div class="gap10 visible-xs" ></div>
  </div>


</div>
</div>
<div class="gap20"></div>
<div class="gap10"></div>
<div class="container-fluid wow fadeIn" data-wow-delay=".3s">
  <div class="row">
  <div class="col-lg-12 col-md-12 pad-L0" >
  <div class="carousel slide">
        <div class="carousel-inner">
          <div class="item active">
            <a href="<?= $base_url_temp ?>book-a-home-visit"><img src="<?=base_url() ?>images/travel-stylist.jpg" class="hidden-xs" alt="Book now"></a>
            <a href="<?= $base_url_temp ?>book-a-home-visit"><img src="<?=base_url() ?>images/travel-stylist-mobile.jpg" class="visible-xs" alt="Book now"></a>
            <!--<div class="container">
              <div class="carousel-caption small-caption no3">

                 <h2><span>COMFORT AND STYLE AT IT'S BEST</span></h2>
                <p class="caption"><span>Your Trouser Your Way</span></p>
                <p>

              <a href="<?php echo $bas_ul;?>mens-trousers" class="btn2 btn-1 sm">
      <svg>
        <rect x="0" y="0" fill="none" width="100%" height="100%"/>
      </svg>
     Book Now
    </a>
              </p></div>

            </div>-->
          </div>
        </div>
      </div>


  </div>
</div>
</div>


<div class="container-fluid project-title">
   <div class="row text-center">
<h2 class="title_new"><span>OUR PROCESS</span> </h2>
<div class="gap20"></div>
   </div>
</div>
<!-- steps -->
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="container-a2">
<div class="caption-style-2">
			<span>
				<img src="<?=base_url() ?>images/relaunch/selectfabric.png" class="img-responsive" style="width:100%;" alt="Finest Fabric
">
				<div class="caption">
					<div class="blur"></div>

					<div class="caption-text">
                  <img class="img-center" src="<?=base_url() ?>images/relaunch/1st-icon.png" width="73" height="51">
                  <div class="w-70"></div>
<p>Choose Fabric</p>

					</div>
				</div>
			</span>
            </div>
</div>
<span class="how-work">
<numb>1</numb>
<p>Amongst the finest array of fabrics
you can select the best for yourself </p>
</span>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="container-a2">
<div class="caption-style-2">
			<span>
				<img src="<?=base_url() ?>images/relaunch/customize.png" class="img-responsive" style="width:100%;" alt="">
				<div class="caption">
					<div class="blur"></div>

					<div class="caption-text">
                  <img  class="numb2" src="<?=base_url() ?>images/relaunch/cap-img-2.png" width="256" height="51">
                  <div class="w-70"></div>
<p>CUSTOMIZE </p>

					</div>
				</div>
			</span>
            </div>
</div>
<span class="how-work">
<numb>2</numb>
<p>Get the best craftsmanship from the best masters  </p>
</span>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="container-a2">
<div class="caption-style-2">
			<span>
				<img src="<?=base_url() ?>images/relaunch/add_measurement.png" class="img-responsive" style="width:100%;" alt="Perfect Measurement">
				<div class="caption">
					<div class="blur"></div>

					<div class="caption-text">
                  <img  class="numb2" src="<?=base_url() ?>images/relaunch/cap-img-2.png" width="256" height="51">
                  <div class="w-70"></div>
<p>Add measurment </p>

					</div>
				</div>
			</span>
            </div>
</div>
<span class="how-work">
<numb>3</numb>
<p>Feed in your measurment to get like
your perfect shirt. </p>
</span>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="container-a2">
<div class="caption-style-2">
			<span>
				<img src="<?=base_url() ?>images/relaunch/free-globale-delivery.png" class="img-responsive" style="width:100%;" alt="Stylior Fashion: Free Global Delivery">
				<div class="caption">
					<div class="blur"></div>

					<div class="caption-text">
                  <img  class="numb4" src="<?=base_url() ?>images/relaunch/cap-img-4.png" width="58" height="51">
                  <div class="w-70"></div>
<p>FREE GLOBAL DELIVERY  </p>

					</div>
				</div>
			</span>
            </div>
</div>
<span class="how-work">
<numb>4</numb>
<p>Get your shirt at your door step all over
the world </p>
</span>
</div>
</div>
</div>

<div class="gap20"></div>
<!-- NEW ARRIVAL -->
<div class="container-fluid new-arrival wow fadeIn" data-wow-delay=".3s">
  <div class="row text-center">
     <h2 class="title_new"><span>NEW ARRIVAL</span></h2>
  </div>
   <div id="owl-demo" class="owl-carousel owl-theme">
   <?php $this->db->select('*');
	$this->db->from('tbl_product as t1');
	$this->db->join('tbl_product_image as t2', 't2.pid = t1.id','left');
	//$this->db->join('colour as c1', 't1.colour = c1.id','inner');
	//$this->db->join('design as d1', 't1.designid = d1.id','inner');
	$this->db->where('subcatid',10);
	$this->db->where('qty>',0);
  $this->db->where('is_home',1);

        $this->db->where('t2.baseimage',1);
	$this->db->limit(10);
	$q = $this->db->get();
	//echo "<pre>";
	//print_r($q->result()); die;
	$ret['result'] = $q->result();


	foreach($ret['result'] as $index =>$product)
		{
		if($product->id!="")
			$product_images_pids[]=$product->id;
		}
		if($product->id!="")
		{
		$prd_images_qry = $this->db->query("select pid, image  from tbl_product_image where pid in (".implode(",",$product_images_pids).") order by id");

		foreach($prd_images_qry->result() as $index =>$product)
		{
			$product_images[$product->pid][]=$product->image;
		}
		}
		$ret['images']  = $product_images;
		$ret['count']  = $query1->num_rows;

	 $i=0;
	foreach($ret['result'] as $result[])
	{
		if($i<30)
		{
	//echo "<pre>";
	//print_r($ret['result']);?>
      <div class="item">


		<a href="<? echo $base_ul."/mens-shirts/".str_replace(' ','-',$ret['result'][$i]->pname)."-".$ret['result'][$i]->pid; ?>" >
         <img src="<?php echo $https_url_large_img."".$ret['result'][$i]->image;?>" class="img-responsive" width="242" height="392">
		</a>
         <h4><?php echo $ret['result'][$i]->pname;?></h4>
         <div class="price">

           <?php
           if($this->session->userdata('currencycode')=="" ||$this->session->userdata('currencycode') == 'INR')
           {
             echo "INR ".$ret['result'][$i]->price;
           }
           else if($this->session->userdata('currencycode') == 'USD')
           {
             echo "USD ".$ret['result'][$i]->USD;
           }
           else if($this->session->userdata('currencycode') == 'BHD')
           {
             echo "BHD ".$ret['result'][$i]->BHD;
           }
           else if($this->session->userdata('currencycode') == 'SAR')
           {
             echo "SAR ".$ret['result'][$i]->SAR;
           }
           else if($this->session->userdata('currencycode') == 'QAR')
           {
             echo "QAR ".$ret['result'][$i]->QAR;
           }
           else if($this->session->userdata('currencycode') == 'EUR')
           {
             echo "EUR ".$ret['result'][$i]->EUR;
           }
           else if($this->session->userdata('currencycode') == 'AED')
           {
             echo "AED ".$ret['result'][$i]->AED;
           }
           else if($this->session->userdata('currencycode') == 'AUD')
           {
             echo "AUD ".$ret['result'][$i]->AUD;
           }
           else
           {
             //echo $this->session->userdata('currencycode')."";

             //echo ceil(( $image['result'][$i]->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
           }
           ?>

         </div>

      </div>
		<?php }
	  $i=$i+1;} ?>
    </div>
   <div class="customNavigation" style="position:relative">
      <a class="btn prev"></a>
      <a class="btn next"></a>
      <!-- <a class="btn play">Autoplay</a>
         <a class="btn stop">Stop</a> -->
   </div>
</div>
<div class="gap10"></div>
<!-- testimonial  -->
<div class="row">
<div class="container-fluid new-arrival wow fadeIn" data-wow-delay=".3s">
   <!-- <div class="row text-center" >
   <h2 class="title_new"><span>Recent reviews from happy customers</span> </h2>

   </div> -->
    <div class="row rewiev_1" >
 <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" >
 <section id="carousel">

			<h3>Recent reviews from happy customers</h3>
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
				<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
				  <!-- Carousel indicators -->
                 <!--  <ol class="carousel-indicators">
				    <li data-target="#fade-quote-carousel" data-slide-to="0"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="2" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="3"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="4"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="5"></li>
				  </ol> -->
				  <!-- Carousel items -->

				  <div class="carousel-inner review-carousel">
				    <div class="item">
                        <!--<div class="profile-circle" style="background-color: rgba(0,0,0,.2);"></div>-->
				    	<blockquote>
				    		<p>I love my husbands shirts, good job
                            <span>- Nazli Shah, <strong>IND</strong></span>
                            </p>
				    	</blockquote>
				    </div>
				    <div class="item">
                        <!--<div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>-->
				    	<blockquote>
				    		<p>I ordered 4 shirts from these people, the service was cooperative and prompt. Good job.
                            <span>- Suhrid Chaudhary, <strong>IND</strong></span>
                            </p>
				    	</blockquote>
				    </div>
				    <div class="active item">
                      <!--  <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>-->
				    	<blockquote>
				    		<p>Wide range of fabrics at reasonable price , they had provided me with great discount and offers. <span> - Shweta Shetty <strong>IND</strong></span></p>

				    	</blockquote>
				    </div>
                    <div class="item">
                        <!--<div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>-->
    			    	<blockquote>
				    		<p>Great fabric collection, excellent quality.
                            <span>- Sushanta Das, <strong> IND</strong></span>
                            </p>
                        </blockquote>
				    </div>
                    <div class="item">
                        <!--<div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>-->
    			    	<blockquote>
				    		<p>Wide range of finest fabrics and best fittings... the best service... all the best team Stylior.
                            <span> - Sheroon pasha, <strong> IND</strong></span>
                            </p>
				    	</blockquote>
				    </div>
                    <div class="item">
                      <!--  <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div> -->
    			    	<blockquote>
				    		<p>Wide  range of fabrics with very good customization options at very reasonable price .The stylior website and the customization process is very user friendly Will surely recommend it to others as well .
                             <span> -  Rohit Singh, <strong> IND</strong></span>
                            </p>
				    	</blockquote>
				    </div>
                    <!-- <div class="item">
                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
    			    	<blockquote>
				    		<p>fantastic fabric range, great fits...awesome experience.....addicted to Stylior.....
                             <span>- Uttam Chaudhari, <strong> IND</strong></span>
                            </p>
				    	</blockquote>
				    </div>-->
				  </div>
                  <!-- Controls -->
                   <!-- Carousel arrow -->
  <!--<a class="left carousel-control test" href="#fade-quote-carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control test" href="#fade-quote-carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a> <!-- Carousel arrow -->
				</div>


</section>
 </div>
  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" >
  </div>

   </div>
</div>
</div>
<!-- testimonial end -->
<div class="gap20"></div>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<div class="home_delivery">
<h3>Home Delivery</h3>
<p>On all Orders</p>
</div>
</div>
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<div class="alteration">
<h3>Free Alteration</h3>
<p>Needing a Change?
have your item altered
for free</p>
</div>
</div>
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<div class="free_returns">
<h3>Hassle Free Returns</h3>
<p>Send Back directly to us.</p>
</div>
</div>
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<div class="assistance">
<h3>Need assistance?</h3>
<p>Support@stylior.com<br>
+91 8055 670 670</p>
</div>
</div>
</div>
</div>

<script>
  $(document).ready(function(){
    $("#myCarousel").carousel({
        interval : 10000,
       // pause: false
    });


});
 </script>
