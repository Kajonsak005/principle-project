<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $username
 * @property string|null $password
 * @property string|null $money
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $rememberMe;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'username', 'password', 'money'], 'string', 'max' => 255],
            ['rememberMe','boolean']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'username' => 'Username',
            'password' => 'Password',
            'rememberMe' => 'Remember Me',
            'money' => 'Money',
        ];
    }

        function hashPassword() {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }

    function checkPassword() {
        $model = Users::find()->where(['username' => $this->username])->one();
        if(!$model) {
            return false;
        }

        if(password_verify($this->password,$model->password)) {
            return true;
        } 
        return false;
    }

    // login interface session

    public static function login()
    {
        return $login = Yii::$app->user->login(Users::find()->where(['username' => $model->username])->one(), $this->rememberMe ? 3600*24*30 : 0);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}