<?php 
	class RoleAccessExt extends RoleAccess{
		/*used to RoleAccess details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getRoleAccess(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_role_access ORDER BY access_id ASC ";
			$command=$connection->createCommand($sql);
			$RoleAccessList=$command->queryAll();	
			return $RoleAccessList;
		}

}
?>