<?php

if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";

}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/large/";
}

$base_url_temp=$bas_ul;
$suit_data_options= array("vest_coat"=>"part","inner_lining"=>"part","jacket_style"=>"part","suspender_button"=>"part","body_fit"=>"part","lapel"=>"part","jacket_button"=>"part","vents"=>"part","suit_pocket"=>"pair","chest_pocket"=>"pair","lapel_button_hole"=>"part","cuff_accent_stitching"=>"part","cuff_button_style"=>"part","pleats"=>"part","belt"=>"part","bottom_cuff"=>"part","back_pocket"=>"part","trouser_button"=>"part","measurements");
$shirt_data_options= array("model","sleeve","cuff","collar","placket","bottom_hem","button_placket","button_collar","button_cuff","pocket","back_pleat","contrast_cuff","contrast_collar","contrast_placket");
$shirt_measurement_array=array("standardsize","length","fitype","WEIGHTkg","shoulder","neck","shirt_length","chest","waist"); ?>


<script>
jQuery(function ($) {
$(".delete-addr").on("click",function(){
	var addrId=$(this).attr("data-attr");
	//alert(addrId);
	$.ajax({
		url:'<?= $base_url_temp ?>home/deletemeasure',
		method:'POST',
		data:{"id":addrId},
		success:function(data){
			location.reload();
		}
	})
})
});

</script>

<div class='smsg'>
	<?php if($this->session->userdata("smsg")) {?>
    <span class="sessionmessge" style="background: green;padding: 5px 10px;color: white;"><?php echo $this->session->userdata("smsg");?></span>
    <?php $this->session->unset_userdata('smsg'); }?>
</div>
    
