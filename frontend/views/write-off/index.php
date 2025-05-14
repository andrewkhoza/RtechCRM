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
                        'attribute' => 'checkin_agent',
                        'value' => function($data) {
                            $agent = UserInfo::findOne($data->checkin_agent_id);
                            return $agent ? $agent->name: '';
                        },
                    ],                    
                    [
                        'attribute' => 'cell',
                        'value' => function($data) {
                            $client = Clients::findOne($data->client_id);
                            return $client ? $client->cell: '';
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
                        'template' => '{resume-job} {view}', // Add a new button for duplication
                        'buttons' => [
                            'resume-job' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-thumbs-up" ></i>', ['resume-job','id'=> $model->id],['title'=>'Resume Job']);
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-eye" ></i>', ['view','id'=> $model->id],['title'=>'Job Details']);
                            },
                        ],
                    ],                   
                    
                ],
            ]); ?>


        </div>
    </div>
</div>

