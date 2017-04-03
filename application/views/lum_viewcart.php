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
$base_url_temp=$bas_ul;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function removeproduct(id,pid)
{
  if (confirm("Are you sure that you wish to remove this item. All customizations will be lost.") == true)
	{
		_id = id;
		_productid=pid;
		window.location.href= '<? echo $bas_ul?>cart/removeproduct/'+id+'/'+pid;
		return true;
	}
	else
	{
		return false;
	}
}
function removeproductnot(id,pid)
{
	$('#alertify').show();
	_id = id;
	_productid=pid;
	var t_value =remove_flag;
	if(t_value)
	{
		window.location.href= '<? echo $bas_ul?>cart/removeproduct/'+id+'/'+pid;
		return true;
	}
	else
	{
	return false;
	}
}
</script>
<style>



    .measurements{
		width: 648px; 
		word-break: break-all;
    }


.container
{
	font-family:Century Gothic;
	letter-spacing:1px;
}

.del_lum_cla
{
	background-color:#000;color:#fff;border-radius:50%;font-weight:bold;text-decoration:none;display:block;height:27px;width:27px;text-align:center;
}
.but_lum
{
	padding:5px 0px;
	/*background-color:#fff;
	color:#282c3e;*/
	background-color:#282c3e;
	color:#fff;
	border:1px solid #282c3e;
	cursor:pointer;
	width:200px;
}
.but_lum:hover
{
	/*background-color:#282c3e;
	color:#fff;*/
	background-color:#fff;
	color:#282c3e;
	border:1px solid #282c3e;
}
.but_lum_s
{
	padding:5px 10px;
	background-color:#282c3e;
	color:#fff;
	border:1px solid #282c3e;
	cursor:pointer;
}
.but_lum_s:hover
{
	background-color:#fff;
	color:#282c3e;
	border:1px solid #282c3e;
}
.lum_gap
{
	padding:10px;
}
.blue_lum
{
	color:#232323;
	cursor:pointer;
}
.red_lum
{
	color:#c71818;
	cursor:pointer;
}
.del_lum_cla:hover
{
	background-color:#fff;color:#000;border:1px solid #000;
}
@media (min-width: 1900px){
.product_lum
{
	margin:20px;
}
.product_mob_lum
{
	display:none;
}
}
@media screen and (max-width: 1899px) and (min-width: 769px) {
.product_lum
{
	margin:20px;
}
.product_mob_lum
{
	display:none;
}
}
@media screen and (max-width: 768px) and (min-width: 421px) {
.product_lum
{
	margin:20px;
	display:none;
}
.product_mob_lum
{
	display:block;
	margin:10px 0px;
}
.mobile_hide_lum
{
	display:none;
}
.mobile_line_lum
{
	border-bottom:1px solid #bbb;
}
.lum_img_cr
{
	width:50%;
}
}
@media screen and (max-width: 420px) and (min-width: 280px) {
.product_lum
{
	margin:20px;
	display:none;
}
.product_mob_lum
{
	display:block;
	margin:10px 0px;
}
.mobile_hide_lum
{
	display:none;
}
.mobile_line_lum
{
	border-bottom:1px solid #bbb;
}
.lum_img_cr
{
	width:90%;
}
}

.no-items{
	text-align:center;
}
</style>

