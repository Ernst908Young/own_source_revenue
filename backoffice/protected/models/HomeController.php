<?php
/**
 *@author: Hemant Thakur
 */


class HomeController extends Controller
{
    
    public function actionIndex()
    {
        $error = '';
        if (isset($_POST['SSO_STATUS_CODE']) && $_POST['SSO_STATUS_CODE'] == 401)
            $error = 'Unauthorized User';
        if (isset($_POST['SSO_TOKEN'])) {
            
            extract($_POST);
            $data     = $_POST;
            $res      = Utility::getViaCurl($SSO_HREF);
            $_res     = json_decode($res);
            $RESPONSE = 0;
            if (is_object($_res))
                $RESPONSE = (array) $_res->RESPONSE;
            if (count($RESPONSE) > 4) {
                $is_valid_sso_token = 1;
                @session_start();
                $_SESSION['LOGGED_IN'] = 1;
                $_SESSION['RESPONSE']  = $RESPONSE;
            }
        }
        $this->render('index', array(
            'error' => $error
        ));
    }
    
    public function actionDownaloadInvestorDocuments($app_sub_id)
    {
        @session_start();
        $times = time();
        if (isset($_GET['app_sub_id']) && isset($_SESSION['RESPONSE'])) {
            $app_sub_id = base64_decode($_GET['app_sub_id']);
            $doc        = ApplicationExt::getInvestorDocs($app_sub_id);
            if ($doc && is_object($doc)) {
                if ($doc->STATUS === 200) {
                    if (is_object($doc->RESPONSE)) {
                        $data    = base64_decode($doc->RESPONSE->document);
                        $pdfFile = $doc->RESPONSE->doc_name . '.pdf';
                        if (file_put_contents($pdfFile, $data) !== false) {
                            header("Content-Disposition: attachment; filename=" . urlencode($pdfFile));
                            header("Content-Type: application/octet-stream");
                            header("Content-Type: application/download");
                            header("Content-Description: File Transfer");
                            header("Content-Length: " . filesize($pdfFile));
                            echo $data;
                            $this->redirect(array(
                                '/frontuser'
                            ));
                            exit;
                        } else {
                            Yii::app()->user->setFlash('Error', "Sorry! Could not download your document.");
                            $this->redirect(array(
                                '/frontuser'
                            ));
                            exit;
                        }
                    } else {
                        Yii::app()->user->setFlash('Error', "Sorry! something Went wrong.");
                        $this->redirect(array(
                            '/frontuser'
                        ));
                        exit;
                    }
                } else {
                    Yii::app()->user->setFlash('Error', $response->RESPONSE);
                    $this->redirect(array(
                        '/frontuser'
                    ));
                    exit;
                }
            } else {
                Yii::app()->user->setFlash('Error', "Invalid Request.");
                $this->redirect(array(
                    '/frontuser'
                ));
                exit;
            }
            
        } else {
            Yii::app()->user->setFlash('Error', "Invalid Request.");
            $this->redirect(array(
                '/frontuser'
            ));
            exit;
        }
    }
    
    public function actionPrintForm()
    {
        if (empty($_GET['app_id']))
            return;
        $app_sub_id = base64_decode($_GET['app_id']);
        $appInfo    = ApplicationSubmissionExt::getSubmittedAppviaIdPrint($app_sub_id);
        if (!$appInfo) {
            Yii::app()->user->setFlash('Error', "You have not submitted the application.");
            $this->redirect(array(
                '/frontuser'
            ));
            exit;
        }
        
        $content = $this->renderPartial("printCAF", array(
            "data" => $appInfo,
            "app_sub_id"=>$app_sub_id
        ), true);
        $name    = "Application_Form.pdf";
        Utility::generatePdfApp($content, $name);
        exit;
    }
    
