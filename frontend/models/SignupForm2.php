<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form 2
 */
class SignupForm2 extends Model
{
    const SCENARIO_NOPASS = 'nopass';
    const SCENARIO_AJAX = 'ajax';
    
    public $username;
    public $test;
    public $test2;
    //public $password2;
    public $role;
    public $date;
    public $package;
    public $status;
    public $statusselect;

    
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'safe'],
            ['test','uniqueEmail'],

            ['test', 'required'],
            ['test', 'email'],
            // ['test', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['role', 'required'],
            ['role', 'integer', 'min' => 10, 'max' => 50],
            
            ['status', 'safe'],
            ['status', 'integer', 'min' => 0, 'max' => 20],

            ['test2', 'required'],
            ['test2', 'string', 'min' => 6],
            ['test2','passwordStrength'],
            
            [['username', 'test'], 'required', 'on' => self::SCENARIO_NOPASS],
            
            ['date', 'safe'],
            
          
        ];
    }

    public function passwordStrength($attribute, $params)
    {
        $password_required_length = 6;
        $password = $this->$attribute;
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < $password_required_length) {
            $this->addError($attribute, 'Password should be at least '.$password_required_length.' characters in length and should include at least one upper case letter, one number, and one special character.');
            $this->addError($attribute, 'Password should be at least '.$password_required_length.' characters in length and should include at least one upper case letter, and one number.');
        }
        
    }
    public function uniqueEmail($attribute, $params)
    {
        
        $enteredEmail = $this->$attribute;
        
        $user = User::findOne(['email' => $enteredEmail]);

        if(!empty($user)) {
            $this->addError($attribute, 'This email address has already been taken.');
        }
        
    }
    public function passwordCompare($attribute, $params)
    {
        
        $password = $this->test2;
        $password2 = $this->$attribute;

        if($password !== $password2) {
            $this->addError($attribute, 'Passwords do not match.');
        }
        
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_NOPASS] = ['username', 'test'];
        $scenarios[self::SCENARIO_AJAX] = ['test', 'test2', 'role', 'status', 'statusselect'];

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
            $this->status = 20;
        }
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->test;
            $user->role = $role;
            $user->status = $this->status;
            
            $user->email = $this->test;
            $user->setPassword($this->test2);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }
        

        return false;
    }
    
    
    public function attributeLabels()
    {
        return [
            'test' => 'Email',
            'test2' => 'Password',
            'password2' => 'Confirm Password',
        ];
    }
}
