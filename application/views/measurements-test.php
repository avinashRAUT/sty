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
<?php if(isset($uid) || isset($_SESSION['styleid'])){$css_here="display: block;";}else{$css_here="display: none;";}?>
	 <div class="cd-tabs" style="<?php echo $css_here;?>">
	 <div class="goback">
		<button data-remodal-action="close" aria-label="Close">BACK</button>

		<nav>
			<ul class="cd-tabs-navigation">
				<li><a data-content="height" href="#0" class="height selected">SAVED PROFILES</a></li>
				<li><a data-content="weight" href="#0" class="weight" >STANDARD SIZE</a></li>
				<li><a data-content="fit" href="#0" class="fit">BODY MEASUREMENT</a></li>
			</ul> <!-- cd-tabs-navigation -->
		</nav>

<ul class="cd-tabs-content">
<li data-content="height" class="selected">
<div class="height">
<div class="measurement_container">
	<div class="savedmeasure">
        <?php
         $measureprofile = $this->home_model->allusermeasurements($uid);?>
         <select name="save_m" id="save_m" onchange="showExistingMeasure(this.value);">

            <option value="">Choose profile</option>
            <?php foreach($measureprofile as $mdetail)
				 {
                       echo '<option value="'.$mdetail->id.'">'.$mdetail->userprofilename.'</option>';
                  }
			 ?>
        </select>
		<!-- collect saved data based on the selection -->
		<?php
				if($uid !=""){
				$measureprofile = $this->home_model->allusermeasurements($uid);
				// print_r($measureprofile);
				 $i=0;
				 foreach($measureprofile as $mdetail)
				 {
					$serdata = $mdetail->serializedata;
					$uns= unserialize($serdata);
					/*echo $mdetail->userprofilename;
					echo $mdetail->metricft;
					echo $mdetail->metricweight;*/
					?>

			<div id="bodymeasure-<?php echo $mdetail->id; ?>" class="bodymeasure" style="display:none;" >
				<form action="<?= $bas_ul?>cart/saveadd3d" method="post" id="filters1" name="filters1" >
				<input type="hidden"  name="measureid"  class="measureid"  value="<?php echo $mdetail->id; ?>" />
            <div class="gap10"></div>

			<table class="m_s_table">
			  <tr>
			    <th>BODY POSTURE</th>
			    <th>BODY FIT</th>
			    <th>SHOULDER TYPE</th>
				<th>SHOULDER ANGLE</th>
			  </tr>
			  <tr>
					<?php
					$posture = $mdetail->posture;
					if($posture == '0'){
					$post_val ='Normal';
					}else if($posture == '1'){
					$post_val = 'Hunched';
					}else if($posture == '2'){
					$post_val ='Erect';
					}?>
					<td style="color:red"><?php echo $post_val;?></td>
					<?php
					$fit = $mdetail->fit;
					if($fit == '0'){
					$fit_val ='Slim';
					}else if($fit == '1'){
					$fit_val = 'Tailored';
					}else if($fit == '2'){
					$fit_val ='Regular';
					}
					?>
					<td style="color:red"><?php echo $fit_val;?></td>


					<?php
					$shouldertype = $mdetail->shouldertype;
					if($shouldertype == '0'){
					$shouldertype_val ='Normal';
					}else if($shouldertype == '1'){
					$shouldertype_val = 'Sloping';
					}else if($shouldertype == '2'){
					$shouldertype_val ='Straight';
					}?>
					<td style="color:red"><?php echo $shouldertype_val;?></td>



					<?php
					$shoulderangle = $mdetail->shoulderangle;
					if($shoulderangle == '0')
					{
					$shoulderangle_val ='Even';
					}
					else if($shoulderangle == '1')
					{
					$shoulderangle_val = 'Lower Left';
					}
					else if($shoulderangle == '2')
					{
					$shoulderangle_val ='Lower Right';
					}
					?>
					<td style="color:red"><?php echo $shoulderangle_val;?></td>

				</tr>

			</table>

			<div class="gap10"></div>

					<?php
    				if($uns != '') {
					  $array1 = $uns[0];
					  $array2 = $uns[1];

					 for($k=0;$k<count($array1);$k++){
					   $val_body = $this->User_model->bodypartname($array1[$k])." - ".$array2[$k];
					 }
					 } else {

					   $val_body="-";
					}

					?>
					<input type="hidden"  name="" value="<?php echo $val_body;?>">
					<?php if($uns != '') {
					 $array1 = $uns[0];
					 $array2 = $uns[1];
					 for($k='0';$k<count($array1);$k++) { ?>
					 	<span class="bodyparts-array
					 	">
					 	<?php echo $this->User_model->bodypartname($array1[$k]) ?> |
					 	<?php echo $array2[$k]; ?>
						</span>
					<?php }

				  } $i++;?>

		<div class="submit">

	<!--<input type="submit" class="lum_measurement_bottom_inner_top_button"  value="Add to Cart"  id="lum_measurement_bottom_inner_top_button
	"> -->
   <div class="gap10"></div>
   <div class="gap10"></div>
   <div class="gap10"></div>
   <!-- <button name="" class="lum_measurement_bottom_inner_top_button" id="lum_measurement_bottom_inner_top_button<?php //echo $i;?>"><!---Add to cart</button> -->
   <input type="submit" class="lum_measurement_bottom_inner_top_button"  value="Add to Cart"  id="lum_measurement_bottom_inner_top_button">

</form>
</div>
		</div>

    			 <?php } /*end of foreach*/ ?>



     <?php       }  /*end of session uid check*/?>

