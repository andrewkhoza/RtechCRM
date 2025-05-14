<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use app\models\ContactInfo;

$contact = ContactInfo::findOne(1);

$this->title = 'Confirmation Failed | ' . Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Confirmation Failed';
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box /*auth-box2*/">
        <div>
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Email Confirmation Failed</h5>
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
                            There was a problem confirming your email address.<br/><br/>
                            Please contact support to resolve this.<br/>
                        </p>
                        <div class="form-group m-b-0 m-t-10">
                            <div class="col-sm-12 text-center">
                                <a href="mailto:<?= $contact->email ?>" class="btn btn-block btn-lg btn-info"><b>CONTACT SUPPORT</b></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


               
            
        </div>
    </div>
</div>

