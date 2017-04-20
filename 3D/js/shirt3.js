var menu = 'base';
var rev = 8;
var currentMenuItemIndex = 0; 
var menuItems = ['base', 'sleeve', 'collar', 'cleric', 'cuffs', 'buttons', 'pocket', 'back', 'monogram', 'monogram-text', 'monogram-color', 'contrast-pattern', 'inner-collar-fabric', 'inner-cuffs-fabric', 'inner-buttons-fabric', 'pocket-fabric', 'final'];
var clickFromNextButton = false;
var loading = false;
var reviewsLoading = false;
var clickEvent = 'click';
var addedOrUpdatedToCart = false;

function setupNew() {
	if (navigator.userAgent.match(/(Android|webOS|iPhone|iPad|iPod|BlackBerry)/i)) {
		clickEvent = 'touchstart';
	}
	updateLayout();
	loadProgressbar(shirtObj);
	addAllFabrics();
	initCutPanel();
	initSleevePanel();
	initCollarPanel();
	initClericPanel();
	initCuffsPanel();
	initButtonsPanel();
	initPocketPanel();
	initBackPanel();
	initMonogramPanel();
	initMonogramTextPanel();
	initContrastPatternPanel();
	searchPriceInit();
	
	$(window).resize(function() {
		updateLayout();
	});
	
	$('.piece').click(function(e){
		e.preventDefault();
		if (navigator.userAgent.match(/(Android|webOS|iPhone|iPod|iPad|BlackBerry)/i)) {
			return;
		}
		if ($(this).parent().hasClass('resolution-low')) {
			changeHighShirt();
		} else {
			changeLowShirt();
		}
	});
	
	$('.update-to-cart').click(function() {
		updateCartItem();
	});
	
	$('.add-to-cart').click(function() {
		addToCart();
	});
	
	$('.push-to-shop').click(function() {
		showPublishShirt();
	});
	
	$('#fancybox-close').click(function() {
		$('#fancybox-wrap').css('z-index', 1010); 
	});
	
	$('#monogram-input').blur(function() {
		renderMonogramRotation();
	});

	$('.pre-button').click(function(e) {
		e.preventDefault();
		prevMenuItem();
	});
	$('.next-button').click(function(e) {
		e.preventDefault();
		nextMenuItem();
	});

	$('.rotate-shirt').click(function(e){
		e.preventDefault();
		rotateLeft();
	});
	
	$('.exit-zoom-view').click(function(){
		$('.piece').trigger('click');
	});
	
	$('#shirtLeftToolbox .panel-content .all-fabric-selector').jScrollPane({ autoReinitialise: true });
	
	if (designerShirt) {
		$('.gallery').remove();
		currentMenuItemIndex = 8;
		
		$('.steps .step.base').hide();
		$('.steps .step.sleeve').hide();
		$('.steps .step.collar').hide();
		$('.steps .step.cleric').hide();
		$('.steps .step.cuffs').hide();
		$('.steps .step.buttons').hide();
		$('.steps .step.pocket').hide();
		$('.steps .step.back').hide();
		
		showMenuItem();
	} else {
		showBaseMenu();
	}
	
	$('.fabric-filter .item').each(function(iItem, e) {
		var self = $(e);
		var searchItem = $(this).attr('value');
		var canShow = false;
		$('#base-fabric .eachfabric').each(function(iFabric, fabric) {
			var price = parseInt($(fabric).attr('price'));
			var searchVal = null;
			if (self.attr('value') != "") {
				searchVal = self.attr('value').split('-');
			}
			
			var threadCount = parseInt($(fabric).attr('thread_count'));
			var threadVal = null;
			if (self.attr('value') != "") {
				threadVal = self.attr('value').split('-');
			}
			
			if (($(fabric).attr('search') != "" && $(fabric).attr('search') != undefined && $(fabric).attr('search').split('-').indexOf(searchItem) != -1) || 
				(self.hasClass('price') && (self.attr('value') == "" || (searchVal != null  && price >= parseInt(searchVal[0]) && price <= parseInt(searchVal[1])))) ||
		        (self.hasClass('quality') && (threadVal != null  && threadCount >= parseInt(threadVal[0]) && threadCount < parseInt(threadVal[1])))
			) {
				canShow = true;
				return false;
			}
		});
		if (canShow) {
			$(this).show();
		} else {
			$(this).hide();
		}
	});
	
	$('#shirtApp #shirtLeftToolbox .panel-content .heading-panel .steps .step').tipsy({ gravity: 's', offset: 5, html: true });
	
	$('.see-review-button').click(function(){
		var positionReview = $('.reviews').position().top + parseInt($('.reviews').css('margin-top').replace('px', ''));
		$('html, body').animate({
	        scrollTop: positionReview
	    }, 450);
	});
	
	$('.heading-panel .steps .step').click(function(){
		var step = $(this).attr('name');
		var i = 0;
		for (i = 0; i < menuItems.length; i++) {
			if (menuItems[i] == step) {
				if (!validMonogram() && i >= 10) {
					
				} else {
					currentMenuItemIndex = i;
				}
				showMenuItem();
				return;
			}
		}
	});
	
	$(window).bind('beforeunload', function(e){
		if (addedOrUpdatedToCart) {
			e = null;
		} else {
			return messageLostDesign;
		}
	});
	
	$('.all-fabric-selector .eachfabric').tipsy({ gravity: 's', offset: 5, html: true });
	
	if (tags == 'Hybrid Sensors') {
		$('#collection5').attr('checked', true);
		filterFabrics2();
	}
}

function filterFabrics(tags) {
	$('#base-fabric .eachfabric').hide();
	$('#base-fabric .eachfabric[label2*="' + tags + '"]').show();
	$('.fabric-button').removeClass('active');
	$('.fabric-button[tags="' + tags + '"]').addClass('active');
}

function filterFabrics2() {
	$('#base-fabric .eachfabric').hide();
	$('#base-fabric .eachfabric').each(function(i, fabric) {
		var searchText = $(fabric).attr('search').split('-');
		var searchPrice = parseInt($(fabric).attr('price'));
		var searchQuality = parseInt($(fabric).attr('thread_count'));
		
		var satisfyWeight = false;
		var satisfyCollection = false;
		var satisfyFeature = false;
		var satisfyPattern = false;
		var satisfyPrice = false;
		var satisfyQuality = false;
		
		var weightItems = $('.weight-area input[name=search]:checked');
		if (weightItems.length == 0) {
			satisfyWeight = true;
		} else {
			weightItems.each(function(j, searchItem) {
				if (searchText.indexOf($(searchItem).val()) != -1) {
					satisfyWeight = true;
					return false;
				}
			});
		}
		
		var collectionItems = $('.collection-area input[name=search]:checked');
		if (collectionItems.length == 0) {
			satisfyCollection = true;
		} else {
			collectionItems.each(function(j, searchItem) {
				if (searchText.indexOf($(searchItem).val()) != -1) {
					satisfyCollection = true;
					return false;
				}
			});
		}
		
		var featureItems = $('.feature-area input[name=search]:checked');
		if (featureItems.length == 0) {
			satisfyFeature = true;
		} else {
			featureItems.each(function(j, searchItem) {
				if (searchText.indexOf($(searchItem).val()) != -1) {
					satisfyFeature = true;
					return false;
				}
			});
		}
		
		var patternItems = $('.pattern-area input[name=search]:checked');
		if (patternItems.length == 0) {
			satisfyPattern = true;
		} else {
			patternItems.each(function(j, searchItem) {
				if (searchText.indexOf($(searchItem).val()) != -1) {
					satisfyPattern = true;
					return false;
				}
			});
		}
		
		var allPrice = $('.price-area input[id=price-all]:checked');
		if (allPrice.length > 0) {
			satisfyPrice = true;
		} else {
			priceItems = $('.price-area input.price-value[name=price]:checked');
			priceItems.each(function(j, searchItem) {
				var searchVal = $(searchItem).val().split('-'); 
				if (searchPrice >= parseInt(searchVal[0]) && searchPrice <= parseInt(searchVal[1])) {
					satisfyPrice = true;
					return false;
				}
			});
		}
		
		var allQualitys = $('.quality-area input[name=search]:checked');
		if (allQualitys.length == 0) {
			satisfyQuality = true;
		} else {
			priceItems = $('.quality-area input[name=search]:checked');
			priceItems.each(function(j, searchItem) {
				var searchVal = $(searchItem).val().split('-'); 
				if (searchQuality >= parseInt(searchVal[0]) && searchQuality <= parseInt(searchVal[1])) {
					satisfyQuality = true;
					return false;
				}
			});
		}
		
		if (satisfyWeight && satisfyCollection && satisfyFeature && satisfyPattern && satisfyPrice && satisfyQuality) {
			$(this).show();
		}
	});
}

function updatePriceBox() {
	var amount = getShirtPrice(shirtObj);
	var promoAmount = amount;
	if (code18Amount > 0) {
		if (code18Amount >= 1) {
			promoAmount = Math.max(amount - code18Amount, 0);
		} else {
			promoAmount = Math.max(amount * (1 - code18Amount), 0);
		}
		$('.price-box .m2').text(formatUSD(promoAmount));
	}
	$('.price-box .m').text(formatUSD(amount));
}

function openFullFabricDialog(fabricName) {
	closeFullFabricDialog();
	var fabric = getFabric(fabricName);
	var panel = $('.panel-content');
	var left = panel.offset().left + panel.width();
	var info = '';
	var collection = fabric.collection_name;
	if (collection) {
		collection = '<span class="maker">' + collection + '</span>';
	}
	info += '<div class="namex">' + collection + previewNameMessage.replace('%NAME%', (fabric.label != ' ' ? fabric.label : fabric.name)).replace('%PRICE%', formatUSD(fabric.price)) + '</div>';
	info += '<div class="tags">';
	if (fabric.cotton) {
		info += '<span class="tag">' + cottonTagMessage.replace('%AMOUNT%', fabric.cotton) + '</span>';
	}
	if (!fabric.iron) {
		info += '<span class="tag">' + wrinkleFreeTagMessage + '</span>';
	}
	if (fabric.thread_count) {
		info += '<span class="tag">' + threadTagMessage.replace('%AMOUNT%', fabric.thread_count) + '</span>';
	}
	if (fabric.thickness) {
		var weightName = '';
		if (fabric.thickness == 'thin') {
			weightName = weightMessages[0];
		} else if (fabric.thickness == 'little thin') {
			weightName = weightMessages[1];
		} else if (fabric.thickness == 'normal') {
			weightName = weightMessages[2];
		} else if (fabric.thickness == 'little thick') {
			weightName = weightMessages[3];
		} else if (fabric.thickness == 'thick') {
			weightName = weightMessages[4];
		}
		info += '<span class="tag">' + weightTagMessage.replace('%AMOUNT%', weightName) + '</span>';
	}
	info += '</div>';
	info += '<div class="line"></div>';
	info += '<div class="desc">' + fabric.description + '</div>';
	var html = "<div class='full-fabric-dialog' fabric='" + fabricName + "'><div class='info'>" + info + "</div><img src='/_media/fabrics/full/" + fabricName + ".jpg'/></div>";
	$('#shirtApp').append(html);
	$('.full-fabric-dialog').css({
		top : '50px',
		left: left + 'px'
	});
}

