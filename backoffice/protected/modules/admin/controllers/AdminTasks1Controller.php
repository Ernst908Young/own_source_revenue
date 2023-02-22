<?php
class AdminTasks1Controller extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','viewAllUsers','viewAllUsers1','downloadUserDetail','downloadUserDetailPDF'),
				'expression'=>'Utility::isSuperAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','viewAllUsers1','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'RolesExt::isAdminUser()',
			), // Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','viewAllUsers2','viewAllUsers3','viewAllUsers1','getInvestors','getDeptInvestors','getDeptInvestors2','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'DefaultUtility::is_PRINCIPAL_SECRETARY()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','viewAllUsers1','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'RolesExt::isMISManager()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','viewAllUsers1','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
				'expression'=>'DefaultUtility::is_CHEIF_SECRETARY()',
			),//Added By - Rahul Kumar 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('ViewAllApplications','create','DownloadAllApplications','viewAllApplicationsComments','downloadApplicationComments','getDistrictApplications','ViewFilteredApplications','viewAllUsers','viewAllUsers1','downloadUserDetail','downloadUserDetailPDF','sendCustomNotifications'),
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
		
		/* $sql="SELECT su.iuid,su.user_id,su.email,su.created_on,su.is_account_active,sup.first_name,sup.country_name,sup.state_name,sup.distt_name,sup.last_name,sup.pan_card,sup.adhaar_number,sup.city_name,sup.pin_code,sup.address,sup.mobile_number  FROM sso_users su
				INNER JOIN sso_profiles sup
				ON su.user_id=sup.user_id WHERE $fromToCondition and is_account_active='Y'"; */
			$sql="SELECT su.iuid,su.user_id,su.email,su.created_on,su.is_account_active,sup.first_name,sup.last_name,sup.mobile_number,bo_dept_service_application.infowiz_dept_id,bo_infowizard_issuerby_master.name,bo_dept_service_application.infowiz_service_name FROM sso_users su
