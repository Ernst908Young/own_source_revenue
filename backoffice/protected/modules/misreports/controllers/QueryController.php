<?php

class QueryController extends Controller {
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
		$t_status = isset($_GET['t_status']) ? ($_GET['t_status']=='All Status' ? NULL : $_GET['t_status']) : NULL;
		// print_r($t_status);die;
		/*if($t_id){			
			$condition.="AND q.querycode=$t_id ";
		}*/
		if($t_type){
			$type = "'" . implode ( "', '", $t_type ) . "'";
			$condition.="AND q.query_type IN (".$type.") ";
		}
		
		if($t_status != ''){	
			
			$condition.="AND q.status =$t_status";		
		}
		// print_r($condition);die;
		$where="";
		$Pendency = isset($_GET['Pendency']) ? $_GET['Pendency'] : NULL;
		
		$sql = "SELECT q.* FROM querymain as q		
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $where $condition order by q.created_on desc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status]);
	}


	

	public function actionLevel1pdf(){
		$name = "Query_level1_".time().".pdf";			
		$heading = 'Query Report Level 1';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$Pendency_arr = [1=>'Between 1-5 days',2=>'Between 6-10 days',3=>'Between 11-15 days',4=>'Between 16-20 days',5=>'Between 21-30 days',6=>'>30 days'];
		
		$condition="";

		$t_id = isset($_GET['t_id']) ? ($_GET['t_id'] ? $_GET['t_id'] : NULL) : NULL;
		$t_type = isset($_GET['t_type']) ? $_GET['t_type'] : NULL;
		$t_status = isset($_GET['t_status']) ? ($_GET['t_status']=='All Status' ? NULL : $_GET['t_status']) : NULL;
		$search_criteria = '';
		if($t_id){	
			$id = implode(',', $t_id);			
			// $id = "'" . implode ( "', '", $t_id ) . "'";
			//$search_criteria = '<br><b>Complaint Id :</b> '.$id;
		}else{
			//$search_criteria = '<br><b>Complaint Id : </b>All Complaint Id';
		}
		if($t_type){
			$type = "'" . implode ( "', '", $t_type ) . "'";
			$condition.="AND q.query_type IN (".$type.") ";
			//$search_criteria .= '<br><b>Complaint  Type :</b> '.$type;
		}else{
			//$search_criteria .= '<br><b>Complaint  Type : </b>All Complaint Type';
		}
		if($t_status != ''){			
			$condition.="AND q.status =$t_status";	
			if($t_status == 0){
				//$search_criteria .= '<br><b>Complaint  Status :</b> '."Closed";
			}elseif($t_status == 1){
				//$search_criteria .= '<br><b>Complaint  Status :</b> '."Open";
			}
			
		}else{
			//$search_criteria .= '<br><b>Complaint  Status : </b>All Complaint Status';
		}
		
		if(isset($_GET['Pendency']) && $_GET['Pendency']){
			$Pendency = $_GET['Pendency'] ;
			if($Pendency){   
        $pem_c = [];  
           foreach ($Pendency as $pk => $pv) {
             $pem_c[$pv] = $pv;
           }
        }
			 $result=array_intersect_key($Pendency_arr,$pem_c);

			//$search_criteria .= '<br><b>Pendency: </b>'.implode(',', $result) ;
		}else{
			$Pendency = NULL;
			//$search_criteria .= '<br><b>Pendency: </b> All';
		}
		
		// print_r($t_status);die;
		$sql = "SELECT q.* FROM querymain as q		
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $condition order by q.created_on desc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'Pendency'=>$Pendency,'t_id'=>$t_id,'t_type'=>$t_type,'t_status'=>$t_status], true);
		

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}


	public function actionLevel2($query_id){
		$qmain = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
			q.mobile_no,
			q.email,
			q.servicecategory,
			q.service_id,
			q.user_id,
			q.querypriority,
			q.subject,
			q.created_on,
			q.status,
			s.service_name,
			sc.category_name
			 FROM querymain as q 
			LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
			LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id    
			WHERE q.id=$query_id")->queryRow();

		$messages = Yii::app()->db->createCommand("SELECT *
			 FROM querymessage			
			WHERE querymain_id=$query_id order by msgdatetime DESC")->queryAll();

		$this->render('level2',['qmain'=>$qmain,'messages'=>$messages]);
	}

	
}