<?php
/* @var $this HomeController */
//$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;
$archived=0;

?>
<style>
.fix-company-hd{
	position: fixed;
    left: 0;
    top: 168px;
    background: #f1f1f3;
    width: 100%;
    padding-top: 18px;
    padding-bottom: 4px;
    z-index: 2;
}
.fix-company-hd h2{
	display:inline-block;
	font-size:22px;
}
.fix-company-hd h2 span{
	margin-right:15px;
}
</style>
<div class="dashboard-welcome">   
	<div class="fix-company-hd">
		<?php if(isset($_GET['name']) && !empty($_GET['name'])){ ?><h2><span  style="margin-left: 23px;"><img src="/themes/investuk/images/building_icon_lrg.png" alt="" title="" /><?php  echo base64_decode($_GET['name']); ?></span></h2> <?php }else { ?> <h2><span  style="margin-left: 23px;">Welcome to Applicant Dashboard</span></h2><?php }?>
		<div class="welcome-date hidden-xs" style="margin-right: 23px;"><i class="icon-calendar"></i> <?php echo date('d-M-Y'); ?></div>
	</div>		
    <div class="clearfix"></div>
</div>
<div class="fy-year content-blocks" style="display: none;">
    <?php
    if (!isset($_GET['financial_year']))
        $financial_year = 'ALL';
    else
        $financial_year = $_GET['financial_year'];
    ?>
    <form name="form" action="" method="GET">
    <table >
        <tbody>
            <tr>
                <td>
                    <span>Currently you are viewing data for <?= $financial_year ?> FY, If you want to change then select Financial Year :</span>&nbsp;&nbsp;
                </td>
                <td>
                <?php
                    $m = date('m');
                    $yyy = date('Y');
                    if ($m > 3) {
                        $yyy = $yyy - 1;
                    }
                    $pp = '2015';
                    ?>
                <select name="financial_year" class="form-control" onchange="this.form.submit()"  >
                        <option value="ALL"
                            <?php if ($financial_year == "ALL") {
                                echo "selected='selected'";
                            } ?> >ALL
                        </option>
                        <?php for ($i = $pp; $i <= $yyy + 1; $i++) {
                            $j = $i + 1;
                            $k = $i . '-' . $j; ?>
                            <option value="<?php echo $k; ?>"
                                <?php if ($financial_year == $k) {
                                    echo "selected='selected'";
                                } ?>>
                                <?php echo $k; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
</div>
<?php $userID = $_SESSION['RESPONSE']['user_id']; ?>
<?php 
$urlOfnextLevel = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/$financial_year";
$urlOfnextLevelCAF = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/financial_year/$financial_year/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/$financial_year";
$urlOfnextLevelEU = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/$financial_year";
$urlOfnextLevelSERVICES = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/$financial_year";
$urlOfnextLevelQUERIES = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/QUERIES/financial_year/$financial_year";
$urlOfnextLevelTICKETS = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/financial_year/$financial_year";
$urlOfnextLevelGRIEVANCE = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/GRIEVANCE/financial_year/$financial_year";
$urlOfnextLevelDMS = "/backoffice/dms/DocumentManagement/myDocuments";
?>
<div class="invest-dashboard-top-charts content-blocks" style="padding: 22px 15px 0px 74px;margin-top: 54px;">
	
    <div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats grey">
                <h3 class="incomplete"><?php echo $this->GetServiceWiseCount('report_all','I',$userID); ?></h3>
                <p>Draft</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats orange2">
                <h3 class="incomplete"><?php echo $this->GetServiceWiseCount('report_all','P',$userID); ?></h3>
                <h3 class="pending"></h3>
                <p>Submitted</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats green2">
                <h3 class="incomplete"><?php echo $this->GetServiceWiseCount('report_all','RBI',$userID); ?></h3>
                <h3 class="reverted"></h3>
                <p>Pending for Resubmission</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats">
                <h3 class="inprogress"><?php echo $this->GetServiceWiseCount('report_all','F',$userID); ?></h3>
                <p>Application Under Review</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats green3">
                <h3 class="rejected"><?php echo $this->GetServiceWiseCount('report_all','A',$userID)+$this->GetServiceWiseCount('to_be_used_in_iw','R',$userID); ?></h3>
                <p>Approved</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="content-blocks">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-list"></i> My Applications</div><div class="tools" id="tabletoggle">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover movetoDashboardold">
                    <thead>
                        <tr style="width: 25%;">
                            <th>Service</th>
                            <th style="text-align: center!important;"> Draft</th>
                            <th style="text-align: center!important;"> Submitted</th>
                            <th style="text-align: center!important;width:12%;"> Pending for Resubmission</th>
                            <th style="text-align: center!important;width:12%;"> Application Under Review</th>
                            <th style="text-align: center!important;"> Approved</th>
                            <th style="text-align: center!important;"> Rejected</th>
                            <th style="text-align: center!important;"> Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr style="cursor: pointer;">
                        <th class="BM"> Name Reservation Services </th>
						<?php $incomplete1=$pending1=$reverted1=$inProgress1=$approved1=$rejected1=0;?>
                        <td class="text-center BM" rel="I">
                            <?php  echo $incomplete1 =$this->GetServiceWiseCount('business_name_services','I',$userID); ?>
                        </td>
                        <td class="text-center BM" rel="P">
                            <?php echo $pending1 = $this->GetServiceWiseCount('business_name_services','P',$userID); ?>
                        </td>
                        <td class="text-center BM" rel="RBI">
                            <?php echo $reverted1 = $this->GetServiceWiseCount('business_name_services','RBI',$userID); ?>
                        </td>
                        <td class="text-center BM" rel="F">
                            <?php echo $inProgress1 =$this->GetServiceWiseCount('business_name_services','F',$userID); ?>
                        </td>
                        <td class="text-center BM" rel="A">
                            <?php echo $approved1 = $this->GetServiceWiseCount('business_name_services','A',$userID); ?>
                        </td>
                        <td class="text-center BM" rel="R">
                            <?php echo $rejected1 = $this->GetServiceWiseCount('business_name_services','R',$userID); ?>
                        </td>
                        <td class="text-center BM">
                            <?php echo $totalCAF =  $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                    <tr style="cursor: pointer;">
                        <th class="Incop">Incorporation Services</th>
						<?php $incomplete1=$pending1=$reverted1=$inProgress1=$approved1=$rejected1=0;?>
                        <td class="text-center Incop" rel="I">
                            <?php  echo $incomplete1 =$this->GetServiceWiseCount('incorporation_services','I',$userID); ?>
                        </td>
                        <td class="text-center Incop" rel="P">
                            <?php echo $pending1 = $this->GetServiceWiseCount('incorporation_services','P',$userID); ?>
                        </td>
                        <td class="text-center Incop" rel="RBI">
                            <?php echo $reverted1 = $this->GetServiceWiseCount('incorporation_services','RBI',$userID); ?>
                        </td>
                        <td class="text-center Incop" rel="F">
                            <?php echo $inProgress1 =$this->GetServiceWiseCount('incorporation_services','F',$userID); ?>
                        </td>
                        <td class="text-center Incop" rel="A">
                            <?php echo $approved1 = $this->GetServiceWiseCount('incorporation_services','A',$userID); ?>
                        </td>
                        <td class="text-center Incop" rel="R">
                            <?php echo $rejected1 = $this->GetServiceWiseCount('incorporation_services','R',$userID); ?>
                        </td>
                        <td class="text-center Incop">
                            <?php echo $totalCAF =  $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                    <tr style="cursor: pointer;">
                        <th class="Conti">Continuance Services</th>
						
						<?php $incomplete1=$pending1=$reverted1=$inProgress1=$approved1=$rejected1=0;?>
                        <td class="text-center Conti" rel="I">
                            <?php  echo $incomplete1 =$this->GetServiceWiseCount('continuance_services','I',$userID); ?>
                        </td>
                        <td class="text-center Conti" rel="P">
                            <?php echo $pending1 = $this->GetServiceWiseCount('continuance_services','P',$userID); ?>
                        </td>
                        <td class="text-center Conti" rel="RBI">
                            <?php echo $reverted1 = $this->GetServiceWiseCount('continuance_services','RBI',$userID); ?>
                        </td>
                        <td class="text-center Conti" rel="F">
                            <?php echo $inProgress1 =$this->GetServiceWiseCount('continuance_services','F',$userID); ?>
                        </td>
                        <td class="text-center Conti" rel="A">
                            <?php echo $approved1 = $this->GetServiceWiseCount('continuance_services','A',$userID); ?>
                        </td>
                        <td class="text-center Conti" rel="R">
                            <?php echo $rejected1 = $this->GetServiceWiseCount('continuance_services','R',$userID); ?>
                        </td>
                        <td class="text-center Conti">
                            <?php echo $totalCAF =  $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                    </tr>
                     <tr  style="cursor: pointer;">
                        <th  class="Amal">Amalgamation Services</th>
                       
                       <?php $incomplete1=$pending1=$reverted1=$inProgress1=$approved1=$rejected1=0;?>
                        <td class="text-center Amal" rel="I">
                            <?php  echo $incomplete1 =$this->GetServiceWiseCount('amalgamation_services','I',$userID); ?>
                        </td>
                        <td class="text-center Amal" rel="P">
                            <?php echo $pending1 = $this->GetServiceWiseCount('amalgamation_services','P',$userID); ?>
                        </td>
                        <td class="text-center Amal" rel="RBI">
                            <?php echo $reverted1 = $this->GetServiceWiseCount('amalgamation_services','RBI',$userID); ?>
                        </td>
                        <td class="text-center Amal" rel="F">
                            <?php echo $inProgress1 =$this->GetServiceWiseCount('amalgamation_services','F',$userID); ?>
                        </td>
                        <td class="text-center Amal" rel="A">
                            <?php echo $approved1 = $this->GetServiceWiseCount('amalgamation_services','A',$userID); ?>
                        </td>
                        <td class="text-center Amal" rel="R">
                            <?php echo $rejected1 = $this->GetServiceWiseCount('amalgamation_services','R',$userID); ?>
                        </td>
                        <td class="text-center Amal">
                            <?php echo $totalCAF =  $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                   
                    <tr style="cursor: pointer;">
                        <th class="ClS">Closure Services</th>
						
                        <?php $incomplete1=$pending1=$reverted1=$inProgress1=$approved1=$rejected1=0;?>
                        <td class="text-center ClS" rel="I">
                            <?php  echo $incomplete1 =$this->GetServiceWiseCount('closure_service','I',$userID); ?>
                        </td>
                        <td class="text-center ClS" rel="P">
                            <?php echo $pending1 = $this->GetServiceWiseCount('closure_service','P',$userID); ?>
                        </td>
                        <td class="text-center ClS" rel="RBI">
                            <?php echo $reverted1 = $this->GetServiceWiseCount('closure_service','RBI',$userID); ?>
                        </td>
                        <td class="text-center ClS" rel="F">
                            <?php echo $inProgress1 =$this->GetServiceWiseCount('closure_service','F',$userID); ?>
                        </td>
                        <td class="text-center ClS" rel="A">
                            <?php echo $approved1 = $this->GetServiceWiseCount('closure_service','A',$userID); ?>
                        </td>
                        <td class="text-center ClS" rel="R">
                            <?php echo $rejected1 = $this->GetServiceWiseCount('closure_service','R',$userID); ?>
                        </td>
                        <td class="text-center ClS">
                            <?php echo $totalCAF =  $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--<div class="content-blocks">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-list"></i> Document Management System
            </div>
            <div class="tools" id="tabletoggle">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover movetoDashboardold">
                    <thead>
                    <tr>
                        <th style="width: 25%;">Document Management System</th>
                        <th class="text-center">Unverified	</th>
                        <th class="text-center">Verified</th>
                        <th class="text-center">Mismatch</th>
                        <th class="text-center">Rejected</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="DMSROW">
                        <th>  Uploaded Documents </th>
                        <td class="text-center"><a href="<?php echo $urlOfnextLevelDMS."/docStatus/U"?>"><?php echo $unverified=ApplicationV2Ext::DmsStatusCount($userID,"U"); ?></a> </td>
                        <td class="text-center"><a href="<?php echo $urlOfnextLevelDMS."/docStatus/V"?>"><?php echo $verified=ApplicationV2Ext::DmsStatusCount($userID,"V"); ?></a> </td>
                        <td class="text-center"><a href="<?php echo $urlOfnextLevelDMS."/docStatus/M"?>"><?php echo $mismatch=ApplicationV2Ext::DmsStatusCount($userID,"M"); ?> </a></td>
                        <td class="text-center"><a href="<?php echo $urlOfnextLevelDMS."/docStatus/R"?>"><?php echo $rejected=ApplicationV2Ext::DmsStatusCount($userID,"R"); ?></a> </td>
                        <td class="text-center"><a href="<?php echo $urlOfnextLevelDMS; ?>"><?php echo $total=$unverified+$verified+$mismatch+$rejected;?></a> </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>-->
<?php
$fromToDateCondition = "";
if (!isset($financial_year)) {
    $financial_year = 'ALL';
}
if ($financial_year == "ALL") {
    $startdate = date('Y-m-d', strtotime("2015-04-01"));
    $enddate = date('Y-m-d');
} else if ($financial_year != "ALL") {
    $data = explode("-", $financial_year);
    $startdate = $data[0] . "-04-01";
    $enddate = $data[1] . "-03-31";
} else {
    $fDate = date('Y-m-d');
    $keyy = explode("-", $fDate);
    $todayDate = date('Y-m-d', strtotime($fDate));
    $sdate = $keyy[0] . "-04-01";
    $DateBegin = date('Y-m-d', strtotime($sdate));
    $yy = $keyy[0];
    $yy1 = $keyy[0] + 1;
    $yy2 = $keyy[0] - 1;
    if (($todayDate >= $DateBegin)) {
        $financial_year = $yy . "-" . $yy1;
    } else if (($todayDate < $DateBegin)) {
        $financial_year = $yy2 . "-" . $yy;
    }
    $data = explode("-", $financial_year);
    $startdate = $data[0] . "-04-01";
    $enddate = date('Y-m-d');
}
$enddate = date('Y-m-d', strtotime($enddate . '+1 day'));
// From Date
if (isset($_SESSION['RESPONSE']['email']) && $_SESSION['RESPONSE']['email'] != '') {
$email = $_SESSION['RESPONSE']['email'];
if (isset($startdate))
    $fromToDateCondition .= " AND DATE(qot.created)>='" . $startdate . "'";
if (isset($enddate))
    $fromToDateCondition .= " AND DATE(qot.created)<='" . $enddate . "'";
$sql_count_ticket = "select status_id, count(*) as count from ost_user_email oue left join ost_ticket qot on oue.user_id = qot.user_id	where oue.address = '" . $email . "'  $fromToDateCondition group by status_id";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql_count_ticket);
$qry_count_tickets = $command->queryAll();
//print_r($qry_count_tickets);die;
$ticket_count_open = 0;
$ticket_count_close = 0;
foreach ($qry_count_tickets as $qry_count_ticket) {
    if (isset($qry_count_ticket['status_id']) && $qry_count_ticket['status_id'] == 1) {
        $ticket_count_open = $qry_count_ticket['count'];
    }
    if (isset($qry_count_ticket['status_id']) && $qry_count_ticket['status_id'] == 3) {
        $ticket_count_close = $qry_count_ticket['count'];
    }
}
$sql_count_qry = "select status_id, count(*) as count from qry_ost_user_email oue left join qry_ost_ticket qot on oue.user_id = qot.user_id	where oue.address = '" . $email . "' $fromToDateCondition group by status_id";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql_count_qry);
$qry_count_qrys = $command->queryAll();
$qry_count_open = 0;
$qry_count_close = 0;
foreach ($qry_count_qrys as $qry_count_qry) {
    if (isset($qry_count_qry['status_id']) && $qry_count_qry['status_id'] == 1) {
        $qry_count_open = $qry_count_qry['count'];
    }
    if (isset($qry_count_qry['status_id']) && $qry_count_qry['status_id'] == 3) {
        $qry_count_close = $qry_count_qry['count'];
    }
}
$fromToDateConditiong = '';
if (isset($startdate))
    $fromToDateConditiong .= " AND DATE(bg.grievence_created_on)>='" . $startdate . "'";
