<?php
class SubFormOtherServiceController extends Controller {

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
	
	private function getSnoBySubmissionId($appSubID=null,$val=null)
	{
		$appSubID = DefaultUtility::dataSenetize($appSubID);
		$val = DefaultUtility::dataSenetize($val);
        $sqlspapp="Select bo_sp_applications.sno,bo_sp_applications.sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,	bo_new_application_submission.processing_level from bo_sp_applications
			INNER JOIN  bo_new_application_submission 
			ON bo_new_application_submission.submission_id=bo_sp_applications.app_id 
			INNER JOIN  sso_service_providers 
			ON bo_new_application_submission.dept_id=sso_service_providers.department_id 		
			where bo_sp_applications.app_id='$appSubID' AND sso_service_providers.service_provider_tag=bo_sp_applications.sp_tag"; 		
			$result = Yii::app()->db->createCommand($sqlspapp)->queryRow();		
		if(isset($result))
		return $result[$val];	
		else
		return false;	
	}	

    public function actionProcessData() {
		
		$current_role_id = $_SESSION['role_id'];
        $serviceID = DefaultUtility::dataSenetize($_POST['service_id']);
        $app_Sub_id = DefaultUtility::dataSenetize($_POST['app_Sub_id']);

				
		$allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where (service_id=$serviceID OR service_id=0) AND is_active='Y' AND table_name='bo_infowiz_formbuilder_application_forward_level' order by id desc")->queryAll();
		
        $allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id='$current_role_id' AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
		$canRevToInves = $allData['can_revert_to_investor'];
		$CurrentallData =  $allData;
		if($_POST['app_status']=='F')
		{
			$allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id=$current_role_id AND forward_role_id > 0 AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
		}
		
		$sptagData = Yii::app()->db->createCommand("SELECT service_provider_tag FROM sso_service_providers where department_id IN (select dept_id from bo_new_application_submission where service_id='$serviceID' )")->queryRow(); 
        
        $app_status = DefaultUtility::dataSenetize($_POST['app_status']);
		
		$getUserData = Yii::app()->db->createCommand("Select sso_users.user_id,sso_users.iuid,sso_profiles.first_name,sso_profiles.last_name,
		bo_new_application_submission.unit_name,bo_new_application_submission.landrigion_id,bo_district_circle.circle_name 
		FROM bo_new_application_submission 
		LEFT JOIN sso_users ON sso_users.user_id = bo_new_application_submission.user_id
		LEFT JOIN bo_sp_applications ON bo_sp_applications.app_id = bo_new_application_submission.submission_id 
		LEFT JOIN bo_district_circle ON bo_district_circle.id = bo_sp_applications.circle_id
		LEFT JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id
		WHERE submission_id ='$app_Sub_id' AND bo_sp_applications.sp_tag='LDA$099*$%97%'")->queryRow();
		
		
		if($_POST['app_status']=='INSD')
		{			
			$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
			$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

			if(!empty($applicationDetail)) 
			{
				$_POST['UK-FCL-00810_0'] = date("Y-m-d H:i:s",strtotime($_POST['UK-FCL-00810_0']));
				/* echo "<pre>";
				print_r($_POST);die; */
				//Save Data IN bo_sp_application_history for log
				$msglog = "Inspection is scheduled on date : ".$_POST['UK-FCL-00810_0'];
				$modelSPH = new SpApplicationHistory;
				$modelSPH->sp_app_id = $applicationDetail['sno'];
				$modelSPH->service_id = $applicationDetail['sp_app_id'];
				$modelSPH->sp_tag = $applicationDetail['sp_tag'];
				$modelSPH->app_id = $applicationDetail['app_id'];
				$modelSPH->application_status = 'P';
				$modelSPH->comments = $_POST['UK-FCL-00812_0'];
				$modelSPH->added_date_time = date('Y-m-d H:i:s');
				if($modelSPH->save())
				{
					$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                   
                    $ForwardLevelmodel->next_role_id = $allData['forward_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '0';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                    $ForwardLevelmodel->form_id = @$_POST['form_id'];
                    $ForwardLevelmodel->forwarded_dept_id = '21';
                    $ForwardLevelmodel->post_info = "";
                    $ForwardLevelmodel->verifier_user_comment = $_POST['UK-FCL-00812_0'];
                    $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                    $ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s'); 
                    $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $ForwardLevelmodel->comment_date = "";
                    $ForwardLevelmodel->action_status = $_POST['app_status'];
                    $ForwardLevelmodel->inspection_date = $_POST['UK-FCL-00810_0'];
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
					
                    if($ForwardLevelmodel->save()) {                       
                        $department_log_id = Yii::app()->db->getLastInsertID();
						$this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'],'P', @$_SESSION['uname'],$msglog, 0, @$_POST['UK-FCL-00812_0'], '', $department_log_id);
                    }
					
					Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id inspection scheduled successfully.");					
					$this->redirect('/backoffice/admin');					
				}else{
					die(var_dump($modelSPH->getErrors()));
				}
				//END Save Data IN bo_sp_application_history for log				
			}
				
		}
		
		if($_POST['app_status']=='SINS')
		{			
			$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
			$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

			if(!empty($applicationDetail)) 
			{	
				$insReport = "";
				
				if(!empty($_FILES)) 
				{
                    if($_FILES['inspection_report']['name'] != '' && $_FILES['inspection_report']['size'] <= (1024 * 1024 * 5)) 
					{		
						$file_name = strtolower($_FILES['inspection_report']['name']);
						$ext = pathinfo($file_name, PATHINFO_EXTENSION);
						$path = "/var/www/html/themes/backend/lm_inspection/";						
						$new_nameins_report = $getUserData['iuid'].'_'.time().".".$ext;
						move_uploaded_file($_FILES['inspection_report']['tmp_name'], $path . $new_nameins_report);						
					} 						
                } 
				
				//Save inspection details
				//echo $path;die;
				$lm_model = new LmInspection;
				$servId = explode(".",$_POST['service_id']);
				$lm_model->inspection_report = $new_nameins_report;			
				$lm_model->app_id = $app_Sub_id;			
				$lm_model->iuid = $getUserData['iuid'];
				$lm_model->service_id = $_POST['service_id'];
				$lm_model->firm_name = $getUserData['unit_name'];
				if($servId[0]=='119'){
					$ltype="LR";	
					$lm_model->service_type = 'Registration';
				}else if($servId[0]=='226'){
					$ltype="LM";
					$lm_model->service_type = 'Manufacturer';
				}else if($servId[0]=='227'){
					$ltype="LD";	
					$lm_model->service_type = 'Dealers';
				}else if($servId[0]=='228'){
					$ltype="LR";
					$lm_model->service_type = 'Repairers';
				}
				$iuids = mt_rand(10000000, 99999999);
				$licenceN = $ltype.'/'.$iuids.$getUserData['user_id'].'/'.$getUserData['circle_name'].'/'.date('Y');	
				$lm_model->district_id = $getUserData['landrigion_id'];
				$lm_model->licence_number = $licenceN;
				$lm_model->inspector_name = $_SESSION['uname'];
				$lm_model->last_inspection_date = $_POST['UK-FCL-00814_0'];				
				$lm_model->created=date('Y-m-d H:i:s');
				$lm_model->inspection_commence=date('Y');
				
				/* echo "<pre>";
				print_r($lm_model);
				
				die; */
				
				if($lm_model->save()){
					
				}else{
					die(var_dump($lm_model->getErrors()));
				}	
				
				
				/* echo "<pre>";
				print_r($_POST);die; */
				//Save Data IN bo_sp_application_history for log
				$msglog = "Inspection Start Date: ".$_POST['UK-FCL-00813_0'].', Inspection End Date: '.$_POST['UK-FCL-00814_0'];
				$modelSPH = new SpApplicationHistory;
				$modelSPH->sp_app_id = $applicationDetail['sno'];
				$modelSPH->service_id = $applicationDetail['sp_app_id'];
				$modelSPH->sp_tag = $applicationDetail['sp_tag'];
				$modelSPH->app_id = $applicationDetail['app_id'];
				$modelSPH->application_status = 'P';
				$modelSPH->comments = $_POST['UK-FCL-00815_0'];
				$modelSPH->added_date_time = date('Y-m-d H:i:s');
				if($modelSPH->save())
				{
					$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                   
                    $ForwardLevelmodel->next_role_id = $allData['forward_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '0';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                    $ForwardLevelmodel->form_id = @$_POST['form_id'];
                    $ForwardLevelmodel->forwarded_dept_id = '21';
                    $ForwardLevelmodel->post_info = "";
                    $ForwardLevelmodel->verifier_user_comment = $_POST['UK-FCL-00815_0'];
                    $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                    $ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s'); 
                    $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $ForwardLevelmodel->comment_date = "";
                    $ForwardLevelmodel->action_status = $_POST['app_status'];
                    $ForwardLevelmodel->inspection_start_date = $_POST['UK-FCL-00813_0'];
                    $ForwardLevelmodel->inspection_end_date = $_POST['UK-FCL-00814_0'];
                    $ForwardLevelmodel->reason_for_delay = @$_POST['UK-FCL-00816_0'];
                    $ForwardLevelmodel->inspection_report = @$new_nameins_report;
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
					
                    if($ForwardLevelmodel->save()) {                       
                        $department_log_id = Yii::app()->db->getLastInsertID();
						$this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'],'P', @$_SESSION['uname'],$msglog, 0, @$_POST['UK-FCL-00815_0'], '', $department_log_id);
                    }
					
					Yii::app()->user->setFlash('success', "Inspection detail save successfully for Application Id : $app_Sub_id");					
					$this->redirect('/backoffice/admin');					
				}else{
					die(var_dump($modelSPH->getErrors()));
				}
				//END Save Data IN bo_sp_application_history for log				
			}
				
		}
		
		
		
		//echo "<pre>";		
		//print_r($allRes);
		//print_r($_POST);
		//die();  
		$configArr = array(); 
	 
		$postedKeys = array_keys($_POST);
		
        if (isset($allRes) && !empty($allRes)) {
			//$dept = array();
            foreach ($allRes as $key => $val) {
				if(!in_array($val['use_for'],$configArr) && in_array($val['formvar_code'],$postedKeys))
				{	
					$configArr[] = $val['use_for'];
					if ($val['use_for'] == 'forward_dept_id' && $app_status == 'F') {
						$fld = $val['use_for'];
						$vl = $val['formvar_code'];
						$dept = @$_POST[$vl];					
					}
					if ($val['use_for'] == 'verifier_user_comment') {
						$vl = $val['formvar_code'];
						$comment = $_POST[$vl];
					}
				}	
            }
			// CAF Template
			if(isset($_POST['UK-FCL-00181_9']) && !empty($_POST['UK-FCL-00181_9']))
			{			
				$comment = $_POST['UK-FCL-00181_9'];
			}

			$comment=DefaultUtility::sanatizeParams($comment);
			
			/*  print_r($dept);
			die('here'); 
			  */
            $deptName = "";
            if (isset($dept) && !empty($dept)) {
				if (is_array($dept)) 
				{
                    $deptStr = implode(",", DefaultUtility::dataSenetize($dept));
                } else {
                    $dept2[0] = $dept;
                    $deptStr = implode(",", DefaultUtility::dataSenetize($dept2));
                    $dept = array();
                    $dept[0] = $deptStr;
                }
				
                $deptNameArr = Yii::app()->db->createCommand("SELECT dept_id,department_name FROM `bo_departments` WHERE dept_id IN($deptStr)")->queryAll();
				
                $list = $dpt = Array();
                foreach ($deptNameArr as $k1 => $v1) {
                    $list[] = "$v1[department_name]";
                    $dpt[$v1['dept_id']] = $v1['department_name'];
                }
                $deptName = implode(",", $list);
            }
			/* echo $deptName;
			die('66'); */
            
            $form_id = DefaultUtility::dataSenetize($_POST['form_id']);
            $uid = $_SESSION['uid'];
            $dept_id = $_SESSION['dept_id'];
            $_POST = $this->my_array_map('trim', $_POST);
            $postData = json_encode($_POST);
            $postData = DefaultUtility::sanatizeParams($postData);
            $msglog = '';
			$reverted_call_back_url = "#";
			$download_certificate_call_back_url = "#";
			
		
			//print_r($dept);die;
            if ($_POST['app_status'] == 'F') {
                foreach($dept as $k => $v) {
                    $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                    //$ForwardLevelmodel->next_role_id = $allData['next_role_id'];
                    $ForwardLevelmodel->next_role_id = $allData['forward_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '0';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                    $ForwardLevelmodel->form_id = $form_id;
                    $ForwardLevelmodel->forwarded_dept_id = $v;
                    $ForwardLevelmodel->post_info = "";
                    $ForwardLevelmodel->verifier_user_comment = "";
                    $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                    $ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s'); 
                    $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $ForwardLevelmodel->comment_date = "";
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
					
                    if ($ForwardLevelmodel->save()) {
                        $flag = 1;
                        $department_log_id = Yii::app()->db->getLastInsertID();
                    }
                    $msglog = "Application has been forwarded to $dpt[$v]";
					
					//Update Data IN bo_sp_application for log
					$currentDate = date('Y-m-d H:i:s');
					$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);
					$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='$msglog ',app_status='".$_POST['app_status']."',updated_on='$currentDate' WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
					$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

					$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
					$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

					if(!empty($applicationDetail)) 
					{
						//Save Data IN bo_sp_application_history for log
						$modelSPH = new SpApplicationHistory;
						$modelSPH->sp_app_id = $applicationDetail['sno'];
						$modelSPH->service_id = $applicationDetail['sp_app_id'];
						$modelSPH->sp_tag = $applicationDetail['sp_tag'];
						$modelSPH->app_id = $applicationDetail['app_id'];
						$modelSPH->application_status = $_POST['app_status'];
						$modelSPH->comments = "$msglog";
						$modelSPH->added_date_time = date('Y-m-d H:i:s');
						if($modelSPH->save())
						{
							
						}else{
							die(var_dump($modelSPH->getErrors()));
						}
						//END Save Data IN bo_sp_application_history for log				
					}
					//END Update Data IN bo_sp_application for log

                    $this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'], @$_POST['app_status'], @$_SESSION['uname'], @$msglog, 0, @$comment, '', $department_log_id);
                    DefaultUtility::SendSMSEmailGlobalCAF2('Application','Verifier forwarded the aplication to departments for their comments',@$_POST['app_Sub_id'],$v); 
                }
            } else if ($_POST['app_status'] == 'H') {
                $flag = 1;
            } else if ($_POST['app_status'] == 'A') {
                $flag = 1;
            } else if ($_POST['app_status'] == 'R') {
                $flag = 1;
            } else if ($_POST['app_status'] == 'V') {
                $flag = 1;
            }
          /*  echo $_POST['app_status'];
              echo $flag;die();  */
				
            if (isset($flag) && $flag == 1) {
				
                if (!empty($_FILES)) {
                    if ($_FILES['upload']['type'] == 'application/pdf' && $_FILES['upload']['name'] != '' &&
                            $_FILES['upload']['size'] <= (1024 * 1024 * 5)) {
                        $path = Yii::app()->basePath . "/../../themes/backend/FormBuiderNoc/";
                        $nname = "NOC-" . $app_Sub_id . "-" . time() . ".pdf";
                        move_uploaded_file($_FILES['upload']['tmp_name'], $path . $nname);
                        $pathUploaded = "/themes/backend/FormBuiderNoc/" . $nname;
                    } else {
                        $pathUploaded = "";
                    }

                    $nocPath = "<a href='" . $pathUploaded . "'>Click here to download certificate</a>";
                    $sqll = "UPDATE bo_new_application_submission SET   certificate_path='$pathUploaded' where submission_id='$app_Sub_id'";
                    $updateNewApplication = Yii::app()->db->createCommand($sqll)->execute();
                }

                $comment_date = date('Y-m-d H:i:s');

                $res = Yii::app()->db->createCommand("Select appr_lvl_id from bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id AND approv_status='P' order by appr_lvl_id DESC")->queryRow();
                $department_log_id = $res['appr_lvl_id'];

                $updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" . $comment . "',comment_date='$comment_date',updated_date_time='$comment_date',post_info='$postData',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id")->execute();


                if ($allData['can_revert_to_investor'] == 'Y' && $app_status != 'V') {
                    $updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='$app_status' where submission_id=$app_Sub_id")->execute();
                }
            }
            if ($_POST['app_status'] == 'F') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been forwarded to $deptName");
            }
            if ($_POST['app_status'] == 'H') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been reverted to applicant.");
                $msglog = "Application Id : $app_Sub_id has been reverted.";
				$reverted_call_back_url = "/backoffice/infowizard/subForm/updateSubForm/service_id/".$_POST['service_id']."/pageID/1/subID/".$_POST['app_Sub_id']."/formCodeID/1";
            }
            if ($_POST['app_status'] == 'A') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been approved successfully.");
                $msglog = "Application Id : $app_Sub_id has been approved successfully.";
				$updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='$app_status' where submission_id=$app_Sub_id")->execute();
				$currentDate = date('Y-m-d H:i:s');
				$d_url = "";
				
				if($_POST['service_id']=='571.0')
				{	
					$data ='';
					$path ='';				
					$name="FILM_SHOOTING_".$app_Sub_id.".pdf";
					
					$download_certificate_call_back_urlF = "https://caipotesturl.com/backoffice/infowizard/subFormPdf/SaveFilmCertificate/service_id/".base64_encode($_POST['service_id'])."/subID/".base64_encode($_POST['app_Sub_id'])."/dept_id/".base64_encode($dept_id);					
					$path = Yii::app()->basePath . "/film_certificate/" . $name;
					$download_certificate_call_back_url = $_SERVER['HTTP_HOST']."/backoffice/protected/film_certificate/" . $name;				
					$res = $this->SavePdf($download_certificate_call_back_urlF,$path);					
					$d_url = 'https://caipotesturl.com/backoffice/protected/film_certificate/FILM_SHOOTING_'.$app_Sub_id.'.pdf';
				}
				if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')))
				{	
					$lmInsNumArr = Yii::app()->db->createCommand("SELECT * FROM `bo_lm_inspection_report` WHERE app_id =$app_Sub_id")->queryRow();
					$path ='';
					$name = "LM_".$app_Sub_id.'_'.time().".pdf";
					$download_certificate_call_back_urlLM = "https://caipotesturl.com/backoffice/infowizard/subFormPdf/SaveLegalMetrologyCertificate/service_id/".base64_encode($_POST['service_id'])."/subID/".base64_encode($_POST['app_Sub_id'])."/dept_id/".base64_encode($dept_id).'/licenceN/'. $lmInsNumArr['licence_number'];					
					$path = "/var/www/html/themes/backend/lm_approval_certificate/" . $name;
					$download_certificate_call_back_url = "/themes/backend/lm_approval_certificate/" . $name;
					$res = $this->SavePdf($download_certificate_call_back_urlLM,$path);	
					$d_url = '/themes/backend/lm_approval_certificate/LM_'.$app_Sub_id.'.pdf';
					
					
					
					$lmcert_model = new LmApprovalCertificate;					
					
					$lmcert_model->approval_certificate = $name;			
					$lmcert_model->iuid = $getUserData['iuid'];
					$lmcert_model->app_id = $app_Sub_id;
					$lmcert_model->service_id = $_POST['service_id'];
					$lmcert_model->licencee_name = @$getUserData['first_name'].''.@$getUserData['last_name'];
					$lmcert_model->firm_name = $getUserData['unit_name'];
					$lmcert_model->firm_address = "";
					$servId = explode(".",$_POST['service_id']);
					if($servId[0]=='119'){							
						$lmcert_model->service_type = 'Registration';
					}else if($servId[0]=='226'){						
						$lmcert_model->service_type = 'Manufacturer';
					}else if($servId[0]=='227'){							
						$lmcert_model->service_type = 'Dealers';
					}else if($servId[0]=='228'){						
						$lmcert_model->service_type = 'Repairers';
					}
					$lmcert_model->district_id = $getUserData['landrigion_id'];
					$lmcert_model->licence_number = $lmInsNumArr['licence_number'];
					$lmcert_model->inspector_name = $_SESSION['uname'];
					$lmcert_model->licence_valid_from = date('Y-m-d H:i:s');
					$lmcert_model->licence_valid_to = date('Y-m-d H:i:s', strtotime('12/31'));
					$lmcert_model->date_of_licence_issue = date('Y-m-d H:i:s');
					$lmcert_model->created=date('Y-m-d H:i:s');					  
					if($lmcert_model->save()){

					}else{
						die(var_dump($lmcert_model->getErrors()));						
					}	
				}
				
                $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET download_certificate_call_back_url = '$d_url' ,app_comments='$msglog ',app_status='" . $_POST['app_status'] . "',updated_on='$currentDate' WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
                $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
				
            }
			
            if ($_POST['app_status'] == 'R') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been rejected.");
                $msglog = "Application Id : $app_Sub_id has been rejected.";
            }
			
            if ($_POST['app_status'] == 'V') {
			
                $total_data = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$app_Sub_id AND approv_status='P' AND next_role_id=$current_role_id")->queryRow();
                 /* echo $total_data['total'];
                  die();  */ 
                if($total_data['total'] == 0) 
				{
                    $update_date = date('Y-m-d H:i:s');
					if(isset($canRevToInves) && $canRevToInves=='Y')
					{
						$sql_update = "UPDATE bo_new_application_submission SET application_status='P' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
						$updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
					}
                    $AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();

                    $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                    $ForwardLevelmodel->next_role_id = $allData['next_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
					//check for internal user forward then assign assign again to department
					if(isset($_SESSION) && $_SESSION['role_id']==86)
					{
						$ForwardLevelmodel->forwarded_dept_id = $dept_id;					
					}else{					
						$ForwardLevelmodel->forwarded_dept_id = $AppData['dept_id'];
					}	
                    $ForwardLevelmodel->post_info = "";
                    $ForwardLevelmodel->verifier_user_comment = '';
                    $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                    $ForwardLevelmodel->updated_date_time = '';
                    $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $ForwardLevelmodel->comment_date = '';
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
					//print_r($ForwardLevelmodel);die;
					//print_r($ForwardLevelmodel);die;
                    if ($ForwardLevelmodel->save()) {
                        $department_log_id = Yii::app()->db->getLastInsertID();
                    }
                }
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been processed.");
                $msglog = "Application Id : $app_Sub_id has been processed.";
            }
            if ($_POST['app_status'] != 'F') {
				
                //exit(@$department_log_id."sdasdad");
				//Update Data IN bo_sp_application for log
				$currentDate = date('Y-m-d H:i:s');
				if($_POST['app_status']=='H')
				{
					$app_status = 'RBI';
				}else if($_POST['app_status']=='P'){
					$comment_date = date('Y-m-d H:i:s');
					$updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" . $comment . "',comment_date='$comment_date',updated_date_time='$comment_date',post_info='$postData',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id")->execute();


					$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                    //$ForwardLevelmodel->next_role_id = $allData['next_role_id'];
                    $ForwardLevelmodel->next_role_id = $CurrentallData['forward_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '0';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                    $ForwardLevelmodel->form_id = $form_id;
                    $ForwardLevelmodel->forwarded_dept_id = $dept_id;
                    $ForwardLevelmodel->post_info = "";
                    $ForwardLevelmodel->verifier_user_comment = "";
                    $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                    $ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s'); 
                    $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $ForwardLevelmodel->comment_date = "";
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
					/* echo "<pre>";
					print_r($ForwardLevelmodel);die; */
                    if ($ForwardLevelmodel->save()) {
                        $flag = 1;
                        $department_log_id = Yii::app()->db->getLastInsertID();
                    }
                    $msglog = "Application has been reverted to nodal.";
					$app_status = 'P';
					$update_date = date('Y-m-d H:i:s');
					$sql_update = "UPDATE bo_new_application_submission SET application_status='P' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
					$updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
				}else{
					$app_status = $_POST['app_status'];
				}
				$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);
				
				$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='$msglog ',app_status='$app_status',updated_on='$currentDate',reverted_call_back_url='$reverted_call_back_url',download_certificate_call_back_url='$download_certificate_call_back_url' WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
				$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

				$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
				$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

				if(!empty($applicationDetail)) 
				{
					//Save Data IN bo_sp_application_history for log
					$modelSPH = new SpApplicationHistory;
					$modelSPH->sp_app_id = $applicationDetail['sno'];
					$modelSPH->service_id = $applicationDetail['sp_app_id'];
					$modelSPH->sp_tag = $applicationDetail['sp_tag'];
					$modelSPH->app_id = $applicationDetail['app_id'];
					$modelSPH->application_status = $_POST['app_status'];
					$modelSPH->comments = "$msglog";
					$modelSPH->added_date_time = date('Y-m-d H:i:s');
					if($modelSPH->save())
					{
						
					}else{
						die(var_dump($modelSPH->getErrors()));
					}
					//END Save Data IN bo_sp_application_history for log				
				}
				//END Update Data IN bo_sp_application for log	
				
                $this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'], @$_POST['app_status'], @$_SESSION['uname'], @$msglog, 0, @$comment, '', @$department_log_id);
            }
			
			if ($_POST['app_status'] == 'FA') {
				$comment_date = date('Y-m-d H:i:s');
                $msglog = "Application Id : $app_Sub_id has been forwarded to Approver";
				$updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" .DefaultUtility::sanatizeParams($comment) . "',comment_date='$comment_date',updated_date_time='$comment_date',post_info='". DefaultUtility::sanatizeParams($postData)."',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id")->execute();
				
				$update_date = date('Y-m-d H:i:s');
				$sql_update = "UPDATE bo_new_application_submission SET application_status='FA' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
				$updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();

				$AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
				
				$approverData = Yii::app()->db->createCommand("SELECT approver_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();

				$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
				$ForwardLevelmodel->next_role_id =$approverData['approver_id'];// approver id fron config table
				$ForwardLevelmodel->verifier_user_id = $_SESSION['uid'];// loggedin user 
				$ForwardLevelmodel->app_Sub_id = $app_Sub_id;
				$ForwardLevelmodel->forwarded_dept_id = $AppData['dept_id'];
				$ForwardLevelmodel->post_info = "";
				$ForwardLevelmodel->verifier_user_comment = '';
				$ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
				$ForwardLevelmodel->updated_date_time = '';
				$ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$ForwardLevelmodel->comment_date = '';
				$ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
				$ForwardLevelmodel->approv_status = 'P';
				if ($ForwardLevelmodel->save()) {
					Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been forwarded to Approver");
					
					$department_log_id = Yii::app()->db->getLastInsertID();
				}                
            }
            $nocPath = "";

            $this->redirect("/backoffice/admin");
        }
    }
	
	public function getApplicationProcessingLevel($service_id=null,$postData=null){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$postData = DefaultUtility::dataSenetize($postData);
        if(isset($postData['UK-FCL-00038_10']) && !empty($postData['UK-FCL-00038_10']) && isset($postData['UK-FCL-00051_3']) && !empty($postData['UK-FCL-00051_3']) && $service_id=='591.0')
		{
			// 
			if(isset($postData["UK-FCL-00648_0"]) && !empty($postData["UK-FCL-00648_0"]) && $_POST['UK-FCL-00038_11']!='New')
			{
				$natureOfUnit = $postData['UK-FCL-00038_10'];//Nature of Unit
				$Investment = $postData['UK-FCL-00645_0'];//Investment
			}else{
				$natureOfUnit = $postData['UK-FCL-00038_10'];//Nature of Unit
				$Investment = $postData['UK-FCL-00051_3'];//Investment
			}
			//10 Crore 1000 lakhs
			if($natureOfUnit=='Manufacturing' && $Investment > 1000)
			{
				$processLevel  = 'State';
			}
			//5 Crore 500 lakhs
			if($natureOfUnit=='Services' && $Investment > 500)
			{
				$processLevel  = 'State';
			}
			if(isset($processLevel) && !empty($processLevel)){
				return $processLevel;
			}else{
				return "";
			}
		}else{
			return "";
		}	
	}

    public function actionSaveData() {
		/* echo "<pre>";
		print_r($_POST);
		die; */
	
		$saved_caf_id = NULL ;
        if (!empty($_POST) && !Yii::app()->request->isAjaxRequest) 
		{
			echo "<pre>";
			print_r($_POST);die;
			$approvel_id = 0;
            $serviceID = DefaultUtility::dataSenetize($_POST['service_id']);
            $issuer_id = DefaultUtility::dataSenetize($_POST['issuer_id']);
            $approval_id = @$_POST['approval_id'];
            $applicationExt = New ApplicationExt;
            $serviceArr = $applicationExt->getServiceNameById($serviceID);
            $service_Name = $serviceArr['core_service_name'];
			$abyeFlag = 0;
			$docFlag = 0;
			
			if(isset($_POST['submission_id'])){				
				$sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $_POST['submission_id']."'" ;$model = NewApplicationSubmission::model()->findBySql($sql);
				$submission_id = $_POST['submission_id'];
			}else{
				$model = new NewApplicationSubmission();
			}
			
			//print_r($_POST);
			//Identify CAF fill for district level or state level			
			$processLevel = $this->getApplicationProcessingLevel($serviceID,$_POST);
			if(isset($processLevel) && !empty($processLevel))
			{
				$model->processing_level = @$processLevel;
				
			}else{
				$model->processing_level = 'District';
				
			}	
					
			$processLevel = $model->processing_level;
			
            $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();
			
            $allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_new_application_submission' AND is_active='Y'")->queryAll();
            $getDepartMentId = Yii::app()->db->createCommand("SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_departments.dept_id FROM bo_infowizard_issuerby_master LEFT JOIN bo_departments ON bo_departments.infowiz_short_code=bo_infowizard_issuerby_master.abb where issuerby_id=$issuer_id")->queryRow();
			  /* print_r($allData); */
			/* echo "<pre>";
			print_r($_POST); */
			/*echo "<br/>----------------------------------b";
			print_r($getDepartMentId);
			die;  */
            //$model = new NewApplicationSubmission();			
			//echo $_POST['UK-FCL-00038_1'];
            if (isset($allRes) && !empty($allRes)) {
                foreach ($allRes as $key => $v) {
					
                    if (!is_array($v['formvar_code'])) {
						/* echo "<pre>";
                    print_r($v['formvar_code']);  */
                        if (array_key_exists($v['formvar_code'], $_POST)) {
                            $fld = $v['use_for'];
                            $vl = $v['formvar_code'];                            
							$model->$fld = $_POST[$vl];							
							//$unitName = $_POST[$vl];
							
                        }
                    }
                }
            }
			
			if(isset($model->unit_name) && !empty($model->unit_name))
				$unitName = $model->unit_name;
			
			/* echo $unitName;die; */
			
            if (isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) {
                $model->user_id = $_SESSION['RESPONSE']["user_id"];
            } /* else if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
                $model->user_id = $_SESSION["uid"];
            } */
			if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
                $model->user_id = $_POST["user_id"];
            }
			
			//Get Land Region Id
			$landRegionArr = Yii::app()->db->createCommand("SELECT id,formvar_code FROM bo_infowiz_form_builder_config_values where use_for='landrigion_id' and table_name='bo_new_application_submission' and is_active='Y' and (service_id='0' OR service_id='$serviceID') order by service_id DESC")->queryRow();
			
			$model->landrigion_id = @$_POST[$landRegionArr['formvar_code']];			
            $model->field_value = json_encode($_POST);
            $model->dept_id = $getDepartMentId['dept_id'];
// Code By Aamir for Service provider
            if(isset($_SESSION['RESPONSE']["user_type"]) && !empty($_SESSION['RESPONSE']["user_type"])) {
                if($_SESSION['RESPONSE']["user_type"]==2){
                    $model->agent_entry = 1;
                    $model->agent_user_id = @$_SESSION['RESPONSE']['agent_user_id'];
                }
            }
// End Code of service provider 
			
			//this is use for film shooting
            if($_POST['service_id']=='571.0') 
		    {
                $model->landrigion_id = 6;                
            }           
            $landrigion_id = $model->landrigion_id;
			
			$model->application_status = 'P';
				
			//Check document exist or not
			$sno = $this->getSnoBySubmissionId(@$_POST['submission_id'],'sno');		
			if(isset($sno) && !empty($sno))
			{		
				$documentExistCheck = Yii::app()->db->createCommand("SELECT * FROM bo_application_dms_documents_mapping where sno=$sno")->queryRow();
			}
			if(empty($documentExistCheck))
			{
				$model->application_status = 'DP';
				$docFlag = 1;			
			}	
			
			//Save document data mapping
			$docExist = $this->getExistingCafDocuments($sno, $_POST['service_id'], $getDepartMentId['dept_id'],$model->user_id);
			//this is set because currently incentive documents are not mapped
			$docExist = 'true';
			if($docExist == 'true') {
				$docFlag = 0;
			}
				
			//For LM Satus set PD 
			if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')) && empty($_SESSION["uid"]))
			{
				$model->application_status = 'PD';
			}	
             
            $model->form_id = 1;
            $model->service_id = DefaultUtility::dataSenetize($_POST['service_id']);
            $model->application_created_date = date('Y-m-d H:i:s');
            //$model->application_updated_date_time = date('Y-m-d H:i:s');          
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $model->approval_id = $approval_id ;
			/*  echo "<pre>";
			 print_r($model);die();  */
            if($model->save()) 
			{
				
				//$application_id = Yii::app()->db->getLastInsertId();
				
				if(isset($_POST['submission_id'])){					
					$application_id = $_POST['submission_id'];
				}else{
					$application_id = Yii::app()->db->getLastInsertId();
				}
				$saved_caf_id = $application_id;
				if(isset($approval_id) && $approval_id > 0)
				{
					$updateNewApplication = Yii::app()->db->createCommand("update bo_infowiz_approval_master set caf_id='$application_id' where id=$approval_id")->execute();
				}
                
			
				$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);
				
				$sptagData = Yii::app()->db->createCommand("SELECT * FROM sso_service_providers where department_id=$getDepartMentId[dept_id]")->queryRow(); 
				
				
				//Save Data IN bo_sp_application for log				
				$sno = $this->getSnoBySubmissionId(@$_POST['submission_id'],'sno');	
				if(isset($sno) && !empty($sno)){
					$sql = "SELECT * FROM bo_sp_applications where sno=$sno";        
					$modelSpApplications = SpApplications::model()->findBySql($sql);
				}
				if(empty($modelSpApplications))
				{	
					$modelSpApplications = new SpApplications();
				}
				$modelSpApplications->sp_tag = $sptagData['service_provider_tag'];
				$modelSpApplications->sp_app_id = $serviceNameArr['swcs_service_id'];
				$modelSpApplications->app_id = $application_id;
				$modelSpApplications->app_name = $serviceNameArr['infowiz_service_name'];
				$modelSpApplications->app_status = "P";
				if($docFlag == 1 || $abyeFlag==1)
				{
					$modelSpApplications->app_status = 'DP';
				}
					
				
				$modelSpApplications->app_comments = "Application Submitted Successfully";
				//For LM Satus set PD 
				if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')) && empty($_SESSION["uid"]))
				{
					$modelSpApplications->app_status = 'PD';
					$modelSpApplications->app_comments = "Application submitted but payment pending.";
				}
				$modelSpApplications->app_distt = $landrigion_id; 
				$modelSpApplications->app_fields = '-'; 
				$modelSpApplications->app_distt_name = '-'; 
				$modelSpApplications->app_location = '-'; 
				$modelSpApplications->caf_id = '0'; 
				$modelSpApplications->param_1 = '0'; 
				$modelSpApplications->param_2 = '0'; 
				$modelSpApplications->param_3 = '0'; 
				$modelSpApplications->param_4 = '0'; 
				$modelSpApplications->param_5 = '0'; 
				
				//echo "<pre>" ; print_r($_SESSION);
				//$_SESSION["uid"] = 1 ; 
				if (isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) {
					$modelSpApplications->user_id = $_SESSION['RESPONSE']["user_id"];
				}/*  else if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
					$modelSpApplications->user_id = $_SESSION["uid"];
				}	 */	
				if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
					$modelSpApplications->user_id = $_POST["user_id"];
				}	
				$modelSpApplications->created_on = date('Y-m-d H:i:s');
				$modelSpApplications->updated_on = date('Y-m-d H:i:s');
				$modelSpApplications->is_active = "Y";
				$modelSpApplications->unit_name = @$unitName;
				$modelSpApplications->download_certificate_call_back_url = "#";
				$modelSpApplications->reverted_call_back_url =  "/backoffice/infowizard/subForm/updateSubForm/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
				
				$modelSpApplications->print_app_call_back_url ="/backoffice/infowizard/subForm/downloadNewApp/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";	
					
				$modelSpApplications->remote_server = $_SERVER['REMOTE_ADDR'];
				$modelSpApplications->user_agent = $_SERVER['HTTP_USER_AGENT'];
				
				if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')))
				{
					// This is use for LM Department to assign circle wise application
					$resArrLM = Yii::app()->db->createCommand("SELECT CONCAT(service_id,'.',servicetype_additionalsubservice) as service_id FROM `bo_information_wizard_service_parameters` WHERE `department_id` = '26' AND `is_active` = 'Y'")->queryAll(); 
					$serviceLmArr = array();
					if(isset($resArrLM) && !empty($resArrLM))
					{
						foreach($resArrLM as $key=>$val){
							$serviceLmArr[] =	$val['service_id'];
						}
						if(isset($serviceLmArr) && !empty($serviceLmArr))
						{	
							if(in_array($_POST['service_id'],$serviceLmArr)){
								
								if(isset($_POST['UK-FCL-00232_0']) && !empty($_POST['UK-FCL-00232_0']))
								{
									$circle_id = $_POST['UK-FCL-00232_0'];
									
									$npUserArr = Yii::app()->db->createCommand("SELECT np_user_id FROM bo_user WHERE circle_id = '$circle_id' AND is_active = '1'")->queryRow(); 
									
									if(isset($npUserArr) && !empty($npUserArr))
									{
										$modelSpApplications->assigned_to = $npUserArr['np_user_id'];
										$modelSpApplications->circle_id = @$_POST['UK-FCL-00232_0'];
									}	
								}				
							}
						}	
					}			
					// End of use for LM Department to assign circle wise application
				}	
			/* 	echo "<pre>";
				print_r($modelSpApplications);die; */
				if($modelSpApplications->save())
				{	
					$sno = $this->getSnoBySubmissionId(@$_POST['submission_id'], 'sno');					
					//Save document data mapping for other services
					//Save document data mapping
					$docExist = $this->getExistingCafDocuments($sno, $_POST['service_id'], $getDepartMentId['dept_id'],$model->user_id);						
					//this is set because currently incentive documents are not mapped
					$docExist = 'true';
					if($docExist == 'true') 
					{
						$docFlag = 0;
					}
					
					//Save Data IN bo_sp_application_history for log
					$modelSPH = new SpApplicationHistory;
					$modelSPH->sp_app_id = $sno;
					$modelSPH->service_id = $serviceNameArr['swcs_service_id'];
					$modelSPH->sp_tag =  $sptagData['service_provider_tag'];
					$modelSPH->app_id = $application_id;
					$modelSPH->application_status = 'P';
					if($docFlag == 1)
					{
						$modelSPH->application_status = 'DP';
					}
					$modelSPH->comments = 'Application Submitted Successfully';
					
					//For LM Satus set PD 
					if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')) && empty($_SESSION["uid"]))
					{
						$modelSPH->application_status = 'PD';
					}
					$modelSPH->added_date_time = date('Y-m-d H:i:s');
					/*  echo "<pre>" ; print_r($modelSPH);
				die();  */
					if($modelSPH->save())
					{
						
					}else{
						die(var_dump($modelSPH->getErrors()));
					}
					//END Save Data IN bo_sp_application_history for log				
				}else{
					die(var_dump($modelSpApplications->getErrors()));
				}
				//END Save Data IN bo_sp_application for log
				
				
                if (isset($model->user_id) && ($model->user_id != "")) 
				{
                    $var_model_user_id = $model->user_id;
                    $sql = "select * from sso_users left join sso_profiles on sso_users.user_id = sso_profiles.user_id where sso_users.user_id = $var_model_user_id";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $emails = $command->queryAll();
                    $dept_user = $emails[0]['first_name'];
                    $ALERT_EMAIL_USERNAME = "";

                    if (!empty($emails)) {
                        $sql = "select * from bo_email_text where module = 'sub_form' and trigger_point = 'sub_form_submission' and role_id = '1000' and is_active = 'Y' ";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql);
                        $template = $command->queryAll();
                        if (!empty($template)) {
                            $text_sub = $template[0]['subject'];
                            $text0 = str_replace("<Dept User Name>", $dept_user, $template[0]['text']);
                            $text1 = str_replace("<service_name>", $service_Name, $text0);
                            $text2 = str_replace("<app_id>", $application_id, $text1);
                            $date = date('Y-m-d H:m:s');
                            $sql = "Insert into bo_sms_email_alert (module,trigger_point,subject,body,email_from,email_to,mobile,log_created_on,email_status,sms_status,user_id) "
                                    . "values('sub_form','sub_form_submission','" . $text_sub . "','" . $text2 . "','" . $ALERT_EMAIL_USERNAME . "','" . $emails[0]['email'] . "','" . $emails[0]['mobile_number'] . "','" . $date . "','" . '0' . "','" . '0' . "','" . $model->user_id . "')";
                            $connection = Yii::app()->db;
                            $command = $connection->createCommand($sql);
                            $InsertLog = $command->execute();
                        }
                    }
                }
				
