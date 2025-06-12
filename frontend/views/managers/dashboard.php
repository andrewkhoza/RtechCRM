<?php

use yii\helpers\Html;
use frontend\widgets\Alert;

$this->title = 'Dashboard | '.Yii::$app->params['siteName'];

?>

<div class="col-12" style="padding:0 20px;">
    <?= Alert::widget() ?>
</div>
<div class="container-fluid ops-dash">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">  
                    <div class="row">
                        <div class="col-sm-4 col-12 text-center text-sm-start">
                            <h4>Reports Dashboard</h4>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>