<div class="container">

	<div class="panel_one_lum">
		<div class="mobile_line_lum" style="text-align:center;margin:10px 0px;">
			SHOPPING CART
		</div>
		<div class="mobile_hide_lum" style="background-color:#eee;margin:10px 0px;">
			<div style="display:inline-block;width:67%;vertical-align:top;padding:10px;">
				<div style="padding-left:20%;font-weight:bold;">ITEM</div>
			</div>
			<div style="display:inline-block;width:17.5%;vertical-align:top;padding:10px 0px;text-align:left;font-weight:bold;">
			SUB TOTAL
			</div>
			<div style="display:inline-block;width:14.5%;vertical-align:top;">

			</div>
		</div>

		<?php

		if($this->cart->total_items() > 0)
		{
				$i = 0;$jj=1;$kk=1;$mm=1;
				$subtotal=''; $displayprice1 = '0';
				$emptymeasurement = '1';
				$subtotal=0;
				foreach($this->cart->contents() as $items)
				{
				if (strpos($items['id'], 'STY') !== false) {
				$pid_sty =substr($items['id'], 3);
				}
				else{
				$pid_sty = $items['id'];
				}

				$proditem =  $this->Cart_model->productdetails($items['id']);

				$items['convertedPrice']=  $this->Cart_model->getPriceByID($pid_sty);

        $detailsAry = ($items['options']['details'])?json_decode($items['options']['details'],true):array();
        if($items['convertedPrice']->subcatid==17)
        {
        if($detailsAry['vestselect']=="Yes")
        {
          $vestPrice = $this->Cart_model->getProductsByItemcode($items['convertedPrice']->itemcode,18);
          if($this->session->userdata('currencycode') == 'INR')
          {
          $items['convertedPrice']->INR = $items['convertedPrice']->INR + ceil(0.8 * $vestPrice[0]->INR) ;
          }
          else if($this->session->userdata('currencycode') == 'USD')
          {
            $items['convertedPrice']->USD = $items['convertedPrice']->USD + ceil(0.8 * $vestPrice[0]->USD) ;

          }
          else if($this->session->userdata('currencycode') == 'BHD')
          {
            $items['convertedPrice']->BHD = $items['convertedPrice']->BHD + ceil(0.8 * $vestPrice[0]->BHD) ;

          }
          else if($this->session->userdata('currencycode') == 'AED')
          {
            $items['convertedPrice']->AED = $items['convertedPrice']->AED + ceil(0.8 * $vestPrice[0]->AED) ;

          }
          else if($this->session->userdata('currencycode') == 'SAR')
          {
            $items['convertedPrice']->SAR = $items['convertedPrice']->SAR + ceil(0.8 * $vestPrice[0]->SAR) ;

          }
          else if($this->session->userdata('currencycode') == 'QAR')
          {
            $items['convertedPrice']->QAR = $items['convertedPrice']->QAR + ceil(0.8 * $vestPrice[0]->QAR) ;

          }
          else if($this->session->userdata('currencycode') == 'EUR')
          {
            $items['convertedPrice']->EUR = $items['convertedPrice']->EUR + ceil(0.8 * $vestPrice[0]->EUR) ;

          }
          else if($this->session->userdata('currencycode') == 'AUD')
          {
            $items['convertedPrice']->AUD = $items['convertedPrice']->AUD + ceil(0.8 * $vestPrice[0]->AUD) ;

          }
        }
	}

			// echo "<div style='display:none;'>";
			//print_r($items);
			// print_r($detailsAry);
			// echo "hello" ;
			// echo $items['convertedPrice']->itemcode;
			// echo $vestPrice[0]->INR;
			// //echo $items['convertedPrice']->USD ;
			// echo "</div>";

				$item_id=$items['id'];

				//$grepmatch = 'textronic.online/api_stylior';
				if (strpos($items['options']['imagename'], 'textronic.online/api_Stylior/v1/img') !== false) {
					 $image="";
					}
               		else{
 	              	   $image= $this->Cart_model->getImagename($item_id);
                	}

				//$image= $this->Cart_model->getImagename($item_id);
				//print_r($image);
				//echo "This is testing for new image";
				if (ctype_digit($item_id))
				{
					 $str_id = $item_id;
				}
				else
				{
					 $str_id = substr($item_id, 3);
				}
				$this->db->select('id,categoryid, subcatid');
				$this->db->where('id',$str_id);
				$this->db->from('tbl_product');
				$query = $this->db->get();
				//$tot_shirts =0;$tot_trouser=0;
				foreach ($query->result() as $row)
				{
   			$catid = $row->categoryid;
				$subcatid = $row->subcatid;
				if($catid==9 && $subcatid==10)
				{
			  $tot_shirts = $tot_shirts + $jj;
				// echo $i;
				//echo 'fdsf';
				}
				else if($catid==9 && $subcatid==11)
				{
			  $tot_trouser = $tot_trouser + $kk;
				// echo $i;
  			//echo 'shshh';
				}
				else if($catid==9 && $subcatid==12)
				{
			  $tot_accesso = $tot_accesso + $mm;
				// echo $i;
				//echo 'shshh';
				}
				}
	?>
		<?php  $shirt3d="no"; ?>
		<div class="product_lum">
			<div style="display:inline-block;width:70%;vertical-align:top;">
				<div style="display:inline-block;vertical-align:top;width:20%;text-align:right;">
				<?php if($image != '')
				{
				?>
					<img width="55%" src="<?= $https_url_large_img."".$image;?>" />
				<?php
			  }
			else if(strpos($items['options']['imagename'], '.png') !==false )
				{
					if($items['name']=="TRIAL SHIRT")
					{
			 ?>
        <img width="55%" src="<?=$base_url_temp?>stylior/site/images/trialshirt/trial.png" />
				<?php
					}
				else
					{
					//echo $items['options']['imagename']."testetset";
					if (strpos($items['options']['imagename'], 'textronic.online/api_Stylior/v1/img') !== false) {?>
						<img width="55%" src="<?php echo $items['options']['imagename']; ?>" />
				<?php }else{
				?>
				<img width="55%" src="<?= base_url() ?>upload/saveprofile/<?php echo $items['options']['imagename']; ?>" />
				<?php
					}
				  }  //textro if end
				}
				else
				{
					$shirt3d="yes";
				?>
      				<img width="55%" src="<?php echo $items['options']['imagename']; ?>" />
				<?php
				}
				?>
				</div>
				<div style="display:inline-block;vertical-align:top;">
					<div style="padding-left:22%;font-weight:bold;padding-top:10px;">
						<?php
							if($shirt3d=="yes"){
						?>
						<!--<a href="<? echo $bas_ul?>cart/custommesurements/saved3d/<?php echo $items['options']['saveid']; ?>/<?php echo $cartDetails->id; ?>"><?php echo $items['name']; ?>-->
            <a href="#" ><?php echo $items['name']; ?></a>
						<?php
						$shirt3d="no";
						}
						else
						{
						?>
						<?php
						echo $items['name'];
						}
						?>
					</div>
					<div style="font-size:14px;line-height:25px;">
						<div style="display:inline-block;border-right:1px solid #bbb;vertical-align:top;margin-top:20px;padding:0px 10px;">
							<!--<div>QUANTITY</div>-->
							<div>PRICE</div>
							<div>DELIVERY DETAILS</div>
							<?php
							if($subcatid != 12)
							{
							?>
							<div><!--MEASUREMENT--></div>
							<?php
							}
							?>
						</div>
						<div style="display:inline-block;vertical-align:top;margin-top:20px;padding:0px 10px;">
						<!--<div>
						<img src="http://i.imgur.com/yOadS1c.png" id="minus2" width="20" height="20" class="minus" style="cursor:pointer;" />
						<input type="hidden" value="<?php echo $i;?>" id="bakwas" />
						<input type="text" id="qty2" value="1" class="qty" style="width:30px;position:relative;top:-5px;padding:3px;text-align:center;" readonly />
						<img id="add2" src="http://i.imgur.com/98cvZnj.png" width="20" height="20" class="add" style="cursor:pointer;" />
          </div>-->
						<div>
						<input type="hidden" value="<?
						if($this->session->userdata('currencycode') == 'INR')
						{
						echo $pro_price_lum=$items['convertedPrice']->INR ;
						}
						else if($this->session->userdata('currencycode') == 'USD')
						{
						echo $pro_price_lum=$items['convertedPrice']->USD ;
						}
						else if($this->session->userdata('currencycode') == 'BHD')
						{
						echo $pro_price_lum=$items['convertedPrice']->BHD ;
						}
						else if($this->session->userdata('currencycode') == 'AED')
						{
						echo $pro_price_lum=$items['convertedPrice']->AED ;
						}
						else if($this->session->userdata('currencycode') == 'SAR')
						{
						echo $pro_price_lum=$items['convertedPrice']->SAR ;
						}
						else if($this->session->userdata('currencycode') == 'QAR')
						{
						echo $pro_price_lum=$items['convertedPrice']->QAR ;
						}
						else if($this->session->userdata('currencycode') == 'EUR')
						{
						echo $pro_price_lum=$items['convertedPrice']->EUR ;
						}
						else if($this->session->userdata('currencycode') == 'AUD')
						{
						echo $pro_price_lum=$items['convertedPrice']->AUD ;
						}
						else
						{
						echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); }
						?>" id="price_ex<?php echo $i;?>" />
						<?php
  	        if($this->session->userdata('currencycode') == 'INR')
						{
						?>
						INR
						<?php
					  }
						else
						{
					  echo $this->session->userdata('currencycode'); }
						if($this->session->userdata('currencycode') == 'INR')
						{
						echo $items['convertedPrice']->INR ;
						}
						else if($this->session->userdata('currencycode') == 'USD')
						{
						echo $items['convertedPrice']->USD ;
						}
						else if($this->session->userdata('currencycode') == 'BHD')
						{
						echo $items['convertedPrice']->BHD ;
						}
						else if($this->session->userdata('currencycode') == 'AED')
						{
						echo $items['convertedPrice']->AED ;
						}
						else if($this->session->userdata('currencycode') == 'SAR')
						{
						echo $items['convertedPrice']->SAR ;
						}
						else if($this->session->userdata('currencycode') == 'QAR')
						{
						echo $items['convertedPrice']->QAR ;
						}
						else if($this->session->userdata('currencycode') == 'EUR')
						{
						echo $items['convertedPrice']->EUR ;
						}
						else if($this->session->userdata('currencycode') == 'AUD')
						{
						echo $items['convertedPrice']->AUD ;
						}
						else
						{
						echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); } ?>
						</div>
						<div>FREE STANDARD DELIVERY BY <?php
						$date = new DateTime(date("Y-m-d"));
						$date->modify('+10 day');
						$tomorrowDATE = $date->format('d M Y');
						echo $tomorrowDATE; ?> 
						</div>

						<div class="blue_lum">
						<?php
						$detailsAry = ($items['options']['details'])?json_decode($items['options']['details'],true):array();					
						
						//echo "<pre>";
						//print_r($_SESSION['subcatid']);
						//print_r($_SESSION);
						
						//print_r($detailsAry['measurements']);
						$sizeVal = (isset($detailsAry['standardsize']))?$detailsAry['standardsize']:'';
						$length =(isset($detailsAry['length']))?$detailsAry['length']:'';
						$fitype =(isset($detailsAry['fitype']))?$detailsAry['fitype']:'';
						//print_r($items['options']['newmid']);
						if($detailsAry['measurements']){
							echo '<div class="measurements">';
							foreach ($detailsAry['measurements'] as $key_mm => $value_mm) {				 
								echo $key_mm." : ".$value_mm;
							}
							echo "</div>";
						}
						else if(!isset($items['options']['newmid'])||$items['options']['newmid'] == '')
						{
							$cartDetails =  $this->Cart_model->getcartDetails($items['id']);
						?>
						<?php
						if($sizeVal == '')
						{
						?>
						<!--<a href="<? echo $bas_ul?>cart/custommesurements/saved3d/<?php echo $items['options']['saveid']; ?>/<?php echo $cartDetails->id?>/<?php echo $subcatid; ?>"> Add your measurement</a>-->
						<a href="#"> <!--Add your measurement--></a>
						<?php
					   }
						else
							{
								if($subcatid==10 || $subcatid == 11 )
								{
									echo 'Size :'.$sizeVal.' Length :'.$length.' Fit :'.$fitype;
								}
							}
					 	}
						else
						{
							$getprofilename =  $this->Cart_model->getprofilename($items['options']['newmid']);
						?>
						<a style="float:left;color:#63beed;" href="#"> <?php echo $getprofilename; ?> </a>
						<?php
						}
						?>
						</div>
						</div>
					</div>
				</div>
	</div>

	<div style="display:inline-block;width:14.5%;vertical-align:top;padding-top:50px;height:100%:">
		<?php if($this->session->userdata('currencycode') == 'INR'){ ?>
		INR
		<?php
	  }
		else
		{
		echo $this->session->userdata('currencycode'); }
		?>
		<input type="text" style="border:none;border-collapse:collapse;" id="sub_total_s<?php echo $i;?>"
		value=
		"<?php
		if($this->session->userdata('currencycode') == 'INR')
		{
		echo $pro_price_lum=$items['convertedPrice']->INR ;
		}
		else if($this->session->userdata('currencycode') == 'USD')
		{
		echo $pro_price_lum=$items['convertedPrice']->USD ;
		}
		else if($this->session->userdata('currencycode') == 'BHD')
		{
		echo $pro_price_lum=$items['convertedPrice']->BHD ;
		}
		else if($this->session->userdata('currencycode') == 'AED')
		{
		echo $pro_price_lum=$items['convertedPrice']->AED ;
		}
		else if($this->session->userdata('currencycode') == 'SAR')
		{
		echo $pro_price_lum=$items['convertedPrice']->SAR ;
		}
		else if($this->session->userdata('currencycode') == 'QAR')
		{
		echo $pro_price_lum=$items['convertedPrice']->QAR ;
		}
		else if($this->session->userdata('currencycode') == 'EUR')
		{
		echo $pro_price_lum=$items['convertedPrice']->EUR ;
		}
		else if($this->session->userdata('currencycode') == 'AUD')
		{
		echo  $pro_price_lum=$items['convertedPrice']->AUD ;
		}
		else
		{
		echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); }

		?>" readonly />
	</div>
	<div onClick="removeproduct('<?php echo $items['rowid'];?>', '<?php echo $items['id'];?>' )" style="display:inline-block;width:14.5%;vertical-align:top;padding-top:50px;">
		<a class="del_lum_cla" href="javascript:void(0)">
			<div style="padding-top:4px;">X</div>
		</a>
	</div>
