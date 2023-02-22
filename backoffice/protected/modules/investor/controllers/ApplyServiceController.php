<?php

class ApplyServiceController extends Controller {

    public function actionIndex() {

        echo "Nothing found";
    }

    /**
     * 24-10-2017
     * @author: Santosh Kumar
     * @return:
     * @param:
     * */
    public function actionServiceListing() {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;

        $sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND sm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();

        $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND (
        ((application_status='A') AND (application_id IN ('1','11'))) OR ((application_status='P') AND (application_id IN ('11'))
        )) ORDER BY submission_id ASC	";


        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_caf);
        $res_caf = $command->queryAll();

        // Get all services list
        $res_s = false;
        $id = false;
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id                         
				  WHERE sm.issuerby_id='$id' AND sm.to_be_used_in_online_offline='Y'  AND sp.is_active='Y' ORDER BY service_name ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_s);
            $res_s = $command->queryAll();
        }


        $this->render("service_listing", array('res_d' => $res_d, 'res_caf' => $res_caf, 'res_s' => $res_s, 'id' => $id, 'user_id' => $user_id));
    }

    public function actionServiceListingNew($type = NULL) {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $_GET['type'];
        } else {
            $type = '';
            $where = '';
        }


        $user_id = $_SESSION['RESPONSE']['user_id'];
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;

        $sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
                . "  LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id  "
                . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND istm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();

        $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id IN ('1','11') ORDER BY submission_id ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_caf);
        $res_caf = $command->queryAll();

        // Get all services list
        $res_s = false;
        $id = false;
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
                                   LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
			  
				  WHERE sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y'  AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_s);
            $res_s = $command->queryAll();
        }


        $this->render("service_listing_new", array('res_d' => $res_d, 'res_caf' => $res_caf, 'res_s' => $res_s, 'id' => $id, 'user_id' => $user_id, 'type' => $type));
    }

    public function actionApplyServiceListing($type = NULL) {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $_GET['type'];
        } else {
            $type = '';
            $where = '';
        }


        $user_id = $_SESSION['RESPONSE']['user_id'];
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;

        $sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
                . "  LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id  "
                . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND istm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();


        $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND (
((application_status='A') AND (application_id IN ('1','11'))) OR ((application_status='P') AND (application_id IN ('11'))
)) ORDER BY submission_id ASC"; //added to show existting app with pending status also

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_caf);

        $res_caf = array(); //$command->queryAll();
        // Get all services list
        $res_s = false;
        $id = false;
        if(isset($_GET['id']) && $_GET['id'] > 0) 
		{
            $id = $_GET['id'];
			$sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
			INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
			LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
			WHERE sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y' AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_s);
            $res_s = $command->queryAll();

        //     echo '<pre>';
        // print_r($res_s);
        // die;
        }

        $this->render("service_listing_apply", array('res_d' => $res_d, 'res_caf' => $res_caf, 'res_s' => $res_s, 'id' => $id, 'user_id' => $user_id, 'type' => $type));
    }

    public function actionApplyServiceListingNew($type = NULL) {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $_GET['type'];
        } else {
            $type = '';
            $where = '';
        }


        $user_id = $_SESSION['RESPONSE']['user_id'];
        // Get department list from IW
        $base = Yii::app()->theme->baseUrl;

        $sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m INNER JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
                . "  LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id  "
                . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' AND istm.to_be_used_in_online_offline='Y' GROUP BY m.issuerby_id ORDER BY m.name ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_d = $command->queryAll();


        $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id IN ('1','11') ORDER BY submission_id ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_caf);
        $res_caf = $command->queryAll();

        // Get all services list
        $res_s = false;
        $id = false;
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id  
                                   LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
			  
				  WHERE sm.issuerby_id='$id' AND istm.to_be_used_in_online_offline='Y'  AND sp.is_active='Y' group by istm.sub_service_id ORDER BY service_name ASC";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_s);
            $res_s = $command->queryAll();
        }


        $this->render("service_listing_apply2", array('res_d' => $res_d, 'res_caf' => $res_caf, 'res_s' => $res_s, 'id' => $id, 'user_id' => $user_id, 'type' => $type));
    }

    /* ducument upload with valid from to and reference number tag 08052018 */

    public function actionDocumentsChecklist() {
        @session_start();
		
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }

        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = @$_SESSION['RESPONSE']['user_id'];
        $iuid = @$_SESSION['RESPONSE']['iuid'];
		
        // Start Upload DMS Data
        if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['tmp_name'])) {

            $doc_id = $_POST['FileUpload']['doc_id'];
            $issuer_id = $_POST['FileUpload']['issuer_id'];
            $issued_by = $_POST['FileUpload']['issued_by'];
            $docchk_id = $_POST['FileUpload']['doc_code'];
            $doc_version_type = $_POST['FileUpload']['doc_version_type'];
            $comments = @$_POST['FileUpload']['comments'];
            //echo $docchk_id."---";die;
            $my_doc_status = 'R';
            if (isset($_POST['FileUpload']['mydoc_status']) && $_POST['FileUpload']['mydoc_status'] == 'active') {
                $my_doc_status = 'Y';
            }
            $doc_chk_arr = $this->GetDocCheckID($docchk_id);
			/* echo "<pre>";
			print_r($doc_chk_arr); */
			$file_name = strtolower($_FILES['dms_doc_uploads']['name']);
            $file_size = $_FILES['dms_doc_uploads']['size'] / 1000;
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
			
            $allowed_ext = array('pdf','jpeg','jpg','png');
            if (!in_array($ext, $allowed_ext)) {
              	Yii::app()->user->setFlash('error', "This file type not allowed. Please upload correct file.");                
				$this->refresh();
				exit;
            }

            if ($file_size > 5000) {              
                Yii::app()->user->setFlash('error', "Maximum file size allowed is 5MB for $doc_chk_arr[name]. Please upload upto 5MB size file.");
                $this->refresh();
                exit;
            }
			
			//echo $doc_chk_arr['name'];die;
			/*if ($file_size > 2000 && ($doc_chk_arr['name']=='Document  1' || $doc_chk_arr['name']=='Document  2'  || $doc_chk_arr['name']=='Document 3')) 
			{
               	Yii::app()->user->setFlash('error', "Maximum file size allowed is 2MB for $doc_chk_arr[name]. Please upload upto 2MB size file.");     
				$this->refresh();
                exit;
            }
			if ($file_size > 5000 && ($doc_chk_arr['name']=='Document 4' || $doc_chk_arr['name']=='Document 5')) {              
				Yii::app()->user->setFlash('error', "Maximum file size allowed is 5MB for $doc_chk_arr[name]. Please upload upto 5MB size file.");
				$this->refresh();
                exit;
            }
            if ($file_size > 20000 && ($doc_chk_arr['name']=='Document 6')) {    
				Yii::app()->user->setFlash('error', "Maximum file size allowed is 20MB for $doc_chk_arr[name]. Please upload upto 20MB size file.");
				$this->refresh();
                exit;
            }*/
			
            $path = Yii::app()->basePath . "/../../themes/backend/mydoc/" . $iuid . "/";
            if (!file_exists($path)) {
                $oldmask = umask(0);
                mkdir($path, 0777, true);
                umask($oldmask);
            }
			
			
            if ($doc_chk_arr == false) {
                // Yii::app()->user->setFlash('error', "Document not matched with issuer and issued by.");
                $msg = "Document not matched with issuer and issued by.";
            } else {



                $chklist_id = $doc_chk_arr['chklist_id'];
                $docchk_id = $doc_chk_arr['docchk_id'];
                $name = $doc_chk_arr['name'];
                $version = $this->GetDocVersion($docchk_id, $iuid, $doc_version_type);
                $doc_ref_number = $iuid . "_" . $chklist_id . "_" . $doc_version_type . $version;
                $new_name = $doc_ref_number . "." . $ext;



				
                move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path . $new_name);

                // 64 id is a Pan Card Document below if code is for POC.  
                if($chklist_id=='UK-DCL-64'){
                    $file_path = $path . $new_name;
                    $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://api.ocr.space/parse/image',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array('apikey' => '854475b20a88957','isOverlayRequired' => 'true','file'=> new CURLFILE($file_path)),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                      // echo $response;

                       // $latest_record = Yii::app()->db->createCommand("SELECT * FROM bo_application_document_chklist_parsedata WHERE service_id='48.0'")->queryRow();
                    if($response!=NULL){
                       $doc_valid = false;
                       $message = $response;
                        $decode_data = json_decode($message,true); 
                      //  print_r(@$decode_data['ParsedResults']);
                        //die;
                        foreach ($decode_data['ParsedResults'] as $value) {
                          if(isset($value['TextOverlay'])){
                             foreach ($value['TextOverlay'] as $k=>$val) {

                                if($k=='Lines'){
                                   foreach ($val as $v) {                
                                    if($doc_valid == false){
                                       if(in_array('Permanent Account Number', $v)){
                                           $doc_valid = true;
                                          }else{
                                           $doc_valid = false;
                                          }                  
                                    }

                                   }
                                
                             }

                          }
                                
                        }

                        }

                        if($doc_valid == false){
                            Yii::app()->user->setFlash('error', "Please upload valid Pan Card.");
                                $this->refresh();
                                exit;
                        }
                     }
                }


                $model = new DmsDocuments;
                $model->docchk_id = $docchk_id;
                $model->doc_type_id = $doc_id;
                $model->issuer_id = $issuer_id;
                $model->issued_by_id = $issued_by;
                $model->iuid = $iuid;
                $model->sno = $_POST['srn_no'];
                $model->user_id = $user_id;
                $model->doc_ref_number = $doc_ref_number;
                $model->document_name = $new_name;
                $model->document_version = $version;
                $model->document_version_type = $doc_version_type;
                $model->doc_status = 'U';
                $model->comments = @$comments;
                $model->is_document_active = $my_doc_status;
                $model->created_on = date('Y-m-d H:i:s');
                $model->save();



                    $modelMap = new ApplicationDmsDocumentsMapping;
                    $modelMap->iuid =  $iuid;
                    $modelMap->user_id = $user_id;
                    $modelMap->doc_id = $doc_id;
                    $modelMap->sno = $_POST['srn_no'];
                    $modelMap->dept_id = $_POST['department_id'];
                    $modelMap->documents_id = $model->documents_id;
                    $modelMap->document_file_name =  $new_name;
                    $modelMap->status = 'U';
                    $modelMap->user_agent = 'Api Access';
                    $modelMap->created_on = date("Y-m-d H:i:s");
                    $modelMap->ip_address = $_SERVER['REMOTE_ADDR'];
                    $modelMap->usercomment = @$comments;
                    $modelMap->save();

                if ($modelMap->save()) {
                   /* if (isset($_POST['FileUpload']['documents_id'])) {
                        // Update previous
                        $documents_id = $_POST['FileUpload']['documents_id'];
                        $modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
                        $modelUp->is_uploaded = 'Y';
                        $modelUp->save();                       
                    }*/

                    Yii::app()->user->setFlash('success', "$name has been uploaded successfully.");
                    $msg = "success";
                } else {
                    echo '<pre>';
                    print_r($modelMap);
                    die;
                    //Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
                    $msg = "Error: Please contact support team.";
                }
            }
            $this->refresh();
            exit();
        }


        @extract($_GET);
		
        $sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' AND is_active='Y' ORDER BY id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_s = $command->queryRow();
         //echo "<pre>";print_r($res_s);die;
        $document_checklist_creation = $res_s['document_checklist_creation'];
        $mapped_documents_array = json_decode($document_checklist_creation, true);
		// echo "<pre>";print_r($mapped_documents_array);die;
        $document_type_mapping = $res_s['document_type_mapping'];
        $document_type_mapping_array = json_decode($document_type_mapping, true);
        $this->render("document_checklist1", array('mapped_documents_array' => $mapped_documents_array, 'iuid' => $iuid, 'document_type_mapping_array' => $document_type_mapping_array,'res_s'=>$res_s,'caf_id'=>$caf_id));
    }

    public function actionDocumentsChecklistold() {
        @session_start();

        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        // Start Upload DMS Data
        if (isset($_FILES) && !empty($_FILES['dms_doc_uploads']['tmp_name'])) {
            //echo '<pre>'; print_r($_POST); die;
            $file_name = strtolower($_FILES['dms_doc_uploads']['name']);
            $file_size = $_FILES['dms_doc_uploads']['size'] / 1000;
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_ext = array('pdf');
            if (!in_array($ext, $allowed_ext)) {
                echo $msg = "This file type not allowed. Please upload correct file.";
                exit;
            }
            if ($file_size > 25000) {
                echo $msg = "Maximum file size allowed is 25MB. Please upload upto 25MB file.";
                exit;
            }

            $path = Yii::app()->basePath . "/../../themes/backend/mydoc/" . $iuid . "/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $doc_id = $_POST['FileUpload']['doc_id'];
            $issuer_id = $_POST['FileUpload']['issuer_id'];
            $issued_by = $_POST['FileUpload']['issued_by'];
            $docchk_id = $_POST['FileUpload']['doc_code'];
            $doc_version_type = $_POST['FileUpload']['doc_version_type'];
            //echo $docchk_id."---";die;
            $my_doc_status = 'R';
            if (isset($_POST['FileUpload']['mydoc_status']) && $_POST['FileUpload']['mydoc_status'] == 'active') {
                $my_doc_status = 'Y';
            }
            $doc_chk_arr = $this->GetDocCheckID($docchk_id);
            if ($doc_chk_arr == false) {
                // Yii::app()->user->setFlash('error', "Document not matched with issuer and issued by.");
                $msg = "Document not matched with issuer and issued by.";
            } else {
                $chklist_id = $doc_chk_arr['chklist_id'];
                $docchk_id = $doc_chk_arr['docchk_id'];
                $name = $doc_chk_arr['name'];
                $version = $this->GetDocVersion($docchk_id, $iuid, $doc_version_type);
                $doc_ref_number = $iuid . "_" . $chklist_id . "_" . $doc_version_type . $version;
                $new_name = $doc_ref_number . "." . $ext;
                move_uploaded_file($_FILES['dms_doc_uploads']['tmp_name'], $path . $new_name);


                $model = new DmsDocuments;
                $model->docchk_id = $docchk_id;
                $model->doc_type_id = $doc_id;
                $model->issuer_id = $issuer_id;
                $model->issued_by_id = $issued_by;
                $model->iuid = $iuid;
                $model->user_id = $user_id;
                $model->doc_ref_number = $doc_ref_number;
                $model->document_name = $new_name;
                $model->document_version = $version;
                $model->document_version_type = $doc_version_type;
                $model->doc_status = 'U';
                $model->is_document_active = $my_doc_status;
                $model->created_on = date('Y-m-d H:i:s');
                if ($model->save()) {
                    if (isset($_POST['FileUpload']['documents_id'])) {
                        // Update previous
                        $documents_id = $_POST['FileUpload']['documents_id'];
                        $modelUp = DmsDocuments::model()->findByPk($documents_id); //$this->loadModel($documents_id);
                        $modelUp->is_uploaded = 'Y';
                        $modelUp->save();
                    }

                    Yii::app()->user->setFlash('success', "Your document uploaded successfully.");
                    $msg = "success";
                } else {
                    echo '<pre>';
                    print_r($model);
                    die;
                    //Yii::app()->user->setFlash('error', "Not saved...".$model->getErrors());
                    $msg = "Error: Please contact support team.";
                }
            }
            $this->refresh();
            exit();
        }


        @extract($_GET);
        $sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' AND is_active='Y' ORDER BY id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_s = $command->queryRow();
        //echo '<pre>'; print_r($res_s);
        $mapped_documents_array = array();
        if ($res_s['document_checkList'] == 'Y') {
            $document_checklist_creation = $res_s['document_checklist_creation'];
            $mapped_documents_array = json_decode($document_checklist_creation, true);
        }

        $document_type_mapping_array = array();
        if ($res_s['document_checkList'] == 'Y') {
            $document_type_mapping = $res_s['document_type_mapping'];
            $document_type_mapping_array = json_decode($document_type_mapping, true);
        }
        //echo '<pre>'; print_r($mapped_documents_array); die;
        $this->render("document_checklist", array('mapped_documents_array' => $mapped_documents_array, 'document_type_mapping_array' => $document_type_mapping_array, 'iuid' => $iuid));
    }

    public function actionSaveOfflineApplication() {
        // Save offline application
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        @extract($_POST);
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $service_name = '';
        $dept_id = 999;
        if (isset($_POST['service_id'])) {
            // Submit
            $model = new OfflineApplications;
            $model->offline_application_reference_number = "UK-OFF-" . $this->getRandomString(6) . rand(1111, 999999); //"UK-OFF-".rand(9999,99999);
            $model->iuid = $iuid;
            $model->user_id = $user_id;
            $model->service_id = $service_id;
            $model->sub_service_id = $sub_service_id;
            $model->department_id = $department_id;
            $model->caf_id = $caf_id;
            $model->offline_application_status = 'I';
            $model->user_agent = $user_agent;
            $model->ip_address = $remote_ip;
            $model->application_created_date = date('Y-m-d H:i:s');
            $model->application_updated_date = date('Y-m-d H:i:s');
            if ($model->save()) {
                $ref_number = $model->offline_application_reference_number;
                $offline_application_id = $model->offline_application_id;

                $service_parms = $this->getInfoWizServiceDetails($service_id, $sub_service_id);
                if ($service_parms) {
                    $service_name = $service_parms['core_service_name'];
                    $dept_id = $service_parms['department_id'];
                }
                // Create An application in bo_sp_application
                $offline_sp_tag = "UK-OFFLINE-" . $department_id . "-" . $service_id . "-" . $sub_service_id;
                $modelSP = new SpApplications;
                $modelSP->sp_tag = $offline_sp_tag;
                $modelSP->sp_app_id = $service_id;
                $modelSP->app_id = $offline_application_id;
                $modelSP->app_name = $service_name;
                $modelSP->app_fields = NULL;
                $modelSP->app_status = 'I';
                $modelSP->app_comments = 'OFFLINE APPLICATION SINGLE WINDOW';
                $modelSP->user_id = $user_id;
                $modelSP->is_applied_by_caf = $caf_id > 0 ? 'Y' : 'N';
                $modelSP->caf_id = $caf_id;
                $modelSP->unit_name = NULL;
                $modelSP->created_on = date('Y-m-d H:i:s');
                $modelSP->updated_on = date('Y-m-d H:i:s');
                $modelSP->is_active = 'Y';
                $modelSP->remote_server = $remote_ip;
                $modelSP->user_agent = $user_agent;
                $modelSP->is_offline_application = 'Y';
                $modelSP->offline_application_id = $offline_application_id;
                if ($modelSP->save()) {
                    $sno = $modelSP->sno;
                    // Save History
                    $modelSPH = new SpApplicationHistory;
                    $modelSPH->sp_app_id = $sno;
                    $modelSPH->service_id = $service_id;
                    $modelSPH->sp_tag = $offline_sp_tag;
                    $modelSPH->app_id = $offline_application_id;
                    $modelSPH->application_status = 'I';
                    $modelSPH->comments = 'Offline application submitted';
                    $modelSPH->added_date_time = date('Y-m-d H:i:s');
                    $modelSPH->save();
                    // END
                    // save DMS Files in table
                    if ($documents_id) {
                        $documents_id_arr = explode(",", $documents_id);
                        $documents_id_name_arr = explode(",", $documents_id_name);
                        foreach ($documents_id_arr as $key => $documents_id_data) {
                            // Department ID
                            $modelDMS = new ApplicationDmsDocumentsMapping;
                            $modelDMS->iuid = $iuid;
                            $modelDMS->user_id = $user_id;
                            $modelDMS->sno = $sno;
                            $modelDMS->dept_id = $dept_id;
                            $modelDMS->documents_id = $documents_id_data;
                            $modelDMS->document_file_name = $documents_id_name_arr[$key];
                            $modelDMS->status = 'U';
                            $modelDMS->user_agent = 'SWCS OFFLINE';
                            $modelDMS->created_on = date("Y-m-d H:i:s");
                            $modelDMS->ip_address = $remote_ip;
                            $modelDMS->save();
                        }
                    }
                } else {
                    return $this->redirect(Yii::$app->request->referrer);
                    //echo '<pre>'; print_r($modelSP->getErrors());
                }
            }
            // END
            //echo "SUCCESS";
            $this->redirect(array('ApplyService/StatutoryForm/appID/' . $offline_application_id . '/service_id/' . $service_id . '/sub_service_id/' . $sub_service_id . '/caf_id/' . $caf_id));
        }
    }

    public function actionStatutoryForm() {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        @extract($_GET);
        $paramDatas = $this->getSubServicesParameters($service_id, $sub_service_id);

        if (isset($_POST['service_id'])) {
            // Submit
            @extract($_POST);
            $path = Yii::app()->basePath . "/../../themes/backend/mydoc/" . $iuid . "/offline/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $new_name = '';
            if (isset($_FILES['statutory_form']['name'])) {

                $new_name = "statutory_form" . $iuid . "-" . time() . ".pdf";
                move_uploaded_file($_FILES['statutory_form']['tmp_name'], $path . $new_name);

                // Insert StatutoryForm 
                $model = new BoOfflineApplicationsOtherDocuments;
                $model->offline_application_id = $appID;
                $model->type_of_document = 'S';
                $model->document_name = 'Statutory Form';
                $model->document_file_name = $new_name;
                $model->status = 'U';
                $model->created_datetime = date('Y-m-d h:i:s');
                $model->save();
            } else {
                echo "DIE";
                die;
            }

            if (isset($_POST['document_name'])) {
                foreach ($_POST['document_name'] as $key => $value) {
                    if (trim($_POST['document_name'][$key]) != '') {
                        $new_name_other = "other_docs-" . $key . "-" . time() . ".pdf";
                        move_uploaded_file($_FILES['other_doc']['tmp_name'][$key], $path . $new_name_other);

                        $model = new BoOfflineApplicationsOtherDocuments;
                        $model->offline_application_id = $appID;
                        $model->type_of_document = 'O';
                        $model->document_name = $_POST['document_name'][$key];
                        $model->document_file_name = $new_name_other;
                        $model->status = 'U';
                        $model->created_datetime = date('Y-m-d h:i:s');
                        if (!$model->save()) {
                            
                        }
                    }
                }
            }

            // END
            $this->redirect(array('ApplyService/PaymentForm/appID/' . $appID . '/service_id/' . $service_id . '/sub_service_id/' . $sub_service_id . '/caf_id/' . $caf_id));
            //$this->redirect(array('PaymentForm'));
        }

        $this->render("statutory_form", array('subservivcesData' => $paramDatas));
    }

    public function actionPaymentForm() {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        @extract($_GET);
        $paymentData = $this->getServicePaymentDetails($service_id, $sub_service_id);
        if (!empty($_POST)) {
            @extract($_POST);
            $remote_ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $fee_receipt = NULL;
            if (isset($_FILES['fee_receipt']['name'])) {
                $path = Yii::app()->basePath . "/../../themes/backend/mydoc/" . $iuid . "/offline/";
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $fee_receipt = "fee-receipt-" . time() . ".pdf";
                move_uploaded_file($_FILES['fee_receipt']['tmp_name'], $path . $fee_receipt);
            }

            $model = new BoOfflineApplicationsPayment;
            $model->offline_application_id = $appID;
            $model->payment_mode = $payment_mode;
            $model->reference_no = $reference_no;
            $model->payment_details = 'Fee for Offline Application ID - ' . $appID;
            $model->amount = $fee_amount;
            $model->fee_receipt = $fee_receipt;
            $model->payment_status = 'S';
            $model->ip_address = $remote_ip;
            $model->user_agent = $user_agent;
            $model->payment_datetime = date('Y-m-d h:i:s');
            if ($model->save()) {
                Yii::app()->user->setFlash('Success', "Payment Saved Successfully");
                $this->redirect(array('ApplicationPreview', 'appID' => $appID, 'service_id' => $service_id, 'sub_service_id' => $sub_service_id, 'caf_id' => $caf_id));
                exit;
            }
        }


        $this->render("payment_form", array('paymentData' => $paymentData));
    }

    public function actionApplicationPreview() {

        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        @extract($_GET);

        $sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY service_id ASC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_d);
        $res_s = $command->queryRow();
        //echo '<pre>'; print_r($res_s);
        $document_checklist_creation = $res_s['document_checklist_creation'];
        $mapped_documents_array = json_decode($document_checklist_creation, true);

        $sql_app = "SELECT * FROM bo_offline_applications WHERE offline_application_id='$appID' ORDER BY offline_application_id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_app);
        $res_app = $command->queryRow();

        $sql_app_docs = "SELECT * FROM bo_offline_applications_other_documents WHERE offline_application_id='$appID' ORDER BY id ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_app_docs);
        $res_app_docs = $command->queryAll();

        $sql_app_pay = "SELECT * FROM bo_offline_applications_payment WHERE offline_application_id='$appID' ORDER BY payment_id DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_app_pay);
        $res_app_pay = $command->queryAll();



        if (isset($_POST['service_id'])) {
            @extract($_POST);
            $this->redirect(array('applyService/ModeOfSubmission/appID/' . $appID . '/service_id/' . $service_id . '/sub_service_id/' . $sub_service_id . '/caf_id/' . $caf_id));
        }
        $this->render("application_preview", array('mapped_documents_array' => $mapped_documents_array, 'iuid' => $iuid, 'res_app_docs' => $res_app_docs, 'res_app' => $res_app, 'res_app_pay' => $res_app_pay));
    }

    public function actionModeOfSubmission() {
        @session_start();
        if (!Yii::app()->user->isGuest) {
            throw new CHttpException(400, "you can't access this page");
        }
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);

        $user_id = $_SESSION['RESPONSE']['user_id'];
        $iuid = $_SESSION['RESPONSE']['iuid'];
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (isset($_POST['service_id'])) {
            //echo '<pre>'; print_r($_POST); die;
            @extract($_POST);
            $model = new OfflineModeOfSubmission;
            $model->offline_application_id = $appID;
            $model->mode_of_submission = $mode_of_submission;
            $model->tracking_details = $tracking_details;
            $model->submitted_to = $submitted_to;
            $model->name_of_office = $name_of_office;
            $model->date_of_submission = date('Y-m-d', strtotime($_POST['date_of_submission']));
            $model->created_date = date('Y-m-d h:i:s');
            $model->is_active = 'Y';
            if ($model->save()) {
                // Get details
                $district_id = 0;
                $department_id = 0;
                if ($submitted_to == "DIC") {
                    list($department_id, $district_id) = explode("~", $name_of_office);
                    /* $sql_au = "SELECT u.uid FROM bo_user u INNER JOIN bo_user_role_mapping m ON m.user_id=u.uid WHERE u.disctrict_id='$district_id' AND m.role_id=33";
                      $command=$connection->createCommand($sql_au);
                      $assignee_data = $command->queryRow();
                      $$assignee_id = $assignee_data['uid']; */
                }
                // END
                // Update --
                $connection = Yii::app()->db;
                $sql_up1 = "UPDATE bo_offline_applications SET offline_application_status='P' WHERE offline_application_id='$appID' AND user_id='$user_id'";
                $command = $connection->createCommand($sql_up1);
                $res_Up1 = $command->query();

                $sql_up2 = "UPDATE bo_sp_applications SET app_status='P',app_distt='$district_id' WHERE offline_application_id='$appID' AND user_id='$user_id'";
                $command = $connection->createCommand($sql_up2);
                $res_Up2 = $command->query();
                // END
                // Finally Submit and update and assign				
                $modelF = new BoOfflineForwardLevel;
                $modelF->offline_application_id = $appID;
                $modelF->sender = 'Investor';
                $modelF->sender_role = '';
                $modelF->sender_id = $user_id;
                $modelF->receiver = $submitted_to; // DIC,Department
                $modelF->receiver_role = '33'; // DIC role id 33
                $modelF->department_id = $department_id;
                $modelF->district_id = $district_id;
                $modelF->mode_of_submission_dic = '';
                $modelF->tracking_detail_dic = '';
                $modelF->comment = 'Application submitted...';
                $modelF->user_agent = $user_agent;
                $modelF->ip_address = $remote_ip;
                $modelF->status = 'P';
                $modelF->offline_status_id = '';
                $modelF->created_date = date('Y-m-d h:i:s');

                if ($modelF->save()) {
                    $datas = $this->GetDetails($appID);
                    //echo '<pre>'; print_r($datas); die;

                    $ref_no = $datas['offline_application_reference_number'];
                    //echo $ref_no; die;
                    // Send SMS & Email to investor
                    $invData = ApplyServiceExt::getInvestorDetails();
                    $mobile_number = $invData['mobile_number'];
                    $sms_msg = 'Your application has been successfully submitted. Your application reference number is:' . $ref_no;
                    DefaultUtility::sendOTPToMobile($mobile_number, $sms_msg);
                    //die;
                    //echo '<pre>'; print_r($invData); die;
                    $this->redirect(array('applyService/Thankyou/appID/' . $appID));
                    //echo '<pre>'; print_r($modelF->getErrors()); die;
                } else {
                    Yii::app()->user->setFlash('Error', "Saved with technical error.");
                }
            } else {
                //echo '<pre>'; print_r($model->getErrors()); die;
                Yii::app()->user->setFlash('Error', "Saved with technical error.");
            }
        }

        $this->render("mode_of_submission");
    }

    public function actionThankyou() {
        @extract($_GET);
        $datas = $this->GetDetails($appID);
        //echo '<pre>'; print_r($datas); die;
        $this->render("thankyou", array('datas' => $datas));
    }

    /* ---NEHA CODE-- */

    private function getServicePaymentDetails($serviceID, $subserviceID) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT * FROM bo_information_wizard_service_fee where service_id=:serviceID AND servicetype_additionalsubservice=:subserviceID";
        $command = $connection->createCommand($sql);
        $command->bindParam(":serviceID", $serviceID, PDO::PARAM_INT);
        $command->bindParam(":subserviceID", $subserviceID, PDO::PARAM_INT);
        $docList = $command->queryRow();
        return $docList;
    }

    private function getSubServicesParameters($serviceID, $subserviceID) {
        $connection = Yii::app()->db;
        $isactive = 'Y';
        $sql = "SELECT statutory_form_upload FROM bo_information_wizard_service_parameters where service_id=:serviceID AND servicetype_additionalsubservice=:subserviceID";
        $command = $connection->createCommand($sql);
        $command->bindParam(":serviceID", $serviceID, PDO::PARAM_INT);
        $command->bindParam(":subserviceID", $subserviceID, PDO::PARAM_INT);
        $docList = $command->queryRow();
        return $docList;
    }

    /*     * ** END --- */

    private function GetDocCheckID($docchk_id) {
        $doc_chk = false;

        $sql = "SELECT d.docchk_id,d.chklist_id,d.name FROM bo_infowizard_documentchklist as d WHERE d.docchk_id='$docchk_id' AND d.is_docchklist_active='Y' ORDER BY d.docchk_id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $doc_chk = $command->queryRow();
        if (count($doc_chk) > 0) {
            return $doc_chk;
        }

        return $doc_chk;
    }

    private function GetDocVersion($docchk_id, $iuid, $document_version_type = 'V') {
        $document_version = "1.0";

        $sql = "SELECT document_version FROM cdn_dms_documents WHERE docchk_id='$docchk_id' AND iuid='$iuid' AND document_version_type='$document_version_type' ORDER BY documents_id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $doc_ver = $command->queryRow();
        if (count($doc_ver) == 1) {
            $c_version = $doc_ver['document_version'];
            if ($c_version > 0) {
                $document_version = $c_version + 0.1;
            }
        }

        return $document_version;
    }

    private function GetDetails($appID) {
        $document_version = "1.0";

        $sql = "SELECT * FROM bo_offline_applications as ap WHERE offline_application_id='$appID' ORDER BY ap.offline_application_id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryRow();

        return $res;
    }

    public function actionGetRelatedData() {
        @extract($_POST);
        $op = '<select name="name_of_office" class="form-control" required> <option value="">--Select Office--</option>';
        if ($post_data) {
            $sql = "SELECT * FROM bo_offline_submitted_to_address  WHERE type_of_entity=:issID and is_active='Y'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(":issID", $post_data, PDO::PARAM_STR);
            $arr = $command->queryAll();
            if ($arr) {
                foreach ($arr as $key => $val_arr) {
                    $op .= '<option value="' . $val_arr['district_id'] . "~~" . $val_arr['issuerby_id'] . '">' . $val_arr['name_of_office'] . ' - ' . $val_arr['entity_id'] . '</option>';
                }
            }
        }
        $op .= '</select>';

        echo $op;
    }

    public function getInfoWizServiceDetails($service_id, $sub_service_id) {
        //bo_information_wizard_service_parameters
        $sql = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryRow();

        return $res;
    }

    public function getRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return strtoupper($string);
    }

    /**
     * 07-11-2017
     * @author: Santosh Kumar
     * @return:
     * @param:
     * */
    public function actionRedirectToDeprtmentURL() {
        @session_start();
        $data = false;
        $CAFFieldStatus = 204;
        $CAFFields = "";
        $app_url = false;
        $department_name = false;
        $caf_id = NULL;
        if (isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])) {
            // res_s
            //echo '<pre>';
            //print_r($_SESSION);
            //print_r($_REQUEST); die;
            @extract($_POST);
            if (isset($swcs_service_id) && $swcs_service_id > 0) {
                // Get Service URL by ID
                $criteria = new CDbCriteria;
                $criteria->condition = "app_id=:app_id";
                $criteria->params = array(":app_id" => $swcs_service_id);
                $serviceDatas = SpAllApplications::model()->find($criteria);
                if (!empty($serviceDatas)) {
                    $app_name = $serviceDatas['app_name'];
                    $app_url = $serviceDatas['app_url'];

                    // Get CAF details
                    if (isset($caf_id)) {
                        $criteria = new CDbCriteria;
                        $criteria->condition = "submission_id=:CafID";
                        $criteria->params = array(":CafID" => $caf_id);
                        $prevCaf = ApplicationSubmission::model()->find($criteria);
                        if (!empty($prevCaf)) {
                            $CAFFieldStatus = 200;
                            $CAFFields = $prevCaf->field_value;
                        }
                    }
                    if (isset($swcs_department_id)) {
                        // OLD CODE FETCH FROM DEPARTMENT
                        /* $criteria=new CDbCriteria;
                          $criteria->condition="dept_id=:dept_id";
                          $criteria->params=array(":dept_id"=>$swcs_department_id);
                          $deptObj=Departments::model()->find($criteria);
                          if(!empty($deptObj)){
                          $department_name=$deptObj->department_name;
                          } */

                        // FETCH FROM SSO_SERVICE_PROVIDER

                        $sql_d = "SELECT name FROM bo_infowizard_issuerby_master WHERE sp_id='$swcs_department_id'";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_d);
                        $res_d = $command->queryRow();
                        if (!empty($res_d)) {
                            $department_name = $res_d['name'];
                        }
                    }

                    if ($department_id == 18) {

                        $cafId = DefaultUtility::getEncryption($caf_id);
                        $CafFields = json_decode($CAFFields);
                        $company_name = DefaultUtility::getEncryption($CafFields->company_name);
                        $firstName = DefaultUtility::getEncryption($_SESSION['RESPONSE']['first_name']);
                        $lastName = DefaultUtility::getEncryption($_SESSION['RESPONSE']['last_name']);
                        $mobileNumber = DefaultUtility::getEncryption($_SESSION['RESPONSE']['mobile_number']);
                        $emailId = DefaultUtility::getEncryption($_SESSION['RESPONSE']['email']);
                        $panNumber = DefaultUtility::getEncryption($_SESSION['RESPONSE']['pan_card']);
                        $projectAddress = DefaultUtility::getEncryption($CafFields->Address);
                        $projectPinCode = DefaultUtility::getEncryption($_SESSION['RESPONSE']['pin_code']);
                        $serviceCode = DefaultUtility::getEncryption($swcs_service_id);

                        $active_token = $_SESSION['RESPONSE']['token'];
                        $data['full_name'] = $_SESSION['RESPONSE']['first_name'] . " " . $_SESSION['RESPONSE']['last_name'];
                        $data['email'] = $_SESSION['RESPONSE']['email'];
                        $data['mobile'] = $_SESSION['RESPONSE']['mobile_number'];
                        $data['SSO_MESSAGE'] = "SUCCESS";
                        $data['SSO_STATUS_CODE'] = "200";
                        $data['SSO_TOKEN'] = $active_token;
                        $data['SSO_HREF'] = TOKEN_API_BASEURL . "/apiv1/gettokeninfo/token/" . $active_token;
                        $data['CAFFields'] = @$CAFFields;
                        $data['CAFFieldStatus'] = $CAFFieldStatus;
                        $data['service_name'] = $app_name;
                        $data['service_id'] = $swcs_service_id;
                        $data['department_name'] = $department_name;
                        $data['swsUserId'] = @$cafId;
                        $data['organizationName'] = @$company_name;
                        $data['firstName'] = @$firstName;
                        $data['lastName'] = @$lastName;
                        $data['mobileNumber'] = @$mobileNumber;
                        $data['emailId'] = @$emailId;
                        $data['panNumber'] = @$panNumber;
                        $data['projectPinCode'] = @$projectPinCode;
                        $data['projectAddress'] = @$projectAddress;
                        $data['serviceCode'] = @$serviceCode;
                        //$data['caf_application_id'] = $caf_id;
                        //$data['CALL_BACK_URL'] = $app_url;
                    } else {
                        $active_token = $_SESSION['RESPONSE']['token'];
                        $data['full_name'] = $_SESSION['RESPONSE']['first_name'] . " " . $_SESSION['RESPONSE']['last_name'];
                        $data['email'] = $_SESSION['RESPONSE']['email'];
                        $data['mobile'] = $_SESSION['RESPONSE']['mobile_number'];
                        $data['SSO_MESSAGE'] = "SUCCESS";
                        $data['SSO_STATUS_CODE'] = "200";
                        $data['SSO_TOKEN'] = $active_token;
                        $data['SSO_HREF'] = TOKEN_API_BASEURL . "/apiv1/gettokeninfo/token/" . $active_token;
                        $data['CAFFields'] = $CAFFields;
                        $data['CAFFieldStatus'] = $CAFFieldStatus;
                        $data['service_name'] = $app_name;
                        $data['service_id'] = $swcs_service_id;
                        $data['department_name'] = $department_name;
                        $data['caf_application_id'] = $caf_id;
                        //$data['CALL_BACK_URL'] = $app_url;
                    }
                }
                // echo '<pre>';print_r($data); die;
            }
        }
        /* print_r($data);
          die($app_url);
         */
        $this->render("redirectForm", array('data' => $data, 'app_url' => $app_url));
    }

    public function actionRedirectToDeprtmentURLNew() {
        @session_start();
        $data = false;
        $CAFFieldStatus = 204;
        $CAFFields = "";
        $app_url = false;
        $department_name = false;
        $caf_id = NULL;
        $fields = "{}";

        if (isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])) {
            // res_s
            //echo '<pre>';
            //print_r($_SESSION);

            @extract($_POST);

            if (isset($swcs_service_id) && $swcs_service_id > 0) {
                // Get Service URL by ID
                $criteria = new CDbCriteria;
                $criteria->condition = "app_id=:app_id";
                $criteria->params = array(":app_id" => $swcs_service_id);
                $serviceDatas = SpAllApplications::model()->find($criteria);

                if (!empty($serviceDatas)) {
                    $app_name = $serviceDatas['app_name'];
                    $app_url = $serviceDatas['app_url'];

                    // Get CAF details
                    if (isset($caf_id)) {
                        $criteria = new CDbCriteria;
                        $criteria->condition = "submission_id=:CafID";
                        $criteria->params = array(":CafID" => $caf_id);

                        $prevCaf = ApplicationSubmission::model()->find($criteria);
                        if (!empty($prevCaf)) {
                            $CAFFieldStatus = 200;
                            $CAFFields = $prevCaf->field_value;
                        } else {
                            $prevCaf = MappingExt::getNewCafMapping($caf_id);
                            if (!empty($prevCaf)) {
                                $CAFFieldStatus = 200;
                                $CAFFields = $prevCaf;
                            }
                        }
                    }
                    if (isset($swcs_department_id)) {
                        // OLD CODE FETCH FROM DEPARTMENT
                        /* $criteria=new CDbCriteria;
                          $criteria->condition="dept_id=:dept_id";
                          $criteria->params=array(":dept_id"=>$swcs_department_id);
                          $deptObj=Departments::model()->find($criteria);
                          if(!empty($deptObj)){
                          $department_name=$deptObj->department_name;
                          } */

                        // FETCH FROM SSO_SERVICE_PROVIDER

                        $sql_d = "SELECT name FROM bo_infowizard_issuerby_master WHERE issuerby_id='$swcs_department_id'";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql_d);
                        $res_d = $command->queryRow();
                        if (!empty($res_d)) {
                            $department_name = $res_d['name'];
                        }
                    }


                    if ($department_id == 18) {

                        $cafId = DefaultUtility::getEncryption($caf_id);
                        //$CafFields=json_decode($CAFFields);
                        //$oldfields = MappingExt::getAllCafMappingFieldsOld($CafFields,$fields) ;
                        //echo "<pre>" ; print_r($CafFields);		die ;	

                        $company_name = isset($oldfields['company_name']) ? $oldfields['company_name'] : '';
                        $projectAddress = isset($oldfields['Address']) ? $oldfields['Address'] : '';


                        $firstName = DefaultUtility::getEncryption($_SESSION['RESPONSE']['first_name']);
                        $lastName = DefaultUtility::getEncryption($_SESSION['RESPONSE']['last_name']);
                        $mobileNumber = DefaultUtility::getEncryption($_SESSION['RESPONSE']['mobile_number']);
                        $emailId = DefaultUtility::getEncryption($_SESSION['RESPONSE']['email']);
                        $panNumber = DefaultUtility::getEncryption($_SESSION['RESPONSE']['pan_card']);

                        $projectPinCode = DefaultUtility::getEncryption($_SESSION['RESPONSE']['pin_code']);
                        $serviceCode = DefaultUtility::getEncryption($swcs_service_id);

                        $active_token = $_SESSION['RESPONSE']['token'];
                        $data['full_name'] = $_SESSION['RESPONSE']['first_name'] . " " . $_SESSION['RESPONSE']['last_name'];
                        $data['email'] = $_SESSION['RESPONSE']['email'];
                        $data['mobile'] = $_SESSION['RESPONSE']['mobile_number'];
                        $data['SSO_MESSAGE'] = "SUCCESS";
                        $data['SSO_STATUS_CODE'] = "200";
                        $data['SSO_TOKEN'] = $active_token;
                        $data['SSO_HREF'] = TOKEN_API_BASEURL . "/apiv1/gettokeninfo/token/" . $active_token;
                        $data['CAFFields'] = @$CAFFields;
                        $data['CAFFieldStatus'] = $CAFFieldStatus;
                        $data['service_name'] = $app_name;
                        $data['service_id'] = $swcs_service_id;
                        $data['department_name'] = $department_name;
                        $data['swsUserId'] = @$cafId;

                        $data['organizationName'] = @$company_name;
                        $data['projectAddress'] = @$projectAddress;

                        $data['firstName'] = @$firstName;
                        $data['lastName'] = @$lastName;
                        $data['mobileNumber'] = @$mobileNumber;
                        $data['emailId'] = @$emailId;
                        $data['panNumber'] = @$panNumber;
                        $data['projectPinCode'] = @$projectPinCode;

                        $data['serviceCode'] = @$serviceCode;
                        //$data['caf_application_id'] = $caf_id;
                        //$data['CALL_BACK_URL'] = $app_url;
                    } else {
                        $active_token = $_SESSION['RESPONSE']['token'];
                        $data['full_name'] = $_SESSION['RESPONSE']['first_name'] . " " . $_SESSION['RESPONSE']['last_name'];
                        $data['email'] = $_SESSION['RESPONSE']['email'];
                        $data['mobile'] = $_SESSION['RESPONSE']['mobile_number'];
                        $data['SSO_MESSAGE'] = "SUCCESS";
                        $data['SSO_STATUS_CODE'] = "200";
                        $data['SSO_TOKEN'] = $active_token;
                        $data['SSO_HREF'] = TOKEN_API_BASEURL . "/apiv1/gettokeninfo/token/" . $active_token;
                        $data['CAFFields'] = $CAFFields;
                        $data['CAFFieldStatus'] = $CAFFieldStatus;
                        $data['service_name'] = $app_name;
                        $data['service_id'] = $swcs_service_id;
                        $data['department_name'] = $department_name;
                        $data['caf_application_id'] = $caf_id;
                        $data['stype'] = @$stype;
                        //$data['CALL_BACK_URL'] = $app_url;
                    }
                }
                //echo '<pre>';print_r($data); die;
            }
        }
        //echo $app_url;die;
        /*  echo "<pre>";
          print_r($data);die; */
        $this->render("redirectForm", array('data' => $data, 'app_url' => $app_url));
    }

    public function actionRedirectToDeprtmentURLNew1() {
        @session_start();
        $data = false;
        $CAFFieldStatus = 204;
        $CAFFields = "";
        $app_url = false;
        $department_name = false;
        $caf_id = NULL;
        $fields = "{}";

        if (isset($_SESSION) && !empty($_SESSION)) {

            @extract($_POST);
            //@extract($_GET);



            $get_investor = "SELECT a.user_id,a.iuid,a.email,b.mobile_number,b.first_name,b.last_name  from sso_users as a inner join sso_profiles as b ON a.user_id=b.user_id where a.user_id=$user_id";

            $connection = Yii::app()->db;
            $command = $connection->createCommand($get_investor);
            $invData = $command->queryRow();

            if (isset($swcs_service_id) && $swcs_service_id > 0) {
                // Get Service URL by ID
                $criteria = new CDbCriteria;
                $criteria->condition = "app_id=:app_id";
                $criteria->params = array(":app_id" => $swcs_service_id);
                $serviceDatas = SpAllApplications::model()->find($criteria);

                if (!empty($serviceDatas)) {
                    $app_name = $serviceDatas['app_name'];
                    $app_url = $serviceDatas['app_url'];
                    $data['full_name'] = $invData['first_name'] . " " . $invData['last_name'];
                    $data['email'] = $invData['email'];
                    $data['mobile'] = $invData['mobile_number'];
                    $data['iuid'] = $invData['iuid'];
                    $data['user_id'] = $invData['user_id'];
                    $data['SSO_MESSAGE'] = "SUCCESS";
                    $data['SSO_STATUS_CODE'] = "200";
                }
            }
        }
        //die($app_url);
        $this->render("redirectForm", array('data' => $data, 'app_url' => $app_url));
    }

    /** ===END=== * */
    public function actionGetLicenseList() {

        if (empty($_POST)) {
            $this->redirect(array("/frontuser/ApplyService/ApplyServiceListing/is/no/type/PO/id/94"));
        }
        $user_id = $_SESSION['RESPONSE']['user_id'];

        $service_id1 = @$_POST['service_id'];
        $sub_service_id = @$_POST['sub_service_id'];

        $service_id = $service_id1 . '.' . $sub_service_id;


        $mainServiceId = $service_id1 . '.0';

        $sqlLicen = "SELECT bo_lm_approval_certificate.*,bosp.core_service_name,CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice),bo_district.distric_name FROM bo_lm_approval_certificate 
		LEFT JOIN sso_users ON sso_users.iuid = bo_lm_approval_certificate.iuid 
		LEFT JOIN bo_information_wizard_service_parameters as bosp ON CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice) = bo_lm_approval_certificate.service_id 
		LEFT JOIN bo_district ON bo_district.district_id = 	bo_lm_approval_certificate.district_id
		WHERE sso_users.user_id='$user_id' AND bo_lm_approval_certificate.service_id ='$mainServiceId' AND bosp.is_active='Y'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlLicen);
        $resLice = $command->queryAll();

        $sqlExistLicence = "SELECT submission_id FROM bo_new_application_submission WHERE service_id = $service_id and user_id = $user_id and application_status IN('H','I','DP','PD') ORDER BY submission_id DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sqlExistLicence);
        $ExistLice = $command->queryRow();
        if (isset($ExistLice) && !empty($ExistLice)) {
            $resLice[0]['app_id'] = $ExistLice['submission_id'];
        }

        $this->render("get_license_list", array('resLice' => $resLice, 'data' => $_POST));
    }

}

?>
