
<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		
	}
	.product_fimage{
	display:none;
	}

	.brick > img
	{
		height:auto !important;
	}

	.brick{
		margin-bottom:100px;
	}

	.lazy-load h4
	{
	font-size: 15px;
	width:100%;padding-top:3px;
	margin-top: -2px;
	margin-bottom: -7px;
	padding:2px;
	}

	.lazy-load h4 b
	{
		font-style:bold;
		padding:2px;
		font-size: 15px;
		width:100%;padding-top:3px;
	    margin-top: 1px;
	    margin-bottom: -7px;
	}
</style>

<?php if(isset($customize_type))
{
	//echo $customize_type;die;
} ?>

<script type="text/javascript">
        function ajaxSearch() {
            var input_data = $('#search_data').val();
			alert(input_data);
            if (input_data.length === 0) {
                $('#suggestions').hide();
            } else {

                var post_data = {
                    'search_data': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>domain/autocomplete/",
                    data: post_data,
                    success: function(data) {
                        // return success
                        if (data.length > 0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(data);
                        }
                    }
                });

            }
        }
</script>
<script>
  $(function() {
    $( document ).tooltip({
      track: true
    });
  });
  </script>
<div class="bannerimg">
<?php if($subcatid==10) {?>
<img  src="<?=base_url() ?>3D/images/startcustomize/shop_banner.png" class="img-responsive" style="">
<?php }

else if($subcatid==11)
{ ?>
	<img  src="<?=base_url() ?>3D/images/startcustomize/shop_trcat.png" class="img-responsive" style="">
<?php }
?>


</div>
<div class="container-fluid">

<div class="col-lg-12" style="padding-bottom:50px;padding-left:39%;">


<?php if($subcatimage->banner != '') { ?>
 	<section class="category-header" style="margin-top:0px;" <?php if($subcatimage->banner != '') {?>  style="background-image: url(<?php echo $http_host; ?>/upload/subcategory/<?php echo $subcatimage->banner; ?>);" <?php } ?> >
		<!-- div class="titalbarmainuss">
			<h1 class="category-title"><?php echo $subcatimage->scname; ?></h1>
 		</div -->
	</section>
<?php } ?>
			<form method="get" action="<?=base_url(); ?>home/shop/<?php echo $catid ?>/<?php echo $subcatid ?>" id="filters" name="filters" style="">
				  <input type="hidden" value="<?php echo $subcatid  ?>" name="sub_cat" />
				  <input type="hidden" name="color" id="color" />

						  
				 <ul value="<?php echo $colour->id; ?>" class="tab" <?php if($this->input->get('color')!='') { ?> style="display:inline-block; height:30px;margin:0 5px 0 0px;" <?php } else { ?>style="float:left;   margin:0 5px 0 0px;" <?php } ?> >				
						<?php
							if($allcolor != '' && count($allcolor) > 0) 
							{  
							foreach($allcolor as $colour)
							{
						?>
					<li id=<?php echo $colour->id;?> onClick="subfilters(this.id);" style="display:inline-block;"  <?php if($this->input->get('color') == $colour->id) { ?> selected="selected" <?php } ?>>
					
					<img style="padding:10px 10px 10px 10px;height:45px;border-radius:25px;cursor:pointer;" title="<?php echo $colour->colourname; ?>" src= "<?=base_url() ?>images/img/filter-icons/colors/<?php echo $colour->icon; ?>"> </li>
					
							<?php }} ?>
					</ul>
					
					<?php /*
					 <select name="fabricid" id="fabricid" class="tab" onChange="subfilters();" <?php if($this->input->get('fabricid')!='') { ?> style="width:22%; float:left; height:30px;" <?php } else { ?>style="width:22%; float:left; height:30px; color:#000; font-weight:bold; margin:0 5px 0 0px;" <?php } ?>>
					<option value="" style="color:#000; font-weight:bold;">All Fabric</option>
						<?php
							if($allnewfabric != '' && count($allnewfabric) > 0) {  
							foreach($allnewfabric as $fabric)
							{
						?>
					<option value="<?php echo $fabric->id; ?>" style="color:#000; font-weight:normal;" <?php if($this->input->get('fabricid') == $fabric->id) { ?> selected="selected" <?php } ?>><?php echo $fabric->fname; ?></option>
							<?php }} ?>
					</select>
					*/?>
					 <select name="designid" id="designid" class="tab"  onChange="subfilters1();" <?php if($this->input->get('designid')!='') { ?> style="width:20%; float:left; height:30px;text-align:center;margin:8px 5px 0 0px;" <?php } else { ?>style="width:20%; float:left; height:30px; color:#000; font-weight:bold; margin:8px 5px 0 0px;background-color:#eee;text-align:center;border:0;" <?php } ?>>
					<option value="" style="color:#bbb;text-align:left;">All Patterns</option>
						<?php
							if($alldesign != '' && count($alldesign) > 0) {  
							foreach($alldesign as $design)
							{
						?>
					<option value="<?php echo $design->id; ?>" style="color:#000; font-weight:normal;" <?php if($this->input->get('designid') == $design->id) { ?> selected="selected" <?php } ?>><?php echo $design->designname; ?></option>
							<?php }} ?>
					</select>

