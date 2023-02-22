<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;
$permissableroleIdArray = array('2','72','73','80','81');
 // session_start();
if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
	$userID = @$_SESSION['RESPONSE']['user_id'];
} else if (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'],$permissableroleIdArray)) {
	$userID = base64_decode($_GET['uid']);
} else {
	$userID = 0;
}
		
$euData=ApplicationV2Ext::AppliedApplicationByAnInvestor($userID,'11','INV','',$financial_year); 
?>

<style type="text/css">

    .dashboard-stat.yellow{ background-color: #F1C40F;    }
.mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
.mt-step-col{cursor: pointer;}
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -51px !important;
}
@media (min-width: 700px){
        .col-lg-3 { width: 20%; }
}

    .href_link:hover{
        color:#23527c;
    }

    .href_link1{

        color: #ffffff;

        font-size: 13px;

        font-family: "Open Sans",sans-serif;

        font-weight: 300;

        text-align: center;

        vertical-align: top;

        padding: 2px 5px;

    }        
            .movetoDashboard{
                cursor: pointer;
            }
  
        </style>
<div id="content">
    <style type="text/css">
        .dataTables_wrapper .dt-buttons{
            margin-right: 18px;
        }
        .marquee_container { float:left; margin-right:195px; margin-left: 195px; margin-top: -45px;}
        .marquee_container p {  display:inline; margin-left:16px; color:red; font-size:14.5px; line-height:33px; text-indent:8px; padding:25px;}
        .date_container {color: #fff;float: right;height: 60px;position: absolute;right: 10px;text-align: right;width: 100px;z-index: 999;}
    </style>
    <script type="text/javascript">
        function updateClock( )
        {
            var currentTime = new Date( );
            var currentdate = currentTime.toDateString();
            var currentHours = currentTime.getHours( );
            var currentMinutes = currentTime.getMinutes( );
            var currentSeconds = currentTime.getSeconds( );
            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
            // Convert the hours component to 12-hour format if needed
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            // Convert an hours component of "0" to "12"
            currentHours = (currentHours == 0) ? 12 : currentHours;
            // Compose the string for display
            var currentTimeString = currentdate + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            $("#clock").html(currentTimeString);

        }

    </script>



    <div class="site-min-height">

        <style>

            a:hover{color:blue;}
        </style>

        <style type="text/css">
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>

     

        <!-- BEGIN CONTENT BODY -->
       
        <div class="portlet-body">

        </div>





        <style type="text/css">
            .pd_child{ padding-left: 50px !important; }
            .dt-buttons{margin-top: 0px !important;}
        </style>
     

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption' style="padding-top: 14px;">
        <i style=" font-size:14px;" class='fa fa-file'></i>Applications for Registration of Existing Industries</div>
    <div class='tools'> </div>
	
</div> <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2" >

                    <thead>

                        <tr>


                            <th>SNo.</th>
                            <th>Application Detail</th>
                            <th style="width:150px !important;">Contact Detail</th>                           
                            <th>Status</th>
                            <th>Department's<br> Time</br>
                            <th>Applicant's<br> Time</br>
                            <th>Total Time</br>
                            <th>Action</th>


                        </tr>

                    </thead>

                    <tbody>

                        <?php 
                          //session_start();
      //  print_r($_SESSION);die;
  //$userID='11';
       /*   if(!empty(@$_SESSION['RESPONSE']['user_id'])){
          $userID=@$_SESSION['RESPONSE']['user_id'];
  }else if($_SESSION['role_id']==2){      
      $userID= base64_decode($_GET['uid']);
 }else{
       $userID=0;
 }						 */			
			$fromToDateCondition = '';
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
             $fromToDateCondition .= " AND DATE(created_on)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(created_on)<='".$enddate."'";
            }
                        $sql = "SELECT  * FROM bo_sp_applications where user_id='$userID' AND sp_app_id='280' $fromToDateCondition";
                        $apps = Yii::app()->db->createCommand($sql)->queryAll();

                        if (empty($apps) || count($apps) == 0) {

                          //  echo "<tr><td colspan='8'>No Detail Found</td></tr>";
                        } elseif(count($apps) >0) {

                            $count = 1;

                            foreach ($apps as $key => $apps) {
                                $appsgf = $apps['app_status'];

                                // DMS TIMELINE
                                $dmsTimeline = HomeController::calculateDmsTimeline($apps['sno']);
                                $diffapplicant = $dmsTimeline['applicant'];
                                $diffdept12 = $dmsTimeline['department'];
                                $overalldms = $diffdept12 + $diffapplicant;

                                // Service Timeline
                                $serviceTimeline = HomeController::getServiceTotalTimeline($apps['sno'], $appsgf);
                                $serviceApplicantTime = $serviceTimeline['applicant'];
                                $serviceDepartmentTime = $serviceTimeline['department'];
                                $serviceTotalTime = $serviceApplicantTime + $serviceDepartmentTime;
                                $responseFlag = 1;
                                //$responseFlag = ReportExt::checkServiceTimeLine($apps['sno'],$timeline_type_service_value,$serviceDepartmentTime,$tm_sh);
                                if ($responseFlag) {
                                    ?>

                                    <tr>
                                        <td align="center"><?php $history = HomeController::getApplicationHistoryDetail($apps['sno']);         //   print_r($history);die; 
                                    ?>
                                            <a href="<?php //echo Yii::app()->createAbsoluteUrl('mis/ServiceReport/servicedetail1/sid/' . $apps['sno'] . '/d1/' . $date1 . '/d2/' . $date2 . $next_link)   ?>" > <?php echo $count++; ?></a>
                                        </td>

                                        <td><?php $applicationID = HomeController::getServiceApplicationID($apps['sno']);
                                echo "<b>#</b> &nbsp; App ID: " . @$applicationID['app_id'] . "<br>";
                                    ?>
                                            <?php echo "<i title='Applied On' class='fa fa-history'></i> &nbsp;Applied On: ";
                                            $create = date('Y-m-d h:i:s', strtotime(@$history[0]['added_date_time']));
                                            echo date('d-m-Y h:i:s', strtotime($create));
                                            ?><br>
                                            <?php
                                            echo "CAF ID: ";
                                            if ($apps['caf_id'] == 0) {
                                                echo "N/A";
                                            } else {
                                                echo $apps['caf_id'];
                                            }
                                            ?><br>
                                        <?php if($apps['sp_app_id']){ 
                                           
                                            $serviceData=ApplicationV2Ext::getDepartmentAndServiceDetail($apps['sp_app_id']) ;
                                             $dsa=$serviceData['department_name']." : ".$serviceData['app_name']." : ".$applicationID['app_id'];
                                            $encodeddsa= base64_encode($dsa);
                                            echo "<i title='Department Name' class='fa fa-building'></i> &nbsp;".$serviceData['department_name']."<br>";
                                            echo "<b title='Service Name '>".$serviceData['app_name'];
                                            
                                            ?>
                                        <?php } ?></b>
                                        </td>
                                        <td>
                                            <?php $userr = HomeController::getUserView($apps['user_id']); ?>
                                            <i class='fa fa-user' title="Applicant's Name"></i> <?php echo $userr['first_name'] . ' ' . $userr['last_name']; ?><br>
                                            <i class='fa fa-mobile' title="Applicant's Mobile No."></i> <?php echo $userr['mobile_number']; ?><br> 
                                            <span title="Applicant's Email ID"> <?php
                                                $arr2 = str_split($userr['email'], 15);
                                                echo "" . @$arr2[0] . " " . @$arr2[1] . "";
                                                ?>  </span>   
                                           <br> <i class="fa fa-briefcase" title="Company name"></i> <?php echo $apps['unit_name']; ?>
                                        </td>
                                       
                                        <?php
                                        switch ($appsgf) {
                                            case "A":
                                                echo "<td style='vertical-align: top'> Approved</td>";
                                                break;
                                            /* case "B":
                                              echo "<td style='vertical-align: top;'> <span  class='label label'><i class='fa fa-rupee'></i>  Payment</span></td>";
                                              break; */
                                            case "P":
                                                echo "<td style='vertical-align: top;'>   Pending</td>";
                                                break;
                                            case "F":
                                                echo "<td style='vertical-align: top;'> Forward</td>";
                                                break;
                                            case "I":
                                                echo "<td style='vertical-align: top;'>"; $app=$apps;  $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['app_id'])."/application_status/".$app['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));echo "<a href='$revertbackUrl'>Incomplete</a></td>";
                                                break;
                                            case "RBI":
                                                echo "<td style='vertical-align: top;'>";$app=$apps;  $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['app_id'])."/application_status/".$app['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));echo "<a href='$revertbackUrl'>Reverted</a></td>"; 
                                                break;
                                            case "R":
                                                echo "<td style='vertical-align: top;'>  Rejected</td>";
                                                break;
                                            default:
                                                echo "<td style='vertical-align: top;'> No Status</td>";
                                        }
                                        ?>

                                        <td>


                                            DMS:  <?php
                                            //DMS docverifier total time
                                            $years = floor($diffdept12 / (365 * 60 * 60 * 24));
                                            $months = floor(($diffdept12 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($diffdept12 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($diffdept12 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($diffdept12 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($diffdept12 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year, ";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?><hr>
                                            Service:  <?php
                                            //Service Department's Time

                                            $years = floor($serviceDepartmentTime / (365 * 60 * 60 * 24));
                                            $months = floor(($serviceDepartmentTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($serviceDepartmentTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($serviceDepartmentTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($serviceDepartmentTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($serviceDepartmentTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year,";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?>


                                        </td>
                                        <td>
                                            DMS: <?php
                                            // DMS applicant total time
                                            // $diffapplicant = $diffapplicant + $diffappl;
                                            $years = floor($diffapplicant / (365 * 60 * 60 * 24));
                                            $months = floor(($diffapplicant - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year,";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?><hr>
                                            Service:  <?php
                                            //Service Applicant's Time
                                            $years = floor($serviceApplicantTime / (365 * 60 * 60 * 24));
                                            $months = floor(($serviceApplicantTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($serviceApplicantTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($serviceApplicantTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($serviceApplicantTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($serviceApplicantTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year,";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?>

                                        </td>
                                        <td>DMS: <?php
                                            // DMS OVERALL
                                            $years = floor($overalldms / (365 * 60 * 60 * 24));
                                            $months = floor(($overalldms - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($overalldms - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($overalldms - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($overalldms - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($overalldms - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year,";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?><hr>
                                            Service: <?php
                                            // Service Overall
                                            $years = floor($serviceTotalTime / (365 * 60 * 60 * 24));
                                            $months = floor(($serviceTotalTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($serviceTotalTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                            $hours = floor(($serviceTotalTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                            $minuts = floor(($serviceTotalTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                            $seconds = floor(($serviceTotalTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                            $allDays = ($months * 30) + $days;
                                            if ($years != 0) {
                                                echo "$years year";
                                            }
                                            printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReport/servicedetail1/sid/' . $apps['sno']) ?>/d1/2015-04-01/d2/<?php echo date('Y-m-d')?>/type/SERVICES/financial_year/<?php echo @$_GET['financial_year']; ?>/dsa/<?php echo $encodeddsa; ?>" > View Timeline</a>
                                        <br><a target="_blank" href="/backoffice/admin/ApplicationView/existingcafdownloadapp/id/<?php echo $applicationID['app_id'];?>/name/existingUnit">Print Application</a>
                                        <?php if($apps['app_status']=="A" || $apps['app_status']=="R"){ ?> <br>
										<!--<a target="_blank" href="<?php //echo $apps['download_certificate_call_back_url'];?>">Download Certificate</a>-->
										<?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                        
                       ?>
                                 


                    </tbody>



                </table>
            </div>
        </div>




        <style>

            .movetoDashboard{
                cursor: pointer;
            }

            
        </style>