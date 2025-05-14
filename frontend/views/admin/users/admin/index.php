<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DivisionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Super Admins';
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
                <?= Html::a('Add New Super Admin', ['admin-create'], ['class' => 'btn btn-success']) ?>
                <span style="float:right;">
                    <?= Html::a('<i class="fa fa-download"></i>', ['//export/super-admins'], ['target' => '_blank']) ?>
                </span>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsiveWrap' => false,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'username',
                    [
                        'attribute' => 'name',
                        'value' => function($data){
                            if(!empty($data->userinfo)){
                                return '<a href="'.Yii::$app->request->baseUrl.'/admin/admin-update/'.$data->id.'">'.$data->userinfo->name.'</a>';
                            }else{
                                return '';
                            }
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'lastname',
                        'value' => function($data){
                            if(!empty($data->userinfo)){
                                return $data->userinfo->lastname;
                            }else{
                                return '';
                            }
                        },
                        'format' => 'raw'
                    ],
                    //'email',
                    [
                        'attribute' => 'email',
                        'value' => function($data){
                            if(!empty($data->email)){
                                return '<a href="'.Yii::$app->request->baseUrl.'/admin/admin-update/'.$data->id.'">'.$data->email.'</a>';
                            }else{
                                return '';
                            }
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'cell',
                        'value' => function($data){
                            if(!empty($data->userinfo)){
                                return $data->userinfo->cell;
                            }else{
                                return '';
                            }
                        },
                        'format' => 'raw'
                    ],
                    /*[
                        'attribute' => 'role',
                        'filter' => [10=>'Admin',20=>'Manager'],
                        'value' => function($data){
                            $data2 = [10=>'Admin',20=>'Manager'];
                            return $data2[$data->role];
                        }
                    ],*/
                    [
                        'attribute' => 'created_at',
                        'value' => function($data){
                            return date('d/m/Y', $data->created_at);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => [10=>'Active',20=>'Disabled'],
                        'value' => function($data){
                            $data2 = [10=>'Active',20=>'Disabled'];
                            return $data2[$data->status];
                        }
                    ],

                    //['class' => 'kartik\grid\ActionColumn'],
                    ['class' => 'kartik\grid\ActionColumn',
                        'template' => '{Update}{Delete}',
                        'buttons' => [
                            'Update' => function ($url, $model) {
                                return Html::a('<span class="fas fa-pencil-alt" style="margin-right:4px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Update'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'aria-label' => "Update",
                                            'data-pjax' => "0",
                                ]);
                            },
                            'Password' => function ($url, $model) {
                                if(Yii::$app->user->identity->role == 10){
                                    return Html::a('<span class="fas fa-briefcase" style="margin-right:4px;"></span>', $url, [
                                                'title' => Yii::t('app', 'Password'),
                                                //'class' => 'open-modal',
                                                'data-id' => $model->id,
                                                'aria-label' => "Change User Password",
                                                'data-pjax' => "0",
                                    ]);
                                }else{
                                    return '';
                                }
                            },
                            'Delete' => function ($url, $model) {
                                return Html::a('<span class="fas fa-trash-alt" style="margin-right:0px;margin-left:20px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            //'class' => 'open-modal',
                                            'data-id' => $model->id,
                                            'data-confirm' => "Are you sure you want to delete this item?",
                                            'data-method' => "post",
                                            'aria-label' => "Delete",
                                            'data-pjax' => "0",
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'Update') {
                                $url = Yii::$app->request->baseUrl.'/admin/admin-update/'.$model->id;
                                return $url;
                            }
                            if ($action === 'Password') {
                                $url = Yii::$app->request->baseUrl.'/admin/changeuserpassword/'.$model->id;
                                return $url;
                            }
                            if ($action === 'Delete') {
                                $url = Yii::$app->request->baseUrl.'/admin/admin-delete/'.$model->id;
                                return $url;
                            }
                        }
                    ],
                    
                ],
            ]); ?>


        </div>
    </div>
</div>

