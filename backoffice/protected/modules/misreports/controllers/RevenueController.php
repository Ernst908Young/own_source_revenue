<?php

class RevenueController extends Controller {

	public function actionLevel1(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

	
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
	
		$records = Yii::app()->db->createCommand("SELECT 
				COUNT(q.submission_id) as total_services, 
				SUM(CASE when q.is_fee_refunded=0 then q.total_amount end) as total_amount,
				SUM(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
				q.service_id,	
				s.service_name 
				FROM tbl_payment as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN bo_new_application_submission a ON a.submission_id=q.submission_id
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success','refund success') $sidsql  group by q.service_id order by s.service_name ASC")->queryAll();

		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records]);

	}


	public function actionLevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? $_GET['service_id'] : 0) : 0;
		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? DefaultUtility::dataSenetize($_GET['subservice_id']) : 0) : 0;
		}else{
			$subservice_id = 0;
		}	

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  DefaultUtility::dataSenetize($_GET['pay_mode']) : NULL;
		if($pay_mode==NULL || $pay_mode=='All Payment Mode Status'){
			$pay_mode=NULL;
		}

		/*if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND nas.submission_id=$srn_no";
		}*/

		if($pay_mode==NULL){
			$pay_mode_con = "";
		}else{
			$pay_mode_con = "AND q.payment_mode=$pay_mode";
		}

		if($ser_status==NULL){
			$ser_status_con = "";
		}else{
			$statuss ='';
			foreach ($ser_status as $key => $value) {
				$s = Servicecategory::mappedservicestatus($value);
				if($key==0){
					$statuss = "'" . implode ( "', '", $s ) . "'";				
				}else{
					$statuss = $statuss.','."'" . implode ( "', '", $s ) . "'";	
				}			
			}		
			
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";			
		}



		$records = Yii::app()->db->createCommand("SELECT 
			q.total_amount as total_amount,
			(CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
			(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
			q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
			q.reference_number,q.bank_name,q.reference_name, q.reference_email, 
			q.created_at, nas.application_status, (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name, nas.submission_id,
			p.core_service_name as service_name , u.iuid, q.payment_received_by, nas.field_value, nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate
			FROM tbl_payment as q
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				INNER JOIN sso_users u ON nas.user_id = u.user_id
				
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success','refund success') AND q.service_id='".$service_id."' AND p.is_active='Y' $pay_mode_con $ser_status_con order by q.created_at desc")->queryAll();

		
		$this->render('level2',['subservice_id'=>$subservice_id,'from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status]);

	}

	public function actionLevel1pdf(){ 
		$name = "Service_wise_Revenue_Report_level1_".time().".pdf";			
		$heading = 'Service Wise Revenue Report Level 1';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;


		if($service_id){
			$sid = implode(',', $service_id);
				$sidsql = "AND q.service_id IN ($sid)";
				$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();

				$search_criteria = '<b>Service Name :</b> '.$serviced['services'];

		}else{
			$sidsql = '';
			$search_criteria = '<b>Service Name : </b>All Services';
		}
		
		$records = Yii::app()->db->createCommand("SELECT 
				COUNT(q.submission_id) as total_services, 
				SUM(CASE when q.is_fee_refunded=0 then q.total_amount end) as total_amount,
				SUM(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt, 
				q.service_id,	s.service_name 
				FROM tbl_payment as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status IN ('success','refund success') $sidsql  group by q.service_id order by s.service_name ASC")->queryAll();
		
		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id], true);

		
		

		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionLevel2pdf(){
		$name = "Service_wise_Revenue_Report_level2_".time().".pdf";			
		$heading = 'Service Wise Revenue Report Level 2';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? DefaultUtility::dataSenetize($_GET['service_id']) : 0) : 0;

		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? DefaultUtility::dataSenetize($_GET['subservice_id']) : 0) : 0;
		}else{
			$subservice_id = 0;
		}	
		
		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  DefaultUtility::dataSenetize($_GET['pay_mode']) : NULL;
		if($pay_mode==NULL || $pay_mode=='All Payment Mode Status'){
			$pay_mode=NULL;
		}

		if($srn_no==NULL){
			// $srn_no = implode(',', $srn_no);
			$srn_no_con = "";
			// $search_criteria = '<br><b>SRN No :</b> All SRN No';
		}else{
			// $search_criteria = '<br><b>SRN No :</b>'.$srn_no;
		}

		if($pay_mode==NULL){
			$pay_mode_con = "";
			// $search_criteria .= '<br><b>Payment Mode :</b> All Payment Mode';
		}else{
			$pay_mode_con = "AND q.payment_mode=$pay_mode";
			// $search_criteria = '<br><b>Payment Mode :</b>'.$pay_mode_con;
		}

		if($ser_status==NULL){
			$ser_status_con = "";
			$search_criteria = '<br><b>Service Status :</b> All Service Status';
		}else{
			$statuss ='';
			foreach ($ser_status as $key => $value) {
				$s = Servicecategory::mappedservicestatus($value);
				if($key==0){
					$statuss = "'" . implode ( "', '", $s ) . "'";				
				}else{
					$statuss = $statuss.','."'" . implode ( "', '", $s ) . "'";	
				}			
			}		
			
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";	
			$search_criteria = '<br><b>Service Status :</b>'.$statuss;			
		}
		
		$records = Yii::app()->db->createCommand("SELECT 
			q.total_amount as total_amount,
			(CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
			(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
			q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
			q.reference_number,q.bank_name,q.reference_name, q.reference_email, 
			q.created_at, nas.application_status, (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name, nas.submission_id,
			p.core_service_name as service_name , u.iuid, q.payment_received_by, nas.field_value, nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate
			FROM tbl_payment as q
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				INNER JOIN sso_users u ON nas.user_id = u.user_id
				
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success','refund success') AND q.service_id='".$service_id."' AND p.is_active='Y' $pay_mode_con $ser_status_con order by q.created_at desc")->queryAll();

		//	print_r($records); die();
		$content = $this->renderPartial('level2pdf', ['subservice_id'=>$subservice_id,'from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'report_from'=>'srs','srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status], true);

		$serviced = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters Where CONCAT(service_id,'.',servicetype_additionalsubservice) = '".$service_id."'")->queryRow() ;
		$search_criteria = '<b>Service Name :</b> '.$serviced['core_service_name'];

		if($subservice_id==1)
			$search_criteria .= '<br><b>Service Name :</b> Name Reservation-Society (Form 15)';
		if($subservice_id==2)
			$search_criteria .= '<br><b>Service Name :</b> Name Reservation-Company (Form 33)';
		if($subservice_id==3)
			$search_criteria .= '<br><b>Service Name :</b> Business Name Registration (Form 1)';
		

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

     

	public function actionOfficiallevel1(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

	
		$officer_id = isset($_GET['officer_id']) ? $_GET['officer_id'] : NULL;

		if($officer_id){
			$uid = implode(',', $officer_id);
			$uidsql = "AND a.department_user_id IN ($uid)";
		}else{
			$uidsql = '';
		}


	
		$records = Yii::app()->db->createCommand("SELECT 
				COUNT(q.submission_id) as total_services, 
				SUM(CASE when q.is_fee_refunded=0 then q.total_amount end) as total_amount,
				SUM(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
				u.*
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN tbl_payment as q ON a.app_Sub_id=q.submission_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status IN ('success','refund success') AND r.role_id=84 $uidsql  group by a.department_user_id")->queryAll();

		$this->render('officallevel1',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records]);

	}


	public function actionOfficialevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = $_GET['officer_id'];

		$services_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($services_id){
			$sid = implode(',', $services_id);
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no']: NULL) : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  DefaultUtility::dataSenetize($_GET['pay_mode']) : NULL;
		if($pay_mode==NULL || $pay_mode=='All Payment Mode Status'){
			$pay_mode=NULL;
		}

		/*if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND nas.submission_id=$srn_no";
		}*/

		if($pay_mode==NULL){
			$pay_mode_con = "";
		}else{
			$pay_mode_con = "AND q.payment_mode=$pay_mode";
		}

		if($ser_status==NULL){
			$ser_status_con = "";
		}else{
			$statuss ='';
			foreach ($ser_status as $key => $value) {
				$s = Servicecategory::mappedservicestatus($value);
				if($key==0){
					$statuss = "'" . implode ( "', '", $s ) . "'";				
				}else{
					$statuss = $statuss.','."'" . implode ( "', '", $s ) . "'";	
				}			
			}		
			
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";			
		}

		$records = Yii::app()->db->createCommand("SELECT 
				q.total_amount as total_amount, 
				(CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
				(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
				q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
				q.reference_number,q.bank_name,q.reference_name,sou.iuid,q.reference_email, q.created_at, u.*,
				nas.application_status,  (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name,
				nas.submission_id, s.service_name, q.payment_received_by,
				nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN tbl_payment as q ON a.app_Sub_id=q.submission_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				INNER JOIN bo_information_wizard_service_parameters p ON nas.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)	
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN sso_users sou ON nas.user_id = sou.user_id
				
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status IN ('success','refund success') AND r.role_id=84 
				$sidsql AND p.is_active='Y'
				AND a.department_user_id=$officer_id  $pay_mode_con $ser_status_con GROUP BY a.app_Sub_id ORDER BY q.created_at DESC")->queryAll();
//print_r($records); die;
		
		$this->render('officallevel2',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'services_id'=>$services_id,'srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status]);

	}


	public function actionOfficiallevel1pdf(){
		$name = "Official_wise_Revenue_Report_level1_".time().".pdf";			
		$heading = 'Official Wise Revenue Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$officer_id = isset($_GET['officer_id']) ? $_GET['officer_id'] : NULL;

		if($officer_id){
			$uid = implode(',', $officer_id);
			$uidsql = "AND a.department_user_id IN ($uid)";
			$officersd = Yii::app()->db->createCommand("SELECT group_concat(CONCAT(full_name,' ',middle_name,' ',last_name,' - ',email) separator ', ') as officers from bo_user Where uid IN ($uid)")->queryRow();

				$search_criteria = '<b>CAIPO Officer :</b> '.$officersd['officers'];
		}else{
			$uidsql = '';
			$search_criteria = '<b>CAIPO Officer :</b> All Officers';
		}
	
		
		$records = Yii::app()->db->createCommand("SELECT 
				COUNT(q.submission_id) as total_services, 
				SUM(CASE when q.is_fee_refunded=0 then q.total_amount end) as total_amount,
				SUM(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
				u.*
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN tbl_payment as q ON a.app_Sub_id=q.submission_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status IN ('success','refund success') AND r.role_id=84 $uidsql  group by a.department_user_id")->queryAll();

		$content = $this->renderPartial('officiallevel1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records], true);

		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionOfficiallevel2pdf(){
		$name = "Official_wise_Revenue_Report_level2_".time().".pdf";			
		$heading = 'Official Wise Revenue Report Level 2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$officer_id = $_GET['officer_id'];

		$services_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($services_id){
			$sid = implode(',', $services_id);
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		
		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no']: NULL) : NULL;
		
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  DefaultUtility::dataSenetize($_GET['pay_mode']) : NULL;
		if($pay_mode==NULL || $pay_mode=='All Payment Mode Status'){
			$pay_mode=NULL;
		}

		if(!empty($srn_no)){
			$sid = implode(',', $srn_no);
			$search_criteria = '<b>Srn No.: </b>'.$sid;
			
			
		}else{
			$search_criteria = '<b>Srn No.: </b>';
		}
		
		if($pay_mode==NULL){
			$pay_mode_con = "";
		}else{
			$pay_mode_con = "AND q.payment_mode=$pay_mode";
		}

		if($ser_status==NULL){
			$ser_status_con = "";
		}else{
			$statuss ='';
			foreach ($ser_status as $key => $value) {
				$s = Servicecategory::mappedservicestatus($value);
				if($key==0){
					$statuss = "'" . implode ( "', '", $s ) . "'";				
				}else{
					$statuss = $statuss.','."'" . implode ( "', '", $s ) . "'";	
				}			
			}		
			
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";			
		}
		
		$records = Yii::app()->db->createCommand("SELECT 
				q.total_amount as total_amount, 
				(CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
				(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
				q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
				q.reference_number,q.bank_name,q.reference_name,sou.iuid,q.reference_email, q.created_at, u.*,
				nas.application_status,  (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name,
				nas.submission_id, s.service_name, q.payment_received_by,
				nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN tbl_payment as q ON a.app_Sub_id=q.submission_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				INNER JOIN bo_information_wizard_service_parameters p ON nas.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)	
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN sso_users sou ON nas.user_id = sou.user_id
				
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status IN ('success','refund success') AND r.role_id=84 
				$sidsql AND p.is_active='Y'
				AND a.department_user_id=$officer_id  $pay_mode_con $ser_status_con GROUP BY a.app_Sub_id ORDER BY q.created_at DESC")->queryAll();
			
		$content = $this->renderPartial('officiallevel2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'services_id'=>$services_id,'srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status], true);

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}


	public function actionSrs(){
		$error = NULL;  $max_amt = $min_amt = NULL;
		
		if(isset($_POST['from_date']) && isset($_POST['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_POST['from_date']);
			$to_date = DefaultUtility::dataSenetize($_POST['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_POST['services_id']) ? $_POST['services_id'] : NULL;

		
		if(isset($_POST['graph_type'])){
			$grap_id = $_POST['graph_type'];
		}else{
			$grap_id = NULL;
		}

		if(isset($_POST['min_amt']) && isset($_POST['max_amt'])){			
			if($_POST['min_amt']>0){
				$min_amt = DefaultUtility::dataSenetize($_POST['min_amt']);
			}else{
				$min_amt = NULL;
			}

			if(!empty($_POST['max_amt'])){
				if($_POST['min_amt']>$_POST['max_amt']){
					$error = "Maximum amount should be greater then minimum amount";
					$max_amt = $min_amt = NULL;
				}else{
					$max_amt = DefaultUtility::dataSenetize($_POST['max_amt']);
				}
			}		
		}

		$records = $this->getsrsrecords($from_date, $to_date, $service_id);
		
		$services = Yii::app()->db->createCommand("SELECT bosp.core_service_name, a.service_id,
			SUM(CASE when p.payment_status in ('success') then p.total_amount end) as total_revenue
		FROM bo_new_application_submission a
		INNER JOIN bo_information_wizard_service_parameters bosp
		ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
		INNER JOIN tbl_payment p
		ON a.submission_id=p.submission_id
		WHERE DATE(p.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND bosp.is_active='Y' GROUP BY bosp.core_service_name")->queryAll();

		$this->render('srs',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'grap_id'=>$grap_id, 'records'=>$records,'min_amt'=>$min_amt,'max_amt'=>$max_amt,'error'=>$error,'service_id'=>$service_id,'services'=>$services]);
	}

	/*public function actionSrsadv(){
		$error = NULL;
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		if(isset($_GET['graph_type'])){
			$grap_id = $_GET['graph_type'];
		}else{
			$grap_id = 'line';
		}

		if(isset($_GET['min_amt']) && isset($_GET['max_amt'])){			
			if($_GET['min_amt']>0){
				$min_amt = $_GET['min_amt'];
			}else{
				$min_amt = 0;
			}

			if($_GET['min_amt']>$_GET['max_amt']){
				$error = "Maximum amount should be grater then minimum amount";
				$max_amt = $min_amt = NULL;
			}else{
				$max_amt = $_GET['max_amt'];
			}

			
		}else{
			$max_amt = $min_amt = NULL;
		}

		



		$records = $this->getsrsrecords($from_date, $to_date);

		$this->render('srs_adv',['from_date'=>$from_date,'to_date'=>$to_date,'grap_id'=>$grap_id, 'records'=>$records,'min_amt'=>$min_amt,'max_amt'=>$max_amt,'error'=>$error]);
	}
*/
	public function actionSrspdf(){
		$name = "Service_wise_Revenue_Summary_".time().".pdf";			
		$heading = 'Service Wise Revenue Summary';
		
		if(isset($_POST['from_date']) && isset($_POST['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_POST['from_date']);
			$to_date = DefaultUtility::dataSenetize($_POST['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();
			$search_criteria = '<b>Service Name :</b> '.$serviced['services'];
		}else{
			$search_criteria = '<b>Service Name : </b>All Services';
		}
		

		if(isset($_POST['min_amt']) && isset($_POST['max_amt'])){
			$max_amt = DefaultUtility::dataSenetize($_POST['max_amt']);
			$min_amt = DefaultUtility::dataSenetize($_POST['min_amt']);
		}else{
			$max_amt = $min_amt = NULL;
			
		}

		$search_criteria.="<br><b>Minimum Amount (BBD$): </b>".($min_amt>0 ? $min_amt : 'NA').' | <b>Maximum Amount (BBD$): </b>'.($max_amt>0 ? $max_amt : 'NA');


		$records = $this->getsrsrecords($from_date, $to_date, $service_id);

		$content = $this->renderPartial('srspdf',['from_date'=>$from_date, 'to_date'=>$to_date,'records'=>$records,'min_amt'=>$min_amt,'max_amt'=>$max_amt], true);

		if(isset($_POST['graph_type'])){
			$grap_id = DefaultUtility::dataSenetize($_POST['graph_type']);
		}else{
			$grap_id = NULL;
		}

		//$content_chart = $this->renderPartial('srs_adv',['from_date'=>$from_date,'to_date'=>$to_date,'grap_id'=>$grap_id, 'records'=>$records,'min_amt'=>$min_amt,'max_amt'=>$max_amt,'error'=>NULL], true);
		$bargraphdata = isset($_POST['bargraphdata']) ? DefaultUtility::dataSenetize($_POST['bargraphdata']) : NULL;
		$line_graph_data = isset($_POST['linegraphdata']) ? DefaultUtility::dataSenetize($_POST['linegraphdata']) : NULL;
		
		$piechartdata = isset($_POST['piechartdata']) ? DefaultUtility::dataSenetize($_POST['piechartdata']) : NULL;
		$donutchartdata = isset($_POST['donutchartdata']) ? DefaultUtility::dataSenetize($_POST['donutchartdata']) : NULL;
	
	
		Reportformat::generatePdf_l_wg($content, $line_graph_data, $bargraphdata, $piechartdata,
 		$donutchartdata,$name,$heading,$from_date,$to_date,$search_criteria,$grap_id);
	}

	public function actionTestpdf(){
		$name = "Service_wise_Revenue_Summary_".time().".pdf";			
		$heading = 'Service Wise Revenue Summary';
		$from_date = $to_date = $search_criteria=NULL;
		$content = '<h1>Ajax graph PDF</h1>';
		$graph_data=NULL;
		Reportformat::generatePdf_l($content,$graph_data,$name,$heading,$from_date,$to_date,$search_criteria);
	}

	function getsrsrecords($from_date, $to_date, $service_id){

		/*if($min_amt !=NULL && $max_amt!=NULL){
			$min_amx_con = " AND p.total_amount>=$min_amt AND p.total_amount<=$max_amt";
		}else{
			$min_amx_con = "";
		}*/

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND a.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}

		$records = Yii::app()->db->createCommand("SELECT bosp.core_service_name, a.service_id,
		COUNT(CASE when p.payment_status in ('refund success','success') then p.submission_id end) as total_gross_filling,
		COUNT(CASE when p.payment_status in ('refund success') then p.submission_id end) as total_refund,
		COUNT(CASE when p.payment_status in ('success') then p.submission_id end) as total_net_filling,

		SUM(CASE when p.payment_status in ('refund success','success') then p.total_amount end) as gross_revenue_recived,
		SUM(CASE when p.payment_status in ('refund success') then p.total_amount end) as total_revenue_refunded,
		SUM(CASE when p.payment_status in ('success') then p.total_amount end) as total_revenue

		FROM bo_new_application_submission a
		INNER JOIN bo_information_wizard_service_parameters bosp
		ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
		INNER JOIN tbl_payment p
		ON a.submission_id=p.submission_id
		WHERE DATE(p.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND bosp.is_active='Y' GROUP BY bosp.core_service_name")->queryAll();
		return $records ;

	}

	public function actionSrslevel2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? $_GET['service_id'] : 0) : 0;
		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? DefaultUtility::dataSenetize($_GET['subservice_id']) : 0) : 0;
		}else{
			$subservice_id = 0;
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  DefaultUtility::dataSenetize($_GET['pay_mode']) : NULL;
		if($pay_mode==NULL || $pay_mode=='All Payment Mode Status'){
			$pay_mode=NULL;
		}

		/*if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND nas.submission_id=$srn_no";
		}*/

		if($pay_mode==NULL){
			$pay_mode_con = "";
		}else{
			$pay_mode_con = "AND q.payment_mode=$pay_mode";
		}

		if($ser_status==NULL){
			$ser_status_con = "";
		}else{
			$statuss ='';
			foreach ($ser_status as $key => $value) {
				$s = Servicecategory::mappedservicestatus($value);
				if($key==0){
					$statuss = "'" . implode ( "', '", $s ) . "'";				
				}else{
					$statuss = $statuss.','."'" . implode ( "', '", $s ) . "'";	
				}			
			}		
			
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";			
		}

		$records = Yii::app()->db->createCommand("SELECT 
			q.total_amount as total_amount,
			(CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
			(CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
			q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
			q.reference_number,q.bank_name,q.reference_name, q.reference_email, 
			q.created_at, nas.application_status, (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name, nas.submission_id,
			p.core_service_name as service_name , u.iuid, q.payment_received_by, nas.field_value, nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate
			FROM tbl_payment as q
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
				INNER JOIN sso_users u ON nas.user_id = u.user_id
				
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success','refund success') AND q.service_id='".$service_id."' AND p.is_active='Y' $pay_mode_con $ser_status_con order by q.created_at desc")->queryAll();

		
		$this->render('level2',['subservice_id'=>$subservice_id,'from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'report_from'=>'srs','srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status]);
	}


	public function actionTcslevel1(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		
		$fee_type = isset($_GET['fee_type']) ? ($_GET['fee_type']=="NULL"?NULL:DefaultUtility::dataSenetize($_GET['fee_type'])) : NULL;
		

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}

		$records = Yii::app()->db->createCommand("SELECT 
			COUNT(q.submission_id) as service_fees_count,
			SUM(q.service_total_fee) as service_total_fee,
			COUNT(CASE when q.late_fee > 0 then q.submission_id end) as late_fee_count,
			SUM(q.late_fee) as late_fee,
			q.submission_id,
			q.service_id,
			p.core_service_name					
			FROM tbl_payment as q	
			INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)	
			where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql
				AND q.payment_status IN ('success') AND p.is_active='Y' AND q.payment_mode=1 GROUP BY q.service_id")->queryAll();

		$this->render('tcslevel1',['service_id'=>$service_id,'from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'fee_type'=>$fee_type]);
			

	}	
	
	public function actionTcslevel1pdf(){
		$name = "Transaction_Code_Summary_".time().".pdf";			
		$heading = 'Transaction Code Summary';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		
		$fee_type = isset($_GET['fee_type']) ? ($_GET['fee_type']=="NULL"?NULL:DefaultUtility::dataSenetize($_GET['fee_type'])) : NULL;
		
		
		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid)";
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();

			$search_criteria = '<b>Service Name :</b> '.$serviced['services'];
		}else{
			$sidsql = '';
			$search_criteria = '<b>Service Name : </b>All Services';
		}

		if($fee_type){
			$search_criteria.= '<br> <b>Fee Type : </b>'.$fee_type;
		}else{
			$search_criteria.= '<br> <b>Fee Type : </b>All Fee Type';
		}

		$records = Yii::app()->db->createCommand("SELECT 
			COUNT(q.submission_id) as service_fees_count,
			SUM(q.service_total_fee) as service_total_fee,
			COUNT(CASE when q.late_fee > 0 then q.submission_id end) as late_fee_count,
			SUM(q.late_fee) as late_fee,
			q.submission_id,
			q.service_id,
			p.core_service_name					
			FROM tbl_payment as q	
			INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id	
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)	
			where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql
				AND q.payment_status IN ('success') AND p.is_active='Y' AND q.payment_mode=1 GROUP BY q.service_id")->queryAll();

		
		$content = $this->renderPartial('tcslevel1pdf',['service_id'=>$service_id,'from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'fee_type'=>$fee_type],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}


	public function actionTcslevel2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$payment_code = isset($_GET['payment_code']) ? ($_GET['payment_code'] ? DefaultUtility::dataSenetize($_GET['payment_code']) : NULL) : NULL;
		$fee_detail = isset($_GET['fee_detail']) ? ($_GET['fee_detail'] ? DefaultUtility::dataSenetize($_GET['fee_detail']) : NULL) : NULL;
		
		$page_form_id = isset($_GET['page_form_id']) ? ($_GET['page_form_id'] ? DefaultUtility::dataSenetize($_GET['page_form_id']) : 0) : 0;

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? DefaultUtility::dataSenetize($_GET['service_id']) : 0) : 0;

		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? DefaultUtility::dataSenetize($_GET['subservice_id']) : 0) : 0;
		}else{
			$subservice_id = 0;
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		/*if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND nas.submission_id=$srn_no";
		}*/

		$records = Yii::app()->db->createCommand("SELECT 
			q.service_total_fee,
			q.late_fee,
			q.submission_id,
			q.created_at,
			q.transaction_number,
			nas.field_value,
			nas.application_status,
			nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate					
			FROM tbl_payment as q	
			INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id		
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
			where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success') AND q.payment_mode=1 AND p.is_active='Y' AND q.service_id='".$service_id."'  ORDER BY q.created_at DESC")->queryAll();

		$this->render('tcslevel2',['from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'subservice_id'=>$subservice_id,'payment_code'=>$payment_code,'fee_detail'=>$fee_detail,'page_form_id'=>$page_form_id,'records'=>$records,'srn_no'=>$srn_no]);

	}
	
	public function actionTcslevel2Pdf(){
		
		$name = "TRANSACTION_CODE_SUMMARY_REPORT_LEVEL2_".time().".pdf";			
		$heading = 'TRANSACTION CODE SUMMARY REPORT LEVEL 2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = DefaultUtility::dataSenetize($_GET['from_date']);
			$to_date = DefaultUtility::dataSenetize($_GET['to_date']);
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$payment_code = isset($_GET['payment_code']) ? ($_GET['payment_code'] ? DefaultUtility::dataSenetize($_GET['payment_code']) : NULL) : NULL;
		$fee_detail = isset($_GET['fee_detail']) ? ($_GET['fee_detail'] ? DefaultUtility::dataSenetize($_GET['fee_detail']) : NULL) : NULL;
		
		$page_form_id = isset($_GET['page_form_id']) ? ($_GET['page_form_id'] ? DefaultUtility::dataSenetize($_GET['page_form_id']) : 0) : 0;

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? DefaultUtility::dataSenetize($_GET['service_id']) : 0) : 0;

		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? DefaultUtility::dataSenetize($_GET['subservice_id']) : 0) : 0;
		}else{
			$subservice_id = 0;
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		if(!empty ($srn_no)){
			$sid = implode(',', $srn_no);

			$search_criteria = '<b>Srn No.:</b> '.$sid;
		}else{
			$search_criteria = '<b>Srn No. :</b> All SRN NO.';
		}
		
		$records = Yii::app()->db->createCommand("SELECT 
			q.service_total_fee,
			q.late_fee,
			q.submission_id,
			q.created_at,
			q.transaction_number,
			nas.field_value,
			nas.application_status,
			nas.print_app_call_back_url, nas.download_certificate_call_back_url, p.is_certificate					
			FROM tbl_payment as q	
			INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id		
			INNER JOIN bo_information_wizard_service_parameters p ON q.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
			where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				AND q.payment_status IN ('success') AND q.payment_mode=1 AND p.is_active='Y' AND q.service_id='".$service_id."'  ORDER BY q.created_at DESC")->queryAll();
		
		$content = $this->renderPartial('tcslevel2pdf',['from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'subservice_id'=>$subservice_id,'payment_code'=>$payment_code,'fee_detail'=>$fee_detail,'page_form_id'=>$page_form_id,'records'=>$records,'srn_no'=>$srn_no],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);

	}
	
	
}