<?php 
class RolesExt extends Roles{
	/*used to get the all Roles
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getAllRoles() {
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT role_id,role_name FROM bo_roles WHERE is_role_active = :isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
		$RolesList=$command->queryAll();	
		return $RolesList;
	}

	/**
	* this function is used to get the user's mobile number from role id (dist and dept)
	*@author Hemant thakur
	*@param int role_id, int dept_id, int distt_id
	*@return bigint
	*/
	static function getUserMobileNumberFromRole($role_id=4,$distt_id=6,$dept_id=1){
		$sql="SELECT usr.* FROM bo_user_role_mapping rm
				INNER JOIN bo_user usr
				ON rm.user_id=usr.uid
				WHERE rm.role_id=:role_id AND usr.disctrict_id=:distt_id AND usr.dept_id=:dept_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$command->bindParam(":distt_id",$distt_id,PDO::PARAM_INT);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$mobile=$command->queryRow();	
		if(empty($mobile))
			return false;

		return $mobile['mobile'];
	}
	
	/*used to get the all Roles of particular deparment according to mapping
	@author : Hemant Thakur
	@param: 
	@return: array
	*/

	public static function getDeptUsersRoles($dept_id){
		$isactive = 'Y';
		$sql="SELECT brlmp.role_id,brl.role_name FROM bo_user_role_mapping brlmp
			  INNER JOIN bo_roles brl
			  ON brl.role_id=brlmp.role_id
		 	  WHERE brlmp.department_id=:dept_id AND brlmp.is_mapping_active=:isactive";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
		$RolesList=$command->queryAll();	
		return $RolesList;	
	}
	/*used to get the roles name from id
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getRolesViaId($role_id){
		$sql="SELECT role_name FROM bo_roles WHERE role_id=:role_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$RolesName=$command->queryRow();	
		return $RolesName;

	}
	/*used to get the roles name from id
	@author : Hemant Thakur
	@param: 
	@return: string
	*/
	public static function getRolesViaIdMap($role_id){
		$sql="SELECT role_name FROM bo_roles WHERE role_id=:role_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
		$RolesName=$command->queryRow();	
		return $RolesName['role_name'];

	}
	/*used to get particular User Role
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	public static function getUserRoleViaId($u_id){
		$sql="SELECT brl.role_name,brl.role_id,brl.is_external,rlmp.sso_dept FROM bo_user_role_mapping rlmp
			  INNER JOIN bo_roles brl
			  ON rlmp.role_id=brl.role_id
			  WHERE rlmp.user_id=:uid
			  AND is_mapping_active='Y'
			  ";
			  $connection=Yii::app()->db;
			  $command=$connection->createCommand($sql);
			  $command->bindParam(":uid",$u_id,PDO::PARAM_INT);
			  $RolesName=$command->queryRow();	
			  return $RolesName;

	}
	public static function getSSOName($sid){
		$sql="SELECT * from sso_service_providers where sp_id=$sid";
			  $connection=Yii::app()->db;
			  $command=$connection->createCommand($sql);
			  $command->bindParam(":uid",$u_id,PDO::PARAM_INT);
			  $RolesName=$command->queryRow();	
			  return $RolesName['service_provider_name'];

	}
	static function getUserModuleRole($uid,$module_id){
		// echo $uid;echo $module_id;die;
		$sql="SELECT brl.role_name,brl.role_id,brl.is_external FROM bo_user_role_module_mapping rlmp
			  INNER JOIN bo_roles brl
			  ON rlmp.role_id=brl.role_id
			  WHERE rlmp.user_id=:uid and rlmp.module_id=:module_id";
			  $connection=Yii::app()->db;
			  $command=$connection->createCommand($sql);
			  $command->bindParam(":uid",$uid,PDO::PARAM_INT);
			  $command->bindParam(":module_id",$module_id,PDO::PARAM_INT);
			  $RolesName=$command->queryRow();	
			  // echo "<pre>";print_r($RolesName);die;
			  return $RolesName;
	}
	/**
	* used to get the nodal Agency department
	*@author: Hemant Thakur
	*/
	public static function getNodalAgencyDepartment($role_id){
		$sql="SELECT brl.* FROM bo_roles rl
			  INNER JOIN bo_user_role_mapping brl
			  ON brl.role_id=rl.role_id
			  WHERE rl.role_id=:role_id";
			  $connection=Yii::app()->db;
			  $command=$connection->createCommand($sql);
			  $command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
			  $role_info=$command->queryRow();	
			  return $role_info;
	}
	/*used to Roles details
	@author : GAURAV OJHA 
	@param: 
	@return: array
	*/
	public static function getRoles(){
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_roles ORDER BY role_id ASC ";
		$command=$connection->createCommand($sql);
		$roleList=$command->queryAll();	
		return $roleList;
	}
	/** 

	*used to check the noodle agency user or not
	* @author : Hemant Thakur 
	* @param: 
	* @return: array
	*/
	public static function isNodleAgencyUser(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==7 || $role_id['role_id']==4)
			return TRUE;
		else
			return FALSE;
	}
	/** 

	*used to check Admin role
	* @author : Hemant Thakur 
	* @param: 
	* @return: array
	*/
	public static function isAdminUser(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==2)
			return TRUE;
		else
			return FALSE;
	}
	public static function isSSOAdmin(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==59)
			return TRUE;
		else
			return FALSE;
	}
	static function getSSOInfoFromID($sp_id){
		$sql="SELECT * from sso_service_providers where sp_id=:sp_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":sp_id",$sp_id,PDO::PARAM_INT);
		$ssoInfo=$command->queryRow();	
		return $ssoInfo;
	}
	
	/** @ SANTOSH KUMAR
	*this function is used to check whethe Helpdesk user is logged in or not 
	*/
	static function isValidHelpdeskLogin(){
		@session_start();
		if(isset($_SESSION['helpdesk_login']) && $_SESSION['helpdesk_login']==1)
			return true;
		return false;
	}
	
	/* SANTOSH KUMAR */
	public static function isDocumentVerifierUser(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==68)
			return TRUE;
		else
			return FALSE;
	}

	/* SANTOSH KUMAR */
	public static function isDMUser(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==74)
			return TRUE;
		else
			return FALSE;
	}
	
	/* used to check the user is Helpdesk User or NOt (Role=75)
	* @author : Pankaj Kumar tiwari 
	* @Date: 12 03 2018
	*/
	public static function isHelpdeskUser(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==75 || $role_id['role_id']==77)
			return $role_id['role_id'];
		else
			return FALSE;
	}
	
	
	public static function getGrevraisedbyname($grev_id){
		$sql="SELECT user_name FROM bo_grievance_detail WHERE grievence_no=:grev_id";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":grev_id",$grev_id,PDO::PARAM_INT);
		$RolesName=$command->queryRow();	
		return $RolesName;

	}
	/* 
	@authour : Rahul Kumar
	*/
	public static function isIpAdmin(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==78)
			return TRUE;
		else
			return FALSE;
	}
	
	/* 
	@authour : Rahul Kumar
	*/
	public static function isIpDataEntry(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==79)
			return TRUE;
		else
			return FALSE;
	}
		/* 
	@authour : Rahul Kumar
	*/
	public static function isMISAdmin(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==81)
			return TRUE;
		else
			return FALSE;
	}
	
		/* 
	@authour : Rahul Kumar
	*/
	public static function isMISManager(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==80)
			return TRUE;
		else
			return FALSE;
	}
	
		/* 
	@authour : Rahul Kumar
	*/
	public static function isIwDataEntry(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==82)
			return TRUE;
		else
			return FALSE;
	}
        	/**
	@authour : Rahul Kumar
        *@date 12122018
	*/
	public static function isVendor(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
			return false;
		$uid=$_SESSION['uid'];
		$rolesModel=new RolesExt;
		$role_id=$rolesModel->getUserRoleViaId($uid);
		if($role_id['role_id']==85)
			return TRUE;
		else
			return FALSE;
	}
	static function isNodalUser() {
		
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if (($role_id['role_id'] == 4) || ($role_id['role_id'] == 7))
            return true;
        else
            return false;
    }
	
	static function isAdmin() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 2)
            return true;
        else
            return false;
    }
	
}
	

?>