<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/08/06
 * Time:  22:40
 * Desc:
 */

namespace frontend\controllers;

use yii\web\Controller;
use yii\helpers\Url;

class TestController extends Controller
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionIndex(){
        echo Url::to(['@web/vue/vue.js'],true);
    }
}