<?php
header("Content-type: application/javascript");

?>

	/***** VARIABLE DECLARATION ********/
		/***** VARIABLE DECLARATION ********/
			/***** VARIABLE DECLARATION ********/
				/***** VARIABLE DECLARATION ********/
	var api_url= "http://textronic.online/api_Stylior/v1/img?";
	var base_fabric="2B65FFD4";
	var Obj3d={
		'pleats':{'part':'TRNOPLEAT','pair':'TRSLIM','swatch':base_fabric},
		'trouser_fit':{'part':'TRSLIM','pair':'TRNOPLEAT','swatch':base_fabric},
		'bottom_cuff':{'part':'TRCUFFYES','pair':'TRSLIM','swatch':base_fabric},
		'back_pocket':{'part':'TRNOPOCKET','pair':'TRSLIM','swatch':base_fabric,'view':''},
		'belt':{'part':'trsidetabwl','pair':'TRSLIM','swatch':base_fabric},
		'trouser_button':{'part':'TBBLACK','pair':'trsidetabwl','pairpair':'TRSLIM'},
    };
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
	changeFabricInfo(base_fabric);
	var make_url="";
	$(document).ready(function(){
		console.clear();
		$(".se-pre-con").hide();
		for (var key in Obj3d) {
			//make_url+=Obj3d[key]+"/";
			for(var i_key in Obj3d[key]){
				console.log("data comming here")
	            //console.log(Obj3d[key][i_key]);
		        make_url+=i_key+"="+Obj3d[key][i_key]+"&";

		        console.log(i_key+"="+Obj3d[key][i_key]);
					 console.log("&");

			}
		make_url+="/";
		}

		$(".processimage").make_url;
		$(".processimage").attr("src", api_url+make_url);
		$(".se-pre-con").hide();
		$(".changeOption").click(function(){
			  make_url="";
           /// Obj3d[loweer_value_key]="";
            var value = $(this).attr("data")
			var value_key= $(this).attr("data-key")
			var lower_value_key = value_key.toLowerCase();
			// Obj3d[lower_value_key]=value;
			console.log(value);
			var replaced = lower_value_key.split(' ').join('_');
			// alert(replaced);
			if(replaced=="back_pocket"){
				//alert("Am coming")
				Obj3d[replaced]['view']='back';
			}
			else{
				Obj3d['back_pocket']['view']='';
			}

            if(replaced=="pleats"){
				 Obj3d['trouser_fit']['pair']=value;
            }
			
			Obj3d[replaced]['part']=value
			// console.log(Obj3d);
			
			for (var key in Obj3d) {
				//console.log(Obj3d[key]);
				// make_url+=Obj3d[key]+"&swatch="+base_fabric+"/";
                //Obj3d[key][key][swatch]=base_fabric;
				console.log("changeOption value"+value);
				if(replaced=="trouser_fit")
				Obj3d[replaced]['pair']='TRSINGLEPLEAT';
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

			changeFabricInfo(fabric_key);
			//console.log(fabric_key);
			base_fabric=fabric_key;
			cuff_constrast_fabric=collar_constrast_fabric=placket_constrast_fabric=base_fabric
			for (var key in Obj3d) {
					Obj3d[key]['swatch']=base_fabric
					    //make_url+=Obj3d[key]+"/";
						for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
						}
						make_url+="/";
				}
				$(".processimage").attr("src", api_url+make_url);
    			$(".se-pre-con").hide();
	        });
			/******* To change the view of modal-shirt
			****     toggle button : front and back view
			****     Shirt-3d page
			****
			*****/
			$("#backface_trouser").click(function(){
				//alert("Var")
				make_url="";


	        	if(Obj3d['back_pocket']['view']=='back'){
	              Obj3d['back_pocket']['view']='';
	        	}
	        	else{
	              Obj3d['back_pocket']['view']='back';
	        	}

				for (var key in Obj3d) {
					for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
					}
					make_url+="/";
				}
		    	$(".processimage").attr("src", api_url+make_url);

		});
	}); /*end of jquery*/

	function changeFabricInfo(c_key){
		  		var  fabric_title=$(".product-title-"+c_key).html();
		  		var  fabric_price=$(".product-price-"+c_key).html();
		  		var  fabric_pattern=$(".product-pattern-"+c_key).html();
				var  fabric_color=$(".product-color-"+c_key).html();
				var  fabric_threadcount=$(".product-threadcount-"+c_key).html();
				var  fabric_product_id=$(".product-id-"+c_key).html();
				//alert(fabric_pattern);
				//alert($(".current_pattern").html())
				// $(".current_pattern").text("solid");
				/*convert pattern number to pattern name and color no to color name*/
				var option = $(this).find('a').attr('data-part');
				var color = ('color_' + $('.product-color-' + option).text()).replace(/\s/g,'');
				var pattern = ('pattern_' + $('.product-pattern-' + option).text()).replace(/\s/g,'');
				var color_value = $('#' + color).text();
				var pattern_value = $('#' + pattern).text();
				if(color_value!="" && pattern_value!="")
				{
					$(".current_pattern ").html(pattern_value);
					$(".current_color").html(color_value);
				}
				/*end color patter*/
				// $(".current_pattern").html(fabric_pattern)
		  		// alert(fabric_title+""+fabric_price+"color"+fabric_color);
		 		$(".current_title").html(fabric_title);
				$(".current_price ").html(fabric_price);
				$("#current_product_price").val(fabric_price.split(' ')[1]);
				// $(".current_color").html(fabric_color);
				$(".current_threadcount").html(fabric_threadcount);
				$("#current_product_id").val(fabric_product_id.trim());

		}


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
					//$("#pattern_select").val("-1");
					// $("#color_slect").val("-1");
					// $("#price_range_select").val("-1");
				}
		}
		// function sort_li(a, b){
		// var data= ($(b).data('price')) < ($(a).data('price')) ? 1 : -1;
		// console.log("data"+data);
		// return ($(b).data('price')) < ($(a).data('price')) ? 1 : -1;
		// }


