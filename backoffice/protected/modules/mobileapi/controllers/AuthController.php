<?php

class AuthController extends Controller {

	
	
    public function actionIndex() {
    	$userID = 1;   	
    	$token = Token::gettoken($userID);
        echo json_encode(['status'=>true,'msg'=>'Success','token'=>$token]);
    }

    public function actionEmailvalidation() {
        $data = json_decode(file_get_contents('php://input'), true);
		if(isset($data['email']) ){
    	 	$email = $data['email'];
    	 	if($email){
    	 		$user = Yii::app()->db->createCommand("SELECT * FROM sso_users WHERE is_account_active='Y' AND  email='".$email."'")->queryRow(); 
    	 			if($user){    	 				
						echo json_encode(['status'=>false,'msg'=>'user already exist. Please use another email Id']);						
    	 			}else{
    	 				echo json_encode(['status'=>true,'msg'=>'Email not found']);
    	 			}
    	 		}else{
    	 			echo json_encode(['status'=>false,'msg'=>'Email cannot be blank']);
    	 		}
    	 	
    	}else{
    	 	echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    	}
	}

/*
* This action provides nationality or country data for API
*/
	public function actionGetcountry() {
        $data = json_decode(file_get_contents('php://input'), true);
		
 		$country =  Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='country' and  lr.is_lr_active='Y' ORDER BY lr.lr_name ASC")->queryAll();  
	
		if($country){
			
			echo json_encode(['status'=>true,'msg'=>'success','country'=>$country]);
			
		}else{
			echo json_encode(['status'=>false,'msg'=>'country not found']);
		}	
	}



	public function actionGetstates() {
        $data = json_decode(file_get_contents('php://input'), true);
		if(isset($data['country']) ){
    	 	$countryCode = $data['country'];
			//print_r($countryCode);die;
    	 	if($countryCode){
    	 		$states =  Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.parent_id=$countryCode and lr.lr_type='state' and  lr.is_lr_active='Y' ORDER BY lr.lr_name ASC")->queryAll();  
			
				if($states){
					
					echo json_encode(['status'=>true,'msg'=>'success','statename'=>$states]);
					
				}else{
					echo json_encode(['status'=>false,'msg'=>'state not found']);
				}
			}else{
				echo json_encode(['status'=>false,'msg'=>'Country code cannot be blank']);
			}
		
    	}else{
    	 	echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    	}
		
	}

/*
* This action is not for only send OTP this action API call when user entered there registration detail
*/
	public function actionSendotp() {
		
        $data = json_decode(file_get_contents('php://input'), true);
       
		if(isset($data['fname']) && isset($data['mname'])&& isset($data['lname']) && isset($data['email']) && isset($data['mobile']) && isset($data['gender']) && isset($data['dob']) && isset($data['password']) && isset($data['confirm_password']) && isset($data['address']) && isset($data['nationality']) && isset($data['country']) && isset($data['state_parish']) && isset($data['user_type'])){
			

			$fname =  $data['fname'];
			$mname =  $data['mname'];
			$lname =  $data['lname'];			
			$mobile = $data['mobile'];			
			$email =  $data['email'];
			
    	 	
					
			if($mobile && $email){	
				$email_exist = Yii::app()->db->createCommand("SELECT * FROM sso_users WHERE is_account_active='Y' AND  email='".$email."'")->queryRow(); 
    	 			if($email_exist){    	 				
						echo json_encode(['status'=>false,'msg'=>'user already exist. Please use another email Id']);						
    	 			}else{
    	 				
						$otp=rand(1000,9999);
						
					
						$model= new ManageOtp;
						$model->created_date=date('Y-m-d H:i:s');
						$model->mobile_number=$mobile;
						$model->iuuid=mt_rand(10000000, 99999999);				
						$model->otp=$otp;			
						$tody_date = Date(date('Y-m-d'));
						$maxOtpsend = 10;
						$getData =  Yii::app()->db->createCommand("SELECT * FROM sso_manage_otp mo WHERE mo.mobile_number ='".$mobile."' and  Date(mo.created_date) >='".$tody_date."'")->queryAll();        
						$totalOtpcount = count($getData);
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

									$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
									DefaultUtility::post_to_url(EMAIL_API,$post_data); 					
									
									echo json_encode(['status'=>true,'msg'=>'OTP send on mail','email'=>$email,'sent_otp'=>$model->otp,'registration_data'=>$data]);	
		    	 			}else{
					echo json_encode(['status'=>false,'msg'=>'Something went wrong while generating OTP']);
				}	

				}		
			}else{
				echo json_encode(['status'=>false,'msg'=>'Mobile number & email cannot be blank']);
			}
    	}else{
    	 	echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    	}
		
}

