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

if(empty($model2->permissions)){
    $model2->permissions = [];
}

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */

$this->title = 'Update Super Admin';
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
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <br/>
                <?php /*if(isset($model->id) && $model->id == 1 && $model->role == 10){ ?>
                    <?php /* do nothing * ?>
                <?php }else{ ?>
                    <?= $form->field($model, 'role')->dropDownList(
                        [
                            10 => 'Admin',
                            //20 => 'Manager',
                        ],
                        ['prompt'=>'Choose a role for the user...']
                    )->label('Type of user'); ?>
                    <br/>
                <?php }*/ ?>

                <?= ''/*$form->field($model, 'reCaptcha')->widget(
                    ReCaptcha3::className(),
                    [
                        'action' => 'signups',
                    ]
                )->label(false)*/ ?>

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
                <div class="row permissionschoose" style="<?= ($model->role == 20?'':'display:none;') ?>">

                    <div class="col-12">
                        <hr/><br/>
                        <h3>Permissions</h3>
                        <br/>
                        <a class="btn btn-info selectallchecks">Check All</a>
                        <a class="btn btn-primary unselectallchecks">Uncheck All</a>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[1]" <?= (in_array(1, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Manage Clients</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[2]" <?= (in_array(2, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Client Verification</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[3]" <?= (in_array(3, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Client Balances</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[4]" <?= (in_array(4, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Client Bank Accounts</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[5]" <?= (in_array(5, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Client USD Bank Accounts</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[6]" <?= (in_array(6, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Client Wallet Addresses</div></div>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[7]" <?= (in_array(7, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Manage Deposits</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[8]" <?= (in_array(8, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Manage Withdrawals</div></div>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[9]" <?= (in_array(9, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Broker Applications</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[10]" <?= (in_array(10, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Broker Overview</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[11]" <?= (in_array(11, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Broker Trades</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[12]" <?= (in_array(12, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Broker Commissions</div></div>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[13]" <?= (in_array(13, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Liquidity Pool</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[14]" <?= (in_array(14, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Adjust LP</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[15]" <?= (in_array(15, $model2->permissions)?'checked':'') ?>/> <div class="check-label">LP History</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[16]" <?= (in_array(16, $model2->permissions)?'checked':'') ?>/> <div class="check-label">LP Alerts</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[17]" <?= (in_array(17, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Transaction History</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[18]" <?= (in_array(18, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Trading Fees</div></div>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[19]" <?= (in_array(19, $model2->permissions)?'checked':'') ?>/> <div class="check-label">ARB Applications</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[20]" <?= (in_array(20, $model2->permissions)?'checked':'') ?>/> <div class="check-label">ARB Batches</div></div>
                    </div>
                    <div class="col-4">
                        <hr/>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[21]" <?= (in_array(21, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Trading Assets</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[22]" <?= (in_array(22, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Emails</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[23]" <?= (in_array(23, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Settings</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[24]" <?= (in_array(24, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Admin/Managers</div></div>
                        <div class="check-cover"><input type="checkbox" style="" name="Permissions[25]" <?= (in_array(25, $model2->permissions)?'checked':'') ?>/> <div class="check-label">Policies</div></div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Active
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?php $model->statusselect = ($model->status == 10 ? true : false); ?>
                        <?= $form->field($model, 'statusselect')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-6">
                        Notifications
                    </div>
                    <div class="col-md-3 col-6" style="text-align: right;">
                        <?= $form->field($model2, 'notification')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ])->label(false); ?>
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
                    <?php /*if(isset($model->id) && !empty($model->id)){ ?>
                        <?= Html::a( 'Reset Password', \Yii::$app->request->baseurl.'/admin/changeuserpassword/'.$model->id, ['class' => 'btn btn-default', 'style'=>"margin-right: 8px;"]); ?>
                        <?= Html::a( 'Delete', \Yii::$app->request->baseurl.'/admin/admin-delete/'.$model->id, ['class' => 'btn btn-default btn-delete', 'style'=>"margin-right: 8px;"]); ?>
                    <?php }*/ ?>
                    <?= Html::a('Reassign', ['user-reassign', 'id' => $model2->id], ['class' => 'btn btn-info float-md-end float-none me-md-0 me-2']) ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>


<?php $this->registerJs("

    $( document ).ready(function() {
        
        $('#signupform-role').change(function(){
            if($(this).val() == 10){
                $('.permissionschoose').hide();
                $('input[type=\"checkbox\"]').attr('checked', false);
            }else{
                $('.permissionschoose').show();
            }
        });
        $('.selectallchecks').click(function(){
            $('input[type=\"checkbox\"]').attr('checked', true);
        });
        $('.unselectallchecks').click(function(){
            $('input[type=\"checkbox\"]').attr('checked', false);
        });
        
    });
"); ?>