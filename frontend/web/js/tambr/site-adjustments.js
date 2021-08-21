(function($){
	
	var siteAdjustments = {
		init: function(){
			this.addToAny_fix();
		},

		addToAny_fix: function(){
			$('.aios-listings-page #pop-light.property-pop').detach().appendTo('body.aios-listings-page');

			$(window).scroll( function() { 
				$(".a2a_menu, .a2a_overlay, #a2apage_overlay").hide(); 
			});
		}
	}

	$('document').ready(function(){
		siteAdjustments.init();
	});

})(jQuery);