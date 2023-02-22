<?php

require_once(Yii::app()->basePath.'/modules/ticketing/components/Alertsandnotification.php');
Yii::import('application.modules.infowizardtwo.components.*',true);
class DefaultController extends Controller {
	/*public function init()
		{
		    if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id'])
		    {
		        
		    }else{
		    	$this->redirect(Yii::app()->createAbsoluteUrl("../sso/account/signin"));
		    }
		}*/
	public function actionIndex(){
		$fileModel = new Uploadfile;
		
		if(isset($_POST['subject'])){
			
			$model = new Supportmain;
			$model->servicecategory = DefaultUtility::dataSenetize($_POST['servicecategory']);
			$next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(supportmaincode),0)+1 as max FROM supportmain')->queryScalar();
			$model->supporttypecode = date('y').$next_id;
			$model->subject = DefaultUtility::dataSenetize($_POST['subject']);
			$model->service_id = DefaultUtility::dataSenetize($_POST['service_id']);
			$model->srn_app_id = DefaultUtility::dataSenetize($_POST['srn_app_id']);
			$model->ticket_type = DefaultUtility::dataSenetize($_POST['type']);
			$model->supportprioritycode = 'Normal';
			$model->usercode = @$_SESSION['RESPONSE']['user_id'];
			$model->updated_on = date('Y-m-d H:i:s');
			

			$model->save();
			$msgModel = new Supportmessages;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->usercode = @$_SESSION['RESPONSE']['user_id'];
			$msgModel->usertype = "AU";
			$msgModel->supportmaincode = $model->supportmaincode;
			$msgModel->save();

			$filepaths = Yii::app()->db->createCommand("SELECT * FROM supportmsgfiles_temp WHERE user_id = ".$model->usercode)->queryAll();
			foreach ($filepaths as $key => $value) {
				$file = new Supportmsgfiles;
				$file->msgfilepath = $value['file_path'];
				$file->supportmessagescode = $msgModel->supportmessagescode;
				$file->save();
			}

			Yii::app()->db->createCommand("DELETE FROM supportmsgfiles_temp WHERE user_id = ".$model->usercode)->execute();

		/*if(isset($_POST['Uploadfile'])) {
			$file = new Supportmsgfiles;
            $fileModel->attributes=$_POST['Uploadfile'];
            $fileModel->image=CUploadedFile::getInstance($fileModel,'image');

            if (!is_dir(Yii::app()->basePath .'/uploads')) {
                mkdir(Yii::app()->basePath .'/uploads');
            }

             if (!is_dir(Yii::app()->basePath .'/uploads/tickets')) {
                mkdir(Yii::app()->basePath .'/uploads/tickets');
            }
           
                $path = Yii::app()->basePath.'/uploads/tickets/'.$fileModel->image;
                $fileModel->image->saveAs($path);
                $file->supportmessagescode = $msgModel->supportmessagescode;
            	$file->msgfilepath = '/backoffice/protected/uploads/tickets/'.$fileModel->image;;
            		$model->filepath = '/backoffice/protected/uploads/tickets/'.$fileModel->image;
            	//	$model->save();
            	//$file->save();
        }*/
		


 		
			

			
			

		
			$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
				from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=$model->usercode")->queryRow();
			$dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			

			
		$subject = "CAIPO-Ticket";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
		$notification_msg_fo = 'Your Ticket has been submitted successfully';
        $content = "Dear ".$dear_name.",<br><br> Your Ticket has been successfully submitted in CAIPO Portal. You are allotted Ticket ID <b>".$model->supporttypecode."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";


        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'FO',$notification_msg_fo); 

