<?php
class VpdController extends Controller
{
	public $user_id;
	public function init(){
		if(isset($_SESSION['RESPONSE']['user_type'])){
		 	switch ($_SESSION['RESPONSE']['user_type']) {
		 		case '1':
		 			$this->user_id = $_SESSION['RESPONSE']['user_id'];
		 			break;
		 		case '2':
		 			$this->user_id = $_SESSION['RESPONSE']['agent_user_id'];
		 			break;
		 		case '3':
		 			$this->user_id = $_SESSION['RESPONSE']['subuser_user_id'];
		 			break;
		 		
		 		default:
		 			throw new Exception("User does not exist. Please login again", 1);
		 			break;
		 	}
		 }else{
		 	if($_SESSION['role_id']){

		 	}else{
		 		throw new Exception("User does not exist. Please login again", 1);
		 		exit();
		 	}
		 }

	
	}

	public function actionDashboard(){

		 

		
 	$cart_count = Yii::app()->db->createCommand("SELECT 
    COUNT(CASE when doc_status='C' then id end) as cart_count, 
    COUNT(CASE when doc_status='PD' then id end) as pd_count
    FROM temp_vpd_doclist WHERE user_id= $this->user_id ")->queryRow();

	$doc_count = Yii::app()->db->createCommand("SELECT 
    COUNT(CASE when doc_status='P' then id end) as dp_count, 
    COUNT(CASE when doc_status='D' then id end) as d_count, 
    COUNT(CASE when doc_status in ('PD','PI') then id end) as pd_count
  
    FROM vpd_documents WHERE user_id= $this->user_id")->queryRow();

		$records = Yii::app()->db->createCommand("SELECT vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
            (SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
            vpd.created_on 
            FROM vpd_documents vpd          
            INNER JOIN bo_information_wizard_service_parameters bosp
                  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

             INNER JOIN bo_new_application_submission a
                  ON vpd.srn_no=a.submission_id
             INNER JOIN bo_information_wizard_service_parameters bosp1
                  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

            WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id=$this->user_id
        Order by id DESC")->queryAll();

		$this->render('dashboard',['cart_count'=>$cart_count,'doc_count'=>$doc_count,'records'=>$records]);
	}
	public function actionCart()
	{
		$user_id = $this->user_id;
		/*$cart_records = Yii::app()->db->createCommand("SELECT * FROM temp_vpd_doclist WHERE user_id=$user_id")->queryAll();*/

		$cart_records =  Yii::app()->db->createCommand("SELECT t.id, t.doc_name, t.entity_reg_no, t.entity_service_id, t.doc_status , bosp.core_service_name, a.application_updated_date_time, (SELECT company_name FROM bo_company_details c WHERE c.service_id=t.entity_service_id AND c.reg_no=t.entity_reg_no) as company_name
				  FROM temp_vpd_doclist t
				  INNER JOIN bo_new_application_submission a
				  ON t.srn_no=a.submission_id
				  INNER JOIN bo_information_wizard_service_parameters bosp
				  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
				  WHERE bosp.is_active='Y' AND t.user_id=$user_id
				  order BY t.id ASC")->queryAll();

		$this->render('cart',['cart_records'=>$cart_records]);
	}

	public function actionCheckout(){
		if(isset($_POST['t_vpd'])){
			$connection = Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{

			   foreach ($_POST['t_vpd'] as $key => $val) {
			/*	$get_temp_vpd = Yii::app()->db->createCommand("SELECT * FROM temp_vpd_doclist WHERE id = $val")->queryRow();*/

				//if($get_temp_vpd){
					$up_sql = "UPDATE temp_vpd_doclist SET doc_status='PD' WHERE id=$val";
					$connection->createCommand($up_sql)->execute();
					/*$insert_sql ="INSERT INTO vpd_documents (entity_reg_no, entity_service_id, srn_no, doc_name, user_id, created_on, doc_status) VALUES ('".$get_temp_vpd['entity_reg_no']."', '".$get_temp_vpd['entity_service_id']."', '".$get_temp_vpd['srn_no']."', '".$get_temp_vpd['doc_name']."', '".$get_temp_vpd['user_id']."', '".date('Y-m-d H:i:s')."', 'PD')";

					$delete_sql = "DELETE FROM temp_vpd_doclist WHERE id=$val";
					$connection->createCommand($insert_sql)->execute();
			   		$connection->createCommand($delete_sql)->execute();*/
				
				//}
			}
 
			 
			   $transaction->commit();
			}
			catch(Exception $e)
			{
			   $transaction->rollback();
			}
        	return $this->redirect(['payment','t_vpd'=>base64_encode(implode(',', $_POST['t_vpd']))]);
						
		}		
	}

	function actionPayment($t_vpd){

	$user_id = $this->user_id;
	$vpdt_ids = base64_decode($t_vpd);	
 	$model = Yii::app()->db->createCommand("SELECT vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id,  vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
			vpd.created_on 
			FROM temp_vpd_doclist vpd			
			INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

			 INNER JOIN bo_new_application_submission a
				  ON vpd.srn_no=a.submission_id
			 INNER JOIN bo_information_wizard_service_parameters bosp1
				  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

			WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id=$user_id AND doc_status='PD' AND vpd.id IN ($vpdt_ids) order BY vpd.id ASC
			
				  ")->queryAll();

 	return $this->render('payment',['model'=>$model,'user_id'=>$user_id,'t_vpd'=>$t_vpd]);
 }

 function actionPaymentsave(){
 	if(isset($_POST['vpd_id'])){ 

 		$connection = Yii::app()->db;
		$transaction=$connection->beginTransaction();
			
		try
		{
		   foreach ($_POST['vpd_id'] as $key => $val) {
		   	
			$get_temp_vpd = Yii::app()->db->createCommand("SELECT * FROM temp_vpd_doclist WHERE id = $val")->queryRow();
			
			if($get_temp_vpd){	
			$recipet_no = $val.time();	
			$exp_dttm = date('Y-m-d H:i:s', strtotime('+7 days'));

			$delete_sql = "DELETE FROM temp_vpd_doclist WHERE id=$val";

			$model = new VpdDocuments;
			$model->entity_reg_no = $get_temp_vpd['entity_reg_no'];
			$model->entity_service_id = $get_temp_vpd['entity_service_id'];
			$model->srn_no = $get_temp_vpd['srn_no'];
			$model->doc_name = $get_temp_vpd['doc_name'];
			$model->user_id = $get_temp_vpd['user_id'];
			$model->created_on = date('Y-m-d H:i:s');
			$model->doc_status = 'PI';
			$model->expired_on = $exp_dttm ;
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
		

		
			$insert_pay_sql = "INSERT INTO vpd_payment (vpd_id, total_fee, payment_mode, payment_status, recipet_no, created_on) VALUES ($model->id, 5, 2,'Pending', '$recipet_no','".date('Y-m-d H:i:s')."')";
		
			$connection->createCommand($delete_sql)->execute();
			$connection->createCommand($insert_pay_sql)->execute();
			
			}
		}

		   //.... other SQL executions
		   $transaction->commit();
		}
		catch(Exception $e)
		{
		   $transaction->rollback();
		}

		$this->redirect('/backoffice/investor/home/investorWalkthrough');	
 		
 	}
 } 


	public function actionDocuments()
	{
		$user_id = $this->user_id;

		$model = Yii::app()->db->createCommand("SELECT vpd.entity_reg_no, vpd.entity_service_id,
			bosp.core_service_name,
			COUNT(CASE when vpd.doc_status IN ('P','D','E') then vpd.id end) as paid_docs,
			COUNT(CASE when vpd.doc_status IN ('D') then vpd.id end) as downloades_docs,
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
			vpd.created_on 
		FROM vpd_documents vpd
		INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
		 WHERE bosp.is_active='Y' AND vpd.user_id=$user_id GROUP BY vpd.entity_reg_no, vpd.entity_service_id order by vpd.created_on DESC")->queryAll();

		$this->render('documents',['model'=>$model]);
	}

	public function actionDocuments1($service_id,$reg_no)
	{
		$reg_no = base64_decode($reg_no);
		$service_id = base64_decode($service_id);
		$user_id = $this->user_id;

		$model = Yii::app()->db->createCommand("SELECT vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
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

			WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id=$user_id AND vpd.entity_reg_no = '".$reg_no."' AND vpd.entity_service_id = '".$service_id."'
		order by vpd.created_on DESC")->queryAll();

		Yii::app()->db->createCommand("UPDATE vpd_documents SET doc_status='E', updated_on='".date('Y-m-d H:i:s')."' WHERE user_id = $user_id AND doc_status IN ('P') AND expired_on < NOW()")->execute();

	  $this->render('documents2',['model'=>$model]);
	}

	public function actionVpd()
	{
		$records = NULL;
		if(isset($_POST['entity_type'])){
			$entity_type = $_POST['entity_type'];
			$company_name = $_POST['company_name'];
			$company_reg_no = $_POST['company_reg_no'];
			$cofo = $_POST['cofo'];
			if($cofo=='barbados'){
				$state_parish_sel = isset($_POST['state_parish_sel']) ? $_POST['state_parish_sel'] : NULL;
				$state_parish_txt = NULL;
			}else{
				$state_parish_sel = NULL;
				$state_parish_txt = $_POST['state_parish_txt'];
			}

			switch ($entity_type) {
				case 'Company':
					$service_id_in = '(4.0, 5.0, 8.0)';
					break;
				case 'Society':
					$service_id_in = '(9.0)';
					break;
				case 'Charity':
					$service_id_in = '(6.0, 7.0)';
					break;
				case 'LLP':
					$service_id_in = '(10.0)';
					break;
				case 'Business Name Registration':
					$service_id_in = '(2.0)';
					break;
				default:
					$service_id_in = NULL;
					break;
			}

			if($service_id_in){
				if($cofo=='barbados'){
					if($entity_type=='Business Name Registration'){
						$country_con = $state_parish_con = '';
					}else{
						$country_con = 'AND country="barbados"';
						if($state_parish_sel){
							$state_parish_con = 'AND state_parish_id='.$state_parish_sel;
						}else{
							$state_parish_con = '';
						}
					}					
				}else{
					$country_con = 'AND country!="barbados"';
					if($state_parish_txt){
						$state_parish_con = 'AND state_parish LIKE "%'.$state_parish_txt.'%" ';
					}else{
						$state_parish_con = '';
					}
				}

			 $state_parish_txt ;

				if($company_name){
					$company_name_con = 'AND company_name LIKE "%'.$company_name.'%" ';
				}else{
					$company_name_con = '';
				}

				if($company_reg_no){
					$company_reg_no_con = 'AND reg_no='.$company_reg_no;
				}else{
					$company_reg_no_con = '';
				}
				

				$records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE service_id IN $service_id_in $country_con $company_name_con $state_parish_con $company_reg_no_con")->queryAll();

			}

			$records_search = true;
		}else{
			$entity_type = 'Company';
			$cofo = 'barbados';
			$company_name = $company_reg_no = $state_parish_sel = $state_parish_txt = NULL;
			$records_search = false;
		}

		
		$this->render('vpd',['entity_type'=>$entity_type,'company_name'=>$company_name,'company_reg_no'=>$company_reg_no,'cofo'=>$cofo,'state_parish_sel'=>$state_parish_sel,'state_parish_txt'=>$state_parish_txt,'records'=>$records,'records_search'=>$records_search]);
	}

	public function actionVpd1($service_id, $reg_no){
		$reg_no = base64_decode($reg_no);
		$service_id = base64_decode($service_id);
		$entity_records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no = '".$reg_no."' AND service_id='".$service_id."'")->queryRow();


		if(isset($_POST['service_category_sel']) && isset($_POST['year_sel'])){
			$service_category_sel = $_POST['service_category_sel'];
			$year_sel = $_POST['year_sel'];	

			switch ($_POST['service_category_sel']) {
				case '1':
					 $ser_con = "AND a.service_id='2.0'";
					break;
				case '2':
					 $ser_con = "AND a.service_id IN ('4.0','5.0','6.0','7.0','8.0','9.0','10.0')";
					break;
				case '3':
					 $ser_con = "AND a.service_id IN ('19.0','20.0','21.0','22.0','23.0','24.0','25.0','33.0')";
					break;
				case '4':
					 $ser_con = "AND a.service_id IN ('37.0','38.0')";
					break;
				case '5':
					 $ser_con = "AND a.service_id IN ('39.0','40.0','41.0','42.0','43.0','44.0')";
					break;
				case '6':
					 $ser_con = "AND a.service_id IN ('11.0','12.0','13.0','14.0','15.0','16.0','17.0','18.0','26.0','27.0','28.0','29.0','30.0','31.0','32.0','34.0','35.0','36.0')";
					break;
				default:
					$ser_con = "";
					break;
			}	


			if($_POST['service_category_sel']==1 || $_POST['service_category_sel']==2){
				$subID = $entity_records['srn_no'];
				$submissiondaterecord =  Yii::app()->db->createCommand("SELECT a.submission_id, a.service_id, a.application_updated_date_time, bosp.is_certificate, bosp.core_service_name
				  FROM bo_new_application_submission a
				  INNER JOIN bo_information_wizard_service_parameters bosp
				  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

				  where bosp.is_active='Y' AND a.submission_id = $subID and a.application_status='A' AND year(a.application_updated_date_time)=$year_sel $ser_con order BY a.application_updated_date_time ASC")->queryAll();
			}else{
				$submissiondaterecord =  Yii::app()->db->createCommand("SELECT a.submission_id, a.service_id, a.application_updated_date_time, bosp.is_certificate, bosp.core_service_name
				  FROM bo_new_application_submission a
				  INNER JOIN bo_information_wizard_service_parameters bosp
				  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

				  where bosp.is_active='Y' AND a.application_status='A' AND year(a.application_updated_date_time)=$year_sel  AND a.entity_name = '".$reg_no."' $ser_con
				   order BY a.application_updated_date_time ASC")->queryAll();
			}
			
			/*$submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A' AND year(created)=$year_sel $ser_con order BY id DESC")->queryRow();*/	
			$records_search = true;	
		}else{
			$records_search = false;
			$submissiondaterecord = $service_category_sel = $year_sel = NULL;
		}

		$this->render('vpd1',['service_id'=>$service_id,'reg_no'=>$reg_no,'year_sel'=>$year_sel,'service_category_sel'=>$service_category_sel,'entity_records'=>$entity_records,'submissiondaterecord'=>$submissiondaterecord,'records_search'=>$records_search]);

	}

	public function actionVpdaddtocart(){
		if(isset($_POST['srn']) && isset($_POST['sdoc']) && isset($this->user_id)){
			$user_id = $this->user_id;
				$token=md5(time()."-".rand(1,999999));	
				foreach ($_POST['srn'] as $k => $v) {
					if(isset($_POST['sdoc'][$k])){
						Yii::app()->db->createCommand("INSERT INTO temp_vpd_doclist (entity_reg_no, entity_service_id, srn_no, doc_name, user_id, created_on) VALUES ('".$_POST['reg_no'][$k]."', '".$_POST['ser_id'][$k]."', '".$v."', '".$_POST['sdoc'][$k]."', '".$user_id."', '".date('Y-m-d H:i:s')."')")->execute();
					}
				}

			return $this->redirect('/backoffice/investor/vpd/cart');
			
			
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
       

	    $content = $this->renderPartial('offlinefee_pdf', ['model' => $model,'payment_detail'=>$payment_detail, 'app_details'=>$app_details],true);
	    
        //print_r($content);die;
        //Reportformat::generatePdf($content, 'refund','');
        Refundutility::generatePdf($content, 'refund');
        exit;
 }

 /*
* this action call from cashier account to take payment from counter
*/
 public function actionPaymentdue(){

 	$data = Yii::app()->db->createCommand("SELECT vpd.user_id, vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
			a.print_app_call_back_url, pay.payment_status, pay.id as p_id,
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
			vpd.created_on,
			CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name, u.mobile_no, u.email, pay.total_fee, pay.created_on

			FROM vpd_documents vpd			
			INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

			 INNER JOIN bo_new_application_submission a
				  ON vpd.srn_no=a.submission_id
			 INNER JOIN bo_information_wizard_service_parameters bosp1
				  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

			INNER JOIN vpd_payment pay ON pay.vpd_id = vpd.id
			INNER JOIN sso_users u on u.user_id=vpd.user_id	 
 		    INNER JOIN sso_profiles up on u.user_id=up.user_id	  

			WHERE bosp.is_active='Y' AND bosp1.is_active='Y'
			ORDER BY pay.created_on DESC

		")->queryAll();

 	

 	return $this->render('docfee_summary',['data'=>$data]);
 }

  public function actionMakepayment($vpd_id){
	$vpd_id = base64_decode($vpd_id);
 	$model = Yii::app()->db->createCommand("SELECT vpd.user_id, vpd.id, vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,
			a.print_app_call_back_url,
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,
			vpd.created_on,
			CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name, u.mobile_no, u.email, pay.total_fee, pay.created_on, pay.recipet_no

			FROM vpd_documents vpd			
			INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

			 INNER JOIN bo_new_application_submission a
				  ON vpd.srn_no=a.submission_id
			 INNER JOIN bo_information_wizard_service_parameters bosp1
				  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

			INNER JOIN vpd_payment pay ON pay.vpd_id=vpd.id
			INNER JOIN sso_users u on u.user_id=vpd.user_id	 
 		    INNER JOIN sso_profiles up on u.user_id=up.user_id	  

			WHERE vpd.id=$vpd_id AND bosp.is_active='Y' AND bosp1.is_active='Y' 
		")->queryRow();

 	if(isset($_POST['vpd_id']) && isset($_POST['type'])){
 		if($_POST['type']){

 			$uid = @$_SESSION['uid'];
 			
 			$pt = $_POST['type'];
 			$payment_offline_detail_no = isset($_POST['payment_offline_detail_no']) ? $_POST['payment_offline_detail_no'] : NULL;
 			$bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : NULL;
 			$bo_comment = $_POST['subject'];
 			$recipet_no = $_POST['chalan_no'];
 			$vpd_id = $_POST['vpd_id'];
 			$created_by = isset($_POST['payment_received_by']) ? $_POST['payment_received_by'] : NULL;
 				
 			Yii::app()->db->createCommand("UPDATE vpd_documents SET doc_status='P', updated_on='".date('Y-m-d H:i:s')."' WHERE id=$vpd_id")->execute();

 			Yii::app()->db->createCommand("UPDATE vpd_payment SET received_by=$uid, payment_status='Success', payment_type='$pt', reference_no='$payment_offline_detail_no', bank_name='$bank_name', bo_comment='$bo_comment', updated_on='".date('Y-m-d H:i:s')."' WHERE recipet_no='$recipet_no' AND vpd_id=$vpd_id")->execute();

 			return $this->redirect('/backoffice/investor/vpd/paymentdue');
 		
 			
 		}else{
 			return false;
 		}
 	}
 
 	return $this->render('docfee_details',['model'=>$model]);
 }


	

	public function actionDownload($vpd_id){
		$vpd_id = base64_decode($vpd_id);
		$model = Yii::app()->db->createCommand("SELECT * FROM vpd_documents WHERE id = $vpd_id")->queryRow();
		if($model['doc_name']=='app_pdf'){
			$v = Yii::app()->db->createCommand("SELECT print_app_call_back_url FROM bo_new_application_submission WHERE submission_id = ".$model['srn_no'])->queryRow();
			$pdf_url = $v['print_app_call_back_url'];
			$data = $this->Downloadpdf($pdf_url,$model['entity_reg_no'].$model['doc_name']);
			Yii::app()->db->createCommand("UPDATE vpd_documents SET doc_status='D', updated_on='".date('Y-m-d H:i:s')."' WHERE id=$vpd_id")->execute();
			print($data);
		}else{
			$v = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = ".$model['srn_no'])->queryRow();
			$pdf_url = $this->getcertificateurl($v);
			$data = $this->Downloadpdf($pdf_url,$model['entity_reg_no'].$model['doc_name']);
			Yii::app()->db->createCommand("UPDATE vpd_documents SET doc_status='D', updated_on='".date('Y-m-d H:i:s')."' WHERE id=$vpd_id")->execute();
			print($data);
		}
	 return true;
	}



	public static function Downloadpdf($url,$name) {
		//echo $url; die();
		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename=$name.pdf");
		header("Cache-control: private");
		$url = CURL_URL.$url.'/is_vpd/yes';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $data = curl_exec($ch);
       
        if (curl_error($ch)) {          
            $error_msg = curl_error($ch);
            echo "===========";
            print_r($error_msg);
            print_r($data);
            die;
        }
        curl_close($ch);

      	return $data;
    }


    public static function getcertificateurl($v){
    	switch ($v['service_id']) {
    		case '2.0':
    			$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=".$v['submission_id'])->queryRow();
    			if($fetchcompanydetails)
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate2_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($dept_id).'/reg_no/'.base64_encode($fetchcompanydetails['reg_no']).'/approved_id/'.base64_encode($fetchcompanydetails['approved_by']);
    			else
    				$url=NULL;
    		break;
    		case '4.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate4_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility4_0c";
    		break;
    		case '5.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate5_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility5_0c";
    		break;
    		case '6.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate6_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility6_0c";
    		break;
    		case '7.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate7_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility7_0c";
    		break;
    		case '8.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate8_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility8_0c";
    		break;
    		case '9.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate9_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility9_0c";
    		break;
    		case '10.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate10_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility10_0c";
    		break;


    		case '19.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate19_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility19_0c";
    		break;
    		case '20.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate20_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility20_0c";
    		break;
    		case '21.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate21_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility21_0c";
    		break;
    		case '22.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate22_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility22_0c";
    		break;    		
    		case '23.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate23_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility23_0c";
    		break;   		
    		case '24.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate24_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility24_0c";
    		break;
    		case '25.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate25_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility25_0c";
    		break;
    		case '27.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate27_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility27_0c";
    		break;
    		case '33.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate33_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility33_0c";
    		break;
    		case '36.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate36_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility36_0c";
    		break;
    		case '37.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate37_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility37_0c";
    		break;
    		case '38.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate38_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility38_0c";
    		break;
    		case '39.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate39_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility39_0c";
    		break;
    		case '40.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate40_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility40_0c";
    		break;
    		case '41.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate41_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility41_0c";
    		break;
    		case '42.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate42_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility42_0c";
    		break;
    		case '43.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate43_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility43_0c";
    		break;
    		case '44.0':
    			$url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate44_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility44_0c";
    		break;
    		
    		
    		default:
    			$url = NULL;
    			break;
    	}

    	return $url;
    }


     public function actionPrintofflinefeereciept($pid) {
         $pid = base64_decode($pid);
        $model = Yii::app()->db->createCommand("SELECT vpd.srn_no, vpd.doc_name, vpd.entity_reg_no, vpd.entity_service_id, vpd.expired_on, vpd.doc_status, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname,			
			(SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,			
			CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as app_name, u.mobile_no, u.email, pay.total_fee, pay.created_on, pay.recipet_no, pay.payment_type, pay.reference_no, pay.bank_name

			FROM vpd_documents vpd			
			INNER JOIN bo_information_wizard_service_parameters bosp
				  ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

			 INNER JOIN bo_new_application_submission a
				  ON vpd.srn_no=a.submission_id
			 INNER JOIN bo_information_wizard_service_parameters bosp1
				  ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)

			INNER JOIN vpd_payment pay ON pay.vpd_id=vpd.id
			INNER JOIN sso_users u on u.user_id=vpd.user_id	 
 		    INNER JOIN sso_profiles up on u.user_id=up.user_id
 		    WHERE pay.id=$pid")->queryRow();

        $content = $this->renderPartial('offlinefeereciept_pdf', ['model' => $model], true);

        Refundutility::generatePdf($content, 'refund');
    }
}