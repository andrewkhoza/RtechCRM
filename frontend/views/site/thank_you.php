<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;

$this->title = 'Thank You | '.Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Thank You';
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Thank You</h5>
                <style>
                    b {
                        font-weight: 600;
                    }
                </style>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= Alert::widget() ?>
                </div>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <p>We will be in contact with you to confirm receipt and begin processing your details.</p>
                </div>
            </div>
        </div>
    </div>
</div>
