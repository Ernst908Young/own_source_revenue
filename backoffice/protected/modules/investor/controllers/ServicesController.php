<?php
class ServicesController extends Controller
{
	public function actionDashboard($sc_id, $type=NULL)
	{
		@session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);
        $user_id = $_SESSION['RESPONSE']['user_id'];
        // Get department list from IW       
        // Get all services list       
        $id = isset($_GET['id']) ? DefaultUtility::dataSenetize($_GET['id']) : 1;	
        $sc_id = DefaultUtility::dataSenetize(base64_decode($sc_id));
       $sql = "SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
		LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
		WHERE sm.sc_id=$sc_id AND sm.issuerby_id='$id'  AND sp.is_active='Y' group by istm.sub_service_id";
		$res_s = Yii::app()->db->createCommand($sql)->queryAll();

		

        $sn_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master where sc_id=$sc_id")->queryAll();
		$sc = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where id=$sc_id")->queryRow();

			
        $this->render("dashboard", array('res_s' => $res_s, 'id' => $id, 'user_id' => $user_id, 'type' => $type,'sn_arr'=>$sn_arr,'sc'=>$sc));		
		
	}

	public function actionGrievance(){
		//$this->layout = '//layouts/final_dashboard';
		$uid = @$_SESSION['RESPONSE']['user_id'];
		if($uid){
				$grievance_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_t,
			    COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
			    COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
			    COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
			    COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
			    COUNT(CASE WHEN `status` = 'W' THEN 1 END) AS withdrawn_t,
				COUNT(CASE WHEN `status` = 'ESC' THEN 1 END) AS esc_t  
				FROM grievance WHERE user_id=$uid")->queryRow();
		
		
		
		$grievance_records = Yii::app()->db->createCommand("SELECT sm.id,
		sm.existing_id,	sm.priority,sm.subject, sm.status,sm.category,sm.created_on	FROM grievance as sm WHERE sm.user_id=$uid order by sm.id DESC")->queryAll();

		
		$this->render('grievance_dashboard',['grievance_count'=>$grievance_count,'grievance_records'=>$grievance_records]);
		}else{
			throw new Exception("Applicant user not found", 1);
			
		}
		
	}


	public function actionTicketquery(){
		//$this->layout = '//layouts/final_dashboard';
		$uid = @$_SESSION['RESPONSE']['user_id'];
		if($uid){
			$tickets_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_t,
			    COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
			    COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
			    COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
			    COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
			    COUNT(CASE WHEN `status` = 'C' THEN 1 END) AS close_t,
				COUNT(CASE WHEN `status` = 'ESC' THEN 1 END) AS esc_t 
				FROM supportmain WHERE usercode=$uid AND user_type='FO'")->queryRow();
		
		$query_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_q,
			    COUNT(CASE WHEN `status` = 1 THEN 1 END) AS open_q,
			    COUNT(CASE WHEN `status` = 0 THEN 1 END) AS close_q			  
				FROM querymain WHERE user_id=$uid")->queryRow();
		
		$tickets_records = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
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
			WHERE sm.usercode=$uid AND sm.user_type='FO' order by sm.supportmaincode DESC")->queryAll();

		$query_records = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
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
			WHERE q.user_id=$uid order by q.id DESC")->queryAll();
		$this->render('ticket_query',['tickets_count'=>$tickets_count,'query_count'=>$query_count,'tickets_records'=>$tickets_records,'query_records'=>$query_records]);
		}else{
			throw new Exception("Application user not found", 1);
			
		}
		
		
		
	}

	public function actionBoticket(){
		//$this->layout = '//layouts/final_dashboard';
		$uid = @$_SESSION['uid'];
		$tickets_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_t,
			    COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
			    COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
			    COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
			    COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
			    COUNT(CASE WHEN `status` = 'C' THEN 1 END) AS close_t, 
				COUNT(CASE WHEN `status` = 'ESC' THEN 1 END) AS esc_t  
				FROM supportmain WHERE usercode=$uid AND user_type='BO'")->queryRow();
		
		
		
		$tickets_records = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
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
			WHERE sm.usercode=$uid AND sm.user_type='BO' order by sm.supportmaincode DESC")->queryAll();

		
		
		$this->render('boticket',['tickets_count'=>$tickets_count,'tickets_records'=>$tickets_records]);
	}

	/*public function actionQuery(){
		$this->layout = '//layouts/final_dashboard';
		$uid = @$_SESSION['RESPONSE']['user_id'];
		
		
		$query_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_q,
			    COUNT(CASE WHEN `status` = 1 THEN 1 END) AS open_q,
			    COUNT(CASE WHEN `status` = 0 THEN 1 END) AS close_q			  
				FROM querymain WHERE user_id=$uid")->queryRow();
		
		

		$query_records = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
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
			WHERE q.user_id=$uid order by q.id DESC")->queryAll();
		
		$this->render('query',['query_count'=>$query_count,'query_records'=>$query_records]);
	}*/

	public function actionReports(){

		//echo"<pre>";print_r($_POST['msg']);die;	
       
	
	}
	public function dataSenetize ($param) {

                             return addslashes(htmlentities(trim($param)));

      }

  public function actionDummypayment($srn_no){
  	$srn_no = base64_decode($srn_no);

  	$sql="SELECT * FROM bo_new_application_submission WHERE submission_id =:srn_no";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":srn_no",  $srn_no, PDO::PARAM_STR);
		$service_srn=$command->queryRow();

		$uid = $service_srn['user_id'];
		$sid = $service_srn['service_id'];


$sql = "SELECT * FROM bo_service_booking_schedule WHERE  submission_id =".$service_srn['submission_id'];
$get_booking_details = Yii::app()->db->createCommand($sql)->queryRow();
if($get_booking_details['total_amount']>0){
$total_fees = $get_booking_details['total_amount'];
}else{
  $total_fees = 0;
}

			Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,process_id,submission_id, service_total_fee, total_amount,payment_mode, payment_gateway_method,payment_submit_by,payment_status,reference_name,reference_number,reference_email) VALUES ('$sid','$srn_no','$srn_no',$total_fees,$total_fees,1,1,'$uid','success','applicant user','6767676767','demo.judi@gmail.com')")->execute();  

			 $currentDate = date('Y-m-d H:i:s');

                 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $srn_no  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
