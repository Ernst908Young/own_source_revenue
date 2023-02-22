<?php
class ApplicationV2Ext {
    /*
      @author : Rahul Kumar
      @param:distID,ResultFor
      @return:count
      @date:21-02-2018
     */

    public static function getConsolidatedCafStatusCount($distID = null, $resultFor = null) {
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
            $actionStatus = "'A','H','R','P','F'";
        }
        
        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
        
            // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
           
			
			
            $fromToDateCondition="";
			if(isset($_POST['financial_year'])) {
			$financial_year=$_POST['financial_year']; //print_r($financial_year); //die;
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			}
			else{
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(application_created_date)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(application_created_date)<='".$enddate."'";
            }
            // Manufacturing Or Services
          //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 

            $fieldvalueLikeSearch="";
            extract($_GET);
            if(isset($castCategory)){ $fieldvalueCase='"org_category":"'.$castCategory.'"'; 
            $fieldvalueLikeSearch=" AND field_value LIKE '%$fieldvalueCase%' "; 
            }
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission WHERE landrigion_id IN ($distID) AND application_id='1' AND application_status IN ($actionStatus) AND Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND user_id NOT IN ($demoUserID) $fromToDateCondition";
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
	
	
	public static function getConsolidatedCafStatusCountISA_old($distID = null, $resultFor = null, $unit_type = null,$from_date=null,$to_date=null) {
	
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

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
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
            $countOrField = " field_value ";
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
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

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        
       
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)<='" . $to_date . "'";
        }
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
         if(!empty($unit_type)){             
             $fieldvalueCase = '"ntrofunittype":"' . $unit_type . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
        
	 	$ISACondition ="";
		$ISAJoin = "";
      /*  $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
		if(isset($from_date) && isset($to_date)) {
			$ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";
		} */
        /* A comman query to calculated count of records mattching with passed dynamic variable */
     /*   echo $sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE 	bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition"; */
					  
			// without ISA	
			
		$sql = "select submission_id
				from bo_application_submission 
				INNER JOIN bo_application_verification_level as avl ON avl.app_Sub_id = bo_application_submission.submission_id
				where bo_application_submission.user_id!=11 
				and bo_application_submission.landrigion_id IN($distID)
				and bo_application_submission.application_status IN ('A','H','R','P','F') 
				$fieldvalueLikeSearch
				and bo_application_submission.application_id = 1 
				and bo_application_submission.landrigion_id IS NOT NULL
				GROUP BY avl.app_Sub_id";
		
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
		
		/*print_r($Fields); */
		return $total = count(@$Fields);
		
       
        /* if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
              
            if (isset($Fields) && !empty($Fields)) {
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {                                                            
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                }
                return count(@$totalcount);
            }
        } */
    }
    
      /*
      @author : Rahul Kumar
      @param:distID,ResultFor
      @return:count
      @date:21-02-2018
     */

    public static function getMsConsolidatedCafStatusCount($distID = null, $resultFor = null) {
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
            $actionStatus = "'A','H','R','P','F'";
        }
        
        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
//            $inquireAbout = "ntrofunit";
//              $countOrField=" field_value "; 
//              $Investmenttype="Manufacturing";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
//            $inquireAbout = "ntrofunit";
//            $countOrField=" field_value ";
//            $Investmenttype="Manufacturing";
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
//            $inquireAbout = "ntrofunit";
//              $countOrField=" field_value "; 
//              $Investmenttype="Services";
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
//            $inquireAbout = "ntrofunit";
//            $countOrField=" field_value ";
//            $Investmenttype="Services";
        }
        
            // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
            $fromToDateCondition="";


        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission WHERE landrigion_id IN ($distID) AND field_value LIKE '%$case%' AND application_id='1' AND application_status IN ($actionStatus) AND Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID)  and  app2.next_role_id in($nextRoleID)) AND user_id NOT IN ($demoUserID) $fromToDateCondition";
//           if($resultFor == ""){
         //   echo $sql; die;
