
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
		$prodescr = $cmsf->description;
		$threadcount = $cmsf->threadcount;
		$colour = $cmsf->colourname;
		$fabricid = $cmsf->fname;
		$designid = $cmsf->designname;

		$prodimage = $https_url_large_img."".$cmsf->image;


	}
?>

<meta property="og:url"           content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="" />
<meta property="og:description"   content="<?php echo $prodescr ?>" />
<meta property="og:image"         content="<?php echo $prodimage ?>" />


  <style>
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
  </style>
<input type="hidden" value="<?= $cmsf->pname;?>" id="prd_namme"/>
<input type="hidden" value="<?= $cmsf->price;?>" id="prd_price"/>
<input type="hidden" value="<?= $cmsf->pid;?>" id="prd_id"/>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=137656346694782";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
                        <a class="thumbnail" id="carousel-selector-1">
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
		<!-- var : start step1 discount - class added product_discount_offer-->
        <div class="product-title-wishlist product_discount_offer"><?php echo $proname;?>
		<!-- step2 p added -->
		<p class="product_price">
		<!-- step3 class added  original_price-->
		<span class="original_price">
		<?php 
		$strike_start=($cmsf->discount>0?"<strike>":""); 
		$strike_end=($cmsf->discount>0?"</strike>":""); 
			echo $strike_start;
		?>

			<?
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

      
       
       if($cmsf->discount>0){
				/*var : stared for discount offer step4*/
				$price_of_product=$cmsf->{$this->session->userdata('currencycode')};
				$discount_value = round((($price_of_product*$cmsf->discount)/100));
				$price_of_product=$price_of_product-$discount_value;
				echo "<span class='dis_price'>".$this->session->userdata('currencycode')." ".$price_of_product."</span>";
				
				/*var : end*/	
		
		}
      ?>
      </p> <!-- end product_price  -->
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
                      </ul>
                      <!--<h3>SHIPPING & RETURN </h3>-->
                      <ul>
                      <li><strong>Free Shipping :</strong> We provide free shipping globally. </li>

                      <li><strong>Alterations & Returns :</strong> Stylior promises perfect fit guaranty. If it doesn't fit
we provide free alteration, or remake for the outfits we produce.</li>
                          </ul>

                </div>
            </div>
        </div>

    <!-- panel-group -->

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										<i class="more-less glyphicon glyphicon-plus"></i>
									 Pleats
								</a>
						</h4>
				</div>
				<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
					 <!-- Multiple Checkboxes (inline) -->
					 <div class="form-group">

										 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 " >
										 <div class="pleats_select" id="Nil"><img src="<?=base_url() ?>images/trouser/no-plits.png" width="75" height="75" alt=""/>
										 <p>No</p>
										 </div>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
										 <div class="pleats_select" id="Single_Pleat">

										 <img src="<?=base_url() ?>images/trouser/single-plits.png" width="75" height="75" alt=""/>
										 <p>Single Pleat</p>

										 </div>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
										 <div class="pleats_select" id="Double_Pleat">

										 <img src="<?=base_url() ?>images/trouser/double-plits.png" width="75" height="75" alt=""/>
										 <p>Double Pleat</p>

										 </div>
										 </div>

</div>
						 <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
					</div>
				</div>
		</div>

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingFive">
						<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFour">
										<i class="more-less glyphicon glyphicon-plus"></i>
									 Cuffs
								</a>
						</h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
						<div class="panel-body">
					 <!-- Multiple Checkboxes (inline) -->
<div class="form-group">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><div class="cuff_select" id="Yes"><img src="<?=base_url() ?>images/trouser/pant-cuff.png" width="75" height="75" alt=""/>
<p>Yes</p>
</div></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
<div class="cuff_select" id="Nil"><img src="<?=base_url() ?>images/trouser/pant-nocuff.png" width="75" height="75" alt=""/><p>No</p></div>
</div>
</div>
						 <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
					</div>
				</div>
		</div>

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingSix">
						<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseFour">
										<i class="more-less glyphicon glyphicon-plus"></i>
									 Pockets
								</a>
						</h4>
				</div>
				<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
						<div class="panel-body">
					 <!-- Multiple Checkboxes (inline) -->
