<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/08/22
 * Time:  21:52
 * Desc:  后台控制器基类
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;


class BaseController extends Controller
{
    public function init()
    {
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function goLogin()
    {
        $this->redirect('/login');
    }
    
}