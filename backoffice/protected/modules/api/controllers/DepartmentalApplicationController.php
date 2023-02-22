<?php

class DepartmentalApplicationController extends Controller {

    // Added By : Rahul
    //  23072018


    public function actionV1() {

        //echo "<pre>";  print_r($_SERVER);die; 
        //        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //            $type = $_GET;
        //        }
        //die('Under Maintanence');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST;
        }

        if (isset($_SERVER['CONTENT_TYPE']) && ($_SERVER['CONTENT_TYPE'] == 'application/json' || $_SERVER['CONTENT_TYPE'] == "application/json;charset=UTF-8")) {
            //  print_r($type);die;
            $type = json_decode(file_get_contents('php://input'), true);
            if (isset($type[0])) {
                $_POST = $type = $type[0];
            } else {
                $_POST = $type;
            }
        }
        // print_r($_POST);die;
        $token = 'SwCS2018';
        $dept_id_array = array('5', '14');


        if ((isset($_POST['token']) ) && ($_POST['token'] != $token)) {
            $response['status'] = '403';
            $response['message'] = 'Token mismatch';
            echo $responseData = json_encode($response);
            $postData = json_encode($_POST);
            if (!empty($postData)) {
                $this->generate_api_log($postData, $responseData);
            }
            die();
        }
        if (!isset($_POST['token'])) {
            $response['status'] = '405';
            $response['message'] = 'Invalid paramenter';
            echo $responseData = json_encode($response);
            $postData = json_encode($_POST);
            if (!empty($postData)) {
                $this->generate_api_log($postData, $responseData);
            }
            die();
        }
        $this->ValidateApiData($_POST);
        extract($_POST);
        //     foreach($type1 as $type){
        /* if($type['infowiz_dept_id']!=5){
          $sql = "SELECT * FROM bo_dept_service_application where infowiz_dept_id='" . $type['infowiz_dept_id'] . "' AND dept_application_number='" . $type['dept_application_number'] . "' AND sp_tag='" . $type['sp_tag'] ."'";
          $model = DeptServiceApplication::model()->findBySql($sql);
          if (!empty($model)) {
          $model->modified = date('Y-m-d h:i:s');
          }
          } */
        if (in_array($type['infowiz_dept_id'], $dept_id_array)) {
            $sql = "SELECT * FROM bo_dept_service_application where infowiz_dept_id='" . $type['infowiz_dept_id'] . "' AND dept_sw_reference_no='" . $type['dept_sw_reference_no'] . "' AND infowiz_service_id='" . $type['infowiz_service_id'] . "'";
            $model = DeptServiceApplication::model()->findBySql($sql);
            if (!empty($model)) {
                $model->modified = date('Y-m-d h:i:s');
            }
        } else {
            $sql = "SELECT * FROM bo_dept_service_application where infowiz_dept_id='" . $type['infowiz_dept_id'] . "' AND dept_application_number='" . $type['dept_application_number'] . "' AND sp_tag='" . $type['sp_tag'] . "'";
            $model = DeptServiceApplication::model()->findBySql($sql);
            if (!empty($model)) {
                $model->modified = date('Y-m-d h:i:s');
            }
        }



        if (empty($model)) {
            $model = new DeptServiceApplication;
            $model->created = date('Y-m-d h:i:s');
        }

