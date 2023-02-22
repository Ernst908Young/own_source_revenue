<?php

class EntityController extends Controller {

	public function actionLevel1(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
	
		$reg_no = isset($_GET['regno']) ? $_GET['regno'] : NULL;
	
		if($reg_no){
			$sid = implode('","', $reg_no);
			$sidsql = 'AND s.entity_name IN ('.'"'.$sid.'"'.')';
		}else{
			$sidsql = '';
		}

		$bustype = isset($_GET['bustype']) ? $_GET['bustype'] : NULL;
		
		$category = isset($_GET['dnc']) ? $_GET['dnc'] : NULL;
		$sc = isset($_GET['sc']) ? $_GET['sc'] : NULL;
		


	
		$records = Yii::app()->db->createCommand("
			SELECT COUNT(s.submission_id) as total_services,
			GROUP_CONCAT(DISTINCT  s.service_id) as services,
			SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
			SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
			cd.company_name as entity_name,
			s.entity_name as reg_no,
			cd.service_id, cd.srn_no, cd.name_related_srn
			from bo_new_application_submission as s
				LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id 
			INNER JOIN bo_company_details cd on ((cd.reg_no = s.entity_name) AND cd.service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0'))
			where DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql group by s.entity_name
			")->queryAll();
	

		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'reg_no'=>$reg_no,'records'=>$records,'bustype'=>$bustype,'category'=>$category,'sc'=>$sc]);
	}


