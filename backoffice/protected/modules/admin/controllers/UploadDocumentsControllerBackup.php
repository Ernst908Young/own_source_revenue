<?php

class UploadDocumentsController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','uploadFiles','create','update','admin','delete'),
				'expression'=>'RolesExt::isNodleAgencyUser()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	/**
	*@author: Hemant Thakur
	*/
	public function actionUploadFiles(){
		if(isset($_FILES['investor_form'])){
			if($_FILES['investor_form']['size']>875000){
				Yii::app()->user->setFlash('Error', "Document must in of size 20kb-7Mb");
				$this->redirect(array('/admin/uploadDocuments'));
				exit;
			}
			if($_FILES['investor_form']['type']>'application/pdf'){
				Yii::app()->user->setFlash('Error', "Document must be a pdf document.");
				$this->redirect(array('/admin/uploadDocuments'));
				exit;
			}
			extract($_POST);
			@session_start();
			extract($_SESSION);
			$hash=hash_hmac('sha1', md5($uid.$submission_id.$dept_id), CDN_PUBLIC_KEY);
			$imgData =file_get_contents($_FILES['investor_form']['tmp_name']);
			$date=date('Y-m-d H:m:s');
			$user_agent=$_SERVER['HTTP_USER_AGENT'];
			$remote_ip=$_SERVER['REMOTE_ADDR'];
			$post_data=array('user_id'=>$uid,'user_agent'=>$user_agent,'remote_ip'=>$remote_ip,'date_time'=>$date,'app_id'=>$submission_id,'api_hash'=>$hash,'dept_id'=>$dept_id,'doc_name'=>$_FILES['investor_form']['name'],'doc_type'=>$_FILES['investor_form']['type'],'doc_size'=>$_FILES['investor_form']['size'],'doc_blob_data'=>base64_encode($imgData));
			$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/saveInvestorDocuments',$post_data));
			if(is_object($response)){
				if($response->STATUS===200){
					Yii::app()->user->setFlash('Success', "Successfully Uploaded.");
					$this->redirect(array('/admin/uploadDocuments'));
					exit;
				}
				else{
					Yii::app()->user->setFlash('Error', $response->MSG);
					$this->redirect(array('/admin/uploadDocuments'));
					exit;
				}
			}
			else{
				Yii::app()->user->setFlash('Error', "Some Technical Error");
				$this->redirect(array('/admin/uploadDocuments'));
				exit;
			}
		}
		if(isset($_GET['app_submission_id'])){

			$sub_id=base64_decode($_GET['app_submission_id']);
			$criteria = new CDbCriteria();
			$criteria->condition="submission_id=:sub_id";
			$criteria->params = array(':sub_id'=>$sub_id);
			$model = ApplicationSubmission::model()->find($criteria);
			if(empty($model)){
				Yii::app()->user->setFlash('Error', "Invalid request.");
				$this->redirect(array('/admin/uploadDocuments'));
				exit;
			}
			$this->render('uploadFiles',array('model'=>$model));			
		}
		else{
			Yii::app()->user->setFlash('Error', "Invalid request.");
			$this->redirect(array('/admin/uploadDocuments'));
			exit;

		}

	}


}