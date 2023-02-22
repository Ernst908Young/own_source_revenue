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
        $id = isset($_GET['id'])?$_GET['id'] :1;	
         /*echo "SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
		LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
		WHERE sm.sc_id=$sc_id AND sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y' AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";die;*/
		$res_s = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
		LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
		WHERE sm.sc_id=$sc_id AND sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y' AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC")->queryAll();


        /* $res_s = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master as sm  
			INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  			
			WHERE sm.sc_id=$sc_id AND sm.issuerby_id='$id' AND sp.is_active='Y' ORDER BY service_name ASC")->queryAll();*/

        $sn_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master where sc_id=$sc_id")->queryAll();
		$sc = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where id=$sc_id")->queryRow();
        $this->render("dashboard", array('res_s' => $res_s, 'id' => $id, 'user_id' => $user_id, 'type' => $type,'sn_arr'=>$sn_arr,'sc'=>$sc));		
		//$this->render('dashboard',array());
	}

	public function actionTicketquery(){
		//$this->layout = '//layouts/final_dashboard';
		$uid = @$_SESSION['RESPONSE']['user_id'];
		$tickets_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_t,
			    COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
			    COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
			    COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
			    COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
			    COUNT(CASE WHEN `status` = 'C' THEN 1 END) AS close_t  
				FROM supportmain WHERE usercode=$uid")->queryRow();
		
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
			WHERE sm.usercode=$uid order by sm.supportmaincode DESC")->queryAll();

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

	public function actionPayment($srn_no)
	{      
		$srn_no = base64_decode($srn_no);
        $srn_no=$this->dataSenetize($srn_no);

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
		if($sid=='2.0'){
			
		$form_id = $farr['UK-FCL-00044_0'];

         if(isset($form_id) && !empty($form_id) && $form_id==3)
          {
            $sercename= 'Business Name Registration (Form 1)';
          }
          if(isset($form_id) && !empty($form_id) && $form_id==2)
          {
            $sercename= 'Name Reservation (Form 33)';
          }
          if(isset($form_id) && !empty($form_id) && $form_id==1)
          {
            $sercename= 'Name Reservation (Form 15)';
          }	
			
		$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND page_form_id = :form_id AND service_id=:sid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
		$command->bindParam(":form_id",  $form_id, PDO::PARAM_STR);
		$service_fee=$command->queryRow();
		$servicefee  = $service_fee['fee_amount'];
		}else{
			
		$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND service_id=:sid";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
		$service_fee=$command->queryRow();
		$servicefee  = $service_fee['fee_amount'];
		

           // Start Late Fee Code //
		$late_fee_array =['12.0','13.0'];
			if(in_array($sid, $late_fee_array)){
				$date1 = date_create(date('Y-m-d H:i:s'));
	            $date2 = date_create(date('Y-m-d H:i:s',strtotime($service_srn['application_created_date'])));
	            $diff  = date_diff($date1,$date2);
	            $ad    = $diff->format("%a");

	            if($sid=='13.0'){
	            	$entity_reg_no = $farr['UK-FCL-00403_0'];
	            	$comp_detail = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE company_type='NPC' AND reg_no = '".$entity_reg_no."'")->queryRow();
	            	if($comp_detail){
	            		if($ad>15){
	            			$updays = $ad-15;	            			
	            			$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='late fee' AND service_id=:sid";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
						$service_fee=$command->queryRow();
						$updays_amt = $updays*$service_fee['fee_amount'];
						$latefee = $updays_amt;
		            	$servicefee = $updays_amt+$servicefee;

	            		}
	            	}else{
	            		 if($ad>30){            	
							$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='late fee' AND service_id=:sid";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
							$service_fee=$command->queryRow();
			            	$servicefee = $service_fee['fee_amount']+$servicefee ;
			            	$latefee = $service_fee['fee_amount'];	 	            	}
	            	}
	            }
	        	
	        	if($sid=='12.0'){
	        		 if($ad>30){            	
						$sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='late fee' AND service_id=:sid";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$command->bindParam(":sid",  $sid, PDO::PARAM_STR);
						$service_fee=$command->queryRow();
		            	$servicefee = $service_fee['fee_amount']+$servicefee;
		            	$latefee = $service_fee['fee_amount'];	
		            }
	        	}
	           
			}

			// End Late Fee Code //

			
		}
		

		
		//Yii::app()->db->createCommand("SELECT sum(fee_amount) as total_fees from tbl_service_fee where service_id=15.0 AND is_fee_payable=1")->queryRow();

        // if offilne button pay click 
        if(isset($_POST['srnno'])){         
			Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,process_id,submission_id, service_total_fee, total_amount,payment_mode, payment_gateway_method,payment_submit_by,payment_status,reference_name,reference_number,reference_email,chalan_no,fees_item,late_fee) VALUES ('$sid','$srn_no','$srn_no','$servicefee','$servicefee',3,1,'$uid','pending','$name','$number','$email','$recipet_no','$sercename','$latefee')")->execute();   
                 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $srn_no  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
               Sendmailforservice::payment_pending($model,$recipet_no,$servicefee,$srn_no); 
			$this->redirect('/backoffice/investor/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL');
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
		    Sendmailforservice::senttofobo_pendingforapproval($model); 
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);   

            Yii::app()->user->setFlash('success','Payment successfully completed');
            echo $pstatus;
			//$this->redirect('');
		}else{
			if($pstatus=='failed'){
				 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
				Sendmailforservice::payment_failed($model,$tno,$fee,$processId);  
				Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
			}else{
				Yii::app()->user->setFlash('initiated','Payment has initiated');
			}
			echo $pstatus;
		}
	}	
	
	public function actionGetspdetails($sp_id){
		$details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name ,p.address,p.address2,p.city_name,p.country_name,p.gender,p.mobile_number,p.pin_code,p.state_name,u.sp_type,u.lic_no,u.entity_name
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=$sp_id")->queryRow();
		if($details){
			if($details['country_name']){
				$c = Yii::app()->db->createCommand("SELECT *
					from bo_landregion			
				where lr_id=".$details['country_name'])->queryRow();
				$c_name = $c['lr_name']; 
			}else{
				$c_name = '';
			}
			if($details['state_name']){
				$s = Yii::app()->db->createCommand("SELECT *
					from bo_landregion			
				where lr_id=".$details['state_name'])->queryRow(); 
				$s_name = $s['lr_name'];
			}else{
				$s_name = $s['lr_name'];
			}
			echo CJavaScript::jsonEncode(array('status'=>true,'details'=>$details,'state_name'=>$s_name,'country_name'=>$c_name));
		}else{
			echo CJavaScript::jsonEncode(array('status'=>false));
		}
		

	}

	public function actionObserviceprovider(){
		$model = new AgentServiceProvider;
		if(isset($_POST['serviceprovider_user_id']) || isset($_POST['first_name'])){
			if($_POST['serviceprovider_user_id']==''){
				$model->service_provider_type = $_POST['ind_ent'];
				$model->entity_name = isset($_POST['entity_name']) ? $_POST['entity_name'] : NULL;
				$model->entity_type = isset($_POST['entity_type']) ? $_POST['entity_type'] : NULL;		
				$model->first_name = $_POST['first_name'];
				$model->middle_name = $_POST['middle_name'];
				$model->surname = $_POST['last_name'];
				$model->gender = $_POST['gender'];
				$model->mobile = $_POST['mobile'];
				$model->email = $_POST['email'];
				$model->address_line1 = $_POST['addlin1'];
				$model->address_line2 = $_POST['addlin2'];
				$model->country_id = $_POST['country_id'];
				$model->state_id = $_POST['state_id'];
				$model->city_name = $_POST['city'];
				$model->pin_code = $_POST['pin_code'];
				$model->is_first_entry = 1;
				$model->sp_type = $_POST['type_sp'];
				
				$is_reg_agent = 'No';
			}else{
				$model->agent_user_id = $_POST['serviceprovider_user_id'];
				$model->is_first_entry = 0;
				$is_reg_agent = 'Yes';
			}
			$model->action_date = date('Y-m-d H:i:s');

			$model->company_id = isset($_POST['entity_id']) ? $_POST['entity_id'] : NULL;
			$model->user_id = $_SESSION['RESPONSE']['user_id'];
			$randnum=mt_rand(10000000, 99999999);
			$model->sp_status = 'N';
			$model->activation_key = $randnum;
			$company_id = $model->company_id;
			$activation_key = $model->activation_key;
		if($model->save()){
			Yii::import('application.extensions.phpmailer.JPhpMailer');
			$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
				from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=$model->user_id")->queryRow();
			if($is_reg_agent=='Yes'){
				$model = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
				from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=$model->agent_user_id")->queryRow();
				//print_r($model); die();
			}

			$this->sendMailtoAgent($model,$Appuserdetail,$is_reg_agent,$company_id);			
			$this->sendMailtoApplicant($model,$Appuserdetail,$activation_key,$is_reg_agent);
			Yii::app()->user->setFlash('success','The request has been sent to the '.$model['sp_type'].' successfully.');
			$this->redirect('/backoffice/investor/home/investorWalkthrough');
		}

	}		
	$this->render('obsp',['model'=>$model]);
}

	// this mail function call when mail sent to agent on onboard
	function sendMailtoAgent($model,$Appuserdetail,$is_reg_agent,$company_id){
		
		$dear_name = $model['first_name'].' '.$model['middle_name'].' '.$model['surname'];
	
	

		$subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $model['email'];
        $name = $dear_name;

		

		$company_name = '';
		if($company_id>0){
			$comp = Yii::app()->db->createCommand("SELECT * FROM bo_company_details where id=".$company_id)->queryRow();
			$company_name = ' / '.$comp['company_name'];
		}
		
		$app_username = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'].$company_name;

		if($is_reg_agent=='No'){
			/*$remain_lin = "sso/account/registration/first_name/".$model->first_name."/middle_name/".$model->middle_name."/surname/".$model->surname ."/mobile/".$model->mobile."/email/".$model->email."/gender/".$model->gender."/address/".$model->address_line1."/address2/".$model->address_line2."/country_name/".$model->country_id."/state_name/".$model->state_id."/city_name/".$model->city_name."/pin_code/".$model->pin_code."/sp_type/".$model->sp_type."/service_provider_type/".$model->service_provider_type."/entity_name/".$model->entity_name."/entity_type/".$model->entity_type;*/

			//$remain_lin = "sso/account/registration?first_name=".$model->first_name."&middle_name=".$model->middle_name."&surname=".$model->surname ."&mobile=".$model->mobile."&email=".$model->email."&gender=".$model->gender."&address=".$model->address_line1."&address2=".$model->address_line2."&country_name=".$model->country_id."&state_name=".$model->state_id."&city_name=".$model->city_name."&pin_code=".$model->pin_code."&sp_type=".$model->sp_type."&service_provider_type=".$model->service_provider_type."&entity_name=".$model->entity_name."&entity_type=".$model->entity_type;

			/*$regi_link = str_replace('backoffice', $remain_lin, Yii::app()->request->getBaseUrl(true));*/

			$remain_lin = Yii::app()->createUrl('sso/account/registration',
				array('first_name'=>$model->first_name,
					  'middle_name'=>$model->middle_name,
					  'surname'=>$model->surname,
					  'mobile'=>$model->mobile,
					  'email'=>$model->email,
					  'gender'=>$model->gender,
					  'address'=>$model->address_line1,
					  'address2'=>$model->address_line2,
					  'country_name'=>$model->country_id,
					  'state_name'=>$model->state_id,
					  'city_name'=>$model->city_name,
					  'pin_code'=>$model->pin_code,
					  'sp_type'=>$model->sp_type,
					  'service_provider_type'=>$model->service_provider_type,
					  'entity_name'=>$model->entity_name,
					  'entity_type'=>$model->entity_type
					));

$regi_link = str_replace('/backoffice', 'protected.caipo.gov.bb',$remain_lin);

			//$regi_link = "protected.caipo.gov.bb/".$remain_lin;

			$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been nominated by <strong>".$app_username."</strong> to act as a ".$model['sp_type']." on CAIPO. <br><br>Please complete your registration through this <a href='".$regi_link."'> CAIPO registration link </a>. If you already registered as a ".$model['sp_type']." on same portal then go to direct login<br><br>Please contact <strong>".$app_username."</strong> to get the Activation Key to succesfully onboard on the portal. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		}else{

			/*$regi_link = str_replace('backoffice', BASE_URL'sso/account/signin', Yii::app()->request->getBaseUrl(true));*/
			$regi_link = "protected.caipo.gov.bb/sso/account/signin";
			
			$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been nominated by <strong>".$app_username."</strong> to act as a ".$model['sp_type']." on CAIPO. Click on this <a href='".$regi_link."'> CAIPO registration link </a> go to direct login<br><br>Please contact <strong>".$app_username."</strong> to get the Activation Key to succesfully onboard on the portal. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO<br><br>";
		}

		
       

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);


	}

	// this mail function call when mail sent to applicant on onboard
	function sendMailtoApplicant($model,$Appuserdetail,$activation_key,$is_reg_agent){
		
		$subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $Appuserdetail['email'];
        $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
        $name = $dear_name;

		$entity_name = '';
		if(isset($model['entity_name'])){			
			$entity_name = ' / '.$model['entity_name'];
		}
		
		$agent_username = $model['first_name'].' '.$model['middle_name'].' '.$model['surname'].$entity_name;

		$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully nominated <strong>".$agent_username."</strong> as a ".$model['sp_type'].".<br><br>Give this activation key <strong>".$activation_key."</strong> to the ".$model['sp_type']." for activation.<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		
		 $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
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
    public function actionRevokebyapplicant($sp_id){
    	if(isset($_POST['reason'])){
    		$r = $_POST['reason'];
    		$cuid = $_SESSION['RESPONSE']['user_id'];
    		$cdate = date('Y-m-d H:i:s');
    		Yii::app()->db->createCommand("UPDATE agent_service_provider SET is_revoke=1, revoke_reason='".$r."', revoke_by=$cuid, sp_status='R', action_date='".$cdate."' WHERE id= $sp_id")->execute();

 			$details =  Yii::app()->db->createCommand("SELECT * FROM agent_service_provider where id=$sp_id")->queryRow();
//return print_r($details); die();
            $applicant = Yii::app()->db->createCommand("SELECT u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.user_id=".$details['user_id'])->queryRow();

          $company_name = '';
        if($details['company_id']>0){
            $comp = Yii::app()->db->createCommand("SELECT * FROM bo_company_details where id=".$details['company_id'])->queryRow();
            $company_name = ' / '.$comp['company_name'];
        }

        $agent = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.user_id=".$details['agent_user_id'])->queryRow();
	Yii::import('application.extensions.phpmailer.JPhpMailer');
    		$this->sendMailtoAgent_revoke($details, $applicant, $company_name, $agent);     
            $this->sendMailtoApplicant_revoke($details, $applicant, $company_name, $agent);
            $this->sendMailtoCaipo_revoke($details, $applicant, $company_name, $agent);
            Yii::app()->user->setFlash('success', ($agent['first_name'].' '.$agent['last_name'].' '.$agent['surname']).' has been revoked successfully.');
    		echo CJavaScript::jsonEncode(array('status'=>true));
    	}else{
    		echo CJavaScript::jsonEncode(array('status'=>false));
    	}
    }

     // this mail function call when mail sent to agent on onboard
    function sendMailtoAgent_revoke($details, $applicant, $company_name, $agent){
      
        $dear_name = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'];
    
        $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $agent['email'];
        $name = $dear_name;


        $app_username = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'].$company_name;
        $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$app_username."</strong> has revoked you as a ".$sp_type." from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);

    }

    // this mail function call when mail sent to applicant on onboard
    function sendMailtoApplicant_revoke($details, $applicant, $company_name, $agent){
       

         $dear_name = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'];
      
       
 $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $applicant['email'];
        $name = $dear_name;

        
    
        $entity_name = '';
        if($details['entity_name']){            
            $entity_name = ' / '.$details['entity_name'];
        }
        
        $agent_username = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'].$entity_name;
         $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully revoked <strong>".$agent_username."</strong> from the CAIPO Portal to act as a ".$sp_type.".  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
       $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
    }

     // this mail function call when mail sent to CAipo on onboard
    function sendMailtoCaipo_revoke($details, $applicant, $company_name, $agent){
         $dear_name = "CAIPO User";
 		$subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = "caipodummy@gmail.com";
        $name = $dear_name;


          $entity_name = '';
        if($details['entity_name']){            
            $entity_name = ' / '.$details['entity_name'];
        }
        $agent_username = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'].$entity_name;

          $app_username = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'].$company_name;

           $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$app_username."</strong> has revoked <strong>".$agent_username."</strong> to act as a ".$sp_type." from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
    }

  	
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

	public function actionSpdoc(){

		return $this->render('sp_doc');
	 
	}

/* this action is for uploading document by agent (service provider) By Aamir*/
public function actionFileupload(){
	header('Content-Type: application/json'); // set json response headers
       $user_id = $_SESSION['RESPONSE']['agent_user_id'];  

    $targetDir = '/var/www/html/backoffice/protected/uploads';			
	    if (!file_exists($targetDir)) {
	        @mkdir($targetDir);			      
	    }
	$targetDir = '/var/www/html/backoffice/protected/uploads/agentdoc';			
	    if (!file_exists($targetDir)) {
	        @mkdir($targetDir);			      
	    }

	$targetDir = '/var/www/html/backoffice/protected/uploads/agentdoc/'.$user_id;			
	    if (!file_exists($targetDir)) {
	        @mkdir($targetDir);			      
	    }

    $fileBlob = 'fileBlob'; // the parameter name that stores the file blob
                   
    if (isset($_FILES[$fileBlob]) && isset($_POST['uploadToken'])) {
    
    		    $file = $_FILES[$fileBlob]['tmp_name'];  
		        $fileId = $_POST['fileId'];        
		     
		        $targetFile = $targetDir.'/'.$fileId;  
		     
		        if(move_uploaded_file($file, $targetFile)) {
		        	$file_path = '/backoffice/protected/uploads/agentdoc/'.$user_id.'/'.$fileId;
		        	$created_on = date('Y-m-d H:i:s');
		        	Yii::app()->db->createCommand('INSERT INTO sso_sp_documents (user_id, file_path, created) VALUES ("'.$user_id.'", "'.$file_path.'", "'.$created_on.'")')->execute();
		             echo json_encode(array('status'=>true));
		        } else {
		            echo json_encode(array('status'=>false));
		        }
    
       
    }else{
    	 echo json_encode(array('status'=>false,'msg'=>'something was missing'));
    }
 	  exit();
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
		
		$this->render('signatory',['user'=>$user,'service'=>$service,'service_srn'=>$service_srn,'user_profile'=>$user_profile,'model'=>$model,'srn_no'=>$srn_no,'dept_id'=>$dept_id]);
}

public function actionSaveSignature($srn_no){
	
	if(isset($_POST['fn']) && isset($_POST['srn_no'])){
		
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
		echo CJavaScript::jsonEncode(array('status' => false, 'msg' => 'Some fields are required'));
	}
}

public function actionSaveAllDocuments() {

        extract($_GET);
        $user_id = $_SESSION['RESPONSE']['user_id'];
  

       $stat = 'SP';   // signature pending


        $currentDate = date('Y-m-d H:i:s');
        $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
        $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();



        //Save Declartion record
        $checkalreadycheck = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_metadata WHERE service_id=$service_id AND application_id=$app_id")->queryRow();
        if ($checkalreadycheck) {
            
        } else {
            $dec_metadata = new Declarationmetadata;
            $dec_metadata->service_id = $service_id;
            $dec_metadata->application_id = $app_id;
            $dec_metadata->save();
        }


       
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
          return true;
    
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
		     $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
		     $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		      $this->ForwardToDepartment($app_id, $app_id, $service_id,'District');
		       $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_id  . "'";
		      $model = NewApplicationSubmission::model()->findBySql($sql);     
		      Sendmailforservice::senttofobo_pendingforapproval($model);  
            echo "1";
            die;    
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

   public function actionReverifyPayment(){
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
		$service_srn =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = $processId")->queryRow();
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

		Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,late_fee)VALUES ('$sid','$processId','$fee','$fee',1,'$pstatus','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid','$latefee')")->execute();  

   	
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
	    "pobject": $pobject
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
}
	//echo"<pre>";print_r($res); die;
	if($verifystatus == 'Success' || $verifystatus == 'success' ){
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

            $sql1 = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		    $model = NewApplicationSubmission::model()->findBySql($sql1);     
		    Sendmailforservice::senttofobo_pendingforapproval($model); 
		    Sendmailforservice::payment_successfull($model,$tno,$fee,$processId);   

            Yii::app()->user->setFlash('success','Payment successfully completed');
            echo $verifystatus;
        }else{
			 $sql2 = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql2); 
				Sendmailforservice::payment_failed($model,$tno,$fee,$processId);  
				Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
				 echo $verifystatus;
        }
		}else{
			if($pstatus=='failed'){
				 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
		         $model = NewApplicationSubmission::model()->findBySql($sql); 
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


	public function actionReverifytest(){
		$tno = '21072406022100071629';
		$pobject = 'UMI1JLnXxa';
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
		curl_close($curl);
		$res = json_decode($response);
		print_r($res);
	}

	

}
