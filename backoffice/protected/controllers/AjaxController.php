<?php
class AjaxController extends Controller
{	
	/**
	 * this function is used to get all Department's and district User
	 *@param: dept_id int, district_id int
	 *author : SANTOSH KUMAR
	 */
	public function actionUserDetails()
	{
		@session_start();
			//echo "kjkj".$_POST['dept_id'];
			if(isset($_POST['dept_id'])){
				$dept_id=$_POST['dept_id'];
				$disctrict_id=$_POST['disctrict_id'];
				$uid=$_SESSION['uid'];
				$model = new UserExt;
				$userList = $model->getUserDetails($dept_id,$disctrict_id,$uid);
				echo json_encode($userList); die;
			}
			
	}
	/**
	 * this function is used to get all the department detail
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionTest(){
		@session_start();
		$dept_id=$_GET['dept'];
		$active='Y';
			$app_status='F';
			$pending='P';
			$uid=$_SESSION['uid'];
			$emailid=$_SESSION['email'];
			$role_id=RolesExt::getUserRoleViaId($uid);
			$distt=UserExt::getUsersAllDistt($emailid);
			$usersAllDistt=0;
			if($distt)
				$usersAllDistt=implode(",", $distt);
			$sql="SELECT DISTINCT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status,appfl.appr_lvl_id FROM bo_user_role_mapping rm
                  INNER JOIN bo_application_forward_level appfl 
                  ON appfl.next_role_id = rm.role_id
                  INNER JOIN bo_application_submission appsb
                  ON appfl.app_sub_id=appsb.submission_id
                  INNER JOIN bo_application_verification_level appvl
                  ON appsb.submission_id=appvl.app_Sub_id
                  INNER JOIN bo_user usr
                  ON appsb.landrigion_id=usr.disctrict_id 
                  WHERE appfl.forwarded_dept_id=:dept_id AND is_mapping_active=:active AND appsb.landrigion_id IN ($usersAllDistt) AND appfl.next_role_id=:role_id  AND appvl.approv_status=:app_status AND appfl.approv_status=:pending order by appfl.app_sub_id";
         /*			$sql="SELECT DISTINCT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status FROM bo_user_role_mapping rm
				  INNER JOIN bo_application_verification_level appvl
				  ON appvl.next_role_id = rm.role_id
				  INNER JOIN bo_application_submission appsb
				  ON appvl.app_sub_id=appsb.submission_id
				  INNER JOIN bo_application_forward_level appfl
				  ON appfl.app_Sub_id=appvl.app_sub_id
				  INNER JOIN bo_user usr
				  ON appsb.landrigion_id=usr.disctrict_id 
				  WHERE appfl.forwarded_dept_id=:dept_id AND is_mapping_active=:active AND appvl.approv_status=:app_status AND appfl.approv_status=:pending and  usr.uid in (SELECT uid FROM bo_user where email=:emailid order by uid)"; */
        /*			$sql="SELECT rm.role_id,appfl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status FROM bo_application_forward_level appfl
				  INNER JOIN  bo_user_role_mapping rm
				  ON appfl.next_role_id = rm.role_id
					INNER JOIN  bo_application_submission appsb
					ON appfl.app_sub_id=appsb.submission_id
					WHERE is_mapping_active=:active  AND appsb.application_status=:app_status AND appfl.approv_status=:pending AND rm.role_id=:role_id AND rm.user_id=:uid"; */
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
			$command->bindParam(":dept_id",$dept_id,PDO::PARAM_STR);
			$command->bindParam(":pending",$pending,PDO::PARAM_STR);
			$command->bindParam(":role_id",$role_id['role_id'],PDO::PARAM_INT);
			// $command->bindParam(":distt",$distt['disctrict_id'],PDO::PARAM_INT);
			//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			// $command->bindParam(":emailid",$emailid,PDO::PARAM_STR);
			$appList=$command->queryAll();	
			if($appList===false)
				return false;
			return $appList;
	}
	public function actionAlldept()
	{
			$model = new DepartmentsExt;
			$allDept = $model->getDept();
			echo json_encode($allDept); die;
	}
	/**
	 * this function is used to get all the Roles
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionGetallroles(){
		$model = new RolesExt;
		$allRoles = $model->getAllRoles();
		echo json_encode($allRoles); die;

	}
	/**
	 * this function is used to get all the application from particular dept
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionDeptApp()
	{
			if(isset($_POST['dept_id'])){
				$id=$_POST['dept_id'];
				$model = new ApplicationExt;
				$deptAppList = $model->getAppFromDept($id);
				echo json_encode($deptAppList); die;
			}
			
	}
	/**
	 * this function is used to get all Department's User
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionAlldeptusers()
	{
			if(isset($_POST['dept_id'])){
				$id=$_POST['dept_id'];
				$model = new UserExt;
				$userList = $model->getDeptUsers($id);
				echo json_encode($userList); die;
			}
			
	}
	/**
	 * this function is used to get all user's roles according to the dept
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionGetdeptallroles()
	{
			if(isset($_POST['dept_id'])){
				$id=$_POST['dept_id'];
				$model = new RolesExt;
				$rolesList = $model->getDeptUsersRoles($id);
				echo json_encode($rolesList); die;
			}
			
	}
	
	public function actionGetDeptUserRoles()
	{
			if(isset($_POST['dept_id'])){
				@extract($_POST);
				if(isset($dept_id)){
					$sql = "Select * FROM bo_user_role_mapping WHERE department_id='$dept_id'";
				}
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$rolesList = $command->query();
				echo json_encode($rolesList); die;
			}else{
				echo "Invalid"; die;
			}
			
	}
	
	/**
	 * this function is used to get Roles name from ID
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionGetrolesnameviaid(){
			if(isset($_POST['roleid'])){
				$id=$_POST['roleid'];
				$model = new RolesExt;
				$rolesName = $model->getRolesViaId($id);
				echo json_encode($rolesName); die;
			}
	}

		/**
	 * this function is used check whether field is already exist in our database or not
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionCheckfieldname()
	{
			if(isset($_POST['field_name'])){
				$field_name=strtolower($_POST['field_name']);
				$criteria= new CDbCriteria();
				$criteria=new CDbCriteria;
				$criteria->condition='field_name=:field_name';
				$criteria->params=array(':field_name'=>$field_name);
				$field_id=Filelds::model()->find($criteria);
				if(empty($field_id))
					echo "NONE";
				else
					print_r(json_encode($field_id->attributes));
				die;
				
			}
			
	}

	/**
	 * this function is used to get all the fields from the database
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionGetfielddetail(){
		if(isset($_POST['f_id'])){
			$f_id=$_POST['f_id'];
			$criteria= new CDbCriteria();
			$criteria=new CDbCriteria;
			$criteria->condition='field_id=:f_id';
			$criteria->params=array(':f_id'=>$f_id);
			$field_id=Filelds::model()->find($criteria);
			if(!empty($field_id))
				print_r(json_encode($field_id->attributes));
			else
				echo "NONE";
			die;
		}

	}
}
?>