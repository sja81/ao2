jQuery(document).ready( function() {
	
	jQuery("a[href='#']").click( function(e) {
		if ( jQuery(e.currentTarget).attr("href") == "#" ) {
			e.preventDefault();
		}
	});
	
});