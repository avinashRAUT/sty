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


<?php

$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";

?>
 <!-- Carousel
    ================================================== -->


<!--slider section-->
	<div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#home-slider" data-slide-to="0" class="active"></li>
        <li data-target="#home-slider" data-slide-to="1"></li>
      </ol>
    <!-- Wrapper for slides -->
    	<div class="carousel-inner">
        	<div class="item active">
            	<img src="<?= base_url() ?>images/home/slider_1.jpg" alt="slider" class="img-responsive hidden-xs hidden-sm">
                <img src="<?= base_url() ?>images/home/slider_1_mobile.jpg" alt="slider" class="img-responsive visible-xs visible-sm">
                <div class="carousel-caption">
                    <h1 class="animated fadeInLeftBig">Your style <span>your fit</span></h1>
                    <p class="animated fadeInRightBig">Create your own custom shirt</p>
                    <a href="<?= $bas_ul ?>mens-suits" class="btn slider-shopbtn">shop now</a>
                </div>
            </div>
            <div class="item">
            	<img src="<?= base_url() ?>images/home/slider_2.jpg" alt="slider" class="img-responsive hidden-xs hidden-sm">
                <img src="<?= base_url() ?>images/home/slider_2_mobile.jpg" alt="slider" class="img-responsive visible-xs visible-sm">
                <div class="carousel-caption">
                    <h1 class="animated fadeInLeftBig">Custom Menswear</h1>
                    <p class="animated fadeInRightBig">With the thoughtful options we provide for each customization your outfit standout in the crowd to your individuality.</p>
                    <a href="<?= $bas_ul ?>custom-suit" class="btn slider-shopbtn">shop now</a>
                </div>
            </div>
        </div>
        
    </div>	
<!--slider section-->




