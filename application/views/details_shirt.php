<?php

if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/";
}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/";
}

?>

<?php

	if($_SESSION['currencycode'] == '')
	{
	$inr = 'INR';
 	$_SESSION['currencyvalue'] = '1';
	$_SESSION['currencycode'] = $inr;
	}
	else
	{
	$inr = $_SESSION['currencycode'];
	}

	foreach($c as $cmsf)
	{
		$title = $cmsf->title;
		$proname = $cmsf->pname;
		$proid = $cmsf->pid;
		$threadcount = $cmsf->threadcount;
		$colour = $cmsf->colourname;
		$fabricid = $cmsf->fname;
		$designid = $cmsf->designname;
    $itemcode = $cmsf->itemcode ;
		$prodescr = $cmsf->description;
		$prodimage = $https_url_large_img."".$cmsf->image;;
  }

?>


  <style>

/*var added*/
.wish_message{
  padding: 2px !important;
}

    .wow:first-child {
      visibility: hidden;
    }
ul.hide-bullets { padding-left:0;}
ul.hide-bullets li {
	list-style:none;display:block}
.carousel-control.left {
	top:0}
.carousel-control.right {
	top:0}

.glyphicon-chevron-left:before {
	content:url("<?=base_url() ?>images/quick/left.jpg");}
.glyphicon-chevron-right:before {
		content:url("<?=base_url() ?>images/quick/right.jpg");
	}
	.cuff_select {
		border: 1px solid #fff; text-align:center;
	}
	.panel-body ul li {
    padding-bottom: 10px;
}

.modal-body {
max-height:500px; overflow-y:scroll}
  </style>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=137656346694782";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<input type="hidden" value="<?= $cmsf->pname;?>" id="prd_namme"/>
<input type="hidden" value="<?= $cmsf->price;?>" id="prd_price"/>
<input type="hidden" value="<?= $cmsf->pid;?>" id="prd_id"/>