<div class="form-group">

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
<div class="back_pocket_select" id="None"><img src="<?=base_url() ?>images/trouser/no-pocket.png" width="75" height="75" alt=""/><p>No Pocket</p> </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
<div class="back_pocket_select" id="one_on_right"><img src="<?=base_url() ?>images/trouser/right-pocket.png" width="75" height="75" alt=""/><p>Right <!-- Pockets --></p> </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
<div class="back_pocket_select" id="one_on_left"><img src="<?=base_url() ?>images/trouser/left-pocket.png" width="75" height="75" alt=""/><p>Left <!-- Pockets --></p></div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
<div class="back_pocket_select" id="two_standard"><img src="<?=base_url() ?>images/trouser/Double-pocket.png" width="75" height="75" alt=""/><p>Two Side <!-- Pockets --></p> </div>
</div>


						 <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
					</div>
				</div>
		</div>
</div>

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingEight">
						<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseFour">
										<i class="more-less glyphicon glyphicon-plus"></i>
									 Belt Loops
								</a>
						</h4>
				</div>
				<div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
						<div class="panel-body">
					 <!-- Multiple Checkboxes (inline) -->
	<div class="form-group">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div class="loop_select" id="Yes"><img src="<?=base_url() ?>images/trouser/loop-pant.png" width="75" height="75" alt=""/><p>Yes</p> </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div class="loop_select" id="Nil"><img src="<?=base_url() ?>images/trouser/no-loop-pant.png" width="75" height="75" alt=""/><p>None</p> </div>
		</div>


	</div>
						 <!--<a href="#" class="info"><img src="<?=base_url() ?>images/quick/info.gif" width="34" height="35" alt=""/></a>-->
					</div>
				</div>
		</div>


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
											<div data-toggle="tooltip" data-placement="left" data-html="true" class="active" title="SLIM FIT: This gives you an athletic and shaped fit featuring narrow sleeves, higher armholes and a slimmer cut to the body."><img src="<?=base_url() ?>images/trouser/slim-pant.png" class="img-responsive img-center" width="100" height="100" alt=""  /><br>SLIM</div>  <!--
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fittype_select" id="Tailored">
										 <div class="active" data-toggle="tooltip" data-placement="bottom" data-html="true"  title="TAILORED FIT: A more tailored and refined fit with fitted sleeves, comfortable armholes and a shaped body."><img src="<?=base_url() ?>images/trouser/tailored-pant.png" width="100"  class="img-responsive img-center" height="100"  alt=""/><br>Tailored</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fittype_select" id="Comfort">
										 <div class="active" data-toggle="tooltip" data-placement="left" data-html="true"  title="REGULAR FIT: This is a more relaxed and comfortable fit offering fuller sleeves, deeper armholes and an eased fit to the body."><img src="<?=base_url() ?>images/trouser/comfort-pant.png"  class="img-responsive img-center" width="100" height="100"  alt=""/><br>Comfort</div>
										</div>
							</div>
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
                          <div data-toggle="tooltip" data-placement="left" data-html="true" class="active" title=""> <img src="<?=base_url() ?>images/img/lum_short_t.png" class="img-responsive img-center" width="100" height="100" alt=""  /><br>Short</div>  <!--
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 length_select" id="Regular">
                         <div class="active" data-toggle="tooltip" data-placement="bottom" data-html="true"  title=""><img src="<?=base_url() ?>images/img/lum_regular_t.png" width="100"  class="img-responsive img-center" height="100"  alt=""/><br>Regular</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 length_select" id="High">
                         <div class="active" data-toggle="tooltip" data-placement="left" data-html="true"  title=""><img src="<?=base_url() ?>images/img/lum_high_t.png"  class="img-responsive img-center" width="100" height="100"  alt=""/><br>High</div>
                        </div>
                  </div>
              </div>
            </div>
        </div> -->

        <!--Collar End -->
    <!--     <div class="panel panel-default">
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
                  <div class="size_select" id="28" >
                  28
                  </div>
                  <div class="size_select" id="30" >
                  30
                  </div>
                  <div class="size_select" id="32" >
                  32
                  </div>
                  <div class="size_select" id="34" >
                  34
                  </div>
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

              </div>
            </div>
        </div> -->
        <!-- Size end -->


        </div>
        <div class="row">
        <div class="col-lg-4 col-md-4 add_wishlist">
        <a class="quick-c-btn sum">Add to wishlist</a>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4">
        <button type="button"  class="quick-c-btn sum" id="summary" data-toggle="modal" data-target="#myModal">Summary</button>
        </div>
        <div class="col-lg-4 col-md-4 buy_now">
        <a  class="quick-c-btn">buy now</a>
        </div>
        <div class="gap10"></div>
				<div class="social-btns">
				<ul>
				<li>  <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="social-link js-social-link" target="_blank">

					<i class="fa fa-facebook "></i>
					</a>
