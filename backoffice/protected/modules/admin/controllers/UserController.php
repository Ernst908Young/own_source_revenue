<?php

class UserController extends Controller
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
			array('allow',
				'actions'=>array('createHODUser','listHODUser','update'),
				'expression'=>'DefaultUtility::isSubAdmin()',
				),
			array('deny',  // deny all users
				'users'=>array('*'),
			),

		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	protected function getDepartments(){

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->created_datetime=strtotime(date('Y-m-d H:m:s'));
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			if($model->save()){
				Yii::app()->user->setFlash('Success', "Created successfully.");
				$this->redirect(Yii::app()->user->returnUrl);
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if(!empty($_POST['User']))
				$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			if($model->save()){
				Yii::app()->user->setFlash('Success', "Updated successfully.");
				$this->redirect(Yii::app()->user->returnUrl);
				exit;
				// $this->redirect(array('view','id'=>$model->uid));
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
	private function isEmailExist($email){
		$criteria=new CDbCriteria;
		$criteria->condition="email=:email";
		$criteria->params=array(":email"=>$email);
		$model=User::model()->find($criteria);
		// echo "<pre>";print_r($model);die;
		if($model===null)
			return false;
		return true;
	}
	/**
	* this function is used to create hod user
	*/
	public function actionCreateHODUser(){
		$model=new User;
		// echo "<pre>";print_r($_POST);die;
		if(isset($_POST['User'])){
			if($this->isEmailExist($_POST['User']['email'])){
				Yii::app()->user->setFlash('Error', "Email Already Exist.");
				$this->redirect(Yii::app()->createAbsoluteUrl('admin/user/createHODUser'));
				exit;
			}
			$model->attributes=$_POST['User'];
			$model->disctrict_id=6;
			$model->created_datetime=strtotime(date('Y-m-d H:m:s'));
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			if($model->save()){
				$roleModel=new UserRoleMapping;
				$roleModel->user_id=$model->uid;
				$roleModel->role_id=62;
				$roleModel->department_id=$_POST['User']['dept_id'];
				$roleModel->created_time=date("Y-m-d H:i:s");
				if($roleModel->save()){
					Yii::app()->user->setFlash('Success', "Updated successfully.");
					$this->redirect(Yii::app()->createAbsoluteUrl('admin/user/createHODUser'));
					exit;	
				}
				else{
					Yii::app()->user->setFlash('Error', "Could not map role. Please contact with admin.");
					$this->redirect(Yii::app()->createAbsoluteUrl('admin/user/createHODUser'));
					exit;
				}
			}
			else{
				$err="";
				$errors=$model->geterrors();
				foreach ($errors as $key => $errr) {
					foreach ($errr as $key => $errs) {
						$err.="<li>$errs</li>";						
					}
				}
				Yii::app()->user->setFlash('Error', "Please check following Errors.".$err);
				$this->redirect(Yii::app()->createAbsoluteUrl('admin/user/createHODUser'));
				exit;
			}
		}
		$this->render('createHODUser',array(
			'model'=>$model,
		));
	}

	public function actionListHODUser(){
		$criteria=new CDbCriteria;
		$criteria->condition="rm.role_id=62 and rm.is_mapping_active='Y' and t.is_active=1";
		$criteria->join="INNER JOIN bo_user_role_mapping rm ON t.uid=rm.user_id";
		$model=User::model()->findAll($criteria);
		// echo "<pre>";print_r($model);die;
		$this->render("listHOD",array("model"=>$model));
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
