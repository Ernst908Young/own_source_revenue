<?php

/* Rahul Kumar : 13072018 */

class ServiceController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/column2';

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
     * @authour : Rahul Kumar
     * @date:06082018
      * 
      */    
    
    public function accessRules() {
        return array(
           
            array('allow', // allow PS user to perform actions
                'actions' => array('advanceReport','advanceReport3','getServicesByDepartment','getDepartmentByIncedence','getServiceTimetakenbyDept','GetSyncServicesByDepartment'),
                'expression' => 'DefaultUtility::is_PRINCIPAL_SECRETARY()',
            ),
            array('allow', // allow CS user to perform actions
                 'actions' => array('advanceReport','advanceReport3','getServicesByDepartment','getDepartmentByIncedence','getServiceTimetakenbyDept','GetSyncServicesByDepartment'),
                'expression' => 'DefaultUtility::is_CHEIF_SECRETARY()',
            ),		
			array('allow', // allow PS user to perform actions
                'actions' => array('advanceReport','advanceReport3','getServicesByDepartment','getDepartmentByIncedence','getServiceTimetakenbyDept','GetSyncServicesByDepartment'),
                'expression' => 'DefaultUtility::isHODNodal()',
            ),
			array('allow', // allow PS user to perform actions
                'actions' => array('advanceReport','advanceReport3','getServicesByDepartment','getDepartmentByIncedence','getServiceTimetakenbyDept','GetSyncServicesByDepartment'),
                'expression' => 'DefaultUtility::isSECRETARY()',
            ),
			array('allow', // allow PS user to perform actions
                'actions' => array('advanceReport','advanceReport3','getServicesByDepartment','getDepartmentByIncedence','getServiceTimetakenbyDept','GetSyncServicesByDepartment'),
                'expression' => 'RolesExt::isDMUser()',
            ),			
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * @authour : Rahul Kumar
     * @date:13072018
     * @ServiceFilter : Multiple Department, Multiple Service, Application Number,From Date To Date 
     * , Multiple Status, Time-line Days from to Filter
     * @Fields :Sr. No,Name of Department,Service Name,Unit Name ,Unit Location,Unit District,
      Investor Name,Investor Email,Investor Mobile Number,Status,Application Date,Last Updated,Time-line
     */
    public function actionAdvanceReport() {
        // Variable Initilization
        $serviceCondition = "";
		$serviceDetail = "";
        $serviceList = "";
        $statusCondition = "";
        $statusList = "";
        $sList = "";
        $departmentCondition = "";
        $departmentList = "";
        $applicationCondition = "";
        $applicationNumber = "";
        $unitName = "";
        $unitCondition = "";
        $fy = "";
        $fromToCondition = "";
        $fromtodate = "";
        $incidenceCondition = "";
        $preEstabmishment = array();
        $preOperation = array();
        $postOperation = array();
        $allIncedenceArray = array();
        $inciden = "";
        $timeline = 'All';
		$start = "";
        $end = "";
        $type = "";
        if(!empty($_GET)) {
			extract($_GET);
			if (isset($incDence) && $incDence == 'pre_establishment') {
				$sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
				$preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
			}
			if (isset($incDence) && $incDence == 'pre_operation') {
				$sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
				$preOperation = Yii::app()->db->createCommand($sql)->queryAll();
			}
			if (isset($incDence) && $incDence == 'post_operation') {
				$sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0";
				$postOperation = Yii::app()->db->createCommand($sql)->queryAll();
			}
			
			$allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
            }
            if (!empty($inciden)) {
                $inciden = $inciden . "'0'";
                $incidenceCondition = " AND spallapp.app_id IN ($inciden) ";
            }
			
			// From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = date('Y-m-d', strtotime(@$start));
                $endDate = date('Y-m-d', strtotime(@$end));
                $fromToCondition = " AND DATE(spapp.created_on)>='" . @$startDate . "' AND DATE(spapp.created_on)<='" . @$endDate . "' ";
            }

            // Financial Year wise 			
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(spapp.created_on)>='" . @$startDate . "' AND DATE(spapp.created_on)<='" . @$endDate . "' ";
                }
            }
			
			// Search Query 
			$sql = "SELECT 
                spapp.sno AS 'sno',
                spapp.sp_app_id,
				bd.dept_id,
				bd.infowiz_short_code,
                boinfoissuer.name AS 'Name of Department',
                boinfoissuer.issuerby_id AS 'issuerby_id',
                spallapp.app_name AS 'Service Name',
                spallapp.app_id AS 'service_id',
                spapp.app_id AS 'Application No.', 
                spapp.unit_name AS 'Unit Name',
                spapp.app_location AS 'Unit Location',
                spapp.app_distt AS 'Unit District',
                CONCAT(sp.first_name, '  ',sp.last_name ) AS 'Investor Name', 
                su.email AS 'Investor Email', 
                sp.mobile_number AS 'Investor Mobile Number', 
                spapp.app_status AS 'Status', 
                spapp.created_on AS 'Application Date', 
                spapp.updated_on AS 'Last Updated'
                FROM bo_sp_applications as spapp 
                LEFT JOIN bo_sp_all_applications as spallapp ON spapp.sp_app_id=spallapp.app_id 
                LEFT JOIN sso_users as su ON spapp.user_id=su.user_id 
                LEFT JOIN sso_profiles as sp ON su.user_id=sp.user_id
                LEFT JOIN sso_service_providers as ssp ON spallapp.sp_id=ssp.sp_id 
                LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id
                LEFT JOIN bo_infowizard_issuerby_master as boinfoissuer ON boinfoissuer.abb=bd.infowiz_short_code
				
                Where spallapp.is_app_active ='Y' AND spapp.app_status  IN ('A','P','F','R','RBI') AND  spapp.user_id !='11' AND ssp.sp_id not in ('9','10','27','28')
				$fromToCondition	
                $incidenceCondition
                ORDER BY boinfoissuer.name DESC";
				
        
			$serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
		}
        // checking if  data has been posted
        if(!empty($_POST)) {
            //Extracting Get Values
            extract($_POST);
            //Service conditions    			
            if (!empty($service) && $service[0]!='All') {
                $serviceList = implode(",", $service);
                $serviceCondition = " AND spallapp.app_id IN ($serviceList) ";
            }
            // Incidence Status Conditions
			
            if (!empty($incidence) && $incidence[0]!='All') {
                foreach($incidence as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
            $allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
            }
            if (!empty($inciden)) {
                $inciden = $inciden . "'0'";
                $incidenceCondition = " AND spallapp.app_id IN ($inciden) ";
            }

            // Service Status Conditions			
            if (!empty($serviceStatus) && $serviceStatus[0]!='All') {
                $statusList = "'" . implode("','", $serviceStatus) . "'";
                $sList = implode(",", $serviceStatus);
                $statusCondition = " AND spapp.app_status IN ($statusList) ";
            }

            // Department Conditions
			
            if (isset($department) && $department[0]!='All') {				
                $departmentList = implode(",", $department);
                $departmentCondition = " AND ssp.sp_id IN ($departmentList) ";
            }

            // Application Number
            if (!empty($applicationNumber)) {
                $applicationCondition = " AND spapp.app_id=$applicationNumber ";
            }

            // Unit Name
            if (!empty($unitName)) {
                $unitCondition = " AND spapp.unit_name='$unitName' ";
            }
            //  echo "Here"; 
            // From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = date('Y-m-d', strtotime(@$start));
                $endDate = date('Y-m-d', strtotime(@$end));
                $fromToCondition = " AND DATE(spapp.created_on)>='" . @$startDate . "' AND DATE(spapp.created_on)<='" . @$endDate . "' ";
            }

            // Financial Year wise 			
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(spapp.created_on)>='" . @$startDate . "' AND DATE(spapp.created_on)<='" . @$endDate . "' ";
                }
            }
			
			// Search Query 
			$sql = "SELECT 
                spapp.sno AS 'sno',
                spapp.sp_app_id,
				bd.dept_id,
				bd.infowiz_short_code,
                boinfoissuer.name AS 'Name of Department',
                boinfoissuer.issuerby_id AS 'issuerby_id',
                spallapp.app_name AS 'Service Name',
                spallapp.app_id AS 'service_id',
                spapp.app_id AS 'Application No.', 
                spapp.unit_name AS 'Unit Name',
                spapp.app_location AS 'Unit Location',
                spapp.app_distt AS 'Unit District',
                CONCAT(sp.first_name, '  ',sp.last_name ) AS 'Investor Name', 
                su.email AS 'Investor Email', 
                sp.mobile_number AS 'Investor Mobile Number', 
                spapp.app_status AS 'Status', 
                spapp.created_on AS 'Application Date', 
                spapp.updated_on AS 'Last Updated'
                FROM bo_sp_applications as spapp 
                LEFT JOIN bo_sp_all_applications as spallapp ON spapp.sp_app_id=spallapp.app_id 
                LEFT JOIN sso_users as su ON spapp.user_id=su.user_id 
                LEFT JOIN sso_profiles as sp ON su.user_id=sp.user_id
                LEFT JOIN sso_service_providers as ssp ON spallapp.sp_id=ssp.sp_id 
                LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id
                LEFT JOIN bo_infowizard_issuerby_master as boinfoissuer ON boinfoissuer.abb=bd.infowiz_short_code
				
                Where spallapp.is_app_active ='Y' AND spapp.app_status  IN ('A','P','F','R','RBI') AND  spapp.user_id !='11' AND ssp.sp_id not in ('9','10','27','28') 
                     $serviceCondition 
                     $statusCondition 
                     $departmentCondition
                     $applicationCondition
                     $unitCondition  
                     $fromToCondition 
                     $incidenceCondition
                ORDER BY boinfoissuer.name DESC";
				
			
				$serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
        }

        

        // setting values here
        $this->render('advanceReport', array(
            'serviceData' => $serviceDetail,
            'serviceList' => $serviceList,
            'departmentList' => $departmentList,
            'statusList' => $sList,
            'applicationNumber' => $applicationNumber,
            'unitName' => $unitName,
			'preEstabmishment'=>$preEstabmishment, 
			'preOperation'=>$preOperation,
			'postOperation'=>$postOperation,
            'fy' => $fy,
            'timeline' => $timeline,
			'start' => $start,
			'end' => $end,
			'type'=>$type
		));
    }
	
	public function getDepartMentNameById($deptId=null){
	
		$connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_departments where dept_id=$deptId";
        $command = $connection->createCommand($sql);
		$nameArr = $command->queryRow();
		
		return $nameArr['department_name'];
	}
	
	public function getDepartMentNameByIsseurId($issuerId=null){
	
		$connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=$issuerId";
        $command = $connection->createCommand($sql);
		$nameArr = $command->queryRow();
		return $nameArr['name'];
	}
	
	public function getServiceIncendence($service_id=null)
	{	
		$preEstabmishment = array();
		$preOperation = array();
		$postOperation = array();
		
		$sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1 AND bistn.core_service_id=$service_id";
        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
		
		$sql2 = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1 AND bistn.core_service_id=$service_id";
        $preOperation = Yii::app()->db->createCommand($sql2)->queryAll();
		
		$sql3 = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0 AND bistn.core_service_id=$service_id";
		$postOperation = Yii::app()->db->createCommand($sql3)->queryAll();
		
		$incedence ='';
		if(isset($preEstabmishment) && !empty($preEstabmishment))
		{
			$incedence = $incedence."Pre Establishment<br/>";
		}
		if(isset($preOperation) && !empty($preOperation))
		{	
			$incedence = $incedence."Pre Operation<br/>";
			
		}		
		if(isset($postOperation) && !empty($postOperation))
		{	
			$incedence = $incedence."Post Operation<br/>";
			
		}
		return $incedence;				
	}

	public function actionGetServicesByDepartment() {
		
        if (!empty($_POST)) {
            //department Id
            $spidsArr = explode(',', $_POST['sp_id']);
            $spidsStr = implode(',', $spidsArr);
			
			//incedence type
			$incedenceArr = explode(',', $_POST['incedence']);
            /* print_r($spidsArr);
            print_r($incedenceArr); */
            $services = '<option value="All">All Services</option>';	
			$inciden = '';
			$preEstabmishment = array();
			$preOperation =  array();
			$postOperation =  array();	
            $connection = Yii::app()->db;
			
			// Incidence Status Conditions
            if (!empty($incedenceArr)) {
                foreach ($incedenceArr as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id 
						where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
			
			$allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
			
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
				$inciden = rtrim($inciden,',');
            }
			$conditions ='';
			if(isset($spidsStr) && !empty($spidsStr) && $spidsArr[0]!="" && $spidsArr[0]!="All")
			{
				$conditions  .="  sp_id IN ($spidsStr) AND ";
			}
			
			if(isset($inciden) && !empty($inciden) && $incedenceArr[0]!="" && $incedenceArr[0]!="All")
			{
				$conditions  .="  app_id IN ($inciden) AND ";
			}
			
			if((isset($spidsArr) && $spidsArr[0]!="" && $spidsArr[0]!="All") || (isset($incedenceArr) && $incedenceArr[0]!="" && $incedenceArr[0]!="All"))
			{
				$sql = "select app_id,app_name from bo_sp_all_applications where $conditions is_app_active='Y'";
			} else {
				$sql = "select app_id,app_name from bo_sp_all_applications where is_app_active='Y'";
			}	
			
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();			
            foreach ($servicesList as $val) {
                $services .= "<option value='$val[app_id]'>$val[app_name]</option>";
            }

            echo $services;
        }
    }	
	
    public function getServiceTimetakenbyDept($sno=null) {
        $count = 1;
        $diffapplicant = 0;
        $diffdept = 0;
        $extraDays=0;
        $allDaysdept = 0;
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_sp_application_history where sp_app_id=:sno Order By history_id DESC";
        $command = $connection->createCommand($sql);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $history = $command->queryAll();

        if (!empty($history)) {
            $apps1 = $history;
            foreach ($history as $key => $apps) {
                $status = $apps['application_status'];
                if ($status == "RBI") {
                    $keyval = $key - 1;
                    if ($keyval >= 0) {
                        $date = $apps1[$keyval]['added_date_time'];
                    } else {
                        $date = date('Y-m-d H:i:s');
                    }

                    // 1
                    //echo $date."===".$apps['added_date_time']."<br>";
                    $diff = abs(strtotime($apps['added_date_time']) - strtotime($date));
                    $diffapplicant = $diffapplicant + $diff;
                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                    $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                    $allDays = ($months * 30) + $days;
                    //printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);
                }

                // 222

                if ($status != "RBI") {
                    if ($key == 0) {
                        if ($status == "A" || $status == "R" || $status=="O") {
                            $date = $apps['added_date_time'];
                        } else {
                            $date = date('Y-m-d H:i:s');
                        }
                    } else {
                        $keyval = $key - 1;
                        $date = $apps1[$keyval]['added_date_time'];
                    }
                    //echo $date;
                    $diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));

                    $diffdept = $diffdept + $diff1;
                    $years = floor($diff1 / (365 * 60 * 60 * 24));
                    $months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                    $minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                    $seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                    $allDays = ($months * 30) + $days;

                    //printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);
                }
            }

            $years = floor($diffdept / (365 * 60 * 60 * 24));
            $months = floor(($diffdept - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $hours = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
            $minuts = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
            $seconds = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
            if($years>0){$extraDays=365*$years;}
            $allDaysdept = ($months * 30) + $days+$extraDays;
            

            //printf("%d days, %d hrs, %d min\n",  $allDaysdept , $hours ,$minuts);
        }
        //echo $allDaysdept;die;

        return($allDaysdept);
        
        
    }
    
    public function actionTimeDept2() {
        print_r('223');die;
        return 1;
    }
	
	

    public function actionGetDepartmentByIncedence() {
        $deptMents = '<option value="All">All Departments</option>';
		
        if(!empty($_POST['incedence'])) {
            $connection = Yii::app()->db;
            $preEstabmishmentList = array();
            $preOperationList = array();
            $postOperationList = array();
            $allIncedenceArray = array();
            $allList = array();
			
            $incedenceArr = explode(',', $_POST['incedence']);
            foreach($incedenceArr as $incidence) {
                if ($incidence == 'pre_establishment' && $incidence != 'All') {
                    //fetch dept
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preEstabmishmentList = $command->queryAll();
                }
                if ($incidence == 'pre_operation' && $incidence != 'All') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_operation=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preOperationList = $command->queryAll();
                }
                if ($incidence == 'post_operation' && $incidence != 'All') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $postOperationList = $command->queryAll();
                }
				if ($incidence == 'All') {
                   $sql = "SELECT ssp.sp_id, bd.department_name from sso_service_providers as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
                   $allList = Yii::app()->db->createCommand($sql)->queryAll();
                }
            }
            $allIncedenceArray = array_merge($preEstabmishmentList, $preOperationList, $postOperationList, $allList);
            
        }else{				
			$sql = "SELECT ssp.sp_id, bd.department_name from sso_service_providers as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
			$allIncedenceArray = Yii::app()->db->createCommand($sql)->queryAll();			
		}
		foreach($allIncedenceArray as $val) {
			$deptMents .= "<option value='$val[sp_id]'>$val[department_name]</option>";
		}
		echo $deptMents;
        die();
    }
    
    
    public function actionAdvanceReport3() {
        // Variable Initilization
        $serviceCondition = "";
		$serviceDetail = "";
        $serviceList = "";
        $statusCondition = "";
        $statusList = "";
        $sList = "";
        $departmentCondition = "";
        $departmentList = "";
        $applicationCondition = "";
        $applicationNumber = "";
        $unitName = "";
        $unitCondition = "";
        $fy = "";
        $fromToCondition = "";
        $fromtodate = "";
        $incidenceCondition = "";
        $preEstabmishment = array();
        $preOperation = array();
        $postOperation = array();
        $allIncedenceArray = array();
        $inciden = "";
        $timeline = 'All';
		$start = "";
        $end = "";
       
        // checking if  data has been posted
        if(!empty($_POST)) {
            //Extracting Get Values
            extract($_POST);
			// Incidence Status Conditions
			if (!empty($incidence) && $incidence[0]!='All') {
                foreach($incidence as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
            $allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
            }
			if (!empty($inciden)) {
                $inciden = $inciden . "'0'";
                $incidenceCondition = " AND bodeps.legacy_service_id IN ($inciden) ";
            }
			
			//Service conditions    			
            if (!empty($service) && $service[0]!='All') {
                $serviceList = implode(",", $service);
                $serviceCondition = " AND bodeps.legacy_service_id IN ($serviceList) ";
            }
			
            // Service Status Conditions			
            if (!empty($serviceStatus) && $serviceStatus[0]!='All') {
                $statusList = "'" . implode("','", $serviceStatus) . "'";
                $sList = implode(",", $serviceStatus);
                $statusCondition = " AND bodeps.app_status IN ($statusList) ";
            }

            // Department Conditions			
            if (isset($department) && $department[0]!='All') {				
                $departmentList = implode(",", $department);
                $departmentCondition = " AND bodeps.infowiz_dept_id IN ($departmentList) ";
            }

            // Application Number
            if (!empty($applicationNumber)) {
                $applicationCondition = " AND bodeps.dept_application_number=$applicationNumber ";
            }

            // Unit Name
            if (!empty($unitName)) {
                $unitCondition = " AND bodeps.unit_name='$unitName' ";
            }
            
            // From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = date('Y-m-d', strtotime(@$start));
                $endDate = date('Y-m-d', strtotime(@$end));
                $fromToCondition = " AND DATE(bodeps.application_created_on)>='" . @$startDate . "' AND DATE(bodeps.application_created_on)<='" . @$endDate . "' ";
            }

            // Financial Year wise 			
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(bodeps.application_created_on)>='" . @$startDate . "' AND DATE(bodeps.application_created_on)<='" . @$endDate . "' ";
                }
            }
			
			// Search Query 
			$sql = "SELECT 
                bodeps.sno,
                bodeps.infowiz_dept_id,
				bodeps.infowiz_service_id,
				bodeps.legacy_service_id,
				bodeps.dept_application_number,
				bodeps.dept_sw_reference_no,
				bodeps.licence_no,
				bodeps.dept_user_id,
				bodeps.applicant_name,
				bodeps.applicant_email,
				bodeps.applicant_contact_no,
				bodeps.unit_name,
				bodeps.app_status,
				bodeps.unit_address,
				bodeps.application_created_on,
				bodeps.application_time_taken_by_department,
				boinfowizrd.issuerby_id,
                boinfowizrd.name AS 'dept_name'
				
                FROM bo_dept_service_application as bodeps               
                LEFT JOIN bo_infowizard_issuerby_master as boinfowizrd ON bodeps.infowiz_dept_id=boinfowizrd.issuerby_id
				
                Where bodeps.is_active ='Y' 
				$fromToCondition
				$unitCondition
				$applicationCondition
				$departmentCondition
				$statusCondition
				$serviceCondition
				$incidenceCondition
                ORDER BY boinfowizrd.name DESC";
			
			$serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
		}
              
        // setting values here
        $this->render('advanceReport3', array(
            'serviceData' => $serviceDetail,
            'serviceList' => $serviceList,
            'departmentList' => $departmentList,
            'statusList' => $sList,
            'applicationNumber' => $applicationNumber,
            'unitName' => $unitName,
			'preEstabmishment'=>$preEstabmishment, 
			'preOperation'=>$preOperation,
			'postOperation'=>$postOperation,
            'fy' => $fy,
            'timeline' => $timeline,
			'start' => $start,
			'end' => $end
		));
		 
    }
	
	public function actionGetSyncServicesByDepartment() {
		
        if(!empty($_POST)) {
            //department Id
            $spidsArr = explode(',', $_POST['issuerby_id']);
            $spidsStr = implode(',', $spidsArr);
			
			//incedence type
			$incedenceArr = explode(',', $_POST['incedence']);
            /* print_r($spidsArr);
            print_r($incedenceArr); */
            $services = '<option value="All">All Services</option>';	
			$inciden = '';
			$preEstabmishment = array();
			$preOperation =  array();
			$postOperation =  array();	
            $connection = Yii::app()->db;
			$conditions ='';
	
			if(isset($spidsStr) && !empty($spidsStr) && $spidsArr[0]!="" && $spidsArr[0]!="All")
			{
				$conditions  .=" biwsm.issuerby_id IN ($spidsStr) AND ";
			}else{
			
				$conditions  .=" biwsm.issuerby_id IN (select infowiz_dept_id from bo_dept_service_application group by infowiz_dept_id)  AND ";
			
			}
			// Incidence Status Conditions
            if (!empty($incedenceArr)) {
                foreach ($incedenceArr as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id 
						where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
			
			$allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
			
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['service_id']))
                        $inciden = $inciden . "'" . $arr['service_id'] . "',";
                }
				$inciden = rtrim($inciden,',');
            }
			
			
			
			if(isset($inciden) && !empty($inciden) && $incedenceArr[0]!="" && $incedenceArr[0]!="All")
			{
				$conditions  .="  biwsp.service_id IN ($inciden) AND ";
			}
			
			
			if((isset($spidsArr) && $spidsArr[0]!="" && $spidsArr[0]!="All") || (isset($incedenceArr) && $incedenceArr[0]!="" && $incedenceArr[0]!="All"))
			{
				//$sql = "select app_id,app_name from bo_sp_all_applications where $conditions is_app_active='Y'";
			/* 	$sql= "SELECT CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) as           serviceid,core_service_name,biwsm.id,biwsm.issuerby_id from bo_infowizard_service_timeline_new AS bistn 
				LEFT JOIN bo_information_wizard_service_parameters as biwsp ON CONCAT(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice)=
				CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) 
				LEFT JOIN bo_information_wizard_service_master as biwsm ON biwsm.id=bistn.service_id
				where $conditions bistn.timeline_type='SWA' AND biwsp.is_active='Y' GROUP BY id"; 	  */
				
				$sql= "SELECT CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) as serviceid,core_service_name,biwsm.id,biwsm.issuerby_id from bo_infowizard_service_timeline_new AS bistn 
						LEFT JOIN bo_information_wizard_service_parameters as biwsp ON CONCAT(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice)=
						CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice)
						LEFT JOIN bo_information_wizard_service_master as biwsm ON biwsm.id=bistn.service_id
						where $conditions bistn.timeline_type='SWA' AND biwsp.is_active='Y' GROUP BY serviceid";
				
			} else {
				$sql = "SELECT CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) as serviceid,core_service_name,biwsm.id,biwsm.issuerby_id from bo_infowizard_service_timeline_new AS bistn 
				LEFT JOIN bo_information_wizard_service_parameters as biwsp ON CONCAT(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice)=
				CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice)
				LEFT JOIN bo_information_wizard_service_master as biwsm ON biwsm.id=bistn.service_id
				where bistn.timeline_type='SWA' AND biwsp.is_active='Y' AND issuerby_id IN(select infowiz_dept_id from bo_dept_service_application group by infowiz_dept_id) GROUP BY serviceid";
			}	
			
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();			
            foreach ($servicesList as $val) {
                $services .= "<option value='$val[serviceid]'>$val[core_service_name]</option>";
            }

            echo $services;
        }
    }  
        
}