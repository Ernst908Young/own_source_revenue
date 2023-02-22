<?php

class ApplicationActivityController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

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
	 /*
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','ArchiveCAF'),
				'expression'=>'DefaultUtility::isSubAdmin()',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','ArchiveCAF'),
				'expression'=>'DefaultUtility::isNoodalAgency()',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','ArchiveCAF'),
				'expression'=>'DefaultUtility::isSubAdmin()',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','ArchiveCAF'),
				'expression'=>'DefaultUtility::isSubAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

private function loadApplication($id){
	// echo $id;die;
	$model=ApplicationSubmission::model()->findByPK($id);
	if($model===null)
		throw new Exception("Request not found on server", 404);
	return $model;
		
}
public function actionArchiveCAF()
	{	
		if(isset($_POST['app_sub_id'])){
			extract($_POST);
			$model=$this->loadApplication($app_sub_id);
			$model->application_status='Z';
			$model->application_updated_date_time=date('Y-m-d H:i:s');
			if($model->save()){
				$role_id=RolesExt::getUserRoleViaId($_SESSION['uid'])['role_id'];
				ApplicationFlowLogs::generateWorkFlow($app_sub_id,$role_id,$_SESSION['uid'],$comments,null,'Z');
				Yii::app()->user->setFlash('Success','Application has been updated successfully.');
				$this->redirect(Yii::app()->createAbsoluteUrl("admin/ApplicationActivity/ArchiveCAF"));
				exit;
			}else{
				Yii::app()->user->setFlash('Error',"Application couldn't updated successfully.");
				$this->redirect(Yii::app()->createAbsoluteUrl("admin/ApplicationActivity/ArchiveCAF"));
				exit;
			}
		}
		$this->render('ArchiveCAF',array(
			// 'model'=>$model,
		));
	}








}