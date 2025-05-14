<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const SCENARIO_NOPASS = 'nopass';
    
    public $username;
    public $email;
    public $password;
    public $password2;
    public $role;
    public $date;
    public $status;

    
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*['username', 'filter', 'filter' => 'trim'],
            ,
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],*/
            ['username', 'safe'],

            // ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            // ['role', 'filter', 'filter' => 'trim'],
            ['role', 'required'],
            ['role', 'integer', 'min' => 10, 'max' => 50],
            
            // ['status', 'filter', 'filter' => 'trim'],
            ['status', 'safe'],
            ['status', 'integer', 'min' => 0, 'max' => 20],
            // ['statusselect', 'filter', 'filter' => 'trim'],

            ['password', 'required'],
            //['password', 'string', 'min' => 6],
            ['password','passwordStrength'],
            
            ['password2', 'required'],
            ['password2','passwordCompare'],
            
            [['username', 'email'], 'required', 'on' => self::SCENARIO_NOPASS],
            
            ['date', 'safe'],
            
            // verifyCode needs to be entered correctly
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                'threshold' => 0.5,
                'action' => 'signups',
            ],*/
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'uncheckedMessage' => 'Please confirm that you are not a robot.'
            ],*/
        ];
    }

    public function passwordStrength($attribute, $params)
    {
        $password_required_length = 6;
        $password = $this->$attribute;
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        // //$specialChars = preg_match('@[^\w]@', $password);

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
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_NOPASS] = ['username', 'email'];

        return $scenarios;
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($role,$status = NULL)
    {
        $this->role = $role;
        if(!empty($status)){
            $this->status = $status;
        }else{
            $this->status = 10;
        }
        $this->validate();          
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->email;            
            $user->role = $role; 
            $user->status = $this->status;
            
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            
            return $user;
        }
        

        return false;
    }
    
    
    public function attributeLabels()
    {
        return [
            'password2' => 'Confirm Password',
        ];
    }
}
