<?php
class SubFormNoticeofChangeofManagerForm6PartialController extends Controller {

	

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
	
	public function actionSaveDataPartial() {
        if(!empty($_POST)) 
		{
			/* echo "<pre>";
			print_r($_POST);
			die();  */
            $serviceID = $_POST['service_id'];            
            $issuer_id = $_POST['issuer_id'];
            $applicationExt = New ApplicationExt;
            $serviceArr = $applicationExt->getServiceNameById($serviceID);
            $service_Name = $serviceArr['core_service_name'];
					
			
			if(isset($_POST['submission_id']) && !empty($_POST['submission_id'])){				
				$sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $_POST['submission_id']."'";        
				$model = NewApplicationSubmission::model()->findBySql($sql);				
				$submission_id = $_POST['submission_id'];	
				if(!empty($model))
				{
					$model->application_updated_date_time = date('Y-m-d H:i:s');
				}	
			}
			if(!isset($_POST['submission_id']) && empty($_POST['submission_id'])){				
				$model = new NewApplicationSubmission();
				$model->application_created_date = date('Y-m-d H:i:s');
			}
			
			$model->processing_level = 'District';			
            $processLevel = $model->processing_level;
			
			$allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();
            //print_r($allData);die;
			$allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_new_application_submission' AND is_active='Y'")->queryAll();
          
			$getDepartMentId = Yii::app()->db->createCommand("SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_infowizard_issuerby_master.service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id=$issuer_id")->queryRow();
			
            if(isset($allRes) && !empty($allRes)) 
			{
                foreach ($allRes as $key => $v) 
				{                   
                    if (!is_array($v['formvar_code'])) {
                        if (array_key_exists($v['formvar_code'], $_POST)) {
                            $fld = $v['use_for'];
                            $vl = $v['formvar_code'];
                            $model->$fld = $_POST[$vl];
							$model->$fld = $_POST[$vl];	
                        }
                    }
                }
            }
			if(isset($model->unit_name) && !empty($model->unit_name))
				$unitName = $model->unit_name;

            if (isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) {
                $model->user_id = $_SESSION['RESPONSE']["user_id"];
            }
			if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
                $model->user_id = $_POST["user_id"];
            }
			
			//Get Land Region Id
			$landRegionArr = Yii::app()->db->createCommand("SELECT id,formvar_code FROM bo_infowiz_form_builder_config_values where use_for='landrigion_id' and table_name='bo_new_application_submission' and is_active='Y' and (service_id='0' OR service_id=$serviceID) order by service_id DESC")->queryRow();
			
			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);
			
