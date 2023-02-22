<?php

class MomController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
				'actions'=>array('index','view','create','ViewDetails','PrintMom'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Mom;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Mom']))
		{
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$ip = $_SERVER['REMOTE_ADDR'];
				
			$model->attributes=$_POST['Mom'];
			$caf_id_text = $_POST['Mom']['caf_id'];
			$mom_date = date("Y-m-d",strtotime($_POST['Mom']['mom_date']));
			$caf_id_text_arr = explode("~",$caf_id_text);
			$model->caf_id 			= $caf_id_text_arr[0];
			$model->company_name 	= $caf_id_text_arr[1];
			$model->mom_date 		= $mom_date;
			$model->created_time 	= date('Y-m-d H:i:s');
			$model->ip_address 	= $ip;
			$model->user_agent 	= $ua;
			 
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
			"action"=>'add'
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

		if(isset($_POST['Mom']))
		{
			$model->attributes=$_POST['Mom'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->mom_id));
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
		$model = new Mom;

		$datas = $model::model()->findAll(array('order' => 'mom_id DESC'));

		//echo '<pre>';print_r($datas); die;
		$this->render('index',array(
			'datas'=>$datas,
		));
	}
	
	public function actionViewDetails(){
		$id = base64_decode($_GET['id']);
		$model = new Mom;

		$datas = $model::model()->findAll(array("condition"=>"caf_id=$id",'order' => 'mom_id DESC'));

		//echo '<pre>';print_r($datas); die;
		$this->render('viewDetails',array(
			'datas'=>$datas,
			'id' => $id,
		));
	}



public function actionPrintMom(){
		
		$id = base64_decode($_GET['id']);
		$model = new Mom;
		$datas = $model::model()->findAll(array("condition"=>"caf_id=$id",'order' => 'mom_id DESC'));
		$content=$this->renderPartial('PrintMom',array('datas'=>$datas,'id' => $id),true);
		$name="mom.pdf";
		TCPDFView::generatePDFWithHindiFont(utf8_encode($content),$name);
		//Utility::generatePdfApp($content,$name);
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mom('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mom']))
			$model->attributes=$_GET['Mom'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mom the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mom::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mom $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mom-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
