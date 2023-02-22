<?php
class ApplicationDmsDocumentsMappingExt extends ApplicationDmsDocumentsMapping{
	
	static function getUsedDocumentsCount($dept_id,$status = 'U'){
		$connection=Yii::app()->db; 
		$sql="SELECT COUNT(*) as total_count FROM (SELECT sno,mapping_id FROM bo_application_dms_documents_mapping WHERE dept_id=:dept_id AND status=:status GROUP BY sno)  t1 ORDER BY mapping_id DESC";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$appList=$command->queryAll();
		if($appList){
		if($appList[0]['total_count']>0){
			return $appList[0]['total_count'];
		}else{
			return "0";
		}}
	}
	
	static function getUsedDocumentsCountNew($dept_id,$app_status = 'P',$dms_doc_status='U'){
		@session_start();
		$uid = $_SESSION['uid'];
		$connection=Yii::app()->db;
		$sqlS = "SELECT * FROM bo_user_service_mapping WHERE user_id='$uid' AND status='Y' ORDER BY id DESC LIMIT 1";
		$command=$connection->createCommand($sqlS);
		$rowList=$command->queryRow();
		$whereText = "";
		$service_id_arr=array();
		if(!empty($rowList)){
			$allowed_service_ids = $rowList['service_id'];
			if($allowed_service_ids!=''){
				$whereText = " AND app.sp_app_id IN ($allowed_service_ids)";
			}
		}else{
			$sqlS = "SELECT * FROM bo_user_service_mapping WHERE department_id='$dept_id' AND status='Y' ORDER BY id DESC";
			$command=$connection->createCommand($sqlS);
			$rowList=$command->queryAll();
			if(!empty($rowList)){
				foreach($rowList as $rowListArr){
					$service_idArr = explode(",",$rowListArr['service_id']);
					foreach($service_idArr as $val){
						$service_id_arr[] = $val;
					}
				}
				if(count($service_id_arr)>0){
					$allowed_service_ids = implode(",",$service_id_arr);
					$whereText = " AND app.sp_app_id NOT IN ($allowed_service_ids)";
				}
			}
		}
		
		if($dms_doc_status == 'U'){
			$whereText .= " AND app.app_status IN ('P','F')";
		}else if($dms_doc_status == 'V' || $dms_doc_status == 'R'){
			$whereText .= " AND app.app_status IN ('P','F','RBI','A','R')";
		}
		
		$sql = "SELECT map.*,app.app_name,CONCAT(u.first_name,' ',u.last_name) as full_name,app.unit_name,app.app_id,app.app_status,app.created_on as app_date FROM
				bo_sp_applications as app LEFT JOIN bo_application_dms_documents_mapping as map ON map.sno=app.sno
				INNER JOIN sso_profiles as u ON u.user_id=map.user_id
				WHERE map.dept_id=:dept_id AND map.mapping_id IS NOT NULL AND map.status=:dms_doc_status $whereText GROUP BY app.sno";
		//echo $sql; die;
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		//$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		$command->bindParam(":dms_doc_status",$dms_doc_status,PDO::PARAM_STR);
		$appList=$command->queryAll();
		//echo '<pre>'; print_r($appList); die;
		if($appList===false)
			return "0";
		return count($appList);
	}
	
	static function getAllInvestorListForDMS($dept_id,$status = 'U'){
		$connection=Yii::app()->db; 
		// bo_sp_applications 
		// bo_application_dms_documents_mapping
		// sso_users
		$sql="SELECT map.*,sp_app.app_name,CONCAT(u.first_name,' ',u.last_name) as full_name,sp_app.app_id as application_no,sp_app.noe,sp_app.sp_app_id FROM 
							bo_application_dms_documents_mapping as map,
							bo_sp_applications as sp_app,
							sso_profiles as u
							
							WHERE map.dept_id=:dept_id AND map.status=:status AND map.sno=sp_app.sno AND map.user_id=u.user_id AND sp_app.app_status='P'
							GROUP BY map.sno ORDER BY map.mapping_id DESC
			";
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$appList=$command->queryAll();
		if($appList===false)
			return false;
		return $appList;
	}
	
