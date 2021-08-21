( function( $ ){

	$( document ).ready( function() {
		var $data_src 	= $( '[data-seq-src]' ),
			imgArr 		= [],
			_count 		= 0;

		$data_src.each( function() {
			var $this 	= $(this),
				_img 	= $this.attr('data-seq-src');

			if ( _img != '' ) {
				$this.attr( 'data-seq-src-index', _count );
				$this.addClass( 'data-seq-image data-seq-ready' );
				imgArr[_count] = _img;
				_count++;
			}
		} );

		$( window ).on( 'load', function() {
			function sequential_requests( imageArray, index ) {
				index = index || 0;

				if (imageArray && imageArray.length > index) {
					image_temp 			= new Image();
					image_temp.src 		= imageArray[index];
					image_temp.onload 	= function() {
						sequential_requests(imageArray, index + 1);
						if( imageArray[index] != undefined ) {
                            $elem = $( '[data-seq-src-index=' + index + ']' )
                            if ( $elem.prop("nodeName") == 'IMG' ) {
                                $elem.attr( 'src', imageArray[index] ).removeClass('data-seq-ready').addClass('data-seq-loaded');
                            } else if ( $elem.prop("nodeName") == 'CANVAS' || $elem.prop("nodeName") == 'DIV' ) {
                                $elem.css({'background-image': 'url(' + imageArray[index] + ')'}).removeClass('data-seq-ready').addClass('data-seq-loaded');
                            }
						}
					}
				}
			};

			sequential_requests( imgArr );
		} );

	} );

} )( jQuery );