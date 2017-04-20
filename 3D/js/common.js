var sourceUnlockCode = '';
var startExecute;
var sessionId;
var rewardNotificationLoading = false;

(function(window, undefined) {
	if (History.Adapter != undefined) {
		History.Adapter.bind(window,'statechange', function() {
	        var stateObj = History.getState();
	        if (stateObj && stateObj.data.state != 'dialog' && $('.os-dialog').is(':visible')) {
	        	$('.os-dialog').remove();
	    		$('.os-overlay').remove();
	        }
		});
	}

})(window);

$(function() {
	autoHint();
	bindFavoriteLikeEvent();
	updateRewardsMeter();
});

function autoHint() {
}

function getURLParameter(sParam){
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++){
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) {
			return sParameterName[1];
		}
	}
	return '';
}

function checkURLParameter(sParam){
	var sPageURL = document.URL;
	var n = sPageURL.match(sParam);
	if(n == sParam) {
		return true;
	}
	return false;
}

function bindFavoriteLikeEvent() {
	$('.favorite-like').on('click', function(e) {
		if (!identifier) {
			osSignUpAndRedirect(location.href);
			return false;
		}
		$.prettyLoader.show();
		var element = $(this);
		var liked = element.attr('liked');
		var sampleId = element.attr('sample-id');
		var like = 0;
		if (liked == 0) {
			like = 1;
		}
		$.ajax({
			url: '/_ajax/like-sample',
			type: 'POST',
			data: {sampleId : sampleId, like: like },
			dataType: 'json',
			success: function(response) {
				$.prettyLoader.hide();
				if (response.result == 'success') {
					if (like == 1) {
						element.attr('liked', '1');
						element.removeClass('off').addClass('on');
					} else {
						element.attr('liked', '0');
						element.removeClass('on').addClass('off');
					}
				} else {
					alert(response.message);
				}
			}
		});
	});
}

function addSampleToCart(sampleId) {
	if (!identifier) {
		osSignUpAndRedirect(location.href);
		return false;
	}
	$.prettyLoader.show();
	$.ajax({
    	url: '/_ajax/sizing/has-sizing',
        type: 'post',
        dataType: 'json',
        success: function(response) {
        	$.prettyLoader.hide();
        	if (response.result == 'success') {
        		addSampleToCartWithoutSizing(sampleId , ''); // umt-source = ''
        	} else {
        		osLoad({ url : '/sizing', update_url : false, source : 'popular', sample_id : sampleId });
        	}
        }
	});
}

function addSampleToCartWithoutSizing(sampleId, utmSource) {
	$.prettyLoader.show();
	$.ajax({
    	url: '/_ajax/cart-add',
        type: 'post',
        dataType: 'json',
        data: { sample_id : sampleId },
        success: function(response) {
        	mixpanel.identify(mixpanel.get_distinct_id());
			mixpanel.people.set(response.xprofile, function() {
				$.prettyLoader.hide();
				var goTopage = '/cart';
				
				if (utmSource != '') {
					 goTopage = '/cart?utm_source=' + utmSource;
				} 
				
				location = goTopage;
			});
        }
	});
}

function updateCartNumber() {
	$.ajax({
    	url: '/_ajax/common/cart-number',
        type: 'post',
        dataType: 'json',
        success: function(response) {
			if (response.result == 'success') {
				$('.cart-item .number').html(response.number);
			}
        }
	});
}

function exchangeDollars(dollars, currency, omitZero, fdollars) {
	$.ajax({
    	url: '/_ajax/common/exchange-dollars',
        type: 'get',
        data: { dollars : dollars, currency : currency, omitZero : omitZero },
        dataType: 'json',
        success: function(response) {
			if (response.result == 'success') {
				fdollars(response.convertedDollars);
			}
        }
	});
}

