<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/08/28
 * Time:  21:39
 * Desc:  后台登录
 */

namespace backend\controllers;

use Yii;
use backend\models\AdminLogin;

class LoginController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->layout = 'login';
    }

    /**
     * 登录
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AdminLogin();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                die('1');
            }
            die($model->getFirstErrorOne());
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 退出登录
     */
    public function actionOut()
    {
        Yii::$app->user->logout();
        return $this->goLogin();
    }
    
}