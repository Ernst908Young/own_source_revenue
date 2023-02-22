<?php

class UserController extends Controller
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
				'actions'=>array('index','view','create','admin','update','edit'),
				'expression'=>'DefaultUtility::isHODNodal()',
				/* 'users'=>array('*'), */
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
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      
		$model=new User;
		$modelRole = new UserRoleMapping;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->created_datetime=date('Y-m-d H:m:s');
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			if($model->save()){
				$modelRoleMapping = new UserRoleMapping;
				$modelRoleMapping->user_id = $model->uid;
				$modelRoleMapping->role_id = '3';
				$modelRoleMapping->department_id = $_POST['User']['dept_id'];
				$modelRoleMapping->created_time = date('Y-m-d H:m:s');
				$modelRoleMapping->is_mapping_active = 'Y';
				$modelRoleMapping->save();
				
				Yii::app()->user->setFlash('success','User has been saved successfully!');
				$this->redirect(array('create'));
			}
		}
		
		$results1[] = array('district_id'=>'','distric_name'=>'--Select Disrict--');
		$results = UserExt::getDistrictsForNewNodelUser($dept_id);
		foreach($results as $key=>$val){
			$results1[] = $val;
		}
		$this->render('create',array(
			'model'=>$model,
			'modelRole'=>$modelRole,
			'datas'=>$results1,
			'dept_id'=>$dept_id,
			'action' => 'add',
		));
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      
		$model=new User;
		
		//$pdata=User::model()->findByPk(101);
		//echo 'Hello <pre>'; print_r($pdata); die;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$uid = $_POST['User']['uid'];
			$UserObj = User::model()->findByPk($uid);
			$UserObj->attributes = $_POST['User'];
			if($_POST['User']['password']!=''){
				$UserObj->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			}
			else
				$UserObj->password=$UserObj->password;

			if($UserObj->save()){
				Yii::app()->user->setFlash('success','User has updated successfully!');
				$this->redirect(array('edit'));
			}
			
		}
		$results1[] = array('district_id'=>'','distric_name'=>'--Select Disrict--');
		$results = UserExt::getDistrictsForEditNodelUser($dept_id);
		foreach($results as $key=>$val){
			$results1[] = $val;
		}
		//echo 'Hello <pre>'; print_r($results1); die;
		$this->render('edit',array(
			'model'=>$model,
			'datas'=>$results1,
			'dept_id'=>$dept_id,
			'action' => 'edit',
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->uid));
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>