function fancyAlert(msg) {
	jQuery.fancybox({
		'modal' : true,
			'content' : "<div style=\"margin:1px;font-size:13px;\"><div style=\"min-height: 80px; height: auto !important; height: 80px;width: 560px;min-width:560px;width: auto ! important; vertical-align:middle;top:50%;\">"+msg+"</div><div class=\"line\" style=\"text-align:right;margin-top:10px;\"><input style=\"margin:0px;padding:2px;width:70px;cursor:pointer;\" type=\"button\" onclick=\"jQuery.fancybox.close();\" value=\"OK\"></div></div>",
		'transitionIn'      : 'none',
	    'transitionOut'     : 'none',
	    autoDimensions:true,
		'onComplete' : function(){
	        $.fancybox.resize();
	    }
	});
}

function showFabricDialog(contentHtml,description,perspective,width,height) {
	if(description.length > 0) {
		if(perspective == 1) {
			var contentHtml = "<div id='fabric-dialog-image'><div id='fabric-arrow-left' class='fabric-arrow-left'></div><div id='fabric-arrow-right' class='fabric-arrow-right'></div><div class='description-fabric' style='left:0px'><div class='titleDes'>" + description + "</div> </div> <div class='content'>"  + contentHtml +"</div> </div>";
			
			$.fancybox(contentHtml, { autoDimensions : false, autoScale: false, scrolling: 'no', width: width, height: height, margin: '100px 0 0',overflow:'hidden', hideOnOverlayClick: true });	
			
			$('#fabric-arrow-left').click(function(e){
				var element = $('#fabric-dialog-image');
				element.stop().animate({marginLeft:'0px'},'slow');
				$('#fabric-arrow-right').show();
				$(this).hide();
			});
			
			$('#fabric-arrow-right').click(function(e){
				var element = $('#fabric-dialog-image');
				element.animate({marginLeft:'-700px'},'slow');
				$('#fabric-arrow-left').show();
				$(this).hide();
			});
		} else {
			var contentHtml = "<div><div class='description-fabric'><div class='titleDes'>" + description + "</div> </div>"  + contentHtml +" </div>";
			$.fancybox(contentHtml, { autoDimensions : false, autoScale: false, scrolling: 'no', width: width, height: height, margin: '100px 0 0',overflow:'hidden', hideOnOverlayClick: true });	
		}
			
	} else {
		if(perspective == 1) {
			var contentHtml = "<div id='fabric-dialog-image'><div id='fabric-arrow-left' class='fabric-arrow-left'></div><div id='fabric-arrow-right' class='fabric-arrow-right'></div> <div class='content'>"  + contentHtml +"</div> </div>";
			
			$.fancybox(contentHtml, { autoDimensions : false, autoScale: false, scrolling: 'no', width: width, height: height, margin : '100px 0 0',overflow:'hidden', hideOnOverlayClick: true});
			
			$('#fabric-arrow-left').click(function(e){
				var element = $('#fabric-dialog-image');
				element.stop().animate({marginLeft:'0px'},'slow');
				$('#fabric-arrow-right').show();
				$(this).hide();
			});
			
			$('#fabric-arrow-right').click(function(e){
				var element = $('#fabric-dialog-image');
				element.animate({marginLeft:'-700px'},'slow');
				$('#fabric-arrow-left').show();
				$(this).hide();
			});
		} else {
			$.fancybox(contentHtml, { autoDimensions : false, autoScale: false, scrolling: 'no', width: width, height: height, margin : '100px 0 0', hideOnOverlayClick: true});
		}
	}
	
}

function pushMixEvent(event) {
	if (typeof(env) != 'undefined') {
		mixpanel.track(event);
	}
}

function pushMixEvent2(event, props) {
	if (typeof(env) != 'undefined') {
		mixpanel.track(event, props);
	}
}

// From now on, use this function please so that we can disble mixpanel later.
function trackMixpanel(event, props, fx) {
	if (typeof(props) == 'undefined') {
		props = {};
	}
	if (typeof(fx) == 'undefined') {
		fx = function() {};
	}
	if (mixpanel) {
		mixpanel.track(event, props, fx);
	}
}

function pushtrackingEvent(category ,action ,label) {
	if(typeof(env) != 'undefined' && env == 'production') {
		//_gaq.push(['_trackEvent', category, action, label]);
	}
}

