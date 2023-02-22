<?php
/* @var $this HomeController */
//$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;

?>
<div class="dashboard-welcome">
    <?php
    if (!empty(@$_SESSION['RESPONSE']['user_id']))
        echo '<h2>Welcome to Applicant Monitoring Panel - Uttarakhand</h2>';
    else {   }
    ?>
    <div class="welcome-date hidden-xs"><i class="icon-calendar"></i> <?php echo date('d-M-Y'); ?></div>
    <div class="clearfix"></div>
</div>
<div class="fy-year content-blocks">
    <?php
    if (!isset($_GET['financial_year']))
        $financial_year = 'ALL';
    else
        $financial_year = $_GET['financial_year'];
    ?>
    <form name="form" action="" method="GET">
   
    </form>
</div>
<?php 
$urlOfnextLevel = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/financial_year/$financial_year";
$urlOfnextLevelCAF = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/financial_year/$financial_year";
$urlOfnextLevelEU = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/EU/financial_year/$financial_year";
$urlOfnextLevelSERVICES = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/$financial_year";
$urlOfnextLevelQUERIES = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/QUERIES/financial_year/$financial_year";
$urlOfnextLevelTICKETS = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/financial_year/$financial_year";
$urlOfnextLevelGRIEVANCE = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/GRIEVANCE/financial_year/$financial_year";
$urlOfnextLevelDMS = "/backoffice/dms/DocumentManagement/myDocuments";
?>
<div class="invest-dashboard-top-charts content-blocks">
    <div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats grey">
                <h3 class="incomplete"></h3>
                <p>Incomplete</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats orange2">
                <h3 class="pending"></h3>
                <p>Pending</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats green2">
                <h3 class="reverted"></h3>
                <p>Reverted</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats">
                <h3 class="inprogress"></h3>
                <p>In Process</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="round-stats green3">
                <h3 class="rejected"></h3>
                <p>Disposed</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php $userID = $_SESSION['RESPONSE']['user_id']; ?>
