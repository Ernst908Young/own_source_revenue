<?php

class AppController extends Controller {

    function init() {

    }

    public function actionIndex() {
        // Utility::sendOTPToMobile('9599424588','Test Message from Hemant Thakur');
        // echo json_encode(array("April"=>"Fool"));
        print_r(Utility::sendEmailTest(EMAIL_HOST, EMAIL_PORT, EMAIL_USERNAME, EMAIL_PASSWORD, "TestEmail", "This is test mail", "mohitsharnic@gmail.com"));
    }


    /// new

    /**
     * This function is used to return Service Report Overall Dashboard Count
     * @author Neha Jaiswal
     * @return json
     *
     *
     */
     public function actionGetGrievanceReportDashboardCount() {
   // echo "test";die;
           $response = array();
   		$roll_allow   = array(62,71,72,73,74);  // 62-HOD , 71-SECRETARY ,72-Principal Secretary ,73- Cheif Secretary ,74-DM
           if ($_SERVER['REQUEST_METHOD'] == 'GET') {
               header('STATUS: Method Not allowed', true, 405);
               $response['STATUS'] = 405;
               $response['ERROR'] = "Method Not Allowed";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
           }
           if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])
   		 && isset($_POST['startdate']) && !empty($_POST['startdate']) && isset($_POST['enddate']) && !empty($_POST['enddate'])
   		 && isset($_POST['department_id']) && !empty($_POST['department_id']) && isset($_POST['district_id']) && !empty($_POST['district_id'])) {
               extract($_POST);
      //print_r($_POST); die;
               $role_id = $_POST['role_id'];
   			$startdate = $_POST['startdate'];
               $enddate = $_POST['enddate'];
   			$deptId=$_POST['department_id'];
   			$distId='ALL';
   			if(($role_id==62 || $role_id==71) && $deptId=='ALL'){  // 62-HOD , 71-SECRETARY
   			$response['STATUS'] = 400;
               $response['MSG'] = "Bad Request";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
               }
   			if($role_id==62 || $role_id==71) {
   			$deptId=$_POST['department_id'];
   			$distId='ALL';
   			}
   			if(($role_id==72 || $role_id==73) && $deptId!='ALL'){  // 62-HOD , 71-SECRETARY
   			$response['STATUS'] = 400;
               $response['MSG'] = "Bad Request";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
               }
   			if($role_id==72 || $role_id==73){ // 72-Principal Secretary ,73- Cheif Secretary
               $deptId='ALL';
   			$distId='ALL';
               }
   			if($role_id==74){ // 74-DM
               $deptId='ALL';
   			$distId=$_POST['district_id'];
               }

               if (!in_array($role_id, $roll_allow)){
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
      //$startdate='2017-04-01';
      //$enddate=date('Y-m-d');
              $finaldata = ApplicationExt::getGrievanceReportDashboardCount($deptId,$distId,$startdate,$enddate);
              // print_r($finaldata);die;
               if (empty($finaldata)) {
                   header('STATUS: 204', true, 204);
                   $response['STATUS'] = 204;
                   $response['MSG'] = "No data Found";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }
               header('STATUS: 200 Ok', true, 200);
               $response['STATUS'] = 200;
               $response['RESPONSE'] = $finaldata;
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
        * This function is used to return Service Report Overall Dashboard Count
        * @author Neha Jaiswal
        * @return json
        *
        *
        */

       public function actionGetServiceReportDashboardCount() {
           // echo "test";die;
           $response = array();
   		$roll_allow   = array(62,71,72,73,74);   // 62-HOD , 71-SECRETARY ,72-Principal Secretary ,73- Cheif Secretary ,74-DM
           if ($_SERVER['REQUEST_METHOD'] == 'GET') {
               header('STATUS: Method Not allowed', true, 405);
               $response['STATUS'] = 405;
               $response['ERROR'] = "Method Not Allowed";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
           }
           if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])
   		&& isset($_POST['startdate']) && !empty($_POST['startdate']) && isset($_POST['enddate']) && !empty($_POST['enddate'])
   		&& isset($_POST['department_id']) && !empty($_POST['department_id']) && isset($_POST['district_id']) && !empty($_POST['district_id']) ) {

               extract($_POST);
             //print_r($_POST); die;
               $role_id = $_POST['role_id'];
   			$deptId=$_POST['department_id'];
   			$distId=$_POST['district_id'];
               $startdate = $_POST['startdate'];
               $enddate = $_POST['enddate'];
               if (!in_array($role_id, $roll_allow)){
                   header('STATUS: 401', true, 401);
                   $response['STATUS'] = 401;
                   $response['MSG'] = "Not Authorised";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }

   			if(($role_id==62 || $role_id==71) && $deptId=='ALL'){  // 62-HOD , 71-SECRETARY
   			       $response['STATUS'] = 400;
               $response['MSG'] = "Bad Request";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
               }
   			if($role_id==62 || $role_id==71) {
   			$deptId=$_POST['department_id'];
   			$distId='ALL';
   			}
   			      if(($role_id==72 || $role_id==73) && $deptId!='ALL'){  // 62-HOD , 71-SECRETARY
       			       $response['STATUS'] = 400;
                   $response['MSG'] = "Bad Request";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }
   			      if($role_id==72 || $role_id==73){ // 72-Principal Secretary ,73- Cheif Secretary
                  $deptId='ALL';
     			        $distId='ALL';
               }
   			      if($role_id==74){ // 74-DM
                 $deptId='ALL';
     			       $distId='ALL'; //$_POST['district_id'] data is not correct in table so we use default value for District (i.e ALL)
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
      //$startdate='2017-04-01';
      //$enddate=date('Y-m-d');
              $finaldata = ApplicationExt::getServiceReportDashboardCount($deptId,$distId,$startdate,$enddate);
              // print_r($finaldata);die;
               if (empty($finaldata)) {
                   header('STATUS: 204', true, 204);
                   $response['STATUS'] = 204;
                   $response['MSG'] = "No data Found";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }
               header('STATUS: 200 Ok', true, 200);
               $response['STATUS'] = 200;
               $response['RESPONSE'] = $finaldata;
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
         * This function is used to return Service Report Overall Dashboard Count
         * @author Jitendra Kumar singh
         * @return json
         *
         *
         */
         public function actionGetReportDashboard() {
            //echo "test";die;
            $response               = array();
            $all_response           = array();
            $roll_allow_for_62_71   = array(62,71);
            $roll_allow             = array(62,71,72,73,74);
            $deptId ='ALL';
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                header('STATUS: Method Not allowed', true, 405);
                $response['STATUS'] = 405;
                $response['ERROR'] = "Method Not Allowed";
                $response['RESPONSE'] = "";
                echo json_encode($response);
                exit;
            }
   if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])
       && isset($_POST['financial_year']) && !empty($_POST['financial_year']) && isset($_POST['department_id']) && !empty($_POST['department_id']) && isset($_POST['district_id']) && !empty($_POST['district_id']) ) {
                extract($_POST);
                 //print_r($_POST); die;
                $role_id       = $_POST['role_id'];
                $department_id = $_POST['department_id'];
                $distId        = $_POST['district_id'];
                // financialYear
                   $sql="SELECT submission_id,application_created_date from bo_application_submission ORDER BY application_created_date";
                   $connection=Yii::app()->db;
                   $command=$connection->createCommand($sql);
                   $datefirst=$command->queryAll();
                   $rer=$datefirst[0]['application_created_date'];
                   $stateProcesed="'0'";
                   $statePending="'0'";
                    $financial_year=$_POST['financial_year']; //print_r($financial_year); //die;

                      if($financial_year=="ALL"){

                             $startdate=date('Y-m-d', strtotime($rer));
                             $enddate  =date('Y-m-d');

                       }else if($financial_year!="ALL"){

                         $data=explode("-",$financial_year);
                         $startdate=$data[0]."-04-01";
                         $enddate=$data[1]."-03-31";
                         $enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
                       }


                // $startdate     = $_POST['startdate'];
               //$enddate       = $_POST['enddate'];
              //  if ($role_id != 2) {
               if (!in_array($role_id, $roll_allow)){
                    header('STATUS: 401', true, 401);
                    $response['STATUS'] = 401;
                    $response['MSG'] = "Not Authorised";
                    $response['RESPONSE'] = "";
                    echo json_encode($response);
                    exit;
                }

                if(($role_id==62 || $role_id==71) && $department_id=='ALL'){  // 62-HOD , 71-SECRETARY


                    // echo $department_id;die;
                       $response['STATUS']   = 400;
                       $response['MSG']      = "Bad Request";
                       $response['RESPONSE'] = "";
                       echo json_encode($response);
                       exit;

                       }

                if (($role_id==72 || $role_id==73) && $department_id!='ALL'){  // 62-HOD , 71-SECRETARY
                       //print_r($_POST); die;
                    $response['STATUS'] = 400;
                    $response['MSG'] = "Bad Request";
                    $response['RESPONSE'] = "";
                    echo json_encode($response);
                    exit;
                 }

                 if($role_id==72 || $role_id==73){ // 72-Principal Secretary ,73- Cheif Secretary
                      $department_id='ALL';
        			        $distId='ALL';
                  }
      			      if($role_id==74){ // 74-DM
                     $department_id='ALL';
        			     //  $distId='ALL'; //$_POST['district_id'] data is not correct in table so we use default value for District (i.e ALL)
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
       //$startdate='2017-04-01';
       //$enddate=date('Y-m-d');
       //echo "test";die;



               $finaldataForwordDepartment    =  ApplicationExt::getForworedReportDashboardCount($startdate,$enddate,$department_id,$distId);

               $serviceReport                 =  ApplicationExt::getServiceReportDashboardCount($department_id,$distId,$startdate,$enddate);

               $grievanceReport               =  ApplicationExt::getGrievanceReportDashboardCount($department_id,$distId,$startdate,$enddate);

               $getServiceCountForTimeline    =  ApplicationExt::getServiceCountForTimelineDashboard($startdate,$enddate,$department_id,$distId,$role_id,$financial_year);

               $getChartDistrictWiseDashboard =  ApplicationExt::getChartDistrictWiseDashboard($startdate,$enddate,$department_id,$distId);

               $getLineChartGrievance         =  ApplicationExt::getLineChartGrievance($startdate,$enddate,$department_id,$distId);

                //echo "<pre/>";
           		  //print_r($getLineChartGrievance);die;

              // $getPieChartCAFPUPStateDistrict=  ApplicationExt::getPieChartCAFPUPStateDistrict($startdate,$enddate,$department_id,$distId);
               //$getPieChartTotalOpenGrievance =  ApplicationExt::getPieChartTotalOpenGrievance($startdate,$enddate,$department_id,$distId);
               // print_r($finaldata);die;
               // print_r($finaldata);die;


                if (empty($finaldataForwordDepartment)){
                    header('STATUS: 204', true, 204);
                    $response['STATUS']   = 204;
                    $response['MSG']      = "No data Found";
                    $response['RESPONSE'] = "";
                    echo json_encode($response);
                    exit;
                }else {
                      $stateDistrictCAF      =$finaldataForwordDepartment['totalStateLevelCAF']+$finaldataForwordDepartment['totalDistrictLevelCAF'];
                      $overallCAF            =$finaldataForwordDepartment['allprocessed']+$finaldataForwordDepartment['allpending']+$finaldataForwordDepartment['districtProcessedWithoutResponseCAF']+$finaldataForwordDepartment['stateProcessedWithoutResponseCAF']+$finaldataForwordDepartment['stateProcessedCAF']+$finaldataForwordDepartment['statePendingCAF'];
                     $finaldataForwordDepartment['allprocessed']+$finaldataForwordDepartment['allpending']+$finaldataForwordDepartment['districtProcessedWithoutResponseCAF'];

                       //$grievanceReport['stateDistrictCAF']          =  $stateDistrictCAF;
                      //$grievanceReport['overallCAF']                =  $overallCAF;
                      //$grievanceReport['CAFdisposedwithoutcomments']= $finaldataForwordDepartment['districtProcessedWithoutResponseCAF']+$finaldataForwordDepartment['stateProcessedWithoutResponseCAF'];
                      ///$grievanceReport['pendingUnderProcessCAFStateDistrict']       = $finaldataForwordDepartment['statePendingCAF']+$finaldataForwordDepartment['allpending'];
                      $getChartDistrictWiseDashboard['CAFdisposedwithoutcomments']     = $finaldataForwordDepartment['districtProcessedWithoutResponseCAF']+$finaldataForwordDepartment['stateProcessedWithoutResponseCAF'];
                      $getChartDistrictWiseDashboard['overallCAF']                     = $overallCAF;
                      //$getPieChartCAFPUPStateDistrict['getPieChartCAFPUPStateDistrict']= $finaldataForwordDepartment['statePendingCAF']+$finaldataForwordDepartment['allpending'];
                      //$getPieChartCAFPUPStateDistrict['statePendingCAF']               = $finaldataForwordDepartment['statePendingCAF'];
                    if($role_id==62 || $role_id==71){
                         /* for CAF */
                       // main url
                       $totalDistrictLevelCAF_url       =Yii::app()->createAbsoluteUrl('mis/hodreport/districtwisenodalcafreport/fID/'.$_POST['financial_year']);
                       $totalStateLevelCAF_url          =Yii::app()->createAbsoluteUrl('mis/CsReport/overallstate/fID/'.$_POST['financial_year']);
                       // district url
                       $allprocessed_url                        =Yii::app()->createAbsoluteUrl('mis/hodreport/disposeddistrict?financial_year='.$_POST['financial_year']);
                       $districtProcessedWithoutResponseCAF_url =Yii::app()->createAbsoluteUrl('mis/CsReport/districtdisposedwithoutcomment/fID/'.$_POST['financial_year']);
                       $districtpendingCAFUnderprocess_url      =Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHod/days/0/daysto/15/bw/'.$_POST['financial_year']);
                       $districtpendingCAF_url                  =Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHod/days/16/daysto/10000/bw/'.$_POST['financial_year']);
                       // end  //

                       // state lavel url
                       $stateProcessedCAF_url           =Yii::app()->createAbsoluteUrl('mis/CsReport/index/fID/'.$_POST['financial_year']);
                   	   $statePendingCAF_url             =Yii::app()->createAbsoluteUrl('mis/CsReport/statedisposedwithoutcomment/fID/'.$_POST['financial_year']);

                       $statependingCAFUnderprocess_url =Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHodState/days/0/daysto/15/bw/'.$_POST['financial_year']);
                   	   //$statependingCAF_url             =Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHodState/days/16/daysto/10000/bw/'.$_POST['financial_year']);
                       /* for SERVICE REPORT */

                       $serviceTotal_url                =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/T/d1/'.$startdate.'/d2/'.$enddate);
                       $services_count_url              =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/P/d1/'.$startdate.'/d2/'.$enddate);

                       $servicePending_url              =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/P/d1/'.$startdate.'/d2/'.$enddate);
                       $ServiceForwarded_url            =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/F/d1/'.$startdate.'/d2/'.$enddate);
                       $ServiceReverted_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/RBI/d1/'.$startdate.'/d2/'.$enddate);
                       $ServiceRejected_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/R/d1/'.$startdate.'/d2/'.$enddate);
                       $ServiceApproved_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/index/d/'.$department_id.'/s/A/d1/'.$startdate.'/d2/'.$enddate);

                      /* END */

                      /* grievanceReport Url Start*/

                      $girvance_total_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/hodindex/d/'.$department_id.'/s/T/d1/'.$startdate.'/d2/'.$enddate);
                      $girvance_open_url  =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/hodindex/d/'.$department_id.'/s/C/d1/'.$startdate.'/d2/'.$enddate);
                      $girvance_close_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/hodindex/d/'.$department_id.'/s/O/d1/'.$startdate.'/d2/'.$enddate);
                      /* END */
                    }elseif ($role_id==72 || $role_id==73) {
                          /* for CAF */
                        // main url
                        $totalDistrictLevelCAF_url               ='';//Yii::app()->createAbsoluteUrl('mis/hodreport/districtwisenodalcafreport/fID/'.$_POST['financial_year']);
                        $totalStateLevelCAF_url                  =Yii::app()->createAbsoluteUrl('mis/CsReport/overallstate/fID/'.$_POST['financial_year']);
                        // district url
                        $allprocessed_url                        =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafDistrictLevel/'.$_POST['financial_year']);
                        $districtProcessedWithoutResponseCAF_url =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafWithoutCommentDistrictLevel/fID/'.$_POST['financial_year']);
                        $districtpendingCAFUnderprocess_url      =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingDistrictLevel/days/0/daysto/15/bw/'.$_POST['financial_year']);
                        $districtpendingCAF_url                  =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingDistrictLevel/days/16/daysto/10000/bw/'.$_POST['financial_year']);
                        // end  //

                        // state lavel url
                        $stateProcessedCAF_url             =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafStateLevel/fID/'.$_POST['financial_year']);
                        $statePendingCAF_url               =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafWithoutCommentStateLevel/fID/'.$_POST['financial_year']);

                        $statependingCAFUnderprocess_url   =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingStateLevel/days/0/daysto/15/bw/'.$_POST['financial_year']);
                       // $statependingCAF_url               =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingStateLevel/days/16/daysto/10000/bw/'.$_POST['financial_year']);
                        /* for SERVICE REPORT */

                        $serviceTotal_url                =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/d/'.$department_id.'/s/T/d1'.$startdate.'/d2/'.$enddate);
                        $services_count_url              =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/s/T/d1/'.$startdate.'/d2/'.$enddate);

                        $servicePending_url              =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/s/P/d1/'.$startdate.'/d2/'.$enddate);
                        $ServiceForwarded_url            =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/d/'.$department_id.'/s/F/d1/'.$startdate.'/d2/'.$enddate);
                        $ServiceReverted_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/d/'.$department_id.'/s/RBI/d1/'.$startdate.'/d2/'.$enddate);
                        $ServiceRejected_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/'.$department_id.'/s/R/d1/'.$startdate.'/d2/'.$enddate);
                        $ServiceApproved_url             =Yii::app()->createAbsoluteUrl('mis/ServiceReport/psindex/d/'.$department_id.'/s/A/d1/'.$startdate.'/d2/'.$enddate);

                       /* END */

                       /* grievanceReport Url Start*/

                       $girvance_total_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/psindex/s/T/d1/'.$startdate.'/d2/'.$enddate);
                       $girvance_open_url  =Yii::app()->createAbsoluteUrl('/mis/GrievanceReport/psindex/s/C/d1/'.$startdate.'/d2/'.$enddate);
                       $girvance_close_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/psindex/s/O/d1/'.$startdate.'/d2/'.$enddate);
                       /* END */
                    }else {
                         /* for CAF */
                      // district url
                      $allprocessed_url                        =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafDistrictLevel?financial_year'.$_POST['financial_year'].'&&did='.$_POST['district_id']);
                      $districtProcessedWithoutResponseCAF_url =Yii::app()->createAbsoluteUrl('mis/psCsReport/disposedCafWithoutCommentDistrictLevel/fID/'.$_POST['financial_year'].'?did='.$_POST['district_id']);
                      $districtpendingCAFUnderprocess_url      =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingDistrictLevel/days/0/daysto/15/bw/'.$_POST['financial_year'].'?did='.$_POST['district_id']);
                      $districtpendingCAF_url                  =Yii::app()->createAbsoluteUrl('mis/psCsReport/pendingDistrictLevel/days/16/daysto/10000/bw/'.$_POST['financial_year'].'?did='.$_POST['district_id']);
                      // end  //

                      /* grievanceReport Url Start*/

                      $girvance_total_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/psindex/s/T/d1/'.$startdate.'/d2/'.$enddate.'?did='.$_POST['district_id']);
                      $girvance_open_url  =Yii::app()->createAbsoluteUrl('/mis/GrievanceReport/psindex/s/C/d1/'.$startdate.'/d2/'.$enddate.'?did='.$_POST['district_id']);
                      $girvance_close_url =Yii::app()->createAbsoluteUrl('mis/GrievanceReport/psindex/s/O/d1/'.$startdate.'/d2/'.$enddate.'?did='.$_POST['district_id']);
                      /* END */
                    }


                if($role_id==62 || $role_id==71 || $role_id==72 || $role_id==73){
                          // main url
                          $finaldataForwordDepartment['totalDistrictLevelCAF_url']      = $totalDistrictLevelCAF_url;
                          $finaldataForwordDepartment['totalStateLevelCAF_url']         = $totalStateLevelCAF_url;
                           // district url
                           $finaldataForwordDepartment['allprocessed_url']                         = $allprocessed_url;
                           $finaldataForwordDepartment['districtProcessedWithoutResponseCAF_url']  = $districtProcessedWithoutResponseCAF_url;
                           $finaldataForwordDepartment['districtpendingCAFUnderprocess_url']       = $districtpendingCAFUnderprocess_url;
                           $finaldataForwordDepartment['districtpendingCAF_url']                   = $districtpendingCAF_url;
                         // end //

                           // state lavel url //

                              $finaldataForwordDepartment['stateProcessedCAF_url']          = $stateProcessedCAF_url;
                              $finaldataForwordDepartment['statePendingCAF_url']            = $statePendingCAF_url;
                              $finaldataForwordDepartment['statependingCAFUnderprocess_url']= $statependingCAFUnderprocess_url;
                              //$finaldataForwordDepartment['statependingCAF_url']            = $statependingCAF_url;

                           /* for CAF  End */

                            /* for SERVICE REPORT */
                            $serviceReport['ServiceTotal_url']   =$serviceTotal_url;
                            $serviceReport['Services_count_url'] =$services_count_url;

                            $serviceReport['ServicePending_url']   =$servicePending_url;
                            $serviceReport['ServiceForwarded_url'] =$ServiceForwarded_url;
                            $serviceReport['ServiceReverted_url']  =$ServiceReverted_url;
                            $serviceReport['ServiceRejected_url']  =$ServiceRejected_url;
                            $serviceReport['ServiceApproved_url']  =$ServiceApproved_url;

                           /* END */

                         /* grievanceReport Url Start*/

                         $grievanceReport['girvance_total_url']  =$girvance_total_url;
                         $grievanceReport['girvance_open_url']  =$girvance_open_url;
                         $grievanceReport['girvance_close_url']  =$girvance_close_url;

                           /* End */

                   }else{

                     //  CAF url
                     $finaldataForwordDepartment['allprocessed_url']                         = $allprocessed_url;
                     $finaldataForwordDepartment['districtProcessedWithoutResponseCAF_url']  = $districtProcessedWithoutResponseCAF_url;
                     $finaldataForwordDepartment['districtpendingCAFUnderprocess_url']       = $districtpendingCAFUnderprocess_url;
                     $finaldataForwordDepartment['districtpendingCAF_url']                   = $districtpendingCAF_url;
                   // end //
                     /* grievanceReport Url Start*/

                     $grievanceReport['girvance_total_url']  =$girvance_total_url;
                     $grievanceReport['girvance_open_url']  =$girvance_open_url;
                     $grievanceReport['girvance_close_url']  =$girvance_close_url;

                       /* End */
                   }

                }

              //$getPieChartCAFPUPStateDistrict
              $grievance_Arr=array();
              $cafArr       =array();
              $CAFdisposedwithoutcomments =0;
              $overallCAF =0;
              $grandtotal =0;
               if($getChartDistrictWiseDashboard){
                   $CAFdisposedwithoutcomments = $getChartDistrictWiseDashboard['CAFdisposedwithoutcomments'];
                   $overallCAF                 = $getChartDistrictWiseDashboard['overallCAF'];
                   $grandtotal                 = $getLineChartGrievance['grandtotal'];
                   unset($getChartDistrictWiseDashboard['CAFdisposedwithoutcomments']);
                   unset($getChartDistrictWiseDashboard['overallCAF']);
                   unset($getLineChartGrievance['grandtotal']);

               }
                 //$response['RESPONSE']['grievance_grandtotal']        =  0;
                 $state_lavel =array();

                  header('STATUS: 200 Ok', true, 200);

                  if($getChartDistrictWiseDashboard){
                       $state_lavel['name']        ='state_lavel';
                       $state_lavel['pending']     = $finaldataForwordDepartment['statePendingCAF'];
                       $state_lavel['district_id'] = '';
                       $state_lavel['processed']   =  $finaldataForwordDepartment['stateProcessedCAF'];
                       //$finaldataForwordDepartment['stateProcessedCAF']+$finaldataForwordDepartment['statePendingCAF'];
                      array_push($getChartDistrictWiseDashboard,$state_lavel);
                  }
                  $grievance_Arr=array($getLineChartGrievance);
                  $cafArr       =array($getChartDistrictWiseDashboard);
                  $response['STATUS']   = 200;
                  $response['RESPONSE']['caf_chart_data']              = $cafArr[0];
                  $response['RESPONSE']['grievance_chart_data']        = $grievance_Arr[0];
                  $response['RESPONSE']['caf_data']                    = $finaldataForwordDepartment;
                  $response['RESPONSE']['service_data']                = $serviceReport;
                  $response['RESPONSE']['grievance_data']              = $grievanceReport;
                  $response['RESPONSE']['service_timeline_data']       = $getServiceCountForTimeline;
                  $response['RESPONSE']['CAFdisposedwithoutcomments']  =  $CAFdisposedwithoutcomments;
                  $response['RESPONSE']['overallCAF']                  =  $overallCAF;
                  $response['RESPONSE']['grievance_grandtotal']        =  $grandtotal;

                  //$response['RESPONSE']['getPieChartCAFPUPStateDistrict']= $getPieChartCAFPUPStateDistrict; ['caf_chart_data']
                  //$response['RESPONSE']['getPieChartTotalOpenGrievance'] = $getPieChartTotalOpenGrievance;
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
  //// Jitendra singh Start API for Nodel officer Date 22-feb-2018 ///

         /**
          * This function is used to return Service Report Overall Dashboard Count
          * @author Jitendra Singh
          * @return json
          *
          *
          */

    public function actiongetForwardedCAFListToDepartment() {
              //echo "test";die;
              $response               = array();
              $roll_allow             = array(3,5);
              if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                  header('STATUS: Method Not allowed', true, 405);
                  $response['STATUS'] = 405;
                  $response['ERROR'] = "Method Not Allowed";
                  $response['RESPONSE'] = "";
                  echo json_encode($response);
                  exit;
              }
        if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['access_token']) && !empty($_POST['access_token']) ) {
                  extract($_POST);
                   //print_r($_POST); die;
                  $role_id       = $_POST['role_id'];
                  $user_id       = $_POST['user_id'];
                  $depart        = UserExt::getUserDept($_POST['user_id']);
                  $department_id = $depart['dept_id'];
                 //print_r($department_id);die;
                //  if ($role_id != 2) {
                 if (!in_array($role_id, $roll_allow)){
                      header('STATUS: 401', true, 401);
                      $response['STATUS'] = 401;
                      $response['MSG'] = "Not Authorised";
                      $response['RESPONSE'] = "";
                      echo json_encode($response);
                      exit;
                  }

                  $forwardedCAF    =  ApplicationExt::getForwardedAppOfDept($department_id,$user_id);


                if (empty($forwardedCAF)){
                //  echo "<pre/>";
                  //print_r($forwardedCAF);die;

                  //  header('STATUS: 204', true, 204);
                    // echo "sds";die;
                    $response['STATUS']   = 204;
                    $response['MSG']      = "No data Found";
                    $response['RESPONSE'] = "";
                    echo json_encode($response);

                    exit;
                }else {
                  //'doc_url' =>Yii::app()->createAbsoluteUrl('admin/DownloadDocuments/appDocuments/application/'.base64_encode($data['application_id']).'/user/'.base64_encode($data['user_id']).'/document/'.base64_encode($value['doc_id']))
                  $criteria = new CDbCriteria();
                  $criteria->condition = 'user_id=:user_id';
                  $criteria->condition = 'is_active=1';
               $criteria->params    = array(':user_id'=>$user_id);
                  $criteria->order     = 'id DESC';
                  $criteria->limit     = '1';
               $users_access        = AccessToken::model()->find($criteria);
                  $access_token        = $_POST['access_token'];// $users_access->access_token?$users_access->access_token:'';
                  //$users_access->access_token
                  $forwardedCAF_Array =array();
                  if(isset($forwardedCAF) && !empty($forwardedCAF)){

                      foreach ($forwardedCAF as $key => $forwardedCAF_val) {
                          $forwardedCAF_Array[]   =array(
                            'role_id'=>$forwardedCAF_val['app_sub_id'],
                            'app_sub_id'=>$forwardedCAF_val['app_sub_id'],
                            'application_id'=>$forwardedCAF_val['application_id'],
                            'dept_id'=>$forwardedCAF_val['dept_id'],
                            'forwarded_dept_id'=>$forwardedCAF_val['forwarded_dept_id'],
                            'created_on'=>$forwardedCAF_val['created_on'],
                            'verifier_user_comment'=>$forwardedCAF_val['verifier_user_comment'],
                            'approv_status'=>$forwardedCAF_val['approv_status'],
                            'appr_lvl_id'=>$forwardedCAF_val['appr_lvl_id'],
                            'caf_url'=>Yii::app()->createAbsoluteUrl('admin/applicationView/forwardedApplicationWeb/application_sub_id/'.$forwardedCAF_val['app_sub_id'].'/access_token/'.$access_token),
                          );
                      }

                  }
                //  print_r($forwardedCAF_Array);die;

                  header('STATUS: 200 Ok', true, 200);
                  $response['STATUS']   = 200;
                  $response['farwarded-todepartment-caf'] = $forwardedCAF_Array;
                  echo json_encode($response);
                  exit;
                }

        }else {
            header('STATUS: Bad Request', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "Bad Request";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            return;
        }


 }

 /**
  * This function is used to return Get CAF Detail By ID
  * @author Jitendra Singh
  * @return json
  *
  *
  */