<!-- end collect data -->







	</div>
</div>

	</div>
	</li>


<li data-content="weight">
	<div class="quickmeasure quickmeasure-dev">
 	<label>Height </label>
 	<select class="height_select" id="height_select" name="height_select">
	                <option value=""> Select Height </option>
	            	<option value="5'0"	" >   5'0"	 </option>
					<option value="5'1"	" >   5'1"	 </option>
					<option value="5'2"	" >   5'2"	 </option>
					<option value="5'3"	" >   5'3"	 </option>
					<option value="5'4"	" >   5'4"	 </option>
					<option value="5'5"	" >   5'5"	 </option>
					<option value="5'6"	" >   5'6"	 </option>
					<option value="5'7"	" >   5'7"	 </option>
					<option value="5'8"	" >   5'8"	 </option>
					<option value="5'9"	" >   5'9"	 </option>
					<option value="5'10"" >   5'10"   </option>
					<option value="5'11"" >   5'11"   </option>
					<option value="6'0"	" >   6'0"	 </option>
					<option value="6'1"	" >   6'1"	 </option>
					<option value="6'2"	" >   6'2"	 </option>
					<option value="6'3"	" >   6'3"	 </option>
					<option value="6'4"	" >   6'4"	 </option>
					<option value="6'5"	" >   6'5"	 </option>
					<option value="6'6"	" >   6'6"	 </option>
					<option value="6'7"	" >   6'7"	 </option>
					<option value="6'8"	" >   6'8"	 </option>
					<option value="6'9"	" >   6'9"	 </option>
					<option value="6'10"" >   6'10" </option>
					<option value="6'11"" >   6'11" </option>
			</select>
	        </div>

<div class="weight  quickmeasure-dev">
<label>Weight</label>
	 <input type="text" name="body_weight" id="body_weight" value="" placeholder="Enter Weight" />

	</div> <!-- div of weight -->
    <div class="size size-dev">
          <label>Size</label>
          <select class="height_select" id="size_select" name="height_select">
           <option value="">Select Size</option>
		 	<option value= "28"  >	28       </option>
			<option value= "30"   >	30	      </option>
			<option value= "32"   >	32	  </option>
			<option value= "34"   >	34	      </option>
			<option value= "36"  >	36	      </option>
			<option value= "38" >	38  </option>
			<option value= "40" >  40   </option>
			<option value= "42" >	42 </option>

	     </select>
    </div> <!-- div of size -->
    <hr>
    <div class="gap10"></div>

