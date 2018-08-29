<?php
/**
 * User:  jiangm
 * Email: jmphper@foxmail.com
 * Date:  2018/08/22
 * Time:  21:27
 * Desc:  后台管理员模型
 */

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;

class Admin extends \common\models\Admin implements IdentityInterface
{
    public $password;
    public $rememberMe = true;
    /** @var  Admin */
    public static $_user;
    
    /**
     * 添加行为
     * @return array
     */
    public function behaviors()
    {
        return [
            // 处理新增和修改时间
            TimestampBehavior::class,
        ];
    }


    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['username', 'validateUsername'],
            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
        ]);
    }

    /**
     * 用户信息保存前操作
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * 验证用户名
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
    {
        $res = $this->getUserByUserName($this->username);
        if(!$res) $this->addError($attribute, '用户不存在，请重新输入用户名');
    }

    /**
     * 验证密码
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $res = Yii::$app->security->validatePassword($this->password, $this->password_hash);
        if(!$res) $this->addError($attribute, '密码输入错误请重新输入');
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 登录
     * @return bool
     */
    public function login()
    {
        $user = $this->getUserByUserName($this->username);
        if (!$user->validate()){
            echo '<pre>';
            print_r($user->getErrors());
            echo '</pre>';
        }else{
            echo '<pre>';
            print_r($user->getErrors());
            echo '</pre>';
        }
        return false;
        $_duration = $this->rememberMe ? 3600 * 24 * 30 : 0;
        return Yii::$app->user->login($user, $_duration);
    }
    
    /**
     * 通过用户名获取用户信息
     * @param $username
     * @return null|static
     */
    public function getUserByUserName($username)
    {
        return static::findONe(['username' => $username]);
    }


    /** 实现接口 IdentityInterface */

    /**
     * 通过用户id获取用户信息
     * @param int|string $id
     * @return ActiveRecord|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 通过access_token获取用户信息
     * @param mixed $token
     * @param null $type
     * @return ActiveRecord|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * 获取当前用户id
     * @return int|string 当前用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string 当前用户的（cookie）认证密钥
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}