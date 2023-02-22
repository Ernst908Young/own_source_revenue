<?php

class CloseentityController extends Controller {

	public function actionCeased(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$entity = isset($_GET['entity']) ? $_GET['entity'] : NULL;
		$records = Yii::app()->db->createCommand("SELECT ld.entity_no, ld.latest_entity_name, ld.updated_on as ceased_on, ld.service_id,l.created as registered_on
			
			FROM entity_application_latest_data as ld
			INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=ld.srn_no) AND (l.action_status='A'))	
			WHERE changed_from_service_id IN ('43.0') AND DATE(ld.updated_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' ORDER BY ld.updated_on DESC")->queryAll();

		$this->render('ceased',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'entity'=>$entity]);
	}
	
	public function actionCeasedpdf(){
		$name = "Ceased_Business_Names_Summary_".time().".pdf";			
		$heading = 'Ceased Business Names Report';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$entity = isset($_GET['entity']) ? $_GET['entity'] : NULL;
		
		$search_criteria =  "";
		$records = Yii::app()->db->createCommand("SELECT ld.entity_no, ld.latest_entity_name, ld.updated_on as ceased_on, ld.service_id,l.created as registered_on
			
			FROM entity_application_latest_data as ld
			INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=ld.srn_no) AND (l.action_status='A'))	
			WHERE changed_from_service_id IN ('43.0') AND DATE(ld.updated_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' ORDER BY ld.updated_on DESC")->queryAll();

		
		
		$content = $this->renderPartial('ceasedpdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'entity'=>$entity],true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);
		
	}
	
	
	public function actionDissolved(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$entity = isset($_GET['entity']) ? $_GET['entity'] : NULL;
		$records = Yii::app()->db->createCommand("SELECT ld.entity_no, ld.latest_entity_name, ld.updated_on as dissolved_on, ld.service_id,l.created as registered_on
			
			FROM entity_application_latest_data as ld
			INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=ld.srn_no) AND (l.action_status='A'))	
			WHERE changed_from_service_id IN ('41.0','42.0') AND DATE(ld.updated_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' ORDER BY ld.updated_on DESC")->queryAll();

	//	$records = [];
		$this->render('dissolved',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'entity'=>$entity]);
	}
	
	public function actionDissolvedpdf(){
		
		$name = "Dissolved_Business_Names_Summary_".time().".pdf";			
		$heading = 'Dissolved Business Names Report';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$entity = isset($_GET['entity']) ? $_GET['entity'] : NULL;
		
		if($entity){			
		    
		    $search_criteria = '<b>Entity Type  :</b> ';
		    foreach ($entity as $key => $value) {
				$search_criteria != "" && $search_criteria .= ", ";
				if($value == '4.0'){
					$search_criteria.= "Incorporation Of Company" ;
				}else if($value == '5.0'){
					$search_criteria.= "Non Profit Company" ;
				}else if($value == '8.0'){
					$search_criteria.= "External Company" ;
				}else if($value == '9.0'){
					$search_criteria.= "Society" ;
				}
		    }			

		}else{
			
			$search_criteria = '<b>Entity Type  : </b>All Entity Type';
		}
		
		/* if($entity){			
		    $entity_no = implode('","', $entity);
			$search_criteria = '<b>Entity Type : </b> '.($entity_no == 4.0 ? "Incorporation Of Company" : ($entity_no == 5.0 ? "Non Profit Company" : ($entity_no == 8.0 ? "External Company" : "Society" ))); 

		}else{
			
			$search_criteria = '<b>Entity : </b>All Entity Type ';
		}  */

		// print_r($search_criteria);die();
		
		
		$records = Yii::app()->db->createCommand("SELECT ld.entity_no, ld.latest_entity_name, ld.updated_on as dissolved_on, ld.service_id,l.created as registered_on
			
			FROM entity_application_latest_data as ld
			INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=ld.srn_no) AND (l.action_status='A'))	
			WHERE changed_from_service_id IN ('41.0','42.0') AND DATE(ld.updated_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' ORDER BY ld.updated_on DESC")->queryAll();

	
		$content = $this->renderPartial('dissolvedpdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'entity'=>$entity],true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);
	}
}