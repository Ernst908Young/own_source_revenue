<?php

class DefaultController extends Controller {

    public function actionDmsDashboard($page = 0) {
        @session_start();
        if (RolesExt::isDocumentVerifierUser()) {
            // echo "==";die;
            $year = '2016';
            if (isset($_GET['year']))
                $year = $_GET['year'];
            $this->render('documentVerifierDashboardNew', array("selectedYear" => $year));
            exit;
        }
    }

    public function actionIndex($page = 0) {
        // die("wait...");
		ini_set('memory_limit', '-1');
        @session_start();
         // echo "<pre>";print_r($_SESSION);die;
        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            if($_SESSION['role_id']=='63'){               
                $this->redirect(array("/infowizard/dashboard"));
            }
            if (DefaultUtility::isSMSSender()) {
                $this->redirect(array("/admin/sendSMS"));
                exit;
            }
            if (RolesExt::isAdminUser()) {
                $this->render('caipoDashboard');
                exit;
            }		
            if (in_array($_SESSION['role_id'],array('83'))) {
                //$this->render(Yii::app()->params['verifier_dashboard']);
                $this->render('new/index_verifier');
                
                exit;
            }            
            if (in_array($_SESSION['role_id'],array('84'))) {
                // die("dsdjsdk");
                // echo Yii::app()->params['approver_dashboard'];die;
                $this->render(Yii::app()->params['approver_dashboard']);
                exit;
            }
            if (in_array($_SESSION['role_id'],array('85'))) {
                $this->render(Yii::app()->params['support_dashboard']);
                exit;
            }
            // This condition was added by Aamir 15-07-2021
            if (in_array($_SESSION['role_id'],array('86'))) {
                $this->render(Yii::app()->params['admin_dashboard']);
                exit;
            }

            if (in_array($_SESSION['role_id'],array('95'))) {
               $this->render(Yii::app()->params['cashier_dashboard']); 
                exit;
            }
             if (in_array($_SESSION['role_id'],array('104'))) {            
                  $this->render(Yii::app()->params['acountant_dashboard']);
                exit;
            }
            if (in_array($_SESSION['role_id'],array('110'))) {            
                  $this->render(Yii::app()->params['registrar_dashboard']);
                exit;
            }
            
            
          
           
            /******** END OF PANKANJ CODE ****** */

            $this->render('index');
        } else {
            $model = new LoginForm;
            $this->redirect(array("/site/login"), $model);
        }
    }

    public function actionQuery($page = 0) {
        @session_start();
        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {


            /* Pankaj Kumar Tiwari   Date: 27Feb2018  */

            if (RolesExt::isHelpdeskUser()) {

                $connection = Yii::app()->db;

                $staff_id = QueryExt::getUserStaffId($_SESSION['email']);
                $dept_id = QueryExt::getUserDepartmentId($staff_id);
                $role_id = RolesExt::isHelpdeskUser();


                // Total Query
                $total_queries = QueryExt::getTotalQuery($role_id, $staff_id, $dept_id);


                //Total Open Query
                $total_open_queries = QueryExt::getTotalOpenQuery($role_id, $staff_id, $dept_id);


                //Total Closed Query
                $total_closed_queries = QueryExt::getTotalClosedQuery($role_id, $staff_id, $dept_id);

                //Total Answered Query
                $total_answered_query = QueryExt::getTotalAnsweredQuery($role_id, $staff_id, $dept_id);


                //Total Transfered Query
                $total_transfered_queries = QueryExt::getTotalTransferedQuery($role_id, $staff_id);

                /* Get Query List */
                $all_queries = QueryExt::getAllQuery($role_id, $staff_id, $page, $dept_id);

                $pages = new CPagination($total_queries);

                $this->render('helpdeskQueryDashboard', array(
                    'queries' => $all_queries,
                    'pages' => $pages,
                    'total_queries' => $total_queries,
                    'total_open_queries' => $total_open_queries,
                    'total_closed_queries' => $total_closed_queries,
                    'total_answered_queries' => $total_answered_query,
                    'total_transfered_queries' => $total_transfered_queries
                ));
            } else {

                $this->redirect(array("/admin/default/index"));
            }
        } else {
            $model = new LoginForm;
            $this->redirect(array("/site/login"), $model);
        }
    }

    public function actionApplicationview($app_sub_id) {
        print_r($app_sub_id);
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /*    public function accessRules() {
      return array(
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
      'users' => array('mail@email.com'),
      ),
      array('deny', // deny all users
      'users' => array('*'),
      ),
      );
      } */

    /*
     * @authour : Rahul Kumar
     * @date: 16052018
     * @Description : Nodal Performance Report Current FY
     */

//    public static function getNodalPerformenceReportCountOfStatusSelectedFY($status = null, $startDate = null, $endDate = null, $nextRoleID = null, $extraInMainStatus = null) {
//        
//        extract($_GET);
//        $extraCondition = "";
//        $extraCondition = "";
//        $statusCondition = "";
//        $verificationLevelCondition = "";
//        $flg=0;
//        
//         // Applications Approved for Empowered Committee
//        if ($nextRoleID == 33 || $nextRoleID == 34) {
//            $verificationLevelCondition = " AND bo_application_verification_level.approv_status='P' ";
//        }
//        //  For Checking Status In main table
//        if (!empty($extraInMainStatus)) {
//            $extraCondition = " bo_application_submission.application_status IN ($extraInMainStatus) AND";
//        }
//        
//        // For Passed Condition
//        if ($status != "''") {
//            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND ";
//        }
//        
//        // Under Process
//        if ($status == "'UNDER_PROCESSEED'" || $status == "'PENDING'") {
//            if($status == "'UNDER_PROCESSEED'"){$st="<=1";}
//            if($status == "'PENDING'"){$st=">1";}
//            $statusCondition = " bo_application_submission.application_status IN ('P') AND "
//                    . "    DATEDIFF(NOW(),DATE_FORMAT(bo_application_submission.application_created_date,'%Y-%m-%d'))$st  AND
//              "; 
//        }
//        
//        $sql = "select * from bo_application_flow_logs "
//                . " LEFT JOIN bo_application_submission ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id "
//                . " LEFT JOIN bo_application_verification_level ON bo_application_flow_logs.submission_id=bo_application_verification_level.app_Sub_id "
//                . "where $statusCondition $extraCondition "
//                . "DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND bo_application_submission.application_id=1  AND bo_application_submission.user_id!=11 "
//                . "AND DATE(bo_application_flow_logs.created_date_time)<='$endDate' "
//                . "AND bo_application_verification_level.next_role_id=$nextRoleID $verificationLevelCondition AND bo_application_submission.landrigion_id>0 "
//                . "group by bo_application_flow_logs.submission_id ";
//        // if($flg==1){echo $sql;die;}
//        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
//      //  return "<p name=''>".count($Fields)."<span style='display:block'>--$sql</span></p>";
//        return count($Fields);
//    }
//    

    /*
     * @authour : Rahul Kumar
     * @date: 16052018
     * @Description : Nodal Performance Report Carry Forworded
     */

//    static function getNodalPerformenceReportCountOfStatusCarryForward($status = null, $startDate = null, $endDate = null, $nextRoleID = null, $extraInMainStatus = null) {
//
//        extract($_GET);
//        $sql2 = "select bo_application_flow_logs.submission_id from bo_application_flow_logs where bo_application_flow_logs.application_status IN ('ISA')
//                    AND DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND DATE(bo_application_flow_logs.created_date_time)<='$endDate'";
//
//        $extraCondition = "";
//        $statusCondition = "";
//        $verificationLevelCondition = "";
//        // Applications Approved for Empowered Committee
//        if ($nextRoleID == 33 || $nextRoleID == 34) {
//            $verificationLevelCondition = " AND bo_application_verification_level.approv_status='P' ";
//        }
//        //  For Checking Status In main table
//        if (!empty($extraInMainStatus)) {
//            $extraCondition = " bo_application_submission.application_status IN ($extraInMainStatus) AND";
//        }
//        //For Passed Condition
//        if ($status != "''") {
//            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND ";
//        }
//         // Under Process
//        if ($status == "'UNDER_PROCESSEED'" || $status == "'PENDING'") {
//            if($status == "'UNDER_PROCESSEED'"){$st="<=1";}
//            if($status == "'PENDING'"){$st=">1";}
//            $statusCondition = " bo_application_submission.application_status IN ('P') AND "
//                    . "    DATEDIFF(NOW(),DATE_FORMAT(bo_application_submission.application_created_date,'%Y-%m-%d'))$st  AND
//              "; 
//        }
//        $revert="";
//        if($status=='IBD'){
//            $revert=" AND bo_application_submission.application_status!='H' ";
//        }
//
//        $sql = "select * from bo_application_flow_logs "
//                . " LEFT JOIN bo_application_submission ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id "
//                . " LEFT JOIN bo_application_verification_level ON bo_application_flow_logs.submission_id=bo_application_verification_level.app_Sub_id "
//                . "where $statusCondition $extraCondition "
//                . " DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND bo_application_submission.application_id=1   AND bo_application_submission.user_id!=11 "
//                . "AND DATE(bo_application_flow_logs.created_date_time)<='$endDate' "
//                . "AND bo_application_verification_level.next_role_id=$nextRoleID $revert $verificationLevelCondition"
//                . " AND bo_application_flow_logs.submission_id NOT IN ($sql2) "
//                . "group by bo_application_flow_logs.submission_id ";
////if($status=="''" && $extraInMainStatus=="'H"){ echo $sql;die; }
//        //$sql ="select * from bo_application_flow_logs where application_status IN ($status)
//        //AND DATE(created_date_time)>='$startDate' AND DATE(created_date_time)<='$startDate' AND submission_id NOT IN ($sql2)  group by submission_id" ;
//        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
//       // return "<p name=''>".count($Fields)."<span style='display:block'>--$sql</span></p>";
//       return count($Fields);
//    }


    /* Rahul Kumar :  02072018 */
    public function actionNodalPerformenceReport() {

        $this->render('nodalPerformanceReport1');
    }

    /*
     * @authour : Rahul Kumar
     * @date: 16052018
     * @Description : Nodal Performance Report Current FY
     */

    public static function getNodalPerformenceReportCountOfStatusSelectedFY($status = null, $startDate = null, $endDate = null, $nextRoleID = null, $extraInMainStatus = null, $type = null) {

        extract($_GET);
        $extraCondition = "";
        $statusCondition = "";
        $verificationLevelCondition = "";
        $flg = 0;

        // Applications Approved for Empowered Committee
        if ($nextRoleID == 33 || $nextRoleID == 34) {
            $verificationLevelCondition = " AND bo_application_verification_level.approv_status='P' ";
        }
        //  For Checking Status In main table
        if (isset($extraInMainStatus) && !empty($extraInMainStatus) && ($extraInMainStatus != null)) {
            $extraCondition = " bo_application_submission.application_status IN ($extraInMainStatus) AND";
        }

        // For Passed Condition
        if ($status != "''") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND ";
        }

        // For Passed Condition
        if ($status == "'IBD'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_submission.submission_id from bo_application_submission where application_status IN('H')) AND ";
        }

        if ($status == "'ISA'" && $extraInMainStatus == "'F'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_verification_level.app_Sub_id from bo_application_verification_level Where bo_application_verification_level.next_role_id IN ('33','34') ) AND ";
        }


        // Under Process
        if ($status == "'UNDER_PROCESSEED'" || $status == "'PENDING'") {
            if ($status == "'UNDER_PROCESSEED'") {
                $st = "<=1";
            }
            if ($status == "'PENDING'") {
                $st = ">1";
            }
            $statusCondition = " bo_application_submission.application_status IN ('P') AND "
                    . "    DATEDIFF(NOW(),DATE_FORMAT(bo_application_submission.application_created_date,'%Y-%m-%d'))$st  AND
              ";
        }

        $sql = "select * from bo_application_flow_logs "
                . " LEFT JOIN bo_application_submission ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id "
                . " LEFT JOIN bo_application_verification_level ON bo_application_flow_logs.submission_id=bo_application_verification_level.app_Sub_id "
                . "where $statusCondition $extraCondition "
                . "DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND bo_application_submission.application_id=1  AND bo_application_submission.user_id!=11 "
                . "AND DATE(bo_application_flow_logs.created_date_time)<='$endDate' "
                . "AND bo_application_verification_level.next_role_id=$nextRoleID $verificationLevelCondition AND bo_application_submission.landrigion_id>0 "
                . "group by bo_application_flow_logs.submission_id ";
        // echo $sql;die;
        // if($flg==1){echo $sql;die;}
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        //  return "<p name=''>".count($Fields)."<span style='display:block'>--$sql</span></p>";
        if ($type == 'list')
            return $Fields;
        else
            return count($Fields);
    }

    /*    public function actionNodalPerformanceList($status=null, $startDate=null, $endDate=null, $nextRoleID=null, $extraInMainStatus=null ,$type=null,$case=null) { */

    public function actionNodalPerformanceList($whattoshow = null, $startdate = null, $enddate = null) {

        if ($whattoshow == "fydas") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "fysas") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "fydas_both") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "fyd_app_rev") {

            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fys_app_rev") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fyboth_app_rev") {

            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        if ($whattoshow == "fydPfor_response") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
//print_r($result);			die;
        }
        if ($whattoshow == "fysPfor_response") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
        }
        if ($whattoshow == "fybothPfor_response") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "fysresponse_rec_app") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, 0, 'list');
        }

        if ($whattoshow == "fydapp_forw_dep") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'", 'list');
        }
        if ($whattoshow == "fysapp_forw_dep") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'", 'list');
        }
        if ($whattoshow == "fybothapp_forw_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'", 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "fyd_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fys_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');

            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fyboth_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');

            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "fysapp_forw_dep") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'", 'list');
        }
        if ($whattoshow == "fydunder_proc") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "fysunder_proc") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "fybothunder_proc") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "fydapp_apro_emp_com") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null, 'list');
        }
        if ($whattoshow == "fysapp_apro_emp_com") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null, 'list');
        }
        if ($whattoshow == "fybothapp_apro_emp_com") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fydapp_disposed") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fysapp_disposed") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fybothapp_disposed") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "fydapp_disposed_appr") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
        }
        if ($whattoshow == "fysapp_disposed_appr") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
        }
        if ($whattoshow == "fybothapp_disposed_appr") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "fydapp_disposed_rej") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
        }
        if ($whattoshow == "fysapp_disposed_rej") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
        }
        if ($whattoshow == "fybothapp_disposed_rej") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fyd_pend_dic") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "fys_pend_dic") {
            /* $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list'); */
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "fyboth_pend_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "fyd_res_rec_from_app") {
            //$subID=array();			
            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "fys_res_rec_from_app") {

            $result = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "fyboth_res_rec_from_app") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        //Carray forwarded application submitted
        if ($whattoshow == "cfd_app_sub") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "cfs_app_sub") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "cfboth_app_sub") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        //Carray forwarded Applications Reverted
        if ($whattoshow == "cfd_app_reverted") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "cfs_app_reverted") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "cfboth_app_reverted") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        //carry forwarded 2.1 : Responses received from Applicant for Query
        if ($whattoshow == "cfd_res_rec_app_for_q") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "cfs_res_rec_app_for_q") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
        }

        if ($whattoshow == "cfboth_res_rec_app_for_q") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        //carry forwarded 2.2 : Pending for response
        if ($whattoshow == "cfd_pen_res") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
        }
        if ($whattoshow == "cfs_pen_res") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
        }

        if ($whattoshow == "cfboth_pen_res") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }

        //carry forwarded 3 : Applications Forwarded to Department
        if ($whattoshow == "cfd_app_for_dep") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'", 'list');
        }
        if ($whattoshow == "cfs_app_for_dep") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'", 'list');
        }

        if ($whattoshow == "cfboth_app_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'", 'list');
            $result = array_merge($result1, $result2);
        }

        //carry forwarded 4 : Application Not forwarded to Department
        if ($whattoshow == "cfd_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "cfs_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');

            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "cfboth_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        //carry forwarded 4.1 : Under process at DIC/ DoI
        if ($whattoshow == "cfd_under_proc_dic") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "cfs_under_proc_dic") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
        }

        if ($whattoshow == "cfboth_under_proc_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        //carry forwarded 4.2 : Pending at DIC/ DoI
        if ($whattoshow == "cfd_pend_dic") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
        }
        if ($whattoshow == "cfs_pend_dic") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
        }
        if ($whattoshow == "cfboth_pend_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        //carry forwarded 5 : Applications Approved for Empowered Committee

        if ($whattoshow == "cfd_app_appr_emp_comm") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, "'F'", 'list');
        }
        if ($whattoshow == "cfs_app_appr_emp_comm") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, "'F'", 'list');
        }

        if ($whattoshow == "cfboth_app_appr_emp_comm") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, "'F'", 'list');
            $result = array_merge($result1, $result2);
        }

        //carry forwarded 6 : Applications Disposed		
        if ($whattoshow == "cfd_app_disposed") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
        }
        if ($whattoshow == "cfs_app_disposed") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
        }
        if ($whattoshow == "cfboth_app_disposed") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result = array_merge($result1, $result2);
        }
        //carry forwarded 6.1 : Applications Disposed (Approved ) 
        if ($whattoshow == "cfd_app_disposed_appr") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
        }
        if ($whattoshow == "cfs_app_disposed_appr") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
        }
        if ($whattoshow == "cfboth_app_disposed_appr") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result = array_merge($result1, $result2);
        }
        //carry forwarded 6.2 : Applications Disposed (Rejected)
        if ($whattoshow == "cfd_app_disposed_rej") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
        }
        if ($whattoshow == "cfs_app_disposed_rej") {
            $result = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
        }
        if ($whattoshow == "cfboth_app_disposed_rej") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }

        //both application submitted
        if ($whattoshow == "bothd_app_sub") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_app_sub") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_app_sub") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        //both 2: Applications Reverted		
        if ($whattoshow == "bothd_app_rev") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');

            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "boths_app_rev") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "both2_app_rev") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');

            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');

            $result5 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result6 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result7 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result8 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4, $result5, $result6, $result7, $result8);
        }

        //both 2.1 : Responses received from Applicant for Query		
        if ($whattoshow == "bothd_res_rec_app") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_res_rec_app") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_res_rec_app") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        //both 2.2 : Pending for response
        if ($whattoshow == "bothd_pen_res") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_pen_res") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_pen_res") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        // Both 3 : Applications Forwarded to Department
        if ($whattoshow == "bothd_app_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_app_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_app_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        // Both 4 : Application Not forwarded to Department
        if ($whattoshow == "both2d_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "both2s_app_not_for_dep") {

            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        if ($whattoshow == "both2_app_not_for_dep") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result5 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result6 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result7 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result8 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4, $result5, $result6, $result7, $result8);
        }
        // Both 4.1 : Under process at DIC/ DoI
        if ($whattoshow == "bothd_under_pro_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_under_pro_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_under_pro_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        // Both 4.2 : Pending at DIC/ DoI		
        if ($whattoshow == "both2d_pend_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2s_pend_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_pend_dic") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        //both 5 : Applications Approved for Empowered Committee 
        if ($whattoshow == "bothd_app_appr_emp_comm") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_app_appr_emp_comm") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, null, 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_app_appr_emp_comm") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null, 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, null, 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null, 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, null, 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }

        //both 6 : Applications Disposed		
        if ($whattoshow == "bothd_app_dis") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "boths_app_dis") {

            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        if ($whattoshow == "both2_app_dis") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
            $result5 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result6 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result7 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result8 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4, $result5, $result6, $result7, $result8);
        }
        //both 6.1 : Applications Disposed (Approved )
        if ($whattoshow == "bothd_app_dis_appr") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_app_dis_appr") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "both2_app_dis_appr") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }
        //both 6.2 : Applications Disposed (Rejected )		
        if ($whattoshow == "bothd_app_dis_rej") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }
        if ($whattoshow == "boths_app_dis_rej") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2);
        }

        if ($whattoshow == "both2_app_dis_rej") {
            $result1 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'", 'list');
            $result2 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'", 'list');
            $result3 = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'", 'list');
            $result4 = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'", 'list');
            $result = array_merge($result1, $result2, $result3, $result4);
        }



        $this->render('nodalPerformanceList', array('applicationData' => $result));
    }

    /*
     * @authour : Rahul Kumar
     * @date: 16052018
     * @Description : Nodal Performance Report Carry Forworded
     */

    static function getNodalPerformenceReportCountOfStatusCarryForward($status = null, $startDate = null, $endDate = null, $nextRoleID = null, $extraInMainStatus = null, $type = null) {

        extract($_GET);
        $sql2 = "select bo_application_flow_logs.submission_id from bo_application_flow_logs where bo_application_flow_logs.application_status IN ('ISA')
                    AND DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND DATE(bo_application_flow_logs.created_date_time)<='$endDate'";

        $extraCondition = "";
        $statusCondition = "";
        $verificationLevelCondition = "";
        // Applications Approved for Empowered Committee
        if ($nextRoleID == 33 || $nextRoleID == 34) {
            $verificationLevelCondition = " AND bo_application_verification_level.approv_status='P' ";
        }
        //  For Checking Status In main table
        if (!empty($extraInMainStatus)) {
            $extraCondition = " bo_application_submission.application_status IN ($extraInMainStatus) AND";
        }
        //For Passed Condition
        if ($status != "''") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND ";
        }
        // Under Process
        if ($status == "'UNDER_PROCESSEED'" || $status == "'PENDING'") {
            if ($status == "'UNDER_PROCESSEED'") {
                $st = "<=1";
            }
            if ($status == "'PENDING'") {
                $st = ">1";
            }
            $statusCondition = " bo_application_submission.application_status IN ('P') AND "
                    . "    DATEDIFF(NOW(),DATE_FORMAT(bo_application_submission.application_created_date,'%Y-%m-%d'))$st  AND
              ";
        }
        $revert = "";
        /*  if($status=='IBD'){
          $revert=" AND bo_application_submission.application_status!='H' ";
          } */


        // For Passed Condition
        if ($status == "'IBD'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_submission.submission_id from bo_application_submission where application_status IN('H')) AND ";
        }

        if ($status == "'ISA'" && $extraInMainStatus == "'F'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_verification_level.app_Sub_id from bo_application_verification_level Where bo_application_verification_level.next_role_id IN ('33','34') ) AND ";
        }

        $sql = "select * from bo_application_flow_logs "
                . " LEFT JOIN bo_application_submission ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id "
                . " LEFT JOIN bo_application_verification_level ON bo_application_flow_logs.submission_id=bo_application_verification_level.app_Sub_id "
                . "where $statusCondition $extraCondition "
                . " DATE(bo_application_flow_logs.created_date_time)>='$startDate' AND bo_application_submission.application_id=1   AND bo_application_submission.user_id!=11 "
                . "AND DATE(bo_application_flow_logs.created_date_time)<='$endDate' "
                . "AND bo_application_verification_level.next_role_id=$nextRoleID $verificationLevelCondition"
                . " AND bo_application_flow_logs.submission_id NOT IN ($sql2) "
                . "group by bo_application_flow_logs.submission_id ";

        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        if ($type == 'list')
            return $Fields;
        else
            return count($Fields);
    }
	public function dataSenetize ($param) {

                             return addslashes(htmlentities(trim($param)));

              }
	public function actionFbNodalPendingApplication()
	{
		$this->render('form_builder_verifier');
	}
	
        
         public function actionAbeyanceListing() {
         $this->render('abeyance_listing');
        }
		public function actionManageuserservices(){
			$this->render('manage_user_services');
		}
	public function actionGetUserServices(){
		$uid=$_POST['user_id'];
		$response=array();
		if($uid!=""){
			 $sql = "select * from tbl_user_service_role where user_id='".$uid."' and is_active='Y'";
				
			$res = Yii::app()->db->createCommand($sql)->queryAll();
			$roles=array();
				$services=array();
				
			if(count($res)>0){
				
				foreach($res as $value){
					
					$services[]=$value['service_id'];
					$roles[]=$value['role_id'];
				}
				
			}
			$response['service']=$services;
			$response['role']=$roles;
			echo json_encode($response);
			die();
			
		}
		
	}	
	public function actionAssignServiceRole()
	{
		//$model=new UserServiceRole;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['assign_role']))
		{
			
			 $sql = "UPDATE tbl_user_service_role SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' where user_id='".$_POST['user_id']."' and is_active='Y'";
			 $command=Yii::app()->db->createCommand($sql);
			$command->execute();
			 if(count($_POST['service_id'])>0 && count($_POST['role']>0)){
				 for($r=0;$r<count($_POST['role']);$r++){
				 $role=$_POST['role'][$r];
				 foreach($_POST['service_id'] as $ser){
					  $sql_insert="INSERT INTO tbl_user_service_role (user_id, service_id,role_id,is_active,created_on,updated_on)
VALUES('". $_POST['user_id'] ."','".$ser."','".$role."','Y','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
				 }
				 }
				 Yii::app()->user->setFlash('Success', "Success: Service assigned to user succesfully.");
         					 $this->redirect(array('/admin/default/manageuserservices'));
         					  exit;
			 }
			 else{
				  Yii::app()->user->setFlash('Error', "Error: Please select atleast one services and role.");
         					 $this->redirect(array('/admin/default/manageuserservices'));
         					  exit;
			 
			 }
			 
		
		}

	}
	
	public function actionRolesList(){
		
		$this->render('roles_list');
	}
	public function actionAddrole(){
		if(isset($_POST['role_name']) )
		{
			if(!empty(trim($_POST['role_name'])) && !empty(trim($_POST['role_desc']))){
				//check for duplicate
				$sql = "select * from bo_roles where role_name='".trim($_POST['role_name'])."'";
				$res = Yii::app()->db->createCommand($sql)->queryRow();
				if($res['role_id']==""){
				$sql_insert="INSERT INTO bo_roles (role_name, rele_desc,is_role_active,is_external)
	VALUES('".$this->dataSenetize($_POST['role_name'])."','".$this->dataSenetize($_POST['role_desc'])."','Y','".$_POST['is_external']."')";
				$command=Yii::app()->db->createCommand($sql_insert);
				$command->execute();
				 Yii::app()->user->setFlash('Success', "Success: Role added succesfully.");
								 $this->redirect(array('/admin/default/rolesList'));
								  exit;
				}
				else{
					Yii::app()->user->setFlash('Error', "Error: Role already exists.");
								 $this->redirect(array('/admin/default/rolesList'));
								  exit;
				}
			}
			else{
				Yii::app()->user->setFlash('Error', "Error: Role name and Role description is required.");
								 $this->redirect(array('/admin/default/rolesList'));
								  exit;
			}
		}
	}
		public function actionUpdaterole(){
		
			if(isset($_REQUEST['role_name']) && isset($_REQUEST['id']))
			{
				if(!empty(trim($_POST['role_name'])) && !empty(trim($_POST['role_desc']))){
					$sql = "select role_id from bo_roles where role_name='".$this->dataSenetize($_REQUEST['role_name'])."' and role_id<>'".$this->dataSenetize($_REQUEST['id'])."'";
					$res = Yii::app()->db->createCommand($sql)->queryRow();
					if($res['role_id']!=""){
						Yii::app()->user->setFlash('Error', "Error: Role already exists.");
									 $this->redirect(array('/admin/default/editrole/?id='.$res['role_id']));
									  exit;
					}
					else{
						$sql="UPDATE bo_roles SET role_name='".$this->dataSenetize($_POST['role_name'])."', rele_desc='".$this->dataSenetize($_POST['role_desc'])."',is_external='".$_POST['is_external']."' WHERE role_id='".$_REQUEST['id']."'";
					$command=Yii::app()->db->createCommand($sql);
					$command->execute();
					 Yii::app()->user->setFlash('Success', "Success: Role updated succesfully.");
									 $this->redirect(array('/admin/default/rolesList'));
									  exit;
					}
				}
				else{
					Yii::app()->user->setFlash('Error', "Error: Role name and Role description is required.");
								 $this->redirect(array('/admin/default/rolesList'));
								  exit;
				}
			}
			else{
				Yii::app()->user->setFlash('Error', "Error: Role Name and Role Id should not be empty.");
								 $this->redirect(array('/admin/default/editrole/?id='.$_REQUEST['id']));
								  exit;
			}
		
	}
	public function actionUserslist(){
		 

		$this->render('users_list');
	}
	public function actionEmailExist(){
		
		if(isset($_REQUEST['email']))
		{
			$sql = "select uid from bo_user where email='".$this->dataSenetize($_REQUEST['email'])."'";
			$res = Yii::app()->db->createCommand($sql)->queryRow();
			if($res['uid']!=""){
				echo "dup";
			}
			else{
				echo "";
			}
		}
		
		die();
	}
	public function actionMobileExists(){

		if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!="")
		{
			$sql = "select uid from bo_user where mobile='".$this->dataSenetize($_REQUEST['mobile'])."'";
			$res = Yii::app()->db->createCommand($sql)->queryRow();
			if($res['uid']!=""){
				echo "dup";
			}
			else{
				echo "";
			}
		}
		
		die();
	}
	
	public function actionAddUser(){
		
		if(isset($_POST['email'])){
		$pass = hash_hmac('sha1', trim($_POST['password']), PASSWORD_SECRET_KEY);
		$sql_insert="INSERT INTO bo_user (full_name, middle_name,last_name,email,email_alert,fax,delegate_officer_number,delegate_officer_name,delegate_officer_email,office_no,mobile,password,created_datetime,dept_id,disctrict_id,np_user_id,is_for_testing,is_active,system_user)
VALUES('".$this->dataSenetize($_POST['full_name'])."','".$this->dataSenetize($_POST['middle_name'])."','".$this->dataSenetize($_POST['last_name'])."','".$this->dataSenetize($_POST['email'])."','".$this->dataSenetize($_POST['email'])."','".$this->dataSenetize($_POST['fax'])."','".$this->dataSenetize($_POST['delegate_officer_number'])."','".$this->dataSenetize($_POST['delegate_officer_name'])."','".$this->dataSenetize($_POST['delegate_officer_email'])."','".$this->dataSenetize($_POST['office_no'])."','".$this->dataSenetize($_POST['mobile'])."','".$pass."','".date('Y-m-d H:i:s')."','1','','','N','".$_POST['is_active']."','N')";
$command=Yii::app()->db->createCommand($sql_insert);
	$command->execute();
$id = Yii::app()->db->getLastInsertID();
		
	$sql_insert_log="INSERT INTO bo_user_logs (edited_by, action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','create_user','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$id."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log);
		
			$command->execute();	
			$name=trim($_POST['full_name']);
			if(trim($_POST['middle_name'])!="")
				$name.=" ".trim($_POST['middle_name']);
				$name.=" ".trim($_POST['last_name']);
			   //$name = '=?UTF-8?B?' . base64_encode($name) . '?=';
			   
			   $email=trim($_POST['email']);
			 
			    $subject = "Your account created on CAIPO";
				$admin_email=Yii::app()->params['adminEmail'];
                
						$login_url=$this->createAbsoluteUrl('/sso/account/signin'); 
				$body="Dear ".$name.",<br/><br/>

This is to notify you that your account has been successfully created on the CAIPO Portal. Please use this link <a href='".$login_url."'>".$login_url."</a> to login. Your login details are as under: <br/>

1. Login ID: ".$email."<br/>
2. Password: ".trim($_POST['password'])."<br/><br/>

Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
<br/><br/>
Regards,<br/>
CAIPO";

			/*Yii::import('application.extensions.phpmailer.JPhpMailer');
			$mail = new JPhpMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->SMTPDebug  = 1;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "smtp.gmail.com";
			$mail->Username = 'caipodummy@gmail.com';
			$mail->Password = 'caipo@123';

			$mail->IsHTML(true);
			$mail->AddAddress($email, $name);
			
					
			$mail->SetFrom('support@caipo.com', 'Support CAIPO User');
			$mail->Subject = $subject;
			
			$mail->MsgHTML($body); 
			$mail->Send();*/
			
			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$email,'content'=>$body,'email_name'=>EMAIL_NAME);                
         DefaultUtility::post_to_url(EMAIL_API,$post_data); 

  /// send email to admin           
                $subject = "CAIPO: New user account created";
             
				$body="Dear Admin,<br/><br/>

				This is to notify you that you have successfully created the account of ".$name." on the CAIPO Portal.<br/><br/> 

				Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br/><br/> 

				Regards,<br/>
				CAIPO";
				
				$name="CAIPO Admin";
				$adminemail="support@caipo.com";
				
				/*$mail2 = new JPhpMailer();
			$mail2->IsSMTP();
			$mail2->Mailer = "smtp";
			$mail2->SMTPDebug  = 1;  
			$mail2->SMTPAuth   = TRUE;
			$mail2->SMTPSecure = "tls";
			$mail2->Port       = 587;
			$mail2->Host       = "smtp.gmail.com";
			$mail2->Username = 'caipodummy@gmail.com';
			$mail2->Password = 'caipo@123';

			$mail2->IsHTML(true);
			$mail2->AddAddress($adminemail, $name);
			
					
			$mail2->SetFrom('support@caipo.com', 'Support CAIPO User');
			$mail2->Subject = $subject;
			
			$mail2->MsgHTML($body); 
			$mail2->Send();*/
			
			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$adminemail,'content'=>$body,'email_name'=>EMAIL_NAME);                
         DefaultUtility::post_to_url(EMAIL_API,$post_data); 
				
			 Yii::app()->user->setFlash('Success', "Success: User added succesfully.");
         					 $this->redirect(array('/admin/default/userslist'));
         					  exit;
		}
	}
	public function actionAssignUserRole(){

			$this->render('assign_user_role');	
	}
	public function actionUpdatepwd(){
		if($_POST['uid']!="" && trim($_POST['password'])!=""){
			$pass = hash_hmac('sha1', trim($_POST['password']), PASSWORD_SECRET_KEY);
			$sql="UPDATE bo_user SET password='".$pass."' WHERE uid='".$_REQUEST['uid']."'";
				$command=Yii::app()->db->createCommand($sql);
				$command->execute();
				$sql_insert_log="INSERT INTO bo_user_logs (edited_by, action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','password_update','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$_POST['uid']."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log);
		$command->execute();	
		
		//////////////// send email to user
			$sql1="SELECT * from bo_user where bo_user.uid='".$_REQUEST['uid']."'";
			$connection=Yii::app()->db; 
			$command1=$connection->createCommand($sql1);
			$res = $command1->queryRow();
			$name=$res['full_name'];
				if(trim($res['middle_name'])!="")
					$name.=" ".$res['middle_name'];
			$name.=" ".$res['last_name'];
			   //$name = '=?UTF-8?B?' . base64_encode($name) . '?=';
			   
			$email=$res['email'];
	
			   $subject = "Your password updated on CAIPO";
				//$admin_email=Yii::app()->params['adminEmail'];
                
				$login_url=$this->createAbsoluteUrl('/sso/account/signin'); 
				$body="Dear ".$name.",<br/><br/>
This is to notify you that your Password has been successfully updated on the CAIPO Portal. Please use this 
 <a href='".$login_url."'>Link</a> to login. Your login details are as under: <br/>

1. Login ID: ".$email."<br/>
2. Updated Password: ".trim($_POST['password'])."<br/><br/>

Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. 
<br/><br/>
Regards,<br/>
CAIPO";


			/*Yii::import('application.extensions.phpmailer.JPhpMailer');
			$mail = new JPhpMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->SMTPDebug  = 1;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "smtp.gmail.com";
			$mail->Username = 'caipodummy@gmail.com';
			$mail->Password = 'caipo@123';

			$mail->IsHTML(true);
			$mail->AddAddress($email, $name);
			
					
			$mail->SetFrom('support@caipo.com', 'Support CAIPO User');
			$mail->Subject = $subject;
			
			$mail->MsgHTML($body); 
			$mail->Send();*/
			
			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$email,'content'=>$body,'email_name'=>EMAIL_NAME);                
         DefaultUtility::post_to_url(EMAIL_API,$post_data);    
        
			
	/// send email to admin
		$subject = "CAIPO: user password updated";
             
				$body="Dear Admin,<br/><br/>
				
				This is to notify you that you have successfully updated the Password of ".$name." on the CAIPO Portal.<br/><br/> 

				Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br/><br/> 

				Regards,<br/>
				CAIPO";
				
				$name="CAIPO Admin";
				$adminemail="support@caipo.com";
				

				/*$mail2 = new JPhpMailer();
			$mail2->IsSMTP();
			$mail2->Mailer = "smtp";
			$mail2->SMTPDebug  = 1;  
			$mail2->SMTPAuth   = TRUE;
			$mail2->SMTPSecure = "tls";
			$mail2->Port       = 587;
			$mail2->Host       = "smtp.gmail.com";
			$mail2->Username = 'caipodummy@gmail.com';
			$mail2->Password = 'caipo@123';

			$mail2->IsHTML(true);
			$mail2->AddAddress($adminemail, $name);
			
					
			$mail2->SetFrom('support@caipo.com', 'Support CAIPO User');
			$mail2->Subject = $subject;
			
			$mail2->MsgHTML($body); 
			$mail2->Send();*/
			$post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD,
                           'subject'=>$subject,'to'=>$adminemail,'content'=>$body,'email_name'=>EMAIL_NAME);                
         DefaultUtility::post_to_url(EMAIL_API,$post_data);  
			
				 Yii::app()->user->setFlash('Success', "Success: User password updated succesfully.");
								 $this->redirect(array('/admin/default/userslist'));
								  exit;
		}
		else{
			 Yii::app()->user->setFlash('Error', "Password should not be empty.");
         					 $this->redirect(array('/admin/default/edituser?uid='.base64_encode($_POST['uid'])));
         					  exit;
		}
	}
	

	public function actionSaveUserrole(){
		
		if(isset($_POST['assign_role']))
		{
			
			 if($_POST['user_id']!="" && isset($_POST['role_id'])){
				 
				 $sql = "SELECT * from bo_user_role_mapping Where user_id='".$_POST['user_id']."' and is_mapping_active='Y'";
				 $command=Yii::app()->db->createCommand($sql);
			  $res = $command->queryAll();
			  $existRole=array();
			  $del_rol=array();
			  if(count($res)>0){
				  for($j=0;$j<count($res);$j++){
					  if(!in_array($res[$j]['role_id'],$_POST['role_id'])){
						  $del_rol[]=$res[$j]['role_id'];
						   $sql = "UPDATE bo_user_role_mapping SET is_mapping_active='N', modified_time='".date('Y-m-d H:i:s')."' where user_id='".$_POST['user_id']."' and role_id='".$res[$j]['role_id']."' and is_mapping_active='Y'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
					  }
					  else{
						  $existRole[]=$res[$j]['role_id'];
					  }
				  }
			  }
				 
			$newRole=array();
				 
				 foreach($_POST['role_id'] as $rol){
					 if(!in_array($rol,$existRole)){
						 $newRole[]=$rol;
					  $sql_insert="INSERT INTO bo_user_role_mapping (user_id, role_id,department_id, lr_id, sso_dept, created_time, modified_time, is_mapping_active)
VALUES('". $_POST['user_id'] ."','".$rol."','1','829','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','Y')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
					 }
				 }
				 if(count($del_rol)>0 || count($newRole)>0){
					 $sql_insert_log="INSERT INTO bo_user_logs (edited_by,action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','role_update','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$_POST['user_id']."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log);
		
			$command->execute();
				 }
				 Yii::app()->user->setFlash('Success', "Success: Roles assigned to user succesfully.");
         					 $this->redirect(array('/admin/default/assignUserRole'));
         					  exit;
			 }
			 else{
				 Yii::app()->user->setFlash('Error', "Error: Please select user and at least one role.");
         					 $this->redirect(array('/admin/default/assignUserRole'));
         					  exit;
			 }
			 
		
		}
	}
	public function actionGetUserRoles(){
		$uid=$_POST['user_id'];
		$response=array();
		if($uid!=""){
			 $sql = "select role_id from bo_user_role_mapping where user_id='".$uid."' and is_mapping_active='Y'";
				
			$res = Yii::app()->db->createCommand($sql)->queryAll();
			if(count($res)>0){
				
				$roles=array();
				foreach($res as $value){
					$roles[]=$value['role_id'];
				}
				$response['roles']=$roles;
			}
			
		}
		echo json_encode($response);
			die();
	}
	public function actionManagePrivileges(){

			$this->render('manage_user_privileges');	
	}
	
	public function actionSaveUserprivileges(){
		
		if(isset($_POST['manage_access']))
		{
				
			$modules1=array();
			if(isset($_POST['module_id'])){
				$modules1=$_POST['module_id'];
			}
			else {
				$modules1=array();
			}
			if(isset($_POST['privi_type']) && ($_POST['user_id']!="" || $_POST['role_id']!="")){
			if($_POST['user_id']!=""){
				/*$add="N";
				$edit="N";
				$delete="N";
				if(isset($_REQUEST['action'])){
					if(in_array("add",$_REQUEST['action'])){
								$add="Y";
							}
							else{
								$add="N";
							}
							if(in_array("edit",$_REQUEST['action'])){
								$edit="Y";
							}
							else{
								$edit="N";
							}
							if(in_array("delete",$_REQUEST['action'])){
								$delete="Y";
							}
							else{
								$delete="N";
							}
				}*/
				 $sql = "SELECT * from bo_user_privileges Where is_active='Y' and user_id='".$_POST['user_id']."' ";
				
					$command=Yii::app()->db->createCommand($sql);
				    $prev_rec = $command->queryAll();
						 $exist=array();
					 $del=array();
					if(count($prev_rec)>0){
						foreach($prev_rec as $rec){
							if(!in_array($rec['module_id'],$modules1)){
								//delete
								$del[]=$rec['module_id'];
								  $sql = "UPDATE bo_user_privileges SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' Where is_active='Y' and user_id='".$_POST['user_id']."' and module_id='".$rec['module_id']."'";
								
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
							}
							else{
								$exist[]=$rec['module_id'];
							}
						}
					}
				
					if(count($modules1)>0){
						
						for($i=0;$i<count($modules1);$i++){
							
							if(!in_array($modules1[$i],$exist)){
								
								//insert
								 $sql_insert="INSERT INTO bo_user_privileges (module_id,user_id,role_id,created_date,updated_on,is_active)
		VALUES('".$modules1[$i]."','".$_POST['user_id']."','','".date('Y-m-d H:i:s')."' ,'".date('Y-m-d H:i:s')."','Y')";
	
				$command=Yii::app()->db->createCommand($sql_insert);
				
					$command->execute();
							
							
						}
						}
					}
					$modules=implode(",",$modules1);
						  $sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','assign_user_privileges','".$modules."','".$_POST['user_id']."','','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
	
				$command=Yii::app()->db->createCommand($sql_insert_log);
				$command->execute();
					Yii::app()->user->setFlash('Success', "Success: Privileges assigned to user succesfully.");
									 $this->redirect(array('/admin/default/managePrivileges'));
									  exit;
			}
			else if($_POST['role_id']!=""){
				/*$add="N";
				$edit="N";
				$delete="N";
				if(isset($_REQUEST['action'])){
				if(in_array("add",$_REQUEST['action'])){
								$add="Y";
							}
							else{
								$add="N";
							}
							if(in_array("edit",$_REQUEST['action'])){
								$edit="Y";
							}
							else{
								$edit="N";
							}
							if(in_array("delete",$_REQUEST['action'])){
								$delete="Y";
							}
							else{
								$delete="N";
							}
				}*/
				 $exist=array();
				 $sql = "SELECT * from bo_user_privileges Where is_active='Y' and role_id='".$_POST['role_id']."' ";
				  $command=Yii::app()->db->createCommand($sql);
				    $prev_rec = $command->queryAll();
						if(count($prev_rec)>0){
						foreach($prev_rec as $rec){
							if(!in_array($rec['module_id'],$modules1)){
								//delete
								$del[]=$rec['module_id'];
								 $sql = "UPDATE bo_user_privileges SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' Where is_active='Y' and role_id='".$_POST['role_id']."' and module_id='".$rec['module_id']."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
							}
							else{
								$exist[]=$rec['module_id'];
							}
						}
					}
					if(isset($modules1)){
							
						for($i=0;$i<count($modules1);$i++){
						
							if(!in_array($modules1[$i],$exist)){
								//update
								
								
								//insert
								 $sql_insert="INSERT INTO bo_user_privileges (module_id, user_id,role_id,created_date,updated_on,is_active)
		VALUES('".$modules1[$i]."','','".$_POST['role_id']."','".date('Y-m-d H:i:s')."' ,'".date('Y-m-d H:i:s')."','Y')";
				$command=Yii::app()->db->createCommand($sql_insert);
				
					$command->execute();
							}
							
						}	
						
						
					}
					$modules=implode(",",$_POST['module_id']);
						  $sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','assign_user_privileges','".$modules."','','".$_POST['role_id']."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
				$command=Yii::app()->db->createCommand($sql_insert_log);
				
				$command->execute();
				
					Yii::app()->user->setFlash('Success', "Success: Privileges assigned/unassigned to selected role succesfully.");
									 $this->redirect(array('/admin/default/managePrivileges'));
									  exit;
			}
			}
			else{
				Yii::app()->user->setFlash('Error', "Error: Please select a role or user.");
									 $this->redirect(array('/admin/default/managePrivileges'));
									  exit;
			}
				
		}
		
	}
	public function actionUserstatus(){
		
		if($_REQUEST['uid']!="" && $_REQUEST['status']!=""){
			if($_REQUEST['status']=="active" )
			{
				$status="1";
				$old_status=0;
			}
			else if($_REQUEST['status']=="deactive"){
				$status="0";
				$old_status=1;
			}
			 $sql = "UPDATE bo_user SET is_active='".$status."' Where uid='".$_REQUEST['uid']."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
						   $sql_insert_log="INSERT INTO bo_user_logs (edited_by, action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','change_user_status','".$old_status."','".$status."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$_REQUEST['uid']."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log);
		
			$command->execute();
				Yii::app()->user->setFlash('Success', "Success: User status updated succesfully.");
									 $this->redirect(array('/admin/default/userslist'));
									  exit;
		}
	}
	public function actionRolestatus(){
		
		if($_REQUEST['id']!="" && $_REQUEST['status']!=""){
			if($_REQUEST['status']=="active" )
			{
				$status="Y";
				$old_status='N';
			}
			else if($_REQUEST['status']=="deactive"){
				$status="N";
				$old_status='Y';
			}
			 $sql = "UPDATE bo_roles SET is_role_active='".$status."' Where role_id='".$_REQUEST['id']."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
						   
		
			$command->execute();
				Yii::app()->user->setFlash('Success', "Success: Role status updated succesfully.");
									 $this->redirect(array('/admin/default/rolesList'));
									  exit;
		}
	}
	public function actionGetUserPrivileges(){
		$response=array();
		if($_POST['id']!=""){
			if($_POST['type']=='user'){
			
			 $sql = "select * from bo_user_privileges where user_id='".$_POST['id']."' and is_active='Y'";
			}
		else if($_POST['type']=='role'){
			$sql = "select * from bo_user_privileges where role_id='".$_POST['id']."' and is_active='Y'";
		}		
			$res = Yii::app()->db->createCommand($sql)->queryAll();
			$modules=array();
				$action=array();
			if(count($res)>0){
				
				
				foreach($res as $value){
					$modules[]=$value['module_id'];
					//$action['add']=$value['add_action'];
					//$action['edit']=$value['edit_action'];
					//$action['delete']=$value['delete_action'];
				}
				
			}
			$response['modules']=$modules;
				//$response['action']=$action;
	}
		echo json_encode($response);
		die();
	}
		
	public function actionEdituser()
	{
        $uid = base64_decode($_REQUEST['uid']); 
		$sql1="SELECT * from bo_user where  bo_user.uid=$uid";
        $connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryRow();
		if($res){
			$this->render('edit_user',['res'=>$res]);
		}
		else{
		Yii::app()->user->setFlash('Error', "Error: Invalid User.");
			 $this->redirect(array('/admin/default/userslist'));
			  exit;
		}
		//$this->render('edit_user');
		
	}
	public function actionEditrole()
	{
		$sql1="SELECT 
	* from bo_roles 
		where  
		bo_roles.role_id='".$_REQUEST['id']."'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryRow();
		if(!empty($res['role_id'])){
			$this->render('edit_role');
		}
		else{
		Yii::app()->user->setFlash('Error', "Error: Invalid Role.");
									 $this->redirect(array('/admin/default/rolesList'));
									  exit;
		}
		//$this->render('edit_user');
		
	}
	public function actionEditemailExist(){
		
		if(isset($_REQUEST['email']))
		{
			$sql = "select uid from bo_user where email='".$this->dataSenetize($_REQUEST['email'])."' and uid<>'".$this->dataSenetize($_REQUEST['uid'])."'";
			$res = Yii::app()->db->createCommand($sql)->queryRow();
			if($res['uid']!=""){
				echo "dup";
			}
			else{
				echo "";
			}
		}
		
		die();
	}
	public function actionEditmobileExists(){

		if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!="")
		{
			$sql = "select uid from bo_user where mobile='".$this->dataSenetize($_REQUEST['mobile'])."' and uid<>'".$this->dataSenetize($_REQUEST['uid'])."'";
			$res = Yii::app()->db->createCommand($sql)->queryRow();
			if($res['uid']!=""){
				echo "dup";
			}
			else{
				echo "";
			}
		}
		
		die();
	}
	
	public function actionUpdateUser(){
		if(isset($_POST['email']) && $_POST['uid']!=""){
		//$pass = hash_hmac('sha1', $_POST['password'], PASSWORD_SECRET_KEY);
		$sql = "UPDATE bo_user SET full_name='".$this->dataSenetize($_POST['full_name'])."',middle_name='".$this->dataSenetize($_POST['middle_name'])."',last_name='".$this->dataSenetize($_POST['last_name'])."',email='".$this->dataSenetize($_POST['email'])."',email_alert='".$this->dataSenetize($_POST['email'])."',fax='".$this->dataSenetize($_POST['fax'])."',delegate_officer_number='".$this->dataSenetize($_POST['delegate_officer_number'])."',delegate_officer_name='".$this->dataSenetize($_POST['delegate_officer_name'])."',delegate_officer_email='".$this->dataSenetize($_POST['delegate_officer_email'])."',office_no='".$this->dataSenetize($_POST['office_no'])."',mobile='".$this->dataSenetize($_POST['mobile'])."',dept_id='1',np_user_id='',is_for_testing='N',is_active='".$_POST['is_active']."' Where uid='".$_POST['uid']."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
						  
		
	$sql_insert_log="INSERT INTO bo_user_logs (edited_by, action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','update_user','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$_POST['uid']."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log);
		
			$command->execute();	
			 Yii::app()->user->setFlash('Success', "Success: User updates succesfully.");
         					 $this->redirect(array('/admin/default/userslist'));
         					  exit;
		}
	}
	
	public function actionUsertransfer(){
		$this->render('user_transfer');	
	}
	
	public function actionSaveusertransfer(){
		if(!empty($_POST['user_id']) && !empty($_POST['new_user_id'])){
			
			
// user role transfered
/*$sql = "select role_id from bo_user_role_mapping where user_id='".$this->dataSenetize($_POST['user_id'])."' and is_mapping_active='Y'";
			$new_user_roles=array();
			$res = Yii::app()->db->createCommand($sql)->queryAll();*/
			$new_user_roles=array();
			$sql2 = "select role_id from bo_user_role_mapping where user_id='".$this->dataSenetize($_POST['new_user_id'])."' and is_mapping_active='Y'";	
			$new_roles_data = Yii::app()->db->createCommand($sql2)->queryAll();
			if(count($new_roles_data)>0){
				for($i=0;$i<count($new_roles_data);$i++){
					$new_user_roles[]=$new_roles_data[$i]['role_id'];
				}
			}
			$rol=array();
			if(isset($_POST['role_id'])){
				
				if(count($_POST['role_id'])>0){
					
					for($i=0;$i<count($_POST['role_id']);$i++){
						
						if(!in_array($_POST['role_id'][$i],$new_user_roles)){
							$rol[]=$_POST['role_id'][$i];
							 $sql_insert="INSERT INTO bo_user_role_mapping (user_id, role_id,department_id, lr_id, sso_dept, created_time, modified_time, is_mapping_active)
VALUES('". $this->dataSenetize($_POST['new_user_id']) ."','".$this->dataSenetize($_POST['role_id'][$i])."','1','829','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','Y')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
						}
						
						 $sql = "UPDATE bo_user_role_mapping SET is_mapping_active='N', modified_time='".date('Y-m-d H:i:s')."' where user_id='".$this->dataSenetize($_POST['user_id'])."' and role_id='".$_POST['role_id'][$i]."' and is_mapping_active='Y'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute(); 
				
		 
					}
					$sql_insert_log2="INSERT INTO bo_user_logs (edited_by,action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','role_transfered','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$this->dataSenetize($_POST['user_id'])."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log2);
		 $command->execute();  
					if(count($rol)>0){
					$sql_insert_log2="INSERT INTO bo_user_logs (edited_by,action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','role_assigned','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$this->dataSenetize($_POST['new_user_id'])."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log2);
		 $command->execute(); 
					}
		 
				}
			}
			/*if(count($res)>0){
				foreach($res as $row){
					// check if exists 
					if(!in_array($row['role_id'],$new_user_roles)){
					
					 $sql_insert="INSERT INTO bo_user_role_mapping (user_id, role_id,department_id, lr_id, sso_dept, created_time, modified_time, is_mapping_active)
VALUES('". $this->dataSenetize($_POST['new_user_id']) ."','".$this->dataSenetize($row['role_id'])."','1','829','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','Y')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
					}
				}
				$sql_insert_log2="INSERT INTO bo_user_logs (edited_by,action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','role_assigned','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$this->dataSenetize($_POST['new_user_id'])."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log2);
		 $command->execute(); 
				 $sql = "UPDATE bo_user_role_mapping SET is_mapping_active='N', modified_time='".date('Y-m-d H:i:s')."' where user_id='".$this->dataSenetize($_POST['user_id'])."' and is_mapping_active='Y'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute(); 
				$sql_insert_log2="INSERT INTO bo_user_logs (edited_by,action,before_edit,after_edit,remote_ip,user_agent,other_info,created_time)
VALUES('".$_SESSION['uid']."','role_transfered','','','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$this->dataSenetize($_POST['user_id'])."' ,'".date('Y-m-d H:i:s')."')";
		$command=Yii::app()->db->createCommand($sql_insert_log2);
		 $command->execute(); 
			}*/
			
			
			
			
			
			
			
			/// user privileges transferred
			/*$sql = "select * from bo_user_privileges where user_id='".$_POST['user_id']."' and is_active='Y'";
			$res = Yii::app()->db->createCommand($sql)->queryAll();*/
			$new_user_modules=array();
			$sql2 = "select module_id from bo_user_privileges where user_id='".$_POST['new_user_id']."' and is_active='Y'";	
			$new_modules_data = Yii::app()->db->createCommand($sql2)->queryAll();
			if(count($new_modules_data)>0){
				for($i=0;$i<count($new_modules_data);$i++){
					$new_user_modules[]=$new_modules_data[$i]['module_id'];
				}
			}
			
			$modules=array();
			if(isset($_POST['module_id'])){
				if(count($_POST['module_id'])>0){
					for($m=0;$m<count($_POST['module_id']);$m++){
						if(!in_array($_POST['module_id'][$m],$new_user_modules)){
							$modules[]=$_POST['module_id'][$m];
						  $sql_insert="INSERT INTO bo_user_privileges (module_id,user_id,role_id,created_date,updated_on,is_active)
		VALUES('".$this->dataSenetize($_POST['module_id'][$m])."','".$this->dataSenetize($_POST['new_user_id'])."','','".date('Y-m-d H:i:s')."' ,'".date('Y-m-d H:i:s')."','Y')";
				$command=Yii::app()->db->createCommand($sql_insert);
				
				$command->execute();
					}
					
					 $sql = "UPDATE bo_user_privileges SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' Where is_active='Y' and user_id='".$_POST['user_id']."' and module_id='".$_POST['module_id'][$m]."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute(); 
					}
					
					
				}
				$sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','user_privileges_removed','".implode(",",$_POST['module_id'])."','".$this->dataSenetize($_POST['user_id'])."','','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
				$command=Yii::app()->db->createCommand($sql_insert_log);
				
				$command->execute();
				
				if(count($modules)>0){
					$sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','assign_user_privileges','".implode(",",$modules)."','".$this->dataSenetize($_POST['new_user_id'])."','','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
				$command=Yii::app()->db->createCommand($sql_insert_log);
				
				$command->execute();
				}
				
			}
			/*if(count($res)>0){
				foreach($res as $row){
					
					$modules[]=$row['module_id'];
					
					if(!in_array($row['module_id'],$new_user_modules)){
						
						  $sql_insert="INSERT INTO bo_user_privileges (module_id,user_id,role_id,created_date,updated_on,is_active)
		VALUES('".$this->dataSenetize($row['module_id'])."','".$this->dataSenetize($_POST['new_user_id'])."','','".date('Y-m-d H:i:s')."' ,'".date('Y-m-d H:i:s')."','Y')";
				$command=Yii::app()->db->createCommand($sql_insert);
				
				$command->execute();
					}
				}
				$sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','assign_user_privileges','".implode(",",$modules)."','".$this->dataSenetize($_POST['new_user_id'])."','','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
				$command=Yii::app()->db->createCommand($sql_insert_log);
				
				$command->execute();
				 $sql = "UPDATE bo_user_privileges SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' Where is_active='Y' and user_id='".$_POST['user_id']."'";
						  $command=Yii::app()->db->createCommand($sql);
						  $command->execute();
				
				$sql_insert_log="INSERT INTO bo_user_privileges_logs (edited_by,action,module_id,user_id,role_id,created_time,remote_ip,user_agent)
		VALUES('".$_SESSION['uid']."','user_privileges_removed','','".$this->dataSenetize($_POST['user_id'])."','','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."' )";
				$command=Yii::app()->db->createCommand($sql_insert_log);
				
				$command->execute();
			}
			*/
			/// user service wise role transferred
			/*$sql = "select * from tbl_user_service_role where user_id='".$_POST['user_id']."' and is_active='Y'";
			
			$res = Yii::app()->db->createCommand($sql)->queryAll();*/
			$new_user_exist_services=array();
			$new_user_exist_roles=array();
			$sql2 = "select  service_id,role_id from tbl_user_service_role where user_id='".$_POST['new_user_id']."' and is_active='Y'";	
			$services_data = Yii::app()->db->createCommand($sql2)->queryAll();
			if(count($services_data)>0){
				for($i=0;$i<count($services_data);$i++){
					$new_user_exist_services[]=$services_data[$i]['service_id'];
					$new_user_exist_roles[]=$services_data[$i]['role_id'];
				}
				$new_user_exist_roles=array_unique($new_user_exist_roles);
				$new_user_exist_services=array_unique($new_user_exist_services);
			}
			$services=array();
			$roles=array();
			if(isset($_POST['service_id']) && isset($_POST['role'])){
				 if(count($_POST['service_id'])>0 && count($_POST['role']>0)){
					 $services = array_unique (array_merge ($_POST['service_id'], $new_user_exist_services));
					 $roles = array_unique (array_merge ($_POST['role'], $new_user_exist_roles));
				 }
			}
			$sql = "UPDATE tbl_user_service_role SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' where user_id='".$_POST['new_user_id']."' and is_active='Y'";
			 $command=Yii::app()->db->createCommand($sql);
			 
			 if(count($services)>0 && count($roles)>0){
				 for($r=0;$r<count($roles);$r++){
				 $role=$roles[$r];
				 foreach($services as $ser){
					  $sql_insert="INSERT INTO tbl_user_service_role (user_id, service_id,role_id,is_active,created_on,updated_on)
VALUES('". $_POST['new_user_id'] ."','".$ser."','".$role."','Y','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
				 }
				 }
				 
			 }
			 if(isset($_POST['service_id']) && isset($_POST['role'])){
				 if(count($_POST['service_id'])>0 && count($_POST['role'])>0){
				 for($r=0;$r<count($_POST['role']);$r++){
				 $role=$_POST['role'][$r];
				 foreach($_POST['service_id'] as $ser){
					   $sql = "UPDATE tbl_user_service_role SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' where user_id='".$_POST['user_id']."' and is_active='Y' and service_id='".$ser."' and role_id='".$_POST['role'][$r]."'";
					 $command=Yii::app()->db->createCommand($sql);
					$command->execute();
				 }
				 }
				 }
			 }
			 
			 
			
			/* $sql = "UPDATE tbl_user_service_role SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' where user_id='".$_POST['new_user_id']."' and is_active='Y'";
			 $command=Yii::app()->db->createCommand($sql);
			 $command->execute();
			 if(count($res)>0){
				 foreach($res as $row){
					 $sql_insert="INSERT INTO tbl_user_service_role (user_id, service_id,role_id,is_active,created_on,updated_on)
VALUES('".$this->dataSenetize($_POST['new_user_id']) ."','".$this->dataSenetize($row['service_id'])."','".$this->dataSenetize($row['role_id'])."','Y','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
			$command=Yii::app()->db->createCommand($sql_insert);
			$command->execute();
				 }
				 
			 }
			 
			 $sql = "UPDATE tbl_user_service_role SET is_active='N', updated_on='".date('Y-m-d H:i:s')."' where user_id='".$_POST['user_id']."' and is_active='Y'";
			 $command=Yii::app()->db->createCommand($sql);
			$command->execute();*/
			
			$sql_insert_log="INSERT INTO bo_user_transfer (edited_by, user_id,new_user_id, created_time, user_agent, remote_ip)
VALUES('".$_SESSION['uid']."','".$this->dataSenetize($_POST['user_id'])."','".$this->dataSenetize($_POST['new_user_id'])."','".date('Y-m-d H:i:s')."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."' )";
$command=Yii::app()->db->createCommand($sql_insert_log);
			$command->execute();
			
			 Yii::app()->user->setFlash('Success', "Success: User Transferred succesfully.");
         					 $this->redirect(array('/admin/default/usertransfer'));
         					  exit;
			
		}
		else{
			Yii::app()->user->setFlash('Error', "Please select user.");
									 $this->redirect(array('/admin/default/usertransfer'));
									  exit;
		}
	}
	
	public function actionUserdata(){
		if(isset($_REQUEST['uid'])){
			$uid=$_REQUEST['uid'];
			$sql1="SELECT 
			* from bo_user 
				where  
				bo_user.uid='".$_REQUEST['uid']."'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryRow();
		if($res['is_active']==1)
			$user_status='Active';
		else{
			$user_status='Deactive';
		}
		
		$sql = "select bo_user_role_mapping.role_id,bo_roles.role_name from bo_user_role_mapping left join bo_roles on bo_user_role_mapping.role_id=bo_roles.role_id where bo_user_role_mapping.user_id='".$uid."' and bo_user_role_mapping.is_mapping_active='Y' and bo_roles.is_role_active='Y'";
				
			$rres = Yii::app()->db->createCommand($sql)->queryAll();
			$roles=array();
			$roles_id=array();
			if(count($rres)>0){
				
				
				$roles=array();
				foreach($rres as $value){
					$roles[]=$value['role_name'];
					$roles_id[]=$value['role_id'];
				}
				
			}
if(count($roles)>0){
	$roles_data=implode('<br/>',array_unique($roles));
}
else{
	$roles_data='--';
}	
			$modules=array();
			 $sql = "select bo_user_privileges.module_id,bo_modules.module_name from bo_user_privileges left join bo_modules on bo_user_privileges.module_id=bo_modules.id where user_id='".$uid."' and bo_user_privileges.is_active='Y' and bo_modules.is_active='Y'";
			 $mres = Yii::app()->db->createCommand($sql)->queryAll();
			 if(count($mres)>0){
				
				
				foreach($mres as $value){
					$modules[]=$value['module_name'];
				}
				
			}
if(count($modules)>0){
	$modules_data=implode('<br/>',array_unique($modules));
}
else{
	$modules_data='--';
}
//array_unique($modules);
	$rmodules=array();
if(count($roles_id)>0){
		
				$sql = "select bo_user_privileges.module_id,bo_modules.module_name from bo_user_privileges left join bo_modules on bo_user_privileges.module_id=bo_modules.id where bo_user_privileges.role_id IN(".implode(',',$roles_id).") and bo_user_privileges.is_active='Y' and bo_modules.is_active='Y'";
				
			$rmres = Yii::app()->db->createCommand($sql)->queryAll();
			$rmodules=array();
				$action=array();
			if(count($rmres)>0){
				
				
				foreach($rmres as $value){
					$rmodules[]=$value['module_name'];
				}
				
			}
}
if(count($rmodules)>0){
	$rmodules_data=implode('<br/>',array_unique($rmodules));
}
else{
	$rmodules_data='--';
}

 $sql = "select tbl_user_service_role.role_id, tbl_user_service_role.service_id, bo_roles.role_name, bo_information_wizard_service_parameters.core_service_name  from tbl_user_service_role left join bo_information_wizard_service_parameters on bo_information_wizard_service_parameters.service_id=tbl_user_service_role.service_id left join bo_roles on  tbl_user_service_role.role_id=bo_roles.role_id  where tbl_user_service_role.user_id='".$uid."' and tbl_user_service_role.is_active='Y' and bo_information_wizard_service_parameters.is_active='Y'";
				
			$sres = Yii::app()->db->createCommand($sql)->queryAll();
			$sroles=array();
				$services=array();
				
			if(count($sres)>0){
				
				foreach($sres as $value){
					
					$services[]=$value['core_service_name'];
					$sroles[]=$value['role_name'];
				}
				
			}
			if(count($sroles)>0){
				$sroles_data=implode("<br/>",array_unique($sroles));
			}
			else{
				$sroles_data="--";
			}
			
			if(count($services)>0){
				$services_data=implode("<br/>",array_unique($services));
			}
			else{
				$services_data="--";
			}
			
			//array_unique($rmodules);
			$html='<div class="form-row row">
			

				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 First Name	</label>

					<div class="col-md-12">
					'.$res['full_name'].'
					</div>
				</div>
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Middle Name</label>

					<div class="col-md-12">
					'.$res['middle_name'].'
					</div>
				</div>
			
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Last Name	</label>

					<div class="col-md-12">
					'.$res['last_name'].'
					</div>
				</div>
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Email</label>

					<div class="col-md-12">
					'.$res['email'].'
					</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Mobile </label>

					<div class="col-md-12">
					';
					if(!empty($res['mobile']))
						$html.=$res['mobile'];
					else
						$html.='--';
					$html.='</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Fax </label>

					<div class="col-md-12">
					';
					if(!empty($res['fax']))
						$html.=$res['fax'];
					else
						$html.='--';
					$html.='
					</div>
				</div>
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Delegate Officer No	</label>

					<div class="col-md-12">';
					if(!empty($res['delegate_officer_number']))
						$html.=$res['delegate_officer_number'];
					else
						$html.='--';
					$html.='</div>
				</div>
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Delegate Officer Name	</label>

					<div class="col-md-12">';
					if(!empty($res['delegate_officer_name']))
						$html.=$res['delegate_officer_name'];
					else
						$html.='--';
					$html.='</div>
				</div>
					<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Delegate Officer Email	</label>

					<div class="col-md-12">';
					if(!empty($res['delegate_officer_email']))
						$html.=$res['delegate_officer_email'];
					else
						$html.='--';
					$html.='</div>
				</div>
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Office Number	</label>

					<div class="col-md-12">';
					if(!empty($res['office_no']))
						$html.=$res['office_no'];
					else
						$html.='--';
					$html.='</div>
				</div>
			

				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 User Status</label>

					<div class="col-md-12">
						'.$user_status.'
					</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Assigned Roles</label>

					<div class="col-md-12">
						'.$roles_data.'
					</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Assigned Modules to User</label>

					<div class="col-md-12">
						'.$modules_data.'
					</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Assigned Modules to assigned Roles</label>

					<div class="col-md-12">
						'.$rmodules_data.'
					</div>
				</div>
			
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Assigned As</label>

					<div class="col-md-12">
						'.$sroles_data.'
					</div>
				</div>
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left">
						 Assigned Services</label>

					<div class="col-md-12">
						'.$services_data.'
					</div>
				</div>
			

				
			
				
			</div>';
			echo $html;
			die();
		
		}
	}

    public function actionCategory(){

        $category= new ServiceCategory();

        if(isset($_POST['category_name']))
        {
            $category->category_name=$_POST['category_name'];
            $category->save();
            Yii::app()->user->setFlash('Success', "Success: Category Saved succesfully.");


        }
		$service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll();



        return $this->render('/category/category',array('service_category'=>$service_category));
    }

    public function actionSubcategory(){

        $service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll();
		$service_subcategory = Yii::app()->db->createCommand("SELECT * FROM sub_category_master where is_active=1")->queryAll();

        $category= new SubCategory();

        if(isset($_POST['subcategory']))
        {

            Yii::app()->db->createCommand("INSERT INTO sub_category_master (category_id, subcategory,asset_type) VALUES (".$_POST['category_id'].", '".$_POST['subcategory']."', '".$_POST['asset_type']."')")->execute();

            Yii::app()->user->setFlash('Success', "Success: Sub Category Saved succesfully.");
            return $this->redirect('subCategory');


        }
        return $this->render('/category/subcategory',array('data'=>[],'service_category'=>$service_category,'service_subcategory'=>$service_subcategory));
    }

     public function actionAssetregistration(){

        $service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll();
        $service_subcategory = Yii::app()->db->createCommand("SELECT * FROM sub_category_master where is_active=1")->queryAll();
		$service = Yii::app()->db->createCommand("SELECT * FROM bo_booking_sub_category_master where service_id=49.0")->queryAll();


        if(isset($_POST['category_id'])){
            Yii::app()->db->createCommand("INSERT INTO bo_booking_sub_category_master (service_id, state_code,district_code,block_code,village_panchayat_code,name_place,created_on,category_id,subcategory_id,acquisition_date,acquisition,venodor,pincode,longitude,latitude,custodian,measurement,asset_life,opening_balance,closing_balance,unpaid_amount,cwip_amount,remarks) VALUES ('49.0','9','118','803','124607','".$_POST['asset_name']."', '".date('Y-m-d H:i:s')."','".$_POST['category_id']."','".$_POST['subcategory_id']."','".$_POST['acquisition_date']."','".$_POST['acquisition']."','".$_POST['venodor']."','".$_POST['pincode']."','".$_POST['longitude']."','".$_POST['latitude']."','".$_POST['custodian']."','".$_POST['measurement']."','".$_POST['asset_life']."','".$_POST['opening_balance']."','".$_POST['closing_balance']."','".$_POST['unpaid_amount']."','".$_POST['cwip_amount']."','".$_POST['remarks']."')")->execute();   
        }


        return $this->render('/category/assetregistration',array('service'=>$service,'service_category'=>$service_category,'service_subcategory'=>$service_subcategory));
    }
     public function actionAssetfees(){

        $service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll();
        $service_subcategory = Yii::app()->db->createCommand("SELECT * FROM sub_category_master where is_active=1")->queryAll();
		$service = Yii::app()->db->createCommand("SELECT * FROM bo_booking_sub_category_master where service_id=51.0")->queryAll();


        if(isset($_POST['category_id'])){
            Yii::app()->db->createCommand("INSERT INTO bo_booking_sub_category_master (service_id, state_code,district_code,block_code,village_panchayat_code,name_place,created_on,category_id,subcategory_id,pincode,longitude,latitude,custodian,measurement,opening_balance,closing_balance,unpaid_amount,remarks) VALUES ('51.0','9','118','803','124607','".$_POST['asset_name']."', '".date('Y-m-d H:i:s')."','".$_POST['category_id']."','".$_POST['subcategory_id']."','".$_POST['pincode']."','".$_POST['longitude']."','".$_POST['latitude']."','".$_POST['custodian']."','".$_POST['measurement']."','".$_POST['opening_balance']."','".$_POST['closing_balance']."','".$_POST['unpaid_amount']."','".$_POST['remarks']."')")->execute();   
        }


        return $this->render('/category/fees',array('service'=>$service,'service_category'=>$service_category,'service_subcategory'=>$service_subcategory));
    }

     public function actionAssettax(){

        $service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll();
        $service_subcategory = Yii::app()->db->createCommand("SELECT * FROM sub_category_master where is_active=1")->queryAll();
		$service = Yii::app()->db->createCommand("SELECT * FROM bo_booking_sub_category_master where service_id=50.0")->queryAll();

        if(isset($_POST['category_id'])){
            Yii::app()->db->createCommand("INSERT INTO bo_booking_sub_category_master (service_id, state_code,district_code,block_code,village_panchayat_code,name_place,created_on,category_id,subcategory_id,pincode,longitude,latitude,measurement,opening_balance,closing_balance,unpaid_amount,remarks) VALUES 
			('50.0','9','118','803','124607','".$_POST['asset_name']."', '".date('Y-m-d H:i:s')."','".$_POST['category_id']."','".$_POST['subcategory_id']."','".$_POST['pincode']."','".$_POST['longitude']."','".$_POST['latitude']."','".$_POST['measurement']."','".$_POST['opening_balance']."','".$_POST['closing_balance']."','".$_POST['unpaid_amount']."','".$_POST['remarks']."')")->execute();   
        }


        return $this->render('/category/tax',array('service'=>$service,'service_category'=>$service_category,'service_subcategory'=>$service_subcategory));
    }
	

}