        if (!empty($type)) {
            $response = array();
            $response['status'] = '';
            $response['status_code'] = '';
            $response['message'] = '';

            if (!empty($type['sp_tag'])) {
                $model->sp_tag = $type['sp_tag'];
            }

            if (!empty($type['infowiz_dept_id'])) {
                $model->infowiz_dept_id = $type['infowiz_dept_id'];
            }
            if (!empty($type['licence_no'])) {
                $model->licence_no = $type['licence_no'];
            }

            if (!empty($type['infowiz_service_id'])) {
                $model->infowiz_service_id = $type['infowiz_service_id'];
            }

            if (!empty($type['legacy_service_id'])) {
                $model->legacy_service_id = $type['legacy_service_id'];
            }

            if (!empty($type['infowiz_service_name'])) {
                $model->infowiz_service_name = $type['infowiz_service_name'];
            }

            if (!empty($type['dept_application_number'])) {
                $model->dept_application_number = $type['dept_application_number'];
            }
            if (!empty($type['dept_sw_reference_no'])) {
                $model->dept_sw_reference_no = $type['dept_sw_reference_no'];
            }

            if (!empty($type['is_applied_through_sw'])) {
                $model->is_applied_through_sw = $type['is_applied_through_sw'];
            }
            if (!empty($type['iuid'])) {
                $model->iuid = $type['iuid'];
            }
            if (!empty($type['caf_id'])) {
                $model->caf_id = $type['caf_id'];
            }
            if (!empty($type['sw_user_id'])) {
                $model->sw_user_id = $type['sw_user_id'];
            }
            if (!empty($type['dept_user_id'])) {
                $model->dept_user_id = $type['dept_user_id'];
            }
            if (!empty($type['applicant_name'])) {
                $model->applicant_name = trim($type['applicant_name']);
            }
            if (!empty($type['applicant_email'])) {
                $model->applicant_email = $type['applicant_email'];
            }
            if (!empty($type['applicant_contact_no'])) {
                $model->applicant_contact_no = $type['applicant_contact_no'];
            }
            if (!empty($type['app_status'])) {
                $model->app_status = $type['app_status'];
            }
            if (!empty($type['app_comment'])) {
                $model->app_comment = $type['app_comment'];
            }
            if (!empty($type['unit_name'])) {
                $model->unit_name = trim($type['unit_name']);
            }
            if (!empty($type['land_type_id'])) {
                $model->land_type_id = $type['land_type_id'];
            }
            if (!empty($type['unit_district_id'])) {
                $model->unit_district_id = $type['unit_district_id'];
            }
            if (!empty($type['unit_address'])) {
                $model->unit_address = trim($type['unit_address']);
            }
            if (!empty($type['number_of_employee'])) {
                $model->number_of_employee = $type['number_of_employee'];
            }
            if (!empty($type['download_certificate_call_back_url'])) {
                $model->download_certificate_call_back_url = $type['download_certificate_call_back_url'];
            }
            if (!empty($type['reverted_call_back_url'])) {
                $model->reverted_call_back_url = $type['reverted_call_back_url'];
            }
            if (!empty($type['print_app_call_back_url'])) {
                $model->print_app_call_back_url = $type['print_app_call_back_url'];
            }
            if (!empty($type['remote_server'])) {
                $model->remote_server = $type['remote_server'];
            }
            if (!empty($type['user_agent'])) {
                $model->user_agent = $type['user_agent'];
            }
            if (!empty($type['application_created_on'])) {
                $model->application_created_on = $type['application_created_on'];
            }
            if (!empty($type['application_updated_on'])) {
                $model->application_updated_on = $type['application_updated_on'];
            }
            if (!empty($type['is_active'])) {
                $model->is_active = $type['is_active'];
            }
            if (!empty($type['dms_time_taken_by_doc_verifier'])) {
                $model->dms_time_taken_by_doc_verifier = $type['dms_time_taken_by_doc_verifier'];
            }
            if (!empty($type['dms_time_taken_by_investor'])) {
                $model->dms_time_taken_by_investor = $type['dms_time_taken_by_investor'];
            }
            if (!empty($type['application_time_taken_by_investor'])) {
                $model->application_time_taken_by_investor = $type['application_time_taken_by_investor'];
            } else {
                $model->application_time_taken_by_investor = "0";
            }
            if (!empty($type['application_time_taken_by_department'])) {
                $model->application_time_taken_by_department = $type['application_time_taken_by_department'];
            } else {
                $model->application_time_taken_by_department = "0";
            }
            if (!empty($type['payment_mode'])) {
                $model->payment_mode = $type['payment_mode'];
            }
            if (!empty($type['payment_amount'])) {
                $model->payment_amount = $type['payment_amount'];
            }
            if (!empty($type['payment_datetime'])) {
                $model->payment_datetime = $type['payment_datetime'];
            }
            if (!empty($type['payment_reference_number'])) {
                $model->payment_reference_number = trim($type['payment_reference_number']);
            }

            // print_r($model);die;
            if ($response['status_code'] != '1') {
                if ($model->save()) {

                    $response['status'] = '201';
                    $response['message'] = 'Data Saved Partialy.';



                    $sql = "SELECT * FROM bo_dept_service_application_history where swcs_application_id='" . $model->sno .
                            "' AND infowiz_dept_id='" . $model->infowiz_dept_id .
                            "' AND dept_application_number='" . $model->dept_application_number .
                            "' AND app_status='" . $model->app_status .
                            "' AND (app_comment is null OR app_comment='" . $model->app_comment .
                            "') AND transaction_datetime='" . $model->application_updated_on .
                            "' AND (processed_by_role_id is null OR processed_by_role_id='" . $type['processed_by_role_id'] .
                            "') AND (processed_by_role_name is null OR processed_by_role_name='" . $type['processed_by_role_name'] .
                            "') AND (processed_by_role_user_mobile_number is null OR processed_by_role_user_mobile_number='" . $type['processed_by_role_user_mobile_number'] .
                            "') AND (processed_by_role_user_email OR processed_by_role_user_email='" . $type['processed_by_role_user_email'] .
                            "') AND (next_role_id is null OR next_role_id='" . $type['next_role_id'] .
                            "') AND (next_role_user_name is null OR next_role_user_name='" . $type['next_role_user_name'] .
                            "') AND (next_role_user_mobile_number is null OR next_role_user_mobile_number='" . $type['next_role_user_mobile_number'] .
                            "') AND (next_role_user_email is null OR next_role_user_email='" . $type['next_role_user_email'] . "') order by transaction_datetime desc limit 1";
                    $AppTransmodel = DeptServiceApplicationHistory::model()->findBySql($sql);
                   
                    if (empty($AppTransmodel)) {
                        $AppTransmodel = new DeptServiceApplicationHistory;

                        $AppTransmodel->swcs_application_id = $sno = $model->sno;
                        $AppTransmodel->infowiz_dept_id = $model->infowiz_dept_id;
                        $AppTransmodel->dept_application_number = $model->dept_application_number;
                        $AppTransmodel->app_status = $model->app_status;
                        $AppTransmodel->app_comment = $model->app_comment;
                        $AppTransmodel->transaction_datetime = $model->application_updated_on;

                        if (isset($type['processed_by_role_id']) && !empty($type['processed_by_role_id'])) {
                            $AppTransmodel->processed_by_role_id = $type['processed_by_role_id'];
                        }

                        if (isset($type['processed_by_role_name']) && !empty($type['processed_by_role_name'])) {
                            $AppTransmodel->processed_by_role_name = $type['processed_by_role_name'];
                        }

                        if (isset($type['processed_by_role_user_mobile_number']) && !empty($type['processed_by_role_user_mobile_number'])) {
                            $AppTransmodel->processed_by_role_user_mobile_number = $type['processed_by_role_user_mobile_number'];
                        }

                        if (isset($type['processed_by_role_user_email']) && !empty($type['processed_by_role_user_email'])) {
                            $AppTransmodel->processed_by_role_user_email = $type['processed_by_role_user_email'];
                        }

                        if (isset($type['next_role_id']) && !empty($type['next_role_id'])) {
                            $AppTransmodel->next_role_id = $type['next_role_id'];
                        }
                        if (isset($type['next_role_user_name']) && !empty($type['next_role_user_name'])) {
                            $AppTransmodel->next_role_user_name = $type['next_role_user_name'];
                        }

                        if (isset($type['next_role_user_mobile_number']) && !empty($type['next_role_user_mobile_number'])) {
                            $AppTransmodel->next_role_user_mobile_number = $type['next_role_user_mobile_number'];
                        }

                        if (isset($type['next_role_user_email']) && !empty($type['next_role_user_email'])) {
                            $AppTransmodel->next_role_user_email = $type['next_role_user_email'];
                        }

                        if (isset($type['payment_amount']) && !empty($type['payment_amount'])) {
                            $AppTransmodel->payment_amount = $type['payment_amount'];
                        }

                        if (isset($type['payment_mode']) && !empty($type['payment_mode'])) {
                            $AppTransmodel->payment_mode = $type['payment_mode'];
                        }

                        if (isset($type['payment_datetime']) && !empty($type['payment_datetime'])) {
                            $AppTransmodel->payment_datetime = $type['payment_datetime'];
                        }

                        if (isset($type['payment_reference_number']) && !empty($type['payment_reference_number'])) {
                            $AppTransmodel->payment_reference_number = $type['payment_reference_number'];
                        }

                        if (isset($type['user_agent']) && !empty($type['user_agent'])) {
                            $AppTransmodel->user_agent = $type['user_agent'];
                        }

                        if (isset($type['remote_server']) && !empty($type['remote_server'])) {
                            $AppTransmodel->remote_server = $type['remote_server'];
                        }
                    }
                    $AppTransmodel->created = date('Y-m-d: H:i:s');
                    


                    if ($AppTransmodel->save()) {

                        $response['status'] = '200';
                        $response['message'] = 'Data Submitted successfully.';
                    } else {
die('3');
                        $response['status'] = '400';
                        $response['message'] = 'Error in saving transaction';
                        //    var_dump($AppTransmodel->getErrors());
                    }

                } else {
                   // die(var_dump($model->getErrors()));
                }
            } else {
                $response['status'] = '400';
                $response['message'] = 'Missing parameters.';
            }

        }
        echo $responseData = json_encode($response);
        $postData = json_encode($_POST);
        if (!empty($postData)) {
            $this->generate_api_log($postData, $responseData);
        }
        die();
    }

    public function ValidateApiData() {

        extract($_POST);
        $response = array();
        $response['status'] = 200;
        $response['message'] = "Success";
        $response['RESPONSE'] = "Data has been validated";
        $connection = Yii::app()->db;
//       	$sql = "SELECT id FROM bo_sp_all_applications_validate WHERE service_id='$app_id' AND is_active='$is_active'";
//		$command = $connection->createCommand($sql);
//		$service_exist = $command->queryRow();
//       
        //  if(!empty($service_exist)){ 
        $manadtory = array();
        $validateMandatoryKey = array('sp_tag', 'infowiz_dept_id', 'infowiz_service_name', 'infowiz_service_id', 'dept_application_number', 'is_applied_through_sw', 'dept_user_id',
            'applicant_name', 'applicant_email', 'applicant_contact_no', 'app_status', 'app_comment', 'unit_name', 'unit_district_id', 'unit_address',
            'user_agent', 'is_active', 'application_time_taken_by_department', 'application_created_on', 'application_updated_on', 'land_type_id', 'print_app_call_back_url');


        foreach ($validateMandatoryKey as $vmk) {
            if (isset($_POST[$vmk]) && $_POST[$vmk] != "") {
                //  echo $vmk."==".@$_POST[$vmk]."<br>";
            } else {
                $manadtory[] = $vmk;
            }
        }
        //   print_r($manadtory); die;
        if (count($manadtory) > 0) {
            $allmandatory = implode(", ", $manadtory);
            $response['status'] = 400;
            $response['message'] = "Fields missing";
            $response['RESPONSE'] = "Missing Fields : $allmandatory - Please pass values";
            echo $responseData = json_encode($response);
            $postData = json_encode($_POST);
            if (!empty($postData)) {
                $this->generate_api_log($postData, $responseData);
            }
            die;
        }

        if (1 == 1) {
            //-----------------------------       
            // sp_tag check with table sso_service_providers and fields service_provider_tag 




            if (isset($sp_tag) && !empty($sp_tag)) {
                $sql = "SELECT service_provider_tag FROM sso_service_providers WHERE service_provider_tag='$sp_tag' AND is_service_provider_active='Y'";
                $command = $connection->createCommand($sql);
                $sp_tag_exist = $command->queryRow();

                if (empty($sp_tag_exist)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "sp_tag is either not valid or not active";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }



            //Status Check it should be ("A", "P", "F", "R", "I", "RBI", "PD", "PP", "PR", "PA")
            $allowedStatus = array("A", "P", "F", "R", "I", "RBI", "PD", "PP", "PR", "PA");
            if (!in_array($app_status, $allowedStatus)) {
                $response['status'] = 400;
                $response['message'] = "Invalid Value Passed";
                $response['RESPONSE'] = "Status code invalid is not valid";
                echo $responseData = json_encode($response);
                $postData = json_encode($_POST);
                if (!empty($postData)) {
                    $this->generate_api_log($postData, $responseData);
                }
                die;
            }
            if ($app_status == "RBI") {
                if ($_POST['reverted_call_back_url'] == "" || $_POST['reverted_call_back_url'] == "#") {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "reverted_call_back_url is compulsory in case of status 'RBI'";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if ($app_status == "A") {
                if ($_POST['download_certificate_call_back_url'] == "" || $_POST['download_certificate_call_back_url'] == "#") {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "download_certificate_call_back_url is compulsory in case of status 'A'";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if (!empty($sw_user_id)) {
                $sql = "SELECT user_id FROM sso_users WHERE user_id='$sw_user_id'";
                $command = $connection->createCommand($sql);
                $is_exist = $command->queryRow();
                if (empty($is_exist)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid User ID";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if (!empty($applicant_email)) {
                /* if (!filter_var($applicant_email, FILTER_VALIDATE_EMAIL)) {
                  $response['status'] = 400;
                  $response['message'] = "Invalid Value Passed";
                  $response['RESPONSE'] = "Invalid Email ID";
                  echo $responseData = json_encode($response);
                  $postData = json_encode($_POST);
                  if (!empty($postData)) {
                  $this->generate_api_log($postData, $responseData);
                  }
                  die;
                  } */
            }
            if (!empty($application_created_on)) {
                $format = "Y-m-d H:i:s";
                if (date($format, strtotime($application_created_on)) != date($application_created_on)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid Created On Date";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if (!empty($application_updated_on)) {
                $format = "Y-m-d H:i:s";
                if (date($format, strtotime($application_updated_on)) != date($application_updated_on)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid  Update Date";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            //            if (!empty($application_updated_on) && !empty($application_created_on)) {
            //                if ($application_updated_on < $application_created_on) {
            //                    $response['status'] = 400;
            //                    $response['message'] = "Invalid Value Passed";
            //                    $response['RESPONSE'] = "Application update date can not be smaller than application create date";
            //                    echo $responseData = json_encode($response);
            //                    $postData = json_encode($_POST);
            //                    if (!empty($postData)) {
            //                        $this->generate_api_log($postData, $responseData);
            //                    }
            //                    die;
            //                }
            //            }
            if (!empty($infowiz_dept_id)) {
                if (!is_numeric($infowiz_dept_id)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid Infowiz Department ID";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }

            if (!empty($unit_district_id)) {
                if (!is_numeric($unit_district_id)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid District ID";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if (!empty($infowiz_service_id)) {
                if (!filter_var($infowiz_service_id, FILTER_VALIDATE_FLOAT)) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid  Infowiz Service ID = " . $infowiz_service_id;
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
            if (!empty($is_applied_through_sw)) {
                if (($is_applied_through_sw != 'Y') && ($is_applied_through_sw != 'N')) {
                    $response['status'] = 400;
                    $response['message'] = "Invalid Value Passed";
                    $response['RESPONSE'] = "Invalid  value for is_applied_through_sw";
                    echo $responseData = json_encode($response);
                    $postData = json_encode($_POST);
                    if (!empty($postData)) {
                        $this->generate_api_log($postData, $responseData);
                    }
                    die;
                }
            }
        }
    }

    //----------------------------------
    // echo json_encode($response);die;


    /* Rahul Kumar - 23072018 */

    private function generateSpApplicationHistory($data) {
        $model = new SpApplicationHistory;
        $model->attributes = $data;
        $model->added_date_time = date('Y-m-d H:i:s');
        if ($model->save())
            return true;
        return false;
    }

    /* Rahul Kumar - 01-08-2018 */

    public function sendApiValidationAlert($email, $mobile_number, $msg) {
        // send email
        if ($email != '') {
            //DefaultUtility::sendEmail(EMAIL_HOST,EMAIL_PORT,EMAIL_USERNAME,EMAIL_PASSWORD,$msg,$email);
            DefaultUtility::sendOTPToMobile($mobile_number, $msg);
        }
    }

    private function generate_api_log($postData, $response) {
        $logModel = new NewApiAccessLog;
        $sp_tag = "NONE";
//        echo $postData;
//        echo $response;die;
        $postData = json_decode($postData, TRUE);
        if (isset($postData['sp_tag']) && !empty($postData['sp_tag']))
            $sp_tag = $postData['sp_tag'];
        if (is_array($postData)) {
            extract($postData);
            $logModel->sp_tag = $sp_tag;
            $logModel->request_method = $_SERVER['REQUEST_METHOD'];
            $logModel->request_uri = $_SERVER['REQUEST_URI'];
            $logModel->request_time = $_SERVER['REQUEST_TIME'];
            $logModel->post_info = json_encode($postData);
            $logModel->user_agent = 'Api Access';
            $logModel->created_date_time = date("Y-m-d H:i:s");
            $logModel->remote_ip = $_SERVER['REMOTE_ADDR'];
            $logModel->response_return = $response;
            //  echo "<pre>";print_r($logModel);die;
            if ($logModel->save()) {
                return true;
            } else {
                var_dump($logModel->getErrors());
            }
            // return false;
        }
    }

    public function actionStage() {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM copy_bo_dept_service_application limit 16000";
        $command = $connection->createCommand($sql);
        $allData = $command->queryAll();
        die;
        foreach ($allData as $data) {

            if (empty($data['applicant_email']))
                $data['applicant_email'] = "demo.swcs.uk@gmail.com";
            if (empty($data['applicant_contact_no']))
                $data['applicant_contact_no'] = "778778";
            $data['app_status'] = 'P';
            if (empty($data['app_comment']))
                $data['app_comment'] = "test";
            if (empty($data['unit_name']))
                $data['unit_name'] = "test";
            if (empty($data['unit_district_id']))
                $data['unit_district_id'] = '1';
            if (empty($data['unit_address']))
                $data['unit_address'] = 'test';
            if (empty($data['remote_server']))
                $data['remote_server'] = "qq";
            if (empty($data['user_agent']))
                $data['user_agent'] = 'pp';
            if (empty($data['application_time_taken_by_investor']))
                $data['application_time_taken_by_investor'] = '2';
            if (empty($data['application_updated_on']))
                $data['application_updated_on'] = '2019-02-02 11:11:11';
            if (empty($data['land_type_id']))
                $data['land_type_id'] = 1;
            $post_array = array('sp_tag' => 'Fire_&%$#987',
                'token' => 'SwCS2018',
                'dept_portal_user_id' => '12',
                'infowiz_dept_id' => $data['infowiz_dept_id'],
                'infowiz_service_id' => $data['infowiz_service_id'],
                'legacy_service_id' => '22',
                'infowiz_service_name' => $data['infowiz_service_name'],
                'dept_application_number' => $data['dept_application_number'],
                'is_applied_through_sw' => $data['is_applied_through_sw'],
                'iuid' => $data['iuid'],
                'caf_id' => $data['caf_id'],
                'sw_user_id' => $data['sw_user_id'],
                'dept_user_id' => $data['dept_user_id'],
                'applicant_name' => $data['applicant_name'],
                'applicant_email' => $data['applicant_email'],
                'applicant_contact_no' => $data['applicant_contact_no'],
                'app_status' => $data['app_status'],
                'app_comment' => $data['app_comment'],
                'print_app_call_back_url' => 'http://google.com',
                'unit_name' => $data['unit_name'],
                'land_type_id' => $data['land_type_id'],
                'unit_district_id' => $data['unit_district_id'],
                'unit_address' => $data['unit_address'],
                'number_of_employee' => $data['number_of_employee'],
                'download_certificate_call_back_url' => $data['download_certificate_call_back_url'],
                'reverted_call_back_url' => $data['reverted_call_back_url'],
                'remote_server' => $data['remote_server'],
                'user_agent' => $data['user_agent'],
                'application_created_on' => $data['application_created_on'],
                'application_updated_on' => $data['application_updated_on'],
                'is_active' => $data['is_active'],
                'dms_time_taken_by_doc_verifier' => $data['dms_time_taken_by_doc_verifier'],
                'dms_time_taken_by_investor' => $data['dms_time_taken_by_investor'],
                'application_time_taken_by_investor' => $data['application_time_taken_by_investor'],
                'application_time_taken_by_department' => $data['application_time_taken_by_department'],
                'payment_mode' => $data['payment_mode'],
                'payment_amount' => $data['payment_amount'],
                'payment_datetime' => $data['payment_datetime'],
                'payment_reference_number' => $data['payment_reference_number']
            );

            //echo '<pre>'; print_r($post_array);die;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://www.caipotesturl.com/backoffice/api/DepartmentalApplication/v1/',
                CURLOPT_USERAGENT => 'Apoorv API TEST',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $post_array
            ));
            $resp = curl_exec($curl);



            if (!curl_exec($curl)) {
                die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            }
            curl_close($curl);
            echo '<br>';
            print_r($resp);
        }
    }

}
