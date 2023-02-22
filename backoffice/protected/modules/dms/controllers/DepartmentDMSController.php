<?php
class DepartmentDMSController extends Controller
{
	public function actionIndex()
	{
		$this->redirect('/');
		exit;
	}
	
	public function actionView(){
		@session_start();
		//echo $_SERVER['DOCUMENT_ROOT'];
		//echo Yii::app()->basePath."/../../themes/backend/dms/".$iuid."/"; die;	
		//echo '<pre>'; print_r($_SESSION); die;
		if(!isset($_SESSION['department_login']) || !$_SESSION['department_login']){
			$this->redirect('/');
			exit;
		}
		
		if(!DefaultUtility::isValidDocumentVerifierLogin()){
			$this->redirect('/');
			exit;
		}
		$sno 		= base64_decode($_GET['sno']);
		$user_id 	= base64_decode($_GET['user']);
		
		$this->render('dms_listing_department',array('sno'=>$sno,'user_id'=>$user_id));
		
	}
	public function downloadFile($fullpath){
	  if(!empty($fullpath)){ 
		  $ext = pathinfo($fullpath, PATHINFO_EXTENSION);
		  if(strtolower($ext) == 'pdf'){
			$ctype = "application/pdf";
		  }else{
			$ctype = "image/jpeg";
		  }
		  //$new_name = time().".".$ext;
		  header("Content-type:$ctype"); 
		  header('Content-Disposition: attachment; filename="'.basename($fullpath).'"'); 
		  //header('Content-Length: ' . filesize($fullpath));
		  readfile($fullpath);
		  Yii::app()->end();
	  }
	}
	
	public function actionDownloadMyDocument(){
		@session_start();
		$msg="";
		if(!isset($_SESSION['department_login']) || !$_SESSION['department_login']){
			$this->redirect('/');
			exit;
		}
		
		if(!DefaultUtility::isValidDocumentVerifierLogin()){
			$this->redirect('/');
			exit;
		}
		if(isset($_GET['ref_no'])){
			$ref_no = base64_decode($_GET['ref_no']);
			$iuid = base64_decode($_GET['iuid']);
			$sql="SELECT * FROM cdn_dms_documents WHERE iuid='$iuid' AND doc_ref_number='$ref_no' LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$res = $command->queryRow();
			if(count($res)>0){
				$link = FRONT_BASEURL."themes/backend/mydoc/".$res['iuid']."/".$res['document_name'];
				$this->downloadFile($link);
			}else{
				$msg = 'Error. Please try again.';
			}
		}else{
			$msg = 'invalid access';
		}
		
		echo $msg;
	}
	
