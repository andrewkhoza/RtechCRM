<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use common\models\User;
use app\models\UserInfo;
use app\models\Clients;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */

$this->title = 'Book In A Device | '.Yii::$app->params['siteName'];

$clientList = ArrayHelper::map(Clients::find()->all(), 'id', function($client){
                                return $client->name." ".$client->lastname." ".$client->cell;
                            });
$clientList['__add_new__'] = '+ New Client';
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
                    <div class="col-md-6 col-12" id="client-select-wrapper">
                        <?= $form->field($model, 'id')->label('Client Name')->widget(Select2::classname(), [
                            'data' => $clientList,
                            'options' => ['placeholder' => 'Select a client...', 'id' => 'client-name'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'matcher' => new JsExpression(<<<JS
                                    function(params, data) {
                                        if ($.trim(params.term) === '') {
                                            return data;
                                        }

                                        // Always show 'Add New Client'
                                        if (data.id === '__add_new__') {
                                            return data;
                                        }

                                        // Normal search behavior
                                        if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                                            return data;
                                        }

                                        return null;
                                    }
                                JS),
                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-6 col-12" id="client-input-wrapper" style="display:none;">
                        <?= $form->field($model, 'name')->textInput(['id' => 'client-name-input','disabled' => true]) ?>
                    </div>
                    <div class="col-md-6 col-12" id="lastname">
                        <?= $form->field($model, 'lastname')->textInput(['id'=>'lastname']) ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4 col-6" id="email">
                    <?= $form->field($model, 'email')->textInput(['id'=>'email'])  ?>
                    </div>
                    <div class="col-md-4 col-6" id="cell">
                    <?= $form->field($model, 'cell')->textInput(['id'=>'cell'])  ?>
                    </div>
                    <div class="col-md-4 col-6" id="alt_cell">
                    <?= $form->field($model, 'alt_cell')->textInput(['id'=>'alt_cell'])  ?>
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
                 <h3>Technician Information</h3>
                <div class="row">
                    <div class="col-md-2 col-6">
                    <?php
                        echo $form->field($model2, 'technician_id')->label('Assign Technician')->widget(Select2::classname(), [
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
                   <?php

                    $technicianDeviceCount = [];

                    // Count devices per technician
                    foreach ($devices as $device) {
                        $technician = UserInfo::findOne(['id' => $device->technician_id]);
                        if ($technician) {
                            $name = $technician->name;
                            if (!isset($technicianDeviceCount[$name])) {
                                $technicianDeviceCount[$name] = 0;
                            }
                            $technicianDeviceCount[$name]++;
                        }
                    }
                    ?>

                    <?php foreach ($technicianDeviceCount as $technicianName => $count){ ?>
                        <div class="col-md-2">
                            <div class="form-control mt-4">
                                <?= Html::encode($technicianName) ?> : <?= $count ?>
                            </div>
                        </div>
                    <?php } ?>
                     
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
                    <?= Html::a( 'Cancel', \Yii::$app->request->baseurl.'/front-desk/diagnosis', ['class' => 'btn btn-default cancelled', 'style'=>"margin-right: 8px;"]); ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>
<?php
$this->registerJs("
    $('#client-name').on('change', function() {
        if ($(this).val() === '__add_new__') {
            $('#client-select-wrapper').hide();
            $('#client-input-wrapper').show();
            if ($('#client-input-wrapper').is(':visible')) {
                $('#client-name-input').prop('disabled', false); // enable input when shown
                $('#client-name').val(null);
            }
        }
    });

    $('#client-name').change(function() {
        var clientId =  $(this).val();

        // Make an Ajax request to fetch clients data
        $.ajax({
            url: '" . \Yii::$app->request->baseUrl ."/front-desk/fetch-client', // URL to fetch product data
            method: 'GET',
            data: { id: clientId }, // Pass the client ID as a parameter
            dataType: 'Json',
            success: function(response) {
                                                     
                                   
                var response2 = JSON.parse(response);

                console.log(response2);

                // Check if the request was successful
                if (response.error) {
                    alert(response.error)
                }else{
                
                    var lastname = response2.data.lastname;
                    var email = response2.data.email;
                    var cell = response2.data.cell;
                    var alt_cell = response2.data.alt_cell;

                    $('#lastname input').val(lastname);
                    $('#email input').val(email);
                    $('#cell input').val(cell);
                    $('#alt_cell input').val(alt_cell);
                }
            },
            error: function(xhr, status, error) {
                // Handle error if Ajax request fails
                console.error('Ajax request failed:', error);
            }
        });


    });
");
?>