<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\CancellationReason $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="cancellation-reason-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'reason')->textArea(['rows'=>3])->label('Reason for Cancelling the Job') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    