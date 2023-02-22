<?php

class UserCreateController extends Controller
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
				'actions'=>array('createUser','listUser'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
				/* 'users'=>array('*'), */
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionListUser()
	{
		
		$sql="SELECT *,u.is_active as uis_active FROM bo_user u
LEFT JOIN bo_user_role_mapping rm ON rm.user_id=u.uid
LEFT JOIN bo_roles r ON rm.role_id=r.role_id
LEFT JOIN bo_departments d ON d.dept_id=u.dept_id
LEFT JOIN bo_district ds ON ds.district_id=u.disctrict_id
WHERE u.is_active=1 AND r.role_id IS NOT NULL ORDER BY u.uid DESC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$datas=$command->queryAll();
		
		$this->render('listUser',array(
			'datas'=>$datas,
		));
	}

	public function actionCreateUser()
	{
		$model=new User;
		$model_role=new UserRoleMapping;
		
		if(isset($_POST['User']))
		{
			//echo '<pre>'; print_r($_POST['User']); die;
			$model->attributes=$_POST['User'];
			$model->created_datetime=date('Y-m-d H:m:s');
			$model->password=hash_hmac('sha1', $_POST['User']['password'], PASSWORD_SECRET_KEY);
			$email_id 	= $_POST['User']['email'];
			$role_id 	= $_POST['UserRoleMapping']['role_id'];
			$dept_id 	= $_POST['User']['dept_id'];

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
					$this->redirect(array('listUser'));
				}
			}else{
				Yii::app()->user->setFlash('error','Email ID already exists!');
			}
			
		}
		
		$this->render('createUser',array(
			'model'=>$model,
			'model_role'=>$model_role,
			'action' => 'add',
		));
	}
}
