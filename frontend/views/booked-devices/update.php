<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookedDevices $model */

$this->title = 'Update Booked Devices: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Booked Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="booked-devices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
