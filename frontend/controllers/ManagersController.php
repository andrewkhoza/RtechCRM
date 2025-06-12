<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\filters\VerbFilter;
use common\models\User;
use app\models\BookedDevices;

class ManagersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' =>  AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [
                            User::MANAGER,
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                                        
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        if (!\Yii::$app->user->isGuest) {
            $session = Yii::$app->getSession();
            $settings = \app\models\SysSettings::findOne(1);
            $authtime = 3600;
            if(!empty($settings->inactive_time)){
                $authtime = (int)$settings->inactive_time*60;
            }
            \Yii::$app->user->authTimeout = $authtime;
            $timetologout = $session->get(\Yii::$app->user->authTimeoutParam);
            if($timetologout >= time()){
                if (\Yii::$app->user->authTimeout !== null) {
                    $session->set(\Yii::$app->user->authTimeoutParam, time() + \Yii::$app->user->authTimeout);
                }
                if (\Yii::$app->user->absoluteAuthTimeout !== null) {
                    $session->set(\Yii::$app->user->absoluteAuthTimeoutParam, time() + \Yii::$app->user->absoluteAuthTimeout);
                }
            }
            if($timetologout <= time()){
                $this->redirect(['site/logout']);
                return false;
            }
        }
        if(\Yii::$app->user->isGuest){
            $this->redirect(['site/login']);
            return false;
        }
        
        return true;
    }
    public function actionDashboard()
    {
        if(Yii::$app->user->identity->role == 20){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        return $this->render('dashboard');
    }

    public function actionTechniciansIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else if(Yii::$app->user->identity->role == 20){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '30'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('technician/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionManageTechnician($id){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else if(Yii::$app->user->identity->role == 20){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $technician = UserInfo::find()
        ->where(['user_id'=>$id])
        ->one();

        $devices = BookedDevices::find()
        ->where(['technician_id'=>$technician->id])
        ->all();

        return $this->render('technician', [
            'technician' => $searchModel,
            'devices' => $dataProvider,
        ]);
    }
    public function actionFrontDeskIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else if(Yii::$app->user->identity->role == 20){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '40'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('frontdesk/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSalesIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else if(Yii::$app->user->identity->role == 20){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '50'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('frontdesk/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
