<?php

class DuIpAdminDataManagerController extends Controller
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
/*	public function accessRules()
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
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionConfY()
	{

		$commencementMaster=3;
		$sql=" select du_pis_call_log.caf_id,du_pis_mou_detail.mrn_sub_number ,du_pis_mou_upload.company_name,bo_application_submission.application_status
				 from du_pis_call_log 
				 INNER JOIN du_pis_mou_detail ON du_pis_mou_detail.id=du_pis_call_log.pis_mou_detail_id 
				 INNER JOIN du_pis_mou_upload on du_pis_mou_upload.id=du_pis_mou_detail.pis_mou_parent_id
				 LEFT JOIN bo_application_submission on bo_application_submission.submission_id=du_pis_call_log.caf_id 
				 WHERE du_pis_call_log.status='Y'
				 AND du_pis_call_log.timeline_for_grounding='$commencementMaster'";
				$result = Yii::app()->db->createCommand($sql)->queryAll(); 
		        $this->render('confy',array('res'=>$result));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{



		$model=new DuIpAdminDataManager;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DuIpAdminDataManager']))
		{
			$model->attributes=$_POST['DuIpAdminDataManager'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['DuIpAdminDataManager']))
		{
			$model->attributes=$_POST['DuIpAdminDataManager'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('DuIpAdminDataManager');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DuIpAdminDataManager('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DuIpAdminDataManager']))
			$model->attributes=$_GET['DuIpAdminDataManager'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DuIpAdminDataManager the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DuIpAdminDataManager::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DuIpAdminDataManager $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='du-ip-admin-data-manager-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
