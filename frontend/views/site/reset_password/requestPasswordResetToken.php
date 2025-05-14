<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use himiklab\yii2\recaptcha\ReCaptcha3;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
               
<div class="row g-0">
    <div class="col-xxl-3 col-lg-4 col-md-5">
        <div class="auth-full-page-content d-flex p-sm-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">
                    <div class="mb-2 mb-md-3 text-center">
                        <a href="<?= \Yii::$app->request->baseurl ?>/" class="d-block auth-logo">
                            <img src="<?= \Yii::$app->request->baseurl ?>/images/logo.png" alt="" height="100">
                            <br/>
                            <span class="logo-txt">Relevant Technologies</span>
                        </a>
                    </div>
                    <div class="auth-content my-auto">
                        <div class="text-center">
                            <h5 class="mb-0">Forgot Password</h5>
                            <br/>
                            <!--<p class="text-muted mt-2">Sign in to continue to ExiXara.</p>-->
                            <?= Alert::widget() ?>
                        </div>
                        <br/>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <p>Please enter your email address for your account. We will send you a link to your email address to reset your password.</p>
                                </div>

                                <?php $form = ActiveForm::begin(['id' => 'loginform']); ?>
                                    <?= $form->field($model, 'email')->textInput(['class' => 'form-inp form-control-lg', 'placeholder' => 'Email'])->label(false) ?>
                                                                        
                                    <br/>
                                    <div class="mb-3">
                                        <?= Html::submitButton('SUBMIT', ['id' => 'forgot-btn', 'class' => 'btn btn-primary w-100 waves-effect waves-light', 'disabled' => true]) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
            
                        
                        <div class="mt-2 text-center">
                            <p class="text-muted mb-0">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/login" class="btn btn-default w-100 waves-effect waves-light">
                                    Back to Sign In
                                </a>
                            </p>
                        </div>
                        <!--div class="mt-2 text-center">
                            <p class="text-muted mb-0">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/signup" class="btn btn-default w-100 waves-effect waves-light">
                                    Don't have an account?
                                </a>
                            </p>
                        </div-->
                    </div>
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">All Rights Reserved.<br/>Designed and Developed by <a href="https://zilo.co.za/" target="_blank">Zilo Personalisation</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-9 col-lg-8 col-md-7">
        <div class="auth-bg pt-md-5 p-4 d-flex" style="position: relative;">
            <div class="bg-overlay"></div>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</div>

<?php $this->registerJs("
    $(window).on('load',function () {
        $('#forgot-btn').removeAttr('disabled');
    });
"); ?>