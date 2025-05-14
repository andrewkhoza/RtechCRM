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
                <h5 class="font-medium m-b-20">Email Confirmation Needed</h5>
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
                            You have not yet confirmed your email. Please resend the email confirmation if you have not yet received this.<br/>
                            A message with a confirmation link will be sent to your email address.<br/><br/>
                            Please follow the link to activate you account. Remember to check your spam folder if you can't find the email in your inbox.<br/>
                        </p>
                        <div class="form-group m-b-0 m-t-10">
                            <div class="col-sm-12 text-center" style="margin-top: 15px;">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/resend-email2?di=5<?= $user->id ?>&token=<?= md5($user->id) ?>&mdf=<?= $user->email ?>" class="btn btn-block btn-lg btn-info"><b>SEND CONFIRMATION EMAIL</b></a>
                            </div>
                            <div class="col-sm-12 text-center">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/login" class="btn btn-block btn-lg btn-light"><b>SIGN IN</b></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


               
            
        </div>
    </div>
</div>