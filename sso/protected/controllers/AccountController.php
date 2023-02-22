<?php

class AccountController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	/*function is used to activate the account of the user
	* Author : Hemant Thakur
	* @Params: None
	* @return
	*/
	public function actionActivateAccount(){
		$activation_code = $_GET[activation_code];
		$uiuid = $_GET[uiuid];
		$email = $_GET[email];
		
		extract($_GET);
		if(isset($activation_code) && !empty($activation_code) && isset($uiuid) && !empty($uiuid)  && isset($email) && !empty($email)){
			$users =  Yii::app()->db->createCommand("SELECT * FROM sso_users u WHERE u.iuid =$uiuid and u.email= '".$email."' and u.activation_code='".$activation_code."' and  u.is_account_active='N'")->queryRow();        
			
			if(!empty($users)){
				$usermodal = Users::model()->findByPk($users['user_id']);
				$usermodal->is_account_active='Y';
				$usermodal->activation_code=null;
				if($usermodal->save()){
					Yii::app()->user->setFlash('success', "Your account activated successfully! Now you can login.");
					$url = Yii::app()->createAbsoluteUrl('account/signin')."?account=access";
					$this->redirect($url);
				}
				else{
					throw new CHttpException(404,'The requested page does not exist.');
				}
			}
			else{
				//echo 'Your acount already verified.';
				Yii::app()->user->setFlash('success', "This account is already verified.");
					$url = Yii::app()->createAbsoluteUrl('account/signin')."?email=$email";
					$this->redirect($url);
			}
		}
	}
	
	/*function is used to generate the password reset request
	* Author : Hemant Thakur
	* @Params: None
	* @return
	*/
	public function actionPasswordResetRequest(){
		if(isset($_POST['username'])){
			extract($_POST);
			$criteria = new CDbCriteria();
			$criteria->select='email,iuid,user_id,is_account_active';
			$criteria->condition = 'email=:username OR iuid=:iuid';
			$criteria->params = array(':username'=>$username, ':iuid'=>$username);
			$users = Users::model()->find($criteria);
			if(empty($users)){
				echo 'notfound';
			}
			$users = $users->attributes;
			if($users['is_account_active']==='N'){
				echo 'inactiveaccount';
			}
			
			$userModel=Users::model()->findByPk($users['user_id']);
			//print_r($users);die;
			if($userModel===null)
			{
				Yii::app()->user->setFlash('error', "Sorry!! Something went Wrong.Please use link that we have sent you on your email");
				
			}
			if(!empty($users) && $users['is_account_active']==='Y'){
				$reset_code=md5(time().$users['iuid']);
				$reset_time=date('Y-m-d H:i:s');
				$userModel->is_passwd_reset='Y';
				$userModel->passwd_reset_code=$reset_code;
				$userModel->passwd_reset_req_datetime=strtotime($reset_time);
				$userModel->passwd_reset_date=date('Y-m-d');
				$email=$_POST['username'];
				$userid = $users['user_id'];
				$profile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id = $userid")->queryRow();        
				$fname = $profile['first_name'];
				$mname = $profile['last_name'];
				$lname = $profile['surname'];
			
				$subject = 'Password Reset';
				$to=$email;
				$content ="<strong>Dear $fname $mname $lname </strong>,<br><br>
				We have sent you this email in response to your request to reset your password.<br><br>
				To reset your password for <a href='".EMAIL_WEB_URL."' title='Website'> CAIPO Portal</a>, please follow the link below: 
				
				<br><br>
				<a href='".EMAIL_WEB_URL."/sso/account/changePassword/reset_code/".$reset_code."/uiuid/".$users['iuid']."/rt/".strtotime($reset_time)."/email/".$users['email']."' title='Password Reset'> Password Reset Link</a>
				<br><br> 
				We recommend that you keep your password secure and not share it with anyone. If you feel your password has been compromised, you can change it by going to our Site My Account Page and clicking on the 'Change Email Address or Passowrd' link. This link is valid only for the 15 Min.
				<br><br>
				Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
				<br><br>
				Regards,<br>
				Corporate Affairs and Intellectual Property Office<br>
				Ground Floor, BAOBAB Tower, Warrens<br>
				St. Michael, Barbados<br>
				Tel: (246) 535-2401 Fax: (246) 535-2444<br>
				<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
				Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
				//$content ="Password Change request.<br> click on this <a href='".Yii::app()->createAbsoluteUrl('account/changePassword')."/reset_code/".$reset_code."/uiuid/".$users['iuid']."/rt/".strtotime($reset_time)."/email/".$users['email']."' title='change password'> link </a> to reset your password. This link is valid only for 15 Min.";
				
				$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
				'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
				$data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
									
				//if($mail->Send()){
					if($userModel->save(false)){
						echo 'success';
					}
				//}
				
			}
		}
		else{
			$this->render('passwordResetRequest');
		}
		

	}
	/*function is used to change the password
	* Author : Hemant Thakur
	* @Params: None
	* @return
	*/
	public function actionChangePassword(){
		$data=$_GET;
		
		if(isset($_POST['password1']) && isset($_POST['password2'])){
			
			extract($_POST);
			$criteria = new CDbCriteria();
			$criteria->select='user_id,passwd_reset_req_datetime';
			$criteria->condition = 'email=:email AND iuid=:iuid AND passwd_reset_code=:reset_code AND is_passwd_reset=:check_reset AND passwd_reset_req_datetime =:rt';
			$criteria->params = array(':email'=>$email, ':iuid'=>$uiuid, ':reset_code'=>$reset_code, ':check_reset'=>'Y', ':rt'=>$rt);
			$users = Users::model()->find($criteria);
			
			if(empty($users)){
				Yii::app()->user->setFlash('error', "Please use link that we have sent you on your email");
				$url = Yii::app()->createAbsoluteUrl('passwordResetRequest');
				$this->redirect($url);
				exit;
			}
			$now=strtotime(date('Y-m-d H:i:s'));
			$diff=$now-$rt;
			if($diff>900){
				Yii::app()->user->setFlash('error', "Sorry!! Your link has been expired.");
				$url = Yii::app()->createAbsoluteUrl('account/passwordresetrequest');
				$this->redirect($url);
				exit;
			}
			
			//create salt for the password
			$password1 = $_POST['password1'];
			$salt=md5($password1."_".time()."-".rand(111,9999999));
			$password=hash_hmac("sha1",$password1.$salt,PASSWORD_SECRET_KEY);
			$userModel=Users::model()->findByPk($users['user_id']);
			
			//save the new password and remove the reset code
			$userModel->salt=$salt; 
			$userModel->password=$password;
			$userModel->passwd_reset_code=null;
			$userModel->is_passwd_reset='N';
			$userModel->passwd_reset_date=date('Y-m-d');
			
			if($userModel->save(false)){
				Yii::app()->user->setFlash('success', "Success!! Your password has been changed.");
				$this->redirect('signin');
				exit;
			}
			else{
				Yii::app()->user->setFlash('error', "Sorry!! we are facing some problem to update your password. Please! Try again later");
				$url = Yii::app()->createAbsoluteUrl('passwordResetRequest');
				$this->redirect($url);
				exit;
			}
		}
		extract($_GET);
		if(isset($reset_code) && !empty($reset_code) && isset($uiuid) && !empty($uiuid) && isset($rt) && !empty($rt) && isset($email) && !empty($email)){
			$criteria = new CDbCriteria();
			$criteria->select='user_id';
			$criteria->condition = 'email=:email AND iuid=:iuid AND passwd_reset_code=:reset_code AND is_passwd_reset=:check_reset AND passwd_reset_req_datetime =:rt';
			$criteria->params = array(':email'=>$email, ':iuid'=>$uiuid, ':reset_code'=>$reset_code, ':check_reset'=>'Y', ':rt'=>$rt);
			$users = Users::model()->find($criteria);
			
			if(empty($users)){
				Yii::app()->user->setFlash('errors', "Sorry!! This link has been used or invalid.");
				$this->render('passwordResetPage',array('data'=>$data));
				exit;
			} 
			$this->render('passwordResetPage',array('data'=>$data));
		}
	}

	public function actionSignin(){
            session_regenerate_id();
		/*if(!isset($_POST['CALL_BACK_URL'])){
			$data=array();
			$msg=array("message"=>'Please Login VIA SSO.');
			$url = SWCS_URL.'/action/signin?' . http_build_query($msg, null, '&');
			header("Location: $url");
			exit;
		}*/
            if(!isset($_POST['SP_TAG'])){
            session_unset();
    session_destroy();
    session_regenerate_id(true);
            session_start();}
		if(isset($_POST['SP_TAG'])){
    		$SP_TAG=$_POST['SP_TAG'];
			$HMAC_HASH=$_POST['HMAC_HASH'];
			$CALL_BACK_URL=$_POST['CALL_BACK_URL'];
			$criteria=new CDbCriteria;
			$criteria->condition='service_provider_tag=:SP_TAG';
			$criteria->params=array(':SP_TAG'=>$SP_TAG);
			$SECRET=BoInfowizardIssuerbyMaster::model()->find($criteria);
			if(!empty($SECRET)){
				 $SECRET=$SECRET->secret_key;
				//$SECRET=$SECRET['secret_key'];
				$HMAC=hash_hmac('sha1', $CALL_BACK_URL, $SECRET);
			}
			else{
				$HMAC=$SECRET=NULL;
			}			
			if($_POST['HMAC_HASH']!=$HMAC){
				//throw new CHttpException(400,'ERROR: Fraudulent Data');
				//exit;
			}
    	}
    	
		if(isset($_POST['CALL_BACK_URL']) && isset($_POST['password2'])){
			$params=array();
			$params=$_POST;
			$params['token']=md5(time());
			//echo "==> <pre>"; print_r($params); exit;
			$this->render('redirect',$params);
			exit;
		}
        $data=array();
		extract($_POST);
		$data['users']=new Users();
		$data['profiles']=new Profiles();
		$data['CALL_BACK_URL']=$CALL_BACK_URL;
		$data['callback_failure_url']=$_POST['CALLBACK_FAILURE_URL'];
		$data['callback_success_url']=$_POST['CALLBACK_SUCCESS_URL'];
		/*  @Created: 10 April 2018
		@Author: Pankaj
		@Description: dept_id Hidden Field Added For Redirect To Ticket After Login */
		$data['dept_id']=(isset($_POST['dept_id']) && !empty($_POST['dept_id']))?$_POST['dept_id']:'';
		if(isset($_POST['SSO_MESSAGE'])){
			$data['SSO_MESSAGE']=$_POST['SSO_MESSAGE']; 
			$data['dept_id']=$_COOKIE['SSO_DEPT_ID']; 
		} 
		/*-------------------------------------------------------------*/
		//$this->render('login',$data);
		//$this->render('signin_old',$data);
		$this->render('signin',$data);
	}
	public function actionRegister(){ 
		$post=Utility::sanatizeParams($_POST);
		if(!isset($post['CALL_BACK_URL'])){
			$data=array();
			$msg=array("message"=>'');
			$url = SWCS_URL.'/action/register?' . http_build_query($msg, null, '&');
			header("Location: $url");
			exit;
		}
		if(isset($post['SP_TAG'])){

    		$SP_TAG=$post['SP_TAG'];
			$HMAC_HASH=$post['HMAC_HASH'];
			$CALL_BACK_URL=$post['CALL_BACK_URL'];
			
			$criteria=new CDbCriteria;
			$criteria->condition='service_provider_tag=:SP_TAG';
			$criteria->params=array(':SP_TAG'=>$SP_TAG);
			$SECRET=BoInfowizardIssuerbyMaster::model()->find($criteria); 
			$SECRET=$SECRET->attributes;
			if(!empty($SECRET)){
				$SECRET=$SECRET['secret_key'];
				$HMAC=hash_hmac('sha1', $CALL_BACK_URL, $SECRET);
			}
			else{
				$HMAC=$SECRET=NULL;
			}
			
			if($post['HMAC_HASH']!=$HMAC){
				//throw new CHttpException(400,'ERROR: Fraudulent Data');
				//exit;
			}
    	}
    	$data=array();
    	$countries=json_decode(Utility::getViaCurl(BO_API_BASEURL,'getcountrylist'));
		
    	if($countries->STATUS==200)
    		$data['countries']=$countries->COUNTRIES;
			
			
        $data['users']=new Users();
        $data['profiles']=new Profiles();
        $data['CALL_BACK_URL']=$post['CALL_BACK_URL'];
        if(isset($post['CALLBACK_FAILURE_URL']))
        	$data['callback_failure_url']=$post['CALLBACK_FAILURE_URL'];
        else
        	$data['callback_failure_url']=$post['callback_failure_url'];
        if(isset($post['CALLBACK_SUCCESS_URL']))
        	$data['callback_success_url']=$post['CALLBACK_SUCCESS_URL'];
        else
        	$data['callback_failure_url']=$post['callback_success_url'];

		print_r($data);die;  
		$this->render('registernew',$data);
       

	}
        
        public function actionRegisterNew(){
            print_r($_SERVER); die;
		$post=Utility::sanatizeParams($_POST);
		if(!isset($post['CALL_BACK_URL'])){
			$data=array();
			$msg=array("message"=>'Please Register VIA SWCS.');
			$url = SWCS_URL.'/action/register?' . http_build_query($msg, null, '&');
			header("Location: $url");
			exit;
		}
		if(isset($post['SP_TAG'])){

    		$SP_TAG=$post['SP_TAG'];
			$HMAC_HASH=$post['HMAC_HASH'];
			$CALL_BACK_URL=$post['CALL_BACK_URL'];
			
			$criteria=new CDbCriteria;
			$criteria->condition='service_provider_tag=:SP_TAG';
			$criteria->params=array(':SP_TAG'=>$SP_TAG);
			$SECRET=ServiceProviders::model()->find($criteria); 
			$SECRET=$SECRET->attributes;
			if(!empty($SECRET)){
				$SECRET=$SECRET['secret_key'];
				$HMAC=hash_hmac('sha1', $CALL_BACK_URL, $SECRET);
			}
			else{
				$HMAC=$SECRET=NULL;
			}
			
			if($post['HMAC_HASH']!=$HMAC){
				//throw new CHttpException(400,'ERROR: Fraudulent Data');
				//exit;
			}
    	}
    	$data=array();
    	$countries=json_decode(Utility::getViaCurl(BO_API_BASEURL,'getcountrylist'));
    	if($countries->STATUS==200)
    		$data['countries']=$countries->COUNTRIES;
        $data['users']=new Users();
        $data['profiles']=new Profiles();
        $data['CALL_BACK_URL']=$post['CALL_BACK_URL'];
        if(isset($post['CALLBACK_FAILURE_URL']))
        	$data['callback_failure_url']=$post['CALLBACK_FAILURE_URL'];
        else
        	$data['callback_failure_url']=$post['callback_failure_url'];
        if(isset($post['CALLBACK_SUCCESS_URL']))
        	$data['callback_success_url']=$post['CALLBACK_SUCCESS_URL'];
        else
        	$data['callback_failure_url']=$post['callback_success_url'];

		$this->render('registernew',$data);

	}
	public function actionCheckExistEmail(){
		if(isset($_POST['email'])){	
			extract($_POST);
			if(!Utility::checkEmailID($email)){
				echo "AEEA";
				exit; 
	
			}
			else{
				echo "NEEA";
				exit;

			}

		}
	}
	public function actionSendotp(){
		$fname =  $_POST['fname'];
		$mname =  $_POST['mname'];
		$lname =  $_POST['lname'];
		$email =  $_POST['email'];
		$mobile = $_POST['mobile'];
		extract($_POST);
		if(empty($mobile)){
			echo "Error";
			return;
		}
		// if(!Utility::checkEmailID($email)){
				// echo "AEEA";
				// exit; 
		// }

		$uuid=mt_rand(10000000, 99999999);
		$otp=rand(1000,9999);
		//$hmac=hash_hmac("sha1",$mobile.$email,OTP_SECRET_KEY);
		//$data=array("mobile"=>$mobile,'email'=>$email,'msg'=>"Your verification code is $otp",'hmac'=>$hmac,'uuid'=>$uuid);		
		$data=array("mobile"=>$mobile,'email'=>$email,'msg'=>"Your verification code is $otp");		
		
		//$OTP=json_decode(Utility::getViaCurl(BO_API_BASEURL,'sendMobMsg',$data));
		//if($OTP->STATUS==200){
			$model= new ManageOtp;
			$model->created_date=date( 'Y-m-d H:i:s');
			$model->mobile_number=$mobile;
			$model->iuuid=mt_rand(10000000, 99999999);
			//$model->email=$email;
			$model->otp=$otp;
			//Check how many times of otp fire maximum time otp send
        $tody_date = Date(date('Y-m-d'));
        $maxOtpsend = 10;
        $getData =  Yii::app()->db->createCommand("SELECT * FROM sso_manage_otp mo WHERE mo.mobile_number =$mobile and  Date(mo.created_date) >=$tody_date ")->queryAll();        
		$totalOtpcount = count($getData);
		// if ($totalOtpcount >= $maxOtpsend) {

            // echo "Max count reached";
    		// return;
        // }
		// else{
			$model->save();			
			if($model->save()){				
				$subject = 'OTP for Registration';
				$to=$email;
				$content = "<strong>Dear $fname $mname $lname </strong>,<br>
							Your One Time Password (OTP) is <strong>$otp</strong> for registration.<br><br>  
							This OTP is valid for 5 minutes.<br><br>
							Note: This is a system generated
							message. Please do not reply. For
							any queries reach out to CAIPO.
							<br><br>
							Regards,<br>
							Corporate Affairs and Intellectual Property Office<br>
							Ground Floor, BAOBAB Tower, Warrens<br>
							St. Michael, Barbados<br>
							Tel: (246) 535-2401 Fax: (246) 535-2444<br>
							<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
							Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
				$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
				'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
				$data = DefaultUtility::post_to_url(EMAIL_API,$post_data); 
				echo 'success';
				return;
			}
			else{
				echo "error";
				return;
			} 
		//}
		
	}


	public function actionVerifyotp(){
		$mobile = $_POST['mobile'];
		$otp = $_POST['otp'];
		$model= new ManageOtp;
        if ($otp == "" || $mobile == "") {
          
            $array = ['status' => 'F', 'statusCode' => '201', 'message' => 'Invalid OTP', 'pd' => array()];
            return $this->asJson($array);
        }
      
        $data =  Yii::app()->db->createCommand("SELECT * FROM sso_manage_otp mo WHERE mo.mobile_number =$mobile order by created_date DESC ")->queryRow();        
		if (!empty($data)) {

            $expOtptime = 4;
			$otpDatetime = $data['created_date'];
			
            $otp_time     = new DateTime(date('Y-m-d H:i:s', strtotime($otpDatetime)));
            $current_time  = new DateTime(date('Y-m-d H:i:s'));
            $interval = $otp_time->diff($current_time);
            $time = $interval->format('%I');

            //otp expire time 
            if ($time <= $expOtptime) {

                if ($data['otp'] == $otp) {
					echo "SUCCESS";
					return;
                } else {
					echo "Not Success";
    			return;
				}
            } else {
				echo "otp expired";
				return;
			}
		}
	}


	public function actionSavedetail(){
			$password1 = $_POST['Users']['password'];
			$password2 = $_POST['confirm_password'];
			if($password1<>$password2){
				 echo "Password and confirm password not match";
		  			exit;
			}
			if(empty($password1)){
				echo "Error: Password cannot be blank";
		  		exit;
			}
			$uuid=mt_rand(10000000, 99999999);
			$userModel= new Users;
			$profiles= new Profiles;
			$userModel->attributes = $_POST['Users'];
			$userModel->mobile_no = $_POST['Users']['mobile_no'];			
			$profiles->attributes = $_POST['Profile'];
			$profiles->gender = $_POST['Profile']['gender'];
			$profiles->date_of_birth = $_POST['Profile']['dob'];
			$profiles->country_code = $_POST['Profile']['country_code'];
			$profiles->address2 = $_POST['Profile']['address2'];
			$profiles->telephone = $_POST['Profile']['telephone'];
			$profiles->surname = $_POST['Profile']['surname'];
			$profiles->nationality = $_POST['Profile']['nationality'];
			$userModel->iuid=$uuid;
			$salt=md5($password1."_".time()."-".rand(111,9999999));
			$userModel->salt=$salt; 
			$userModel->password=hash_hmac("sha1",$password1.$salt,PASSWORD_SECRET_KEY);
			$actv_code=md5(time().$uuid.$email);
			$userModel->activation_code=$actv_code;
			$userModel->is_account_active='N';
			$userModel->created_on=date( 'Y-m-d H:i:s');
			if($_POST['Users']['user_type']==2 && $_POST['Users']['user_sp_type']=='Sub User'){
				$userModel->user_type = 3;
			}else{
				$userModel->user_type = $_POST['Users']['user_type'];
			}
			
			$userModel->sp_type = $_POST['Users']['user_sp_type'];
			$userModel->lic_no = $_POST['lic_no'];
			$userModel->entity_name = $_POST['entity_name'];
			$userModel->entity_type = $_POST['entity_type'];
			$email = $_POST['Users']['email'];
			$reset_time=date('Y-m-d H:i:s');
			$fname = $_POST[Profile][first_name];
			$mname = $_POST[Profile][last_name];
			$lname = $_POST[Profile][surname];
			$full_name = $fname.' '.$mname.' '.$lname;
			
			$transaction = $userModel->dbConnection->beginTransaction();
				try{		
					if($userModel->save()) {
						$lid = Yii::app()->db->getLastInsertID();
						if(!empty($lid)){
							$profiles->user_id=$userModel->user_id;
							$profiles->mobile_number = $userModel->mobile_no;
							if($profiles->save()) {
								$subject = 'Registration Verification';
								$to=$_POST['Users']['email'];
								$content = "<strong>Dear $fname $mname $lname</strong>,<br><br>
								Your profile has been successfully registered in CAIPO Portal. You are allotted Applicant ID <strong>$uuid</strong>.<br>
								Your user Id is <strong> $email </strong>. <br><br>
								Please click on the following link to access the CAIPO Portal:<br><br>
								<a href='".EMAIL_WEB_URL."/sso/account/activateAccount/activation_code/".$actv_code."/uiuid/".$uuid."/email/".$email."' title='Activate Account'> Account Activation Link</a>
								<br><br>
								Note: This is a system generated
								message. Please do not reply. For
								any queries reach out to CAIPO.
								<br><br>
								Regards,<br>
								Corporate Affairs and Intellectual Property Office<br>
								Ground Floor, BAOBAB Tower, Warrens<br>
								St. Michael, Barbados<br>
								Tel: (246) 535-2401 Fax: (246) 535-2444<br>
								<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
								Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
								$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
								'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
			
								$data = DefaultUtility::post_to_url(EMAIL_API,$post_data);  
								echo "register-success";
							} 
							//print_r($profiles->geterrors());							
						}						
					} 
					//print_r($userModel->geterrors());	
					$transaction->commit();
								
				} catch(Exception $e){
					$transaction->rollBack();
				} 
                    
		
	}

	public function actionRegistration(){
		$this->render('registration_form'); 
	}
	/**
	*@author hemant thakur
	*/
	public function  actionSuccessfullyRegister(){
		if(isset($_POST['mobile']))
			$this->render('successfullyRegister',array("name"=>$_POST['full_name']));
		else{
			echo "Invalid";
			die;
		}

	}
	public function actionRegredirect(){
		$params=array();
		$params['token']=md5(time());
		$params['Profiles']=array('full_name'=>$_POST['profile']['full_name'],'mobile_number'=>$_POST['profile']['mobile']);
		$params['Users']=array('email'=>$_POST['profile']['email']);
		$_POST['profile']['mobile'];
		$this->render('redirect',$params);
		exit;
	}
	public function actionValidateEmail(){
		extract($_POST);
		$status=Utility::checkEmailID($email);
		if($status)
			echo "NA";
		else 
			echo "EXIST";
	return;
	}
	public function actionValidate(){
		extract($_POST);
		session_destroy();
		
		if(isset($_POST['passwd'],$_POST['CALL_BACK_URL']) && !empty($_POST['CALL_BACK_URL'])){
			$password="";
			$user_id=$token=$salt=NULL;
			$session=new CHttpSession;
  			$session->open();
			$password2=0;
			$criteria = new CDbCriteria();
			if($uty==1){
				$criteria->condition = 'user_type=:uty AND is_account_active=:iaa AND (email=:username OR iuid=:iuid)';
				$criteria->params = array(':username'=>$username, ':iuid'=>$username,':uty'=>$uty, ':iaa'=>'Y');
			}else{
				$criteria->condition = 'is_account_active=:iaa AND (email=:username OR iuid=:iuid) AND user_type IN (:uty, :uty3) ';
				$criteria->params = array(':username'=>$username, ':iuid'=>$username,':uty'=>$uty,':uty3'=>3, ':iaa'=>'Y');
			}
			
			
			$users = Users::model()->find($criteria);
		
			$data=array();
			if(!empty($users)){
			$users = $users->attributes;
				//print_r($users['user_type']);die;
			if(isset($users['salt']) && !empty($users['salt'])){
				$salt = $users['salt'];
				$user_id = $users['user_id'];
				$password2 = $users['password'];
				$passwd=hash_hmac("sha1",$passwd.$salt,PASSWORD_SECRET_KEY);
			}

			if($users['is_account_active']==='N'){
				$msg=array("message"=>'Please! Activate your account first.');
				$url = SWCS_URL.'?' . http_build_query($msg, null, '&');
				header("Location: $url");
				exit;
			}
			if($passwd === $password2){
				//Create Token
				$token=md5($user_id."_".time()."-".rand(1,999999));
				$token_created_on=date( 'Y-m-d H:i:s');
				//callback_url	callback_failure_url	callback_success_url
				$criteria = new CDbCriteria();
				$criteria->condition = 'user_id=:user_id
										AND callback_url=:CALL_BACK_URL 
										AND callback_failure_url=:callback_failure_url 
										AND callback_success_url=:callback_success_url ';
										/*AND callback_url=:CALL_BACK_URL'; */
				$criteria->params = array(':user_id'=>$user_id,
											':CALL_BACK_URL'=>$CALL_BACK_URL, 
											':callback_failure_url'=>$callback_failure_url,
											':callback_success_url'=>$callback_success_url);
										  /*':CALL_BACK_URL'=>$CALL_BACK_URL);*/
				$ActiveTokens=ActiveTokens::model()->findAll($criteria);
				foreach ($ActiveTokens as $AT) {
					$AT=$AT->attributes;
					$token_id=$AT['token_id'];
					
					$_ActiveTokens=ActiveTokens::model()->findByPk($token_id); // assuming there is a post whose ID is 10
					$_ActiveTokens->delete();
				}
				$sso_active_tokens=new ActiveTokens;
				$sso_active_tokens->user_id=$user_id;
				$sso_active_tokens->callback_url=$CALL_BACK_URL;
				$sso_active_tokens->callback_failure_url=$callback_failure_url;
				$sso_active_tokens->callback_success_url=$callback_success_url;
				$sso_active_tokens->token_created_on=$token_created_on;
				$sso_active_tokens->user_id=$user_id;				
				$sso_active_tokens->token=$token;				
				$sso_active_tokens->save();
				$session['sso_token']=$token;
				$data=array();
				$data['CALL_BACK_URL']=$CALL_BACK_URL;
				$data['callback_failure_url']=$callback_failure_url;
				$data['callback_success_url']=$callback_success_url;
				$data['token']=$token;
				$data['status_code']="200";
				$data['message']="SUCCESS";
				$data['href']=$href=API_BASEURL."/apiv1/gettokeninfo/token/".$token;
				$data['logintype']= $users['user_type'];
				setcookie("SSO_TOKEN", $token, time()+3600, "/");
				setcookie("SSO_HREF", $href, time()+3600, "/");
				
				/*
				   @Created:11April2018
				   @Author:Pankaj
				   @Refering to Ticket 

				*/            


				  if(isset($dept_id) && !empty($dept_id)){
					  $data['dept_id']=$dept_id;
				  }   
				  if(isset($user_id))
				  {
					$_SESSION['code'] ='demo';
				  }
				 // print_r($data);die;
					/*----------------------------------------------*/
				$this->renderPartial('redirect',$data);
				exit;
			}
			else{
				/*
				   @Created:11April2018
				   @Author:Pankaj
				   @Set COOKIE if password not matched

				*/

				 $data['message']="Invalid Password.";  
				 $data['dept_id']=$dept_id;
				 setcookie("SSO_DEPT_ID", $dept_id, time()+1800, "/");
				 
				 /*----------------------------------------------*/
			}

			}
			else{

				
    
				 $data['message']="This Email address does not exist for the selected option.";
				 
				 /*
					@Created:11April2018
					@Author:Pankaj
					@Set COOKIE if IUID/email address does not exist 
					
				 */
				
					$data['dept_id']=$dept_id;
					setcookie("SSO_DEPT_ID", $dept_id, time()+1800, "/");
				
				/*----------------------------------------------*/
				
				
			   }
			$session->destroy();
			$callback_url=$callback_failure_url=$callback_success_url=API_BASEURL."/account/signin";
			$data['login_url']=$callback_url;
			$data['CALLBACK_URL']=$_POST['CALL_BACK_URL'];
			$data['CALLBACK_FAILURE_URL']=$_POST['callback_failure_url'];
			$data['CALLBACK_SUCCESS_URL']=$_POST['callback_success_url'];
			/*
			  @Created:11April2018
			  @Author:Pankaj
			  @If Password or Username is incorrect 
			  
		   */ 
		   
			  $data['dept_id']=$dept_id;
		  
			  /*----------------------------------------------*/
			$data['status_code']="401";
			
			$this->renderPartial('error',$data);
			exit;
		}
		$red="http://".$_SERVER['HTTP_HOST']."/panchayatiraj/SWCS/cdn";
		
		
		$this->redirect($red);		
	}
	
	public function actionGetstates(){	
		Yii::app()->request->enableCsrfValidation = false;
		$states = "<option value='' selected disabled>Please Select </options>";
        $countryCode = $_POST['country'];
		$all =  Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.parent_id=$countryCode and lr.lr_type='state' and  lr.is_lr_active='Y' ORDER BY lr.lr_name ASC")->queryAll();        
        foreach ($all as $k => $v) {
            $states = "$states<option value='$v[lr_id]'>$v[lr_name]</options>";
        }
        echo "$states";
		
	}
	
	public function actionCheckExistMobile(){
		//print_r($_POST);die;
		if(isset($_POST['mobile'])){	
			$mobile = $_POST['mobile'];
			$mobileStatus =  Yii::app()->db->createCommand("SELECT * FROM sso_users u WHERE u.is_account_active='Y' AND u.mobile_no= $mobile")->queryRow();        
			if($mobileStatus)
			echo "exist";
				exit; 
	
			}
			else{
				echo "not found";
				exit;

			}

		}
	


