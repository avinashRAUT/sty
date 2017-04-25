<?php header("Content-type: application/javascript"); ?>
  /***** VARIABLE DECLARATION ********/
		/***** VARIABLE DECLARATION ********/
			/***** VARIABLE DECLARATION ********/
				/***** VARIABLE DECLARATION ********/
	var api_url= "http://textronic.online/api_Stylior/v1/img?";
	var base_fabric="EE21BF56";
    var contrastFabric='';
	var monogram={'monogram':{'color_monogram':'','font_monogram':'','location_monogram':'','text_monogram':''},};
	var Obj3d={
	'model':'part=SHSLIM&swatch='+base_fabric,
	'sleeve':'part=FULLSLEEVE&swatch='+base_fabric,
	'cuff':'part=SQUARE&swatch='+base_fabric,
	'collar':'part=REGULAR&swatch='+base_fabric,
	'placket':'part=BOX&swatch='+base_fabric,
	'bottom_hem':'part=REGULARBOTTOM&swatch='+base_fabric,
	'button_placket':'part=BLACK1&pair=BOX',
	'button_collar':'part=BLACK1&pair=REGULAR',
	'button_cuff':'part=BLACK1&pair=SQUARE&swatch=30515A55',
	'pocket':'part=DIAMOND&swatch='+base_fabric,
	'back_pleat':'part=BOXPLEAT&swatch='+base_fabric,
	'contrast_cuff':'',
	'contrast_collar':'',
	'contrast_placket':'',
	'stylior_logo':'part=logo2&swatch='+base_fabric,
	'face_type':'',
	};

	changeFabricInfo(base_fabric);

	//part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1&pair=SQUARE&swatch=30515A55
	//TOTAL BUTTONS:'buttons':'part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1&pair=SQUARE&swatch=30515A55',
	// var monogram={'monogram':{'color_monogram':'','font_monogram':'','location_monogram':'','text_monogram':''},};
	/*'contrast_test':'part=REGULAR&swatch='+base_fabric+'&grouporderno=1',
	'testing':'part=BOX&swatch='+base_fabric+'&grouporderno=1',*/
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
	/*******Initial shirt modal render using global array (Obj3d) 
	****  create url to get image of default image of shirt modal.
	****  Shirt-3d page    
	****
	*****/
	$(".se-pre-con").hide();
	for (var key in Obj3d) {
		make_url+=Obj3d[key]+"/";
	}
	
	console.log("This is testing");
	//$(".processimage").make_url);
	$(".processimage").attr("src", api_url+make_url);
	//butoon_cuff playing important role to keep track of current button ...

	var button_cuff='';		
	/*******Function To change all possible option of shirt
	****  shirt customization options 
	****  Shirt-3d page    
	****
	*****/
	$(".changeOption").click(function(){
						make_url="";
						$(".se-pre-con").show();
						$(".se-pre-con").html("This is loading");
						Obj3d[loweer_value_key]="";
						Obj3d['face_type']='';
						var value = $(this).attr("data")
						var value_key= $(this).attr("data-key")
						var loweer_value_key = value_key.toLowerCase();
			 		if(Obj3d['button_cuff']!="" && Obj3d['button_cuff']!=undefined && Obj3d['button_cuff']!="none"){
						button_cuff=Obj3d['button_cuff'];
					}
			        if(value_key=="Sleeve"){
						        //added patch here , need to check it later..
								if(value=="part=HALFSLEEVE" || value=="part=ROLLUPSLEEVE"){
									Obj3d['contrast_cuff']='';
										Obj3d['cuff']="";
											// Obj3d['button_hole']='';
											// Obj3d['buttons']='part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1';
											console.clear();
											console.log(loweer_value_key);
											console.log("done"+value);
											//alert(button_cuff)
											Obj3d['button_cuff']="none";
									
								}
								else if(value=="part=FULLSLEEVE"  ){
										Obj3d['cuff']='part=SQUARE&swatch='+base_fabric;
										//alert(button_cuff)
										Obj3d['button_cuff']=button_cuff;
										// Obj3d['button_placket']=value+'&pair=BOX';
										// Obj3d['button_collar']=value+'&pair=REGULAR&swatch=30515A55';
										//Obj3d['buttons']='part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1&pair=SQUARE&swatch=30515A55';
									}
					}
			        else if(value_key=="Button"){

							var cuff_split=Obj3d['cuff'].split("&");
							var placket_split=Obj3d['placket'].split("&");
							var collar_split=Obj3d['collar'].split("&");
							if(Obj3d['sleeve']=="part=HALFSLEEVE&swatch="+base_fabric ||Obj3d['sleeve']=="part=ROLLUPSLEEVE&swatch="+base_fabric){
      							// alert("test")
								// Obj3d['button_cuff']='';
								// Obj3d['button_placket']=value+'&pair=BOX';
      							// Obj3d['button_collar']=value+'&pair=REGULAR&swatch=30515A55';
								Obj3d['button_cuff']='';
								Obj3d['button_placket']=value+'&pair='+placket_split[0].split('=')[1];
								Obj3d['button_collar']=value+'&pair='+collar_split[0].split('=')[1]+'&swatch=30515A55';				
							}
							else {
								
								console.log(cuff_split[0].split('=')[1]);
				
								Obj3d['button_cuff']=value+'&pair='+cuff_split[0].split('=')[1];
								Obj3d['button_placket']=value+'&pair='+placket_split[0].split('=')[1];
								Obj3d['button_collar']=value+'&pair='+collar_split[0].split('=')[1]+'&swatch=30515A55';
						    }
							// 'button_placket':'part=BLACK1&pair=BOX',
							// 'button_collar':'part=BLACK1&pair=REGULAR',
							// 'button_cuff':'part=BLACK1&pair=SQUARE&swatch=30515A55',

			        }
					else if(value_key=="back_pleat"){
						Obj3d['face_type']='&view=back';

					}
					else if(value_key=="Collar"){
			            substring = "&pair";
						if(Obj3d['button_collar'].indexOf(substring) !== -1)
						{
							//alert("testestes")
							var button_collar=Obj3d['button_collar'].split("&");
							//alert(button_collar)
							button_collar[1]="";
							button_collar[1]="pair="+value.split('=')[1];
							var result_btn=button_collar.join("&")
							//alert(result_btn)
							Obj3d['button_collar']=result_btn
							//alert(Obj3d['button_collar']);
						}
					
                        //keep contrast but changed the collar ...  
						substring = "part";	
						if(Obj3d['contrast_collar'].indexOf(substring) !== -1){
								var contrast_collar=Obj3d['contrast_collar'].split("&");
								contrast_collar[0]="";
								// alert(contrast_collar);								
								// alert(value)
								contrast_collar[0]=value;
								var result_btn=contrast_collar.join("&")
								Obj3d['contrast_collar']=result_btn

						}

					}
					else if(value_key=="Placket"){
						    substring = "&pair";
							if(Obj3d['button_placket'].indexOf(substring) !== -1)
							{
								//alert("testestes")
								var button_placket=Obj3d['button_placket'].split("&");
								//alert(button_placket)
								button_placket[1]="";
								button_placket[1]="pair="+value.split('=')[1];
								var result_btn=button_placket.join("&")
								//alert(result_btn)
								Obj3d['button_placket']=result_btn
								//alert(Obj3d['button_collar']);
							}
						substring = "part";	
						if(Obj3d['contrast_placket'].indexOf(substring) !== -1){
								var contrast_placket=Obj3d['contrast_placket'].split("&");
								contrast_placket[0]="";
								contrast_placket[0]=value;
								var result_btn=contrast_placket.join("&")
								Obj3d['contrast_placket']=result_btn

						}

					}
					else if(value_key=="Cuff"){
						    substring = "&pair";
							if(Obj3d['button_cuff'].indexOf(substring) !== -1)
							{
								//alert("testestes")
								var button_cuff=Obj3d['button_cuff'].split("&");
								//alert(button_cuff)
								button_cuff[1]="";
								button_cuff[1]="pair="+value.split('=')[1];
								var result_btn=button_cuff.join("&")
								//alert(result_btn)
								Obj3d['button_cuff']=result_btn
								//alert(Obj3d['button_collar']);
							}
							substring = "part";	
							if(Obj3d['contrast_cuff'].indexOf(substring) !== -1){
									var contrast_cuff=Obj3d['contrast_cuff'].split("&");
									contrast_cuff[0]="";
									contrast_cuff[0]=value;
									var result_btn=contrast_cuff.join("&")
									Obj3d['contrast_cuff']=result_btn

							}
							//if swatch not added with cuff...
						// 	substring = "&swatch";	
						// 	if(Obj3d['cuff'].indexOf(substring) == -1){
						// 			// var fabric_cuff=Obj3d['cuff'].split("&");
						// 			// fabric_cuff[1]="";
						// 			// fabric_cuff[1]="&swatch="+base_fabric;
						// 			// var result_btn=fabric_cuff.join("&")
						// 			alert(value+"&swatch="+base_fabric);
						// 			Obj3d['cuff']=value+"&swatch="+base_fabric
						// }

					}

					/*double fabric solution*/
					// substring = "&swatch";
					// if(Obj3d['sleeve'].indexOf(substring) == -1)
					// {
					// //alert("testestes")
					// 	Obj3d['sleeve']+='&swatch='+base_fabric;
					// 	//alert(Obj3d['sleeve']);
					// }
					// if(Obj3d['pocket'].indexOf(substring) == -1){
					// 	Obj3d['pocket']+='&swatch='+base_fabric;
					// }
					//          if(Obj3d['bottom_hem'].indexOf(substring) == -1){
					// 	Obj3d['bottom_hem']+='&swatch='+base_fabric;
					//          }
					//          if(Obj3d['back_pleat'].indexOf(substring) == -1){
					// 	Obj3d['back_pleat']+='&swatch='+base_fabric;
					//          }
					/*end double fabric solution*/
					// else if(value_key="Collar"){
					// 	console.log("collar working");
					// 	console.log(Obj3d.contrast_collar);
					// 	var contrast_key = value+'&swatch=B77E374F&grouporderno=2';
					// 	alert(contrast_key);
					// 	Obj3d['contrast_collar']=contrast_key;
					// }
					// else{
					// 		Obj3d['buttons']='part=BLACK1&pair=REGULAR/part=BLACK1&pair=BOX/part=BLACK1&pair=SQUARE&swatch=30515A55';
					// 		Obj3d['cuff']='part=SQUARE&swatch='+base_fabric;
					// 		Obj3d['contrast_cuff']='part=SQUARE&swatch='+base_fabric+'&grouporderno=0';
					// }


					if(value_key=="Cuff")
						{Obj3d['cuff']=value+"&swatch="+base_fabric;}
					else 
						{Obj3d[loweer_value_key]=value}

					console.log(value);
					seeFordoubleFabric();
					//console.log(Obj3d);

					for (var key in Obj3d) {
					//console.log(Obj3d[key]);
					//make_url+=Obj3d[key]+"&swatch="+base_fabric+"/";
					make_url+=Obj3d[key]+"/";

					}
		            //$(".processimage").make_url);
		  		    //$(".processimage").attr("src","");
					console.log(make_url);
				    $(".processimage").attr("src", api_url+make_url);
					$(".se-pre-con").hide();
	}); //end of changeOption function()



	/******* To render new fabric 
	****  change complete options of obj3d , just keep previous customization as it is
	****  Shirt-3d page    
	****
	*****/

	$(".swatchchangeOption").click(function(){
				console.log("This is testing");
				make_url="";
				var fabric_key=$(this).attr("data-part");
				//console.log(fabric_key);
				changeFabricInfo(fabric_key);
				base_fabric=fabric_key;
				cuff_constrast_fabric=collar_constrast_fabric=placket_constrast_fabric=base_fabric;
				for(var new_swatch in Obj3d){
							//       alert(new_swatch)
							substring = "&swatch";
							if(new_swatch=="contrast_collar" || new_swatch=="contrast_cuff" || new_swatch=="contrast_placket" ){
								
								Obj3d[new_swatch]=Obj3d[new_swatch];	
								console.log("contrast new"+Obj3d[new_swatch]);

							}

							else if(new_swatch=="button_cuff" || new_swatch=="button_collar" || new_swatch=="button_placket"){
						  	Obj3d[new_swatch]=Obj3d[new_swatch];	
						  	}
							else if(Obj3d[new_swatch].indexOf(substring) !== -1)
							{
								//alert("testestes")
								var button_placket=Obj3d[new_swatch].split("&");
								
										button_placket[1]="";
										button_placket[1]="swatch="+base_fabric;
										var result_btn=button_placket.join("&")
										Obj3d[new_swatch]=result_btn
								

								//alert(Obj3d['button_collar']);
							}
							else{
								
								Obj3d[new_swatch]=Obj3d[new_swatch];

							}				
		
				}
				// Obj3d={
				// 	'model':'part=SHSLIM&swatch='+base_fabric,
				// 	'sleeve':'part=FULLSLEEVE&swatch='+base_fabric,
				// 	'cuff':'part=SQUARE&swatch='+base_fabric,
				// 	'collar':'part=REGULAR&swatch='+base_fabric,
				// 	'placket':'part=BOX&swatch='+base_fabric,
				// 	'bottom_hem':'part=REGULARBOTTOM&swatch='+base_fabric,
				// 	'pocket':'',
				// 	'back_pleat':'part=BOXPLEAT&swatch='+base_fabric,
				// 	'button_cuff':Obj3d['button_cuff'],
				// 	'button_placket':Obj3d['button_placket'],
				// 	'button_collar':Obj3d['button_collar'],
				// 	'contrast_cuff':Obj3d['contrast_cuff'],
				// 	'contrast_collar':Obj3d['contrast_collar'],
				// 	'contrast_placket':Obj3d['contrast_placket'],
				// 	'stylior_logo':'part=F33FC697&swatch='+base_fabric,
				// 	'face_type':'',

				// 	};
				/*'contrast_cuff':'part=SQUARE&swatch='+cuff_constrast_fabric+'&grouporderno=0',
				'contrast_collar':'part=REGULAR&swatch='+collar_constrast_fabric+'&grouporderno=1',
				'contrast_placket':'part=BOX&swatch='+placket_constrast_fabric+'&grouporderno=4',*/

				for (var key in Obj3d) {
						make_url+=Obj3d[key]+"/";
					}
					console.log(make_url);
					$(".processimage").attr("src", api_url+make_url);
		        });

				// //render final image
				//   		for (var key in Obj3d) {
				// 	make_url+=Obj3d[key]+"/";
				// 	}
				//          //$(".processimage").make_url);
	    		//$(".processimage").attr("src", api_url+make_url)

		});

		/******* To change the contrast options
			****  data as value of fabric and data-key is a operation 
			****  Shirt-3d page    
			****
		*****/

		$(".changeContrastOption").click(function(){
		
			console.log("change sub contrast option working..");
			make_url="";
			Obj3d['face_type']='';		
			var value = $(this).attr("data")
			var value_key= $(this).attr("data-key")
			var loweer_value_key = value_key.toLowerCase();
			contrast_cuff=contrast_collar=contrast_placket=contrastFabric;
			grp_value=value;
			if(loweer_value_key=="collar"){

				substring = "part";	
				if(Obj3d['collar'].indexOf(substring) !== -1){
					var contrast_collar=Obj3d['collar'].split("&");
					type_key=contrast_collar[0].split('=')[1]

				}
						

                  // type_key="REGULAR";
                  // alert(type_key)
			}
			else if(loweer_value_key=="cuff"){
                  //type_key="SQUARE";
				substring = "part";	
				if(Obj3d['cuff'].indexOf(substring) !== -1){
					var contrast_cuff=Obj3d['cuff'].split("&");
					type_key=contrast_cuff[0].split('=')[1]

				}


			}
			else if(loweer_value_key=="placket"){
                  // type_key="BOX";

				substring = "part";	
				if(Obj3d['placket'].indexOf(substring) !== -1){
					var contrast_placket=Obj3d['placket'].split("&");
					type_key=contrast_placket[0].split('=')[1]

				}


			}
			seeFordoubleFabric();
			// Obj3d['contrast_'+loweer_value_key]='';
			
			if(value=="-1"){
			Obj3d['contrast_'+loweer_value_key]='';	
			}
			else{
			Obj3d['contrast_'+loweer_value_key]='part='+type_key+'&swatch='+contrastFabric+'&grouporderno='+grp_value;
			}
			//sleeve change
			// substring = "&swatch";

			// if(Obj3d['sleeve'].indexOf(substring) == -1)
			// {
			// //alert("testestes")
			// 	Obj3d['sleeve']+='&swatch='+base_fabric;
			// 	//alert(Obj3d['sleeve']);
			// }
			// if(Obj3d['pocket'].indexOf(substring) == -1){
			// 	Obj3d['pocket']+='&swatch='+base_fabric;
			// }
			//if(Obj3d['bottom_hem'].indexOf(substring) == -1){
			// 	Obj3d['bottom_hem']+='&swatch='+base_fabric;
			//}
			//if(Obj3d['back_pleat'].indexOf(substring) == -1){
			//Obj3d['back_pleat']+='&swatch='+base_fabric;
			//}

			//contrast value
			console.log("after adding");
			console.log(Obj3d['contrast_'+loweer_value_key]);
			for (var key in Obj3d) {
					make_url+=Obj3d[key]+"/";
			}
			console.log(make_url);
			$(".processimage").attr("src", api_url+make_url);
			//http://textronic.online/api_Stylior/v1/img?type=0&part=REGULAR&swatch=811F6088
			// Obj3d[loweer_value_key]=value;
			// console.log(value);

	});
	



	/******* To change the contrast fabric
		****  used as a global variable
		****  Shirt-3d page    
		****
	*****/
	contrastFabric='B77E374F';
	$(".contrastChangeFabric").click(function(){
	    contrastFabric=$(this).attr('data');
	});



	/******* To change the view of modal-shirt
	****     toggle button : front and back view
	****     Shirt-3d page    
	****
	*****/
	$("#backface").click(function(){
			make_url="";
        	if(Obj3d['face_type']==='&view=back'){
              Obj3d['face_type']='';
        	}
        	else{
              Obj3d['face_type']='&view=back';
        	}
			seeFordoubleFabric();
			for (var key in Obj3d) {
				make_url+=Obj3d[key]+"/";
			}
		 $(".processimage").attr("src", api_url+make_url);
	});


