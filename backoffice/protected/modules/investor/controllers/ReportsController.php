<?php

class ReportsController extends Controller
{
	public function actionTicketing()
	{
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];

	
		$records = Yii::app()->db->createCommand("SELECT q.*,count(service_id) as total_ticket, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS pending_ticket,
	  SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS resolved_ticket, s.service_name FROM supportmain as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND q.usercode=$cuid group by q.service_id order by q.created_on desc")->queryAll();

		$this->render('ticketing',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'officer_id'=>$officer_id,'service_id'=>$service_id]);
	}

	public function actionTicketingLavel2(){


		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			//$sid = implode(',', $service_id);
			$sid = $_GET['services_id'];
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		
		$cuid = $_SESSION['RESPONSE']['user_id'];
		$sql = "SELECT q.*, s.service_name FROM supportmain as q
			INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql  AND q.usercode=$cuid  order by q.created_on asc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('ticketinglavel2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'officer_id'=>$officer_id,'service_id'=>$service_id]);

	}


	public function actionRevenue(){


		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid) AND q.payment_status='success'";
		}else{
			$sidsql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];


		$records = Yii::app()->db->createCommand("SELECT SUM(q.total_amount) as total_amount, q.service_id,
			s.service_name FROM tbl_payment as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql  group by q.service_id order by q.created_at desc")->queryAll();

		$this->render('revenue',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'service_id'=>$service_id,'records'=>$records]);

	}


	public function actionRevenueLavel2(){

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
		   $sid = $_GET['services_id'];
			$sidsql = "AND q.service_id IN ($sid) AND q.payment_status='success'";
		}else{
			$sidsql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];


		$records = Yii::app()->db->createCommand("SELECT q.total_amount as total_amount, q.service_id, q.payment_mode, q.transaction_number, q.reference_number,q.bank_name,q.reference_name, q.created_at,
			s.service_name FROM tbl_payment as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql order by q.created_at desc")->queryAll();

		
		$this->render('revenuelavel2',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'service_id'=>$service_id,'records'=>$records, 'cuid' => $cuid]);

	}

	public function actionQuery()
	{
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		$type = isset($_GET['Complainttype']) ? $_GET['Complainttype'] : NULL;

		if($service_id){
			//$sid = implode(',', $service_id);
			$sid = $_GET['services_id'];
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		
$cuid = $_SESSION['RESPONSE']['user_id'];
		$sql = "SELECT q.*,count(q.service_id) as total_query, COUNT(CASE WHEN `status` = 1 THEN 1 END) AS pending_query,COUNT(CASE WHEN `status` = 0 THEN 1 END) AS resolved_query, s.service_name FROM querymain as q
			INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND q.user_id=$cuid group by q.service_id order by q.created_on desc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('query',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'officer_id'=>$officer_id,'service_id'=>$service_id,'type'=>$type]);
	}

public function actionQueryLevel2()
	{
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		$type = isset($_GET['Complainttype']) ? $_GET['Complainttype'] : NULL;

		if($service_id){
			//$sid = implode(',', $service_id);
			$sid = $_GET['services_id'];
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		if($type){
			$ctype = $_GET['Complainttype'];
			$typesql = 'AND q.query_type="'.$ctype.'"';
		}else{
			$typesql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];
		$sql = "SELECT q.*, s.service_name FROM querymain as q
			INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql $typesql AND q.user_id=$cuid  order by q.created_on asc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('querylevel2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'officer_id'=>$officer_id,'service_id'=>$service_id,'type'=>$type]);
	}

/*
* this action created by Aamir
 */
	  public function actionTimeline()
	{
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
		$cuid = $_SESSION['RESPONSE']['user_id'];

		

		$records = Yii::app()->db->createCommand("SELECT nas.*, sp.service_id as s_id, sp.core_service_name FROM bo_new_application_submission as nas
				INNER JOIN bo_information_wizard_service_parameters sp ON CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice) = nas.service_id
				where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND nas.user_id=$cuid group by nas.service_id")->queryAll();

 
		$this->render('timeline',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id]);
	}

	public function actionTimelinelevel2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
	

		if($service_id){
			$sid = $_GET['services_id'];
			$sidsql = "AND service_id='$sid'";
		}else{
			$sidsql = '';
		}
	
		$cuid = $_SESSION['RESPONSE']['user_id'];

		$records = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission 
				
				where DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND user_id=$cuid")->queryAll();


		
		
		$this->render('timelinelevel2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id]);
	}
	
	public function actionEntity()
	{
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND q.service_id IN ($sid) AND q.payment_status='success'";
		}else{
			$sidsql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];


		$records = Yii::app()->db->createCommand("SELECT SUM(q.total_amount) as total_amount, q.service_id,
			s.service_name FROM tbl_payment as q
				INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
				where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql  group by q.service_id order by q.created_at desc")->queryAll();

		$this->render('entity',['from_date'=>$from_date,'to_date'=>$to_date,'officer_id'=>$officer_id,'service_id'=>$service_id,'records'=>$records]);

	}

public function actionEntityLevel2()
	{
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		$officer_id = isset($_GET['Officer_id']) ? $_GET['Officer_id'] : NULL;
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;
		$type = isset($_GET['Complainttype']) ? $_GET['Complainttype'] : NULL;

		if($service_id){
			//$sid = implode(',', $service_id);
			$sid = $_GET['services_id'];
			$sidsql = "AND q.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		if($type){
			$ctype = $_GET['Complainttype'];
			$typesql = 'AND q.query_type="'.$ctype.'"';
		}else{
			$typesql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];
		$sql = "SELECT q.*, s.service_name FROM querymain as q
			INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
			where DATE(q.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql $typesql AND q.user_id=$cuid  order by q.created_on asc";

		$records = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('entitylevel2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'officer_id'=>$officer_id,'service_id'=>$service_id,'type'=>$type]);
	}
}