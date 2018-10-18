<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/10/17
 * Time:  22:34
 * Desc:
 */

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery/dist';
    public $js = [
        'jquery.js',
    ];
    public $jsOptions = ['position' => View::POS_HEAD];
}