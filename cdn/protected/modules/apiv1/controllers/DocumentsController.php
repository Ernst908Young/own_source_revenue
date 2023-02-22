<?php

class DocumentsController extends Controller
{
	/**
	* This function is used to get the appeal documents from the server
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetAppealDocument(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['appeal_id']) && !empty($_POST['appeal_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($appeal_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$conversation=false;
				if(isset($convrstn) && $convrstn=='k')
					$conversation=true;
				// echo $convrstn;die;
				$document_detail=DocumentsExt::getAppealDocuments($appeal_id,$conversation);
				if($document_detail){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="all ok";
					$response['RESPONSE']=$document_detail;
				}
				else{
					header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to store the appeal's Documents 
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionSaveAppealDocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['appeal_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($appeal_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="appeal_id=:appeal_id";
				$criteria->params = array(':appeal_id'=>$appeal_id);
				$model = AppealDocuments::model()->find($criteria);
				if(!empty($model)){
					header('STATUS: 409 Conflict',true,409);				
					$response['STATUS']=409;	
					$response['MSG']="Already Exist";
					$response['RESPONSE']="Uploaded Successfully";
				}
				else{
					 	$model= new AppealDocuments;
					 	if(!empty($_POST['appeal_id']))
					 		$model->appeal_id= $_POST['appeal_id'];
					 	if(isset($_POST['appeal_conversation_id']))
					 		$model->appeal_conversation_id= $_POST['appeal_conversation_id'];
					 	$model->document_name=$_POST['doc_name'] ;
					 	$model->document=$_POST['doc_blob_data'];
					 	$model->doc_type=$_POST['doc_type'];
					 	if($model->save()){
					 		
				 			header('STATUS: 200 Ok',true,200);				
				 			$response['STATUS']=200;	
				 			$response['MSG']="Successfully Saved";
				 			$response['RESPONSE']="Uploaded Successfully";
					 	}
					 	else{
					 		header('STATUS: DB error',true,503);				
					 		$response['STATUS']=503;	
					 		$response['MSG']="Database Error".$model->geterrors();
					 		$response['RESPONSE']="Unknown Error. Please Try again Later";
					 	}
					 }
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="Invalid";
			}	
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="Invalid";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to get the Investor's documents from the server
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetInvestorDocument(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['app_sub_id']) && !empty($_POST['app_sub_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($app_sub_id.$user_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$document_detail=DocumentsExt::getInvestorDocuments($app_sub_id);
				if($document_detail){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="all ok";
					$response['RESPONSE']=$document_detail;
				}
				else{
					header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}


/* This function is used to get the user's documents via doc id
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetDocumentsViaID(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['doc_id']) && !empty($_POST['doc_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($doc_id.$user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$model= new DocumentsExt;

				$document_detail=$model->getUserDocumentViaId($doc_id);
				if(!empty($document_detail)){
					#header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="ok";
					$response['RESPONSE']=$document_detail;
				}
				else{
					#header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to get the Investor's documents from the server sso Dept's APp
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetInvestorSSOAppDocument(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['app_sub_id']) && !empty($_POST['app_sub_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($app_sub_id.$user_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$document_detail=DocumentsExt::getInvestorSSOAppDocuments($app_sub_id);
				if($document_detail){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="all ok";
					$response['RESPONSE']=$document_detail;
				}
				else{
					header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}


	/**
	* This function is used to store the department's User Documents for investors
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionSaveInvestorDocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id.$dept_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="app_sub_id=:app_id";
				$criteria->params = array(':app_id'=>$app_id);
				$model = InvestorDocumentsByDepartments::model()->find($criteria);
				if(!empty($model)){
					header('STATUS: 409 Conflict',true,409);				
					$response['STATUS']=409;	
					$response['MSG']="Already Exist";
					$response['RESPONSE']="Uploaded Successfully";
				}
				else{
					 	$model= new InvestorDocumentsByDepartments;
					 	$modelMetaInfo=new InvestorDocumentsByDepartmentsMetainfo;
					 	$model->app_sub_id= $_POST['app_id'];
					 	$model->doc_name=$_POST['doc_name'] ;
					 	$model->document=$_POST['doc_blob_data'];
					 	$model->doc_type=$_POST['doc_type'];
					 	if($model->save()){
					 		$modelMetaInfo->doc_id=$model->doc_id;
					 		$modelMetaInfo->doc_size=$_POST['doc_size'];
					 		$modelMetaInfo->uploaded_by=$_POST['user_id'];
					 		$modelMetaInfo->department_id=$_POST['dept_id'];
					 		$modelMetaInfo->uploaded_date_time=$_POST['date_time'];
					 		$modelMetaInfo->remote_ip_address=$_POST['remote_ip'];
					 		$modelMetaInfo->user_agent=$_POST['user_agent'];
					 		if($modelMetaInfo->save()){
					 			header('STATUS: 200 Ok',true,200);				
					 			$response['STATUS']=200;	
					 			$response['MSG']="Successfully Saved";
					 			$response['RESPONSE']="Uploaded Successfully";
					 		}
					 		else{
					 			header('STATUS: DB error',true,503);				
					 			$response['STATUS']=503;	
					 			$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					 			$response['RESPONSE']="Unknown Error. Please Try again Later";
					 		}
					 	}
					 	else{
					 		header('STATUS: DB error',true,503);				
					 		$response['STATUS']=503;	
					 		$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					 		$response['RESPONSE']="Unknown Error. Please Try again Later";
					 	}
					 }
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="Invalid";
			}	
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="Invalid";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to store the department's User Documents for investors of sso Integrated dept's apps
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionSaveInvestorSSODocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id.$dept_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="app_sub_id=:app_id";
				$criteria->params = array(':app_id'=>$app_id);
				$model = InvestorSsoAppDocumentsByDepartments::model()->find($criteria);
				if(!empty($model)){
					header('STATUS: 409 Conflict',true,409);				
					$response['STATUS']=409;	
					$response['MSG']="Already Exist";
					$response['RESPONSE']="Already Uploaded";
				}
				else{
					 	$model= new InvestorSsoAppDocumentsByDepartments;
					 	$modelMetaInfo=new InvestorSsoAppDocumentsByDepartmentsMetainfo;
					 	$model->app_sub_id= $_POST['app_id'];
					 	$model->doc_name=$_POST['doc_name'] ;
					 	$model->document=$_POST['doc_blob_data'];
					 	$model->doc_type=$_POST['doc_type'];
					 	if($model->save()){
					 		$modelMetaInfo->doc_id=$model->doc_id;
					 		$modelMetaInfo->doc_size=$_POST['doc_size'];
					 		$modelMetaInfo->uploaded_by=$_POST['user_id'];
					 		$modelMetaInfo->department_id=$_POST['dept_id'];
					 		$modelMetaInfo->uploaded_date_time=$_POST['date_time'];
					 		$modelMetaInfo->remote_ip_address=$_POST['remote_ip'];
					 		$modelMetaInfo->user_agent=$_POST['user_agent'];
					 		if($modelMetaInfo->save()){
					 			header('STATUS: 200 Ok',true,200);				
					 			$response['STATUS']=200;	
					 			$response['MSG']="Successfully Saved";
					 			$response['RESPONSE']="Uploaded Successfully";
					 		}
					 		else{
					 			header('STATUS: DB error',true,503);				
					 			$response['STATUS']=503;	
					 			$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					 			$response['RESPONSE']="Unknown Error. Please Try again Later";
					 		}
					 	}
					 	else{
					 		header('STATUS: DB error',true,503);				
					 		$response['STATUS']=503;	
					 		$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					 		$response['RESPONSE']="Unknown Error. Please Try again Later";
					 	}
					 }
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="Invalid";
			}	
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="Invalid";
		}
		echo json_encode($response);
		return;
	}


	/**
	* This function is used to store the user's documents in the server
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionSaveDocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$model= new Documents;				
				$model->parent_doc_id= $_POST['doc_id'];
				$model->document_name=$_POST['doc_name'] ;
				$model->document=$_POST['doc_blob_data'];
				$model->document_mime_type=$_POST['doc_type'];
				if($model->save()){
					$modelMetaInfo=new DocumentsMetainfo;
					$modelMetaInfo->doc_id=$model->doc_id;
					$modelMetaInfo->uploaded_by=$_POST['user_id'];
					$modelMetaInfo->department_id=$_POST['dept_id'];
					$modelMetaInfo->application_id=$_POST['app_id'];
					$modelMetaInfo->uploaded_on=date('Y-m-d H:m:s');
					//echo json_encode($modelMetaInfo->doc_id . '-' .$modelMetaInfo->uploaded_by .'-' . $modelMetaInfo->department_id . '-' . $modelMetaInfo->application_id . '-' . $modelMetaInfo->uploaded_on);die;//($modelMetaInfo);return;	
					if($modelMetaInfo->save()){
						if($_POST['app_id'] == 8){
							$modelApp = new AllotmentApplicationDocs;
							$modelApp->doc_id = $_POST['doc_id'];;
							$modelApp->app_id = $_POST['app_id'];
							$modelApp->app_submission_id = $_POST['submission_id'];
							$modelApp->created_on = date("Y-m-d");
							$modelApp->save();
						}
						header('STATUS: 200 Ok',true,200);				
						$response['STATUS']=200;	
						$response['MSG']="Successfully Saved";
						$response['RESPONSE']="Uploaded Successfully";
						$response['doc_id']=$model->doc_id;
					}
					else{
						header('STATUS: DB error',true,503);				
						$response['STATUS']=503;	
						$response['MSG']="Database Error".$modelMetaInfo->geterrors();
						$response['RESPONSE']="Unknown Error. Please Try again Later";
					}
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					$response['RESPONSE']="Unknown Error. Please Try again Later";
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="galat hash";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="adhura doc";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to store the verifier Documents
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionSaveVerifierDocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$model= new Documents;
				$modelMetaInfo=new DocumentsMetainfo;
				$model->document_name=$_POST['doc_name'] ;
				$model->document=$_POST['doc_blob_data'];
				$model->document_mime_type=$_POST['doc_type'];
				if($model->save()){
					$modelMetaInfo->doc_id=$model->doc_id;
					$modelMetaInfo->uploaded_by=$_POST['user_id'];
					$modelMetaInfo->verifier_id=$_POST['user_id'];
					$modelMetaInfo->verifier_role_id=$_POST['verifier_role_id'];
					$modelMetaInfo->verifier_document='Y';
					$modelMetaInfo->department_id=$_POST['dept_id'];
					$modelMetaInfo->application_id=$_POST['app_id'];
					$modelMetaInfo->uploaded_on=date('Y-m-d H:m:s');
					if($modelMetaInfo->save()){
						header('STATUS: 200 Ok',true,200);				
						$response['STATUS']=200;	
						$response['MSG']="Successfully Saved";
						$response['RESPONSE']="Uploaded Successfully";
					}
					else{
						header('STATUS: DB error',true,503);				
						$response['STATUS']=503;	
						$response['MSG']="Database Error".$modelMetaInfo->geterrors();
						$response['RESPONSE']="Unknown Error. Please Try again Later";
					}
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error".$modelMetaInfo->geterrors();
					$response['RESPONSE']="Unknown Error. Please Try again Later";
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to get the user's documents from the server
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetdocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['doc_id']) && !empty($_POST['doc_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($doc_id.$user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$model= new DocumentsExt;
				$document_detail=$model->getUserDocument($user_id,$doc_id);
				if($document_detail){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Mill gya";
					$response['RESPONSE']=$document_detail;
				}
				else{
					// header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to get the verifier documents corresponding to user application
	* application id is replaced by application submission id.
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/
	public function actionGetVerifierdocuments(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['app_id']) && !empty($_POST['app_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$model= new DocumentsExt;
				$document_detail=$model->getAppVerifierDocument($user_id,$app_id);
				if($document_detail){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Mill gya";
					$response['RESPONSE']=$document_detail;
				}
				else{
					// header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['RESPONSE']=array();
				}
			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to verify the documents
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/

	public function actionVerifyDocument(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['doc_id']) && !empty($_POST['doc_id']) && isset($_POST['verifier_role_id']) && !empty($_POST['verifier_role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($doc_id.$user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="doc_id=:doc_id";
				$criteria->params = array(':doc_id'=>$doc_id);
				$model = DocumentsMetainfo::model()->find($criteria);
				if($model->status!='P'){
					header('STATUS: Not Modified',true,304);				
					$response['STATUS']=304;	
					$response['MSG']="Already Modified";
					$response['RESPONSE']="Already Modified By Someone";
				}
				else{
					$model->status='V';
					$model->verifier_id=$verifier_id;
					$model->verifier_role_id=$verifier_role_id;
					$model->verified_date=date('Y-m-d H:m:s');
					if($model->save()){
						header('STATUS: 200 Ok',true,200);				
						$response['STATUS']=200;	
						$response['MSG']="Mill gya";
						$response['RESPONSE']="Successfully Updated";
					}
					else{
						header('STATUS: DB error',true,503);				
						$response['STATUS']=503;	
						$response['MSG']="Database Error".$model->geterrors();
						$response['RESPONSE']="Unknown Error. Please Try again Later";
					}
				}

			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}
	/**
	* This function is used to verify the documents
	* @return json response to the user
	* @param none
	* @author Hemant Thakur
	*/

