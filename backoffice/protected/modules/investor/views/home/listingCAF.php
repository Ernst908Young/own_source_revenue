<?php
/* @var $this HomeController */
$permissableroleIdArray = array('2','72','73','80','81');
$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;

//session_start();
//  print_r($_SESSION);die;
if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
    $userID = @$_SESSION['RESPONSE']['user_id'];
} else if (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'],$permissableroleIdArray)) {
    $userID = base64_decode($_GET['uid']);
} else {
    $userID = 0;
}
$cafData = ApplicationV2Ext::AppliedApplicationByAnInvestor($userID, '1', 'INV','',$financial_year);
$fromToDateCondition = "";
if($financial_year=="ALL"){ 
	$startdate=date('Y-m-d', strtotime("2015-04-01")); 
	$enddate=date('Y-m-d'); 
	$fromToDateCondition .= " AND DATE(bo_new_application_submission.application_created_date)>='".$startdate."'";
	$fromToDateCondition .= " AND DATE(bo_new_application_submission.application_created_date)<='".$enddate."'";
}
$sql = "SELECT bo_new_application_submission.*,bo_new_application_submission.submission_id as sno,sso_users.user_id,sso_users.email,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.mobile_number 
FROM bo_new_application_submission 
INNER JOIN sso_users ON sso_users.user_id=bo_new_application_submission.user_id
INNER JOIN sso_profiles ON sso_profiles.user_id=sso_users.user_id 
where bo_new_application_submission.user_id='$userID'  
AND bo_new_application_submission.sp_app_id='2' $fromToDateCondition";

$newCAFapps = Yii::app()->db->createCommand($sql)->queryAll();
//echo count($newCAFapps);
//echo "<pre>";
//print_r($newCAFapps);