<div class="content-blocks">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-list"></i> Departmental Services Statistics
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
                        <tr style="width: 25%;">
                            <th>Service</th>
                            <th style="text-align: center!important;"> Archived</th>
                            <th style="text-align: center!important;"> Incomplete</th>
                            <th style="text-align: center!important;"> Pending</th>
                            <th style="text-align: center!important;"> Reverted</th>
                            <th style="text-align: center!important;"> In Process</th>
                            <th style="text-align: center!important;"> Approved</th>
                            <th style="text-align: center!important;"> Rejected</th>
                            <th style="text-align: center!important;"> Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr class="CAF">
                        <th> In-Principle Approval (CAF)</th>
                        <td class="text-center">
                            <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'Z', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $incomplete1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'I', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $pending1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'P', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $reverted1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'H', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $inProgress1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'F', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $approved1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'A', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rejected1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '1', 'R', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $totalCAF = $archived + $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?>
                        </td>
                    </tr>
                    <tr class="EU">
                        <th>Existing unit Registration</th>
                        <td class="text-center">
                            <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'Z', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $incomplete2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'I', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $pending2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'P', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $reverted2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'H', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $inProgress2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'F', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $approved2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'A', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rejected2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '11', 'R', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $totalExistingCAF = $archived + $incomplete2 + $pending2 + $reverted2 + $inProgress2 + $approved2 + $rejected2; ?>
                        </td>
                    </tr>
                    <tr class="SERVICES">
                        <th> Applications for Dept. Services <br>(with Approved CAF)</th>
                        <td class="text-center">
                            <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'Z', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $incomplete3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'ServiceIncomplete', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $pending3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'P', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $reverted3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'RBI', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $inProgress3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'ServiceInprogress', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $approved3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'A', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rejected3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'R', 'Y', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $totalExistingCAF = $archived + $incomplete3 + $pending3 + $reverted3 + $inProgress3 + $approved3 + $rejected3; ?>
                        </td>
                    </tr>
                    </tr>
                    <tr class="SERVICES" style="display:none;">
                        <th> Applications for Dept. Services <br>(without CAF)</th>
                        <td class="text-center">
                            <?php echo $archived4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'Z', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $incomplete4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, "ServiceIncomplete", 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $pending4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'P', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $reverted4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'RBI', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $inProgress4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'ServiceInprogress', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $approved4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'A', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rejected4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices($userID, 'R', 'N', 'INV', $financial_year); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $totalExistingCAF = $archived + $incomplete4 + $pending4 + $reverted4 + $inProgress4 + $approved4 + $rejected4; ?>
                        </td>
                    </tr>
                    <tr class="SERVICES">
                        <th> Applications for Dept. Services <br>(without CAF)</th>
                        <td class="text-center">
                            <?php $archived5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'Z', 'INV', $financial_year); echo ($archived5+$archived4); ?>
                        </td>
                        <td class="text-center">
                            <?php  $incomplete5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'I', 'INV', $financial_year);echo ($incomplete5+$incomplete4); ?>
                        </td>
                        <td class="text-center">
                            <?php  $pending5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'P', 'INV', $financial_year); echo ($pending5+$pending4);?>
                        </td>
                        <td class="text-center">
                            <?php $reverted5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'H', 'INV', $financial_year); echo ($reverted5+$reverted4); ?>
                        </td>
                        <td class="text-center">
                            <?php  $inProgress5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'F', 'INV', $financial_year); echo ($inProgress5+$inProgress4);?>
                        </td>
                        <td class="text-center">
                            <?php  $approved5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'A', 'INV', $financial_year); echo ($approved5+$approved4);?>
                        </td>
                        <td class="text-center">
                            <?php  $rejected5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor($userID, '8', 'R', 'INV', $financial_year);  echo ($rejected5+$rejected4);?>
                        </td>
                        <td class="text-center">
                            <?php echo $totalLandApplication = $archived5 + $incomplete5 + $pending5 + $reverted5 + $inProgress5 + $approved5 + $rejected5 + $archived4 + $incomplete4 + $pending4 + $reverted4 + $inProgress4+ $approved4 + $rejected4; ?>
                        </td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="content-blocks">
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
</div>
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
<div class="modal fade global-popup" id="welcome-popup2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Welcome to Uttarakhand Single Window Clearance System!!</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ol class="welcome-msg-ol">
                            <li>Are you aware that information on various departmental clearances for your specific business can be ascertained through using the Information Wizard?<br/><a href="https://caipotesturl.com/check-services" target = "_blank">Click here to start the information Wizard</a></li>
                            <li>If you are interested in seeing all the clearances issued by a particular department.<br/><a href="https://caipotesturl.com/site/ServiceListingNew/iw/Y" target = "_blank">Click here to access the Departmental Services page</a></li>
                            <li>If you have any specific query regarding incentives, availability of industrial land etc, you can contact our Investment Promotion and Facilitation Cell.<br/><a href="https://caipotesturl.com/query/autologin.php?luser=<?php echo $email;?>&flag=open&type=investor">Click here to raise a query to Investment Promotion and Facilitation Cell</a></li>
                            <li>Or you can call our help desk on 1800 270 1213 between 10 am to 5 pm.</li>
                        </ol>
                        <div>
                            <h6 class="global-popup-mid-hd">Working of Single Window Clearance Mechanism</h6>
                            <ol class="welcome-msg-ol">
                                <li>If you are setting up a new enterprise or expanding an existing enterprise, you have to apply for an In-Principle approval from the state government. – <br/><a href="/backoffice/frontuser/home/cafForm">Click here to apply for In-Principle Approval</a><br/><a href="https://caipotesturl.com/themes/backend/uploads/User_Manual_CAF.pdf" target = "_blank" class="global-popup-orange-link">Help !! Click here to open guide for filling up CAF Application form</a></li>
                                <li>Once In-Principle Approval is granted, you have to apply for Pre-Establishment\ Services of the various departments. – <br/><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES">Click here to apply for Departmental Services</a></li>
                                <li>If you are eligible for incentives you have to apply for Pre-Eligibility Certificate / Registration number,<br/><a href="/backoffice/frontuser/application_form/applicationListIncentive/service/Incentive/serviceProvider/9/type/Incentive">Click here to apply for Pre-Eligibility Certificate</a></li>
                            </ol>
                        </div>
                        <div>
                            <h6 class="global-popup-mid-hd">Getting Help</h6>
                            <ol class="welcome-msg-ol">
                                <li>If you are facing any issue in filling up forms on Single Window System or have encountered a technical glitch, you can raise to ticket so that the technical team can resolve the issue<br/><a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/financial_year/ALL">Click here to raise a Ticket on Investment Promotion and Facilitation Cell</a></li>
                                <li>You can also call on our help desk on 1800 270 1213 between 10 am to 5 pm to seek help.</li>
                                <li>If you feel that the services given have not been up to the mark, and would like to escalate the matter, then you can post your grievance on the Single Window system. The raised grievance is forwarded to the Head of the Department for resolution<br/><a href="/backoffice/GrievanceNew/grievanceDetail/createGrievance/type/GRIEVANCE" class="global-popup-orange-link">Click here to post your grievance</a></li>
                            </ol>
                        </div>
                    </div>
                    <!--<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>-->
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
        //$('#welcome-popup').modal('show');
        if(!localStorage.getItem('popupShown')) {

            localStorage.setItem("popupShown", "true");
            $('#welcome-popup').modal('show');
            //sessionStorage.clear();
        }
    });
</script>
<script>
    //  $(".movetoDashboard").click(function(){
    //    window.location.href="<?php echo $urlOfnextLevel; ?>";
    //  }
    $(".CAF").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelCAF; ?>";
    });
    $(".EU").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelEU; ?>";
    });
    $(".SERVICES").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelSERVICES; ?>";
    });
    $(".QUERIES").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelQUERIES; ?>";
    });
    $(".TICKETS").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelTICKETS; ?>";
    });
    $(".GRIEVANCE").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelGRIEVANCE; ?>";
    });
    $(".DMS").click(function () {
        window.location.href = "<?php echo $urlOfnextLevelDMS; ?>";
    });
    $(".incomplete").html("<?php echo $totalIncomplete = $incomplete1 + $incomplete2 + $incomplete3 + $incomplete4 + $incomplete5; ?>");
    $(".pending").html("<?php echo $totalPending = $pending1 + $pending2 + $pending3 + $pending4 + $pending5; ?>");
    $(".reverted").html("<?php echo $totalReverted = $reverted1 + $reverted2 + $reverted3 + $reverted4 + $reverted5; ?>");
    $(".inprogress").html("<?php echo $totalInprogress = $inProgress1 + $inProgress2 + $inProgress3 + $inProgress4 + $inProgress5 ?>");
    $(".rejected").html("<?php $totalapproved = $approved1 + $approved2 + $approved3 + $approved4 + $approved5;
    $totalRejected = $rejected1 + $rejected2 + $rejected3 + $rejected4 + $rejected5;
    echo $totalapproved + $totalRejected ?>");
</script>






