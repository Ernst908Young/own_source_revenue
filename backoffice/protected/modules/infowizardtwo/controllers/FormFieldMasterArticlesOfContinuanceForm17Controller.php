<?php

class FormFieldMasterArticlesOfContinuanceForm17Controller extends Controller
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'view', 'allFormFieldAjax', 'getMasterList','slugify','pageOption','saveAddmoreSubformData','getAddmoreData','getFormHtml'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','saveAjax', 'saveAjaxMaster', 'deleteAjax'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	public function actionCreate()
	{
		$model=new InfowizFormfieldOption;


		$this->render('create',array(
                            'model'=>$model
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

		if(isset($_POST['InfowizFormfieldOption']))
		{
			$model->attributes=$_POST['InfowizFormfieldOption'];
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
		$dataProvider=new CActiveDataProvider('InfowizFormfieldOption');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InfowizFormfieldOption('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InfowizFormfieldOption']))
			$model->attributes=$_GET['InfowizFormfieldOption'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInformationWizardArchitectStructuralEngineerMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInformationWizardArchitectStructuralEngineerMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInformationWizardArchitectStructuralEngineerMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-information-wizard-architect-structural-engineer-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
         /**
	 * Returns all body of a issuer
          *
          * Author: Rahul Kumar
	 */
        
        public static function getAllBodyOfIssuer($id){
			$connection=Yii::app()->db; 
			$sql="SELECT formvar_id,name FROM bo_infowizard_formvariable_master where formvar_id='$id' AND is_formvar_active='Y' ORDER BY formvar_id DESC";
			$command=$connection->createCommand($sql);
			//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$AppList=$command->queryAll();
			if($AppList===false)
				return false;	
			return $AppList;
		}
		
		
		
		  /**
	 * Returns all  
          *
          * Author: Jitendra singh
		  * Date:24-03-2018
	 */
        
        public static function getAllFormField($id){
			$connection=Yii::app()->db; 
			$sql="SELECT  id,formfield_id,options,type FROM bo_infowiz_formfield_options where formfield_id='$id' AND is_active='Y' ORDER BY id DESC";
			$command=$connection->createCommand($sql);
			//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$AppList=$command->queryAll();
			if($AppList===false)
				return false;	
			return $AppList;
		}
		
		
    public function actionSaveAjax()
	{
		
	    $flag =false;
		if(isset($_POST['options']) && !empty($_POST['options']))
		{
			
			$this->actionDeactivate($_POST['formvar_id']);
			
			foreach($_POST['options'] as $val){
				$criteria=new CDbCriteria;
				$formvar_id  =$_POST['formvar_id'];
			    $type        =$_POST['type'];
				$criteria->condition="formfield_id=:formfield_id AND options=:options AND type=:type ";
				$criteria->params=array(":formfield_id"=>$formvar_id,":options"=>$val,":type"=>$type);
				$model =InfowizFormfieldOption::model()->find($criteria); 
				if(!$model){
				    $model=new InfowizFormfieldOption;
                    $model->created     =  date('Y-m-d H:m:s');
					$model->is_active    =   'Y';					
				}else{
					   	$model->modified     =  date('Y-m-d H:m:s');
						$model->is_active    =   'Y';
					}
				
				$model->options=$val;
				$model->formfield_id= $formvar_id;
				$model->type        = $type;
				$model->remote_ip   = Yii::app()->request->getUserHostAddress();
				$model->user_agent  = Yii::app()->request->userAgent;
				//$model->save();
				//print_r($model->getErrors());die;
				if($model->save())
				$flag =true;
				else
				$flag = false;
			}
		
		}

		echo  $flag;
	}

	public function actionDeleteAjax()
	{
		
	  
		$flag =false;
		if(isset($_POST['option_id']) && !empty($_POST['option_id']))
		{
			    $option_id =$_POST['option_id'];
			    $criteria=new CDbCriteria; 
				$criteria->condition="id=:option_id";
				$criteria->params=array(":option_id"=>$option_id);
				$model =InfowizFormfieldOption::model()->find($criteria);
                $model->is_active ='N';				
			  if($model->save())
				$flag =true;
				else
				$flag = false;
		}
		
		echo json_encode(array('flag'=>$flag));
	}
	
	public function actionAllFormFieldAjax($id){
		 
		$result_data =array();
		$connection=Yii::app()->db; 
		
		/* @ Get master_table_id
		   @ Pankaj Kumar tiwari
		   @4 March 2018 */
		
		$sql="SELECT  bo.id, bo.master_table_id, bo.formfield_id, bo.options, bo.type, bm.title FROM bo_infowiz_formfield_options as bo LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id WHERE bo.formfield_id='$id' AND bo.is_active='Y'  ORDER BY bo.id DESC";
		$command=$connection->createCommand($sql);
		
		//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		$AppList=$command->queryAll();
		//echo "<pre/>";
		//print_r($AppList);die;
		if($AppList===false){
			$result_data['data']= false;
		}else{
			$result_data['data']= $AppList;
		}
		
		echo json_encode($result_data);
	}
	
	
	/*  @ Get Master List
		@ Pankaj Kumar Tiwari 
		@ 3 March 2018 */
	
	
		public  function actionGetMasterList($query){
			
			$result_data =array();
			$data =array();
			
			$connection=Yii::app()->db; 
			$sql="SELECT  id, title FROM bo_master_tables WHERE title LIKE '%".$query."%' ORDER BY id DESC";
			$command=$connection->createCommand($sql);
			$result_data=$command->queryAll();
			
			if(!empty($result_data)){
				foreach($result_data as $rd){
						$data[] = array (
							'label' => $rd['title'],
							'value' => $rd['id'],
						);
				}
			}			
			
			
			echo json_encode($data);  exit();
			
		}
		
	/*  @ Save Master Data
		@ Pankaj Kumar Tiwari 
		@ 4 March 2018 */	
		
		
		 public function actionSaveAjaxMaster()
	    {
		
		    $flag =false;
			if(isset($_POST['master_table_id']) && !empty($_POST['master_table_id']))
			{
				
				    $this->actionDeactivate($_POST['formvar_id']);
				
					$criteria=new CDbCriteria;
					$formvar_id       = $_POST['formvar_id'];
					$type             = $_POST['type'];
					$master_table_id  = $_POST['master_table_id'];
					$val              = $_POST['title'];
					$criteria->condition="master_table_id=:master_table_id AND formfield_id=:formfield_id AND options=:options AND type=:type ";
					$criteria->params=array(":master_table_id"=>$master_table_id,":formfield_id"=>$formvar_id,":options"=>$val,":type"=>$type);
					$model =InfowizFormfieldOption::model()->find($criteria); 
					if(!$model){
						$model=new InfowizFormfieldOption;  
						$model->created     =  date('Y-m-d H:m:s');
						$model->is_active    =   'Y';
					}else{
					   	$model->modified     =  date('Y-m-d H:m:s');
						$model->is_active    =   'Y';
					}
					
					$model->master_table_id= $master_table_id;
					$model->options=$val;
					$model->formfield_id= $formvar_id;
					$model->type        = $type;
				    $model->remote_ip   = Yii::app()->request->getUserHostAddress();
					$model->user_agent  = Yii::app()->request->userAgent;
					$model->save();
					print_r($model->getErrors());die;
					if($model->save())
					   $flag =true;
					else
					   $flag = false;
				
			
			}

			echo  $flag;
		}
		
	/*  @ Deactivate Previous Saved Data
		@ Pankaj Kumar Tiwari 
		@ 4 March 2018 */	
		
		
		public function actionDeactivate($formfield_id)
	    {
			
			    $connection=Yii::app()->db; 
		        $connection->createCommand("UPDATE bo_infowiz_formfield_options SET is_active='N' WHERE formfield_id=$formfield_id")->execute();
				
				
		}
		
		
		/* 
		* @Author : Rahul Kumar
		* @Date   : 06042018
		* @Description :  It will slugify a string 
		*/
	 public function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	
	public function actionPageOption($page_id, $button_id){
		$connection=Yii::app()->db; 		
		$sql = "SELECT a.id as idd ,CONCAT(b.formchk_id,' : ', b.name) as name, a.service_id,a.input_type  FROM bo_information_wizard_form_builder a JOIN bo_infowizard_formvariable_master b ON b.formvar_id=a.form_field_id WHERE a.page_name='$page_id' AND a.is_active='Y'";
		
        $command = $connection->createCommand($sql);
        $allData = $command->queryAll();
       
        //TO DO for selected_field_id 
        $html = '';
        foreach ($allData as $value) {
        	$id = $value['idd'];
        	$service_id = $value['service_id'];
        	$input_type = $value['input_type'];
        	//$selected_field_id = $value['selected_field_id'];
        	$sql1 ="SELECT selected_field_id FROM bo_infowiz_subform_addmore_master WHERE page_id=$page_id AND service_id=$service_id AND selected_field_id=$id AND button_id=$button_id AND is_active='Y'";
        	$command1 = $connection->createCommand($sql1);
        	$allData1 = $command1->queryRow();
        	//echo $allData1['id'];
        	if($allData1['selected_field_id']==$id)
        		$selected='selected';
        	else $selected = '';
        	if($input_type !='add_more_button')
        	$html .="<option value='$id' $selected>".$value['name']."</option>";
        }
        echo json_encode($html);
	}
	public function actionSaveAddmoreSubformData()
	{		
		$flag =false;
		//print_r($_POST);
		//die();//
		if(!empty($_POST['add_more_form_field']))
		{				
			//$this->actionDeactivate($_POST['formvar_id']);
			//print_r($_POST['add_more_form_field']); die;
			$page_id  =$_POST['page_id'];
			$button_id =$_POST['button_id'];
			$service_id = $_POST['service_idds'];
			$fields_id = $_POST['add_more_form_field'];
			$connection=Yii::app()->db; 
			$fields_id = implode(', ', $fields_id);	
			$sql = "SELECT selected_field_id FROM bo_infowiz_subform_addmore_master where page_id=".$page_id." AND selected_field_id NOT IN (".$fields_id.")  AND button_id=".$button_id." AND is_active='Y'";
			$command = $connection->createCommand($sql);
			$allData = $command->queryAll();
			$removed_row = $allData;
			$i=0;
			foreach($_POST['add_more_form_field'] as $val){
				$criteria=new CDbCriteria;
				
				$criteria->condition="selected_field_id=:selected_field_id AND is_active=:is_active AND button_id=:button_id";
				$criteria->params=array(":selected_field_id"=>$val,":is_active"=>'Y',':button_id'=>$button_id);
				$model =InfowizSubformAddmoreMaster::model()->find($criteria); 
				//print_r($model); die;
				if(!$model){
					$model=new InfowizSubformAddmoreMaster;
					$model->create_at     =  date('Y-m-d H:m:s');
					$model->is_active    =   'Y';					
					$model->prefrence    =   $i++;					
				}else{
						$model->updated_at     =  date('Y-m-d H:m:s');
						$model->is_active    =   'Y';
					}
				
				$model->selected_field_id=$val;
				$model->page_id= $page_id;
				$model->button_id = $button_id;
				$model->service_id = $service_id;
				//$model->save();
				//print_r($model->getErrors());die;
				if($model->save())
				$flag =true;
				else
				$flag = false;
			}
			if(count($removed_row)>0){
				//print_r($removed_row); die;
				foreach($removed_row  as $rr){
					$criteria1=new CDbCriteria;
					$criteria1->condition="selected_field_id=:selected_field_id AND is_active=:is_active ";
					$criteria1->params=array(":selected_field_id"=>$rr['selected_field_id'],":is_active"=>'Y');
					$model1 =InfowizSubformAddmoreMaster::model()->find($criteria1);
					//print_r($model1);					
					if($model1){
						$model1->updated_at     =  date('Y-m-d H:m:s');
						$model1->is_active    =   'N';	
						$model1->save();				
					}
				}
			}							
		}
		echo  $flag;
	}
	public function actionGetAddmoreData()
	{
		$data =array();
		///$_Data=array();
		//print_r($_GET); die;
		if(!empty($_GET['button_id']) && !empty($_GET['service_id']))
		{
			$button_id = $_GET['button_id'];
			$service_id = $_GET['service_id'];
			$add_more_button_di = $_GET['add_more_button_di'];
			$connection=Yii::app()->db; 	
			//"SELECT * FROM bo_infowiz_subform_addmore_master where page_id=".$id;	
			$sql = "SELECT * FROM bo_infowiz_subform_addmore_master WHERE is_active='Y' AND page_id=".$button_id." AND button_id=".$add_more_button_di." Order BY prefrence ASC";		
			$command = $connection->createCommand($sql);
			$allData = $command->queryAll();
			//echo "<pre>"; print_r($allData);
			foreach($allData as $dat){
				$sql1= "SELECT 
							service_id,a.id as idd ,CONCAT(b.formchk_id,' : ', b.name) as full_name, b.formchk_id
						FROM 
							`bo_information_wizard_form_builder`a  
						join 
							bo_infowizard_formvariable_master b 
							ON b.formvar_id=a.form_field_id
						WHERE 
							a.page_name=".$dat['page_id']."
							AND 
								a.service_id=".$service_id."
							AND 
								a.id=".$dat['selected_field_id'];
				$command = $connection->createCommand($sql1);
				$data[] = $command->queryRow();
			
			 
		}
		//echo "<pre>"; print_r(array_filter($data));die;
		echo json_encode($data);
	}
		else{
			return $data;
		}
		

	}	
        
        public function actionGetFormHtml(){
		
		if(!empty($_GET['app_Sub_id']) && !empty($_GET['service_id']) && !empty($_GET['form_id'])){
			$connection=Yii::app()->db;
			$app_Sub_id = $_GET['app_Sub_id'];
			$service_id = $_GET['service_id'];
			$form_id = $_GET['form_id'];
			$idds = $_GET['idds'];
			$next_role_id = @$_GET['next_role_id'];
			$created_on = @$_GET['created_on'];
			$app_status = $_GET['app_status'];
			$statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending','V'=>'Verified','PF'=>'Forwarded','AB'=>'Abeyance','DP'=>'Document Pending','FA'=>'Forward to Approver');
			$app_status_val =$statusArray[$app_status] ;
			
			$selectedDept = array();
			$approvalID = "";
			//$approvalID = Yii::app()->db->createCommand("SELECT approval_id FROM bo_new_application_submission WHERE submission_id=$_GET[app_Sub_id]")->queryRow();
			if(isset($approvalID['approval_id']) && !empty($approvalID['approval_id']))
			{
				$approval_id = $approvalID['approval_id'];
				$selectedDept = Yii::app()->db->createCommand("SELECT dept_id FROM bo_infowiz_approval_require WHERE infowiz_approval_master_id=$approval_id and status='Y' group by dept_id")->queryAll();
			}	
			/* echo "<pre>";
			print_r($_GET);die; */

			if($_GET['table']=='Department'){
				
					$sql = "SELECT a.*,b.name as department_name,c.role_name,bo_new_application_submission.application_status  
					FROM bo_infowiz_formbuilder_application_forward_level a 
					JOIN bo_infowizard_issuerby_master b ON b.issuerby_id = a.forwarded_dept_id
					JOIN bo_roles c ON c.role_id = a.next_role_id 
					LEFT JOIN bo_new_application_submission ON bo_new_application_submission.submission_id=a.app_Sub_id
					WHERE  appr_lvl_id=$idds";
					$command = $connection->createCommand($sql);
			 		$data = $command->queryRow();
					
			 		if($data['post_info'] && $data['approv_status'] !='V'  ||  $app_status=='PF'){
					
			 			 $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
						 
			 			$fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
						$form_fieldValues = (array)json_decode($fieldValues['field_value']);
						
						//$form_fieldValues = (array)(json_decode($data['post_info']));
						$formData = InfowizardQuestionMasterExt::alignInSequence($service_id,1);
					
						$processingformData = InfowizardQuestionMasterExt::alignInSequence($service_id,$form_id);
						
			 			$this->renderPartial('/formBuilder/subformloggerview_articlesofcontinuanceform17', array('aap' => $allActivePages, 'formData' => $formData,'fieldValues'=>$form_fieldValues,'processingformData'=>$processingformData,'service_id'=>$service_id,'sub_id'=>$app_Sub_id,'formCodeID'=>$form_id,'is_dept_active'=>'yes','selectedDept'=>$selectedDept));
			 		}		 		

			 		else if($data['post_info']=='' && $next_role_id== $_SESSION['role_id']){
					
			 			$allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();	//print_r($allActivePages);		 			
						
						$formData = InfowizardQuestionMasterExt::alignInSequence($service_id,1);
						//print_r($formData);
						//die("dssd");
						///echo "SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC";
						$allProcessingFormFieldsArr = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
					
						$processingformData = InfowizardQuestionMasterExt::alignInSequence($service_id,$form_id);
						$fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$app_Sub_id")->queryRow();
						$fieldValues2 = (array)json_decode($fieldValues['field_value']);
	
			 			$this->renderPartial('/formBuilder/subformloggerview_incorporation', array('aap' => $allActivePages, 'formData' => $formData,'fieldValues'=>$fieldValues2,'processingformData'=>$processingformData,'service_id'=>$service_id,'sub_id'=>$app_Sub_id,'formCodeID'=>$form_id,'is_dept_active'=>'yes','selectedDept'=>$selectedDept));
			 		}
			 		else if($data['application_status']=='H'){
			 			echo '
							<table class="table table-striped table-bordered table-hover">						
								<tr>
									<td><strong style="color: #333;">Status: </strong>'.$app_status_val.'</td>
									<td><strong style="color: #333;">Action Taken On: </strong> '.$created_on.'</td>	
								</tr>
								<tr>
									<td colspan="2"><strong >Action Type: Application is Reverted to Investor</td>
								</tr>						
							</table>';		 			
			 		}else{
						echo '
							<table class="table table-striped table-bordered table-hover">						
								<tr>
									<td><strong style="color: #333;">Status: </strong>'.$app_status_val.'</td>
									<td><strong style="color: #333;">Action Taken On: </strong> '.$created_on.'</td>	
								</tr>
								<tr>
									<td colspan="2"><strong >Action Type: </strong>Application is currently on pending status with  <strong>'.$data['department_name'].'</strong>('.$data['role_name'].')</td>
								</tr>						
							</table>';	
					}	
			}
			else if($_GET['table']=='Verified' && $_GET['app_status'] =='V'){
				$core_department_id = $_GET['core_department_id'];
				$sql = "SELECT post_info,form_id from bo_infowiz_formbuilder_application_forward_level WHERE forwarded_dept_id=$core_department_id  AND app_Sub_id=$app_Sub_id";
				$command = $connection->createCommand($sql);
		 		$data2 = $command->queryRow();

		 		$allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
			 			
				$form_fieldValues = (array)(json_decode($data2['post_info']));
				//echo "<pre/>"; print_r($form_fieldValues);
				$formData1 = InfowizardQuestionMasterExt::alignInSequence($service_id,1);
				$formData2 = InfowizardQuestionMasterExt::alignInSequence($service_id,$data2['form_id']);

				$formData = array_merge($formData1,$formData2);
				//echo "<pre/>"; print_r($formData);
				$allProcessingFormFieldsArr = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
	
				$processingformData = InfowizardQuestionMasterExt::alignInSequence($service_id,$form_id);

	 			$this->renderPartial('/formBuilder/subformloggerview_articlesofcontinuanceform17', array('aap' => $allActivePages, 'formData' => $formData,'fieldValues'=>$form_fieldValues,'processingformData'=>$processingformData,'service_id'=>$service_id,'sub_id'=>$app_Sub_id,'formCodeID'=>$form_id,'is_dept_active'=>'no','selectedDept'=>$selectedDept));
	 		}
			else{
				$sql ="SELECT a.field_value from bo_infowiz_form_builder_investor_logs a 
				JOIN bo_infowiz_form_builder_application_log b
				ON  a.id = b.investor_log_id 
				WHERE  b.service_id='$service_id' AND a.form_id=$form_id AND a.submission_id=$app_Sub_id";
				$command = $connection->createCommand($sql);
				$data = $command->queryRow();
				//print_r($data); die;
				$dat = $data['field_value'];
				if($data['field_value']){
					$allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
				
					$form_fieldValues = (array)(json_decode($data['field_value']));
					//echo "<pre/>"; print_r($form_data_);
					$formData = InfowizardQuestionMasterExt::alignInSequence($service_id,1);
					//echo "<pre/>"; print_r($formData);
					$allProcessingFormFieldsArr = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$service_id AND is_active='Y' AND form_id = $form_id order by prefrence ASC")->queryAll();
		
					$processingformData = InfowizardQuestionMasterExt::alignInSequence($service_id,$form_id);

					$this->renderPartial('/formBuilder/subformloggerview_articlesofcontinuanceform17', array('aap' => $allActivePages, 'formData' => $formData,'fieldValues'=>$form_fieldValues,'processingformData'=>$processingformData,'service_id'=>$service_id,'sub_id'=>$app_Sub_id,'formCodeID'=>$form_id,'is_dept_active'=>'yes','selectedDept'=>$selectedDept));
				}
				else{
					echo "<p><strong>Application is currently on pending status with".$data['department_name']."</strong>(".$data['role_name'].")</p>";			 			
				} 
			 			
			}
			
		}
		
	}
        
}
