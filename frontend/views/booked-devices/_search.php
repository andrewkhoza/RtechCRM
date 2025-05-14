<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\BookedDevicesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booked-devices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'technician_id') ?>

    <?= $form->field($model, 'checkin_agent_id') ?>

    <?= $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'colour') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'branch') ?>

    <?php // echo $form->field($model, 'bookin_date') ?>

    <?php // echo $form->field($model, 'job_completion_date') ?>

    <?php // echo $form->field($model, 'collection_date') ?>

    <?php // echo $form->field($model, 'assessment_fee') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
