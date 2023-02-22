<?php

require_once(Yii::app()->basePath.'/modules/queries/components/Alertsandnotification.php');
Yii::import('application.modules.infowizardtwo.components.*',true);
class DefaultController extends Controller {
	


	public function actionIndex(){
		if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id']){

		}else{
			
			$this->layout = '//layouts/guest_query';
			
		}
		
		 //$fileModel = new Uploadfile;
		if(isset($_POST['subject']) && isset($_POST['name']) && isset($_POST['mobile_no']) && isset($_POST['email']) && isset($_POST['type']) && isset($_POST['message'])){

			if($_POST['subject']!='' && $_POST['name']!='' && $_POST['mobile_no']!='' && $_POST['email']!='' && $_POST['type']!='' && $_POST['message']!=''){

				if(isset($_SESSION['RESPONSE']['user_id']) && $_SESSION['RESPONSE']['user_id']){
					$captcha_validation = true;
				}else{
					$captcha = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
					if($_SESSION['CAPTCHA_CODE']== $captcha){
						$captcha_validation = true;
					}else{
						$captcha_validation = false;
					}				
				}	

				

				if($captcha_validation==true){
					$model = new Querymain;
					$model->servicecategory = DefaultUtility::dataSenetize( $_POST['servicecategory']);
					$next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(id),0)+1 as max FROM querymain')->queryScalar();

					$model->querycode = date('y').$next_id;
					$model->subject = DefaultUtility::dataSenetize($_POST['subject']);
					$model->service_id = DefaultUtility::dataSenetize($_POST['service_id']);
					$model->mobile_no = isset($_POST['mobile_no']) ? $_POST['mobile_no'] : NULL;
					$model->name = isset($_POST['name']) ? $_POST['name'] : NULL;
					$model->email = isset($_POST['email']) ? $_POST['email'] : NULL;
					$model->user_id = isset($_SESSION['RESPONSE']['user_id']) ? @$_SESSION['RESPONSE']['user_id'] : NULL;
					$model->query_type = DefaultUtility::dataSenetize($_POST['type']);
					$model->querypriority = 'Normal';
					$model->updated_on = date('Y-m-d H:i:s');
					$model->save();

					$msgModel = new Querymessage;
					$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
					$msgModel->user_type = $model->user_id == NULL ? "URU" :"AU";
					$msgModel->user_id = $model->user_id;
					$msgModel->querymain_id = $model->id;			
					$msgModel->save();


					$subject = "CAIPO-Query";
		        	$to = $model->email;
		        	$name = '';
				
				
					 $notification_msg_fo = 'Your Query has been submitted successfully';
					 $content = "Dear User, You have Successfully created a Query with Query ID  (".$model->querycode.") on CAIPO.<br><br>
					Regards,<br>
					Corporate Affairs and Intellectual Property Office<br>
					Ground Floor, BAOBAB Tower, Warrens<br>
					St. Michael, Barbados<br>
					Tel: (246) 535-2401 Fax: (246) 535-2444<br>
					<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
					Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

				$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
		        DefaultUtility::post_to_url(EMAIL_API,$post_data);
		        

					 Yii::app()->user->setFlash('success', "Query Id : $model->querycode has been submitted successfully. ");
					 if($model->user_id){
					 	Alertsandnotification::sendnotification('Query', $model->querycode,$model->querycode,$model->user_id,'FO',$notification_msg_fo); 
					 	return $this->redirect('/backoffice/investor/services/ticketquery/tq');
					 }else{
					 	return $this->redirect('/backoffice/queries/default/unregthreddetail/q_id/'.$model->id);
					 }
				}else{
					Yii::app()->user->setFlash('error', "Captcha is invalid.");
					return $this->redirect('index');
				}
			
			}else{
				Yii::app()->user->setFlash('error', "* fields are mandatory");
				return $this->redirect('index');
			}			
			 
		}
		$service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();
	
		return $this->render('index',array('service_category'=>$service_category));
	}

	public function actionUnregsearch(){
		if(isset($_POST['q_code']) && isset($_POST['email'])){
			$q_code = $_POST['q_code'];
			$email = $_POST['email'];
			$record = Yii::app()->db->createCommand("SELECT q.id
			 FROM querymain as q 			
			WHERE q.querycode='".$q_code."' AND q.email='".$email."'")->queryRow();

			if($record){
				return $this->redirect('/backoffice/queries/default/unregthreddetail/q_id/'.$record['id']);
			}else{
				//Yii::app()->user->setFlash('error', "No Data Found for this details <br> Query Id : <b>$q_code</b> And Email : <b>$email</b>");
				Yii::app()->user->setFlash('error', "No Data Found");
				Yii::app()->user->setFlash('q_code', $q_code);
				Yii::app()->user->setFlash('email', $email);
				return $this->redirect('/backoffice/queries/default/index');
			}
			
		}
	}

	public function actionUnregthreddetail($q_id){
		if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id']){

		}else{
			$this->layout = '//layouts/guest_query';
		}
		$qmain = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
			q.mobile_no,
			q.email,
			q.name,
			q.servicecategory,
			q.service_id,
			q.user_id,
			q.querypriority,
			q.subject,
			q.created_on,
			q.status,
			s.service_name,
			sc.category_name
			 FROM querymain as q 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
			WHERE q.id=$q_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM querymessage			
			WHERE querymain_id=$q_id order by msgdatetime DESC")->queryAll();

		if(isset($_POST['message'])){
			$msgModel = new Querymessage;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			/*$msgModel->user_id = isset($_SESSION['RESPONSE']['user_id']) ? @$_SESSION['RESPONSE']['user_id'] : NULL;
			$msgModel->user_type = $msgModel->user_id == NULL ? "URU" :"AU";*/
			$msgModel->user_type = "URU";
			$msgModel->querymain_id = $q_id;
			$msgModel->save();
			$model = Querymain::model()->findByPk($msgModel->querymain_id);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			return $this->redirect('/backoffice/queries/default/unregthreddetail/q_id/'.$q_id);
		}


		return $this->render("unregthreddetail",array('qmain'=>$qmain,'messages'=>$messages,'q_id'=>$q_id));
	}

	public function actionDashboard(){
		$uid = @$_SESSION['RESPONSE']['user_id'];
		$queries = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
			q.mobile_no,
			q.email,
			q.servicecategory,
			q.service_id,
			q.user_id,
			q.querypriority,
			q.subject,
			q.created_on,
			q.status,
			s.service_name,
			sc.category_name
			 FROM querymain as q 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
			WHERE q.user_id=$uid order by created_on DESC")->queryAll();
		return $this->render('dashboard',array('queries'=>$queries));
	}

	public function actionQuerydetail($q_id){
		
		$qmain = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
			q.mobile_no,
			q.email,
			q.servicecategory,
			q.service_id,
			q.user_id,
			q.querypriority,
			q.subject,
			q.created_on,
			q.status,
			s.service_name,
			sc.category_name
			 FROM querymain as q 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id    
			WHERE q.id=$q_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM querymessage			
			WHERE querymain_id=$q_id order by msgdatetime DESC")->queryAll();


		if(isset($_POST['message'])){
			$msgModel = new Querymessage;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->user_id = isset($_SESSION['RESPONSE']['user_id']) ? @$_SESSION['RESPONSE']['user_id'] : NULL;
			$msgModel->user_type = $msgModel->user_id == NULL ? "URU" :"AU";
			$msgModel->querymain_id = $q_id;
			$msgModel->save();
			$model = Querymain::model()->findByPk($msgModel->querymain_id);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			return $this->redirect('/backoffice/queries/default/querydetail/q_id/'.$q_id);
		}

		return $this->render('query_detail',array('qmain'=>$qmain,'messages'=>$messages,'q_id'=>$q_id));
	}

	public function actionSupportindex(){
		return $this->render('support_index');
	}

	public function actionSupportquerydetail($q_id){
		$qmain = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
			q.mobile_no,
			q.name,
			q.email,
			q.servicecategory,
			q.service_id,
			q.user_id,
			q.querypriority,
			q.subject,
			q.created_on,
			q.status,
			s.service_name,
			sc.category_name
			 FROM querymain as q 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id   
			WHERE q.id=$q_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM querymessage			
			WHERE querymain_id=$q_id order by msgdatetime DESC")->queryAll();


		if(isset($_POST['message'])){
			$msgModel = new Querymessage;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->user_id = $_SESSION['uid'];
			$msgModel->user_type = "BU";
			$msgModel->querymain_id = $q_id;
			$msgModel->save();
			$model = Querymain::model()->findByPk($msgModel->querymain_id);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			return $this->redirect('/backoffice/queries/default/supportquerydetail/q_id/'.$q_id);
		}

		return $this->render('support_query_detail',array('qmain'=>$qmain,'messages'=>$messages,'q_id'=>$q_id));
	}

	public function actionStatuspriority(){
		if(isset($_POST['tktpri'])){
			$model = Querymain::model()->findByPk($_POST['id']);
			$model->querypriority = $_POST['tktpri'];
			$model->status = $_POST['status'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			$notification_msg_fo = 'Your query priority/status has been changed';
        	$notification_msg_bo = 'Priority/Status has been changed';
        	Alertsandnotification::sendnotification('Query', $model->querycode,$model->querycode,$model->user_id,'FO',$notification_msg_fo); 
			Alertsandnotification::sendnotification('Query', $model->querycode,$model->querycode,$_SESSION['uid'],'BO',$notification_msg_bo); 
			echo CJavaScript::jsonEncode(array('status'=>true));
		}
	}


	  public function actionGetservices($category = NULL){
      
         
		/*$services = array(array('id'=>4,'service'=>'Incorporation Of Company - 4.0'),array('id'=>7,'service'=>'Registration of Charity as Board - 7.0'),array('id'=>8,'service'=>'Registration of External Company - 8.0'));*/
	   /*$services = Yii::app()->db->createCommand("SELECT * from bo_information_wizard_service_master where $category=1")->queryAll();*/

		$services = Yii::app()->db->createCommand("SELECT id,sc_id,service_name
			  from bo_information_wizard_service_master      	 	
			   where sc_id=$category")->queryAll();

		if($services){ 
			echo "<option value=''>Select Service</option>";
		   foreach ($services as $key => $value) {
			echo "<option value='".$value['id']."'>".$value['service_name']."</option>";
		   }
		}else{
		   echo "<option>-</option>";
		}
	 }

       public function actionGetsrn($s_id = NULL){      
         $ser_id = $s_id.'.0';
         /*$srn = array(array('id'=>65,'srn'=>'65'),array('id'=>93,'srn'=>'93'),array('id'=>95,'srn'=>'95'));*/
         $srn = Yii::app()->db->createCommand("SELECT * from bo_new_application_submission where service_id='".$ser_id."'")->queryAll();
         if($srn){
         	echo "<option value=''>Select Application ID</option>";
            foreach ($srn as $key => $value) {
             echo "<option value='".$value['submission_id']."'>".$value['submission_id']."</option>";
            }
         }else{
            echo "<option>-</option>";
         }
      }
}