    public function actionCafFormUpdate()
    {
        if (isset($_POST['ManageApplication'])) {
            //upload documents of the user
            $post_data = array();
            $modelCdn  = new ApplicationCdnMappingExt;
            if (isset($_FILES) && !empty($_FILES['ApplicationField']['tmp_name'])) {
                foreach ($_FILES['ApplicationField']['tmp_name'] as $key => $file_content) {
                    $imgData   = file_get_contents($file_content);
                    $post_data = array();
                    $hash      = hash_hmac('sha1', md5($user_id . $app_id), CDN_PUBLIC_KEY);
                    $post_data = array(
                        'user_id' => $user_id,
                        'app_id' => $app_id,
                        'api_hash' => $hash,
                        'doc_id' => $_POST['ApplicationField']['doc_id'][$key],
                        'dept_id' => $dept_id,
                        'doc_name' => $_FILES['ApplicationField']['name'][$key],
                        'doc_type' => $_FILES['ApplicationField']['type'][$key],
                        'doc_size' => $_FILES['ApplicationField']['size'][$key],
                        'doc_blob_data' => base64_encode($imgData)
                    );
                    $response  = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                    if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                        Yii::app()->user->setFlash('Error', $response->RESPONSE);
                        $this->redirect(array(
                            '/frontuser'
                        ));
                        exit;
                    }
                }
            }
            $modelSub = ApplicationSubmission::model()->findByPk($_POST['ManageApplication']['submition_id']);
            if ($modelSub === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            if (isset($_POST['ManageApplication']))
                unset($_POST['ManageApplication']);
            $modelSub->field_value = json_encode($_POST);
            if ($modelSub->application_status != 'H')
                throw new CHttpException(404, 'The requested page does not exist.');
            $modelSub->application_status = 'P';
            if ($modelSub->save()) {
                $criteria            = new CDbCriteria;
                $criteria->select    = 'appr_lvl_id';
                $criteria->condition = 'approv_status=:approv_status';
                $criteria->params    = array(
                    ':approv_status' => 'H'
                );
                $modelvl             = ApplicationVerificationLevel::model()->find($criteria);
                $model               = ApplicationVerificationLevel::model()->findByPk($modelvl->appr_lvl_id);
                if ($model === null)
                    throw new CHttpException(404, 'The requested page does not exist.');
                $model->approv_status = 'P';
                if (!empty($model)) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('Success', "Success: Your application has been successfully updated");
                        $this->redirect(array(
                            '/frontuser'
                        ));
                        exit;
                    }
                    
                }
            }
        }
    }
    
    
    public function actionCafFormFinish()
    {
        @session_start();
        //admin can't access this page 
        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
            throw new CHttpException(400, "you can't access this page");
        }
        //check for whether user is logged in or not
        if (!$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);
        // echo "<pre>";print_r($_SESSION);die;
        $uid = $_SESSION['RESPONSE']['user_id'];
        if (isset($_POST['IUID'])) {
            $post_data   = array();
            $modelCdn    = new ApplicationCdnMappingExt;
            $fileUPloads = true; //true means there is any files in the form that need to be uploaded and false means no files
           /*fileupload here*/
           if (isset($_FILES) && !empty($_FILES['caf_applications_uploads']['tmp_name'])) {
                          $app_id = ApplicationExt::getCAFId();
                          if (!empty($app_id))
                              $app_id = $app_id['application_id'];
                          $dept_id    = ApplicationExt::getDeptIdFromAppId($app_id);
                          $docs_prop  = $modelCdn->getApplicationDocuments($uid, $app_id);
                          $prop_array = array();
                          foreach ($docs_prop as $key => $prop)
                              $prop_array[$prop['doc_id']] = array(
                                  'min_size' => $prop['doc_min_size'],
                                  'max_size' => $prop['doc_max_size'],
                                  'type' => $prop['doc_type']
                              );
                          
                          foreach ($_FILES['caf_applications_uploads']['tmp_name'] as $key => $file_content) {
                              if (empty($file_content))
                                  continue;
                              if (isset($_POST['selected_doc_type'][$key]) && empty($_POST['selected_doc_type'][$key])) {
                                  Yii::app()->user->setFlash('Error', "Please select File type");
                                  $this->redirect(array(
                                      '/frontuser/home/cafForm'
                                  ));
                                  exit;
                              }
                              $f_type          = explode('.', $_FILES['caf_applications_uploads']['name'][$key]);
                              $file_ext        = end($f_type);
                              $file_type_check = $_FILES['caf_applications_uploads']['type'][$key];
                              $file_size       = $_FILES['caf_applications_uploads']['size'][$key];
                              $compare_key     = $_POST['fileDocumentCount'][$key];
                              if (trim($_POST['selected_doc_type'][$key]) == 'image/jpeg') {
                                  if ($file_type_check != 'image/jpeg')
                                      if ($file_type_check != 'image/png') {
                                          Yii::app()->user->setFlash('Error', "File must be of jpg/png type.");
                                          $this->redirect(array(
                                              '/frontuser/home/cafForm'
                                          ));
                                          exit;
                                      }
                              } elseif ($_POST['selected_doc_type'][$key] == 'application/pdf') {
                                  if ($file_type_check != 'application/pdf') {
                                      Yii::app()->user->setFlash('Error', "Please Upload pdf file.");
                                      $this->redirect(array(
                                          '/frontuser/home/cafForm'
                                      ));
                                      exit;
                                  }
                              } elseif ($file_type_check != $_POST['selected_doc_type'][$key]) {
                                  Yii::app()->user->setFlash('Error', "Please Upload " . $prop_array[$_POST['caf_applications_uploads']['doc_id'][$compare_key]]['type'] . " file.");
                                  $this->redirect(array(
                                      '/frontuser/home/cafForm'
                                  ));
                                  exit;
                              }
                              $doc_min_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['min_size']) * 1000;
                              $doc_max_size = intval($prop_array[$_POST['caf_applications_uploads']['doc_id'][$key]]['max_size']) * 1000;
                              
                              if ($file_size < $doc_min_size || $file_size > $doc_max_size) {
                                  /*Yii::app()->user->setFlash('Error', "File must be of size ".$doc_min_size.' - '.$doc_max_size);
                                  $this->redirect(array('/frontuser/home/cafForm'));
                                  exit;*/
                              }
                              if (isset($_POST['authorization_letters_type']) && !empty($_POST['authorization_letters_type'])) {
                                  $doc_name  = $_POST['authorization_letters_type'] . $file_ext;
                                  $imgData   = file_get_contents($file_content);
                                  $post_data = array();
                                  $hash      = hash_hmac('sha1', md5($uid . $app_id), CDN_PUBLIC_KEY);
                                  $post_data = array(
                                      'user_id' => $uid,
                                      'app_id' => $app_id,
                                      'api_hash' => $hash,
                                      'doc_id' => $_POST['caf_applications_uploads']['doc_id'][$key],
                                      'dept_id' => $dept_id,
                                      'doc_name' => $doc_name,
                                      'doc_type' => $_POST['selected_doc_type'][$key],
                                      'doc_size' => $_FILES['caf_applications_uploads']['size'][$key],
                                      'doc_blob_data' => base64_encode($imgData)
                                  );
                                  $res       = DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data);
                                  $response  = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                                  if (is_object($response)) {
                                      if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                                          $fileUPloads = false;
                                      }
                                  }
                                  unset($_POST['authorization_letters_type']);
                                  continue;
                              }
                              $doc_type_name = $_FILES['caf_applications_uploads']['name'][$key];
                              if (isset($_POST['selected_doc_id_card']))
                                  $doc_type_name = $_POST['selected_doc_id_card'] . '_' . $doc_type_name;
                              if (isset($_POST['selected_partnership_deed']))
                                  $doc_type_name = $_POST['selected_partnership_deed'] . '_' . $doc_type_name;
                              if (isset($_POST['selected_expension']))
                                  $doc_type_name = $_POST['selected_expension'] . '_' . $doc_type_name;
                              
                              
                              $imgData   = file_get_contents($file_content);
                              $post_data = array();
                              $hash      = hash_hmac('sha1', md5($uid . $app_id), CDN_PUBLIC_KEY);
                              $post_data = array(
                                  'user_id' => $uid,
                                  'app_id' => $app_id,
                                  'api_hash' => $hash,
                                  'doc_id' => $_POST['caf_applications_uploads']['doc_id'][$key],
                                  'dept_id' => $dept_id,
                                  'doc_name' => $doc_type_name,
                                  'doc_type' => $_POST['selected_doc_type'][$key],
                                  'doc_size' => $_FILES['caf_applications_uploads']['size'][$key],
                                  'doc_blob_data' => base64_encode($imgData)
                              );
                              $response  = json_decode(DefaultUtility::postViaCurl(CDN_APIV1 . '/saveDocuments', $post_data));
                              if (is_object($response)) {
                                  if (!$response->STATUS == 200 || !$response->STATUS == 204) {
                                      $fileUPloads = false;
                                  }
                              }
                          }
                      }

           
            if (!$fileUPloads) {
                Yii::app()->user->setFlash('Error', "Files are not uploaded successfully ");
                $this->redirect(array(
                    '/frontuser/home/cafForm'
                ));
                exit;
            }
            $deptModel          = new DepartmentsExt;
            $dept_id            = $deptModel->getDeptIdFromUniqCode('CHiPS');
            $appModel           = new ApplicationExt;
            $app_id             = $appModel->getAppIdFromName('CAF', $dept_id);
            //check for existing incomplete application
            $critera            = new CDbCriteria;
            $critera->select    = 'submission_id,application_status';
            $critera->condition = "application_id=:app_id AND user_id=:user_id AND dept_id=:dept_id";
            $critera->params    = array(
                ":app_id" => $app_id,
                ":dept_id" => $dept_id,
                ":user_id" => $uid
            );
            $critera->order     = 'submission_id DESC';
            $app_sub_model      = ApplicationSubmission::model()->find($critera);
            $model = ApplicationSubmission::model()->findByPk($app_sub_model['submission_id']);
            if ($app_sub_model === null) {
                //application doesn't exist for current logged in user create new one
                $model                           = new ApplicationSubmission;
                $model->application_id           = $app_id;
                $model->dept_id                  = $dept_id;
                $model->user_id                  = $uid;
                $model->application_created_date = date("Y-m-d H:m:s");
                ;
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
                
            }
            else {
                if ($app_sub_model['application_status'] == 'I' || $app_sub_model['application_status'] == 'H') {
                    //partially field application
                    
                    if ($model === null) {
                        print_r(json_encode(array(
                            "Error" => "The requested page does not exist."
                        )));
                        return;
                    }
                } elseif ($app_sub_model['application_status'] == 'P') {
                    // not a partially field
                    print_r(json_encode(array(
                        "Error" => "Application Already Filled."
                    )));
                    return;
                }
            }
            if ($app_sub_model['application_status'] == 'H') {
                $model->field_value              = json_encode($_POST);
                $model->application_status       = 'P';
                $model->application_created_date = date("Y-m-d H:m:s");
                ;
                $distric = '';
                if (!empty($_POST['Land_in_Hectares']) && !empty($_POST['land_leased_disctric']))
                    $distric = trim($_POST['land_leased_disctric']);
                elseif (!empty($_POST['detail_of_leased_space_area_in_sq_meters']) && !empty($_POST['land_disctric']))
                    $distric = trim($_POST['land_disctric']);
                if (isset($_POST['invstmnt_in_total'][0]) && !empty($_POST['invstmnt_in_total'][0]) && $_POST['invstmnt_in_total'][0] > 10)
                    $distric = 6;
                $model->landrigion_id = $distric;
                if ($model->save()) {
                    $hold                = 'H';
                    $criteria            = new CDbCriteria;
                    $criteria->condition = 'app_Sub_id=:app_sub_id AND approv_status=:status';
                    $criteria->params    = array(
                        ':app_sub_id' => $app_sub_model['submission_id'],
                        ':status' => $hold
                    );
                    $criteria->order     = 'appr_lvl_id DESC';
                    $lvmodel             = ApplicationVerificationLevel::model()->find($criteria);
                    if (!empty($lvmodel)) {
                        $lvmodel->approv_status = 'P';
                        if ($lvmodel->save()) {
                            $appFlow                     = new ApplicationFlowLogs;
                            $appFlow->submission_id      = $app_sub_model['submission_id'];
                            $appFlow->created_date_time  = date("Y-m-d H:m:s");
                            $appFlow->user_agent         = $_SERVER['HTTP_USER_AGENT'];
                            $appFlow->remote_ip_address  = $_SERVER['REMOTE_ADDR'];
                            $appFlow->application_status = 'IBD';
                            $appFlow->save();
                            Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: " . $model->submission_id);
                            $this->redirect(array(
                                '/frontuser'
                            ));
                            exit;
                        } else {
                            $model->application_status = 'H';
                            $model->save();
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('Error', "Error: Could not upadate");
                    $this->redirect(array(
                        '/frontuser'
                    ));
                    exit;
                }
            }
            $model->field_value              = json_encode($_POST);
            $model->application_status       = 'B';
            $model->application_created_date = date("Y-m-d H:m:s");
            $distric                         = '';
            if (!empty($_POST['Land_in_Hectares']) && !empty($_POST['land_leased_disctric']))
                $distric = trim($_POST['land_leased_disctric']);
            elseif (!empty($_POST['detail_of_leased_space_area_in_sq_meters']) && !empty($_POST['land_disctric']))
                $distric = trim($_POST['land_disctric']);
            if (isset($_POST['ntrofunit'],$_POST['invstmnt_in_plant'][0]) && (($_POST['ntrofunit']=='Manufacturing' && $_POST['ntrofunit']=='large' && $_POST['invstmnt_in_plant'][0] >10) || ($_POST['ntrofunit']=='Services' && $_POST['ntrofunit']=='large' && $_POST['invstmnt_in_plant'][0] > 5)))
              $distric = 6;
            /*if (isset($_POST['invstmnt_in_total'][0]) && !empty($_POST['invstmnt_in_total'][0]) && $_POST['invstmnt_in_total'][0] > 10)
                $distric = 6;*/
            $model->landrigion_id = $distric;
            if ($model->save()) {
                if (isset($_POST['ntrofunittype']) && $_POST['ntrofunittype'] == 'micro') {
                    $this->render('cafAfterPayment', array(
                        'response' => 'NONE',
                        'app_sub_id' => $model->submission_id,
                        'land_reg' => $distric,
                        'pre_field' => $_SESSION['RESPONSE'],
                        'statusCode'=>'S',
                        'incmplt_fields' => json_decode($model->field_value)
                    ));
                    exit;
                }
                
                // $ntrofunittype
                $amount=0;
                if($_POST['ntrofunittype']=='small')
                        $amount = 1000;
                if($_POST['ntrofunittype']=='medium')
                        $amount = 5000;
                if($_POST['ntrofunittype']=='large')
                        $amount = 10000;

            
                $this->render('payment', array(
                    "submission_id" => $model->submission_id,
                    "iuid" => $_SESSION['RESPONSE']['iuid'],
                    'application_id' => $model->application_id,
                    "amount" => $amount
                ));
                exit;
            }
            //print_r($model->geterrors());
            //print_r(array(json_encode(array("Error"=>"Unknown Error! Please Try Again Later."))));
            return;
        }
        
    }
    
    
    /** 
     *this function is used to submit the caf appliction after payment
     *@author Hemant Thakur
     */
    public function actionCafFinishAfterPayment()
    {
        if (isset($_POST['FinalSubmit'])) {
            @session_start();
            extract($_POST['FinalSubmit']);
            $criteria            = new CDbCriteria();
            $criteria->condition = "submission_id=:app_sub_id";
            $criteria->params    = array(
                ":app_sub_id" => $app_sub_id
            );
            $Application         = ApplicationSubmission::model()->find($criteria);
            $app_fields          = json_decode($Application['field_value']);
            if (empty($Application)) {
                Yii::app()->user->setFlash('Error', "Invalid Request");
                $this->redirect(Yii::app()->homeUrl);
                exit;
            }
            $Application->application_status       = 'P';
            $Application->application_created_date = date("Y-m-d H:m:s");
            if ($Application->save()) {
                $criteria            = new CDbCriteria;
                $criteria->select    = 'role_id';
                $criteria->condition = 'app_id=:app_id';
                $criteria->order     = 'wrkflw_id ASC';
                $criteria->params    = array(
                    ':app_id' => $Application->application_id
                );
                $modelwrklw          = AppWorkflow::model()->findAll($criteria);
                // if(!empty($modelwrklw) && isset($modelwrklw[0])){
                //assign the level in verification 
                $vlmodel             = new ApplicationVerificationLevel;
                 if (isset($app_fields->ntrofunit,$app_fields->invstmnt_in_plant[0]) && (($app_fields->ntrofunit=='Manufacturing' && $app_fields->ntrofunit=='large' && $app_fields->invstmnt_in_plant[0] >10) || ($app_fields->ntrofunit=='Services' && $app_fields->ntrofunit=='large' && $app_fields->invstmnt_in_plant[0] > 5)))
                    $vlmodel->next_role_id = 4;
                else
                    $vlmodel->next_role_id = 7;
                $vlmodel->app_Sub_id = $Application->submission_id;
                $vlmodel->created_on = date("Y-m-d H:m:s");
                $vlmodel->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $vlmodel->ip_address    = $_SERVER['REMOTE_ADDR'];
                $vlmodel->approv_status = 'P';
                if ($vlmodel->save()) {
                    /*send the mobile sms to the user */
                    $mobile   = $_SESSION['RESPONSE']['mobile_number'];
                    $email    = $_SESSION['RESPONSE']['email'];
                    $api_hmac = hash_hmac("sha1", $mobile . $email, OTP_SECRET_KEY);
                    $data     = array(
                        'mobile' => $mobile,
                        "hmac" => $api_hmac,
                        "email" => $email,
                        "msg" => "Your application has been successfully submitted. Your Application ID: " . $Application->submission_id
                    );
                    $url      = BO_API_BASEURL . '/sendMobMsg';
                    DefaultUtility::postViaCurl($url, $data);
                    $api_hmac = hash_hmac("sha1", $_SESSION['RESPONSE']['iuid'] . $email, OTP_SECRET_KEY);
                    $data     = array(
                        'uiid' => $_SESSION['RESPONSE']['iuid'],
                        "hmac" => $api_hmac,
                        "email" => $email,
                        "message" => "Your application has been successfully submitted. Your Application ID: " . $Application->submission_id
                    );
                    Yii::app()->user->setFlash('Success', "Success: Your application has been successfully submitted. Your Application ID: " . $Application->submission_id);
                    $this->redirect(array(
                        '/frontuser'
                    ));
                    exit;
                }
            }
            Yii::app()->user->setFlash('Error', "Could not update.");
            $this->redirect(Yii::app()->homeUrl);
            exit;
        }
        Yii::app()->user->setFlash('Error', "Invalid Request");
        $this->redirect(Yii::app()->homeUrl);
        
    }
    
    
    
    
    // Render user to timeline
    public function actionTimeline()
    {
        @session_start();
        if (isset($_SESSION['RESPONSE'])) {
            if (isset($_GET['app_id']) && !empty($_GET['app_id'])) {
                $app_id       = $_GET['app_id'];
                $app_comments = ApplicationApproveLevelExt::getApplicationComments($app_id);
                if (!empty($app_comments) && isset($app_comments)) {
                    $this->render('timeline', array(
                        'app_comments' => $app_comments
                    ));
                    unset($_GET['app_id']);
                } else {
                    Yii::app()->user->setFlash('error', "No Data Found");
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }
    
    /* Function is used to redirect to payment gateway
     *  @ Author : Hemant Thakur
     *  @ params : none
     */
    public function actionPaymentPay()
    {
        @session_start();
        if (!isset($_SESSION['RESPONSE'], $_POST['amount'])) {
            Yii::app()->user->setFlash('Error', "Not a valid Request");
            $this->redirect(array(
                '/frontuser'
            ));
            exit;
        }
        extract($_POST);
        $this->render('payment', array(
            'iuid' => $iuid,
            'submission_id' => $submission_id,
            'application_id' => $application_id,
            'amount' => $amount
        ));
    }
    
    
    public function actionCafFormAfterPayment()
    {
        
    }
    
    /* Function is used to get the payment response
     *  @ Author : Hemant Thakur
     *  @ params : none
     @ return : 
     */
    public function actionPaymentResponse()
    {
        @session_start();

        if(isset($_REQUEST['merchantResponse'])){
	        $responseMerchant = $_REQUEST['merchantResponse'];
	        $obj = new AWLMEAPI();
	        $resMsgDTO = new ResMsgDTO();
	        $reqMsgDTO = new ReqMsgDTO();
	        $enc_key = WORLDLINE_ENCRYP_KEY;
	        $response = $obj->parseTrnResMsg($responseMerchant , $enc_key );
	        $app_sub_id=$response->getAddField1();
	        $app_id=$response->getAddField2();
	        $iuid=$response->getAddField3();
	        $paymentModel = new PaymentDetail();
	        $paymentModel->pgMeTrnRefNo=$response->getPgMeTrnRefNo();
	        $paymentModel->orderId=$response->getOrderId();
	        $paymentModel->authZStatus=$response->getAuthZCode();
	        $paymentModel->bank_reference_bank=$response->getRrn();
	        $paymentModel->user_id=$iuid;
	        $paymentModel->application_id=$app_id;
	        $paymentModel->app_sub_id=$app_sub_id;
	        $paymentModel->amount=$response->getTrnAmt();
	        $paymentModel->trnReqDate=$response->getTrnReqDate();
	        $paymentModel->statusCode=$response->getStatusCode();
	        $paymentModel->status_description=$response->getStatusDesc();
	        if($paymentModel->save()){
	        	$incmplt_fields = ApplicationSubmissionExt::getSubmittedAppviaId($app_sub_id);
	        	$land_reg = '';
	        	if (!empty($incmplt_fields)) {
	        	    $land_reg = $incmplt_fields['landrigion_id'];
	        	    $incmplt_fields = json_decode($incmplt_fields['field_value']);
	        	    $appName=ApplicationExt::getAppNameViaId($app_id);
	        	    if($appName['application_name']=='CAF')
		        	    $this->render('cafAfterPayment', array(
		        	        'response' => $response,
		        	        'app_sub_id' => $app_sub_id,
		        	        'land_reg' => $land_reg,
		        	        'pre_field' => $_SESSION['RESPONSE'],
		        	        'incmplt_fields' => $incmplt_fields
		        	    ));
		        	else{
		        		Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
		        		$this->redirect(array('/frontuser'));
		        		exit;
		        	}

	        	}
	        	else{
		        		Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
		        		$this->redirect(array('/frontuser'));
		        		exit;
		        }
	        }
	        else{
	        	echo "<pre>";print_r($paymentModel->geterrors());
	        }
	        
        }
        else{
        		Yii::app()->user->setFlash('Error', "Error: Invalid Request.");
        		$this->redirect(array('/frontuser'));
        		exit;
		}
        
    }
    
    
    
    
    
    /* Function is used to create and submit the CAF Application Form
     *  @ Author : Hemant Thakur
     *  @ params : none
     @ return : json response to ajax
     */
    
    public function actionCafForm()
    {
        
        $appModel = new ApplicationExt;
        @session_start();
        //admin can't access this page 
        if (isset($_SESSION['department_login']) && $_SESSION['department_login']) {
            throw new CHttpException(400, "you can't access this page");
        }
        //check for whether user is logged in or not
        if (empty($_SESSION['LOGGED_IN']) || !$_SESSION['LOGGED_IN'])
            $this->redirect(SSO_URL1);
        // echo "<pre>";print_r($_SESSION);die;
        $uid        = $_SESSION['RESPONSE']['user_id'];
        $deptModel  = new DepartmentsExt;
        $dept_id    = $deptModel->getDeptIdFromUniqCode('CHiPS');
        $app_id     = $appModel->getAppIdFromName('CAF', $dept_id);
        /*check whether application is for payment or not */
        $appPayment = ApplicationExt::checkUsersPrevCAFApplicationsForPayment($uid, $app_id);
        if ($appPayment && ($appPayment['application_status'] == 'B' && PaymentDetailExt::getPaymentStatus($appPayment['submission_id'])=='S')) {
            // $amount = 1;
            $Application = ApplicationSubmissionExt::getSubmittedAppviaId($appPayment['submission_id']);
            $incmplt_fields=json_decode($Application['field_value']);
            if($incmplt_fields->ntrofunittype=='micro'){
                $this->render('cafAfterPayment', array(
                'response' => 'NONE',
                'app_sub_id' => $appPayment['submission_id'],
                'land_reg' => $appPayment['landrigion_id'],
                'pre_field' => $_SESSION['RESPONSE'],
                'incmplt_fields' => $incmplt_fields,
                'statusCode'=>'S',
            ));
                exit;
            }
            
            /*check already paid or not */
            $critera= new CDbCriteria;
            $critera->condition="app_sub_id=:app_sub_id";
            $critera->params=array(":app_sub_id"=>$appPayment['submission_id']);
            $critera->order="payment_id DESC";
            $checkPay=PaymentDetail::model()->find($critera);
            if(!empty($checkPay)){
                $this->render('cafAfterPayment', array(
                'response' => 'APD',
                'detail'=>$checkPay,
                'app_sub_id' => $appPayment['submission_id'],
                'land_reg' => $appPayment['landrigion_id'],
                'pre_field' => $_SESSION['RESPONSE'],
                'incmplt_fields' => $incmplt_fields,
                'statusCode'=>'S',
            ));
                exit;
            }
            $this->render('paymentRedirect', array(
                "submisstion_id" => $appPayment['submission_id'],
                "iuid" => $_SESSION['RESPONSE']['iuid'],
                'application_id' => $app_id,
                "amount" => $amount
            ));
            exit;
        }
        //check for previous pending CAF application or this user
        $any_prev_pending_caf = $appModel->checkUsersPrevCAFApplications($uid, $app_id);
        if ($any_prev_pending_caf) {
            Yii::app()->user->setFlash('Error', "YOUR CAF APPLICATION IS ALREADY UNDER CONSIDERATION");
            $this->redirect(array(
                '/frontuser'
            ));
            exit;
        }
        if (isset($_POST['IUID'])) {
            //check for existing incomplete application
            $critera            = new CDbCriteria;
            $critera->select    = 'submission_id,application_status';
            $critera->condition = "application_id=:app_id AND user_id=:user_id AND dept_id=:dept_id AND application_status!=:apprv";
            $critera->params    = array(
                ":app_id" => $app_id,
                ":dept_id" => $dept_id,
                ":user_id" => $uid,
                ":apprv" => 'A'
            );
            $critera->order     = 'submission_id DESC';
            $app_sub_model      = ApplicationSubmission::model()->find($critera);
            if ($app_sub_model === null) {
                //application doesn't exist for current logged in user create new one
                $model                           = new ApplicationSubmission;
                $model->application_id           = $app_id;
                $model->dept_id                  = $dept_id;
                $model->application_status       = 'I';
                $model->user_id                  = $uid;
                $model->application_created_date = date("Y-m-d H:m:s");
                $model->ip_address               = $_SERVER['REMOTE_ADDR'];
                $model->user_agent               = $_SERVER['HTTP_USER_AGENT'];
                
            } else {
                if ($app_sub_model['application_status'] == 'I' or $app_sub_model['application_status'] == 'H') {
                    //partially field application
                    $model = ApplicationSubmission::model()->findByPk($app_sub_model['submission_id']);
                    if ($model === null) {
                        print_r(json_encode(array(
                            "status" => "Error: The requested page does not exist."
                        )));
                        return;
                    }
                } else {
                    // not a partially field
                    print_r(json_encode(array(
                        "status" => "Error: Application Already Filled."
                    )));
                    return;
                }
            }
            $model->field_value              = json_encode($_POST);
            $model->application_created_date = date("Y-m-d H:m:s");
            ;
            if ($model->save()) {
                // print_r($model->attributes);
                print_r(json_encode(array(
                    "status" => "SUCCESS: Application Submitted Successfully"
                )));
                return;
            }
            print_r($model->geterrors());
            //print_r(array(json_encode(array("Error"=>"Unknown Error! Please Try Again Later."))));
            return;
        }
        //check for previous incomplete application
        $incmplt_fields = $appModel->getUsersCAFApplications($uid);
        
        if (!empty($incmplt_fields))
            $incmplt_fields = json_decode($incmplt_fields[0]['field_value']);
        
        $pre_filed = $_SESSION['RESPONSE'];
        $app       = ApplicationExt::getCAFId();
        $this->render('cafForm', array(
            'pre_field' => $pre_filed,
            'app' => $app,
            'incmplt_fields' => $incmplt_fields
        ));
    }
    
    
}
