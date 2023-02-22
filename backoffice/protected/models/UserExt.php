<?php
class UserExt extends User{
	
	/**
	* this function is used to get the investor name from the sso server
	* @author : Hemant Thakur

	*/
	static function getDeptUserList($params){
		extract($params);
		$condition="";
		$connection=Yii::app()->db; 
		if(isset($module_id))
			$condition=" AND rm.module_id=:module_id";
		if(isset($distt_id))
			$condition.=" AND rm.district_id=:district_id";
		if(isset($role_id))
			$condition.=" AND rm.role_id=:role_id";
		$sql="SELECT usr.uid as user_id ,usr.full_name,usr.email,usr.mobile,rm.role_id,rm.module_id,rm.district_id FROM bo_user usr INNER JOIN bo_user_role_module_mapping rm ON usr.uid=rm.user_id WHERE true".$condition;
		$command=$connection->createCommand($sql);

		if(isset($module_id))
			$command->bindParam(":module_id",$module_id,PDO::PARAM_INT);
		if(isset($distt_id))
			$command->bindParam(":district_id",$distt_id,PDO::PARAM_INT);
		if(isset($role_id))
			$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
			
		$users=$command->queryAll();
		return $users;
	}
	/**
	* this function is used to get the dept user Distt
	* @author : Hemant Thakur

	*/
	static function getUsersAllDistt($email){
		$sql="SELECT usr.disctrict_id FROM bo_user usr WHERE usr.email=:email";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_INT);
		$dept_id=$command->queryAll();
		if(empty($dept_id))
			return false;
		$result=array();
		foreach ($dept_id as $key => $value) {
			$result[]=$value['disctrict_id'];
		}
		return $result;
	}
	static function getUserDistt($email){
		$sql="SELECT disctrict_id FROM bo_user usr
				WHERE usr.email=:email";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_INT);
		$dept_id=$command->queryAll();
		if(empty($dept_id))
			return false;
		$returnArray=array();
		foreach ($dept_id as $key => $value) {
			$returnArray[]=$value['disctrict_id'];
		}
		// print_r($returnArray);die;
		return $returnArray;
	}
	/**
	*this function is used to get the user's dist and department
	*@author Hemant thakur
	*@param int user_id
	*@return array
	*/
	static function getUserDistDept($uid){
		$sql="SELECT usr.disctrict_id, rm.department_id FROM bo_user usr
				INNER JOIN bo_user_role_mapping rm
				ON rm.user_id=usr.uid
				WHERE usr.uid=:uid";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$dept_id=$command->queryRow();
		if(empty($dept_id))
			return false;
		return $dept_id;
	}
	public static function GetUserNameFromSSO($user_id){
		$api_hash=hash_hmac('sha1', md5($user_id), SSO_API_PUBLIC_KEY);
		$post_data=array('uid'=>$user_id,'api_hash'=>$api_hash);
		
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserId',$post_data));
		$uname='';
		
		if(is_object($response)){
			if(isset($response->STATUS) && $response->STATUS===200)
				$uname=$response->RESPONSE;	
		}
		return $uname;
	}
	static function GetUserNameFromSSOByEmail($email){
		$api_hash=hash_hmac('sha1', md5($email), SSO_API_PUBLIC_KEY);
		$post_data=array('email'=>$email,'api_hash'=>$api_hash);
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserEmailId',$post_data));
		$uname='';
		if(is_object($response)){
			if($response->STATUS===200)
				$uname=$response->RESPONSE;	
		}
		return $uname;
	}
	static function GetUserInfoFromSSO($email){
		$api_hash=hash_hmac('sha1', md5($email), SSO_API_PUBLIC_KEY);
		$post_data=array('email'=>$email,'api_hash'=>$api_hash);
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUsersDetailFromEmail',$post_data));
		$uinfo='';
		if(is_object($response)){
			if($response->STATUS===200)
				$uinfo=$response->RESPONSE;	
		}
		return $uinfo;
	}
	public static function getDeptUsers($dept_id){
		$isactive = '1';
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT uid,full_name FROM bo_user WHERE dept_id=:dept_id AND is_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_STR);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
		$userList=$command->queryAll();	
		return $userList;

	}
	/*
		used to get the User name from the id
		*@author : Hemant Thakur
		@return string 
	*/
	public static function getUNameviaIdMap($user_id) {
		$isactive = '1';
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT full_name FROM bo_user WHERE uid=:user_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
		$username=$command->queryRow();	
		return $username['full_name'];
	}
	/**
	* @author Hemant thakur
	*/
	public static function getUserDept($uid){
		$sql="SELECT dept.issuerby_id,dept.name as department_name FROM bo_infowizard_issuerby_master dept
		INNER JOIN bo_user bu
		ON bu.dept_id=dept.issuerby_id
		WHERE bu.uid=:uid";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$dept_id=$command->queryRow();	
		return $dept_id;

	}
	/*used to User details
	@author : GAURAV OJHA 
	@param: 
	@return: array
	*/
	public static function getUsers(){
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_user ORDER BY uid ASC ";
		$command=$connection->createCommand($sql);
		$userList=$command->queryAll();	
		return $userList;
	}
