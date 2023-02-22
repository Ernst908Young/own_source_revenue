<?php

class DocumentManagementController extends Controller
{
    
    // Changed By : Rahul //05052018
	public function actionIndex()
	{
		@session_start();
		if(!isset($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN']){
			$this->redirect(SSO_URL1);
			exit;
		}
        $user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	= $_SESSION['RESPONSE']['iuid'];
				
		if(isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
			$msg='1';
			//echo '<pre>'; print_r($_POST); die;
			$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
			if(!isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
			
			if($YII_CSRF_TOKEN2 != $_POST['FileUpload']['YII_CSRF_TOKEN']){
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
			//echo '<pre>'; print_r($_POST); die;
			if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['name'])){
				$file_name = strtolower($_FILES['dms_doc_uploads']['name']);
				$file_size = $_FILES['dms_doc_uploads']['size']/1000;
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				//$allowed_ext = array('jpg','jpeg','bmp','png','pdf','doc','docx','xls','xlsx');
				$allowed_ext = array('pdf');
				if(!in_array($ext,$allowed_ext)){
					echo $msg = "This file type not allowed. Please upload correct file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				if($file_size>25000){
					echo $msg = "Maximum file size allowed is 25MB. Please upload upto 25MB file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				
					$path = Yii::app()->basePath."/../../themes/backend/mydoc/".$iuid."/";
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					
					$doc_id 	= $_POST['FileUpload']['doc_id'];
					$issuer_id 	= $_POST['FileUpload']['issuer_id'];
					$issued_by 	= $_POST['FileUpload']['issued_by'];
					$docchk_id 	= $_POST['FileUpload']['doc_code'];
					$doc_version_type 	= $_POST['FileUpload']['doc_version_type'];
					$document_reference_number 	= $_POST['FileUpload']['document_reference_number'];
					$valid_from 	= date('Y-m-d',strtotime($_POST['FileUpload']['valid_from']));
					$valid_to 	= date('Y-m-d',strtotime($_POST['FileUpload']['valid_to']));
					$comments 	= $_POST['FileUpload']['comments'];
					$my_doc_status='R';
					if(isset($_POST['FileUpload']['mydoc_status']) && $_POST['FileUpload']['mydoc_status']=='active'){
						$my_doc_status='Y';
					}
					$doc_chk_arr = $this->GetDocCheckID($docchk_id);
					if($doc_chk_arr == false){
						// Yii::app()->user->setFlash('error', "Document not matched with issuer and issued by.");
						$msg = "Document not matched with issuer and issued by.";
					}else{
						$chklist_id = $doc_chk_arr['chklist_id'];
						$docchk_id = $doc_chk_arr['docchk_id'];
						$name 		= $doc_chk_arr['name'];
						$version = $this->GetDocVersion($docchk_id,$iuid,$doc_version_type);
						$doc_ref_number = $iuid."_".$chklist_id."_".$doc_version_type.$version;
						$new_name = $doc_ref_number.".".$ext;
						move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path.$new_name);
							
						$issuer_id = $issuer_id == 'all'?1:$issuer_id;
						$model = new DmsDocuments;
						$model->docchk_id = $docchk_id;
						$model->doc_type_id = $doc_id;
						$model->issuer_id = $issuer_id;
						$model->issued_by_id = $issued_by;
						$model->iuid = $iuid;
						$model->user_id = $user_id;
						$model->doc_ref_number = $doc_ref_number;
						$model->document_name = $new_name;
						$model->document_version = $version;
						$model->document_version_type = $doc_version_type;
						$model->doc_status = 'U';
						$model->is_document_active='Y';
						$model->document_reference_number=$document_reference_number;
						$model->valid_from=$valid_from;
						$model->valid_to=$valid_to;
						$model->valid_to=$valid_to;
						$model->comments=$comments;
						$model->created_on=date('Y-m-d H:i:s');
						
						if($model->save()){
							$new_documents_id = $model->documents_id;
							if(isset($_POST['FileUpload']['documents_id'])){
								// Update previous
								$documents_id = $_POST['FileUpload']['documents_id'];
								$modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
								$modelUp->is_uploaded = 'Y';
								$modelUp->save();
								
								$rejSql="SELECT * FROM bo_application_dms_documents_mapping WHERE user_id='$user_id' AND iuid='$iuid' AND documents_id='$documents_id' AND is_uploaded_flag='0'";
								$connection=Yii::app()->db; 
								$command=$connection->createCommand($rejSql);
								$rej_documents_array = $command->queryAll();
								if(!empty($rej_documents_array)){
									foreach($rej_documents_array as $rej_arr){
										$sno = $rej_arr['sno'];
										$dept_id = $rej_arr['dept_id'];
										$mapping_id = $rej_arr['mapping_id'];
										
										
										$this->insertDMSUsedDocs($iuid,$user_id,$sno,$dept_id,$new_documents_id,$new_name);
										
										// Update previous
										$modelUpM = ApplicationDmsDocumentsMapping::model()->findByPk($mapping_id); //$this->loadModel($documents_id);
										$modelUpM->is_uploaded_flag = '1';
										$modelUpM->save();
									}
								}
								
							}
							
							Yii::app()->user->setFlash('success', "Your document uploaded successfully.");
							$msg = "success";
						}else{
							$errStr='';
							foreach($model->getErrors() as $ekey=>$eArr){
								$errStr .= implode(",",$eArr);
							}
							//echo '<pre>';print_r($model->getErrors());exit;
							//Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
							if($errStr==''){
								$msg = "Error: Please contact support team. <br>";
							}else{
								$msg = $errStr;
							}
							
						}
							
					}
					
				
			}else{
				$msg = "Error: Please contact support team...";
			}
			if($msg!=''){
				echo $msg;
			}
			exit;
		}
		
		// Get all uploaded list of documents by Investors which are ready to submit
			$sql="SELECT * FROM cdn_dms_documents as dms,bo_infowizard_documentchklist as info WHERE dms.is_document_active='R' AND dms.iuid='$iuid' AND dms.docchk_id=info.docchk_id AND info.is_docchklist_active='Y' ORDER BY dms.documents_id DESC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$documents_array = $command->queryAll();
			//$documents_array = 1;
                        //
                         $dataToSend=$_GET;   
                         //$doc_id='166';
                       // Get all uploaded list of documents by Investors which are ready to submit
			$sql="select * from bo_infowizard_documentchklist where docchk_id='$dataToSend[doc_code]'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$docDetail = $command->queryRow();
			//$documents_array = 1;
		// END
                //  $dataToSend=$_GET;   
		$dataToSend['documents_data']=$documents_array;
		$dataToSend['docDetail']=$docDetail;
		//$dataToSend['lastUrl']=$_SERVER['HTTP_REFERER'];
		$this->renderPartial('dms_form',$dataToSend);
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
    	$model->user_agent='Auto Insert when investor upload the docs';
    	$model->created_on=date("Y-m-d H:i:s");
    	$model->ip_address=$_SERVER['REMOTE_ADDR'];
    	$model->save();
		
	}
	
	public function actionMyDocuments(){
		@session_start();
		//echo $_SERVER['DOCUMENT_ROOT'];
		//echo Yii::app()->basePath."/../../themes/backend/dms/".$iuid."/"; die;	
		//echo '<pre>'; print_r($_SESSION); die;
		if(!isset($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN']){
			$this->redirect(SSO_URL1);
			exit;
		}
		
		$user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	= $_SESSION['RESPONSE']['iuid'];
				
		// Get all uploaded list of documents by Investors which are active and ready to use for departments
			$sql="SELECT * FROM cdn_dms_documents as dms,bo_infowizard_documentchklist as info WHERE dms.is_document_active!='R' AND dms.iuid='$iuid' AND dms.docchk_id=info.docchk_id AND info.is_docchklist_active='Y' ORDER BY dms.documents_id DESC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$documents_array = $command->queryAll();
			//$documents_array = 1;
		// END
		
		$this->render('dms_listing',array('documents_data'=>$documents_array));
	}
	
	public function actionDeleteMyDocument(){
		@session_start();
		if(!isset($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN']){
			$msg = 'Invalid login'; exit;
		}
		
		$user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	= $_SESSION['RESPONSE']['iuid'];
		if(isset($_POST['ref_no'])){
			$ref_no = base64_decode($_POST['ref_no']);
			$doc_status = base64_decode($_POST['doc_status']);
			$sql_1="SELECT * FROM bo_application_dms_documents_mapping as map,cdn_dms_documents as doc WHERE doc.iuid='$iuid' AND doc.doc_ref_number='$ref_no' AND map.documents_id=doc.documents_id";
			$connection=Yii::app()->db; 
			$command_1=$connection->createCommand($sql_1);
			$res_1 = $command_1->queryAll();
			if(count($res_1)==0){
				if($doc_status!='R'){
					$sql="UPDATE cdn_dms_documents SET is_document_active='N' WHERE iuid='$iuid' AND doc_ref_number='$ref_no'";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql);
					if($command->query()){
						$msg = 'success';
					}else{
						$msg = 'Error. Please try again.';
					}
				}else{
					$sql="DELETE FROM cdn_dms_documents WHERE iuid='$iuid' AND doc_ref_number='$ref_no' AND is_document_active='R'";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql);
					if($command->query()){
						$msg = 'success';
					}else{
						$msg = 'Error. Please try again.';
					}
				}
			}else{
				$msg = "Sorry! You cann't delete this document, Because this is consumed by department.";
			}
		}else{
			$msg = 'invalid access';
		}
		
		echo $msg;
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
		if(!isset($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN']){
			echo $msg = 'Invalid login'; exit;
		}
		
		$user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	= $_SESSION['RESPONSE']['iuid'];
		if(isset($_GET['ref_no'])){
			$ref_no = base64_decode($_GET['ref_no']);
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
	
	
	public function actionGetAllIssuerBy(){
		$html='';
		if(isset($_POST['issuerid'])){
			$val 	= $_POST['issuerid'];
			$doc_id = $_POST['doc_id'];
			$services=false;
			if($val!=''){
				$html = '<select class="form-control" autocomplete="off" required="required" name="FileUpload[issued_by]" id="issued_by" onchange="getAllDocumentCheckList(this.value)"><option value="" selected="selected">--Select Issued By--</option>';
				if($val == 'all'){
					$sql="SELECT * FROM 
					bo_infowizard_issuerby_master
					WHERE is_issuerby_active='Y'
					ORDER BY name ASC";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql);
					$services=$command->queryAll();
				}else if($val>0){
					// 
					$sql1 = "SELECT m.issuerby_id FROM `bo_infowizard_documentchklist` as dc 
							INNER JOIN bo_infowizard_issuer_mapping as m ON m.issmap_id=dc.issmap_id
							WHERE FIND_IN_SET($doc_id,`doc_id`) AND m.issuer_id='$val'  GROUP BY m.issuerby_id";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql1);
					$issuerbyRes = $command->queryAll();
					$issuerbyArr=array();
					if($issuerbyRes){
						foreach($issuerbyRes as $issuerbyResA)
							$issuerbyArr[] = $issuerbyResA['issuerby_id'];
						
						$issuerbyTxt = implode(",",$issuerbyArr);
						$sql="SELECT * FROM 
						bo_infowizard_issuerby_master
						WHERE is_issuerby_active='Y' AND issuerby_id IN ($issuerbyTxt)
						GROUP BY name ORDER BY name ASC";
						$connection=Yii::app()->db; 
						$command=$connection->createCommand($sql);
						$services=$command->queryAll();
					}
					
					
				}
				if($services){
					foreach($services as $key=>$val1){ 
						$html .= '<option value="'.$val1['issuerby_id'].'">'.$val1['name'].'</option>';
					}
				}
				$html .= '</select>';
			}
			
		}
		echo $html;
	}
	public function actionGetAllDocumentCheckList(){
		$html='';
		//echo '<pre>'; print_r($_POST);
		if(!empty($_POST['doc_id'])){
			//echo '<pre>'; print_r($_POST); die;
			$val 		= $_POST['issuer_id'];
			$doc_id 	= $_POST['doc_id'];
			$issued_by 	= $_POST['issued_by'];
			if($doc_id!=''){
				$html = '<select onchange="showHideDiv(this.value)" class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code"><option value="" selected="selected">--Select Document--</option>';
				if($val == 'all'){
					//$sql="SELECT * FROM bo_infowizard_documentchklist WHERE is_docchklist_active='Y' AND FIND_IN_SET($doc_id,doc_id) ORDER BY name ASC";
					$sql="SELECT * FROM bo_infowizard_documentchklist d 
							INNER JOIN bo_infowizard_issuer_mapping as m ON m.issmap_id = d.issmap_id
							WHERE is_docchklist_active='Y' AND FIND_IN_SET($doc_id,doc_id) AND m.issuerby_id='$issued_by' ORDER BY name ASC";
				}else if($val>0){
					$sql="SELECT * FROM bo_infowizard_documentchklist d 
							INNER JOIN bo_infowizard_issuer_mapping as m ON m.issmap_id = d.issmap_id
							WHERE is_docchklist_active='Y' AND FIND_IN_SET($doc_id,doc_id) AND m.issuer_id='$val' AND m.issuerby_id='$issued_by' ORDER BY name ASC";
				}
				//echo $sql;
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				$services=$command->queryAll();
				foreach($services as $key=>$val1){ 
					$html .= '<option id="op-'.$val1['docchk_id'].'" data-mv="'.$val1['is_multi_version_allowed'].'" data-v="'.$val1['is_validity_required'].'" data-ref="'.$val1['is_document_reference_no_required'].'" value="'.$val1['docchk_id'].'">'.$val1['name'].' - ('.$val1['chklist_id'].')</option>';
				}
				$html .= '</select>';
			}else{
				//echo "890808";
			}
			
		}else{
			//echo "sdfhkshfkdsh";
		}
		echo $html;
	}
	
	public function actionGetAllDocumentCheckListHistory($chk_id){
		$html='';
		//echo '<pre>'; print_r($_GET); die;
		if($chk_id!=''){
			//echo '<pre>'; print_r($_POST); die;
			//$chk_id 		= $_POST['chk_id'];
			
			if($chk_id!=''){
				$html = '<select onchange="autoFillupDocDeta(this.value)" class="form-control" autocomplete="off" required="required" name="duplicate_doc_code" id="duplicate_doc_code"><option value="" selected="selected">--Select Document--</option>';
				$html='<option value="">--Select Version--</option>';
				if($chk_id == 'all'){
					//$sql="SELECT * FROM bo_infowizard_documentchklist WHERE is_docchklist_active='Y' AND FIND_IN_SET($doc_id,doc_id) ORDER BY name ASC";
					$sql="SELECT * FROM bo_infowizard_documentchklist d 
							INNER JOIN bo_infowizard_issuer_mapping as m ON m.issmap_id = d.issmap_id
							WHERE is_docchklist_active='Y' AND FIND_IN_SET($doc_id,doc_id) AND m.issuerby_id='$issued_by' ORDER BY name ASC";
				}else if($chk_id>0){
					$sql="SELECT * FROM bo_infowizard_documentchklist d 
							INNER JOIN cdn_dms_documents as c ON c.docchk_id = d.docchk_id
							WHERE c.docchk_id='$chk_id' AND c.is_document_active='Y' AND c.doc_status IN ('V','U')";
				}
				//echo $sql;
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				$services=$command->queryAll();
				foreach($services as $val1){ 
					$num = 10;
					if($num>5){
					$html .= '<option iuid="'.$val1['iuid'].'" id="opd-'.$val1['documents_id'].'" data-vf="'.$val1['valid_from'].'" data-vt="'.$val1['valid_to'].'" data-ref="'.$val1['document_reference_number'].'" href="'.$val1['document_name'].'" value="'.$val1['documents_id'].'">'.$val1['document_version_type'].$val1['document_version'].'</option>';
					}else{
						$html .= '<option iuid="'.$val1['iuid'].'" href="'.$val1['document_name'].'" value="'.$val1['documents_id'].'">'.$val1['document_version_type'].$val1['document_version'].'</option>';
					}
				}
				$html .= '</select>';
			}else{
				//echo "890808";
			}
			
		}else{
			//echo "sdfhkshfkdsh";
		}
		echo $html;
	}
	
	public function actionCheckDuplicateDoc(){
		@session_start();
		$user_id 	= $_SESSION['RESPONSE']['user_id'];
		$iuid 		= $_SESSION['RESPONSE']['iuid'];
		$doc_id 	= $_POST['dms_doc_id'];
		$mv 		= @$_POST['mv'];
		
		if($iuid>0){
			$sql="SELECT * FROM cdn_dms_documents WHERE docchk_id='$doc_id' AND iuid='$iuid' AND is_document_active='R'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$doc_ver=$command->queryAll();
			if(count($doc_ver)>0){
				$return_msg['response_code']='200';
				$return_msg['response']='FAILED';
				$return_msg['response_msg']='Document already uploaded. Please delete the existing uploaded document to upload again.';
			}else if(count($doc_ver) == 0){
				$sql="SELECT * FROM cdn_dms_documents WHERE docchk_id='$doc_id' AND iuid='$iuid' AND is_document_active='Y'";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				$num=rand(2,8);
				$doc_ver=$command->queryAll();
				if(count($doc_ver)>0){
					//$mv=$num>=6?'Y':'N';
					$return_msg['response_code']='200';
					if($mv == 'Y'){
						$return_msg['response']='SUCCESS';
						$return_msg['response_msg']='UPLOAD KAR SAKTE HO....';//'Document already uploaded in your documents list.';
					}else{
						$return_msg['response']='FAILED';
						$return_msg['response_msg']='Document already uploaded in your documents list.';
					}
					
				}else{
					$return_msg['response_code']='200';
					$return_msg['response']='SUCCESS';
					$return_msg['response_msg']='UPLOAD KAR SAKTE HO....';
				}
			}
		}else{
			$return_msg['response_code']='200';
			$return_msg['response']='FAILED';
			$return_msg['response_msg']='INVALID LOGIN';
		}
		
		/*$result = $this->GetDocVersion($doc_id,$iuid);
		if($result > 1){
			echo "duplicate";
		}else{
			echo "new";
		}*/
		header('STATUS: 200 Ok',true,200);				
		echo json_encode($return_msg);
	}
	
	
	
	private function actionCheckDocCheckListID(){
		$doc_id 	= $_POST['doc_id'];
		$issuer_id 	= $_POST['issuer_id'];
		$issued_by 	= $_POST['issued_by'];
					
		echo $this->GetDocCheckID($doc_id,$issuer_id,$issuerby);
	}
	
	public function actionActivateAllDocuments(){
		@session_start();
		$user_id 	= $_SESSION['RESPONSE']['user_id'];
		$iuid 		= $_SESSION['RESPONSE']['iuid'];
		$msg = 'Error: Please try again.';
		if($iuid>0){
			if(isset($_POST['flag'])){
				$sql="UPDATE cdn_dms_documents SET is_document_active='Y' WHERE iuid='$iuid' AND user_id='$user_id' AND is_document_active='R'";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				if($command->query()){
					$msg = 'success';
				}
			}
		}
		echo $msg;
	}
	
	private function GetDocCheckID($docchk_id){
		$doc_chk=false;
		
		$sql="SELECT d.docchk_id,d.chklist_id,d.name FROM bo_infowizard_documentchklist as d WHERE d.docchk_id='$docchk_id' AND d.is_docchklist_active='Y' ORDER BY d.docchk_id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$doc_chk=$command->queryRow();
		if(count($doc_chk)>0){
			return $doc_chk;
		}
				
		return $doc_chk;
	}
	private function GetDocVersion($docchk_id,$iuid,$document_version_type='V'){
		$document_version = "1.0";
		
		$sql="SELECT document_version FROM cdn_dms_documents WHERE docchk_id='$docchk_id' AND iuid='$iuid' AND document_version_type='$document_version_type' ORDER BY documents_id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$doc_ver=$command->queryRow();
		if(count($doc_ver)==1){
			$c_version = $doc_ver['document_version'];
			if($c_version>0){
				$document_version = $c_version + 0.1;
			}
		}
				
		return $document_version;
	}
	public function actionCheckDocumentMultiversion(){
		
		$document_multiple_version_allowed=true;
		$sql = "SELECT * FROM cdn_dms_documents WHERE docchk='$doc_chk' AND iuid='$iuid' AND document_file_name='$name'";
		$connection = Yii::app()->db();
		
	}
	
	public function actionGetDocumentLogs(){
		@extract($_POST);
		if($document_id){
			$sql="SELECT *,dms_map.status as c_status FROM bo_application_dms_documents_mapping as dms_map
LEFT JOIN bo_application_dms_documents_mapping_logs as dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
INNER JOIN bo_departments as d ON d.dept_id=dms_map.dept_id
WHERE dms_map.documents_id='$document_id'
";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$doc_ver=$command->queryAll();
			if(count($doc_ver)>0){
				echo '<table class="table table-striped table-bordered" width="100%"><thead><th>S.No</th><th>Department Name</th><th>Used Date</th><th>Status</th><th>Verified On</th><th>Verifier Comment</th></thead>';
				$i=1;
				foreach($doc_ver as $doc_arr){
					if($doc_arr['c_status'] == 'V' && $doc_arr['verifier_comments']==''){
						$comments = "Verified";
					}else{
						$comments = $doc_arr['verifier_comments'];
					}
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $doc_arr['department_name']; ?></td>
						<td><?php echo $doc_arr['created_on']; ?></td>
						<td><?php echo $doc_arr['c_status']; ?></td>
						<td><?php echo $doc_arr['created_time']; ?></td>
						<td><?php echo $comments; ?></td>
					</tr>
					<?php
					$i++;
				}
				echo '</table>';
				exit;
			}
		}
		echo "No records Found";
	}
	
	
	public function actionSubmitDoc()
	{	
		@session_start();
		
		/* echo '<pre>'; print_r($_POST); die;   */
		if(isset($_GET['investor_user_id']) && isset($_GET['investor_iuid'])){
			$user_id = $_GET['investor_user_id'];
			$iuid 	=  $_GET['investor_iuid'];
		}else if(isset($_POST['FileUpload']['investor_user_id'])){				
			$user_id = $_POST['FileUpload']['investor_user_id'];
			$iuid 	=  $_POST['FileUpload']['investor_iuid'];
		}	
		
		if(isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
			$msg='1';
			
			$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
			
			/* echo '<pre>'; print_r($_POST); die; */
			if(!isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
		
			//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
			if($YII_CSRF_TOKEN2 != $_POST['FileUpload']['YII_CSRF_TOKEN']){
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
			
			//echo '<pre>'; print_r($_POST); die;
			if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['name'])){
				$file_name = strtolower($_FILES['dms_doc_uploads']['name']);
				$file_size = $_FILES['dms_doc_uploads']['size']/1000;
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				//$allowed_ext = array('jpg','jpeg','bmp','png','pdf','doc','docx','xls','xlsx');
				$allowed_ext = array('pdf');
				
				if(!in_array($ext,$allowed_ext)){
					echo $msg = "This file type not allowed. Please upload correct file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				//die($ext);
				if($file_size>25000){
					echo $msg = "Maximum file size allowed is 25MB. Please upload upto 25MB file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				
				$path = Yii::app()->basePath."/../../themes/backend/mydoc/".$iuid."/";
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				
				/* print_r($_POST);
				die("dsdsf"); */
				$service_id = @$_POST['FileUpload']['service_id'];
				$doc_id 	= @$_POST['FileUpload']['doc_id'];
				$issuer_id 	= @$_POST['FileUpload']['issuer_id'];
				$issued_by 	= @$_POST['FileUpload']['issued_by'];
				$docchk_id 	= @$_POST['FileUpload']['doc_code'];
				$doc_version_type 	= @$_POST['FileUpload']['doc_version_type'];
				$document_reference_number 	= @$_POST['FileUpload']['document_reference_number'];
				$valid_from 	= @$_POST['FileUpload']['valid_from'];
				$valid_to 	= @$_POST['FileUpload']['valid_to'];
				$comments 	= @$_POST['FileUpload']['comments'];
				$my_doc_status='Y';
				if(isset($_POST['FileUpload']['mydoc_status']) && $_POST['FileUpload']['mydoc_status']=='active'){
					$my_doc_status='Y';
				}
				$doc_chk_arr = $this->GetDocCheckID($docchk_id);
				if($doc_chk_arr == false){
					// Yii::app()->user->setFlash('error', "Document not matched with issuer and issued by.");
					$msg = "Document not matched with issuer and issued by.";
				}else{
					$chklist_id = $doc_chk_arr['chklist_id'];
					$docchk_id = $doc_chk_arr['docchk_id'];
					$name 		= $doc_chk_arr['name'];
					$version = $this->GetDocVersion($docchk_id,$iuid,$doc_version_type);
					$doc_ref_number = $iuid."_".$chklist_id."_".$doc_version_type.$version;
					$new_name = $doc_ref_number.".".$ext;
					move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path.$new_name);
						
					$issuer_id = $issuer_id == 'all'?1:$issuer_id;
					$model = new DmsDocuments;
					$model->docchk_id = $docchk_id;
					$model->doc_type_id = @$doc_id;
					$model->issuer_id = $issuer_id;
					$model->issued_by_id = $issued_by;
					$model->iuid = $iuid;
					$model->user_id = $user_id;
					$model->doc_ref_number = $doc_ref_number;
					$model->document_name = $new_name;
					$model->document_version = $version;
					$model->document_version_type = $doc_version_type;
					$model->doc_status = 'U';
					$model->is_document_active=$my_doc_status;
					$model->document_reference_number=$document_reference_number;
					$model->valid_from=$valid_from;
					$model->valid_to=$valid_to;
					$model->valid_to=$valid_to;
					$model->comments=$comments;
					$model->created_on=date('Y-m-d H:i:s');
					if($model->save()){
						$new_documents_id = $model->documents_id;
						if(isset($_POST['FileUpload']['documents_id'])){
							// Update previous
							$documents_id = $_POST['FileUpload']['documents_id'];
							$modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
							$modelUp->is_uploaded = 'Y';
							$modelUp->save();
							
							$rejSql="SELECT * FROM bo_application_dms_documents_mapping WHERE user_id='$user_id' AND iuid='$iuid' AND documents_id='$documents_id' AND is_uploaded_flag='0'";
							$connection=Yii::app()->db; 
							$command=$connection->createCommand($rejSql);
							$rej_documents_array = $command->queryAll();
							
							if(!empty($rej_documents_array)){
								foreach($rej_documents_array as $rej_arr){
									$sno = $rej_arr['sno'];
									$dept_id = $rej_arr['dept_id'];
									$mapping_id = $rej_arr['mapping_id'];
									
									
									$this->insertDMSUsedDocs($iuid,$user_id,$sno,$dept_id,$new_documents_id,$new_name);
									
									// Update previous
									$modelUpM = ApplicationDmsDocumentsMapping::model()->findByPk($mapping_id); //$this->loadModel($documents_id);
									$modelUpM->is_uploaded_flag = '1';
									$modelUpM->save();
								}
							}
							
						}
						
						Yii::app()->user->setFlash('success', "Your document uploaded successfully.");
						if(isset($_GET['approval']) && !empty($_GET['approval']))
						{
							//$msg = "success"."-".$new_documents_id."-".$doc_ref_number;
							$service_id	= $_POST['FileUpload']['service_id'];
							$msg ='success'.",".$service_id.",".'<select name="approvaldata['.$service_id.'][document_id]" id="document_id" style="width:200px;" class="form-control">
								<option value="'.$new_documents_id.'" >'.$doc_ref_number.'</option>
							</select>';
							
						}else{
							$msg = "success";
						}
					}else{
						$errStr='';
						foreach($model->getErrors() as $ekey=>$eArr){
							$errStr .= implode(",",$eArr);
						}
						//echo '<pre>';print_r($model->getErrors());exit;
						//Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
						if($errStr==''){
							$msg = "Error: Please contact support team. <br>";
						}else{
							$msg = $errStr;
						}
						
					}
						
				}
			}else{
				$msg = "Error: Please contact support team...";
			}
			if($msg!=''){
				if(isset($_GET['approval']) && !empty($_GET['approval']))
				{
					echo $msg;
				}else{	
					echo $msg;
				}
			}
			exit;
		}
		
		// Get all uploaded list of documents by Investors which are ready to submit
			$sql="SELECT * FROM cdn_dms_documents as dms,bo_infowizard_documentchklist as info WHERE dms.is_document_active='R' AND dms.iuid='$iuid' AND dms.docchk_id=info.docchk_id AND info.is_docchklist_active='Y' ORDER BY dms.documents_id DESC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$documents_array = $command->queryAll();
			//$documents_array = 1;
		// END
		
		$this->render('dms_form',array('documents_data'=>$documents_array));
	}
	
	public function actionSubmitDoc2()
	{
		@session_start();
		
        $user_id = $_SESSION['investor_id']=$_GET['investor_user_id'];
		$iuid 	= $_SESSION['investor_iuid']=$_GET['investor_iuid'];
				
		if(isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
			$msg='1';
			//echo '<pre>'; print_r($_POST); die;
			$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
			if(!isset($_POST['FileUpload']['YII_CSRF_TOKEN'])){
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
			
			if($YII_CSRF_TOKEN2 != $_POST['FileUpload']['YII_CSRF_TOKEN']){
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
			//echo '<pre>'; print_r($_POST); die;
			if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['name'])){
				$file_name = strtolower($_FILES['dms_doc_uploads']['name']);
				$file_size = $_FILES['dms_doc_uploads']['size']/1000;
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				//$allowed_ext = array('jpg','jpeg','bmp','png','pdf','doc','docx','xls','xlsx');
				$allowed_ext = array('pdf');
				if(!in_array($ext,$allowed_ext)){
					echo $msg = "This file type not allowed. Please upload correct file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				if($file_size>25000){
					echo $msg = "Maximum file size allowed is 25MB. Please upload upto 25MB file.";
					//Yii::app()->user->setFlash('error', $msg);
					exit;
				}
				
					$path = Yii::app()->basePath."/../../themes/backend/mydoc/".$iuid."/";
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					
					$doc_id 	= $_POST['FileUpload']['doc_id'];
					$issuer_id 	= $_POST['FileUpload']['issuer_id'];
					$issued_by 	= $_POST['FileUpload']['issued_by'];
					$docchk_id 	= $_POST['FileUpload']['doc_code'];
					$doc_version_type 	= $_POST['FileUpload']['doc_version_type'];
					$document_reference_number 	= $_POST['FileUpload']['document_reference_number'];
					$valid_from 	= date('Y-m-d',strtotime($_POST['FileUpload']['valid_from']));
					$valid_to 	= date('Y-m-d',strtotime($_POST['FileUpload']['valid_to']));
					$comments 	= $_POST['FileUpload']['comments'];
					$my_doc_status='R';
					if(isset($_POST['FileUpload']['mydoc_status']) && $_POST['FileUpload']['mydoc_status']=='active'){
						$my_doc_status='Y';
					}
					$doc_chk_arr = $this->GetDocCheckID($docchk_id);
					if($doc_chk_arr == false){
						// Yii::app()->user->setFlash('error', "Document not matched with issuer and issued by.");
						$msg = "Document not matched with issuer and issued by.";
					}else{
						$chklist_id = $doc_chk_arr['chklist_id'];
						$docchk_id = $doc_chk_arr['docchk_id'];
						$name 		= $doc_chk_arr['name'];
						$version = $this->GetDocVersion($docchk_id,$iuid,$doc_version_type);
						$doc_ref_number = $iuid."_".$chklist_id."_".$doc_version_type.$version;
						$new_name = $doc_ref_number.".".$ext;
						move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path.$new_name);
							
						$issuer_id = $issuer_id == 'all'?1:$issuer_id;
						$model = new DmsDocuments;
						$model->docchk_id = $docchk_id;
						$model->doc_type_id = $doc_id;
						$model->issuer_id = $issuer_id;
						$model->issued_by_id = $issued_by;
						$model->iuid = $iuid;
						$model->user_id = $user_id;
						$model->doc_ref_number = $doc_ref_number;
						$model->document_name = $new_name;
						$model->document_version = $version;
						$model->document_version_type = $doc_version_type;
						$model->doc_status = 'U';
						$model->is_document_active='Y';
						$model->document_reference_number=$document_reference_number;
						$model->valid_from=$valid_from;
						$model->valid_to=$valid_to;
						$model->valid_to=$valid_to;
						$model->comments=$comments;
						$model->created_on=date('Y-m-d H:i:s');
						if($model->save()){
							$new_documents_id = $model->documents_id;
							if(isset($_POST['FileUpload']['documents_id'])){
								// Update previous
								$documents_id = $_POST['FileUpload']['documents_id'];
								$modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
								$modelUp->is_uploaded = 'Y';
								$modelUp->save();
								
								$rejSql="SELECT * FROM bo_application_dms_documents_mapping WHERE user_id='$user_id' AND iuid='$iuid' AND documents_id='$documents_id' AND is_uploaded_flag='0'";
								$connection=Yii::app()->db; 
								$command=$connection->createCommand($rejSql);
								$rej_documents_array = $command->queryAll();
								if(!empty($rej_documents_array)){
									foreach($rej_documents_array as $rej_arr){
										$sno = $rej_arr['sno'];
										$dept_id = $rej_arr['dept_id'];
										$mapping_id = $rej_arr['mapping_id'];
										
										
										$this->insertDMSUsedDocs($iuid,$user_id,$sno,$dept_id,$new_documents_id,$new_name);
										
										// Update previous
										$modelUpM = ApplicationDmsDocumentsMapping::model()->findByPk($mapping_id); //$this->loadModel($documents_id);
										$modelUpM->is_uploaded_flag = '1';
										$modelUpM->save();
									}
								}
								
							}
							
							Yii::app()->user->setFlash('success', "Your document uploaded successfully.");
							$msg = "success";
						}else{
							$errStr='';
							foreach($model->getErrors() as $ekey=>$eArr){
								$errStr .= implode(",",$eArr);
							}
							//echo '<pre>';print_r($model->getErrors());exit;
							//Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
							if($errStr==''){
								$msg = "Error: Please contact support team. <br>";
							}else{
								$msg = $errStr;
							}
							
						}
							
					}
					
				
			}else{
				$msg = "Error: Please contact support team...";
			}
			if($msg!=''){
				echo $msg;
			}
			exit;
		}
		
		// Get all uploaded list of documents by Investors which are ready to submit
			$sql="SELECT * FROM cdn_dms_documents as dms,bo_infowizard_documentchklist as info WHERE dms.is_document_active='R' AND dms.iuid='$iuid' AND dms.docchk_id=info.docchk_id AND info.is_docchklist_active='Y' ORDER BY dms.documents_id DESC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$documents_array = $command->queryAll();
			//$documents_array = 1;
                        //
                         $dataToSend=$_GET;   
                         //$doc_id='166';
                       // Get all uploaded list of documents by Investors which are ready to submit
			$sql="select * from bo_infowizard_documentchklist where docchk_id='$dataToSend[doc_code]'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$docDetail = $command->queryRow();
			//$documents_array = 1;
		// END
                //  $dataToSend=$_GET;   
		$dataToSend['documents_data']=$documents_array;
		$dataToSend['docDetail']=$docDetail;
		//$dataToSend['lastUrl']=$_SERVER['HTTP_REFERER'];
		$this->renderPartial('dms_form',$dataToSend);
	}

/*
* By:- Aamir
*/
	public function actionDocumentdownload($subID){
		$srn_no = base64_decode($subID);
		$documents = Yii::app()->db->createCommand("SELECT dc.name, dm.doc_id, dm.created_on, dm.status, dm.iuid, dm.document_file_name, dm.usercomment, dm.mapping_id
		 FROM bo_application_dms_documents_mapping dm
			INNER JOIN bo_infowizard_documentchklist dc on dc.docchk_id=dm.doc_id
			WHERE sno=$srn_no AND dm.status='V' ")->queryAll(); 
		$app_details = Yii::app()->db->createCommand("SELECT bosp.core_service_name FROM bo_new_application_submission as a
INNER JOIN bo_information_wizard_service_parameters bosp
ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
INNER JOIN bo_information_wizard_service_master as sm
ON sm.id = bosp.service_id
where  bosp.is_active='Y'         
AND a.submission_id=$srn_no")->queryRow(); 

		$this->render('view',['srn_no'=>$srn_no,'documents'=>$documents,'app_details'=>$app_details]);
	}

	public function actionPreviewdoc($doc_map_id){

		$document = Yii::app()->db->createCommand("SELECT  dm.sno, dc.name, dm.document_file_name
		 FROM bo_application_dms_documents_mapping dm		
		 INNER JOIN bo_infowizard_documentchklist dc on dc.docchk_id=dm.doc_id
			WHERE mapping_id=$doc_map_id")->queryRow(); 
		
		if($document)
		 Documentpdf::generatePdf($document);
		else
			throw new Exception("No data found for this document", 1);
			
	}
}