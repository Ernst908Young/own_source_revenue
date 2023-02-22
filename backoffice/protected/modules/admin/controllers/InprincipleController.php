<?php
/* Rahul Kumar : 06082018 */

class InprincipleController extends Controller {
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
     * @CAFFilter : 
     */
    public function actionAdvanceReport() {
        $fromToCondition = "";
        $statusCondition = "";
        $applicationDetail = "";
        $districtCondition = "";
        $districtListStr = "";
        $applicationCondition = "";
        $unitNameCondition = "";
        $applicationNumber = "";
        $natureunitCondition = "";
        $natureUnitListStr = "";
        $natureUnitList = "";
        $unitTypeListStr = "";
        $unitTypeList = "";
        $nicCodeListStr = "";
        $nicCodeList = "";
        $distList = "";
        $statusList = "";        
        $unitName = "";
        $status = array();
        $start = "";
        $end = "";
        $fy = "";
		$fieldvaluenature_unitLikeSearch = '';
		$fieldvalueunit_typeLikeSearch = '';
        $nature_unit = array();
        $district = array();
        $nic_code = array();
		$districtArr = array();
		$unit_type = array();
        if(!empty($_POST['submit'])) {
            // Extracting Get Values
            extract($_POST);
            extract($_GET);
			
            if (!empty($district) && $district[0] != 'All') {
                $districtListStr = "'" . implode("','", $district) . "'";
                $distList = implode(",", $district);
                $districtCondition = " AND bspsub.landrigion_id IN ($districtListStr) ";
            }

            //From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = @$start;
                $endDate = @$end;
                $fromToCondition = " AND DATE(bspsub.application_created_date)>='" . @$startDate . "' AND DATE(bspsub.application_created_date)<='" . @$endDate . "' ";
            }

            //Financial Year wise 
            if (!empty($fy) && $fy!='All') {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(bspsub.application_created_date)>='" . @$startDate . "' AND DATE(bspsub.application_created_date)<='" . @$endDate . "' ";
                }
            }

            // Application Number
            if (!empty($applicationNumber)) {
                $applicationCondition = " AND bspsub.submission_id=$applicationNumber ";
            }

            // Nature of Unit			
            if (!empty($nature_unit) && $nature_unit[0] != 'All') {
                $natureUnitListStr = "'" . implode("','", $nature_unit) . "'";
                $natureUnitList = implode(",", $nature_unit);
				/* foreach($nature_unit as $key=>$val){
					$fieldvalueCase = '"ntrofunit":"' . $val . '"';
				}
				$fieldvaluenature_unitLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' "; */
            }
			
			// Unit Type	
            if (!empty($unit_type) && $unit_type[0] != 'All') {
               $unitTypeListStr = "'" . implode("','", $unit_type) . "'";
			   $unitTypeList = implode(",", $unit_type);
				/* foreach($unit_type as $key=>$val){
					$fieldvalueCase = '"ntrofunittype":"' . $val . '"';
				}
				$fieldvalueunit_typeLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' "; */
            }
			
            // Nic Codes
            if (!empty($nic_code) && $nic_code[0] != 'All') {
                $nicCodeListStr = "'" . implode("','", $nic_code) . "'";
                $nicCodeList = implode(",", $nic_code);
            }
			
						
            // Status
            if (!empty($status) && $status[0] != 'All') {
				$statusListStr = "'" . implode("','", $status) . "'";
                $statusList = implode(",", $status);
               // $statusCondition = " AND bspsub.application_status='$status' ";
                $statusCondition = " AND bspsub.application_status IN ($statusListStr)";
            }
			$ISAJoin = " LEFT JOIN bo_application_flow_logs on bspsub.submission_id=bo_application_flow_logs.submission_id ";
			$ISACondition = " AND bo_application_flow_logs.application_status='ISA' ";
			