public function actiongetCAFDetailsById() {
      //echo "test";die;
      $response               = array();
      $roll_allow             = array(3,5);
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          header('STATUS: Method Not allowed', true, 405);
          $response['STATUS'] = 405;
          $response['ERROR'] = "Method Not Allowed";
          $response['RESPONSE'] = "";
          echo json_encode($response);
          exit;
      }
if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])  && isset($_POST['application_sub_id']) && !empty($_POST['application_sub_id']) ) {
          extract($_POST);
          // print_r($_POST); die;
          $role_id       = $_POST['role_id'];
          $user_id       = $_POST['user_id'];
        //  $depart        = UserExt::getUserDept($_POST['user_id']);
          //$department_id = $depart['dept_id'];
         //print_r($department_id);die;
        //  if ($role_id != 2) {
         if (!in_array($role_id, $roll_allow)){
              header('STATUS: 401', true, 401);
              $response['STATUS'] = 401;
              $response['MSG'] = "Not Authorised";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;
          }
          $app_sub_id=$_POST['application_sub_id'];
      		$model     =new ApplicationSubmissionExt;
      		$data      =$model->getSubmittedAppviaId($app_sub_id);
      		if(!$data){
              header('STATUS: 204', true, 204);
              $response['STATUS']   = 204;
              $response['MSG']      = "This application does not exist for you.";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;
      		}
          $verifier_docs=array();
      		$docModel=new ApplicationCdnMappingExt;
      		$appName=new ApplicationExt;
      		$appName=$appName->getAppNameViaId($data['application_id']);
      		$docs=$docModel->getApplicationDocuments($data['user_id'],$data['application_id']);
      		$verifier_docs_result=$docModel->getApplicationVerifierDoc($data['user_id'],$data['submission_id']);
          if(!empty($verifier_docs_result)){
              $verifier_docs=   $verifier_docs_result;
          }else {
              $verifier_docs=    array();
          }
             //print_r($data); die;
          //$forwardedCAF    =  ApplicationExt::getForwardedAppOfDept($department_id,$user_id);
        if (empty($data)){
            header('STATUS: 204', true, 204);
            $response['STATUS']   = 204;
            $response['MSG']      = "No data Found";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }else {

          $submmited_data =array();
          if(!empty($data['field_value'])){
             $field_value =json_decode($data['field_value']);
             $data['field_value'] = $field_value;
          }
          $docs_array= array();
          if(!empty($docs)){
                  // backoffice/admin/ApplicationView/downloadapp/id/581/name/CAF
                  //admin/DownloadDocuments/appDocuments/application/'.base64_encode($data['application_id']).'/user/'.base64_encode($data['user_id']).'/document/'.base64_encode($value['doc_id']
              foreach ($docs as $key => $value) {
                if($value['status']===200){
                       $docs_array[] =array(
                         'doc_id'=>$value['doc_id'],
                         'doc_name'=>$value['doc_name'],
                         'doc_url' =>Yii::app()->createAbsoluteUrl('admin/DownloadDocuments/appDocuments/application/'.base64_encode($data['application_id']).'/user/'.base64_encode($data['user_id']).'/document/'.base64_encode($value['doc_id']))
                       );
                   }
              }
           }
          $datas = array('data'=>$data,'docs'=>$docs_array,'verifier_docs'=>$verifier_docs);
          header('STATUS: 200 Ok', true, 200);
          $response['STATUS']   = 200;
          $response['applicationCAFdetailForward'] =$datas;
          echo json_encode($response);
          exit;
        }

}else {
    header('STATUS: Bad Request', true, 400);
    $response['STATUS'] = 400;
    $response['MSG'] = "Bad Request";
    $response['RESPONSE'] = "";
    echo json_encode($response);
    return;
}


}

