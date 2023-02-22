<?php

class UserController extends Controller
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
				'actions'=>array('createState','IndexState','EditState','update','GetDistrictUsingRole','CreateDistrict','IndexDistrict','EditDistrict'),
				'expression'=>'DefaultUtility::isHODNodal()',
				/* 'users'=>array('*'), */
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('createState','IndexState','EditState','update','GetDistrictUsingRole','CreateDistrict','IndexDistrict','EditDistrict'),
				'expression'=>'RolesExt::isDMUser()',
				/* 'users'=>array('*'), */
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('createState','IndexState','EditState','update','GetDistrictUsingRole','CreateDistrict','IndexDistrict','EditDistrict'),
				'expression'=>'DefaultUtility::isSECRETARY()',
				/* 'users'=>array('*'), */
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

	

	public function actionCreateState()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      
		$model=new User;
		$model_role=new UserRoleMapping;

		//echo '<pre>'; print_r($_SESSION); die;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->created_datetime=date('Y-m-d H:m:s');
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			$email_id = $_POST['User']['email'];
			$userCheck = User::model()->find('email=:email_id', array(':email_id'=>$email_id));
			//print_r($userCheck);
			
			if(!$userCheck){
				if($model->save()){
					$modelRoleMapping = new UserRoleMapping;
					$modelRoleMapping->user_id = $model->uid;
					$modelRoleMapping->role_id = $_POST['UserRoleMapping']['role_id'];
					$modelRoleMapping->department_id = $dept_id;
					$modelRoleMapping->created_time = date('Y-m-d H:m:s');
					$modelRoleMapping->is_mapping_active = 'Y';
					$modelRoleMapping->save();
					// Create User Log
						$logModel = new UserLogs;
						$logModel->edited_by = $_SESSION['uname'];
						$logModel->other_info = json_encode(array('uid'=>$_SESSION['uid'],'uname'=>$_SESSION['uname'],'email'=>$_SESSION['email']));
						$logModel->action='create_state_user';
						$before_edit = array_merge($modelRoleMapping->attributes, $model->attributes);
						$logModel->before_edit=json_encode($before_edit);
						$logModel->after_edit='';
						$logModel->remote_ip=$_SERVER['REMOTE_ADDR'];
						$logModel->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$logModel->created_time=date('Y-m-d H:i:s');
						$logModel->save();
					// END
					Yii::app()->user->setFlash('success','User has been saved successfully!');
					$this->redirect(array('create'));
				}
			}else{
				Yii::app()->user->setFlash('error','Email ID already exists!');
			}
			
		}
		
		/*$results1[] = array('district_id'=>'','distric_name'=>'--Select Disrict--');
		$results = UserExt::getDistrictsForNewNodelUser($dept_id);
		foreach($results as $key=>$val){
			$results1[] = $val;
		}*/
		$results1='';
		$this->render('createState',array(
			'model'=>$model,
			'model_role'=>$model_role,
			'datas'=>$results1,
			'dept_id'=>$dept_id,
			'action' => 'add',
		));
	}

	public function actionCreateDistrict()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      
		$model=new User;
		$model_role=new UserRoleMapping;

		//echo '<pre>'; print_r($_SESSION); die;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//UserExt::sGetUserCheckForDistrict($dept_id,$email_id,$role_id);
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->created_datetime=date('Y-m-d H:m:s');
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			$email_id = $_POST['User']['email'];
			$role_id = $_POST['UserRoleMapping']['role_id'];

			$check = UserExt::sGetUserCheckForDistrict($dept_id,$email_id,$role_id);
			
			if($check){
				if($model->save()){
					$modelRoleMapping = new UserRoleMapping;
					$modelRoleMapping->user_id = $model->uid;
					$modelRoleMapping->role_id = $_POST['UserRoleMapping']['role_id'];
					$modelRoleMapping->department_id = $dept_id;
					$modelRoleMapping->created_time = date('Y-m-d H:m:s');
					$modelRoleMapping->is_mapping_active = 'Y';
					$modelRoleMapping->save();
					// Create User Log
						$logModel = new UserLogs;
						$logModel->edited_by = $_SESSION['uname'];
						$logModel->other_info = json_encode(array('uid'=>$_SESSION['uid'],'uname'=>$_SESSION['uname'],'email'=>$_SESSION['email']));
						$logModel->action='create_district_user';
						$before_edit = array_merge($modelRoleMapping->attributes, $model->attributes);
						$logModel->before_edit=json_encode($before_edit);
						$logModel->after_edit='';
						$logModel->remote_ip=$_SERVER['REMOTE_ADDR'];
						$logModel->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$logModel->created_time=date('Y-m-d H:i:s');
						$logModel->save();
					// END
					Yii::app()->user->setFlash('success','User has been saved successfully!');
					$this->redirect(array('indexDistrict'));
				}
			}else{
				Yii::app()->user->setFlash('error','Email ID already exists!');
			}
			
		}
		
		/*$results1[] = array('district_id'=>'','distric_name'=>'--Select Disrict--');
		$results = UserExt::getDistrictsForNewNodelUser($dept_id);
		foreach($results as $key=>$val){
			$results1[] = $val;
		}*/
		$results1='';
		$this->render('createDistrict',array(
			'model'=>$model,
			'model_role'=>$model_role,
			'datas'=>$results1,
			'dept_id'=>$dept_id,
			'action' => 'add',
		));
	}

	public function actionGetDistrictUsingRole(){
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
	    $role_id = $_POST['role_id'];
        $options = '<option value="">--Select District--</option>';
      	if($role_id>0){
      		$results = UserExt::sGetDistrictByRole($dept_id,$role_id);
	      	if(count($results)){
	      		foreach ($results as $result) {
	      			$options .= "<option value='".$result['district_id']."'>".$result['distric_name']."</option>";
	      		}
	      	}	
      	}
      	
		//echo '<Select><option name="">Hello</option</Select>';
		echo $options;
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEditState($id)
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
        $id = base64_decode($id);
		//$model=new User;
		
		$model=$this->loadModel($id);
		//echo '<pre>'; print_r($model->attributes); die;
		if(isset($_POST['User']))
		{
			$email_id = $_POST['User']['email'];
			$userCheck = User::model()->find('email=:email_id AND uid!=:uid', array(':email_id'=>$email_id,':uid'=>$id));
			//print_r($userCheck);
			
			if(!$userCheck){
				$password = $model->password;
				$before_edit = $model->attributes;

				$model->attributes=$_POST['User'];
				if($_POST['User']['password']!=''){
					$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
				}else{
					$model->password=$password;
				}
				//echo '<pre>'; print_r($model->attributes); die;
				if($model->save()){
					// Create User Log
						$logModel = new UserLogs;
						$logModel->edited_by = $_SESSION['uname'];
						$logModel->other_info = json_encode(array('uid'=>$_SESSION['uid'],'uname'=>$_SESSION['uname'],'email'=>$_SESSION['email']));
						$logModel->action='update_state_user';
						$before_edit = array_merge($before_edit);
						$logModel->before_edit=json_encode($before_edit);
						$logModel->after_edit=json_encode($model->attributes);
						$logModel->remote_ip=$_SERVER['REMOTE_ADDR'];
						$logModel->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$logModel->created_time=date('Y-m-d H:i:s');
						//echo '<pre>'; print_r($loadModel->attributes); die;
						$logModel->save();
					// END
					Yii::app()->user->setFlash('success','User has updated successfully!');
					$this->redirect(array('indexState'));
				}
			}else{
				Yii::app()->user->setFlash('error','This email is already exists!');
			}
			
		}
		$this->render('editState',array(
			'model'=>$model,
			'dept_id'=>$dept_id,
			'action' => 'edit',
		));
	}

	public function actionEditDistrict($id)
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
        $id = base64_decode($id);

        //$model=new User;
		
		$model=$this->loadModel($id);
		//echo '<pre>'; print_r($model->attributes); die;
		if(isset($_POST['User']))
		{
			$email_id = $_POST['User']['email'];
			$role_id = $_POST['UserRoleMapping']['role_id'];

			$check = UserExt::sGetUserCheckForDistrict($dept_id,$email_id,$role_id);
			
			if($check){
				$password = $model->password;
				$before_edit = $model->attributes;

				$model->attributes=$_POST['User'];
				if($_POST['User']['password']!=''){
					$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
				}else{
					$model->password=$password;
				}
				//echo '<pre>'; print_r($model->attributes); die;
				if($model->save()){
					// Create User Log
						$logModel = new UserLogs;
						$logModel->edited_by = $_SESSION['uname'];
						$logModel->other_info = json_encode(array('uid'=>$_SESSION['uid'],'uname'=>$_SESSION['uname'],'email'=>$_SESSION['email']));
						$logModel->action='update_district_user';
						$before_edit = array_merge($before_edit);
						$logModel->before_edit=json_encode($before_edit);
						$logModel->after_edit=json_encode($model->attributes);
						$logModel->remote_ip=$_SERVER['REMOTE_ADDR'];
						$logModel->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$logModel->created_time=date('Y-m-d H:i:s');
						//echo '<pre>'; print_r($loadModel->attributes); die;
						$logModel->save();
					// END
					Yii::app()->user->setFlash('success','User has updated successfully!');
					$this->redirect(array('indexDistrict'));
				}
			}else{
				Yii::app()->user->setFlash('error','This email is already exists!');
			}
			
		}
		$this->render('editDistrict',array(
			'model'=>$model,
			'dept_id'=>$dept_id,
			'action' => 'edit',
		));
	}	

	public function actionIndexState()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      	$datas = UserExt::sGetUsersByDeptForListing('state',$dept_id);
      	//echo '<pre>'; print_r($datas); die;
		$this->render('indexState',array(
			'datas'=>$datas,
		));
	}
	public function actionIndexDistrict()
	{
		@session_start();
	    $dept_id = $_SESSION['dept_id'];
      	$datas = UserExt::sGetUsersByDeptForListing('district',$dept_id);
      	//echo '<pre>'; print_r($datas); die;
		$this->render('indexDistrict',array(
			'datas'=>$datas,
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

	/**,
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
