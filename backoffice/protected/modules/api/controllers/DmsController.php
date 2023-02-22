<?php

/*
 * 
 * @authour: Rahul Kumar
 * @date: 29082018 17:26
 * @description: DMS data post on departmental portal 
 *  */

class DmsController extends Controller {


//Dept - URL - handle this



public function  actionPostStatus  () {
    
    extract($_GET);
    // Get Application DMS Documents List With Integration Department List
    $connection = Yii::app()->db;

    $sql = "SELECT dms_map.mapping_id,dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,bo_user.np_user_id,dms_map.comments as verifier_comments FROM 
            bo_application_dms_documents_mapping as dms_map 
            INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
            INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
            INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
            LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
			  INNER JOIN bo_user ON dms_map_log.dept_user_id=bo_user.uid
            WHERE sno=:sno  ORDER BY dms_map.status,dms_map.mapping_id DESC
            ";
    
    $command = $connection->createCommand($sql);
    $command->bindParam(":sno", $sno, PDO::PARAM_INT);
    $modelDocuments = $command->queryAll();
   //  print_r($modelDocuments);die;
    
        $sql = "SELECT assigned_to from bo_sp_applications WHERE sno=:sno";    
    $command = $connection->createCommand($sql);
    $command->bindParam(":sno", $sno, PDO::PARAM_INT);
    $assignedTo = $command->queryRow();
    
    $app_docs = NULL;
    $app_new_docs = NULL;
    $key2 = $key1 = 0;
    if ($modelDocuments) {
        $temp_arr = array();
        $key1 = 0;
        foreach ($modelDocuments as $key => $d_array) {
            if (!in_array($d_array['document_code'], $temp_arr)) {
                
                $sql="select bo_infowiz_dcp_master.name as dcp_name,"
                        . " bo_infowiz_dcp_master.code as dcp_code,"
                        . " bo_dcp_transactions.dcp_value,"
                        . " bo_dcp_transactions.comment as dcp_comment,"
                        . " bo_dcp_transactions.created_at dcp_created"
                        . " from bo_dcp_transactions "
                        . " LEFT JOIN bo_infowiz_dcp_master "
                        . " ON  bo_dcp_transactions.dcp_id=bo_infowiz_dcp_master.id "
                        . " where mapping_id=$d_array[mapping_id]";
                $allData = $connection->createCommand($sql)->queryAll();  
                //print_r($allData);die;
                $app_docs['documents'][$key1]['document_name'] = $d_array['document_name'];
                $app_docs['documents'][$key1]['document_code'] = $d_array['document_code'];
                $app_docs['documents'][$key1]['document_file_name'] = $d_array['document_file_name'];
                $app_docs['documents'][$key1]['document_status'] = $d_array['document_status'];
                $app_docs['documents'][$key1]['used_date'] = $d_array['used_date'];
                $app_docs['documents'][$key1]['verified_on'] = $d_array['verified_on'];
                $app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
                $app_docs['documents'][$key1]['verifier_comments'] = htmlspecialchars($d_array['verifier_comments']);     
                $app_docs['documents'][$key1]['document_checkpoint'] = $allData;
                $temp_arr[] = $d_array['document_code'];
                ++$key1;
            } else {
                // All Docs Log
                $app_new_docs['documents'][$key2]['document_name'] = $d_array['document_name'];
                $app_new_docs['documents'][$key2]['document_code'] = $d_array['document_code'];
                $app_new_docs['documents'][$key2]['document_file_name'] = $d_array['document_file_name'];
                $app_new_docs['documents'][$key2]['document_status'] = $d_array['document_status'];
                $app_new_docs['documents'][$key2]['used_date'] = $d_array['used_date'];
                $app_new_docs['documents'][$key2]['verified_by'] = $d_array['verified_by'];
				$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
                $app_new_docs['documents'][$key2]['verified_on'] = $d_array['verified_on'];
                $app_new_docs['documents'][$key2]['verifier_comments'] = $d_array['verifier_comments'];
                ++$key2;
            }
        }
    }

    if (!empty($_POST)) {
        extract($_POST);
     
             $sqlData = "select sp_tag,
sp_app_id,
concat(service_id,'.',servicetype_additionalsubservice) as iwsID ,
core_service_name as service_name from bo_sp_applications as bsa 
LEFT JOIN bo_information_wizard_service_parameters as biwsa ON biwsa.swcs_service_id=bsa.sp_app_id 
 where bsa.sno=:sno 
AND biwsa.is_active='Y'";
        $command = $connection->createCommand($sqlData);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $serviceRelatedFields = $command->queryRow();
        // print_r($serviceRelatedFields);  die; 
        $app_docs['app_id'] = $app_id;
      //  $app_docs['app_id'] = '18401';
        $app_docs['legacy_service_id'] = @$serviceRelatedFields['sp_app_id'];
       // $app_docs['legacy_service_id'] = '11';
        $app_docs['infowiz_service_id'] = @$serviceRelatedFields['iwsID'];
        $app_docs['infowiz_service_name'] = @$serviceRelatedFields['service_name'];
        $app_docs['sp_tag'] = @$serviceRelatedFields['sp_tag'];
       
        $app_docs['IUID'] = $this->getIuid($user_id);
        $app_docs['created'] = date('Y-m-d H:i:s');
        $app_docs['remarks'] = htmlspecialchars($_POST['remarks']);
    }
      // print_r($app_docs); die;
    $sqlQry="select * from  bo_dms_status_update_to_dept where is_active='Y'";
     $command = $connection->createCommand($sqlQry);
        $command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_INT);
        $apiPostData = $command->queryRow();
        
        
       // print_r($apiPostData);die;
        