function isOpenFullFabricDialog(fabricName) {
	return $('.full-fabric-dialog[fabric=' + fabricName + ']').length > 0;
}

function closeFullFabricDialog() {
	$('.full-fabric-dialog').remove();
}

function openImageDialog(image, width, height) {
	var panel = $('.panel-content');
	var left = panel.offset().left + panel.width();
	var html = "<div class='image-dialog' style='position: absolute; border-radius: 5px; z-index: 5000; width: " + width + "px; height: " + height + "px'><img width='" + width + "' height='" + height + "' src='" + image + "'/></div>";
	$('#shirtApp').append(html);
	$('.image-dialog').css({
		top : '50px',
		left: left + 'px'
	});
}

function closeImageDialog() {
	$('.image-dialog').remove();
}

function updateLayout() {
	var docWidth = $('#shirtApp').width();
	var docHeight = $('.shirt').height();
	var leftToolboxWidth = Math.max(572, (docWidth - $('.shirt').width() - $('#shirtRightToolbox').width()));
	
	if (shirtObj.zoom_shirt_part != '') {
		leftToolboxWidth = 572;
	}
	
	if (leftToolboxWidth > 572) {
		leftToolboxWidth = 572;
	}
	
	var rightToolboxWidth = $('#shirtRightToolbox').width() + 16;
	$('#shirtApp').css('min-height', docHeight + 'px');
	$('#shirtLeftToolbox').css('width', leftToolboxWidth + 'px');
	$('#shirtLeftToolbox .panel-content').css('width', leftToolboxWidth + 'px');
	
	if (leftToolboxWidth < 400) {
		$('#shirtLeftToolbox .panel-content .heading-panel .text').css('font-size', '12px');
	} else {
		$('#shirtLeftToolbox .panel-content .heading-panel .text').css('font-size', '17px');
	}
	
	if (shirtObj.resolution == 'low') {
		var shirtLeft = (leftToolboxWidth + (docWidth - leftToolboxWidth - rightToolboxWidth - $('.shirt').width()) / 2) - 30;
		if (shirtLeft > leftToolboxWidth) {
			$('.shirt').css({ left : shirtLeft + 'px', right : 'auto' + 'px', 'top': 'auto' });
		} else {
			$('.shirt').css({ left : 'auto', right : rightToolboxWidth + 'px', 'top': 'auto' });
		}
		
		$('.reviews').css('margin-top', '200px');
		
	} else {
		var shirtContent = docWidth - leftToolboxWidth; 
	
		if (shirtObj.zoom_shirt_part == 'collar' || shirtObj.zoom_shirt_part == 'cleric') {
			$('.shirt').css({ left : ((shirtContent / 2)) + 'px', right : 'auto', 'top': '-70px' });
			$('.reviews').css('margin-top', '700px');
		} else if (shirtObj.zoom_shirt_part == 'inner-collar-fabric') {
			$('.shirt').css({ left : ((shirtContent / 2)) + 'px', right : 'auto', 'top': '50px' });
			$('.reviews').css('margin-top', '800px');
		} else if (shirtObj.zoom_shirt_part == 'cuffs' || shirtObj.zoom_shirt_part == 'inner-cuffs-fabric') {
			$('.shirt').css({ left : ((shirtContent / 2) + 200) + 'px', right : 'auto', 'top': '-500px' });
			$('.reviews').css('margin-top', '250px');
		} else if (shirtObj.zoom_shirt_part == 'pocket' || shirtObj.zoom_shirt_part == 'pocket-fabric') {
			$('.shirt').css({ left : ((shirtContent / 2)  - 50)+ 'px', right : 'auto', 'top': '-400px' });
			$('.reviews').css('margin-top', '300px');
		} else if (shirtObj.zoom_shirt_part == 'back') {
			$('.shirt').css({ left : ((shirtContent / 2)) + 'px', right : 'auto', 'top': '-70px' });
			$('.reviews').css('margin-top', '630px');
		} else if (shirtObj.zoom_shirt_part == 'buttons') {
			$('.shirt').css({ left : (shirtContent / 2) + 'px', right : 'auto', 'top': '-300px' });
			$('.reviews').css('margin-top', '430px');
		} else if (shirtObj.zoom_shirt_part == 'inner-buttons-fabric') {
			$('.shirt').css({ left : (shirtContent / 2) + 'px', right : 'auto', 'top': '-500px' });
			$('.reviews').css('margin-top', '250px');
		} else {
			$('.shirt').css({ left : ((docWidth - $('.shirt').width()) / 2) + 'px', right : 'auto', 'top': 'auto'});
			$('.reviews').css('margin-top', '200px');
		}
	}
	
	var selectorHeight = Math.round(60 * (shirtObj.resolution == 'low' ? 8.5 : 18.5));
	var leftToolboxHeight = selectorHeight;
	
	if (shirtObj.zoom_shirt_part != '') {
		 selectorHeight = Math.round(60 * 8.5);
		 leftToolboxHeight = selectorHeight;
	}

	$('#shirtLeftToolbox').css('height', leftToolboxHeight + 'px');
	$('#shirtLeftToolbox .panel-content .all-fabric-selector').css('height', selectorHeight + 'px');
	closeFullFabricDialog();
}

function nextMenuItem() {
	saveDesginLogToSample(shirtObj);

	if (shirtObj.sleeves == 'short' && currentMenuItemIndex == 3) {
		currentMenuItemIndex = 5;
	} else if (currentMenuItemIndex == 8) {
		if (shirtObj.monogram != 'none') {
			currentMenuItemIndex = 9;
		} else {
			currentMenuItemIndex = 11;
		}
	} else if (currentMenuItemIndex == 9) {
		if (!validMonogram()) {
			currentMenuItemIndex = 9;
		} else {
			currentMenuItemIndex = 10;
		}
	} else if (currentMenuItemIndex == 11) {
		if (getContrastPattern() == 'no') {
			currentMenuItemIndex = 16;
		} else {
			currentMenuItemIndex = 12;
		}
	} else if (shirtObj.sleeves == 'short' && currentMenuItemIndex == 12) {
		currentMenuItemIndex = 14;
	}  else if (shirtObj.pocket_left == 0 && shirtObj.pocket_right == 0 && currentMenuItemIndex == 14) { 
		currentMenuItemIndex = 16;
	} else {
		currentMenuItemIndex++;
	}
	
	showMenuItem();
}

function prevMenuItem() {
	if (designerShirt && currentMenuItemIndex == 8) {
		return;
	}
		
	if (shirtObj.sleeves == 'short' && currentMenuItemIndex == 5) {
		currentMenuItemIndex = 3;
	} else if (currentMenuItemIndex == 11 ) {
		if (shirtObj.monogram == 'none') {
			currentMenuItemIndex = 8;
		} else {
			currentMenuItemIndex = 10;
		}
	} else if (shirtObj.sleeves == 'short' && currentMenuItemIndex == 14) {
		currentMenuItemIndex = 12;
	} else if (currentMenuItemIndex > 0) {
		currentMenuItemIndex--;
	}

	showMenuItem();
}

function showMenuItem() {
	if (currentMenuItemIndex >= menuItems.length - 1) {
		currentMenuItemIndex = menuItems.length - 1;
	}
	
	if (currentMenuItemIndex < 0 || currentMenuItemIndex > menuItems.length - 1) {
		return;
	}
	
	$('.fabric-type').hide();
	var menuItem = menuItems[currentMenuItemIndex];
	
	$('.heading-panel .steps .step').removeClass('act');
	$('.heading-panel .steps .step.base').addClass('act');
	
	for (var i = 1; i <= currentMenuItemIndex; i++) {
		$('.heading-panel .steps .step.' + menuItems[i]).addClass('act'); 
	} 
	
	if (menuItem == 'contrast-pattern' || menuItem == 'final') {
		$('.panel-content .title-area').hide();
		$('#shirtApp #shirtLeftToolbox .panel-content .shortcut-contents').css('margin-top', '10px');
	} else {
		$('.panel-content .title-area').show();
		$('#shirtApp #shirtLeftToolbox .panel-content .shortcut-contents').css('margin-top', 'auto');
	}
	
	if (menuItem == 'base') {
		showBaseMenu();
	} else if (menuItem == 'cut') {
		showCutMenu();
	} else if (menuItem == 'sleeve') {
		showSleeveMenu();
	} else if (menuItem == 'collar') {
		showCollarMenu();
	} else if (menuItem == 'cleric') {
		showClericMenu();
	} else if (menuItem == 'cuffs') {
		showCuffsMenu();
	} else if (menuItem == 'buttons') {
		showButtonsMenu();
	}  else if (menuItem == 'pocket') {
		showPocketMenu();
	} else if (menuItem == 'back') {
		showBackMenu();
	} else if (menuItem == 'monogram') {
		showMonogramMenu();
	} else if (menuItem == 'monogram-text') {
		showMonogramTextMenu();
	} else if (menuItem == 'monogram-color') {
		showMonogramColorMenu();
	} else if (menuItem == 'contrast-pattern') {
		showContrastPatternMenu();
	} else if (menuItem == 'inner-collar-fabric') {
		showInnerCollarFabricMenu();
	} else if (menuItem == 'inner-cuffs-fabric') {
		showInnerCuffsFabricMenu();
	}  else if (menuItem == 'inner-buttons-fabric') {
		showInnerButtonsFabricMenu();
	} else if (menuItem == 'pocket-fabric') {
		showPocketFabricMenu();
	} else if (menuItem == 'final') {		
		if (itemId.length > 0) {
			$('.update-to-cart').trigger(clickEvent);
		} else {
			clickFromNextButton = true;
			$('.add-to-cart').trigger(clickEvent);
		}
	}
}

function updateCartItem() {
	
	delete shirtObj.zoom_shirt_part;
	removeShirtPropertiesContrastParttent();
	
	if (!validMonogram()) {
		return;
	}
	
	$.prettyLoader.show();
	loadingProcess(addingToCartLoadingMessage);
	
	$.ajax({
		url: '/_ajax/cart-update',
		type: 'POST',
		dataType: 'json',
		data: {
			id: itemId,
			details: $.toJSON(shirtObj)
		},
		success: function(response) {
			$.prettyLoader.hide();
			addedOrUpdatedToCart  = true;
			mixpanel.track('Add to cart', { item_id: response.item_id, step: menu, platform: 'desktop' }, function() {
				mixpanel.identify(mixpanel.get_distinct_id());
				mixpanel.people.set(response.xprofile, function() {
					afterCartUpdated(response);
				});
			});
		}
    });
}

