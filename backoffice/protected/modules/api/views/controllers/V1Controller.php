<?php

class V1Controller extends Controller
{
	function init() {

   }
	public function actionIndex()
	{
		echo json_encode(array("HHHHH"=>"Get lost"));	
		// Utility::sendOTPToMobile('9599424588','Test Message from Hemant Thakur');
	}
	/** 
	* This function is used to get all the application of particular department
	* @author Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetAllDeptApplications(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['dept_id']) && !empty($_POST['dept_id'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($dept_id), BO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$apps=ApplicationExt::getDepartmentApplications($dept_id);
				if(!empty($apps)){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Successfully Saved";
					$response['RESPONSE']=$apps;
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error";
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
	*This function is used to get all the submitted application of the particular department
	* @author: Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetDepartmentSubmitApplications(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['dept_id']) && !empty($_POST['dept_id'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($dept_id), BO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$apps=ApplicationExt::getDepartmentSubmitApplications($dept_id);
				if(!empty($apps)){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Successfully Saved";
					$response['RESPONSE']=$apps;
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error";
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
	*This function is used to get all the User applictions from particular department that he submitted
	* @author: Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetUsersSubDeptApplications(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['dept_id']) && !empty($_POST['dept_id'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($user_id.$dept_id), BO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$apps=ApplicationExt::getUsersSubDeptApplications($user_id,$dept_id);
				if(!empty($apps)){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Successfully Saved";
					$response['RESPONSE']=$apps;
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error";
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
	*This function is used to get all the User applictions from all the departments that he submitted
	* @author: Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetUsersSubApplications(){
		$response=array();
		if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
			extract($_POST);
			$cal_hash=hash_hmac('sha1', md5($user_id), BO_API_PUBLIC_KEY);
			if($cal_hash==$api_hash){
				$apps=ApplicationExt::getUsersSubApplications($user_id);
				if(!empty($apps)){
					header('STATUS: 200 Ok',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="Successfully Saved";
					$response['RESPONSE']=$apps;
				}
				else{
					header('STATUS: DB error',true,503);				
					$response['STATUS']=503;	
					$response['MSG']="Database Error";
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
	* This function is used to get particular user application
	* @author Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetUsersApplications(){

	}
	/** 
	* This function is used to get all the application of particular user of particualr Department
	* @author Hemant Thakur
	* @return json
	*
	*
	*/
	public function actionGetDeptUsersApplications(){

	}

	/*
	* Function to return all the countries name
	* auther: Hemant Thakur
	* param: 
	* return: json
	*
	*/
public function actionGetAllPages(){
	extract($_POST);
	$response=array();

	$api_hmac=hash_hmac("sha1",'RequestToGetAllPagesList',OTP_SECRET_KEY);
	if($hmac!=$api_hmac){
		header('STATUS: Bad Request',true,400);				
		$response['STATUS']=400;	
		$response['MSG']="Bad Request";
		$response['RESPONSE']="";
	}else{
			$pages=Utility::getPageTree(1);
			if(empty($pages)){
				header('STATUS: NO CONTENT',true,204);
				$response['STATUS']=204;
				$response['MSG']="NO CONTENT";
				$response['COUNTRIES']="";
			}
			else{
				header('STATUS: OK',true,200);				
				$response['STATUS']=200;	
				$response['MSG']="OK";
				$response['PAGES']=$pages;
			}
	}
	print_r(json_encode($response));
	return;
}
public function actionGetcountrylist(){
	global $wturls;	
	$response=array();
	$request="http://$_SERVER[HTTP_HOST]";
	if(!1){
		header('STATUS: Bad Request',true,400);				
		$response['STATUS']=400;	
		$response['MSG']="Bad Request";
		$response['COUNTRIES']="";
	}else{
		$countries=Utility::getCountryList();
		if(empty($countries)){
			header('STATUS: NO CONTENT',true,204);
			$response['STATUS']=204;
			$response['MSG']="NO CONTENT";
			$response['COUNTRIES']="";
		}
		else{
			header('STATUS: OK',true,200);				
			$response['STATUS']=200;	
			$response['MSG']="OK";
			$response['COUNTRIES']=$countries;
		}
	}
	echo json_encode($response);
	return;
}
/*
	* Function to return all the states name
	* auther: Hemant Thakur
	* param: 
	* return: json
	*
	*/
public function actiongetContryStates(){
	$country=$_POST['country'];
	global $wturls;	
	$response=array();
	$request="http://$_SERVER[HTTP_HOST]";
	// in_array($request, $wturls)
	if(!1){
		header('STATUS: Bad Request',true,400);				
		$response['STATUS']=400;	
		$response['MSG']="Bad Request";
		$response['RESPONSE']="";
	}else{
		$country=intval($country);
		$states=Utility::getStateList($country);
		if(empty($states)){
			header('STATUS: NO CONTENT',true,204);
			$response['STATUS']=204;
			$response['MSG']="NO CONTENT";
			$response['RESPONSE']="";
		}
		else{
			header('STATUS: OK',true,200);				
			$response['STATUS']=200;	
			$response['MSG']="OK";
			$response['STATE']=$states;
		}
	}
	echo json_encode($response);
	return;
}
/*
	* Function to send otp
	* auther: Hemant Thakur
	* param: 
	* return: json
	*
	*/
public function actionSendMobMsg(){
	$fields=extract($_POST);
	$response=array();
	$api_hmac=hash_hmac("sha1",$mobile.$email,OTP_SECRET_KEY);
	if(strlen($mobile)<>10){
		header('STATUS: Not Acceptable',true,406);				
		$response['STATUS']=406;	
		$response['MSG']="Not Acceptable";
		$response['RESPONSE']="";
	}

	else if($hmac!=$api_hmac){
		header('STATUS: Bad Request',true,400);				
		$response['STATUS']=400;	
		$response['MSG']="Bad Request";
		$response['RESPONSE']="";
	}else{
		$state=Utility::sendOTPToMobile($mobile,$msg);
			header('STATUS: OK',true,200);				
			$response['STATUS']=200;	
			$response['MSG']="OK";
			$response['STATE']="SUCCESS";
	}
	echo json_encode($response);
	return;
}


/*
	* Function to send emails
	* auther: Hemant Thakur
	* param: 
	* return: json
	*
	*/
 public function actionSendUIIDViaEmail(){
			$fields=extract($_POST);
			$response=array();
			$api_hmac=hash_hmac("sha1",$uiid.$email,OTP_SECRET_KEY);
			$request="http://$_SERVER[HTTP_HOST]fdfg";
			if($hmac!=$api_hmac){
				header('STATUS: Bad Request',true,400);				
				$response['STATUS']=400;	
				$response['MSG']="Bad Request";
				$response['RESPONSE']="";
			}else{
				$state=Utility::sendEmail(EMAIL_HOST,EMAIL_PORT,EMAIL_USERNAME,EMAIL_PASSWORD,$subject,$message,$email);
				if($state){
					header('STATUS: OK',true,200);				
					$response['STATUS']=200;	
					$response['MSG']="OK";
					$response['STATE']="SUCCESS";
				}
				else{
					header('STATUS: Internal Server Error',true,500);				
					$response['STATUS']=500;	
					$response['MSG']="Internal Server Error";
					$response['STATE']="UNSUCCESSFULL";
				}
					
			}
			echo json_encode($response);
			return;
    }