function formatPrice(price) {
	var price = parseFloat(price);
	var strPrice = price + '';
	var pos = strPrice.indexOf('.');
	var result = '';
	if(pos > -1) {
		if(strPrice.substr(pos).length < 3) {
			result = '$' + price + '0';
		} else {
			result = '$' + Math.round(price * 100) / 100;
		}
	} else {
		result = '$' + price;
	}
	return result;
	
}

function loginFacebook(nextPage) {
	FB.login(function(response) {
		if (response.authResponse) {
			if (nextPage) {
				location = '/facebook-login?redirect_uri=' + nextPage;
			} else {
				location = '/facebook-login';
			}
		} else {
			cancelLoginFacebook();
		}
	}, {scope: 'email,user_birthday,publish_actions'});
}

function showOutOfStockDialog(sampleId) {
	$.prettyLoader.show();
	$.ajax({
		url: '/_ajax/get_out_of_stock_fabric_dialog_data',
		type: 'post',
		data: { sampleId: sampleId},
		dataType: 'json',
		success: function(response) {
			if(response.result == 'success'){
				$.prettyLoader.hide();
				$.fancybox({
			        'width': 650,
			        'height': 320,
			        'autoScale': false,
			        'scrolling': 'no',
			        'content' : response.html,
			        'autoDimensions' : false,
			        'showCloseButton' : true,
			        'padding' : 10,
			        'margin' : 0
			    });
			}
		}
	});
	
	
}

function checkSampleOutOfStock(sampleId, instockFunction, outStockFunction) {
	$.prettyLoader.show();
	$.ajax({
		url: '/_ajax/check_out_of_stock_fabric',
		type: 'post',
		data: { sampleId: sampleId},
		dataType: 'json',
		success: function(response) {
			$.prettyLoader.hide();
			if(response.result == 'success'){
				instockFunction(response);
			} else {
				outStockFunction(response);
			}
		}
	});
}

function checkCartOutOfStock(name,instockFunction, outStockFunction) {
	$.prettyLoader.show();
	$.ajax({
		url: '/_ajax/check_cart_out_of_stock_fabric',
		type: 'post',
		data: { name: name},
		dataType: 'json',
		success: function(response) {
			$.prettyLoader.hide();
			if(response.result == 'success'){
				instockFunction(response);
			} else {
				outStockFunction(response);
			}
		}
	});
}

function centerElement( element) {
	var top = Math.max(0, ($(window).height() -  element.outerHeight()) / 2 + $(document).scrollTop());
	var left = ($(window).width() -  element.outerWidth()) / 2 + $(document).scrollLeft();
	element.css({
		left: left,
		top: top
	});
	element.show();
}

function topElement(element) {
	var left = ($(window).width() -  element.outerWidth()) / 2;
	element.hide();
	setTimeout(function(){
		element.css({
			left: left,
			top: -((element.outerHeight()) - 0)
		});	
		element.show();
		element.animate({top: "+=" + (element.outerHeight() + $(document).scrollTop()) + "px"}, 400,'linear',function(){});
	}, 100);	
}

function topElementNoCroll(element) {
	var left = ($(window).width() -  element.outerWidth()) / 2;
	element.hide();
	setTimeout(function(){
		
		element.css({
			left: left,
			top: -((element.outerHeight()) - 0)
		});	
		 $('html, body').animate({scrollTop: 0 }, 0);
		element.show();
		element.animate({top: "+=" + element.outerHeight() + "px"}, 400,'linear',function(){});
	}, 100);	
}

function topToCenterElement(element) {
	element.hide();
	setTimeout(function(){
		var left = ($(window).width() -  element.outerWidth()) / 2;
		var top = ($(window).height() - element.outerHeight()) / 2;
		element.css({
			left: left,
			top: -(element.outerHeight())
		});	
		element.show();
		element.animate({top: "+=" + (element.outerHeight() + top + $(document).scrollTop()) + "px"}, 400,'linear',function(){});
	}, 100);	
}

function centerScreenElement(element) {
	element.css("top", ( $(window).height() - element.outerHeight()) / 2 + $(document).scrollTop() + 60 + "px");
	element.css("left", ( $(window).width() - element.outerWidth() ) / 2 + "px");
	element.show();
}

