( function($) {

	$( document ).ready( function() {

		var $document 		= $( document ),
			$window 		= $( window ),
			$viewport 		= $( 'html, body' ),
			$html 			= $( 'html' ),
			$body 			= $( 'body' ),
			$menuPanelChild = $( '#menu-panel' ).find( '> li' );

		function __construct() {
			additionalClassOnReady();
			headerScrollToFix();
			headerSpan();
			expandedPopup();
			backToTop();
			video_pause();
			scrollToObject();
			cf7_datepicker_fields();

			$window.on( 'load', function() {
				additionalClassOnLoad();
			} );
		}

		function additionalClassOnReady() {
			$( 'body' ).addClass( 'altman-ready' );
		}

		function additionalClassOnLoad() {
			$( 'body' ).removeClass( 'altman-ready' ).addClass( 'altman-loaded' );
		}

		function headerScrollToFix() {
			var $header = $( 'header.header' );

			$window.on( 'load resize scroll', function() {

				setTimeout( function() {
					var currentScrollPos = $window.scrollTop(),
						currentWindowWid = $window.width();

					if ( currentWindowWid > 992 ) {

						$showFixed = 280;

						if ( currentScrollPos > $showFixed ) {
							$header.stop( true, true ).addClass('onscroll position-fixed animated fadeInDown');
						} else {
							if ( $header.hasClass( 'onscroll' ) ) {
								$header.stop( true, true ).addClass( 'fadeOutUp' ).delay(300).queue( function( next ) {
									$( this ).removeClass('onscroll position-fixed animated fadeInDown fadeOutUp');
									next();
								} );
							}
						}

					} else {
						$header.stop( true, true ).removeClass('onscroll position-fixed animated fadeInDown');
					}
				}, 30 );

			} );
		}

		function headerSpan() {
			$( '#navigation .sub-menu li a' ).wrapInner( '<span></span>' );
		}

		function expandedPopup() {
			var $mainMenu 			= $( '.menu-panel__button' ),
				$pushWrap 			= $( '.menu-panel' ),
				_pushWrap 			= '.menu-panel',
				$close 				= $( '.menu-panel__close' );

			$( _pushWrap ).css({ zIndex: -1, display: 'none' });

			$document.keyup( function( e ) {
				if ( e.keyCode == 27 ) closePopUpMenu( _pushWrap );
			} );

			$close.on( 'click', function() {
				closePopUpMenu( _pushWrap );
			} );

			$(document).on( 'click', function(e) {
				if(!$(e.target).closest('.return-no-close').length) {
					if($('.return-no-close').is(":visible")) {
						closePopUpMenu( _pushWrap );
					}
				}
			} );

			$mainMenu.on( 'click', function() {
				if ( $pushWrap.hasClass( 'fadeInRight' ) ) {
					closePopUpMenu( _pushWrap );
				} else {
					openPopUpMenu( _pushWrap );
				}
				return false;
			} );

			$menuPanelChild.css({opacity: 0}).addClass( 'fadeInRight' );
		}

		function openPopUpMenu( class_menu ) {
			$( class_menu ).css({ zIndex: 3000,display: 'block' }).removeClass( 'fadeOutRight' ).addClass( 'fadeInRight' );

			var $count 				= 19;
			$menuPanelChild.each( function() {
				$( this ).delay(500).queue( function(nxt) {
					$( this ).css({animationDelay: '0.' + $count + 's'}).addClass( 'animated' );
					nxt();
				} );
				$count = $count + 19;
			} );
		}

		function closePopUpMenu( class_menu ) {
			$( class_menu ).removeClass( 'fadeInRight' ).addClass( 'fadeOutRight' );

			setTimeout( function() {
				$( class_menu ).removeClass( 'fadeOutRight' ).css({ zIndex: -1, display: 'none' });
				$( '#menu-panel' ).find( '> li' ).removeClass( 'animated' );
			}, 500 );
		}

		function scrollToObject() {
			var $e = $( '[data-scroll-to]' );
            if ( $e.length > 0 ) {
                $e.on( 'click', function( e ) {
                    var _v = $e.attr( 'data-scroll-to' ),
                        $v = $( '#' + _v );

                    if ( $v.length == 0 ) { return;}

                    // Stop the animation if the user scrolls. Defaults on .stop() should be fine
                    $viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
                        if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
                            $viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
                        }
                    });
                    
                    $viewport.animate({ 
                        scrollTop: $v.offset().top - 80
                    }, 1700);

                    return false;
                } );
            }
		}

		function backToTop() {
			$( '.back-to-top' ).on( 'click', function( e ) {

				// Stop the animation if the user scrolls. Defaults on .stop() should be fine
				$viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
					if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
						$viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
					}
				});
				
				$viewport.animate({ 
					scrollTop: 0
				}, 1700);

				return false
			} );
		}

		function launchIntoFullscreen(element) {
			if(element.requestFullscreen) {
				element.requestFullscreen();
			} else if(element.mozRequestFullScreen) {
				element.mozRequestFullScreen();
			} else if(element.webkitRequestFullscreen) {
				element.webkitRequestFullscreen();
			} else if(element.msRequestFullscreen) {
				element.msRequestFullscreen();
			}
		}

		function exitFullscreen() {
			if(document.exitFullscreen) {
				document.exitFullscreen();
			} else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
		}

		function video_pause(){
			// https://davidwalsh.name/fullscreen
			// exitFullscreen();

			var video = $('video');

			var videoElement = video.get(0);

			$('.banner-bttn-play').click(function(e) {

				e.preventDefault();
				video.trigger('play');

				$('.banner-bttn-pause').fadeIn();
				$('.banner-bttn-play').fadeOut();
			});

			$('.banner-bttn-pause').click(function(e) {

				e.preventDefault();
				video.trigger('pause');

				$('.banner-bttn-play').fadeIn();
				$('.banner-bttn-pause').fadeOut();
			});

			$('.banner-bttn-vol-up').click(function(e) {

				e.preventDefault();
				$("video").prop('muted', false)

				$('.banner-bttn-vol-mute').fadeIn();
				$('.banner-bttn-vol-up').fadeOut();
			});

			$('.banner-bttn-vol-mute').click(function(e) {

				e.preventDefault();
				$("video").prop('muted', true)

				$('.banner-bttn-vol-up').fadeIn();
				$('.banner-bttn-vol-mute').fadeOut();
			});


			$( '.banner-bttn-fullscreen' ).click(function(e) {
				e.preventDefault();

				launchIntoFullscreen(videoElement);
			} );
		}

		function cf7_datepicker_fields(){
			$( ".text_datepicker" ).datepicker();
		}
		

		__construct();

	} );
} )( jQuery );