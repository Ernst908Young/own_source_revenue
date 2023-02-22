<?php

class LandAllotmentController extends Controller
{
	
	/**
	*@author Hemant Thakur
	* this function is used to add Department Fee
	*/
	private function AddDepartmentFee($data){
		$fee=0;
			foreach ($data->dept_approval_fee as $k => $v)
				$fee = $fee + $v;
		return $fee;
		exit;
	}
	/**
	* this function is used to department mapping ids
	*@author Hemant thakur
	*/
	private function getDeptMapIDFromDeptID($deptID){
		$dept=Departments::model()->findByPk($deptID);
		if($dept===null)
			return false;
		return $dept->bank_scheme_code;
	}
	private function getAmountOfApproval($apprvalId){
		$apprvalId=DepartmentApproval::model()->findByPk($apprvalId);
		if($apprvalId===null)
			return false;
		return $apprvalId->department_approval_fees;
	}
	protected function calculateFileSize($size, $precision = 2){
	        $size /= 1000;
	    return round($size, $precision).' MB';
	}
	/**
	* this function is used to departments map id
	*@author Hemant thakur
	*/
	/*private function getDepartmentPayments($data){
		$industryFees=$this->getCAFAmount($data);
		$deptData=HDFC_SCHEME_CODE."_".$industryFees."_"."0.0~";
		if(isset($data->requried_approval_department) && count($data->requried_approval_department)>0){
			foreach ($data->requried_approval_department as $key => $dept){
				$deptMapID=$this->getDeptMapIDFromDeptID($dept);
				$deptApprvlAmount=0.0;
				if(isset($data->required_approval_name[$key]))
					$deptApprvlAmount=$this->getAmountOfApproval($data->required_approval_name[$key]);
				$deptData.=$deptMapID."_".$deptApprvlAmount."_". "0.0" ."~";
			}
			$deptData=rtrim($deptData,"~");		
		}
		// echo $deptData;die("here");
		return $deptData;
	} */


