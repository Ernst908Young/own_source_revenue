<?php

class DemoController extends Controller
{
	public function actionLogout(){
		if(isset($_COOKIE['SSO_TOKEN'])){
			$SSO_TOKEN=$_COOKIE['SSO_TOKEN'];
			$URL=API_BASEURL."/api/logouttoken/token/".$SSO_TOKEN;
			Utility::getViaCurl($URL);
			
			setcookie("SSO_TOKEN", NULL, time()-3600, "/");
			setcookie("SSO_HREF", NULL, time()-3600, "/");
			
		}
		
		$url=$this->createUrl('/site/index');
		$this->redirect($url);
	}
	
	public function actionIndex(){
		$RESPONSE=$data=array();
		$is_valid_sso_token=FALSE;	
		
		//echo $_COOKIE['SSO_TOKEN']."<pre>"; print_r($_COOKIE); echo "</pre>";
		//echo "<pre>"; print_r($_POST); echo "</pre>";
		
		if(isset($_COOKIE['SSO_TOKEN'])){

			$SSO_HREF=$_COOKIE['SSO_HREF'];
			$SSO_TOKEN=$_COOKIE['SSO_TOKEN'];
			$res=Utility::getViaCurl($SSO_HREF);
			$_res=json_decode($res);
			$RESPONSE=(array) $_res->RESPONSE;
			if(count($RESPONSE)>4){
				$is_valid_sso_token=TRUE;
				@session_start();
				$_SESSION['LOGGED_IN']=1;
			}	
		}
		if(isset($_POST['SSO_TOKEN'])){
			extract($_POST);	
			$data=$_POST;
			$res=Utility::getViaCurl($SSO_HREF);
			$_res=json_decode($res);
			$RESPONSE=(array) $_res->RESPONSE;		
			if(count($RESPONSE)>4){
				$is_valid_sso_token=TRUE;
				@session_start();
				$_SESSION['LOGGED_IN']=1;
			}	
		}
		if(isset($_POST['SSO_STATUS_CODE'])){
			if($_POST['SSO_STATUS_CODE']!=200){
				$data['is_valid_sso_token']=$is_valid_sso_token;
				$data['CALL_BACK_URL']=$CALL_BACK_URL=CDN_BASE_URL."/demo";
				$data['callback_failure_url']=$CALL_BACK_URL;
				$data['callback_success_url']=$CALL_BACK_URL;
				$data['SP_TAG']=SP_TAG;
				$data['HMAC_HASH']=hash_hmac('sha1', $CALL_BACK_URL, SECRET);
				$data['error']="Invalid Credentials. Please try again.";
				$this->render('index',$data);
				exit;
			}
		}
		
		$data['is_valid_sso_token']=$is_valid_sso_token;
		$data['CALL_BACK_URL']=$CALL_BACK_URL=CDN_BASE_URL."/demo";
		$data['SP_TAG']=SP_TAG;
		$data['HMAC_HASH']=hash_hmac('sha1', $CALL_BACK_URL, SECRET);
		$data['RESPONSE']=$RESPONSE;
		
		//echo "<pre>"; print_r($_POST); print_r($data); exit;
		
		$this->render('index',$data);
	}
}