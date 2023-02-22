<?php

class DepartmentDMSNewController extends Controller {

    public function actionIndex() {
        $this->redirect('/');
        exit;
    }

    public function actionView() {
        @session_start();

        //echo $_SERVER['DOCUMENT_ROOT'];
        //echo Yii::app()->basePath."/../../themes/backend/dms/".$iuid."/"; die;	
        //echo '<pre>'; print_r($_SESSION); die;
        if (!isset($_SESSION['department_login']) || !$_SESSION['department_login']) {
            $this->redirect('/');
            exit;
        }
        $flag = 0;

        if ($_SESSION['role_id'] == 7 || $_SESSION['role_id'] == 4 || $_SESSION['role_id'] == 83 || $_SESSION['role_id'] == 89 || $_SESSION['role_id'] == 87 || $_SESSION['role_id'] == 88 || $_SESSION['role_id'] == 3) {
            $flag = 1;
        }
        if (!DefaultUtility::isValidDocumentVerifierLogin() && $flag == 0) {
            $this->redirect('/');
            exit;
        }
        $sno = base64_decode($_GET['sno']);
        $user_id = base64_decode($_GET['user']);

        $this->render('dms_listing_department', array('sno' => $sno, 'user_id' => $user_id));
    }

    public function downloadFile($fullpath) {
        if (!empty($fullpath)) {
            $ext = pathinfo($fullpath, PATHINFO_EXTENSION);
            if (strtolower($ext) == 'pdf') {
                $ctype = "application/pdf";
            } else {
                $ctype = "image/jpeg";
            }
            //$new_name = time().".".$ext;
            header("Content-type:$ctype");
            header('Content-Disposition: attachment; filename="' . basename($fullpath) . '"');
            //header('Content-Length: ' . filesize($fullpath));
            readfile($fullpath);
            Yii::app()->end();
        }
    }

    public function actionDownloadMyDocument() {
        @session_start();
        $msg = "";
        if (!isset($_SESSION['department_login']) || !$_SESSION['department_login']) {
            $this->redirect('/');
            exit;
        }

        if (!DefaultUtility::isValidDocumentVerifierLogin()) {
            $this->redirect('/');
            exit;
        }
        if (isset($_GET['ref_no'])) {
            $ref_no = base64_decode($_GET['ref_no']);
            $iuid = base64_decode($_GET['iuid']);
            $sql = "SELECT * FROM cdn_dms_documents WHERE iuid='$iuid' AND doc_ref_number='$ref_no' LIMIT 1";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $res = $command->queryRow();
            if (count($res) > 0) {
                $link = FRONT_BASEURL . "themes/backend/mydoc/" . $res['iuid'] . "/" . $res['document_name'];
                $this->downloadFile($link);
            } else {
                $msg = 'Error. Please try again.';
            }
        } else {
            $msg = 'invalid access';
        }

        echo $msg;
    }