/**
* @author : Jitendra Kumar Singh
* @date  : 23-feb-2018
*@param :user_id,sub_id,app_id,role_id
*/
public function actionPostCommentByNodalOfficer(){
  $response               = array();
  $roll_allow             = array(3,5);
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      header('STATUS: Method Not allowed', true, 405);
      $response['STATUS'] = 405;
      $response['ERROR'] = "Method Not Allowed";
      $response['RESPONSE'] = "";
      echo json_encode($response);
      exit;
  }
if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['application_id']) && !empty($_POST['application_id'])
 && isset($_POST['application_sub_id']) && !empty($_POST['application_sub_id'])  && isset($_POST['comments']) && !empty($_POST['comments']) ) {
      extract($_POST);
      // print_r($_POST); die;
      $role_id       = $_POST['role_id'];
      $user_id       = $_POST['user_id'];
      $sub_id        = $_POST['application_sub_id'];
      $app_id        = $_POST['application_id'];
      //$comments      =$_POST['comments'];
      $uid           = $user_id;
    extract($_POST);
    if (!in_array($role_id, $roll_allow)){
         header('STATUS: 401', true, 401);
         $response['STATUS'] = 401;
         $response['MSG'] = "Not Authorised";
         $response['RESPONSE'] = "";
         echo json_encode($response);
         exit;
     }
    $dept_id =UserExt::getUserDept($uid);
    $criteria= new CDbCriteria();
    $criteria->condition='app_Sub_id=:sub_id AND forwarded_dept_id=:dept_id';
    $criteria->params   = array(':sub_id'=>$sub_id,":dept_id"=>$dept_id['dept_id']);
    $criteria->order    = 'appr_lvl_id DESC';
    $model = ApplicationForwardLevel::model()->find($criteria);
    if($model->approv_status=='V'){
      //print_r(json_encode(array('STATUS'=>'Error: Already Updated By SomeBody')));
      header('STATUS: Bad Request', true, 400);
      $response['STATUS'] = 400;
      $response['MSG']    = "Already Updated By SomeBody";
      $response['RESPONSE'] = "";
      echo json_encode($response);
      exit;
    }
    $model->verifier_user_comment=$comments;
    $model->comment_date=date('Y-m-d H:m:s');
    $model->approv_status='V';
    $model->verifier_user_id=$uid;
    if($model->save()){
      $appFlow=new ApplicationFlowLogs;
      $user_role_id=RolesExt::getUserRoleViaId($uid);
      $appFlow->submission_id   =$sub_id;
      $appFlow->approver_role_id=$user_role_id['role_id'];
      $appFlow->approval_user_id=$uid;
      $appFlow->approver_comments=$comments;
      $appFlow->created_date_time=date("Y-m-d H:m:s");
      $appFlow->user_agent=$_SERVER['HTTP_USER_AGENT'];
      $appFlow->remote_ip_address=$_SERVER['REMOTE_ADDR'];
      $appFlow->application_status='RB';
      $appFlow->save();
      //print_r(json_encode(array('STATUS'=>'Success: successfully Revert Back')));
      header('STATUS: 200 Ok', true, 200);
      $response['STATUS']   = 200;
      $response['MSG']      = "successfully Revert Back";
      $response['RESPONSE'] = $appFlow;
    //  $response['applicationCAFdetailForward'] =$datas;
      echo json_encode($response);
      exit;
    }
    else{
      header('STATUS: Bad Request', true, 400);
      $response['STATUS']   = 400;
      $response['MSG']      = "Error While Updating";
      $response['RESPONSE'] = "";
      echo json_encode($response);
      exit;
    }

  }else{

      header('STATUS: Bad Request', true, 400);
      $response['STATUS'] = 400;
      $response['MSG'] = "Bad Request";
      $response['RESPONSE'] = "";
      echo json_encode($response);
      return;
  }




}

