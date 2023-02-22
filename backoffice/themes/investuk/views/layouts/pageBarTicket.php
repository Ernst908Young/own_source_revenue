<?php
$flag = 0;
if (!isset($_GET['type'])) {
    $_GET['type'] = 'CAF';
}
if (!empty($_GET['financial_year'])) {
    $fy = "financial_year/" . $_GET['financial_year'];
} else {
    $fy = "";
    $_GET['financial_year'] = "ALL";
}

$email = '';
$typo = "" . $fy;
if(isset($_GET['role_id']) && ($_GET['role_id']==1)) {
    echo '<pre>';print_r($_SESSION);die;
}
if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
    $userID = @$_SESSION['RESPONSE']['user_id'];
    $email=$_SESSION['RESPONSE']['email'];
    $flag = 1;
} 
else if(($_GET['uid']) && ($_GET['uid'] != '') && ($_GET['iuid']) && ($_GET['iuid'] != '')) {
    $userID = base64_decode($_GET['uid']);
    $typo = "uid/$_GET[uid]/iuid/$_GET[iuid]" . $fy;
    $flag = 1;
    $iuid = base64_decode($_GET['iuid']);
    $sql = "select email from sso_users where iuid = $iuid";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql);
    $uData = $command->queryAll();
    if(!empty($uData)){
        $email = $uData[0]['email'];
    }
    $encode_userID = base64_encode($userID);
    }
    else if ($_SESSION['investor_login'] == 1) {
        $flag = 1;
    }else {
        $userID = 0;
    }
$encode_userID = base64_encode($userID);
$urlI = "/backoffice/frontuser/home/investorWalkthroughLevel2/" . $typo;
//if (isset($_GET['iuid'])){} // Commented by Pankaj on 04 Nov 2018 due to blank if condition previously
?>

</br>

<div class="dashboard-welcome">
    <h2 class="full-width">
        <div class="dashboard-inner-hd-left">
            <!--<a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a>-->
            <p class="dashbrd-inner-hd">
                <?php
                   if (!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) {
                        echo "Welcome to Investor Monitoring Panel - Uttarakhand";
                    } elseif (isset($iuid) && $iuid != '') {
                        echo " Details of IUID - " . $iuid;
                    } else {
                        echo "Welcome to Investor Monitoring Panel - Uttarakhand";
                    }

                ?>
            </p>
        </div>
        <div class="dashboard-inner-hd-right">
            <a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/<?php echo @$_GET['type']; ?>/financial_year/<?php echo @$_GET['financial_year'] ?>" class="blue-btn-new">
                <i class="fa fa-angle-left"></i>Back
            </a>
        </div>        
        <!--<br/>
        <div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>-->
        
    </h2>
    <div class="clearfix"></div>
</div>
<?php if (!isset($_GET['dboard'])) { ?>
    <!--<div class="page-bar">
        <form name="form" action="" method="GET"> 
            <table>
                <tbody>
                    <tr>
                        <td style="border:none !important"><b>Currently you are viewing data for <?php echo @$_GET['financial_year']; ?> FY, If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
                        <td style="border:none !important">
                            <select name="financial_year" readonly class="form-control" onchange="window.location = '/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/financial_year/' + this.value">
                                <option value="<?php echo @$_GET['financial_year']; ?>"><?php echo @$_GET['financial_year']; ?></option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <br/>-->
<?php } ?>
<div class="invest-dashboard-top-charts content-blocks" style="margin-bottom: 0px !important; height: 133px !important">
        <div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "CAF") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/<?php echo $typo; ?>">
                <span>1</span>
                <p>In-Principle Approvals</p>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "EU") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/EU/<?php echo $typo; ?>">
                <span>2</span>
                <p>Existing unit Registration</p>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "SERVICES") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/<?php echo $typo; ?>">
                <span>3</span>
                <p>Dept. Services</p>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "QUERIES") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/QUERIES/<?php echo $typo; ?>">
                <span>4</span>
                <p>Raised Queries</p>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "TICKETS") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/<?php echo $typo; ?>">
                <span>5</span>
                <p>Raised Tickets</p>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2">
            <a class="top-number-bts <?php if ($_GET['type'] == "GRIEVANCE") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/GRIEVANCE/<?php echo $typo; ?>">
                <span>6</span>
                <p>Raised Grievances</p>
            </a>
        </div>
    </div>
</div><br/>

<?php if (isset($_GET['type']) && $_GET['type'] == 'QUERIES') { ?>
    <div class="applycaf">
        <span class="pull-left">
            <a href="/query/autologin.php?luser=<?php echo $email;?>&flag=open&type=investor">
                <i class=""></i>&nbsp; Ask a Question to our team
            </a>
        </span>
    </div>
    <br><br>

<?php } ?>

<?php if (isset($_GET['type']) && $_GET['type'] == 'TICKETS') { ?>
    <div class="applycaf">
        <span class="pull-left">
            <a href="/ticket/open.php?type=TICKETS&user_id=<?php echo $encodeuserID; ?>>" class="btn btn-success">
                <i class=""></i>&nbsp; Create Ticket
            </a>
        </span>
    </div>
    <br><br>

<?php } ?>

<?php if (isset($_GET['type']) && $_GET['type'] == 'GRIEVANCE') { ?>
    <div class="applycaf">
        <span class="pull-left" style="">
            <a href="/backoffice/GrievanceNew/grievanceDetail/createGrievance/type/GRIEVANCE<?php echo $typo; ?>" class="btn btn-success">
                <i class=""></i>&nbsp; Not happy with our services : Click here to raise grievance
            </a>
        </span>
    </div>

<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(".mt-step-col").css('cursor', 'pointer');
        $(".mt-step-col").click(function () {
            var relurl = $(this).attr("relurl");
            window.location.href = relurl;
        });
    });
</script>