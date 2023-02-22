<?php

class V2Controller extends Controller {

    function init() {
        
    }

    public function actionIndex() {
        // Utility::sendOTPToMobile('9599424588','Test Message from Hemant Thakur');
        // echo json_encode(array("April"=>"Fool"));
        print_r(Utility::sendEmailTest(EMAIL_HOST, EMAIL_PORT, EMAIL_USERNAME, EMAIL_PASSWORD, "TestEmail", "This is test mail", "mohitsharnic@gmail.com"));
    }

    public function actionGetDepartmentUsers() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash'])) {
            extract($_POST);
            $cal_hash = '-*********';
            if (isset($role_id))
                $cal_hash = hash_hmac('sha1', $role_id, SW_PUBLIC_KEY);
            else if (isset($distt_id))
                $cal_hash = hash_hmac('sha1', $distt_id, SW_PUBLIC_KEY);
            $cal_hash = '-*********';
            if ($cal_hash != $api_hash) {
                header('STATUS: Invalid Key', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $users = UserExt::getDeptUserList($_POST);
            if ($users == false) {
                #header('STATUS: 204',true,204);				
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $users;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to get all the application of particular department
     * @author Hemant Thakur
     * @return json
     *
     *
     */
    public function actionGetTokenDetail() {
        header('content-type: application/json');
        $response = array();
        if (isset($_GET['token'])) {
            $token = trim($_GET['token']);
            $token = strip_tags($token);
            if (strlen($token) == 32) {
                $connection = Yii::app()->db;
                $sql = "SELECT tkn.token,tkn.user_id,tkn.role_id,tkn.token_created_on,tkn.token_accessed_on,usr.full_name,usr.email,usr.mobile,usr.dept_id,usr.disctrict_id,tkn.module_id from bo_user_active_tokens tkn
							INNER JOIN bo_user usr
							ON tkn.user_id=usr.uid
							WHERE tkn.token=:token";

                $command = $connection->createCommand($sql);
                $command->bindParam(":token", $token, PDO::PARAM_STR);
                $row = $command->queryRow();

                if ($row == FALSE) {
                    header('STATUS: OK', true, 204);
                    $response['STATUS'] = 204;
                    $response['MSG'] = "No Content";
                    $response['ERROR'] = "Invalid Token";
                    $response['RESPONSE'] = array();
                } else {
                    $returnData = $row;
                    $returnData['module_name'] = IncentiveModules::getModuleNameFromID($row['module_id']);
                    $roleIDName = RolesExt::getRolesViaId($row['role_id']);
                    $returnData['role_name'] = $roleIDName['role_name'];
                    $depart = DepartmentsExt::getDeptbyId($row['dept_id']);
                    $returnData['department_name'] = $depart['department_name'];
                    $distName = DistrictExt::getDistricNameById($row['disctrict_id']);
                    $returnData['district_name'] = $distName;
                    header('STATUS: OK', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "OK";
                    $response['RESPONSE'] = $returnData;
                }
            } else {
                header('STATUS: NO TOKEN', true, 412);
                $response['STATUS'] = 412;
                $response['MSG'] = "INVALID TOKEN";
                $response['ERROR'] = "Invalid Token Length";
                $response['RESPONSE'] = "";
            }
        } else {
            header('STATUS: NO TOKEN', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "NO TOKEN";
            $response['ERROR'] = "Invalid Token Length";
            $response['RESPONSE'] = "";
        }
        echo json_encode($response);
    }

    /**
     * this function is used to get all the CAF Application of the users

     */

    /**
     * This function is used to get all the application of particular department
     * @author Hemant Thakur
     * @return json
     *
     *
     */
    public function actiongetCAFDataFromId() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['caf_sub_id']) && !empty($_POST['caf_sub_id'])) {
            extract($_POST);
            $cal_hash = hash_hmac('sha1', $caf_sub_id, SW_PUBLIC_KEY);
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $criteria = new CDbCriteria;
            $criteria->condition = "submission_id=:submission_id";
            $criteria->params = array(":submission_id" => $caf_sub_id);
            $applications = ApplicationSubmission::model()->find($criteria);
            if ($applications === null) {
                #header('STATUS: 204',true,204);				
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = json_decode($applications->field_value, true);
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return all CAF field of particular CAF
     * @author Hemant Thakur
     * @return json
     *
     *
     */
    public function actiongetAllCAFOfUser() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['token'])) {
            extract($_POST);
            $tokenInfo = json_decode(Utility::validateToken($token));
            if (!is_object($tokenInfo) || $tokenInfo->STATUS != 200) {
                header('STATUS: 412', true, 412);
                $response['STATUS'] = 412;
                $response['MSG'] = "Invalid token";
                if (is_object($tokenInfo))
                    $response['MSG'] .= " " . $tokenInfo->MSG;
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            if ($user_id != $tokenInfo->RESPONSE->user_id) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Invalid credentials";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';

            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $criteria = new CDbCriteria;
            $criteria->condition = "user_id=:user_id AND application_id=:app_id AND application_status=:app_status";
            $criteria->params = array(":user_id" => $user_id, ":app_id" => 1, ":app_status" => "A");
            $criteria->order = "submission_id ASC";
            $applications = ApplicationSubmission::model()->findAll($criteria);
            // echo "<pre>";print_r($applications);
            if (empty($applications)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray = array();
            foreach ($applications as $key => $cafdata) {
                $company_name = json_decode($cafdata->field_value);
                $dataArray[] = array("submission_id" => $cafdata->submission_id, "company_name" => $company_name->company_name);
                //$dataArray[]=array("cafid"=>$cafdata->submission_id,"company_name"=>$company_name->company_name,"application_name"=>"CAF","department"=>"DOI","Status"=>$cafdata->application_status);
            }

            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    public function actionGetAllDeptApplications() {
        $response = array();
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['dept_id']) && !empty($_POST['dept_id'])) {
            extract($_POST);
            $cal_hash = hash_hmac('sha1', md5($dept_id), BO_API_PUBLIC_KEY);
            if ($cal_hash == $api_hash) {
                $apps = ApplicationExt::getDepartmentApplications($dept_id);
                if (!empty($apps)) {
                    header('STATUS: 200 Ok', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "Successfully Saved";
                    $response['RESPONSE'] = $apps;
                } else {
                    header('STATUS: DB error', true, 503);
                    $response['STATUS'] = 503;
                    $response['MSG'] = "Database Error";
                    $response['RESPONSE'] = "Unknown Error. Please Try again Later";
                }
            } else {
                header('STATUS: Bad Request', true, 400);
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "";
            }
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        }
        echo json_encode($response);
        return;
    }

    

    /**
     * This function is used to get all the User applictions from particular department that he submitted
     * @author: Hemant Thakur
     * @return json
     *
     *
     */
    public function actionGetUsersSubDeptApplications() {
        $response = array();
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['dept_id']) && !empty($_POST['dept_id'])) {
            extract($_POST);
            $cal_hash = hash_hmac('sha1', md5($user_id . $dept_id), BO_API_PUBLIC_KEY);
            if ($cal_hash == $api_hash) {
                $apps = ApplicationExt::getUsersSubDeptApplications($user_id, $dept_id);
                if (!empty($apps)) {
                    header('STATUS: 200 Ok', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "Successfully Saved";
                    $response['RESPONSE'] = $apps;
                } else {
                    header('STATUS: DB error', true, 503);
                    $response['STATUS'] = 503;
                    $response['MSG'] = "Database Error";
                    $response['RESPONSE'] = "Unknown Error. Please Try again Later";
                }
            } else {
                header('STATUS: Bad Request', true, 400);
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "";
            }
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        }
        echo json_encode($response);
        return;
    }

    /**
     * This function is used to get all the User applictions from all the departments that he submitted
     * @author: Hemant Thakur
     * @return json
     *
     *
     */
    public function actionGetUsersSubApplications() {
        $response = array();
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            extract($_POST);
            $cal_hash = hash_hmac('sha1', md5($user_id), BO_API_PUBLIC_KEY);
            if ($cal_hash == $api_hash) {
                $apps = ApplicationExt::getUsersSubApplications($user_id);
                if (!empty($apps)) {
                    header('STATUS: 200 Ok', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "Successfully Saved";
                    $response['RESPONSE'] = $apps;
                } else {
                    header('STATUS: DB error', true, 503);
                    $response['STATUS'] = 503;
                    $response['MSG'] = "Database Error";
                    $response['RESPONSE'] = "Unknown Error. Please Try again Later";
                }
            } else {
                header('STATUS: Bad Request', true, 400);
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "";
            }
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        }
        echo json_encode($response);
        return;
    }

    /*
     * Function to return all the countries name
     * auther: Hemant Thakur
     * param: 
     * return: json
     *
     */

    public function actionGetAllPages() {
        extract($_POST);
        $response = array();

        $api_hmac = hash_hmac("sha1", 'RequestToGetAllPagesList', OTP_SECRET_KEY);
        if ($hmac != $api_hmac) {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        } else {
            $pages = Utility::getPageTree(1);
            if (empty($pages)) {
                header('STATUS: NO CONTENT', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "NO CONTENT";
                $response['COUNTRIES'] = "";
            } else {
                header('STATUS: OK', true, 200);
                $response['STATUS'] = 200;
                $response['MSG'] = "OK";
                $response['PAGES'] = $pages;
            }
        }
        print_r(json_encode($response));
        return;
    }

    public function actionGetcountrylist() {
        global $wturls;
        $response = array();
        $request = "http://$_SERVER[HTTP_HOST]";
        if (!1) {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['COUNTRIES'] = "";
        } else {
            $countries = Utility::getCountryList();
            if (empty($countries)) {
                header('STATUS: NO CONTENT', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "NO CONTENT";
                $response['COUNTRIES'] = "";
            } else {
                header('STATUS: OK', true, 200);
                $response['STATUS'] = 200;
                $response['MSG'] = "OK";
                $response['COUNTRIES'] = $countries;
            }
        }
        echo json_encode($response);
        return;
    }

    /*
     * Function to return all the states name
     * auther: Hemant Thakur
     * param: 
     * return: json
     *
     */

    public function actiongetContryStates() {
        $country = $_POST['country'];
        global $wturls;
        $response = array();
        $request = "http://$_SERVER[HTTP_HOST]";
        // in_array($request, $wturls)
        if (!1) {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        } else {
            $country = intval($country);
            $states = Utility::getStateList($country);
            if (empty($states)) {
                header('STATUS: NO CONTENT', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "NO CONTENT";
                $response['RESPONSE'] = "";
            } else {
                header('STATUS: OK', true, 200);
                $response['STATUS'] = 200;
                $response['MSG'] = "OK";
                $response['STATE'] = $states;
            }
        }
        echo json_encode($response);
        return;
    }

    /*
     * Function to send otp
     * auther: Hemant Thakur
     * param: 
     * return: json
     *
     */

    public function actionSendMobMsg() {
        $fields = extract($_POST);
        $response = array();
        $api_hmac = hash_hmac("sha1", $mobile . $email, OTP_SECRET_KEY);
        if (strlen($mobile) <> 10) {
            header('STATUS: Not Acceptable', true, 406);
            $response['STATUS'] = 406;
            $response['MSG'] = "Not Acceptable";
            $response['RESPONSE'] = "";
        } else if ($hmac != $api_hmac) {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        } else {
            $state = Utility::sendOTPToMobile($mobile, $msg);
            header('STATUS: OK', true, 200);
            $response['STATUS'] = 200;
            $response['MSG'] = "OK";
            $response['STATE'] = "SUCCESS";
        }
        echo json_encode($response);
        return;
    }

    /*
     * Function to send emails
     * auther: Hemant Thakur
     * param: 
     * return: json
     *
     */

    public function actionSendUIIDViaEmail() {
        $fields = extract($_POST);
        $response = array();
        $api_hmac = hash_hmac("sha1", $uiid . $email, OTP_SECRET_KEY);
        $request = "http://$_SERVER[HTTP_HOST]fdfg";
        if ($hmac != $api_hmac) {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
        } else {
            $state = Utility::sendEmail(EMAIL_HOST, EMAIL_PORT, EMAIL_USERNAME, EMAIL_PASSWORD, $subject, $message, $email);
            if ($state) {
                header('STATUS: OK', true, 200);
                $response['STATUS'] = 200;
                $response['MSG'] = "OK";
                $response['STATE'] = "SUCCESS";
            } else {
                header('STATUS: Internal Server Error', true, 500);
                $response['STATUS'] = 500;
                $response['MSG'] = "Internal Server Error";
                $response['STATE'] = "UNSUCCESSFULL";
            }
        }
        echo json_encode($response);
        return;
    }

    
	
	/**
	* This function is used to save the SP application With DMS Integration
	* @author : Santosh Kumar
	* @return : Json string//_OLD
	* @Date	  : 18-09-2017 
	* @Updated: 23-12-2017 (By Santosh) -- Adding validation
	* @Updated: 23-02-2018 (By Santosh) -- Adding CP Sub services values
    */
	
	public function actionSubmitSPApplicationV2() {
        $response = array();
        // header('content-type: application/json');
        // echo "<pre>";print_r($_POST); print_r($_GET); die;

        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $type = json_decode(file_get_contents('php://input'), true);
            $_POST = $type;
          //  print_r($_POST);
           // die;
        }
        if (isset($_POST['api_hash'], $_POST['app_id'], $_POST['user_id'], $_POST['app_status'], $_POST['service_id']) && (!empty($_POST['api_hash']) && !empty($_POST['user_id']) && !empty($_POST['app_status']) && !empty($_POST['service_id']))) {
            $this->generate_api_log(json_encode($_POST), "For test saving only post");
            // $_POST=Utility::
			$val_resp = json_decode($this->ValidateSubmitApiData(),true);
			//echo "<pre>";print_r($val_resp);die;
            extract($_POST);
            if($val_resp['STATUS'] == 200){
			$cal_api_hash = hash_hmac('sha1', md5($user_id . $app_id), SW_PUBLIC_KEY);

            if ($api_hash == $cal_api_hash) {
                $criteria = new CDbCriteria();
                // $criteria->condition="sp_tag=:sp_tag AND app_id=:app_id AND user_id=:user_id AND app_status=:app_status";
                $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id and sp_app_id=:service_id";
                $criteria->params = array(':sp_tag' => $sp_tag, ':app_id' => $app_id, ":service_id" => $service_id);
                $modelCheck = SpApplications::model()->findAll($criteria);
                if (!empty($modelCheck)) {
                    #header('STATUS: 204 Ok',TRUE,204);				
                    $response['STATUS'] = 409;
                    $response['MSG'] = "Already submitted";
                    $response['RESPONSE'] = "Application has been already submitted";
                } else {
                    if ($app_status == 'p' || $app_status == 'P')
                        $app_status = 'P';
                    elseif ($app_status == 'I' || $app_status == 'i')
                        $app_status = 'I';
                    if ($app_status == 'P' || $app_status == 'I' || $app_status == 'PD') {
                        if ($app_status == 'I' && (!isset($reverted_call_back_url) || empty($reverted_call_back_url))) {
                            $response['STATUS'] = 400;
                            $response['MSG'] = "Insufficient Parameters";
                            $response['RESPONSE'] = "Reverted Back URL needed in case of Incomplete Application";
                        } elseif ($app_status == 'P' && (!isset($print_app_call_back_url) || empty($print_app_call_back_url))) {
                            $response['STATUS'] = 400;
                            $response['MSG'] = "Insufficient Parameters";
                            $response['RESPONSE'] = "Print Application URL is needed in case of Pending Application";
                        } else {
                            // Start the transaction
							/* CODE UPDATED BY SANTOSH KUMAR on 18-09-2017 FOR DMS */
							
							$transaction = Yii::app()->db->beginTransaction();
							try{ // try start
							
							$model = new SpApplications;
                            $model->sp_tag = $sp_tag;
                            $model->app_id = $app_id;
                            $model->sp_app_id = $service_id;
                            $model->app_name = $app_name;
                            $model->app_status = $app_status;
                            $model->user_id = $user_id;
                            $model->created_on = date('Y-m-d H:i:s');
                            $model->updated_on = date('Y-m-d H:i:s');
                            $model->is_active = 'Y';
                            $model->remote_server = $remote_ip;
                            $model->user_agent = $user_agent;
                            if (isset($app_distt) && !empty($app_distt))
                                $model->app_distt = $app_distt;
                            if (isset($app_comments) && !empty($app_comments))
                                $model->app_comments = $app_comments;
                            if (isset($app_distt_name) && !empty($app_distt_name))
                                $model->app_distt_name = $app_distt_name;
                            if (isset($app_location) && !empty($app_location))
                                $model->app_location = $app_location;
                            if (isset($is_applied_by_caf) && !empty($is_applied_by_caf))
                                $model->is_applied_by_caf = $is_applied_by_caf;
                            if (isset($caf_id) && !empty($caf_id))
                                $model->caf_id = $caf_id;
                            if (isset($unit_name) && !empty($unit_name))
                                $model->unit_name = $unit_name;
                            if (isset($reverted_call_back_url) && !empty($reverted_call_back_url))
                                $model->reverted_call_back_url = $reverted_call_back_url;
                            if (isset($print_app_call_back_url) && !empty($print_app_call_back_url))
                                $model->print_app_call_back_url = $print_app_call_back_url;
                            if (isset($param_1) && !empty($param_1))
                                $model->param_1 = $param_1;
                            if (isset($param_3) && !empty($param_3))
                                $model->param_3 = $param_3;
                            if (isset($param_4) && !empty($param_4))
                                $model->param_4 = $param_4;
                            if (isset($param_2) && !empty($param_2))
                                $model->param_2 = $param_2;
                            if (isset($param_5) && !empty($param_5))
                                $model->param_5 = $param_5;
							if (isset($employee_count) && !empty($employee_count)){
                                $model->noe = $employee_count;
					}else{
						$model->noe = NULL;
					}
							/*** 
								Extra Param Added in Main Table
								Date - 29-12-2017
								@Santosh Kumar
							**/
							if (isset($created_date_time) && !empty($created_date_time))
								$model->created_date_time = $created_date_time;
							if (isset($last_updated_date_time) && !empty($last_updated_date_time))
								$model->last_updated_date_time = $last_updated_date_time;
                            if ($model->save()) {
                                $data = array();
                                $data['sp_tag'] = $sp_tag;
                                $data['service_id'] = $service_id;
                                $data['sp_app_id'] = $sno = $model->sno;
                                $data['app_id'] = $app_id;
                                $data['application_status'] = $app_status;
                                $data['param_1'] = @$param_1;
                                $data['param_2'] = @$param_2;
                                $data['param_3'] = @$param_3;
                                $data['param_4'] = @$param_4;
                                $data['param_5'] = @$param_5;
                                if (isset($comments))
                                    $data['comments'] = $comments;
                                if (isset($approver_id))
                                    $data['approver_id'] = $approver_id;
								if (isset($approver_details))
									$data['approver_details'] = $approver_details;
                                if (isset($next_approver))
                                    $data['next_approver'] = $next_approver;
                                if (isset($sent_dated_time))
                                    $data['sent_dated_time'] = $sent_dated_time;
								/** 
									Extra Pram added in API 
									Date : 29-12-2017
									@Santosh Kumar
								*/
								if (isset($role_id))
									$data['role_id'] = $role_id;
								if (isset($role_name))
									$data['role_name'] = $role_name;
								if (isset($role_user_info))
									$data['role_user_info'] = $role_user_info;
								if (isset($next_role_id))
									$data['next_role_id'] = $next_role_id;
								if (isset($remote_ip))
									$data['remote_server'] = $remote_ip;
								if (isset($user_agent))
									$data['user_agent'] = $user_agent;
								/** ---- END ----**/
                                $this->generateSpApplicationHistory($data);
								
								/*
									API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
									FOR DMS 
									DATE : 15-Sep-2017
								*/
								if(isset($documents)){
									if($documents!=''){
										// sso_service_providers
										$is_service_provider_active='Y';
										$is_account_active='Y';
										$connection = Yii::app()->db;
										$sql_s = "SELECT * FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active =:is_service_provider_active";
										$command = $connection->createCommand($sql_s);
										$command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_STR);
										$command->bindParam(":is_service_provider_active", $is_service_provider_active, PDO::PARAM_STR);
										$row_s = $command->queryRow();
										if($row_s == FALSE){
											$dept_id = 0;
										}else{
											$dept_id = $row_s['department_id'];
										}
										$connection = Yii::app()->db;
										$sql_u = "SELECT * FROM sso_users WHERE user_id=:user_id AND is_account_active=:is_account_active";
										$command = $connection->createCommand($sql_u);
										$command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
										$command->bindParam(":is_account_active", $is_account_active, PDO::PARAM_STR);
										$row_u = $command->queryRow();
										if($row_u == FALSE){
											$iuid=0;
										}else{
											$iuid=$row_u['iuid'];
										}
										
										//echo $dept_id."---".$iuid; die;
						
										/*$used_data_array = array();
										foreach($documents as $key=>$docs_arr){
											$used_code 		= $docs_arr['code'];
											$used_file_name 		= $docs_arr['file_name'];
											$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid);
										}*/
										$used_data_array = array();
										$documents_arr = explode("::",$documents); 
										foreach($documents_arr as $docs_arr){
											$docs_arr = trim($docs_arr);
											if($docs_arr!=''){
												list($used_code,$used_file_name) = explode("~",$docs_arr);
												//$used_code 		= $docs_arr['code'];
												//$used_file_name 		= $docs_arr['file_name'];
												$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid);
											}
											
										}
										
									}
								}
																
								/* -----  END OF CODE ------*/
								
								/*
									API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
									FOR CP Sub services 
									DATE : 23-02-2018
								*/
								if(isset($sub_services)){
									if($sub_services!=''){
										$sub_services_array 	= explode("::",$sub_services);
										$sub_services_string 	= implode(",", $sub_services_array);
										$model_sub = new SpApplicationConsumedServices;
										$model_sub->sno=$sno;
										$model_sub->application_number=$app_id;
										$model_sub->consumed_services=$sub_services_string;
										//$model_sub->dept_id=$dept_id;
										//$model->user_agent='Api Access';
										//$model->ip_address=$_SERVER['REMOTE_ADDR'];
										$model_sub->created_at=date("Y-m-d H:i:s");
										$model_sub->save();
									}
								}
								
								
                                $transaction->commit();
								
								
                                // header('STATUS: 200 Ok',true,200);				
                                $response['STATUS'] = 200;
                                $response['MSG'] = "Successfully Saved";
                                $response['RESPONSE'] = "Submitted Successfully";
                                //DefaultUtility::sendSMSEmailGlobalService('Service','Service submitted successfuly',$app_id);
                                
                            }
                            else {
                                // header('STATUS: DB error',true,503);				
                                $response['STATUS'] = 503;
                                $response['MSG'] = "Database Error";
                                $error = "";
                                foreach ($model->geterrors() as $key => $errors) {
                                    foreach ($errors as $key => $err) {
                                        $error .= "<li>" . $err . "</li>";
                                    }
                                }
                                $response['RESPONSE'] = "Unknown Error. Please Try again Later" . $error;
                            }
                        }// Try END -- Was there an error?
						catch (Exception $e) {
							// Error, rollback transaction
								$transaction->rollback();
								$response['STATUS'] = 503;
                                $response['MSG'] = "Database Error";
								$msg ='';
                                if ($e->getCode() === 23000) {
									  $msg = " or Please contact your API support team.. :)";
								 }
								$response['RESPONSE'] = "Unknown Error. Please Try again Later.... " . $msg;
						} // END OF CATCH
						}
                    } else {
                        $response['STATUS'] = 401;
                        $response['MSG'] = "Invalid Application Status";
                        $response['RESPONSE'] = "Application status should be either P (Pending) or I(Partially Completed)";
                    }
                }
            } else {
                // header('STATUS: Bad Request',true,400);				
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "Invalid Hash. API HASH on server is :" . $cal_api_hash . " and you have posted " . $api_hash . " hash. MD5 of UID & app_id is: " . md5($user_id . $app_id);
            }
			}else{
				$response['STATUS'] = 400;
				$response['MSG'] = $val_resp['MSG'];
				$response['RESPONSE'] = $val_resp['RESPONSE'];
				
			}
		} else {
            // header('STATUS: Bad Request',true,400);				
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request. Insufficient Parameters.";
            $response['RESPONSE'] = "Insufficient Parameters.";
        }
        echo json_encode($response);
        $this->generate_api_log(json_encode($_POST), json_encode($response));
        // echo "<pre>";print_r($_POST);
        exit;
    }
	
	
	public function sendApiValidationAlert($email,$mobile_number,$msg,$iuid){
		// send email
		if($email!=''){
			//DefaultUtility::sendEmail(EMAIL_HOST,EMAIL_PORT,EMAIL_USERNAME,EMAIL_PASSWORD,"Application submission failed due to parameter mis-match","Application submission failed due to parameter mis-match",$email);
			$head_msg = "Application submission failed due to parameter mis-match - #IUID-".$iuid;
			DefaultUtility::sendOTPToMobile($mobile_number,$msg);
		}
	}
	
	public function ValidateSubmitApiData(){
       $sp_tag=@$_POST['sp_tag'];
       $app_id=@$_POST['service_id'];
       $app_status=@$_POST['app_status'];
       $user_id=@$_POST['user_id'];
       $remote_server=@$_POST['remote_ip'];
       $user_agent=@$_POST['user_agent'];
       $user_id=@$_POST['user_id'];
       $is_active='Y';
        
        $response=array();
        $response['STATUS'] = 200;
		$response['MSG'] = "Success";
		$response['RESPONSE'] = "Data has been validated"; 
        $connection = Yii::app()->db;                 
       	$sql = "SELECT * FROM bo_sp_all_applications_validate WHERE service_id='$app_id' AND is_active='$is_active'";
		$command = $connection->createCommand($sql);
		$service_exist = $command->queryRow();
		
		$iuid = 'NA';
		if($user_id>0){
			$sql = "SELECT iuid FROM sso_users WHERE user_id='$user_id'"; 
			$command = $connection->createCommand($sql);
			$is_exist = $command->queryRow();
			if(!empty($is_exist)){
				$iuid = $is_exist['iuid'];
			}
		}
		if($iuid==''){
			$iuid = 'NA-'.$user_id;
		}
       
               if(!empty($service_exist)){ 
       //-----------------------------
       
                // sp_tag check with table sso_service_providers and fields service_provider_tag 
                                                       
                                                        
		$sql = "SELECT service_provider_tag FROM sso_service_providers WHERE service_provider_tag='$sp_tag' AND is_service_provider_active='$is_active'";
		//echo $sql; die;
		$command = $connection->createCommand($sql);
		$sp_tag_exist = $command->queryRow();
                if(empty($sp_tag_exist)){
							$response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            
						   $response['RESPONSE'] = "sp_tag is either not valid or not active. User ID - ".$iuid; 
							
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                }
                 //sp_app_id check with Table : bo_sp_all_applications , Field name : app_id 
               $sql = "SELECT app_id FROM bo_sp_all_applications WHERE app_id=$app_id AND is_app_active='$is_active'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Service ID is either not valid or not active . User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                             return json_encode($response);
                }
                
                 //sp_app_id check with Table : bo_sp_all_applications , Field name : app_id 
               $sql = "SELECT app_id FROM bo_sp_all_applications WHERE app_id=$app_id AND is_app_active='$is_active'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Service ID is either not valid or not active . User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                             return json_encode($response);
                }
                //Status Check it should be (A,P,F,R,I,RBI )
                $allowedStatus=array("A","P","F","R","I","RBI");
                if(!in_array($app_status,$allowedStatus)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Status code invalid is not valid. User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                             return json_encode($response);
                }
                if($app_status=="RBI"){
                    if($_POST['reverted_call_back_url']=="" || $_POST['reverted_call_back_url']=="#" ){
                          $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "reverted_call_back_url is compulsory in case of status 'RBI'. User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                    }
                }
                if($app_status=="A"){
                    if($_POST['download_certificate_call_back_url']=="" || $_POST['download_certificate_call_back_url']=="#" ){
                          $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "download_certificate_call_back_url is compulsory in case of status 'A'. User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                    }
                }
                if(!empty($user_id)){
                  $sql = "SELECT user_id FROM sso_users WHERE user_id='$user_id'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Invalid User ID. User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                }
                }
                
                 if(empty($remote_server)){               
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "remote_server should not be empty. User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                } 
                 if(isset($app_id) && !(is_numeric($app_id))){               
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "app_id can be numeric only"; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                } 
                
                if(empty($user_agent)){               
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "user_agent should not be empty . User ID - ".$iuid; 
							$this->sendApiValidationAlert($service_exist['alert_email_id'],$service_exist['alert_mobile_no'],$response['RESPONSE'],$iuid);
                            return json_encode($response);
                }  
               }
                //----------------------------------
               
             return json_encode($response);
    }
	
	
	/**
    	* This function is used to Saved used documents of DMS by each department in services...
    	* @author : SANTOSH KUMAR
    	* @return : boolean
    	*@param : string $_POST String Response
        */
	private function saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid){
		$connection = Yii::app()->db;
		$sql_u = "SELECT documents_id,issued_by_id,doc_ref_number FROM cdn_dms_documents WHERE user_id=:user_id AND iuid=:iuid AND document_name=:document_name";
		$command = $connection->createCommand($sql_u);
		$command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$command->bindParam(":iuid", $iuid, PDO::PARAM_STR);
		$command->bindParam(":document_name", $used_file_name, PDO::PARAM_STR);
		$row_u = $command->queryRow();
		if($row_u == FALSE){
			$documents_id=0;
		}else{
			$documents_id=$row_u['documents_id'];
			$doc_ref_number=$row_u['doc_ref_number'];
			$issued_by_id=$row_u['issued_by_id'];
			//$issued_by_id = $issued_by_id==2?1:$issued_by_id;
			$issued_by_id = $issued_by_id==5?9:$issued_by_id;
			$issued_by_id = $issued_by_id==19?8:$issued_by_id;
			$issued_by_id = $issued_by_id==14?2:$issued_by_id;
		}
                if(isset($doc_ref_number)){
		$f_arr = explode("_",$doc_ref_number);
		$sql="INSERT INTO bo_dms_verifier SET dept_id='$issued_by_id',document_code='".$f_arr[1]."',document_id='',document_name='$doc_ref_number',document_version='".$f_arr[2]."',status='U',user_id='$user_id',iuid='$iuid',documents_id='$documents_id',uploaded_by='Demo Investor'";
		$connection1=Yii::app()->db; 
		$command1=$connection->createCommand($sql);
		$command1->query();
		
		//echo $documents_id; die;
		$model= new ApplicationDmsDocumentsMapping;
		$model->iuid=$iuid;
		$model->user_id=$user_id;
		$model->sno=$sno;
		$model->dept_id=$dept_id;
		$model->documents_id=$documents_id;
		$model->document_file_name=$used_file_name;
		$model->status='U';
    	$model->user_agent='Api Access';
    	$model->created_on=date("Y-m-d H:i:s");
    	$model->ip_address=$_SERVER['REMOTE_ADDR'];
    	$model->save();
                }
	}
	
	private function saveUsedDocumentsInServiceByDepartment___Old($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid){
		$connection = Yii::app()->db;
		$sql_u = "SELECT documents_id FROM cdn_dms_documents WHERE user_id=:user_id AND iuid=:iuid AND document_name=:document_name";
		$command = $connection->createCommand($sql_u);
		$command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$command->bindParam(":iuid", $iuid, PDO::PARAM_STR);
		$command->bindParam(":document_name", $used_file_name, PDO::PARAM_STR);
		$row_u = $command->queryRow();
		if($row_u == FALSE){
			$documents_id=0;
		}else{
			$documents_id=$row_u['documents_id'];
		}
		//echo $documents_id; die;
		$model= new ApplicationDmsDocumentsMapping;
		$model->iuid=$iuid;
		$model->user_id=$user_id;
		$model->sno=$sno;
		$model->dept_id=$dept_id;
		$model->documents_id=$documents_id;
		$model->document_file_name=$used_file_name;
		$model->status='U';
    	$model->user_agent='Api Access';
    	$model->created_on=date("Y-m-d H:i:s");
    	$model->ip_address=$_SERVER['REMOTE_ADDR'];
    	$model->save();
	}
	
	/** ==== END ==== **/
	

    /**
     * This function is used to generate api logs
     * @author : Hemant Thakur
     * @return : boolean
     * @param : string $_POST String Response
     */
    private function generate_api_log($postData, $response) {
        $logModel = new ApiAccessLog;
        $sp_tag = "NONE";
        $postData = json_decode($postData, TRUE);
        if (isset($postData['sp_tag']))
            $sp_tag = $postData['sp_tag'];
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
        if ($logModel->save())
            return true;
        return false;
    }

    /**
     * This function is used to generate api logs
     * @author : Hemant Thakur
     * @return : boolean
     * @param : string $_POST String Response
     */
    private function generateSpApplicationHistory($data) {
        $model = new SpApplicationHistory;
        $model->attributes = $data;
        $model->added_date_time = date('Y-m-d H:i:s');
        if ($model->save())
            return true;
        return false;
    }

    
	/**
	* This function is used to update the SP application & History Table
	* @author : Santosh Kumar
	* @return : Json string
	* @Date	  : 18-09-2017
	* @Updated: 23-12-2017 (By Santosh) -- Adding validation
				16-02-2018 (By Santosh) -- Adding construction permit changes.. Get Certificate of Approved services which is mapped
    */
    public function actionUpdateSPApplicationV2() {
        $response = array();
        // echo "<pre>";print_r($_POST);die;
        if (isset($_POST['api_hash'], $_POST['user_id'], $_POST['param_1'], $_POST['app_id']) && (!empty($_POST['api_hash']) && !empty($_POST['app_id']) && !empty($_POST['user_id']) && !empty($_POST['param_1']))) {
            /* if(!is_numeric($_POST['param_1'])){
              $response['STATUS']=400;
              $response['MSG']="Invalid Parameter param_1";
              $response['RESPONSE']="Param_1 should be integer.";
              echo json_encode($response);
              exit;
              } */
			$_POST['service_id'] = $_POST['param_1'];
			$val_resp = json_decode($this->ValidateSubmitApiData(),true);
			if($val_resp['STATUS'] == 200){
            extract($_POST);
            $cal_api_hash = hash_hmac('sha1', md5($user_id . $app_id), SW_PUBLIC_KEY);
            if ($api_hash == $cal_api_hash) {
                $aprv = 'A';
                $criteria = new CDbCriteria();
                $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id and sp_app_id=:service_id";
                $criteria->params = array(':sp_tag' => $sp_tag, ':app_id' => $app_id, ":service_id" => $param_1);
                $criteria->order = "sno DESC";
                $model = SpApplications::model()->find($criteria);
                if (!empty($model)) {
                    if (!empty($application_fields))
                        $model->app_fields = $application_fields;
                    if ($model->app_status == 'A' || $model->app_status == 'R') {
                        $response['STATUS'] = 403;
                        $response['MSG'] = "Forbidden Request";
                        $response['RESPONSE'] = "Application has already Approved or Rejected.";
                        echo json_encode($response);
                        exit;
                    }
                    if ((($app_status == 'P' || $app_status == 'p') && (!$model->app_status == 'I')) || (($app_status == 'I' || $app_status == 'i') && (!$model->app_status == 'I' || !$model->app_status == 'i'))) {
                        $response['STATUS'] = 401;
                        $response['MSG'] = "Invalid Application Status";
                        $response['RESPONSE'] = "Application status can't be P or I";
                        echo json_encode($response);
                        exit;
                    }

                    // echo "<pre>";print_r($app_status);die;
                    if ($app_status == 'a' || $app_status == 'A')
                        $app_status = 'A';
                    elseif ($app_status == 'i' || $app_status == 'I')
                        $app_status = 'I';
                    elseif ($app_status == 'p' || $app_status == 'P')
                        $app_status = 'P';
                    elseif ($app_status == 'r' || $app_status == 'R')
                        $app_status = 'R';
                    elseif ($app_status == 'f' || $app_status == 'F')
                        $app_status = 'F';
					elseif ($app_status == 'pa' || $app_status == 'PA')
                        $app_status = 'PA';
					elseif ($app_status == 'pd' || $app_status == 'PD')
                        $app_status = 'PD';
					elseif ($app_status == 'pp' || $app_status == 'PP')
                        $app_status = 'PP';
					elseif ($app_status == 'pr' || $app_status == 'PR')
                        $app_status = 'PR';
                    elseif ($app_status == 'rbi' || $app_status == 'RBI')
                        $app_status = 'RBI';
                    else {
                        $response['STATUS'] = 400;
                        $response['MSG'] = "Invalid Parameters";
                        $response['RESPONSE'] = "Please send status as A,R,F,RBI,'PD','PP','PR','PA'";
                        echo json_encode($response);
                        exit;
                    }
                    // echo "<pre>";print_r($model);die;
                    //if(($model->app_status=='I' && $app_status!='P') || ($model->app_status=='P' && $app_status=='I')){
                    /* if(($model->app_status=='I' && $app_status!='P') || ($model->app_status=='P' && $app_status=='I')){
                      $response['STATUS']=403;
                      $response['MSG']="Insufficient Parameters";
                      $response['RESPONSE']="Please send valid application status.";
                      echo json_encode($response);
                      exit;
                      } */
                    if (($app_status == 'A' || $app_status == 'R') && (!isset($download_certificate_call_back_url) || ($download_certificate_call_back_url == ""))) {
                        $response['STATUS'] = 400;
                        $response['MSG'] = "Insufficient Parameters";
                        $response['RESPONSE'] = "Certificate Download URL needed in case of Approved And Rejected Application";
                        echo json_encode($response);
                        exit;
                    } elseif ($app_status == 'RBI' && (!isset($reverted_call_back_url) || ($reverted_call_back_url==""))) {
                        $response['STATUS'] = 400;
                        $response['MSG'] = "Insufficient Parameters";
                        $response['RESPONSE'] = "Reverted Back URL is needed in case of Reverted back to Investors Application";
                        echo json_encode($response);
                        exit;
                    }
                    $model->app_status = $app_status;
                    $model->updated_on = date('Y-m-d H:i:s');
                    $model->is_active = 'Y';
                    if (isset($app_distt) && !empty($app_distt))
                        $model->app_distt = $app_distt;
                    // if(isset($app_comments) && !empty($app_comments))
                    // 	$model->app_comments=$app_comments;
                    if (isset($reverted_call_back_url))
                        $model->reverted_call_back_url = $reverted_call_back_url;
                    if (isset($download_certificate_call_back_url))
                        $model->download_certificate_call_back_url = $download_certificate_call_back_url;
                    if (isset($print_app_call_back_url))
                        $model->print_app_call_back_url = $print_app_call_back_url;
                    if (isset($param_3) && !empty($param_3))
                        $model->param_3 = $param_3;
                    if (isset($param_4) && !empty($param_4))
                        $model->param_4 = $param_4;
                    if (isset($param_1) && !empty($param_1))
                        $model->param_1 = $param_1;
                    if (isset($param_2) && !empty($param_2))
                        $model->param_2 = $param_2;
                    if (isset($param_5) && !empty($param_5))
                        $model->param_5 = $param_5;
					if (isset($employee_count) && !empty($employee_count)){
                                $model->noe = $employee_count;
					}else{
						$model->noe = NULL;
					}
					/*** 
						Extra Param Added in Main Table
						Date - 29-12-2017
						@Santosh Kumar
					**/
					if (isset($last_updated_date_time) && !empty($last_updated_date_time))
                        $model->last_updated_date_time = $last_updated_date_time;
                    $model->sp_app_id = $param_1;
                    //$model->service_id = $param_1;
                    if ($model->save()) {  // update the master table
                        
						/*
							API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
							FOR DMS 
							DATE : 21-12-2017
						*/
						if(isset($documents)){
							if($documents!=''){
								// sso_service_providers
								$is_service_provider_active='Y';
								$is_account_active='Y';
								$connection = Yii::app()->db;
								$sql_s = "SELECT * FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active =:is_service_provider_active";
								$command = $connection->createCommand($sql_s);
								$command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_STR);
								$command->bindParam(":is_service_provider_active", $is_service_provider_active, PDO::PARAM_STR);
								$row_s = $command->queryRow();
								if($row_s == FALSE){
									$dept_id = 0;
								}else{
									$dept_id = $row_s['department_id'];
								}
								$connection = Yii::app()->db;
								$sql_u = "SELECT * FROM sso_users WHERE user_id=:user_id AND is_account_active=:is_account_active";
								$command = $connection->createCommand($sql_u);
								$command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
								$command->bindParam(":is_account_active", $is_account_active, PDO::PARAM_STR);
								$row_u = $command->queryRow();
								if($row_u == FALSE){
									$iuid=0;
								}else{
									$iuid=$row_u['iuid'];
								}
								
								//echo $dept_id."---".$iuid; die;
				
								/*$used_data_array = array();
								foreach($documents as $key=>$docs_arr){
									$used_code 		= $docs_arr['code'];
									$used_file_name 		= $docs_arr['file_name'];
									$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid);
								}*/
								$used_data_array = array();
								$documents_arr = explode("::",$documents); 
								foreach($documents_arr as $docs_arr){
									$docs_arr = trim($docs_arr);
									if($docs_arr!=''){
										list($used_code,$used_file_name) = explode("~",$docs_arr);
										//$used_code 		= $docs_arr['code'];
										//$used_file_name 		= $docs_arr['file_name'];
										$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$model->sno,$user_id,$dept_id,$iuid);
									}
									
								}
								
							}
						}
														
						/* -----  END OF CODE ------*/
						
						/* ----- CONSTRUCTION PERMIT CHANGES -- 16-02-2018 -------- */
							if(($app_status == 'A') && $download_certificate_call_back_url!=''){
								$_POST['sno'] = $model->sno;
								$this->downloadAndInsertCertificate();
							}
						/* ------ END ------*/
						
						
						$data = array();
                        $data['sp_tag'] = $sp_tag;
                        $data['app_id'] = $app_id;
                        $data['sp_app_id'] = $model->sno;
                        $data['application_status'] = $_POST['app_status'];
                        $data['comments'] = @$app_comments;
                        $data['param_1'] = @$param_1;
                        $data['param_2'] = @$param_2;
                        $data['param_3'] = @$param_3;
                        $data['param_4'] = @$param_4;
                        $data['param_5'] = @$param_5;
                        if (isset($comments))
                            $data['comments'] = $comments;
                        if (isset($approver_id))
                            $data['approver_id'] = $approver_id;
                        if (isset($next_approver))
                            $data['next_approver'] = $next_approver;
						if (isset($approver_details))
                            $data['approver_details'] = $approver_details;
						if (isset($sent_dated_time))
                            $data['sent_dated_time'] = $sent_dated_time;
						/** 
							Extra Pram added in API 
							Date : 29-12-2017
							@Santosh Kumar
						*/
						if (isset($role_id))
                            $data['role_id'] = $role_id;
						if (isset($role_name))
                            $data['role_name'] = $role_name;
						if (isset($role_user_info))
                            $data['role_user_info'] = $role_user_info;
						if (isset($next_role_id))
                            $data['next_role_id'] = $next_role_id;
						if (isset($remote_ip))
							$data['remote_server'] = $remote_ip;
						if (isset($user_agent))
							$data['user_agent'] = $user_agent;
						/** ---- END ----**/
                        $this->generateSpApplicationHistory($data);
						
						/*
							API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
							FOR CP Sub services 
							DATE : 23-02-2018
						*/
						if(isset($sub_services)){
							if($sub_services!=''){
								$sub_services_array 	= explode("::",$sub_services);
								$sub_services_string 	= implode(",", $sub_services_array);
								$model_sub = new SpApplicationConsumedServices;
								$model_sub->sno=$model->sno;
								$model_sub->application_number=$app_id;
								$model_sub->consumed_services=$sub_services_string;
								//$model_sub->dept_id=$dept_id;
								//$model->user_agent='Api Access';
								//$model->ip_address=$_SERVER['REMOTE_ADDR'];
								$model_sub->created_at=date("Y-m-d H:i:s");
								$model_sub->save();
							}
						}

                        // header('STATUS: 200 Ok',true,200);				
                        $response['STATUS'] = 200;
                        $response['MSG'] = "Successfully Saved"; 
                        $response['RESPONSE'] = "Submitted Successfully";
                        // DefaultUtility::sendSMSEmailGlobalService('Service','Service submitted successfuly',$app_id);
                    }
                    else {
                        // echo "<pre>";print_r($model->geterrors());
                        $errs = "";
                        $errors = $model->geterrors();
                        $count = 1;
                        foreach ($errors as $key => $error) {
                            foreach ($error as $key => $err) {
                                $errs .= $count++ . " " . $err . ".";
                            }
                        }
                        // header('STATUS: DB error',true,503);				
                        $response['STATUS'] = 503;
                        $response['MSG'] = "Could Not Update";
                        $response['RESPONSE'] = $errs;
                    }
                } else {
                    // header('STATUS: DB error',true,412);
                    // echo "<pre>";print_r($)				
                    $response['STATUS'] = 412;
                    $response['MSG'] = "No Application Found for the user";
                    $response['RESPONSE'] = "Condition Failed";
                }
            } else {
                // header('STATUS: Bad Request',true,400);				
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "Invalid Hash. API HASH on server is :" . $cal_api_hash . " and you have posted " . $api_hash . " hash";
            }
			}else{
				$response['STATUS'] = 400;
				$response['MSG'] = $val_resp['MSG'];
				$response['RESPONSE'] = $val_resp['RESPONSE'];
				
			}
        } else {
            // header('STATUS: Bad Request',true,400);				
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "Insufficient Parameters. Please make sure you have posted api_hash, app_id,user_id & param_1. param_1 should be your service_id.";
        }
        echo json_encode($response);
        // save the logs
        $this->generate_api_log(json_encode($_POST), json_encode($response));

        return;
    }
	
	/* Start to download service certificate from department Portal to SWCS and insert in Investor DMS Repository
     * author: Santosh Kumar
     * @param:none
	 * @Date - 16-02-2018
     * @response: // Currentally not required
     */
	public function downloadAndInsertCertificate(){
		@extract($_POST);
		if(isset($service_id)){
			$service_id = $service_id;
		}else{
			$service_id = $param_1;
		}
		
		$connection = Yii::app()->db;
		$sql_u = "SELECT * FROM bo_sp_all_applications_certificate WHERE service_id='$service_id' AND is_active='active'";
		$command = $connection->createCommand($sql_u);
		$row_u = $command->queryRow();
		if($row_u){
			// Start Download 
			if(isset($download_certificate_call_back_url)){
               $source_certificate_url = $download_certificate_call_back_url;
			   // Get IUID
					$sql_up = "SELECT iuid FROM sso_users WHERE user_id='$user_id' LIMIT 1";
					$command = $connection->createCommand($sql_up);
					$row_up = $command->queryRow();
					$iuid = $row_up['iuid'];
			   //
			   $downloadFlag = $this->downloadCertificateFile($source_certificate_url,$iuid,$service_id);
			   if($downloadFlag){
					$infowiz_arr = $this->getInfowizServiceID($service_id);
					
					$infowiz_service_id = $infowiz_arr['service_id'];
					$infowiz_sub_service_id = $infowiz_arr['servicetype_additionalsubservice'];
					$infowiz_final_id = $infowiz_service_id.".".$infowiz_sub_service_id;
					// Start Inserting in bo_service_certificate_download_history
					$hisModel = new ServiceCertificateDownloadHistory;
					$hisModel->swcs_service_id = $service_id;
					$hisModel->infowiz_service_id = $infowiz_service_id;
					$hisModel->infowiz_sub_service_id = $infowiz_sub_service_id;
					$hisModel->source_certificate_url = $source_certificate_url;
					$hisModel->downloded_location = $downloadFlag;
					$hisModel->sno = $sno;
					$hisModel->downloaded_datetime = date('Y-m-d H:i:s');
					$hisModel->log_created_datetime = date('Y-m-d H:i:s');
					$hisModel->save();
					$last_history_id = $hisModel->id;
					// End Inserting
					$doc_data_arr = $this->getMappedDocumentDetails($infowiz_service_id,$infowiz_sub_service_id);
					//echo '<pre>'; print_r($doc_data_arr);
					if($doc_data_arr){
						$docchk_id 	= $doc_data_arr['docchk_id'];
						$doc_id 	= $doc_data_arr['doc_type_id'];
						$issuer_id 	= $doc_data_arr['issuer_id'];
						$issued_by 	= $doc_data_arr['issued_by_id'];
						$chklist_id 	= $doc_data_arr['chklist_id'];
						$doc_ref_number = $iuid."_".$chklist_id."_V1.0";
						$new_name = $doc_ref_number.".pdf";
						$new_name_path = Yii::app()->basePath."/../../themes/backend/mydoc/".$iuid."/".$new_name;
						$cp_flag = false;
						if(!file_exists($new_name_path)){
							$cp_flag = copy($downloadFlag, $new_name_path);
						}
						// Start Inserting certificate docs in DMS with version 1
						if($cp_flag){	
							$model = new DmsDocuments;
							$model->docchk_id = $docchk_id;
							$model->doc_type_id = $doc_id;
							$model->issuer_id = $issuer_id;
							$model->issued_by_id = $issued_by;
							$model->iuid = $iuid;
							$model->user_id = $user_id;
							$model->doc_ref_number = $doc_ref_number;
							$model->document_name = $new_name;
							$model->document_version = "1.0";
							$model->document_version_type = 'V';
							$model->doc_status = 'V';
							$model->is_document_active='Y';
							$model->created_on=date('Y-m-d H:i:s');
							if($model->save()){
								// Update history table 
								$hisModel_up=ServiceCertificateDownloadHistory::model()->findByPk($last_history_id);
								$hisModel_up->inserted_in_dms='yes';
								$hisModel_up->inserted_datetime=date('Y-m-d H:i:s');
								$hisModel_up->save();
							}
						}
					}else{
						echo "Error"; die;
					}
					
					
			   }
			}
			
		}
	}
	public function getMappedDocumentDetails($service_id,$sub_service_id){
		// bo_information_wizard_service_certificate_maping
		$connection = Yii::app()->db;
		$sql_up = "SELECT 
					dck.chklist_id as chklist_id, cm.doc_checklist_id as docchk_id, dck.doc_id as doc_type_id,imap.issuer_id as issuer_id,imap.issuerby_id as issued_by_id  
					FROM bo_information_wizard_service_certificate_maping as cm
					INNER JOIN bo_infowizard_documentchklist as dck ON dck.docchk_id=cm.doc_checklist_id
					INNER JOIN bo_infowizard_issuer_mapping as imap ON imap.issmap_id=dck.issmap_id
					WHERE cm.service_id='$service_id' AND cm.sub_service_id='$sub_service_id' AND cm.is_active='Y' ORDER BY id DESC LIMIT 1";
		//echo $sql_up;
		$command = $connection->createCommand($sql_up);
		$row_up = $command->queryRow();
		if($row_up)return $row_up;
		return false;
	}
	public function getInfowizServiceID($service_id){
		// bo_information_wizard_service_parameters
		$connection = Yii::app()->db;
		$sql_up = "SELECT * FROM bo_information_wizard_service_parameters WHERE swcs_service_id='$service_id' AND is_active='Y' ORDER BY id DESC LIMIT 1";
		$command = $connection->createCommand($sql_up);
		$row_up = $command->queryRow();
		return $row_up;			
	}
	
	public function downloadCertificateFile($url,$iuid,$service_id){
		//$path = time().".pdf";
		$path = Yii::app()->basePath."/../../themes/backend/mydoc/".$iuid."/certificate_".$service_id."_".time().".pdf";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		$result = file_put_contents($path, $data);
		if(!$result){
			//echo "error";
			return false;
		}else{
			//echo "success";
			return $path;
		}
	}
	
	/* use to get the status of the Application and Document Status By Application number with rejected docs list
     * author: Santosh Kumar
     * @param:none
     * @response: json
	 * @Updated on 08-03-2018 : Added verified_by, verified_on, comments of used documents.......
     */
	
	 public function actionGetApplicationStatus(){
		$response = array();
        // echo "<pre>";print_r($_POST);die;
        if (isset($_POST['api_hash'], $_POST['user_id'], $_POST['sp_tag'], $_POST['app_id'], $_POST['service_id']) && (!empty($_POST['api_hash']) && !empty($_POST['app_id']) && !empty($_POST['user_id']) && !empty($_POST['sp_tag']) && !empty($_POST['service_id']))) {
            extract($_POST);
            $cal_api_hash = hash_hmac('sha1', md5($user_id . $app_id), SW_PUBLIC_KEY);
            if ($api_hash == $cal_api_hash) {
				// Start process
				$caf_datas=NULL;
				$criteria = new CDbCriteria();
                $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id and sp_app_id=:service_id";
                $criteria->params = array(':sp_tag' => $sp_tag, ':app_id' => $app_id, ":service_id" => $service_id);
                $criteria->order = "sno DESC";
                $model = SpApplications::model()->find($criteria);
                if (!empty($model)) {
					$sno = $model->sno;
					$user_id = $model->user_id;
					// Get Application History Logs
						$connection = Yii::app()->db;
						$sql = "SELECT application_status,comments,param_1,param_2,param_3,param_4,param_5,added_date_time as created_date
						FROM bo_sp_application_history
						WHERE sp_app_id=:sno ORDER BY history_id ASC
						";
						$command = $connection->createCommand($sql);
						$command->bindParam(":sno", $sno, PDO::PARAM_INT);
						$modelHistory = $command->queryAll();
            
						
						
					// Get Application DMS Documents List With Integration Department List
						$connection = Yii::app()->db;
						/*$sql = "SELECT dms.documents_id,iwd.name as document_name,iwd.chklist_id as code,dms_map.document_file_name,dms_map.status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id FROM 
						bo_application_dms_documents_mapping as dms_map 
						INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
						INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
						INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
						WHERE sno=:sno ORDER BY dms.documents_id DESC
						";*/
						$sql = "SELECT dms.documents_id,iwd.name as document_name,iwd.chklist_id as document_code,dms_map.document_file_name,dms_map.status as document_status,dms_map.created_on as used_date,iwdt.name as document_type,iwdt.abbr as document_type_code,dms.docchk_id,dms_map_log.verifier_name as verified_by,dms_map_log.created_time as verified_on,dms_map.comments as verifier_comments FROM 
						bo_application_dms_documents_mapping as dms_map 
						INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
						INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
						INNER JOIN bo_infowizard_docunenttype_master as iwdt ON iwdt.doc_id=dms.doc_type_id
						LEFT JOIN bo_application_dms_documents_mapping_logs dms_map_log ON dms_map_log.mapping_id=dms_map.mapping_id
						WHERE sno=:sno ORDER BY dms.documents_id DESC
						";
						$command = $connection->createCommand($sql);
						$command->bindParam(":sno", $sno, PDO::PARAM_INT);
						$modelDocuments = $command->queryAll();
						$app_docs=NULL;
						$app_new_docs=NULL;
						$key2=$key1=0;
						if($modelDocuments){
							$temp_arr = array();$key1=0;
							foreach($modelDocuments as $key=>$d_array){
								
								if(!in_array($d_array['document_code'],$temp_arr)){
									$app_docs[$key1]['document_name'] = $d_array['document_name'];
									$app_docs[$key1]['document_code'] = $d_array['document_code'];
									$app_docs[$key1]['document_file_name'] = $d_array['document_file_name'];
									if($sp_tag == 'UPCL_SWCS_@#'){
										$app_docs[$key1]['document_type'] = $d_array['document_type'];
										$app_docs[$key1]['document_type_code'] = $d_array['document_type_code'];
									}
									$app_docs[$key1]['document_status'] = $d_array['document_status'];
									$app_docs[$key1]['used_date'] = $d_array['used_date'];
									$app_docs[$key1]['verified_by'] = $d_array['verified_by'];
									$app_docs[$key1]['verified_on'] = $d_array['verified_on'];
									$app_docs[$key1]['verifier_comments'] = $d_array['verifier_comments'];
									$temp_arr[] = $d_array['document_code'];
									++$key1;
								}else{
								
									// All Docs Log
									$app_new_docs[$key2]['document_name'] = $d_array['document_name'];
									$app_new_docs[$key2]['document_code'] = $d_array['document_code'];
									$app_new_docs[$key2]['document_file_name'] = $d_array['document_file_name'];
									if($sp_tag == 'UPCL_SWCS_@#'){
										$app_new_docs[$key2]['document_type'] = $d_array['document_type'];
										$app_new_docs[$key2]['document_type_code'] = $d_array['document_type_code'];
									}
									$app_new_docs[$key2]['document_status'] = $d_array['document_status'];
									$app_new_docs[$key2]['used_date'] = $d_array['used_date'];
									$app_new_docs[$key2]['verified_by'] = $d_array['verified_by'];
									$app_new_docs[$key2]['verified_on'] = $d_array['verified_on'];
									$app_new_docs[$key2]['verifier_comments'] = $d_array['verifier_comments'];
									++$key2;
								}
								
							}
						}
            
					
					$response_data['user_id'] 		= $user_id;
					$response_data['unit_name'] 	= $model->unit_name;
					$response_data['app_name'] 		= $model->app_name;
					$response_data['app_status'] 	= $model->app_status;
					$response_data['app_comments'] 	= $model->app_comments;
					$response_data['app_distt'] 	= $model->app_distt;
					$response_data['app_location'] 	= $model->app_location;
					$response_data['app_caf_id'] 	= $app_caf_id = $model->caf_id;
					$response_data['created_on'] 	= $model->created_on;
					if($app_caf_id>0){
						// Get Caf Datas of Investor table - 
						$connection = Yii::app()->db;
						$sqlC = "SELECT field_value FROM bo_application_submission WHERE submission_id='$app_caf_id'";
						$command = $connection->createCommand($sqlC);
						//$command->bindParam(":caf_id", $model->caf_id, PDO::PARAM_INT);
						$modelCaf = $command->queryRow();
						$response_data['CAFFields'] = $modelCaf['field_value'];
					}
					// Get list Of all documents of Investor
					$connection = Yii::app()->db;
					$sql_dms = "SELECT iw.chklist_id as document_code,iw.name as document_name,dms.document_name as file_name,dms.doc_status as document_status
							FROM cdn_dms_documents as dms
							INNER JOIN bo_infowizard_documentchklist as iw
							ON iw.docchk_id = dms.docchk_id
							WHERE dms.user_id=:user_id AND dms.is_document_active='Y' AND (dms.doc_status='U' OR dms.doc_status='V')";

					$command = $connection->createCommand($sql_dms);
					$command->bindParam(":user_id", $user_id, PDO::PARAM_STR);
					//$command->bindParam(":iuid", $iuid, PDO::PARAM_STR);
					$row_dms = $command->queryAll();
					if($row_dms == FALSE){
						$row_dms = NULL;
					}else{
						$row_dms = $row_dms;
					}
					// END OF DOCS
					
					$response_data['app_history'] 				= $modelHistory;
					$response_data['documents'] 				= $row_dms;
					$response_data['app_documents'] 			= $app_docs;
					$response_data['app_documents_info'] 		= $app_new_docs;
                    
					/*
					Get Mapped servies
					@Santosh Kumar 
					@09-03-2018
					*/
					$services_data_array = NULL;
					$sql_sub="SELECT service_id,servicetype_additionalsubservice FROM bo_information_wizard_service_parameters WHERE swcs_service_id='$service_id' ORDER BY id DESC LIMIT 1";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql_sub);
					$res_sub = $command->queryRow();
					if(count($res_sub)>0){
						$infowiz_service_id = $res_sub['service_id'];
						$infowiz_sub_service_id = $res_sub['servicetype_additionalsubservice'];
						$final_service_id = $infowiz_service_id.".".$infowiz_sub_service_id;
						
						if(isset($final_service_id) && !empty($final_service_id)){
							$sql_s="SELECT * FROM bo_information_wizard_pre_service_mapping as psm WHERE psm.status='Y' AND psm.service_id='$final_service_id' ORDER BY psm.id DESC LIMIT 1";
							$connection=Yii::app()->db; 
							$command=$connection->createCommand($sql_s);
							$res_s = $command->queryAll();
							if($res_s){
								$pre_service_id = $res_s[0]['pre_service_id'];
								$pre_service_id_arr = json_decode($pre_service_id,true);
								$i=0;
								foreach($pre_service_id_arr as $key=>$data_arr_new){
									$is_mandatory = $data_arr_new['is_required'];
									$infowiz_final_service_id = $data_arr_new['mapped_service_id'];
									list($in_service_id,$in_sub_service_id) = explode(".",$data_arr_new['mapped_service_id']);
									
									$data_arr = $this->getServiceDatasFromInfowiz($in_service_id,$in_sub_service_id);
									
									$department_name = $data_arr['department_name'];
									$swcs_service_id = $data_arr['swcs_service_id'];
									$core_service_name = $data_arr['core_service_name'];
									
									$data_app_arr = $this->getAppliedServiceStatus($user_id,$swcs_service_id,$app_caf_id);
									if($data_app_arr){
										$service_status 	= $data_app_arr['app_status'];
										$application_number = $data_app_arr['app_id'];
									}else{
										$service_status 	= NULL;
										$application_number = NULL;
									}
									$iuid=$this->getIuid($user_id);
									$data_dms_app_arr = $this->getAppliedServiceCertificate($infowiz_final_service_id,$user_id,$iuid);
									if($data_dms_app_arr){
										$document_code = $data_dms_app_arr['document_code'];
										$document_name = $data_dms_app_arr['document_name'];
										$file_name 	   = $data_dms_app_arr['file_name'];
									}
									
									$services_data_array[$i]['service_id'] 			= $swcs_service_id;
									$services_data_array[$i]['service_name'] 		= $core_service_name;
									$services_data_array[$i]['service_status'] 		= $service_status;
									$services_data_array[$i]['application_number'] 	= $application_number;
									$services_data_array[$i]['department_name'] 	= $department_name;
									$services_data_array[$i]['is_mandatory'] 		= $is_mandatory;
									$services_data_array[$i]['document_code'] 		= $document_code;
									$services_data_array[$i]['document_name'] 		= $document_name;
									$services_data_array[$i]['file_name'] 			= $file_name;
									
									$i++;
								}
							}
						}
						
					}
					$response_data['sub_services'] = $services_data_array;      
					/* ---- END of servies --- */
					
					/* Added By Rahul @ 01032018*/
                                        /* Get Sub Service DAta */
                                       $resData= $this->getConsumedServices($sno,$app_id);
                                       if(!empty($resData)){
                                           $subServices=$resData['consumed_services'];
                                          //$SubServiceData= $this->getSubServiceDetail($subServices,$user_id,$app_caf_id);
                                       }
					$response_data['consumed_services'] = @$SubServiceData['sub_services'];
                                        /* End Of adding Service Data */
                                        
                                         /* Added By Rahul @ 04032018*/
                                        /* Get Sub Service DAta */
                                         $paymentInfo= $this->getPaymentInfo($sno,$app_id);
                                         if(!empty($paymentInfo)){
                                             $response_data['payment_info'] = $paymentInfo['payment_info'];
                                         }
                                          /* End Of adding Payment Info Data */
                                        
					// header('STATUS: 200 Ok',true,200);				
					$response['STATUS'] = 200;
					$response['MSG'] = "Application Found.";
					$response['RESPONSE'] = $response_data;
					
					
				}else{
					// Application not found as per given parameters
					$response['STATUS'] = 400;
					$response['MSG'] = "Bad Request";
					$response['RESPONSE'] = "Invalid Application number. Please send a valid application number.";
				}
				
			}else{
				// Invalid API HASH
				$response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "Invalid Hash. API HASH on server is :" . $cal_api_hash . " and you have posted " . $api_hash . " hash";
			}
		}else{
			// Invalid Parameter sent by client
			$response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "Insufficient Parameters. Please verify your post data.";
		}
		
		echo json_encode($response);
        // save the logs
        $this->generate_api_log(json_encode($_POST), json_encode($response));
        return;
	}
	
	
	/* use to get the status of the Application and Document Status By Application number old version without rejected docs
     * author: Santosh Kumar
     * @param:none
     * @response: json
     */
	public function actionGetApplicationStatusOLD(){
		$response = array();
        // echo "<pre>";print_r($_POST);die;
        if (isset($_POST['api_hash'], $_POST['user_id'], $_POST['sp_tag'], $_POST['app_id'], $_POST['service_id']) && (!empty($_POST['api_hash']) && !empty($_POST['app_id']) && !empty($_POST['user_id']) && !empty($_POST['sp_tag']) && !empty($_POST['service_id']))) {
            extract($_POST);
            $cal_api_hash = hash_hmac('sha1', md5($user_id . $app_id), SW_PUBLIC_KEY);
            if ($api_hash == $cal_api_hash) {
				// Start process
				$caf_datas=NULL;
				$criteria = new CDbCriteria();
                $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id and sp_app_id=:service_id";
                $criteria->params = array(':sp_tag' => $sp_tag, ':app_id' => $app_id, ":service_id" => $service_id);
                $criteria->order = "sno DESC";
                $model = SpApplications::model()->find($criteria);
                if (!empty($model)) {
					$sno = $model->sno;
					// Get Application History Logs
						$connection = Yii::app()->db;
						$sql = "SELECT application_status,comments,param_1,param_2,param_3,param_4,param_5,added_date_time as created_date
						FROM bo_sp_application_history
						WHERE sp_app_id=:sno ORDER BY history_id ASC
						";
						$command = $connection->createCommand($sql);
						$command->bindParam(":sno", $sno, PDO::PARAM_INT);
						$modelHistory = $command->queryAll();
            
						
						
					// Get Application DMS Documents List With Integration Department List
						$connection = Yii::app()->db;
						$sql = "SELECT iwd.name as document_name,iwd.chklist_id as code,dms_map.document_file_name,dms_map.status,dms_map.created_on as used_date FROM 
						bo_application_dms_documents_mapping as dms_map 
						INNER JOIN cdn_dms_documents dms ON dms.documents_id = dms_map.documents_id
						INNER JOIN bo_infowizard_documentchklist iwd ON iwd.docchk_id = dms.docchk_id
						WHERE sno=:sno
						";
						$command = $connection->createCommand($sql);
						$command->bindParam(":sno", $sno, PDO::PARAM_INT);
						$modelDocuments = $command->queryAll();
            
					
					$response_data['user_id'] 		= $model->user_id;
					$response_data['unit_name'] 	= $model->unit_name;
					$response_data['app_name'] 		= $model->app_name;
					$response_data['app_status'] 	= $model->app_status;
					$response_data['app_comments'] 	= $model->app_comments;
					$response_data['app_distt'] 	= $model->app_distt;
					$response_data['app_location'] 	= $model->app_location;
					$response_data['app_caf_id'] 	= $app_caf_id = $model->caf_id;
					$response_data['created_on'] 	= $model->created_on;
					if($app_caf_id>0){
						// Get Caf Datas of Investor table - 
						$connection = Yii::app()->db;
						$sqlC = "SELECT field_value FROM bo_application_submission WHERE submission_id='$app_caf_id'";
						$command = $connection->createCommand($sqlC);
						//$command->bindParam(":caf_id", $model->caf_id, PDO::PARAM_INT);
						$modelCaf = $command->queryRow();
						$response_data['CAFFields'] = $modelCaf['field_value'];
					}
					$response_data['app_history'] 	= $modelHistory;
					$response_data['app_documents'] = $modelDocuments;
					
					
					// header('STATUS: 200 Ok',true,200);				
					$response['STATUS'] = 200;
					$response['MSG'] = "Application Found.";
					$response['RESPONSE'] = $response_data;
					
					
				}else{
					// Application not found as per given parameters
					$response['STATUS'] = 400;
					$response['MSG'] = "Bad Request";
					$response['RESPONSE'] = "Invalid Application number. Please send a valid application number.";
				}
				
			}else{
				// Invalid API HASH
				$response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "Invalid Hash. API HASH on server is :" . $cal_api_hash . " and you have posted " . $api_hash . " hash";
			}
		}else{
			// Invalid Parameter sent by client
			$response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "Insufficient Parameters. Please verify your post data.";
		}
		
		echo json_encode($response);
        // save the logs
        $this->generate_api_log(json_encode($_POST), json_encode($response));
        return;
	}


    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
    /* Author : Rahul Kumar
     * Validate caf and return result
     */
    public function actiongetValidateYourCAF() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['caf']) && !empty($_POST['caf'])) {
            extract($_POST);
            $cal_hash = '1234567890';
            $api_hash = $_POST['api_hash'];
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $caf = $_POST['caf'];
            //     echo $caf;die;
            $criteria = new CDbCriteria;
            $criteria->condition = "submission_id=:submission_id AND application_id=:application_id";
            $criteria->params = array(
                ":submission_id" => $caf,
                ":application_id" => 1
            );
            $applications = ApplicationSubmission::model()->findAll($criteria);
            // echo "<pre>";print_r($applications);
            if (empty($applications)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            //$dataArray=array();
            // echo json_encode($applications);
            // exit;
            foreach ($applications as $key => $cafdata) {
                $company_name = json_decode($cafdata->field_value);
                $dataArray[] = array(
                    "submission_id" => $cafdata->submission_id,
                    "company_name" => $company_name->company_name,
                    "application_status" => $cafdata->application_status
                );
                //$dataArray[]=array("cafid"=>$cafdata->submission_id,"company_name"=>$company_name->company_name,"application_name"=>"CAF","department"=>"DOI","Status"=>$cafdata->application_status);
            }
            // if($dataArray)
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return total no of InverstorEmployementGravanceInvestment
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetInverstorEmployementGravanceInvestment() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $totalGraviance = ApplicationExt::getStateTotalGrievance();
            $totalInvestment = ApplicationExt::getProjectTotalStateInvestment();
            $stMalecount = ApplicationExt::getProjectTotalStateEMPMale();
            $stFemalecount = ApplicationExt::getProjectTotalStateEMPFemale();
            $totalEmployement = $stMalecount + $stFemalecount;
            $active = 'Y';
            $sql = "SELECT count(user_id) as user_count FROM sso_users WHERE is_account_active=:active";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(":active", $active, PDO::PARAM_STR);
            $Users = $command->queryAll();
            if ($Users === false) {
                $usercount = 0;
                ;
            } else {
                $usercount = $Users[0]['user_count'];
            }
            //echo $totalGraviance;die;
            if (empty($totalGraviance)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['total_gravance'] = $totalGraviance;
            $dataArray['total_investment'] = $totalInvestment;
            $dataArray['total_employement'] = $totalEmployement;
            $dataArray['total_active_investor'] = $usercount;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return total no of Inverstor
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetTotalInvestor() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $active = 'Y';
            $sql = "SELECT count(user_id) as user_count FROM sso_users WHERE is_account_active=:active";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(":active", $active, PDO::PARAM_STR);
            $Users = $command->queryAll();
            if ($Users === false) {
                $usercount = 0;
                ;
            } else {
                $usercount = $Users[0]['user_count'];
            }
            if (empty($usercount)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['total_active_investor'] = $usercount;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return total no of Employment
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetTotalEmployment() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $stMalecount = ApplicationExt::getProjectTotalStateEMPMale();
            $stFemalecount = ApplicationExt::getProjectTotalStateEMPFemale();
            $totalEmployement = $stMalecount + $stFemalecount;
            if (empty($totalEmployement)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['total_employment'] = $totalEmployement;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return total no of Grievance
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetTotalGrievance() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $totalGraviance = ApplicationExt::getStateTotalGrievance();
            if (empty($totalGraviance)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['total_gravance'] = $totalGraviance;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return total no of Investment
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetTotalInvestment() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $totalInvestment = ApplicationExt::getProjectTotalStateInvestment();
            //echo $totalGraviance;die;
            if (empty($totalInvestment)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['total_investment'] = $totalInvestment;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return GetDistricPendingMoreThan25Days
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetDistricPendingMoreThan25Days() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $connection = Yii::app()->db;
            $sql = "Select count(*) as count, x.distric_name from(

    Select b.distric_name,a.submission_id,a.landrigion_id,case when a.application_status='F' THEN 'Forwarded to Department' ELSE 'Pending' END as application_status,a.create_date,a.DiffDate  from (

    SELECT submission_id,landrigion_id, application_status,DATE_FORMAT(application_created_date,'%Y-%m-%d') as create_date ,

     DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d')) AS DiffDate  

    FROM bo_application_submission where application_status in('P','F') AND Submission_id not in('22','268') AND

    DATEDIFF(NOW(),DATE_FORMAT(application_created_date,'%Y-%m-%d'))>25

    order by landrigion_id) as a Inner Join bo_district as b ON a.landrigion_id=b.district_id) as x group by x.distric_name,x.landrigion_id";
            $command = $connection->createCommand($sql);
            $apps = $command->queryAll();
            //   print_r($apps);die;
            if (empty($apps[0])) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $dataArray['district_pending_more_than_25_days']=$app;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $apps;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return OverAll State CAF
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetOverAllStateCAF() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            // $cal_hash=hash_hmac('sha1', $user_id, SW_PUBLIC_KEY);
            $cal_hash = '1234567890';
            // echo $cal_hash;die;
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $statePendingCAF = ApplicationExt::getTotalCountCAF('P');
            $stateForwardedCAF = ApplicationExt::getTotalCountCAF('F');
            $stateRejectedCAF = ApplicationExt::getTotalCountCAF('R');
            $stateRevertedCAF = ApplicationExt::getTotalCountCAF('H');
            $stateApprovedCAF = ApplicationExt::getTotalCountCAF('A');
            $stateIncompleteCAF = ApplicationExt::getTotalCountCAF('I');
            $oc = $stateForwardedCAF + $stateApprovedCAF + $statePendingCAF + $stateRevertedCAF + $stateRejectedCAF + $stateIncompleteCAF;
            // echo $oc;die;
            if (empty($oc)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $dataArray['overall_state_caf'] = $oc;
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Category Wise Total CAF
     * @author Rahul Kumar
     * @return json
     *
     *
     */
    public function actionGetCategoryWiseTotalCAF() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $dataArray['pending'] = ApplicationExt::getTotalCountCAF('P');
            $dataArray['forworded'] = ApplicationExt::getTotalCountCAF('F');
            $dataArray['rejected'] = ApplicationExt::getTotalCountCAF('R');
            $dataArray['reverted'] = ApplicationExt::getTotalCountCAF('H');
            $dataArray['approved'] = ApplicationExt::getTotalCountCAF('A');
            $dataArray['incomplete'] = ApplicationExt::getTotalCountCAF('I');
            //  $dataArray['total']=$stateForwardedCAF + $stateApprovedCAF + $statePendingCAF + $stateRevertedCAF + $stateRejectedCAF + $stateIncompleteCAF;
            if (empty($dataArray)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $dataArray;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Category Wise Total CAF
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetGravianceReport() {
        // echo "test";die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';

            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $connection = Yii::app()->db;
            $sql = "SELECT grievence_no,grievence_title,grievence,grievence_created_by,grievence_created_on,have_replied,grievance_status FROM bo_grievance ORDER BY grievence_no DESC";
            $command = $connection->createCommand($sql);
            $grevienceModel = $command->queryAll();
            // print_r($grevienceModel);die;
            if (empty($grevienceModel)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $grevienceModel;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Category Wise Total CAF
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetDistricWiseCAFApplication() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            /*
             * Distric wise caf Report
             */
            $data['1']['pending'] = ApplicationExt::getTotalDistrictApps('1', 'P');
            $data['2']['pending'] = ApplicationExt::getTotalDistrictApps('2', 'P');
            $data['3']['pending'] = ApplicationExt::getTotalDistrictApps('3', 'P');
            $data['4']['pending'] = ApplicationExt::getTotalDistrictApps('4', 'P');
            $data['6']['pending'] = ApplicationExt::getTotalDistrictApps('6', 'P');
            $data['7']['pending'] = ApplicationExt::getTotalDistrictApps('7', 'P');
            $data['8']['pending'] = ApplicationExt::getTotalDistrictApps('8', 'P');
            $data['9']['pending'] = ApplicationExt::getTotalDistrictApps('9', 'P');
            $data['13']['pending'] = ApplicationExt::getTotalDistrictApps('13', 'P');
            $data['14']['pending'] = ApplicationExt::getTotalDistrictApps('14', 'P');
            $data['15']['pending'] = ApplicationExt::getTotalDistrictApps('15', 'P');
            $data['16']['pending'] = ApplicationExt::getTotalDistrictApps('16', 'P');
            $data['20']['pending'] = ApplicationExt::getTotalDistrictApps('20', 'P');
            // forwarded
            $data['1']['forword'] = ApplicationExt::getTotalDistrictApps('1', 'F');
            $data['2']['forword'] = ApplicationExt::getTotalDistrictApps('2', 'F');
            $data['3']['forword'] = ApplicationExt::getTotalDistrictApps('3', 'F');
            $data['4']['forword'] = ApplicationExt::getTotalDistrictApps('4', 'F');
            $data['6']['forword'] = ApplicationExt::getTotalDistrictApps('6', 'F');
            $data['7']['forword'] = ApplicationExt::getTotalDistrictApps('7', 'F');
            $data['8']['forword'] = ApplicationExt::getTotalDistrictApps('8', 'F');
            $data['9']['forword'] = ApplicationExt::getTotalDistrictApps('9', 'F');
            $data['13']['forword'] = ApplicationExt::getTotalDistrictApps('13', 'F');
            $data['14']['forword'] = ApplicationExt::getTotalDistrictApps('14', 'F');
            $data['15']['forword'] = ApplicationExt::getTotalDistrictApps('15', 'F');
            $data['16']['forword'] = ApplicationExt::getTotalDistrictApps('16', 'F');
            $data['20']['forword'] = ApplicationExt::getTotalDistrictApps('20', 'F');
            // approved
            $data['1']['approved'] = ApplicationExt::getTotalDistrictApps('1', 'A');
            $data['2']['approved'] = ApplicationExt::getTotalDistrictApps('2', 'A');
            $data['3']['approved'] = ApplicationExt::getTotalDistrictApps('3', 'A');
            $data['4']['approved'] = ApplicationExt::getTotalDistrictApps('4', 'A');
            $data['6']['approved'] = ApplicationExt::getTotalDistrictApps('6', 'A');
            $data['7']['approved'] = ApplicationExt::getTotalDistrictApps('7', 'A');
            $data['8']['approved'] = ApplicationExt::getTotalDistrictApps('8', 'A');
            $data['9']['approved'] = ApplicationExt::getTotalDistrictApps('9', 'A');
            $data['13']['approved'] = ApplicationExt::getTotalDistrictApps('13', 'A');
            $data['14']['approved'] = ApplicationExt::getTotalDistrictApps('14', 'A');
            $data['15']['approved'] = ApplicationExt::getTotalDistrictApps('15', 'A');
            $data['16']['approved'] = ApplicationExt::getTotalDistrictApps('16', 'A');
            $data['20']['approved'] = ApplicationExt::getTotalDistrictApps('20', 'A');
            // Rejected
            $data['1']['reject'] = ApplicationExt::getTotalDistrictApps('1', 'R');
            $data['2']['reject'] = ApplicationExt::getTotalDistrictApps('2', 'R');
            $data['3']['reject'] = ApplicationExt::getTotalDistrictApps('3', 'R');
            $data['4']['reject'] = ApplicationExt::getTotalDistrictApps('4', 'R');
            $data['6']['reject'] = ApplicationExt::getTotalDistrictApps('6', 'R');
            $data['7']['reject'] = ApplicationExt::getTotalDistrictApps('7', 'R');
            $data['8']['reject'] = ApplicationExt::getTotalDistrictApps('8', 'R');
            $data['9']['reject'] = ApplicationExt::getTotalDistrictApps('9', 'R');
            $data['13']['reject'] = ApplicationExt::getTotalDistrictApps('13', 'R');
            $data['14']['reject'] = ApplicationExt::getTotalDistrictApps('14', 'R');
            $data['15']['reject'] = ApplicationExt::getTotalDistrictApps('15', 'R');
            $data['16']['reject'] = ApplicationExt::getTotalDistrictApps('16', 'R');
            $data['20']['reject'] = ApplicationExt::getTotalDistrictApps('20', 'R');
            $newData = ""; //  print_r($data);die;
            foreach ($data as $key => $val) {
                $connection = Yii::app()->db;
                $sql = "SELECT service_provider_name FROM sso_service_providers WHERE sp_id=$key";
                $command = $connection->createCommand($sql);
                $serviceProviderName = $command->queryAll();
                $name = $serviceProviderName['0']['service_provider_name'];
                $newData[$name] = $val;
            }
            if (empty($newData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $newData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return State Nodal Officer, District Nodal Officer and G.M. Officer's List   
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetNodalList() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['type']) && !empty($_POST['type'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            if ($type == "state") {
                $connection = Yii::app()->db;
                $sql = "SELECT  c.full_name,c.email,c.mobile, d.department_name from (
            select a.department_id,a.role_id,b.full_name,b.email,b.mobile from bo_user_role_mapping as a inner join bo_user as b on b.uid=a.user_id where a.role_id='5'  or b.uid='3') as c
            inner join bo_departments as d on c.department_id=d.dept_id order by d.department_name ";
                $command = $connection->createCommand($sql);
                $newData = $command->queryAll();
            }
            if ($type == "district") {
                $connection = Yii::app()->db;
                $sql = "SELECT x.full_name,x.email,x.mobile, x.department_name,y.distric_name from(
             select  c.full_name,c.email,c.mobile, d.department_name,c.disctrict_id from (
             select a.department_id,a.role_id,b.full_name,b.email,b.mobile,b.disctrict_id from bo_user_role_mapping as a inner join bo_user as b on b.uid=a.user_id where a.role_id='3') as c
             inner join bo_departments as d on c.department_id=d.dept_id) as x inner join  bo_district as y on x.disctrict_id=y.district_id
             order by y.district_id,x.department_name ";
                $command = $connection->createCommand($sql);
                $newData = $command->queryAll();
            }
            if ($type == "gm") {
                $connection = Yii::app()->db;
                $connection = Yii::app()->db;
                $sql = "SELECT x.full_name,x.email,x.mobile, x.department_name,y.distric_name from(
            select  c.full_name,c.email,c.mobile, d.department_name,c.disctrict_id from (
            select a.department_id,a.role_id,b.full_name,b.email,b.mobile,b.disctrict_id from bo_user_role_mapping as a inner join bo_user as b on b.uid=a.user_id where a.role_id='33') as c
            inner join bo_departments as d on c.department_id=d.dept_id) as x inner join  bo_district as y on x.disctrict_id=y.district_id
            order by y.district_id,x.department_name ";
                $command = $connection->createCommand($sql);
                $newData = $command->queryAll();
            }
            if (empty($newData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $newData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return All Registered Investor   
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetAllRegisteredInvestor() {
        // echo "test";die;
        // echo      "=====".ApplicationExt::getTotalDistrictApps('1','P');die;
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $sql = "SELECT su.iuid,su.email,su.created_on,sup.first_name,sup.last_name,sup.mobile_number  FROM sso_users su
				INNER JOIN sso_profiles sup
				ON su.user_id=sup.user_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $newData = $command->queryAll();

            if (empty($newData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $newData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Manufacturing Enterprises with 2 Digit National Industry Classification Code 
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetMaufacturing2DigitReport() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $connection = Yii::app()->db;
            $sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where Industry_Type='MANUFACTURING' ";
            $command = $connection->createCommand($sql);
            $appSub = $command->queryAll();

            $sno = 0;
            foreach ($appSub as $key => $pendensy) {
                $unitType = ApplicationExt::getNICCodeMicroProject($pendensy['II_DIGIT_Code']);
                $totalunittype = @$unitType['micro'] + @$unitType['small'] + @$unitType['medium'] + @$unitType['large'];


                $manufacturingData[$sno]['II_DIGIT_Code'] = $pendensy['II_DIGIT_Code'];
                $manufacturingData[$sno]['Description'] = $pendensy['Description'];
                $manufacturingData[$sno]['micro'] = $unitType['micro'];
                $manufacturingData[$sno]['small'] = $unitType['small'];
                $manufacturingData[$sno]['medium'] = $unitType['medium'];
                $manufacturingData[$sno]['large'] = $unitType['large'];
                //  $manufacturingData[$sno]['total']=$totalunittype;
                $sno++;
            }

            if (empty($manufacturingData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $manufacturingData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Service Enterprises with 2 Digit National Industry Classification Code 
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetService2DigitReport() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
            $connection = Yii::app()->db;
            $sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where Industry_Type='SERVICES' ";
            $command = $connection->createCommand($sql);
            $appSub = $command->queryAll();

            $sno = 0;
            foreach ($appSub as $key => $pendensy) {
                $unitType = ApplicationExt::getNICCodeMicroProject($pendensy['II_DIGIT_Code']);
                $totalunittype = @$unitType['micro'] + @$unitType['small'] + @$unitType['medium'] + @$unitType['large'];


                $serviceData[$sno]['II_DIGIT_Code'] = $pendensy['II_DIGIT_Code'];
                $serviceData[$sno]['Description'] = $pendensy['Description'];
                $serviceData[$sno]['micro'] = $unitType['micro'];
                $serviceData[$sno]['small'] = $unitType['small'];
                $serviceData[$sno]['medium'] = $unitType['medium'];
                $serviceData[$sno]['large'] = $unitType['large'];
                //  $serviceData[$sno]['total']=$totalunittype;
                $sno++;
            }

            if (empty($serviceData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $serviceData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Category Wise Investment in Crs
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetCategoryWiseInvestmentInCrs() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }

            $Categoryunit['cost'] = ApplicationSubmissionExt::getCategoryWiseCost();
            $Categoryunit['type'] = ApplicationExt::getCategoryTotalProject();

            if (empty($Categoryunit)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $Categoryunit;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Industry Wise Report
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetIndustryWiseReport() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }

            $Categoryunit['IndustryEstablishedInState'] = ApplicationExt::getMicroTotalProject();
            $Categoryunit['ProjectTypeInState'] = ApplicationExt::getProjectStatusTotalProject();
            $Categoryunit['IndustryTypeInState'] = ApplicationExt::getUnitTypeTotalProject();
            $Categoryunit['NatureOfOrgnisation'] = ApplicationExt::getNatureofOrganizationTotal();

            if (empty($Categoryunit)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $Categoryunit;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Overall CAF Report Disctrict Wise
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function ActionGetOverAllCAFreport() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }

            $connection = Yii::app()->db;
            $sql = "Select district_id, distric_name from bo_district";
            $command = $connection->createCommand($sql);
            $depptt = $command->queryAll();
            $count = 1;
            $count1 = 0;
            $count2 = 0;
            $count3 = 0;
            $count4 = 0;
            $count5 = 0;
            $count6 = 0;
            $count7 = 0;
            $count8 = 0;
            $count9 = 0;
            $count10 = 0;
            $count11 = 0;
            $count12 = 0;
            foreach ($depptt as $key => $dept) {

                if ($dept['district_id'] == '6') {
                    $Dname = $dept['distric_name'];
                    $deptartmentData[$key][$Dname]['distric_id'] = $dept['district_id'];
                    $deptartmentData[$key][$Dname]['total_caf_application'] = $totoaldistrictDDN = ApplicationExt::getTotalOverAllDistrictReceivedDDNApps('6');
                    $deptartmentData[$key][$Dname]['total_pending_lessthan_48'] = ApplicationExt::getTotalOverAllDistrictDICPendingDDNApps('6', 'P');
                    $deptartmentData[$key][$Dname]['total_pending_morethan_48'] = $totalDIC48PendingDDN = ApplicationExt::getTotalOverAllDistrictDICPending48DDNApps('6', 'P');
                    $deptartmentData[$key][$Dname]['total_reverted'] = $totalRevertedDDN = ApplicationExt::getTotalOverAllDistrictRevertedDDNApps('6', 'H');
                    $deptartmentData[$key][$Dname]['total_forword'] = ApplicationExt::getTotalOverAllDistrictForwardedDDNApps('6');
                    $deptartmentData[$key][$Dname]['total_approved'] = ApplicationExt::getTotalOverAllDistrictApprovedDDNApps('6', 'A');
                    $deptartmentData[$key][$Dname]['total_rejected'] = ApplicationExt::getTotalOverAllDistrictRejectedDDNApps('6', 'R');
                    $deptartmentData[$key][$Dname]['total_pending_concerned_dept'] = $totalForwardedDeptDDN = ApplicationExt::getTotalOverAllDistrictForwardedDeptDDNApps('6', 'F');
                    $deptartmentData[$key][$Dname]['total_male'] = ApplicationExt::getProjectTotalEMPDDNMale('6');
                    $deptartmentData[$key][$Dname]['total_female'] = ApplicationExt::getProjectTotalEMPDDNFemale('6');
                    $deptartmentData[$key][$Dname]['total_investmet'] = ApplicationExt::getProjectTotalDDNInvestment('6');
                } else {
                    $Dname = $dept['distric_name'];
                    $deptartmentData[$key][$Dname]['distric_id'] = $dept['district_id'];
                    $deptartmentData[$key][$Dname]['total_caf_application'] = ApplicationExt::getTotalOverAllDistrictReceivedApps($dept['district_id']);
                    $deptartmentData[$key][$Dname]['total_pending_lessthan_48'] = ApplicationExt::getTotalOverAllDistrictDICPendingApps($dept['district_id'], 'P');
                    $deptartmentData[$key][$Dname]['total_pending_morethan_48'] = ApplicationExt::getTotalOverAllDistrictDICPending48Apps($dept['district_id'], 'P');
                    $deptartmentData[$key][$Dname]['total_reverted'] = ApplicationExt::getTotalOverAllDistrictRevertedApps($dept['district_id'], 'H');
                    $deptartmentData[$key][$Dname]['total_forword'] = ApplicationExt::getTotalOverAllDistrictForwardedApps($dept['district_id']);
                    $deptartmentData[$key][$Dname]['total_approved'] = ApplicationExt::getTotalOverAllDistrictApprovedApps($dept['district_id'], 'A');
                    $deptartmentData[$key][$Dname]['total_rejected'] = ApplicationExt::getTotalOverAllDistrictRejectedApps($dept['district_id'], 'R');
                    $deptartmentData[$key][$Dname]['total_pending_concerned_dept'] = ApplicationExt::getTotalOverAllDistrictForwardedDeptApps($dept['district_id'], 'F');
                    $deptartmentData[$key][$Dname]['total_male'] = ApplicationExt::getProjectTotalEMPMale($dept['district_id']);
                    $deptartmentData[$key][$Dname]['total_female'] = ApplicationExt::getProjectTotalEMPFemale($dept['district_id']);
                    $deptartmentData[$key][$Dname]['total_investmet'] = ApplicationExt::getProjectTotalInvestment($dept['district_id']);

                    $count1 += $totalCAFrecived;
                    $count2 += $totalDICPending;
                    $count3 += $totalDIC48Pending;
                    $count4 += $totalReverted;
                    $count5 += $totalForwarded;
                    $count6 += $totalApproved;
                    $count7 += $totalRejected;
                    $count8 += $totalForwardedDept;
                    $count9 += $totalMaleEmp;
                    $count10 += $totalFemaleEmp;
                    $count11 += $totalInvestment;
                }
            }

            if (empty($deptartmentData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $deptartmentData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    /**
     * This function is used to return Overall CAF Report Disctrict Wise
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function ActionGetOverallCAFApplicationComment() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }

            $criteria = new CDbCriteria;
            $criteria->condition = "application_status!=:incomplete";
            $criteria->params = array(":incomplete" => "I");
            $applications = ApplicationSubmission::model()->findAll($criteria);
            if (!empty($applications)) {
                foreach ($applications as $key => $apps) {
                    $investorinfo = ApplicationExt::getInvestorDetails($apps->user_id);
                    $decodedValue = json_decode($apps->field_value);
                    $api_hash = hash_hmac('sha1', md5($apps->user_id), SSO_API_PUBLIC_KEY);
                    $post_data = array('uid' => $apps->user_id, 'api_hash' => $api_hash);
                    $CAFApplicationData[$key]['district_name'] = DistrictExt::getDistricNameById($apps->landrigion_id);
                    $CAFApplicationData[$key]['submission_id'] = $apps->submission_id;
                    $CAFApplicationData[$key]['iuid'] = $investorinfo['iuid'];
                    $CAFApplicationData[$key]['unit'] = $decodedValue->company_name;
                    $CAFApplicationData[$key]['email'] = $investorinfo['email'];
                    $CAFApplicationData[$key]['mobile_number'] = $investorinfo['mobile_number'];
                    if ($apps->application_status == 'F')
                        $CAFApplicationData[$key]['application_status'] = "Forwarded";
                    if ($apps->application_status == 'P')
                        $CAFApplicationData[$key]['application_status'] = "Pending";
                    if ($apps->application_status == 'A')
                        $CAFApplicationData[$key]['application_status'] = "Approved";
                    if ($apps->application_status == 'B')
                        $CAFApplicationData[$key]['application_status'] = "Due for Payment";
                    if ($apps->application_status == 'H')
                        $CAFApplicationData[$key]['application_status'] = "Reverted";
                    if ($apps->application_status == 'I')
                        $CAFApplicationData[$key]['application_status'] = "Incomplete";
                    if ($apps->application_status == 'R')
                        $CAFApplicationData[$key]['application_status'] = "Rejected";
                    $connection=Yii::app()->db;
		$sql="SELECT approval_user_comment FROM bo_application_verification_level WHERE app_Sub_id=:id and approv_status in ('V','R','H','F')";
		$command=$connection->createCommand($sql);
                $subID=$apps->submission_id;
		$command->bindParam(":id",$subID,PDO::PARAM_INT);
		$comment=$command->queryRow();
		$CAFApplicationData[$key]['comment']= $comment['approval_user_comment'];
                }
            }
            if (empty($CAFApplicationData)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $CAFApplicationData;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }
    
          /**
     * This function is used to return What's new
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetWhatsnew() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash'])) {
            extract($_POST);
           /* $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }*/
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
        $connection = Yii::app()->db;
        $sql = "SELECT id,title,url FROM `bo_whatsnew` WHERE traveled_via_api=0";
        $command = $connection->createCommand($sql);
        $allApplicatiosDetail = $command->queryAll();
       
           
            if (empty($allApplicatiosDetail)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $allApplicatiosDetail;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }
	
	public function actionGetWhatsnewV1() {
        $response = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash'])) {
            extract($_POST);
           /* $role_id = $_POST['role_id'];
            if ($role_id != 2) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }*/
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
        $connection = Yii::app()->db;
        if(!empty($investor)){
			$sql = "SELECT id,title,url FROM `bo_whatsnew` WHERE traveled_via_api=0";
		}
        $command = $connection->createCommand($sql);
        $allApplicatiosDetail = $command->query();
       
        
            if (empty($allApplicatiosDetail)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $allApplicatiosDetail;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }
       /**
     * This function is used to return all dynamic reports rank wise with icon title and webview url
     * @author Rahul Kumar    
     * @return json    
     *    
     *    
     */
    public function actionGetWebviewReport() {
        $response = array(); 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
      //  print_r($_POST);die;
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            extract($_POST);
            $role =array(2,33);
            if (!in_array($role_id,$role)) {
                header('STATUS: 401', true, 401);
                $response['STATUS'] = 401;
                $response['MSG'] = "Not Authorised";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            $cal_hash = '1234567890';
            if ($cal_hash != $api_hash) {
                header('STATUS: Method Not allowed', true, 401);
                $response['STATUS'] = 401;
                $response['ERROR'] = "Wrong Api Hash";
                $response['RESPONSE'] = "Wrong Api Hash";
                echo json_encode($response);
                exit;
            }
        $connection=Yii::app()->db; 
			$sql="SELECT icon,report_name,url FROM bo_mobile_app_report WHERE is_active='Y' ORDER BY rank ASC";
			$command=$connection->createCommand($sql);
			//$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$allApplicatiosDetail=$command->queryAll();
			
       
           
            if (empty($allApplicatiosDetail)) {
                header('STATUS: 204', true, 204);
                $response['STATUS'] = 204;
                $response['MSG'] = "No data Found";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
            header('STATUS: 200 Ok', true, 200);
            $response['STATUS'] = 200;
            $response['RESPONSE'] = $allApplicatiosDetail;
            echo json_encode($response);
            exit;
        } else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }
    }

    public function actionValidateApiData(){
       $sp_tag=$_POST['sp_tag'];
       $app_id=$_POST['app_id'];
       $app_status=$_POST['app_status'];
       $user_id=$_POST['user_id'];
       $remote_server=$_POST['remote_server'];
       $user_agent=$_POST['user_agent'];
       $is_active='Y';
        
         $response=array();
        $response['STATUS'] = 200;
                            $response['MSG'] = "Success";
                            $response['RESPONSE'] = "Data has been validated"; 
            $connection = Yii::app()->db;                 
       	$sql = "SELECT id FROM bo_sp_all_applications_validate WHERE service_id='$app_id' AND is_active='$is_active'";
		$command = $connection->createCommand($sql);
		$service_exist = $command->queryRow();
       
               if(!empty($service_exist)){ 
       //-----------------------------
       
                // sp_tag check with table sso_service_providers and fields service_provider_tag 
                                                       
                                                        
		$sql = "SELECT service_provider_tag FROM sso_service_providers WHERE service_provider_tag='$sp_tag' AND is_service_provider_active='$is_active'";
		$command = $connection->createCommand($sql);
		$sp_tag_exist = $command->queryRow();
                if(empty($sp_tag_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "sp_tag is either not valid or not active"; 
                             echo json_encode($response);die;
                }
                 //sp_app_id check with Table : bo_sp_all_applications , Field name : app_id 
               $sql = "SELECT app_id FROM bo_sp_all_applications WHERE app_id=$app_id AND is_app_active='$is_active'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Service ID is either not valid or not active "; 
                             echo json_encode($response);die;
                }
                
                 //sp_app_id check with Table : bo_sp_all_applications , Field name : app_id 
               $sql = "SELECT app_id FROM bo_sp_all_applications WHERE app_id=$app_id AND is_app_active='$is_active'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Service ID is either not valid or not active "; 
                             echo json_encode($response);die;
                }
                //Status Check it should be (A,P,F,R,I,RBI )
                $allowedStatus=array("A","P","F","R","I","RBI");
                if(!in_array($app_status,$allowedStatus)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Status code invalid is not valid";  
                             echo json_encode($response);die;
                }
                if($app_status=="RBI"){
                    if($_POST['reverted_call_back_url']=="" || $_POST['reverted_call_back_url']=="#" ){
                          $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "reverted_call_back_url is compulsory in case of status 'RBI'";  
                             echo json_encode($response);die;
                    }
                }
                if($app_status=="A"){
                    if($_POST['download_certificate_call_back_url']=="" || $_POST['download_certificate_call_back_url']=="#" ){
                          $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "download_certificate_call_back_url is compulsory in case of status 'A'";  
                             echo json_encode($response);die;
                    }
                }
                if(!empty($user_id)){
                  $sql = "SELECT user_id FROM sso_users WHERE user_id='$user_id'";
		$command = $connection->createCommand($sql);
		$is_exist = $command->queryRow();
                if(empty($is_exist)){
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "Invalid User ID"; 
                             echo json_encode($response);die;
                }
                }
                
                 if(empty($remote_server)){               
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "remote_server should not be empty"; 
                             echo json_encode($response);die;
                }   
                
                if(empty($user_agent)){               
                     $response['STATUS'] = 400;
                            $response['MSG'] = "Invalid Value Passed";
                            $response['RESPONSE'] = "user_agent should not be empty "; 
                             echo json_encode($response);die;
                }  
               }
                //----------------------------------
                
             echo json_encode($response);die;
    }
/*
 * @author: Rahul Kumar
 * @date : 28022018
 */
   function getSubServiceDetail($serviceIDS=null,$user_id=null,$caf_id=null){
       // $user_id=11;
        $i=0;
      //  $caf_id=442;$iuid=75722846;
      //  $serviceIDS="12";
        $iuid=$this->getIuid($user_id);
  $serviceArray=explode(",",$serviceIDS);
  foreach($serviceArray as $swcs_service_id){
							$data_app_arr = $this->getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id);
                                                        if($data_app_arr){
								$service_status 	= $data_app_arr['app_status'];
								$application_number = $data_app_arr['app_id'];
							}else{
								$service_status 	= NULL;
								$application_number = NULL;
							}
                                                        $sql="select * from bo_information_wizard_service_parameters where swcs_service_id=$swcs_service_id ORDER BY id DESC";
							$res=Yii::app()->db->createCommand($sql)->queryRow();
                                                       $core_service_name=$res['service_type'];
							$infowiz_final_service_id=$res['service_id'].".".$res['servicetype_additionalsubservice'];
                                                       $data_dms_app_arr = $this->getAppliedServiceCertificate($infowiz_final_service_id,$user_id,$iuid);
                                                       if($data_dms_app_arr){
								$document_code = $data_dms_app_arr['document_code'];
								$document_name = $data_dms_app_arr['document_name'];
								$file_name 	   = $data_dms_app_arr['file_name'];
							}
							
                                                       $sql1="select bo_infowizard_issuerby_master.name from bo_information_wizard_service_master LEFT JOIN bo_infowizard_issuerby_master ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id where id=$res[service_id]";
							$res1=Yii::app()->db->createCommand($sql1)->queryRow();
                                                       $department_name=$res1['name'];
                                                        
							$services_data_array[$i]['service_id'] 			= $swcs_service_id;
							$services_data_array[$i]['service_name'] 		= $core_service_name;
							$services_data_array[$i]['service_status'] 		= $service_status;
							$services_data_array[$i]['application_number'] 	= $application_number;
							$services_data_array[$i]['department_name'] 	= $department_name;
							//$services_data_array[$i]['is_mandatory'] 		= $is_mandatory;
							$services_data_array[$i]['document_code'] 		= $document_code;
							$services_data_array[$i]['document_name'] 		= $document_name;
							$services_data_array[$i]['file_name'] 			= $file_name;
							
							$i++;
						}
    
					
					
						if($services_data_array == false){
							$row['sub_services'] = NULL;
						}else{
							$row['sub_services'] = $services_data_array;
						}
                                               // echo "<pre>";
                                                return $row;
                                                //die;
					// END OF row_services

    }
     /* Reused By Rahul */
    function getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id){
			$sql_s="SELECT * FROM bo_sp_applications WHERE sp_app_id='$swcs_service_id' AND caf_id='$caf_id' AND user_id='$user_id' AND app_status !='I' ORDER BY sno DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s;
			return false;
		}
                /* Reused By Rahul */
                	function getAppliedServiceCertificate($infowiz_final_service_id,$user_id,$iuid){
			$sql_s="SELECT chk.name as document_name,chk.chklist_id as document_code, dms.document_name as file_name FROM bo_information_wizard_service_certificate_maping as c_map 
					INNER JOIN bo_infowizard_documentchklist as chk ON chk.docchk_id=c_map.doc_checklist_id
					LEFT JOIN cdn_dms_documents as dms ON dms.docchk_id=chk.docchk_id AND dms.user_id='$user_id'
					WHERE c_map.final_service_id='$infowiz_final_service_id' AND is_active='Y'  ORDER BY c_map.id DESC, dms.documents_id DESC LIMIT 1";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s;
			return false;
		}
                /*Rahul */
                function getConsumedServices($sno=null,$appID=null){
                    $sql_s="SELECT * from bo_sp_application_consumed_services where sno=$sno AND application_number=$appID";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s;
			return false;
                    
                }
/*Rahul */
                function getIuid($uid=null){
                    $sql_s="SELECT iuid from sso_users where user_id=$uid";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryRow();
			if(count($res_s)>0)
				return $res_s['iuid'];
			return false;
                    
                }
                /*
                 * @authour: Rahul Kumar
                 * @date:04032018
                 *                  */
                function getPaymentInfo($sno=null,$appID=null){
                    /* For Travelling parameters with blank value*/
                    /* Will Fetch value once Got gateway Information*/
                    $response=array();
                    $response['payment_info']['payment_type']="NULL";
                    $response['payment_info']['payment_mode']="NULL";
                    $response['payment_info']['payment_datetime']="NULL";
                    $response['payment_info']['paid_amount']="NULL";
                    $response['payment_info']['reference_number']="NULL";
                    $response['payment_info']['treasury_head_detail']="NULL";
                    $response['payment_info']['recipent_bank_name']="NULL";
                    $response['payment_info']['recipent_bank_ac_no']="NULL";
                    $response['payment_info']['recipent_bank_ifsc_code']="NULL";
                    return $response;
                }
                
                public function actionSubmitSPApplicationV2test() {
        $response = array();
        // header('content-type: application/json');
        // echo "<pre>";print_r($_POST); print_r($_GET); die;
        if (isset($_POST['api_hash'], $_POST['app_id'], $_POST['user_id'], $_POST['app_status'], $_POST['service_id']) && (!empty($_POST['api_hash']) && !empty($_POST['user_id']) && !empty($_POST['app_status']) && !empty($_POST['service_id']))) {
            $this->generate_api_log(json_encode($_POST), "For test saving only post");
            // $_POST=Utility::
            
			$val_resp = json_decode($this->ValidateSubmitApiData(),true);
                        
			//echo "<pre>";print_r($val_resp);die;
            extract($_POST);
            if($val_resp['STATUS'] == 200){
			$cal_api_hash = hash_hmac('sha1', md5($user_id . $app_id), SW_PUBLIC_KEY);

            if ($api_hash == $cal_api_hash) {
                $criteria = new CDbCriteria();
                // $criteria->condition="sp_tag=:sp_tag AND app_id=:app_id AND user_id=:user_id AND app_status=:app_status";
                $criteria->condition = "sp_tag=:sp_tag AND app_id=:app_id and sp_app_id=:service_id";
                $criteria->params = array(':sp_tag' => $sp_tag, ':app_id' => $app_id, ":service_id" => $service_id);
                $modelCheck = SpApplications::model()->findAll($criteria);
                
                if (!empty($modelCheck)) {
                    #header('STATUS: 204 Ok',TRUE,204);				
                    $response['STATUS'] = 409;
                    $response['MSG'] = "Already submitted";
                    $response['RESPONSE'] = "Application has been already submitted";
                } else {
                    if ($app_status == 'p' || $app_status == 'P')
                        $app_status = 'P';
                    elseif ($app_status == 'I' || $app_status == 'i')
                        $app_status = 'I';
                    if ($app_status == 'P' || $app_status == 'I') {
                        if ($app_status == 'I' && (!isset($reverted_call_back_url) || empty($reverted_call_back_url))) {
                            $response['STATUS'] = 400;
                            $response['MSG'] = "Insufficient Parameters";
                            $response['RESPONSE'] = "Reverted Back URL needed in case of Incomplete Application";
                        } elseif ($app_status == 'P' && (!isset($print_app_call_back_url) || empty($print_app_call_back_url))) {
                            $response['STATUS'] = 400;
                            $response['MSG'] = "Insufficient Parameters";
                            $response['RESPONSE'] = "Print Application URL is needed in case of Pending Application";
                        } else {
                            // Start the transaction
							/* CODE UPDATED BY SANTOSH KUMAR on 18-09-2017 FOR DMS */
							
							$transaction = Yii::app()->db->beginTransaction();
							try{ // try start
							
							$model = new SpApplications;
                            $model->sp_tag = $sp_tag;
                            $model->app_id = $app_id;
                            $model->sp_app_id = $service_id;
                            $model->app_name = $app_name;
                            $model->app_status = $app_status;
                            $model->user_id = $user_id;
                            $model->created_on = date('Y-m-d H:i:s');
                            $model->updated_on = date('Y-m-d H:i:s');
                            $model->is_active = 'Y';
                            $model->remote_server = $remote_ip;
                            $model->user_agent = $user_agent;
                            if (isset($app_distt) && !empty($app_distt))
                                $model->app_distt = $app_distt;
                            if (isset($app_comments) && !empty($app_comments))
                                $model->app_comments = $app_comments;
                            if (isset($app_distt_name) && !empty($app_distt_name))
                                $model->app_distt_name = $app_distt_name;
                            if (isset($app_location) && !empty($app_location))
                                $model->app_location = $app_location;
                            if (isset($is_applied_by_caf) && !empty($is_applied_by_caf))
                                $model->is_applied_by_caf = $is_applied_by_caf;
                            if (isset($caf_id) && !empty($caf_id))
                                $model->caf_id = $caf_id;
                            if (isset($unit_name) && !empty($unit_name))
                                $model->unit_name = $unit_name;
                            if (isset($reverted_call_back_url) && !empty($reverted_call_back_url))
                                $model->reverted_call_back_url = $reverted_call_back_url;
                            if (isset($print_app_call_back_url) && !empty($print_app_call_back_url))
                                $model->print_app_call_back_url = $print_app_call_back_url;
                            if (isset($param_1) && !empty($param_1))
                                $model->param_1 = $param_1;
                            if (isset($param_3) && !empty($param_3))
                                $model->param_3 = $param_3;
                            if (isset($param_4) && !empty($param_4))
                                $model->param_4 = $param_4;
                            if (isset($param_2) && !empty($param_2))
                                $model->param_2 = $param_2;
                            if (isset($param_5) && !empty($param_5))
                                $model->param_5 = $param_5;
							if (isset($employee_count) && !empty($employee_count)){
                                $model->noe = $employee_count;
					}else{
						$model->noe = NULL;
					}
							/*** 
								Extra Param Added in Main Table
								Date - 29-12-2017
								@Santosh Kumar
							**/
							if (isset($created_date_time) && !empty($created_date_time))
								$model->created_date_time = $created_date_time;
							if (isset($last_updated_date_time) && !empty($last_updated_date_time))
								$model->last_updated_date_time = $last_updated_date_time;
                            if ($model->save()) {
                                $data = array();
                                $data['sp_tag'] = $sp_tag;
                                $data['service_id'] = $service_id;
                                $data['sp_app_id'] = $sno = $model->sno;
                                $data['app_id'] = $app_id;
                                $data['application_status'] = $app_status;
                                $data['param_1'] = @$param_1;
                                $data['param_2'] = @$param_2;
                                $data['param_3'] = @$param_3;
                                $data['param_4'] = @$param_4;
                                $data['param_5'] = @$param_5;
                                if (isset($comments))
                                    $data['comments'] = $comments;
                                if (isset($approver_id))
                                    $data['approver_id'] = $approver_id;
								if (isset($approver_details))
									$data['approver_details'] = $approver_details;
                                if (isset($next_approver))
                                    $data['next_approver'] = $next_approver;
                                if (isset($sent_dated_time))
                                    $data['sent_dated_time'] = $sent_dated_time;
								/** 
									Extra Pram added in API 
									Date : 29-12-2017
									@Santosh Kumar
								*/
								if (isset($role_id))
									$data['role_id'] = $role_id;
								if (isset($role_name))
									$data['role_name'] = $role_name;
								if (isset($role_user_info))
									$data['role_user_info'] = $role_user_info;
								if (isset($next_role_id))
									$data['next_role_id'] = $next_role_id;
								if (isset($remote_ip))
									$data['remote_server'] = $remote_ip;
								if (isset($user_agent))
									$data['user_agent'] = $user_agent;
								/** ---- END ----**/
                                $this->generateSpApplicationHistory($data);
								
								/*
									API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
									FOR DMS 
									DATE : 15-Sep-2017
								*/
								if(isset($documents)){
									if($documents!=''){
										// sso_service_providers
										$is_service_provider_active='Y';
										$is_account_active='Y';
										$connection = Yii::app()->db;
										$sql_s = "SELECT * FROM sso_service_providers WHERE service_provider_tag=:sp_tag AND is_service_provider_active =:is_service_provider_active";
										$command = $connection->createCommand($sql_s);
										$command->bindParam(":sp_tag", $sp_tag, PDO::PARAM_STR);
										$command->bindParam(":is_service_provider_active", $is_service_provider_active, PDO::PARAM_STR);
										$row_s = $command->queryRow();
										if($row_s == FALSE){
											$dept_id = 0;
										}else{
											$dept_id = $row_s['department_id'];
										}
										$connection = Yii::app()->db;
										$sql_u = "SELECT * FROM sso_users WHERE user_id=:user_id AND is_account_active=:is_account_active";
										$command = $connection->createCommand($sql_u);
										$command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
										$command->bindParam(":is_account_active", $is_account_active, PDO::PARAM_STR);
										$row_u = $command->queryRow();
										if($row_u == FALSE){
											$iuid=0;
										}else{
											$iuid=$row_u['iuid'];
										}
										
										//echo $dept_id."---".$iuid; die;
						
										/*$used_data_array = array();
										foreach($documents as $key=>$docs_arr){
											$used_code 		= $docs_arr['code'];
											$used_file_name 		= $docs_arr['file_name'];
											$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid);
										}*/
										$used_data_array = array();
										$documents_arr = explode("::",$documents); 
										foreach($documents_arr as $docs_arr){
											$docs_arr = trim($docs_arr);
											if($docs_arr!=''){
												list($used_code,$used_file_name) = explode("~",$docs_arr);
												//$used_code 		= $docs_arr['code'];
												//$used_file_name 		= $docs_arr['file_name'];
												$this->saveUsedDocumentsInServiceByDepartment($used_code,$used_file_name,$sno,$user_id,$dept_id,$iuid);
											}
											
										}
										
									}
								}
																
								/* -----  END OF CODE ------*/
								
								/*
									API UPDATED BY @@@@@ SANTOSH KUMAR @@@@
									FOR CP Sub services 
									DATE : 23-02-2018
								*/
								if(isset($sub_services)){
									if($sub_services!=''){
										$sub_services_array 	= explode("::",$sub_services);
										$sub_services_string 	= implode(",", $sub_services_array);
										$model_sub = new SpApplicationConsumedServices;
										$model_sub->sno=$sno;
										$model_sub->application_number=$app_id;
										$model_sub->consumed_services=$sub_services_string;
										//$model_sub->dept_id=$dept_id;
										//$model->user_agent='Api Access';
										//$model->ip_address=$_SERVER['REMOTE_ADDR'];
										$model_sub->created_at=date("Y-m-d H:i:s");
										$model_sub->save();
									}
								}
								
								
                                $transaction->commit();
								
								
                                // header('STATUS: 200 Ok',true,200);				
                                $response['STATUS'] = 200;
                                $response['MSG'] = "Successfully Saved";
                                $response['RESPONSE'] = "Submitted Successfully";
                                //DefaultUtility::sendSMSEmailGlobalServiceService('Service','Service submitted successfuly',$app_id);
                            }
                            else {
                                // header('STATUS: DB error',true,503);				
                                $response['STATUS'] = 503;
                                $response['MSG'] = "Database Error";
                                $error = "";
                                foreach ($model->geterrors() as $key => $errors) {
                                    foreach ($errors as $key => $err) {
                                        $error .= "<li>" . $err . "</li>";
                                    }
                                }
                                $response['RESPONSE'] = "Unknown Error. Please Try again Later" . $error;
                            }
                            //echo "<pre>";print_r($_POST); print_r($_GET); die;
                        }// Try END -- Was there an error?
						catch (Exception $e) {
							// Error, rollback transaction
								$transaction->rollback();
								$response['STATUS'] = 503;
                                $response['MSG'] = "Database Error";
								$msg ='';
                                if ($e->getCode() === 23000) {
									  $msg = " or Please contact your API support team.. :)";
								 }
								$response['RESPONSE'] = "Unknown Error. Please Try again Later.... " . $msg;
						} // END OF CATCH
						}
                    } else {
                        $response['STATUS'] = 401;
                        $response['MSG'] = "Invalid Application Status";
                        $response['RESPONSE'] = "Application status should be either P (Pending) or I(Partially Completed)";
                    }
                }
            } else {
                // header('STATUS: Bad Request',true,400);				
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "Invalid Hash. API HASH on server is :" . $cal_api_hash . " and you have posted " . $api_hash . " hash. MD5 of UID & app_id is: " . md5($user_id . $app_id);
            }
			}else{
				$response['STATUS'] = 400;
				$response['MSG'] = $val_resp['MSG'];
				$response['RESPONSE'] = $val_resp['RESPONSE'];
				
			}
		} else {
            // header('STATUS: Bad Request',true,400);				
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request. Insufficient Parameters.";
            $response['RESPONSE'] = "Insufficient Parameters.";
        }
        echo json_encode($response);
        $this->generate_api_log(json_encode($_POST), json_encode($response));
        // echo "<pre>";print_r($_POST);
        exit;
    }
}
