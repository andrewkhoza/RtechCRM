<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Clients;
use app\models\search\ClientsSearch;
use app\models\BookedDevices;
use app\models\search\BookedDevicesSearch;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;
use common\components\AccessRule;
use app\models\UserInfo;
use app\models\ChecklistData;
use app\models\ReportedIssues;
use app\models\CancellationReason;

/**
 * BookedDevicesController implements the CRUD actions for BookedDevices model.
 */
class WriteOffController extends Controller
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
                            User::ADMIN,
                            User::MANAGER,
                            User::TECHNICIAN,
                            User::FRONT_DESK,
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

    public function actionIndex(){

        $this->layout = 'admin';

        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = "Written Off"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReason($id){

        $this->layout = 'admin';      

        $model = new CancellationReason();
        $device = BookedDevices::findOne(['id'=>$id]);

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $model->device_id = $device->id;
            $device->status = "Written Off";
            $device->job_completion_date = date('Y-m-d');
            if($device->save() && $model->save()){
                Yii::$app->getSession()->setFlash('success', 'Job has been cancelled succesfully.');
                return $this->redirect(['index']);
            }          
        } 

        return $this->render('_form',[
            'model'=>$model
        ]);
    }

    public function actionResumeJob($id){

        $this->layout = 'admin';      

        $model = CancellationReason::findOne(['device_id'=>$id]);
        $device = BookedDevices::findOne(['id'=>$id]);

        $model->delete();
        $device->status = "Approved";
        if($device->save()){
            Yii::$app->getSession()->setFlash('success', 'Job Status Has Been Updated Succesfully.');
            return $this->redirect(['index']);
        }          
    }


    
}