function changeFabricInfo(c_key){
  		var fabric_title=$(".product-title-"+c_key).html();
  		var fabric_price=$(".product-price-"+c_key).html();
  		var  fabric_pattern=$(".product-pattern-"+c_key).html();
		var  fabric_color=$(".product-color-"+c_key).html();
		var  fabric_threadcount=$(".product-threadcount-"+c_key).html();
		var  fabric_product_id=$(".product-id-"+c_key).html();
		// alert(fabric_product_id);
  		// alert(fabric_title+""+fabric_price+"color"+fabric_color);
 		$(".current_title").html(fabric_title);
		$(".current_price ").html(fabric_price);
		$("#current_product_price").val(fabric_price.split(' ')[1]);
		$(".current_pattern ").html(fabric_pattern);
		$(".current_color").html(fabric_color);
		$(".current_threadcount ").html(fabric_threadcount);
		$("#current_product_id ").val("STY"+fabric_product_id.trim());
}

	function seeFordoubleFabric(){
		//sleeve change
			substring = "&swatch";

			if(Obj3d['sleeve'].indexOf(substring) == -1)
			{
			//alert("testestes")
				Obj3d['sleeve']+='&swatch='+base_fabric;
			//alert(Obj3d['sleeve']);
			}
			if(Obj3d['pocket'].indexOf(substring) == -1){
				Obj3d['pocket']+='&swatch='+base_fabric;
			}
			if(Obj3d['bottom_hem'].indexOf(substring) == -1){
				Obj3d['bottom_hem']+='&swatch='+base_fabric;
			}
			if(Obj3d['back_pleat'].indexOf(substring) == -1){
				Obj3d['back_pleat']+='&swatch='+base_fabric;
			}
			if(Obj3d['sleeve'].indexOf(substring) == -1){
				Obj3d['sleeve']+='&swatch='+base_fabric;
			}
			if(Obj3d['collar'].indexOf(substring) == -1){
				Obj3d['collar']+='&swatch='+base_fabric;
			}
			if(Obj3d['placket'].indexOf(substring) == -1){
				Obj3d['placket']+='&swatch='+base_fabric;
			}
			// if(Obj3d['button'].indexOf(substring) == -1){
			// 		Obj3d['button']+='&swatch='+base_fabric;
			// }

			//contrast value

}




 function applyMonogram(strValue){
	//javascript validation for monogram
	var mono_font=$("#mono-font-name").val();
	var mono_color=$("#mono-color-name").val();
	var mono_location=$("#mono-location-name").val();
    var mono_name=$("#monogram-name").val();

	$(".monogram-color").css('border','');
	$(".monogram-font").css('border','');
	$(".monogram-location").css('border','');
	$("#monogram-name").css('border','');

    if(mono_font=="undefined"||mono_font==""||mono_font==null){
			$(".error_message").html("Please select monogram font");
            $(".monogram-font").css('border','1px solid red');
			return false;
    }

    if(mono_color=="undefined"||mono_color==""||mono_color==null){
			$(".error_message").html("Please select monogram color");
			$(".monogram-color").css('border','1px solid red');
			return false;
    }

    if(mono_location=="undefined"||mono_location==""||mono_location==null){
			$(".error_message").html("Please select monogram location")
			$(".monogram-location").css('border','1px solid red');
			return false;
    }

    if(mono_name=="undefined"||mono_name==""||mono_name==null){
      		$(".error_message").html("Please enter monogram name")
			$("#monogram-name").css('border','1px solid red');

			return false;
    }

    if(strValue=="reset"){
		console.log("reset");
		$("#mono-font-name").val("");
		$("#mono-color-name").val("");
		$("#mono-location-name").val("");
		$("#monogram-name").val("");
        $("#btn_apply").show();
		$(".summary_mono").html('');

	}
	else if(strValue=="new"){
		//'monogram':{'color_monogram':'','font_monogram':'','location_monogram':'','text_monogram':''},
		monogram.monogram.color_monogram=mono_color.toUpperCase();
		monogram.monogram.font_monogram=mono_font.toUpperCase();
		monogram.monogram.location_monogram=mono_location.toUpperCase();
		monogram.monogram.text_monogram=mono_name.toUpperCase();
		var mono_string='<ul><li><strong>Color : </strong><span class = "mono-color">'+mono_color+'</span></li><li><strong>Font : </strong><span class = "mono-font">'+mono_font+'</span></li><li><strong>Location : </strong><span class = "mono-location">'+mono_location+'</span></li><li><strong>Name : </strong><span class = "mono-name">'+mono_name+'</span></li></ul>';
		$(".summary_mono").html(mono_string);
        $("#btn_apply").hide();
		$(".error_message").html("");

	}

}