	public function actionDepartmentActionOnDocument(){
		@session_start();
		$msg="";
		$next_msg = "";
		if(!isset($_SESSION['department_login']) || !$_SESSION['department_login']){
			$this->redirect('/');
			exit;
		}
		$flag= 0;
		
		if($_SESSION['role_id']==7 || $_SESSION['role_id']==4 || $_SESSION['role_id']==83 || $_SESSION['role_id']==89 || $_SESSION['role_id']==90 || $_SESSION['role_id']==88 || $_SESSION['role_id']==87 || $_SESSION['role_id']==3 || $_SESSION['role_id']==84)
		{
			$flag= 1;
		}
		if(!DefaultUtility::isValidDocumentVerifierLogin() && $flag==0){

			echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Sorry you should not verify or reject the document'));
			exit;
		}
		
		/* print_r($_POST);die; */
		if(isset($_POST['mapid'])){
			$mapid 	= base64_decode($_POST['mapid']);		
			$comments 	= trim($_POST['comment']);
			$action = $_POST['action'];
			$dept_user_id 	= $_SESSION['uid'];
			$uname 	= $_SESSION['uname'];
			$remote_ip 	= $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			$is_uploaded_flag_wh = '';
			if($action == 'verify'){
				$status='V'; $sms_status = "Approved";
				$is_uploaded_flag_wh = '';
				$comments = $comments==''?'':$comments;
			}else if($action == 'reject'){
				$status='R'; $sms_status = "Rejected";
				$is_uploaded_flag_wh = '0';
			}else{
				echo "invalid"; 
				exit;
			}
			
		$connection=Yii::app()->db; 
	
		
	
		
		$doc_array=Yii::app()->db->createCommand("SELECT * FROM bo_application_dms_documents_mapping where mapping_id=$mapid")->queryRow();
	
		

		if($doc_array===false){
			$msg = "Invalid Attempt";
			exit;
		}else{

			$application =Yii::app()->db->createCommand("SELECT service_id, submission_id, application_status FROM bo_new_application_submission where submission_id=".$doc_array['sno'])->queryRow();
			if($application){
				if(in_array($application['application_status'], ['A','R'])){
					echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Sorry you should not verify or reject the document. Because application was already Approved or Rejected'));
					exit;
				}
			}else{
				echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Sorry application not found'));
				exit;
			}
			
			
			$cdate=date("Y-m-d H:i:s");
			$document_file_name = $doc_array['document_file_name'];
			$app_id = $doc_array['sno'];
			$file_array = explode("_",$document_file_name);
			$file_code = $file_array[1];
			$file_version = str_replace(".pdf","",$file_array[2]);
			
			
			$app_dms_doc_map = ApplicationDmsDocumentsMapping::model()->findByPk($mapid);
			$app_dms_doc_map->status = $status;
			$app_dms_doc_map->comments = $comments;
			$app_dms_doc_map->last_updated = $cdate;
			if($is_uploaded_flag_wh == '0'){
				$app_dms_doc_map->is_uploaded_flag = 0;
			}
			

			

			// below few line code commented by aamir 5-11-2022
			
			//$sql_up_map="UPDATE bo_application_dms_documents_mapping SET status='$status',comments='$comments',last_updated='$cdate' $is_uploaded_flag_wh WHERE mapping_id='$mapid'";
			/*$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_up_map);*/
			//if($command->query()){

			// end comment code 5-11-2022

			if($app_dms_doc_map->save()){
				/*if(!empty($is_uploaded_flag_wh) && $is_uploaded_flag_wh!=''){
					// 
					$sql_dm = "SELECT * FROM bo_application_dms_documents_mapping WHERE mapping_id='$mapid' AND documents_id='$did'";
					$command=$connection->createCommand($sql_dm);
					$dm_array=$command->queryRow();
					
					//
					$sql_d = "SELECT * FROM cdn_dms_documents WHERE documents_id='$did'";
					$command=$connection->createCommand($sql_d);
					$d_array=$command->queryRow();
					if(!empty($d_array)){
						$docchk_id = $d_array['docchk_id'];
						$user_id = $d_array['user_id'];
						$iuid = $d_array['iuid'];
						$sql_l = "SELECT * FROM cdn_dms_documents WHERE docchk_id='$docchk_id' AND user_id='$user_id' AND doc_status IN ('U','V') AND documents_id>'$did' AND is_document_active='Y' ORDER BY documents_id DESC LIMIT 1";
						$command=$connection->createCommand($sql_l);
						$l_array=$command->queryRow();
						if(!empty($l_array)){
							$sno = $dm_array['sno'];
							$dept_id = $dm_array['dept_id'];
							$documents_id = $l_array['documents_id'];
							$used_file_name = $l_array['document_name'];
							$this->insertDMSUsedDocs($iuid,$user_id,$sno,$dept_id,$documents_id,$used_file_name);
							
							$file_array_new = explode("_",$used_file_name);
							$file_code_new = $file_array_new[1];
							$file_version_new = str_replace(".pdf","",$file_array_new[2]);
							$next_msg = "Since, new version of rejected document is already uploaded so ".$file_version_new." will be consumed for further process.";
						}
					}
				}*/
				
				
				// Generate Log -- bo_application_dms_documents_mapping_logs
					$logModel = new ApplicationDmsDocumentsMappingLogs;
					$logModel->mapping_id	= $mapid;
					//$logModel->documents_id	= $did;
					$logModel->status	= $status;
					$logModel->dept_user_id	= $dept_user_id;
					$logModel->verifier_name	= $uname;
					//$logModel->verifier_designation	= 'NA';
					$logModel->verifier_comments	= $comments;
					$logModel->created_time	= $cdate;
					$logModel->remote_ip	= $remote_ip;
					$logModel->user_agent	= $user_agent;
					$logModel->save();
				// END OF Log


				
				/* comment by aamir anf update code below
				if($doc_array['status'] == 'U' && $status == 'V'){
					$new_status = 'V';
					$is_uploaded='Y';
				}else if($doc_array['status'] == 'V' && $status == 'V'){
					$new_status = 'V';
					$is_uploaded='Y';
				}else if($doc_array['status'] == 'U' && $status == 'R'){
					$new_status = 'R';
					$is_uploaded='N';
				}else if($doc_array['status'] == 'V' && $status == 'R'){
					$new_status = 'M';
					$is_uploaded='N';						
				}else if($doc_array['status'] == 'R' && $status == 'V'){
					$new_status = 'M';
					$is_uploaded='N';
				}else if($doc_array['status'] == 'M' && ($status == 'V' || $status == 'R')){
					$new_status = 'M';
					$is_uploaded='N';
				}*/

			/*	$bodocmap = Yii::app()->db->createCommand("SELECT * FROM  bo_application_dms_documents_mapping WHERE mapping_id='$mapid'")->queryRow();*/

				if($doc_array['status'] == 'U' && $status == 'V'){
					$extcondition = ', doc_status="V", is_uploaded="Y"';	
				}else if($doc_array['status'] == 'V' && $status == 'V'){
					$extcondition = ', doc_status="V", is_uploaded="Y"';	
				}else if($doc_array['status'] == 'U' && $status == 'R'){
					$extcondition = ', doc_status="R", is_uploaded="N"';	
				}else if($doc_array['status'] == 'V' && $status == 'R'){
					$extcondition = ', doc_status="M", is_uploaded="N"';						
				}else if($doc_array['status'] == 'R' && $status == 'R'){
					$extcondition = ', doc_status="R", is_uploaded="N"';						
				}else if($doc_array['status'] == 'R' && $status == 'V'){				
					$extcondition = ', doc_status="V", is_uploaded="Y"';	
				}else if($doc_array['status'] == 'M' && ($status == 'V' || $status == 'R')){
					$extcondition = ', doc_status="M", is_uploaded="N"';	
				}

				
				$sql_up_dms="UPDATE cdn_dms_documents SET last_updated='$cdate' $extcondition  WHERE documents_id=".$doc_array['documents_id'];

				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql_up_dms);
				$command->query();

				 $status_array['U'] = 'Pending';
                $status_array['V'] = 'Approved';
                $status_array['R'] = 'Rejected';
                
				$appList = Yii::app()->db->createCommand("SELECT log.verifier_name,  log.verifier_comments, log.created_time as verified_date_time, log.status, log.dept_user_id,
        	(SELECT role_id FROM bo_user_role_mapping r WHERE r.user_id=log.dept_user_id AND r.is_mapping_active='Y' ORDER BY r.mapping_id ASC LIMIT 1)   as role_id      
            FROM bo_application_dms_documents_mapping_logs as log
            
            WHERE log.mapping_id=$mapid ORDER BY log.id DESC")->queryAll();

				$l=1;  $content ='';
              
                     foreach ($appList as $dulog) {  
                        $content.= '<b>By :</b> '.$dulog['verifier_name'] .'<br><b>Date :</b>'.  ($dulog['verified_date_time'] ? (date('d-m-Y h:i a',strtotime($dulog['verified_date_time']))) : 'NA'). '<br>
                        <b>Status : </b>'. $status_array[$dulog['status']].'<br>
                          <b>Comments :</b>' . @$dulog['verifier_comments'];
                             if(sizeof($appList)>$l){ 
                              $content.='<hr style="color:black; height: 2px;">';
                             } 
                      $l++; } 
               


				/*$content = '<b>By :</b> '.$uname.'<br><b>Date :</b> '.($cdate ? date('d-m-Y h:i a',strtotime($cdate)) : 'NA').'<br> <b>Status : </b> '.$sms_status.' <br><b>Comments :</b> '.$comments;*/

				echo CJavaScript::jsonEncode(array('status'=>true,'contenttext'=>$content,'status'=>$sms_status,'service_id'=>$application['service_id'],'submission_id'=>$application['submission_id'],'msg'=>'success'));



				/*$sql_up_dms="UPDATE cdn_dms_documents SET doc_status='$new_status',last_updated='$cdate',is_uploaded='$is_uploaded' WHERE documents_id='$did'";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql_up_dms);
				if($command->query()){
					$dept_id = $_SESSION['dept_id'];
					$deptModel = new DepartmentsExt;
					$dept      = $deptModel->getDeptbyId($dept_id);
					$dept_name = $dept['department_name'];
					
					$mobile_msg = "Your document $file_code version - $file_version has been $sms_status by $dept_name department for application number #$app_id with comments: ".$comments.".".$next_msg;
					
					// Send Email / SMS To Investor
						$investor_mobile = $doc_array['mobile_number'];
						$investor_email = $doc_array['email'];
						$investor_name 	= $doc_array['first_name']." ".$doc_array['last_name'];
						DefaultUtility::sendOTPToMobile($investor_mobile,$mobile_msg);
						
					// END

					$content = '<b>Action By :</b> '.$uname.', <br><b>Action Date :</b> '.$cdate.', <br><b>Comments :</b> '.$comments;

					echo CJavaScript::jsonEncode(array('status'=>true,'contenttext'=>$content,'msg'=>'success'));
				}else{
					 echo CJavaScript::jsonEncode(array('status'=>false,'contenttext'=>'','msg'=>'Please contact your support team.'));				
				}*/
			}else{
				 echo CJavaScript::jsonEncode(array('status'=>false,'contenttext'=>'','status'=>'','msg'=>'Please contact your support team.'));			
			}		
		}
		
			
		}
		
		 exit;
	}
	