			$model->landrigion_id = @$_POST[$landRegionArr['formvar_code']];
            $model->field_value = json_encode($_POST);
            $model->dept_id = $getDepartMentId['issuerby_id'];
			$model->application_status = 'I';
			$status = 'I';
			$model->app_comments = "Application Partially Submitted.";
            if(isset($_POST['submission_id']) && !empty($_POST['submission_id']))
			{
				$submission_id=$_POST['submission_id'];
				$currentAppStatus = Yii::app()->db->createCommand("SELECT application_status FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();
				if($currentAppStatus['application_status']=='H'){
					$model->application_status = 'H';
					$status='RBI';
					$model->app_comments = "Application Partially Re-submitted.";
				}					
			}
           
            $model->form_id = 1;
            $model->service_id = $serviceID;
            $model->sp_tag = $getDepartMentId['service_provider_tag'];
            $model->sp_app_id =  $serviceNameArr['swcs_service_id'];			
			$model->app_name = $serviceNameArr['infowiz_service_name'];
			$model->download_certificate_call_back_url = "#";
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $landrigion_id = $model->landrigion_id;
          
			/* 	echo "<pre>";
			 print_r($model);die; */
            if($model->save()) 
			{
				$hiddenfield = true ;
				if(isset($_POST['submission_id'])){		
					$hiddenfield = false ;
					$application_id = $_POST['submission_id'];
				}else{
					$application_id = Yii::app()->db->getLastInsertId();
				}
								
				$reverted_call_back_url = "/backoffice/infowizard/subFormNoticeofChangeofManagerForm6/updateSubForm/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
				$print_app_call_back_url ="/backoffice/infowizard/subFormNoticeofChangeofManagerForm6/downloadNewApp/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
				
				Yii::app()->db->createCommand("update bo_new_application_submission set reverted_call_back_url='$reverted_call_back_url',print_app_call_back_url='$print_app_call_back_url' where submission_id=$application_id")->execute();
				
											
				//Investor log Save
				$modellog = new NewApplicationSubmissionLog();
				$modellog->field_value = json_encode($_POST);
				$modellog->submission_id = $application_id;
				$modellog->application_id = $application_id;
				$modellog->user_id = $model->user_id;
				$modellog->dept_id = $getDepartMentId['issuerby_id'];
				$modellog->application_status = 'I';					
				$modellog->form_id = 1;
				$modellog->service_id = $_POST['service_id'];
				$modellog->application_created_date = date('Y-m-d H:i:s');
				$modellog->ip_address = $_SERVER['REMOTE_ADDR'];
				$modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$modellog->unit_name = @$unitName;
				$modellog->landrigion_id = @$landrigion_id;
				if ($modellog->save()) {
					$investor_log_id = Yii::app()->db->getLastInsertID();
				} else {
					die(var_dump($modellog->getErrors()));
				}
				//Investor log Save
				
				//Save Data IN bo_sp_application_history for log
				$modelSPH = new SpApplicationHistory;
				$modelSPH->sp_app_id = "";
				$modelSPH->service_id = $serviceNameArr['swcs_service_id'];
				$modelSPH->sp_tag =  $getDepartMentId['service_provider_tag'];
				$modelSPH->app_id = $application_id;
				$modelSPH->application_status = 'I';
				$modelSPH->comments = 'Application Partially Submitted';
				$modelSPH->added_date_time = date('Y-m-d H:i:s');
				
				if($modelSPH->save())
				{
					
				}else{
					die(var_dump($modelSPH->getErrors()));
				}
				//END Save Data IN bo_sp_application_history for log				
				
				$response = ['success'=>true,'application_id'=>$application_id,'hiddenfield'=>$hiddenfield];				
				echo json_encode($response);die;			
			
			}else{
				die(var_dump($model->getErrors()));	
			}
		}	
        
    }
	

	function getExistingCafDocuments($sno = null,$service_id = null,$dept_id=null,$user_id=null) {       
        $serviceExisting = $service_id;
        $serviceID = explode(".", $serviceExisting);
		$docsInfo = array();
        $userID = $user_id;
        $sql1 = "SELECT document_checklist_creation FROM bo_information_wizard_service_parameters  WHERE service_id=$serviceID[0] AND  servicetype_additionalsubservice=$serviceID[1] ORDER BY created DESC";
        //echo "<hr>";
        $docs = Yii::app()->db->createCommand($sql1)->queryRow();
		 //print_r($docs);die;
        if (isset($docs['document_checklist_creation']) && !empty($docs['document_checklist_creation'])) {
            $allDocumnetsForExistingCaf = json_decode($docs['document_checklist_creation']);			
            $do_array = array();
            foreach ($allDocumnetsForExistingCaf as $doces) {
                $do = $doces->doc_id;
                $sql2 = "SELECT * FROM cdn_dms_documents  WHERE docchk_id =$do AND user_id=$userID AND doc_status IN ('V','U') AND is_document_active='Y' ORDER BY documents_id DESC LIMIT 1";               
                $docsInfo[] = Yii::app()->db->createCommand($sql2)->queryRow();
            }
        }
        $totalMappedDocument = 0;
		/* echo "<pre>";
        print_r($docsInfo); */
		 
        foreach($docsInfo as $docData) {
			if(isset($docData['documents_id'])){
				$documentsID = $docData['documents_id'];
				$sql22 = "SELECT * FROM bo_application_dms_documents_mapping  WHERE sno=$sno AND user_id=$userID AND documents_id=$documentsID";
				//echo $sql22;
				$UploadedDocs = Yii::app()->db->createCommand($sql22)->queryAll();
				//print_r($UploadedDocs);die;
				if(empty($UploadedDocs)) {
					$model = new ApplicationDmsDocumentsMapping;
					$model->iuid = $docData['iuid'];
					$model->user_id = $docData['user_id'];
					$model->sno = $sno;
					$model->dept_id = $dept_id;
					$model->documents_id = $docData['documents_id'];
					$model->document_file_name = $docData['document_name'];
					$model->status = 'U';
					$model->user_agent = 'Api Access';
					$model->created_on = date("Y-m-d H:i:s");
					$model->ip_address = $_SERVER['REMOTE_ADDR'];
					if ($model->save()) {
						$totalMappedDocument = $totalMappedDocument + 1;
					}else{					
						die(var_dump($model->getError()));
					}
				}
			}
        }
		// print_r($docsInfo);die;
		/* echo count($docsInfo);
		echo "<br/>";
		echo  $totalMappedDocument;die; */
        if (count($docsInfo) == $totalMappedDocument) {

            return true;
        } else {

            return false;
        }
    }
	
}
