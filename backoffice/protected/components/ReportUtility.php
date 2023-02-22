<?php

/**
* @author Mohit Sharma
*/
class ReportUtility 
{


public static function getProjectTotalSTATEDDNInvestment1617($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND landrigion_id=:dist_id AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-04-01' AND '2017-03-31') AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}



	public static function getProjectTotalSTATEDDNInvestment1516($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND landrigion_id=:dist_id AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-02-01' AND '2016-03-31') AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}


	static function getTotalOverAllDistrictReceivedSTATEDDNApps1516($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-02-01' AND '2016-03-31') AND application_status in('A','F','P') 
			  AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}




static function getTotalOverAllDistrictReceivedSTATEDDNApps1617($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-04-01' AND '2017-03-31') AND application_status in('A','F','P')
			  AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}




static function getTotalOverAllDistrictReceivedDDNAppsfy1516($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('A','F','P') 
			  AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-02-01' AND '2016-03-31') AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$appCount=$command->queryRow();	
		if($appCount===false)
			return false;
		return $appCount['total'];

	}



static function getTotalOverAllDistrictReceivedDDNAppsfy1617($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('A','F','P') 
			  AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-04-01' AND '2017-03-31') AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$appCount=$command->queryRow();	
		if($appCount===false)
			return false;
		return $appCount['total'];

	}



public static function getProjectTotalDDNInvestment1516($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in('A','F','P') AND landrigion_id=:dist_id AND  (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-02-01' AND '2016-03-31') AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}





public static function getProjectTotalDDNInvestment151615marchtotoday(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in('A','F','P') AND landrigion_id in('1','2','3','4','5','6','7','8','9','13','14','15','16','20') AND  (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2017-03-15' AND '2017-06-21') AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}





public static function getProjectTotalDDNInvestment1617($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in('A','F','P') AND landrigion_id=:dist_id  AND (DATE_FORMAT(application_created_date,'%Y-%m-%d') BETWEEN '2016-04-01' AND '2017-03-31') AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}













static function getDistricNameById($id){
			
			if(empty($id))
				return false;
		$sql="SELECT distric_name FROM bo_district where district_id=:id ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_STR);
		$appCount=$command->queryRow();	
		if($appCount===false)
			return false;
		return $appCount['distric_name'];
		} 



static function getCountofRegisteredUsers(){
	$sql="SELECT count(*) as total FROM sso_users";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$appCount=$command->queryRow();	
		if($appCount===false)
			return false;
		return $appCount['total'];
}

	/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalStateEMPMale(){
		$connection=Yii::app()->db; 
		$sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";
		$command=$connection->createCommand($sql);
		$Fields=$command->queryAll();
		if($Fields===false)
			return false;
		$StatetotalempMtotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalmaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalmaleemp->no_of_emp_mtotal))
					foreach ($totalmaleemp->no_of_emp_mtotal as $empMTotal) 
					{
						$StatetotalempMtotalCost+=$empMTotal;
					}
			}
		}
		return $StatetotalempMtotalCost;
	}
/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
*/
	public static function getProjectTotalStateEMPFemale(){
		$connection=Yii::app()->db; 
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";
		$command=$connection->createCommand($sql);
		$Fields=$command->queryAll();
		if($Fields===false)
			return false;
		$StatetotalempftotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalfemaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalfemaleemp->no_of_emp_ftotal))
				foreach ($totalfemaleemp->no_of_emp_ftotal as $empfTotal) 
				{
					$StatetotalempftotalCost+=$empfTotal;
				}
			}
		}
		return $StatetotalempftotalCost;
	}
/**
	* this function is used to get the  Total Investment of the project
	*@author: Mohit Sharma
*/
	public static function getProjectTotalStateInvestment(){
		$connection=Yii::app()->db; 
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";
		$command=$connection->createCommand($sql);
		$Fields=$command->queryAll();
		if($Fields===false)
			return false;
		$statetotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$statetotalCost+=round($rsTotal,2);
				}
			}
		}
		return $statetotalCost;
	}
/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
*/
	static function getRecievedCAFCount(){
		$sql="select count(*) as count from bo_application_submission where application_status in('A','F','P','R') and Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$appCount=$command->queryRow();	
		if($appCount===false)
			return false;
		return $appCount['count'];
	}
/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
*/
	public static function getMicroTotalProject(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalMicroCount=0;
		$totalSmallCount=0;
		$totalMediumCount=0;
		$totalLargeCount=0;

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				// echo "<pre>";
				$totalmaleemp=json_decode($field['field_value'],true);
				// print_r($totalmaleemp);
				if(isset($totalmaleemp['ntrofunittype']) && $totalmaleemp['ntrofunittype']=='small')
					$totalSmallCount+=1;
				if(isset($totalmaleemp['ntrofunittype']) && $totalmaleemp['ntrofunittype']=='medium')
					$totalMediumCount+=1;
				if(isset($totalmaleemp['ntrofunittype']) && $totalmaleemp['ntrofunittype']=='micro')
					$totalMicroCount+=1;
				if(isset($totalmaleemp['ntrofunittype']) && $totalmaleemp['ntrofunittype']=='large')
					$totalLargeCount+=1;
			}
		}
		$returnArray=array("small"=>$totalSmallCount,"medium"=>$totalMediumCount,"micro"=>$totalMicroCount,"large"=>$totalLargeCount);
		return $returnArray;
	}
