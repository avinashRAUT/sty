function addToCart() {
   
  
	delete shirtObj.zoom_shirt_part;
	removeShirtPropertiesContrastParttent();
	if (!validMonogram()) {
		return;
	}

	if(shirtObj.placket !== "undefined")
	{
		shirtObj.placket = "none";
	}
	if(shirtObj.hem !== "undefined")
	{
		shirtObj.hem = "none";
	}
	
	$(".se-pre-con1").fadeIn("slow");
	html2canvas($(".resolution-low"), {
            onrendered: function(canvas) {
               theCanvas = canvas;
              
               var result = canvas.toDataURL("image/png");
               var exact_price = $(".exact_shirt_price").val();
			   var product_id = $("#summary_fabric").val();
			   var fabric_name = $(".fab_name_val").val();
			   $.ajax({
				url: 'http://www.stylior.com/cart/addcart3d/',
				type: 'POST',
				dataType: 'json',
				data: {
					details : $.toJSON(shirtObj) , price : exact_price, productid : product_id ,  subcatid : '10' , pname : fabric_name , imagedata : result
			   },
				success: function(response) {
				$(".se-pre-con1").fadeOut("slow");
				/*
				var r = confirm("Congrats, A great design indeed.\nEither Create more or Measurement.");
				if (r == true) {
					history.go(1);
				} else { */
        
					window.location.href= 'http://www.stylior.com/home/savemeasurement';
				// }
                
					 
				}
			});

            }
        });
	   

	/*if (!identifier) {
		$.cookie('instance_shirt', $.toJSON(shirtObj), { path: '/' });
		location = '/sign-up-4';
		return;
	}*/
		
	/*$.prettyLoader.show();
	loadingProcess(addingToCartLoadingMessage);*/
	
	
}