	/**
	*this function is used to print the PDF data 
	*/
	public function actionPrintForm(){
		if (empty($_GET['app_id']))
				return;
		$app_sub_id = base64_decode($_GET['app_id']);
		$appInfo    = ApplicationSubmissionExt::getSubmittedAppviaIdPrint($app_sub_id);
		if (!$appInfo) {
				Yii::app()->user->setFlash('Error', "You have not submitted the application.");
				$this->redirect(array(
						'/frontuser'
				));
				exit;
		}
		
		$content = $this->renderPartial("printCAF", array(
				"data" => $appInfo,
				"app_sub_id"=>$app_sub_id
		), true);
		$name    = "Application_Form.pdf";
		Utility::generatePdfApp($content, $name);
		exit;
	}
	/**
	* by default investor will land to this page
	*@author Hemant Thakur
	*/
	public function actionIndex(){
			$error = '';
			// echo "<pre>";print_r($_POST);die;
			if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
					throw new Exception("Unauthorized Access", 401);
					@session_start();
			if (isset($_POST['SSO_TOKEN'])) {
					extract($_POST);
					$data     = $_POST;
					$res      = Utility::getViaCurl($SSO_HREF);
					// echo "<pre>";print_r($res);die;
					$_res     = json_decode($res);
					$RESPONSE = 0;
					if (is_object($_res))
							$RESPONSE = (array) $_res->RESPONSE;
					if (count($RESPONSE) > 4) {
						// die("here");
							$is_valid_sso_token = 1;
							$_SESSION['LOGGED_IN'] = 1;
							$_SESSION['RESPONSE']  = $RESPONSE;
					}
			}
			$this->redirect(array(
				'/frontuser/landAllotment/stepOne'
			));
			exit;
	}
	/**
	* this function is used to check the investor logged in
	*@author Hemant Thakur
	*/   
	private function isInvestorLoggedIn(){
		@session_start();
		//admin can't access this page 
		if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
			throw new CHttpException(400, "you can't access this page");
		}
		if(!DefaultUtility::isValidLogin())
			$this->redirect(SSO_URL1);
		return true;
	}
	/**
	*this function is used to get the investor detail
	*@author Hemant thakur
	*/

	private function getInvestorDetail(){
		$userDetail=@$_SESSION['RESPONSE'];
		if(empty($userDetail))
			return false;
		return $userDetail;
	 // echo "<pre>";print_r($_SESSION);die("fun"); 
	}
	 /*used to get the incomplete CAF application of the user 
	@author : Hemant Thakur
	@param: int
	@return: array
	*/
	private function getUsersCAFApplicationsOfUser($uid,$app_id,$submission_id=null){
		$connection=Yii::app()->db;
		$status="I";
		$Hstatus='H';
		$payment="B";
		$sql="";
		$sql .= "SELECT submission_id,dept_id,application_id,field_value,application_created_date,application_status 
			  from bo_application_submission 
			  WHERE (application_id=:app_id AND user_id=:uid) 
			  AND (application_status=:status OR application_status=:Hstatus OR application_status=:payment)";
			  if(!empty($submission_id))
			$sql .= " AND submission_id = $submission_id ";
		$sql .= "ORDER BY submission_id DESC ";
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_STR);
		$command->bindParam(":Hstatus",$Hstatus,PDO::PARAM_STR);
		$command->bindParam(":payment",$payment,PDO::PARAM_STR);
		$applist=$command->queryRow();
		return $applist;
	}

	/**
	*this function is used to update CAF application partially
	*@author Hemant thakur

	*/
	private function updateCafPartially($postData,$submission_id=null){
		$response="";
		@session_start();
		$userDetail=$this->getInvestorDetail();
		if(!$userDetail)
			$this->redirect(SSO_URL1);
		$uid=$userDetail['user_id'];
		$dept_id = 1;
		$app_id = 8;
		$condition ="";
		if(!empty($submission_id))
			$condition = " AND submission_id=$submission_id";
		if (isset($postData['IUID'])){
			// check for existing incomplete application
			$critera = new CDbCriteria;
			$critera->select = 'submission_id,application_status';
			$critera->condition = "application_id=:app_id AND user_id=:user_id AND dept_id=:dept_id AND application_status!=:apprv $condition";
			$critera->params = array(
				":app_id" => $app_id,
				":dept_id" => $dept_id,
				":user_id" => $uid,
				":apprv" => 'A'
			);
			$critera->order = 'submission_id DESC';
			$app_sub_model = ApplicationSubmission::model()->find($critera);
			// echo $app_sub_model['application_status']."<pre>";print_r($postData); die("if");
			// if ($app_sub_model === null or $app_sub_model['application_status'] == 'R' or $app_sub_model['application_status'] == 'A' or $app_sub_model['application_status'] != 'I' or $app_sub_model['application_status'] != 'H'){
			if ($app_sub_model === null or ($app_sub_model['application_status'] != 'I' && $app_sub_model['application_status'] != 'H')){
				// application doesn't exist for current logged in user create new one
				$model = new ApplicationSubmission;
				$model->application_id = $app_id;
				$model->dept_id = $dept_id;
				$model->application_status = 'I';
				$model->user_id = $uid;
				$model->application_created_date = date("Y-m-d H:i:s");;
				$model->ip_address = $_SERVER['REMOTE_ADDR'];
				$model->user_agent = $_SERVER['HTTP_USER_AGENT'];
			}
			else{
				if ($app_sub_model['application_status'] == 'I' or $app_sub_model['application_status'] == 'H'){
					// partially field application
					$model = ApplicationSubmission::model()->findByPk($app_sub_model['submission_id']);
					if($model === null) // not exist
						$response="NA";
				}
				else
					$response="AF"; //already filled
			}
			$model->field_value = json_encode($postData);
			// echo "<pre>";print_r($model); die("here");
			if ($model->save()){
			// print_r($model->attributes);
				$response="SU";
			}
			// print_r(array(json_encode(array("Error"=>"Unknown Error! Please Try Again Later."))));
			return $response;
		}
	}

	 /**
	*this function is used to get the next role id of the verifier(nodal)
	*@author HEmant thakur
	*date: 18 Feb 2016
	*/
	private function getNextRoleId($app_fields){
			 $next_role_id = 7;
			 // if (isset($app_fields->ntrofunit,$app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit=='Manufacturing' && $app_fields->ntrofunittype=='large' && $app_fields->invstmnt_in_plant[0] >10) || ($app_fields->ntrofunit=='Services' && $app_fields->ntrofunittype=='large' && $app_fields->invstmnt_in_plant[0] > 5)))
				// 	$next_role_id = 4;
			return $next_role_id;
				 
	}

	protected function GetUserApplicationDocuments($doc_id,$submission_id){
		$critera = new CDbCriteria;
		$critera->condition = "doc_id=:doc_id and app_submission_id=:app_submission_id";
		$critera->params = array(":doc_id" => $doc_id,':app_submission_id'=>$submission_id);
		$model = AllotmentApplicationDocs::model()->find($critera);
		// echo"<pre>"; print_r($critera); print_r($model); die;
			return $model;
		exit;
	}

	/**
	*this function is used to send the caf to the department
	*@author Hemant Thakur
	*date : 18 Feb 2016
	*/

	private function ForwardToDepartment(){
		@session_start();
		if($this->isInvestorLoggedIn()){
			$uid = $uid = $_SESSION['RESPONSE']['user_id'];
			$sub_id="";
			$app_id=8;
			if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
				$sub_id=$_SESSION["reverted_app_id"];

			$caf = $this->checkLastApplicationStatus($uid, $app_id,$sub_id);
			if(!$caf){
				throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
				exit;
			}
			 echo "<pre>";print_r($distric);die;
			 $revertedBack=false;
			 $logStatus='ISA';
			 // echo "<pre>";print_r($caf)
			 if($caf->application_status=='H'){
				$revertedBack=true;
				$logStatus='IBD';
			 }
			 $caf->landrigion_id=trim($distric);
			 $caf->application_status='P';
			 $caf->application_updated_date_time=date('Y-m-d H:i:s');
			 $caf->application_created_date=date('Y-m-d H:i:s');
			 $caf->reference_number=$this->generateReferenceNumber($caf->submission_id);

			 if($caf->save()){
				$next_role_id=$this->getNextRoleId(json_decode($caf->field_value));
				if(!$revertedBack){
						$verification=new ApplicationVerificationLevel;
						$verification->next_role_id=$next_role_id;
						$verification->app_Sub_id=$caf->submission_id;
						$verification->created_on=date('Y-m-d H:i:s');
						$verification->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$verification->ip_address=$_SERVER['REMOTE_ADDR'];;
						$verification->approv_status='P';
						if($verification->save()){
							ApplicationFlowLogs::generateWorkFlow($caf->submission_id,null,null,null,$uid,$logStatus);
							$field=json_decode($caf->field_value);
							$iuid=$field->IUID;
							$company_name=$field->company_name;
							$mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
							$app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
							$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";
							IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
							// send sms to investor
							$mobile   = $_SESSION['RESPONSE']['mobile_number'];
							$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Your application has been submitted to the department for approval.\r\n";
							IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
							$caf->save();
							 Yii::app()->user->setFlash('Success', "Your Application has been submitted for department Approval. Submission id: ". $caf->submission_id);
							 $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
							 exit;
						}
						else{
							echo "<pre>";print_r($verification->geterrors());
							print_r($verification->attributes);die;
							die;
							 $caf->application_status='P';
							 $caf->save();
							 Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
							 $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home/cafForm'));
						}
				}
				else{
						// reverted back applications
						$lastVerifier=$this->getLastVerifier($caf->submission_id);
						$lastVerifier->approv_status='P';
						if($lastVerifier->save()){
								ApplicationFlowLogs::generateWorkFlow($caf->submission_id,null,null,null,$uid,$logStatus);
								$field=json_decode($caf->field_value);
								$iuid=$field->IUID;
								$company_name=$field->company_name;
								$mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
								$app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
								$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has re-submitted the application for your approval.\r\n";
								IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
								$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));


						}
						else{
								$caf->application_status='H';
								$caf->save();
								Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
								$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home/cafForm'));
								exit;
						}
				}
			 }
			 else{
					echo "<pre>";print_r($caf->geterrors());
					print_r($caf->attributes);die;

					$err='';
					 $cafErrors=$caf->geterrors();
					 foreach ($cafErrors as $key => $errors) {
							 foreach ($errors as $key => $error) {
									 $err.="<li>$error</li>";
							 }
					 }
					Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
					$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home/cafForm'));
					exit;
			 }
		}
		$this->redirect(SSO_URL1);
	}

	/**
	*This function is used to open CAF Application Form
	*@author Hemant thakur
	*/
	public function actionStepOne(){
		@session_start();
		if($this->isInvestorLoggedIn()){	
			$userDetail=$this->getInvestorDetail();
			if(!$userDetail)
				$this->redirect(SSO_URL1);
			 $uid=$userDetail['user_id'];
			 $app_id=8;
			 $sub_id = "";
			 
			 if(isset($_GET['application'])){
			 	// extract($_GET);
				$sub_id = json_encode($_GET);
				$sub_id = json_decode($sub_id);
				$sub_id = $sub_id->department;
				$_SESSION["reverted_app_id"] = $sub_id;
			 }
			 else
			 	unset($_SESSION["reverted_app_id"]);
			 // echo "<pre>=>>>"; print_r($_SESSION); die;
		
			$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
			if(!empty($incmplt_fields) && ($incmplt_fields['application_status'] == "P" || $incmplt_fields['application_status'] == "F")){
				Yii::app()->user->setFlash('Error', "Application Already Filled.");
				$this->redirect(array('/frontuser/home'));
				exit;
			}
			elseif($incmplt_fields['application_status'] == "I" || $incmplt_fields['application_status'] == "RBI" || $incmplt_fields['application_status'] == "B"){
				if(isset($incmplt_fields['field_value']))
					$incmplt_fields=json_decode($incmplt_fields['field_value']);
				$this->render('landStepOne',array("userDetail"=>$userDetail,"incmplt_fields"=>$incmplt_fields,"sub_id"=>$sub_id));
				exit;
			}
			else{
				if(isset($incmplt_fields['field_value']))
					$incmplt_fields=json_decode($incmplt_fields['field_value']);
				$this->render('landStepOne',array("userDetail"=>$userDetail,"incmplt_fields"=>$incmplt_fields,"sub_id"=>$sub_id));
				exit;
			}
		}
		throw new CHttpException(400, "you can't access this page without Investor Login");

	}
 
	public function actionStepTwo(){
		@session_start();
		if($this->isInvestorLoggedIn()){
			// echo "<pre>=>>>"; print_r($_SESSION); die;
			$userDetail=$this->getInvestorDetail();
			if(!$userDetail)
				$this->redirect(SSO_URL1);
			$uid=$userDetail['user_id'];
			$dept_id = 1;
			$app_id = 8;
			$sub_id="";
			if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
				$sub_id=$_SESSION["reverted_app_id"];
			
			$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
			// echo "<pre>=>>>"; print_r($incmplt_fields); die;
			$pre_filed=$userDetail;
			$app=array("application_id"=>8,"dept_id"=>1);
			$industries=DefaultUtility::getTypeOfIndustries();
			if(isset($_POST['IUID'])){
				$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
				if(!isset($_POST['YII_CSRF_TOKEN']))
					throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
						if($YII_CSRF_TOKEN2 != $_POST['YII_CSRF_TOKEN']){
							throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
							exit;
						}
					if(isset($_POST['YII_CSRF_TOKEN']))
						unset($_POST['YII_CSRF_TOKEN']);

				$postData=DefaultUtility::sanatizeParams($_POST);
				if(!empty($incmplt_fields) && count($incmplt_fields) > 0){
					$allStepsFields=json_decode($incmplt_fields['field_value'],true);
					$postData=array_merge($allStepsFields,$postData);
				}				
				$status=$this->updateCafPartially($postData,$sub_id);
				// echo "$status<pre>";print_r($postData); print_r($incmplt_fields); die("here");
				if($status=='SU'){
					// get the latest incomplete fields
					$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
					if(!empty($incmplt_fields)) 
					   $incmplt_fields = json_decode($incmplt_fields['field_value']);
					if(is_object($incmplt_fields) && isset($incmplt_fields->IUID)){
							$this->render('landStepTwo', array(
							'pre_field' => $pre_filed,
							'app' => $app,
							'incmplt_fields' => $incmplt_fields,
							'dataStepOne'=>$incmplt_fields,
							"industries"=>$industries,"sub_id"=>$sub_id));
							exit;
					}
					else{
						Yii::app()->user->setFlash('Error', "Please fill step 1 First.");
						$this->redirect(array(
							'/frontuser/landAllotment/stepOne'
						));
						exit; 
					}
				}
				else{
					Yii::app()->user->setFlash('Error', "Application Already Filled.");
					$this->redirect(array(
						'/frontuser/landAllotment/stepOne'
					));
					exit;
				}
			}
			else{
				$incmplt_fields = json_decode($incmplt_fields['field_value']);
				if(isset($incmplt_fields->IUID)){
						$this->render('landStepTwo', array(
						'pre_field' => $pre_filed,
						'app' => $app,
						'incmplt_fields' => $incmplt_fields,
						'dataStepOne'=>$incmplt_fields,
						"industries"=>$industries,"sub_id"=>$sub_id));
						exit;
				}
				else{
					$this->redirect(array(
						'/frontuser/landAllotment/stepOne'
					));
					exit;
				}
			}
		}
		throw new CHttpException(400, "you can't access this page without Investor Login");
	}

	public function actionStepThree(){
		@session_start();
		if($this->isInvestorLoggedIn()){
			$userDetail=$this->getInvestorDetail();
			if(!$userDetail)
				$this->redirect(SSO_URL1);
			$uid=$userDetail['user_id'];
			$dept_id = 1;
			$app_id = 8;
			// echo "<pre>";print_r($_POST);die;
			// echo "<pre>=>>>"; print_r($_SESSION); die;
			$sub_id="";
			if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
				$sub_id=$_SESSION["reverted_app_id"];
			// echo "<pre>";print_r($sub_id);die;
			$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
			$pre_filed=$userDetail;
			$app=array("application_id"=>8,"dept_id"=>1);
			$appStatus=$incmplt_fields['application_status'];
			$submission_id = @$incmplt_fields['submission_id'];
			// echo "<pre>";print_r($incmplt_fields);die;
			// echo "<pre>";print_r($incmplt_fields['submission_id']);die;

			if(isset($_POST['edu_cert_qual'])){
				$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
				if(!isset($_POST['YII_CSRF_TOKEN']))
					throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
						if($YII_CSRF_TOKEN2 != $_POST['YII_CSRF_TOKEN']){
								throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
								exit;
						}
				if(empty($incmplt_fields)){
					Yii::app()->user->setFlash('Error', "Please fill step 1 first.");
					$this->redirect(array(
						'/frontuser/landAllotment/stepOne'
					));
					exit;
				}
				$postData=DefaultUtility::sanatizeParams($_POST);
				if(!empty($incmplt_fields)){
					$allStepsFields=json_decode($incmplt_fields['field_value'],true);
					$postData=array_merge($allStepsFields,$postData);
				}
				
				$status=$this->updateCafPartially($postData,$sub_id);
				// echo "$status<pre>";print_r($postData);die;
				if($status=='SU'){
					// echo "<pre>";print_r($postData);die;
					// get the latest incomplete fields
					$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
					if (!empty($incmplt_fields)) 
						$incmplt_fields = json_decode($incmplt_fields['field_value']);

					// echo "<pre>";print_r($incmplt_fields);die;
					if(is_object($incmplt_fields) && isset($incmplt_fields->edu_cert_qual)){
						$this->render('landStepThree', array(
							'pre_field' => $pre_filed,
							'app' => $app,
							'incmplt_fields' => $incmplt_fields,
							'status'=>$appStatus,
							'submission_id'=>$submission_id,"sub_id"=>$sub_id));
						exit;
					}
					else{
						$this->render('landStepTwo', array(
							'pre_field' => $pre_filed,
							'app' => $app,
							'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
						exit;
					}
				}
				else{
					Yii::app()->user->setFlash('Error', "Application Already Filled.");
					$this->redirect(array(
				 		'/frontuser/landAllotment/stepOne'
					));
					exit;
				}
			}
			else{
				$incmplt_fields = json_decode($incmplt_fields['field_value']);
				if(isset($incmplt_fields->edu_cert_qual)){
						$this->render('landStepThree', array(
						'pre_field' => $pre_filed,
						'app' => $app,
						'incmplt_fields' => $incmplt_fields,
						'status'=>$appStatus,
						'submission_id'=>$submission_id,"sub_id"=>$sub_id));
						exit;
				}
				else{
					$this->redirect(array(
						'/frontuser/landAllotment/stepTwo'
					));
					exit;
				}
			}
			// // echo "<pre>";print_r($data); die("herer");
			// $this->render('cafFormStep3',array("userDetail"=>$userDetail,"dataStepOne"=>$dataStepOne));
			// exit;
		}
		throw new CHttpException(400, "you can't access this page without Investor Login");
	}

	public function actionStepFour(){
		@session_start();
		if($this->isInvestorLoggedIn()){
			$userDetail=$this->getInvestorDetail();
			if(!$userDetail)
				$this->redirect(SSO_URL1);
			$uid=$userDetail['user_id'];
			$dept_id = 1;
			$app_id = 8;
			$sub_id="";
			if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
				$sub_id=$_SESSION["reverted_app_id"];
			$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
			$pre_filed=$userDetail;
			$app=array("application_id"=>8,"dept_id"=>1);
			if(isset($_POST['YII_CSRF_TOKEN'])){
				$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
				if(!isset($_POST['YII_CSRF_TOKEN']))
					throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
						if($YII_CSRF_TOKEN2 != $_POST['YII_CSRF_TOKEN']){
								throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
								exit;
						}
				if(empty($incmplt_fields)){
					Yii::app()->user->setFlash('Error', "Please fill step 3 first.");
					$this->redirect(array(
						'/frontuser/landAllotment/stepThree'
					));
					exit;
				}
				$postData=DefaultUtility::sanatizeParams($_POST);

				// echo "<pre>"; print_r($postData); die;
				if(!empty($incmplt_fields)){
					$allStepsFields=json_decode($incmplt_fields['field_value'],true);
					$postData=array_merge($allStepsFields,$postData);
				}

				$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);

				$status=$this->updateCafPartially($postData,$sub_id);

				if($status=='SU'){
					if (!empty($incmplt_fields)) {
						$submission_id=$incmplt_fields['submission_id'];
						$incmplt_fields = json_decode($incmplt_fields['field_value']);
						}
						if(is_object($incmplt_fields) && isset($_POST['docs_upload']) && $_POST['docs_upload'] == "true") {
							/*$this->render('landStepFour', array(
								'pre_field' => $pre_filed,
								'app' => $app,
								'incmplt_fields' => $incmplt_fields
							));*/
							/**
							* commented & added by Hemant thakur
							*/
							if($this->hasAlreadyPaid($submission_id,$app_id)){
						          $detail=$this->getPaymentDetail($_SESSION['RESPONSE']['user_id'],$submission_id,$app_id);
					              $this->render('landStepFive', array(
					                  'response' => 'APD',
					                  'detail'=>$detail,
					                  'statusCode'=>'S',
					                  'app_sub_id' => $submission_id,
					                  'land_reg' => $incmplt_fields->district,
					                  'app' => $app,
					                  'pre_field' => $_SESSION['RESPONSE'],
					                  'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
								exit;
							}
							$paymentAmount=$this->getPaymentAmount($incmplt_fields);
							$this->render('payment', array(
							    "submission_id" => $submission_id,
							    "iuid" => $_SESSION['RESPONSE']['iuid'],
							    'application_id' => $app_id,
							    "amount" => $paymentAmount,"sub_id"=>$sub_id));
							exit;
								exit;
						}
						else{
							$this->render('landStepThree', array(
								'pre_field' => $pre_filed,
								'app' => $app,
								'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
								exit;
						}
				}
			}
			else{
				$incmplt_fields = json_decode($incmplt_fields['field_value']);
				if(isset($incmplt_fields->docs_upload)){
						$this->render('landStepFour', array(
						'pre_field' => $pre_filed,
						'app' => $app,
						'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
						exit;
				}
				else{
					$this->redirect(array('/frontuser/home'));
					exit;
				}
			}
			// $this->render('cafFormStep4',array("userDetail"=>$userDetail,"dataStepOne"=>$dataStepOne));
			// exit;
		}
		throw new CHttpException(400, "you can't access this page without Investor Login");
	}

	private function UpdateApplicationVerificationLevel($app_sub_id,$status){
		$criteria=new CDbCriteria;
		$criteria->condition="app_Sub_id=:app_sub_id AND approv_status='H'";
		$criteria->params=array(":app_sub_id"=>$app_sub_id);
		$criteria->order="appr_lvl_id DESC";
		$model=ApplicationVerificationLevel::model()->find($criteria);
			if(empty($model)){
				$criteria->condition="app_Sub_id=:app_sub_id AND approv_status='P'";
				$criteria->params=array(":app_sub_id"=>$app_sub_id);
				$criteria->order="appr_lvl_id DESC";
				$model=ApplicationVerificationLevel::model()->find($criteria);	
			}
			if(empty($model) && !isset($model))
				$model = new ApplicationVerificationLevel;
			$model->next_role_id = $this->getNextRoleId($app_sub_id);
			$model->app_Sub_id = $app_sub_id;
			$model->created_on = date("Y-m-d H:i:s");
			$model->ip_address = $_SERVER['REMOTE_ADDR'];
			$model->user_agent = $_SERVER['HTTP_USER_AGENT'];
			$model->approv_status = $status;

		// echo "<pre>"; print_r($model); die;
			
		if($model->save())
			return true;
		else
			return false;
	}

	public function actionStepFive(){
		@session_start();
		if($this->isInvestorLoggedIn()){
			$userDetail=$this->getInvestorDetail();
			if(!$userDetail)
				$this->redirect(SSO_URL1);
			$uid=$userDetail['user_id'];
			$dept_id = 1;
			$app_id = 8;
			$sub_id="";
			if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
				$sub_id=$_SESSION["reverted_app_id"];
			$incmplt_fields = $this->checkLastApplicationStatus($uid, $app_id,$sub_id);
			$pre_filed=$userDetail;
			$app=array("application_id"=>8,"dept_id"=>1);
			if(isset($_POST['YII_CSRF_TOKEN'])){
				$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
				if(!isset($_POST['YII_CSRF_TOKEN']))
					throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
						if($YII_CSRF_TOKEN2 != $_POST['YII_CSRF_TOKEN']){
								throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
								exit;
						}
				if(empty($incmplt_fields)){
					Yii::app()->user->setFlash('Error', "Please fill step 3 first.");
					$this->redirect(array(
						'/frontuser/landAllotment/stepThree'
					));
					exit;
				}
				$postData=DefaultUtility::sanatizeParams($_POST);

				if(!empty($incmplt_fields)){
					$allStepsFields=json_decode($incmplt_fields['field_value'],true);
					$postData=array_merge($allStepsFields,$postData);
				}

				$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);

				$status=$this->updateCafPartially($postData,$sub_id);
				// echo "$status<pre>"; print_r($incmplt_fields); print_r($_POST);die;
				if($status=='SU'){
					if(isset($_POST['payment_mode'])){
						// echo "$status<pre>"; print_r($incmplt_fields); print_r($_POST);die;
						$incmplt_fields = json_decode($incmplt_fields['field_value']);
						$this->render('landStepFive', array(
							'pre_field' => $pre_filed,
							'app' => $app,
							'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
						exit;
					}
					else{
						$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
						$landrigion_id = json_decode($incmplt_fields['field_value']);
						// echo "<pre>"; print_r($landrigion_id); die;
						$updated_date = "";
						$updateStatus=$this->submitApplication($incmplt_fields['submission_id'],'P',$updated_date,$landrigion_id->district);
						if($updateStatus==""){
							Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
							$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/landAllotment/landStepFive'));
							exit;
						}
						// $updateStatus = $this->UpdateApplicationVerificationLevel($incmplt_fields['submission_id'],'P');
						// if(!$updateStatus){
						// 	Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application.Please try again later");
						// 	$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/landAllotment/landStepOne'));
						// 	exit;
						// }
						Yii::app()->user->setFlash('Success', "Your Application has been submitted for department Approval.");
						$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
						exit;
					}
				}
			}
			else{
				$incmplt_fields = json_decode($incmplt_fields['field_value']);
				if(isset($incmplt_fields->payment_mode)){
						$this->render('landStepFive', array(
						'pre_field' => $pre_filed,
						'app' => $app,
						'incmplt_fields' => $incmplt_fields,"sub_id"=>$sub_id));
					exit;
				}
				else{
					$this->redirect(array('/frontuser/home'));
					exit;
				}
			}
			// $this->render('cafFormStep4',array("userDetail"=>$userDetail,"dataStepOne"=>$dataStepOne));
			// exit;
		}
		throw new CHttpException(400, "you can't access this page without Investor Login");
	}
	/**
	* this function is used to check the payment corresponding the application
	* @author HEmant thakur
	*/
	private function haveInvestorAlreadyPaid($uid,$app_sub_id,$app_id){
			$criteria=new CDbCriteria;
			$criteria->condition="app_sub_id=:app_sub_id and application_id=:app_id";
			$criteria->params=array(":app_sub_id"=>$app_sub_id,":app_id"=>$app_id);
			$criteria->order="payment_id DESC";
			$payment=PaymentHdfc::model()->find($criteria);
			// echo "<pre>";print_r($payment);print_r($criteria->params);die("here");
			if($payment===null || empty($payment))
					return false;
			return $payment;    

	}
	/**
	* this function is used to get the last payment status of the application
	*@author HEmant thakur
	*Date 19 March 2017
	*/
	private function hasAlreadyPaid($sub_id,$app_id=1){
		$criteria=new CDbCriteria;
		$criteria->condition="app_sub_id=:app_sub_id AND application_id=:app_id";
		$criteria->params=array(":app_sub_id"=>$sub_id , ":app_id"=>$app_id);
		$payment=PaymentDetail::model()->findAll($criteria);
		if($payment===null || empty($payment)){
		  return false;
		}
		$hasSuccess=false;
		foreach ($payment as $key => $pay) {
		  if($pay->statusCode=='S')
		    $hasSuccess=true;
		}
		return $hasSuccess;
	}

	protected function getCountryStateName($lr_id){
		$countryState=Landregion::model()->findByPk($lr_id);
		if($countryState===null)
			return false;
		return $countryState->lr_name;

	}
	/**
	* this function is used to partially save the caf application
	*@author Hemant Thakur
	*date : 18 March 2017
	*/   
	private function checkLastApplicationStatus($uid,$app_id,$sub_id){
		$conditon="";
		if(!empty($sub_id)){
			$conditon="submission_id=$sub_id AND";
		}
		$criteria=new CDbCriteria;
		$criteria->condition=" $conditon user_id=:uid AND application_id=:app_id AND (application_status='I' || application_status='H' || application_status='B')";
		$criteria->params=array(":uid"=>$uid,":app_id"=>$app_id);
		$criteria->order="submission_id DESC";
		$model=ApplicationSubmission::model()->find($criteria);
		// echo "=>>>><pre>"; print_r($criteria); print_r($model); die("Asdasd");
		if($model===null)
				return false;
		return $model;
	}

	private function getPlotAreaFromPlotId($plotId){
		$model=LaAuctionPlots::model()->findByPk($plotId);
		if($model===null)
			throw new Exception("Request not found on server.", 404);
		return $model->plot_area;
			
	}
	private function getLandApplicationAmount($fields){
		$amount=2000;
		$toatlArea=0;
		// echo "<pre>";print_r($fields->area_square_meter);die;
		foreach ($fields->area_square_meter as $key => $area){
			$selectedArea=$this->getPlotAreaFromPlotId($area);
			$toatlArea+=$selectedArea;
		} 
		if($toatlArea>200)
			$amount=5000;
		return $amount;

	}

	/**
	*this function is used to get the payment amount of the CAF Application
	*@author Hemant Thakur
	*/
	private function getPaymentAmount($caf_fields){
			$amount=$this->getLandApplicationAmount($caf_fields);
			return $amount;

	}
	/**
	*this function is used to get the district of the CAF application to be submitted
	*@author HEmant thakur
	*date : 18 March 2017
	*/
	private function getDistrictOfCAF($fields){
			// echo "<pre>";print_r($fields);die;
			$distric=null;
			if((isset($fields->Land_in_Hectares) && !empty($fields->Land_in_Hectares)) && (isset($fields->land_leased_disctric) && !empty($fields->land_leased_disctric)))
					$distric=trim($fields->land_leased_disctric);
			else
					$distric=trim($fields->land_disctric);
			if(isset($fields->ntrofunit,$fields->invstmnt_in_plant[0]) && (($fields->ntrofunit=='Manufacturing' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] > 10) || ($fields->ntrofunit=='Services' && $fields->ntrofunittype=='large' && $fields->invstmnt_in_plant[0] > 5)))
					$distric=6;
			// echo $distric;die;
			return $distric;
	}
	private function submitApplication($app_sub_id,$status='P',$updated_date=false,$landrigion_id=null){
		@session_start();
		$uid = $uid = $_SESSION['RESPONSE']['user_id'];
		$sub_id="";
		$app_id=8;
		if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
			$sub_id=$_SESSION["reverted_app_id"];

		$caf = $this->checkLastApplicationStatus($uid, $app_id,$sub_id);
		if(!$caf){
			throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
			exit;
		}
		
		$revertedBack=false;
		$logStatus='ISA';
		if($caf->application_status=='H'){
			$revertedBack=true;
			$logStatus='IBD';
		}
		// echo "<pre>"; print_r($caf); die;
		$caf->landrigion_id=$landrigion_id;
		$caf->application_status='P';
		$caf->application_updated_date_time=date('Y-m-d H:i:s');
		$caf->application_created_date=date('Y-m-d H:i:s');

		$AppStatus="";
		if($caf->save()){
			$next_role_id=$this->getNextRoleId(json_decode($caf->field_value));
			if(!$revertedBack){
				$verification=new ApplicationVerificationLevel;
				$verification->next_role_id=$next_role_id;
				$verification->app_Sub_id=$caf->submission_id;
				$verification->created_on=date('Y-m-d H:i:s');
				$verification->user_agent=$_SERVER['HTTP_USER_AGENT'];
				$verification->ip_address=$_SERVER['REMOTE_ADDR'];;
				$verification->approv_status='P';
				if($verification->save()){
					ApplicationFlowLogs::generateWorkFlow($caf->submission_id,null,null,null,$uid,$logStatus);
					$field=json_decode($caf->field_value);
					$iuid=$field->IUID;
					$company_name=$field->company_name;
					$mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
					$app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
					$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has submitted the application for your approval.\r\n";
					IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
					// send sms to investor
					$mobile   = $_SESSION['RESPONSE']['mobile_number'];
					$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Your application has been submitted to the department for approval.\r\n";
					IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
					$caf->save();
					$AppStatus="app_submit";
					// Yii::app()->user->setFlash('Success', "Your Application has been submitted for department Approval. Submission id: ". $caf->submission_id);
					// $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
					// exit;
				}
				else{
					echo "<pre>";print_r($verification->geterrors());
					print_r($verification->attributes);die;
					die;
					// $caf->application_status='P';
					// $caf->save();
					// $AppStatus="app_not_submit";
					 // Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application to department.Please try again later");
					 // $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home/cafForm'));
				}
			}
			else{
				// reverted back applications
				$lastVerifier=$this->getLastVerifier($caf->submission_id);
				$lastVerifier->approv_status='P';
				if($lastVerifier->save()){
					ApplicationFlowLogs::generateWorkFlow($caf->submission_id,null,null,null,$uid,$logStatus);
					$field=json_decode($caf->field_value);
					$iuid=$field->IUID;
					$company_name=$field->company_name;
					$mobile=IncentiveSchemes::getboUserMobileFromRoleID($caf->submission_id,$next_role_id);
					$app_name=IncentiveSchemes::getAppNameFromSubmissionId($caf->submission_id);
					$msgDept="Application Name: $app_name\r\nApplication ID: ".$caf->submission_id."\r\nIUID: $iuid\r\nCompany Name: $company_name\r\nMessage: Investor has re-submitted the application for your approval.\r\n";
					IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
					$AppStatus="app_reverted";
					// $this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
				}
				else{
					$caf = $this->checkLastApplicationStatus($uid, $app_id,$sub_id);
					$caf->application_status='H';
					$caf->save();
				}
			}
		}
		else{
			$appErrors=$model->geterrors();
			echo "<pre>"; print_r($appErrors); die;
			foreach ($appErrors as $key => $errors) {
			  foreach ($errors as $key => $error) {
				$AppStatus.='<li>'.$error.'</li>';
			  }
			}
		}

		return $AppStatus;
			// $err='';
			// $model=ApplicationSubmission::model()->findByPk($app_sub_id);
			// if($model===null)
			// 	throw new Exception("Something went wrong", 404);
			// $model->application_status=$status;
			// $model->landrigion_id=null;
			// if($updated_date)
			// 	$model->application_updated_date_time=date('Y-m-d H:i:s');
			// if(!is_null($landrigion_id))
			// 	$model->landrigion_id=$landrigion_id;
			// if($model->save()){
			// 	$err="OK";
			// return $err;
			// }
			// $appErrors=$model->geterrors();
			// foreach ($appErrors as $key => $errors) {
			//   foreach ($errors as $key => $error) {
			// 	$err.='<li>'.$error.'</li>';
			//   }
			// }
			// return $err;
	}

	private function getPaymentDetail($uid,$app_sub_id,$app_id){
			$criteria=new CDbCriteria;
			$criteria->condition="app_sub_id=:app_sub_id and application_id=:app_id";
			$criteria->params=array(":app_sub_id"=>$app_sub_id,":app_id"=>$app_id);
			$criteria->order="payment_id DESC";
			$payment=PaymentDetail::model()->find($criteria);
			// echo "<pre>";print_r($payment);print_r($criteria->params);die("here");
			if($payment===null || empty($payment))
					return false;
			return $payment;    

	}
	private function generateReferenceNumber($cafID){
		$ref_num="CAF/".date('m/d')."/$cafID/".mt_rand(100, 999);
		return $ref_num;		

	}
	 /**
		*this function is used to get the last verifier application
		*@author Hemant thakur
		*date 18 Feb 2016
		*/
		private function getLastVerifier($app_sub_id){
				$criteria=new CDbCriteria;
				$criteria->condition="app_Sub_id=:app_sub_id AND approv_status='H'";
				$criteria->params=array(":app_sub_id"=>$app_sub_id);
				$criteria->order="appr_lvl_id DESC";
				$model=ApplicationVerificationLevel::model()->find($criteria);
				if($model===null)
						return false;
				return $model;
		}
	/**
	* this function is used to submit the caf application
	*@author Hemant Thakur
	*date : 18 March 2017
	*/
	public function actionSubmitCafApplication(){
			if($this->isInvestorLoggedIn()){
				 $uid = $uid = $_SESSION['RESPONSE']['user_id'];
				 $caf=$this->checkLastApplicationStatus($uid,8);
				 if(!$caf){
					throw new Exception("Something went wrong. Please contact Adminstrator. Error Code is: 404", 404);
					exit;
				 }
				 if(!isset($_POST['YII_CSRF_TOKEN'])){
					throw new Exception("Invalid request found.", 403);
					
				 }
				 $YII_CSRF_TOKEN = Yii::app()->request->csrfToken;
				 // echo "<pre>";prev(array)int_r($_POST);
				 $post=DefaultUtility::sanatizeParams($_POST);
				 // echo "<pre>";print_r($caf->field_value);
				 if($YII_CSRF_TOKEN!=$post['YII_CSRF_TOKEN'])
					 throw new Exception("Invalid Request", 1);
				 unset($post['YII_CSRF_TOKEN']);
				 $paymentCheck=$this->haveInvestorAlreadyPaid($uid,$caf->submission_id,$caf->application_id);
				 $paymentDetail=$this->getPaymentDetail($uid,$caf->submission_id,$caf->application_id);
				 if($this->hasAlreadyPaid($caf->submission_id)){
					// case might be of reverted back application whose payment already done.
					$paymentAmount=$this->getPaymentAmount($caf->field_value);
					$distric=$this->getDistrictOfCAF(json_decode($caf->field_value));
					// echo "<pre>=====>";print_r($paymentAmount);die;
					$this->render('cafAfterPayment', array(
							'statusCode'=>$paymentDetail->status,
							'amount'=>$paymentDetail->txn_amt,
							'orderId'=>$paymentDetail->clnt_txn_ref,
							'transaction'=>$paymentDetail->tpsl_txn_id,
							'response' => 'NONE',
							'app_sub_id' => $caf->submission_id,
							'land_reg' => $distric,
							'pre_field' => $_SESSION['RESPONSE'],
							'statusCode'=>'S',
							'incmplt_fields' => json_decode($caf->field_value)
					));
					exit;

				 }
				 else{
					// payment not done yet check whether payment is required or not
							$paymentAmount=$this->getPaymentAmount($caf->field_value);
							$departmentPayments=$this->getDepartmentPayments(json_decode($caf->field_value));
							// echo $departmentPayments;die;
							$distric=$this->getDistrictOfCAF(json_decode($caf->field_value));
							if($paymentAmount==0){
									// case of micro industry
								 $this->render('cafAfterPayment', array(
										 'response' => 'NONE',
										 'app_sub_id' => $caf->submission_id,
										 'land_reg' => $distric,
										 'pre_field' => $_SESSION['RESPONSE'],
										 'statusCode'=>'S',
										 'incmplt_fields' => json_decode($caf->field_value)
								 ));
								 exit;
							}else{
									$updateStatus=$this->submitApplication($caf->submission_id,'I');
									if($updateStatus!='OK'){
											Yii::app()->user->setFlash('Error', "Sorry! Could not submit the application.Please try again later");
											$this->redirect(Yii::app()->createAbsoluteUrl('frontuser/home'));
											exit;
									}
									$this->render('payment', array(
											"submission_id" => $caf->submission_id,
											"iuid" => $_SESSION['RESPONSE']['iuid'],
											'application_id' => $caf->application_id,
											"amount" => $paymentAmount,
											"deptPayments"=>$departmentPayments
									));
									exit;
									// echo "<pre>";print_r($paymentAmount);die;
							}
					// hold application and micro industry case
				 }

				 // echo "<pre>";print_r($caf);die;

			}
		 $this->redirect(SSO_URL1);


	}
	/**
	// This function is used to save documents of step 4
	**/
		public function actionUploadInvestorDocs(){
			if($this->isInvestorLoggedIn()){
				$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
				if(!isset($_POST['FileUpload']['YII_CSRF_TOKEN']))
					throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
				
				if($YII_CSRF_TOKEN2 != $_POST['FileUpload']['YII_CSRF_TOKEN']){
						throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
						exit;
				}
				$response="";
				$userDetail=$this->getInvestorDetail();
				if(!$userDetail)
					$this->redirect(SSO_URL1);
				$uid=$userDetail['user_id'];
				$dept_id = 1;
				$app_id = 8;
				$sub_id="";
				if(isset($_SESSION["reverted_app_id"])&&!empty($_SESSION["reverted_app_id"]))
					$sub_id=$_SESSION["reverted_app_id"];
				$incmplt_fields = $this->getUsersCAFApplicationsOfUser($uid, $app_id,$sub_id);
				$pre_filed=$userDetail;
				$app=array("application_id"=>8,"dept_id"=>1);
				// echo "<pre>"; print_r($_POST); print_r($_FILES); die;
				if (isset($_FILES) && !empty($_FILES['caf_applications_uploads']['tmp_name'])){
						if (!empty($app_id))
							$dept_id = ApplicationExt::getDeptIdFromAppId($app_id);
						if(isset($_POST['FileUpload'])){
							$prop_array = ApplicationCdnMappingExt::getDocumentProperties($_POST['FileUpload']['doc_id']);
							if(!$prop_array){
								// die("prop_array_error");
								Yii::app()->user->setFlash('danger', "Uploaded document could not match with uploaded document.");
								$this->redirect(array('/frontuser/landAllotment/stepOne'));
								exit;
							}
							// check for file type
							if($prop_array['doc_type']=='image/jpeg'){
								if($_FILES['caf_applications_uploads']['type']!='image/jpeg'){
									if($_FILES['caf_applications_uploads']['type']!='image/png'){
										Yii::app()->user->setFlash('danger', "Please upload JPG/PNG file only.");
										$this->redirect(array('/frontuser/landAllotment/stepThree/'));
										exit;
									}
								}
							}
							if($prop_array['doc_type']=='pdf'){
								if($_FILES['caf_applications_uploads']['type']!='application/pdf'){
									Yii::app()->user->setFlash('danger', "Please upload pdf file only.");
									$this->redirect(array('/frontuser/landAllotment/stepThree/'));
									exit;
								}
							}
							// check for file size
							$doc_size=$prop_array['doc_max_size'] / 1000;
							$uploaded_size=$_FILES['caf_applications_uploads']['size'] / 1000000;
							if($uploaded_size > $doc_size){
								Yii::app()->user->setFlash('danger', "Please upload File of $doc_size Mb.");
								$this->redirect(array('/frontuser/landAllotment/stepThree/'));
								exit;
							}
							unset($doc_size);
							unset($uploaded_size);
							// all ok .. upload file on cdn
							$imgData = file_get_contents($_FILES['caf_applications_uploads']['tmp_name']);
							$post_data = array();
							$hash = hash_hmac('sha1', md5($uid . $app_id) , CDN_PUBLIC_KEY);
							$filename=$_FILES['caf_applications_uploads']['name'];
							// check whether authorized letter or not
							if(isset($_POST['FileUpload']['authorization_letters_type']) && !empty($_POST['FileUpload']['authorization_letters_type'])){
								if($_FILES['caf_applications_uploads']['type']=="application/pdf")
									$filename=$_POST['FileUpload']['authorization_letters_type'].".pdf";
								if($_FILES['caf_applications_uploads']['type']=="image/jpeg" || $_FILES['caf_applications_uploads']['type']=="image/png")
									$filename=$_POST['FileUpload']['authorization_letters_type'].".png";
							}
							if(isset($_POST['custom_other_doc']) && !empty($_POST['custom_other_doc'])){
								if($_POST['selected_doc_type']=="application/pdf")
									$filename=str_replace(" ","_",$_POST['custom_other_doc']).".pdf";
							}
							$post_data = array(
									'user_id' => $uid,
									'app_id' => $app_id,
									'api_hash' => $hash,
									'doc_id' => $_POST['FileUpload']['doc_id'],
									'dept_id' => $dept_id,
									'doc_name' => $filename,
									'doc_type' => $_FILES['caf_applications_uploads']['type'],
									'doc_size' => $_FILES['caf_applications_uploads']['size'],
									'doc_blob_data' => base64_encode($imgData),
									'submission_id' => $incmplt_fields['submission_id']
							);
							// echo "<pre>"; print_r($incmplt_fields); print_r($post_data); print_r($_POST); die;
							$response = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
							// $response = DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data);
							// echo "<pre>"; print_r($response); die;
							if (is_object($response)){
								if (isset($response->STATUS) && $response->STATUS == 200){
									Yii::app()->user->setFlash('success', "Files uploaded successfully.");
									$this->redirect(array('/frontuser/landAllotment/stepThree/'));
									exit;
								}
								else{
									Yii::app()->user->setFlash('danger', "File could not uploaded.");
									$this->redirect(array('/frontuser/landAllotment/stepThree/'));
									exit;
								}
							}
							else{
								Yii::app()->user->setFlash('danger', "File could not uploaded.");
								$this->redirect(array('/frontuser/landAllotment/stepThree/'));
								exit; 
							}
						}
						else{
							echo "generate invalid requested error";
						}
				}
				else{
					Yii::app()->user->setFlash('Error', "Invalid Request.");
					$this->redirect(array('/frontuser'));
				}
			}
			throw new CHttpException(400, "you can't access this page without Investor Login");
		}

		/* Function is used to get the payment response
		 *  @ Author : Hemant Thakur
		 *  @ params : none
		 @ return : 
		 */
		public function actionPaymentResponse()
		{
		    @session_start();

		    if(isset($_REQUEST['merchantResponse'])){
		      $responseMerchant = $_REQUEST['merchantResponse'];
		      $obj = new AWLMEAPI();
		      $resMsgDTO = new ResMsgDTO();
		      $reqMsgDTO = new ReqMsgDTO();
		      $enc_key = WORLDLINE_ENCRYP_KEY;
		      $app=array("application_id"=>8,"dept_id"=>1);
		      $response = $obj->parseTrnResMsg($responseMerchant , $enc_key );
             // echo "<pre>";print_r($response);die;
		      $app_sub_id=$response->getAddField1();
		      $app_id=$response->getAddField2();
		      $iuid=$response->getAddField3();
		      $paymentModel = new PaymentDetail();
		      $paymentModel->pgMeTrnRefNo=$response->getPgMeTrnRefNo();
		      $paymentModel->orderId=$response->getOrderId();
		      $paymentModel->authZStatus=$response->getAuthZCode();
		      $paymentModel->bank_reference_bank=$response->getRrn();
		      $paymentModel->user_id=$iuid;
		      $paymentModel->application_id=$app_id;
		      $paymentModel->app_sub_id=$app_sub_id;
		      $paymentModel->amount=$response->getTrnAmt();
		      $paymentModel->trnReqDate=$response->getTrnReqDate();
		      $paymentModel->statusCode=$response->getStatusCode();
		      $paymentModel->status_description=$response->getStatusDesc();
		      if($paymentModel->save()){
		      	if($response->getStatusCode()=='F'){
		      		Yii::app()->user->setFlash('Error', "Payment has been declined.");
		      		$this->redirect(array('/frontuser'));
		      		exit;
		      	}
		      // if(1){
		      	// echo $app_sub_id;die;
		        $incmplt_fields = ApplicationSubmissionExt::getSubmittedApplication($app_sub_id);
		        $land_reg = '';
		        if (!empty($incmplt_fields)) {
		            $land_reg = $incmplt_fields['landrigion_id'];
		            $incmplt_fields = json_decode($incmplt_fields['field_value']);
		            $appName=ApplicationExt::getAppNameViaId($app_id);
		            $land_reg=$incmplt_fields->district;
		            $detail=$this->getPaymentDetail($_SESSION['RESPONSE']['user_id'],$app_sub_id,$app_id);
	              $this->render('landStepFive', array(
	                  'response' => $response,
	                  // 'response' => 'APD',
	                  'detail'=>$detail,
	                  'statusCode'=>'S',
	                  'app_sub_id' => $app_sub_id,
	                  'land_reg' => $land_reg,
	                  'app' => $app,
	                  'pre_field' => $_SESSION['RESPONSE'],
	                  'incmplt_fields' => $incmplt_fields
	              ));
		        }
		        else{
		        	// echo "<pre>";print_r($incmplt_fields);die;
		            Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
		            $this->redirect(array('/frontuser'));
		            exit;
		        }
		      }
		      else{
		        echo "<pre>";print_r($paymentModel->geterrors());
		      }
		      
		    }
		    else{
		        Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
		        $this->redirect(array('/frontuser'));
		        exit;
		    }
		    
		}


		public function actionTimeline(){
			@session_start();
			if (isset($_SESSION['RESPONSE'])){
				if (isset($_GET['app_id']) && !empty($_GET['app_id'])){
					$app_id = $_GET['app_id'];
					$app_comments = ApplicationApproveLevelExt::getApplicationComments($app_id);
					if (!empty($app_comments) && isset($app_comments)){
						$this->render('timeline', array(
							'app_comments' => $app_comments
						));
						unset($_GET['app_id']);
					}
					else{
						Yii::app()->user->setFlash('error', "No Data Found");
						$this->redirect(Yii::app()->homeUrl);
					}
				}
			}
			else{
				$this->redirect(Yii::app()->homeUrl);
			}
		}


		public function ActionEstateList() {

        /* $SqlQuery="SELECT `land_estate_name`,bo_district.distric_name,la_auction_plots.area_name,la_auction_plots.plot_area,la_auction_detail.auc_start_date,la_auction_detail.auc_end_date,la_auction_detail.auc_status FROM `la_estates` LEFT JOIN `bo_district` ON la_estates.district_id = bo_district.district_id 
          RIGHT JOIN la_auction_plots ON la_estates.land_estate_id=la_auction_plots.estate_id RIGHT JOIN la_auction_detail on la_auction_plots.auc_plot_id=la_auction_detail.plot_id";
         */
        $SqlQuery = "select l.estate_id,d.distric_name, e.land_estate_name,MAX(l.auc_end_date) as open_till
from la_auction_detail l
join bo_district d on d.district_id = l.district_id
join la_estates e on e.land_estate_id = l.estate_id
WHERE l.auc_status='O' AND l.is_active='Y' AND l.auc_end_date>=CURRENT_DATE
group by l.estate_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($SqlQuery);
        $estateList = $command->queryAll();
        //    print_r($estateList);die;
        $this->render('estateList', array(
            'estateList' => $estateList
        ));
    }

}