$processId = $srn_no;
		         
		 $serviceDetail = Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='A',application_updated_date_time='$currentDate' WHERE submission_id=$processId")->execute();

			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($sid);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$service_srn['dept_id'])->queryRow(); 
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$processId")->queryRow();
            
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($processId);
			$sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
            
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='A',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($processId,$sno,$service_id,$process_level);

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $processId;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $processId;
            $modelSPH->application_status = "A";
            $modelSPH->comments = 'Application Submitted and Payment Paid Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $processId;
            $modellog->application_id = $processId;
            $modellog->user_id = $uid;
            $modellog->dept_id = $service_srn['dept_id'];
            $modellog->application_status = "A";
            $modellog->form_id = 1;
            $modellog->service_id = $sid;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $sid;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $service_srn['dept_id'];
            $model_app_log->app_Sub_id = $processId;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "A";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted and Payment Paid Successfully';
            $model_app_log->investor_id = $uid;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql);

		   	   Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted with payment paid successfully');

		    Sendmailforservice::senttofobo_pendingforapproval($model);
		    $tno=rand(10000000000000000000,99999999999999999999) ;
		    $fee =10;
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);         






			$this->redirect('/panchayatiraj/backoffice/investor/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL');
         

  }    

	public function actionPayment($srn_no)
	{      
		$srn_no = base64_decode($srn_no);
        $srn_no=$this->dataSenetize($srn_no);
		// echo $srn_no;die;
		$sql="SELECT * FROM bo_new_application_submission WHERE submission_id =:srn_no";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":srn_no",  $srn_no, PDO::PARAM_STR);
		$service_srn=$command->queryRow();
		$latefee = 0;
		//$service_srn =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = $srn_no")->queryRow();
		$uid = $service_srn['user_id'];
		$sid = $service_srn['service_id'];
		//$user =  Yii::app()->db->createCommand("SELECT * FROM sso_users WHERE user_id = $uid")->queryRow();
		$sql="SELECT * FROM sso_users WHERE user_id = :uid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":uid",  $uid, PDO::PARAM_STR);
		$user=$command->queryRow();
		
		//$user_profile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id = $uid")->queryRow();
		$sql="SELECT * FROM sso_profiles WHERE user_id = :uid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":uid",  $uid, PDO::PARAM_STR);
		$user_profile=$command->queryRow();
		$recipet_no = time();
		$name = $user_profile['first_name']; $number = $user['mobile_no']; $email = $user['email']; 

	
		$sql="SELECT * FROM bo_information_wizard_service_master as sm  
		INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
		LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
		WHERE sm.id=:sid  AND istm.to_be_used_in_online_offline='Y' AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
		$service=$command->queryRow();
		
		$sercename = $service['service_name'];
		$farr = (array) json_decode($service_srn['field_value']);
		// echo"<pre>";print_r($farr);die;
		$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND page_form_id = 1 AND service_id=:sid "  ;
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
					$service_fee=$command->queryRow();
					$servicefee  = $service_fee['fee_amount'];
		

		
		//Yii::app()->db->createCommand("SELECT sum(fee_amount) as total_fees from tbl_service_fee where service_id=15.0 AND is_fee_payable=1")->queryRow();

        // if offilne button pay click 
        if(isset($_POST['srnno'])){         
			Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,process_id,submission_id, service_total_fee, total_amount,payment_mode, payment_gateway_method,payment_submit_by,payment_status,reference_name,reference_number,reference_email,chalan_no,fees_item,late_fee) VALUES ('$sid','$srn_no','$srn_no','$servicefee','$servicefee',3,1,'$uid','pending','$name','$number','$email','$recipet_no','$sercename','$latefee')")->execute();   
                 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $srn_no  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 

		         if(isset($_SESSION['RESPONSE']['agent_user_id'])){
		         	Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$_SESSION['RESPONSE']['agent_user_id'],'FO','Your Application was submitted but payment due');
		         }

		          if(isset($_SESSION['RESPONSE']['subuser_user_id'])){
		          	Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$_SESSION['RESPONSE']['subuser_user_id'],'FO','Your Application was submitted but payment due');
		         }


		        Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted but payment due');

		        $cashier_ids = Yii::app()->db->createCommand("SELECT * FROM `bo_user_role_mapping` WHERE `role_id` = '95' AND `is_mapping_active` = 'Y'")->queryAll();
		        if($cashier_ids){
		        	foreach ($cashier_ids as $key => $value) {
		        		Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$value['user_id'],'BO','Application was submitted but payment due'); 
		        	}
		        }

		        
               Sendmailforservice::payment_pending($model,$recipet_no,$servicefee,$srn_no); 
			$this->redirect('/panchayatiraj/backoffice/investor/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL');
         }



	$this->render('payment',['user'=>$user,'service'=>$service,'service_srn'=>$service_srn,'servicefee'=> $servicefee,'service_fee'=>$service_fee,'user_profile'=>$user_profile,'latefee'=> $latefee,'sercename'=>$sercename]);
	}

	public function actionSavePayment(){
		$msg = $_POST['msg']; 
		$name = $_POST['reference_name']; 
		$number = $_POST['reference_number']; 
		$email = $_POST['reference_email']; 
		$processId = $_POST['process_id'];
		$tno = $_POST['transaction_number']; 
		$account = $_POST['ezpay_account']; 
		$fee = $_POST['total']; 
		$pstatus = $_POST['payment_status']; 
		$comment = $_POST['items'];
		$latefee = 0 ; //$_POST['latefee'];
		$service_srn =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = $processId")->queryRow();
		$uid = $service_srn['user_id'];
		$sid = $service_srn['service_id'];
		$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='late fee' AND service_id=:sid";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
			$late_fee=$command->queryRow();
	            if(!empty($late_fee)){
		            	$latefee = $late_fee['fee_amount'];	
		            }

		Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,late_fee)VALUES ('$sid','$processId','$fee','$fee',1,'$pstatus','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid','$latefee')")->execute();  

		if($pstatus=='success')
		{
			$currentDate = date('Y-m-d H:i:s');
			
			$serviceDetail = Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$currentDate' WHERE submission_id=$processId")->execute();

			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($sid);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$service_srn['dept_id'])->queryRow(); 
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$processId")->queryRow();
            
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($processId);
			$sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
            
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($processId,$sno,$service_id,$process_level);

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $processId;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $processId;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted and Payment Paid Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $processId;
            $modellog->application_id = $processId;
            $modellog->user_id = $uid;
            $modellog->dept_id = $service_srn['dept_id'];
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $sid;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $sid;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $service_srn['dept_id'];
            $model_app_log->app_Sub_id = $processId;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted and Payment Paid Successfully';
            $model_app_log->investor_id = $uid;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql);

		   	   Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted with payment paid successfully and forwarded to CAIPO-department');

		    Sendmailforservice::senttofobo_pendingforapproval($model); 
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);   

            Yii::app()->user->setFlash('success','Payment successfully completed');
            echo $pstatus;
			//$this->redirect('');
		}else{
			if($pstatus=='failed'){

				 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
		          Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted but payment failed');
				Sendmailforservice::payment_failed($model,$tno,$fee,$processId);  
				Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
			}else{
				Yii::app()->user->setFlash('initiated','Payment has initiated');
			}
			echo $pstatus;
		}

	}	
	

	public function ForwardToDepartment($submission_id = null, $sno = null, $service_id = null,$processLevel) 
	{
		$msg="";
        $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$service_id AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();

        $serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($submission_id);
		$applicationExt = New ApplicationExt;
		$serviceArr = $applicationExt->getServiceNameById($service_id);
        $service_Name = $serviceArr['core_service_name'];
        if(isset($serviceData) && !empty($serviceData)) 
		{
            // Forward to department Entry Part
            $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
            $ForwardLevelmodel->next_role_id = @$allData['next_role_id'];
            $ForwardLevelmodel->verifier_user_id = '0';
            $ForwardLevelmodel->app_Sub_id = $submission_id;
            $ForwardLevelmodel->forwarded_dept_id = $serviceData['dept_id'];
            $ForwardLevelmodel->post_info = "";
            $ForwardLevelmodel->verifier_user_comment = '';
            $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
            //$ForwardLevelmodel->updated_date_time = "";
            $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
            //$ForwardLevelmodel->comment_date = "";
            $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
            $ForwardLevelmodel->approv_status = 'P';
            $ForwardLevelmodel->save();
            if($ForwardLevelmodel->save()) {
                $msg = $msg . "Saved In History Table";
				
            } else {
                die(var_dump($ForwardLevelmodel->getErrors()));
            }              
        }
    }
   

  	/*
  	* this action is used in service provider onboarding process Nefore but now it's copy paste in serviceproviderController.php but Aamir not delete it because if it is also use in any module
  	*/
	public function actionValidatemail(){
		if(isset($_POST['email'])){
			$cm = Yii::app()->db->createCommand("SELECT * FROM sso_users where email='".$_POST['email']."'")->queryRow();
			if($cm){
				echo CJavaScript::jsonEncode(array('status'=>false));
			}else{
				echo CJavaScript::jsonEncode(array('status'=>true));
			}
			
		}
	}



public function actionSignatory($srn_no,$dept_id){

	$srn_no=$this->dataSenetize($srn_no);



	  $model = new BoSignatureMetadata;

	  $sql="SELECT * FROM bo_new_application_submission WHERE submission_id =:srn_no";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":srn_no",  $srn_no, PDO::PARAM_STR);
		$service_srn=$command->queryRow();

		$uid = $service_srn['user_id'];
		$sid = $service_srn['service_id'];
		$farr = (array) json_decode($service_srn['field_value']);
		
		$sql="SELECT * FROM sso_users WHERE user_id = :uid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":uid",  $uid, PDO::PARAM_STR);
		$user=$command->queryRow();
		
	
		$sql="SELECT * FROM sso_profiles WHERE user_id = :uid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":uid",  $uid, PDO::PARAM_STR);
		$user_profile=$command->queryRow();
		$recipet_no = time();
		$name = $user_profile['first_name']; $number = $user['mobile_no']; $email = $user['email']; 

	
		$sql="SELECT * FROM bo_information_wizard_service_master as sm  
		INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
		LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
		WHERE sm.id=:sid  AND istm.to_be_used_in_online_offline='Y' AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
		$service=$command->queryRow();
		$sercename = $service['service_name'];

		$this->render('signatory',['user'=>$user,'service'=>$service,'service_srn'=>$service_srn,'user_profile'=>$user_profile,'model'=>$model,'srn_no'=>$srn_no,'sid' => $sid,'dept_id'=>$dept_id]);
}