function centerScreenElementFixed(element) {
	element.css("top", ( $(window).height() - element.outerHeight()) / 2 + "px");
	element.css("left", ( $(window).width() - element.outerWidth() ) / 2 + "px");
	element.show();
}

function enableScrollTop() {
	$('body').append('<div class="os-scroll-top"></div>');
	$('.os-scroll-top').click(function(e) {
		e.preventDefault();
		$('html,body').animate({scrollTop: 0}, 500);
	});
	$(window).scroll(function() {
		if ($(document).scrollTop() == 0) {
	    	$('.os-scroll-top').hide('slow');
	    } else {
	    	$('.os-scroll-top').show('slow');
	    }
	});
}

function getUtmSource() {
	if (mixpanel && mixpanel.cookie != 'undefined' && mixpanel.cookie.props.utm_source != 'undefined') {
		return mixpanel.cookie.props.utm_source;
	}
	return '';
}

$(function() {
	$('.davis').on('click', function() {
		osLoad({ url: this.href });
        return false;
    });
	$('.require-login').on('click', function() {
		osSignUpAndRedirect(this.href);
        return false;
    });
});

function osSignUpAndRedirect(redirectUrl) {
	var url = '/sign-up';
	if (identifier && userRegistered == '1') {
		location.href = redirectUrl;
	} else {
		if (redirectUrl) {
			location = url + '?tag=casual&redirect_uri=' + redirectUrl;
		} else {
			location = url + '?tag=casual';
		}
	}
}

function osSignUpAndRedirect2(redirectUrl) {
	var url = '/sign-up';
	if (identifier && userRegistered == '1') {
		location.href = redirectUrl;
	} else {
		if (redirectUrl) {
			location = url + '?tag=casual&redirect_uri=' + redirectUrl;
		} else {
			location = url + '?tag=casual';
		}
	}
}

function osLoginAndRedirect(redirectUrl) {
	if (identifier && userRegistered == '1') {
		location.href = redirectUrl;
	} else {
		if (redirectUrl) {
			osLoad({ url: '/login?redirect_uri=' +  redirectUrl });
		} else {
			osLoad({ url: '/login' });
		}
	}
}

function osLogin(redirectUrl) {
	if (redirectUrl) {
		osLoad({ url: '/login?redirect_uri=' +  redirectUrl });
	} else {
		osLoad({ url: '/login' });
	}
}

function osSignUp(redirectUrl) {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			signupFacebook();
		} else if (response.status === 'not_authorized') {
			signupFacebook();
		} else {
			osLoad2({ url: '/sign-up-2', onClose: function() {
				escapeSignupDialog('/intent');
			}});
		}
	});
}


function osLoad(params) {
	params = $.extend({ update_url : true }, params);
	$.prettyLoader.show();
    $.ajax({
    	url: params.url,
    	cache: false,
    	data: params,
    	type: params.type ? params.type : 'get'
    }).done(function(html) {
    	if (html.indexOf('davis-dialog') != -1) {
    		osDialog(html);
    		if (params.update_url) {
    			//history.pushState(null, null, params.url);
    		}
    	}
    	$.prettyLoader.hide();
    });
}

function osDialog(s) {
	$('.os-dialog').remove();
	$('.os-overlay').remove();
	$('#container').x_overlay({ trigger: true, overlayColor: '#000', opacity: 0.6, className: 'os-overlay' });
	$('#container').append(s);
	var html = $('#container .davis-dialog:last');
	html.addClass('os-dialog');
	html.css('margin', 0);
	html.append('<div class="close"></div>');
	var thisOverlay = $('.os-overlay:last');
	var go = html.attr('go');
	html.find('.close').click(function(e) {
		html.remove();
		thisOverlay.remove();
		if (go != 'hide') {
			//history.go(-1);
		}
	});
	thisOverlay.click(function(e) {
		html.remove();
		$(this).remove();
		if (go != 'hide') {
			//history.go(-1);
		}
	});
	centerElement(html);
}