<div class="standardcol">
 	<div class="yourfit area">
			<label>Your Fit<span></span></label>
			    <div id="lum_but_limt-radio" class="item">

					<img  rel="slim_fit" src="<?=base_url() ?>images/img/lum_slim_t.png" class="measure-outer" >
					<input type="radio" name="yourfit" id="slim_fit" value="slim_fit" style="display:block;" class="outer-contrast-radio hide"  />
                     <p>Slim Fit</p>
				</div>

				<div  id="lum_but_limt-radio" class="item" >
					<img  rel="tailored" src="<?=base_url() ?>images/img/lum_tailored_t.png" class="measure-outer" >
					<input type="radio" name="yourfit" id="tailored"    value="tailored"    style="display:block;" class="outer-contrast-radio hide"  />
                    <p>Tailored</p>
				</div>

				<div  id="lum_but_limt-radio" class="item" >
					<img rel="comfort" src="<?=base_url() ?>images/img/lum_comfort_t.png"    class="measure-outer" >
					<input type="radio" name="yourfit" id="comfort"     value="comfort"     style="display:block;" class="outer-contrast-radio hide"  />
                    <p>Comfort</p>
				</div>
	</div> <!-- div of your fit -->











	<div class="yourlength area">
			<label>Your Length <span></span></label>
			    <div id="lum_but_limt-radio" class="item-size yourlength">
					<img  rel="length_short" src="<?=base_url() ?>images/img/lum_short_t.png" class="measure-outer" >
					<input type="radio" name="yourlength" id="length_short" value="length_short" style="display:block;" class="outer-contrast-radio hide"  />
					<p>Short</p>
				</div>

				<div  id="lum_but_limt-radio" class="item-size yourlength" >
					<img  rel="length_regular" src="<?=base_url() ?>images/img/lum_regular_t.png" class="measure-outer" >
					<input type="radio" name="yourlength" id="length_regular"    value="length_regular"    style="display:block;" class="outer-contrast-radio hide"  />
					<p>Regular</p>
				</div>

				<div  id="lum_but_limt-radio" class="item-size yourlength" >
					<img rel="length_high" src="<?=base_url() ?>images/img/lum_high_t.png"    class="measure-outer" >
					<input type="radio" name="yourlength" id="length_high"     value="length_high"     style="display:block;" class="outer-contrast-radio hide"  />
					<p>High</p>
				</div>
	</div> <!-- E o Length -->
</div>

    <div class="gap10"></div>

   <div class="subMenu">
           <div class="left area">

           <label class="title">Measurements<span></span></label>

                   <div class="entry" id="entry-standard" >
                         <label>WAIST</label>
						<input type="text" class="mesure-form" id="lum_input_required0" name="bodypartvalue[84]" value="" placeholder="WAIST" required>
                   </div>
					<!--          <div class="entry" id="entry-standard">
					<label>HIP</label>
					<input type="text" class="mesure-form" id="lum_input_required1" name="bodypartvalue[83]" value="" placeholder="HIP" required>
					</div> -->

				<!-- 	<div class="entry" id="entry-standard">
					<label>INSEAM</label>
						<input type="text" class="mesure-form" id="lum_input_required2" name="bodypartvalue[77]" value="" placeholder="INSEAM" required >
                   </div> -->

					<div class="entry" id="entry-standard">
					<label>RISE</label>
					<input type="text" id="lum_input_required3" class="mesure-form" name="bodypartvalue[78]"  placeholder="RISE" required/>
                   </div>


					<div class="entry" id="entry-standard">
					<label>BOTTOM</label>
					<input type="text" id="lum_input_required4" class="mesure-form" name="bodypartvalue[80]"  placeholder="BOTTOM HEM" required/>
                   </div>

					<div class="entry" id="entry-standard">
					<label>KNEE</label>
					<input type="text" id="lum_input_required5" class="mesure-form" name="bodypartvalue[81]"  placeholder="KNEE" required/>
                   </div>

				   <div class="entry" id="entry-standard">
				   <label>THIGH</label>
					<input type="text" id="lum_input_required6" class="mesure-form" name="bodypartvalue[82]"  placeholder="THIGH" required/>
                   </div>

					<!--   		<div class="entry">
					<label>LENGTH</label>
					<input type="text" id="lum_input_required7" class="mesure-form" name="bodypartvalue[85]"  placeholder="TROUSER LENGTH" required/>
					</div>
					-->
	<div class="gap10"></div>
	<div class="submit area">
	<button name="quick_save" id="quick_save">Add to cart</button>
	</div>

	</div><!-- end extra info here -->

	<div class="right">
		<h4>HOW TO MEASURE</h4>
		<div id="guideDescription-standard">
        </div>

     </div><!-- end of subMenu -->
	<div class="gap10"></div>
	<div class="gap10"></div>

