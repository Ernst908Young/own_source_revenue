<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array('class'=>'CCaptchaAction','backColor'=>0xFFFFFF,),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array('class'=>'CViewAction',),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
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

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionVpd(){
		$records = NULL;
		if(isset($_POST['entity_type'])){
			$entity_type = $_POST['entity_type'];
			$company_name = $_POST['company_name'];
			$company_reg_no = $_POST['company_reg_no'];
			$cofo = $_POST['cofo'];
			if($cofo=='barbados'){
				$state_parish_sel = $_POST['state_parish_sel'];
				$state_parish_txt = NULL;
			}else{
				$state_parish_sel = NULL;
				$state_parish_txt = $_POST['state_parish_txt'];
			}

			switch ($entity_type) {
				case 'Company':
					$service_id_in = '(4.0, 5.0, 8.0)';
					break;
				case 'Society':
					$service_id_in = '(9.0)';
					break;
				case 'Charity':
					$service_id_in = '(6.0, 7.0)';
					break;
				case 'LLP':
					$service_id_in = '(10.0)';
					break;
				case 'Business Name Registration':
					$service_id_in = '(2.0)';
					break;
				default:
					$service_id_in = NULL;
					break;
			}

			if($service_id_in){
				if($cofo=='barbados'){
					if($entity_type=='Business Name Registration'){
						$country_con = $state_parish_con = '';
					}else{
						$country_con = 'AND country="barbados"';
						if($state_parish_sel){
							$state_parish_con = 'AND state_parish_id='.$state_parish_sel;
						}else{
							$state_parish_con = '';
						}
					}					
				}else{
					$country_con = 'AND country!="barbados"';
					if($state_parish_txt){
						$state_parish_con = 'AND state_parish LIKE "%'.$state_parish_txt.'%" ';
					}else{
						$state_parish_con = '';
					}
				}		

				if($company_name){
					$company_name_con = 'AND company_name LIKE "%'.$company_name.'%" ';
				}else{
					$company_name_con = '';
				}

				if($company_reg_no){
					$company_reg_no_con = 'AND reg_no='.$company_reg_no;
				}else{
					$company_reg_no_con = '';
				}


				$records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE service_id IN $service_id_in $country_con $company_name_con $state_parish_con $company_reg_no_con")->queryAll();
			}

			$records_search = true;
		}else{
			$entity_type = 'Company';
			$cofo = 'barbados';
			$company_name = $company_reg_no = $state_parish_sel = $state_parish_txt = NULL;
			$records_search = false;
		}

		
		$this->render('vpd/vpd',['entity_type'=>$entity_type,'company_name'=>$company_name,'company_reg_no'=>$company_reg_no,'cofo'=>$cofo,'state_parish_sel'=>$state_parish_sel,'state_parish_txt'=>$state_parish_txt,'records'=>$records,'records_search'=>$records_search]);
	}

	public function actionVpd1($service_id, $reg_no){
		$reg_no = base64_decode($reg_no);
		$service_id = base64_decode($service_id);
		$entity_records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no = '".$reg_no."' AND service_id='".$service_id."'")->queryRow();

		if(isset($_POST['service_category_sel']) && isset($_POST['year_sel'])){
			$service_category_sel = $_POST['service_category_sel'];
			$year_sel = $_POST['year_sel'];	

			switch ($_POST['service_category_sel']) {
				case '1':
					 $ser_con = "AND a.service_id='2.0'";
					break;
				case '2':
					 $ser_con = "AND a.service_id IN ('4.0','5.0','6.0','7.0','8.0','9.0','10.0')";
					break;
				case '3':
					 $ser_con = "AND a.service_id IN ('19.0','20.0','21.0','22.0','23.0','24.0','25.0','33.0')";
					break;
				case '4':
					 $ser_con = "AND a.service_id IN ('37.0','38.0')";
					break;
				case '5':
					 $ser_con = "AND a.service_id IN ('39.0','40.0','41.0','42.0','43.0','44.0')";
					break;
				case '6':
					 $ser_con = "AND a.service_id IN ('11.0','12.0','13.0','14.0','15.0','16.0','17.0','18.0','26.0','27.0','28.0','29.0','30.0','31.0','32.0','34.0','35.0','36.0')";
					break;
				default:
					$ser_con = "";
					break;
			}	


			if($_POST['service_category_sel']==1 || $_POST['service_category_sel']==2){
				$subID = $entity_records['srn_no'];
				$submissiondaterecord =  Yii::app()->db->createCommand("SELECT a.submission_id, a.service_id, a.application_updated_date_time, bosp.is_certificate, bosp.core_service_name
				  FROM bo_new_application_submission a
				  INNER JOIN bo_information_wizard_service_parameters bosp
				  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

				  where bosp.is_active='Y' AND a.submission_id = $subID and a.application_status='A' AND year(a.application_updated_date_time)=$year_sel $ser_con order BY a.application_updated_date_time ASC")->queryAll();
			}else{
				$submissiondaterecord =  Yii::app()->db->createCommand("SELECT a.submission_id, a.service_id, a.application_updated_date_time, bosp.is_certificate, bosp.core_service_name
				  FROM bo_new_application_submission a
				  INNER JOIN bo_information_wizard_service_parameters bosp
				  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

				  where bosp.is_active='Y' AND a.application_status='A' AND year(a.application_updated_date_time)=$year_sel  AND a.entity_name = '".$reg_no."' $ser_con
				   order BY a.application_updated_date_time ASC")->queryAll();
			}
			
			/*$submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A' AND year(created)=$year_sel $ser_con order BY id DESC")->queryRow();*/	
			$records_search = true;	
		}else{
			$records_search = false;
			$submissiondaterecord = $service_category_sel = $year_sel = NULL;
		}

		$this->render('vpd/vpd1',['service_id'=>$service_id,'reg_no'=>$reg_no,'year_sel'=>$year_sel,'service_category_sel'=>$service_category_sel,'entity_records'=>$entity_records,'submissiondaterecord'=>$submissiondaterecord,'records_search'=>$records_search]);

	}

	public function actionVpdaddtocart(){
		if(isset($_POST['srn']) && isset($_POST['sdoc'])){

				$token=md5(time()."-".rand(1,999999));	
				foreach ($_POST['srn'] as $k => $v) {
					if(isset($_POST['sdoc'][$k])){
						Yii::app()->db->createCommand("INSERT INTO temp_vpd_doclist (entity_reg_no, entity_service_id, srn_no, doc_name, vpd_token, created_on) VALUES ('".$_POST['reg_no'][$k]."', '".$_POST['ser_id'][$k]."', '".$v."', '".$_POST['sdoc'][$k]."', '".$token."', '".date('Y-m-d H:i:s')."')")->execute();
					}
				}

				setcookie("VPDTOKEN",$token, time()+3600, "/");
				//setcookie("vpd_token",$token, time()+24*3600, "/backoffice/investor/home/investorWalkthrough");
				
				return $this->redirect('/sso/account/signin');
			
			
		}
	}
}