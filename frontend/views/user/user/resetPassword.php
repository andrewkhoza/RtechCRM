<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use frontend\widgets\Alert;
use himiklab\yii2\recaptcha\ReCaptcha3;

$usrinfo = app\models\UserInfo::findOne(['user_id' => \Yii::$app->user->id]);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

if($usrinfo->pass_changed == 0){
    $this->title = 'First Time Login';
}else{
    $this->title = 'Reset Password';
}
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
                        <li class="breadcrumb-item">
                            <a>Settings</a>
                        </li>
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
<div class="card card-body">
    
    <div class="row">
        <div class="col-12">
            <?php  ?>
            <?php if($usrinfo->pass_changed == 0){ ?>
                <br/>
                <h6>For security reasons, we require you to change your password when you first sign in to your account.</h6>
                <hr/>
                <br/>
            <?php } ?>
            <p>Please choose a new password:</p>
            <p style="font-size:12px"><i>*Password should be at least 6 characters in length and should include at least one upper case letter, and one number.</i></p>
            <!--<p style="font-size:12px"><i>*Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.</i></p>-->

            
            <?php $form = ActiveForm::begin([
                'id' => 'reset-password-form',
                /*'enableClientValidation' => true,
                'options' => [
                    'validateOnSubmit' => true,
                    'class' => 'form'
                ],*/
            ]); ?>
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($model, 'password', [
                            'enableAjaxValidation' => true,
                            'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password3" style="cursor:pointer;"></i>']]
                        ])->passwordInput(['class' => 'form-control', 'placeholder' => 'New Password'])->label(false) ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'password2', [
                            'enableAjaxValidation' => true,
                            'addon' => ['append' => ['content'=>'<i class="fa fa-eye reveal-password4" style="cursor:pointer;"></i>']]
                        ])->passwordInput(['class' => 'form-inp', 'placeholder' => 'Confirm New Password'])->label(false) ?>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-secondary createrandompass">Generate Password</a> 
                    </div>
                </div>
                
                <br/>
                

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                    <?php if($usrinfo->pass_changed != 0){ ?>
                        <a class="btn btn-info float-end" href="<?= \Yii::$app->request->baseurl ?>/user/security" style="cursor: pointer;">Back</a>
                    <?php } ?>
                    
                </div>
            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>


<?php $this->registerJs("
    function randomPassword(length) {
        var chars1 = \"abcdefghijklmnopqrstuvwxyz\";
        var chars2 = \"!@#$%^&*()-+<>\";
        var chars3 = \"ABCDEFGHIJKLMNOPQRSTUVWXYZ\";
        var chars4 = \"1234567890\";
        var pass = \"\";
        for (var x = 0; x < Math.ceil(length/4); x++) {
            var i = Math.floor(Math.random() * chars1.length);
            pass += chars1.charAt(i);
            var i = Math.floor(Math.random() * chars2.length);
            pass += chars2.charAt(i);
            var i = Math.floor(Math.random() * chars3.length);
            pass += chars3.charAt(i);
            var i = Math.floor(Math.random() * chars4.length);
            pass += chars4.charAt(i);
        }
        return pass;
    }
    $(window).on('load',function () {
        $('.createrandompass').click(function(){
        console.log('test');
            var passwordgen = randomPassword(10);
            /*$('.randompassshow').show();
            $('.randompassshow').val(passwordgen);*/
            $('#resetpasswordformadmin-password').val(passwordgen);
            $('#resetpasswordformadmin-password').attr('type','text');
            $('#resetpasswordformadmin-password2').val(passwordgen);
            $('#resetpasswordformadmin-password2').attr('type','text');
        });
    });
"); ?>