<?php header("Content-type: application/javascript");?>
	/***** VARIABLE DECLARATION ********/
		/***** VARIABLE DECLARATION ********/
			/***** VARIABLE DECLARATION ********/
				/***** VARIABLE DECLARATION ********/
	var api_url= "http://textronic.online/api_Stylior/v1/img?";
	var base_fabric="B40522A2";

	// var Obj3d={
	// 	'pleats':{'part':'TRNOPLEAT','pair':'TRSLIM','swatch':base_fabric},
	// 	'trouser_fit':{'part':'TRSLIM','pair':'TRNOPLEAT','swatch':base_fabric},
	// 	'bottom_cuff':{'part':'TRCUFFYES','pair':'TRSLIM','swatch':base_fabric},
	// 	'back_pocket':{'part':'TRNOPOCKET','pair':'TRSLIM','swatch':base_fabric,'view':''},
	// 	'belt':{'part':'trsidetabwl','pair':'TRSLIM','swatch':base_fabric},
	// 	'trouser_button':{'part':'TBBLACK','pair':'trsidetabwl','pairpair':'TRSLIM'},
	//    };

	//**** Note *** to change shirt fabric, you need to change the swatch for model,collar and placket....
	//***

	var shirtFabric='BA0A483A';
	var liningFabric='6A2AC8B5';

	var Obj3d={
			'model':{'part':'SUITSHIRT','pair':'SUITSLIM','swatch':shirtFabric},
			'tie':{'part':'BTIE','swatch':base_fabric},
			'vest_coat':{'part':'','swatch':base_fabric},
			'inner_lining':{'part':'LININGSTYLE','swatch':liningFabric},
			'jacket_style':{'part':'1BTN','pair':'','pairpair':'','swatch':base_fabric},
			'suspender_button':{'part':'','swatch':base_fabric},
			'body_fit':{'part':'SUITSLIM','pair':'','pairpair':'','swatch':base_fabric},
			'collar':{'part':'SUITCOLLAR','pair':'SUITSLIM','swatch':shirtFabric},
			'cutaway':{'part':'SUITCUT','pair':'SUITSLIM','pairpair':'1BTN','swatch':base_fabric},
			'placket':{'part':'SUITPLCK','pair':'SUITSLIM','swatch':shirtFabric},
			'lapel':{'part':'NOTCH','pair':'SUITSLIM','pairpair':'1BTN','swatch':base_fabric},
			'jacket_button':{'part':'JBROWN','pair':'1BTN','swatch':base_fabric},
			'vents':{'part':'SINGLEVENT','pair':'SUITSLIM','swatch':base_fabric},
			'suit_pocket':{'part':'SUITSLIM','pair':'STRAIGHTTICKET','swatch':base_fabric},
			'chest_pocket':{'part':'CHESTPATCH','pair':'','swatch':base_fabric},
			'lapel_button_hole':{'part':'LWHITE','pair':'NOTCH','pairpair':'1BTN','swatch':base_fabric},
			'cuff_accent_stitching':{'part':'','pair':'','swatch':base_fabric},
			'cuff_button_style':{'part':'CSBROWN','pair':'','pairpair':'','swatch':base_fabric},
			'pleats':{'part':'SSPLEAT','pair':'SUITSLIM','swatch':base_fabric},
			'belt':{'part':'SWITHLOOP','pair':'SUITSLIM','swatch':base_fabric},
			'bottom_cuff':{'part':'BCYES','pair':'SUITSLIM','swatch':base_fabric},
			'back_pocket':{'part':'BPSINGLE','pair':'SUITSLIM','swatch':base_fabric},
			'trouser_button':{'part':'STBBLACK','pair':'SUITSLIM','swatch':base_fabric},
	        'face_type':{'view':''},
		};
		changeFabricInfo(base_fabric);
		// http://textronic.online/api_stylior/v1/img?part=STRAIGHTTICKET&swatch=479954AA
		// /part=CHESTPATCH&swatch=479954AA
		// /part=1BTN&swatch=479954AA
		// /part=SUITSLIM&pair=CHESTPATCH
		// /part=SUITSLIM&pair=STRAIGHTTICKET&swatch=479954AA
		// /part=SUITCUT&pair=SUITSLIM&pairpair=1BTN&swatch=479954AA
		// /part=NOTCH&pair=SUITSLIM&pairpair=1BTN&swatch=479954AA
		// /part=JBROWN&pair=1BTN
		// /part=SINGLEVENT&pair=SUITSLIM&swatch=479954AA
		// /part=LWHITE&pair=NOTCH&pairpair=1BTN/
		// /part=CSBROWN
		// /part=SSPLEAT&pair=SUITSLIM&swatch=479954AA
		// /part=SWITHLOOP&pair=SUITSLIM&swatch=479954AA
		// /part=BCYES&pair=SUITSLIM&swatch=479954AA
		// /part=STBBLACK&pair=SUITSLIM
		// /part=BPSINGLE&pair=SUITSLIM&swatch=479954AA
		// /part=SUITSHIRT&pair=SUITSLIM
		// /part=SUITCOLLAR&pair=SUITSLIM
		// /part=SUITPLCK&pair=SUITSLIM
		// /part=LININGSTYLE
		// /part=BTIE/
		/*
		part=TBBLACK&pair=TRSIDETABWL&pairpair=TRSLIM
		part= <trouser button value>
		pair=<Belt value>
		pairpair=<Fit value>
		*/
		//part=TRNOPOCKET&swatch=base_fabric&view=back
		//part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1&pair=SQUARE&swatch=587196E1
		/*'button_7':  'http://textronic.online/api_Stylior/v1/img?part=BLACK1&pair=REGULAR/',
		'button_3':'part=BLACK1&pair=BOX',
		'button_4':'part=BLACK1&pair=SQUARE&swatch=587196E1',
		*/
		// 'model'
		// 'buttons'
		// 'pocket'
		// 'sleeve'
		// 'cuff'
		// 'back_pleat'
		// 'collar'
		// 'elbow_patch'
		// 'placket'
		// 'button_holes'
		// 'button_thread'
		// 'bottom_hem'
		// 'stylior_logo'
		//console.log(Obj3d);
	var make_url="";
	$(document).ready(function(){
	// change data-key of cuff button jacket_style

	// var option = $(".jacket-button-details").find('h4').text();
	// $('#show_button > a').attr('data',"CS" + option);
	// $('#kissing_button > a').attr('data',"CK" + option);

	//console.clear();

  //apply default data and price to summary details...
  for (var key in Obj3d) {
			//make_url+=Obj3d[key]+"/";
			for(var i_key in Obj3d[key]){
	            //console.log(Obj3d[key][i_key]);
		        make_url+=i_key+"="+Obj3d[key][i_key]+"&";
				// console.log(i_key+"="+Obj3d[key][i_key]);
				// console.log("&");

			}
			make_url+="/";
			// console.log("/");
			// console.log("key value");
			// console.log(key);
			// console.log("obj value");
			// console.log(Obj3d.key);
		}
		//$(".processimage").make_url;
		console.log(make_url);
		$(".processimage").attr("src", api_url+make_url);

		$(".changeOption").click(function(){
			make_url="";
           	//Obj3d[loweer_value_key]="";
            var value = $(this).attr("data")
			var value_key= $(this).attr("data-key")
			var lower_value_key = value_key.toLowerCase();
			//Obj3d[lower_value_key]=value;
			console.log(value);
			var replaced = lower_value_key.split(' ').join('_');
			//alert(replaced);
			Obj3d['face_type']['view']="";
			if(replaced=="jacket_style"){

				Obj3d['cutaway']['pairpair']=value
				Obj3d['lapel']['pairpair']=value
				Obj3d['lapel_button_hole']['pairpair']=value
				 Obj3d['jacket_style']['pair']=value
				Obj3d['jacket_style']['part']=value
				if(value=="1BTN")
				{
					//alert("testestset")
					$('[data=SHAWL]').css('display', 'block');
				}
				else{
					$('[data=SHAWL]').css('display', 'none');
				}
			    //Obj3d['face_type']['view']="backopen";
				//part=JBLACK&pair=4BTNDB
			}
			else if(replaced=="suspender_button"||replaced=="inner_lining"||replaced=="pleats"||replaced=="belt"||replaced=="trouser_button"){
				Obj3d['face_type']['view']="faceopen";
			}
			else if(replaced=="suit_pocket"||replaced=="chest_pocket"){
                Obj3d[replaced]['pair']=value;
			}
			else if(replaced=="vents"||replaced=="cuff_accent_stitching"||replaced=="cuff_button_style"){
				Obj3d['face_type']['view']="back";

			}
			else if(replaced=="back_pocket"  ){
				Obj3d['face_type']['view']="backopen";
			}

          		// else{
			// 	Obj3d['back_pocket']['view']=' ';
			// }
			//          if(replaced=="pleats"){
			// 	 Obj3d['trouser_fit']['pair']=value;
			//          }

            if(replaced=="suit_pocket"||replaced=="chest_pocket"||replaced=="jacket_style")
		    {
		    		Obj3d[replaced]['part']=Obj3d['model']['pair'];
					if(replaced=="jacket_style"){
						//hide this to show complete suit

						// Obj3d[replaced]['part']=Obj3d['jacket_button']['part'];
						Obj3d[replaced]['part']=Obj3d['jacket_button']['pair'];
						Obj3d['jacket_button']['pair']=value;
					}
		    }
		    else if(replaced=="cuff_button_style"){
					var button_val = Obj3d['jacket_button']['part'];
					var res = button_val.substring(1);
					Obj3d['cuff_button_style']['part'] = value+""+res;

			}
			else
		    {
		    	Obj3d[replaced]['part']=value
		    }
			//console.log(Obj3d);
			for (var key in Obj3d) {
				//console.log(Obj3d[key]);
				// make_url+=Obj3d[key]+"&swatch="+base_fabric+"/";
				//Obj3d[key][key][swatch]=base_fabric;
				///	console.log("changeOption value"+value);
				//				if(replaced=="trouser_fit")
				//Obj3d[replaced]['pair']='TRSINGLEPLEAT';

				for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
				}
				make_url+="/";
			}
			//$(".processimage").make_url);
			$(".processimage").attr("src","");
			console.log(make_url);
			$(".processimage").attr("src", api_url+make_url);
		});

		$(".swatchchangeOption").click(function(){
			console.log("This is testing");
			make_url="";
			var fabric_key=$(this).attr("data-part");
			//console.log(fabric_key);
			changeFabricInfo(fabric_key);
			console.log(fabric_key);
			base_fabric=fabric_key;
			cuff_constrast_fabric=collar_constrast_fabric=placket_constrast_fabric=base_fabric
			for (var key in Obj3d){
					Obj3d[key]['swatch']=base_fabric
					Obj3d['model']['swatch']=shirtFabric
					Obj3d['collar']['swatch']=shirtFabric
					Obj3d['placket']['swatch']=shirtFabric
					Obj3d['inner_lining']['swatch']=liningFabric
					//make_url+=Obj3d[key]+"/";
						for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
						}
						make_url+="/";
				}
				$(".processimage").attr("src", api_url+make_url);
	        });

	/******
	*** rotate image front and back..
	******/
	$(".backface").click(function(){
			make_url="";

        	if(Obj3d['face_type']['view']==''){
				Obj3d['face_type']['view']="back";
        	}
        	else{
             	Obj3d['face_type']['view']='';
        	}

		for (var key in Obj3d) {
						for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
						}
						make_url+="/";
		}
		//$('#fabricModal').modal('hide');
		$(".processimage").attr("src", api_url+make_url);

	});
	// <button><a href="#" id="changeShirtFabric" class="changeShirtFabric">Shirt Change</a></button>
	//<button><a href="#" id="changeTie" class="changeTie">Tie Change</a></button>
	//<button><a href="#" id="changeLining" class="changeLining">Lining Change</a></button>
	var current_fid="";
	$(".changeShirtFabric,.changeTie,.changeLining").click(function(){
			current_fid=$(this).attr("id").split(" ")[0]
		$('#fabricModal').modal('show');
	});

	$(".subfabric").click(function(){
		make_url="";
		Obj3d['face_type']['view']="";
		//alert("fabric selected");
		//alert(current_fid)
		var shirtFabricKey =  $(this).attr('data-part');
		if(current_fid=="changeShirtFabric"){
				Obj3d['model']['swatch']=shirtFabricKey
				Obj3d['collar']['swatch']=shirtFabricKey
				Obj3d['placket']['swatch']=shirtFabricKey
		}
		else if(current_fid=="changeTie"){
				Obj3d['tie']['swatch']=shirtFabricKey
		}
		else if(current_fid=="changeLining"){
				Obj3d['inner_lining']['swatch']=shirtFabricKey
				Obj3d['face_type']['view']="faceopen"
		}

		for (var key in Obj3d) {
						for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
						}
						make_url+="/";
		}
		$('#fabricModal').modal('hide');
		$(".processimage").attr("src", api_url+make_url);
   });


