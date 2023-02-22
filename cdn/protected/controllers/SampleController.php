<?php

class SampleController extends Controller
{

	public function actionIndex(){
				
		$data=array();
		$is_valid_sso_token=0;			
		$data['CALL_BACK_URL']=$CALL_BACK_URL=CDN_BASE_URL."/sample";
		$data['SP_TAG']=SP_TAG;
		$data['HMAC_HASH']=hash_hmac('sha1', $CALL_BACK_URL, SECRET);
		
		if(isset($_POST['SSO_TOKEN'])){
			extract($_POST);	
			$data=$_POST;
			$res=Utility::getViaCurl($SSO_HREF);
			$_res=json_decode($res);
			$RESPONSE=(array) $_res->RESPONSE;		
			if(count($RESPONSE)>4){
				$is_valid_sso_token=1;
				@session_start();
				$_SESSION['LOGGED_IN']=1;
			}
		}
		if(isset($_COOKIE['SSO_TOKEN'])){
			$SSO_HREF=$_COOKIE['SSO_HREF'];
			$SSO_TOKEN=$_COOKIE['SSO_TOKEN'];
			
			$res=Utility::getViaCurl($SSO_HREF);
			$_res=json_decode($res);
			$RESPONSE=(array) $_res->RESPONSE;		
			if(count($RESPONSE)>4){
				$is_valid_sso_token=1;
				@session_start();
				$_SESSION['LOGGED_IN']=1;
			}	
		}
		if(isset($_POST['SSO_STATUS_CODE'])){
			if($_POST['SSO_STATUS_CODE']!=200){
				$data['is_valid_sso_token']=$is_valid_sso_token;
				$data['error']="Invalid Credentials. Please try again.";
				$this->render('index',$data);
				exit;
			}
		}	
		$data['is_valid_sso_token']=$is_valid_sso_token;	
		//echo "<pre>"; print_r($_POST); print_r($data);  echo "</pre>";
		$this->render('index',$data);
	}
	
	public function actionOne(){
		$data=array();
		$is_valid_sso_token=FALSE;	
		if(isset($_POST['token'])){
			extract($_POST);	
			$is_valid_sso_token=TRUE;
			$data=$_POST;
			//echo "<pre>"; print_r($_POST); exit;
		}
		$data['is_valid_sso_token']=$is_valid_sso_token;
		$data['CALL_BACK_URL']=$CALL_BACK_URL=CDN_BASE_URL."/demo";
		$data['SP_TAG']=SP_TAG;
		$data['HMAC_HASH']=hash_hmac('sha1', $CALL_BACK_URL, SECRET);
		
		//echo "<pre>"; print_r($_POST); print_r($data); exit;
		
		$this->render('index1',$data);
	}
}