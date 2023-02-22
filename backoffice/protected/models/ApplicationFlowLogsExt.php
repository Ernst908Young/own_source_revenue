<?php
	/**
	* @author Hemant Thakur
	*/
	class ApplicationFlowLogsExt extends ApplicationFlowLogs
	{
		
		public static function getSubAppsComments($app_sub_id){
			$criteria=new CDbCriteria;
			$criteria->condition="submission_id=:app_sub_id";
			$criteria->params=array(":app_sub_id"=>$app_sub_id);
			$appComments=ApplicationFlowLogs::model()->findAll($criteria);
			if(empty($criteria))
				return false;
			else
				return $appComments;
		}
	}
	
?>