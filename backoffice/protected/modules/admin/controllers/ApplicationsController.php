<?php

class ApplicationsController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'expression'=>'Utility::isSuperAdmin()',
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

	public function actionTest(){
		Utility::isSuperAdmin();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Applications;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Applications']))
		{
			$_POST['Applications']=array_map('strtolower', $_POST['Applications']);
			$model->attributes=$_POST['Applications'];
			if($model->save()){
				$app_apprvr_id=explode(";", $_POST['Applications']['app_apprvr_id']);
				$ua = $_SERVER['HTTP_USER_AGENT'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date("Y-m-d");
				foreach ($app_apprvr_id as $apprvr_id) {
					$wrkflowmodel=new AppWorkflow;
					$wrkflowmodel->app_id=$model->application_id;
					$wrkflowmodel->role_id=$apprvr_id;
					$wrkflowmodel->wrkflw_createdon=$date;
					$wrkflowmodel->user_agent=$ua;
					$wrkflowmodel->ip_address=$ip;
					$wrkflowmodel->is_active_wrkflw='Y';
					$wrkflowmodel->save();
				}
				$this->redirect(array('view','id'=>$model->application_id));
			}
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

		if(isset($_POST['Applications']))
		{
			$model->attributes=$_POST['Applications'];
			if($model->save()){
				$app_apprvr_id=explode(";", $_POST['Applications']['app_apprvr_id']);
				//check if there is previous wrkflow or not if yes then inactive that and create new one else create the new wrkflow.
				$wrkflow= new AppWorkflowExt;
				$wrkflow->checkExistingWorkflow($model->application_id);
				$ua = $_SERVER['HTTP_USER_AGENT'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date("Y-m-d");
				foreach ($app_apprvr_id as $apprvr_id) {
					$wrkflowmodel=new AppWorkflow;
					$wrkflowmodel->app_id=$model->application_id;
					$wrkflowmodel->role_id=$apprvr_id;
					$wrkflowmodel->wrkflw_createdon=$date;
					$wrkflowmodel->user_agent=$ua;
					$wrkflowmodel->ip_address=$ip;
					$wrkflowmodel->is_active_wrkflw='Y';
					$wrkflowmodel->save();

				}
				$this->redirect(array('view','id'=>$model->application_id));
			}
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
		$dataProvider=new CActiveDataProvider('Applications');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Applications('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Applications']))
			$model->attributes=$_GET['Applications'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Applications the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Applications::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Applications $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='applications-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
