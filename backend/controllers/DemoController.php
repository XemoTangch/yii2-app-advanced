<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/10/15
 * Time:  22:05
 * Desc:  页面模板
 */

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use backend\models\Admin;

class DemoController extends AdminController
{


    public function actionImageUpload()
    {
        return $this->render('image-upload');
    }

}