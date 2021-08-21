( function($) {

	var altmanInlinePopup = {
		init: function() {
			this.apeend_content();
			this.close_container();

			$( window ).on( 'load resize', function() {
				setTimeout( function() {
					if ( $(window).width() > 991 ) {
						altmanInlinePopup.append_container( '.expro-container' );
					}
				}, 50 );
			} );
		},
		apeend_content: function() {
			var $expro_slide = $( '.expro-slide' ),
				_expro_slide_count = 0;

			if ( $expro_slide.length < 1 ) { return false; }
			$expro_slide.each( function() {

				var $this 	= $( this ),
					_src 	= $this.data( 'expro-src' ),
					_street = $this.data( 'expro-street' ),
					_city 	= $this.data( 'expro-city' ),
					_price 	= $this.data( 'expro-price' );

				$this.find( '.expro-slider__content--street' ).text( _street );
				$this.find( '.expro-slider__content--city' ).text( _city );
				$this.find( '.expro-slider__content--price' ).text( _price );
				$this.find( '.expro-link' ).attr( 'data-inline-index', + _expro_slide_count ).attr( 'data-inline-src', _src );

				_expro_slide_count++;

			} );
		},
		append_container: function( class_to_append ) {
			var $expo_a		= $('.expro-link'),
				$viewport 	= $('html, body');

			$( 'body' ).on( 'click', '.expro-link', function( e ) {
				var $this 				= $( this ),
					_window_height 		= $( window ).height(),
					_header_height 		= $( '.header' ).outerHeight(),
					_gheight 			= ( _window_height - _header_height ),
					_expro_expandable 	= 'expro-expandable-slide',
					$expro_expandable 	= $( '.' + _expro_expandable ),
					$container 			= $this.parents( class_to_append ),
					$parent 			= $this.parents( 'div[data-expro-parent=container]' ),
					_src 				= $parent.data( 'expro-src' ),
					_street 			= $parent.data( 'expro-street' ),
					_city 				= $parent.data( 'expro-city' ),
					_price 				= $parent.data( 'expro-price' ),
					_show_timeout 		= 500;

				// Reset and Assign Var
				if ( $( class_to_append ).length < 1 ) { return false; }
				if ( $expro_expandable.length > 0 ) { 
					if ( $container.hasClass( 'expro-expand' ) ) {
						var _show_timeout = 0;
					} else {
						$container.removeClass( 'expro-expand' )
					}
					$expro_expandable.remove();
				}

				// Do_Action
				$container.addClass( 'expro-expand' );
				$( '<div class="' + _expro_expandable + '">' +
					'<canvas style="background-image: url(' + _src + ');" class="bg-no-repeat-center-center-cover"></canvas>' +
					'<div class="container">' +
						'<div class="' + _expro_expandable + '__container">' +
							'<div class="' + _expro_expandable + '__address">' +
								'<div class="' + _expro_expandable + '__address--street">' + _street + '</div>' + 
								'<div class="' + _expro_expandable + '__address--city">' + _city + '</div>' + 
							'</div>' +
							'<div class="' + _expro_expandable + '__price">' +
								_price +
							'</div>' +
						'</div>' +
						'<div class="' + _expro_expandable + '__close alt-icon-close"></div>' +
						'<a href="' + $this.attr( 'href' ) + '" class="secondary-button text-uppercase">View Details</a>' + 
					'</div>' +
				'</div>' ).insertAfter( $container ).find( 'canvas' ).css({ height: 0 }).animate( {
					height: _gheight
				}, _show_timeout );

				// Stop the animation if the user scrolls. Defaults on .stop() should be fine
				$viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
					if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
						$viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
					}
				});
				
				$viewport.animate({ 
					scrollTop: ( $container.offset().top + $container.outerHeight(true) ) - _header_height + 1
				}, 500);

				return false;
			} );
		},
		close_container: function() {
			$(document).on( 'click', function(e) {
				if(!$(e.target).closest('.expro-expandable-slide .secondary-button').length) {
					if($('.expro-expandable-slide .secondary-button').is(":visible")) {
						var _expro_expandable 	= 'expro-expandable-slide',
						$expro_expandable 	= $( '.' + _expro_expandable );

						if ( $expro_expandable.length > 0 ) { 
							$expro_expandable.animate( {
								height: 0
							}, 500 ).delay(500).queue( function(next) {
								$( this ).remove();
								next();
							} );
						}
					}
				}
			} );
			// $( 'body' ).on( 'click', '.expro-expandable-slide__close', function() {
				
			// } );
		}
	}

	$( document ).ready( function() {
		altmanInlinePopup.init();
	} );

} )( jQuery );