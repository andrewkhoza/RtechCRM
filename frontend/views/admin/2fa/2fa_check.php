<?php

use yii\helpers\Html;
use frontend\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use himiklab\yii2\recaptcha\ReCaptcha3;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */


$this->title = 'Google 2FA';
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box /*auth-box2*/">
        <div>
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Two Factor Authentification</h5>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= Alert::widget() ?>
                </div>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12 text-center">
                    <?php $form = ActiveForm::begin(['id' => 'loginform', 'options' => ['class' => 'form-horizontal m-t-20']]); ?>

                        <h3></h3>


                        <?= $form->field($model, 'code')->textInput()->label('Google Authenticator Code') ?>




                        <div class="form-group">
                            <span class="">
                                <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary']) ?>
                            </span>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            
        </div>
    </div>
</div>

