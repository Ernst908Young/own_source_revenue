<?php
class IncentiveSchemes{
 /*
 * this function is used to get the user id from the submission id
 */
 static function getUserIDFromSubmissionId($app_sub_id){
	$application=ApplicationSubmission::model()->findByPK($app_sub_id);
	if(!is_null($application))
		return $application->user_id;
	return false;
	 	
 }
 static function getboUserMobileFromRoleID($sub_id,$role_id){
 	$application=IncentiveSchemes::loadApplication($sub_id,true);
 	$distt=$application['landrigion_id'];
 	$mobile=IncentiveSchemes::userInfoFromRoleDisttID($role_id,$distt,false,'mobile');
 	return $mobile;

 }
 /**
 * this function is used to send the custom messaeg to the particular mobile
 *@author Hemant Thakur
 */
 static function sendCustomMessageToMobile($mobile,$msg){
	 DefaultUtility::sendOTPToMobile($mobile,urlencode($msg));
	 return true;

 }
 static function getDeptMob($dept_id,$role_id,$app_sub_id){
			$application=IncentiveSchemes::loadApplication($app_sub_id,true);
			$distt=$application['landrigion_id'];
		 	$sql="SELECT * from bo_user usr
				inner join bo_user_role_mapping url
				on url.user_id=usr.uid
				Where url.department_id=:dept_id and url.role_id=:role_id AND usr.disctrict_id=:distt";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
				$command->bindParam(":distt",$distt,PDO::PARAM_INT);
				$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
				$userInfo=$command->queryRow();
				// echo $userInfo;die;
				if(empty($userInfo))
					return false;
				return $userInfo['mobile'];
		}
 static function userInfoFromRoleDisttID($role_id,$distt_id,$all_info=false,$return='mobile'){
        if($role_id == '4'){
            $sql="SELECT * FROM bo_user usr
		INNER JOIN bo_user_role_mapping rm
		ON rm.user_id=usr.uid
		WHERE rm.role_id=:role_id ";
        }else{
 	$sql="SELECT * FROM bo_user usr
		INNER JOIN bo_user_role_mapping rm
		ON rm.user_id=usr.uid
        WHERE rm.role_id=:role_id AND usr.disctrict_id=:distt_id";
        
        }
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$command->bindParam(":distt_id",$distt_id,PDO::PARAM_INT);
		$userInfo=$command->queryRow();
		if(!$all_info)
			return $userInfo[$return];
		return $userInfo;

 }

  static function getAppNameFromSubmissionId($app_sub_id){
	$application=ApplicationSubmission::model()->findByPK($app_sub_id);
	if(!is_null($application)){
		$appName=ApplicationExt::getAppNameViaId($application->application_id);
		return $appName['application_name'];
	}
	return false;
	 	
 }
   static function getCafIDFromSubmissionId($app_sub_id){
	$application=ApplicationSubmission::model()->findByPK($app_sub_id);
	if(!is_null($application)){
		$fields=json_decode($application->field_value);
		$caf_id=$fields->CafID;
		return $caf_id;
	}
	return false;
	 	
 }
 static function getLOLDocument($app_id){
 	// echo $app_id;die;
 		$sql="SELECT * FROM cdn_land_allotment_docs WHERE application=:app_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$doc=$command->queryRow();
		return $doc;
		// echo "<pre>";print_r($doc);die;
 }
 