/*function is used to generate the account activation link
	* Author : 
	* @Params: None
	* @return
	*/
	public function actionAccountActivationLink(){
		if(isset($_POST['username'])){
			extract($_POST);
			$email = $_POST['username'];
			$users =  Yii::app()->db->createCommand("SELECT * FROM sso_users u WHERE u.is_account_active='Y' AND u.email= '".$email."' ")->queryRow();        
			//print_r($users);die;
			if(empty($users)){
				echo 'notfound';
			}
			
			if(!empty($users) && $users['is_account_active']!='N' && $users['activation_code']==""){
				echo 'already activated';
			}
			
			if(!empty($users) && $users['is_account_active']=='N' && $users['activation_code']!=""){
				
				//print_r($users);die;
				$uid = $users['iuid'];
				$user_id=$users['user_id'];
				$email = $users['email'];
				$profile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id = '$user_id'")->queryRow();        
				$fname = $profile['first_name'];
				$mname = $profile['last_name'];
				$lname = $profile['surname'];
				$actv_code = $users['activation_code'];
				
				$subject = 'Account Activation Link';
				$to=$_POST['username'];
				$content = "<strong>Dear $fname $mname $lname</strong>,<br><br>
								Your profile has been successfully registered in CAIPO Portal. Your registered Application ID is <strong>$uid</strong>.<br>
								and Login Id is <strong> $email</strong>. <br><br>
								Please click on the following link to access the CAIPO Portal:<br><br>
								<a href='".EMAIL_WEB_URL."/sso/account/activateAccount/activation_code/".$actv_code."/uiuid/".$uid."/email/".$email."' title='Activate Account'> Account Activation Link</a>
								<br><br>
								Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
								<br><br>
								Regards,<br>
								Corporate Affairs and Intellectual Property Office<br>
								Ground Floor, BAOBAB Tower, Warrens<br>
								St. Michael, Barbados<br>
								Tel: (246) 535-2401 Fax: (246) 535-2444<br>
								<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
								Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
				$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
								   'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
				
				$data = DefaultUtility::post_to_url(EMAIL_API,$post_data);  
				echo 'success';
			}
		}
		else{
			$this->render('accountActivationLink');
		}
		

	}

	public function actionUpdoc(){
		header('Content-Type: application/json'); 
		if(isset($_FILES['file'])) {
			$targetDir = '/var/www/html/backoffice/protected/uploads';			
			    if (!file_exists($targetDir)) {
			        @mkdir($targetDir);			      
			    }
			$targetDir = '/var/www/html/backoffice/protected/uploads/agentdoc';			
			    if (!file_exists($targetDir)) {
			        @mkdir($targetDir);			      
			    }

			   $targetDir = '/var/www/html/backoffice/protected/uploads/agentdoc/'.$_POST['user_email'];			
			    if (!file_exists($targetDir)) {
			        @mkdir($targetDir);			      
			    }

			    
			    $info = pathinfo($_FILES['file']['name']);
				$ext = $info['extension']; // get the extension of the file
				$newname = "doc.".$ext; 
			    $targetFile = $targetDir.'/'.$newname;


			      if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		        	/*$file_path = '/backoffice/protected/uploads/tickets/'.$fileId;
		        	Yii::app()->db->createCommand('INSERT INTO supportmsgfiles_temp (user_id, file_path) VALUES ("'.$user_id.'", "'.$file_path.'")')->execute();*/
		        	$previewpath = '/backoffice/protected/uploads/agentdoc/'.$_POST['user_email'].'/'.$newname;
		             echo json_encode(array('status'=>true,'file_url'=> $previewpath));
		        } else {
		            echo json_encode(array('status'=>false));
		        }
			
		}		
	}
	
	public function actiontest() {
		$date = date('y-m-d h:i:s');
		// echo $date;
		// die;
        $subject = 'Test';
        $to = 'rider.amir456@gmail.com';
        $fname = "Aamir";
		$lname = "Rider";
        echo $content ="<strong>Dear $fname $mname $lname </strong>,<br><br>
		We have sent you this email n response to your request to test.<br><br>
		To test your mail for <a href='".EMAIL_WEB_URL."' title='Website'> link </a>.
		
		<br><br>
		Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
		<br><br>
		Regards,<br>
		Corporate Affairs and Intellectual Property Office<br>
		Ground Floor, BAOBAB Tower, Warrens<br>
		St. Michael, Barbados<br>
		Tel: (246) 535-2401 Fax: (246) 535-2444<br>
		<a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
		Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";
        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                          'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
        
       $data = DefaultUtility::post_to_url(EMAIL_API,$post_data);   
		
    }
	
	

	}