if (isset($enddate))
    $fromToDateConditiong .= " AND DATE(bg.grievence_created_on)<='" . $enddate . "'";
$sql_count_grv = "select grievance_status , count(*) as count from bo_grievance bg where bg.grievence_created_by = '" . $email . "' $fromToDateConditiong group by grievance_status";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql_count_grv);
$qry_count_grvs = $command->queryAll();
//print_r($qry_count_grvs);die;
$grv_count_open = 0;
$grv_count_close = 0;
foreach ($qry_count_grvs as $qry_count_grv) {
    if (isset($qry_count_grv['grievance_status']) && $qry_count_grv['grievance_status'] == 'O') {
        $grv_count_open = $qry_count_grv['count'];
    }
    if (isset($qry_count_grv['grievance_status']) && $qry_count_grv['grievance_status'] == 'C') {
        $grv_count_close = $qry_count_grv['count'];
    }
}
?>

<div class="content-blocks">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-list"></i> Help Desk Statistics
            </div>
            <div class="tools" id="tabletoggle">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body desk">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover movetoDashboardold">
                    <thead>
                    <tr>
                        <th style="width: 25%;">Help Desk Statistics</th>
                        <th class="text-center">Open</th>
                        <th class="text-center">Close</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="QUERIES">
                        <th> Queries</th>
                        <td class="text-center"><?php echo $qry_count_open; ?></td>
                        <td class="text-center"><?php echo $qry_count_close; ?></td>
                        <td class="text-center"><?php echo $qry_count_open + $qry_count_close; ?></td>
                    </tr>
                    <tr class="TICKETS">
                        <th> Tickets</th>
                        <td class="text-center"><?php echo $ticket_count_open; ?></td>
                        <td class="text-center"><?php echo $ticket_count_close; ?></td>
                        <td class="text-center"><?php echo $ticket_count_open + $ticket_count_close; ?></td>
                    </tr>
                    <tr class="GRIEVANCE">
                        <th> Grievances</th>
                        <td class="text-center"><?php echo $grv_count_open; ?></td>
                        <td class="text-center"><?php echo $grv_count_close; ?></td>
                        <td class="text-center"><?php echo $grv_count_open + $grv_count_close; ?></td>
                    </tr>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $baseUrl ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= $baseUrl ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= $baseUrl ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
    $(window).on('load', function () {        
        if(!localStorage.getItem('popupShown')) {
            localStorage.setItem("popupShown", "true");
            $('#welcome-popup').modal('show');
            
        }
    });