   // $typeOfDatatransfer="JSON";    
    if($apiPostData['content_type']=="XML"){
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        // function call to convert array to xml
        $this->arrayToXml($app_docs,$xml_data);
        //saving generated xml file; 
        $result1 = $xml_data->asXML();        
         $contentType= 'application/xml';
    }
    
     if($apiPostData['content_type']=="JSON"){
         $result1 = json_encode($app_docs);  
        $contentType= 'application/json';
     }
     
      $url=$apiPostData['post_url'];
  
    
    $ri="<x:Envelope xmlns:x='http://schemas.xmlsoap.org/soap/envelope/' xmlns:tem='http://tempuri.org/'>
    <x:Header>
      <tem:ValidationSoapHeader>
            <tem:APIKey>AVPTech</tem:APIKey><tem:Tokenkey>AVP@17Labour_</tem:Tokenkey></tem:ValidationSoapHeader></x:Header><x:Body><tem:UpdateObjection><tem:Data>$result1</tem:Data></tem:UpdateObjection></x:Body></x:Envelope>";

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $ri );
    $result = curl_exec($ch);

$xml = strip_tags($result);
$respArray=json_decode($xml);
 


            $this->generate_api_log($result1,$result,$ri);
 
         
            if(!empty($respArray)){ 
				if($respArray->Code==1001)
				 Yii::app()->user->setFlash('Success',$respArray->Remark);
		    else
			     Yii::app()->user->setFlash('Error',$respArray->Remark);
			}else{
				
			}
                $this->redirect('/backoffice/admin');


    }
	
	public function  actionPostStatusJsonOld   () {
   
    
    extract($_GET);
    // Get Application DMS Documents List With Integration Department List
    $connection = Yii::app()->db;

   /*  $sql = "SELECT dms_map.mapping_id,dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,bo_user.np_user_id,dms_map.comments as verifier_comments FROM 
            bo_application_dms_documents_mapping as dms_map 
            INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
            INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
            INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
            LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
			  INNER JOIN bo_user ON dms_map_log.dept_user_id=bo_user.uid
            WHERE sno=:sno GROUP BY dms.docchk_id ORDER BY dms_map.mapping_id DESC
            "; */
    $sql = "SELECT dms_map.mapping_id,dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,bo_user.np_user_id,dms_map.comments as verifier_comments FROM 
            bo_application_dms_documents_mapping as dms_map 
            INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
            INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
            INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
            LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
			  INNER JOIN bo_user ON dms_map_log.dept_user_id=bo_user.uid
            WHERE sno=:sno  ORDER BY dms_map.status,dms_map.mapping_id DESC
            ";
    $command = $connection->createCommand($sql);
    $command->bindParam(":sno", $sno, PDO::PARAM_INT);
    $modelDocuments = $command->queryAll();
/* 	echo "<pre>";
    print_r($modelDocuments); die; */
	
    
    $sql = "SELECT assigned_to from bo_sp_applications WHERE sno=:sno";    
    $command = $connection->createCommand($sql);
    $command->bindParam(":sno", $sno, PDO::PARAM_INT);
    $assignedTo = $command->queryRow();
    
    $app_docs = NULL;
    $app_new_docs = NULL;
    $key2 = $key1 = 0;
    if ($modelDocuments) {
        $temp_arr = array();
        $key1 = 0;
        foreach ($modelDocuments as $key => $d_array) {
            if (!in_array($d_array['document_code'], $temp_arr)) {
                
                $sql="select bo_infowiz_dcp_master.name as dcp_name,"
                        . " bo_infowiz_dcp_master.code as dcp_code,"
                        . " bo_dcp_transactions.dcp_value,"
                        . " bo_dcp_transactions.comment as dcp_comment,"
                        . " bo_dcp_transactions.created_at dcp_created"
                        . " from bo_dcp_transactions "
                        . " LEFT JOIN bo_infowiz_dcp_master "
                        . " ON  bo_dcp_transactions.dcp_id=bo_infowiz_dcp_master.id "
                        . " where mapping_id=$d_array[mapping_id]";
                $allData = $connection->createCommand($sql)->queryAll();  
                //print_r($allData);die;
                $app_docs['documents'][$key1]['document_name'] = $d_array['document_name'];
                $app_docs['documents'][$key1]['document_code'] = $d_array['document_code'];
                $app_docs['documents'][$key1]['document_file_name'] = $d_array['document_file_name'];
                $app_docs['documents'][$key1]['document_status'] = $d_array['document_status'];
                $app_docs['documents'][$key1]['used_date'] = $d_array['used_date'];
                $app_docs['documents'][$key1]['verified_on'] = $d_array['verified_on'];
                $app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
                $app_docs['documents'][$key1]['verifier_comments'] = htmlspecialchars($d_array['verifier_comments']);     
                $app_docs['documents'][$key1]['document_checkpoint'] = $allData;
                $temp_arr[] = $d_array['document_code'];
                ++$key1;
            } else {
                // All Docs Log
                $app_new_docs['documents'][$key2]['document_name'] = $d_array['document_name'];
                $app_new_docs['documents'][$key2]['document_code'] = $d_array['document_code'];
                $app_new_docs['documents'][$key2]['document_file_name'] = $d_array['document_file_name'];
                $app_new_docs['documents'][$key2]['document_status'] = $d_array['document_status'];
                $app_new_docs['documents'][$key2]['used_date'] = $d_array['used_date'];
                $app_new_docs['documents'][$key2]['verified_by'] = $d_array['verified_by'];
				$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
                $app_new_docs['documents'][$key2]['verified_on'] = $d_array['verified_on'];
                $app_new_docs['documents'][$key2]['verifier_comments'] = $d_array['verifier_comments'];
                ++$key2;
            }
        }
    }
	/* echo "<pre>";
	print_r($app_docs);die; */
    if (!empty($_POST)) {
        extract($_POST);
        $result1="";
       // echo '<pre>'; print_r($_POST);die;
        
        
        $sqlData = "select sp_tag,
		sp_app_id,
		concat(service_id,'.',servicetype_additionalsubservice) as iwsID ,
		core_service_name as service_name from bo_sp_applications as bsa 
		LEFT JOIN bo_information_wizard_service_parameters as biwsa ON biwsa.swcs_service_id=bsa.sp_app_id 
		 where bsa.sno=:sno 
		AND biwsa.is_active='Y'";
        $command = $connection->createCommand($sqlData);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $serviceRelatedFields = $command->queryRow();
        // print_r($serviceRelatedFields);  die; 
        $app_docs['app_id'] = $app_id;
        // $app_docs['app_id'] = '18401';
        $app_docs['legacy_service_id'] = @$serviceRelatedFields['sp_app_id'];
        // $app_docs['legacy_service_id'] = '11';
        $app_docs['infowiz_service_id'] = @$serviceRelatedFields['iwsID'];
        $app_docs['infowiz_service_name'] = @$serviceRelatedFields['service_name'];
        $spTag= $app_docs['sp_tag'] = @$serviceRelatedFields['sp_tag'];
       
        $app_docs['IUID'] = $this->getIuid($user_id);
        $app_docs['created'] = date('Y-m-d H:i:s');
        $app_docs['remarks'] = htmlspecialchars($_POST['remarks']);
    }
      // print_r($app_docs); die;
	$sqlQry="select * from  bo_dms_status_update_to_dept where  sp_tag='$spTag' AND is_active='Y'";
	$command = $connection->createCommand($sqlQry);
	$command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_INT);
	$apiPostData = $command->queryRow();
        
        
       // print_r($apiPostData);die;
         if($_SESSION['dept_id']==1){
            $app_docs['officerData']=$_SESSION;
            
        }
   // $typeOfDatatransfer="JSON";    
    if($apiPostData['content_type']=="XML"){
		$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		// function call to convert array to xml
		$this->arrayToXml($app_docs,$xml_data);
		//saving generated xml file; 
		$result1 = $xml_data->asXML();        
		$contentType= 'application/xml';
    }
    
	if($apiPostData['content_type']=="JSON"){
		$result1 = json_encode($app_docs);  
		$contentType= 'application/json';
	}
     
   // echo $result1;die;
    // print_r($result1); 
    // print_r($apiPostData);die; 
      $url=$apiPostData['post_url'];
  // $url = "http://investuttarakhand.co.in/backoffice/api/dms/getPostData";
  // $url = "http://www.uklabouracts.in/AttachmentObjection.asmx";
    
     
