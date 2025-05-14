<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use app\models\ContactInfo;

$contact = ContactInfo::findOne(1);

$this->title = 'Confirmation Needed | ' . Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Confirmation Needed';
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box /*auth-box2*/">
        <div>
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Create Account</h5>
            </div>
            <div id="loginform">
                <div class="row">
                    <div class="col-12">
                        <?= Alert::widget() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <p>
                            A message with a confirmation link has been sent to your email address.<br/><br/>
                            Please follow the link to activate you account. Remember to check your spam folder if you can't find the email in your inbox.<br/>
                        </p>
                        <!--p>
                            If you did not receive the email, please click below to resend.<br/>
                            <br/>
                            <a href="<?= \Yii::$app->request->baseurl ?>/site/resend-email?mdf=<?= $email ?>" class="btn btn-info">Resend Email</a>
                        </p>
                        <br/>
                        <p>
                            Please contact us using the below details should you require any assistance.
                        </p>
                        <ul style="list-style-type:none;padding: 0px">
                            <li><i class="fa fa-phone" aria-hidden="true" style="margin-right: 15px;"></i><a href="tel:<?= str_replace(' ', '', $contact->tel) ?>"><?= $contact->tel ?></a></li>
                            <li><i class="fa fa-envelope" aria-hidden="true" style="margin-right: 15px;"></i><a href="mailto:<?= $contact->email ?>"><?= $contact->email ?></a></li>
                        </ul-->
                        <div class="form-group m-b-0 m-t-10">
                            <div class="col-sm-12 text-center">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/login" class="btn btn-block btn-lg btn-info"><b>SIGN IN</b></a>
                            </div>
                            <div class="col-sm-12 text-center" style="margin-top: 15px;">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/resend-email?di=5<?= $user->id ?>&token=<?= md5($user->id) ?>&mdf=<?= $user->email ?>" class="btn btn-block btn-lg btn-light"><b>RESEND EMAIL</b></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


               
            
        </div>
    </div>
</div>