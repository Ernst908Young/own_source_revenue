<?php

class HomeController extends Controller {

    /**
     * this function is for Verify Payment
     * @author Rahul Kumar 
     */
    public function actionVerifyPayment() {
        $this->render('verify_payment');
    }
    /**
     * this function is for geting service and status wise dashboard count 
     * @author Rahul Kumar 
     */
     public static function GetServiceWiseCount($sc_id=null,$status=null,$userID=null, $individualuser_id=NULL){
             
        $statusCond ="";   
		if($status=='Draft'){			
			$statusCond = " AND bo_new_application_submission.application_status IN ('I','DP','SP') ";
		}else if($status=='Payment Due'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('PD') ";
        }else if($status=='Pending For Approval'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('P','F','AB','FA')";
        }else if($status=='Approved'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('A') ";
        }else if($status=='Reverted'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('H') ";
        }else if($status=='Refund Requested'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('RI','R') AND bo_new_application_submission.service_id NOT IN ('6.0','7.0')";
        }else if($status=='Refund Successful'){
            $statusCond = " AND bo_new_application_submission.application_status IN ('RS') ";
        }else{
			$statusCond = " AND bo_new_application_submission.application_status IN ('$status') ";
		}
        if($sc_id){
            $wheresc = " AND sc_id=$sc_id";
        }else{
            $wheresc = " ";
        }

        if($individualuser_id){
            $userID = $individualuser_id;
        }

         $sql="SELECT count(*) as total FROM bo_new_application_submission 
            INNER JOIN bo_information_wizard_service_parameters bosp
            ON bo_new_application_submission.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
            INNER JOIN bo_information_wizard_service_master 
            ON bo_information_wizard_service_master.id = bosp.service_id
            where  bosp.is_active='Y' $wheresc            
            $statusCond
            AND bo_new_application_submission.user_id=$userID";

            // print_r($sql);
            // die;
        
        $result=Yii::app()->db->createCommand($sql)->queryRow();
        return @$result['total'];

}

    /**
     * this function is used to get the caf detail .. please delete
     * @author Hemant thakur 
     */
    public function actionGetCAFData() {
        $criteria = new CDbCriteria;
        $criteria->condition = "application_status='A'";
        $data = ApplicationSubmission::model()->findAll($criteria);
        // echo "<pre>";print_r($data);die;

        $this->render("cafData", array("datas" => $data));
    }

    /**
     * this function is used to get the caf detail .. please delete
     * @author Rahul Kumar
     */
    public function actionRedirectToServiceProviders() {
        // echo "<pre>";print_r($_GET);die;
        @session_start();
        $rervetedArray = array("service_id" => base64_decode($_GET["service_id"]), "sp_tag" => base64_decode($_GET['sp_tag']), "application_id" => base64_decode($_GET['application_id']), "application_status" => $_GET['application_status'], "reverted_call_back_url" => base64_decode(base64_decode($_GET['reverted_call_back_url'])), "iuid" => $_SESSION['RESPONSE']['iuid']);
        // echo "<pre>";print_r($rervetedArray);die;
		
		$application_id  = base64_decode($_GET['application_id']);
        $serviceID  = base64_decode($_GET['service_id']);
		$service_idArr=Yii::app()->db->createCommand("SELECT service_id FROM bo_new_application_submission WHERE submission_id= $application_id")->queryRow();

        $ser_controller_action = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration WHERE service_id=$serviceID AND form_type_id=1")->queryRow();
        // echo "<pre>";print_r($serviceID);die;
        $ser_controller_action_path = $ser_controller_action['form_action_controller'];
        
   
		if(in_array($_GET['application_status'],array('I','DP','SP')))
		{	//LM Services
			$rervetedArray['reverted_call_back_url'] = "/panchayatiraj/backoffice/infowizardtwo/$ser_controller_action_path/updateSubForm/service_id/$service_idArr[service_id]/pageID/1/subID/$application_id/formCodeID/1/stype/old";
		}
		
		/*if(in_array($service_idArr['service_id'],array('2.0')) && in_array($_GET['application_status'],array('PD')))
		{	//LM Services
			$rervetedArray['reverted_call_back_url'] = "/backoffice/infowizardtwo/otherServicePayment/UnifiedPayment/service_id/$service_idArr[service_id]/app_id/$application_id"; 	
		}*/
		
        $this->render("redirectService", array("params" => $rervetedArray));
    }

    protected function getInvestorDetail($uid) {
        // echo $uid;die;
        $sql = "SELECT usr.*, prof.* from sso_users usr
        INNER JOIN sso_profiles prof
        ON usr.user_id=prof.user_id
        WHERE usr.user_id=$uid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $appCount = $command->queryRow();
        // echo $appCount;die;
        return $appCount;
    }

    /**
     * this function is used to get the payment amount of the CAF Application
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    private function getPaymentAmount($caf_fields) {
        $fields = json_decode($caf_fields);
        $amount = 0;
        if ($fields->ntrofunittype == 'micro')
            return $amount;
        if ($fields->ntrofunittype == 'small')
            $amount = 1000;
        if ($fields->ntrofunittype == 'medium')
            $amount = 5000;
        if ($fields->ntrofunittype == 'large')
            $amount = 10000;
        if ($fields->org_category == 'SC' || $fields->org_category == 'ST' || $fields->org_category == 'WOMEN')
            $amount = $amount / 2;
        return $amount;
    }

    /**
     * this function is used to get the district of the CAF application to be submitted
     * @author HEmant thakur
     * date : 18 Nov 2016
     */
    private function getDistrictOfCAF($fields) {
        // echo "<pre>";print_r($fields);die;
        $distric = null;
        if ((isset($fields->Land_in_Hectares) && !empty($fields->Land_in_Hectares)) && (isset($fields->land_leased_disctric) && !empty($fields->land_leased_disctric)))
            $distric = trim($fields->land_leased_disctric);
        else
            $distric = trim($fields->land_disctric);
        if (isset($fields->ntrofunit, $fields->invstmnt_in_plant[0]) && (($fields->ntrofunit == 'Manufacturing' && $fields->ntrofunittype == 'large' && $fields->invstmnt_in_plant[0] > 10) || ($fields->ntrofunit == 'Services' && $fields->ntrofunittype == 'large' && $fields->invstmnt_in_plant[0] > 5)))
            $distric = 6;
        // echo $distric;die;
        return $distric;
    }

