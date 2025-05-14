<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CancellationReason $model */

$this->title = 'Update Cancellation Reason: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cancellation Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cancellation-reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
