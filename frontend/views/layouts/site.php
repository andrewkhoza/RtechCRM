<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

// include language configuration file based on selected language
/*$lang = "en-US";
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = "en-US";
}

require_once("../../web/lang/" . $lang . ".php");*/
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>"  dir="ltr">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="alternate" href="<?= Yii::$app->params['mainUrlFull'] ?>" hreflang="en-za" />
    <?php $this->head() ?>
    <!-- <link rel="shortcut icon" href="<?= \Yii::$app->request->baseurl ?>/images/favicon.ico" type="image/x-icon" /> -->
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="<?= \Yii::$app->request->baseurl ?>/images/icon32x32.png"> -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?= \Yii::$app->request->baseurl ?>/images/icon16x16.png"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/preloader.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?= \Yii::$app->request->baseurl ?>/css/admin/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />-->
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/admin/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?= \Yii::$app->request->baseurl ?>/css/style.css" id="app-style" rel="stylesheet" type="text/css" />
    
    
    
</head>
<body data-topbar="dark">
    
    <?php $this->beginBody() ?>
    
    <div id="layout-wrapper">
        <?= $this->render('parts/menu') ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    
                    <?php //include 'parts/breadcrumb.php'; ?>

                    <?= $content ?>

                </div>
            </div>
            <?= $this->render('parts/footer') ?>
        </div>

    </div>
    
            
    <?php $this->endBody() ?>
    
    
    <?php //include 'parts/right-sidebar.php'; ?>
    
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/jquery/jquery.min.js"></script>-->
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>-->
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/metismenu/metisMenu.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/simplebar/simplebar.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/node-waves/waves.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/feather-icons/feather.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/pace-js/pace.min.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/js/admin/app.js"></script>
    <script src="<?= \Yii::$app->request->baseurl ?>/lib/apexcharts/apexcharts.min.js"></script>
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>-->
    <!--<script src="<?= \Yii::$app->request->baseurl ?>/lib/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>-->
    <script src="<?= \Yii::$app->request->baseurl ?>/js/admin/pages/dashboard.init.js"></script>

   
    

   
</body>
</html>
<?php $this->endPage() ?>

