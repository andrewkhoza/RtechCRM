<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Clients;
use app\models\search\ClientsSearch;
use app\models\BookedDevices;
use app\models\search\BookedDevicesSearch;
use app\models\ReportedIssues;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;
use common\components\AccessRule;
use app\models\UserInfo;
use app\models\ChecklistData;
use app\models\DiagnosedIssues;
use app\models\FixedIssues;
class TechniciansController extends Controller
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
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);        

        $devices = BookedDevices::find()
            ->Where(['status' => ['Diagnosis', 'Quoted', 'Approved', 'Under Repairs','Awaiting Parts','Written Off','Ready For Collection']])
            ->andWHere(['technician_id'=>$userInfoId->id])
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

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);        

        return BookedDevices::find()
            ->where(['between', 'bookin_date', $startDate, $endDate])
            ->andWhere(['status' => ['Diagnosis', 'Quoted', 'Approved', 'Under Repairs','Awaiting Parts','Written Off','Ready For Collection']])
            ->andWHere(['technician_id'=>$userInfoId->id])
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

    public function actionDiagnosis()
    {
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['technician_id'] = $userInfoId->id; // Target the correct model
        $params['BookedDevicesSearch']['status'] = "Diagnosis"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('diagnosis', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDiagnosedIssues($id)
    {
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $issues = [new DiagnosedIssues];
        $FixedIssues = [new FixedIssues];
        $device = BookedDevices::findOne(['id'=>$id]);

        if(Yii::$app->request->post()){
            
            $diagnosed_issues = Yii::$app->request->post()['DiagnosedIssues'];
            
            foreach ($diagnosed_issues as $issue) {
                $model = new DiagnosedIssues();
            
                $model->device_id = $device->id;
                $model->diagnosed_problem = $issue['diagnosed_problem'];
                $model->proposed_solution = $issue['proposed_solution'];
                $model->cost = $issue['cost'];
            
                $model->save();
                
            }
            
            $device->status = "Quoted";

            $device->save();

            return $this->redirect(['//export/quote-pdf','id'=>$device->id]);
            
        }

        return $this->render('booking_form',[
            'issues'=>$issues,
            'FixedIssues'=>$FixedIssues,
        ]);
    }

    public function actionQuoted()
    {
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['technician_id'] = $userInfoId->id; // Target the correct model
        $params['BookedDevicesSearch']['status'] = "Quoted"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('quoted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }  
    public function actionApproved()
    {
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['technician_id'] = $userInfoId->id; // Target the correct model
        $params['BookedDevicesSearch']['status'] = ["Approved", "Under Repairs"];
        $dataProvider = $searchModel->search($params);

        return $this->render('approved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    
     
    public function actionAwaitingPartsStatus($id)
    {
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $model = BookedDevices::findOne(['id'=>$id]);

        $model->status = "Awaiting Parts";
        
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
        if(Yii::$app->user->identity->role == 30){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $userInfoId = UserInfo::findOne(['user_id'=>Yii::$app->user->id]);
        $searchModel = new  BookedDevicesSearch();
        $params = Yii::$app->request->queryParams;
        $params['BookedDevicesSearch']['technician_id'] = $userInfoId->id; // Target the correct model
        $params['BookedDevicesSearch']['status'] = "Awaiting Parts"; // Target the correct model
        $dataProvider = $searchModel->search($params);

        return $this->render('awaiting_parts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }  
      
    // public function actionQuotation($id)
    // {
    //     if(Yii::$app->user->identity->role == 30){
    //         $this->layout = 'admin';
    //     }else{
    //         throw new NotFoundHttpException('Page Not Found', 403);
    //     }

    //     $contact = \app\models\ContactUs::findOne(1);
    //     $device = BookedDevices::findOne(['id'=>$id]);
    //     $client = Clients::findOne(['id'=>$device->client_id]);
    //     $agent = UserInfo::findOne(['id'=>$device->checkin_agent_id]);
    //     $items = \app\models\DiagnosedIssues::findAll(['device_id'=>$device->id]);

    //     if(Yii::$app->request->post()){
    //         print_r('<pre>');
    //         print_r(Yii::$app->request->post());
    //         die;
    //     }

    //     return $this->render('quotation',[            
    //         'contact'=>$contact,
    //         'items'=>$items,
    //         'device'=>$device,
    //         'agent'=>$agent,
    //         'client'=>$client,
    //     ]);
    // }  

}