	public function actionDepartmentActionOnDocumentOLD(){
		@session_start();
		$msg="";
		if(!isset($_SESSION['department_login']) || !$_SESSION['department_login']){
			$this->redirect('/');
			exit;
		}
		
		if(!DefaultUtility::isValidDocumentVerifierLogin()){
			$this->redirect('/');
			exit;
		}
		if(isset($_POST['mapid']) && isset($_POST['did'])){
			$mapid 	= base64_decode($_POST['mapid']);
			$did 	= base64_decode($_POST['did']);
			$uid 	= base64_decode($_POST['uid']);
			$action = $_POST['action'];
			$dept_user_id 	= $_SESSION['uid'];
			$uname 	= $_SESSION['uname'];
			$remote_ip 	= $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			if($action == 'verify'){
				$status='V'; $sms_status = "Approved";
			}else if($action == 'reject'){
				$status='R'; $sms_status = "Rejected";
			}else{
				echo "invalid"; 
				exit;
			}
			
		$connection=Yii::app()->db; 
		// bo_application_dms_documents_mapping
		// cdn_dms_documents -- doc_ref_number,document_name
		// bo_infowizard_documentchklist -- name,chklist_id
		// sso_users - first_name,last_name
		
		$sql="SELECT * FROM bo_application_dms_documents_mapping as map,cdn_dms_documents as dms,sso_profiles as p,sso_users as u WHERE map.mapping_id=:mapping_id AND map.documents_id=:documents_id AND map.documents_id=dms.documents_id AND u.user_id=map.user_id AND p.user_id=u.user_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":mapping_id",$mapid,PDO::PARAM_INT);
		$command->bindParam(":documents_id",$did,PDO::PARAM_INT);
		$doc_array=$command->queryRow();
		if($doc_array===false){
			$msg = "Invalid Attempt";
			exit;
		}else{
			//echo '<pre>'; print_r($doc_array);
			//echo json_encode($doc_array);
			$cdate=date("Y-m-d H:i:s");
			$sql_up_map="UPDATE bo_application_dms_documents_mapping SET status='$status',last_updated='$cdate' WHERE mapping_id='$mapid' AND documents_id='$did'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_up_map);
			if($command->query()){
				// Generate Log -- bo_application_dms_documents_mapping_logs
					$logModel = new ApplicationDmsDocumentsMappingLogs;
					$logModel->mapping_id	= $mapid;
					$logModel->documents_id	= $did;
					$logModel->status	= $status;
					$logModel->dept_user_id	= $dept_user_id;
					$logModel->verifier_name	= $uname;
					//$logModel->verifier_designation	= 'NA';
					//$logModel->verifier_comments	= 'NA';
					$logModel->created_time	= $cdate;
					$logModel->remote_ip	= $remote_ip;
					$logModel->user_agent	= $user_agent;
					$logModel->save();
				// END OF Log
				
				if($doc_array['doc_status'] == 'V' || $doc_array['doc_status'] == 'R' || $doc_array['doc_status'] == 'M'){
					$new_status = 'M';
					$is_uploaded='N';
				}else if($doc_array['doc_status'] == 'U' && $status == 'V'){
					$new_status = 'V';
					$is_uploaded='Y';
				}else if($doc_array['doc_status'] == 'U' && $status == 'R'){
					$new_status = 'R';
					$is_uploaded='N';
				}
				$sql_up_dms="UPDATE cdn_dms_documents SET doc_status='$new_status',last_updated='$cdate',is_uploaded='$is_uploaded' WHERE documents_id='$did'";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql_up_dms);
				if($command->query()){
					$dept_id = $_SESSION['dept_id'];
					$deptModel = new DepartmentsExt;
					$dept      = $deptModel->getDeptbyId($dept_id);
					$dept_name = $dept['department_name'];
					
					$mobile_msg = "Your document is $sms_status by $dept_name department";
					
					// Send Email / SMS To Investor
						$investor_mobile 	= $doc_array['mobile_number'];
						$investor_email 	= $doc_array['email'];
						$investor_name 		= $doc_array['first_name']." ".$doc_array['last_name'];
						DefaultUtility::sendOTPToMobile($investor_mobile,$mobile_msg);
						
					// END
					$msg = 'success';
				}else{
					$msg = "Please contact your support team.";
				}
			}else{
				$msg = "Please contact your support team.";
			}
			
			
			
		}
		
			
		}
		
