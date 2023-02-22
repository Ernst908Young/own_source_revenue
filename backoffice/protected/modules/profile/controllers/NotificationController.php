<?php

class NotificationController extends Controller {
    public function init()
        {
            if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id'] || @$_SESSION['RESPONSE']['agent_user_id'])
            {
                
            }else{
                $this->redirect(Yii::app()->createAbsoluteUrl("../sso/account/signin"));
            }
        }

   
    
    public function actionDashboard(){
        $srn_no = NULL;
        $model = new AlertNotification;
        if(isset($_GET['an_id']) && isset($_GET['nc'])){
            $an_id = base64_decode($_GET['an_id']);
            $nc = base64_decode($_GET['nc']);
            if($nc==true && $_GET['an_id']!=''){
                $sql = "SELECT * FROM alert_notification where id=$an_id";
                $model = AlertNotification::model()->findBySql($sql); 
                if($model){
                    $model->is_seen =1;
                    $model->save();
                    $srn_no = $model->module_code;
                }
                
            }
        }
        return $this->render('dashboard',['model'=>$model]);
    }

    public function actionAllseen(){

        $uid = $ut = NULL;
        if(isset($_SESSION['RESPONSE']['user_id'])){
            $uid=$_SESSION['RESPONSE']['user_id'];
            $ut = 'FO';
        }else{
            if(isset(Yii::app()->session['uid'])){
                $uid=$_SESSION['uid'];
                 $ut = 'BO';
            }
        }
        if($uid){
             Yii::app()->db->createCommand("UPDATE alert_notification SET is_seen=1 WHERE is_seen=0 AND created_by=$uid AND user_type='$ut'")->execute();
        }
       
        return $this->redirect(Yii::app()->request->urlReferrer);
    }
}