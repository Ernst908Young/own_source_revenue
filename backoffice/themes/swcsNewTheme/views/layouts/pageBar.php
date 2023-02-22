<?php

$flag = 0;
if (!isset($_GET['type'])) {
    $_GET['type'] = 'CAF';
}
if (!empty($_GET['financial_year'])) {
    $fy = "/financial_year/" . $_GET['financial_year'];
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
	//print_r($_GET);die;
	$userID = base64_decode($_GET['uid']);
	$uidencode = base64_encode($_GET['uid']);
	
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
	$typo = "uid/$uidencode/iuid/$_GET[iuid]" . $fy;
}
else if ($_SESSION['investor_login'] == 1) {

    $flag = 1;
}else {
    $userID = 0;
}
$encode_userID = base64_encode($userID);
$urlI = "/backoffice/frontuser/home/investorWalkthroughLevel2/" . $typo;
if (isset($_GET['iuid'])){

                    
                    
}
?>
<style>.homeredirect:hover{color:blue;}
    .mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
    .dt-buttons{margin-top:-222px !important}
    
    <?php if($flag==0){ ?>
        .newinvdashboadr{display:none}
        
    <?php }else{?>
        .newinvdashboadr{display:content}
  <?php   } ?>
</style>	
</br>



<div class="page-bar newinvdashboadr">
    <div class="col-md-8">
        <ul class="page-breadcrumb">
            <li>
                <span class="pull-left"><a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a><b> <?php
                        if (!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) {
                            echo "Welcome to Investor Monitoring Panel - Uttarakhand";
                        } elseif (isset($iuid) && $iuid != '') {
                            echo " Details of IUID - " . $iuid;
                        } else {
                            echo "Welcome to Investor Monitoring Panel - Uttarakhand";
                        }
                        ?> 
                    </b></span> 
            </li>
        </ul>
    </div>
    <div class="col-md-4">
        <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/<?php echo @$_GET['type']; ?>/financial_year/<?php echo @$_GET['financial_year'] ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
    </div>

</div>	


<?php if (!isset($_GET['dboard'])) { ?>
    <div class="page-bar newinvdashboadr">
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
                </tbody></table>
        </form>
    </div>
    <br class="newinvdashboadr">
<?php } ?>
<div class="mt-element-step newinvdashboadr">

    <div class="row step-thin">

        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "CAF") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/<?php echo $typo; ?>">
            <div class="mt-step-number bg-white font-grey">1</div>
            <div class="mt-step-title uppercase font-grey-cascade"></div>
            <div class="mt-step-content font-grey-cascade" title=" In-Principle Approvals (CAF)">In-Principle Approvals</div>
        </div>


        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "EU") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/EU/<?php echo $typo; ?>">

            <div class="mt-step-number bg-white font-grey">2</div>
            <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>

            <div class="mt-step-content font-grey-cascade" title="Existing unit Registration" > Existing unit Registration</div>

        </div>



        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "SERVICES") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/<?php echo $typo; ?>">
            <div class="mt-step-number bg-white font-grey">3</div>
            <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/boApplicationSubmission/CafTrackingTimeline/application/MjIwNA=="></a></div>
            <div class="mt-step-content font-grey-cascade" title="Applications for Dept. Services">Dept. Services</div>
        </div>


        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "QUERIES") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/QUERIES/<?php echo $typo; ?>">
            <div class="mt-step-number bg-white font-grey">4</div>
            <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>
            <div class="mt-step-content font-grey-cascade" title="Raised Queries">Raised Queries</div>
        </div>

        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "TICKETS") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/<?php echo $typo; ?>">
            <div class="mt-step-number bg-white font-grey">5</div>
            <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/boApplicationSubmission/CafTrackingTimeline/application/MjIwNA=="></a></div>
            <div class="mt-step-content font-grey-cascade"title="Raised Tickets">Raised Tickets</div>
        </div>
        <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "GRIEVANCE") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/GRIEVANCE/<?php echo $typo; ?>">
            <div class="mt-step-number bg-white font-grey">6</div>
            <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>

            <div class="mt-step-content font-grey-cascade"title="Raised Grievances">Raised Grievances</div>
        </div>

<!-- <div style="margin-top:10px;" class="col-md-2 bg-grey  mt-step-col <?php // if($_GET['type']=="LAND"){  ?> done <?php //}  ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/LAND/<?php //echo $typo;  ?>">
    <div class="mt-step-number bg-white font-grey">7</div>
    <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>
    
    <div class="mt-step-content font-grey-cascade"title="Land Applications">Land Applications</div>
</div>-->
    </div>
</div><br class="newinvdashboadr">

<?php if (isset($_GET['type']) && $_GET['type'] == 'QUERIES') { ?>
    <div class="applycaf">
        <span class="pull-left" style=""><a href="https://caipotesturl.com/query/autologin.php?luser=<?php echo $email;?>&flag=open&type=investor"><i class=""></i>&nbsp; Ask a Question to our team </a></span>
    </div>
    <br><br>

<?php } ?>

<?php if (isset($_GET['type']) && $_GET['type'] == 'TICKETS') { ?>
    <div class="applycaf">
        <span class="pull-left" style=""><a href="https://caipotesturl.com/ticket/open.php?type=TICKETS&user_id=<?php echo $encodeuserID; ?>>" class="btn btn-success"><i class=""></i>&nbsp; Create Ticket </a></span>
    </div>
    <br><br>

<?php } ?>

<?php if (isset($_GET['type']) && $_GET['type'] == 'GRIEVANCE') { ?>
    <div class="applycaf">
        <span class="pull-left" style=""><a href="/backoffice/GrievanceNew/grievanceDetail/createGrievance/type/GRIEVANCE<?php echo $typo; ?>" class="btn btn-success"><i class=""></i>&nbsp; Not happy with our services : Click here to raise grievance </a></span>
    </div>


<?php } ?>	



<script>
    // alert("==");
    $(document).ready(function () {
        // alert("==");
        $(".mt-step-col").css('cursor', 'pointer');
        $(".mt-step-col").click(function () {
            var relurl = $(this).attr("relurl");
            // alert(relurl);
            window.location.href = relurl;
        });
    });

</script>