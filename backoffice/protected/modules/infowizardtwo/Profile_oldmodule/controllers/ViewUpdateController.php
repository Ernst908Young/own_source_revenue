<?php

class ViewUpdateController extends Controller
{
	public function actionIndex()
	{
		
		@session_start();
		// die;
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE']))
			$this->render('profile');
		elseif(isset($_SESSION['department_login']) && $_SESSION['department_login']==1){
			$model=User::model()->findByPk($_SESSION['uid']);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			$this->render('deptProfile',array('model'=>$model->attributes));
		}
		else
			$this->redirect(Yii::app()->homeUrl);
	}
	public function actionEditProfile(){
		@session_start();
		if(isset($_SESSION['sso_token']) && !empty($_SESSION)){
			$uid=$_SESSION['RESPONSE']['user_id'];
			$iuid=$_SESSION['RESPONSE']['iuid'];
			if(isset($_POST['Profile'])){
				$api_hash=hash_hmac('sha1', md5($uid.$iuid), SSO_API_PUBLIC_KEY);
				$post_data=array('user_id'=>$uid,'iuid'=>$iuid,'api_hash'=>$api_hash,'profile_fields'=>json_encode($_POST['Profile']));
				$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/UpdateUserProfile',$post_data));
				if($response->STATUS===200){
					$_SESSION['RESPONSE']['first_name']=$_POST['Profile']['first_name'];
					$_SESSION['RESPONSE']['last_name']=$_POST['Profile']['last_name'];
					$_SESSION['RESPONSE']['mob_number']=$_POST['Profile']['mob_number'];
					$_SESSION['RESPONSE']['pan_card']=$_POST['Profile']['pan_card'];
					$_SESSION['RESPONSE']['aadhar_card']=$_POST['Profile']['aadhar_card'];
					$_SESSION['RESPONSE']['city']=$_POST['Profile']['city'];
					$_SESSION['RESPONSE']['address']=$_POST['Profile']['address'];
					$_SESSION['RESPONSE']['pin_code']=$_POST['Profile']['pin_code'];
                                        $_SESSION['RESPONSE']['delegate_officer_number']=$_POST['Profile']['delegate_officer_number'];
					Yii::app()->user->setFlash('Success', $response->RESPONSE);
					$this->redirect(array('/Profile/ViewUpdate'));
         			exit;
				}
				else{
					Yii::app()->user->setFlash('Error', $response->RESPONSE);
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;	
				}
			}	
		}
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])){
			$this->render('profile_edit');
		}
		elseif(isset($_SESSION['department_login']) && $_SESSION['department_login']==1){
			if(isset($_POST['Profile'])){
				$model=User::model()->findByPk($_SESSION['uid']);
				if($model===null)
					throw new CHttpException(404,'The requested page does not exist.');
                                
                                 $sql = "insert into bo_user_history(uid,full_name,email,email_alert,mobile,delegate_officer_number,delegate_officer_name,delegate_officer_email,"
                                         . "office_no,fax,password,created_datetime,dept_id,disctrict_id,served_till,reason,is_active) values('" . $model->uid . "','" . $model->full_name . "','" . $model->email . "','" . $model->email_alert . "','" . $model->mobile . "','" . $model->delegate_officer_number . "','" . $model->delegate_officer_name . "','" . $model->delegate_officer_email . "','" . $model->office_no . "','" . $model->fax . "','" . $model->password . "','" . $model->created_datetime . "','" . $model->dept_id . "','" . $model->disctrict_id . "','','','" . $model->is_active . "')";
                                 $connection = Yii::app()->db;
                                 $command = $connection->createCommand($sql);
                                 $alerts = $command->execute();
				$model->full_name=$_POST['Profile']['full_name'];
				$model->mobile=$_POST['Profile']['mobile'];
                                $model->delegate_officer_number=$_POST['Profile']['delegate_officer_number'];
                                $model->delegate_officer_name=$_POST['Profile']['delegate_officer_name'];
                                $model->delegate_officer_email=$_POST['Profile']['delegate_officer_email'];
				if($model->save()){
					$_SESSION['uname']=$_POST['Profile']['full_name'];
					Yii::app()->user->setFlash('Success', "Successfully Updated");
					$this->redirect(array('/Profile/ViewUpdate'));
         			exit;
				}
				else{
					Yii::app()->user->setFlash('Error', "Could not update");
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;	
				}
				print_r($_POST['Profile']);die;

			}

			$model=User::model()->findByPk($_SESSION['uid']);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			$this->render('deptProfileEdit',array('model'=>$model->attributes));
		}
		else
			$this->redirect(Yii::app()->homeUrl);
	}
	public function actionUpdatePassword(){
		@session_start();
		if(isset($_SESSION['sso_token']) && !empty($_SESSION)){
			$uid=$_SESSION['RESPONSE']['user_id'];
			$iuid=$_SESSION['RESPONSE']['iuid'];
			if(isset($_POST['Password'])){
				extract($_POST['Password']);
				if($new_pwd!=$rep_pwd){
					Yii::app()->user->setFlash('Error', "New Password and Repeat password did not match");
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;	
				}
				$api_hash=hash_hmac('sha1', md5($uid.$iuid), SSO_API_PUBLIC_KEY);
				$post_data=array('user_id'=>$uid,'iuid'=>$iuid,'api_hash'=>$api_hash,'post_fields'=>json_encode($_POST['Password']));
				$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/UpdateUserPassword',$post_data));
				if($response->STATUS===200){
					Yii::app()->user->setFlash('Success', $response->RESPONSE);
					$this->redirect(array('/Profile/ViewUpdate'));
         			exit;
				}
				else{
					Yii::app()->user->setFlash('Error', $response->RESPONSE);
					$this->redirect(array('/Profile/ViewUpdate/EditProfile'));
         			exit;
				}
			}
		}
		elseif(isset($_SESSION['department_login']) && $_SESSION['department_login']==1){
			if(isset($_POST['Password'])){
			  $pass=hash_hmac('sha1', $_POST['Password']['current_pwd'], PASSWORD_SECRET_KEY);
			  $model=User::model()->findByPk($_POST['Password']['uid']);
			  if($model===null)
			  	throw new CHttpException(404,'The requested page does not exist.');
			  
			  if($_POST['Password']['new_pwd']!=$_POST['Password']['rep_pwd']){
			  	    Yii::app()->user->setFlash('Error', "New Password and Repeat password did not match");
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;
			  }
			  if($model->password!=$pass){
			  		Yii::app()->user->setFlash('Error', "Old Password not match");
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;
			  }
			  $newpass=hash_hmac('sha1', $_POST['Password']['new_pwd'], PASSWORD_SECRET_KEY);
			  $model->password=$newpass;
			  if($model->save()){
			  		Yii::app()->user->setFlash('Success', "Successfully Changed");
					$this->redirect(array('/Profile/ViewUpdate'));
					exit;
			  }
			  else{
			  	  		Yii::app()->user->setFlash('Error', "Could not change your password");
			  			$this->redirect(array('/Profile/ViewUpdate'));
			  			exit;
			  }
			}
		}
		else{
			Yii::app()->user->setFlash('Error', "Please Login, to perform this action.");
			$this->redirect(array('/frontuser'));
         	exit;
		}
	}


	 // Developer Name: Rahul K
    // Function work: Sending OTP to those user who have not verified their Email OR Mobile.

    public function actionOtp() {     
        
        @session_start();
         $model = User::model()->findByPk($_SESSION['uid']);


            $MOBILE=  $model['mobile'];
            $EMAIL=  $model['email'];

     $msgOtp="";
     $emailOtp="";
        
        
        //Checking if already Verified
        
        $model1 = BoUserContactVerify::model()->findAllByAttributes(array('user_id' => $_SESSION['uid'], "mobile_verified" => 'Yes',"mobile"=>$MOBILE), array('order' => 'id DESC', 'limit' => 1));
        $model2 = BoUserContactVerify::model()->findAllByAttributes(array('user_id' => $_SESSION['uid'], "email_verified" => 'Yes',"email"=>$EMAIL), array('order' => 'id DESC', 'limit' => 1));
        if (!empty($model1) && !empty($model2)) {
            Yii::app()->user->setFlash('Success', "Your mobile and email is already verified.");
            $this->redirect(array('/Profile/viewUpdate'));
        }
        if (!empty($model1)) {
            $_SESSION['mobile_otp'] = "Yes";
           // $_SESSION['mobile']=$model1['mobile'];
        } else {
            $_SESSION['mobile_otp'] = "No";
           // $_SESSION['mobile']="";

        }
        if (!empty($model2)) {
            $_SESSION['email_otp'] = "Yes";
           // $_SESSION['email']=$model2['email'];

        } else {
            $_SESSION['email_otp'] = "No";
            //  $_SESSION['email']="";
        }

        if (isset($_POST['Profile'])) {
            $OTPflg = 0;
            if ($_SESSION['mobile_otp'] != "Yes") {
                // SEND OTP ON MOBILE 
                $msgOtp = rand(111111, 999999);
                //$mobileNumebr = "9455464340";
                $mobileNumebr=$MOBILE;           
                $mobileOtpMessage = "Your mobile verification OTP is " . $msgOtp ." For Security reason, Please do not share with anyone.";
                $mobileMsgSendStatus = DefaultUtility::sendOTPToMobile($mobileNumebr, $mobileOtpMessage);
                $OTPflg = $mobileMsgSendStatus;
                
            }

            //SEND OTP ON EMAIL
            if ($_SESSION['email_otp'] != "Yes") {
                $emailOtp = rand(111111, 999999);
                //$emailId = "rahulkumar.ey@gmail.com";
                 $emailId=$EMAIL;      
                $emailOtpMessage = "Your email verification OTP is " . $emailOtp ." For Security reason, Please do not share with anyone.";
                $subject = "Email Verification";
                $name = "Contact Verifiction";
                $emailOtpMessage=UniversalUtility::emailHFB($emailOtpMessage);
               // $emailSentStatus=mail($emailId,$subject,$emailOtpMessage);
                               
                $emailSentStatus= DefaultUtility::sendEmail(EMAIL_HOST,EMAIL_PORT,EMAIL_USERNAME,EMAIL_PASSWORD,$subject,$emailOtpMessage,$emailId);
                if ($emailSentStatus) {
                    if ($OTPflg != 1) {
                        $OTPflg = 1;
                        $emailmsg="";
                    }
                } else {
                    // Email Not Sent
                    $emailmsg="Email OTP not sent, Please try again";
                }
            }
            // if(mail($emailId,$subject,$emailOtpMessage)){echo "Email Sent";}else{echo "Email Not Sent";}die;
            //UPDATING DATA IN TO DATABASE
            $createdTime = date('Y-m-d h:i:s', time());
            $userId = $_SESSION['uid'];

            $m = new BoUserContactVerify();
            $m->user_id = $userId;
            $m->mobile = $MOBILE;
            $m->email = $EMAIL;
            $m->mobile_verified = "No";
            $m->email_verified = "No";
            $m->mobile_otp = $msgOtp;
            $m->email_otp = $emailOtp;
            $m->created_time = $createdTime;
            $m->save();


            // REDIRECTING ON VERIFY PAGE WITH THE STATUS MESSAGE
            if ($OTPflg) {
                Yii::app()->user->setFlash('Success', "OTP has been sent");
                $this->redirect(array('/Profile/viewUpdate/verify'));
                exit;
            } else {
                Yii::app()->user->setFlash('Error', "OTP not sent, Please try again");
            }
        }

 if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        $this->render('otp', array('model' => $model->attributes));
//      
    }

    // Developer Name: Rahul K
    // Function work: Verify OTP , which has been sent already on mobile No/ Email.

     function actionVerify() {
        @session_start();
         $model = BoUserContactVerify::model()->findAllByAttributes(array('user_id' => $_SESSION['uid']), array('order' => 'id DESC', 'limit' => 1));
           
        if (isset($_POST['Profile'])) {

            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');

            // OTP is Valid Up to 15 Minutes
            $validupto = $model[0]['created_time'];
            $endTime = strtotime("+15 minutes", strtotime($validupto));
            $currentTime = date('Y-m-d h:i:s');
//print_r($_POST);die;
            $mobileVerified = "Yes"; // In Case of already verified
            if ($model[0]['mobile_verified'] == "No") {
                if ($model[0]['mobile_otp'] == $_POST['Profile']['mobile_otp'] && $endTime > $currentTime) {
                    $mobileVerified = "Yes";
                } else {
                    $mobileVerified = "No";
                }
            }
            $emailVerified = "Yes"; // In Case of already verified
            if ($model[0]['email_verified'] == "No") {

                if ($model[0]['email_otp'] == $_POST['Profile']['email_otp'] && $endTime > $currentTime) {
                    $emailVerified = "Yes";
                    $Emsg = "";
                } else {
                    $emailVerified = "No";
                }
            }
            // UPDATE IN DATABASE
            Yii::app()->db->createCommand()->update(
                    'bo_user_contact_verify', array('mobile_verified' => $mobileVerified,
                'email_verified' => $emailVerified), 'id = :param', array(':param' => $model[0]['id'])
            );

            if ($mobileVerified == "No" && $emailVerified == "No") {
                $msg = "Mobile number and Email is not verified";
                Yii::app()->user->setFlash('Error', $msg);
            }
            if ($mobileVerified == "Yes" && $emailVerified == "No") {
                $msg = "Mobile number has been verified";
                Yii::app()->user->setFlash('Success', $msg);
                $msg1 = "Email is still not verified";
                Yii::app()->user->setFlash('Error', $msg1);
                $_SESSION['mobile_otp'] = "Yes";
            }
            if ($mobileVerified == "No" && $emailVerified == "Yes") {

                $msg = "Email has been verified";
                Yii::app()->user->setFlash('Success', $msg);
                $msg1 = "Mobile number is still not verified";
                Yii::app()->user->setFlash('Error', $msg1);
                $_SESSION['email_otp'] = "Yes";
            }

            if ($mobileVerified == "Yes" && $emailVerified == "Yes") {
                $msg = "Mobile and Email has been verified";
                Yii::app()->user->setFlash('Success', $msg);
                $this->redirect(array('/Profile/viewUpdate/otp'));
                $_SESSION['email_otp'] = "Yes";
                $_SESSION['mobile_otp'] = "Yes";
            }


             $this->render('verify', array('model' => $model));
        }
        $this->render('verify');
    }

    // Developer Name: Rahul K
    // Function work: If Not Recieved OTP then this fucntion will save that to db that the user have not recived otp for email or mobile or both

    public function actionNotRecived() {
        @session_start();
        if (!empty($_POST['Profile'])) {


            // Update In DB that the user has not recived OTP for Mobile/Email 
            //  print_r($_POST);die;
            $flg = 0;
            if (!empty($_POST['Profile']['mobile_otp'])) {
                $flg = "1";
            }
            if (!empty($_POST['Profile']['email_otp'])) {
                $flg = "1";
            }
            if ($flg == 0) {
                //  die("hi");
                $msg = "Please check atleast one option";
                Yii::app()->user->setFlash('Error', $msg);
            } else {
                $model = new BoUserOtp();
                $model->user_id = $_SESSION['uid'];
                if (isset($_POST['Profile']['mobile_otp'])) {
                    $model->mobile_otp = $_POST['Profile']['mobile_otp'];
                }
                if (isset($_POST['Profile']['email_otp'])) {
                    $model->email_otp = $_POST['Profile']['email_otp'];
                }
                $model->save();
                $msg = "Your feedback has been saved.";
                Yii::app()->user->setFlash('Success', $msg);
                $this->redirect(array('/Profile/viewUpdate'));
            }
        }
        if (isset($_SESSION['uid'])) {
            $model = User::model()->findByPk($_SESSION['uid']);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            $this->render('notRecived', array('model' => $model->attributes));
        }
    }
	
	
	
	/*
	 * @authour: K SANSI
	 * @date:26022019
	 *                  
	 */
	 
	public function actionSwitchAccount(){
		@session_start();
				
		if(isset($_SESSION['uid'])){
			$uid=$_SESSION['uid'];
			$mobile_number=$_SESSION['mobile'];			
			
			$sql = "SELECT bo_user.full_name,bo_user.mobile,bo_user.mobile_old,bo_user.email,bo_user_role_mapping.role_id,
					bo_roles.role_name 
					FROM `bo_user` 
					left join bo_user_role_mapping on (bo_user.uid=bo_user_role_mapping.user_id)
					left join bo_roles on (bo_user_role_mapping.role_id=bo_roles.role_id)
					WHERE (bo_user.`mobile` LIKE '%$mobile_number%' or bo_user.`mobile_old` LIKE '%$mobile_number%')";
			
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$roleData = $command->queryAll();
			
			//echo "<pre>" ; print_r($roleData);die ;
			
			
			$this->render('switchAccount',array('roleData'=>$roleData));
			
		}
		else
			$this->redirect(Yii::app()->homeUrl);
	}

	
}