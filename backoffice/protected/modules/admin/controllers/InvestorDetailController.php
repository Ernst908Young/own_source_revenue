<?php

class InvestorDetailController extends Controller
{
	public function actionIndex()
	{
		@session_start();
		$uid=$_SESSION['uid'];
		$api_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
		$post_data=array('uid'=>$uid,'api_hash'=>$api_hash);
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/GetAllUsersDetail',$post_data));
		if(is_object($response) && (isset($response->STATUS) && $response->STATUS==200)){
			$this->render("index",array("investorDetail"=>$response->RESPONSE));
			exit;
		}
	}
	public function actionActivateInvestor(){
		$iuid=base64_decode($_GET['user']);
		$api_hash=hash_hmac('sha1', md5($iuid), SSO_API_PUBLIC_KEY);
		$post_data=array('iuid'=>$iuid,'api_hash'=>$api_hash,"status"=>"Y");
		// echo "<pre>";print_r($post_data);
		// print_r(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/ActivateDeactivateAccount',$post_data));die;
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/ActivateDeactivateAccount',$post_data));
		if(is_object($response) && (isset($response->STATUS) && $response->STATUS==200))
			Yii::app()->user->setFlash('Success', "Successfully Activated the account.");
		else
			Yii::app()->user->setFlash('Error', $response->RESPONSE);
		$this->redirect(Yii::app()->createAbsoluteUrl("admin/InvestorDetail"));

	}
	public function actionDeActivateInvestor(){
		$iuid=base64_decode($_GET['user']);
		$api_hash=hash_hmac('sha1', md5($iuid), SSO_API_PUBLIC_KEY);
		$post_data=array('iuid'=>$iuid,'api_hash'=>$api_hash,"status"=>"N");
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/ActivateDeactivateAccount',$post_data));
		if(is_object($response) && (isset($response->STATUS) && $response->STATUS==200))
			Yii::app()->user->setFlash('Success', "Successfully Activated the account.");
		else
			Yii::app()->user->setFlash('Error', $response->RESPONSE);
		$this->redirect(Yii::app()->createAbsoluteUrl("admin/InvestorDetail"));

	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','deActivateInvestor','activateInvestor'),
				'expression'=>'DefaultUtility::isSubAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
}