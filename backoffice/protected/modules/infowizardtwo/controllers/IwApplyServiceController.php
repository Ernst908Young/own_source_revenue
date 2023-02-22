<?php
class IwApplyServiceController extends Controller
{

	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(	
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','lmIndex','documentsChecklist','view','getUser','lmInspectionUpload','getiuid','listLmReport','lmApprovalCertificateUpload','listLmApprovalCertificate'),
				'expression'=>'RolesExt::isIwDataEntry()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} 

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{	
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		// if(!$_SESSION['LOGGED_IN'])
		// 	$this->redirect(SSO_URL1);

		$get_investor = "SELECT user_id,iuid FROM sso_users where is_account_active='Y' order by user_id desc";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();



		if(isset($_GET['type']) && $_GET['type'] != ''){
			$type = $_GET['type'];				
		}else{
			$type = '';
			$where = '';
		} 
		if(isset($_GET['userid']) && $_GET['userid'] != ''){
			$user_id = $_GET['userid'];				
		}
		else{
			$user_id=null;
		}
		// Get department list from IW
		$base=Yii::app()->theme->baseUrl;
		//$sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
		$sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
                        . "  LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id  "
                        . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND istm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryAll();
		
		// get caf if any bo_application_submission

		
		// Get all services list
		$res_s=false;
		$id=false;
		$res_caf ='';
		$iuid_val='';
		if(isset($_GET['userid']) && $_GET['userid']>0){
					$sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id IN ('1','11') ORDER BY submission_id ASC"; 
				        $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND (
				((application_status='A') AND (application_id IN ('1','11'))) OR ((application_status='P') AND (application_id IN ('11'))
				)) ORDER BY submission_id ASC	"; //added to show existting app with pending status also
                
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_caf);
		$res_caf = $command->queryAll();



			$id='1';
			$sql_s="SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
                                   LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
			  
				  WHERE sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y'  AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryAll();

					$get_investor_iuid = "SELECT iuid FROM sso_users where user_id='$user_id' && is_account_active='Y'";
					$connection = Yii::app()->db; 
					$command = $connection->createCommand($get_investor_iuid);
					$iuid_val = $command->queryRow();



		}
		
		$this->render("index",array('res_d'=>$res_d,'res_s'=>$res_s,'id'=>$id,'user_id'=>$user_id,'type'=>$type,
						'investor_list'=>$investor_list,
						'res_caf'=>$res_caf,
						'user_iuid'=>$iuid_val));
		//$this->render('index');
	}
	
	
	public function actionLmIndex()
	{	
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		// if(!$_SESSION['LOGGED_IN'])
		// 	$this->redirect(SSO_URL1);

		$get_investor = "SELECT user_id,iuid FROM sso_users where is_account_active='Y' order by user_id desc";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();



		if(isset($_GET['type']) && $_GET['type'] != ''){
			$type = $_GET['type'];				
		}else{
			$type = '';
			$where = '';
		} 
		if(isset($_GET['userid']) && $_GET['userid'] != ''){
			$user_id = $_GET['userid'];				
		}
		else{
			$user_id=null;
		}
		// Get department list from IW
		$base=Yii::app()->theme->baseUrl;
		
		$sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
                        . "  LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id  "
                        . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND istm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryAll();
		//print_r($res_d);die;
		// get caf if any bo_application_submission

		
		// Get all services list
		$res_s=false;
		$id=false;
		$res_caf ='';
		$iuid_val='';
		if(isset($_GET['userid']) && $_GET['userid']>0)
		{
			
			$sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND (
			((application_status='A') AND (application_id IN ('1','11'))) OR ((application_status='P') AND (application_id IN ('11'))
			)) ORDER BY submission_id ASC"; //added to show existting app with pending status also

			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_caf);
			$res_caf = $command->queryAll();



			$id=$_GET['id'];
			$sql_s="SELECT * FROM bo_information_wizard_service_master as sm  
			INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
					   LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice

			WHERE sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y'  AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryAll();

			$get_investor_iuid = "SELECT iuid FROM sso_users where user_id='$user_id' && is_account_active='Y'";
			$connection = Yii::app()->db; 
			$command = $connection->createCommand($get_investor_iuid);
			$iuid_val = $command->queryRow();
		}
		
		
		$this->render("lm_index",array('res_d'=>$res_d,'res_s'=>$res_s,'id'=>$id,'user_id'=>$user_id,'type'=>$type,'investor_list'=>$investor_list,'res_caf'=>$res_caf,'user_iuid'=>$iuid_val));
		//$this->render('index');
	}



	public function actionDocumentsChecklist(){
		@session_start();	
		
		$user_id = $_REQUEST['user_id'];
		$iuid 	= $_REQUEST['iuid'];
		
		// Start Upload DMS Data
		if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['tmp_name'])){
			//echo '<pre>'; print_r($_POST); die;
			$file_name = strtolower($_FILES['dms_doc_uploads']['name']);
			$file_size = $_FILES['dms_doc_uploads']['size']/1000;
			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$allowed_ext = array('pdf');
			if(!in_array($ext,$allowed_ext)){
				echo $msg = "This file type not allowed. Please upload correct file.";
				exit;
			}
			if($file_size>25000){
				echo $msg = "Maximum file size allowed is 25MB. Please upload upto 25MB file.";
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
			//echo $docchk_id."---";die;
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
				$model->is_document_active=$my_doc_status;
				$model->created_on=date('Y-m-d H:i:s');
				
				if($model->save()){
					if(isset($_POST['FileUpload']['documents_id'])){
						// Update previous
						$documents_id = $_POST['FileUpload']['documents_id'];
						$modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
						$modelUp->is_uploaded = 'Y';
						$modelUp->save();
				
					}
					
					Yii::app()->user->setFlash('success', "Your document uploaded successfully.");
					$msg = "success";
				}else{
					echo '<pre>';print_r($model);die;
					//Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
					$msg = "Error: Please contact support team.";
				}
					
			}
			$this->refresh();
			exit();
		}
		
		
		@extract($_GET);
		$sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' AND is_active='Y' ORDER BY id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_s = $command->queryRow();
		/* echo '<pre>'; print_r($res_s);die; */
		$document_checklist_creation = $res_s['document_checklist_creation'];
		$mapped_documents_array 	= json_decode($document_checklist_creation,true);
		
		$document_type_mapping 	= $res_s['document_type_mapping'];
		$document_type_mapping_array = json_decode($document_type_mapping,true);
		//echo '<pre>';print_r($document_type_mapping_array); die;
		$this->render("document_check_list",array('mapped_documents_array'=>$mapped_documents_array,'iuid'=>$iuid,'document_type_mapping_array'=>$document_type_mapping_array,'user_id'=>$user_id));
	}

	/* public function actionGetUser()
	{	
		$userid=$_GET['userid'];
		$get_investor = "SELECT user_id,iuid FROM sso_users where iuid like'%".$userid."%' and is_account_active='Y' order by user_id desc limit 10";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();

		if ($investor_list) 
		{
			foreach ($investor_list as $showuser)
			 { 
				echo '<option value="'.$showuser['user_id'].'">'.$showuser['iuid'].'</option>';
			 } 
		}
	} */
	public function actionGetUser()
	{	
		$userid=$_GET['userid'];
		$get_investor = "SELECT user_id,iuid FROM sso_users where iuid like '%".$userid."%' and is_account_active='Y' order by user_id desc limit 10";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();

		if ($investor_list) 
		{
			foreach ($investor_list as $showuser)
			{ 			
				echo "<li><a href='/backoffice/infowizard/IwApplyService/index/userid/".$showuser["user_id"]."/type/INC'>".$showuser['iuid']."</a></li>";
			} 
		}

	}
	
	public function actionGetUserLM()
	{	
		$userid=$_GET['userid'];
		$get_investor = "SELECT user_id,iuid FROM sso_users where iuid like '%".$userid."%' and is_account_active='Y' order by user_id desc limit 10";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();

		if ($investor_list) 
		{
			foreach ($investor_list as $showuser)
			{ 			
				echo "<li><a href='/backoffice/infowizard/IwApplyService/lmIndex/userid/".$showuser["user_id"]."/is/no/type/POS/id/94'>".$showuser['iuid']."</a></li>";
			} 
		}

	}
	
	public function actionGetiuid()
	{	
		$userid = $_GET['userid'];
		$get_investor = "SELECT user_id,iuid FROM sso_users where iuid like '%".$userid."%' and is_account_active='Y' order by user_id desc limit 10";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($get_investor);
		$investor_list = $command->queryAll();
		
		if ($investor_list) 
		{
			foreach ($investor_list as $showuser)
			{ 			
				echo "<li class='iuidselect'><a href='/backoffice/infowizard/iwApplyService/lmInspectionUpload/user_id/".$showuser["user_id"]."'>".$showuser['iuid']."</a></li>";
			} 
		}

	}
	
	public function actionLmInspectionUpload()
	{
		@session_start();	
		//die("sdfsfsdfsdfdsf");
		$model = new LmInspection;
		
		
		if(isset($_POST['yt0']) && !empty($_POST['yt0']) && !empty($_POST['LmInspection'])){
		
			$new_name ="";
			if(isset($_FILES['LmInspection']) && !empty($_FILES['LmInspection'])){
				$file_name = strtolower($_FILES['LmInspection']['name']['inspection_report']);
				$file_size = $_FILES['LmInspection']['size']['inspection_report']/1000;
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			
				$path = "/var/www/html/themes/backend/lm_inspection/";				
				$new_name = $_POST['LmInspection']['iuid'].'_'.time().".".$ext;
				move_uploaded_file($_FILES['LmInspection']['tmp_name']['inspection_report'], $path.$new_name);
			}
			$model->attributes = $_POST['LmInspection'];
			$model->inspection_report = $new_name;			
			$model->iuid = $_POST['LmInspection']['iuid'];
			$model->service_id = $_POST['LmInspection']['service_id'];
            $model->firm_name = $_POST['LmInspection']['firm_name'];
            $model->service_type = $_POST['LmInspection']['service_type'];
            $model->district_id = $_POST['LmInspection']['district_id'];
            $model->licence_number = $_POST['LmInspection']['licence_number'];
            $model->inspector_name = $_POST['LmInspection']['inspector_name'];
            $model->last_inspection_date = $_POST['LmInspection']['last_inspection_date'];
			
			if(!empty($_POST['LmInspection']['inspection_commence']))
            $model->inspection_commence = implode(",",$_POST['LmInspection']['inspection_commence']);
		
			$model->created=date('Y-m-d H:i:s');
            /*  print_r($model);
			die; */
          
			if($model->save()){				
				Yii::app()->user->setFlash('success', "Inspection Report uploaded successfully.");
				$this->redirect(array('/infowizard/iwApplyService/lmInspectionUpload'));
			}else{
				Yii::app()->user->setFlash('success', "Please enter errors fields value");
				//echo '<pre>';print_r($model->getErrors());die;
			}
			/* $this->refresh();
			exit;	 */
		}
		
		$sqlse = "SELECT CONCAT(service_id,'.',	servicetype_additionalsubservice) as service_id,core_service_name FROM `bo_information_wizard_service_parameters` WHERE `department_id` = '26' AND `is_active` = 'Y'";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($sqlse);
		$serArr = $command->queryAll();
		$serviceArr = array();
		$serviceArr[0] = '--Select Service--';
		foreach($serArr  as $key=>$val)
		{
			$serviceArr[$val['service_id']] = $val['core_service_name'];
		}	
		/* echo "<pre>";
		print_r($serviceArr);die; */
		$distArr = InfowizardQuestionMasterExt::getMasterList('bo_district','district_id','distric_name','is_active','Y');  
	
		$this->render("lm_inspection_form",array('model'=>$model,'distArr'=>$distArr,'serviceArr'=>$serviceArr));
	}

	public function actionListLmReport()
	{
		@session_start();
		$sqlse = "SELECT lmir.*,sso_users.email,sso_users.iuid,sso_profiles.first_name,sso_profiles.last_name,bo_district.distric_name,infowizsp.core_service_name FROM bo_lm_inspection_report as lmir 
		LEFT JOIN  bo_information_wizard_service_parameters as infowizsp ON lmir.service_id = CONCAT(infowizsp.service_id,'.',	infowizsp.servicetype_additionalsubservice) AND infowizsp.is_active='Y'
		LEFT JOIN sso_users ON sso_users.iuid=lmir.iuid 
		LEFT JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id 
		LEFT JOIN bo_district ON bo_district.district_id = lmir.district_id  
		WHERE lmir.is_active = 'Y'";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($sqlse);
		$LmListArr = $command->queryAll();
		/* echo "<pre>";
		print_r($LmListArr);die; */
		$this->render('list_lm_report',array('LmListArr' => $LmListArr));		
	}	
	
	public function actionLmApprovalCertificateUpload()
	{
		@session_start();	
		
		$model = new LmApprovalCertificate;
		
		if(isset($_POST['yt0']) && !empty($_POST['yt0']) && !empty($_POST['LmApprovalCertificate'])){		
			$new_name ="";
			if(isset($_FILES['LmApprovalCertificate']) && !empty($_FILES['LmApprovalCertificate'])){
				$file_name = strtolower($_FILES['LmApprovalCertificate']['name']['approval_certificate']);
				$file_size = $_FILES['LmApprovalCertificate']['size']['approval_certificate']/1000;
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			
				$path = "/var/www/html/themes/backend/lm_approval_certificate/";				
				$new_name = $_POST['LmApprovalCertificate']['iuid'].'_'.time().".".$ext;
				move_uploaded_file($_FILES['LmApprovalCertificate']['tmp_name']['approval_certificate'], $path.$new_name);
			}
			
			$model->approval_certificate = $new_name;			
			$model->iuid = $_POST['LmApprovalCertificate']['iuid'];
			$model->service_id = $_POST['LmApprovalCertificate']['service_id'];
			$model->licencee_name = $_POST['LmApprovalCertificate']['licencee_name'];
            $model->firm_name = $_POST['LmApprovalCertificate']['firm_name'];
            $model->firm_address = $_POST['LmApprovalCertificate']['firm_address'];
            $model->service_type = $_POST['LmApprovalCertificate']['service_type'];
            $model->district_id = $_POST['LmApprovalCertificate']['district_id'];
            $model->licence_number = $_POST['LmApprovalCertificate']['licence_number'];
            $model->inspector_name = $_POST['LmApprovalCertificate']['inspector_name'];
            $model->licence_valid_from = $_POST['LmApprovalCertificate']['licence_valid_from'];
            $model->licence_valid_to = $_POST['LmApprovalCertificate']['licence_valid_to'];
            $model->date_of_licence_issue = $_POST['LmApprovalCertificate']['date_of_licence_issue'];
			$model->created=date('Y-m-d H:i:s');
            /*  print_r($model);
			die; */
          
			if($model->save()){				
				Yii::app()->user->setFlash('success', "Approval Certificate Report uploaded successfully.");
				$this->redirect(array('/infowizard/iwApplyService/lmApprovalCertificateUpload'));
			}else{
				Yii::app()->user->setFlash('success', "Error: Please contact support team.");
				//echo '<pre>';print_r($model->getErrors());die;
			}
			/* $this->refresh();
			exit;	 */
		}	
		
		$sqlse = "SELECT CONCAT(service_id,'.',	servicetype_additionalsubservice) as service_id,core_service_name FROM `bo_information_wizard_service_parameters` WHERE `department_id` = '26' AND `is_active` = 'Y'";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($sqlse);
		$serArr = $command->queryAll();
		$serviceArr = array();
		$serviceArr[0] = '--Select Service--';
		foreach($serArr  as $key=>$val)
		{
			$serviceArr[$val['service_id']] = $val['core_service_name'];
		}	
		/* echo "<pre>";
		print_r($serviceArr);die; */
		$distArr = InfowizardQuestionMasterExt::getMasterList('bo_district','district_id','distric_name','is_active','Y');  
	
		$this->render("lm_approval_certificate_form",array('model'=>$model,'distArr'=>$distArr,'serviceArr'=>$serviceArr));
	}	
	
	public function actionListLmApprovalCertificate()
	{
		@session_start();
		$sqlse = "SELECT lmir.*,sso_users.email,sso_users.iuid,sso_profiles.first_name,sso_profiles.last_name,bo_district.distric_name,infowizsp.core_service_name FROM bo_lm_approval_certificate as lmir 
		LEFT JOIN  bo_information_wizard_service_parameters as infowizsp ON lmir.service_id = CONCAT(infowizsp.service_id,'.',	infowizsp.servicetype_additionalsubservice) AND infowizsp.is_active='Y'
		LEFT JOIN sso_users ON sso_users.iuid=lmir.iuid 
		LEFT JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id 
		LEFT JOIN bo_district ON bo_district.district_id = lmir.district_id  
		WHERE lmir.is_active = 'Y'";
		$connection = Yii::app()->db; 
		$command = $connection->createCommand($sqlse);
		$LmListArr = $command->queryAll();
		/* echo "<pre>";
		print_r($LmListArr);die; */
		$this->render('list_lm_approval_certificate',array('LmListArr' => $LmListArr));		
	}	
}