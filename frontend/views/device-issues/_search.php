<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\DeviceIssuesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-issues-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'reported_issues') ?>

    <?= $form->field($model, 'issues_diagnosed') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'issues_fixed') ?>

    <?php // echo $form->field($model, 'checklist') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
