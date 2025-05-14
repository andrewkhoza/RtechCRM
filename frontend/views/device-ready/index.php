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
                        'label' => 'Client Phone', // <- Your custom label
                        'value' => function($data) {
                            $client = Clients::findOne($data->client_id);
                            return $client ? $client->cell: '';
                        },
                    ],
                    'brand',
                    'model',
                    'branch',
                    [
                        'attribute' => 'reported_problem',
                        'value' => function($data) {
                            $issue = ReportedIssues::findOne(['device_id' => $data->id]);
                            return $issue ? $issue->problem: '';
                        },
                    ],
                    'job_completion_date',
                    [
                        'label' => 'Days Remaining',
                        'format' => 'raw',
                        'value' => function($data) {
                            if ($data->job_completion_date) {
                                $completion = strtotime($data->job_completion_date);
                                $deadline = strtotime('+14 days', $completion);
                                $today = time();
                                $daysRemaining = floor(($deadline - $today) / (60 * 60 * 24));
                    
                                return $daysRemaining >= 0 ? "<span style='color: green;'>{$daysRemaining} day(s)</span>" : "<span style='color: red;'>0</span>";
                            }
                            return 'N/A';
                        },
                    ],
                    [
                        'label' => 'Overdue',
                        'format' => 'raw',
                        'value' => function($data) {
                            if ($data->job_completion_date) {
                                $completion = strtotime($data->job_completion_date);
                                $deadline = strtotime('+14 days', $completion);
                                $overdueDays = floor((time() - $deadline) / (60 * 60 * 24));
                    
                                return time() > $deadline
                                    ? "<span style='color: red;'>Yes ({$overdueDays} day(s))</span>"
                                    : "<span style='color: green;'>No</span>";
                            }
                            return 'N/A';
                        },
                    ],                                    
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'Actions', // Set the column name
                        'template' => ' {collected} {view}', // Add a new button for duplication
                        'buttons' => [
                            'collected' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-check" ></i>', ['diagnosed-issues','id'=> $model->id],['title'=>'Collected']);
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-eye" ></i>', ['diagnosed-issues','id'=> $model->id],['title'=>'View Invoice']);
                            },
                        ],
                    ]
                ],
            ]); ?>


        </div>
    </div>
</div>

