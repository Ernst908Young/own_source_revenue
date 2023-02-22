<?php

class SignupController extends Controller
{
    
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF, ),
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
		'page' => array('class' => 'CViewAction', ), );
	}

    public function actionIndex(){
    	if(isset($_POST['SP_TAG'])){
    		/*die("signup");*/
    		$SP_TAG=$_POST['SP_TAG'];
			$HMAC_HASH=$_POST['HMAC_HASH'];
			$CALL_BACK_URL=$_POST['CALL_BACK_URL'];
			
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
			
			if($_POST['HMAC_HASH']!=$HMAC){
				throw new CHttpException(400,'ERROR: Fraudulent Data');
				exit;
			}
    	}
    	/*
    	* User Registration

    	*/
		if(isset($_POST['CALL_BACK_URL'],$_POST['password2']) && !empty($_POST['CALL_BACK_URL'])){
			extract($_POST);
			if($password1<>$password2){
				Yii::app()->user->setFlash('Error', "Error: Password and confirm password not match");
		  			$this->redirect('signup/one');
			}
			if(empty($password1)){
				Yii::app()->user->setFlash('Error', "Error: Password cannot be blank");
		  			$this->redirect('signup/one');
			}
			Yii::import('ext.recaptcha.recaptchalib', true);		
			$publickey = SSO_PUBLIC_KEY;
			$privatekey = SSO_PRIVATE_KEY;
			$captcha = recaptcha_get_html($publickey);
			$recaptcha_response_field = Utility::sanatizeParams($_POST['recaptcha_response_field']);
			$recaptcha_challenge_field = $_POST["recaptcha_challenge_field"];
			$recaptcha_response_field=$_POST["recaptcha_response_field"];
			$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);
			if (!$resp -> is_valid){
				Yii::app()->user->setFlash('Error', "Error: Invalid Captcha");
		  			$this->redirect('signup/one');
			} 

			die;
			$userModel= new Users;
			$profiles=new Profiles;
			$userModel->email=$email;
			$userModel->iuid=rand(1000,9999).rand(1000,9999);
			$salt=md5($password1."_".time()."-".rand(111,9999999));
			$userModel->salt=$salt;
			$userModel->password=hash_hmac("sha1",$password1.$salt,PASSWORD_SECRET_KEY);
			$userModel->created_on=date( 'Y-m-d H:i:s');;
			$profiles->first_name=$First_Name;
			$profiles->last_name=$Last_Name;
			$profiles->pan_card=$PAN;
			$profiles->adhaar_number=$Adhaar;
			$profiles->country_name=$Country;
			$profiles->state_name=$State;
			$profiles->city_name=$City;
			$profiles->pin_code=$PIN;
			$profiles->address=$address;
			$profiles->mobile_number=$mobile;
			$transaction = $userModel->dbConnection->beginTransaction();
				try{				
					if($userModel->save()) {
						$lid = Yii::app()->db->getLastInsertID();
						if(!empty($lid)){
							$profiles->user_id=$lid;
							if($profiles->save()) {
								$transaction->commit();
								$params=array();
								$params=$_POST;
								$params['token']=md5(time());
								$params['Profiles']=array('full_name'=>$_POST['First_Name']." ".$_POST['Last_Name'],'mobile_number'=>$_POST['mobile']);
								$params['Users']=array('email'=>$_POST['email']);
								$this->renderPartial('redirect',$params);
								exit;
							} 	
							print_r($profiles->geterrors());						
						}						
					} 	
				} catch(Exception $e){
					$transaction->rollBack();
				} 
				$data=array();
        		$data['users']=new FrontUsers();
       			$data['profiles']=new FrontUserProfiles();
       			$data['CALL_BACK_URL']=$CALL_BACK_URL;
				$this->renderPartial('index',$data);
                    
		}
		/*
    	* End of End of Registration 

    	*/
    	/*
    	* User Login

    	*/
		if(isset($_POST['passwd'],$_POST['CALL_BACK_URL']) && !empty($_POST['CALL_BACK_URL'])){
			extract($_POST);
			$password="";
			$user_id=$token=$salt=NULL;
			$session=new CHttpSession;
  			$session->open();
			$password2=0;
			$criteria = new CDbCriteria();
			$criteria->condition = 'email=:username OR iuid=:iuid';
			$criteria->params = array(':username'=>$username, ':iuid'=>$username);
			$users = Users::model()->find($criteria);
			$users = $users->attributes;
			if(isset($users['salt']) && !empty($users['salt'])){
				$salt = $users['salt'];
				$user_id = $users['user_id'];
    			$password2 = $users['password'];
    			$passwd=hash_hmac("sha1",$passwd.$salt,PASSWORD_SECRET_KEY);
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
				setcookie("SSO_TOKEN", $token, time()+3600, "/");
				setcookie("SSO_HREF", $href, time()+3600, "/");
				$this->render('redirect',$data);
				exit;
			}
			
		}
        $data=array();
        $data['users']=new Users();
        $data['profiles']=new Profiles();
        $data['CALL_BACK_URL']=$CALL_BACK_URL;
		$this->renderPartial('index',$data);
    }
    
    public function actionOtpverify(){
    	extract($_POST);
    	$mobiledb=array("9882102908","8427947345","1234567890","9876543210");
    	$otpdb=array("12345","54321","56789","85214");
    	if(in_array($mobile,$mobiledb) && in_array($otp, $otpdb))
    		echo "SUCCESS";
    	else
    		echo "Not Success";
    }

    public function actionOne(){
    	if(isset($_POST['SP_TAG'])){
    		$SP_TAG=$_POST['SP_TAG'];
			$HMAC_HASH=$_POST['HMAC_HASH'];
			$CALL_BACK_URL=$_POST['CALL_BACK_URL'];
			
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
			
			if($_POST['HMAC_HASH']!=$HMAC){
				throw new CHttpException(400,'ERROR: Fraudulent Data');
				exit;
			}
    	}
		if(isset($_POST['CALL_BACK_URL']) && isset($_POST['password2'])){
			$params=array();
			$params=$_POST;
			$params['token']=md5(time());
			//echo "==> <pre>"; print_r($params); exit;			
			$this->renderPartial('redirect',$params);
			exit;
		}
        $data=array();
        $data['users']=new Users();
        $data['profiles']=new Profiles();
        $data['CALL_BACK_URL']=$CALL_BACK_URL;
        $data['callback_failure_url']=$_POST['CALLBACK_FAILURE_URL'];
		$data['callback_success_url']=$_POST['CALLBACK_SUCCESS_URL'];
		$this->renderPartial('index',$data);
    }
}