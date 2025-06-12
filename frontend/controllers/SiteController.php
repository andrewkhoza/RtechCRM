<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\SignupForm;
/* *** Custom *** */

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        if (!\Yii::$app->user->isGuest) {
            $user = Yii::$app->user;
            if ($user->identity->role == 10) { //admin
                $rules = ['index'];
            }else {
                $rules = [''];
            }
        } else {
            $rules = ['']; // not logged in
        }
        
        //==================================
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout',],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'signup','ajaxpost'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajaxpost' => ['post'],
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if ($action->id=='error'){
                $this->layout = 'error';
            }
            return true;
        } else {
            return false;
        }
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    
    
    
    /* DEFAULT ACTIONS */
    
    public function actionIndex()
    {
        return $this->redirect('dashboard');
    }
    public function actionLogin()
    {
        return $this->redirect(['dashboard']);
    }
    public function actionDashboard()
    {
        $this->layout = 'login';
        
        if (!\Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->role == 10){
                return $this->redirect(['/admin/dashboard']);
            }else if (Yii::$app->user->identity->role == 20){
                return $this->redirect(['/managers/dashboard']);
            }else if (Yii::$app->user->identity->role == 30){                
                return $this->redirect(['/technicians/dashboard']);
            }else if (Yii::$app->user->identity->role == 40){                
                return $this->redirect(['/front-desk/dashboard']);
            }else if (Yii::$app->user->identity->role == 50){                
                return $this->redirect(['/sales/dashboard']);
            }
        }
        
        $model = new LoginForm();
        if( Yii::$app->request->post() ) {
            $model->load(Yii::$app->request->post());
            $model->username = trim($model->username);
            $model->username = strtolower($model->username);
            if( isset(Yii::$app->request->post()['LoginForm']['rememberMe']) && Yii::$app->request->post()['LoginForm']['rememberMe'] == 'on'){
                $model->rememberMe = 1;
            }else{
                $model->rememberMe = 0;
            }
            $issue = $model->login();
            if($issue){
                $user = User::findOne(['id' => Yii::$app->user->id]);
                // $userinfo = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
                // if( !empty($userinfo->twofa_secret) ){
                //     $user->otp = 1;
                //     $user->save(false);
                // }
                
                /*$email = new \frontend\models\Mails();
                $return = $email->sendEmail(15, $user->id);*/
                
                
                if (Yii::$app->user->identity->role == 10){
                    return $this->redirect(['/admin/dashboard']);
                }else  if (Yii::$app->user->identity->role == 20){
                    return $this->redirect(['/managers/dashboard']);
                }else if (Yii::$app->user->identity->role == 30){                                          
                    return $this->redirect(['/technicians/dashboard']);
                }else if (Yii::$app->user->identity->role == 40){                        
                    return $this->redirect(['/front-desk/dashboard']);
                }else if (Yii::$app->user->identity->role == 50){                        
                    return $this->redirect(['/sales/dashboard']);
                }

            }
            Yii::$app->getSession()->setFlash('warning', 'Sorry, There was an error while completing your request, please try again later or contact our support team.');
            
        }
        return $this->render('login', [
            'model' => $model,
            //'response' => $response,
        ]);
    }
    
    public function actionReadyForCollection(){
        $this->layout = 'site';
    }
    
    public function actionRequestPasswordReset(){
        $this->layout = 'login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'A link has been seccessfully sent to your email address.');
                $email = new \frontend\models\Mails();
                $return = $email->sendEmail(28, $model->id);
                return $this->redirect(['reset_password/requestPasswordResetToken']);
            } else {
                Yii::$app->getSession()->setFlash('warning', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('reset_password/requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionRequestPasswordResetDone(){
        $this->layout = 'login';
        

        return $this->render('requestPasswordResetToken_done', [
            //'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            $email = new \frontend\models\Mails();
            //$return = $email->sendEmail(31, $model->id);
            Yii::$app->getSession()->setFlash('success', 'Your password has been successfully changed. You can now sign in.');
            
            
            return $this->redirect(['dashboard']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        
        
        Yii::$app->user->logout();

        return $this->redirect(['dashboard']);
        //return $this->redirect('index');
    }    
      
    public function actionSignup()
    {
        $this->layout = 'login';
              
        $model = new SignupForm();
        
        
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post())) {                
                $model->email = strtolower($model->email);
              
                if ($user = $model->signup(10,10)) { 
                                      
                    // print_r('<pre>');
                    // print_r('here');
                    // die;

                    // $email = new \frontend\models\Mails();
                    // $return = $email->sendEmail(1, $user->id);
                    // $return = $email->sendEmail(2, 1);               
                    
                    Yii::$app->session->setFlash('warning', 'A confirmation link has been sent to your email address. Please follow the link to activate your account. Remember to check your spam folder if you can\'t find the email in your inbox.');
                    return $this->redirect(['//site/login']);

                }

                Yii::$app->session->setFlash('warning', 'There was a problem completing your request.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
        
    }   
    
       
    
}
