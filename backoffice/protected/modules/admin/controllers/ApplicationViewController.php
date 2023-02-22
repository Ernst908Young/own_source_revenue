<?php

class ApplicationViewController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionTestSMS(){
		$msgDept="Test SMS";
		print_r(IncentiveSchemes::sendCustomMessageToMobile('9882102908',$msgDept));
	}
	public function actionTestView(){
		echo "<pre>";print_r($_POST);die;
	}
	/**
	*@author : Hemant Thakur
	*/
	public function actionRevertBacktoDept(){
		if(isset($_POST['sub_id'])){
			$app_sub_id=$_POST['sub_id'];
			$criteria= new CDbCriteria;
			$verify='P';
			$criteria->condition="app_Sub_id=:app_sub_id AND approv_status=:verify";
			$criteria->params=array(":app_sub_id"=>$app_sub_id,"verify"=>$verify);
			$model=ApplicationForwardLevel::model()->find($criteria);
			if(empty($model)){
				 print_r(json_encode(array("status"=>"Not Exist.")));
				 exit;
			}
			$model->approv_status='V';
			$model->verifier_user_comment=$_POST['comments'];
                        $model->comment_date=date('Y-m-d h:i:s');
			@session_start();
			$model->verifier_user_id=$_SESSION['uid'];
                        print_r(json_encode(array("comment_date"=>$model->comment_date)));
						exit;
                        echo "<pre>";print_r($model);die;exit;
			if($model->save()){
				$forwd='F';
				$criteria->condition="app_Sub_id=:app_sub_id AND approv_status=:forwd";
				$criteria->params=array(":app_sub_id"=>$app_sub_id,":forwd"=>$forwd);
				$modelVl=ApplicationVerificationLevel::model()->find($criteria);
				if(!empty($modelVl)){
					$modelVl->approv_status='P';
					$modelVl->save();
					$criteria->condition="submission_id=:app_sub_id";
					$criteria->params=array(":app_sub_id"=>$app_sub_id);
					$modelSub=ApplicationSubmission::model()->find($criteria);
					if(!empty($modelSub)){
						$appFlow=new ApplicationFlowLogs;
						$appFlow->submission_id=$app_sub_id;
						$user_role_id=RolesExt::getUserRoleViaId($uid);
						$appFlow->approver_role_id=$user_role_id['role_id'];
						$appFlow->approval_user_id=$_SESSION['uid'];
						$appFlow->approver_comments=$_POST['comments'];
						$appFlow->created_date_time=date("Y-m-d H:m:s");
						$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
						$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
						$appFlow->application_status='RBD';
						$appFlow->save();
						$modelSub->application_status='P';
						$modelSub->save();
						print_r(json_encode(array("status"=>"SuccessFully Updated")));
						exit;
					}
				}
			}
			else{
				$model->approv_status='P';
				$model->save();
			}

		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}
	/**
	* used to revert applcation back to nodal
	*@author: Hemant Thakur
	*/
	public function actionRevertToNodal(){
		if(isset($_GET['app_sub_id'])){
			$app_sub_id=base64_decode($_GET['app_sub_id']);
			@session_start();
			if(isset($_SESSION['department_login'],$_SESSION['uid']) && $_SESSION['department_login']==1){
				$role_id=RolesExt::getUserRoleViaId($_SESSION['uid']);
				$criteria= new CDbCriteria;
				$verify='V';
				$criteria->condition="next_role_id=:role_id AND app_Sub_id=:app_sub_id AND approv_status!=:verify";
				$criteria->params=array(":role_id"=>$role_id['role_id'],":app_sub_id"=>$app_sub_id,":verify"=>$verify);
				$model=ApplicationVerificationLevel::model()->find($criteria);
				if(empty($model)){
					Yii::app()->user->setFlash('Error', "No such Application exist for you");
					$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
					exit;
				}

				$prev_status=$model->approv_status;
				$model->approv_status="F";
				$model->approval_user_id=$_SESSION['uid'];
				if($model->save()){
					$criteria->condition="submission_id=:app_sub_id";
					$criteria->params=array(":app_sub_id"=>$app_sub_id);
					$modelSub=ApplicationSubmission::model()->find($criteria);
					if(!empty($modelSub)){
						$modelSub_prev=$modelSub->application_status;
						$modelSub->application_status='F';
						if($modelSub->save()){
							$modelForward= new ApplicationForwardLevel;
							$dept_id=RolesExt::getNodalAgencyDepartment(7);
							$appModel= new ApplicationExt;

							$appsFields=ApplicationSubmissionExt::getSubmittedAppviaId($app_sub_id);
							$preCafFields='';
							if(!empty($appsFields)){
								$preCafFields=json_decode($appsFields['field_value']);
								if(is_object($preCafFields) && isset($preCafFields->invstmnt_in_total[0]) && $preCafFields->invstmnt_in_total[0] > 10)
									$modelForward->next_role_id=4;
								else
									$modelForward->next_role_id=7;
							}
							else
								$modelForward->next_role_id=7;
							$modelForward->app_Sub_id=$app_sub_id;
							$modelForward->forwarded_dept_id=$dept_id['department_id'];
							$modelForward->created_on=date('Y-m-d');
							$modelForward->user_agent=$_SERVER['HTTP_USER_AGENT'];
							$modelForward->ip_address=$_SERVER['REMOTE_ADDR'];
							if($modelForward->save()){
								$appFlow=new ApplicationFlowLogs;
								$appFlow->submission_id=$app_sub_id;
								$user_role_id=RolesExt::getUserRoleViaId($_SESSION['uid']);
								$appFlow->approver_role_id=$user_role_id['role_id'];
								$appFlow->approval_user_id=$_SESSION['uid'];
								// $appFlow->approver_comments=$comments;
								$appFlow->created_date_time=date("Y-m-d H:m:s");
								$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
								$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
								$appFlow->application_status='RBN';
								$appFlow->save();
								Yii::app()->user->setFlash('Success', "Application is reverted back to Nodal");
								$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
								exit;
							}
							else{
								$modelSub->application_status=$modelSub_prev;
								$modelSub->save();
								$model->approv_status=$prev_status;
								$model-save();
								Yii::app()->user->setFlash('Error', "Couldn't Update.".$modelForward->geterrors());
								$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
								exit;	

							}
						}
						else{
							$model->approv_status=$prev_status;
							$model-save();
							Yii::app()->user->setFlash('Error', "Couldn't Update.".$model->geterrors());
							$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
							exit;
						}
					}
					else{
						Yii::app()->user->setFlash('Error', "Couldn't Update");
						$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
						exit;
					}
				}
				Yii::app()->user->setFlash('Error', "Couldn't Update");
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				exit;

			}
			else{
				Yii::app()->user->setFlash('Error', "Please Login as department user to perform this action");
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				exit;
			}
			print_r($_SESSION);die;
		}
		else{
			Yii::app()->user->setFlash('Error', "Invalid Request");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
	}



	/**
	* used to revert back to lower level
	* @author: Hemant Thakur
	*/
	public function actionRevertBacktoLower(){
		if(isset($_POST['sub_id'])){
			$last_verifier_id=ApplicationVerificationLevelExt::getLastVerifierofApplication($_POST['sub_id']);
			if(!empty($last_verifier_id)){
			$cur_Verifier=ApplicationVerificationLevelExt::getCurrentVerifierofApplication($_POST['sub_id']);
			$model=ApplicationVerificationLevel::model()->findByPk($cur_Verifier['appr_lvl_id']);
				if($model===null)
					throw new CHttpException(404,'The requested page does not exist.');
			$model->approv_status='H';
			//$comment='kd';
			$model->approval_user_comment=$_POST['comments'];
			$model->comment_date_time=date("Y-m-d H:m:s");
			$model->reason_for_delay=@$_POST['reason_for_delay'];
			if($model->save()){
				$modelPrev=ApplicationVerificationLevel::model()->findByPk($last_verifier_id['appr_lvl_id']);
					if($modelPrev===null)
						throw new CHttpException(404,'The requested page does not exist.');
				$modelPrev->approv_status='P';
				$modelPrev->comment_date_time=date("Y-m-d H:m:s");
				if($modelPrev->save()){
					 print_r(json_encode(array("status"=>"successfully Updated")));
					 exit;
				}
				else{
						print_r(json_encode(array("Error"=>"Error While Loading")));
					    exit;
					}
			}
			else{
						print_r(json_encode(array("Error"=>"Error While Loading")));
					    exit;
					}
		  }

		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	/* Function is used to Generate Application PDF
		* Author : Hemant Thakur
		*@param : int(app id)
		@return : PDF 
	*/
	public function actionDownloadApp(){
		@session_start();
		if (!empty($_GET['id']) && !empty($_GET['name'])) { 
			$id = strip_tags($_GET['id']);
			$name = ucwords(str_replace("_", " ", strip_tags($_GET['name']))) ;
			$appInfo = ApplicationSubmissionExt::getSubmittedAppviaId($id);
			$app_comments = ApplicationApproveLevelExt::getApplicationComments($id);
			if (!empty($appInfo)) {
				$data=json_decode($appInfo['field_value']);
				$data_array=array();

				foreach ($data as $key => $value) {
					$data_array[$key]=$value;
				}
                                
				$docModel=new ApplicationCdnMappingExt;
				$data_array['submission_id']=$appInfo['submission_id'];
				$docs=$docModel->getApplicationDocuments($appInfo['user_id'],$appInfo['application_id']);
				$verifier_docs=$docModel->getApplicationVerifierDoc($appInfo['user_id'],$appInfo['submission_id']);
				$time=time();
				if(isset($name) && $name=='CAF'){
                                        if(isset($_GET['action']) && $_GET['action']=='test'){
                                            $content = $this -> renderPartial("pdfDetail1", array('data' => $appInfo,'name'=>$name,'times'=>$time,'docs'=>$docs,'verifier_docs'=>$verifier_docs,'app_comments'=>$app_comments), true);
					
                                        }else{
                                           $content = $this -> renderPartial("pdfCAFdetail", array('data' => $appInfo,'name'=>$name,'times'=>$time,'docs'=>$docs,'verifier_docs'=>$verifier_docs,'app_comments'=>$app_comments), true);
					 
                                        }
					$name = "Application_Form_".$name.".pdf";
		            Utility::generatePdfApp($content,$name); 
		            /*delete each regenerated images from the server*/
		            foreach ($docs as $doc ) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
					exit;
				}
				if($appInfo['application_id'] == 8){
					// echo "$name<pre>"; print_r($data_array); die;
					$content = $this -> renderPartial("pdflandAllotmentdetail", array('data' => $data_array,'name'=>$name), true);
				}
				else
					$content = $this -> renderPartial("pdfotherdetail", array('data' => $data_array,'name'=>$name), true);

					$name = "Application_Form_".$name.".pdf";
		            Utility::generatePdfApp($content,$name); 
		            foreach ($docs as $doc ) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
		            foreach ($verifier_docs as $doc) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc->document_name.'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
			} 
			else {
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			}
		}
		else {
			echo 'No Info Found';
		}
	}
	public function actionDownloadInPrincipleLetter(){
		// echo "here";die;
		$id=base64_decode($_GET['id']);
		// $id=base64_decode($id);
		$name = Yii::app()->basePath."/inprinciple/INPRINCIPLELETTER_".$id.".pdf";
		// echo $name;die;
		if(file_exists($name)){
		  $data    = file_get_contents($name);
		  $pdfFile = "INPRINCIPLELETTER_".$id.".pdf";
		  if (file_put_contents($pdfFile, $data) !== false) {
		      header("Content-Disposition: attachment; filename=" . urlencode($pdfFile));
		      header("Content-Type: application/octet-stream");
		      header("Content-Type: application/download");
		      header("Content-Description: File Transfer");
		      header("Content-Length: " . filesize($pdfFile));
		      echo $data;
		      $this->redirect(array(
		          '/admin'
		      ));
		      exit;
		  } else {
		      Yii::app()->user->setFlash('Error', "Sorry! Could not download your document.");
		      $this->redirect(array(
		          '/admin'
		      ));
		      exit;
		  }
		}
	}
	public function actionDownloadAppAny(){
		@session_start();
		if (!empty($_GET['id']) && !empty($_GET['name'])) { 
			$id = strip_tags($_GET['id']);
			$name = ucwords(str_replace("_", " ", strip_tags($_GET['name']))) ;
			$appInfo = ApplicationSubmissionExt::getSubmittedAppviaIdDownload($id);
			$app_comments = ApplicationApproveLevelExt::getApplicationComments($id);
			if (!empty($appInfo)) {
				$data=json_decode($appInfo['field_value']);
				$data_array=array();

				foreach ($data as $key => $value) {
					$data_array[$key]=$value;
				}
				$docModel=new ApplicationCdnMappingExt;
				$data_array['submission_id']=$appInfo['submission_id'];
				$docs=$docModel->getApplicationDocuments($appInfo['user_id'],$appInfo['application_id']);
				$verifier_docs=$docModel->getApplicationVerifierDoc($appInfo['user_id'],$appInfo['submission_id']);
				$time=time();
				if(isset($name) && $name=='CAF'){
					
					$content = $this -> renderPartial("pdfCAFdetail", array('data' => $appInfo,'name'=>$name,'times'=>$time,'docs'=>$docs,'verifier_docs'=>$verifier_docs,'app_comments'=>$app_comments), true);
					$name = "Application_Form_".$name.".pdf";
		            Utility::generatePdfApp($content,$name); 
		            /*delete each regenerated images from the server*/
		            foreach ($docs as $doc ) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
					exit;
				}
				$content = $this -> renderPartial("pdfotherdetail", array('data' => $data_array,'name'=>$name), true);

					$name = "Application_Form_".$name.".pdf";
		            Utility::generatePdfApp($content,$name); 
		            foreach ($docs as $doc ) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
		            foreach ($verifier_docs as $doc) {
		            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc->document_name.'.png';
		            	if(file_exists($file))
		            		unlink($file);
		            }
			} 
			else {
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			}
		}
		else {
			echo 'No Info Found';
		}
	}
	/**
	* to view the applictions forwarded by other departments
	* @author: Hemant Thakur
	ok
	*/

	public function actionForwardedApplication(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please Login to perform this action");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
		$isNoodal=Utility::isDeptNoodalOfficer();
		if(!$isNoodal){
			Yii::app()->user->setFlash('Error', "You are not authorised User");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
		$uid=$_SESSION['uid'];
		$app_sub_id=$_GET['application_sub_id'];
		$model=new ApplicationSubmissionExt;
		$data=$model->getSubmittedAppviaId($app_sub_id);
		if(!$data){
			Yii::app()->user->setFlash('Error', "This application does not exist for you.");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			return;
		}
		$docModel=new ApplicationCdnMappingExt;
		$appName=new ApplicationExt;
		$appName=$appName->getAppNameViaId($data['application_id']);
		$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id']);
		$verifier_docs=$docModel->getApplicationVerifierDoc($data['user_id'],$data['submission_id']);
		if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
			$this->render('applicationCAFdetailForward',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
			exit;
		}
		$this->render('forwardedApplicationFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));

		
	}

	/**
	* this function is used to view all the comments and application of the forwarded applications
	* @author : Hemant Thakur
	* @param : None
	*/
	public function actionViewForwardApplication(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please Login to perform this action");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
		$uid=$_SESSION['uid'];
		$app_sub_id=$_GET['application_sub_id'];
		$model=new ApplicationSubmissionExt;
		$data=$model->getSubmittedAppviaId($app_sub_id);
		if(!$data){
			Yii::app()->user->setFlash('Error', "This application does not exist for you.");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			return;
		}
		$docModel=new ApplicationCdnMappingExt;
		$appName=new ApplicationExt;
		$appName=$appName->getAppNameViaId($data['application_id']);
		$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id']);
		// echo "<pre>";print_r($docs);die;
		$verifier_docs=$docModel->getApplicationVerifierDoc($data['user_id'],$data['submission_id']);
		// die("sorry");
		if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
			$revert=false;
			if(isset($_GET['revertedApp']) && $_GET['revertedApp']=='revert')
				$revert=true;
			$this->render('applicationCAFdetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs,'revert'=>$revert));
			exit;
		}
		$revert=false;
			if(isset($_GET['revertedApp']) && $_GET['revertedApp']=='revert')
				$revert=true;
		$this->render('ViewForwardedApplicationFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs,'revert'=>$revert));
	}
	
	/**
	* 
	* @author: Hemant Thakur
	*/


	public function actionForwardToDept(){
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$uid=$_SESSION['uid'];
			extract($_POST)	;
			$criteria=new CDbCriteria;
			$hol="H";
			$pen='P';
			$frws='F';
			$criteria->condition='app_Sub_id=:sub_id AND (approv_status=:hol OR approv_status=:pen OR approv_status=:frws)';
			$criteria->params=array(':sub_id'=>$app_sub_id,':hol'=>$hol,':pen'=>$pen,'frws'=>$frws);
			$vlmodel = ApplicationVerificationLevel::model()->find($criteria);
			$vlmodel->approv_status='F';
			$vlmodel->approval_user_id=$uid;
			$commentss='';
			if(!empty($comments))
				$commentss=$comments;
			else
				$commentss=$preComments;
			$vlmodel->approval_user_comment=$commentss;
			$vlmodel->comment_date_time=date("Y-m-d H:m:s");
			if($vlmodel->save()){
				$modelForward=new ApplicationForwardLevel;
				$criteria=new CDbCriteria;
				$user_role_id=RolesExt::getUserRoleViaId($uid);
				if($user_role_id['role_id']==4)
					$role_id=5;
				else
					$role_id=3;
				$criteria->select='role_id';
				$criteria->condition='role_id=:role_id AND is_role_active=:active';
				$criteria->params=array(':role_id'=>$role_id,':active'=>'Y');
				$roleModel = Roles::model()->find($criteria);
				foreach ($forwardDept as $dept) {
					 $modelForward=new ApplicationForwardLevel;
					 $modelForward->forwarded_dept_id=$dept;
					 $modelForward->next_role_id=$role_id;
					 $modelForward->app_Sub_id=$app_sub_id;
					 $modelForward->created_on=date('Y-m-d H:m:S');
					 $modelForward->user_agent=$_SERVER['HTTP_USER_AGENT'];
					 $modelForward->ip_address=$_SERVER['REMOTE_ADDR'];
					 $modelForward->approv_status='P';
					 $modelForward->save();
					 $mobile=IncentiveSchemes::getboUserMobileFromRoleID($app_sub_id,$role_id);
					 $app_name=IncentiveSchemes::getAppNameFromSubmissionId($app_sub_id);
					 $msgDept="Application Name: $app_name\r\nApplication ID: $app_sub_id\r\nMessage: Application has been submitted for your approval.\r\n";
					 IncentiveSchemes::sendCustomMessageToMobile($mobile,$msgDept);
                                         DefaultUtility::sendSMSEmailGlobal('CAF','CAF verifier forwarded the CAF to departments for their comments',$app_sub_id,$dept);
				}
				$subModel=ApplicationSubmission::model()->findByPk($app_sub_id);
				if($subModel===null)
					return false;
				$subModel->application_status='F';
				if($subModel->save()){
					$appFlow=new ApplicationFlowLogs;
					$appFlow->submission_id=$app_sub_id;
					$appFlow->approver_role_id=$user_role_id['role_id'];
					$appFlow->approval_user_id=$uid;
					$appFlow->approver_comments=$commentss;
					$appFlow->created_date_time=date("Y-m-d H:m:s");
					$appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
					$appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
					$appFlow->application_status='F';
					$appFlow->save();
					Yii::app()->user->setFlash('Error', "Forwarded to specified Departments");
					$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
					exit;
				}
			}
		}
		else{
		    $model=new LoginForm;
		    $this->redirect(array("/site/login"),$model);
		}

	}

	/**
	* this function is used to upload the verifier documents 
	* @author: Hemant Thakur
	*/
	public function actionUploadVerifierDocs(){
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$uid=$_SESSION['uid'];
			if(isset($_FILES) && !empty($_FILES) && $_FILES['verifier_files']['error']==0){
				extract($_POST['ApplicationField']);
				$modelRole=new RolesExt;
		 		$role_id=$modelRole->getUserRoleViaId($uid);
				$imgData =file_get_contents($_FILES['verifier_files']['tmp_name']);
				$hash=hash_hmac('sha1', md5($uid.$sub_id), CDN_PUBLIC_KEY);
				$post_data=array('user_id'=>$uid,'app_id'=>$sub_id,'api_hash'=>$hash,'dept_id'=>$_SESSION['dept_id'],'doc_name'=>$_FILES['verifier_files']['name'],'verifier_role_id'=>$role_id['role_id'],'doc_type'=>$_FILES['verifier_files']['type'],'doc_size'=>$_FILES['verifier_files']['size'],'doc_blob_data'=>base64_encode($imgData));
				$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/saveVerifierDocuments',$post_data));
				if(!$response->STATUS==200 || !$response->STATUS==204){
					Yii::app()->user->setFlash('Success', "SuccessFully Uploaded");
					$this->redirect(Yii::app()->createAbsoluteUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/'.$sub_id));
				}
				else{
					Yii::app()->user->setFlash('Error', $response->RESPONSE);
					$this->redirect(Yii::app()->createAbsoluteUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/'.$sub_id));
				}

			}
			else{
					Yii::app()->user->setFlash('Error', "Error While uploading the documents");
					$this->redirect(Yii::app()->createAbsoluteUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/'.$sub_id));
			}
		}
	}
	/**
	*
	* @author: Hemant Thakur
	*/


	protected function GetUserApplicationDocuments($doc_id,$submission_id){
		$critera = new CDbCriteria;
		$critera->condition = "doc_id=:doc_id and app_submission_id=:app_submission_id";
		$critera->params = array(":doc_id" => $doc_id,':app_submission_id'=>$submission_id);
		$model = AllotmentApplicationDocs::model()->find($critera);
		// echo"<pre>"; print_r($critera); print_r($model); die;
			return $model;
		exit;
	}

	public function actionApplicationfulldetail($app_sub_id){
		@session_start();
		 if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$model=new ApplicationSubmissionExt;
			$data=$model->getSubmittedAppviaId($app_sub_id);
                        //echo "<!--??";print_r($data);echo "-->";
			if(!$data){
				Yii::app()->user->setFlash('Error', "This application does not exist for you.");
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				return;
			}
			$docModel=new ApplicationCdnMappingExt;
			$appName=new ApplicationExt;
			$appName=$appName->getAppNameViaId($data['application_id']);
			$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id'],$data['submission_id']);
			$verifier_docs=$docModel->getApplicationVerifierDoc($data['user_id'],$data['submission_id']);
			if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
				$this->render('applicationcafFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
				exit;
			}
			// die("this");
			$this->render('applicationfulldetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
		}
		else{
		    $model=new LoginForm;
		    $this->redirect(array("/site/login"),$model);
		}
	}

/**
	*
	* @author: Hemant Thakur
	*/

	public function actionVerifyDocuments(){
		@session_start();
		 if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && isset($_POST['document_doc_id']) && !empty($_POST['document_doc_id']) && isset($_POST['application_id']) && !empty($_POST['application_id'])){
		 	$uid=$_SESSION['uid'];
		 	$modelRole=new RolesExt;
		 	$role_id=$modelRole->getUserRoleViaId($uid);
		 	extract($_POST);
		 	$hash=hash_hmac('sha1', md5($document_doc_id.$submit_user_id.$application_id), CDN_PUBLIC_KEY);
			$post_data=array('user_id'=>$submit_user_id,'verifier_id'=>$uid,'verifier_role_id'=>$role_id['role_id'],'doc_id'=>$document_doc_id,'app_id'=>$application_id,'api_hash'=>$hash);
			$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/verifyDocument',$post_data));
			Yii::app()->user->setFlash('success',$response->STATUS. ":". $response->RESPONSE );
			$model=new ApplicationSubmissionExt;
			$data=$model->getSubmittedAppviaId($application_submit_id);
			$docModel=new ApplicationCdnMappingExt;
			$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id']);
			$verifier_docs=$docModel->getApplicationVerifierDoc($submit_user_id,$application_submit_id);
			$appName=new ApplicationExt;
			$appName=$appName->getAppNameViaId($application_id);
                        
			if(isset($_POST['submitted_by_forwarded_dept']) && $_POST['submitted_by_forwarded_dept']=='submitted_by_forwarded_dept'){
				if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
					$this->render('applicationCAFdetailForward',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
					exit;
				}
				else{
					$this->render('forwardedApplicationFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
					exit;
				}

			}
			if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
				$this->render('applicationcafFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
				exit;
			}
			$this->render('applicationfulldetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
		 }
		 else
		 	echo "Invalid Request";
		
	}

	/**
	*
	* @author: Gaurav Ojha
	*/

	 protected function getEvaluationMarks($key,$option){
      $totalMarks=0;
      
      if($key == "edu_cert_qual"){
        if($option == "intermediate")
          $totalMarks=+3;    
        elseif($option == "graduation")
          $totalMarks=+4;    
        elseif($option == "post_grad_or_above")
          $totalMarks=+5;    
      }
      elseif($key == "edu_tech_qual"){
        if($option == "none")
          $totalMarks=+2;    
        elseif($option == "iti")
          $totalMarks=+3;    
        elseif($option == "diploma")
          $totalMarks=+4;
        elseif($option == "BE_BTech_MCA_MBA_CA")
          $totalMarks=+5;
      }
      elseif($key == "cert_prof_exp"){
        if($option == "non_similar")
          $totalMarks=+5;    
        elseif($option == "similar")
          $totalMarks=+10;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_equity"){
      	if($option == "less_then_19")
			$totalMarks=+4;
		elseif($option == "greater_then_12_less_then_29_99")
			$totalMarks=+6;
		elseif($option == "greater_then_30_less_then_39_99")
			$totalMarks=+8;
		elseif($option == "greater_then_40")
			$totalMarks=+10;
      }
      elseif($key == "cert_unit_approv_sanct"){
        if($option == "Yes")
          $totalMarks=+5;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_project_cost"){
        if($option == "1cr")
          $totalMarks=+10;    
        elseif($option == "50lcs")
          $totalMarks=+7;    
        elseif($option == "25lcs")
          $totalMarks=+5;
        elseif($option == "below25lcs")
          $totalMarks=+4;    
      }
      elseif($key == "cert_debt_cover_ratio"){
        if($option == "none")
          $totalMarks=+5;    
        elseif($option == "1.70-2.00")
          $totalMarks=+4;    
        elseif($option == "1.50-1.75")
          $totalMarks=+3;    
        elseif($option == "1.25-1.50")
          $totalMarks=+2;    
        elseif($option == "1.00-1.25")
          $totalMarks=+1;    
      }
      elseif($key == "cert_poll_cat"){
        if($option == "white")
          $totalMarks=+5;    
        elseif($option == "green")
          $totalMarks=+4;    
        elseif($option == "orange")
          $totalMarks=+3;    
        elseif($option == "red")
          $totalMarks=+2;    
      }
      elseif($key == "cert_adpt_water_system"){
        if($option == "yes")
          $totalMarks=+5;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_usage_local_materail"){
        if($option == "30%")
          $totalMarks=+2;    
        elseif($option == "10%")
          $totalMarks=+1;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_regist_startup"){
        if($option == "yes")
          $totalMarks=+10;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_land_acquistion"){
        if($option == "acquired")
          $totalMarks=+10;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_enterprenure_type"){
        if($option == "women")
          $totalMarks=+5;    
        elseif($option == "army_fighter")
          $totalMarks=+5;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_unit_type"){
        if($option == "vender")
          $totalMarks=+5;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
      elseif($key == "cert_unit_benifited"){
        if($option == "yes")
          $totalMarks=+5;    
        elseif($option == "none")
          $totalMarks=+0;    
      }
       return $totalMarks; 
    }

	public function actionEvaluateMarks(){
		@session_start();
		if (!empty($_GET['app_sub_id'])) { 
			$id = strip_tags(base64_decode($_GET['app_sub_id']));
			$name = ucwords("Land_Allotment_Questionnaire") ;
			$appInfo = ApplicationSubmissionExt::getSubmittedAppviaId($id);
			$app_comments = ApplicationApproveLevelExt::getApplicationComments($id);
			if (!empty($appInfo)) {
				$data=json_decode($appInfo['field_value']);
				$data_array=array();

				foreach ($data as $key => $value) {
					$data_array[$key]=$value;
				}
				$docModel=new ApplicationCdnMappingExt;
				$data_array['submission_id']=$appInfo['submission_id'];
				$docs=$docModel->getApplicationDocuments($appInfo['user_id'],$appInfo['application_id']);
				$verifier_docs=$docModel->getApplicationVerifierDoc($appInfo['user_id'],$appInfo['submission_id']);
				$time=time();
				$totalMarks = 0;
				$totalMarks += $this->getEvaluationMarks("edu_cert_qual",$data_array['edu_cert_qual']);
				$totalMarks += $this->getEvaluationMarks("edu_tech_qual",$data_array['edu_tech_qual']);
				$totalMarks += $this->getEvaluationMarks("cert_prof_exp",$data_array['cert_prof_exp']);
				$totalMarks += $this->getEvaluationMarks("cert_equity",$data_array['cert_equity']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_approv_sanct",$data_array['cert_unit_approv_sanct']);
                                if(isset($data_array['cert_project_cost'])){$totalMarks += $this->getEvaluationMarks("cert_project_cost",$data_array['cert_project_cost']);}
				$totalMarks += $this->getEvaluationMarks("cert_debt_cover_ratio",$data_array['cert_debt_cover_ratio']);
				$totalMarks += $this->getEvaluationMarks("cert_poll_cat",$data_array['cert_poll_cat']);
				$totalMarks += $this->getEvaluationMarks("cert_adpt_water_system",$data_array['cert_adpt_water_system']);
				$totalMarks += $this->getEvaluationMarks("cert_usage_local_materail",$data_array['cert_usage_local_materail']);
				$totalMarks += $this->getEvaluationMarks("cert_regist_startup",$data_array['cert_regist_startup']);
				$totalMarks += $this->getEvaluationMarks("cert_land_acquistion",$data_array['cert_land_acquistion']);
				$totalMarks += $this->getEvaluationMarks("cert_enterprenure_type",$data_array['cert_enterprenure_type']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_type",$data_array['cert_unit_type']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_benifited",$data_array['cert_unit_benifited']);
				// echo "$totalMarks<pre>"; print_r($data_array); die;
				$content = $this -> renderPartial("pdfquestiondetail", array('data' => $data_array,'name'=>$name,'totalMarks'=>$totalMarks), true);

				$name = "Application_Form_".$name.".pdf";
	            Utility::generatePdfApp($content,$name); 
	            foreach ($docs as $doc ) {
	            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';
	            	if(file_exists($file))
	            		unlink($file);
	            }
	            foreach ($verifier_docs as $doc) {
	            	$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc->document_name.'.png';
	            	if(file_exists($file))
	            		unlink($file);
	            }
			} 
			else {
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			}
		}
		else {
			echo 'No Info Found';
		}
	}

	public function actionRejectDocuments(){
		@session_start();
		 if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && isset($_POST['document_doc_id']) && !empty($_POST['document_doc_id']) && isset($_POST['application_id']) && !empty($_POST['application_id'])){
		 	$uid=$_SESSION['uid'];
		 	$modelRole=new RolesExt;
		 	$role_id=$modelRole->getUserRoleViaId($uid);
		 	extract($_POST);
		 	$hash=hash_hmac('sha1', md5($document_doc_id.$submit_user_id.$application_id), CDN_PUBLIC_KEY);
			$post_data=array('user_id'=>$submit_user_id,'verifier_id'=>$uid,'verifier_role_id'=>$role_id['role_id'],'doc_id'=>$document_doc_id,'app_id'=>$application_id,'api_hash'=>$hash);
			$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/rejectDocument',$post_data));
			Yii::app()->user->setFlash('success',$response->STATUS. ":". $response->RESPONSE );
			$model=new ApplicationSubmissionExt;
			$data=$model->getSubmittedAppviaId($application_submit_id);
			$docModel=new ApplicationCdnMappingExt;
			$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id']);
			$verifier_docs=$docModel->getApplicationVerifierDoc($submit_user_id,$application_submit_id);
			$appName=new ApplicationExt;
			$appName=$appName->getAppNameViaId($application_id);
			if(isset($appName['application_name']) && $appName['application_name']=='CAF'){
				$this->render('applicationcafFullDetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));
				exit;
			}
			$this->render('applicationfulldetail',array('data'=>$data,'docs'=>$docs));
		 }
		 else
		 	echo "Invalid Request";
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



 /*  Developed by: Rahul Kumar
        Dated 13-07-2017
        Pupose:- Update the evaluation Marks of Land Allotment */
        
     public function actionEvaluateMarksForm(){
	@session_start();//echo $_GET['app_sub_id'];die;
		if (!empty($_GET['app_sub_id'])) { 
                   
			$id = strip_tags(base64_decode($_GET['app_sub_id']));
                     
			$name = ucwords("Land_Allotment_Questionnaire") ;
			$appInfo = ApplicationSubmissionExt::getSubmittedAppviaId($id);
                         $connection=Yii::app()->db; 
                        	$sql="SELECT * FROM bo_application_mark_evaluvation WHERE app_submision_id=$id ORDER BY bo_application_mark_evaluvation.id DESC limit 1";
			$command=$connection->createCommand($sql);
	
			
			$evaluatedMarks=$command->queryRow();
			if($evaluatedMarks===false){	
				$evaluatedMarks="none";
			}
		
                       
			$app_comments = ApplicationApproveLevelExt::getApplicationComments($id);
                       //  print_r($app_comments);die;
			if (!empty($appInfo)) {
				$data=json_decode($appInfo['field_value']);
				$data_array=array();

				foreach ($data as $key => $value) {
					$data_array[$key]=$value;
				}
                              //  print_r($data_array);die;
				$docModel=new ApplicationCdnMappingExt;
				$data_array['submission_id']=$appInfo['submission_id'];
				$docs=$docModel->getApplicationDocuments($appInfo['user_id'],$appInfo['application_id']);
				$verifier_docs=$docModel->getApplicationVerifierDoc($appInfo['user_id'],$appInfo['submission_id']);
                               // print_r($data_array);die;
				$time=time();
				$totalMarks = 0;
				$totalMarks += $this->getEvaluationMarks("edu_cert_qual",$data_array['edu_cert_qual']);
				$totalMarks += $this->getEvaluationMarks("edu_tech_qual",$data_array['edu_tech_qual']);
				$totalMarks += $this->getEvaluationMarks("cert_prof_exp",$data_array['cert_prof_exp']);
				$totalMarks += $this->getEvaluationMarks("cert_equity",$data_array['cert_equity']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_approv_sanct",$data_array['cert_unit_approv_sanct']);
                                if(isset($data_array['cert_project_cost']) && !empty($data_array['cert_project_cost'])){$totalMarks += $this->getEvaluationMarks("cert_project_cost",$data_array['cert_project_cost']);}
				$totalMarks += $this->getEvaluationMarks("cert_debt_cover_ratio",$data_array['cert_debt_cover_ratio']);
				$totalMarks += $this->getEvaluationMarks("cert_poll_cat",$data_array['cert_poll_cat']);
				$totalMarks += $this->getEvaluationMarks("cert_adpt_water_system",$data_array['cert_adpt_water_system']);
				$totalMarks += $this->getEvaluationMarks("cert_usage_local_materail",$data_array['cert_usage_local_materail']);
				$totalMarks += $this->getEvaluationMarks("cert_regist_startup",$data_array['cert_regist_startup']);
				$totalMarks += $this->getEvaluationMarks("cert_land_acquistion",$data_array['cert_land_acquistion']);
				$totalMarks += $this->getEvaluationMarks("cert_enterprenure_type",$data_array['cert_enterprenure_type']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_type",$data_array['cert_unit_type']);
				$totalMarks += $this->getEvaluationMarks("cert_unit_benifited",$data_array['cert_unit_benifited']);
				// echo "$totalMarks<pre>"; print_r($data_array); die;
                                
                                  if(!empty($_POST)){
                        $customTotal= $_POST['cert_qual']+$_POST['tech_qual']+$_POST['prof_exp']+$_POST['equity']+$_POST['unit_approv_sanct']+$_POST['project_cost']+$_POST['debt_cover_ratio']+$_POST['poll_cat']+$_POST['adpt_water_system']+$_POST['usage_local_materail']+$_POST['regist_startup']+$_POST['land_acquistion']+$_POST['enterprenure_type']+$_POST['unit_type']+$_POST['unit_benifited'];
                               
                        $verifierID=$_SESSION['uid'];
                      $sqlQuery=  "INSERT INTO bo_application_mark_evaluvation( app_submision_id, verifier_id, sys_cert_qual, cert_qual, sys_tech_qual, tech_qual, sys_prof_exp, prof_exp, sys_equity, equity, sys_unit_approv_sanct, unit_approv_sanct, sys_project_cost, project_cost, sys_debt_cover_ratio, debt_cover_ratio, sys_poll_cat, poll_cat, sys_adpt_water_system, adpt_water_system, sys_usage_local_materail, usage_local_materail, sys_regist_startup, regist_startup, sys_land_acquistion, land_acquistion, sys_enterprenure_type, enterprenure_type, sys_unit_type, unit_type, sys_unit_benifited, unit_benifited,sys_total,custom_total) VALUES ("
                        . $id.",".$verifierID.",".$_POST['sys_cert_qual'].",".$_POST['cert_qual'].",".$_POST['sys_tech_qual'].",".$_POST['tech_qual'].",".$_POST['sys_prof_exp'].",".$_POST['prof_exp'].",".$_POST['sys_equity'].",".$_POST['equity'].",".$_POST['sys_unit_approv_sanct'].",".$_POST['unit_approv_sanct'].",".$_POST['sys_project_cost'].",".$_POST['project_cost'].",".$_POST['sys_debt_cover_ratio'].",".$_POST['debt_cover_ratio'].",".$_POST['sys_poll_cat'].",".$_POST['poll_cat'].",".$_POST['sys_adpt_water_system'].",".$_POST['adpt_water_system'].",".$_POST['sys_usage_local_materail'].",".$_POST['usage_local_materail'].",".$_POST['sys_regist_startup'].",".$_POST['regist_startup'].",".$_POST['sys_land_acquistion'].",".$_POST['land_acquistion'].",".$_POST['sys_enterprenure_type'].",".$_POST['enterprenure_type'].",".$_POST['sys_unit_type'].",".$_POST['unit_type'].",".$_POST['sys_unit_benifited'].",".$_POST['unit_benifited'].",".$totalMarks.",".$customTotal.")";
                       
                         $connection->createCommand($sqlQuery)->execute();
                         Yii::app()->user->setFlash('Success', "Marks alloted successfully. ");
					$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
					exit;
        
                    }
				$this->render("evaluvateMarksForm", array('data' => $data_array,'name'=>$name,'totalMarks'=>$totalMarks,'evaluatedCritearea'=>$evaluatedMarks));

		
	            
		}
		else {
			echo 'No Info Found';
		}
                       

		
			
	}

}

/* 



 * @author: Rahul Kumar

 * @date : 24022018

 * @description: Existing CAF View

 *  

 */



	public function actionExistingCaffulldetail($app_sub_id){

		@session_start();

		 if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

			$model=new ApplicationSubmissionExt;

			$data=$model->getSubmittedAppviaId($app_sub_id);

                       //print_r($data);die;

			if(!$data){

				Yii::app()->user->setFlash('Error', "This application does not exist for you.");

				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));

				return;

			}

			$docModel=new ApplicationCdnMappingExt;

			$appName=new ApplicationExt;

			$appName=$appName->getAppNameViaId($data['application_id']);

			$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id'],$data['submission_id']);

			$verifier_docs=$docModel->getApplicationVerifierDoc($data['user_id'],$data['submission_id']);

			if(isset($appName['application_name']) && $appName['application_name']=='CAF'){

				$this->render('existingcaffulldetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));

				exit;

			}

			// die("this");

			$this->render('existingcaffulldetail',array('data'=>$data,'docs'=>$docs,'verifier_docs'=>$verifier_docs));

		}

		else{

		    $model=new LoginForm;

		    $this->redirect(array("/site/login"),$model);

		}

	}

	/* Function is used to Generate Existing Unit Application PDF
	* Author : shishir sharma
	*@param : int(app id)
	@return : PDF 	*/
	public function actionExistingCafDownloadApp(){
		@session_start();
		if(!empty($_GET['id']) && !empty($_GET['name'])) { 			
			 $id = strip_tags($_GET['id']);			
			 $name = ucwords(str_replace("_", " ", strip_tags($_GET['name'])));
			
			$appInfo = ApplicationSubmissionExt::getSubmittedAppviaId($id);
			$app_comments = ApplicationApproveLevelExt::getApplicationComments($id);
			if (!empty($appInfo)) {		
				/* echo "<pre>";
				print_r($appInfo); */
				//$data =  json_decode($appInfo['field_value']);	
				/* echo "<pre>";
				print_r($data);
				die();	 */		
				$data_array=array();
				/* foreach($data as $key => $value) {
					$data_array[$key]=$value;				
				}	 */			
				$docModel=new ApplicationCdnMappingExt;
				$data_array['submission_id']= $appInfo['submission_id'];
				$data_array['application_id']= $appInfo['application_id'];
				$data_array['field_value']= $appInfo['field_value'];
				$data_array['user_id']= $appInfo['user_id'];
				
				$docs=$docModel->getApplicationDocuments($appInfo['user_id'],$appInfo['application_id']);
				$verifier_docs=$docModel->getApplicationVerifierDoc($appInfo['user_id'],$appInfo['submission_id']);
				
				$time=time();				
				
				if($appInfo['application_id'] == 11){
					// echo "$name<pre>"; print_r($data_array); die;
					$content = $this->renderPartial("pdfEUdetail", array('data' => $data_array,'name'=>$name), true);
				}
				$name = "Application_Form_".$name.".pdf";
				ob_end_clean();
				Utility::generatePdfApp($content,$name); 
				foreach ($docs as $doc ) {
					$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc['doc_name'].'.png';if(file_exists($file))
						unlink($file);
				}
				foreach ($verifier_docs as $doc) {		            	
					$file=$_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$time.'_'.$doc->document_name.'.png';if(file_exists($file))
						unlink($file);
				}
			}else {
				$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			}		
		}else {
			echo 'No Info Found';
		}
	}
	
	public function actionForwardToDistrictApprover(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please Login to perform this action");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
		
		$uid = $_SESSION['uid'];
		$app_sub_id = $_POST['subm_id'];
		$role_id = $_POST['role_id'];
		$approver_district_id = $_POST['approver_district_id'];
		$comment = $_POST['comment_for_district_approver'];
		/* echo "<pre>";
		print_r($_POST);
		die("sdfsd"); */
		
		$appFlow = new ApplicationFlowLogs;
		$appFlow->submission_id = $_POST['subm_id'];
		$appFlow->approver_role_id = '34';
		$appFlow->approval_user_id = $uid;
		$appFlow->approver_comments = $comment;
		$appFlow->created_date_time = date("Y-m-d H:i:s");
		$appFlow->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$appFlow->remote_ip_address = $_SERVER['REMOTE_ADDR'];
		$appFlow->application_status = 'F';
		if($appFlow->save())
		{
			$spApplicationUpdateSql = "UPDATE bo_sp_applications SET app_status = 'F', app_distt=$approver_district_id  WHERE app_id = $app_sub_id AND sp_app_id='280'";
            Yii::app()->db->createCommand($spApplicationUpdateSql)->execute();
			
			$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_sub_id AND sp_tag='DOI@908#123'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();
				
			$user = "Select * FROM bo_user WHERE uid = $uid";
			$userData = Yii::app()->db->createCommand($user)->queryRow();				
			
			$userRol = "Select role_name FROM bo_roles WHERE role_id = 34";
			$userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();
			
			$roleInfo = "Name: ".@$userData['full_name']."<br/>Mobile Number: ".@$userData['mobile']."<br/>Email Id: ".@$userData['email'];
			
			$modelSPH = new SpApplicationHistory;
			$modelSPH->sp_app_id = $applicationDetail['sno'];
			$modelSPH->service_id = $applicationDetail['sp_app_id'];
			$modelSPH->sp_tag = $applicationDetail['sp_tag'];
			$modelSPH->app_id = $applicationDetail['app_id'];
			$modelSPH->application_status = 'F';
			$modelSPH->comments = 'Registration of Existing Enterprise application forwarded to dic';
			$modelSPH->added_date_time = date('Y-m-d H:i:s');			
			$modelSPH->role_id = '34'; //action taken by's
			$modelSPH->role_name = $userRoleData['role_name']; //action taken role name
			$modelSPH->role_user_info = $roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
			$modelSPH->next_role_id = '33'; //Next Assigned To
			if($modelSPH->save())
			{
				//Update submission table
				$submissionUpdateSql = "UPDATE bo_application_submission SET application_status = 'F' WHERE submission_id = $app_sub_id";
				Yii::app()->db->createCommand($submissionUpdateSql)->execute();
				
				//Update verification Level
				$currentDate = date("Y-m-d H:i:s");
				$verifiactionLevelUpdateSql = "UPDATE bo_application_verification_level SET approv_status = 'F', approval_user_id =$uid,approval_user_comment='$comment',comment_date_time='$currentDate' WHERE app_Sub_id = $app_sub_id AND next_role_id='34'";
				Yii::app()->db->createCommand($verifiactionLevelUpdateSql)->execute();
				
				//Insert Row Verification Level
				$verification = new ApplicationVerificationLevel;
				$verification->next_role_id = '33';
				$verification->app_Sub_id = $app_sub_id;
				$verification->created_on = date('Y-m-d H:i:s');
				$verification->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$verification->ip_address = $_SERVER['REMOTE_ADDR'];
				$verification->approv_status = 'P';
				if($verification->save()) {
					Yii::app()->user->setFlash('Success', "Application ID: $app_sub_id forwarded successfully.");
					$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				}
			}		
		}
	}
	
	//33 assign to 34
	public function actionRevertToStateApprover(){
		@session_start();
		if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please Login to perform this action");
			$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
			exit;
		}
		
		$uid = $_SESSION['uid'];
		$app_sub_id = $_POST['subm_id'];
		$role_id = $_POST['role_id'];
		$comment = $_POST['comment_for_state_approver'];
		/* echo "<pre>";
		print_r($_POST);
		die("sdfsd"); */
		
		$appFlow = new ApplicationFlowLogs;
		$appFlow->submission_id = $_POST['subm_id'];
		$appFlow->approver_role_id = '33';
		$appFlow->approval_user_id = $uid;
		$appFlow->approver_comments = $comment;
		$appFlow->created_date_time = date("Y-m-d H:i:s");
		$appFlow->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$appFlow->remote_ip_address = $_SERVER['REMOTE_ADDR'];
		$appFlow->application_status = 'P';
		if($appFlow->save())
		{
			$spApplicationUpdateSql = "UPDATE bo_sp_applications SET app_status = 'P' WHERE app_id = $app_sub_id AND sp_app_id='280'";
            Yii::app()->db->createCommand($spApplicationUpdateSql)->execute();
			
			$serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id=$app_sub_id AND sp_tag='DOI@908#123'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();
				
			$user = "Select * FROM bo_user WHERE uid = $uid";
			$userData = Yii::app()->db->createCommand($user)->queryRow();				
			
			$userRol = "Select role_name FROM bo_roles WHERE role_id = 33";
			$userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();
			
			$roleInfo = "Name: ".@$userData['full_name']."<br/>Mobile Number: ".@$userData['mobile']."<br/>Email Id: ".@$userData['email'];
			
			$modelSPH = new SpApplicationHistory;
			$modelSPH->sp_app_id = $applicationDetail['sno'];
			$modelSPH->service_id = $applicationDetail['sp_app_id'];
			$modelSPH->sp_tag = $applicationDetail['sp_tag'];
			$modelSPH->app_id = $applicationDetail['app_id'];
			$modelSPH->application_status = 'F';
			$modelSPH->comments = 'Registration of Existing Enterprise application reverted to approver';
			$modelSPH->added_date_time = date('Y-m-d H:i:s');			
			$modelSPH->role_id = '33'; //action taken by's
			$modelSPH->role_name = $userRoleData['role_name']; //action taken role name
			$modelSPH->role_user_info = $roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
			$modelSPH->next_role_id = '34'; //Next Assigned To
			if($modelSPH->save())
			{
				//Update submission table
				$submissionUpdateSql = "UPDATE bo_application_submission SET application_status = 'P' WHERE submission_id = $app_sub_id";
				Yii::app()->db->createCommand($submissionUpdateSql)->execute();
				
				//Update verification Level
				$currentDate = date("Y-m-d H:i:s");
				$verifiactionLevelUpdateSql = "UPDATE bo_application_verification_level SET approv_status = 'V', approval_user_id =$uid,approval_user_comment='$comment',comment_date_time='$currentDate' WHERE app_Sub_id = $app_sub_id AND next_role_id='33'";
				Yii::app()->db->createCommand($verifiactionLevelUpdateSql)->execute();
				
				//Insert Row Verification Level
				$verification = new ApplicationVerificationLevel;
				$verification->next_role_id = '34';
				$verification->app_Sub_id = $app_sub_id;
				$verification->created_on = date('Y-m-d H:i:s');
				$verification->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$verification->ip_address = $_SERVER['REMOTE_ADDR'];
				$verification->approv_status = 'P';
				if($verification->save()) {
					Yii::app()->user->setFlash('Success', "Application ID: $app_sub_id reverted successfully.");
					$this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
				}
			}		
		}
	}
}	