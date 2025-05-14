<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
//use app\models\Packages;
use kartik\widgets\DatePicker;
use kartik\switchinput\SwitchInput;
use kartik\widgets\Select2;
use himiklab\yii2\recaptcha\ReCaptcha3;




/* @var $this yii\web\View */
/* @var $model app\models\Divisions */

$this->title = 'Add New User';
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
                            <a href="<?= \Yii::$app->request->baseurl ?>/admin/admin-index">Admin</a>
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

            <div class="divisions-form">

                <?php $form = ActiveForm::begin(); ?>

                <h3>User Login</h3>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <?= $form->field($model, 'test')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?php if(empty($model->id)){ ?>
                            <?= $form->field($model, 'test2')->textInput() ?>
                            <p style="font-size:12px"><i>*Password should be at least 6 characters in length and should include at least one upper case letter, and one number.</i></p>
                            <!--<p style="font-size:12px"><i>*Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.</i></p>-->
                        <?php }/*else{ ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        <?php }*/ ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-6">
                    <?= $form->field($model, 'role')->dropDownList(
                        [
                            10 => 'Admin',
                            20 => 'Manager',
                            30 => 'Technician',
                            40 => 'Front Desk',
                            50 => 'Sales',
                        ],
                        ['prompt'=>'Choose a role for the user...']
                    )->label('Type of user'); ?>
                    </div>
                </div>
                <br/>               
                <hr/>
                <br/>
                <h3>User Details</h3>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model2, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model2, 'lastname')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model2, 'cell')->textInput(['maxlength' => true])->label('Mobile Number') ?>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <br/>

                <style>
                    .check-cover{
                        display: block;
                        position: relative;
                        margin-bottom: 8px;
                    }
                    .check-cover input{
                        width: 25px;
                        height: 25px;
                        margin-top: 5px;
                        position: absolute;
                    }
                    .check-cover .check-label{
                        display: block;
                        margin-top: 0px;
                        margin: 0 0 0 35px;
                        line-height: 35px;
                    }
                    .selectallchecks, .unselectallchecks{
                        color: #FFF!important;
                        cursor: pointer;
                    }
                </style>

                <hr/>
                <br/>

                <div class="form-group">
                    <?= Html::a( 'Cancel', \Yii::$app->request->baseurl.'/admin/admin-index', ['class' => 'btn btn-default cancelled', 'style'=>"margin-right: 8px;"]); ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>


<?php $this->registerJs("

    $( document ).ready(function() {
        
        
        $('.selectallchecks').click(function(){
            $('input[type=\"checkbox\"]').attr('checked', true);
        });
        $('.unselectallchecks').click(function(){
            $('input[type=\"checkbox\"]').attr('checked', false);
        });
        
    });
"); ?>