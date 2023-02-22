<?php
	class SpApplicationsExt extends SpApplications{
		public static function getSPApplications($uid){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_sp_applications WHERE user_id = :uid ORDER BY sno DESC";
			$command=$connection->createCommand($sql);
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$spAppList=$command->queryAll();
			if($spAppList===false)
				return false;	
			return $spAppList;
		}
		public static function getAllSPApplications(){
			$connection=Yii::app()->db; 
			$active='Y';
			$sql="SELECT * FROM bo_sp_all_applications WHERE is_app_active=:active";
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$spAppList=$command->queryAll();
			if($spAppList===false)
				return false;	
			return $spAppList;
		}
		public static function getAllSSODept(){
			$connection=Yii::app()->db; 
			$swcs=1;
			$sql="SELECT * FROM sso_service_providers WHERE sp_id!=:swcs";
			$command=$connection->createCommand($sql);
			$command->bindParam(":swcs",$swcs,PDO::PARAM_STR);
			$spList=$command->queryAll();
			if($spList===false)
				return false;	
			return $spList;
		}
		public static function getSPApplicationsAllAjax($sp_id){
			$connection=Yii::app()->db; 
			$active='Y';
			$sql="SELECT spapp.app_id,spapp.app_name,spapp.app_url FROM bo_sp_all_applications spapp
		    WHERE spapp.sp_id=:sp_id AND spapp.is_app_active=:active";
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":sp_id",$sp_id,PDO::PARAM_STR);
			$spAppList=$command->queryAll();
			if($spAppList===false)
				return false;	
			return $spAppList;
		}
		public static function getSPApplicationsAll($sp_id){
			$connection=Yii::app()->db; 
			$active='Y';
			$sql="SELECT spapp.app_id,spapp.app_name,spapp.app_url,spappDet.timeline_period,spappDet.form_download_link,spappDet.procedure_link FROM bo_sp_all_applications spapp
			INNER JOIN sso_sp_applcations_detail spappDet
			ON spappDet.app_id=spapp.app_id
		    WHERE spapp.sp_id=:sp_id AND spapp.is_app_active=:active";
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":sp_id",$sp_id,PDO::PARAM_STR);
			$spAppList=$command->queryAll();
			if($spAppList===false)
				return false;	
			return $spAppList;
		}
		static function ssoSPNAMEViaTag($sptag){
			$connection=Yii::app()->db; 
			$swcs=1;
			// echo $sptag;die;
			$sql="SELECT service_provider_name FROM sso_service_providers WHERE service_provider_tag=:sptag";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sptag",$sptag,PDO::PARAM_STR);
			$spName=$command->queryRow();
			if($spName===false)
				return false;	
			return $spName['service_provider_name'];
		}
	}

?>