function afterCartUpdated(response) {
	if (response.sizing_type != '') {
		location = '/cart';
	} else {
		location = '/cart?id=' + response.item_id;
	}
}

function addToCart() {
	
	delete shirtObj.zoom_shirt_part;
	removeShirtPropertiesContrastParttent();
	
	if (!validMonogram()) {
		return;
	}
	if (!identifier) {
		$.cookie('instance_shirt', $.toJSON(shirtObj), { path: '/' });
		location = '/sign-up-4';
		return;
	}
		
	$.prettyLoader.show();
	loadingProcess(addingToCartLoadingMessage);
	
	$.ajax({
		url: '/_ajax/cart-add',
		type: 'POST',
		dataType: 'json',
		data: {
			details : $.toJSON(shirtObj)
		},
		success: function(response) {
			$.prettyLoader.hide();
			addedOrUpdatedToCart  = true;
			mixpanel.track('Add to cart', { item_id: response.item_id, step: menu, platform: 'desktop' }, function() {
				mixpanel.identify(mixpanel.get_distinct_id());
				mixpanel.people.set(response.xprofile, function() {
					afterCartAdded(response);
				});
			});
		}
    });
}

function afterCartAdded(response) {
	location = '/cart?id=' + response.item_id;
}

function sizingCompleted(response) {
	location = '/cart';
}

/* Base Panel */

function showBaseMenu() {
	menu = 'base';
	resetZoomShirtPart();
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#base-fabric').attr('label'));
	selectedFabricByFabricName(shirtObj.base_fabric);
	if (!showPane($('.base-menu'), 'base-fabric')) return;
}

function changeBaseFabric(params, baseFabric) {
	if (!baseFabric) {
		return;
	}
	if (params.inner_buttons_fabric == params.base_fabric) {
		params.inner_buttons_fabric = baseFabric;
	}
	if (params.collar_fabric == params.base_fabric) {
		params.collar_fabric = baseFabric;
	}
	if (params.inner_collar_fabric == params.base_fabric) {
		params.inner_collar_fabric = baseFabric;
	}
	if (params.cuffs_fabric == params.base_fabric) {
		params.cuffs_fabric = baseFabric;
	}
	if (params.inner_cuffs_fabric == params.base_fabric) {
		params.inner_cuffs_fabric = baseFabric;
	}
	if (params.pocket_fabric == params.base_fabric) {
		params.pocket_fabric = baseFabric;
	}
	params.base_fabric = baseFabric;
	changeShirt(params);
}

/* Sleeve Panel */

function showSleeveMenu() {
	menu = 'sleeve';
	resetZoomShirtPart();
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#sleeve-panel').attr('label'));	
	if (!showPane($('.sleeve-menu'), 'sleeve-panel')) return;
	$('#sleeve-panel .list-item').removeClass('act');
	$('#sleeve-panel .list-item[sleeves=' + shirtObj.sleeves + ']').trigger(clickEvent, ['off']);
	
	updateLayout();
}

function changeSleeves(params, sleeves) {
	if (sleeves == 'long') {
		if (!params.cuffs) {
			params.cuffs = 'round';
			params.cuffs_fabric = params.base_fabric;
			params.inner_cuffs_fabric = params.base_fabric;
		}
	} else {
		if (params.cleric == 'collar_cuffs') {
			params.cleric = 'collar';
		}
		if (params.monogram) {
			if (params.monogram_location == 'diagonal_left_cuffs' || params.monogram_location == 'left_cuffs') {
				params.monogram_location = 'left_sleeve';
			}
		} else {
			params.monogram_text = '';
			params.monogram_location = '';
			params.monogram_color = '';
		}
		params.cuffs = '';
		params.cuffs_fabric = '';
		params.inner_cuffs_fabric ='';
	}
	params.sleeves = sleeves;
	changeShirt(params);
}

/* Cut Panel */
function showCutMenu() {
	menu = 'cut';
	$('.panel-content .title-area').html($('#cut-panel').attr('label'));
	if (!showPane($('.cut-menu'), 'cut-panel')) return;
	$('#cut-panel .eachcut[fit=' + shirtObj.fit + ']').trigger(clickEvent, ['off']);
}

function initCutPanel() {
	$('#cut-panel .eachcut').bind(clickEvent, function(e) {
		changeCut(shirtObj, $(this).attr('fit'));
		$(this).closest('.all-fabric-selector').find('img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
	});
	$('#cut-panel .eachcut').tipsy({ gravity: 'n', offset: 5, html: true });
}

function changeCut(params, fit) {
	params.fit = fit;
	changeShirt(params);
}

/* Collar Panel */

function showCollarMenu() {
	menu = 'collar';
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#collar-panel').attr('label'));
	if (!showPane($('.collar-menu'), 'collar-panel')) return;
	$('#collar-panel .eachcollar[collar=' + shirtObj.collar + ']').trigger(clickEvent, ['off']);
}

function showInnerCollarFabricMenu() {
	menu = 'inner-collar-fabric';
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	zoomShirtPart(menu);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#inner-collar-fabric').attr('label'));
	selectedFabricByFabricName(shirtObj.inner_collar_fabric);
	if (!showPane($('.inner-collar-fabric-menu'), 'inner-collar-fabric')) return;
}

function initSleevePanel() {
	$('#sleeve-panel .list-item').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		changeSleeves(shirtObj, $(this).attr('sleeves'));
		$('#sleeve-panel .list-item').removeClass('act');
		$(this).addClass('act');
		
		
		if (shirtObj.sleeves == 'long') {
			$('#cleric-panel .list-item[cleric=collar_cuffs]').show();
			$('#sizing-panel .left-right-cuffs').show();
			
			if (getContrastPattern() == 'yes') {
				$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').show();
			}
		} else if (shirtObj.sleeves == 'short') {
			$('#cleric-panel .list-item[cleric=collar_cuffs]').hide();
			$('#sizing-panel .left-right-cuffs').hide();
			$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').hide();
		}	
	});
	
	$('#sleeve-panel  .list-item[sleeves=' + shirtObj.sleeves + ']').trigger(clickEvent, ['off']);
}


function initCollarPanel() {
	$('#collar-panel .eachcollar').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		changeCollar(shirtObj, $(this).attr('collar'));
		$(this).closest('.all-fabric-selector').find('img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
		
		zoomShirtPart('collar');
	});
	
	$('#collar-panel .eachcollar').tipsy({ gravity: 'n', offset: 5, html: true });
}

function changeCollar(params, collar) {
	params.collar = collar;
	changeShirt(params);
}

function changeCollarFabric(params, collarFabric) {
	if (!collarFabric) {
		return
	}
	params.collar_fabric = collarFabric;
	changeShirt(params);
}

function changeInnerCollarFabric(params, innerCollarFabric) {
	if (!innerCollarFabric) {
		return;
	}
	params.inner_collar_fabric = innerCollarFabric;
	changeShirt(params);
	zoomShirtPart('inner-collar-fabric');
}

/* Cleric Menu */
function showClericMenu() {
	menu = 'cleric';
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	zoomShirtPart('cleric');
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#cleric-panel').attr('label'));

	if (!showPane($('.cleric-menu'), 'cleric-panel')) return;
	if (shirtObj.cleric.length > 0 ) {
		$('#cleric-panel  .list-item[cleric=' + shirtObj.cleric + ']').trigger(clickEvent, ['off']);
	}
	$('.want-tipsy').tipsy({ gravity: 'n', offset: 5, html: true });
}

function showContrastPatternMenu() {
	menu = 'contrast-pattern';
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	resetZoomShirtPart();
	changeShirt(shirtObj);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#contrast-pattern-panel').attr('label'));
	if (!showPane($('.contrast-pattern-menu'), 'contrast-pattern-panel')) return;
	
	var value = $('#contrast-pattern-panel .list-item.act').attr('contrast-pattern');
	if (hasContrastPatternAdvance() || value == 'yes') {
		$('#contrast-pattern-panel  .list-item[contrast-pattern="yes"]').trigger(clickEvent, ['off']);
	} else {
		$('#contrast-pattern-panel  .list-item[contrast-pattern="no"]').trigger(clickEvent, ['off']);
	}
	
	$('.want-tipsy').tipsy({ gravity: 'n', offset: 5, html: true });
}

function getContrastPattern() {
	return $('#contrast-pattern-panel .list-item.act').attr('contrast-pattern');
}

function hasContrastPatternAdvance() {	
	if (shirtObj.cleric == 'collar_cuffs') {
		if (shirtObj.collar_fabric != shirtObj.inner_collar_fabric) {
			return true;
		}
		
		if (shirtObj.inner_cuffs_fabric != "" && shirtObj.cuffs_fabric != shirtObj.inner_cuffs_fabric) {
			return true;
		}
		
	} else if (shirtObj.cleric == 'collar') {
		
		if (shirtObj.collar_fabric != shirtObj.inner_collar_fabric) {
			return true;
		}
		
		if (shirtObj.inner_cuffs_fabric != "" && shirtObj.base_fabric != shirtObj.inner_cuffs_fabric) {
			return true;
		}
	} else {
		if (shirtObj.base_fabric != shirtObj.inner_collar_fabric) {
			return true;
		}
		
		if (shirtObj.inner_cuffs_fabric != "" && shirtObj.base_fabric != shirtObj.inner_cuffs_fabric) {
			return true;
		}
	}
	
	if (shirtObj.base_fabric != shirtObj.inner_buttons_fabric) {
		return true;
	}

	if (shirtObj.pocket_fabric != "" && shirtObj.base_fabric != shirtObj.pocket_fabric && (shirtObj.pocket_left == 1 || shirtObj.pocket_right == 1)) {
		return true;
	}
	
	return false;
}

function initClericPanel() {
	$('#cleric-panel .list-item').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		changeClericMenu(shirtObj, $(this).attr('cleric'));
		$('#cleric-panel .list-item').removeClass('act');
		$(this).addClass('act');
		setReturnFabrics();
		closeFullFabricDialog();
	});
}

function changeClericMenu(params, cleric) {
	if (params.cleric == cleric) {
		return;
	}
 	params.cleric = cleric;
	if (cleric == 'collar_cuffs') {
		params.collar_fabric = clericFabric;
		params.inner_collar_fabric = clericFabric;
		params.cuffs_fabric = clericFabric;
		params.inner_cuffs_fabric = clericFabric;
	} else if (cleric == 'collar') {
		params.collar_fabric = clericFabric;
		params.inner_collar_fabric = clericFabric;
		if (params.cuffs_fabric == clericFabric) {
			params.cuffs_fabric = params.base_fabric;
		}
		if (params.inner_cuffs_fabric == clericFabric) {
			params.inner_cuffs_fabric = params.base_fabric;
		}
	} else {
		params.collar_fabric = params.base_fabric;
		params.inner_collar_fabric = params.base_fabric;
		if (params.cuffs_fabric == clericFabric) {
			params.cuffs_fabric = params.base_fabric;
		}
		if (params.inner_cuffs_fabric == clericFabric) {
			params.inner_cuffs_fabric = params.base_fabric;
		}
	}
	changeShirt(params);
}

