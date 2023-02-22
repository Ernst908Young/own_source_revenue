<?php

/* Rahul Kumar */

class InfowizardQuestionMasterExt extends InfowizardQuestionMaster {

    public static function getMasterList($dbtable = null, $key = null, $value = null, $active = null, $isactivevalue = null,$orderby=null,$cond=null) {
        if (empty($active)) {
            $active = "is_active";
        }
        if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        }
		if (isset($orderby) && !empty($orderby)) {
            $orderby = ' Order BY '.$orderby;
        }
		if (isset($cond) && !empty($cond)) {
            $cond = $cond;
        }
        $connection = Yii::app()->db;

        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active $cond $orderby"; 
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
        foreach ($allData as $data) {
            $k = @$data[$key];
            $listData[$k] = @$data[$value];
        }
        return $listData;
    }

    public static function getIssuermappingByIssuerId($id) {
        $connection = Yii::app()->db;
        $issID = $id;
        $sql = "SELECT m.issmap_id as issmap_id,i.name as name FROM bo_infowizard_issuer_mapping m,bo_infowizard_issuerby_master i WHERE m.issuer_id=:issID and 
		i.issuerby_id = m.issuerby_id and is_issmap_active='Y'";
        $command = $connection->createCommand($sql);
        $command->bindParam(":issID", $issID, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;

        //print_r($services);
    }

    public static function getListProfessional() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_information_wizard_architect_structural_engineer_master where is_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;
    }

    public static function getListIssuerMapping($id) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_issuer_mapping where issmap_id=:id AND is_issmap_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryRow();
        return $docList;
    }

    public static function getListIssuer() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_issuer_master where is_issuer_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;
    }

    public static function getViewIssuer($id) {
        $issuer_id = $id;
        $connection = Yii::app()->db;  //print_r($question_id);
        $sql = "SELECT * FROM bo_infowizard_issuer_master where issuer_id=:issuer_id ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":issuer_id", $issuer_id, PDO::PARAM_INT);
        $AppList = $command->queryRow();
        //print_r($AppList); die;
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getIssuerDetailById($id) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT issuer_id,name FROM bo_infowizard_issuer_master where issuer_id=:id AND is_issuer_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $issList = $command->queryRow();
        return $issList;
    }

    public static function getListIssuerBy() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_issuerby_master where is_issuerby_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;
    }

    public static function getViewIssuerBy($id) {
        $issuerby_id = $id;
        $connection = Yii::app()->db;  //print_r($question_id);
        $sql = "SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=:issuerby_id ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":issuerby_id", $issuerby_id, PDO::PARAM_INT);
        $AppList = $command->queryRow();
        //print_r($AppList); die;
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getIWListDocumentTypeByID($id) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_docunenttype_master where doc_id=:id AND is_doc_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryRow();
        return $docList;
    }

    public static function getIWListDocumentType() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_docunenttype_master where is_doc_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;
    }

    public static function getDocumentForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT doc_id,name FROM bo_infowizard_docunenttype_master where is_doc_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $docList = $command->queryAll();
        return $docList;
    }

    public static function getIWListFormfield() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_infowizard_formvariable_master where is_formvar_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $issList = $command->queryAll();
        return $issList;
    }

    public static function getIssuerForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT issuer_id,name FROM bo_infowizard_issuer_master where is_issuer_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $issList = $command->queryAll();
        return $issList;
    }

    public static function getNorowformfieldlistForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT count(*) as count FROM bo_infowizard_formvariable_master ";
        $command = $connection->createCommand($sql);
        //$command->bindParam(":isactive",$isactive,PDO::PARAM_INT);
        $findList = $command->queryAll();
        //print_r($findList); die; 
        return $findList;
    }

    public static function getNorowDocchklistForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT count(*) as count FROM bo_infowizard_documentchklist ";
        $command = $connection->createCommand($sql);
        $findList = $command->queryAll();
        return $findList;
    }

    public static function getDepartmentForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT department_id,name FROM bo_infowizard_department_master where is_dept_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $departmentList = $command->queryAll();
        return $departmentList;
    }

    public static function getDeptserviceForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT deptservice_id,name FROM bo_infowizard_deptservice_master where is_deptservice_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $deptserviceList = $command->queryAll();
        return $deptserviceList;
    }

    public static function getQuestionForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        //$sql = "SELECT question_id,name FROM bo_infowizard_question_master where is_question_active=:isactive";
        $sql = "select question_id,name from bo_infowizard_question_master where is_question_active=:isactive and question_id Not IN 
  (select question_id from bo_infowizard_quesans_mapping group by question_id)";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $questionList = $command->queryAll();
        return $questionList;
    }

    public static function getAnsCatForInfoWizard() {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT anscat_id,name FROM bo_infowizard_answercategory_master where is_anscat_active=:isactive";
        $command = $connection->createCommand($sql);
        $command->bindParam(":isactive", $isactive, PDO::PARAM_INT);
        $anscatList = $command->queryAll();
        return $anscatList;
    }

    public static function getIWListDocchk() {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_documentchklist ORDER BY docchk_id DESC";
        $command = $connection->createCommand($sql);
        //$command->bindParam(":uid",$uid,PDO::PARAM_INT);
        $AppList = $command->queryAll();
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getIWListQuestion() {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_question_master";
        $command = $connection->createCommand($sql);
        $AppList = $command->queryAll();
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getIWListView($question_id) {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_question_master where question_id=:question_id ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":question_id", $question_id, PDO::PARAM_INT);
        $AppList = $command->queryAll();
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getIWListEdit($question_id) {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_question_master where question_id=:question_id ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":question_id", $question_id, PDO::PARAM_INT);
        $AppList = $command->queryAll();
        if ($AppList === false)
            return false;
        return $AppList;
    }

    public static function getMasterList1($dbtable = null, $key = null, $value = null) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT $key,$value FROM $dbtable where is_formvar_active=:is_formvar_active";
        $command = $connection->createCommand($sql);
        $command->bindParam(":is_formvar_active", $isactive, PDO::PARAM_INT);
        $allData = $command->queryAll();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value];
        }
        return $listData;
    }

    public static function getMasterName($dbtable = null, $key = null, $value = null, $id = null) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT $value FROM $dbtable where $id=$key";
        $command = $connection->createCommand($sql);
        $allData = $command->queryAll();
        if($allData)
        return $allData[0][$value];
        else
            return false;
    }

    public static function getDocumentMapping() {
        $connection = Yii::app()->db;

        $sql = "SELECT dc.docchk_id,dc.chklist_id,dtm.name as document_type,im.name as issuer_name,ibm.name as issuerby_name,dc.name as document_name
				FROM bo_infowizard_documentchklist as dc 
				INNER JOIN bo_infowizard_docunenttype_master as dtm ON dtm.doc_id=dc.doc_id
				INNER JOIN bo_infowizard_issuer_mapping as imap ON imap.issmap_id=dc.issmap_id
				INNER JOIN bo_infowizard_issuer_master as im ON im.issuer_id=imap.issuer_id
				INNER JOIN bo_infowizard_issuerby_master as ibm ON ibm.issuerby_id=imap.issuerby_id
				WHERE docchk_id >=0";
        $command = $connection->createCommand($sql);
        $allData = $command->queryAll();
        return $allData;
    }

    public static function getSingleDocumentMapping($docID = null) {
        $connection = Yii::app()->db;
        $sql = "SELECT dc.docchk_id,dc.chklist_id,dtm.name as document_type,im.name as issuer_name,ibm.name as issuerby_name,dc.name as document_name
				FROM bo_infowizard_documentchklist as dc 
				INNER JOIN bo_infowizard_docunenttype_master as dtm ON dtm.doc_id=dc.doc_id
				INNER JOIN bo_infowizard_issuer_mapping as imap ON imap.issmap_id=dc.issmap_id
				INNER JOIN bo_infowizard_issuer_master as im ON im.issuer_id=imap.issuer_id
				INNER JOIN bo_infowizard_issuerby_master as ibm ON ibm.issuerby_id=imap.issuerby_id
				WHERE docchk_id ='$docID' LIMIT 1";
        $command = $connection->createCommand($sql);
        $allData = $command->queryAll();
        return $allData;
    }

    /*
     * Rahul Kumar
     * 11012018
     * Get all active document type list
     */

    public static function getDocTypelist() {
        $connection = Yii::app()->db;
        $is_doc_active = 'Y';
        $sql = "SELECT abbr,doc_id,name from bo_infowizard_docunenttype_master where is_doc_active=:is_doc_active";
        $command = $connection->createCommand($sql);
        $command->bindParam(":is_doc_active", $is_doc_active, PDO::PARAM_INT);
        $docTypeList = $command->queryAll();
        return $docTypeList;
    }

    /*
     * Rahul Kumar
     * 11012018
     * Get particular active document type Data
     */

    public static function getSingleDocumentTypeData($doc_id) {
        $connection = Yii::app()->db;
        $is_doc_active = 'Y';
        $sql = "SELECT abbr,doc_id,name from bo_infowizard_docunenttype_master where is_doc_active=:is_doc_active AND doc_id=:doc_id";
        $command = $connection->createCommand($sql);
        $command->bindParam(":is_doc_active", $is_doc_active, PDO::PARAM_INT);
        $command->bindParam(":doc_id", $doc_id, PDO::PARAM_INT);
        $docTypeList = $command->queryRow();
        return $docTypeList;
    }

    public static function getFormName($service_id, $form_id, $prefrence) {

        $connection = Yii::app()->db;
        $sql = "SELECT page_name FROM bo_infowiz_page_master where form_id='$form_id' AND service_id='$service_id' AND prefrence='$prefrence' AND is_active='Y' ORDER BY id DESC";
        $command = $connection->createCommand($sql);
        $page_results = $command->queryRow();
        if ($page_results) {
            return $page_results['page_name'];
        } else {
            return false;
        }
    }

    public static function getFormPageId($service_id, $form_id, $prefrence) {

        $connection = Yii::app()->db;
        $sql = "SELECT id FROM bo_infowiz_page_master where form_id='$form_id' AND service_id='$service_id' AND prefrence='$prefrence' AND is_active='Y' ORDER BY id DESC";
        $command = $connection->createCommand($sql);
        $page_results = $command->queryRow();
        if ($page_results) {
            return $page_results['id'];
        } else {
            return false;
        }
    }

    public static function getMasterListTwoValue($dbtable = null, $key = null, $value = null, $active = null, $isactivevalue = null, $value2 = null, $seprator = null) {
        if (empty($active)) {
            $active = "is_active";
        }
        if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        }
        if (empty($seprator)) {
            $seprator = " : ";
        }
        $connection = Yii::app()->db;
        $sql = "SELECT $key,$value,$value2 FROM $dbtable where $active=:$active";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value] . "" . $seprator . "" . $data[$value2];
        }
        if(isset($listData) && !empty($listData))
		{
        return $listData;
		}else{
		return false;
		}
    }

    /* @Authour:Rahul Kumar
     * @Date: 17042018
     * @Description: It will return form data which is mapped with a service's Form's data */

    public static function getServiceFormMapping($serviceID = null, $formTypeID = null) {
        $modelName = "FormMapping";
        $resultData = $modelName::model()->findBySql("select * from bo_infowiz_form_mapping where service_id=$serviceID AND form_type_id=$formTypeID AND is_active='Y'");
        return $resultData;
    }

    /* @Authour:Rahul Kumar
     * @Date: 18042018
     * @Description: It will listout all active category which is mapped with a service's Form's page */

    public static function getCategoryServicePageMapping($pageID = null) {
        $sqlQuery = "select category_id,help_text from bo_page_category_mapping where page_id=$pageID AND is_active='Y'";
        $resultData = Yii::app()->db->createCommand($sqlQuery)->queryAll();
        return json_encode($resultData);
    }

    /* @Authour:Rahul Kumar
     * @Date: 19042018
     * @Description: It will return name of page name of a service ID's  
     */

    public static function getPageNameOfServiceForm($serviceID = null, $formTypeID = null) {
        $sqlQuery = "select * from bo_infowiz_page_master where service_id=$serviceID  AND form_id=$formTypeID ORDER BY 'preference ASC'";
        $resultData = Yii::app()->db->createCommand($sqlQuery)->queryAll();
        $result = array();
        if (!empty($resultData)) {
            foreach ($resultData as $data) {
                $key = $data['id'];
                $value = "Page " . $data['prefrence'] . " : " . $data['page_name'];
                $result[$key] = $value;
            }
            return $result;
        }
    }
      public static function  getallsubservicestagmapping($serviceID=null){
             $serviceID="'$serviceID'";
         $connection = Yii::app()->db;
        $sqlData="select * from bo_infowizard_subservice_tag_mapping where bo_infowizard_subservice_tag_mapping.sub_service_id=$serviceID AND bo_infowizard_subservice_tag_mapping.is_active='Y' ORDER BY created DESC";
        //echo $sqlData;die;
        $allActiveServiceTagMapping = $connection->createCommand($sqlData)->queryRow();
        return $allActiveServiceTagMapping;
    }
	//3-dec-2018 put functions
	public static function getFormNameFrmMap($service_id=null,$formCodeID=null){
        $connection = Yii::app()->db;
        $sql = "SELECT form_name 
                FROM 
                    bo_infowiz_form_mapping 
                WHERE 
                    service_id='$service_id'
                    AND 
                        is_active='Y'
                    AND 
                        form_type_id = $formCodeID";
		
        $command = $connection->createCommand($sql); 
        $allData = $command->queryRow(); 			
				
        return $allData;
    }
	
	public static function getAllServiceFormMapping($service_id =null){
        $connection = Yii::app()->db;
        $sql = "SELECT a.*,b.*
                    FROM  
                        bo_infowiz_form_mapping a 
                    JOIN 
                        bo_information_wizard_form_builder b 
                    ON 
                        a.service_id = b.service_id 

                    WHERE a.service_id='$service_id' AND a.is_active='Y' GROUP BY a.form_name, b.service_id ORDER BY a.form_type_id ASC
                  /* WHERE a.service_id='$service_id' AND a.is_active='Y' GROUP BY a.form_name, a.form_type_id,b.service_id ORDER BY a.form_type_id ASC*/
                   ";

        $command = $connection->createCommand($sql);
        return $data = $command->queryAll();
        
    }
	
	/*public static function getFormApplicationSubmittedStatus($service_id=null,$loggedin_userid=null,$formCodeID=null,$pageID=null,$submittion_id=null){
        $connection = Yii::app()->db;
        $sql = "SELECT * 
                FROM 
                    bo_new_application_submission 
                WHERE 
                    service_id='$service_id'";
        if($submittion_id) $sql .=" AND submission_id=$submittion_id";
        else $sql .=" AND user_id = $loggedin_userid";
          $sql .="  AND form_id = $formCodeID";
        //  echo $sql;die();
        $command = $connection->createCommand($sql); 
        $allData = $command->queryRow();        
        return $allData;
    }*/
	/*public static function getUserApplicationInfo($submission_id=null){
        $connection = Yii::app()->db;
        $sql = "SELECT 
                sso_users.*,sso_profiles.*,bo_new_application_submission.* 
                FROM 
                    sso_users 
                LEFT JOIN 
                    sso_profiles 
                    ON 
                        sso_users.user_id=sso_profiles.user_id 
                LEFT JOIN 
                    bo_new_application_submission 
                    ON 
                        sso_users.user_id=bo_new_application_submission.user_id 
                WHERE 
                    bo_new_application_submission.submission_id=$submission_id";
        $command = $connection->createCommand($sql);
        $allData = $command->queryRow(); 
		
		return $allData;
    }
	
	public static function getApplicationLog($service_id=null,$formCodeID=null,$subb_id=null){
        $connection = Yii::app()->db;
        if($formCodeID==1){
            $sql = "SELECT 
                * 
                FROM 
                    bo_infowiz_form_builder_application_log 
                WHERE app_Sub_id=$subb_id AND action_status in ('P','H')";
        }
        else{
            $sql = "SELECT 
                * 
                FROM 
                    bo_infowiz_form_builder_application_log 
                WHERE app_Sub_id=$subb_id AND form_id=$formCodeID";
        }
        // AND form_id=$formCodeID
                    /*service_id=$service_id AND app_Sub_id=$subb_id AND form_id=$formCodeID

                  //  ";
        $command = $connection->createCommand($sql);
        $allData =  $command->queryAll(); 
		return $allData;
    }*/
	public static function checkExist($service_id,$page_id,$selected_field_id){
        $connection= Yii::app()->db;
        $sql = "SELECT id FROM bo_infowiz_subform_addmore_master 
                WHERE 
                    service_id=$service_id AND
                    selected_field_id = $selected_field_id AND
                    page_id = $page_id AND is_active='Y'
                ";
        $command = $connection->createCommand($sql);
        return $data = $command->queryRow();
    }
    
 public static function checkSubform($service_id,$selected_field_id,$page_name_id){
        $connection = Yii::app()->db;
        $sql = "SELECT id FROM bo_infowiz_subform_addmore_master 
                 WHERE   service_id=$service_id AND 
                 selected_field_id = $selected_field_id AND 
                  page_id=$page_name_id AND 
                  is_active='Y'";
        $command = $connection->createCommand($sql);
        $data = $command->queryRow();
        if($data) return true;
        else return false;
    }
    public static function get_selected_field($selected_field_id=null){
        $connection = Yii::app()->db;
        if($selected_field_id){
            $sql = "select bo_infowiz_subform_addmore_master.button_id,bo_infowiz_subform_addmore_master.selected_field_id,bo_infowizard_formvariable_master.formchk_id,bo_infowizard_formvariable_master.name,bo_infowizard_formvariable_master.formvar_id from bo_infowiz_subform_addmore_master 
INNER JOIN bo_information_wizard_form_builder ON bo_infowiz_subform_addmore_master.selected_field_id =bo_information_wizard_form_builder.id
INNER JOIN bo_infowizard_formvariable_master ON bo_information_wizard_form_builder.form_field_id=bo_infowizard_formvariable_master.formvar_id
where bo_infowiz_subform_addmore_master.service_id=".$selected_field_id." AND bo_infowiz_subform_addmore_master.is_active='Y' Order By bo_infowiz_subform_addmore_master.prefrence ASC";
            $command = $connection->createCommand($sql);
            $data = $command->queryAll();
        }
        if($data) return $data;
        else return false;
    }
	public static function getsubmittedvalues($service_id=null,$sub_id=null){
        $connection = Yii::app()->db;
        if($service_id){
            $sql = "  select field_value from bo_new_application_submission where submission_id='$sub_id' AND  service_id='$service_id'";
            $command = $connection->createCommand($sql);
            $data = $command->queryRow();
        }
        if($data) return (array)json_decode($data['field_value']);
        else return false;
    }
    public static function getFormApplicationSubmittedStatus($service_id=null,$loggedin_userid=null,$formCodeID=null,$pageID=null,$submittion_id=null){ 
        $connection = Yii::app()->db;
        $sql = "SELECT * 
                FROM 
                    bo_new_application_submission 
                WHERE 
                    service_id='$service_id'";
        if($submittion_id) $sql .=" AND submission_id=$submittion_id";
        if($loggedin_userid) $sql .=" AND user_id = $loggedin_userid";
          $sql .="  AND form_id = $formCodeID";
        // echo $sql;
        $command = $connection->createCommand($sql); 
        $allData = $command->queryRow();        
        return $allData;
    }
    public static function getBusinessApplicationLog($service_id=null,$formCodeID=null,$submittion_id=null){
        $connection = Yii::app()->db;
        $sql = "SELECT * 
                FROM 
                    bo_new_application_submission a 
                JOIN 
                    bo_infowiz_form_builder_application_log b
                    ON
                    a.service_id =b.service_id
                WHERE 
                    b.form_id=$formCodeID AND b.app_Sub_id=$submittion_id AND b.service_id='$service_id' GROUP BY b.id";
                   
        //echo $sql;
        $command = $connection->createCommand($sql); 
        $allData = $command->queryAll();        
        return $allData;
    }

    /*public function getCondData($tbl=null,$val=null,$cond=array(),$select_type=null){
        print_r($cond); die;
        $connection = Yii::app()->db;
        $sql = "SELECT $val FROM $tbl WHERE $cond";
        $command = $connection->createCommand($sql);
        if($select_type=='1')
            $allData = $command->queryRow();
        else 
            $allData = $command->queryAll();
        return $allData;
    }*/

