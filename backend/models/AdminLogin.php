<?php
/**
 * Author: jiangm
 * Email: jmphper@foxmail.com
 * Date: 2018/8/31
 * Time: 15:56
 * Desc: 后台登录模型
 */

namespace backend\models;

use Yii;
use common\models\BaseModel;

class AdminLogin extends BaseModel
{
    /**
     * 接收字段
     */
    public $username;
    public $password;
    public $rememberMe = true;
    /**
     * 后台用户数据模型实例
     * @var $_user \backend\models\Admin
     */
    private $_user;

    /**
     * 登录字段验证规则
     * @return array
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 验证密码
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            /** @var Admin $user */
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }

    /**
     * 登录操作
     * @return bool
     */
    public function login()
    {
        if ($this->validate())
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        return false;
    }

    /**
     * 获取后台用户实例
     * @return Admin|null|static
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }

}