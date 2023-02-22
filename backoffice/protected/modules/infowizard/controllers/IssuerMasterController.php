<?php

class IssuerMasterController extends Controller
{
	/**
    * This function is used to get the Issuer Master
     * @Author: Neha Jaiswal
     */
	 
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
				'actions'=>array('create','update','index','view'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','index','view'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$applications=InfowizardQuestionMasterExt::getViewIssuer($id);
		//print_r($applications); die;
		$this->render("view",array("apps"=>$applications));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BoInfowizardIssuerMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardIssuerMaster']))
		{
			$model->attributes=$_POST['BoInfowizardIssuerMaster'];
			if($model->save()){
			Yii::app()->user->setFlash('Success', "Data has been saved");
				$this->redirect(array('view','id'=>$model->issuer_id)); }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardIssuerMaster']))
		{
			$model->attributes=$_POST['BoInfowizardIssuerMaster'];
			if($model->save()){
			Yii::app()->user->setFlash('Success', "Data has been updated");
				$this->redirect(array('view','id'=>$model->issuer_id)); }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$applications=InfowizardQuestionMasterExt::getListIssuer();
		//print_r($applications); die;
		$this->render("index",array("apps"=>$applications));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoInfowizardIssuerMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoInfowizardIssuerMaster']))
			$model->attributes=$_GET['BoInfowizardIssuerMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardIssuerMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardIssuerMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardIssuerMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-issuer-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
