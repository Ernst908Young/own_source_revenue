<?php

class PaymentController extends Controller {

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

    /**
     * this function is for Verify Payment
     * @author Rahul Kumar 
     */
    public function actionVerifyPayment() {

        $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;

        $post = DefaultUtility::sanatizeParams($_POST);
//print_r($post);die;
        if (!isset($post['Payment']['YII_CSRF_TOKEN_SUBMIT'])) {
            Yii::app()->user->setFlash('error', "403 : Invalid request found.");
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
        }

        if ($post['Payment']['YII_CSRF_TOKEN_SUBMIT'] != $YII_CSRF_TOKEN) {
            Yii::app()->user->setFlash('error', "403 : Unauthorised Access.");
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
        }

        if (!isset($post['Payment']) && !empty($post['Payment'])) {
            //  throw new Exception("Invalid request found.", 403); 
            Yii::app()->user->setFlash('error', "403 : Invalid request found.");
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
        }
        if (isset($post['Payment']['PrKey']) && empty($post['Payment']['PrKey'])) {
            Yii::app()->user->setFlash('error', "403 : Invalid request found.");
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
        }

        $this->isInvestorLoggedIn();


        $userID = 0;
        $dataRef3 = 0;

        // P
        $userID = $_SESSION['RESPONSE']['user_id'];
        $dataRef1 = base64_decode($post['Payment']['PrKey']);
        $dataRef2 = $dataRef1 / $_SESSION['RESPONSE']['user_id'];
        $dataRef3 = ($dataRef2 - $_SESSION['RESPONSE']['iuid']);

        //$userID."=="
        $sql = "Select submission_id from bo_new_application_submission where submission_id='$dataRef3' AND user_id='$userID'";
       // echo $sql;  
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        // print_r($result);die;
        if (!empty($result)) {
            $submission_id = $result['submission_id'];

            // Checking Micro
            $pman = PaymentDetailExt::isPaymentRequired($submission_id);
            // echo "======".$pman; die;
            if ($pman) {
                $amount = PaymentDetailExt::calculateCAFFee($submission_id);
                
               // echo "======".$amount;die;
                if ($amount > 0) {
                    $currentDate = date('Y-m-d H:i:s');
                    $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='PD',application_updated_date_time='$currentDate' WHERE submission_id=$submission_id";
                    $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
                    $sno = ApplicationSubmissionExt::getSnoBySubmissionId($submission_id, 'sno');
                    // if($sno)
                    $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='PD',updated_on='$currentDate' WHERE sno=$sno";
                    $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
                     $this->render('verify_payment', array('submission_id' => $submission_id));
                    

                    // insert in application history
                }
            } else {
                $currentDate = date('Y-m-d H:i:s');
                $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$currentDate' WHERE submission_id=$submission_id";
                $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
                 $serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($submission_id);
                 
                 $sno=$serviceData['sno'];
                   $service_id = $serviceData['service_id'];
                   $process_level = $serviceData['processing_level'];
                // if($sno)
                $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
                $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
                
                $this->ForwardToDepartment($submission_id,$sno,$service_id,$process_level);
                
                 Yii::app()->user->setFlash('success', "Application has been submitted successfuly");
                 DefaultUtility::sendSMSEmailGlobalCAF2('CAF', 'On successful submission of CAF', $submission_id);
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
            }
            //$this->render('verify_payment', array('submission_id' => $submission_id));
           // die('00');
            
        } else {
           //  die('11');
            Yii::app()->user->setFlash('error', "403 : Invalid request found.");
            $this->redirect('/backoffice/frontuser/home/investorWalkthrough');
        }
    }

