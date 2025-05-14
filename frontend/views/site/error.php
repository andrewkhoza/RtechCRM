<?php
use yii\helpers\Html;
use frontend\widgets\Alert;

$this->title = $name.' | '.Yii::$app->params['siteName'];
$this->params['topmenu'] = 'Error';
?>
<div class="row g-0">
    
    
    <div class="col-12">
        <div class="auth-bg p-4 d-flex" style="position: relative;height: 100vh;">
            <div class="col-xxl-6 col-lg-8 col-md-8 offset-xxl-3 offset-lg-2 offset-md-2 col-12 pt-5" style="z-index: 2;">
                <div class="d-flex card" style="background-color: #fff;border: 1px solid rgb(164,135,71);border-radius: 16px;">
                    <div class="w-100  card-header  p-1" style="text-align: center;border-top-left-radius: 14px;border-top-right-radius: 14px;border-color: rgb(164,135,71);border: none;-webkit-box-shadow: 0 0.2rem 0.5rem rgb(18 38 63 / 30%);box-shadow: 0 0.2rem 0.5rem rgb(18 38 63 / 30%);background: rgb(164,135,71);background: linear-gradient(90deg, rgba(164,135,71,1) 31%, rgba(240,224,177,1) 100%);">
                        <a href="<?= \Yii::$app->request->baseurl ?>/">
                            <img src="<?= \Yii::$app->request->baseurl ?>/images/Primary-Logo-Black.png" alt="" height="80">
                        </a>
                    </div>
                    <div class="w-100  card-body">
                        <div class="d-flex p-5 pt-1 pb-2 flex-column h-100">
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-3">
                                        Error
                                    </h5>
                                    <p class="mb-0">
                                        <?= ( $exception->statusCode == 417?$message:nl2br(Html::encode($message)) ) ?>
                                    </p>
                                    <br/>
                                    <?= Alert::widget() ?>
                                    <br/>
                                    The above error occurred while the Web server was processing your request.<br/>
                                    Please contact us if you think this is a server error. Thank you.
                                    <br/>
                                    <br/>
                                    <?php if(!empty(Yii::$app->request->referrer)){ ?>
                                        <?= Html::a('Go Back',Yii::$app->request->referrer, ['id' => 'read-more', 'class' => 'btn btn-primary w-100 waves-effect waves-light', 'style' => 'border-color: rgb(164,135,71);background: rgb(164,135,71);background: linear-gradient(90deg, rgba(164,135,71,1) 31%, rgba(240,224,177,1) 100%);']) ?>
                                        <br/>
                                    <?php } ?>
                                    <?= Html::a('Go Home', ['dashboard'], ['id' => 'read-more', 'class' => 'btn btn-primary w-100 waves-effect waves-light', 'style' => 'border-color: rgb(164,135,71);background: rgb(164,135,71);background: linear-gradient(90deg, rgba(164,135,71,1) 31%, rgba(240,224,177,1) 100%);']) ?>
                                    <br/>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="bg-overlay"></div>-->
            <ul class="bg-bubbles" style="z-index: 0;">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</div>