<section class="myaccount-section"> 

    <div class="container">
       	<h2>Account</h2>
        <ul id="myAccountTab" class ="nav nav-tabs">
			<li class="active"><a href="#myaccount" data-toggle="tab"><span class="sprite myaccount_icon"></span> <span class="hidden-xs">MY ACCOUNT</span></a></li>
			<li><a href="#mywishlist" data-toggle="tab"><span class="sprite wishlist_icon"></span><span class="hidden-xs">WISH LIST</span></a></li>
            <li><a href="#myorders" data-toggle="tab"><span class="sprite ordercart_icon"></span><span class="hidden-xs">MY ORDERS</span></a></li>
            <li><a href="#mymeasurements" data-toggle="tab"><span class="sprite measurement_icon"></span><span class="hidden-xs">MEASUREMENT</span></a></li>
            <li><a href="#myaddress" data-toggle="tab"><span class="sprite address_icon"></span><span class="hidden-xs">ADDRESS</span></a></li>
        </ul>
        
        <div id="myAccountTabContent" class="tab-content">
        
			<!-- Start myaccount tab--> 
            <div class="tab-pane fade in active" id="myaccount">
                <div class="row" style="min-height:300px;">
                    <div  class="col-sm-12">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <!-- required for floating -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#edit_profile" data-toggle="tab">EDIT PROFILE</a></li>
                                <li><a href="#my_wallet" data-toggle="tab">MY WALLET</a></li>
								<!--<li><a href="#gift_voucher" data-toggle="tab">GIFT VOUCHER</a></li>-->
                                <li><a href="#reset_password" data-toggle="tab">RESET PASSWORD</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <!-- Tab panes -->
                            <div class="tab-content myaccount-tab-content">
							<?php //echo "<pre>";
                            //print_r($dashboard);die;
                            
                            foreach($dashboard as $acc){
                            
                            //print_r($_SERVER['HTTP_HOST']);
                            //$url=$this->config->item('base_url_temp');
                            //print_r($url);
                            ?>
                                <div class="tab-pane active" id="edit_profile">
                                    <div class="lum_my_account_form">
										<h4>ACCOUNT DETAILS</h4>
                                        <form method="post" name="edit_users" action="<?php echo $this->config->item('base_url_temp');?>account/edit_users">
                                            <input type="hidden" name="action" value="edit_users">
                                            <div class="form-group">
                                                <label>NAME : </label>
                                                <input type="text" name="username" value="<?php echo $acc->username?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>EMAIL : </label>
                                                <input type="text" name="email" value="<?php echo $acc->email?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>PHONE : </label>
                                                <input type="text" name="phone" value="<?php echo $acc->phone?>">
                                            </div>
											<button class="class_button_lum blue-btn">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="my_wallet">
                                    <div class="lum_my_account_form">
                                        <h4>MY WALLET</h4>
                                        <div class="form-group">
                                            <label>BALANCE : </label>
                                            <div><?php
                                            $wallet_total=0;
                                            
                                            //print_r($wallet);die;
                                            foreach($wallet as $balance){
                                            $wallet =$balance->userwallet;
                                            $wallet_total = $wallet_total + $wallet;
                                            }
                                            echo $wallet_total;
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="tab-pane" id="gift_voucher">Messages Tab.</div>-->
                                
                                <div class="tab-pane" id="reset_password">
                                	<h4>RESET PASSWORD</h4>
                                    <form method="post" name="reset_password" action="<?php echo $this->config->item('base_url_temp');?>home/resetpass">
                                    <div class="lum_my_account_form">
                                        <div class="form-group">
                                            <label>OLD PASSWORD : </label>
                                            <input type="password" name="previouspass" value="<?php echo $acc->password?>" >
                                        </div>
                                       <div class="form-group">
                                            <label>NEW PASSWORD : </label>
                                            <input type="password"  name="newpassword">
                                        </div>
                                        <div class="form-group">
                                            <label>CONFIRM PASSWORD : </label>
                                            <input type="password" name="re_password">
                                        </div>
                                        <button class="reset_btn class_button_lum blue-btn" name="reset" value="reset">RESET</button>
                                    </div>
                                    </form>
                                </div>
								<?php } ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
			<!--End myaccount tab--> 
            
            <!-- Start mywishlist tab--> 
            <div class="tab-pane fade" id="mywishlist">
					<div class="table-responsive">
                       <table id="widhlist" class="table">
                        <thead>
                            <tr>
                                <th>product</th>
                                <th>product name</th>
                                <th class="text-center">product price</th>
                                <th class="text-center">view</th>
                                <th class="text-center">remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jointbl as $list){
                            
                            $trail_is = $list->is_trail_shirt;
                            ?>
        
                                <tr>
                                    <td class="product-img">                
                                        <a href="<? echo $base_url_temp."details/".str_replace(' ','-',$list->pname)."-".$list->pid; ?>" >
                                        <img src="<?php echo $base_url_temp."stylior/upload/products1/small/".$list->image;  ?>" height="40%" /></a>
                                    </td>
                                    <td><?php echo $list->pname;?></td>
                                    <td class="text-center">INR &nbsp;<?php echo $list->price;?></td>
                                    <td class="view text-center"><a href="<? echo $base_url_temp."details/".str_replace(' ','-',$list->pname)."-".$list->pid; ?>" >View</a></td>
                                    <td class="remove text-center"><a href="<? echo $base_url_temp."cart/remove_wishlist?pid=".$list->pid; ?>" ><i class="fa fa-trash-o remove-icon"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--End mywishlist tab--> 
            
            <!--Start myorders tab--> 
            <div class="tab-pane fade" id="myorders">
                <div class="table-responsive">
                    <table id="account_my_orders" class="table">
                        <thead>
                            <tr>
                                <th width="20%">product image</th>
                                <th width="10%">order id</th>
                                <th width="10%" class="text-center">quantity</th>
                                <th width="40%" class="text-center">options</th>
                                <th width="20%" class="text-center">total</th>
                                <th width="10%" class="text-center">order status</th>
                            </tr>
                        </thead>
                        <tbody>
		                <tr>
                        <?php foreach($order_details as $order_list){ 
								//print_r($order_list); 
   								// print_r($order_item_details); 
								//order_item_name
								//product_quantity
								//product_item_price
								//order_item_currency
								//order_status
								//details3d--option
                                ?>
                               <td class="product-img" > 
								<?php foreach($order_item_details[$order_list->order_id] as $key => $value) {	
								$options_data=json_decode($value->details3d);	    		
								 if($trail_is==1 ||$value->order_item_name=="TRIAL SHIRT"){?>
								<img src="<?php echo $base_url_temp; ?>stylior/upload/products1/large/14739317861.jpg" width="90%" />
								<?php }else{?>
								<?php if(isset($image_of_product[$order_list->order_id])){ ?>
								<img src="<?php echo $image_of_product[$order_list->order_id]; ?>" width="90%" />
								<?php }
								else {?>
								<img src="<?php echo $base_url_temp."stylior/upload/products1/large/".$image_of_product_nor[$order_list->order_id]; ?>" width="90%" />
								<?php }
								} 						
							 }?>
							</td>
                            <td class="account_order_id">             
                               	<?= $order_list->order_id ?>
                            </td>

                            <td class="text-center account_order_quantity">
								<?= $value->product_quantity;?>
                            </td>
                            <td class="view text-center account_order_options">
                                 <!--start -->
							 <?php				
							if(isset($value->details3d) && str_word_count($value->details3d) >10){
		                    echo "<span class='options'>";
		                        if(isset($options_data->model) && isset($options_data->suspender_button) && isset($options_data->tie)){			
		                    		foreach ($options_data as $key2 => $value_option) {
										$get_value=$suit_data_options[$key2];
										if(isset($get_value)){
												if(isset($value_option->part))
													echo $key2."<span class='option-colon'>:</span>".$value_option->part."<span class='divider-line'>|</span>";
											else if(isset($value_option->pair))
													echo $key2."<span class='option-colon'>:</span>".$value_option->pair."<span class='divider-line'>|</span>";

											}
									}						
							}
							else if(isset($options_data->model) && isset($options_data->sleeve) && isset($options_data->cuff)) {
						 		foreach ($options_data as $key2 => $value_option) {
														
									if(in_array($key2,$shirt_data_options))
									{
									
										echo $key2."<span class='option-colon'>:</span>".strstr($value_option, '&swatch', true)."<span class='divider-line'>|</span> ";	
									
									}
									else if(in_array($key2,$shirt_measurement_array)){

										echo $key2."<span class='option-colon'>:</span>".$value_option."<span class='divider-line'>|</span> ";	
									
									}
								}	

							}
							//get the options value of balzer 
							else if(isset($options_data->model) && isset($options_data->jacket_style)) {

						 		foreach ($options_data as $key22 => $value_option22) {
	                               if(in_array($key22, $shirt_measurement_array)){

										echo ">>".$key22."<span class='option-colon'>:</span>".$options_data->$key22."<span class='divider-line'>|</span>";
	                               }
	                               else
	                               {
	                               		echo $key22."<span class='option-colon'>:</span>".$value_option22->part."<span class='divider-line'>|</span>";
	                               }
	                               //print_r($value_option22->key22);   

							}	

							}
							else if(isset($options_data->front_bottom) && isset($options_data->jacket_button)) {
								// print_r($options_data);
							 	foreach ($options_data as $key22 => $value_option22) {

										if(in_array($key22, $shirt_measurement_array)){

											echo ">>".$key22."<span class='option-colon'>:</span>".$options_data->$key22."<span class='divider-line'>|</span>";
										}
										else
										{
											echo $key22."<span class='option-colon'>:</span>".$value_option22->part."<span class='divider-line'>|</span>";
										}
								}

							}
							else if(isset($options_data->back_pocket) && isset($options_data->trouser_button) && isset($options_data->trouser_fit)) {
								// print_r($options_data);
							 	foreach ($options_data as $key22 => $value_option22) {

										if(in_array($key22, $shirt_measurement_array)){

											echo ">>".$key22."<span class='option-colon'>:</span>".$options_data->$key22."<span class='divider-line'>|</span>";
										}
										else
										{
											echo $key22."<span class='option-colon'>:</span>".$value_option22->part."<span class='divider-line'>|</span>";
										}
								}

							}
							echo "</span>";
							}
							else if(isset($value->measureid)){
							//var start date 15 dec 2016 chnaged for trial shirt measurements
							$measurement =  $this->home_model->getmdata($value->measureid);
							$serdata = $measurement->serializedata;
							$uns = unserialize($serdata);
							if($uns != '') {
								$array1 = $uns[0];
								$array2 = $uns[1];
								for($k='0';$k<count($array1);$k++){
									echo $this->User_model->bodypartname($array1[$k])." => ".$array2[$k].":";
								}
							}
							//var end
							}
							else{
								echo "no options";
							
							}
							?>

						</div>

						<!-- end here -->
                   </td>
                    <td class="remove text-center account_order_total">
						<?php echo $order_list->order_currency;?> <?php echo $order_list->order_total;?>
                    </td>

					<td class="remove text-center account_order_status">
                        order status
						<?php echo $order_list->order_status;?>
					</td>
                </tr>
				<?php  } ?>
 
                        </tbody>
                    </table>
                </div>    
            </div>
            <!--End myorders tab--> 
            
			<!--Start mymeasurements tab--> 
            <div class="tab-pane fade" id="mymeasurements">
				<div class="table-responsive">
					<table id="widhlist" class="table">
                        <thead>
                            <tr>
                                <th>profile name</th>
                                <th class="text-center">measurement details</th>
                                <th class="text-center">delete</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							
							$uid=$_SESSION['user_id'];
							if($uid !=""){
							
							//$uid=$this->session->userdata('userid').'fshdf';die;
							$measureprofile = $this->home_model->allusermeasurements($uid);
							}
							if($measureprofile != '' && count(measureprofile) > 0) {
							$i=0;
							foreach($measureprofile as $mdetail)
							{
							$serdata = $mdetail->serializedata;
							$uns= unserialize($serdata);	?>
							<tr>
								<td class=""> <?php echo $mdetail->userprofilename; ?>
								</td>
								<td class="text-center"> <?php echo $mdetail->metricft; ?> <?php echo $mdetail->metricinch; ?> In 
								</td>
								<td class="text-center"><button class="class_button_lum delete-addr blue-btn" data-attr="<?=$mdetail->id?>">Delete</button>
								</td>
							</tr>
							<?php $i++; }  } else { ?>
							<p>
							Oops! It seems you have not saved any sizes. Get yourself measured now!
							</p>
							<?php } ?>
                        <tbody>
					</table>
				</div>
			</div>
			<!--End mymeasurements tab--> 
            
			<!--Start myaddress tab-->
            <div class="tab-pane fade" id="myaddress">
                <div class="row">
                    <div class="col-md-4">
						<div class="tab_spac_lum">
							<?php

							$j=0;

							foreach($addressview as $address){
							//print_r($address);
							?>
							<div class="tab_address_lum tab_address_list" id="tab_address<?=$address->id?>">
								<h4><?php echo $address->Name;?></h4>
								<div class="tab_address_inner_lum">
									<p><?php echo $address->Address1;?></p>
									<p><?php echo $address->Address2 ;?></p>
									<p><?php echo $address->City ;?></p>
									<p><?php echo $address->State ;?></p>
									<p><?php echo $address->country ;?></p>
									<p><?php echo $address->Phone ;?></p>
								</div>
								<div class="class_space_lum"><button type="button" class="class_button_lum add_open blue-btn" id="add_open<?php echo $j ?>">Edit</button>
								<button id="addressdelete" class="class_button_lum addressdelete blue-btn" data-attr="<?=$address->id?>">Delete</button></div>
							</div>
							<?php

							$j++;
							} ?>
						</div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab_spac_lum">
                            <div id="account_tab_address_lum" class="tab_address_lum">
								<p class="subtitle">Add a new address</p>
                                <form name="checkout" id="checkout" class="form" method="post" action="<?php echo $this->config->item('base_url_temp');?>home/addaddress">
                                <div class="form-group">
                                	<label>Name :</label>
                                    <input  id="Nameadd" class="tab_address_lum_input Nameadd form-control" type="text" name="Name" />
                                </div>   
								<div class="form-group">
                                	<label>Address1</label>	 
                                    <input id="Address1add" class="tab_address_lum_input Address1add form-control" type="text" name="Address1" />
                                </div>
								<div class="form-group">
                                	<label>Address2</label>	  
                                    <input  id="Address2add" class="tab_address_lum_input form-control" type="text" name="Address2" />
                                </div>
								<div class="row">
									<div class="col-md-6">	
                               			<div class="form-group">
											<label>City</label>	
											<input id="Cityadd" class="tab_address_lum_input Cityadd form-control" type="text" name="City" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>State</label>	
											<input  id="Stateadd" class="tab_address_lum_input Stateadd form-control" type="text" name="State" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">									
										<div class="form-group">
											<label>Zip</label>	
											<input   id="Zipadd" class="tab_address_lum_input Zipadd form-control" pattern="[0-9]{6}" type="text" name="Zip" required/>
										</div>
									</div>
									<div class="col-md-6">
                               			<div class="form-group">
											<label>Country</label>	
											<input  id="countryadd" class="tab_address_lum_input countryadd form-control" type="text" name="country"  pattern="[A-Za-z]+" title="Please enter proper country name" required  />
                                		</div>
                                	</div>
								</div>
								<div class="form-group">
                                	<label>Phone</label>	
                                    <input  maxlength=10 id="Phoneadd" class="tab_address_lum_input Phoneadd form-control" type="text" name="Phone" />
                                </div>
                                   
								<p class="subtitle">Additional Address Details</p>
								<div class="row">
									<div class="col-md-6">									
										<div class="form-group">
											<label>landmark</label>	
											<input class="tab_address_lum_input" type="text" name="landmark" />
										</div>
									</div>
									<div class="col-md-6">
                               			<div class="form-group">
											<label>address type</label>	
											<input class="tab_address_lum_input" type="text" name="add_type"/>
                                		</div>
                                	</div>
								</div>
								<button class="blue-btn" type="submit">ADD THIS ADDRESS</button>
                                </form>
                            </div>
                            <?php if($addressview != "" && count($addressview) >= 0)
                            {
                            $j=0;
                            foreach($addressview as $address)
                            {
                            ?>
                            
                            <div id="edit_add<?php echo $j ?>" class="edit_add" style="">
                                <form name="checkoutedit" id="checkoutedit<?php echo $j ?>" class="form" method="post"   action="<?php echo $this->config->item('base_url_temp');?>home/updateaddress">
									<INPUT TYPE="hidden" NAME="action" VALUE="updateaddress">
									<INPUT TYPE="hidden" NAME="addressid" VALUE="<?php echo $address->id; ?>">
									<p class="subtitle">EDIT address</p>
									<p>Be sure to click "Deliver to this address" when you've finished.</p>
									<div class="form-group">
										<label>Name</label>
										<input class="tab_address_lum_input Nameadd" type="text" id="Name<?php echo $j ?>" name="Name" value="<?php echo $address->Name; ?>" />
									</div>

									<div class="form-group">
										<label>ADDRESS LINE 1 </label><span id="errmsged<?php echo $j ?>"></span> <br />
										<input class="tab_address_lum_input Address1edit" type="text" value="<?php echo $address->Address1; ?>" id="Address1<?php echo $j ?>" name="Address1" />
									</div>

									<div class="form-group">
										<label>ADDRESS LINE 2 </label>
										<input class="tab_address_lum_input" type="text" value="<?php echo $address->Address2; ?>" id="Address2<?php echo $j ?>" name="Address2"/>
									</div>
									<div class="row">
										<div class="col-md-6">									
											<div class="form-group">
												<label>TOWN / CITY</label>
												<input class="tab_address_lum_input Cityadd" type="text" value="<?php echo $address->City; ?>" id="City<?php echo $j ?>" name="City" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>STATE</label>
												<input class="tab_address_lum_input Stateadd" type="text" value="<?php echo $address->State; ?>"  id="State<?php echo $j ?>" name="State" />
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">									
											<div class="form-group">
												<label>PINCODE</label>
												<input   id="Zipadd" class="tab_address_lum_input Zipadd" type="text" name="Zip" value="<?php echo $address->Zip; ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>COUNTRY</label>
												<input class="tab_address_lum_input countryadd" type="text" value="<?php echo $address->country; ?>" id="country<?php echo $j ?>" name="country"  pattern="[A-Za-z]+" title="Please enter proper country name" required />
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>MOBILE NUMBER</label> &nbsp;<span id="errmsg"></span><br />
										<input class="tab_address_lum_input Phoneadd"  maxlength=10  type="text" value="<?php echo $address->Phone; ?>"  id="Phone<?php echo $j ?>"  name="Phone" />
									</div>

									<div class="tab_address_lum_inner1">Additional Address Details</div>
									<div class="row">
										<div class="col-md-6">									
											<div class="form-group">
												<label>LAND MARK</label>
												<input class="tab_address_lum_input" type="text" name="landmark"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ADDRESS TYPE</label>
												<input class="tab_address_lum_input" type="text" name="add_type"/>
											</div>
										</div>
									</div>
									<button class="blue-btn" type="submit">UPDATE THIS ADDRESS</button>
                                </form>
                            </div>
                            
                            <?php
                            $j++;
                            }
                            ?>
                            <?php }
                            else
                            {
                            $address = "0";
                            }?>
                        </div>
                    </div>
                </div>
                
            </div>
			<!--End myaddress tab-->
        </div><!--End myAccountTabContent tab-->
	</div><!--End container tab-->
    
</section>

<script>
$( document ).ready(function() {
$(".edit_add").hide();
});
</script>
<script>
jQuery(function ($) {
$(".addressdelete").on("click",function(){
var adeId=$(this).attr("data-attr");
//alert(adeId);
$.ajax({
url:'<?= $base_url_temp ?>home/deleteaddress',
method:'POST',
data:{"id":adeId},
success:function(data){
$(".sessionmessge").html("Address Deleted Succesfully");

$("#tab_address"+adeId).html("");
//	location.reload();
}
})
})
});

</script>
<script>
$('.add_open').click(function()
{
$(".edit_add").hide();
$(".add_open").show();
$("#account_tab_address_lum").hide();

var avoided = (this.id).replace('add_open','');

var editshow="edit_add"+avoided;
$("#"+editshow).show('slow');
$("#"+this.id).hide('slow');

});


$('.lum_switch').hover(function() {
$(this).find('.lum_avg_words').hide();
$(this).find('.lum_avg_num').show();
});
$('.lum_switch').mouseleave(function() {
	$(this).find('.lum_avg_num').hide();
	$(this).find('.lum_avg_words').show();
	//$('.lum_avg_words').addClass('active').siblings().removeClass('active');
});
$('.lum_switch').click(function() {
	$(this).find('.lum_avg_num').hide();
	$(this).find('.lum_avg_words').show();

	$('.lum_avg_words_dis').removeClass("lum_avg_words_dis").addClass("lum_avg_words");
	$('.lum_avg_num_dis').removeClass("lum_avg_num_dis").addClass("lum_avg_num");

	$('.lum_avg_words').show();
	$('.lum_avg_num').hide();

	$(this).find('.lum_avg_words').removeClass("lum_avg_words").addClass("lum_avg_words_dis");
	$(this).find('.lum_avg_num').removeClass("lum_avg_num").addClass("lum_avg_num_dis");

	 $(this).find('.lum_avg_words_dis').hide();
	 $(this).find('.lum_avg_num_dis').show();
	//$('.lum_avg_words').addClass('active').siblings().removeClass('active');
});

</script>
<script>
//an image width in pixels
var imageWidth = 300;


//DOM and all content is loaded
$(window).ready(function() {

	var currentImage = 0;

	//set image count
	var allImages = $('#slideshow li div').length;

	//setup slideshow frame width
	$('#slideshow ul').width(allImages*imageWidth);

	//attach click event to slideshow buttons
	$('.slideshow-next').click(function(){

		//increase image counter
		currentImage++;
		//if we are at the end let set it to 0
		if(currentImage>=allImages) currentImage = 0;
		//calcualte and set position
		setFramePosition(currentImage);

					for(var i=0;i<6;i++)
					{
						var j='#lum_des_content'+i;
						var k='#slideshow_item'+i;
							if(currentImage==i)
							{
								$(j).show();
								$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
							}
							else
							{
								$(j).hide();
								$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
							}
					}


		 });

	$('.slideshow-prev').click(function(){

		//decrease image counter
		currentImage--;
		//if we are at the end let set it to 0
		if(currentImage<0) currentImage = allImages-1;
		//calcualte and set position
		setFramePosition(currentImage);

					for(var i=0;i<6;i++)
					{
						var j='#lum_des_content'+i;
						var k='#slideshow_item'+i;
							if(currentImage==i)
							{
								$(j).show();
								$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
							}
							else
							{
								$(j).hide();
								$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
							}
					}
	});

});

//calculate the slideshow frame position and animate it to the new position
function setFramePosition(pos){

	//calculate position
	var px = imageWidth*pos*-1;
	//set ul left position
	$('#slideshow ul').animate({
		left: px
	}, 300);
}

function slideshow_itemer(vari)
{
	for(var i=0;i<6;i++)
	{
		var j='#lum_des_content'+i;
		var k='#slideshow_item'+i;
			if(vari==i)
			{
				$(j).show();
				$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
			}
			else
			{
				$(j).hide();
				$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
			}
	}

}

function lum_sub_sub_menu(fsd)
{
	for(var i=0;i<4;i++)
	{
		var j='#lum_right_sub_sub'+i;
		var k='#lum_sub_sub_menu'+i;
			if(fsd==i)
			{
				$(j).show();
				$(k).removeClass("lum_sub_sub_menu_vertical").addClass("lum_sub_sub_menu_vertical_active");
			}
			else
			{
				$(j).hide();
				$(k).removeClass("lum_sub_sub_menu_vertical_active").addClass("lum_sub_sub_menu_vertical");
			}
	}

}
</script>
