();
print_r();
die;<?php
use yii\helpers\Html;
use frontend\widgets\Alert;



$this->title = $model->name.' | '.Yii::$app->params['siteName'];
$this->params['topmenu'] = $model->name;
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box auth-box2" style="margin-top: 50px;">
        <div id="">
            <div class="logo">
                <span class="db">
                    <a href="<?= \Yii::$app->request->baseurl ?>/">
                        <img src="<?= \Yii::$app->request->baseurl ?>/images/logo_top.png" alt="logo" style="max-width: 150px;" />
                    </a>
                </span>
                <br/><br/>
                <h5 class="font-medium m-b-20"><?= $this->params['topmenu'] ?></h5>
                <style>
                    b {
                        font-weight: 600;
                    }
                </style>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= Alert::widget() ?>
                </div>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <?= $model->text ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
