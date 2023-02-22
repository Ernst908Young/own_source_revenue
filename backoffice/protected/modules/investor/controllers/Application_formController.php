<?php

class Application_formController extends Controller
{
	public function actionIndex()

	{
		
		$this->render('index');
	}
	/* public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
	 public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('generateapplication'),
                'users' => array('demo','rochak'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }*/
     /**
	* this function is used to display all the application of any service provider
	*@author: hemant thakur
    */
    public function actionApplicationList($service,$serviceProvider){
    	if(empty($serviceProvider)){
         	throw new CHttpException(403, "Access Denied");
    	}
    	@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		$applications=SpApplicationsExt::getSPApplicationsAll($serviceProvider);
		$spTag=SpApplicationsExt:: getServiceProvidersInfoFromID($serviceProvider);
		$this->render("selectApplication",array("apps"=>$applications,"service"=>$service,"sp_tag"=>$spTag['service_provider_tag']));
    }
	/**
	* this function is used to display all the application of any service provider
	*@author: Apoorv Singhal
    */
    public function actionApplicationListIncentive($service,$serviceProvider){
    	if(empty($serviceProvider)){
         	throw new CHttpException(403, "Access Denied");
    	}
    	@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		$applications=SpApplicationsExt::getSPApplicationsAll($serviceProvider);
		$spTag=SpApplicationsExt:: getServiceProvidersInfoFromID($serviceProvider);
		$this->render("selectApplicationIncentive",array("apps"=>$applications,"service"=>$service,"sp_tag"=>$spTag['service_provider_tag']));
    }
	/**
	* this function is used to display all the application of any service provider
	*@author: Apoorv
    */
    public function actionApplicationListClaim($service,$serviceProvider){
    	if(empty($serviceProvider)){
         	throw new CHttpException(403, "Access Denied");
    	}
    	@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		$applications=SpApplicationsExt::getSPApplicationsAll($serviceProvider);
		$spTag=SpApplicationsExt:: getServiceProvidersInfoFromID($serviceProvider);
		$this->render("selectApplicationClaim",array("apps"=>$applications,"service"=>$service,"sp_tag"=>$spTag['service_provider_tag']));
    }
    /**
    * @author: Hemant Thakur
    * @return:
    * @param:
    **/