/**************Fucntion:addtocart function ********
************* Ajax function with loggedin and without login**
************
******/
/* start : add to cart function */
function addToCart(loginUser)
{

		var base_url = "https://www.stylior.com/";
	 	var exact_price = $("#current_product_price").val();
		var product_id = $("#current_product_id").val();
		var fabric_name = $(".current_title").html();
		//var loginUser="<?php echo $_SESSION['user_id']; ?>";
		var result=$(".processimage").attr("src");
		// alert(loginUser);
		//return false;
		//Obj3d.monogram=monogram.monogram;
		//console.log("no login info"+loginUser);
		//return false;
		//var details = JSON.stringify(Obj3d);
		// console.log(details);
		// console.log("Only display string===");
		// console.log(Obj3d);
		// return false;
		if(loginUser)
		{
				//console.log("user is logged in");
				$.ajax({
						url: base_url+"cart/addToCartTrouser",
						type: 'POST',
						 beforeSend: function()
						 {
						  $(".se-pre-con").show();
						 },
						data: {
							details : JSON.stringify(Obj3d) ,
							price_p : exact_price,
							productid_p : product_id ,
							subcatid_p : '11' ,
							pname_p : fabric_name,
							imagedata_p : result,
							ordertype:"pant",
							order:"custom"
					   },
		    		   success: function(response)
					   {
							console.log(response);
			             // return false;
			            //    $(".se-pre-con").fadeOut("slow");
						//window.location.href= base_url+"home/lum_saved_profile";
						/*//location.reload();
						$('.cd-tabs').show();
						$('html,body').animate({ scrollTop: $('.cd-tabs').offset().top }, 500);
						*/
			              window.location = "#trouser_measurements";

						}

					});

			}
			else{
				//console.log("No user");
				$.ajax({
 				   url: "https://www.stylior.com/cart/saveSelectionDatacombined",
 					type: 'POST',
 					beforeSend: function()
 					{
 						$(".se-pre-con").show();
 					},
 					data: {
 						details : JSON.stringify(Obj3d) , price_pant : exact_price, productid_pant : product_id ,  subcatid_pant : '11' ,	pname_pant : fabric_name,imagedata_pant: result,ordertype:"pant",order:"custom"
 				   },
 				   success: function(response)
 					{
 			    		$(".se-pre-con").fadeOut("slow");
	        			var url=base_url+'home/lum_login';
 						window.location = url;
 					}
 				});
				return false;

			}

}
/*end : add to cart*/
