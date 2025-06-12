<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmailTextSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
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
                        <li class="breadcrumb-item">
                            <a>Dashboard</a>
                        </li>
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


            <!--p>
                <?= Html::a('New Email Text', ['create'], ['class' => 'btn btn-primary']) ?>
            </p-->

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'name',
                    'email_subject',
                    'email_brief',
                    //'text:html',

                    //['class' => 'kartik\grid\ActionColumn'],
                    ['class' => 'kartik\grid\ActionColumn',
                        'template' => '{View}{Update}{Duplicate}{Send}',
                        'buttons' => [
                            'View' => function ($url, $model) {
                                return Html::a('<span class="fas fa-eye" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'View'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'aria-label' => "View",
                                            'data-pjax' => "0",
                                ]);
                            },
                            'Update' => function ($url, $model) {
                                return Html::a('<span class="fas fa-pencil-alt" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Update'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'aria-label' => "Update",
                                            'data-pjax' => "0",
                                ]);
                            },
                            'Duplicate' => function ($url, $model) {
                                return Html::a('<span class="fas fa-copy" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Duplicate'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'aria-label' => "Duplicate",
                                            'data-pjax' => "0",
                                ]);
                            },
                            'Send' => function ($url, $model) {
                                return Html::a('<span class="fas fa-paper-plane" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Send Newseltter'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'aria-label' => "Send Newseltter",
                                            'data-pjax' => "0",
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'View') {
                                $url = Yii::$app->request->baseUrl.'/email-text/view/'.$model->id;
                                return $url;
                            }
                            if ($action === 'Update') {
                                $url = Yii::$app->request->baseUrl.'/email-text/update/'.$model->id;
                                return $url;
                            }
                            if ($action === 'Duplicate') {
                                $url = Yii::$app->request->baseUrl.'/email-text/duplicate/'.$model->id;
                                return $url;
                            }
                            if ($action === 'Send') {
                                $url = Yii::$app->request->baseUrl.'/email-text/send-newsletter/'.$model->id;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
                
        </div>
    </div>

</div>