	public function actionGenerateapplication($department,$application){
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		$dept=Utility::getDeptById($department);
		$appfield=Utility::getDeptAppFields($application);
		$user_id='';
		if(isset($_SESSION['RESPONSE']['user_id']))
			$user_id=$_SESSION['RESPONSE']['user_id'];
		$checkExist=Utility::checkForExist($application,$department,$user_id);
		if(!empty($checkExist) && $checkExist->application_status=='P'){
				Yii::app()->user->setFlash('Error', "Error: Your application already Exist in our Database.");
         		$this->redirect(array('/frontuser'));
         		exit;
			}
		$pre_filed=$_SESSION['RESPONSE'];
		$appName=array();
		$appName['name']=Utility::getAppNameFromId($application);
		$appName['id']=$application;
		$this->render('generateapplication',array('dept_field'=>$appfield,'pre_field'=>$pre_filed,'dept'=>$dept,'app'=>$appName,'isUpdate'=>false));

	}
	/** 
	* @author: Hemant Thakur
	*/
	public function actionUpdateHoldApplication($department,$application){
	  		@session_start();
	  		if(!Yii::app()->user->isGuest){
	  			throw new CHttpException(400, "you can't access this page");
	  		}
	  		if(!$_SESSION['LOGGED_IN']){
	  			$this->redirect(SSO_URL1);
	  			exit;
	  		}
	  		$dept=Utility::getDeptById($department);
	  		if(empty($application))
	  			throw new CHttpException(404,'The requested page does not exist.');
	  		$modelSub=ApplicationSubmission::model()->findByPk($application);
	  		if($modelSub===null)
	  			throw new CHttpException(404,'The requested page does not exist.');
	  		if($modelSub->application_status!='H')
						throw new CHttpException(404,'The requested page does not exist.');
						$modelCdn=new ApplicationCdnMappingExt;
			
	  		$submittedVal=ApplicationSubmissionExt::getSubmittedAppviaId($application);
	  		$appfield=Utility::getDeptAppFields($submittedVal['application_id']);
	  		$user_id='';
	  		if(isset($_SESSION['RESPONSE']['user_id']))
	  			$user_id=$_SESSION['RESPONSE']['user_id'];
	  		$pre_filed=$_SESSION['RESPONSE'];
	  		$appName=array();
	  		$appName['name']=Utility::getAppNameFromId($submittedVal['application_id']);
	  		$appName['id']=$submittedVal['application_id'];
	  		if($appName['name']==='CAF'){
	  			$appModel= new ApplicationExt;
	  			$app=ApplicationExt::getCAFId();
	  			$appName['application_id']=$app['application_id'];
	  			$incmplt_fields=$appModel->getUsersCAFApplications($user_id);
	  			if(!empty($incmplt_fields))
	  				$incmplt_fields=json_decode($incmplt_fields[0]['field_value']);
	  				$this->redirect(array('home/cafForm'));
	  			#$this->render('updateCaf',array('pre_field'=>$pre_filed,'incmplt_fields'=>$incmplt_fields,'subId'=>$submittedVal['submission_id'],'dept'=>$dept,'app'=>$appName,'isUpdate'=>TRUE));
	  			exit;
	  		}
			/* Added By : Rahul Kumar , 20032018 */
			if ($appName['name'] === 'Existing CAF') {

                            $appModel = new ApplicationExt;

                            $app = ApplicationExt::getCAFId();

                            $appName['application_id'] = $app['application_id'];

                            $incmplt_fields = $appModel->getUsersCAFApplications($user_id);

                            if (!empty($incmplt_fields))
                                $incmplt_fields = json_decode($incmplt_fields[0]['field_value']);

                            $serviceApplicationUpdateQuery = "UPDATE bo_sp_applications SET app_comments='Existing CAF Application Re-Submited',app_status='P' WHERE app_id=$application AND sp_tag='DOI@908#123'";

                            $serviceDetail = Yii::app()->db->createCommand($serviceApplicationUpdateQuery)->execute();

                            //  print_r($serviceDetail); die;       
                            $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$application AND sp_tag='DOI@908#123'";

                            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

                            if (!empty($applicationDetail)) {
                                $sno = $applicationDetail['sno'];

                                // Save History in bo_sp_application_history

                                $modelSPH = new SpApplicationHistory;

                                $modelSPH->sp_app_id = $sno;

                                $modelSPH->service_id = $applicationDetail['sp_app_id'];

                                $modelSPH->sp_tag = $applicationDetail['sp_tag'];

                                $modelSPH->app_id = $applicationDetail['app_id'];

                                $modelSPH->application_status = 'P';

                                $modelSPH->comments = 'Existing CAF submitted by investor';

                                $modelSPH->added_date_time = date('Y-m-d H:i:s');

                                $modelSPH->save();
                            }

                            $this->redirect(array('existing/cafForm'));

                            #$this->render('updateCaf',array('pre_field'=>$pre_filed,'incmplt_fields'=>$incmplt_fields,'subId'=>$submittedVal['submission_id'],'dept'=>$dept,'app'=>$appName,'isUpdate'=>TRUE));

                            exit;
                        }

	  		$this->render('generateapplication',array('dept_field'=>$appfield,'pre_field'=>$pre_filed,'subVal'=>$submittedVal['field_value'],'subId'=>$submittedVal['submission_id'],'dept'=>$dept,'app'=>$app,'app'=>$appName,'isUpdate'=>TRUE));
	}
	



	/** 
	* @author: Hemant Thakur
	*/


