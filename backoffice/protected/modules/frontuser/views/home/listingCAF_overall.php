<?php
/* @var $this HomeController */

$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;

//session_start();
//  print_r($_SESSION);die;
if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
    $userID = @$_SESSION['RESPONSE']['user_id'];
} else if ($_SESSION['role_id'] == 2) {
    $userID = base64_decode($_GET['uid']);
} else {
    $userID = 0;
}

$cafData = ApplicationV2Ext::AppliedApplicationByInvestors($userID, '1', 'INV','','ALL');

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
                    <i style=" font-size:14px;" class='fa fa-file'></i><?php echo $print_title="Applications for In-Principle Approval (CAF)";?></div>
                <div class='tools'> </div>

            </div>
            <div class="portlet-body">
			
                <?php //print_r($cafData);  ?>
                <table class="table table-striped table-bordered table-hover table-scroll" id="sample_2" >
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>CAF ID</th>
                            <th>Unit Name</th>          
                            <th>Unit District</th>          
                            <th>Submitted on</th>          
                            <th>Investor Name</th>          
                            <th>Investor Email</th>          
                            <th>Investor Mobile No</th>          
                            <th>Status</th>
                            <th style="display:none;">View Application Detail</th>
                        </tr>
                    </thead
                    <tbody>
                        <?php
                        $statusArray = array('A' => 'Approved', 'R' => 'Rejected', 'H' => 'Reverted', 'Z' => 'Archived', 'I' => 'Incomplete', 'P' => 'Pending', '' => '', 'F' => 'Inprogress');

                        foreach ($cafData as $key => $appliedCaf) {
                            $unitData = json_decode($appliedCaf['field_value']);
                            ?> 
                            <tr>
                                <td style="text-align: center;"><?php echo $key + 1; ?></td>
    <?php if ($appliedCaf['application_id'] == 1) {
        $type = "CAF ";
    } else {
        $type = "LAND ";
    } ?>
                                <td><?php echo $appliedCaf['submission_id']; ?></td>
                                <td><?php 
    if (!empty($unitData->company_name)) {
        echo "</b>". $unitData->company_name; ?></td>
   <?php  } ?> <td><?php if (!empty($unitData->land_disctric)) {
        echo  InfowizardQuestionMasterExt::getMasterName('bo_district', $unitData->land_disctric, 'distric_name', 'district_id');
    } ?></td><td><?php echo @$appliedCaf['cdt'];?></td>
                                
                             
                          
   <td> <?php     echo $unitData->md_name; ?></td>
        <td><?php  echo $unitData->md_email; ?> </td>
                               <td> <?php echo $unitData->md_mob;   ?> </td>
           
    
                        <td> <?php $status = $appliedCaf['application_status'];  
                        if(@$status=="H" || @$status=="I"){ ?><a href="/backoffice/frontuser/home/cafForm" title="Click here to complete the application"><?php } ?> 
                            <?php  echo $statusArray[$status]; ?>
                            <?php if($status=="H" || $status=="I"){ ?></a><?php } ?>
                            
                            <?php  if($status=="R"){ ?> <a href="/backoffice/appeal">File Appeal</a><?php }?>
                        </td>
                                <td style="display:none;"><a href="/backoffice/mis/boApplicationSubmission/CafTrackingTimeline/application/<?php echo base64_encode($appliedCaf['submission_id']); ?>/panel/investor/financial_year/<?php echo @$_GET['financial_year']; ?>/type/CAF">View Timeline</a>
                                     <?php if ($appliedCaf['application_status'] == "A" || $appliedCaf['application_status'] == "R") { ?><a target="_blank"  href="/backoffice/frontuser/home/downaloadInvestorDocuments/app_sub_id/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Download Certificate</a><?php } ?>
                                     <a target="_blank" href="/backoffice/mis/ProdTestDev/CafTrackingTimelineEmail/application/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Print Form</a></td>
                            </tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <style>
            .portlet.box .dataTables_wrapper .dt-buttons {
                margin-top: -51px !important;
            }
        </style>