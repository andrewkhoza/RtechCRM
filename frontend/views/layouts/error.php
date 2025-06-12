<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap4\BootstrapAsset;
use app\models\ContactInfo;


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
    
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= \Yii::$app->request->baseurl ?>/images/title-favicon.png" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= \Yii::$app->request->baseurl ?>/images/title-favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= \Yii::$app->request->baseurl ?>/images/title-favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link href="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/preloader.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?= \Yii::$app->request->baseurl ?>/css/admin/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />-->
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/login.css" id="app-style" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="auth-page">
        <div class="container-fluid p-0">
            <?= $content ?>
        </div>
    </div>

        
        
    <?php $this->endBody() ?>
    
    
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/jquery/jquery.min.js"></script>-->
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>-->
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/metismenu/metisMenu.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/simplebar/simplebar.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/node-waves/waves.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/feather-icons/feather.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/pace-js/pace.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/js/admin/app.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/apexcharts/apexcharts.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    
    <script>
        $( document ).ready(function() {
            $(".btn-submits").click(function(){
                console.log( "click!" );
                $("#signup-form").submit();
            });
            $('.reveal-password').click(function(){
                var ischeck = $('#signupform-password').attr('type');
                if(ischeck == 'text'){
                    $('#signupform-password').attr('type','password');
                }else{
                    $('#signupform-password').attr('type','text');
                }
            });
            $('.reveal-password-confirm').click(function(){
                var ischeck = $('#signupform-password2').attr('type');
                if(ischeck == 'text'){
                    $('#signupform-password2').attr('type','password');
                }else{
                    $('#signupform-password2').attr('type','text');
                }
            });
            $('.reveal-password2').click(function(){
                var ischeck = $('#loginform-password').attr('type');
                if(ischeck == 'text'){
                    $('#loginform-password').attr('type','password');
                }else{
                    $('#loginform-password').attr('type','text');
                }
            });
            $('.reveal-password3').click(function(){
                var ischeck = $('#resetpasswordform-password').attr('type');
                if(ischeck == 'text'){
                    $('#resetpasswordform-password').attr('type','password');
                }else{
                    $('#resetpasswordform-password').attr('type','text');
                }
            });
            $('.reveal-password4').click(function(){
                var ischeck = $('#resetpasswordform-password2').attr('type');
                if(ischeck == 'text'){
                    $('#resetpasswordform-password2').attr('type','password');
                }else{
                    $('#resetpasswordform-password2').attr('type','text');
                }
            });
        });
    </script>
                
    
</body>
</html>
<?php $this->endPage() ?>
