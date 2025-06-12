<?php

use yii\helpers\Html;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\EmailText */

$this->title = 'Update Email';
$this->params['breadcrumbs'][] = ['label' => 'Email Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
                            <a>Emails</a>
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

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
                
        </div>
    </div>

</div>