/**
* @author : Jitendra Kumar Singh
* @date  : 23-feb-2018
*@param :user_id,sub_id,app_id,role_id
*/
    public function actionUploadVerifierDocs(){

        $response               = array();
        $roll_allow             = array(3,5);
        $allowed_file_type      = array('pdf');

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
             $this->generate_api_log($_POST,$response);
            echo json_encode($response);
            exit;

        }
           if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])
           && isset($_POST['application_sub_id']) && !empty($_POST['application_sub_id']) &&  isset($_FILES) && !empty($_FILES) && $_FILES['verifier_files']['error']==0) {

               /// file upload start ///
                       $role_id       = $_POST['role_id'];
                       $uid           = $_POST['user_id'];
                       $sub_id        = $_POST['application_sub_id'];
                       if (!in_array($role_id, $roll_allow)){
                            header('STATUS: 401', true, 401);
                            $response['STATUS'] = 401;
                            $response['MSG'] = "Not Authorised";
                            $response['RESPONSE'] = "";
                             $this->generate_api_log($_POST,$response);
                            echo json_encode($response);
                            exit;
                        }

                      $filename = $_FILES['verifier_files']['name'];
                      $ext = pathinfo($filename, PATHINFO_EXTENSION);
                      if(!in_array($ext,$allowed_file_type) ) {
                        header('STATUS: 401', true, 401);
                        $response['STATUS'] = 401;
                        $response['MSG'] = "Only Pdf File  Allowed.";
                        $response['RESPONSE'] = "";
                         $this->generate_api_log($_POST,$response);
                        echo json_encode($response);
                        exit;
                      }
                        $dept_id =UserExt::getUserDept($uid);
                 				//extract($_POST['ApplicationField']);
                 				$modelRole=new RolesExt;
                 		 		$role_id =$modelRole->getUserRoleViaId($uid);
                 				$imgData =file_get_contents($_FILES['verifier_files']['tmp_name']);
                 				$hash    =hash_hmac('sha1', md5($uid.$sub_id), CDN_PUBLIC_KEY);
                 				$post_data=array('user_id'=>$uid,'app_id'=>$sub_id,'api_hash'=>$hash,'dept_id'=>$dept_id['dept_id'],'doc_name'=>$_FILES['verifier_files']['name'],'verifier_role_id'=>$role_id['role_id'],'doc_type'=>$_FILES['verifier_files']['type'],'doc_size'=>$_FILES['verifier_files']['size'],'doc_blob_data'=>base64_encode($imgData));
                 				$responses=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/saveVerifierDocuments',$post_data));
                 				if($responses->STATUS==200){

                            header('STATUS: 200 Ok', true, 200);
                            $response['STATUS']   = 200;
                            $response['MSG']      = "SuccessFully Uploaded";
                            $response['RESPONSE'] =  $responses->RESPONSE;
                          //  $response['applicationCAFdetailForward'] =$datas;
                             $this->generate_api_log($_POST,$response);
                            echo json_encode($response);
                            exit;

                        }else{
                          header('STATUS: Bad Request', true, 400);
                          $response['STATUS']   = 400;
                          $response['MSG']      = "Error While uploading";
                          $response['RESPONSE'] = $responses->RESPONSE;
                           $this->generate_api_log($_POST,$response);
                          echo json_encode($response);
                          exit;

                        }


                   /// file upload end //



            }else{

                header('STATUS: Bad Request', true, 400);
                $response['STATUS'] = 400;
                $response['MSG'] = "Bad Request";
                $response['RESPONSE'] = "";
                 $this->generate_api_log($_POST,$response);
                echo json_encode($response);
                return;
            }


    }






  


