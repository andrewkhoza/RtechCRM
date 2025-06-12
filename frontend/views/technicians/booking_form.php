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
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Divisions */


$this->title = 'Repairs Status | '.Yii::$app->params['siteName'];
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

                <?php $form = ActiveForm::begin(['id'=>'device-issues']); ?>   

                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody' => '.container-items',
                        'widgetItem' => '.item',
                        'min' => 1,
                        'insertButton' => '.add-item',
                        'deleteButton' => '.remove-item',
                        'model' => $issues[0] ,
                        'formId' => 'device-issues',
                        'formFields' => [
                            'diagnosed_problem',
                            'cost',
                        ],
                    ]); ?>

                    <div class="panel panel-default">
                        <div class="panel-heading mb-2">
                            <button type="button" class="pull-right add-item btn btn-primary btn-xs"><h6>Add Issue</h6></button>
                        </div>
                        
                        <div class="panel-body container-items">
                            <?php 
                            foreach ($issues as $index => $issue){ ?>
                                <div class="item panel panel-default">
                                    <div class="panel-body">
                                        <div class="row mb-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h3 class="mb-3">Device Issue</h3>
                                                    </div>
                                                    <div class="row  mb-3">
                                                        <div class="col-md-9 col-8">
                                                            <?= $form->field($issue,"[{$index}]diagnosed_problem")->textArea(['rows'=>3])
                                                            ?>
                                                        </div> 
                                                    </div> 
                                                    <div class="row  mb-3"> 
                                                        <div class="col-md-9 col-8">
                                                            <?= $form->field($issue,"[{$index}]proposed_solution")->textArea(['rows'=>3])
                                                            ?>
                                                        </div>   
                                                    </div>  
                                                    <div class="row  mb-3"> 
                                                        <div class="col-md-4 col-6">
                                                            <?= $form->field($issue,"[{$index}]cost")->textInput()
                                                            ?>
                                                        </div>   
                                                    </div>  
                                                    <div class="row  mb-3">  
                                                        <div class="col-md-1 mt-4 text-end col-6 panel-heading " style="float: left;">
                                                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs "  ><i class="fa fa-minus"></i></button>                                                            
                                                        </div>                                        
                                                    </div>  
                                                    <br/>
                                                    <hr/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php DynamicFormWidget::end(); ?>  
                <br/> 

                <div class="form-group">
                    <?= Html::a( 'Cancel', \Yii::$app->request->baseurl.'/technicians/index', ['class' => 'btn btn-default cancelled', 'style'=>"margin-right: 8px;"]); ?>
                    <?= Html::submitButton('Quote', ['class' => 'btn btn-primary', 'style'=>"margin-right: 8px;"]) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>


        </div>
    </div>
</div>

<?php

$this->registerJs("
    $(document).ready(function() {

        jQuery('.dynamicform_wrapper').on('afterInsert', function(e, item) {
            jQuery('.dynamicform_wrapper .question-number').each(function(index) {
                jQuery(this).html('Response: ' + (index + 1));
            });
        });

        jQuery('.dynamicform_wrapper').on('afterDelete', function(e) {
            jQuery('.dynamicform_wrapper .panel-title').each(function(index) {
               //  jQuery(this).html('Module: ' + (index + 1))
            });
        });
    });
")
?>