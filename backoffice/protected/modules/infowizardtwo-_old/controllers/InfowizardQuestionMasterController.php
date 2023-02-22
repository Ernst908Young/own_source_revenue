<?php

/**
    * This function is used to get the Question Master
     * @Author: Neha Jaiswal
     */

class InfowizardQuestionMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','listQuestion','listView','listEdit'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','listQuestion','listView','listEdit'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','listQuestion','listView','listEdit'),
				'expression'=>'DefaultUtility::isIWDataEntry()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


public function actionListQuestion()
	{
		
			
		
		$applications=InfowizardQuestionMasterExt::getIWListQuestion();
		$this->render("listQuestion",array("apps"=>$applications));
	}

public function actionListView($id)
	{
		
		$applications=InfowizardQuestionMasterExt::getIWListView($id);
		//print_r($applications); die;
		$this->render("listView",array("apps"=>$applications));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new InfowizardQuestionMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InfowizardQuestionMaster']))
		{
			$model->attributes=$_POST['InfowizardQuestionMaster'];
			$model->created_date=date('Y-m-d H:m:s');
			if($model->save())
				$this->redirect(array('listQuestion','id'=>$model->question_id));
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

		if(isset($_POST['InfowizardQuestionMaster']))
		{
			$model->attributes=$_POST['InfowizardQuestionMaster'];
			$model->created_date=date('Y-m-d H:m:s');
			if($model->save())
				$this->redirect(array('listQuestion','id'=>$model->question_id));
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InfowizardQuestionMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InfowizardQuestionMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InfowizardQuestionMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='infowizard-question-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