function getApplicationSubmissionDetail($srn_no) {
	$subData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$srn_no")->queryRow();
	  if(empty($subData))
	  	return false;

	  $fieldVal=json_decode($subData['field_value'],true);
	  // echo "<pre>";print_r($subData);die;
  	$regNo='';
  	$serviceId=$subData['service_id'];
  	//NPC
  	if(in_array($serviceId, ['29.0']))
  		$regNo=$fieldVal['UK-FCL-00631_0'];
  	//IC
  	
  	if(in_array($serviceId, ['30.0','26.0','32.0','41.0','39.0','44.0','20.0','25.0','28.0','27.0']))
  		$regNo=$fieldVal['UK-FCL-00403_0'];

  	//S
  	if(in_array($serviceId, ['40.0','42.0','19.0','45.0']))
  		$regNo=$fieldVal['UK-FCL-00290_0'];
  	//BUS
    if(in_array($serviceId, ['43.0']))
  		$regNo=$fieldVal['UK-FCL-00415_0'];
  	/*print_r($signatoryData);
  	die();*/
  	
  	//latest data table
  	$service_id =$subData['service_id'];
  	// echo "SELECT changed_from_srn_no,service_id,field_value FROM entity_application_latest_data sub
			// 										where service_id   = '".$this->serviceArrayMap($subData['service_id'],$regNo)."' and entity_no= '".$regNo."' and is_active=1 order by id desc limit 1";die;

  	 $signatoryData = json_decode(@Yii::app()->db->createCommand("SELECT changed_from_srn_no,service_id,field_value FROM entity_application_latest_data sub
													where service_id   = '".$this->serviceArrayMap($subData['service_id'],$regNo)."' and entity_no= '".$regNo."' and is_active=1 order by id desc limit 1")->queryRow()['field_value'],true);
  	 //old data table
  	 if(!$signatoryData)
  	 {
     $signatoryData = json_decode(@Yii::app()->db->createCommand("SELECT submission_id,service_id,field_value FROM bo_new_application_submission sub
						where submission_id = (SELECT srn_no FROM bo_company_details WHERE reg_no='".$regNo."' and service_id= '".$this->serviceArrayMap($subData['service_id'],$regNo)."'and is_active=1 order by id desc limit 1)")->queryRow()['field_value'],true);

    
    	 }
    $response['signatoryData'] = $signatoryData;
    $response['serviceId']     = $serviceId;

    return $response;
}
function serviceArrayMap($serviceId,$regNo=null){
	$serviceIdMapArray=["39.0"=>"4.0","19.0"=>"9.0","30.0"=>"8.0","26.0"=>"4.0","32.0"=>"4.0","44.0"=>"8.0","42.0"=>"9.0","40.0"=>"9.0","45.0"=>"9.0","43.0"=>"2.0,","28.0"=>"4.0","27.0"=>"4.0"];
	 if($serviceId=="29.0" || $serviceId=="20.0" || $serviceId=="41.0" || $serviceId=="25.0"  ){
	 		$companyRecord=Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no='".$regNo."' and service_id in ('4.0','5.0','9.0') and is_active=1 order by id desc limit 1")->queryRow();
	 		//echo "<pre>";print_r($companyRecord);die;
	 		if($companyRecord && $serviceId=="29.0"){
	 			 if($companyRecord['company_type']=='IC')
	 			 	$serviceIdMapArray['29.0']="4.0";
	 			 if($companyRecord['company_type']=='S')
	 			 	$serviceIdMapArray['29.0']="9.0";
	 			 if($companyRecord['company_type']=='NPC')
	 			 	$serviceIdMapArray['29.0']="5.0";

	 		}
	 		if($companyRecord && $serviceId=="20.0"){
	 			 if($companyRecord['company_type']=='IC')
	 			 	$serviceIdMapArray['20.0']="4.0";	 			 
	 			 if($companyRecord['company_type']=='NPC')
	 			 	$serviceIdMapArray['20.0']="5.0";

	 		}
	 		if($companyRecord && $serviceId=="41.0"){
	 			 if($companyRecord['company_type']=='IC')
	 			 	$serviceIdMapArray['41.0']="4.0";	 			 
	 			 if($companyRecord['company_type']=='NPC')
	 			 	$serviceIdMapArray['41.0']="5.0";

	 		}
			if($companyRecord && $serviceId=="25.0"){
	 			 if($companyRecord['company_type']=='IC')
	 			 	$serviceIdMapArray['25.0']="4.0";	 			 
	 			 if($companyRecord['company_type']=='NPC')
	 			 	$serviceIdMapArray['25.0']="5.0";

	 		}
			
	 }


	return @$serviceIdMapArray[$serviceId];
}

function checkSignatoryDetails($srn_no,$name=''){
	  $name=strtolower($name);
	  $signatoryApplicationData = $this->getApplicationSubmissionDetail($srn_no);
	  $signatoryData            = $signatoryApplicationData['signatoryData'];
	  if(empty($signatoryData))
	  	return false;
	  if(in_array($signatoryApplicationData['serviceId'], ['26.0','29.0','30.0','32.0','39.0','40.0','41.0','42.0','43.0','44.0','19.0','20.0','25.0','45.0','28.0','27.0'])){
	  	$existingNameArr=[];

			  	//incorporation of company
			  if($signatoryData['service_id']=='4.0'){	
			  	if(is_array(@$signatoryData['UK-FCL-00132_0'])){
			  		  //die('here');
			  			foreach ($signatoryData['UK-FCL-00132_0'] as $key => $signN) {
			  				$existingNameArr[]=strtolower(trim(@$signatoryData['UK-FCL-00132_0'][$key]) . ' ' . trim(@$signatoryData['UK-FCL-00133_0'][$key]) .' '. trim(@$signatoryData['UK-FCL-00134_0'][$key]));
			  			}
			  			// echo "<pre>";print_r($existingNameArr);echo $name;die;
			  			if(in_array($name, $existingNameArr))
			  				return true;
			  	}
			  }
			  if($signatoryData['service_id']=='8.0'){	
			  	if(is_array(@$signatoryData['UK-FCL-00132_0'])){
			  		  //die('here');
			  			foreach ($signatoryData['UK-FCL-00132_0'] as $key => $signN) {
			  				$existingNameArr[]=strtolower(trim(@$signatoryData['UK-FCL-00132_0'][$key]) . ' ' . trim(@$signatoryData['UK-FCL-00133_0'][$key]) .' '. trim(@$signatoryData['UK-FCL-00134_0'][$key]));
			  			}
			  			// echo "<pre>";print_r($existingNameArr);echo $name;die;
			  			if(in_array($name, $existingNameArr))
			  				return true;
			  	}
			  }
			  	//society
			  if($signatoryData['service_id']=='9.0'){	
			  	if(is_array(@$signatoryData['UK-FCL-00397_0'])){
			  		 //die('here123s');
			  			foreach ($signatoryData['UK-FCL-00397_0'] as $key => $signN) {
			  				 $existingNameArr[]= strtolower(trim($signatoryData['UK-FCL-00397_0'][$key])  . ' ' . trim($signatoryData['UK-FCL-00466_0'][$key]) .' '. trim($signatoryData['UK-FCL-00398_0'][$key]));
			  			}
			  			// echo "<pre>";print_r($existingNameArr);echo $name;die;
			  			if(in_array($name, $existingNameArr))
			  				return true;
			  	}
			  }
			  	//Non profic company
			  if($signatoryData['service_id']=='5.0'){	
			  	if(is_array(@$signatoryData['UK-FCL-00150_0'])){
			  		 //die('here123s');
			  			foreach ($signatoryData['UK-FCL-00150_0'] as $key => $signN) {
			  				 $existingNameArr[]=strtolower(trim($signatoryData['UK-FCL-00150_0'][$key]) . ' ' . trim($signatoryData['UK-FCL-00133_0'][$key]) .' '. trim($signatoryData['UK-FCL-00134_0'][$key]));
			  			}
			  			// echo "<pre>";print_r($existingNameArr);echo $name;die;
			  			if(in_array($name, $existingNameArr))
			  				return true;
			  	}
			  }	
			  	//BUS
			  if($signatoryData['service_id']=='2.0'){
			  		if(isset($signatoryData['UK-FCL-00044_0']))
			  			if($signatoryData['UK-FCL-00044_0']=='3'){
			  				if(is_array(@$signatoryData['UK-FCL-00064_0'])){	  		
					  			foreach ($signatoryData['UK-FCL-00064_0'] as $key => $signN) {
					  				$existingNameArr[]=strtolower(trim($signatoryData['UK-FCL-00064_0'][$key]) . ' ' . trim($signatoryData['UK-FCL-00065_0'][$key]) .' '. trim($signatoryData['UK-FCL-00067_0'][$key]));
					  			}	  		
					  			if(in_array($name, $existingNameArr))
					  				return true;
			  	  			}
			  			}
			  }
		}
	  return false;	 
}

public function actionSaveSignature($srn_no){
	
	if(isset($_POST['fn'],$_POST['srn_no'],$_POST['mactchSign'])){

		if($_POST['mactchSign']=='Y'){
			
			if(!$this->checkSignatoryDetails($_POST['srn_no'], trim($_POST['fn']) . ' '. trim($_POST['mn']) .' '. trim($_POST['ln']))){
				 CJavaScript::jsonEncode(array('status' => false, 'msg' => "The signatory details entered are not matching with the details on Directors/Secretary on file as per CAIPO's record. Please correct the same.",'response'=>"The signatory details entered are not matching with the details on Directors/Secretary on file as per CAIPO's record. Please correct the same."));
				exit; 
			}
		}

		
		$sql = "INSERT INTO bo_signature_metadata (submission_id, first_name, middle_name, last_name, designation, date_of_signing) VALUES (:sid, :fn, :mn, :ln, :de, :dateofs)";
		$datat = date('Y-m-d H:i:s');
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":sid",  $_POST['srn_no'], PDO::PARAM_STR);
		$command->bindParam(":fn",  $_POST['fn'], PDO::PARAM_STR);
		$command->bindParam(":mn",   $_POST['mn'], PDO::PARAM_STR);
		$command->bindParam(":ln", $_POST['ln'], PDO::PARAM_STR);
		$command->bindParam(":de",  $_POST['de'], PDO::PARAM_STR);
		$command->bindParam(":dateofs", $datat, PDO::PARAM_STR);
		$service=$command->execute();
		$noofsig = $_POST['noofsig'];
		  Yii::app()->db->createCommand("update bo_new_application_submission set no_of_signatory='$noofsig' where submission_id=".$_POST['srn_no'])->execute();

		echo CJavaScript::jsonEncode(array('status' => true));
	}else{
		echo CJavaScript::jsonEncode(array('status' => false, 'msg' => 'Some fields are required','response'=>"Something went wrong"));
	}
}

public function actionDeleteSignature(){
	if(isset($_POST['id'])){
		$id = $_POST['id'];

		$sql = "UPDATE bo_signature_metadata SET is_active=0 WHERE id=:id";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":id",  $id, PDO::PARAM_STR);
		$command->execute();
		echo CJavaScript::jsonEncode(array('status' => true));
	}else{
		echo CJavaScript::jsonEncode(array('status' => false, 'msg' => 'Some fields are required'));
	}
	

}

public function actionSaveAllDocuments() {

        extract($_GET);
        $user_id = $_SESSION['RESPONSE']['user_id'];
         $app_id = $sno;
         $currentDate = date('Y-m-d H:i:s');

         $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_id  . "'";
		      $model = NewApplicationSubmission::model()->findBySql($sql);

		      if($model){

		      	 //Save Declartion record
						        $checkalreadycheck = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_metadata WHERE service_id=$service_id AND application_id=$app_id")->queryRow();
						        if ($checkalreadycheck) {
						            
						        } else {
						            $dec_metadata = new Declarationmetadata;
						            $dec_metadata->service_id = $service_id;
						            $dec_metadata->application_id = $app_id;
						            $dec_metadata->save();
						        }	

		      	
        	
        	 
		      	
            $already_paid = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$app_id)->queryRow();
            	if(!empty($already_paid)){ 
            		 $stat = 'P'; //PAID
            		$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($service_id);
		            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$model->dept_id)->queryRow(); 
		            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$app_id")->queryRow();
		            
					$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($app_id);
					$sno = $serviceData['sno'];
		            $service_id = $serviceData['service_id'];
		            $process_level = $serviceData['processing_level'];

		             $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
		     $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		      $this->ForwardToDepartment($app_id, $app_id, $service_id,'District');

		       $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $app_id;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $app_id;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $app_id;
            $modellog->application_id = $app_id;
            $modellog->user_id = $model->user_id;
            $modellog->dept_id = $model->dept_id;
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $model->service_id;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $model->service_id;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $model->dept_id;
            $model_app_log->app_Sub_id = $app_id;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted Successfully';
            $model_app_log->investor_id = $model->user_id;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted successfully and forwarded to CAIPO-department');
		       
           Sendmailforservice::senttofobo_pendingforapproval($model);  
           echo CJavaScript::jsonEncode(array('status'=>true,'is_payment_done'=>true));

            	}else{
            				$stat = 'PD';   // signature pending


						        $currentDate = date('Y-m-d H:i:s');
						        $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
						        $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();



						       

						         //Save Data IN bo_sp_application_history for log
					            $serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($service_id);
					            $issuer_id = DefaultUtility::dataSenetize($dept_id);
					            $issuer_id = DefaultUtility::dataSenetize($app_id);
					            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=$dept_id")->queryRow();
					            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$app_id")->queryRow();

					            $modelSPH = new SpApplicationHistory;
					            $modelSPH->sp_app_id = $app_id;
					            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
					            $modelSPH->sp_tag = $sptagData['service_provider_tag'];
					            $modelSPH->app_id = $app_id;
					            $modelSPH->application_status = "$stat";
					            $modelSPH->comments = 'Application move towards the signatory details';
					            $modelSPH->added_date_time = date('Y-m-d H:i:s');
					            $modelSPH->save();

					            //Investor log Save
					            $modellog = new NewApplicationSubmissionLog();
					            $modellog->field_value = "N.A";
					            $modellog->submission_id = $app_id;
					            $modellog->application_id = $app_id;
					            $modellog->user_id = $user_id;
					            $modellog->dept_id = $dept_id;
					            $modellog->application_status = "$stat";
					            $modellog->form_id = 1;
					            $modellog->service_id = $service_id;
					            $modellog->application_created_date = date('Y-m-d H:i:s');
					            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
					            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
					            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
					            $modellog->unit_name = '';
					            $modellog->landrigion_id = $allData['landrigion_id'];
					            if ($modellog->save()) {
					                $investor_log_id = Yii::app()->db->getLastInsertID();
					                $model_app_log = new FormBuilderApplicationLog;
					                $model_app_log->service_id = $service_id;
					                $model_app_log->form_id = 1;
					                $model_app_log->core_department_id = $dept_id;
					                $model_app_log->app_Sub_id = $app_id;
					                $model_app_log->department_user_id = '0';
					                $model_app_log->action_status = "$stat";
					                $model_app_log->action_taken_by_name = 'Investor';
					                $model_app_log->action_message = 'Application move towards the signatory details';
					                $model_app_log->investor_id = $user_id;
					                $model_app_log->department_comment = '';
					                $model_app_log->investor_log_id = $investor_log_id;
					                $model_app_log->dept_log_id = 0;
					                $model_app_log->created = date('Y-m-d H:i:s');
					                if ($model_app_log->save()) {
					                    
					                }
					            } else {
					                die(var_dump($modellog->getErrors()));
					            }
					         echo CJavaScript::jsonEncode(array('status'=>true,'is_payment_done'=>false));
            	}
		      }         
    
    }

