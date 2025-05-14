<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DeviceIssues $model */

$this->title = 'Update Device Issues: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Device Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-issues-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
