<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ApplicantAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        '/css/all.min.css'
    ];
    public $js = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        '/js/all.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        #'yii\bootstrap\BootstrapAsset',
    ];

}