/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
*/
	public static function getUnitTypeTotalProject(){
		$connection=Yii::app()->db; 
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";
		$command=$connection->createCommand($sql);
		$Fields=$command->queryAll();
		if($Fields===false)
			return false;
		$totalManufacturing=0;
		$totalServices=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalmaleemp=json_decode($field['field_value'],true);
				if(isset($totalmaleemp['ntrofunit']) && $totalmaleemp['ntrofunit']=='Manufacturing')
					$totalManufacturing+=1;
				if(isset($totalmaleemp['ntrofunit']) && $totalmaleemp['ntrofunit']=='Services')
					$totalServices+=1;
			}
		}
		$returnArray=array("Manufacturing"=>$totalManufacturing,"Services"=>$totalServices);
		return $returnArray;
	}


static function getTotalOverAllDistrictReceivedDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('A','R') 
			  AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}

static function getTotalOverAllDistrictApprovedDDNApps($dist_id=0,$app_status='A'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


	static function getTotalOverAllDistrictRejectedDDNApps($dist_id=0,$app_status='R'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}



		public static function getProjectTotalEMPDDNMale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempMtotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalmaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalmaleemp->no_of_emp_mtotal))
					foreach ($totalmaleemp->no_of_emp_mtotal as $empMTotal) 
					{
						$totalempMtotalCost+=$empMTotal;
					}
			}
		}
		
		return $totalempMtotalCost;

	}


	public static function getProjectTotalEMPDDNFemale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempftotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalfemaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalfemaleemp->no_of_emp_ftotal))
				foreach ($totalfemaleemp->no_of_emp_ftotal as $empfTotal) 
				{
					$totalempftotalCost+=$empfTotal;
				}
			}
		}
		
		return $totalempftotalCost;

	}


public static function getProjectTotalDDNInvestment($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}



	/**
	* this function is used to get total of Overall Report application in distric
	*@author Mohit Sharma Thakur
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalOverAllDistrictReceivedApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in ('A','R') AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}



	static function getTotalOverAllDistrictApprovedApps($dist_id=0,$app_status='A'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


static function getTotalOverAllDistrictRejectedApps($dist_id=0,$app_status='R'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalEMPMale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempMtotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalmaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalmaleemp->no_of_emp_mtotal))
					foreach ($totalmaleemp->no_of_emp_mtotal as $empMTotal) 
					{
						$totalempMtotalCost+=$empMTotal;
					}
			}
		}
		
		return $totalempMtotalCost;

	}



/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalEMPFemale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempftotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalfemaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalfemaleemp->no_of_emp_ftotal))
				foreach ($totalfemaleemp->no_of_emp_ftotal as $empfTotal) 
				{
					$totalempftotalCost+=$empfTotal;
				}
			}
		}
		
		return $totalempftotalCost;

	}



/**
	* this function is used to get the  Total Investment of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalInvestment($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}


/* DEHRADUN STATE APPLICATION STATUS CODE QUERY START */

static function getTotalOverAllDistrictReceivedSTATEDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('A','R') 
			  AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


static function getTotalOverAllDistrictApprovedSTATEDDNApps($dist_id=0,$app_status='A'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


	static function getTotalOverAllDistrictRejectedSTATEDDNApps($dist_id=0,$app_status='R'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}


public static function getProjectTotalEMPSTATEDDNMale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempMtotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalmaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalmaleemp->no_of_emp_mtotal))
					foreach ($totalmaleemp->no_of_emp_mtotal as $empMTotal) 
					{
						$totalempMtotalCost+=$empMTotal;
					}
			}
		}
		
		return $totalempMtotalCost;

	}



	public static function getProjectTotalEMPSTATEDDNFemale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalempftotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalfemaleemp=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalfemaleemp->no_of_emp_ftotal))
				foreach ($totalfemaleemp->no_of_emp_ftotal as $empfTotal) 
				{
					$totalempftotalCost+=$empfTotal;
				}
			}
		}
		
		return $totalempftotalCost;

	}


	public static function getProjectTotalSTATEDDNInvestment($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				// echo "<pre>";print_r($totalInvestment);
				if(isset($totalInvestment->invstmnt_in_total))
				foreach ($totalInvestment->invstmnt_in_total as $rsTotal) 
				{
					$totalCost+=round($rsTotal,2);
				}
			}
		}
		
		return $totalCost;

	}


static function getTotalOverAllDistrictDICPendingApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('F','P') AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}



static function getTotalOverAllDistrictDICPendingDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('F','P') AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','F') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}




static function getTotalOverAllDistrictDICPendingSTATEDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('F','P') AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];

	}
	
   static function getTotalGrantIssues(){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE  application_status in('A') AND application_id=1 AND user_id not in('11') ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$appCount1=$command->queryRow();	
	
		$sql="SELECT count(*) as total1 FROM bo_sp_applications WHERE  app_status in('A') AND user_id not in('11') ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$appCount=$command->queryRow();	
		if($appCount1===false)
			return false;
		return $appCount1['total'];

	}















































}

?>