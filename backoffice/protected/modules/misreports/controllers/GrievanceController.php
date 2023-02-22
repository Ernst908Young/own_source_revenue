<?php

class GrievanceController extends Controller {
	public function actionLevel1(){
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$condition="";

		$t_id = isset($_GET['t_id']) ? ($_GET['t_id'] ? $_GET['t_id'] : NULL) : NULL;
		$t_type = isset($_GET['t_type']) ? ($_GET['t_type'] == 'All Type' ? NULL : $_GET['t_type']) : NULL;
		$t_status = isset($_GET['t_status']) ? $_GET['t_status'] : NULL;
			$priority = isset($_GET['priority']) ? $_GET['priority'] : NULL;
		
		/*if($t_id){			
			$condition.="AND t.id=$t_id ";
		}*/
		if($t_type){
			
			$condition.="AND t.category ='".$t_type."'";
		}
		if($t_status){
			$status = "'" . implode ( "', '", $t_status ) . "'";
			$condition.="AND t.status IN (".$status.") ";		
		}
		if($priority){
			$priority_c = "'" . implode ( "', '", $priority ) . "'";
			$condition.="AND t.priority IN (".$priority_c.") ";		
		}

		$where="";
		$Pendency = isset($_GET['Pendency']) ? $_GET['Pendency'] : NULL;
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
		 $sql = "SELECT t.* FROM grievance as t	
			where DATE(t.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $where $condition order by t.created_on desc";
			
		$records = Yii::app()->db->createCommand($sql)->queryAll();
	
		
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status,'priority'=>$priority]);
	}


	

	public function actionLevel1pdf(){
		$name = "Grievance_Report_level1_".time().".pdf";			
		$heading = 'Grievance Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$condition="";

		$t_id = isset($_GET['t_id']) ? ($_GET['t_id'] ? $_GET['t_id'] : NULL) : NULL;
		$t_type = isset($_GET['t_type']) ? ($_GET['t_type'] == 'All Type' ? NULL : $_GET['t_type']) : NULL;
		$t_status = isset($_GET['t_status']) ? $_GET['t_status'] : NULL;
			$priority = isset($_GET['priority']) ? $_GET['priority'] : NULL;
		$search_criteria = '';
		/*if($t_id){			
			$condition.="AND t.id=$t_id ";
		}*/
		if($t_type){
			$condition.="AND t.category ='".$t_type."'";
			//$search_criteria = '<br><b>Grievance  Type :</b> '.$t_type;
		}else{
			//$search_criteria = '<br><b>Grievance  Type : </b>All Grievance Type';
		}
		if($t_status){
			$status = "'" . implode ( "', '", $t_status ) . "'";
			$condition.="AND t.status IN (".$status.") ";		
			//$search_criteria .= '<br><b>Grievance  Status :</b> '.$status;
		}else{
			//$search_criteria .= '<br><b>Grievance  Status : </b>All Grievance Status';
		}
		if($priority){
			$priority_c = "'" . implode ( "', '", $priority ) . "'";
			$condition.="AND t.priority IN (".$priority_c.") ";		
			//$search_criteria .= '<br><b>Priority :</b> '.$priority_c;
		}else{
			//$search_criteria .= '<br><b>Priority: </b>All Priority';
		}

		$where="";
		
		$Pendency_arr = [1=>'Between 1-5 days',2=>'Between 6-10 days',3=>'Between 11-15 days',4=>'Between 16-20 days',5=>'Between 21-30 days',6=>'>30 days'];
 $result=array();
		if(isset($_GET['Pendency']) && $_GET['Pendency']){
			$Pendency = $_GET['Pendency'] ;
			 foreach($Pendency as $v){
				 $result[]=$Pendency_arr[$v];
			 }

			//$search_criteria .= '<br><b>Pendency: </b>'.implode(', ', $result) ;
		}else{
			$Pendency = NULL;
			//$search_criteria .= '<br><b>Pendency: </b> All';
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
		 $sql = "SELECT t.* FROM grievance as t	
			where DATE(t.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $where $condition order by t.created_on desc";
			
		$records = Yii::app()->db->createCommand($sql)->queryAll();
		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status,'priority'=>$priority], true);
		

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionLevel2($g_id){
		
		$grievance = Yii::app()->db->createCommand("SELECT sm.id,
		sm.existing_id,
		sm.priority,
		sm.subject,
		sm.status,
		sm.category,
		sm.currently_assign_to,
		sm.created_on
		FROM grievance as sm   
		WHERE sm.id=$g_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM grievancemsg			
			WHERE grievance_id=$g_id order by msgdatetime DESC")->queryAll();


		$this->render('level2',['grievance'=>$grievance,'messages'=>$messages]);

		
	}
	
}