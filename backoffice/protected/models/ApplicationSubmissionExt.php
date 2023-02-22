<?php
	class ApplicationSubmissionExt extends ApplicationSubmission{

		
		/**
	* this function is used to get the  Total investment category wise of the project
	*@author: Hemant tahkur
	*/
	public static function getCategoryWiseCost(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A','F','P') AND Submission_id not in('22','268')";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);die;
		if($Fields===false)
			return false;
		$totalSC=0;
		$totalST=0;
		$totalOBC=0;
		$totalGeneral=0;
		$totalWomen=0;
		$totalExserviceman=0;
		$totalPhyChal=0;
		$totalOther=0;

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalcategory=json_decode($field['field_value'],true);
				// echo "<pre>";print_r($totalcategory);die;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='SC')
					$totalSC+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='ST')
					$totalST+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='OBC')
					$totalOBC+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='GENERAL')
					$totalGeneral+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='WOMEN')
					$totalWomen+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Ex-Serviceman')
					$totalExserviceman+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Physically Challenged')
					$totalPhyChal+=round($totalcategory['invstmnt_in_total'][0],2);
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Other')
					$totalOther+=round($totalcategory['invstmnt_in_total'][0],2);
			}
		}
		$returnArray=array("SC"=>$totalSC,"ST"=>$totalST,"OBC"=>$totalOBC,"GENERAL"=>$totalGeneral,"WOMEN"=>$totalWomen,"ExServiceman"=>$totalExserviceman,"PhysicallyChallenged"=>$totalPhyChal,"Other"=>$totalOther);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}

		/*used to get filtered detail of the applications
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getFilteredApplications($dept_id,$app_id){
			$connection=Yii::app()->db; 
			$sql="SELECT apps.user_id,apps.application_status,app.application_name,dept.department_name,apps.application_created_date,apps.ip_address,apps.user_agent as app_sub_date FROM bo_application_submission apps
				  INNER JOIN bo_applications app
				  ON app.application_id=apps.application_id
				  INNER JOIN bo_departments dept
				  ON dept.dept_id=apps.dept_id
				  WHERE dept.dept_id=:dept_id AND app.application_id=:app_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
			$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
			$appList=$command->queryAll();
			if($appList===false)
				return false;
			return $appList;
		}

		/*used to get count of pending application of particulat applications
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getPendingApplicationscount($dept){
			$status = 'P';
			$connection=Yii::app()->db; 
			$sql="SELECT count(submission_id) as pending_app FROM bo_application_submission WHERE dept_id=:dept AND application_status=:status";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":dept",$dept,PDO::PARAM_INT);
			$appList=$command->queryRow();
			if($appList===false)
				return false;
			return $appList;
		}
		/*used to get count of Incomplete application of particulat applications
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getIncompleteApplicationscount($dept){
			$status = 'I';
			$connection=Yii::app()->db; 
			$sql="SELECT count(submission_id) as incmplt_app FROM bo_application_submission WHERE dept_id=:dept AND application_status=:status";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":dept",$dept,PDO::PARAM_INT);
			$appList=$command->queryRow();
			if($appList===false)
				return false;
			return $appList;
		}
		/*used to get count of Approve application of particulat applications
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getApproveApplicationscount($dept){
			$status = 'A';
			$connection=Yii::app()->db; 
			$sql="SELECT count(submission_id) as apprv_app FROM bo_application_submission WHERE dept_id=:dept AND application_status=:status";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":dept",$dept,PDO::PARAM_INT);
			$appList=$command->queryRow();
			if($appList===false)
				return false;
			return $appList;
		}
		/*used to get count of Reject application of particulat applications
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getRejectApplicationscount($dept){
			$status = 'R';
			$connection=Yii::app()->db; 
			$sql="SELECT count(submission_id) as reject_app FROM bo_application_submission WHERE dept_id=:dept AND application_status=:status";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":dept",$dept,PDO::PARAM_INT);
			$appList=$command->queryRow();
			if($appList===false)
				return false;
			return $appList;
		}

		/*used to get the all pending application 
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getPendingApplications(){
			$uid=$_SESSION['uid'];
			$status = 'P';
			$connection=Yii::app()->db; 
			// $sql="SELECT * FROM bo_application_submission WHERE application_status = :status";
			$sql="SELECT * FROM bo_application_submission subm
				   INNER JOIN bo_user usr
				   ON subm.landrigion_id=usr.disctrict_id
				   WHERE application_status =:status AND usr.uid=:uid";
			$command=$connection->createCommand($sql);
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$appList=$command->queryAll();
			return $appList;
		}

		/*used to get the last 6 pending application of all the departments
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getLastSixPendingApplications(){
			$status = 'P';
			$connection=Yii::app()->db; 
			$sql="SELECT aps.application_id,dpt.department_name,count(aps.application_id) as app_cnt FROM bo_application_submission aps
				  INNER JOIN bo_departments dpt
				  ON aps.dept_id=dpt.dept_id
				  WHERE application_status=:status GROUP BY aps.dept_id ORDER BY aps.submission_id DESC LIMIT 6";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
		}
		/*used to get the last 6 Approve application of all the departments
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getLastSixAproveApplications(){
			$status = 'A';
			$connection=Yii::app()->db; 
			$sql="SELECT aps.application_id,dpt.department_name,count(aps.application_id) as app_cnt FROM bo_application_submission aps
				  INNER JOIN bo_departments dpt
				  ON aps.dept_id=dpt.dept_id
				  WHERE application_status=:status GROUP BY aps.dept_id ORDER BY aps.submission_id DESC LIMIT 6";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
		}
			/*used to get the last 6 Reject application of all the departments
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getLastSixRejectApplications(){
			$status = 'R';
			$connection=Yii::app()->db; 
			$sql="SELECT aps.application_id,dpt.department_name,count(aps.application_id) as app_cnt FROM bo_application_submission aps
				  INNER JOIN bo_departments dpt
				  ON aps.dept_id=dpt.dept_id
				  WHERE application_status=:status GROUP BY aps.dept_id ORDER BY aps.submission_id DESC LIMIT 6";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
		}
		public static function getSubmittedApplication($sub_id){
			$connection=Yii::app()->db;
			$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$subApp=$command->queryRow();
			if($subApp===false)	
				return false;
			return $subApp;
		}
		/*used to get submitted application via id
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getSubmittedAppviaId($sub_id){
			$connection=Yii::app()->db;
			$appStatus='P';
                        $rejected='R'; 
			$forward='F';
			$hol='H';
			$pay='B';
			$appr='A';
                        $incomplete='I';
                        $ab = 'AB';
			$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id AND (application_status=:appStatus OR application_status=:incomplete OR application_status=:rejected OR application_status=:hol OR application_status=:pay OR application_status=:forward OR application_status=:appr OR application_status=:abeyance)";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$command->bindParam(":appStatus",$appStatus,PDO::PARAM_STR);
			$command->bindParam(":forward",$forward,PDO::PARAM_STR);
			$command->bindParam(":hol",$hol,PDO::PARAM_STR);
			$command->bindParam(":pay",$pay,PDO::PARAM_STR);
			$command->bindParam(":appr",$appr,PDO::PARAM_STR);
                        $command->bindParam(":rejected",$rejected,PDO::PARAM_STR);
                        $command->bindParam(":incomplete",$incomplete,PDO::PARAM_STR);
                        $command->bindParam(":abeyance",$ab,PDO::PARAM_STR); //apoorv
			
			
			$subApp=$command->queryRow();
			if($subApp===false)	
				return false;
			return $subApp;
		}
		/*used to get submitted application via id
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getSubmittedAppviaIdCAF($sub_id){
			$connection=Yii::app()->db;
			$appStatus='P'; 
			$forward='F';
			$hol='H';
			$pay='B';
			$appr='A';
			$incomp="I";
			$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id AND (application_status=:appStatus OR application_status=:hol OR application_status=:pay OR application_status=:forward OR application_status=:appr OR application_status=:incomp)";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$command->bindParam(":appStatus",$appStatus,PDO::PARAM_STR);
			$command->bindParam(":forward",$forward,PDO::PARAM_STR);
			$command->bindParam(":hol",$hol,PDO::PARAM_STR);
			$command->bindParam(":pay",$pay,PDO::PARAM_STR);
			$command->bindParam(":appr",$appr,PDO::PARAM_STR);
			$command->bindParam(":incomp",$incomp,PDO::PARAM_STR);
			
			$subApp=$command->queryRow();
			if($subApp===false)	
				return false;
			return $subApp;
		}
		/*used to get submitted application via id
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getSubmittedAppviaIdPrint($sub_id){
			$connection=Yii::app()->db;
			$appStatus='P'; 
			$forward='F';
			$hol='H';
			$apr='A';
			$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id AND (application_status=:appStatus OR application_status=:hol OR application_status=:forward OR application_status=:apr )";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$command->bindParam(":appStatus",$appStatus,PDO::PARAM_STR);
			$command->bindParam(":forward",$forward,PDO::PARAM_STR);
			$command->bindParam(":hol",$hol,PDO::PARAM_STR);
			$command->bindParam(":apr",$apr,PDO::PARAM_STR);
			
			$subApp=$command->queryRow();
			// echo "<pre>";echo $sub_id;print_r($subApp);die;
			if($subApp===false)	
				return false;
			return $subApp;
		}


		/*used to get submitted application via id
		@author : Hemant Thakur
		@param: 
		@return: array
		*/
		public static function getSubmittedAppviaIdDownload($sub_id){
			$connection=Yii::app()->db;
			$sql="SELECT * FROM bo_application_submission WHERE submission_id=:sub_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$subApp=$command->queryRow();
			if($subApp===false)	
				return false;
			return $subApp;
		}
		
		/** 
		* This function is used to get the previous comments of verifier corresponding to the submit application
		* @author: Hemant Thakur
		* @param: int
		*@return: array 
		*/
		public static function getAprvrComment($sub_id){
			$connection=Yii::app()->db; 
			$hold="H";
			$ver="V";
			$sql="SELECT approval_user_comment,next_role_id FROM bo_application_verification_level WHERE app_Sub_id=:sub_id AND (approv_status=:hold OR approv_status=:ver)";
			$command=$connection->createCommand($sql);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$command->bindParam(":hold",$hold,PDO::PARAM_STR);
			$command->bindParam(":ver",$ver,PDO::PARAM_STR);
			$subAppcmnt=$command->queryAll();	
			return $subAppcmnt;
		}
		/**
		* This function is used to get other departments comments of forwareded application
		*/
		public static function getOtherDepartmentComments($app_sub_id){
			$active='Y';
			$status="F";
			$pstatus='P';
			$astatus='V';
			$sql="SELECT DISTINCT appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status,appfl.verifier_user_id, DATE_FORMAT(appfl.created_on,'%d %b %y') as frddate, DATE_FORMAT(appfl.comment_date,'%d %b %y') as comtdate FROM bo_user_role_mapping rm
				  INNER JOIN bo_application_verification_level appvl
				  ON appvl.next_role_id = rm.role_id
   				  INNER JOIN bo_application_submission appsb
				  ON appvl.app_sub_id=appsb.submission_id
				  INNER JOIN bo_application_forward_level appfl
				  ON appfl.app_Sub_id=appvl.app_sub_id
				  WHERE appfl.app_Sub_id=:app_sub_id AND is_mapping_active=:active AND (appvl.approv_status=:status OR appvl.approv_status=:pstatus OR appvl.approv_status=:astatus)";
				  $connection=Yii::app()->db; 
				  $command=$connection->createCommand($sql);
				  $command->bindParam(":app_sub_id",$app_sub_id,PDO::PARAM_INT);
				  $command->bindParam(":active",$active,PDO::PARAM_STR);
				  $command->bindParam(":status",$status,PDO::PARAM_STR);
				  $command->bindParam(":pstatus",$pstatus,PDO::PARAM_STR);
				  $command->bindParam(":astatus",$astatus,PDO::PARAM_STR);
				  $subAppcmnt=$command->queryAll();	
				  if($subAppcmnt===false)
				  		return false;
				  return $subAppcmnt;
		}

		/*used to ApplicationSubmission details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getApplicationSubmission(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_applications_submittions ORDER BY submission_id ASC ";
			$command=$connection->createCommand($sql);
			$ApplicationSubmissionList=$command->queryAll();	
			return $ApplicationSubmissionList;
		}
		/**
		* used to get all the approved applications of the investors
		*@author: Hemant Thakur
		*/
		public static function getAprrovedApplications(){
			$uid=$_SESSION['uid'];
			$status = 'A';
			$reject='R';
			$connection=Yii::app()->db; 
			//$sql="SELECT * FROM bo_application_submission WHERE application_status = :status";
			$sql="SELECT * FROM bo_application_submission subm
				   INNER JOIN bo_user usr
				   ON subm.landrigion_id=usr.disctrict_id
				   WHERE (application_status =:status OR application_status =:reject) AND usr.uid=:uid and submission_id not in(
select app_sub_id from cdn_investor_documents_by_Departments where app_sub_id  in(
SELECT submission_id FROM bo_application_submission subm
				   INNER JOIN bo_user usr
				   ON subm.landrigion_id=usr.disctrict_id
				   WHERE (application_status =:status OR application_status =:reject) AND usr.uid=:uid))";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":reject",$reject,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;

		}