		echo $msg; exit;
	}
	
	public function insertDMSUsedDocs($iuid,$user_id,$sno,$dept_id,$documents_id,$used_file_name){
	
		$model= new ApplicationDmsDocumentsMapping;
		$model->iuid=$iuid;
		$model->user_id=$user_id;
		$model->sno=$sno;
		$model->dept_id=$dept_id;
		$model->documents_id=$documents_id;
		$model->document_file_name=$used_file_name;
		$model->status='U';
    	$model->user_agent='Auto Insert When department reject the docs';
    	$model->created_on=date("Y-m-d H:i:s");
    	$model->ip_address=$_SERVER['REMOTE_ADDR'];
    	$model->save();
		
	}
	
	
	public function actionGetDCP(){
		$doc_chk_id = $_GET['doc_chk_id'];
		$dm = $_GET['dm'];
		$sid = $_GET['sid'];
		
		$sql = "SELECT document_checklist_id FROM bo_infowiz_document_check_list_mapping_new WHERE docchk_id='$doc_chk_id' AND swcs_id='$sid' AND is_active='1' ORDER BY id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$doc_chk=$command->queryRow();
		if(empty($doc_chk)){
			$sql = "SELECT document_checklist_id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id='$doc_chk_id' ORDER BY id DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$doc_chk=$command->queryRow();
		}
		// echo "<pre>";
		//print_r($doc_chk);die;
	 
		if($doc_chk){
			$conteee = json_decode($doc_chk['document_checklist_id'],true);
			//print_r($conteee); die;
			echo '<table class="table table-striped table-bordered" width="100%">';
			echo '<tr>
				<td>S.No.</td>
				<td>Document Checkpoint</td>
				<td>File</td>
				<td>Action</td>
				<td>Comment</td>
			</tr><input type="hidden" name="dm" value="'.$dm.'">';
			$i=1;
			foreach($conteee as $idd){
				$sql1 = "SELECT code,name,id,file_path FROM bo_infowiz_dcp_master WHERE id='$idd' ORDER BY id DESC LIMIT 1";
				$connection1=Yii::app()->db; 
				$command1=$connection->createCommand($sql1);
				$doc_chk1=$command1->queryRow();
				
				if($doc_chk1){
					$sql_ssss = "SELECT dcp_value,comment FROM bo_dcp_transactions WHERE mapping_id='$dm' AND dcp_id='".$doc_chk1['id']."' ORDER BY id DESC LIMIT 1";
					$connection1=Yii::app()->db; 
					$command1=$connection1->createCommand($sql_ssss);
					$res_ssss=$command1->queryRow();
					$dcp_value = '';
					$sel_yes = '';
					$sel_no = '';
					$comment = '';

					if(!empty($res_ssss)){
						$dcp_value = $res_ssss['dcp_value'];
						//$comment = $res_ssss['comment'];
						if($dcp_value == 'Yes'){
							//$sel_yes = 'selected';
						}else if($dcp_value == 'No'){
							//$sel_no = 'selected';
						}
					}
					$dcp_file_path_a ='';
					if($doc_chk1['file_path']!=''){
						$dcp_file_path = $doc_chk1['file_path'];
						$dcp_file_path_a = '<a target="_blank" href="'.$dcp_file_path.'" >View File </a>';
					}
					echo '
						<input type="hidden" name="idddd_arr[]" value="'.$doc_chk1['id'].'">
						
					    <tr>
						<td>'.$i.'</td>
						<td>'.$doc_chk1['name'].'</td>
						<td>'.$dcp_file_path_a.'</td>
						<td>
						<select onchange="action_dp_fun('.$doc_chk1['id'].')" class="action_dp" id="'.$doc_chk1['id'].'" name="action_'.$doc_chk1['id'].'">
							<option value="">Select Action</option>
							<option '.$sel_yes.' value="Yes">Yes</option>
							<option '.$sel_no.' value="No">No</option>
						</select>
						</td>
						<td>
						<textarea id="cmt_'.$doc_chk1['id'].'" name="comments_'.$doc_chk1['id'].'">'.$comment.'</textarea>
						</td>
					</tr>';
					$i++;
				}
			}
			echo '</table>';
			echo '<br><br> <input type="submit" name="submit" value="Save" id="save_comment" class="btn btn-success"> <br><br> ';
			
		}
	}
	
	public function actionSaveDCPTr(){
		echo '<pre>'; print_r($_POST); die;
	}
	
	public function actionViewDMSIs(){
		@session_start();
		$this->render('dmsis');
	}
	
	public function actionDepartmentActionOnDocumentDCP(){
		@session_start();
		//echo '<pre>'; print_r($_SESSION); echo '</pre>'; die;
		$mapid 	= ($_POST['mapid']);
			$did 	= ($_POST['did']);
			$uid 	= (@$_POST['uid']);
			$documents_id 	= (@$_POST['documents_id']);
			$comments 	= trim($_POST['comment']);
			$action = $_POST['action'];
			$dept_user_id 	= @$_SESSION['uid'];
			$uname 	= @$_SESSION['uname'];
		
		if($action == 'verify'){
				$status='V'; 
				$comments = $comments==''?'Verified':$comments;
			}else if($action == 'reject'){
				$status='R'; 
			}else{
				echo "invalid"; 
				exit;
			}
		$cdate = date('Y-m-d H:m:i');
		$sql_up_dms="UPDATE bo_dms_verifier SET verifier_name='$uname',comments='$comments',status='$status',verified_date_time='$cdate' WHERE id='$mapid'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_up_dms);
		if($command->query()){
			$sql_up_dms111="UPDATE cdn_dms_documents SET vbi='$status' WHERE documents_id='$documents_id'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_up_dms111);
			$command->query();
		}
		echo $msg = 'success';
	}