INNER JOIN sso_profiles sup ON su.user_id=sup.user_id 
LEFT JOIN bo_dept_service_application ON bo_dept_service_application.iuid=su.iuid
LEFT join bo_infowizard_issuerby_master on bo_infowizard_issuerby_master.issuerby_id = bo_dept_service_application.infowiz_dept_id 
WHERE su.is_account_active='Y' group by su.iuid";	
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
	
	public function actionViewAllUsers1(){
		
		
		$data = array();		
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
		
		
		
		$fromToCondition = "  AND DATE(sso_users.created_on)>='" . @$from_date . "' AND DATE(sso_users.created_on)<='" . @$to_date . "' ";	
		
			$requestData= $_REQUEST;
			$columns = array(				
				'0' =>'SNo',
				'1' =>'iuid',
				'2' =>'InvestorDetail',
				'3'=> 'InPrincipleApplication',
				'4'=> 'DepartmentalClearance',
				'5'=> 'Action'
			);
			
			// echo "<pre>";
			 //print_r($requestData);
			$sql1=$sql="SELECT sso_users.iuid,sso_users.user_id,sso_users.email,sso_users.created_on,
			sso_users.is_account_active,
			sso_profiles.first_name,
			sso_profiles.last_name,
			sso_profiles.mobile_number			
			FROM sso_users
			INNER JOIN sso_profiles ON sso_users.user_id=sso_profiles.user_id WHERE sso_users.is_account_active='Y' $fromToCondition ";
			
			$searchKeyWord = htmlspecialchars($requestData['search']['value']);
			if(!empty($searchKeyWord)) {
				$sql.=" AND ( sso_users.iuid LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_users.email LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.mobile_number LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_users.created_on LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.first_name LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.last_name LIKE '%".$searchKeyWord."%' ) ";
				
				$connection=Yii::app()->db;				
				$command=$connection->createCommand($sql);
				$data=$command->queryAll();
			}
			
			$sql.=" ORDER BY iuid "   .$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$data=$command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql1);
			$data2=$command->queryAll();
			
			$totalData = $totalFiltered = count($data2);
			//$totalFiltered = $totalData=1000;
			if(!empty($data)){
				$i=1;
				foreach ($data as $row) {
					$userID = $row['user_id'];
					$iuID = $row['iuid'];
					if($row['is_account_active']=='Y'){
						$status = "<br/><b>Status: </b><span class='label label-sm label-success'>Activated</span>";
					} 
					else{
						$status = "<br/><b>Status: </b><span class='label label-sm label-warning'>Inactive</span>" ;
					} 
					$result_caf=Yii::app()->db->createCommand("select application_status,user_id,application_id,submission_id from bo_application_submission where user_id = $userID AND application_id=1")->queryAll();
					if(!empty($result_caf)){
						$CAF = '';
						foreach($result_caf as $key=>$val)
						{
							if(!empty($val['application_status']) && $val['application_status']=='B')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Pending For Payment</p>';
							}	
							if(!empty($val['application_status']) && $val['application_status']=='A')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Approved</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='I')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Incomplete</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='R')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Rejected</p>';
							}
							if(!empty($val['application_status']) && ($val['application_status']=='RBI' || $val['application_status']=='H'))
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Reverted</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='Z')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Archived</p>';
							}
						}
					}else{
						$CAF = "Not Applied Yet";
					}	
					
					$deptArr = Yii::app()->db->createCommand("select distinct infowiz_dept_id,bo_infowizard_issuerby_master.name,bo_dept_service_application.infowiz_service_name from bo_dept_service_application 
					LEFT JOIN bo_infowizard_issuerby_master on bo_infowizard_issuerby_master.issuerby_id=bo_dept_service_application.infowiz_dept_id
					where is_active='Y' AND ( iuid = $iuID OR sw_user_id=$userID);")->queryAll();
					
					$deptArr2 = Yii::app()->db->createCommand("select bo_departments.department_name,bo_sp_all_applications.app_name,bo_sp_applications.sno from bo_sp_applications
 INNER JOIN bo_sp_all_applications  ON bo_sp_applications.sp_app_id=bo_sp_all_applications.app_id
 INNER JOIN sso_service_providers  ON sso_service_providers.sp_id=bo_sp_all_applications.sp_id 
 INNER JOIN bo_departments  ON bo_departments.dept_id=sso_service_providers.department_id
 where  bo_sp_applications.user_id=$userID AND bo_departments.dept_id 
NOT IN (select dept_id from bo_departments where infowiz_short_code IN(select abb from bo_infowizard_issuerby_master 
where issuerby_id IN (select distinct infowiz_dept_id from bo_dept_service_application)))")->queryAll();
					
					$deptNameArr = '';
					
					$m = 1;
					foreach($deptArr as $Kd=>$Vd)
					{						
						$deptNameArr .= "<span><b>".$Vd['name']."</b></span>:<br/> ".$m.". ". $Vd['infowiz_service_name'].' <span class="label label-sm label-success">'.$m.' NOS.</span><hr>';
						$m++;
					}
					
					$n = 1;
					foreach($deptArr2 as $Kd1=>$Vd1)
					{						
						$deptNameArr .= "<span><b>".$Vd1['department_name']."</b></span>:<br/> ".$n.". ". $Vd1['app_name'].' <span class="label label-sm label-success">'.$n.' NOS.</span><hr>';
						$n++;
					}
					
					$userIDenc = base64_encode($row['user_id']);
					$iuIDen = base64_encode($row['iuid']);
					$datanew[] = [								
						'SNo'=>$i,
						'iuid'=>"<a href='/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen'>".$row['iuid']."</a>",
						'InvestorDetail'=>"<b>Single Window User: </b><br/>".$row['first_name']." ".$row['last_name']."</br>".$row['email']."</br>".$row['mobile_number']."<br/><b>Registered On: </b>".$row['created_on']."  ".$status."",
						'InPrincipleApplication'=>$CAF,
						'DepartmentalClearance'=>$deptNameArr,
						'Action'=>"/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen/financial_year/$fy_date"
						];
					$i++;
				}
			
				$json_data = array(
					"draw"            => intval( $requestData['draw'] ),
					"recordsTotal"    => intval( $totalData ),
					"recordsFiltered" => intval( $totalFiltered ),
					"data"            => $datanew
				);

				echo json_encode($json_data);
				die; 
			} 
			/* if(is_object($response)){
				if($response->STATUS===200)
					$data=$response->RESPONSE;,array("data"=>json_encode($json_data))
			} */
		
	}
		
	public function actionViewAllUsers2(){
		$this->render('usersDetail1');
	}
	public function actionViewAllUsers3(){
		$data = array();		
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
		
		$this->render('usersDetail2',array('from_date'=>$from_date,'to_date'=>$to_date,'fy_date'=>$fy_date));
	}
	
	public function actionGetInvestors()
	{		
		
		$data = array();
		$fromToCondition='';
		
		
		$fromToCondition = "  AND DATE(sso_users.created_on)>='" . @$_POST['from_date'] . "' AND DATE(sso_users.created_on)<='" . @$_POST['to_date'] . "' "; 
		
		$requestData= $_REQUEST;
		$columns = array(				
			'0' =>'SNo',
			'1' =>'iuid',
			'2' =>'InvestorDetail',
			'3' =>'MoU',
			'4'=> 'InPrincipleApplication',			
			'5'=> 'ExistingEnterprises',
			'6'=> 'DepartmentalClearance',
			'7'=> 'Inspection',
			'8'=> 'Action'
		);			
		
		$sql1=$sql="SELECT sso_users.iuid,sso_users.user_id,sso_users.email,sso_users.created_on,
		sso_users.is_account_active,
		sso_profiles.first_name,
		sso_profiles.last_name,
		sso_profiles.mobile_number	
		FROM sso_users
		INNER JOIN sso_profiles ON sso_users.user_id = sso_profiles.user_id 		
		WHERE sso_users.is_account_active='Y' $fromToCondition ";
		
		$searchKeyWord = htmlspecialchars(@$requestData['search']['value']);
		if(!empty($searchKeyWord)) {
			$sql.=" AND ( sso_users.iuid LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR sso_users.email LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR sso_profiles.mobile_number LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR sso_users.created_on LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR sso_profiles.first_name LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR sso_profiles.last_name LIKE '%".$searchKeyWord."%' ) ";
			
			$connection=Yii::app()->db;				
			$command=$connection->createCommand($sql);
			$data=$command->queryAll();
		}
		/* if(isset($requestData['order']) && !empty($requestData['order']) && isset($requestData['start']) && !empty($requestData['start'])  && !empty($requestData['length']))
		{  */
			$sql.=" ORDER BY iuid "   .$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		/* } else{
			$sql.=" ORDER BY iuid DESC  "; 
		}
		 */
		
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$data=$command->queryAll();
		
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql1);
		$data2=$command->queryAll();
		
		$totalData = $totalFiltered = count($data2);
		//print_r($requestData);
		//$totalFiltered = $totalData=1000;
		if(!empty($data)){
			$i=1;
			foreach ($data as $row) {
				$userID = $row['user_id'];
				$iuID = $row['iuid'];
				if($row['is_account_active']=='Y'){
					$status = "<br/><b>Status: </b><span class='label label-sm label-success'>Activated</span>";
				} 
				else{
					$status = "<br/><b>Status: </b><span class='label label-sm label-warning'>Inactive</span>" ;
				} 
				$result_caf=Yii::app()->db->createCommand("select application_status,user_id,application_id,submission_id,pis_mou.master_reference_no,pis_mou.company_name,pis_mou.representative_name,pis_mou.phone_number,pis_mou.email_id,pis_mou.mou_number,pis_mou.mou_proposed_investment_type,pis_mou.mou_proposed_investment_rs,pis_mou.mou_proposed_employment from bo_application_submission left Join du_pis_mou_upload as pis_mou on pis_mou.caf_id = bo_application_submission.submission_id  where user_id = $userID AND application_id=1")->queryAll(); 
				$mouDetals = '';
				$CAF = '';
				if(!empty($result_caf)){
									
					foreach($result_caf as $key=>$val)
					{						
						 if(isset($val['master_reference_no']) && !empty($val['master_reference_no'])){
							$mouDetals .= "<p><b>MRN No.:</b> ".$val['master_reference_no']."</br>
										<b>Company Name:</b> ".$val['company_name']."</br>
										<b>Representative Name:</b> ".$val['representative_name']."</br>
										<b>Phone Number:</b> ".$val['phone_number']."</br>
										<b>Email:</b> ".$val['email_id']."</br>
										<b>MoU Number:</b> ".$val['mou_number']."</br>	
										<b>MoU Proposed Investment:</b> ".$val['mou_proposed_investment_rs'].''.$val['mou_proposed_investment_type']."</br>
										<b>MoU Proposed Employment:</b> ".$val['mou_proposed_employment']."</br></p>";
						} 			
						if(!empty($val['application_status']) && $val['application_status']=='B')
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Pending For Payment</p>';
						}	
						if(!empty($val['application_status']) && $val['application_status']=='A')
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Approved</p>';
						}
						if(!empty($val['application_status']) && $val['application_status']=='I')
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Incomplete</p>';
						}
						if(!empty($val['application_status']) && $val['application_status']=='R')
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Rejected</p>';
						}
						if(!empty($val['application_status']) && ($val['application_status']=='RBI' || $val['application_status']=='H'))
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Reverted</p>';
						}
						if(!empty($val['application_status']) && $val['application_status']=='Z')
						{
							$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Archived</p>';
						}
					} 
				}else{
					$CAF = "Not Applied Yet";
				}	
					/* if(isset($row['submission_id']) && !empty($row['submission_id']))
					{
						if(!empty($row['application_status']) && $row['application_status']=='B')
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Pending For Payment</p>';
						}	
						if(!empty($row['application_status']) && $row['application_status']=='A')
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Approved</p>';
						}
						if(!empty($row['application_status']) && $row['application_status']=='I')
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Incomplete</p>';
						}
						if(!empty($row['application_status']) && $row['application_status']=='R')
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Rejected</p>';
						}
						if(!empty($row['application_status']) && ($row['application_status']=='RBI' || $row['application_status']=='H'))
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Reverted</p>';
						}
						if(!empty($row['application_status']) && $row['application_status']=='Z')
						{
							$CAF.= '<p>CAF ID: '.@$row['submission_id'].', Archived</p>';
						}
					}else{
						$CAF = "Not Applied Yet";
					} */
					
				
				/* $deptArr = Yii::app()->db->createCommand("select distinct infowiz_dept_id,bo_infowizard_issuerby_master.name,bo_dept_service_application.infowiz_service_name from bo_dept_service_application 
				LEFT JOIN bo_infowizard_issuerby_master on bo_infowizard_issuerby_master.issuerby_id=bo_dept_service_application.infowiz_dept_id
				where is_active='Y' AND ( iuid = $iuID OR sw_user_id=$userID);")->queryAll();
				
				$deptArr2 = Yii::app()->db->createCommand("select bo_departments.department_name,bo_sp_all_applications.app_name,bo_sp_applications.sno from bo_sp_applications
INNER JOIN bo_sp_all_applications  ON bo_sp_applications.sp_app_id=bo_sp_all_applications.app_id
INNER JOIN sso_service_providers  ON sso_service_providers.sp_id=bo_sp_all_applications.sp_id 
INNER JOIN bo_departments  ON bo_departments.dept_id=sso_service_providers.department_id
where  bo_sp_applications.user_id=$userID AND bo_departments.dept_id 
NOT IN (select dept_id from bo_departments where infowiz_short_code IN(select abb from bo_infowizard_issuerby_master 
where issuerby_id IN (select distinct infowiz_dept_id from bo_dept_service_application)))")->queryAll(); */

				$deptArr = Yii::app()->db->createCommand("select distinct (bo_dept_service_application.infowiz_service_name) as serviceName, 
count(bo_dept_service_application.infowiz_service_name) as tot_service,bo_infowizard_issuerby_master.name as departmentName 
from bo_dept_service_application 
LEFT JOIN bo_infowizard_issuerby_master on bo_infowizard_issuerby_master.issuerby_id=bo_dept_service_application.infowiz_dept_id
where is_active='Y' AND ( iuid =$iuID OR sw_user_id=$userID) group by bo_dept_service_application.infowiz_service_name having tot_service >0 order by departmentName")->queryAll();
				
				$deptArr2 = Yii::app()->db->createCommand("select distinct (bo_sp_all_applications.app_name) as serviceName, count(bo_sp_all_applications.app_name) as tot_service, bo_departments.department_name  as departmentName,
bo_sp_applications.sno from bo_sp_applications
INNER JOIN bo_sp_all_applications  ON bo_sp_applications.sp_app_id=bo_sp_all_applications.app_id
INNER JOIN sso_service_providers  ON sso_service_providers.sp_id=bo_sp_all_applications.sp_id 
INNER JOIN bo_departments  ON bo_departments.dept_id=sso_service_providers.department_id
where  bo_sp_applications.user_id=$userID AND bo_sp_applications.sp_app_id!='280' AND bo_sp_applications.sp_app_id 
NOT IN (SELECT bo_sp_all_applications.app_id FROM sso_service_providers 
INNER JOIN bo_dept_service_application ON sso_service_providers.service_provider_tag=bo_dept_service_application.sp_tag 
INNER JOIN bo_sp_all_applications ON sso_service_providers.sp_id= bo_sp_all_applications.sp_id
GROUP BY bo_sp_all_applications.app_id) AND bo_departments.dept_id 
NOT IN (select dept_id from bo_departments where infowiz_short_code IN(select abb from bo_infowizard_issuerby_master 
where issuerby_id IN (select distinct infowiz_dept_id from bo_dept_service_application))) group by serviceName having tot_service>0 order by departmentName")->queryAll();	
				
				$deptNameArr = '';
				if(isset($deptArr) && !empty($deptArr))
				{	$m = 1;					
					foreach($deptArr as $Kd=>$Vd)
					{						
						$deptNameArr .= "<span><b>".$Vd['departmentName']."</b></span>:<br/> ".$m.". ". $Vd['serviceName'].' <span class="label label-sm label-success">'.$Vd['tot_service'].' NOS.</span><hr>';
						$m++;
					}
				}
				$n = 1;
				foreach($deptArr2 as $Kd1=>$Vd1)
				{						
					$deptNameArr .= "<span><b>".$Vd1['departmentName']."</b></span>:<br/> ".$n.". ". $Vd1['serviceName'].' <span class="label label-sm label-success">'.$Vd1['tot_service'].' NOS.</span><hr>';
					$n++;
				}
				
				$deptExistingServicesArr =array();
				
				if(isset($userID) && !empty($userID))
				{	
					$deptExistingServicesArr = Yii::app()->db->createCommand("SELECT distinct (bo_sp_applications.app_name) as serviceName, count(bo_sp_applications.app_name) as tot_service
 FROM bo_sp_applications WHERE user_id =$userID and sp_app_id = '280' group by serviceName having tot_service>1;")->queryAll();
				} 
				
				$ExistNameArr =''; 
				$totalExisting = array();
				if(isset($deptExistingServicesArr) && !empty($deptExistingServicesArr))
				{	
					$r = 1;
					
					foreach($deptExistingServicesArr as $s1=>$s2)
					{					
						if(isset($s2['serviceName']) && !empty($s2['serviceName']))
						{							
							$ExistNameArr = '<br/>'.$r.". ". @$s2['serviceName'].'&nbsp;<span class="label label-sm label-success">'.$s2['tot_service'].' NOS.</span>';
						}	  
						$r++;
					} 
				}   

				$inspectionDataStr = "";				
				$sql = "select boIns.application_id,boIns.user_id,boIns.unit_name,boIns.unit_address,boIns.department_id,boIns.district_id,boIns.inspection_ack_no,boIns.type_of_industry,boIns.inspector_name,bo_district.distric_name 
				from bo_inspection_data as boIns 
				LEFT JOIN bo_district on bo_district.district_id=boIns.district_id 
				LEFT JOIN bo_dept_service_application ON boIns.user_id =bo_dept_service_application.dept_user_id 
				where bo_dept_service_application.iuid ='".$iuID."' group by user_id";
				$connection = Yii::app()->db;	
				$command = $connection->createCommand($sql);
				$inspectionData = $command->queryAll();
				
				//Get Inspection Data 
				if(isset($inspectionData) && !empty($inspectionData))
				{	
					foreach($inspectionData as $kins=>$vins)
					{
						$inspectionDataStr .= "<p><b>Application Id: </b>".@$vins['application_id']."<br/><b>Unit Name: </b>".@$vins['unit_name']."<br/><b>Unit Address: </b>".@$vins['unit_address']."<br/><b>Inspection Acknowledgement no: </b>".@$vins['inspection_ack_no']."</br><b>Type of industry: </b>".@$vins['type_of_industry']."</br><b>Inspector Name: </b>".@$vins['inspector_name']."</br><b>District: </b>".@$vins['distric_name']."</p><hr/>";
						
					}	
				}	
				
				$userIDenc = base64_encode($row['user_id']);
				$iuIDen = base64_encode($row['iuid']);
				$datanew[] = [								
						'SNo'=>$i+$requestData['start'],
						'iuid'=>"<a href='/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen'>".$row['iuid']."</a>",
						'InvestorDetail'=>"<b>Single Window User: </b><br/>".$row['first_name']." ".$row['last_name']."</br>".$row['email']."</br>".$row['mobile_number']."<br/><b>Registered On: </b>".$row['created_on']."  ".$status."",
						'MoU' =>$mouDetals,
						'InPrincipleApplication'=>$CAF,
						'ExistingEnterprises'=>$ExistNameArr,
						'DepartmentalClearance'=>$deptNameArr,
						'Inspection'=>$inspectionDataStr,
						'Action'=>"/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen/financial_year/$_POST[fy_date]"
					];
				$i++;
			}
		
			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $datanew
			);

			echo json_encode($json_data);
			die; 
		} 
	
	}
	
	public function actionGetDeptInvestors2()
	{		
		$data = array();
		$fromToCondition='';
		
		
		$fromToCondition = "  AND DATE(bo_dept.application_created_on)>='" . @$_POST['from_date'] . "' AND DATE(bo_dept.application_created_on)<='" . @$_POST['to_date'] . "' "; 
		
		$requestData= $_REQUEST;
		$columns = array(				
			'0' =>'SNo',
			'1' =>'iuid',
			'2' =>'InvestorDetail',
			/* '3'=> 'InPrincipleApplication',			
			'4'=> 'ExistingEnterprises',  */
			'3'=> 'DepartmentalClearance',
			'4'=> 'Inspection',
			'5'=> 'Action'
		);			
		
		$sql1=$sql="select bo_dept.sno,bo_dept.infowiz_dept_id,bo_dept.dept_user_id,bo_dept.infowiz_service_name,bo_dept.unit_name,bo_dept.application_created_on,bo_dept.dept_application_number,bo_dept.is_active,bo_dept.applicant_name,bo_dept.applicant_email,bo_dept.applicant_contact_no,bo_dept.app_status,bo_dept.app_comment,bo_issuer.name,bo_issuer.issuerby_id,bo_dept.download_certificate_call_back_url from bo_dept_service_application as bo_dept LEFT Join bo_infowizard_issuerby_master as bo_issuer on bo_issuer.issuerby_id=bo_dept.infowiz_dept_id where bo_dept.is_active='Y' and bo_dept.is_applied_through_sw='N' $fromToCondition";
		
		$searchKeyWord = htmlspecialchars($requestData['search']['value']);
		
		if(!empty($searchKeyWord)) {
			$sql.=" AND ( bo_dept.dept_user_id ='".$searchKeyWord."' ";
			$sql.=" OR bo_dept.applicant_email LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR bo_dept.applicant_contact_no LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR bo_dept.application_created_on LIKE '%".$searchKeyWord."%' ";
			$sql.=" OR bo_dept.applicant_name LIKE '%".$searchKeyWord."%' ) ";
			$connection=Yii::app()->db;				
			$command=$connection->createCommand($sql);
			$data=$command->queryAll();
		}		
		if(isset($requestData['groupdata']) && !isset($requestData['deptData']))
		{
			$sql .=" ORDER BY bo_dept.".$requestData['groupdata']." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		}
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$data=$command->queryAll();
		
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql1);
		$data2=$command->queryAll();
		$newData = array();
		$totalData = $totalFiltered = count($data2);
		/*  echo "<pre>";
		print_r($data);die; */
		if(!empty($data)){
			
			$DeptClearenceData ='';
			$i=1;
			foreach ($data as $key=>$val) {
				
				if(isset($val['app_status']) && $val['app_status']=='R')
				{
					$status ='Reject';
				}
				if(isset($val['app_status']) && $val['app_status']=='A')
				{
					$status ='Approved';
				}
				if(isset($val['app_status']) && $val['app_status']=='I')
				{
					$status ='Incomplete';
				}
				if(isset($val['app_status']) && $val['app_status']=='RBI')
				{
					$status ='Reverted';
				}
				if(isset($val['app_status']) && $val['app_status']=='P')
				{
					$status ='Under Process';
				}
				if(isset($val['app_status']) && $val['app_status']=='F')
				{
					$status ='Under Process-Forwarded';
				}
				//Get Inspection Data 
				$inspectionDataStr = "";
				$connection = Yii::app()->db;	
				$sql = "select boIns.application_id,boIns.user_id,boIns.unit_name,boIns.unit_address,boIns.department_id,boIns.district_id,boIns.inspection_ack_no,boIns.type_of_industry,boIns.inspector_name,bo_district.distric_name 
				from bo_inspection_data as boIns left join bo_district on bo_district.district_id=boIns.district_id where user_id ='".$val['dept_user_id']."'";
				$command = $connection->createCommand($sql);
				$inspectionData = $command->queryAll();
				
				
				//Get Inspection Data 
				if(isset($inspectionData) && !empty($inspectionData))
				{	
					foreach($inspectionData as $kins=>$vins)
					{
						$inspectionDataStr .= "<p><b>Application Id: </b>".@$vins['application_id']."<br/><b>Unit Name: </b>".@$vins['unit_name']."<br/><b>Unit Address: </b>".@$vins['unit_address']."<br/><b>Inspection Acknowledgement no: </b>".@$vins['inspection_ack_no']."</br><b>Type of industry: </b>".@$vins['type_of_industry']."</br><b>Inspector Name: </b>".@$vins['inspector_name']."</br><b>District: </b>".@$vins['distric_name']."</p><hr/>";
						
					}	
				}		
				//Get Last Synced On Data 
				$connection = Yii::app()->db;	
				$sql = "select modified from bo_dept_service_application where infowiz_dept_id =".$val['infowiz_dept_id']." ORDER BY modified DESC LIMIT 1";
				$command = $connection->createCommand($sql);
				$modifiedData = $command->queryRow();
                                                                        
				$sql = "select created from bo_dept_service_application where infowiz_dept_id =".$val['infowiz_dept_id']." ORDER BY created DESC LIMIT 1";
				$command = $connection->createCommand($sql);
				$createdData = $command->queryRow();
				
				$modified_date = ($modifiedData['modified'] > $createdData['created']) ? $modifiedData['modified'] : $createdData['created'];
				//Get Last Synced On Data 
				
				$DeptClearenceData =$val['infowiz_service_name']."<br/><b>Unit Name: </b>".$val['unit_name']."<br/><b>Application No. </b><span class='label label-sm label-success' style='color:#000;'>".$val['dept_application_number']."</span> <br/><b>Status: </b> ".$status." <br/><b>Comment: </b> ".$val['app_comment']."<hr><b>Status as on :</b>".$modified_date."";
				
				if(isset($val['download_certificate_call_back_url']) && $val['download_certificate_call_back_url']!='NA' && $val['download_certificate_call_back_url']!='N.A'){
					$action = $val['download_certificate_call_back_url'];
				}else{
					$action = "";
				}
				
				$datanew[] = [								
						'SNo'=>$i+$requestData['start'],
						'iuid'=>$val['name'].'-'.$val['dept_user_id'],
						'InvestorDetail'=>'<b>Departmental Portal User:</b><br/>'.$val['applicant_name']." <br/>". $val['applicant_email']." <br/>".$val['applicant_contact_no'],
						/* 'InPrincipleApplication'=>'',
						'ExistingEnterprises'=>'', */ 
						'DepartmentalClearance'=>$DeptClearenceData,
						'Inspection'=>$inspectionDataStr,
						'Action'=>"'$action'"
						]; 
				$i++;		
			}	
			
			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $datanew
			); 
			
			echo json_encode($json_data);
				
			die; 
		}
	
	}
	
	
	public function actionGetDeptInvestors()
	{		
		$data = array();		
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
		
		
		
		$fromToCondition = "  AND DATE(sso_users.created_on)>='" . @$from_date . "' AND DATE(sso_users.created_on)<='" . @$to_date . "' ";	
		
			$requestData= $_REQUEST;
			$columns = array(				
				'0' =>'SNo',
				'1' =>'iuid',
				'2' =>'InvestorDetail',
				'3'=> 'InPrincipleApplication',
				'4'=> 'DepartmentalClearance',				
				'6'=> 'Action'
			);			
			
			$sql1=$sql="select sso_users.iuid,sso_users.is_account_active,sso_users.user_id,sso_users.created_on,sso_users.email,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number  from sso_users left join sso_profiles on sso_profiles.user_id=sso_users.user_id where sso_users.user_id IN(select distinct user_id from bo_sp_applications) $fromToCondition";
			
			$searchKeyWord = htmlspecialchars($requestData['search']['value']);
			
			if(!empty($searchKeyWord)) {
				$sql.=" AND ( sso_users.iuid LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_users.email LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.mobile_number LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_users.created_on LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.first_name LIKE '%".$searchKeyWord."%' ";
				$sql.=" OR sso_profiles.last_name LIKE '%".$searchKeyWord."%' ) ";
				
				$connection=Yii::app()->db;				
				$command=$connection->createCommand($sql);
				$data=$command->queryAll();
			}
			
			$sql.=" ORDER BY iuid "   .$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$data=$command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql1);
			$data2=$command->queryAll();
			
			$totalData = $totalFiltered = count($data2);
			//$totalFiltered = $totalData=1000;
			if(!empty($data)){
				$i=1;
				foreach ($data as $row) {
					$userID = $row['user_id'];
					$iuID = $row['iuid'];
					if($row['is_account_active']=='Y'){
						$status = "<br/><b>Status: </b><span class='label label-sm label-success'>Activated</span>";
					} 
					else{
						$status = "<br/><b>Status: </b><span class='label label-sm label-warning'>Inactive</span>" ;
					} 
					/* $result_caf=Yii::app()->db->createCommand("select application_status,user_id,application_id,submission_id from bo_application_submission where user_id = $userID AND application_id=1")->queryAll();
					if(!empty($result_caf)){
						$CAF = '';
						foreach($result_caf as $key=>$val)
						{
							if(!empty($val['application_status']) && $val['application_status']=='B')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Pending For Payment</p>';
							}	
							if(!empty($val['application_status']) && $val['application_status']=='A')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Approved</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='I')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Incomplete</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='R')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Rejected</p>';
							}
							if(!empty($val['application_status']) && ($val['application_status']=='RBI' || $val['application_status']=='H'))
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Reverted</p>';
							}
							if(!empty($val['application_status']) && $val['application_status']=='Z')
							{
								$CAF.= '<p>CAF ID: '.@$val['submission_id'].', Archived</p>';
							}
						}
					}else{
						$CAF = "Not Applied Yet";
					} */	
					$CAF = "";
					/* $deptArr = Yii::app()->db->createCommand("select distinct infowiz_dept_id,bo_infowizard_issuerby_master.name,bo_dept_service_application.infowiz_service_name from bo_dept_service_application 
					LEFT JOIN bo_infowizard_issuerby_master on bo_infowizard_issuerby_master.issuerby_id=bo_dept_service_application.infowiz_dept_id
					where is_active='Y' AND ( iuid = $iuID OR sw_user_id=$userID);")->queryAll();
					
					$deptArr2 = Yii::app()->db->createCommand("select bo_departments.department_name,bo_sp_all_applications.app_name,bo_sp_applications.sno from bo_sp_applications
 INNER JOIN bo_sp_all_applications  ON bo_sp_applications.sp_app_id=bo_sp_all_applications.app_id
 INNER JOIN sso_service_providers  ON sso_service_providers.sp_id=bo_sp_all_applications.sp_id 
 INNER JOIN bo_departments  ON bo_departments.dept_id=sso_service_providers.department_id
 where  bo_sp_applications.user_id=$userID AND bo_departments.dept_id 
NOT IN (select dept_id from bo_departments where infowiz_short_code IN(select abb from bo_infowizard_issuerby_master 
where issuerby_id IN (select distinct infowiz_dept_id from bo_dept_service_application)))")->queryAll();
					
					$deptNameArr = '';
					
					$m = 1;
					foreach($deptArr as $Kd=>$Vd)
					{						
						$deptNameArr .= "<span><b>".$Vd['name']."</b></span>:<br/> ".$m.". ". $Vd['infowiz_service_name'].' <span class="label label-sm label-success">'.$m.' NOS.</span><hr>';
						$m++;
					}
					
					$n = 1;
					foreach($deptArr2 as $Kd1=>$Vd1)
					{						
						$deptNameArr .= "<span><b>".$Vd1['department_name']."</b></span>:<br/> ".$n.". ". $Vd1['app_name'].' <span class="label label-sm label-success">'.$n.' NOS.</span><hr>';
						$n++;
					} */
					$deptNameArr="";
					$userIDenc = base64_encode($row['user_id']);
					$iuIDen = base64_encode($row['iuid']);
					$datanew[] = [								
						'SNo'=>$i,
						'iuid'=>"<a href='/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen'>".$row['iuid']."</a>",
						'InvestorDetail'=>"<b>Departmental Portal User: </b><br/>".$row['first_name']." ".$row['last_name']."</br>".$row['email']."</br>".$row['mobile_number']."<br/>  ".$status."",
						'InPrincipleApplication'=>$CAF,
						'DepartmentalClearance'=>$deptNameArr,						
						'Action'=>"/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userIDenc/iuid/$iuIDen/financial_year/$fy_date"
						];
					$i++;
				}
			
				$json_data = array(
					"draw"            => intval( $requestData['draw'] ),
					"recordsTotal"    => intval( $totalData ),
					"recordsFiltered" => intval( $totalFiltered ),
					"data"            => $datanew
				);

				echo json_encode($json_data);
				die; 
			} 
	
	}
	
}