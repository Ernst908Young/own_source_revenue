<?php
/* @var $this HomeController */
$permissableroleIdArray = array('2','72','73','80','81');
$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;

if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
    $userID = @$_SESSION['RESPONSE']['user_id'];
} else if (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'],$permissableroleIdArray)) {
    $userID = base64_decode($_GET['uid']);
} else {
    $userID = 0;
}


$cafData = ApplicationV2Ext::AppliedApplicationByAnInvestor($userID, '1', 'INV','',$financial_year);

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
    <div class="site-min-height">
		<style type="text/css">
            a:hover{color:blue;}
			#chartdiv {
                width: 100%;
                height: 500px;
            }
			.pd_child{ padding-left: 50px !important; }
            .dt-buttons{margin-top: 0px !important;}
        </style>        
        <!-- BEGIN CONTENT BODY -->      
        <div class="portlet-body">

        </div>       
        <div class='portlet box green'>
            <div class='portlet-title'>
                <div class='caption' style="padding-top: 14px;">
                    <i style=" font-size:14px;" class='fa fa-file'></i><?php echo $print_title="MoU Details";?></div>
                <div class='tools'> </div>

            </div>
            <div class="portlet-body">
			
                <?php //print_r($cafData);  ?>
                <table class="table table-striped table-bordered table-hover" id="sample_2" >
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>MRN No.</th>
                            <th>Sector/Department</th>
                            <th>Company Details</th>          
                            <th>Proposed Investment(INR Crores)</th>
                            <th>Proposed Emp.</th>
							<th>CAF Status</th>
                            <th>Land Details</th>                            
                            <th>Call Summary</th>
                        </tr>
                    </thead
                    <tbody>
                        <?php
                        $statusArray = array('A' => 'Approved', 'AB' => 'Abeyance','R' => 'Rejected', 'H' => 'Reverted', 'Z' => 'Archived', 'I' => 'Incomplete', 'P' => 'Pending', '' => '', 'F' => 'Inprogress');
						$snumber = 1;
                        foreach ($cafData as $key => $appliedCaf) {
                            $status = $appliedCaf['application_status'];
                            if($status!='Z'){
                            $unitData = json_decode($appliedCaf['field_value']);
                            ?> 
                            <tr>
                                <td style="text-align: center;"><?php echo $snumber++; ?></td>
								<?php if ($appliedCaf['application_id'] == 1) {
									$type = "CAF ";
								} else {
									$type = "LAND ";
								} ?>
                                <td><i class="fa fa-file-o"></i>&nbsp;&nbsp;<?php echo $type . " ID : <b>" . $appliedCaf['submission_id'];
								if (!empty($unitData->company_name)) {
									echo "</b>" . "<br><i class='fa fa-building-o'></i>&nbsp;&nbsp;" . $unitData->company_name;
								} ?> <?php if (!empty($unitData->land_disctric)) {
									echo "<br><i class='fa fa-map-marker'></i>&nbsp;&nbsp;" . InfowizardQuestionMasterExt::getMasterName('bo_district', $unitData->land_disctric, 'distric_name', 'district_id');
								} ?>
								</td>
                                <td><i class='fa fa-user'></i> &nbsp;&nbsp;<?php if (!empty($unitData->md_name)) {
									echo $unitData->md_name;
									echo "<br><i class='fa fa-envelope-o'></i>&nbsp;&nbsp;" . $unitData->md_email;
									echo "<br><i class='fa fa-mobile'></i>&nbsp;&nbsp;&nbsp;&nbsp;" . $unitData->md_mob;
								} else {
									echo "NA";
								} ?>
								</td>
								<td> <?php   
								if(@$status=="H" || @$status=="I"){ ?><a href="/backoffice/frontuser/home/cafForm" title="Click here to complete the application"><?php } ?> 
									<?php  echo $statusArray[$status]; ?>
									<?php if($status=="H" || $status=="I"){ ?></a><?php } ?>
									
									<?php  if($status=="R"){
									  $sql="Select * from bo_appeal where caf_id=".$appliedCaf['submission_id'];
									  $EuApeelData = Yii::app()->db->createCommand($sql)->queryRow();
									  if(empty($EuApeelData)){
									  ?> <br><a href="/backoffice/appeal/generateAppeal/request/application/<?php echo base64_encode($appliedCaf['submission_id'])?>/appliedFor/<?php echo base64_encode($appliedCaf['application_id']); ?>/type/CAF">File Appeal</a><?php }else{ ?>
										<br><a href="/backoffice/appeal/generateAppeal/listUserAppeal/application/<?php echo base64_encode($appliedCaf['submission_id'])?>/appliedFor/<?php echo base64_encode($appliedCaf['application_id']); ?>/type/CAF">View Appeal</a> 
								   <?php   } }?>
								</td>
								<td><a href="/backoffice/mis/boApplicationSubmission/CafTrackingTimeline/application/<?php echo base64_encode($appliedCaf['submission_id']); ?>/panel/investor/financial_year/<?php echo @$_GET['financial_year']; ?>/type/CAF/iuid/<?php echo base64_encode(@$unitData->IUID); ?>">View Timeline</a>
											<br> <?php if ($appliedCaf['application_status'] == "A" ) { ?><a target="_blank"  href="/backoffice/frontuser/home/downaloadInvestorDocuments/app_sub_id/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Download Certificate</a><?php } ?>
											<br> <a target="_blank" href="/backoffice/mis/ProdTestDev/CafTrackingTimelineEmail/application/<?php echo base64_encode($appliedCaf['submission_id']); ?>">Print Form</a>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
                            </tr>
<?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>


        <style>
            .portlet.box .dataTables_wrapper .dt-buttons {
                margin-top: -51px !important;
            }
        </style>