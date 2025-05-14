<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DeviceIssues $model */

$this->title = 'Create Device Issues';
$this->params['breadcrumbs'][] = ['label' => 'Device Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-issues-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
