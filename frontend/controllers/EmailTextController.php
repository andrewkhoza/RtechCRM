<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;
use app\models\EmailText;
use app\models\search\EmailTextSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/* *** Custom *** */
use app\models\UserInfo;
use yii\web\UploadedFile;

/**
 * EmailTextController implements the CRUD actions for EmailText model.
 */
class EmailTextController extends Controller
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
            $authtime = 360;
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
        if( !empty(Yii::$app->user->identity->otp) ){
            if($action->id != 'check2fa' ){
                if(Yii::$app->user->identity->role == 10){
                    return $this->redirect(['//admin/check2fa'.'?nd='.md5(\Yii::$app->user->id.'arb').'&nds=5'.\Yii::$app->user->id.'&mdf=ot'. md5(\Yii::$app->user->identity->email.'arb')]);
                }else{
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Lists all EmailText models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $searchModel = new EmailTextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmailText model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new EmailText model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $model = new EmailText();

        if ( Yii::$app->request->post() ) {
            $model->load(Yii::$app->request->post());
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EmailText model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $model = $this->findModel($id);

        if ( Yii::$app->request->post() ) {
            $model->load(Yii::$app->request->post());
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmailText model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $model = $this->findModel($id);
                
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmailText model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailText::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUploadfile()
    {
        if(Yii::$app->user->identity->role == 10){
            $this->layout = 'admin';
        }else{
            throw new NotFoundHttpException('Page Not Found', 403);
        }
        
        $file = UploadedFile::getInstanceByName('file');
        if (!empty($file)) {
            $ext = pathinfo($file->name, PATHINFO_EXTENSION);
            $newname = md5($file->name).'.'.$ext;
            $path = 'uploads/emails/uploads/'.$newname;
            if ( !file_exists('uploads/emails/uploads') ) {
                mkdir('uploads/emails/uploads', 0777, true);
            }
            if ( file_exists($path) ) {
                $path = 'uploads/emails/uploads/'.md5($file->name).'-'.rand(10,10000000).'.'.$ext;
                if ( file_exists($path) ) {
                    $path = 'uploads/emails/uploads/'.md5($file->name).'-'.rand(10,10000000).'.'.$ext;;
                }
            }
            $file->saveAs($path);
            
            $return = [
                'location' => Yii::$app->params['mainUrlFull'].$path
            ];
            return json_encode($return);
        }
        
    }
}