	/*
	* $sno = submission_id
	*/
	static function getAllUsedDocumentsOfInvestorServiceWise($sno,$user_id,$status = 'U'){
		$connection=Yii::app()->db; 
		// bo_application_dms_documents_mapping
		// cdn_dms_documents -- doc_ref_number,document_name
		// bo_infowizard_documentchklist -- name,chklist_id
		// sso_users - first_name,last_name
		$whereText ="";
		if($status == 'U'){
			$whereText = " AND dm.status IN ('U','V')";
		}else{
			if($status == 'R'){
				$whereText = " AND dm.status = 'R'";
			}
		}

		/*  echo $sno;
		echo "<br/>";
		echo $user_id; */
		/*$sql="SELECT map.*,dms.doc_ref_number,dms.document_name,CONCAT(u.first_name,' ',u.last_name) as full_name,iw.name as d_name,iw.chklist_id,app.unit_name,app.app_id,app.app_status,app.created_on as app_date,app.app_name,log.verifier_name,log.created_time as verified_date_time FROM 
							bo_application_dms_documents_mapping as map,
							cdn_dms_documents as dms,
							bo_infowizard_documentchklist iw,
							sso_profiles as u,
							bo_sp_applications as app
							LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=map.mapping_id
							WHERE map.sno=:sno AND map.user_id=:user_id AND map.documents_id=dms.documents_id AND map.user_id=u.user_id AND dms.docchk_id=iw.docchk_id AND app.sno=:app_sno
							ORDER BY map.mapping_id DESC
			";*/
                /* Added : ,app.print_app_call_back_url
                 * Reason : Showing application Detail To Document Verifier
                 * Date : 17042018
                 * @Author : Rahul Kumar 
                 */
		/*$sql="SELECT map.*,dms.doc_ref_number,dms.document_name,CONCAT(u.first_name,' ',u.last_name) as full_name,iw.name as d_name,iw.chklist_id,app.unit_name,app.app_id,app.app_status,app.created_on as app_date,app.app_name,log.verifier_name,log.created_time as verified_date_time,app.print_app_call_back_url,app.sp_app_id FROM 
							bo_application_dms_documents_mapping as map 
							INNER JOIN cdn_dms_documents as dms ON dms.documents_id=map.documents_id
							INNER JOIN bo_infowizard_documentchklist iw ON iw.docchk_id=dms.docchk_id
							INNER JOIN sso_profiles as u ON u.user_id=map.user_id
							INNER JOIN bo_sp_applications as app ON app.sno=map.sno
							LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=map.mapping_id
							WHERE map.sno=:sno AND map.user_id=:user_id
							ORDER BY map.mapping_id DESC
			";*/
			// below SQL code comment by aamir
			
				/*$sql="SELECT concat(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice) as iw_service_id,map.*,
		dms.doc_ref_number,
		dms.document_name,
                dms.comments as app_comments,
		CONCAT(u.first_name,' ',u.last_name) as full_name,
		iw.name as d_name,
		iw.chklist_id,
		app.unit_name,
		app.submission_id as app_id,
		app.application_status as app_status,
		app.application_created_date as app_date,
		app.sp_app_id,
		app.app_name,
		log.verifier_name,
                log.verifier_comments,
		log.created_time as verified_date_time,
		app.print_app_call_back_url FROM 
							bo_application_dms_documents_mapping as map 
							INNER JOIN cdn_dms_documents as dms ON dms.documents_id=map.documents_id
							INNER JOIN bo_infowizard_documentchklist iw ON iw.docchk_id=dms.docchk_id
							INNER JOIN sso_profiles as u ON u.user_id=map.user_id
							INNER JOIN bo_new_application_submission as app ON app.submission_id=map.sno 
                            INNER JOIN bo_information_wizard_service_parameters as biwsp ON app.sp_app_id=biwsp.swcs_service_id	
                            LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=map.mapping_id
							WHERE map.sno=:sno  AND map.user_id=:user_id AND biwsp.is_active='Y' 
							Group By map.mapping_id ORDER BY map.mapping_id DESC";*/
			
			
	/*	$command=$connection->createCommand($sql);
		$command->bindParam(":sno",$sno,PDO::PARAM_INT);*/
		//$command->bindParam(":app_sno",$sno,PDO::PARAM_INT);
		//$command->bindParam(":status",$status,PDO::PARAM_STR);
		//$command->bindParam(":user_id",$user_id,PDO::PARAM_INT);

		/*$appList = Yii::app()->db->createCommand("SELECT dc.name, dm.doc_id, dm.created_on, dm.status, dm.iuid, dm.document_file_name, dm.usercomment, dm.mapping_id, log.verifier_name,  log.verifier_comments,
		log.created_time as verified_date_time

		 FROM bo_application_dms_documents_mapping dm
			INNER JOIN bo_infowizard_documentchklist dc on dc.docchk_id=dm.doc_id
			LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=dm.mapping_id
			WHERE sno=$sno ORDER BY dm.status ASC")->queryAll();*/

			$appList = Yii::app()->db->createCommand("SELECT dc.name, dm.doc_id, dm.created_on, dm.status, dm.iuid, dm.document_file_name, dm.usercomment, dm.mapping_id

		 FROM bo_application_dms_documents_mapping dm
			INNER JOIN bo_infowizard_documentchklist dc on dc.docchk_id=dm.doc_id
			WHERE sno=$sno $whereText ORDER BY dm.status ASC")->queryAll();

		if($appList===false)
			return false;
		return $appList;
	}


	static function getAllUsedDocumentsOfInvestorServiceWise_log($mapping_id){
		$appList = Yii::app()->db->createCommand("SELECT log.verifier_name,  log.verifier_comments, log.created_time as verified_date_time, log.status, log.dept_user_id,
        (SELECT role_id FROM bo_user_role_mapping r WHERE r.user_id=log.dept_user_id AND r.is_mapping_active='Y' ORDER BY r.mapping_id ASC LIMIT 1)   as role_id      
            FROM bo_application_dms_documents_mapping_logs as log
            
            WHERE log.mapping_id=$mapping_id ORDER BY log.status, log.id DESC")->queryAll();
		return $appList;
	}
	
	static function getAllDmsPendingApplication($dept_id,$app_status='P',$dms_doc_status='U'){
		@session_start();
		$uid = $_SESSION['uid'];
		$connection=Yii::app()->db;
		$sqlS = "SELECT * FROM bo_user_service_mapping WHERE user_id='$uid' AND status='Y' ORDER BY id DESC LIMIT 1";
		$command=$connection->createCommand($sqlS);
		$rowList=$command->queryRow();
		$whereText = "";
        


		if(!empty($rowList)){
			$allowed_service_ids = $rowList['service_id'];
			if($allowed_service_ids!=''){
				$whereText = " AND app.sp_app_id IN ($allowed_service_ids)";
			}
		}else{
			$sqlS = "SELECT * FROM bo_user_service_mapping WHERE department_id='$dept_id' AND status='Y' ORDER BY id DESC";
			$command=$connection->createCommand($sqlS);
			$rowList=$command->queryAll();
			if(!empty($rowList)){
				foreach($rowList as $rowListArr){
					$service_idArr = explode(",",$rowListArr['service_id']);
					foreach($service_idArr as $val){
						$service_id_arr[] = $val;
					}
				}
				if(count($service_id_arr)>0){
					$allowed_service_ids = implode(",",$service_id_arr);
					$whereText = " AND app.sp_app_id NOT IN ($allowed_service_ids)";
				}
			}
		}
		$whereText = ""; 
		if($dms_doc_status == 'U'){
			$whereText .= " AND app.app_status IN ('P','F')";
		}else if($dms_doc_status == 'V' || $dms_doc_status == 'R'){
			$whereText .= " AND app.app_status IN ('P','F','RBI','A','R')";
		}
		
		/* $sql = "SELECT map.*,app.app_name,app.assigned_to,app.app_distt,CONCAT(u.first_name,' ',u.last_name) as full_name,app.unit_name,app.app_id,app.app_status,app.created_on as app_date,app.noe,app.sp_app_id FROM
				bo_sp_applications as app LEFT JOIN bo_application_dms_documents_mapping as map ON map.sno=app.sno
				INNER JOIN sso_profiles as u ON u.user_id=map.user_id
				WHERE map.dept_id=:dept_id AND map.mapping_id IS NOT NULL AND map.status=:dms_doc_status $whereText GROUP BY app.sno"; */
		$sql = "SELECT map.*,app.app_name,app.assigned_to,app.app_distt,CONCAT(u.first_name,' ',u.last_name) as full_name,u.mobile_number,sso_users.email,app.unit_name,app.app_id,app.app_status,app.created_on as app_date,app.noe,app.sp_app_id,app.print_app_call_back_url,app.caf_id FROM bo_sp_applications as app 
		LEFT JOIN bo_application_dms_documents_mapping as map ON map.sno=app.sno
		INNER JOIN sso_profiles as u ON u.user_id=map.user_id
		LEFT JOIN sso_users ON sso_users.user_id=map.user_id
		WHERE map.dept_id=:dept_id AND map.mapping_id IS NOT NULL AND map.status=:dms_doc_status $whereText GROUP BY app.sno";		
		//echo $whereText;
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		//$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		$command->bindParam(":dms_doc_status",$dms_doc_status,PDO::PARAM_STR);
		$appList=$command->queryAll();
		if($appList===false)
			return false;
		return $appList;
	}
	
		static function getAllDmsVerifiedApplication($dept_id,$app_status='P',$dms_doc_status='V'){
		@session_start();
		
		$uid = $_SESSION['uid'];
		$connection=Yii::app()->db;

		$sqlS = "SELECT * FROM bo_user_service_mapping WHERE user_id='$uid' AND status='Y' ORDER BY id DESC LIMIT 1";
		$command=$connection->createCommand($sqlS);
		$rowList=$command->queryRow();
		$whereText = "";
		if(!empty($rowList)){
			$allowed_service_ids = $rowList['service_id'];
			if($allowed_service_ids!=''){
				//$whereText = " AND app.sp_app_id IN ($allowed_service_ids)";
			}
		}else{
			$sqlS = "SELECT * FROM bo_user_service_mapping WHERE department_id='$dept_id' AND status='Y' ORDER BY id DESC";
			$command=$connection->createCommand($sqlS);
			$rowList=$command->queryAll();
			if(!empty($rowList)){
				foreach($rowList as $rowListArr){
					$service_idArr = explode(",",$rowListArr['service_id']);
					foreach($service_idArr as $val){
						$service_id_arr[] = $val;
					}
				}
				if(count($service_id_arr)>0){
					$allowed_service_ids = implode(",",$service_id_arr);
					//$whereText = " AND app.sp_app_id NOT IN ($allowed_service_ids)";
				}
			}
		}
		
		if($dms_doc_status == 'U'){
			$whereText .= " AND app.app_status IN ('P','F')";
		}else if($dms_doc_status == 'V' || $dms_doc_status == 'R'){
			$whereText .= " AND app.app_status IN ('P','F','RBI','A','R')";
		}
		
		$sql = "SELECT map.*,maplog.verifier_name,app.app_name,CONCAT(u.first_name,' ',u.last_name) as full_name,u.mobile_number,sso_users.email,app.unit_name,app.app_id,app.caf_id,app.app_status,app.created_on as app_date,app.noe,app.sp_app_id FROM
				bo_sp_applications as app 
				LEFT JOIN bo_application_dms_documents_mapping as map ON map.sno=app.sno
				LEFT JOIN bo_application_dms_documents_mapping_logs as maplog ON maplog.mapping_id=map.mapping_id				
				INNER JOIN sso_profiles as u ON u.user_id=map.user_id
				INNER JOIN sso_users ON sso_users.user_id=map.user_id
				WHERE map.dept_id=:dept_id AND map.mapping_id IS NOT NULL AND map.status=:dms_doc_status $whereText GROUP BY app.sno";
		
		$command=$connection->createCommand($sql);
		$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
		//$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		//$command->bindParam(":status",$app_status,PDO::PARAM_STR);
		$command->bindParam(":dms_doc_status",$dms_doc_status,PDO::PARAM_STR);
		$appList=$command->queryAll();
		
		if($appList===false)
			return false;
		return $appList;
	}
	
	static function getAllUsedDocumentsOfInvestorServiceWise2($sno,$user_id,$status = 'U'){
		$connection=Yii::app()->db; 
		// bo_application_dms_documents_mapping
		// cdn_dms_documents -- doc_ref_number,document_name
		// bo_infowizard_documentchklist -- name,chklist_id
		// sso_users - first_name,last_name
		$whereText ="";
		if($status != 'ALL'){
			$whereText = " AND map.status='$status'";
		}
		
		/*$sql="SELECT map.*,dms.doc_ref_number,dms.document_name,CONCAT(u.first_name,' ',u.last_name) as full_name,iw.name as d_name,iw.chklist_id,app.unit_name,app.app_id,app.app_status,app.created_on as app_date,app.app_name,log.verifier_name,log.created_time as verified_date_time FROM 
							bo_application_dms_documents_mapping as map,
							cdn_dms_documents as dms,
							bo_infowizard_documentchklist iw,
							sso_profiles as u,
							bo_sp_applications as app
							LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=map.mapping_id
							WHERE map.sno=:sno AND map.user_id=:user_id AND map.documents_id=dms.documents_id AND map.user_id=u.user_id AND dms.docchk_id=iw.docchk_id AND app.sno=:app_sno
							ORDER BY map.mapping_id DESC
			";*/
                /* Added : ,app.print_app_call_back_url
                 * Reason : Showing application Detail To Document Verifier
                 * Date : 17042018
                 * @Author : Rahul Kuamr
                 */
                
                  /* Added Join with bo_information_wizard_service_parameters table to link with doc in one go : 09092018 */
		 $sql="SELECT concat(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice) as iw_service_id,map.*,dms.doc_ref_number,dms.document_name,CONCAT(u.first_name,' ',u.last_name) as full_name,iw.name as d_name,u.mobile_number,sso_users.email,iw.chklist_id,app.unit_name,app.submission_id as app_id,app.application_status as app_status,app.application_created_date as app_date,app.sp_app_id,app.app_name,log.verifier_name,log.created_time as verified_date_time,app.print_app_call_back_url,dmstrs.comment,dmstrs.dcp_value FROM 
							bo_application_dms_documents_mapping as map 
							LEFT JOIN bo_dcp_transactions as dmstrs ON dmstrs.mapping_id=map.mapping_id
							INNER JOIN cdn_dms_documents as dms ON dms.documents_id=map.documents_id
							INNER JOIN bo_infowizard_documentchklist iw ON iw.docchk_id=dms.docchk_id
							INNER JOIN sso_profiles as u ON u.user_id=map.user_id
							INNER JOIN sso_users ON sso_users.user_id=map.user_id
							INNER JOIN bo_new_application_submission as app ON app.submission_id=map.sno 
                                                        INNER JOIN bo_information_wizard_service_parameters as biwsp ON app.sp_app_id=biwsp.swcs_service_id	
                                                        LEFT JOIN bo_application_dms_documents_mapping_logs as log ON log.mapping_id=map.mapping_id
							WHERE map.sno=:sno  AND map.user_id=:user_id AND biwsp.is_active='Y' 
							Group By map.mapping_id 
                                                        ORDER BY map.mapping_id DESC 
			";
			
			//echo $sno."===".$user_id."======". $sql;die;
		$command=$connection->createCommand($sql);
		$command->bindParam(":sno",$sno,PDO::PARAM_INT);
		//$command->bindParam(":app_sno",$sno,PDO::PARAM_INT);
		//$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
		$appList=$command->queryAll();
		if($appList===false)
			return false;
		return $appList;
	}
	
	    /* Rahul Kumar : 09092018 */
        public static function docVerifyInOneGo($sub_service_id=null){   
            $connection=Yii::app()->db;
            $sql="select * from bo_infowizard_subservice_tag_mapping where to_be_used_in_dms_one_go='Y' AND is_active='Y' AND sub_service_id='$sub_service_id'";
           $command=$connection->createCommand($sql);
            $appList=$command->queryAll();
		if(empty($appList))
			return false;
		return true;
            
        }
}

?>