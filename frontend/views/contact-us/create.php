<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContactUs $model */

$this->title = 'Create Contact Us';
$this->params['breadcrumbs'][] = ['label' => 'Contact uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