function initContrastPatternPanel() {
	$('#contrast-pattern-panel .list-item').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		
		$('#contrast-pattern-panel .list-item').removeClass('act');
		$(this).addClass('act');
		
		var nextButtonObj = $('.heading-panel .but.next.next-button');
		
		if (getContrastPattern() == 'yes') {
			$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
			if (shirtObj.sleeves == 'long') {
				if (designerShirt) {
					$('.steps .step.inner-cuffs-fabric').show();
				} else {
					$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').show();
				}
			} else if (shirtObj.sleeves == 'short') {
				$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').hide();
			}	
			
			$('.steps .step.inner-collar-fabric').show();
			$('.steps .step.inner-buttons-fabric').show();
			
			if (shirtObj.pocket_left == 1 || shirtObj.pocket_right == 1) {
				$('.steps .step.pocket-fabric').show();
			} else {
				$('.steps .step.pocket-fabric').hide();
			}
			
		} else {
			$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-done'));
			$('.steps .step.inner-collar-fabric').hide();
			$('.steps .step.inner-buttons-fabric').hide();
			$('.steps .step.inner-cuffs-fabric').hide();
			$('.steps .step.pocket-fabric').hide();
		}
		
		if ($('#contrast-pattern-panel .list-item.act').attr('contrast-pattern') == 'no') {
			removeShirtPropertiesContrastParttent();
			changeShirt(shirtObj);
			updatePriceBox();
		}
	});
	
	if (hasContrastPatternAdvance() || initFirstShirtTime == "1") {
		$('.steps .step.inner-collar-fabric').show();
		$('.steps .step.inner-buttons-fabric').show();
		if (shirtObj.sleeves == 'long') {
			if (designerShirt) {
				$('.steps .step.inner-cuffs-fabric').show();
			} else {
				$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').show();
			}
		} else if (shirtObj.sleeves == 'short') {
			$('.steps .step.cuffs, .steps .step.inner-cuffs-fabric').hide();
		}
		if (shirtObj.pocket_left == 1 || shirtObj.pocket_right == 1) {
			$('.steps .step.pocket-fabric').show();
		} else {
			$('.steps .step.pocket-fabric').hide();
		}
		
		$('#contrast-pattern-panel .list-item').removeClass('act');
		$('#contrast-pattern-panel .list-item[contrast-pattern="yes"]').addClass('act');
		
	} else {
		$('.steps .step.inner-collar-fabric').hide();
		$('.steps .step.inner-buttons-fabric').hide();
		$('.steps .step.inner-cuffs-fabric').hide();
		$('.steps .step.pocket-fabric').hide();
		
		$('#contrast-pattern-panel .list-item').removeClass('act');
		$('#contrast-pattern-panel .list-item[contrast-pattern="no"]').addClass('act');
	}
}

/* Cuffs Panel */

function showCuffsMenu() {
	menu = 'cuffs';
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#cuffs-panel').attr('label'));
	if (!showPane($('.cuffs-menu'), 'cuffs-panel')) return;
	$('#cuffs-panel .eachcuff[cuff=' + shirtObj.cuffs + ']').trigger(clickEvent, ['off']);
}

function showInnerCuffsFabricMenu() {
	menu = 'inner-cuffs-fabric';
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	zoomShirtPart(menu);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#inner-cuffs-fabric').attr('label'));
	selectedFabricByFabricName(shirtObj.inner_cuffs_fabric);
	if (!showPane($('.inner-cuffs-fabric-menu'), 'inner-cuffs-fabric')) return;
}

function initCuffsPanel() {
	$('#cuffs-panel .eachcuff').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		changeCuffs(shirtObj, $(this).attr('cuff'));
		$(this).closest('.all-fabric-selector').find('img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
		closeImageDialog();
		
		zoomShirtPart('cuffs');
	});
	
	$('#cuffs-panel .eachcuff').tipsy({ gravity: 'n', offset: 5, html: true });
}

function changeCuffs(params, cuffs) {
	params.cuffs = cuffs;
	changeShirt(params);
}

function changeCuffsFabric(params, cuffsFabric) {
	if (!cuffsFabric) {
		return;
	}
	params.cuffs_fabric = cuffsFabric;
	changeShirt(params);
	resetCuffsFabricMenu();
}

function changeInnerCuffsFabric(params, innerCuffsFabric) {
	if (!innerCuffsFabric) {
		return;
	}
	params.inner_cuffs_fabric = innerCuffsFabric;
	changeShirt(params);
	resetInnerCuffsFabricMenu();
	$('#current-inner-cuffs-fabric img').attr('src', '/_media/fabrics/small/' + innerCuffsFabric + '.jpg');
	var fabric = getFabric(innerCuffsFabric);
	$('#contentmenu-cuffs-inner-fabric').css('background-position', 'left -' + fabric.thumb_top +"px");
}

function selectCuffsFabricMenu() {
	resetCuffsFabricMenu();
	$('.inner-cuffs-picker').hide();
	$('.cuffs-picker').show();
}

function resetCuffsFabricMenu() {
	var cuffsMatchSelect = $('#cuffsMatchSelect');
	cuffsMatchSelect.find('option').remove();
	cuffsMatchSelect.append("<option value='select'>Select</option>");
	cuffsMatchSelect.append("<option value='base'>Base Fabric</option>");
	cuffsMatchSelect.append("<option value='collar'>Collar Fabric</option>");
	cuffsMatchSelect.append("<option value='inner-collar'>Inner Collar Fabric</option>");
	cuffsMatchSelect.append("<option value='inner-cuffs'>Inner Cuffs Fabric</option>");
	cuffsMatchSelect.append("<option value='inner-button'>Inner Button Fabric</option>");
	if (shirtObj.cuffs_fabric == shirtObj.base_fabric) {
		cuffsMatchSelect.val('base');
	} else {
		cuffsMatchSelect.val('select');
	}
}

function selectInnerCuffsFabricMenu() {
	resetInnerCuffsFabricMenu();
	$('.cuffs-picker').hide();
	$('.inner-cuffs-picker').show();
}

function resetInnerCuffsFabricMenu() {
	var innerCuffsMatchSelect = $('#innerCuffsMatchSelect');
	innerCuffsMatchSelect.find('option').remove();
	innerCuffsMatchSelect.append("<option value='select'>Select</option>");
	innerCuffsMatchSelect.append("<option value='base'>Base Fabric</option>");
	innerCuffsMatchSelect.append("<option value='collar'>Collar Fabric</option>");
	innerCuffsMatchSelect.append("<option value='inner-collar'>Inner Collar Fabric</option>");
	innerCuffsMatchSelect.append("<option value='cuffs'>Cuffs Fabric</option>");
	innerCuffsMatchSelect.append("<option value='inner-button'>Inner Button Fabric</option>");
	if (shirtObj.inner_cuffs_fabric == shirtObj.base_fabric) {
		innerCuffsMatchSelect.val('base');
	} else {
		innerCuffsMatchSelect.val('select');
	}
}

/* Buttons Panel */
function showButtonsMenu() {
	menu = 'buttons';
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	$('.panel-content .title-area').html($('#buttons-panel').attr('label'));
	$('#buttons-panel .eachbutton[buttons_name=' + shirtObj.buttons + ']').trigger(clickEvent, ['off']);
	if (!showPane($('.buttons-menu'), 'buttons-panel')) return;
}

function showInnerButtonsFabricMenu() {
	menu = 'buttons-fabric';
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	changeShirt(shirtObj);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	if (shirtObj.pocket_left == 1 || shirtObj.pocket_right == 1) {
		$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	} else {
		$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-done'));
	}
	
	$('.panel-content .title-area').html($('#inner-buttons-fabric').attr('label'));
	selectedFabricByFabricName(shirtObj.inner_buttons_fabric);
	if (!showPane($('.inner-button-fabric-menu'), 'inner-buttons-fabric')) return;
}