<div class="container">

  <div class="gap10"></div>
	<div class="row">

		<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">

        <div class="col-sm-2 hidden-xs" id="slider-thumbs">
                <!-- Bottom switcher of slider -->

                <ul class="hide-bullets">
                	   <?php
                	    $i = 0 ;
                    foreach($c as $cmsf)
		  				      {
            					if($i==0){?>
                    <li>
                        <a class="thumbnail" id="carousel-selector-0">
                        <img src="<?= $https_url_large_img."".$cmsf->image;?>" /> </a>
                    </li>
                    	<?php
                    	}
                    	else 
                    		{?>
                     <li>
                        <a class="thumbnail" id="carousel-selector-<?= $i ?>">
                        <img src="<?= $https_url_large_img."".$cmsf->image;?>" /> </a>
                    </li>
                    	<?php
                    	}?>
                    <?php
                    $i++;
                    }?>
                </ul>

            </div>
         <div class="col-sm-10 col-xs-12">
                <div class="col-xs-12" id="slider">
                    <!-- Top part of the slider -->
                    <div class="row">
                        <div class="col-sm-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                	 <?php
                	    			$i = 0 ;// i is a counter value to pick active item
                	   				foreach($c as $cmsf)
		  							{
		  							if($i==0){?>
                                    <div class="active item" data-slide-number="0">
                                      <img src="<?= $https_url_large_img."".$cmsf->image;?>" class="image-zoom img-responsive" alt=""/></div>
                                    <?php
                    				}
                    				else
                    				{?>
                    				<div class="item" data-slide-number="1">
                                      <img src="<?= $https_url_large_img."".$cmsf->image;?>" class="image-zoom img-responsive" alt=""/></div>

                                        	<?php
                    					}?>
                    				<?php
                    			$i++;
                    }?>


                              </div>
                                <!-- Carousel nav -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"  style="left: -10px;">

                                    </span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"   style="right: -10px;">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      </div>

     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
        <div class="product-title-wishlist product_discount_offer"><?php echo $proname;?>

		<p class="product_price">
		
    <span class="original_price">
    <?php 
        
        $strike_start=($cmsf->discount>0?"<strike>":""); 
        $strike_end=($cmsf->discount>0?"</strike>":""); 
          echo $strike_start;

     ?>
    <?php
      if($this->session->userdata('currencycode')=="" ||$this->session->userdata('currencycode') == 'INR')
			{
				echo "INR ".$cmsf->price;
			}
			else if($this->session->userdata('currencycode') == 'USD')
			{
				echo "USD ".$cmsf->USD;
			}
			else if($this->session->userdata('currencycode') == 'BHD')
			{
				echo "BHD ".$cmsf->BHD;
			}
			else if($this->session->userdata('currencycode') == 'SAR')
			{
				echo "SAR ".$cmsf->SAR;
			}
			else if($this->session->userdata('currencycode') == 'QAR')
			{
				echo "QAR ".$cmsf->QAR;
			}
			else if($this->session->userdata('currencycode') == 'EUR')
			{
				echo "EUR ".$cmsf->EUR;
			}
			else if($this->session->userdata('currencycode') == 'AED')
			{
				echo "AED ".$cmsf->AED;
			}
			else if($this->session->userdata('currencycode') == 'AUD')
			{
				echo "AUD ".$cmsf->AUD;
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
          if($cmsf->discount>0){
            $price_of_product=$cmsf->{$this->session->userdata('currencycode')};
            $discount_value = round((($price_of_product*$cmsf->discount)/100));
            $price_of_product=$price_of_product-$discount_value;
            echo "<span class='dis_price'>".$this->session->userdata('currencycode')." ".$price_of_product."</span>";
        }
        /*var : end*/
      ?>
</p>

		</div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Product Details
                    </a>
                </h4>
            </div>
            
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                      <!-- <h3>DETAILS </h3> -->
                      <ul>
                      <li><strong>Description :</strong> <?php echo $prodescr;?></li>
                      <li><strong>Fabric :</strong> <?php echo $fabricid;?></li>
                      <li><strong>Pattern :</strong> <?php echo $designid;?></li>
                      <li><strong>Colour :</strong> <?php echo $colour;?></li>
                      <li><strong>Thread Count :</strong> <?php echo $threadcount;?></li>

                      <li><strong>Item Code :</strong> <?php echo $itemcode;?></li>

                      <li><strong>Free Shipping :</strong> We provide free shipping globally. </li>

                      <li><strong>Alterations & Returns :</strong> 
        Stylior promises perfect fit guarantee. If it doesn't fit
        we provide free alteration, or remake for the outfits we produce.
  </li>
                          </ul>
                </div>
            </div>
        </div>


          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                      Collar
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
              <div class="panel-body ">

                 <div class="row collarselect">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                       <div class="collar_select active" id="Regular"> <img src="<?=base_url() ?>images/quick/c-1.jpg" width="100" height="100" alt=""/>
                        Regular</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                       <div class="collar_select" id="Big_Round"><img src="<?=base_url() ?>images/quick/c-2.jpg" width="100" height="100" alt=""/>
                        Big Round
                        </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                       <div class="collar_select" id="Button_Down"><img src="<?=base_url() ?>images/quick/c-3.jpg" width="100" height="100" alt=""/>
                       Button Down</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="collar_select" id="Cut_Away"><img src="<?=base_url() ?>images/quick/c-4.jpg" width="100" height="100" alt=""/>
                        Cut Away</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                       <div class="collar_select" id="Wide_Spread"><img src="<?=base_url() ?>images/quick/c-5.jpg" width="100" height="100" alt=""/>
                        Wide Spread</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="collar_select" id="Stand"><img src="<?=base_url() ?>images/quick/c-6.jpg" width="100" height="100" alt=""/>
                        Stand</div>
                        </div>
                </div>
               <a class="info" id="collar" data-toggle="modal" data-target="#myModalCollar"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>
            </div>
        </div>
    </div>

		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTen">
					<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
									<i class="more-less glyphicon glyphicon-plus"></i>
								Cuffs
							</a>
					</h4>
			</div>
			<div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
				<div class="panel-body ">

					 <div class="row cuffselect">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								 <div class="cuff_select" id="Round"> <img src="<?=base_url() ?>images/cuffs/round.png" width="100" height="100" alt=""/>
									Round</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								 <div class="cuff_select" id="Angle"><img src="<?=base_url() ?>images/cuffs/angle.png" width="100" height="100" alt=""/>
									Angle
									</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								 <div class="cuff_select" id="Big_Round"><img src="<?=base_url() ?>images/cuffs/big_round.png" width="100" height="100" alt=""/>
								 Big Round</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<div class="cuff_select" id="Big_Angle"><img src="<?=base_url() ?>images/cuffs/big_angle.png" width="100" height="100" alt=""/>
									Big Angle</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								 <div class="cuff_select" id="Square"><img src="<?=base_url() ?>images/cuffs/square.png" width="100" height="100" alt=""/>
									Square</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<div class="cuff_select" id="French"><img src="<?=base_url() ?>images/cuffs/french.png" width="100" height="100" alt=""/>
									French</div>
									</div>
					</div>
				 <!--<a class="info" id="collar" data-toggle="modal" data-target="#myModalCollar"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
			</div>
	</div>
</div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                       Pockets
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
               <!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <div class="col-md-12">
  <div class="pocket-div details">
                  <div class="pocket_select active" id="Pocket">

                  <span>YES</span>
                  </div>

                  <div class="pocket_select" id="Nil">
                  <span>NO</span>
                  </div>

    </div>
  </div>
</div>
                 <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
              </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseFive">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                      Monogram
                    </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
              <div class="panel-body">
                <h3>Add Monogram</h3>
                <div class="monogram-div details">
                  <div class="monogram_select" id="Yes">

                  <span>YES</span>
                  </div>

                  <div class="monogram_select active" id="No">
                      <span>NO</span>
                  </div>

                </div>
            <div class="monogram_options">
                <div class="gap10"></div>
              <hr>
                <h3>Color</h3>
                <div class="monogram-div">
                <ul class="monogram">
                <li><div class="monogram_color_select" id="Black"><img src="<?=base_url() ?>images/quick/black.png" width="38" height="51" alt=""/></div></li>
                <li><div class="monogram_color_select" id="Blood_Red"><img src="<?=base_url() ?>images/quick/blood_red.png" width="38" height="51" alt=""/></div></li>
                <li><div class="monogram_color_select" id="Grey"><img src="<?=base_url() ?>images/quick/grey.png" width="38" height="51" alt=""/></div></li>
                  <li><div class="monogram_color_select" id="White"><img src="<?=base_url() ?>images/quick/white.png" width="38" height="51" alt=""/></div></li>
                <li><div class="monogram_color_select" id="Navy"><img src="<?=base_url() ?>images/quick/navy.png" width="38" height="51" alt=""/></div></li>
                <li><div class="monogram_color_select" id="Plum_Maroon"><img src="<?=base_url() ?>images/quick/plum_maroon.png" width="38" height="51" alt=""/></div></li>
                <li><div class="monogram_color_select" id="Royal_Blue"><img src="<?=base_url() ?>images/quick/royal_blue.png" width="38" height="51" alt=""/></div></li>
                </ul>
                </div>
              <div class="gap10"></div>
              <hr>
                  <h4>Font</h4>
                <div class="monogram-div text">
                <ul class="monogram">
                <li><div class="monogram_font_select" id="Archibald"><img src="<?=base_url() ?>images/quick/archibald.png" width="36" height="36" alt=""/> </div></li>
                <li><div class="monogram_font_select" id="Bodoni"><img src="<?=base_url() ?>images/quick/bodoni.png" width="36" height="36" alt=""/> </div></li>
                <li><div class="monogram_font_select" id="Caviar"><img src="<?=base_url() ?>images/quick/caviar.png" width="36" height="36" alt=""/> </div></li>
                <li><div class="monogram_font_select" id="Cylburn"><img src="<?=base_url() ?>images/quick/cylburn.png" width="36" height="36" alt=""/> </div></li>

                </ul>
                </div>
                 <div class="gap10"></div>
              <hr>
                  <h4>Monogram Location</h4>
                <div class="monogram-div location">
                    <ul class="monogram">
                        <li><div class="monogram_location_select" id="Cuff_Name_Horizontal"><img src="<?=base_url() ?>images/quick/cuff-name-horizontal.png" width="75" height="75" alt=""/> </div></li>
                        <li><div class="monogram_location_select" id="Pocket_Embroidery_Normal"><img src="<?=base_url() ?>images/quick/pocket_embroidery_normal.png" width="75" height="75" alt=""/> </div></li>
                        <li><div class="monogram_location_select" id="Sleeve_Placket_Top_Embroidery_Normal"><img src="<?=base_url() ?>images/quick/sleeve_placket_top_embroidery_normal.png" width="75" height="75" alt=""/> </a></li>
                        <li><div class="monogram_location_select" id="Top_Cuff_Embroidery_Normal"><img src="<?=base_url() ?>images/quick/top_cuff_embroidery_normal.png" width="75" height="75" alt=""/> </div></li>
                    </ul>
                </div>
                <div class="gap10"></div>
                <hr>
                  <h4>Monogram Text</h4>
                   <input type="text" class="mono-text" id="monogram_text" maxlength="3" placeholder=""></input>

                <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
            </div>
        </div>
        </div>
    </div><!-- panel-group -->

    <!-- panel-group -->
<!--
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Fit <span class="option_error" id="fit_error">Please select fit</span>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fittype_select" id="Slim">
                          <div data-toggle="tooltip" data-placement="left" data-html="true" class="active" title="SLIM FIT: This gives you an athletic and shaped fit featuring narrow sleeves, higher armholes and a slimmer cut to the body."><img src="<?=base_url() ?>images/quick/slim.gif" class="img-responsive img-center" width="100" height="100" alt=""  /><br>Slim</div>  <!---
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fittype_select" id="Tailored">
                         <div class="active" data-toggle="tooltip" data-placement="bottom" data-html="true"  title="TAILORED FIT: A more tailored and refined fit with fitted sleeves, comfortable armholes and a shaped body."><img src="<?=base_url() ?>images/quick/tailored.gif" width="100"  class="img-responsive img-center" height="100"  alt=""/><br>Tailored</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fittype_select" id="Regular">
                         <div class="active" data-toggle="tooltip" data-placement="left" data-html="true"  title="REGULAR FIT: This is a more relaxed and comfortable fit offering fuller sleeves, deeper armholes and an eased fit to the body."><img src="<?=base_url() ?>images/quick/regular.gif"  class="img-responsive img-center" width="100" height="100"  alt=""/><br>Regular</div>
                        </div>
                  </div>
                 <a class="info" id="fit" data-toggle="modal" data-target="#myModalFit"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>
              </div>
            </div>
        </div> -->

        <!--   <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Length <span class="option_error" id="length_error">Please select length</span>
                    </a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 length_select" id="Short">
                          <div data-toggle="tooltip" data-placement="left" data-html="true" class="active" title=""> <img src="<?=base_url() ?>images/straight-tail.png" class="img-responsive img-center" width="100" height="100" alt=""  /><br>Short</div>  <!--
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 length_select" id="Regular">
                         <div class="active" data-toggle="tooltip" data-placement="bottom" data-html="true"  title=""><img src="<?=base_url() ?>images/mid-tail.png" width="100"  class="img-responsive img-center" height="100"  alt=""/><br>Regular</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 length_select" id="High">
                         <div class="active" data-toggle="tooltip" data-placement="left" data-html="true"  title=""><img src="<?=base_url() ?>images/high-tail.png"  class="img-responsive img-center" width="100" height="100"  alt=""/><br>High</div>
                        </div>
                  </div>
                 <a class="info" id="length" data-toggle="modal" data-target="#myModalLength"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>
              </div>
            </div>
        </div> -->
        <!--Collar End -->

<!--         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                       Size <span class="option_error" id="size_error">Please select size</span>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body details">
                  <div class="size_select" id="36" >
                  36
                  </div>
                  <div class="size_select" id="38" >
                  38
                  </div>
                  <div class="size_select" id="40" >
                  40
                  </div>
                  <div class="size_select" id="42" >
                  42
                  </div>
                  <div class="size_select" id="44" >
                  44
                  </div>
                  <div class="size_select" id="46" >
                  46
                  </div>
                  <div class="size_select" id="48" >
                  48
                  </div>
                  <div class="size_select" id="50" >
                  50
                  </div>
                  <div class="size_select" id="52" >
                  52
                  </div>
                   <a class="info" id="size" data-toggle="modal" data-target="#myModalSize"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>
              </div>
            </div>
        </div> -->
        <!-- Size end -->


        </div>
        <div class="row">
        <div class="col-lg-4 col-md-4 add_wishlist">
        <a class="quick-c-btn sum">Wishlist</a>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 hidden-xs">
        <button type="button"  class="quick-c-btn sum" id="summary" data-toggle="modal" data-target="#myModal">Summary</button>
        </div>
        <div class="col-lg-4 col-md-4 buy_now">
        <a  class="quick-c-btn">buy now</a>
        </div>
        </div>

				<div class=gap10>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p>*Add measurement on checkout</p>
              <div class="wish_added"></div>
					</div>
				</div>
				<div class="social-btns">
        <ul>
        <li >  <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="social-link js-social-link" target="_blank">

					<i class="fa fa-facebook "></i>
					</a>
</li>
        <li>  <a href="<?php echo 'https://twitter.com/intent/tweet/?text='. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'&amp;via=stylior.com&amp;source=webclient'; ?>" class="social-link js-social-link" target="_blank">

					<i class="fa fa-twitter fa-stack-1"></i>
					</a></li>
        </ul>
			</div>
    </div>

    </div>

</div>


<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Summary</h4>
        </div>
        <div class="modal-body" id="summary_options">

        </div>

      </div>

    </div>
</div>

<div class="modal fade" id="myModalCollar" role="dialog">
	<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

 <!-- Modal content-->
 <div class="modal-content">
	 <div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal">&times;</button>
		 <h4 class="modal-title">Collar Info</h4>
	 </div>
	 <div class="modal-body" id="collar_options">
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-1.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Regular</strong><br>
The classic, regular collar is still up to date and worn by many men. Similar to the cutaway collars, they work out with every outfit. They can be worn with a pair of jeans or trousers for the classic and enthralling style.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-2.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Big Round</strong><br>
The big round collar is quite narrow and shortly cut. It reflects a chilled out personality. The edges of the collar are blunt and softened, instead of being sharp and pointed like most collars. These collars can be donned both casually and formally. They are best worn under dinner jackets, giving the kicked-back but equivalently formal look.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-3.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Button Down</strong><br>
The cuffs of these collars are softly rolled downwards and pressed onto the shirt. They were originally worn by polo players. Due to its origin in sports, it may seem to be the least fashionable collar. However, pairing it with the right kind of outfit can relinquish the fashion of the collar. It can be worn well with or without a tie.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-4.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Cutaway </strong><br>
The cutaway collar is a famous and preliminary collar design originating from England. You can never go wrong with cutaways. They can be worn with everything. You name it. A pair of casual jeans, a dinner suit, a breakfast suit or even a tuxedo. They are incredibly dressy and stylish when paired with formal wear.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-5.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Wide Spread  </strong><br>
The wide spread collar is a professionally worn shirt collar. A plain, skinny tie accentuates the look of the shirt. The wide spread collar goes well with fancy or subtle dress shirts alike. Half-windsor knots go best with this type of collar.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-6.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Stand  </strong><br>
The circular stand collar is the latest style these days. Quaint and elegant, it can be sported casually or formally, like all collars. It still looks stylish without the additional tie and has no edges on the cuff. It provides a dapper, chiselled look to each and every shirt.
<p>
</div>
</div>

	 </div>

 </div>

</div>
</div>
</div>



    <div class="modal fade" id="myModalSize" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Size Guide</h4>


        </div>
        <div class="modal-body" id="collar_options">
          <div class="table-responsive-d">
  <table width="100%">
    <thead>
      <tr>
        <th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th><th>5XL</th>
      </tr>
    </thead>
    <tbody>
    <tr>
      <td >36</td><td>38</td><td>40</td><td>42</td><td>44</td><td>46</td><td>48</td><td>50</td><td>52</td>
    </tr>
     <tr>
      <td >14.5</td><td>15</td><td>15.5</td><td>16</td><td>16.5</td><td>17</td><td>17.5</td><td>18</td><td>18.5</td>
    </tr>
  </tbody>
  </table>
</div>
        </div>

      </div>

    </div>
</div>
<div class="modal fade" id="myModalCollar" role="dialog">
	<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

 <!-- Modal content-->
 <div class="modal-content">
	 <div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal">&times;</button>
		 <h4 class="modal-title">Collar Info</h4>
	 </div>
	 <div class="modal-body" id="collar_options">
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-1.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Regular</strong><br>
The classic, regular collar is still up to date and worn by many men. Similar to the cutaway collars, they work out with every outfit. They can be worn with a pair of jeans or trousers for the classic and enthralling style.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-2.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Big Round</strong><br>
The big round collar is quite narrow and shortly cut. It reflects a chilled out personality. The edges of the collar are blunt and softened, instead of being sharp and pointed like most collars. These collars can be donned both casually and formally. They are best worn under dinner jackets, giving the kicked-back but equivalently formal look.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-3.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Button Down</strong><br>
The cuffs of these collars are softly rolled downwards and pressed onto the shirt. They were originally worn by polo players. Due to its origin in sports, it may seem to be the least fashionable collar. However, pairing it with the right kind of outfit can relinquish the fashion of the collar. It can be worn well with or without a tie.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-4.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Cutaway </strong><br>
The cutaway collar is a famous and preliminary collar design originating from England. You can never go wrong with cutaways. They can be worn with everything. You name it. A pair of casual jeans, a dinner suit, a breakfast suit or even a tuxedo. They are incredibly dressy and stylish when paired with formal wear.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-5.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Wide Spread  </strong><br>
The wide spread collar is a professionally worn shirt collar. A plain, skinny tie accentuates the look of the shirt. The wide spread collar goes well with fancy or subtle dress shirts alike. Half-windsor knots go best with this type of collar.
<p>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-3">
<img src="<?=base_url() ?>images/quick/c-6.jpg" width="100" height="100" alt=""/>
</div>
<div class="col-md-9 col-sm-9 col-xs-9">
<p>
<strong>Stand  </strong><br>
The circular stand collar is the latest style these days. Quaint and elegant, it can be sported casually or formally, like all collars. It still looks stylish without the additional tie and has no edges on the cuff. It provides a dapper, chiselled look to each and every shirt.
<p>
</div>
</div>

	 </div>

 </div>

</div>
</div>
</div>
<div class="modal fade" id="myModalFit" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Getting the best fit easily</h4>
        </div>
        <div class="modal-body" id="fit_options">
          <p>We offer three fits. </p>
          <p><strong>SLIM FIT:</strong>  This gives you an athletic and shaped fit featuring narrow sleeves, higher armholes and a slimmer cut to the body.</p>
          <p><strong>TAILORED FIT:</strong>  A more tailored and refined fit with fitted sleeves, comfortable armholes and a shaped body.</p>
          <p><strong>REGULAR FIT:</strong> This is a more relaxed and comfortable fit offering fuller sleeves, deeper armholes and an eased fit to the body.</p>
        </div>

      </div>

    </div>
</div>
<div class="modal fade" id="myModalLength" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Shirt Length: </h4>


        </div>
        <div class="modal-body" id="length_options">
          <p>Stylior lets you choose the length of your shirt to get the perfect fit. We offer 3 lengths to match the body height.</p>
          <p><strong>SHORT:</strong>  This will give you a length of 29.5 inches from the top of the centre back of the shirt and will cover the body length of 5ft 6in to 5 ft 8in.</p>
          <p><strong>REGULAR: </strong>With a length of 31.0 inches this will provide required shirt length for a body height of 5 ft 8in to 6 ft.</p>
          <p><strong>TALL:</strong> With an extra length of 32.5 inches this will cover the tallest body shapes who are above 6ft.</p>
        </div>

      </div>

    </div>
</div>
</div>


<?php $uid=$_SESSION['user_id']; if(isset($uid)){?>
<div style="max-width:inherit !important;" class="remodal" data-remodal-id="shirt_measurements" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc"  data-remodal-options="closeOnEscape:false,closeOnOutsideClick: false">
<?php include("measurements-shirt.php");?>
</div>
<?php }?>

<script src="<?=base_url() ?>js/simple-lightbox.min.js"></script>

<!-- <script src="js/owl.carousel.js"></script> -->
 <!-- <script src="js/jquery.mb.YTPlayer.js"></script>  -->

<script type="text/javascript" src="<?=base_url() ?>js/cloud-zoom.js"></script>
<script src="<?=base_url() ?>js/jquery.images-ready.js"></script>
<script src="<?=base_url() ?>js/jquery.projector.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/wow.js"></script>
<script type="text/javascript">
 function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>

<script type="text/javascript">
  $("[data-toggle=tooltip]").tooltip();
</script>
<script type="text/javascript">


jQuery(document).ready(function($) {



        $('#myCarousel').carousel({
                interval: 5000000
        });

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});
</script>

<script>
      var shirtDimension={"collar":"Regular","cuff":"Round", "pocket":"Pocket", "Monogram":"No", "MonoLocation":"", "Monofontstyle":"", "Monocolor":"", "Monotext":"None", "fitype":"None", "standardsize":"None", "length":"None","product_details_page":"<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",};

      $(document).ready(function () {

      $(".image-zoom").simpleLightBox();
      $('.monogram_options').hide();
      $('.option_error').hide();
      /*shahjaz writing here*/
      console.log("This is testing");
      $(".collar_select").on("click",function(){
        console.log("This is testing id :"+this.id);
        shirtDimension.collar=this.id.replace(/_/g, ' ');
         $('.collar_select').removeClass('active');
         $(this).addClass('active');
      });

      $(".cuff_select").on("click",function(){
        console.log("This is testing id :"+this.id);
        shirtDimension.cuff=this.id.replace(/_/g, ' ');
         $('.cuff_select').removeClass('active');
         $(this).addClass('active');
       });

      /*  $(".fittype_select").on("click",function(){
      console.log("This is fittype id :"+this.id);
      shirtDimension.fitype=this.id.replace(/_/g, ' ');

      $('.fittype_select').removeClass('active');
      $(this).addClass('active');
      $('#fit_error').removeClass('option_error');
      $('#fit_error').hide();
      });

      $(".length_select").on("click",function(){
      console.log("This is fittype id :"+this.id);
      shirtDimension.length=this.id.replace(/_/g, ' ');

      $('.length_select').removeClass('active');
      $(this).addClass('active');
      $('#length_error').removeClass('option_error');
      $('#length_error').hide();
      });*/

      $(".pocket_select").on("click",function(){
        console.log("This is pocket option  :"+this.id);
        shirtDimension.pocket=this.id.replace(/_/g, ' ');

         $('.pocket_select').removeClass('active');
        $(this).addClass('active');

      });

      $(".monogram_select").on("click",function(){
        console.log("This is Monogram option  :"+this.id);
        shirtDimension.Monogram=this.id.replace(/_/g, ' ');
        if(shirtDimension.Monogram=="No")
        {
          shirtDimension.Monocolor="";
          shirtDimension.MonoLocation="";
          shirtDimension.Monofontstyle="";
          shirtDimension.Monotext = "";
          $('.monogram_color_select').removeClass('active');
          $('.monogram_location_select').removeClass('active');
          $('.monogram_font_select').removeClass('active');
          $('.monogram_options').hide();
        }
         if(shirtDimension.Monogram=="Yes")
        {
          $('.monogram_options').show();
        }
        $('.monogram_select').removeClass('active');
        $(this).addClass('active');
        console.log("This is monogram color :"+shirtDimension.Monocolor);
        console.log("This is Location:"+shirtDimension.MonoLocation);
        console.log("This is font id :"+shirtDimension.Monofontstyle);
      });


      $(".monogram_color_select").on("click",function(){
        console.log("This is monogram color :"+this.id);
        shirtDimension.Monocolor=this.id.replace(/_/g, ' ');

         $('.monogram_color_select').removeClass('active');
        $(this).addClass('active');
      });

      $(".monogram_location_select").on("click",function(){
        console.log("This is Location:"+this.id);
        shirtDimension.MonoLocation=this.id.replace(/_/g, ' ');

         $('.monogram_location_select').removeClass('active');
        $(this).addClass('active');
      });

      $(".monogram_font_select").on("click",function(){
        console.log("This is font id :"+this.id);
        shirtDimension.Monofontstyle=this.id.replace(/_/g, ' ');

         $('.monogram_font_select').removeClass('active');
        $(this).addClass('active');
      });

   /*   $(".size_select").on("click",function(){
        console.log("This is size  :"+this.id);
        shirtDimension.standardsize=this.id.replace(/_/g, ' ');

         $('.size_select').removeClass('active');
          $(this).addClass('active');
          $('#size_error').removeClass('option_error');
           $('#size_error').hide();
      });*/

      $("#cust_det_fab_lum").click(function(){
        var product_id = $("#prd_id").val();
        var subcatid='<?php echo $_SESSION['subcatid']; ?>';
        window.location.href = '<? echo $bas_ul ?>home/new_custom/9/'+ subcatid +'/'+ product_id;
      });


      $("#summary,#m_summary").click(function(){
          shirtDimension.Monotext = $("#monogram_text").val();
          var html_data1 = "";
          var html_data='<h4>Product Name : <?php echo $proname ?></h4>';

        if(shirtDimension.Monogram=="No"){
        html_data1='</h4><h4>Collar : '+ shirtDimension.collar +'</h4><h4>Cuffs : '+ shirtDimension.cuff +' </h4><h4>Fit : '+ shirtDimension.fitype +' </h4><h4>Length :'+ shirtDimension.length +' </h4><h4>Pocket : '+ shirtDimension.pocket +' </h4><h4>Monogram : '+ shirtDimension.Monogram + '  </h4><h4>Size : '+ shirtDimension.standardsize +' </h4>';

        }
        else {
        html_data1='</h4><h4>Collar : '+ shirtDimension.collar +'</h4><h4>Cuffs : '+ shirtDimension.cuff +' </h4><h4>Fit : '+ shirtDimension.fitype +' </h4><h4>Length :'+ shirtDimension.length +' </h4><h4>Pocket : '+ shirtDimension.pocket +'</h4><h4>Monogram : '+ shirtDimension.Monogram + '  </h4><h4>Color : '+ shirtDimension.Monocolor +' </h4><h4>Location : '+ shirtDimension.MonoLocation +' </h4><h4>Font : '+ shirtDimension.Monofontstyle +' </h4><h4>Text : '+ shirtDimension.Monotext +' </h4><h4>Size : '+ shirtDimension.standardsize +'</h4>';
        }
      if(this.id=="m_summary")
      $('.m-summary-body').html(html_data+""+html_data1);
      else
      $('#summary_options').html(html_data+""+html_data1);

      });

      /*shahjaz end here*/
      $(".buy_now").on("click",function(){
      /*  if(shirtDimension.fitype == "None" || shirtDimension.length =="None" || shirtDimension.standardsize =="None")
        {
            $('.option_error').show();
        }
        else*/
        {
        shirtDimension.Monotext = $("#monogram_text").val();
        console.log(shirtDimension.Monotext);
        var result = "<?= $https_url_large_img."".$cmsf->image;?>";
        base_url = '<? echo $bas_ul?>';
        //alert(base_url);
        var exact_price = $("#prd_price").val();
        var product_id = $("#prd_id").val();
        var subcatid='<?php echo $_SESSION['subcatid']; ?>';
        //alert(subcatid);
        var ordertype;
        if(subcatid=="10")
        {
        ordertype="shirt";
        }
        else if(subcatid=="11")
        {
        ordertype="pant";
        }
        var fabric_nameshirt = $("#prd_namme").val();


        var loginUser='<?php echo $_SESSION['user_id']; ?>';


        if(loginUser)
        {

          $.ajax({
              url: "<? echo $bas_ul?>/cart/addcart3dcombined",
              type: 'POST',
              data:
              {
                details : JSON.stringify(shirtDimension) ,
                price_shirt : exact_price,
                productid_shirt : product_id ,
                subcatid_shirt : subcatid ,
                pname_shirt : fabric_nameshirt,
                imagedata_shirt : result,
                ordertype:"shirt",
                order:"stnadard"
               },
              success: function(response)
              {
              $('#loadingmessage').hide();
              //var url=base_url+'cart/lum_view_cart';
              window.location = "#shirt_measurements";
              }
            });
        }
        else{
          //alert("hello");
          $('#loadingmessage').show();
          $.ajax({
             url: "<? echo $bas_ul?>/cart/saveSelectionDatacombined",
            type: 'POST',
            data:
              {
                details :  JSON.stringify(shirtDimension),
                price_shirt : exact_price,
                productid_shirt : product_id ,
                subcatid_shirt : subcatid ,
                pname_shirt : fabric_nameshirt,
                imagedata_shirt : result,
                ordertype:"shirt",
                order:"stnadard"
               },
            success: function(response)
            {
              //alert(response);
              $('#loadingmessage').hide();
              var url=base_url+'home/lum_login';
              //alert(url);
              window.location = url;
            }
          });

          return false;

        }

      }
  });

  $(".add_wishlist").on("click",function(){

        var product_id = $("#prd_id").val();
        var loginUser='<?php echo $_SESSION['user_id']; ?>';
        base_url = '<? echo $bas_ul?>';

        if(loginUser)
        {
          //alert("hii");
          //$('#loadingmessage').show();
           console.log("Test2");
            $.ajax({
              url: "<? echo $bas_ul?>/cart/addwishlist",
              type: 'POST',
              data:
              {
                productid_shirt : product_id ,
               },
              success: function(response)
              {
                console.log(response);
                if(response=="success")
                $(".wish_added").html("<span  class='alert alert-success wish_message'>Item added in Wishlist</span>");
                else if(response=="duplicate")
                $(".wish_added").html("<span  class='alert alert-success wish_message'>Item already in Wishlist</span>");

          $('#loadingmessage').hide();

              var url=base_url;

              //window.location = url;
              }
            });
        }
        else{

            $.ajax({
             url: "<? echo $bas_ul?>/cart/saveSelectionDatacombined",
            type: 'POST',
            data:
              {
                productid_shirt : product_id ,
              },
            success: function(response)
            {



              //alert(response);
              $('#loadingmessage').hide();
              var url=base_url+'home/lum_login';
              //alert(url);
              window.location = url;
            }
          });

          return false;
        }


         });
   });
</script>
<script type="text/javascript">
  $(".carousel").swipe({
  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
      if (direction == 'left') $(this).carousel('next');
      if (direction == 'right') $(this).carousel('prev');
    },
    allowPageScroll:"vertical"
  });
  </script>

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
var shritDimension={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","shoulder":"","neck":"","length":"","chest":"","waist":"","sleeve":""};
/***********
****** to get standard measurements based on size selection
****** stylior.com : 18 Oct 2016
*/

$('select#size_select').change(function(){
var selected_size=$("#size_select option:selected").text();
var     base_url = '<?php echo $bas_ul; ?>';

if(selected_size!=undefined){
      console.log("var testing."+selected_size+"url"+base_url);
      $.ajax({
        url: base_url+"home/get_tbl_size/"+selected_size+"/10",
        type:'GET',
        data:
          {
            size : selected_size,
            category :  '10'
          },
        success: function(response) {
          console.log(response.length);
          if(response !== null && response !== undefined && response.length > 100){
          var var_result= $.parseJSON(response);
          var measurement = $.parseJSON(var_result.measurement);
          $("#lum_input_required1").val(measurement.shoulder);
          $("#lum_input_required2").val(measurement.neck);
          $("#lum_input_required3").val(measurement.sleeve);
          $("#lum_input_required5").val(measurement.shirt_length);
          $("#lum_input_required6").val(measurement.chest);
          $("#lum_input_required8").val(measurement.waist);
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

/*  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
*/

$("#quick_save").click(function(){

   var measureid ="";
    if("<?= $_GET['update'] ?>"=="shirt"){
     measureid = '<?php echo $_GET['mid'];?>';
    }

    var height_select=$('#height_select').val();
    var size_select=$('#size_select').val();
    var body_weight=$('#body_weight').val();
    var yourfit=$('input[name="yourfit"]:checked').val();
    var yourlength=$('input[name="yourlength"]:checked').val();
    //console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);   //alert($('input[name="yourlength"]:checked').val());
    shritDimension.HEIGHTinch=height_select;
    shritDimension.standardsize=size_select;
    shritDimension.WEIGHTkg=body_weight;
    shritDimension.fitype=yourfit;
    shritDimension.length=yourlength;
    /*added by var for standard measurements*/
    shritDimension.shoulder=$("#lum_input_required1").val();
    shritDimension.neck=$("#lum_input_required2").val();
    shritDimension.sleeve=$("#lum_input_required3").val();
    shritDimension.shirt_length=$("#lum_input_required5").val();
    shritDimension.chest=$("#lum_input_required6").val();
    shritDimension.waist=$("#lum_input_required8").val();
    /*end by var*/
    //ajax call to server420
    var result ="imagedata";
    //var imgData = getBase64Image($('#saveImg').attr('src')));
    base_url = '<?php echo $bas_ul; ?>';
    // var exact_price = $("#prd_price").val();
    // var product_id = $("#prd_id").val();
      var subcatid='<?php echo $_SESSION['subcatid']; ?>';
    var ordertype;
    //alert("tyoe"+subcatid);
    if(subcatid=="10")
    {
     ordertype="shirt";
    }
    else if(subcatid=="11")
    {
     ordertype="pant";
    }
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
            details_up : JSON.stringify(shritDimension),
            measureid :  measureid
              },
          success: function(response) {
              console.log("AVR"+response);
               window.location.href= base_url+"cart/lum_view_cart";
          }
        });
    }

  });

/** Add Measurement data collect from here.
*******
*****
***/
base_url = '<?= $bas_ul ?>';

$("#add-mesurement").on("click",function(){
        /*alert("var testing");
        console.log("thid is data tesitng");
        */

        var data = $(".mesure-form").serialize();
          console.log("var Data"+data);

           $.ajax({
            url:base_url+'cart/new_mvalue' ,
            method: "POST",
            data: {'data': $(".mesure-form").serialize(),
                  'subcatid':10,
            },
            success:function(data){
              console.log("this is data"+data);

             location.href='<? echo $bas_ul?>/cart/lum_view_cart';

            }
           });

});

/*change the instruction on body part*/
/*date 14 sep 2016*/

$(".entry").on("click",function(){
var base_url='<? echo $bas_ul?>';
var current_id=this.id;
var i = $(this).find(" input");
var name = $(i).attr("name");
var m = name.substring(14, 16);
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


function getSelectedMeasure(idtype,number){
    $("#"+idtype).val(number);
}



$(".measure-outer").on("click",function()
{

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


</script>