</script>
<script>   
    $(".BM").click(function () {
		var status = $(this).attr('rel');
		if(status){
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/BM/status/"+status;
		}else{
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/BM";
		}
    });
    $(".Incop").click(function () {
		var status = $(this).attr('rel');
		if(status){
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Incop/status/"+status;
		}else{
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Incop";
		}
    });
    $(".Conti").click(function () {
       	var status = $(this).attr('rel');
		if(status){
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Cont/status/"+status;
		}else{
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Cont";
		}
    });
	$(".Amal").click(function () {
      	var status = $(this).attr('rel');
		if(status){
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Amal/status/"+status;
		}else{
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/Amal";
		}
    });
	$(".ClS").click(function () {
       	var status = $(this).attr('rel');
		if(status){
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/ClS/status/"+status;
		}else{
			window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>/stype/ClS";
		}
    });
    $(".QUERIES").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>";
    });
    $(".TICKETS").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>";
    });
    $(".GRIEVANCE").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>";
    });
    $(".DMS").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>";
    });
 
</script>

<style>
    .modal {
        text-align: center;
    }
    @media screen and (min-width: 768px) {
        .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
        }
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
   
	.welcome-msg-ol li{
	margin-bottom:10px;
    list-style-type:decimal;
 }
 .global-popup .modal-header{
  background: #32c5d2;
  color: #fff;
 }
 .global-popup .modal-title{
  font-size:16px;
  font-weight:bold;
 }
.global-popup .modal-header .close{
  opacity: 1 !important;
  color: #fff !important;
  font-size: 22px !important;
  text-indent: 0 !important;
  margin-top: -23px !important;
  width: auto !important;
  height: auto !important;
  background:none !important;
 }
 .global-popup-mid-hd{
  font-size: 15px;
  font-weight: bold;
  margin: 25px 0 15px;
 }
 .global-popup-orange-link{
  color:#f6672e;
 }
 .welcome-msg-ol{
  padding-left: 15px;
 }
</style>




