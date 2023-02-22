<?php
class CallLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*	public function accessRules()
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
	public function actionList()
	{		
		$sql = "SELECT du_pis_call_log.*,
				timeline.name as timelinename,
				timeline2.name as timelinename2,
				bo_sub.application_status,
				bo_departments.department_name,
				bo_user.full_name				
				FROM du_pis_call_log 
				left join du_timeline_commencement_master as timeline on timeline.id = du_pis_call_log.timeline_for_commencement
				left join du_timeline_commencement_master as timeline2 on timeline2.id = du_pis_call_log.timeline_for_grounding 
				left join bo_application_submission as bo_sub on bo_sub.submission_id =  du_pis_call_log.caf_id
				left join bo_departments on bo_departments.dept_id = du_pis_call_log.forwarded_dept
				left join bo_user on bo_user.uid=du_pis_call_log.user_id
				WHERE pis_mou_detail_id =$_GET[id]";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $listData = $command->queryAll();
		
		$this->render('list',array(
			'listData'=>$listData,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
		
		$model = new CallLog;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$du_pis_detail_id = '';
		
		if(isset($_GET['id']))
		$du_pis_detail_id = $_GET['id'];

		
		$allData = array();
		$callLogData = array();
		$mainpismouData = array();
		
		
		$sql = "SELECT pis_mou_parent_id,project_detail FROM du_pis_mou_detail WHERE id ='$du_pis_detail_id'";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $parentData = $command->queryRow();
		
		$sql = "SELECT company_name, representative_name,id,phone_number,email_id,master_reference_no FROM du_pis_mou_upload WHERE id ='$parentData[pis_mou_parent_id]'";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $mainpismouData = $command->queryRow();
		
		$sql = "SELECT * FROM du_pis_call_log WHERE pis_mou_detail_id ='$du_pis_detail_id' order by id desc";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $callLogData = $command->queryRow();
	
		if(isset($callLogData) && !empty($callLogData))
		{	
			$LogData['id']  = $callLogData['id'];
			$LogData['representative_name']  = $callLogData['name_of_representative'];
			$LogData['phone_number']  = $callLogData['phone_number'];
			$LogData['email_id']  = $callLogData['email'];
			$LogData['calling_date']  = $callLogData['calling_date'];
			$LogData['able_to_connect']  = $callLogData['able_to_connect'];
			$model=$this->loadModel($LogData['id']);
			$callLogData = $LogData;
		}else{	
			$callLogData = $mainpismouData;
		}
		
		$allData = $this->getMrnData($mainpismouData['master_reference_no'],$_GET['id']);
		
		if(isset($allData) && !empty($allData))
		{
			$allData = $allData;
		}else{
			$allData = array();
		}
		
		if(isset($_POST['CallLog']))
		{	
			
			//print_r($_SESSION);

			//die;
			$model->attributes = $_POST['CallLog'];
			$model->calling_date = date("Y-m-d",strtotime($_POST['CallLog']['calling_date']));
			$model->email = $_POST['CallLog']['email'];
			$model->calling_summary = $_POST['CallLog']['calling_summary'];
			$model->salutation = $_POST['CallLog']['salutation'];
			$model->call_back_date_start = @$_POST['CallLog']['call_back_date_start'];
			$model->call_back_date_end = @$_POST['CallLog']['call_back_date_end'];
			$model->land_requirement = @$_POST['CallLog']['land_requirement'];
			$model->reason = @$_POST['CallLog']['reason'];
			
			if($_POST['CallLog']['land_requirement']=='Yes'){
			
				$model->area_requirement_given = @$_POST['CallLog']['area_requirement_given'];
				$model->area_requirement = @$_POST['CallLog']['area_requirement'];
				$model->siidcul_summary = @$_POST['CallLog']['siidcul_summary'];
				if(isset($_POST['CallLog']['area_requirement_district']))
				{
					if(count($_POST['CallLog']['area_requirement_district'])>1)
					{
						if(in_array('718',$_POST['CallLog']['area_requirement_district']))
						{
							$model->area_requirement_district = '718';
						}elseif(in_array('719',$_POST['CallLog']['area_requirement_district']))
						{
							$model->area_requirement_district = '719';
						}else{
							$model->area_requirement_district = implode(",",$_POST['CallLog']['area_requirement_district']);
						}
					}else{
						$model->area_requirement_district = @$_POST['CallLog']['area_requirement_district'][0];
					}
				}
				$model->area_unit = @$_POST['CallLog']['area_unit'];
				
				$sqaureConvert = $this->getLandUnitConversion($_POST['CallLog']['area_requirement'],$_POST['CallLog']['area_unit']);
				
				$model->area_in_square_meters = $sqaureConvert;
			}
			
			if($_POST['CallLog']['land_requirement']=='No'){
			
				$model->area_under_possession = @$_POST['CallLog']['area_under_possession'];
				$model->area_under_possession_unit = @$_POST['CallLog']['area_under_possession_unit'];
				$model->area_under_possession_address = @$_POST['CallLog']['area_under_possession_address'];
				$model->area_under_possession_tehsil = @$_POST['CallLog']['area_under_possession_tehsil'];
				if(isset($_POST['CallLog']['area_under_possession_district']))
				{
					if(count($_POST['CallLog']['area_under_possession_district'])>1)
					{
						if(in_array('718',$_POST['CallLog']['area_under_possession_district']))
						{
							$model->area_under_possession_district = '718';
						}elseif(in_array('719',$_POST['CallLog']['area_under_possession_district']))
						{
							$model->area_under_possession_district = '719';
						}else{
							$model->area_under_possession_district = implode(",",$_POST['CallLog']['area_under_possession_district']);
						}
					}else{
						$model->area_under_possession_district = @$_POST['CallLog']['area_under_possession_district'][0];
					}
				}				
				/* $sqaureConvert = $this->getLandUnitConversion($_POST['CallLog']['area_requirement'],$_POST['CallLog']['area_unit']);
				
				$model->area_in_square_meters = $sqaureConvert; */
			}
			
			if(isset($_POST['CallLog']['meeting_request_dept']))
			{			
				if(count($_POST['CallLog']['meeting_request_dept'])>1)
				{
					$model->meeting_request_dept = implode(",",$_POST['CallLog']['meeting_request_dept']);
				}else{
					$model->meeting_request_dept = @$_POST['CallLog']['meeting_request_dept'][0];
				}
			}	
			
			if(isset($_POST['CallLog']['grounding_district']))
			{			
				if(count($_POST['CallLog']['grounding_district'])>1)
				{
					$model->grounding_district = implode(",",$_POST['CallLog']['grounding_district']);
				}else{
					$model->grounding_district = @$_POST['CallLog']['grounding_district'][0];
				}
			}
			
			$model->grounding_address = @$_POST['CallLog']['grounding_address'];
			$model->meeting_with_dept = @$_POST['CallLog']['meeting_with_dept'];
			$model->metting_agenda = @$_POST['CallLog']['metting_agenda'];
			$model->meeting_request_start = @$_POST['CallLog']['meeting_request_start'];
			$model->meeting_request_end = @$_POST['CallLog']['meeting_request_end'];
			
			$model->timeline_for_commencement = @$_POST['CallLog']['timeline_for_commencement'];
			$model->financial_tie_up = @$_POST['CallLog']['financial_tie_up'];
			
			
			if(isset($_POST['CallLog']['financial_partner']))
			{			
				if(count($_POST['CallLog']['financial_partner'])>1)
				{
					$model->financial_partner = implode(",",$_POST['CallLog']['financial_partner']);
				}else{
					$model->financial_partner = @$_POST['CallLog']['financial_partner'][0];
				}
			}	
			
			if(isset($_POST['CallLog']['meeting_request_dept']))
			{
				if(count($_POST['CallLog']['meeting_request_dept'])>1)
				{
					$model->meeting_request_dept = implode(",",$_POST['CallLog']['meeting_request_dept']);
				}else{
					$model->meeting_request_dept = @$_POST['CallLog']['meeting_request_dept'][0];
				}
			}
			
			$model->pis_mou_detail_id = @$_POST['CallLog']['pis_mou_detail_id'];
			$model->created = date("Y-m-d H:i:s");
			$model->inprincipal_applied = @$_POST['CallLog']['inprincipal_applied'];
			$model->forwarded_dept = @$_POST['CallLog']['forwarded_dept'];
			$model->caf_id = @$_POST['CallLog']['caf_id'][0];
			$model->user_id = @$_SESSION['uid'];
			$model->role_id = @$_SESSION['role_id'];
			if(isset($_POST['CallLog']['caf_id'][0]) && !empty($_POST['CallLog']['caf_id'][0]))
			{
				if($_POST['CallLog']['caf_id'][0] < 5165)
				{		
					$sql = "SELECT application_status FROM bo_application_submission WHERE submission_id =".$_POST['CallLog']['caf_id'][0];
				}else{
					$sql = "SELECT application_status FROM bo_new_application_submission WHERE submission_id =".$_POST['CallLog']['caf_id'][0];	
				}		
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$cafstatus = $command->queryRow();
				$model->caf_status = $cafstatus['application_status'];
				
			}
			
			 
			
			$sql = "SELECT count(*) FROM du_pis_call_log WHERE pis_mou_detail_id =".$_POST['CallLog']['pis_mou_detail_id'];
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$callLogExist = $command->queryRow();
			if(isset($callLogExist) && $callLogExist >=1)
			{
				$callLogUpdate = Yii::app()->db->createCommand()->update("du_pis_call_log", array(
													"status" =>'N',
													"modified"=>date('Y-m-d H:i:s')
												), "pis_mou_detail_id=".$_POST['CallLog']['pis_mou_detail_id']);
			}
			/* echo "<pre>";
			print_r($_POST);
			print_r($model);
			die();  */
			$model->status = 'Y';
			if($model->save()){
				$model = new CallLog;
				Yii::app()->user->setFlash('Success', 'Details has been added successfully');
				//$this->redirect(array('callLog/create/'.$_POST['CallLog']['pis_mou_detail_id']));
				if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='78')
				{
					$this->redirect(array('pisMou/ipAdminListing/page/admin_listing1'));
				}else if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='62')
				{
					$this->redirect(array('pisMou/hodIndex/page/admin_listing'));
				}else if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='7')
				{
					$this->redirect(array('pisMou/hodIndex/page/admin_listing1'));
				}else 
				{
					$this->redirect(array('pisMou/index/page/admin_listing'));
				}	
			} else{				
				/* var_dump($model->getErrors());*/				
			}  
		}
		
		$this->render('create',array(
			'model'=>$model,
			'du_pis_detail_id'=>$du_pis_detail_id,
			'allData'=>$allData,
			'callLogData'=>$callLogData,
			'project_detail'=> @$parentData['project_detail']
		));
	}
	
	public function getMrnData($mrn_no,$pis_mou_detail_id)
	{
	
		$sql = "SELECT du_pis_mou_upload.master_reference_no, du_pis_mou_upload.id, du_pis_mou_upload.announced_mous as announced_mous, 
		du_pis_mou_upload.company_name, du_pis_mou_upload.phone_number, du_pis_mou_upload.representative_name,	
		du_pis_mou_upload.email_id, du_pis_mou_upload.pis_proposed_investment_rs, du_pis_mou_upload.pis_proposed_investment_type, 
		du_pis_mou_upload.pis_proposed_employment, du_pis_mou_upload.mou_signed_by, du_pis_mou_upload.is_mou_signed_by_gov_uk, 
		du_pis_mou_upload.mou_proposed_investment_rs, du_pis_mou_upload.mou_proposed_investment_type, du_pis_mou_upload.mou_proposed_employment ,
		du_pis_mou_upload.pis_upload , du_pis_mou_upload.mou_upload , du_pis_mou_detail.sector1, du_pis_mou_detail.sector2,du_pis_mou_detail.id,	
		du_pis_mou_detail.mrn_sub_number,	du_pis_mou_detail.project_detail,du_pis_mou_detail.proposed_investment, du_pis_mou_detail.proposed_employment,	
		report_sector1.sector_name as sector1_name, report_sector2.sector_name as sector2_name, bo_user.full_name	
		from du_pis_mou_upload 
		Left JOIN bo_user ON du_pis_mou_upload.dept_user_id=bo_user.uid
		Left JOIN du_pis_mou_detail ON du_pis_mou_detail.pis_mou_parent_id=du_pis_mou_upload.id and du_pis_mou_detail.is_active='Y' and du_pis_mou_detail.id=$pis_mou_detail_id
		LEFT JOIN du_ukis_report_sector as report_sector1 ON report_sector1.id=du_pis_mou_detail.sector1 
		LEFT JOIN du_ukis_report_sector as report_sector2 ON report_sector2.id=du_pis_mou_detail.sector2 
		WHERE du_pis_mou_upload.master_reference_no=$mrn_no";		
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();
		return  $resultData;
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate2()
	{	
		
		$model = new CallLog;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['CallLog']))
		{	
			/* echo "<pre>";
			print_r($_POST['CallLog']);  */
			$model->attributes = $_POST['CallLog'];
			$model->calling_date = date("Y-m-d",strtotime($_POST['CallLog']['calling_date']));
			$model->email = $_POST['CallLog']['email'];
			$model->calling_summary = $_POST['CallLog']['calling_summary'];
			$model->salutation = $_POST['CallLog']['salutation'];
			$model->call_back_date_start = @$_POST['CallLog']['call_back_date_start'];
			$model->call_back_date_end = @$_POST['CallLog']['call_back_date_end'];
			$model->land_requirement = @$_POST['CallLog']['land_requirement'];
			$model->reason = @$_POST['CallLog']['reason'];
			
			if($_POST['CallLog']['land_requirement']=='Yes'){
			
				$model->area_requirement_given = @$_POST['CallLog']['area_requirement_given'];
				$model->area_requirement = @$_POST['CallLog']['area_requirement'];
				$model->siidcul_summary = @$_POST['CallLog']['siidcul_summary'];
				if(isset($_POST['CallLog']['area_requirement_district']))
				{
					if(count($_POST['CallLog']['area_requirement_district'])>1)
					{
						if(in_array('718',$_POST['CallLog']['area_requirement_district']))
						{
							$model->area_requirement_district = '718';
						}elseif(in_array('719',$_POST['CallLog']['area_requirement_district']))
						{
							$model->area_requirement_district = '719';
						}else{
							$model->area_requirement_district = implode(",",$_POST['CallLog']['area_requirement_district']);
						}
					}else{
						$model->area_requirement_district = @$_POST['CallLog']['area_requirement_district'][0];
					}
				}
				$model->area_unit = @$_POST['CallLog']['area_unit'];
				
				$sqaureConvert = $this->getLandUnitConversion($_POST['CallLog']['area_requirement'],$_POST['CallLog']['area_unit']);
				
				$model->area_in_square_meters = $sqaureConvert;
			}
			
			if($_POST['CallLog']['land_requirement']=='No'){
			
				$model->area_under_possession = @$_POST['CallLog']['area_under_possession'];
				$model->area_under_possession_unit = @$_POST['CallLog']['area_under_possession_unit'];
				$model->area_under_possession_address = @$_POST['CallLog']['area_under_possession_address'];
				$model->area_under_possession_tehsil = @$_POST['CallLog']['area_under_possession_tehsil'];
				if(isset($_POST['CallLog']['area_under_possession_district']))
				{
					if(count($_POST['CallLog']['area_under_possession_district'])>1)
					{
						if(in_array('718',$_POST['CallLog']['area_under_possession_district']))
						{
							$model->area_under_possession_district = '718';
						}elseif(in_array('719',$_POST['CallLog']['area_under_possession_district']))
						{
							$model->area_under_possession_district = '719';
						}else{
							$model->area_under_possession_district = implode(",",$_POST['CallLog']['area_under_possession_district']);
						}
					}else{
						$model->area_under_possession_district = @$_POST['CallLog']['area_under_possession_district'][0];
					}
				}				
				/* $sqaureConvert = $this->getLandUnitConversion($_POST['CallLog']['area_requirement'],$_POST['CallLog']['area_unit']);
				
				$model->area_in_square_meters = $sqaureConvert; */
			}
			
			if(isset($_POST['CallLog']['meeting_request_dept']))
			{			
				if(count($_POST['CallLog']['meeting_request_dept'])>1)
				{
					$model->meeting_request_dept = implode(",",$_POST['CallLog']['meeting_request_dept']);
				}else{
					$model->meeting_request_dept = @$_POST['CallLog']['meeting_request_dept'][0];
				}
			}	
			
			$model->meeting_with_dept = @$_POST['CallLog']['meeting_with_dept'];
			$model->meeting_request_start = @$_POST['CallLog']['meeting_request_start'];
			$model->meeting_request_end = @$_POST['CallLog']['meeting_request_end'];
			
			$model->timeline_for_commencement = @$_POST['CallLog']['timeline_for_commencement'];
			$model->financial_tie_up = @$_POST['CallLog']['financial_tie_up'];
			
			if(isset($_POST['CallLog']['financial_partner']))
			{			
				if(count($_POST['CallLog']['financial_partner'])>1)
				{
					$model->financial_partner = implode(",",$_POST['CallLog']['financial_partner']);
				}else{
					$model->financial_partner = @$_POST['CallLog']['financial_partner'][0];
				}
			}	
			
			if(isset($_POST['CallLog']['meeting_request_dept']))
			{
				if(count($_POST['CallLog']['meeting_request_dept'])>1)
				{
					$model->meeting_request_dept = implode(",",$_POST['CallLog']['meeting_request_dept']);
				}else{
					$model->meeting_request_dept = @$_POST['CallLog']['meeting_request_dept'][0];
				}
			}
			
			$model->pis_mou_detail_id = @$_POST['CallLog']['pis_mou_detail_id'];
			$model->created = date("Y-m-d H:i:s");
			$model->inprincipal_applied = @$_POST['CallLog']['inprincipal_applied'];
			$model->forwarded_dept = @$_POST['CallLog']['forwarded_dept'];
			$model->caf_id = @$_POST['CallLog']['caf_id'][0];
			if(isset($_POST['CallLog']['caf_id'][0]) && !empty($_POST['CallLog']['caf_id'][0]))
			{
				$sql = "SELECT application_status FROM bo_application_submission WHERE submission_id =".$_POST['CallLog']['caf_id'][0];
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$cafstatus = $command->queryRow();
				$model->caf_status = $cafstatus['application_status'];
			}
			
			/*  echo "<pre>";
			print_r($model);die();  */
			
			$sql = "SELECT count(*) FROM du_pis_call_log WHERE pis_mou_detail_id =".$_POST['CallLog']['pis_mou_detail_id'];
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$callLogExist = $command->queryRow();
			if(isset($callLogExist) && $callLogExist >=1)
			{
				$callLogUpdate = Yii::app()->db->createCommand()->update("du_pis_call_log", array(
													"status" =>'N',
													"modified"=>date('Y-m-d H:i:s')
												), "pis_mou_detail_id=".$_POST['CallLog']['pis_mou_detail_id']);
			}
			
			if($model->save()){
				$model = new CallLog;
				Yii::app()->user->setFlash('Success', 'Details has been added successfully');
				//$this->redirect(array('callLog/create/'.$_POST['CallLog']['pis_mou_detail_id']));
				if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='78')
				{
					$this->redirect(array('pisMou/ipAdminListing/page/admin_listing1'));
				}else if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='62')
				{
					$this->redirect(array('pisMou/hodIndex/page/admin_listing'));
				}else 
				{
					$this->redirect(array('pisMou/index/page/admin_listing'));
				}	
			}/* else{
				 die(var_dump($model->getErrors()));
			}  */	
		}
		
		
		$du_pis_detail_id = '';
		
		if(isset($_GET['id']))
		$du_pis_detail_id = $_GET['id'];

		
		$allData = array();
		$callLogData = array();
		$mainpismouData = array();
		
		
		$sql = "SELECT pis_mou_parent_id,project_detail FROM du_pis_mou_detail WHERE id ='$du_pis_detail_id'";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $parentData = $command->queryRow();
		
		$sql = "SELECT company_name, representative_name,id,phone_number,email_id,master_reference_no FROM du_pis_mou_upload WHERE id ='$parentData[pis_mou_parent_id]'";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $mainpismouData = $command->queryRow();
		
		$sql = "SELECT * FROM du_pis_call_log WHERE pis_mou_detail_id ='$du_pis_detail_id' order by id desc";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $callLogData = $command->queryRow();
	
		if(isset($callLogData) && !empty($callLogData))
		{	
			$LogData['id']  = $callLogData['id'];
			$LogData['representative_name']  = $callLogData['name_of_representative'];
			$LogData['phone_number']  = $callLogData['phone_number'];
			$LogData['email_id']  = $callLogData['email'];
			$LogData['calling_date']  = $callLogData['calling_date'];
			$model=$this->loadModel($LogData['id']);
			$callLogData = $LogData;
			
		}else{	
			$callLogData = $mainpismouData;
		}
		
		$allData = $this->GetPisMouReportByMrn($mainpismouData['master_reference_no']);
		
		if(isset($allData) && !empty($allData))
		{
			$allData = $allData;
		}else{
			$allData = array();
		}
		
		$this->render('create2',array(
			'model'=>$model,
			'du_pis_detail_id'=>$du_pis_detail_id,
			'allData'=>$allData,
			'callLogData'=>$callLogData,
			'project_detail'=> @$parentData['project_detail']
		));
	}
	
	
	public  function getLandUnitConversion($area,$areatype) {
        
        if(!empty($area) && !empty($areatype)){
            if ($areatype =='Acres'){
                $area = $area*4046.86;
            }
            else if ($areatype =='Bigha'){
                $area = $area*800;
            }
            else if ($areatype =='Hectare'){
                $area = $area*10000;
            }
            else if ($areatype =='Nala'){
                $area = $area*200;
            }
            else if (($areatype =='Sq. ft') || ($areatype =='Sq Ft')){
                $area = $area*0.092903;
            }
            else{
                $area ='invalid';
            }
        }   
		return $area;
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

		if(isset($_POST['CallLog']))
		{
			$model->attributes=$_POST['CallLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('CallLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CallLog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CallLog']))
			$model->attributes=$_GET['CallLog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CallLog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CallLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CallLog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='call-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function GetPisMouReportByMrn_old($mrn_no=null) {
        $fields = array(
            'S.No',
            'Master Reference No',
            'Consolidated Sector',
            'Company',
            'Phone',
            'Email',
            'PIS Investment(In Cr)',
            'PIS Employment',
            'MoU Investment(In Cr)',
            'MoU Employment',
            'Districts as per MoU',
            'Sectors as per MoU',
            'MoU Signed By Investor',
            'MoU Signed By GoUK',
            'Assigned To',
            'Missing PIS',
            'Missing MoU',
            'Announced Mou',
            'Action'
        );

        $sql = "SELECT du_pis_mou_upload.master_reference_no,
				du_pis_mou_upload.id,
				du_pis_mou_upload.representative_name,				
				du_pis_mou_upload.email_id,
                du_ukis_report_sector.sector_name as consolidated_sector,               
				du_pis_mou_upload.company_name,
                du_pis_mou_upload.phone_number,
				du_pis_mou_upload.pis_proposed_investment_rs,
				du_pis_mou_upload.pis_proposed_investment_type,
				du_pis_mou_upload.pis_proposed_employment,
				du_pis_mou_upload.pis_proposed_employment,
				du_pis_mou_upload.mou_signed_by,
				du_pis_mou_upload.is_mou_signed_by_gov_uk,
                du_pis_mou_upload.mou_proposed_investment_rs,
                du_pis_mou_upload.mou_proposed_investment_type,
                du_pis_mou_upload.mou_proposed_employment ,   
                du_pis_mou_upload.pis_upload ,   
                du_pis_mou_upload.mou_upload ,		
                bo_user.full_name				
                from du_pis_mou_upload  INNER JOIN bo_user ON du_pis_mou_upload.dept_user_id=bo_user.uid 
                left join du_ukis_report_sector on du_pis_mou_upload.main_consolidated_sector_id = du_ukis_report_sector.id  WHERE du_pis_mou_upload.master_reference_no='$mrn_no'";
				
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();

        //print_r($resultData);die;		
        $s_user = array();
        $c = 0;
        foreach ($resultData as $key => $user) {
            $distArray = array();
            $sectorArray = array();
            $userDetails = Yii::app()->db->createCommand("select * from du_pis_mou_detail where type='mou' AND is_active='Y' AND pis_mou_parent_id=$user[id]")->queryAll();
            unset($distArray);
            $distNames = "";
            $distArray = array();
            foreach ($userDetails as $userDetail) {

                if (!empty($userDetail['proposed_location'])) {
                    $distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy  where district_id IN ($userDetail[proposed_location])")->queryAll();
                    foreach ($distDetail as $d) {
                        if (!in_array($d['distric_name'], $distArray)) {
                            $distArray[] = $d['distric_name'];
                            $distNames = $distNames . "/" . $d['distric_name'];
                        }
                    }
                }
                if (!empty($userDetail['sector_detail'])) {
                    //$secto=lrtim($userDetail['sector_detail'],',');
                    //$secyi=	str_replace(",,",",",$secto);
                    $sectorDetails = Yii::app()->db->createCommand("select name from bo_information_wizard_sector  where id IN ($userDetail[sector_detail])")->queryAll();
                    unset($sectorArray);
                    $sectorsName = "";
                    $sectorArray = array();
                    foreach ($sectorDetails as $s) {
                        //print_r($s);die;
                        if (!in_array($s['name'], $sectorArray)) {
                            $sectorArray[] = $s['name'];
                            $sectorsName = $sectorsName . "/" . $s['name'];
                        }
                    }
                }
                             
                
                    }
                    
                    $action = '';
                if(!empty($userDetail['id'])) {
                    $forward_level = Yii::app()->db->createCommand("select action from du_pis_mou_forward_level  where pis_mou_parrent_id = $user[id] order by created desc limit 1")->queryAll();
                    if(!empty($forward_level)){
                        $action = $forward_level[0]['action'];
                        
                        }
                    }
                    

            //print_r($userDetail);
            $s_user[$c]['S.No'] = $c + 1;
            $s_user[$c]['Master Reference No'] = @$user['master_reference_no'];
            $s_user[$c]['Consolidated Sector'] = @$user['consolidated_sector'];
            $s_user[$c]['Representative Name'] = @$user['representative_name'];
            $s_user[$c]['Company'] = @$user['company_name'];
            $s_user[$c]['Phone'] = @$user['phone_number'];
            $s_user[$c]['Email'] = @$user['email_id'];
            if ($user['pis_proposed_investment_type'] == 'Lakh') {
                $s_user[$c]['PIS Investment(In Cr)'] = @$user['pis_proposed_investment_rs'] / 100;
            } else {
                $s_user[$c]['PIS Investment(In Cr)'] = @$user['pis_proposed_investment_rs'];
            }
            $s_user[$c]['PIS Employment'] = @$user['pis_proposed_employment'];

            if ($user['mou_proposed_investment_type'] == 'Lakh') {
                $s_user[$c]['MoU Investment(In Cr)'] = @$user['mou_proposed_investment_rs'] / 100;
            } else {
                $s_user[$c]['MoU Investment(In Cr)'] = @$user['mou_proposed_investment_rs'];
            }
            $s_user[$c]['MoU Employment'] = @$user['mou_proposed_employment'];

            $s_user[$c]['Districts as per MoU'] = ltrim($distNames, "/");
            $s_user[$c]['Sectors as per MoU'] = ltrim($sectorsName, "/");
            if ($user['mou_signed_by'] == "Signed By Investor") {
                $s_user[$c]['MoU Signed By Investor'] = "Yes";
            } else {
                $s_user[$c]['MoU Signed By Investor'] = "No";
            }

            if ($user['is_mou_signed_by_gov_uk'] == 1) {
                $s_user[$c]['MoU Signed By GoUK'] = "Yes";
            } else {
                $s_user[$c]['MoU Signed By GoUK'] = "No";
            }
            $s_user[$c]['Sectors as per MoU'] = ltrim($sectorsName, "/");
            $s_user[$c]['Assigned To'] = @$user['full_name'];
            $s_user[$c]['Assigned To'] = @$user['full_name'];
            if ($user['pis_upload'] != "") {
                $s_user[$c]['Missing PIS'] = "No";
            } else {
                $s_user[$c]['Missing PIS'] = "Yes";
            }
            if ($user['mou_upload'] != "") {
                $s_user[$c]['Missing MoU'] = "No";
            } else {
                $s_user[$c]['Missing MoU'] = "Yes";
            }
            //$s_user[$c]['Announced Mou'] = @$user['announced_mous'];
            $s_user[$c]['Action'] = @$action;

            ++$c;
        }
		
       return $s_user;
		
    }
	
	public function GetPisMouReportByMrn($mrn_no=null) {
        $fields = array(
            'S.No',
            'Master Reference No',
            'Sector1',
			'Sectors2',
            'Company',
            'Phone',
            'Name of Representative',
            'Email',
            'PIS Investment(In Cr)',
            'PIS Employment',
            'MoU Investment(In Cr)',
            'MoU Employment',
            'Districts as per MoU',
            'MoU Signed By Investor',
            'MoU Signed By GoUK',
            'Sectors as per MoU',
            'Assigned To',
            'Missing PIS',
            'Missing MoU',
            'Announced Mou',
            'Action'
        );

        /* $sql = "SELECT du_pis_mou_upload.master_reference_no,
				du_pis_mou_upload.id,
                du_ukis_report_sector.sector_name as consolidated_sector, 
                du_pis_mou_upload.announced_mous as announced_mous,
				du_pis_mou_upload.company_name,
                du_pis_mou_upload.phone_number,
				du_pis_mou_upload.representative_name,				
				du_pis_mou_upload.email_id,
				du_pis_mou_upload.pis_proposed_investment_rs,
				du_pis_mou_upload.pis_proposed_investment_type,
				du_pis_mou_upload.pis_proposed_employment,
				du_pis_mou_upload.mou_signed_by,
				du_pis_mou_upload.is_mou_signed_by_gov_uk,
                du_pis_mou_upload.mou_proposed_investment_rs,
                du_pis_mou_upload.mou_proposed_investment_type,
                du_pis_mou_upload.mou_proposed_employment ,   
                du_pis_mou_upload.pis_upload ,   
                du_pis_mou_upload.mou_upload ,		
                 bo_user.full_name				
                from du_pis_mou_upload  INNER JOIN bo_user ON du_pis_mou_upload.dept_user_id=bo_user.uid 
                left join du_ukis_report_sector on du_pis_mou_upload.main_consolidated_sector_id = du_ukis_report_sector.id  WHERE du_pis_mou_upload.master_reference_no='$mrn_no'"; */  
		$sql = "SELECT du_pis_mou_upload.master_reference_no,
				du_pis_mou_upload.id,
                du_pis_mou_upload.announced_mous as announced_mous,
				du_pis_mou_upload.company_name,
                du_pis_mou_upload.phone_number,
				du_pis_mou_upload.representative_name,				
				du_pis_mou_upload.email_id,
				du_pis_mou_upload.pis_proposed_investment_rs,
				du_pis_mou_upload.pis_proposed_investment_type,
				du_pis_mou_upload.pis_proposed_employment,
				du_pis_mou_upload.mou_signed_by,
				du_pis_mou_upload.is_mou_signed_by_gov_uk,
                du_pis_mou_upload.mou_proposed_investment_rs,
                du_pis_mou_upload.mou_proposed_investment_type,
                du_pis_mou_upload.mou_proposed_employment ,   
                du_pis_mou_upload.pis_upload ,   
                du_pis_mou_upload.mou_upload ,
				du_pis_mou_detail.sector1,
				du_pis_mou_detail.sector2,	
				du_pis_mou_detail.mrn_sub_number,	
				du_pis_mou_detail.proposed_investment,	
				du_pis_mou_detail.proposed_employment,	
				report_sector1.sector_name as sector1_name,
				report_sector2.sector_name as sector2_name, 	
                bo_user.full_name				
                from du_pis_mou_upload 
				Left JOIN bo_user ON du_pis_mou_upload.dept_user_id=bo_user.uid 
				Left JOIN du_pis_mou_detail ON du_pis_mou_detail.pis_mou_parent_id=du_pis_mou_upload.id
				LEFT JOIN du_ukis_report_sector as report_sector1 ON report_sector1.id=du_pis_mou_detail.sector1 
				LEFT JOIN du_ukis_report_sector as report_sector2 ON report_sector2.id=du_pis_mou_detail.sector2 					
				WHERE du_pis_mou_upload.master_reference_no='$mrn_no' Group by du_pis_mou_upload.master_reference_no";		
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();
		
        $s_user = array();
        $c = 0;
        foreach ($resultData as $key => $user) {
            $distArray = array();
            $sectorArray = array();
            $userDetails = Yii::app()->db->createCommand("select * from du_pis_mou_detail where type='mou' AND is_active='Y' AND pis_mou_parent_id=$user[id]")->queryAll();
            unset($distArray);
            $distNames = "";
            $distArray = array();
			
            foreach ($userDetails as $userDetail) {				
                if (!empty($userDetail['proposed_location'])) {
                    $distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy  where district_id IN ($userDetail[proposed_location])")->queryAll();
                    foreach ($distDetail as $d) {
                        if (!in_array($d['distric_name'], $distArray)) {
                            $distArray[] = $d['distric_name'];
                            $distNames = $distNames . "/" . $d['distric_name'];
                        }
                    }
                }
				$sectorsName = '';
                /* if (isset($userDetail['sector_detail']) && !empty($userDetail['sector_detail'])) {
                    //$secto=lrtim($userDetail['sector_detail'],',');
                    //$secyi=	str_replace(",,",",",$secto);
                    $sectorDetails = Yii::app()->db->createCommand("select name from bo_information_wizard_sector  where id IN ($userDetail[sector_detail])")->queryAll();
                    unset($sectorArray);
                    $sectorsName = "";
                    $sectorArray = array();
                    foreach ($sectorDetails as $s) {
                        //print_r($s);die;
                        if (!in_array($s['name'], $sectorArray)) {
                            $sectorArray[] = $s['name'];
                            $sectorsName = $sectorsName . "/" . $s['name'];
                        }
                    }
                } */        
                
            }
                    
			$action = '';
			if(!empty($userDetail['id'])) {
				$forward_level = Yii::app()->db->createCommand("select action from du_pis_mou_forward_level  where pis_mou_parrent_id = $user[id] order by created desc limit 1")->queryAll();
				if(!empty($forward_level)){
					$action = $forward_level[0]['action'];
				}
			}  

            //print_r($userDetail);
            $s_user[$c]['S.No'] = $c + 1;
            $s_user[$c]['Master Reference No'] = @$user['master_reference_no'];
            $s_user[$c]['Sector1'] = @$user['sector1_name'];
			$s_user[$c]['Sectors2'] = @$user['sector2_name'];
            $s_user[$c]['Company'] = @$user['company_name'];
            $s_user[$c]['Phone'] = @$user['phone_number'];
            $s_user[$c]['Name of Representative'] = @$user['representative_name'];
            $s_user[$c]['Email'] = @$user['email_id'];
            if ($user['pis_proposed_investment_type'] == 'Lakh') {
                $s_user[$c]['PIS Investment(In Cr)'] = @$user['pis_proposed_investment_rs'] / 100;
            } else {
                $s_user[$c]['PIS Investment(In Cr)'] = @$user['pis_proposed_investment_rs'];
            }
            $s_user[$c]['PIS Employment'] = @$user['pis_proposed_employment'];

            if ($user['mou_proposed_investment_type'] == 'Lakh') {
                $s_user[$c]['MoU Investment(In Cr)'] = @$user['mou_proposed_investment_rs'] / 100;
            } else {
                $s_user[$c]['MoU Investment(In Cr)'] = @$user['mou_proposed_investment_rs'];
            }
            $s_user[$c]['MoU Employment'] = @$user['mou_proposed_employment'];

            $s_user[$c]['Districts as per MoU'] = ltrim($distNames, "/");
           
            if ($user['mou_signed_by'] == "Signed By Investor") {
                $s_user[$c]['MoU Signed By Investor'] = "Yes";
            } else {
                $s_user[$c]['MoU Signed By Investor'] = "No";
            }

            if ($user['is_mou_signed_by_gov_uk'] == 1) {
                $s_user[$c]['MoU Signed By GoUK'] = "Yes";
            } else {
                $s_user[$c]['MoU Signed By GoUK'] = "No";
            }
            $s_user[$c]['Sectors as per MoU'] = ltrim($sectorsName, "/");
            $s_user[$c]['Assigned To'] = @$user['full_name'];
            if ($user['pis_upload'] != "") {
                $s_user[$c]['Missing PIS'] = "No";
            } else {
                $s_user[$c]['Missing PIS'] = "Yes";
            }
            if ($user['mou_upload'] != "") {
                $s_user[$c]['Missing MoU'] = "No";
            } else {
                $s_user[$c]['Missing MoU'] = "Yes";
            }
            $s_user[$c]['Announced Mou'] = @$user['announced_mous'];
            $s_user[$c]['Action'] = @$action;

            ++$c;
        }
        /*  echo "<pre>";
          print_r($s_user);die;   */
		return $s_user;
    }
	
	public function actionCallLogOverAllReport() {

        $fields = array(
            'Sno',
			'Announced MoU',
            'Master Reference No',
			'Project MRN No',			
			'Is Multiple Project',
            'Calling Date',
            'Able To Connect',
            'Reason(Not able to connect)',
            'Calling Summary',
			'Company Name',
			'Project Detail',
			'Sector1',
			'Sector2',
			'Sector3',
			'Proposed Investment(In Cr.)(MoU)',
			'Proposed Employment(MoU)',
			'Proposed Location(MoU)',
			'Proposed Commencement Date(MoU)',
			'MoU/ITI',
            'Representative Name(FB)',
            'Phone Number(FB)',
            'Email Id(FB)',
            'Land Requirement(FB)',
			'Area Requirement Given(FB)',
            'Area Requirement(FB)',
            'Area Unit(FB)',
			'District Preferences(FB)',
			'Area Under Possession(FB)',
			'Area Unit(FB)',
			'Address(FB)',
			'Thesil(FB)',
			'District(FB)',
            'Already Have Financial Tie Up?(FB)',
            'Forward to Financial Institutions(FB)',
			'Meeting With Dept?(FB)',
            'Meeting Requested With Dept(FB)',
            'Meeting Requested Date(FB)',
            'Meeting Agenda(FB)',
            'Call Back(FB)',
            'Call Back Date(FB)',
            'Targeted TimeLine For Commencement(FB)'
        );

        $sql = "SELECT du_pis_call_log.*,timeline.name as timelinename,
		pismou_detail.pis_mou_parent_id,
		pismou_detail.sector1,
		pismou_detail.sector2,
		pismou_detail.sector3,
		pismou_detail.proposed_investment,
		pismou_detail.proposed_employment,
		pismou_detail.project_detail,
		pismou_detail.proposed_location,
		pismou_detail.proposed_commencement_date,
		pismou_detail.type,
		du_pis_mou_upload.company_name,
		du_pis_mou_upload.master_reference_no,
		du_pis_mou_upload.announced_mous,
		du_pis_mou_upload.mou_proposed_investment_rs,
		du_pis_mou_upload.mou_proposed_employment,
		du_pis_mou_upload.mou_proposed_employment,
		du_pis_mou_upload.mou_proposed_investment_type,
		report_sector1.sector_name as sector1_name,
		report_sector2.sector_name as sector2_name 
		FROM du_pis_call_log 
		LEFT JOIN du_timeline_commencement_master as timeline ON timeline.id = du_pis_call_log.timeline_for_commencement
		LEFT JOIN du_pis_mou_detail as pismou_detail ON pismou_detail.id=du_pis_call_log.pis_mou_detail_id
		LEFT JOIN du_ukis_report_sector as report_sector1 ON report_sector1.id=pismou_detail.sector1 
		LEFT JOIN du_ukis_report_sector as report_sector2 ON report_sector2.id=pismou_detail.sector2 
		LEFT JOIN du_pis_mou_upload ON pismou_detail.pis_mou_parent_id=du_pis_mou_upload.id";
		
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();
        $newdata = array();
		
		$i = 0;
        foreach($resultData as $result) {
			
			if (!empty($result['proposed_location'])) {
				$distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy where district_id IN ($result[proposed_location])")->queryAll();				
				$distArray = array();
				
				$distNames = "";
				foreach($distDetail as $d) {
					if (!in_array($d['distric_name'], $distArray)) {
						$distArray[] = $d['distric_name'];
						$distNames = $distNames . "/" . $d['distric_name'];
					}
				}
				$resultData[$i]['distNames'] = @ltrim($distNames,'/');
			}
			
			if (!empty($result['area_under_possession_district'])) {
				$distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy where district_id IN ($result[area_under_possession_district])")->queryAll();				
				$distArray = array();
				
				$distNames = "";
				foreach($distDetail as $d) {
					if (!in_array($d['distric_name'], $distArray)) {
						$distArray[] = $d['distric_name'];
						$distNames = $distNames . "/" . $d['distric_name'];
					}
				}
				$resultData[$i]['under_possessiondistNames'] = @ltrim($distNames,'/');
			}
			
			$resultData[$i]['meeting_request_dept_name'] = "";
			if(isset($result['meeting_request_dept']) && !empty($result['meeting_request_dept']))
			{				
				$sql = "SELECT name FROM bo_infowizard_issuerby_master WHERE issuerby_id IN ($result[meeting_request_dept])";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$deptData = $command->queryAll();
				if(isset($deptData) && !empty($deptData ))
				{	
					if(count($deptData) > 1)
					{
						$resultData[$i]['meeting_request_dept_name'] = implode(', ', array_column( $deptData, 'name'));
					}else{
						$resultData[$i]['meeting_request_dept_name'] = $deptData[0]['name'];
					} 
				}	
			}
			$resultData[$i]['distrcit_name'] = "";
			if(isset($result['area_requirement_district']) && !empty($result['area_requirement_district']))
			{
				$location = explode(",",$result['area_requirement_district']);
				if (in_array(718, $location)) {
					$distric_name[] = 'Entire State';
				}
				if (in_array(719, $location)) {
					$distric_name[] = 'Not decided yet';
				}
				
				$locationStr = implode(",", $location);
				if (!empty($locationStr)) {
					$connection = Yii::app()->db;
					$sql = "SELECT distric_name FROM bo_district WHERE district_id IN ($locationStr)";
					$command = $connection->createCommand($sql);
					$disArr = $command->queryAll();
					foreach ($disArr as $key => $val1) {
						$distric_name[] = $val1['distric_name'];
					}
				}
				
				if(in_array('Entire State',$distric_name))
				{	
					$resultData[$i]['distrcit_name'] = 'Entire State';
				}	
				else if(in_array('Not decided yet',$distric_name))
				{
					$resultData[$i]['distrcit_name'] = 'Not decided yet';
				}	
				else{
					$resultData[$i]['distrcit_name'] = implode(",", array_unique($distric_name));
				}
			}
			$i++;	
        }
		/* echo "<pre>";
		print_r($resultData);die();	 */ 
        $s_user = array();
        $c = 0;
        $z = 1;
		$mrnarray = array();
		$multipleProject = 'No';
		
        foreach($resultData as $key => $user) { 			
			if(!in_array($user['master_reference_no'],$mrnarray)){
				$z = 1;
				$mrnarray[] = $user['master_reference_no'];
				$multipleProject = 'No';
			} else{			
				$multipleProject = 'Yes';
			}
			
			$s_user[$c]['Sno'] = $c + 1;
			$s_user[$c]['Announced MoU'] = @$user['announced_mous'];
            $s_user[$c]['Master Reference No'] = @$user['master_reference_no'];
            $s_user[$c]['Project MRN No'] = @$user['master_reference_no'].".".($z);
            $s_user[$c]['Is Multiple Project'] = $multipleProject;				
            if($user['calling_date']!='0000-00-00' && $user['calling_date']!='')
			{	
				$s_user[$c]['Calling Date'] = date('d-M-Y',strtotime(@$user['calling_date']));
			}else{
				$s_user[$c]['Calling Date'] = "";
			}
            $s_user[$c]['Able To Connect'] = @$user['able_to_connect'];
            $s_user[$c]['Reason(Not able to connect)'] =  @$user['reason'];
            $s_user[$c]['Calling Summary'] = @$user['calling_summary'];
			$s_user[$c]['Company Name'] =  @$user['company_name'];
			$s_user[$c]['Project Detail'] =  @$user['project_detail'];
			$s_user[$c]['Sector1'] =  @$user['sector1_name'];
			$s_user[$c]['Sector2'] =  @$user['sector2_name'];
			if(isset($user['sector3']) && !empty($user['sector3']))
			{
				$s_user[$c]['Sector3'] =  @$user['sector3'];
			}else{
				$s_user[$c]['Sector3'] =  "";
			}
			
			if ($user['mou_proposed_investment_type'] == 'Lakh') {
                $s_user[$c]['Proposed Investment(In Cr.)(MoU)'] = @$user['mou_proposed_investment_rs'] / 100;
            } else {
                $s_user[$c]['Proposed Investment(In Cr.)(MoU)'] = @$user['mou_proposed_investment_rs'];
            }			
			$s_user[$c]['Proposed Employment(MoU)'] =  @$user['mou_proposed_employment'];
			$s_user[$c]['Proposed Location(MoU)'] =  @$user['distNames'];
			if($user['proposed_commencement_date']!='0000-00-00' && $user['proposed_commencement_date']!='')
			{
				$s_user[$c]['Proposed Commencement Date(MoU)'] =  date('d-M-Y',strtotime(@$user['proposed_commencement_date']));
			}else{
				$s_user[$c]['Proposed Commencement Date(MoU)'] = "";
			}	
			if($user['type']=='mou')
			{
				$s_user[$c]['MoU/ITI'] =  'MoU';
			}
			if($user['type']=='ITI')
			{
				$s_user[$c]['MoU/ITI'] =  'ITI';
			}			
            $s_user[$c]['Representative Name(FB)'] = @$user['name_of_representative'];
            $s_user[$c]['Phone Number(FB)'] = @$user['phone_number'];
            $s_user[$c]['Email Id(FB)'] =  @$user['email'];
            $s_user[$c]['Land Requirement(FB)'] = @$user['land_requirement'];
			$s_user[$c]['Area Requirement Given(FB)'] = @$user['area_requirement_given'];
            $s_user[$c]['Area Requirement(FB)'] =  @$user['area_requirement'];
            $s_user[$c]['Area Unit(FB)'] = @$user['area_unit'];			
            $s_user[$c]['District Preferences(FB)'] = @$user['distrcit_name'];
            $s_user[$c]['Area Under Possession(FB)'] = @$user['area_under_possession'];
			if(isset($user['area_under_possession']) && !empty($user['area_under_possession']))
			{
				$s_user[$c]['Area Under Possession Unit(FB)'] = @$user['area_under_possession_unit'];
			}else{
				$s_user[$c]['Area Under Possession Unit(FB)'] = "";
			}
            $s_user[$c]['Address(FB)'] = @$user['area_under_possession_address'];
            $s_user[$c]['Thesil(FB)'] = @$user['area_under_possession_tehsil'];
            $s_user[$c]['District(FB)'] = @$user['under_possessiondistNames'];
            $s_user[$c]['Already Have Financial Tie Up?(FB)'] = @$user['financial_tie_up'];
            $s_user[$c]['Forward to Financial Institutions(FB)'] = @$user['financial_partner'];
			$s_user[$c]['Meeting With Dept?(FB)'] = @$user['meeting_with_dept'];
            $s_user[$c]['Meeting Requested With Dept(FB)'] = @$user['meeting_request_dept_name'];
			
			$meetingstartd ='';
			$meetingendd ='';
			
			if(isset($user['meeting_request_start']) && $user['meeting_request_start']!='' && $user['meeting_request_start']!='0000-00-00')
            {		
				 $meetingstartd = date('d-M-Y',strtotime($user['meeting_request_start']));
			}
			if(isset($user['meeting_request_end']) && $user['meeting_request_end']!='' && $user['meeting_request_end']!='0000-00-00')
            {		
				 $meetingendd = ' to '.date('d-M-Y',strtotime($user['meeting_request_end']));
			}
			
			$s_user[$c]['Meeting Requested Date(FB)'] = @$meetingstartd.@$meetingendd; 		
			
            $s_user[$c]['Meeting Agenda(FB)'] = @$user['metting_agenda'];
            $s_user[$c]['Call Back(FB)'] = @$user['call_back'];
			
			if(isset($user['call_back_date_start(FB)']) && $user['call_back_date_start']!='' && $user['call_back_date_start']!='0000-00-00')
            {
				$s_user[$c]['Call Back Date(FB)'] =  date('d-M-Y',strtotime(@$user['call_back_date_start'])).' to '.date('d-M-Y',strtotime(@$user['call_back_date_end']));
			}else{
				$s_user[$c]['Call Back Date(FB)'] =  "";
			}	
			
            $s_user[$c]['Targeted TimeLine For Commencement(FB)'] =  @$user['timelinename'];
			$z++;
			++$c;
        }
		/*  echo "<pre>";
		print_r($s_user);die();  */
		$reportName = "UKIS_Overall_Call_Log_Report-" . date('Y-m-d_H:i:s');	    
        XlsExporter::downloadXls($reportName, $s_user, $reportName, true, false, $fields, 's_users'); 
		/* echo "<pre>";
		 print_r($s_user);die(); date('jS \of F Y h::i::s A')*/	
    }
	
	public function actionCallLogSectorReport() {
		
        $fields = array(
            'Sno',
			'Announced MoU',
            'Master Reference No',
			'Project MRN No',			
			'Is Multiple Project',
            'Calling Date',
            'Able To Connect',
            'Reason(Not able to connect)',
            'Calling Summary',
			'Company Name',
			'Project Detail',
			'Sector1',
			'Sector2',
			'Sector3',
			'Proposed Investment(In Cr.)(MoU)',
			'Proposed Employment(MoU)',
			'Proposed Location(MoU)',
			'Proposed Commencement Date(MoU)',
			'MoU/ITI',
            'Representative Name(FB)',
            'Phone Number(FB)',
            'Email Id(FB)',
            'Land Requirement(FB)',
            'Area Requirement Given(FB)',
            'Area Requirement(FB)',
            'Area Unit(FB)',
			'District Preferences(FB)',
			'Area Under Possession(FB)',
			'Area Unit(FB)',
			'Address(FB)',
			'Thesil(FB)',
			'District(FB)',
            'Already Have Financial Tie Up?(FB)',
            'Forward to Financial Institutions(FB)',
            'Meeting With Dept?(FB)',
            'Meeting Requested With Dept(FB)',
            'Meeting Requested Date(FB)',
            'Meeting Agenda(FB)',
            'Call Back(FB)',
            'Call Back Date(FB)',
            'Targeted TimeLine For Commencement(FB)'
        );

        $sql = "SELECT du_pis_call_log.*,timeline.name as timelinename,
		pismou_detail.pis_mou_parent_id,
		pismou_detail.sector1,
		pismou_detail.sector2,
		pismou_detail.sector3,
		pismou_detail.proposed_investment,
		pismou_detail.proposed_employment,
		pismou_detail.project_detail,
		pismou_detail.proposed_location,
		pismou_detail.proposed_commencement_date,
		pismou_detail.type,
		du_pis_mou_upload.company_name,
		du_pis_mou_upload.master_reference_no,
		du_pis_mou_upload.announced_mous,
		du_pis_mou_upload.mou_proposed_investment_rs,
		du_pis_mou_upload.mou_proposed_employment,
		du_pis_mou_upload.mou_proposed_employment,
		du_pis_mou_upload.mou_proposed_investment_type,
		report_sector1.sector_name as sector1_name,
		report_sector2.sector_name as sector2_name 
		FROM du_pis_call_log 
		LEFT JOIN du_timeline_commencement_master as timeline ON timeline.id = du_pis_call_log.timeline_for_commencement
		LEFT JOIN du_pis_mou_detail as pismou_detail ON pismou_detail.id=du_pis_call_log.pis_mou_detail_id
		LEFT JOIN du_ukis_report_sector as report_sector1 ON report_sector1.id=pismou_detail.sector1 
		LEFT JOIN du_ukis_report_sector as report_sector2 ON report_sector2.id=pismou_detail.sector2 
		LEFT JOIN du_pis_mou_upload ON pismou_detail.pis_mou_parent_id=du_pis_mou_upload.id";
		
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();
        $newdata = array();
		
		$i = 0;
        foreach($resultData as $result) {
			
			if (!empty($result['proposed_location'])) {
				$distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy where district_id IN ($result[proposed_location])")->queryAll();				
				$distArray = array();
				
				$distNames = "";
				foreach($distDetail as $d) {
					if (!in_array($d['distric_name'], $distArray)) {
						$distArray[] = $d['distric_name'];
						$distNames = $distNames . "/" . $d['distric_name'];
					}
				}
				$resultData[$i]['distNames'] = @ltrim($distNames,'/');
			}
			
			if (!empty($result['area_under_possession_district'])) {
				$distDetail = Yii::app()->db->createCommand("select distric_name from bo_district_copy where district_id IN ($result[area_under_possession_district])")->queryAll();				
				$distArray = array();
				
				$distNames = "";
				foreach($distDetail as $d) {
					if (!in_array($d['distric_name'], $distArray)) {
						$distArray[] = $d['distric_name'];
						$distNames = $distNames . "/" . $d['distric_name'];
					}
				}
				$resultData[$i]['under_possessiondistNames'] = @ltrim($distNames,'/');
			}
			
			$resultData[$i]['meeting_request_dept_name'] = "";
			if(isset($result['meeting_request_dept']) && !empty($result['meeting_request_dept']))
			{				
				$sql = "SELECT name FROM bo_infowizard_issuerby_master WHERE issuerby_id IN ($result[meeting_request_dept])";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$deptData = $command->queryAll();
				if(isset($deptData) && !empty($deptData ))
				{	
					if(count($deptData) > 1)
					{
						$resultData[$i]['meeting_request_dept_name'] = implode(', ', array_column( $deptData, 'name'));
					}else{
						$resultData[$i]['meeting_request_dept_name'] = $deptData[0]['name'];
					} 
				}	
			}
			$resultData[$i]['distrcit_name'] = "";
			if(isset($result['area_requirement_district']) && !empty($result['area_requirement_district']))
			{
				$location = explode(",",$result['area_requirement_district']);
				if (in_array(718, $location)) {
					$distric_name[] = 'Entire State';
				}
				if (in_array(719, $location)) {
					$distric_name[] = 'Not decided yet';
				}
				
				$locationStr = implode(",", $location);
				if (!empty($locationStr)) {
					$connection = Yii::app()->db;
					$sql = "SELECT distric_name FROM bo_district WHERE district_id IN ($locationStr)";
					$command = $connection->createCommand($sql);
					$disArr = $command->queryAll();
					foreach ($disArr as $key => $val1) {
						$distric_name[] = $val1['distric_name'];
					}
				}
				if(in_array('Entire State',$distric_name))
				{	
					$resultData[$i]['distrcit_name'] = 'Entire State';
				}	
				else if(in_array('Not decided yet',$distric_name))
				{
					$resultData[$i]['distrcit_name'] = 'Not decided yet';
				}	
				else{
					$resultData[$i]['distrcit_name'] = implode(",", array_unique($distric_name));
				}
								
			}
			$i++;	
        }
		
        $s_user = array();
        $c = 0;
        $z = 1;
		$mrnarray = array();
		$multipleProject = 'No';
        foreach($resultData as $key => $user) { 	
			if($_GET['id']==$user['sector1'] || $_GET['id']==$user['sector2']  || $_GET['id']==$user['sector3'])
			{
				if(!in_array($user['master_reference_no'],$mrnarray)){
					$z = 1;
					$mrnarray[] = $user['master_reference_no'];
					$multipleProject = 'No';
				}  else{			
					$multipleProject = 'Yes';
				}
				
				$s_user[$c]['Sno'] = $c + 1;
				$s_user[$c]['Announced MoU'] = @$user['announced_mous'];
				$s_user[$c]['Master Reference No'] = @$user['master_reference_no'];
				$s_user[$c]['Project MRN No'] = @$user['master_reference_no'].".".($z);
				$s_user[$c]['Is Multiple Project'] = $multipleProject;	
				if($user['calling_date']!='0000-00-00' && $user['calling_date']!='')
				{	
					$s_user[$c]['Calling Date'] = date('d-M-Y',strtotime(@$user['calling_date']));
				}else{
					$s_user[$c]['Calling Date'] = "";
				}	
				$s_user[$c]['Able To Connect'] = @$user['able_to_connect'];
				$s_user[$c]['Reason(Not able to connect)'] =  @$user['reason'];
				$s_user[$c]['Calling Summary'] = @$user['calling_summary'];
				$s_user[$c]['Company Name'] =  @$user['company_name'];
				$s_user[$c]['Project Detail'] =  @$user['project_detail'];
				$s_user[$c]['Sector1'] =  @$user['sector1_name'];
				$s_user[$c]['Sector2'] =  @$user['sector2_name'];
				if(isset($user['sector3']) && !empty($user['sector3']))
				{
					$s_user[$c]['Sector3'] =  @$user['sector3'];
				}else{
					$s_user[$c]['Sector3'] =  "";
				}
				
				if ($user['mou_proposed_investment_type'] == 'Lakh') {
					$s_user[$c]['Proposed Investment(In Cr.)(MoU)'] = @$user['mou_proposed_investment_rs'] / 100;
				} else {
					$s_user[$c]['Proposed Investment(In Cr.)(MoU)'] = @$user['mou_proposed_investment_rs'];
				}			
				$s_user[$c]['Proposed Employment(MoU)'] =  @$user['mou_proposed_employment'];
				$s_user[$c]['Proposed Location(MoU)'] =  @$user['distNames'];
				if($user['proposed_commencement_date']!='0000-00-00' && $user['proposed_commencement_date']!='')
				{
					$s_user[$c]['Proposed Commencement Date(MoU)'] =  date('d-M-Y',strtotime(@$user['proposed_commencement_date']));
				}else{
					$s_user[$c]['Proposed Commencement Date(MoU)'] = "";
				}	
				if($user['type']=='mou')
				{
					$s_user[$c]['MoU/ITI'] =  'MoU';
				}
				if($user['type']=='ITI')
				{
					$s_user[$c]['MoU/ITI'] =  'ITI';
				}			
				$s_user[$c]['Representative Name(FB)'] = @$user['name_of_representative'];
				$s_user[$c]['Phone Number(FB)'] = @$user['phone_number'];
				$s_user[$c]['Email Id(FB)'] =  @$user['email'];
				$s_user[$c]['Land Requirement(FB)'] = @$user['land_requirement'];
				$s_user[$c]['Area Requirement Given(FB)'] = @$user['area_requirement_given'];
				$s_user[$c]['Area Requirement(FB)'] =  @$user['area_requirement'];
				$s_user[$c]['Area Unit(FB)'] = @$user['area_unit'];
				$s_user[$c]['District Preferences(FB)'] = @$user['distrcit_name'];
				$s_user[$c]['Area Under Possession(FB)'] = @$user['area_under_possession'];
				if(isset($user['area_under_possession']) && !empty($user['area_under_possession']))
				{
					$s_user[$c]['Area Under Possession Unit(FB)'] = @$user['area_under_possession_unit'];
				}else{
					$s_user[$c]['Area Under Possession Unit(FB)'] = "";
				}
				$s_user[$c]['Address(FB)'] = @$user['area_under_possession_address'];
				$s_user[$c]['Thesil(FB)'] = @$user['area_under_possession_tehsil'];
				$s_user[$c]['District(FB)'] = @$user['under_possessiondistNames'];
				$s_user[$c]['Already Have Financial Tie Up?(FB)'] = @$user['financial_tie_up'];
				$s_user[$c]['Forward to Financial Institutions(FB)'] = @$user['financial_partner'];
				$s_user[$c]['Meeting With Dept?(FB)'] = @$user['meeting_with_dept'];
				$s_user[$c]['Meeting Requested With Dept(FB)'] = @$user['meeting_request_dept_name'];
				
				$meetingstartd ='';
				$meetingendd ='';
				
				if(isset($user['meeting_request_start']) && $user['meeting_request_start']!='' && $user['meeting_request_start']!='0000-00-00')
				{		
					 $meetingstartd = date('d-M-Y',strtotime($user['meeting_request_start']));
				}
				if(isset($user['meeting_request_end']) && $user['meeting_request_end']!='' && $user['meeting_request_end']!='0000-00-00')
				{		
					 $meetingendd = ' to '.date('d-M-Y',strtotime($user['meeting_request_end']));
				}
				
				$s_user[$c]['Meeting Requested Date(FB)'] = @$meetingstartd.@$meetingendd; 	
				
				$s_user[$c]['Meeting Agenda(FB)'] = @$user['metting_agenda'];
				$s_user[$c]['Call Back(FB)'] = @$user['call_back'];
				
				if(isset($user['call_back_date_start(FB)']) && $user['call_back_date_start']!='' && $user['call_back_date_start']!='0000-00-00')
				{
					$s_user[$c]['Call Back Date(FB)'] =  date('d-M-Y',strtotime(@$user['call_back_date_start'])).' to '.date('d-M-Y',strtotime(@$user['call_back_date_end']));
				}else{
					$s_user[$c]['Call Back Date(FB)'] =  "";
				}	
				
				$s_user[$c]['Targeted TimeLine For Commencement(FB)'] =  @$user['timelinename'];
				$z++;
				++$c;
			}
		}	
		/* echo "<pre>";
		print_r($s_user);die(); */ 
		$reportName = "UKIS_Sector_Wise_Call_Log_Report-" . date('Y-m-d_H:i:s');	    
        XlsExporter::downloadXls($reportName, $s_user, $reportName, true, false, $fields, 's_users'); 
		/* echo "<pre>";
		 print_r($s_user);die(); date('jS \of F Y h::i::s A')*/	
    }
	
	public function actionLastCallLogReport() {

        $fields = array(
            'Sno',
            'Master Reference No',
			'Project MRN No',
			'Announced MoU',
            'Calling Date',
            'Able To Connect',
            'Reason',
            'Calling Summary',
            'Representative Name',
            'Phone Number',
            'Email Id',
            'Land Requirement(FB)',
            'Area Requirement(FB)',
            'Area Unit(FB)',
			'District Preferences(FB)',
			'Area Under Possession(FB)',
			'Area Unit(FB)',
			'Address(FB)',
			'Tehsil(FB)',
			'District(FB)',
            'All Ready Have Financial Tie Up(FB)',
            'Forward Financial Institutions(FB)',
            'Meeting Requested With Dept(FB)',
            'Meeting Requested Date(FB)',
            'Meeting Agenda(FB)',
            'Call Back(FB)',
            'Call Back Date(FB)',
            'Targeted TimeLine For Commencement(FB)'
        );

        $sql = "SELECT du_pis_call_log.*,timeline.name as timelinename,pismou_detail.pis_mou_parent_id 
		FROM du_pis_call_log 
		LEFT JOIN du_timeline_commencement_master as timeline ON timeline.id = du_pis_call_log.timeline_for_commencement
		LEFT JOIN du_pis_mou_detail as pismou_detail ON pismou_detail.id=du_pis_call_log.pis_mou_detail_id WHERE du_pis_call_log.status = 'Y'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $resultData = $command->queryAll();
        $newdata = array();
		/* echo "<pre>";
        print_r($resultData); */
		$i = 0;
        foreach($resultData as $result) {
			/* $resultData[$i]['master_reference_no'] = "";
			if(isset($result['pis_mou_parent_id']) && !empty($result['pis_mou_parent_id']))
			{
				$sql = "SELECT master_reference_no FROM du_pis_mou_upload WHERE id IN ($result[pis_mou_parent_id])";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$mrnData = $command->queryRow();
				$resultData[$i]['master_reference_no'] = $mrnData['master_reference_no'];
			} */
			$resultData[$i]['meeting_request_dept_name'] = "";
			if(isset($result['meeting_request_dept']) && !empty($result['meeting_request_dept']))
			{				
				$sql = "SELECT name FROM bo_infowizard_issuerby_master WHERE issuerby_id IN ($result[meeting_request_dept])";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$deptData = $command->queryAll();
				if(isset($deptData) && !empty($deptData ))
				{	
					if(count($deptData) > 1)
					{
						$resultData[$i]['meeting_request_dept_name'] = implode(', ', array_column( $deptData, 'name'));
					}else{
						$resultData[$i]['meeting_request_dept_name'] = $deptData[0]['name'];
					} 
				}	
			}
			$resultData[$i]['distrcit_name'] = "";
			if(isset($result['area_requirement_district']) && !empty($result['area_requirement_district']))
			{
				$location = explode(",",$result['area_requirement_district']);
				if (in_array(718, $location)) {
					$distric_name[] = 'Entire State';
				}
				if (in_array(719, $location)) {
					$distric_name[] = 'Not decided yet';
				}
				
				$locationStr = implode(",", $location);
				if (!empty($locationStr)) {
					$connection = Yii::app()->db;
					$sql = "SELECT distric_name FROM bo_district WHERE district_id IN ($locationStr)";
					$command = $connection->createCommand($sql);
					$disArr = $command->queryAll();
					foreach ($disArr as $key => $val1) {
						$distric_name[] = $val1['distric_name'];
					}
				}
				$resultData[$i]['distrcit_name'] = implode(",", array_unique($distric_name));
								
			}
			$i++;	
        }
	/*  echo "<pre>";
        print_r($resultData);
		die;  */
        $s_user = array();
        $c = 0;
		$z = 1;
		$mrnarray=array();
        foreach($resultData as $key => $user) { 
			if(!in_array($user['master_reference_no'],$mrnarray)){
				$z = 1;
				$mrnarray[] = $user['master_reference_no'];
			}
			$s_user[$c]['Sno'] = $c + 1;
            $s_user[$c]['Master Reference No'] = $user['master_reference_no'];
			$s_user[$c]['Project MRN No'] = @$user['master_reference_no'].'.'. $z + 1;			
            $s_user[$c]['Calling Date'] =  @$user['calling_date'];
            $s_user[$c]['Able To Connect'] = @$user['able_to_connect'];
            $s_user[$c]['Reason'] =  @$user['reason'];
            $s_user[$c]['Calling Summary'] = @$user['calling_summary'];
            $s_user[$c]['Representative Name'] = @$user['name_of_representative'];
            $s_user[$c]['Phone Number'] = @$user['phone_number'];
            $s_user[$c]['Email Id'] =  @$user['email'];
            $s_user[$c]['Land Requirement'] = @$user['land_requirement'];
            $s_user[$c]['Area Requirement'] =  @$user['area_requirement'];
            $s_user[$c]['Area Unit'] = @$user['area_unit'];
            $s_user[$c]['District Preferences'] = @$user['distrcit_name'];
            $s_user[$c]['All Ready Have Financial Tie Up'] = @$user['financial_tie_up'];
            $s_user[$c]['Forward Financial Institutions'] = @$user['financial_partner'];
            $s_user[$c]['Meeting Requested With Dept'] = @$user['meeting_request_dept_name'];
            $s_user[$c]['Meeting Requested Date'] = @$user['meeting_request_start'].' to '.@$user['meeting_request_end'];
            $s_user[$c]['Meeting Agenda'] = @$user['metting_agenda'];
            $s_user[$c]['Call Back'] = @$user['call_back'];
            $s_user[$c]['Call Back Date'] = @$user['call_back_date_start'].' to '.@$user['call_back_date_end'];
            $s_user[$c]['Targeted TimeLine For Commencement'] =  @$user['timelinename'];
			$z++;
			++$c;
        }
		/* echo "<pre>";
        print_r($s_user);die(); */
		$reportName = "UKIS_Last_Call_Log_Report-" . date('Y-m-d_H:i:s');
        XlsExporter::downloadXls($reportName, $s_user, $reportName, true, false, $fields, 's_users');  
    }
}
