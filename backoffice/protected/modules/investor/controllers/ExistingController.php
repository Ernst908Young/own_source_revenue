<?php

/**
 * @author: Rahul Kumar
 */
class ExistingController extends Controller {

    /**
     * this function is used to get the caf detail .. please delete
     * @author Rahul Kumar 
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
        $this->render("redirectService", array("params" => $rervetedArray));
    }

    protected function getInvestorDetail($uid) {
        // echo $uid;die;
        $sql = "SELECT usr.*, prof.* from sso_users usr INNER JOIN sso_profiles prof ON usr.user_id=prof.user_id
        WHERE usr.user_id=$uid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $appCount = $command->queryRow();
        // echo $appCount;die;
        return $appCount;
    }

    /**
     * this function is used to get the payment amount of the CAF Application
     * @author Rahul Kumar
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
        //echo "<pre>";print_r($fields);
        $distric = null;
        if ((isset($fields->Land_in_Hectares) && !empty($fields->Land_in_Hectares)) && (isset($fields->land_leased_disctric) && !empty($fields->land_leased_disctric))) {
            $distric = trim($fields->land_leased_disctric);
        } else {
            if (isset($fields->land_disctric) && !empty($fields->land_disctric)) {
                $distric = trim($fields->land_disctric);
            } else {
                $distric = trim($fields->unit_district);
            }
        }


        if(isset($fields->ntrofunit, $fields->invstmnt_in_plant[0]) && (($fields->ntrofunit == 'Manufacturing' && $fields->ntrofunittype == 'large' && $fields->invstmnt_in_plant[0] > 10) || ($fields->ntrofunit == 'Services' && $fields->ntrofunittype == 'large' && $fields->invstmnt_in_plant[0] > 5)))
            $distric = 6;


        if (isset($distric) && !empty($distric)) {
            return $distric;
        } else {
            return 0;
        }
    }

    /**

     * this function is used to get the next role id of the verifier(nodal)

     * @author HEmant thakur

     * date: 18 Nov 2016

     */
    private function getNextRoleId($app_fields) {

        $next_role_id = 33;
        if (isset($app_fields->ntrofunit, $app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit == 'Manufacturing' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 10) || ($app_fields->ntrofunit == 'Services' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 5)))
            $next_role_id = 34; 

