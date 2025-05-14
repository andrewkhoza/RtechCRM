<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SysSettings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sys-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inactive_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
