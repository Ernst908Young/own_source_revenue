<?php

class SubFormArticlesofRevivalform21Controller extends Controller {

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
        $appSubID = DefaultUtility::dataSenetize($appSubID);
        $val = DefaultUtility::dataSenetize($val);
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
        $notification_msg_bo = 'Status has been changed';
    	$notification_msg_fo = 'Status has been changed';
        /* echo "<pre>";        
          print_r($_POST);
          die(); */

        //$allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_infowiz_formbuilder_application_forward_level' AND is_active='Y'")->queryAll();
        $current_role_id = DefaultUtility::dataSenetize($_SESSION['role_id']);
        $serviceID = DefaultUtility::dataSenetize($_POST['service_id']);
        $app_Sub_id = DefaultUtility::dataSenetize($_POST['app_Sub_id']);

                /*
        *  validation for same action perform by 2 or more user: BY- Aamir
        */

        $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_Sub_id  . "'";
        $model = NewApplicationSubmission::model()->findBySql($sql);

        if($model){
          $responce = Processapplication::Matchstatus($model,$_POST['app_status']);
            if($responce==false){
                Yii::app()->user->setFlash('error', "Please verify / approve the required documents first OR Some one can performed the action on this application");
                return $this->redirect('/backoffice/admin');
            }           
        }else{
            Yii::app()->user->setFlash('error', "Something went wrong while processing the record. Please try again");
            return $this->redirect('/backoffice/admin');
        }

/*
* Code end
*/

        $allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where (service_id=$serviceID OR service_id=0) AND is_active='Y' AND table_name='bo_infowiz_formbuilder_application_forward_level' order by id desc")->queryAll();

        $allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id='$current_role_id' AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
        $canRevToInves = $allData['can_revert_to_investor'];
        $CurrentallData = $allData;
        if ($_POST['app_status'] == 'F') {
            $allData = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration where service_id='$serviceID' AND current_role_id=$current_role_id AND forward_role_id > 0 AND processing_level = (Select bo_new_application_submission.processing_level from bo_new_application_submission where bo_new_application_submission.submission_id='$app_Sub_id')")->queryRow();
        }

        $sptagData = Yii::app()->db->createCommand("SELECT service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id IN (select dept_id from bo_new_application_submission where service_id='$serviceID' )")->queryRow();
     
