<?php 
/**
 * 
 */
class Sendmailforservice 
{
	
	public static function senttofo_draftmode($model){
		$date = date('d-m-Y');	
        $subject = 'Your Service Application Status';
       
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         $draft_url = EMAIL_WEB_URL.$model->reverted_call_back_url;
         $to = $details['email'];
		 $user_name = $details['full_name'];
        $content = "<strong>Dear $user_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>If you are still working on the application: Don't worry! You can complete it here <a href='".$draft_url."' title='link to CAIPO'> Application Link </a> when you're ready.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	public static function senttofobo_pendingforapproval($model){
		$subject = 'Your Service Application Status';
        $date = date('d-m-Y');
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         
         $to = $details['email'];
		 $user_name = $details['full_name'];
        $content = "<strong>Dear $user_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>You have successfully completed your application. Your application is now pending for approval.  A representative will take the required action as soon as possible.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);

        // email send to BO verifier users

        $subject = 'Application assigned for Verification and Approval/Rejection';       
        
        $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	

       	$details = Yii::app()->db->createCommand("SELECT CONCAT(u.full_name,' ',u.middle_name,' ',u.last_name) as full_name, u.email FROM tbl_user_service_role as us INNER JOIN bo_user u ON u.uid=us.user_id WHERE CONCAT(us.service_id,'.0')='".$model->service_id."' AND us.role_id = 83 AND us.is_active='Y'")->queryAll();

       if($details){
				foreach ($details as $key => $value) {
		       		 $to = array($value['email']);
					 $user_name = array($value['full_name']);				}
			}else{
				 $to = 'caipodummy@gmail.com';
			}	
	        $content = "<strong>Dear CAIPO-Verifier</strong>,<br><br>Please log in to CAIPO portal to review the assigned application for ".$ser_name['core_service_name']." SRN ($model->submission_id). Please take necessary action by $date.<br><br>
			Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
			<br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

			$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

	        $post_data = array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);   
	        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
       	
	}

	public static function senttofobo_departmentstatus($model){

		$subject_app = 'Your Service Application Status';
		$subject = 'Application assigned for Verification and Approval/Rejection';
		$details_app = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
        $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         
        $to_app = $details_app['email'];
		$app_name = $details_app['full_name'];

		

		if($model->application_status=='H'){
			$reson = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id=$model->submission_id AND action_status='H' AND form_id=2 order by id desc")->queryRow();
			self::sendmailfor_H($subject_app,$ser_name,$to_app,$app_name,$model,$reson);
		}else{
			if($model->application_status=='FA'){
				self::sendmailfor_FA($subject,$ser_name,$model);
			}else{
				if($model->application_status=='A'){
					self::sendmailfor_A($subject_app,$ser_name,$to_app,$app_name,$model);
				}else{
					if($model->application_status=='R'){
						$reson = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id=$model->submission_id AND action_status='R' order by id desc")->queryRow();
						self::sendmailfor_R($subject_app,$ser_name,$to_app,$app_name,$model,$reson);
					}else{
						
					}
				}
			}
		}
	} 

	public static function sendmailfor_H($subject_app,$ser_name,$to_app,$app_name,$model,$reson){
		$re = nl2br(stripcslashes(stripcslashes(stripcslashes(stripcslashes($reson['department_comment'])))));
	
		$content_app = "<strong>Dear $app_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>Your application with <b>$model->submission_id</b> has been reverted for <b>$re</b>. Request you to please correct the details and re-submit the application.  <br><br>
		Note: This is a system generated message. Please do not reply. This is a system generated message. Please do not reply. For any queries contact CAIPO. 
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content_app, ENT_QUOTES, 'UTF-8' ));

		$post_data_app= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject_app,'to'=>$to_app,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data_app);     
	}

	public static function sendmailfor_FA($subject,$ser_name,$model){
		$date = date('d-m-Y');	
		$details = Yii::app()->db->createCommand("SELECT CONCAT(u.full_name,' ',u.middle_name,' ',u.last_name) as full_name, u.email FROM tbl_user_service_role as us INNER JOIN bo_user u ON u.uid=us.user_id WHERE CONCAT(us.service_id,'.0')='".$model->service_id."' AND us.role_id = 84 AND us.is_active='Y'")->queryAll();
		if($details){
				foreach ($details as $key => $value) {
		       		 $to = array($value['email']);
					 $user_name = array($value['full_name']);
				}
			}else{
				 $to = 'caipodummy@gmail.com';
			}		


	
			 $content = "<strong>Dear CAIPO-Approver</strong>,<br><br>Please log in to CAIPO portal to review and accept/reject the assigned application for ".$ser_name['core_service_name']." SRN ($model->submission_id).  Please respond by $date.<br><br>
			 Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
			 helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
			<br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);  
	        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
			
	}

	public static function sendmailfor_A($subject_app,$ser_name,$to_app,$app_name,$model){
		$content_app = "<strong>Dear $app_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>Your application with <b>$model->submission_id</b> has been accepted and approved. Please contact the <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>helpdesk</a> if there is any discrepancy. <br><br>
		Please note, if you registered as an External Entity or Limited Liability Partnership, please appoint a CTSP within 28 days of incorporation.<br><br>
		Helpful Tips:<br>
		Registering with BRA<br>
		All entities must register with the Barbados Revenue Authority. <a href='https://tamis.bra.gov.bb/Home' title=''>Click here</a> to register.<br><br>
		Registering with NIS<br>
		All employers and self-employed persons must register with the National Insurance Scheme. <a href='https://www.nis.gov.bb/' title=''>Click here</a>  to learn more.<br><br>
		Filing Annual Returns with CAIPO<br>
		All companies must file annual returns with CAIPO every year. Your filing date is based on the date the company was incorporated. To learn more about annual returns, <a href='https://caipo.gov.bb/corporate-affairs/post-incorporation-forms-companies/#show' title=''> Click here</a><br><br>
		Maintaining beneficial ownership information<br>
		All companies must keep information on the person who owns or controls the company at their registered office. This is called beneficial ownership information. To learn more about this, download the <a href=' https://caipo.gov.bb/document/documents/page/3/' title=''> beneficial ownership guidelines</a><br><br>
		Other information<br>
		For more useful information, such as annual filings and company obligations, please <a href='".EMAIL_WEB_URL."/legislation/' title=''> visit</a><br><br>

		Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content_app, ENT_QUOTES, 'UTF-8' ));

		$post_data_app= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject_app,'to'=>$to_app,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data_app); 
	}

	public static function sendmailfor_R($subject_app,$ser_name,$to_app,$app_name,$model,$reson){
		$re = nl2br(stripcslashes(stripcslashes(stripcslashes(stripcslashes($reson['department_comment'])))));
		$content_app = "<strong>Dear $app_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>Your application with <b>".$model->submission_id." </b>for ".$ser_name['core_service_name']." has been rejected due to <b>$re</b>. Please contact the helpdesk in case of any discrepancy. <br><br>
		Note: This is a system generated message. Please do not reply. For any queries contact CAIPO.  
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content_app, ENT_QUOTES, 'UTF-8' ));

		$post_data_app= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject_app,'to'=>$to_app,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data_app);

      
	}
    public static function payment_successfull($model,$tno,$fee,$processId){
		$date = date('d-m-Y');	
        $subject = 'Your payment has successfully completed';
       
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         $to = $details['email'];
		 $user_name = $details['full_name'];

        $content = "<strong>Dear $user_name</strong>,<br><br>Your transaction has been completed successfully. Payment of $fee against SRN: $processId and transaction no. $tno is confirmed.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries contact CAIPO.  
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";


		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}
	public static function payment_failed($model,$tno,$fee,$processId){
		$date = date('d-m-Y');	
        $subject = 'Your payment has failed';
       
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         $to = $details['email'];
		 $user_name = $details['full_name'];
        $content = "<strong>Dear $user_name</strong>,<br><br>Your transaction of $ $fee against SRN: $processId and transaction no. $tno has been failed. Please try again.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries contact CAIPO. 
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	 public static function payment_pending($model,$tno,$fee,$processId){
		$date = date('d-m-Y');	
        $subject = 'Your payment is pending';
       
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();
         $to = $details['email'];
		 $user_name = $details['full_name'];

        $content = "<strong>Dear $user_name</strong>,<br><br>Your Payment of $ $fee against SRN: $processId and Receipt Number. $tno is pending.<br><br>
        Please submit your payment at the counter.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries contact CAIPO.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	public static function senttofo_namewithdrwal($model){
			$date = date('d-m-Y');	
        $subject = 'Company Name Withdrawal';
       
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         $draft_url = EMAIL_WEB_URL.$model->reverted_call_back_url;
         $to = $details['email'];
		 $user_name = $details['full_name'];

        $content = "<strong>Dear $user_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>Your request for withdrawal of Reserved name has been submitted successfully and the name has been withdrawn.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

		$message = stripslashes(html_entity_decode($content, ENT_QUOTES, 'UTF-8' ));	

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$to,'content'=>$message,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
	}

	public static function senttofobo_revokenotice($model){
		/*$subject = 'Notice for Revocation';
        $date = date('d-m-Y');
        $details = Yii::app()->db->createCommand("SELECT u.email,u.iuid, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name 
					from sso_users u 
				INNER JOIN sso_profiles p ON p.user_id=u.user_id
				where u.user_id=".$model->user_id)->queryRow();
         $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	
         
         $to = $details['email'];
		 $user_name = $details['full_name'];






        $content = "<strong>Dear $user_name</strong>,<br><br>Thank you for your interest in ".$ser_name['core_service_name']." SRN ($model->submission_id). <br><br>You have successfully completed your application. Your application is now pending for approval.  A representative will take the required action as soon as possible.<br><br>
		Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";

        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);       
        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);

        // email send to BO verifier users

        $subject = 'Application assigned for Verification and Approval/Rejection';       
        
        $ser_name =  Yii::app()->db->createCommand("SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model->service_id."' AND is_active='Y'")->queryRow();	

       	$details = Yii::app()->db->createCommand("SELECT CONCAT(u.full_name,' ',u.middle_name,' ',u.last_name) as full_name, u.email FROM tbl_user_service_role as us INNER JOIN bo_user u ON u.uid=us.user_id WHERE CONCAT(us.service_id,'.0')='".$model->service_id."' AND us.role_id = 83 AND us.is_active='Y'")->queryAll();

       if($details){
				foreach ($details as $key => $value) {
		       		 $to = array($value['email']);
					 $user_name = array($value['full_name']);
				}
			}else{
				 $to = 'caipodummy@gmail.com';
			}	
	        $content = "<strong>Dear CAIPO-Verifier</strong>,<br><br>Please log in to CAIPO portal to review the assigned application for ".$ser_name['core_service_name']." SRN ($model->submission_id). Please take necessary action by $date.<br><br>
			Note: This is a system generated message. Please do not reply. For any queries please use our <a href='".EMAIL_WEB_URL."/backoffice/queries/default/index/tq' title='Helpdesk'>
				helpdesk feature</a> or contact CAIPO at <a href='javascript:void(0);' title=''>caipo.helpdesk@barbados.gov.bb</a> or (246) 535-2410.
			<br><br>
			Regards,<br>
			Corporate Affairs and Intellectual Property Office<br>
			Ground Floor, BAOBAB Tower, Warrens<br>
			St. Michael, Barbados<br>
			Tel: (246) 535-2401 Fax: (246) 535-2444<br>
			<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
			Email: <a href='javascript:void(0);' title='Email'>caipo.general@barbados.gov.bb</a>";
	        $post_data = array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);   
	        $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);*/
       	
	}


		
}
?>