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
use app\models\ChecklistNotes;
use app\models\ReportedIssues;
use app\models\CancellationReason;
use app\models\Quotations;
use Mpdf\Mpdf;



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
                            User::MANAGER,
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

        $devices = BookedDevices::find()
            ->Where(['status' => ['Diagnosis', 'Quoted', 'Approved', 'Under Repairs','Awaiting Parts','Written Off','Ready For Collection']])
            ->all();
        
        $dailyDevices = $this->getDevices('today');
        $weeklyDevices = $this->getDevices('-1 week');
        $monthlyDevices = $this->getDevices('-1 month');
        $quarterlyDevices = $this->getDevices('-3 months');
        $yearlyDevices = $this->getDevices('-1 year');        

        $weeklyReport = $this->processDevices($weeklyDevices);
        $monthlyReport = $this->processDevices($monthlyDevices);
        $quarterlyReport = $this->processDevices($quarterlyDevices);
        $yearlyReport = $this->processDevices($yearlyDevices); 
        $overallReport = $this->processDevices($devices);        
      

        return $this->render('dashboard', [
            'dailyDevices' => $dailyDevices,
            'weeklyReport' => $weeklyReport,
            'monthlyReport' => $monthlyReport,
            'quarterlyReport' => $quarterlyReport,
            'yearlyReport' => $yearlyReport,
            'overallReport' => $overallReport

        ]);
    }


    private function getDevices($interval)
    {
        $startDate = date('Y-m-d', strtotime($interval));
        $endDate = date('Y-m-d');        

        return BookedDevices::find()
            ->where(['between', 'bookin_date', $startDate, $endDate])
            ->andWhere(['status' => ['Diagnosis', 'Quoted', 'Approved', 'Under Repairs','Written Off','Awaiting Parts','Ready For Collection']])
            ->all();
    }

    private function processDevices($devices)
    {
        $statusCounts = [
            'Diagnosis' => 0,
            'Quoted' => 0,
            'Approved' => 0,
            'Under Repairs' => 0,
            'Awaiting Parts' => 0,
            'Written Off' => 0,
            'Ready For Collection' => 0,
        ];

        foreach ($devices as $device) {
            if (isset($statusCounts[$device->status])) {
                $statusCounts[$device->status]++;
            }
        }

        return $statusCounts;
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
        $devices = BookedDevices::find()->where(['status'=>['Diagnosis','Quoted','Approved','Under Repairs']])->all();

        if (Yii::$app->request->post()) {  
           
            if(isset(Yii::$app->request->post()['Clients']['id']) && !empty(Yii::$app->request->post()['Clients']['id'])){

                $model = Clients::findOne(['id'=>Yii::$app->request->post()['Clients']['id']]);

                $model2->load(Yii::$app->request->post());
                $user_info = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);

                $model2->client_id = $model->id;
                $model2->checkin_agent_id = $user_info->id;
                $model2->bookin_date = date('Y-m-d');
                $model2->status = "Diagnosis";
                if ($model2->total_cost === null) {
                    $model2->total_cost = 0;
                }
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

            }else{

                $model->load(Yii::$app->request->post());

                if($model->save()){
                    $model2->load(Yii::$app->request->post());
                    $user_info = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);

                    $model2->client_id = $model->id;
                    $model2->checkin_agent_id = $user_info->id;
                    $model2->bookin_date = date('Y-m-d');
                    $model2->status = "Diagnosis";
                    if ($model2->total_cost === null) {
                        $model2->total_cost = 0;
                    }
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
        }

        return $this->render('booking_form',[
            'model' => $model,
            'model2' => $model2,  
            'model3' => $model3,  
            'devices' => $devices,  
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
        $devices = BookedDevices::find()->where(['status'=>['Diagnosis','Quoted','Approved','Under Repairs']])->all();

        if (Yii::$app->request->post()) {            
            $model->load(Yii::$app->request->post());
            
            if($model->save()){
                $model2->load(Yii::$app->request->post());
                $user_info = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);

                $model2->client_id = $model->id;
                $model2->checkin_agent_id = $user_info->id;
                $model2->bookin_date = date('Y-m-d');
                $model2->status = "Diagnosis";
                if ($model2->total_cost === null) {
                    $model2->total_cost = 0;
                }

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
            'devices' => $devices,  
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
        if(isset($model2) && !empty($model2)){
            $model3 = ChecklistNotes::findOne(['checklist_data_id'=>$model2->id]);
        }
        if(!isset($model2)){
            $model2 = new ChecklistData();
            $model3 = new ChecklistNotes();
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
                $model3->load(Yii::$app->request->post());
                $model3->checklist_data_id = $model2->id;
                if($model3->save()){
                    Yii::$app->getSession()->setFlash('success', 'Device has been succefully booked.');
                    return $this->redirect(['diagnosis']);
                }
                
            }
        }

        return $this->render('checklist_form',[
            'model'=>$model,
            'model2'=>$model2,
            'model3'=>$model3,
        ]);

    }

    public function actionFetchClient(){
    
        if (Yii::$app->user->identity->role == 40) {
            $this->layout = 'admin';
        } else {
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        $clientId = Yii::$app->request->get('id');

        $client = Clients::findOne($clientId);

        if ($client !== null) {
            return json_encode([
                'success' => true,
                'data' => [
                    
                    'lastname' => $client->lastname,
                    'email'=> $client->email,
                    'cell'=> $client->cell,
                    'alt_cell'=> $client->alt_cell,
                ],
            ]);
        } else {
            return [
                'success' => false,
                'error' => 'Client not found.',
            ];
        }
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

    public function actionDownloadPdf($id){

        if (Yii::$app->user->identity->role == 40) {
            $this->layout = 'admin';
        } else {
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $quote = Quotations::findOne(['device_id'=>$id]);

        $pdf = new Mpdf();
        $pdf->AddPage();

        $doc = $quote->path;

        Yii::$app->response->sendFile($doc, basename($doc), [
            'mimeType' => 'application/pdf',
            'inline' => false,
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
