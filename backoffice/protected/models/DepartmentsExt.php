<?php
class DepartmentsExt extends BoInfowizardIssuerbyMaster
{
/*used to get the all dept list
	@author : Hemant Thakur
	@param: 
	@return: array
	*/
	public static function getDept() {
		$isactive = '1';
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT dept_id,department_name,department_unique_code FROM bo_departments WHERE is_department_active = :isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
		$deptList=$command->queryAll();	
		return $deptList;
	}
	/*
		used to get the department name from the id
		*@author : Hemant Thakur
	*/
	public static function getDeptbyId($dept_id) {
		$isactive = '1';
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT issuerby_id as dept_id,name as department_name,department_unique_code FROM bo_infowizard_issuerby_master WHERE issuerby_id=:dept_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$deptList=$command->queryRow();	
		return $deptList;
	}
	/*
		used to get the department name from the id
		*@author : Hemant Thakur
		@return string 
	*/
	public static function DepartmentsExtMap($dept_id) {
		$isactive = '1';
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT dept_id,department_name,department_unique_code FROM bo_departments WHERE dept_id=:dept_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$deptList=$command->queryRow();	
		return $deptList['department_name'];
	}
	/*
		used to get the department name from unique code
		*@author : Hemant Thakur
		@return string 
	*/
	public static function getDeptIdFromUniqCode($dept_uniq_code){
		$connection=Yii::app()->db; 
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql="SELECT dept_id,department_name FROM bo_departments WHERE department_unique_code=:dept_uniq_code";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_uniq_code",$dept_uniq_code,PDO::PARAM_STR);
		$deptList=$command->queryRow();	
		if($deptList===false)
			return;
		return $deptList['dept_id'];

	}
	/*used to Department details
	@author : GAURAV OJHA 
	@param: 
	@return: array
	*/
	public static function getDepartments(){
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_departments ORDER BY dept_id ASC ";
		$command=$connection->createCommand($sql);
		$deptList=$command->queryAll();	
		return $deptList;
	}
	 static function getSSONameFromSPTag($spTag){
		$connection=Yii::app()->db; 
	 	$sql="SELECT service_provider_name FROM sso_service_providers WHERE service_provider_tag=:spTag";
		$command=$connection->createCommand($sql);
		$command->bindParam(":spTag",$spTag,PDO::PARAM_STR);
		$sp=$command->queryRow();	
		if($sp===false)
			return;
		return $sp['service_provider_name'];
	 }
}
?>