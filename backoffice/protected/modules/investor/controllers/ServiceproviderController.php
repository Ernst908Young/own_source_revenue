
<?php
class ServiceproviderController extends Controller
{
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
				$is_reg_agent = 'No';

			}else{
				$model->agent_user_id = $_POST['serviceprovider_user_id'];
				$model->is_first_entry = 0;
				$is_reg_agent = 'Yes';
			}

			$model->user_id = $_SESSION['RESPONSE']['user_id'];
			$model->action_type = $_POST['at_ch_box'];
			$model->sp_type = $_POST['sp_type'];
			$model->app_entity_type_id = isset($_POST['app_entity_type_id']) ? $_POST['app_entity_type_id'] : NULL;

				 
			

				if($model->sp_type=='Corporate Trust Service Provider (CTSP)' && in_array($model->app_entity_type_id, [1,2,3])){
					$model->date_of = isset($_POST['date_of']) ? $_POST['date_of'] : NULL;
					$model->match_date = isset($_POST['match_date']) ? $_POST['match_date'] : NULL;
					$model->late_fee = isset($_POST['late_fee']) ? $_POST['late_fee'] : 0;

					$filepaths = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_file_temp WHERE doc_no = 1 AND user_id = ".$model->user_id." ORDER BY id DESC")->queryRow();


					if($filepaths){
					    $model->file_path = @$filepaths['file_path'];
					}else{
						Yii::app()->user->setFlash('error','Please upload the document properly');
						$this->redirect('/backoffice/investor/serviceprovider/observiceprovider/obsp/1'); 
					}


					if($model->app_entity_type_id==2){
						 $exist_doc2 = Yii::app()->db->createCommand("SELECT * from agent_service_provider_file_temp where doc_no=2 AND user_id=".$model->user_id." ORDER BY id DESC")->queryRow();
						 if($exist_doc2){
						 	$model->file_path_2 = @$exist_doc2['file_path'];
						 }else{
						 	/*Yii::app()->user->setFlash('error','Please upload the document properly');
							$this->redirect('/backoffice/investor/serviceprovider/observiceprovider/obsp/1'); */
						 }
					    
					}
				}
			
			
				
			Yii::app()->db->createCommand("DELETE FROM agent_service_provider_file_temp WHERE user_id = ".$model->user_id)->execute();

			$model->created_on = $model->action_date = date('Y-m-d H:i:s');
			$model->company_id = isset($_POST['entity_id']) ? $_POST['entity_id'] : NULL;
			$company_id = $model->company_id;			

			if($model->late_fee>0){
				$model->sp_status = 'PD';
			}else{
				$model->sp_status = 'N';
				$randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;			
				$activation_key = $model->activation_key;
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));
			}

		if($model->save()){
			if($is_reg_agent=='Yes'){
				$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
			}else{
				$serviceproviderdetails = $model;
			}

			// insert records in log table
			$remark = $model->sp_status=='PD' ? "Late Fee Payment Due" : "Nominated";
			$this->addlog($model->id, $model->sp_status, $model->user_id, 1, $remark);
			/*Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by,created_role_id, sp_status, action_remark) VALUES ($model->user_id, $model->company_id,'".$serviceproviderdetails['email']."',$model->agent_user_id, '".date('Y-m-d H:i:s')."',$model->user_id,1,'".$model->sp_status."', '$remark')")->execute();*/

			if($model->sp_status=='PD'){
			    return $this->redirect(['payment','obsp'=>1,'asp_id'=>base64_encode($model->id)]);
			}else{
				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=$model->user_id")->queryRow();					

				$this->sendMailtoAgent($serviceproviderdetails,$Appuserdetail,$is_reg_agent,$company_id);			
				$this->sendMailtoApplicant($serviceproviderdetails,$Appuserdetail,$activation_key,$is_reg_agent);
				Yii::app()->user->setFlash('success','The request has been sent to the '.$model['sp_type'].' successfully.');
				$this->redirect('/backoffice/investor/home/investorWalkthrough');	
			}
			
		}

	}		
	$this->render('obsp',['model'=>$model]);
 }

 function actionObspupdate($asp_id){
 	$model = AgentServiceProvider::model()->findByPk(base64_decode($asp_id));
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
			$is_reg_agent = 'No';

			/*unset value */
			$model->agent_user_id = NULL;

			}else{
				$model->agent_user_id = $_POST['serviceprovider_user_id'];

				$model->is_first_entry = 0;
				$is_reg_agent = 'Yes';

				/*unset value */
				$model->service_provider_type = $model->entity_name = $model->entity_type = $model->first_name = $model->middle_name = 	$model->surname = $model->gender = $model->mobile = $model->email = $model->address_line1 = $model->address_line2 = $model->country_id = $model->state_id = 
			$model->city_name = $model->pin_code = NULL;
			}

			$model->user_id = $_SESSION['RESPONSE']['user_id'];
			$model->action_type = $_POST['at_ch_box'];
			$model->sp_type = $_POST['sp_type'];
			$model->app_entity_type_id = isset($_POST['app_entity_type_id']) ? $_POST['app_entity_type_id'] : NULL;

				 
			$filepaths = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_file_temp WHERE user_id = ".$model->user_id)->queryRow();

				if($model->sp_type=='Corporate Trust Service Provider (CTSP)' && in_array($model->app_entity_type_id, [1,2,3])){
					$model->date_of = isset($_POST['date_of']) ? $_POST['date_of'] : NULL;
					$model->match_date = isset($_POST['match_date']) ? $_POST['match_date'] : NULL;
					$model->late_fee = isset($_POST['late_fee']) ? $_POST['late_fee'] : 0;
					if($filepaths){
					    $model->file_path = @$filepaths['file_path'];
					}
				}

			Yii::app()->db->createCommand("DELETE FROM agent_service_provider_file_temp WHERE user_id = ".$model->user_id)->execute();
			$model->company_id = isset($_POST['entity_id']) ? $_POST['entity_id'] : NULL;
			$company_id = $model->company_id;
			$model->activation_key = $model->key_expired_on = NULL;

			if($model->late_fee>0){
				$model->sp_status = 'PD';
			}else{
				$model->sp_status = 'N';
				$randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;			
				$activation_key = $model->activation_key;
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));
			}

		if($model->save()){
			if($is_reg_agent=='Yes'){
				$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
			}else{
				$serviceproviderdetails = $model;
			}

			// insert records in log table
			$remark = $model->sp_status=='PD' ? "Resubmited & Late Fee Payment Due" : "Nominated";
		//	$this->addlog($model->id, $model->sp_status, $model->user_id, 1, $remark);
			
			if($model->sp_status=='PD'){
			    return $this->redirect(['payment','obsp'=>1,'asp_id'=>base64_encode($model->id)]);
			}else{
				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=$model->user_id")->queryRow();					

				$this->sendMailtoAgent($serviceproviderdetails,$Appuserdetail,$is_reg_agent,$company_id);			
				$this->sendMailtoApplicant($serviceproviderdetails,$Appuserdetail,$activation_key,$is_reg_agent);
				Yii::app()->user->setFlash('success','The request has been sent to the '.$model['sp_type'].' successfully.');
				$this->redirect('/backoffice/investor/home/investorWalkthrough');	
			}
			
		}

	}	
 	$this->render('obsp_update',['model'=>$model]);
 }

 function actionPayment($asp_id){

 	$model = AgentServiceProvider::model()->findByPk(base64_decode($asp_id));

 	return $this->render('payment',['model'=>$model]);
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
		$verifystatus = $pstatus;
		$verified = 0 ;
		$currentDate = date('Y-m-d H:i:s');

		$model = AgentServiceProvider::model()->findByPk($processId);
 		
 		$model->action_date = date('Y-m-d H:i:s');
 		$uid = $model->user_id;
 		if($model->agent_user_id){
				$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
			}else{
				$serviceproviderdetails = $model;
			}
 			
     
    
	// echo"<pre>";print_r($res); die;
	if($verifystatus == 'Success' || $verifystatus == 'success' ){
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

			    $model->sp_status = 'N';
			    $randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;		
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));
			    if($model->save(false)){

			    Yii::app()->db->createCommand("INSERT INTO agent_service_provider_payment(asp_id, total_late_fee, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,pg_account,msg,fees_item,is_payment_verified,payment_code,created_on) VALUES ('$processId','$fee',1,'success','$tno','$name','$number','$email','$account','$msg','$comment',$verified,'$pcode','".date('Y-m-d H:i:s')."')")->execute(); 

			    Yii::app()->db->createCommand("INSERT INTO tbl_others_reverify_payment(process_id,modules,payment_status,transaction_number,payment_submit_by,created_at,remote_server,response_data) VALUES ('$processId','SPLF','$verifystatus','$tno',$uid,'$currentDate','$ipadd','errormsg' )")->execute();



 			 		$this->addlog($model->id, $model->sp_status, $model->user_id, 1, 'Payment Successful and verified'); 		
 				}
				// print_r($res); die; 
			}else{

				 $model->sp_status = 'N';
				 $randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;		
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));
			     $model->save(false);
				Yii::app()->db->createCommand("INSERT INTO agent_service_provider_payment(asp_id, total_late_fee, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,pg_account,msg,fees_item,is_payment_verified,payment_code,created_on) VALUES ('$processId','$fee',1,'$pstatus','$tno','$name','$number','$email','$account','$msg','$comment',0,'$pcode','".date('Y-m-d H:i:s')."')")->execute(); 
				$this->addlog($model->id, $model->sp_status, $model->user_id, 1, 'Payment Successful'); 
			}
          	
          	Yii::import('application.extensions.phpmailer.JPhpMailer');
				$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=$model->user_id")->queryRow();		

					if($model->agent_user_id){
						$is_reg_agent = 'Yes';
					}else{
						$is_reg_agent = 'No';
					}			

				$this->sendMailtoAgent($serviceproviderdetails,$Appuserdetail,$is_reg_agent,$model->company_id);			
				$this->sendMailtoApplicant($serviceproviderdetails,$Appuserdetail,$model->activation_key,$is_reg_agent);

            Yii::app()->user->setFlash('success','Payment successfully completed');
            echo $verifystatus;
        }else{

        		Yii::app()->db->createCommand("INSERT INTO agent_service_provider_payment(asp_id, total_late_fee, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,pg_account,msg,fees_item,is_payment_verified,payment_code,created_on) VALUES ('$processId','$fee',1,'$pstatus','$tno','$name','$number','$email','$account','$msg','$comment',0,'$pcode','".date('Y-m-d H:i:s')."')")->execute(); 
        		
				if($verifystatus=='failed'){	

					Yii::app()->user->setFlash('failed','Payment has failed. Please try again');
				}else{
					$model->sp_status = 'PI';
					$model->save(false);
					Yii::app()->user->setFlash('initiated','Payment has initiated');
				}
				$this->addlog($model->id, $model->sp_status, $model->user_id, 1, 'Payment'.$pstatus);
				echo $verifystatus;
        }
		
	} 

 function actionPaymentsave(){
 	if(isset($_POST['id'])){
 		$model = AgentServiceProvider::model()->findByPk($_POST['id']);
 		$model->sp_status = 'PI';
 		$model->action_date = date('Y-m-d H:i:s');
 		if($model->save()){
 			if($model->agent_user_id){
				$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
			}else{
				$serviceproviderdetails = $model;
			}

		 $this->addlog($model->id, $model->sp_status, $model->user_id, 1, 'Payment Initiated By Applicant');
 			/*Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by, created_role_id, sp_status, action_remark) VALUES ($model->user_id, $model->company_id,'".$serviceproviderdetails['email']."',$model->agent_user_id, '".date('Y-m-d H:i:s')."',$model->user_id,1,'".$model->sp_status."', 'Payment Initiated By Applicant')")->execute();*/
 			$recipet_no = time();

 			Yii::app()->db->createCommand("INSERT INTO agent_service_provider_payment (asp_id, total_late_fee, payment_mode, payment_status, recipet_no, created_on) VALUES ($model->id, $model->late_fee,2,'Pending', '$recipet_no','".date('Y-m-d H:i:s')."')")->execute();

 			$this->redirect('/backoffice/investor/serviceprovider/observiceprovider/obsp/1');	
 		}
 	}
 }