			 Yii::app()->user->setFlash('success', "Ticket Id : $model->supporttypecode has been submitted successfully. ");
			 return $this->redirect('/backoffice/investor/services/ticketquery/tq');
		}

		$srns = Yii::app()->db->createCommand("SELECT submission_id, service_id FROM bo_new_application_submission WHERE user_id = ".$_SESSION['RESPONSE']['user_id'])->queryAll();
		$service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();

		return $this->render('index',array('srns'=>$srns,'service_category'=>$service_category,'fileModel'=>$fileModel,'user_id'=>$_SESSION['RESPONSE']['user_id']));
	}

	public function actionBocreate(){
		$fileModel = new Uploadfile;		
		$user_id = @$_SESSION['uid'];

		if(isset($_POST['subject'])){			
			$model = new Supportmain;
			$model->servicecategory = DefaultUtility::dataSenetize($_POST['servicecategory']);
			$next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(supportmaincode),0)+1 as max FROM supportmain')->queryScalar();
			$model->supporttypecode = date('y').$next_id;
			$model->subject = DefaultUtility::dataSenetize($_POST['subject']);
			$model->service_id = DefaultUtility::dataSenetize($_POST['service_id']);
			$model->srn_app_id = DefaultUtility::dataSenetize($_POST['srn_app_id']);
			$model->ticket_type = DefaultUtility::dataSenetize($_POST['type']);
			$model->supportprioritycode = 'Normal';
			$model->usercode = @$_SESSION['uid'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->user_type = 'BO';
			$model->save(); 
			$msgModel = new Supportmessages;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->usercode = @$_SESSION['uid'];
			$msgModel->usertype = "AU";
			$msgModel->supportmaincode = $model->supportmaincode;
			$msgModel->save();

			$filepaths = Yii::app()->db->createCommand("SELECT * FROM supportmsgfiles_temp WHERE user_id = ".$model->usercode)->queryAll();
			foreach ($filepaths as $key => $value) {
				$file = new Supportmsgfiles;
				$file->msgfilepath = $value['file_path'];
				$file->supportmessagescode = $msgModel->supportmessagescode;
				$file->save();
			}

		Yii::app()->db->createCommand("DELETE FROM supportmsgfiles_temp WHERE user_id = ".$model->usercode)->execute();
		

		$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user 
				where uid=$model->usercode")->queryRow();

	   	$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
		$subject = "CAIPO-Ticket";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_bo = 'Your Ticket has been successfully submitted';
        $content = "Dear ".$dear_name.",<br><br> Your Ticket has been successfully submitted in CAIPO Portal. You are allotted Ticket ID <b>".$model->supporttypecode."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

         $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
         DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		 Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'BO',$notification_msg_bo); 
		 Yii::app()->user->setFlash('success', "Ticket Id : $model->supporttypecode has been submitted successfully. ");
		 return $this->redirect('/backoffice/investor/services/boticket/otd/ct');
		}

		$srns = Yii::app()->db->createCommand("SELECT submission_id, service_id FROM bo_new_application_submission WHERE user_id = ".$user_id)->queryAll();
		$service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();
		return $this->render('bo/create',array('srns'=>$srns,'service_category'=>$service_category,'fileModel'=>$fileModel,'user_id'=>$user_id));
	}