?>
<style type="text/css">
    .dashboard-stat.yellow{ background-color: #F1C40F;    }
    .mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
    .mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons {
        margin-top: 14px;
    }
    @media (min-width: 700px){
        .col-lg-3 {
            width: 20%;
        }
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
    .portlet.box .dataTables_wrapper .dt-buttons {
        margin-top: 0px !important;
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
                    <i style=" font-size:14px;" class='fa fa-file'></i><?php echo $print_title="Applications for Company Name Reservation";?></div>
				
                <div class='tools'> </div>

            </div>
			
            <div class="portlet-body">
			
                <?php //print_r($cafData);  ?>
                <table class="table table-striped table-bordered table-hover" id="sample_2" >
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Application Details</th>
                            <th>Applicant Detail</th>          
                            <th>Status</th>
                            <th>View Application Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      	$statusArray = array('A' => 'Approved','B'=>'Payment Due', 'AB' => 'Abeyance','R' => 'Rejected', 'H' => 'Reverted', 'Z' => 'Archived', 'I' => 'Incomplete', 'P' => 'Pending', '' => '', 'F' => 'Inprogress','DP'=>'Document Pending','PD'=>'Payment Due','Forwarded','FA'=>'Forwarded to Approver');
						
						$snumber = 0;
						foreach($newCAFapps as $k=>$v)
						{
							$naewCafstatus  = $v['application_status'];
							$applicationID = HomeController::getServiceApplicationID($v['sno']);
							$serviceData=ApplicationV2Ext::getDepartmentAndServiceDetail($v['sp_app_id']) ;
							
							$dsa=$serviceData['department_name']." : ".$serviceData['app_name']." : ".$applicationID['app_id'];
							$encodeddsa= base64_encode($dsa);
							if($naewCafstatus!='Z'){
						?>
							<tr>
								<td style="text-align:center;"><?php echo $snumber++; ?></td>
								<td>
									<i class="fa fa-file-o"></i>&nbsp;&nbsp;CAF ID: <?php echo $v['submission_id'];?><br/>
									<i class='fa fa-building-o'></i>&nbsp;&nbsp;<?php echo $v['unit_name'];?><br/>
									<?php 
									if (!empty($v['landrigion_id'])) 
									{
										/* echo "<br><i class='fa fa-map-marker'></i>&nbsp;&nbsp;" . InfowizardQuestionMasterExt::getMasterName('bo_district',$v['landrigion_id'], 'distric_name', 'district_id'); */
									} 
									?>
								</td>
								<td>
									<i class='fa fa-user'></i> &nbsp;&nbsp;
									<?php  if (!empty($v['first_name'])) {
										echo @$v['first_name']." ".@$v['last_name'];
										echo "<br><i class='fa fa-envelope-o'></i>&nbsp;&nbsp;" . $v['email'];
										echo "<br><i class='fa fa-mobile'></i>&nbsp;&nbsp;&nbsp;&nbsp;" . $v['mobile_number'];
									} else {
										echo "NA";
									}  
									
									//echo $v['application_status'];
									
									?>
									
								</td>								
								<?php		
								
								switch($naewCafstatus) {
									case "A":
										echo "<td style='vertical-align: top'> Approved</td>";
										break;
									case "AB":
										echo "<td style='vertical-align: top'>Abeyance</td>";
										break;	
									case "PD":
										echo "<td style='vertical-align: top;'>";
										$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$v['sp_app_id'])."/sp_tag/".base64_encode($v['sp_tag'])."/application_id/".base64_encode($v['app_id'])."/application_status/".$v['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($v['reverted_call_back_url'])));
										echo "<a href='$revertbackUrl'>Incomplete (Payment Due)</a></td>";
										break;	
									case "P":
										echo "<td style='vertical-align: top;'>Pending</td>";
										break;
									case "F":
										echo "<td style='vertical-align: top;'>Forward</td>";
										break;
									case "I":
										echo "<td style='vertical-align: top;'>"; 										 
										$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$v['sp_app_id'])."/sp_tag/".base64_encode($v['sp_tag'])."/application_id/".base64_encode($v['app_id'])."/application_status/".$v['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($v['reverted_call_back_url']))); 											
										echo "<a href='$revertbackUrl'>Incomplete</a></td>";
										break;
									case "RBI":
										echo "<td style='vertical-align: top;'>";
										$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$v['sp_app_id'])."/sp_tag/".base64_encode($v['sp_tag'])."/application_id/".base64_encode($v['app_id'])."/application_status/".$v['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($v['reverted_call_back_url'])));
										echo "<a href='$revertbackUrl'>Reverted</a></td>";
										break;
									case "H":
										echo "<td style='vertical-align: top;'>";
										$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$v['sp_app_id'])."/sp_tag/".base64_encode($v['sp_tag'])."/application_id/".base64_encode($v['app_id'])."/application_status/".$v['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($v['reverted_call_back_url'])));
										echo "<a href='$revertbackUrl'>Reverted</a></td>";
										break;	
									case "DP":
										echo "<td style='vertical-align: top;'>";
										$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$v['sp_app_id'])."/sp_tag/".base64_encode($v['sp_tag'])."/application_id/".base64_encode($v['app_id'])."/application_status/".$v['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($v['reverted_call_back_url'])));
										echo "<a href='$revertbackUrl'>Incomplete (Document Pending)</a></td>";
										break;										
									case "R":
										echo "<td style='vertical-align: top;'>Rejected</td>";
										break;
									default:
										echo "<td style='vertical-align: top;'>No Status</td>";
									}
									?>
								
								<td>
									<a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReport/servicedetail1/sid/' . $v['sno']) ?>/d1/2015-04-01/d2/<?php echo date('Y-m-d')?>/type/SERVICES/financial_year/<?php echo @$financial_year; ?>/dsa/<?php echo $encodeddsa; ?>" > View Timeline</a>
									<br>
									<a target="_blank" href="<?php echo $v['print_app_call_back_url'];?>">Print Application</a>
									<br>
									<a href="/backoffice/infowizard/subFormPdf/downloadFilmCertificate3/service_id/<?php echo base64_encode('591.0'); ?>/subID/<?php echo base64_encode($v['submission_id']);?>/dept_id/<?php echo base64_encode($serviceData['dept_id']); ?>">Download Certificate</a>
									<?php if($v['application_status']=="A" || $v['application_status']=="R"){ ?> <br>
									<a target="_blank" href="<?php echo $v['download_certificate_call_back_url'];?>">Download Certificate</a><?php } ?>
								</td>
							</tr>	
						<?php	
							
							}
						}	
						?>						
                    </tbody>
                </table>
            </div>
        </div>


        <style>
            .portlet.box .dataTables_wrapper .dt-buttons {
                margin-top: -51px !important;
            }
        </style>