				//this code use for backend side data entry
				if($docFlag == 0 && isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
				{
					$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
					$ForwardLevelmodel->next_role_id = @$allData['next_role_id'];
					$ForwardLevelmodel->verifier_user_id = '0';
					$ForwardLevelmodel->app_Sub_id = $application_id;
					$ForwardLevelmodel->forwarded_dept_id = $getDepartMentId['dept_id'];
					$ForwardLevelmodel->post_info = "";
					$ForwardLevelmodel->verifier_user_comment = '';
					$ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
					$ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s');
					$ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
					$ForwardLevelmodel->comment_date = date('Y-m-d H:i:s');
					$ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
					$ForwardLevelmodel->approv_status = 'P';				
					if($ForwardLevelmodel->save())
					{				
						$updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='P' where submission_id='$application_id'")->execute();

                        $serviceId = $_POST['service_id'];

                        $getSwcsServiceId = Yii::app()->db->createCommand("select swcs_service_id from bo_information_wizard_service_parameters where CONCAT (service_id,'.',servicetype_additionalsubservice) = $serviceId")->queryRow();
                        $spAppID = $getSwcsServiceId['swcs_service_id'];

                        $updateSpApp = Yii::app()->db->createCommand("update bo_sp_applications set app_status='P' where sp_app_id='$spAppID' AND app_id='$application_id'")->execute();
						
						if (isset($ForwardLevelmodel->next_role_id) && ($ForwardLevelmodel->next_role_id != "") && isset($ForwardLevelmodel->forwarded_dept_id) && ($ForwardLevelmodel->forwarded_dept_id != "") && isset($landrigion_id) && ($landrigion_id != "")) {
							$var_next_role_id = $ForwardLevelmodel->next_role_id;
							$var_forwarded_dept_id = $ForwardLevelmodel->forwarded_dept_id;

							$sql = "select * from bo_user left join  bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id=:role_id and disctrict_id=:district_id and dept_id=:dept_id";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$command->bindParam(":role_id", $var_next_role_id, PDO::PARAM_STR);
							$command->bindParam(":district_id", $landrigion_id, PDO::PARAM_STR);
							$command->bindParam(":dept_id", $var_forwarded_dept_id, PDO::PARAM_STR);

							$emails = $command->queryAll();

							foreach ($emails as $email) {
								$dept_user = $email['full_name'];
								$ALERT_EMAIL_USERNAME = "";
								if (!empty($email)) {

									$text_sub = "Single Window Clearance System - Application Forwarded.";
									$text4 = "Dear $dept_user , Application with App ID : $application_id for $service_Name has been forwarded on Single Window Clearance System for your approval.";
									$date = date('Y-m-d H:m:s');
									$sql = "Insert into bo_sms_email_alert (module,trigger_point,subject,body,email_from,email_to,mobile,log_created_on,email_status,sms_status,user_id) "
											. "values('sub_form','sub_form_submission','" . $text_sub . "','" . $text4 . "','" . $ALERT_EMAIL_USERNAME . "','" . $email['email_alert'] . "','" . $email['mobile'] . "','" . $date . "','" . '0' . "','" . '0' . "','" . $email['uid'] . "')";
									$connection = Yii::app()->db;
									$command = $connection->createCommand($sql);
									$InsertLog = $command->execute();
								}
							}
						}
						$department_log_id = Yii::app()->db->getLastInsertID();
						$msglog = "Investor has submitted application";
					}else{
						Yii::app()->user->setFlash('error', "Form Not Submitted Please Try Again!");
						die(var_dump($ForwardLevelmodel->getErrors()));						
					}	
				}
				//Investor log Save
				$modellog = new NewApplicationSubmissionLog();
				$modellog->field_value = json_encode($_POST);
				$modellog->submission_id = $application_id;
				$modellog->application_id = $application_id;
				$modellog->user_id = $model->user_id;
				$modellog->dept_id = @$getDepartMentId['dept_id'];
				$modellog->application_status = 'P';
				if($docFlag == 1)
				{
					$modellog->application_status = 'DP';
				}
				
				//For LM Satus set PD 
				if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')) && empty($_SESSION["uid"]))
				{
					$modellog->application_status = 'PD';
				}
				$modellog->form_id = 1;
				$modellog->service_id = DefaultUtility::dataSenetize($_POST['service_id']);
				$modellog->application_created_date = date('Y-m-d H:i:s');
				$modellog->application_updated_date_time =  date('Y-m-d H:i:s');
				$modellog->ip_address = $_SERVER['REMOTE_ADDR'];
				$modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$modellog->unit_name = '';
				$modellog->landrigion_id = @$landrigion_id;
				if ($modellog->save()) {
					$investor_log_id = Yii::app()->db->getLastInsertID();
				} else {
					die(var_dump($modellog->getErrors()));
				}

				$this->insertApplicationLog(@$_POST['service_id'], 1, @$getDepartMentId['dept_id'], @$application_id, '0', $model->application_status, 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);

				Yii::app()->user->setFlash('success', "Your application for $service_Name has been submitted successfully . Your application id  is : $application_id");
				
				//this is use for backend entry
				if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
					$this->redirect("/backoffice/admin/default/index");
				}
				
