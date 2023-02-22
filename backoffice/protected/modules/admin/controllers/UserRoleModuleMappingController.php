<?php

class UserRoleModuleMappingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'expression'=>'Utility::isSuperAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create'),
				'expression'=>'RolesExt::isAdminUser()',
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
		$model=new UserRoleModuleMapping;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserRoleModuleMapping']))
		{
			$err=0;
			foreach ($_POST['UserRoleModuleMapping']['module_id'] as $key => $modl) {
				$model=new UserRoleModuleMapping;
				$model->attributes=$_POST['UserRoleModuleMapping'];
				$model->module_id=$modl;
				$model->created_date_time=date('Y-m-d H:i:s');
				$model->save();

				// echo "<pre>";print_r($model->attributes);print_r($_POST);die;
				
			}
			if(!$err){
				Yii::app()->user->setFlash('Success', "Created Successfully");
				
			}
			else{
				Yii::app()->user->setFlash('Error', "Couldn't Create Successfully");

			}
			$this->redirect(array('create'));
			exit;
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

		if(isset($_POST['UserRoleModuleMapping']))
		{
			$err=0;
			foreach ($_POST['UserRoleModuleMapping']['module_id'] as $key => $modl) {
				$model->attributes=$_POST['UserRoleModuleMapping'];
				$model->module_id=$modl;
				$model->created_date_time=date('Y-m-d H:i:s');
				$model->save();

				// echo "<pre>";print_r($model->attributes);print_r($_POST);die;
				
			}
			if(!$err)
				$this->redirect(array('view','id'=>$model->id));
			exit;
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
		$dataProvider=new CActiveDataProvider('UserRoleModuleMapping');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserRoleModuleMapping('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserRoleModuleMapping']))
			$model->attributes=$_GET['UserRoleModuleMapping'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserRoleModuleMapping the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserRoleModuleMapping::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserRoleModuleMapping $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-role-module-mapping-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