        return $next_role_id;
    }

    /**
     * this function is used to check the investor logged in
     * @author Rahul Kumar
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
     * @author Rahul Kumar
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

     * @author Rahul Kumar

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
     * @author Rahul Kumar
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

    /**
     * this function is used to get the last verifier application
     * @author Rahul Kumar
     * date 27022018
     */
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

            $sql = "SELECT iw.chklist_id as code,iw.name as document_name,dms.document_name as file_name,dms.doc_status as document_status,iwdt.name as document_type,iwdt.abbr as document_type_code	FROM cdn_dms_documents as dms INNER JOIN bo_infowizard_documentchklist as iw ON iw.docchk_id = dms.docchk_id NNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id	WHERE dms.user_id=1049 AND dms.iuid=52796497 AND dms.is_document_active='Y' AND (dms.doc_status='U' OR dms.doc_status='V')";

            /*  $model = new boSpApplications;
              $model->sp_tag="DOI@908#123";
              $model->sp_app_id="280";
              $model->app_id=$app_sub_id;
              $model->app_name="Existing CAF";
              $model->app_status="p";
              $model->app_comments="Existing CAF Application Submitted";
              $model->app_distt=$landrigion_id;
              $model->user_id=$_SESSION['RESPONSE']['user_id'];
              $model->created_on=date('Y-m-d H:i:s');
              $model->updated_on=date('Y-m-d H:i:s');
              $model->is_active="Y";
              $model->remote_server= $_SERVER['REMOTE_ADDR'];
              $model->user_agent= $_SERVER['HTTP_USER_AGENT']; */

            //Update Pending In service table 'bo_sp_applications'

            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='Existing CAF Application Submited',app_status='P' WHERE app_id=$app_sub_id; AND sp_tag='DOI@908#123'";

            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

            if ($serviceDetail) {
                echo "Updated in bo application";
                die;
            }
        }

        $appErrors = $model->geterrors();
        foreach ($appErrors as $key => $errors) {
            foreach ($errors as $key => $error) {
                $err .= '<li>' . $error . '</li>';
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
     * @author Rahul Kumar
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

                $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm'));

                exit;
            }

            // echo "<pre>";print_r($_FILES);die;

            if ($post['selected_doc_type'] == 'image/jpeg') {

                $jpgArray = array("image/jpeg", "image/png", "image/jpg");

                if (!in_array($_FILES['caf_applications_uploads']['type'], $jpgArray)) {

                    Yii::app()->user->setFlash('Error', "Please select the file of same type that you have selected in File Type Drop Down.");

                    $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm/documentUpload/1'));
                }
            } else if ($post['selected_doc_type'] != $_FILES['caf_applications_uploads']['type']) {

                Yii::app()->user->setFlash('Error', "Please select the file of same type that you have selected in File Type Drop Down.");

                $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm/documentUpload/1'));
            }

            $docProp = ApplicationCdnMappingExt::getDocumentProperties($post['caf_applications_uploads']['doc_id']);

            $doc_min_size = intval($docProp['doc_min_size']) * 1000;

            $doc_max_size = intval($docProp['doc_max_size']) * 1000;

            if ($_FILES['caf_applications_uploads']['size'] < $doc_min_size || $_FILES['caf_applications_uploads']['size'] > $doc_max_size) {

                Yii::app()->user->setFlash('Error', "Please select the file of size $doc_min_size - $doc_max_size KB");

                $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm/documentUpload/1'));
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

                    $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm/documentUpload/1'));
                }
            }

            Yii::app()->user->setFlash('Success', "File Uploaded Successfully.");

            $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm/documentUpload/1'));
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

     * @author Rahul Kumar

     * date : 18 Nov 2016

     */
    public function actionSaveCAFPartially() {

        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;

            if (isset($_POST['investment_detail']) && $_POST['investment_detail'] == 'In Lakh') {
                $invstmnt_in_land = $_POST['invstmnt_in_land'][0];
                $invstmnt_in_building = $_POST['invstmnt_in_building'][0];
                $invstmnt_in_plant = $_POST['invstmnt_in_plant'][0];
                $invstmnt_in_wrkingcapital = $_POST['invstmnt_in_wrkingcapital'][0];
                $invstmnt_in_other = $_POST['invstmnt_in_other'][0];

                $_POST['invstmnt_in_land'][0] = ($invstmnt_in_land) / 100;
                $_POST['invstmnt_in_building'][0] = ($invstmnt_in_building) / 100;
                $_POST['invstmnt_in_plant'][0] = ($invstmnt_in_plant) / 100;
                $_POST['invstmnt_in_wrkingcapital'][0] = ($invstmnt_in_wrkingcapital) / 100;
                $_POST['invstmnt_in_other'][0] = ($invstmnt_in_other) / 100;
            }
			$unit_name = "";
			if(isset($_POST['company_name']))
			{
				$unit_name = $_POST['company_name'];
			}
			/* echo "<pre>";
            print_r($_POST);die;  */
            $post = DefaultUtility::sanatizeParams($_POST);
            if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN'])
                throw new Exception("Invalid Request", 1);

            unset($post['YII_CSRF_TOKEN']);

            $model = $this->checkLastApplicationStatus($uid, 11);
            $dept_id = DepartmentsExt::getDeptIdFromUniqCode('DOI');
            $applicationTableFlag = 0;

            if (!$model) {

                $model = new ApplicationSubmission;

                $model->application_id = 11;
                $model->user_id = $uid;
                $model->dept_id = $dept_id;

                $model->field_value = json_encode($post);
                $model->application_status = 'I';
                $model->application_created_date = date('Y-m-d H:i:s');
                $model->application_updated_date_time = date('Y-m-d H:i:s');
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $model->landrigion_id = null;
                $applicationTableFlag = 1;
            } else {
                $model->field_value = json_encode($post);
                $model->application_updated_date_time = date('Y-m-d H:i:s');
            }
				/* echo "<pre>";
              print_r($model);die('shishir');   */
            if ($model->save()) {
				//echo $applicationTableFlag;die();
                if ($applicationTableFlag == 1) {
                    $modelSpApplications = new SpApplications;
                    $modelSpApplications->sp_tag = "DOI@908#123";
                    $modelSpApplications->sp_app_id = "280";
                    $modelSpApplications->app_id = $model->submission_id;
                    $modelSpApplications->app_name = "Registration of Existing Enterprise";
                    $modelSpApplications->app_status = "I";
                    $modelSpApplications->app_comments = "Existing Enterprise Application Submitted Partialy";
                    $modelSpApplications->app_distt = $model->landrigion_id; 
                    $modelSpApplications->user_id = $_SESSION['RESPONSE']['user_id'];
                    $modelSpApplications->created_on = date('Y-m-d H:i:s');
                    $modelSpApplications->updated_on = date('Y-m-d H:i:s');
                    $modelSpApplications->is_active = "Y";
					if(!empty($unit_name))	{
						$modelSpApplications->unit_name = $unit_name;
					}
					$modelSpApplications->print_app_call_back_url ="/backoffice/admin/ApplicationView/existingcafdownloadapp/id/".$model->submission_id."/name/existingUnit";
					$modelSpApplications->reverted_call_back_url ="/backoffice/frontuser/existing/cafForm/submissionID/".$model->submission_id."";
                    $modelSpApplications->remote_server = $_SERVER['REMOTE_ADDR'];
                    $modelSpApplications->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    if ($modelSpApplications->save()) {	
						// Save History in bo_sp_application_history
						$lastInsertIdSpApplication = $modelSpApplications->sno;
                        if (!empty($lastInsertIdSpApplication)) {							
                            $sno = $lastInsertIdSpApplication;  							
                            $modelSPH = new SpApplicationHistory;
                            $modelSPH->sp_app_id = $sno;
                            $modelSPH->service_id = "280";
                            $modelSPH->sp_tag = "DOI@908#123";
                            $modelSPH->app_id = $model->submission_id;
                            $modelSPH->application_status = 'I';
                            $modelSPH->comments = 'Registration of Existing Enterprise application submitted by investor';
                            $modelSPH->added_date_time = date('Y-m-d H:i:s');
                            $modelSPH->save();
                        }
						// End History in bo_sp_application_history
						
                        if ($applicationTableFlag == 1) {
                            $this->getExistingCafDocuments($modelSpApplications->sno);
                        }
                        echo json_encode(array("STATUS" => "SUCCESS"));
                    }
                }
            } else {
                echo json_encode(array("STATUS" => "ERROR"));
            }

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
     * @author Rahul Kumar
     * date : 18 Nov 2016
     */
    public function actionSubmitCafApplication() {

        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $caf = $this->checkLastApplicationStatus($uid, 11);
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

            //  $paymentCheck=$this->haveInvestorAlreadyPaid($uid,$caf->submission_id,$caf->application_id);
            // echo "<pr++e>";print_r($paymentCheck);die;
            //  if($this->hasAlreadyPaid($caf->submission_id)){
            // case might be of reverted back application whose payment already done.
            // $paymentAmount=$this->getPaymentAmount($caf->field_value);	

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

            /*  }

              else{

              // payment not done yet check whether payment is required or not

              $paymentAmount=$this->getPaymentAmount($caf->field_value);

              $distric=$this->getDistrictOfCAF(json_decode($caf->field_value));

              if($paymentAmount==0){

              // case of micro industry

              $this->render('cafAfterPayment', array(

              'response' => 'NONE',

              'app_sub_id' => $caf->submission_id,

              'land_reg' => $distric,

              'pre_field' => $_SESSION['RESPONSE'],

              'statusCode'=>'S',

              'incmplt_fields' => json_decode($caf->field_value)

              ));

              exit;

              }else{

              $updateStatus=$this->submitApplication($caf->submission_id,'I');

              if($updateStatus!='OK'){

              Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application.Please try again later");

              $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));

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

              } */



            // echo "<pre>";print_r($caf);die;
        }

        $this->redirect(SSO_URL1);
    }

    /**

     * this function is used to send the caf to the department

     * @author Rahul Kumar

     * date : 18 Nov 2016

     */
    public function actionForwardToDepartment() {
		/* 	echo $this->isInvestorLoggedIn();
         echo "<pre>";print_r($_POST);die; */

        if ($this->isInvestorLoggedIn()) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
            $caf = $this->checkLastApplicationStatus($uid, 11);
			
            if (!$caf) {
                throw new Exception("Something went wrong. Please contact Administrator. Error Code is: 404", 404);
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
			//$distric=6;
            $revertedBack = false;
            $logStatus = 'ISA';

            if ($caf->application_status == 'H') {
                $revertedBack = true;
                $logStatus = 'IBD';
            }

            $caf->landrigion_id = trim($distric);
            $caf->application_status = 'P';
            $caf->application_created_date = date('Y-m-d H:i:s');
            $caf->application_updated_date_time = date('Y-m-d H:i:s');

            if ($caf->save()) {
				$submiss_id = $caf->submission_id;
				$spApplicationUpdateSql = "UPDATE bo_sp_applications SET app_distt='$distric' WHERE app_id='$submiss_id' AND sp_app_id='280'";
                Yii::app()->db->createCommand($spApplicationUpdateSql)->execute();
				/* echo $caf->application_status;
			echo "<pre>";print_r($caf);die; */
//              $model = new SpApplications;
//              $model->sp_tag="DOI@908#123";
//              $model->sp_app_id="280";
//              $model->app_id=$caf->submission_id;
//              $model->app_name="Existing CAF";
//              $model->app_status="p";
//              $model->app_comments="Existing CAF Application Submitted";
//              $model->app_distt=1;   //$caf->landrigion_id  
//              $model->user_id=$_SESSION['RESPONSE']['user_id'];
//              $model->created_on=date('Y-m-d H:i:s');
//              $model->updated_on=date('Y-m-d H:i:s');
//              $model->is_active="Y";
//              $model->remote_server= $_SERVER['REMOTE_ADDR'];
//              $model->user_agent= $_SERVER['HTTP_USER_AGENT'];   
//              //print_r($model);die;
//              if($model->save()){
//                //  echo "Updated in bo application";die;    
//                  $this->getExistingCafDocuments($model->sno);
//               
//              }

				
				
               $next_role_id = $this->getNextRoleId(json_decode($caf->field_value));

                if (!$revertedBack) {
					
                    $verification = new ApplicationVerificationLevel;
                    $verification->next_role_id = $next_role_id;
                    $verification->app_Sub_id = $caf->submission_id;
                    $verification->created_on = date('Y-m-d H:i:s');
                    $verification->user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $verification->ip_address = $_SERVER['REMOTE_ADDR'];
                    $verification->approv_status = 'P';
					
                    if($verification->save()) {
					
                        $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='Existing Enterprise Application Submited',app_status='P' WHERE app_id=$caf->submission_id; AND sp_tag='DOI@908#123'";
                        $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
						 
                        //  print_r($serviceDetail); die;       
                        $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$caf->submission_id AND sp_tag='DOI@908#123'";
                        $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();
                      
                        if (!empty($applicationDetail)) {
							
                            $sno = $applicationDetail['sno'];  
							$this->getExistingCafDocuments($sno);							
                            // Save History in bo_sp_application_history
                            $modelSPH = new SpApplicationHistory;
                            $modelSPH->sp_app_id = $sno;
                            $modelSPH->service_id = $applicationDetail['sp_app_id'];
                            $modelSPH->sp_tag = $applicationDetail['sp_tag'];
                            $modelSPH->app_id = $applicationDetail['app_id'];
                            $modelSPH->application_status = 'P';
                            $modelSPH->comments = 'Registration of Existing Enterprise application submitted by investor';
                            $modelSPH->added_date_time = date('Y-m-d H:i:s');
                            $modelSPH->save();
                        }
                        ApplicationFlowLogs::generateWorkFlow($caf->submission_id, null, null, null, $uid, $logStatus);
                        $field = json_decode($caf->field_value);
                        $iuid = $field->IUID;
                        $company_name = $field->company_name;
                        $mobile = IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id, $next_role_id);
                        $app_name = IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
                        $msgDept = "Application Name: $app_name\r\nApplication ID: " . $caf->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";
                        IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);
                        // send sms to investor
                        $mobile = $_SESSION['RESPONSE']['mobile_number'];
                        $msgDept = "Application Name: $app_name\r\nApplication ID: " . $caf->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Your application has been submitted to the department for approval.\r\n";
                        IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);
                        $caf->save();
                        Yii::app()->user->setFlash('Success', "Your Application has been submitted for department Approval. Submission id: " . $caf->submission_id);
                        $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home/serviceExisting/type/EU/financial_year/ALL/is/service'));
                        exit;
                    } else {
                        $caf->application_status = 'P';
                        $caf->save();
                        Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
                        $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm'));
                    }
                } else {
                    // reverted back applications
                   /*  echo "<pre>";
					print_r($caf);
					echo $caf->submission_id;
					die(); */
                    $lastVerifier = $this->getLastVerifier($caf->submission_id);
					if(!empty($lastVerifier)){
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
							Yii::app()->user->setFlash('Success', "Application has been re-submitted for approval.");
							$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
						} else {
							$caf->application_status = 'H';
							$caf->save();
							Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
							$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm'));
							exit;
						}
					}else{
						/* $verification=new ApplicationVerificationLevel;
						$verification->next_role_id=$next_role_id;
						$verification->app_Sub_id=$caf->submission_id;
						$verification->created_on=date('Y-m-d H:i:s');
						$verification->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$verification->ip_address=$_SERVER['REMOTE_ADDR'];;
						$verification->approv_status='P';
						if($verification->save()){ */
							$subMiss_id =$caf->submission_id;
							$serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='Existing Enterprise Application Submitted',app_status='P' WHERE app_id='$subMiss_id' AND sp_tag='DOI@908#123'";
							
							$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
							 
							//  print_r($serviceDetail); die;       
							$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='$subMiss_id' AND sp_tag='DOI@908#123'";
							$applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();
						  
							if (!empty($applicationDetail)) {
								
								$sno = $applicationDetail['sno'];  
								$this->getExistingCafDocuments($sno);							
								// Save History in bo_sp_application_history
								$modelSPH = new SpApplicationHistory;
								$modelSPH->sp_app_id = $sno;
								$modelSPH->service_id = $applicationDetail['sp_app_id'];
								$modelSPH->sp_tag = $applicationDetail['sp_tag'];
								$modelSPH->app_id = $applicationDetail['app_id'];
								$modelSPH->application_status = 'P';
								$modelSPH->comments = 'Registration of Existing Enterprise application submitted by investor';
								$modelSPH->added_date_time = date('Y-m-d H:i:s');
								$modelSPH->save();
							}							
							ApplicationFlowLogs::generateWorkFlow($caf->submission_id,null,null,null,$uid,$logStatus);
							$field=json_decode($caf->field_value);
							$iuid=$field->IUID;
							$company_name=$field->company_name;
							$mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
							$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has re-submitted the application for your approval.\r\n";
							IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
							Yii::app()->user->setFlash('Success', "Application has been re-submitted for approval.");
							$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home')); 
							
						/* } */
					}	
                }
            } else {
                $err = '';
                $cafErrors = $caf->geterrors();
                foreach ($cafErrors as $key => $errors) {
                    foreach ($errors as $key => $error) {
                        $err .= "<li>$error</li>";
                    }
                }

                Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
                $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/existing/cafForm'));
                exit;
            }
        }
        $this->redirect(SSO_URL1);
    }

    public function actionIndex() {

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
                        '/frontuser'
                    ));

                    exit;
                } else {

                    Yii::app()->user->setFlash('Error', "Sorry! Could not download your document.");

                    $this->redirect(array(
                        '/frontuser'
                    ));

                    exit;
                }
            } else {

                Yii::app()->user->setFlash('Error', "Certificate not found.");

                $this->redirect(array(
                    '/frontuser'
                ));

                exit;
            }
        } else {

            Yii::app()->user->setFlash('Error', "Invalid Request.");

            $this->redirect(array(
                '/frontuser'
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
                '/frontuser'
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
                            '/frontuser'
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
                            '/frontuser'
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
                            '/frontuser/existing/cafForm'
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
                                    '/frontuser/existing/cafForm'
                                ));

                                exit;
                            }
                    } elseif ($_POST['selected_doc_type'][$key] == 'application/pdf') {

                        if ($file_type_check != 'application/pdf') {

                            Yii::app()->user->setFlash('Error', "Please Upload pdf file.");

                            $this->redirect(array(
                                '/frontuser/existing/cafForm'
                            ));

                            exit;
                        }
                    } elseif ($file_type_check != $_POST['selected_doc_type'][$key]) {

                        Yii::app()->user->setFlash('Error', "Please Upload " . $prop_array[$_POST['caf_applications_uploads']['doc_id'][$compare_key]]['type'] . " file.");

                        $this->redirect(array(
                            '/frontuser/existing/cafForm'
                        ));

                        exit;
                    }

                    $doc_min_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['min_size']) * 1000;

                    $doc_max_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['max_size']) * 1000;



                    if ($file_size < $doc_min_size || $file_size > $doc_max_size) {

                        /* Yii::app()->user->setFlash('Error', "File must be of size ".$doc_min_size.' - '.$doc_max_size);

                          $this->redirect(array('/frontuser/existing/cafForm'));

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
                    '/frontuser/existing/cafForm'
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
                                '/frontuser'
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
                        '/frontuser'
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

     * @author Rahul Kumar

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

                if (isset($app_fields->ntrofunit, $app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit == 'Manufacturing' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 10) || ($app_fields->ntrofunit == 'Services' && $app_fields->ntrofunittype == 'large' && $app_fields->invstmnt_in_plant[0] > 5)))
                    $vlmodel->next_role_id = 4;
                else
                    $vlmodel->next_role_id = 4;

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

                    $mobile = IncentiveSchemes::getboUserMobileFromRoleID($Application->submission_id, $vlmodel->next_role_id);

                    $app_name = IncentiveSchemes::getAppNameFromSubmissionId($Application->submission_id);

                    $msgDept = "Application Name: $app_name\r\nApplication ID: " . $Application->submission_id . "\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";

                    IncentiveSchemes::sendCustomMessageToMobile($mobile, $msgDept);

                    Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: " . $Application->submission_id);

                    $this->redirect(array(
                        '/frontuser'
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

     *  @ Author : Rahul Kumar

     *  @ params : none

     */

    public function actionPaymentPay() {

        @session_start();

        if (!isset($_SESSION['RESPONSE'], $_POST['amount'])) {

            Yii::app()->user->setFlash('Error', "Not a valid Request");

            $this->redirect(array(
                '/frontuser'
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

     *  @ Author : Rahul Kumar

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

                        $this->redirect(array('/frontuser'));

                        exit;
                    }
                } else {

                    // die("incomplete Fields not found");

                    Yii::app()->user->setFlash('Error', "Error: Invalid Request.");

                    $this->redirect(array('/frontuser'));

                    exit;
                }
            } else {

                echo "<pre>";
                print_r($paymentModel->geterrors());
            }
        } else {

            // die("dsjkdhskj");

            Yii::app()->user->setFlash('Error', "Error: Invalid Request.");

            $this->redirect(array('/frontuser'));

            exit;
        }
    }

    /* Function is used to create and submit the CAF Application Form

     *  @ Author : Rahul Kumar

     *  @ params : none

      @ return : json response to ajax

     */

    public function actionCafForm() {


		extract($_GET);
		
        $appModel = new ApplicationExt;
		
        @session_start();

        //admin can't access this page 

        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {

            throw new CHttpException(400, "you can't access this page");
        }

        //check for whether user is logged in or not
		
        if (empty($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        // echo "<pre>";print_r($_SESSION);die;

        $uid = $_SESSION['RESPONSE']['user_id'];

        $deptModel = new DepartmentsExt;

        $dept_id = $deptModel->getDeptIdFromUniqCode('DOI');

        $dept_id = 1;

        $app_id = $appModel->getAppIdFromName('Registration of Existing Enterprise', $dept_id);
		
        /* check whether application is for payment or not */

        $appPayment = ApplicationExt::checkUsersPrevCAFApplicationsForPayment($uid, $app_id);
		/* echo "<pre>";
		print_r($appPayment);die; */
		
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
	
		/* echo $any_prev_pending_caf;die("2145"); */
		
        if ($any_prev_pending_caf) {

            Yii::app()->user->setFlash('Error', "YOUR CAF APPLICATION IS ALREADY UNDER CONSIDERATION");

            $this->redirect(array(
                '/frontuser'
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
		//print_r($_GET);
		if(!isset($submissionID) && empty($submissionID)){	
			
			$submissionID=0; 
		}else{
			//echo $submissionID;die;
			//$submissionID2=base64_decode(base64_decode($submissionID)); 
			$submissionID=$submissionID; 
		}
		
		
		//echo $submissionID;
        $incmplt_fields = $appModel->getUsersCAFApplicationsOfUserExisting($uid, $app_id,$submissionID);
		/* echo "<pre>";
		print_r($incmplt_fields);die;  */
        $appStatus = "";

        if (!empty($incmplt_fields)) {

            //  echo "<pre>";print_r($incmplt_fields);die;

            $appStatus = @$incmplt_fields['application_status'];

            $incmplt_fields = json_decode($incmplt_fields['field_value']);
        }

        $pre_filed = $_SESSION['RESPONSE'];

        $app = ApplicationExt::getCAFId();

        $industries = DefaultUtility::getTypeOfIndustries();

        $document = 0;

        if (isset($_GET['documentUpload']) && !empty($_GET['documentUpload']) && $_GET['documentUpload'] == 1)
            $document = 1;
			
		/*  print_r($pre_filed);
		 echo "<br/>";
		 print_r($app);
		echo "<br/>";
        print_r($document);
		echo "<br/>";
        print_r($industries);
		echo "<br/>";
        print_r($appStatus);
		echo "<br/>";*/
		/* echo "<pre>";
        print_r($incmplt_fields);
		echo "<br/>";die();   */
        $this->render('cafForm', array(
            'pre_field' => $pre_filed,
            'app' => $app,
            'document' => $document,
            'industries' => $industries,
            'appStatus' => $appStatus,
            'incmplt_fields' => $incmplt_fields
        ));
    }

    function getExistingCafDocuments($sno = null) {

        //  session_start();

        $serviceExisting = "484.0";

        $serviceID = explode(".", $serviceExisting);
        $userID = $_SESSION['RESPONSE']['user_id'];
        $sql1 = "SELECT document_checklist_creation FROM bo_information_wizard_service_parameters  WHERE service_id=$serviceID[0] AND  servicetype_additionalsubservice=$serviceID[1] ORDER BY created DESC";
        //echo "<hr>";
        $docs = Yii::app()->db->createCommand($sql1)->queryRow();

        if (!empty($docs)) {

            $allDocumnetsForExistingCaf = json_decode($docs['document_checklist_creation']);
			//print_r( $allDocumnetsForExistingCaf );die();
            $do_array = array();

            foreach ($allDocumnetsForExistingCaf as $doces) {

                $do = $doces->doc_id;
                $sql2 = "SELECT * FROM cdn_dms_documents  WHERE docchk_id =$do AND user_id=$userID AND doc_status IN ('V','U') AND is_document_active='Y' ORDER BY documents_id DESC LIMIT 1";
                //echo $sql2."<hr>"; die;
                $docsInfo[] = Yii::app()->db->createCommand($sql2)->queryRow();
            }
        }
//print_r($docsInfo);die;

        $totalMappedDocument = 0;



        // echo $userID;  print_r($docsInfo);
        foreach ($docsInfo as $docData) {
			if(isset($docData['documents_id'])){
            $documentsID = $docData['documents_id'];

            $sql22 = "SELECT * FROM bo_application_dms_documents_mapping  WHERE sno=$sno AND user_id=$userID AND documents_id=$documentsID";
            //echo $sql22;
            $UploadedDocs = Yii::app()->db->createCommand($sql22)->queryAll();

            if (empty($UploadedDocs)) {

                $model = new ApplicationDmsDocumentsMapping;

                $model->iuid = $docData['iuid'];

                $model->user_id = $docData['user_id'];

                $model->sno = $sno;

                $model->dept_id = 1;

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
        if (count($docsInfo) == $totalMappedDocument) {

            return true;
        } else {

            return false;
        }



        // print_r($docsInfo);die;
        // Get all uploaded list of documents by Investors which are active and ready to use for departments
        // $sql = "SELECT * FROM cdn_dms_documents as dms,bo_infowizard_documentchklist as info WHERE dms.is_document_active!='R' AND dms.docchk_id IN ($do) AND dms.user_id=$userID  AND dms.docchk_id=info.docchk_id AND info.is_docchklist_active='Y' ORDER BY dms.documents_id DESC";
        // $connection = Yii::app()->db;
        // $command = $connection->createCommand($sql);
        // $documents_data = $command->queryAll();   
    }

    public function actiondeptservicemapping() {   //print_r('hi'); print_r($_POST['post_deptid']); die; // core_service_name
        if ($_POST['post_deptid']) {
            $deptID = $_POST['post_deptid'];

            $sql = "SELECT bo_information_wizard_service_parameters.service_id,bo_information_wizard_service_parameters.core_service_name,bo_information_wizard_service_parameters.servicetype_additionalsubservice 
  FROM  bo_information_wizard_service_master 
  LEFT JOIN bo_information_wizard_service_parameters ON bo_information_wizard_service_master.id=bo_information_wizard_service_parameters.service_id
  where bo_information_wizard_service_parameters.servicetype_additionalsubservice!=2 and bo_information_wizard_service_master.issuerby_id=:Depname";
            // $sql = "SELECT service_id,core_service_name FROM bo_information_wizard_service_parameters where  and servicetype_additionalsubservice=6 ";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(":Depname", $deptID, PDO::PARAM_STR);
            $services = $command->queryAll();
            //	print_r($services);die;
            $services1[] = array('service_id' => '', 'core_service_name' => '<---- Select ---->');
            foreach ($services as $key => $val) {
                $services1[] = $val;
            }
            echo json_encode($services1);
        }
        //print_r($services);
    }

    public function actionCafForm2() {
        $appModel = new ApplicationExt;
        @session_start();
        //admin can't access this page 
        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
            throw new CHttpException(400, "you can't access this page");
        }
        //check for whether user is logged in or not
        if (empty($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);



        $uid = $_SESSION['RESPONSE']['user_id'];
        $deptModel = new DepartmentsExt;
        $dept_id = $deptModel->getDeptIdFromUniqCode('DOI');
        $dept_id = 1;
        $app_id = $appModel->getAppIdFromName('Existing CAF', $dept_id);



        $investorUsersArr = $appModel->getInvestorDetails($uid);
        /* echo "<pre>";
          print_r($investorUsersArr);die(); */

        $pre_filed = $_SESSION['RESPONSE'];
        $this->render('cafForm2', array(
            'pre_field' => $pre_filed,
            'investorUsersArr' => $investorUsersArr,
        ));
    }

    public function actionSaveExistingCafForm2() {

        if ($this->isInvestorLoggedIn()) {
            $uid = $_SESSION['RESPONSE']['user_id'];
            $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
            $data = DefaultUtility::sanatizeParams($_POST);
            if ($YII_CSRF_TOKEN != $data['YII_CSRF_TOKEN'])
                throw new Exception("Invalid Request", 1);
            unset($data['YII_CSRF_TOKEN']);

            $model = $this->checkLastApplicationStatusCafForm2($uid, 11);

            //echo $dept_id = DepartmentsExt::getDeptIdFromUniqCode('DOI');

            $applicationTableFlag = 0;
            if (!$model) {
                $model = new BoExistingUnit;
                $model->application_id = 11;
                $model->user_id = $uid;
                $model->application_status = 'I';
                $model->application_created_date = date('Y-m-d H:i:s');
                $model->application_updated_date_time = date('Y-m-d H:i:s');
                $model->landrigion_id = $data['district'];
                $model->iuid = $data['iuid'];
                $model->name_of_registered_user = $data['name_of_registered_user'];
                $model->email_of_registered_user = $data['email_of_registered_user'];
                $model->mobile_no_registered_user = $data['mobile_no_registered_user'];
                $model->fax_no_of_registered_user = $data['fax_no_of_registered_user'];
                $model->land_line_number_of_registered_user = $data['land_line_number_of_registered_user'];
                $model->name_of_organization = $data['name_of_organization'];
                $model->pan_number = $data['pan_number'];
                $model->gstin_number = $data['gstin_number'];
                $model->website_of_the_company = $data['website_of_the_company'];
                $model->registered_headquarter_address = $data['registered_headquarter_address'];
                $model->state = $data['state'];
                $model->district = $data['district'];
                $model->city = $data['city'];
                $model->pin_code = $data['pin_code'];
                $model->email_of_head_quarters = $data['email_of_head_quarters'];
                $model->phone_no_of_head_quarters = $data['phone_no_of_head_quarters'];
                $model->extension = $data['extension'];
                $model->fax_no_of_head_quarters = $data['fax_no_of_head_quarters'];
                $model->are_you_a_startup = $data['are_you_a_startup'];
                $model->startup_uttarakhand_registration_no = $data['startup_uttarakhand_registration_no'];
                $model->startup_india_registration_no = $data['startup_india_registration_no'];
                $model->name_of_the_authorized_person_cordinator = $data['name_of_the_authorized_person_cordinator'];
                $model->designation_of_the_authorized_person_coordinator = $data['designation_of_the_authorized_person_coordinator'];
                $model->email_of_the_authorized_person_coordinator = $data['email_of_the_authorized_person_coordinator'];
                $model->phone_number_of_the_authorized_person_coordinator = $data['phone_number_of_the_authorized_person_coordinator'];
                $model->fax_number_of_the_authorized_person_coordinator = $data['fax_number_of_the_authorized_person_coordinator'];
                //$model->dept_id=$dept_id;
                //$model->field_value=json_encode($post);
                //$model->ip_address=$_SERVER['REMOTE_ADDR'];
                //$model->user_agent = $_SERVER['HTTP_USER_AGENT'];				
                $applicationTableFlag = 1;
            } else {
                //$model->field_value=json_encode($data);
                $model->application_updated_date_time = date('Y-m-d H:i:s');
            }



            /* echo "<pre>";
              print_r($model);
              die('shishir'); */
            if ($model->save()) {

                $modelOrganizationNature = new BoOrganizationNatureExistingCaf;
                $modelOrganizationNature->bo_existing_unit_id = $model->id;

                if (!empty($data['nature_of_organization']) && $data['nature_of_organization'] == 2) {
                    if (!empty($data['limited_liability_partnership'])) {
                        $i = 0;
                        foreach ($data['limited_liability_partnership']['llp_id_no'] as $key => $val) {
                            $dataNatureOrgArr[$i]['llp_id_no'] = $data['limited_liability_partnership']['llp_id_no'][$key];
                            $dataNatureOrgArr[$i]['partner_name'] = $data['limited_liability_partnership']['partner_name'][$key];
                            $dataNatureOrgArr[$i]['partnercategory'] = $data['limited_liability_partnership']['partnercategory'][$key];
                            $dataNatureOrgArr[$i]['share_holding'] = $data['limited_liability_partnership']['share_holding'][$key];
                            $dataNatureOrgArr[$i]['partner_id'] = $data['limited_liability_partnership']['partner_id'][$key];
                            $i++;
                        }
                        $modelOrganizationNature->save($dataNatureOrgArr);
                    }
                } else if (!empty($data['nature_of_organization']) && $data['nature_of_organization'] == 5) {
                    if (!empty($data['partnership_firm'])) {
                        $i = 0;
                        foreach ($data['partnership_firm']['firm_partner_name'] as $key => $val) {
                            $dataPartnerFirmArr[$i]['firm_partner_name'] = $data['partnership_firm']['firm_partner_name'][$key];

                            $dataPartnerFirmArr[$i]['firm_partner_category'] = $data['partnership_firm']['firm_partner_category'][$key];

                            $dataPartnerFirmArr[$i]['firm_share_holding'] = $data['partnership_firm']['firm_share_holding'][$key];

                            $dataPartnerFirmArr[$i]['partnership_pan_number'] = $data['partnership_firm']['partnership_pan_number'][$key];

                            $i++;
                        }
                        $modelOrganizationNature->save($dataPartnerFirmArr);
                    }
                } else {

                    $modelOrganizationNature->save();
                }
            } else {
                echo json_encode(array("STATUS" => "ERROR"));
            }
        }
        $this->redirect(SSO_URL1);
    }

    private function checkLastApplicationStatusCafForm2($uid, $app_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id=:uid AND application_id=:app_id AND (application_status='I' || application_status='H' || application_status='B')";
        $criteria->params = array(":uid" => $uid, ":app_id" => $app_id);
        $criteria->order = "id DESC";
        $model = BoExistingUnit::model()->find($criteria);

        if ($model === null)
            return false;

        return $model;
    }

    public static function getDitrictList($dbtable = null, $key = null, $value = null, $state_code = null, $active = null, $isactivevalue = null) {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active and state_code=$state_code";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value];
        } return $listData;
    }

	public function actionExistingCafUnitName() {
		die();
		$connection = Yii::app()->db;
		$allData2=array();
		extract($_GET);
		$sql1 = "SELECT sno,app_id,unit_name FROM `bo_sp_applications` WHERE `sp_app_id` = '280'";
		$allData1=$connection->createCommand($sql1)->queryAll();
		foreach($allData1  as $k=>$v)
		{
			$sql = "SELECT field_value FROM bo_application_submission where submission_id = $v[app_id]";
			$command = $connection->createCommand($sql);
			$allData = $command->queryRow();
			$array=json_decode($allData['field_value'],true);
			$que = "update bo_sp_applications set unit_name='$array[company_name]' where sno=$v[sno]";	
		  	$serviceDetail = Yii::app()->db->createCommand($que)->execute();
		}
		//print_r($serviceDetail);
	}
}
