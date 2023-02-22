<?php

class ViewAPIAccessLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';

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
				'actions'=>array('index','view','newListing','newView','VendorApiLogs'),
				'users'=>array('*'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionNewView($id)
	{
		$this->render('newview',array(
			'model'=>$this->loadNewModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ApiAccessLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ApiAccessLog']))
		{
			$model->attributes=$_POST['ApiAccessLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->access_id));
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

		if(isset($_POST['ApiAccessLog']))
		{
			$model->attributes=$_POST['ApiAccessLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->access_id));
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
		$dataProvider=new CActiveDataProvider('ApiAccessLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ApiAccessLog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ApiAccessLog']))
			$model->attributes=$_GET['ApiAccessLog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApiAccessLog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ApiAccessLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApiAccessLog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='api-access-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        /**
	 * Lists all models.
	 */
	public function actionVendorApiLogs()
	{
           $critearea="select service_provider_tag as sp_tag from sso_service_providers  where department_id=".$_SESSION['dept_id'];
           $deptDetail=Yii::app()->db->createCommand($critearea)->queryRow();
		
	 $dataProvider=new CActiveDataProvider('NewApiAccessLog', array(
    'criteria'=>array(
        'condition'=>"sp_tag='".$deptDetail['sp_tag']."'",
        'order'=>'created_date_time DESC'        
    )    
));
         $this->render('newlisting',array(
			'dataProvider'=>$dataProvider,
		));
	}
        /**
	 * Lists all models.
	 */
	public function actionNewListing()
	{
		$dataProvider=new CActiveDataProvider('NewApiAccessLog');
		$this->render('newlisting',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApiAccessLog the loaded model
	 * @throws CHttpException
	 */
        
	public function loadNewModel($id)
	{
		$model=NewApiAccessLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