function initButtonsPanel() {
	for (var j = 0; j < shirtButtonObj.length ; j++) {
	   $('.shortcut-content-buttons-type .all-fabric-selector').append(renderThumbImageButtonsType(shirtButtonObj[j]));
	}
	$('#all-buttons-type .each').bind(clickEvent, function(e, direct) {
		var buttonColorName = $(this).attr('buttons_name');
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		changeButtons(shirtObj, buttonColorName);
		closeImageDialog();
		$(this).closest('#all-buttons-type').find('img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
		
		zoomShirtPart('buttons');
	});
	
	$('#all-buttons-type .each').tipsy({ gravity: 'n', offset: 5, html: true });
}

function renderThumbImageButtonsType(button) {
	return "<div class='each eachbutton' buttons_name='" + button.name + "' type='" + button.type + "' title='" + button.title + "' style='background: url(" + urlImagesCdn + "images/_media/buttons/small/" + button.name + ".jpg?v=4);'></div>";
}

function getButtonsColor(buttonColorName) {
	var buttonColor = null;
	$(shirtButtonObj).each(function(i, e) {
		if (e.name == buttonColorName) {
			buttonColor = e;
			return buttonColor;
		}
	});
	return buttonColor;
}

function changeButtons(params, buttons) {
	params.buttons = buttons;
	changeShirt(params);
}

function changeButtonsFabric(params, buttonsFabric) {
	if (!buttonsFabric) {
		return;
	}
	params.inner_buttons_fabric = buttonsFabric;
	changeShirt(params);
	$('#current-inner-buttons-fabric img').attr('src', '/_media/fabrics/small/' + buttonsFabric + '.jpg');
	var fabric = getFabric(buttonsFabric);
	$('#contentmenu-inner-button-fabric').css('background-position', 'left -' + fabric.thumb_top +"px");
	
	zoomShirtPart('inner-buttons-fabric');
}

/* Pocket Panel */

function showPocketMenu() {
	menu = 'pocket';
	$('.panel-content .title-area').html($('#pocket-panel').attr('label'));
	if (!showPane($('.pocket-menu'), 'pocket-panel')) return;
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	$('#pocket-panel .list-item').removeClass('act');
	if (shirtObj.pocket_left == '1' && shirtObj.pocket_right == '1') {
		$('#pocket-panel .list-item[pocket=both]').trigger(clickEvent, ['off']);
	} else if (shirtObj.pocket_left == '0' && shirtObj.pocket_right == '0') {
		$('#pocket-panel .list-item[pocket=none]').trigger(clickEvent, ['off']);
	} else if (shirtObj.pocket_left == '1') {
		$('#pocket-panel .list-item[pocket=left]').trigger(clickEvent, ['off']);
	} else {
		$('#pocket-panel .list-item[pocket=right]').trigger(clickEvent, ['off']);
	}
	selectedFabricByFabricName(shirtObj.pocket_fabric);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
}

function initPocketPanel() {
	$('#pocket-panel .list-item').bind(clickEvent, function(e, direct) {
		if (shirtObj.position == 'back') {
			shirtObj.position = 'front';
		}
		var pocketItem =  $(this).attr('pocket');
		
		if (pocketItem == 'none') {
			$('#monogram-location-list .eachmonogramlocation[location="left_pocket"] img').remove();
			$('.steps .step.pocket-fabric').hide();
		} else {
			if (getContrastPattern() == 'yes') {
				$('.steps .step.pocket-fabric').show();
			}
		}
		
		changePocket(shirtObj, pocketItem);
		$('#pocket-panel .list-item').removeClass('act');
		$(this).addClass('act');
		
		zoomShirtPart('pocket');
	});
}

function changePocket(params, pocket) {
	if (pocket == 'left') {
		params.pocket_left = 1;
		params.pocket_right = 0;
		if (!params.pocket_fabric) {
			params.pocket_fabric = params.base_fabric;
		}
	} else if (pocket == 'right') {
		params.pocket_left = 0;
		params.pocket_right = 1;
	} else if (pocket == 'both') {
		params.pocket_left = 1;
		params.pocket_right = 1;
	} else {
		params.pocket_left = 0;
		params.pocket_right = 0;
		params.pocket_fabric = '';
	}
	changeShirt(params);
}

function showPocketFabricMenu() {
	menu = 'pocket-fabric';
	$('.panel-content .title-area').html($('#pocket-fabric-panel').attr('label'));
	if (!showPane($('.pocket-fabric-menu'), 'pocket-fabric-panel')) return;
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	zoomShirtPart(menu);
	
	selectedFabricByFabricName(shirtObj.pocket_fabric);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-done'));
}

function changePocketFabric(params, pocketFabric) {
	if (!pocketFabric) {
		return;
	}
	if (params.pocket_left || params.pocket_right) {
		params.pocket_fabric = pocketFabric;
	}
	changeShirt(params);
}

/* Back Panel */

function showBackMenu() {
	menu = 'back';
	$('.panel-content .title-area').html($('#back-panel').attr('label'));
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	if (!showPane($('.back-menu'), 'back-panel')) return;
	if (shirtObj.pleat == 'box') {
		$('#back-panel .eachpleat[pleat=box]').trigger(clickEvent, ['off']);
	} else if (shirtObj.pleat == 'side') {
		$('#back-panel .eachpleat[pleat=side]').trigger(clickEvent, ['off']);
	} else {
		$('#back-panel .eachpleat[pleat=none]').trigger(clickEvent, ['off']);
	}
}

function initBackPanel() {
	$('#back-panel .eachpleat').bind(clickEvent, function(e, direct) {
		changePleat(shirtObj, $(this).attr('pleat'));
		
		$('#back-panel .eachpleat').removeClass('act');
		$(this).closest('.all-fabric-selector').find('img').remove();
		$(this).closest('.all-fabric-selector').find('.image-checked').hide();
		
		if ($(this).hasClass('none')) {
			$(this).closest('.all-fabric-selector').find('.image-checked').show();
		} else {
			$(this).append("<img src='/_ui/images/app/tick.png'/>");
		}
		
		$(this).addClass('act');
		
		zoomShirtPart('back');
	});
	
	$('#back-panel .eachpleat').tipsy({ gravity: 'n', offset: 5, html: true });
}

function changePleat(params, pleat) {
	if (pleat == 'box') {
		params.pleat = 'box';
	} else if (pleat == 'side') {
		params.pleat = 'side';
	} else {
		params.pleat = '';
	}
	changeShirt(params);
}

/* Monogram Panel */

function showMonogramMenu() {
	menu = 'monogram';
	$('.panel-content .title-area').html($('#monogram-panel').attr('label'));
	resetZoomShirtPart();
	if (!showPane($('.monogram-menu'), 'monogram-panel')) return;
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}

	$('#monogram-style-list .eachmonogram[monogram=' + shirtObj.monogram + ']').trigger(clickEvent, ['off']);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	updateLayout();
}

/* Monogram Text Panel */

function showMonogramTextMenu() {
	menu = 'monogram-text';
	$('.panel-content .title-area').html($('#monogram-text-panel').attr('label'));
	resetZoomShirtPart();
	
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
		
	changeShirt(shirtObj);
	
	if (!showPane($('.monogram-text'), 'monogram-text-panel')) return;
	
	$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=left_cuffs]').hide();
	$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=diagonal_left_cuffs]').hide();
	
	if (shirtObj.sleeves == 'long') {
		$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=left_cuffs]').show();
		$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=diagonal_left_cuffs]').show();
	}
	$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=left_pocket]').hide();
	if (shirtObj.pocket_left== '1' && shirtObj.pocket_right == '1') {
		$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=left_pocket]').show();
	} else if (shirtObj.pocket_left == '1') {
		$('#monogram-text-panel').find('#monogram-location-list .eachmonogramlocation[location=left_pocket]').show();
	}
	
	$('#monogram-location-list .eachmonogramlocation[location=' + shirtObj.monogram_location + ']').trigger(clickEvent, ['off']);
	
	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	updateLayout();
}

function showMonogramColorMenu() {
	resetZoomShirtPart();
	if (shirtObj.position == 'back') {
		shirtObj.position = 'front';
	}
	
	changeShirt(shirtObj);
	
	if (!validMonogram()) {
		return;
	}
	
	menu = 'monogram-color';
	$('.panel-content .title-area').html($('#monogram-color-panel').attr('label'));

	var nextButtonObj = $('.heading-panel .but.next.next-button');
	$('.heading-panel .but.next.next-button span').html(nextButtonObj.attr('data-next'));
	
	if (!showPane($('.monogram-color'), 'monogram-color-panel')) return;
	if (shirtObj.monogram_color.length > 0) {
		$('#all-monogram-color .each[monogram-color=' + shirtObj.monogram_color + ']').trigger(clickEvent, ['off']);  
	}
	
	updateLayout();
}

function initMonogramPanel() {
	$('#monogram-style-list .eachmonogramstyle').bind(clickEvent, function(e, direct) {
		e.stopPropagation();
	
		$('#monogram-style-list .eachmonogramstyle img').remove();
		$('#monogram-style-list .eachmonogramstyle').removeClass('act');
		$(this).closest('.all-fabric-selector').find('.image-checked').hide();
		
		if ($(this).hasClass('none')) {
			$(this).closest('.all-fabric-selector').find('.image-checked').show();
		} else {
			$(this).append("<img src='/_ui/images/app/tick.png'/>");
		}
		
		$(this).addClass('act');
		
		if ($(this).attr('monogram') != 'none') {
			$('.steps .step.monogram-color, .steps .step.monogram-text').removeClass('act');
			$('.steps .step.monogram-color, .steps .step.monogram-text').show();
		} else {
			$('#monogram-location-list .each.eachmonogramlocation img').remove();
			$('.steps .step.monogram-color, .steps .step.monogram-text').addClass('act');
			$('.steps .step.monogram-color, .steps .step.monogram-text').hide();
		}

		$('#monogram-panel .user-input input').val(shirtObj.monogram_text);
		$('#monogram-location-list .eachmonogramlocation[location=' + shirtObj.monogram_location + ']').trigger(clickEvent, ['off']);
		
		shirtObj.monogram = $(this).attr('monogram');
		
		resetZoomShirtPart();
		changeShirt(shirtObj);
	});
	
	$('#monogram-style-list .eachmonogram[monogram=' + shirtObj.monogram + ']').trigger(clickEvent, ['off']);
}

