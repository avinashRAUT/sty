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
	var option = $(this).find('h4').text().toLowerCase().replace(/\s/g,'_') + '_options';
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
	$(".jacket-style-details").on('click', function(){
		$(".jacket-style-details").removeClass('active');
		$(".jacket-style-details > a > img.active").hide();
		$(".jacket-style-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_jacket_style > span').text(option);
		$('#selected_jacket_style_icon img').attr('src',src);
		$('#selected_jacket_style_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".lapel-details").on('click', function(){
		$(".lapel-details").removeClass('active');
		$(".lapel-details > a > img.active").hide();
		$(".lapel-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_lapel > span').text(option);
		$('#selected_lapel_icon img').attr('src',src);
		$('#selected_lapel_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".jacket-button-details").on('click', function(){
		$(".jacket-button-details").removeClass('active');
		$(".jacket-button-details > a > img.active").hide();
		$(".jacket-button-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		// $('#show_button > a').attr('data',"CS" + option);
		// $('#kissing_button > a').attr('data',"CK" + option);

		// switch(option)
		// {
		// 	case "BLACK" :
		// 	$('#show_button > a').attr('data',"CSBLACK");
		// 	$('#kissing_button > a').attr('data',"CKBLACK");
		// 	break;
		// 	case "BROWN" :
		// 	$('#show_button > a').attr('data',"CSBROWN");
		// 	$('#kissing_button > a').attr('data',"CKBROWN");
		// 	break;
		// 	case "GREY" :
		// 	$('#show_button > a').attr('data',"CSGREY");
		// 	$('#kissing_button > a').attr('data',"CKGREY");
		// 	break;
		// 	case "NAVY" :
		// 	$('#show_button > a').attr('data',"CSNAVY");
		// 	$('#kissing_button > a').attr('data',"CKNAVY");
		// 	break;
		// 	default :
		// 	$('#show_button > a').attr('data',"CSBLACK");
		// 	$('#kissing_button > a').attr('data',"CKBLACK");
		// }

		console.log(option);
		$('#selected_jacket_button > span').text(option);
		$('#selected_jacket_button_icon img').attr('src',src);
		$('#selected_jacket_button_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});
	$(".vents-details").on('click', function(){
		$(".vents-details").removeClass('active');
		$(".vents-details > a > img.active").hide();
		$(".vents-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_vents > span').text(option);
		$('#selected_vents_icon img').attr('src',src);
		$('#selected_vents_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".suit-pocket-details").on('click', function(){
		$(".suit-pocket-details").removeClass('active');
		$(".suit-pocket-details > a > img.active").hide();
		$(".suit-pocket-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_suit_pocket > span').text(option);
		$('#selected_suit_pocket_icon img').attr('src',src);
		$('#selected_suit_pocket_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".chest-pocket-details").on('click', function(){
		$(".chest-pocket-details").removeClass('active');
		$(".chest-pocket-details > a > img.active").hide();
		$(".chest-pocket-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_chest_pocket > span').text(option);
		$('#selected_chest_pocket_icon img').attr('src',src);
		$('#selected_chest_pocket_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".lapel-button-hole-details").on('click', function(){
		$(".lapel-button-hole-details").removeClass('active');
		$(".lapel-button-hole-details > a > img.active").hide();
		$(".lapel-button-hole-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_lapel_button_hole > span').text(option);
		$('#selected_lapel_button_hole_icon img').attr('src',src);
		$('#selected_lapel_button_hole_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".cuff-accent-stitching-details").on('click', function(){
		$(".cuff-accent-stitching-details").removeClass('active');
		$(".cuff-accent-stitching-details > a > img.active").hide();
		$(".cuff-accent-stitching-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_cuff_accent_stitching > span').text(option);
		$('#selected_cuff_accent_stitching_icon img').attr('src',src);
		$('#selected_cuff_accent_stitching_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".cuff-button-style-details").on('click', function(){
		$(".cuff-button-style-details").removeClass('active');
		$(".cuff-button-style-details > a > img.active").hide();
		$(".cuff-button-style-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_cuff_button_style > span').text(option);
		$('#selected_cuff_button_style_icon img').attr('src',src);
		$('#selected_cuff_button_style_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".inner-lining-details").on('click', function(){
		$(".inner-lining-details").removeClass('active');
		$(".inner-lining-details > a > img.active").hide();
		$(".inner-lining-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_inner_lining > span').text(option);
		$('#selected_inner_lining_icon img').attr('src',src);
		$('#selected_inner_lining_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".tie-details").on('click', function(){
		$(".tie-details").removeClass('active');
		$(".tie-details > a > img.active").hide();
		$(".tie-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_tie > span').text(option);
		$('#selected_tie_icon img').attr('src',src);
		$('#selected_tie_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".vest-details").on('click', function(){
		$(".vest-details").removeClass('active');
		$(".vest-details > a > img.active").hide();
		$(".vest-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_vest > span').text(option);
		$('#selected_vest_icon img').attr('src',src);
		$('#selected_vest_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".suspender-button-details").on('click', function(){
		$(".suspender-button-details").removeClass('active');
		$(".suspender-button-details > a > img.active").hide();
		$(".suspender-button-details > a > img.default").show();
		$(this).addClass('active');
		if($(window).width() <= 1023){
		$(".option-select").hide();// do your stuff
		}
		var src =  $(this).find('img.default').attr('src');
		var option = $(this).find('h4').text();
		console.log(option);
		$('#selected_suspender_button > span').text(option);
		$('#selected_suspender_button_icon img').attr('src',src);
		$('#selected_suspender_button_icon_mobile img').attr('src',src);
		$(this).find('img').hide();
		$(this).find('img.active').show();
	});

	$(".fabric_swatch").on('click', function(){
		var src = $(this).attr('data-image').replace(/\.jpg/, '_600x600.jpg');
		//var option = srce.substr(0, srce.indexOf('.')) + "_600x600.jpg";
		$('#suitFabricImage img').attr('src',src);
	});

	



});
