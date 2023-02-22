<?php

require_once(Yii::app()->basePath.'/modules/grievance/components/Alertsandnotification.php');
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
			
			$model = new Grievance;
			$model->category = DefaultUtility::dataSenetize($_POST['category']);
			$model->existing_id = DefaultUtility::dataSenetize($_POST['category_id']);
			$model->user_id = @$_SESSION['RESPONSE']['user_id'];
			$model->priority = 'Normal';
			$model->subject = DefaultUtility::dataSenetize($_POST['subject']);
			$model->status ='O' ;
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			$msgModel = new Grievancemsg;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->user_id = @$_SESSION['RESPONSE']['user_id'];
			$msgModel->user_type = "AU";
			$msgModel->grievance_id = $model->id;
			$msgModel->save();

			$filepaths = Yii::app()->db->createCommand("SELECT * FROM  grievancefiles_temp WHERE user_id = ".$model->user_id)->queryAll();
			foreach ($filepaths as $key => $value) {
				$file = new Grievancefiles;
				$file->msgfilepath = $value['file_path'];
				$file->gm_id = $msgModel->id;
				$file->save();
			}

			Yii::app()->db->createCommand("DELETE FROM grievancefiles_temp WHERE user_id = ".$model->user_id)->execute();

			$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
			from sso_users u 
			INNER JOIN sso_profiles p ON p.user_id=u.user_id
			where u.user_id=$model->user_id")->queryRow();
			$dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			

			
			$subject = "CAIPO-Grievance";
			$to = $Appuserdetail['email'];
			$name = $dear_name;
			$notification_msg_fo = 'Your Grievance has been submitted successfully';
			$content = "Dear ".$dear_name.",<br><br> Your Grievance has been successfully submitted in CAIPO Portal. You are allotted Grievance ID <b>".$model->id."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
	
	
			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
			DefaultUtility::post_to_url(EMAIL_API,$post_data); 
			Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 
	
			Yii::app()->user->setFlash('success', "Grievance Id : $model->id has been submitted successfully. ");
		 return $this->redirect('/backoffice/investor/services/grievance');
		}

		$srns = Yii::app()->db->createCommand("SELECT submission_id, service_id FROM bo_new_application_submission WHERE user_id = ".$_SESSION['RESPONSE']['user_id'])->queryAll();
		$service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();

		return $this->render('index',array('srns'=>$srns,'service_category'=>$service_category,'fileModel'=>$fileModel,'user_id'=>$_SESSION['RESPONSE']['user_id']));
	}

	public function actionBocreate(){
		$fileModel = new Uploadfile;		
		$user_id = @$_SESSION['uid'];

		if(isset($_POST['subject'])){			
			$model = new Grievance;
			// $model->servicecategory = DefaultUtility::dataSenetize($_POST['servicecategory']);
			// $next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(supportmaincode),0)+1 as max FROM supportmain')->queryScalar();
			// $model->supporttypecode = date('y').$next_id;
			$model->subject = DefaultUtility::dataSenetize($_POST['subject']);
			$model->category = DefaultUtility::dataSenetize($_POST['type']);
			$model->priority = 'Normal';
			$model->user_id = @$_SESSION['uid'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save(); 
			$msgModel = new Grievancemsg;
			$msgModel->message = DefaultUtility::dataSenetize($_POST['message']);
			$msgModel->usercode = @$_SESSION['uid'];
			$msgModel->user_type = "AU";
			$msgModel->grievance_id = $model->id;
			$msgModel->save();

			$filepaths = Yii::app()->db->createCommand("SELECT * FROM grievancefiles_temp WHERE user_id = ".$model->user_id)->queryAll();
			foreach ($filepaths as $key => $value) {
				$file = new Grievancefiles;
				$file->msgfilepath = $value['msgfilepath'];
				$file->gm_id = $msgModel->id;
				$file->save();
			}

		Yii::app()->db->createCommand("DELETE FROM grievancefiles_temp WHERE user_id = ".$model->user_id)->execute();
		

		$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user 
				where uid=$model->user_id")->queryRow();

	   	$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
		$subject = "CAIPO-Grievance";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Grievance has been successfully submitted';
        $content = "Dear ".$dear_name.",<br><br> Your Grievance has been successfully submitted in CAIPO Portal. You are allotted Grievance ID <b>".$model->id."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 
		 Yii::app()->user->setFlash('success', "Grievance Id : $model->id has been submitted successfully. ");
		 return $this->redirect('/backoffice/investor/services/grievance/otd/ct');
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
    	 	 $targetDir = Yii::app()->basePath .'/uploads/grievance';
			    if (!file_exists($targetDir)) {
			        @mkdir($targetDir);
			    }
			     $targetFile = $targetDir.'/'.$fileId; 
		     
		        if(move_uploaded_file($file, $targetFile)) {
		        	$file_path = '/backoffice/protected/uploads/grievance/'.$fileId;
		        	Yii::app()->db->createCommand('INSERT INTO grievancefiles_temp (user_id, file_path) VALUES ("'.$user_id.'", "'.$file_path.'")')->execute();
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

	public function actionGrievancedetail($sm_id){
		
		$grievance = Yii::app()->db->createCommand("SELECT sm.id,
		sm.existing_id,
		sm.priority,
		sm.subject,
		sm.status,
		sm.category,
		sm.created_on
		FROM grievance as sm
		WHERE sm.id=$sm_id")->queryRow();
			
		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM grievancemsg			
			WHERE grievance_id=$sm_id order by msgdatetime DESC")->queryAll();


		if(isset($_POST['message'])){
			$msgModel = new Grievancemsg;
			$msgModel->message = $_POST['message'];
			if(isset($_SESSION['RESPONSE']['user_id'])){
				$msgModel->user_id = $_SESSION['RESPONSE']['user_id'];
			}else{
				if(isset($_SESSION['uid'])){
					$msgModel->user_id = $_SESSION['uid'];
				}else{
					return $this->redirect('/backoffice/grievance/default/grievancedetail/sm_id/'.$sm_id);
				}
			}
			
			$msgModel->user_type = "AU";
			$msgModel->grievance_id = $sm_id;
			$msgModel->save();
			$model = Grievance::model()->findByPk($msgModel->grievance_id);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			return $this->redirect('/backoffice/grievance/default/grievancedetail/sm_id/'.$sm_id);
		}

		return $this->render('grievance_detail',array('grievance'=>$grievance,'messages'=>$messages,'sm_id'=>$sm_id));
	}

	public function actionSupportindex(){
		return $this->render('support_index');
	}

	public function actionHighsupportindex(){
		return $this->render('high_support_index');
	}

	public function actionSupportgrievancedetail($sm_id){
		$grievance = Yii::app()->db->createCommand("SELECT sm.id,
		sm.existing_id,
		sm.priority,
		sm.subject,
		sm.status,
		sm.category,
		sm.currently_assign_to,
		sm.created_on
		FROM grievance as sm 
		WHERE sm.id=$sm_id order by sm.id DESC")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM grievancemsg			
			WHERE grievance_id=$sm_id order by msgdatetime DESC")->queryAll();

		if(isset($_POST['message'])){
			$msgModel = new Grievancemsg;
			$msgModel->message = $_POST['message'];
			$msgModel->user_id = $_SESSION['uid'];
			$msgModel->user_type = "BU";
			$msgModel->grievance_id = $sm_id;
			$msgModel->save();
			$model = Grievance::model()->findByPk($msgModel->grievance_id);
			$model->updated_on = date('Y-m-d H:i:s');
			$model->status = $_POST['status'];
			
			if($model->status=='RS'){				
				$dear_name = 'Applicant';
				if(isset($_SESSION['RESPONSE']['user_id'])){
					$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.user_id=$model->user_id")->queryRow();
				 $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			}

			if(isset($_SESSION['uid'])){
				$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user 
				where uid=$model->user_id")->queryRow();

	   			$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
			}
				


				

		$subject = "CAIPO-Grievance";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
		$notification_msg_fo = 'Your Grievance has been resolved and closed';
		$content = "Dear ".$dear_name.",<br><br> Your Grievance with Grievance ID <b>".$model->id."</b> has been resolved and closed. <br><br>If you believe that the grievance should be re-opened, please log into your account on our site directly and manually re-open the grievance.<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
	   	Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 
		
			}
			$model->save();
			return $this->redirect('/backoffice/grievance/default/supportgrievancedetail/sm_id/'.$sm_id);
		}

		return $this->render('support_grievance_detail',array('grievance'=>$grievance,'messages'=>$messages,'sm_id'=>$sm_id));
	}

	public function actionStatuspriority(){
		if(isset($_POST['grvpri'])){
			$model = Grievance::model()->findByPk($_POST['id']);
			$model->priority = $_POST['grvpri'];
		/*	$model->status = $_POST['status'];*/
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			echo CJavaScript::jsonEncode(array('status'=>true,'gid'=>$model->id));
		}
	}

	public function actionIndi_status(){
		//print_r($_POST);die;
		if(isset($_POST['id'])){
			$model = Grievance::model()->findByPk($_POST['id']);	
			//print_r($model);die;	
			$model->status = $_POST['status'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			$status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','W'=>'Withdrown','ESC'=>'Escalated'];
			$notification_msg_fo = 'Your grievance status has been '.$status_arr[$_POST_POST['status']];
            Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 
			echo CJavaScript::jsonEncode(array('status'=>true,'gid'=>$model->id));
		}
	}

	

    

      public function actionGetexistingid($category){
      	$user_id = $_SESSION['RESPONSE']['user_id'];
		// print_r($user_id);die;
      	if($category=='Ticket'){
      		 $q = Yii::app()->db->createCommand("SELECT *
      	 	from supportmain      	 	
      	 	 where usercode=$user_id AND status='O' AND user_type='FO'")->queryAll();
			 // print_r($q);die;
      	 	  if($q){
				// echo $ticket =  "Ticket";
	         	echo "<option value='' selected >Please Select Ticket ID</option>";
	            foreach ($q as $key => $value) {
	             echo "<option value='".$value['supportmaincode']."'> Ticket ID: ".$value['supporttypecode']."</option>";
	            }
	         }else{
	            echo false;
	         }
      	}else{
      		if($category=='Query'){
      			 $q = Yii::app()->db->createCommand("SELECT *
	      	 	from querymain      	 	
	      	 	 where user_id=$user_id AND status='1'")->queryAll();
	      	 	  if($q){
					// echo $query = "Query";
		         	echo "<option value='' selected >Please Select Query ID</option>";
		            foreach ($q as $key => $value) {
		             echo "<option value='".$value['id']."'> Query ID: ".$value['querycode']."</option>";
		            }
		         }else{
		            echo false;
		         }
      		}else{
      			echo false;
      		}
      	}    	
      	 
      }

	public function actionGetexistingdata($category,$existing_cat_id){
		  $user_id = $_SESSION['RESPONSE']['user_id'];
		if($category=='Ticket'){
			 $q = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
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
			 WHERE sm.supportmaincode=$existing_cat_id")->queryRow();

			$messages = Yii::app()->db->createCommand("SELECT *
			FROM supportmessages			
			WHERE supportmaincode=$existing_cat_id order by msgdatetime DESC")->queryAll();
			if($q){
				$doc='';
				$status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed'];
				$files_arr = [];
					foreach($messages as $mk=>$mv){
					$filesdoc = Yii::app()->db->createCommand("SELECT * FROM supportmsgfiles WHERE supportmessagescode=".$mv['supportmessagescode'])->queryAll(); 
					foreach ($filesdoc as $key => $value) {
						$files_arr[] = $value;
					}
				}
				$did=1; $doc = '';
				foreach ($files_arr as $f => $d) { 
					$doc.=  "<a target='_blank' href='/backoffice/doc/mydoc?view=".DefaultUtility::getDockey($d['msgfilepath'])."&from=ticket' style='color:blue;'>Document ".($did).", </a>";
					$did++;
				}
				echo "<div class='row'><div class='col-lg-12'><table class='table table-striped table-bordered table-hover'><tr><td><b>Ticket ID:</b></td><td>".$q['supporttypecode']."</td><td><b>SRN:</b></td><td>".$q['srn_app_id']."</td></tr> <tr><td><b>Service Category:</b></td><td>".$q['category_name']."</td> <td><b>Service Name:</b></td><td>".$q['service_name']."</td> </tr>  <tr>  <td><b>Status:</b></td>    <td>".$status_arr[$q['status']]."</td>    <td><b>Created On:</b></td>    <td>".date("d, M Y h:i a",strtotime($q['created_on']))."</td>  </tr>  <tr>    <td><b>Documents:</b></td><td colspan='3'>".$doc."</td>    </tr><tr>    <td><b>Subject:</b></td><td colspan='3'>".$q['subject']."</td> </tr> </table></div></div>";
			}
		
		}else{
			if($category=='Query'){
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
				WHERE q.id=$existing_cat_id")->queryRow();
	
				$messages = Yii::app()->db->createCommand("SELECT *
				 FROM querymessage			
				WHERE querymain_id=$existing_cat_id order by msgdatetime DESC")->queryAll();
				if($qmain){
					
					$status='';
					if($qmain['status']==1){
						$status = "<span class='label label-success'>Open</span>";
					}
					else{
						$status = "<span class='label label-danger'>Closed</span>";
					}
					
					echo "<div class='row'><div class='col-lg-12'><table class='table table-striped table-bordered table-hover'><tr><td><b>Query ID:</b></td><td>".$qmain['querycode']."</td><td><b>Mobile:</b></td><td>".$qmain['mobile_no']."</td></tr> <tr><td><b>Email:</b></td><td>".$qmain['email']."</td> <td><b>Query Type:</b></td><td>".$qmain['query_type']."</td> </tr>  <tr>  <td><b>Service Category:</b></td>    <td>".$qmain['category_name']."</td>    <td><b>Service Name:</b></td>    <td>".$qmain['service_name']."</td>  </tr>  <tr>    <td><b>Status:</b></td><td>".$status."</td><td><b>Created On:</b></td><td>".date("d, M Y h:i a",strtotime($qmain['created_on']))."</td>    </tr><tr>    <td><b>Priority:</b></td><td colspan='3'>".$qmain['querypriority']."</td> </tr> </table></div></div>
					<strong  style='color: #333;'>Subject: </strong> 
					<div class='row'><br>
						<div class='col-md-12'>".$qmain['subject']."</div>
					</div>
					<hr style='color: #36c6d3;' />
					";
				}
			}
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
		  //echo $_POST['uid'];die;
      	if(isset($_POST['uid'])){
      		$model = Grievance::model()->findByPk($_POST['gid']);		
      		$model->status = 'ESC';
			$model->currently_assign_to = $_POST['uid'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			
			$dear_name = 'Applicant';
				if(isset($_SESSION['RESPONSE']['user_id'])){
					$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.user_id=$model->user_id")->queryRow();
				 $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
			}

			if(isset($_SESSION['uid'])){
				$Appuserdetail = Yii::app()->db->createCommand("SELECT * 
				from bo_user
				where uid=$model->user_id")->queryRow();

	   			$dear_name = $Appuserdetail['full_name'].' '.$Appuserdetail['middle_name'].' '.$Appuserdetail['last_name'];			
			}

		$subject = "CAIPO-Grievance";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Grievance has been Escalated to BO User';
		$content = "Dear ".$dear_name.",<br><br> Your Grievance with Grievance ID <b>".$model->id."</b> has been escalated to the higher level. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
	   	Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 



       

				// Mail to BO user 
				
					$caudetail = Yii::app()->db->createCommand("SELECT *
					from bo_user u 			
					where uid=$model->currently_assign_to")->queryRow();
					$dearbo_name = $caudetail['full_name'].' '.$caudetail['middle_name'].' '.$caudetail['last_name'];

						

				
				$esc_by = $_SESSION['uid'];
				$esc_bydetail = Yii::app()->db->createCommand("SELECT *
					from bo_user u 			
					where uid=$esc_by")->queryRow();
				$esc_by_name = $esc_bydetail['full_name'].' '.$esc_bydetail['middle_name'].' '.$esc_bydetail['last_name'];

		$subject = "CAIPO-Grievance";
        $to = $caudetail['email'];
        $name = $dearbo_name;
		$notification_msg_bo = 'Grievance has been escalated by '.$esc_by_name.' . Please take the required action';
		$content = "Dear ".$dearbo_name.",<br><br> Grievance ID <b>".$model->id."</b> has been escalated by <b>".$esc_by_name."</b> . Please take the required action.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
		Alertsandnotification::sendnotification('Grievance', $model->id,$model->id,$_SESSION['uid'],'BO',$notification_msg_bo);  
		Alertsandnotification::sendnotification('Grievance', $model->id,$model->id	,$_POST['uid'],'BO',$notification_msg_bo);  

				
 
			echo CJavaScript::jsonEncode(array('status'=>true,'gid'=>$model->id));
      	}
      }

     
}