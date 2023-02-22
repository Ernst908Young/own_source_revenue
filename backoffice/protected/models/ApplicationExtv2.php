<?php
class ApplicationV2Ext extends Applications{


public static function getpendingCAFconcatlist($districtid){
		$connection=Yii::app()->db;
		$status='Y';
		$sql="SELECT GROUP_CONCAT(a.submission_id) as CAFID, b.distric_name,a.submission_id ,case when a.application_status='F' THEN 'Forwarded' ELSE 'Pending' END as application_status,a.create_date,a.DiffDate  FROM
( SELECT submission_id,landrigion_id, application_status,DATE_FORMAT(application_created_date,'%Y-%m-%d')as create_date , DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))

 AS DiffDate FROM bo_application_submission where application_status in('P','F','V') AND application_id='1' AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>25 and landrigion_id=:districtid 

 order by landrigion_id) as a Inner Join bo_district as b ON a.landrigion_id=b.district_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":districtid",$districtid,PDO::PARAM_INT);
		//$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
		$applist=$command->queryRow();
		if($applist===false)
			return false; //no application yet
		else
			return $applist['CAFID'];
	}


public static function getServiceNameFromID($service_id){
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT app_name FROM bo_sp_all_applications WHERE app_id=:service_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":service_id",$service_id,PDO::PARAM_INT);
		$appid=$command->queryRow();	
		if($appid===false)
			return;
		return $appid['app_name'];
	}


static function getTotalSWCSProgressServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSRevertedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('H','RBI') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

static function getTotalSWCSRejectedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('R') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

static function getTotalSWCSApprovedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('A') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


/* START FOREST INTEGRETD SERVICES */


static function getTotalSWCSForestProgressServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSForestRevertedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('H','RBI') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

static function getTotalSWCSForestRejectedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('R') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

static function getTotalSWCSForestApprovedServices($sp_tag,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('A') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



/* END  FOREST INTEGRETD SERVICES */



/* START POLLUTION INTEGRATED SERVICES  */


static function getTotalPollutionProgressSWCSServices($is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
//$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalPollutionRevertedSWCSServices($is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('H','RBI') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
//$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalPollutionRejectedSWCSServices($is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('R') and  b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
//$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalPollutionApprovedSWCSServices($is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('A') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
//$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


/* END POLLUTION INTEGRATED SERVICES  */



static function getCountofApplictionNodalDashboard($email=0,$app_status='P'){
	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status=:status and landrigion_id in(select disctrict_id from bo_user  where email=:email and application_status not in ('I','B'))
AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];


}

static function getCountofDistrictApplictionNodalDashboard($email=0,$app_status='P'){
	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status=:status and landrigion_id in(select disctrict_id from bo_user  where email=:email and application_status not in ('I','B'))
AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['total'];


}
public static function getLandDetailReportYesOne($YN ,$dist_id , $land_type){
	// die;
	$connection=Yii::app()->db; 
	 //$sql="SELECT field_value,application_status,landrigion_id,submission_id from bo_application_submission where application_status in ('A','F','P')  AND Submission_id not in('22','268') order by landrigion_id";

	 $sql="SELECT field_value,application_status,landrigion_id,submission_id from bo_application_submission where application_status in ('A','F','P')  AND Submission_id not in('22','268') order by landrigion_id";

	$command=$connection->createCommand($sql);
	$Fields=$command->queryAll();
	if($Fields===false)
		return false;
	
	$aOwnCount=0;
	$pOwnCount=0;
	$fOwnCount=0;
	$totalOwned=0;

	$noCount=1;
	foreach ($Fields as $key => $field)
	{
		if(isset($field['field_value']))
		{		 
			$totalmaleemp=json_decode($field['field_value'],true);					
			if(isset($totalmaleemp['have_own_land']) && $totalmaleemp['have_own_land']== $YN  && $totalmaleemp['land_leased_disctric']==$dist_id)
			{		
				if(isset($totalmaleemp['Proposed_details_of_Land']))
				{
					if($totalmaleemp['Proposed_details_of_Land']== $land_type)
					{
						if($field['application_status']=='A')
							$aOwnCount+=1;
						if($field['application_status']=='P')
							$pOwnCount+=1;
						if($field['application_status']=='F')
							$fOwnCount+=1;
						$totalOwned+=1;
					}	
				}
			}
		
		}
	}
	$returnArray=array("A"=>$aOwnCount,"P"=>$pOwnCount,"F"=>$fOwnCount);
	 // echo "<pre>";print_r($returnArray);die;
	return $returnArray;
}



static function getDistricPendingMoreThan25(){
	// x.landrigion_id
	$connection=Yii::app()->db;
	$sql="Select count(*) as count, x.distric_name from(

	Select b.distric_name,a.submission_id,a.landrigion_id,case when a.application_status='F' THEN 'Forwarded to Department' ELSE 'Pending' END as application_status,a.create_date,a.DiffDate  from (

	SELECT submission_id,landrigion_id, application_status,DATE_FORMAT(application_created_date,'%Y-%m-%d') as create_date ,

	 DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d')) AS DiffDate  

	FROM bo_application_submission where application_status in('P','F') AND Submission_id not in('22','268') AND

	DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>25

	order by landrigion_id) as a Inner Join bo_district as b ON a.landrigion_id=b.district_id) as x group by x.distric_name,x.landrigion_id";
	$command=$connection->createCommand($sql);
	$appSub=$command->queryAll(); 
	return $appSub;
	
}
public static function getCafTracking($caf_id=0){
		$connection=Yii::app()->db; 
		 $sql="SELECT * FROM bo_application_flow_logs WHERE submission_id=:caf_id AND application_status !='IPS' ORDER BY log_id ASC";

		$command=$connection->createCommand($sql);
		$command->bindParam(":caf_id",$caf_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		 $sql="SELECT created_on as application_created_date FROM bo_application_verification_level WHERE app_Sub_id=:caf_id and (next_role_id=7 or next_role_id=4)";

		$command=$connection->createCommand($sql);
		$command->bindParam(":caf_id",$caf_id,PDO::PARAM_STR);
		$rs=$command->queryRow();
		// echo "<pre>";print_r($rs);die;
		array_push($Fields, $rs);
		// echo "<pre>"; print_r($Fields); die();

		return $Fields;
	}
	static function getApplicationInfo($app_sub_id){
		// echo $app_sub_id;die;
		$sql="SELECT * from bo_application_submission where submission_id=:submission_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":submission_id",$app_sub_id,PDO::PARAM_INT);
		$appInfo=$command->queryRow();
		// echo "<pre>";print_r($appInfo);die;    
		if($appInfo===false)
			return false;
		$appInfo['fields']=json_decode($appInfo['field_value'],true);
		//echo "<pre>";print_r($appInfo);die;
		return $appInfo;	

	}

/* DEHRADUN STATE APPLICATION STATUS CODE QUERY START */

static function getTotalOverAllDistrictReceivedSTATEDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('P','H','F','A','R') 
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


static function getTotalOverAllDistrictDICPendingSTATEDDNApps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))<2";
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


static function getTotalOverAllDistrictDICPending48STATEDDNApps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>2";
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


