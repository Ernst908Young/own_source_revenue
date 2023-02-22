<?php

class AdminTasksController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','admin','delete','viewAllUsers','downloadUserDetail','downloadUserDetailPDF'),
				'expression'=>'Utility::isSuperAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'RolesExt::isAdminUser()',
			), // Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'DefaultUtility::is_PRINCIPAL_SECRETARY()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'RolesExt::isMISManager()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'DefaultUtility::is_CHEIF_SECRETARY()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications'),
				'expression'=>'RolesExt::isIpDataEntry()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionSendCustomNotifications(){
		$this->render('sendCustomNotifications');

	}

	public function actionGetDistrictApplications(){
		$this->render("distreport");
	}

	/** 
	* this function is used to show all the registered user with status to the admin
	* @author : Hemant Thakur
	* 
	*/


	public function actionViewAllUsers(){
		
		$uid=$_SESSION['uid'];
		$api_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
		$post_data=array("api_hash"=>$api_hash,"uid"=>$uid);
		$data = array();
		//$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getAllUsersDetail',$post_data));
		
		$FY="ALL";
		$fy_date = 'ALL';
		extract($_GET);				
		if(isset($FY) && !empty($FY) && $FY!='ALL')
		{
			//From Date To Date Conditions
			$dateArr = explode("-",$FY);			
			$from_date = $dateArr[0]."-04-01";
			$to_date = $dateArr[1]."-03-31";
			$date1 = date('Y',strtotime($from_date)); 
			$date2 =  date('Y',strtotime($to_date));
			$fy_date =  $date1.'-'.$date2;
		}else{ 
			$from_date = "2014-04-01";
			$to_date = date('Y-m-d');	
		}
		
		
		
		$fromToCondition = " DATE(su.created_on)>='" . @$from_date . "' AND DATE(su.created_on)<='" . @$to_date . "' ";		
		
		$sql="SELECT su.iuid,su.user_id,su.email,su.created_on,su.is_account_active,sup.first_name,sup.country_name,sup.state_name,sup.distt_name,sup.last_name,sup.pan_card,sup.adhaar_number,sup.city_name,sup.pin_code,sup.address,sup.mobile_number  FROM sso_users su
				INNER JOIN sso_profiles sup
				ON su.user_id=sup.user_id WHERE $fromToCondition";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$data=$command->queryAll();
			/* echo "<pre>";
			print_r($data);die(); */
		/* if(is_object($response)){
			if($response->STATUS===200)
				$data=$response->RESPONSE;
		} */
		$this->render('usersDetail',array("data"=>json_decode(json_encode($data), FALSE),'fy_date'=>$fy_date));

	}
	/** 
	* this function is used to doawnload all the registered user with status to the admin
	* @author : Hemant Thakur
	* 
	*/
	public function actionDownloadUserDetail(){
		$uid=$_SESSION['uid'];
		$api_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
		$post_data=array("api_hash"=>$api_hash,"uid"=>$uid);
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getAllUsersDetail',$post_data));
		$data='';
		if(is_object($response)){
			if($response->STATUS===200){
				$data=$response->RESPONSE;
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=UsersDetail.csv');
				$output = fopen('php://output', 'w');

				// output the column headings
				 fputcsv($output, array('SNo','IUID','Full Name','Email Id','Mobile Number','PAN CARD','Aadhar Card',"Country","State","City","District","Postal Code","Address","Registeration Date","Status"));
				 $count=1;
				 foreach ($data as $userData){
				 	$CountryName=LandregionExt::getLandRegionNameViaId($userData->country_name);
				 	$stateName=LandregionExt::getLandRegionNameViaId($userData->state_name);
				 	$status='';
				 	if($userData->is_account_active=='Y')
				 		$status="Active";
				 	else
				 		$status="Inactive";
				 	$data_array=array($count++,$userData->iuid,$userData->first_name." ".$userData->last_name,$userData->email,$userData->mobile_number,$userData->pan_card,$userData->adhaar_number,$CountryName,$stateName,$userData->city_name,$userData->distt_name,$userData->pin_code,$userData->address,$userData->created_on,$status);
				 	fputcsv($output, $data_array);	
				 }
				 fclose($output);
				exit;
			}
		}
		Yii::app()->user->setFlash('Error', "Sorry! No data found.");
		$this->render('usersDetail',array("data"=>$data));
		exit;
	}
	/** 
	* this function is used to doawnload all the registered user with status to the admin
	* @author : Hemant Thakur
	* 
	*/
	public function actionDownloadUserDetailPDF(){
		$uid=$_SESSION['uid'];
		$api_hash=hash_hmac('sha1', md5($uid), SSO_API_PUBLIC_KEY);
		$post_data=array("api_hash"=>$api_hash,"uid"=>$uid);
		$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getAllUsersDetail',$post_data));
		$data='';
		if(is_object($response)){
			if($response->STATUS===200){
				$data=$response->RESPONSE;
				$content = $this -> renderPartial("usersDetailPDF", array('data' => $data), true);
				$name = "UserDetail.pdf";
				Utility::generatePdfApp($content,$name); 
			}
		}
		Yii::app()->user->setFlash('Error', "Sorry! No data found.");
		$this->render('usersDetail',array("data"=>$data));
		exit;
	}


	/** 
	* this function is used to show all the application to the admin
	* @author : Hemant Thakur
	* 
	*/
	public function actionViewFilteredApplications(){
		@session_start();
		if(!isset($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please login before performing this action");
			$this->redirect(Yii::app()->creatreAbsoluteUrl('site/login'));
		}
		if(isset($_POST['application_id']) && isset($_POST['dept_id'])){
			extract($_POST);
			$apps=ApplicationSubmissionExt::getFilteredApplications($dept_id,$application_id);
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=ApplicationDetail.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			fputcsv($output, array('SNo','Department Name','Application Name','User Id','Application Status','Submission Date','IP Address'));
			// loop over the rows, outputting them
			$count=1;
			foreach ($apps as $apps) {
				$api_hash=hash_hmac('sha1', md5($apps['user_id']), SSO_API_PUBLIC_KEY);
				$post_data=array('uid'=>$apps['user_id'],'api_hash'=>$api_hash);
				$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserId',$post_data));
				$uname='';
				if($response->STATUS===200)
					$uname=$response->RESPONSE;
				elseif ($response->STATUS===204) 
					$uname='Not Found with user id '.$apps['user_id'];
				$data_array=array($count++,$apps['department_name'],$apps['application_name'],$uname,$apps['application_status'],$apps['application_created_date'],$apps['ip_address']);
				fputcsv($output, $data_array);	
			}
			fclose($output);
			exit;
		}
		/*
		get all applications of all the departments with total number of pending/aprrove/reject applications
		*/
		$apps=ApplicationExt::getAllApplicationsForAdmin();
		$this->render('filteredApplications',array("applications"=>$apps));
	}


	/** 
	* this function is used to show all the application to the admin
	* @author : Hemant Thakur
	* 
	*/
	public function actionViewAllApplications(){
		@session_start();
		if(!isset($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please login before performing this action");
			$this->redirect(Yii::app()->creatreAbsoluteUrl('site/login'));
		}
		/*
		get all applications of all the departments with total number of pending/aprrove/reject applications
		*/
		$apps=ApplicationExt::getAllApplicationsForAdmin();
		$this->render('allApplications',array("applications"=>$apps));
	}
	/** 
	* this function is used to view all the application'a comments
	* @author : Hemant Thakur
	* 
	*/
	public function actionViewAllApplicationsComments(){
		/*
		get all the submitted application
		*/
		/*$criteria=new CDbCriteria;
		$criteria->condition="application_status!=:incomplete";
		$criteria->params=array(":incomplete"=>"I");*/
		$apps=ApplicationSubmission::model()->findAll();
		$this->render('allApplicationsComments',array("applications"=>$apps));
	}
	/** 
	* this function is used to download all the application'a comments in pdf
	* @author : Hemant Thakur
	* 
	*/
	public function actionDownloadApplicationComments(){
		$criteria=new CDbCriteria;
		$criteria->condition="application_status!=:incomplete";
		$criteria->params=array(":incomplete"=>"I");
		$apps=ApplicationSubmission::model()->findAll($criteria);
		$content=$this->renderPartial('downloadApplicationsComments',array("applications"=>$apps),TRUE);
		$name = "ApplicationsComments.pdf";
		Utility::generatePdfApp($content,$name); 
		exit;
	}
	


	/** 
	* this function is used to download all the application to the admin
	* @author : Hemant Thakur
	* 
	*/	
	public function actionDownloadAllApplications(){
			@session_start();
		if(!isset($_SESSION['uid'])){
			Yii::app()->user->setFlash('Error', "Please login before performing this action");
			$this->redirect(Yii::app()->creatreAbsoluteUrl('site/login'));
		}
		/*
		get all applications of all the departments with total number of pending/aprrove/reject applications
		*/
		$apps=ApplicationExt::getAllApplicationsForAdmin();
		if(empty($apps)){
			Yii::app()->user->setFlash('Error', "No Applications");
			$this->render(Yii::app()->creatreAbsoluteUrl('allApplications'));
			exit;
		}
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=allApplicationDetail.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('SNo','Department Name','Pending Applications','Approve Applications','Reject Applications','Total Application of Department'));
		// loop over the rows, outputting them
		$count=1;
		foreach ($apps as $apps) {
			$pending_app=ApplicationSubmissionExt::getPendingApplicationscount($apps['dept_id']);
			$apprev_ap=ApplicationSubmissionExt::getApproveApplicationscount($apps['dept_id']);
			$reject_app=ApplicationSubmissionExt::getRejectApplicationscount($apps['dept_id']);
			$data_array=array($count++,$apps['department_name'],$pending_app['pending_app'],$apprev_ap['apprv_app'],$reject_app['reject_app'],$apps['total_aps']);
			fputcsv($output, $data_array);		
		}
	}


	public function actionIndex()
	{
		$this->render('index');
	}

}