	public function actionRejectDocument(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['doc_id']) && !empty($_POST['doc_id']) && isset($_POST['verifier_role_id']) && !empty($_POST['verifier_role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_api_hash=hash_hmac('sha1',md5($doc_id.$user_id.$app_id), CDN_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="doc_id=:doc_id";
				$criteria->params = array(':doc_id'=>$doc_id);
				$model = DocumentsMetainfo::model()->find($criteria);
				if($model->status!='P'){
					header('STATUS: Not Modified',true,304);				
					$response['STATUS']=304;	
					$response['MSG']="Already Modified";
					$response['RESPONSE']="Already Modified By Someone";
				}
				else{
					$model->status='R';
					$model->verifier_id=$verifier_id;
					$model->verifier_role_id=$verifier_role_id;
					$model->verified_date=date('Y-m-d H:m:s');
					if($model->save()){
						header('STATUS: 200 Ok',true,200);				
						$response['STATUS']=200;	
						$response['MSG']="Mill gya";
						$response['RESPONSE']="Successfully Updated";
					}
					else{
						header('STATUS: DB error',true,503);				
						$response['STATUS']=503;	
						$response['MSG']="Database Error".$model->geterrors();
						$response['RESPONSE']="Unknown Error. Please Try again Later";
					}
				}

			}
			else{
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: Bad Request',true,400);				
			$response['STATUS']=400;	
			$response['MSG']="Bad Request";
			$response['RESPONSE']="";
		}
		echo json_encode($response);
		return;
	}


	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

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
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionCreate()
	{
		$model=new Documents;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Documents');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Documents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documents']))
			$model->attributes=$_GET['Documents'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documents the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documents $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
