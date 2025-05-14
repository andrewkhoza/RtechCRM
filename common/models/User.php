<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UserInfo;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $reset
 * @property integer $last_reset
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_NEEDS_CONFIRMATION = 20;
    const ADMIN = 10;
    const MANAGER = 20;
    const TECHNICIAN = 30;
    const FRONT_DESK = 40;
    const SALES = 50;
    
    
    /*public static function getDb() {
        return Yii::$app->db2;
    }*/

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_NEEDS_CONFIRMATION],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_ACTIVE, self::STATUS_NEEDS_CONFIRMATION]],
            ['status', 'safe'],

            // ['role', 'default', 'value' => self::ROLE_USERS],
            ['role', 'in', 'range' => [self::ADMIN, self::MANAGER, self::TECHNICIAN, self::FRONT_DESK, self::SALES]],
            ['role', 'safe'],
            
       

            ['email', 'safe'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['reset', 'safe'],
            ['last_reset', 'safe'],
            ['created_at', 'safe'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Date Created',
            'name' => 'First Name',
            'lastname' => 'Surname',
            'cell' => 'Mobile',
        ];
    }

    public static function findIdentity($id)
    {
        return static::find()->where(['id' => $id, 'status' => self::STATUS_ACTIVE])->orWhere(['id' => $id, 'status' => self::STATUS_ACTIVE])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        $usertemp = static::find()->where(['username' => $username/*, 'status' => self::STATUS_ACTIVE*/])->orWhere(['email' => $username, 'status' => self::STATUS_ACTIVE])->one();
        if(!empty($usertemp)){
            if($usertemp->status == self::STATUS_ACTIVE){
                return $usertemp;
            }else{
                return ['type' => 'confirmation', 'data' => $usertemp];
            }
        }else{
            return false;
        }
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::find()->where([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE
        ])->orWhere([
            'password_reset_token' => $token,
            'status' => self::STATUS_NEEDS_CONFIRMATION
        ])->one();
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function getStatus()
    {
        return $this->status;
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getUserinfo()
    {
        return $this->hasOne(\app\models\UserInfo::className(), ['user_id' => 'id']);
    }
}
