<?php
namespace console\models;

use common\models\User;
use yii\base\Model;
use console\models\UserInfo;
use console\models\EmailText;
use console\models\SysSettings;

/**
 * Password reset request form
 */
class Mails extends Model
{
    public $mailid;
    public $userid;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mailid', 'userid'], 'required'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendBirthdayEmail($mailid,$userid,$type = NULL)
    {
        $settings = SysSettings::findOne(1);
        if(empty($settings)){
            return false;
        }
        if($settings->send_emails == 0){
            return false;
        }
        if($type == 1){
            $user = User::findOne($userid);
            if(empty($user)){
                return false;
            }
            $userinfo = UserInfo::findOne(['user_id' => $userid]);
            if(empty($userinfo)){
                return false;
            }
            if($userinfo->notification == 0){
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
                'type'    =>  $type,
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
        }else{
            $userinfo = UserContacts::findOne(['id' => $userid]);
            if(empty($userinfo)){
                return false;
            }
            /*if($userinfo->notification == 0){
                return false;
            }*/
            $emailtxt = EmailText::findOne($mailid);
            if(empty($emailtxt)){
                return false;
            }
            $message = \Yii::$app->controller->renderPartial('../emails/'.$emailtxt->view,[
                'userinfo'    =>  $userinfo,
                'emailtxt'    =>  $emailtxt,
                'type'    =>  $type,
            ]);

            $subject = str_replace('[[sitename]]', \Yii::$app->params['siteName'], $emailtxt->email_subject);
            
            $send = \Yii::$app->mailer->compose()
                ->setFrom([\Yii::$app->params['websiteEmail'] => \Yii::$app->params['siteName']]);
            if($settings->send_emails == 2){
                $send->setTo([$userinfo->email]);
            }else if($settings->send_emails == 1){
                $send->setTo([$settings->send_emails_test]);
            } 
            $send->setSubject($subject);
            $send->setHtmlBody($message);
            
            $return = $send->send();
            return $return;
        }
        
    }
    
    public function sendConfirmationEmail($mailid,$bookingid)
    {
        $settings = SysSettings::findOne(1);
        if(empty($settings)){
            return false;
        }
        if($settings->send_emails == 0){
            return false;
        }
        $booking = \console\models\TrimesterBookings::findOne($bookingid);
        if(empty($booking)){
            return false;
        }
        $boat = \console\models\Boats::findOne($booking->boat_id);
        if(empty($boat)){
            return false;
        }
        if($boat->notification == 0){
            return false;
        }
        $location = \console\models\Locations::findOne($boat->location_id);
        if(empty($location)){
            return false;
        }
        $trimester = \console\models\Trimesters::findOne($booking->trimester_id);
        if(empty($trimester)){
            return false;
        }
        $user = User::findOne($booking->user_id);
        if(empty($user)){
            return false;
        }
        $userinfo = UserInfo::findOne(['user_id' => $booking->user_id]);
        if(empty($userinfo)){
            return false;
        }
        $contacts = UserContacts::findAll(['user_id' => $booking->user_id, 'is_owner' => 1]);
        
        $emailtxt = EmailText::findOne($mailid);
        if(empty($emailtxt)){
            return false;
        }
        
        
        $message = \Yii::$app->controller->renderPartial('../emails/'.$emailtxt->view,[
            'user'    =>  $user,
            'userinfo'    =>  $userinfo,
            'booking'    =>  $booking,
            'boat'    =>  $boat,
            'location'    =>  $location,
            'trimester'    =>  $trimester,
            'emailtxt'    =>  $emailtxt,
        ]);
        
        $subject = str_replace('[[sitename]]', \Yii::$app->params['siteName'], $emailtxt->email_subject);
        $subject = str_replace('[[boat]]', (!empty($boat)?$boat->name.' '.$boat->model:""), $subject);
        $subject = str_replace('[[name]]', (!empty($userinfo)&&!empty($userinfo->name)?$userinfo->name:"Client"), $subject);
        $subject = str_replace('[[lastname]]', (!empty($userinfo)&&!empty($userinfo->lastname)?$userinfo->lastname:""), $subject);
        $subject = str_replace('[[booking_date]]', date('d/m/Y', strtotime($booking->date)), $subject);
        
        $return = null;
        
        if(!empty($contacts)){
            foreach ($contacts as $key => $contact) {
                if($contact->notification != 0 && !empty($contact->email)){
                    $send = \Yii::$app->mailer->compose()
                        ->setFrom([\Yii::$app->params['websiteEmail'] => \Yii::$app->params['siteName']]);
                    if($settings->send_emails == 2){
                        $send->setTo([$contact->email]);
                    }else if($settings->send_emails == 1){
                        $send->setTo([$settings->send_emails_test]);
                    } 
                    $send->setSubject($subject);
                    $send->setHtmlBody($message);

                    $return = $send->send();
                }
            }
        }
        if($userinfo->notification != 0){
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
        }
            
        return $return;
        
    }
    public function sendNominationsEmail($mailid,$userid, $shareid, $trimesterid)
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
        if($userinfo->notification == 0){
            return false;
        }
        $trimester = \console\models\Trimesters::findOne(['id' => $trimesterid]);
        if(empty($trimester)){
            return false;
        }
        $usershares = \console\models\UserShares::findOne(['id' => $shareid]);
        if(empty($usershares)){
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
            'usershares'    =>  $usershares,
            'trimester'    =>  $trimester,
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
}
