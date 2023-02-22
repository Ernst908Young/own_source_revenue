<?php
class AjaxController extends Controller
{	
	
	public function actionTestFunction(){
		$mobile=IncentiveSchemes::getboUserMobileFromRoleID(9,33);
		$sub_id=9;
		$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
		$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has submitted the application for your approval.\r\n";
		$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has verified your application and sent for further approval.\r\n";
		IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
		IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
	}
	public function actionTest(){
		$this->generateInPrincipleLetter(2748); 

	}
	private function getEstateAreaByEstateid($id){
			$dataArray="";
			$criteria=new CDbCriteria;
			// $criteria->select="estate_link";
			$criteria->condition="land_estate_id=:land_estate_id";
			$criteria->params=array(":land_estate_id"=>$id);
			$estates=LaEstates::model()->find($criteria);
			// echo "<pre>"; print_r($estates); die;	
				if(!empty($estates))
					$dataArray=$estates->estate_link;
			echo $dataArray;
			exit;	
		}
		/**
		 * this function is used to get all the department detail
		 *@param: none
		 *author : Hemant thakur
		 */
		private function getEstateByDistrictid($id){
			$dataArray=array();
			$sql = "SELECT *
					FROM la_auction_plots
					INNER JOIN la_auction_detail
					ON la_auction_plots.auc_plot_id=la_auction_detail.plot_id
					WHERE la_auction_detail.is_active='Y' 
					AND la_auction_detail.auc_status='O'
					AND la_auction_detail.estate_id=$id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$Plots=$command->queryAll();
			if(!empty($Plots))
				foreach ($Plots as $k => $v){
					// if($this->checkIsUserAlreadyFiledforPlot($v['auc_plot_id'],$id)) {
					// 	$now = strtotime(date("Y-m-d"));
					// 	$StartDate = strtotime($v['auc_start_date']);
					// 	$EndDate = strtotime($v['auc_end_date']);
					// 	if($now >= $StartDate && $now <= $EndDate)
					// 		$dataArray[]=array("plot_id" => $v['auc_plot_id'],'area_name'=>$v['area_name'],'plot_area'=>$v['plot_area']);
					// }
					$now = strtotime(date("Y-m-d"));
					$StartDate = strtotime($v['auc_start_date']);
					$EndDate = strtotime($v['auc_end_date']);
					if($now >= $StartDate && $now <= $EndDate)
						$dataArray[]=array("plot_id" => $v['auc_plot_id'],'area_name'=>$v['area_name'],'plot_area'=>$v['plot_area']);
				}
			return $dataArray;
			exit;
		}

		private function checkIsUserAlreadyFiledforPlot($estate_id){
			@session_start();
			$response=true;
			$uid = $_SESSION['RESPONSE']['user_id'];
			$criteria=new CDbCriteria;
			$criteria->condition="application_id=8 and user_id=:user_id and application_status!='I'";
			$criteria->params=array(":user_id"=>$uid);
			$apps=ApplicationSubmission::model()->findAll($criteria);
			foreach ($apps as $key => $app) {
				$app = json_decode($app->field_value);
				foreach ($app->area_square_meter as $key => $Aucplot)
					if($app->estate == $estate_id)
						$response=false;
			}
			return $response;
		}

