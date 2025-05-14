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


class FrontDeskController extends Controller
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
                            User::FRONT_DESK
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
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        return $this->render('dashboard');
    }

    public function actionBookingDevice()
    {

        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $model = new Clients();
        $model2 = new BookedDevices();
        $model3 = new ReportedIssues();

        if (Yii::$app->request->post()) {            
            $model->load(Yii::$app->request->post());
            
            if($model->save()){
                $model2->load(Yii::$app->request->post());
                $user_info = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);

                $model2->client_id = $model->id;
                $model2->checkin_agent_id = $user_info->id;
                $model2->bookin_date = date('Y-m-d');
                $model2->status = "Diagnosis";

                if(Yii::$app->request->post()['BookedDevices']['assessment_fee'] === "1"){
                    $model2->assessment_fee = "Paid";
                }else{
                    $model2->assessment_fee = "Not Paid";
                }

                if($model2->save()){
                    $model3->load(Yii::$app->request->post());

                    $model3->device_id = $model2->id;

                    if($model3->save()){
                        Yii::$app->getSession()->setFlash('success', 'Complete the below checklist.');
                        return $this->redirect(['check-list','id'=>$model3->device_id]);
                    }
                }

            }
        }

        return $this->render('booking_form',[
            'model' => $model,
            'model2' => $model2,  
            'model3' => $model3,  
        ]);
    } 

    public function actionUpdateBooking($id){
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $model2 = BookedDevices::findOne(['id'=>$id]);
        $model = Clients::findOne(['id'=>$model2->client_id]);
        $model3 = ReportedIssues::findOne(['device_id'=>$model2->id]);

        if (Yii::$app->request->post()) {            
            $model->load(Yii::$app->request->post());
            
            if($model->save()){
                $model2->load(Yii::$app->request->post());
                $user_info = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);

                $model2->client_id = $model->id;
                $model2->checkin_agent_id = $user_info->id;
                $model2->bookin_date = date('Y-m-d');
                $model2->status = "Diagnosis";

                if(Yii::$app->request->post()['BookedDevices']['assessment_fee'] === "1"){
                    $model2->assessment_fee = "Paid";
                }else{
                    $model2->assessment_fee = "Not Paid";
                }

                if($model2->save()){
                    $model3->load(Yii::$app->request->post());

                    $model3->device_id = $model2->id;

                    if($model3->save()){
                        Yii::$app->getSession()->setFlash('success', 'Complete the below checklist.');
                        return $this->redirect(['check-list','id'=>$model3->device_id]);
                    }
                }

            }
        }

        return $this->render('booking_form',[
            'model'=>$model,
            'model2'=>$model2,
            'model3'=>$model3,
        ]);

    }

    public function actionCheckList($id)
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $model = BookedDevices::findOne(['id'=>$id]);
        $model2 = ChecklistData::findOne(['device_id'=>$model->id]);
        if(!isset($model2)){
            $model2 = new ChecklistData();
        }
        if($model->type === "Phone"){

            $model2->scenario = ChecklistData::PHONE_SCENARIO;
           
        }else if($model->type === "Laptop"){

            $model2->scenario = ChecklistData::LAPTOP_SCENARIO;         

        }

        if(Yii::$app->request->post()){
            $model2->load(Yii::$app->request->post());
            $model2->device_id = $id;
        
            if($model2->save()){
                Yii::$app->getSession()->setFlash('success', 'Device has been succefully booked.');
                return $this->redirect(['diagnosis']);
            }
        }

        return $this->render('checklist_form',[
            'model'=>$model,
            'model2'=>$model2
        ]);

    }

    public function actionDiagnosis()
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = "Diagnosis"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('diagnosis', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQuoted()
    {
        
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = "Quoted"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('quoted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = ["Approved", "Under Repairs"];
        $dataProvider = $searchModel->search($params);

        return $this->render('approved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApprovedStatus($id)
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $model = BookedDevices::findOne(['id'=>$id]);

        $model->status = "Approved";
        
        if($model->save()){
            Yii::$app->getSession()->setFlash('success', 'Device status was successfully updated.');
            return $this->redirect(['approved']);
        }else{
            Yii::$app->getSession()->setFlash('warning', 'Device status update failed.');
            return $this->redirect(['approved']);
        }
                
    }
        
    public function actionAwaitingParts()
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = "Awaiting Parts"; // Target the correct model
        $dataProvider = $searchModel->search($params);
        return $this->render('awaiting_parts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReadyForCollection()
    {
        if(Yii::$app->user->identity->role == 40){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['status'] = ["Ready for Collection","Written Off","Job Cancelled"]; // Target the correct model
        $dataProvider = $searchModel->search($params);
        return $this->render('ready_for_collection', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     

}
