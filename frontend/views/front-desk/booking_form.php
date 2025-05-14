<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use common\models\User;
use app\models\UserInfo;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */


$this->title = 'Book In A Device | '.Yii::$app->params['siteName'];
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
                            <a href="<?= \Yii::$app->request->baseurl ?>/admin/admin-index">Front Desk</a>
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

                <h3>Client Details</h3>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?= $form->field($model, 'lastname')->textInput() ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4 col-6">
                    <?= $form->field($model, 'email')->textInput()  ?>
                    </div>
                    <div class="col-md-4 col-6">
                    <?= $form->field($model, 'cell')->textInput()  ?>
                    </div>
                    <div class="col-md-4 col-6">
                    <?= $form->field($model, 'alt_cell')->textInput()  ?>
                    </div>
                </div>
                <br/>               
                <hr/>
                <br/>
                 <h3>Device Details</h3>
                <div class="row mb-3">
                    <div class="col-md-3 col-6">
                        <?= $form->field($model2, 'type')->dropDownList(
                                [
                                    'Phone' => 'Phone',
                                    'Laptop' => 'Laptop',
                                    'Desktop' => 'Desktop',
                                    'Console' => 'Console',
                                ],
                                ['prompt'=>'Choose the type of device...']
                            )->label('Type of device'); 
                        ?>
                    </div>
                    <div class="col-md-3 col-6">
                        <?= $form->field($model2, 'brand')->textInput() ?>
                    </div>
                    <div class="col-md-3 col-6">
                        <?= $form->field($model2, 'model')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3 col-6">
                        <?= $form->field($model2, 'colour')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Assessment Fee
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?php if(isset($model2->assessment_fee) && $model2->assessment_fee === "Paid"){                                                        
                                $model2->assessment_fee = 1;
                        ?>
                        <?= $form->field($model2, 'assessment_fee')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                        <?php }else{?>

                            <?= $form->field($model2, 'assessment_fee')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                        <?php } ?>
                    </div> 
                    <div class="col-md-2 col-6">
                        Branch
                    </div>
                    <div class="col-md-4 col-6">
                        <?= $form->field($model2, 'branch')->dropDownList(
                                [
                                    'UMP' => 'UMP',
                                    'Nelspruit' => 'Nelspruit',
                                ],
                                ['prompt'=>'Select the branch...']
                            )->label(false); 
                        ?>
                    </div>                   
                </div>
                <br/>
                <hr/>
                <br/>
                 <h3>Device Issues</h3>
                <div class="row">
                    <div class="col-md-8 col-6">
                        <?= $form->field($model3, 'problem')->textArea(['rows'=>3])->label('Issues experienced by client')
                        ?>
                    </div>
                    <div class="col-md-4 col-6">
                        <?= $form->field($model3, 'password')->textInput()
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($model3, 'notes')->textArea(['rows'=>3])
                        ?>
                    </div>
                </div>
                <br/>
                <hr/>
                <br/>
                 <h3>Assigned Technician</h3>
                <div class="row">
                    <div class="col-md-4 col-6">
                    <?php
                        echo $form->field($model2, 'technician_id')->label('Technician Name')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(UserInfo::find()
                                ->joinWith('user')
                                ->where(['user.role'=>30])
                                ->all(),'id',function($technician){
                                return $technician->name;
                            }),
                            'options' => ['placeholder' => 'Select a technician ...','id'=>'technician-name'],
                            'pluginOptions' => [
                                'allowClear' => true
                        ], ]);
                        ?>
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
                    <?= Html::a( 'Cancel', \Yii::$app->request->baseurl.'/front-desk/index', ['class' => 'btn btn-default cancelled', 'style'=>"margin-right: 8px;"]); ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>