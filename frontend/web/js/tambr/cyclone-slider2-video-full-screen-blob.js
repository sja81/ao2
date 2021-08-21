/* Cycle2 Swiper */
!function(a){"use strict";a.event.special.swipe=a.event.special.swipe||{scrollSupressionThreshold:10,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:75,setup:function(){var b=a(this);b.bind("touchstart",function(c){function d(b){if(g){var c=b.originalEvent.touches?b.originalEvent.touches[0]:b;e={time:(new Date).getTime(),coords:[c.pageX,c.pageY]},Math.abs(g.coords[0]-e.coords[0])>a.event.special.swipe.scrollSupressionThreshold&&b.preventDefault()}}var e,f=c.originalEvent.touches?c.originalEvent.touches[0]:c,g={time:(new Date).getTime(),coords:[f.pageX,f.pageY],origin:a(c.target)};b.bind("touchmove",d).one("touchend",function(){b.unbind("touchmove",d),g&&e&&e.time-g.time<a.event.special.swipe.durationThreshold&&Math.abs(g.coords[0]-e.coords[0])>a.event.special.swipe.horizontalDistanceThreshold&&Math.abs(g.coords[1]-e.coords[1])<a.event.special.swipe.verticalDistanceThreshold&&g.origin.trigger("swipe").trigger(g.coords[0]>e.coords[0]?"swipeleft":"swiperight"),g=e=void 0})})}},a.event.special.swipeleft=a.event.special.swipeleft||{setup:function(){a(this).bind("swipe",a.noop)}},a.event.special.swiperight=a.event.special.swiperight||a.event.special.swipeleft}(jQuery);
/* End Cycle2 Swiper */
(function() {

    jQuery.fn.aiosCycloneSliderVideoSlideshow = function(settings) {

        settings = jQuery.extend({
            'slides': '>div',
            'fx': 'fade',
            'speed': 1000,
            'timeout': 4000,
            'audio': false,
            'alwaysHideControls': false
        }, settings);

        jQuery(this).each(function(i, v) {

            new AIOSCycloneSliderVideoSlideshow(jQuery(v), settings);

        });

    }

    function AIOSCycloneSliderVideoSlideshow(object, settings) {

        var target = jQuery(object).find(".cycloneslider-slides");
        var slides = target.find(settings.slides);
        var duplicatedForContinuity = false;
        var slideTimeout;
        var videoResumed = false;

        function __construct() {

            /* If there is only one slide, duplicate it to allow continuity */
            if (slides.length == 1) {
                slides.eq(0).clone().appendTo(target);
                slides = target.find(settings.slides)
                duplicatedForContinuity = true;
            }

            /* Turn off preloading to save bandwidth */
            target.find("video").attr("preload", "none");

            /* Pause all videos to save bandwidth */
            target.find("video").trigger("pause");

            /* Add preloader class */
            slides.addClass("video-slide");

            /* Set audio */
            if (settings.audio) {
                target.find("video").prop("muted", false);
            } else {
                target.find("video").prop("muted", true);
            }

            /* Allows inline playback */
            target.find("video").prop("playsinline", true);

            /* Test each video's autoplayability then run the slideshow */
            testAutoplayability();

        }

        function initSlideshow() {

            /* Determine timeout */
            var timeout = settings.timeout;

            if (supportsAutoplay()) {
                timeout = 0;
            } else if (duplicatedForContinuity) {
                timeout = 0;
            }

            /* Intialize Cycle */
            target.cycle({
                'fx': settings.fx,
                'timeout': timeout,
                'speed': settings.speed
            });

            /* Set data-posters as posters for backward compatibility */
            slides.find("video").each(function(i, v) {

                var poster = jQuery(v).attr("data-poster");
                if (poster != "") {
                    jQuery(v).attr("poster", poster);
                }

            });

            /* Hide controls if video can be autoplayed */
            slides.find("video").each(function(i, v) {

                if (canBeAutoplayed(jQuery(v)) || settings.alwaysHideControls) {
                    jQuery(v).addClass("cycloneslider-template-video-autoplay");
                }

            });


            /*	Whenever Cycle is paused on the first slide, 
            	the 'cycle-before' event doesn't fire when it is resumed.
            	Force the transition. */
            target.on('cycle-resumed', function(event, opts) {
                if (settings.timeout > 0 && videoResumed) {
                    videoResumed = false;
                    target.cycle("next");
                }
            });

            /* Play video on every transition */
            target.on('cycle-before', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {

                var video = jQuery(incomingSlideEl).find("video");
                var previousVideo = jQuery(outgoingSlideEl).find("video");

                video.addClass("current-video");
                previousVideo.removeClass("current-video");

                target.find("video").not(previousVideo).trigger("pause");

                /* Preload the image of the next slide */
                loadImage(jQuery(incomingSlideEl).next().find(".cycloneslider-img-js"));

                /* Load image of current slide */
                loadImage(jQuery(incomingSlideEl).find(".cycloneslider-img-js"));

                /* Rewind video if it can't be autoplayed */
                if (video.length > 0 && !canBeAutoplayed(video)) {
                    video[0].currentTime = 2;
                }

                /* Replay video */
                if (video.length > 0 && canBeAutoplayed(video)) {

                    clearTimeout(slideTimeout);

                    if (isVideoReady(video)) {
                        video[0].currentTime = 0;
                    }

                    playVideo(video);
                }
                /* If different media type, move after specified timeout */
                else {
                    clearTimeout(slideTimeout);

                    /* If the user intentionally disables jQuery Cycle autoplay, skip. */

                    if (settings.timeout > 0) {
                        console.log(2.0);
                        slideTimeout = setTimeout(function() {
                            console.log(2.1);
                            target.cycle("next");
                        }, (parseInt(settings.timeout) + parseInt(settings.speed)));
                    }
                }

            });

            /* Play first video on page load */
            var firstVideo = target.children("div").eq(0).find("video");
            if (firstVideo.length > 0 && canBeAutoplayed(firstVideo)) {

                /* Try preloading the image of the next slide */
                loadImage(target.children("div").eq(1).find(".cycloneslider-img-js"));

                /* Play the video */
                firstVideo.addClass("current-video");
                playVideo(firstVideo);

            }
            /* If different media type, move after specified timeout */
            else {

                /* If the first slide is an image, try preloading it and the image of the slide after it */
                loadImage(target.children("div").eq(0).find(".cycloneslider-img-js"));
                loadImage(target.children("div").eq(1).find(".cycloneslider-img-js"));

                clearTimeout(slideTimeout);

                /* If the user intentionally disables jQuery Cycle autoplay, skip. */
                if (settings.timeout > 0) {
                    slideTimeout = setTimeout(function() {
                        target.cycle("next");
                    }, (parseInt(settings.timeout) + parseInt(settings.speed)));
                }

            }

            /* Video events */
            target.find("video").on('timeupdate', function(e) {

                var video = jQuery(e.currentTarget);

                if (!canBeAutoplayed(video)) {
                    return;
                }
                var duration = video[0].duration;
                var currentTime = video[0].currentTime;
                var allowance = settings.speed / 1000;

                if ((duration - currentTime) < allowance && video.hasClass("current-video") && isVideoReady(video)) {
                    if (settings.timeout > 0) {
                        //target.cycle('next');	
                    }
                }

            });

            /* If autoplay is unsupported, pause slideshow whenever a video is played */
            target.find("video").on("play waiting", function(e) {
                clearTimeout(slideTimeout);
                target.cycle("pause");
            });

            /* If autoplay is supported, resume slideshow whenever a video has ended */
            target.find("video").on("ended", function(e) {
                videoResumed = true;
                target.cycle("resume");
            });

            /* Display loader while video buffers */
            target.find("video").on('waiting', function(e) {

                var video = jQuery(e.currentTarget);
                video.parents(".video-slide").addClass("buffering");

            });

            /* Hide loader when video plays */
            target.find("video").on('canplaythrough canplay timeupdate', function(e) {

                var video = jQuery(e.currentTarget);
                video.parents(".video-slide").removeClass("buffering");

            });

            // aiosCycloneSliderVideoSlideshowFullScreen();
            // setTimeout( aiosCycloneSliderVideoSlideshowBlob(), 1000 );
        }

        function playVideo(video) {

            /* Don't play video if autoplay is unsupported */
            if (!canBeAutoplayed(video)) {
                video[0].currentTime = 0;
                return;
            }

            /* 	Set preload to auto to ensure that video plays on Mac Webkit browsers. 
            	If it is set to 'none', the video doesn't play even if the 'play' event is triggered. */
            video.attr("preload", "auto");

            /* Play the video */
            video.trigger("play");

            if (isVideoReady(video)) {
                video[0].currentTime = 0;
            }

        }

        /* Since iOS 10 and Chrome 53, muted videos may be autoplayed.
         * This function tests each video's autoplayability before the slideshow initializes.
         * Hopefully, this is replaced by a more efficient approach.
         */
        function testAutoplayability() {

            var videos = target.find("video");

            videos.each(function(i, v) {
                if (supportsAutoplay()) {
                    jQuery(v).addClass("autoplay");
                }
            });

            initSlideshow();


        }

        /* testAutoplayability() must be run first to reliably use this function */
        function canBeAutoplayed(video) {

            if (jQuery(video).hasClass("autoplay")) {
                return true;
            } else {
                return false;
            }

        }

        /* Test general autoplay support */
        function supportsAutoplay() {

            var v = document.createElement("video");
            v.muted = true;
            v.play();
            return !v.paused;

        }

        function isVideoReady(video) {
            return jQuery.inArray(video.get(0).readyState, [3, 4]) > -1;
        }

        function loadImage(image) {

            if (image.length < 1) {
                return;
            }

            var src = jQuery(image).attr("data-src");
            jQuery(image).attr("src", src);

        }


        function aiosCycloneSliderVideoSlideshowBlob() {
            jQuery( 'video' ).each( function() {
                var $this = jQuery( this );
                if ( $this.attr( 'data-video-blob' ) == 'true' ) {
                    var $video_src  = $this.find( 'source' ),
                        data_src    = $video_src.attr( 'src' );

                    if ( data_src != '' ) {
                        var req = new XMLHttpRequest();
                        req.open('GET', data_src, true);

                        //Binary Large OBject(BLOB)
                        req.responseType = 'blob';

                        req.onload = function() {
                            // Onload is triggered even on 404
                            // so we need to check the status code
                            if ( this.status === 200 ) {
                                var videoBlob = this.response;
                                var vid = URL.createObjectURL(videoBlob); // IE10+
                                var video = $video_src;
                                // Video is now downloaded
                                // and we can set it as source on the video element
                                video.attr( 'src', vid);
                            }
                        }
                        req.onerror = function() {
                            console.log( 'Can\'t load file: ' + data_src );
                        }

                        req.send();
                    }
                }
            } );
        }

        // function aiosCycloneSliderVideoSlideshowFullScreen() {
        //     var $win        = jQuery( window ),
        //         devHeight   = $win.height() + 'px';
        //     jQuery( '.cycloneslider-slides canvas' ).each( function() {
        //         jQuery( this ).css({height: devHeight})
        //     } );
        // }
        
        // jQuery( window ).on( 'load resize', function() {
        //     aiosCycloneSliderVideoSlideshowFullScreen();
        // } );

        __construct();

    }

})();