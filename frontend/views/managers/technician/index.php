<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use app\models\UserInfo;



/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DivisionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Technicians';
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

            <!-- <p>
                <?= Html::a('Add New Super Admin', ['admin-create'], ['class' => 'btn btn-success']) ?>
                <span style="float:right;">
                    <?= Html::a('<i class="fa fa-download"></i>', ['//export/super-admins'], ['target' => '_blank']) ?>
                </span>
            </p> -->

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsiveWrap' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'user_id',
                        'name',
                        'lastname',
                        'cell',
                        'user.email',
                        ['class' => 'kartik\grid\ActionColumn',
                        'template' => '{Manage}',
                        'buttons' => [
                            'Manage' => function ($url, $model) {
                                return Html::a('<span class="fas fa-cogs" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Manage'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->user_id,
                                            'aria-label' => "View",
                                            'data-pjax' => "0",
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'Manage') {
                                $url = Yii::$app->request->baseUrl.'/manager/manage-technician/'.$model->user_id;
                                return $url;
                            }                            
                        }
                    ],
                    ]
            ]); ?>


        </div>
    </div>
</div>

