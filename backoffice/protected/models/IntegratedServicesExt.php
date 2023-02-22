<?php

class IntegratedServicesExt extends Applications {

    /**
     * This function is used to get the status and some detail of a Service
     * @Author: Rahul Kumar
     * @Params: serviceID
     * @Return: Array (array of appid, app name,all status(P,R,RBI,A) and their prospective count and timeline of that service )
     */
    static function getTotalServicesAndAllStatus($serviceID = null, $serviceName = null) {
        $connection = Yii::app()->db;
        $Y="'Y'";
        $sql = "SELECT sso_sp_applcations_detail.timeline_period,bo_sp_all_applications.app_name,bo_sp_all_applications.app_id,bo_sp_all_applications.is_swcs_service,bo_sp_all_applications.is_pre_estb,bo_sp_all_applications.is_pre_oper,bo_sp_all_applications.is_other,bo_sp_applications.app_status,COUNT(bo_sp_applications.app_status) as count1 FROM `bo_sp_all_applications` INNER JOIN bo_sp_applications ON bo_sp_all_applications.app_id=bo_sp_applications.sp_app_id  INNER JOIN sso_sp_applcations_detail ON bo_sp_all_applications.app_id=sso_sp_applcations_detail.app_id WHERE bo_sp_all_applications.app_id =$serviceID AND bo_sp_all_applications.is_app_active=$Y GROUP BY bo_sp_applications.app_status ";
        $command = $connection->createCommand($sql);
        $depptt = $command->queryAll();
        if (!empty($depptt)) {     
       
        foreach ($depptt as $d) {
            $id = $d['app_id'];
            $status = $d['app_status'];
            $newarray[$id]['name'] = $d['app_name'];
            $newarray[$id][$status] = $d['count1'];
            $ty=$d['is_swcs_service']."".$d['is_pre_estb']."".$d['is_pre_oper']."".$d['is_other'];
            if($ty=="YYNN"){$type="C.T.E";}
           else if($ty=="YNYN"){$type="C.T.O";}
            else{$type="Other";}
       
             //$newarray[$id]['type'] = $ty;
           $newarray[$id]['type'] = $type;
            $newarray[$id]['timeline'] = $d['timeline_period'];
        }
        }
        if ($newarray === false)
            return false;
        return $newarray;
    }

    /**
     * This function is used to get all the service of a department
     * @Author: Rahul Kumar
     * @Params: departmentID
     * @Return: Array (array of appid, app name) of given department
     */
    static function getTotalServicesOfDepartment($departmentID = null) {

        $connection = Yii::app()->db;
        $sql = "SELECT app_id,app_name FROM `bo_sp_all_applications` WHERE `sp_id`=$departmentID";
        $command = $connection->createCommand($sql);
        $deppt = $command->queryAll();
        if ($deppt === false)
            return false;
        return $deppt;
    }
    
        /**
     * This function is used to return all  application applied for particlar Service
     * @Author: Rahul Kumar
     * @Params: serviceID
     * @Return: Array (array of Application ID, Application Name, and Application Status) of given service
     */
    static function getTotalApplicationWithStatusForParticularService($serviceID = null) {

        $connection = Yii::app()->db;
        $sql = "SELECT app_id,user_id,caf_id,app_name,app_status,unit_name FROM `bo_sp_applications` WHERE `sp_app_id`=$serviceID";
        $command = $connection->createCommand($sql);
        $allApplicatiosForParticularServiceWithStatus = $command->queryAll();
        if ($allApplicatiosForParticularServiceWithStatus === false)
            return false;
        return $allApplicatiosForParticularServiceWithStatus;
    }
    