/*
* this action call from cashier account to take payment from counter
*/
 function actionPaymentdue(){
 	$data = Yii::app()->db->createCommand("SELECT a.*, c.company_name,c.reg_no, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name FROM agent_service_provider a
 		INNER JOIN bo_company_details c ON a.company_id=c.id
 		INNER JOIN sso_users u on a.user_id=u.user_id
 		INNER JOIN sso_profiles up on u.user_id=up.user_id
 	 where u.is_account_active='Y' AND sp_status='PI'")->queryAll();
 	return $this->render('latefee_summary',['data'=>$data]);
 }

 /*
*  this action call from BO user chasier dashboard offline paymnt mode
*/
 public function actionMakepayment($asp_id){

 	$model = AgentServiceProvider::model()->findByPk(base64_decode($asp_id));
 	$details = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_payment WHERE asp_id=$model->id AND payment_status='Pending'")->queryRow();

 	if(isset($_POST['asp_id']) && isset($_POST['type'])){
 		if($_POST['type']){
 			$model = AgentServiceProvider::model()->findByPk($_POST['asp_id']);
 			$pt = $_POST['type'];
 			$payment_offline_detail_no = isset($_POST['payment_offline_detail_no']) ? $_POST['payment_offline_detail_no'] : NULL;
 			$bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : NULL;
 			$bo_comment = $_POST['subject'];
 			$recipet_no = $_POST['chalan_no'];
 			$asp_id = $_POST['asp_id'];
 			$created_by = isset($_POST['payment_received_by']) ? $_POST['payment_received_by'] : NULL;
 			$model->sp_status = 'N';
 			$model->action_date = date('Y-m-d H:i:s');
 			$randnum=mt_rand(10000000, 99999999);			
			$model->activation_key = $randnum;		
			$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));

 			if($model->save()){
 			if($model->agent_user_id){
				$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
			}else{
				$serviceproviderdetails = $model;
			}

			$this->addlog($model->id, $model->sp_status, $created_by, 95, 'Payment Successful');

			/*Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by, created_role_id, sp_status, action_remark) VALUES ($model->user_id, $model->company_id,'".$serviceproviderdetails['email']."',$model->agent_user_id, '".date('Y-m-d H:i:s')."',$created_by,95,'PS', 'Payment Successful')")->execute();*/

			$this->addlog($model->id, $model->sp_status, $created_by, 95, 'Nominated');
 			/*Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by, created_role_id, sp_status, action_remark) VALUES ($model->user_id, $model->company_id,'".$serviceproviderdetails['email']."',$model->agent_user_id, '".date('Y-m-d H:i:s')."',$created_by,95,'".$model->sp_status."', 'Nominated')")->execute();*/
 			

 			Yii::app()->db->createCommand("UPDATE agent_service_provider_payment SET payment_status='Success', payment_type='$pt', reference_no='$payment_offline_detail_no', bank_name='$bank_name', bo_comment='$bo_comment', updated_on='".date('Y-m-d H:i:s')."' WHERE recipet_no='$recipet_no' AND asp_id=$asp_id")->execute();

 			Yii::import('application.extensions.phpmailer.JPhpMailer');
				$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=$model->user_id")->queryRow();		

					if($model->agent_user_id){
						$is_reg_agent = 'Yes';
					}else{
						$is_reg_agent = 'No';
					}			

				$this->sendMailtoAgent($serviceproviderdetails,$Appuserdetail,$is_reg_agent,$model->company_id);			
				$this->sendMailtoApplicant($serviceproviderdetails,$Appuserdetail,$model->activation_key,$is_reg_agent);


 			return $this->redirect('/backoffice/investor/serviceprovider/paymentdue');
 		}
 			
 		}else{
 			return false;
 		}
 	}
 
 	return $this->render('latefee_details',['model'=>$model,'details'=>$details]);
 }