//params: url, type, update_url, onClose(dialog, overlay, params)
function osLoad2(params) {
	var defaultOptions = {
		url : '',
		type : 'get',
		update_url : true,
		onClose: null
	};
	params = $.extend(defaultOptions, params);
	var params2 = $.extend({}, params);
	params2.onClose = null;
	$.prettyLoader.show();
    $.ajax({
    	url: params.url,
    	cache: false,
    	data: params2,
    	type: params.type
    }).done(function(html) {
    	if (html.indexOf('davis-dialog') != -1) {
    		params.content = html;
    		osDialog2(params);
    		if (params.update_url) {
    			//history.pushState(null, null, params.url);
    		}
    	}
    	$.prettyLoader.hide();
    });
}

// params: content, update_url, onClose(dialog, overlay, params)
function osDialog2(params) {
	var defaultOptions = {
		update_url : true,
		onClose: null,
		effect : false
	};
	params = $.extend(defaultOptions, params);
	$('.os-dialog').remove();
	$('.os-overlay').remove();
	$('#container').x_overlay({ trigger: true, overlayColor: '#000', opacity: 0.6, className: 'os-overlay' });
	$('#container').append(params.content);
	var html = $('#container .davis-dialog:last');
    html.addClass('os-dialog');
	html.css('margin', 0);
	html.append('<div class="close"></div>');
	var thisOverlay = $('.os-overlay:last');	
	html.find('.close').click(function(e) {
		if (params.effect== true) {
			$('#container .davis-dialog').hide( 'clip', {} , 500, function(){});
			thisOverlay.remove();
		} else {	
			if (params.onClose == null) {
				html.remove();
				thisOverlay.remove();
				if (params.update_url == true) {
					//history.go(-1);
				}
			} else {
				params.onClose(html, thisOverlay);
			}
		}
	});
	thisOverlay.click(function(e) {
		if (params.onClose == null) {
			html.remove();
			thisOverlay.remove();
			if (params.update_url == true) {
				//history.go(-1);
			}
		} else {
			params.onClose(html, thisOverlay, params);
		}
	});
	centerElement(html);
	
	if (params.effect == true) {
		$('#container .davis-dialog').hide();
		$('#container .davis-dialog').show( 'clip', {} , 500, function(){});
	}
}

function osLoad3(params) {
	params = $.extend({ update_url : true, position : 'top' }, params);
	$.prettyLoader.show();
    $.ajax({
    	url: params.url,
    	cache: false,
    	data: params,
    	type: params.type ? params.type : 'get'
    }).done(function(html) {
    	if (html.indexOf('davis-dialog') != -1) {
    		osDialog3(html, params);
    		if (params.update_url) {
    			//history.pushState(null, null, params.url);
    		}
    	}
    	$.prettyLoader.hide();
    });
}

function osDialog3(s, params) {
	$('.os-dialog').remove();
	$('.os-overlay').remove();
	$('#container').x_overlay({ trigger: true, overlayColor: '#000', opacity: 0.6, className: 'os-overlay' });
	$('#container').append(s);
	var html = $('#container .davis-dialog:last');
	html.addClass('os-dialog');
	html.append('<div class="close"></div>');
	html.css('margin', 0);
	var thisOverlay = $('.os-overlay:last');
	var go = html.attr('go');
	html.find('.close').click(function(e) {
		osCloseDialog3();
		if (go != 'hide') {
			// History.back();
		}
	});
	
	if (params.autoCloseOverlay) {
		thisOverlay.click(function(e) {
			html.remove();
			$(this).remove();
			if (go != 'hide') {
				// History.back();
			}
		});
	}

	if (params.position == 'top') {
		topElement(html);
	} else if (params.position = 'top-nocroll') {
		topElementNoCroll(html);
	} else {
		topToCenterElement(html);
	}
	History.pushState({state:'dialog'}, null, '?dialog=1');
}