//            }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
             
        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
        //  count based on json fields into field_value field   
           if(isset($Fields) && !empty($Fields)){
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {                           
                           
                            foreach ($total->$inquireAbout as $value) { 
                                // Count of values start here
                                if ($inquireAbout == "invstmnt_in_total") {
                                    @$totalcount += round($value, 2);
                                } else {
                                    @$totalcount += $value;
                                }
                             }
                              
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }

       /*
      @author : Rahul Kumar
      @param:userID,
      @return:count
      @date:25-06-2018
      @description : This will bring out count of an application type and Status wise for an Investor 
                     It containes (Inprinciple Approval (CAF) , Existing Unit Registration , Land Allotment applications  )
     */

    public static function ApplicationAndStausWiseCountforAnInvestor($userId=null,$applicationId=null,$status=null,$roleID=null,$financial_year="ALL"){  
        $userIDCondition="";
        
        // For Investor
        if($roleID=="INV"){$userIDCondition=" AND user_id='$userId'";}
        
         //  for Extra condition like other roles eg : role ID 62
        if($roleID=="62"){$userIDCondition="";}   

            $fromToDateCondition="";
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}//print_r($financial_year); //die;
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(application_created_date)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(application_created_date)<='".$enddate."'";
            }		
        
         // Query Starts Here
        $sql="SELECT  count(*) as total FROM bo_application_submission where application_id='$applicationId' $userIDCondition  AND application_status IN ('$status')  $fromToDateCondition";
        $result = Yii::app()->db->createCommand($sql)->queryRow();  
        
        // Returning Result Here
        return @$result['total'];
    }
    
     /*
      @author : Rahul Kumar
      @param:
      @return:count
      @date:25-06-2018
      @description : This will bring out count of an application type and Status wise for an Investor 
                     It containes (Inprinciple Approval (CAF) , Existing Unit Registration , Land Allotment applications  )
     */

    public static function ApplicationAndStausWiseCountforAnInvestorForServices($userId=null,$status=null,$isCAF=null,$roleID=null,$financial_year='ALL'){  
        
        $userIDCondition="";$IsCAFCondition="";$remainingTotal=0;$subSql="";
		    $fromToDateCondition="";
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}//print_r($financial_year); //die;
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(created_on)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(created_on)<='".$enddate."'";
            }
        // Test Service ID
        $serviceID="'200','201'";
        
        // Logic for 
      /*  if($status=="ServiceIncomplete") {
        $status ="'I','PP'";
        
        $subSql="SELECT  count(*) as total FROM bo_sp_applications where app_status IN ('PD') AND sp_app_id NOT IN ($serviceID) $fromToDateCondition ";        
        $resultData = Yii::app()->db->createCommand($subSql)->queryRow(); 
        $remainingTotal=$resultData['total'];
       }else  */
	   if($status=="ServiceIncomplete") {
		    $status ="'I','PP','DP','PD'";
	   }else   
	   if($status=="ServiceInprogress") {
			$status ="'F','PR','PA'";       

			$subSql="SELECT  count(*) as total FROM bo_sp_applications where app_status IN ('PD') AND sp_app_id IN ($serviceID) $userIDCondition  $fromToDateCondition";        
			$resultData = Yii::app()->db->createCommand($subSql)->queryRow(); 
			$remainingTotal=$resultData['total'];         
        } else{
           $status="'$status'";
        }     
        
        // For Investor
        if($roleID=="INV"){$userIDCondition=" AND user_id='$userId' ";}  
        
        //  for Extra condition - DEPT User like other roles eg : role ID 62
        if($roleID=="62"){$userIDCondition="";}    
        
        // Is CAF - It will check either it is with CAF OR without CAF
        if($isCAF=="Y"){ $IsCAFCondition=" AND caf_id !='' "; }
        else{$IsCAFCondition=" AND (caf_id ='' OR caf_id =0)"; }      
        
        // Query Starts Here
        $sql="SELECT  count(*) as total FROM bo_sp_applications where  app_status IN ($status) $userIDCondition  $IsCAFCondition $fromToDateCondition";
        $result = Yii::app()->db->createCommand($sql)->queryRow(); 
        
        // Returning result Count here
        return @$result['total']+$remainingTotal;
        
        //echo $subSql." + ".$sql;
    }
    
     public static function AppliedApplicationByAnInvestor($userId=null,$applicationId=null,$roleID=null,$status=null,$financial_year='ALL'){  
         
			$fromToDateCondition="";
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(application_created_date)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(application_created_date)<='".$enddate."'";
            }$userIDCondition="";
     //  if($applicationId=='1'){ $applicationId="1','8"; }
        // For Investor
        if($roleID=="INV"){$userIDCondition=" AND user_id='$userId'";}
        
         //  for Extra condition like other roles eg : role ID 62
        if($roleID=="62"){$userIDCondition="";}    
        
         // Query Starts Here
        $sql="SELECT  * FROM bo_application_submission where application_id IN ('$applicationId') $userIDCondition $fromToDateCondition";
        $result = Yii::app()->db->createCommand($sql)->queryAll();  
        
        // Returning Result Here
        return @$result;
        
    }
    
      public static function AppliedApplicationByInvestors($userId=null,$applicationId=null,$roleID=null,$status=null,$financial_year='ALL'){  
         
			$fromToDateCondition="";
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(application_created_date)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(application_created_date)<='".$enddate."'";
            }$userIDCondition="";
     //  if($applicationId=='1'){ $applicationId="1','8"; }
        // For Investor
        if($roleID=="INV"){$userIDCondition=" AND user_id='$userId'";}
        
         //  for Extra condition like other roles eg : role ID 62
        if($roleID=="62"){$userIDCondition="";}    
        
        
        $dateWISE="AND bo_application_submission.submission_id IN(select bo_application_flow_logs.submission_id from bo_application_flow_logs where bo_application_flow_logs.application_status='ISA' AND created_date_time>='2017-01-01' )";
         // Query Starts Here
        $sql="SELECT  bo_application_submission.*,bo_application_flow_logs.created_date_time as cdt  FROM bo_application_submission LEFT JOIN bo_application_verification_level on bo_application_submission.submission_id=bo_application_verification_level.app_Sub_id LEFT JOIN bo_application_flow_logs ON bo_application_submission.submission_id=bo_application_flow_logs.submission_id where bo_application_verification_level.next_role_id=4 AND bo_application_submission.application_id IN ('$applicationId') AND bo_application_flow_logs.application_status IN ('ISA') $dateWISE group by bo_application_submission.submission_id";
        $result = Yii::app()->db->createCommand($sql)->queryAll();  
        
        // Returning Result Here
        return @$result;
        
    }
   
    
    static function getDepartmentAndServiceDetail($serviceID){
        
        // Query Starts Here
        /* $sql="SELECT bo_sp_all_applications.app_name,bo_departments.department_name FROM bo_sp_all_applications "
                . " LEFT JOIN sso_service_providers on bo_sp_all_applications.sp_id=sso_service_providers.sp_id "
                . " LEFT JOIN bo_departments on  sso_service_providers.department_id=bo_departments.dept_id"
                . " where app_id = $serviceID "; */
		$sql="SELECT bo_sp_all_applications.app_name,bo_infowizard_issuerby_master.name as department_name,bo_infowizard_issuerby_master.issuerby_id as dept_id FROM bo_sp_all_applications "
                . " LEFT JOIN bo_infowizard_issuerby_master on bo_sp_all_applications.sp_id=bo_infowizard_issuerby_master.issuerby_id "
                . " where service_id = $serviceID ";		
        $result = Yii::app()->db->createCommand($sql)->queryRow();  
        
      //  print_r($result);die;
        // Returning Result Here
        return @$result;
    }
    
      /*
      @author : Rahul Kumar
      @param:userID,status
      @return:count
      @date:19-06-2018
     */
    
    public static function DmsStatusCount($userID,$status){
        // query for geeting count here of a particular staus count uploaded by a particular user
        $sql="select count(*) as total from cdn_dms_documents where user_id=$userID And doc_status='$status'";
        //fetching reult from query 
        $results = Yii::app()->db->createCommand($sql)->queryRow();
        //returning result here
        return @$results['total'];        
    }
    
    public static function getConsolidatedCafStatusCount2($distID = null, $resultFor = null, $from_date = null,$to_date = null) {
        
        //die('kk');
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;
        // For current month activity Report
         $flg=0;
          $ISAJoin="";
          $ISACondition=""; 

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

        /* Getting District Approved Application */
        if ($resultFor == "districtApproved") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'A'";
            $flg=1;
            
        }

        /* Getting State Approved Application */
        if ($resultFor == "stateApproved") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'A'";
             $flg=1;
        }

        /* Getting District Rejected Application */
        if ($resultFor == "districtRejected") {
            $nextRoleID = "'7','33'";
            $actionStatus = "'R'";
             $flg=1;
        }

        /* Getting State Rejected Application */
        if ($resultFor == "stateRejected") {
            $nextRoleID = "'4','34'";
            $actionStatus = "'R'";
             $flg=1;
        }

        /* Getting current District Forwarded Application */
        if ($resultFor == "districtForwarded") {
            $nextRoleID = "'7'";
            $actionStatus = "'F'";
             $flg=1;
        }

        /* Getting current State Forwarded Application */
        if ($resultFor == "stateForwarded") {
            $nextRoleID = "'4'";
            $actionStatus = "'F'";
             $flg=1;
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
             $flg=1;
                     }

        /* Getting current State Reverted Application */
        if ($resultFor == "stateReverted") {
            $nextRoleID = "'4'";
            $actionStatus = "'H'";
             $flg=1;
        }

        /* Getting total District Submitted Application */
        if ($resultFor == "districtSubmitted") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','H','R','P','F'";
          
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
           
        }

        /* Getting current District Submitted Application */
        if ($resultFor == "districtForwardedAndDisposed") {
            $nextRoleID = "'7'";
            $actionStatus = "'A','R','F'";
            $flg=1;
        }

        /* Getting current State Forwarded and Disposed Application */
        if ($resultFor == "stateForwardedAndDisposed") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','R','F'";
            $flg=1;
        }

        // For JSON Value Count  EG: $inquireAbout="invstmnt_in_total";

        /* District - Approved Male Employment */
        if ($resultFor == "districtMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=1;
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
             $flg=1;
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
            $flg=2;
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
             $flg=2;
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
            $flg=2;
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
            $flg=2;
        }
        /* District - Proposed Manufacturing */
        if ($resultFor == "districtProposedManufacturing") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
            $flg=0;
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedManufacturing") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Manufacturing";
            $flg=0;
        }
        /* District - Proposed Service */
        if ($resultFor == "districtProposedService") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
            $flg=0;
        }
        /* State - Proposed Manufacturing */
        if ($resultFor == "stateProposedService") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R','H'";
            $inquireAbout = "ntrofunit";
            $countOrField = " field_value ";
            $Investmenttype = "Services";
            $flg=0;
        }

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        
        if($flg==1){
        // From Date
        if (isset($from_date) && ($from_date !='')) {
            $fromToDateCondition .= " AND DATE(application_updated_date_time)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date) && ($to_date !='')) {
            $fromToDateCondition .= " AND DATE(application_updated_date_time)<='" . $to_date . "'";
        }
        }
        
        if($flg==0){
        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";      
        }
        
        if($flg==2){
        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status NOT IN ('ISA','IPS') group by bo_application_flow_logs.submission_id";      
        }
        
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
       
        
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " field_value LIKE '%$fieldvalueCase%' AND ";
        }
        
        if(isset($distID) && ($distID != "''") && (!empty($distID)) && ($distID != null)){
            $distCondition = " landrigion_id IN ($distID) AND ";
            $distCondition2 = " app1.landrigion_id IN ($distID) AND";
        }else {
            $distCondition = "";
            $distCondition2 = "";
            
        }
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE $distCondition application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where $distCondition2 $fieldvalueLikeSearch app2.next_role_id in($nextRoleID)) AND user_id NOT IN ($demoUserID) $fromToDateCondition $ISACondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        //print_r($sql);die;
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
            //  count based on json fields into field_value field   
            if (isset($Fields) && !empty($Fields)) {
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    // Count of values start here
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {
                                // count of Number starts here - ntrofunit                              
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }
    
    
     public static function getOverallTimeTakenbyNodal($cafID = null) {

        $connection = Yii::app()->db;

        $sql = "SELECT * FROM bo_application_flow_logs WHERE submission_id=:caf_id AND application_status !='IPS' ORDER BY log_id ASC";

        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $cafID, PDO::PARAM_STR);
        $appDetail = $command->queryAll();
        $sql = "SELECT created_on as application_created_date FROM bo_application_verification_level WHERE app_Sub_id=:caf_id and (next_role_id=7 or next_role_id=4)";
        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $caf_id, PDO::PARAM_STR);
        $rs = $command->queryRow();
        array_push($appDetail, $rs);
        
         // Fetching First entry of applicant while he satrted fillling application
             $sql = "SELECT * FROM bo_application_flow_logs where submission_id='$cafID' AND application_status='IPS' ORDER BY log_id LIMIT 1";

        $command = $connection->createCommand($sql);
        $firstEntryOfApplicantForCaf = $command->queryAll(); 
        $appDetails=array_merge($firstEntryOfApplicantForCaf,$appDetail);
        
