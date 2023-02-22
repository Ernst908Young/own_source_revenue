<?php

class Default1Controller extends Controller {

    public function actionIndex($page=0) {
        @session_start();
        // echo "<pre>";print_r($_SESSION);die;
        if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
            if(DefaultUtility::isSMSSender()){
                $this->redirect(array("/admin/sendSMS"));
                exit;
            }
            if(RolesExt::isAdminUser()){
                $this->render('adminDashboard');
                exit;
            }
			
            if(RolesExt::isSSOAdmin()){
                $roleInfo=RolesExt::getUserRoleViaId($_SESSION['uid']);
                $sso_id=$roleInfo['sso_dept'];
                // $ssoInfo=RolesExt::getSSOInfoFromID($sso_id);
                // $url=Yii::app()->createAbsoluteUrl('/mis/boApplicationSubmission/integratedappdetails/sso_id/'.$sso_id);
              //  $url=Yii::app()->createAbsoluteUrl('/mis/boApplicationSubmission/ServicesUnderswcsAct');
                  $url=Yii::app()->createAbsoluteUrl('/mis/integratedDepartmentServices');
                  $this->redirect($url);
                exit;
            }
			if(RolesExt::isDocumentVerifierUser()){
                $year='2016';
                if(isset($_GET['year']))
                    $year=$_GET['year'];
                $this->render('documentVerifierDashboard',array("selectedYear"=>$year));
                exit;
            }
			if(RolesExt::isDMUser()){
                $this->render('DmNewDashboard');
                exit;
            }
			
			
			/* Pankaj Kumar Tiwari   Date: 27Feb2018  */
			
			if(RolesExt::isHelpdeskUser()){
				
				$connection=Yii::app()->db;
				
				//echo "<pre>";print_r($_SESSION);die;
				$staff_id=TicketExt::getUserStaffId($_SESSION['email']);
				//$staff_id = $staff_id>0?$staff_id:9999;
				$dept_id=TicketExt::getUserDepartmentId($staff_id);
				//$dept_id = $dept_id>0?$dept_id:9999;
				$role_id=RolesExt::isHelpdeskUser();
				
				
				// Total Ticket
				$total_ticket=TicketExt::getTotalTickets($role_id, $staff_id, $dept_id);
				
				
				//Total Open Ticket
				$total_open_ticket=TicketExt::getTotalOpenTickets($role_id, $staff_id, $dept_id);
				
				
				//Total Closed Ticket
				$total_closed_ticket=TicketExt::getTotalClosedTickets($role_id, $staff_id, $dept_id);
				
				//Total Answered Ticket
				$total_answered_ticket=TicketExt::getTotalAnsweredTickets($role_id, $staff_id, $dept_id);
				
			    //Total Transfered Ticket
				$total_transfered_ticket=TicketExt::getTotalTransferedTickets($role_id, $staff_id);
				
				/* Get Tickets List */
				$all_tickets=TicketExt::getTickets($role_id, $staff_id, $page, $dept_id);
				
				$pages = new CPagination($total_ticket);
				
				$this->render('helpdeskDashboard',array(
					  'tickets' => $all_tickets,
					  'pages' => $pages,
					  'total_ticket'=>$total_ticket,
					  'total_open_ticket'=>$total_open_ticket,
					  'total_closed_ticket'=>$total_closed_ticket,
					  'total_answered_ticket'=>$total_answered_ticket,
					  'total_transfered_ticket'=>$total_transfered_ticket
				));
				
		        exit;
				
            }
			/********* END OF PANKANJ CODE *******/
			
            $this->render('index');
        }
        else{
            $model=new LoginForm;
            $this->redirect(array("/site/login"),$model);
        }
    }
	
	public function actionQuery($page=0) {
        @session_start();
        if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
            
			
			/* Pankaj Kumar Tiwari   Date: 27Feb2018  */
			
			if(RolesExt::isHelpdeskUser()){
				
				$connection=Yii::app()->db;
				
				$staff_id=QueryExt::getUserStaffId($_SESSION['email']);
				$dept_id=QueryExt::getUserDepartmentId($staff_id);
				$role_id=RolesExt::isHelpdeskUser();
				
				
				// Total Query
				$total_queries=QueryExt::getTotalQuery($role_id, $staff_id, $dept_id);
				
				
				//Total Open Query
				$total_open_queries=QueryExt::getTotalOpenQuery($role_id, $staff_id, $dept_id);
				
				
				//Total Closed Query
				$total_closed_queries=QueryExt::getTotalClosedQuery($role_id, $staff_id, $dept_id);
				
				//Total Answered Query
				$total_answered_query=QueryExt::getTotalAnsweredQuery($role_id, $staff_id, $dept_id);
				
				
			    //Total Transfered Query
				$total_transfered_queries=QueryExt::getTotalTransferedQuery($role_id, $staff_id);
				
				/* Get Query List */
				$all_queries=QueryExt::getAllQuery($role_id, $staff_id, $page, $dept_id);
				
				$pages = new CPagination($total_queries);
				
				$this->render('helpdeskQueryDashboard',array(
					  'queries' => $all_queries,
					  'pages' => $pages,
					  'total_queries'=>$total_queries,
					  'total_open_queries'=>$total_open_queries,
					  'total_closed_queries'=>$total_closed_queries,
					   'total_answered_queries'=>$total_answered_query,
					  'total_transfered_queries'=>$total_transfered_queries
				));
				
		    
				
            }else{
				
				$this->redirect(array("/admin/default/index"));
				
			}
			
        }else{
            $model=new LoginForm;
            $this->redirect(array("/site/login"),$model);
        }
    }
	
    public function actionApplicationview($app_sub_id){
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
    }*/

    /*
     * @authour : Rahul Kumar
     * @date: 16052018
     * @Description : Nodal Performance Report Current FY
     */

    public static function getNodalPerformenceReportCountOfStatusSelectedFY($status = null, $startDate = null, $endDate = null, $nextRoleID = null, $extraInMainStatus = null,$type=null) {
        
        extract($_GET);        
        $extraCondition = "";
        $statusCondition = "";
        $verificationLevelCondition = "";
        $flg=0;
        
         // Applications Approved for Empowered Committee
        if ($nextRoleID == 33 || $nextRoleID == 34) {
            $verificationLevelCondition = " AND bo_application_verification_level.approv_status='P' ";
        }
        //  For Checking Status In main table
        if (isset($extraInMainStatus) && !empty($extraInMainStatus) && ($extraInMainStatus!=null)) {
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
		
		 if ($status == "'ISA'" && $extraInMainStatus=="'F'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_verification_level.app_Sub_id from bo_application_verification_level Where bo_application_verification_level.next_role_id IN ('33','34') ) AND ";
        }
		
		
        // Under Process
        if ($status == "'UNDER_PROCESSEED'" || $status == "'PENDING'") {
            if($status == "'UNDER_PROCESSEED'"){$st="<=1";}
            if($status == "'PENDING'"){$st=">1";}
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
	  if($type=='list')
		return $Fields;
	  else	
        return count($Fields);
    }
    
 /*    public function actionNodalPerformanceList($status=null, $startDate=null, $endDate=null, $nextRoleID=null, $extraInMainStatus=null ,$type=null,$case=null) { */
	public function actionNodalPerformanceList($whattoshow=null,$startdate=null, $enddate=null) { 
	   
		if($whattoshow=="fydas"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7,null,'list');		
		}
		if($whattoshow=="fysas"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4,null,'list');			
		}
		if($whattoshow=="fydas_both"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7,null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4,null,'list');
			$result = array_merge($result1,$result2);		
		}
		
		if($whattoshow=="fyd_app_rev"){
		
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7,null,'list');			
			$result2 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result = array_merge($result1,$result2);	
		}
		if($whattoshow=="fys_app_rev"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4,null,'list');				
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2);		
		}
		if($whattoshow=="fyboth_app_rev"){
		
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7,null,'list');			
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');
			$result3 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4,null,'list');		
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);				
		}
		
		if($whattoshow=="fydPfor_response"){			
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');		
//print_r($result);			die;
		}
		if($whattoshow=="fysPfor_response"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');
		}
		if($whattoshow=="fybothPfor_response"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2);		
		}
		
		if($whattoshow=="fysresponse_rec_app"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4,0,'list');
		}
		
		if($whattoshow=="fydapp_forw_dep"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'",'list');
		}
		if($whattoshow=="fysapp_forw_dep"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');
		}
		if($whattoshow=="fybothapp_forw_dep"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2);		
		}
		
		if($whattoshow=="fyd_app_not_for_dep"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7,null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');					
			$result = array_merge($result1,$result2);				
		}		
		if($whattoshow=="fys_app_not_for_dep"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');	
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			
			$result = array_merge($result1,$result2);					
		}	
		if($whattoshow=="fyboth_app_not_for_dep"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7,null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');	
			$result3 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');	
			$result4 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			
			$result = array_merge($result1,$result2,$result3,$result4);					
		}
		if($whattoshow=="fysapp_forw_dep"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');
		}
		if($whattoshow=="fydunder_proc"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');			
		}	
		if($whattoshow=="fysunder_proc"){
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
		}	
		if($whattoshow=="fybothunder_proc"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);
		}
		
		if($whattoshow=="fydapp_apro_emp_com"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null,'list');			
		}		
		if($whattoshow=="fysapp_apro_emp_com"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null,'list');			
		}			
		if($whattoshow=="fybothapp_apro_emp_com"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="fydapp_disposed"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');			
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="fysapp_disposed"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');			
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="fybothapp_disposed"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');			
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');
			$result3 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		if($whattoshow=="fydapp_disposed_appr"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');			
		}	
		if($whattoshow=="fysapp_disposed_appr"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');			
		}		
		if($whattoshow=="fybothapp_disposed_appr"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');	
			$result = array_merge($result1,$result2);				
		} 
		
		if($whattoshow=="fydapp_disposed_rej"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("''", $startdate, $enddate, 7, "'R'",'list');			
		}	
		if($whattoshow=="fysapp_disposed_rej"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("''", $startdate, $enddate, 4, "'R'",'list');			
		}		
		if($whattoshow=="fybothapp_disposed_rej"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("''", $startdate, $enddate, 7, "'R'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("''", $startdate, $enddate, 4, "'R'",'list');	
			$result = array_merge($result1,$result2);				
		}
		if($whattoshow=="fyd_pend_dic"){	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null,'list');	
		}			
		if($whattoshow=="fys_pend_dic"){	
			/* $result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list'); */	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');				
		}
		if($whattoshow=="fyboth_pend_dic"){	
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7, null,'list');		
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');		
			$result = array_merge($result1,$result2);				
		}
		if($whattoshow=="fyd_res_rec_from_app"){
			//$subID=array();
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
		}
		if($whattoshow=="fys_res_rec_from_app"){
	
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');
			
		}
		if($whattoshow=="fyboth_res_rec_from_app"){
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');	
			$result= array_merge($result1,$result2);	
			
		}
		//Carray forwarded application submitted
		if($whattoshow=="cfd_app_sub")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null,'list');		
		}		
		if($whattoshow=="cfs_app_sub")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');		
		}
		if($whattoshow=="cfboth_app_sub")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);			
		}
		//Carray forwarded Applications Reverted
		if($whattoshow=="cfd_app_reverted")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');		
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result = array_merge($result1,$result2);	
		}		
		if($whattoshow=="cfs_app_reverted")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');	
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="cfboth_app_reverted")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');		
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');
			$result4 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		//carry forwarded 2.1 : Responses received from Applicant for Query
		if($whattoshow=="cfd_res_rec_app_for_q")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate,7, null,'list');		
		}		
		if($whattoshow=="cfs_res_rec_app_for_q")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');		
		}
		
		if($whattoshow=="cfboth_res_rec_app_for_q")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);				
		}
		//carry forwarded 2.2 : Pending for response
		if($whattoshow=="cfd_pen_res")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');		
		}		
		if($whattoshow=="cfs_pen_res")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');		
		}
		
		if($whattoshow=="cfboth_pen_res")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2);				
		}
		
		//carry forwarded 3 : Applications Forwarded to Department
		if($whattoshow=="cfd_app_for_dep")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'",'list');		
		}		
		if($whattoshow=="cfs_app_for_dep")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'",'list');		
		}
		
		if($whattoshow=="cfboth_app_for_dep")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'",'list');	
			$result = array_merge($result1,$result2);				
		}
		
		//carry forwarded 4 : Application Not forwarded to Department
		if($whattoshow=="cfd_app_not_for_dep")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, "'F'",'list');
			$result = array_merge($result1,$result2);
		}
		if($whattoshow=="cfs_app_not_for_dep")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2);
		}
		if($whattoshow=="cfboth_app_not_for_dep")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, "'F'",'list');
			$result3 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);
		}		
		//carry forwarded 4.1 : Under process at DIC/ DoI
		if($whattoshow=="cfd_under_proc_dic")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, "'F'",'list');		
		}		
		if($whattoshow=="cfs_under_proc_dic")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, "'F'",'list');		
		}
		
		if($whattoshow=="cfboth_under_proc_dic")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, "'F'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2);				
		}
		//carry forwarded 4.2 : Pending at DIC/ DoI
		if($whattoshow=="cfd_pend_dic")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');			
		}
		if($whattoshow=="cfs_pend_dic")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');		
		}
		if($whattoshow=="cfboth_pend_dic")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');			
			$result = array_merge($result1,$result2);			
		}
		//carry forwarded 5 : Applications Approved for Empowered Committee

		if($whattoshow=="cfd_app_appr_emp_comm")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, "'F'",'list');		
		}		
		if($whattoshow=="cfs_app_appr_emp_comm")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, "'F'",'list');		
		}
		
		if($whattoshow=="cfboth_app_appr_emp_comm")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, "'F'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, "'F'",'list');
			$result = array_merge($result1,$result2);				
		}		
		
		//carry forwarded 6 : Applications Disposed		
		if($whattoshow=="cfd_app_disposed")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');		
		}		
		if($whattoshow=="cfs_app_disposed")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');		
		}		
		if($whattoshow=="cfboth_app_disposed")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');
			$result = array_merge($result1,$result2);				
		}
		//carry forwarded 6.1 : Applications Disposed (Approved ) 
		if($whattoshow=="cfd_app_disposed_appr")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');		
		}		
		if($whattoshow=="cfs_app_disposed_appr")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');		
		}		
		if($whattoshow=="cfboth_app_disposed_appr")
		{
			$result1 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');
			$result = array_merge($result1,$result2);				
		}
		//carry forwarded 6.2 : Applications Disposed (Rejected)
		if($whattoshow=="cfd_app_disposed_rej")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');		
		}		
		if($whattoshow=="cfs_app_disposed_rej")
		{
			$result = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');		
		}		
		if($whattoshow=="cfboth_app_disposed_rej")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2);				
		}
		
		//both application submitted
		if($whattoshow=="bothd_app_sub")
		{		
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null,'list');			
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7,null,'list');
			$result = array_merge($result1,$result2);		
		}		
		if($whattoshow=="boths_app_sub")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);			
		}		
		if($whattoshow=="both2_app_sub")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7,null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, null,'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2,$result3,$result4);				
		}
		
		//both 2: Applications Reverted		
		if($whattoshow=="bothd_app_rev")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');
			
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);					
		}
		if($whattoshow=="boths_app_rev")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4,null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);				
		}
		if($whattoshow=="both2_app_rev")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');
			
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			
			$result5 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');
			$result6 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4,null,'list');
			$result7 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');	
			$result8 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4,$result5,$result6,$result7,$result8);
		}
		
		//both 2.1 : Responses received from Applicant for Query		
		if($whattoshow=="bothd_res_rec_app")
		{					
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');
			$result=array_merge($result1,$result2);			
		}		
		if($whattoshow=="boths_res_rec_app")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_res_rec_app")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7, null,'list');
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7, null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4, null,'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		
		//both 2.2 : Pending for response
		if($whattoshow=="bothd_pen_res")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="boths_pen_res")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_pen_res")
		{	
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		
		// Both 3 : Applications Forwarded to Department
		if($whattoshow=="bothd_app_for_dep")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="boths_app_for_dep")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_app_for_dep")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		
		// Both 4 : Application Not forwarded to Department
		if($whattoshow=="both2d_app_not_for_dep")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');
			$result3 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result4 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result=array_merge($result1,$result2,$result3,$result4);
		}
		if($whattoshow=="both2s_app_not_for_dep")
		{
		
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');
			$result2 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			$result4 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');			
			$result=array_merge($result1,$result2,$result3,$result4);
		}
		
		if($whattoshow=="both2_app_not_for_dep")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');
			$result3 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result4 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result5 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4, null,'list');
			$result6 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4, null,'list');
			$result7 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			$result8 =  Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');
			$result=array_merge($result1,$result2,$result3,$result4,$result5,$result6,$result7,$result8);			
		}
		// Both 4.1 : Under process at DIC/ DoI
		if($whattoshow=="bothd_under_pro_dic")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="boths_under_pro_dic")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_under_pro_dic")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7, null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4, null,'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, null,'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		// Both 4.2 : Pending at DIC/ DoI		
		if($whattoshow=="both2d_pend_dic")
		{
			$result1 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result2 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result=array_merge($result1,$result2);
		}
		if($whattoshow=="both2s_pend_dic")
		{
			$result1 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result2 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result=array_merge($result1,$result2);
		}
		if($whattoshow=="both2_pend_dic")
		{
			$result1 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result2 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7,null,'list');
			$result3 =Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result4 =Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4,null,'list');
			$result=array_merge($result1,$result2,$result3,$result4);
		}
		
		//both 5 : Applications Approved for Empowered Committee 
		if($whattoshow=="bothd_app_appr_emp_comm")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="boths_app_appr_emp_comm")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, null,'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_app_appr_emp_comm")
		{	
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33, null,'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33, null,'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34, null,'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34, null,'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		
		//both 6 : Applications Disposed		
		if($whattoshow=="bothd_app_dis")
		{	
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}			
		if($whattoshow=="boths_app_dis")
		{	
		
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');		
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');			
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');		
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		if($whattoshow=="both2_app_dis")
		{	
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');
			$result5 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');	
			$result6 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');			
			$result7 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');		
			$result8 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2,$result3,$result4,$result5,$result6,$result7,$result8);			
		}
		//both 6.1 : Applications Disposed (Approved )
		if($whattoshow=="bothd_app_dis_appr")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="boths_app_dis_appr")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');
			$result = array_merge($result1,$result2);			
		}
		if($whattoshow=="both2_app_dis_appr")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'",'list');	
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}
		//both 6.2 : Applications Disposed (Rejected )		
		if($whattoshow=="bothd_app_dis_rej")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');
			$result = array_merge($result1,$result2);			
		}		
		if($whattoshow=="boths_app_dis_rej")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');				
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2);			
		}
		
		if($whattoshow=="both2_app_dis_rej")
		{
			$result1 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'",'list');	
			$result2 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'",'list');
			$result3 =  Default1Controller::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'",'list');				
			$result4 = Default1Controller::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'",'list');
			$result = array_merge($result1,$result2,$result3,$result4);			
		}	
		
		
		
		$this->render('nodalPerformanceList',array('applicationData'=>$result));
		
		
		
	
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
            if($status == "'UNDER_PROCESSEED'"){$st="<=1";}
            if($status == "'PENDING'"){$st=">1";}
            $statusCondition = " bo_application_submission.application_status IN ('P') AND "
                    . "    DATEDIFF(NOW(),DATE_FORMAT(bo_application_submission.application_created_date,'%Y-%m-%d'))$st  AND
              "; 
        }
        $revert="";
      /*  if($status=='IBD'){
            $revert=" AND bo_application_submission.application_status!='H' ";
        } */
		
		 
		  // For Passed Condition
        if ($status == "'IBD'") {
            $statusCondition = " bo_application_flow_logs.application_status IN ($status) AND bo_application_submission.submission_id NOT IN (select bo_application_submission.submission_id from bo_application_submission where application_status IN('H')) AND ";
        }
		
		if ($status == "'ISA'" && $extraInMainStatus=="'F'") {
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
      
	    if($type=='list')
		return $Fields;
		else	
        return count($Fields);
      
    }
    
    
    /* Rahul Kumar :  02072018*/
	public function actionNodalPerformenceReport() {

        $this->render('nodalPerformanceReport1');
    }
}
