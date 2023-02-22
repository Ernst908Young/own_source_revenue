<?php

class DocunenttypeMasterController extends Controller
{
	/**
    * This function is used to get the Document Type Master
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
		$applications=InfowizardQuestionMasterExt::getIWListDocumentTypeByID($id);
		//print_r($applications); die;
		$this->render('view',array('apps'=>$applications));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BoInfowizardDocunenttypeMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardDocunenttypeMaster']))
		{
			$model->attributes=$_POST['BoInfowizardDocunenttypeMaster'];
			$model->created_date=date('Y-m-d H:m:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_id));
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

		if(isset($_POST['BoInfowizardDocunenttypeMaster']))
		{
			$model->attributes=$_POST['BoInfowizardDocunenttypeMaster'];
			$model->created_date=date('Y-m-d H:m:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_id));
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
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$applications=InfowizardQuestionMasterExt::getIWListDocumentType();
		//print_r($applications); die;
		$this->render('index',array('apps'=>$applications));
	}

	/**
	 * Manages all models.
	 */
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardDocunenttypeMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardDocunenttypeMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardDocunenttypeMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-docunenttype-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