function initMonogramTextPanel() {
	$('#monogram-location-list .eachmonogramlocation').bind(clickEvent, function(e, direct) {
		e.stopPropagation();
		$('#monogram-location-list .eachmonogramlocation img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
		shirtObj.monogram_location = $(this).attr('location');	
		changeShirt(shirtObj);
	});
	
	$('#monogram-style-list .eachmonogram').tipsy({ gravity: 'n', offset: 5, html: true });
	$('#monogram-location-list .eachmonogramlocation').tipsy({ gravity: 'n', offset: 5, html: true });
	
	$('#monogram-text-panel .user-input input').val(shirtObj.monogram_text);
	
	$('#monogram-panel .user-input input').blur(function() {
		shirtObj.monogram_text = $(this).val();
	});
	
	addAllMonogramColor();
	
	$('#monogram-location-list .eachmonogramlocation[location=' + shirtObj.monogram_location + ']').trigger(clickEvent, ['off']);
}

function getMonogramColor(monogramColorName) {
	var monogramColor = null;
	$(shirtMonogramColorObj).each(function(i, e) {
		if (e.name == monogramColorName) {
			monogramColor = e;
			return false;
		}
	});
	return monogramColor;
}

function addAllMonogramColor() {
	for (var j = 0; j < shirtMonogramColorObj.length ; j++) {
		$('#monogram-color-panel .all-fabric-selector').append(renderThumbImageMonogramColor(shirtMonogramColorObj[j]));
	}
	
	$('#all-monogram-color .each').bind(clickEvent, function(e, direct) {
		var monogramColorName = $(this).attr('monogram-color');
		shirtObj.monogram_color = monogramColorName;
		$(this).closest('#all-monogram-color').find('img').remove();
		$(this).append("<img src='/_ui/images/app/tick.png'/>");
	});
	
	$('#all-monogram-color .each').tipsy({ gravity: 'n', offset: 5, html: true });
}

function renderThumbImageMonogramColor(color) {
	return "<div class='each eachmonogramcolor' monogram-color='" + color.name + "' title='" + color.title + "' style='background: url(" + urlImagesCdn + "images/_media/monograms/colors/small/" + color.name + ".jpg?v=2);'></div>";
}

function changeShirt(params) {
	$('.shirt').removeClass('resolution-low');
	$('.shirt').removeClass('resolution-high');
	$('#shirt').removeClass('low');
	$('#shirt').removeClass('high');
	
	if (params.zoom_shirt_part != '') {
		params.resolution = 'high';
	}
	
	if (params.resolution == 'low') {
		$('.shirt').addClass('resolution-low');
		$('#shirt').addClass('low');
		if (params.zoom_shirt_part == '') {
			$('.zoom').hide();
			$('.zoom-in').show();
			$('.exit-zoom-view').hide();
			$('#shirtLeftToolbox').css('visibility', 'visible');
			$('.gallery').css('visibility', 'visible');
			$('.reviews').css('visibility', 'visible');
		} 
	} else {
		$('.shirt').addClass('resolution-high');
		$('#shirt').addClass('high');
		if (params.zoom_shirt_part == '') {
			$('.zoom').hide();
			$('.zoom-out').show();
			$('.exit-zoom-view').show();
			$('#shirtLeftToolbox').css('visibility', 'hidden');
			$('.gallery').css('visibility', 'hidden');
			$('.reviews').css('visibility', 'hidden');
		}
	}
	
	//updateLayout();
	if (params.position == 'back') {
		if (params.pleat) {
			shirt.find('.base').css('background-image', 'url(' + shirtCdn + params.resolution + '/'  + params.base_fabric + '/back/' + 'pleats_' + params.pleat + '_slim.png?v=' + shirtVersion + ')');
		} else {
			shirt.find('.base').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.base_fabric + '/' + params.position + '/base_slim.png?v=' + shirtVersion + ')');
		}
		shirt.find('.collar-inner').css('background-image', 'none');
		$('.shirt .collar').css('z-index', 0);
	} else {
		shirt.find('.base').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.base_fabric + '/' + params.position + '/base_slim.png?v=' + shirtVersion + ')');
		shirt.find('.collar-inner').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.inner_collar_fabric + '/' +  params.position + '/collar_' + getCollarStandardName(params.collar) + '_inner.png?v=' + shirtVersion + ')');
		$('.shirt .collar').css('z-index', 4);
	}
	shirt.find('.sleeves').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.base_fabric + '/' +  params.position + '/sleeves_' + params.sleeves + '_slim.png?v=' +  shirtVersion + ')');
	shirt.find('.collar').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.collar_fabric + '/' +  params.position +  '/collar_' + getCollarStandardName(params.collar) + '.png?v=' + shirtVersion + ')');
	
	shirt.find('.sleeves').css('z-index', 3);
	shirt.find('.base-buttons').css('background-image', 'url(' + shirtCdn + params.resolution + '/buttons/' + params.buttons + '/' + params.position + '/buttons_base_slim.png?v=' + shirtVersion + ')');
	shirt.find('.base-inner').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.inner_buttons_fabric + '/' +  params.position + '/base_placket_inner_slim.png?=' + shirtVersion + ')');
	shirt.find('.collar-buttons').css('background-image', 'url(' + shirtCdn + params.resolution + '/buttons/' + params.buttons + '/' + params.position + '/' + getCollarButtonFile(params.collar) + '?v=' + shirtVersion + ')');
	
	if (params.pocket_left == 1) {
		shirt.find('.pocket-left').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.pocket_fabric + '/' +  params.position + '/pocket_left_slim.png?v=' + shirtVersion + ')');
	} else {
		shirt.find('.pocket-left').css('background-image', 'none');
	}
	
	if (params.pocket_right == 1) {
		shirt.find('.pocket-right').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.pocket_fabric + '/' +  params.position + '/pocket_right_slim.png?v=' + shirtVersion + ')');
	} else {
		shirt.find('.pocket-right').css('background-image', 'none');
	}
	
	if (params.position == 'front') {
		$('.shortcut').show();
		$('.shortcut-cuffs,.shortcut-inner-cuffs').toggle(params.sleeves == 'long');
	} else {
		$('.shortcut').hide();
	}
	
	if (params.sleeves == 'long') {
		shirt.find('.cuffs').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.cuffs_fabric + '/' +  params.position + '/cuffs_' + (params.cuffs == 'french' ? 'french' : params.cuffs + '_slim') + '.png?v=' + shirtVersion + ')');
		shirt.find('.cuffs-inner').css('background-image', 'url(' + shirtCdn + params.resolution + '/' + params.inner_cuffs_fabric + '/' +  params.position + '/cuffs_' + params.cuffs + '_inner.png?v=' + shirtVersion + ')');
		shirt.find('.cuffs-buttons').css('background-image', 'url(' + shirtCdn + params.resolution + '/buttons/' + params.buttons + '/' + params.position + '/' + getCuffsButtonFile(params.cuffs) + '?v=' + shirtVersion + ')');
	} else {
		shirt.find('.cuffs').css('background-image', 'none');
		shirt.find('.cuffs-inner').css('background-image', 'none');
		shirt.find('.cuffs-outer').css('background-image', 'none');
		shirt.find('.cuffs-buttons').css('background-image', 'none');
		
		params.cuffs = '';
		params.cuffs_fabric = '';
		params.inner_cuffs_fabric = '';
		if (params.monogram_location == 'left_cuffs' || params.monogram_location == 'right_cuffs') {
			params.monogram_location = '';
		}
	}
	if (params.monogram == 'none') {
		params.monogram_text = '';
		params.monogram_location = '';
	}
	
	if (!params.pocket_left && !params.pocket_right && (params.monogram_location == 'left_pocket' || params.monogram_location == 'right_pocket')) {
		params.monogram_location = '';
	} else if (params.pocket_left && !params.pocket_right && params.monogram_location == 'right_pocket') {
		params.monogram_location = 'left_pocket';
	} else if (params.pocket_right && !params.pocket_left && params.monogram_location == 'left_pocket') {
		params.monogram_location = 'right_pocket';
	}
	renderMonogramRotation();
	updatePriceBox();
}

function getCollarButtonFile(collar) {
	if (collar == 'short_button_down' || collar == 'dual_button') {
		return 'buttons_collar_' + collar + '.png';
	} else {
		return 'buttons_collar_one_button.png';
	}
}

function getCollarStandardName(collar) {
	if (collar == 'short_point' || collar == 'short_button_down_2' || collar == 'big_round_button_down' || collar == 'pin_hole') {
		return 'regular';
	} else {
		return collar;
	}
}

function getCuffsButtonFile(cuffs) {
	if (cuffs == 'big_round' || cuffs == 'big_angle') {
		return 'buttons_cuffs_big.png';
	} else if (cuffs == 'french'){
		return 'buttons_cuffs_french.png';
	} else {
		return 'buttons_cuffs.png';
	}
}

function loadProgressbar(shirtObj) {
	$('#progress_bar .ui-progress').clearQueue();
    $('#progress_bar .ui-progress').css('width', '0%');
    $('#progress_bar .current-ui-progress').show();
    $('body').x_overlay({ trigger : true });
    var left = $('body').width() / 2 - 260;
	$('#progress_bar').css('left', left + 'px');
    $('#progress_bar').show();
	
	$('.share-publish').hide();
	var childrens = $('.shirt').children();
	var positionOld = shirtObj.position;
	var positionsShirt = ['front'];
	var the_images = [];
	$.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()); 
	$.each(positionsShirt, function(i, position){
		shirtObj.position = position;
		changeShirt(shirtObj);
		childrens.each(function(i, children){
			var bg = $(children).css('background-image');
			if($.browser.chrome){
				bg = bg.replace('url(','').replace(')','');
			} else {
				bg = bg.replace('url("','').replace('")','');
			}
			if(bg && bg != 'none') {
				the_images.push(bg);
			}
	    });
	});
	
	// base fabrics
	var uniqueImage = [];
	for (var j = 0; j < fabrics.length; j++) {
		if (fabrics[j].use_base) {
			 if($.inArray(fabrics[j].desktop_sprite_image, uniqueImage) === -1) uniqueImage.push(fabrics[j].desktop_sprite_image);
		}
	}
	
	$.each(uniqueImage, function(i, item) {
		the_images.push(item);
	});
	
	shirtObj.position = positionOld;
	var count = 0;  
	
	$.imgpreload(the_images, {
		each: function() {
			count++;
			var status = parseInt((count/the_images.length) * 100);
			$('#progress_bar .ui-progress').animateProgress(status, function() {
				$('#progress_bar .ui-label .value').html(status + '%');
				if (status > 33) {
					$('#progress_bar .current-ui-progress').css('margin-left', status - 33 + '%');
				}
			});
		},
		all: function() {
			$('#progress_bar .ui-progress').animateProgress(100, function() {
				$('#progress_bar').hide();
				 $('#progress_bar .current-ui-progress').hide();
				$('#progress_bar .ui-progress').clearQueue();
				$('#container').x_overlay({ trigger : false });
				menu = 'base';
				$(window).resize();
				setTimeout(function() {
					$('#shirtLeftToolbox').show('slide', { direction: 'left' }, 'slow', function() {
						setTimeout(function() {
							$('.price-box').fadeIn( function() {
								setTimeout(function() {
									$('.rotate-shirt').fadeIn();
									$('.mid').fadeIn();
									loadDone();
								}, 1000);
							});
						}, 1000);
					});
				}, 1000);
			});
		}
	});
	
}

function loadDone() {
    loadReviews();

	if (navigator.userAgent.match(/(Android|webOS|iPhone|iPad|iPod|BlackBerry)/i)) {
		if (Math.abs(window.orientation) != 90) {
			alert(orientationMessage);
		}
	}
}

function updateOrientation() {
	if (!navigator.userAgent.match(/(Android|webOS|iPhone|iPad|iPod|BlackBerry)/i)) {
		return;
	}
	if (Math.abs(window.orientation) != 90) {
		alert(orientationMessage);
	} else {
		osCloseDialog();
	}
}

function loadReviews() {
	$('.reviews .loader').show();
	$.ajax({
		url: '/_ajax/design/reviews',
		type: 'get',
		data: {count : 20},
		dataType: 'json',
		success: function(response) {
			if (response.result == 'success') {
				$('.review-cols').append(response.html);
			} 
			$('.reviews').show();
		}
	});
}

function showShirtInApp(sampleId) {
	$.prettyLoader.show();
	$.ajax({
		url: '/_ajax/get-sample-data',
		type: 'post',
		data: { sample_id : sampleId },
		dataType: 'json',
		success: function(response) {
			$.prettyLoader.hide();
			shirtObj = response;
			showBaseMenu();
			$('body,html').animate({ scrollTop: 0 }, 300);
		}
	});
}

function likeDesign(element, designId) {
	if ($(element).hasClass('liked')) {
		return;
	}
	$(element).addClass('liked');
	$.ajax({
		url: '/_ajax/common/like-design',
		type: 'post',
		data: { sampleId : designId },
		dataType: 'json',
		success: function(response) {
			if (response.result == 'success') {
				$(element).closest('.stat').find('.like-count').html(response.count + '&nbsp;');			
			} 
		}
	});
}

function renderMonogramRotation() {
	if ($.browser.msie) {
		if (parseInt($.browser.version, 10) < 9) {
			return;
		}
	}
	if (shirtObj.position == 'front' && shirtObj.sleeves == 'long' && shirtObj.monogram_text && shirtObj.monogram_location) {
		$('#monogram-rotate-text').text(shirtObj.monogram_text);
		$('#monogram-rotate-text').removeClass('right_cuffs').removeClass('left_cuffs').removeClass('right_pocket').removeClass('left_pocket');
		$('#monogram-rotate-text').addClass(shirtObj.monogram_location);
		$('.monogram-rotate').show();
	} else {
		$('.monogram-rotate').hide();
	}
}

function changeLowShirt() {
	resetZoomShirtPart();
	shirtObj.resolution = 'low';
	$('.shirt').fadeOut(function(){
		changeShirt(shirtObj);
		$('.shirt').fadeIn();
		updateLayout();
	});
}

function changeHighShirt() {
	shirtObj.resolution = 'high';
	$('.shirt').fadeOut(function(){
		changeShirt(shirtObj);
		$('.shirt').fadeIn();
		updateLayout();
	});
}

function zoomShirtPart(atStep) {
	shirtObj.zoom_shirt_part = atStep;
	$('.shirt').fadeOut(function(){
		changeShirt(shirtObj);
		$('.shirt').fadeIn();
		updateLayout();
	});
}