</div>

	<!-- height end -->
</li>

<li data-content="fit">
	<!-- <h4>Enter Measurements</h4> -->
		<div class="standardcol">
			  <div class="height area">
	          <label>Height </label>
	          <select class="mesure-form height_select" name="height" id="height_select">
	          <option value="">Select Height</option>
	            	<option value="5'0"	" >   5'0"	 </option>
					<option value="5'1"	" >   5'1"	 </option>
					<option value="5'2"	" >   5'2"	 </option>
					<option value="5'3"	" >   5'3"	 </option>
					<option value="5'4"	" >   5'4"	 </option>
					<option value="5'5"	" >   5'5"	 </option>
					<option value="5'6"	" >   5'6"	 </option>
					<option value="5'7"	" >   5'7"	 </option>
					<option value="5'8"	" >   5'8"	 </option>
					<option value="5'9"	" >   5'9"	 </option>
					<option value="5'10"" >   5'10" </option>
					<option value="5'11"" >   5'11" </option>
					<option value="6'0"	" >   6'0"	 </option>
					<option value="6'1"	" >   6'1"	 </option>
					<option value="6'2"	" >   6'2"	 </option>
					<option value="6'3"	" >   6'3"	 </option>
					<option value="6'4"	" >   6'4"	 </option>
					<option value="6'5"	" >   6'5"	 </option>
					<option value="6'6"	" >   6'6"	 </option>
					<option value="6'7"	" >   6'7"	 </option>
					<option value="6'8"	" >   6'8"	 </option>
					<option value="6'9"	" >   6'9"	 </option>
					<option value="6'10"" >   6'10" </option>
					<option value="6'11"" >   6'11" </option>
			</select>
			</div>
			<div class="weight area">
				<label>Weight</label>
				<input type="text" name="weight" id="body_weight" class="mesure-form" placeholder="Enter Weight" />
			</div>
    	</div><!-- end of standardcol -->
		<hr>

            <div class="widht_100">
             <div class="standardcol">
            	<div class="yourfit area">
				   <label>Your Fit <span ></span></label>

					<div  id="lum_but_limt-radio" class="item-size" onclick="getSelectedMeasure('fit',0)" >
							<img rel="cust_comfort" src="<?=base_url() ?>images/trouser/slim-pant.png"    class="measure-outer real-img" >
							<p>Slim</p>
							 <input type="radio" name="cust_yourfit" id="cust_comfort"  value="comfort"     style="display:none;" class="outer-contrast-radio"  />
					 </div>

					 <div id="lum_but_limt-radio" class="item-size" onclick="getSelectedMeasure('fit',1)">

							<img  rel="cust_regular_fit" src="<?=base_url() ?>images/trouser/tailored-pant.png" class="measure-outer real-img">
	                        <p>Tailored</p>

							<input type="radio" name="cust_yourfit" id="cust_regular_fit" value="regular_fit" style="display:none;" class="mesure-form outer-contrast-radio"  />
					</div>

						<div  id="lum_but_limt-radio" class="item-size" onclick="getSelectedMeasure('fit',2)">
							<img  rel="cust_tailored"src="<?=base_url() ?>images/trouser/comfort-pant.png"    class="measure-outer real-img" >
	                        <p>Regular</p>
	                        <input type="radio" name="cust_yourfit" id="cust_tailored"    value="tailored"    style="display:none;" class="mesure-form outer-contrast-radio"  />
						</div>
					<input id="fit" class="mesure-form" name="fit" type="hidden" />


				</div>

