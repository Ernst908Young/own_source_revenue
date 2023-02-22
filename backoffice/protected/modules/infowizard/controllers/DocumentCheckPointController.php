<?phpclass DocumentCheckPointController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public function accessRules()
	{		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array( 'view', 'getDataByCategory','addChekListmapping'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	
	 

	public function actionView($id)
	{
        $model=$this->loadModel($id); 
		$this->render('view',array('model'=>$model));

	} 

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	public function actionCreate()
     {   
       
		   //echo "hi..";die;	 
			$model=new DocumentCheckPointMaster; 
			if(!empty($_POST))
			{   
		         $model->code          =$_POST['DocumentCheckPointMaster']['code']; 
				 $model->name          =$_POST['DocumentCheckPointMaster']['name']; 
				 $model->is_active     =$_POST['DocumentCheckPointMaster']['is_active'];
				 $model->created       =date('Y-m-d h:i:s'); 					if(isset($_FILES['dms_doc_uploads']['name'])){						$ext = pathinfo($_FILES['dms_doc_uploads']['name'], PATHINFO_EXTENSION);						if(strtolower($ext) == 'pdf'){						$path = "/var/www/html/uploads/";						$new_name = time().".pdf";						$fname = '/uploads/'.$new_name;						move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path.$new_name);						$model->file_path = $fname;						}					}
				// $model->save();
				 //print_r($model->getErrors());die;
				 if($model->save()){
					 
					 /*$pk =str_pad(($model->parent_id)?$model->parent_id:$model->id, 3, "0", STR_PAD_LEFT);
					 $count = DocumentCheckPointMaster::model()->countByAttributes(array('parent_id'=> ($model->parent_id)?$model->parent_id:$model->id));
					 $category_code ='UK-CAT-'.$pk.'_'.$count;
					 Yii::app()->db->createCommand()->update('bo_infowiz_form_categories', array('category_code'=>$category_code), 'id=:id', array(':id'=> $model->id));*/
					 $this->redirect(array('index'));
				 } 
				 
			} 
        
		   $this->render('create',array(

				'model'=>$model,

			)); 

	} 		public function actionCreateNew()     {          		   //echo "hi..";die;	 			$model=new DocumentCheckPointMaster; 			if(!empty($_POST))			{   		         $model->code          =$_POST['DocumentCheckPointMaster']['code']; 				 $model->name          =$_POST['DocumentCheckPointMaster']['name']; 				 $model->is_active     =$_POST['DocumentCheckPointMaster']['is_active'];				 $model->created       =date('Y-m-d h:i:s'); 				// $model->save();				 //print_r($model->getErrors());die;				 if($model->save()){					 					 /*$pk =str_pad(($model->parent_id)?$model->parent_id:$model->id, 3, "0", STR_PAD_LEFT);					 $count = DocumentCheckPointMaster::model()->countByAttributes(array('parent_id'=> ($model->parent_id)?$model->parent_id:$model->id));					 $category_code ='UK-CAT-'.$pk.'_'.$count;					 Yii::app()->db->createCommand()->update('bo_infowiz_form_categories', array('category_code'=>$category_code), 'id=:id', array(':id'=> $model->id));*/					 //$this->redirect(array('index'));					 $this->redirect(Yii::app()->request->urlReferrer);				 } 				 			}         	} 

	public function actionUpdate($id)
	{ 
	
	    
         $model=$this->loadModel($id);  
         $application=$this->getFormTypesData();  
		 
        if(!empty($_POST)){  
		
     		//print_r($_POST['FormType']['form_name']); die;
			   /*if(isset($_POST['FormCategory']['parent_id']) && !empty($_POST['FormCategory']['parent_id'])){  
				 
					 $model->parent_id =$_POST['FormCategory']['parent_id']; 
				}*/

            //$model->service_id=$_POST['service_id'];  
			//$model->dept_id   =$_POST['dept_id'];
			 $model->name           =$_POST['DocumentCheckPointMaster']['name']; 
			 $model->is_active     =$_POST['DocumentCheckPointMaster']['is_active'];
			 $model->modified      =date('Y-m-d h:i:s'); 
			 //$formType->save();
			 //print_r($formType->getErrors());die;
			 if($model->save()){  
					 
				    $this->redirect(array('index'));
			 } 
			 
        } 

        $this->render('update',array('apps'=>$application,'model'=>$model));

    }
 

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */



	

	public function actionIndex()

	{   
	
	
		$model=new DocumentCheckPointMaster;  
		$application=$this->getFormTypesData();  
        $formsData =Yii::app()->db->createCommand("SELECT  id , name FROM  bo_infowiz_dcp_master  WHERE is_active='Y' ORDER BY  id desc limit 1")->queryAll();

		//print_r($formsData['0']['id']+1);die;
		if($formsData){
		$form_code =str_pad($formsData['0']['id']+1, 4, "0", STR_PAD_LEFT);
		}else{
		$form_code =str_pad(1, 4, "0", STR_PAD_LEFT);
		}
		$form_code= 'UK-DCP-'.$form_code;
        $model->code=$form_code;
		$this->render('index',array(

			'apps'=>$application,'model'=>$model

		));

	}			public function actionIndexNew()	{   				$model=new DocumentCheckPointMaster;  		$application=$this->getFormTypesData();          $formsData =Yii::app()->db->createCommand("SELECT  id , name FROM  bo_infowiz_dcp_master  WHERE is_active='Y' ORDER BY  id desc limit 1")->queryAll();		//print_r($formsData['0']['id']+1);die;		if($formsData){		$form_code =str_pad($formsData['0']['id']+1, 4, "0", STR_PAD_LEFT);		}else{		$form_code =str_pad(1, 4, "0", STR_PAD_LEFT);		}		$form_code= 'UK-DCP-'.$form_code;        $model->code=$form_code;		$this->renderPartial('index_new_up',array(			'apps'=>$application,'model'=>$model		));	}

    
/**

	 * Lists all models.

	 */
	 
  public function getFormTypesData()
	{   
 
	    $formsData =Yii::app()->db->createCommand("SELECT  * FROM  bo_infowiz_dcp_master")->queryAll(); 
		if($formsData===false)
		return false;
		return $formsData; 
    }

	 

 
	public function loadModel($id)

	{

		$model= DocumentCheckPointMaster::model()->findByPk($id);

		if($model===null)

			throw new CHttpException(404,'The requested page does not exist.');

		return $model;

	} 
	
	 /* jitendra singh 03052018*/
    
    public function partialDocumentCheckPoinMappingLayout(){
       $this->render('partialDocumentCheckPoinMappingLayout');  
    }
	 
	  public function actionDocumentCheckPointlist() {

        if (!empty($_POST)) {
            $s_id = @$_POST['service_id'];
			//echo "<pre/>";
			//print_r($_POST);die;
			$qstr="";
			if(isset($_POST['srt']) && !empty($_POST['srt'])){
				$str =strtolower($_POST['srt']);
				$qstr.=" AND  LOWER(code) LIKE '%$str%'";
			}
				$sql_d = "SELECT * FROM bo_infowiz_dcp_master
				 WHERE  is_active='Y' $qstr ORDER BY  id ASC ";
			 
             $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_d);
            $res_d = $command->queryAll(); 
			//echo "<pre/>";
			//print_r($sql_d);die;
			 
            $this->renderPartial('partialDocumentCheckPoinMappingLayout', array('document_check_point_list' => $res_d,'documentchklist_id'=>$s_id));
          }else{
               $this->renderPartial('partialDocumentCheckPoinMappingLayout');
          }
    }
	
	 /* jitendra singh 03052018*/
    
	public function actionAddChekListmapping() {
             //session_start();
			$model = new DocumentCheckListMapping; 
			$msg='';
		
		   if (!empty($_POST)){
			   
			  // foreach($_POST['documentCheckListMapping'] as $key=>$document_checklist_id){
				   
				     $data=$model= $model::model()->findByAttributes(array('docchk_id' => $_POST['documentchklist_master_id'],'is_active'=>'Y'));
			   
					if (!empty($data)) {
							//$model = $model::model()->findByAttributes(array('id' => $_POST['id']));
							$model->update = date('Y-m-d H:i:s');
						} else {
							$model = new DocumentCheckListMapping;
							$model->created = date('Y-m-d H:i:s'); //
					  }
					$model->docchk_id = $_POST['documentchklist_master_id'];
					$model->document_checklist_id =  json_encode($_POST['documentCheckListMapping']);
					$model->is_active = "Y";
					$model->ip_address = $_SERVER['REMOTE_ADDR'];
					$model->user_agent = $_SERVER['HTTP_USER_AGENT'];
					$model->user_id    = $_SESSION['uid'];
                       //$model->save();
                       //print_r($model->getErrors());  exit();
					if ($model->save()) {
					   $msg ="Document Check List Mapping   has been saved ";  
					 
					} else {
						 $msg= "Data saving failed. Please try again.";
						 
					}
			
			   //}
			   /* $criteria=new CDbCriteria;
				$criteria->addInCondition('document_checklist_id',$_POST['documentCheckListMapping']);
				$criteria->condition = "master_id=:master_id";
                $criteria->params = array(":master_id" => $_POST['documentchklist_master_id']);
			    $formsData =Yii::app()->db->createCommand("SELECT  * FROM  bo_infowiz_dcp_master  WHERE is_active='Y' ")->queryAll(); 
				Yii::app()->db->createCommand()->update('bo_infowiz_document_check_list_mapping', array('is_active'=>'N',), 'master_id=:master_id', array(':master_id'=>$_POST['documentchklist_master_id']));
				if(!empty($_POST['documentchklist_master_id']) && !empty($_POST['documentCheckListMapping'])){
					$master_id =$_POST['documentchklist_master_id']; 
					Yii::app()->db->createCommand("UPDATE bo_infowiz_document_check_list_mapping SET is_active='N' WHERE master_id=$master_id AND document_checklist_id NOT IN  ('".implode(',',$_POST['documentCheckListMapping'])."') ")->execute();
				}
			   */
		   }
         

    echo $msg;die;
        
    }
	
	public static function documentCheckListMapping($master_id,$document_checklist_id){
		$connection = Yii::app()->db;
		//echo $dept_id;
		//$sql="SELECT sp_id,service_provider_name,service_provider_tag FROM sso_service_providers WHERE is_service_provider_active = :isactive";
		$sql = "SELECT  id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id=:docchk_id AND document_checklist_id=:document_checklist_id   AND is_active='Y'";
		$command = $connection->createCommand($sql);
		$command->bindParam(":docchk_id", $master_id, PDO::PARAM_INT);
		$command->bindParam(":document_checklist_id", $document_checklist_id, PDO::PARAM_INT);
		//$command->bindParam(":form_type_id", $form_type, PDO::PARAM_INT);
		$row= $command->queryRow();  
		if ($row === false)
			return false;
		return  true;
	}

	public static function getDocumentCheckListMapping($master_id ){
		
		$connection = Yii::app()->db; 
		$sql     = "SELECT  document_checklist_id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id=:docchk_id  AND is_active='Y'";
		$command = $connection->createCommand($sql);
		$command->bindParam(":docchk_id", $master_id, PDO::PARAM_INT);
		//$command->bindParam(":document_checklist_id", $document_checklist_id, PDO::PARAM_INT);
		//$command->bindParam(":form_type_id", $form_type, PDO::PARAM_INT);
		$row= $command->queryRow();  
		if ($row === false)
			return false;
		return  json_decode($row['document_checklist_id'],true);
	}			public function actionNewCheckpoint(){		@extract($_REQUEST);		if($s_id){			$connection = Yii::app()->db; 			$sql = "SELECT  * FROM bo_information_wizard_service_parameters WHERE service_id='$s_id'  AND servicetype_additionalsubservice='$sub_id'  AND `is_active` = 'Y'";			$command = $connection->createCommand($sql);			$row= $command->queryRow();  			// echo '<pre>'; print_r($row);			$this->render('index_new',array(			'apps'=>$row		));		}	}		public function actionNewCheckpointSave(){		@extract($_REQUEST);		//echo '<pre>'; print_r($_REQUEST);		if(!isset($ids))		{echo 'Please select atleast one checkpoint.'; return;}		$connection = Yii::app()->db; 		$sql = "UPDATE bo_infowiz_document_check_list_mapping_new SET is_active='0' WHERE service_id='$sub'  AND docchk_id='$did'";		$command = $connection->createCommand($sql);		$command->query(); 				$json_data = json_encode($ids);				list($service_id1,$service_id2) = explode(".",$sub);		$sql11 = "SELECT  swcs_service_id FROM bo_information_wizard_service_parameters WHERE service_id='$service_id1' AND servicetype_additionalsubservice='$service_id2' AND `is_active` = 'Y' LIMIT 1";		$command = $connection->createCommand($sql11);		$row111= $command->queryRow(); 		$swcs_id = NULL;		if($row111){			$swcs_id = $row111['swcs_service_id'];		}				$sql1 = "INSERT INTO bo_infowiz_document_check_list_mapping_new SET is_active='1',swcs_id='$swcs_id',service_id='$sub',docchk_id='$did',document_checklist_id='$json_data'";		$command = $connection->createCommand($sql1);		$command->query();		echo "success";	}		public function actionNewCheckpointSaveMe(){		@extract($_REQUEST);		$sql1 = "INSERT INTO bo_infowiz_dcp_master SET is_active='$cdona',name='$cdon',code='$cdo'";		$connection = Yii::app()->db; 		$command = $connection->createCommand($sql1);		$command->query();		echo "success";	}			public function actionGetDCPName(){		@extract($_REQUEST);		if($dcp){			$connection = Yii::app()->db; 			$sql = "SELECT  * FROM bo_infowiz_dcp_master WHERE UCASE(code)='$dcp' AND `is_active` = 'Y' LIMIT 1";			$command = $connection->createCommand($sql);			$row= $command->queryRow();  			// echo '<pre>'; print_r($row);			if($row){				echo $row['name'];			}else{				echo "NA";			}		}	}

}