	public function actionUpdateapplication(){
				if(isset($_POST['ApplicationField'],$_POST['ManageApplication'])){
					//upload documents of the user
					$post_data=array();
					$modelCdn=new ApplicationCdnMappingExt;
					$modelDoc= new CdnDms;
					$app_id=$_POST['ManageApplication']['application_id'];
					$dept_id=$_POST['ManageApplication']['dept_id'];
					$user_id=$_POST['ManageApplication']['user_id'];
				if(isset($_FILES) && !empty($_FILES['ApplicationField']['tmp_name'])){
				
				foreach ($_FILES['ApplicationField']['tmp_name'] as $key => $file_content) {
					$imgData =file_get_contents($file_content);
					$post_data=array( );
					$hash=hash_hmac('sha1', md5($user_id.$app_id), CDN_PUBLIC_KEY);
					$post_data=array('user_id'=>$user_id,'app_id'=>$app_id,'api_hash'=>$hash,'doc_id'=>$_POST['ApplicationField']['doc_id'][$key],'dept_id'=>$dept_id,'doc_name'=>$_FILES['ApplicationField']['name'][$key],'doc_type'=>$_FILES['ApplicationField']['type'][$key],'doc_size'=>$_FILES['ApplicationField']['size'][$key],'doc_blob_data'=>base64_encode($imgData));
					$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/saveDocuments',$post_data));
					 echo "<pre>";print_r($response);die;
					if(!$response->STATUS==200 || !$response->STATUS==204){
						Yii::app()->user->setFlash('Error', $response->RESPONSE);
         					  $this->redirect(array('/frontuser'));
         					  exit;
					}
				}
			}
					$modelSub=ApplicationSubmission::model()->findByPk($_POST['ManageApplication']['submition_id']);
					if($modelSub===null)
						throw new CHttpException(404,'The requested page does not exist.');
					$modelSub->field_value=json_encode($_POST['ApplicationField']);
					if($modelSub->application_status!='H')
						throw new CHttpException(404,'The requested page does not exist.');
					$modelSub->application_status='P';
					if($modelSub->save()){
						$criteria=new CDbCriteria;
						$criteria->select='appr_lvl_id';
						$criteria->condition='approv_status=:approv_status';
						$criteria->params=array(':approv_status'=>'H');
						$modelvl = ApplicationVerificationLevel::model()->find($criteria);
						$model=ApplicationVerificationLevel::model()->findByPk($modelvl->appr_lvl_id);
						if($model===null)
							throw new CHttpException(404,'The requested page does not exist.');
						$model->approv_status='P';
						if(!empty($model)){
							if($model->save()){
								Yii::app()->user->setFlash('Success', "Success: Your application has been successfully updated");
         					  $this->redirect(array('/frontuser'));
         					  exit;
							}
							
						}
					}

				}

	}

	/**
    * @author: Hemant Thakur
    * @return:
    * @param:
    **/


