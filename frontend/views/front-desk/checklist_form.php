<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use common\models\User;
use app\models\UserInfo;
use app\models\BookedDevices;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */

$this->title = 'Device CheckList | '.Yii::$app->params['siteName'];
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
                            <a href="<?= \Yii::$app->request->baseurl ?>/admin/admin-index">CheckList</a>
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
                 <h3>Checklist</h3>  
                 <br/>
                 <?php if($model->type === "Laptop"){ ?>              
                <div class="row">
                    <div class="col-md-3 col-6">
                        Wifi
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data1')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Bluetooth
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data2')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        DVD/CD Drive
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data3')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Ports
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data4')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Battery
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data5')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Charging(100%)
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data6')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Keyboard
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data7')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        HDD/SSD
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data8')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Screen
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data9')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Cracks
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data10')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Scratches
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data16')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Clean
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data11')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Screws
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data12')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Camera
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data13')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>                
                <div class="row">
                    <div class="col-md-3 col-6">
                        Hinges
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data14')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>                
                <div class="row">
                    <div class="col-md-3 col-6">
                        Sound
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data15')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>                
                <?php }else if($model->type === "Phone"){ ?>
                    <div class="row">
                    <div class="col-md-3 col-6">
                        Camera
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data1')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Ports
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data2')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Charging(100%)
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data3')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Battery
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data4')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Screen
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data5')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Sound
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data6')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Scratches
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'data7')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>                                   
                </div>
                <?php } ?>                       
          
               

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
                    <?= Html::a( 'Back', \Yii::$app->request->baseurl.'/front-desk/update-booking/'. $model->id, ['class' => 'btn btn-default cancelled', 'style'=>"margin-right: 8px;"]); ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>