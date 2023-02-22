<?php

class DefaultController extends Controller {

    public function init() {
        if (isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id']) {
            
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl("../sso/account/signin"));
        }
    }

    public function actionMakepayment($p_id) {
        $model = Payment::model()->findByPk($p_id);
        
        if (isset($_POST['p_id'])) {
            $model = Payment::model()->findByPk($p_id);
            $update_date = date('Y-m-d H:i:s');
            $payment_offline_detail_no = isset($_POST['payment_offline_detail_no']) ? $_POST['payment_offline_detail_no'] : '';
            $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : '';
            $payment_type = isset($_POST['type']) ? $_POST['type'] : '';
            $ser_name = isset($_POST['ser_name']) ? $_POST['ser_name'] : '';
            $payment_received_by = $_POST['payment_received_by'];
            $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
            $totalfee = isset($_POST['total_fee']) ? $_POST['total_fee'] : '';
            $chalan_no = isset($_POST['chalan_no']) ? $_POST['chalan_no'] : '';

            Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='P' ,application_updated_date_time='$update_date' where submission_id=" . $model->submission_id)->execute();

            Yii::app()->db->createCommand("UPDATE tbl_payment SET payment_status='success' ,payment_type='$payment_type',fees_item='$ser_name ',updated_at='$update_date' , payment_received_by=$payment_received_by, payment_offline_detail_no='$payment_offline_detail_no ',bank_name='$bank_name', msg='$subject' where id=" . $_POST['p_id'])->execute();


            $processId = $model->submission_id;
            $service_srn = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = $processId")->queryRow();
            $uid = $service_srn['user_id'];
            $sid = $service_srn['service_id'];

            $currentDate = date('Y-m-d H:i:s');
            $serviceNameArr = ApplicationV2Ext::getInfowizServiceDetails($sid);
            $sptagData = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=" . $service_srn['dept_id'])->queryRow();
            $allData = Yii::app()->db->createCommand("SELECT landrigion_id FROM bo_new_application_submission where submission_id=$processId")->queryRow();

            $serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($processId);
            $sno = $serviceData['sno'];
            $service_id = $serviceData['service_id'];
            $process_level = $serviceData['processing_level'];

            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_status='P',updated_on='$currentDate' WHERE sno=$sno";
            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
            $this->ForwardToDepartment($processId, $sno, $service_id, $process_level);

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $processId;
            $modelSPH->service_id = $serviceNameArr['swcs_service_id'];
            $modelSPH->sp_tag = $sptagData['service_provider_tag'];
            $modelSPH->app_id = $processId;
            $modelSPH->application_status = "P";
            $modelSPH->comments = 'Application Submitted and Payment Paid Successfully';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save();

            //Investor log Save
            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = "N.A";
            $modellog->submission_id = $processId;
            $modellog->application_id = $processId;
            $modellog->user_id = $uid;
            $modellog->dept_id = $service_srn['dept_id'];
            $modellog->application_status = "P";
            $modellog->form_id = 1;
            $modellog->service_id = $sid;
            $modellog->application_created_date = date('Y-m-d H:i:s');
            $modellog->application_updated_date_time = date('Y-m-d H:i:s');
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $modellog->unit_name = '';
            $modellog->landrigion_id = $allData['landrigion_id'];
            $modellog->save();

            $investor_log_id = Yii::app()->db->getLastInsertID();
            $model_app_log = new FormBuilderApplicationLog;
            $model_app_log->service_id = $sid;
            $model_app_log->form_id = 1;
            $model_app_log->core_department_id = $service_srn['dept_id'];
            $model_app_log->app_Sub_id = $processId;
            $model_app_log->department_user_id = '0';
            $model_app_log->action_status = "P";
            $model_app_log->action_taken_by_name = 'Investor';
            $model_app_log->action_message = 'Application Submitted and Payment Paid Successfully';
            $model_app_log->investor_id = $uid;
            $model_app_log->department_comment = '';
            $model_app_log->investor_log_id = $investor_log_id;
            $model_app_log->dept_log_id = 0;
            $model_app_log->created = date('Y-m-d H:i:s');
            $model_app_log->save();

            Yii::app()->user->setFlash('success', 'Payment has submitted successfully');
            $sql = "SELECT * FROM bo_new_application_submission where submission_id='" . $processId  . "'";
            $model = NewApplicationSubmission::model()->findBySql($sql);    
			// echo  $model->submission_id;
			// echo '<br>';
			// echo $model->user_id;die;
             Alertsandnotification::sendnotification('Services', $model->submission_id,$model->user_id,'FO','Your payment was paid successfully','');  

             Alertsandnotification::sendnotification('Services', $model->submission_id,Yii::app()->session['uid'],'BO',"Payment of application : $model->submission_id was paid",'');  
           

            Sendmailforservice::senttofobo_pendingforapproval($model); 
            Sendmailforservice::payment_successfull($model,$chalan_no,$totalfee,$processId);  
            return $this->redirect('/backoffice/admin');
        }
        $this->render('paymentform', ['model' => $model]);
    }

    public function ForwardToDepartment($submission_id = null, $sno = null, $service_id = null, $processLevel) {
        $msg = "";
        $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$service_id AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();

        $serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($submission_id);
        $applicationExt = New ApplicationExt;
        $serviceArr = $applicationExt->getServiceNameById($service_id);
        $service_Name = $serviceArr['core_service_name'];
        if (isset($serviceData) && !empty($serviceData)) {
            // Forward to department Entry Part
            $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
            $ForwardLevelmodel->next_role_id = @$allData['next_role_id'];
            $ForwardLevelmodel->verifier_user_id = '0';
            $ForwardLevelmodel->app_Sub_id = $submission_id;
            $ForwardLevelmodel->forwarded_dept_id = $serviceData['dept_id'];
            $ForwardLevelmodel->post_info = "";
            $ForwardLevelmodel->verifier_user_comment = '';
            $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
            //$ForwardLevelmodel->updated_date_time = "";
            $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
            //$ForwardLevelmodel->comment_date = "";
            $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
            $ForwardLevelmodel->approv_status = 'P';
            $ForwardLevelmodel->save();
            if ($ForwardLevelmodel->save()) {
                $msg = $msg . "Saved In History Table";
            } else {
                die(var_dump($ForwardLevelmodel->getErrors()));
            }
        }
    }

    public function actionCancelpayment($subID) {
        $subID = base64_decode($subID);
        $model = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id = $subID")->queryRow();
        $update_date = date('Y-m-d H:i:s');


        $this->render('refundform', ['model' => $model]);
    }

    public function actionCancel() {
        if (isset($_POST['submission_id'])) {

          $app_status = Yii::app()->db->createCommand("SELECT application_status,service_id,processing_level  FROM bo_new_application_submission where submission_id='" . $_POST['submission_id']  . "'")->queryRow();
          if($app_status['application_status']=='H' || $app_status['application_status']=='R'){
              $this->ForwardToDepartment($_POST['submission_id'], $_POST['submission_id'], $app_status['service_id'], $app_status['processing_level']);
          }

            $update_date = date('Y-m-d H:i:s');
            $s_id = $_POST['submission_id'];
            $name = $_POST['applicant_name'];
            $address = $_POST['address'];
            $n_r = $_POST['national_registration'];
            $nis = $_POST['nis_number'];
            $company_name = $_POST['company_name'];
            $company_add = $_POST['company_address'];
            $reason = $_POST['reason_for_change'];
            $amount = $_POST['fee_amount'];
            $officer = $_POST['officer_request'];

            Yii::app()->db->createCommand("INSERT INTO tbl_refund_requested 
		(submission_id,name,address,national_registration,nis_number,company_name,company_address,reason_for_change,amount,officer_submiting_req,
		created_at,updated_at,is_active) VALUES (" . $s_id . ",'" . $name . "','" . $address . "','" . $n_r . "','" . $nis . "','" . $company_name . "','" . $company_add . "','" . $reason . "','" . $amount . "','" . $officer . "','" . $update_date . "','" . $update_date . "','1') ")->execute();

            Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='RI' ,application_updated_date_time='$update_date' where submission_id=" . $_POST['submission_id'])->execute();

            $app = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=" . $_POST['submission_id'])->queryRow();

            $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = $app['field_value'];
            $modellog->submission_id = $app['submission_id'];
            $modellog->application_id = $app['submission_id'];
            $modellog->user_id = $app['user_id'];
            $modellog->dept_id = $app['dept_id'];
            $modellog->application_status = 'RI';
            $modellog->form_id = 1;
            $modellog->service_id = $app['service_id'];
            $modellog->application_created_date = date("Y-m-d H:i:s");
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            /* $modellog->unit_name = @$unitName;
              $modellog->landrigion_id = @$landrigion_id; */
            if ($modellog->save()) {
                $investor_log_id = Yii::app()->db->getLastInsertID();
            } else {
                die(var_dump($modellog->getErrors()));
            }
            //Investor log Save
            //Save Data IN bo_sp_application_history for log
            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = "";
            $s_id = explode('.', $app['service_id']);
            $modelSPH->service_id = $s_id['0'];
            $modelSPH->sp_tag = 'CAIPO';
            $modelSPH->app_id = $app['submission_id'];
            $modelSPH->application_status = 'RI';
            $modelSPH->comments = 'Application Refund Requested';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');

            if ($modelSPH->save()) {
                
            } else {
                die(var_dump($modelSPH->getErrors()));
            }

            $payment = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=" . $app['submission_id'])->queryRow();
// Mailer for FO user
           

            if ($payment) {
                if ($payment['payment_mode'] == 1) { // Online payment
                    $transaction_no = $payment['transaction_number'];
                    $content = '<strong>Dear ' . $name . ",<br><br></strong>Your refund amount has been successfully initiated. Refund of $ " . $amount . " against SRN: " . $app['submission_id'] . "  and transaction no. " . $transaction_no . " is succesfully initiated.<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
                    Regards,<br>
                    Corporate Affairs and Intellectual Property Office<br>
                    Ground Floor, BAOBAB Tower, Warrens<br>
                    St. Michael, Barbados<br>
                    Tel: (246) 535-2401 Fax: (246) 535-2444<br>
                    <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
                    Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
                } else { // Offline payment
                    $content = '<strong>Dear ' . $name . ",<br><br></strong>Your refund amount has been successfully initiated. Refund of  $ " . $amount . "  against SRN:  " . $app['submission_id'] . " has been successfully  initiated by the Treasury  and you would be contacted by the concerned Department. Please reach out to the helpdesk in case of any concern. <br><br>Note: This is a system enerated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
                    Regards,<br>
                    Corporate Affairs and Intellectual Property Office<br>
                    Ground Floor, BAOBAB Tower, Warrens<br>
                    St. Michael, Barbados<br>
                    Tel: (246) 535-2401 Fax: (246) 535-2444<br>
                    <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
                    Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
                }
            } else {
                $content = '';
            }
          //  $mail->MsgHTML($content);
          //  $mail->Send();
            $subject = 'Payment Refund Successful';
            $to = isset($payment['reference_email'])? $payment['reference_email']:''; //$email;
            $name = $name;
            $content = $content;
            $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                               'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
            DefaultUtility::post_to_url(EMAIL_API,$post_data); 
// 		// Mailer for BO user
           
            $subject1 = 'Payment Refund Successful';
            $to1 = 'caipodummy@gmail.com'; //$email;
            $name1 = $name;
            $content1 = '<strong>Dear ' . $name1 . ",<br><br></strong> Refund of $ " . $amount . "  against SRN:  " . $app['submission_id'] . " has been succesfully initiated.
			<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
            Regards,<br>
            Corporate Affairs and Intellectual Property Office<br>
            Ground Floor, BAOBAB Tower, Warrens<br>
            St. Michael, Barbados<br>
            Tel: (246) 535-2401 Fax: (246) 535-2444<br>
            <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
            Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
            $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                               'subject'=>$subject1,'to'=>$to1,'content'=>$content1,'email_name'=>EMAIL_NAME);                
            DefaultUtility::post_to_url(EMAIL_API,$post_data); 

            Yii::app()->user->setFlash('success', "Refund Requested for Application Id : " . $_POST['submission_id']);
            return $this->redirect('/backoffice/investor/home/investorWalkthrough');
        }
    }

    public function actionApproverefund($sub_id) {
        //$p_id = '129';
        $model = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=" . $sub_id)->queryRow();
        $refund_request = Yii::app()->db->createCommand("SELECT * FROM tbl_refund_requested WHERE submission_id=" . $sub_id)->queryRow();

        if ($model && $refund_request) {
            if (isset($_POST['submission_id'])) {

                $msg = "Refund Success";
                $name = $model['reference_name'];
                $number = $model['reference_number'];
                $email = $model['reference_email'];
                $processId = $model['process_id'];
                $tno = time() . $model['id'];
                $account = $model['pg_account'];
                $fee = $model['total_amount'];
                $pstatus = "refund success";
                $comment = $_POST['items'];
                $uid = $model['payment_submit_by'];
                $sid = $model['service_id'];
                $current_userid = @$_SESSION['uid'];

                Yii::app()->db->createCommand("INSERT INTO tbl_payment(service_id,submission_id, service_total_fee, total_amount, payment_mode, payment_status, transaction_number,reference_name,reference_number,reference_email,process_id,pg_account,msg,fees_item,payment_submit_by,is_fee_refunded,payment_received_by)
				VALUES ('$sid','$processId','$fee','$fee',1,'$pstatus','$tno','$name','$number','$email','$processId','$account','$msg','$comment','$uid',1,$current_userid)")->execute();

                $update_date = date('Y-m-d H:i:s');
                $updateNewApp = Yii::app()->db->createCommand("UPDATE bo_new_application_submission SET application_status='RS' ,application_updated_date_time='$update_date' where submission_id=" . $sub_id)->execute();
                $app = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=" . $sub_id)->queryRow();

                //Save Data IN bo_sp_application_history for log
                $modelSPH = new SpApplicationHistory;
                $modelSPH->sp_app_id = "";
                $s_id = explode('.', $app['service_id']);
                $modelSPH->service_id = $s_id['0'];
                $modelSPH->sp_tag = 'CAIPO';
                $modelSPH->app_id = $app['submission_id'];
                $modelSPH->application_status = 'RS';
                $modelSPH->comments = 'Application Refund Successful';
                $modelSPH->role_user_info = 'Demo Verifier<br/>demo.verifier@email.com<br/>7007895755';
                $modelSPH->added_date_time = date('Y-m-d H:i:s');

                if ($modelSPH->save()) {
                    
                } else {
                    die(var_dump($modelSPH->getErrors()));
                }
                $name = $model['reference_name'];
                $amnt = $model['total_amount'];
                $email = $model['reference_email'];
                $transaction_no = $model['transaction_number'];

                $subject = 'Payment Refund Successful';
                $to = $email;
                $name = $name;
                $content = '<strong>Dear ' . $name . ",<br><br></strong>Your refund has been successful. Payment of $ " . $amnt . " against SRN: " . $sub_id . " and transaction no. " . $transaction_no . " is confirmed.
                <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
                Regards,<br>
                Corporate Affairs and Intellectual Property Office<br>
                Ground Floor, BAOBAB Tower, Warrens<br>
                St. Michael, Barbados<br>
                Tel: (246) 535-2401 Fax: (246) 535-2444<br>
                <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
                Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
                $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                                   'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
                DefaultUtility::post_to_url(EMAIL_API,$post_data); 

                Yii::app()->user->setFlash('success', "Refund Successful for Application Id : " . $_POST['submission_id']);
                return $this->redirect('/backoffice/admin');
            }
        } else {

            Yii::app()->user->setFlash('error', "Sorry! something went wrong Application Id : " . $_POST['submission_id']);
            return $this->redirect(array('/backoffice/cashier/default/approverefund', 'sub_id' => $sub_id));
        }
        $this->render('approve_refund', ['model' => $model, 'sub_id' => $sub_id, 'refund_request' => $refund_request]);
    }

    public function actionPrintrefundform($subID) {
        $sub_id = base64_decode($subID);
        $model = Yii::app()->db->createCommand("SELECT * FROM tbl_refund_requested where submission_id=" . $sub_id)->queryRow();
        $content = $this->renderPartial('refund_pdf', ['sub_id' => $sub_id, 'model' => $model], true);

        Refundutility::generatePdf($content, 'refund');
    }
// for offline payment Applicant use this pdf
    public function actionPrintofflinefeeform($subID) {
        $sub_id = base64_decode($subID);
       
       $model = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='pending' AND submission_id=" . $sub_id)->queryRow();
        $sql="SELECT * FROM bo_new_application_submission WHERE submission_id =:srn_no";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":srn_no",$sub_id, PDO::PARAM_STR);
        $service_srn=$command->queryRow();
       // print_r($model);die;
       $service_fee = [];
        if($model){
            if($model['service_id']=='2.0'){
                 $farr = (array) json_decode($service_srn['field_value']);
                    $form_id = $farr['UK-FCL-00044_0'];
                    $sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND page_form_id = :form_id AND service_id=:sid";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $command->bindParam(":sid",  $model['service_id'], PDO::PARAM_STR);
                    $command->bindParam(":form_id",  $form_id, PDO::PARAM_STR);
                    $service_fee =$command->queryRow();
            }else{
                $sql="SELECT * FROM tbl_service_fee where status=1 AND fee_detail='service fee' AND service_id=:sid";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->bindParam(":sid",  $model['service_id'], PDO::PARAM_STR);
                $service_fee =$command->queryRow();
            }
        }
       


        $content = $this->renderPartial('offlinefee_pdf', ['model' => $model,'service_fee'=>$service_fee], true);
      //  print_r($content);die;
        Refundutility::generatePdf($content, 'refund');
    }
// for offline payment Applicant use this pdf as reciept
    public function actionPrintofflinefeereciept($subID) {
         $sub_id = base64_decode($subID);
        $model = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=" .$sub_id)->queryRow();
        $content = $this->renderPartial('offlinefeereciept_pdf', ['sub_id' => $sub_id, 'model' => $model], true);

        Refundutility::generatePdf($content, 'refund');
    }


    public function actionPrintofflinerefundreciept($subID) {
        $sub_id = base64_decode($subID);
        $model = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=" .$sub_id)->queryRow();
        $content = $this->renderPartial('offlinerefund_pdf', ['sub_id' => $sub_id, 'model' => $model], true);

        Refundutility::generatePdf($content, 'refund');
    }

    public function actiontest() {        
        $subject = 'Payment Refund';
        $to = 'apoorvsinghal1988@gmail.com';
        $name = "Apoorv";
        $content = '<strong>Dear ' . $name . ",<br><br></strong>Your refund has been successful. Payment of $ " . $name . " against SRN: " . $name . " and transaction no. " . $name . " is confirmed.
		<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
        Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
        $post_data=(array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME));             
        echo DefaultUtility::post_to_url(EMAIL_API,$post_data);    
    }

}
