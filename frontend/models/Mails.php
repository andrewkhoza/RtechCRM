<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use app\models\UserInfo;
use app\models\Clients;
use app\models\Quotations;
use app\models\EmailText;
use app\models\SysSettings;
use Yii;

/**
 * Password reset request form
 */
class Mails extends Model
{
    public $mailid;
    public $userid;
    public $fileid;
   

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mailid', 'userid'], 'required'],
            [['fileid'], 'string'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
   
    public function sendEmail($mailid,$userid)
    {
        $settings = SysSettings::findOne(1);
        if(empty($settings)){
            return false;
        }
        if($settings->send_emails == 0){
            return false;
        }
        $user = User::findOne($userid);
        if(empty($user)){
            return false;
        }
        $userinfo = UserInfo::findOne(['user_id' => $userid]);
        if(empty($userinfo)){
            return false;
        }
        $emailtxt = EmailText::findOne($mailid);
        if(empty($emailtxt)){
            return false;
        }
        $message = \Yii::$app->controller->renderPartial('../emails/'.$emailtxt->view,[
            'user'    =>  $user,
            'userinfo'    =>  $userinfo,
            'emailtxt'    =>  $emailtxt,
        ]);
        
        $subject = str_replace('[[sitename]]', \Yii::$app->params['siteName'], $emailtxt->email_subject);
        
        $send = \Yii::$app->mailer->compose()
            ->setFrom([\Yii::$app->params['websiteEmail'] => \Yii::$app->params['siteName']]);
        if($settings->send_emails == 2){
            $send->setTo([$user->email]);
        }else if($settings->send_emails == 1){
            $send->setTo([$settings->send_emails_test]);
        } 
        $send->setSubject($subject);
        $send->setHtmlBody($message);

        $return = $send->send();
        return $return;
        
    }
    public function sendQuotation($mailid,$userid,$fileid)
    {        
        $user = Clients::findOne($userid);
        if(empty($user)){
            return false;
        }        
        $emailtxt = EmailText::findOne($mailid);
        if(empty($emailtxt)){
            return false;   
        }
        $message = \Yii::$app->controller->renderPartial('//emails/'.$emailtxt->view,[
            'user'    =>  $user,
            'emailtxt'    =>  $emailtxt,
        ]);
        
        $subject = str_replace('[[sitename]]', \Yii::$app->params['siteName'], $emailtxt->email_subject);
        $quotation = Quotations::findOne($fileid);
        $send = \Yii::$app->mailer->compose()
            ->setFrom([\Yii::$app->params['websiteEmail'] => \Yii::$app->params['siteName']]);   
        $send->setTo($user->email);     
        $send->setSubject($subject);
        $send->setHtmlBody($message);
        $send->attach(Yii::getAlias('@webroot/quotes/' . $quotation->path), ['contentType/pdf']);


        $return = $send->send();
        return $return;
        
    }

     public function sendPassEmail($mailid,$userid)
    {
        $user = User::findOne($userid);
        if(empty($user)){
            return false;
        }
        $userinfo = UserInfo::findOne(['user_id' => $user->id]);
        if(empty($userinfo)){
            return false;
        }
        $emailtxt = EmailText::findOne($mailid);
        if(empty($emailtxt)){
            return false;
        }
        
        $resetLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
        $message = \Yii::$app->controller->renderPartial('../emails/'.$emailtxt->view,[
            'user'    =>  $user,
            'userinfo'    =>  $userinfo,
            'resetLink'    =>  $resetLink,
            'emailtxt'    =>  $emailtxt,
        ]);
        
        $subject = str_replace('[[sitename]]', \Yii::$app->params['siteName'], $emailtxt->email_subject);
        
        return \Yii::$app->mailer->compose()
            ->setFrom([\Yii::$app->params['websiteEmail'] => \Yii::$app->params['siteName']])
            ->setTo([$user->email])
            // ->setCC(['ethan@zilo.co.za'])
            ->setCC(['andrew.khoza@zilo.co.za'])
            ->setSubject($subject)
            ->setHtmlBody($message)
            ->send();
        
    }

}
