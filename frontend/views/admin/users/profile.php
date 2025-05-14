<?php

use yii\helpers\Html;
use frontend\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use himiklab\yii2\recaptcha\ReCaptcha3;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model app\models\Divisions */

$this->title = 'Update My Profile';
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
                            <a>Dashboard</a>
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

                    

                    <div class="row">
                        <div class="col-12 mb-2">
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2">
                            <?= $form->field($userinfo, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <?= $form->field($userinfo, 'lastname')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2">
                            <?= $form->field($userinfo, 'cell')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>  
                    <br/>
                    <hr/>

                    <div class="form-group">
                        <?= Html::a( 'Cancel', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
                        <span class="float-right">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                        </span>
                    </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>