/**
 * This function is used to return Get Grievance Detail By ID
 * @author Jitendra Singh
 * @return json
 * Date :23-Feb-2018
 *
 */

    public function actionGrievanceDetailById() {
         //echo "test";die;
           $response               = array();
           $roll_allow             = array(3,5);
           if ($_SERVER['REQUEST_METHOD'] == 'GET'){
               header('STATUS: Method Not allowed', true, 405);
               $response['STATUS'] = 405;
               $response['ERROR'] = "Method Not Allowed";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
           }
      if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])  && isset($_POST['grievance_id']) && !empty($_POST['grievance_id']) ) {
               //extract($_POST);
               // print_r($_POST); die;
               $role_id       = $_POST['role_id'];
               $user_id       = $_POST['user_id'];
               $grevienceId   = $_POST['grievance_id'];
               //echo  $grevienceId;die;
              if (!in_array($role_id, $roll_allow)){
                   header('STATUS: 401', true, 401);
                   $response['STATUS'] = 401;
                   $response['MSG'] = "Not Authorised";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }
               $rdata = $this->getAllRepliesOfGrievance($grevienceId);
               $replies_data =array();

           		if(!empty($rdata)){

                  foreach($rdata as $key => $replies_array) {
                       $replies_data[] =array(
                         'reply_id'=> $replies_array['reply_id'],
                         'grievance_id'=> $replies_array['grievance_id'],
                         'reply_text'=> $replies_array['reply_text'],
                         'is_bo_reply'=> $replies_array['is_bo_reply'],
                         'replied_by'=> $replies_array['replied_by'],
                         'replied_by_name'=> UserExt::getUNameviaIdMap($replies_array['replied_by']),
                         'created_date_time'=> $replies_array['created_date_time']
                       );

                  }
           		}
               //,"grievanceFor"=>$this->getGrievanceFor($grevienceId)
           $datas['grievanceDetail']= array("replies"=> $replies_data,"grievance"=>$this->loadGrievance($grevienceId),"grievanceDetail"=>$this->getGrevDetail($grevienceId),"ticketDetail"=>$this->getTicketDetail($grevienceId));

             if(empty($datas)){
                 header('STATUS: 204', true, 204);
                 $response['STATUS']   = 204;
                 $response['MSG']      = "No data Found";
                 $response['RESPONSE'] = "";
                 echo json_encode($response);
                 exit;
             }else {
               header('STATUS: 200 Ok', true, 200);
               $response['STATUS']   = 200;
               $response['RESPONSE'] = $datas;
               //$response['grievanceDetail'] =$datas;
               echo json_encode($response);
               exit;
             }

      }else {
         header('STATUS: Bad Request', true, 400);
         $response['STATUS'] = 400;
         $response['MSG'] = "Bad Request";
         $response['RESPONSE'] = "";
         echo json_encode($response);
         return;
      }


  }

