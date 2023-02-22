<?php
	class DefaultUtility{
		public static function getAllDept(){
				$model = new DepartmentsExt;
				$allDept = $model->getDept();
				return $allDept;
		}
		public static function getAllDeptFiltered($sub_id,$role_id){
			$dist=DefaultUtility::getDisttId($sub_id);
			$sql='';
			$active='Y';
			if($role_id==4)
			$sql="SELECT * FROM bo_departments dept
				INNER JOIN bo_user_role_mapping rm
				ON dept.dept_id=rm.department_id AND rm.role_id=5
				WHERE dept.is_department_active=1 AND rm.is_mapping_active=:active";
			 $sql="SELECT uid,full_name, usr.dept_id,dept.department_name FROM bo_user usr
				   INNER JOIN bo_departments dept
				   ON dept.dept_id=usr.dept_id
				   WHERE usr.disctrict_id=:dist AND usr.dept_id!=1 AND dept.is_department_active=1 group by usr.dept_id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			if($role_id==4)
			   $command->bindParam(":active",$active,PDO::PARAM_STR);
			$command->bindParam(":dist",$dist,PDO::PARAM_STR);
			// $command->bindParam(":uid",$user_id,PDO::PARAM_INT);
			$deptList=$command->queryAll();
			// print_r($appList);die;	
			if($deptList===false)
				return false;
			return $deptList;
		}
		public static function getDisttId($sub_id){
			$sql="SELECT landrigion_id  FROM bo_application_submission WHERE submission_id=:sub_id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			//$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
			$command->bindParam(":sub_id",$sub_id,PDO::PARAM_INT);
			$dist=$command->queryRow();
			// print_r($appList);die;	
			if($dist===false)
				return false;
			return $dist['landrigion_id'];
		}
		public static function getDeptApp($dept_id){
				$model = new ApplicationExt;
				$dept_id = $model->getAppFromDept($dept_id);
				//print_r($dept_id);die;
				return $dept_id;
		}
			/**
			* Function is used to check for super admin role
			*@author : Hemant Thakur
			*@param : int(role_id)
			*@return : Boolean(true/false)
			*/
			static function isSuperAdmin(){
				@session_start();
				if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
					return false;
				$uid=$_SESSION['uid'];
				$rolesModel=new RolesExt;
				$role_id=$rolesModel->getUserRoleViaId($uid);
				if($role_id['role_id']==1)
					return true;
				else
					return false;
			}
			/**
			* Function is used to check for valid Investor Login
			*@author : Hemant Thakur
			*@param : 
			*@return : Boolean(true/false)
			*/
			static function isValidLogin(){
				@session_start();
				if(!isset($_SESSION['sso_token']))
					return false;
				if(strlen($_SESSION['sso_token'])>=32)
					return true;
				return false;
			}

			public static function sanatizeString($string){
				$string=strip_tags(trim($string));
				
				return $string;
			}

			public static function postViaCurl($url, $params=NULL) {
				$url = DefaultUtility::sanatizeString($url);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($ch);
				if ($output === false) { 
					$error = array();
					$error['ERROR_MSG'] = curl_error($ch);
					$error['ERROR_CODE'] = curl_errno($ch);
					$error['url'] = $url;
					$return = array();
					$return['STATUS_ID'] = '222';
					$return['STATUS_MSG'] = 'CURL_ERROR';
					$return['RESPONSE'] = $error;

					$error_message = "cURL ERROR: \t " . curl_errno($ch) . " - " . curl_error($ch);
					Yii::log($error_message, 'error', 'system.*');
					return json_encode($return);
				} 
				else {
					return $output;
				}
			}
			/**
			* This function is used to check the noodles role
			* @author : Hemant Thakur
			* 
			*/
			static function isNoodalOfficer(){
				@session_start();
				if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
					return false;
				$uid=$_SESSION['uid'];
				$rolesModel=new RolesExt;
				$role_id=$rolesModel->getUserRoleViaId($uid);
				if($role_id['role_id']==3)
					return true;
				else
					return false;
			}
			static function isNoodalAgency(){
				@session_start();
				if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
					return false;
				$uid=$_SESSION['uid'];
				$rolesModel=new RolesExt;
				$role_id=$rolesModel->getUserRoleViaId($uid);
				if($role_id['role_id']==7)
					return true;
				else
					return false;
			}
			
			static function isAdmin() {
				@session_start();
				if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
					return false;
				$uid = $_SESSION['uid'];
				$rolesModel = new RolesExt;
				$role_id = $rolesModel->getUserRoleViaId($uid);
				if ($role_id['role_id'] == 2)
					return true;
				else
					return false;
			}
	}