//params: url, type, update_url, onClose(dialog, overlay, params)
function osLoadLevel2(params) {
	var defaultOptions = {
		url : '',
		type : 'get',
		update_url : true,
		onClose: null
	};
	params = $.extend(defaultOptions, params);
	var params2 = $.extend({}, params);
	params2.onClose = null;
	$.prettyLoader.show();
    $.ajax({
    	url: params.url,
    	cache: false,
    	data: params2,
    	type: params.type
    }).done(function(html) {
    	if (html.indexOf('davis-dialog') != -1) {
    		params.content = html;
    		osDialogLevel2(params);
    		if (params.update_url) {
    			//history.pushState(null, null, params.url);
    		}
    	}
    	$.prettyLoader.hide();
    });
}

//params: content, update_url, onClose(dialog, overlay, params)
function osDialogLevel2(params) {
	var defaultOptions = {
		update_url : true,
		onClose: null,
		effect : false
	};
	params = $.extend(defaultOptions, params);
	$('#container').x_overlay({ trigger: true, overlayColor: '#000', opacity: 0.6, className: 'os-overlay' });
	$('#container').append(params.content);
	var html = $('#container .davis-dialog:last');
    html.addClass('os-dialog');
	html.css('margin', 0);
	html.append('<div class="close"></div>');
	var thisOverlay = $('.os-overlay:last');	
	html.find('.close').click(function(e) {
		if (params.effect== true) {
			$('#container .davis-dialog').hide( 'clip', {} , 500, function(){});
			thisOverlay.remove();
		} else {	
			if (params.onClose == null) {
				html.remove();
				thisOverlay.remove();
				if (params.update_url == true) {
					//history.go(-1);
				}
			} else {
				params.onClose(html, thisOverlay);
			}
		}
	});
	thisOverlay.click(function(e) {
		if (params.onClose == null) {
			html.remove();
			thisOverlay.remove();
			if (params.update_url == true) {
				//history.go(-1);
			}
		} else {
			params.onClose(html, thisOverlay, params);
		}
	});
	centerElement(html);
	
	if (params.effect == true) {
		$('#container .davis-dialog').hide();
		$('#container .davis-dialog').show( 'clip', {} , 500, function(){});
	}
}

function osCloseDialog() {
	$('.os-dialog .close').trigger('click');
}

function osCloseDialog2() {
	$('.os-dialog').remove();
	$('.os-overlay').remove();
}

function osCloseDialog3() {
	$('#container .davis-dialog').animate({top: "-=" + $('#container .davis-dialog').outerHeight() + "px"}, 400, 'swing', function(){
		$('.os-dialog').remove();
		$('.os-overlay').remove();
		History.back();
	});
}

//params: content, width, height, onClose(dialog, overlay, params)
function osSimpleDialog(params) {
	var defaultOptions = {
		update_url : false,
		onClose: null,
		content: '',
		width: 450,
		height: 70
	};
	params = $.extend(defaultOptions, params);
	osDialog2({ content : '<div class="davis-dialog" style="background: #fff; border-radius: 5px; width: ' + params.width + 'px; min-height: ' + params.height + 'px;"><div style="padding: 20px; padding-top: 25px;">' + params.content + '</div></div>', update_url : params.update_url, onClose : params.onClose });
}

function mixpanelLink(event, link) {
	mixpanel.track(event, {}, function() {
		location = link;
	});
}

function autoSignUp(redirectUrl) {
	if (!redirectUrl) {
		redirectUrl = '/intent';
	}
	$.prettyLoader.show();
    $.ajax({
    	url: '/_ajax/auth/asignup?redirect_uri=' + redirectUrl,
    	type: 'post',
    	data: {
    		utm_source : getUtmSource()
    	},
    	dataType: 'json'
    }).done(function(response) {
    	if (response.result == 'success') {
    		mixpanel.track('Anon Mode Start', {}, function() {
    			if (typeof afterLoginOrSignupDone == 'function') { 
					afterLoginOrSignupDone('signup'); 
				} else {
					location = response.next_page;
				}
    		});
    	} else {
    		location = response.next_page;
    	}
    });
}

