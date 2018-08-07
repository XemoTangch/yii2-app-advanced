<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/08/06
 * Time:  22:20
 * Desc:  vue 资源文件
 */

namespace common\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'vue/vue.js'
    ];
    public $depends = [
    ];
}