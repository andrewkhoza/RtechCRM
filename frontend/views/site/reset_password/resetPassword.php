<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use himiklab\yii2\recaptcha\ReCaptcha3;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset Password';
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
                            <span class="logo-txt">Boating Syndication Australia</span>
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


                                <?php $form = ActiveForm::begin(['id' => 'loginform']); ?>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <?= $form->field($model, 'password', [
                                                'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password3" style="cursor:pointer;"></i>']]
                                            ])->passwordInput(['class' => 'form-control form-control-lg', 'placeholder' => 'New Password'])->label(false) ?>
                                            <!--<p style="font-size: 12px;font-style: italic;">Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.</p>-->
                                        </div>
                                        <div class="col-12 mb-2">
                                            <?= $form->field($model, 'password2', [
                                                'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password4" style="cursor:pointer;"></i>']]
                                            ])->passwordInput(['class' => 'form-inp form-control-lg', 'placeholder' => 'Confirm New Password'])->label(false) ?>
                                        </div>
                                    </div>
                                    <?= $form->field($model, 'reCaptcha')->widget(
                                        ReCaptcha3::className(),
                                        [
                                            'action' => 'signups',
                                        ]
                                    )->label(false) ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-block btn-lg btn-info w-100']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                        
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