<?php

class ApplicationCronV2Ext extends User {
    /*
      @author : Rahul Kumar
      @param:distID,ResultFor
      @return:count
      @date:31-07-2018
     */

    public static function getConsolidatedCafStatusCount($distID = null, $resultFor = null) {
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

    /*
      @author : Rahul Kumar
      @param:distID,ResultFor
      @return:count
      @date:21-02-2018
     */

    public static function getMsConsolidatedCafStatusCount($distID = null, $resultFor = null) {
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
        if (isset($typeofInvestment)) {
            $case = '"ntrofunit":"' . $typeofInvestment . '"';
        }

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
            if (isset($Fields) && !empty($Fields)) {
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

    public static function getLandTimeline($ID = null) {
        // $ID='1502';
        $connection = Yii::app()->db;
        // Fetching First entry of applicant while he satrted fillling application
        $sql = "SELECT * FROM bo_application_flow_logs where submission_id='$ID' ORDER BY log_id LIMIT 1";

        $command = $connection->createCommand($sql);
        $appDetails = $command->queryAll();


        $invTime = 0;
        $nodTime = 0;
        $f = 0;
        $count = 1;
        foreach ($appDetails as $detailoftransaction) {
            $departmentRole = array('3', '5');
            if (!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'], $departmentRole) && !empty(@$detailoftransaction['log_id'])) {
                if (@$detailoftransaction['approver_role_id'] == "") {
                    $role = "Investor";
                }
                $c = $count - 1;
                $Time[$c] = $detailoftransaction['created_date_time'];
                $timetaken = "";
                if ($count != 1) {
                    $timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c - 1]));
                    if ($role == "Investor") {
                        $invTime = $invTime + $timeInString;
                    } else {
                        $nodTime = $nodTime + $timeInString;
                    }
                    /* $years = floor($timeInString / (365 * 60 * 60 * 24));
                      $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                      $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                      $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                      $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                      $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                      $allDays = ($years*365)+($months * 30) + $days;
                      $timetaken= "$allDays days, $hours hrs, $minuts min"; */
                }
                $count = $count + 1;
            }
        }

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
        $timetakenNod = "$allDays days";
        $NODTIME = $timetakenNod;

        $result['Inv'] = $INVTIME;
        $result['Nod'] = $NODTIME;

        return $result;
    }

    /* Rahul Kumar : 19072018 */

    public static function getConsolidatedCafStatusCountISA($distID = null, $resultFor = null) {
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
        $sql = "SELECT  $countOrField FROM bo_application_submission $ISAJoin WHERE bo_application_submission.landrigion_id IN ($distID) AND bo_application_submission.application_id='1' AND bo_application_submission.application_status IN ($actionStatus) AND bo_application_submission.submission_id  in(select submission_id from bo_application_submission as app1
                      inner join  bo_application_verification_level as app2  ON app1.submission_id=app2.app_sub_id
                      where app1.landrigion_id IN ($distID) $fieldvalueLikeSearch and app2.next_role_id in($nextRoleID)) AND bo_application_submission.user_id NOT IN ($demoUserID) $ISACondition";
        if ($resultFor == "stateSubmitted") {
            //   echo $sql; die;
        }
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

    /* Rahul Kumar : 19072018 */

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

     /* Rahul Kumar : 19072018 */

    public static function getConsolidatedCafStatusCountISAArray($distID = null, $resultFor = null) {
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
}

?>