			$sql = "SELECT * from bo_application_submission as bspsub $ISAJoin where bspsub.application_id=1 AND bspsub.user_id!=11 
			$fromToCondition 
			$districtCondition  
			$applicationCondition
			$ISACondition	
			$statusCondition";
            $applicationDetail = Yii::app()->db->createCommand($sql)->queryAll();
			
			
			if(isset($districtListStr) && !empty($districtListStr)) { 
				$sql = "Select district_id, distric_name from bo_district where district_id IN($districtListStr)";
				$districtArr = Yii::app()->db->createCommand($sql)->queryAll();
			}else{
				$sql = "Select district_id, distric_name from bo_district";
				$districtArr = Yii::app()->db->createCommand($sql)->queryAll();
			}

        }
		
        //Search Query 
        //Gettting values from dattabase as per passed parameters
        $districtList = $this->getDistrictList();
		
        // setting values here
        $this->render('advanceReport', array(
            'applicationData' => $applicationDetail,
            'districtList' => $districtList,           
            'districtListStr' => $distList,
            'applicationNumber' => $applicationNumber,
            'natureUnitListStr' => $natureUnitListStr,
            'natureUnitList' => $natureUnitList,
            'unitTypeListStr' => $unitTypeListStr,
            'unitTypeList' => $unitTypeList,
            'nicCodeListStr' => $nicCodeListStr,
            'nicCodeList' => $nicCodeList,
            'unit_type' => $unit_type,
            'unitName' => $unitName,
            'district' => $district,
            'nic_code' => $nic_code,
            'nature_unit' => $nature_unit,
            'start' => $start,
            'status' => $status,
            'statusList' => $statusList,
            'end' => $end,
            'fy' => $fy,
            'districtArr' => $districtArr
        ));
    }
	
	public static function getCafStatusCount($distID = null, $resultFor = null , $start=null, $end=null, $fy=null,$applicationNumber=null,$nature_unit=null,$unit_type=null,$nic_code=null,$status=null) {
	
       $totalcount=0;
        // Demo ID's 
        $demoUserID = "'11'";
		
        // Passed District ID
        $distID = "'$distID'";
        
        // Geting Result For json Field
        $inquireAbout = "";
        
        // Initializartion of investment type
        $Investmenttype=0;
        
        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField=" count(*) as total ";
        
        /* Getting District Waiting Appr Application */
        if ($resultFor == "districtWatApproved") {
            $nextRoleID = "'33'";
            $actionStatus = "'P'";
        }
		/* Getting State Waiting Appr Application */
        if ($resultFor == "stateWatApproved") {
            $nextRoleID = "'34'";
            $actionStatus = "'P'";
        }
		
		/* Getting District Approved Application */
        if ($resultFor == "districtApproved") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'A'";
        }
        
        /* Getting State Approved Application */
        if ($resultFor == "stateApproved") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'A'";
        }
        
         /* Getting District Rejected Application */
        if ($resultFor == "districtRejected") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'R'";
        }
        
         /* Getting State Rejected Application */
        if ($resultFor == "stateRejected") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'R'";
        }
		
		  /* Getting District Incomplete Application */
        if ($resultFor == "districtIncomplete") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'I'";
        }
		
		  /* Getting State Incomplete Application */
        if ($resultFor == "stateIncomplete") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'I'";
        }
		
		  /* Getting District Archived Application */
        if ($resultFor == "districtArchived") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'Z'";
        }
		
		  /* Getting State Archived Application */
        if ($resultFor == "stateArchived") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'Z'";
        }
        
         /* Getting current District Forwarded Application */
        if ($resultFor == "districtForwarded") {
            $nextRoleID = "'7'";
            $actionStatus = "'F'";
        }
        
        /* Getting current State Forwarded Application */
        if ($resultFor == "stateForwarded") {
            $nextRoleID = "'4'";
            $actionStatus = "'F'";
        }
        
        /* Getting current District Pending Application */
        if ($resultFor == "districtPending") {
            $nextRoleID = "'7'";
            $actionStatus = "'P'";
        }
        
        /* Getting current State Pending Application */
        if ($resultFor == "statePending") {
            $nextRoleID = "'4'";
            $actionStatus = "'P'";
        }
        
        /* Getting current District Reverted Application */
        if ($resultFor == "districtReverted") {
            $nextRoleID = "'7'";
            $actionStatus = "'H'";
        }
        
         /* Getting current State Reverted Application */
        if ($resultFor == "stateReverted") {
            $nextRoleID = "'4'";
            $actionStatus = "'H'";
        }
        
        /* Getting total District Submitted Application */
        if ($resultFor == "districtSubmitted") {
            $nextRoleID = "'7'";			
            $actionStatus = "'A','H','R','P','F','I','Z'";
        }
        
        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F','I','Z'";
        }
        
         /* Getting current District Submitted Application */
        if ($resultFor == "districtForwardedAndDisposed") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','R','F'";
        }
        
         /* Getting current State Forwarded and Disposed Application */
        if ($resultFor == "stateForwardedAndDisposed") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','R','F'";
        }
        
        // For JSON Value Count  EG: $inquireAbout="invstmnt_in_total";
        
         /* District - Approved Male Employment */
        if ($resultFor == "districtMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField=" field_value ";
        }
        
         /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField=" field_value ";
        }
        
         /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField=" field_value ";
        }
        
        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField=" field_value ";
        }
        
        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField=" field_value ";          
        }
        
         /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField=" field_value ";
        }
        
         /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField=" field_value ";
        }
        
        /* State - Proposed Male Employment */
          if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField=" field_value ";
        }
        
         /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField=" field_value ";
        }
        
        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField=" field_value ";
        }
        
        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField=" field_value ";          
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField=" field_value ";
        }
        /* District - Proposed Manufacturing */
        if ($resultFor == "districtProposedManufacturing") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField=" field_value "; 
            $Investmenttype="Manufacturing";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField=" field_value ";
            $Investmenttype="Manufacturing";
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField=" field_value "; 
            $Investmenttype="Services";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField=" field_value ";
            $Investmenttype="Services";
        }
		
		 /* District - Proposed Manufacturing */
        if ($resultFor == "districtProposedManufacturing") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
        }

		
		$fromToDateCondition  = '';
		//From Date To Date Condition	
		if(!empty($start) && !empty($end)) {
			$startDate = $start;
			$endDate1 =$end;
			
			$fromToDateCondition = " AND DATE(bo_application_submission.application_created_date)>='" . @$startDate . "' AND DATE(bo_application_submission.application_created_date)<='" . @$endDate1 . "' ";
			$ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='" . @$startDate . "' AND DATE(bo_application_flow_logs.created_date_time)<='" . $endDate1 . "' ";
		}

		
		//Financial Year wise 
		if(!empty($fy) && $fy!='All') {
			$fromtodate = explode(":", $fy);
			// From Date To Date Conditions       
			if(!empty($fromtodate)) {
				$startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
				$endDate1 = date('Y-m-d', strtotime(@$fromtodate[1]));
				$fromToDateCondition = " AND DATE(bo_application_submission.application_created_date)>='" . @$startDate . "' AND DATE(bo_application_submission.application_created_date)<='" . @$endDate1 . "' ";
				$ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='" . @$startDate . "' AND DATE(bo_application_flow_logs.created_date_time)<='" . $endDate1 . "' ";
			}
		}
		
        $submissionCondition = '';
		if(!empty($applicationNumber)) {		
			$submissionCondition = " AND bo_application_submission.Submission_id = $applicationNumber ";
		}
		
		$satusCondition = "";
		if(!empty($status) && $status[0]!='All') 
		{			
			$statusStr = "'" . implode("','", $status) . "'";
			$satusCondition = " AND bo_application_submission.Submission_id IN (select submission_id from bo_application_submission where application_status IN ($statusStr)) ";
		}
	
		$fieldvalueLikeSearch = "";
		if(!empty($nature_unit) && $nature_unit[0]!='All' && !empty($nature_unit[0]) && empty($nature_unit[1]))
		{  
			//ntrofunit = Manufacturing,Services 
            $fieldvalueCase = '"ntrofunit":"' . $nature_unit[0] . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
		
		if(!empty($unit_type) && $unit_type[0]!='All'){  
			//ntrofunittype = small,micro etc
			foreach($unit_type as $key=>$val){
				$fieldvalueCase = '"ntrofunittype":"' . $val . '"';
			}
			$fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        } 
		
		if(!empty($nic_code) && $nic_code[0]!='All'){  
			//ntrofunittype = small,micro etc
			foreach($nic_code as $key=>$val){
				$fieldvalueCase = '"nic_code":"' . $val . '"';
			}
			$fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
		
		//echo $fieldvalueLikeSearch;die(); 
		
		$ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
		$ISACondition = " AND bo_application_flow_logs.application_status='ISA' ";
		
		/* A comman query to calculated count of records mattching with passed dynamic variable */
		$sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) 
		$submissionCondition
		$fromToDateCondition
		$ISACondition		
		$fieldvalueLikeSearch
		$satusCondition		
		";
		//die();
		
		
		if ($resultFor == "stateSubmitted") { 
	   
		}
           //  echo $sql; die;
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
			
        // Direct count based on fields   
        if ($inquireAbout == ""){
            return @$Fields[0]['total'];
        } else {
        //  count based on json fields into field_value field   
           if(isset($Fields) && !empty($Fields)){
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {                           
                            if($inquireAbout!="ntrofunit"){
								foreach ($total->$inquireAbout as $value) { 
									// Count of values start here
									if ($inquireAbout == "invstmnt_in_total") {
										@$totalcount += round($value, 2);
									} else {
										@$totalcount += $value;
									}
								}
                            }else{                                
                               // count of Number starts here - ntrofunit                              
                                if($total->$inquireAbout==$Investmenttype){
                                        $totalcount=$totalcount+1;
                                }
                            }
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }
    

    static function GetTimeTakenInCAF($cafid) {
        //  $cafid="2418";
        $connection = Yii::app()->db;
        // Fetching First entry of applicant while he satrted fillling application
        $sql = "SELECT * FROM bo_application_flow_logs where submission_id='$cafid' AND application_status='IPS' ORDER BY log_id LIMIT 1";

        $command = $connection->createCommand($sql);
        $firstEntryOfApplicantForCaf = $command->queryAll();
        $appDetail = ApplicationExt::getCafTracking($cafid);
        $appDetails = array_merge($firstEntryOfApplicantForCaf, $appDetail);
        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
        //print_r($appDetails);die;
        foreach ($appDetails as $detailoftransaction) {
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['log_id'])) {
                if (@$detailoftransaction['application_status'] == "ISA") {
                    @$status = "Submission of CAF";
                    $comments = "Application Submitted";
                } else {
                    $comments = @$detailoftransaction['approver_comments'];
                    $actionTakenBy = @$detailoftransaction['approval_user_id'];
                    @$status = @$detailoftransaction['application_status'];
                }
                if (@$detailoftransaction['approver_role_id'] == 7) {
                    $role = "District CAF Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 4) {
                    $role = "State CAF Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 33) {
                    $role = "District CAF Approver";
                }
                if (@$detailoftransaction['approver_role_id'] == 34) {
                    $role = "State CAF Approver";
                }
                if (@$detailoftransaction['approver_role_id'] == "") {
                    $role = "Investor";
                }
                if (@$detailoftransaction['application_status'] == "RBI") {
                    @$status = "Reverted to Investor";
                }
                if (@$detailoftransaction['application_status'] == "IBD") {
                    @$status = "Response from Investor";
                    $comments = "Application Re-submitted";
                }
                if (@$detailoftransaction['application_status'] == "F") {
                    $tid = $f = $f + 1;
                    @$status = "Forwarded to Departments for comments, See <a href='$transUrl'>Transaction ID : " . $tid . "</a>";
                }
                if (@$detailoftransaction['application_status'] == "V") {
                    @$status = "Verified";
                }
                if (@$detailoftransaction['application_status'] == "R") {
                    @$status = "Rejected";
                }
                if (@$detailoftransaction['application_status'] == "RBN") {
                    @$status = "Reverted by Approver to Verifier";
                }
                if (@$detailoftransaction['application_status'] == "IPS") {
                    @$status = "Started Filling CAF";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created_date_time'];
                // echo  $c."=".$Time[$c]."<br>";
                $timetaken = "";
                if ($count != 1) {
                    if (!empty($Time[$c])) {
                        $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                        //  echo $timeInString;die;
                        if ($role == "Investor") {
                            $invTime = $invTime + $timeInString;
                        } else {
                            $nodTime = $nodTime + $timeInString;
                            $sql = "SELECT * FROM bo_user where uid='$detailoftransaction[approval_user_id]'";
                            $nodalDetail = Yii::app()->db->createCommand($sql)->queryRow();
                        }
                    }
                }
                $count = $count + 1;
            }
        }
        // print_r($nodalDetail);die;
        $timetakenNod = 0;
        $years = floor($nodTime / (365 * 60 * 60 * 24));
        $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($years * 365) + ($months * 30) + $days;
        $timetakenNod = "$allDays";
        $NODTIME = $timetakenNod;
        //echo  "<hr>".$nodalDetail['full_name']."<hr>".$nodalDetail['mobile']."<hr>".$NODTIME;
        return $NODTIME;
    }

    public static function getDistrictList() {
        $connection = Yii::app()->db;
        $sql = "select district_id,distric_name from bo_district where is_active='Y'";
        $command = $connection->createCommand($sql);
        $districtList = $command->queryAll();
        return $districtList;
    }

    public function actionGetNicCodesByUnit() {
        if (!empty($_POST)) {

            //$unit = $_POST['unit'];

            $unitArr = explode(',', $_POST['unit']);
            $unitStr = implode("','", $unitArr);
            $conditions = "";

            $nic_code = '<option value="All">All NIC Codes</option>';
            $connection = Yii::app()->db;
            if (isset($unitArr) && !empty($unitArr) && $unitArr[0] != "" && $unitArr[0] != "All") {
                $conditions .= "  Industry_Type IN ('$unitStr')";
                $sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where $conditions";
            } else {
                $sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT";
            }

            $command = $connection->createCommand($sql);
            $nicCodeList = $command->queryAll();
            foreach ($nicCodeList as $val) {
                $nic_code .= "<option value='$val[II_DIGIT_Code]'>" . $val['II_DIGIT_Code'] . '-' . $val['Description'] . "</option>";
            }
            echo $nic_code;
        }
        die();
    }

    public function getNicCodeNameBy2DigitCode($code = null) {

        $nic_code = '';
        $connection = Yii::app()->db;
        $sql = "select SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where II_DIGIT_Code = '" . $code . "'";
        $command = $connection->createCommand($sql);
        $nicCode = $command->queryRow();
        return $nicCode['Description'];
    }

    public static function getValueByJsonField($submission_id = null, $fieldValue = null) {
        // Search Query 
        $sql = "SELECT * from bo_application_submission where application_id=1 AND user_id!=11 AND submission_id=$submission_id";
        //Getting values from dattabase as per passed parameters
        $applicationDetail = Yii::app()->db->createCommand($sql)->queryRow();
        $CafFieldValue = (array) json_decode($applicationDetail['field_value']);
        if (isset($CafFieldValue[$fieldValue]))
            return $CafFieldValue[$fieldValue];
        else
            return '';
    }

    /*
     * @authour: Rahul Kumar
     * @date: 02092018
     * @description: MSME Report
     */

    public function actionCategoryWiseReportFY() {

        extract($_GET);
        // Variable Initialization
        $ISAJoin = "";
        //   $ISAJoin = " INNER JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = "";
        if (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date))
            $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";


        //  Detailed 
        $query = "SELECT * FROM bo_application_submission $ISAJoin WHERE 
                field_value LIKE '%\"ntrofunittype\":\"$unit_type\"%' AND 
                application_id = '1' AND  
               user_id != '11' AND  
               bo_application_submission.application_status NOT IN ('I','Z') $ISACondition ORDER BY submission_id DESC";
        $applicationDetail = Yii::app()->db->createCommand($query)->queryAll();



        // District Wise
        $sqlQuery = "SELECT bo_district.distric_name,count(*) as total,
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunit\":\"Services\"%' THEN 1 ELSE 0 END) AS services ,
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunit\":\"Manufacturing\"%' THEN 1 ELSE 0 END) AS manufacturing, 
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunittype\":\"micro\"%' THEN 1 ELSE 0 END) AS micro, 
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunittype\":\"small\"%' THEN 1 ELSE 0 END) AS small, 
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunittype\":\"medium\"%' THEN 1 ELSE 0 END) AS medium, 
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunittype\":\"large\"%' THEN 1 ELSE 0 END) AS large 
                     FROM bo_application_submission LEFT JOIN bo_district ON bo_application_submission.landrigion_id =bo_district.district_id
                    WHERE 
                     application_id = '1' AND  
                    user_id != '11' AND  
                    application_status NOT IN ('I','Z') 
                    group by landrigion_id";
        $districtCategoryWiseDetail = Yii::app()->db->createCommand($sqlQuery)->queryAll();


        // NatureOfUnit Wise
        $sqlQuery2 = "SELECT count(*) as total,
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunit\":\"Services\"%' THEN 1 ELSE 0 END) AS services ,
                     SUM(CASE WHEN application_status='P' THEN 1 ELSE 0 END) AS pending, 
                    SUM(CASE WHEN application_status='F' THEN 1 ELSE 0 END) AS inprogress, 
                    SUM(CASE WHEN application_status='H' THEN 1 ELSE 0 END) AS reverted,  
                    SUM(CASE WHEN application_status='A' THEN 1 ELSE 0 END) AS approved,  
                    SUM(CASE WHEN application_status='R' THEN 1 ELSE 0 END) AS rejected,
                    SUM(CASE WHEN field_value LIKE '%\"ntrofunit\":\"Manufacturing\"%' THEN 1 ELSE 0 END) AS manufacturing 
                    FROM bo_application_submission 
                    WHERE 
                      field_value LIKE '%\"ntrofunittype\":\"$unit_type\"%' AND 
                     application_id = '1' AND  
                    user_id != '11' AND  
                    application_status NOT IN ('I','Z') 
                   ";
        $natureofunitWiseDetail = Yii::app()->db->createCommand($sqlQuery2)->queryRow();

        // Sending data on layout
        $this->render('categorywisereportfy', array(
            'applicationDetail' => $applicationDetail,
            'districtCategoryWiseDetail' => $districtCategoryWiseDetail,
            'natureofunitWiseDetail' => $natureofunitWiseDetail
        ));
    }

    /*
     * @authour: Rahul Kumar
     * @date: 03092018
     * @description : Employment Report
     */

    public function actionEmploymentReport() {

        // Variable Initialization
        // String Initialization 
        $ISAJoin = "";
        $ISACondition = "";
        //Integer Initialization
        $no_of_emp_mskilled = 0;
        $no_of_emp_munskilled = 0;
        $no_of_emp_msupervisory = 0;
        $no_of_emp_mengineer = 0;
        $no_of_emp_it_mprofessional = 0;
        $no_of_emp_mmanagement = 0;
        $no_of_emp_fskilled = 0;
        $no_of_emp_funskilled = 0;
        $no_of_emp_fsupervisory = 0;
        $no_of_emp_fengineer = 0;
        $no_of_emp_it_fprofessional = 0;
        $no_of_emp_fmanagement = 0;
        
        $maleEmp=0;
        $femaleEmp=0;
        //Array Initialization
        $districtData = array();
        // Query Goes here
        $sqlQuery = "SELECT * FROM bo_application_submission $ISAJoin WHERE 
                application_id = '1' AND  
               user_id != '11' AND  
               bo_application_submission.application_status NOT IN ('I','Z') AND landrigion_id!='' $ISACondition ORDER BY submission_id DESC";

        $employmentData = Yii::app()->db->createCommand($sqlQuery)->queryAll();

        // Way to get Employment data
        foreach ($employmentData as $empData) {

            //Getting JSON Data in to array
            $applicationData = (array) json_decode($empData['field_value']);

            // Getting District Id here
            $districtID = @$empData['landrigion_id'];

            // Getting District Wise Male Data
            if (!empty($applicationData['no_of_emp_mskilled'][0]))
                @$districtData[@$districtID]['no_of_emp_mskilled'] += @$applicationData['no_of_emp_mskilled'][0];
            if (!empty($applicationData['no_of_emp_munskilled'][0]))
                @$districtData[@$districtID]['no_of_emp_munskilled'] += @$applicationData['no_of_emp_munskilled'][0];
            if (!empty($applicationData['no_of_emp_msupervisory'][0]))
                @$districtData[@$districtID]['no_of_emp_msupervisory'] += @$applicationData['no_of_emp_msupervisory'][0];
            if (!empty($applicationData['no_of_emp_mengineer'][0]))
                @$districtData[@$districtID]['no_of_emp_mengineer'] += @$applicationData['no_of_emp_mengineer'][0];
            if (!empty($applicationData['no_of_emp_mengineer'][0]))
                @$districtData[@$districtID]['no_of_emp_it_mprofessional'] += @$applicationData['no_of_emp_mengineer'][0];
            if (!empty($applicationData['no_of_emp_mmanagement'][0]))
                @$districtData[@$districtID]['no_of_emp_mmanagement'] += @$applicationData['no_of_emp_mmanagement'][0];
          
            // Getting Total Male Employment
            $maleEmp+=@$applicationData['no_of_emp_mskilled'][0]+@$applicationData['no_of_emp_munskilled'][0]+@$applicationData['no_of_emp_msupervisory'][0]+@$applicationData['no_of_emp_mengineer'][0]+@$applicationData['no_of_emp_mmanagement'][0];

            // Getting District Wise Female Data
            if (!empty($applicationData['no_of_emp_fskilled'][0]))
                @$districtData[@$districtID]['no_of_emp_fskilled'] += @$applicationData['no_of_emp_fskilled'][0];
            if (!empty($applicationData['no_of_emp_funskilled'][0]))
                @$districtData[@$districtID]['no_of_emp_funskilled'] += @$applicationData['no_of_emp_funskilled'][0];
            if (!empty($applicationData['no_of_emp_fsupervisory'][0]))
                @$districtData[@$districtID]['no_of_emp_fsupervisory'] += @$applicationData['no_of_emp_fsupervisory'][0];
            if (!empty($applicationData['no_of_emp_fengineer'][0]))
                @$districtData[@$districtID]['no_of_emp_fengineer'] += @$applicationData['no_of_emp_fengineer'][0];
            if (!empty($applicationData['no_of_emp_it_fprofessional'][0]))
                @$districtData[@$districtID]['no_of_emp_it_fprofessional'] += @$applicationData['no_of_emp_it_fprofessional'][0];
            if (!empty($applicationData['no_of_emp_fmanagement'][0]))
                @$districtData[@$districtID]['no_of_emp_fmanagement'] += @$applicationData['no_of_emp_fmanagement'][0];
            
            // Getting Total Female Employment
            $femaleEmp+=@$applicationData['no_of_emp_fskilled'][0]+@$applicationData['no_of_emp_funskilled'][0]+@$applicationData['no_of_emp_fsupervisory'][0]+@$applicationData['no_of_emp_fengineer'][0]+@$applicationData['no_of_emp_it_fprofessional'][0]+@$applicationData['no_of_emp_fmanagement'][0];
        }
        

       

        $this->render('employmentReport',array('districtData'=>$districtData,'maleEmp'=>$maleEmp,'femaleEmp'=>$femaleEmp));
    }
	
	 public function actionCafLandReport(){
				
			$sql="SELECT * FROM bo_application_submission 
                              left join bo_district on bo_application_submission.landrigion_id = bo_district.district_id
                              where application_status = 'A' AND user_id NOT IN ('11') AND application_id=1";	  
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$result = $command->queryAll(); 	
			
			$this->render('cafLandReport',array('result'=>$result)); 
		
		 }


}