    /**
     * @author: Rahul Kumar 
     * @date: 31032019- Last Day of FY 2018-2019
     * @description: Payment of CAF 2.0
     */
    public function actionSubmitApplicationForPayment() {
        // extract($_POST);
    //  print_r($_POST);echo "===";
        if ($this->isInvestorLoggedIn() && !empty($_POST)) {
            $uid = $uid = $_SESSION['RESPONSE']['user_id'];
         //   $PayNow = $this->isPaymentRequired($_POST['submission_id']);
         //   if ($PayNow > 0) {
                $caf = $this->checkCurrentApplicationStatus($_POST['submission_id'], $_POST['user_id']);
              //  print_r($caf);die;
                if (!$caf) {
                    //  throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
                    Yii::app()->user->setFlash('Error', "Something went wrong. Please contact Adminstrator. Error Code is: 404");
                    $this->redirect(Yii::app()->homeUrl);
                    //  exit;
                } else {
                    extract($caf);
                }
                if (!isset($_POST['YII_CSRF_TOKEN_SUBMIT'])) {
                    // throw new Exception("Invalid request found.", 403);
                    Yii::app()->user->setFlash('Error', "Invalid request found.");
                    $this->redirect(Yii::app()->homeUrl);
                }
                $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
                $post = DefaultUtility::sanatizeParams($_POST);
                if ($YII_CSRF_TOKEN != $post['YII_CSRF_TOKEN_SUBMIT']) {
                    // throw new Exception("Invalid Request", 1);
                    unset($post['YII_CSRF_TOKEN_SUBMIT']);
                    Yii::app()->user->setFlash('Error', "Invalid Request");
                    $this->redirect(Yii::app()->homeUrl);
                }
              $amount = PaymentDetailExt::calculateCAFFee($post['submission_id']);
              if(isset($_SESSION['RESPONSE']['user_id']) && $_SESSION['RESPONSE']['user_id']==11){
                    $amount=1;
                }
             // print_r( $amount);die;
                $this->render('payment2', array(
                    "submission_id" => $post['submission_id'],
                    "iuid" => $iuid,
                    'application_id' => 1,
                    "amount" => $amount
                ));
                exit;
           
        } else {
           // die("--");
            Yii::app()->user->setFlash('Error', "Unauthourised Access.");
            $this->redirect(Yii::app()->homeUrl);
            //   throw new Exception("Unauthourised Access", 1);
        }
        $this->redirect(SSO_URL1);
    }

    private function checkCurrentApplicationStatus($sub_id, $uid) {
        $resultOfParticularCAF = array();

        $result = Yii::app()->db->createCommand("select application_status,field_value,service_id,sso_users.iuid from bo_new_application_submission "
                        . " INNER JOIN sso_users on bo_new_application_submission.user_id=sso_users.user_id "
                        . " LEFT JOIN bo_payment_detail on bo_new_application_submission.submission_id = '$sub_id' "
                        . " where bo_new_application_submission.submission_id='$sub_id' AND bo_new_application_submission.user_id='$uid'")->queryRow();


        if (!empty($result)) {
            if ($result['application_status'] == "PD") {
                $postData = (array) json_decode($result['field_value']);
                $amount = PaymentDetailExt::calculateCAFFee($sub_id);
                if(isset($_SESSION['RESPONSE']['user_id']) && $_SESSION['RESPONSE']['user_id']==11){
                    $amount=1;
                }
                $resultOfParticularCAF['amount'] = $amount;
                $resultOfParticularCAF['submission_id'] = $sub_id;
                $resultOfParticularCAF['iuid'] = $result['iuid'];
            }
            return $resultOfParticularCAF;
        }
    }
   
    /**
     * 
     * @param type $submission_id
     * @param type $sno
     * @param type $service_id
     * @author Rahul Kumar
     * @created 04042019
     */
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
            $ForwardLevelmodel->updated_date_time = "";
            $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $ForwardLevelmodel->comment_date = "";
            $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
            $ForwardLevelmodel->approv_status = 'P';
            $ForwardLevelmodel->save();
            if($ForwardLevelmodel->save()) {
                $msg = $msg . "Saved In History Table";
				if (isset($ForwardLevelmodel->next_role_id) && ($ForwardLevelmodel->next_role_id != "") && isset($ForwardLevelmodel->forwarded_dept_id) && ($ForwardLevelmodel->forwarded_dept_id != "") && isset($serviceData['app_distt']) && ($serviceData['app_distt'] != "")) 
				{
					$var_next_role_id = $ForwardLevelmodel->next_role_id;
					$var_forwarded_dept_id = $ForwardLevelmodel->forwarded_dept_id;

					$sql = "select * from bo_user left join  bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id=:role_id and disctrict_id=:district_id and dept_id=:dept_id";
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
				}
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
    }
/**
     * this function is used to check the investor logged in: Reusing the same
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
    
    public function actionPaymentRedirect(){
        $this->render('payment_redirect');
    }
    /*For Testing Only - Please Delete */
    public function actionGetNewCafAmount(){
        extract($_GET);
//       for($i=5100; $i<5300; $i++){
//        echo $i."===".PaymentDetailExt::calculateCAFFee($i)."<br>"; 
//    }
         echo $subID."===";print_r(PaymentDetailExt::calculateCAFFee($subID,'Y'));echo "<br>"; 
    die;    
}