<!-- Body Posture:
1. Normal2. Hunched3. Erect
Shoulder Type:
1. Normal2. sloping3. straight
Shoulder Angle
1. EVEN2. Lower Left3. Lower Right
-->

            <div class="gap10"></div>

	  </div>	     <!-- end of standardcol -->


			<div class="gap10"></div>
			<hr>

           <div class="subMenu">
           <div class="left area">

           <label class="title">Measurements<span></span></label>

                   <div class="entry">
                         <label>WAIST</label>
						<input type="text" class="mesure-form" id="lum_input_required0" name="bodypartvalue[84]" value="" placeholder="WAIST" required>
                   </div>
                   <div class="entry">
                   <label>HIP</label>
						<input type="text" class="mesure-form" id="lum_input_required1" name="bodypartvalue[83]" value="" placeholder="HIP" required>
                   </div>

					<div class="entry">
					<label>INSEAM</label>
						<input type="text" class="mesure-form" id="lum_input_required2" name="bodypartvalue[77]" value="" placeholder="INSEAM" required >
                   </div>

					<div class="entry">
					<label>RISE</label>
					<input type="text" id="lum_input_required3" class="mesure-form" name="bodypartvalue[78]"  placeholder="RISE" required/>
                   </div>


					<div class="entry">
					<label>BOTTOM</label>
					<input type="text" id="lum_input_required4" class="mesure-form" name="bodypartvalue[80]"  placeholder="BOTTOM HEM" required/>
                   </div>

					<div class="entry">
					<label>KNEE</label>
					<input type="text" id="lum_input_required5" class="mesure-form" name="bodypartvalue[81]"  placeholder="KNEE" required/>
                   </div>

				   <div class="entry">
				   <label>THIGH</label>
					<input type="text" id="lum_input_required6" class="mesure-form" name="bodypartvalue[82]"  placeholder="THIGH" required/>
                   </div>

   			   		<div class="entry">
   			   		<label>LENGTH</label>
					<input type="text" id="lum_input_required7" class="mesure-form" name="bodypartvalue[85]"  placeholder="TROUSER LENGTH" required/>
                   </div>



					<!-- extra info here -->
					<div class="lum_switch_right" >

						<label>Profile Name:</label> <input type="text" class="mesure-form" name="profilename" required="required" >
						<?php if($_SESSION['subcatid']==10)
						{  $cat_va = "Shirt";
						} else if($_SESSION['subcatid']==11){
						$cat_va = "Trouser";

						}
						$pagname = "Body Size";
						?>
						<input type="hidden" name="catval" value="<?php echo $cat_va.'-'.$pagname;?>" class="mesure-form">
						<button   id="add-mesurement" class="add-mesurement btn btn-default submit">Add to cart </button>
					</div>
	</div><!-- end extra info here -->

	<div class="right">
		<h4>HOW TO MEASURE</h4>
		<div id="guideDescription">
        </div>

     </div><!-- end of subMenu -->

</div>



</li>

<li data-content="m_summary">
<div class="m-summary-data">
<!-- <h2>Selected Product</h2>
 -->	<div class="m-summary-body">

	</div>

	<div class="m-summary-data-img">
	<?php if(isset($_SESSION['selected3dInfo_shirt']['data'])){?>
    <img src="<?php echo $_SESSION['selected3dInfo_shirt']['data']; ?>" >
   <?php } ?>
    </div>
    <div class="gap10"></div>


</div>
</li>




	</ul> <!-- cd-tabs-content -->
</div> <!-- cd-tabs -->
</div> <!-- cd-tabs -->