				if (isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) 
				{						
					if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')))
					{
						//$this->redirect("/backoffice/frontuser");
						$service_id = $_POST['service_id'];							
						$this->redirect("/backoffice/infowizard/otherServicePayment/UnifiedPayment/service_id/$service_id/app_id/$application_id"); 						
					}else{
						// K SANSI - Redirect to document check list after submit
						$seriveArr = explode(".",$_POST['service_id']);
						$this->redirect("/backoffice/frontuser/ApplyService/DocumentsChecklist/is/no/type/PES?service_id=$seriveArr[0]&sub_service_id=$seriveArr[1]&department_id=$getDepartMentId[dept_id]&swcs_department_id=2&swcs_service_id=$serviceNameArr[swcs_service_id]&new_name=CAF&caf_id=$saved_caf_id&type=Integrated+With+SWCS&ptype=Integrated+With+SWCS&approval_id=@$approval_id");		
						
					}
				}
			} else {
				Yii::app()->user->setFlash('error', "Form Not Submitted Please Try Again!");
				die(var_dump($model->getErrors()));
			}
        }
				 
        //$this->render('saveData');
    }
	
	
	public function actionForwardToApprover(){
		$allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0")->queryRow();
		$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
		
		$ForwardLevelmodel->next_role_id = $allData['next_role_id'];
		$ForwardLevelmodel->verifier_user_id = '0';
		$ForwardLevelmodel->app_Sub_id = $app_Sub_id;
		$ForwardLevelmodel->form_id = $form_id;
		$ForwardLevelmodel->forwarded_dept_id = $v;
		$ForwardLevelmodel->post_info = "";
		$ForwardLevelmodel->verifier_user_comment = "";
		$ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
		$ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s'); 
		$ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$ForwardLevelmodel->comment_date = "";
		$ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
		$ForwardLevelmodel->approv_status = 'P';
        if($ForwardLevelmodel->save()) {			
			Yii::app()->user->setFlash('message', 'Application Forwarded Successfully');
			$this->redirect(Yii::app()->request->urlReferrer);
		}
	}
	
	function getExistingCafDocuments($sno = null,$service_id = null,$dept_id=null,$user_id=null) {       
        $sno = DefaultUtility::dataSenetize($sno);
        $service_id = DefaultUtility::dataSenetize($service_id);
        $dept_id = DefaultUtility::dataSenetize($dept_id);
        $user_id = DefaultUtility::dataSenetize($user_id);
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


    public function actionApplicationView() {
        $array = array(
            'fruit1' => 'apple',
            'fruit2' => 'orange',
            'fruit3' => 'grape',
            'fruit4' => 'apple',
            'fruit5' => 'apple');


        while (current($array)) {
            echo $v = key($array);
            echo '<br />' . $array[$v];

            next($array);
        }
    }

    function actionSubFormListing() {
        @session_start(); 
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;
        $sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();

        $res_caf = array();
        // Get all services list
        $res_s = false;
        $id = false;
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id                         
				  WHERE issuerby_id='$id' AND is_active='Y' ORDER BY service_name ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_s);
            $res_s = $command->queryAll();
        }
        $this->render("subformlisting", array('res_d' => $res_d, 'res_caf' => $res_caf, 'res_s' => $res_s, 'id' => $id));
    }