</div>

<!--Product_lum end -->
<?php
$price_su_t = $price_su_t+$pro_price_lum;
$i++;
}
}
else
{ ?>
<div class="no-items">
There are no items in the cart
</div>
<?
}
?>
<!--End of if desktop -->


		<?php if($this->cart->total_items() > 0)
				{
						$i = 0;
						$subtotal=''; $displayprice1 = '0';
						$emptymeasurement = '1';
						$subtotal=0;

		foreach($this->cart->contents() as $items)
		{
						$proditem =  $this->Cart_model->productdetails($items['id']);

    				$items['convertedPrice']=  $this->Cart_model->getPriceByID($items['id']);
            $detailsAry = ($items['options']['details'])?json_decode($items['options']['details'],true):array();
            if($items['convertedPrice']->subcatid==17)
            {
            if($detailsAry['vestselect']=="Yes")
            {
              $vestPrice = $this->Cart_model->getProductsByItemcode($items['convertedPrice']->itemcode,18);
              if($this->session->userdata('currencycode') == 'INR')
              {
              $items['convertedPrice']->INR = $items['convertedPrice']->INR + ceil(0.8 * $vestPrice[0]->INR) ;
              }
              else if($this->session->userdata('currencycode') == 'USD')
              {
                $items['convertedPrice']->USD = $items['convertedPrice']->USD + ceil(0.8 * $vestPrice[0]->USD) ;

              }
              else if($this->session->userdata('currencycode') == 'BHD')
              {
                $items['convertedPrice']->BHD = $items['convertedPrice']->BHD + ceil(0.8 * $vestPrice[0]->BHD) ;

              }
              else if($this->session->userdata('currencycode') == 'AED')
              {
                $items['convertedPrice']->AED = $items['convertedPrice']->AED + ceil(0.8 * $vestPrice[0]->AED) ;

              }
              else if($this->session->userdata('currencycode') == 'SAR')
              {
                $items['convertedPrice']->SAR = $items['convertedPrice']->SAR + ceil(0.8 * $vestPrice[0]->SAR) ;

              }
              else if($this->session->userdata('currencycode') == 'QAR')
              {
                $items['convertedPrice']->QAR = $items['convertedPrice']->QAR + ceil(0.8 * $vestPrice[0]->QAR) ;

              }
              else if($this->session->userdata('currencycode') == 'EUR')
              {
                $items['convertedPrice']->EUR = $items['convertedPrice']->EUR + ceil(0.8 * $vestPrice[0]->EUR) ;

              }
              else if($this->session->userdata('currencycode') == 'AUD')
              {
                $items['convertedPrice']->AUD = $items['convertedPrice']->AUD + ceil(0.8 * $vestPrice[0]->AUD) ;

              }
            }
          }
    				echo "<div style='display:none;'>";
    				// print_r($items);
    				// print_r($items->imagename);
     				// echo "Image data display here";
    				// print_r($items['options']['imagename']);
    				//echo "hello" ;
    				//echo $items['convertedPrice']->USD ;
    				echo "</div>";
    				$item_id=$items['id'];
    				//$grepmatch = 'textronic.online/api_stylior';
				if (strpos($items['options']['imagename'], 'textronic.online/api_Stylior/v1/img') !== false) {
					 $image=$items['options']['imagename'];
					}
               		else{
 	              	   $image= $this->Cart_model->getImagename($item_id);
                	}


    				if (ctype_digit($item_id))
    				{
    					 $str_id = $item_id;
    				}
    				else
    				{
    					 $str_id = substr($item_id, 3);
    				}

    				$this->db->select('id,categoryid, subcatid');
    				$this->db->where('id',$str_id);
    				$this->db->from('tbl_product');
    				$query = $this->db->get();
    				//$tot_shirts =0;$tot_trouser=0;
    				foreach ($query->result() as $row)
    				{
       			$catid = $row->categoryid;
    				$subcatid = $row->subcatid;
    				if($catid==9 && $subcatid==10)
    				{
    			  $tot_shirts = $tot_shirts + $jj;
    				// echo $i;
    				//echo 'fdsf';
    				}
    				else if($catid==9 && $subcatid==11)
    				{
    			  $tot_trouser = $tot_trouser + $kk;
    				// echo $i;
      			//echo 'shshh';
    				}
    				else if($catid==9 && $subcatid==12)
    				{
    			  $tot_accesso = $tot_accesso + $mm;
    				// echo $i;
    				//echo 'shshh';
    				}
    				}
    	?>
    		<?php  $shirt3d="no"; ?>

		<div class="product_mob_lum">
			<div>
				<div style="display:inline-block;vertical-align:top;width:30%;text-align:right;">
				<?php if($image != ''){?>
				<img width="55%" src="<?= $https_url_large_img."".$image;?>" />
				<?php } else {?>
                 <img width="55%" src="<?php echo $bas_ul?>site/images/trialshirt/trial.png" />
				<?php } ?>
				<div style="color:#63beed;cursor:pointer;font-size:12px;text-align:right;padding-right:10%;"> + DETAILS </div>
				</div>
				<div style="display:inline-block;vertical-align:top;width:65%;">

					<div style="font-size:12px;line-height:18px;padding:5px;">
							<div style="font-weight:bold;"> <?php echo $items['name']; ?> </div>
							<!--<div>QUANTITY :
							<?php /*<img src="http://i.imgur.com/yOadS1c.png" id="minus2" width="20" height="20" class="minus_m" style="cursor:pointer;" /> */?>
							<input type="hidden" value="<?php echo $i;?>" id="bakwas_m" />
							<input type="text" id="qty2" value="1" class="qty_m" style="width:30px;position:relative;top:-5px;padding:3px;text-align:center;" readonly />
							<?php /*<img id="add2" src="http://i.imgur.com/98cvZnj.png" width="20" height="20" class="add_m" style="cursor:pointer;" /> */?>
            </div>-->
							<div>PRICE : <strong>
							<input type="hidden" value="<?
  						if($this->session->userdata('currencycode') == 'INR')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->INR ;
  						}
  						else if($this->session->userdata('currencycode') == 'USD')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->USD ;
  						}
  						else if($this->session->userdata('currencycode') == 'BHD')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->BHD ;
  						}
  						else if($this->session->userdata('currencycode') == 'AED')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->AED ;
  						}
  						else if($this->session->userdata('currencycode') == 'SAR')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->SAR ;
  						}
  						else if($this->session->userdata('currencycode') == 'QAR')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->QAR ;
  						}
  						else if($this->session->userdata('currencycode') == 'EUR')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->EUR ;
  						}
  						else if($this->session->userdata('currencycode') == 'AUD')
  						{
  						echo $pro_price_lum=$items['convertedPrice']->AUD ;
  						}
  						else
  						{
  						echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); }
  						?>" id="price_mx<?php echo $i;?>" />
							<?php  $price_c = $items['price'];
							       if($this->session->userdata('currencycode') == 'INR')
									{ ?>INR
										<?php } else { echo $this->session->userdata('currencycode'); }
                    if($this->session->userdata('currencycode') == 'INR')
                    {
                    echo $items['convertedPrice']->INR ;
                    }
                    else if($this->session->userdata('currencycode') == 'USD')
                    {
                    echo $items['convertedPrice']->USD ;
                    }
                    else if($this->session->userdata('currencycode') == 'BHD')
                    {
                    echo $items['convertedPrice']->BHD ;
                    }
                    else if($this->session->userdata('currencycode') == 'AED')
                    {
                    echo $items['convertedPrice']->AED ;
                    }
                    else if($this->session->userdata('currencycode') == 'SAR')
                    {
                    echo $items['convertedPrice']->SAR ;
                    }
                    else if($this->session->userdata('currencycode') == 'QAR')
                    {
                    echo $items['convertedPrice']->QAR ;
                    }
                    else if($this->session->userdata('currencycode') == 'EUR')
                    {
                    echo $items['convertedPrice']->EUR ;
                    }
                    else if($this->session->userdata('currencycode') == 'AUD')
                    {
                    echo $items['convertedPrice']->AUD ;
                    }
                    else
                    {
                    echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); } ?>
					</strong></div>
							<div style="font-size:10px;">FREE STANDARD DELIVERY BY <?php
							$date = new DateTime(date("Y-m-d"));
							$date->modify('+10 day');
							$tomorrowDATE = $date->format('d M Y');
							echo $tomorrowDATE; ?>
							</div>

							<div class="blue_lum">
							 <?php
								$detailsAry = ($items['options']['details'])?json_decode($items['options']['details'],true):array();
								$sizeVal = (isset($detailsAry['standardsize']))?$detailsAry['standardsize']:'';
								/*var start for more >>*/
								$length =(isset($detailsAry['length']))?$detailsAry['length']:'';
								$fitype =(isset($detailsAry['fitype']))?$detailsAry['fitype']:'';
								$cartDetails =  $this->Cart_model->getcartDetails($items['id']);

								// echo "Test new data var<pre>";
								// print_r($detailsAry);
								/*end var more >>*/

								if(!isset($items['options']['newmid'])||$items['options']['newmid'] == '') {
									$cartDetails =  $this->Cart_model->getcartDetails($items['id']);?>
									<?php if($sizeVal == ''){ ?>
									<!--<a href="<?php echo $items['rowid'];?>cart/custommesurements/saved3d/<?php echo $items['options']['saveid']; ?>/<?php echo $cartDetails->id; ?>"> Add your measurement</a>-->
        				          <a href="#"> <!--Add your measurement--></a>

				                  <?php } else{
												if($subcatid!=12)
												{
													echo 'Size :'.$sizeVal;
												}
								}
								?>
								<?php } else {
									echo $items['options']['newmid'];
								   $getprofilename =  $this->Cart_model->getprofilename($items['options']['newmid']);
								   $items['options']['newmid']="";
									?>
									<a style="float:left;color:#63beed;" href="#">
									" <?php echo $getprofilename; ?> "
								   </a>
								<?php } ?>
							<br />
							</div>
							<div>SUB TOTAL : <strong>
							<?php
							if($this->session->userdata('currencycode') == 'INR')
							{ ?>INR
				             <?php }
							 else
							 {
								echo $this->session->userdata('currencycode'); } ?>

				<input type="text" style="border:none;border-collapse:collapse;width:60px;" id="sub_total_m<?php echo $i;?>"
				value="<?	if($this->session->userdata('currencycode') == 'INR')
          {
          echo $items['convertedPrice']->INR ;
          }
          else if($this->session->userdata('currencycode') == 'USD')
          {
          echo $items['convertedPrice']->USD ;
          }
          else if($this->session->userdata('currencycode') == 'BHD')
          {
          echo $items['convertedPrice']->BHD ;
          }
          else if($this->session->userdata('currencycode') == 'AED')
          {
          echo $items['convertedPrice']->AED ;
          }
          else if($this->session->userdata('currencycode') == 'SAR')
          {
          echo $items['convertedPrice']->SAR ;
          }
          else if($this->session->userdata('currencycode') == 'QAR')
          {
          echo $items['convertedPrice']->QAR ;
          }
          else if($this->session->userdata('currencycode') == 'EUR')
          {
          echo $items['convertedPrice']->EUR ;
          }
          else if($this->session->userdata('currencycode') == 'AUD')
          {
          echo $items['convertedPrice']->AUD ;
          }
          else
          {
          echo $pro_price_lum=ceil(( $price_c / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); } ?>"    readonly /></strong></div>





							<div onClick="removeproduct('<?php echo $items['rowid'];?>', '<?php echo $items['id'];?>' )" class="red_lum">DELETE</div>
					</div>

				</div>
			</div>
		</div>
		<?php $price_su_t = ($price_su_t+$pro_price_lum)-$pro_price_lum;
		$i++; $jj++;$kk++;$mm++;} }

						//echo "testest::". $tot_shirts;
						//echo "tottrouser::".$tot_trouser;

						if($tot_shirts >0 && $tot_trouser >0)
						{?>
							<input type="hidden" name="applay_coupons" id="applay_coupons" value="0">

						<?php }
						else if($tot_shirts >0 && $tot_trouser <=0)
						{?>
							<input type="hidden" name="applay_coupons" id="applay_coupons" value="1">
						<?php }
						else if($tot_shirts <=0 && $tot_trouser >0)
						{?>
						    <input type="hidden" name="applay_coupons" id="applay_coupons" value="2">
						<?php }
						else if(($tot_shirts >0 && $tot_trouser <=0) || ($tot_shirts <=0 && $tot_trouser >0)|| ($tot_shirts >0 && $tot_trouser >0 ))
						{?>
							<input type="hidden" name="applay_coupons" id="applay_coupons" value="3">
						<?php }  ?>

		<div class="mobile_hide_lum" style="background-color:#eee;margin:10px 0px;">
			<div style="display:inline-block;width:65%;vertical-align:top;padding:10px;">

			</div>
			<div style="display:inline-block;width:33%;vertical-align:top;padding:10px 0px;text-align:left;">
			TOTAL : <strong> <?php
			if($this->session->userdata('currencycode') == 'INR')
					{ ?>INR <?php } else {  echo $this->session->userdata('currencycode'); } ?>

			<input type="text" style="border:none;border-collapse:collapse;font-size:16px;font-weight:bold;background-color:#eee;" id="total_s" value="<?php echo $price_su_t ;?>" readonly />
			<br />
			<div style="font-weight:normal;">
		 <?php
				$this->session->set_userdata('total_amount',$price_su_t);
				 if($this->session->userdata('couponcode') != ''||$this->session->userdata('vouchercode') != '')
				 {
				 if($this->session->userdata('couponcode') != '')
				 {?>
												Coupon Discount
												<strong>
										 <?php if($this->session->userdata('couponcode')=='1'){
												if($this->session->userdata('currencycode') == 'INR') { ?>
												<span class="WebRupee">INR</span>
												<?php } else { ?>
												<span class="WebRupee"> <?php echo $this->session->userdata('currencycode'); } ?></span>
												<?php }
												echo $per_tot_lum=$this->session->userdata('couponprice');
												if($this->session->userdata('couponcode')==1)
												{
													$ded_per_lum = $per_tot_lum;
												}
												else{
													$ded_per_lum =($price_su_t/100)*$per_tot_lum;
												}

												if($this->session->userdata('couponcode')=='0'){
												echo "%";
												}
												?>
												</strong>
												( <a title="Remove Coupon" onclick="removecoupon();">X</a> )

						<?php }  }	?>
					</div>
					<div style="font-weight:normal;">
						 <?php if($this->session->userdata('mywalletdata') != '' && $this->session->userdata('mywalletdata')>0) { ?>
									Wallet Amount
											<strong>
													<?php if($this->session->userdata('currencycode') == 'INR') { ?>
													 <span class="WebRupee">Rs</span>
													 <?php } else { ?>
													 <span class="WebRupee"> <?php echo $this->session->userdata('currencycode'); ?></span>
													   <?php }  echo $this->session->userdata('mywalletdata'); ?>

												 </strong>
												( <a title="Remove Wallet Amount" onclick="removewallet();">X</a> )

							<?php } ?>
                    </div>
					<div style="font-weight:normal;">
				<?php  if($this->session->userdata('vouchercode') != '')
				{ ?>Voucher Discount<strong>
													<?php if($this->session->userdata('currencycode') == 'INR')
													{  ?><span class="WebRupee">Rs</span> <?php } else  { ?>
													 <span class="WebRupee"> <?php echo $this->session->userdata('currencycode'); } ?></span>
											<?php
												if($_SESSION['currencycode']=="INR")
												{
													echo $vp =$this->session->userdata('voucherprice');

												}
												else
												{
											      $vp =$this->session->userdata('voucherprice');

												echo ceil(( $vp / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');


												 } ?>
												 </strong> ( <a title="Remove Coupon" onclick="removevoucher();">X</a> )


												 <?php } ?>
												 </div>
												 <div style="font-weight:normal;">
										   Final Price: <strong>
										   <?php if($_SESSION['currencycode']=="INR")
										   {
										   $vp =$this->session->userdata('voucherprice');
										   $resp=($price_su_t-$vp)-$ded_per_lum;
										   if($resp<0)
										   {
										   $resp_price = 0; } else { $resp_price = $resp; }
										   $_SESSION['resultprice']=$resp;
										   echo $this->session->userdata('currencycode');?>&nbsp;<?php echo ceil($resp_price);
										   }
										   else
											   {
										   $vp =$this->session->userdata('voucherprice');
										   $dp=ceil(( $vp / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
										   $resp=($price_su_t-$dp)-$ded_per_lum;
										   if($resp<0)
										   {
											   $resp_price = 0;
										   }
										   else
										   {
											   $resp_price = $resp;
										   }
										   $_SESSION['resultprice']=$resp_price;
										   echo $this->session->userdata('currencycode');?>&nbsp;<?php echo ceil($resp_price);
										   }?><input type="hidden" style="border:none;background-color: #eee;"
										   value=
										   "<?php if($_SESSION['currencycode']=="INR"){ $vp =$this->session->userdata('voucherprice');$resp=($price_su_t-$dp)-$ded_per_lum; if($resp<0) { $resp_price = 0; } else { $resp_price = $resp; } $_SESSION['resultprice']=$resp_price; echo $this->session->userdata('currencycode').($resp_price);
										   } else  {  $vp =$this->session->userdata('voucherprice');
										   $dp=ceil(( $vp / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) )/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling'); $resp=($price_su_t-$dp)-$ded_per_lum;
										   if($resp<0) { $resp_price = 0; } else { $resp_price = $resp; }
										   $_SESSION['resultprice']=$resp_price; echo $this->session->userdata('currencycode') .($resp_price);}?>" readonly>
										   </strong>

			</div>

		</div>
		</div>
		<div class="product_mob_lum" style="background-color:#eee;padding:5px;font-size:12px;text-align:center;">
			<div style="font-weight:normal;text-align:center;">
			TOTAL :<?php if($this->session->userdata('currencycode') == 'INR'){ ?>INR <?php } else { echo $this->session->userdata('currencycode'); } ?> <input type="text" style="border:none;border-collapse:collapse;font-size:16px;font-weight:bold;background-color:#eee;" id="total_m" value="<?php echo $price_su_t;?>" readonly />
			</div>

			<div style="font-weight:bold;">
		 <?php
				 if($this->session->userdata('couponcode') != ''||$this->session->userdata('vouchercode') != '') {
				 if($this->session->userdata('couponcode') != ''){?>
												Coupon Discount

										 <?php if($this->session->userdata('couponcode')=='1'){
												if($this->session->userdata('currencycode') == 'INR') { echo "INR"; } else {  echo $this->session->userdata('currencycode'); } } ?>
												<strong>
												<?php
												echo $this->session->userdata('couponprice');
												if($this->session->userdata('couponcode')=='0'){
												echo "%";
												}
												?>
												</strong>
												( <a title="Remove Coupon" onclick="removecoupon();">X</a> )

						<?php }  }	?>
									</div>
						 <?php if($this->session->userdata('mywalletdata') != '' && $this->session->userdata('mywalletdata')>0) { ?>
									 <div class="cart-calculation-row">
										<div class="cart-calculation-col labels">Wallet Amount</div>
											<div class="cart-calculation-col">
											<strong>
													<?php if($this->session->userdata('currencycode') == 'INR') { ?>
													 <span class="WebRupee">Rs</span>
													 <?php } else { ?>
													 <span class="WebRupee"> <?php echo $this->session->userdata('currencycode'); ?></span>
													   <?php }  echo $this->session->userdata('mywalletdata'); ?>

												 </strong>
												( <a title="Remove Wallet Amount" onclick="removewallet();">X</a> )
											</div>
										</div>
							<?php } ?>

                                    <!--cart-calculation-row ends-->
                               <div style="font-weight:normal;">
				<?php  if($this->session->userdata('vouchercode') != '') { ?>

												Voucher Discount

												<strong>
													<?php if($this->session->userdata('currencycode') == 'INR')
													{  echo "INR"; } else  {  echo $this->session->userdata('currencycode'); } ?>
													<strong>
											<?php
												if($_SESSION['currencycode']=="INR")
												{
												 echo $vp =$this->session->userdata('voucherprice');
												}
												else
												{

												$vp =$this->session->userdata('voucherprice');

												echo $dp=ceil(( $vp  / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)) ));
												}
												?>
												 </strong>
												( <a title="Remove Coupon" onclick="removevoucher();">X</a> )
										<?php } ?></div>

		</div>
	</div>
	<div class="panel_two_lum" style="text-align:center;">
		<div class="mobile_hide_lum" style="padding-top:20px;padding-bottom:50px;">
			<div style="display:inline-block;width:60%;vertical-align:top;">
				<div>

					<div style="font-size:12px;display:inline-block;color:#282c3e;padding-right:10px;">ENTER COUPON CODE</div>

					<div style="display:inline-block;"><input style="padding:5px 10px;border:collapse:collapse;" id="voucher" type="text" /></div>

					<div style="display:inline-block;">

					<button class="but_lum_s" id="applay_coupon" >APPLY</button></div>
                    <p id="errorcart" style="color:red;"></p>
				</div>
			</div>
			<div style="display:inline-block;width:19%;vertical-align:top;">
					<div>
					<a href="<?php echo $bas_ul?>">
					<button class="but_lum"><i class="fa fa-cart-plus" aria-hidden="true"></i> CONTINUE SHOPPING</button></a></div>
			</div>

			<div style="display:inline-block;width:19%;vertical-align:top;">
			<?php if($emptymeasurement == '1') { ?>
					<div><a href="javascript:void('0');"  onClick="checkout();"><button class="but_lum"><i class="fa fa-shopping-cart" aria-hidden="true"></i> PLACE ORDER</button></a></div>

			<?php }
							else { ?>
							<a href="javascript:void('0');" class="checkout" onClick="alert('Measurement for a design is not completed, please add the measurement.');">
							</a>
							<?php } ?>
							</div>
		</div>

		<div class="product_mob_lum" style="padding-top:5px;padding-bottom:20px;">

					<div style="font-size:12px;color:#282c3e;padding-right:10px;">ENTER COUPON CODE</div>
					<div style="padding:5px;"><input style="padding:5px 10px;border:collapse:collapse;" type="text" id="voucher" /><button class="but_lum_s" id="applay_coupon" >APPLY</button></div>

					<div style="padding:5px;"><a href="<?php echo $bas_ul?>"><button class="but_lum">CONTINUE SHOPPING</button></a></div>

					<div style="padding:5px;">			<?php if($emptymeasurement == '1') { ?>
					<div><a href="javascript:void('0');"  onClick="checkout();"><button class="but_lum">PLACE ORDER</button></a></div>

			<?php }
							else { ?>
							<a href="javascript:void('0');" class="checkout" onClick="alert('Measurement for a design is not completed, please add the measurement.');">
							</a>
							<?php } ?></div>

		</div>


	</div>
</div>
<script>
$(function () {
    $('.add').on('click',function()
	{
    var $qty=$(this).closest('div').find('.qty');
		var bakwas=$(this).closest('div').find('#bakwas');
		var j='#price_ex'+bakwas.val();
		var k='#sub_total_s'+bakwas.val();
		var $price_e=$(j).val();
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal))
			{
            $qty.val(currentVal + 1);
			var $inda = currentVal+1;

			$(k).val($price_e*$inda)
			var mul_tot = $price_e*$inda;
			var tot_dum = $('#total_s').val();
			var tot_sehjaz = parseInt($price_e) + parseInt(tot_dum);
			$('#total_s').val(tot_sehjaz);
        }
    });
    $('.minus').on('click',function(){
        var $qty=$(this).closest('div').find('.qty');

		var bakwas=$(this).closest('div').find('#bakwas');
		var j='#price_ex'+bakwas.val();
		var k='#sub_total_s'+bakwas.val();

		var $price_e=$(j).val();
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
			var $inda = currentVal - 1;
			$(k).val($price_e*$inda)
			var mul_tot = $price_e*$inda;
			var tot_dum = $('#total_s').val();
			var tot_sehjaz = parseInt(tot_dum) - parseInt($price_e);
			$('#total_s').val(tot_sehjaz);
        }
    });



	 $('.add_m').on('click',function(){
        var $qty=$(this).closest('div').find('.qty_m');
		var bakwas=$(this).closest('div').find('#bakwas_m');
		var j='#price_mx'+bakwas.val();
		var k='#sub_total_m'+bakwas.val();
		var $price_e=$(j).val();
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
			var $inda = currentVal+1;

			$(k).val($price_e*$inda)
			var mul_tot = $price_e*$inda;
			var tot_dum = $('#total_m').val();
			var tot_sehjaz = parseInt($price_e) + parseInt(tot_dum);
			$('#total_m').val(tot_sehjaz);
        }
    });
    $('.minus_m').on('click',function(){
        var $qty=$(this).closest('div').find('.qty_m');

		var bakwas=$(this).closest('div').find('#bakwas_m');
		var j='#price_mx'+bakwas.val();
		var k='#sub_total_m'+bakwas.val();

		var $price_e=$(j).val();
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
			var $inda = currentVal - 1;
			$(k).val($price_e*$inda)
			var mul_tot = $price_e*$inda;
			var tot_dum = $('#total_m').val();
			var tot_sehjaz = parseInt(tot_dum) - parseInt($price_e);
			$('#total_m').val(tot_sehjaz);
        }
    });
});

	$("#applay_coupon").on("click",function()
	{
		applay_coupons = document.getElementById('applay_coupons').value;

       if(applay_coupons==0)
		{
			val_sub = 8;
			vouchercode(val_sub);
		}
		else if(applay_coupons==1)
		{
			val_sub = 10;

			vouchercode(val_sub);
		}
       else if(applay_coupons==2)
		{
			val_sub = 11;

			vouchercode(val_sub);
		}
		else if(applay_coupons==3)
		{
			val_sub = 13;

			vouchercode(val_sub);
		}
		else{
			val_sub = 13;
			vouchercode(val_sub);

		}
	});

