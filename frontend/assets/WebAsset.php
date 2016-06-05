<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class WebAsset extends AssetBundle
{
    public $sourcePath = 'public/frontend';
    public $basePath = '@webroot/public/frontend';
    public $baseUrl = '@web/public/frontend';
    public $css = [
        'css/style.css',
        'css/reset.css',
        'css/animate.css',
        'css/magnific-popup.css',
        'css/salvattore.css',
    ];
    public $js = [
        'js/mainmenu/ddsmoothmenu.js',
        'js/mainmenu/jquery-1.7.1.min.js',
        'js/mainmenu/selectnav.js',
        'js/mainmenu/scripts.js',

        'js/jquery.min.js',
        'js/jquery.waypoints.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/salvattore.min.js',
        'js/main.js',
    ];
    /*public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];*/
}
