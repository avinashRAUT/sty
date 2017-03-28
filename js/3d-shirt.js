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
  $("#fabric_options").show();
	$("#filter_options").show();
	$("#clear_class").show();
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
		//$('#selected_fabric > span').text(option);
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
	$(".fabric_swatch").on('click', function(){
		var src = $(this).attr('data-image').replace(/\.jpg/, '_600x600.jpg');
		//var option = srce.substr(0, srce.indexOf('.')) + "_600x600.jpg";
		$('#shirtFabricImage img').attr('src',src);
	});
	$(".sleeve-details ").on('click', function(){
    $(".sleeve-details").removeClass('active');
		$(".sleeve-details > a > img.active").hide();
		$(".sleeve-details > a > img.default").show();
    $(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		$('#selected_sleeve > span').text(option);
		$('.current_sleeves').text(option);
		$('#selected_sleeve_icon img').attr('src',src);
		$('#selected_sleeve_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();


		if(option == "HALF SLEEVE")
		{
			$(".cuffs_icon").hide();
			$(".contrast-cuff-options").hide();
				$(".mono-full-sleeve").hide();
		}
		else {
				$(".cuffs_icon").show();
				$(".contrast-cuff-options").show();
				$(".mono-full-sleeve").show();
		}
		console.log(option);


	});
	$(".collar-details").on('click', function(){
    $(".collar-details").removeClass('active');
		$(".collar-details > a > img.active").hide();
		$(".collar-details > a > img.default").show();
    $(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_collar > span').text(option);
		$('.current_collar').text(option);
		$('#selected_collar_icon img').attr('src',src);
		$('#selected_collar_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();

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
		$('.current_cuffs').text(option);
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
	$(".placket-details").on('click', function(){
    $(".placket-details").removeClass('active');
		$(".placket-details > a > img.active").hide();
		$(".placket-details > a > img.default").show();
    $(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_placket > span').text(option);
		$('#selected_placket_icon img').attr('src',src);
		$('#selected_placket_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
		if(option == "CONCEALED" || option == "FRENCH PLACKET")
		{
			$(".optional_placket_contrast").hide();
			console.log(option);
		}
		else {
				$(".optional_placket_contrast").show();
console.log("Show");
		}
	});
	$(".back-details").on('click', function(){
		$(".back-details").removeClass('active');
		$(".back-details > a > img.active").hide();
		$(".back-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_back > span').text(option);
		$('#selected_back_icon img').attr('src',src);
		$('#selected_back_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".bottom-details").on('click', function(){
		$(".bottom-details").removeClass('active');
		$(".bottom-details > a > img.active").hide();
		$(".bottom-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_bottom > span').text(option);
		$('#selected_bottom_icon img').attr('src',src);
		$('#selected_bottom_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".contrast-type-button").on('click', function(){
		$(".contrast-fabric-options").hide();
		$(".contrast-type-options").show();

	});
	$(".contrast-fabric-button").on('click', function(){
		$(".contrast-fabric-options").show();
		$(".contrast-type-options").hide();

	});
	$(".monogram-color-option").on('click', function(){
		$(".monogram-color-option").removeClass('active');
		$(this).addClass('active');
	});
	$(".monogram-font-option").on('click', function(){
		$(".monogram-font-option").removeClass('active');
		$(this).addClass('active');
	});
	$(".monogram-location-option").on('click', function(){
		$(".monogram-location-option").removeClass('active');
		$(this).addClass('active');
	});
	$(".contrast-fabric-details").on('click', function(){
		$(".contrast-fabric-details").removeClass('active');
		$(this).addClass('active');
	});
	$(".contrast-collar-option").on('click', function(){
		$(".contrast-collar-option").removeClass('active');
		$(this).addClass('active');
	});
	$(".contrast-cuff-option").on('click', function(){
		$(".contrast-cuff-option").removeClass('active');
		$(this).addClass('active');
	});
	$(".contrast-placket-option").on('click', function(){
		$(".contrast-placket-option").removeClass('active');
		$(this).addClass('active');
	});

});