static function getTotalOverAllDistrictRevertedSTATEDDNApps($dist_id=0,$app_status='H'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34'))  AND Submission_id not in('22','268')";
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


static function getTotalOverAllDistrictForwardedSTATEDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('A','R','F') AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in ('4','34')) AND Submission_id not in('22','268')";
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_id='1' AND application_status=:status AND Submission_id  in(select submission_id from bo_application_submission as app1
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id  in(Select submission_id from bo_application_submission as app1
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



static function getTotalOverAllDistrictForwardedDeptSTATEDDNApps($dist_id=0,$app_status='F'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id  in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id  in(Select submission_id from bo_application_submission as app1
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


/* DEHRADUN STATE APPLICATION STATUS CODE QUERY END */




/* DEHRADUN DISTRICT APPLICATION STATUS CODE QUERY START */

static function getTotalOverAllDistrictReceivedDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('P','H','F','A','R') 
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


static function getTotalOverAllDistrictDICPendingDDNApps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))<=2";
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


static function getTotalOverAllDistrictDICPending48DDNApps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>2";
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

static function getTotalOverAllDistrictDICPending48DDNAppsV($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission apps
INNER JOIN bo_application_verification_level as appv
ON apps.submission_id=appv.app_sub_id
WHERE landrigion_id=:dist_id AND application_status=:status AND application_id='1' AND Submission_id not in(select submission_id from bo_application_submission as app1
inner join bo_application_verification_level as app2
ON app1.submission_id=app2.app_sub_id
where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) 
AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>2
AND appv.approv_status='P'";
		

		/*$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>2";*/
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


static function getTotalOverAllDistrictRevertedDDNApps($dist_id=0,$app_status='H'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34'))  AND Submission_id not in('22','268')";
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


static function getTotalOverAllDistrictForwardedDDNApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('A','R','F') AND Submission_id not in(select submission_id from bo_application_submission as app1
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in(select submission_id from bo_application_submission as app1
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in(Select submission_id from bo_application_submission as app1
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



static function getTotalOverAllDistrictForwardedDeptDDNApps($dist_id=0,$app_status='F'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in(Select submission_id from bo_application_submission as app1
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


/* DEHRADUN DISTRICT APPLICATION STATUS CODE QUERY END */





	/**
	* this function is used to get total of Overall Report application in distric
	*@author Mohit Sharma Thakur
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalOverAllDistrictReceivedApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('P','H','F','A','R') AND Submission_id not in('22','268')";
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


	static function getTotalOverAllDistrictDICPendingApps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))<=2";
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


	static function getTotalOverAllDistrictDICPending48Apps($dist_id=0,$app_status='P'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268') AND DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>2";
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



	static function getTotalOverAllDistrictRevertedApps($dist_id=0,$app_status='H'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268')";
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



static function getTotalOverAllDistrictForwardedApps($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status in('A','R','F') AND Submission_id not in('22','268')";
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268')";
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
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268')";
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



static function getTotalOverAllDistrictForwardedDeptApps($dist_id=0,$app_status='F'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_id='1' AND application_status=:status AND Submission_id not in('22','268')";
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
	public static function getNICCodeMicroProject($divcode=0){
		$connection=Yii::app()->db; 
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":divcode",$divcode,PDO::PARAM_STR);
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
				 //print_r($totalmaleemp);
if( isset($totalmaleemp['industry_type']) && substr($totalmaleemp['industry_type'],0,2)==$divcode)
{

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
	}
		$returnArray=array("small"=>$totalSmallCount,"medium"=>$totalMediumCount,"micro"=>$totalMicroCount,"large"=>$totalLargeCount);
		//echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}










/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getMicroTotalProject(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268') AND application_id='1'";

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
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}



/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getUnitTypeTotalProject(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268') AND application_id='1'";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalManufacturing=0;
		$totalServices=0;

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				// echo "<pre>";
				$totalmaleemp=json_decode($field['field_value'],true);
				// print_r($totalmaleemp);
				if(isset($totalmaleemp['ntrofunit']) && $totalmaleemp['ntrofunit']=='Manufacturing')
					$totalManufacturing+=1;
				if(isset($totalmaleemp['ntrofunit']) && $totalmaleemp['ntrofunit']=='Services')
					$totalServices+=1;
				
				
			}
		}
		$returnArray=array("Manufacturing"=>$totalManufacturing,"Services"=>$totalServices);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}


public static function getInvestorDetails($userid=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT a.iuid,a.email,b.mobile_number  from sso_users as a inner join sso_profiles as b ON a.user_id=b.user_id where a.user_id=:userid";

		$command=$connection->createCommand($sql);
		$command->bindParam(":userid",$userid,PDO::PARAM_STR);
		$Fields=$command->queryRow();
		
		
		return $Fields;

	}






/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectStatusTotalProject(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268') AND application_id='1'";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalNew=0;
		$totalExpansion=0;
		$totalDiversification=0;
		

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				// echo "<pre>";
				$totalmaleemp=json_decode($field['field_value'],true);
				// print_r($totalmaleemp);
				if(isset($totalmaleemp['project_status']) && $totalmaleemp['project_status']=='New')
					$totalNew+=1;
				if(isset($totalmaleemp['project_status']) && $totalmaleemp['project_status']=='Expansion')
					$totalExpansion+=1;
				if(isset($totalmaleemp['project_status']) && $totalmaleemp['project_status']=='Diversification')
					$totalDiversification+=1;
				
			}
		}
		$returnArray=array("New"=>$totalNew,"Expansion"=>$totalExpansion,"Diversification"=>$totalDiversification);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}





/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getNatureofOrganizationTotal(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268') AND application_id='1'";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$totalProprietary=0;
		$totalPartnership=0;
		$totalPrivate=0;
		$totalPublic=0;
		$totalCoOperative=0;
		$totalOther=0;
		

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				// echo "<pre>";
				$totalmaleemp=json_decode($field['field_value'],true);
				// print_r($totalmaleemp);
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Proprietary')
					$totalProprietary+=1;
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Partnership')
					$totalPartnership+=1;
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Private Limited')
					$totalPrivate+=1;
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Public Limited')
					$totalPublic+=1;
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Co-Operative')
					$totalCoOperative+=1;
				if(isset($totalmaleemp['noforg']) && $totalmaleemp['noforg']=='Other')
					$totalOther+=1;
			}
		}
		$returnArray=array("Proprietary"=>$totalProprietary,"Partnership"=>$totalPartnership,"Private Limited"=>$totalPrivate,"Public Limited"=>$totalPublic,"Co-Operative"=>$totalCoOperative,"Other"=>$totalOther);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}





	/**
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getCategoryTotalProject(){
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
		$totalSC=0;
		$totalST=0;
		$totalOBC=0;
		$totalGeneral=0;
		$totalWomen=0;
		$totalExserviceman=0;
		$totalPhyChal=0;
		$totalOther=0;

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalcategory=json_decode($field['field_value'],true);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='SC')
					$totalSC+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='ST')
					$totalST+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='OBC')
					$totalOBC+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='GENERAL')
					$totalGeneral+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='WOMEN')
					$totalWomen+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Ex-Serviceman')
					$totalExserviceman+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Physically Challenged')
					$totalPhyChal+=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Other')
					$totalOther+=1;
			}
		}
		$returnArray=array("SC"=>$totalSC,"ST"=>$totalST,"OBC"=>$totalOBC,"GENERAL"=>$totalGeneral,"WOMEN"=>$totalWomen,"ExServiceman"=>$totalExserviceman,"PhysicallyChallenged"=>$totalPhyChal,"Other"=>$totalOther);
		//echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}




/**
	* this function is used to get Total Number of Grievance in State
	*@author Mohit SHARMA 
	*@param 
	*@return false/int
	*/
	static function getStateTotalGrievance(){
		$sql="select count(*) as count from bo_grievance where  grievence_no  not in('1','2')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":month",$month,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['count'];

	}


/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalApprovedMonthWiseCAF($month=0){
		// $sql="select count(*) as count, MONTH(application_updated_date_time) as month from bo_application_submission where application_status='A' AND Submission_id not in('22','268')  and MONTH(application_updated_date_time)=:month and YEAR(NOW())  group by MONTH(application_updated_date_time)";
		$sql="select count(*) as count, MONTH(application_updated_date_time) as month from bo_application_submission where application_status='A' AND Submission_id not in('22','268')  and MONTH(application_updated_date_time)=:month group by MONTH(application_updated_date_time)";

		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":month",$month,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return 0;
		return $appCount['count'];

	}


/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalApprovedMonthWiseWithYearCAF($month=0,$year=0){
		// $sql="select count(*) as count, MONTH(application_updated_date_time) as month from bo_application_submission where application_status='A' AND Submission_id not in('22','268')  and MONTH(application_updated_date_time)=:month and YEAR(NOW())  group by MONTH(application_updated_date_time)";
		$sql="select count(*) as count, MONTH(application_updated_date_time) as month from bo_application_submission where application_status='A' AND Submission_id not in('22','268')  and MONTH(application_updated_date_time)=:month and YEAR(application_updated_date_time)=:year group by MONTH(application_updated_date_time)";

		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":month",$month,PDO::PARAM_STR);
		$command->bindParam(":year",$year,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return 0;
		return $appCount['count'];

	}




/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalProcessingFeesMonthWiseCAF($month=0){
		$sql="select IFNULL(sum(amount)/100, 0) as count from bo_payment_detail where statuscode='S' and month(trnReqDate)=:month";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":month",$month,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return 0.0;
		return $appCount['count']/1000;

	}


/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalProcessingTotalFees(){
		$sql="select IFNULL(sum(amount)/100, 0) as count from bo_payment_detail where statuscode='S'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":status",$month,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['count'];

	}







/**
	* this function is used to get month wise approved CAF Application
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalCountCAF($status=A){
		$sql="select count(*) as count from bo_application_submission where application_status=:status AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['count'];

	}




/**
	* this function is used to get total application in distric
	*@author Mohit SHARMA 
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalDistrictPendingCAF($dist_id=0){
		$sql="Select count(*) as count, x.distric_name,x.landrigion_id from(
Select b.distric_name,a.submission_id,a.landrigion_id,case when a.application_status='F' THEN 'Forwarded to Department' ELSE 'Pending' END as application_status,a.create_date,a.DiffDate  from (
SELECT submission_id,landrigion_id, application_status,DATE_FORMAT(application_created_date,'%Y-%m-%d') as create_date ,
 DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d')) AS DiffDate  
FROM bo_application_submission where application_status in('P','F') AND Submission_id not in('22','268') AND
DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>25 and landrigion_id=:dist_id
order by landrigion_id) as a Inner Join bo_district as b ON a.landrigion_id=b.district_id) as x group by x.distric_name,x.landrigion_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return false;
		return $appCount['count'];

	}




	/**
	* this function is used to get total application in distric
	*@author Hemant Thakur
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalDistrictApplicationofCAF($dist_id=0){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status in('A','R','F','P','H') AND Submission_id not in('22','268')";
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





	/**
	* this function is used to get total application in distric
	*@author Hemant Thakur
	*@param $dist_id,$app_status
	*@return false/int
	*/
	static function getTotalDistrictApps($dist_id=0,$app_status='A'){
		$sql="SELECT count(*) as total FROM bo_application_submission WHERE landrigion_id=:dist_id AND application_status=:status AND Submission_id not in('22','268')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$command->bindParam(":status",$app_status,PDO::PARAM_INT);
		$appCount=$command->queryRow();	
		// echo "<pre>";print_r($appCount);die;
		if($appCount===false)
			return 0;
		return $appCount['total'];

	}


/**
	* this function is used to get the  Total Investment of the project
	*@author: Rahul Kumar
	*/
	public static function getProjectTotalApprovedInvestment($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

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
	* this function is used to get the  Total Investment of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalStateInvestment(){
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
		$statetotalCost=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalInvestment=json_decode($field['field_value']);
				//echo "<pre>";print_r($totalInvestment);
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
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalEMPMale($dist_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

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
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND application_id='1' AND landrigion_id=:dist_id AND Submission_id not in('22','268')";

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
	* this function is used to get the  Total Employement of the project
	*@author: Mohit Sharma
	*/
	public static function getProjectTotalStateEMPMale(){
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
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
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
	* this function is used to get the  size of the project for payment
	*@author: Hemant Thkur
	*/
	public static function getProjectSize($app_sub_id){
		$connection=Yii::app()->db; 
		$sql="SELECT field_value FROM bo_application_submission WHERE submission_id = :app_sub_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":app_sub_id",$app_sub_id,PDO::PARAM_INT);
		$Fields=$command->queryRow();
		if($Fields===false)
			return false;
		$Fields=json_decode($Fields['field_value']);
		$totalCost=0;
		if(is_object($Fields)){
			if(isset($Fields->invstmnt_in_total))
			foreach ($Fields->invstmnt_in_total as $rsTotal) 
				$totalCost+=$rsTotal;
		}
		return $rsTotal;
	}


public static function getUsersCAFApplicationsOfUser($uid,$app_id){
		$connection=Yii::app()->db;
		$status="I";
		$Hstatus='H';
		$sql="SELECT submission_id,dept_id,application_id,field_value,application_created_date,application_status from bo_application_submission WHERE (application_id=:app_id AND user_id=:uid) AND (application_status=:status OR application_status=:Hstatus) ORDER BY submission_id DESC";
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
		$command->bindParam(":Hstatus",$Hstatus,PDO::PARAM_STR);
		$applist=$command->queryRow();
		return $applist;
	}

	
	/**
	* this function is used to get the documents for the investor uploaded by the department user
	*@author: Hemant Thkur
	*/
	public static function getInvestorDocs($app_sub_id){
		@session_start();
		$uid=@$_SESSION['RESPONSE']['user_id'];
		$post_data=array( );
		$hash=hash_hmac('sha1', md5($app_sub_id.$uid), CDN_PUBLIC_KEY);
		$post_data=array('user_id'=>$uid,'app_sub_id'=>$app_sub_id,'api_hash'=>$hash);
		$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/getInvestorDocument',$post_data));
		if(is_object($response)){
			if($response->STATUS===200){
				return $response;
			}
			else
				return false;
		}
		return false;
	}
	/**
	* this function is used to get the documents for the investor uploaded by the department user (sso Depts' app)
	*@author: Hemant Thkur
	*/
	public static function getInvestorSSOAppDocs($app_sub_id){
		@session_start();
		$uid=@$_SESSION['RESPONSE']['user_id'];
		$post_data=array( );
		$hash=hash_hmac('sha1', md5($app_sub_id.$uid), CDN_PUBLIC_KEY);
		$post_data=array('user_id'=>$uid,'app_sub_id'=>$app_sub_id,'api_hash'=>$hash);
		$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/getInvestorSSOAppDocument',$post_data));
		if(is_object($response)){
			
			if($response->STATUS===200){
				return $response;
			}
			else
				return false;
		}
		return false;
	}


	public static function getAppIdFromSubId($app_sub_id){
		$criteria=new CDbCriteria;
		$criteria->condition="submission_id=:app_sub_id";
		$criteria->params=array(":app_sub_id"=>$app_sub_id);
		$app_id=ApplicationSubmission::model()->find($criteria);
		if(empty($app_id))
			return false;
		else
			return $app_id->application_id;
	}

	/*used to get the CAF application ID
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getCAFId(){
		$isactive = 'Y';
		$appName='CAF';
		$connection=Yii::app()->db; 
		$sql="SELECT application_id,dept_id FROM bo_applications WHERE application_name = :appName AND is_application_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":appName",$appName,PDO::PARAM_STR);
		$cafId=$command->queryRow();	
		if($cafId===false)
			return false;
		return $cafId;
	}

	/*used to get the all application list from particular Department
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAppFromDept($dept_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT application_id,application_name FROM bo_applications WHERE dept_id = :dept_id AND is_application_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$appList=$command->queryAll();	
		return $appList;
	}
	/*used to get the all fields of the department application
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getDeptAppFields($app_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT apfm.field_name,apfm.field_value,apfm.field_max_length,apfm.field_id,apfm.field_autofocus,apfm.field_class,apfm.field_onclick_field_name,apfm.field_onclick_field_placeholder,apfm.field_onclick,apfm.field_onclick_add_no_fields,apfm.field_min_length,apfm.field_numbers,apfm.field_size,apfm.each_field_placeholder,apfm.each_field_value,apfm.field_onblur,apfm.field_onchange,apfm.field_onkeyup,apfm.field_onsubmit,bf.filed_type FROM bo_applications_fields_mapping apfm
					inner join bo_filelds bf
					on bf.field_id=apfm.field_id
					WHERE application_id=:app_id AND is_mapping_active=:isactive ORDER BY apfm.app_mapping_id ASC";
		$command=$connection->createCommand($sql);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$appList=$command->queryAll();	
		return $appList;
	}

	/*used to get the application name from ID
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAppNameViaId($id){
		$connection=Yii::app()->db;
		$sql="SELECT application_name FROM bo_applications WHERE application_id=:id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname;
	}


public static function getDepartmentNameViaID($id){
		$connection=Yii::app()->db;
		$sql="SELECT department_name FROM bo_departments WHERE dept_id=:id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname['department_name'];
	}



	public static function getRevertedComment($id){
		$connection=Yii::app()->db;
		$sql="SELECT approval_user_comment FROM bo_application_verification_level WHERE app_Sub_id=:id and approv_status in ('V','R','H','F')";
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname['approval_user_comment'];
	}


	/*used to get the application name from ID for admin
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAppNameViaIdAdmin($id){
		$connection=Yii::app()->db;
		$sql="SELECT application_name FROM bo_applications WHERE application_id=:id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname['application_name'];
	}
	/** 
	 * function is used to get the department name from application id
	 * @author : Hemant Thakur
	 * 
	 *
	*/
	public static function getDeptNameFromAppId($app_id){
		$connection=Yii::app()->db;
		$sql="SELECT dept.department_name FROM bo_departments dept
			  INNER JOIN bo_applications app
              ON app.dept_id= dept.dept_id
 			  WHERE app.application_id=:app_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname['department_name'];
	}
	public static function getDeptIdFromAppId($app_id){
		$connection=Yii::app()->db;
		$sql="SELECT dept.dept_id FROM bo_departments dept
			  INNER JOIN bo_applications app
              ON app.dept_id= dept.dept_id
 			  WHERE app.application_id=:app_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$appname=$command->queryRow();
		return $appname['dept_id'];
	}
	/*used to get the all submit application of particular user and its status
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function checkForPayment($user_id,$app_id){
		$criteria=new CDbCriteria;
		$criteria->condition="user_id=:user_id AND app_sub_id=:app_id";
		$criteria->params=array(":user_id"=>$user_id,":app_id"=>$app_id);
		$data=PaymentDetail::model()->find($criteria);
		if(empty($data))
			return false;
		else
			return true;
	}

	public static function checkUSerPaidForApplication($user_id,$app_id,$sub_id){
		$connection=Yii::app()->db;
		$sql="SELECT required_payment FROM bo_application_submission apps
				INNER JOIN bo_applications app
				ON apps.application_id=app.application_id
				WHERE apps.submission_id=:sub_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
		$check=$command->queryRow();
		if($check===false)
			return false;
		if($check['required_payment']=='N')
			return true;
		if(ApplicationExt::checkForPayment($user_id,$sub_id))
			return true;
		else
			return false;
	}

	/*used to get the all submit application of particular user and its status
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function getUsersApplications($uid){
		$connection=Yii::app()->db;
		$sql="SELECT app.required_payment,aps.submission_id,aps.application_id,aps.user_id,aps.dept_id,aps.application_status,aps.application_created_date,apvl.next_role_id,apvl.approv_status,aps.application_status,apvl.approval_user_comment,apvl.created_on FROM bo_application_submission aps
			 INNER JOIN bo_application_verification_level apvl
			 ON aps.submission_id=apvl.app_Sub_id
			 INNER JOIN bo_applications app
			 ON aps.application_id=app.application_id
			 WHERE user_id=:id AND aps.application_id!=11 ORDER BY aps.submission_id DESC"; // Added aps.application_id!=11 - Rahul Kumar - 25032018
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$uid,PDO::PARAM_INT);
		$applist=$command->queryAll();
		return $applist;
	}
	/*used to get the incomplete CAF application of the user 
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function getUsersCAFApplications($uid){
		$connection=Yii::app()->db;
		$status="I";
		$Hstatus='H';
		$pStatus="B";
		$sql="SELECT submission_id,dept_id,application_id,field_value,application_created_date from bo_application_submission WHERE user_id=:uid AND (application_status=:status OR application_status=:Hstatus OR application_status=:pStatus)";
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":Hstatus",$Hstatus,PDO::PARAM_STR);
		$command->bindParam(":pStatus",$pStatus,PDO::PARAM_STR);

		
		$applist=$command->queryAll();
		return $applist;
	}
	/*used to get the incomplete CAF application of the user 
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function getUsersCAFIncompleteApplications($uid){
		$connection=Yii::app()->db;
		$status="I";
		$pStatus="B";
		//$Hstatus='H';
		$sql="SELECT submission_id,dept_id,application_id,field_value,application_created_date,application_status from bo_application_submission WHERE user_id=:uid AND (application_status=:status OR application_status=:pStatus ) AND application_id!=11";// Added AND application_id!=11 By Rahul Kumar 25032018
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":pStatus",$pStatus,PDO::PARAM_STR);

		//$command->bindParam(":Hstatus",$Hstatus,PDO::PARAM_STR);
		
		$applist=$command->queryAll();
		return $applist;
	}
	/*used to check the user's prev CAF application status
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function checkUsersPrevCAFApplications($uid,$app_id){
		$connection=Yii::app()->db;
		$status='Y';
		$sql="SELECT submission_id,application_status from bo_application_submission WHERE user_id=:uid AND application_id=:app_id  ORDER BY submission_id DESC ";
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
		$applist=$command->queryAll();
		if($applist===false)
			return false; //no application yet
		else{
			foreach ($applist as $app) {
				if($app['application_status']=='P' OR $app['application_status']=='F')
					return true;  // last application is in pending
				else
					return false; //application is either Aproved or rejected
				break;
			}
		}
	}
	/*used to check the user's prev CAF application status
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function checkUsersPrevCAFApplicationsForPayment($uid,$app_id){
		$connection=Yii::app()->db;
		$status='Y';
		$sql="SELECT submission_id,application_status,landrigion_id from bo_application_submission WHERE user_id=:uid AND application_id=:app_id  ORDER BY submission_id DESC ";
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
		$applist=$command->queryRow();
		if($applist===false)
			return false; //no application yet
		else
			return $applist;
	}


	/*used to get the CAF form id from the application name & dept id
	@author : Hemant Thakur
	@param: string,int
	@return: string
	*/
	public static function getAppIdFromName($app_name,$dept_id){
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT application_id FROM bo_applications WHERE application_name=:app_name AND dept_id=:dept_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":app_name",$app_name,PDO::PARAM_STR);
		$appid=$command->queryRow();	
		if($appid===false)
			return;
		return $appid['application_id'];
	}
	/*used to Application details
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getApplicationDetail($app_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT application_id,application_name,is_custom_css,custom_css_val,show_default_fields FROM bo_applications WHERE application_id = :app_id AND is_application_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$appList=$command->queryRow();	
		return $appList;
	}
	/*used to Application details
	@author : GAURAV OJHA 
	@param: 
	@return: array
	*/
	public static function getApplications(){
		$connection=Yii::app()->db; 
		$isactive = 'Y';
		$sql="SELECT * FROM bo_applications WHERE is_application_active=:isactive ORDER BY application_id ASC ";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$appList=$command->queryAll();
		if($appList===false)
			return false;	
		return $appList;
	}
	/*used to Application details for admin
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAllLastsixApplicationsForAdmin(){
		$connection=Yii::app()->db; 
		$isactive = 'Y';
		$sql="SELECT count(application_name) as app_cnt, dpt.department_name FROM bo_applications aps 
			  INNER JOIN bo_departments dpt
			  ON aps.dept_id=dpt.dept_id
			  WHERE is_application_active=:isactive GROUP BY aps.dept_id ORDER BY application_id DESC LIMIT 6";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$appList=$command->queryAll();
		if($appList===false)
			return false;	
		return $appList;
	}
	/*used to Application details for admin
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAllApplicationsForAdmin(){
		$connection=Yii::app()->db; 
		$isactive = 'Y';
		$dept_active=1;
		$sql="SELECT dept.dept_id,dept.department_name,count(apps.application_id) AS total_aps FROM bo_departments dept
			INNER JOIN bo_applications apps
			ON apps.dept_id=dept.dept_id
			WHERE is_department_active=:dept_active AND apps.is_application_active=:isactive
			GROUP BY dept.dept_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":dept_active",$dept_active,PDO::PARAM_INT);
		$appList=$command->queryAll();
		if($appList===false)
			return false;	
		return $appList;
	}
	/** 
	*This function is used to get all the application of the particular department
	* @author: Hemant Thakur
	* 
	*/
	public static function getDepartmentApplications($dept_id){
	  $active='Y';
	  $sql="SELECT app.application_name,dept.department_name FROM bo_applications app
			INNER JOIN bo_departments dept
			ON app.dept_id=dept.dept_id
			WHERE dept.dept_id=:dept_id AND app.is_application_active=:active";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
	}
	/** 
	*This function is used to get all the submitted application of the particular department
	* @author: Hemant Thakur
	* 
	*/
	public static function getDepartmentSubmitApplications($dept_id){
	  $active='Y';
	  $sql="SELECT app.application_name,dept.department_name,appsbm.field_value,appsbm.application_status,appsbm.application_created_date FROM bo_applications app
			INNER JOIN bo_departments dept
			ON app.dept_id=dept.dept_id
			INNER JOIN bo_application_submission appsbm
			ON app.application_id=appsbm.application_id
			WHERE dept.dept_id=:dept_id AND app.is_application_active=:active";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
	}
	/** 
	*This function is used to get all the User applictions from all the departments that he submitted
	* @author: Hemant Thakur
	* 
	*/
	public static function getUsersSubApplications($user_id){
	  $active='Y';
	  $sql="SELECT app.application_name,dept.department_name,appsbm.field_value,appsbm.application_status,appsbm.application_created_date FROM bo_applications app
			INNER JOIN bo_departments dept
			ON app.dept_id=dept.dept_id
		    INNER JOIN bo_application_submission appsbm
			ON app.application_id=appsbm.application_id
			WHERE appsbm.user_id=:user_id AND app.is_application_active=:active";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
	}
	/** 
	*This function is used to get all the User applictions from particular department that he submitted
	* @author: Hemant Thakur
	* 
	*/
	public static function getUsersSubDeptApplications($user_id,$dept_id){
	  $active='Y';
	  $sql="SELECT app.application_name,dept.department_name,appsbm.field_value,appsbm.application_status,appsbm.application_created_date FROM bo_applications app
			INNER JOIN bo_departments dept
			ON app.dept_id=dept.dept_id
			INNER JOIN bo_application_submission appsbm
			ON app.application_id=appsbm.application_id
			WHERE appsbm.user_id=:user_id AND dept.dept_id=:dept_id AND app.is_application_active=:active";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
			$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
	}




	/**
* this function is used to get total application in departments
*@author Ashish Rastogi
*@param $sp_tag,$app_status
*@return false/int
*/

static function getTotalDipartemtApps($sp_tag,$app_status){
$sql="SELECT count(*) as deptotal FROM bo_sp_applications where  USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and sp_tag=:sp_tag and app_status=:app_status";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['deptotal'];

}



	/**
*@author Mohit sharma Rastogi
*@param $sp_tag,$app_status
*@return false/int
*/

static function getspintegrateddeptlastapplicationstatus($sp_tag,$app_id){
$sql="select * from bo_sp_application_history   where sp_tag=:sp_tag and app_id=:app_id ORDER BY  history_id desc LIMIT 1";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
$remark=$appCounts['application_status'];
$datetime=$appCounts['added_date_time'];
$cont=$remark+$datetime;

return $remark;

}


	/**
*@author Mohit sharma Rastogi
*@param $sp_tag,$app_status
*@return false/int
*/

static function getspdeptname($sp_tag){
$sql="select service_provider_name from sso_service_providers   where service_provider_tag=:sp_tag";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
$remark=$appCounts['service_provider_name'];

return $remark;

}



public static function getIndustryNamefromCAF($caf_id=0){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where  Submission_id=:caf_id";

		$command=$connection->createCommand($sql);
		$command->bindParam(":caf_id",$caf_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);
		if($Fields===false)
			return false;
		$cafcompanyname="";
		foreach ($Fields as $key => $field) {
			
				$totalmaleemp=json_decode($field['field_value']);
				 //echo "<pre>";print_r(@$totalmaleemp->company_name);
				$cafcompanyname=$totalmaleemp->company_name;
				

		return $cafcompanyname;

	}


}




public static function getNICIICodes(){
		


$sql="select LEFt(NIC_V_Digit,2) as IIDigit from NIC_Codes";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
$remark=$appCounts['IIDigit'];

return $remark;

		

	}




static function getII_Name($II_code){
$sql="SELECT * FROM NIC_II_DIGIT   where II_DIGIT_Code=:II_code";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":II_code",$II_code,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
$remark=$appCounts['Description'];

return $remark;

}


static function getV_Name($V_code){
$sql="SELECT Description FROM NIC_Codes   where NIC_V_Digit=:V_code";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":V_code",$V_code,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
$remark=$appCounts['Description'];

return $remark;

}




static function getTotalSWCSPreEstbServicesBEYONDTIME($sp_tag){ 
/*$sql="SELECT count(*) as swcspreetbhcount from (
select c.*, datediff(NOW(),c.added_date_time) as timeline from(

select x.sno,x.sp_tag,x.app_id,x.app_name,x.app_fields,x.app_status,x.user_id,x.created_on,x.updated_on,y.added_date_time from(
select * from bo_sp_applications where sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and app_status not in('A','R','H')) as x
inner join
(
select * from bo_sp_application_history where sp_tag=:sp_tag and ( application_status='H' OR application_status='P' OR application_status='RBI') order by added_date_time desc)as y 
on x.sno=y.sp_app_id and x.app_id=y.app_id group by x.app_id order by x.app_id, y.added_date_time desc)as c inner join bo_sp_all_applications as d ON c.app_name=d.int_app_name where  d.is_swcs_service='Y' and d.is_pre_estb='Y' and d.is_pre_oper='N' and d.is_other='N') as f
where f.timeline>15";*/

$sql="SELECT count(*) as swcspreetbhcount from bo_sp_applications  as x inner join bo_sp_all_applications as d ON x.app_name=d.int_app_name  where x.sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846')
and app_status not in('A','R','H','RBI') and datediff(now(), updated_on)>15  and  d.is_swcs_service='Y' and d.is_pre_estb='Y' and d.is_pre_oper='N' and d.is_other='N';
";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSPreOperationServicesBEYONDTIME($sp_tag){
/*$sql="SELECT count(*) as swcspreetbhcount from (
select c.*, datediff(NOW(),c.added_date_time) as timeline from(

select x.sno,x.sp_tag,x.app_id,x.app_name,x.app_fields,x.app_status,x.user_id,x.created_on,x.updated_on,y.added_date_time from(
select * from bo_sp_applications where sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and app_status not in('A','R','H')) as x
inner join
(
select * from bo_sp_application_history where sp_tag=:sp_tag and ( application_status='H' OR application_status='P' OR application_status='RBI') order by added_date_time desc)as y 
on x.sno=y.sp_app_id and x.app_id=y.app_id group by x.app_id order by x.app_id, y.added_date_time desc)as c inner join bo_sp_all_applications as d ON c.app_name=d.int_app_name where  d.is_swcs_service='Y' and d.is_pre_estb='N' and d.is_pre_oper='Y' and d.is_other='N') as f
where f.timeline>30";*/


$sql="SELECT count(*) as swcspreetbhcount from bo_sp_applications  as x inner join bo_sp_all_applications as d ON x.app_name=d.int_app_name  where x.sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846')
and app_status not in('A','R','H') and datediff(now(), updated_on)>30  and  d.is_swcs_service='Y' and d.is_pre_estb='N' and d.is_pre_oper='Y' and d.is_other='N';
";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



static function getTotalSWCSOtherServicesBEYONDTIME($sp_tag){
/*$sql="SELECT count(*) as swcspreetbhcount from (
select c.*, datediff(NOW(),c.added_date_time) as timeline from(

select x.sno,x.sp_tag,x.app_id,x.app_name,x.app_fields,x.app_status,x.user_id,x.created_on,x.updated_on,y.added_date_time from(
select * from bo_sp_applications where sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and app_status not in('A','R','H')) as x
inner join
(
select * from bo_sp_application_history where sp_tag=:sp_tag and ( application_status='H' OR application_status='P' OR application_status='RBI') order by added_date_time desc)as y 
on x.sno=y.sp_app_id and x.app_id=y.app_id group by x.app_id order by x.app_id, y.added_date_time desc)as c inner join bo_sp_all_applications as d ON c.app_name=d.int_app_name where  d.is_swcs_service='N' and d.is_pre_estb='N' and d.is_pre_oper='N' and d.is_other='Y') as f
where f.timeline>60";*/

$sql="SELECT count(*) as swcspreetbhcount from bo_sp_applications  as x inner join bo_sp_all_applications as d ON x.app_name=d.int_app_name  where x.sp_tag=:sp_tag and USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846')
and app_status not in('A','R','H') and datediff(now(), updated_on)>60  and  d.is_swcs_service='N' and d.is_pre_estb='N' and d.is_pre_oper='N' and d.is_other='Y'";

$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSPreEstbServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



static function getTotalSWCSPreEstbProgressServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSPreEstbRevertedServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('H','RBI') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}


static function getTotalSWCSPreEstbRejectedServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('R') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}




static function getTotalSWCSPreEstbApprovedServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('A') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}






static function getTotalSWCSPreOperationServices($sp_tag){
$sql="SELECT count(*) as swcspreopreationcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='Y' and b.is_pre_estb='N' 
			and b.is_pre_oper='Y' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreopreationcount'];

}


static function getTotalBeyondSWCSServices($sp_tag){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag=:sp_tag and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='N' and b.is_pre_estb='N' and b.is_pre_oper='N' and b.is_other='Y'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

} 


static function getTotalForestSWCSServices(){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Forest_%$#89' and a.app_status in('P','o','O','A','R','H','RBI') and a.app_name='nonexempted'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

static function getTotalPollutionPreeatabhSWCSServices(){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}






static function getTotalPollutionPreopreationSWCSServices(){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='Y' and b.is_pre_estb='N' and b.is_pre_oper='Y' and b.is_other='N'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



static function getTotalPollutionOtherSWCSServices(){
$sql="SELECT count(*) as swcspreetbhcount from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI') and b.is_swcs_service='N' and b.is_pre_estb='N' and b.is_pre_oper='N' and b.is_other='Y'";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



static function getTotalPollutionPreestablishSWCSServicesBeyondtime(){
$sql="SELECT count(*) as swcspreetbhcount from(
SELECT a.*, datediff(NOW(),updated_on) as timeline from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI')and b.is_swcs_service='Y' and b.is_pre_estb='Y' and b.is_pre_oper='N' and b.is_other='N'
) as x where x.timeline>15
";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}




static function getTotalPollutionPreOperationSWCSServicesBeyondtime(){
$sql="SELECT count(*) as swcspreetbhcount from(
SELECT a.*, datediff(NOW(),updated_on) as timeline from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI')and b.is_swcs_service='Y' and b.is_pre_estb='N' and b.is_pre_oper='Y' and b.is_other='N'
) as x where x.timeline>30
";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}




static function getTotalPollutionOtherSWCSServicesBeyondtime(){
$sql="SELECT count(*) as swcspreetbhcount from(
SELECT a.*, datediff(NOW(),updated_on) as timeline from (
select *, substr(app_fields,length(app_fields)-1)as app_name1 from bo_sp_applications where sp_tag='Pollution&*%_679#') as a inner join bo_sp_all_applications as b ON a.app_name1=b.app_id
where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_tag='Pollution&*%_679#' and a.app_status in('P','o','O','A','R','H','RBI')and b.is_swcs_service='N' and b.is_pre_estb='N' and b.is_pre_oper='N' and b.is_other='Y'
) as x where x.timeline>60
";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}



	/**
* this function is used to get total application in departments
*@author Ashish Rastogi
*@param $sp_tag,$app_status
*@return false/int
DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))<2
*/

static function getTotalDipartemtPendingApps($sp_tag){
$sql="SELECT count(*) as deptotal FROM bo_sp_applications where  USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and sp_tag=:sp_tag and app_status in('P')";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['deptotal'];

}


static function getTotalDipartemtUnderprogessIntApps($sp_tag){
$sql="SELECT count(*) as deptotal FROM bo_sp_applications where  USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and sp_tag=:sp_tag and app_status in('o','O')";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['deptotal'];

}



static function getTotalDipartemtRevertedIntApps($sp_tag){
$sql="SELECT count(*) as deptotal FROM bo_sp_applications where  USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and sp_tag=:sp_tag and app_status in('H' ,'RBI')";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
// echo "<pre>";print_r($appCount);die;
if($appCounts===false)
return false;
return $appCounts['deptotal'];

}

static function getTotalDipartemtPendingAppsMoreThan30($sp_tag){
	$sql="SELECT count(*) as deptotal FROM bo_sp_applications where  USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and sp_tag=:sp_tag and app_status in('P','o') and DATEDIFF(NOW(),DATE_FORMAT(created_on,'%Y-%m-%d'))>30";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql);
	$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
	//$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
	$appCounts=$command->queryRow();    
	// echo "<pre>";print_r($appCount);die;
	if($appCounts===false)
	return 0;
	return $appCounts['deptotal'];

}

 public static function getMasterList($dbtable=null,$key=null,$value=null,$active=null,$isactivevalue=null){           
                     if(empty($active)){  $active="is_active"; }
                     if(empty($isactivevalue)){ $isactivevalue="Y"; }
		$connection=Yii::app()->db;
		
	        $sql = "SELECT $key,$value FROM $dbtable";
		$command=$connection->createCommand($sql);
		$command->bindParam(":$active",$isactivevalue,PDO::PARAM_INT);
		$allData=$command->queryAll();	
                foreach ($allData as $data){
                    $k=$data[$key];
                    $listData[$k]=$data[$value];
                    
                }
		return $listData;
	}

	/*

     * @authour: Jitendra
     * @date: 26022018
     *          */

    public static function getServiceReportDashboardCount($deptId, $distId, $startdate, $enddate) {
        // 62-HOD , 71-SECRETARY ,72-Principal Secretary ,73- Cheif Secretary ,74-DM
        $cond = '';
        if ($deptId != 'ALL') {
            $cond = "sso_service_providers.department_id=$deptId and";
        } else {
            $cond = "";
        }
        if ($distId != 'ALL') {
            $cond = $cond . "bo_sp_applications.app_distt=$distId and";
        } else {
            $cond = $cond . "";
        }

        $sqlssss = "SELECT bo_sp_applications.sno, bo_sp_applications.app_status, bo_sp_applications.caf_id,bo_sp_applications.created_on,sso_service_providers.service_provider_name,bo_sp_all_applications.app_name
FROM bo_sp_applications
LEFT JOIN bo_sp_all_applications ON  bo_sp_applications.sp_app_id =bo_sp_all_applications.app_id
LEFT JOIN sso_service_providers ON bo_sp_all_applications.sp_id=sso_service_providers.sp_id
where $cond bo_sp_applications.created_on  >=:startdate AND bo_sp_applications.created_on <=:enddate
 AND bo_sp_applications.user_id NOT IN ('11') AND sso_service_providers.is_service_provider_active='Y' ";

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlssss);
        $command->bindParam(":startdate", $startdate, PDO::PARAM_INT);
        $command->bindParam(":enddate", $enddate, PDO::PARAM_STR);
        $Fieldsas = $command->queryAll();
        //echo "<pre>";print_r($Fieldsas); die;

        $resultarrssss = array();
        if ($deptId == 'ALL') {  // || $distId=='ALL'
            $sqlhgfh = "SELECT sp_id from sso_service_providers where is_service_provider_active='Y'";
            $command = $connection->createCommand($sqlhgfh);
            $datefirst = $command->queryAll();
            $department_count = count($datefirst);
            $resultarrssss['DepartmentCount'] = $department_count;
            $resultarrssss['ServiceCount'] = 0;
        } else {
            $sql_ser_cnt = "SELECT ap.app_id,ap.app_name FROM bo_sp_all_applications as ap INNER JOIN sso_service_providers as sp ON sp.sp_id=ap.sp_id
        WHERE ap.is_app_active = 'Y' AND sp.department_id='$deptId'";
            $command = $connection->createCommand($sql_ser_cnt);
            $res_sql_ser_cnt = $command->queryAll();
            $services_count = count($res_sql_ser_cnt);
            $resultarrssss['ServiceCount'] = $services_count;
            $resultarrssss['DepartmentCount'] = 0;
        }


        $approvedservice = 0;
        $pendingservice = 0;
        $forwardedservice = 0;
        $rejectedservice = 0;
        $incompleteservice = 0;
        $revertedservice = 0;
        $otherservice = 0;
        if (!empty($Fieldsas)) {
            foreach ($Fieldsas as $key => $dfss) {
                //print_r($dfss); die;
                if ($dfss['app_status'] == 'A') {
                    $approvedservice = $approvedservice + 1;
                }
                if ($dfss['app_status'] == 'P') {
                    $pendingservice = $pendingservice + 1;
                }
                if ($dfss['app_status'] == 'F') {
                    $forwardedservice = $forwardedservice + 1;
                }
                if ($dfss['app_status'] == 'R') {
                    $rejectedservice = $rejectedservice + 1;
                }
                //  if($dfss['app_status']=='I') { $incompleteservice=$incompleteservice+1; }
                if ($dfss['app_status'] == 'RBI') {
                    $revertedservice = $revertedservice + 1;
                }
                //  if($dfss['app_status']=='O' || $dfss['app_status']=='H'){ $otherservice=$otherservice+1;}
                $resultarrssss['ServiceApproved'] = $approvedservice;
                $resultarrssss['ServicePending'] = $pendingservice;
                $resultarrssss['ServiceForwarded'] = $forwardedservice;
                $resultarrssss['ServiceRejected'] = $rejectedservice;
                // $resultarrssss['ServiceIncomplete']=$incompleteservice;
                $resultarrssss['ServiceReverted'] = $revertedservice;
                //  $resultarrssss['ServiceOther']=$otherservice;
                $resultarrssss['ServiceTotal'] = $approvedservice + $pendingservice + $forwardedservice + $rejectedservice + $revertedservice;
            }
            //  print_r($resultarrssss); die;
        }


        if (empty($Fieldsas)) {
            $resultarrssss['ServiceApproved'] = 0;
            $resultarrssss['ServicePending'] = 0;
            $resultarrssss['ServiceForwarded'] = 0;
            $resultarrssss['ServiceRejected'] = 0;
            // $resultarrssss['ServiceIncomplete']=$incompleteservice;
            $resultarrssss['ServiceReverted'] = 0;
            //  $resultarrssss['ServiceOther']=$otherservice;
            $resultarrssss['ServiceTotal'] = 0;
        }


        return $resultarrssss;
    }
/////////////////////////////////////////////////////////////////////////////

    /**
     * This function is used to return forworded Report Overall Dashboard Count
     * @author Jitendra Kumar singh
     * @return json
     *
     *
     */
    public static function getForworedReportDashboardCount($startdate, $enddate, $department_id = 'ALL', $distId = 'ALL') {

        //print_r($startdate); print_r($enddate); die;
        $statePending = "'0'";
        $stateProcesed = "'0'";
        $statePending = "'0'";
        $cond = '';
        //if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
        if ($distId != 'ALL') {
            $cond .= "bac.landrigion_id=$distId and";
        } else {
            $cond .= "";
        }

        $response = array();
        $sql = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
 from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id where $cond";
        if ($department_id != 'ALL') {
            $sql .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }
        $sql .= "  bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
 AND bac.application_status ='F'
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $appSub = $command->queryAll();
        foreach ($appSub as $rte) {
            $statePending = "'" . $rte['submission_id'] . "'," . $statePending;
        }
        $statePendingCAF = count($appSub);
        //print_r($appSub);die;
        // State Processed CAF

        $sqlsas = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
           from  bo_application_forward_level
          LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
          LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id where  $cond";

        if ($department_id != 'ALL') {
            $sqlsas .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }
        //error_reporting(E_ALL);
        //ini_set('display_errors', 1);
        $sqlsas .= " bac.application_id=1 AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status!='P' AND bo_application_forward_level.next_role_id=5
         AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' AND bac.submission_id NOT IN($statePending) GROUP BY bac.submission_id ";

//echo $sqlsas;die;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlsas);
        $applicationSub = $command->queryAll();
        foreach ($applicationSub as $jh) {
            $stateProcesed = "'" . $jh['submission_id'] . "'," . $stateProcesed;
        }
        $stateProcessedCAF = count($applicationSub);
        //echo "<pre>";print_r($applicationSub);
        // State Processed without comment CAF
        $sqlsas = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
           from  bo_application_forward_level
          LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
          LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
          where  $cond";
        if ($department_id != 'ALL') {
            $sqlsas .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }

        $sqlsas .= " bac.application_id=1
         AND bac.application_status in('A','R','H') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
         AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' AND bac.submission_id NOT IN ($stateProcesed) GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlsas);
        $applicationSub = $command->queryAll();
        $stateProcessedWithoutResponseCAF = count($applicationSub);
        //echo "<pre>";print_r($applicationSub);die;
        //echo "state without respoce: ";print_r($stateProcessedWithoutResponseCAF); 


        $sql = "SELECT * FROM bo_district";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $distDAta = $command->queryAll();

        $allpending = 0;
        $allprocessed = 0;
        $pending = array();
        foreach ($distDAta as $ljk) {
            $processedCAF = 0;
            $pendingCAF = 0;
            $dID = $ljk['district_id'];
            $processedWithoutResponse = 0;
            $pending[$dID]['name'] = $ljk['distric_name'];
            $pending[$dID]['pending'] = 0;
            $pending[$dID]['processed'] = 0;
            $sqlhjgjh = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
 from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 where  $cond";
            if ($department_id != 'ALL') {
                $sqlhjgjh .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
            }
            $sqlhjgjh .= " bac.application_id=1 AND bac.submission_id not in('22','268')
 AND bac.landrigion_id=$dID AND bo_application_forward_level.next_role_id=3
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id";

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sqlhjgjh);
            $allData = $command->queryAll();
            //print_r($allData); die;
            // echo "===========";die;
            foreach ($allData as $ljkdd) {

                if ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "F") {
                    $pendingCAF = $pendingCAF + 1;
                    $allpending = $allpending + 1;
                    $hjk[$dID][] = $ljkdd['submission_id'];
                } elseif ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "A") {
                    $processedWithoutResponse = $processedWithoutResponse + 1;
                } elseif ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "R") {
                    $processedWithoutResponse = $processedWithoutResponse + 1;
                } else {
                    if ($ljkdd['approv_status'] == "V") {
                        $processedCAF = $processedCAF + 1;
                        $allprocessed = $allprocessed + 1;
                    }
                }

                $pending[$dID]['pending'] = $pendingCAF;
                $pending[$dID]['processedWithoutResponse'] = $processedWithoutResponse;

                /////////////////////////////////////////////////////////////////////////////////////////

                $sqlsasgfdg = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
           from  bo_application_forward_level
          LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
          LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
          where  $cond";
                if ($department_id != 'ALL') {
                    $sqlsasgfdg .= "bo_application_forward_level.forwarded_dept_id = $department_id AND ";
                }

                $sqlsasgfdg .= " bac.landrigion_id=$dID
         AND bac.application_id=1
         AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268')  AND bo_application_forward_level.next_role_id=3
         AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sqlsasgfdg);
                $applicationSubhjgj = $command->queryAll();
                $allprocessedhgfhg = count($applicationSubhjgj);


                //
                $pending[$dID]['processed'] = $allprocessedhgfhg;
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
        }
        // District Prcessed without comment CAF
        $sqlsas = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
           from  bo_application_forward_level
          LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
          LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
          where  $cond";
        if ($department_id != 'ALL') {
            $sqlsas .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }
        $sqlsas .= " bac.application_id=1
         AND bac.application_status in('A','R','H') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=3
         AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlsas);
        $applicationSub = $command->queryAll();
        $districtProcessedWithoutResponseCAF = count($applicationSub);
        //print_r($DistrictProcessedWithoutResponseCAF);
        //die;
        // District Prcessed CAF
        $sqlsas = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
           from  bo_application_forward_level
          LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
          LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
          where  $cond";
        if ($department_id != 'ALL') {
            $sqlsas .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }
        $sqlsas .= " bac.application_id=1
         AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='V' AND bo_application_forward_level.next_role_id=3
         AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlsas);
        $applicationSub = $command->queryAll();
        $allprocessed = count($applicationSub);


        /////////////.///////////////////////////////////////Under process pending District ( 0----15)//////////////////////////////////////////

        $sqllklkkl = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 where ";
        if ($department_id != 'ALL') {
            $sqllklkkl .= " bo_application_forward_level.forwarded_dept_id = $department_id  AND ";
        }
        $sqllklkkl .= " bac.application_status in('F')
 AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P'
  AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "'
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0
  AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15
 GROUP BY bac.submission_id";
        $command = $connection->createCommand($sqllklkkl);
        $appSublkll = $command->queryAll();
        $districtpendingCAFUnderprocess = count($appSublkll);
        //print_r($districtpendingCAFUnderprocess);
        /////////////.///////////////////////////////////////pending District ( 16----10000)//////////////////////////////////////////
        $sqloiuo = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,
 bd.distric_name,bo_application_forward_level.created_on
 from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 where ";
        if ($department_id != 'ALL') {
            $sqloiuo .= " bo_application_forward_level.forwarded_dept_id = $department_id  AND ";
        }

        $sqloiuo .= " bac.application_status in('F')
 AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P'
  AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "'
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16
  AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000

 GROUP BY bac.submission_id";
        $command = $connection->createCommand($sqloiuo);
        $appoiuo = $command->queryAll();
        $districtpendingCAF = count($appoiuo);
        //print_r($districtpendingCAF); die;
        //////////////////////////////////////////////
        /////////////.///////////////////////////////////////Under process pending State ( 0----15)//////////////////////////////////////////
        $sqlstaaa = "
  SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
 from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 where ";

        if ($department_id != 'ALL') {
            $sqlstaaa .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }

        $sqlstaaa .= " bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
 AND bac.application_status ='F'
  AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "'
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0
  AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15
 GROUP BY bac.submission_id";
        $command = $connection->createCommand($sqlstaaa);
        $appStaaaaat = $command->queryAll();
        $StatependingCAFUnderprocess = count($appStaaaaat);
        //print_r($StatependingCAFUnderprocess);
        /////////////.///////////////////////////////////////pending State ( 16----10000)//////////////////////////////////////////
        $sqloiuostate = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
 from  bo_application_forward_level
 LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
 LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 where ";
        if ($department_id != 'ALL') {
            $sqloiuostate .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
        }

        $sqloiuostate .= " bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
 AND bac.application_status ='F'
  AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
 AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "'
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16
  AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000
 GROUP BY bac.submission_id";

        $command = $connection->createCommand($sqloiuostate);
        $appstatesss = $command->queryAll();
        $StatependingCAF = count($appstatesss);
        //print_r($StatependingCAF); die;
        //////////////////////////////////////////////


        $totalForwordedToDepartment = $allprocessed + $allpending + $stateProcessedCAF + $statePendingCAF + $districtProcessedWithoutResponseCAF + $stateProcessedWithoutResponseCAF;

        $totalDistrictLevelCAF = $allprocessed + $allpending + $districtProcessedWithoutResponseCAF;

        $totalStateLevelCAF = $stateProcessedCAF + $statePendingCAF + $stateProcessedWithoutResponseCAF;

        $response = array(
            'totalForwordedToDepartment' => $totalForwordedToDepartment,
            'totalDistrictLevelCAF' => $totalDistrictLevelCAF,
            'totalStateLevelCAF' => $totalStateLevelCAF,
            'allprocessed' => $allprocessed,
            'allpending' => $allpending,
            'stateProcessedCAF' => $stateProcessedCAF,
            'statePendingCAF' => $statePendingCAF,
            'districtProcessedWithoutResponseCAF' => $districtProcessedWithoutResponseCAF,
            'stateProcessedWithoutResponseCAF' => $stateProcessedWithoutResponseCAF,
            'districtpendingCAFUnderprocess' => $districtpendingCAFUnderprocess,
            'districtpendingCAF' => $districtpendingCAF,
            'statependingCAFUnderprocess' => $StatependingCAFUnderprocess
        );

        return $response;
    }

/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/// time line for dashboard jitendra //


    /* used to get the  Time Line reports
      @author : jitendra Kumar
      @param:
      @return: array
      @17-02-2018
     */
    public static function getServiceCountForTimelineDashboard($start_year = NULL, $end_year = NULL, $department_id = NULL, $distId = 'ALL') {
        $cond = '';
        //if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
        if ($distId != 'ALL') {
            $cond .= "bac.landrigion_id=$distId and";
        } else {
            $cond .= "";
        }
        $returnArr = array();
        $returnArr['SWA_TA'] = 0;
        $returnArr['SWA_TV'] = 0;
        $returnArr['RTS_TA'] = 0;
        $returnArr['RTS_TV'] = 0;
        $returnArr['GA_TA'] = 0;
        $returnArr['GA_TV'] = 0;
        $returnArr['DN_TA'] = 0;
        $returnArr['DN_TV'] = 0;
        $status_array = array();
        $returnArr1 = array();

        $isactive = 'Y';
        $connection = Yii::app()->db;
        $where_condition = "";
        if ((isset($start_year) && !empty($start_year)) && (isset($end_year) && !empty($end_year))) {
            $where_condition = " AND DATE(apps.created_on)>='$start_year' AND DATE(apps.created_on)<='$end_year'";
        }

        if ($department_id > 0) {
            $where_condition .= " AND sso.department_id='$department_id'";
        }

        $sql = "SELECT apps.sp_app_id,apps.sno,apps.timeline_ref,apps.app_status FROM bo_sp_applications as apps
			INNER JOIN bo_sp_all_applications as sp_ap ON sp_ap.app_id=apps.sp_app_id
			INNER JOIN sso_service_providers as sso ON sso.sp_id=sp_ap.sp_id
			WHERE apps.user_id!='11' AND apps.app_status!='I' AND apps.timeline_ref IS NOT NULL $where_condition
			ORDER BY apps.app_status ASC ";
        //echo $sql; die;
        $command = $connection->createCommand($sql);
        $resList = $command->queryAll();
        if (!empty($resList)) {
            foreach ($resList as $resListArray) {
                $sno = $resListArray['sno'];
                $timeline_ref = $resListArray['timeline_ref'];
                $app_status = $resListArray['app_status'];
                $taken_time_dept_in_days = ReportExt::getDepartmentTime($sno);
                $responseArr = ReportExt::getDepartmentTimeline($timeline_ref, $taken_time_dept_in_days);
                if (!empty($responseArr)) {
                    foreach ($responseArr as $key => $val) {
                        $app_status = $app_status == 'H' ? 'RBI' : $app_status;
                        //START
                        if ($app_status == "P") {
                            $app_status_new = "P";
                        } else if ($app_status == "F") {
                            $app_status_new = "F";
                        } else if ($app_status == "RBI") {
                            $app_status_new = "RBI";
                        } else if ($app_status == "R") {
                            $app_status_new = "R";
                        } else if ($app_status == "A") {
                            $app_status_new = "A";
                        }
                        //END
                        $app_status_array[] = $app_status_new;
                        if (!isset($returnArr1[$key][$app_status_new]))
                            $returnArr1[$key][$app_status_new] = 0;
                        $returnArr1[$key][$app_status_new] = $returnArr1[$key][$app_status_new] + $val;
                        $returnArr[$key] = $returnArr[$key] + $val;
                    }
                }
            }
        }

        if (isset($app_status_array)) {
            $app_status_array = array_unique($app_status_array);
            foreach ($app_status_array as $key => $val) {
                $status_array[] = $val;
            }
        } else {
            $status_array[] = "P";
            $status_array[] = "F";
            $status_array[] = "RBI";
            $status_array[] = "R";
            $status_array[] = "A";
            foreach ($returnArr as $key => $val) {
                foreach ($status_array as $key1 => $val1)
                    $returnArr1[$key][$val1] = 'NA';
            }
        }

        $responseArray['heading_array'] = $returnArr;
        $responseArray['data_array'] = $returnArr1;
        //$responseArray['status_array']  = $status_array;
        //echo '<pre>';print_r($returnArr);echo "<hr>";echo '<pre>';print_r($returnArr1);print_r(array_unique($status_array));
        return $responseArray;
    }

    /* used to get Chart District Wise Dashboard reports
      @author : jitendra Kumar
      @param:startdate ,enddate ,department_id , distId
      @return: array
      @19-02-2018
     */
    public static function getChartDistrictWiseDashboard($startdate,$enddate,$department_id='ALL',$distId='ALL')
 {
  $cond='';
  //if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
  if($distId!='ALL'){ $cond .=" bac.landrigion_id=$distId and " ; } else { $cond .=""; }

   $sql="SELECT * FROM bo_district";
   $connection=Yii::app()->db;
   $command  =$connection->createCommand($sql);
   $distDAta =$command->queryAll();
   $allpending=0; $allprocessed=0;$pending=array();
   $i=0;

  foreach($distDAta as $ljk){
      $processedCAF=0;$pendingCAF=0;
      $dID=$ljk['district_id'];
      $processedWithoutResponse=0;
      $pending[$i]['name']   =$ljk['distric_name'];
      $pending[$i]['pending']=0;
      $pending[$i]['district_id']=$dID;
      $pending[$i]['processed']=0;
      $sqlhjgjh="SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
      from  bo_application_forward_level
      LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
      LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
      where ";

      if($department_id!='ALL'){
          $sqlhjgjh .="  bo_application_forward_level.forwarded_dept_id = $department_id AND ";
       }
          $sqlhjgjh .=" bac.application_id=1 AND bac.submission_id not in('22','268')
      AND bac.landrigion_id=$dID AND bo_application_forward_level.next_role_id=3
      AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id";

        //echo $sqlhjgjh;die;
      $connection=Yii::app()->db;
      $command=$connection->createCommand($sqlhjgjh);
      $allData=$command->queryAll();
                       // print_r($allData); die;
      foreach($allData as $ljkdd){

       if($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="F"){
           $pendingCAF=$pendingCAF+1;
           $allpending=$allpending+1;
             $hjk[$dID][]=$ljkdd['submission_id'];
         }elseif($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="A"){
           $processedWithoutResponse=$processedWithoutResponse+1;
         }elseif($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="R" ){
           $processedWithoutResponse=$processedWithoutResponse+1;
         }else{
           if($ljkdd['approv_status']=="V"){
             $processedCAF=$processedCAF+1;
            $allprocessed=$allprocessed+1;
           }
         }

       $pending[$i]['pending']=$pendingCAF;
       $pending[$i]['processedWithoutResponse']=$processedWithoutResponse;
    
     
      /////////////////////////////////////////////////////////////////////////////////////////

       $sqlsasgfdg="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
       from  bo_application_forward_level
       LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
       LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
       where ";

      if($department_id!='ALL'){
       $sqlsasgfdg .=" bo_application_forward_level.forwarded_dept_id = $department_id AND ";
      }
          $sqlsasgfdg.=" bac.landrigion_id=$dID
       AND bac.application_id=1
       AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='V' AND bo_application_forward_level.next_role_id=3
       AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
      
      //echo  $sqlsasgfdg;die;
      $connection=Yii::app()->db;
      $command=$connection->createCommand($sqlsasgfdg);
      $applicationSubhjgj=$command->queryAll();
      $allprocessedhgfhg =count($applicationSubhjgj);
      // echo "<pre/>";
                //print_r($allprocessedhgfhg);die;
      $pending[$i]['processed']=$allprocessedhgfhg;
      //////////////////////////////////////////////////////////////////////////////////////////////////////////
   }
              $i++;
  }
   
   

   return $pending;
}




// end  //
/// Chart get Line Chart Grievance Dashboard jitendra //
    /* used to get Line Chart Grievance reports
      @author : jitendra Kumar
      @param:startdate ,enddate ,department_id , distId
      @return: array
      @19-02-2018
     */
    public static function getLineChartGrievance($startdate,$enddate,$department_id='ALL',$distId='ALL')
 {
	$cond='';
	$grandtotal =0;
	//if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
	// echo $distId;die;
	 
	if($distId!="ALL"){$cond .=" bac.landrigion_id=$distId and " ; } else { $cond .=""; }

	    $grandtotal=0;$grandopen=0;$grandclose=0;
	    $lineChartGrievance = array();
			$sql="SELECT * FROM bo_district";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$distDAta=$command->queryAll();
			$i=0;

	foreach($distDAta as $hjgkghk){

		$key=$hjgkghk['district_id'];
		$resultarr[$key]['dname']=$hjgkghk['distric_name'];
		$resultarr[$key]['open']=0;
		$resultarr[$key]['close']=0;
		$resultarr[$key]['total']=0;
   //$i++;
	}

	$sqlgfgf="SELECT d.department_name ,gd.grievence_no ,g.grievance_status,g.grievence_created_on ,gsd.status_change_date ,
	ds.distric_name ,ds.district_id FROM bo_grievance g
INNER JOIN bo_grievance_detail gd ON g.grievence_no = gd.grievence_no
INNER JOIN bo_departments d ON gd.dept_id=d.dept_id
INNER JOIN bo_district ds ON gd.district_id=ds.district_id
LEFT JOIN bo_grievance_status_detail gsd ON gsd.grievence_no=g.grievence_no where ";

			if($department_id!='ALL'){
					$sqlgfgf.=" d.dept_id='".$department_id."' AND ";
			}
			    $sqlgfgf.="  g.grievance_status IN ('O','C') and g.grievence_created_on >='".$startdate."' and g.grievence_created_on <'".$enddate."' ";

		$connection=Yii::app()->db;
		$command=$connection->createCommand($sqlgfgf);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields); die;
		  if(!empty($Fields))
		{

		foreach ($Fields as $key => $field)
		{
		if( isset($field['district_id']))
			{
			   $sectorid=$field['district_id'];
			   $newdetails[$sectorid][$key]['grievence_no']=$field['grievence_no'];
			   $newdetails[$sectorid][$key]['grievance_status']=$field['grievance_status'];
			   $newdetails[$sectorid][$key]['distname']=$field['distric_name'];
			}

		}
		// print_r($newdetails); die;
    $i=0;
		foreach ($newdetails as $key => $countdetails)
		    {     $open=0; $close=0;
					foreach($countdetails as $df){  //print_r($df); die;
					if($df['grievance_status']=='O') { $open=$open+1; }
					if($df['grievance_status']=='C') { $close=$close+1; }
					$resultarr[$key]['dname']=$df['distname'];
					$resultarr[$key]['open']=$open;
					$resultarr[$key]['close']=$close;
					$resultarr[$key]['total']=$open+$close;
												}
					$grandtotal=$grandtotal+($open+$close);
					$grandopen=$grandopen+$open;
					$grandclose=$grandclose+$close;
         //$i++;
			}

		//	print_r($resultarr);

		}

	$resultarrMain = array();
	$i=0;
	foreach($resultarr as $key => $value) {
				$resultarrMain[$i]['dname'] =$value['dname'];
				$resultarrMain[$i]['open']  =$value['open'];
				$resultarrMain[$i]['close'] =$value['close'];
				$resultarrMain[$i]['total'] =$value['total'];
				$resultarrMain[$i]['district_id'] =$key;
         $i++;
	}
		if($grandtotal){
			$resultarrMain['grandtotal'] =$grandtotal;
		}else{
			$resultarrMain['grandtotal'] =0;
		}

		//echo "<pre/>";
		//print_r($resultarrMain);die;

		return $resultarrMain;
}


// end  //
///  Pie Chart CAF PUP State District jitendra //P=process ,UP =underprocess
    /* used to get Line Chart Grievance reports
      @author : jitendra Kumar
      @param:startdate ,enddate ,department_id , distId
      @return: array
      @19-02-2018
     */

    public static function getPieChartCAFPUPStateDistrict($startdate, $enddate, $department_id = 'ALL', $distId = 'ALL') {
        $cond = '';
        //if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
        if ($distId != 'ALL') {
            $cond .= " bac.landrigion_id=$distId and ";
        } else {
            $cond .= "";
        }

        $grandtotal = 0;
        $grandopen = 0;
        $grandclose = 0;
        $peiChartCAFPUPStateDistrict = array();
        $chartdata = array();

        $sql = "SELECT * FROM bo_district";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $distDAta = $command->queryAll();
        $allpending = 0;
        $allprocessed = 0;
        $pending = array();
        foreach ($distDAta as $ljk) {
            $processedCAF = 0;
            $pendingCAF = 0;
            $dID = $ljk['district_id'];
            $processedWithoutResponse = 0;
            $pending[$dID]['name'] = $ljk['distric_name'];
            $pending[$dID]['pending'] = 0;
            $pending[$dID]['processed'] = 0;
            $sqlhjgjh = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
					  from  bo_application_forward_level
					  LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
					  LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
					  where ";
            if ($department_id != 'ALL') {
                $sqlhjgjh .= " bo_application_forward_level.forwarded_dept_id = $department_id AND ";
            }

            $sqlhjgjh .= " bac.application_id=1 AND bac.submission_id not in('22','268')
					  AND bac.landrigion_id=$dID AND bo_application_forward_level.next_role_id=3
					  AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id";

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sqlhjgjh);
            $allData = $command->queryAll();
            //print_r($allData); die;
            // echo "===========";die;
            foreach ($allData as $ljkdd) {

                if ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "F") {
                    $pendingCAF = $pendingCAF + 1;
                    $allpending = $allpending + 1;
                    $hjk[$dID][] = $ljkdd['submission_id'];
                } elseif ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "A") {
                    $processedWithoutResponse = $processedWithoutResponse + 1;
                } elseif ($ljkdd['approv_status'] == "P" && $ljkdd['application_status'] == "R") {
                    $processedWithoutResponse = $processedWithoutResponse + 1;
                } else {
                    if ($ljkdd['approv_status'] == "V") {
                        $processedCAF = $processedCAF + 1;
                        $allprocessed = $allprocessed + 1;
                    }
                }

                $pending[$dID]['pending'] = $pendingCAF;
                $pending[$dID]['processedWithoutResponse'] = $processedWithoutResponse;

                /////////////////////////////////////////////////////////////////////////////////////////

                $sqlsasgfdg = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
					    from  bo_application_forward_level
					    LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
					    LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
					    where ";
                if ($department_id != 'ALL') {
                    $sqlsasgfdg .= " bo_application_forward_level.forwarded_dept_id = $department_id AND  ";
                }

                $sqlsasgfdg .= " bac.landrigion_id=$dID
					    AND bac.application_id=1
					    AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268')  AND bo_application_forward_level.next_role_id=3
					    AND bo_application_forward_level.created_on >='" . $startdate . "' AND bo_application_forward_level.created_on <'" . $enddate . "' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sqlsasgfdg);
                $applicationSubhjgj = $command->queryAll();
                $allprocessedhgfhg = count($applicationSubhjgj);
                $pending[$dID]['processed'] = $allprocessedhgfhg;
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
        }
        if ((isset($pending) && !empty($pending))) {
            $r1[] = array();
            $r1[1] = "#FF6600";
            $r1[2] = "#41e8f4";
            $r1[3] = "#DDDDDD";
            $r1[4] = "#F8FF01";  //#FCD202   #f44141
            $r1[6] = "#27a352";
            $r1[7] = "#0D8ECF";
            $r1[8] = "#f441f1";
            $r1[9] = "#2A0CD0";
            $r1[10] = "#8A0CCF";
            // $r1[5]="B0DE09";
            $r1[13] = "#FF9E01";
            $r1[14] = "#B0DE09";
            $r1[15] = "#f44197";
            $r1[16] = "#f4dc41";
            $r1[20] = "#41f455";
            $chartdata[] = array();
            // print_r($pending); //die;
            foreach ($pending as $hghg => $endin) {
                $chartdata[$hghg] = $endin;
                $chartdata[$hghg]['color'] = @$r1[$hghg];
            }
            unset($chartdata[0]);
        }
        $peiChartCAFPUPStateDistrict['districtPendingCAF'] = $chartdata;
        return $peiChartCAFPUPStateDistrict;
    }

// end  // getPieChartTotalOpenGrievance
///  Pie Chart CAF PUP State District jitendra //P=process ,UP =underprocess
    /* used togetPieChartCAFPUPStateDistrict reports
      @author : jitendra Kumar
      @param:startdate ,enddate ,department_id , distId
      @return: array
      @19-02-2018
     */

    public static function getPieChartTotalOpenGrievance($startdate, $enddate, $department_id = 'ALL', $distId = 'ALL') {
        $cond = '';
        //if($department_id!='ALL'){ $cond="sso_service_providers.department_id=$department_id and" ; } else { $cond=""; }
        if ($distId != 'ALL') {
            $cond .= " bac.landrigion_id=$distId and ";
        } else {
            $cond .= "";
        }

        $grandtotal = 0;
        $grandopen = 0;
        $grandclose = 0;
        $pieChartTotalOpenGrievance = array();
        $sql = "SELECT * FROM bo_district";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $distDAta = $command->queryAll();
        foreach ($distDAta as $hjgkghk) {

            $key = $hjgkghk['district_id'];
            $lineChartGrievance[$key]['dname'] = $hjgkghk['distric_name'];
            $lineChartGrievance[$key]['open'] = 0;
            $lineChartGrievance[$key]['close'] = 0;
            $lineChartGrievance[$key]['total'] = 0;
        }

        $sqlgfgf = "SELECT d.department_name ,gd.grievence_no ,g.grievance_status,g.grievence_created_on ,gsd.status_change_date ,
					 ds.distric_name ,ds.district_id FROM bo_grievance g
				 INNER JOIN bo_grievance_detail gd ON g.grievence_no = gd.grievence_no
				 INNER JOIN bo_departments d ON gd.dept_id=d.dept_id
				 INNER JOIN bo_district ds ON gd.district_id=ds.district_id
				 LEFT JOIN bo_grievance_status_detail gsd ON gsd.grievence_no=g.grievence_no where ";

        if ($department_id != 'ALL') {
            $sqlgfgf .= " d.dept_id='" . $department_id . "' AND ";
        }
        $sqlgfgf .= "  g.grievance_status IN ('O','C') and g.grievence_created_on >='" . $startdate . "' and g.grievence_created_on <'" . $enddate . "' ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlgfgf);
        $Fields = $command->queryAll();
        // echo "<pre>";print_r($Fields); die;
        if (!empty($Fields)) {

            foreach ($Fields as $key => $field) {
                if (isset($field['district_id'])) {
                    $sectorid = $field['district_id'];
                    $newdetails[$sectorid][$key]['grievence_no'] = $field['grievence_no'];
                    $newdetails[$sectorid][$key]['grievance_status'] = $field['grievance_status'];
                    $newdetails[$sectorid][$key]['distname'] = $field['distric_name'];
                }
            }
            // print_r($newdetails); die;

            foreach ($newdetails as $key => $countdetails) {
                $open = 0;
                $close = 0;
                foreach ($countdetails as $df) {  //print_r($df); die;
                    if ($df['grievance_status'] == 'O') {
                        $open = $open + 1;
                    }
                    if ($df['grievance_status'] == 'C') {
                        $close = $close + 1;
                    }
                    $lineChartGrievance[$key]['dname'] = $df['distname'];
                    $lineChartGrievance[$key]['open'] = $open;
                    $lineChartGrievance[$key]['close'] = $close;
                    $lineChartGrievance[$key]['total'] = $open + $close;
                }
                $grandtotal = $grandtotal + ($open + $close);
                $grandopen = $grandopen + $open;
                $grandclose = $grandclose + $close;
            }
            //$lineChartGrievance['grandtotal'] =$grandtotal;
            //	print_r($resultarr);
        }
        if ((isset($lineChartGrievance) && !empty($lineChartGrievance))) {
            $r1[] = array();
            $r1[1] = "#FF6600";
            $r1[2] = "#41e8f4";
            $r1[3] = "#DDDDDD";
            $r1[4] = "#F8FF01";  //#FCD202   #f44141
            $r1[6] = "#27a352";
            $r1[7] = "#0D8ECF";
            $r1[8] = "#f441f1";
            $r1[9] = "#2A0CD0";
            $r1[10] = "#8A0CCF";
            // $r1[5]="B0DE09";
            $r1[13] = "#FF9E01";
            $r1[14] = "#B0DE09";
            $r1[15] = "#f44197";
            $r1[16] = "#f4dc41";
            $r1[20] = "#41f455";
            $chartdatagggg[] = array();
            $chartFinalArray[] = array();
            // print_r($resultarr);die;
            foreach ($lineChartGrievance as $hghggfg => $endinhg) {
                //print_r($resultarr); die;
                $chartdatagggg[$hghggfg] = $endinhg;
                $chartdatagggg[$hghggfg]['color'] = @$r1[$hghggfg];
            }
            unset($chartdatagggg[0]);
            foreach ($chartdatagggg as $chartgriv) {
                $dname = $chartgriv['dname'];
                $chartFinalArray['visits'][$dname] = $chartgriv['open'];
                $chartFinalArray['color'][$dname] = $chartgriv['color'];
            }
        }

        $pieChartTotalOpenGrievance['totalOpenGrievance'] = $grandopen;
        $pieChartTotalOpenGrievance['openGrievance'] = $chartdatagggg;
        return $pieChartTotalOpenGrievance;
    }

////


/*

    static function getV_Name($V_code) {
        $sql = "SELECT Description FROM NIC_Codes   where NIC_V_Digit=:V_code";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":V_code", $V_code, PDO::PARAM_STR);
        $appCounts = $command->queryRow();
        // echo "<pre>";print_r($appCount);die;
        if ($appCounts === false)
            return false;
        $remark = $appCounts['Description'];

        return $remark;
    }*/

//// Jitendra singh Start API for Nodel officer Date 22-feb-2018 ///
    /**
     * to get Forwarded application
     * @author : Jitendra Singh
     * @param: Dept_id
     * @param: user_id
     */
    public static function getForwardedAppOfDept($dept_id, $user_id) {
        $active = 'Y';
        $app_status = 'F';
        $pending = 'P';
        $uid = $user_id;
        $user_data = UserExt::getUserEmail($user_id);
        $emailid = $user_data['0'];
        //print_r($emailid);die;
        $role_id = RolesExt::getUserRoleViaId($user_id);
        $distt = UserExt::getUsersAllDistt($emailid);
        $usersAllDistt = 0;
        if ($distt)
            $usersAllDistt = implode(",", $distt);
        $sql = "SELECT DISTINCT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on,appfl.verifier_user_comment,appfl.approv_status,appfl.appr_lvl_id FROM bo_user_role_mapping rm
							INNER JOIN bo_application_forward_level appfl
							ON appfl.next_role_id = rm.role_id
							INNER JOIN bo_application_submission appsb
							ON appfl.app_sub_id=appsb.submission_id
							INNER JOIN bo_application_verification_level appvl
							ON appsb.submission_id=appvl.app_Sub_id
							INNER JOIN bo_user usr
							ON appsb.landrigion_id=usr.disctrict_id
							WHERE appfl.forwarded_dept_id=:dept_id AND is_mapping_active=:active AND appsb.landrigion_id IN ($usersAllDistt) AND appfl.next_role_id=:role_id  AND appvl.approv_status=:app_status AND appfl.approv_status=:pending order by appfl.app_sub_id";

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $command->bindParam(":dept_id", $dept_id, PDO::PARAM_STR);
        $command->bindParam(":pending", $pending, PDO::PARAM_STR);
        $command->bindParam(":role_id", $role_id['role_id'], PDO::PARAM_INT);
        // $command->bindParam(":distt",$distt['disctrict_id'],PDO::PARAM_INT);
        //$command->bindParam(":uid",$uid,PDO::PARAM_INT);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        // $command->bindParam(":emailid",$emailid,PDO::PARAM_STR);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

///// End   ////////////////   
    ///////////////////////////////////////////////////////////////////////////////////////////////////
/*
author@ jitendra singh
*/
public static function getGrievanceReportDashboardCount($deptId,$distId,$startdate,$enddate)
{
    // 62-HOD , 71-SECRETARY ,72-Principal Secretary ,73- Cheif Secretary ,74-DM

    $cond='';
    if($deptId!='ALL'){ $cond="d.dept_id=$deptId and " ; } else { $cond=""; }
    if($distId!='ALL'){ $cond=$cond."ds.district_id=$distId and " ; } else { $cond=$cond.""; }

 $sqlssss="SELECT d.department_name ,gd.grievence_no ,g.grievance_status,g.grievence_created_on ,gsd.status_change_date , ds.distric_name ,ds.district_id FROM bo_grievance g
INNER JOIN bo_grievance_detail gd ON g.grievence_no = gd.grievence_no
INNER JOIN bo_departments d ON gd.dept_id=d.dept_id
INNER JOIN bo_district ds ON gd.district_id=ds.district_id
LEFT JOIN bo_grievance_status_detail gsd ON gsd.grievence_no=g.grievence_no
where $cond  g.grievance_status IN ('O','C') and g.grievence_created_on >=:startdate and g.grievence_created_on <=:enddate ";

        $connection=Yii::app()->db;
        $command=$connection->createCommand($sqlssss);
        $command->bindParam(":startdate",$startdate,PDO::PARAM_INT);
        $command->bindParam(":enddate",$enddate,PDO::PARAM_STR);
        $Fields=$command->queryAll();
       // echo "<pre>";print_r($Fields); die;

        if(!empty($Fields))
        {    $open=0; $close=0;
         foreach ($Fields as $key => $countdetails)
            {
                    if($countdetails['grievance_status']=='O') { $open=$open+1; }
                    if($countdetails['grievance_status']=='C') { $close=$close+1; }
                    $resultarr['open']=$open;
                    $resultarr['close']=$close;
                    $resultarr['total']=$open+$close;

            }
        //echo "<pre>";print_r($resultarr); die;
        }
        if(empty($Fields))
        {
        $resultarr['open']=0;
        $resultarr['close']=0;
        $resultarr['total']=0;
        }
return $resultarr;
}

public static function getConsolidatedCafStatusCount2() {
        $distID = null; $resultFor = null;
        
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;
        // For current month activity Report
         $flg=0;
          $ISAJoin="";
          $ISACondition=""; 

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

        /* Getting District Approved Application */
        if ($resultFor == "districtApproved") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'A'";
            $flg=1;
            
        }

        /* Getting State Approved Application */
        if ($resultFor == "stateApproved") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'A'";
             $flg=1;
        }

        /* Getting District Rejected Application */
        if ($resultFor == "districtRejected") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'R'";
             $flg=1;
        }

        /* Getting State Rejected Application */
        if ($resultFor == "stateRejected") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'R'";
             $flg=1;
        }

        /* Getting current District Forwarded Application */
        if ($resultFor == "districtForwarded") {
            $nextRoleID = "'7'";
            $actionStatus = "'F'";
             $flg=1;
        }

        /* Getting current State Forwarded Application */
        if ($resultFor == "stateForwarded") {
            $nextRoleID = "'4'";
            $actionStatus = "'F'";
             $flg=1;
        }

        /* Getting current District Pending Application */
        if ($resultFor == "districtPending") {
            $nextRoleID = "'7'";
            $actionStatus = "'P'";
             
        }

        /* Getting current State Pending Application */
        if ($resultFor == "statePending") {
            $nextRoleID = "'4'";
            $actionStatus = "'P'";
        }

        /* Getting current District Reverted Application */
        if ($resultFor == "districtReverted") {
            $nextRoleID = "'7'";
            $actionStatus = "'H'";
             $flg=1;
                     }

        /* Getting current State Reverted Application */
        if ($resultFor == "stateReverted") {
            $nextRoleID = "'4'";
            $actionStatus = "'H'";
             $flg=1;
        }

        /* Getting total District Submitted Application */
        if ($resultFor == "districtSubmitted") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','H','R','P','F'";
          
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
           
        }

        /* Getting current District Submitted Application */
        if ($resultFor == "districtForwardedAndDisposed") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','R','F'";
            $flg=1;
        }

        /* Getting current State Forwarded and Disposed Application */
        if ($resultFor == "stateForwardedAndDisposed") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','R','F'";
            $flg=1;
        }

        // For JSON Value Count  EG: $inquireAbout="invstmnt_in_total";

        /* District - Approved Male Employment */
        if ($resultFor == "districtMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=1;
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=2;
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
            $flg=2;
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
            $flg=2;
        }
        /* District - Proposed Manufacturing */
        if ($resultFor == "districtProposedManufacturing") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
            $flg=0;
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
            $flg=0;
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
            $flg=0;
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
            $flg=0;
        }

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        
        if($flg==1){
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_updated_date_time)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_updated_date_time)<='" . $to_date . "'";
        }
        }
        
        if($flg==0){
        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";      
        }
        
        if($flg==2){
        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status NOT IN ('ISA','IPS') group by bo_application_flow_logs.submission_id";      
        }
        
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
       
        
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
        
        if(isset($distID) && $distID != ''){
            $distCondition = " landrigion_id IN ($distID) AND ";
        }
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE $distCondition AND application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND user_id NOT IN ($demoUserID) $fromToDateCondition $ISACondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
            //  count based on json fields into field_value field   
            if (isset($Fields) && !empty($Fields)) {
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    // Count of values start here
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {
                                // count of Number starts here - ntrofunit                              
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }
    
    
    
    
 public static function getConsolidatedCafStatusCountISA($distID = null, $resultFor = null) {
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

        /* Getting District Approved Application */
        if ($resultFor == "districtApproved") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'A'";
        }

        /* Getting State Approved Application */
        if ($resultFor == "stateApproved") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'A'";
        }

        /* Getting District Rejected Application */
        if ($resultFor == "districtRejected") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'R'";
        }

        /* Getting State Rejected Application */
        if ($resultFor == "stateRejected") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'R'";
        }

        /* Getting current District Forwarded Application */
        if ($resultFor == "districtForwarded") {
            $nextRoleID = "'7'";
            $actionStatus = "'F'";
        }

        /* Getting current State Forwarded Application */
        if ($resultFor == "stateForwarded") {
            $nextRoleID = "'4'";
            $actionStatus = "'F'";
        }

        /* Getting current District Pending Application */
        if ($resultFor == "districtPending") {
            $nextRoleID = "'7'";
            $actionStatus = "'P'";
        }

        /* Getting current State Pending Application */
        if ($resultFor == "statePending") {
            $nextRoleID = "'4'";
            $actionStatus = "'P'";
        }

        /* Getting current District Reverted Application */
        if ($resultFor == "districtReverted") {
            $nextRoleID = "'7'";
            $actionStatus = "'H'";
        }

        /* Getting current State Reverted Application */
        if ($resultFor == "stateReverted") {
            $nextRoleID = "'4'";
            $actionStatus = "'H'";
        }

        /* Getting total District Submitted Application */
        if ($resultFor == "districtSubmitted") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting current District Submitted Application */
        if ($resultFor == "districtForwardedAndDisposed") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','R','F'";
        }

        /* Getting current State Forwarded and Disposed Application */
        if ($resultFor == "stateForwardedAndDisposed") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','R','F'";
        }

        // For JSON Value Count  EG: $inquireAbout="invstmnt_in_total";

        /* District - Approved Male Employment */
        if ($resultFor == "districtMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* District - Proposed Manufacturing */
        if ($resultFor == "districtProposedManufacturing") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
        }

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        
       
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)<='" . $to_date . "'";
        }
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
         if(!empty($unit_type)){             
             $fieldvalueCase = '"ntrofunittype":"' . $unit_type . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
        

        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
            //  count based on json fields into field_value field   
            if (isset($Fields) && !empty($Fields)) {
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    // Count of values start here
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {
                                // count of Number starts here - ntrofunit                              
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }
    
    
        public static function getOverallTimeTakenbyNodal($cafID = null) {

        $connection = Yii::app()->db;

        $sql = "SELECT * FROM bo_application_flow_logs WHERE submission_id=:caf_id AND application_status !='IPS' ORDER BY log_id ASC";

        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $cafID, PDO::PARAM_STR);
        $appDetail = $command->queryAll();
        $sql = "SELECT created_on as application_created_date FROM bo_application_verification_level WHERE app_Sub_id=:caf_id and (next_role_id=7 or next_role_id=4)";
        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $caf_id, PDO::PARAM_STR);
        $rs = $command->queryRow();
        array_push($appDetail, $rs);
        
         // Fetching First entry of applicant while he satrted fillling application
             $sql = "SELECT * FROM bo_application_flow_logs where submission_id='$cafID' AND application_status='IPS' ORDER BY log_id LIMIT 1";

        $command = $connection->createCommand($sql);
        $firstEntryOfApplicantForCaf = $command->queryAll(); 
        $appDetails=array_merge($firstEntryOfApplicantForCaf,$appDetail);
        
//print_r($appDetails);
        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
        foreach ($appDetails as $detailoftransaction) {
            
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['log_id'])) {
               // echo "+";
                if (@$detailoftransaction['application_status'] == "ISA") {
                    @$status = "Submission of $typOfApp";
                    $comments = "Application Submitted";
                } else {
                    $comments = @$detailoftransaction['approver_comments'];
                    $actionTakenBy = @$detailoftransaction['approval_user_id'];
                    @$status = @$detailoftransaction['application_status'];
                }
                if (@$detailoftransaction['approver_role_id'] == 7) {
                    $role = "District $typOfApp Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 4) {
                    $role = "State $typOfApp Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 33) {
                    $role = "District $typOfApp Approver";
                }
                if (@$detailoftransaction['approver_role_id'] == 34) {
                    $role = "State $typOfApp Approver";
                }
                if (@$detailoftransaction['approver_role_id'] == "") {
                    $role = "Investor";
                }
                if (@$detailoftransaction['application_status'] == "RBI") {
                    @$status = "Reverted to Investor";
                }
                if (@$detailoftransaction['application_status'] == "IBD") {
                    @$status = "Response from Investor";
                    $comments = "Application Re-submitted";
                }
                if (@$detailoftransaction['application_status'] == "F") {
                    $tid = $f = $f + 1;
                    @$status = "Forwarded to Departments for comments, See <a href='$transUrl'>Transaction ID : " . $tid . "</a>";
                }
                if (@$detailoftransaction['application_status'] == "V") {
                    @$status = "Verified";
                }
                if (@$detailoftransaction['application_status'] == "R") {
                    @$status = "Rejected";
                }
                if (@$detailoftransaction['application_status'] == "RBN") {
                    @$status = "Reverted by Approver to Verifier";
                }
                if (@$detailoftransaction['application_status'] == "IPS") {
                    @$status = "Started Filling $typOfApp";
                }
                if (@$status == "Z") {
                    @$status = "<span title='Incomplete forms archived due to delay in submission'>Archived</span>";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created_date_time'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                   // echo $timeInString."--"; 
                    if ($role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                  
//                    $years = floor($timeInString / (365 * 60 * 60 * 24));
//                    $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
//                    $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
//                    $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
//                    $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
//                    $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
//                    $allDays = ($years * 365) + ($months * 30) + $days;
//                    $timetaken = "$allDays days, $hours hrs, $minuts min";
                }
        $count=$count+1;}}
                 // echo $invTime."====".$nodTime; 
                $timetakenInv = 0;
                $years = floor($invTime / (365 * 60 * 60 * 24));
                $months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenInv = "$allDays days";
                $INVTIME = $timetakenInv;


                $timetakenNod = 0;
                $years = floor($nodTime / (365 * 60 * 60 * 24));
                $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenNod = $allDays;
                $NODTIME = $timetakenNod;
            
      
        return $NODTIME;
    }

    

}




?>