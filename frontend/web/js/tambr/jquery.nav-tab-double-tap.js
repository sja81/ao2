/*
 * jquery.nav-tab-double-tap.js v1.1.5
 *
 * Description: Requires double tapping Wordpress navigation links with submenus
 * Copyright: https://www.agentimage.com
 * License: Proprietary
 */
( function() {
	
	jQuery.fn.navTabDoubleTap = function(settings) {
		
		settings = jQuery.extend({
			submenu:'.sub-menu',
			ignoreItems:''
		},settings);
		
		return jQuery(this).each( function(i,v) {
			FixMenu(jQuery(v),settings);
		});
		
	}
	
	function FixMenu(elem,settings) {
		
		var ctrlActive = false;
		var listItems = elem.find("li").not( jQuery(settings.ignoreItems) );
		var anchors = elem.find("a").not( jQuery(settings.ignoreItems) );
		
		function __construct() {
			
			/* Add class to all parent <a> */
			listItems.addClass("jquery-nav-tab-parent");
			
			/* Determine <a> state on touch gestures */
			anchors.bind("touchstart", function(e) {
				e.stopPropagation();
				
				/* Temporarily set <body>'s cursor style to pointer because iOS ignores click events on non-anchor elements */
				jQuery("body").css("cursor","pointer");
				
				/* Temporarily set tap color to transparent to prevent flickering */
				jQuery("body").css("-webkit-tap-highlight-color","transparent");
				
				/* Add touch gesture class */
				jQuery(e.currentTarget).addClass("jquery-nav-tab-touchstart");
				
				/* Remove all classes from links under other tabs */
				elem.find("a").not( jQuery(e.currentTarget).parent(".jquery-nav-tab-parent").children("a") ).removeClass("jquery-nav-tab-redirect jquery-nav-tab-active jquery-nav-tab-touchstart");
				
				/* Mark for redirection if no submenus are detected */
				if ( !jQuery(e.currentTarget).parent().children(settings.submenu).length ) {
					jQuery(e.currentTarget).addClass("jquery-nav-tab-redirect");
				}
				
				/* Mark for redirection on second tap if submenus are detected */
				if ( jQuery(e.currentTarget).hasClass("jquery-nav-tab-active") ) {
					jQuery(e.currentTarget).addClass("jquery-nav-tab-redirect");
					return;
				}
				
				/* Mark as active on first tap */
				jQuery(e.currentTarget).addClass("jquery-nav-tab-active");
				
				
			});
			
			/* Determine <a> state on mouse gestures */
			anchors.bind("mousedown", function(e) {
				
				if ( !jQuery(e.currentTarget).hasClass("jquery-nav-tab-touchstart") ) {
					jQuery(e.currentTarget).addClass("jquery-nav-tab-redirect");
				}
				
			});
			
			/* Determine <a> behavior according to state */
			anchors.bind("click", function(e) {
			
				e.preventDefault();
				e.stopPropagation();

				if ( jQuery(e.currentTarget).hasClass("jquery-nav-tab-redirect") ) {
					openLink( jQuery(e.currentTarget) );
				}
			
			});
			
			/* Recognize CTRL+Click */
			jQuery(document).bind("keydown",setCtrlActive);
			jQuery(document).bind("keyup",setCtrlInactive);
			
			/* Reset classes and styles when <body> is clicked */
			jQuery("body").click( function(e) {
				jQuery(e.currentTarget).css({
					"cursor":"auto",
					"-webkit-tap-highlight-color":"inherit"
				});
				elem.find("a").removeClass("jquery-nav-tab-redirect jquery-nav-tab-active jquery-nav-tab-touchstart");
			});
			
		}
		
		function setCtrlActive(e) {
			if ( e.which == 17 ) {
				ctrlActive = true;
			}
		}
		
		function setCtrlInactive(e) {
			if ( e.which == 17 ) {
				ctrlActive = false;
			}
		}
		
		function openLink(a) {
			var url = a.attr("href");
			var target = typeof a.attr("target") == 'undefined' ? '_self' : a.attr("target") ;

			if ( ctrlActive ) {
				target = "_blank";
			}
			
			window.open(url,target);
		}
		
		__construct();

	
	}
	

})();