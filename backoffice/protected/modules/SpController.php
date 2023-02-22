<?php

class SpController extends Controller {

	public function actionSpreport(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

			$records = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider 	where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' ")->queryAll();

			$this->render('spreport',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records]);
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
				SELECT agent_user_id,COUNT(s.submission_id) as total_services,
SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='success' then q.total_amount end) as ref_amt,
u.sp_type, p.first_name, p.last_name, p.surname						
from bo_new_application_submission  as s
LEFT OUTER join tbl_payment as q on q.submission_id = s.submission_id
	inner join sso_users as u on u.user_id = s.agent_user_id
	inner join sso_profiles as p on p.user_id = s.agent_user_id			
				where DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'AND agent_user_id IS NOT NULL   $sidsql   AND u.is_account_active='Y' group by s.agent_user_id
				")->queryAll();

			$this->render('sps_level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records]);
	}

	public function actionSpsummaryreportlevel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$agent_user_id = $_GET['agent_user_id'];

		$records = Yii::app()->db->createCommand("
				SELECT sc.service_name,s.service_id,
				COUNT(s.service_id) as total_services,
				SUM(CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as total_amount,
				SUM(CASE when q.is_fee_refunded=1 AND q.payment_status='success' then q.total_amount end) as ref_amt,
				s.entity_name as entity_id
				from bo_new_application_submission as s
				LEFT OUTER join tbl_payment as q  on q.submission_id = s.submission_id 
				inner join bo_information_wizard_service_master as sc on s.service_id = sc.id 	
									
				where s.agent_user_id='".$agent_user_id."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' group by s.service_id")->queryAll();

		
		$this->render('sps_level2',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records]);

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

		$records = Yii::app()->db->createCommand("
					SELECT 
					(CASE when q.payment_status='success'  then q.total_amount end) as total_amount,
					(CASE when q.is_fee_refunded=0 AND q.payment_status='success' then q.total_amount end) as paid_amt,
					(CASE when q.is_fee_refunded=1 AND q.payment_status='success' then q.total_amount end) as ref_amt,

					q.is_fee_refunded,q.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.reference_email, q.created_at, nas.application_status,  cd.company_name as entity_name, nas.submission_id,
					s.service_name , u.iuid, q.payment_received_by
					FROM bo_new_application_submission nas 
					
					LEFT OUTER JOIN tbl_payment as q ON nas.submission_id = q.submission_id	
					INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
					INNER JOIN sso_users u ON nas.user_id = u.user_id	
					LEFT OUTER JOIN bo_company_details cd on cd.reg_no = nas.entity_name
					where nas.agent_user_id='".$agent_user_id."'  and DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND q.payment_status='success' AND q.service_id='".$service_id."' order by q.created_at desc")->queryAll();

		$this->render('sps_level3',['from_date'=>$from_date,'to_date'=>$to_date,'agent_user_id'=>$agent_user_id,'records'=>$records,'service_id'=>$service_id]);
	}
}