//  function  renderImage(){

// alert(Obj3d['face_type']['view'])
// 	for (var key in Obj3d) {
// 		for(var i_key in Obj3d[key]){
// 			make_url+=i_key+"="+Obj3d[key][i_key]+"&";
// 		}
// 			make_url+="/";
// 		}
// 		console.log(make_url)
// 		$(".processimage").attr("src", api_url+make_url);

// 	}







});


/********* Filter on price, color and pattern
*****  function to filter fabrics
*****   date 10 march 17
**(****)
**********/

/*filter on fabrics*/
function filterData(type,id){
		//if color : colorid
		//if pattern : pattern id
		//if Range : ASC / DESC
		//alert("testestest"+type+"id"+id);
		if(type=="color")
		{
	        $('.displayfitler').hide();
			$("[data-color='"+id+"']").each(function(){
				$("[data-color='"+id+"']").show();
			});

		}
		else if(type=="range")
		{


				var $wrapper = $('#fabric_options');
		        if(id=="ASC"){

				$wrapper.find('.displayfitler').sort(function(a, b) {
				    return +a.getAttribute('data-price') - +b.getAttribute('data-price');
				})
						    .appendTo($wrapper);

				}
				else
				{
				$wrapper.find('.displayfitler').sort(function(a, b) {
				    return +b.getAttribute('data-price') - +a.getAttribute('data-price');
				})
				.appendTo($wrapper);
				}

		}
		else if(type=="pattern"){

	        $('.displayfitler').hide();
			$("[data-pattern='"+id+"']").each(function(){
	  		  $("[data-pattern='"+id+"']").show();
			});

		}
		else if(type == "clear"){
	        $('.displayfitler').show();
	  //       $("#pattern_select").val("-1");
			// $("#color_slect").val("-1");
			// $("#price_range_select").val("-1");
		}

}


