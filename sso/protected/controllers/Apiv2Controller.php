<?php

class Apiv2Controller extends Controller
{
	public function actionIndex()
	{
		header('content-type: application/json');
		header('STATUS: NO TOKEN',true,400);
		$response['STATUS']=400;
		$response['MSG']="NO TOKEN";
		$response['RESPONSE']="";
		echo json_encode($response);
	}
	/**
	*@author Hemant thakur
	*/
	public function actionSecureLogin(){
    	header('content-type: application/json');
		$response=array();	
    	if(isset($_POST['api_hash'],$_POST['username'],$_POST['password'])){
    		$cal_hash=hash_hmac('sha1', md5($username.$password), SSO_API_PUBLIC_KEY);
    		//echo $cal_hash;echo $_POST['api_hash'];die;
			if(1){
				extract($_POST);
	    		$criteria = new CDbCriteria();
	    		$criteria->condition = 'email=:username OR iuid=:iuid';
	    		$criteria->params = array(':username'=>$username, ':iuid'=>$username);
	    		$users = Users::model()->find($criteria);
	    		$data=array();
					if(!empty($users)){
						$users = $users->attributes;
						if(isset($users['salt']) && !empty($users['salt'])){
							$salt = $users['salt'];
							$user_id = $users['user_id'];
			    			$password2 = $users['password'];
			    			$passwd=hash_hmac("sha1",$password.$salt,PASSWORD_SECRET_KEY);
						}
						if($users['is_account_active']==='N'){
							// account is not active
							// http_response_code(403);

							// header('STATUS: In-Active Account',true,403);
							$response['STATUS']=403;
							$response['MSG']="Account is not Active.";
							$response['RESPONSE']="";

						}
						if($passwd === $password2){
							//Create Token
							$token=md5($user_id."_".time()."-".rand(1,999999));
							$token_created_on=date( 'Y-m-d H:i:s');
							//callback_url	callback_failure_url	callback_success_url
							$criteria = new CDbCriteria();
							$criteria->condition = 'user_id=:user_id
													AND callback_url=:CALL_BACK_URL 
													AND callback_failure_url=:callback_failure_url 
													AND callback_success_url=:callback_success_url ';
													/*AND callback_url=:CALL_BACK_URL'; */
							$criteria->params = array(':user_id'=>$user_id,
														':CALL_BACK_URL'=>$CALL_BACK_URL, 
														':callback_failure_url'=>$callback_failure_url,
														':callback_success_url'=>$callback_success_url);
													  /*':CALL_BACK_URL'=>$CALL_BACK_URL);*/
							$ActiveTokens=ActiveTokens::model()->findAll($criteria);
							foreach ($ActiveTokens as $AT) {
								$AT=$AT->attributes;
								$token_id=$AT['token_id'];
								
								$_ActiveTokens=ActiveTokens::model()->findByPk($token_id); // assuming there is a post whose ID is 10
								$_ActiveTokens->delete();
							}
							$sso_active_tokens=new ActiveTokens;
							$sso_active_tokens->user_id=$user_id;
							$sso_active_tokens->callback_url=$CALL_BACK_URL;
							$sso_active_tokens->callback_failure_url=$callback_failure_url;
							$sso_active_tokens->callback_success_url=$callback_success_url;
							$sso_active_tokens->token_created_on=$token_created_on;
							$sso_active_tokens->user_id=$user_id;				
							$sso_active_tokens->token=$token;				
							$sso_active_tokens->save();
							$data['token']=$token;
							// $data['iuid']=>$users['iuid'];
							$data['user_id']=$user_id;
							$data['href']=$href=API_BASEURL."/apiv1/gettokeninfo/token/".$token;
							// echo "<pre>";print_r($data);die;	
							//success
							// http_response_code(200);
							// header('STATUS: Success',true,200);
							$response['STATUS']=200;
							$response['MSG']="Successful Login";
							$response['RESPONSE']=$data;
						}
						else{
							// http_response_code(401);

							// header('STATUS: Invalid Password',true,401);
							$response['STATUS']=401;
							$response['MSG']="Invalid Password";
							$response['RESPONSE']='';
							//invalid password
						}

					}
					else{
						//invalid username or iuid
							// http_response_code(401);

						// header('STATUS: Invalid Password',true,401);
						$response['STATUS']=401;
						$response['MSG']="Invalid IUID or email id";
						$response['RESPONSE']='';
					}
			}
			else{
							// http_response_code(400);

				// header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid API Hash";
				$response['RESPONSE']="Fraudulent data";
			}    		
			
    	}
    	else{
							// http_response_code(400);


			// header('STATUS: NO Service Provider Tag',true,400);
			$response['STATUS']=400;
			$response['MSG']="Bad Request found on the server test";
			$response['RESPONSE']="";
		} 
		echo json_encode($response);
				
	}
	public function actionLogouttoken(){
    	header('content-type: application/json');
		$response=array();	
		
    	if(isset($_GET['token'])) {        	
			$token=trim($_GET['token']);
			$token=strip_tags($token);
			
			if(strlen($token)==32){
				$connection=Yii::app()->db;
				$sql="DELETE FROM sso_active_tokens WHERE token=:token";				
				$command=$connection->createCommand($sql);
				$command->bindParam(":token",$token,PDO::PARAM_STR);
				$command->execute();
				header('STATUS: OK',true,200);				
				$response['STATUS']=200;	
				$response['MSG']="OK";
				$response['RESPONSE']='Done';
			}	
			else{
				header('STATUS: NO TOKEN',true,412);
				$response['STATUS']=412;
				$response['MSG']="INVALID TOKEN";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: NO TOKEN',true,400);
			$response['STATUS']=400;
			$response['MSG']="NO TOKEN";
			$response['RESPONSE']="";
		} 
		
		echo json_encode($response);
	}		
	
	public function actionGettokeninfo(){
    	header('content-type: application/json');
		$response=array();	
    	if(isset($_GET['token'])) {
			$token=trim($_GET['token']);
			$token=strip_tags($token);
			if(strlen($token)==32){				
				$connection=Yii::app()->db;
				$sql="SELECT sso_active_tokens.token_created_on, sso_active_tokens.token, 
						sso_active_tokens.token_access_on,  sso_users.email, sso_users.iuid,
						sso_profiles.*
						FROM sso_active_tokens
						INNER JOIN sso_users
						ON sso_users.user_id = sso_active_tokens.user_id
						INNER JOIN sso_profiles
						ON sso_users.user_id = sso_profiles.user_id
						WHERE sso_active_tokens.token=:token";
				
				$command=$connection->createCommand($sql);
				$command->bindParam(":token",$token,PDO::PARAM_STR);
				$row=$command->queryRow();
				
				if($row==FALSE){
					// header('STATUS: OK',true,204);				
					$response['STATUS']=204;	
					$response['MSG']="No Content";
					$response['ERROR']="Invalid Token";
					$response['RESPONSE']=array();
				}
				else{
					// header('STATUS: OK',true,200);				
					header("HTTP/1.1 200 OK");
					$row['adhaar_number'] 	= $this->stringMasking($row['adhaar_number']);
					$row['pan_card'] 		= $this->stringMasking($row['pan_card']);
					/*$response['STATUS']=200;	
					$response['MSG']="OK";
					$response['RESPONSE']=$row;*/
					
					// header('STATUS: OK',true,200);
					
					/*
						API UPDATED BY SANTOSH KUMAR 
						FOR DMS 
						DATE : 14-Sep-2017
					*/
					// Get list Of all documents of Investor
					$user_id = $row['user_id'];
					$iuid = $row['iuid'];
						$connection = Yii::app()->db;
						$sql_dms = "SELECT iw.chklist_id as document_code,iw.name as document_name,dms.document_name as file_name,dms.doc_status as document_status
								FROM cdn_dms_documents as dms
								INNER JOIN bo_infowizard_documentchklist as iw
								ON iw.docchk_id = dms.docchk_id
								WHERE dms.user_id=:user_id AND dms.iuid=:iuid AND dms.is_document_active='Y' AND (dms.doc_status='U' OR dms.doc_status='V')";

						$command = $connection->createCommand($sql_dms);
						$command->bindParam(":user_id", $user_id, PDO::PARAM_STR);
						$command->bindParam(":iuid", $iuid, PDO::PARAM_STR);
						$row_dms = $command->queryAll();
						if($row_dms == FALSE){
							$row['documents'] = NULL;
						}else{
							$row['documents'] = $row_dms;
						}
					// END OF DOCS
					
					/*
						API UPDATED BY SANTOSH KUMAR 
						FOR Construction Permit 
						DATE : 19-02-2018
					*/
					// Get list Of all applied services
					$sql_st="SELECT * FROM sso_active_tokens_info WHERE token='$token' ORDER BY id DESC LIMIT 1";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql_st);
					$res_st = $command->queryRow();
					$caf_id=false;
					$final_service_id=false;
					$services_data_array=false;
					$document_code=NULL;
					$document_name=NULL;
					$file_name=NULL;
					if(!empty($res_st)){
						$caf_id=$res_st['caf_id'];
						$final_service_id=$res_st['infowiz_final_service_id'];
					}
					
					if(isset($final_service_id) && !empty($final_service_id)){
						$sql_s="SELECT * FROM bo_information_wizard_pre_service_mapping as psm WHERE psm.status='Y' AND psm.service_id='$final_service_id' ORDER BY psm.id DESC LIMIT 1";
						$connection=Yii::app()->db; 
						$command=$connection->createCommand($sql_s);
						$res_s = $command->queryAll();
						$pre_service_id = $res_s[0]['pre_service_id'];
						$pre_service_id_arr = json_decode($pre_service_id,true);
						$i=0;
						foreach($pre_service_id_arr as $key=>$data_arr_new){
							$is_mandatory = $data_arr_new['is_mandatory'];
							$infowiz_final_service_id = $data_arr_new['mapped_service_id'];
							list($in_service_id,$in_sub_service_id) = explode(".",$data_arr_new['mapped_service_id']);
							
							$data_arr = $this->getServiceDatasFromInfowiz($in_service_id,$in_sub_service_id);
							
							$department_name = $data_arr['department_name'];
							$swcs_service_id = $data_arr['swcs_service_id'];
							$core_service_name = $data_arr['core_service_name'];
							
							$data_app_arr = $this->getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id);
							if($data_app_arr){
								$service_status 	= $data_app_arr['app_status'];
								$application_number = $data_app_arr['app_id'];
							}else{
								$service_status 	= NULL;
								$application_number = NULL;
							}
							$data_dms_app_arr = $this->getAppliedServiceCertificate($infowiz_final_service_id,$user_id,$iuid);
							if($data_dms_app_arr){
								$document_code = $data_dms_app_arr['document_code'];
								$document_name = $data_dms_app_arr['document_name'];
								$file_name 	   = $data_dms_app_arr['file_name'];
							}
							
							$services_data_array[$i]['service_id'] 			= $swcs_service_id;
							$services_data_array[$i]['service_name'] 		= $core_service_name;
							$services_data_array[$i]['service_status'] 		= $service_status;
							$services_data_array[$i]['application_number'] 	= $application_number;
							$services_data_array[$i]['department_name'] 	= $department_name;
							$services_data_array[$i]['is_mandatory'] 		= $is_mandatory;
							$services_data_array[$i]['document_code'] 		= $document_code;
							$services_data_array[$i]['document_name'] 		= $document_name;
							$services_data_array[$i]['file_name'] 			= $file_name;
							
							$i++;
						}
					}
					
						if($services_data_array == false){
							$row['sub_services'] = NULL;
						}else{
							$row['sub_services'] = $services_data_array;
						}
					// END OF row_services
					
					/* Added By Rahul @ 05032018*/
					/* Get Sub Service DAta */
					 $paymentInfo= $this->getPaymentInfo();
					 if(!empty($paymentInfo)){
						 $row['payment_info'] = $paymentInfo['payment_info'];
					 }
					  /* End Of adding Payment Info Data */
					

                    $response['STATUS'] = 200;
                    $response['MSG'] = "OK";
                    $response['RESPONSE'] = $row;
					
					
				}
			}
			else{
				header('STATUS: NO TOKEN',true,412);
				$response['STATUS']=412;
				$response['MSG']="INVALID TOKEN";
				$response['ERROR']="Invalid Token Length";
				$response['RESPONSE']="";
			}
		}
		else{
			header('STATUS: NO TOKEN',true,400);
			$response['STATUS']=400;
			$response['MSG']="NO TOKEN";
			$response['ERROR']="Invalid Token Length";
			$response['RESPONSE']="";
		} 
		echo json_encode($response);
    }
	
	/* 
	Below is set of function which is added by Santosh For construction permit
	@Date - 19-02-2018
	@
	*/
		function getServiceDatasFromInfowiz($service_id,$sub_service_id){
			$sql_s="SELECT sp.*,dep.department_name FROM bo_information_wizard_service_parameters as sp
					INNER JOIN sso_service_providers as ssp ON ssp.department_id=sp.department_id
					INNER JOIN bo_departments as dep ON dep.dept_id=ssp.department_id
			WHERE sp.service_id='$service_id' AND sp.servicetype_additionalsubservice='$sub_service_id' AND sp.is_active='Y' ORDER BY sp.id DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			return $res_s;
		}

		function getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id){
			$sql_s="SELECT * FROM bo_sp_applications WHERE sp_app_id='$swcs_service_id' AND caf_id='$caf_id' AND user_id='$user_id' AND app_status !='I' ORDER BY sno DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s;
			return false;
		}
		function getAppliedServiceCertificate($infowiz_final_service_id,$user_id,$iuid){
			$sql_s="SELECT chk.name as document_name,chk.chklist_id as document_code, dms.document_name as file_name FROM bo_information_wizard_service_certificate_maping as c_map 
					INNER JOIN bo_infowizard_documentchklist as chk ON chk.docchk_id=c_map.doc_checklist_id
					LEFT JOIN cdn_dms_documents as dms ON dms.docchk_id=chk.docchk_id AND dms.user_id='$user_id'
					WHERE c_map.final_service_id='$infowiz_final_service_id' AND is_active='Y'  ORDER BY c_map.id DESC, dms.documents_id DESC LIMIT 1";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s;
			return false;
		}
		function stringMasking($cc, $char = 'X') {
			//return $cc;
			$str_count  = strlen($cc);
			$newstring 	= substr($cc, 0, $str_count-4);
			$last_str 	= substr($cc, -4);
			$clean_code = preg_replace('/[a-zA-Z0-9]/', 'X', $newstring);
			return $clean_code.$last_str;
		}
	/***
		END OF SET OF FUNCTION CP......
	**/
	/******======== SANTOSH ===========******/

    /* use to get the secret key of the service provider
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetsecretkey(){
    	header('content-type: application/json');
    	if(isset($_POST['api_hash'],$_POST['sp_tag'])){
    		$api_hash=trim($_POST['api_hash']);
    		$sp_tag=trim($_POST['sp_tag']);
    		$connection=Yii::app()->db;
    		$is_active='Y';
    		$sql="SELECT sp_public_key FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active=:is_active";
    		$command=$connection->createCommand($sql);
			$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
			$command->bindParam(":is_active",$is_active,PDO::PARAM_STR);
			$row=$command->queryRow();
			if($row==FALSE){
				header('STATUS: Invalid Service Provider Tag',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Service Provider Tag";
				$response['RESPONSE']="";
			}
			else{
				$hash=hash_hmac("sha1", $sp_tag, $row['sp_public_key']);
				if($api_hash==$hash){
			    		$sql="SELECT secret_key FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active=:is_active";
			    		$command=$connection->createCommand($sql);
						$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
						$command->bindParam(":is_active",$is_active,PDO::PARAM_STR);
						$row=$command->queryRow();
						if($row===false){
							header('STATUS: OK',true,204);				
							$response['STATUS']=204;	
							$response['MSG']="No Content";
							$response['RESPONSE']=array();
						}
						else{
							header('STATUS: OK',true,200);				
							$response['STATUS']=200;	
							$response['MSG']="OK";
							$response['RESPONSE']=$row;
						}		
				}
				else{
					header('STATUS: Invalid Service Provider Tag',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Service Provider Tag";
					$response['RESPONSE']="";
				}
				
			}
    	}
    	else{

			header('STATUS: NO Service Provider Tag',true,400);
			$response['STATUS']=400;
			$response['MSG']="NO Service Provider Tag";
			$response['RESPONSE']="";
		} 
		echo json_encode($response);
    }
    /* use to update the user profile
    *author: hemant thakur
    *@param:none
    *@response: json
    */

    /**
    * this function is used to update the investors account
    *@author Hemnat thakur
    */
    public function actionActivateDeactivateAccount(){
       	$response=array();
       	if(isset($_POST['api_hash'],$_POST['iuid'],$_POST['status']) && !empty($_POST['api_hash']) && !empty($_POST['iuid'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($iuid), SSO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$profile=json_decode($profile_fields);
				 $res=ProfilesExt::activateAccount($_POST);
				 if($res){
				 	header('STATUS: 200 Ok',true,200);
				 	$response['STATUS']=200;
				 	$response['MSG']="Success";
				 	$response['RESPONSE']="Successfully Updated";
				 }	
				 else{
				 	header('STATUS: Databse Error',true,503);
				 	$response['STATUS']=503;
				 	$response['MSG']="Databse Error";
				 	$response['RESPONSE']="Database Error";
				 }
			}
			else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
		}
		else{
			header('STATUS: Invalid Request',true,400);
			$response['STATUS']=400;
			$response['MSG']="Invalid Request";
			$response['RESPONSE']="Fraudulent data";
		}
		echo json_encode($response);
		return;
    }
    public function actionUpdateUserProfile(){
       	header('content-type: application/json');
       	$response=array();
       	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['iuid']) && !empty($_POST['iuid']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($user_id.$iuid), SSO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$profile=json_decode($profile_fields);
				 $res=ProfilesExt::updateUserprofiile($profile,$user_id);
				 if($res){
				 	header('STATUS: 200 Ok',true,200);
				 	$response['STATUS']=200;
				 	$response['MSG']="Success";
				 	$response['RESPONSE']="Successfully Updated";
				 }	
				 else{
				 	header('STATUS: Databse Error',true,503);
				 	$response['STATUS']=503;
				 	$response['MSG']="Databse Error";
				 	$response['RESPONSE']="Database Error";
				 }
			}
			else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
		}
		else{
			header('STATUS: Invalid Request',true,400);
			$response['STATUS']=400;
			$response['MSG']="Invalid Request";
			$response['RESPONSE']="Fraudulent data";
		}
		echo json_encode($response);
		return;
        	
        }


        /* use to update the user Passwords
        *author: hemant thakur
        *@param:none
        *@response: json
        */

        public function actionUpdateUserPassword(){
         //  	header('content-type: application/json');
           	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['iuid']) && !empty($_POST['iuid']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
				extract($_POST);
				$cal_hash=hash_hmac('sha1', md5($user_id.$iuid), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$profile=json_decode($post_fields);

					if($profile->new_pwd!=$profile->rep_pwd){
						header('STATUS: New password & Repeat password doesn\'t match',true,412);
						$response['STATUS']=412;
						$response['MSG']="New password & Repeat password doesn't match";
						$response['RESPONSE']="New password & Repeat password doesn't match";
					}
					else{
						//echo "<pre>";print_r($profile);die;
						$res=ProfilesExt::updatePassword($profile,$iuid);
						if($res=='save'){
						 	header('STATUS: 200 Ok',true,200);
						 	$response['STATUS']=200;
						 	$response['MSG']="Success";
						 	$response['RESPONSE']="Successfully Updated";
						}	
						elseif($res=='NotSave'){
						 	header('STATUS: Databse Error',true,503);
						 	$response['STATUS']=503;
						 	$response['MSG']="Databse Error";
						 	$response['RESPONSE']="Database Error";
						}
						elseif($res=='NotMatch'){
							header('STATUS: Precondition Failed',true,412);
							$response['STATUS']=412;
							$response['MSG']="Old Password not match";
							$response['RESPONSE']="Old Password not match";
						}
						elseif($res=='NotFound'){
							header('STATUS: Expectation Failed',true,417);
							$response['STATUS']=417;
							$response['MSG']="The server cannot meet the requirements of the Expect request";
							$response['RESPONSE']="The server cannot meet the requirements of the Expect request";
						}
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
			}
			else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
        	
        }
        /* use to get total number of registered user
        *author: hemant thakur
        *@param:none
        *@response: json
        */
        public function actionTotalNewUserRegistered(){
        	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['time']) && !empty($_POST['time']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
           		extract($_POST);
				$cal_hash=hash_hmac('sha1', md5($user_id.$time), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$user_count=ProfilesExt::getTotalRegisteredUsers();
					if(!$user_count){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No Users yet";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$user_count;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
        }


    /* use to get the call_back_url key of the service provider
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGet_call_back_url(){
    	header('content-type: application/json');
    	if(isset($_POST['api_hash'],$_POST['sp_tag'])){
    		$api_hash=trim($_POST['api_hash']);
    		$sp_tag=trim($_POST['sp_tag']);
    		$connection=Yii::app()->db;
    		$is_active='Y';
    		$sql="SELECT sp_public_key FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active=:is_active";
    		$command=$connection->createCommand($sql);
			$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
			$command->bindParam(":is_active",$is_active,PDO::PARAM_STR);
			$row=$command->queryRow();
			if($row==FALSE){
				header('STATUS: Invalid Service Provider Tag',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Service Provider Tag";
				$response['RESPONSE']="";
			}
			else{
				$hash=hash_hmac("sha1", $sp_tag, $row['sp_public_key']);
				if($api_hash==$hash){
			    		$sql="SELECT server_base_url FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active=:is_active";
			    		$command=$connection->createCommand($sql);
						$command->bindParam(":sp_tag",$sp_tag,PDO::PARAM_STR);
						$command->bindParam(":is_active",$is_active,PDO::PARAM_STR);
						$row=$command->queryRow();
						if($row===false){
							header('STATUS: OK',true,204);				
							$response['STATUS']=204;	
							$response['MSG']="No Content";
							$response['RESPONSE']=array();
						}
						else{
							header('STATUS: OK',true,200);				
							$response['STATUS']=200;	
							$response['MSG']="OK";
							$response['RESPONSE']=$row;
						}		
				}
				else{
					header('STATUS: Invalid Service Provider Tag',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Service Provider Tag";
					$response['RESPONSE']="";
				}
				
			}
    	}
    	else{

			header('STATUS: NO Service Provider Tag',true,400);
			$response['STATUS']=400;
			$response['MSG']="NO Service Provider Tag";
			$response['RESPONSE']="";
		} 
		echo json_encode($response);
    }
    /* use to get the username from the user id
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetUserNameFromUserId(){
    		header('content-type: application/json');
    	 	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['uid']) && !empty($_POST['uid'])){
           		extract($_POST);
           		$cal_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$user_name=ProfilesExt::getUsernameFromUserId($uid);
					if(!$user_name){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No user found with this user id";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$user_name;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
    }
    /* use to get the username from the email id
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetUserNameFromUserEmailId(){
		header('content-type: application/json');
	 	$response=array();
       	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['email']) && !empty($_POST['email'])){
       		extract($_POST);
       		$cal_hash=hash_hmac('sha1', md5($email), SSO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$user_name=ProfilesExt::getUsernameFromUserEmail($email);
				if(!$user_name){
					header('STATUS: 204 Ok',true,204);
					$response['STATUS']=204;
					$response['MSG']="No Users";
					$response['RESPONSE']="No user found with this user id";
				}
				else{
					header('STATUS: 200 Ok',true,200);
					$response['STATUS']=200;
					$response['MSG']="Success";
					$response['RESPONSE']=$user_name;
				}
			}
			else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
       	}
       	else{
			header('STATUS: Invalid Request',true,400);
			$response['STATUS']=400;
			$response['MSG']="Invalid Request";
			$response['RESPONSE']="Fraudulent data";
		}
		echo json_encode($response);
		return;
    }

    /* use to get the all the register user with full detail 
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetAllUsersDetail(){
    		header('content-type: application/json');
    	 	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['uid']) && !empty($_POST['uid'])){
           		extract($_POST);
           		$cal_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$users=ProfilesExt::getUsersWithInfo($uid);
					if(!$users){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No user found with this user id";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$users;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
    }


    /* use to get the all the register user with full detail from email id 
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetUsersDetailFromEmail(){
    		header('content-type: application/json');
    	 	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['email']) && !empty($_POST['email'])){
           		extract($_POST);
           		$cal_hash=hash_hmac('sha1', md5($email), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$users=ProfilesExt::getUserDetailFromEmail($email);
					if(!$users){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No user found with this user id";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$users;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
    }
    /* use to get the all the active sso departments
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionActiveServiceProviders(){
    		header('content-type: application/json');
    	 	$response=array();
           		// $cal_hash=hash_hmac('sha1', md5(123), SSO_API_PUBLIC_KEY);
				$dept=ProfilesExt::getAllActiveSSODept();
				if(!$dept){
					// header('STATUS: 204 Ok',true,204);
					$response['STATUS']=204;
					$response['MSG']="No Users";
					$response['RESPONSE']="No user found with this user id";
				}
				else{
					header('STATUS: 200 Ok',true,200);
					$response['STATUS']=200;
					$response['MSG']="Success";
					$response['RESPONSE']=$dept;
				}
			echo json_encode($response);
			return;
    }
       /* use to get the mobile from the user id
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetMobileFromUserId(){
    		header('content-type: application/json');
    	 	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['uid']) && !empty($_POST['uid'])){
           		extract($_POST);
           		$cal_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					// echo "<pre>";print_r($_POST['uid']);die;
					$user_mobile=ProfilesExt::getMobileFromUserId($uid);
					// echo "<pre>";print_r($user_mobile);die;
					if(!$user_mobile){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No user found with this user id";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$user_mobile;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
    }
     /* use to get the mobile from the user id
    *author: hemant thakur
    *@param:none
    *@response: json
    */
    public function actionGetEmailFromUserId(){
    		header('content-type: application/json');
    	 	$response=array();
           	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['uid']) && !empty($_POST['uid'])){
           		extract($_POST);
           		$cal_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
				if($cal_hash==$api_hash){
					$user_email=ProfilesExt::getEmailFromUserId($uid);
					if(!$user_email){
						header('STATUS: 204 Ok',true,204);
						$response['STATUS']=204;
						$response['MSG']="No Users";
						$response['RESPONSE']="No user found with this user id";
					}
					else{
						header('STATUS: 200 Ok',true,200);
						$response['STATUS']=200;
						$response['MSG']="Success";
						$response['RESPONSE']=$user_email;
					}
				}
				else{
					header('STATUS: Invalid Request',true,400);
					$response['STATUS']=400;
					$response['MSG']="Invalid Request";
					$response['RESPONSE']="Fraudulent data";
				}
           	}
           	else{
				header('STATUS: Invalid Request',true,400);
				$response['STATUS']=400;
				$response['MSG']="Invalid Request";
				$response['RESPONSE']="Fraudulent data";
			}
			echo json_encode($response);
			return;
    }
	
	/*
	 * @authour: Rahul Kumar
	 * @date:05032018
	 *                  */
	function getPaymentInfo($sno=null,$appID=null){
		/* For Travelling parameters with blank value*/
		/* Need to Fetch value once Got gateway Information*/
		$response=array();
		$response['payment_info']['payment_type']="NULL";
		$response['payment_info']['payment_mode']="NULL";
		$response['payment_info']['payment_datetime']="NULL";
		$response['payment_info']['paid_amount']="NULL";
		$response['payment_info']['reference_number']="NULL";
		$response['payment_info']['treasury_head_detail']="NULL";
		$response['payment_info']['recipent_bank_name']="NULL";
		$response['payment_info']['recipent_bank_ac_no']="NULL";
		$response['payment_info']['recipent_bank_ifsc_code']="NULL";
		return $response;
	}
}