/// For Grievance Reply ///

/**
 * This function is used to  Grievance Reply post comment
 * @author Jitendra Singh
 * @return json
 * Date :24-Feb-2018
 *
 */

    public function actionGrievanceReply() {
         //echo "test";die;
           $response               = array();
           $roll_allow             = array(3,5);
           if ($_SERVER['REQUEST_METHOD'] == 'GET'){
               header('STATUS: Method Not allowed', true, 405);
               $response['STATUS']   = 405;
               $response['ERROR']    = "Method Not Allowed";
               $response['RESPONSE'] = "";
               echo json_encode($response);
               exit;
           }
      if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])  && isset($_POST['grievance_id']) && !empty($_POST['grievance_id'])
      && isset($_POST['reply_text']) && !empty($_POST['reply_text'])) {
               //extract($_POST);
               // print_r($_POST); die;
               $role_id       = $_POST['role_id'];
               $user_id       = $_POST['user_id'];
               $grevienceId   = $_POST['grievance_id'];
               $reply_text    = $_POST['reply_text'];
               //echo  $grevienceId;die;
              if (!in_array($role_id, $roll_allow)){
                   header('STATUS: 401', true, 401);
                   $response['STATUS']   = 401;
                   $response['MSG']      = "Not Authorised";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
               }

              $model=new GrievanceReply;
         			$model->grievance_id=$grevienceId;
         			$model->reply_text=htmlspecialchars($reply_text);
         			$model->is_bo_reply="Y";
         			$model->replied_by=$user_id;
         			$model->user_agent=$_SERVER['HTTP_USER_AGENT'];;
         			$model->remote_ip=$_SERVER['REMOTE_ADDR'];;
         			$model->created_date_time=date('Y-m-d H:i:s');
             	if($model->save()){
                $grevModel=Grievance::model()->findByPK($grevienceId);
        				$grevModel->have_replied="Y";
        				$grevModel->save();
        				//Yii::app()->user->setFlash('Success', "Successfully Replied.");
        				$userInfo=UserExt::GetUserInfoFromSSO($grevModel->grievence_created_by);
        				$mobile="";
        				if(is_object($userInfo))
        				$mobile=$userInfo->mobile_number;
        				$role_name=RolesExt::getUserRoleViaId($user_id);
        				$boUserName=UserExt::getUNameviaIdMap($user_id);
        				$msg=$boUserName ."($role_name[role_name]) has just replied on your Grievance (Ticket ID: $grevienceId).";
        				DefaultUtility::sendOTPToMobile($mobile,$msg);
                $result_array['GrievanceReplyDetail'] = array(
                  'reply_text' => htmlspecialchars($reply_text),
                  'grievance_id'=>$grevienceId,
                );
                 header('STATUS: 200 Ok', true, 200);
                 $response['STATUS']   = 200;
                 $response['MSG']      = "Successfully Replied.";
                 $response['RESPONSE'] = $result_array;
                 echo json_encode($response);
                 exit;
              }else{
                 header('STATUS: 204', true, 204);
                 $response['STATUS']   = 204;
                 $response['MSG']      = "No data Found";
                 $response['RESPONSE'] = "";
                 echo json_encode($response);
                 exit;
             }

      }else {
         header('STATUS: Bad Request', true, 400);
         $response['STATUS'] = 400;
         $response['MSG'] = "Bad Request";
         $response['RESPONSE'] = "";
         echo json_encode($response);
         return;
      }


  }




  /**
   * This function is used to  Grievance Close
   * @author Jitendra Singh
   * @return json
   * Date :24-Feb-2018
   *
   */

     public function actionGrievanceClose(){

             $response               = array();
             $roll_allow             = array(3,5);
             if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                 header('STATUS: Method Not allowed', true, 405);
                 $response['STATUS']   = 405;
                 $response['ERROR']    = "Method Not Allowed";
                 $response['RESPONSE'] = "";
                 echo json_encode($response);
                 exit;
             }
        if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])  && isset($_POST['grievance_id']) && !empty($_POST['grievance_id'])
        && isset($_POST['reply_text']) && !empty($_POST['reply_text'])) {
                 //extract($_POST);
                 // print_r($_POST); die;
                 $role_id       = $_POST['role_id'];
                 $uid           = $_POST['user_id'];
                 $grevienceId   = $_POST['grievance_id'];
                 $reply_text    = htmlspecialchars($_POST['reply_text']);
                 //echo  $grevienceId;die;
                if (!in_array($role_id, $roll_allow)){
                     header('STATUS: 401', true, 401);
                     $response['STATUS']   = 401;
                     $response['MSG']      = "Not Authorised";
                     $response['RESPONSE'] = "";
                     echo json_encode($response);
                     exit;
                 }

                 $model=new GrievanceStatusDetail;
                 $grevModel=Grievance::model()->findByPK($grevienceId);
                 if($grevModel===null){

                   header('STATUS: 400', true, 400);
                   $response['STATUS']   = 400;
                   $response['MSG']      ="Sorry Couldn't update";
                   $response['RESPONSE'] = "";
                   echo json_encode($response);
                   exit;
                 }

                 //$grevModel->save();
                 //print_r($grevModel->getErrors());die;
                 if($grevModel->grievance_status!='C'){
                             $grevModel->grievance_status='C';
                             if($grevModel->save()){
                               $model->grievence_no=$grevienceId;
                               $model->status="C";
                               $model->status_change_date=date('Y-m-d H  ');
                               $model->status_changed_by=$uid;
                               $model->remote_ip_address= $_SERVER['REMOTE_ADDR'];
                               $model->user_agent= $_SERVER['HTTP_USER_AGENT'];
                               if($model->save()){
                                 $this->updateReply($grevienceId,$reply_text,'Y',$uid);
                                 header('STATUS: 200', true, 200);
                                 $response['STATUS']   = 200;
                                 $response['MSG']      = "Successfully updated";
                                 $response['RESPONSE'] = "";
                                 echo json_encode($response);
                                 exit;
                               }
                               else{
                                 echo json_encode(array("STATUS"=>204,"RESPONSE"=>"Couldn't generate log"));
                                 exit;
                               }
                             }
                             else{
                               echo json_encode(array("STATUS"=>503,"RESPONSE"=>"Sorry! Could not update."));
                               exit;
                             }
                 }else {
                   echo json_encode(array("STATUS"=>503,"RESPONSE"=>"Sorry!  Allready Close."));
                   exit;
                 }

        }else {
           header('STATUS: Bad Request', true, 400);
           $response['STATUS'] = 400;
           $response['MSG'] = "Bad Request";
           $response['RESPONSE'] = "";
           echo json_encode($response);
           return;
        }


    }