	private function getEstatesByDistrictid($id){
			$dataArray=array();
			$sql = "SELECT la_auction_detail.auc_id,la_estates.land_estate_id,la_estates.land_estate_name,la_estates.estate_area
					FROM la_estates
					INNER JOIN la_auction_detail
					ON la_estates.land_estate_id=la_auction_detail.estate_id
					WHERE la_auction_detail.is_active='Y' 
					AND la_auction_detail.auc_status='O'
					AND la_auction_detail.district_id=$id
					GROUP BY la_auction_detail.estate_id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$Plots=$command->queryAll();
			if(!empty($Plots))
				foreach ($Plots as $k => $v)
					if($this->checkIsUserAlreadyFiledforPlot($v['land_estate_id']))
						$dataArray['RESPONSE'][]=array("land_estate_id" => $v['land_estate_id'],'land_estate_name'=>$v['land_estate_name']);
			return $dataArray;
			exit;
		}
	public function actionIndex(){
			if(!empty($_POST['requestTO']) && !empty($_POST['dis_id']) ){
				print_r(json_encode($this->$_POST['requestTO']($_POST['dis_id'])));
			}
			else{
				echo "";
			}
			exit;
		}
	/**
	 * this function is used to get all the department detail
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionAlldept()
	{
			$model = new DepartmentsExt;
			$allDept = $model->getDept();
			echo json_encode($allDept); die;
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
				$Dept_app = $model->getAppFromDept($id);
				echo json_encode($Dept_app); die;
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
	* @author : Hemant Thakur
	*/
	public function actionRevertBackToDept(){
		@session_start();
		/* echo "<pre>";
		print_r($_POST);
		print_r($_SESSION);die; */
		if(isset($_POST['sub_id']) && isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$uid=$_SESSION['uid'];
			extract($_POST);
			$dept_id=UserExt::getUserDept($uid);
			$criteria= new CDbCriteria();
			$criteria->condition='app_Sub_id=:sub_id AND forwarded_dept_id=:dept_id';
			$criteria->params=array(':sub_id'=>$sub_id,":dept_id"=>$dept_id['dept_id']);
			$criteria->order='appr_lvl_id DESC';
			$model = ApplicationForwardLevel::model()->find($criteria);
			if($model->approv_status=='V'){
				print_r(json_encode(array('STATUS'=>'Error: Already Updated By SomeBody')));
				exit;
			}
			$model->verifier_user_comment=$comments;
			$model->reason_for_delay = @$reason_for_delay;
			$model->comment_date=date('Y-m-d H:m:s');
			$model->approv_status='V';
			$model->verifier_user_id=$uid;
			if($model->save()){
				$appFlow=new ApplicationFlowLogs;
				$user_role_id=RolesExt::getUserRoleViaId($uid);
				$appFlow->submission_id=$sub_id;
				$appFlow->approver_role_id=$user_role_id['role_id'];
				$appFlow->approval_user_id=$uid;
				$appFlow->approver_comments=$comments;
				$appFlow->created_date_time=date("Y-m-d H:m:s");
				$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
				$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
				$appFlow->application_status='RB';
				$appFlow->save();
				print_r(json_encode(array('STATUS'=>'Success: successfully Revert Back')));
				exit;
			}
			else{
				print_r(json_encode(array('STATUS'=>'Error: Error While Updating.')));
				exit;
			}
			
		}
		else{
			print_r(json_encode(array('STATUS'=>'Error: Please Login')));

		}
			
	}
	/**
	 * this function is used check last Level of the verifier
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionCheckForLast()
	{	
			@session_start();
			if(isset($_POST['user_id']) && isset($_POST['app_id']) && isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
				extract($_POST);
				$user_id=$_SESSION['uid'];
				$criteria= new CDbCriteria();
				$criteria->select='role_id';
				$criteria->condition='user_id=:uid';
				$criteria->params=array(':uid'=>$user_id);
				$Usermodel = UserRoleMapping::model()->find($criteria);
				$criteria->select='role_id';
				$criteria->condition='app_id=:app_id';
				$criteria->order='wrkflw_id ASC';
				$criteria->params=array(':app_id'=>$app_id);
				$model = AppWorkflow::model()->findAll($criteria);
				$nexroleid='';
				$role_id_array=array();
				foreach ($model as $model) {
					$role_id_array[]=$model->role_id;
				}
				$user_role_id=$Usermodel->role_id;
				$prev_key_val=array_search($user_role_id, $role_id_array);
				if(isset($role_id_array[$prev_key_val+1]))
						$nexroleid=$role_id_array[$prev_key_val+1];
					else
						$nexroleid=NULL;
				if(empty($nexroleid))
					print_r(json_encode(array('STATUS'=>'LAST')));
				else
					print_r(json_encode(array('STATUS'=>'NOT LAST')));
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
	/**
	 * this function is used to Revert back to user
	 *@param: none
	 *author : Hemant thakur
	 */
	public function actionRevertApplicationtoPrevious(){
		@session_start();
		//isset($_SESSION['uid']) && !empty($_SESSION['uid']) &&
		if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
				extract($_POST);
				//$uid=$_SESSION['uid'];
				$uid=$_POST;
					$criteria=new CDbCriteria;
					$criteria->select='role_id';
					$criteria->condition='user_id=:uid';
					$criteria->params=array(':uid'=>$uid);
					$Usermodel = UserRoleMapping::model()->find($criteria);
					$prevroleid='';
					$criteria->select='next_role_id';
					$criteria->condition='app_sub_id=:sub_id AND approv_status=:status';
					$criteria->params=array(':sub_id'=>$sub_id,'status'=>'V');
					$criteria->order='appr_lvl_id DESC';
					$prev_verifier=ApplicationVerificationLevel::model()->findAll($criteria);
					if(empty($prev_verifier)){
						print_r(json_encode(array("status"=>" No Previous Level")));
					}
					$role_id_array=array();
					$same_role_id='';



					foreach ($model as $model) {
						if($same_role_id==$model->role_id)
							continue;
						$same_role_id=$model->role_id;
						$role_id_array[]=$model->role_id;
					}
					$user_role_id=$Usermodel->role_id;
					$prev_key_val=array_search($user_role_id, $role_id_array);
					if(isset($role_id_array[$prev_key_val+1]))
						$nexroleid=$role_id_array[$prev_key_val+1];
					else
						$nexroleid=NULL;
					$criteria=new CDbCriteria;
					$hol="H";
					$pen='P';
					$criteria->condition='app_Sub_id=:sub_id AND approv_status=:hol OR approv_status=:pen';
					$criteria->params=array(':sub_id'=>$sub_id,':hol'=>$hol,':pen'=>$pen);
					$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
					//check whether there is any other next verification level
					if(empty($nexroleid)){
						if(empty($vlmodel))
							print_r(json_encode(array("Error"=>"Already Verified by some other user")));
						else{
							$vlmodel->approv_status='V';
							$vlmodel->approval_user_id=$uid;
							$vlmodel->approval_user_comment=$comments;
							$vlmodel->reason_for_delay=$reason_for_delay;
  							$vlmodel->comment_date_time=date("Y-m-d H:m:s");

							if($vlmodel->save()){
								$subModel=ApplicationSubmission::model()->findByPK($sub_id);
								$subModel->application_status="A";
								$subModel->application_updated_date_time=date("Y-m-d H:m:s");
								if($subModel->save()){
									$mobile=IncentiveSchemes::getboUserMobileFromRoleID($sub_id,$nexroleid);
									$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
									$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Application has been reverted back to you and pending for your approval.\r\n";
									IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
									print_r(json_encode(array("status"=>"successfully Updated")));
								}
							}
							else
								print_r(json_encode(array("status"=>" Error While Updating the status")));
						}
					}
					else{
						$vlmodel->approv_status='V';
						$vlmodel->approval_user_id=$uid;
						$vlmodel->approval_user_comment=$comments;
  						$vlmodel->comment_date_time=date("Y-m-d H:m:s");

						if($vlmodel->save()){
							//add new level of approval
							$vlmodel=new ApplicationVerificationLevel;
							$vlmodel->next_role_id=$nexroleid;
							$vlmodel->app_Sub_id=$sub_id;
							$vlmodel->created_on=date('Y-m-d');
							$vlmodel->user_agent=$_SERVER['HTTP_USER_AGENT'];;
							$vlmodel->ip_address=$_SERVER['REMOTE_ADDR'];
							$vlmodel->approv_status='P';
  							$vlmodel->comment_date_time=date("Y-m-d H:m:s");

							if($vlmodel->save())
								print_r(json_encode(array("status"=>" successfully Updated")));
							else
								print_r(json_encode(array("status"=>" Error While Updating the status")));

						}
					}
		}
		else
			print_r(json_encode(array("status"=>"Fraudulant Data")));
  }
  protected function getIndustryType($nic_code){
    		$sql="SELECT * FROM NIC_Codes WHERE NIC_V_Digit='$nic_code'";
            $connection=Yii::app()->db; 
            $command=$connection->createCommand($sql);
            $nicCde=$command->queryRow();
            return $nicCde['Description'];
    	}
    	private function getDisttID($cafID){
    		$application=ApplicationSubmission::model()->findByPk($cafID);
    		if($application===null)
    			return false;
    		return $application->landrigion_id;
    	}
    	private function isStateApplication($cafID){
    		$application=ApplicationSubmission::model()->findByPk($cafID);
    		if($application===null)
    			return false;
    		if($application->landrigion_id==6){
    			$fields=json_decode($application->field_value);
    			if(isset($fields->ntrofunit,$fields->invstmnt_in_plant[0]) && (($fields->ntrofunit=='Manufacturing' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] > 10) || ($fields->ntrofunit=='Services' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] > 5)))
                	return true;
    		}
    		return false;
    	}
    	private function generateCertificateNumber($cafID){
    		$certificateNumber='';
    		if($this->isStateApplication($cafID))
    			$certificateNumber.='01';
    		else
    			$certificateNumber.='02';
    		$certificateNumber.='-'.$this->getDisttID($cafID);
    		$certificateNumber.='-CAFIP';
    		$certificateNumber.='-'.rand(10000,99999);
    		return $certificateNumber;
    		/**
    		* 01-State Application
    		* 02 Distt Application
    		*/
    	}
    	protected function generateInPrincipleLetter($cafID){
	  		$certificateNumber=$this->generateCertificateNumber($cafID);
	  		$application=ApplicationSubmission::model()->findByPk($cafID);
	  		$content = $this -> renderPartial("inPrinciple",array("certificateNumber"=>$certificateNumber,"application"=>$application),true);
	  		$name = Yii::app()->basePath."/inprinciple/INPRINCIPLELETTER_".$cafID.".pdf";
	          TCPDFView::generateInPrinciple($content,$name); 
	          exit;
  	}
       public function actionGenerateInPrincipleLetter($cafID){
                       extract($_GET);
	  		$certificateNumber=$this->generateCertificateNumber($cafID);
	  		$application=ApplicationSubmission::model()->findByPk($cafID);
	  		$content = $this -> renderPartial("inPrinciple",array("certificateNumber"=>$certificateNumber,"application"=>$application),true);
	  		$name = Yii::app()->basePath."/inprinciple/INPRINCIPLELETTER_".$cafID.".pdf";
	          TCPDFView::generateInPrinciple($content,$name); 
	          exit;
  	}

  /**
   * @author Hemant Thakur
  */
  function actionforwardApplicationStatus(){

  	if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
  		$app_id=$_POST['app_id'];
  		$sub_id=$_POST['sub_id'];
  		$comments=$_POST['comments'];
  		@session_start();
  		$uid=$_SESSION['uid'];
  		//check user is logeged in or not
  		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
  			$criteria=new CDbCriteria;
  			$criteria->select='role_id';
  			$criteria->condition='user_id=:uid';
  			$criteria->params=array(':uid'=>$uid);
  			$Usermodel = UserRoleMapping::model()->find($criteria);
  			$criteria->select='role_id';
  			$criteria->condition='app_id=:app_id';
  			$criteria->order='wrkflw_id ASC';
  			$criteria->params=array(':app_id'=>$app_id);
  			$model = AppWorkflow::model()->findAll($criteria);
  			$nexroleid='';
  			$role_id_array=array();
  			$same_role_id='';
  			foreach ($model as $model) {
  				if($same_role_id==$model->role_id)
  					continue;
  				$same_role_id=$model->role_id;
  				$role_id_array[]=$model->role_id;
  			}
  			$user_role_id=$Usermodel->role_id;
  			$prev_key_val=array_search($user_role_id, $role_id_array);
  			$roleModel= new RolesExt;
				if(!$roleModel->isNodleAgencyUser()){
					if(isset($role_id_array[$prev_key_val+1]))
						$nexroleid=$role_id_array[$prev_key_val+1];
					else
						$nexroleid=NULL;
				}
				else{
					if(!empty($role_id_array) && isset($role_id_array[0]))
						$nexroleid=$role_id_array[0];
				}
  			$criteria=new CDbCriteria;
  			$pen='F';
  			$criteria->condition='app_Sub_id=:sub_id AND approv_status=:pen';
  			$criteria->params=array(':sub_id'=>$sub_id,':pen'=>$pen);
  			$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
  			//check whether there is any other next verification level
  			if(empty($nexroleid)){
  				if(empty($vlmodel))
  					print_r(json_encode(array("Error"=>"Already Verified by some other user")));
  				else{
  					$vlmodel->approv_status='V';
  					$vlmodel->approval_user_id=$uid;
  					$vlmodel->approval_user_comment=$comments;
  					$vlmodel->comment_date_time=date("Y-m-d H:m:s");
  					if($vlmodel->save()){
  						$subModel=ApplicationSubmission::model()->findByPK($sub_id);
  						$subModel->application_status="A";
  						$subModel->application_updated_date_time=date("Y-m-d H:m:s");
  						if($subModel->save()){

  							$appFlow=new ApplicationFlowLogs;
  							$appFlow->submission_id=$sub_id;
  							$user_role_id=RolesExt::getUserRoleViaId($uid);
  							$appFlow->approver_role_id=$user_role_id['role_id'];
  							$appFlow->approval_user_id=$uid;
  							$appFlow->approver_comments=$comments;
  							$appFlow->created_date_time=date("Y-m-d H:m:s");
  							$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
  							$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
  							$appFlow->application_status='V';
  							$appFlow->save();
  							print_r(json_encode(array("status"=>"successfully Updated")));
  						}
  					}
  					else
  						print_r(json_encode(array("status"=>" Error While Updating the status")));
  				}
  			}
  			else{
  				$vlmodel->approv_status='V';
  				$vlmodel->approval_user_id=$uid;
  				$vlmodel->approval_user_comment=$comments;
  				$vlmodel->comment_date_time=date("Y-m-d H:m:s");
  				if($vlmodel->save()){
  					//add new level of approval
  					$vlmodel=new ApplicationVerificationLevel;
  					$user_role_id=RolesExt::getUserRoleViaId($uid);
  					if($user_role_id['role_id']==4)
  						$nexroleid=34;
  					$vlmodel->next_role_id=$nexroleid;
  					$vlmodel->app_Sub_id=$sub_id;
  					$vlmodel->created_on=date('Y-m-d H:m:s-d');
  					$vlmodel->user_agent=$_SERVER['HTTP_USER_AGENT'];;
  					$vlmodel->ip_address=$_SERVER['REMOTE_ADDR'];
  					$vlmodel->approv_status='P';
  					if($vlmodel->save()){
  						$appFlow=new ApplicationFlowLogs;
  						$appFlow->submission_id=$sub_id;
  						$appFlow->approver_role_id=$user_role_id['role_id'];
  						$appFlow->approval_user_id=$uid;
  						$appFlow->approver_comments=$comments;
  						$appFlow->created_date_time=date("Y-m-d H:m:s");
  						$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
  						$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
  						$appFlow->application_status='V';
  						$appFlow->save();
  						print_r(json_encode(array("status"=>" successfully Updated")));
  					}
  					else
  						print_r(json_encode(array("status"=>" Error While Updating the status")));

  				}

  			}
  		}
  		else
  			print_r(json_encode(array("status"=>"Invalid Login")));
  	}
  	else
  		print_r(json_encode(array("status"=>"Fraudulant Data")));
  }
  /**
  * @author : Hemant Thakur
  */
  function actionForwardApplicationStatusReject(){

  	if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
  		$app_id=$_POST['app_id'];
  		$sub_id=$_POST['sub_id'];
  		$comments=$_POST['comments'];
  		@session_start();
  		$uid=$_SESSION['uid'];
  		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
  			$criteria=new CDbCriteria;
  			$pen='F';
  			$criteria->condition='app_Sub_id=:sub_id AND approv_status=:pen';
  			$criteria->params=array(':sub_id'=>$sub_id,':pen'=>$pen);
  			$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
  			if(empty($vlmodel))
  				print_r(json_encode(array("Error"=>"Already done by some other user")));
  			else{
  				$vlmodel->approv_status='R';
  				$vlmodel->approval_user_id=$uid;
  				$vlmodel->approval_user_comment=$comments;
  				$vlmodel->comment_date_time=date("Y-m-d H:m:s");
  				if($vlmodel->save()){
  					$subModel=ApplicationSubmission::model()->findByPK($sub_id);
  					$subModel->application_status="R";
  					$subModel->application_updated_date_time=date("Y-m-d H:m:s");
  					if($subModel->save())
  						print_r(json_encode(array("status"=>"successfully Updated")));
  					else
  						print_r(json_encode(array("status"=>" Error While Updating the status")));
  				}
  				else
  						print_r(json_encode(array("status"=>" Error While Updating the status")));
  			}
  		}
  		else
  			print_r(json_encode(array("status"=>"Invalid Login")));
  	}
  	else
  		print_r(json_encode(array("status"=>"Fraudulant Data")));

  }
	/**
	 * this function is used to Approve/verify application
	 *@param: none
	 *author : Hemant thakur
	 */
	function actionApplicationstatus(){
		if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
			$app_id=$_POST['app_id'];
			$sub_id=$_POST['sub_id'];
			$comments=$_POST['comments'];
			$reason_for_delay=$_POST['reason_for_delay'];
			@session_start();
			$uid=$_SESSION['uid'];
			//check user is logeged in or not
			if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
				$criteria=new CDbCriteria;
				$criteria->select='role_id';
				$criteria->condition='user_id=:uid';
				$criteria->params=array(':uid'=>$uid);
				$Usermodel = UserRoleMapping::model()->find($criteria);
				$criteria->select='role_id';
				$criteria->condition='app_id=:app_id';
				$criteria->order='wrkflw_id ASC';
				$criteria->params=array(':app_id'=>$app_id);
				$model = AppWorkflow::model()->findAll($criteria);
				// echo "<pre>";print_r($model);die;
				$nexroleid='';
				$role_id_array=array();
				$same_role_id='';
				foreach ($model as $model) {
					if($same_role_id==$model->role_id)
						continue;
					$same_role_id=$model->role_id;
					$role_id_array[]=$model->role_id;
				}
				$user_role_id=$Usermodel->role_id;
				$prev_key_val=array_search($user_role_id, $role_id_array);
				$roleModel= new RolesExt;
				if(!$roleModel->isNodleAgencyUser()){
					if(isset($role_id_array[$prev_key_val+1]))
						$nexroleid=$role_id_array[$prev_key_val+1];
					else
						$nexroleid=NULL;
				}
				else{
					if(!empty($role_id_array) && isset($role_id_array[0]))
						$nexroleid=$role_id_array[0];
				}
				// check for the state's CAF approver

				if($user_role_id==34)
					$nexroleid=NULL;
				$criteria=new CDbCriteria;
				$hol="H";
				$pen='P';
				$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:hol OR approv_status=:pen)';
				$criteria->params=array(':sub_id'=>$sub_id,':hol'=>$hol,':pen'=>$pen);
				$criteria->order="appr_lvl_id DESC";
				$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
				//check whether there is any other next verification level
				// echo "<pre>";print_r($vlmodel);die;
				// echo $nexroleid;die;
				if(empty($nexroleid)){
					if(empty($vlmodel)){
						print_r(json_encode(array("Error"=>"Already Verified by some other user")));
						exit;
					}
					else{
						$vlmodel->approv_status='V';
						$vlmodel->approval_user_id=$uid;
						$vlmodel->approval_user_comment=$comments;
						$vlmodel->comment_date_time=date("Y-m-d H:m:s");
						if($vlmodel->save()){
							$subModel=ApplicationSubmission::model()->findByPK($sub_id);
							$subModel->application_status="A";
							$subModel->application_updated_date_time=date("Y-m-d H:m:s");
							if($subModel->save()){
								$this->generateInPrincipleLetter($sub_id);
								$appFlow=new ApplicationFlowLogs;
								$appFlow->submission_id=$sub_id;
								$user_role_id=RolesExt::getUserRoleViaId($uid);
								$appFlow->approver_role_id=$user_role_id['role_id'];
								$appFlow->approval_user_id=$uid;
								$appFlow->approver_comments=$comments;
								$appFlow->created_date_time=date("Y-m-d H:m:s");
								$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
								$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
								$appFlow->application_status='V';
								$appFlow->save();
								$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
								$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has Approved your application.\r\n";
								IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
								print_r(json_encode(array("status"=>"successfully Updated")));
								exit;
							}
						}
						else
							print_r(json_encode(array("status"=>" Error While Updating the status")));
							exit;
					}
				}
				else{
					$vlmodel->approv_status='V';
					$vlmodel->approval_user_id=$uid;
					$vlmodel->approval_user_comment=$comments;
					$vlmodel->comment_date_time=date("Y-m-d H:m:s");
					$vlmodel->reason_for_delay= @$reason_for_delay;
					if($vlmodel->save()){
						$hol="H";
						$pen='P';
						$fstt='F';
						$criteria->condition='app_Sub_id=:sub_id';
						$criteria->params=array(':sub_id'=>$sub_id);
						$criteria->order="appr_lvl_id DESC";
						$vlmodelF = ApplicationVerificationLevel::model()->find($criteria);
						//for forwarded level
						// echo "<pre>";print_r($vlmodelF);die;
						if(!empty($vlmodelF) && ($vlmodelF->approv_status=='H' || $vlmodelF->approv_status=='F')){
							$vlmodelF->approv_status='P';
							$vlmodelF->approval_user_id=$uid;
							$vlmodelF->approval_user_comment=$comments;
							$vlmodelF->comment_date_time=date("Y-m-d H:m:s");
							if($vlmodelF->save()){
								$mobile=IncentiveSchemes::getboUserMobileFromRoleID($sub_id,$vlmodelF->next_role_id);
								$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
								$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Application has been updated and pending for your approval.\r\n";
								IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
								print_r(json_encode(array("status"=>" successfully Updated")));
								exit;
							}
							else{
								print_r(json_encode(array("status"=>" Error While Updating the status")));
								exit;
							}
						}
						else{
							//add new level of approval
							$vlmodel=new ApplicationVerificationLevel;
							$user_role_id=RolesExt::getUserRoleViaId($uid);
							if($user_role_id['role_id']==4)
								$nexroleid=34;
							$vlmodel->next_role_id=$nexroleid;
							$vlmodel->app_Sub_id=$sub_id;
							$vlmodel->created_on=date('Y-m-d');
							$vlmodel->user_agent=$_SERVER['HTTP_USER_AGENT'];;
							$vlmodel->ip_address=$_SERVER['REMOTE_ADDR'];
							$vlmodel->approv_status='P';
							if($vlmodel->save()){
								$appFlow=new ApplicationFlowLogs;
								$appFlow->submission_id=$sub_id;
								$user_role_id=RolesExt::getUserRoleViaId($uid);
								$appFlow->approver_role_id=$user_role_id['role_id'];
								$appFlow->approval_user_id=$uid;
								$appFlow->approver_comments=$comments;
								$appFlow->created_date_time=date("Y-m-d H:m:s");
								$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
								$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
								$appFlow->application_status='V';
								$appFlow->save();
								$mobile=IncentiveSchemes::getboUserMobileFromRoleID($sub_id,$nexroleid);
								$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
								$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has submitted the application for your approval.\r\n";
								$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has verified your application and sent for further approval.\r\n";
								IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
								IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
								print_r(json_encode(array("status"=>" successfully Updated")));
								exit;
							}
							else{
								print_r(json_encode(array("status"=>" Error While Updating the status")));	
								exit;
							}
						}
						

					}

				}
			}
			else{
				print_r(json_encode(array("status"=>"Invalid Login")));
				exit;
			}
		}
		else{
			print_r(json_encode(array("status"=>"Fraudulant Data")));
			exit;
		}
	}
	/**
	 * this function is used to Reject application
	 *@param: none
	 *author : Hemant thakur
	 */

	function actionApplicationstatusreject(){
		if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
			$app_id=$_POST['app_id'];
			$sub_id=$_POST['sub_id'];
			$comments=$_POST['comments'];
			$reason_for_delay=$_POST['reason_for_delay'];
			@session_start();
			$uid=$_SESSION['uid'];
			if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
				$criteria=new CDbCriteria;
				$hol="H";
				$pen='P';
				$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:hol OR approv_status=:pen)';
				$criteria->params=array(':sub_id'=>$sub_id,':hol'=>$hol,':pen'=>$pen);
				$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
				if(empty($vlmodel))
					print_r(json_encode(array("Error"=>"Already done by some other user")));
				else{
					$vlmodel->approv_status='R';
					$vlmodel->approval_user_id=$uid;
					$vlmodel->comment_date_time=date("Y-m-d H:m:s");
					$vlmodel->approval_user_comment=$comments;
					$vlmodel->reason_for_delay=$reason_for_delay;
					if($vlmodel->save()){
						$subModel=ApplicationSubmission::model()->findByPK($sub_id);
						$subModel->application_status="R";
						$subModel->application_updated_date_time=date("Y-m-d H:m:s");
						if($subModel->save()){
							$appFlow=new ApplicationFlowLogs;
							$appFlow->submission_id=$sub_id;
							$user_role_id=RolesExt::getUserRoleViaId($uid);
							$appFlow->approver_role_id=$user_role_id['role_id'];
							$appFlow->approval_user_id=$uid;
							$appFlow->approver_comments=$comments;
							$appFlow->created_date_time=date("Y-m-d H:m:s");
							$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
							$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
							$appFlow->application_status='R';
							$appFlow->save();
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
							$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has rejected your application.Please login onto Single Window for further detail.\r\n";
							IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
							print_r(json_encode(array("status"=>"successfully Updated")));
						}
						else
							print_r(json_encode(array("status"=>" Error While Updating the status")));
					}
					else
							print_r(json_encode(array("status"=>" Error While Updating the status")));
				}
			}
			else
				print_r(json_encode(array("status"=>"Invalid Login")));
		}
		else
			print_r(json_encode(array("status"=>"Fraudulant Data")));
	}
	/**
	 * this function is used to Hold application
	 *@param: none
	 *author : Hemant thakur
	 */

	function actionApplicationstatushold(){
		if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
			$app_id=$_POST['app_id'];
			$sub_id=$_POST['sub_id'];
			$comments=$_POST['comments'];
			$reason_for_delay=@$_POST['reason_for_delay'];
			@session_start();
			$uid=$_SESSION['uid'];
                        $rb_subModel=ApplicationSubmission::model()->findByPK($sub_id);
                        
			if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
				$criteria=new CDbCriteria;
				$hol="H";
				$pen='P';
				$frap='F';
                                $ab = 'AB';
				$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:hol OR approv_status=:pen OR approv_status=:frap OR approv_status=:ab)';
				$criteria->params=array(':sub_id'=>$sub_id,':hol'=>$hol,':pen'=>$pen,':frap'=>$frap,':ab'=>$ab);
				$criteria->order='appr_lvl_id DESC';
				$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
				if(empty($vlmodel) && ($rb_subModel->application_status !='AB'))
					print_r(json_encode(array("Error"=>"Already done by some other user")));
				else{
                                        if($rb_subModel->application_status !='AB'){
                    			$vlmodel->approv_status='H';
					$vlmodel->approval_user_id=$uid;
					$vlmodel->comment_date_time=date("Y-m-d H:m:s");
					$vlmodel->approval_user_comment=$comments;
					$vlmodel->reason_for_delay=@$reason_for_delay;
                                        
					if($vlmodel->save()){
						$appFlow=new ApplicationFlowLogs;
						$appFlow->submission_id=$sub_id;
						$user_role_id=RolesExt::getUserRoleViaId($uid);
						$appFlow->approver_role_id=$user_role_id['role_id'];
						$appFlow->approval_user_id=$uid;
						$appFlow->approver_comments=$comments;
						$appFlow->created_date_time=date("Y-m-d H:m:s");
						$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
						$appFlow->application_status='RBI';
						$appFlow->save();
						$subModel=ApplicationSubmission::model()->findByPK($sub_id);
						$subModel->application_status="H";
						if($subModel->save()){
                                                        DefaultUtility::sendSMSEmailGlobal('CAF','When CAF is reverted back to investor',$sub_id);//apoorv
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
							$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has reverted your application.Please login onto Single Window for further detail.\r\n";
							IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
							print_r(json_encode(array("status"=>"successfully Updated")));
						}
                                        }}else if($rb_subModel->application_status =='AB'){
                                            $criteria->condition='app_Sub_id=:sub_id AND (approv_status=:ab)';
                                            $criteria->params=array(':sub_id'=>$sub_id,':ab'=>$ab);
                                            $criteria->order='appr_lvl_id DESC';
                                            $abmodel = ApplicationAbeyanceLevel::model()->find($criteria);
                                            if(!empty($abmodel)){
                                                $abmodel->approv_status='H';
                                                $abmodel->approval_user_id=$uid;
                                                $abmodel->comment_date_time=date("Y-m-d H:m:s");
                                                $abmodel->approval_user_comment=$comments;
                                                $abmodel->reason_for_delay=@$reason_for_delay;
                                        
                                                if($abmodel->save()){}}
                                                $appFlow=new ApplicationFlowLogs;
						$appFlow->submission_id=$sub_id;
						$user_role_id=RolesExt::getUserRoleViaId($uid);
						$appFlow->approver_role_id=$user_role_id['role_id'];
						$appFlow->approval_user_id=$uid;
						$appFlow->approver_comments=$comments;
						$appFlow->created_date_time=date("Y-m-d H:m:s");
						$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
						$appFlow->application_status='RBI';
						$appFlow->save();
						$subModel=ApplicationSubmission::model()->findByPK($sub_id);
						$subModel->application_status="H";
						if($subModel->save()){
                                                        DefaultUtility::sendSMSEmailGlobal('CAF','When CAF is reverted back to investor',$sub_id);//apoorv
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
							$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has reverted your application.Please login onto Single Window for further detail.\r\n";
							IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
							print_r(json_encode(array("status"=>"successfully Updated")));
						}
                                        }
					else
							print_r(json_encode(array("status"=>" Error While Updating the status")));
				}
			}
			else
				print_r(json_encode(array("status"=>"Invalid Login")));
		}
		else
			print_r(json_encode(array("status"=>"Fraudulant Data")));
	}

	/**
	 * this function is used to change application status
	 *@param: none
	 *author : Hemant thakur
	 */
	function actionApplicationstatusAccept(){
		if(isset($_POST['app_id'])){
			$id=$_POST['app_id'];
			$model = ApplicationSubmission::model()->findByPK($id);
			$model->application_status='Y';
			if($model->save())
				print_r(json_encode(array("status"=>"SUCCESS")));
			else
				print_r(json_encode(array("status"=>"ERROR")));
			

		}
	}
