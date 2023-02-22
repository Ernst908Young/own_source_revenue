<?php

class TimelineController extends Controller {
	public function actionLevel1(){
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND nas.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		

		$sql = "SELECT nas.service_id, s.service_id as sid, s.core_service_name,
		 COUNT(CASE WHEN nas.application_status IN ('I','DP') THEN 1 END) AS Draft,
		 COUNT(CASE WHEN nas.application_status IN ('PD') THEN 1 END) AS Payment_Due,
		 COUNT(CASE WHEN nas.application_status IN ('P','F','AB','FA') THEN 1 END) AS Pending_For_Approval,
		 COUNT(CASE WHEN nas.application_status IN ('A') THEN 1 END) AS Approved,
		 COUNT(CASE WHEN nas.application_status IN ('H') THEN 1 END) AS Reverted,
		 COUNT(CASE WHEN nas.application_status IN ('R','Z','W') THEN 1 END) AS Others

		FROM bo_new_application_submission as nas	
		INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
			where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'  $sidsql GROUP BY nas.service_id";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records]);
	}

	public function actionLevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = $_GET['service_id'];

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
				
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;
		

		/*if($srn_no==NULL){
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
			

		$sql = "SELECT nas.*, up.first_name, up.last_name, up.surname,u.iuid, s.service_id as sid, s.core_service_name, u.email,(SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as company_name,
			nas.print_app_call_back_url, nas.download_certificate_call_back_url, s.is_certificate
				FROM bo_new_application_submission as nas	
		INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
		INNER JOIN sso_users u ON nas.user_id = u.user_id
		INNER JOIN sso_profiles up ON nas.user_id = up.user_id		
			where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'  $ser_status_con AND nas.service_id='".$service_id."'";

			$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('level2',['from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'ser_status'=>$ser_status,'entity'=>$entity]);

	}

	public function actionLevel3(){

	
		$sub_id = $_GET['sub_id'];
		$service_id = $_GET['service_id'];

	/*	$sql = "SELECT * FROM bo_sp_application_history where app_id=$sub_id";
			$records = Yii::app()->db->createCommand($sql)->queryAll();
		*/
		$this->render('level3',['service_id'=>$service_id,'sub_id'=>$sub_id]);

	}

	

	public function actionLevel1pdf(){
		$name = "Timeline_Report_level1_".time().".pdf";			
		$heading = 'Timeline Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND nas.service_id IN ($sid)";
			$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();

			$search_criteria = '<b>Service Name :</b> '.$serviced['services'];
		}else{
			$sidsql = '';
			$search_criteria = '<b>Service Name : </b>All Services';
		}

	
		$sql = "SELECT nas.service_id, s.service_id as sid, s.core_service_name,
		 COUNT(CASE WHEN nas.application_status IN ('I','DP') THEN 1 END) AS Draft,
		 COUNT(CASE WHEN nas.application_status IN ('PD') THEN 1 END) AS Payment_Due,
		 COUNT(CASE WHEN nas.application_status IN ('P','F','AB','FA') THEN 1 END) AS Pending_For_Approval,
		 COUNT(CASE WHEN nas.application_status IN ('A') THEN 1 END) AS Approved,
		 COUNT(CASE WHEN nas.application_status IN ('H') THEN 1 END) AS Reverted,
		 COUNT(CASE WHEN nas.application_status IN ('R','Z','W') THEN 1 END) AS Others

		FROM bo_new_application_submission as nas	
		INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
			where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'  $sidsql GROUP BY nas.service_id";

		$records = Yii::app()->db->createCommand($sql)->queryAll();

		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id], true);


		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	
	public function actionLevel2pdf(){
		$name = "Timeline_Report_level2_".time().".pdf";			
		$heading = 'Timeline Report Level  2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = $_GET['service_id'];
		
		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
				
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;
		
		if($service_id){
			$sid = $service_id;
			$sidsql = "AND nas.service_id=$sid";
			$serviced = Yii::app()->db->createCommand("SELECT service_name as services from bo_information_wizard_service_master Where id = $sid")->queryRow();

			$search_criteria = '<b>Service Name :</b> '.$serviced['services'];
		}else{
			$sidsql = '';
			$search_criteria = '<b>Service Name : </b>All Services';
		}
		
		if($ser_status==NULL){
			$ser_status_con = "";
			$search_criteria .= '<br><b>Service Status : </b>All Services Status';
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
			// print_r($statuss);die;
			$ser_status_con = "AND nas.application_status IN (".$statuss.")";	
			$search_criteria .= '<br><b>Service Status : </b>'.$statuss;
		}
		
		
		// print_r($search_criteria);die;
		$sql = "SELECT nas.*, up.first_name, up.last_name, up.surname,u.iuid, s.service_id as sid, s.core_service_name, u.email,(SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as company_name,
			nas.print_app_call_back_url, nas.download_certificate_call_back_url, s.is_certificate
				FROM bo_new_application_submission as nas	
		INNER JOIN bo_information_wizard_service_parameters s ON nas.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
		INNER JOIN sso_users u ON nas.user_id = u.user_id
		INNER JOIN sso_profiles up ON nas.user_id = up.user_id		
			where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y'  $ser_status_con  AND nas.service_id='".$service_id."'";

		$records = Yii::app()->db->createCommand($sql)->queryAll();

		$content = $this->renderPartial('level2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id,'srn_no'=>$srn_no,'ser_status'=>$ser_status,'entity'=>$entity], true);


		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	
	public function actionLevel3pdf(){
		$name = "Timeline_Report_level3_".time().".pdf";			
		$heading = 'Timeline Report Level 3';
		
		$sub_id = $_GET['sub_id'];
		$service_id = $_GET['service_id'];


	
		$content = $this->renderPartial('level3pdf', ['service_id'=>$service_id,'sub_id'=>$sub_id], true);

		 $sername = Yii::app()->db->createCommand("SELECT  s.core_service_name
        FROM bo_information_wizard_service_parameters as s 
   
      where  s.is_active='Y' AND s.service_id='".$service_id."'")->queryRow();    

$search_criteria = '<b>Service Name :</b> '.$sername['core_service_name'] ;
$search_criteria.= '<br><b>SRN :</b> '.$sub_id ;
		Reportformat::generatePdf_l($content,$name,$heading,$from_date=null,$to_date=null,$search_criteria);	
	}

	
}