<?php

class MomNewController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	private function connection(){
		return Yii::app()->db;
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{	
	
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array("FormFields",'Mapping','index','view','create','ViewDetails','PrintMom','viewAttendees','saveAttendeesOtherDetails','SaveAttendeesDetails','agenda','downloadmom','DownloadpdfMom','DownloadpdfMomAgenda','draft'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionFormFields()
	{
		
		$connection=Yii::app()->db; 
		$sql = "select * from bo_infowizard_formvariable_master ";
		$command=$connection->createCommand($sql);
		$old_data=$command->queryAll();
		
		echo "<table border='0'>" ;
		foreach($old_data as $key => $data){
			
			$formvar_id = $data['formvar_id'] ;
			
			$sql1 = "select count(service_id) as count, service_id from bo_information_wizard_form_builder where form_field_id=$formvar_id  group by service_id";
			$command1=$connection->createCommand($sql1);
			$old_data1=$command1->queryAll();
			
			
			echo "<tr style='border-bottom:1px solid #000;;'><td width='30%'>",$data['name'],"</td><td  width='20%'>",$data['formchk_id'],"</td><td  width='30%'>&nbsp;</td></td><td  width='2	0%'>&nbsp;</td></tr>" ;
		
			if(count($old_data1)){
				foreach($old_data1 as $key1=>$service ){
					
					$service_id = $service['service_id'];
					
					$parameter = explode(".",$service_id) ;
					$service_id = $parameter[0];
					$service_type = $parameter[1];
					
					
					$sqlService = "select * from bo_information_wizard_service_parameters where service_id='$service_id'  and servicetype_additionalsubservice='$service_type' and is_active='Y'";
					$commandService=$connection->createCommand($sqlService);
					$ServiceName=$commandService->queryAll();
					
					if(count($ServiceName)){
						$old_data1[$key1]['core_service_name'] = $ServiceName[0]['core_service_name'] ;
						
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>",$old_data1[$key1]['core_service_name'],"</td></td><td>",$old_data1[$key1]['count'],"</td></tr>" ;
						//echo $old_data1[$key1]['core_service_name'],"&nbsp;&nbsp;",$old_data1[$key1]['count'] ;
						
					}else{
						unset($old_data1[$key1]);
					}
					
				}
				
			}
			
			
		}
		echo "</table" ;
		

		die("I am fine...") ;
	}		
	
	public function actionMapping()
	{
		
		$old_table  = 'bo_application_submission_mapping';
		$new_table  = 'bo_new_application_submission_mapping';
		$mapping_table  = 'bo_caf_field_mappings';
		$mapping_table_new  = 'bo_new_application_submission_mapping';		
		
		$connection=Yii::app()->db; 
		$sql = "select * from $mapping_table";
		$command=$connection->createCommand($sql);
		$mapping_fields=$command->queryAll();
		
		//echo "<pre>" ; print_r($mapping_fields) ;
		
		$sql = "select * from $old_table where application_id=1";
		$command=$connection->createCommand($sql);
		$old_data=$command->queryAll();
		
		
		foreach($old_data as $key => $data){
			
			$field_value_old = json_decode($data['field_value']) ;
						
			$field_value_new = $this->__convertFields($field_value_old,$mapping_fields) ;
			
			$field_value = json_encode($field_value_new);
			$unit_name = $field_value_old->company_name ;
			
			$submission_id = $data['submission_id'] ;
			$application_id = $data['application_id'] ;
			
			$user_id = $data['user_id'] ;
			$dept_id = $data['dept_id'] ;
			
			$application_status = $data['application_status'] ;
			$application_created_date = $data['application_created_date'] ;
			$application_updated_date_time = $data['application_updated_date_time'] ;
			$ip_address = $data['ip_address'] ;
			$user_agent = $data['user_agent'] ;
			$landrigion_id = $data['landrigion_id'] ;			
			
			$service_id = '577.0' ;
			$form_id = '1' ;
			
			$submission_id_base = base64_encode($submission_id) ;
			
			$host = $_SERVER['HTTP_HOST']; 
			$certificate_path = "https://" ; 
			if($host=='169.38.99.248'){
				$certificate_path = "http://" ; 
			}
			$certificate_path .= $host ; 
			$certificate_path .= "/backoffice/admin/applicationView/viewForwardApplication/application_sub_id/$submission_id_base" ; 
						
			
			$model = new ApplicationSubmissionMapping();
			$model->submission_id = $submission_id;
			$model->application_id = $application_id;
			$model->service_id = $service_id;
			$model->user_id = $user_id;
			$model->dept_id = $dept_id;
			$model->form_id = $form_id;
			$model->field_value = $field_value;
			$model->unit_name = $unit_name;
			$model->certificate_path = $certificate_path;
			$model->application_status = $application_status;
			$model->application_created_date = $application_created_date;
			$model->application_updated_date_time = $application_updated_date_time;
			$model->ip_address = $ip_address;
			$model->user_agent = $user_agent;
			$model->landrigion_id = $landrigion_id;
			
			$model->save() ;
			
		}
				
		
		die('here...') ;
		
		
	}
	
	public function __convertFields($field_value_old,$mapping_fields){
		
		$field_value_new =[] ; 
		
		foreach($mapping_fields as $new_key => $new_value){
				
			$new_field_name = $new_value['new_field_name'] ;
			$old_field_name = $new_value['old_field_name'] ; 
			
			if(isset($field_value_old->$old_field_name)){
				$value = $field_value_old->$old_field_name ; 												
				$field_value_new[$new_field_name] = $value ;
			}
			
		}
		
		return $field_value_new; 
		
	}
	
	
	public function actionCreate()
	{
		$model=new MomNew;
		$modelUsers=new MomUsers;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['MomNew']))
		{
			//echo "<pre>" ; print_r($_POST) ;die ;
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$ip = $_SERVER['REMOTE_ADDR'];				
			
			//$caf_id_text = $_POST['MomNew']['caf_id'];
			$mom_date = date("Y-m-d",strtotime($_POST['MomNew']['mom_date']));
			//$caf_id_text_arr = explode("~",$caf_id_text);
			//$model->caf_id 			= $caf_id_text_arr[0];
			//$model->company_name 	= $caf_id_text_arr[1];
			$model->mom_description = $_POST['mom_description'];
			$model->mom_location = $_POST['single_window_location'];
			$model->mom_hour		= $_POST['single_window_meeting_hour'];
			$model->mom_minute        = $_POST['single_window_meeting_time'];
			
			$model->mom_date 		= $mom_date;
			$model->created_time 	= date('Y-m-d H:i:s');
			$model->ip_address 	= $ip;
			$model->user_agent 	= $ua;
			 
			$role_id = $_SESSION['role_id'] ;
			$uid = $_SESSION['uid'] ;
			 
			$model->role_id 	= $role_id;
			$model->user_id 	= $uid;
			
			if($model->save())
			{
				// Save Users
				$users = isset($_POST['attendees'])?$_POST['attendees']:[] ;
				$mom_id = $model->mom_id ;
				foreach($users as $user){					
					$modelUsers=new MomUsers;
					$modelUsers->mom_id = $mom_id;
					$modelUsers->user_id = $user;					
					$modelUsers->status = 1;					
					$modelUsers->save() ;					
				}
				
				// Save caf id and agenda
				$cafs = isset($_POST['cafid'])?$_POST['cafid']:[] ;
				
				foreach($cafs as $caf){					
					$modelCaf=new MomCafs;
					$modelCaf->mom_id = $mom_id;
					$modelCaf->caf_id = $caf;					
					$modelCaf->agenda = $_POST['agenda_'.$caf];					
					$modelCaf->save() ;					
				}

				//echo "<pre>" ; print_r($_POST) ;die ;

				$this->redirect(array('index'));
			}
				
		}

		$userModel=new User;
		
		$role_id = $_SESSION['role_id'] ;
		if($role_id==7){
			$role_id = "7,3,33,74";
		}else if($role_id==4){
			$role_id = "4,5,34,72,73";
		}
		
		$uid = $_SESSION['uid'] ;
		
		$district_id = MomExt::getDisttId($uid) ; 
		
		//echo '<pre>' ; print_r($district_id) ; die ;
		
		//$attendees = $userModel::model()->findAll(array("condition"=>"disctrict_id=$district_id",'order' => 'uid DESC'));
                
		$attendees = $userModel::model()
					->with('userRoleMappings')
					->findAll(array("condition"=>"disctrict_id=$district_id and role_id in ($role_id) and is_active=1 and is_for_testing='N'",'order' => ' FIELD(role_id, 74, 73, 72,5,4,3,33,7)'));		
			
		
        /*$connection=Yii::app()->db; 
                $sql = "select * from bo_user left join bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id = $role_id and disctrict_id =$district_id";
		$command=$connection->createCommand($sql);
		$attendees=$command->queryAll();
		*/
		

		// FInd Holidays

		$sqlQuery = " select * from `bo_holiday_master` where holidy_id !='WD' ";
		$command_h_q = $this->connection()->createCommand($sqlQuery);
		$result = $command_h_q->queryAll();

		$holiday = [] ;
		foreach($result as $key => $value){
			$date = date("j-n-Y",strtotime($value['date_of_holiday'])) ;
			$holiday[] = "'".$date."'" ; 
		}
		//$result = $this->connection()->createCommand($sqlQuery)->execute();
		$holidays = implode(",",$holiday) ;
		//echo "<pre>" ; print_r($holidays) ; die ;

		$this->render('create',array(
			'model'=>$model,
			"action"=>'add',
			"modelUsers"=>$modelUsers,
			"attendees"=>$attendees,
			"holidays"=>$holidays
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mom']))
		{
			$model->attributes=$_POST['Mom'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->mom_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new MomNew;

		$role_id = $_SESSION['role_id'] ;
		$user_id = $_SESSION['uid'] ;
			 
		
		$datas = $model::model()->findAll(array("condition"=>"user_id=$user_id",'order' => 'mom_id DESC'));

		/*foreach($datas as $date){

			foreach($date->MomUsers as $user){
				echo '<pre>';print_r($user->user->full_name	);
			}

			echo '<pre>';print_r($date->MomUsers	); die;
		}*/

		//echo '<pre>';print_r($datas); die;

		$this->render('index',array(
			'datas'=>$datas,
		));
	}
	
	public function actionAgenda()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$mom_id = $_POST['mom_id'] ;
			$attendees = isset($_POST['attendees']) ? $_POST['attendees'] : [] ;
			
			
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$ip = $_SERVER['REMOTE_ADDR'];				
			
			$attend = [] ; 
			foreach($attendees as $key => $attendee){
				foreach($attendee as $attendee2 => $key2 ){
					$attend[$attendee2] = $key2 ; 
				}			
			}
						
			$descriptions = isset($_POST['description']) ? $_POST['description'] :[] ;
			foreach($descriptions as $caf_id =>$users){
				
				foreach($users as $user_id =>$comment){					
					
					if($comment=='') continue ;
					
					
					$status  = isset($attend[$caf_id])?$attend[$caf_id]:1; 
					
					$MomUserComment = new MomUserComment ; 

					$MomUserComment->mom_id = $mom_id;
					$MomUserComment->caf_id = $caf_id;
					$MomUserComment->status = $status;
					$MomUserComment->user_id = $user_id;
					$MomUserComment->comment = $comment;

					$MomUserComment->created_time 	= date('Y-m-d H:i:s');
					$MomUserComment->ip_address 	= $ip;
					$MomUserComment->user_agent 	= $ua;					

					$MomUserComment->save() ; 
				}				
			}
			//}		

			$momnew = MomNew::model()->findByPk($mom_id);
			$momnew->status = 1 ;
			$momnew->general_description = $_POST['general_description'] ;
			$momnew->save() ;

			$this->redirect(array('index'));	
						
		}

		$id = base64_decode($_GET['id']); 

		$model = new MomCafs;

		//$datas = $model::model()->findAll(array('order' => 'mom_id DESC'));
		$datas = $model::model()->findAll(array("condition"=>"mom_id=$id"));
		

		$momcaf = new MomCafs;
		$momcaf = $momcaf::model()->findAll(array("condition"=>"mom_id=$id"));

		$cafData = [] ; 
		foreach($momcaf as $caf){
			$cafData[$caf['caf_id']] = $caf ; 
		}
		//echo "<pre>" ; print_r($cafData);die ;	
		
		$modelMom = new MomUsers;
		$users = $modelMom::model()->findAll(array("condition"=>"mom_id=$id",'order' => 'mom_id DESC'));
		
		$this->render('agenda',array(
			'datas'=>$datas,
			'users'=>$users,
			'cafData'=>$cafData,
			'mom_id'=>$id
		));
	}

	public function actionViewDetails(){

	
		$mom_id = base64_decode($_GET['id']);	
		
		
		$model = new MomUserComment;
		$datas = $model::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$data = [] ;	
		
		foreach($datas as $value){
			$caf_id = $value->caf->submission_id ; 						
			$data[$caf_id][]  = $value ;			
						
		}		
		
		//echo "<pre>" ; print_r($data); die ;
		
		$momnew = new MomNew;
		$momdata = $momnew::model()->findAll(array("condition"=>"mom_id=$mom_id"));
		
		//echo "<pre>" ; print_r($momdata); die ;
		
		$momcaf = new MomCafs;
		$momcaf = $momcaf::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$cafData = [] ; 
		foreach($momcaf as $caf){
			$cafData[$caf['caf_id']] = $caf ; 
		}
		
		//echo "<pre>" ; print_r($cafData); die ; 
		
		$role_id = $_SESSION['role_id'] ;
		$uid = $_SESSION['uid'] ;
				
		$user_detial = new User;
		$usersDetails = $user_detial::model()->findAll(array("condition"=>"uid=$uid"));
		
		$district_id  = $usersDetails[0]->disctrict->district_id;	
			
		$sql = "SELECT x.uid, x.office_no, x.fax, x.full_name,x.email,x.mobile, x.department_name,y.distric_name from (
				select  c.uid,c.full_name,c.email,c.mobile, d.department_name, c.disctrict_id, c.fax, c.office_no from(
				select a.department_id,a.role_id,b.uid,b.full_name,b.email,b.mobile,b.disctrict_id,b.fax,b.office_no from bo_user_role_mapping as a 
				inner join bo_user as b on b.uid=a.user_id where a.role_id='33' AND a.is_mapping_active='Y' ) as c
				inner join bo_departments as d on c.department_id=d.dept_id) as x inner join  bo_district as y on x.disctrict_id=y.district_id
				where y.district_id=$district_id
				order by y.district_id,x.department_name";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryAll(); 
		
		
		//echo "<pre>" ; print_r($res); die ; 
		
		$momuser = new MomUsers;
		$userData = $momuser::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		
		$users = [] ; 
		foreach($userData as $user){
			$users[$user['id']] = $user ; 
		}
		//echo "<pre>" ; print_r($users[98]->user); die ; 
		
		
		$this->render('viewDetails',array(
						'datas'=>$data,'momdata' => $momdata,'mom_id'=>$mom_id,'cafData'=>$cafData,
						'users'=>$users,'user'=>$res , "type"=>'mom' 
					));

	}
	
	public function actionDownloadmom()
	{
		$mom_id = base64_decode($_GET['id']);	
		
		$model = new MomUserComment;
		$datas = $model::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$data = [] ;	
		
		foreach($datas as $value){
			$caf_id = $value->caf->submission_id ; 						
			$data[$caf_id][]  = $value ;			
						
		}		
		
		$momnew = new MomNew;
		$momdata = $momnew::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$momcaf = new MomCafs;
		$momcaf = $momcaf::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$cafData = [] ; 
		foreach($momcaf as $caf){
			$cafData[$caf['caf_id']] = $caf ; 
		}
		
		$momuser = new MomUsers;
		$userData = $momuser::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		
		$users = [] ; 
		foreach($userData as $user){
			$users[$user['id']] = $user ; 
		}
		$content = $this->renderPartial('viewDetailDownload',array(
						'datas'=>$data,
						'momdata' => $momdata,
						'mom_id'=>$mom_id,
						'cafData'=>$cafData,
						'users'=>$users,
					),true);
			
        $name = "UK-MOM" . time() . ".pdf";		
        Utility::generatePdfApp($content, $name);
        die();

	}


	public function actionDownloadpdfMomAgenda()
	{
		ob_clean();
		
		$mom_id = base64_decode($_GET['id']);	
		
		$model = new MomUserComment;
		$datas = $model::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$data = [] ;	
		
		foreach($datas as $value){
			$caf_id = $value->caf->submission_id ; 						
			$data[$caf_id][]  = $value ;			
						
		}		
		
		$momnew = new MomNew;
		$momdata = $momnew::model()->findAll(array("condition"=>"mom_id=$mom_id"));
		
		//echo "<pre>" ; print_r($momdata); die ;
		
		$momcaf = new MomCafs;
		$momcaf = $momcaf::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$cafData = [] ; 
		foreach($momcaf as $caf){
			$cafData[$caf['caf_id']] = $caf ; 
		}
		
		//echo "<pre>" ; print_r($cafData); die ; 
		
		$role_id = $_SESSION['role_id'] ;
		$uid = $_SESSION['uid'] ;
				
		$user_detial = new User;
		$usersDetails = $user_detial::model()->findAll(array("condition"=>"uid=$uid"));
		
		$district_id  = $usersDetails[0]->disctrict->district_id;	
			
		$sql = "SELECT x.uid, x.office_no, x.fax, x.full_name,x.email,x.mobile, x.department_name,y.distric_name from (
				select  c.uid,c.full_name,c.email,c.mobile, d.department_name, c.disctrict_id, c.fax, c.office_no from(
				select a.department_id,a.role_id,b.uid,b.full_name,b.email,b.mobile,b.disctrict_id,b.fax,b.office_no from bo_user_role_mapping as a 
				inner join bo_user as b on b.uid=a.user_id where a.role_id='33' AND a.is_mapping_active='Y' ) as c
				inner join bo_departments as d on c.department_id=d.dept_id) as x inner join  bo_district as y on x.disctrict_id=y.district_id
				where y.district_id=$district_id
				order by y.district_id,x.department_name";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryAll(); 
		
		
		//echo "<pre>" ; print_r($res); die ; 
		
		$momuser = new MomUsers;
		$userData = $momuser::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		
		$users = [] ; 
		foreach($userData as $user){
			$users[$user['id']] = $user ; 
		}
		
		
		$content = $this->renderPartial('DownloadpdfMomAgenda',array(
						'datas'=>$data,'momdata' => $momdata,'mom_id'=>$mom_id,'cafData'=>$cafData,
						'users'=>$users,'user'=>$res 
					),true);		
		
		

		ob_end_clean();
        $name = "UK-MOM" . time() . ".pdf";		
        
		//Utility::tryhind($content);
        
		//Utility::generateHindiPdfApp($content, $name);
		
		MomMpdfUtility::generatePdfAppHindi($content, $name);
		
		ob_clean();
        die();

	}


