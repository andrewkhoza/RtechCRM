<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\EmailText */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Email Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                        <li class="breadcrumb-item">
                            <a>Email Text</a>
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

            <p>
                <?= Html::a('Back', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                <?= ''/*Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])*/ ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'name',
                    'text:html',
                    'email_subject',
                    'email_brief',
                ],
            ]) ?>
                
        </div>
    </div>

</div>