    /**
	* This function is used to save the SP application in the department
	* @author : Hemant Thakur
	* @return : Json string
    */
    public function actionSubmitSPApplication(){
    	$response=array();
    	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
    		extract($_POST);
			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id), SW_PUBLIC_KEY);
			if($api_hash==$cal_api_hash){
				$criteria = new CDbCriteria();
				$criteria->condition="sp_tag=:sp_tag AND app_id=:app_id AND user_id=:user_id AND app_status=:app_status";
				$criteria->params = array(':sp_tag'=>$sp_tag,':app_id'=>$app_id,':user_id'=>$user_id,':app_status'=>$app_status);
				$modelCheck = SpApplications::model()->findAll($criteria);
				if(!empty($modelCheck)){
					#header('STATUS: 204 Ok',TRUE,204);				
					$response['STATUS']=409;	
					$response['MSG']="Already submitted";
					$response['RESPONSE']="Application is already submitted";
				}
				else{
					$model=new SpApplications;
					$model->sp_tag=$sp_tag;
					$model->app_id=$app_id;
					$model->app_name=$app_name;
					$model->app_fields=$application_fields;
					$model->app_status=$app_status;
					$model->user_id=$user_id;
					$model->created_on=date('Y-m-d H:m:s');
					$model->updated_on=date('Y-m-d H:m:s');
					$model->is_active='Y';
					$model->remote_server=$remote_ip;
					$model->user_agent=$user_agent;
					if($model->save()){
						header('STATUS: 200 Ok',true,200);				
						$response['STATUS']=200;	
						$response['MSG']="Successfully Saved";
						$response['RESPONSE']="Submitted Successfully";
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
    	* This function is used to update the SP application in the department
    	* @author : Hemant Thakur
    	* @return : Json string
        */
        public function actionUpdateSPApplication(){
        	$response=array();
        	if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])){
        		extract($_POST);
    			$cal_api_hash=hash_hmac('sha1', md5($user_id.$app_id), SW_PUBLIC_KEY);
    			if($api_hash==$cal_api_hash){
    				$aprv='A';
    				$criteria = new CDbCriteria();
    				$criteria->condition="sp_tag=:sp_tag AND app_id=:app_id AND user_id=:user_id AND app_status!=:aprv";
    				$criteria->params = array(':sp_tag'=>$sp_tag,':app_id'=>$app_id,':user_id'=>$user_id,':aprv'=>$aprv);
    				$model = SpApplications::model()->find($criteria);
    				if(!empty($model)){
    					$model->app_fields=$application_fields;
    					$model->app_status=$app_status;
    					$model->updated_on=date('Y-m-d H:m:s');
    					$model->is_active='Y';
    					if($model->save()){
    						header('STATUS: 200 Ok',true,200);				
    						$response['STATUS']=200;	
    						$response['MSG']="Successfully Saved";
    						$response['RESPONSE']="Submitted Successfully";
    					}
    					else{
    						header('STATUS: DB error',true,503);				
    						$response['STATUS']=503;	
    						$response['MSG']="Database Error".$model->geterrors();
    						$response['RESPONSE']="Unknown Error. Please Try again Later";
    					}
    				}
    				else{
    					header('STATUS: DB error',true,412);				
    					$response['STATUS']=412;	
    					$response['MSG']="Database Error";
    					$response['RESPONSE']="Condition Failed";
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
    			$response['RESPONSE']="ye wala";
    		}	
    		echo json_encode($response);
    		return;
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
