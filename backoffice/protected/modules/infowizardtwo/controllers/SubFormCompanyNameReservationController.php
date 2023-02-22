<?php

class SubFormCompanyNameReservationController extends Controller {

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
    


    private function getSnoBySubmissionId($appSubID = null, $val = null) {
        $sqlspapp = "Select bo_sp_applications.sno,bo_sp_applications.sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,
	bo_new_application_submission.processing_level from bo_sp_applications
			INNER JOIN  bo_new_application_submission 
			ON bo_new_application_submission.submission_id=bo_sp_applications.app_id 
			INNER JOIN  sso_service_providers 
			ON bo_new_application_submission.dept_id=sso_service_providers.department_id 		
			where bo_sp_applications.app_id='$appSubID' AND sso_service_providers.service_provider_tag=bo_sp_applications.sp_tag";
        $result = Yii::app()->db->createCommand($sqlspapp)->queryRow();
        if (isset($result))
            return $result[$val];
        else
            return false;
    }

    public function actionProcessData() {
		/* echo "<pre>";		
          print_r($_POST);
          die();  */

        //$allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_infowiz_formbuilder_application_forward_level' AND is_active='Y'")->queryAll();
        $current_role_id = $_SESSION['role_id'];
        $serviceID = $_POST['service_id'];
        $app_Sub_id = $_POST['app_Sub_id'];

        $allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where (service_id=$serviceID OR service_id=0) AND is_active='Y' AND table_name='bo_infowiz_formbuilder_application_forward_level' order by id desc")->queryAll();

        $allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id='$current_role_id' AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
        $canRevToInves = $allData['can_revert_to_investor'];
        $CurrentallData = $allData;
        if ($_POST['app_status'] == 'F') {
            $allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id=$current_role_id AND forward_role_id > 0 AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
        }

        $sptagData = Yii::app()->db->createCommand("SELECT service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id IN (select dept_id from bo_new_application_submission where service_id='$serviceID' )")->queryRow();
     
        $app_status = $_POST['app_status'];
       
        $configArr = array();

        $postedKeys = array_keys($_POST);

        if (isset($allRes) && !empty($allRes)) {
            //$dept = array();
            foreach ($allRes as $key => $val) {
                if (!in_array($val['use_for'], $configArr) && in_array($val['formvar_code'], $postedKeys)) {
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
            // Template comment
			
            if(isset($_POST['UK-FCL-00034_0']) && $_POST['UK-FCL-00034_0']=='Select From Template' && isset($_POST['UK-FCL-00035_0']) && !empty($_POST['UK-FCL-00035_0'])) 
			{
				$templateID = $_POST['UK-FCL-00035_0'];
				$templateArr=Yii::app()->db->createCommand("SELECT template FROM bo_templates where id='$templateID'")->queryRow();
                $comment = $templateArr['template'];
            }

            $comment = DefaultUtility::sanatizeParams($comment);

          /*  echo "<pre>";
			print_r($_POST);die; */
            $deptName = "";
            if (isset($dept) && !empty($dept)) {
                if (is_array($dept)) {
                    $deptStr = implode(",", $dept);
                } else {
                    $dept2[0] = $dept;
                    $deptStr = implode(",", $dept2);
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
            
            $form_id = $_POST['form_id'];
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
                foreach ($dept as $k => $v) {
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
                    $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='$msglog ',app_status='" . $_POST['app_status'] . "',updated_on='$currentDate' WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
                    $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

                    $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
                    $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

                    if (!empty($applicationDetail)) {
                        //Save Data IN bo_sp_application_history for log
                        $modelSPH = new SpApplicationHistory;
                        $modelSPH->sp_app_id = $applicationDetail['sno'];
                        $modelSPH->service_id = $applicationDetail['sp_app_id'];
                        $modelSPH->sp_tag = $applicationDetail['sp_tag'];
                        $modelSPH->app_id = $applicationDetail['app_id'];
                        $modelSPH->application_status = $_POST['app_status'];
                        $modelSPH->comments = "$msglog";
                        $modelSPH->added_date_time = date('Y-m-d H:i:s');
                        if ($modelSPH->save()) {
                            
                        } else {
                            die(var_dump($modelSPH->getErrors()));
                        }
                        //END Save Data IN bo_sp_application_history for log				
                    }
                    //END Update Data IN bo_sp_application for log

                    $this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'], @$_POST['app_status'], @$_SESSION['uname'], @$msglog, 0, @$comment, '', $department_log_id);
                    //DefaultUtility::SendSMSEmailGlobalCAF2('CAF','CAF verifier forwarded the CAF to departments for their comments',@$_POST['app_Sub_id'],$v); 
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
              echo $flag;die(); */

            if (isset($flag) && $flag == 1) {

                $supportive_document ="";
				if(!empty($_FILES)) 
				{
					if($_FILES['supportive_document']['name'] != '' && $_FILES['supportive_document']['size'] <= (1024 * 1024 * 5)) 
					{		
						$file_name = strtolower($_FILES['supportive_document']['name']);
						$ext = pathinfo($file_name, PATHINFO_EXTENSION);
						$path = $_SERVER['DOCUMENT_ROOT']."/themes/backend/supportive_documents/";
						$supportive_document = "Supportive_Doc_".$app_Sub_id.'_'.time().".".$ext;
						move_uploaded_file($_FILES['supportive_document']['tmp_name'], $path . $supportive_document);						
					}
				}
                $comment_date = date('Y-m-d H:i:s');

                $res = Yii::app()->db->createCommand("Select appr_lvl_id from bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id AND approv_status='P' order by appr_lvl_id DESC")->queryRow();
                $department_log_id = $res['appr_lvl_id'];

                $updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" . $comment . "',support_document='$supportive_document',comment_date='$comment_date',updated_date_time='$comment_date',post_info='$postData',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id")->execute();


                if ($allData['can_revert_to_investor'] == 'Y' && $app_status != 'V') {
                    $updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='$app_status' where submission_id=$app_Sub_id")->execute();
                }
            }
            if ($_POST['app_status'] == 'F') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been forwarded to $deptName");
            }
            if ($_POST['app_status'] == 'H') {
				$AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
				$this->SendNotification($_SESSION['uid'],$_SESSION['role_id'],$AppData['user_id'],'0','Application Reverted',$comment,'Reverted');
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been reverted to applicant.");
                $msglog = "Application Id : $app_Sub_id has been reverted.<br/>
						Comment: $comment";
                $reverted_call_back_url = "/backoffice/infowizardtwo/subFormCompanyNameReservation/updateSubForm/service_id/" . $_POST['service_id'] . "/pageID/1/subID/" . $_POST['app_Sub_id'] . "/formCodeID/1";
            }
            if ($_POST['app_status'] == 'A') {
                $company_reg_no = NULL;
                $recomend=explode("#",$_POST['check_status']);
				
                $msglog = "Application Id : $app_Sub_id has been approved successfully.<br/>
						Comment: $comment";
                $updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='$app_status' where submission_id=$app_Sub_id")->execute();
				
				$newAppSub = Yii::app()->db->createCommand("select * from bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
				$newAppSubArr = json_decode($newAppSub['field_value'],true);
                $currentDate = date('Y-m-d H:i:s');
                $d_url = "";
				
				
				$RecomendedNamemodel = new RecomendedName();
				$RecomendedNamemodel->submission_id = $app_Sub_id;
				$RecomendedNamemodel->bo_user_id = $_SESSION['uid'];
				$RecomendedNamemodel->role_id = $_SESSION['role_id'];
				
				$RecomendedNamemodel->recomended_name =$recomend[1];
				$RecomendedNamemodel->recomended_value = $recomend[0];
				$RecomendedNamemodel->created = date('Y-m-d H:i:s');
				$RecomendedNamemodel->modified = date('Y-m-d H:i:s');
 				
				
				//print_r($newAppSubArr['UK-FCL-00044_0']);die;
                if($_POST['service_id'] == '2.0' && $newAppSubArr['UK-FCL-00044_0']==3) {
					
					$companyDetail = new BoCompanyDetails;
					$address2 = '';
					$address3 = '';
					$address4 = '';
					$address5 = '';
					$address1 = $newAppSubArr['UK-FCL-00062_0'];
					if(isset($newAppSubArr['UK-FCL-00062_0']) && !empty($newAppSubArr['UK-FCL-00062_0']))
					{
						$address2 = ', '.$newAppSubArr['UK-FCL-00062_0']; 
					}
					if(isset($newAppSubArr['UK-FCL-00330_0']) && !empty($newAppSubArr['UK-FCL-00330_0']))
					{
						$address3 = ', '.$newAppSubArr['UK-FCL-00330_0']; 
					}
					if(isset($newAppSubArr['UK-FCL-00060_0']) && !empty($newAppSubArr['UK-FCL-00060_0']))
					{			
						$parishID = $newAppSubArr['UK-FCL-00060_0'];
						$parishArr = Yii::app()->db->createCommand("select * from bo_landregion where lr_id='$parishID'")->queryRow();
						$address4 = ', '.$parishArr['lr_name']; 
					}
					if(isset($newAppSubArr['UK-FCL-00061_0']) && !empty($newAppSubArr['UK-FCL-00061_0']))
					{			
						$postalID = $newAppSubArr['UK-FCL-00061_0'];
						$postalArr = Yii::app()->db->createCommand("select * from bo_postalcode_in_barbados where id='$postalID'")->queryRow();
						$address5 = ', '.$postalArr['district'].'-'.$postalArr['code'].', Barbados'; 
					}
					$c_type = 'BUS';
					$cdmaxid = BoCompanyDetails::getreg_no($c_type);
					//$maxid = "BBC".date('Y').(str_pad($cdmaxid['max'], 6, '0', STR_PAD_LEFT));
					$maxid = $cdmaxid;
					$companyDetail->srn_no = $_POST['app_Sub_id'];
					$companyDetail->name_related_srn = 0;
					$companyDetail->service_id = $_POST['service_id'];
					$companyDetail->company_type = 'BUS';
					$companyDetail->reg_no = $maxid;
					$companyDetail->company_name = $recomend[0];
					$companyDetail->user_id = $newAppSub['user_id'];
					$companyDetail->approved_by = $_SESSION['uid'];  
					$companyDetail->address = $address1.''.@$address2.''.@$address3.''.@$address4.''.@$address5;
					$companyDetail->save();
				$company_reg_no = $companyDetail->reg_no;
                    $data = '';
                    $path = '';
                    $name = "CERTIFICATE_" . $app_Sub_id . ".pdf";
					//$reg_no = '45000'.$app_Sub_id;
					$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
					
					$uid = $_SESSION['uid'];
					
					
					
					$download_certificate_call_back_url1 = CURL_URL."/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate2_0/service_id/" . base64_encode($_POST['service_id']) . "/subID/" . base64_encode($_POST['app_Sub_id']) . "/dept_id/" . base64_encode($dept_id).'/reg_no/'.base64_encode($maxid).'/approved_id/'.base64_encode($uid);
					
					$path = Yii::app()->basePath . "/caipo_certificate/" . $name;
					
                    $download_certificate_call_back_url = BASE_URL."/backoffice/protected/caipo_certificate/" . $name;
                    $res = $this->SavePdf($download_certificate_call_back_url1, $path);
					
                    $d_url = BASE_URL."/backoffice/protected/caipo_certificate/CERTIFICATE_" . $app_Sub_id . '.pdf';
                }
				/* echo $newAppSubArr['UK-FCL-00492_0'];
				echo "<br/>";
				die($newAppSubArr['UK-FCL-00044_0']); */
				//echo $newAppSubArr['UK-FCL-00492_0'];
				if($_POST['service_id'] == '2.0' && isset($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==2 && isset($newAppSubArr['UK-FCL-00492_0']) && $newAppSubArr['UK-FCL-00492_0']==1 && $newAppSubArr['UK-FCL-00032_0']!=3) 
				{
					
					$data = '';
					$path = '';
					$name = "CERTIFICATE_" . $app_Sub_id . ".pdf";

					$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
					
					$reg_no = @$newAppSubArr['UK-FCL-00019_0'];
					
					$uid = $_SESSION['uid'];
					
					
					$download_certificate_call_back_url1 = CURL_URL."/backoffice/infowizardtwo/subFormPdf/SaveExternalCompanyApprovalCertificate2_0/service_id/" . base64_encode($_POST['service_id']) . "/subID/" . base64_encode($_POST['app_Sub_id']) . "/dept_id/" . base64_encode($dept_id)."/approved_name/".base64_encode($recomend[0])."/reg_no/".$reg_no.'/approved_id/'.base64_encode($uid);
					$path = Yii::app()->basePath . "/caipo_certificate/" . $name;

					$download_certificate_call_back_url = BASE_URL."/backoffice/protected/caipo_certificate/" . $name;
					$res = $this->SavePdf($download_certificate_call_back_url1, $path);
					$d_url = BASE_URL."/backoffice/protected/caipo_certificate/CERTIFICATE_" . $app_Sub_id . '.pdf';
				
				}
				
				//After confirmation from kajal certificate will not generate from FO user it will be genrate from BO User side when revoke process
				/* if($_POST['service_id'] == '2.0' && $newAppSubArr['UK-FCL-00032_0']=='3' && $newAppSubArr['UK-FCL-00044_0']=='2') 
				{
					$data = '';
					$path = '';
					$name = "CERTIFICATE_" . $_POST['app_Sub_id'] . ".pdf";
									
					$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
					
					$uid = $_SESSION['uid'];
					$boUser=Yii::app()->db->createCommand("SELECT * FROM bo_user where uid='$uid'")->queryRow(); 
					$username = @$boUser['full_name'].' '.@$boUser['last_name'];
					$username = 'TAMIESHA ROCHESTER';
					
					$download_certificate_call_back_url1 = $actual_link."/backoffice/infowizardtwo/subFormPdf/SaveRevokeApprovalCertificate2_0/service_id/" . base64_encode($_POST['service_id']) . "/subID/" . base64_encode($_POST['app_Sub_id']) . "/dept_id/" . base64_encode(1).'/companynewname/'.base64_encode($recomend[0]).'/company_no/'.base64_encode($_POST['UK-FCL-00019_0']).'/uname/'.base64_encode($username);
					
					
					$path = Yii::app()->basePath . "/caipo_certificate/" . $name;

					$download_certificate_call_back_url = BASE_URL."/backoffice/protected/caipo_certificate/" . $name;
					$res = $this->SavePdf($download_certificate_call_back_url1, $path);
					$d_url = BASE_URL."/backoffice/protected/caipo_certificate/CERTIFICATE_" . $_POST['app_Sub_id'] . '.pdf';
                } */
				
				
				if($RecomendedNamemodel->save()) 
				{
					if(isset($_POST['UK-FCL-00044_0']) && $_POST['UK-FCL-00044_0']==1)
					{
						$banned_words_type = 'SOCIETY_NAME';
					}
					if(isset($_POST['UK-FCL-00044_0']) && $_POST['UK-FCL-00044_0']==2)
					{
						$banned_words_type = 'COMPANY_RESERVED';
					}
					if(isset($_POST['UK-FCL-00044_0']) && $_POST['UK-FCL-00044_0']==3)
					{
						$banned_words_type = 'BUSINESS_NAME';
					}
					$ReservedNamemodel = new ReservedName();
					$ReservedNamemodel->banned_words_name = $recomend[0];
					$ReservedNamemodel->banned_words_type = $banned_words_type;
					$ReservedNamemodel->status = 'Y';
					$ReservedNamemodel->process_from = 'SYSTEM';
					$ReservedNamemodel->created = date('Y-m-d H:i:s');
					$ReservedNamemodel->app_id = $app_Sub_id;
					if($ReservedNamemodel->save())
					{					
						$AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
						$this->SendNotification($_SESSION['uid'],$_SESSION['role_id'],$AppData['user_id'],'0','Application Approved',$comment,'Approved');
						
						$serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET download_certificate_call_back_url = '$d_url', application_updated_date_time='$currentDate', entity_name='".$company_reg_no."' WHERE submission_id='$app_Sub_id'";
						$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
						Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been approved successfully.");
					}else{
						die(var_dump($ReservedNamemodel->getErrors()));
					}
				}else{
					die(var_dump($RecomendedNamemodel->getErrors()));
				}
            }
            if ($_POST['app_status'] == 'R') {
				$AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
                $update_date = date('Y-m-d H:i:s');
                $sql_update = "UPDATE bo_new_application_submission SET application_status='R' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
                        $updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
				$this->SendNotification($_SESSION['uid'],$_SESSION['role_id'],$AppData['user_id'],'0','Application Rejected',$comment,'Rejected');
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been rejected.");
                $msglog = "Application Id : $app_Sub_id has been rejected.";

                Rejectapplication::refundrequest($app_Sub_id);
               // die();
            }

            if ($_POST['app_status'] == 'V') {

                $total_data = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$app_Sub_id AND approv_status='P' AND next_role_id=$current_role_id")->queryRow();
                /* echo $total_data['total'];
                  die(); */
                if ($total_data['total'] == 0) {
                    $update_date = date('Y-m-d H:i:s');
                    if (isset($canRevToInves) && $canRevToInves == 'Y') {
                        $sql_update = "UPDATE bo_new_application_submission SET application_status='P' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
                        $updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
                    }
                    $AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();

                    $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                    $ForwardLevelmodel->next_role_id = $allData['next_role_id'];
                    $ForwardLevelmodel->verifier_user_id = '';
                    $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                    //check for internal user forward then assign assign again to department
                    if (isset($_SESSION) && $_SESSION['role_id'] == 83) {
                        $ForwardLevelmodel->forwarded_dept_id = $dept_id;
                    } else {
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
                if ($_POST['app_status'] == 'H') {
                    $app_status = 'RBI';
                } else if ($_POST['app_status'] == 'P') {
                    $comment_date = date('Y-m-d H:i:s');
					
					$supportive_document ="";
					if(!empty($_FILES)) 
					{	/* print_r($_FILES);die; */
						if($_FILES['supportive_document']['name'] != '' && $_FILES['supportive_document']['size'] <= (1024 * 1024 * 5)) 
						{		
							$file_name = strtolower($_FILES['supportive_document']['name']);
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$path = $_SERVER['DOCUMENT_ROOT']."/themes/backend/supportive_documents/";
							$supportive_document = "Supportive_Doc_".$app_Sub_id.'_'.time().".".$ext;
							move_uploaded_file($_FILES['supportive_document']['tmp_name'], $path . $supportive_document);						
						}
					}
					
                    $updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" . $comment . "',comment_date='$comment_date',support_document='$supportive_document',updated_date_time='$comment_date',post_info='$postData',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id")->execute();


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
                    //$ForwardLevelmodel->comment_date = "";
                    $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                    $ForwardLevelmodel->approv_status = 'P';
                    /* echo "<pre>";
                      print_r($ForwardLevelmodel);die; */
                    if ($ForwardLevelmodel->save()) {
                        $flag = 1;
                        $department_log_id = Yii::app()->db->getLastInsertID();
                    }
                    $msglog = "Application has been reverted to nodal.<br/>
						Comment: $comment";
                    $app_status = 'P';
                    $update_date = date('Y-m-d H:i:s');
                    $sql_update = "UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
                    $updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
                } else {
                    $app_status = $_POST['app_status'];
                }
                $serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);

                 // BY:- Aamir Date :- 19-08-2021 

                /*$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='$msglog ',app_status='$app_status',updated_on='$currentDate',reverted_call_back_url='$reverted_call_back_url',download_certificate_call_back_url='$download_certificate_call_back_url' WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
                $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

                $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_Sub_id AND sp_tag='$sptagData[service_provider_tag]'";
                $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();*/
                $serviceApplication = "Select * FROM  bo_new_application_submission WHERE submission_id=$app_Sub_id";
                $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

                if (!empty($applicationDetail)) {
                    //Save Data IN bo_sp_application_history for log
                   $modelSPH = new SpApplicationHistory;
                    $modelSPH->sp_app_id = $app_Sub_id;
                    $modelSPH->service_id = $applicationDetail['sp_app_id'];
                    $modelSPH->sp_tag = $applicationDetail['sp_tag'];
                    $modelSPH->app_id = $app_Sub_id;
                    $modelSPH->application_status = $_POST['app_status'];
                    if($_POST['app_status']=='FA'){
                        $msglog = "Application has been forwarded to Approver";
                        $modelSPH->comments = "$msglog";
                    }else{
                        $modelSPH->comments = "$msglog";
                    }
                    $modelSPH->added_date_time = date('Y-m-d H:i:s');
                    $modelSPH->role_id = @$_SESSION['role_id'];
                    $modelSPH->role_user_info = @$_SESSION['uname']."<br/>". @$_SESSION['email']."<br/>". @$_SESSION['mobile'];
                    if($CurrentallData['forward_role_id']=='84'){
                        $modelSPH->next_role_id = '83';
                    }else if($CurrentallData['forward_role_id']=='83'){
                        $modelSPH->next_role_id = '84';
                    }else{
                        $modelSPH->next_role_id = '0';
                    }
                    if ($modelSPH->save()) {
                        
                    } else {
                        die(var_dump($modelSPH->getErrors()));
                    }
                    //END Save Data IN bo_sp_application_history for log
                   				
                }
                //END Update Data IN bo_sp_application for log	
//END CODE  BY:- Aamir Date :- 19-08-2021  	


                $this->insertApplicationLog(@$_POST['service_id'], @$_POST['form_id'], @$_SESSION['dept_id'], @$_POST['app_Sub_id'], @$_SESSION['uid'], @$_POST['app_status'], @$_SESSION['uname'], @$msglog, 0, @$comment, '', @$department_log_id);
            }

            if ($_POST['app_status'] == 'FA') {
                $comment_date = date('Y-m-d H:i:s');
                $msglog = "Application Id : $app_Sub_id has been forwarded to Approver";
				
				$supportive_document ="";
				if(!empty($_FILES)) 
				{	/* print_r($_FILES);die; */
					if($_FILES['supportive_document']['name'] != '' && $_FILES['supportive_document']['size'] <= (1024 * 1024 * 5)) 
					{		
						$file_name = strtolower($_FILES['supportive_document']['name']);
						$ext = pathinfo($file_name, PATHINFO_EXTENSION);
						$path = $_SERVER['DOCUMENT_ROOT']."/themes/backend/supportive_documents/";
						$supportive_document = "Supportive_Doc_".$app_Sub_id.'_'.time().".".$ext;
						move_uploaded_file($_FILES['supportive_document']['tmp_name'], $path . $supportive_document);						
					}
				}
				
                $updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_formbuilder_application_forward_level set verifier_user_id=$uid,approv_status='V',verifier_user_comment='" . DefaultUtility::sanatizeParams($comment) . "',comment_date='$comment_date',support_document='$supportive_document',updated_date_time='$comment_date',post_info='" . DefaultUtility::sanatizeParams($postData) . "',form_id=$form_id where app_Sub_id=$app_Sub_id AND next_role_id=$current_role_id AND forwarded_dept_id=$dept_id AND approv_status='P'")->execute();

                $update_date = date('Y-m-d H:i:s');
                $sql_update = "UPDATE bo_new_application_submission SET application_status='FA' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
                $updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();

                $AppData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();

                $approverData = Yii::app()->db->createCommand("SELECT approver_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();

                $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
                $ForwardLevelmodel->next_role_id = $approverData['approver_id']; // approver id fron config table
                $ForwardLevelmodel->verifier_user_id = $_SESSION['uid']; // loggedin user 
                $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
                $ForwardLevelmodel->forwarded_dept_id = $AppData['dept_id'];
                $ForwardLevelmodel->post_info = "";
                $ForwardLevelmodel->verifier_user_comment = '';
                $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
                //$ForwardLevelmodel->updated_date_time = '';
                $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                //$ForwardLevelmodel->comment_date = '';
                $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                $ForwardLevelmodel->approv_status = 'P';
                if ($ForwardLevelmodel->save()) {
					$RecomendedNamemodel = new RecomendedName();
                    $RecomendedNamemodel->submission_id = $app_Sub_id;
                    $RecomendedNamemodel->bo_user_id = $_SESSION['uid'];
                    $RecomendedNamemodel->role_id = $_SESSION['role_id'];
					$recomend=explode("#",$_POST['check_status']);
					$RecomendedNamemodel->recomended_name =$recomend[1];
					$RecomendedNamemodel->recomended_value = $recomend[0];	                
                    $RecomendedNamemodel->created = date('Y-m-d H:i:s');
                    $RecomendedNamemodel->modified = date('Y-m-d H:i:s');
					
					if($RecomendedNamemodel->save()) 
					{					
						Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been forwarded to Approver");
						
						$department_log_id = Yii::app()->db->getLastInsertID();
					}else{
						die(var_dump($RecomendedNamemodel->getErrors()));
					}
                }
            }



             $nocPath = "";
             $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_Sub_id  . "'";
             $model = NewApplicationSubmission::model()->findBySql($sql);

              if($model->application_status=='A' && $newAppSubArr['UK-FCL-00044_0']==3){
                 // Updatecompanymasterdata_for_business::parentfunction($model);
                  Yii::app()->db->createCommand("INSERT INTO entity_application_latest_data (entity_no, service_id, srn_no, user_id, field_value, created_on, updated_on, latest_entity_name, changed_from_service_id, changed_from_srn_no)
                                    SELECT c.reg_no, a.service_id, c.srn_no, c.user_id, a.field_value, a.application_created_date, a.application_created_date, c.company_name,  a.service_id, c.srn_no
                                    FROM bo_company_details as c
                                    INNER JOIN bo_new_application_submission as a ON c.srn_no = a.submission_id
                                    WHERE a.service_id IN ('2.0') AND a.submission_id = ".$model->submission_id)->execute();

                                   Yii::app()->db->createCommand("INSERT INTO entity_application_data_log (entity_no, service_id, srn_no, user_id, field_value, updated_by_srn, updated_by_service_id, entity_name, action_taken, created_on)
                                        SELECT c.reg_no, a.service_id, c.srn_no, c.user_id, a.field_value, c.srn_no, a.service_id, c.company_name, 'Migration data' , a.application_created_date 
                                        FROM bo_company_details as c
                                        INNER JOIN bo_new_application_submission as a ON c.srn_no = a.submission_id
                                    WHERE a.service_id IN ('2.0') AND a.submission_id = ".$model->submission_id)->execute();
              }

             Sendmailforservice::senttofobo_departmentstatus($model);
            $this->redirect("/backoffice/admin");
        }
    }
    
    public function actionSaveData() {


        $saved_caf_id = NULL;
        if (!empty($_POST) && !Yii::app()->request->isAjaxRequest) {
			
            $approvel_id = 0;
            $serviceID = $_POST['service_id'];
            $issuer_id = $_POST['issuer_id'];
            $approval_id = @$_POST['approval_id'];
            $applicationExt = New ApplicationExt;
            $serviceArr = $applicationExt->getServiceNameById($serviceID);
            $service_Name = $serviceArr['core_service_name'];
            $docFlag = 0;
           
            if (isset($_POST['submission_id'])) {
                $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $_POST['submission_id'] . "'";
                $model = NewApplicationSubmission::model()->findBySql($sql);
                $submission_id = $_POST['submission_id'];              
            } else {
                $model = new NewApplicationSubmission();
            }
			
            $model->processing_level = 'District';
            $processLevel = $model->processing_level;

            $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();

            $allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_new_application_submission' AND is_active='Y'")->queryAll();
			
			$getDepartMentId = Yii::app()->db->createCommand("SELECT 	bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_infowizard_issuerby_master.service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id=$issuer_id")->queryRow();
			
			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($_POST['service_id']);
            if (isset($allRes) && !empty($allRes)) {
                foreach ($allRes as $key => $v) {
                    if (!is_array($v['formvar_code'])) {                       
                        if (array_key_exists($v['formvar_code'], $_POST)) {
                            $fld = $v['use_for'];
                            $vl = $v['formvar_code'];
                            $model->$fld = $_POST[$vl];
                        }
                    }
                }
            }

            if (isset($model->unit_name) && !empty($model->unit_name))
                $unitName = $model->unit_name;

            if(isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) {
                $model->user_id = $_SESSION['RESPONSE']["user_id"];
            }            

            //Get Land Region Id
            $landRegionArr = Yii::app()->db->createCommand("SELECT id,formvar_code FROM bo_infowiz_form_builder_config_values where use_for='landrigion_id' and table_name='bo_new_application_submission' and is_active='Y' and (service_id='0' OR service_id='$serviceID') order by service_id DESC")->queryRow();

            $model->landrigion_id = @$_POST[$landRegionArr['formvar_code']];
            $model->field_value = json_encode($_POST);
            $model->dept_id = $getDepartMentId['issuerby_id'];
			$model->application_status = 'DP';
            $model->form_id = 1;
            $model->service_id = $_POST['service_id'];
			$model->sp_tag = $getDepartMentId['service_provider_tag'];
            $model->sp_app_id =  $serviceNameArr['swcs_service_id'];
			$model->app_comments = "Application Submitted but Document Pending";
			$model->app_name = $serviceNameArr['infowiz_service_name'];
			$model->download_certificate_call_back_url = "#";			
            $model->application_created_date = date('Y-m-d H:i:s');                   
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            
// Code By Aamir for Service provider
            if(isset($_SESSION['RESPONSE']["user_type"]) && !empty($_SESSION['RESPONSE']["user_type"])) {
                if($_SESSION['RESPONSE']["user_type"]==2){
                    $model->agent_entry = 1;
                    $model->agent_user_id = @$_SESSION['RESPONSE']['agent_user_id'];
                }
                if($_SESSION['RESPONSE']["user_type"]==3){
                    $model->agent_entry = 1;
                    $model->agent_user_id = @$_SESSION['RESPONSE']['subuser_agent_user_id'];
                    $model->sub_user_id = @$_SESSION['RESPONSE']['subuser_user_id'];
                }
            }
// End Code of service provider 

			$landrigion_id = $model->landrigion_id;
            if($model->save()) 
			{   			
                if (isset($_POST['submission_id'])) {
                    $application_id = $_POST['submission_id'];
                } else {
                    $application_id = Yii::app()->db->getLastInsertId();
                }
				
                $reverted_call_back_url = "/backoffice/infowizardtwo/subFormCompanyNameReservation/updateSubForm/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
				$print_app_call_back_url ="/backoffice/infowizardtwo/subFormCompanyNameReservation/downloadNewApp/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
				
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
				if($modellog->save()) {
					$investor_log_id = Yii::app()->db->getLastInsertID();
				} else {
					die(var_dump($modellog->getErrors()));
				}
				//Investor log Save
				
				//Save Data IN bo_sp_application_history for log
				$modelSPH = new SpApplicationHistory;
				$modelSPH->sp_app_id = "";
				$modelSPH->service_id = $serviceNameArr['swcs_service_id'];
				$modelSPH->sp_tag = $getDepartMentId['service_provider_tag'];
				$modelSPH->app_id = $application_id;
				$modelSPH->application_status = 'DP';
				$modelSPH->comments = 'Application Submitted but Document Pending';
				$modelSPH->added_date_time = date('Y-m-d H:i:s');
				$modelSPH->remote_server   = Yii::app()->request->getUserHostAddress();
				$modelSPH->user_agent  = Yii::app()->request->userAgent;
				if($modelSPH->save()) 
				{
					
				} else {
					//die(var_dump($modelSPH->getErrors()));
				}
				//END Save Data IN bo_sp_application_history for log	
				
                $this->insertApplicationLog(@$_POST['service_id'], 1, @$getDepartMentId['issuerby_id'], @$application_id, '0', $model->application_status, 'Investor', 'Application Submitted but Document Pending', @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);

                Yii::app()->user->setFlash('success', "Application details saved, please upload documents");

                Sendmailforservice::senttofo_draftmode($model);
               

                if(isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) 
				{
					$seriveArr = explode(".",$_POST['service_id']);
					$serviceApplication = "Select * FROM  bo_information_wizard_service_parameters WHERE service_id='".$seriveArr[0]."' AND servicetype_additionalsubservice='".$seriveArr[1]."' AND is_active='Y'";
					$applicationDetail1 = Yii::app()->db->createCommand($serviceApplication)->queryRow();
					//print_r($applicationDetail1);
					$department_id=$applicationDetail1['department_id'];
					$swcs_service_id=$applicationDetail1['swcs_service_id'];
					$service_name=$applicationDetail1['core_service_name'];
					$str = array("new_name"=>$service_name);
					$servicePlus = http_build_query($str, '', '+');
					$this->redirect("/backoffice/investor/ApplyService/DocumentsChecklist/is/no/type/POS?service_id=$seriveArr[0]&sub_service_id=$seriveArr[1]&department_id=$getDepartMentId[issuerby_id]&swcs_department_id=$department_id&swcs_service_id=$swcs_service_id&$servicePlus&caf_id=$application_id&type=Integrated+With+SWCS&ptype=Integrated+With+SWCS&approval_id=@$approval_id");
                }
            } else {
                Yii::app()->user->setFlash('error', "Form Not Submitted Please Try Again!");
                die(var_dump($model->getErrors()));
            }
        }
    }

    public function actionForwardToApprover() {
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
        if ($ForwardLevelmodel->save()) {
            Yii::app()->user->setFlash('message', 'Application Forwarded Successfully');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    function getExistingCafDocuments($sno = null, $service_id = null, $dept_id = null, $user_id = null) {
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

        foreach ($docsInfo as $docData) {
            if (isset($docData['documents_id'])) {
                $documentsID = $docData['documents_id'];
                $sql22 = "SELECT * FROM bo_application_dms_documents_mapping  WHERE sno=$sno AND user_id=$userID AND documents_id=$documentsID";
                //echo $sql22;
                $UploadedDocs = Yii::app()->db->createCommand($sql22)->queryAll();
                //print_r($UploadedDocs);die;
                if (empty($UploadedDocs)) {
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
                    } else {
                        die(var_dump($model->getError()));
                    }
                }
            }
        }  
		/* echo count($docsInfo);
		echo "<br/>";
		echo $totalMappedDocument; */
		//This conditions check that uploded document and mapped service document are equal or not
        if(count($docsInfo) == $totalMappedDocument) {
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
        //print_r($_SESSION);die; 
        //$user_id = $_SESSION['uid'];
        // echo $user_id ;die; 
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;
        $sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();

        // get caf if any bo_application_submission
//		$sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id='1' ORDER BY submission_id ASC";
//		$connection=Yii::app()->db; 
//		$command=$connection->createCommand($sql_caf);
//		$res_caf = $command->queryAll();
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
            $serviceID = "'" . $_GET['service_id'] . "'";
            $formCodeID = $_GET['formCodeID'];


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
            $serviceID = "'" . $_GET['service_id'] . "'";
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
            $serviceID = "'" . $_GET['service_id'] . "'";
            $formCodeID = $_GET['formCodeID'];

            // Getting all active land records  
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();
            extract($_GET);
            $formData = $this->alignInSequence($service_id, $formCodeID);
            /*  echo "<pre>";
              print_r($formData);die(); */

            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id = $subID")->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
        }
        $this->render('updatesubform', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'serviceID' => $_GET['service_id'], 'issuer_id' => @$issuer_id));
    }
	
	
	/*public function actionSaveUpdateSubForm() {

        if(isset($_POST) && !empty($_POST)) {
			
            extract($_POST);

            $submission_id = $_POST['submission_id'];
			$msgFlag = 'submitted the application';
			$currentAppStatus = Yii::app()->db->createCommand("SELECT application_status FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();

			if($currentAppStatus['application_status']=='H'){				
				$msgFlag='resubmitted the application';				
			}	
			
            unset($_POST['submission_id']);
            
            $_POST = $this->my_array_map('trim', $_POST);
			
            $postData = json_encode($_POST);			
            $postData=DefaultUtility::sanatizeParams($postData);
			$currentDate = date('Y-m-d H:i:s');
			$stat = 'DP';
			$docFlag = 0;			
			$pdsatus = 0;
			
			$allData = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();
			            
            $serviceID = $allData['service_id'];
			
			$sqlCheckFeeAplicable = Yii::app()->db->createCommand("SELECT id,fee_detail FROM bo_information_wizard_service_fee WHERE CONCAT(service_id,'.',servicetype_additionalsubservice) = $serviceID")->queryRow();
			$user_id = $_SESSION['RESPONSE']['user_id'];
			
			$sqlCheckPaymentPaidorNot = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_unified_payment_logs WHERE service_id = '$serviceID' AND submission_id = '$submission_id' AND user_id= '$user_id'")->queryRow();
			
				
			$documentExistCheck = Yii::app()->db->createCommand("SELECT * FROM bo_application_dms_documents_mapping where sno=$submission_id")->queryRow();
			
			if(empty($documentExistCheck))
			{
				$stat = 'DP';
				$msgFlag='submitted the application but document pending';	
				$docFlag = 1;			
			}else if($docFlag==0)
			{
				$stat = 'PD';
                $msgFlag='application updated';
                $pdsatus = 1;
			}
			
			
			$msglog = "Investor has $msgFlag";
			
			$landRegionArr = Yii::app()->db->createCommand("SELECT id,formvar_code FROM bo_infowiz_form_builder_config_values where use_for='landrigion_id' and table_name='bo_new_application_submission' and is_active='Y' and (service_id='0' OR service_id='$service_id') order by service_id DESC")->queryRow();
			
			
		
			$landrigion_id = @$_POST[$landRegionArr['formvar_code']];			
			$landrigion_id = @$landrigion_id;		
			$updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set field_value='$postData',application_status='$stat',app_comments='$msglog',application_updated_date_time='$currentDate' where submission_id='$submission_id'")->execute();
			
			
			$sptagData = Yii::app()->db->createCommand("SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_infowizard_issuerby_master.service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id=$issuer_id")->queryRow();
			$service_provider_tag =	$sptagData['service_provider_tag'];
			
            $resArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id=$serviceID AND current_role_id=0  AND processing_level ='District'")->queryRow();
         		
			$department_log_id = 0;
			
		
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
			$modellog->unit_name = @$allData['unit_name'];
			$modellog->landrigion_id = $allData['landrigion_id'];
			
			if($modellog->save()) {
				$investor_log_id = Yii::app()->db->getLastInsertID();
				
				
				$modelSPH = new SpApplicationHistory;
				$modelSPH->sp_app_id = "";
				$modelSPH->service_id = $allData['sp_app_id'];
				$modelSPH->sp_tag = $allData['sp_tag'];
				$modelSPH->app_id = $allData['submission_id'];
				$modelSPH->application_status =$allData['application_status'];
				$modelSPH->comments = "$msglog";
				$modelSPH->added_date_time = date('Y-m-d H:i:s');
				$modelSPH->remote_server   = Yii::app()->request->getUserHostAddress();
				$modelSPH->user_agent  = Yii::app()->request->userAgent;
				if($modelSPH->save())
				{
					
				}else{
					die(var_dump($modelSPH->getErrors()));
				}
						
				
				
				$this->insertApplicationLog(@$allData['service_id'], @$allData['form_id'], @$allData['dept_id'], @$allData['submission_id'], '0', @$allData['application_status'], 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);
			
				$serviceIDArr = explode(".",$serviceID);
				
				$seriveArr = explode(".",$allData['service_id']);
				$serviceApplication = "Select * FROM  bo_information_wizard_service_parameters WHERE service_id='".$seriveArr[0]."' AND servicetype_additionalsubservice='".$seriveArr[1]."' AND is_active='Y'";
				$applicationDetail1 = Yii::app()->db->createCommand($serviceApplication)->queryRow();
			
				$department_id = $applicationDetail1['department_id'];
				$swcs_service_id = $applicationDetail1['swcs_service_id'];
				$service_name = $applicationDetail1['core_service_name'];
				$str = array("new_name"=>$service_name);
				$getDepartMentId = $allData['dept_id'];
				$saved_caf_id = $allData['submission_id'];
				$servicePlus = http_build_query($str, '', '+');
				$this->redirect("/backoffice/investor/ApplyService/DocumentsChecklist/is/no/type/POS?service_id=$seriveArr[0]&sub_service_id=$seriveArr[1]&department_id=$getDepartMentId&swcs_department_id=$department_id&swcs_service_id=$swcs_service_id&$servicePlus&caf_id=$saved_caf_id&type=Integrated+With+SWCS&ptype=Integrated+With+SWCS&approval_id=@$approval_id");
				
				
			} else {
				print_r($modellog->getErrors());
				die();
			}
            
        }
    }*/
	public function actionSaveUpdateSubForm() {
    if(isset($_POST) && !empty($_POST)) {
           
            extract($_POST);
            $submission_id = DefaultUtility::dataSenetize($_POST['submission_id']);
           

            $s = "SELECT * FROM bo_new_application_submission where submission_id=:submission_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $allData = $command->queryRow();

            $stat = 'DP';
            if($allData['application_status']=='H'){                
                $msgFlag='Resubmitted and Document Pending';             
            }else{                
                 $msgFlag='Submitted but Document Pending';  
            }   
            
            unset($_POST['submission_id']);
            
            $_POST = $this->my_array_map('trim', $_POST);
            $postData=DefaultUtility::sanatizeParams(json_encode($_POST));
            $currentDate = date('Y-m-d H:i:s');                 
            $serviceID = $allData['service_id'];
            $user_id = $_SESSION['RESPONSE']['user_id'];

            
            
           
            
            
            $msglog = "Application $msgFlag"; 

            $s4 = "update bo_new_application_submission set field_value='$postData',application_status='$stat',app_comments='$msglog',application_updated_date_time='$currentDate' where submission_id=:submission_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s4);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $command->execute();
            
            //End of code use for landrigion id     
                  
            $department_log_id = 0;
            
            /* Save Log Data After Update Application */
            $modellog = new NewApplicationSubmissionLog();

            $modellog->field_value = json_encode($_POST);
            $modellog->submission_id = $allData['submission_id'];
            $modellog->user_id = $_SESSION['RESPONSE']["user_id"];
            $modellog->dept_id = $allData['dept_id'];
            $modellog->application_status = $stat;
            $modellog->form_id = $allData['form_id'];
            $modellog->service_id = $allData['service_id'];
            $modellog->application_created_date = $allData['application_created_date'];
            $modellog->application_updated_date_time = date('Y-m-d');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = @$allData['unit_name'];
            $modellog->landrigion_id = $allData['landrigion_id'];
            
            if($modellog->save()) {
                $investor_log_id = Yii::app()->db->getLastInsertID();
                
                //Save Data IN bo_sp_application_history for log
                $modelSPH = new SpApplicationHistory;
                $modelSPH->sp_app_id = "";
                $modelSPH->service_id = $allData['sp_app_id'];
                $modelSPH->sp_tag = $allData['sp_tag'];
                $modelSPH->app_id = $allData['submission_id'];
                $modelSPH->application_status =$stat;
                $modelSPH->comments = "$msglog";
                $modelSPH->added_date_time = date('Y-m-d H:i:s');
                
                if($modelSPH->save())
                {
                    
                }else{
                    die(var_dump($modelSPH->getErrors()));
                }
                //END Save Data IN bo_sp_application_history for log                
                
                
                $this->insertApplicationLog(@$allData['service_id'], @$allData['form_id'], @$allData['dept_id'], @$allData['submission_id'], '0',  $stat, 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);

                Yii::app()->user->setFlash('success', "Your application has been updated successfully.");
                
               // $this->redirect('/backoffice/investor');
                $serviceIDArr = explode(".",$serviceID);
                
                $seriveArr = explode(".",$allData['service_id']);
                $serviceApplication = "Select * FROM  bo_information_wizard_service_parameters WHERE service_id='".$seriveArr[0]."' AND servicetype_additionalsubservice='".$seriveArr[1]."' AND is_active='Y'";
                $applicationDetail1 = Yii::app()->db->createCommand($serviceApplication)->queryRow();
                //print_r($applicationDetail1);
                $department_id = $applicationDetail1['department_id'];
                $swcs_service_id = $applicationDetail1['swcs_service_id'];
                $service_name = $applicationDetail1['core_service_name'];
                $str = array("new_name"=>$service_name);
                $getDepartMentId = $allData['dept_id'];
                $saved_caf_id = $allData['submission_id'];
                $servicePlus = http_build_query($str, '', '+');

                if(IS_NOTIFICATION_ON==1){
                     Alertsandnotification::sendnotification('Services', $allData['submission_id'],$allData['submission_id'],$allData['user_id'],'FO','Application details saved successfully');
                }

 


                $this->redirect("/backoffice/investor/ApplyService/DocumentsChecklist/is/no/type/POS?service_id=$seriveArr[0]&sub_service_id=$seriveArr[1]&department_id=$getDepartMentId&swcs_department_id=$department_id&swcs_service_id=$swcs_service_id&$servicePlus&caf_id=$saved_caf_id&type=Integrated+With+SWCS&ptype=Integrated+With+SWCS&approval_id=@$approval_id");
                
                
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
            var_dump($model->getErrors());
            die;
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
            
            $getApprovedName = Yii::app()->db->createCommand("SELECT recomended_name,recomended_value,created FROM bo_recomended_name where submission_id = '$subID' and role_id in(83,84) order by id desc")->queryRow();
        
        $signatoryDetails= Yii::app()->db->createCommand("SELECT * FROM bo_signature_metadata where submission_id = $subID and is_active=1")->queryAll();
        // die("jsdkdjs");
        $content = $this->renderPartial('app_pdf_view', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date'], 'getApprovedName'=>$getApprovedName,'signatoryDetails'=>$signatoryDetails), true);
        $name = "CAPIO-Application_Form_" . time() . ".pdf";
        $app_log = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A'")->queryRow();
        //echo $content; die;
        UtilityA2_0::generatePdfApp($content, $name, $app_log,$fieldValues2);
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
        $service_id = $_GET['service_id'];
        $dept_id = $_GET['dept_id'];
        if (!empty($_POST)) {
            $model = new BoInfowizFormBuilderCertificate;
            $getContentExist = Yii::app()->db->createCommand("SELECT count(*) as tot FROM bo_infowiz_form_builder_certificate where service_id='$service_id' AND dept_id='$dept_id'")->queryRow();
            $content = $_POST['content'];

            if ($getContentExist['tot'] > 0) {
                die;
                $updated = date('Y-m-d H:i:s');
                $updateNewApplication = Yii::app()->db->createCommand("update bo_infowiz_form_builder_certificate set content='$content',updated='$updated' where service_id='$service_id' and dept_id='$dept_id'")->execute();
                Yii::app()->user->setFlash('success', "Your content update successfully.");
            } else {
                $model->content = $content;
                $model->created = date('Y-m-d H:i:s');
                $model->dept_id = $dept_id;
                $model->service_id = $service_id;

                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Your content saved successfully.");
                } else {
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
        $this->redirect("/backoffice/investor/home/investorWalkthrough");
    }
	
	function actionSaveAllDocuments(){
		
		extract($_GET);
		$this->getExistingCafDocuments($sno,$service_id,$dept_id,$_SESSION['RESPONSE']['user_id']);		
		
		//For check fee applicable or not and paid or not for service			
		$sqlCheckFeeAplicable = Yii::app()->db->createCommand("SELECT id,fee_detail FROM bo_information_wizard_service_fee WHERE CONCAT(service_id,'.',servicetype_additionalsubservice) = $service_id")->queryRow();
		$user_id = $_SESSION['RESPONSE']['user_id'];
		//echo "<pre>";	print_r($sqlCheckFeeAplicable);die;		
		$sqlCheckPaymentPaidorNot = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_unified_payment_logs WHERE service_id = '$service_id' AND submission_id = '$app_id' AND user_id= '$user_id'")->queryRow();
		
		$pdsatus = 0;
		if(!empty($sqlCheckFeeAplicable['fee_detail']) && empty($sqlCheckPaymentPaidorNot['total']))
		{		
			$pdsatus = 1;
		}
		$stat = 'P';
		if($pdsatus==1){		
			$stat = 'PD';
		}	
		
		$currentDate = date('Y-m-d H:i:s');
		$serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='$stat',application_updated_date_time='$currentDate' WHERE submission_id=$app_id";
		$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		
		$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='$stat',updated_on='$currentDate' WHERE sno=$sno";
		$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		
        //Save Declartion record
        $checkalreadycheck = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_metadata WHERE service_id=$service_id AND application_id=$sno")->queryRow();
        if($checkalreadycheck){

        }else{
            $dec_metadata = new Declarationmetadata;
            $dec_metadata->service_id = $service_id;
            $dec_metadata->application_id = $sno;
             $dec_metadata->save();
        }
        

		if($pdsatus==1){
			//Save Data IN bo_sp_application_history for log
			$serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($service_id);
			$sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=$dept_id")->queryRow(); 
			$allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$app_id")->queryRow();
			
			$modelSPH = new SpApplicationHistory;
			$modelSPH->sp_app_id = $sno;
			$modelSPH->service_id = $serviceNameArr['swcs_service_id'];
			$modelSPH->sp_tag =  $sptagData['service_provider_tag'];
			$modelSPH->app_id = $app_id;
			$modelSPH->application_status = "$stat";
			$modelSPH->comments = 'Application Submitted but Payment Due.';
			$modelSPH->added_date_time = date('Y-m-d H:i:s');
			$modelSPH->save();
				
			//Investor log Save
			$modellog = new NewApplicationSubmissionLog();
			$modellog->field_value = "N.A";
			$modellog->submission_id = $app_id;
			$modellog->application_id = $app_id;
			$modellog->user_id = $user_id;
			$modellog->dept_id = $dept_id;
			$modellog->application_status = "$stat";
			$modellog->form_id = 1;
			$modellog->service_id = $service_id;
			$modellog->application_created_date = date('Y-m-d H:i:s');
			$modellog->application_updated_date_time = date('Y-m-d H:i:s');
			$modellog->ip_address = $_SERVER['REMOTE_ADDR'];
			$modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
			$modellog->unit_name = '';
			$modellog->landrigion_id = $allData['landrigion_id'];
			if($modellog->save()) {
				$investor_log_id = Yii::app()->db->getLastInsertID();
				$model_app_log = new FormBuilderApplicationLog;
				$model_app_log->service_id = $service_id;
				$model_app_log->form_id = 1;
				$model_app_log->core_department_id = $dept_id;
				$model_app_log->app_Sub_id = $app_id;
				$model_app_log->department_user_id = '0';
				$model_app_log->action_status = "$stat";
				$model_app_log->action_taken_by_name = 'Investor';
				$model_app_log->action_message = 'Application Submitted but Payment Due.';
				$model_app_log->investor_id = $user_id;
				$model_app_log->department_comment = '';
				$model_app_log->investor_log_id = $investor_log_id;
				$model_app_log->dept_log_id = 0;
				$model_app_log->created = date('Y-m-d H:i:s');
				if($model_app_log->save()) {
					
				}
			} else {
				die(var_dump($modellog->getErrors()));
			}
			echo "1";	
		}else{
			echo "0";	
		}	
		if($pdsatus==0){
			//Send message to investor after submitting form and documents
			/* if(isset($user_id) && ($user_id != "") && in_array($service_id,array('631.0'))) 
			{
				$var_model_user_id = $user_id;
				$sql = "select * from sso_users left join sso_profiles on sso_users.user_id = sso_profiles.user_id where sso_users.user_id = $var_model_user_id";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$emails = $command->queryAll();
				$dept_user = $emails[0]['first_name'];
				$ALERT_EMAIL_USERNAME = "";
				
				$applicationExt = New ApplicationExt;
				$serviceArr = $applicationExt->getServiceNameById($service_id);
				$service_Name = $serviceArr['core_service_name'];

				if (!empty($emails)) {
					$sql = "select * from bo_email_text where module = 'sub_form' and trigger_point = 'sub_form_submission' and role_id = '1000' and is_active = 'Y' ";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$template = $command->queryAll();
					if (!empty($template)) {
						$text_sub = $template[0]['subject'];
						$text0 = str_replace("<Dept User Name>", $dept_user, $template[0]['text']);
						$text1 = str_replace("<service_name>", $service_Name, $text0);
						$text2 = str_replace("<app_id>", $app_id, $text1);
						$date = date('Y-m-d H:m:s');
						$sql = "Insert into bo_sms_email_alert (module,trigger_point,subject,body,email_from,email_to,mobile,log_created_on,email_status,sms_status,user_id) "
								. "values('sub_form','sub_form_submission','" . $text_sub . "','" . $text2 . "','" . $ALERT_EMAIL_USERNAME . "','" . $emails[0]['email'] . "','" . $emails[0]['mobile_number'] . "','" . $date . "','" . '0' . "','" . '0' . "','" . $user_id . "')";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$InsertLog = $command->execute();
					}
				}
			} */
			//Send message to investor after submitting form and documents			
			$this->ForwardToDepartment($app_id, $app_id, $service_id,'District');		
			echo "1";
			die;	
		}else{
			echo "0";
			die;
		}	
		die;
		
	}
	

   	public function ForwardToDepartment($submission_id = null, $sno = null, $service_id = null,$processLevel) 
	{
		$msg="";
        $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$service_id AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();

        $serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($submission_id);
		$applicationExt = New ApplicationExt;
		$serviceArr = $applicationExt->getServiceNameById($service_id);
        $service_Name = $serviceArr['core_service_name'];
        if(isset($serviceData) && !empty($serviceData)) 
		{
            // Forward to department Entry Part
            $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
            $ForwardLevelmodel->next_role_id = @$allData['next_role_id'];
            $ForwardLevelmodel->verifier_user_id = '0';
            $ForwardLevelmodel->app_Sub_id = $submission_id;
            $ForwardLevelmodel->forwarded_dept_id = $serviceData['dept_id'];
            $ForwardLevelmodel->post_info = "";
            $ForwardLevelmodel->verifier_user_comment = '';
            $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
            //$ForwardLevelmodel->updated_date_time = '0000-00-00 00:00:00';
            $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
            //$ForwardLevelmodel->comment_date = '0000-00-00 00:00:00';
            $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
            $ForwardLevelmodel->approv_status = 'P';
            $ForwardLevelmodel->save();
            if($ForwardLevelmodel->save()) {
                $msg = $msg . "Saved In History Table";
				/* if (isset($ForwardLevelmodel->next_role_id) && ($ForwardLevelmodel->next_role_id != "") && isset($ForwardLevelmodel->forwarded_dept_id) && ($ForwardLevelmodel->forwarded_dept_id != "") && isset($serviceData['app_distt']) && ($serviceData['app_distt'] != "")) 
				{
					$var_next_role_id = $ForwardLevelmodel->next_role_id;
					$var_forwarded_dept_id = $ForwardLevelmodel->forwarded_dept_id;
					
					if(in_array($service_id,array('194.0','194.1'))){//Joint director services
						$sql = "select * from bo_user left join  bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id=:role_id and disctrict_id=:district_id and dept_id=:dept_id and uid='1077'";
					}if(in_array($service_id,array('577.0','577.1'))){	//PPO message					
						$sql = "select * from bo_user left join  bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id=:role_id and disctrict_id=:district_id and dept_id=:dept_id and uid='1094'";
					}else{ //CAO message
						$sql = "select * from bo_user left join  bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id=:role_id and disctrict_id=:district_id and dept_id=:dept_id and uid!='1077'";
					}
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$command->bindParam(":role_id", $var_next_role_id, PDO::PARAM_STR);
					$command->bindParam(":district_id", $serviceData['app_distt'], PDO::PARAM_STR);
					$command->bindParam(":dept_id", $var_forwarded_dept_id, PDO::PARAM_STR);

					$emails = $command->queryAll();

					foreach ($emails as $email) {
						$dept_user = $email['full_name'];
						$ALERT_EMAIL_USERNAME = "";
						if (!empty($email)) {

							$text_sub = "Single Window Clearance System - Application Forwarded.";
							$text4 = "Dear $dept_user , Application with App ID : $submission_id for $service_Name has been forwarded on Single Window Clearance System for your approval.";
							$date = date('Y-m-d H:m:s');
							$sql = "Insert into bo_sms_email_alert (module,trigger_point,subject,body,email_from,email_to,mobile,log_created_on,email_status,sms_status,user_id) "
									. "values('sub_form','sub_form_submission','" . $text_sub . "','" . $text4 . "','" . $ALERT_EMAIL_USERNAME . "','" . $email['email_alert'] . "','" . $email['mobile'] . "','" . $date . "','" . '0' . "','" . '0' . "','" . $email['uid'] . "')";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$InsertLog = $command->execute();
						}
					}
				} */
            } else {
                die(var_dump($ForwardLevelmodel->getErrors()));
            }

            // Insert In History Table 
            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $sno;
            $modelSPH->service_id = $serviceData['sp_app_id'];
            $modelSPH->sp_tag = $serviceData['sp_tag'];
            $modelSPH->app_id = $submission_id;
            $modelSPH->application_status = 'P';
            $modelSPH->comments = 'Application Submitted Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            if ($modelSPH->save()) {
                $msg = $msg . "Saved In History Table";
            } else {
                die(var_dump($modelSPH->getErrors()));
            }

            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $submission_id;
            $modellog->application_id = $submission_id;
            $modellog->user_id = $serviceData['user_id'];
            $modellog->dept_id = $serviceData['dept_id'];
            $modellog->application_status = 'P';
            $modellog->form_id = 1;
            $modellog->service_id = $serviceData['service_id'];
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $serviceData['landrigion_id'];
            if ($modellog->save()) {
                $investor_log_id = Yii::app()->db->getLastInsertID();
                $model_app_log = new FormBuilderApplicationLog;
                $model_app_log->service_id = $serviceData['service_id'];
                $model_app_log->form_id = 1;
                $model_app_log->core_department_id = $serviceData['dept_id'];
                $model_app_log->app_Sub_id = $submission_id;
                $model_app_log->department_user_id = '0';
                $model_app_log->action_status = 'P';
                $model_app_log->action_taken_by_name = 'Investor';
                $model_app_log->action_message = 'Investor has submitted the application';
                $model_app_log->investor_id = $serviceData['user_id'];
                $model_app_log->department_comment = '';
                $model_app_log->investor_log_id = $investor_log_id;
                $model_app_log->dept_log_id = 0;
                $model_app_log->created = date('Y-m-d H:i:s');
                if ($model_app_log->save()) {}
            } else {
                die(var_dump($modellog->getErrors()));
            }
        }
		return true;
	}

    public static function SavePDF($url, $path) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $data = curl_exec($ch);

        if (curl_error($ch)) {
            echo $http_status = curl_getinfo($url, CURLINFO_HTTP_CODE);
            $error_msg = curl_error($ch);
            echo "===========";
            print_r($error_msg);
            print_r($data);
            die;
        }
        curl_close($ch);
        $result = file_put_contents($path, $data);

        if (!$result) {
            return "error";
        } else {
            return "success";
        }
    }
	
	function actionCheckProposedName()
	{
		extract($_POST);
		$v = preg_replace('!\s+!', ' ',trim($getProposedWord));
		
		$illegal_endings= array('ltd.','ltd','limited','inc.','inc','incorporated','corporation','corp.','corp','incorporated cell company','icc','icc.','segregated cell company','scc.','scc','private trust company','ptc','ptc.','srl','srl.','society restricted liability','society restricted liability.','society with restricted liability','society with restricted liability.');
		foreach($illegal_endings as $needle){
			$inputText=strtolower($v);
			if((substr_compare($inputText, $needle,-strlen($needle)) === 0)==1)
			{
				echo 'ILLEGAL_ENDING';
				die();
			}
		}	
		
		
		$inputWordsArr = explode(" ",strtolower($v));
		if(count($inputWordsArr)>1){
			foreach($inputWordsArr as $k=>$vl)
			{
				$v2 = addslashes($vl);
				$dataBanned = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE LCASE (banned_words_name)='$v2' AND banned_words_type='BANNED_WORDS' AND status='Y' ORDER BY `banned_words_id` DESC")->queryRow();
				if(isset($dataBanned) && !empty($dataBanned))
				{			
					echo $dataBanned['banned_words_type'];
					die();
				}
			}
		}	
		
		$bannedWordsArr = Yii::app()->db->createCommand('SELECT banned_words_name,banned_words_type FROM bo_banned_words WHERE status="Y"')->queryAll();
                
                $zdm_cnam = Yii::app()->db->createCommand("SELECT CNAMCN as banned_words_name,'COMPANY_RESERVED' as banned_words_type FROM zdm_cnamcnp0")->queryAll();
                
		
			
		foreach($bannedWordsArr as $j=>$y)
		{
			//first remove legal string from db value
			$newStr= trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			
			similar_text(strtolower($v),$newStr,$percent);
			/* echo $newStr.'=='.strtolower($v).'=='.$percent;
			echo "<br/>"; */
			if(number_format($percent, 0)==100)
			{				
				echo $y['banned_words_type'];
				die();
			} 
			
		}
		
                foreach($zdm_cnam as $j=>$y)
		{
			//first remove legal string from db value
			$newStr= trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			
			similar_text(strtolower($v),$newStr,$percent);
			/* echo $newStr.'=='.strtolower($v).'=='.$percent;
			echo "<br/>"; */
			if(number_format($percent, 0)==100)
			{				
				echo $y['banned_words_type'];
				die();
			} 
			
		}
                
		foreach($bannedWordsArr as $j=>$y)
		{	
			$newStr2=trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			similar_text(strtolower($v), $newStr2,$percent);			
			
			if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
			{				
				echo $y['banned_words_type']."_PART";
				die();
			} 
		}
                
                foreach($zdm_cnam as $j=>$y)
		{	
			$newStr2=trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			similar_text(strtolower($v), $newStr2,$percent);			
			
			if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
			{				
				echo $y['banned_words_type']."_PART";
				die();
			} 
		}
		
		foreach($bannedWordsArr as $j=>$y)
		{			
			$newStr3=trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			similar_text(strtolower($v),$newStr3,$percent);			
			
			if(number_format($percent, 0) < 70)
			{	
				echo '0';
				die();
			} 
		}
		
		foreach($zdm_cnam as $j=>$y)
		{			
			$newStr3=trim(str_ireplace($illegal_endings, '',strtolower($y['banned_words_name'])));
			similar_text(strtolower($v),$newStr3,$percent);			
			
			if(number_format($percent, 0) < 70)
			{	
				echo '0';
				die();
			} 
		}
		 
		/* if(isset($business_type) && $business_type==1)
		{		
			if($this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type)  || $this->ends_with(strtolower($v),$business_type))
			{	
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
					{				
						echo $y['banned_words_type']."_PART";
						die();
					} 
				}
				
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0) < 70)
					{	
						echo '0';
						die();
					} 
				}
			}else{
				echo "LIMITEDSUFFIXERROR";
				die();			
			}
			
		}else if(isset($business_type) && $business_type==5){
			if($this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type))
			{
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
					{				
						echo $y['banned_words_type']."_PART";
						die();
					} 
				}
				
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0) < 70)
					{	
						echo '0';
						die();
					} 
				}
			}else{
				echo "ICCSUFFIXERROR";
				die();			
			}
		}else if(isset($business_type) && $business_type==6){
			if($this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type))
			{
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
					{				
						echo $y['banned_words_type']."_PART";
						die();
					} 
				}
				
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0) < 70)
					{	
						echo '0';
						die();
					} 
				}
			}else{
				echo "SCCSUFFIXERROR";
				die();			
			}
		}else if(isset($business_type) && $business_type==7){
			if($this->ends_with(strtolower($v),$business_type) || $this->ends_with(strtolower($v),$business_type))
			{
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
					{				
						echo $y['banned_words_type']."_PART";
						die();
					} 
				}
				
				foreach($bannedWordsArr as $j=>$y)
				{			
					similar_text($v, $y['banned_words_name'],$percent);			
					
					if(number_format($percent, 0) < 70)
					{	
						echo '0';
						die();
					} 
				}
			}else{
				echo "PTCSUFFIXERROR";
				die();			
			}
		}else{
			foreach($bannedWordsArr as $j=>$y)
			{			
				similar_text($v, $y['banned_words_name'],$percent);			
				
				if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
				{				
					echo $y['banned_words_type']."_PART";
					die();
				} 
			}
			
			foreach($bannedWordsArr as $j=>$y)
			{			
				similar_text($v, $y['banned_words_name'],$percent);			
				
				if(number_format($percent, 0) < 70)
				{	
					echo '0';
					die();
				} 
			}
		} */
			
		
		
		
		
		/* $v3 = addslashes($v);
		$data = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name='$v3' ORDER BY `banned_words_id` DESC")->queryRow();
		
		$data2 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name LIKE '%$v3%' ORDER BY `banned_words_id` DESC")->queryRow();
		
		if(isset($data) && !empty($data)){					
			echo $data['banned_words_type'];
			die();
		}else if(isset($data2) && !empty($data2)){					
			echo $data2['banned_words_type']."_PART";
			die();
		}else{
			echo '0';
			die();
		} */
		
		
		/* $bannedWordsArr = Yii::app()->db->createCommand('SELECT banned_words_name as bannedwords FROM bo_banned_words WHERE status="Y"')->queryAll();
		
		$inputWordsArr = explode(" ",trim($getProposedWord));		
		foreach($inputWordsArr as $k=>$v)
		{		//echo $v;die;
			if(in_array($v,$bannedWordsArr))
			{
				$data3 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name='$v' ORDER BY `banned_words_id` DESC")->queryRow();
				echo $data3['banned_words_type'];
				die();
			}
		}
		
		if(in_array(trim($getProposedWord),$bannedWordsArr))
		{
			$data3 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name='trim($getProposedWord)' ORDER BY `banned_words_id` DESC")->queryRow();
			echo $data3['banned_words_type'];
			die();
		}else{
			$data4 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name ='trim($getProposedWord)' ORDER BY `banned_words_id` DESC")->queryRow();		
			
			$data5 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name LIKE '%trim($getProposedWord)%' ORDER BY `banned_words_id` DESC")->queryRow();
			
			if(isset($data4) && !empty($data4)){					
				echo $data4['banned_words_type'];
				die();
			}else if(isset($data5) && !empty($data5)){					
				echo $data5['banned_words_type']."_PART";
				die();
			}else{
				echo '0';
				die();
			}			
		}
			 */
		/* }else{
			if(in_array($getProposedWord,$bannedWordsArr))
			{
				$data3 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name='$getProposedWord' ORDER BY `banned_words_id` DESC")->queryRow();
				echo $data3['banned_words_type'];
				die();
			}else{
				$data4 = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name LIKE '%$getProposedWord%' ORDER BY `banned_words_id` DESC")->queryRow();
				if(isset($data4) && !empty($data4)){					
					echo $data['banned_words_type'].'_PART';
					die();
				}else{
					echo '0';
					die();
				}			
			}		
		} */
		/* //Full text search
		$allBannedWords = Yii::app()->db->createCommand("SELECT count(*) as totalBannedExist FROM bo_proposed_name WHERE MATCH (banned_words) AGAINST ('+$getProposedWord*' IN NATURAL LANGUAGE MODE)")->queryRow();
		
		//Regular expression search
		$allBannedWords2 = Yii::app()->db->createCommand('SELECT count(*) as totalBannedExist FROM bo_proposed_name WHERE banned_words REGEXP "[[:<:]]$getProposedWord[[:>:]]"')->queryRow();	
		
		
		//Full text search
		$allPolticalWords = Yii::app()->db->createCommand("SELECT count(*) as totalPoliticalExist FROM bo_proposed_name WHERE MATCH (reserved_political_parties) AGAINST ('+$getProposedWord*' IN NATURAL LANGUAGE MODE)")->queryRow();
		
		//Regular expression search
		$allPolticalWords2 = Yii::app()->db->createCommand('SELECT count(*) as totalPoliticalExist FROM bo_proposed_name WHERE reserved_political_parties REGEXP "[[:<:]]$getProposedWord[[:>:]]"')->queryRow();	
		
		
		//Full text search
		$allAssociationWords = Yii::app()->db->createCommand("SELECT count(*) as totalAssociationExist FROM bo_proposed_name WHERE MATCH (reserved_association) AGAINST ('+$getProposedWord*' IN NATURAL LANGUAGE MODE)")->queryRow();
		
		//Regular expression search
		$allAssociationWords2 = Yii::app()->db->createCommand('SELECT count(*) as totalAssociationExist FROM bo_proposed_name WHERE reserved_association REGEXP "[[:<:]]$getProposedWord[[:>:]]"')->queryRow();	
		
		
		//Full text search
		$allUniversityWords = Yii::app()->db->createCommand("SELECT count(*) as totalAssociationExist FROM bo_proposed_name WHERE MATCH (reserved_universities) AGAINST ('+$getProposedWord*' IN NATURAL LANGUAGE MODE)")->queryRow();
		
		//Regular expression search
		$allUniversityWords2 = Yii::app()->db->createCommand('SELECT count(*) as totalAssociationExist FROM bo_proposed_name WHERE reserved_universities REGEXP "[[:<:]]$getProposedWord[[:>:]]"')->queryRow();	
		
		
		
		if((isset($allBannedWords['totalBannedExist']) && $allBannedWords['totalBannedExist'] >0) || (isset($allBannedWords2['totalBannedExist']) && $allBannedWords2['totalBannedExist'] >0))
		{
			echo 'banned';			
		}else if((isset($allPolticalWords['totalBannedExist']) && $allPolticalWords['totalPoliticalExist'] >0) || (isset($allPolticalWords2['totalBannedExist']) && $allPolticalWords2['totalBannedExist'] >0))
		{
			echo 'political';			
		}else if((isset($allAssociationWords['totalBannedExist']) && $allAssociationWords['totalAssociationExist'] >0) || (isset($allAssociationWords2['totalBannedExist']) && $allAssociationWords2['totalBannedExist'] >0)){
			echo 'association';			
		}else if((isset($allUniversityWords['totalBannedExist']) && $allUniversityWords['totalUniversitiesExist'] >0) || (isset($allUniversityWords2['totalBannedExist']) && $allUniversityWords2['totalUniversitiesExist'] >0)){
			echo 'university';			
		}else{
			echo '0';
		} */
		die();
	}
	
	function ends_with($haystack,$business_type){
		$pieces = explode(' ', $haystack);
		$last_word = array_pop($pieces);
		if(((strtolower($last_word)==='limited' || strtolower($last_word)==='ltd.' || strtolower($last_word)==='incorporation' || strtolower($last_word)==='inc.' || strtolower($last_word)==='corporation' || strtolower($last_word)==='corp.') && $business_type==1))
		{
			return true;
		}else if(((strtolower($last_word)==='incorporated cell company' || strtolower($last_word)==='icc.') && $business_type==5)){		
			return true;
		}else if(((strtolower($last_word)==='segregated cell company' || strtolower($last_word)==='scc') && $business_type==6)){		
			return true;
		}else if(((strtolower($last_word)==='private trust company' || strtolower($last_word)==='ptc') && $business_type==7)){
			return true;		
		}
		else{
			return false;
		}	
	}
	
	function actionCheckProposedName2()
	{
		extract($_POST);
		$v = preg_replace('!\s+!', ' ',trim($getProposedWord));
		
		$inputWordsArr = explode(" ",$v);
		if(count($inputWordsArr)>1){
			foreach($inputWordsArr as $k=>$vl)
			{
				$v2 = addslashes($vl);
				$dataBanned = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_type FROM bo_banned_words WHERE banned_words_name='$v2' AND banned_words_type='BANNED_WORDS' ORDER BY `banned_words_id` DESC")->queryRow();
				if(isset($dataBanned) && !empty($dataBanned))
				{			
					echo $dataBanned['banned_words_type'];
					die();
				}
			}
		}	
		
		$bannedWordsArr = Yii::app()->db->createCommand('SELECT * FROM bo_banned_words WHERE status="Y"')->queryAll();
		
		foreach($bannedWordsArr as $j=>$y)
		{
			
			similar_text($v, $y['banned_words_name'],$percent);
			if(number_format($percent, 0)==100)
			{				
				echo $y['banned_words_type'];
				die();
			}
			
		}
		
		foreach($bannedWordsArr as $j=>$y)
		{			
			similar_text($v, $y['banned_words_name'],$percent);			
			
			if(number_format($percent, 0)> 70  && number_format($percent, 0) < 100)
			{				
				echo $y['banned_words_type']."_PART";
				die();
			} 
		}
		
		foreach($bannedWordsArr as $j=>$y)
		{			
			similar_text($v, $y['banned_words_name'],$percent);			
			
			if(number_format($percent, 0) < 70)
			{				
				echo '0';
				die();
			} 
		}
		die();
	}	
	
	
	function actionWithdrwalName()
	{
		extract($_POST);
		/* echo "<pre>";
		print_r($_POST);die; */
		$currentDate = date('Y-m-d H:i:s');
		$serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='W',application_updated_date_time='$currentDate' WHERE submission_id=$subID";
		$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
		$serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($subID);
		if($serviceDetail){
			//Save Investor Log
			$investorLog = new NewApplicationSubmissionLog();
            $investorLog->field_value = "N.A";
            $investorLog->submission_id = $subID;
            $investorLog->application_id = $subID;
            $investorLog->user_id = $serviceData['user_id'];
            $investorLog->dept_id = $serviceData['dept_id'];
            $investorLog->application_status = 'W';
            $investorLog->form_id = 1;
            $investorLog->service_id = $serviceData['service_id'];
            $investorLog->application_created_date = date('Y-m-d H:i:s');
            $investorLog->application_updated_date_time = date('Y-m-d H:i:s');
            $investorLog->ip_address = $_SERVER['REMOTE_ADDR'];
            $investorLog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $investorLog->unit_name = '';
            $investorLog->landrigion_id = $serviceData['landrigion_id'];
			if($investorLog->save()) {
                $investor_log_id = Yii::app()->db->getLastInsertID();
                $departMentlog = new FormBuilderApplicationLog;
                $departMentlog->service_id = $serviceData['service_id'];
                $departMentlog->form_id = 1;
                $departMentlog->core_department_id = $serviceData['dept_id'];
                $departMentlog->app_Sub_id = $subID;
                $departMentlog->department_user_id = '0';
                $departMentlog->action_status = 'W';
                $departMentlog->action_taken_by_name = 'Investor';
                $departMentlog->action_message = 'Investor has withdrawal registered name';
                $departMentlog->investor_id = $serviceData['user_id'];
                $departMentlog->department_comment = '';
                $departMentlog->investor_log_id = $investor_log_id;
                $departMentlog->dept_log_id = 0;
                $departMentlog->created = date('Y-m-d H:i:s');
                if($departMentlog->save()) {
					$modelSPH = new SpApplicationHistory;
					$modelSPH->sp_app_id = $subID;
					$modelSPH->service_id = $serviceData['sp_app_id'];
					$modelSPH->sp_tag = $serviceData['sp_tag'];
					$modelSPH->app_id = $subID;
					$modelSPH->application_status = 'W';
					$modelSPH->comments = 'Reserved name withdrawal successfully';
					$modelSPH->added_date_time = date('Y-m-d H:i:s');
					if($modelSPH->save()) 
					{	
						$current_date = date('Y-m-d H:i:s');
						$updateReserveWord = "UPDATE bo_banned_words SET status ='N',updated='$current_date' WHERE app_id='$subID'";
						Yii::app()->db->createCommand($updateReserveWord)->execute();
						
						$this->SendNotification($_SESSION['RESPONSE']['user_id'],'0','83','1',"Name withdraw for application id:$subID","Name withdraw for application id :$subID",'Withdrawal');							
						$updateWithdrawal = "UPDATE bo_recomended_name SET withdrawal_status ='1' WHERE submission_id='$subID'";
						Yii::app()->db->createCommand($updateWithdrawal)->execute();

			 $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $subID  . "'";
             $model = NewApplicationSubmission::model()->findBySql($sql);
             Sendmailforservice::senttofo_namewithdrwal($model);

						return true;
						die();
					} else {
						return false;
						die(var_dump($modelSPH->getErrors()));
					}
				}else{
					return false;
					die(var_dump($departMentlog->getErrors()));
				}
            } else {
				return false;
                die(var_dump($investorLog->getErrors()));
            }
		}
		
	}
	
	function actionApplicantRevokeReqAcceptorReject()
	{
		$current_date = date('Y-m-d H:i:s');
		extract($_POST);
		/*echo "<pre>";
		print_r($_POST);die;
		 */
		if($action=='accept'){
			$this->SendNotification($_SESSION['RESPONSE']['user_id'],'0','1','83',"Revoke Request Accept For SRN: $subID","Revoke Request Accepted For Application Id :$subID",'Revoked');
			
			$updateRevoke = "UPDATE bo_revoke_submission SET applicant_take_action ='1' WHERE app_id='$subID'";
			Yii::app()->db->createCommand($updateRevoke)->execute();
		}
		if($action=='reject'){
			$this->SendNotification($_SESSION['RESPONSE']['user_id'],'0','1','83',"Revoke Request Reject For SRN: $subID","Revoke Request Rejected For Application Id :$subID",'Revoked');
			
			$updateRevoke = "UPDATE bo_revoke_submission SET applicant_take_action ='2' WHERE app_id='$subID'";
			Yii::app()->db->createCommand($updateRevoke)->execute();
		}	
		return true;
		die();
	}
	
	function actionRevokeNameReservation()
	{
	///backoffice/infowizard/subFormCompanyNameReservation/revokeNameReservation
		/* $approvedData = Yii::app()->db->createCommand("SELECT sso_users.email,sso_users.iuid,sso_users.user_id,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number, 
bo_new_application_submission.submission_id,bo_new_application_submission.application_status,bo_information_wizard_service_parameters.core_service_name, 
bo_new_application_submission.application_updated_date_time,
 bo_information_wizard_service_parameters.service_id as s_id
FROM bo_new_application_submission 
INNER JOIN sso_users ON sso_users.user_id = bo_new_application_submission.user_id
INNER JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id
INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id = concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id = bo_information_wizard_service_master.id
INNER JOIN bo_infowizard_issuerby_master ON bo_information_wizard_service_master.issuerby_id = bo_infowizard_issuerby_master.issuerby_id
WHERE bo_new_application_submission.application_status='A' AND bo_new_application_submission.service_id IN('4.0','5.0','6.0','7.0','8.0','9.0','10.0') group by bo_new_application_submission.submission_id ORDER BY bo_new_application_submission.submission_id DESC")->queryAll(); */

		$approvedData = Yii::app()->db->createCommand("SELECT sso_users.email,sso_users.iuid,sso_users.user_id,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number,bo_company_details.id,bo_company_details.srn_no,bo_company_details.name_related_srn,bo_company_details.reg_no,bo_company_details.company_name,bo_company_details.created_on,bo_information_wizard_service_parameters.service_id as s_id,bo_information_wizard_service_parameters.core_service_name,bo_company_details.company_type FROM bo_company_details 
		INNER JOIN sso_users ON sso_users.user_id = bo_company_details.user_id
		INNER JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id
		INNER JOIN bo_information_wizard_service_parameters on bo_company_details.service_id = concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
		INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id = bo_information_wizard_service_master.id
		INNER JOIN bo_infowizard_issuerby_master ON bo_information_wizard_service_master.issuerby_id = bo_infowizard_issuerby_master.issuerby_id group by bo_company_details.srn_no ORDER BY bo_company_details.srn_no DESC")->queryAll();

			
		if($_POST){
		
			/* echo "<pre>";
			print_r($_POST);
			print_r($_SESSION);
			die("sdcsdc"); */
			extract($_POST);
			
			$modelRevoke = new RevokeSubmission;
			$modelRevoke->app_id = $revoke_app_id;
			$modelRevoke->dept_user_id = $_SESSION['uid'];
			$modelRevoke->role_id = $_SESSION['role_id'];
			$modelRevoke->comment = $revokemsg;
			$modelRevoke->status = 'Y';
			$modelRevoke->created = date('Y-m-d H:i:s');
			if($modelRevoke->save()) 
			{		
				
				$userDetails = Yii::app()->db->createCommand("SELECT sso_users.user_id,bo_company_details.reg_no
				FROM bo_company_details 
				INNER JOIN sso_users ON sso_users.user_id = bo_company_details.user_id
				WHERE bo_company_details.srn_no='$revoke_app_id'")->queryRow();
			

       /* $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $revoke_app_id  . "'";
        $model = NewApplicationSubmission::model()->findBySql($sql);
        Sendmailforservice::senttofobo_revokenotice($model);*/


				$this->SendNotification($_SESSION['uid'],$_SESSION['role_id'],$userDetails['user_id'],'0',"Revoke Requested for SRN: $revoke_app_id",$revokemsg,'Revoked');
				Yii::app()->user->setFlash('success', "Revoke request sent successfully for entity number $userDetails[reg_no].");
			}else{
				  die(var_dump($modelRevoke->getErrors()));
			}
		}
		$this->render("revoke_application", array('approvedData' => $approvedData));
	
	}
	
	public function SendNotification($sender_id,$sender_role_id,$receiver_id,$receiver_role_id,$title,$msg,$type)
	{
		$modelNotification = new NotificationSubmission;
		$modelNotification->sender_id = $sender_id;
		$modelNotification->sender_role_id = $sender_role_id;
		$modelNotification->receiver_id = $receiver_id;
		$modelNotification->receiver_role_id = $receiver_role_id;		
		$modelNotification->status = 0;
		$modelNotification->subject = $title;
		$modelNotification->message = $msg;
		$modelNotification->notification_type = $type;
		$modelNotification->created = date('Y-m-d H:i:s');
		if($modelNotification->save()) 
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function actionGetAllNotification(){
		if(isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id']))
		{
			$user_id = $_SESSION['RESPONSE']['user_id'];
			
			$allNotificationArr = Yii::app()->db->createCommand("SELECT * FROM bo_notification WHERE status='0' and receiver_id='$user_id' ORDER BY id DESC ")->queryAll();			
			$Output = '';
			If(count($allNotificationArr) > 0)
			{
				foreach($allNotificationArr as $key=>$val)
				{
				  $Output .= '<li rel='.$val['id'].' class="list_services">
							<a href="javascript:;">
								<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-bell-o"></i>
									</span>'.$val['subject'].'
								</span>
							</a>
							</li>';
				}
			}
			
			$Data = Array(
			   'Notification' => $Output,
			   'Unseen_notification'  => count($allNotificationArr)
			);
			echo Json_encode($Data);
		}else{
			$Data = Array(
			   'Notification' => "",
			   'Unseen_notification'  => ""
			);
			echo Json_encode($Data);
		}
		
	}
	
	public function actionUpdateNotification()
	{	
		if(isset($_POST['id']) && !empty($_POST['id']))
		{ 	
			extract($_POST);
			$updateNotification = "UPDATE bo_notification SET status ='1' WHERE id='$id'";
			Yii::app()->db->createCommand($updateNotification)->execute();
			echo true;
			
		}else{
			echo false;		
		}
		
		die;
	}
	
	public function actionGetBoAllNotification(){
		//print_r($_SESSION);die;
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid']))
		{
			$user_id = $_SESSION['uid'];
			
			$allNotificationArr = Yii::app()->db->createCommand("SELECT * FROM bo_notification WHERE status='0' and receiver_id='$user_id' ORDER BY id DESC ")->queryAll();			
			$Output = '';
			If(count($allNotificationArr) > 0)
			{
				foreach($allNotificationArr as $key=>$val)
				{
				  $Output .= '<li rel='.$val['id'].' class="list_services_bo">
							<a href="javascript:;">
								<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-bell-o"></i>
									</span>'.$val['subject'].'
								</span>
							</a>
							</li>';
				}
			}
			
			$Data = Array(
			   'Notification' => $Output,
			   'Unseen_notification'  => count($allNotificationArr)
			);
			echo Json_encode($Data);
		}else{
			$Data = Array(
			   'Notification' => "",
			   'Unseen_notification'  => ""
			);
			echo Json_encode($Data);
		}
		
	}
	
	public function actionUpdateBoNotification()
	{	
		if(isset($_POST['id']) && !empty($_POST['id']))
		{ 	
			extract($_POST);
			$updateNotification = "UPDATE bo_notification SET status ='1' WHERE id='$id'";
			Yii::app()->db->createCommand($updateNotification)->execute();
			echo true;
			
		}else{
			echo false;		
		}
		
		die;
	}

	function actionAssignNewName()
	{
		
		if(isset($_POST)){
			//print_r($_POST);die;
			if(isset($_POST['name_related_srn']) && !empty($_POST['name_related_srn']))
			{
				$app_Sub_id = $_POST['name_related_srn'];
			}else{
				$app_Sub_id = $_POST['new_app_id'];
			}
			$userDetails=Yii::app()->db->createCommand("SELECT sso_users.email,sso_users.iuid,sso_users.user_id,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number,bo_new_application_submission.submission_id,bo_new_application_submission.application_status,bo_new_application_submission.application_updated_date_time,bo_new_application_submission.field_value
			FROM bo_new_application_submission 
			INNER JOIN sso_users ON sso_users.user_id = bo_new_application_submission.user_id
			INNER JOIN sso_profiles ON sso_profiles.user_id = sso_users.user_id
			WHERE bo_new_application_submission.submission_id='$app_Sub_id'")->queryRow();
			
			$recommmendedUpdateQuery = "UPDATE bo_recomended_name SET assign_new_name = '$_POST[new_name_company]',assign_new_name_status='1' WHERE submission_id='$app_Sub_id'";
			Yii::app()->db->createCommand($recommmendedUpdateQuery)->execute();
			
			$revokeRequestUpdateQuery = "UPDATE bo_revoke_submission SET department_take_action = '1' WHERE app_id='$app_Sub_id'";
			Yii::app()->db->createCommand($revokeRequestUpdateQuery)->execute();
			$current_date = date('Y-m-d H:i:s');
			
			$updateReserveWord = "UPDATE bo_banned_words SET status ='N',updated='$current_date' WHERE app_id='$app_Sub_id'";
			Yii::app()->db->createCommand($updateReserveWord)->execute();
			
			$fieldValue = json_decode($userDetails['field_value'],true);
			
			if(isset($fieldValue['UK-FCL-00044_0']) && $fieldValue['UK-FCL-00044_0']==1)
			{
				$banned_words_type = 'SOCIETY_NAME';
			}
			if(isset($fieldValue['UK-FCL-00044_0']) && $fieldValue['UK-FCL-00044_0']==2)
			{
				$banned_words_type = 'COMPANY_RESERVED';
			}
			if(isset($fieldValue['UK-FCL-00044_0']) && $fieldValue['UK-FCL-00044_0']==3)
			{
				$banned_words_type = 'BUSINESS_NAME';
			}
			if(isset($fieldValue['UK-FCL-00044_0']) && $fieldValue['UK-FCL-00044_0']==4)
			{
				$banned_words_type = 'CHARITY_NAME';
			}
			
			if(isset($_POST['comp_type']) && !empty($_POST['comp_type']) && $_POST['comp_type']=='S')
			{
				$banned_words_type = 'SOCIETY_NAME';
			}
			if(isset($_POST['comp_type']) && !empty($_POST['comp_type']) && $_POST['comp_type']=='CH')
			{
				$banned_words_type = 'CHARITY_NAME';
			}
			if(isset($_POST['comp_type']) && !empty($_POST['comp_type']) && !in_array($_POST['comp_type'],array('CH','S')))
			{
				$banned_words_type = 'COMPANY_RESERVED';
			}
			
			if(isset($_POST['comp_type']) && !empty($_POST['comp_type']))
			{
				$companyDetailUpdate = "UPDATE bo_company_details SET company_name = '$_POST[new_name_company]' WHERE srn_no='$_POST[new_app_id]'";
				Yii::app()->db->createCommand($companyDetailUpdate)->execute();
				
				$compRegNo = Yii::app()->db->createCommand("SELECT reg_no from bo_company_details where WHERE srn_no='$_POST[new_app_id]'")->queryRow();
			}
			
			$ReservedNamemodel = new ReservedName();
			$ReservedNamemodel->banned_words_name = $_POST['new_name_company'];
			$ReservedNamemodel->banned_words_type = $banned_words_type;
			$ReservedNamemodel->status = 'Y';
			$ReservedNamemodel->process_from = 'SYSTEM';
			$ReservedNamemodel->created = date('Y-m-d H:i:s');
			$ReservedNamemodel->app_id = $app_Sub_id;
			if($ReservedNamemodel->save())
			{
				if(in_array($_POST['comp_type'],array('NPC','EC','IC'))) 
				{
					$data = '';
					$path = '';
					$name = "CERTIFICATE_" . $_POST['new_app_id'] . ".pdf";
					//http://52.172.209.7/backoffice/infowizardtwo/subFormPdf/SaveRevokeApprovalCertificate2_0/service_id/Mi4w/subID/NTAz/dept_id/MQ==/companynewname/Octal%20info%20solution/company_no/BB00002021
				
					$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
					
					$uid = $_SESSION['uid'];
					$boUser=Yii::app()->db->createCommand("SELECT * FROM bo_user where uid='$uid'")->queryRow(); 
					$username = @$boUser['full_name'].' '.@$boUser['last_name'];
					$username = 'TAMIESHA ROCHESTER';

					$download_certificate_call_back_url1 = CURL_URL."/backoffice/infowizardtwo/subFormPdf/SaveRevokeApprovalCertificate2_0/service_id/" . base64_encode($_POST['service_id']) . "/subID/" . base64_encode($_POST['new_app_id']) . "/dept_id/" . base64_encode(1).'/companynewname/'.base64_encode($_POST['new_name_company']).'/company_no/'.base64_encode($compRegNo['reg_no']).'/uname/'.base64_encode($username);
					$path = Yii::app()->basePath . "/caipo_certificate/" . $name;
					
					$download_certificate_call_back_url = BASE_URL."/backoffice/protected/caipo_certificate/" . $name;
					$res = $this->SavePdf($download_certificate_call_back_url1, $path);
					$d_url = BASE_URL."/backoffice/protected/caipo_certificate/CERTIFICATE_" . $_POST['new_app_id'] . '.pdf';
                }
				
				$this->SendNotification($_SESSION['uid'],$_SESSION['role_id'],$userDetails['user_id'],'0',"New Name Assign for SRN: $app_Sub_id","New Name Assign to SRN: $app_Sub_id",'Assignname');

				Yii::app()->user->setFlash('success', "New name assign successfully for SRN: $app_Sub_id.");
				$this->redirect('/backoffice/infowizardtwo/subFormCompanyNameReservation/revokeNameReservation/otd/2');
			
			}else{			
				die(var_dump($ReservedNamemodel->getErrors()));
			}
		}
	}
	
	public function actionGetpostalcode(){
         $p_id = $_GET['p_id'];
         $postalcode = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where p_id=$p_id")->queryAll();
         if($postalcode){
            echo "<option value=''>Please Select</option>";
            foreach ($postalcode as $key => $value) {
             echo "<option value='".$value['id']."'>".$value['district'].' - '.$value['code']."</option>";
            }
         }else{
            echo "<option>-</option>";
         }
    }
	
	public function actionGetSocietyName(){
		
		$reg_no = $_POST['reg_no'];
		$userID = $_SESSION['RESPONSE']['user_id'];
		$compArr = Yii::app()->db->createCommand("SELECT company_name from bo_company_details where reg_no='$reg_no' and company_type='S' and user_id='$userID'")->queryRow();
		
		if(isset($compArr) && !empty($compArr)){
			echo $compArr['company_name'];		
		}else{
			echo  "";
		} 
		die();
    }	
	
	public function actionGetCompanyName(){
		$reg_no = $_POST['reg_no'];
		$type_of_company = $_POST['type_of_company'];
		if($type_of_company==1){
			$type="EC";
		}
		if($type_of_company==2){
			$type="NPC";
		}
		if($type_of_company==3){
			$type="IC";
		}
		$userID = $_SESSION['RESPONSE']['user_id'];
		
		$compArr = Yii::app()->db->createCommand("SELECT company_name from bo_company_details where reg_no='$reg_no' and company_type='$type' and user_id='$userID'")->queryRow();

		if(isset($compArr) && !empty($compArr)){
			echo $compArr['company_name'];		
		}else{
			echo  "";
		}
		die();
    }
	
	public function actionGetBusinessName(){
		$reg_no = $_POST['reg_no'];		
		$userID = $_SESSION['RESPONSE']['user_id'];		
		$compArr = Yii::app()->db->createCommand("SELECT company_name,address,srn_no from
		bo_company_details where reg_no='$reg_no' and user_id='$userID'")->queryRow();
		if(isset($compArr) && !empty($compArr)){
			$apprvedDateArr = Yii::app()->db->createCommand("SELECT updated_date_time from
			bo_infowiz_formbuilder_application_forward_level where app_Sub_id='$compArr[srn_no]' and next_role_id='84' order by appr_lvl_id DESC")->queryRow();
			
			$date = date('d/m/Y',strtotime($apprvedDateArr['updated_date_time']));
			
			echo $compArr['company_name'].'-'.$compArr['address'].'-'.$date;		
		}else{
			echo  "";
		}
		die();
    }
}
