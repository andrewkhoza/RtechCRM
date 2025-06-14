<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
//use himiklab\yii2\recaptcha\ReCaptcha3;
//use himiklab\yii2\recaptcha\ReCaptcha2;



$this->title = 'Log In | '.Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Log In';
?>                 
<div class="row g-0">
    <div class="col-xxl-3 col-lg-4 col-md-5">
        <div class="auth-full-page-content d-flex p-sm-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">
                    <div class="mb-2 mb-md-3 text-center">
                        <a href="<?= \Yii::$app->request->baseurl ?>/" class="d-block auth-logo">
                            <img src="<?= \Yii::$app->request->baseurl ?>/images/rtech-logo-1.png" alt="" height="100">
                            <br/>
                            <!-- <span class="logo-txt"><h1><b>Relevant Technologies</b></h1></span> -->
                        </a>
                    </div>
                    <div class="auth-content my-auto">
                        <div class="text-center">
                            <h5 class="mb-0">Sign in</h5>
                            <br/>
                            <!--<p class="text-muted mt-2">Sign in to continue to ExiXara.</p>-->
                            <?= Alert::widget() ?>
                        </div>
                        <br/>
                        <?php $form = ActiveForm::begin(['id' => 'loginform', 'validateOnSubmit' => false, 'options' => ['class' => 'form-horizontal m-t-20']]); ?>
                            <div class="">
                                <?= $form->field($model, 'username', [
                                    'options' => ['class'=>'form-floating form-floating-custom mb-4'],
                                    'addon' => ['prepend' => ['content'=>'<i data-feather="users"></i>']]
                                ])->textInput(['class' => 'form-control', 'placeholder' => 'Email'])->label('Email') ?>
                                
                            </div>

                            <div class="">
                                <?= $form->field($model, 'password', [
                                    'options' => ['class'=>'form-floating form-floating-custom mb-4'],
                                    'addon' => [
                                        'prepend' => ['content'=>'<i data-feather="lock"></i>'],
                                        'append' => ['content'=>'<i class="mdi mdi-eye-outline font-size-18 text-muted reveal-password2"></i>']
                                    ]
                                ])->passwordInput(['class' => 'form-control pe-5', 'placeholder' => 'Password'])->label('Password') ?>
                            </div>

                            <!--div class="row mb-4">
                                <div class="col">
                                    <div class="form-check font-size-15">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label font-size-13" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div-->
                            <div style="text-align: center;">
                                <?= ''/*$form->field($model, 'reCaptcha')->widget(
                                    ReCaptcha3::className(),
                                    [
                                        'action' => 'login',
                                    ]
                                )->label(false)*/ ?>
                                <?= ''/*$form->field($model, 'reCaptcha')->widget(
                                    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                                    [
                                        //'siteKey' => 'your siteKey',
                                    ]
                                )->label(false)*/ ?>
                            </div>
                            <br/>
                            <div class="mb-3">
                                <?= Html::submitButton('Sign In', ['name' => 'login-btn', 'id' => 'login-btn', 'value' => 'login-btn', 'class' => 'btn btn-primary w-100 waves-effect waves-light'/*, 'disabled' => true*/]) ?>
                            </div>
                        <?php ActiveForm::end(); ?>

                        <!--div class="mt-4 pt-2 text-center">
                            <div class="signin-other-title">
                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                            </div>

                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                        <i class="mdi mdi-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                        <i class="mdi mdi-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                        <i class="mdi mdi-google"></i>
                                    </a>
                                </li>
                            </ul>
                        </div-->

                        <!-- <div class="mt-5 text-center">
                            <p class="text-muted mb-0">
                                Don't have an account ? <a href="<?= \Yii::$app->request->baseurl ?>/site/signup" class="text-primary fw-semibold"> Signup now </a>
                            </p>
                        </div> -->
                        <div class="mt-2 text-center">
                            <p class="text-muted mb-0">
                                <a href="<?= \Yii::$app->request->baseurl ?>/site/request-password-reset" class="/*text-primary fw-semibold*/ btn btn-default w-100 waves-effect waves-light"> Forgot Password </a>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">All Rights Reserved.<br/>Designed and Developed by <a href="#" target="_blank">Andrew Khoza</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-9 col-lg-8 col-md-7">
        <div class="auth-bg pt-md-5 p-4 d-flex" style="position: relative;">
            <!--div class="row justify-content-center align-items-center" style="width: 100%;z-index: 9;">
                <div class="text-center">
                    <div class="p-0 p-sm-4 px-xl-0">
                        <img src="<?= \Yii::$app->request->baseurl ?>/images/logo.png">
                    </div>
                </div>
            </div-->
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
            <!--div class="row justify-content-center align-items-end">
                <div class="col-xl-7">
                    <div class="p-0 p-sm-4 px-xl-0">
                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators auth-carousel carousel-indicators-rounded justify-content-center mb-0">
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                                    <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                </button>
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2">
                                    <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                </button>
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3">
                                    <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                </button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="testi-contain text-center text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                        <h4 class="mt-4 fw-medium lh-base text-white">â€œI feel confident
                                            imposing change
                                            on myself. It's a lot more progressing fun than looking back.
                                            That's why
                                            I ultricies enim
                                            at malesuada nibh diam on tortor neaded to throw curve balls.â€�
                                        </h4>
                                        <div class="mt-4 pt-1 pb-5 mb-5">
                                            <h5 class="font-size-16 text-white">Richard Drews
                                            </h5>
                                            <p class="mb-0 text-white-50">Web Designer</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="testi-contain text-center text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                        <h4 class="mt-4 fw-medium lh-base text-white">â€œOur task must be to
                                            free ourselves by widening our circle of compassion to embrace
                                            all living
                                            creatures and
                                            the whole of quis consectetur nunc sit amet semper justo. nature
                                            and its beauty.â€�</h4>
                                        <div class="mt-4 pt-1 pb-5 mb-5">
                                            <h5 class="font-size-16 text-white">Rosanna French
                                            </h5>
                                            <p class="mb-0 text-white-50">Web Developer</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="testi-contain text-center text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                        <h4 class="mt-4 fw-medium lh-base text-white">â€œI've learned that
                                            people will forget what you said, people will forget what you
                                            did,
                                            but people will never forget
                                            how donec in efficitur lectus, nec lobortis metus you made them
                                            feel.â€�</h4>
                                        <div class="mt-4 pt-1 pb-5 mb-5">
                                            <h5 class="font-size-16 text-white">Ilse R. Eaton</h5>
                                            <p class="mb-0 text-white-50">Manager
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div-->
        </div>
    </div>
</div>

<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" style="justify-content: center;">
                <h5 class="modal-title" id="exampleModalLabel">New Login Procedures</h5>

            </div>
            <div class="modal-body text-center">
                <h4 style="color: rgb(164,135,71);">*NB. Please Read</h4>
                
                <p>We have recently updated our owners portal.</p>
                <p>
                    Please sign in using your <b>Email</b> as your Username<br/>
                    and your old platform password to access your account.
                </p>
                <p>
                    You will be required to change your password when you sign in for the first time for security reasons.
                </p>
                <p>
                    You can always reset your password again in "Security Settings" once signed in.
                </p>
            </div>
            <div class="modal-footer text-center" style="justify-content: center;">
                <a type="button" class="btn btn-primary close" data-dismiss="modal" aria-label="Close">
                    Close
                </a>
            </div>

        </div>
    </div>
</div>

<?php $this->registerJs("
    $(window).on('load',function () {
        $('#login-btn').removeAttr('disabled');
        /*$('#newUser').modal('show');
        $('.close').click(function(){
            $('#newUser').modal('hide');
        });*/
    });
"); ?>