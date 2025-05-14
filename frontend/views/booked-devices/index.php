<?php

use app\models\BookedDevices;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\BookedDevicesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Booked Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booked-devices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booked Devices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'technician_id',
            'checkin_agent_id',
            'brand',
            //'model',
            //'colour',
            //'type',
            //'branch',
            //'bookin_date',
            //'job_completion_date',
            //'collection_date',
            //'assessment_fee',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BookedDevices $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
