<?php

/* Rahul Kumar : 13072018 */

class Service2Controller extends Controller {
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
     * @date:13072018
     * @ServiceFilter : Multiple Department, Multiple Service, Application Number,From Date To Date 
     * , Multiple Status, Time-line Days from to Filter
     * @Fields :Sr. No,Name of Department,Service Name,Unit Name ,Unit Location,Unit District,
      Investor Name,Investor Email,Investor Mobile Number,Status,Application Date,Last Updated,Time-line
     */
    public function actionAdvanceReport() {
        // Variable Initilization
        $serviceCondition = "";
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

        // checking if  data has been posted
        if (!empty($_POST)) {

            // Extracting Get Values
            extract($_POST);

            //print_r($_POST);
            // Service conditions
            if (!empty($service)) {
                $serviceList = implode(",", $service);
                $serviceCondition = " AND spallapp.app_id IN ($serviceList) ";
            }



            // Service Status Conditions
            if (!empty($serviceStatus)) {
                $statusList = "'" . implode("','", $serviceStatus) . "'";
                $sList = implode(",", $serviceStatus);
                $statusCondition = " AND spapp.app_status IN ($statusList) ";
            }

            // Department Conditions
            if (!empty($department)) {
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
            // Financial Year wise 
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // print_r($fromtodate);die;
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(spapp.created_on)>='" . @$startDate . "' AND DATE(spapp.created_on)<='" . @$endDate . "' ";
                    // echo $fromToCondition; die;
                }
            }
            // echo "Here1"; die();
        }

        // Search Query 
        $sql = "SELECT 
                bd.department_name AS 'Name of Department',
                spallapp.app_name AS 'Service Name',
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
                Where spallapp.is_app_active ='Y' 
                     $serviceCondition 
                     $statusCondition 
                     $departmentCondition
                     $applicationCondition
                     $unitCondition  
                     $fromToCondition 
                ORDER BY bd.department_name DESC ";