function checkout()
	{

			<?php if($this->session->userdata('user_id') == '') { ?>
				window.location.href = "/home/lum_login";
			<?php } else { ?>
			     window.location.href = "/home/lum_check_out";
			<?php } ?>
	}
function removecoupon(){
var t = confirm('Are you sure you want to remove coupons');
if(t){
 jQuery.ajax(
 {
	 type: 'POST',
	 url: 'http://www.stylior.com/cart/removecheck',
	 data: "coupon=c",
	 success: function(result)
		{
			window.location.reload();

		}
  });
} else {
return false;
}
}


function removewallet(){
var t = confirm('Are you sure you want to remove wallet amount.?');
if(t){
 jQuery.ajax(
 {
	 type: 'POST',
	 url: '<?php echo $bas_ul?>cart/removewallet',
	 data: "wallet=c",
	 success: function(result)
		{

			document.getElementById("walletamount").checked = false;
			window.location.reload();

		}
  });
} else {
return false;
}
}

function applygiftwrap(val){
var t = confirm('Are you sure you want to Add Gift Wrap');
if(t){


if(jQuery("#giftwrap").is(':checked')){
   val = '1';
} else {
   val = '0';
}

jQuery.ajax(
 {
 	 type: 'POST',
	  url: '<?php echo $bas_ul?>cart/giftwrap',
	 data: "giftval="+val,
	 success: function(result)
		{

			window.location.reload();

		}
  });
} else {
return false;
}
}