function resetZoomShirtPart() {
	shirtObj.zoom_shirt_part = '';
	shirtObj.resolution = 'low';
}

function rotateShirt(position) {
	shirtObj.position = position;
	changeShirt(shirtObj);
}

function rotateLeft() {
	var nextPosition = null;
	if (shirtObj.position == 'front') {
		nextPosition = 'left';
	} else if (shirtObj.position == 'left') {
		nextPosition = 'back';
	} else if (shirtObj.position == 'back') {
		nextPosition = 'right';
	} else {
		nextPosition = 'front';
	}
	shirtObj.position = nextPosition;
	$('.shirt').fadeOut(function(){
		changeShirt(shirtObj);
		$('.shirt').fadeIn();
	});
}

function rotateRight() {
	var nextPosition = null;
	if (shirtObj.position == 'front') {
		nextPosition = 'right';
	} else if (shirtObj.position == 'right') {
		nextPosition = 'back';
	} else if (shirtObj.position == 'back') {
		nextPosition = 'left';
	} else {
		nextPosition = 'front';
	}
	shirtObj.position = nextPosition;
	$('.shirt').fadeOut(function(){
		changeShirt(shirtObj);
		$('.shirt').fadeIn();
	});
}

function getShirtPrice(params) {
	var total = 0;
	var baseFabric = getFabric(params.base_fabric);
	if (baseFabric != null) {
		total += parseFloat(baseFabric.price);
	} else {
		total = 0;
	}
	if (params.inner_buttons_fabric != params.base_fabric) {
		total += parseFloat(innerButtonPrice);
	}
	if (params.inner_collar_fabric != params.base_fabric && !((params.cleric == 'collar' || params.cleric == 'collar_cuffs') && params.inner_collar_fabric == params.collar_fabric)) {
		total += parseFloat(innerCollarPrice);
	}
	if (params.inner_cuffs_fabric && params.inner_cuffs_fabric != params.base_fabric && !(params.cleric == 'collar_cuffs' && params.inner_cuffs_fabric == params.cuffs_fabric)) {
		total += parseFloat(innerCuffsPrice);
	}
	if (params.cleric == 'collar_cuffs') {
		total += parseFloat(clericCollarCuffsPrice);
	} else if (params.cleric == 'collar') {
		total += parseFloat(clericCollarPrice);
	}
	if (designerShirt) {
		total += designerPrice;
	}
	if (params.monogram != 'none' && params.monogram.length > 0 ) {
		total += parseFloat(monogramPrice);
	}
	if (params.sleeves == 'long' && params.cuffs == 'french') {
		total += parseFloat(frenchCuffsPrice);
	}
	if (params.pocket_left == 1 && params.base_fabric != params.pocket_fabric) {
		total += parseFloat(contrastPocketPrice);
	}
	var buttonColor = getButtonsColor(params.buttons);
	var buttonPrice = buttonColor['price'];
	total += parseFloat(buttonPrice);
	
	return new Number(total).toFixed(2);
}

function getMinShirtPriceForDesigner(params) {
	var total = 0;
	var baseFabric = getFabric(params.base_fabric);
	if (baseFabric != null) {
		total += parseFloat(baseFabric.price);
	} else {
		total = 0;
	}
	if (params.inner_buttons_fabric != params.base_fabric) {
		total += parseFloat(innerButtonPrice);
	}
	if (params.inner_collar_fabric != params.base_fabric && !((params.cleric == 'collar' || params.cleric == 'collar_cuffs') && params.inner_collar_fabric == params.collar_fabric)) {
		total += parseFloat(innerCollarPrice);
	}
	if (params.inner_cuffs_fabric && params.inner_cuffs_fabric != params.base_fabric && !(params.cleric == 'collar_cuffs' && params.inner_cuffs_fabric == params.cuffs_fabric)) {
		total += parseFloat(innerCuffsPrice);
	}
	if (params.cleric == 'collar_cuffs') {
		total += parseFloat(clericCollarCuffsPrice);
	} else if (params.cleric == 'collar') {
		total += parseFloat(clericCollarPrice);
	}
	if (designerShirt) {
		total += designerPrice;
	}
	var buttonColor = getButtonsColor(params.buttons);
	var buttonPrice = buttonColor['price'];
	total += parseFloat(buttonPrice);
	
	return new Number(total).toFixed(2);
}

function getFabric(fabricName) {
	var fabric = null;
	$(fabrics).each(function(i, e) {
		if (e.name == fabricName) {
			fabric = e;
			return false;
		}
	});
	return fabric;
}

function showPublishShirt() {
	osLoad({
		type: 'post',
		url: '/designer/publish',
		shirt: shirtObj
	});
}

function validPublicShirt(name) {
	if(name =='') {
		$('#custom_name').css('border', 'red 1px solid');
		return false;
	}
	$('#custom_name').css('border', '1px solid #CCCCCC');
	return true;
}

function validMonogram() {
	selectedMonogram = $('#monogram-style-list .eachmonogram img').closest('.eachmonogram').attr('monogram');
	var needToValid = (selectedMonogram != undefined && selectedMonogram != 'none');

	if (needToValid) {
		var valid = true; 
		var userInput = $('.user-input input:first-child');
		var validator = /^[\.a-z0-9]+$/i;
		var monogramText = $.trim(userInput.val());
		if (!monogramText || !validator.test(monogramText)) {		
			$('#monogram-lable').html($('#monogram-lable').attr('message-fail'));
			$('#monogram-lable').stop(true, true).animate( { color: "red" }, 400);
			$('#monogram-lable').animate( { opacity: ".1" }, 400);
			$('#monogram-lable').animate( { opacity: "1" }, 400);
			$('#monogram-input').css('border', '1px solid red');
			// attach event to normalize sub title 
			$('#monogram-input').keypress(function() {
				$('#monogram-lable').css('color', '#808080');
				$('#monogram-lable').html($('#monogram-lable').attr('message-ok'));
				$('#monogram-input').css('border', '1px solid #ccc');
			});
			valid = false;
		}
		
		if ((shirtObj.pocket_left == 0 && shirtObj.monogram_location == 'left_pocket') || (shirtObj.pocket_right ==0 && shirtObj.monogram_location == 'right_pocket')) {
			$('#monogram-location-list .eachmonogramlocation[location="left_pocket"] img').remove();
			shirtObj.monogram_location = "";
			valid = false;
		}
		
		var selectedLocation = $('#monogram-location-list .eachmonogramlocation img').closest('.eachmonogramlocation');
		if (selectedLocation.length == 0 || !shirtObj.monogram_location) {		
			var locationSubTitle = $('#monogram-location-list').prev();
			$(locationSubTitle).stop(true, true).animate( { color: "red" }, 400);
			$(locationSubTitle).animate( { opacity: ".1" }, 400);
			$(locationSubTitle).animate( { opacity: "1" }, 400);
			$(locationSubTitle).html($(locationSubTitle).attr('message-fail'));
			
			// attach event to normalize sub title 
			$('#monogram-location-list .eachmonogramlocation').click(function() {
				$(locationSubTitle).css('color', '#808080');
				$(locationSubTitle).html($(locationSubTitle).attr('message-ok'));
			});
			valid = false;
		}
				
		if (valid == false) {
			currentMenuItemIndex = 9;
		}
		
		if (!valid) {
			showMenuItem();
		} 
		
		if ($.trim(shirtObj.monogram_color).length == 0 || shirtObj.monogram_color == 'none') {
			shirtObj.monogram_color = 'white';
		}
		
		if (selectedMonogram != 'none' && monogramText == '') {
			return false;
		}
		if (monogramText && !shirtObj.monogram_text) {
			shirtObj.monogram_text = monogramText;
		}

		return valid;
	}
	
	return true;
}

function showPane(elem, elemId) {
	if (menu == 'back') {
		rotateShirt('back');
	}
	$('.shirt-parts').hide();
	$('#' + elemId).show();
	$(window).resize();
	return true;
}

function addAllFabrics() {
	var baseFabricChoosed = getFabric(shirtObj.base_fabric);
	var htmlReturnBase = "<div class='each eachfabric return_base_fabric' fabric_name='" + baseFabricChoosed.name + "' title='" + baseFabricChoosed.title + "' type='" + baseFabricChoosed.type + "' iron='" + baseFabricChoosed.iron + "' style='background: url(/_media/fabrics/medium/" + shirtObj.base_fabric + ".jpg);'></div>";
	$(htmlReturnBase).clone().appendTo('.shortcut-content-inner-collar .all-fabric-selector').addClass('return_inner_collar_fabric');
	$(htmlReturnBase).clone().appendTo('.shortcut-content-inner-cuffs .all-fabric-selector').addClass('return_inner_cuff_fabric');
	$(htmlReturnBase).clone().appendTo('.shortcut-content-base-buttons .all-fabric-selector').addClass('return_inner_button_fabric');
	$(htmlReturnBase).clone().appendTo('#pocket-fabric-panel .all-fabric-selector').addClass('return_pocket_fabric');
	
	var listMenuItem = ['base', 'inner-collar-fabric', 'cuffs-fabric', 'inner-cuffs-fabric', 'inner-buttons-fabric', 'pocket-fabric'];
	$(listMenuItem).each(function(i, menu) {
		if (fabrics.length > 10) {
			for(var j = 0; j < fabrics.length ; j++) {
				if (checkUseFor(fabrics[j].name, menu)) {
					if (menu == 'base') {
						$('.shortcut-content-base .all-fabric-selector').append(renderThumbImage(fabrics[j], 'base'));
					} else if (menu == 'collar-fabric') {
						$('.shortcut-content-collar .all-fabric-selector').append(renderThumbImage(fabrics[j], 'collar-fabric'));
					} else if (menu == 'inner-collar-fabric') {
						$('.shortcut-content-inner-collar .all-fabric-selector').append(renderThumbImage(fabrics[j], 'inner-collar-fabric'));
					} else if (menu == 'cuffs-fabric') {
						$('.shortcut-content-cuffs .all-fabric-selector').append(renderThumbImage(fabrics[j], 'cuffs-fabric'));
					} else if (menu == 'inner-cuffs-fabric') {
						$('.shortcut-content-inner-cuffs .all-fabric-selector').append(renderThumbImage(fabrics[j], 'inner-cuffs-fabric'));
					} else if (menu == 'inner-buttons-fabric') {
						$('.shortcut-content-base-buttons .all-fabric-selector').append(renderThumbImage(fabrics[j], 'inner-buttons-fabric'));
					} else if (menu == 'pocket-fabric') {
						$('#pocket-fabric-panel .all-fabric-selector').append(renderThumbImage(fabrics[j], 'pocket-fabric'));
					}
				}
			}
		}
	});
	
	$('.all-fabric-selector .eachfabric').bind(clickEvent, function(e, direct) {
		var self = $(this);
		var clickFabricF = function() {
			closeFullFabricDialog();
			if (shirtObj.position == 'back') {
				shirtObj.position = 'front';
			}
			var fabricName = self.attr('fabric_name');
			var menuItem = menuItems[currentMenuItemIndex];
			var isReturnBaseFabric = self.hasClass('return_base_fabric') || self.attr('fabric_name') == clericFabric;
			
			fabricDialog(fabricName, menuItem, isReturnBaseFabric);
		};
		var canChangeFabric = false;
		if (navigator.userAgent.match(/(Android|webOS|iPhone|iPad|iPod|BlackBerry)/i)) {
			if (!isOpenFullFabricDialog($(this).attr('fabric_name')) && direct != 'off') {
				openFullFabricDialog($(this).attr('fabric_name'));
				$('.full-fabric-dialog').click(function(e) {
					clickFabricF();
				});
			} else {
				canChangeFabric = true;
			}
		} else {
			canChangeFabric = true;
		}
		if (canChangeFabric) {
			clickFabricF();
		}
	});
}