	static function sendNotificationToInvestor($sub_id,$msg=false){
		$mobile=IncentiveSchemes::getInvestorNumberFromApplicationSubmission($sub_id);
		$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
		if(!$msg)
			$msg="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: application has been approved\r\n";
		DefaultUtility::sendOTPToMobile($mobile,urlencode($msg));
	}
	static function getLandAuthDept($land_id){
		$sql="SELECT * FROM bo_land_authority_detail WHERE land_id=:land_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":land_id",$land_id,PDO::PARAM_INT);
		$land_dept=$command->queryRow();
		if($land_dept)
			return $land_dept['department'];
			return false;
	}
	static function getUserMobileNumber($dept_id){
		$sql="SELECT * FROM bo_user usr INNER JOIN bo_user_role_mapping  rm ON usr.uid=rm.user_id WHERE rm.department_id=:dept_id and rm.role_id=3";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$user_mobile=$command->queryRow();
		return $user_mobile['mobile'];

	}
	static function notifyInvestorWithCustomMessage($sub_id,$msg){
		$mobile=IncentiveSchemes::getInvestorNumberFromApplicationSubmission($sub_id);
		$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
		DefaultUtility::sendOTPToMobile($mobile,urlencode($msg));
	}
	static function sendNotificationToLandAuthorityAfterApproval($cafID){
		$cafApp=IncentiveSchemes::loadApplication($cafID);
		$sub_id=$cafID;
		if(!isset($cafApp->land_authority))
			return false;
		$landAuth=$cafApp->land_authority;
		$landAutDept=IncentiveSchemes::getLandAuthDept($landAuth);
		$mobile=IncentiveSchemes::getUserMobileNumber($landAutDept);
		$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
		$msg="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: CHiPS has been signed the In Principle letter.Please upload LOI document corresponding to the application. \r\n";
		// echo $mobile;die;
		DefaultUtility::sendOTPToMobile($mobile,urlencode($msg));
	}
	static function sendNotificationToLandAuthority($sub_id){
		$cafID=IncentiveSchemes::getCafIDFromSubmissionId($sub_id);
		$cafApp=IncentiveSchemes::loadApplication($cafID);
		// echo "<pre>";
		if(!isset($cafApp->land_authority))
			return false;
		// print_r($cafApp);die;
		$landAuth=$cafApp->land_authority;
		$landAutDept=IncentiveSchemes::getLandAuthDept($landAuth);
		$mobile=IncentiveSchemes::getUserMobileNumber($landAutDept);
		$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
		$msg="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Chips has been approved 80% payment of land Premium. \r\n";
	
		DefaultUtility::sendOTPToMobile($mobile,urlencode($msg));
// echo $cafID;
	}
	
	static function loadApplication($app_sub_id,$full_detail=false){
		$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":sub_id",$app_sub_id,PDO::PARAM_INT);
		$sub_id=$command->queryRow();
		if(!$full_detail)
			return json_decode($sub_id['field_value']);
		return $sub_id;
	}


/**
* this function is used to get the investor's mobile number from the application submission id
*/
 static function getInvestorNumberFromApplicationSubmission($app_sub_id){
 	$user_id=IncentiveSchemes::getUserIDFromSubmissionId($app_sub_id);
 	$api_hash=hash_hmac('sha1', md5($user_id), SSO_API_PUBLIC_KEY);
	$post_data=array('uid'=>$user_id,'api_hash'=>$api_hash);
	$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getMobileFromUserId',$post_data));
	$mobile='';
	if($response->STATUS===200)
		$mobile=$response->RESPONSE;
	return $mobile;
  }
  static function getInvestorEmailFromApplicationSubmission($app_sub_id){
 	$user_id=IncentiveSchemes::getUserIDFromSubmissionId($app_sub_id);
 	$api_hash=hash_hmac('sha1', md5($user_id), SSO_API_PUBLIC_KEY);
	$post_data=array('uid'=>$user_id,'api_hash'=>$api_hash);
	$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getEmailFromUserId',$post_data));
	$mobile='';
	if($response->STATUS===200)
		$mobile=$response->RESPONSE;
	return $mobile;
  }
  static function getBOUsersMobile($user_id){
  	   $sql="SELECT * FROM bo_user WHERE uid=:uid";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$user_id,PDO::PARAM_INT);
		$user_mobile=$command->queryRow();
		return $user_mobile['mobile'];
  }
  static function getNodalOUsersMobile(){
		$sql="SELECT * FROM bo_user usr INNER JOIN bo_user_role_mapping rm ON usr.uid=rm.user_id WHERE rm.role_id=7";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$user_id,PDO::PARAM_INT);
		$user_mobile=$command->queryRow();
		return $user_mobile['mobile'];
  }
  
  static function getboUserEmailFromRoleID($sub_id,$role_id_array=array()){
 	$application=IncentiveSchemes::loadApplication($sub_id,true);
 	$distt=$application['landrigion_id'];
        $email_id_array = array();
        foreach($role_id_array as $role_id){
 	$email_id_array[] =IncentiveSchemes::userInfoFromRoleDisttID($role_id,$distt,false,'email');
        }
 	return $email_id_array;

 }
}

?>