public function actionFileupload(){
	header('Content-Type: application/json'); // set json response headers   
  
    $fileBlob = 'fileBlob'; // the parameter name that stores the file blob
   
	$acceptedFormats = array('png','jpg','pdf','PNG','JPEG' ,'JPG', 'jpeg');

                    
    if (isset($_FILES[$fileBlob]) && isset($_POST['uploadToken']) && isset($_POST['user_id'])) {
    	$user_id = $_POST['user_id']; 
    	$fileId = $_POST['fileId'];  
    	$path_parts = pathinfo($fileId);
		$extension = $path_parts['extension'];

    	$file = $_FILES[$fileBlob]['tmp_name']; 

    	 if(in_array($extension, $acceptedFormats)){
    	 	 $targetDir = Yii::app()->basePath .'/uploads/tickets';
			    if (!file_exists($targetDir)) {
			        @mkdir($targetDir);
			    }
			     $targetFile = $targetDir.'/'.$fileId; 
		     
		        if(move_uploaded_file($file, $targetFile)) {
		        	$file_path = '/backoffice/protected/uploads/tickets/'.$fileId;
		        	Yii::app()->db->createCommand('INSERT INTO supportmsgfiles_temp (user_id, file_path) VALUES ("'.$user_id.'", "'.$file_path.'")')->execute();
		             echo json_encode(array('status'=>true));exit();
		        } else {
		            echo json_encode(array('status'=>false));exit();
		        }

    	 }else{
    	 	 echo json_encode(array('status'=>false,'msg'=>'Invalid File Type'));exit();
    	 }   
    }else{
    	 echo json_encode(array('status'=>false,'msg'=>'something was missing'));exit();
    }
}

	public function actionDashboard(){
		$uid = @$_SESSION['RESPONSE']['user_id'];
		$tickets = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
			sm.supporttypecode,
			sm.servicecategory,
			sm.supportprioritycode,
			sm.subject,
			sm.status,
			sm.service_id,
			sm.srn_app_id,
			sm.created_on,
			sm.filepath,
			s.service_name,
			sc.category_name,
			sm.ticket_type
			 FROM supportmain as sm 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
			WHERE sm.usercode=$uid order by created_on DESC")->queryAll();
		return $this->render('dashboard',array('tickets'=>$tickets));
	}

	public function actionTicketdetail($sm_id){
		
		$ticket = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
			sm.supporttypecode,
			sm.servicecategory,
			sm.supportprioritycode,
			sm.subject,
			sm.status,
			sm.service_id,
			sm.srn_app_id,
			sm.created_on,
			s.service_name,
			sc.category_name
			 FROM supportmain as sm 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id   
			WHERE sm.supportmaincode=$sm_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM supportmessages			
			WHERE supportmaincode=$sm_id order by msgdatetime DESC")->queryAll();


		if(isset($_POST['message'])){
			$msgModel = new Supportmessages;
			$msgModel->message = $_POST['message'];
			if(isset($_SESSION['RESPONSE']['user_id'])){
				$msgModel->usercode = $_SESSION['RESPONSE']['user_id'];
			}else{
				if(isset($_SESSION['uid'])){
					$msgModel->usercode = $_SESSION['uid'];
				}else{
					return $this->redirect('/backoffice/ticketing/default/ticketdetail/sm_id/'.$sm_id);
				}
			}
			
			$msgModel->usertype = "AU";
			$msgModel->supportmaincode = $sm_id;
			$msgModel->save();
			$model = Supportmain::model()->findByPk($msgModel->supportmaincode);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			
			return $this->redirect('/backoffice/ticketing/default/ticketdetail/sm_id/'.$sm_id);
		}

		return $this->render('ticket_detail',array('ticket'=>$ticket,'messages'=>$messages,'sm_id'=>$sm_id));
	}

	public function actionSupportindex(){
		return $this->render('support_index');
	}

	public function actionHighsupportindex(){
		return $this->render('high_support_index');
	}

	public function actionSupportticketdetail($sm_id){
		$ticket = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
			sm.supporttypecode,
			sm.servicecategory,
			sm.supportprioritycode,
			sm.subject,
			sm.status,
			sm.service_id,
			sm.srn_app_id,
			sm.created_on,
			s.service_name,
			 sc.category_name,
			 sm.currently_assign_to
			 FROM supportmain as sm 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id    
			WHERE sm.supportmaincode=$sm_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM supportmessages			
			WHERE supportmaincode=$sm_id order by msgdatetime DESC")->queryAll();

		if(isset($_POST['message'])){
			$msgModel = new Supportmessages;
			$msgModel->message = $_POST['message'];
			$msgModel->usercode = $_SESSION['uid'];
			$msgModel->usertype = "BU";
			$msgModel->supportmaincode = $sm_id;
			$msgModel->save();
			$model = Supportmain::model()->findByPk($msgModel->supportmaincode);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->status = $_POST['status'];
			
			if($model->status=='RS'){				
				$dear_name = 'Applicant';
				if(isset($_SESSION['RESPONSE']['user_id'])){
					$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.user_id=$model->usercode")->queryRow();
				 $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			}

			if(isset($_SESSION['uid'])){
				$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user 
				where uid=$model->usercode")->queryRow();

	   			$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
			}
				


				

		$subject = "CAIPO-Ticket";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
		$notification_msg_fo = 'Your Ticket has been resolved and closed';
		$content = "Dear ".$dear_name.",<br><br> Your Ticket with Ticket ID <b>".$model->supporttypecode."</b> has been resolved and closed. <br><br>If you believe that the ticket should be re-opened, please log into your account on our site directly and manually re-open the ticket.<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
	   	Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
		
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'FO',$notification_msg_fo); 
			}
			$model->save();
			return $this->redirect('/backoffice/ticketing/default/supportticketdetail/sm_id/'.$sm_id);
		}

		return $this->render('support_ticket_detail',array('ticket'=>$ticket,'messages'=>$messages,'sm_id'=>$sm_id));
	}

	public function actionStatuspriority(){
		if(isset($_POST['tktpri'])){
			$model = Supportmain::model()->findByPk($_POST['supportmaincode']);
			$model->supportprioritycode = $_POST['tktpri'];
		/*	$model->status = $_POST['status'];*/
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			echo CJavaScript::jsonEncode(array('status'=>true,'tid'=>$model->supportmaincode));
		}
	}

	public function actionIndi_status(){
		if(isset($_POST['supportmaincode'])){
			$model = Supportmain::model()->findByPk($_POST['supportmaincode']);		
			$model->status = $_POST['status'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			$status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated'];
			$notification_msg_fo = 'Your ticket status has been '.$status_arr[$_POST['status']];
            Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'FO',$notification_msg_fo); 
			echo CJavaScript::jsonEncode(array('status'=>true,'tid'=>$model->supportmaincode));
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

    

      public function actionGetcatser($srn){
      	 $srn = Yii::app()->db->createCommand("SELECT * from bo_new_application_submission where submission_id=$srn")->queryRow();
      	 $service_id_array = explode(".",$srn['service_id']);
      	 $s_id = $service_id_array[0];
      	 $gsnacn = Yii::app()->db->createCommand("SELECT sm.id as ser_id,sm.sc_id as sercat_id,sm.service_name,sc.category_name 
      	 	from bo_information_wizard_service_master as sm
      	 	INNER JOIN bo_information_wizard_services_category as sc ON sm.sc_id=sc.id
      	 	 where sm.id=$s_id")->queryRow();
      	 if($gsnacn){
      	 	 echo CJavaScript::jsonEncode(array('status'=>true,
      	 	 	'category_id'=>$gsnacn['sercat_id'],
      	 	 	'category_name'=>$gsnacn['category_name'],
      	 	 	'service_name'=>$gsnacn['service_name'],
      	 	 	'service_id'=>$gsnacn['ser_id']));
      	 }else{
      	 	 echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Something went wrong'));
      	 }
      	 
      }

         public function actionGetsrn($s_id = NULL){      
         $ser_id = $s_id.'.0';
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


      public function actionAssignnextlevel(){
      	if(isset($_POST['uid'])){
      		$model = Supportmain::model()->findByPk($_POST['tid']);		
      		$model->currently_assign_to = $_POST['uid'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->status = 'ESC';
			$model->save();
			
			
			$dear_name = 'Applicant';
				if(isset($_SESSION['RESPONSE']['user_id'])){
					$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.user_id=$model->usercode")->queryRow();
				 $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			}

			if(isset($_SESSION['uid'])){
				$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user 
				where uid=$model->usercode")->queryRow();

	   			$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
			}

		$subject = "CAIPO-Ticket";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        
		$notification_msg_fo = 'Your Ticket has been Escalated to BO User';
		$content = "Dear ".$dear_name.",<br><br> Your Ticket with Ticket ID <b>".$model->supporttypecode."</b> has been escalated to the higher level. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
	   	Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'FO',$notification_msg_fo); 


       

				// Mail to BO user 
				
					$caudetail = Yii::app()->db->createCommand("SELECT *
					from bo_user u 			
					where uid=$model->currently_assign_to")->queryRow();
					$dearbo_name = $caudetail['full_name'].' '.$caudetail['middle_name'].' '.$caudetail['last_name'];

						if($model->srn_app_id=='Other'){
					$srn_detail = "";
				}else{
					$srn_detail = "for SRN <b>".$model->srn_app_id."</b>";
				}

				
				$esc_by = $_SESSION['uid'];
				$esc_bydetail = Yii::app()->db->createCommand("SELECT *
					from bo_user u 			
					where uid=$esc_by")->queryRow();
				$esc_by_name = $esc_bydetail['full_name'].' '.$esc_bydetail['middle_name'].' '.$esc_bydetail['last_name'];

		$subject = "CAIPO-Ticket";
        $to = $caudetail['email'];
        $name = $dearbo_name;
      	$notification_msg_bo = 'Ticket has been escalated by '.$esc_by_name.'. Please take the required action';
		$content = "Dear ".$dearbo_name.",<br><br> Ticket ID <b>".$model->supporttypecode."</b> ".$srn_detail." has been escalated by <b>".$esc_by_name."</b> . Please take the required action.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$_SESSION['uid'],'BO',$notification_msg_bo);  
		Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$_POST['uid'],'BO',$notification_msg_bo);  

				
 
			echo CJavaScript::jsonEncode(array('status'=>true,'tid'=>$model->supportmaincode));
      	}
      }

     
}