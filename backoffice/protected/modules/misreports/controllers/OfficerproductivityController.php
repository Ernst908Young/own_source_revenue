<?php

class OfficerproductivityController extends Controller {
	public function actionLevel1(){
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
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
		
		

		$records = Yii::app()->db->createCommand("SELECT u.*,
				COUNT(CASE WHEN a.action_status = 'A' THEN 1 END) AS approved,
			    COUNT(CASE WHEN a.action_status = 'R' THEN 1 END) AS reject  
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				
				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND r.role_id=84 $uidsql  group by a.department_user_id")->queryAll();

	 $sql1 = "SELECT 
     COUNT(CASE WHEN nas.application_status IN ('P','F','AB','FA') THEN 1 END) AS Pending_For_Approval    
     FROM bo_new_application_submission as nas 
    INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
      where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'";

    $app_count = Yii::app()->db->createCommand($sql1)->queryRow();
		
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'app_count'=>$app_count]);
	}

public function actionLevel2(){
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = $_GET['officer_id'];
		
		$services_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($services_id){
			$sid = implode(',', $services_id);
			$sidsql = "AND a.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		
		$records = Yii::app()->db->createCommand("SELECT u.*,sp.core_service_name,a.app_Sub_id,a.service_id,
				COUNT(CASE WHEN a.action_status = 'A' THEN 1 END) AS approved,
			    COUNT(CASE WHEN a.action_status = 'R' THEN 1 END) AS reject  
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN bo_information_wizard_service_parameters as sp ON a.service_id=CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND r.role_id=84  AND a.department_user_id=$officer_id  AND sp.is_active='Y' AND a.action_status IN ('A','R') group by a.service_id")->queryAll();

		/*$records = Yii::app()->db->createCommand("SELECT u.*,sp.core_service_name,a.app_Sub_id,a.action_status, a.created
				 
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN bo_information_wizard_service_parameters as sp ON a.service_id=CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)

				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND r.role_id=84 AND a.department_user_id=$officer_id 
					AND a.action_status IN ('A','R')
				AND  sp.is_active='Y'")->queryAll();*/


	
		
		$this->render('level2',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'services_id'=>$services_id]);
	}
	
	
	public function actionLevel3(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;
		$officer_id = $_GET['officer_id'];
		if(isset($_GET['status'])){
			$status=$_GET['status'];
		}
		else{
			$status="";
		}
		
		$statusquery="";
				if($status=="A"){
					$statusquery=" and a.action_status IN('A')";
				}
				else if($status=="R"){
					$statusquery=" and a.action_status IN('R')";
				}
				else{
					$statusquery=" and a.action_status IN('A','R')";
				}

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		$pay_mode = isset($_GET['pay_mode']) ?  $_GET['pay_mode'] : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;

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
			$pay_mode_con = "AND p.payment_mode=$pay_mode";
		}


$records = Yii::app()->db->createCommand("
				SELECT a.app_Sub_id, a.action_status,
				p.total_amount as total_amount, 
					(CASE when p.is_fee_refunded=0 then p.total_amount end) as paid_amt,
					(CASE when p.is_fee_refunded=1 then p.total_amount end) as ref_amt,
				su.iuid, nas.submission_id,
				p.payment_mode, p.transaction_number, p.reference_number,p.bank_name,p.reference_name, p.reference_email, p.created_at, nas.application_status,  (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name,
				nas.submission_id as SRN_no,su.email,up.first_name, p.payment_received_by,p.is_fee_refunded,nas.print_app_call_back_url, nas.download_certificate_call_back_url, s.is_certificate
				 
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_new_application_submission nas ON nas.submission_id=a.app_Sub_id
				INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
				INNER JOIN sso_users su ON nas.user_id=su.user_id
				INNER JOIN sso_profiles up ON nas.user_id=up.user_id
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				left OUTER Join tbl_payment as p on p.submission_id=a.app_Sub_id
				
                                 
where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
 AND a.service_id='".$service_id."' and a.department_user_id=$officer_id AND r.role_id=84 $statusquery AND s.is_active='Y'  $pay_mode_con order by p.created_at desc")->queryAll();
 

		

		
		$this->render('level3',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'service_id'=>$service_id,'status'=>$status,'srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode]);

	}
	public function actionLevel3pdf(){
		$name = "Officer_productivity_Report_level3_".time().".pdf";			
		$heading = 'Officer Productivity Report Level 3';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$officer_id = isset($_GET['officer_id']) ? $_GET['officer_id'] : NULL;
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;
		$status = isset($_GET['status']) ? $_GET['status'] : NULL;
		
		$search_criteria='';
if($officer_id){
			$officersd = Yii::app()->db->createCommand("SELECT group_concat(CONCAT(full_name,' ',middle_name,' ',last_name,' - ',email) separator ', ') as officers from bo_user Where uid='".$officer_id."'")->queryRow();

				$search_criteria = '<b>CAIPO Officer :</b> '.$officersd['officers'];
}
		
		
		if($service_id){
			$serviced = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters Where CONCAT(service_id,'.',servicetype_additionalsubservice) = '".$service_id."'")->queryRow() ;

				$search_criteria.= '<br/><b>Service Name :</b> '.$serviced['core_service_name'];
		}
		
		
$statusquery="";
				if($status=="A"){
					$statusquery=" and a.action_status IN('A')";
					//$search_criteria.= '<br/><b>Application Status :</b> Approved';
				}
				else if($status=="R"){
					$statusquery=" and a.action_status IN('R')";
					//$search_criteria.= '<br/><b>Application Status :</b> Rejected';
				}
				else{
					$statusquery=" and a.action_status IN('A','R')";
				}

$records = Yii::app()->db->createCommand("SELECT a.app_Sub_id, a.action_status,
	p.total_amount as total_amount,
		(CASE when p.is_fee_refunded=0 then p.total_amount end) as paid_amt,
					(CASE when p.is_fee_refunded=1 then p.total_amount end) as ref_amt,
	su.iuid, nas.submission_id,
				p.payment_mode, p.transaction_number, p.reference_number,p.bank_name,p.reference_name, p.reference_email, p.created_at, nas.application_status,  cd.company_name as entity_name,
				nas.submission_id as SRN_no,su.email,up.first_name, p.payment_received_by,p.is_fee_refunded
				 
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_new_application_submission nas ON nas.submission_id=a.app_Sub_id
				INNER JOIN sso_users su ON nas.user_id=su.user_id
				INNER JOIN sso_profiles up ON nas.user_id=up.user_id
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				left OUTER Join tbl_payment as p on p.submission_id=a.app_Sub_id
				LEFT OUTER JOIN bo_company_details cd on cd.reg_no = nas.entity_name
                                 
where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
 AND a.service_id='".$service_id."' and a.department_user_id=$officer_id AND r.role_id=84 $statusquery order by p.created_at desc")->queryAll();
 


		$content = $this->renderPartial('level3pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'status'=>$status], true);
		

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	

	public function actionLevel1pdf(){
		$name = "Officer_productivity_Report_level1_".time().".pdf";			
		$heading = 'Officer Productivity Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
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
		
		

		$records = Yii::app()->db->createCommand("SELECT u.*,
				COUNT(CASE WHEN a.action_status = 'A' THEN 1 END) AS approved,
			    COUNT(CASE WHEN a.action_status = 'R' THEN 1 END) AS reject  
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				
				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND r.role_id=84 $uidsql  group by a.department_user_id")->queryAll();

	 $sql1 = "SELECT 
     COUNT(CASE WHEN nas.application_status IN ('P','F','AB','FA') THEN 1 END) AS Pending_For_Approval    
     FROM bo_new_application_submission as nas 
    INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
      where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'";

    $app_count = Yii::app()->db->createCommand($sql1)->queryRow();

		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'app_count'=>$app_count], true);
		

		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	
	public function actionLevel2pdf(){
		$name = "officer_productivity_Report_level2_".time().".pdf";			
		$heading = 'Officer Productivity Report Level 2';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$officer_id = $_GET['officer_id'];
		
		$services_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($services_id){
			$sid = implode(',', $services_id);
			$sidsql = "AND a.service_id IN ($sid)";
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();
			$search_criteria = '<b>Service Name :</b> '.$serviced['services'];
		}else{
			$sidsql = '';
			$search_criteria = '<b>Service Name : </b>All Services';
		}
		
		/*$records = Yii::app()->db->createCommand("SELECT u.*,sp.core_service_name,a.app_Sub_id,a.action_status, a.created
				 
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN bo_information_wizard_service_parameters as sp ON a.service_id=CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)

				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND r.role_id=84 AND a.department_user_id=$officer_id 
					AND a.action_status IN ('A','R')
				AND  sp.is_active='Y'")->queryAll();*/
				
				$records = Yii::app()->db->createCommand("SELECT u.*,sp.core_service_name,a.app_Sub_id, 
				COUNT(CASE WHEN a.action_status = 'A' THEN 1 END) AS approved,
			    COUNT(CASE WHEN a.action_status = 'R' THEN 1 END) AS reject  
				FROM bo_infowiz_form_builder_application_log as a
				INNER JOIN bo_user as u ON u.uid=a.department_user_id
				INNER JOIN bo_user_role_mapping as r ON r.user_id=u.uid
				INNER JOIN bo_information_wizard_service_parameters as sp ON a.service_id=CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
				where DATE(a.created) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND r.role_id=84  AND a.department_user_id=$officer_id  AND sp.is_active='Y' AND a.action_status IN ('A','R') group by a.service_id")->queryAll();
		
		$content = $this->renderPartial('level2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'records'=>$records,'services_id'=>$services_id], true);

		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	
}