	public function actionSubmitapplication(){
		 // echo "<pre>";print_r($_POST);die;
		$model= new ApplicationSubmission;
		$modelDoc= new CdnDms;
		$app_id=$_POST['ManageApplication']['application_id'];
		$dept_id=$_POST['ManageApplication']['dept_id'];
		$user_id=$_POST['ManageApplication']['user_id'];
		if(isset($_POST['ApplicationField'],$_POST['ManageApplication'])){
			//upload documents of the user
			$post_data=array();
			$modelCdn=new ApplicationCdnMappingExt;
			if(isset($_FILES) && !empty($_FILES['ApplicationField']['tmp_name'])){
				// echo "<pre>";print_r($_POST);die("files");
				foreach ($_FILES['ApplicationField']['tmp_name'] as $key => $file_content) {
					$imgData =file_get_contents($file_content);
					$post_data=array( );
					$hash=hash_hmac('sha1', md5($user_id.$app_id), CDN_PUBLIC_KEY);
					$post_data=array('user_id'=>$user_id,'app_id'=>$app_id,'api_hash'=>$hash,'doc_id'=>$_POST['ApplicationField']['doc_id'][$key],'dept_id'=>$dept_id,'doc_name'=>$_FILES['ApplicationField']['name'][$key],'doc_type'=>$_FILES['ApplicationField']['type'][$key],'doc_size'=>$_FILES['ApplicationField']['size'][$key],'doc_blob_data'=>base64_encode($imgData));
					$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/saveDocuments',$post_data));
					if(!$response->STATUS==200 || !$response->STATUS==204){
						Yii::app()->user->setFlash('Error', $response->RESPONSE);
         					  $this->redirect(array('/frontuser'));
         					  exit;
					}
				}
			}
			$checkExist=Utility::checkForExist($app_id,$dept_id,$user_id);
			if($checkExist && $checkExist->application_status=='P'){
				// echo "<pre>";print_r($_POST['ApplicationField']);die('exist');
				Yii::app()->user->setFlash('Error', "Error: Your application already Exist in our Database.");
         		$this->redirect(array('/frontuser'));
         		exit;
			}
			if(!$checkExist OR ($checkExist->application_status=='A') OR ($checkExist->application_status=='R')){
				$app_fields=ApplicationsFieldsMappingExt::getAppFieldsMapbyId($_POST['ManageApplication']['application_id']);

				if(!empty($app_fields)){
					$error="";
					foreach ($_POST['ApplicationField'] as $keys => $fields) {
						foreach ($app_fields as $validation) {
							if($keys==$validation['field_name']){
								if($validation['field_validation']==='address_field_with_space'){
									$inputString = $fields;
									$isSplChar = preg_replace(' /[#@^A-Za-z0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString)
									{
										$error.="<li style='list-style-type:none'>Please Enter $fields address_field_with_space Only.</li>";
									}	
								}
								if($validation['field_validation']==='name_with_space'){
								    $inputString = $fields;
									$isSplChar = preg_replace(' /[^A-Za-z\-]/',' ', $inputString);
									if($isSplChar!=$inputString)
									{
										$error.="<li style='list-style-type:none'>Please Enter $fields name_with_space Only.</li>";
									}	
								}
								if($validation['field_validation']==='alphanumeric_name_with_space'){
									$inputString = $fields;
									$isSplChar = preg_replace(' /[^A-Za-z0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString)
									{
								       $error.="<li style='list-style-type:none'>Please Enter $fields alphanumeric_name_with_space Only.</li>";
								    }
								}
								if($validation['field_validation']==='numbers_only'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString)
									{
								       $error.="<li style='list-style-type:none'>Please Enter $fields alphanumeric_name_with_space Only.</li>";
								    }
								}

								if($validation['field_validation']==='mobile_number_ten_digit_only'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString){
										$error.="<li style='list-style-type:none'>Please Enter digit Only.</li>";
									}
									else{
										if(strlen($inputString) != 10 )
										{
									       $error.="<li style='list-style-type:none'>Please Enter $fields mobile_number_ten_digit_only Only.</li>";
									    }	
									}
								}

								if($validation['field_validation']==='six_digit_zip_code'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString){
										$error.="<li style='list-style-type:none'>Please Enter digit Only.</li>";
									}
									else{
										if(strlen($inputString) != 6 )
										{
									       $error.="<li style='list-style-type:none'>Please Enter six digit Only.</li>";
									    }	
									}
								}

								if($validation['field_validation']==='telephone_numbers'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString){
								       $error.="<li style='list-style-type:none'>Please Enter $fields number  Only.</li>";
								    }
								    else{
										if(strlen($inputString) != 12 )
										{
									       $error.="<li style='list-style-type:none'>Please Enter 12 digit Only.</li>";
									    }	
									}
								}

								if($validation['field_validation']==='email'){
									$inputString = $fields;
									$isSplChar = filter_var($inputString, FILTER_VALIDATE_EMAIL);
									if(empty($isSplChar))
									{
								       $error.="<li style='list-style-type:none'>Please Enter valid email.</li>";
								    }
								}

								if($validation['field_validation']==='decimal'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9.]*/','',$inputString); 
									if($isSplChar!=$inputString){
								       $error.="<li style='list-style-type:none'>Please $isSplChar Enter Float value.</li>";
								    }
								    else
								    {
										if(strlen($isSplChar) > 10)
										{
									       $error.="<li style='list-style-type:none'>Please $isSplChar Enter 9 digit Only.</li>";
									    }
									}
								}

								if($validation['field_validation']==='year'){
									$inputString = $fields;
									$isSplChar = preg_replace('/[^0-9\-]/',' ', $inputString);
									if($isSplChar!=$inputString){
								       $error.="<li style='list-style-type:none'>Please Enter number  Only.</li>";
								    }
								    else{
										if(strlen($inputString) != 9 )
										{
									       $error.="<li style='list-style-type:none'>Please Enter 9 digit Only.</li>";
									    }	
									}
								}

								if($validation['field_validation']==='date_should_not_less_than_today'){
									$inputString = $fields;
									$current_date = date('m-d-Y');
									// echo $inputString."<br>";
									// echo $current_date.'<br>';
									if($current_date <= $inputString)
										$error.="";
									else
										$error.="<li style='list-style-type:none'>Selected Date should not less than current date.</li>";
								}

								if(!empty($error)){

									// echo Yii::app()->createAbsoluteurl("/frontuser/application_form/generateapplication/department/".$dept_id."/application/".$app_id);
									Yii::app()->user->setFlash('Success',$error);
									$this->redirect(Yii::app()->createAbsoluteurl("/frontuser/application_form/generateapplication/department/".$dept_id."/application/".$app_id));
								}
							}
						}	
					}
				}
				// echo "<pre>";print_r($app_fields); print_r($_POST['ApplicationField']);
				$model->application_id=$app_id;
				$model->dept_id=$dept_id;
				$model->user_id=$user_id;
				$model->application_created_date=date('Y-m-d');
				$model->ip_address=$_SERVER['REMOTE_ADDR'];
				$model->user_agent=$_SERVER['HTTP_USER_AGENT'];;
				$model->field_value=json_encode($_POST['ApplicationField']);
				if($model->save()){
					//find the 1st level of approver role_id
					$criteria=new CDbCriteria;
					$criteria->select='role_id';
					$criteria->condition='app_id=:app_id';
					$criteria->order='wrkflw_id ASC';
					$criteria->params=array(':app_id'=>$app_id);
					$modelwrklw = AppWorkflow::model()->findAll($criteria);
					//if(!empty($modelwrklw) && isset($modelwrklw[0])){
						//assign to noodal agency
						$vlmodel=new ApplicationVerificationLevel;
						$vlmodel->next_role_id=7;
						$vlmodel->app_Sub_id=$model->submission_id;
						$vlmodel->created_on=date("Y-m-d");
						$vlmodel->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$vlmodel->ip_address=$_SERVER['REMOTE_ADDR'];
						$vlmodel->approv_status='P';
						if($vlmodel->save()){
							Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: ".$model->submission_id);
         					  $this->redirect(array('/frontuser'));
         					  exit;
						}
					/*}
					else{
						throw new CHttpException(500,'Internal Server Error');
						exit;
					}*/
				}
				else{
					print_r($model->geterrors());
				}				 
			}
			else{
				Yii::app()->user->setFlash('Error', "Error: Your application already Exis in our Database.");
         		$this->redirect(array('/frontuser'));
         		exit;
			}
			
		}
	}




	public function actionRedirectToApplication($application){
		@session_start();
		extract($_GET);
		if(empty($application)){
			Yii::app()->user->setFlash('Error', "Error:Invalid Request");
         		$this->redirect(array('/frontuser'));
         		exit;
		}
		// echo $application;die;
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])){
			$model=SpAllApplications::model()->findByPk($application);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			$department=1;
			$uid=$_SESSION['RESPONSE']['user_id'];
			$app_id=1;
			$apprvd='A';
			/*find if user already filled the caf application or not*/
			$criteria=new CDbCriteria;
			$criteria->condition="user_id=:uid AND application_id=:app_id AND application_status=:apprvd";
			$criteria->params=array(":uid"=>$uid,":app_id"=>$app_id,":apprvd"=>$apprvd);
			$criteria->order="submission_id ASC";
			$prevCaf=ApplicationSubmission::model()->findAll($criteria);
			$this->render("selectCaf",array("prevCaf"=>$prevCaf,"app_id"=>$application,"CALL_BACK_URL"=>$model->app_url,"service_provider"=>$service_provider,"service_id"=>$service_id,"service_name"=>$service_name,"department"=>$department,"isRedirect"=>'Y'));
			exit;
		}
		Yii::app()->user->setFlash('Error', "Error:Please login before performing this action.");
                $this->redirect(array('/frontuser'));
                exit;
		
	}


    public function actionRedirectToApplicationWithCaf(){
		@session_start();
		// echo $application;die;
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])){
		$data=array();
		extract($_POST['PrevCaf']);
		// echo "<pre>";print_r($_POST);die;
		if(isset($_POST['PrevCaf'])){
			    $pre_filed=$_SESSION['RESPONSE'];
				$criteria=new CDbCriteria;
				$criteria->condition="submission_id=:CafID";
				$criteria->params=array(":CafID"=>$CafID);
				$prevCaf=ApplicationSubmission::model()->find($criteria);
				if(!empty($prevCaf)){
					$data['CAFFieldStatus']=200;
					$data['CAFFields']=$prevCaf->field_value;
				}
				else{
					$data['CAFFieldStatus']=204;
					$data['CAFFields']="";
				}

		}
		$data['CALL_BACK_URL']=$CALL_BACK_URL;
		$data['callback_failure_url']=$CALL_BACK_URL;
		$data['callback_success_url']=$CALL_BACK_URL;
		$data['service_name']=$service_name;
		$data['service_id']=$service_id;
		$data['caf_application_id']=$CafID;
		$data['token']=$_SESSION['RESPONSE']['token'];
		$data['status_code']="200";
		$data['message']="SUCCESS";
		$data['department_name']=$service_provider;
		$data['href']=$href=TOKEN_API_BASEURL."/apiv1/gettokeninfo/token/".$_SESSION['RESPONSE']['token'];
		// echo "<pre>";print_r($data);die;
		if($service_provider=='Pollution'){
			// die("I am her");
			$this->render('redirectPollution',$data);
			exit;
		}
		$this->render('redirect',$data);
		exit;
		}
		
	}



	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
?>
