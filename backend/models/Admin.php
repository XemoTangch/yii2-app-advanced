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

class Admin extends \common\models\Admin implements IdentityInterface
{
    /**
     * 添加行为
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
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