    /**
     * this function is used to get the next role id of the verifier(nodal)
     * @author HEmant thakur
     * date: 18 Nov 2016
     */
    private function getNextRoleId($app_fields) {
        $next_role_id = 7;
        if (isset($app_fields->ntrofunit, $app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit == 'Manufacturing' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 10) || ($app_fields->ntrofunit == 'Services' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 5)))
            $next_role_id = 4;
        return $next_role_id;
    }

    /**
     * this function is used to check the investor logged in
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    private function isInvestorLoggedIn() {
        @session_start();
        //admin can't access this page 
        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!DefaultUtility::isValidLogin())
            $this->redirect(SSO_URL1);
        return true;
    }

    /**
     * this function is used to partially save the caf application
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    private function checkLastApplicationStatus($uid, $app_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id=:uid AND application_id=:app_id AND (application_status='I' || application_status='H' || application_status='B')";
        $criteria->params = array(":uid" => $uid, ":app_id" => $app_id);
        $criteria->order = "submission_id DESC";
        $model = ApplicationSubmission::model()->find($criteria);
        if ($model === null)
            return false;
        return $model;
    }

    /**
     * this function is used to check the payment corresponding the application
     * @author Hemant thakur
     */
    private function haveInvestorAlreadyPaid($uid, $app_sub_id, $app_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "app_sub_id=:app_sub_id and application_id=:app_id";
        $criteria->params = array(":app_sub_id" => $app_sub_id, ":app_id" => $app_id);
        $criteria->order = "payment_id DESC";
        $payment = PaymentDetail::model()->find($criteria);
        // echo "<pre>";print_r($payment);print_r($criteria->params);die("here");
        if ($payment === null || empty($payment))
            return false;
        return $payment;
    }

    /**
     * this function is used to get the last verifier application
     * @author Hemant thakur
     * date 18 Nov 2016
     */
    private function getLastVerifier($app_sub_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "app_Sub_id=:app_sub_id AND approv_status='H'";
        $criteria->params = array(":app_sub_id" => $app_sub_id);
        $criteria->order = "appr_lvl_id DESC";
        $model = ApplicationVerificationLevel::model()->find($criteria);
        if ($model === null)
            return false;
        return $model;
    }

    private function submitApplication($app_sub_id, $status = 'P', $updated_date = false, $landrigion_id = null) {
        $err = '';
        $model = ApplicationSubmission::model()->findByPk($app_sub_id);
        if ($model === null)
            throw new Exception("Something went wrong", 404);
        $model->application_status = $status;
        $model->landrigion_id = null;
        if ($updated_date)
            $model->application_updated_date_time = date('Y-m-d H:i:s');
        if (!is_null($landrigion_id))
            $model->landrigion_id = $landrigion_id;
        if ($model->save()) {
            $err = "OK";
            return $err;
        }
        $appErrors = $model->geterrors();
        foreach ($appErrors as $key => $errors) {
            foreach ($errors as $key => $error) {
                $err.='<li>' . $error . '</li>';
            }
        }
        return $err;
    }

    /**
     * this function is used to get the last payment status of the application
     * @author HEmant thakur
     * Date 22 Nov 2016
     */
    private function hasAlreadyPaid($sub_id, $app_id = 1) {
        $criteria = new CDbCriteria;
        $criteria->condition = "app_sub_id=:app_sub_id AND application_id=:app_id";
        $criteria->params = array(":app_sub_id" => $sub_id, ":app_id" => $app_id);
        $payment = PaymentDetail::model()->findAll($criteria);
        if ($payment === null || empty($payment)) {
            return false;
        }
        $hasSuccess = false;
        foreach ($payment as $key => $pay) {
            if ($pay->statusCode == 'S')
                $hasSuccess = true;
        }
        return $hasSuccess;
    }

    /**
     * this function is used to upload the investor docs
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    public function actionUploadInvestorDocs() {
        if ($this->isInvestorLoggedIn()) {
            $uid = $_SESSION['RESPONSE']['user_id'];
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $post = DefaultUtility::sanatizeParams($_POST);
            if (!isset($post['caf_applications_uploads']['YII_CSRF_TOKEN']))
                throw new Exception("Invalid request found", 401);
            if ($post['caf_applications_uploads']['YII_CSRF_TOKEN'] != $YII_CSRF_TOKEN)
                throw new Exception("Invalid request found", 401);
            if (!isset($_FILES['caf_applications_uploads']['tmp_name']) || empty($_FILES['caf_applications_uploads']['tmp_name'])) {
                Yii::app()->user->setFlash('Error', "Please select file and then upload");
                $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm'));
                exit;
            }
            // echo "<pre>";print_r($_FILES);die;
            if ($post['selected_doc_type'] == 'image/jpeg') {
                $jpgArray = array("image/jpeg", "image/png", "image/jpg");
                if (!in_array($_FILES['caf_applications_uploads']['type'], $jpgArray)) {
                    Yii::app()->user->setFlash('Error', "Please select the file of same type that you have selected in File Type Drop Down.");
                    $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm/documentUpload/1'));
                }
            } else if ($post['selected_doc_type'] != $_FILES['caf_applications_uploads']['type']) {
                Yii::app()->user->setFlash('Error', "Please select the file of same type that you have selected in File Type Drop Down.");
                $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm/documentUpload/1'));
            }
            $docProp = ApplicationCdnMappingExt::getDocumentProperties($post['caf_applications_uploads']['doc_id']);
            $doc_min_size = intval($docProp['doc_min_size']) * 1000;
            $doc_max_size = intval($docProp['doc_max_size']) * 1000;
            if ($_FILES['caf_applications_uploads']['size'] < $doc_min_size || $_FILES['caf_applications_uploads']['size'] > $doc_max_size) {
                Yii::app()->user->setFlash('Error', "Please select the file of size $doc_min_size - $doc_max_size KB");
                $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm/documentUpload/1'));
            }
            $extraDoc = array("selected_partnership_deed", "selected_doc_id_card", "selected_expension");
            $fileName = $_FILES['caf_applications_uploads']['name'];
            if (isset($post['selected_partnership_deed']))
                $fileName = $post['selected_partnership_deed'] . "__" . $_FILES['caf_applications_uploads']['name'];
            if (isset($post['selected_doc_id_card']))
                $fileName = $post['selected_doc_id_card'] . "__" . $_FILES['caf_applications_uploads']['name'];
            if (isset($post['selected_expension']))
                $fileName = $post['selected_expension'] . "__" . $_FILES['caf_applications_uploads']['name'];
            $imgData = file_get_contents($_FILES['caf_applications_uploads']['tmp_name']);
            $post_data = array();
            $hash = hash_hmac('sha1', md5($uid . $post['caf_applications_uploads']['app_id']), CDN_PUBLIC_KEY);
            $dept_id = ApplicationExt::getDeptIdFromAppId($post['caf_applications_uploads']['app_id']);
            $post_data = array(
                'user_id' => $uid,
                'app_id' => $post['caf_applications_uploads']['app_id'],
                'api_hash' => $hash,
                'doc_id' => $post['caf_applications_uploads']['doc_id'],
                'dept_id' => $dept_id,
                'doc_name' => $fileName,
                'doc_type' => $_FILES['caf_applications_uploads']['type'],
                'doc_size' => $_FILES['caf_applications_uploads']['size'],
                'doc_blob_data' => base64_encode($imgData)
            );
            $response = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
            if (is_object($response)) {
                if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                    Yii::app()->user->setFlash('Error', "File couldn't upload. Please try again.");
                    $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm/documentUpload/1'));
                }
            }
            Yii::app()->user->setFlash('Success', "File Uploaded Successfully.");
            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm/documentUpload/1'));

            // if($_FILES['caf_applications_uploads']['size'])
            // echo "<pre>";print_r($docProp);print_r($_FILES);die;


            echo "<pre>";
            print_r($_POST);
            print_r($_FILES);
            die;
        }
        $this->redirect(SSO_URL1);
    }

    /**
     * this function is used to partially save the caf application
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    public function actionSaveCAFPartially() {
        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $post = DefaultUtility::sanatizeParams($_POST);
            $post['skill_data'] = @$_POST['skill_data'];
            if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN'])
                throw new Exception("Invalid Request", 1);
            unset($post['YII_CSRF_TOKEN']);
            $model = $this->checkLastApplicationStatus($uid, 1);
            $dept_id = DepartmentsExt::getDeptIdFromUniqCode('DOI');
            if (!$model) {
                $model = new ApplicationSubmission;
                $model->application_id = 1;
                $model->user_id = $uid;
                $model->dept_id = $dept_id;
                $model->field_value = json_encode($post);
                $model->application_status = 'I';
                $model->application_created_date = date('Y-m-d H:i:s');
                $model->application_updated_date_time = date('Y-m-d H:i:s');
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $model->landrigion_id = null;
            } else {
                $model->field_value = json_encode($post);
                $model->application_updated_date_time = date('Y-m-d H:i:s');
            }
            if ($model->save())
                echo json_encode(array("STATUS" => "SUCCESS"));
            else
                echo json_encode(array("STATUS" => "ERROR"));
            $appFlow = new ApplicationFlowLogs;
            $appFlow->submission_id = $model->submission_id;
            $appFlow->created_date_time = date("Y-m-d H:i:s");
            $appFlow->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $appFlow->remote_ip_address = $_SERVER['REMOTE_ADDR'];
            $appFlow->application_status = 'IPS';
            $appFlow->save();
            exit;
        }
        $this->redirect(SSO_URL1);
    }

    /**
     * this function is used to submit the caf application
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    public function actionSubmitCafApplication() {
        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $caf = $this->checkLastApplicationStatus($uid, 1);
            if (!$caf) {
                throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
                exit;
            }
            if (!isset($_POST['YII_CSRF_TOKEN_SUBMIT'])) {
                throw new Exception("Invalid request found.", 403);
            }
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $post = DefaultUtility::sanatizeParams($_POST);
            if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN_SUBMIT'])
                throw new Exception("Invalid Request", 1);
            unset($post['YII_CSRF_TOKEN_SUBMIT']);
            $paymentCheck = $this->haveInvestorAlreadyPaid($uid, $caf->submission_id, $caf->application_id);
            // echo "<pr++e>";print_r($paymentCheck);die;
            if ($this->hasAlreadyPaid($caf->submission_id)) {
                // case might be of reverted back application whose payment already done.
                $paymentAmount = $this->getPaymentAmount($caf->field_value);
                $distric = $this->getDistrictOfCAF(json_decode($caf->field_value));
                $this->render('cafAfterPayment', array(
                    'response' => 'NONE',
                    'app_sub_id' => $caf->submission_id,
                    'land_reg' => $distric,
                    'pre_field' => $_SESSION['RESPONSE'],
                    'statusCode' => 'S',
                    'incmplt_fields' => json_decode($caf->field_value)
                ));
                exit;
            } else {
                // payment not done yet check whether payment is required or not
                $paymentAmount = $this->getPaymentAmount($caf->field_value);
                $distric = $this->getDistrictOfCAF(json_decode($caf->field_value));
                if ($paymentAmount == 0) {
                    // case of micro industry
                    $this->render('cafAfterPayment', array(
                        'response' => 'NONE',
                        'app_sub_id' => $caf->submission_id,
                        'land_reg' => $distric,
                        'pre_field' => $_SESSION['RESPONSE'],
                        'statusCode' => 'S',
                        'incmplt_fields' => json_decode($caf->field_value)
                    ));
                    exit;
                } else {
                    $updateStatus = $this->submitApplication($caf->submission_id, 'I');
                    if ($updateStatus != 'OK') {
                        Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application.Please try again later");
                        $this->redirect(Yii::app()->createAbsoluteUrl('investor/home'));
                        exit;
                    }
                    $this->render('payment', array(
                        "submission_id" => $caf->submission_id,
                        "iuid" => $_SESSION['RESPONSE']['iuid'],
                        'application_id' => $caf->application_id,
                        "amount" => $paymentAmount
                    ));
                    exit;
                    // echo "<pre>";print_r($paymentAmount);die;
                }
                // hold application and micro industry case
            }

            // echo "<pre>";print_r($caf);die;
        }
        $this->redirect(SSO_URL1);
    }

    /**
     * this function is used to send the caf to the department
     * @author Hemant Thakur
     * date : 18 Nov 2016
     */
    public function actionForwardToDepartment() {
        // echo "<pre>";print_r($_POST);die;
        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $caf = $this->checkLastApplicationStatus($uid, 1);
            if (!$caf) {
                throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
                exit;
            }
            if (!isset($_POST['YII_CSRF_TOKEN'])) {
                throw new Exception("Invalid request found.", 403);
            }
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $post = DefaultUtility::sanatizeParams($_POST);
            if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN'])
                throw new Exception("Invalid Request", 1);
            unset($post['YII_CSRF_TOKEN']);
            $distric = $this->getDistrictOfCAF(json_decode($caf->field_value));
            $revertedBack = false;
            $abstatus = false;
            $logStatus = 'ISA';
            // echo "<pre>";print_r($caf)
            if ($caf->application_status == 'H') {
                $revertedBack = true;
                $logStatus = 'IBD';
            }

            $caf->landrigion_id = trim($distric);
            //$caf->application_status='P';
            //16 dec 2018
            $obj = json_decode($caf->field_value);
            $flag = 0;
            if ($obj->have_own_land == 'No') {
                $caf->application_status = 'AB';
                $flag = 1;
            } else {
                $caf->application_status = 'P';
            }
            //16 dec 2018			
            $caf->application_created_date = date('Y-m-d H:i:s');
            $caf->application_updated_date_time = date('Y-m-d H:i:s');

            if ($caf->save()) {
                $next_role_id = $this->getNextRoleId(json_decode($caf->field_value));
                if (!$revertedBack) {
                    //$verification=new ApplicationVerificationLevel;
                    //16 dec 2018
                    if ($caf->application_status != 'AB') {
                        $verification = new ApplicationVerificationLevel;
                    } else {
                        $verification = new ApplicationAbeyanceLevel;
                    }
                    //16 dec 2018
                    $verification->next_role_id = $next_role_id;
                    $verification->app_Sub_id = $caf->submission_id;
                    $verification->created_on = date('Y-m-d H:i:s');
                    $verification->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $verification->ip_address = $_SERVER['REMOTE_ADDR'];
                    ;
                    $verification->approv_status = 'P';
                    if ($verification->save()) {
                        if ($flag == 1) {
                            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home'));
                        }
                        ApplicationFlowLogs::generateWorkFlow($caf->submission_id, null, null, null, $uid, $logStatus);
                        /* $field=json_decode($caf->field_value);
                          $iuid=$field->IUID;
                          $company_name=$field->company_name;
                          $mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
                          $app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
                          $msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";
                          IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept); */
                        DefaultUtility::sendSMSEmailGlobal('CAF', 'On successful submission of CAF', $caf->submission_id);
                        // send sms to investor
                        $mobile = $_SESSION['RESPONSE']['mobile_number'];
                        $msgDept = "Application Name: $app_name\r\nApplication ID: " . $caf->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Your application has been submitted to the department for approval.\r\n";
                        IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);
                        $caf->save();
                        Yii::app()->user->setFlash('Success', "Your Application has been submitted for department Approval. Submission id: " . $caf->submission_id);
                        $this->redirect(Yii::app()->createAbsoluteUrl('investor/home'));
                        exit;
                    } else {
                        if ($caf->application_status != 'AB') {
                            $caf->application_status = 'P';
                            $caf->save();
                            Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
                            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm'));
                        }
                    }
                } else {
                    // reverted back applications
                    //echo "<pre>";print_r($caf);die;
                    $lastVerifier = $this->getLastVerifier($caf->submission_id);
                    if (!empty($lastVerifier)) {
                        $lastVerifier->approv_status = 'P';
                        if ($lastVerifier->save()) {

                            ApplicationFlowLogs::generateWorkFlow($caf->submission_id, null, null, null, $uid, $logStatus);
                            $field = json_decode($caf->field_value);
                            $iuid = $field->IUID;
                            $company_name = $field->company_name;
                            $mobile = IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id, $next_role_id);
                            $app_name = IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
                            $msgDept = "Application Name: $app_name\r\nApplication ID: " . $caf->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has re-submitted the application for your approval.\r\n";
                            IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);
                            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home'));
                        } else {
                            $caf->application_status = 'H';
                            $caf->save();
                            Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
                            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm'));
                            exit;
                        }
                    } else {
                        $verification = new ApplicationVerificationLevel;
                        $verification->next_role_id = $next_role_id;
                        $verification->app_Sub_id = $caf->submission_id;
                        $verification->created_on = date('Y-m-d H:i:s');
                        $verification->user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $verification->ip_address = $_SERVER['REMOTE_ADDR'];
                        ;
                        $verification->approv_status = 'P';
                        if ($verification->save()) {
                            ApplicationFlowLogs::generateWorkFlow($caf->submission_id, null, null, null, $uid, $logStatus);
                            $field = json_decode($caf->field_value);
                            $iuid = $field->IUID;
                            $company_name = $field->company_name;
                            $mobile = IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id, $next_role_id);
                            $app_name = IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
                            $msgDept = "Application Name: $app_name\r\nApplication ID: " . $caf->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has re-submitted the application for your approval.\r\n";
                            IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);
                            $this->redirect(Yii::app()->createAbsoluteUrl('investor/home'));
                        }
                    }
                }
            } else {
                $err = '';
                $cafErrors = $caf->geterrors();
                foreach ($cafErrors as $key => $errors) {
                    foreach ($errors as $key => $error) {
                        $err.="<li>$error</li>";
                    }
                }
                Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
                $this->redirect(Yii::app()->createAbsoluteUrl('investor/home/cafForm'));
                exit;
            }
        }
        $this->redirect(SSO_URL1);
    }

    public function actionIndex() {

        $this->redirect('/backoffice/investor/home/investorWalkthroughLevel2/type/CAF/financial_year/ALL');
        $error = '';
        if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
            $error = 'Unauthorized User';
        @session_start();
        if (isset($_POST['SSO_TOKEN'])) {
            extract($_POST);
            $data = $_POST;
            $res = Utility::getViaCurl($SSO_HREF);
            $_res = json_decode($res);
            $RESPONSE = 0;
            if (is_object($_res))
                $RESPONSE = (array) $_res->RESPONSE;
            if (count($RESPONSE) > 4) {
                $is_valid_sso_token = 1;
                $_SESSION['LOGGED_IN'] = 1;
                $_SESSION['RESPONSE'] = $RESPONSE;
            }
            /*
              @Created:4April2018
              @Pankaj
              @Redirect to Ticket
             */


            if (isset($_POST['SSO_DEPT_ID']) && !empty($_POST['SSO_DEPT_ID'])) {

                $dept_id = $_POST['SSO_DEPT_ID'];
                $encoded_dept_id = base64_encode($dept_id);
                $encoded_user_id = base64_encode($RESPONSE['user_id']);
                $this->redirect('/ticket/open.php?user_id=' . $encoded_user_id . '&dept_id=' . $encoded_dept_id);
            }

            /* ------------------------------------------- */
        }
        // echo "<pre>";print_r($_POST);die;
        $this->render('index', array(
            'error' => $error
        ));
    }

    public function actionDownaloadInvestorDocuments() {
        @session_start();
        // echo base64_decode($_GET['app_sub_id']);
        // die;
        // echo base64_decode($_GET['app_sub_id']); echo "<pre>";print_r($_GET);die;

        $times = time();
        if (isset($_GET['app_sub_id']) && isset($_SESSION['RESPONSE'])) {
            $app_sub_id = base64_decode($_GET['app_sub_id']);
            $doc = "";
            if (isset($_GET['sso_integrated_dept']) && $_GET['sso_integrated_dept'] == 1) {
                if (isset($_GET['application'], $_GET['sp_tag'])) {
                    $_GET['sp_tag'] = base64_decode($_GET['sp_tag']);
                    $criteria = new CDbCriteria;
                    $criteria->condition = "service_provider_tag=:service_provider_tag";
                    $criteria->params = array(":service_provider_tag" => $_GET['sp_tag']);
                    $downloadInfo = ServiceProvidersCertDownload::model()->find($criteria);
                    // echo "<pre>";print_r($downloadInfo);die;
                    $service_id = SpApplicationsExt::getServiceIdFromSPTag($_GET['sp_application_name']);
                    // echo "<pre>";print_r($downloadInfo);die('here');
                    if ($downloadInfo) {
                        if ($downloadInfo->is_web_service == 'N') {
                            $this->redirect($downloadInfo->download_url . $_GET['application'] . "&service_id=" . $service_id);
                            exit;
                        } else {
                            // die("here");
                            $params = array($downloadInfo->parameter_list => $_GET['application']);
                            // echo "<pre>". $downloadInfo->download_url;print_r($params);die;
                            $result = DefaultUtility::httpRequest($downloadInfo->download_url, $params, $downloadInfo->reqest_type);
                            echo "<pre>";
                            print_r($result);
                            die;
                        }
                    }
                    // die("jere");
                }

                $doc = ApplicationExt::getInvestorSSOAppDocs($app_sub_id);
            }
            $name = Yii::app()->basePath . "/inprinciple/INPRINCIPLELETTER_" . $app_sub_id . ".pdf";
            // echo $name;die;
            if (file_exists($name)) {
                $data = file_get_contents($name);
                $pdfFile = "INPRINCIPLELETTER_" . $app_sub_id . ".pdf";
                if (file_put_contents($pdfFile, $data) !== false) {
                    header("Content-Disposition: attachment; filename=" . urlencode($pdfFile));
                    header("Content-Type: application/octet-stream");
                    header("Content-Type: application/download");
                    header("Content-Description: File Transfer");
                    header("Content-Length: " . filesize($pdfFile));
                    echo $data;
                    $this->redirect(array(
                        '/investor'
                    ));
                    exit;
                } else {
                    Yii::app()->user->setFlash('Error', "Sorry! Could not download your document.");
                    $this->redirect(array(
                        '/investor'
                    ));
                    exit;
                }
            } else {
                Yii::app()->user->setFlash('Error', "Certificate not found.");
                $this->redirect(array(
                    '/investor'
                ));
                exit;
            }
        } else {
            Yii::app()->user->setFlash('Error', "Invalid Request.");
            $this->redirect(array(
                '/investor'
            ));
            exit;
        }
    }

    public function actionPrintForm() {
        if (empty($_GET['app_id']))
            return;
        $app_sub_id = base64_decode($_GET['app_id']);
        $appInfo = ApplicationSubmissionExt::getSubmittedAppviaIdPrint($app_sub_id);
        if (!$appInfo) {
            Yii::app()->user->setFlash('Error', "You have not submitted the application.");
            $this->redirect(array(
                '/investor'
            ));
            exit;
        }
        // echo "<pre>"; print_r($appInfo); die;
        if ($appInfo['application_id'] == 8)
            $content = $this->renderPartial("printLANDAllotment", array(
                "data" => $appInfo,
                "app_sub_id" => $app_sub_id
                    ), true);
        else
            $content = $this->renderPartial("printCAF", array(
                "data" => $appInfo,
                "app_sub_id" => $app_sub_id
                    ), true);

        $name = "Application_Form.pdf";
        Utility::generatePdfApp($content, $name);
        exit;
    }

    public function actionCafFormUpdate() {
        if (isset($_POST['ManageApplication'])) {
            //upload documents of the user
            $post_data = array();
            $modelCdn = new ApplicationCdnMappingExt;
            if (isset($_FILES) && !empty($_FILES['ApplicationField']['tmp_name'])) {
                foreach ($_FILES['ApplicationField']['tmp_name'] as $key => $file_content) {
                    $imgData = file_get_contents($file_content);
                    $post_data = array();
                    $hash = hash_hmac('sha1', md5($user_id . $app_id), CDN_PUBLIC_KEY);
                    $post_data = array(
                        'user_id' => $user_id,
                        'app_id' => $app_id,
                        'api_hash' => $hash,
                        'doc_id' => $_POST['ApplicationField']['doc_id'][$key],
                        'dept_id' => $dept_id,
                        'doc_name' => $_FILES['ApplicationField']['name'][$key],
                        'doc_type' => $_FILES['ApplicationField']['type'][$key],
                        'doc_size' => $_FILES['ApplicationField']['size'][$key],
                        'doc_blob_data' => base64_encode($imgData)
                    );
                    $response = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                    if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                        Yii::app()->user->setFlash('Error', $response->RESPONSE);
                        $this->redirect(array(
                            '/investor'
                        ));
                        exit;
                    }
                }
            }
            $modelSub = ApplicationSubmission::model()->findByPk($_POST['ManageApplication']['submition_id']);
            if ($modelSub === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            if (isset($_POST['ManageApplication']))
                unset($_POST['ManageApplication']);
            $modelSub->field_value = json_encode($_POST);
            if ($modelSub->application_status != 'H')
                throw new CHttpException(404, 'The requested page does not exist.');
            $modelSub->application_status = 'P';
            if ($modelSub->save()) {
                $criteria = new CDbCriteria;
                $criteria->select = 'appr_lvl_id';
                $criteria->condition = 'approv_status=:approv_status';
                $criteria->params = array(
                    ':approv_status' => 'H'
                );
                $modelvl = ApplicationVerificationLevel::model()->find($criteria);
                $model = ApplicationVerificationLevel::model()->findByPk($modelvl->appr_lvl_id);
                if ($model === null)
                    throw new CHttpException(404, 'The requested page does not exist.');
                $model->approv_status = 'P';
                if (!empty($model)) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('Success', "Success: Your application has been successfully updated");
                        $this->redirect(array(
                            '/investor'
                        ));
                        exit;
                    }
                }
            }
        }
    }

    public function actionCafFormFinish() {
        @session_start();
        //admin can't access this page 
        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
            throw new CHttpException(400, "you can't access this page");
        }
        //check for whether user is logged in or not
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);
        // echo "<pre>";print_r($_SESSION);die;
        $uid = $_SESSION['RESPONSE']['user_id'];
        if (isset($_POST['IUID'])) {
            $post_data = array();
            $modelCdn = new ApplicationCdnMappingExt;
            $fileUPloads = true; //true means there is any files in the form that need to be uploaded and false means no files
            /* fileupload here */
            if (isset($_FILES) && !empty($_FILES['caf_applications_uploads']['tmp_name'])) {
                $app_id = ApplicationExt::getCAFId();
                if (!empty($app_id))
                    $app_id = $app_id['application_id'];
                $dept_id = ApplicationExt::getDeptIdFromAppId($app_id);
                $docs_prop = $modelCdn->getApplicationDocuments($uid, $app_id);
                $prop_array = array();
                foreach ($docs_prop as $key => $prop)
                    $prop_array[$prop['doc_id']] = array(
                        'min_size' => $prop['doc_min_size'],
                        'max_size' => $prop['doc_max_size'],
                        'type' => $prop['doc_type']
                    );

                foreach ($_FILES['caf_applications_uploads']['tmp_name'] as $key => $file_content) {
                    if (empty($file_content))
                        continue;
                    if (isset($_POST['selected_doc_type'][$key]) && empty($_POST['selected_doc_type'][$key])) {
                        Yii::app()->user->setFlash('Error', "Please select File type");
                        $this->redirect(array(
                            '/investor/home/cafForm'
                        ));
                        exit;
                    }
                    $f_type = explode('.', $_FILES['caf_applications_uploads']['name'][$key]);
                    $file_ext = end($f_type);
                    $file_type_check = $_FILES['caf_applications_uploads']['type'][$key];
                    $file_size = $_FILES['caf_applications_uploads']['size'][$key];
                    $compare_key = $_POST['fileDocumentCount'][$key];
                    if (trim($_POST['selected_doc_type'][$key]) == 'image/jpeg') {
                        if ($file_type_check != 'image/jpeg')
                            if ($file_type_check != 'image/png') {
                                Yii::app()->user->setFlash('Error', "File must be of jpg/png type.");
                                $this->redirect(array(
                                    '/investor/home/cafForm'
                                ));
                                exit;
                            }
                    } elseif ($_POST['selected_doc_type'][$key] == 'application/pdf') {
                        if ($file_type_check != 'application/pdf') {
                            Yii::app()->user->setFlash('Error', "Please Upload pdf file.");
                            $this->redirect(array(
                                '/investor/home/cafForm'
                            ));
                            exit;
                        }
                    } elseif ($file_type_check != $_POST['selected_doc_type'][$key]) {
                        Yii::app()->user->setFlash('Error', "Please Upload " . $prop_array[$_POST['caf_applications_uploads']['doc_id'][$compare_key]]['type'] . " file.");
                        $this->redirect(array(
                            '/investor/home/cafForm'
                        ));
                        exit;
                    }
                    $doc_min_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['min_size']) * 1000;
                    $doc_max_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['max_size']) * 1000;

                    if ($file_size < $doc_min_size || $file_size > $doc_max_size) {
                        /* Yii::app()->user->setFlash('Error', "File must be of size ".$doc_min_size.' - '.$doc_max_size);
                          $this->redirect(array('/investor/home/cafForm'));
                          exit; */
                    }
                    if (isset($_POST['authorization_letters_type']) && !empty($_POST['authorization_letters_type'])) {
                        $doc_name = $_POST['authorization_letters_type'] . $file_ext;
                        $imgData = file_get_contents($file_content);
                        $post_data = array();
                        $hash = hash_hmac('sha1', md5($uid . $app_id), CDN_PUBLIC_KEY);
                        $post_data = array(
                            'user_id' => $uid,
                            'app_id' => $app_id,
                            'api_hash' => $hash,
                            'doc_id' => $_POST['caf_applications_uploads']['doc_id'][$key],
                            'dept_id' => $dept_id,
                            'doc_name' => $doc_name,
                            'doc_type' => $_POST['selected_doc_type'][$key],
                            'doc_size' => $_FILES['caf_applications_uploads']['size'][$key],
                            'doc_blob_data' => base64_encode($imgData)
                        );
                        $res = DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data);
                        $response = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                        if (is_object($response)) {
                            if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                                $fileUPloads = false;
                            }
                        }
                        unset($_POST['authorization_letters_type']);
                        continue;
                    }
                    $doc_type_name = $_FILES['caf_applications_uploads']['name'][$key];
                    if (isset($_POST['selected_doc_id_card']))
                        $doc_type_name = $_POST['selected_doc_id_card'] . '_' . $doc_type_name;
                    if (isset($_POST['selected_partnership_deed']))
                        $doc_type_name = $_POST['selected_partnership_deed'] . '_' . $doc_type_name;
                    if (isset($_POST['selected_expension']))
                        $doc_type_name = $_POST['selected_expension'] . '_' . $doc_type_name;


                    $imgData = file_get_contents($file_content);
                    $post_data = array();
                    $hash = hash_hmac('sha1', md5($uid . $app_id), CDN_PUBLIC_KEY);
                    $post_data = array(
                        'user_id' => $uid,
                        'app_id' => $app_id,
                        'api_hash' => $hash,
                        'doc_id' => $_POST['caf_applications_uploads']['doc_id'][$key],
                        'dept_id' => $dept_id,
                        'doc_name' => $doc_type_name,
                        'doc_type' => $_POST['selected_doc_type'][$key],
                        'doc_size' => $_FILES['caf_applications_uploads']['size'][$key],
                        'doc_blob_data' => base64_encode($imgData)
                    );
                    $response = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                    if (is_object($response)) {
                        if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                            $fileUPloads = false;
                        }
                    }
                }
            }


            if (!$fileUPloads) {
                Yii::app()->user->setFlash('Error', "Files are not uploaded successfully ");
                $this->redirect(array(
                    '/investor/home/cafForm'
                ));
                exit;
            }
            $deptModel = new DepartmentsExt;
            $dept_id = $deptModel->getDeptIdFromUniqCode('DOI');
            $dept_id = 1;
            $appModel = new ApplicationExt;
            $app_id = $appModel->getAppIdFromName('CAF', $dept_id);
            //check for existing incomplete application
            $critera = new CDbCriteria;
            $critera->select = 'submission_id,application_status';
            $critera->condition = "application_id=:app_id AND user_id=:user_id AND dept_id=:dept_id";
            $critera->params = array(
                ":app_id" => $app_id,
                ":dept_id" => $dept_id,
                ":user_id" => $uid
            );
            $critera->order = 'submission_id DESC';
            $app_sub_model = ApplicationSubmission::model()->find($critera);
            $model = ApplicationSubmission::model()->findByPk($app_sub_model['submission_id']);
            if ($app_sub_model === null) {
                //application doesn't exist for current logged in user create new one
                $model = new ApplicationSubmission;
                $model->application_id = $app_id;
                $model->dept_id = $dept_id;
                $model->user_id = $uid;
                $model->application_created_date = date("Y-m-d H:m:s");
                ;
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                if ($app_sub_model['application_status'] == 'I' || $app_sub_model['application_status'] == 'B' || $app_sub_model['application_status'] == 'H') {
                    //partially field application

                    if ($model === null) {
                        print_r(json_encode(array(
                            "Error" => "The requested page does not exist."
                        )));
                        return;
                    }
                } elseif ($app_sub_model['application_status'] == 'P') {
                    // not a partially field
                    print_r(json_encode(array(
                        "Error" => "Application Already Filled."
                    )));
                    return;
                }
            }
            if ($app_sub_model['application_status'] == 'H') {
                $model->field_value = json_encode($_POST);
                $model->application_status = 'P';
                $model->application_created_date = date("Y-m-d H:m:s");
                ;
                $distric = '';
                if (!empty($_POST['Land_in_Hectares']) && !empty($_POST['land_leased_disctric']))
                    $distric = trim($_POST['land_leased_disctric']);
                elseif (!empty($_POST['detail_of_leased_space_area_in_sq_meters']) && !empty($_POST['land_disctric']))
                    $distric = trim($_POST['land_disctric']);
                if (isset($_POST['ntrofunit'], $_POST['invstmnt_in_plant'][0]) && (($_POST['ntrofunit'] == 'Manufacturing' && $_POST['ntrofunittype'] == 'large' && $_POST['invstmnt_in_plant'][0] > 10) || ($_POST['ntrofunit'] == 'Services' && $_POST['ntrofunittype'] == 'large' && $_POST['invstmnt_in_plant'][0] > 5)))
                    $distric = 6;
                $model->landrigion_id = $distric;
                if ($model->save()) {
                    $hold = 'H';
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'app_Sub_id=:app_sub_id AND approv_status=:status';
                    $criteria->params = array(
                        ':app_sub_id' => $app_sub_model['submission_id'],
                        ':status' => $hold
                    );
                    $criteria->order = 'appr_lvl_id DESC';
                    $lvmodel = ApplicationVerificationLevel::model()->find($criteria);
                    if (!empty($lvmodel)) {
                        $lvmodel->approv_status = 'P';
                        if ($lvmodel->save()) {
                            $appFlow = new ApplicationFlowLogs;
                            $appFlow->submission_id = $app_sub_model['submission_id'];
                            $appFlow->created_date_time = date("Y-m-d H:m:s");
                            $appFlow->user_agent = $_SERVER['HTTP_USER_AGENT'];
                            $appFlow->remote_ip_address = $_SERVER['REMOTE_ADDR'];
                            $appFlow->application_status = 'IBD';
                            $appFlow->save();
                            Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: " . $model->submission_id);
                            $this->redirect(array(
                                '/investor'
                            ));
                            exit;
                        } else {
                            $model->application_status = 'H';
                            $model->save();
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('Error', "Error: Could not upadate");
                    $this->redirect(array(
                        '/investor'
                    ));
                    exit;
                }
            }
            $model->field_value = json_encode($_POST);
            $model->application_status = 'B';
            $model->application_created_date = date("Y-m-d H:m:s");
            $distric = '';
            if (!empty($_POST['Land_in_Hectares']) && !empty($_POST['land_leased_disctric']))
                $distric = trim($_POST['land_leased_disctric']);
            elseif (!empty($_POST['detail_of_leased_space_area_in_sq_meters']) && !empty($_POST['land_disctric']))
                $distric = trim($_POST['land_disctric']);
            if (isset($_POST['ntrofunit'], $_POST['invstmnt_in_plant'][0]) && (($_POST['ntrofunit'] == 'Manufacturing' && $_POST['ntrofunittype'] == 'large' && $_POST['invstmnt_in_plant'][0] > 10) || ($_POST['ntrofunit'] == 'Services' && $_POST['ntrofunittype'] == 'large' && $_POST['invstmnt_in_plant'][0] > 5)))
                $distric = 6;
            /* if (isset($_POST['invstmnt_in_total'][0]) && !empty($_POST['invstmnt_in_total'][0]) && $_POST['invstmnt_in_total'][0] > 10)
              $distric = 6; */
            $model->landrigion_id = $distric;
            if ($model->save()) {
                if (isset($_POST['ntrofunittype']) && $_POST['ntrofunittype'] == 'micro') {
                    $this->render('cafAfterPayment', array(
                        'response' => 'NONE',
                        'app_sub_id' => $model->submission_id,
                        'land_reg' => $distric,
                        'pre_field' => $_SESSION['RESPONSE'],
                        'statusCode' => 'S',
                        'incmplt_fields' => json_decode($model->field_value)
                    ));
                    exit;
                }

                // $ntrofunittype
                $amount = 0;
                if ($_POST['ntrofunittype'] == 'small')
                    $amount = 1000;
                if ($_POST['ntrofunittype'] == 'medium')
                    $amount = 5000;
                if ($_POST['ntrofunittype'] == 'large')
                    $amount = 10000;
                if ($_POST['org_category'] == 'SC' || $_POST['org_category'] == 'ST' || $_POST['org_category'] == 'WOMEN')
                    $amount = $amount / 2;

                $this->render('payment', array(
                    "submission_id" => $model->submission_id,
                    "iuid" => $_SESSION['RESPONSE']['iuid'],
                    'application_id' => $model->application_id,
                    "amount" => $amount
                ));
                exit;
            }
            echo "<pre>";
            print_r($model->geterrors());
            //print_r($model->geterrors());
            //print_r(array(json_encode(array("Error"=>"Unknown Error! Please Try Again Later."))));
            return;
        }
    }

    /**
     * this function is used to submit the caf appliction after payment
     * @author Hemant Thakur
     */
    public function actionCafFinishAfterPayment() {
        if (isset($_POST['FinalSubmit'])) {
            @session_start();
            extract($_POST['FinalSubmit']);
            $criteria = new CDbCriteria();
            $criteria->condition = "submission_id=:app_sub_id";
            $criteria->params = array(
                ":app_sub_id" => $app_sub_id
            );
            $Application = ApplicationSubmission::model()->find($criteria);
            $app_fields = json_decode($Application['field_value']);
            if (empty($Application)) {
                Yii::app()->user->setFlash('Error', "Invalid Request");
                $this->redirect(Yii::app()->homeUrl);
                exit;
            }
            $Application->application_status = 'P';
            $Application->application_created_date = date("Y-m-d H:m:s");
            if ($Application->save()) {
                $criteria = new CDbCriteria;
                $criteria->select = 'role_id';
                $criteria->condition = 'app_id=:app_id';
                $criteria->order = 'wrkflw_id ASC';
                $criteria->params = array(
                    ':app_id' => $Application->application_id
                );
                $modelwrklw = AppWorkflow::model()->findAll($criteria);
                // if(!empty($modelwrklw) && isset($modelwrklw[0])){
                //assign the level in verification 
                $vlmodel = new ApplicationVerificationLevel;
                if (isset($app_fields->ntrofunit, $app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit == 'Manufacturing' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 10) || ($app_fields->ntrofunit == 'Services' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 5))) {
                    $vlmodel->next_role_id = 4;
                    $eodb_nodal = 63;
                } else {
                    $vlmodel->next_role_id = 7;
                    $eodb_nodal = 64;
                }
                $vlmodel->app_Sub_id = $Application->submission_id;
                $vlmodel->created_on = date("Y-m-d H:m:s");
                $vlmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $vlmodel->ip_address = $_SERVER['REMOTE_ADDR'];
                $vlmodel->approv_status = 'P';
                if ($vlmodel->save()) {
                    /* send the mobile sms to the user */
                    $mobile = $_SESSION['RESPONSE']['mobile_number'];
                    $email = $_SESSION['RESPONSE']['email'];
                    $api_hmac = hash_hmac("sha1", $mobile . $email, OTP_SECRET_KEY);
                    $data = array(
                        'mobile' => $mobile,
                        "hmac" => $api_hmac,
                        "email" => $email,
                        "msg" => "Your application has been successfully submitted. Your Application ID: " . $Application->submission_id
                    );
                    $url = BO_API_BASEURL . '/sendMobMsg';
                    DefaultUtility::postViaCurl($url, $data);

                    $api_hmac = hash_hmac("sha1", $_SESSION['RESPONSE']['iuid'] . $email, OTP_SECRET_KEY);
                    $data = array(
                        'uiid' => $_SESSION['RESPONSE']['iuid'],
                        "hmac" => $api_hmac,
                        "email" => $email,
                        "message" => "Your application has been successfully submitted. Your Application ID: " . $Application->submission_id
                    );
                    $field = json_decode($Application->field_value);
                    $iuid = $field->IUID;
                    $company_name = $field->company_name;
                    /* $mobile=IncentiveSchemes::getboUserMobileFromRoleID($Application->submission_id,$vlmodel->next_role_id);
                      $app_name=IncentiveSchemes::getAppNameFromSubmissionId($Application->submission_id);
                      $msgDept="Application Name: $app_name\r\nApplication ID: ".$Application->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";
                      IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept); */

                    DefaultUtility::sendSMSEmailGlobal('CAF', 'On successful submission of CAF', $Application->submission_id);

                    /* $mobile=IncentiveSchemes::getboUserMobileFromRoleID($Application->submission_id,33); 
                      if(!empty($mobile)){
                      $app_name=IncentiveSchemes::getAppNameFromSubmissionId($Application->submission_id);
                      $msgDept="Application Name: $app_name\r\nApplication ID: ".$Application->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application.\r\n";
                      IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
                      }

                      //send email to EODB nodal start
                      $mobile=IncentiveSchemes::getboUserMobileFromRoleID($Application->submission_id,$eodb_nodal);
                      if(!empty($mobile)){
                      $app_name=IncentiveSchemes::getAppNameFromSubmissionId($Application->submission_id);
                      $msgDept="Application Name: $app_name\r\nApplication ID: ".$Application->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application.\r\n";
                      IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
                      }
                      //send email to EODB nodal end
                      //send email to MPR start
                      $mobile=IncentiveSchemes::getboUserMobileFromRoleID($Application->submission_id,4);
                      if(!empty($mobile)){
                      $app_name=IncentiveSchemes::getAppNameFromSubmissionId($Application->submission_id);
                      $msgDept="Application Name: $app_name\r\nApplication ID: ".$Application->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application.\r\n";
                      IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
                      }
                      //send email to MPR end
                      //send email to GmDIC start

                      //send email to GMDIC End

                      $role_id_array = array($vlmodel->next_role_id,$eodb_nodal,4,33);


                      $email_id_array = IncentiveSchemes::getboUserEmailFromRoleID($Application->submission_id,$role_id_array);
                      if($Application->submission_id == '3285'){
                      //print_r($email_id_array);die;
                      }
                      $email_content = "An investor has applied for CAF on Single Window Clearance System with below details : <br>"
                      . "Application Name: $app_name <br>"
                      . "Application ID: ".$Application->submission_id."<br>"
                      . "IUID: $iuid"."<br>"
                      . "Company Name: ".$company_name."<br>";
                      $res = UniversalUtility::emailHFB($email_content);
                      foreach ($email_id_array as $key => $val) {
                      if (DefaultUtility::sendEmail(EMAIL_HOST, EMAIL_PORT, EMAIL_USERNAME, EMAIL_PASSWORD, "New CAF Submitted", $res, $val)) {
                      echo "mail sent to " . $emailID . "<br>";
                      } else {
                      echo "mail sending failed to " . $emailID . "<br>";
                      }
                      }
                     * 
                     */
                    Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: " . $Application->submission_id);
                    $this->redirect(array(
                        '/investor'
                    ));
                    exit;
                }
            }
            Yii::app()->user->setFlash('Error', "Could not update.");
            $this->redirect(Yii::app()->homeUrl);
            exit;
        }
        Yii::app()->user->setFlash('Error', "Invalid Request");
        $this->redirect(Yii::app()->homeUrl);
    }

    // Render user to timeline
    public function actionTimeline() {
        @session_start();
        if (isset($_SESSION['RESPONSE'])) {
            if (isset($_GET['app_id']) && !empty($_GET['app_id'])) {
                $app_id = $_GET['app_id'];
                $app_comments = ApplicationApproveLevelExt::getApplicationComments($app_id);
                if (isset($_GET['apptype'], $_GET['spTag']) && $_GET['apptype'] == 'SP') {
                    $spAppID = base64_decode($_GET['spAppID']);
                    $spTag = base64_decode($_GET['spTag']);
                    $criteria = new CDbCriteria;
                    $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id AND sp_app_id=:spAppID";
                    $criteria->params = array(":sp_tag" => $spTag, ":app_id" => $app_id, ":spAppID" => $spAppID);
                    $history = SpApplicationHistory::model()->findAll($criteria);
                    if ($history === false) {
                        Yii::app()->user->setFlash('Error', "No Data Found");
                        $this->redirect(Yii::app()->homeUrl);
                    } else {
                        $this->render('spTimeline', array('history' => $history, "app_id" => $app_id));
                        exit;
                    }
                }
                if (!empty($app_comments) && isset($app_comments)) {
                    $this->render('timeline', array(
                        'app_comments' => $app_comments
                    ));
                    unset($_GET['app_id']);
                } else {
                    Yii::app()->user->setFlash('error', "No Data Found");
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    /* Function is used to redirect to payment gateway
     *  @ Author : Hemant Thakur
     *  @ params : none
     */

    public function actionPaymentPay() {
        @session_start();
        if (!isset($_SESSION['RESPONSE'], $_POST['amount'])) {
            Yii::app()->user->setFlash('Error', "Not a valid Request");
            $this->redirect(array(
                '/investor'
            ));
            exit;
        }
        extract($_POST);
        $this->render('payment', array(
            'iuid' => $iuid,
            'submission_id' => $submission_id,
            'application_id' => $application_id,
            'amount' => $amount
        ));
    }

    public function actionCafFormAfterPayment() {
        
    }

    /* Function is used to get the payment response
     *  @ Author : Hemant Thakur
     *  @ params : none
      @ return :
     */

    public function actionPaymentResponse() {
        @session_start();

        if (isset($_REQUEST['merchantResponse'])) {
            $responseMerchant = $_REQUEST['merchantResponse'];
            $obj = new AWLMEAPI();
            $resMsgDTO = new ResMsgDTO();
            $reqMsgDTO = new ReqMsgDTO();
            $enc_key = WORLDLINE_ENCRYP_KEY;
            $response = $obj->parseTrnResMsg($responseMerchant, $enc_key);
            $app_sub_id = $response->getAddField1();
            $app_id = $response->getAddField2();
            $iuid = $response->getAddField3();
            $paymentModel = new PaymentDetail();
            $paymentModel->pgMeTrnRefNo = $response->getPgMeTrnRefNo();
            $paymentModel->orderId = $response->getOrderId();
            $paymentModel->authZStatus = $response->getAuthZCode();
            $paymentModel->bank_reference_bank = $response->getRrn();
            $paymentModel->user_id = $iuid;
            $paymentModel->application_id = $app_id;
            $paymentModel->app_sub_id = $app_sub_id;
            $paymentModel->amount = $response->getTrnAmt();
            $paymentModel->trnReqDate = $response->getTrnReqDate();
            $paymentModel->statusCode = $response->getStatusCode();
            $paymentModel->status_description = $response->getStatusDesc();
            if ($paymentModel->save()) {
                $incmplt_fields = ApplicationSubmissionExt::getSubmittedAppviaIdCAF($app_sub_id);
                $land_reg = '';
                if (!empty($incmplt_fields)) {
                    $land_reg = $incmplt_fields['landrigion_id'];
                    $incmplt_fields = json_decode($incmplt_fields['field_value']);
                    $appName = ApplicationExt::getAppNameViaId($app_id);
                    if ($appName['application_name'] == 'CAF')
                        $this->render('cafAfterPayment', array(
                            'response' => $response,
                            'app_sub_id' => $app_sub_id,
                            'land_reg' => $land_reg,
                            'pre_field' => $_SESSION['RESPONSE'],
                            'incmplt_fields' => $incmplt_fields
                        ));
                    else {
                        // die("other application");
                        Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
                        $this->redirect(array('/investor'));
                        exit;
                    }
                } else {
                    // die("incomplete Fields not found");
                    Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
                    $this->redirect(array('/investor'));
                    exit;
                }
            } else {
                echo "<pre>";
                print_r($paymentModel->geterrors());
            }
        } else {
            // die("dsjkdhskj");
            Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
            $this->redirect(array('/investor'));
            exit;
        }
    }

    /* Function is used to create and submit the CAF Application Form
     *  @ Author : Hemant Thakur
     *  @ params : none
      @ return : json response to ajax
     */

    public function actionCafForm() {
		//die("<h1>Currently the system is under up-gradation effective from 1st April 2019 00:00 hrs. to 4trh April 2019 23:59 hrs.</h1>");
        if(isset($_SESSION['RESPONSE']['user_id'])){
			$user_id=$_SESSION['RESPONSE']['user_id'];			
			$resultData= Yii::app()->db->createCommand("SELECT submission_id,application_status FROM bo_application_submission where application_status IN ('I','B') AND user_id=$user_id AND application_id='1'")->queryRow();			
			if(!empty($resultData)) {
				$this->redirect('/backoffice/infowizard/formBuilder/subform/service_id/591.0/pageID/1/formCodeID/1');
			}
			$resultData2= Yii::app()->db->createCommand("SELECT submission_id,application_status FROM bo_application_submission where user_id=$user_id  AND application_id='1'")->queryRow();
			if(empty($resultData2)) {
				$this->redirect('/backoffice/infowizard/formBuilder/subform/service_id/591.0/pageID/1/formCodeID/1');
			}
        }
        $appModel = new ApplicationExt;
        @session_start();
        //admin can't access this page 
       // if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
         //   throw new CHttpException(400, "you can't access this page");
        //}
        //check for whether user is logged in or not
        if (empty($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);
        // echo "<pre>";print_r($_SESSION);die;
        $uid = $_SESSION['RESPONSE']['user_id'];
        $deptModel = new DepartmentsExt;
        $dept_id = $deptModel->getDeptIdFromUniqCode('DOI');
        $dept_id = 1;
        $app_id = $appModel->getAppIdFromName('CAF', $dept_id);
        /* check whether application is for payment or not */
        $appPayment = ApplicationExt::checkUsersPrevCAFApplicationsForPayment($uid, $app_id);
        if ($appPayment && ($appPayment['application_status'] == 'B' )) {
            // $amount = 1;
            $Application = ApplicationSubmissionExt::getSubmittedAppviaId($appPayment['submission_id']);
            $incmplt_fields = json_decode($Application['field_value']);
            if ($incmplt_fields->ntrofunittype == 'micro') {
                $this->render('cafAfterPayment', array(
                    'response' => 'NONE',
                    'app_sub_id' => $appPayment['submission_id'],
                    'land_reg' => $appPayment['landrigion_id'],
                    'pre_field' => $_SESSION['RESPONSE'],
                    'incmplt_fields' => $incmplt_fields,
                    'statusCode' => 'S',
                ));
                exit;
            }

            /* check already paid or not */
            $critera = new CDbCriteria;
            $critera->condition = "app_sub_id=:app_sub_id";
            $critera->params = array(":app_sub_id" => $appPayment['submission_id']);
            $critera->order = "payment_id DESC";
            $checkPay = PaymentDetail::model()->find($critera);
            if (!empty($checkPay) && $checkPay->statusCode == 'S') {
                $this->render('cafAfterPayment', array(
                    'response' => 'APD',
                    'detail' => $checkPay,
                    'app_sub_id' => $appPayment['submission_id'],
                    'land_reg' => $appPayment['landrigion_id'],
                    'pre_field' => $_SESSION['RESPONSE'],
                    'incmplt_fields' => $incmplt_fields,
                    'statusCode' => 'S',
                ));
                exit;
            }
            $amount = 0;
            if ($incmplt_fields->ntrofunittype == 'micro')
                $amount = 0;
            if ($incmplt_fields->ntrofunittype == 'small')
                $amount = 1000;
            if ($incmplt_fields->ntrofunittype == 'medium')
                $amount = 5000;
            if ($incmplt_fields->ntrofunittype == 'large')
                $amount = 10000;
            if ($incmplt_fields->org_category == 'SC' || $incmplt_fields->org_category == 'ST' || $incmplt_fields->org_category == 'WOMEN')
                $amount = $amount / 2;
            $this->render('paymentRedirect', array(
                "submisstion_id" => $appPayment['submission_id'],
                "iuid" => $_SESSION['RESPONSE']['iuid'],
                'application_id' => $app_id,
                "amount" => $amount
            ));
            exit;
        }
        //check for previous pending CAF application or this user
        $any_prev_pending_caf = $appModel->checkUsersPrevCAFApplications($uid, $app_id);
        if ($any_prev_pending_caf) {
            Yii::app()->user->setFlash('Error', "YOUR CAF APPLICATION IS ALREADY UNDER CONSIDERATION");
            $this->redirect(array(
                '/investor'
            ));
            exit;
        }
        if (isset($_POST['IUID'])) {
            //check for existing incomplete application
            $critera = new CDbCriteria;
            $critera->select = 'submission_id,application_status';
            $critera->condition = "application_id=:app_id AND user_id=:user_id AND dept_id=:dept_id AND application_status!=:apprv AND  application_status!=:reject";
            $critera->params = array(
                ":app_id" => $app_id,
                ":dept_id" => $dept_id,
                ":user_id" => $uid,
                ":apprv" => 'A',
                ":reject" => 'R',
            );
            $critera->order = 'submission_id DESC';
            $app_sub_model = ApplicationSubmission::model()->find($critera);
            if ($app_sub_model === null) {
                //application doesn't exist for current logged in user create new one
                $model = new ApplicationSubmission;
                $model->application_id = $app_id;
                $model->dept_id = $dept_id;
                $model->application_status = 'I';
                $model->user_id = $uid;
                $model->application_created_date = date("Y-m-d H:m:s");
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                if ($app_sub_model['application_status'] == 'I' || $app_sub_model['application_status'] == 'H') {
                    //partially field application
                    $model = ApplicationSubmission::model()->findByPk($app_sub_model['submission_id']);
                    if ($model === null) {
                        print_r(json_encode(array(
                            "status" => "Error: The requested page does not exist."
                        )));
                        return;
                    }
                } else {
                    // not a partially field
                    // print_r($app_sub_model);die;
                    print_r(json_encode(array(
                        "status" => "Error: Application Already Filled."
                    )));
                    return;
                }
            }
            $model->field_value = json_encode($_POST);
            $model->application_created_date = date("Y-m-d H:m:s");
            ;
            if ($model->save()) {
                // print_r($model->attributes);
                print_r(json_encode(array(
                    "status" => "SUCCESS: Application Submitted Successfully"
                )));
                return;
            }
            print_r($model->geterrors());
            //print_r(array(json_encode(array("Error"=>"Unknown Error! Please Try Again Later."))));
            return;
        }
        //check for previous incomplete application
        $incmplt_fields = $appModel->getUsersCAFApplicationsOfUser($uid, $app_id);
        $appStatus = "";
        if (!empty($incmplt_fields)) {
            // echo "<pre>";print_r($incmplt_fields);die;
            $appStatus = $incmplt_fields['application_status'];
            $incmplt_fields = json_decode($incmplt_fields['field_value']);
        }
        $pre_filed = $_SESSION['RESPONSE'];
        $app = ApplicationExt::getCAFId();
        $industries = DefaultUtility::getTypeOfIndustries();
        $document = 0;
        if (isset($_GET['documentUpload']) && !empty($_GET['documentUpload']) && $_GET['documentUpload'] == 1)
            $document = 1;

        if (isset($_GET['typ']) && $_GET['typ'] == "New") {
            $this->render('cafFormNew', array(
                'pre_field' => $pre_filed,
                'app' => $app,
                'document' => $document,
                'industries' => $industries,
                'appStatus' => $appStatus,
                'incmplt_fields' => $incmplt_fields
            ));
        } else {
            $this->render('cafFormNew', array(
                'pre_field' => $pre_filed,
                'app' => $app,
                'document' => $document,
                'industries' => $industries,
                'appStatus' => $appStatus,
                'incmplt_fields' => $incmplt_fields
            ));
        }
    }

  
    public function actionInvestorWalkthrough() {

         $error = '';
        if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
            $error = 'Unauthorized User';

        @session_start();
        if (isset($_POST['SSO_TOKEN'])) {

            extract($_POST);
            $data = $_POST;
            
            $res = Utility::getViaCurl($SSO_HREF);
              
            $_res = json_decode($res);
            $RESPONSE = 0;
            if (is_object($_res))
                $RESPONSE = (array) $_res->RESPONSE;
            if (count($RESPONSE) > 4) {
                $is_valid_sso_token = 1;
                $_SESSION['LOGGED_IN'] = 1;
                $_SESSION['RESPONSE'] = $RESPONSE;
            }
            $_SESSION['RESPONSE']['user_type'] = $logintype;
           


            if (isset($_POST['SSO_DEPT_ID']) && !empty($_POST['SSO_DEPT_ID'])) {

                $dept_id = $_POST['SSO_DEPT_ID'];
                $encoded_dept_id = base64_encode($dept_id);
                $encoded_user_id = base64_encode($RESPONSE['user_id']);
                $this->redirect('/ticket/open.php?user_id=' . $encoded_user_id . '&dept_id=' . $encoded_dept_id);
            }

            /* ------------------------------------------- */
        }

        //nc = notification click 

        if(isset($_SESSION['RESPONSE']['user_id']) && isset($_COOKIE["VPDTOKEN"])){
            $tokencondition = $_COOKIE["VPDTOKEN"];
            Yii::app()->db->createCommand("UPDATE temp_vpd_doclist 
                SET vpd_token = NULL, user_id = '".$_SESSION['RESPONSE']['user_id']."'
             WHERE vpd_token = '".$tokencondition."' ")->execute();
         }
        


    if($_SESSION['RESPONSE']['user_type']=='2'){ 
        if(isset($_SESSION['anothertime'])){
        }else{
            $_SESSION['RESPONSE']['agent_first_name'] = $_SESSION['RESPONSE']['first_name'];
            $_SESSION['RESPONSE']['agent_last_name'] = $_SESSION['RESPONSE']['last_name'];
            $_SESSION['RESPONSE']['agent_email'] = $_SESSION['RESPONSE']['email'];
            $_SESSION['RESPONSE']['agent_user_id'] =   $_SESSION['RESPONSE']['user_id'];
            $userd = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y' AND user_id=".$_SESSION['RESPONSE']['agent_user_id'])->queryRow();
            $_SESSION['RESPONSE']['sp_type'] =     $userd['sp_type']  ;

                // Remove agent details from session
                  $_SESSION['RESPONSE']['email'] = $_SESSION['RESPONSE']['iuid'] = $_SESSION['RESPONSE']['profile_id'] = $_SESSION['RESPONSE']['user_id'] = $_SESSION['RESPONSE']['first_name'] = $_SESSION['RESPONSE']['last_name'] = $_SESSION['RESPONSE']['surname'] = $_SESSION['RESPONSE']['gender'] = $_SESSION['RESPONSE']['date_of_birth'] = $_SESSION['RESPONSE']['mobile_number'] = $_SESSION['RESPONSE']['pan_card']= $_SESSION['RESPONSE']['adhaar_number']= $_SESSION['RESPONSE']['country_code']= $_SESSION['RESPONSE']['country_name']= $_SESSION['RESPONSE']['state_name']= $_SESSION['RESPONSE']['city_name']= $_SESSION['RESPONSE']['distt_name']= $_SESSION['RESPONSE']['pin_code']= $_SESSION['RESPONSE']['address']= $_SESSION['RESPONSE']['address2']= $_SESSION['RESPONSE']['telephone']= $_SESSION['RESPONSE']['nationality']= $_SESSION['RESPONSE']['documents']=  '';
                // End removing agent details from session
              $_SESSION['anothertime'] = true;             
             }        
           $this->render('service_provider_dashboard');            
        }else{
            if($_SESSION['RESPONSE']['user_type']=='3'){
                if(isset($_SESSION['anothertime'])){
            }else{
                $_SESSION['RESPONSE']['subuser_first_name'] = $_SESSION['RESPONSE']['first_name'];
                $_SESSION['RESPONSE']['subuser_last_name'] = $_SESSION['RESPONSE']['last_name'];
                $_SESSION['RESPONSE']['subuser_email'] = $_SESSION['RESPONSE']['email'];
                $_SESSION['RESPONSE']['subuser_user_id'] =   $_SESSION['RESPONSE']['user_id'];
                $userd = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y' AND   user_id=".$_SESSION['RESPONSE']['subuser_user_id'])->queryRow();
                $_SESSION['RESPONSE']['sp_type'] =     $userd['sp_type'];

                    // Remove agent details from session
                      $_SESSION['RESPONSE']['email'] = $_SESSION['RESPONSE']['iuid'] = $_SESSION['RESPONSE']['profile_id'] = $_SESSION['RESPONSE']['user_id'] = $_SESSION['RESPONSE']['first_name'] = $_SESSION['RESPONSE']['last_name'] = $_SESSION['RESPONSE']['surname'] = $_SESSION['RESPONSE']['gender'] = $_SESSION['RESPONSE']['date_of_birth'] = $_SESSION['RESPONSE']['mobile_number'] = $_SESSION['RESPONSE']['pan_card']= $_SESSION['RESPONSE']['adhaar_number']= $_SESSION['RESPONSE']['country_code']= $_SESSION['RESPONSE']['country_name']= $_SESSION['RESPONSE']['state_name']= $_SESSION['RESPONSE']['city_name']= $_SESSION['RESPONSE']['distt_name']= $_SESSION['RESPONSE']['pin_code']= $_SESSION['RESPONSE']['address']= $_SESSION['RESPONSE']['address2']= $_SESSION['RESPONSE']['telephone']= $_SESSION['RESPONSE']['nationality']= $_SESSION['RESPONSE']['documents']=  '';
                     // End removing agent details from session
                      $_SESSION['anothertime'] = true;
                     
                }          
       
             $this->render('sub_user_dashboard');
            }else{
                if($_SESSION['RESPONSE']['user_type']=='1'){

                     $this->render('walkthrough', array('error' => $error));
                }else{
                    if($_SESSION['RESPONSE']['user_type']=='4'){
                        if(isset($_COOKIE["VPDTOKEN"])){
                            $tokencondition = $_COOKIE["VPDTOKEN"];
                            Yii::app()->db->createCommand("UPDATE temp_vpd_doclist 
                                SET vpd_token = NULL, user_id = '".$_SESSION['RESPONSE']['user_id']."'
                             WHERE vpd_token = '".$tokencondition."' ")->execute();
                         }
                   
                        //$user_id  = $_SESSION['RESPONSE']['user_id'];
                        // Yii::app()->db->createCommand("UPDATE vpd_documents SET doc_status='E', updated_on='".date('Y-m-d H:i:s')."' WHERE user_id = $user_id AND doc_status IN ('P','PI') AND expired_on < NOW()")->execute();

                    $this->render('other_user', array('error' => $error));
                     }
                }
               
            }
            
        }
    }

  /*  public function actionInvestorWalkthroughaamir() {
        $this->layout = '//layouts/new_dashboard';
      
         $error = '';
        if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
            $error = 'Unauthorized User';

        @session_start();
        if (isset($_POST['SSO_TOKEN'])) {

            extract($_POST);
            $data = $_POST;

            $res = Utility::getViaCurl($SSO_HREF);
        
            $_res = json_decode($res);
            $RESPONSE = 0;
            if (is_object($_res))
                $RESPONSE = (array) $_res->RESPONSE;
            if (count($RESPONSE) > 4) {
                $is_valid_sso_token = 1;
                $_SESSION['LOGGED_IN'] = 1;
                $_SESSION['RESPONSE'] = $RESPONSE;
            }
            $_SESSION['RESPONSE']['user_type'] = $logintype;
          


            if (isset($_POST['SSO_DEPT_ID']) && !empty($_POST['SSO_DEPT_ID'])) {

                $dept_id = $_POST['SSO_DEPT_ID'];
                $encoded_dept_id = base64_encode($dept_id);
                $encoded_user_id = base64_encode($RESPONSE['user_id']);
                $this->redirect('/ticket/open.php?user_id=' . $encoded_user_id . '&dept_id=' . $encoded_dept_id);
            }

         
        }

    if($_SESSION['RESPONSE']['user_type']=='2'){ 

        if(isset($_SESSION['anothertime'])){

        }else{
             $_SESSION['RESPONSE']['agent_first_name'] = $_SESSION['RESPONSE']['first_name'];
        $_SESSION['RESPONSE']['agent_last_name'] = $_SESSION['RESPONSE']['last_name'];
        $_SESSION['RESPONSE']['agent_email'] = $_SESSION['RESPONSE']['email'];
        $_SESSION['RESPONSE']['agent_user_id'] =   $_SESSION['RESPONSE']['user_id'];
        $userd = Yii::app()->db->createCommand("SELECT * FROM sso_users where user_id=".$_SESSION['RESPONSE']['agent_user_id'])->queryRow();
        $_SESSION['RESPONSE']['sp_type'] =     $userd['sp_type']  ;


              $_SESSION['RESPONSE']['email'] = $_SESSION['RESPONSE']['iuid'] = $_SESSION['RESPONSE']['profile_id'] = $_SESSION['RESPONSE']['user_id'] = $_SESSION['RESPONSE']['first_name'] = $_SESSION['RESPONSE']['last_name'] = $_SESSION['RESPONSE']['surname'] = $_SESSION['RESPONSE']['gender'] = $_SESSION['RESPONSE']['date_of_birth'] = $_SESSION['RESPONSE']['mobile_number'] = $_SESSION['RESPONSE']['pan_card']= $_SESSION['RESPONSE']['adhaar_number']= $_SESSION['RESPONSE']['country_code']= $_SESSION['RESPONSE']['country_name']= $_SESSION['RESPONSE']['state_name']= $_SESSION['RESPONSE']['city_name']= $_SESSION['RESPONSE']['distt_name']= $_SESSION['RESPONSE']['pin_code']= $_SESSION['RESPONSE']['address']= $_SESSION['RESPONSE']['address2']= $_SESSION['RESPONSE']['telephone']= $_SESSION['RESPONSE']['nationality']= $_SESSION['RESPONSE']['documents']=  '';

              $_SESSION['anothertime'] = true;
             
        }          
       
             $this->render('service_provider_dashboard');
            
        }else{
            $this->render('aamirdashboard', array('error' => $error));
        }
    }*/

    public function actionInvestorWalkthroughLevel2() {
        /* echo "<pre>";
          print_r($_SESSION);
          die; */
        $this->render('investor_dashboard');
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of CAF
     */
    public function actionListingCAF() {
        //$userID='11';
        session_start();
        //  print_r($_SESSION);die;
        $userID = $_SESSION['RESPONSE']['user_id'];
        $cafData = ApplicationV2Ext::AppliedApplicationByAnInvestor($userID, '1', 'INV');
        $this->render('listingCAF', array("cafData" => $cafData));
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of EU
     */
    public function actionListingEU() {
        // $userID='11';
        session_start();
        $userID = $_SESSION['RESPONSE']['user_id'];
        $euData = ApplicationV2Ext::AppliedApplicationByAnInvestor($userID, '11', 'INV');
        $this->render('listingEU', array("euData" => $euData));
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of SERVICES
     */
    public function actionListingSERVICES() {
        $this->render('listingSERVICES');
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of QUERIES
     */
    public function actionListingQUERIES() {
        $this->render('listingQUERIES');
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of TICKETS
     */
    public function actionListingTICKETS() {
        $this->render('listingTICKETS');
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of GRIEVANCE
     */
    public function actionListingGRIEVANCE() {
        $this->render('listingGRIEVANCE');
    }

    // Rahul Kumar 
    // 01012018
    // Calculating time on documents
    // $sno = "application's sno"
    // It will return time taken by applicant and time taken by department

    public function calculateDmsTimeline($sno) {
        $allData = array();
        $_GET['sid'] = $sno;
        $isIntegratedWithDMS = 1;
        $diffdept12 = 0;
        $diffapplicant = 0;
        $timingStartOf = "department";
        $turn = "department";
        $flgo = 0;
        $isIntegratedWithDMS = 1;
        if ($isIntegratedWithDMS == 1) {  // Getting All Entry of  documents for the service
            $sql_si = "SELECT * FROM bo_application_dms_documents_mapping where sno=$sno ORDER BY created_on DESC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_si);
            $data_arr = $command->queryAll();

            // Running a loop and preparing data according as per our need
            $jhk = array();
            foreach ($data_arr as $key => $d) {
                $dfv = date('m-d-Y H:i', strtotime($d['created_on']));
                $status = $d['status'];

                if ($d['user_agent'] == "Api Access") {

                    $allData[$dfv]['U'][] = $d;
                    if (!in_array($dfv, $jhk)) {
                        $jhk[] = $dfv;
                        $lastKey[] = $d['created_on'];
                    }
                }
                if ($d['user_agent'] == "Auto Insert when investor upload the docs") {
                    $allData[$dfv]['D'][] = $d;
                    if (!in_array($dfv, $jhk)) {
                        $jhk[] = $dfv;
                        $lastKey[] = $d['created_on'];
                    }
                }
                if (!empty($d['last_updated'])) {

                    $dfv1 = date('m-d-Y H:i', strtotime($d['last_updated']));
                    $allData[$dfv1][$status][] = $d;
                    if (!in_array($dfv1, $jhk)) {
                        $jhk[] = $dfv1;
                        $lastKey[] = $d['last_updated'];
                    }
                }
            }
            if (!empty($lastKey)) {
                arsort($lastKey);
                $lastKey = array_reverse($lastKey);
            }
            // data in array sorting by datetime
            if (!empty($allData)) {
                ksort($allData);
            }
            //  $allData = array_reverse($allData);
            // Getting all uploaded required document's count for service , for furthur check with reamain need to upload document  in case of rejected document- 
            $sql_si = "SELECT COUNT(*) as totalrequireddoc FROM bo_application_dms_documents_mapping where user_agent='Api Access' AND sno=$sno";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_si);
            $totalDocData = $command->queryRow();


            if (!empty($allData)) {
                $sno1 = 0;
                $diffdept12 = 0;
                $diffapplicant = 0;
                foreach ($allData as $key1 => $d3) {
                    //$lastKey[$sno1]=$key1;
                    foreach ($allData[$key1] as $keyyu => $d1) {
                        // In Case of Investor's action , Name  of Investor and IUID
                        $statuses[] = $keyyu;
                        // In case of Reject document. Timer starts for applicant
                        // 
                        // Getting Total Reuploade documents
                        $sql_si = "SELECT COUNT(*) as totalReuploaded FROM bo_application_dms_documents_mapping where sno='$_GET[sid]' AND created_on<= '$lastKey[$sno1]' AND user_agent='Auto Insert when investor upload the docs'";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_si);
                        $reuploadedData = $command->queryRow();
                        $hjh = date('s', strtotime($lastKey[$sno1]));
                        $rem = 60 - $hjh;
                        $newtimestamp = strtotime("$lastKey[$sno1] + $rem second");
                        $ldate = date('Y-m-d H:i:s', $newtimestamp);

                        // Getting Total verified till this row
                        $sql_si = "SELECT COUNT(*) as totalVerified FROM bo_application_dms_documents_mapping where sno='$_GET[sid]' AND last_updated< '$ldate' AND status!='U'";

                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_si);
                        $verifiedData = $command->queryRow();

                        // Getting Total action  taken till this row
                        $sql_si = "SELECT COUNT(*) as totalaction FROM bo_application_dms_documents_mapping where sno='$_GET[sid]' AND last_updated<= '$lastKey[$sno1]' AND status IN ('V','R')";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_si);
                        $totalaction = $command->queryRow();

                        // Total remain documents to verify at dept end
                        $sql_si = "SELECT COUNT(*) as needtoverify FROM bo_application_dms_documents_mapping where sno='$_GET[sid]' AND created_on<= '$lastKey[$sno1]' AND status IN ('U')";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_si);
                        $needtoverify = $command->queryRow();

                        // Total verified documents
                        $sql_si = "SELECT COUNT(*) as totalverifieditem FROM bo_application_dms_documents_mapping where sno='$_GET[sid]'  AND status IN ('V')";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_si);
                        $totalverifieditem = $command->queryRow();

                        // Temporary calculation for testing of remaing document
                        //  echo $verifiedData['totalVerified'] + $reuploadedData['totalReuploaded'] . "/" . $totalDocData['totalrequireddoc'] . "<br>";

                        if ($verifiedData['totalVerified'] + $reuploadedData['totalReuploaded'] == $totalDocData['totalrequireddoc']) {
                            // if all document uploaded then set flag for time in department's bucket
                            $turn = "department";
                        } else {
                            // if all document uploaded then set flag for time in applicant's bucket
                            $turn = "applicant";
                        }
                        if ($totalaction['totalaction'] != $totalDocData['totalrequireddoc']) {
                            $turn = "department";
                        }

                        if ($verifiedData['totalVerified'] == $reuploadedData['totalReuploaded'] + $totalDocData['totalrequireddoc'] && $totalverifieditem['totalverifieditem'] != $totalDocData['totalrequireddoc']) {
                            // if all document uploaded then set flag for time in department's bucket
                            $turn = "applicant";
                            if (empty($lastKey[$sno1 + 1])) {
                                $flgo = 1;
                            }
                        }

                        // Time calculation for applicant
                        if ($turn == "applicant") {
                            if ($sno1 != 0) {
                                $fty = $sno1 - 1;
                                $secDate = $lastKey[$fty];
                                $startdate = $lastKey[$sno1];

                                $diffappl = abs(strtotime($startdate) - strtotime($secDate));
                                $diffapplicant = $diffapplicant + $diffappl;
                            }
                        }
                        // Time calculation for department
                        if ($turn == "department") {
                            if ($sno1 != 0) {
                                $fty = $sno1 - 1;
                                $secDate = $lastKey[$fty];
                                $startdate = $lastKey[$sno1];
                                $diff12 = abs(strtotime($startdate) - strtotime($secDate));
                                $diffdept12 = $diffdept12 + $diff12;
                            }
                        }
                    } $sno1 = $sno1 + 1;
                }
                // If still pending ar applicant's end
                if ($flgo == 1) {

                    if ($turn == "applicant") {
                        if ($sno1 != 0) {
                            $fty = $sno1 - 1;
                            $secDate = $lastKey[$fty];
                            $startdate = date('Y-m-d H:i:s');

                            $diffappl = abs(strtotime($startdate) - strtotime($secDate));
                            //echo "<br>".$diff1;
                            $diffapplicant = $diffapplicant + $diffappl;
                        }
                    }
                }
            }

            $total['applicant'] = $diffapplicant;
            $total['department'] = $diffdept12;


            return $total;
        }
    }

    // Rahul Kumar
    //Added: 1406018
    // It will return service's time taken by applicant and department;
    // $appsgf= app's current status
    // $sid= app's sno

    public function getServiceTotalTimeline($sid, $appsgf) {
        $diffdept = 0;
        $diffapplicant = 0;
        $total = array();
        $diff = 0;
        $applications = $this->getApplicationHistory($sid);
        foreach ($applications as $key => $apps) {
            $status = $apps['application_status'];
            if ($appsgf != "I") {
                // Time taken by applicant for particular action
                if ($status == "RBI") {
                    $keyval = $key - 1;
                    if ($keyval >= 0) {
                        $date = $applications[$keyval]['added_date_time'];
                    } else {
                        $date = date('Y-m-d H:i:s');
                    }
                    $diff = abs(strtotime($apps['added_date_time']) - strtotime($date));
                    $diffapplicant = $diffapplicant + $diff;
                }
                // Time taken by department for particular action
                if ($status != "RBI") {
                    if ($key == 0) {
                        if ($status == "A" || $status == "R") {
                            $date = $apps['added_date_time'];
                        } else {
                            $date = date('Y-m-d H:i:s');
                        }
                    } else {
                        $keyval = $key - 1;
                        $date = $applications[$keyval]['added_date_time'];
                    }

                    $diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));
                    $diffdept = $diffdept + $diff1;
                }
            }
        }
        $total['department'] = $diffdept;
        $total['applicant'] = $diffapplicant;
        return $total;
    }

    // Rahul Kumar
    //Added: 04012018
    // It will return department's application Id of an applied service
    // $sno= app's sno

    public function getServiceApplicationID($sno) {
        $connection = Yii::app()->db;
        $sql = "SELECT app_id FROM bo_sp_applications where sno=$sno";
        $command = $connection->createCommand($sql);
        $applicationDetail = $command->queryRow();
        return $applicationDetail;
    }

    public function getApplicationHistory($sno) { //echo $userId; die; 
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_sp_application_history where sp_app_id=:sno Order By history_id DESC";
        $command = $connection->createCommand($sql);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $AppList = $command->queryAll();
        // print_r($AppList); die;
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public function getApplicationHistoryDetail($sno) { //echo $userId; die; 
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_sp_application_history where sp_app_id=:sno AND application_status!='I' Order By history_id ASC";
        $command = $connection->createCommand($sql);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $AppList = $command->queryAll();
        //print_r($AppList); die;
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public function getUserView($userId) { //echo $userId; die;
        $connection = Yii::app()->db;

        $sql = "SELECT sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number,sso_users.email FROM sso_profiles
			 LEFT JOIN sso_users ON sso_users.user_id = sso_profiles.user_id where sso_users.is_account_active='Y' AND sso_profiles.user_id=:userId";

        $command = $connection->createCommand($sql);
        $command->bindParam(":userId", $userId, PDO::PARAM_INT);
        $AppList = $command->queryRow();
        //  print_r($AppList); die;
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getLandTimeline($ID = null) {
        // $ID='1502';
        $connection = Yii::app()->db;
        // Fetching First entry of applicant while he satrted fillling application
        $sql = "SELECT * FROM bo_application_flow_logs where submission_id='$ID' ORDER BY log_id";

        $command = $connection->createCommand($sql);
        $appDetails = $command->queryAll();


        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
        foreach ($appDetails as $detailoftransaction) {
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['log_id'])) {
                if (@$detailoftransaction['approver_role_id'] == "") {
                    $role = "Investor";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created_date_time'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                    if (isset($role) && $role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                    /* $years = floor($timeInString / (365 * 60 * 60 * 24));
                      $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                      $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                      $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                      $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                      $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                      $allDays = ($years*365)+($months * 30) + $days;
                      $timetaken= "$allDays days, $hours hrs, $minuts min"; */
                }
                $count = $count + 1;
            }
        }

        $timetakenInv = 0;
        $years = floor($invTime / (365 * 60 * 60 * 24));
        $months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($years * 365) + ($months * 30) + $days;
        $timetakenInv = "$allDays days";
        $INVTIME = $timetakenInv;


        $timetakenNod = 0;
        $years = floor($nodTime / (365 * 60 * 60 * 24));
        $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($years * 365) + ($months * 30) + $days;
        $timetakenNod = "$allDays days";
        $NODTIME = $timetakenNod;

        $totTIme = $nodTime + $invTime;
        $years = floor($totTIme / (365 * 60 * 60 * 24));
        $months = floor(($totTIme - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($totTIme - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($totTIme - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($totTIme - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($totTIme - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($years * 365) + ($months * 30) + $days;
        $totTym = "$allDays days";
        // $NODTIME=$timetakenNod;

        $result['Inv'] = $INVTIME;
        $result['Nod'] = $NODTIME;
        $result['Tot'] = $totTym;

        return $result;
    }

    /**
     * @author: Apoorv
     * @date: 19062018
     * @description: service Dashboard 
     */
    public function actionServiceNew() {
        $this->render('service_new');
    }

    /**
     * @author: Rahul Kumar
     * @date: 06062018
     * @description: Listing Of CAF
     */
    public function actionListingCAFOverALL() {
        //$userID='11';
        session_start();
        $this->render('listingCAF_overall');
    }

    /**
     * @author: Apoorv
     * @date: 21062018
     * @description: service Dashboard 
     */
    public function actionServiceExisting() {
        $this->render('service_existing');
    }

    /**
     * @author: shishir
     * @date: 19 july 2018
     * @description: Investor Dashboard 
     */
    public function actionInvestorWalkthroughNew() {
        $error = '';
        if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
            $error = 'Unauthorized User';
        @session_start();
        if (isset($_POST['SSO_TOKEN'])) {
            extract($_POST);
            $data = $_POST;
            $res = Utility::getViaCurl($SSO_HREF);
            $_res = json_decode($res);
            $RESPONSE = 0;
            if (is_object($_res))
                $RESPONSE = (array) $_res->RESPONSE;
            if (count($RESPONSE) > 4) {
                $is_valid_sso_token = 1;
                $_SESSION['LOGGED_IN'] = 1;
                $_SESSION['RESPONSE'] = $RESPONSE;
            }
            /*
              @Created:4April2018
              @Pankaj
              @Redirect to Ticket
             */
            if (isset($_POST['SSO_DEPT_ID']) && !empty($_POST['SSO_DEPT_ID'])) {
                $dept_id = $_POST['SSO_DEPT_ID'];
                $encoded_dept_id = base64_encode($dept_id);
                $encoded_user_id = base64_encode($RESPONSE['user_id']);
                $this->redirect('/ticket/open.php?user_id=' . $encoded_user_id . '&dept_id=' . $encoded_dept_id);
            }
        }
        // echo "<pre>";print_r($_POST);die;
        $this->render('walkthroughNew', array('error' => $error));
    }

    /**
     * @author: Rahul Kumar 
     * @date: 31032019- Last Day of FY 2018-2019
     * @description: Payment of CAF 2.0
     */
    public function actionSubmitApplicationForPayment() {
       // extract($_POST);
      // print_r($_POST);echo "===".$submission_id;die;
        if ($this->isInvestorLoggedIn() && !empty($_POST)) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $caf = $this->checkCurrentApplicationStatus($_POST['submission_id'], $_POST['user_id']);
            if (!$caf) {
                throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
                exit;
            }else{
                extract($caf);
            }
            if (!isset($_POST['YII_CSRF_TOKEN_SUBMIT'])) {
                throw new Exception("Invalid request found.", 403);
            }
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $post = DefaultUtility::sanatizeParams($_POST);
            if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN_SUBMIT'])
                throw new Exception("Invalid Request", 1);
            unset($post['YII_CSRF_TOKEN_SUBMIT']);
            $this->render('payment2', array(
                "submission_id" => $post['submission_id'],
                "iuid" => $iuid,
                'application_id' => 1,
                "amount" => 1
            ));
            exit;
        }else {
            throw new Exception("Unauthourised Access", 1);
        }





        $this->redirect(SSO_URL1);
    }

    private function checkCurrentApplicationStatus($sub_id, $uid) {
        $resultOfParticularCAF=array();
        $result = Yii::app()->db->createCommand("select application_status,field_value,service_id,sso_users.iuid from bo_new_application_submission "
                . " INNER JOIN sso_users on bo_new_application_submission.user_id=sso_users.user_id "
                . " LEFT JOIN bo_payment_detail on bo_new_application_submission.submission_id = '$sub_id' "
                . " where bo_new_application_submission.submission_id='$sub_id' AND bo_new_application_submission.user_id='$uid'")->queryRow();
        if (!empty($result)) {
            if ($result['application_status'] == "B") {
                $postData=(array)json_decode($result['field_value']);
                $amount=3;
                if (isset($postData['UK-FCL-00038_10']) && !empty($postData['UK-FCL-00038_10']) && isset($postData['UK-FCL-00051_3']) && !empty($postData['UK-FCL-00051_3']) && $result['service_id'] == '591.0') {
                    // 
                    if (isset($postData["UK-FCL-00648_0"]) && !empty($postData["UK-FCL-00648_0"]) && $_POST['UK-FCL-00038_11'] != 'New') {
                        $natureOfUnit = $postData['UK-FCL-00038_10']; //Nature of Unit
                        $Investment = $postData['UK-FCL-00645_0']; //Investment
                    } else {
                        $natureOfUnit = $postData['UK-FCL-00038_10']; //Nature of Unit
                        $Investment = $postData['UK-FCL-00051_3']; //Investment
                    }
                    
                    if ($natureOfUnit == 'Manufacturing' && $Investment > 1000) {
                     $amount="1";
                    }
                    
                    if ($natureOfUnit == 'Services' && $Investment > 500) {
                        $amount="2";
                    }
                    $resultOfParticularCAF['amount']=$amount;
                    $resultOfParticularCAF['submission_id']=$amount;
                    $resultOfParticularCAF['iuid']=$result['iuid'];
                }
                
                return $resultOfParticularCAF;
            }
        }
    }

        public function actionSurveyDetail($Serveyid)
        {
            $serveyid = $_GET['Serveyid'];
            // $sql = "SELECT * from bo_survey ORDER BY survey_id DESC LIMIT 500";
            $sql = "SELECT * from bo_survey ORDER BY survey_id DESC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $survey_list = $command->queryAll();
            // echo '<pre>';
            // var_dump($survey_list);
            // die();
             return $this->render('survey_list', [
                'survey_detail'     =>  $survey_list,
                    ]);
        }
        public function actionGetSurvey() {
            // echo $uid;die;

            //echo 'hello'; die();
            $sql = "SELECT * from bo_survey_submission ORDER BY survey_id DESC limit 1000";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $survey_list = $command->queryAll();
            // echo '<pre>';
            // var_dump($survey_list);
            // die();
             return $this->render('survey_list', [
                'survey_list'     =>  $survey_list,
                    ]);
        }
        
		
		public function actionPaymentService(){
			@session_start();	
						
			/* $sql = "SELECT bo_information_wizard_service_master.*,bo_infowizard_issuerby_master.* from bo_information_wizard_service_master LEFT JOIN bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.issuerby_id=bo_information_wizard_service_master.issuerby_id"; */
			
			$sql = "SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
				  LEFT JOIN bo_infowizard_issuerby_master as issbyM ON issbyM.issuerby_id = sm.issuerby_id	
				  WHERE sm.issuerby_id='94' AND sm.is_active='Y' ORDER BY service_name ASC";
				  
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $servicelist = $command->queryAll();
			echo "<pre>";
			print_r($servicelist);die;
			$this->render("payment_service",array('servicelist'=>$servicelist));
		}


	public function actionServiceProviderDashboard() {
        $this->render('service_provider_dashboard');
    }

/* this action made by aamir use in agent dashboard on selection of user return company list
*/
  /* public function actionGetassignusercompanies($individualuser_id){

         $company = Yii::app()->db->createCommand("SELECT c.id as c_id, c.company_name, c.reg_no 
            from agent_service_provider a
            INNER JOIN bo_company_details c ON c.id=a.company_id
            where a.user_id=$individualuser_id AND c.is_active=1 AND a.is_revoke=0
            GROUP By a.company_id")->queryAll();
         if($company){
            echo "<option value=''>Please Select</option>";
            foreach ($company as $key => $value) {
             echo "<option value='".$value['c_id']."'>".$value['company_name'].' - '.$value['reg_no']."</option>";
            }
         }else{
            echo "<option>-</option>";
         }
   }*/

  

  

   

}
