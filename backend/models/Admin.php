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
        static::$_user = $this->getUserByUserName($this->username);
        echo '<pre>';
        print_r(static::$_user);
        echo '</pre>';exit;
        if(!static::$_user) $this->addError($attribute, '用户不存在，请重新输入用户名');
    }

    /**
     * 验证密码
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        echo '<pre>';
        print_r(static::$_user);
        echo '</pre>';exit;
        $res = Yii::$app->security->validatePassword($this->password, static::$_user->password_hash);
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
        if (!$this->validate() || !static::$_user) return false;
        $_duration = $this->rememberMe ? 3600 * 24 * 30 : 0;
        return Yii::$app->user->login(static::$_user, $_duration);
    }
    
    /**
     * 通过用户名获取用户信息
     * @param $username
     * @return null|static
     */
    public function getUserByUserName($username)
    {
        static::$_user = static::findONe(['username' => $username]);
        return static::$_user;
    }


    /** 实现接口 IdentityInterface */

    /**
     * 通过用户id获取用户信息
     * @param int|string $id
     * @return ActiveRecord|null
     */
    public static function findIdentity($id)
    {
        static::$_user =  static::findOne($id);
        return static::$_user;
    }

    /**
     * 通过access_token获取用户信息
     * @param mixed $token
     * @param null $type
     * @return ActiveRecord|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        static::$_user = static::findOne(['access_token' => $token]);
        return static::$_user;
    }

    /**
     * 获取当前用户id
     * @return int|string 当前用户ID
     */
    public function getId()
    {
        return static::$_user->id;
    }

    /**
     * @return string 当前用户的（cookie）认证密钥
     */
    public function getAuthKey()
    {
        return static::$_user->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return static::$_user->getAuthKey() === $authKey;
    }
}