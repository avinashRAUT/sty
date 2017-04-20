var swiper = new Swiper('.swiper-container', {
			scrollbar: '.swiper-scrollbar',
		 scrollbarHide: false,
		 slidesPerView: 'auto',
		 //centeredSlides: true,
		 spaceBetween: 30,
		 grabCursor: true
		//pagination: '.swiper-pagination',
		//effect: 'coverflow',
		//grabCursor: true,
		//centeredSlides: true,
		//scrollbar: '.swiper-scrollbar',
		//scrollbarHide: true,
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',
		//slidesPerView: 'auto',
		/*coverflow: {
				rotate: 50,
				stretch: 0,
				depth: 100,
				modifier: 1,
				slideShadows : true
		}*/
});


$(document).ready(function(){
	$(".main-options li").click(function(){
	$(".option-select").show();
	$('.option-select').children().hide();
	$('.main-options li').removeClass('active');
	$(this).addClass('active');
	var option = $(this).find('h4').text().toLowerCase() + '_options';
	$("#"+option).show();
	console.log(option);
});
	 
	$(".fabric_icon").click(function(){
 	
	//alert("testing 4 fabric")
 	 $("#filter_options").show();
 	 $("#fabric_options").show();
	//$("#filter_options").show();
	//$("#clear_class").show();
});

	$(".fabric-details").on('click', function(){
    $(".fabric-details").removeClass('active');
    $(this).addClass('active');
		if($(window).width() <= 1023){
  	$(".option-select").hide();// do your stuff
		}
		//$(".cuffs_icon").show();
		//$(".contrast-cuff-options").show();
		var src =  $(this).find('img').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_fabric > span').text(option);
		$('#selected_fabric_icon img').attr('src',src);
		$('#selected_fabric_icon_mobile img').attr('src',src);
		var option = $(this).find('a').attr('data-part');
		var color = ('color_' + $('.product-color-' + option).text()).replace(/\s/g,'');
		var pattern = ('pattern_' + $('.product-pattern-' + option).text()).replace(/\s/g,'');
		var color_value = $('#' + color).text();
		var pattern_value = $('#' + pattern).text();
		$(".current_pattern ").html(pattern_value);
		$(".current_color").html(color_value);
		console.log(color_value);
		console.log(pattern_value);
	});


	$(".cuffs-details").on('click', function(){
    $(".cuffs-details").removeClass('active');
		$(".cuffs-details > a > img.active").hide();
		$(".cuffs-details > a > img.default").show();
    $(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_cuff > span').text(option);
		$('#selected_cuff_icon img').attr('src',src);
		$('#selected_cuff_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();

	});
	$(".button-details").on('click', function(){
    $(".button-details").removeClass('active');
    $(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_button > span').text(option);
		$('#selected_button_icon img').attr('src',src);
		$('#selected_button_icon_mobile img').attr('src',src);

	});
	$(".pocket-details").on('click', function(){
    $(".pocket-details").removeClass('active');
		$(".pocket-details > a > img.active").hide();
		$(".pocket-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_pocket > span').text(option);
		$('#selected_pocket_icon img').attr('src',src);
		$('#selected_pocket_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".pleats-details").on('click', function(){
		$(".pleats-details").removeClass('active');
		$(".pleats-details > a > img.active").hide();
		$(".pleats-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_pleat > span').text(option);
		$('#selected_pleat_icon img').attr('src',src);
		$('#selected_pleat_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".belt-details").on('click', function(){
		$(".belt-details").removeClass('active');
		$(".belt-details > a > img.active").hide();
		$(".belt-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_belt > span').text(option);
		$('#selected_belt_icon img').attr('src',src);
		$('#selected_belt_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".fabric_swatch").on('click', function(){
		var src = $(this).attr('data-image').replace(/\.jpg/, '_600x600.jpg');
		//var option = srce.substr(0, srce.indexOf('.')) + "_600x600.jpg";
		$('#trouserFabricImage img').attr('src',src);
	});


});
