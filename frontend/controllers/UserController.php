<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
/* Custom */
use app\models\UserInfo;


/**
 * UserController implements the CRUD actions for ProductRange model.
 */
class UserController extends Controller
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
                            User::SALES,
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
    /*   ********************************* Main Actions ************************************************  */
    /*   ***********************************************************************************************  */
    
    public function actionLogin()
    {
        $this->redirect(['site/login']);
        return false;
    }
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else if(Yii::$app->user->identity->role == 50){
            $this->layout = 'user';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
      
        
    }
    
    
    
    /*   ******************************* END Main Actions **********************************************  */
    /*   ***********************************************************************************************  */
    /*   ***************************** User Profile Actions ********************************************  */
    
    
    public function actionChangePassword()
    {
            $this->layout = 'admin';      
        
        $model = new \frontend\models\ResetPasswordFormAdmin(NULL);
        $userinfo = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
        
        
        if (Yii::$app->request->isAjax){
            Yii::$app->response->format = 'json';
            $model->load(Yii::$app->request->post());
            
            return \kartik\widgets\ActiveForm::validate($model);
        }

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            
            if(!empty($userinfo->twofa_secret)){
                
                $tfacheck->load(Yii::$app->request->post());
                $tfavalid = $manager->verify($tfacheck->code, $userinfo->twofa_secret);

                if($tfavalid){
                    if ($model->validate() && $model->resetPassword()) {

                        $temp = Yii::$app->request->post();
                        $user = User::findOne(\Yii::$app->user->id);
                        
                        if($userinfo->pass_changed == 0){
                            $userinfo->scenario = 'FirstTimeLogin';
                            $userinfo->pass_changed = 1;
                            $userinfo->save(false);
                            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
                            return $this->redirect(['index']);
                        }

                        Yii::$app->getSession()->setFlash('success', 'New password was saved.');
                        return $this->redirect(['profile']);
                    }
                }else{
                    Yii::$app->getSession()->setFlash('warning', '2FA failed.');
                }
            }else{
                if ($model->validate() && $model->resetPassword()) {

                    $temp = Yii::$app->request->post();
                    $user = User::findOne(\Yii::$app->user->id);
                    
                    
                    if($userinfo->pass_changed == 0){
                        $userinfo->scenario = 'FirstTimeLogin';
                        $userinfo->pass_changed = 1;
                        $userinfo->save(false);
                        Yii::$app->getSession()->setFlash('success', 'New password was saved.');
                        return $this->redirect(['index']);
                    }

                    Yii::$app->getSession()->setFlash('success', 'New password was saved.');
                    return $this->redirect(['profile']);
                }
            }
        }

        return $this->render('user/resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionProfile()
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
        
        return $this->render('user/profile', [
            'user' => $user,
            'userinfo' => $userinfo,
        ]);
       
    }  
   
    
}