    public function actionUnifiedPayment(){
        @session_start();	
		$service_id = $_GET['service_id'];	
		
		$submission_id = $_GET['app_id'];		
		$_SESSION['service_id']	= $service_id;
		$sd = explode(",",$service_id);
		$primaryID=$sd[0];
		$_SESSION['submission_id']	= $submission_id;
			
		$sql = "SELECT sm.*,sp.*,sf.service_type,sf.fee_detail,sf.treasury_head_detail,sf.comment,issbyM.name,issbyM.issuerby_id FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
				  INNER JOIN bo_information_wizard_service_fee as sf ON CONCAT(sf.service_id,'.',sf.servicetype_additionalsubservice) = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
				  LEFT JOIN bo_infowizard_issuerby_master as issbyM ON issbyM.issuerby_id = sm.issuerby_id	
				  WHERE CONCAT(sf.service_id,'.',sf.servicetype_additionalsubservice) in ($service_id)  AND sp.is_active='Y' ORDER BY service_name ASC";
		// sm.id=$primaryID AND 	
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$servicelist = $command->queryAll();
		/*  echo "<pre>";
			print_r($servicelist);die;  */
		$uno = $submission_id.$_SESSION['RESPONSE']['user_id'];
		$userpass = 0070;
        $this->render('unified_payment',array('servicelist'=>$servicelist,'service_id'=>$service_id,'submission_id'=>$submission_id,'uno'=>$uno,'userpass'=>$userpass));      
    }
    
    public function actionUnifiedPaymentResponse(){
        
        if(isset($_POST)){
            $postData = json_encode($_POST);
			$paymentData = explode("|",$postData);
            $date = date('Y-m-d H:m:s');
			$paymentData['status']='S';
           /*  $sql = "Insert into bo_unified_payment_logs (user_id,submission_id,service_id,post_info,created) values('" . $_SESSION['RESPONSE']['user_id'] . "','" . $_SESSION['submission_id'] . "','" . $_SESSION['service_id'] . "','" . $postData . "','" . $date . "')"; */
		    $sql = "Insert into bo_unified_payment_logs (user_id,submission_id,service_id,post_info,ref_no,challan_no,	status,status_desc,amount,bank_name,trans_id,created) values('" . $_SESSION['RESPONSE']['user_id'] . "','" . $_SESSION['submission_id'] . "','" . $_SESSION['service_id'] . "','" . $postData . "','".@$paymentData['ref_no']."','".@$paymentData['challan_no']."','".@$paymentData['status']."','".@$paymentData['status_desc']."','".@$paymentData['amount']."','".@$paymentData['bank_name']."','".@$paymentData['trans_id']."','" . $date . "')";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $InsertLog = $command->execute();
			
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($_SESSION['submission_id']);
			
			$currentDate = date('Y-m-d H:i:s');
            $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='P',application_updated_date_time='$currentDate' WHERE submission_id=$_SESSION[submission_id]";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
			
            $sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
                // if($sno)
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($_SESSION['submission_id'],$sno,$service_id,$process_level);
			unset($_SESSION["submission_id"]);
			unset($_SESSION["service_id"]);
            Yii::app()->user->setFlash('sucsess', "Payment has been successfuly.");
           // $this->redirect(Yii::app()->homeUrl);
            $this->redirect("/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL");
        }        
    }
    
    public function actionUnifiedPaymentError(){
        //echo "TEST ERROR PAGE";
        if(isset($_POST)){
            $postData = json_encode($_POST);
			$paymentData = explode("|",$postData);
            $date = date('Y-m-d H:i:s');
			$paymentData['status']='F';
            $sql = "Insert into bo_unified_payment_logs (user_id,submission_id,service_id,post_info,ref_no,challan_no,	status,status_desc,amount,bank_name,trans_id,created) values('" . $_SESSION['RESPONSE']['user_id'] . "','" . $_SESSION['submission_id'] . "','" . $_SESSION['service_id'] . "','" . $postData . "','".@$paymentData['ref_no']."','".@$paymentData['challan_no']."','".@$paymentData['status']."','".@$paymentData['status_desc']."','".@$paymentData['amount']."','".@$paymentData['bank_name']."','".@$paymentData['trans_id']."','" . $date . "')";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $InsertLog = $command->execute();
			
			//This will set payment due in bo_new_application_submission in case of payment failed
			$currentDate = date('Y-m-d H:i:s');
            $serviceApplicationUpdateQuery = "UPDATE bo_new_application_submission SET application_status='PD',application_updated_date_time='$currentDate' WHERE submission_id=$_SESSION[submission_id]";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
			
			//This will set payment due in bo_sp_applications in case of payment failed
			$serviceData= ApplicationSubmissionExt::getSnoBySubmissionId($_SESSION['submission_id']);
            $sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];
                // if($sno)
            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='PD',updated_on='$currentDate' WHERE sno=$sno";		
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
			// Insert In History Table 
            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $sno;
            $modelSPH->service_id = $serviceData['sp_app_id'];
            $modelSPH->sp_tag = $serviceData['sp_tag'];
            $modelSPH->app_id = $submission_id;
            $modelSPH->application_status = 'PD';
            $modelSPH->comments = 'Investor payment due because of payment failure.';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();
				
			unset($_SESSION["submission_id"]);
			unset($_SESSION["service_id"]);
            Yii::app()->user->setFlash('Error', "Oh Snap!! Something went wrong. Payment is failed!");
            $this->redirect("/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL");
        }
    }
}

?>	