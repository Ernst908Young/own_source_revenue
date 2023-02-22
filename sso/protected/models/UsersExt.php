<?php 
	/**
	* 
	*/
	class UserExt extends Users
	{
		
		public static function getTotalRegisteredUsers(){
			die("jere");
			$active='Y';
			$sql="SELECT count(user_id) as user_count FROM sso_users WHERE is_account_active=:active";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$Users=$command->queryAll();
			echo "die";die();	
			if($Users===false)
				return false;
			return $Users;
		}
	}

?>