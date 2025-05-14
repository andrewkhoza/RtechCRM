<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookedDevices $model */

$this->title = 'Create Booked Devices';
$this->params['breadcrumbs'][] = ['label' => 'Booked Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booked-devices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