function couponcode()
{
	if (jQuery("#coupon").val() == '')
	{
 		$("#errorcart").html('Please Enter Coupon');
		return false;
	}
	else
	{
		 jQuery.ajax(
		 {
			 type: 'POST',
			 url: '<?php echo $bas_ul?>cart/couponcheck',
			 data: "coupon="+jQuery("#coupon").val(),
			 success: function(result)
				{

				   if(result == '0')
					 {
						 //alert('Invalid Coupon Code');
						 $("#errorcart").html('Invalid Coupon Code');
						 return false;
					 } else {
					window.location.reload();
					 }
				}
		});f
	}
}



function vouchercode(val_sub)
{
	//alert(val_sub);
	if (jQuery("#voucher").val() == '')
	{
		$("#errorcart").html('Please ENTER CODE');
	}
	else
	{

		 jQuery.ajax(
		 {
			 type: 'POST',
			 url: '<?php echo $bas_ul?>cart/voucherchecknew',
			 //data: "voucher="+jQuery("#voucher").val(),
			 //data: "{'voucher':'" + jQuery("#voucher").val()+ "', 'val_sub':'" + val_sub + "'}",
			 data: 'voucher='+jQuery("#voucher").val()+'&val_sub='+val_sub,
			 //alert(data);
			 success: function(result)
				{
					//alert(result);
                  //alert("discountcode"+result);
				   if(result == '0')
				   { //Invalid
						 $("#errorcart").html('Invalid Discount code.');
						 return false;
					 }
					 else if(result == '1')
					 {//free one time used
						  $("#errorcart").html('Your Discount code is Alread Used.');
						 return false;
					 }
					 else if(result == '2')
					 {//min amount less
						  $("#errorcart").html('Coupon Not APPLY For less price');
						 return false;
					 }
					 else {
						window.location.reload();
					 }
				}
		});
	}
}

function walletcode(myval)
{


		if(myval != '') {

		 jQuery.ajax(
		 {

			 url: '<?php echo $bas_ul?>cart/mywallet',

			 success: function(result)
				{
					window.location.reload();

				}
		});


		}

}
function removevoucher(){
var t = confirm('Are you sure you want to remove gift voucher.');
if(t){
 jQuery.ajax(
 {
	 type: 'POST',
	 url: '<?php echo $bas_ul?>cart/removecheckvoucher',
	 data: "voucher=c",
	 success: function(result)
		{
			window.location.reload();

		}
  });
} else {
return false;
}
}

$('.close').on('click',function(){
  trCls=$(this).attr('data-target');
  $('#'+trCls).removeClass("collapse");
  $('#'+trCls).removeClass("in");

});
</script>