function updateSocialSharingBox() {
	$.ajax({
    	url: '/_ajax/common/social-sharing',
    	type: 'post',
    	dataType: 'json'
    }).done(function(response) {
    	if (response.result == 'success') {
    		$('.social-sharing-box .amount').html(response.count);
    		$('.social-sharing-box').show();
    	}
    });
}

function updateRewardsMeter() {
	$.ajax({
    	url: '/_ajax/common/rewards-meter',
    	type: 'post',
    	dataType: 'json'
    }).done(function(response) {
    	if (response.result == 'success') {
    		$('.reward-item').html(response.html).show();
    	}
    });
}

var signupCancelClickCount = 0;
function escapeSignupDialog(redirectUrl) {
	osCloseDialog2();
	/*
	if (signupCancelClickCount == 0) {
		osCloseDialog2();
	} else {
		if (!redirectUrl) {
			redirectUrl = '/intent';
		}
		$.prettyLoader.show();
	    $.ajax({
	    	url: '/_ajax/auth/asignup?redirect_uri=' + redirectUrl,
	    	type: 'post',
	    	data: {
	    		utm_source : getUtmSource()
	    	},
	    	dataType: 'json'
	    }).done(function(response) {
	    	if (response.result == 'success') {
	    		mixpanel.track('Anon Mode Start', {}, function() {
	    			guestGoing(redirectUrl);
	    		});
	    	} else {
	    		guestGoing(redirectUrl);
	    	}
	    });
	}
	signupCancelClickCount++;
	*/
}

function saveDesginLogToSample(shirtObj) {
	$.ajax({
		url: '/_ajax/sample/save-design-log',
	    type: 'POST',
	    data: {
	    	shirtObj : shirtObj
	    },
	    dataType: 'json'
	});
}

function openAjaxLoader(text) {
	closeAjaxLoader();
	$(".prettyLoader").hide();
	$('.ajax-loading').html(text);
	centerScreenElementFixed($('.ajax-loading'));
}

function openAjaxLoaderChangeText(text) {
	$(".prettyLoader").hide();
	$('.ajax-loading').html(text);
}

function closeAjaxLoader() {
	$('.ajax-loading').html('');
	$('.ajax-loading').hide();
	
}

function isIE(version, comparison) {
	var cc = 'IE',
	b = document.createElement('B'),
	docElem = document.documentElement,
	isIE;
	if(version){
	cc += ' ' + version;
	if(comparison){ cc = comparison + ' ' + cc; }
	}
	b.innerHTML = '<!--[if '+ cc +']><b id="iecctest"></b><![endif]-->';
	docElem.appendChild(b);
	isIE = !!document.getElementById('iecctest');
	docElem.removeChild(b);
	return isIE;
}

function renderShirtObjToUrl(shirtObj) {
	var url = '';
	url += 'sleeves=' + shirtObj.sleeves;
	url += '&collar=' + shirtObj.collar;
	url += '&cuffs=' + shirtObj.cuffs;
	url += '&pocket_left=' + shirtObj.pocket_left;
	url += '&pocket_right=' + shirtObj.pocket_right;
	url += '&pocket_fabric=' + shirtObj.pocket_fabric;
	url += '&pleat=' + shirtObj.pleat;
	url += '&buttons=' + shirtObj.buttons;
	url += '&monogram=' + shirtObj.monogram;
	url += '&monogram_text=' + shirtObj.monogram_text;
	url += '&monogram_location=' + shirtObj.monogram_location;
	url += '&monogram_color=' + shirtObj.monogram_color;
	url += '&base_fabric=' + shirtObj.base_fabric;
	url += '&inner_buttons_fabric=' + shirtObj.inner_buttons_fabric;
	url += '&collar_fabric=' +shirtObj.collar_fabric;
	url += '&inner_collar_fabric=' + shirtObj.inner_collar_fabric;
	url += '&cuffs_fabric=' + shirtObj.cuffs_fabric;
	url += '&inner_cuffs_fabric=' + shirtObj.inner_cuffs_fabric;
	url += '&cleric=' + shirtObj.cleric;
	url += '&resolution=' + shirtObj.resolution;
	url += '&position=' + shirtObj.position;
	return url;
}