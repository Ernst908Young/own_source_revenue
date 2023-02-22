<?php 
	class RoleAccessMappingExt extends RoleAccessMapping{
		/*used to get the all Roles of particular deparment according to mapping
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getDeptUsersRoles($role_id){
			$isactive = 'Y';
			$sql="SELECT rlac.access_id from bo_role_access rlac
				  INNER JOIN bo_role_access_mapping brlmp
				  ON brlmp.access_id=rlac.access_id
				  INNER JOIN bo_roles rl
				  ON rl.role_id=brlmp.role_id
				 where rl.role_id=:role_id AND brlmp.is_active=:isactive";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
			$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
			$RolesList=$command->queryAll();
			if($RolesList===false)	
				return false;
			return $RolesList;	
		}
		/*used to RoleAccessMapping details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getRoleAccessMapping(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_role_access_mapping ORDER BY map_id ASC ";
			$command=$connection->createCommand($sql);
			$RoleAccessMappingList=$command->queryAll();	
			return $RoleAccessMappingList;
		}
		/*used to get Role Name
		@author : GAURAV OJHA 
		@param: INT(id)
		@return: string
		*/
		public static function getRoleName($id){
			$connection=Yii::app()->db; 
			$sql="SELECT role_name FROM bo_roles WHERE role_id=:id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":id",$id,PDO::PARAM_INT);
			$RoleName=$command->queryRow();	
			return $RoleName['role_name'];
		}
		/*used to get Role Name
		@author : GAURAV OJHA 
		@param: INT(id)
		@return: string
		*/
		public static function getRoleAccessName($id){
			$connection=Yii::app()->db; 
			$sql="SELECT access_name FROM bo_role_access WHERE access_id=:id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":id",$id,PDO::PARAM_INT);
			$RoleAccessName=$command->queryRow();	
			return $RoleAccessName['access_name'];
		}
	}
?>