//print_r($appDetails);
        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
		$typOfApp ='';
        foreach ($appDetails as $detailoftransaction) {
            
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['log_id'])) {
               // echo "+";
                if (@$detailoftransaction['application_status'] == "ISA") {
                    @$status = "Submission of $typOfApp";
                    $comments = "Application Submitted";
                } else {
                    $comments = @$detailoftransaction['approver_comments'];
                    $actionTakenBy = @$detailoftransaction['approval_user_id'];
                    @$status = @$detailoftransaction['application_status'];
                }
                if (@$detailoftransaction['approver_role_id'] == 7) {
                    $role = "District $typOfApp Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 4) {
                    $role = "State $typOfApp Verifier";
                }
                if (@$detailoftransaction['approver_role_id'] == 33) {
                    $role = "District $typOfApp Approver";
                }
                if (@$detailoftransaction['approver_role_id'] == 34) {
                    $role = "State $typOfApp Approver";
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
                    @$status = "Started Filling $typOfApp";
                }
                if (@$status == "Z") {
                    @$status = "<span title='Incomplete forms archived due to delay in submission'>Archived</span>";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created_date_time'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                   // echo $timeInString."--"; 
                    if ($role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                  
//                    $years = floor($timeInString / (365 * 60 * 60 * 24));
//                    $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
//                    $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
//                    $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
//                    $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
//                    $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
//                    $allDays = ($years * 365) + ($months * 30) + $days;
//                    $timetaken = "$allDays days, $hours hrs, $minuts min";
                }
        $count=$count+1;}}
                 // echo $invTime."====".$nodTime; 
                $timetakenInv = 0;
                $years = floor($invTime / (365 * 60 * 60 * 24));
                $months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenInv = "$allDays days";
                $INVTIME = $timetakenInv;


                $timetakenNod = 0;
                $years = floor($nodTime / (365 * 60 * 60 * 24));
                $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenNod = $allDays;
                $NODTIME = $timetakenNod;
            
      
        return $NODTIME;
    }
    
    
    
    
    public static function getConsolidatedCafStatusCountNew($distID = null, $resultFor = null) {
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

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
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
            $countOrField = " field_value ";
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
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

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)<='" . $to_date . "'";
        }
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  $countOrField FROM bo_application_submission WHERE landrigion_id IN ($distID) AND application_id='1' AND application_status IN ($actionStatus) AND Submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND user_id NOT IN ($demoUserID) $fromToDateCondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        //echo "<pre>"; print_r($sql);die;
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
            //  count based on json fields into field_value field   
            if (isset($Fields) && !empty($Fields)) {
                foreach ($Fields as $key => $field) {
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    // Count of values start here
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {
                                // count of Number starts here - ntrofunit                              
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                } //echo @$totalcount;die;
                return @$totalcount;
            }
        }
    }

	
	public static function getConsolidatedCafStatusCountISA($distID = null, $resultFor = null,$unit_type = null,$from_date=null,$to_date=null) {
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

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
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
            $countOrField = " field_value ";
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
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

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        
       
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)<='" . $to_date . "'";
        }
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
         if(!empty($unit_type)){             
             $fieldvalueCase = '"ntrofunittype":"' . $unit_type . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }
        

        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";
        /* A comman query to calculated count of records mattching with passed dynamic variable */
		if($countOrField!=" count(*) as total "){  
		
				$sql = "SELECT  bo_application_submission.submission_id,$countOrField FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_Sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition ";
		
				
		}else{
    
			$sql="SELECT count(*) as total FROM(SELECT  DISTINCT bo_application_submission.submission_id FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_Sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition) as bo_application_submission";    
		//echo "<br/><br/><br/>";					  
		}
