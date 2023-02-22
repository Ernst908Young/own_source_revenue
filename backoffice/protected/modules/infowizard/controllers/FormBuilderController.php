<?php
class FormBuilderController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST requestgetMappedCategoryWithPage
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules

      /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
   /* public function actionSubform() {
		
        if (!empty($_GET['service_id'])) {
            
            $user_id=@$_SESSION['RESPONSE']['user_id'];
            $serviceID = "'" . $_GET['service_id'] . "'";
			if(isset($user_id) && !empty($user_id))
			{
				$resultData= Yii::app()->db->createCommand("SELECT submission_id,application_status FROM bo_new_application_submission where service_id=$serviceID AND application_status IN ('I','PD','DP') AND user_id=$user_id")->queryRow();
				
				//print_r($resultData);die;
				if(!empty($resultData) && (($resultData['application_status']=='I') || ($resultData['application_status']=='DP'))){
					$this->redirect("/backoffice/infowizard/subForm/updateSubForm/service_id/$_GET[service_id]/pageID/$_GET[pageID]/subID/$resultData[submission_id]/formCodeID/$_GET[formCodeID]");
				}
				
				if(!empty($resultData) && $resultData['application_status']=='PD'){
					$sno=ApplicationSubmissionExt::getSnoBySubmissionId($resultData['submission_id'],'sno');
					
					$this->redirect("/backoffice/infowizard/payment/paymentRedirect/sno/$sno");
				}
			}
			
			$formCodeID = $_GET['formCodeID'];
			
			
			$additionalCondition = "";
           
			if(isset($formCodeID) && !empty($formCodeID)){$additionalCondition = " AND form_id=$formCodeID ";}
			
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();

            extract($_GET);			
            
			$formData=$this->alignInSequence($service_id,$formCodeID);

			
			$appStatus = "";
			$field_value = "";
			if($service_id=='577.0' && isset($_SESSION['RESPONSE']['user_id']))
			{	
				$appModel = new ApplicationExt;
				$deptModel  = new DepartmentsExt;				
				
				$uid        = @$_SESSION['RESPONSE']['user_id'];
				$dept_id    = $deptModel->getDeptIdFromUniqCode('DOI');
				$app_id     = $appModel->getAppIdFromName('CAF', $dept_id);
				$incmplt_fields = $appModel->getUsersCAFApplicationsOfUser($uid,$app_id);
				
				if(!empty($incmplt_fields)){           
					$appStatus = $incmplt_fields['application_status'];
					$field_value = json_decode($incmplt_fields['field_value']);
				}
			}

        }
		
        $this->render('subform', array('aap' => $allActivePages, 'formData' => $formData,'serviceID'=>$_GET['service_id'],'issuer_id'=>@$_POST['issuer_id'],'field_value'=>$field_value,'postedData'=>@$_POST));
    }*/
	
	
	public function actionSubform() {
		
        if (!empty($_GET['service_id'])) {
            
            $user_id=@$_SESSION['RESPONSE']['user_id'];
            $serviceID = "'" . $_GET['service_id'] . "'";
			/* echo "<pre>";
			print_r($_POST);die; */
			if(isset($user_id) && !empty($user_id))
			{
				$resultData= Yii::app()->db->createCommand("SELECT submission_id,application_status,service_id FROM bo_new_application_submission where service_id=$serviceID AND application_status IN ('I','PD','DP') AND user_id=$user_id")->queryRow();				
				
				if(!empty($resultData) && (($resultData['application_status']=='I') || ($resultData['application_status']=='DP'))){

                    $ser_controller_action = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_configuration WHERE service_id=$serviceID AND form_type_id=1")->queryRow();
                    $ser_controller_action_path = $ser_controller_action['form_action_controller'];

					$this->redirect("/backoffice/infowizard/$ser_controller_action_path/updateSubForm/service_id/$_GET[service_id]/pageID/$_GET[pageID]/subID/$resultData[submission_id]/formCodeID/$_GET[formCodeID]");
				}			
				else if(!empty($resultData) && $resultData['application_status']=='PD'){
					$this->redirect("/backoffice/infowizard/otherServicePayment/UnifiedPayment/service_id/$_GET[service_id]/app_id/$resultData[submission_id]"); 
				}
			}
			
			$formCodeID = $_GET['formCodeID'];			
			$additionalCondition = "";
            // Getting all active land records           
			if(isset($formCodeID) && !empty($formCodeID)){$additionalCondition = " AND form_id=$formCodeID ";}			
            $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();

            extract($_GET);
			$formData=$this->alignInSequence($service_id,$formCodeID);
			$appStatus = "";
			$field_value = "";
			if($service_id=='577.0' && isset($_SESSION['RESPONSE']['user_id']))
			{	
				$appModel = new ApplicationExt;
				$deptModel  = new DepartmentsExt;				
				
				$uid        = @$_SESSION['RESPONSE']['user_id'];
				$dept_id    = $deptModel->getDeptIdFromUniqCode('DOI');
				$app_id     = $appModel->getAppIdFromName('CAF', $dept_id);
				$incmplt_fields = $appModel->getUsersCAFApplicationsOfUser($uid,$app_id);
				
				if(!empty($incmplt_fields)){           
					$appStatus = $incmplt_fields['application_status'];
					$field_value = json_decode($incmplt_fields['field_value']);
				}
			}

        }
		/* echo "<pre>";
		print_r($formData);die(); */
        $this->render('subform', array('aap' => $allActivePages, 'formData' => $formData,'serviceID'=>$_GET['service_id'],'issuer_id'=>@$_POST['issuer_id'],'field_value'=>$field_value,'postedData'=>@$_POST));
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionCreateform1() {
        extract($_GET);
        $formData=$this->alignInSequence($service_id,$formCodeID);
        $this->render('createform1', array('formData' => $formData));
    }

    public function actionUpdateFileds(){
        //print_r($_GET); die;
        $formData=$this->get_all_data($_GET['service_id'],$_GET['form_id'],$_GET['id']);
        $this->render('updateformfields',array('formData'=>$formData));
    }

    static function get_all_data($serviceID=null,$formCodeID=null,$form_field_id=null) {
        //$serviceID = "68.0";
        // Blank array for filtered records
        $additionalCondition="";
        if(!empty($formCodeID)){$additionalCondition=" AND form_id=$formCodeID ";}
        $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination=array();
        // Getting All Active Pages for Form in ASC preference
        //echo "SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC"; die;
        $allActivePagesASC = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();
       // print_r($allActivePagesASC);die; 
        if (!empty($allActivePagesASC)) {
            foreach ($allActivePagesASC as $pageAsPerPreferenceASC) {
                  // Getting All Active Pages for Category ASC preference
                $allActiveCategoriesASC = Yii::app()->db->createCommand("SELECT category_id FROM bo_page_category_mapping where page_id=$pageAsPerPreferenceASC[id]  AND is_active='Y' order by prefrence ASC")->queryAll();
                if (!empty($allActiveCategoriesASC)) {
                    //print_r($allActiveCategoriesASC);die;
                    foreach ($allActiveCategoriesASC as $categoryAsPerPreferenceASC) {
                         // Getting All Active Form field ASC
                        if($form_field_id) $cnd = " AND id=".$form_field_id;
                        else $cnd='';
                        //echo "SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' $cnd order by preference+0 ASC"; die();
                        $allActiveMappedFormFieldASC = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' $cnd order by preference+0 ASC")->queryAll();
                        
                        if (!empty($allActiveMappedFormFieldASC)) {
                            foreach ($allActiveMappedFormFieldASC as $formfieldAsPerPrefernceASC) {
                                $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination[]=$formfieldAsPerPrefernceASC;
                            }
                        }
                    }
                }
            }
        }
      //  print_r($allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination);die;
        return $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination;
    
    }

    public function actionCreateform() {
        extract($_GET);

//        $SqlQuery = "SELECT
//                    iw_fb.* 
//                    FROM 
//                    bo_information_wizard_form_builder as iw_fb
//                    LEFT JOIN  
//                    bo_infowiz_page_master ON iw_fb.page_name=bo_infowiz_page_master.id 
//                    LEFT JOIN  
//                    bo_page_category_mapping 
//                    ON bo_infowiz_page_master.id= bo_page_category_mapping.page_id
//                    where 
//                    iw_fb.service_id=$service_id  AND bo_infowiz_page_master.page
//                    GROUP BY 
//                    iw_fb.form_field_id 
//                    ORDER BY 
//                    if(@OrderSeq = 'ASC', Plant.TotalOutput, -Plant.TotalOutput)
//                    bo_infowiz_page_master.prefrence ASC,
//                    bo_page_category_mapping.prefrence ASC,
//                    iw_fb.preference ASC";
//        $connection = Yii::app()->db;
//        $command = $connection->createCommand($SqlQuery);
//        $formData = $command->queryAll();
        
        $formData=$this->alignInSequence($service_id,$formCodeID);


        $this->render('createform', array('formData' => $formData));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionCreateformajax() {
        extract($_POST);
        $connection = Yii::app()->db;
        $sqlQuery = "INSERT INTO `bo_information_wizard_form_builder`( `service_id`,`helptext`,`page_name`,`category_id`,`sub_form`, `form_field_id`, `input_type`, `is_with_caf`,`max_length`,`min_length`,`is_required`, `validation_rule`, `row_type`, `preference`,`is_editable`,`form_id`)"
                . " VALUES ('$service_id','$helptext','$page_name','$category_id','$sub_form','$form_field_id','$input_type','$is_with_caf','$max_length','$min_length','$is_required', '$validation_rule','$row_type','$preference','$is_editable','$form_id')";
        $connection->createCommand($sqlQuery)->execute();
    }



    public function actionAllPageCatAjax($id, $rows) {


        $html = '';
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowiz_form_categories where 1 ORDER BY id DESC";
        $command = $connection->createCommand($sql);
        $AllCatLists = $command->queryAll();

        if (isset($id) && !empty($id)) {

            $connection = Yii::app()->db;
            $sql = "SELECT  id,page_id,category_id,prefrence FROM bo_page_category_mapping where id='$id' AND is_active='Y' ORDER BY id DESC";
            $command = $connection->createCommand($sql);
            $pageCat = $command->queryRow();
        }

        for ($i = 0; $i < $rows; $i++) {
            $html .= '<div class="row"><div class="form-group">  <div class="col-md-7" style="margin-bottom:10px;"><select class="form-control" name="category_id[]" >';

            foreach ($AllCatLists as $AllCatList) {

                $html .= '  <option value="' . $AllCatList['id'] . '"> ' . $AllCatList['category_name'] . '</option> ';
            }

            $html .= '<select></div><a href="javascript:void(0);" id="' . $i . '" class="eremove_field"><i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;"></i> </a>  </div></div>';
        }

        echo $html;
    }

    /* @Author : Rahul Kumar
     * @Date : 14042018
     * @Description : Saving category with preference and category helptext for a service's > form type's  > page
     * It will use while genrating form  as a new /edit /view
     * 
     */

    public function actionSaveCategory() {
        if (!empty($_POST)) {
            $increment = 1;
            $flg = 1;
            $coin = 0;
            foreach ($_POST['category_id'] as $key => $value) {
                if (!empty($_POST['category_id'][$key])) {
                    if ($coin == 0) {
                        $sqlQuery = "UPDATE bo_page_category_mapping SET is_active='N' WHERE page_id=$_POST[cat_page_id]";
                        $resultData = Yii::app()->db->createCommand($sqlQuery)->execute();
                        $coin = 1;
                    }
                    $model = new PageCategory;
                    $model->page_id = $_POST['cat_page_id'];
                    $model->prefrence = $increment;
                    $model->category_id = $value;
                    $model->help_text = $_POST['help_text'][$key];
                    if ($model->save()) {
                        $increment = $increment + 1;
                    } else {
                        $flg = 0;
                    }
                }
            }
            if ($flg == 1) {
                $increment = $increment - 1;
                Yii::app()->user->setFlash('Success', ": $increment Category has been mapped with the page");
            } else {
                Yii::app()->user->setFlash('Error', ": $increment category mapped. Please check");
            }

            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* @Author : Rahul Kumar
     * @Date : 1542018
     * @Description : Saving category with preference and category helptext for a service's > form type's  > page
     * It will use while genrating form  as a new /edit /view
     *  */

    public function actionSaveServiceFormMapping() {
        //Saving Form Data
        if (!empty($_POST['frm_form_type_id'])) {
            if (!empty($_POST['frm_form_type_id'])) {

                $resultData = InfowizardQuestionMasterExt::getServiceFormMapping($_POST['frm_service_id'], $_POST['frm_form_type_id']);
                if (empty($resultData)) {
                    $model = new FormMapping;
                    $model->form_code = "Test-Form-code-01";
                    $model->modified = "0000-00-00 00:00:00";
                    $saveUpdate = 'save';
                } else {
                    $model = $this->loadModel($resultData->id, 'FormMapping');
                    $saveUpdate = 'update';
                    $model->modified = date('Y-m-d H:i:s');
                }
                $model->form_type_id = $_POST['frm_form_type_id'];
                $model->form_name = $_POST['form_name'];
                $model->service_id = $_POST['frm_service_id'];

                $model->is_active = "Y";
                $model->created = date("Y-m-d h:i:s");

                if ($model->$saveUpdate()) {
                    $modelupdate = $this->loadModel($model->id, 'FormMapping');
                    $service_data = explode(".", $_POST['frm_service_id']);
                    $form_id = $model->id;
                    $form_type_id = $_POST['frm_form_type_id'];
                    // Form Code genration
                    // COde Provided: UK-SR-001_01-FRM-01_01
                    // Formula: UK-SR-000<SERVICE_ID>_0<SUBSERVICEID>-FRM-0<FORMID>_0<FORMTYPEID>
                    $form_code = 'UK-SR-' . str_pad($service_data['0'], 3, '0', STR_PAD_LEFT) . '_' . str_pad($service_data['1'], 2, '0', STR_PAD_LEFT) . '-FRM-' . str_pad($form_id, 2, '0', STR_PAD_LEFT) . "_" . str_pad($form_type_id, 2, '0', STR_PAD_LEFT);
                    // Form Code Update goes here

                    $modelupdate->form_code = $form_code;
                    if ($modelupdate->update()) {
                        Yii::app()->user->setFlash('Success', "Form type has been mapped with Service");
                    } else {
                        die(var_dump($model->getErrors()));
                        Yii::app()->user->setFlash('Error', "Data not saved, Please check.");
                    }
                }
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    /* @Author : Rahul Kumar
     * @Date : 18042018
     * @Description : actionGetMappedCategoryWithPage
     *  */

    public function actionGetMappedCategoryWithPage($pageID = null,$formCodeID = null) {
        $sql = "SELECT  bo_infowiz_form_categories.id,bo_infowiz_form_categories.category_name,bo_infowiz_form_categories.category_code FROM bo_page_category_mapping 
		LEFT JOIN bo_infowiz_form_categories ON bo_page_category_mapping.category_id= bo_infowiz_form_categories.id 
		where bo_page_category_mapping.page_id='$pageID' AND  bo_page_category_mapping.is_active='Y' ORDER BY id ASC";
		
        $pageCat = Yii::app()->db->createCommand($sql)->queryAll();
        $html = "<option value=''>Select Category</option>";
        if (!empty($pageCat)) {
            foreach ($pageCat as $data) {
                $k = (int) $data['id'];
                $v = $data['category_code']." : ".$data['category_name'];
                $html .= "<option value='" . $k . "'>$v</option>";
            }
        }
        echo $html;
        die;
    }

    /* @Author : Rahul Kumar
     * @Date : 18042018
     * @Description : actionGetRemaingPageCategoryPreference while adding 
     *  */

    public function actionGetRemaingPageCategoryPreference() {
        extract($_GET);
        $sql = "SELECT  preference FROM bo_information_wizard_form_builder where page_name='$pageID' AND category_id=$categoryID AND service_id=$serviceID AND form_id=$formCodeID";
        $pageCatPref = Yii::app()->db->createCommand($sql)->queryAll();
        $html = "<option value=''>Select Preference</option>";
        $sid = array();
        if (!empty($pageCatPref)) {
            foreach ($pageCatPref as $data) {
                $sid[] = (int) $data['preference'];
            }
        } $uj=0; $selected="";
        for ($i = 1; $i <= 200; $i++) {
            if (!in_array($i, $sid)) {
                if($uj==0){
                    $selected=" selected";     
                    $uj=1;
                }else{
                    $selected="";      
                }
                $html .= "<option value='" . $i . "' $selected>$i</option>";
            }
        }
        echo $html;
    }

    static function alignInSequence($serviceID=null,$formCodeID=null) {
        //$serviceID = "68.0";
        // Blank array for filtered records
        $additionalCondition="";
        if(!empty($formCodeID)){$additionalCondition=" AND form_id=$formCodeID ";}
        $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination=array();
		$uniqArr=array();
        // Getting All Active Pages for Form in ASC preference
        $allActivePagesASC = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();
       // print_r($allActivePagesASC);die; 
        if (!empty($allActivePagesASC)) {
            foreach ($allActivePagesASC as $pageAsPerPreferenceASC) {
                  // Getting All Active Pages for Category ASC preference
                $allActiveCategoriesASC = Yii::app()->db->createCommand("SELECT category_id FROM bo_page_category_mapping where page_id=$pageAsPerPreferenceASC[id]  AND is_active='Y' order by prefrence ASC")->queryAll();
             // echo $pageAsPerPreferenceASC['id'];
             // print_r($allActiveCategoriesASC);
                if (!empty($allActiveCategoriesASC)) {
                    //print_r($allActiveCategoriesASC);die;
                    foreach ($allActiveCategoriesASC as $categoryAsPerPreferenceASC) {
                         // Getting All Active Form field ASC
                        //echo "SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' order by preference+0 ASC";
                        $allActiveMappedFormFieldASC = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' order by preference ASC")->queryAll();
                        
                        if (!empty($allActiveMappedFormFieldASC)) {
                            //print_r($allActiveMappedFormFieldASC); die;
                            foreach ($allActiveMappedFormFieldASC as $formfieldAsPerPrefernceASC) {
							if(!in_array($formfieldAsPerPrefernceASC['id'],$uniqArr)){
							$uniqArr[]=$formfieldAsPerPrefernceASC['id'];
                                $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination[]=$formfieldAsPerPrefernceASC;
								}
                            }
                        }
                    }
                }
            }
        }
      //  print_r($allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination);die;
        return $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination;
    
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return InfowizardFormvariableMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $modelname) {
        $model = $modelname::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionGetMappedCategoryWithPageUpdate($pageID = null,$formCodeID = null,$selected=null) {
        $sql = "SELECT  bo_infowiz_form_categories.id,bo_infowiz_form_categories.category_name,bo_infowiz_form_categories.category_code FROM bo_page_category_mapping 
        LEFT JOIN bo_infowiz_form_categories ON bo_page_category_mapping.category_id= bo_infowiz_form_categories.id 
        where bo_page_category_mapping.page_id='$pageID' AND  bo_page_category_mapping.is_active='Y' ORDER BY id ASC";
        
        $pageCat = Yii::app()->db->createCommand($sql)->queryAll();
        $html ='';
        if (!empty($pageCat)) {
            foreach ($pageCat as $data) {
                $k = (int) $data['id'];
                $v = $data['category_code']." : ".$data['category_name'];
                if($selected==$k) {
                    $html .= "<option value='" . $k . "' selected>$v</option>";
                }
                else {
                    $html .= "<option value='" . $k . "' >$v</option>";
                }
                
            }
        }
        echo $html;
        die;
    }

    /* Pankaj Singh for form fields update 28-Nov-2018 */
    public function actionUpdateformajax() {
        //print_r($_POST); die;
        extract($_POST);
        $connection = Yii::app()->db;
        $date = date('Y-m-d H:m:s');
        if($idd){

            $sql_formfield = "SELECT id FROM bo_infowiz_formfield_options WHERE formfield_id=$idd AND is_active='Y'";
            $get_data = Yii::app()->db->createCommand($sql_formfield)->queryAll();
            if($get_data){
                foreach ($get_data as $_kl) {
                    $connection_1 = Yii::app()->db;                    
                    $update_formfield_opt = "UPDATE bo_infowiz_formfield_options SET is_active='N',modified='$date' WHERE id=".$_kl['id']; 
                    $connection_1->createCommand($update_formfield_opt)->execute();
                }
            }
            
            $sqlQuery1 = "Update bo_information_wizard_form_builder set is_active='N',modified='$date' WHERE id= $idd";
            if($connection->createCommand($sqlQuery1)->execute()){

                $select_add_more = "Select id from bo_infowiz_subform_addmore_master where  page_id='$page_id_' AND service_id='$service_id_' AND is_active='Y' AND selected_field_id=$idd";
                
                $ge_add_more = Yii::app()->db->createCommand($select_add_more)->queryRow();
                $idds =  $ge_add_more['id'];
                if($idds){
                    $connection1 = Yii::app()->db;
                    $sqlQuery2 = "Update bo_infowiz_subform_addmore_master set is_active='N',updated_at='$date' WHERE id= $idds"; 
                    $connection1->createCommand($sqlQuery2)->execute();
                }
                $sqlQueryinsert = "INSERT INTO `bo_information_wizard_form_builder`( `service_id`,`helptext`,`page_name`,`category_id`,`sub_form`, `form_field_id`, `input_type`, `is_with_caf`,`max_length`,`min_length`,`is_required`, `validation_rule`, `row_type`, `preference`,`is_editable`,`form_id`,`created`)"
                . " VALUES ('$service_id','$helptext','$page_name','$category_id','$sub_form','$form_field_id','$input_type','$is_with_caf','$max_length','$min_length','$is_required', '$validation_rule','$row_type','$preference','$is_editable','$form_id','$date')";
                return $connection->createCommand($sqlQueryinsert)->execute();
            }
        }      
    }
     public function actionGetUpdatPageCategoryPreference() {
        extract($_GET);
        $sql = "SELECT  preference FROM bo_information_wizard_form_builder where page_name='$pageID' AND category_id=$categoryID AND service_id=$serviceID AND form_id=$formCodeID";
        $pageCatPref = Yii::app()->db->createCommand($sql)->queryAll();
        $html = "<option value=''>Select Preference</option>";
        $sid = array();
        if (!empty($pageCatPref)) {
            foreach ($pageCatPref as $data) {
                $sid[] = (int) $data['preference'];
            }
        } $uj=0; $selected="";
        for ($i = 1; $i <= 200; $i++) {
            if (!in_array($i, $sid)) {
                if($pref==$i) $selected=" selected"; 
                else $selected="";
                $html .= "<option value='" . $i . "' $selected>$i</option>";
            }
        }
        echo $html;
    }

    public function actionDeleteformafield(){
        $connection = Yii::app()->db;
        $sql = "SELECT page_name,service_id,form_id FROM bo_information_wizard_form_builder WHERE is_active='Y' AND id=".$_GET['id'];
        $data = Yii::app()->db->createCommand($sql)->queryRow();
        //print_r($data);
        $sql2 = "SELECT id FROM bo_infowiz_subform_addmore_master WHERE  page_id=".$data['page_name']." AND service_id=".$data['service_id']." AND is_active='Y' AND selected_field_id=".$_GET['id'];
        $data2 = Yii::app()->db->createCommand($sql2)->queryRow();

        if($data2){
            $sb_id = $data2['id'];
            $connection1 = Yii::app()->db;
            $sqlQuery2 = "Update bo_infowiz_subform_addmore_master set is_active='N' WHERE id= $sb_id"; 
            $connection1->createCommand($sqlQuery2)->execute();
        }
        $sqlQuery1 = "Update bo_information_wizard_form_builder set is_active='N' WHERE id=".$_GET['id'];
        $connection->createCommand($sqlQuery1)->execute();
        return true;

    }
	public function actionFormFieldPriority(){
		$connection = Yii::app()->db;
		$sqlQuery1 = "Update bo_information_wizard_form_builder set preference=".$_GET['pref']." WHERE id=".$_GET['id'];
        $connection->createCommand($sqlQuery1)->execute();
		return true;
	}
	
	public function actionSetAddMorePref(){
		$btnID = $_REQUEST['button_id'];
		$sql="SELECT gh.id,gh.selected_field_id,form_field_id,bo_infowizard_formvariable_master.name,gh.prefrence from bo_information_wizard_form_builder as ty 
		INNER JOIN  bo_infowiz_subform_addmore_master  as gh ON gh.selected_field_id=ty.id 
		INNER JOIN bo_infowizard_formvariable_master  on bo_infowizard_formvariable_master.formvar_id=ty.form_field_id  
		where gh.button_id = '$btnID' AND gh.is_active='Y'";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		$htm ="<table width='100%' border='1' class='table table-striped table-bordered table-hover responsive-table'>";
		if(isset($result) && !empty($result)){
		foreach($result as $key=>$res){
			$htm.="<tr>
				<td>".($key+1)."</td>
				<td>".$res['name']."</td>
				<td><input value='".$res['prefrence']."' rel='".$res['id']."' class='setAddMorePref'></td>		
				</tr>";			
		}
		}else{
			$htm.="<tr><td colspan='3'>No records to set</tr>";
		}
		$htm.="</table>";
		echo $htm; die;
	}
	
	public function actionFormFieldPriorityAddmore(){
		$connection = Yii::app()->db;
		$sqlQuery1 = "Update bo_infowiz_subform_addmore_master set prefrence=".$_GET['pref']." WHERE id=".$_GET['id'];
        $connection->createCommand($sqlQuery1)->execute();
		echo true;
	}
}
