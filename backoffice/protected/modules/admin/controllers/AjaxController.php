<?php
/**
*@author hemant thakur
*/
class AjaxController extends Controller
{
	/**
	* this function is used to get all the distt caf application
	*@author Hemant thakur
	*@param 
	*@return json 

	*/
	public function actionGetDisttCAF(){
		if(!isset($_POST['distt_id'])){
			echo json_encode(array("STATUS"=>401,"RESPONSE"=>"Invalid Request"));
			exit;	
		}
		$criteria=new CDbCriteria;
		$criteria->condition="landrigion_id=:distt_id AND (application_status=:apprv OR application_status=:reject OR application_status=:pending OR application_status=:frwd) AND Submission_id not in('22','268')";
		$criteria->params=array(":distt_id"=>$_POST['distt_id'],":apprv"=>'A', ":frwd"=>'F',":reject"=>'R',":pending"=>'P');
		$criteria->order="application_status";
		$apps=ApplicationSubmission::model()->findAll($criteria);
		if($apps===null){
			echo json_encode(array("STATUS"=>204,"RESPONSE"=>"No Applications in this district"));
			exit;	
		}
		$result=array();
		// echo "<pre>";print_r($apps);die;
		foreach ($apps as $key => $app) {
			$fields=json_decode($app->field_value);
			$company_name=$iuid="";
			$stateApp="N";
			// print_r($fields->invstmnt_in_total);die;
			if(is_object($fields)){
				$company_name=$fields->company_name;
				$invstmnt_in_total=round($fields->invstmnt_in_total[0],2);
				$iuid=$fields->IUID;
				if($_POST['distt_id']==6 && ($fields->ntrofunit=='Manufacturing' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] >10) || ($fields->ntrofunit=='Services' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] > 5))
					$stateApp='Y';
			}
			$result[]=array("submission_id"=>$app->submission_id,"iuid"=>$iuid,"company_name"=>$company_name, "invstmnt_in_total"=>$invstmnt_in_total,"creation_date"=>$app->application_created_date,"app_status"=>$app->application_status,"stateApp"=>$stateApp);

		}
		echo json_encode(array("STATUS"=>200,"RESPONSE"=>$result));
		exit;
	}
	/**
	*this function is used to close the status of the ticket 
	*/
	public function actionCloseTicket(){
		@session_start();
		if(!isset($_POST['ticket_id'],$_SESSION['department_login'],$_SESSION['uid'])){
			echo json_encode(array("STATUS"=>401,"RESPONSE"=>"Invalid Request"));
			exit;	
		}
		$uid=$_SESSION['uid'];
		$model=new GrievanceStatusDetail;
		extract($_POST);
		$grevModel=Grievance::model()->findByPK($ticket_id);
		if($grevModel===null){
			echo json_encode(array("STATUS"=>400,"RESPONSE"=>"Sorry Couldn't update"));
			exit;
		}
		$grevModel->grievance_status='C';
		if($grevModel->save()){
			$model->grievence_no=$ticket_id;
			$model->status="C";
			$model->status_change_date=date('Y-m-d H:i:s');
			$model->status_changed_by=$uid;
			$model->remote_ip_address= $_SERVER['REMOTE_ADDR'];
			$model->user_agent= $_SERVER['HTTP_USER_AGENT'];
			if($model->save()){
				echo json_encode(array("STATUS"=>200,"RESPONSE"=>"Successfully updated"));
				exit;
			}
			else{
				echo json_encode(array("STATUS"=>204,"RESPONSE"=>"Couldn't generate log"));
				exit;
			}
		}
		else{
			echo json_encode(array("STATUS"=>503,"RESPONSE"=>"Sorry! Could not update."));
			exit;
		}

	}
	/** 
	*@author : Hemant Thakur
	*/
	public function actionGetApplicationComments(){
		if(isset($_POST['distt_id'])){
			$app_sub_id=$_POST['distt_id'];
			$appComments=ApplicationFlowLogsExt::getSubAppsComments($app_sub_id);
			$data=array();
			//if($appComments){
				$data['STATUS']=200;
				$response=array();

				foreach ($appComments as  $value){
					if($value)
					$uname=UserExt::getUNameviaIdMap($value->approval_user_id);
					$role_name=RolesExt::getRolesViaId($value->approver_role_id);
					if(!$role_name)
						$role_name['role_name']=" Investor";
					if(!$uname)
						$uname=" Investor";
					$deptName=UserExt::getUserDept($value->approval_user_id);
					if(!$deptName)
						$deptName['department_name']="Investor";
					$status='';
					if(empty($value->approver_comments))
						$value->approver_comments="Investor Update the Application";
					if($value->application_status=='P')
						$status="Pending";
					if($value->application_status=='V')
						$status="Verified";
					if($value->application_status=='IBD')
						$status="Investor Reverted Back to Dept";
					if($value->application_status=='R')
						$status="Reject";
					if($value->application_status=='RB')
						$status="Reverted Back";
					if($value->application_status=='RBN')
						$status="Reverted Back to Nodal";
					if($value->application_status=='RBI')
						$status="Reverted Back to Investor";
					if($value->application_status=='F')
						$status="Forwarded to Other Dept";
					if($value->application_status=='A')
						$status="Approved";
				$response[]=array("approver_role_id"=>$role_name['role_name'],"approval_user_id"=>$uname,'dept_name'=>$deptName['department_name'],"approver_comments"=>$value->approver_comments,"created_date_time"=>$value->created_date_time,"application_status"=>$status);
					
				}
				
				
				$data['RESPONSE']=$response;
				echo json_encode(array("STATUS"=>200,"RESPONSE"=>$response));
				exit;
			//}
		}
		//$data['RESPONSE']=$response;
				echo json_encode(array("STATUS"=>200,"RESPONSE"=>"Invalid request"));
				exit;

	}
	
	public function actionIndex()
	{
		$status="nahi hai";
	}
	public function actionAllRejectApplications(){

	}
	public function actionAllApproveApplications(){

	}
	public function actionAllPendingApplications(){

	}
	public function actionLastSixAllApplications(){
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && RolesExt::isAdminUser()){
			$apps=ApplicationExt::getAllLastsixApplicationsForAdmin();
			if(!$apps)
				echo json_encode(array("STATUS"=>204));
			else
				echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		}
		else{
			echo json_encode(array("STATUS"=>400,"message"=>"Invalid Login"));
		}
	}
	public function actionLastSixRejectApplications(){
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && RolesExt::isAdminUser()){
			$apps=ApplicationSubmissionExt::getLastSixRejectApplications();
			if(!$apps)
				echo json_encode(array("STATUS"=>204));
			else
				echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		}
		else{
			echo json_encode(array("STATUS"=>400,"message"=>"Invalid Login"));
		}

	}
	public function actionLastSixApproveApplications(){
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && RolesExt::isAdminUser()){
			$apps=ApplicationSubmissionExt::getLastSixAproveApplications();
			if(!$apps)
				echo json_encode(array("STATUS"=>204));
			else
				echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		}
		else{
			echo json_encode(array("STATUS"=>400,"message"=>"Invalid Login"));
		}

	}
	public function actionLastSixPendingApplications(){
		 @session_start();
		 if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && RolesExt::isAdminUser()){
		 	$apps=ApplicationSubmissionExt::getLastSixPendingApplications();
		 	if(!$apps)
		 		echo json_encode(array("STATUS"=>204));
		 	else
		 		echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		 }
		 else{
		 	echo json_encode(array("STATUS"=>400,"message"=>"Invalid Login"));
		 }
	}


	public function actionGetApplicationReport(){
		if(isset($_POST['dept_id']) && isset($_POST['app_id'])){
			extract($_POST);
			$apps=ApplicationSubmissionExt::getFilteredApplications($dept_id,$app_id);
			if(!$apps)
		 		echo json_encode(array("STATUS"=>204));
		 	else
		 		echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		}
		else{
		 	echo json_encode(array("STATUS"=>400,"message"=>"Invalid Request"));
		 }
	}
	public function actionGetAllSPApplication(){
		if(isset($_POST['sp_id'])){
			$apps=SpApplicationsExt::getSPApplicationsAllAjax($_POST['sp_id']);
			if(empty($apps))
				echo json_encode(array("STATUS"=>204));
			else
				echo json_encode(array("STATUS"=>200,"applications"=>$apps));
		}
		else{
			echo json_encode(array("STATUS"=>400,"message"=>"Invalid Request"));
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}