<?php /*
					<select name="price" id="price" class="tab"  onChange="subfilters();" <?php if($this->input->get('designid')!='') { ?> style="width:22%; float:left; height:30px;" <?php } else { ?>style="width:22%; float:left; height:30px; color:#000; font-weight:bold; margin:0 5px 0 0px;" <?php } ?>>
					<option value="" style="color:#000; font-weight:bold;">Price</option>
					  <option value="500" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '500') { ?> selected="selected" <?php } ?>>300 to 500</option>
					  <option value="700" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '700') { ?> selected="selected" <?php } ?>>500 to 700</option>
					  <option value="1000" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '1000') { ?> selected="selected" <?php } ?>>700 to 1000</option>
					  <option value="1500" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '1500') { ?> selected="selected" <?php } ?>>1000 to 1500</option>
					   <option value="2000" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '2000') { ?> selected="selected" <?php } ?>>1500 to 2000</option>
					   <option value="2500" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '2500') { ?> selected="selected" <?php } ?>>2000 to 2500</option>
					   <option value="3000" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '3000') { ?> selected="selected" <?php } ?>>2500 to 3000</option>
					   <option value="3500" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '3500') { ?> selected="selected" <?php } ?>>3000 to 3500</option>
							 
					</select>
               */ ?>
				<!--<select name="price" id="price" onchange="subfilters();" class="tab"  <?php if($this->input->get('price')!='') { ?> style="width:22%; float:left; height:30px;" <?php } else { ?>style="width:22%; float:left; height:30px; color:#000; font-weight:bold;" <?php } ?>>
				  <option value="" style="color:#000; font-weight:bold;">Price</option>
				  <option value="500" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '500') { ?> selected="selected" <?php } ?>>300 to 500</option>
				  <option value="700" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '700') { ?> selected="selected" <?php } ?>>500 to 700</option>
				  <option value="1000" style="color:#000; font-weight:normal;" <?php if($this->input->get('price') == '1000') { ?> selected="selected" <?php } ?>>700 to 1000</option>
				</select>-->
            </form>
            </div>
