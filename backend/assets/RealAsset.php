<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class RealAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/dist/css/style.min.css',
        'css/aoreal.css?v=1.9'
    ];
    public $js = [
        'assets/node_modules/popper/popper.min.js',
        'assets/node_modules/bootstrap/dist/js/bootstrap.min.js',
        'assets/dist/js/perfect-scrollbar.jquery.min.js',
        'assets/dist/js/waves.js',
        'assets/dist/js/sidebarmenu.js',
        'assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js',
        'assets/node_modules/sparkline/jquery.sparkline.min.js',
        'assets/dist/js/custom.min.js?v=1'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
