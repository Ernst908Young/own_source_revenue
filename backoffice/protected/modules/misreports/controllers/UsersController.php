<?php
require_once(Yii::app()->basePath.'/extensions/excelexport/XlsExporter.php');
class UsersController extends Controller {

	public function actionFo(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

	
		$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : NULL;

		if($user_type){
			$sid = implode(',', $user_type);
			$sidsql = "AND u.user_type IN ($sid)";
		}else{
			$sidsql = '';
		}
	
		$records = $this->fouserrecords($from_date, $to_date, $sidsql);

		$this->render('fo',['from_date'=>$from_date,'to_date'=>$to_date,'user_type'=>$user_type,'records'=>$records]);

	}


	

	public function actionFopdf(){
		$name = "Registered_Users_Applicants_Report_".time().".pdf";			
		$heading = 'Registered Users Applicants Report';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : NULL;
		$user_type_arr = [1=>'Individual User',2=>'Registered Agent', 3=>'Sub User', 4=>'Other'];

		if($user_type){
			$sid = implode(',', $user_type);
			$sidsql = "AND u.user_type IN ($sid)";
				//$serviced = Yii::app()->db->createCommand("SELECT group_concat(service_name separator ', ') as services from bo_information_wizard_service_master Where id IN ($sid)")->queryRow();
		    
		    $search_criteria = '<b>User Type :</b> ';
		    foreach ($user_type as $key => $value) {
				
		    	$search_criteria.= $user_type_arr[$value];
		    }
			

		}else{
			$sidsql = '';
			$search_criteria = '<b>User Type : </b>All Users Type';
		}
		
		$records = $this->fouserrecords($from_date, $to_date, $sidsql);

		$content = $this->renderPartial('fopdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'user_type'=>$user_type,'user_type_arr'=>$user_type_arr], true);

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	function fouserrecords($from_date, $to_date, $sidsql){

		
		$records = Yii::app()->db->createCommand("SELECT u.user_id as user_id, u.mobile_no, u.email, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name, 
			CONCAT(p.address,' ',p.address2,' ',p.city_name,' ',lc.lr_name,' ', ls.lr_name,' ',p.pin_code) as address,
			 case
		        when user_type = 1 then 'Individual User'
		        when user_type = 2 then 'Registered Agent'
		        when user_type = 3 then 'Sub User'
		        when user_type = 4 then 'Other'
		        else 'NA'
		    end AS user_type
			
				FROM sso_users as u
				INNER JOIN sso_profiles p ON p.user_id = u.user_id		
				LEFT OUTER JOIN bo_landregion lc ON p.country_name = lc.lr_id
				LEFT OUTER JOIN bo_landregion ls ON p.state_name = ls.lr_id	
				where DATE(u.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
				 $sidsql ORDER BY u.created_on DESC")->queryAll();
		return $records ;

	}

	public function actionDownload() {
		
		$name = "Registered_Users_Applicants_Report_".time().".xls";			
		$heading = 'Registered Users Applicants Report';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : NULL;
		$user_type_arr = [1=>'Individual User',2=>'Registered Agent', 3=>'Sub User', 4=>'Other'];

		if($user_type){
			$sid = implode(',', $user_type);
			$sidsql = "AND u.user_type IN ($sid)";
		
		    
		    $search_criteria = '<b>User Type :</b> ';
		    foreach ($user_type as $key => $value) {
		    	$search_criteria.= $user_type_arr[$value];
		    }
			

		}else{
			$sidsql = '';
			$search_criteria = '<b>User Type : </b>All Users Type';
		}


		$fields = array('sr_no','full_name', 'address','email','mobile_no', 'user_type');
		$label = ['SR. No.','Full Name','Address','Email','Mobile Number','User Type'];
	    
	    $records = $this->fouserrecords($from_date, $to_date, $sidsql);

		XlsExporter::downloadXls($name, $records, $heading, 'Report Header', $label ,$fields, $from_date, $to_date, $search_criteria);
}

public function actionDirector(){
	if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$dfn = isset($_GET['dfn']) ? $_GET['dfn'] : NULL;

		$records_main = $this->getdirectorsrecords_each($from_date,$to_date);

		//print_r($records_main); die();

		$this->render('director',['from_date'=>$from_date,'to_date'=>$to_date,'records_main'=>$records_main,'dfn'=>$dfn]);
}

public function actionDirectorpdf(){
		$name = "Directors_Report_".time().".pdf";			
		$heading = 'Directors  Report';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$dfn = isset($_GET['dfn']) ? $_GET['dfn'] : NULL;
		
		if($dfn){			
		    
		    $search_criteria = '<b>Director :</b> ';
		    foreach ($dfn as $key => $value) {
				$search_criteria != "" && $search_criteria .= ", ";
		    	$search_criteria.= $value;
		    }			

		}else{
			
			$search_criteria = '<b>Directors : </b>All ';
		}
		
		$records_main = $this->getdirectorsrecords_each($from_date,$to_date);
		

		$content = $this->renderPartial('directorpdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records_main'=>$records_main,'dfn'=>$dfn], true);

		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionDirectorl1(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$dfn = isset($_GET['dfn']) ? $_GET['dfn'] : NULL;

		$records_main = $this->getdirectorsrecords($from_date,$to_date);

		//print_r($records_main); die();

		$this->render('director_level1',['from_date'=>$from_date,'to_date'=>$to_date,'records_main'=>$records_main,'dfn'=>$dfn]);

	}
	public function actionDirectorlevel1Pdf(){
		$name = "Director’s_Cross_Reference_Summary_".time().".pdf";			
		$heading = 'Director’s Cross Reference Report';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		
		$dfn = isset($_GET['dfn']) ? $_GET['dfn'] : NULL;
		
		// $search_criteria = NULL;
		if($dfn){			
		    
		    $search_criteria = '<b>Director :</b> ';
		    foreach ($dfn as $key => $value) {
				$search_criteria != "" && $search_criteria .= ", ";
		    	$search_criteria.= $value;
		    }			

		}else{
			
			$search_criteria = '<b>Directors : </b>All ';
		}
		
		$records = $this->getdirectorsrecords($from_date,$to_date);

		
		$content = $this->renderPartial('director_level1pdf',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'dfn'=>$dfn],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionDirectorl2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$director = isset($_GET['directors']) ? base64_decode($_GET['directors']) : "";
		
		$is_active =  isset($_GET['is_active']) ? ($_GET['is_active']=='All Status'?NULL:$_GET['is_active']) : NULL;

		$entity = isset($_GET['entity']) ? $_GET['entity'] : "";
		

		$records_main = $this->getdirectorsrecords($from_date,$to_date);
		
		$f_record = $records_main[$director];
		
		$this->render('director_level2',['from_date'=>$from_date,'to_date'=>$to_date,'records_main'=>$records_main,'director'=>$director,'f_record'=>$f_record,'is_active'=>$is_active,'entity'=>$entity]);

	}
	
	public function actionLevel2pdf(){
		$name = "DIRECTOR’S_CROSS_REFERENCE_REPORT_LEVEL2_".time().".pdf";			
		$heading = 'DIRECTOR’S CROSS REFERENCE REPORT LEVEL 2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$director = isset($_GET['directors']) ? base64_decode($_GET['directors']) : "";
		// print_r($director);die;
		$is_active =  isset($_GET['is_active']) ? ($_GET['is_active']=='All Status'?NULL:$_GET['is_active']) : NULL;

		$entity = isset($_GET['entity']) ? $_GET['entity'] : "";
		if(!empty($entity)){
			$sid = implode(',', $entity);
			 $search_criteria = '<b>Entity Name :</b> '.$sid;
			
		}else{
			$search_criteria = '<b>Entity Name:</b> ';
		}
		
		
		$records_main = $this->getdirectorsrecords($from_date,$to_date);
		
		$f_record = $records_main[$director];

		$content = $this->renderPartial('director_level2pdf',['from_date'=>$from_date,'to_date'=>$to_date,'records_main'=>$records_main,'director'=>$director,'f_record'=>$f_record,'is_active'=>$is_active,'entity'=>$entity],true);
		
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);

	}
	

	function getdirectorsrecords($from_date,$to_date){
		$records = Yii::app()->db->createCommand("SELECT a.service_id, a.submission_id, a.entity_name, a.field_value, ld.changed_from_service_id, ld.changed_from_srn_no, ld.field_value as updated_field, a.application_created_date
			FROM bo_new_application_submission a 
			left outer JOIN entity_application_latest_data ld ON ((a.service_id=ld.service_id) AND (a.entity_name=ld.entity_no))
			WHERE a.service_id IN ('4.0','5.0','8.0') AND DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryAll();
		
		$records_main = [];
		foreach ($records as $k => $val) {

			$for_date = Yii::app()->db->createCommand("SELECT updated_by_srn, created_on as app_date, field_value FROM  entity_application_data_log WHERE updated_by_service_id='13.0' AND entity_no='".$val['entity_name']."' ORDER BY id DESC")->queryAll();

			if($for_date){

				$arr = json_decode($for_date[0]['field_value'],true);
				$app_date = $for_date[0]['app_date'];
				$data = 'updated';
				$srn_no = $for_date[0]['updated_by_srn'];

				foreach ($for_date as $k => $v) {
						$cesr = Yii::app()->db->createCommand("SELECT a.service_id, a.submission_id, a.entity_name, a.field_value
							FROM bo_new_application_submission a 
							WHERE submission_id='".$v['updated_by_srn']."'
							")->queryRow();
					$carr = json_decode($cesr['field_value'],true);

					if(isset($carr['UK-FCL-00431_0'])){
  							if(is_array($carr['UK-FCL-00431_0'])){         
     							foreach ($carr['UK-FCL-00431_0'] as $key => $value) { 
     								$records_main[$value.' '.@$carr['UK-FCL-00432_0'][$key] .' '.@$carr['UK-FCL-00433_0'][$key]][$val['entity_name']] = ['address'=>(@$carr['UK-FCL-00434_0'][$key].' '.@$carr['UK-FCL-00435_0'][$key].' '.@$carr['UK-FCL-00436_0'][$key].' '.@$carr['UK-FCL-00438_0'][$key].' '.@$carr['UK-FCL-00437_0'][$key].' '.@$carr['UK-FCL-00439_0'][$key]),'app_date'=>$v['app_date'],'data'=>'deactivated','service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						
				}	

			}else{
				$arr = json_decode($val['field_value'],true);
				$app_date = $val['application_created_date'];
				$data = 'new';
				$srn_no = $val['submission_id'];
			}

		

			switch ($val['service_id']) {
					case '4.0':
						if(isset($arr['UK-FCL-00132_0'])){
  							if(is_array($arr['UK-FCL-00132_0'])){         
     							foreach ($arr['UK-FCL-00132_0'] as $key => $value) { 
     								$records_main[$value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]][$val['entity_name']] = ['address'=>(@$arr['UK-FCL-00093_0'][$key].' '.@$arr['UK-FCL-00309_0'][$key].' '.@$arr['UK-FCL-00310_0'][$key].' '.@$arr['UK-FCL-00372_0'][$key].' '.@$arr['UK-FCL-00096_0'][$key].' '.@$arr['UK-FCL-00094_0'][$key]),'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						break;
					case '5.0':
					 if(isset($arr['UK-FCL-00150_0'])){
   						if(is_array($arr['UK-FCL-00150_0'])){
   							if($data =='new'){
   								$faltu = count($arr['UK-FCL-00150_0'])/2;
   								for ($key = 0; $key < $faltu; $key++) {
   									$records_main[@$arr['UK-FCL-00150_0'][$key].' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]][$val['entity_name']] = ['address'=>(@$arr['UK-FCL-00107_0'][$key].' '.@$arr['UK-FCL-00390_0'][$key].' '.@$arr['UK-FCL-00463_0'][$key].' '.@$arr['UK-FCL-00383_0'][$key].' '.@$arr['UK-FCL-00400_0'][$key].' '.@$arr['UK-FCL-00320_0'][$key]),'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
   								}
   							}else{

   								foreach ($arr['UK-FCL-00150_0'] as $key => $value) { 
     								$records_main[$value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]][$val['entity_name']] = ['address'=>(@$arr['UK-FCL-00107_0'][$key].' '.@$arr['UK-FCL-00390_0'][$key].' '.@$arr['UK-FCL-00463_0'][$key].' '.@$arr['UK-FCL-00383_0'][$key].' '.@$arr['UK-FCL-00400_0'][$key].' '.@$arr['UK-FCL-00320_0'][$key]),'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
     							}
   							}                 				
     					}
     				}	
					break;
					case '8.0':
						if(isset($arr['UK-FCL-00132_0'])){
  							if(is_array($arr['UK-FCL-00132_0'])){         
     							foreach ($arr['UK-FCL-00132_0'] as $key => $value) { 
     								$records_main[$value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]][$val['entity_name']] = ['address'=>(@$arr['UK-FCL-00093_0'][$key].' '.@$arr['UK-FCL-00309_0'][$key].' '.@$arr['UK-FCL-00310_0'][$key].' '.@$arr['UK-FCL-00372_0'][$key].'  '.@$arr['UK-FCL-00096_0'][$key].' '.@$arr['UK-FCL-00094_0'][$key]),'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						break;
					
					default:
						
						break;
				}
		}
		
		return $records_main;
	}


	


	function getdirectorsrecords_each($from_date,$to_date){
		$records = Yii::app()->db->createCommand("SELECT a.service_id, a.submission_id, a.entity_name, a.field_value, a.field_value as updated_field, a.application_created_date,cd.company_name as entity_company_name, cd.address as company_address
			FROM bo_new_application_submission a 			
			INNER JOIN bo_company_details cd on ((cd.reg_no = a.entity_name) AND cd.service_id IN ('4.0','5.0','8.0'))
			WHERE a.service_id IN ('4.0','5.0','8.0') AND DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryAll();

		$records_main = [];
		foreach ($records as $k => $val) {
			 $reg_date = Yii::app()->db->createCommand("SELECT created FROM bo_infowiz_form_builder_application_log where app_Sub_id = ".$val['submission_id']." and action_status='P' order BY id ASC")->queryScalar();
			/*$for_date = Yii::app()->db->createCommand("SELECT updated_by_srn, created_on as app_date, field_value FROM  entity_application_data_log WHERE updated_by_service_id='13.0' AND entity_no='".$val['entity_name']."' ORDER BY id DESC")->queryAll();

			if($for_date){

				$arr = json_decode($for_date[0]['field_value'],true);
				$app_date = $for_date[0]['app_date'];
				$data = 'updated';
				$srn_no = $for_date[0]['updated_by_srn'];

				foreach ($for_date as $k => $v) {
						$cesr = Yii::app()->db->createCommand("SELECT a.service_id, a.submission_id, a.entity_name, a.field_value
							FROM bo_new_application_submission a 
							WHERE submission_id='".$v['updated_by_srn']."'
							")->queryRow();
					$carr = json_decode($cesr['field_value'],true);

					if(isset($carr['UK-FCL-00431_0'])){
  							if(is_array($carr['UK-FCL-00431_0'])){         
     							foreach ($carr['UK-FCL-00431_0'] as $key => $value) { 
     								$records_main[] = [
     									'name'=>($value.' '.@$carr['UK-FCL-00432_0'][$key] .' '.@$carr['UK-FCL-00433_0'][$key]),
     									'entity_reg_no'=>$val['entity_name'],
     								'entity_name'=>$val['entity_company_name'],
     									'address'=>(@$carr['UK-FCL-00434_0'][$key].' '.@$carr['UK-FCL-00435_0'][$key].' '.@$carr['UK-FCL-00436_0'][$key].' '.@$carr['UK-FCL-00438_0'][$key].' '.@$carr['UK-FCL-00437_0'][$key].' '.@$carr['UK-FCL-00439_0'][$key]),'app_date'=>$v['app_date'],'data'=>'deactivated','service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						
				}	

			}else{*/
				$arr = json_decode($val['field_value'],true);
				$app_date = $val['application_created_date'];
				$data = 'new';
				$srn_no = $val['submission_id'];
			//}


			switch ($val['service_id']) {
					case '4.0':
						if(isset($arr['UK-FCL-00132_0'])){
  							if(is_array($arr['UK-FCL-00132_0'])){         
     							foreach ($arr['UK-FCL-00132_0'] as $key => $value) { 
     								//
     								$records_main[] = [
     								'name'=>(
     								 $value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key] ),
     								'entity_reg_no'=>$val['entity_name'],
     								'entity_name'=>$val['entity_company_name'],
     								'reg_date' => (isset($reg_date) ? date('Y/m/d',strtotime($reg_date)) : 'NA'),
     								'address'=>$val['company_address'],
     								'app_date'=>$app_date,
     								'data'=>$data,
     								'srn'=>$srn_no,
     								'service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						break;
					case '5.0':
					 if(isset($arr['UK-FCL-00150_0'])){
   						if(is_array($arr['UK-FCL-00150_0'])){
   							if($data =='new'){
   								$faltu = count($arr['UK-FCL-00150_0'])/2;
   								for ($key = 0; $key < $faltu; $key++) {
   									$records_main[] = ['name'=>(@$arr['UK-FCL-00150_0'][$key].' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]),
   									'entity_reg_no'=>$val['entity_name'],
   									'entity_name'=>$val['entity_company_name'],
   									'reg_date' => (isset($reg_date) ? date('Y/m/d',strtotime($reg_date)) : 'NA'),
   									'address'=>$val['company_address'],'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
   								}
   							}else{

   								foreach ($arr['UK-FCL-00150_0'] as $key => $value) { 
     								$records_main[] = ['name'=>($value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]),
     								'entity_reg_no'=>$val['entity_name'],
     								'entity_name'=>$val['entity_company_name'],
     								'reg_date' => (isset($reg_date) ? date('Y/m/d',strtotime($reg_date)) : 'NA'),
     								'address'=>$val['company_address'],'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
     							}
   							}                 				
     					}
     				}	
					break;
					case '8.0':
						if(isset($arr['UK-FCL-00132_0'])){
  							if(is_array($arr['UK-FCL-00132_0'])){         
     							foreach ($arr['UK-FCL-00132_0'] as $key => $value) { 
     								$records_main[] = ['name'=>($value.' '.@$arr['UK-FCL-00133_0'][$key] .' '.@$arr['UK-FCL-00134_0'][$key]),
     								'entity_reg_no'=>$val['entity_name'],
     								'entity_name'=>$val['entity_company_name'],
     								'reg_date' => (isset($reg_date) ? date('Y/m/d',strtotime($reg_date)) : 'NA'),
     								'address'=>$val['company_address'],'app_date'=>$app_date,'data'=>$data,'srn'=>$srn_no,'service_id'=>$val['service_id']]; 
     							}
     						}
     					} 
						break;
					
					default:
						
						break;
				}
		}

		return $records_main;
	}
}