$(".monogram-font-option,.monogram-color-option, .monogram-location-option").click(function(){
 	//alert("testing new")
	var classname = $(this).attr('class');
	var current_cls_name=classname.split(" ")[0];
	if(current_cls_name=="monogram-font-option"){
		$("#mono-font-name").val($(this).attr('mono-font'));
	}
	else if(current_cls_name=="monogram-color-option"){
		$("#mono-color-name").val($(this).attr('mono-color'));
	}
	else if(current_cls_name=="monogram-location-option"){
		$("#mono-location-name").val($(this).attr('mono-location'));
	}
});


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
		// var loginUser="<?php echo $_SESSION["user_id"]; ?>";
		var result=$(".processimage").attr("src");
		Obj3d.monogram=monogram.monogram;
		//console.log("no login info"+loginUser);
		//return false;
		//console.log(result);
		//var details = JSON.stringify(Obj3d);
		// console.log(details);
		// console.log("Only display string===");
		// console.log(Obj3d);
		// return false;
	
	if(loginUser)
		{
				//console.log("user is logged in");
				$.ajax({
						url: base_url+"cart/addcart3dcombined",
						type: 'POST',
						 beforeSend: function()
						 {
						  $(".se-pre-con").show();
						 },
						data: {
							details : JSON.stringify(Obj3d) ,
							price_shirt : exact_price,
							productid_shirt : product_id ,
							subcatid_shirt : '10' ,
							pname_shirt : fabric_name,
							imagedata_shirt : result,
							ordertype:"shirt",
							order:"custom"
					   },
						success: function(response)
						{
							console.log(response);
			             
			                //return false;
			                $(".se-pre-con").fadeOut("slow");
							//window.location.href= base_url+"home/lum_saved_profile";
							/*							//location.reload();
							$('.cd-tabs').show();
							$('html,body').animate({ scrollTop: $('.cd-tabs').offset().top }, 500);
							*/

			              window.location = "#shirt_measurements";

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
 						details : JSON.stringify(Obj3d) , price_shirt : exact_price, productid_shirt : product_id ,  subcatid_shirt : '10' ,	pname_shirt : fabric_name,imagedata_shirt: result,ordertype:"shirt",order:"custom"
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