<section class="content-wrap">
	<!--first section-->
    <div class="row">
        <div class="cust_shop design-section2 col-sm-push-4 col-sm-4 col-xs-12">
            <div class="text-content">
                <h2>Design the perfect suits</h2>
                <p>Select from over 500 fabrics and dozens of style options. Shirts are made to order in your custom size and deliveredin just 2–3 weeks.</p>
                
                <h3>How it Works</h3>
				<img src="<?= base_url() ?>images/home/fabric.png" alt="Shirts">
				<a href="<?= $bas_ul ?>custom-blazer" alt="design your blazer"><span class="btn btn-default-gray">Design Your Blazer.</span></a>
            </div>
            <img src="<?= base_url() ?>images/home/blank-space.gif">
        </div>
    
        <div class="cust_shop home_design design-section1 cfadeInLeftBig col-sm-4 col-sm-pull-4 col-xs-12">
            <img src="<?= base_url() ?>images/home/home-shirt-shop.jpg" alt="Stylior">
            <div class="cust_shop_overlay">
                <h2>Design your </h2>
                <h1>classic shirt</h1>
               <a href="<?= $bas_ul ?>mens-shirts"> <span class="btn shop-now">Shop Now</span></a>
            </div>
        </div>
    
        <div class="cust_shop home_design design-section3 animated fadeInRightBig col-sm-4 col-xs-12">
            <img src="<?= base_url() ?>images/home/home-suit-shop.jpg" alt="Stylior">
            <div class="cust_shop_overlay">
                <h2>make the best impression with</h2>
                <h1>bespoke suits</h1>
                <a href="<?= $bas_ul ?>custom-suit"><span class="btn shop-now">Shop Now</span></a>
            </div>
        </div>
    </div>
    <!--first section-->
    <!--second section-->
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 wow animated fadeInLeft">
            	<img src="<?= base_url() ?>images/home/store_locator.jpg" class="img-responsive" alt="Store">
            </div>
        </div>
    </div>
    <!--second section-->
    
    <!--third section-->
     <div class="row">
     <!-- NEW ARRIVAL -->
    <div class="container new-arrival wow fadeIn" data-wow-delay=".3s">
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
          <a class="btn prev arrow"><i class="fa fa-angle-left"></i></a>
          <a class="btn next arrow"><i class="fa fa-angle-right"></i></a>
          <!-- <a class="btn play">Autoplay</a>
             <a class="btn stop">Stop</a> -->
       </div>
    </div>
     </div>
     
    <!--third section-->
    
    <div class="row home_shop_cloths">
        <a href="">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 shop-div">
                <img src="<?=base_url() ?>images/home/vests-shop.jpg" alt="shop" class="img-responsive">
                <div class="home_shop_overlay">
                   <a href="<?= $bas_ul ?>mens-vests" alt="Design your vest"> <h1>Vest</h1></a>
                </div>
            </div>
        
        </a>
        <a href="">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 shop-div">
                <img src="<?=base_url() ?>images/home/trouser-shop.jpg" alt="shop" class="img-responsive">
            <div class="home_shop_overlay">
                <h4>comfort and style at it's best</h4>
               <a href="<?= $bas_ul ?>mens-trousers"><h1>custom trouser</h1>
            </div>
            </div>
        </a>
        <a href="">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 shop-div">
                <img src="<?=base_url() ?>images/home/acccessories-shop.jpg" alt="shop" class="img-responsive">
            <div class="home_shop_overlay">
                <a href="<?= $bas_ul ?>mens-ties"><h1>Accessories</h1>
            </div>
            </div>
        </a>
    </div>
    
    <!--third section End-->
	<!--book an appointment-->
	<div class="row book_appointment">
        <div class="col-md-6 col-sm-12 ba-left no-padding">
        	<img src="<?=base_url() ?>images/home/book_appointment.jpg" alt="shop" class="img-responsive">
        </div>
        <div class="col-md-6 col-sm-12 ba-right">
        	<div class="">
          		<h1>AS EXPERIENCE  AS CUSTOM  AS YOUR SUIT</h1>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-sm-12 ba-contents">
                    	<div class="div-ba">
                            <div class="icon_box_icon home-visit">
                                <span class="sprite"></span>
                            </div>
                            <div class="icon-box-content">
                                <h4>book a free home visit</h4>
                                <p>(only mumbai & dubai)</p>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="col-md-4 col-sm-4 ba-contents">
                    	<div class="div-ba">
                            <div class="icon_box_icon visit-stylist">
                                <span class="sprite"></span>
                            </div>
                            <div class="icon-box-content">
                                <h4>visit stylist</h4>
                                <p>our travelling stylist will help you to get measurement, choose fabrics and style options as per your convenience.</p>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="col-md-4 col-sm-4 ba-contents">
                    	<div class="div-ba">
                            <div class="icon_box_icon free-shipping">
                                <span class="sprite"></span>
                            </div>
                            <div class="icon-box-content">
                                <h4>free shipping and easy returns</h4>
                                <p>it's a 15 days free return policy which works in three stages: alteration | remake | return</p>
                            </div>
                        </div> 
                    </div>
               
                </div>
                <h4 class="free-home-visit">Your Personal Stylist @ Your Premises</h4>
<!--                <p class="content">Enjoy the luxuries of getting an awe inspiring fashion make over and stupendous styling 
                at your doorstep. Book an appointment with our trend setting panel of travelling stylist 
                with no additional costs. Just pay for the fabric and dive in to the sea of fashion. Now book 
                an appointment service is available in Dubai and Mumbai.</p>-->
                <a href="<?= $bas_ul ?>book-a-home-visit" alt="book a home visit" class="btn book-now">book now</a>
            </div>
        </div>
    </div>
    
    
    <!--    home-services-->
    <div class="row home-services">
        <div class="col-md-3 home-delivery services">
            
                <div class="icon-image">
                    <span class="sprite"></span>
                </div>
                <h4>Home Delivery</h4>
                <p>On all Orders</p>
            
        </div>
        <div class="col-md-3 free-alteration services">
            
                <div class="icon-image">
                    <span class="sprite"></span>
                </div>
                <h4>Free Alteration</h4>
                <p>Needing a Change? have your item altered for free</p>
            
        </div>
        <div class="col-md-3 free-returns services">
            
                <div class="icon-image">
                    <span class="sprite"></span>
                </div>
                <h4>Hassle Free Returns</h4>
                <p>Send Back directly to us.</p>
            
        </div>
        <div class="col-md-3 help services">
            
                <div class="icon-image">
                    <span class="sprite"></span>
                </div>
                <h4>Need assistance?</h4>
                <p>Support@stylior.com <br>+91 8055 670 670</p>
            
        </div>
    </div>
	<!-- home-services -->
    
</section>





<script>
  $(document).ready(function(){
    $("#myCarousel").carousel({
        interval : 10000,
       // pause: false
    });


});
 </script>
