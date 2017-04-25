<?php header("Content-type: application/javascript");?>

	/***** VARIABLE DECLARATION ********/
		/***** VARIABLE DECLARATION ********/
			/***** VARIABLE DECLARATION ********/
				/***** VARIABLE DECLARATION ********/

	var api_url= "http://textronic.online/api_Stylior/v1/img?";
	var base_fabric="9A77A2D9";
	//**** Note *** to change shirt fabric, you need to change the swatch for model,collar and placket....
	//***
	// var shirtFabric='57EB2652';
	// var liningFabric='6A2AC8B5';
	/*http://textronic.online/api_stylior/v1/img?
	part=WCNORMALCUT&swatch=D8C239F2/
	part=WC4BTN&pair=WCNORMALCUT/
	part=WCBUCKET&swatch=835BDEC0/
	part=WC2FLAP&swatch=D8C239F2/*/
	var Obj3d={
		'front_bottom':{'part':'WCNORMALCUT','swatch':base_fabric},
		'jacket_button':{'part':'WC4BTN&','pair':'WCNORMALCUT'},
		'back_detail':{'part':'WCBUCKET','swatch':base_fabric},
		'pocket':{'part':'WC2FLAP','swatch':base_fabric},
	    'face_type':{'view':''},
	};
	var make_url="";
	changeFabricInfo(base_fabric);

	$(document).ready(function(){
		console.clear();
		for (var key in Obj3d) {
			//make_url+=Obj3d[key]+"/";
			for(var i_key in Obj3d[key]){
	            //console.log(Obj3d[key][i_key]);
		        make_url+=i_key+"="+Obj3d[key][i_key]+"&";
				// console.log(i_key+"="+Obj3d[key][i_key]);
				// console.log("&");

			}
			make_url+="/";
		}
		$(".processimage").attr("src", api_url+make_url);
		$(".changeOption").click(function(){
			make_url="";
           	var value = $(this).attr("data")
			var value_key= $(this).attr("data-key")
			var lower_value_key = value_key.toLowerCase();
			var replaced = lower_value_key.split(' ').join('_');
			Obj3d['face_type']['view']="";

			if(replaced=="back_detail"){
				Obj3d['face_type']['view']='back';
			}
            Obj3d[replaced]['part']=value
			for (var key in Obj3d) {
				for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
				}
				make_url+="/";
			}

			$(".processimage").attr("src","");
			//do stuff
			//var exists = urlExists(api_url+make_url);
			//do more stuff based on the boolean value of exists
			// Then what you have to do is:

			// loadingmessage
			$(".processimage").attr("src", api_url+make_url);
 			$('#loadingmessage').hide();
		});

		$(".swatchchangeOption").click(function(){
			make_url="";
			var fabric_key=$(this).attr("data-part");
			base_fabric=fabric_key;
			changeFabricInfo(base_fabric);
			Obj3d['face_type']['view']='';
			for (var key in Obj3d) {
					Obj3d[key]['swatch']=base_fabric
						for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
						}
						make_url+="/";
				}
				$(".processimage").attr("src", api_url+make_url);
	        });

});

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
          var exact_price = $("#current_product_price").val();
          var product_id = $("#current_product_id").val();
          var subcatid='18'; //17 suit is for subcategory...
          var ordertype="vest";
          var fabric_namevest = $(".current_title").html();
          if(loginUser)
          {
            $.ajax({
                url: base_url+"/cart/addToCartVest",
                type: 'POST',
                data:
                {
                  details : JSON.stringify(Obj3d) ,
                  price_vest : exact_price,
                  productid_vest : product_id ,
                  subcatid_vest : subcatid ,
                  pname_vest : fabric_namevest,
                  imagedata_vest : result,
                  ordertype:"vest",
                  order:"standard"
                 },
                success: function(response)
                {
				console.log(response);
					// return false;
	                $('#loadingmessage').hide();
		            window.location = "#vest_measurements";
	                //window.location = url;
                }
              });
          }
          else{
		    
		    $('#loadingmessage').show();
            $.ajax({
               url: base_url+"/cart/savedataforvest",
              type: 'POST',
              data:
                {
					details :  JSON.stringify(Obj3d),
					price_vest : exact_price,
					productid_vest : product_id ,
					subcatid_vest : subcatid ,
					pname_vest : fabric_namevest,
					imagedata_vest : result,
					ordertype:"vest",
					order:"standard"
                 },
              success: function(response)
              {
					console.log(response);
					$('#loadingmessage').hide();
					var url=base_url+'home/lum_login';
					window.location = url;
              }
            
            });
             return false;       
          }
}

/*end : add to cart*/
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