/*Aamir 18-10-2022*/
	public function actionDocstatusfilter(){
		if(isset($_POST['srn_no'])){
			$srn_no = $_POST['srn_no']; 
			$user_id = $_POST['user_id']; 
			$status = $_POST['status']; 
			 $list_arr = ApplicationDmsDocumentsMappingExt::getAllUsedDocumentsOfInvestorServiceWise($srn_no, $user_id, $status);
		
			$list_table = '<table id="sample_31" class="table table-striped table-bordered" width="100%"> <thead>
                        <tr>
                            <th class="td_center">S.N.</th>
                            <th class="td_center">Document Name</th>
                            <th class="td_center">Date</th>                          
                            <th class="td_center">Comments by Applicant</th>
                            <th class="td_center" width="25%">Action Details</th>               
                            <th class="td_center" width="25%">Action</th>
                        </tr>
                    </thead><tbody>';
                    foreach ($list_arr as $key => $value) {
                    	$list_table.='<tr><td class="td_center">'.($key+1).'</td>';
                    	switch ($value['status']) {
                    		case 'V':
                    			$cs = 'Approved';
                    			break;
                    		case 'U':
                    			$cs = 'Pending';
                    			break;
                    		case 'R':
                    			$cs = 'Rejected';
                    			break;
                    		
                    		default:
                    			$cs = 'NA';
                    			break;
                    	}
                    	$list_table.='<td class="td_center">'. '<a target="_blank" href="/backoffice/doc/mydoc?view='.DefaultUtility::getDockey($value['document_file_name']).'"style="color:blue;">'.$value['name'].'</a></td>';

                    	$list_table.='<td class="td_center">'.$value['created_on'].'</td>';
                    	$list_table.='<td class="td_center">'.$value['usercomment'].'</td>';

$mapping_id = $value['mapping_id'];
 $status_array['U'] = 'Pending';
                $status_array['V'] = 'Approved';
                $status_array['R'] = 'Rejected';
        $appList = Yii::app()->db->createCommand("SELECT log.verifier_name,  log.verifier_comments, log.created_time as verified_date_time, log.status, log.dept_user_id,
        (SELECT role_id FROM bo_user_role_mapping r WHERE r.user_id=log.dept_user_id AND r.is_mapping_active='Y' ORDER BY r.mapping_id ASC LIMIT 1)   as role_id      
            FROM bo_application_dms_documents_mapping_logs as log
            
            WHERE log.mapping_id=$mapping_id ORDER BY log.id DESC")->queryAll();
            $l=1;
               
                   $log_data = '';
                     foreach ($appList as $dulog) {  

                       $log_data.= '<b>By :</b>' . $dulog['verifier_name']. '<br>'.
                        '<b>Date :</b>'. ( $dulog['verified_date_time'] ? (date('d-m-Y h:i a',strtotime($dulog['verified_date_time']))) : 'NA') . '<br>'.
                        '<b>Status : </b>'. @$status_array[$dulog['status']] . '<br>'.
                        '<b>Comments :</b>'. @$dulog['verifier_comments'];
                             if(sizeof($appList)>$l){ 
                              $log_data.='<hr style="color:black; height: 2px;">';
                             } 
                      $l++; } 
                
                          

                                 

                    	$list_table.='<td class="td_center"><div id="vri_rej_details'.$key.'">'. $log_data .'</div></td>';
                    	$mapid = base64_encode($value['mapping_id']);
                      	$list_table.='<td class="td_center"><div id="vri_rej_btn'.$key.'">'.(
                      		'<textarea rows="2" id="cmt_'.$value['mapping_id'].'" class="cmt_verifier form-control" name="comments" style ="height: 50px !important;"></textarea> 
                      		                                  <br>                      
	                            <input type="btn" class="btn btn-primary  verify btn_doc" value="Verify" onclick="actionOnDocument('."'$mapid'".', '."'verify'".', '."'Okay'".','. $value['mapping_id'] .', '.$key .')"  >

	                             <input type="btn" class="btn btn-danger  reject btn_doc" value="Reject" onclick="actionOnDocument('."'$mapid'".', '."'reject'".', '."'Reject'".','. $value['mapping_id'] .', '.$key .')"  >

	                           
	
	                           '
                    	).'</div></td></tr>';
                    }
                    $list_table.= '</tbody></table>';

			 echo CJavaScript::jsonEncode(['status'=>true,'list_data'=>$list_table]);
		}else{
			echo CJavaScript::jsonEncode(['status'=>false,'list_data'=>'<h5>No data found</h5>']);
		}
	}
	
}