	public function actionDownloadpdfMom()
	{
		ob_clean();
		
		$mom_id = base64_decode($_GET['id']);	
		$type = $_GET['type'];	
		
		$model = new MomUserComment;
		$datas = $model::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$data = [] ;	
		
		foreach($datas as $value){
			$caf_id = $value->caf->submission_id ; 						
			$data[$caf_id][]  = $value ;			
						
		}		
		
		//echo "<pre>" ; print_r($data); die ;
		
		$momnew = new MomNew;
		$momdata = $momnew::model()->findAll(array("condition"=>"mom_id=$mom_id"));
		
		//echo "<pre>" ; print_r($momdata); die ;
		
		$momcaf = new MomCafs;
		$momcaf = $momcaf::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		$cafData = [] ; 
		foreach($momcaf as $caf){
			$cafData[$caf['caf_id']] = $caf ; 
		}
		
		//echo "<pre>" ; print_r($cafData); die ; 
		
		$role_id = $_SESSION['role_id'] ;
		$uid = $_SESSION['uid'] ;
				
		$user_detial = new User;
		$usersDetails = $user_detial::model()->findAll(array("condition"=>"uid=$uid"));
		
		$district_id  = $usersDetails[0]->disctrict->district_id;	
			
		$sql = "SELECT x.uid, x.office_no, x.fax, x.full_name,x.email,x.mobile, x.department_name,y.distric_name from (
				select  c.uid,c.full_name,c.email,c.mobile, d.department_name, c.disctrict_id, c.fax, c.office_no from(
				select a.department_id,a.role_id,b.uid,b.full_name,b.email,b.mobile,b.disctrict_id,b.fax,b.office_no from bo_user_role_mapping as a 
				inner join bo_user as b on b.uid=a.user_id where a.role_id='33' AND a.is_mapping_active='Y' ) as c
				inner join bo_departments as d on c.department_id=d.dept_id) as x inner join  bo_district as y on x.disctrict_id=y.district_id
				where y.district_id=$district_id
				order by y.district_id,x.department_name";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryAll(); 
		
		
		//echo "<pre>" ; print_r($res); die ; 
		