        /**
     * This function is used to return all  detail of applied application for services
     * @Author: Rahul Kumar
     * @Params: applicationID, userID
     * @Return: Array (array of all field value) of given service
     */
    static function getTotalApplicationDetail($applicationID = null ,$userID = null) {
        $connection = Yii::app()->db;
        $sql = "SELECT field_value FROM `bo_application_submission` WHERE submission_id=$applicationID AND user_id=$userID";
        $command = $connection->createCommand($sql);
        $allApplicatiosDetail = $command->queryAll();
        if ($allApplicatiosDetail === false)
            return false;
        return $allApplicatiosDetail;
    }

    
   /**
     * This function is used to return all  progress services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */
static function getAllTotalSWCSProgressServices($sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_app_id=:sp_app_id and a.app_status in('P','o','O') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_app_id",$sp_app_id,PDO::PARAM_STR);
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
/**
     * This function is used to return all  revereted services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getAllTotalSWCSRevertedServices($sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_app_id=:sp_app_id and a.app_status in('H','RBI') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_app_id",$sp_app_id,PDO::PARAM_STR);
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

/**
     * This function is used to return all  rejected services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getAllTotalSWCSRejectedServices($sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_app_id=:sp_app_id and a.app_status in('R') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_app_id",$sp_app_id,PDO::PARAM_STR);
$command->bindParam(":is_swcs_service",$is_swcs_service,PDO::PARAM_STR);
$command->bindParam(":is_pre_estb",$is_pre_estb,PDO::PARAM_STR);
$command->bindParam(":is_pre_oper",$is_pre_oper,PDO::PARAM_STR);
$command->bindParam(":is_other",$is_other,PDO::PARAM_STR);
$appCounts=$command->queryRow();    
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

/**
     * This function is used to return all  approved services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getAllTotalSWCSApprovedServices($sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and a.sp_app_id=:sp_app_id and a.app_status in('A') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_app_id",$sp_app_id,PDO::PARAM_STR);
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

    
   /**
     * This function is used to return all  progress services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_app_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */
   static function getTotalSWCSProgressServices($sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name OR a.app_name='nonexempted' where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and b.sp_id=:sp_id and a.app_status in('P','o','O') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_id",$sp_id,PDO::PARAM_STR);
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
/**
     * This function is used to return all  revereted services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getTotalSWCSRevertedServices($sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and b.sp_id=:sp_id and a.app_status in('H','RBI') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_id",$sp_id,PDO::PARAM_STR);
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

/**
     * This function is used to return all  rejected services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getTotalSWCSRejectedServices($sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and b.sp_id=:sp_id and a.app_status in('R') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
echo $sql;die;
$appCounts=$command->queryRow();    
if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];

}

/**
     * This function is used to return all  approved services for an application
     * @Author: Rahul Kumar
     * @Params: $sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other
     * @Return: Array 
     */

static function getTotalSWCSApprovedServices($sp_id,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and b.sp_id=:sp_id and a.app_status in('A') and b.is_swcs_service=:is_swcs_service and b.is_pre_estb=:is_pre_estb and b.is_pre_oper=:is_pre_oper and b.is_other=:is_other";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$command->bindParam(":sp_id",$sp_id,PDO::PARAM_STR);
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


static function getCalculatedDepartmentWiseServices($IDS,$Status,$is_swcs_service,$is_pre_estb, $is_pre_oper, $is_other){    
//$sql= "SELECT count(*) as givenstatuscount FROM `bo_sp_applications` INNER JOIN bo_sp_all_applications ON bo_sp_applications.sp_app_id=bo_sp_all_applications.app_id WHERE bo_sp_applications.sp_app_id IN ('$IDS') AND bo_sp_applications.app_status IN ('$Status') AND bo_sp_all_applications.is_swcs_service='$is_swcs_service' and bo_sp_all_applications.is_pre_estb='$is_pre_estb' and bo_sp_all_applications.is_pre_oper='$is_pre_oper' and bo_sp_all_applications.is_other='$is_other'";
   if($Status=="P"){
		$Status="P','F','o','O";
	}  
 if($Status=="RBI"){
		$Status="H','RBI";
	}	
$sql="SELECT count(*) as swcspreetbhcount FROM bo_sp_applications as a inner join bo_sp_all_applications as b ON a.app_name=b.int_app_name where  a.USER_ID NOT IN('11','30','243','246','253','269','280','313','75722846') and b.sp_id IN ('$IDS') and a.app_status in('$Status') and b.is_swcs_service='$is_swcs_service' and b.is_pre_estb='$is_pre_estb' and b.is_pre_oper='$is_pre_oper' and b.is_other='$is_other' and a.is_active='Y'";
//echo $sql;
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$appCounts=$command->queryRow();    

if($appCounts===false)
return false;
return $appCounts['swcspreetbhcount'];
}


static function getApplicationDetailViaStaus($IDS,$Status){  

$sql="SELECT app_id,sp_app_id,unit_name,is_applied_by_caf,caf_id,app_distt_name,app_distt,app_location,app_status FROM bo_sp_applications WHERE sp_app_id=$IDS AND app_status='$Status' ";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$depptt=$command->queryAll();  
if($depptt===false)
return false;
return $depptt;
}

}


?>