    public function actionDepartmentActionOnDocument() {
        @session_start();
        $msg = "";
        $next_msg = "";
        if (!isset($_SESSION['department_login']) || !$_SESSION['department_login']) {
            $this->redirect('/');
            exit;
        }

        if (!DefaultUtility::isValidDocumentVerifierLogin()) {
            //$this->redirect('/');
            //exit;
        }
        if (isset($_POST['mapid']) && isset($_POST['did'])) {
            $mapid = base64_decode($_POST['mapid']);
            $did = base64_decode($_POST['did']);
            $uid = base64_decode($_POST['uid']);
            $comments = trim($_POST['comment']);
            $action = $_POST['action'];
            $dept_user_id = $_SESSION['uid'];
            $uname = $_SESSION['uname'];
            $remote_ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $is_uploaded_flag_wh = '';
            if ($action == 'verify') {
                $status = 'V';
                $sms_status = "Approved";
                $is_uploaded_flag_wh = '';
                $comments = $comments == '' ? 'Verified' : $comments;
            } else if ($action == 'reject') {
                $status = 'R';
                $sms_status = "Rejected";
                $is_uploaded_flag_wh = ' ,is_uploaded_flag=0';
            } else {
                echo "invalid";
                exit;
            }

            $connection = Yii::app()->db;
            // bo_application_dms_documents_mapping
            // cdn_dms_documents -- doc_ref_number,document_name
            // bo_infowizard_documentchklist -- name,chklist_id
            // sso_users - first_name,last_name

            $sql = "SELECT p.mobile_number,p.first_name,p.last_name,u.email,apps.app_id,dms.doc_status,map.document_file_name FROM bo_application_dms_documents_mapping as map,cdn_dms_documents as dms,sso_profiles as p,sso_users as u,bo_sp_applications as apps WHERE map.mapping_id=:mapping_id AND map.documents_id=:documents_id AND map.documents_id=dms.documents_id AND u.user_id=map.user_id AND p.user_id=u.user_id AND map.sno=apps.sno";

            $command = $connection->createCommand($sql);
            $command->bindParam(":mapping_id", $mapid, PDO::PARAM_INT);
            $command->bindParam(":documents_id", $did, PDO::PARAM_INT);
            $doc_array = $command->queryRow();
            if ($doc_array === false) {
                $msg = "Invalid Attempt";
                exit;
            } else {
                //echo '<pre>'; print_r($doc_array);
                //echo json_encode($doc_array);
                $cdate = date("Y-m-d H:i:s");
                $document_file_name = $doc_array['document_file_name'];
                $app_id = $doc_array['app_id'];
                $file_array = explode("_", $document_file_name);
                $file_code = $file_array[1];
                $file_version = str_replace(".pdf", "", $file_array[2]);

                $sql_up_map = "UPDATE bo_application_dms_documents_mapping SET status='$status',comments='$comments',last_updated='$cdate' $is_uploaded_flag_wh WHERE mapping_id='$mapid' AND documents_id='$did'";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql_up_map);
                if ($command->query()) {
                    if (!empty($is_uploaded_flag_wh) && $is_uploaded_flag_wh != '') {
                        // 
                        $sql_dm = "SELECT * FROM bo_application_dms_documents_mapping WHERE mapping_id='$mapid' AND documents_id='$did'";
                        $command = $connection->createCommand($sql_dm);
                        $dm_array = $command->queryRow();

                        //
                        $sql_d = "SELECT * FROM cdn_dms_documents WHERE documents_id='$did'";
                        $command = $connection->createCommand($sql_d);
                        $d_array = $command->queryRow();
                        if (!empty($d_array)) {
                            $docchk_id = $d_array['docchk_id'];
                            $user_id = $d_array['user_id'];
                            $iuid = $d_array['iuid'];
                            $sql_l = "SELECT * FROM cdn_dms_documents WHERE docchk_id='$docchk_id' AND user_id='$user_id' AND doc_status IN ('U','V') AND documents_id>'$did' AND is_document_active='Y' ORDER BY documents_id DESC LIMIT 1";
                            $command = $connection->createCommand($sql_l);
                            $l_array = $command->queryRow();
                            if (!empty($l_array)) {
                                $sno = $dm_array['sno'];
                                $dept_id = $dm_array['dept_id'];
                                $documents_id = $l_array['documents_id'];
                                $used_file_name = $l_array['document_name'];
                                $this->insertDMSUsedDocs($iuid, $user_id, $sno, $dept_id, $documents_id, $used_file_name);

                                $file_array_new = explode("_", $used_file_name);
                                $file_code_new = $file_array_new[1];
                                $file_version_new = str_replace(".pdf", "", $file_array_new[2]);
                                $next_msg = "Since, new version of rejected document is already uploaded so " . $file_version_new . " will be consumed for further process.";
                            }
                        }
                    }


                    // Generate Log -- bo_application_dms_documents_mapping_logs
                    $logModel = new ApplicationDmsDocumentsMappingLogs;
                    $logModel->mapping_id = $mapid;
                    $logModel->documents_id = $did;
                    $logModel->status = $status;
                    $logModel->dept_user_id = $dept_user_id;
                    $logModel->verifier_name = $uname;
                    //$logModel->verifier_designation	= 'NA';
                    $logModel->verifier_comments = $comments;
                    $logModel->created_time = $cdate;
                    $logModel->remote_ip = $remote_ip;

                    // if document in one go  Rahul :09092018
                    $docinonegochecksql = "select * from bo_infowizard_subservice_tag_mapping where to_be_used_in_dms_one_go='Y' AND is_active='Y' AND sub_service_id IN (SELECT concat(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice) as iw_service_id from bo_sp_applications as app INNER JOIN bo_information_wizard_service_parameters as biwsp   ON app.sp_app_id=biwsp.swcs_service_id
WHERE app.sno=3247 AND biwsp.is_active='Y')";
                    $command = $connection->createCommand($docinonegochecksql);
                    $allResult = $command->queryRow();
                    if (!empty($allResult)) {
                        $logModel->is_draft = 1;
                    }


                    $logModel->user_agent = $user_agent;
                    $logModel->save();
                    // END OF Log

                    if ($doc_array['doc_status'] == 'U' && $status == 'V') {
                        $new_status = 'V';
                        $is_uploaded = 'Y';
                    } else if ($doc_array['doc_status'] == 'V' && $status == 'V') {
                        $new_status = 'V';
                        $is_uploaded = 'Y';
                    } else if ($doc_array['doc_status'] == 'U' && $status == 'R') {
                        $new_status = 'R';
                        $is_uploaded = 'N';
                    } else if ($doc_array['doc_status'] == 'V' && $status == 'R') {
                        $new_status = 'M';
                        $is_uploaded = 'N';
                    } else if ($doc_array['doc_status'] == 'R' && $status == 'V') {
                        $new_status = 'M';
                        $is_uploaded = 'N';
                    } else if ($doc_array['doc_status'] == 'M' && ($status == 'V' || $status == 'R')) {
                        $new_status = 'M';
                        $is_uploaded = 'N';
                    }
                    $sql_up_dms = "UPDATE cdn_dms_documents SET doc_status='$new_status',last_updated='$cdate',is_uploaded='$is_uploaded' WHERE documents_id='$did'";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql_up_dms);
                    if ($command->query()) {
                        $dept_id = $_SESSION['dept_id'];
                        $deptModel = new DepartmentsExt;
                        $dept = $deptModel->getDeptbyId($dept_id);
                        $dept_name = $dept['department_name'];

                        $mobile_msg = "Your document $file_code version - $file_version has been $sms_status by $dept_name department for application number #$app_id with comments: " . $comments . "." . $next_msg;

                        // Send Email / SMS To Investor
                        $investor_mobile = $doc_array['mobile_number'];
                        $investor_email = $doc_array['email'];
                        $investor_name = $doc_array['first_name'] . " " . $doc_array['last_name'];
                        DefaultUtility::sendOTPToMobile($investor_mobile, $mobile_msg);

                        // END
                        $msg = 'success';
                    } else {
                        $msg = "Please contact your support team.";
                    }
                } else {
                    $msg = "Please contact your support team.";
                }
            }
        }

        echo $msg;
        exit;
    }

    public function actionDepartmentActionOnDocumentOLD() {
        @session_start();
        $msg = "";
        if (!isset($_SESSION['department_login']) || !$_SESSION['department_login']) {
            $this->redirect('/');
            exit;
        }

        if (!DefaultUtility::isValidDocumentVerifierLogin()) {
            $this->redirect('/');
            exit;
        }
        if (isset($_POST['mapid']) && isset($_POST['did'])) {
            $mapid = base64_decode($_POST['mapid']);
            $did = base64_decode($_POST['did']);
            $uid = base64_decode($_POST['uid']);
            $action = $_POST['action'];
            $dept_user_id = $_SESSION['uid'];
            $uname = $_SESSION['uname'];
            $remote_ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            if ($action == 'verify') {
                $status = 'V';
                $sms_status = "Approved";
            } else if ($action == 'reject') {
                $status = 'R';
                $sms_status = "Rejected";
            } else {
                echo "invalid";
                exit;
            }

            $connection = Yii::app()->db;
            // bo_application_dms_documents_mapping
            // cdn_dms_documents -- doc_ref_number,document_name
            // bo_infowizard_documentchklist -- name,chklist_id
            // sso_users - first_name,last_name

            $sql = "SELECT * FROM bo_application_dms_documents_mapping as map,cdn_dms_documents as dms,sso_profiles as p,sso_users as u WHERE map.mapping_id=:mapping_id AND map.documents_id=:documents_id AND map.documents_id=dms.documents_id AND u.user_id=map.user_id AND p.user_id=u.user_id";
            $command = $connection->createCommand($sql);
            $command->bindParam(":mapping_id", $mapid, PDO::PARAM_INT);
            $command->bindParam(":documents_id", $did, PDO::PARAM_INT);
            $doc_array = $command->queryRow();
            if ($doc_array === false) {
                $msg = "Invalid Attempt";
                exit;
            } else {
                //echo '<pre>'; print_r($doc_array);
                //echo json_encode($doc_array);
                $cdate = date("Y-m-d H:i:s");
                $sql_up_map = "UPDATE bo_application_dms_documents_mapping SET status='$status',last_updated='$cdate' WHERE mapping_id='$mapid' AND documents_id='$did'";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql_up_map);
                if ($command->query()) {
                    // Generate Log -- bo_application_dms_documents_mapping_logs
                    $logModel = new ApplicationDmsDocumentsMappingLogs;
                    $logModel->mapping_id = $mapid;
                    $logModel->documents_id = $did;
                    $logModel->status = $status;
                    $logModel->dept_user_id = $dept_user_id;
                    $logModel->verifier_name = $uname;
                    //$logModel->verifier_designation	= 'NA';
                    //$logModel->verifier_comments	= 'NA';
                    $logModel->created_time = $cdate;
                    $logModel->remote_ip = $remote_ip;
                    $logModel->user_agent = $user_agent;
                    $logModel->save();
                    // END OF Log

                    if ($doc_array['doc_status'] == 'V' || $doc_array['doc_status'] == 'R' || $doc_array['doc_status'] == 'M') {
                        $new_status = 'M';
                        $is_uploaded = 'N';
                    } else if ($doc_array['doc_status'] == 'U' && $status == 'V') {
                        $new_status = 'V';
                        $is_uploaded = 'Y';
                    } else if ($doc_array['doc_status'] == 'U' && $status == 'R') {
                        $new_status = 'R';
                        $is_uploaded = 'N';
                    }
                    $sql_up_dms = "UPDATE cdn_dms_documents SET doc_status='$new_status',last_updated='$cdate',is_uploaded='$is_uploaded' WHERE documents_id='$did'";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql_up_dms);
                    if ($command->query()) {
                        $dept_id = $_SESSION['dept_id'];
                        $deptModel = new DepartmentsExt;
                        $dept = $deptModel->getDeptbyId($dept_id);
                        $dept_name = $dept['department_name'];

                        $mobile_msg = "Your document is $sms_status by $dept_name department";

                        // Send Email / SMS To Investor
                        $investor_mobile = $doc_array['mobile_number'];
                        $investor_email = $doc_array['email'];
                        $investor_name = $doc_array['first_name'] . " " . $doc_array['last_name'];
                        DefaultUtility::sendOTPToMobile($investor_mobile, $mobile_msg);

                        // END
                        $msg = 'success';
                    } else {
                        $msg = "Please contact your support team.";
                    }
                } else {
                    $msg = "Please contact your support team.";
                }
            }
        }

        echo $msg;
        exit;
    }

    public function insertDMSUsedDocs($iuid, $user_id, $sno, $dept_id, $documents_id, $used_file_name) {

        $model = new ApplicationDmsDocumentsMapping;
        $model->iuid = $iuid;
        $model->user_id = $user_id;
        $model->sno = $sno;
        $model->dept_id = $dept_id;
        $model->documents_id = $documents_id;
        $model->document_file_name = $used_file_name;
        $model->status = 'U';
        $model->user_agent = 'Auto Insert When department reject the docs';
        $model->created_on = date("Y-m-d H:i:s");
        $model->ip_address = $_SERVER['REMOTE_ADDR'];
        $model->save();
    }

    public function actionGetDCP() {
        $doc_chk_id = $_GET['doc_chk_id'];
        $dm = $_GET['dm'];
        $sql = "SELECT document_checklist_id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id='$doc_chk_id' ORDER BY id DESC LIMIT 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $doc_chk = $command->queryRow();
        if ($doc_chk) {
            $conteee = json_decode($doc_chk['document_checklist_id'], true);
            //print_r($conteee);
            echo '<table class="table table-striped table-bordered" width="100%">';
            echo '<tr>
				<td>S.No.</td>
				<td>Document Checkpoint</td>
				<td>Action</td>
				<td>Comment</td>
			</tr><input type="hidden" name="dm" value="' . $dm . '">';
            $i = 1;
            foreach ($conteee as $idd) {
                $sql1 = "SELECT code,name,id FROM bo_infowiz_dcp_master WHERE id='$idd' ORDER BY id DESC LIMIT 1";
                $connection1 = Yii::app()->db;
                $command1 = $connection->createCommand($sql1);
                $doc_chk1 = $command1->queryRow();
                if ($doc_chk1) {
                    $sql_ssss = "SELECT dcp_value,comment FROM bo_dcp_transactions WHERE mapping_id='$dm' AND dcp_id='" . $doc_chk1['id'] . "' ORDER BY id DESC LIMIT 1";
                    $connection1 = Yii::app()->db;
                    $command1 = $connection1->createCommand($sql_ssss);
                    $res_ssss = $command1->queryRow();
                    $dcp_value = '';
                    $sel_yes = '';
                    $sel_no = '';
                    $comment = '';

                    if (!empty($res_ssss)) {
                        $dcp_value = $res_ssss['dcp_value'];
                        //$comment = $res_ssss['comment'];
                        if ($dcp_value == 'Yes') {
                            //$sel_yes = 'selected';
                        } else if ($dcp_value == 'No') {
                            //$sel_no = 'selected';
                        }
                    }

                    echo '<input type="hidden" name="idddd_arr[]" value="' . $doc_chk1['id'] . '">						
					    <tr>
						<td>' . $i . '</td>
						<td>' . $doc_chk1['name'] . '</td>
						<td>
						<select onchange="action_dp_fun(' . $doc_chk1['id'] . ')" class="action_dp" id="' . $doc_chk1['id'] . '" name="action_' . $doc_chk1['id'] . '">
							<option value="">Select Action</option>
							<option ' . $sel_yes . ' value="Yes">Yes</option>
							<option ' . $sel_no . ' value="No">No</option>
						</select>
						</td>
						<td>
						<textarea id="cmt_' . $doc_chk1['id'] . '" name="comments_' . $doc_chk1['id'] . '">' . $comment . '</textarea>
						</td>
					</tr>';
                    $i++;
                }
            }
            echo '</table>';
            echo '<br><br> <input type="submit" name="submit" value="Save"> <br><br> ';
        }
    }

    public function actionSaveDCPTr() {
        echo '<pre>';
        print_r($_POST);
        die;
    }

    public function actionViewDMSIs() {
        $this->render('dmsis');
    }

    public function actionDepartmentActionOnDocumentDCPautosave() {
        @session_start();
        //echo '<pre>'; print_r($_SESSION);print_r($_POST); echo '</pre>';                
        $sql = "select * from bo_application_dms_documents_mapping where mapping_id=$_POST[dm]";
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        //  print_r($res);die;
        $mapid = ($_POST['dm']);
        //$did 	= ($_POST['did']);
        $uid = (@$_SESSION['uid']);
        $documents_id = (@$res['documents_id']);
        $comments = trim($_POST['comments_1']);
        //$action = $_POST['action'];
        $dept_user_id = @$_SESSION['uid'];
        $uname = @$_SESSION['uname'];
        if ($_POST['action_1'] == 'Yes') {
            $action = 'verify';
        } else {
            $action = 'reject';
        }
        if ($action == 'verify') {
            $status = 'V';
            $comments = $comments == '' ? 'Verified' : $comments;
        } else if ($action == 'reject') {
            $status = 'R';
        } else {
            echo "invalid";
            exit;
        }
        $cdate = date('Y-m-d H:m:i');
        $sql_up_dms = "UPDATE bo_dms_verifier SET verifier_name='$uname',comments='$comments',status='$status',verified_date_time='$cdate' WHERE id='$mapid'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_up_dms);
        if ($command->query()) {
            $sql_up_dms111 = "UPDATE cdn_dms_documents SET vbi='$status' WHERE documents_id='$documents_id'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms111);
            $command->query();
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
        echo $msg = 'success';
    }

    public function actionDepartmentActionOnDocumentDCP() {
        @session_start();
        //echo '<pre>'; print_r($_SESSION);print_r($_POST); echo '</pre>'; die;
        $mapid = ($_POST['mapid']);
        $did = ($_POST['did']);
        $uid = (@$_POST['uid']);
        $documents_id = (@$_POST['documents_id']);
        $comments = trim($_POST['comment']);
        $action = $_POST['action'];
        $dept_user_id = @$_SESSION['uid'];
        $uname = @$_SESSION['uname'];

        if ($action == 'verify') {
            $status = 'V';
            $comments = $comments == '' ? 'Verified' : $comments;
        } else if ($action == 'reject') {
            $status = 'R';
        } else {
            echo "invalid";
            exit;
        }
        $cdate = date('Y-m-d H:m:i');
        $sql_up_dms = "UPDATE bo_dms_verifier SET verifier_name='$uname',comments='$comments',status='$status',verified_date_time='$cdate' WHERE id='$mapid'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_up_dms);
        if ($command->query()) {
            $sql_up_dms111 = "UPDATE cdn_dms_documents SET vbi='$status' WHERE documents_id='$documents_id'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms111);
            $command->query();
        }
        echo $msg = 'success';
    }

    public function actionDocumentProcessing() {
        @session_start();

        $data = json_decode(file_get_contents('php://input'), true);

        $flag = 0;
        foreach ($data['documents'] as $key => $val) {
            if (isset($val['document_status']) && $val['document_status'] == 'R') {
                $docRej[] = $val['document_name'] . '(' . $val['document_code'] . ')';
                $flag = 1;
            }
        }
        $appID = $data['app_id'];
        $sp_tag = $data['sp_tag'];
        $comment = $data['remarks'];
        $repostatus = array();
        /* echo $flag;die; */
        if (isset($docRej) && !empty($docRej) && $flag == 1) {
            $docRejStr = implode(", ", $docRej);
            $msg = "Please Upload Rejected Documents: " . $docRejStr;
            $comment = $data['remarks'] . ' ' . $msg;
            $dateCurrent = date('Y-m-d H:i:s');
            //Update bo_sp_applications
            $sql_up_dms = "UPDATE bo_sp_applications SET app_status='RBI',app_comments='$comment',reverted_call_back_url='/backoffice/frontuser/existing/cafForm/submissionID/$appID',updated_on='$dateCurrent' WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms);
            $command->query();

            //Update bo_application_submission
            $submissionUpdateSql = "UPDATE bo_application_submission SET application_status = 'H',application_updated_date_time='$dateCurrent' WHERE submission_id = $appID";
            Yii::app()->db->createCommand($submissionUpdateSql)->execute();

            //Update bo_sp_applications
            $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

            $userRol = "Select role_name FROM bo_roles WHERE role_id = '68'";
            $userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();

            $roleInfo = "Name: " . @$data['officerData']['uname'] . "<br/>Mobile Number: " . @$data['officerData']['mobile'] . "<br/>Email Id: " . @$data['officerData']['email'];

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $applicationDetail['sno'];
            $modelSPH->service_id = $applicationDetail['sp_app_id'];
            $modelSPH->sp_tag = $applicationDetail['sp_tag'];
            $modelSPH->app_id = $applicationDetail['app_id'];
            $modelSPH->application_status = 'RBI';
            $modelSPH->comments = "$comment";
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->role_id = '68'; //action taken by's
            $modelSPH->role_name = @$userRoleData['role_name']; //action taken role name
            $modelSPH->role_user_info = @$roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
            $modelSPH->next_role_id = ''; //Next Assigned To
            if ($modelSPH->save()) {
                $reponse_status['Code'] = 1001;
                $reponse_status['Remark'] = $comment;
            } else {
                $reponse_status['Code'] = '';
                $reponse_status['Remark'] = '';
            }
        } else {
            $comment = $data['remarks'];
            $dateCurrent = date('Y-m-d H:i:s');
            $sql_up_dms = "UPDATE bo_sp_applications SET app_status='F',app_comments='$comment',updated_on='$dateCurrent' WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms);
            $command->query();

            $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

            $userRol = "Select role_name FROM bo_roles WHERE role_id = '68'";
            $userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();

            $roleInfo = "Name: " . @$data['officerData']['uname'] . "<br/>Mobile Number: " . @$data['officerData']['mobile'] . "<br/>Email Id: " . @$data['officerData']['email'];

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $applicationDetail['sno'];
            $modelSPH->service_id = $applicationDetail['sp_app_id'];
            $modelSPH->sp_tag = $applicationDetail['sp_tag'];
            $modelSPH->app_id = $applicationDetail['app_id'];
            $modelSPH->application_status = 'F';
            $modelSPH->comments = "$comment";
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->role_id = '68'; //action taken by's
            $modelSPH->role_name = @$userRoleData['role_name']; //action taken role name
            $modelSPH->role_user_info = @$roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
            $modelSPH->next_role_id = '34'; //Next Assigned To
            if ($modelSPH->save()) {
                $reponse_status['Code'] = 1001;
                $reponse_status['Remark'] = $comment;
            } else {
                $reponse_status['Code'] = '';
                $reponse_status['Remark'] = $comment;
            }
        }
        return $reponse_status;
        die;
        $this->render("document_processing");
    }

    public function actionDocumentProcessingforNewCAF() {
        @session_start();

        $data = json_decode(file_get_contents('php://input'), true);

        $flag = 0;
        foreach ($data['documents'] as $key => $val) {
            if (isset($val['document_status']) && $val['document_status'] == 'R') {
                $docRej[] = $val['document_name'] . '(' . $val['document_code'] . ')';
                $flag = 1;
            }
        }
        $appID = $data['app_id'];
        $sp_tag = $data['sp_tag'];
        $comment = $data['remarks'];
        $infowiz_service_id = $data['infowiz_service_id'];
        $spapp_id = $data['legacy_service_id'];
        $repostatus = array();

        if (isset($docRej) && !empty($docRej) && $flag == 1) {
            $docRejStr = implode(", ", $docRej);
            $msg = "Please Upload Rejected Documents: " . $docRejStr;
            $comment = $data['remarks'] . ' ' . $msg;
            $dateCurrent = date('Y-m-d H:i:s');
            //Update bo_sp_applications
            $reverted_call_back_url = "/backoffice/infowizard/subForm/updateSubForm/service_id/" . $_POST['infowiz_service_id'] . "/pageID/1/subID/" . $_POST['appID'] . "/formCodeID/1";
            $sql_up_dms = "UPDATE bo_sp_applications SET app_status='RBI',app_comments='$comment',reverted_call_back_url='$reverted_call_back_url',updated_on='$dateCurrent' WHERE app_id='$appID' AND sp_app_id ='$spapp_id' AND sp_tag='$sp_tag'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms);
            $command->query();

            //Update bo_application_submission
            $submissionUpdateSql = "UPDATE bo_new_application_submission SET application_status = 'H',application_updated_date_time='$dateCurrent' WHERE submission_id = $appID";
            Yii::app()->db->createCommand($submissionUpdateSql)->execute();

            //Update bo_sp_applications
            $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='$appID' AND sp_app_id ='$spapp_id' AND sp_tag='$sp_tag'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

            $userRol = "Select role_name FROM bo_roles WHERE role_id = '68'";
            $userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();

            $roleInfo = "Name: " . @$data['officerData']['uname'] . "<br/>Mobile Number: " . @$data['officerData']['mobile'] . "<br/>Email Id: " . @$data['officerData']['email'];

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $applicationDetail['sno'];
            $modelSPH->service_id = $applicationDetail['sp_app_id'];
            $modelSPH->sp_tag = $applicationDetail['sp_tag'];
            $modelSPH->app_id = $applicationDetail['app_id'];
            $modelSPH->application_status = 'RBI';
            $modelSPH->comments = "$comment";
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->role_id = '68'; //action taken by's
            $modelSPH->role_name = @$userRoleData['role_name']; //action taken role name
            $modelSPH->role_user_info = @$roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
            $modelSPH->next_role_id = ''; //Next Assigned To
            if ($modelSPH->save()) {
                $reponse_status['Code'] = 1001;
                $reponse_status['Remark'] = $comment;
            } else {
                $reponse_status['Code'] = '';
                $reponse_status['Remark'] = '';
            }
        } else {
            $comment = $data['remarks'];
            $dateCurrent = date('Y-m-d H:i:s');
            $sql_up_dms = "UPDATE bo_sp_applications SET app_status='F',app_comments='$comment',updated_on='$dateCurrent' WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_up_dms);
            $command->query();

            $serviceApplication = "Select * FROM  bo_sp_applications WHERE app_id='$appID' AND sp_tag='$sp_tag'";
            $applicationDetail = Yii::app()->db->createCommand($serviceApplication)->queryRow();

            $userRol = "Select role_name FROM bo_roles WHERE role_id = '68'";
            $userRoleData = Yii::app()->db->createCommand($userRol)->queryRow();

            $roleInfo = "Name: " . @$data['officerData']['uname'] . "<br/>Mobile Number: " . @$data['officerData']['mobile'] . "<br/>Email Id: " . @$data['officerData']['email'];

            $modelSPH = new SpApplicationHistory;
            $modelSPH->sp_app_id = $applicationDetail['sno'];
            $modelSPH->service_id = $applicationDetail['sp_app_id'];
            $modelSPH->sp_tag = $applicationDetail['sp_tag'];
            $modelSPH->app_id = $applicationDetail['app_id'];
            $modelSPH->application_status = 'F';
            $modelSPH->comments = "$comment";
            $modelSPH->added_date_time = date('Y-m-d H:i:s');
            $modelSPH->role_id = '68'; //action taken by's
            $modelSPH->role_name = @$userRoleData['role_name']; //action taken role name
            $modelSPH->role_user_info = @$roleInfo; //(Action Taken By )- Name <br> Designation <br> Mobile Number <br>Email Id
            $modelSPH->next_role_id = '34'; //Next Assigned To
            if ($modelSPH->save()) {
                $reponse_status['Code'] = 1001;
                $reponse_status['Remark'] = $comment;
            } else {
                $reponse_status['Code'] = '';
                $reponse_status['Remark'] = $comment;
            }
        }
        return $reponse_status;
        die;
        $this->render("document_processing");
    }

}
