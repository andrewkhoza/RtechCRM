<?php
namespace frontend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordFormAdmin extends Model
{
    public $password;
    public $password2;
    
    public $reCaptcha;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [], $id = NULL)
    {
        if($id == NULL){
            if (empty($token) || !is_string($token)) {
                if (Yii::$app->user->isGuest) {
                    throw new InvalidParamException('Password reset token cannot be blank.');
                }else{
                    $this->_user = User::find()->where(['id'=>Yii::$app->user->id])->one();
                    if (!$this->_user) {
                        throw new InvalidParamException('Wrong password reset token.');
                    }
                    parent::__construct($config);
                }
            }
            if (Yii::$app->user->isGuest) {
                $this->_user = User::findByPasswordResetToken($token);
            }else{
                $this->_user = User::find()->where(['id'=>Yii::$app->user->id])->one();
            }
            if (!$this->_user) {
                throw new InvalidParamException('Wrong password reset token.');
            }
            parent::__construct($config);
        }else{
            $this->_user = User::find()->where(['id'=>$id])->one();
            if (!$this->_user) {
                throw new InvalidParamException('Wrong password reset token.');
            }
            parent::__construct($config);
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            //['password', 'string', 'min' => 6],
            ['password','passwordStrength'],
            
            ['password2', 'required', 'message' => 'Password confirmation cannot be blank'],
            //['password', 'string', 'min' => 6],
            ['password2','passwordCompare'],
            
        ];
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'password2' => 'Confirm Password',
        ];
    }

    public function passwordStrength($attribute, $params)
    {
        $password_required_length = 6;
        $password = $this->$attribute;
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        //$specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || /*!$specialChars ||*/ strlen($password) < $password_required_length) {
            //$this->addError($attribute, 'Password should be at least '.$password_required_length.' characters in length and should include at least one upper case letter, one number, and one special character.');
            $this->addError($attribute, 'Password should be at least '.$password_required_length.' characters in length and should include at least one upper case letter, and one number.');
        }
        
    }
    public function passwordCompare($attribute, $params)
    {
        
        $password = $this->password;
        $password2 = $this->$attribute;

        if($password !== $password2) {
            $this->addError($attribute, 'Passwords do not match.');
        }
        
    }
    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->password = $this->password;
        $user->removePasswordResetToken();

        return $user->save();
    }
}
