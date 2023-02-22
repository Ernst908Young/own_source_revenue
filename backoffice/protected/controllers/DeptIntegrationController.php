<?php

class DeptIntegrationController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actionTest2(){
		echo "<pre>";print_r(ApplicationExt::getCategoryTotalProject());
	}
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionShow(){
		//echo "Post Array===><pre>==========>";print_r($_POST);die;
	}
	public function actionTest(){
		$host = 'jumbolabs.com';
		$port = 80;
		$connection = @fsockopen($host, $port);
	    if (is_resource($connection))
	    {
	        echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

	        fclose($connection);
	    }

	    else
	    {
	        echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
	    }
	}

	/**
	 *Profile View
	 */
	public function actionProfile()
	{	@session_start();
		if(isset($_SESSION['RESPONSE']))
			$this->render('profile');
		else
			$this->redirect(Yii::app()->homeUrl);
	}
	/**
	 *Profile Edit
	 */
	public function actionEditProfile()
	{	@session_start();
		if(isset($_SESSION['RESPONSE']))
			$this->render('profile_edit');
		else
			$this->redirect(Yii::app()->homeUrl);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect(array('/frontuser'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($Error=Yii::app()->ErrorHandler->Error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $Error['message'];
			else
				$this->render('Error', $Error);
		}
	}
	public function actionRedirectToIncentiveScheme(){
		@session_start();
		if(isset($_SESSION['uid'])){
			$users=$this->getUserInfo($_SESSION['uid']);
			$model_pass=json_decode(json_encode($_SESSION));
			// echo "<pre>";print_r($model_pass);die;
			$this->renderPartial("redirect",array("model"=>$model_pass));
	        exit;	
		}
		else{
			echo "Please login on Single Windows Clearance System ";
			// throw new Exception("Please login on Single Windows Clearance System", 403);
			
		}
		
	}
	protected function getUserInfo($uid){
		$sql="SELECT bo_user.*,distt.distric_name,dept.department_name FROM bo_user 
		 INNER JOIN bo_user_role_mapping rm
		 INNER JOIN bo_district distt ON bo_user.disctrict_id=distt.district_id
		 INNER JOIN bo_departments dept ON dept.dept_id=bo_user.dept_id
		 where rm.user_id=bo_user.uid AND (bo_user.uid=$uid)";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$users=$command->queryRow();
		return $users;
	}
	private function getdistNodalList(){
		$sql="SELECT bo_user.*,distt.distric_name,dept.department_name FROM bo_user INNER JOIN bo_user_role_mapping rm
		 INNER JOIN bo_district distt ON bo_user.disctrict_id=distt.district_id
		 INNER JOIN bo_departments dept ON dept.dept_id=bo_user.dept_id
		 where rm.user_id=bo_user.uid AND  role_id=3 ORDER BY distt.distric_name";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$users=$command->queryAll();
		return $users;
	}
	private function getStateNodallist(){
		$sql="SELECT bo_user.*,distt.distric_name,dept.department_name FROM bo_user INNER JOIN bo_user_role_mapping rm
		 INNER JOIN bo_district distt ON bo_user.disctrict_id=distt.district_id
		 INNER JOIN bo_departments dept ON dept.dept_id=bo_user.dept_id
		 where rm.user_id=bo_user.uid AND (role_id=4 OR role_id=5) ORDER BY bo_user.disctrict_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$users=$command->queryAll();
		return $users;
	}

	public function actionExportDistNodalList(){
		$users=$this->getdistNodalList();
		$content=$this->renderPartial("exportListNodal",array("users"=>$users,"type"=>"Distt"),true);
		DefaultUtility::PDFApplication($content,"NodalList.pdf");
		exit;
	}
	public function actionExportStateNodalList(){
		$users=$this->getStateNodallist();
		$this->renderPartial("exportListNodal",array("users"=>$users,"type"=>"State"));
	}
	public function actionDisttListNodal(){
		$users=$this->getdistNodalList();
		$this->renderPartial("listNodal",array("users"=>$users,"type"=>"Distt"));
	}
	public function actionStateListNodal(){
		$users=$this->getStateNodallist();
		$this->renderPartial("listNodal",array("users"=>$users,"type"=>"State"));
	}
	public function actionUploadNicCode(){
		die("===> Access Denied");
		ini_set('max_execution_time', 9999);
				$fileName = getcwd()."/nic_code.csv";    
				if (($handle = fopen($fileName, "r")) !== FALSE) {
					$cnt = 0;    
				    	$success = 1; 
					while (($rowToArray = fgetcsv($handle, 500000, ",")) !== FALSE) {
						// echo "<pre>"; print_r($rowToArray); die; 
						if ($cnt <= 0) {
							// $header = $rowToArray;
							// echo "<pre>";print_r($header);
							echo $cnt++;
						} else {
							$header = $rowToArray;
							$model=new NICCodes;
							if(!empty($header[2])){
								$model->NIC_V_Digit=$header[2];
								$model->Description=$header[3];
								if(1){
									echo "<br>$cnt=========><pre>";print_r($model->geterrors());

								}

							}
							else
								echo "========> Not updated for $cnt<br>";
							
						}
					}
				}
	}



public function actionGetIndustrTypeser(){
		$applications=ApplicationSubmission::model()->findAll();
		foreach ($applications as $key => $apps) {
			$fileds=json_decode($apps->field_value);
			echo "<table>";
			if(isset($fileds->ntrofunit) && !empty($fileds->ntrofunit)){
				//$ans=$this->getNamFromVAlue($fileds->industry_type);
				if(isset($fileds->ntrofunit) && $fileds->ntrofunit=='Services'){
				echo "<tr>";
				echo"<td>$apps->submission_id</td>";
				echo"<td>[$fileds->company_name]</td>";
				echo"<td>$fileds->ntrofunit</td>";
				//echo"<td>($ans)</td>";
				echo "</tr>";
			}
				//echo "<br> Industry type for caf $apps->submission_id [$fileds->company_name]====> $fileds->industry_type  ($ans)";
			}
			echo "</table>";
		}
		// echo "<pre>";print_r($applications);die;
	}



	private function getNamFromVAlue($id){
		$sql="SELECT Ans_Text from answer_master where Ans_ID=$id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$Ans_Text=$command->queryRow();
			return $Ans_Text['Ans_Text'];
	}
	public function actionGetIndustrType(){
		$applications=ApplicationSubmission::model()->findAll();
		foreach ($applications as $key => $apps) {
			$fileds=json_decode($apps->field_value);
			echo "<table>";
			if(isset($fileds->industry_type) && !empty($fileds->industry_type)){
				$ans=$this->getNamFromVAlue($fileds->industry_type);
				echo "<tr>";
				echo"<td>$apps->submission_id</td>";
				echo"<td>[$fileds->company_name]</td>";
				echo"<td>$fileds->industry_type</td>";
				echo"<td>($ans)</td>";
				echo "</tr>";
				//echo "<br> Industry type for caf $apps->submission_id [$fileds->company_name]====> $fileds->industry_type  ($ans)";
			}
			echo "</table>";
		}
		// echo "<pre>";print_r($applications);die;
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
   private function isRoleExternal($user_id){
		$roleName=RolesExt::getUserRoleViaId($user_id);
		if(!$roleName){
			return true;
		}
	// echo "<pre>";print_r($roleName);die;
		if($roleName['is_external']=='Y')
			return true;
		return false;
	}
	/*
	* this function is used to generate the token
	*/
	private function generateToken($uid,$role_id,$policy_id){
		$token=md5($uid."_".time()."-".rand(1,999999));
		$token_created_on=date( 'Y-m-d H:i:s');
		//callback_url	callback_failure_url	callback_success_url
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_id=:user_id
								AND role_id=:role_id';
								/*AND callback_url=:CALL_BACK_URL'; */
		$criteria->params = array(':user_id'=>$uid,
									':role_id'=>$role_id);
								  /*':CALL_BACK_URL'=>$CALL_BACK_URL);*/
		$ActiveTokens=UserActiveTokens::model()->findAll($criteria);
		foreach ($ActiveTokens as $AT) {
			$AT=$AT->attributes;
			$token_id=$AT['token_id'];
			
			$_ActiveTokens=UserActiveTokens::model()->findByPk($token_id); // assuming there is a post whose ID is 10
			$_ActiveTokens->delete();
		}
		$bo_active_tokens=new UserActiveTokens;
		$bo_active_tokens->user_id=$uid;
		$bo_active_tokens->role_id=$role_id;
		$bo_active_tokens->token_created_on=$token_created_on;
		$bo_active_tokens->token_accessed_on=$token_created_on;
		$bo_active_tokens->token=$token;				
		$bo_active_tokens->module_id=$policy_id;				
		$bo_active_tokens->save();
		// echo "<pre>";print_r($bo_active_tokens->geterrors());die;
		return $token;

	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{ die("here");
		$model=new LoginForm;
		@session_start();
		if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
			$this->redirect(Yii::app()->createUrl("/admin"));
		}

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{		
				 $criteria = new CDbCriteria();
				 if(empty($_POST['LoginForm']['password'])){
				 	Yii::app()->user->setFlash('Error', "Error:Please Fill Password");
				 	$this->redirect('login');
				 	die;
				 }
				 if(empty($_POST['LoginForm']['username'])){
				 	Yii::app()->user->setFlash('Error', "Error:Please Fill User Name");
				 	$this->redirect('login');
				 	die;
				 }
				 if(empty($_POST['LoginForm']['password']) && empty($_POST['LoginForm']['username'])){
				 	Yii::app()->user->setFlash('Error', "Error:Please Fill User Name & Password");
				 	$this->redirect('login');
				 	die;
				 }
				 $pass=hash_hmac('sha1', $_POST['LoginForm']['password'], PASSWORD_SECRET_KEY);
           		 $criteria->condition = 'email=:uname';
                 $criteria->params = array(':uname'=>$_POST['LoginForm']['username']);
        		 $model_user = User::model()->find($criteria);
				if(empty($model_user)){
					 Yii::app()->user->setFlash('Error', "Error: Invalid User Name");
					 $this->redirect('login');
					 die;
				}
				else{
					$criteria->select='email,uid,dept_id,full_name';
					$criteria->condition = 'email=:uname AND password=:pass';
                	$criteria->params = array(':uname'=>$_POST['LoginForm']['username'],':pass'=>$pass);
        		 	$model_pass = User::model()->find($criteria);
        		 	if(empty($model_pass)){
        		 		Yii::app()->user->setFlash('Error', "Error: Invalid Password");
        		 		$this->redirect('login');
        		 		exit;
        		 	}
        		 	else{
        		 		if($this->isRoleExternal($model_pass->uid)){
        		 			// echo "<pre>";print_r($_POST);die;
        		 			$roleIDName=RolesExt::getUserModuleRole($model_pass->uid,$_POST['LoginForm']['policy']);
        		 			if(!$roleIDName){
        		 				Yii::app()->user->setFlash('Error', "Error: User not authorized to access.");
        		 				$this->redirect('login');
        		 				exit;
        		 			}
        		 			// echo "<pre>";print_r($roleIDName);die;
        		 			$token=$this->generateToken($model_pass->uid,$roleIDName['role_id'],$_POST['LoginForm']['policy']);
        		 			// echo $token;die("her");

        		 			// echo "Your Token is ==========>  ". $token;die;
        		 			$this->renderPartial("redirect",array("model"=>$model_pass,"token"=>$token));
        		 			exit;
        		 		}
        		 		$_SESSION['department_login']=true;
        		 		$_SESSION['uid']=$model_pass->uid;
        		 		$_SESSION['uname']=$model_pass->full_name;
        		 		$_SESSION['email']=$model_pass->email;
        		 		$_SESSION['dept_id']=$model_pass->dept_id;
                                        if($_SESSION['uid']=='708'){
                                            $_SESSION['role_id']=76;
                                        }
                                        print_r($_SESSION);die; 
        		 		$this->redirect(Yii::app()->createUrl("/admin"));
        		 	}
				}			
				
			}
		
		// display the login form
			// die("hdj");
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		
		@session_start();
		if(isset($_SESSION['RESPONSE'])){
			$token=$_SESSION['RESPONSE']['token'];
			$url=TOKE_API_BASEURL.'/apiv1/logouttoken/token/'.$token;
			$response=DefaultUtility::postViaCurl($url);
		}
		session_destroy();
		Yii::app()->user->logout();
		$this->redirect(FRONT_BASEURL);
	}
}