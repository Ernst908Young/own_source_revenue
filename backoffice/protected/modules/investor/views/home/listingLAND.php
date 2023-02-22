<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;

  //session_start();
      //  print_r($_SESSION);die;
  //$userID='2622';
  if(!empty(@$_SESSION['RESPONSE']['user_id'])){
          $userID=@$_SESSION['RESPONSE']['user_id'];
  }else if($_SESSION['role_id']==2){      
      $userID= base64_decode($_GET['uid']);
 }else{
       $userID=0;
 }
         $cafData=ApplicationV2Ext::AppliedApplicationByAnInvestor($userID,'8','INV');  
         
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
        <br>
        <div class="portlet-body">

        </div>





        <style type="text/css">
            .pd_child{ padding-left: 50px !important; }
            .dt-buttons{margin-top: 0px !important;}
        </style>
     

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption' style="padding-top: 14px;">
        <i style=" font-size:14px;" class='fa fa-file'></i>Applications for Land Allotment</div>
    <div class='tools'> </div>
	
</div>
 <div class="portlet-body">
       <?php //print_r($cafData);  ?>
 <table class="table table-striped table-bordered table-hover" id="sample_2" >
           
        <thead>
        <tr>
            <th>S. No.</th>
            <th>Unit Details</th>
            <th>Investor Detail</th>          
            <th>Status</th>
            <th>View Application Detail</th>
        </tr>
        </thead
        <tbody>
            <?php  $statusArray=array('A'=>'Approved','R'=>'Rejected','H'=>'Reverted','Z'=>'Archived','I'=>'Incomplete','P'=>'Pending',''=>'','F'=>'Inprogress');
                   
            foreach($cafData as $key=>$appliedCaf){ 
                  $unitData= json_decode($appliedCaf['field_value']); 
                ?> 
            <tr>
                <td style="text-align: center;"><?php echo $key+1; ?></td>
                <?php if($appliedCaf['application_id']==1){$type="CAF ";}else{ $type="LAND ";}?>
                <td><i class="fa fa-file-o"></i>&nbsp;&nbsp;<?php  $subID=$appliedCaf['submission_id'];echo $type." ID : <b>".$appliedCaf['submission_id']; if(!empty($unitData->company_name)){ echo  "</b>"."<br><i class='fa fa-building-o'></i>&nbsp;&nbsp;".$unitData->company_name; } ?> <?php if(!empty($unitData->district)){ echo "<br><i class='fa fa-map-marker'></i>&nbsp;&nbsp;".InfowizardQuestionMasterExt::getMasterName('bo_district',$unitData->district,'distric_name','district_id'); }?></td>
                <td><i class='fa fa-user'></i> &nbsp;&nbsp;<?php if(!empty($unitData->applicant_name)){ echo $unitData->applicant_name;echo "<br><i class='fa fa-envelope-o'></i>&nbsp;&nbsp;".$unitData->email;echo "<br><i class='fa fa-mobile'></i>&nbsp;&nbsp;&nbsp;&nbsp;".$unitData->mob_number; }else{echo "NA";}?></td>
                <td><?php  $status=$appliedCaf['application_status'];if($status=='H' || $status=='I'){$url="/backoffice/frontuser/landAllotment/stepOne/department/$subID/application/$subID";?><a href="<?php echo $url; ?>"><?php echo $statusArray[$status]; ?></a><?php }else{echo $statusArray[$status];} ?></td>
                <td><a href="/backoffice/mis/boApplicationSubmission/CafTrackingTimeline/application/<?php echo base64_encode($appliedCaf['submission_id']); ?>/app_type/LAND">View Application</a> <br>
                <a href="/backoffice/frontuser/home/printForm/app_id/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Print Application</a> <br>
                <?php if($appliedCaf['application_status']=="A" || $appliedCaf['application_status']=="R"){ ?><a href="/backoffice/frontuser/home/downaloadInvestorDocuments/q/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Download Certificate</a> <?php }else{ ?>NA<?php } ?></td>
            </tr>
             <?php } ?>
        </tbody>
    </table>
          </div>
      </div>


<style>
              .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -54px !important;
}
</style>