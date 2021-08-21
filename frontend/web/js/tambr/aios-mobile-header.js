( function($) {

	$.prototype.aiosMobileHeader = function(settings) {
		
		var defaults = {
			height: false
		}
		
		settings = $.extend(defaults,settings);
		
		this.each( function(i,v) {
			
			Header(jQuery(v),settings);
			
		});
		
	}
	
	function Header(object,settings) {
		
		var object = jQuery(object);
		var offsetAnchorMarker = '_aiosmobilepackheaderanchoroffset' + Math.random(); 
		var newlyRefreshed = true;
		var offsetPattern = /_aiosmobilepackheaderanchoroffset(\d|\.)*$/g;
		
		function _construct() {
			
			correctInPageLinks();

		}
		
		/*
		 * Correct in-page links
		 * Credits: http://stackoverflow.com/questions/17534661/make-anchor-link-go-some-pixels-above-where-its-linked-to 
		 */
		function correctInPageLinks() {
			
			jQuery(window).on("hashchange", function () {
				offsetAnchor();
			});

			window.setTimeout(function() {
				cleanAnchor();
			}, 1);
			
		}
		
		function offsetAnchor() {
			
			if(location.hash.length > 0 && location.hash.search(offsetAnchorMarker) == -1 ) {
				if ( isHeaderVisible() ) {
					
					var headerHeight = !settings.height ? object.height() : settings.height;
					
					jQuery(window).scrollTop( (jQuery(window).scrollTop() - headerHeight) );
					location.hash += offsetAnchorMarker;
				}
			}
		}
		
		function cleanAnchor() {
			if (location.hash.length > 0 && newlyRefreshed ) {
				if ( isHeaderVisible() ) {
					var originalHash = location.hash.replace(offsetPattern,'');
					location.hash = originalHash;
					newlyRefreshed = false;
				}
			}
		}
		
		function isHeaderVisible() {
			return object.is(":visible");
		}
		
		_construct();
		
	}
	
})(jQuery);