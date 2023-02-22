<?php

class SpController extends Controller {

	public function actionSpreport(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		if(isset($_GET['sptype'])){
			if($_GET['sptype']!=''){
				//$sidsql = "AND (sp.sp_type='".$_GET['sptype']."' OR )";
				$sptype  = $_GET['sptype'];
			}else{
				$sptype = '';
			}
			
		}else{
			$sptype = '';
		}
		
		if(isset($_GET['sp_status'])){
			if($_GET['sp_status']!=''){
				$status = "AND sp.sp_status='".$_GET['sp_status']."'";
				$sp_status = $_GET['sp_status'];
			}else{
				$status = '';
				$sp_status = '';
			}
			
		}else{
			$status = '';
			$sp_status = '';
		}

			$records = Yii::app()->db->createCommand("
					SELECT sp.*, c.company_name, u.first_name, u.last_name,u.surname from agent_service_provider sp
					inner join sso_profiles u on u.user_id=sp.user_id
					left outer join bo_company_details c on c.id=sp.company_id
					where DATE(sp.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $status ORDER BY sp.created_on DESC")->queryAll();
			//echo '<pre>';
			//print_r($records);die;
			$this->render('spreport',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'sp_type'=>$sptype,'sp_status'=>$sp_status]);
	}

	public function actionSpreportpdf(){
		$name = "Representative_report".time().".pdf";			
		$heading = 'Representative Report';
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		if(isset($_GET['sptype'])){
			if($_GET['sptype']!=''){
			$sptype  = $_GET['sptype'];
				$sptype_search_criteria = '<b>Representative Type : </b> '.$_GET['sptype'];
			}else{
				$sptype = '';
				$sptype_search_criteria = '<b>Representative Type : </b>All Representative';
			}
			
		}else{
			$sptype = '';
		}
		
		if(isset($_GET['sp_status'])){
			if($_GET['sp_status']!=''){
				$status = "AND sp.sp_status='".$_GET['sp_status']."'";
				 switch ($_GET['sp_status']) {
			          case 'N':
			            $sp_status = 'Nominated';
			            break;

			            case 'O':
			            $sp_status = 'Onboarded';
			            break;

			             case 'R':
			            $sp_status = 'Removed';
			            break;

			             case 'PD':
			            $status = 'Payment Due';
			            break;

			             case 'PI':
			            $status = 'Payment Initiate';
			            break;
			             
			             case 'NW':
			            $sp_status = 'Nomination withdrawn';
			            break;
			          
			          default:
			            $sp_status = '';
			            break;
			        }
				$status_search_criteria = '<b>Representative Status : </b> '.$sp_status;
			}else{
				$status = '';
				$status_search_criteria = '<b>Representative Status : </b>All';
			}
			
		}else{
			$status = '';
		}

		$records = Yii::app()->db->createCommand("
					SELECT sp.*, c.company_name, u.first_name, u.last_name,u.surname from agent_service_provider sp
					inner join sso_profiles u on u.user_id=sp.user_id
					left outer join bo_company_details c on c.id=sp.company_id
					where DATE(sp.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $status")->queryAll();

		$content = $this->renderPartial('spreportpdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'sp_type'=>$sptype], true);
		$search_criteria = 	$sptype_search_criteria.'<br>'.$status_search_criteria;
		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);
		
	}
	public function actionSpsummaryreportlevel1(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		if(isset($_GET['sptype'])){
			if($_GET['sptype']!=''){
				$sidsql = 'AND u.sp_type="'.$_GET['sptype'].'"';
			}else{
				$sidsql = '';
			}
			
		}else{
			$sidsql = '';
		}

			$records = Yii::app()->db->createCommand("
				SELECT u.user_id, u.email,
				u.sp_type, u.entity_name, p.first_name, p.last_name, p.surname	From sso_users as u inner join sso_profiles as p on p.user_id = u.user_id	where DATE(u.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'AND u.user_type=2    $sidsql   AND u.is_account_active='Y'
				")->queryAll();

			$this->render('sps_level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records]);
	}
public function actionSpslevel1_a(){
	if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$agent_user_id = $_GET['agent_user_id'];

		$status = isset($_GET['status']) ? ($_GET['status'] ? $_GET['status'] : NULL) : NULL;		

		$records = Yii::app()->db->createCommand("
				SELECT s.sp_status, c.company_name, c.reg_no FROM agent_service_provider s
				INNER JOIN bo_company_details c ON s.company_id=c.id
				where s.agent_user_id='".$agent_user_id."' and DATE(s.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' group BY company_id ORDER BY s.id DESC")->queryAll();

		
		$this->render('sps_level1_a',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records,'status'=>$status]);
}

	public function actionSps_level_apdf(){
		$name = "REPRESENTATIVE_SUMMARY_REPORT_LEVEL2_".time().".pdf";			
		$heading = 'REPRESENTATIVE SUMMARY REPORT LEVEL 2';
		
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$agent_user_id = $_GET['agent_user_id'];

		$status = isset($_GET['status']) ? ($_GET['status'] ? $_GET['status'] : NULL) : NULL;
		
		$search_criteria= '';
		$records = Yii::app()->db->createCommand("
				SELECT s.sp_status, c.company_name, c.reg_no FROM agent_service_provider s
				INNER JOIN bo_company_details c ON s.company_id=c.id
				where s.agent_user_id='".$agent_user_id."' and DATE(s.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' group BY company_id ORDER BY s.id DESC")->queryAll();

		
		$content = $this->renderPartial('sps_level1_apdf',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records,'status'=>$status],true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);
	}


	public function actionSpsummaryreportlevel1pdf(){
		$name = "Representative_Summary_Report_level1_".time().".pdf";			
		$heading = 'Representative Summary Report Level 1';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		if(isset($_GET['sptype'])){
			if($_GET['sptype']!=''){
				$sidsql = 'AND u.sp_type="'.$_GET['sptype'].'"';
				$search_criteria = '<b>Representative Type :</b> '.$_GET['sptype'];
			}else{
				$sidsql = '';
				$search_criteria = '<b>Representative Type :</b> All';
			}
			
		}else{
			$sidsql = '';
			$search_criteria = '<b>Representative Type :</b> All';
		}

		
		
			$records = Yii::app()->db->createCommand("
				SELECT u.user_id, u.email,
				u.sp_type, u.entity_name, p.first_name, p.last_name, p.surname	From sso_users as u inner join sso_profiles as p on p.user_id = u.user_id	where DATE(u.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'AND u.user_type=2    $sidsql   AND u.is_account_active='Y'
				")->queryAll();
				
			/* $records = Yii::app()->db->createCommand("
				SELECT agent_user_id,COUNT(s.submission_id) as total_services,
SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amount,
SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
u.sp_type, p.first_name, p.last_name, p.surname						
from bo_new_application_submission  as s
LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id
	inner join sso_users as u on u.user_id = s.agent_user_id
	inner join sso_profiles as p on p.user_id = s.agent_user_id			
				where DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'AND agent_user_id IS NOT NULL   $sidsql   AND u.is_account_active='Y' group by s.agent_user_id
				")->queryAll(); */

		
		
		
		$content = $this->renderPartial('sps_level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records], true);
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);
	}

	public function actionSpsummaryreportlevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$agent_user_id = $_GET['agent_user_id'];
		$reg_no = $_GET['entity_name'];
		
		$services_id = isset($_GET['services_id']) ? ($_GET['services_id'] ? $_GET['services_id'] : NULL) : NULL;	
		if($services_id){
			$sid = implode(',', $services_id);
			$sidsql = "AND s.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}	

		$records = Yii::app()->db->createCommand("
				SELECT sc.service_name,s.service_id,
				COUNT(s.submission_id) as total_services,
				SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amount,
				SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
				s.entity_name as entity_id
				from bo_new_application_submission as s
				LEFT OUTER join tbl_payment as q  on q.submission_id = s.submission_id 
				inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 
				where s.agent_user_id='".$agent_user_id."' AND s.entity_name='".$reg_no."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql group by s.service_id")->queryAll();

		
		$this->render('sps_level2',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records,'services_id'=>$services_id,'reg_no'=>$reg_no]);

	}

	public function actionSpsummaryreportlevel2pdf(){
		$name = "Representative_Summary_Report_level2_".time().".pdf";			
		$heading = 'Representative Summary Report Level 2';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$agent_user_id = $_GET['agent_user_id'];

		$records = Yii::app()->db->createCommand("
				SELECT sc.service_name,s.service_id,
				COUNT(s.submission_id) as total_services,
				SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amount,
				SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
				s.entity_name as entity_id
				from bo_new_application_submission as s
				LEFT OUTER join tbl_payment as q  on q.submission_id = s.submission_id 
				inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 
				where s.agent_user_id='".$agent_user_id."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' group by s.service_id")->queryAll();

		$content = $this->renderPartial('sps_level2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'agent_user_id'=>$agent_user_id], true);
		 $agent_user = Yii::app()->db->createCommand("SELECT u.user_id, u.sp_type,p.first_name,p.last_name,p.surname from  sso_users as u INNER join sso_profiles p on p.user_id = u.user_id where u.user_id = '".$agent_user_id."'")->queryRow(); 

		$search_criteria = '<b>Representative Name:</b> '.$agent_user['first_name'].' '.$agent_user['last_name'].' '.$agent_user['surname'].'<br><b>Representative Type:</b> '.$agent_user['sp_type'];
		Reportformat::generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}

	public function actionSpsummaryreportlevel3(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$agent_user_id = $_GET['agent_user_id'];
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;

		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? $_GET['subservice_id'] : 0) : 0;
		}else{
			$subservice_id = 0;
		}

			$srn_no = isset($_GET['srn_no']) ? ($_GET['srn_no'] ? $_GET['srn_no'] : NULL) : NULL;
		$entity = isset($_GET['entity']) ? ($_GET['entity'] ? $_GET['entity'] : NULL) : NULL;		
		$ser_status = isset($_GET['ser_status']) ? ($_GET['ser_status'] ? $_GET['ser_status'] : NULL) : NULL;

		$pay_mode = isset($_GET['pay_mode']) ?  $_GET['pay_mode'] : NULL;
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


		$records = Yii::app()->db->createCommand("
					SELECT 
					p.first_name, p.last_name, p.surname, u.email,
					(CASE when q.payment_status IN ('success','refund success')  then q.total_amount end) as total_amount,
					(CASE when q.is_fee_refunded=0 AND q.payment_status='success' then q.total_amount end) as paid_amt,
					(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,

					q.is_fee_refunded,q.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.reference_email, q.created_at, nas.application_status,   (SELECT cd.company_name FROM bo_company_details cd WHERE cd.reg_no = nas.entity_name GROUP BY cd.reg_no) as entity_name, nas.submission_id, nas.field_value,
					s.service_name , u.iuid, q.payment_received_by, q.payment_status,	nas.print_app_call_back_url, nas.download_certificate_call_back_url, sp.is_certificate
					FROM bo_new_application_submission nas 
					
					LEFT OUTER JOIN tbl_payment as q ON nas.submission_id = q.submission_id	
					INNER JOIN bo_information_wizard_service_master s ON s.id = nas.service_id
					INNER JOIN bo_information_wizard_service_parameters sp ON nas.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)	
					INNER JOIN sso_users u ON nas.user_id = u.user_id
					INNER JOIN sso_profiles p ON p.user_id = u.user_id	
				
					where nas.agent_user_id='".$agent_user_id."'  and DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'  AND nas.service_id='".$service_id."'  AND sp.is_active='Y' $pay_mode_con $ser_status_con order by nas.application_created_date desc")->queryAll();

		$this->render('sps_level3',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records,'service_id'=>$service_id,'subservice_id'=>$subservice_id,'srn_no'=>$srn_no,'entity'=>$entity,'pay_mode'=>$pay_mode,'ser_status'=>$ser_status]);
	}

	public function actionSpsummaryreportlevel3pdf(){
		$name = "Representative_Summary_Report_level3_".time().".pdf";			
		$heading = 'Representative Summary Report Level 3';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$agent_user_id = $_GET['agent_user_id'];
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;
		
		if($service_id=='2.0'){
			$subservice_id = isset($_GET['subservice_id']) ? ($_GET['subservice_id'] ? $_GET['subservice_id'] : 0) : 0;
		}else{
			$subservice_id = 0;
		}

		$records = Yii::app()->db->createCommand("
					SELECT 
					p.first_name, p.last_name, p.surname, u.email,
					(CASE when q.payment_status IN ('success','refund success')  then q.total_amount end) as total_amount,
					(CASE when q.is_fee_refunded=0 AND q.payment_status='success' then q.total_amount end) as paid_amt,
					(CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,

					q.is_fee_refunded,q.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.reference_email, q.created_at, nas.application_status,  cd.company_name as entity_name, nas.submission_id, nas.field_value,
					s.service_name , u.iuid, q.payment_received_by, q.payment_status
					FROM bo_new_application_submission nas 
					
					LEFT OUTER JOIN tbl_payment as q ON nas.submission_id = q.submission_id	
					INNER JOIN bo_information_wizard_service_master s ON s.id = nas.service_id
					INNER JOIN sso_users u ON nas.user_id = u.user_id
					INNER JOIN sso_profiles p ON p.user_id = u.user_id	
					LEFT OUTER JOIN bo_company_details cd on cd.reg_no = nas.entity_name
					where nas.agent_user_id='".$agent_user_id."'  and DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'  AND nas.service_id='".$service_id."' order by nas.application_created_date desc")->queryAll();

			$serviced = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters Where CONCAT(service_id,'.',servicetype_additionalsubservice) = '".$service_id."'")->queryRow() ;
			 $agent_user = Yii::app()->db->createCommand("SELECT u.user_id, u.sp_type,p.first_name,p.last_name,p.surname from  sso_users as u INNER join sso_profiles p on p.user_id = u.user_id where u.user_id = '".$agent_user_id."'")->queryRow(); 

			  if($subservice_id!=0){
          if($subservice_id==1){
            $ser_name =  "Name Reservation-Society (Form 15)";
          }else{
            if($subservice_id==2){
              $ser_name =  'Name Reservation-Company (Form 33)';
            }else{
              $ser_name =  'Business Name Registration (Form 1)';
            }
          }
        }else{
         $ser_name =  $serviced['core_service_name'];
        }

		$search_criteria = '<b>Representative Name:</b> '.$agent_user['first_name'].' '.$agent_user['last_name'].' '.$agent_user['surname'].'<br><b>Representative Type:</b> '.$agent_user['sp_type'].'<br><b>Service Name :</b> '.$ser_name;
		
		
		$content = $this->renderPartial('sps_level3pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'subservice_id'=>$subservice_id], true);
	
						   
		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);	
	}


}