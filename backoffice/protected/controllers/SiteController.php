<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /*
      public function beforeAction()
      {
      if (Yii::app()->user->isGuest)
      $this->redirect(Yii::app()->createUrl('user/login'));

      //something code right here if user valided
      } */

    public function actionTest() {
        $host = 'jumbolabs.com';
        $port = 80;
        $connection = @fsockopen($host, $port);
        if (is_resource($connection)) {
            echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

            fclose($connection);
        } else {
            echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
        }
    }

    /**
     * Profile View
     */
    public function actionProfile() {
        @session_start();
        if (isset($_SESSION['RESPONSE']))
            $this->render('profile');
        else
            $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Profile Edit
     */
    public function actionEditProfile() {
        @session_start();
        if (isset($_SESSION['RESPONSE']))
            $this->render('profile_edit');
        else
            $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        die('here');
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->redirect(array('/frontuser'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
            if ($Error = Yii::app()->ErrorHandler->Error) {
                if (Yii::app()->request->isAjaxRequest)
                    echo $Error['message'];
                else
                    $this->render('Error', $Error);
            }
    }

    private function getdistNodalList() {
        $sql = "SELECT bo_user.*,distt.distric_name,dept.department_name FROM bo_user INNER JOIN bo_user_role_mapping rm
		 INNER JOIN bo_district distt ON bo_user.disctrict_id=distt.district_id
		 INNER JOIN bo_departments dept ON dept.dept_id=bo_user.dept_id
		 where rm.user_id=bo_user.uid AND  role_id=3 ORDER BY distt.distric_name";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $users = $command->queryAll();
        return $users;
    }

    private function getStateNodallist() {
        $sql = "SELECT bo_user.*,distt.distric_name,dept.department_name FROM bo_user INNER JOIN bo_user_role_mapping rm
		 INNER JOIN bo_district distt ON bo_user.disctrict_id=distt.district_id
		 INNER JOIN bo_departments dept ON dept.dept_id=bo_user.dept_id
		 where rm.user_id=bo_user.uid AND (role_id=4 OR role_id=5) ORDER BY bo_user.disctrict_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $users = $command->queryAll();
        return $users;
    }

    public function actionExportDistNodalList() {
        $users = $this->getdistNodalList();
        $content = $this->renderPartial("exportListNodal", array("users" => $users, "type" => "Distt"), true);
        DefaultUtility::PDFApplication($content, "NodalList.pdf");
        exit;
    }

    public function actionExportStateNodalList() {
        $users = $this->getStateNodallist();
        $this->renderPartial("exportListNodal", array("users" => $users, "type" => "State"));
    }

    public function actionDisttListNodal() {
        $users = $this->getdistNodalList();
        $this->renderPartial("listNodal", array("users" => $users, "type" => "Distt"));
    }

    public function actionStateListNodal() {
        $users = $this->getStateNodallist();
        $this->renderPartial("listNodal", array("users" => $users, "type" => "State"));
    }

    public function actionUploadNicCode() {
        die("===> Access Denied");
        ini_set('max_execution_time', 9999);
        $fileName = getcwd() . "/nic_code.csv";
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            $cnt = 0;
            $success = 1;
            while (($rowToArray = fgetcsv($handle, 500000, ",")) !== FALSE) {
                // echo "<pre>"; print_r($rowToArray); die;
                if ($cnt <= 0) {
                    // $header = $rowToArray;
                    // echo "<pre>";print_r($header);
                    echo $cnt++;
                } else {
                    $header = $rowToArray;
                    $model = new NICCodes;
                    if (!empty($header[2])) {
                        $model->NIC_V_Digit = $header[2];
                        $model->Description = $header[3];
                        if (1) {
                            echo "<br>$cnt=========><pre>";
                            print_r($model->geterrors());
                        }
                    } else
                        echo "========> Not updated for $cnt<br>";
                }
            }
        }
    }

    public function actionGetIndustrTypeser() {
        $applications = ApplicationSubmission::model()->findAll();
        foreach ($applications as $key => $apps) {
            $fileds = json_decode($apps->field_value);
            echo "<table>";
            if (isset($fileds->ntrofunit) && !empty($fileds->ntrofunit)) {
                //$ans=$this->getNamFromVAlue($fileds->industry_type);
                if (isset($fileds->ntrofunit) && $fileds->ntrofunit == 'Services') {
                    echo "<tr>";
                    echo"<td>$apps->submission_id</td>";
                    echo"<td>[$fileds->company_name]</td>";
                    echo"<td>$fileds->ntrofunit</td>";
                    //echo"<td>($ans)</td>";
                    echo "</tr>";
                }
                //echo "<br> Industry type for caf $apps->submission_id [$fileds->company_name]====> $fileds->industry_type  ($ans)";
            }
            echo "</table>";
        }
        // echo "<pre>";print_r($applications);die;
    }

    private function getNamFromVAlue($id) {
        $sql = "SELECT Ans_Text from answer_master where Ans_ID=$id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $Ans_Text = $command->queryRow();
        return $Ans_Text['Ans_Text'];
    }

    public function actionGetIndustrType() {
        $applications = ApplicationSubmission::model()->findAll();
        foreach ($applications as $key => $apps) {
            $fileds = json_decode($apps->field_value);
            echo "<table>";
            if (isset($fileds->industry_type) && !empty($fileds->industry_type)) {
                $ans = $this->getNamFromVAlue($fileds->industry_type);
                echo "<tr>";
                echo"<td>$apps->submission_id</td>";
                echo"<td>[$fileds->company_name]</td>";
                echo"<td>$fileds->industry_type</td>";
                echo"<td>($ans)</td>";
                echo "</tr>";
                //echo "<br> Industry type for caf $apps->submission_id [$fileds->company_name]====> $fileds->industry_type  ($ans)";
            }
            echo "</table>";
        }
        // echo "<pre>";print_r($applications);die;
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionVerifyOTP() {
        @session_start();
        // print_r($_SESSION);die;
        if (isset($_SESSION['User']['OTP']) && !empty($_POST)) {
            $calOTP = $_SESSION['User']['OTP'];
            extract($_POST['LoginForm']);
            $cal_hash = hash_hmac('sha1', $uid . $calOTP, OTP_SECRET_KEY);
            if ($cal_hash != $hash) {
                throw new Exception("Fraudulent Request found on the server", 401);
            }
            $model = User::model()->findByPK($uid);
            if ($model === null) {
                throw new Exception("Request Not found", 404);
            }
            /* if ($calOTP == $otp)
              { */
            unset($_SESSION['User']['OTP']);
            $_SESSION['department_login'] = true;
            $role_id = RolesExt::getUserRoleViaId($model->uid)['role_id'];
            $_SESSION['uid'] = $model->uid;
            $_SESSION['uname'] = $model->full_name;
            $_SESSION['email'] = $model->email;
            $_SESSION['dept_id'] = $model->dept_id;
            $_SESSION['dist_id'] = $model->disctrict_id;
            $_SESSION['role_id'] = $role_id;

            session_write_close();
            /* echo "<pre>";
              print_r($_SESSION);die; */
            if (isset($_SESSION['DU']) && !empty($_SESSION['DU'])) {
                /* echo "<pre>";
                  print_r($_SESSION);die; */
                $this->redirect(Yii::app()->createAbsoluteUrl('PisMou/Index/page/admin_listing1'));
            }

            if (isset($_POST['LoginForm']['primary'])) {

                //print_r($_POST);die;
                $dateTime = date('m-d-Y H:i:s');
                $sql = "select role_name from bo_roles where role_id=$role_id";
                $roleData = Yii::app()->db->createCommand($sql)->queryRow();
                if (!empty($roleData)) {
                    $roleName = $roleData['role_name'];
                }
                $notifiedMessage = "Delegate officer is currently logged-in with $roleName console"; // at $dateTime
                if ($_POST['LoginForm']['primary'] != $_POST['LoginForm']['delegate']) {
                    DefaultUtility::sendOTPToMobile($_POST['LoginForm']['primary'], $notifiedMessage);
                    $DelegateLoginLogModel = new DelegateLoginLogs();
                    $DelegateLoginLogModel->notified_to_mobile_number = $_POST['LoginForm']['primary'];
                    $DelegateLoginLogModel->loggedin_from_mobile_number = $_POST['LoginForm']['delegate'];
                    $DelegateLoginLogModel->notified_message = $notifiedMessage;
                    $DelegateLoginLogModel->created = date('Y-m-d H:i:s');
                    $DelegateLoginLogModel->uid = $model->uid;
                    $DelegateLoginLogModel->role_id = $role_id;

                    //print_r($DelegateLoginLogModel);die;

                    if ($DelegateLoginLogModel->save()) {

                    } else {
                        die(var_dump($DelegateLoginLogModel->getErrors()));
                    }
                }
            }
            if ($role_id == 73 || $role_id == 72 || $role_id == 80 || $role_id == 81) {
                //$dashboard_url = "/mis/newReport/OverallNewReport";
                $this->redirect(Yii::app()->createAbsoluteUrl('mis/newReport/OverallNewReport'));
            } else if ($role_id == 82) {
                $this->redirect(Yii::app()->createAbsoluteUrl('infowizard/actMaster'));
            } else {
                $this->redirect(Yii::app()->createUrl("/admin"));
            }
            exit;
            /* }else{
              Yii::app()->user->setFlash('Error', "Invalid OTP.");
              $this->redirect('login');
              die;
              } */
            //            } else {
            //                // invalid otp entered
            //                // $_SESSION['User']['OTP']=$otp;
            //                Yii::app()->user->setFlash('Error', "Invalid OTP.");
            //                DefaultUtility::sendOTPToMobile(ADMIN_MOBILE, "Your Single Window admin Login OTP is: " . $calOTP);
            //                $this->renderPartial("otp", array("otp" => $calOTP, "model" => $model));
            //                exit;
            //            }
        } else {

            Yii::app()->user->setFlash('Error', "Error:Invalid request found on the server");
            $this->redirect('login');
            die;
            // throw new Exception("Invalid request found on the server", 400);
        }
    }

    public function actionLogin() {
        session_destroy();
        if (isset($_SESSION['User']['OTP']))
            unset($_SESSION['User']['OTP']);
        $model = new LoginForm;
		
        @session_start();

        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            $this->redirect(Yii::app()->createUrl("/admin"));
        }

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {

            $criteria = new CDbCriteria();
            if (empty($_POST['LoginForm']['password'])) {
                Yii::app()->user->setFlash('Error', "Error:Please Fill Password");
                $this->redirect(Yii::app()->request->urlReferrer);
                die;
            }
            if (empty($_POST['LoginForm']['username'])) {
                Yii::app()->user->setFlash('Error', "Error:Please Fill User Name");
                $this->redirect(Yii::app()->request->urlReferrer);
                die;
            }
            if (empty($_POST['LoginForm']['password']) && empty($_POST['LoginForm']['username'])) {
                Yii::app()->user->setFlash('Error', "Error:Please Fill User Name & Password");
                $this->redirect(Yii::app()->request->urlReferrer);
                die;
            }
            $pass = hash_hmac('sha1', $_POST['LoginForm']['password'], PASSWORD_SECRET_KEY);
            $criteria->condition = 'email=:uname';
            $criteria->params = array(':uname' => $_POST['LoginForm']['username']);
            $model_user = User::model()->find($criteria);
            if (empty($model_user)) {
                Yii::app()->user->setFlash('Error', "Error: Invalid User Name");
                $this->redirect(Yii::app()->request->urlReferrer);
                die;
            } else {
                $criteria->select = 'email,uid,dept_id,full_name,mobile,delegate_officer_number,disctrict_id';
                $criteria->condition = 'email=:uname AND password=:pass AND is_active=:is_active ';
                $criteria->params = array(':uname' => $_POST['LoginForm']['username'], ':pass' => $pass, 'is_active' => '1');
                $model_pass = User::model()->find($criteria);
                // die("here");

                if (!empty($model_pass)) {
                    $token = "";

                    $token = $this->getToken(100);

                    if (!empty($token) && isset($token)) {

                        $access_model = new AccessToken;
                        $access_model->user_id = $model_pass->uid;
                        $access_model->access_token = $token;
                        $access_model->is_active = 1;
                        $access_model->created_date = Date('Y-m-d H:i:s');
                        $access_model->save();
                        $_SESSION['token'] = $token;
                    }
                }

                if (empty($model_pass)) {
                    Yii::app()->user->setFlash('Error', "Error: Invalid Password");
                    $this->redirect(Yii::app()->request->urlReferrer);
                    exit;
                } else {
                    @session_start();
                    $role_id = RolesExt::getUserRoleViaId($model_pass->uid)['role_id'];
                    $dashboard_url = "/admin";

                    // die("sorry! for Inconvenience. We will get back to you");
                    $_SESSION['department_login'] = true;
                    $_SESSION['uid'] = $model_pass->uid;
                    $_SESSION['uname'] = $model_pass->full_name;
                    $_SESSION['email'] = $model_pass->email;
                    $_SESSION['dept_id'] = $model_pass->dept_id;
                    $_SESSION['mobile'] = $model_pass->mobile;
                    $_SESSION['district_id'] = $model_pass->disctrict_id;
                    $_SESSION['dist_id'] = $model_pass->disctrict_id;


                    $userID = $model_pass->uid;

                    // Getting Role Id For passing to public Consultancy Department for single sign on

                    $userResult = Yii::app()->db->createCommand("select role_id from bo_user_role_mapping where user_id=$userID ")->queryRow();

                    if (!empty($userResult) && isset($userResult)) {

                        $_SESSION['role_id'] = $role_id;
                        //$_SESSION['user_id']=$model_pass->uid;
                        $result = UserExt::getUserDept($model_pass->uid);
                        // echo "<pre/>";
                        //print_r($result);die;
                        $_SESSION['department_name'] = $result['department_name'];
                    }


                    $_SESSION['first_time_login'] = 1;

                    session_write_close();
                    // echo "<pre>";print_r($_SESSION);die;
                    // die("sorry! for Inconvenience. We will get back to you.NOP");
                    //$this->redirect(Yii::app()->createUrl("/admin"));
                    //print_r($_SESSION);die;
                    //echo $dashboard_url;die;
                    $this->redirect(Yii::app()->createUrl($dashboard_url));
                    exit;
                }
            }
        } else {
            $this->redirect('/sso/account/signin');
        }

        // display the login form
        //die("hdj");
        // Login from switch account, it will set email-id
        $logincode = '';
        if (isset($_GET['logincode'])) {
            $logincode = base64_decode($_GET['logincode']);
        }

        $this->renderPartial('login', array('model' => $model, 'logincode' => $logincode));
    }

    public function actionMobileLogin() {
        $model = new LoginForm;
        if (!empty($_POST['mobile'])) {
            $criteria = new CDbCriteria();
            $mobile = "'" . $_POST['mobile'] . "'";


            $userResult = Yii::app()->db->createCommand("select * from bo_user
            INNER JOIN bo_user_role_mapping ON bo_user.uid=bo_user_role_mapping.user_id
            Where bo_user.mobile=$mobile AND bo_user_role_mapping.role_id IN ('79','3','5','33','34') AND is_active=1 ORDER BY uid DESC")->queryRow();
            /* echo "<pre>";
              print_r($userResult);die; */
            if (!empty($userResult)) {

                $role_id = $userResult['role_id'];
                $criteria->select = 'email,uid,dept_id,full_name,mobile';
                $criteria->condition = 'uid=:uid AND is_active=:is_active ';
                $criteria->params = array(':uid' => $userResult['uid'], 'is_active' => '1');
                $model_pass = User::model()->find($criteria);
                $userID = $model_pass->uid;
                if (!empty($userResult['role_id'])) {
                    $_SESSION['role_id'] = $userResult['role_id'];
                }

                // if ($role_id == 63) {
                $otp = rand(100000, 999999);
                $_SESSION['User']['OTP'] = $otp;
                $_SESSION['DU'] = "Yes";
                DefaultUtility::sendOTPToMobile($model_pass->mobile, "Use " . $otp . " as your login OTP to access Information Wizard Panel. OTP is confidential. Sharing it with anyone gives them full access to your Dashboard");
                $this->renderPartial("otp", array("otp" => $otp, "model" => $model_pass));
                exit;
                //   }
            } else {
                Yii::app()->user->setFlash('Error', 'Your Mobile number is not authorized for accessing this panel');
            }
        }
        $this->renderPartial('mobilelogin', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {

        @session_start();
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            $access_token = $_SESSION['token'];
            $sql = " UPDATE `bo_access_token` SET is_active='0'  where access_token='" . $access_token . "'";
            $command = Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_SESSION['RESPONSE'])) {
            $token = $_SESSION['RESPONSE']['token'];
            $url = TOKE_API_BASEURL . '/apiv1/logouttoken/token/' . $token;
            $response = DefaultUtility::postViaCurl($url);

            $qurl = 'https://caipotesturl.com/query/logout.php';
            $resp = DefaultUtility::postViaCurl($qurl);

            $url_ticket = 'https://caipotesturl.com/ticket/logout.php';
            $resp = DefaultUtility::postViaCurl($url_ticket);
        }
        unset($_SESSION['first_time_login']);
        unset($_SESSION['uname']);

        unset($_SESSION);


        Yii::app()->user->logout();
        session_destroy();

        setcookie('PHPSESSID', 'sdfds', time()-7000000, '/');
         setcookie('PHPSESSID', '', time()-60*60*24*90, '/', '', 0, 0);
                unset($_COOKIE['PHPSESSID']);

                $_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_start(); // initialize session
session_destroy(); // destroy session
setcookie("PHPSESSID","",time()-3600,"/");
// Finally, destroy the session.
session_destroy();

        $this->redirect(FRONT_BASEURL);
    }

    /* Rahul Kumar */

    public function actionUkdipp() {

        $this->render("ukdipp");
    }

    public function actionSmsTest() {
        DefaultUtility::sendOTPToMobile('8076706093', "Test");
    }

    /* Jitendra for Authenticate Login Token */

    private function getToken($length) {

        $token = "";

        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";

        $codeAlphabet .= "0123456789";

        $max = strlen($codeAlphabet); // edited



        for ($i = 0; $i < $length; $i++) {

            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
        }



        return $token;
    }

    private function crypto_rand_secure($min, $max) {

        $range = $max - $min;

        if ($range < 1)
            return $min; // not so random...

        $log = ceil(log($range, 2));

        $bytes = (int) ($log / 8) + 1; // length in bytes

        $bits = (int) $log + 1; // length in bits

        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do {

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);

        return $min + $rnd;
    }

    public function actionCafProposalReportISA() {

        $this->render('cafProposalReportISA');
    }

    public function actionMobileOtpLogin() {
        /* echo $_SESSION['User']['OTP'];
          print_r($_POST);
          die(); */
        if (isset($_SESSION['User']['OTP']) && !empty($_POST)) {
            $calOTP = $_SESSION['User']['OTP'];
            if ($calOTP == $_POST['LoginForm']['otp']) {
                $sql = "Select * FROM bo_user WHERE mobile IN(SELECT mobile FROM bo_user WHERE uid =" . $_POST['LoginForm']['uid'] . ")";
                $result = Yii::app()->db->createCommand($sql)->queryAll();
                $this->renderPartial("mobileotplogin", array('result' => $result));
            } else {
                return 0;
            }
        }
    }

    public function actionActsRulesNotifications() {
        $this->render('act_notification_rules');
    }

    public function actionDelegateOTP() {
        if (!empty($_POST)) {
            // print_r($_POST);die;
            $otp = rand(100000, 999999);
            $model = new stdClass();
            $model->uid = $_POST['uid'];
            $_SESSION['User']['OTP'] = $otp;
            $mobileNumber = substr_replace($_POST['number'], "XXXX", 2, 4);
            DefaultUtility::sendOTPToMobile($_POST['number'], " OTP is " . $otp . " for your Single Window Login. Do not share OTP for security reason ");
            //DefaultUtility::sendOTPToMobile($_POST['primary_number'], " Delegate officer is trying to login with your account");
            $this->renderPartial("otpfordelegate", array("otp" => $otp, "message_otp" => $mobileNumber, "model" => $model, "primary" => $_POST['primary_number'], "delegate" => $_POST['number']));
        }
    }

}
