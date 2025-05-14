<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use frontend\widgets\Alert;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserDepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
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
                        <li class="breadcrumb-item" aria-current="page">Settings</li>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            
            <div class="card">
                <div class="card-header" >
                    <h6>Disable Account</h6>
                </div>
                <div class="card-body" >
                    <div class="row">
                        
                        <div class="col-12">
                            <p>If you suspect that your account has been compromised, please disable your account now.</p>
                            <p>To enable this, you will need to contact admin to enable this for you.</p>
                            <p style="color: red;font-weight: bold">This action cannot be undone.</p>
                            <br>
                            <hr>
                            <br>
                            <a class="btn btn-info" href="<?= \Yii::$app->request->baseurl ?>/user/security" style="cursor: pointer;">Back</a>
                            <a class="btn btn-warning float-end" href="<?= \Yii::$app->request->baseurl ?>/user/disable-account" style="cursor: pointer;">Disable Account</a>
                        </div>
                            
                    </div>
                        
                </div>
            </div>
                
        </div>
    </div>

</div>