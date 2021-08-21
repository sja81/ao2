( function($) {
	$( document ).ready( function() {

		var $document 		= $( document ),
			$window 		= $( window ),
			$viewport 		= $( 'html, body' ),
			$html 			= $( 'html' ),
			$body 			= $( 'body' ),
			$carousel 		= $('#blog-wrapper');

		function __construct() {
			innerpageScroll();
			blog_chain();
			blog_post_count();
			windowWidthMobile();

			$( window ).on('resize', function() {
				setTimeout(function(){
					windowWidthMobile();
				},50)
			})
		}

		function innerpageScroll(){
			$(window).scroll(function() {
				if( $(this).scrollTop()  > 0 ) {
					if (!$('.page-banner').hasClass('active-banner')) {
						$('.page-banner').addClass('active-banner');
					};
				} else {
					if ( $('.page-banner').hasClass('active-banner')) {
						$('.page-banner').removeClass('active-banner');
					};
				}
			});
		}

		function blog_chain(){


			$carousel.find('> .blog-card').each(function(i) {
				if( i % 4 == 0 ) {
					$(this).nextAll().andSelf().slice(0,4).wrapAll('<div class="blog-card-wrap"></div>');
				}
			});


			$(".blog-card-title").chainHeight({
				refreshDelay: 0
			});

			$carousel.slick({
				dots: true,
				infinite: true,
				speed: 1500,
				fade: true,
				cssEase: 'linear',
				autoplay: true,
				autoplaySpeed: 4000
			});
		}

		function blog_post_count(){
			if($('.entry-title').text().length >  69){
				$('.entry-title').addClass('xceed-title')
			}
		}

		function windowWidthMobile() {
			var ww = $( window ).width();

			if ( ww < 600 ) {
				if ( $carousel.hasClass('slick-initialized') ) {
					$carousel.slick('unslick');
				}
			} else {
				if ( !$carousel.hasClass('slick-initialized') ) {
					$carousel.slick('init');
				}
			}
		}

		// Instantiate
		__construct();

	} );
} )( jQuery );