/*    public static function getFormNameFrmMap($service_id=null,$formCodeID=null){
        $connection = Yii::app()->db;
        $sql = "SELECT form_name 
                FROM 
                    bo_infowiz_form_mapping 
                WHERE 
                    service_id='$service_id'
                    AND 
                        is_active='Y'
                    AND 
                        form_type_id = $formCodeID";

        $command = $connection->createCommand($sql); 
        $allData = $command->queryRow();        
        return $allData;
    }*/
	/* Pankaj Singh */
    public static function getSubFromList($id=null,$service_id=null,$button_id=null){
        $data = array();

        if($id && $service_id && !empty($button_id)){ 
            $connection= Yii::app()->db;
            $sqldata = "SELECT * FROM bo_infowiz_subform_addmore_master WHERE is_active='Y' AND page_id=".$id." AND button_id=".$button_id." Order By prefrence ASC";
            //die();
            $command = $connection->createCommand($sqldata);
            $allData = $command->queryAll();
            //print_r($allData); die();
            foreach($allData as $dat){
                    //$sql1 = "SELECT * FROM `bo_information_wizard_form_builder`  where page_name=".$dat['page_id']." AND service_id=".$service_id." AND form_field_id=".$dat['selected_field_id'];
                    $sql1= "SELECT 
                                 service_id,a.id as idd ,b.formchk_id, b.name as full_name, b.formchk_id
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
            return $data;
        }

    }

    public static function getUserApplicationInfo($submission_id=null){
        $connection = Yii::app()->db;
        $sql = "SELECT 
                sso_users.*,sso_profiles.*,bo_new_application_submission.* 
                FROM 
                    sso_users 
                LEFT JOIN 
                    sso_profiles 
                    ON 
                        sso_users.user_id=sso_profiles.user_id 
                LEFT JOIN 
                    bo_new_application_submission 
                    ON 
                        sso_users.user_id=bo_new_application_submission.user_id 
                WHERE 
                    bo_new_application_submission.submission_id=$submission_id";
        $command = $connection->createCommand($sql);
        return $command->queryRow(); 
    }

    public static function getApplicationLog($service_id=null,$formCodeID=null,$subb_id=null){
        $connection = Yii::app()->db;
        if($formCodeID==1){
            $sql = "SELECT * from bo_infowiz_form_builder_investor_logs a 
                join bo_infowiz_form_builder_application_log b
                on a.id = b.investor_log_id 
                where b.service_id='$service_id' AND a.form_id=$formCodeID AND a.submission_id=$subb_id GROUP BY action_status ORDER BY a.id ASC";
        }
        else{
          /*  $sql = "SELECT * from bo_infowiz_formbuilder_application_forward_level a join bo_infowiz_form_builder_application_log b
            on b.dept_log_id= a.appr_lvl_id
            where b.service_id='$service_id' AND a.form_id IN (1,$formCodeID) AND a.app_Sub_id=$subb_id
             ORDER BY a.appr_lvl_id ASC";*/
             $sql = "SELECT bo_infowiz_form_builder_application_log.*,bo_infowiz_formbuilder_application_forward_level.appr_lvl_id,bo_infowiz_formbuilder_application_forward_level.next_role_id,bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id from bo_infowiz_form_builder_application_log 
			LEFT JOIN bo_infowiz_form_builder_investor_logs 
			ON bo_infowiz_form_builder_application_log.investor_log_id=bo_infowiz_form_builder_investor_logs.id 
			LEFT JOIN bo_infowiz_formbuilder_application_forward_level 
			ON bo_infowiz_form_builder_application_log.dept_log_id=bo_infowiz_formbuilder_application_forward_level.appr_lvl_id
			where
			bo_infowiz_form_builder_application_log.service_id='$service_id' 
			AND bo_infowiz_form_builder_application_log.app_Sub_id=$subb_id 
			GROUP BY bo_infowiz_form_builder_application_log.action_taken_by_name ORDER BY bo_infowiz_form_builder_application_log.id ASC";
        }
        //echo $sql; die;
        // AND form_id=$formCodeID
                    /*service_id=$service_id AND app_Sub_id=$subb_id AND form_id=$formCodeID*/

                  //  ";
        $command = $connection->createCommand($sql);
        return $command->queryAll(); 
    }

    static function getFormByJson($serviceID=null,$field_value=null) {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_new_application_submission WHERE service_id=$serviceID AND field_value=$field_value";
        $command = $connection->createCommand($sql);
        return $command->queryRow();
    }

    public static function alignInSequence($serviceID=null,$formCodeID=null) {
        //$serviceID = "68.0";
        //Blank array for filtered records
        $additionalCondition="";
        if(!empty($formCodeID)){$additionalCondition=" AND form_id=$formCodeID ";}
        $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination=array();
        // Getting All Active Pages for Form in ASC preference
        $allActivePagesASC = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$serviceID AND is_active='Y' $additionalCondition order by prefrence ASC")->queryAll();
       
        if (!empty($allActivePagesASC)) {
            foreach ($allActivePagesASC as $pageAsPerPreferenceASC) {
                  // Getting All Active Pages for Category ASC preference
                $allActiveCategoriesASC = Yii::app()->db->createCommand("SELECT category_id FROM bo_page_category_mapping where page_id=$pageAsPerPreferenceASC[id]  AND is_active='Y' order by prefrence ASC")->queryAll();             
                if (!empty($allActiveCategoriesASC)) {                   
                    foreach ($allActiveCategoriesASC as $categoryAsPerPreferenceASC) {
                         // Getting All Active Form field ASC
                        $allActiveMappedFormFieldASC = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder where service_id=$serviceID AND category_id=$categoryAsPerPreferenceASC[category_id] $additionalCondition AND is_active='Y' order by preference+0 ASC")->queryAll();
                        
                        if (!empty($allActiveMappedFormFieldASC)) {
                            foreach ($allActiveMappedFormFieldASC as $formfieldAsPerPrefernceASC) {
                                $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination[]=$formfieldAsPerPrefernceASC;
                            }
                        }
                    }
                }
            }
        }      
        return $allFormFieldDataAsPerASCPrefrencewithPageCategoryAndFormFieldCombination;
    }
    public static function getDepartmentPendencyg($service_id=null,$formCodeID=null,$subb_id=null)
	{	
		$connection = Yii::app()->db;
        $sql1 = "SELECT form_type_id from bo_infowiz_form_builder_configuration WHERE service_id=$service_id AND current_role_id=".$_SESSION['role_id'];
        $command1 = $connection->createCommand($sql1);
        $form_type_id = $command1->queryRow();
    
		$connection = Yii::app()->db;
		$sql = "SELECT 
				".$form_type_id['form_type_id']." as form_id,
				'' as investor_log_id,
				'' as action_taken_by_name,
				'P' as action_status,
				created_on as created,
				'Application is pending with you ' as action_message,
				'' department_comment,
				appr_lvl_id as id, 
				app_Sub_id, appr_lvl_id,next_role_id
				from bo_infowiz_formbuilder_application_forward_level where approv_status='P' AND app_Sub_id=$subb_id AND next_role_id=".$_SESSION['role_id']." AND forwarded_dept_id=".$_SESSION['dept_id']." GROUP BY action_message";
        $command = $connection->createCommand($sql);
        return $command->queryAll();
    }
    

    
    
     public static function getDepartmentPendencyOnOther($service_id=null,$formCodeID=null,$subb_id=null){
			$connection = Yii::app()->db;
			$sql1 = "SELECT form_type_id from bo_infowiz_form_builder_configuration WHERE service_id=$service_id AND current_role_id=".$_SESSION['role_id'];
			$command1 = $connection->createCommand($sql1);
			$form_type_id = $command1->queryRow();
    
			$connection = Yii::app()->db;
			$sql = "SELECT 
                ".$formCodeID." as form_id,
                '' as investor_log_id,
                '' as action_taken_by_name,
                'PF' as action_status,
                created_on as created,
                'Application is pending with others ' as action_message,
                '' department_comment,
                appr_lvl_id as id, 
                app_Sub_id, appr_lvl_id,next_role_id
                from bo_infowiz_formbuilder_application_forward_level where approv_status='P' 
				/* AND ( form_id IS NULL OR form_id!=$formCodeID) */
				AND verifier_user_id =0 	
				AND app_Sub_id=$subb_id GROUP BY app_Sub_id";
        $command = $connection->createCommand($sql);
        return $command->queryAll();
		
    }
   
	/*public static function getConfigList($dbtable = null, $key = null, $value = null, $active = null, $isactivevalue = null,$selectedonly=null) {
        if (empty($active)) {
            $active = "is_active";
        }
        if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        }
        $connection = Yii::app()->db;

        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active AND $key IN($selectedonly)"; 
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value];
        }
        return $listData;
    }*/
	
	
	// 1 April 2019 
	
	public static function getConfigList($sql = null) {
		$listData=array();
		 
        $connection = Yii::app()->db;
	
		$deptID=$_SESSION['dept_id'];
		if(preg_match("%deptID%",$sql)){
			$sql = str_replace('%deptID%',$deptID,$sql);
		}
		if(preg_match("%sub_id%",$sql)){
			$sql = str_replace('%sub_id%',$_GET['app_Sub_id'],$sql);
		}		
		//echo $sql;die;
        //$sql = "SELECT $key,$value FROM $dbtable where $active=:$active AND $key IN($selectedonly)"; 
        $command = $connection->createCommand($sql);
       // $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
		if(!empty($allData))
		{
			foreach ($allData as $data) {
				$k1 = array_keys($data);
				//print_r($k1);die;
				$key = @$k1[0];
				$value = @$k1[1];
				$k = $data[$key];
				$listData[$k] = $data[$value];
			}
		}
        return $listData;
    }
	public static function getCopyofFields($service_id=null,$category=null) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM  bo_infowiz_formbuilder_copy_form_fields where category_id=:category and service_id=:service_id";
        $command = $connection->createCommand($sql);
        $command->bindParam(":category", $category, PDO::PARAM_INT);
        $command->bindParam(":service_id", $service_id, PDO::PARAM_INT);
        $fieldList = $command->queryAll();
	    $val="";
		if(isset($fieldList) && !empty($fieldList))
		{		
			foreach($fieldList as $k=>$v)
			{
				$val.= $v['copy_from_form_field']."~".$v['copy_to_form_field'].":";
			}				
			return rtrim(@$v['action_form_field']."=".$val,':');
		}else{
			return false;
		}
       		
    }
	
	public static function getFieldValueFormBuilder($key = null, $val = null, $serviceID = null) {
        extract($_GET);
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT bo_master_tables.*  FROM bo_infowizard_formvariable_master "
                . "INNER JOIN bo_information_wizard_form_builder ON bo_information_wizard_form_builder.form_field_id=bo_infowizard_formvariable_master.formvar_id "
                . "LEFT JOIN bo_infowiz_formfield_options ON bo_infowiz_formfield_options.formfield_id=bo_information_wizard_form_builder.id "
                . "LEFT JOIN bo_master_tables ON bo_infowiz_formfield_options.master_table_id = bo_master_tables.id "
                . "where bo_infowizard_formvariable_master.formchk_id=:key "
                . "AND bo_infowizard_formvariable_master.is_formvar_active=:is_formvar_active "
                . "AND bo_information_wizard_form_builder.is_active=:is_active "
                . "AND bo_information_wizard_form_builder.service_id=:service_id "
                . "AND bo_information_wizard_form_builder.input_type IN ('Select') "
                . "AND bo_infowiz_formfield_options.master_table_id>0 ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":key", $key, PDO::PARAM_INT);
        $command->bindParam(":is_formvar_active", $isactive, PDO::PARAM_INT);
        $command->bindParam(":is_active", $isactive, PDO::PARAM_INT);
        $command->bindParam(":service_id", $serviceID, PDO::PARAM_INT);
        $mappingData = $command->queryRow();

        if (isset($mappingData) && !empty($mappingData)) {
            extract($mappingData);
            $sql = "SELECT $field_value from $master_table_name where $key_id=:key_id AND $is_active_field=:is_active_value ";
            $command = $connection->createCommand($sql);
            $command->bindParam(":key_id", $val, PDO::PARAM_INT);
            $command->bindParam(":is_active_value", $is_active_value, PDO::PARAM_INT);
            $getValue = $command->queryRow();
        }

        if (isset($getValue) && !empty($getValue)) {
            if (isset($getValue[$field_value]) && !empty($getValue[$field_value])) {
                return $getValue[$field_value];
              
            }
        } else {
            return $val; 
        }
    }
    
    public static function getInvestorSubmitLog($service_id=null,$subb_id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "
SELECT * from bo_infowiz_form_builder_application_log where service_id=$service_id AND  app_Sub_id=$subb_id and action_status in ('P') GROUP BY action_status,created ";
        $command = $connection->createCommand($sql);
        return $command->queryAll();
    }
	
	
	public static function getFieldValueFormBuilder_LM($key = null, $val = null, $serviceID = null) {
        extract($_GET);
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT bo_master_tables.*  FROM bo_infowizard_formvariable_master "
                . "INNER JOIN bo_information_wizard_form_builder ON bo_information_wizard_form_builder.form_field_id=bo_infowizard_formvariable_master.formvar_id "
                . "LEFT JOIN bo_infowiz_formfield_options ON bo_infowiz_formfield_options.formfield_id=bo_information_wizard_form_builder.id "
                . "LEFT JOIN bo_master_tables ON bo_infowiz_formfield_options.master_table_id = bo_master_tables.id "
                . "where bo_infowizard_formvariable_master.formchk_id=:key "
                . "AND bo_infowizard_formvariable_master.is_formvar_active=:is_formvar_active "
                . "AND bo_information_wizard_form_builder.is_active=:is_active "
                . "AND bo_information_wizard_form_builder.service_id=:service_id "
                . "AND bo_information_wizard_form_builder.input_type IN ('Select') "
                . "AND bo_infowiz_formfield_options.master_table_id>0 ";
        $command = $connection->createCommand($sql);
        $command->bindParam(":key", $key, PDO::PARAM_INT);
        $command->bindParam(":is_formvar_active", $isactive, PDO::PARAM_INT);
        $command->bindParam(":is_active", $isactive, PDO::PARAM_INT);
        $command->bindParam(":service_id", $serviceID, PDO::PARAM_INT);
        $mappingData = $command->queryRow();
		
        if (isset($mappingData) && !empty($mappingData)) {			
            extract($mappingData);
            $sql = "SELECT $field_value from $master_table_name where $key_id=:key_id AND $is_active_field=:is_active_value ";
            $command = $connection->createCommand($sql);
            $command->bindParam(":key_id", $val, PDO::PARAM_INT);
            $command->bindParam(":is_active_value", $is_active_value, PDO::PARAM_INT);
            $getValue = $command->queryRow();
        }

        if (isset($getValue) && !empty($getValue)) {			
            if (isset($getValue[$field_value]) && !empty($getValue[$field_value])) {
                return @$getValue[$field_value];              
            }else{
				return  "";	
			}	
        } else {		
            return @$val; 
        }
    }
    
	public static function getApplicationForName($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_application_for where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
    }
	
	public static function getNameFor($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_name_for where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
    }
	
	public static function getCountryStateNameByID($id=null)
	{	
		$connection = Yii::app()->db;
		if(isset($id) && !empty($id)){
			$sql = "SELECT lr_name from bo_landregion where lr_id=$id AND is_lr_active='Y'";
			$command = $connection->createCommand($sql);
			$data=$command->queryRow();
			return $data['lr_name'];
		}else{
			return false;
		}

    }
	
	public static function getReasonExemption($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_reason_for_exemption where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
    }	
	
	public static function getBusinessIndustryName($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name,final_code from bo_business_industry_list where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['final_code'].'-'.$data['name'];
    }
	public static function getNameReservationNewCompany($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_name_reservation_new_company where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
    }
	public static function getNameReservationExistingCompany($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_name_reservation_existing_company where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
    }
	public static function getBusinessEntityType($id=null)
	{	
		$connection = Yii::app()->db;
		if(isset($id) && !empty($id)){
		$sql = "SELECT name from bo_business_entity_type where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
		}else{
		return false;
		}
    }
	public static function getBusinessEntitySuffix($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT suffix_name from bo_business_entity_type_suffix where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['suffix_name'];
    }
	
	public static function getIdType($id=null)
	{	
		$connection = Yii::app()->db;

		$sql = "SELECT name from bo_id_type where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data = $command->queryRow();
		return $data['name'];
    }
	
	public static function SendNotification($sender_id,$sender_role_id,$receiver_id,$receiver_role_id,$title,$msg,$type)
	{
		$modelNotification = new NotificationSubmission;
		$modelNotification->sender_id = $sender_id;
		$modelNotification->sender_role_id = $sender_role_id;
		$modelNotification->receiver_id = $receiver_id;
		$modelNotification->receiver_role_id = $receiver_role_id;		
		$modelNotification->status = 0;
		$modelNotification->subject = $title;
		$modelNotification->message = $msg;
		$modelNotification->notification_type = $type;
		$modelNotification->created = date('Y-m-d H:i:s');
		if($modelNotification->save()) 
		{
			return true;
		}else{
			return false;
		}
	}
	
	public static function getDerivationName($id=null)
	{	
		$connection = Yii::app()->db;
		if(isset($id) && !empty($id)){
		$sql = "SELECT name from bo_derivation_name where id=$id AND status='Y'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['name'];
		}else{
		return false;
		}
    }
	
	public static function getLegalEndingName($id=null)
	{	
		$connection = Yii::app()->db;
		if(isset($id) && !empty($id)){
		$sql = "SELECT suffix_name from bo_business_entity_type_suffix where id=$id AND status='1'";
        $command = $connection->createCommand($sql);
        $data=$command->queryRow();
		return $data['suffix_name'];
		}else{
		return false;
		}
    }
	
}

?>