function selectedFabricByFabricName(fabricName) {	
	var self = null;
	if (menu == 'base') {
		changeBaseFabric(shirtObj, fabricName);
		setReturnFabrics();
		self = $('#base-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'collar-fabric') {
		changeCollarFabric(shirtObj, fabricName);
		self = $('#collar-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'inner-collar-fabric') {
		changeInnerCollarFabric(shirtObj, fabricName);
		setReturnFabrics();
		self = $('#inner-collar-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'cuffs-fabric') {
		changeCuffsFabric(shirtObj, fabricName);
		self = $('#cuffs-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'inner-cuffs-fabric') {
		changeInnerCuffsFabric(shirtObj, fabricName);
		setReturnFabrics();
		self = $('#inner-cuffs-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'buttons-fabric') {
		changeButtonsFabric(shirtObj, fabricName);
		self = $('#inner-buttons-fabric .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	} else if (menu == 'pocket-fabric') {
		changePocketFabric(shirtObj, fabricName);
		self = $('#pocket-fabric-panel .all-fabric-selector .eachfabric[fabric_name=' + fabricName + ']');
	}
	
	if (self != null) {
		self.closest('.all-fabric-selector').find('img').remove();
		self.append("<img src='/_ui/images/app/tick.png' class='image-tick-fabrics'/>");
	}
	
	osCloseDialog3();
}

function setReturnFabrics() {
	var baseFabricObj = getFabric(shirtObj.base_fabric);
	var clericFabricObj = getFabric(clericFabric);
	$('.return_base_fabric').attr('fabric_name2', baseFabricObj.name2);
	$('.return_base_fabric').attr('fabric_name', baseFabricObj.name);
	$('.return_base_fabric').attr('title', baseFabricObj.title);
	$('.return_base_fabric').css('background', 'url(/_media/fabrics/medium/' + $.trim(baseFabricObj.name) + '.jpg)');
	if (shirtObj.cleric == 'collar') {
		$('.return_inner_collar_fabric').attr('fabric_name2', clericFabricObj.name2);
		$('.return_inner_collar_fabric').attr('fabric_name', clericFabricObj.name);
		$('.return_inner_collar_fabric').attr('title', clericFabricObj.title);
		$('.return_inner_collar_fabric').css('background', 'url(/_media/fabrics/medium/' + $.trim(clericFabricObj.name) + '.jpg)');
	} else if (shirtObj.cleric == 'collar_cuffs') {
		$('.return_inner_collar_fabric').attr('fabric_name2', clericFabricObj.name2);
		$('.return_inner_collar_fabric').attr('fabric_name', clericFabricObj.name);
		$('.return_inner_collar_fabric').attr('title', clericFabricObj.title);
		$('.return_inner_collar_fabric').css('background', 'url(/_media/fabrics/medium/' + $.trim(clericFabricObj.name) + '.jpg)');
		$('.return_inner_cuff_fabric').attr('fabric_name2', clericFabricObj.name2);
		$('.return_inner_cuff_fabric').attr('fabric_name', clericFabricObj.name);
		$('.return_inner_cuff_fabric').css('background', 'url(/_media/fabrics/medium/' + $.trim(clericFabricObj.name) + '.jpg)');
		$('.return_inner_cuff_fabric').attr('title', clericFabricObj.title);
	}
	
	$('.return_pocket_fabric').attr('fabric_name2', baseFabricObj.name2);
	$('.return_pocket_fabric').attr('fabric_name', baseFabricObj.name);
	$('.return_pocket_fabric').attr('title', baseFabricObj.title);
	$('.return_pocket_fabric').css('background', 'url(/_media/fabrics/medium/' + $.trim(baseFabricObj.name) + '.jpg)');
	
	var clericFabricsForCollarFabrics = $('#all-inner-collar-fabrics .eachfabric[fabric_name=' + clericFabric + ']');
	if (clericFabricsForCollarFabrics.length == 2) {
		$('#all-inner-collar-fabrics .return_base_fabric').hide();
	} else {
		$('#all-inner-collar-fabrics .return_base_fabric').show();
	}
	var clericFabricsForCuffFabrics = $('#all-inner-cuffs-fabrics .eachfabric[fabric_name=' + clericFabric + ']');
	if (clericFabricsForCuffFabrics.length == 2) {
		$('#all-inner-cuffs-fabrics .return_base_fabric').hide();
	} else {
		$('#all-inner-cuffs-fabrics .return_base_fabric').show();
	}
}

function checkUseFor(fabricName, holder) {
	var fabricObj = getFabric(fabricName);
	if ( holder == 'base' ) {
		if (fabricObj.use_base == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'collar-fabric' ) {
		if (fabricObj.use_outer_collar == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'inner-collar-fabric' ) {
		if (fabricObj.use_inner_collar == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'cuffs-fabric' ) {
		if (fabricObj.use_outer_cuffs == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'inner-cuffs-fabric' ) {
		if (fabricObj.use_inner_cuffs == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'inner-buttons-fabric' ) {
		if (fabricObj.use_inner_button == 0) {
			return false;
		}
		return true;
	} else if ( holder == 'pocket-fabric' ) {
		if (fabricObj.use_pocket == 0) {
			return false;
		}
		return true;
	}
}

function checkOutOfStock(name) {
	for (x in fabrics) {
		if(fabrics[x]['name'] == name){
			return true;
		}	
	}
	return false;
}

function renderThumbImage(fabric, atStep) {
	var title = fabric.title + ' ';
	
	if (atStep == 'base') {
		title += formatUSD(fabric.price); 
	} else if (atStep =='inner-collar-fabric') {
		title += formatUSD(innerCollarPrice); 
	} else if (atStep =='inner-cuffs-fabric') {
		title += formatUSD(innerCuffsPrice); 
	} else if (atStep =='inner-buttons-fabric') {
		title += formatUSD(innerButtonPrice); 
	} else if (atStep =='pocket-fabric') {
		title += formatUSD(contrastPocketPrice); 
	} else {
		title += formatUSD(fabric.price);
	}
	
	if (fabric.thread_count != "") {
		title += '<br/>' + fabric.thread_count + ' ' + threadContText;
	}
	
	var html =  '<div class="each eachfabric" fabric_name="' + fabric.name + '" title="' + title + '" label2="' + fabric.label2 + '" search="' + fabric.search + '" thread_count="' + fabric.thread_count  + '" price="' + fabric.price  + '" type="' + fabric.type + '" iron="' + fabric.iron + '" group="' + fabric.group + '" style="background: url(' + fabric.desktop_sprite_image + ') no-repeat; background-position: left -' + fabric.thumb_top + 'px;"></div>';
	return html;
}

function openPublishDialog() {
	$.prettyLoader.show();
	$.ajax({
		url: '/_ajax/design/publish?action=info',
		type: 'post',
		data: { shirt: shirtObj},
		dataType: 'html',
		success: function(response) {
			$.prettyLoader.hide();
			$.fancybox(response, { autoDimensions: false, autoScale: false, width: 900, height: 520, scrolling: 'no', overflow: 'hidden', margin: '100px 0px 0px' });
			loading = false;
		}
	});
}

function sendDesignDialog() {
	trackMixpanel('Send Design Opened');
	osLoad({
		type: 'post',
		url: '/_ajax/design-dress-shirt/send-design-dialog',
		details: shirtObj
	});
}

function requestDesignDialog() {
	trackMixpanel('Request Design Opened');
	osLoad({
		type: 'post',
		url: '/_ajax/design-dress-shirt/request-design-dialog'
	});
}

function fabricDialog(fabricName, atStep, isReturnBaseFabric) {
	var url = renderShirtObjToUrl(shirtObj);
	osLoad3({url : '/fabric-dialog?fabricName=' + fabricName  + '&atStep=' + atStep + '&isReturnBaseFabric=' + isReturnBaseFabric + '&' + url, update_url : false, autoCloseOverlay : false});
}

function collarDialog(collar) {
	osLoad3({url : '/collar-dialog?collar=' + collar, update_url : false, autoCloseOverlay : false});
}

function cuffDialog(cuff) {
	osLoad3({url : '/cuff-dialog?cuff=' + cuff, update_url : false, autoCloseOverlay : false});
}

function searchPriceInit() {
	$('.price-area .price-value').change(function() {
		if ($(this).attr('checked')) {
			$('.price-area #price-all').removeAttr('checked');
		} else {
			var flag = 0;
			$('.price-area .price-value').each(function() {
				if(!$(this).attr('checked')) {
					flag++;
				}
			});

			if (flag == $('.price-area .price-value').size()) {
				$('.price-area #price-all').attr('checked', true);
			}
		}
	});
	
	$('.price-area #price-all').change(function() {
		if ($(this).attr('checked')) {
			$('.price-area .price-value').removeAttr('checked');
		} else {
			var flag = false;
			$('.price-area .price-value').each(function() {
				if($(this).attr('checked') == true) {
					flag = true;
				}
			});

			if (flag == false) {
				$('.price-area #price-all').attr('checked', true);
			}
		}
	});
}

function removeShirtPropertiesContrastParttent() {
	if (getContrastPattern() == 'no') {
		if (shirtObj.cleric == 'collar_cuffs') {
			shirtObj.inner_collar_fabric = shirtObj.collar_fabric;
			shirtObj.inner_cuffs_fabric = shirtObj.cuffs_fabric;
		} else if (shirtObj.cleric == 'collar') {
			shirtObj.inner_cuffs_fabric = shirtObj.base_fabric;
			shirtObj.inner_collar_fabric = shirtObj.collar_fabric;
		} else {
			shirtObj.inner_cuffs_fabric = shirtObj.base_fabric;
			shirtObj.inner_collar_fabric = shirtObj.base_fabric;
		}
		
		shirtObj.inner_buttons_fabric = shirtObj.base_fabric;
		
		if (shirtObj.pocket_left == 1 || shirtObj.pocket_right == 1) {
			shirtObj.pocket_fabric = shirtObj.base_fabric;
		} else {
			shirtObj.pocket_fabric = '';
		}
	}
}