		$momuser = new MomUsers;
		$userData = $momuser::model()->findAll(array("condition"=>"mom_id=$mom_id"));

		//echo $mom_id ; 
		$users = [] ; 
		foreach($userData as $user){
			$users[$user['id']] = $user ; 
		}
		//echo "<pre>" ; print_r($users); die ; 
		
		$content = $this->renderPartial('DownloadpdfMom',array(
						'datas'=>$data,'momdata' => $momdata,'mom_id'=>$mom_id,'cafData'=>$cafData,
						'users'=>$users,'user'=>$res, "type"=>$type 
					),true);		
		
		

		ob_end_clean();
        $name = "UK-MOM" . time() . ".pdf";		
        
		//Utility::tryhind($content);
        
		//Utility::generateHindiPdfApp($content, $name);
		
		MomMpdfUtility::generatePdfAppHindi($content, $name);
		
		ob_clean();
        die();

	}
	
	
	public function actionViewAttendees(){
		
		$id = base64_decode($_GET['id']); 

		$model = new MomNew;

		$datas = $model::model()->findAll(array("condition"=>"mom_id=$id",'order' => 'mom_id DESC'));
		
		//echo '<pre>';print_r($datas[0]->MomUsers[0]->user->dept); die;
		$this->render('viewAttendees',array(
			'datas'=>$datas,
			'id' => $id,
		));
	}

	public function actionSaveAttendeesDetails()
	{
		$pk = $_POST['pk'] ;
		$value = $_POST['value'] ;
		
		$model=MomUsers::model()->findByPk($pk);
		
		$model->status = $value ;

		$model->save() ; 
		
		echo true ; die ;
		
	}
	public function actionSaveAttendeesOtherDetails()
	{
		
		//echo '<pre>';print_r($_POST); die;
		
		$user_id = $_POST['user_id'] ;
		$mom_id = $_POST['mom_id'] ;
		
		
		
		$response = [] ;	
		
		$records = MomUserOthers::model()->findAll(array("condition"=>"mom_id=$mom_id and mom_user_id=$user_id"));;
		
		$model=MomUserOthers::model()->deleteAll(array("condition"=>"mom_id=$mom_id and mom_user_id=$user_id"));
		
		$name = isset($_POST['name'] )?$_POST['name']:[];
		$designation = isset($_POST['designation'] )?$_POST['designation']:[];
		$phonenumber = isset($_POST['phonenumber'] )?$_POST['phonenumber']:[];
		$email = isset($_POST['email'] )?$_POST['email']:[];
		
		
		if(count($name)){
			foreach($name as $key => $value){
				
				if($value =='' || $designation[$key]=='' ){
					continue;
				}
				$model = new MomUserOthers;
				$model->mom_user_id = $user_id ;
				$model->mom_id = $mom_id ;
				$model->name = $value ;
				$model->designation = $designation[$key] ;
				$model->phonenumber = $phonenumber[$key] ;
				$model->email = $email[$key] ;				
				$model->save() ; 
				
				$response[] = [
					'name'=>$name[$key],'designation'=>$designation[$key],'phonenumber'=>$phonenumber[$key],'email'=>$email[$key],'user_id'=>$user_id
				];
				
			}
		}	
			
		echo json_encode($response);die ;	
			
		/*$name = '' ; 
		$designation = '' ; 
		$phonenumber = '' ; 
		$email = '' ; 
		$status = $_POST['attendees_id'] ;
		if($status==2){
			$name = $_POST['name'] ;
			$designation = $_POST['designation'] ;
			$phonenumber = $_POST['phonenumber'] ;
			$email = $_POST['email'] ;
		}
		
		$model=MomUsers::model()->findByPk($pk);
		
		//$model = MomUsers::model()->findAll(array("condition"=>"mom_id=$mom_id and user_id=$user_id",'order' => 'mom_id DESC'));;
		
		if($model){
			
		}else{
			$model = new MomUsers;
		}	
		
		$model->name = $name ;
		$model->designation = $designation ;
		$model->phonenumber = $phonenumber ;
		$model->email = $email ;
		$model->status = $status ;

		$model->save() ; 
		echo true ;die();
		return true;*/
		
	}


	public function actionPrintMom()
	{
		
		$id = base64_decode($_GET['id']);
		$model = new Mom;
		$datas = $model::model()->findAll(array("condition"=>"caf_id=$id",'order' => 'mom_id DESC'));
		$content=$this->renderPartial('PrintMom',array('datas'=>$datas,'id' => $id),true);
		$name="mom.pdf";
		TCPDFView::generatePDFWithHindiFont(utf8_encode($content),$name);
		//Utility::generatePdfApp($content,$name);
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mom('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mom']))
			$model->attributes=$_GET['Mom'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mom the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mom::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mom $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mom-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




	public function actionDraft()
	{
		$model=new MomNew;
		$modelUsers=new MomUsers;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['MomNew']))
		{
			//echo "<pre>" ; print_r($_POST) ;die ;
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$ip = $_SERVER['REMOTE_ADDR'];				
			
			//$caf_id_text = $_POST['MomNew']['caf_id'];
			$mom_date = date("Y-m-d",strtotime($_POST['MomNew']['mom_date']));
			//$caf_id_text_arr = explode("~",$caf_id_text);
			//$model->caf_id 			= $caf_id_text_arr[0];
			//$model->company_name 	= $caf_id_text_arr[1];
			$model->mom_description = $_POST['mom_description'];
			$model->mom_location = $_POST['single_window_location'];
			$model->mom_hour		= $_POST['single_window_meeting_hour'];
			$model->mom_minute        = $_POST['single_window_meeting_time'];
			
			$model->mom_date 		= $mom_date;
			$model->created_time 	= date('Y-m-d H:i:s');
			$model->ip_address 	= $ip;
			$model->user_agent 	= $ua;
			 
			$role_id = $_SESSION['role_id'] ;
			$uid = $_SESSION['uid'] ;
			 
			$model->role_id 	= $role_id;
			$model->user_id 	= $uid;
			
			if($model->save())
			{
				// Save Users
				$users = isset($_POST['attendees'])?$_POST['attendees']:[] ;
				$mom_id = $model->mom_id ;
				foreach($users as $user){					
					$modelUsers=new MomUsers;
					$modelUsers->mom_id = $mom_id;
					$modelUsers->user_id = $user;					
					$modelUsers->status = 1;					
					$modelUsers->save() ;					
				}
				
				// Save caf id and agenda
				$cafs = isset($_POST['cafid'])?$_POST['cafid']:[] ;
				
				foreach($cafs as $caf){					
					$modelCaf=new MomCafs;
					$modelCaf->mom_id = $mom_id;
					$modelCaf->caf_id = $caf;					
					$modelCaf->agenda = $_POST['agenda_'.$caf];					
					$modelCaf->save() ;					
				}

				//echo "<pre>" ; print_r($_POST) ;die ;

				$this->redirect(array('index'));
			}
				
		}

		$userModel=new User;
		
		$role_id = $_SESSION['role_id'] ;
		if($role_id==7){
			$role_id = "7,3,33,74";
		}else if($role_id==4){
			$role_id = "4,5,34,72,73";
		}
		
		$uid = $_SESSION['uid'] ;
		
		$district_id = MomExt::getDisttId($uid) ; 
		
		//echo '<pre>' ; print_r($district_id) ; die ;
		
		//$attendees = $userModel::model()->findAll(array("condition"=>"disctrict_id=$district_id",'order' => 'uid DESC'));
                
		$attendees = $userModel::model()
					->with('userRoleMappings')
					->findAll(array("condition"=>"disctrict_id=$district_id and role_id in ($role_id) and is_active=1 and is_for_testing='N'",'order' => ' FIELD(role_id, 74, 73, 72,5,4,3,33,7)'));		
			
		
        /*$connection=Yii::app()->db; 
                $sql = "select * from bo_user left join bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id = $role_id and disctrict_id =$district_id";
		$command=$connection->createCommand($sql);
		$attendees=$command->queryAll();
		*/
		

		// FInd Holidays

		$sqlQuery = " select * from `bo_holiday_master` where holidy_id !='WD' ";
		$command_h_q = $this->connection()->createCommand($sqlQuery);
		$result = $command_h_q->queryAll();

		$holiday = [] ;
		foreach($result as $key => $value){
			$date = date("j-n-Y",strtotime($value['date_of_holiday'])) ;
			$holiday[] = "'".$date."'" ; 
		}
		//$result = $this->connection()->createCommand($sqlQuery)->execute();
		$holidays = implode(",",$holiday) ;
		//echo "<pre>" ; print_r($holidays) ; die ;

		$this->render('draft',array(
			'model'=>$model,
			"action"=>'add',
			"modelUsers"=>$modelUsers,
			"attendees"=>$attendees,
			"holidays"=>$holidays
		));
	}
}