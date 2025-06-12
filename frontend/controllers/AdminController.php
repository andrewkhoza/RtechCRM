<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\web\UploadedFile;
/* Custom */
use app\models\UserInfo;


/**
 * AdminController implements the CRUD actions for ProductRange model.
 */
class AdminController extends Controller
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

     /*   ***********************************************************************************************  */
    /* Admin Section Actions */   
    
    public function actionDashboard()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        return $this->render('index');
      
        
    }


    public function actionAdminProfile()
    {
        $this->layout = 'admin';
        
        $user = User::findOne(\Yii::$app->user->id);
        $userinfo = UserInfo::findOne(['user_id' => \Yii::$app->user->id]);
        
        if ( Yii::$app->request->post() ) {
            $user->load(Yii::$app->request->post());
            $userinfo->load(Yii::$app->request->post());
            
            $user->username = $user->email;
            
            $user->save();
            $userinfo->save();
            
            Yii::$app->getSession()->setFlash('success', 'Details Updated.');
            return $this->redirect(['profile']);
        }
        
        return $this->render('users/profile', [
            'user' => $user,
            'userinfo' => $userinfo,
        ]);
       
    } 
    
    
    /*   ***********************************************************************************************  */
    /* User Section Actions */    
    
    public function actionChangePassword(){

        $this->layout = 'admin';       
        
        $model = new \frontend\models\ResetPasswordFormAdmin(NULL);
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            $temp = Yii::$app->request->post();
            $user = User::findOne(\Yii::$app->user->id);
            
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            if($user->role == 10){
                return $this->redirect(['admin-index']);            
            }
        }

        return $this->render('users/resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionChangeuserpassword($id){

            $this->layout = 'admin';        
        
        $info = UserInfo::findOne(['user_id'=>$id]);
        if(!empty($info)){
            $model = new \frontend\models\ResetPasswordFormAdmin(NULL,NULL,$info->user_id);
            if (Yii::$app->request->isAjax){
                Yii::$app->response->format = 'json';
                $model->load(Yii::$app->request->post());

                return \kartik\widgets\ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                $temp = Yii::$app->request->post();
                $user = User::findOne($info->user_id);
                $user->save(false);

                Yii::$app->getSession()->setFlash('success', 'New password was saved.');

                if($user->role == 10){
                    return $this->redirect(['admin-index']);
                }
            }

            return $this->render('users/resetPassword', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionAdminIndex()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $searchModel = new UserSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search2($params);

        return $this->render('user_admin/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAdminCreate()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $model = new \frontend\models\SignupForm2();
        $model2 = new UserInfo();
        
        if ( Yii::$app->request->post() ) {
            $model->load(Yii::$app->request->post());
            $model->test = strtolower($model->test);
            $model2->load(Yii::$app->request->post());
            
            $model->status = 10;
            
            
            if( $user = $model->signup($model->role, $model->status) ){
                $model2->user_id = $user->id;

                $model2->save();

                /*$email = new \frontend\models\Mails();
                $return = $email->sendEmail(44, 1);*/

                Yii::$app->getSession()->setFlash('success', 'User Saved.');
                return $this->redirect(['dashboard']);
            }
            
        }

        return $this->render('users/admin/create', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }
    public function actionAdminUpdate($id)
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $model2 = UserInfo::findOne(['user_id'=>$id]);
        $model = User::findOne(['id'=>$model2->user_id]);
        $model2->scenario = 'adminsave';

        if ( Yii::$app->request->post() ) {
            $model->load(Yii::$app->request->post());
            $model->email = strtolower($model->email);
            $model2->load(Yii::$app->request->post());
            if($id != 1){
                if($model->statusselect == 1){
                    $model->status = 10;
                }else{
                    $model->status = 20;
                }
            }else{
                $model->status = 10;
            }
            
            
            if( $model->save() ){
                $model2->save(false);
                Yii::$app->getSession()->setFlash('success', 'Admin Updated.');
                return $this->redirect(['admin-index']);
            }
        }
        
        return $this->render('user_admin/update', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }

    public function actionAdminDelete($id)
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        $info = UserInfo::findOne(['user_id'=>$id]);
        if(!empty($info)){
            $model = User::findOne(['id'=>$info->user_id]);
            if(!empty($model)){
                $info = UserInfo::findOne(['user_id' => $model->id]);

                if($id != 1){
                    /*$email = new \frontend\models\Mails();
                    if($model->role == 10){
                        $return = $email->sendEmail(42, 1);
                    }
                    if($model->role == 20){
                        $return = $email->sendEmail(41, 1);
                    }
                    if($model->role == 30 || $model->role == 40){
                        $return = $email->sendEmail(40, 1);
                    }*/
                    $info->delete();
                    $model->delete();
                }else{
                    Yii::$app->getSession()->setFlash('warning', 'Cannot Delete Main User.');
                }
            }
        }

        return $this->redirect(['admin-index']);
    } 

    public function actionTechniciansIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '30'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('users/technician/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionFrontDeskIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '40'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('users/frontdesk/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionManagersIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '20'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('users/frontdesk/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSalesIndex(){

        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }

        $searchModel = new \app\models\search\UserInfoSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserInfoSearch']['role'] = '50'; // Target the correct model
        $dataProvider = $searchModel->search2($params);

        return $this->render('users/frontdesk/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


   
}

// 