function sort_li(a, b){
		var data= ($(b).data('price')) < ($(a).data('price')) ? 1 : -1;
		console.log("data"+data);
	    return ($(b).data('price')) < ($(a).data('price')) ? 1 : -1;
}

function changeFabricInfo(c_key){
  		var fabric_title=$(".product-title-"+c_key).html();
  		var fabric_price=$(".product-price-"+c_key).html();
  		var  fabric_pattern=$(".product-pattern-"+c_key).html();
		var  fabric_color=$(".product-color-"+c_key).html();
		var  fabric_threadcount=$(".product-threadcount-"+c_key).html();
		var  fabric_product_id=$(".product-id-"+c_key).html();
		// alert(fabric_product_id);
  		//alert(fabric_title+""+fabric_price+"color"+fabric_color);
 		$(".current_title").html(fabric_title);
		$(".current_price ").html(fabric_price);
		$("#current_product_price").val(fabric_price.split(' ')[1]);
		//color and pattern are replacing with different code,, just comment it ...
		//$(".current_pattern ").html(fabric_pattern);
		//$(".current_color").html(fabric_color);
		$(".current_threadcount").html(fabric_threadcount);
		$("#current_product_id").val(fabric_product_id.trim());
}

/**************Fucntion:addtocart function ********
************* Ajax function with loggedin and without login**
************
******/
/* start : add to cart function */
function addToCart(loginUser)
{
          var result = $(".processimage").attr("src"); //get image here"<?= $https_url_large_img."".$cmsf->image;?>";
          base_url = 'https://www.stylior.com/'; //'<? echo $bas_ul ?>';
          console.log(result);
          //return false;
          var exact_price = $("#current_product_price").val();
          var product_id = $("#current_product_id").val();
          var subcatid='17'; //17 suit is for subcategory...
          var ordertype="suit";
          var fabric_namesuit = $(".current_title").html();
          //alert(fabric_namesuit)
          //var loginUser='<?php echo $_SESSION['user_id']; ?>';

          if(loginUser)
          {
            $.ajax({
                url: base_url+"/cart/addToCartSuit",
                type: 'POST',
                data:
                {
                  details : JSON.stringify(Obj3d) ,
                  price_suit : exact_price,
                  productid_suit : product_id ,
                  subcatid_suit : subcatid ,
                  pname_suit : fabric_namesuit,
                  imagedata_suit : result,
                  ordertype:"suit",
                  order:"standard"
                 },
                success: function(response)
                {
                	console.log("THis is testing")

					console.log(response);
	                $('#loadingmessage').hide();
		            window.location = "#suit_measurements";
	                //var url=base_url+'cart/lum_view_cart';
	                window.location = url;

                }
              });
          }
          else{
			//alert(fabric_namesuit)

		    $('#loadingmessage').show();
            $.ajax({
               url: base_url+"/cart/savedataforsuit",
              type: 'POST',
              data:
                {
                  details :  JSON.stringify(Obj3d),
                  price_suit : exact_price,
                  productid_suit : product_id ,
                  subcatid_suit : subcatid ,
                  pname_suit : fabric_namesuit,
                  imagedata_suit : result,
                  ordertype:"suit",
                  order:"stnadard"
                 },
              success: function(response)
              {
                console.log(response);
                //return false;
                  $('#loadingmessage').hide();
                var url=base_url+'home/lum_login';
                //alert(url);
                window.location = url;
              }
            });
            return false;
          }

	 	//end of buy_now..
		// 	var base_url = "https://www.stylior.com/";
		//  	var exact_price = $("#current_product_price").val();
		// 	var product_id = $("#current_product_id").val();
		// 	var fabric_name = $(".current_title").html();
		// 	// var loginUser="<?php echo $_SESSION["user_id"]; ?>";
		// 	var result=$(".processimage").attr("src");
		// 	//Obj3d.monogram=monogram.monogram;
		// 	//console.log("no login info"+loginUser);
		// 	//return false;
		// 	//console.log(result);
		// 	//var details = JSON.stringify(Obj3d);
		// 	// console.log(details);
		// 	// console.log("Only display string===");
		// 	// console.log(Obj3d);
		// 	// return false;
		// if(loginUser)
		// 	{
		// 			//console.log("user is logged in");
		// 			$.ajax({
		// 					url: base_url+"cart/addcart3dcombined",
		// 					type: 'POST',
		// 					 beforeSend: function()
		// 					 {
		// 					  $(".se-pre-con").show();
		// 					 },
		// 					data: {
		// 						details : JSON.stringify(Obj3d) ,
		// 						price_shirt : exact_price,
		// 						productid_shirt : product_id ,
		// 						subcatid_shirt : '10' ,
		// 						pname_shirt : fabric_name,
		// 						imagedata_shirt : result,
		// 						ordertype:"shirt",
		// 						order:"custom"
		// 				   },
		// 					success: function(response)
		// 					{
		// 						console.log(response);
		// 		                //return false;
		// 		                $(".se-pre-con").fadeOut("slow");
		// 						//window.location.href= base_url+"home/lum_saved_profile";
		// 						/*							//location.reload();
		// 						$('.cd-tabs').show();
		// 						$('html,body').animate({ scrollTop: $('.cd-tabs').offset().top }, 500);
		// 						*/
		// 		              window.location = "#suit_measurements";
		// 					}
		// 				});
		// 		}
		// 		else{
		// 			//console.log("No user");
		// 			$.ajax({
		// 				   url: "https://www.stylior.com/cart/saveSelectionDatacombined",
		// 					type: 'POST',
		// 					beforeSend: function()
		// 					{
		// 						$(".se-pre-con").show();
		// 					},
		// 					data: {
		// 						details : JSON.stringify(Obj3d) , price_shirt : exact_price, productid_shirt : product_id ,  subcatid_shirt : '10' ,	pname_shirt : fabric_name,imagedata_shirt: result,ordertype:"shirt",order:"custom"
		// 				   },
		// 				   success: function(response)
		// 					{
		// 						  $(".se-pre-con").fadeOut("slow");
		// 						var url=base_url+'home/lum_login';
		// 						window.location = url;
		// 					}
		// 				});
		// 			return false;
		// 		}





}
/*end : add to cart*/
