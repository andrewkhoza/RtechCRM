<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
            // [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
            //     'threshold' => 0.5,
            //     'action' => 'signups',
            // ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }
            //change to mandril
            if ($user->save()) {
                
                $userinfo = \app\models\UserInfo::findOne(['user_id' => $user->id]);
                $email = new \frontend\models\Mails();
                $return = $email->sendPassEmail(4, $user->id);
                return $return;
                /*$message = \Yii::$app->controller->renderPartial('../emails/password_reset',[
                    'user' => $user,
                    'userinfo' => $userinfo,
                ]);
                return \Yii::$app->mailer->compose()
                    ->setFrom(\Yii::$app->params['websiteEmail'])
                    ->setTo($this->email)
                    ->setSubject('Password Reset | '.\Yii::$app->params['siteName'])
                    ->setHtmlBody($message)
                    ->send(); */
                
                /*return \Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();*/
            }
        }

        return false;
    }
}