// jitendra singh
    public function actionSaveAjax() {
        $flag = false;
        $data_arr = array();

        if (isset($_POST) && !empty($_POST)) {
            $criteria = new CDbCriteria;
            $form_id = $_POST['form_id'];
            $service_id = $_POST['service_id'];
            $prefrence = $_POST['prefrence'];
            $form_code = $_POST['form_code'];
            $page_name = $_POST['page_name'];
            $criteria->condition = "form_id=:form_id AND service_id=:service_id AND prefrence=:prefrence ";
            $criteria->params = array(":form_id" => $form_id, ":service_id" => $service_id, ":prefrence" => $prefrence);
            $model = PageMaster::model()->find($criteria);
            if (!$model) {
                $model = new PageMaster;
                $model->created = date('Y-m-d H:m:s');
            } else {
                $model->modified = date('Y-m-d H:m:s');
            }
            $model->form_id = $form_id;
            $model->service_id = $service_id;
            $model->prefrence = $prefrence;
            $model->form_code = $form_code;
            $model->page_name = $page_name;

            //$model->save();

            if ($model->save()) {
                //print_r($model->getErrors());die;
                $flag = true;
                $data_arr = array("page" => $model->page_name, "status" => $flag);
            } else {
                //print_r($model->getErrors());die;
                $flag = false;
                $data_arr = array("page" => '', "status" => $flag);
            }
        }

        echo json_encode($data_arr);
    }

    public function actionGetFormCodeAjax() {

        $result_data = array();
        $page_result = array();
        $page_results = array();
        if (!empty($_POST)) {
            extract($_POST);
            $connection = Yii::app()->db;
            $sql = "SELECT form_code FROM bo_infowiz_page_master where form_id='$form_id' AND service_id='$service_id' AND prefrence='$prefrence' AND is_active='Y' ORDER BY id DESC";
            $command = $connection->createCommand($sql);
            $page_results = $command->queryRow();
        }

        if (empty($page_results)) {

            extract($_POST);
            if (!empty($form_id) && !empty($service_id)) {
                $service_data = explode('.', $service_id);
                $form_code = 'UK-SR-' . str_pad($service_data['0'], 3, '0', STR_PAD_LEFT) . '_' . str_pad($service_data['1'], 2, '0', STR_PAD_LEFT) . '-FRM-' . str_pad($form_id, 2, '0', STR_PAD_LEFT);

                $result_data['data'] = array("form_code" => $form_code, 'status' => true);
            } else {

                $result_data['data'] = array("form_code" => '', 'status' => false);
            }
        } else if ($page_results) {

            $result_data['data'] = array("form_code" => $page_results['form_code'], 'status' => true);
        } else {
            $result_data['data'] == array("form_code" => '', 'status' => false);
        }
        echo json_encode($result_data);
    }

    static function alignInSequence($serviceID = null, $formCodeID = null) {
        //$serviceID = "68.0";
        //Blank array for filtered records
        $additionalCondition = "";
        if (!empty($formCodeID)) {
            $additionalCondition = " AND form_id=$formCodeID ";
        }
        $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination = array();
        // Getting All Active Pages for Form in ASC preference
        $allActivePagesASC = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();

        if (!empty($allActivePagesASC)) {
            foreach ($allActivePagesASC as $pageAsPerPreferenceASC) {
                // Getting All Active Pages for Category ASC preference
                $allActiveCategoriesASC = Yii::app()->db->createCommand("SELECT category_id FROM bo_page_category_mapping where page_id=$pageAsPerPreferenceASC[id]  AND is_active='Y' order by prefrence ASC")->queryAll();
                if (!empty($allActiveCategoriesASC)) {
                    foreach ($allActiveCategoriesASC as $categoryAsPerPreferenceASC) {
                        // Getting All Active Form field ASC
                        $allActiveMappedFormFieldASC = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' order by preference+0 ASC")->queryAll();

                        if (!empty($allActiveMappedFormFieldASC)) {
                            foreach ($allActiveMappedFormFieldASC as $formfieldAsPerPrefernceASC) {
                                $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination[] = $formfieldAsPerPrefernceASC;
                            }
                        }
                    }
                }
            }
        }
        return $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination;
    }

    public function actionSubFormView() {
        if (!empty($_GET['service_id'])) {
            $serviceID = "'" . DefaultUtility::dataSenetize($_GET['service_id']) . "'";
            $formCodeID = DefaultUtility::dataSenetize($_GET['formCodeID']);


            // Getting all active land records  
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();
            extract($_GET);

            $formData = $this->alignInSequence($service_id, $formCodeID);

            /* echo "<pre>";
              print_r($formData);die(); */
            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id = $subID")->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
        }
        $this->render('subformview', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2));
    }

    public function actionDepartmentFormView() {

        if (!empty($_GET['service_id'])) {
            $serviceID = "'" . DefaultUtility::dataSenetize($_GET['service_id']) . "'";
			//$formCodeID = $_GET['formCodeID'];
            $applicantFormId = 1;
            //Getting all active land records  
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $applicantFormId order by prefrence ASC")->queryAll();

            $formData = $this->alignInSequence($_GET['service_id'], $applicantFormId);
            extract($_GET);

            $allProcessingFormFieldsArr = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();

            $processingformData = $this->alignInSequence($_GET['service_id'], $formCodeID);
            //exit($subID);
            //echo "<pre>";
            //print_r($processingformData); die;

            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$subID")->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);

            //$formCodeID = $_GET['formCodeID'];	
        }
        $this->render('departmentview', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'processingformData' => $processingformData));
    }

    public function actionSaveDepartmentData() {
        
    }

    public function actionUpdateSubForm() {

        if (!empty($_GET['service_id'])) {
			extract($_GET);
            $serviceID = "'" . DefaultUtility::dataSenetize($_GET['service_id']) . "'";
            $formCodeID = DefaultUtility::dataSenetize($_GET['formCodeID']);
			// echo "<pre>";
			// print_r($_POST);
			// print_r($_GET);
			// die(); 
             
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();
            extract($_GET);
            $formData = $this->alignInSequence($service_id, $formCodeID);
          /*  echo "<pre>";
              print_r($formData);die();  */
            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id = $subID")->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
        }
        $this->render('updatesubform', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'serviceID' => $_GET['service_id'], 'issuer_id' => @$issuer_id));
    }

    public function actionSaveUpdateSubForm() {
		/* echo "<pre>";
		print_r($_POST);
		die; */
        if (isset($_POST) && !empty($_POST)) {
			
            extract($_POST);

            $submission_id = DefaultUtility::dataSenetize($_POST['submission_id']);
			$rbiflag='submitted';
			$currentAppStatus = Yii::app()->db->createCommand("SELECT application_status FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();
			if($currentAppStatus['application_status']=='H'){				
				$rbiflag='resubmitted';				
			}	
			
            unset($_POST['submission_id']);
            //echo "<pre/>"; print_r($_POST);
            //die();
            $_POST = $this->my_array_map('trim', $_POST);
			
            $postData = json_encode($_POST);			
            $postData=DefaultUtility::sanatizeParams($postData);
			$stat = 'P';
			$docFlag = 0;
			$abyeFlag = 0; 	
			
			//Check document exist or not
			$sno = $this->getSnoBySubmissionId($submission_id,'sno');			
			$documentExistCheck = Yii::app()->db->createCommand("SELECT * FROM bo_application_dms_documents_mapping where sno=$sno")->queryRow();
			if(empty($documentExistCheck) && $service_id=='591.0')
			{
				$stat = 'DP';
				$docFlag = 1;			
			}
			//For check fee applicable or not and paid or not for service
			$sqlCheckFeeAplicable = Yii::app()->db->createCommand("SELECT id,fee_detail FROM bo_information_wizard_service_fee WHERE service_id = $service_id")->queryRow();
			$user_id = $_SESSION['RESPONSE']['user_id'];
			
			$sqlCheckPaymentPaidorNot = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_unified_payment_logs WHERE service_id = '$service_id' AND submission_id = '$submission_id' AND user_id= '$user_id' AND status='S'")->queryRow();
		
			
			$pdsatus = 0;
			if(!empty($sqlCheckFeeAplicable['fee_detail']) && empty($sqlCheckPaymentPaidorNot['total']) && empty($_SESSION["uid"]))
			{
				$stat = 'PD';
				$pdsatus = 1;
			}
			
            $updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set field_value='$postData',application_status='$stat' where submission_id='$submission_id'")->execute();
			
            $allData = Yii::app()->db->createCommand("SELECT submission_id,application_id,service_id,user_id,dept_id,form_id,unit_name,application_status,	application_created_date,application_updated_date_time,ip_address,user_agent,landrigion_id FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();
			            
            $serviceID = $allData['service_id'];			
			$sptagData = Yii::app()->db->createCommand("SELECT service_provider_tag FROM sso_service_providers where department_id IN (select dept_id from bo_new_application_submission where service_id='$serviceID')")->queryRow(); 
			$service_provider_tag =	$sptagData['service_provider_tag'];
			
			$serviceData= $this->getSnoBySubmissionId($submission_id,'processing_level');
			$process_levelQ = "";
			if(isset($serviceData['processing_level']) && !empty($serviceData['processing_level'])){	
				$process_level = $serviceData['processing_level'];
				$process_levelQ = "  AND processing_level =  $process_level";
			}
			
            $resArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0 $process_levelQ")->queryRow();
         		
			$department_log_id = 0;
			if($docFlag == 0 && $pdsatus==0)
			{
					
				$ForwardLevelmodel = new FormbuilderApplicationForwardLevel();				
				$ForwardLevelmodel->next_role_id = $resArr['next_role_id'];
				$ForwardLevelmodel->verifier_user_id = 0;
				$ForwardLevelmodel->app_Sub_id = $allData['submission_id'];
				$ForwardLevelmodel->forwarded_dept_id = $allData['dept_id'];
				$ForwardLevelmodel->post_info = "";
				$ForwardLevelmodel->verifier_user_comment = '';
				$ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
				$ForwardLevelmodel->updated_date_time = date('Y-m-d H:i:s');
				$ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$ForwardLevelmodel->comment_date = "";
				$ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
				$ForwardLevelmodel->approv_status = 'P';
				$ForwardLevelmodel->save();
				$department_log_id = Yii::app()->db->getLastInsertID();
			}	
			/* Save Log Data After Update Application */
			$modellog = new NewApplicationSubmissionLog();

			$modellog->field_value = json_encode($_POST);
			$modellog->submission_id = $allData['submission_id'];
			$modellog->user_id = $_SESSION['RESPONSE']["user_id"];
			$modellog->dept_id = $allData['dept_id'];
			$modellog->application_status = $allData['application_status'];
			$modellog->form_id = $allData['form_id'];
			$modellog->service_id = $allData['service_id'];
			$modellog->application_created_date = $allData['application_created_date'];
			$modellog->application_updated_date_time = date('Y-m-d');
			$modellog->ip_address = $_SERVER['REMOTE_ADDR'];
			$modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
			$modellog->unit_name = $allData['unit_name'];
			$modellog->landrigion_id = $allData['landrigion_id'];
			//	echo "<pre>"; print_r($modellog);die;
			if($modellog->save()) {
				$investor_log_id = Yii::app()->db->getLastInsertID();
				$msglog = "Investor has $rbiflag the application";
				
				//Update Data IN bo_sp_application for log
				$currentDate = date('Y-m-d H:i:s');
				$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($allData['service_id']);
				
				// This is use for LM Department to assign circle wise application
				$resArrLM = Yii::app()->db->createCommand("SELECT CONCAT(service_id,'.',servicetype_additionalsubservice) as service_id FROM `bo_information_wizard_service_parameters` WHERE `department_id` = '26' AND `is_active` = 'Y'")->queryAll(); 
				$serviceLmArr = array();
				if(isset($resArrLM) && !empty($resArrLM))
				{
					foreach($resArrLM as $key=>$val){
						$serviceLmArr[] =	$val['service_id'];
					}
					if(isset($serviceLmArr) && !empty($serviceLmArr))
					{	
						if(in_array($allData['service_id'],$serviceLmArr)){
							
							if(isset($_POST['UK-FCL-00232_0']) && !empty($_POST['UK-FCL-00232_0']))
							{
								$circle_id = $_POST['UK-FCL-00232_0'];
								
								$npUserArr = Yii::app()->db->createCommand("SELECT np_user_id FROM bo_user WHERE circle_id = '$circle_id' AND is_active = '1'")->queryRow(); 
								$assigned_to = '';
								$circle_id = '';
								if(isset($npUserArr) && !empty($npUserArr))
								{
									$assigned_to = $npUserArr['np_user_id'];
									$circle_id = @$_POST['UK-FCL-00232_0'];
								}	
							}				
						}
					}	
				}
				// End of use for LM Department to assign circle wise application
				if(in_array($_POST['service_id'],array('119.0','226.0','227.0','228.0')))
				{
					$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='$msglog',app_status='".$allData['application_status']."',updated_on='$currentDate',assigned_to='$assigned_to',circle_id='$circle_id' WHERE app_id='".$allData['submission_id']."' AND sp_tag='$service_provider_tag'";
					$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
				}
				
				$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='".$allData['submission_id']."' AND sp_tag='$service_provider_tag'";
				$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();
				
				if(!empty($applicationDetail)) 
				{

					if(empty($allData['application_status'])){$allData['application_status']=$stat;}
					//Save Data IN bo_sp_application_history for log
					$modelSPH = new SpApplicationHistory;
					$modelSPH->sp_app_id = $applicationDetail['sno'];
					$modelSPH->service_id = $applicationDetail['sp_app_id'];
					$modelSPH->sp_tag = $applicationDetail['sp_tag'];
					$modelSPH->app_id = $applicationDetail['app_id'];
					$modelSPH->application_status =$allData['application_status'];
					$modelSPH->comments = "$msglog";
					$modelSPH->added_date_time = date('Y-m-d H:i:s');
					
					if($modelSPH->save())
					{
						
					}else{
						die(var_dump($modelSPH->getErrors()));
					}
					//END Save Data IN bo_sp_application_history for log				
				}
				//END Update Data IN bo_sp_application for log
				
				
				$this->insertApplicationLog(@$allData['service_id'], @$allData['form_id'], @$allData['dept_id'], @$allData['submission_id'], '0', @$allData['application_status'], 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);
				Yii::app()->user->setFlash('success', "Your application has been updated successfully.");
				
			   // $this->redirect('/backoffice/frontuser');
				$serviceIDArr = explode(".",$serviceID);		
				/* if($allData['service_id']!='591.0')
				{ */
						
				if($pdsatus == 1)
				{
					$this->redirect("/backoffice/infowizard/otherServicePayment/UnifiedPayment/service_id/$service_id/app_id/$allData[submission_id]");
				}else{						
					$this->redirect("/backoffice/frontuser");
				}	
					
				// }else{ 	
					// $this->redirect("/backoffice/frontuser/ApplyService/DocumentsChecklist/is/no/type/PES?service_id=$serviceIDArr[0]&sub_service_id=$serviceIDArr[1]&department_id=$allData[dept_id]&swcs_department_id=2&swcs_service_id=419&new_name=CAF&caf_id=$submission_id&type=Integrated+With+SWCS&ptype=Integrated+With+SWCS&approval_id=$approval_id");	
				// } 
			} else {
				print_r($modellog->getErrors());
				die();
			}
            
        }
    }

    public function my_array_map($function, $arrary) {
        $result = array();
        foreach ($arrary as $key => $val) {
            $result[$key] = (is_array($val) ? $this->my_array_map($function, $val) : $function($val));
        }
        return $result;
    }

    public static function insertApplicationLog($service_id = null, $form_id = null, $core_department_id = null, $app_Sub_id = null, $department_user_id = null, $action_status = null, $action_taken_by_name = null, $action_message = null, $investor_id = null, $comment = null, $investor_log_id = null, $department_log_id = null) {
		$service_id = DefaultUtility::dataSenetize($service_id);
        $form_id = DefaultUtility::dataSenetize($form_id);
        $core_department_id = DefaultUtility::dataSenetize($core_department_id);
        $app_Sub_id = DefaultUtility::dataSenetize($app_Sub_id);
        $department_user_id = DefaultUtility::dataSenetize($department_user_id);
        $action_status = DefaultUtility::dataSenetize($action_status);
        $action_taken_by_name = DefaultUtility::dataSenetize($action_taken_by_name);
        $action_message = DefaultUtility::dataSenetize($action_message);
        $investor_id = DefaultUtility::dataSenetize($investor_id);
        $comment = DefaultUtility::dataSenetize($comment);
        $investor_log_id = DefaultUtility::dataSenetize($investor_log_id);
        $department_log_id = DefaultUtility::dataSenetize($department_log_id);
		//die('here');
        $model = new FormBuilderApplicationLog;
        $model->service_id = $service_id;
        $model->form_id = $form_id;
        $model->core_department_id = $core_department_id;
        $model->app_Sub_id = $app_Sub_id;
        $model->department_user_id = $department_user_id;
        $model->action_status = $action_status;
        $model->action_taken_by_name = $action_taken_by_name;
        $model->action_message = $action_message;
        $model->investor_id = $investor_id;
        $model->department_comment = $comment;
        $model->investor_log_id = $investor_log_id;
        $model->dept_log_id = (@$department_log_id) ? @$department_log_id : 0;
        $model->created = date('Y-m-d H:i:s');
		/* echo "<pre>";
		print_r($model);die; */
        if ($model->save()) {
            return true;
        } else {
           var_dump($model->getErrors());die;
        }
    }

    public function actionApplicationTimeline() {
        $this->render('application_timeline');
    }

    public function actionDownloadNewApp() {
        @session_start();
       extract($_GET);
             $subID = DefaultUtility::dataSenetize($subID);
             $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id =   $subID")->queryRow();

      if (!empty($_GET['service_id']) && ((isset($_SESSION['RESPONSE']['user_id']) && $_SESSION['RESPONSE']['user_id']==$fieldValues['user_id']) || isset($_SESSION['role_id']) || isset($_POST['is_api_user']))) {
                $serviceID = "'" . DefaultUtility::dataSenetize($_GET['service_id']) . "'";
            $formCodeID = DefaultUtility::dataSenetize($_GET['formCodeID']);


            // Getting all active land records  
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();
           

            $formData = $this->alignInSequence($service_id, $formCodeID);            
            
            $fieldValues2 = (array)json_decode($fieldValues['field_value']);
            $signatoryDetails=Yii::app()->db->createCommand("SELECT * FROM bo_signature_metadata where submission_id = $subID and is_active=1")->queryAll();
        
			
		$content = $this->renderPartial('caf_pdf_view', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['application_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);
        $name = "UK-Application_Form_" . time() . ".pdf";
		
        //echo $content; die;
        Utility::generatePdfApp($content, $name);
         exit;
        }else{
            throw new Exception("Sorry You Can't access this page", 1);            
        }
    }

    public function actionProcessedApplication() {
        $this->render('process_application');
    }

    public function actionDeptProcessedApp() {
        $this->render('dept_process_application');
    }

    public function actionGenerateCertificate() {
        $service_id = DefaultUtility::dataSenetize($_GET['service_id']);
        $dept_id = DefaultUtility::dataSenetize($_GET['dept_id']);
        if (!empty($_POST)) {
            $model = new BoInfowizFormBuilderCertificate;
            $getContentExist = Yii::app()->db->createCommand("SELECT count(*) as tot FROM bo_infowiz_form_builder_certificate where service_id='$service_id' AND dept_id='$dept_id'")->queryRow();
			$content = $_POST['content'];
			
            if ($getContentExist['tot'] > 0 ) {die;
                $updated = date('Y-m-d H:i:s');
                $updateNewApplication = Yii::app()->db->createCommand("update bo_infowiz_form_builder_certificate set content='$content',updated='$updated' where service_id='$service_id' and dept_id='$dept_id'")->execute();
                Yii::app()->user->setFlash('success', "Your content update successfully.");
            } else {
                $model->content = $content;
                $model->created = date('Y-m-d H:i:s');
                $model->dept_id = $dept_id;
                $model->service_id = $service_id;
				
                if($model->save())
				{				
					Yii::app()->user->setFlash('success', "Your content saved successfully.");
				}else{
					die(var_dump($model->getErrors()));
				}	
            }
            $this->redirect('/backoffice/infowizard/subForm/generateCertificate/service_id/' . $service_id . '/dept_id/' . $dept_id);
        }
        $getContentArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id='$service_id' AND dept_id='$dept_id'")->queryRow();

        $this->render('generate_certificate', array('getContentArr' => $getContentArr));
    }

    function actionFView() {
        $service_id = '24.0';
        $sub_id = '62';
        $applicantFormId = 1;
        $this->render('f_view', array('service_id' => $service_id, 'sub_id' => $sub_id, 'applicantFormId' => $applicantFormId));
    }
	
	function actionRedirectToDashBoard() {
		
		Yii::app()->user->setFlash('success', "Your application  has been submitted successfully.");
		// K SANSI - Redirect to document check list after submit
		$this->redirect("/backoffice/frontuser/home/investorWalkthrough");							
	}					
						
	function actionSaveAllDocuments(){
		
		extract($_GET);
		$this->getExistingCafDocuments($sno,$service_id,$_SESSION['RESPONSE']['user_id']);			
		$getSubMissionData = Yii::app()->db->createCommand("SELECT app_id FROM bo_sp_applications where sno='$sno'")->queryRow();		
		$uid=$_SESSION['RESPONSE']['user_id'];
		$iuid=$_SESSION['RESPONSE']['iuid'] ;
		$applicationID=$getSubMissionData['app_id'];
		$ReferenceKey=($iuid+$applicationID)*$uid;
		echo $PaymentReferenceKey = base64_encode($ReferenceKey);	die;
	}
	
	public static function SavePDF($url,$path) {	    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $data = curl_exec($ch);	
      
		if (curl_error($ch)) {
			/* echo $http_status = curl_getinfo($url, CURLINFO_HTTP_CODE);
			 $error_msg = curl_error($ch);
			echo "===========";print_r( $error_msg);print_r($data);die; */
		}
		curl_close($ch);
        $result = file_put_contents($path, $data);

        if (!$result) {
            return "error";
        } else {
            return "success";
        }
	
    }
}
