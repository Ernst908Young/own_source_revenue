<?php

class AuthController extends Controller {
    
    public function actionIndex(){
    
        $this->render("index");
    }
    
    public function actionAuth1(){
    	
    	$params=array();
		if(isset($_POST['CALLBACK_URL']) && !empty($_POST['CALLBACK_URL']) ){
			$params['callback_url']=$_POST['CALLBACK_URL'];
			$params['callback_failure_url']=$_POST['CALLBACK_FAILURE_URL'];
			$params['callback_success_url']=$_POST['CALLBACK_SUCCESS_URL'];
			$params['hmac_hash']=$_POST['HMAC_HASH'];
			$params['sp_tag']=$SP_TAG=$_POST['SP_TAG'];
			$params['token_created_on']=date( 'Y-m-d H:i:s');
			
			$criteria = new CDbCriteria();
			$criteria->condition = 'service_provider_tag=:service_provider_tag';
			$criteria->params = array(':service_provider_tag'=>$SP_TAG);
			$service_providers = ServiceProviders::model()->find($criteria);
			$service_providers = $service_providers->attributes;
			$secret_key = $service_providers['secret_key'];
			
			$HMAC_HASH=hash_hmac('sha1', $_POST['CALLBACK_URL'], $secret_key);
			
			if($HMAC_HASH != $_POST['HMAC_HASH']){
				throw new CHttpException(400,'ERROR: Fraudulent Data');
				exit;
			}
			//echo "$secret_key | $HMAC_HASH <pre>"; print_r($_POST); print_r($params); print_r($service_providers); exit;
			$this->render("auth1",$params);
		}
		else{
			echo "DEBUG <pre>"; print_r($_POST); exit;
			//$this->redirect($this->createUrl('/auth/index'));
		}
		
    }
	
	public function actionValidate(){
			
		if(isset($_POST['email'])) {
    		extract($_POST);
			$passwd="";
			$password2=0;
			$user_id=$token=$salt=NULL;
			$session=new CHttpSession;
  			$session->open();
			
			$criteria = new CDbCriteria();
			$criteria->condition = 'email=:email OR iuid=:iuid';
			$criteria->params = array(':email'=>$email, ':iuid'=>$email);
			$users = Users::model()->find($criteria);
			$users = $users->attributes;
			if(isset($users['salt']) && !empty($users['salt'])){
				$salt = $users['salt'];
				$user_id = $users['user_id'];
    			$password2 = $users['password'];
    			$passwd=hash_hmac("sha1",$password.$salt,PASSWORD_SECRET_KEY);
			}
			
			if($passwd === $password2){
				//Create Token
				$token=md5($user_id."_".time()."-".rand(1,999999));
				$token_created_on=date( 'Y-m-d H:i:s');
				//callback_url	callback_failure_url	callback_success_url
				$criteria = new CDbCriteria();
				$criteria->condition = 'user_id=:user_id
										AND callback_url=:callback_url 
										AND callback_failure_url=:callback_failure_url 
										AND callback_success_url=:callback_success_url ';
				$criteria->params = array(':user_id'=>$user_id,
										  ':callback_url'=>$callback_url, 
										  ':callback_failure_url'=>$callback_failure_url,
										  ':callback_success_url'=>$callback_success_url);
				
				$ActiveTokens=ActiveTokens::model()->findAll($criteria);
				
				foreach ($ActiveTokens as $AT) {
					$AT=$AT->attributes;
					$token_id=$AT['token_id'];
					
					$_ActiveTokens=ActiveTokens::model()->findByPk($token_id); // assuming there is a post whose ID is 10
					$_ActiveTokens->delete();
				}
							
				$sso_active_tokens=new ActiveTokens;
				$sso_active_tokens->user_id=$user_id;
				$sso_active_tokens->callback_url=$callback_url;
				$sso_active_tokens->callback_failure_url=$callback_failure_url;
				$sso_active_tokens->callback_success_url=$callback_success_url;
				$sso_active_tokens->token_created_on=$token_created_on;
				$sso_active_tokens->user_id=$user_id;				
				$sso_active_tokens->token=$token;				
				$sso_active_tokens->save();
				
				$errors=$sso_active_tokens->getErrors();
				$sso_active_tokens->save();
				
				$session['sso_token']=$token;
				$data=array();
				$data['callback_url']=$callback_url;
				$data['callback_failure_url']=$callback_failure_url;
				$data['callback_success_url']=$callback_success_url;
				$data['token']=$token;
				$data['status_code']="200";
				$data['message']="SUCCESS";
				$data['href']=$href=API_BASEURL."/api/gettokeninfo/token/".$token;
				
				setcookie("SSO_TOKEN", $token, time()+3600, "/");
				setcookie("SSO_HREF", $href, time()+3600, "/");
				
				$this->render('redirect',$data);
				exit;
			}
			else{
				$session->destroy();
				
				$data=array();
				$callback_url=$callback_failure_url=$callback_success_url=API_BASEURL."/auth/auth1";
				$data['login_url']=$callback_url;
				$data['CALLBACK_URL']=$_POST['callback_url'];
				$data['CALLBACK_FAILURE_URL']=$_POST['callback_failure_url'];
				$data['CALLBACK_SUCCESS_URL']=$_POST['callback_success_url'];
				$data['status_code']="401";
				$data['message']="Unauthorized";
				
			
				$this->render('error',$data);
				exit;				
			}
		} 		
	}    
}