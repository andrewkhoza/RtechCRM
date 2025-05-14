<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use kartik\checkbox\CheckboxX;
//use himiklab\yii2\recaptcha\ReCaptcha3;
use himiklab\yii2\recaptcha\ReCaptcha2;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup | '.Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box /*auth-box2*/">
        <div>
            <div class="logo">
                <span class="db"><img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" /></span>
                <br/><br/>
                <h5 class="font-medium m-b-20">Create Account</h5>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= Alert::widget() ?>
                </div>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <?php $form = ActiveForm::begin(['id' => 'loginform', 'options' => ['class' => 'form-horizontal m-t-20']]); ?>
                        <div class="row">
                            <div class="col-12">
                                <?= $form->field($model, 'email')->textInput(['class' => 'form-inp form-control form-control-lg', 'placeholder' => 'Email'])->label(false) ?>
                                <p><i>Please note, your email is used as your username when trying to access your account</i></p>
                            </div>
                            <div class="col-12">
                                <?= $form->field($model, 'password', [
                                    'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password" style="cursor:pointer;"></i>']]
                                ])->passwordInput(['class' => 'form-inp form-control form-control-lg', 'placeholder' => 'Password'])->label(false) ?>
                                <p style="font-size: 12px;font-style: italic;">Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.</p>
                            </div>
                            <div class="col-12">
                                <?= $form->field($model, 'password2', [
                                    'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password-confirm" style="cursor:pointer;"></i>']]
                                ])->passwordInput(['class' => 'form-inp form-control form-control-lg', 'placeholder' => 'Confirm Password'])->label(false) ?>
                            </div>
                        </div>                        
                                       
                                      
                        <div class="form-group row">
                            <div class="col-md-12 under-login">
                                By creating an account, you declare that you have read and agree to the <a target="_blank" href="<?= \Yii::$app->request->baseurl ?>/site/terms-and-conditions">ELA Terms and Conditions</a>
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <div class="col-xs-12">
                                <?= Html::submitButton('CREATE ACCOUNT', ['class' => 'btn btn-block btn-lg btn-info', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="row under-login" style="margin-top: 15px;">
                <div class="col-sm-12 text-center">
                    <a href="<?= \Yii::$app->request->baseurl ?>/site/login">Already have an account?</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
                