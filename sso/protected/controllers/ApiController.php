<?php

class ApiController extends Controller {
    
    public function actionIndex(){    
        $this->render("index");
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
				$response['RESPONSE']=$row;
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
				$connection=Yii::app()->db; 								//sso_users.user_id is added by Hemant
				$sql=" SELECT sso_active_tokens.token_created_on, sso_active_tokens.token, 
						sso_active_tokens.token_access_on,  sso_users.email,sso_users.user_id, sso_users.iuid,    
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
	
}