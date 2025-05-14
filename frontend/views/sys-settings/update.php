<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SysSettings $model */

$this->title = 'Update Sys Settings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