/// END  ///
    private function getAllRepliesOfGrievance($grievance){
      $creteria=new CDbCriteria();
      $creteria->condition="grievance_id=:grievance_id";
      $creteria->params=array(":grievance_id"=>$grievance);
      $reply=GrievanceReply::model()->findAll($creteria);
      return $reply;
    }
    private function loadGrievance($id){
      $deatils =array();
      $model=Grievance::model()->findByPK($id);
      if(!empty($model)){
        $deatils =array(
          'grievence_no'=>$model['grievence_no'],
          'grievence_title'=>$model['grievence_title'],
          'grievence_no'=>$model['grievence_topic'],
          'grievence_topic'=>$model['grievence_title'],
          'grievence_created_by'=>$model['grievence_created_by'],
          'grievence_created_on'=>$model['grievence_created_on'],
          'have_replied'=>$model['have_replied'],
          'grievance_status'=>$model['grievance_status'],
          'grievance_reopen_count'=>$model['grievance_reopen_count'],
        );
      }
      return $deatils;

    }
    private function getGrevDetail($grievence_no){
      $result  = array();
  		$criteria=new CDbCriteria;
  		$criteria->condition="grievence_no=:grievence_no";
  		$criteria->params=array(":grievence_no"=>$grievence_no);
  		$detail=GrievanceDetail::model()->find($criteria);
      if(!empty($detail)){
        $result =array(
          'detail_id'=>$detail['detail_id'],
          'grievence_no'=>$detail['grievence_no'],
          'user_name'=>$detail['user_name'],
          'comapany_name'=>$detail['comapany_name'],
          'mobile_number'=>$detail['mobile_number'],
          'address'=>$detail['address'],
          'zip_code'=>$detail['zip_code'],
          'district_id'=>$detail['district_id'],
          'dept_id'=>$detail['dept_id'],
        );
      }
      //echo "<pre/>";
      //print_r($result);die;
  		return $result;
  	}

    // date 23-feb-2018 jitendra //
  		private function getTicketDetail($grievence_no){
        $result  =array();
  			$criteria=new CDbCriteria;
  			$criteria->condition="grievance_id=:grievence_no";
  			$criteria->params=array(":grievence_no"=>$grievence_no);
  			$detail=GrievanceTicketDetail::model()->find($criteria);
        if(!empty($detail)){
          $result =array(
            'id'=>$detail['id'],
            'grievance_id'=>$detail['grievance_id'],
            'topic_id'=>$detail['topic_id'],
            'user_id'=>$detail['user_id'],
            'ticket_number'=>$detail['ticket_number'],
            'created_date_time'=>$detail['created_date_time'],
          );
        }
        //echo "<pre/>";
        //print_r($result);die;
  			return $result;
  		}

  		private function getGrievanceFor($grievence_no){
        $result  =array();
  			$criteria=new CDbCriteria;
  			$criteria->condition="grievance_id=:grievence_no";
  			$criteria->params=array(":grievence_no"=>$grievence_no);
  			$detail=GrievanceForDetail::model()->find($criteria);
        if(!empty($detail)){
          $result =array(
            'id'=>$detail['id'],
            'grievance_id'=>$detail['grievance_id'],
            'caf_id'=>$detail['caf_id'],
            'user_id'=>$detail['user_id'],
            'ref_number'=>$detail['ref_number'],
            'created_date_time'=>$detail['created_date_time'],
          );
        }

  			return $result;
  		}


      private function updateReply($grievance,$reply_text="NA",$isBoReply='Y',$userId=''){

          $model=new GrievanceReply;
          $model->grievance_id=$grievance;
          $model->reply_text=$reply_text;
          $model->is_bo_reply=$isBoReply;
          $model->replied_by=$userId;
          $model->remote_ip= $_SERVER['REMOTE_ADDR'];
          $model->user_agent= $_SERVER['HTTP_USER_AGENT'];
          $model->created_date_time=date('Y-m-d H:i:s');
          if($model->save())
            return true;
          return false;

      }
  /// end  ////
    function object_to_array($obj) {
      if(is_object($obj)) $obj = (array) $obj;
      if(is_array($obj)) {
          $new = array();
          foreach($obj as $key => $val) {
              $new[$key] = $this->object_to_array($val);
          }
      }
      else $new = $obj;
      return $new;
  }


public function actionGrievanceListForDepartment(){

    $response      = array();
    $grievanceList = array();
    $roll_allow    = array(3,5);
     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('STATUS: Method Not allowed', true, 405);
        $response['STATUS'] = 405;
        $response['ERROR'] = "Method Not Allowed";
        $response['RESPONSE'] = "";
        echo json_encode($response);
        exit;
    }

     if(isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['access_token']) && !empty($_POST['access_token'])){

       $role_id       = $_POST['role_id'];
       $uid           = $_POST['user_id'];
       $access_token  = $_POST['access_token'];
       //$sub_id        = $_POST['application_sub_id'];
       if (!in_array($role_id, $roll_allow)){

            header('STATUS: 401', true, 401);
            $response['STATUS'] = 401;
            $response['MSG'] = "Not Authorised";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;

        }
        $user_email =UserExt::getUserEmail($uid);
        $Alldistt   =UserExt::getUserDistt($user_email['0']);
        $distDept   =UserExt::getUserDistDept($uid);

        $distt=0;
        if(!empty($Alldistt))
          $criteria=new CDbCriteria();
          $distt=implode(",",$Alldistt);
          $criteria->condition="dtl.district_id IN ($distt) AND dtl.dept_id=:dept_id AND t.grievance_reopen_count=0 AND grievance_status='O'";
          $criteria->params=array(":dept_id"=>$distDept['department_id']);
          $criteria->join="inner join bo_grievance_detail dtl on t.grievence_no=dtl.grievence_no";
          $criteria->order="t.grievence_no DESC";
          $grevienceModel=Grievance::model()->findAll($criteria);

		  
		  
          if(!empty($grevienceModel)){

                foreach ($grevienceModel as $key => $grev) {

                  $grievanceList[] =array(
                                      'grievence_no'=>$grev->grievence_no,
                                      'grievence_title'=>$grev->grievence_title,
                                      'dated_on'=>$grev->grievence_created_on,
                                      'distt'=>GrievanceReplyExt::getDisttFromGrievanceId($grev->grievence_no),
                                      'dept'=>GrievanceReplyExt::getDisttFromGrievanceDeptName($grev->grievence_no),
                                      'status'=>$grev->grievance_status,
                                      'url'=>Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate/detailedGrievancesWeb/grievance/'.base64_encode($grev->grievence_no).'/access_token/'.$access_token),
                                    );

                }

                //echo "<pre/>";
                //print_r($grievanceList);die;
                header('STATUS: 200 Ok', true, 200);
                $response['STATUS']   = 200;
                $response['MSG']      = "Girivance List";
                $response['RESPONSE'] =  $grievanceList;
              //  $response['applicationCAFdetailForward'] =$datas;
                echo json_encode($response);
                exit;

              }else{
                  header('STATUS: Bad Request', true, 400);
                  $response['STATUS']   = 400;
                  $response['MSG']      = "Result Not Found.";
                  $response['RESPONSE'] = $grievanceList;
                  echo json_encode($response);
                  exit;

              }

      }else{

          header('STATUS: Bad Request', true, 400);
          $response['STATUS'] = 400;
          $response['MSG'] = "Bad Request";
          $response['RESPONSE'] = "";
          echo json_encode($response);
          return;
      }



}