// for offline payment Applicant use this pdf
    public function actionPrintofflinefeeform($asp_id) {
      
       $model = AgentServiceProvider::model()->findByPk(base64_decode($asp_id));
       $payment_detail = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_payment WHERE payment_status='Pending' AND asp_id=" . $model->id)->queryRow();
       $app_details = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name, u.mobile_no, u.email
		FROM sso_users u 
 		INNER JOIN sso_profiles up on u.user_id=up.user_id
 	     where u.is_account_active='Y' AND u.user_id=".$model->user_id)->queryRow(); 

		$company = Yii::app()->db->createCommand("SELECT * FROM bo_company_details 
								where  id=$model->company_id")->queryRow();

        $content = $this->renderPartial('offlinefee_pdf', ['model' => $model,'payment_detail'=>$payment_detail, 'app_details'=>$app_details, 'company'=>$company],true);

        //print_r($content);die;
        //Reportformat::generatePdf($content, 'refund','');
        Refundutility::generatePdf($content, 'refund');
    }



 /*
*  this action return the list of CTSP or CR based on sp_type condition 24/02/2022
*/
function actionGetspusers($sp_type){
	    $spu = "<option value=''>Please Select Service Provider </options>";
      
 $sp_arr = Yii::app()->db->createCommand("SELECT CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name,  u.iuid, u.email, u.user_id
        FROM sso_users u INNER JOIN sso_profiles p ON p.user_id=u.user_id
        WHERE u.is_account_active='Y' AND u.user_type=2 AND sp_type='".$sp_type."'
        ")->queryAll();


	        
        foreach ($sp_arr as $k => $v) {
            $spu = "$spu<option value='$v[user_id]'>$v[full_name] $v[email]</options>";
        }
        echo "$spu";
        die;
}

 /*
*  this action return the list of User entity based on ec (entity condition) 10/03/2022
*/
function actionGetentity($ec){
	$spu = "<option value=''>Please Select Entity </options>";
    $user_id = $_SESSION['RESPONSE']['user_id'];

    if($ec=='EC'){
    	$comp_arr = Yii::app()->db->createCommand("SELECT * FROM bo_company_details  where user_id=$user_id AND service_id='8.0' AND company_type='EC' AND is_active=1")->queryAll();
    }else{
    	$comp_arr = BoCompanyDetails::GetAllentity($user_id);
    }
	
	$copany_alredy_assign = Yii::app()->db->createCommand("SELECT a.company_id, a.first_name, a.middle_name, a.surname,a.id ,a.email,c.reg_no,c.company_name, a.user_id, a.agent_user_id, a.sp_status
		FROM agent_service_provider a
		LEFT JOIN bo_company_details c ON c.id = a.company_id
		where a.sp_status IN ('N','O','PD','PI') AND a.user_id='".$user_id."' AND a.is_revoke=0")->queryAll();


  $get_all_company = [];
    if($copany_alredy_assign){
       foreach ($copany_alredy_assign as $c_id) {
         $get_all_company[] = $c_id['company_id'];
       }
    }

    $unassigen_entity  = [];
    foreach ($comp_arr as $key => $value) {
      if(in_array($value['id'], $get_all_company)){

      }else{
        $unassigen_entity[] = $value;
      }
    }


	        
        foreach ($unassigen_entity as $k => $v) {
            $spu = "$spu<option value='$v[id]'>$v[reg_no] $v[company_name]</options>";
        }
        echo "$spu";
        die;
}

/*
*  this action return the Incorporation date or post-incorporation date based on dof condition
* and also check if Entity not already assigned  28/02/2022
*/
function actionGetinorpostdate($dof){
	if($dof && isset($_POST['ue_id'])){
		$c_id = $_POST['ue_id'];
		$date = $post_date_hint= '';

		$previously_assign = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider where company_id=$c_id AND is_revoke=1 ORDER BY created_on DESC")->queryRow();
		if($previously_assign){
			$date = $previously_assign['action_date'] ? date('d-m-Y',strtotime($previously_assign['action_date'])) : ''; 
			$post_date_hint = 'Reassigned selected entity to another service provider';
		}else{
			$cd = Yii::app()->db->createCommand("SELECT * FROM bo_company_details where id=$c_id")->queryRow();
		
			if($dof=='Incorporation of the Company'){			
				$date = $cd['created_on'] ? date('d-m-Y',strtotime($cd['created_on'])) : '';
			}else{					
				$post_data = Yii::app()->db->createCommand("SELECT application_updated_date_time FROM bo_new_application_submission where service_id NOT IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0') AND entity_name='".$cd['reg_no']."' AND application_status='A' ORDER BY application_created_date ASC")->queryRow();
				if(isset($post_data['application_updated_date_time'])){
					$date = $post_data['application_updated_date_time'] ? date('d-m-Y',strtotime($post_data['application_updated_date_time'])) : '';				
				}else{
					$post_date_hint = 'Post-Incorporation service not availed. Above mentined date is for Incorporation of the Entity';
					$date = $cd['created_on'] ? date('d-m-Y',strtotime($cd['created_on'])) : ''; 
				}			
			}
		}

		
		if($date==''){
			echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Date not found'));
		}else{
				  $date1 = date_create(date('Y-m-d'));
                  $date2 = date_create(date('Y-m-d',strtotime($date)));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");

                  if($ad>28){
                  	$daysdiff = $ad-28;
                  	$late_fee = $daysdiff * 10;
                  	if($late_fee>3000){
                  		$late_fee = 3000;
                  	}
                  }else{
                  	$late_fee = 0;
                  }
			echo CJavaScript::jsonEncode(array('status'=>true,'date'=>$date,'post_date_hint'=>$post_date_hint,'late_fee'=>$late_fee));
		}		
	}else{
		echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Something went wrong'));
	}
}

public function actionCdlfc(){
	if(isset($_POST['sdate'])){
		  $date1 = date_create(date('Y-m-d'));
          $date2 = date_create(date('Y-m-d',strtotime($_POST['sdate'])));
          $diff  = date_diff($date1,$date2);
          $ad    = $diff->format("%a");
        
          if($ad>28){
          	$daysdiff = $ad-28;
          	$late_fee = $daysdiff * 10;
          	if($late_fee>3000){
          		$late_fee = 3000;
          	}
          }else{
          	$late_fee = 0;
          }
	echo CJavaScript::jsonEncode(array('status'=>true,'post_date_hint'=>NULL,'late_fee'=>$late_fee));
	}else{
		echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Something went wrong'));
	}
}





	public function actionSpdoc(){

		return $this->render('sp_doc');
	 
	}

	 public function actionRevokebyapplicant($sp_id){
    	if(isset($_POST['reason'])){
    		$r = $_POST['reason'];
    		$cuid = $_SESSION['RESPONSE']['user_id'];
    		$cdate = date('Y-m-d H:i:s');
    		Yii::app()->db->createCommand("UPDATE agent_service_provider SET is_revoke=1, revoke_reason='".$r."', revoke_by=$cuid, sp_status='R', action_date='".$cdate."' WHERE id= $sp_id")->execute();

    		// check and also removed sub users also
    		Yii::app()->db->createCommand("UPDATE agent_service_provider_sub_user_mapping SET is_revoke=1, revoke_reason='Directly removed by applicant', revoke_by=$cuid, sp_status='R', action_date='".$cdate."', revoke_by_name='Applicant'  WHERE asp_id= $sp_id")->execute();

    		$details =  Yii::app()->db->createCommand("SELECT a.*, c.company_name FROM agent_service_provider a 
            	INNER JOIN bo_company_details c ON a.company_id=c.id
             where a.id=$sp_id")->queryRow();

            $applicant = Yii::app()->db->createCommand("SELECT u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.is_account_active='Y' AND u.user_id=".$details['user_id'])->queryRow();

	        $agent = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=".$details['agent_user_id'])->queryRow();

        // insert in log table 
	        $this->addlog($details['id'], $details['sp_status'], $cuid, 1, 'Removed');


	        // deactivated all sub users which is mapped with ctsp/cr
    		$allsubusers = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_sub_user_mapping  WHERE asp_id= $sp_id")->queryAll();    		
    		foreach ($allsubusers as $key => $value) {
    			 $this->addlog($sp_id, 'R', $cuid, 1, 'Directly removed by applicant',$value['id']);
    			Yii::app()->db->createCommand("UPDATE sso_users SET is_account_active='N' WHERE email= '".$value['email']."'")->execute();
    		}
         /* Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by, created_role_id, sp_status, action_remark) VALUES ('".$details['user_id']."', '".$details['company_id']."','".$agent['email']."','".$details['agent_user_id']."', '".date('Y-m-d H:i:s')."',$cuid,1,'R', 'Removed')")->execute();*/

	Yii::import('application.extensions.phpmailer.JPhpMailer');
    		$this->sendMailtoAgent_revoke($details, $applicant, $details['company_name'], $agent);     
            $this->sendMailtoApplicant_revoke($details, $applicant, $details['company_name'], $agent);
          //  $this->sendMailtoCaipo_revoke($details, $applicant, $company_name, $agent);
            Yii::app()->user->setFlash('success', ($agent['first_name'].' '.$agent['last_name'].' '.$agent['surname']).' has been removed successfully.');
    		echo CJavaScript::jsonEncode(array('status'=>true));
    	}else{
    		echo CJavaScript::jsonEncode(array('status'=>false));
    	}
    }

  

    /* this action is for uploading document by applicant while onboarding of CTSP By Aamir*/
public function actionAppfileupload(){
	header('Content-Type: application/json'); // set json response headers
       $user_id = $_SESSION['RESPONSE']['user_id'];  
       if($user_id){
       		 $targetDir = '/var/www/html/backoffice/protected/uploads';			
				    if (!file_exists($targetDir)) {
				        @mkdir($targetDir);			      
				    }
				$targetDir = '/var/www/html/backoffice/protected/uploads/applicantdoc';			
				    if (!file_exists($targetDir)) {
				        @mkdir($targetDir);			      
				    }

				$targetDir = '/var/www/html/backoffice/protected/uploads/applicantdoc/'.$user_id;			
				    if (!file_exists($targetDir)) {
				        @mkdir($targetDir);			      
				    }

			 $fileBlob = 'fileBlob'; // the parameter name that stores the file blob
                   
		    if (isset($_FILES[$fileBlob]) && isset($_POST['uploadToken'])) {
		    
		    		    $file = $_FILES[$fileBlob]['tmp_name'];  
				        $fileId = $_POST['fileId'];        
				     
				        $targetFile = $targetDir.'/'.$fileId;  
				     
				        if(move_uploaded_file($file, $targetFile)) {
				        	$file_path = '/backoffice/protected/uploads/applicantdoc/'.$user_id.'/'.$fileId;
				        	$created_on = date('Y-m-d H:i:s');
				        	Yii::app()->db->createCommand('INSERT INTO agent_service_provider_file_temp (user_id, file_path, created_on, doc_no) VALUES ("'.$user_id.'", "'.$file_path.'", "'.$created_on.'", "'.$_POST['doc_no'].'")')->execute();
				             echo json_encode(array('status'=>true));
				        } else {
				            echo json_encode(array('status'=>false));
				        }
		    
		       
		    }else{
		    	 echo json_encode(array('status'=>false,'msg'=>'something was missing'));
		    }
       }
        exit();
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

public function actionGetspdetails($sp_id){
		$details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name ,p.address,p.address2,p.city_name,p.country_name,p.gender,p.mobile_number,p.pin_code,p.state_name,u.sp_type,u.lic_no,u.entity_name
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.is_account_active='Y' AND u.user_id=$sp_id")->queryRow();
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

public function actionValidatemail(){
		if(isset($_POST['email'])){
			$cm = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y' AND email='".$_POST['email']."'")->queryRow();
			if($cm){
				echo CJavaScript::jsonEncode(array('status'=>false));
			}else{
				echo CJavaScript::jsonEncode(array('status'=>true));
			}
			
		}
	}


/*
* This action call from service provider dashboard at time of selecting the entity from dropdown
*/
 public function actionCheckactivationcode($asp_id){
           $check_key = Yii::app()->db->createCommand("SELECT *
            from agent_service_provider where id=$asp_id")->queryRow(); 
          
           if($check_key['activation_key']){
             echo CJavaScript::jsonEncode(array('status'=>true,'asp_id'=>$asp_id));    
           }else{   
             $_SESSION['individualuser_id'] = $check_key['user_id'];   
             $_SESSION['individualuser_company_id'] = $check_key['company_id'];  
             $_SESSION['asp_id'] = $check_key['id'];
             
             $applicant = Yii::app()->db->createCommand("SELECT u.iuid, u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.is_account_active='Y' AND u.user_id=".$check_key['user_id'])->queryRow();
//set individual user detail in session  

   $_SESSION['RESPONSE']['email'] = $applicant['email'];
   $_SESSION['RESPONSE']['iuid'] = $applicant['iuid'];
   $_SESSION['RESPONSE']['profile_id'] = $applicant['profile_id'];
   $_SESSION['RESPONSE']['user_id'] = $applicant['user_id'];
   $_SESSION['RESPONSE']['first_name'] = $applicant['first_name'];
   $_SESSION['RESPONSE']['last_name'] = $applicant['last_name'];
   $_SESSION['RESPONSE']['surname'] = $applicant['surname'];
   $_SESSION['RESPONSE']['gender'] = $applicant['gender'];
   $_SESSION['RESPONSE']['date_of_birth'] = $applicant['date_of_birth'];
   $_SESSION['RESPONSE']['mobile_number'] = $applicant['mobile_number'];
   $_SESSION['RESPONSE']['pan_card']= $applicant['pan_card'];
   $_SESSION['RESPONSE']['adhaar_number']= $applicant['adhaar_number'];
   $_SESSION['RESPONSE']['country_code']= $applicant['country_code'];
   $_SESSION['RESPONSE']['country_name']= $applicant['country_name'];
   $_SESSION['RESPONSE']['state_name']= $applicant['state_name'];
   $_SESSION['RESPONSE']['city_name']= $applicant['city_name'];
   $_SESSION['RESPONSE']['distt_name']= $applicant['distt_name'];
   $_SESSION['RESPONSE']['pin_code']= $applicant['pin_code'];
   $_SESSION['RESPONSE']['address']= $applicant['address'];
   $_SESSION['RESPONSE']['address2']= $applicant['address2'];
   $_SESSION['RESPONSE']['telephone']= $applicant['telephone'];
   $_SESSION['RESPONSE']['nationality']= $applicant['nationality'];
   $_SESSION['RESPONSE']['documents']=  "";         
//End of set individual user detail in session
             echo CJavaScript::jsonEncode(array('status'=>false));
         }
}

/*
* This action call from Service Provider at the time of activation key enter and validate
*/
public function actionMatchActionvationkey(){
        $asp_id = $_GET['asp_id'];
        $key = $_GET['key'];

         $company = Yii::app()->db->createCommand("SELECT *
            from agent_service_provider where id=$asp_id AND activation_key = '".$key."' AND key_expired_on >= '".date('Y-m-d H:i:s')."' ")->queryRow();
         if($company){
                $cdate = date('Y-m-d H:i:s');
            $cuid = $_SESSION['RESPONSE']['agent_user_id'];

            Yii::app()->db->createCommand("UPDATE agent_service_provider SET activation_key=NULL, agent_user_id=$cuid, sp_status='O', action_date='".$cdate."' WHERE id= $asp_id")->execute();


            $details =  Yii::app()->db->createCommand("SELECT a.*, c.company_name FROM agent_service_provider a 
            	INNER JOIN bo_company_details c ON a.company_id=c.id
             where a.id=$asp_id")->queryRow();

            $applicant = Yii::app()->db->createCommand("SELECT u.iuid, u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.is_account_active='Y' AND u.user_id=".$details['user_id'])->queryRow();

       
       

        	$agent = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=".$details['agent_user_id'])->queryRow();

//insert in log table 
        	$this->addlog($details['id'], $details['sp_status'], $cuid, 2, 'Onboarded');
            /*Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (user_id, entity_id, agent_email_id, agent_user_id, created_on, created_by, created_role_id, sp_status, action_remark) VALUES ('".$details['user_id']."', '".$details['company_id']."','".$agent['email']."','".$details['agent_user_id']."', '".date('Y-m-d H:i:s')."',$cuid,2,'O', 'Onboarded')")->execute();*/

			Yii::import('application.extensions.phpmailer.JPhpMailer');
            $this->sendMailtoAgent_onboard($details, $applicant, $details['company_name'], $agent);      
            $this->sendMailtoApplicant_onboard($details, $applicant, $details['company_name'], $agent);
           // $this->sendMailtoCaipo_onboard($details, $applicant, $company_name, $agent);

            $_SESSION['individualuser_id'] = $company['user_id'];
            $_SESSION['individualuser_company_id'] = $company['company_id'];
            $_SESSION['asp_id'] = $company['id'];

//set individual user detail in session  

   $_SESSION['RESPONSE']['email'] = $applicant['email'];
   $_SESSION['RESPONSE']['iuid'] = $applicant['iuid'];
   $_SESSION['RESPONSE']['profile_id'] = $applicant['profile_id'];
   $_SESSION['RESPONSE']['user_id'] = $applicant['user_id'];
   $_SESSION['RESPONSE']['first_name'] = $applicant['first_name'];
   $_SESSION['RESPONSE']['last_name'] = $applicant['last_name'];
   $_SESSION['RESPONSE']['surname'] = $applicant['surname'];
   $_SESSION['RESPONSE']['gender'] = $applicant['gender'];
   $_SESSION['RESPONSE']['date_of_birth'] = $applicant['date_of_birth'];
   $_SESSION['RESPONSE']['mobile_number'] = $applicant['mobile_number'];
   $_SESSION['RESPONSE']['pan_card']= $applicant['pan_card'];
   $_SESSION['RESPONSE']['adhaar_number']= $applicant['adhaar_number'];
   $_SESSION['RESPONSE']['country_code']= $applicant['country_code'];
   $_SESSION['RESPONSE']['country_name']= $applicant['country_name'];
   $_SESSION['RESPONSE']['state_name']= $applicant['state_name'];
   $_SESSION['RESPONSE']['city_name']= $applicant['city_name'];
   $_SESSION['RESPONSE']['distt_name']= $applicant['distt_name'];
   $_SESSION['RESPONSE']['pin_code']= $applicant['pin_code'];
   $_SESSION['RESPONSE']['address']= $applicant['address'];
   $_SESSION['RESPONSE']['address2']= $applicant['address2'];
   $_SESSION['RESPONSE']['telephone']= $applicant['telephone'];
   $_SESSION['RESPONSE']['nationality']= $applicant['nationality'];
   $_SESSION['RESPONSE']['documents']=  "";         
//End of set individual user detail in session

            echo CJavaScript::jsonEncode(array('status'=>true));
         }else{
            echo CJavaScript::jsonEncode(array('status'=>false));
         }     
}

/*
* Aspr :- after service provider remove page 
*/
public function actionAspr(){
	return $this->render('aspr');
}


	////------------ Mail Send Function ---------------///

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

			$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been nominated by <strong>".$app_username."</strong> to act as a ".$model['sp_type']." on CAIPO. <br><br>Please complete your registration through this <a href='".$regi_link."'> CAIPO registration link </a>. If you already registered as a ".$model['sp_type']." on same portal then go to direct login<br><br>Please contact <strong>".$app_username."</strong> to get the Activation Key to succesfully onboard on the portal. Please enter the Activation Key after choosing the assigned Entity from the list of assigned Entities. Please note, the activation key will be valid only for 7 days. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		}else{

			/*$regi_link = str_replace('backoffice', BASE_URL'sso/account/signin', Yii::app()->request->getBaseUrl(true));*/
			$regi_link = "protected.caipo.gov.bb/sso/account/signin";
			
			$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been nominated by <strong>".$app_username."</strong> to act as a ".$model['sp_type']." on CAIPO. Click on this <a href='".$regi_link."'> CAIPO registration link </a> go to direct login<br><br>Please contact <strong>".$app_username."</strong> to get the Activation Key to succesfully onboard on the portal. Please enter the Activation Key after choosing the assigned Entity from the list of assigned Entities. Please note, the activation key will be valid only for 7 days. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
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

		$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully nominated <strong>".$agent_username."</strong> as a ".$model['sp_type'].".<br><br>Give this activation key <strong>".$activation_key."</strong> to the ".$model['sp_type']." for activation. Please note, this activation key will be valid only for 7 days. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		
		 $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	   // this mail function call when mail sent to agent on onboard
    function sendMailtoAgent_revoke($details, $applicant, $company_name, $agent){
      
        $dear_name = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'];
    
        $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $agent['email'];
        $name = $dear_name;


        $app_username = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'].$company_name;
        $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$app_username."</strong> has remove you as a ".$sp_type." from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
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
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully removed <strong>".$agent_username."</strong> from the CAIPO Portal to act as a ".$sp_type.".  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
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
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$app_username."</strong> has removed <strong>".$agent_username."</strong> to act as a ".$sp_type." from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
    }

    // this mail function call when mail sent to agent on onboard
    function sendMailtoAgent_onboard($details, $applicant, $company_name, $agent){
       
        $dear_name = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'];

        $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $agent['email'];
        $name = $dear_name;

         $app_username = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'].$company_name;
          $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been succesfully onboarded to act as a  ".$sp_type." for <strong>".$app_username."</strong> on the CAIPO Portal. <br><br>This authority shall remain in force untill <strong>".$app_username."</strong> remove it. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
       
    }

    // this mail function call when mail sent to applicant on onboard
    function sendMailtoApplicant_onboard($details, $applicant, $company_name, $agent){
       

         $dear_name = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'];
   

        
    
        $entity_name = '';
        if($details['entity_name']){            
            $entity_name = ' / '.$details['entity_name'];
        }
        
        $agent_username = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'].$entity_name;

          $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
       


        $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = $applicant['email'];
        $name = $dear_name;
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$agent_username."</strong> has succesfully onboarded on the CAIPO Portal as a ".$sp_type.". <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 

    }

     // this mail function call when mail sent to CAipo on onboard
    function sendMailtoCaipo_onboard($details, $applicant, $company_name, $agent){
 
         $dear_name = "CAIPO User";
          $entity_name = '';
        if($details['entity_name']){            
            $entity_name = ' / '.$details['entity_name'];
        }
        $agent_username = $agent['first_name'].' '.$agent['last_name'].' '.$agent['surname'].$entity_name;

          $app_username = $applicant['first_name'].' '.$applicant['last_name'].' '.$applicant['surname'].$company_name;
            $sp_type = $agent['sp_type'] ? $agent['sp_type'] : 'CTSP / CR';
       

        $subject = "CAIPO-Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)";
        $to = 'caipodummy@gmail.com';
        $name = $dear_name;
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$agent_username."</strong> has succesfully onboarded on the CAIPO Portal to act as a ".$sp_type." on behalf of <strong>".$app_username."</strong> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
      
    }

    function addlog($asp_id, $sp_status, $created_by, $created_by_role, $remark, $asp_sum_id=NULL){
       	Yii::app()->db->createCommand("INSERT INTO agent_service_provider_and_sub_user_log (asp_id, created_on, created_by, created_role_id, sp_status, action_remark, asp_sum_id) VALUES ($asp_id, '".date('Y-m-d H:i:s')."', $created_by, $created_by_role, '".$sp_status."', '".$remark."', '".$asp_sum_id."')")->execute();
    }


    // Sub users code //

    public function actionObsubusers(){

    	$model = new AgentServiceProviderSubUserMapping;
		if(isset($_POST['first_name'])){
			
			$model->action_type = $_POST['at_ch_box'];
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
			$model->asp_id = $_POST['asp_id'];
			$model->sub_user_id = NULL;				
			$model->sp_status = 'N';
			$model->created_on = $model->action_date = date('Y-m-d H:i:s');
			
			
			$randnum=mt_rand(10000000, 99999999);			
			$model->activation_key = $randnum;			
			$activation_key = $model->activation_key;
			$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));		

			if($model->save()){		
				// insert records in log table
			
				$this->addlog($model->asp_id, $model->sp_status, $_SESSION['RESPONSE']['agent_user_id'], 2, "Sub User Nominated",$model->id);
				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$SP_userdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=".$_SESSION['RESPONSE']['agent_user_id'])->queryRow();		

				$this->sendMailtoAgent_subusernominate($model,$SP_userdetail);	
				$this->sendMailtoSubuser_nominate($model,$SP_userdetail);
				Yii::app()->user->setFlash('success','The request has been sent to the '.$model['sp_type'].' successfully.');					
			}
		}		
    	$this->render('sub_user/obsu',['model'=>$model]);
    }

    // this mail function call when mail sent to agent on onboard
	function sendMailtoSubuser_nominate($model,$SP_userdetail){
		
		$dear_name = $model['first_name'].' '.$model['middle_name'].' '.$model['surname'];
		$subject = "CAIPO-Onboard Sub User";
        $to = $model['email'];
       

		 $comp = Yii::app()->db->createCommand("SELECT a.id, a.company_id, c.company_name, c.reg_no 
        FROM agent_service_provider a
        INNER JOIN bo_company_details c ON a.company_id=c.id
        WHERE a.id=$model->asp_id")->queryRow();

		
		$sp_username_entity = @$SP_userdetail['first_name'].' '.@$SP_userdetail['last_name'].' '.@$SP_userdetail['surname'].' / '.@$comp['company_name'];
		

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
					  'sp_type'=>$model->sp_type					 
					));

			$regi_link = str_replace('/backoffice', 'protected.caipo.gov.bb',$remain_lin);

			//$regi_link = "protected.caipo.gov.bb/".$remain_lin;

			$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been nominated by <strong>".$sp_username_entity."</strong> to act as a ".$model['sp_type']." on CAIPO. <br><br>Please complete your registration through this <a href='".$regi_link."'> CAIPO registration link </a>. <br><br>Please contact <strong>".$sp_username_entity."</strong> to get the Activation Key to succesfully onboard on the portal. Please enter the Activation Key after choosing the assigned Entity from the list of assigned Entities. Please note, the activation key will be valid only for 7 days. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);


	}

	// this mail function call when mail sent to applicant on onboard
	function sendMailtoAgent_subusernominate($model,$SP_userdetail){
		
		$subject = "CAIPO-Onboard Sub User";
        $to = @$SP_userdetail['email'];
        $dear_name = @$SP_userdetail['first_name'].' '.@$SP_userdetail['last_name'].' '.@$SP_userdetail['surname'];
     	
		$agent_username = $model['first_name'].' '.$model['middle_name'].' '.$model['surname'];

		$content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully nominated <strong>".$agent_username."</strong> as a ".$model['sp_type'].".<br><br>Give this activation key <strong>".$model->activation_key."</strong> to the ".$model['sp_type']." for activation. Please note, this activation key will be valid only for 7 days. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
			CAIPO";
		
		 $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	public function actionCheckactivationcode_subuser($asp_sum_id){
           $check_key = Yii::app()->db->createCommand("SELECT *
            from agent_service_provider_sub_user_mapping where id=$asp_sum_id")->queryRow(); 
          
           if($check_key['activation_key']){
             echo CJavaScript::jsonEncode(array('status'=>true,'asp_sum_id'=>$asp_sum_id));    
           }else{   
           	 $asp_details = Yii::app()->db->createCommand("SELECT *
            from agent_service_provider where id=".$check_key['asp_id'])->queryRow(); 

             $_SESSION['individualuser_id'] = $asp_details['user_id'];   
             $_SESSION['individualuser_company_id'] = $asp_details['company_id'];  
             $_SESSION['asp_id'] = $asp_details['id'];
             $_SESSION['asp_sum_id'] = $check_key['id'];
             $applicant = Yii::app()->db->createCommand("SELECT u.iuid, u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.is_account_active='Y' AND u.user_id=".$asp_details['user_id'])->queryRow();
			//set individual user detail in session  
			   $_SESSION['RESPONSE']['subuser_agent_user_id'] = $asp_details['agent_user_id'];  
			   $_SESSION['RESPONSE']['email'] = $applicant['email'];
			   $_SESSION['RESPONSE']['iuid'] = $applicant['iuid'];
			   $_SESSION['RESPONSE']['profile_id'] = $applicant['profile_id'];
			   $_SESSION['RESPONSE']['user_id'] = $applicant['user_id'];
			   $_SESSION['RESPONSE']['first_name'] = $applicant['first_name'];
			   $_SESSION['RESPONSE']['last_name'] = $applicant['last_name'];
			   $_SESSION['RESPONSE']['surname'] = $applicant['surname'];
			   $_SESSION['RESPONSE']['gender'] = $applicant['gender'];
			   $_SESSION['RESPONSE']['date_of_birth'] = $applicant['date_of_birth'];
			   $_SESSION['RESPONSE']['mobile_number'] = $applicant['mobile_number'];
			   $_SESSION['RESPONSE']['pan_card']= $applicant['pan_card'];
			   $_SESSION['RESPONSE']['adhaar_number']= $applicant['adhaar_number'];
			   $_SESSION['RESPONSE']['country_code']= $applicant['country_code'];
			   $_SESSION['RESPONSE']['country_name']= $applicant['country_name'];
			   $_SESSION['RESPONSE']['state_name']= $applicant['state_name'];
			   $_SESSION['RESPONSE']['city_name']= $applicant['city_name'];
			   $_SESSION['RESPONSE']['distt_name']= $applicant['distt_name'];
			   $_SESSION['RESPONSE']['pin_code']= $applicant['pin_code'];
			   $_SESSION['RESPONSE']['address']= $applicant['address'];
			   $_SESSION['RESPONSE']['address2']= $applicant['address2'];
			   $_SESSION['RESPONSE']['telephone']= $applicant['telephone'];
			   $_SESSION['RESPONSE']['nationality']= $applicant['nationality'];
			   $_SESSION['RESPONSE']['documents']=  "";         
			//End of set individual user detail in session
             echo CJavaScript::jsonEncode(array('status'=>false));
         }
}

/*
* This action call from Service Provider at the time of activation key enter and validate
*/
public function actionMatchActionvationkey_subuser(){
        $asp_sum_id = $_GET['asp_sum_id'];
        $key = $_GET['key'];

        $match_key = Yii::app()->db->createCommand("SELECT *
            from agent_service_provider_sub_user_mapping where id=$asp_sum_id AND activation_key = '".$key."' AND key_expired_on >= '".date('Y-m-d H:i:s')."' ")->queryRow(); 

        if($match_key){
        	
            $cdate = date('Y-m-d H:i:s');
            $cuid = $_SESSION['RESPONSE']['subuser_user_id'];

            Yii::app()->db->createCommand("UPDATE agent_service_provider_sub_user_mapping SET activation_key=NULL, sub_user_id=$cuid, sp_status='O', action_date='".$cdate."' WHERE id= $asp_sum_id")->execute();

            $details =  Yii::app()->db->createCommand("SELECT a.*, c.company_name FROM agent_service_provider a 
            	INNER JOIN bo_company_details c ON a.company_id=c.id
             where a.id=".$match_key['asp_id'])->queryRow();

           	$sub_user = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=$cuid")->queryRow();

        	$SP_userdetail = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=".$details['agent_user_id'])->queryRow();

			//insert in log table 
        	$this->addlog($match_key['asp_id'], 'O', $cuid, 3, 'Onboarded',$match_key['id']);

        	Yii::import('application.extensions.phpmailer.JPhpMailer');
            $this->sendMailtosubuser_onboard($details, $sub_user,  $SP_userdetail);      
            $this->sendMailtoAgent_subuseronboard($details, $sub_user, $SP_userdetail);
        
       		// $this->sendMailtoCaipo_onboard($details, $applicant, $company_name, $agent);

             $_SESSION['individualuser_id'] = $details['user_id'];   
             $_SESSION['individualuser_company_id'] = $details['company_id'];  
             $_SESSION['asp_id'] = $details['id'];
             $_SESSION['asp_sum_id'] = $match_key['id'];
             $applicant = Yii::app()->db->createCommand("SELECT u.iuid, u.email, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id
                where u.is_account_active='Y' AND u.user_id=".$details['user_id'])->queryRow();

			//set individual user detail in session  
               $_SESSION['RESPONSE']['subuser_agent_user_id'] = $details['agent_user_id'];
			   $_SESSION['RESPONSE']['email'] = $applicant['email'];
			   $_SESSION['RESPONSE']['iuid'] = $applicant['iuid'];
			   $_SESSION['RESPONSE']['profile_id'] = $applicant['profile_id'];
			   $_SESSION['RESPONSE']['user_id'] = $applicant['user_id'];
			   $_SESSION['RESPONSE']['first_name'] = $applicant['first_name'];
			   $_SESSION['RESPONSE']['last_name'] = $applicant['last_name'];
			   $_SESSION['RESPONSE']['surname'] = $applicant['surname'];
			   $_SESSION['RESPONSE']['gender'] = $applicant['gender'];
			   $_SESSION['RESPONSE']['date_of_birth'] = $applicant['date_of_birth'];
			   $_SESSION['RESPONSE']['mobile_number'] = $applicant['mobile_number'];
			   $_SESSION['RESPONSE']['pan_card']= $applicant['pan_card'];
			   $_SESSION['RESPONSE']['adhaar_number']= $applicant['adhaar_number'];
			   $_SESSION['RESPONSE']['country_code']= $applicant['country_code'];
			   $_SESSION['RESPONSE']['country_name']= $applicant['country_name'];
			   $_SESSION['RESPONSE']['state_name']= $applicant['state_name'];
			   $_SESSION['RESPONSE']['city_name']= $applicant['city_name'];
			   $_SESSION['RESPONSE']['distt_name']= $applicant['distt_name'];
			   $_SESSION['RESPONSE']['pin_code']= $applicant['pin_code'];
			   $_SESSION['RESPONSE']['address']= $applicant['address'];
			   $_SESSION['RESPONSE']['address2']= $applicant['address2'];
			   $_SESSION['RESPONSE']['telephone']= $applicant['telephone'];
			   $_SESSION['RESPONSE']['nationality']= $applicant['nationality'];
			   $_SESSION['RESPONSE']['documents']=  "";         
			//End of set individual user detail in session

            echo CJavaScript::jsonEncode(array('status'=>true));
           
         }else{
            echo CJavaScript::jsonEncode(array('status'=>false));
         }     
}

 // this mail function call when mail sent to sub user on onboard
    function sendMailtosubuser_onboard($details, $sub_user,  $SP_userdetail){
       
        $dear_name = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];

        $subject = "CAIPO-Onboard Sub User";
        $to = $sub_user['email'];
      
        $sp_username = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];

     
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have been succesfully onboarded to act as a  Sub User for <strong>".$sp_username."</strong> on the CAIPO Portal. <br><br>This authority shall remain in force untill <strong>".$sp_username."</strong> remove it. <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
       
    }

    // this mail function call when mail sent to SP on subuser onboard
    function sendMailtoAgent_subuseronboard($details, $sub_user,  $SP_userdetail){
        $dear_name = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];
   
        $subuser_username = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];

        $subject = "CAIPO-Onboard Sub User";
        $to = $SP_userdetail['email'];
     
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$subuser_username."</strong> has succesfully onboarded on the CAIPO Portal as a Sub User <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 

    }

     public function actionRevokebysp($asp_sum_id){
    	if(isset($_POST['reason'])){
    		$r = $_POST['reason'];
    		$cuid = $_SESSION['RESPONSE']['agent_user_id'];
    		$cdate = date('Y-m-d H:i:s');

    		// check and also removed sub users also
    		Yii::app()->db->createCommand("UPDATE agent_service_provider_sub_user_mapping SET is_revoke=1, revoke_reason='".$r."', revoke_by=$cuid, sp_status='R', action_date='".$cdate."', revoke_by_name='Representative'  WHERE id= $asp_sum_id")->execute();

    		// deactivated all sub users which is mapped with ctsp/cr
    		$subusers = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_sub_user_mapping  WHERE id = $asp_sum_id")->queryRow();    		
    	
    		$details =  Yii::app()->db->createCommand("SELECT a.*, c.company_name FROM agent_service_provider a 
            	INNER JOIN bo_company_details c ON a.company_id=c.id
             where a.id=".$subusers['asp_id'])->queryRow();

           	$sub_user = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=".$subusers['sub_user_id'])->queryRow();

        	$SP_userdetail = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=$cuid")->queryRow();



			//insert in log table 
        	$this->addlog($subusers['asp_id'], 'R', $cuid, 2, 'Removed',$subusers['id']);
       		Yii::app()->db->createCommand("UPDATE sso_users SET is_account_active='N' WHERE email= '".$subusers['email']."'")->execute();
			Yii::import('application.extensions.phpmailer.JPhpMailer');
    		$this->sendMailtosubuser_revoke($details, $sub_user, $SP_userdetail);     
            $this->sendMailtoAgent_subuserrevoke($details, $sub_user, $SP_userdetail);


          //  $this->sendMailtoCaipo_revoke($details, $applicant, $company_name, $agent);
            Yii::app()->user->setFlash('success', ($sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname']).' has been removed successfully.');
    		echo CJavaScript::jsonEncode(array('status'=>true));
    	}else{
    		echo CJavaScript::jsonEncode(array('status'=>false));
    	}
    }

     function sendMailtosubuser_revoke($details, $sub_user, $SP_userdetail){      
        $dear_name = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];    
        $subject = "CAIPO-Onboard Sub User";
        $to = $sub_user['email'];     

        $sp_username = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];
       
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$sp_username."</strong> has remove you as a Sub User from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);

    }

    // this mail function call when mail sent to applicant on onboard
    function sendMailtoAgent_subuserrevoke($details, $sub_user, $SP_userdetail){
        $dear_name = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];     
       
 		$subject = "CAIPO-Onboard Sub User";
        $to = $SP_userdetail['email'];
          
        $subuser_username = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];
      
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully removed <strong>".$subuser_username."</strong> from the CAIPO Portal to act as a Sub User.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
       $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
    }

    public function actionLogdata(){    

	    if(isset($_POST['asp_id'])){
	    	$asp_id = DefaultUtility::dataSenetize($_POST['asp_id']);
	    	$asp_data = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider WHERE id=$asp_id")->queryRow();
	    	if($_SESSION['RESPONSE']['user_id']==$asp_data['user_id']){
	    			$logdata = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_and_sub_user_log WHERE asp_id=$asp_id AND asp_sum_id=0 ORDER BY created_on DESC")->queryAll();
			    	if($logdata){
			    		$detail_table = "<table class='table table-responsive'><tr><th>Sr. No.</th><th class='text-center'>Action Status</th><th class='text-center'>Action Date</th></tr>";
			    		foreach ($logdata as $key => $value) {
			    			$detail_table.= "<tr><td>".($key+1)."</td><td class='text-center'>".$value['action_remark']."</td><td class='text-center'>".($value['created_on'] ? date('d-m-Y h:i a',strtotime($value['created_on'])) : "NA")."</td></tr>";
			    		}
			    		$detail_table.= "</table>";
			    		echo CJavaScript::jsonEncode(array('status'=>true,'msg'=>$detail_table));
			    	}else{
			    		echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'No data found'));
			    	}	
			    }else{
			    	echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>"Sorry! you can't access data"));
			    }
	    	}else{
	    		throw new Exception("Error Processing Request", 1);	    		
	    	}	    		
    		
    }

    public function actionSulogdata(){    	
    	if(isset($_POST['sum_asp_id'])){
    		$sum_asp_id = DefaultUtility::dataSenetize($_POST['sum_asp_id']);
    		$asp_data = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_sub_user_mapping sum 
    			INNER JOIN agent_service_provider asp ON sum.asp_id=asp.id 
    			WHERE sum.id=$sum_asp_id")->queryRow();
    		if($_SESSION['RESPONSE']['agent_user_id']==$asp_data['agent_user_id']){
	    	$logdata = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_and_sub_user_log WHERE asp_sum_id=$sum_asp_id ORDER BY created_on DESC")->queryAll();
	    	if($logdata){
	    		$detail_table = "<table class='table table-responsive'><tr><th>Sr. No.</th><th class='text-center'>Action Status</th><th class='text-center'>Action Date</th></tr>";
	    		foreach ($logdata as $key => $value) {
	    			$detail_table.= "<tr><td>".($key+1)."</td><td class='text-center'>".$value['action_remark']."</td><td class='text-center'>".($value['created_on'] ? date('d-m-Y h:i a',strtotime($value['created_on'])) : "NA")."</td></tr>";
	    		}
	    		$detail_table.= "</table>";
	    		echo CJavaScript::jsonEncode(array('status'=>true,'msg'=>$detail_table));
	    	}else{
	    		echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'No data found'));
	    	}	
	    	}else{
	    		echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>"Sorry! you can't access data"));
	    	}	
    	}else{
	    	throw new Exception("Error Processing Request", 1);    	
	    }	
    }

    public function actionResendmail($id,$for){
    	if($for=='ctspcr'){
    		$model = AgentServiceProvider::model()->findByPk($id);
    		    $randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;					
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));

				if($model->agent_user_id){
					$is_reg_agent = 'Yes';
					$serviceproviderdetails = Yii::app()->db->createCommand("SELECT u.email,u.sp_type, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
							from sso_users u 
							INNER JOIN sso_profiles p ON p.user_id=u.user_id
							where u.is_account_active='Y' AND u.user_id=$model->agent_user_id")->queryRow();
				}else{
					$is_reg_agent = 'No';
					$serviceproviderdetails = $model;
				}

				$Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=$model->user_id")->queryRow();

				$model->save();

    		$this->sendMailtoAgent($serviceproviderdetails,$Appuserdetail,$is_reg_agent,$model->company_id);			
			$this->sendMailtoApplicant($serviceproviderdetails,$Appuserdetail, $model->activation_key,$is_reg_agent);
    		echo CJavaScript::jsonEncode(array('status'=>true));
    	}else{
    		if($for=='subuser'){
    			 $model = AgentServiceProviderSubUserMapping::model()->findByPk($id);
    			 $randnum=mt_rand(10000000, 99999999);			
				$model->activation_key = $randnum;					
				$model->key_expired_on = date('Y-m-d H:i:s',strtotime('+7 day'));
				$model->save();
				$SP_userdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
					from sso_users u 
					INNER JOIN sso_profiles p ON p.user_id=u.user_id
					where u.is_account_active='Y' AND u.user_id=".$_SESSION['RESPONSE']['agent_user_id'])->queryRow();		

				$this->sendMailtoAgent_subusernominate($model,$SP_userdetail);	
				$this->sendMailtoSubuser_nominate($model,$SP_userdetail);

    			echo CJavaScript::jsonEncode(array('status'=>true));
    		}else{
    			echo CJavaScript::jsonEncode(array('status'=>false));
    		}
    	}
    }


    public function actionWithomireq($id,$for){
    	if($for=='ctspcr'){
    		$model = AgentServiceProvider::model()->findByPk($id);
    		$model->sp_status = 'NW';
    		$model->save();
    		$cuid = $_SESSION['RESPONSE']['user_id'];
    		$this->addlog($model->id, $model->sp_status, $cuid, 1, 'Nomination withdrawn');
    		echo CJavaScript::jsonEncode(array('status'=>true));
    	}else{
    		if($for=='subuser'){
    			$model = AgentServiceProviderSubUserMapping::model()->findByPk($id);
    			$model->sp_status = 'NW';
    			$model->save();
    			$cuid = $_SESSION['RESPONSE']['agent_user_id'];
    			$this->addlog($model->asp_id, $model->sp_status, $cuid, 2, 'Nomination withdrawn', $model->id);
    			echo CJavaScript::jsonEncode(array('status'=>true));
    		}else{
    			echo CJavaScript::jsonEncode(array('status'=>false));
    		}
    	}
    }

    public function actionChangesubuserstatus($sum_asp_id,$s){
    	$model = AgentServiceProviderSubUserMapping::model()->findByPk($sum_asp_id);
    	$cuid = $_SESSION['RESPONSE']['agent_user_id'];
    	$cdate = date('Y-m-d H:i:s');
    	if(isset($_POST)){
    		$for = '';
    		if($s=='d'){
    			$model->sp_status = 'DA';
    			$model->action_date = $cdate;
    			$model->save();
    			$remark = 'Sub user is Deactivated';
    			$for = 'Deactivated';
    		}

    		if($s=='a'){
    			$model->sp_status = 'O';
    			$model->action_date = $cdate;
    			$model->save();
    			$remark = 'Sub user is Activated and Onboarded';
    			$for = 'Activated';
    		}

    		$sub_user = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=".$model->sub_user_id)->queryRow();

        	$SP_userdetail = Yii::app()->db->createCommand("SELECT u.email, u.sp_type, p.* 
                FROM sso_users u INNER JOIN sso_profiles p on u.user_id=p.user_id where u.is_account_active='Y' AND u.user_id=$cuid")->queryRow();

	    	$this->addlog($model->asp_id, $model->sp_status, $cuid, 2, $remark, $model->id);
	    	$this->sendMailtosubuser_activate_deactivate($sub_user, $SP_userdetail, $for);
			$this->sendMailtoAgent_subuser_activate_deactivate($sub_user, $SP_userdetail, $for);
	    	echo CJavaScript::jsonEncode(array('status'=>true));
	    	//return $this->redirect('/backoffice/investor/serviceprovider/obsubusers/obsu/1');
    	}   	
    }

     function sendMailtosubuser_activate_deactivate($sub_user, $SP_userdetail, $for){      
        $dear_name = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];    
        $subject = "CAIPO-Onboard Sub User";
        $to = $sub_user['email'];     

        $sp_username = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];
       
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that <strong>".$sp_username."</strong> has ".$for." you as a Sub User from the CAIPO Portal.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);

    }

    // this mail function call when mail sent to applicant on onboard
    function sendMailtoAgent_subuser_activate_deactivate($sub_user, $SP_userdetail, $for){
        $dear_name = $SP_userdetail['first_name'].' '.$SP_userdetail['last_name'].' '.$SP_userdetail['surname'];     
       
 		$subject = "CAIPO-Onboard Sub User";
        $to = $SP_userdetail['email'];
          
        $subuser_username = $sub_user['first_name'].' '.$sub_user['last_name'].' '.$sub_user['surname'];
      
        $content= '<strong>Dear '.$dear_name.",<br><br></strong> This is to notify you that you have succesfully ".$for." <strong>".$subuser_username."</strong> from the CAIPO Portal to act as a Sub User.  <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>Regards,<br>
            CAIPO";
        
       $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data);
    }
}