        //   if(!empty($_POST)){ // echo $sql;die; }
        //Gettting values from dattabase as per passed parameters for services
        $serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
        // echo "herw";die;
        // setting values here
        $this->render('advanceReport', array(
            'serviceData' => $serviceDetail,
            'serviceList' => $serviceList,
            'departmentList' => $departmentList,
            'statusList' => $sList,
            'applicationNumber' => $applicationNumber,
            'unitName' => $unitName,
            'fy' => $fy,
        ));
    }

    /**
     * @authour : Rahul Kumar
     * @date:13072018
     * @ServiceFilter : Multiple Department, Multiple Service, Application Number,From Date To Date 
     * , Multiple Status, Time-line Days from to Filter
     * @Fields :Sr. No,Name of Department,Service Name,Unit Name ,Unit Location,Unit District,
      Investor Name,Investor Email,Investor Mobile Number,Status,Application Date,Last Updated,Time-line
     */
    public function actionAdvanceReport2() {
        // Variable Initilization
        $serviceCondition = "";
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
        $start = "";
        $end = "";
        $timeline = "";

        // checking if  data has been posted
        if(!empty($_POST)) {

            // Extracting Get Values
            extract($_POST);

            //print_r($_POST);
            //
            // Service conditions
            if (!empty($service)) {
                $serviceList = implode(",", $service);
                $serviceCondition = " AND spallapp.app_id IN ($serviceList) ";
            }

            // Incidence Status Conditions
            if (!empty($incidence)) {
                foreach ($incidence as $incDence) {
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
            if (!empty($serviceStatus)) {
                $statusList = "'" . implode("','", $serviceStatus) . "'";
                $sList = implode(",", $serviceStatus);
                $statusCondition = " AND spapp.app_status IN ($statusList) ";
            }

            // Department Conditions
            if (!empty($department)) {
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
        }

        // Search Query 
        $sql = "SELECT 
                spapp.sp_app_id,
                bd.department_name AS 'Name of Department',
                spallapp.app_name AS 'Service Name',
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
				
                Where spallapp.is_app_active ='Y' 
                     $serviceCondition 
                     $statusCondition 
                     $departmentCondition
                     $applicationCondition
                     $unitCondition  
                     $fromToCondition 
                     $incidenceCondition
                ORDER BY bd.department_name DESC ";

        //   if(!empty($_POST)){ // echo $sql;die; }  //Gettting values from dattabase as per passed parameters for services
        $serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
		
        // setting values here
        $this->render('advanceReport2', array(
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
            'start' => $start,
			'end' => $end,
			'timeline' => $timeline,
        ));
    }
	public function getServiceIncendence($service_id=null)
	{	
		
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
            
            $services = '';	
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
			if(isset($spidsStr) && !empty($spidsStr))
			{
				$conditions  .="  sp_id IN ($spidsStr) AND ";
			}
			
			if(isset($inciden) && !empty($inciden))
			{
				$conditions  .="  app_id IN ($inciden) AND ";
			}
			
            $sql = "select app_id,app_name from bo_sp_all_applications where $conditions is_app_active='Y'";
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();			
            foreach ($servicesList as $val) {
                $services .= "<option value='$val[app_id]'>$val[app_name]</option>";
            }

            echo $services;
        }        
    }
	 /*   public function actionGetServicesByDepartment_old() {
        if (!empty($_POST)) {
            $spidsArr = explode(',', $_POST['sp_id']);
            $spidsStr = implode(',', $spidsArr);
            $services = '';
            $connection = Yii::app()->db;
            $sql = "select app_id,app_name from bo_sp_all_applications where sp_id IN ($spidsStr) AND is_app_active='Y'";
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();

            foreach ($servicesList as $val) {
                $services .= "<option value='$val[app_id]'>$val[app_name]</option>";
            }
            echo $services;
        }
        die();
    } */
    
    public function actionGetDepartmentByIncedence() {
        $deptMents = '';
        if (!empty($_POST)) {
            $connection = Yii::app()->db;

            $preEstabmishmentList = array();
            $preOperationList = array();
            $postOperationList = array();
            $allIncedenceArray = array();

            $incedenceArr = explode(',', $_POST['incedence']);
            foreach ($incedenceArr as $incidence) {
                if ($incidence == 'pre_establishment') {
                    //fetch dept
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preEstabmishmentList = $command->queryAll();
                }
                if ($incidence == 'pre_operation') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_operation=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preOperationList = $command->queryAll();
                }
                if ($incidence == 'post_operation') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $postOperationList = $command->queryAll();
                }
            }
            $allIncedenceArray = array_merge($preEstabmishmentList, $preOperationList, $postOperationList);
            foreach ($allIncedenceArray as $val) {
                $deptMents .= "<option value='$val[sp_id]'>$val[department_name]</option>";
            }
            echo $deptMents;
        }

        die();
    }

    public function actionGetDepartmentTime($sno) {
        $count = 1;

        $diffapplicant = 0;
        $diffdept = 0;

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
                        if ($status == "A" || $status == "R") {
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
            $allDaysdept = ($months * 30) + $days;


            //printf("%d days, %d hrs, %d min\n",  $allDaysdept , $hours ,$minuts);
        }
        echo  $allDaysdept;
        
        die;
    }
	
	public function actionCafAdvanceReport() {
		$connection = Yii::app()->db;
		$sql = "select district_id,distric_name from bo_district where is_active='Y'";
		$command = $connection->createCommand($sql);
		$districtList = $command->queryAll();	
		$this->render('cafAdvanceReport',array('districtList'=>$districtList));
	}
	
	
	public function actionGetNicCodesByUnit() {
        if (!empty($_POST)) {
            
            $unit = $_POST['unit']; 
			if($unit=='manufacturing')
				$unit = 'MANUFACTURING';
			else
				$unit = 'SERVICES';
				
				
            $nic_code = '';
            $connection = Yii::app()->db;
            $sql = "select II_DIGIT_Code,Description from NIC_II_DIGIT where Industry_Type = '".$unit."'";
            $command = $connection->createCommand($sql);
            $nicCodeList = $command->queryAll();

            foreach($nicCodeList as $val) {
                $nic_code .= "<option value='$val[II_DIGIT_Code]'>".$val['II_DIGIT_Code'].'-'.$val['Description']."</option>";
            }

            echo $nic_code;
        }
        die();
    }

}
