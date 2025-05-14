<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use app\models\ContactInfo;

$contact = ContactInfo::findOne(1);

$this->title = 'Confirmation Successful | ' . Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Confirmation Successful';
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box /*auth-box2*/">
        <div>
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Email Confirmation</h5>
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
                            Your email address has been successfully confirmed.<br/><br/>
                            Please sign in to your account to continue.<br/>
                        </p>
                        <div class="form-group m-b-0 m-t-10">
                            <div class="col-sm-12 text-center">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/login" class="btn btn-block btn-lg btn-info"><b>SIGN IN</b></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


               
            
        </div>
    </div>
</div>