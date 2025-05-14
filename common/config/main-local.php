<?php
    use \yii\web\Request;
    
if(!$Yiirunconsole){
    $baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
    
    
    return [
        'components' => [

            /*  */
            //localhost
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=rtechsa',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
                 
            
            'user' => [
                'identityClass' => 'common\models\User',
                'enableAutoLogin' => false,
                'authTimeout' => 3600
            ],
            'request' => [
                'baseUrl' => $baseUrl,
                'parsers' => [
                    'application/json' => 'yii\web\JsonParser',
                ]
            ],
            'urlManager' => [
              'baseUrl' => $baseUrl,
              'showScriptName' => false,
              'enablePrettyUrl' => true,
              'rules' => [
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'api'],
                    'dashboard' => 'site/dashboard',
                    'unsupported' => 'site/unsupported',
                  
                    '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
              ]
            ],            
            'response' => [
                'formatters' => [
                    'pdf' => [
                        'class' => 'robregonm\pdf\PdfResponseFormatter',
                    ],
                ]
            ],
            'image' => [
                'class' => 'yii\image\ImageDriver',
                'driver' => 'GD',  //GD or Imagick
            ],
            'assetManager' => [
                'bundles' => [
                    'yii\web\JqueryAsset' => [
                        'js' => [YII_DEBUG ? $baseUrl.'/lib/jquery/jquery.min.js' : $baseUrl.'/lib/jquery/jquery.min.js'],
                        'jsOptions' => ['type' => 'text/javascript'],
                    ],
                    'yii\bootstrap4\BootstrapAsset' => [
                        'css' => [YII_DEBUG ? $baseUrl.'/lib/bootstrap/css/bootstrap.min.css' : $baseUrl.'/lib/bootstrap/css/bootstrap.min.css'],
                    ],
                    'yii\bootstrap4\BootstrapPluginAsset' => [
                        'js' => [YII_DEBUG ? $baseUrl.'/lib/bootstrap/js/bootstrap.bundle.min.js' : $baseUrl.'/lib/bootstrap/js/bootstrap.bundle.min.js'],
                        'jsOptions' => ['type' => 'text/javascript'],
                    ],
                ],
            ],
        ],
        'modules' => [
            'gridview' =>  [
                 'class' => '\kartik\grid\Module'
             ]
        ],
        'aliases' => [
            '@bower' => '@vendor/bower',
            '@npm'   => '@vendor/npm-asset',
        ],
    ];
    
    
    
    
}else{
    $baseUrl = '/';
    return [
        'components' => [

            /*  */
            //localhost
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=rtechsa',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
      
            'urlManager' => [
              'baseUrl' => $baseUrl,
              'showScriptName' => false,
              'enablePrettyUrl' => true,
              'rules' => [
                  


              ]
            ], 
            
        ],
    ];
}