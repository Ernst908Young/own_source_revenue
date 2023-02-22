<?php

class ServicesController extends Controller {

	

	public function actionInaslevel1(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$category = isset($_GET['sc']) ? $_GET['sc'] : NULL;


		$records = Yii::app()->db->createCommand("SELECT service_id , COUNT(submission_id) as applications      
              FROM bo_new_application_submission 
               WHERE DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'
           GROUP BY service_id")->queryAll();
		$f_records = [];
		foreach($records as $key => $value) {
			$f_records[$value['service_id']] = $value['applications'];
		}
		/*print_r($f_records); die();*/

		$f_arr = [];
		if(!empty($f_records)){
			$cat_arr = Servicecategory::categorywithservices();
			foreach ($cat_arr as $key => $value) {
				foreach ($f_records as $k => $val) {
					if(in_array($k, $value)){
						if(array_key_exists($key, $f_arr)){
							$f_arr[$key] = $f_arr[$key]+$val;
						}else{
							$f_arr[$key] = $val;
						}
					}
				}
			}
		}


		

		$this->render('inaslevel1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'f_arr'=>$f_arr,'category'=>$category]);
			

	}

	public function actionInaslevel1pdf(){
		
		$name = "Incorporation_Analysis_Report_Summary_".time().".pdf";			
		$heading = 'Incorporation Analysis Report';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$category = isset($_GET['sc']) ? $_GET['sc'] : NULL;
		
		if($category){			
		    
		    $search_criteria = '<b>Director :</b> ';
		    foreach ($category as $key => $value) {
				$search_criteria != "" && $search_criteria .= ", ";
		    	$search_criteria.= $value ;
		    }			

		}else{
			
			$search_criteria = '<b>Directors : </b>All ';
		}
		
		
		
		
		
		$records = Yii::app()->db->createCommand("SELECT service_id , COUNT(submission_id) as applications      
              FROM bo_new_application_submission 
               WHERE DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'
           GROUP BY service_id")->queryAll();
		   
		 
		$f_records = [];
		foreach($records as $key => $value) {
			$f_records[$value['service_id']] = $value['applications'];
		}
		/*print_r($f_records); die();*/

		$f_arr = [];
		if(!empty($f_records)){
			$cat_arr = Servicecategory::categorywithservices();
			foreach ($cat_arr as $key => $value) {
				foreach ($f_records as $k => $val) {
					if(in_array($k, $value)){
						if(array_key_exists($key, $f_arr)){
							$f_arr[$key] = $f_arr[$key]+$val;
						}else{
							$f_arr[$key] = $val;
						}
					}
				}
			}
		}

		$content = $this->renderPartial('inaslevel1pdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'category'=>$category,'f_arr'=>$f_arr],true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	

	}

	public function actionInaslevel2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$category[] = isset($_GET['category']) ? base64_decode($_GET['category']) : NULL;

		$cat_arr = Servicecategory::categorywithservices($category);

		//print_r($cat_arr); die();

		if($cat_arr){
			$sid = implode(',', $cat_arr);
			$sidsql = "AND a.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}

		$sn = isset($_GET['sn']) ? $_GET['sn'] : NULL;

	$records = Yii::app()->db->createCommand("SELECT a.service_id , COUNT(a.submission_id) as applications, bosp.core_service_name 
      FROM bo_new_application_submission a
      INNER JOIN bo_information_wizard_service_parameters bosp
		ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
       WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql  AND bosp.is_active='Y' GROUP BY a.service_id
   ")->queryAll();

		$this->render('inaslevel2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'category'=>base64_decode($_GET['category']),'cat_arr'=>$cat_arr,'sn'=>$sn]);
	}
	
	public function actionInaslevel2pdf(){
		
		$name = "INCORPORATION_ANALYSIS_REPORT_LEVEL2_Summary_".time().".pdf";			
		$heading = 'INCORPORATION ANALYSIS REPORT LEVEL 2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$category[] = isset($_GET['category']) ? base64_decode($_GET['category']) : NULL;

		$cat_arr = Servicecategory::categorywithservices($category);

		//print_r($cat_arr); die();

		if($cat_arr){
			$sid = implode(',', $cat_arr);
			$sidsql = "AND a.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}

		$sn = isset($_GET['sn']) ? $_GET['sn'] : NULL;
		if(!empty($sn)){
			$sid = implode(',', $sn);
			 $search_criteria = '<b>Service Name :</b> '.$sid;
			
		}else{
			$search_criteria = '<b>Service Name :</b> All Service';
		}
		
	$records = Yii::app()->db->createCommand("SELECT a.service_id , COUNT(a.submission_id) as applications, bosp.core_service_name 
      FROM bo_new_application_submission a
      INNER JOIN bo_information_wizard_service_parameters bosp
		ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
       WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql  AND bosp.is_active='Y' GROUP BY a.service_id
   ")->queryAll();

		$content = $this->renderPartial('inaslevel2pdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'category'=>base64_decode($_GET['category']),'cat_arr'=>$cat_arr,'sn'=>$sn],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}
	


	public function actionInaslevel3(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? $_GET['service_id'] : 0) : 0;
		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? $_GET['subservice_id'] : 0) : 0;
		}else{
			$subservice_id = 0;
		}	

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;	
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		/*if($srn_no==NULL){
			$srn_no_con = "";
		}else{
			$srn_no_con = "AND a.submission_id=$srn_no";
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
			
			$ser_status_con = "AND a.application_status IN (".$statuss.")";			
		}

		$records = Yii::app()->db->createCommand("SELECT a.submission_id, a.application_status, a.application_created_date, a.field_value, a.print_app_call_back_url, a.download_certificate_call_back_url, s.is_certificate
      FROM bo_new_application_submission a     
      INNER JOIN bo_information_wizard_service_parameters s ON a.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
       WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y' $ser_status_con AND a.service_id='".$service_id."' ORDER BY a.application_created_date DESC
   ")->queryAll();

			$this->render('inaslevel3',['subservice_id'=>$subservice_id,'from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'ser_status'=>$ser_status]);

	}
	
	public function actionInaslevel3pdf(){
		
		$name = "INCORPORATION_ANALYSIS_REPORT_LEVEL3_Summary_".time().".pdf";			
		$heading = 'INCORPORATION ANALYSIS REPORT LEVEL 3';
		// print_r($_GET);die;
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['service_id']) ? ($_GET['service_id'] ? $_GET['service_id'] : 0) : 0;
		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? $_GET['subservice_id'] : 0) : 0;
			
		}else{
			$subservice_id = 0;
		}	

		$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		if(!empty($srn_no)){
			$sid = implode(',', $srn_no);
			 $search_criteria = '<b>Srn No. :</b> '.$sid;
			
		}else{
			$search_criteria = '<b>Srn No.:</b> All Srn';
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
			
			$ser_status_con = "AND a.application_status IN (".$statuss.")";			
		}
		
		$records = Yii::app()->db->createCommand("SELECT a.submission_id, a.application_status, a.application_created_date, a.field_value, a.print_app_call_back_url, a.download_certificate_call_back_url, s.is_certificate
      FROM bo_new_application_submission a     
      INNER JOIN bo_information_wizard_service_parameters s ON a.service_id = CONCAT(s.service_id,'.',s.servicetype_additionalsubservice)
       WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.is_active='Y' $ser_status_con AND a.service_id='".$service_id."' ORDER BY a.application_created_date DESC
   ")->queryAll();

			$content = $this->renderPartial('inaslevel3pdf',['subservice_id'=>$subservice_id,'from_date'=>$from_date,'to_date'=>$to_date,'service_id'=>$service_id,'records'=>$records,'srn_no'=>$srn_no,'ser_status'=>$ser_status],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);

	}
	
}