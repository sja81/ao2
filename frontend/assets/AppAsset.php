<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css',
        //'css/site.css',
        'css/tambr/aios-all-widgets.css',
        //'css/tambr/agentimage.font.icons.css',
        'css/tambr/aios-initial-setup-frontend.min.css',
        'css/tambr/contact-form-7/styles.css',
        'css/tambr/contact-form-7/jquery-ui.min.css',
        //'css/jquery-ui.min.css',
        'css/tambr/aios-theme.css',
        'css/tambr/bootstrap.min.css',
        'css/tambr/aios-popup.css',
        'css/tambr/mortgage-calculator/mc_style.css',
        'css/fonts.css',
        'css/tambr/aios-utilities.min.css',
        'css/tambr/default.css',
        'css/tambr/slick.css',
        'css/tambr/style.animate.min.css',
        'css/tambr/style.css',
        'css/tambr/homepage.css', // Home page
        'css/tambr/add-to-any/addtoany.min.css',
        'css/tambr/cyclone-slider-2/style-dark.css',
        'css/tambr/cyclone-slider-2/style-default.css',
        'css/tambr/cyclone-slider-2/style-standard.css',
        'css/tambr/cyclone-slider-2/style-thumbnails.css',
        'css/tambr/cyclone-slider-2-video-full-screen-blob/style.css',
        'css/tambr/listings.css',
        'css/tambr/listings-current.css',
        'css/bootstrap-slider.css',
        'css/super-sidebar.min.css',
        'css/magnific-popup.css',
        'css/aoreal.css?v=2',
        'css/mandesign.css'
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js',
        //'js/tambr/jquery.js',
        'js/tambr/jquery-migrate.min.js',
        'js/tambr/addtoany.min.js',
        'js/tambr/aios-mobile-header-navigation.js',
        'js/tambr/aios-mobile-header.js',
        'js/tambr/bowser-scripts.js',
        'js/tambr/contact-form7-normalize-date-field.js',
        'js/tambr/aios-initial-setup-dead-link-disabler.js',
        'js/tambr/asis-idxb-titles.js',
        'js/tambr/css-browser-selector.js',
        
        'js/tambr/jquery.nav-tab-double-tap.js',
        'js/tambr/aios-popup.js',
        'js/tambr/global.js',
        'js/tambr/mortgagecalculator.js',
        'js/tambr/jquery.chain-height.min.js',
        'js/tambr/jquery.elementpeek.min.js',
        'js/tambr/jquery.onload.images.js',
        'js/tambr/slick.min.js',
        'js/tambr/inner-page.js', // Non home page
        'js/tambr/scripts.js',
        'js/tambr/homepage.js', // Home page
        'js/tambr/properties-popup.js', // Home page
        
        'js/tambr/cf7-formdata-compatibility.js',
        'js/tambr/aios-initial-setup-frontend.min.js',
        'js/tambr/site-adjustments.js',
        //'js/tambr/zerospam.js',
        //'js/tambr/comment-reply.min.js',
        'js/tambr/ui/core.min.js',
        'js/tambr/ui/datepicker.min.js',
        'js/tambr/ui/widget.min.js',
        'js/tambr/ui/button.min.js',
        'js/tambr/ui/spinner.min.js',
        'js/tambr/jquery.cycle2.min.js',
        'js/tambr/jquery.cycle2.carousel.min.js',
        'js/tambr/jquery.cycle2.swipe.min.js',
        'js/tambr/jquery.cycle2.tile.min.js',
        'js/tambr/jquery.cycle2.video.min.js',
        'js/tambr/cycle2-dark.js',
        'js/tambr/cycle2-thumbnails.js',
        'js/tambr/cyclone-slider2-video-full-screen-blob.js',
        'js/tambr/vimeo-player.js',
        'js/tambr/cycle2-client.js',
        'js/bootstrap.min.js',
        'js/bootstrap-slider.js',
        'js/jquery.magnific-popup.min.js',
        'js/velocity.min.js',
        'js/jquery.super-sidebar.js',
        'js/common.js',
        'js/tambr/ui/autocomplete.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