<?php /*
<div class="collapse offer-adv" id="collapseExample34">
				<img src="images/classicshirts.jpg" alt="" />
			</div>
			<div class="shop-banner" align="center">
				<img src="images/shop-icon1.jpg" alt="" />
				<form method="post" ><button href="#" class="btn othercombination" value="customize" name="customize">Customize Yours</button>
				
				<button href="#" class="btn othercombination" value="designer" name="designer">Designer Store</button>
				</form>
				<img src="images/shop-icon2.jpg" alt="" />
			</div>
			*/ ?>
			
	<?php /*		
		
<form method="get"  action="<?=base_url(); ?>home/shop/<?php echo $catid ?>/<?php echo $subcatid ?>" id="filters" name="filters" style="width:100%;">

<input type="hidden" id="s_price" name="s_price" value="<?php if($this->session->userdata('currencycode') == 'INR') { echo "1500"; } else { echo roundUpToAny(( "1500" / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )); }?>" />
<input type="hidden" id="e_price" name="e_price" value="<?php if($this->session->userdata('currencycode') == 'INR') { echo "4000"; } else { echo roundUpToAny(( "4000" / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )); }?>" />
		<div class="row shop">
		
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 sleft">
				<div class="panel-group" id="accordion-cat-1">
					<div class="panel panel-default panel-faq">
						<div class="panel-heading" style="font-weight:bold;border-bottom:1px solid #CBD4D6;padding:10px 0px" id="clickme11" >
							<a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-1">
								<h4 class="panel-title">
									<span class="pull-left"><i class="glyphicon glyphicon-minus"></i></span>
									COLOR 
								</h4>
							</a>
						</div>
						<div id="faq-cat-1-sub-1" class="panel-collapse collapse">
							<div class="panel-body">
							
								<div id="ck-button11">
		
		                <?php
				
							if($allcolor != '' && count($allcolor) > 0) 
							{  
							foreach($allcolor as $colour)
							{
						?>
					    <div><table style="border:0;cellpadding:0;cellspacing:0;border-collapse:collapse;height:20px;margin:0;"><tr><td> <div style="width:18px;height:18px;border:1px solid #C8C8C8;border-curve:1px;background:
						url('<?php echo base_url();?>images/img/filter-icons/colors/<?php echo $colour->icon;?>')"></div></td><td style="padding-top:5px;">
						<?php if(in_array($colour->id,$color)) { ?>
<div id="ck-button" style="padding-left:10px;">
   <label class="lab">
      <input type="checkbox" style="display:none;" checked="checked" value="<?php echo $colour->id; ?>" name="color[]" onclick="this.form.submit();" /><span><?php echo $colour->colourname; ?></span>
   </label>
</div>
						<?php }else{ ?>
<div id="ck-button" style="padding-left:10px;">
   <label class="lab">
      <input type="checkbox" style="display:none;" value="<?php echo $colour->id; ?>" name="color[]" onclick="this.form.submit();" /><span><?php echo $colour->colourname; ?></span>
   </label>
</div>
						<?php }
						?>
						</td></tr></table></div>
						<?php }
						} ?>
		</div>
		
							
							
							
							
							</div>
						</div>
					</div>
					<div class="panel panel-default panel-faq">
						<div class="panel-heading" style="font-weight:bold;border-bottom:1px solid #CBD4D6;padding:10px 0px" id="clickme12" >
							<a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-2">
								<h4 class="panel-title">
									<span class="pull-left"><i class="glyphicon glyphicon-minus"></i></span>
									PATTERN 
								</h4>
							</a>
						</div>
						<div id="faq-cat-1-sub-2" class="panel-collapse collapse">
							<div class="panel-body">
								<div id="ck-button12">		
		
						<?php
							if($alldesign != '' && count($alldesign) > 0) {  
							foreach($alldesign as $design)
							{
						?>
							<div>
							<table style="border:0;cellpadding:0;cellspacing:0;border-collapse:collapse;height:20px;margin:0;"><tr><td> <div style="width:18px;height:18px;border:1px solid #C8C8C8;border-curve:1px;
							background:url('<?php echo base_url();?>images/img/filter-icons/patterns/<?php echo $design->icon;?>')"></div></td><td style="padding-top:5px;">
							
						<?php if(in_array($design->id,$designid)) { ?>
<div id="ck-button" style="padding-left:10px;">
   <label class="lab">
      <input type="checkbox" style="display:none;" checked="checked" value="<?php echo $design->id; ?>" name="designid[]" onclick="this.form.submit();" /><span><?php echo $design->designname; ?></span>
   </label>
</div>
						<?php }else{ ?>
<div id="ck-button" style="padding-left:10px;">
   <label class="lab">
      <input type="checkbox" style="display:none;" value="<?php echo $design->id; ?>" name="designid[]" onclick="this.form.submit();" /><span><?php echo $design->designname; ?></span>
   </label>
</div>
						<?php }
						?>
							</tr></table>
							</div>
						<?php }} ?>
			</div>
							
							
							
							</div>
						</div>
					</div>
					<div class="panel panel-default panel-faq" >
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-3">
								<h4 class="panel-title">
									<span class="pull-left"><i class="glyphicon glyphicon-minus"></i></span>
									PRICE 
								</h4>
							</a>
						</div>
						<div id="faq-cat-1-sub-3" class="panel-collapse collapse">
							<div class="panel-body">
								<table>
								<tr>
								<td>
								
									<p><a href=""><img src="<?=base_url() ?>images/filter/low.jpg" alt="" />  </a></p>
								
								
								</td>
								
								<td>
					<label class="lab">
		  <input type="checkbox" style="display:none;" value="ASC" name="priceord[]" onclick="this.form.submit();"><span>Low to High</span>
	   </label>
								
								</td>
								
								</tr>
								
								
										<tr>
								<td>
								
								
									<p><a href="#"><img src="<?=base_url() ?>images/filter/high.jpg" alt="" /> </a></p>
								
								
								</td>
								
								<td>
					<label class="lab">
		  <input type="checkbox" style="display:none;" value="DESC" name="priceord[]" onclick="this.form.submit();">
		  <span>High to Low </span>
	   </label>
								
								</td>
								
								</tr>
								
								</table>
	
							
							
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
			*/ ?>
			<?php if($this->uri->segment(1)=='mens-trousers'||$this->uri->segment(4)==11)
			{?>
			<div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row">
					<?php //echo "<pre>";
					//print_r($image[result]);die;
					$i=0;$j=1;
					//echo "<pre>";
				
				//print_r($image);die;
					foreach($image['result'] as $product)
			{
					if($image['result'][$i]->price > 0)
				        {
						//echo $i.''.$j;
						?>
					<?php //echo "<pre>";
					//print_r($product);
					?>
					<?php 
					
					if($customize_type==""){
						$url =base_url()."index.php/home/shopnow/".$image['result'][$i]->pid."/".$product->categoryid."/".$product->subcatid;
					
					 } else {
						 $url = base_url()."index.php/home/shopnow_designer/".$image['result'][$i]->pid."/".$product->categoryid."/".$product->subcatid;
					 } ?>
					 
					<div class="lazy-load">
					
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 brick" align="center">
			<img class="product_image img-responsive" style="height:auto !important;width:auto !important;" src="http://www.stylior.com/upload/products1/large/<?php echo $image['result'][$i]->image; ?>" alt="" />
			<div id="patterns" class="product_fimage patterns">
		<img class="product_fimage patterns img-responsive" style="width:100% !important;" src="http://www.stylior.com/upload/products1/large/<?php echo $image['result'][$j]->image; ?>" alt="" />
						<div class="bt">
						<div class="ptn-btn" style="display:none;">
						
							<a class="btn-primary" href="<?=base_url() ?>Trouser-Details/<?php echo $image['result'][$i]->pid; ?>/<?php echo $product->categoryid;?>/<?php echo $product->subcatid;?>/<?php echo $product->pname;?>" class="details"> DETAILS</a>
							<br>
							
							<br />
						
								<a class="btn-primary" href="<?=base_url() ?>home/custom/<?php echo $product->categoryid;?>/<?php echo $product->subcatid;?>/<?php echo $image['result'][$i]->pid; ?>" class="details">CUSTOMIZE</a>				
						</div>
						</div>
						</div>
						<h4><?php echo $image['result'][$i]->pname; ?></h4>
						
							<h4><b>
						
						
						
																<?php 
																if($this->session->userdata('currencycode') == 'INR')
																{ ?>INR
																<?php } else { echo $this->session->userdata('currencycode'); } ?>
																<?php 
																if($this->session->userdata('currencycode') == 'INR')
																{ 
															      echo $image['result'][$i]->price;
																} else { echo ceil(( $image['result'][$i]->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); } ?>
						</b></h4>
						
						
						
						
					</div>
					</div>
				<?php  $i = $i+3; $j =$j + 3; 
			}}?>

				</div>
			</div>
			</div>
		</div>
			<?php } else { ?>
			<div>
			<div>
				<div class="row">
					<?php //echo "<pre>";
					//print_r($image[result]);die;
					$i=0;$j=1;
					//echo "<pre>";
			
				//print_r($image);die;
					foreach($image['result'] as $product)
			        {
				
				
					if($image['result'][$i]->price > 0)
				        {

					if($customize_type==""){
						$url =base_url()."index.php/home/shopnow/".$image['result'][$i]->pid."/".$product->categoryid."/".$product->subcatid;
					
					 } else {
						 $url = base_url()."index.php/home/shopnow_designer/".$image['result'][$i]->pid."/".$product->categoryid."/".$product->subcatid;
					 } ?>
					<div class="lazy-load">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 brick" align="center">
						<img class="product_image img-responsive" src="http://www.stylior.com/upload/products1/large/<?php echo $image['result'][$i]->image; ?>" alt="" />
		    			<img id="himg" class="product_fimage shirt patterns img-responsive "  style="height:100% !important;width:300px !important;" src="http://www.stylior.com/upload/products1/large/<?php echo $image['result'][$j]->image; ?>" alt="" />
					<div class="bt">
						<div class="ptn-btn" style="display:none;">
						
							<a class="btn-primary" href="<?=base_url() ?>Shirt-Details/<?php echo $image['result'][$i]->pid; ?>/<?php echo $product->categoryid;?>/<?php echo $product->subcatid;?>/<?php echo $product->pname;?>" class="details"> DETAILS</a><br>
							
							<br/>
						
								<a class="btn-primary" href="<?=base_url() ?>home/custom/<?php echo $product->categoryid;?>/<?php echo $product->subcatid;?>/<?php echo $image['result'][$i]->pid; ?>" class="details">CUSTOMIZE</a>				
						</div>
						</div>

						<h4><?php echo $image['result'][$i]->pname; ?></h4>
						
						<h4><b>
						
						
						
																<?php 
													if($this->session->userdata('currencycode') == 'INR')
																{ ?>INR
																<?php } else { echo $this->session->userdata('currencycode'); } ?>
																<?php 
																if($this->session->userdata('currencycode') == 'INR')
																{ 
															      echo $image['result'][$i]->price;
																} 
																else 
																{ echo ceil(( $image['result'][$i]->price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); } ?>
						</b></h4>
						
					</div>
					</div>
				<?php  $i = $i+2; $j =$j + 2; 
			}}?>
				</div>
			</div>
			</div>
		
			<?php } ?>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    if ($(window).width() > 480 ) { 

	$( ".brick" ).click(function() {
	
	$(this).find(".ptn-btn").show();
	$(this).find(".product_fimage").show();
	$(this).find(".product_image").hide();
  })

	$( ".brick" ).mouseenter(function() {
	
	$(this).find(".ptn-btn").show();
		$(this).find(".product_fimage").show();
	$(this).find(".product_image").hide();
	
  })
  .mouseleave(function() {
  
 $(this).find(".ptn-btn").hide();
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();

  });
	}
</script>

<script type="text/javascript">
    if ($(window).width() > 480 ) { 

 $( ".brick1" ).click(function() {
 
 $(this).find(".ptn-btn").show();
 $(this).find(".product_fimage").show();
 $(this).find(".product_image").hide();
  })

 $( ".brick1" ).mouseenter(function() {
 
 $(this).find(".ptn-btn").show();
  $(this).find(".product_fimage").show();
 $(this).find(".product_image").hide();
 
  })
  .mouseleave(function() {
  
 $(this).find(".ptn-btn").hide();
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();

  });
 }

    window.onresize = function(event) {
       if ($(window).width() <= 480 ) { 
$( ".lazy-load" ).mouseenter(function() {
$(this).find(".product_image").hide();
$(this).find(".product_fimage").hide();
  })
  .mouseleave(function() {
  
$(this).find(".product_image").hide();
$(this).find(".product_fimage").hide();

  });
    }  else
    {
   
$( ".lazy-load" ).mouseenter(function() {
	$(this).find(".bt").show();
$(this).find(".product_image").hide();
$(this).find(".product_fimage").hide();
  })
  .mouseleave(function() {
	  $(this).find(".bt").hide();
  
$(this).find(".product_image").hide();
$(this).find(".product_fimage").hide();

  })
 $('img.product_image').click(function() {
	  var id = ($(this).attr('id'));
	 
	 		//var productid = document.getElementsByClassName("product_image").id;
	
            //window.location.href = "<?php echo $base_url; ?>home/details/"+id;
        });
    }
	
   }
   </script>
   
   
   
   
  
  
  <script>
  function resize(){
	    if ($(window).width() <= 480 ) { 
	$( ".lazy-load" ).mouseenter(function() {
			$(this).find(".bt").hide();
			$(this).find(".product_fimage").hide();
			$(this).find(".product_image").show();

		}).mouseleave(function() {
			$(this).find(".bt").hide();
			$(this).find(".product_fimage").hide();
			$(this).find(".product_image").show();
	});
	$(document).on('click','.product_image',function() {	  

	  var id = ($(this).attr('id'));
	  var redirect = $(this).parents('.brick').find('.btn-primary').attr('href');
	 	
          window.location.href = redirect;
        });
 
		
    } 
 else
    {
   
$( ".lazy-load" ).mouseenter(function() {
	$(this).find(".bt").show();
$(this).find(".product_image").hide();
$(this).find(".product_fimage").show();
  })
  .mouseleave(function() {
  $(this).find(".bt").hide();
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();

  })
 
    }
  }
   $(document).ready(function()
{
	resize();
	window.onresize = function(event) {
		resize();
  
	}
});
    
</script>




<!--
<script>

$(document).ready(function()
{
    if ($(window).width() > 576 ) { 
$( ".lazy-load" ).mouseenter(function() {
$(this).find(".product_image").hide();
$(this).find(".product_fimage").show();
  })
  .mouseleave(function() {
  
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();

  });
		
    } 
 else
    {
   
$( ".lazy-load" ).mouseenter(function() {
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();
  })
  .mouseleave(function() {
  
$(this).find(".product_image").show();
$(this).find(".product_fimage").hide();

  })

	
   

})



</script>
		
-->
<style>





@media screen and (min-width:300px) and (max-width:700px) 
{
	
	
	
.product_fimage .shirt > img 
{
    height: 100%;
    width: 100%;
  text-align: center;
 
}
	
	
	
	
	.brick{width:50%;height:20%;float:left;text-align:center;padding:3px;margin-bottom:0px;}
	.brick1{width:50%;height:20%;float:left;text-align:center;padding:3px;margin-bottom:0px;}
	.vertical-filters{position:relative;top:20px;}
    .feature-title1{overflow:hidden;white-space: nowrap;font-size:95%;}
	.ptn-btn {
    left: 19%;
    position: absolute;
    text-align: center;
    top: 61px;
    vertical-align: middle;
    width: 100px;
}
    
}
@media screen and (min-width: 768px) and (max-width: 1024px) {
    .brick-show{width:20%;text-align:center;padding:10px;margin-bottom:0px;} 
	.feature-title1{overflow:hidden;white-space: nowrap;}
	.brick{margin-bottom:193px;}
	 .product_fimage#patterns > img 
   {
    height:280px !important;
    width:auto !important;
    text-align: center;
    position:relative;
   }
}
	
	
	@media screen and (min-width: 577px) and (max-width: 767px) {
    .brick-show{width:50%;text-align:center;padding:10px;margin-bottom:0px;}
	.brick{width:33.3%;float:left;margin-bottom:-32px;}
	.brick1{width:33.3%;float:left;margin-bottom:-32px;}
	
	}
	
		
@media screen and (max-width: 767px) {
	
	.vertical-filters
	{
	width:100%;
	}	
	.brick-show{width:100%;text-align:center;}
	}
	
	@media screen and (min-width: 1025px) 
	{
		.brick > img 
		{
	 height: auto !important;
	margin-left: 7%;
   }
	 	
		
	
		
	
       .bannerimg{}  
		       .brick{width:500px;float:left;margin-bottom:12%;}
			   .brick1{width:500px;float:left;margin-bottom:2%;}
   .product_fimage#patterns > img 
   {
    height:395px !important;
    width:auto !important;
    text-align: center;
    position:relative;
   }
        
		
	  .brick #himg
	  {
	height: 138% !important;
	width: 300px !important;
	display: none;
	margin-top: 5%;
  
	  }	  






	}
	
	
	@media screen and (min-width: 577px) and (max-width: 767px) 
	{
    .brick-show{width:100%;text-align:center;padding:10px;}
	.brick{width:33.3%;float:left;margin-bottom:0px;}
	.brick1{width:33.3%;float:left;margin-bottom:0px;}
	
	}
	
	
	@media screen and (min-width: 480px) and (max-width: 576px) 
	{

	.brick{width:33.3%;float:left;margin-bottom:-144px;}
	.brick1{width:33.3%;float:left;margin-bottom:-144px;}
	.brick-show{width:100%;text-align:center;padding:10px;margin-bottom:-144px;}
	.feature-title1{overflow:hidden;white-space: nowrap;font-size:95%;}
    }
	


 
    @media screen and (min-width: 361px) and (max-width: 479px) 
	{
    .brick{width:50%;float:left;text-align:center;margin-bottom:0px;}
	.brick1{width:50%;float:left;text-align:center;margin-bottom:0px;}
	.brick-show{width:100%;text-align:center;margin-bottom:0px;}
        .vertical-filters{position:relative;top:20px;}
    }
	@media (min-width: 768px) {
		.brick{width:30.3%;float:left;}
		.brick1{width:30.3%;float:left;}
		
	}
		
		@media (min-width: 992px) {
			.brick{width:24.3%;}
			.brick1{width:24.3%;}
			.brick.product_fimage.patterns 
{height:10px;}
	}

		
		
	
</style>
 <script>
    	function subfilters(id){

			document.getElementById('color').value = id;
    		document.filters.submit();
    	}
    </script>
	<script>
    	function subfilters1(){

			
    		document.filters.submit();
    	}
    </script>
	 