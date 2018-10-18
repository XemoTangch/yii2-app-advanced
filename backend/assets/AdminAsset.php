<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'metronic/vendors/base/vendors.bundle.css',
        'metronic/demo/default/base/style.bundle.css',
    ];
    public $js = [
        'metronic/vendors/base/vendors.bundle.js',
        'metronic/demo/default/base/scripts.bundle.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
