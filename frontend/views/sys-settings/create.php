<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SysSettings $model */

$this->title = 'Create Sys Settings';
$this->params['breadcrumbs'][] = ['label' => 'Sys Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
