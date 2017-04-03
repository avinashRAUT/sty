<?php header("Content-type: application/javascript");?>
	/***** VARIABLE DECLARATION ********/
		/***** VARIABLE DECLARATION ********/
			/***** VARIABLE DECLARATION ********/
				/***** VARIABLE DECLARATION ********/
	var api_url= "http://textronic.online/api_Stylior/v1/img?";
	var base_fabric="B40522A2";
	//**** Note *** to change shirt fabric, you need to change the swatch for model,collar and placket....
	//***
	var shirtFabric='F5F6F549';
	var liningFabric='6A2AC8B5';

	var Obj3d={
			'model':{'part':'JSHIRT','pair':'JSLIM','swatch':shirtFabric},
			'tie':{'part':'JTIE','swatch':base_fabric},
			'inner_lining':{'part':'JLININGSTYLE','swatch':liningFabric},
			'jacket_style':{'part':'J1BTN','pair':'','pairpair':'','swatch':base_fabric},
			'body_fit':{'part':'JSUITSLIM','pair':'','pairpair':'','swatch':base_fabric},
			'collar':{'part':'JCOLLAR','pair':'JSLIM','swatch':shirtFabric},
			'cutaway':{'part':'JCUTAWAY','pair':'JSLIM','pairpair':'JSB','swatch':base_fabric},
			'placket':{'part':'JPLACKET','pair':'JSLIM','swatch':shirtFabric},
			'lapel':{'part':'JNOTCH','pair':'JSLIM','pairpair':'JSB','swatch':base_fabric},
			'jacket_button':{'part':'JBBLACK','pair':'JSB','swatch':base_fabric},
			'vents':{'part':'JSINGLEVENT','pair':'JSLIM','swatch':base_fabric},
			'suit_pocket':{'part':'JSLIM','pair':'JSTRAIGHTPKT','swatch':base_fabric},
			'chest_pocket':{'part':'JSLIM','pair':'JCHESTSTD','swatch':base_fabric},
			'lapel_button_hole':{'part':'JLBLACK','pair':'JNOTCH','pairpair':'JSB','swatch':base_fabric},
	        'cuff_button_style':{'part':'JCSBLACK',},
	        'cuff_accent_stitching':{'part':'JCABLACK','pair':'JCSBLACK',},
	        'face_type':{'view':''},
		};
	var make_url="";
	changeFabricInfo(base_fabric);
	$(document).ready(function(){
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
		//$(".processimage").make_url;
		console.log(make_url);
		$(".processimage").attr("src", api_url+make_url);
		$(".loadingmessage").hide();
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
				Obj3d['jacket_style']['pair']=value;
				Obj3d['jacket_style']['part']=value;

				if(value=="JSB")
				{
					$('[data=KSHAWL]').css('display', 'block');
				}
				else{
					Obj3d['lapel']['part']='JNOTCH';
					$('[data=KSHAWL]').css('display', 'none');
					 
				}

			}
			else if(replaced=="suit_pocket"||replaced=="chest_pocket"){
                 	Obj3d[replaced]['pair']=value;

			}
			else if(replaced=="vents"||replaced=="cuff_accent_stitching"||replaced=="cuff_button_style"||replaced=="back_pocket"){
				Obj3d['face_type']['view']="back";
			}

            if(replaced=="suit_pocket"||replaced=="chest_pocket"||replaced=="jacket_style")
		    {
		    	Obj3d[replaced]['part']=Obj3d['model']['pair'];
					if(replaced=="jacket_style"){
						Obj3d[replaced]['part']=Obj3d['jacket_button']['part'];
						Obj3d['jacket_button']['pair']=value;

					}
		    }
			else
		    {
		    	Obj3d[replaced]['part']=value
		    }

			//console.log(Obj3d);
			for (var key in Obj3d) {
				for(var i_key in Obj3d[key]){
							make_url+=i_key+"="+Obj3d[key][i_key]+"&";
				}
				make_url+="/";
			}
			$(".processimage").attr("src","");
			console.log(make_url);
			$(".processimage").attr("src", api_url+make_url);

		});

		function showloader(){
			$(".loadingmessage").show()
		}

		$(".swatchchangeOption").click(function(){
			make_url="";
			var fabric_key=$(this).attr("data-part");
			base_fabric=fabric_key;
			changeFabricInfo(base_fabric);
			cuff_constrast_fabric=collar_constrast_fabric=placket_constrast_fabric=base_fabric
			for (var key in Obj3d) {
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
				$(".loadingmessage").hide();
	       });

	// <button><a href="#" id="changeShirtFabric" class="changeShirtFabric">Shirt Change</a></button>
	// 		<button><a href="#" id="changeTie" class="changeTie">Tie Change</a></button>
	// 		<button><a href="#" id="changeLining" class="changeLining">Lining Change</a></button>

	var current_fid="";
	$(".changeShirtFabric,.changeTie,.changeLining").click(function(){
			current_fid=$(this).attr("id")
		$('#fabricModal').modal('show');
	})

	$(".subfabric").click(function(){
		make_url="";
		Obj3d['face_type']['view']="";

		//alert("fabric selected");
       // alert(current_fid);
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
          var exact_price = $("#current_product_price").val();
          var product_id = $("#current_product_id").val();
          var subcatid='16'; //17 suit is for subcategory...
          var ordertype="blazer";
          var fabric_nameblazer = $(".current_title").html();

          if(loginUser)
          {
            $.ajax({
                url: base_url+"/cart/addToCartBlazer",
                type: 'POST',
                data:
                {
                  details : JSON.stringify(Obj3d) ,
                  price_blazer : exact_price,
                  productid_blazer : product_id ,
                  subcatid_blazer : subcatid ,
                  pname_blazer : fabric_nameblazer,
                  imagedata_blazer : result,
                  ordertype:"blazer",
                  order:"standard"
                 },
                success: function(response)
                {
                	
					console.log(response);
					// return false;
	                $('#loadingmessage').hide();
		            window.location = "#blazer_measurements";
	                window.location = url;

                }
              });
          }
          else{
		    $('#loadingmessage').show();
            $.ajax({
               url: base_url+"/cart/savedataforBlazer",
              type: 'POST',
              data:
                {
                  details :  JSON.stringify(Obj3d),
                  price_blazer : exact_price,
                  productid_blazer : product_id ,
                  subcatid_blazer : subcatid ,
                  pname_blazer : fabric_nameblazer,
                  imagedata_blazer : result,
                  ordertype:"blazer",
                  order:"standard"
                 },
              success: function(response)
              {
                console.log(response);
                // return false;
                $('#loadingmessage').hide();
                var url=base_url+'home/lum_login';
                //alert(url);
                window.location = url;
              }
            });
            return false;
          }

}

/*end : add to cart*/
