<?php 
/**
 * 
 */
class Rejectapplication 
{
	public static function refundrequest($app_Sub_id){
		 $appdetails = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" . $app_Sub_id  . "'")->queryRow();
               
            
        $user =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id =".$appdetails['user_id'])->queryRow();
                $cname =  $user['first_name'].' '.$user['last_name'].' '.$user['surname'];
                $country = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$user['country_name'])->queryRow(); 
                $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$user['state_name'])->queryRow(); 
                $fulladdress =     $user['address'].' '.$user['address2'].' '.$user['city_name'].' '. $user['pin_code'].' '.$state['lr_name'].' '.$country['lr_name'];

        $payment = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$app_Sub_id)->queryRow();

               
                $n_r = NULL;
                $nis = NULL;
                $company_name = 'NA';
                $company_add = 'NA';
                $reason = 'Application was rejected';
                $amount = $payment['total_amount'];
                $officer = NULL;
                Yii::app()->db->createCommand("INSERT INTO tbl_refund_requested 
            (submission_id,name,address,national_registration,nis_number,company_name,company_address,reason_for_change,amount,officer_submiting_req,created_at,updated_at,is_active) VALUES (" . $app_Sub_id. ",'" . $cname . "','" . $fulladdress . "','" . $n_r . "','" . $nis . "','" . $company_name . "','" . $company_add . "','" . $reason . "','" . $amount . "','" . $officer . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "','1') ")->execute();

                $service_id = $appdetails['service_id'];
                $processLevel = $appdetails['processing_level'];
        $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$service_id AND current_role_id=0 AND processing_level='$processLevel'")->queryRow();

        $serviceData = ApplicationSubmissionExt::getSnoBySubmissionId($app_Sub_id);
        $applicationExt = New ApplicationExt;
        $serviceArr = $applicationExt->getServiceNameById($service_id);
        $service_Name = $serviceArr['core_service_name'];
        if (isset($serviceData) && !empty($serviceData)) {
            // Forward to department Entry Part
            $ForwardLevelmodel = new FormbuilderApplicationForwardLevel();
            $ForwardLevelmodel->next_role_id = @$allData['next_role_id'];
            $ForwardLevelmodel->verifier_user_id = '0';
            $ForwardLevelmodel->app_Sub_id = $app_Sub_id;
            $ForwardLevelmodel->forwarded_dept_id = $serviceData['dept_id'];
            $ForwardLevelmodel->post_info = "";
            $ForwardLevelmodel->verifier_user_comment = '';
            $ForwardLevelmodel->created_on = date('Y-m-d H:i:s');
            //$ForwardLevelmodel->updated_date_time = "";
            $ForwardLevelmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
            //$ForwardLevelmodel->comment_date = "";
            $ForwardLevelmodel->ip_address = $_SERVER['REMOTE_ADDR'];
            $ForwardLevelmodel->approv_status = 'P';
            $ForwardLevelmodel->save(false);            
        }

        $modellog = new NewApplicationSubmissionLog();
            $modellog->field_value = $appdetails['field_value'];
            $modellog->submission_id = $appdetails['submission_id'];
            $modellog->application_id = $appdetails['submission_id'];
            $modellog->user_id = $appdetails['user_id'];
            $modellog->dept_id = $appdetails['dept_id'];
            $modellog->application_status = 'RI';
            $modellog->form_id = 1;
            $modellog->service_id = $appdetails['service_id'];
            $modellog->application_created_date = date("Y-m-d H:i:s");
            $modellog->ip_address = $_SERVER['REMOTE_ADDR'];
            $modellog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            /* $modellog->unit_name = @$unitName;
              $modellog->landrigion_id = @$landrigion_id; */
            if ($modellog->save()) {
                /*$investor_log_id = Yii::app()->db->getLastInsertID();
                $model_app_log = new FormBuilderApplicationLog;
                $model_app_log->service_id = $serviceData['service_id'];
                $model_app_log->form_id = 1;
                $model_app_log->core_department_id = $serviceData['dept_id'];
                $model_app_log->app_Sub_id = $modellog->submission_id;
                $model_app_log->department_user_id = '0';
                $model_app_log->action_status = 'RI';
                $model_app_log->action_taken_by_name = 'Investor';
                $model_app_log->action_message = 'Investor has submitted the application';
                $model_app_log->investor_id = $serviceData['user_id'];
                $model_app_log->department_comment = '';
                $model_app_log->investor_log_id = $investor_log_id;
                $model_app_log->dept_log_id = 0;
                $model_app_log->created = date('Y-m-d H:i:s');
                $model_app_log->save();*/
            } 
            //Investor log Save


            //Save Data IN bo_sp_application_history for log
            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = "";
            $s_id = explode('.', $appdetails['service_id']);
            $modelSPH->service_id = $s_id['0'];
            $modelSPH->sp_tag = 'CAIPO';
            $modelSPH->app_id = $appdetails['submission_id'];
            $modelSPH->application_status = 'RI';
            $modelSPH->comments = 'Application Refund Requested';
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->save(false);
          
              if ($payment) {
                if ($payment['payment_mode'] == 1) { // Online payment
                    $transaction_no = $payment['transaction_number'];
                    $content = '<strong>Dear ' . $cname . ",<br><br></strong>Your refund amount has been successfully initiated. Refund of $ " . $amount . " against SRN: " . $appdetails['submission_id'] . "  and transaction no. " . $transaction_no . " is succesfully initiated.<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
                    Regards,<br>
                    Corporate Affairs and Intellectual Property Office<br>
                    Ground Floor, BAOBAB Tower, Warrens<br>
                    St. Michael, Barbados<br>
                    Tel: (246) 535-2401 Fax: (246) 535-2444<br>
                    <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
                    Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
                } else { // Offline payment
                    $content = '<strong>Dear ' . $cname . ",<br><br></strong>Your refund amount has been successfully initiated. Refund of  $ " . $amount . "  against SRN:  " . $appdetails['submission_id'] . " has been successfully  initiated by the Treasury  and you would be contacted by the concerned Department. Please reach out to the helpdesk in case of any concern. <br><br>Note: This is a system enerated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
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
          
            $subject = 'Payment Refund Successful';
            $to = isset($payment['reference_email'])? $payment['reference_email']:''; //$email;
            $name = $cname;
            $content = $content;
            $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
            DefaultUtility::post_to_url(EMAIL_API,$post_data); 

 		// Mailer for BO user
           
            $subject1 = 'Payment Refund Successful';
            $to1 = 'caipodummy@gmail.com'; //$email;
            $name1 = 'CAIPO User';
            $content1 = '<strong>Dear ' . $name1 . ",<br><br></strong> Refund of $ " . $amount . "  against SRN:  " . $appdetails['submission_id'] . " has been succesfully initiated.
			<br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br><br>
            Regards,<br>
            Corporate Affairs and Intellectual Property Office<br>
            Ground Floor, BAOBAB Tower, Warrens<br>
            St. Michael, Barbados<br>
            Tel: (246) 535-2401 Fax: (246) 535-2444<br>
            <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
            Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
            $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject1,'to'=>$to1,'content'=>$content1,'email_name'=>EMAIL_NAME);                
            DefaultUtility::post_to_url(EMAIL_API,$post_data); 

	}	

	public static function rejectstatusLabel($service_id){
		$pay_not_apply_onservicearray = ['6.0','7.0'];
		if(in_array($service_id, $pay_not_apply_onservicearray)){
			return 'Rejected';
		}else{
			return 'Rejected and Refund requested';
		}
	}
}
	