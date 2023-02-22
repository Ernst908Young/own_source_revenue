<?php
	class AppWorkflowExt extends AppWorkflow{
		public static function checkExistingWorkflow($app_id){
			$is_active_wrkflw='Y';
			$sql="SELECT wrkflw_id FROM bo_app_workflow WHERE app_id=:app_id AND is_active_wrkflw=:is_active_wrkflw";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_wrkflw",$is_active_wrkflw,PDO::PARAM_STR);
			$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
			$RolesName=$command->queryAll();	
			if($RolesName===false){
				return false;
			}
			else{
				foreach ($RolesName as $roles) {
					$is_active_wrkflw='N';
					$sql="UPDATE bo_app_workflow SET is_active_wrkflw=:is_active_wrkflw WHERE wrkflw_id=:wrkflw_id";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$command->bindParam(":is_active_wrkflw",$is_active_wrkflw,PDO::PARAM_STR);
					$command->bindParam(":wrkflw_id",$roles['wrkflw_id'],PDO::PARAM_INT);
					$rslt=$command->execute();
				}
			}
		}
	}
?>