/**
		* used to get all the approved applications of the investors
		*@author: Mohit Sharma
		*/
		public static function getStateAprrovedApplications(){
			$uid=$_SESSION['uid'];
			$status = 'A';
			$reject='R';
			$connection=Yii::app()->db; 
			//$sql="SELECT * FROM bo_application_submission WHERE application_status = :status";
			$sql="SELECT * FROM bo_application_submission subm
				   INNER JOIN bo_user usr
				   ON subm.landrigion_id=usr.disctrict_id
				   WHERE (application_status =:status OR application_status =:reject) AND usr.uid=:uid and submission_id not in(
select app_sub_id from cdn_investor_documents_by_Departments where app_sub_id  in(
SELECT submission_id FROM bo_application_submission subm
				   INNER JOIN bo_user usr
				   ON subm.landrigion_id=usr.disctrict_id
				   WHERE (application_status =:status OR application_status =:reject) AND usr.uid=:uid)) AND Submission_id not in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":reject",$reject,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;

		}




		public static function getSSOAprovedRejectApplications(){
			$uid=$_SESSION['uid'];
			$status = 'A';
			$reject='R';
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_sp_applications WHERE app_status = :status OR app_status = :reject";
			$command=$connection->createCommand($sql);
			$command->bindParam(":status",$status,PDO::PARAM_STR);
			$command->bindParam(":reject",$reject,PDO::PARAM_STR);
			// $command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
		}


                
                // Rahul 15082018
                
       
	public static function getCategoryWiseApprovedCAF(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission where application_status in ('A') AND user_id not in('11') AND application_id=1";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);die;
		if($Fields===false)
			return false;
		$totalSC=0;
		$totalST=0;
		$totalOBC=0;
		$totalGeneral=0;
		$totalWomen=0;
		$totalExserviceman=0;
		$totalPhyChal=0;
		$totalOther=0;

		//$micro=0;
		foreach ($Fields as $key => $field) {
			if(isset($field['field_value'])){
				$totalcategory=json_decode($field['field_value'],true);
				// echo "<pre>";print_r($totalcategory);die;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='SC')
					$totalSC=$totalSC+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='ST')
					$totalST=$totalST+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='OBC')
					$totalOBC=$totalOBC+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='GENERAL')
					$totalGeneral=$totalGeneral+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='WOMEN')
					$totalWomen=$totalWomen+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Ex-Serviceman')
					$totalExserviceman=$totalExserviceman+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Physically Challenged')
					$totalPhyChal=$totalPhyChal+1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Other')
					$totalOther=$totalOther+1;
			}
		}
		$returnArray=array("SC"=>$totalSC,"ST"=>$totalST,"OBC"=>$totalOBC,"GENERAL"=>$totalGeneral,"WOMEN"=>$totalWomen,"ExServiceman"=>$totalExserviceman,"PhysicallyChallenged"=>$totalPhyChal,"Other"=>$totalOther);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}
        
           // Rahul 15082018
                
       
	public static function getCategoryWiseApprovedCAFDistrictOnly(){
		$connection=Yii::app()->db; 
		// echo $dist_id;
		// $sql="SELECT field_value from bo_application_submission where submission_id in(SELECT submission_id  FROM bo_application_submission WHERE application_status in('A','F','H','P') AND landrigion_id=:dist_id)";
		 $sql="SELECT field_value from bo_application_submission "
                         . "LEFT JOIN bo_application_verification_level on bo_application_submission.submission_id=bo_application_verification_level.app_sub_id "
                         . "where bo_application_submission.application_status in ('A') AND bo_application_submission.user_id not in('11') AND bo_application_submission.application_id=1 AND bo_application_verification_level.next_role_id in ('7','33') group by bo_application_verification_level.app_Sub_id ";

		$command=$connection->createCommand($sql);
		//$command->bindParam(":dist_id",$dist_id,PDO::PARAM_STR);
		$Fields=$command->queryAll();
		// echo "<pre>";print_r($Fields);die;
		if($Fields===false)
			return false;
		$totalSC=0;
		$totalST=0;
		$totalOBC=0;
		$totalGeneral=0;
		$totalWomen=0;
		$totalExserviceman=0;
		$totalPhyChal=0;
		$totalOther=0;
$undfind="";
		//$micro=0;
		foreach ($Fields as $key => $field) {
                    $flg=0;
			if(isset($field['field_value'])){
				$totalcategory=json_decode($field['field_value'],true);
				// echo "<pre>";print_r($totalcategory);die;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='SC')
					$totalSC=$totalSC+1; $flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='ST')
					$totalST=$totalST+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='OBC')
					$totalOBC=$totalOBC+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='GENERAL')
					$totalGeneral=$totalGeneral+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='WOMEN')
					$totalWomen=$totalWomen+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Ex-Serviceman')
					$totalExserviceman=$totalExserviceman+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Physically Challenged')
					$totalPhyChal=$totalPhyChal+1;$flg=1;
				if(isset($totalcategory['org_category']) && $totalcategory['org_category']=='Other')
					$totalOther=$totalOther+1;$flg=1;
                                        if($flg==0){
                                            $undfind=$totalcategory['org_category'];
                                        }
			}
		}
		$returnArray=array("SC"=>$totalSC,"ST"=>$totalST,"OBC"=>$totalOBC,"GENERAL"=>$totalGeneral,"WOMEN"=>$totalWomen,"ExServiceman"=>$totalExserviceman,"PhysicallyChallenged"=>$totalPhyChal,"Other"=>$totalOther,'undfined'=>$undfind);
		// echo "<pre>";print_r($returnArray);die;
		return $returnArray;

	}
	public static function getSnoBySubmissionId($appSubID=null,$val=null)
	{
			$sqlspapp="Select bo_new_application_submission.submission_id as sno,bo_new_application_submission.sp_app_id,	bo_new_application_submission.landrigion_id,bo_infowizard_issuerby_master.service_provider_tag as sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,bo_new_application_submission.service_id,bo_new_application_submission.landrigion_id,bo_new_application_submission.processing_level 
			from bo_new_application_submission
			INNER JOIN  bo_infowizard_issuerby_master ON bo_new_application_submission.dept_id=bo_infowizard_issuerby_master.issuerby_id 		
			where bo_new_application_submission.submission_id='$appSubID'"; 
				
			$result = Yii::app()->db->createCommand($sqlspapp)->queryRow();
			if(!isset($val) && empty($val))	
			{
				return $result;
			}
			
			if(isset($result))
			return $result[$val];	
			else
			return false;	
	}	
	}
?>