<?php

class Apiv1Controller extends Controller
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
					header('STATUS: OK',true,200);				
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
						$sql_dms = "SELECT iw.chklist_id as code,iw.name as document_name,dms.document_name as file_name,dms.doc_status as document_status
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
    }      /**
     * @author Jitendra Singh
     * Department logout API
    * Date :07-03-2018
       */
      public function actionSecureDepartmentLogout() {
      //echo "hh...";die;
           if ($_SERVER['REQUEST_METHOD'] == 'GET') {
              header('STATUS: Method Not allowed', true, 405);
              $response['STATUS'] = 405;
              $response['ERROR'] = "Method Not Allowed";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;
          }
          header('content-type: application/json');
          $response = array();
          if (isset($_POST['api_hash'], $_POST['access_token'], $_POST['uid']) && !empty($_POST['api_hash']) && !empty($_POST['access_token']) && !empty($_POST['uid'])){ 

     $access_token =$_POST['access_token']; 
     $user_id      =$_POST['uid'];
     $connection=Yii::app()->db;
     $sql=" UPDATE `bo_access_token` SET is_active='0'  where user_id='".$user_id."' AND access_token='".$access_token."'";
     $command=$connection->createCommand($sql)->execute(); 
     $response['STATUS'] = 200;
     $response['MSG'] = "Successful Logout";
     $response['RESPONSE'] = '';
    }else{
               $response['STATUS'] = 400;
                  $response['MSG'] = "Invalid Request";
                  $response['RESPONSE'] = 'Fraudulent data'; 
    }

      echo json_encode($response);
   }
    /**
       * @author Jitendra Singh
       * Department logout API
    * Date :07-03-2018
       */

   private function getToken($length)
     {
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet); // edited

     for ($i=0; $i < $length; $i++) {
     $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
     }

     return $token;
    }
        /**
            * @author Jitendra Singh
            * Department logout API
         * Date :07-03-2018
            */
           private function crypto_rand_secure($min, $max)
         {
         $range = $max - $min;
         if ($range < 1) return $min; // not so random...
         $log = ceil(log($range, 2));
         $bytes = (int) ($log / 8) + 1; // length in bytes
         $bits = (int) $log + 1; // length in bits
         $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
         do {
         $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
         $rnd = $rnd & $filter; // discard irrelevant bits
         } while ($rnd > $range);
         return $min + $rnd;
        }
		
		  /**
     * @author Rahul Kumar
     * Department login API
     */
    public function actionSecureDepartmentLogin() {
         if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        header('content-type: application/json');
        $response = array();
        if (isset($_POST['api_hash'], $_POST['email'], $_POST['password'])) {
            $apihash="1234567890";
            $PWDHASH='UK_CHHATISGARH!@$%$^$%%$^$^';
            if ($_POST['api_hash']==$apihash) {
                extract($_POST);
                $criteria = new CDbCriteria();
                $pass = hash_hmac('sha1', $password, $PWDHASH);
                $connection = Yii::app()->db;
                $sql = "SELECT bo_user.uid,bo_user.full_name,bo_user.mobile,bo_roles.role_name,bo_roles.role_id,bo_user.dept_id,bo_departments.department_name,bo_user.disctrict_id,bo_district.distric_name FROM bo_user 
INNER JOIN bo_user_role_mapping ON bo_user.uid = bo_user_role_mapping.user_id
INNER JOIN bo_roles ON bo_user_role_mapping.role_id = bo_roles.role_id 
LEFT JOIN bo_district ON bo_user.disctrict_id = bo_district.district_id  
LEFT JOIN bo_departments ON bo_user.dept_id = bo_departments.dept_id 
WHERE `email`=:email  AND `password`=:password AND bo_roles.role_id IN ('2','32','33','34','62','71','72','73','74','3','5','4','7')";

                $command = $connection->createCommand($sql);
                $command->bindParam(":email", strtolower($email), PDO::PARAM_STR);
                $command->bindParam(":password", $pass, PDO::PARAM_STR);
                $users = $command->queryRow();
               
                if ($users === false) {
                    $response['STATUS'] = 403;
                    $response['MSG'] = "incorrect username /  password";
                    $response['RESPONSE'] = "";
                } else {                 				 $users['department_id']=$users['dept_id'];                 $users['district_name']=$users['distric_name'];                $users['district_id']=$users['disctrict_id'];                                               $userMobileNumber=$users['mobile'];                unset($users['dept_id']);                unset($users['distric_name']);                unset($users['disctrict_id']);                unset($users['mobile']);
                    
                    /*$connection=Yii::app()->db;
                    $sql=" UPDATE `bo_access_token` SET is_active='0'  where user_id='".$users['uid']."'";
                    $command=$connection->createCommand($sql)->execute();*/
                    $access_model  = new AccessToken;
                    $token         = $this->getToken(30); 
                    $access_model->user_id =$users['uid'];
                    $access_model->access_token =$token;
                    $access_model->is_active =1;
                    $access_model->created_date =Date('Y-m-d H:m?');
                    $access_model->save();
                    $users['access_token'] =$token;
                                                        $otp=rand(100000,999999);
							//DefaultUtility::sendOTPToMobile($userMobileNumber,"Use " . $otp . " as your login OTP to access Department Login. OTP is confidential. Sharing it with anyone gives them full access to your Dashboard");
                     $users['otp']=$otp;
                                                        $response['STATUS'] = 200;
                    $response['MSG'] = "Successful Login";
                    $response['RESPONSE'] = $users;
                }
            } else {
                $response['STATUS'] = 400;
                $response['MSG'] = "Invalid Request";
                $response['RESPONSE'] = 'Fraudulent data';
            }
        }
       
        echo json_encode($response);
    }
	
	public function actionDepartmentAccessTokenValidate(){
        $response               = array();

        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
		//print_r($_POST);die;

  if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['access_token']) && !empty($_POST['access_token']) && isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            extract($_POST);
              $api_hash       = $_POST['api_hash'];
            $cal_hash       = '1234567890';

            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }

           $criteria = new CDbCriteria();
        $criteria->condition = 'access_token=:access_token AND user_id=:user_id ';
        $criteria->params    = array(':access_token'=>$_POST['access_token'],':user_id'=>$_POST['user_id']);
        $model_users         = AccessToken::model()->find($criteria);
echo "<pre>";
//print_r($model_users);die;
          if($model_users){

                  if($model_users->is_active=='1'){
               $criteria = new CDbCriteria();
               $criteria->select    ='email,uid,dept_id,full_name';
               $criteria->condition = 'uid=:uid';
               $criteria->params = array(':uid'=>$model_users->user_id);
             //  $model_pass = User::model()->find($criteria);
                 //   $user_data = array('email' =>$model_pass->email ,'user_id'=>$model_pass->uid,'dept_id'=>$model_pass->dept_id,'full_name'=>$model_pass->full_name );
//print_r($user_data);
                    header('STATUS: 200', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "Valid AccessToken";
                    $response['RESPONSE'] = ''; //$user_data;
                    echo json_encode($response);
                    return;
                  }else {
                    header('STATUS: 401', true, 401);
                    $response['STATUS'] = 401;
                    $response['MSG'] = "Access Token expired";
                    $response['RESPONSE'] =  '';
                    echo json_encode($response);
                  }

         }else{
                header('STATUS: Bad Request', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Invalid AccessToken";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                return;
            }


        }else{

            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }
}