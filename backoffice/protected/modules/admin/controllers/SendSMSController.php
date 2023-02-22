<?php

class SendSMSController extends Controller{
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
				'actions'=>array('index'),
				'expression'=>'DefaultUtility::isSMSSender()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex(){
		if(isset($_POST['SendSMS'])){
			$selectedNumbers='';
			if(isset($_POST['SendSMS']['selectedUser']) && count($_POST['SendSMS']['selectedUser']>1))
				$selectedNumbers=implode(",", $_POST['SendSMS']['selectedUser']);
			if(isset($_POST['SendSMS']['otherNumber']) && !empty($_POST['SendSMS']['otherNumber'])){
				if(!empty($selectedNumbers))
					$selectedNumbers.=",".$_POST['SendSMS']['otherNumber'];
				else
					$selectedNumbers.=$_POST['SendSMS']['otherNumber'];

			}
			DefaultUtility::sendMultipleSMS($selectedNumbers,$_POST['SendSMS']['sms']);
		}
		$this->render("sendsms");
	}
	public function actionTest(){
		DefaultUtility::sendMultipleSMS('9882102908,9599424588','This is test sms.');
	}
}