<?php

class TicketingController extends Controller {
	public function actionLevel1(){
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$condition="";

		$t_id = isset($_GET['t_id']) ? ($_GET['t_id'] ? $_GET['t_id'] : NULL) : NULL;
		
		$t_type = isset($_GET['t_type']) ? $_GET['t_type'] : NULL;
		$t_status = isset($_GET['t_status']) ? $_GET['t_status'] : NULL;
		/*if($t_id){			
			$condition.="AND t.supporttypecode=$t_id ";
		}*/
		if($t_type){
			$type = "'" . implode ( "', '", $t_type ) . "'";
			$condition.="AND t.ticket_type IN (".$type.") ";
		}
		if($t_status){
			$status = "'" . implode ( "', '", $t_status ) . "'";
			$condition.="AND t.status IN (".$status.") ";		
		}



		

		$where="";
		$Pendency = isset($_GET['Pendency']) ? $_GET['Pendency'] : NULL;

		
		
		 $sql = "SELECT t.* FROM supportmain as t	
			where DATE(t.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $where $condition order by t.created_on desc";
			
		$records = Yii::app()->db->createCommand($sql)->queryAll();
	
		
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status]);
	}


	

	public function actionLevel1pdf(){
		$name = "Ticketing_Report_level1_".time().".pdf";			
		$heading = 'Ticketing Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$condition="";
		$t_id = isset($_GET['t_id']) ? ($_GET['t_id'] ? $_GET['t_id'] : NULL) : NULL;
		
		$t_type = isset($_GET['t_type']) ? $_GET['t_type'] : NULL;
		$t_status = isset($_GET['t_status']) ? $_GET['t_status'] : NULL;
		
		$search_criteria = '';
		$Pendency_arr = [1=>'Between 1-5 days',2=>'Between 6-10 days',3=>'Between 11-15 days',4=>'Between 16-20 days',5=>'Between 21-30 days',6=>'>30 days'];
		$result=array();
		if(isset($_GET['Pendency']) && $_GET['Pendency']){
			$Pendency = $_GET['Pendency'] ;
			 foreach($Pendency as $v){
				 $result[]=$Pendency_arr[$v];
			 }

			//$search_criteria = '<b>Pendency: </b>'.implode(', ', $result) ;
		}else{
			$Pendency = NULL;
			//$search_criteria = '<b>Pendency: </b> All';
		}
		if($t_id){	
			$id = implode(',', $t_id);
			//$search_criteria .= '<br><b>Ticket Id :</b> '.$id;
		}else{
			//$search_criteria .= '<br><b>Ticket Id : </b>All Ticket Id';
		}
		if($t_type){
			// $type = implode(',', $t_type);
			$type = "'" . implode ( "', '", $t_type ) . "'";
			$condition.="AND t.ticket_type IN (".$type.") ";
			//$search_criteria .= '<br><b>Ticket Type :</b> '.$type;
		}else{
			//$search_criteria .= '<br><b>Ticket Type : </b>All Ticket Type';
		}
		
		if($t_status){
			// $status = implode(',', $t_status);
			$status = "'" . implode ( "', '", $t_status ) . "'";
			$condition.="AND t.status IN (".$status.") ";
			
			//$search_criteria .= '<br><b>Ticket Status :</b> '.$status;			
		}else{
			//$search_criteria .= '<br><b>Ticket Status : </b>All Ticket Status';
		}
		
		$where="";
	if(is_array($Pendency) && count($Pendency)>0){
			$min_days=array(1=>1,2=>6,3=>11,4=>16,5=>21,6=>30);
			$max_days=array(1=>5,2=>10,3=>15,4=>20,5=>30,6=>30);
			foreach($Pendency as $v){
				if($where!=""){
					$where.=" OR ";
				}
				else{
					$where.=" AND ";
				}
				if($v==6)
					$where.=" (DATE(created_on)<DATE_SUB(CURDATE(), INTERVAL 30 DAY))";
				
				else
				$where.=" (DATE(created_on)>=DATE_SUB(CURDATE(), INTERVAL $max_days[$v] DAY) AND DATE(created_on)<=DATE_SUB(CURDATE(), INTERVAL $min_days[$v] DAY))";
			}
		}
		;
		  $sql = "SELECT t.* FROM supportmain as t	
			where DATE(t.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $where $condition order by t.created_on desc";
			
		$records = Yii::app()->db->createCommand($sql)->queryAll();
	
		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status], true);
		

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionLevel2($t_id){
		
		$ticket = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
			sm.supporttypecode,
			sm.servicecategory,
			sm.supportprioritycode,
			sm.subject,
			sm.status,
			sm.service_id,
			sm.srn_app_id,
			sm.created_on,
			sm.currently_assign_to,
			s.service_name,
			sc.category_name
			 FROM supportmain as sm 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id   
			WHERE sm.supportmaincode=$t_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM supportmessages			
			WHERE supportmaincode=$t_id order by msgdatetime DESC")->queryAll();


		$this->render('level2',['ticket'=>$ticket,'messages'=>$messages]);

		
	}
	
}