/* Rahul Kumar : Existing CAF : 20032018 */ 
	function actionExistingCafApplicationstatushold(){

		if(isset($_POST['app_id']) && isset($_POST['sub_id'])){
			$app_id=$_POST['app_id'];
			$sub_id=$_POST['sub_id'];
			$comments=$_POST['comments'];
			@session_start();
			$uid=$_SESSION['uid'];
			if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
				$criteria=new CDbCriteria;
				$hol="H";
				$pen='P';
				$frap='F';
				$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:hol OR approv_status=:pen OR approv_status=:frap)';
				$criteria->params=array(':sub_id'=>$sub_id,':hol'=>$hol,':pen'=>$pen,'frap'=>$frap);
				$criteria->order='appr_lvl_id DESC';
				$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
				if(empty($vlmodel))
					print_r(json_encode(array("Error"=>"Already done by some other user")));
				else{
					$vlmodel->approv_status='H';
					$vlmodel->approval_user_id=$uid;
					$vlmodel->comment_date_time=date("Y-m-d H:m:s");
					$vlmodel->approval_user_comment=$comments;
					if($vlmodel->save()){  
						//Update Approve In service table 'bo_sp_applications'
						$serviceApplicationUpdateQuery="UPDATE bo_sp_applications SET app_comments='$comments',app_status='RBI' WHERE app_id=$sub_id AND sp_tag='DOI@908#123'";
						$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();            
						if(!empty($serviceDetail)){
							$applicationDetail=Yii::app()->db->createCommand("SELECT * FROM bo_sp_applications WHERE app_id=$sub_id")->queryRow(); 
							if(!empty($applicationDetail)){
								$sno = $applicationDetail['sno'];
								// Save History in bo_sp_application_history
								$modelSPH = new	SpApplicationHistory;
								$modelSPH->sp_app_id = $sno;
								$modelSPH->service_id = $applicationDetail['sp_app_id'];
								$modelSPH->sp_tag = $applicationDetail['sp_tag'];
								$modelSPH->app_id = $sub_id;
								$modelSPH->application_status = 'RBI';
								$modelSPH->comments = $comments;
								$modelSPH->added_date_time = date('Y-m-d H:i:s');
								$modelSPH->save();
							}
						}
						$appFlow=new ApplicationFlowLogs;
						$appFlow->submission_id=$sub_id;
						$user_role_id=RolesExt::getUserRoleViaId($uid);
						$appFlow->approver_role_id=$user_role_id['role_id'];
						$appFlow->approval_user_id=$uid;
						$appFlow->approver_comments=$comments;
						$appFlow->created_date_time=date("Y-m-d H:m:s");
						$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
						$appFlow->application_status='RBI';
						$appFlow->save();
						$subModel=ApplicationSubmission::model()->findByPK($sub_id);
						$subModel->application_status="H";
						if($subModel->save()){
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
							$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has reverted your application.Please login onto Single Window for further detail.\r\n";
							IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
							print_r(json_encode(array("status"=>"successfully Updated")));
						}
					}
					else
						print_r(json_encode(array("status"=>" Error While Updating the status")));

				}

			}
			else
				print_r(json_encode(array("status"=>"Invalid Login")));
		}
		else
			print_r(json_encode(array("status"=>"Fraudulant Data")));
	}


                /**

		 *this function is used to Reject Existing Caf application

		 *@param: none

		 *author : Rahul Kumar

		 */



		function actionExistingcafapplicationstatusreject(){

			if(isset($_POST['app_id']) && isset($_POST['sub_id'])){

				$app_id=$_POST['app_id'];

				$sub_id=$_POST['sub_id'];

				$comments=$_POST['comments'];

				@session_start();

				$uid=$_SESSION['uid'];

				if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

					$criteria=new CDbCriteria;

					$hol="H";

					$pen='P';

					$criteria->condition='app_Sub_id=:sub_id AND ( approv_status=:pen)';//approv_status=:hol OR

					$criteria->params=array(':sub_id'=>$sub_id,':pen'=>$pen);//,':hol'=>$hol,

					$vlmodel = ApplicationVerificationLevel::model()->find($criteria);

					if(empty($vlmodel))

						print_r(json_encode(array("Error"=>"Already done by some other user")));

					else{

						$vlmodel->approv_status='R';

						$vlmodel->approval_user_id=$uid;

						$vlmodel->comment_date_time=date("Y-m-d H:m:s");

						$vlmodel->approval_user_comment=$comments;

						if($vlmodel->save()){

							$subModel=ApplicationSubmission::model()->findByPK($sub_id);

							$subModel->application_status="R";

							$subModel->application_updated_date_time=date("Y-m-d H:m:s");

							if($subModel->save()){

                                                            

                                                                 $serviceApplicationUpdateQuery="UPDATE bo_sp_applications SET app_comments='$comments',app_status='R' WHERE app_id=$sub_id AND sp_tag='DOI@908#123'";

                                                                    $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();            

                                                   if(!empty($serviceDetail)){

                                                                    $applicationDetail=Yii::app()->db->createCommand("SELECT * FROM bo_sp_applications WHERE app_id=$sub_id")->queryRow();  

                                                   if(!empty($applicationDetail)){

                                                                    $sno = $applicationDetail['sno'];

                                                                    // Save History in bo_sp_application_history

                                                                    $modelSPH = new	SpApplicationHistory;

                                                                    $modelSPH->sp_app_id = $sno;

                                                                    $modelSPH->service_id = $applicationDetail['sp_app_id'];

                                                                    $modelSPH->sp_tag = $applicationDetail['sp_tag'];

                                                                    $modelSPH->app_id = $sub_id;

                                                                    $modelSPH->application_status = 'R';

                                                                    $modelSPH->comments = $comments;

                                                                    $modelSPH->added_date_time = date('Y-m-d H:i:s');

                                                                    $modelSPH->save();

                                                   }

                                                                }

                                                            

								$appFlow=new ApplicationFlowLogs;

								$appFlow->submission_id=$sub_id;

								$user_role_id=RolesExt::getUserRoleViaId($uid);

								$appFlow->approver_role_id=$user_role_id['role_id'];

								$appFlow->approval_user_id=$uid;

								$appFlow->approver_comments=$comments;

								$appFlow->created_date_time=date("Y-m-d H:m:s");

								$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];

								$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];

								$appFlow->application_status='R';

								$appFlow->save();

								$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);

								$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has rejected your application.Please login onto Single Window for further detail.\r\n";

								IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);

								print_r(json_encode(array("status"=>"successfully Updated")));

							}

							else

								print_r(json_encode(array("status"=>" Error While Updating the status")));

						}

						else

								print_r(json_encode(array("status"=>" Error While Updating the status")));

					}

				}

				else

					print_r(json_encode(array("status"=>"Invalid Login")));

			}

			else

				print_r(json_encode(array("status"=>"Fraudulant Data")));

		}


    

    function actionExistingCafApplicationstatus(){              

			if(!empty($_POST['app_id']) && !empty($_POST['sub_id'])){
                //echo  "in";
				$app_id=$_POST['app_id'];
				$sub_id=$_POST['sub_id'];
				$comments=$_POST['comments'];
				@session_start();
				$uid=$_SESSION['uid'];
              // echo "<pre>"; echo $uid;die;
				//check user is logeged in or not
				if(isset($uid) && !empty($uid)){
                    // echo "here"; die;
					$criteria=new CDbCriteria;
					$criteria->select='role_id';
					$criteria->condition='user_id=:uid';
					$criteria->params=array(':uid'=>$uid);
					$Usermodel = UserRoleMapping::model()->find($criteria);
					$criteria->select='role_id';
					$criteria->condition='app_id=:app_id';
					$criteria->order='wrkflw_id ASC';
					$criteria->params=array(':app_id'=>$app_id);
					$model = AppWorkflow::model()->findAll($criteria);
                    $all = array($model);
					//echo "<pre>";print_r($all);
					$nexroleid='';
					$role_id_array=array();
					$same_role_id='';                        

					$sql = "SELECT * FROM bo_user_role_mapping  WHERE user_id=$uid";
					$userMapping = Yii::app()->db->createCommand($sql)->queryRow();
					/* echo print_r($userMapping);
					
					die; */
					if($userMapping['role_id']=="34" || $userMapping['role_id']=="33")
					{
						$nexroleid="";
						$criteria=new CDbCriteria;
						$hol="H";
						$pen='P';
						$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:pen)';
						$criteria->params=array(':sub_id'=>$sub_id,':pen'=>$pen);
						$criteria->order="appr_lvl_id DESC";
						$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
						//echo "<pre>";
						//print_r($vlmodel);
						//check whether there is any other next verification level
						// echo "<pre>";print_r($criteria);die;
						//echo $nexroleid;die;
						if(empty($nexroleid)){
							//echo "<pre>";print_r($vlmodel);die;
							if(empty($vlmodel))
							{	die("sscs");
								print_r(json_encode(array("Error"=>"Already Verified by some other user")));
							}else{
							$vlmodel->approv_status='V';
							$vlmodel->approval_user_id=$uid;
							$vlmodel->approval_user_comment=$comments;
							$vlmodel->comment_date_time=date("Y-m-d H:m:s");
							//echo "<pre>";print_r($vlmodel);die;
							if($vlmodel->save()){
								$subModel=ApplicationSubmission::model()->findByPK($sub_id);
								$subModel->application_status="A";
								$subModel->application_updated_date_time=date("Y-m-d H:m:s");
								
								//print_r($subModel);die;
								if($subModel->save()){
									//Update Approve In service table 'bo_sp_applications'
									$serviceApplicationUpdateQuery="UPDATE bo_sp_applications SET app_comments='$comments',app_status='A' WHERE app_id='$sub_id' AND sp_tag='DOI@908#123'";
									$serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();
									if(!empty($serviceDetail)){
										$applicationDetail=Yii::app()->db->createCommand("SELECT * FROM bo_sp_applications WHERE app_id='$sub_id' AND sp_tag='DOI@908#123'")->queryRow();  
										if(!empty($applicationDetail)){
											$sno = $applicationDetail['sno'];
											// Save History in bo_sp_application_history
											$modelSPH = new	SpApplicationHistory;
											$modelSPH->sp_app_id = $sno;
											$modelSPH->service_id = $applicationDetail['sp_app_id'];
											$modelSPH->sp_tag = $applicationDetail['sp_tag'];
											$modelSPH->app_id = $sub_id;
											$modelSPH->application_status = 'A';
											$modelSPH->comments =$comments;
											$modelSPH->added_date_time = date('Y-m-d H:i:s');
											$modelSPH->save();
										}
									}
	  								//$this->generateInPrincipleLetter($sub_id);
									$appFlow=new ApplicationFlowLogs;
									$appFlow->submission_id=$sub_id;
									$user_role_id=RolesExt::getUserRoleViaId($uid);
									$appFlow->approver_role_id=$user_role_id['role_id'];
									$appFlow->approval_user_id=$uid;
									$appFlow->approver_comments=$comments;
									$appFlow->created_date_time=date("Y-m-d H:m:s");
									$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
									$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
									$appFlow->application_status='V';
									$appFlow->save();
									$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
									//$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has Approved your application.\r\n";
									//IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
									print_r(json_encode(array("status"=>"successfully Updated")));
								}else{
									print_r(json_encode(array("status"=>" Error While Updating the status")));
								}
							}
							else
								print_r(json_encode(array("status"=>" Error While Updating the status")));
							}
						}
						else{
							$vlmodel->approv_status='V';
							$vlmodel->approval_user_id=$uid;
							$vlmodel->approval_user_comment=$comments;
							$vlmodel->comment_date_time=date("Y-m-d H:m:s");
							if($vlmodel->save()){
							$hol="H";
							$pen='P';
							$fstt='F';
							$criteria->condition='app_Sub_id=:sub_id';
							$criteria->params=array(':sub_id'=>$sub_id);
							$criteria->order="appr_lvl_id DESC";
							$vlmodelF = ApplicationVerificationLevel::model()->find($criteria);
							//for forwarded level
							// echo "<pre>";print_r($vlmodelF);die;
							if(!empty($vlmodelF) && ($vlmodelF->approv_status=='H' || $vlmodelF->approv_status=='F')){
								$vlmodelF->approv_status='P';
								$vlmodelF->approval_user_id=$uid;
								$vlmodelF->approval_user_comment=$comments;
								$vlmodelF->comment_date_time=date("Y-m-d H:m:s");
								if($vlmodelF->save()){
									$mobile=IncentiveSchemes::getboUserMobileFromRoleID($sub_id,$vlmodelF->next_role_id);
									$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
									$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Application has been updated and pending for your approval.\r\n";
									IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
									print_r(json_encode(array("status"=>" successfully Updated")));
								}
								else
									print_r(json_encode(array("status"=>" Error While Updating the status")));
							}
							else{
									//add new level of approval
									$vlmodel=new ApplicationVerificationLevel;
									$user_role_id=RolesExt::getUserRoleViaId($uid);
									if($user_role_id['role_id']==4)
										$nexroleid=34;
									$vlmodel->next_role_id=$nexroleid;
									$vlmodel->app_Sub_id=$sub_id;
									$vlmodel->created_on=date('Y-m-d');
									$vlmodel->user_agent=$_SERVER['HTTP_USER_AGENT'];
									$vlmodel->ip_address=$_SERVER['REMOTE_ADDR'];
									$vlmodel->approv_status='P';
									if($vlmodel->save()){
										$appFlow=new ApplicationFlowLogs;
										$appFlow->submission_id=$sub_id;
										$user_role_id=RolesExt::getUserRoleViaId($uid);
										$appFlow->approver_role_id=$user_role_id['role_id'];
										$appFlow->approval_user_id=$uid;
										$appFlow->approver_comments=$comments;
										$appFlow->created_date_time=date("Y-m-d H:m:s");
										$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
										$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
										$appFlow->application_status='V';
										$appFlow->save();
										$mobile=IncentiveSchemes::getboUserMobileFromRoleID($sub_id,$nexroleid);
										$app_name=IncentiveSchemes::getAppNameFromSubmissionId($sub_id);
										$msgDept="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has submitted the application for your approval.\r\n";
										$msgInvest="Application Name: $app_name\r\nApplication ID: $sub_id\r\nMessage: Department has verified your application and sent for further approval.\r\n";
										IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
										IncentiveSchemes::sendNotificationToInvestor($sub_id,$msgInvest);
										print_r(json_encode(array("status"=>" successfully Updated")));
									}
									else
										print_r(json_encode(array("status"=>" Error While Updating the status")));	
								}
							}
						}
					}

				}else
					print_r(json_encode(array("status"=>"Invalid Login")));
			}
			else
				print_r(json_encode(array("status"=>"Fraudulent Data")));
	}

}
?>
