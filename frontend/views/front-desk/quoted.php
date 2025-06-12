<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use app\models\Clients;
use app\models\UserInfo;
use app\models\ReportedIssues;
use yii\grid\ActionColumn;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DivisionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repairs | '.Yii::$app->params['siteName'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-12" style="padding:0 20px;">
<?= Alert::widget() ?>
</div>
<div class="card card-body">
    
    <div class="row">
        <div class="col-12">

            <p>
                <?= Html::a('Book In A Device ', ['booking-device'], ['class' => 'btn btn-primary']) ?>
                <!-- <span style="float:right;">
                    <?= Html::a('<i class="fa fa-download"></i>', ['//export/super-admins'], ['target' => '_blank']) ?>
                </span> -->
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsiveWrap' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    [
                        'attribute' => 'client_name',
                        'value' => function($data) {
                            $client = Clients::findOne($data->client_id);
                            return $client ? $client->name.' '.$client->lastname : '';
                        },
                    ],
                    [
                        'attribute' => 'technician_name',
                        'label' => 'Assigned Technician',
                        'value' => function($data) {
                            $technician = UserInfo::findOne($data->technician_id);
                            return $technician ? $technician->name: '';
                        },
                    ],
                    [
                        'attribute' => 'cell',
                        'label' => 'Client Phone',
                        'value' => function($data) {
                            $client = Clients::findOne($data->client_id);
                            return $client ? $client->cell.' '.$client->alt_cell : '';
                        },
                    ],
                    'brand',
                    'model',
                    'branch',
                    'assessment_fee', 
                    [
                        'attribute' => 'reported_problem',
                        'value' => function($data) {
                            $issue = ReportedIssues::findOne(['device_id' => $data->id]);
                            return $issue ? $issue->problem: '';
                        },
                    ],
                    'bookin_date',
                    // 'status', 
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'Actions', // Set the column name
                        'template' => ' {update} {download} {write-off}', // Add a new button for duplication
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-thumbs-up" aria-hidden="true"></i>', ['approved-status','id'=> $model->id],['title'=>'Approved']);
                            },
                            'download' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-download" aria-hidden="true"></i>', ['download-pdf','id'=> $model->id],['title'=>'Download Quotation']);
                            },
                            'write-off' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-ban" aria-hidden="true"></i>', ['write-off/reason', 'id' => $model->id], [
                                    'title' => 'Cancel Job',
                                    'class' => 'text-danger'
                                ]);
                            },
                        ],
                    ],                  
                    
                ],
            ]); ?>


        </div>
    </div>
</div>

