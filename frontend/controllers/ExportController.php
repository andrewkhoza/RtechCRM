<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use app\models\UserInfo;
use app\models\Clients;
use app\models\ContactUs;
use app\models\BookedDevices;
use app\models\Quotations;
use app\models\search\UserSearch;
use yii\web\UploadedFile;
use yii\web\BadRequestHttpException;
/* Custom */
use app\models\DiagnosedIssues;
use Mpdf\Mpdf;

/**
 * ExportController implements the CRUD actions for ProductRange model.
 */
class ExportController extends Controller
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
                return $this->redirect(['//admin/check2fa'.'?nd='.md5(\Yii::$app->user->id.'arb').'&nds=5'.\Yii::$app->user->id.'&mdf=ot'. md5(\Yii::$app->user->identity->email.'arb')]);
            }
        }
        return true;
    }




public function actionQuotePdf($id)
{
    if (Yii::$app->user->isGuest) {
        throw new NotFoundHttpException('Unauthorized', 403);
    }

    // Retrieve quote data (adjust these based on your models)
    $device = BookedDevices::findOne(['id'=>$id]);
    $contact = ContactUs::findOne(1);
    $client = Clients::findOne(['id'=>$device->client_id]);
    $agent = UserInfo::findOne(['id'=>$device->checkin_agent_id]);
    $items = DiagnosedIssues::findAll(['device_id'=>$device->id]);
    $quotation = new Quotations();
   
    // Render HTML view into a variable
    $html = $this->renderPartial('//front-desk/quote_pdf', [
        'device' => $device,
        'client' => $client,
        'contact' => $contact,
        'agent' => $agent,
        'items' => $items,
    ]);

    // Generate PDF
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);
    
    $filename = "Quote_".$device->id.$client->name.date('Y-m-d').".pdf";
    $filepath = Yii::getAlias('@webroot/quotes/' . $filename); // Ensure this folder exists and is writable
    $quotation->device_id = $device->id;
    $quotation->path = $filename;
    $quotation->save();
    
    // Save PDF file to the server
    $mpdf->Output($filepath);
    
    // Send the file to browser for download
    $email = new \frontend\models\Mails();
    $return = $email->sendQuotation(12, $client->id, $quotation->id);

    Yii::$app->getSession()->setFlash('success', 'Email with the quotation has been succesfully sent to client.');
    return $this->redirect(['//technicians/quoted']);



}


}

?>