//        if ($resultFor == "districtSubmitted") {
//              echo $sql; die;
//        }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        // Direct count based on fields   
        if ($inquireAbout == "") {
            return @$Fields[0]['total'];
        } else {
            //  count based on json fields into field_value field   
            $submissionArray=array();
            if (isset($Fields) && !empty($Fields)) {
                
                foreach ($Fields as $key => $field) {
                    if(!empty($field['submission_id']) && !in_array($field['submission_id'],$submissionArray)){
                        $submissionArray[]=$field['submission_id'];
                        
                    if (isset($field['field_value'])) {
                        $total = json_decode($field['field_value']);
                        if (isset($total->$inquireAbout)) {
                            if ($inquireAbout != "ntrofunit") {
                                foreach ($total->$inquireAbout as $value) {
                                    // Count of values start here
                                    if ($inquireAbout == "invstmnt_in_total") {
                                        @$totalcount += round($value, 2);
                                    } else {
                                        @$totalcount += $value;
                                    }
                                }
                            } else {
                                // count of Number starts here - ntrofunit                              
                                if ($total->$inquireAbout == $Investmenttype) {
                                    $totalcount = $totalcount + 1;
                                }
                            }
                        }
                    }
                }
                } 
                return @$totalcount;
            }
        }
    }
	
	public static function getConsolidatedCafStatusCountISAArray($distID = null, $resultFor = null,$unit_type = null,$from_date=null,$to_date=null) {
        $totalcount = 0;
        // Demo ID's 
        $demoUserID = "'11'";

        // Passed District ID
        $distID = "'$distID'";

        // Geting Result For json Field
        $inquireAbout = "";

        // Initializartion of investment type
        $Investmenttype = 0;

        // It will return count Or A fields Array bassed on the passed Value :  count(*) as total /  field_value 
        $countOrField = " count(*) as total ";

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
            $actionStatus = "'A','H','R','P','F'";
        }

        /* Getting total State Submitted Application */
        if ($resultFor == "stateSubmitted") {
            $nextRoleID = "'4'";
            $actionStatus = "'A','H','R','P','F'";
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
            $countOrField = " field_value ";
        }

        /* State - Approved Male Employment */
        if ($resultFor == "stateMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Approved female Employment */
        if ($resultFor == "districtFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Approved female Employment */
        if ($resultFor == "stateFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Approved Investment */
        if ($resultFor == "districtInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* State - Approved Investment */
        if ($resultFor == "stateInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'A'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }

        /* District - Proposed Male Employment */
        if ($resultFor == "districtProposedMaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Male Employment */
        if ($resultFor == "stateProposedMaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_mtotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Female Employment */
        if ($resultFor == "districtProposedFemaleEmployment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* State - Proposed Female Employment */
        if ($resultFor == "stateProposedFemaleEmployment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "no_of_emp_ftotal";
            $countOrField = " field_value ";
        }

        /* District - Proposed Investment */
        if ($resultFor == "districtProposedInvestment") {
            $nextRoleID = "'7'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
        }
        /* State - Proposed Investment */
        if ($resultFor == "stateProposedInvestment") {
            $nextRoleID = "'4'";
            $actionStatus = "'P','F','A','R'";
            $inquireAbout = "invstmnt_in_total";
            $countOrField = " field_value ";
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

        // Financial Year OR From Date - To Date   // As per anand Sir , I am using created_date here for all calculation
        extract($_GET);
        $fromToDateCondition = "";
        // From Date
        if (isset($from_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)>='" . $from_date . "'";
        }
        // To Date
        if (isset($to_date)) {
            $fromToDateCondition .= " AND DATE(application_created_date)<='" . $to_date . "'";
        }
        // Manufacturing Or Services
        //  $typeofInvestment="Services";
//           if(isset($typeofInvestment)){
//             $inquireAbout = "ntrofunit";
//             $countOrField=" field_value ";
//            $Investmenttype=$typeofInvestment; 
//            } 
        $fieldvalueLikeSearch = "";
        extract($_GET);
        if (isset($castCategory)) {
            $fieldvalueCase = '"org_category":"' . $castCategory . '"';
            $fieldvalueLikeSearch = " AND field_value LIKE '%$fieldvalueCase%' ";
        }

        $ISAJoin = " LEFT JOIN bo_application_flow_logs on bo_application_submission.submission_id=bo_application_flow_logs.submission_id ";
        $ISACondition = " AND DATE(bo_application_flow_logs.created_date_time)>='$from_date' AND DATE(bo_application_flow_logs.created_date_time)<='$to_date' AND bo_application_flow_logs.application_status='ISA'";
        /* A comman query to calculated count of records mattching with passed dynamic variable */
        $sql = "SELECT  bo_application_submission.submission_id FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();

        
                return @$Fields;
                
                
          
        
    }
	
	public static function SubFormApplication($userId=null,$applicationId=null,$roleID=null,$status=null,$financial_year='ALL'){  
         
			$fromToDateCondition="";
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(application_created_date)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(application_created_date)<='".$enddate."'";
            }$userIDCondition="";
     //  if($applicationId=='1'){ $applicationId="1','8"; }
        // For Investor
        if($roleID=="INV"){$userIDCondition=" AND user_id='$userId'";}
        
         //  for Extra condition like other roles eg : role ID 62
        if($roleID=="62"){$userIDCondition="";}    
        
         // Query Starts Here
        $sql="SELECT  * FROM bo_new_application_submission where 1=1 $userIDCondition $fromToDateCondition";
        $result = Yii::app()->db->createCommand($sql)->queryAll();  
        
        // Returning Result Here
        return @$result;
        
    }
	public static function getInfowizServiceDetails($infowizServiceID = null) {
	
		$sql ="select bo_information_wizard_service_parameters.core_service_name as infowiz_service_name,bo_infowizard_issuerby_master.name as infowiz_department_name,bo_information_wizard_service_parameters.swcs_service_id from bo_information_wizard_service_master INNER JOIN  bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.issuerby_id = bo_information_wizard_service_master.issuerby_id 
		INNER JOIN bo_information_wizard_service_parameters ON bo_information_wizard_service_parameters.service_id= bo_information_wizard_service_master.id
		where bo_information_wizard_service_master.id=SUBSTRING_INDEX($infowizServiceID, '.', 1) 
		AND bo_information_wizard_service_parameters.service_id AND bo_information_wizard_service_parameters.servicetype_additionalsubservice=SUBSTRING_INDEX(SUBSTRING_INDEX($infowizServiceID,'.', 2), '.',-1)
		AND bo_information_wizard_service_parameters.is_active='Y'";
		
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$resDept = $command->queryRow();
		return $resDept;
	}
	
	public static function NewCAFAndStausWiseCountforAnInvestor($userId=null,$application_id=null,$status=null,$roleID=null,$financial_year="ALL"){  
        $userIDCondition="";
        
        // For Investor
        if($roleID=="INV"){
			$userIDCondition=" AND bo_new_application_submission.user_id='$userId'";
		}
		$fromToDateCondition="";
		
		if($financial_year=="ALL"){
			$startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); 
		}
		else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
		}		
		else{
			$fDate = date('Y-m-d');
			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d');
		}

		$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
		 // From Date
		if(isset($startdate)){
			$fromToDateCondition .= " AND DATE(bo_new_application_submission.application_created_date)>='".$startdate."'";
		}
		// To Date
		if(isset($enddate)){
			$fromToDateCondition .= " AND DATE(bo_new_application_submission.application_created_date)<='".$enddate."'";
		}	        
        //Query Starts Here
		if($status=='I')
		$status = " AND bo_new_application_submission.application_status IN ('I','DP','PD') ";
		else
		$status = " AND bo_new_application_submission.application_status IN ('$status') ";	
	
			
		$sql="SELECT count(*) as total FROM bo_new_application_submission 
		INNER JOIN bo_sp_applications on bo_sp_applications.app_id=bo_new_application_submission.submission_id 
		where bo_new_application_submission.application_id='12' AND bo_new_application_submission.service_id='591.0' AND bo_sp_applications.sp_app_id='419' $status $fromToDateCondition $userIDCondition";
		
        $result = Yii::app()->db->createCommand($sql)->queryRow();  
		
        


        // Returning Result Here
        return @$result['total'];
    }



    public  static function newCafGetOverallTimeTakenbyNodal($cafID = null) {

        $connection = Yii::app()->db;

        $sql = "SELECT bo_infowiz_form_builder_application_log.*,bo_user_role_mapping.role_id FROM bo_infowiz_form_builder_application_log 
        LEFT JOIN bo_user_role_mapping on bo_infowiz_form_builder_application_log.department_user_id=bo_user_role_mapping.user_id 
        WHERE app_Sub_id=:caf_id AND action_status !='P' ORDER BY id ASC";

        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $cafID, PDO::PARAM_STR);
        $appDetail = $command->queryAll();
        $sql = "SELECT created_on as application_created_date FROM bo_infowiz_formbuilder_application_forward_level WHERE app_Sub_id=:caf_id and (next_role_id=7 or next_role_id=4)";

        //echo $sql;die;

        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $caf_id, PDO::PARAM_STR);
        $rs = $command->queryRow();
        array_push($appDetail, $rs);

       // print_r($appDetail);die;

         // Fetching First entry of applicant while he satrted fillling application
             $sql = "SELECT *,bo_user_role_mapping.role_id,min(created) as application_created_date FROM bo_infowiz_form_builder_application_log 
 LEFT JOIN bo_user_role_mapping on bo_infowiz_form_builder_application_log.department_user_id=bo_user_role_mapping.user_id 
             where app_Sub_id='$cafID' AND action_status='P' ORDER BY id LIMIT 1";

        $command = $connection->createCommand($sql);
        $firstEntryOfApplicantForCaf = $command->queryAll(); 
        $appDetails=array_merge($firstEntryOfApplicantForCaf,$appDetail);
        
      //  print_r($appDetails);
        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
        $typOfApp ='';
        foreach ($appDetails as $detailoftransaction) {
            
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['role_id'], $departmentRole) && !empty(@$detailoftransaction['id'])) {
           //   if($detailoftransaction['department_user_id']>0){
               // echo "+";die;
                if (@$detailoftransaction['action_status'] == "P") {
                    @$status = "Submission of $typOfApp";
                    $comments = "Application Submitted";
                } else {
                    $comments = @$detailoftransaction['approver_comments'];
                    $actionTakenBy = @$detailoftransaction['approval_user_id'];
                    @$status = @$detailoftransaction['action_status'];
                }
                if (@$detailoftransaction['role_id'] == 7) {
                    $role = "District $typOfApp Verifier";
                }
                if (@$detailoftransaction['role_id'] == 4) {
                    $role = "State $typOfApp Verifier";
                }
                if (@$detailoftransaction['role_id'] == 33) {
                    $role = "District $typOfApp Approver";
                }
                if (@$detailoftransaction['role_id'] == 34) {
                    $role = "State $typOfApp Approver";
                }
                if (@$detailoftransaction['role_id']<1) {
                    $role = "Investor";
                }
                if (@$detailoftransaction['action_status'] == "RBI") {
                    @$status = "Reverted to Investor";
                }
                if (@$detailoftransaction['action_status'] == "IBD") {
                    @$status = "Response from Investor";
                    $comments = "Application Re-submitted";
                }
                if (@$detailoftransaction['action_status'] == "F") {
                    $tid = $f = $f + 1;
                    @$status = "Forwarded to Departments for comments, See <a href='$transUrl'>Transaction ID : " . $tid . "</a>";
                }
                if (@$detailoftransaction['action_status'] == "V") {
                    @$status = "Verified";
                }
                if (@$detailoftransaction['action_status'] == "R") {
                    @$status = "Rejected";
                }
                if (@$detailoftransaction['action_status'] == "RBN") {
                    @$status = "Reverted by Approver to Verifier";
                }
                if (@$detailoftransaction['action_status'] == "IPS") {
                    @$status = "Started Filling $typOfApp";
                }
                if (@$status == "Z") {
                    @$status = "<span title='Incomplete forms archived due to delay in submission'>Archived</span>";
                }
                $c = $count - 1;
                // echo $role."<br>"; 
                $Time[$c] = $detailoftransaction['created'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                  
                    if ($role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                  
//             
                }
        $count=$count+1;}}
                 // echo $invTime."====".$nodTime; 
                $timetakenInv = 0;
                $years = floor($invTime / (365 * 60 * 60 * 24));
                $months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenInv = "$allDays days";
                $INVTIME = $timetakenInv;


                $timetakenNod = 0;
                $years = floor($nodTime / (365 * 60 * 60 * 24));
                $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenNod = $allDays;
                $NODTIME = $timetakenNod;
            
      
        return  $NODTIME;
    }
	
	 public static function getNICCodeWiseProject($startDate = "", $endDate = "") {

         // Getting II digit code here
        $total_investment = 0;
        $services = array();
        $sql = "select II_DIGIT_Code,Description from NIC_II_DIGIT";
        $FieldsVal = Yii::app()->db->createCommand($sql)->queryAll();
        
        // making in key value format for furthur use       
        foreach ($FieldsVal as $tg) {
            $digit2keyval[$tg['II_DIGIT_Code']] = $tg['Description'];
        }
        
        // Getting All CAF Detail
        if (isset($startDate) && ($startDate != '') && isset($endDate) && ($endDate != '') && !empty($startDate) && !empty($endDate)) {
            $dateCondition = " AND DATE(bo_application_submission.application_created_date)>='" . @$startDate . "' AND DATE(bo_application_submission.application_created_date)<='" . @$endDate . "'";
        } else {
            $dateCondition = "";
        }
       
        $sql = "SELECT field_value from bo_application_submission INNER JOIN bo_application_flow_logs ON bo_application_submission.submission_id=bo_application_flow_logs.submission_id where bo_application_flow_logs.application_status ='ISA' AND bo_application_submission.application_status in ('A') AND bo_application_submission.user_id not in('11') AND bo_application_submission.application_id=1 $dateCondition group by bo_application_flow_logs.submission_id";
        $Fields = Yii::app()->db->createCommand($sql)->queryAll();
        if ($Fields === false)
            return false;        
        
        
        // print_r($digit2keyval);die;
        foreach ($Fields as $key => $field) {
            if (isset($field['field_value'])) {
                $totalmaleemp = json_decode($field['field_value'], true);

                if (isset($totalmaleemp['industry_type'])) {

                    $twodigit = substr($totalmaleemp['industry_type'], 0, 2);
                    if (isset($totalmaleemp['invstmnt_in_total']) && $totalmaleemp['invstmnt_in_total'] != '') {
                        $ur = $totalmaleemp['ntrofunit'];

                        if (!isset($gj[$ur])) {
                            $gj[$ur] = array();
                        }
                        if (!isset($gj[$ur][$twodigit])) {
                            $gj[$ur][$twodigit] = array();
                        }
                        if (!isset($gj[$ur][$twodigit]['tot'])) {
                            $gj[$ur][$twodigit]['tot'] = 0;
                        }
                        if (!isset($gj[$ur][$twodigit]['inv'])) {
                            $gj[$ur][$twodigit]['inv'] = 0;
                        }
                        if (!isset($gj[$ur][$twodigit]['name'])) {
                            $gj[$ur][$twodigit]['name'] = "";
                        }
                        if (!isset($gj[$ur][$twodigit]['emp'])) {
                            $gj[$ur][$twodigit]['emp'] = 0;
                        }
                        $gj[$ur][$twodigit]['name'] = "";
                        if ($twodigit > 0) {
                            $gj[$ur][$twodigit]['name'] = @$digit2keyval[$twodigit];
                        }
                        $gj[$ur][$twodigit]['tot'] += 1;
                        $gj[$ur][$twodigit]['inv'] = $gj[$ur][$twodigit]['inv'] + $totalmaleemp['invstmnt_in_total'][0];
                        $gj[$ur][$twodigit]['emp'] = $gj[$ur][$twodigit]['emp'] + @$totalmaleemp['no_of_emp_mtotal'][0]+@$totalmaleemp['no_of_emp_ftotal'][0];
                    }
                }
            }
        }
        
      //  print_r($gj); die;

        // Manufacturing Key for sorting format
        if(!empty($gj['Manufacturing'])){
        foreach ($gj['Manufacturing'] as $key => $row) {
            $row['code'] = $key;
            $manufac[] = $row;
        }}

        // Service Key for sorting format
        if(!empty($gj['Services'])){
        foreach ($gj['Services'] as $key => $row) {
            $row['code'] = $key;
            $services[] = $row;
        }}
        // Manufacturing Inv SORT DESC
        if(!empty($manufac)){
        foreach ($manufac as $key => $row) {
            $vc_array_inv[$key] = $row['inv'];
        }}
        if(!empty($manufac)){
        array_multisort($vc_array_inv, SORT_DESC, $manufac);
        }

        // Services Inv SORT DESC
        if(!empty($services)){
        foreach ($services as $key => $row) {
            $vc_array_inv1[$key] = $row['inv'];
        }}
        
        if(!empty($services)){
        array_multisort($vc_array_inv1, SORT_DESC, $services);
        }

        
        $result['Manufacturing'] = $manufac;
        $result['Services'] = $services;
        
        return $result;
    }
    
    public  static function OverallTimeTakenbyNodalCAf2($cafID = null) {
           // $cafID = $_GET['caf'];
        $connection = Yii::app()->db;

        $sql = "SELECT * FROM bo_infowiz_form_builder_application_log WHERE app_Sub_id=:caf_id ORDER BY id ASC";

        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $cafID, PDO::PARAM_STR);
        $appDetail = $command->queryAll();
        $sql = "SELECT created_on as application_created_date FROM bo_infowiz_formbuilder_application_forward_level WHERE app_Sub_id=:caf_id and (next_role_id=7 or next_role_id=4)";
        $command = $connection->createCommand($sql);
        $command->bindParam(":caf_id", $caf_id, PDO::PARAM_STR);
        $rs = $command->queryRow();
        array_push($appDetail, $rs);
        
         // Fetching First entry of applicant while he satrted fillling application
             $sql = "SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id='$cafID' AND action_status='P' ORDER BY id LIMIT 1";

        $command = $connection->createCommand($sql);
        $firstEntryOfApplicantForCaf = $command->queryAll(); 
        $appDetails=array_merge($firstEntryOfApplicantForCaf,$appDetail);
        
//print_r($appDetails);
        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
		$typOfApp ='';
                //echo '<pre>'; print_r($appDetails);die;
        foreach ($appDetails as $detailoftransaction) {
            
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['id'])) {
               // echo "+";
                if (@$detailoftransaction['application_status'] == "P") {
                    @$status = "Submission of $typOfApp";
                    $comments = "Application Submitted";
                } else {
                    $comments = @$detailoftransaction['verifier_user_comment'];
                    $actionTakenBy = @$detailoftransaction['verifier_user_id'];
                    @$status = @$detailoftransaction['approv_status'];
                }
                if (@$detailoftransaction['action_taken_by_name'] == 'Investor') {
                    $role = "Investor";
                }
                else{
                    $role = "nodal";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                   // echo $timeInString."--"; 
                    if ($role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                  
//                    $years = floor($timeInString / (365 * 60 * 60 * 24));
//                    $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
//                    $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
//                    $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
//                    $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
//                    $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
//                    $allDays = ($years * 365) + ($months * 30) + $days;
//                    $timetaken = "$allDays days, $hours hrs, $minuts min";
                }
        $count=$count+1;}}
                 // echo $invTime."====".$nodTime; 
                $timetakenInv = 0;
                $years = floor($invTime / (365 * 60 * 60 * 24));
                $months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenInv = "$allDays days";
                $INVTIME = $timetakenInv;


                $timetakenNod = 0;
                $years = floor($nodTime / (365 * 60 * 60 * 24));
                $months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                $seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                $allDays = ($years * 365) + ($months * 30) + $days;
                $timetakenNod = $allDays;
                $NODTIME = $timetakenNod;

        return $NODTIME;
    }
}