</li>
				<li>  <a href="<?php echo 'https://twitter.com/intent/tweet/?text='.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'&amp;via=stylior.com&amp;source=webclient'; ?>" class="social-link js-social-link" target="_blank">

					<i class="fa fa-twitter fa-stack-1"></i>

					</a></li>
				</ul>
				</div>

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
</div>


<?php   $uid=$_SESSION['user_id'];
?>
<div style="max-width:inherit !important;" class="remodal" data-remodal-id="trouser_measurements" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc"  data-remodal-options="closeOnEscape:false,closeOnOutsideClick: false">
<?php if(isset($uid)){include("measurements-trouser.php");}?>
</div>



<script src="<?=base_url() ?>js/simple-lightbox.min.js"></script>

<!-- <script src="js/owl.carousel.js"></script> -->
 <!-- <script src="js/jquery.mb.YTPlayer.js"></script>  -->
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


      var trouserDimension={"pleats":"Nil", "cuffs":"Yes", "pocket":"None","beltloop":"Yes","fitype":"None", "standardsize":"None", "length":"None","product_details_page":"<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"};

      $(document).ready(function () {

      $(".image-zoom").simpleLightBox();

      $('.option_error').hide();

      /*shahjaz writing here*/


      console.log("This is testing");
			$(".pleats_select").on("click",function(){
				console.log("This is pleat option  :"+this.id);
				trouserDimension.pleats=this.id.replace(/_/g, ' ');

				 $('.pleats_select').removeClass('active');
				$(this).addClass('active');

			});

			$(".cuff_select").on("click",function(){
				console.log("This is cuff option  :"+this.id);
				trouserDimension.cuffs=this.id.replace(/_/g, ' ');

				 $('.cuff_select').removeClass('active');
				$(this).addClass('active');

			});

			$(".back_pocket_select").on("click",function(){
				console.log("This is back pocket option  :"+this.id);
				trouserDimension.pocket=this.id.replace(/_/g, ' ');

				 $('.back_pocket_select').removeClass('active');
				$(this).addClass('active');

			});

			$(".loop_select").on("click",function(){
				console.log("This is belt loop option  :"+this.id);
				trouserDimension.beltloop=this.id.replace(/_/g, ' ');

				 $('.loop_select').removeClass('active');
				$(this).addClass('active');

			});


       $(".fittype_select").on("click",function(){
        console.log("This is fittype id :"+this.id);
        trouserDimension.fitype=this.id.replace(/_/g, ' ');

         $('.fittype_select').removeClass('active');
        $(this).addClass('active');
        $('#fit_error').removeClass('option_error');
        $('#fit_error').hide();

      });

       $(".length_select").on("click",function(){
        console.log("This is fittype id :"+this.id);
        trouserDimension.length=this.id.replace(/_/g, ' ');

         $('.length_select').removeClass('active');
        $(this).addClass('active');
        $('#length_error').removeClass('option_error');
         $('#length_error').hide();
      });

      $(".size_select").on("click",function(){
        console.log("This is size  :"+this.id);
        trouserDimension.standardsize=this.id.replace(/_/g, ' ');

         $('.size_select').removeClass('active');
          $(this).addClass('active');
          $('#size_error').removeClass('option_error');
           $('#size_error').hide();
      });


      $("#summary").click(function(){
        console.log("summary click");

          var html_data1 = "";
          var html_data='<h4>Product Name : <?php echo $proname ?></h4><h4>Price :<?php if($this->session->userdata('currencycode') == 'INR')
          {
          ?>INR<?php
          } else { echo $this->session->userdata('currencycode'); }
          ?><?php
          if($this->session->userdata('currencycode') == 'INR')
          {
          echo $cmsf->price;
          }
          else
          {
          echo ceil(( $cmsf->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
          }
          ?>';

        html_data1='<h4>Pleat : '+ trouserDimension.pleats +' </h4><h4>Cuffs :'+ trouserDimension.cuffs +' </h4><h4>Back Pocket : '+ trouserDimension.pocket +'<h4>Belt Loop : '+ trouserDimension.beltloop +'<h4>Fit : '+ trouserDimension.fitype +' </h4><h4>Length :'+ trouserDimension.length +' </h4><h4>Size : '+ trouserDimension.standardsize +' </h4>';

        $('#summary_options').html(html_data+""+html_data1);
      });

      /*shahjaz end here*/
      $(".buy_now").on("click",function(){

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
          //alert("hii");
          //$('#loadingmessage').show();

          $.ajax({
              url: "/cart/addcart3dcombined",
              type: 'POST',
              data:
              {
                details : JSON.stringify(trouserDimension) ,
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
	              window.location = "#trouser_measurements";
              }
            });
        }
        else{
          //alert("hello");
          $('#loadingmessage').show();
          $.ajax({
             url: "/cart/saveSelectionDatacombined",
            type: 'POST',
            data:
              {
                details :  JSON.stringify(trouserDimension),
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
              url: "/cart/addwishlist",
              type: 'POST',
              data:
              {
                productid_shirt : product_id ,
               },
              success: function(response)
              {
              console.log("Test");
              $('#loadingmessage').hide();
              var url=base_url+'cart/lum_view_cart';
              window.location = url;
              }
            });
        }
        else{

            $.ajax({
             url: "/cart/saveSelectionDatacombined",
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

			/*change the instruction on body part*/
			/*date 14 sep 2016*/
			  $(".skip").on("click",function(){
			$('#loadingmessage').hide();
			var url=base_url+'cart/lum_view_cart';
			window.location = url;
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

/*avr measurements functions here.*/
var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};



/*********** ::: TROUSER TYPE
****** to get standard measurements based on size selection
****** stylior.com : 18 Oct 2016
*/
$('select#size_select').change(function(){
var selected_size=$("#size_select option:selected").text();
var     base_url = '<? echo $bas_ul?>';

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




$("#quick_save").click(function(){
    var measureid ="";
    if("<?= $_GET['update'] ?>"=="shirt"){
     measureid = '<?php echo $_GET['mid'];?>';
    }

    var height_select=$('#height_select').val();
    var body_weight=$('#body_weight').val();
    var yourfit=trouserDimension.fitype;
		var standardsize = trouserDimension.standardsize ;
		var length = trouserDimension.length ;
    //console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);   //alert($('input[name="yourlength"]:checked').val());
    trouserMeasure.standardsize=standardsize;
    trouserMeasure.WEIGHTkg=body_weight;
		trouserMeasure.HEIGHTinch=height_select;
    trouserMeasure.fitype=yourfit;
		trouserMeasure.length=length;
    /*added by var for standard measurements*/
    trouserMeasure.waist=$("#lum_input_required0").val();
    trouserMeasure.hip=$("#lum_input_required1").val();
    trouserMeasure.rise=$("#lum_input_required3").val();
    trouserMeasure.bottom=$("#lum_input_required4").val();
    trouserMeasure.knee=$("#lum_input_required5").val();
    trouserMeasure.thigh=$("#lum_input_required6").val();



      //ajax call to server420
    var result ="imagedata";
    //var imgData = getBase64Image($('#saveImg').attr('src')));
    var base_url = '<?php echo $bas_ul; ?>';
    // var exact_price = $("#prd_price").val();
    // var product_id = $("#prd_id").val();
      var subcatid='<?php echo $_SESSION['subcatid']; ?>';
    var ordertype;
  //  alert("tyoe"+subcatid);
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
    if(loginUser)
    {
      $.ajax({
          url: base_url+"cart/updatecart",
          type: 'POST',
          data:
          {
            details_up : JSON.stringify(trouserMeasure),
            measureid :  measureid
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
            data: {'data': $(".mesure-form").serialize()},
            success:function(data){
              console.log("this is data"+data);

              location.href='<? echo $bas_ul?>/cart/lum_view_cart';

            }
           });

});

/*change the instruction on body part*/
/*date 14 sep 2016*/

$(".entry,#entry-standard").click(function(){
var current_id=this.id;
var base_url='<?= $base_url_temp ?>';
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


function getSelectedMeasure(idtype,number){
    $("#"+idtype).val(number);
}

function showExistingMeasure(measureid){
  $(".bodymeasure").hide();
  $('#bodymeasure-'+measureid).show();

}

</script>
