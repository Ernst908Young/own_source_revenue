<?php

/*

@Date:10Feb2018
@Author:Pankaj Kumar Tiwari
@Description:End To End Message Application

*/


class LandownerMessageController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
	 
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'manage', 'view', 'create', 'update', 'documentview','sent', 'inbox', 'conversation', 'saveConversation','pi'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    /*public function actionView() {
        //$sql = "SELECT * FROM bo_landowner_connect  WHERE id=$id ";
        //$connection = Yii::app()->db;
       // $command = $connection->createCommand($sql);
        $services = array(); //$command->queryRow();
        $this->render('view', array(
            'apps' => $services,
        ));
    } */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
	 
    public function actionCreate() {
		
		
		//echo 'reached';  print_r($_POST);  exit();   
		
		$model = new LandownerMessage;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
		
        $guestUserUrl = "";
		
        if (isset($_POST['message'])) {
			
            $model->message = $_POST['message'];
			
            // Saving current loggedin User
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $model->from_user = $_SESSION['RESPONSE']['user_id'];
				$model->from_user_type =1;
            }else if (!empty($_SESSION['uid'])){
                 $model->from_user=$_SESSION['uid'];
				 $model->from_user_type=2;
            }else{
				 //$model->from_user=substr($_SESSION['land_user_id'],12);
				 $land_mobile=$_SESSION['land_mobile'];
				 $model->from_user=$land_mobile;
				 $model->from_user_type=3;
			}	
			
			$land_id= base64_decode($_POST['land_id']); 
			$model->land_id=$land_id;
            $model->is_deleted = 0;
            $model->created_date = date('Y-m-d h:i:s');
            $model->updated_date = date('Y-m-d h:i:s');
			$model->remote_ip =  $_SERVER['REMOTE_ADDR'];
			$model->user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			$land_owner=$this->actionGetLandOwner($land_id);
			$guest_land_owner=$this->actionGuestLandOwner($land_id);
			
			$model->to_user=(($land_owner['user_id']>0)?$land_owner['user_id']:(($land_owner['dept_user_id'])>0?$land_owner['dept_user_id']:$guest_land_owner['owner_contact_no']));
		    $model->to_user_type=(($land_owner['user_id']>0)?1:(($land_owner['dept_user_id'])>0?2:3));
		    
			// echo '<pre/>';  print_r($_SESSION); print_r($model); exit();  
			
            if ($model->save(false)) {
				  
				        $conversation_id=base64_encode ($model->id);
			            $url="/backoffice/iloc/landownerMessage/conversation?message_id=".$conversation_id;
				        $this->redirect($url);
				
            }
        }
		
		
		
    }
	
	public function actionGuestLandOwner($land_id){
		
		   $row=Yii::app()->db->createCommand()->select('*')->from('bo_landowner_contact')->where('land_id='.$land_id)->queryRow();
           return $row; //print_r($row);   exit();
		
	}
	
	public function actionGetLandOwner($land_id){
		
		   $row=Yii::app()->db->createCommand()->select('*')->from('bo_landowner_connect')->where('id='.$land_id)->queryRow();
           return $row; //print_r($row);   exit();
		
	}




    public function actionsaveConversation() {
		
		$model = new LandownerMessage;
        if (isset($_POST['message'])) {
			
            $model->message = $_POST['message'];
			$model->from_user = $_POST['from_user'];
			$model->from_user_type =$_POST['from_user_type'];
			$model->to_user=$_POST['to_user'];
		    $model->to_user_type=$_POST['to_user_type'];
			$model->land_id=$_POST['land_id'];
            $model->is_deleted = 0;
            $model->created_date = date('Y-m-d h:i:s');
            $model->updated_date = date('Y-m-d h:i:s');
			$model->remote_ip =  $_SERVER['REMOTE_ADDR'];
			$model->user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			//echo '<pre/>'; print_r($model); print_r($_POST);  exit();
			
			
			 if ($model->save(false)) {
				
				$html='';
				
				$html.='<li class="out"><div class="message"><span class="arrow"> </span>
						<a href="javascript:;" class="name">Me </a>';
				$html.='<span class="datetime"> at '. date("d M Y H:i:s a").' </span> ';
				$html.='<span class="body">'. $_POST["message"] .'</span>
							</div></li>';
				
				echo $html;
			}
        }else{
			$html='';
			echo $html;
		}
		
		
		
    }	
	
	

    public function actionSent() {
		
		$connection = Yii::app()->db;
		
		$login_user=0;
		$user_type=0;
		
		    // Saving current loggedin User
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $login_user = $_SESSION['RESPONSE']['user_id'];
				$user_type =1;
            }else if (!empty($_SESSION['uid'])){
                 $login_user=$_SESSION['uid'];
				 $user_type=2;
            }else{
				 //$login_user=substr($_SESSION['land_user_id'],12);
				 $land_mobile=$_SESSION['land_mobile'];
				 $login_user=$land_mobile;
				 
				 $user_type=3;
			}
			
			
			//print_r($_SESSION);   exit();

        		
			
		
		$sent_messages=Yii::app()->db->createCommand( 'SELECT blm.*, land_title FROM bo_landowner_message as blm JOIN bo_landowner_connect as blc ON blc.id=blm.land_id WHERE blm.id IN ( SELECT MAX(id) FROM bo_landowner_message WHERE from_user='.$login_user.' AND from_user_type='.$user_type.' GROUP BY land_id ) ORDER BY blm.id DESC')->queryAll();	
		
		
		$conversations=array();
		
		
		if($sent_messages){
		foreach($sent_messages as $key=>$message){
			
				$to_user=$message['to_user'];
				$from_user=$message['from_user'];
				
				$land_id=$message['land_id'];
				$send_to=($login_user==$from_user)?$to_user:$from_user;
				$send_to_user_type=($login_user==$from_user)?$message['to_user_type']:$message['from_user_type'];
				
				$total_messages=Yii::app()->db->createCommand( 'SELECT count(id) as total FROM bo_landowner_message WHERE (( from_user='.$login_user.' AND to_user='.$send_to.' ) OR (from_user='.$send_to.' AND to_user='.$login_user.')) AND land_id='.$land_id)->queryAll();	
				$new_messages=Yii::app()->db->createCommand( 'SELECT count(id) as total FROM bo_landowner_message WHERE from_user='.$send_to.' AND to_user='.$login_user.' AND land_id='.$land_id.' AND is_seen=0')->queryAll();	
				$message['total']=($total_messages[0]['total']>0)?$total_messages[0]['total']:0;
				$message['new_total']=($new_messages[0]['total']>0)?$new_messages[0]['total']:0;
				$message['to_user_name']=$this->actiongetUserName($send_to, $send_to_user_type);
		
					
				$conversations[$key]=$message;
		
		
	   }}
		
		$this->render('sent',array(
			'sent_messages'=>$conversations
		));
    }
	
	
    public function actionInbox() {
        $connection = Yii::app()->db;
		
		//print_r($_SESSION);   exit();
		
		$login_user=0;
		$user_type=0;
		
		// Saving current loggedin User
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $login_user = $_SESSION['RESPONSE']['user_id'];
				$user_type =1;
            }else if (!empty($_SESSION['uid'])){
                 $login_user=$_SESSION['uid'];
				 $user_type=2;
            }else{
				// $login_user=substr($_SESSION['land_user_id'],12);
				 $land_mobile=$_SESSION['land_mobile'];
				 $login_user=$land_mobile;
				 $user_type=3;
			}	
		
		    $recieved_messages=Yii::app()->db->createCommand( 'SELECT blm.*, land_title FROM bo_landowner_message as blm JOIN bo_landowner_connect as blc ON blc.id=blm.land_id WHERE blm.id IN ( SELECT MAX(id) FROM bo_landowner_message WHERE to_user='.$login_user.' AND to_user_type='.$user_type.' GROUP BY land_id ) ORDER BY id DESC')->queryAll();	
			
			
		
			$conversations=array();
			if($recieved_messages){
			foreach($recieved_messages as $key=>$message){
				
					$from_user=$message['from_user'];
					$to_user=$message['to_user'];
					$land_id=$message['land_id'];
					
					$send_to=($login_user==$from_user)?$to_user:$from_user;
			        $send_to_user_type=($login_user==$from_user)?$message['to_user_type']:$message['from_user_type'];
					
					
					$total_messages=Yii::app()->db->createCommand( 'SELECT count(id) as total FROM bo_landowner_message WHERE (( from_user='.$login_user.' AND to_user='.$send_to.' ) OR (from_user='.$send_to.' AND to_user='.$login_user.')) AND land_id='.$land_id)->queryAll();	
					$new_messages=Yii::app()->db->createCommand( 'SELECT count(id) as total FROM bo_landowner_message WHERE  from_user='.$send_to.' AND to_user='.$login_user.' AND land_id='.$land_id.' AND is_seen=0')->queryAll();	
					$message['total']=($total_messages[0]['total']>0)?$total_messages[0]['total']:0;
					$message['new_total']=($new_messages[0]['total']>0)?$new_messages[0]['total']:0;
					$message['to_user_name']=$this->actiongetUserName($send_to, $send_to_user_type);
					$conversations[$key]=$message;
			
			
		   }}
		
		
        $this->render('inbox',array(
			'recieved_messages'=>$conversations,
		));
		
    }
	
	
    public function actionConversation($message_id) {
		
		
		$message_id = base64_decode($message_id);
		
		$connection = Yii::app()->db;
			
		// updating setting data related to property 
		$message = Yii::app()->db->createCommand(array(
				'select' => '*',
				'from' => 'bo_landowner_message',
				'where' => 'id=:id',
				'params' => array(':id'=>$message_id),
			))->queryRow();	
		
		
		$from_user=$message['from_user'];
		$to_user=$message['to_user'];
		$land_id=$message['land_id'];
		
		    $login_user=0;
			$login_type=0;
			//echo '<pre/>';  print_r($_SESSION); print_r($model); exit();
             if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $login_user = $_SESSION['RESPONSE']['user_id'];
				$login_type =1;
            }else if (!empty($_SESSION['uid'])){
                 $login_user=$_SESSION['uid'];
				 $login_type=2;
            }else{
				 //$login_user=substr($_SESSION['land_user_id'],12);
				 $land_mobile=$_SESSION['land_mobile'];
				 $login_user=$land_mobile;
				 $login_type=3;
			}
		
		$send_to=($login_user==$from_user)?$to_user:$from_user;
		$send_to_type=($login_user==$from_user)?$message['to_user_type']:$message['from_user_type'];
		
		
		$conversation=Yii::app()->db->createCommand( 'SELECT blm.*, land_title FROM bo_landowner_message as blm JOIN bo_landowner_connect as blc ON blc.id=blm.land_id WHERE (( blm.from_user='.$from_user.' AND blm.to_user='.$to_user.' ) OR ( blm.from_user='.$to_user.' AND blm.to_user='.$from_user.' ))  AND blm.land_id='.$land_id.' ORDER BY blm.id ASC')->queryAll();	
		$user_name=$this->actiongetUserName($send_to, $send_to_type);
		
		//echo '<pre/>'; echo $send_to; print_r($send_to_type);  exit();
		
		// Update messages as seen
		
		$connection = Yii::app()->db;
		$propertyDetail = $connection->createCommand("UPDATE bo_landowner_message SET is_seen='1' WHERE to_user=$login_user AND land_id=$land_id AND from_user=$send_to")->execute(); 
		
		
        $this->render('conversation',array(
			'conversation'=>$conversation, 'login_user'=>$login_user,'login_type'=>$login_type, 'to_user_name'=>$user_name, 'send_to'=>$send_to, 'send_to_type'=>$send_to_type
		));
		
    }
	
	
	public function actiongetUserName($to_user, $to_user_type){
		
		$user_name='';
		if($to_user_type==1){
			
			$user = Yii::app()->db->createCommand(array(
				'select' => 'first_name, last_name',
				'from' => 'sso_profiles',
				'where' => 'user_id=:user_id',
				'params' => array(':user_id'=>$to_user),
			))->queryRow();	
			
			
			$user_name=$user['first_name'].' '.$user['last_name'];
			
		}else if($to_user_type==2){
			
			$user = Yii::app()->db->createCommand(array(
				'select' => 'full_name',
				'from' => 'bo_user',
				'where' => 'uid=:user_id',
				'params' => array(':user_id'=>$to_user),
			))->queryRow();	
			
			$user_name=$user['full_name'];
			
			
		}else if($to_user_type==3){	
		    
			/* $user = Yii::app()->db->createCommand(array(
				'select' => 'mobile_number',
				'from' => 'bo_landowner_users',
				'where' => 'id=:user_id',
				'params' => array(':user_id'=>$to_user),
			))->queryRow();	
			
			$user_name=$user['mobile_number']; */
			
			$user_name=$to_user;
			
		
		}
		
		return $user_name;
		
		
	}	
	
	
	
	
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return LandownerConnect the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = LandownerConnect::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param LandownerConnect $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'landowner-chat-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    
	
public function actionPi()
        {
     phpinfo(); die;
        }
    
	
	

}