//    $ch = curl_init($url);
//    # Setup request to send json via POST.
//  
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $result1);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:text/xml"));   
//    # Return response instead of printing.
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//   // $rg=curl_setopt_array($ch, $result1);
//    # Send request.
//    $result = curl_exec($ch);    
   // echo $result1;die;
   // $url = "http://app.eiuttarakhand.in/Admin/RevertBackUrl.aspx";
    /*  echo $url;
	 echo "<br/>"; */
    $ri="<x:Envelope xmlns:x='http://schemas.xmlsoap.org/soap/envelope/' xmlns:tem='http://tempuri.org/'>
    <x:Header>
      <tem:ValidationSoapHeader>
            <tem:APIKey>AVPTech</tem:APIKey><tem:Tokenkey>AVP@17Labour_</tem:Tokenkey></tem:ValidationSoapHeader></x:Header><x:Body><tem:UpdateObjection><tem:Data>$result1</tem:Data></tem:UpdateObjection></x:Body></x:Envelope>";
	$ri=$result1;
	/*  echo $url;
	echo $ri; */
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
   // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $ri );
    $result = curl_exec($ch);
	//print_r($result);die();	
	$xml = strip_tags($result);
	$respArray=json_decode($xml);
	//$respArray=(array)$respArray;
	//print_r($xml);die; 


            $this->generate_api_log($result1,$result,$ri);
 
         
            if(!empty($respArray)){ 
				if($respArray->Code==1001)
				 Yii::app()->user->setFlash('Success',$respArray->Remark);
		    else
			     Yii::app()->user->setFlash('Error',$respArray->Remark);
			}else{
				
			}
                $this->redirect('/backoffice/admin');


    }
	
    /* Rahul  - Recieve Data via api */
    public

    function actionGetPostData() {
//echo $_SERVER['CONTENT_TYPE'];die;
          return  $_POST;
      //  die;
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $type = json_decode(file_get_contents('php://input'), true);
            $_POST = $type;
              print_r($_POST);
        die;
        }
        if ($_SERVER['CONTENT_TYPE'] == 'application/xml') {
            $type = file_get_contents('php://input'); 
            $_POST = simplexml_load_string($type);           
            print_r($_POST); 
            die;
        }
          print_r($_POST);die;
      
    }

    /* Rahul */

    function getIuid($uid = null) {
        $sql_s = "SELECT iuid from sso_users where user_id=$uid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_s);
        $res_s = $command->queryRow();
        if (count($res_s) > 0)
            return $res_s['iuid'];
        return false;
    }
    
    
    // function defination to convert array to xml
    function arrayToXml($data=null, $xml_data=null ) { 
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'item'.$key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            $this->arrayToXml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
     return $xml_data;
}


    private function generate_api_log($postData, $response,$postRawData) {
        
      
        $logModel = new NewApiAccessLog;
        $sp_tag = "NONE";
        $postData = json_decode($postData, TRUE);
        if (isset($postData['sp_tag']) && !empty($postData['sp_tag']))
            $sp_tag = $postData['sp_tag'];
        
       // print_r("Here 1"); die;
       // print_r($postData); die;
        if (is_array($postData)) {
            extract($postData);
            $logModel->sp_tag = $sp_tag;
            $logModel->log_type = 'DMS';
            $logModel->request_method = $_SERVER['REQUEST_METHOD'];
            $logModel->request_uri = $_SERVER['REQUEST_URI'];
            $logModel->request_time = $_SERVER['REQUEST_TIME'];
            $logModel->post_info = $postRawData;
            $logModel->user_agent = 'Api Access';
            $logModel->created_date_time = date("Y-m-d H:i:s");
            $logModel->remote_ip = $_SERVER['REMOTE_ADDR'];
            $logModel->response_return = $response;
             if ($logModel->save()) {
                return true;
            } else {
                var_dump($logModel->getErrors());
            }
            // return false;
        }
    }
    
    

	public function  actionPostStatusJson   () {


		extract($_GET);
		// Get Application DMS Documents List With Integration Department List
		$connection = Yii::app()->db;

		$sql = "SELECT dms_map.mapping_id,dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,bo_user.np_user_id,dms_map.comments as verifier_comments FROM 
		bo_application_dms_documents_mapping as dms_map 
		INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
		INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
		INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
		LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
		INNER JOIN bo_user ON dms_map_log.dept_user_id=bo_user.uid
		WHERE sno=:sno GROUP BY dms.docchk_id ORDER BY dms_map.mapping_id DESC
		";

		$command = $connection->createCommand($sql);
		$command->bindParam(":sno", $sno, PDO::PARAM_INT);
		$modelDocuments = $command->queryAll();
		//  print_r($modelDocuments);die;

		$sql = "SELECT assigned_to from bo_sp_applications WHERE sno=:sno";    
		$command = $connection->createCommand($sql);
		$command->bindParam(":sno", $sno, PDO::PARAM_INT);
		$assignedTo = $command->queryRow();

		$app_docs = NULL;
		$app_new_docs = NULL;
		$key2 = $key1 = 0;
		if ($modelDocuments) {
		$temp_arr = array();
		$key1 = 0;
		foreach ($modelDocuments as $key => $d_array) {
		if (!in_array($d_array['document_code'], $temp_arr)) {

		$sql="select bo_infowiz_dcp_master.name as dcp_name,"
				. " bo_infowiz_dcp_master.code as dcp_code,"
				. " bo_dcp_transactions.dcp_value,"
				. " bo_dcp_transactions.comment as dcp_comment,"
				. " bo_dcp_transactions.created_at dcp_created"
				. " from bo_dcp_transactions "
				. " LEFT JOIN bo_infowiz_dcp_master "
				. " ON  bo_dcp_transactions.dcp_id=bo_infowiz_dcp_master.id "
				. " where mapping_id=$d_array[mapping_id]";
		$allData = $connection->createCommand($sql)->queryAll();  
		//print_r($allData);die;
		$app_docs['documents'][$key1]['document_name'] = $d_array['document_name'];
		$app_docs['documents'][$key1]['document_code'] = $d_array['document_code'];
		$app_docs['documents'][$key1]['document_file_name'] = $d_array['document_file_name'];
		$app_docs['documents'][$key1]['document_status'] = $d_array['document_status'];
		$app_docs['documents'][$key1]['used_date'] = $d_array['used_date'];
		$app_docs['documents'][$key1]['verified_on'] = $d_array['verified_on'];
		$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
		$app_docs['documents'][$key1]['verifier_comments'] = htmlspecialchars($d_array['verifier_comments']);     
		$app_docs['documents'][$key1]['document_checkpoint'] = $allData;
		$temp_arr[] = $d_array['document_code'];
		++$key1;
		} else {
		// All Docs Log
		$app_new_docs['documents'][$key2]['document_name'] = $d_array['document_name'];
		$app_new_docs['documents'][$key2]['document_code'] = $d_array['document_code'];
		$app_new_docs['documents'][$key2]['document_file_name'] = $d_array['document_file_name'];
		$app_new_docs['documents'][$key2]['document_status'] = $d_array['document_status'];
		$app_new_docs['documents'][$key2]['used_date'] = $d_array['used_date'];
		$app_new_docs['documents'][$key2]['verified_by'] = $d_array['verified_by'];
		$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
		$app_new_docs['documents'][$key2]['verified_on'] = $d_array['verified_on'];
		$app_new_docs['documents'][$key2]['verifier_comments'] = $d_array['verifier_comments'];
		++$key2;
		}
		}
		}
		//print_r($app_docs);die;
		if (!empty($_POST)) {
		extract($_POST);
		$result1="";
		// echo '<pre>'; print_r($_POST);die;
		$sqlData = "select sp_tag,
		sp_app_id,
		concat(service_id,'.',servicetype_additionalsubservice) as iwsID ,
		core_service_name as service_name from bo_sp_applications as bsa 
		LEFT JOIN bo_information_wizard_service_parameters as biwsa ON biwsa.swcs_service_id=bsa.sp_app_id 
		where bsa.sno=:sno 
		AND biwsa.is_active='Y'";
		$command = $connection->createCommand($sqlData);
		$command->bindParam(":sno", $sno, PDO::PARAM_INT);
		$serviceRelatedFields = $command->queryRow();
		// print_r($serviceRelatedFields);  die; 
		$app_docs['app_id'] = $app_id;
		// $app_docs['app_id'] = '18401';
		$app_docs['legacy_service_id'] = @$serviceRelatedFields['sp_app_id'];
		// $app_docs['legacy_service_id'] = '11';
		$app_docs['infowiz_service_id'] = @$serviceRelatedFields['iwsID'];
		$app_docs['infowiz_service_name'] = @$serviceRelatedFields['service_name'];
		$spTag= $app_docs['sp_tag'] = @$serviceRelatedFields['sp_tag'];

		$app_docs['IUID'] = $this->getIuid($user_id);
		$app_docs['created'] = date('Y-m-d H:i:s');
		$app_docs['remarks'] = htmlspecialchars($_POST['remarks']);
		}
		// print_r($app_docs); die;
		$sqlQry="select * from  bo_dms_status_update_to_dept where  sp_tag='$spTag' AND is_active='Y'";
		$command = $connection->createCommand($sqlQry);
		$command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_INT);
		$apiPostData = $command->queryRow();


		//print_r($apiPostData);die;

		// $typeOfDatatransfer="JSON";    
		if($apiPostData['content_type']=="XML"){
		$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		// function call to convert array to xml
		$this->arrayToXml($app_docs,$xml_data);
		//saving generated xml file; 
		$result1 = $xml_data->asXML();        
		$contentType= 'application/xml';
		}

		if($apiPostData['content_type']=="JSON"){
		$result1 = json_encode($app_docs);  
		$contentType= 'application/json';
		}

		// echo $result1;die;
		// print_r($result1); 
		// print_r($apiPostData);die; 
		$url=$apiPostData['post_url'];	

		$ri="<x:Envelope xmlns:x='http://schemas.xmlsoap.org/soap/envelope/' xmlns:tem='http://tempuri.org/'>
		<x:Header>
		<tem:ValidationSoapHeader>
		<tem:APIKey>AVPTech</tem:APIKey><tem:Tokenkey>AVP@17Labour_</tem:Tokenkey></tem:ValidationSoapHeader></x:Header><x:Body><tem:UpdateObjection><tem:Data>$result1</tem:Data></tem:UpdateObjection></x:Body></x:Envelope>";
		$ri=$result1;


		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		// curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $ri );
		$result = curl_exec($ch);

		$xml = strip_tags($result);
		$respArray=json_decode($xml);
		//$respArray=(array)$respArray;

		$this->generate_api_log($result1,$result,$ri);


		if(!empty($respArray)){ 
		if($respArray->Code==1001)
		 Yii::app()->user->setFlash('Success',$respArray->Remark);
		else
		 Yii::app()->user->setFlash('Error',$respArray->Remark);
		}else{

		}
		/* print_r($ri);
		die('635'); */
		$this->redirect('/backoffice/admin');
    }
	
	public function  actionPostStatusJsonForNewCAF() 
	{
		extract($_GET);
		// Get Application DMS Documents List With Integration Department List
		$connection = Yii::app()->db;
		$sql = "SELECT dms_map.mapping_id,dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,bo_user.np_user_id,dms_map.comments as verifier_comments FROM 
		bo_application_dms_documents_mapping as dms_map 
		INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
		INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
		INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
		LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
		INNER JOIN bo_user ON dms_map_log.dept_user_id=bo_user.uid
		WHERE sno=:sno GROUP BY dms.docchk_id ORDER BY dms_map.mapping_id DESC";

		$command = $connection->createCommand($sql);
		$command->bindParam(":sno", $sno, PDO::PARAM_INT);
		$modelDocuments = $command->queryAll();
		//  print_r($modelDocuments);die;

		$sql = "SELECT assigned_to from bo_sp_applications WHERE sno=:sno";    
		$command = $connection->createCommand($sql);
		$command->bindParam(":sno", $sno, PDO::PARAM_INT);
		$assignedTo = $command->queryRow();

		$app_docs = NULL;
		$app_new_docs = NULL;
		$key2 = $key1 = 0;
		if ($modelDocuments) {
			$temp_arr = array();
			$key1 = 0;
			foreach ($modelDocuments as $key => $d_array) {
				if (!in_array($d_array['document_code'], $temp_arr)) 
				{
					$sql="select bo_infowiz_dcp_master.name as dcp_name,"
							. " bo_infowiz_dcp_master.code as dcp_code,"
							. " bo_dcp_transactions.dcp_value,"
							. " bo_dcp_transactions.comment as dcp_comment,"
							. " bo_dcp_transactions.created_at dcp_created"
							. " from bo_dcp_transactions "
							. " LEFT JOIN bo_infowiz_dcp_master "
							. " ON  bo_dcp_transactions.dcp_id=bo_infowiz_dcp_master.id "
							. " where mapping_id=$d_array[mapping_id]";
					$allData = $connection->createCommand($sql)->queryAll();  
					//print_r($allData);die;
					$app_docs['documents'][$key1]['document_name'] = $d_array['document_name'];
					$app_docs['documents'][$key1]['document_code'] = $d_array['document_code'];
					$app_docs['documents'][$key1]['document_file_name'] = $d_array['document_file_name'];
					$app_docs['documents'][$key1]['document_status'] = $d_array['document_status'];
					$app_docs['documents'][$key1]['used_date'] = $d_array['used_date'];
					$app_docs['documents'][$key1]['verified_on'] = $d_array['verified_on'];
					$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
					$app_docs['documents'][$key1]['verifier_comments'] = htmlspecialchars($d_array['verifier_comments']);     
					$app_docs['documents'][$key1]['document_checkpoint'] = $allData;
					$temp_arr[] = $d_array['document_code'];
					++$key1;
				} else {
					// All Docs Log
					$app_new_docs['documents'][$key2]['document_name'] = $d_array['document_name'];
					$app_new_docs['documents'][$key2]['document_code'] = $d_array['document_code'];
					$app_new_docs['documents'][$key2]['document_file_name'] = $d_array['document_file_name'];
					$app_new_docs['documents'][$key2]['document_status'] = $d_array['document_status'];
					$app_new_docs['documents'][$key2]['used_date'] = $d_array['used_date'];
					$app_new_docs['documents'][$key2]['verified_by'] = $d_array['verified_by'];
					$app_docs['documents'][$key1]['officer_key'] = @$assignedTo['assigned_to'];
					$app_new_docs['documents'][$key2]['verified_on'] = $d_array['verified_on'];
					$app_new_docs['documents'][$key2]['verifier_comments'] = $d_array['verifier_comments'];
					++$key2;
				}
			}
		}
		//print_r($app_docs);die;
		if (!empty($_POST)) {
			extract($_POST);
			$result1="";
			// echo '<pre>'; print_r($_POST);die;
			$sqlData = "select sp_tag,sp_app_id,concat(service_id,'.',servicetype_additionalsubservice) as iwsID ,
			core_service_name as service_name from bo_sp_applications as bsa 
			LEFT JOIN bo_information_wizard_service_parameters as biwsa ON biwsa.swcs_service_id=bsa.sp_app_id 
			where bsa.sno=:sno 
			AND biwsa.is_active='Y'";
			$command = $connection->createCommand($sqlData);
			$command->bindParam(":sno", $sno, PDO::PARAM_INT);
			$serviceRelatedFields = $command->queryRow();
			// print_r($serviceRelatedFields);  die; 
			$app_docs['app_id'] = $app_id;
			// $app_docs['app_id'] = '18401';
			$app_docs['legacy_service_id'] = @$serviceRelatedFields['sp_app_id'];
			// $app_docs['legacy_service_id'] = '11';
			$service_id = $app_docs['infowiz_service_id'] = @$serviceRelatedFields['iwsID'];
			$app_docs['infowiz_service_name'] = @$serviceRelatedFields['service_name'];
			$spTag= $app_docs['sp_tag'] = @$serviceRelatedFields['sp_tag'];

			$app_docs['IUID'] = $this->getIuid($user_id);
			$app_docs['created'] = date('Y-m-d H:i:s');
			$app_docs['remarks'] = htmlspecialchars($_POST['remarks']);
		}
		// print_r($app_docs); die;
		
		$apiPostData = Yii::app()->db->createCommand("select * from  bo_dms_status_update_to_dept where service_id ='$service_id' AND is_active='Y'")->queryRow();
		/* echo "<pre>";
		print_r($apiPostData);
		die("adasd"); */
		//print_r($apiPostData);die;

		// $typeOfDatatransfer="JSON";    
		if($apiPostData['content_type']=="XML"){
			$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
			// function call to convert array to xml
			$this->arrayToXml($app_docs,$xml_data);
			//saving generated xml file; 
			$result1 = $xml_data->asXML();        
			$contentType= 'application/xml';
		}

		if($apiPostData['content_type']=="JSON"){
			$result1 = json_encode($app_docs);  
			$contentType= 'application/json';
		}

		// echo $result1;die;
		/* print_r($result1); 
		print_r($apiPostData);die;  */
		$url=$apiPostData['post_url'];	

		/* $ri="<x:Envelope xmlns:x='http://schemas.xmlsoap.org/soap/envelope/' xmlns:tem='http://tempuri.org/'>
		<x:Header>
		<tem:ValidationSoapHeader>		<tem:APIKey>AVPTech</tem:APIKey><tem:Tokenkey>AVP@17Labour_</tem:Tokenkey></tem:ValidationSoapHeader></x:Header><x:Body><tem:UpdateObjection><tem:Data>$result1</tem:Data></tem:UpdateObjection></x:Body></x:Envelope>"; */
		$ri = $result1;
		echo "<pre>";
		print_r($_SESSION);
		
		 print_r($ri); 
		die();
		
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		// curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $ri );
		$result = curl_exec($ch);
		
		$xml = strip_tags($result);
		$respArray=json_decode($xml);
		//$respArray=(array)$respArray;
		
		$this->generate_api_log($result1,$result,$ri);


		if(!empty($respArray)){ 
			if($respArray->Code==1001)
				Yii::app()->user->setFlash('Success',$respArray->Remark);
			else
				Yii::app()->user->setFlash('Error',$respArray->Remark);
		}else{

		}
		/* print_r($ri);
		die('635'); */
		$this->redirect('/backoffice/admin');
    }

}