	public function actionLevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

	
		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND s.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		
		$reg_no = $_GET['regno'];
			


$records = Yii::app()->db->createCommand("
	SELECT sc.service_name,
	s.service_id,COUNT(s.submission_id) as total_services,
	SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
	SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
	cd.company_name as entity_name,
	s.entity_name as entity_id
	from bo_new_application_submission as s
	LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id 
	inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 	
	INNER JOIN bo_company_details cd on ((cd.reg_no = s.entity_name) AND cd.service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0'))
					
	where s.entity_name='".$reg_no."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql group by s.service_id")->queryAll();

$services = Yii::app()->db->createCommand("
	SELECT sc.service_name,
	s.service_id
	from bo_new_application_submission as s	
	inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 				
	where s.entity_name='".$reg_no."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' group by s.service_id")->queryAll();
		
		
		$this->render('level2',['from_date'=>$from_date,'to_date'=>$to_date,'reg_no'=>$reg_no,'records'=>$records,'service_id'=>$service_id,'services'=>$services]);

	}
	
	
	
	public function actionLevel3(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;

	

		
		$reg_no = $_GET['regno'];
			

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
				
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		

	/*	if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND nas.submission_id=$srn_no";
		}*/

		

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


	$records = Yii::app()->db->createCommand("
		SELECT 
		q.total_amount as total_amount, 
		(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amt,
		(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
		q.is_fee_refunded,nas.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.reference_email, q.created_at, nas.application_status,  cd.company_name as entity_name, nas.submission_id,
		s.service_name , u.iuid, p.first_name, p.last_name, p.surname, u.email, q.payment_received_by,q.payment_status, nas.print_app_call_back_url, sp.is_certificate, nas.download_certificate_call_back_url
		FROM bo_new_application_submission nas
		LEFT OUTER JOIN tbl_payment as q ON q.submission_id = nas.submission_id 
		INNER JOIN bo_information_wizard_service_master s ON nas.service_id = s.id	
		INNER JOIN bo_information_wizard_service_parameters sp ON nas.service_id = concat(sp.service_id,'.',sp.servicetype_additionalsubservice) 	
		INNER JOIN sso_users u ON nas.user_id = u.user_id	
		INNER JOIN sso_profiles p ON p.user_id = u.user_id	
		INNER JOIN bo_company_details cd on ((cd.reg_no = nas.entity_name) AND cd.service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0'))
		where nas.entity_name='".$reg_no."' and DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND nas.service_id='".$service_id."' AND sp.is_active='Y' $ser_status_con order by nas.application_created_date desc")->queryAll();
	
		$this->render('level3',['from_date'=>$from_date,'to_date'=>$to_date,'reg_no'=>$reg_no,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'ser_status'=>$ser_status]);

	}

	public function actionLevel1pdf(){
		$name = "Entity_Summary_Report_level1_".time().".pdf";			
		$heading = 'Entity Summary Report Level 1';
		// print_r($_GET);die;
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$reg_no = isset($_GET['regno']) ? $_GET['regno'] : NULL;
		
		if($reg_no){
			$sid = implode('","', $reg_no);
			$sidsql = 'AND s.entity_name IN ('.'"'.$sid.'"'.')';
			
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(distinct(entity_name) separator ', ') as services from bo_new_application_submission Where entity_name IN (".'"'."$sid".'"'.")")->queryRow();
			
			$search_criteria = '<br><b>Business Entity :</b> '.$serviced['services'];
		}else{
			$sidsql = '';
			$search_criteria = '<br><b>Business Entity : </b>All Business Entity';
		} 
		
		$sc = isset($_GET['sc']) ? $_GET['sc'] : NULL;
		if($sc){
			$sid = implode('","', $sc);
			$search_criteria .= '<br><b> Service Category :</b>'.$sid;

		}else{
			$sidsql = '';
			$search_criteria .= '<br> <b>Service Category : </b>All Service Category';
		}
		
		$bustype = isset($_GET['bustype']) ? $_GET['bustype'] : NULL;
		/* if($bustype){
			$sid = implode('","', $bustype);
				$search_criteria .= '<br> ';
		}else{
			$sidsql = '';
			$search_criteria .= '<br> <b>Business Type : </b>All Business Type';
		} */
		
		$category = isset($_GET['dnc']) ? $_GET['dnc'] : NULL;
		if($category){
			$sid = implode('","', $category);
			$search_criteria .= '<br><b> Does Not Contain :</b>'.$sid;
		}else{
			$sidsql = '';
			$search_criteria .= '<br> <b>Does Not Contain : </b>All Does Not Contain';
		} 
		
		
		$records = Yii::app()->db->createCommand("
			SELECT COUNT(s.submission_id) as total_services,
			GROUP_CONCAT(DISTINCT  s.service_id) as services,
			SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
			SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
			cd.company_name as entity_name,
			s.entity_name as reg_no,
			cd.service_id, cd.srn_no, cd.name_related_srn
			from bo_new_application_submission as s
				LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id 
			INNER JOIN bo_company_details cd on ((cd.reg_no = s.entity_name) AND cd.service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0'))
			where DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql group by s.entity_name
			")->queryAll();
			
		
		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'bustype'=>$bustype,'category'=>$category,'sc'=>$sc], true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	

	public function actionLevel2pdf(){
		$name = "Entity_Summary_Report_level2_".time().".pdf";			
		$heading = 'Entity Summary Report Level 2';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND s.service_id IN ($sid)";
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();
			

		}else{
			$sidsql = '';
			
		}
		$entity_id = $_GET['regno'];
		$entity = Yii::app()->db->createCommand("select cd.company_name as entity_name from  bo_new_application_submission as nas left join bo_company_details cd on cd.reg_no = nas.entity_name where nas.entity_name = '".$entity_id."'")->queryRow();
		
		$records = Yii::app()->db->createCommand("
	SELECT sc.service_name,
	s.service_id,COUNT(s.submission_id) as total_services,
	SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
	SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
	cd.company_name as entity_name,
	s.entity_name as entity_id
	from bo_new_application_submission as s
	LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id 
	inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 	
	LEFT OUTER JOIN bo_company_details cd on cd.reg_no = s.entity_name
					
	where s.entity_name='".$entity_id."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql group by s.service_id")->queryAll();

		$content = $this->renderPartial('level2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id], true);
		$search_criteria = '<b>Entity Name :</b> '.$entity['entity_name'];
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	
	public function actionLevel3pdf(){
		$name = "Entity_Summary_Report_level3_".time().".pdf";			
		$heading = 'Entity Summary Report Level 3';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;
		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
				
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;
		$reg_no = $_GET['regno'];
		
		if($ser_status==NULL){
			$ser_status_con = "";
			$search_criteria = '<b>Service Status :</b> ';
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
			$sid = implode('","', $ser_status);
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";
			$search_criteria = '<b>Service Status :</b> '.$sid;			
		}
		
		
		// $entity_id = $_GET['entity_id'];
		
			$records = Yii::app()->db->createCommand("
		SELECT 
		q.total_amount as total_amount, 
		(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amt,
		(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
		q.is_fee_refunded,nas.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.reference_email, q.created_at, nas.application_status,  cd.company_name as entity_name, nas.submission_id,
		s.service_name , u.iuid, p.first_name, p.last_name, p.surname, u.email, q.payment_received_by,q.payment_status, nas.print_app_call_back_url, sp.is_certificate, nas.download_certificate_call_back_url
		FROM bo_new_application_submission nas
		LEFT OUTER JOIN tbl_payment as q ON q.submission_id = nas.submission_id 
		INNER JOIN bo_information_wizard_service_master s ON nas.service_id = s.id	
		INNER JOIN bo_information_wizard_service_parameters sp ON nas.service_id = concat(sp.service_id,'.',sp.servicetype_additionalsubservice) 	
		INNER JOIN sso_users u ON nas.user_id = u.user_id	
		INNER JOIN sso_profiles p ON p.user_id = u.user_id	
		INNER JOIN bo_company_details cd on ((cd.reg_no = nas.entity_name) AND cd.service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0'))
		where nas.entity_name='".$reg_no."' and DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND nas.service_id='".$service_id."' AND sp.is_active='Y' $ser_status_con order by nas.application_created_date desc")->queryAll();

			// $serviced = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters Where CONCAT(service_id,'.',servicetype_additionalsubservice) = '".$service_id."'")->queryRow() ;
			// $entity = Yii::app()->db->createCommand("select cd.company_name as entity_name from  bo_new_application_submission as nas left join bo_company_details cd on cd.reg_no = nas.entity_name where nas.entity_name = '".$entity_id."'")->queryRow();
		
		// print_r($records);die;
		$content = $this->renderPartial('level3pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'reg_no'=>$reg_no,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'ser_status'=>$ser_status], true);
		// $search_criteria = '<b>Entity Name :</b> '.$entity['entity_name']."<br/>".
						   // '<b>Service Name :</b> '.$serviced['core_service_name'];
		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	

/*
* Entity Name summary report
*/
	public function actionEns(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;	
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;
		$entity_t = isset($_GET['entity_t']) ? ($_GET['entity_t'] ? $_GET['entity_t'] : NULL) : NULL;
		if($entity_t==NULL || $entity_t=='All Company Type'){
			$entity_t=NULL;
		}

		
	
		$records = Yii::app()->db->createCommand("SELECT a.submission_id, b.created,
			 a.field_value, b.banned_words_name, a.application_status,
			 application_created_date,a.print_app_call_back_url, a.download_certificate_call_back_url, p.is_certificate 
			 FROM bo_new_application_submission a
			 INNER JOIN bo_information_wizard_service_parameters p ON a.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
			 INNER JOIN bo_banned_words b ON a.submission_id=b.app_id
		 WHERE  a.service_id='2.0' AND a.application_status='A' AND DATE(b.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND p.is_active='Y'  GROUP BY b.app_id ORDER BY b.created DESC")->queryAll();

	

		$this->render('ens',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'srn_no'=>$srn_no,'entity'=>$entity,'entity_t'=>$entity_t]);
	}
	
	public function actionEnspdf(){
		
		$name = "Entity_Name_Summary_".time().".pdf";			
		$heading = 'Entity Name Summary Report';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;	
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;
		$entity_t = isset($_GET['entity_t']) ? ($_GET['entity_t'] ? $_GET['entity_t'] : NULL) : NULL;
		
		if($entity_t==NULL || $entity_t=='All Company Type'){
			$entity_t=NULL;
			$search_criteria = '<b>Entity Type : </b> All Company Type';
		}else{
			$search_criteria = '<b>Entity Type : </b> '.($entity_t==2 ? 'Company Form 33':'Society Form 15');
		}
		
		if($srn_no){
			$srn_no_com = implode('","', $srn_no);
			$search_criteria.= '<br> <b>SRN No : </b>'.$srn_no_com;
		}else{
			$search_criteria.= '<br> <b>SRN No : </b>All SRN No';
			
		}
		

		
	
		$records = Yii::app()->db->createCommand("SELECT a.submission_id, b.created,
			 a.field_value, b.banned_words_name, a.application_status,
			 application_created_date,a.print_app_call_back_url, a.download_certificate_call_back_url, p.is_certificate 
			 FROM bo_new_application_submission a
			 INNER JOIN bo_information_wizard_service_parameters p ON a.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)
			 INNER JOIN bo_banned_words b ON a.submission_id=b.app_id
		 WHERE  a.service_id='2.0' AND a.application_status='A' AND DATE(b.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND p.is_active='Y'  GROUP BY b.app_id ORDER BY b.created DESC")->queryAll();

	

		$content = $this->renderPartial('enspdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'srn_no'=>$srn_no,'entity'=>$entity,'entity_t'=>$entity_t],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);
	}

	

     

	


	

		
}