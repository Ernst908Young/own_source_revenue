<?php

class ApplicationsFieldsMappingController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ApplicationsFieldsMapping;
		$modelDept=new Departments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ApplicationsFieldsMapping']))
		{
			$fields=$_POST['ApplicationsFieldsMapping'];
			$app_id=$fields['application_id'];
			$count=1;
			if(!isset($fields['field_id']) || empty($fields['field_id'])){
				Yii::app()->user->setFlash('Error',"Please Select Fields First");
				$this->redirect(Yii::app()->createAbsoluteUrl('admin/applicationsFieldsMapping/create'));
				exit;
			}
			foreach ($fields['field_id'] as $field) {
				if($count++<>1)
					$model=new ApplicationsFieldsMapping;
				$model->application_id=$app_id;
				$model->field_id=$field;
				if(isset($fields['field_placeholder'][$field]) && !empty($fields['field_placeholder'][$field]))
					$model->field_value=$fields['field_placeholder'][$field];
				if(isset($fields['field_name'][$field]) && !empty($fields['field_name'][$field]))
					$model->field_name=$fields['field_name'][$field];
				if(isset($fields['field_max_length'][$field]) && !empty($fields['field_max_length'][$field]))
					$model->field_max_length=$fields['field_max_length'][$field];
				if(isset($fields['field_min_length'][$field]) && !empty($fields['field_min_length'][$field]))
					$model->field_min_length=$fields['field_min_length'][$field];
				if(isset($fields['field_class'][$field]) && !empty($fields['field_class'][$field]))
					$model->field_class=$fields['field_class'][$field];
				if(isset($fields['field_autocomplete'][$field]) && !empty($fields['field_autocomplete'][$field]))
					$model->field_autocomplete=$fields['field_autocomplete'][$field];
				if(isset($fields['field_autofocus'][$field]) && !empty($fields['field_autofocus'][$field]))
					$model->field_autofocus=$fields['field_autofocus'][$field];
				if(isset($fields['each_field_placeholder'][$field]) && !empty($fields['each_field_placeholder'][$field]))
					$model->each_field_placeholder=$fields['each_field_placeholder'][$field];
				if(isset($fields['each_field_value'][$field]) && !empty($fields['each_field_value'][$field]))
					$model->each_field_value=$fields['each_field_value'][$field];
				if(isset($fields['field_file_type'][$field]) && !empty($fields['field_file_type'][$field]))
					$model->field_file_type=$fields['field_file_type'][$field];
				//onclick function
				if(isset($fields['field_onclick'][$field]) && !empty($fields['field_onclick'][$field]))
					$model->field_onclick=$fields['field_onclick'][$field];
				
				if(isset($fields['field_onclick_field_placeholder'][$field]) && !empty($fields['field_onclick_field_placeholder'][$field]))
					$model->field_onclick_field_placeholder=$fields['field_onclick_field_placeholder'][$field];

				if(isset($fields['field_onclick_field_name'][$field]) && !empty($fields['field_onclick_field_name'][$field]))
					$model->field_onclick_field_name=$fields['field_onclick_field_name'][$field];
				
				if(isset($fields['field_onclick_add_no_fields'][$field]) && !empty($fields['field_onclick_add_no_fields'][$field]))
					$model->field_onclick_add_no_fields=$fields['field_onclick_add_no_fields'][$field];


				$model->is_mapping_active=$fields['is_mapping_active'];
				$model->created_on=date('Y-m-d');
				$model->remote_server=$_SERVER['REMOTE_ADDR'];
				$model->user_agent=$_SERVER['HTTP_USER_AGENT'];
				$model->save();
			}
			$modelApp=Applications::model()->findByPk($app_id);
			if($modelApp===null)
				throw new CHttpException(404,'The requested page does not exist.');
			if(isset($_POST['ApplicationsFieldsMapping_app_custom_css'])){
				$modelApp->is_custom_css='Y';
				$modelApp->custom_css_val=$_POST['custom_css_val'];
			}
			if(isset($_POST['ApplicationsFieldsMapping']['pre_filled']) && count($_POST['ApplicationsFieldsMapping']['pre_filled'])>0)
				$modelApp->show_default_fields=json_encode($_POST['ApplicationsFieldsMapping']['pre_filled']);
			$modelApp->created_date=date('Y-m-d');
			$modelApp->remote_ip=$_SERVER['REMOTE_ADDR'];
			if($modelApp->save()){
				Yii::app()->user->setFlash("success","Successfully Mapped");
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				exit;
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

		if(isset($_POST['ApplicationsFieldsMapping']))
		{
			$fields=$_POST['ApplicationsFieldsMapping'];
			$app_id=$fields['application_id'];
			$model->attributes=$_POST['ApplicationsFieldsMapping'];
			$model->application_id=$app_id;
			if($model->save()){
				$modelApp=Applications::model()->findByPk($app_id);
				if($modelApp===null)
					throw new CHttpException(404,'The requested page does not exist.');
				if($_POST['ApplicationsFieldsMapping_app_custom_css']){
					$modelApp->is_custom_css='Y';
					$modelApp->custom_css_val=$_POST['custom_css_val'];
				}
				if(isset($_POST['ApplicationsFieldsMapping']['pre_filled']) && count($_POST['ApplicationsFieldsMapping']['pre_filled'])>0)
					$modelApp->show_default_fields=json_encode($_POST['ApplicationsFieldsMapping']['pre_filled']);

				if($modelApp->save())
					$this->redirect(array('view','id'=>$model->app_mapping_id));
			}
			print_r($model->geterrors());

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
		$dataProvider=new CActiveDataProvider('ApplicationsFieldsMapping');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ApplicationsFieldsMapping('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ApplicationsFieldsMapping']))
			$model->attributes=$_GET['ApplicationsFieldsMapping'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApplicationsFieldsMapping the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ApplicationsFieldsMapping::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApplicationsFieldsMapping $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='applications-fields-mapping-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
