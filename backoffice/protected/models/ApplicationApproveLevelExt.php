<?php 
	class ApplicationApproveLevelExt extends ApplicationApproveLevel{
	/* 
	@Return User Comments on bo_application_verification_level db (bo_application_verification_level)
	@author Gaurav Ojha
	@PARAM INT
	@return array
	*/
	public static function getApplicationComments($id){
		$connection=Yii::app()->db; 
		$sql="	SELECT log_id, submission_id, CASE WHEN a.approver_role_id is null and approval_user_id is null then 'Investor' ELSE b.full_name END as full_name, 
				CASE WHEN approver_comments is null then 'Application has been submitted by Investor' ELSE approver_comments END as approver_comments,created_date_time,
				CASE WHEN application_status='RBI' THEN 'Reverted to Investor'
				WHEN application_status='RB' THEN 'Department Comment and Revert to Nodal'
				WHEN application_status='IBD' THEN 'Investor Revert to Nodal'
				WHEN application_status='F' THEN 'Forwarded to Concern Departments'
				WHEN application_status='V' THEN 'Approved' ELSE 'No Comments' END as application_status
				FROM bo_application_flow_logs as a left join bo_user as b ON a.approval_user_id=b.uid
				where a.submission_id=:id AND application_status!='IPS' order by a.log_id desc";
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$appComments=$command->queryAll();	
		return $appComments;
	}

	}

?>