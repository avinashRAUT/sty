<?php
if ($_SERVER['HTTPS'] == "on")
{

$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";
}
else {
$https_url_large_img="http://www.stylior.com/upload/products1/large/";

}


?>

<title> Online Custom Made, Tailored Shirts For Men at Stylior Fashion, India</title>
<meta name="keywords" content="Custom Made Shirts, Tailored Shirts, Custom Shirts, Mens, Customization, Suits, Online, Best, Fashion, Stylior Fashion, India">
<meta name="description" content="Stylior Fashion is specialized in Custom made tailored shirts for Men. If you   wanna design your own Shirt please visit us.">
<!-- Bootstrap -->

  <style>
    .wow:first-child {
      visibility: hidden;
    }

  </style>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

</head>

<!-- new navbar design -->
<style type="text/css">

.image_off, .image_action:hover .image_on{
   display:none;
}
a.image_action {
  display:block; text-decoration:none; text-align:center; color:rgba(79,79,79,1.00); border:1px solid #fff}
a.image_action:hover {border:1px solid #E4E4E4;}
p.suit-info {
  background-color:#fff; display:block;font-size: 16px;text-align:center; margin-bottom:0; padding-top:10px;min-height: 95px;}
p.suit-info span{
  background-color:#fff; font-size:14px;color:#DD0003; display:block;padding:5px 0;    font-weight: bold;
}
a.image_action:hover p.suit-info {background-color:#e6e6e6; }
a.image_action:hover p.suit-info span{background-color:#e6e6e6;}
a.image_action h4 {
  font-size:16px; font-weight:bold; border:1px solid #fff;}
a.image_action:hover h4 {
  background-color:#E4E4E4; color:#fff}
.image_on, .image_action:hover .image_off{
   display:block;
}
.suit-banner {
  /*background-image:url("<?=base_url() ?>images/suit-banner.jpg"); */background-repeat:no-repeat; background-position:top right; margin-bottom:30px; }
.suit-banner h3 {
  background-color:rgba(255,255,255,.7); padding:10px 35px; margin-top:25px; display:inline-block; clear:both; }
.suit-banner p{
  background-color:rgba(255,255,255,.7); padding:10px 35px; margin-top:25px; display:inline-block; font-size:18px
  }
  @media (min-width: 1600px){
.container {
    width: 1500px;
}
}
/*p.suit-info{
  text-align:center; text-decoration:none; font-size:14px; display:block }
p.suit-info h4{
  font-size:16px !important; font-weight:bold}*/
</style>
<div class="container-fluid">
<div class="row">

<div class="suit-banner hidden-xs">

  <img class="img-responsive" src="<?=base_url() ?>images/img/shirt-category.jpg"  alt=" Custom Made Shirts Online"/>
</div>
<div class="suit-banner visible-xs">
 
  <img class="img-responsive" src="<?=base_url() ?>images/img/sirts-category-mobile.jpg" alt=" Custom Made Shirts Online"/>
</div>
</div>
</div>
<h1 class="hide">Custom Made Shirts Online</h1>
<div class="container">
    <div class="row suit_css">
<?php
foreach($details as $shirt)
{
?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
<a class="image_action" href="<? echo $base_ul."/mens-shirts/".str_replace(' ','-',$shirt->pname)."-".$shirt->pid; ?>"> <img  class="img-responsive image_on" src="<?php echo $https_url_large_img.$shirt->image;?>"  alt="<?= $shirt->pname ?>"/>
        <?php if($shirt->discount > 0){ ?>
          <div class="disc_per">
          <?php echo $shirt->discount>0?$shirt->discount:""; ?>% off
          </div>
        <?php } ?>
        <img  class="img-responsive image_off" src="<?php echo $https_url_large_img.$shirt->image;?>"   alt=""/>
        <p class="suit-info discount_prod">
  <?php echo $shirt->pname ?></p>
  <p class="discount_prod">
  <span class="original_price">
      <?php 
      $strike_start=($shirt->discount>0?"<strike>":""); 
      $strike_end=($shirt->discount>0?"</strike>":""); 
      echo $strike_start;
      ?>
      <?php
        // print_r($shirt->discount);
        if($this->session->userdata('currencycode')=="" ||$this->session->userdata('currencycode') == 'INR')
        {
          echo "INR ".$shirt->price;
        }
        else if($this->session->userdata('currencycode') == 'USD')
        {
          echo "USD ".$shirt->USD;
        }
        else if($this->session->userdata('currencycode') == 'BHD')
        {
          echo "BHD ".$shirt->BHD;
        }
        else if($this->session->userdata('currencycode') == 'SAR')
        {
          echo "SAR ".$shirt->SAR;
        }
        else if($this->session->userdata('currencycode') == 'QAR')
        {
          echo "QAR ".$shirt->QAR;
        }
        else if($this->session->userdata('currencycode') == 'EUR')
        {
          echo "EUR ".$shirt->EUR;
        }
        else if($this->session->userdata('currencycode') == 'AED')
        {
          echo "AED ".$shirt->AED;
        }
        else if($this->session->userdata('currencycode') == 'AUD')
        {
          echo "AUD ".$shirt->AUD;
        }
        else
        {
          //echo $this->session->userdata('currencycode')."";
          //echo ceil(( $image['result'][$i]->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
        }
      echo $strike_end;
  
  ?>
  
  </span>

  <?php 
  /*var : stared for discount offer*/

  if($shirt->discount>0){
    $price_of_product=$shirt->{$this->session->userdata('currencycode')};
    $discount_value = $shirt->discount;   
    $discount_value = round((($price_of_product*$shirt->discount)/100));
    $price_of_product=$price_of_product-$discount_value;
    echo "<span class='dis_price'>".$this->session->userdata('currencycode')." ".$price_of_product."</span>";
   }

  /*var : end*/
  ?>

  </p></a>
  </div>
<? } ?>
</div>

<nav aria-label="Page navigation example " class="stylior-pagination">
  <?php 
  echo $links; 
  ?>
</nav>

</div>