/* 
*/
   

    public function actionSubmitsignature(){
    	if(isset($_POST['srn_no'])){

  		 $user_id = $_SESSION['RESPONSE']['user_id'];
         $stat = 'PD';   // Payment Due
         $app_id = $_POST['srn_no'];
         $service_id = $_POST['service_id'];
         $dept_id = $_POST['dept_id'];
        $currentDate = date('Y-m-d H:i:s');
        $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
        $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();


    		 //Save Data IN bo_sp_application_history for log
            $serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($service_id);
            $issuer_id = DefaultUtility::dataSenetize($dept_id);
            $issuer_id = DefaultUtility::dataSenetize($app_id);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=$dept_id")->queryRow();
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$app_id")->queryRow();

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $app_id;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag = $sptagData['service_provider_tag'];
            $modelSPH->app_id = $app_id;
            $modelSPH->application_status = "$stat";
            $modelSPH->comments = 'Application Submitted but Payment Due.';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();

            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $app_id;
            $modellog->application_id = $app_id;
            $modellog->user_id = $user_id;
            $modellog->dept_id = $dept_id;
            $modellog->application_status = "$stat";
            $modellog->form_id = 1;
            $modellog->service_id = $service_id;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            if ($modellog->save()) {
                $investor_log_id = Yii::app()->db->getLastInsertID();
                $model_app_log = new FormBuilderApplicationLog;
                $model_app_log->service_id = $service_id;
                $model_app_log->form_id = 1;
                $model_app_log->core_department_id = $dept_id;
                $model_app_log->app_Sub_id = $app_id;
                $model_app_log->department_user_id = '0';
                $model_app_log->action_status = "$stat";
                $model_app_log->action_taken_by_name = 'Investor';
                $model_app_log->action_message = 'Application Submitted but Payment Due.';
                $model_app_log->investor_id = $user_id;
                $model_app_log->department_comment = '';
                $model_app_log->investor_log_id = $investor_log_id;
                $model_app_log->dept_log_id = 0;
                $model_app_log->created = date('Y-m-d H:i:s');
                if ($model_app_log->save()) {
                    
                }
            } else {
                die(var_dump($modellog->getErrors()));
            }
            echo "1";
    	}
    }

     public function actionSubmitsignaturewp(){
    	if(isset($_POST['srn_no'])){
    		 $user_id = $_SESSION['RESPONSE']['user_id'];   
        	 $stat = 'P'; //PAID
        	 $app_id = $_POST['srn_no'];
        	 $service_id = $_POST['service_id'];
        	 $dept_id = $_POST['dept_id'];
        	 $currentDate = date('Y-m-d H:i:s');
        	  $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_id  . "'";
		      $model = NewApplicationSubmission::model()->findBySql($sql);

		      if($model){
		      	
            $already_paid = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$app_id)->queryRow();
            	if(in_array($model->service_id, array('6.0','7.0')) || !empty($already_paid)){ 

            		$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($service_id);
		            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$model->dept_id)->queryRow(); 
		            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$app_id")->queryRow();
		            
					$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($app_id);
					$sno = $serviceData['sno'];
		            $service_id = $serviceData['service_id'];
		            $process_level = $serviceData['processing_level'];

		             $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
		     $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		      $this->ForwardToDepartment($app_id, $app_id, $service_id,'District');

		       $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $app_id;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $app_id;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $app_id;
            $modellog->application_id = $app_id;
            $modellog->user_id = $model->user_id;
            $modellog->dept_id = $model->dept_id;
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $model->service_id;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $model->service_id;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $model->dept_id;
            $model_app_log->app_Sub_id = $app_id;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted Successfully';
            $model_app_log->investor_id = $model->user_id;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted successfully and forwarded to CAIPO-department');
		       
           Sendmailforservice::senttofobo_pendingforapproval($model);  
            echo "1";
            die;    

            	}
		      }
			
	   	}
    }


    public function actionTestmemail(){
    	$subject = 'Test Multi Mail ';       
        
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='4.0' AND is_active='Y'")->queryRow();	

       /*	$details = Yii::app()->db->createCommand("SELECT CONCAT(u.full_name,' ',u.middle_name,' ',u.last_name) as full_name, u.email FROM tbl_user_service_role as us INNER JOIN bo_user u ON u.uid=us.user_id WHERE CONCAT(us.service_id,'.0')='".$model->service_id."' AND us.role_id = 83 AND us.is_active='Y'")->queryAll();*/
        $to = array('shashankshekharsingh888@gmail.com','deepika.bora4321@gmail.com','nehavishwakarma000@gmail.com','rider.amir456@gmail.com','zenmax20820@gmail.com','rajatt991@gmail.com','shashankshivam096@gmail.com','nehavishwakarma8887@gmail.com','rajatt992@gmail.com','shashankshekharsingh8882@gmail.com','deepika.bora43212@gmail.com','nehavishwakarma0002@gmail.com','rider.amir4562@gmail.com','zenmax208202@gmail.com','rajatt9921@gmail.com','shashankshivam0962@gmail.com','nehavishwakarma88872@gmail.com','rajatt9922@gmail.com','shashankshekharsingh8388@gmail.com','deepika.bora43321@gmail.com','nehavishwaka3rma000@gmail.com','rider.amir3456@gmail.com','zenmax208230@gmail.com','rajatt3991@gmail.com','shashankshiv3am096@gmail.com','nehavishw3akarma8887@gmail.com','rajat3t992@gmail.com','shashankshekha3rsingh8882@gmail.com','deepika.b3ora43212@gmail.com','nehavish3wakarma0002@gmail.com','rider.ami3r4562@gmail.com','zenma3x208202@gmail.com','raj3att9921@gmail.com','shashanksh3ivam0962@gmail.com','nehavish3wakarma88872@gmail.com','raja3tt9922@gmail.com');
      	

        $content = "<strong>Dear CAIPO-Verifier</strong>,<br><br>Please log in to CAIPO portal to review the assigned application for <b>Incorporation of Company</b> (Dummay_007). Please take necessary action by .<br><br>
			Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
			<br><br>
			Regards,<br>
			CAIPO";

        $post_data = array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);

        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);       
    	return $this->render('memail');
    }

   public function actionReverifyPayment($pcode=null){
   	// echo"<pre>";print_r($pcode);die;
  //	echo REVERIFY_API_URL; 
 // echo CJavaScript::jsonEncode(EZPAY_REVERIFICATION);
        $msg = $_POST['msg']; 
		$name = $_POST['reference_name']; 
		$number = $_POST['reference_number']; 
		$email = $_POST['reference_email']; 
		$processId = $_POST['process_id'];
		$tno = $_POST['transaction_number']; 
		$account = $_POST['ezpay_account']; 
		$fee = $_POST['total']; 
		$pstatus = $_POST['payment_status']; 
		$comment = $_POST['items'];
		$latefee = 0 ; //$_POST['latefee'];
		$verifystatus = $pstatus;
		$verified = 0 ;
		$currentDate = date('Y-m-d H:i:s');
		$service_srn_data =  "SELECT * FROM bo_new_application_submission WHERE submission_id = :processId";
		$connection1 = Yii::app()->db;
			$command = $connection1->createCommand($service_srn_data);
			$command->bindParam(":processId",  $processId, PDO::PARAM_STR);
			$service_srn=$command->queryRow();	
		
		// $farr = (array) json_decode($service_srn['field_value']);
		
		$uid = $service_srn['user_id'];
		$sid = $service_srn['service_id'];
		$feedetail="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND service_id=:sid";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($feedetail);
			$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
			$fee_data=$command->queryRow();	
		    $pobject = $fee_data['payment_code'];
		$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='late fee' AND service_id=:sid";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
			$late_fee=$command->queryRow();
	            if(!empty($late_fee)){
		            	$latefee = $late_fee['fee_amount'];	
		            	$pobject = $late_fee['payment_code'];
		            }
			
				/* if($sid=='39.0'){
					$form_id = $farr['UK-FCL-00613_0'];
					if(isset($form_id) && !empty($form_id) && $form_id== 'Intends to liquidate and dissolve')
					{
						$pobject= 'xxsOXJgISH';
						
					}
					if(isset($form_id) && !empty($form_id) && $form_id== 'Revokes its intent to dissolve')
					{
					
						$pobject= 'aGBrjCzq58';
						
					}
				} 
				*/
      // save payment detail with successful msg 
	
	if($pstatus=='success'){
     if(EZPAY_REVERIFICATION == 1){
      $curl = curl_init();
      curl_setopt_array($curl, array( 
	  CURLOPT_URL => REVERIFY_API_URL,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "transaction_number": $tno, 
	    "pobject": $pcode
	}',

	  CURLOPT_HTTPHEADER => array(
	    'X-API-KEY: EZPAY_API_KEY',
	    'Content-Type: application/json'
	  ),

	));
	$response = curl_exec($curl);
	curl_close($curl);
	$res = json_decode($response);
	$verifystatus = $res->status;
	$errormsg = isset($res->msg)?$res->msg:null;
	$verified = 1;
    $ipadd = $_SERVER['REMOTE_ADDR'];

    Yii::app()->db->createCommand("INSERT INTO tbl_reverify_payment(service_id,submission_id,payment_status,transaction_number,payment_submit_by,created_at,remote_server,response_data) VALUES ('$sid','$processId','$verifystatus','$tno',$uid,'$currentDate','$ipadd','errormsg' )")->execute(); 
	
	// print_r($res); die; 
    }
    
	// echo"<pre>";print_r($res); die;
	if($verifystatus == 'Success' || $verifystatus == 'success' ){
		  	Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,late_fee,is_payment_verified,payment_code) VALUES ('$sid','$processId','$fee','$fee',1,'success','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid','$latefee',$verified,'$pcode')")->execute();  
			
			$serviceDetail = Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$currentDate' WHERE submission_id=$processId")->execute();

			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($sid);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$service_srn['dept_id'])->queryRow(); 
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$processId")->queryRow();
            
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($processId);
			$sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
            
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($processId,$sno,$service_id,$process_level);

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $processId;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $processId;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted and Payment Paid Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $processId;
            $modellog->application_id = $processId;
            $modellog->user_id = $uid;
            $modellog->dept_id = $service_srn['dept_id'];
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $sid;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $sid;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $service_srn['dept_id'];
            $model_app_log->app_Sub_id = $processId;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted and Payment Paid Successfully';
            $model_app_log->investor_id = $uid;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            $sql1 = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql1); 
		       Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted with payment paid successfully and forwarded to CAIPO-department');    
		    Sendmailforservice::senttofobo_pendingforapproval($model); 
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);   

            Yii::app()->user->setFlash('success','Payment successfully completed');
            echo $verifystatus;
        }else{
        	Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,late_fee,payment_code,is_payment_verified)VALUES ('$sid','$processId','$fee','$fee',1,'$verifystatus','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid','$latefee','$pcode',1)")->execute();  
			 $sql2 = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql2); 
		       
		         Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted but payment failed');
				Sendmailforservice::payment_failed($model,$tno,$fee,$processId);  
				Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
				 echo $verifystatus;
        }
		}
		else{
			Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,late_fee,payment_code)VALUES ('$sid','$processId','$fee','$fee',1,'$pstatus','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid','$latefee','$pcode')")->execute();  
			if($pstatus=='failed'){
				 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
		           Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application was submitted but payment failed');
				Sendmailforservice::payment_failed($model,$tno,$fee,$processId);  
				Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
			}else{
				Yii::app()->user->setFlash('initiated','Payment has initiated');
			}
			echo $pstatus;
		}
		
	} 


	public function actionFaq(){
		return $this->render('faq');
	}


	public function actionVerifyPaymentDetail($tno){
		$tno = base64_decode($tno);
		$currentDate = date('Y-m-d H:i:s');
		$payment_data =  "SELECT * FROM tbl_payment WHERE transaction_number = :tno";
		$connection1 = Yii::app()->db;
			$command = $connection1->createCommand($payment_data);
			$command->bindParam(":tno",  $tno, PDO::PARAM_STR);
			$payment_detail=$command->queryRow();	


        $sid = $payment_detail['service_id'];	
        $uid = $payment_detail['payment_submit_by'];
        $processId =  $payment_detail['process_id'];
   //      $feedetail="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND service_id=:sid";
			// $connection = Yii::app()->db;
			// $command = $connection->createCommand($feedetail);
			// $command->bindParam(":sid",  $sid, PDO::PARAM_STR);
			// $fee_data=$command->queryRow();	
		    $pobject = $payment_detail['payment_code'];


		$curl = curl_init();
		curl_setopt_array($curl, array( 
		CURLOPT_URL => REVERIFY_API_URL,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"transaction_number": $tno, 
			"pobject": $pobject
		}',

		CURLOPT_HTTPHEADER => array(
			'X-API-KEY: EZPAY_API_KEY',
			'Content-Type: application/json'
		),

		));
	   $response = curl_exec($curl);
	//	 $response = '{"transaction":"2112022212333300337629","paymentcode":"MQdo2uNEKJ","date":"2021-12-02 17:11:33","total":"104.00","status":"Success","details":["{\"HEADER\":\"Business Name Application\",\"NAME\":\"Business Name Application\",\"EZPAY_ACCOUNT\":\"dpd5f85b68522a2f\",\"reference_number\":\"8201098\",\"reference_name\":\"Apoorv sinhal\",\"reference_email\":\"fiapporvtha@hotmail.com\",\"process_id\":\"46\",\"ITEMS\":\"Company Name Reservation\",\"AMOUNT_DUE\":\"104.00\"}"]}';
		curl_close($curl);
		$res = json_decode($response);
		$verifystatus = $res->status;
		$errormsg = isset($res->msg)?$res->msg:null;
		$ipadd = $_SERVER['REMOTE_ADDR'];

		Yii::app()->db->createCommand("INSERT INTO tbl_reverify_payment(service_id,submission_id,payment_status,transaction_number,payment_submit_by,created_at,remote_server,response_data) VALUES ('$sid','$processId','$verifystatus','$tno',$uid,'$currentDate','$ipadd', '$errormsg')")->execute(); 

		if($verifystatus == 'Success' || $verifystatus == 'success' ){
			$paymentUpdate = Yii::app()->db->createCommand("UPDATE tbl_payment SET payment_status='success',is_payment_verified= 1 WHERE transaction_number=$tno")->execute();
			// print_r($verifystatus);
			// print_r($paymentUpdate);die;
			$serviceDetail = Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$currentDate' WHERE submission_id=$processId")->execute();

			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($sid);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$service_srn['dept_id'])->queryRow(); 
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$processId")->queryRow();
            
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($processId);
			$sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
            
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($processId,$sno,$service_id,$process_level);

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $processId;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $processId;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted and Payment Paid Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $processId;
            $modellog->application_id = $processId;
            $modellog->user_id = $uid;
            $modellog->dept_id = $service_srn['dept_id'];
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $sid;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $sid;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $service_srn['dept_id'];
            $model_app_log->app_Sub_id = $processId;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted and Payment Paid Successfully';
            $model_app_log->investor_id = $uid;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            $sql1 = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql1);     
		    Sendmailforservice::senttofobo_pendingforapproval($model); 
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);   

            Yii::app()->user->setFlash('success','Payment status successfully updated');
            $this->redirect('/panchayatiraj/backoffice/investor/home/investorWalkthrough');
        }else{
        	 Yii::app()->user->setFlash('success','Payment status failed. Please try again later.');
            $this->redirect('/panchayatiraj/backoffice/investor/home/investorWalkthrough');
        }
	}

		public function actionDeleteapp($srn_no){
			$srn = base64_decode($srn_no);
			$sql1 = "SELECT * FROM bo_new_application_submission where submission_id='" . $srn  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql1);
		    $model->application_status = 'Z';
		    $model->application_updated_date_time = date('Y-m-d H:i:s');
		    $model->save();

		    $serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($model->submission_id);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=".$model->dept_id)->queryRow(); 
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$model->submission_id")->queryRow();
            
			

		    $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $model->submission_id;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag =  $sptagData['service_provider_tag'];
            $modelSPH->app_id = $model->submission_id;
            $modelSPH->application_status = "Z";
            $modelSPH->comments = 'Application Deleted';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
                
            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $model->submission_id;
            $modellog->application_id = $model->submission_id;
            $modellog->user_id = $model->user_id;
            $modellog->dept_id = $model->dept_id;
            $modellog->application_status = "Z";
            $modellog->form_id = 1;
            $modellog->service_id = $model->service_id;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();
            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $model->service_id;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $model->dept_id;
            $model_app_log->app_Sub_id = $model->submission_id;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "Z";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Deleted';
            $model_app_log->investor_id = $model->user_id;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

             Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Your Application is deleted');

              $this->redirect('/panchayatiraj/backoffice/investor/home/investorWalkthrough');


		}

		public function actionPaymenthistory(){
			$auth = false;
			if(isset($_SESSION['uid'])){
				$payment = Yii::app()->db->createCommand("SELECT p.*, s.service_name, sc.category_name FROM tbl_payment as p INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
				 	INNER JOIN bo_information_wizard_service_parameters sp ON app.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
					INNER JOIN bo_information_wizard_service_master s ON sp.service_id = s.id
					INNER JOIN bo_information_wizard_services_category sc ON s.sc_id = sc.id
				  GROUP BY p.submission_id ORDER BY submission_id DESC ")->queryAll();
				$auth = true;
			}else{
				if(isset($_SESSION['RESPONSE']['user_id'])){
					$user_id = $_SESSION['RESPONSE']['user_id'];
					$payment = Yii::app()->db->createCommand("SELECT p.*, s.service_name, sc.category_name FROM tbl_payment as p
					 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id 
					 INNER JOIN bo_information_wizard_service_parameters sp ON app.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
					INNER JOIN bo_information_wizard_service_master s ON sp.service_id = s.id
					INNER JOIN bo_information_wizard_services_category sc ON s.sc_id = sc.id
					 where app.user_id=$user_id GROUP BY p.submission_id ORDER BY submission_id DESC")->queryAll();
					$auth = true;
				}
			}		

			if($auth==true){
				return $this->render('payment_history',['payment'=>$payment]);
			}			
		}

		public function actionPaymenthisdetail(){
			if(isset($_GET['submission_id'])){
				$submission_id = DefaultUtility::dataSenetize(base64_decode($_GET['submission_id']));
				$mainpay = Yii::app()->db->createCommand("SELECT p.service_total_fee, p.submission_id, s.service_name, sc.category_name, app.user_id
				 FROM tbl_payment as p
						 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id 
						 INNER JOIN bo_information_wizard_service_parameters sp ON app.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
						INNER JOIN bo_information_wizard_service_master s ON sp.service_id = s.id
						INNER JOIN bo_information_wizard_services_category sc ON s.sc_id = sc.id
						 where p.submission_id=$submission_id")->queryRow();
				if($mainpay){
					if($mainpay['user_id']==$_SESSION['RESPONSE']['user_id']){
						$payment = Yii::app()->db->createCommand("SELECT p.* FROM tbl_payment as p
						 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
						 where p.submission_id=$submission_id AND is_fee_refunded=0")->queryAll();

					$paymentrefundrequest = Yii::app()->db->createCommand("SELECT * FROM tbl_refund_requested  
						 where submission_id=$submission_id")->queryAll();

					$paymentefund = Yii::app()->db->createCommand("SELECT p.* FROM tbl_payment as p
						 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
						 where p.submission_id=$submission_id AND is_fee_refunded=1")->queryAll();
					}else{
						$mainpay = NULL;
					}
				}
					
				//print_r($mainpay); die();
				return $this->render('payment_history_details',['mainpay'=>$mainpay,
					'payment'=>isset($payment) ? $payment : NULL,
					'paymentrefundrequest'=>isset($paymentrefundrequest) ? $paymentrefundrequest : NULL,
					'paymentefund'=>isset($paymentefund) ? $paymentefund : NULL
				]);
			}	
		}

		public function actionPaytrasndetail($p_id){
			$p_id = DefaultUtility::dataSenetize($p_id);
		$payment = Yii::app()->db->createCommand("SELECT p.transaction_number FROM tbl_payment as p
						 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
						 where p.id=$p_id")->queryRow();

		if($payment){
			$trans = Yii::app()->db->createCommand("SELECT * FROM tbl_reverify_payment 
					where transaction_number='".$payment['transaction_number']."'")->queryAll();
			if($trans){
				$ptdata = "<table class='table table-bordered table-striped table-responsive'><tr><td><b>Status</b></td><td><b>Remark</b></td><td><b>Date & Time</b></td></tr>";
			
					foreach ($trans as $key => $value) {
						$ptdata.="<tr><td>".$value['payment_status']."</td><td>".$value['response_data']."</td><td>".($value['created_at'] ? (date('d M Y h:i a',strtotime($value['created_at']))) : "")."</td></tr>";
					}
					$ptdata.="</table>";
				}else{
					$ptdata = '<p style="color:red">No transaction data found</p>';
				}
			echo CJavaScript::jsonEncode(array('status'=>true,'ptdata'=>$ptdata,'trans_no'=>$payment['transaction_number']));
		
		}else{
			echo CJavaScript::jsonEncode(array('status'=>false));
		}
		

	}


	public function actionPrintofflinefeeform($vpd_id){
 	$vpd_id = base64_decode($vpd_id);

 	$model = Yii::app()->db->createCommand("SELECT vpd.user_id, vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
			a.print_app_call_back_url,
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
			vpd.created_on 
			FROM vpd_documents vpd			
			INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

			 INNER JOIN bo_new_application_submission a
				  ON vpd.srn_no=a.submission_id
			 INNER JOIN bo_information_wizard_service_parameters bosp1
				  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

			WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.id=$vpd_id
		")->queryRow();

 	  $payment_detail = Yii::app()->db->createCommand("SELECT * FROM vpd_payment WHERE payment_status='Pending' AND vpd_id=" . $vpd_id)->queryRow();
if($model){
	$app_details = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name, u.mobile_no, u.email
		FROM sso_users u 
 		INNER JOIN sso_profiles up on u.user_id=up.user_id
 	     where u.is_account_active='Y' AND u.user_id=".$model['user_id'])->queryRow(); 
}else{
	$app_details = NULL;
}
       

	    $content = $this->renderPartial('/vpd/offlinefee_pdf', ['model' => $model,'payment_detail'=>$payment_detail, 'app_details'=>$app_details],true);
	    
        //print_r($content);die;
        //Reportformat::generatePdf($content, 'refund','');
        Refundutility::generatePdf($content, 'refund');
       
 }


 public function actionExtractDatafrompdf_old(){
		 		if(isset($_POST['pdfsubmit']) && isset($_POST['service_id'])){
		     $service_id = $_POST['service_id'];
		    if($_FILES['file']['type']=="application/pdf") {

		    	 
			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details')) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details');
			    }

			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'])) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id']);
			    }

			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id'])) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id']);
			    }

			     $targetFile = Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id'].'/'.$_FILES['file']['name']; 
		     
		        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		        	$output = Pdftotext::pdf2text($targetFile);

		        	$appURlData = Yii::app()->db->createCommand("select app_url from bo_sp_all_applications where service_id = '$service_id'")->queryRow(); 
										$appurl = str_replace("infowizard", "infowizardtwo", $appURlData['app_url']); 
									   $sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;

									   $appurlf=  $appurl.'?sc_id='.$sc_id;
/*echo '<pre>';
print_r($output);
die();*/
$out_array = explode(':', $output);

/*echo '<pre>';
print_r($out_array);
die();
*/
//return print_r($out_array);
$attributes_array = [
	'UK-FCL-00715_0'=>'Subject',
	'UK-FCL-00724_0'=>'Train No',
	'UK-FCL-00725_0'=>'Name of Train/Local/Sub Urban Train',
	/*'UK-FCL-00728_0'=>'StationFrom',
	'UK-FCL-00729_0'=>'Stationto',*/
	'UK-FCL-00002_0'=>'ApplicantFirstName',
	'UK-FCL-00003_0'=>'ApplicantMiddleName',
	'UK-FCL-00004_0'=>'ApplicantLastName',
	'UK-FCL-00737_0'=>'ContactNo',
	'UK-FCL-00738_0'=>'Email',
	'UK-FCL-00739_0'=>'Address',
	'UK-FCL-00742_0'=>'PinCode',
	'UK-FCL-00748_0' => 'AccountNo',
	'UK-FCL-00750_0' => 'BranchName',
	'UK-FCL-00753_0' => 'BranchCity',
	'UK-FCL-00749_0' => 'IFSCcode',
	'UK-FCL-00755_0' => 'VictimIDproofno',
	'UK-FCL-00756_0' => 'Victimfirstname',	
	'UK-FCL-00758_0' => 'VictimLastname',
	'UK-FCL-00760_0' => 'Victimcontactno',
	'UK-FCL-00761_0' => 'Victimaddress',
	'UK-FCL-00764_0' => 'Victimpincode',
	'UK-FCL-00765_0' => 'Victimfather/husbandname',
	'UK-FCL-00770_0' => 'VictimrelationIdproofno',
	'UK-FCL-00779_0' => 'GMname',
	'UK-FCL-00323_0' => 'GMDesignation',
	'UK-FCL-00780_0' => 'Respondentcontactno',
	'UK-FCL-00781_0' => 'RespondentEmail',
	'UK-FCL-00787_0' => 'ValuationofClaim'


];

$check_expload_array = [];

$main_array = [];
foreach ($out_array as $key => $value) {
       foreach ($attributes_array as $k => $val) {
               //$main_array[$val] = [$value];

              if (strpos($value, $val)) { 
                   if($key==0){
                     $main_array[]=['field_code'=>$k,'attribute'=>$val,'text'=>''];
                   }else{
                     $next_string = explode($val, $value);
                     $check_expload_array[$val] =  $next_string;
                     $main_array[]=['field_code'=>$k, 'attribute'=>$val,'text'=>'']; 
                     $previous_key = sizeof($main_array)-2;
                     $main_array[$previous_key]= [
                     	'field_code'=>$main_array[$previous_key]['field_code'],
                     	'attribute'=>$main_array[$previous_key]['attribute'],
                     	'text'=>$next_string[0]];                   
                   }                  
              }
       }

       if($key == (sizeof($out_array)-1)){
              
              $previous_key = sizeof($main_array)-1;
              $main_array[$previous_key]= [
              	'field_code'=>$main_array[$previous_key]['field_code'],
              	'attribute'=>$main_array[$previous_key]['attribute'],
              	'text'=>$value];   


       }
}

//return print_r($check_expload_array);
/*echo '<pre>';
print_r($main_array);
die();*/

						$final_array = [];
						foreach ($main_array as $key => $value) {
							 $final_array[$value['field_code']] = $value['text'];
						}

						$_SESSION['applicant_data_from_pdf'][$service_id] = $final_array;

		        	$this->redirect($appurlf);
		             
		        } else {
		            echo json_encode(array('status'=>false));exit();
		        }
	       
		    }else {
		        echo "<p style='color:red; text-align:center'>
		            Wrong file format</p>";
		    }
		}   
 		//return $this->render('extractDatafrompdf',['output'=>$output]);
 }


