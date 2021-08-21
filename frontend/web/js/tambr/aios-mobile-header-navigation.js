( function($) {

	$.prototype.aiosMobileHeaderNavigation = function(settings) {
		
		var defaults = {
			trigger:'.aios-mobile-pack-navigation-trigger',
			attachment:'.aios-mobile-pack-header-buttons',
			position:'bottom'
		}
		
		settings = $.extend(defaults,settings);
		
		this.each( function(i,v) {
			
			Navigation($(v),settings);
			
		});
		
	}
	
	function Navigation(object,settings) {
		
		var nav = object;
		var trigger = $(settings.trigger);
		var attachment = $(settings.attachment);
		var overlay = $("<div class='aiosMobileHeaderOverlay'></div>");
		
		function _construct() {
			
			prepareComponents();
			initEvents();
			
		}
		
		function prepareComponents() {
			
			/* Prepare overlay */
			
			overlay.css({
				'left':0,
				'top':0,
				'width':'100%',
				'height':'100%',
				'position':'fixed',
				'z-index':'999',
				'background':'#000',
				'display':'none',
				'opacity':0.5
			});
			
			/* Prepare nav */
			switch (settings.position) {
				
				case 'left':
					
					nav.css({
						'left':'-100%',
						'display':'block',
						'z-index':'1000',
						'top':0,
						'height':'100%',
						'position':'fixed',
						'width':240
					});
					
					nav.addClass("aios-mobile-pack-navigation-left");					
					nav.after(overlay);
					
					break;
				
				case 'right':
				
					nav.css({
						'right':'-240px',
						'display':'block',
						'z-index':'1000',
						'top':0,
						'height':'100%',
						'position':'fixed',
						'width':240
					});
					
					nav.addClass("aios-mobile-pack-navigation-right");
					nav.after(overlay);
					
					break;
					
				default:
				
					nav.addClass("aios-mobile-pack-navigation-bottom");
					
					break;
					
			}
			
		}
		
		function initEvents() {
			
			initTriggerEvent();
			initAnchorEvent();
			initTabEvent();
			
			if ( isTouchDevice() ) {
				overlay[0].addEventListener("touchstart", function(){ animateNav('close'); }, false);
			}
			else {
				overlay[0].addEventListener("click", function(){ animateNav('close'); }, false);
			}
			
			if ( settings.position == 'bottom' ) {	
				$(window).on("load",resizeNav);
				$(window).on("resize",resizeNav);
				window.addEventListener("orientationchange", resizeNav);
			}
			
		}
		
		function isTouchDevice() {
			return 'ontouchstart' in window || navigator.msMaxTouchPoints;
		}
		
		function initTabEvent() {
			
			nav.find("li").click( function(e) {
				var li = $(e.currentTarget);
				
				li.siblings().removeClass("open");
				li.siblings().find("li").removeClass("open");
				li.siblings().find(".sub-menu").hide();
				
				if ( !li.hasClass("open") ) {
					li.toggleClass("open");
					li.children(".sub-menu").show();
				}
			});
			
		}
		
		function initAnchorEvent() {
			
			nav.find("a").click( function(e) {
				e.preventDefault();
				
				var a = $(e.currentTarget);
				var parent = a.parent();
				var subCount = parent.find(".sub-menu").length;
				
				if ( parent.hasClass("open") || !subCount ) {
					var url = a.attr("href");
					var target = typeof a.attr("target") == 'undefined' ? '_self' : a.attr("target") ;
					window.open(url,target);
				}
				
				if ( settings.position == 'bottom' ) {
					setTimeout(resizeNav,500);
				}
				
			});
			
		}
		
		function initTriggerEvent() {
			
			trigger.click(animateNav);
			
		}
		
		function animateNav(status) {
			
			switch (settings.position) {
				
				case 'left':
					if ( nav.hasClass('aios-mobile-pack-navigation-visible') || status == 'close' ){
						//Hide nav
						nav.stop(true).animate({left:'-100%'},750);
						overlay.stop(true).animate({opacity:0},750,'swing',function() {
							overlay.css({display:'none'});
						});
						
						//Remove classes
						nav.removeClass('aios-mobile-pack-navigation-visible');
						trigger.removeClass('aios-mobile-pack-navigation-trigger-active');
					}
					else {
						//Show nav
						nav.stop(true).animate({left:0},750);
						overlay.css({display:'block'});
						overlay.stop(true).animate({opacity:0.5},750);
						
						//Add classes
						nav.addClass('aios-mobile-pack-navigation-visible');
						trigger.addClass('aios-mobile-pack-navigation-trigger-active');
					}
					break;
					
				case 'right':
					if ( nav.hasClass('aios-mobile-pack-navigation-visible' ) || status == 'close' ) {
						//Hide nav
						nav.stop(true).animate({right:'-240px'},750);
						overlay.stop(true).animate({opacity:0},750,'swing',function() {
							overlay.css({display:'none'});
						});
						
						//Remove classes
						nav.removeClass('aios-mobile-pack-navigation-visible');
						trigger.removeClass('aios-mobile-pack-navigation-trigger-active');
					}
					else {
						//Show nav
						nav.stop(true).animate({right:0},750);
						overlay.css({display:'block'});
						overlay.stop(true).animate({opacity:0.5},750);
						
						//Add classes
						nav.addClass('aios-mobile-pack-navigation-visible');
						trigger.addClass('aios-mobile-pack-navigation-trigger-active');
					}
					break;
					
				default: 
					
					//Show or hide nav
					nav.slideToggle(400,function() {
						resizeNav();
					});
					
					//Add or remove classes
					nav.toggleClass('aios-mobile-pack-navigation-visible');
					trigger.toggleClass('aios-mobile-pack-navigation-trigger-active');
					
					break;
				
			}
			
			
		}
		
		function resizeNav() {
			
			var winHeight = window.innerHeight || $(window).height();
			var navHeight = winHeight - attachment.height();
			var css;
		
			nav.css({height:'auto',paddingBottom:0});
			var originalNavHeight = nav.height() + $('.amh-header-buttons').height() ;
			


			if ( originalNavHeight < navHeight ) {
				
				css = {
					height:'auto',
					paddingBottom:0
				};
				
				nav.css(css);
				
			}
			else {
				
				css = {
					height:navHeight
				};
				
				if ( settings.position == 'bottom' ) {
					css.paddingBottom = 100;
				}
				
				nav.css(css);
			}
			
		}
		
		_construct();
		
	}
	
})(jQuery);