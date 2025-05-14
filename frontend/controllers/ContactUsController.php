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
use app\models\ContactUs;
use app\models\search\ContactUsSearch;

/**
 * ContactUsController implements the CRUD actions for ContactUs model.
 */
class ContactUsController extends Controller
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

    /**
     * Lists all ContactUs models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContactUsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactUs model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContactUs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContactUs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContactUs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContactUs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContactUs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ContactUs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContactUs::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
