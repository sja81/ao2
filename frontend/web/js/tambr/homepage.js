( function($) {
	$( document ).ready( function() {

		var $document 		= $( document ),
			$window 		= $( window ),
			$viewport 		= $( 'html, body' ),
			$html 			= $( 'html' ),
			$body 			= $( 'body' );

		function __construct() {
			headerAnchor();
			arrowBounce();
			fontSizeBaseHeight();
			featuredProperties();
			spotlightContainer();
            fixLazyImages();
			mdlla();

			$window.on( 'resize', function() {
				fontSizeBaseHeight();
			} );

			$window.on( 'load', function() {
				headerAnchorScrollLoad();
			} );
		}

		function carouselSlick( carousel_id, carousel_show, carousel_scroll, carousel_dots, carousel_arrow, carousel_autoplay, carousel_autoplayspeed, medium_devices, small_devices, exsmall_devices, fade_effect, asNavFor ) {
		
			// Usage: carouselSlick( '.ft-pts-carousel', 4, 4, false, true, true, 4000, 2, 1, 1, false, null );
			function getCarouselSetting() {
				carousel_show = ( carousel_show == undefined ? 4 : carousel_show );
				carousel_scroll = ( carousel_scroll == undefined ? 4 : carousel_scroll );
				carousel_dots = ( carousel_dots == undefined ? false : carousel_dots );
				carousel_arrow = ( carousel_arrow == undefined ? true : carousel_arrow );
				carousel_autoplay = ( carousel_autoplay == undefined ? true : carousel_autoplay );
				carousel_autoplayspeed = ( carousel_autoplayspeed == undefined ? '4000' : carousel_autoplayspeed );
				medium_devices = ( medium_devices == undefined ? 2 : medium_devices );
				small_devices = ( small_devices == undefined ? 1 : small_devices );
				exsmall_devices = ( exsmall_devices == undefined ? 1 : exsmall_devices );
				fade_effect = ( fade_effect == undefined ? false : fade_effect );
				asNavFor = ( asNavFor == undefined ? null : asNavFor );
				// Only use the current return when using $.fn.extend or intergrating third plugin or event(i.e. .css, .slice, .width, .height, etc.)
				return {
					slidesToShow: carousel_show,
					slidesToScroll: carousel_scroll,
					dots: carousel_dots,
					arrows:  carousel_arrow,
					prevArrow: '<a href="#" class="slick-custom-arrow slick-prev">Prev</a>',
					nextArrow: '<a href="#" class="slick-custom-arrow slick-next">Next</a>',
					touchThreshold: 100, 
					autoplay:  carousel_autoplay,
					autoplaySpeed: carousel_autoplayspeed,
					infinite: true, 
					speed: 1000,
					fade: fade_effect,
					asNavFor: asNavFor,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: carousel_show,
								slidesToScroll: carousel_scroll
							}
						},
						{
							breakpoint: 970,
							settings: {
								slidesToShow: medium_devices,
								slidesToScroll: medium_devices
							}
						},
						{
							breakpoint: 750,
							settings: {
								slidesToShow: small_devices,
								slidesToScroll: small_devices
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: exsmall_devices,
								slidesToScroll: exsmall_devices
							}
						}
					]
				}
			}

			if ( $( carousel_id ).length > 0 ) {
				$( carousel_id ).slick( getCarouselSetting() );

				$( window ).on( 'load', function() {
					$( carousel_id ).slick( 'unslick' );
					$( carousel_id ).slick( getCarouselSetting() );
				} );
			}
		}

		function headerAnchor() {
			var $navi_link 		= $( '#navigation > li > a' ),
				_header_height 	= $( '.header' ).outerHeight();

			$('.menu-parent-about > a').attr( 'href', '#alt-about-us' );
			$('.menu-parent-properties > a').attr( 'href', '#exclusive-real-estate-properties' );
			$('.menu-parent-media > a').attr( 'href', '#million-dollar-listing-la-show' );
			$('.menu-parent-training-speaking > a').attr( 'href', '#training-speaking' );
			$('.menu-parent-contact > a').attr( 'href', '#get-in-touch-with-us' );

			$navi_link.on( 'click', function() {
				var href = $( this ).attr( 'href' );

				if ( href == window.location.hash ) { return false;}

				if ( $body.hasClass( 'home' ) ){
					// Stop the animation if the user scrolls. Defaults on .stop() should be fine
					$viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
						if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
							$viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
						}
					});
					
					$viewport.animate({ 
						scrollTop: $( href ).offset().top - _header_height
					}, 300);

				} else {
					window.location.href = altman_url + href;
				}
			} );

			// Prevent url with hash from jumping
			if ( $body.hasClass( 'home' ) ){
				if (location.hash) {
					setTimeout(function() {
						window.scrollTo(0, 0);
					}, 1);
				}
			}
		}

		function headerAnchorScrollLoad() {
			var _header_height 	= $( '.header' ).outerHeight();

			// Check if come from outside
			if ( $body.hasClass( 'home' ) && window.location.hash != '' ) {
				setTimeout( function() {
					// Stop the animation if the user scrolls. Defaults on .stop() should be fine
					$viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
						if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
							$viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
						}
					});
					
					$viewport.animate({ 
						scrollTop: $( window.location.hash ).offset().top - _header_height
					}, 300);
				}, 30);
			}
		}

		function arrowBounce() {
			var $header = $( 'header.header' );

			$window.on( 'scroll', function() {

				setTimeout( function() {
					var currentScrollPos = $window.scrollTop(),
						currentWindowWid = $window.width();

					if ( currentWindowWid > 50 ) {

						$( '.alt-arrow' ).fadeOut();

					} 
				}, 30 );

			} );
		}

		function fontSizeBaseHeight() {
			setTimeout( function() {
				var slideshowOverlay	= $( window ).height();
				$( '.alt-slideshow__overlay' ).css({ 'font-size': ( slideshowOverlay + 30 ) + 'px' });
			}, 50 );
		}
		function featuredProperties() {
			carouselSlick( '#expro-slider-upper', 3, 3, false, true, true, 4000 );
			carouselSlick( '#expro-slider-middle', 3, 3, false, true, true, 4000 );
			carouselSlick( '#expro-slider-lower', 3, 3, false, true, true, 4000 );
		}
		function spotlightContainer() {
			carouselSlick( '.mdl-spotlight__slider', 1, 1, false, true, true, 4000, 1 );
		}
		function mdlla() {
			$( '.mdl-show__video--holder a' ).on( 'click', function( e ) {
				e.preventDefault();

				var video = $( this ).data( 'video' ); 

				$( this ).parent().append( '<iframe class="embed-responsive-item" src="' + video + '?autoplay=1"  frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>' );
				// $( this ).parent().append( '<video autoplay><source src="' + video + '" type="video/mp4"></video>' );

			} );
		}

        function fixLazyImages(){
			setTimeout(function(){
                $=jQuery;
                $('[data-seq-src]').each(function(){
                    if(this.nodeName.toLowerCase() === 'img'){
                        $(this).attr('src', $(this).attr('data-seq-src').replace('https://www.aoreal.skw', 'https://www.aoreal.sk/w'));
                    }else{
                        $(this).css({'background-image': 'url(' + $(this).attr('data-seq-src').replace('https://www.aoreal.skw', 'https://www.aoreal.sk/w') + ')','background-size':'100% 100% !important'});

                    }

                    $(this).addClass('data-seq-loaded');
                });
			},4000);

		}


		// Instantiate
		__construct();

	} );
} )( jQuery );