public function actionVerifyotp(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		
	
		if(isset($data['fname']) && isset($data['mname'])&& isset($data['lname']) && isset($data['email']) && isset($data['mobile']) && isset($data['gender']) && isset($data['dob']) && isset($data['password']) && isset($data['confirm_password']) && isset($data['address']) && isset($data['nationality']) && isset($data['country']) && isset($data['state_parish']) && isset($data['user_type']) && isset($data['otp'])){

			$mobile = $data['mobile'];
			$otp = $data['otp'];
			
			$opt_data =  Yii::app()->db->createCommand("SELECT * FROM sso_manage_otp mo WHERE mo.mobile_number='".$mobile."' order by created_date DESC")->queryRow(); 
		
				$newDate = date('Y-m-d H:i:s', strtotime($opt_data['created_date']. ' +50 minutes'));  
    			$str1 = strtotime($newDate);
    			$str2 = strtotime(date('Y-m-d H:i:s'));

				if ($str1 >= $str2) {
					if ($opt_data['otp'] == $otp) {
						$password1 = $data['password'];
						$password2 = $data['confirm_password'];
						$fname = $data['fname'];
						$mname = $data['mname'];
						$lname = $data['lname'];		
						$email = $data['email'];
						$rep_type = isset($data['rep_type']) ? $data['rep_type'] : NULL;
        				$rep_com_bus_name = isset($data['rep_com_bus_name']) ? $data['rep_com_bus_name'] : NULL;
        				$licence_number = isset($data['licence_number']) ? $data['licence_number'] : NULL;

        				if($data['user_type']==2 && $rep_type=='Sub User'){
							$user_type = 3;
						}else{
							$user_type = $data['user_type'];
						}	

			
			$uuid=mt_rand(10000000, 99999999);
			$salt=md5($password1."_".time()."-".rand(111,9999999));
			$actv_code=md5(time().$uuid.$email);



			Yii::app()->db->createCommand("INSERT INTO sso_users (iuid, salt, password, mobile_no, email, activation_code, is_account_active, created_on, sp_type, lic_no, entity_name, user_type) VALUES ('".$uuid."', '".$salt."', '".hash_hmac("sha1",$password1.$salt,PASSWORD_SECRET_KEY)."', '".$data['mobile']."', '".$email."', '".$actv_code."', 'N', '".date( 'Y-m-d H:i:s')."', '".$rep_type."', '".$licence_number."', '".$rep_com_bus_name."', '".$user_type."')")->execute();


			$c_user = Yii::app()->db->createCommand("SELECT * FROM sso_users where email='".$email."' ORDER BY user_id DESC")->queryRow();

			$user_id = $c_user['user_id'];

			Yii::app()->db->createCommand("INSERT INTO sso_profiles (user_id, first_name, last_name, surname, gender, date_of_birth, mobile_number, country_name, state_name, city_name, pin_code, address, address2, telephone, nationality) VALUES ('".$user_id."', '".$fname."', '".$mname."', '".$lname."', '".$data['gender']."', '".$data['dob']."', '".$data['mobile']."', '".$data['country']."', '".$data['state_parish']."', '".(isset($data['city_name']) ? $data['city_name'] : NULL)."', '".(isset($data['pin_code']) ? $data['pin_code'] : NULL)."', '".$data['address']."', '".(isset($data['address2']) ? $data['address2'] : NULL)."', '".(isset($data['telephone']) ? $data['telephone'] : NULL)."', '".$data['nationality']."')")->execute();

								
						
								$subject = 'Registration Verification';
								$to=$data['email'];
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
			
								DefaultUtility::post_to_url(EMAIL_API,$post_data);  

								echo json_encode(['status'=>true,'msg'=>'Success! OTP verified & Activation link send on registered email ID']);	
												
											
						
										
					} else {
						echo json_encode(['status'=>false,'msg'=>'Invalid OTP']);
					}
				} else {
					echo json_encode(['status'=>false,'msg'=>'OTP Expire']);
				}
			
			
		}else{
			echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
		}
		
	}

	 public function actionLogin() {

    	/*if (!isset($_SERVER['PHP_AUTH_USER'])) {
		    header('WWW-Authenticate: Basic realm="My Realm"');
		    header('HTTP/1.0 401 Unauthorized');
		    echo 'Text to send if user hits Cancel button';
		    exit;
		} else {*/

		    // echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
		    // echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
		    $data = json_decode(file_get_contents('php://input'), true);
    	 if(isset($data['username']) && isset($data['password'])  && isset($data['usertype'])){
    	 	$username = $data['username'];
    	 	$password = $data['password'];
    	 	$usertype = $data['usertype'];  // 1 for individual 2 for service provider
    	 	if($username){
    	 		if($password){
    	 			if($usertype){
    	 				$user = Yii::app()->db->createCommand("SELECT * FROM sso_users WHERE is_account_active='Y' AND  email='".$username."'")->queryRow(); 
	    	 			if($user){
	    	 				$db_pass = $user['password'];
	    	 				$passwd=hash_hmac("sha1",$password.$user['salt'],'b99#3H?AQ7Zfsj');
	    	 				if($passwd===$db_pass){
	    	 					$user_otherdetails = Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id=".$user['user_id'])->queryRow(); 
	    						$token = Token::gettoken($user['user_id']);
	    						if($usertype==1){
	    							if($usertype==$user['user_type']){
									echo json_encode(['status'=>true,'msg'=>'success','token'=>$token,'userdetails'=>$user,'userotherdetails'=>$user_otherdetails]);
		    						}else{
		    							echo json_encode(['status'=>false,'msg'=>'Incorrect user or user type']);
		    						}
	    						}else{
	    							if($usertype==2 || $usertype==3){
									echo json_encode(['status'=>true,'msg'=>'success','token'=>$token,'userdetails'=>$user,'userotherdetails'=>$user_otherdetails]);
		    						}else{
		    							echo json_encode(['status'=>false,'msg'=>'Incorrect user or user type']);
		    						}
	    						}
	    							    	 					
	    	 				}else{
	    	 					echo json_encode(['status'=>false,'msg'=>'Incorrect password']);
	    	 				}
	    	 			}else{
	    	 				echo json_encode(['status'=>false,'msg'=>'User not found']);
	    	 			}
    	 			}else{
    	 				echo json_encode(['status'=>false,'msg'=>'User Type cannot be blank']);
    	 			}
    	 		}else{
    	 			echo json_encode(['status'=>false,'msg'=>'Password cannot be blank']);
    	 		}
    	 	}else{
    	 		echo json_encode(['status'=>false,'msg'=>'Username cannot be blank']);
    	 	}
    	 } else{
    	 	echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    	 } 	 
		//}
      
              
    }

    public function actionProfile(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/

                $data = Yii::app()->db->createCommand("SELECT * FROM sso_users where user_id=".$responce['user_id'])->queryRow();
                $userprofile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id =".$responce['user_id'])->queryRow();
                // do your work here

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'userdata'=>$data,'userprofile'=>$userprofile]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }
    }
	
	public function actionPasswordresetrequest(){
        $data = json_decode(file_get_contents('php://input'), true);
		
	        if(isset($data['email'])){   
				
				$user = Yii::app()->db->createCommand("SELECT * FROM sso_users where email='".$data['email']."'")->queryRow();
				if($user){
					if($user['is_account_active']=='N'){
						echo json_encode(['status'=>false,'msg'=>'This is inactive user']);
					}else{
							$reset_code=md5(time().$user['iuid']);
							$reset_time=date('Y-m-d H:i:s');				

					$profile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id =".$user['user_id'])->queryRow();  
					if($profile){
						Yii::app()->db->createCommand("UPDATE sso_users
						SET is_passwd_reset = 'Y', passwd_reset_code= '".$reset_code."', passwd_reset_req_datetime = '".strtotime($reset_time)."', passwd_reset_date='".date('Y-m-d')."' WHERE user_id = ".$user['user_id'])->execute();						


						$fname = $profile['first_name'];
						$mname = $profile['last_name'];
						$lname = $profile['surname'];
						$subject = 'Password Reset';
						$to=$user['email'];
						$content ="<strong>Dear $fname $mname $lname </strong>,<br><br>
						We have sent you this email in response to your request to reset your password.<br><br>
						To reset your password for <a href='".EMAIL_WEB_URL."' title='Website'> CAIPO Portal</a>, please follow the link below: 
						
						<br><br>
						<a href='".EMAIL_WEB_URL."/sso/account/changePassword/reset_code/".$reset_code."/uiuid/".$user['iuid']."/rt/".strtotime($reset_time)."/email/".$user['email']."' title='Password Reset'> Password Reset Link</a>
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
						$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
						$data = DefaultUtility::post_to_url(EMAIL_API,$post_data);
						echo json_encode(['status'=>false,'msg'=>'Success! Password reset link send on your registered email ID']);

					}else{
						echo json_encode(['status'=>false,'msg'=>'user profile not found']);
					}   
				}
			}else{
				echo json_encode(['status'=>false,'msg'=>'user not found']);
			}
				
        }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
        }
    }


    public  function  actionEditprofile(){
    	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
                
                $user = Yii::app()->db->createCommand("SELECT * FROM sso_users where user_id=".$data['user_id'])->queryRow();
                $userprofile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id =".$user['user_id'])->queryRow();              

                $token_msg = 'token match'; 
                $token = Token::gettoken($user['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$user['user_id'],'userdata'=>$user,'userprofile'=>$userprofile]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }
    }

    public  function  actionSaveprofile(){
    	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
            	 $token_msg = 'token match'; 
                if(isset($data['first_name']) || isset($data['middle_name']) || isset($data['surname']) || isset($data['gender']) || isset($data['dob']) || isset($data['mobile']) || isset($data['telephone']) || isset($data['nationality']) || isset($data['address']) || isset($data['address2']) || isset($data['country']) || isset($data['state_parish']) || isset($data['city_name']) || isset($data['pin_code'])){
					
					$userprofile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id =".$data['user_id'])->queryRow();
					// print_r($userprofile);die;
                	if(isset($data['first_name'])  && $data['first_name']!=""){
						$first_name = $data['first_name'];
					}else{
						$first_name = $userprofile['first_name'];
					}
					if(isset($data['middle_name'])  && $data['middle_name']!=""){
						$middle_name = $data['middle_name'];
					}else{
						$middle_name = $userprofile['last_name'];
					}
					if(isset($data['surname'])  && $data['surname']!=""){
						$surname = $data['surname'];
					}else{
						$surname = $userprofile['surname'];
					}
					if(isset($data['gender'])  && $data['gender']!=""){
						$gender = $data['gender'];
					}else{
						$gender = $userprofile['gender'];
					}
					if(isset($data['dob'])  && $data['dob']!=""){
						$dob = $data['dob'];
					}else{
						$dob = $userprofile['date_of_birth'];
					}
					if(isset($data['mobile'])  && $data['mobile']!=""){
						$mobile = $data['mobile'];
					}else{
						$mobile = $userprofile['mobile_number'];
					}
					if(isset($data['telephone'])  && $data['telephone']!=""){
						$telephone = $data['telephone'];
					}else{
						$telephone = $userprofile['telephone'];
					}
					if(isset($data['nationality'])  && $data['nationality']!=""){
						$nationality = $data['nationality'];
					}else{
						$nationality = $userprofile['nationality'];
					}
					if(isset($data['address'])  && $data['address']!=""){
						$address = $data['address'];
					}else{
						$address = $userprofile['address'];
					}
					if(isset($data['address2'])  && $data['address2']!=""){
						$address2 = $data['address2'];
					}else{
						$address2 = $userprofile['address2'];
					}
					if(isset($data['country'])  && $data['country']!=""){
						$country = $data['country'];
					}else{
						$country = $userprofile['country_name'];
					}
					if(isset($data['state_parish'])  && $data['state_parish']!=""){
						$state_parish = $data['state_parish'];
					}else{
						$state_parish = $userprofile['state_name'];
					}
					if(isset($data['city_name'])  && $data['city_name']!=""){
						$city_name = $data['city_name'];
					}else{
						$city_name = $userprofile['city_name'];
					}
					if(isset($data['pin_code'])  && $data['pin_code']!=""){
						$pin_code = $data['pin_code'];
					}else{
						$pin_code = $userprofile['pin_code'];
					}
                	
                	
						
                	$user = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y'AND user_id=".$data['user_id'])->queryRow();
                	

                	if($user && $userprofile){
                		Yii::app()->db->createCommand("UPDATE sso_users
						SET mobile_no='".$mobile."' WHERE user_id = ".$user['user_id'])->execute();

						Yii::app()->db->createCommand("UPDATE sso_profiles
						SET first_name = '".@$first_name."', last_name= '".@$middle_name."', surname = '".@$surname."', gender='".@$gender."', date_of_birth='".date('Y-m-d',strtotime(@$dob))."',mobile_number='".@$mobile."', country_name='".@$country."', state_name='".@$state_parish."', nationality='".@$nationality."', telephone='".@$telephone."', address='".@$address."', address2='".@$address2."', city_name='".@$city_name."', pin_code='".@$pin_code."'  WHERE user_id = ".$user['user_id'])->execute();

                		$token = Token::gettoken($data['user_id']);
	               		echo json_encode(['status'=>true,'msg'=>'Success! Profile updated','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$data['user_id'],'created_date'=>$user['created_on']]);
                	}else{
                		echo json_encode(['status'=>false,'msg'=>'user not found']);
                	}

                }else{
                	echo json_encode(['status'=>false,'msg'=>'parameters missing']);
                }         
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }
    }

public function actionChangepassword(){
	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
            	 $token_msg = 'token match'; 
                if(isset($data['old_password']) && isset($data['new_password']) && isset($data['confirm_password'])){
                	
                	$user = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y'AND user_id=".$data['user_id'])->queryRow();
                	$userprofile =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles u WHERE u.user_id =".$data['user_id'])->queryRow();

                	if($user && $userprofile){
	              		$salt = $user['salt'];
						$passwd = $data['old_password'];
						$password2 = $user['password'];
						$passwd=hash_hmac("sha1",$passwd.$salt,'b99#3H?AQ7Zfsj'); // b99#3H?AQ7Zfsj - static value of PASSWORD_SECRET_KEY
						if($passwd === $password2){							
							if($data['new_password'] === $data['confirm_password']){
								$new_input_pass = $data['new_password'];
								$salt=md5($new_input_pass."_".time()."-".rand(111,9999999));
								$new_password = $passwd=hash_hmac("sha1",$new_input_pass.$salt,'b99#3H?AQ7Zfsj');
								$date = date('Y-m-d');
								$usermodal =  Yii::app()->db->createCommand("update sso_users set password= '".$new_password."', salt= '".$salt."', is_passwd_reset='Y', passwd_reset_date='".$date."'  where user_id= ".$user['user_id']);
								$usermodal->execute(); 
								$token = Token::gettoken($data['user_id']);
	               				echo json_encode(['status'=>true,'msg'=>'Success! Profile updated','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$data['user_id']]);
							}else{
								echo json_encode(['status'=>false,'msg'=>'New password and confirm  password are not matched']);
							}
					
						}else{
							echo json_encode(['status'=>false,'msg'=>'Incorrect old password']);
						}                		
                	}else{
                		echo json_encode(['status'=>false,'msg'=>'user not found']);
                	}

                }else{
                	echo json_encode(['status'=>false,'msg'=>'parameters missing']);
                }         
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }
}

public function actionNotification(){
	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
            	 $token_msg = 'token match';
            	 $uid = $data['user_id'];
            	 $notification = Yii::app()->db->createCommand("SELECT * From alert_notification where user_type='FO' AND created_by=$uid AND is_seen=0 order by id desc")->queryAll();
            	  $token = Token::gettoken($data['user_id']);
	              echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$data['user_id'],'notifications'=>$notification]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            } 
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }	
}

public function actionSeenotification(){
	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
            	if(isset($data['notification_id'])){
            		$token_msg = 'token match';
            	 	$uid = $data['user_id'];
            	 	$notification = Yii::app()->db->createCommand("SELECT * From alert_notification where user_type='FO' AND created_by=$uid AND is_seen=0 AND id=".$data['notification_id'])->queryRow();
            	 	if($notification){
            	 		$token = Token::gettoken($data['user_id']);
            	 		Yii::app()->db->createCommand("UPDATE alert_notification
						SET is_seen=1 WHERE id=".$data['notification_id'])->execute();

	              		echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$data['user_id'],'notifications'=>$notification]);
            	 	}else{
            	 		echo json_encode(['status'=>false,'msg'=>'notification not found']);
            	 	}            	  	
            	}else{
            		echo json_encode(['status'=>false,'msg'=>'parameters missing']);
            	}
            	
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            } 
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }	
}
public function actionClearallnotification(){
	$data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$data['user_id']);
            if($is_match==true){
            	 $token_msg = 'token match';
            	 $uid = $data['user_id'];

            	 Yii::app()->db->createCommand("UPDATE alert_notification
						SET is_seen=1 WHERE user_type='FO' AND created_by=$uid AND is_seen=0 ")->execute();
            	
            	  $token = Token::gettoken($data['user_id']);
	              echo json_encode(['status'=>true,'msg'=>'Success! All notifications is cleared','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$data['user_id']]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            } 
        }else{
            echo json_encode(['status'=>false,'msg'=>'token and user Id missing']);
        }	
}



	public function actionResendotp() {
		
        $data = json_decode(file_get_contents('php://input'), true);
       

		if(isset($data['fname']) && isset($data['mname'])&& isset($data['lname']) && isset($data['email']) && isset($data['mobile'])){
			

			$fname =  $data['fname'];
			$mname =  $data['mname'];
			$lname =  $data['lname'];			
			$mobile = $data['mobile'];			
			$email =  $data['email'];   	 	
					
			if($mobile && $email){
			
    	 			
						$otp=rand(1000,9999);
											
						$model= new ManageOtp;
						$model->created_date=date('Y-m-d H:i:s');
						$model->mobile_number=$mobile;
						$model->iuuid=mt_rand(10000000, 99999999);				
						$model->otp=$otp;						
						
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

									$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);    
									DefaultUtility::post_to_url(EMAIL_API,$post_data); 					
									
									echo json_encode(['status'=>true,'msg'=>'OTP send on mail','email'=>$email,'sent_otp'=>$model->otp,'registration_data'=>$data]);	
		    	 			}else{
					echo json_encode(['status'=>false,'msg'=>'Something went wrong while generating OTP']);
				}	

				
			}else{
				echo json_encode(['status'=>false,'msg'=>'Mobile number & email cannot be blank']);
			}
    	}else{
    	 	echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    	}
		
}

	
	
	


}