/**
       * This function is used to generate APP api logs
       * @author : jitendra Singh 
       * @param : string $_POST String Response
       */
    /*  private function generate_api_log($postData, $response) {
          $logModel = new AppAccessLog;
          $user_id  = "0";
          extract($postData);
          $logModel->user_id        = (isset($user_id) && !empty($user_id))?$user_id:'0';
          $logModel->request_method = $_SERVER['REQUEST_METHOD'];
          $logModel->request_uri = $_SERVER['REQUEST_URI'];
          $logModel->request_time = $_SERVER['REQUEST_TIME'];
          $logModel->post_info = json_encode($postData);
          $logModel->user_agent = 'APP Api Access';
          $logModel->created_date_time = date("Y-m-d H??");
          $logModel->remote_ip = $_SERVER['REMOTE_ADDR'];
          $logModel->response_return = json_encode($response);
          if ($logModel->save())
              return true;
          return false;
      }*/
	  
	  
	  /* @author jitendra
  date 13-03-2018 */

  public function actionWebAccessPermission(){
      //echo "test";die;
      $response               = array();
      $all_response           = array();
      $roll_allow_for_62_71   = array(62,71);
      $roll_allow             = array(62,71,72,73,74);
      $deptId ='ALL';
      if ($_SERVER['REQUEST_METHOD'] == 'GET'){
          header('STATUS: Method Not allowed', true, 405);
          $response['STATUS'] = 405;
          $response['ERROR'] = "Method Not Allowed";
          $response['RESPONSE'] = "";
          echo json_encode($response);
          exit;
      }
if (isset($_POST['api_hash']) && !empty($_POST['api_hash']) && isset($_POST['role_id']) && !empty($_POST['role_id'])
 && isset($_POST['redirect_url']) && !empty($_POST['redirect_url']) && isset($_POST['department_id']) && !empty($_POST['department_id']) && isset($_POST['district_id']) && !empty($_POST['district_id']) && isset($_POST['access_token']) && !empty($_POST['access_token']) ) {
          extract($_POST);
           //print_r($_POST); die;
          $role_id       = $_POST['role_id'];
          $department_id = $_POST['department_id'];
          $distId        = $_POST['district_id'];

         if (!in_array($role_id, $roll_allow)){
              header('STATUS: 401', true, 401);
              $response['STATUS'] = 401;
              $response['MSG'] = "Not Authorised";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;
          }


          if(($role_id==62 || $role_id==71) && $department_id=='ALL'){  // 62-HOD , 71-SECRETARY
                 $response['STATUS']   = 400;
                 $response['MSG']      = "Bad Request";
                 $response['RESPONSE'] = "";
                 echo json_encode($response);
                 exit;
            }



          if (($role_id==72 || $role_id==73) && $department_id!='ALL'){  // 62-HOD , 71-SECRETARY
                 //print_r($_POST); die;
              $response['STATUS']   = 400;
              $response['MSG']      = "Bad Request";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;
           }

           if($role_id==72 || $role_id==73){ // 72-Principal Secretary ,73- Cheif Secretary
                $department_id='ALL';
                $distId='ALL';
            }

            if($role_id==74){ // 74-DM
               $department_id='ALL';
               $distId=$distId; //$_POST['district_id'] data is not correct in table so we use default value for District (i.e ALL)
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

         $criteria = new CDbCriteria();
  			 $criteria->condition = 'access_token=:access_token AND is_active=:is_active';
  			 $criteria->params    = array(':access_token'=>$_POST['access_token'],':is_active'=>'1');
  			 $model_users         = AccessToken::model()->find($criteria);

				if($model_users){

					$criteria = new CDbCriteria();
					$criteria->select='email,uid,dept_id,full_name';
					$criteria->condition = 'uid=:uid';
					$criteria->params = array(':uid'=>$model_users->user_id);
					// $_SESSION['uid'] = $model_users->user_id;
					 $model_pass = User::model()->find($criteria);
					 $session=new CHttpSession;
                    
				  $uid       =$model_users->user_id;
          $arr       = explode('/',$_POST['redirect_url']);
		  
		   $ghj=$_POST['redirect_url'];
          $hg=str_replace("?","/",$ghj);
          $arr       = explode('/',$hg);
     $url       = $arr['3']."/".$arr['4']."/".$arr['5']."/".$arr['6'];
					//$url       = $arr['3']."/".$arr['4']."/".$arr['5']."/".$arr['6'];
					$data      = $this->webAccessUrl($role_id,$url);
          //echo "hi..",$data;die;
					if(!$data){

              $response['STATUS']   = 400;
              $response['MSG']      = "Bad Request";
              $response['RESPONSE'] = "";
              echo json_encode($response);
              exit;

					}else {
					  	//$this->redirect($_POST['redirect_url']);
						  header('STATUS: 200', true, 200); 
						/*   $session->open();
					 @session_start();

					$_SESSION['department_login']= true;
					$_SESSION['access_token']    = $_POST['access_token'];
					$_SESSION['uid']             = $model_pass->uid;
					//$_SESSION['access_token'] =$token;
					$_SESSION['uname']=$model_pass->full_name;
					$_SESSION['email']=$model_pass->email;
					$_SESSION['dept_id']=$model_pass->dept_id;
					$_SESSION['first_time_login']=1;*/
					
            $response['STATUS']   = 200;
            $response['MSG']      = "Valid AccessToken";
            $finalURl= Yii::app()->createAbsoluteUrl('api/app/webRedirectPermission?access_token='.$_POST['access_token'].'&&redirect_url='.$_POST['redirect_url']);
           $response['RESPONSE'] = array('redirect_url' =>$finalURl);
            echo json_encode($response);
            exit;
          }


			}else{
			 header('STATUS: Bad Request', true, 401);
			$response['STATUS'] = 401;
			$response['MSG'] = "Invalid AccessToken";
			$response['RESPONSE'] = "";
			echo json_encode($response);
			return;	
				
			}


      } else {
          header('STATUS: Bad Request', true, 400);
          $response['STATUS'] = 400;
          $response['MSG'] = "Bad Request";
          $response['RESPONSE'] = "";
          echo json_encode($response);
          return;
      }
  }


  private function webAccessUrl($role_id,$url){

    $connection=Yii::app()->db;
    //role_id=$role_id AND
    $sql="SELECT * FROM bo_web_access_url WHERE role_id REGEXP REPLACE($role_id,',','|') AND  url='".$url."' AND is_active='1' ORDER BY bo_web_access_url.id DESC limit 1";
    $command=$connection->createCommand($sql);
    $evaluated=$command->queryRow();
      if($evaluated===false){
         return false;
      }else {
        return true;
      }

  }






      /**
       * This function is used to generate APP api logs
       * @author : jitendra Singh
       * @param : string $_POST String Response
       */
      private function generate_api_log($postData, $response) {
          $logModel = new AppAccessLog;
          $user_id  = "0";
          extract($postData);
          $logModel->user_id        = (isset($user_id) && !empty($user_id))?$user_id:'0';
          $logModel->request_method = $_SERVER['REQUEST_METHOD'];
          $logModel->request_uri = $_SERVER['REQUEST_URI'];
          $logModel->request_time = $_SERVER['REQUEST_TIME'];
          $logModel->post_info = json_encode($postData);
          $logModel->user_agent = 'APP Api Access';
          $logModel->created_date_time = date("Y-m-d H:i:s");
          $logModel->remote_ip = $_SERVER['REMOTE_ADDR'];
          $logModel->response_return = json_encode($response);
          if ($logModel->save())
              return true;
          return false;
      }
	  
	   /* @author jitendra
        date 23-03-2018 */

        public function actionWebRedirectPermission(){

               //echo "<pre/>";
               //print_r($_GET);die;
                $criteria = new CDbCriteria();
             $criteria->condition = 'access_token=:access_token AND is_active=:is_active';
             $criteria->params    = array(':access_token'=>$_GET['access_token'],':is_active'=>'1');
             $model_users         = AccessToken::model()->find($criteria);
           $criteria = new CDbCriteria();
           $criteria->select='email,uid,dept_id,full_name';
           $criteria->condition = 'uid=:uid';
           $criteria->params = array(':uid'=>$model_users->user_id);
           $model_pass = User::model()->find($criteria);
            //$uid        =  $model_users->user_id;
              //  echo "<pre/>";
                //print_r($model_pass);die;
                $session=new CHttpSession;
                $session->open();
                @session_start();
                 $_SESSION['department_login']= true;
                 $_SESSION['access_token']    = $_GET['access_token'];
                 $_SESSION['uid']             = $model_pass->uid;
              //   echo    $_SESSION['uid'] ;die;
                 //$_SESSION['access_token'] =$token;
                 $_SESSION['uname']=$model_pass->full_name;
                 $_SESSION['email']=$model_pass->email;
                 $_SESSION['dept_id']=$model_pass->dept_id;
                 $_SESSION['first_time_login']=1;
            $this->redirect(urldecode(stripslashes($_GET['redirect_url'])));
                 exit;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}