/*Aamir 14-01-2023*/
 public function actionExtractDatafrompdf(){
		 		if(isset($_POST['pdfsubmit']) && isset($_POST['service_id'])){
		     $service_id = $_POST['service_id'];
		    if($_FILES['file']['type']=="application/pdf") {

		    	 
			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details')) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details');
			    }

			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'])) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id']);
			    }

			    if (!file_exists(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id'])) {
			        @mkdir(Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id']);
			    }

			     $targetFile = Yii::app()->basePath .'/uploads/default_aaplication_details/'.$_SESSION['RESPONSE']['user_id'].'/'.$_POST['service_id'].'/'.$_FILES['file']['name']; 
		     
		        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		        	

		        	$appURlData = Yii::app()->db->createCommand("select app_url from bo_sp_all_applications where service_id = '$service_id'")->queryRow(); 
										$appurl = str_replace("infowizard", "infowizardtwo", $appURlData['app_url']); 
									   $sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;

									   $appurlf=  $appurl.'?sc_id='.$sc_id;


									   $latest_record = Yii::app()->db->createCommand("SELECT * FROM bo_application_pdf_parsedata WHERE service_id='47.0' AND srn_no IS NULL")->queryRow();
									   $out_array = [];
if($latest_record['parse_data']!=NULL){
   

    $message = str_replace('\r\n',"^",$latest_record['parse_data']);
   
    $decode_data = json_decode($message,true);
    foreach ($decode_data['ParsedResults'] as $key => $value) {   // each page loop
        if($key==2){
            $out_array = explode('^', $value['ParsedText']);
           
        }
        
    }
}

//return print_r($out_array);
$attributes_array = [];
$app_first_name = $app_last_name = '';
if(!empty($out_array)){

	$app_name = @$out_array['4'];
	if($app_name){
		$last_word_start = strrpos($app_name, ' ') + 1; // +1 so we don't include the space in our result
		$last_word = substr($app_name, $last_word_start);
		$app_name_array = explode($last_word, $app_name);
		$app_first_name = $app_name_array[0];
		$app_last_name = $last_word;
	}

	$app_add = @$out_array['16'];
	$app_add_array = explode('-', $app_add);
	$app_full_address = @$out_array['15'].' '.$app_add_array[0];
	$app_pin_code = $app_add_array[1];


$app_state = '';
	if($app_add_array[0]){
		$app_dis_stae = explode(',',$app_add_array[0]);
		$app_state = @$app_dis_stae[1];
	}


	$app_contact = @$out_array['18'];
	$app_contact_array = explode(':', $app_contact);	
	$app_contact = $app_contact_array[1];

	$app_mail = @$out_array['17'];
	$app_mail_array = explode(':', $app_mail);	
	$app_mail = $app_mail_array[1];



	$victim_add = @$out_array['23'];
	$victim_add_array = explode('-', $victim_add);
	$victim_full_address = @$out_array['22'].' '.$victim_add_array[0];
	$victim_pin_code = $victim_add_array[1];

	$victim_contact = @$out_array['25'];
	$victim_contact_array = explode(':', $victim_contact);	
	$victim_contact = $victim_contact_array[1];

	$victim_mail = @$out_array['24'];
	$victim_mail_array = explode(':', $victim_mail);	
	$victim_mail = $victim_mail_array[1];

if($service_id=='48.0'){
			$attributes_array = [	
				'UK-FCL-00790_0' => ['label_name'=>'NCLT Location', 'value'=>@$out_array[1]],
				'UK-FCL-00791_0' => ['label_name'=>'Location of Registered Office of Respondent', 'value'=>'Union territory of Delhi'],
				'UK-FCL-00792_0' => ['label_name'=>'Case Type', 'value'=>'Company Petition IB'],
				'UK-FCL-00795_0' => ['label_name'=>'Amount Claimed', 'value'=>'2753285'],
			
				'UK-FCL-00794_0' => ['label_name'=>'Case Matter', 'value'=>'Mr. Mahesh Kumar Mittal Sole Proprietor of Fortune Advertising Services Versus M/s. Goldmax Trade N Biz Pvt. Ltd.'],


				'UK-FCL-00715_0' => ['label_name'=>'Subject Matter', 'value'=>'Application u/s 9 of ‘The Insolvency and Bankruptcy Code, 2016'],

				'UK-FCL-00701_0' => ['label_name'=>'company name','value'=>'Fortune Advertising Services'],
				'UK-FCL-00803_0' => ['label_name'=>'CIN','value'=>'U52100DL2009PTC678765'],

				'tbl_4866' => [
										'UK-FCL-00797_0'=>[['label_name'=>'Section','value'=>'IBC Under Section 9']],
										'UK-FCL-00798_0'=>[['label_name'=>'Fees Amount','value'=>'1000']]
				],

				'tbl_4908' => [
					'UK-FCL-00804_0'=>[['label_name'=>'ApplicantFirstName','value'=>($app_first_name.' '.$app_last_name)],
 														['label_name'=>'ApplicantFirstName','value'=>'Mr. Ram Kumar Sharma']				
															],
					'UK-FCL-00412_0'=>[['label_name'=>'ApplicantAddress','value'=>$app_full_address],
														['label_name'=>'ApplicantAddress','value'=>'M/s ABC Enterprise,
															1512, ITL Towers, B-09,	Netaji Subhash Place,	Pitampura']
					],
					'UK-FCL-00805_0'=>[['label_name'=>'Nationality','value'=>'Indian'],['label_name'=>'Nationality','value'=>'Indian']],
					'UK-FCL-00720_0'=>[['label_name'=>'State','value'=>$app_state],['label_name'=>'State','value'=>'New Delhi']],
					'UK-FCL-00806_0'=>[],
					'UK-FCL-00807_0'=>[['label_name'=>'ApplicantPinCode','value'=>$app_pin_code],['label_name'=>'ApplicantPinCode','value'=>'11003']],
					'UK-FCL-00808_0'=>[['label_name'=>'App_pan_no','value'=>'AAMPM9310R'],['label_name'=>'App_pan_no','value'=>'AMOPK9876T']],
				  'UK-FCL-00809_0'=>[['label_name'=>'ApplicantContactNo','value'=>$app_contact],['label_name'=>'ApplicantContactNo','value'=>'9876543210']],
					'UK-FCL-00810_0'=>[['label_name'=>'ApplicantEmail','value'=>$app_mail],['label_name'=>'ApplicantEmail','value'=>'ramks98@gmail.com']]	
					],


					'UK-FCL-00811_0'=>['label_name'=>'Repondent Company Name', 'value'=>'Mis. Goldmax Trade N Biz Pvt. Ltd.'],
					'UK-FCL-00812_0'=>['label_name'=>'Repsondent CIN', 'value'=>'U52100DL2010PTC208543'],

					'tbl_4893' => [

					


					'UK-FCL-00813_0'=>[['label_name'=>'respondentName','value'=>'vikas garg']			
															],
					'UK-FCL-00814_0'=>[['label_name'=>'RespondentAddress','value'=>$victim_full_address]],
					'UK-FCL-00817_0'=>[],
					'UK-FCL-00816_0'=>[['label_name'=>'RespondentState','value'=>'New Delhi']],
					'UK-FCL-00818_0'=>[['label_name'=>'RespondentPinCode','value'=>$victim_pin_code]],
					'UK-FCL-00819_0'=>[],
				  'UK-FCL-00820_0'=>[['label_name'=>'RespondentContactNo','value'=>$victim_contact]],
					'UK-FCL-00821_0'=>[['label_name'=>'RespondentEmail','value'=>$victim_mail]]	
					],

					'tbl_4905' => [

					


					'UK-FCL-00823_0'=>[['label_name'=>'IRPname','value'=>'MR. MUKESH GUPTA']			
															],
					'UK-FCL-00824_0' =>[['label_name'=>'IRP Reg No.','value'=>'IBBI/IPA-001/IP-P01494/2018-2019/12254']],
					'UK-FCL-00825_0'=>[['label_name'=>'IRPAddress','value'=>'F-1, Milap Nagar, Uttam Nagar']],
					'UK-FCL-00826_0'=>[],
					'UK-FCL-00827_0'=>[['label_name'=>'Nationality','value'=>'Indian']],
					'UK-FCL-00828_0'=>[['label_name'=>'IRPState','value'=>'New Delhi']],
					'UK-FCL-00829_0'=>[],
					'UK-FCL-00830_0'=>[['label_name'=>'IRPPinCode','value'=>'110059']],
					'UK-FCL-00831_0'=>[['label_name'=>'IRP Mobile','value'=>'9818124699']],
					'UK-FCL-00832_0'=>[['label_name'=>'IRP Email','value'=>'camukeship@rediffmail.com']]
				 		
					],



			];	
}else{
		$attributes_array = [	
		'UK-FCL-00002_0'=>['label_name'=>'ApplicantFirstName','value'=>$app_first_name],
		'UK-FCL-00004_0'=>['label_name'=>'ApplicantLastName','value'=>$app_last_name],
		'UK-FCL-00737_0'=>['label_name'=>'ApplicantContactNo','value'=>$app_contact],
		'UK-FCL-00738_0'=>['label_name'=>'ApplicantEmail','value'=>$app_mail],
		'UK-FCL-00739_0'=>['label_name'=>'ApplicantAddress','value'=>$app_full_address],
		'UK-FCL-00742_0'=>['label_name'=>'ApplicantPinCode','value'=>$app_pin_code],
		'UK-FCL-00756_0' =>['label_name'=> 'Victimfirstname','value'=>@$out_array['20']],	
		'UK-FCL-00758_0' =>['label_name'=> 'VictimLastname','value'=>@$out_array['21']],
		'UK-FCL-00760_0' =>['label_name'=> 'Victimcontactno','value'=>$victim_contact],
		'UK-FCL-00761_0' =>['label_name'=> 'Victimaddress','value'=>$victim_full_address],
		'UK-FCL-00764_0' =>['label_name'=> 'Victimpincode','value'=>$victim_pin_code]
	];	
}



}



						$final_array = [];
						foreach ($attributes_array as $key => $value) {
							 $final_array[$key] = $value;
						}

						$_SESSION['applicant_data_from_pdf'][$service_id] = $final_array;

		        	$this->redirect($appurlf);
		             
		        } else {
		            echo json_encode(array('status'=>false));exit();
		        }
	       
		    }else {
		        echo "<p style='color:red; text-align:center'>
		            Wrong file format</p>";
		    }
		}   
 		
 }

 public function actionPdftohtml(){
 	return $this->render('pdftohtml');
 }
 
	 public function actionDonation(){
		if($_POST){
				/* echo "<pre>";
				print_r($_POST);
				
				print_r( $_SESSION['RESPONSE']);
			die; */
			$model_payment = new Payment();	
			$model_payment->service_id = $_POST['service_id']; 		
			$model_payment->payment_for = 'donation'; 
			$model_payment->submission_id = 0; 
			$model_payment->total_amount = $_POST['amount'];
			$model_payment->payment_mode = 1; 
			$model_payment->payment_gateway_method =1; 
			$model_payment->discount = '0.00'; 
			$model_payment->payment_status = 'success'; 
			$model_payment->transaction_number = rand(); 
			$model_payment->reference_name =$_SESSION['RESPONSE']['first_name'];
			$model_payment->reference_number =$_SESSION['RESPONSE']['mobile_number'];
			$model_payment->reference_email =$_SESSION['RESPONSE']['email'];
			$model_payment->payment_submit_by = $_SESSION['RESPONSE']['user_id']; 
			$model_payment->payment_received_by = '0'; 
			$model_payment->is_fee_refunded =0; 
			$model_payment->process_id = '010'; 
			$model_payment->pg_account = ''; 
			$model_payment->msg = 'Payment Successful'; 
			$model_payment->created_at = date('Y-m-d H:i:s');
			$model_payment->updated_at = date('Y-m-d H:i:s'); 
			
			/* echo "<pre>";
			print_r($model_payment);die; */
			if($model_payment->save()){
				Yii::app()->user->setFlash('initiated','Payment has been submitted successfully.');
			}else{
				var_dump($model_payment->getErrors());die;
			}		
		}	
		return $this->render('donation_payment');
	 }
}
