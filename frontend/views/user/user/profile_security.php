<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;
//use Da\TwoFA\Service\TOTPSecretKeyUriGeneratorService;  
use Da\TwoFA\Service\QrCodeDataUriGeneratorService;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserDepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$totpUri = (new TOTPSecretKeyUriGeneratorService('BSA', $user->email, $model->secret))->run();
//$qrurl = (new QrCodeDataUriGeneratorService($totpUri))->run();


$this->title = 'Security';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-12" style="padding:0 20px;">
<?= Alert::widget() ?>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header" >
                    <h6>Password</h6>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <p>Password: ***********</p>
                        </div>
                        <div class="col-md-6 text-right">
                                <a href="<?= \Yii::$app->request->baseurl ?>/user/changepassword" class="btn btn-light">RESET PASSWORD</a>
                            
                        </div>
                    </div>
                        
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header" >
                    <h6>Disable Account</h6>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <p>Think your account has been compromised?</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <?= Html::a('Disable Account', ['//user/disable'], ['class' => 'btn btn-light']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--div class="card mb-3">
                <div class="card-header" >
                    <h6>2FA</h6>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <?php if(empty($userinfo->twofa_secret)){ ?>
                                <p>Setup two-factor authentication as an extra layer of security for your account.</p>
                            <?php }else{ ?>
                                <i class="fas fa-check-circle" style="font-size: 35px;color: #3cbfae;display: inline-block;position: absolute;"></i><p style="margin-left: 50px;"> Your two-factor authentication has been setup for your account</p>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if(empty($userinfo->twofa_secret)){ ?>
                                <a class="btn btn-info enable2fa" style="cursor: pointer;">ENABLE 2FA</a>
                            <?php }else{ ?>
                                <a class="btn btn-light disable2fa" style="cursor: pointer;">MANAGE</a>
                            <?php } ?>
                            
                        </div>
                    </div>
                        
                </div>
            </div-->
            <!--div class="card">
                <div class="card-header" >
                    <h6>Anti-Phishing</h6>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <?php /*if(empty($userinfo->anti_phish_code)){ ?>
                                <p>Setup Anti-Phishing code as an extra layer of security for your account.</p>
                            <?php }else{ ?>
                                <p><i class="fas fa-check-circle" style="font-size: 28px;color: #3cbfae;"></i> Your Anti-Phishing code has been setup for your account</p>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if(empty($userinfo->anti_phish_code)){ ?>
                                <a class="btn btn-info enableaph" style="cursor: pointer;">Enable Anti-Phishing</a>
                            <?php }else{ ?>
                                <a class="btn btn-light disableaph" style="cursor: pointer;">Manage</a>
                            <?php }*/ ?>
                            
                        </div>
                    </div>
                        
                </div>
            </div-->
            <!--div class="card">
                <div class="card-header" >
                    <h6>Login History</h6>
                </div>
                <div class="card-body" >
                    <table class="table table-sm">
                        <tbody>
                            <?php foreach ($history as $key => $histor) { ?>
                                <tr>
                                    <td style="<?= ($key==0?'border-top: 0px':'') ?>"><b><?= $histor->device ?></b> </td>
                                    <td style="<?= ($key==0?'border-top: 0px':'') ?>"><?= $histor->ip_address ?> </td>
                                    <td class="text-right" style="<?= ($key==0?'border-top: 0px':'') ?>"><?= $histor->date ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                        
                </div>
            </div-->
                
        </div>
    </div>

</div>

<div class="modal fade" id="enable2fa" tabindex="-1" role="dialog" aria-labelledby="enable2fa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Setup Authenticator App</h5>
            
        </div>
        <div class="modal-content text-center">
            <?php $form = ActiveForm::begin(); ?>
                <h3>Scan the QR Code</h3>
                <div class="">
                    <img src="<?= ''/*$qrurl*/ ?>" style="max-width: 250px;" class="img-responsive"/>
                    <br/>
                    Account Name: BSA
                    <br/>
                    Your Key: <?= $model->secret ?>
                </div>
                <?= $form->field($model, 'secret')->hiddenInput()->label(false) ?>
                <p>Install an authenticator app on your mobile device if you don't already have one. Scan the QR code with the authenticator.</p>
                <br/>
                <p>Enter the verification code from your authenticator app:</p>
                <?= $form->field($model2, 'code')->textInput(['placeholder' => '2FA Code'])->label(false) ?>
                <!--<p>Recovery code: ARB<?= $model->secret ?>X</p>-->
                <br/>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a type="button" class="btn btn-light close" data-dismiss="modal" aria-label="Close">
                                Cancel
                            </a>
                        </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Enable 2FA', ['class' => 'btn btn-success', 'name' => 'enable', 'value' => 1]) ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="enableaph" tabindex="-1" role="dialog" aria-labelledby="enableaph" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Setup Anti-Phishing</h5>
            
        </div>
        <div class="modal-content text-center">
            <?php $form = ActiveForm::begin(); ?>
                <h3>Enter Anti-Phishing Code</h3>
                
                <p>Enter the Anti-Phishing code that you want to appear on all emails to prevent spam and secure your account:</p>
                <?= ''/*$form->field($userinfo, 'anti_phish_code')->textInput(['placeholder' => 'Anti-Phishing Code'])->label(false)*/ ?>
                <br/>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a type="button" class="btn btn-light btn-block close" data-dismiss="modal" aria-label="Close">
                                Cancel
                            </a>
                        </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Enable Anti-Phishing', ['class' => 'btn btn-success btn-block', 'name' => 'enableaph', 'value' => 1]) ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="disable2fa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Disable Authenticator App</h5>
            
        </div>
        <div class="modal-content text-center">
            <?php $form = ActiveForm::begin(); ?>
                
                <p>Are you sure you want to disable 2FA? If 2FA is not enables, your account will be less secure and you will not be able to withdraw from your account.</p>
                <br/>
                <p>Please enter the 2FA code from your aithentication app to disable 2FA:</p>
                <?= $form->field($model2, 'code')->textInput(['placeholder' => '2FA Code'])->label(false) ?>
                <!--br/>
                <p>Dont have access to your app or changed phones? Use your recovery key to unlock:</p>
                <?= ''/*$form->field($model2, 'recovery')->textInput(['placeholder' => 'Recovery Key'])->label(false)*/ ?>
                <br/-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a type="button" class="btn btn-light btn-block close" data-dismiss="modal" aria-label="Close">
                                Cancel
                            </a>
                        </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Disable 2FA', ['class' => 'btn btn-success btn-block', 'name' => 'disable', 'value' => 1]) ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<style>
    .modal-header{
        background-color: #FFF;
        display: block;
        text-align: center;
    }
    .modal-content{
        border: 0px;
        padding: 20px;
    }
    .modal-content .close{
        float: none;
        font-size: inherit;
        color: inherit;
        text-shadow: none;
        opacity: inherit;
        font-weight: inherit;
    }
</style>
<?php $this->registerJs("

    $( document ).ready(function() {
        
        $('.disable2fa').click(function(){
            $('#disable2fa').modal('show');
        });
        $('.enable2fa').click(function(){
            $('#enable2fa').modal('show');
        });
        
        $('.disableaph').click(function(){
            $('#enableaph').modal('show');
        });
        $('.enableaph').click(function(){
            $('#enableaph').modal('show');
        });
        
    });
"); ?>



                        