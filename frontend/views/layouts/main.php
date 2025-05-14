<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap4\BootstrapAsset;
use app\models\ContactInfo;

// $contact = ContactInfo::findOne(1);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="ltr">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="alternate" href="http://<?= Yii::$app->params['alternateURL'] ?>/" hreflang="en-za" />
    
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="<?= \Yii::$app->request->baseurl ?>/images/icon32x32.png"> -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?= \Yii::$app->request->baseurl ?>/images/icon16x16.png"> -->
    
    <?php $this->head() ?>
    
    <!-- Custom CSS -->
    <link href="<?= \Yii::$app->request->baseurl ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= \Yii::$app->request->baseurl ?>/css/style.min.css" rel="stylesheet">
    
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <?= $content ?>
    
        <footer class="col-12" style="">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= \Yii::$app->request->baseurl ?>/images/logo_white.png" alt="homepage" class="dark-logo" style="max-width: 300px;" />
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4 text-right" style="margin-top: 25px;">
                    <?php if(!empty($contact->fb)){ ?>
                        <a href="<?= $contact->fb ?>"><i class="fab fa-facebook" style="color: #FFF;font-size: 30px;margin-left: 15px"></i></a>
                    <?php } ?>
                    <?php if(!empty($contact->tw)){ ?>
                        <a href="<?= $contact->tw ?>"><i class="fab fa-twitter" style="color: #FFF;font-size: 30px;margin-left: 15px"></i></a>
                    <?php } ?>
                    <?php if(!empty($contact->li)){ ?>
                        <a href="<?= $contact->li ?>"><i class="fab fa-linkedin" style="color: #FFF;font-size: 30px;margin-left: 15px"></i></a>
                    <?php } ?>
                    <?php if(!empty($contact->in)){ ?>
                        <a href="<?= $contact->in ?>"><i class="fab fa-instagram" style="color: #FFF;font-size: 30px;margin-left: 15px"></i></a>
                    <?php } ?>
                </div>
            </div>
            <br/>
            <?php if(!empty($contact->email)){ ?>
                <div class="row">
                    <div class="col-12">
                        <a href="mailto:<?= $contact->email ?>" style="color: #FFF;"><?= $contact->email ?></a>
                    </div>
                </div>
                <br/>
            <?php } ?>
            <div class="row">
                <div class="col-md-4" style="margin-top: 15px;">
                        <a href="<?= \Yii::$app->request->baseurl ?>/site/terms-and-conditions" style="color: #FFF;margin-right: 15px;">Terms and Conditions</a>
                        <a href="<?= \Yii::$app->request->baseurl ?>/site/privacy-policy" style="color: #FFF;margin-right: 15px;">Privacy Policy</a>
                        <a href="<?= \Yii::$app->request->baseurl ?>/site/user-agreement" style="color: #FFF;margin-right: 15px;">User Agreement</a>
                </div>
                <div class="col-md-8 text-right" style="color: #FFF;">
                    All Rights Reserved by Zilo Personalisation. Designed and Developed by <a href="https://zilo.co.za/" target="_blank">Zilo Personalisation</a>.
                </div>
            </div>
        </footer>
        <?php if(!empty($contact->whatsappbtn)){ ?>
            <a href="https://api.whatsapp.com/send?phone=+27<?= str_replace(' ',  '', ltrim($contact->whatsappbtn, '0')) ?>" class="whatsappfloat" target="_blank">
                <i class="fa fa-whatsapp floatingwhats"></i>
            </a>
        <?php } ?>
    </div>
    <?php $this->endBody() ?>
    
    
    
    <script>
    //$('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>      
                
    
</body>
</html>
<?php $this->endPage() ?>
