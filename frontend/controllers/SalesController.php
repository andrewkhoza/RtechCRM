<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SalesController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role == 50){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        return $this->render('index');
    }

}
