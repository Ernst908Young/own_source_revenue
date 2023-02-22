<?php
	class UserRoleMappingExt extends UserRoleMapping {
	
	/*used to UserRoleMapping details
	@author : GAURAV OJHA 
	@param: 
	@return: array
	*/
	public static function getUserRoleMapping(){
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_user_role_mapping ORDER BY mapping_id ASC ";
		$command=$connection->createCommand($sql);
		$rolemapList=$command->queryAll();	
		return $rolemapList;
	}


	}

?>