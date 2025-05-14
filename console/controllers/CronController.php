<?php
namespace console\controllers;

use yii\console\Controller;

/* used models */



/**
 * Cron controller
 */
class CronController extends Controller
{   
    
    public function actionBirthdays(){
        
        $count = 0;
        $count2 = 0;
        
        $searchModel = new \console\models\search\UserInfoSearch();
        $params = [];
        $params['UserInfoSearch'] = [];
        $params['UserInfoSearch']['role'] = '50';
        $params['UserInfoSearch']['dummy_owner'] = 0;
        $params['UserInfoSearch']['birthday'] = date('1000-m-d');
        $dataProvider = $searchModel->searchBirthdays($params);
        
        
        foreach ($dataProvider->getModels() as $key => $userinfo) {
            if($userinfo->notification == 1){
                $email = new \console\models\Mails();
                $return = $email->sendBirthdayEmail(3, $userinfo->user_id, 1);
                $count++;
            }
        }
        
        $searchModel2 = new \console\models\search\UserContactsSearch();
        $params2 = [];
        $params2['UserContactsSearch'] = [];
        $params2['UserContactsSearch']['is_dummy'] = 0;
        $params2['UserContactsSearch']['birthday'] = date('1000-m-d');
        $dataProvider2 = $searchModel2->searchBirthdays($params2);
        
        
        foreach ($dataProvider2->getModels() as $key => $userinfo) {
            $maininfo = \console\models\UserInfo::findOne(['user_id' => $userinfo->user_id]);
            if(!empty($maininfo) && $maininfo->notification == 1){
                $email = new \console\models\Mails();
                $return = $email->sendBirthdayEmail(3, $userinfo->id, 2);
                $count2++;
            }
        }
        
        echo 'completed birthday emails '.$count.'-'.$count2;
        return true;
    }
    public function actionBookingConfirm(){
        
        $checkday = date('Y-m-d', strtotime(date('Y-m-d').' +3days'));
        
        $bookings = \console\models\TrimesterBookings::findAll(['date' => $checkday]);
        if(!empty($bookings)){
            foreach ($bookings as $key => $booking) {
                $groupings = \console\models\BoatsGrouping::findAll(['boat_id' => $booking->boat_id]);
                $cansend = true;
                if(!empty($groupings)){
                    foreach ($groupings as $key => $grouping) {
                        if($grouping->day_end >= $booking->date && $booking->date >= $grouping->day_start){
                            if($grouping->day_start != $booking->date){
                                $cansend = false;
                            }
                        }
                    }
                }
                if($cansend){
                    $email = new \console\models\Mails();
                    $return = $email->sendConfirmationEmail(6, $booking->id);
                }
            }
        }
        
        echo 'completed emails for booking confirmations';
        return true;
    }
    public function actionTrimesterStatusUpdate(){
        
        $trimesters = \console\models\Trimesters::find()->where(['<', 'status', 4])->all();
        if(!empty($trimesters)){
            foreach ($trimesters as $key => $trimester) {
                
                $date = date('Y-m-d');
                if($trimester->status == 1){
                    if($trimester->cron_date_emails == $date){
                        $trimester->status = 2;
                        $trimester->save(false);
                        $usershares = \console\models\UserShares::findAll(['trimester_id' => $trimester->id]);
                        $email = new \console\models\Mails();
                        foreach ($usershares as $key => $usershare) {
                            $return = $email->sendNominationsEmail(2, $usershare->user_id, $usershare->id, $trimester->id);//nominations link email
                        }
                        echo '==='.$trimester->id.'- Sent Nominations===';
                        //continue;
                    }
                }
                if($trimester->status == 2){
                    if($trimester->cron_date_viewable == $date){
                        $trimester->status = 3;
                        $trimester->save(false);
                        echo '==='.$trimester->id.'- Went Viewable===';
                        //continue;
                    }
                }
                if($trimester->status == 3){
                    if($trimester->cron_date_live == $date){
                        $trimester->status = 4;
                        $trimester->go_live = date('Y-m-d');
                        $trimester->save(false);
                        echo '==='.$trimester->id.'- Went Live===';
                        //continue;
                    }
                }
                
                /*$email = new \console\models\Mails();
                $return = $email->sendConfirmationEmail(6, $booking->id);*/
            }
        }
        
        echo 'done trimester updates';
        return true;
    }
    
    
    
}