        $app_status = DefaultUtility::dataSenetize($_POST['app_status']);
       
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
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been reverted to applicant.");
                $msglog = "Application Id : $app_Sub_id has been reverted.";
                $reverted_call_back_url = "/backoffice/infowizardtwo/subFormArticlesofRevivalform21/updateSubForm/service_id/" . $_POST['service_id'] . "/pageID/1/subID/" . $_POST['app_Sub_id'] . "/formCodeID/1";
                $notification_msg_bo = 'Your Application Reverted';
                $notification_msg_fo = 'Application Reverted';
               }
            if ($_POST['app_status'] == 'A') {
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been approved successfully.");
                $msglog = "Application Id : $app_Sub_id has been approved successfully.";
                $updateNewApplication = Yii::app()->db->createCommand("update bo_new_application_submission set application_status='$app_status' where submission_id=$app_Sub_id")->execute();

                // Aamir Code For Company registration number
$fetchsrnRecords = Yii::app()->db->createCommand("SELECT  service_id,submission_id,user_id,field_value FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();

                $farr = (array) json_decode($fetchsrnRecords['field_value']);
                $name_related_srn = isset($farr['UK-FCL-00331_0']) ? $farr['UK-FCL-00331_0'] : NULL;
                $c_name = @$farr['UK-FCL-00089_0']; // second field of the form 
                $maxid = @$farr['UK-FCL-00403_0']; // second field of the form 
                $asrn = $fetchsrnRecords['submission_id'];
                $aser_id = $fetchsrnRecords['service_id'];
                $auser_id = $fetchsrnRecords['user_id'] ;
                $loginuserid = $_SESSION['uid'];

                $c_type = 'AR21'; // Articles of Revival (Form 21)

				// $cdmaxid = BoCompanyDetails::getreg_no($c_type);
				// echo $cdmaxid;die;
//$maxid = "BBC".date('Y').(str_pad($cdmaxid['max'], 6, '0', STR_PAD_LEFT));
				// $maxid = $cdmaxid;


/*$parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$farr['UK-FCL-00345_0'])->queryRow(); 

if($farr['UK-FCL-00346_0']){
       $post1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$farr['UK-FCL-00346_0'])->queryRow(); 
       $pc1 = $post1['code'];
      }else{
        $pc1 = "";
      }

  $fulladdress =     @$farr['UK-FCL-00340_0'].' '.@$farr['UK-FCL-00341_0'].' '.@$farr['UK-FCL-00344_0'].' '. @$pc1.' '.@$parish1['lr_name'].' '.@$farr['UK-FCL-00347_0'] ; */

        $companyDetail = new BoCompanyDetails;
        $companyDetail->srn_no = $asrn;
        $companyDetail->name_related_srn = $name_related_srn;
        $companyDetail->service_id = $aser_id;
        $companyDetail->company_type = 'AR21';
        $companyDetail->reg_no = $maxid;
        $companyDetail->company_name = $c_name;
        $companyDetail->user_id = $auser_id;
        $companyDetail->approved_by = $loginuserid;  
       /* $companyDetail->address = $fulladdress;       
         $companyDetail->address_line1 = @$farr['UK-FCL-00340_0'];
         $companyDetail->address_line2 = @$farr['UK-FCL-00341_0'];
         $companyDetail->city = @$farr['UK-FCL-00344_0'];
         $companyDetail->state_parish_id = $farr['UK-FCL-00345_0'];
         $companyDetail->postal_code_id = @$farr['UK-FCL-00346_0'];
         $companyDetail->state_parish = @$parish1['lr_name'];
         $companyDetail->postal_code = @$pc1;
         $companyDetail->country = @$farr['UK-FCL-00347_0'];*/
        $companyDetail->save();

/*Yii::app()->db->createCommand("INSERT INTO bo_company_details (srn_no, name_related_srn, service_id, company_type, reg_no,company_name,user_id,approved_by,address)
                VALUES ($asrn, $name_related_srn, $aser_id, 'IC', '".$maxid."', '".$c_name."', $auser_id, $loginuserid, '".$fulladdress."')")->execute();*/
                // end of aamir code

                $currentDate = date('Y-m-d H:i:s');
                $d_url = "";
                if ($_POST['service_id'] == '24.0') {
                    $data = '';
                    $path = '';
                    $name = "CERTIFICATE_" . $app_Sub_id . ".pdf";
                    $path = Yii::app()->basePath . "/caipo_certificate/" . $name;

                  

                    $download_certificate_call_back_url1 = CURL_URL."/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate24_0/service_id/" . base64_encode($_POST['service_id']) . "/subID/" . base64_encode($_POST['app_Sub_id']) . "/dept_id/" . base64_encode($dept_id)."/utility/Utility24_0c";
                    
                 
                    $res = $this->SavePdf($download_certificate_call_back_url1, $path);
                    $d_url = BASE_URL.'/backoffice/protected/caipo_certificate/CERTIFICATE_' . $app_Sub_id . '.pdf';
                }

                $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET download_certificate_call_back_url = '$d_url', application_updated_date_time='$currentDate', entity_name='".$companyDetail->reg_no."' WHERE submission_id='$app_Sub_id'";
                $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
                $notification_msg_bo = 'Your Application Approved';
                $notification_msg_fo = 'Application Approved';

            }
            if ($_POST['app_status'] == 'R') {
                 $update_date = date('Y-m-d H:i:s');
                $sql_update = "UPDATE bo_new_application_submission SET application_status='R' ,application_updated_date_time='$update_date' where submission_id='$app_Sub_id'";
                        $updateNewApp = Yii::app()->db->createCommand($sql_update)->execute();
                Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been rejected.");
                $msglog = "Application Id : $app_Sub_id has been rejected.";
                 Rejectapplication::refundrequest($app_Sub_id);
                 $notification_msg_bo = 'Your Application Rejected';
                 $notification_msg_fo = 'Application Rejected';
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
                    if (isset($_SESSION) && $_SESSION['role_id'] == 86) {
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
                    {   /* print_r($_FILES);die; */
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
                {   /* print_r($_FILES);die; */
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
                    Yii::app()->user->setFlash('success', "Application Id : $app_Sub_id has been forwarded to Approver");
                    $this->redirect("/backoffice/admin");
                    $department_log_id = Yii::app()->db->getLastInsertID();
                }
                $notification_msg_bo = 'Your Application has been Forwarded to Approver';
                $notification_msg_fo = 'Application has been Forwarded to Approver';
            }
            $nocPath = "";
                            $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $app_Sub_id  . "'";
                            $model = NewApplicationSubmission::model()->findBySql($sql);
                            Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO',$notification_msg_fo); 
              
                            Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$_SESSION['uid'],'BO',$notification_msg_bo);  

                            Sendmailforservice::senttofobo_departmentstatus($model);
                           $this->redirect("/backoffice/admin");
        }
    }

    public function getApplicationProcessingLevel($service_id = null, $postData = null) {
        $service_id = DefaultUtility::dataSenetize($service_id);
        $postData = DefaultUtility::dataSenetize($postData);
        if (isset($postData['UK-FCL-00038_10']) && !empty($postData['UK-FCL-00038_10']) && isset($postData['UK-FCL-00051_3']) && !empty($postData['UK-FCL-00051_3']) && $service_id == '591.0') {
            // 
            if (isset($postData["UK-FCL-00648_0"]) && !empty($postData["UK-FCL-00648_0"]) && $_POST['UK-FCL-00038_11'] != 'New') {
                $natureOfUnit = $postData['UK-FCL-00038_10']; //Nature of Unit
                $Investment = $postData['UK-FCL-00645_0']; //Investment
            } else {
                $natureOfUnit = $postData['UK-FCL-00038_10']; //Nature of Unit
                $Investment = $postData['UK-FCL-00051_3']; //Investment
            }
            //10 Crore 1000 lakhs
            if ($natureOfUnit == 'Manufacturing' && $Investment > 1000) {
                $processLevel = 'State';
            }
            //5 Crore 500 lakhs
            if ($natureOfUnit == 'Services' && $Investment > 500) {
                $processLevel = 'State';
            }
            if (isset($processLevel) && !empty($processLevel)) {
                return $processLevel;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public function actionSaveData() {


        $saved_caf_id = NULL;
        if (!empty($_POST) && !Yii::app()->request->isAjaxRequest) {
            $approvel_id = 0;
            $serviceID = DefaultUtility::dataSenetize($_POST['service_id']);
            $issuer_id = DefaultUtility::dataSenetize($_POST['issuer_id']);
            $approval_id = DefaultUtility::dataSenetize(@$_POST['approval_id']);
            $applicationExt = New ApplicationExt;
            $serviceArr = $applicationExt->getServiceNameById($serviceID);
            $service_Name = $serviceArr['core_service_name'];
            $docFlag = 0;
           
            if (isset($_POST['submission_id'])) {

                $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $_POST['submission_id'] . "'";
                
                $model = NewApplicationSubmission::model()->findBySql($sql);
                $submission_id = DefaultUtility::dataSenetize($_POST['submission_id']);              
            } else {
                $model = new NewApplicationSubmission();
            }
            if(isset($_POST['UK-FCL-00331_0']))
            $model->name_related_srn = DefaultUtility::dataSenetize($_POST['UK-FCL-00331_0']);
            $model->processing_level = 'District';
            $processLevel = $model->processing_level;

            $s = "SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=:service_id AND current_role_id=0 AND processing_level='$processLevel'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s);
            $command->bindParam(":service_id",$serviceID, PDO::PARAM_STR);
            $allData = $command->queryRow();

        

            $allRes = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values where table_name='bo_new_application_submission' AND is_active='Y'")->queryAll();
            
            
            $s2 = "SELECT  bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_infowizard_issuerby_master.service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id=:issuer_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s2);
            $command->bindParam(":issuer_id",$issuer_id, PDO::PARAM_STR);
            $getDepartMentId = $command->queryRow();
            
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
            }
// End Code of service provider 
            //Entity Code By Aamir
                        $model->entity_name = $_POST['UK-FCL-00403_0'];
            //End Entity Code
            
            $landrigion_id = $model->landrigion_id;
            if($model->save()) 
            {               
                if (isset($_POST['submission_id'])) {
                    $application_id = DefaultUtility::dataSenetize($_POST['submission_id']);
                } else {
                    $application_id = Yii::app()->db->getLastInsertId();
                }
                
                $reverted_call_back_url = "/backoffice/infowizardtwo/subFormArticlesofRevivalform21/updateSubForm/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
                $print_app_call_back_url ="/backoffice/infowizardtwo/subFormArticlesofRevivalform21/downloadNewApp/service_id/".$_POST['service_id']."/pageID/1/subID/".$application_id."/formCodeID/1";
                
                Yii::app()->db->createCommand("update bo_new_application_submission set reverted_call_back_url='$reverted_call_back_url',print_app_call_back_url='$print_app_call_back_url' where submission_id=$application_id")->execute();
                
                //Investor log Save
                $modellog = new NewApplicationSubmissionLog();
                $modellog->field_value = json_encode($_POST);
                $modellog->submission_id = $application_id;
                $modellog->application_id = $application_id;
                $modellog->user_id = $model->user_id;
                $modellog->dept_id = $getDepartMentId['issuerby_id'];
                $modellog->application_status = 'DP';                   
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
                $modelSPH->sp_tag = $getDepartMentId['service_provider_tag'];
                $modelSPH->app_id = $application_id;
                $modelSPH->application_status = 'DP';
                $modelSPH->comments = 'Application Submitted but Document Pending';
                $modelSPH->added_date_time = date('Y-m-d H:i:s');

                if ($modelSPH->save()) 
                {
                    
                } else {
                    die(var_dump($modelSPH->getErrors()));
                }
                //END Save Data IN bo_sp_application_history for log    
                
                $this->insertApplicationLog(@$_POST['service_id'], 1, @$getDepartMentId['issuerby_id'], @$application_id, '0', $model->application_status, 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);

               // Yii::app()->user->setFlash('success', "Your application for $service_Name has been submitted successfully . Your application id  is : $application_id");
                 Yii::app()->user->setFlash('success', "Application details saved, please upload documents");
                 Sendmailforservice::senttofo_draftmode($model);
                 Alertsandnotification::sendnotification('Services', $model->submission_id,$model->submission_id,$model->user_id,'FO','Application details saved successfully'); 
              
                if(isset($_SESSION['RESPONSE']["user_id"]) && !empty($_SESSION['RESPONSE']["user_id"])) 
                {
                    $seriveArr = explode(".",DefaultUtility::dataSenetize($_POST['service_id']));
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
//      $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id='1' ORDER BY submission_id ASC";
//      $connection=Yii::app()->db; 
//      $command=$connection->createCommand($sql_caf);
//      $res_caf = $command->queryAll();
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
        $serviceID = DefaultUtility::dataSenetize($serviceID);
        $formCodeID = DefaultUtility::dataSenetize($formCodeID);
        $uniqArr=array();
        //$serviceID = "68.0";
        //Blank array for filtered records
        $additionalCondition = "";
        if (!empty($formCodeID)) {
            $additionalCondition = " AND form_id=$formCodeID ";
        }
        $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination = array();
        // Getting All Active Pages for Form in ASC preference
        $allActivePagesASC = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();
        // echo "<pre>";print_r($allActivePagesASC);
        if (!empty($allActivePagesASC)) {
            foreach ($allActivePagesASC as $pageAsPerPreferenceASC) {
                // Getting All Active Pages for Category ASC preference
                $allActiveCategoriesASC = Yii::app()->db->createCommand("SELECT category_id FROM bo_page_category_mapping where page_id=$pageAsPerPreferenceASC[id]  AND is_active='Y' order by prefrence ASC")->queryAll();
                if (!empty($allActiveCategoriesASC)) {
                    foreach ($allActiveCategoriesASC as $categoryAsPerPreferenceASC) {
                        // Getting All Active Form field ASC
                        $allActiveMappedFormFieldASC = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' order by preference ASC")->queryAll();
                        
                        if (!empty($allActiveMappedFormFieldASC)) {
                            //print_r($allActiveMappedFormFieldASC); die;
                            foreach ($allActiveMappedFormFieldASC as $formfieldAsPerPrefernceASC) {
                            if(!in_array($formfieldAsPerPrefernceASC['id'],$uniqArr)){
                            $uniqArr[]=$formfieldAsPerPrefernceASC['id'];
                                $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination[]=$formfieldAsPerPrefernceASC;
                                }
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
            $serviceId = $_GET['service_id'];
            $formCodeID = DefaultUtility::dataSenetize($_GET['formCodeID']);

            // Getting all active land records  
            //$allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' AND form_id = $formCodeID order by prefrence ASC")->queryAll();
            $sql = "SELECT page_name,id FROM bo_infowiz_page_master where service_id=:service_id AND is_active='Y' AND form_id=:formCodeID order by prefrence ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(':service_id', $serviceId, PDO::PARAM_STR);
            $command->bindParam(':formCodeID', $formCodeID, PDO::PARAM_STR);
            $allActivePages = $command->queryAll();
            extract($_GET);
            $formData = $this->alignInSequence($service_id, $formCodeID);
            /*  echo "<pre>";
              print_r($formData);die(); */

            $sql = "SELECT * FROM bo_new_application_submission where submission_id=:subID";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(':subID', $subID, PDO::PARAM_STR);
            $fieldValues = $command->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
        }
        $this->render('updatesubform', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'serviceID' => $_GET['service_id'], 'issuer_id' => @$issuer_id));
    }
    
    
    public function actionSaveUpdateSubForm() {

        if(isset($_POST) && !empty($_POST)) {
            /*  echo "<pre>";
            print_r($_POST);
            die();  */ 
            extract($_POST);

            $submission_id = DefaultUtility::dataSenetize($_POST['submission_id']);
            $msgFlag = 'submitted the application';

        

            $s = "SELECT * FROM bo_new_application_submission where submission_id=:submission_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $allData = $command->queryRow();


            if($allData['application_status']=='H'){                
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
            
        
                        
            $serviceID = $allData['service_id'];

            $s2 = "SELECT id,fee_detail FROM bo_information_wizard_service_fee WHERE CONCAT(service_id,'.',servicetype_additionalsubservice) =:serviceID";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s2);
            $command->bindParam(":serviceID",$serviceID, PDO::PARAM_STR);
            $sqlCheckFeeAplicable = $command->queryRow();
            
            $user_id = $_SESSION['RESPONSE']['user_id'];

         /*   $s3 = "SELECT count(*) as total FROM bo_unified_payment_logs WHERE service_id = '$serviceID' AND submission_id =:submission_id
                 AND user_id=:user_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s3);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $command->bindParam(":user_id",$user_id, PDO::PARAM_STR);            
            $sqlCheckPaymentPaidorNot = $command->queryRow();       */
        
        
            
            //Check document exist or not               
        

             $s3 = "SELECT * FROM bo_application_dms_documents_mapping where sno=:submission_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s3);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $documentExistCheck = $command->queryRow();
            
            if(empty($documentExistCheck))
            {
                $stat = 'DP';
                $msgFlag='submitted the application but document pending';  
                $docFlag = 1;           
            }else if($docFlag==0)
            {
                $stat = 'PD';
                $msgFlag='submitted the application but paymnet due';
                $pdsatus = 1;
            }
            
            
            $msglog = "Investor has $msgFlag";
        
        
            /* $s4 = "SELECT id,formvar_code FROM bo_infowiz_form_builder_config_values where use_for='landrigion_id' and table_name='bo_new_application_submission' and is_active='Y' and (service_id='0' OR service_id=:service_id) order by service_id DESC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s4);
            $command->bindParam(":$service_id",$$service_id, PDO::PARAM_STR);
            $landRegionArr = $command->queryRow();
            
        
            $landrigion_id = @$_POST[$landRegionArr['formvar_code']];           
            $landrigion_id = @$landrigion_id;*/

        

            $s4 = "update bo_new_application_submission set field_value='$postData',application_status='$stat',app_comments='$msglog',application_updated_date_time='$currentDate' where submission_id=:submission_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s4);
            $command->bindParam(":submission_id",$submission_id, PDO::PARAM_STR);
            $command->execute();
            
            //End of code use for landrigion id     
             $s5 = "SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.abb,bo_infowizard_issuerby_master.service_provider_tag FROM bo_infowizard_issuerby_master where issuerby_id=:issuer_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s5);
            $command->bindParam(":issuer_id",$issuer_id, PDO::PARAM_STR);
            $sptagData =  $command->queryRow();

            $service_provider_tag = $sptagData['service_provider_tag'];

            $s6 = "SELECT * FROM bo_infowiz_form_builder_configuration where service_id=:serviceID AND current_role_id=0  AND processing_level ='District'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($s6);
            $command->bindParam(":serviceID",$serviceID, PDO::PARAM_STR);
            $resArr =  $command->queryRow();
            
          
                
            $department_log_id = 0;
            
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
                $modelSPH->application_status =$allData['application_status'];
                $modelSPH->comments = "$msglog";
                $modelSPH->added_date_time = date('Y-m-d H:i:s');
                
                if($modelSPH->save())
                {
                    
                }else{
                    die(var_dump($modelSPH->getErrors()));
                }
                //END Save Data IN bo_sp_application_history for log                
                
                
                $this->insertApplicationLog(@$allData['service_id'], @$allData['form_id'], @$allData['dept_id'], @$allData['submission_id'], '0', @$allData['application_status'], 'Investor', @$msglog, @$_SESSION['RESPONSE']["user_id"], '', @$investor_log_id, @$department_log_id);
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
                Alertsandnotification::sendnotification('Services', $allData['submission_id'],$allData['submission_id'],$allData['user_id'],'FO','Application details saved successfully'); 
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
            extract($_GET);

            $formData = $this->alignInSequence($service_id, $formCodeID);

            /* echo "<pre>";
              print_r($formData);die(); */
            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id = $subID")->queryRow();
            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
        
       
      //  $content = $this->renderPartial('company_name_pdf_view', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);

       // $content = false;
        $signatoryDetails=Yii::app()->db->createCommand("SELECT * FROM bo_signature_metadata where submission_id = $subID and is_active=1")->queryAll();
        $content = $this->renderPartial('company_name_pdf_view', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'signatoryDetails'=>$signatoryDetails,'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);
        $contentform4 = $this->renderPartial('form4_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'signatoryDetails'=>$signatoryDetails, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);
        $contentform9 = $this->renderPartial('form9_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'signatoryDetails'=>$signatoryDetails, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);

         $signatory_details = $this->renderPartial('signatory_details', array('signatoryDetails'=>$signatoryDetails), true);
       
        $name = "CAIPO-Application_Form_" . time() . ".pdf";
        $app_log = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A'")->queryRow();
        //return print($content);

        //echo $content; die;
        Utility24_0::generatePdfApp($content,$contentform4,$contentform9, $name, $app_log,$signatory_details,$fieldValues2);
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
            $this->redirect('/backoffice/infowizardtwo/subForm/generateCertificate/service_id/' . $service_id . '/dept_id/' . $dept_id);
        }
        $getContentArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id='$service_id' AND dept_id='$dept_id'")->queryRow();

        $this->render('generate_certificate', array('getContentArr' => $getContentArr));
    }

    

    

  
    
    function actionSaveAllDocuments(){
        
        extract($_GET);
        $this->getExistingCafDocuments($sno,$service_id,$dept_id,$_SESSION['RESPONSE']['user_id']);     
        
        //For check fee applicable or not and paid or not for service           
        $sqlCheckFeeAplicable = Yii::app()->db->createCommand("SELECT id,fee_detail FROM bo_information_wizard_service_fee WHERE CONCAT(service_id,'.',servicetype_additionalsubservice) = $service_id")->queryRow();
        $user_id = $_SESSION['RESPONSE']['user_id'];
        //echo "<pre>"; print_r($sqlCheckFeeAplicable);die;     
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
        $submission_id = DefaultUtility::dataSenetize($submission_id);
        $sno = DefaultUtility::dataSenetize($sno);
        $service_id = DefaultUtility::dataSenetize($service_id);
        $processLevel = DefaultUtility::dataSenetize($processLevel);
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
                    }if(in_array($service_id,array('577.0','577.1'))){  //PPO message                   
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
                if ($model_app_log->save()) {
                        
                    
                    $serviceapp = Yii::app()->db->createCommand("SELECT submission_id, service_id, app_name from bo_new_application_submission where submission_id=$submission_id")->queryRow();
                    $service_Name = $serviceapp['app_name'];
                    $app_id = $serviceapp['submission_id'];
                   Yii::app()->user->setFlash('success', "Your application for $service_Name has been submitted successfully . Your application id  is : $app_id");
                }
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
       
        }
        curl_close($ch);
        $result = file_put_contents($path, $data);

        if (!$result) {
            return "error";
        } else {
            return "success";
        }
    }

    public function actionGetcompanyNameByregno(){
        $reg_no = DefaultUtility::dataSenetize($_GET['reg_no']);
        
        $user_id = $_SESSION['RESPONSE']['user_id'];
        $c_detail = Yii::app()->db->createCommand("SELECT * from bo_company_details WHERE company_type IN ('IC') AND user_id = $user_id  AND reg_no='".$reg_no."' AND service_id IN('4.0','5.0')")->queryRow();
      //  echo "SELECT * from bo_company_details WHERE company_type IN ('IC','NPC') AND user_id = $user_id  AND reg_no='".$reg_no;die;
        if($c_detail){  
                $subId=$c_detail['srn_no']; 
                $noOfDirector=0;  
                $appDetails = Yii::app()->db->createCommand("SELECT * from bo_new_application_submission WHERE submission_id=".$subId)->queryRow();
                $fieldValues=json_decode($appDetails['field_value'],true);
                if($c_detail['company_type']=='NPC')
                    $noOfDirector=@$fieldValues['UK-FCL-00149_0'];
                else
                    $noOfDirector=@$fieldValues['UK-FCL-00131_0'];

                echo CJavaScript::jsonEncode(
                    array('status'=>true,
                            'cname'=>$c_detail['company_name'],
                            'msg'=>'success',
                            'noOfDirector'=>$noOfDirector
                    )
                );
                      
        }else{
            echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Please enter a correct and valid Company Number'));
        }
        
    }
	
	 public function actionGetCompanyNameBySrnNo(){
        
            $srn_no = DefaultUtility::dataSenetize($_GET['srn_no']);
            $subid = DefaultUtility::dataSenetize($_GET['subID']);
           $user_id=@$_SESSION['RESPONSE']['user_id'];
        
           if($user_id){
            if($subid==NULL){
                $checkexistingappid = "";
            }else{
                $checkexistingappid = " AND submission_id NOT IN ($subid)";
            }
              
                $chk_srn_is_used = Yii::app()->db->createCommand("SELECT * from bo_new_application_submission 
                WHERE application_status IN ('A','PD','F','I','P','FA','AB','DP','W')
                $checkexistingappid AND user_id=$user_id 
                AND name_related_srn='".$srn_no."'")->queryRow();

                if($chk_srn_is_used){
                     echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'You have already applied for this service'));
                }else{
                    $name_res = Yii::app()->db->createCommand("SELECT submission_id 
                        from bo_new_application_submission                   
                        where service_id = '2.0'                   
                        AND submission_id='".$srn_no."'")->queryRow();
                    if($name_res){

                    $company_detail = Yii::app()->db->createCommand("SELECT * 
                        from bo_new_application_submission 
                        WHERE user_id=$user_id 
                        AND service_id = '2.0'
                        AND application_status = 'A'
                        AND submission_id='".$srn_no."'")->queryRow();
                        if($company_detail){
                            // below code is for name related service form 33 UK-FCL-00044_0
                            $checkformtype = (array) json_decode($company_detail['field_value']);

                            if($checkformtype['UK-FCL-00044_0']==2 && $checkformtype['UK-FCL-00012_0']=="Name change of existing company" && $checkformtype['UK-FCL-00032_0']=='2'){

                                $banned_words = Yii::app()->db->createCommand("SELECT * 
                                from bo_banned_words 
                                WHERE status='Y'
                                AND app_id='".$srn_no."'")->queryRow();

                                if($banned_words){
                                    $date1 = date_create(date('Y-m-d H:i:s'));
                                    $date2 = date_create(date('Y-m-d H:i:s',strtotime($banned_words['created'])));
                                    $diff  = date_diff($date1,$date2);
                                    $ad    = $diff->format("%a");
                                    $timeRemaining   = 90-$ad;
                                    if($timeRemaining>0){
                                     echo CJavaScript::jsonEncode(array('status'=>true,'app_status'=>'valid','name'=>$banned_words['banned_words_name'], 'timeremain'=>$timeRemaining,'msg'=>'success'));
                                    }else{
                                        echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'Name Reserved in 90 days can only be used.'));
                                    }
                                }else{
                                    echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'This SRN cannot be used as it belongs to banned list.'));
                                }

                            }else{
                                 echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'Please enter a valid and correct SRN of Form 33 which shall be pertaining to Revival of the Company'));
								 
                            }                                   
                        }else{         
                            echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'Your application for this SRN is not yet approved.'));
                            }
                        
                    }else{
                         echo CJavaScript::jsonEncode(array('status'=>false,'user'=>$user_id,'msg'=>'Please enter a valid and correct SRN of Form 33 which shall be pertaining to Revival of the Company


'));
                    }

                    
                }          
            }else{
                echo CJavaScript::jsonEncode(array('status'=>false,'user'=>false,'msg'=>'Your session has expired. Please re-login to apply.'));
               }
            
            
        }

    

}