/*used to District list which have no anu users details
	@author : Santosh Kumar
	@param: INT
	@return: array
	*/
	public static function getDistrictsForNewNodelUser($dept_id){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_district as d LEFT JOIN (
SELECT u.* FROM bo_user as u INNER JOIN bo_user_role_mapping as urm ON u.uid = urm.user_id WHERE urm.role_id = '3' AND urm.department_id=:dept_id ) as x ON 
d.district_id = x.disctrict_id WHERE x.uid IS NULL";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$districtList=$command->queryAll();	
		return $districtList;
		
	}
	
	/*used to District list which have users details
	@author : Santosh Kumar
	@param: int
	@return: array
	*/
	public static function getDistrictsForEditNodelUser($dept_id){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_district as d INNER JOIN (
SELECT u.* FROM bo_user as u INNER JOIN bo_user_role_mapping as urm ON u.uid = urm.user_id WHERE urm.role_id = '3' AND urm.department_id=:dept_id ) as x ON 
d.district_id = x.disctrict_id";

		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$districtList=$command->queryAll();	
		return $districtList;
		
	}
	
	/**
	* @author Santosh Kumar
	@param: int , int , int 
	@return: array
	*/
	public static function getUserDetails($dept_id,$disctrict_id,$uid){
		$sql="SELECT * FROM bo_user WHERE dept_id=:dept_id AND disctrict_id=:disctrict_id AND uid!=:uid";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":disctrict_id",$disctrict_id,PDO::PARAM_INT);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$result=$command->queryRow();	
		return $result;

	}

	/**
	* @author Santosh Kumar
	@param: string, int
	@return: array
	*/
	public static function sGetRoles($for='state',$dept_id){
		if($for == 'state'){
			$sql="SELECT r.role_id,r.role_name FROM bo_roles as r LEFT JOIN (SELECT u.uid, urn.role_id, u.disctrict_id,u.dept_id,u.email FROM bo_user as u INNER JOIN  
bo_user_role_mapping as urn ON u.uid=urn.user_id WHERE u.disctrict_id='6' AND u.dept_id='$dept_id'  AND urn.role_id IN ('5','63','65')) as x ON 
x.role_id = r.role_id WHERE x.role_id IS NULL AND r.role_id IN ('5','63','65')";
		}elseif ($for == 'district') {
			$sql="SELECT role_id,role_name FROM bo_roles WHERE is_role_active='Y' AND role_id IN ('3','64','66')";
		}
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		//$command->bindParam(":disctrict_id",$disctrict_id,PDO::PARAM_INT);
		//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$results=$command->queryAll();	
		return $results;

	}

	/**
	* @author Santosh Kumar
	@param: string, int
	@return: array
	*/
	public static function sGetUsersByDeptForListing($for='state',$dept_id){
		if($for == 'state'){
			
			$sql = "SELECT u.*,r.role_id,r.role_name FROM bo_user as u INNER JOIN bo_user_role_mapping as rm ON rm.user_id = u.uid INNER JOIN bo_roles as r ON r.role_id=rm.role_id WHERE rm.role_id IN ('5','63','65') AND u.dept_id='$dept_id' AND u.disctrict_id='6'";
			
		}elseif ($for == 'district') {
			$sql="SELECT u.*,r.role_id,r.role_name FROM bo_user as u INNER JOIN bo_user_role_mapping as rm ON rm.user_id = u.uid INNER JOIN bo_roles as r ON r.role_id=rm.role_id WHERE rm.role_id IN ('3','64','66') AND u.dept_id='$dept_id'";
		}
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		//$command->bindParam(":disctrict_id",$disctrict_id,PDO::PARAM_INT);
		//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$results=$command->queryAll();	
		return $results;

	}

	// Get district list which have no users // SANTOSH KUMAR
	public static function sGetDistrictByRole($dept_id,$role_id){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_district as d LEFT JOIN (
SELECT u.* FROM bo_user as u INNER JOIN bo_user_role_mapping as urm ON u.uid = urm.user_id WHERE urm.role_id =:role_id AND urm.department_id=:dept_id ) as x ON 
d.district_id = x.disctrict_id WHERE x.uid IS NULL";
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$districtList=$command->queryAll();	
		return $districtList;		
	}

	/*
		@SANTOSH KUMAR
	*/
	public static function sGetDistrictByRoleForEdit($dept_id,$role_id,$district_id){
		$connection=Yii::app()->db; 
		$sql = "SELECT d.district_id,d.distric_name FROM bo_district as d LEFT JOIN (
SELECT u.* FROM bo_user as u INNER JOIN bo_user_role_mapping as urm ON u.uid = urm.user_id WHERE urm.role_id =:role_id AND urm.department_id=:dept_id ) as x ON 
d.district_id = x.disctrict_id WHERE x.uid IS NULL OR x.disctrict_id=:district_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":district_id",$district_id,PDO::PARAM_INT);
		$districtList=$command->queryAll();	
		return $districtList;		
	}

	/*
		@SANTOSH KUMAR
	*/
	public static function sGetUserCheckForDistrict($dept_id,$email_id,$role_id){
		$connection=Yii::app()->db; 
		
		$sql = "SELECT uid FROM bo_user as u WHERE u.email=:email_id AND u.dept_id!=:dept_id";

		$command=$connection->createCommand($sql);
		$command->bindParam(":email_id",$email_id,PDO::PARAM_STR);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$userList=$command->queryAll();	
		//echo count($userList)."--"; die; 
		if(count($userList) == 0){
			// Check is any role with this user
			$sql1 = "SELECT * FROM bo_user as u INNER JOIN bo_user_role_mapping as rm ON rm.user_id=u.uid  WHERE u.email=:email_id AND rm.role_id!=:role_id";
			$command=$connection->createCommand($sql1);
			$command->bindParam(":email_id",$email_id,PDO::PARAM_STR);
			$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
			$roleList=$command->queryAll();
			//echo '<pre>';count($roleList); print_r($roleList); 
			if(count($roleList) == 0){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
		return false;	
	}
	
	
        // Added BY Jitendra

        // Comment added by Rahul

       // 26022018

	static function getUserEmail($uid){



				$sql="SELECT email FROM bo_user usr

						WHERE usr.uid=:uid";

				$connection=Yii::app()->db;

				$command=$connection->createCommand($sql);

				$command->bindParam(":uid",$uid,PDO::PARAM_INT);

				$dept_id=$command->queryAll();

				if(empty($dept_id))

					return false;

				$returnArray=array();

				foreach ($dept_id as $key => $value) {

					$returnArray[]=$value['email'];

				}

				// print_r($returnArray);die;

				return $returnArray;

	}



	/*
	 * @authour: K SANSI
	 * @date:26022019
	 *                  
	 */
	 
	static function getCountVerificationLevel($role_id,$district_id,$start_date,$end_date){
		
		$connection=Yii::app()->db;
		
		$qryP = "
			SELECT COUNT(distinct(app_Sub_id)) as count FROM `bo_application_verification_level` 
			left join bo_application_submission on (bo_application_submission.submission_id=bo_application_verification_level.app_Sub_id)
			where  
				bo_application_submission.application_id=1 and 
				bo_application_submission.landrigion_id=$district_id and 
				bo_application_verification_level.next_role_id=$role_id and bo_application_verification_level.approv_status='P' and
			bo_application_verification_level.`created_on` BETWEEN '$start_date' AND '$end_date'
		" ;
				
		$command=$connection->createCommand($qryP);		
		$pendingResult=$command->queryAll();
		
		$qryA = "
			SELECT COUNT(distinct(app_Sub_id)) as count FROM `bo_application_verification_level` 
			left join bo_application_submission on (bo_application_submission.submission_id=bo_application_verification_level.app_Sub_id)
			where  
				bo_application_submission.application_id=1 and 
				bo_application_submission.landrigion_id=$district_id and 
				bo_application_verification_level.next_role_id=$role_id and bo_application_verification_level.approv_status!='P' and
			bo_application_verification_level.`created_on` BETWEEN '$start_date' AND '$end_date'
		" ;
				
		$command=$connection->createCommand($qryA);		
		$approveResult=$command->queryAll();		
		 
		$pendingCount = 0 ;
		$approveCount = 0 ;
		
		if(isset($pendingResult[0]['count'])){
			$pendingCount = $pendingResult[0]['count'] ;
		}
		if(isset($approveResult[0]['count'])){
			$approveCount = $approveResult[0]['count'] ;
		}
		
		$response = ['pending'=>$pendingCount,'processed'=>$approveCount] ;
						
		return $response ;
		
	}
	

}
 
?>