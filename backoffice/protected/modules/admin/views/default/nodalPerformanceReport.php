<?php $type="fy"; extract($_GET); //die;?>
<?php  //echo $type;?>
<style>
    table tr th {text-align: left;}
    table tr td {text-align: center;}
    .cf{display:none;}
    .fy{display:none;}
    .both{display:none;} 
    .padleft60{padding-left:40px !important;}
    <?php if(empty(@$type)){@$type == "fy"; } //echo "==".@$type; ?>
    <?php if ($type == "fy") { ?>.fy{display : block;} <?php } ?>
    <?php if ($type == "cf") { ?>.cf{display : block;} <?php } ?>
    <?php if ($type == "both") { ?>.both{display : block;} <?php } ?>
</style>


<section class="panel site-min-height" style="display:">
    <header class="panel-heading" style="background-color: #32c5d2;font-weight:bold;text-align:center;font-size:20px;">
        Nodal Agency Performance Report <!--<?php echo " From " . $startdate . " To " . $enddate; ?>-->
    </header>
    <div class="panel-body">
<!--        <div class="row" style="margin:0px 0 20px 0;">
	<label for="" class="col-lg-2 col-sm-2 control-label" style="margin-top:8px;font-weight: bold;"><b>Select Options:</b></label>
	<div class="col-lg-4">	
            onchange="window.location='/backoffice/admin/default/index/type/'+this.value"
	<select name="filterOption" class="form-control" onchange="window.location='/backoffice/admin/default/NodalPerformenceReport/startdate/2018-04-01/enddate/2019-03-31/type/'+this.value">
           
	</div>
		</div>-->
        
        <?php extract($_GET); ?>
        <div class="table table-scrollable">

            <?php $applicationSubmisttedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7); ?>
            <?php $applicationSubmisttedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4); ?>  

            <?php $applicationSubmittedCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7); ?> 
            <?php $applicationSubmittedCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4);//V','R','P','Z','RBI','IBD','RB','RBN','F ?>


            <?php $applicationResponseRecivedFromApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7); ?> 
            <?php /* Currently In Reverted Mode  (Nodal To Investor) */
            $applicationPendingForResponseAtApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'");
            /* Overall Reverted (Nodal To Investor) */
           // $applicationResponseRecivedFromApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'RBI'", $startdate, $enddate, 7);
            /* Response on reverted and not pending at investor */;
            // $applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantSelectedFYDistrict;
            ?>

            <?php // $applicationResponseRecivedFromApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'RBI'", $startdate, $enddate, 7); ?>
                <?php /* Currently In Reverted Mode  (Nodal To Investor) */ $applicationPendingForResponseAtApplicantSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'");  
                /* Overall Reverted (Nodal To Investor) */ $applicationResponseRecivedFromApplicantSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 4);
                /* Response on reverted and not pending at investor */;
 
            $applicationResponseRecivedFromApplicantSelectedFYState - $applicationPendingForResponseAtApplicantSelectedFYState;
            ?>
            <?php $arrfasfyd = ($applicationResponseRecivedFromApplicantSelectedFYDistrict - $applicationPendingForResponseAtApplicantSelectedFYDistrict);
            $arrfasfys = ($applicationResponseRecivedFromApplicantSelectedFYState - $applicationPendingForResponseAtApplicantSelectedFYState);
            ?>

            <?php $applicationResponseRecivedFromApplicantCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 7); ?> 
            <?php $applicationResponseRecivedFromApplicantCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'RBI'", $startdate, $enddate, 4); ?> 
            
          
            <?php $applicationPendingForResponseAtApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'H'"); ?> 
            <?php $applicationPendingForResponseAtApplicantSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'H'"); ?>

            <?php  $applicationPendingForResponseAtApplicantCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'H'"); ?> 
            <?php $applicationPendingForResponseAtApplicantCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'H'"); ?> 

            <?php $applicationForwardedToDepartmentSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'F'"); ?>  
            <?php $applicationForwardedToDepartmentSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'F'"); ?>  

            <?php $applicationForwardedToDepartmentCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'F'"); ?> 
            <?php $applicationForwardedToDepartmentCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'F'"); ?> 

            <?php $applicationUnderProcessAtNodalSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 7); ?>
            <?php $applicationUnderProcessAtNodalSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'UNDER_PROCESSEED'", $startdate, $enddate, 4); ?>

            <?php $applicationUnderProcessAtNodalCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 7); ?> 
            <?php $applicationUnderProcessAtNodalCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'UNDER_PROCESSEED'", $startdate, $enddate, 4); ?> 

            <?php $applicationPendingAtNodalSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 7); ?>
            <?php $applicationPendingAtNodalSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'PENDING'", $startdate, $enddate, 4); ?>

            <?php $applicationPendingAtNodalCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 7); ?> 
            <?php $applicationPendingAtNodalCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("'PENDING'", $startdate, $enddate, 4); ?> 

            <?php $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 33); ?>  
            <?php $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 34); ?>
            <?php //echo 0; ?>
            <?php $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 33); ?>   
            <?php $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 34); ?> 

            <?php $applicationApprovedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'A'"); ?>
            <?php $applicationApprovedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'A'"); ?>

            <?php $applicationApprovedCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'A'"); ?> 
            <?php $applicationApprovedCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'A'"); ?> 

            <?php $applicationRejectedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7, "'R'"); ?> 
            <?php $applicationRejectedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4, "'R'"); ?>

            <?php $applicationRejectedCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7, "'R'"); ?> 
            <?php $applicationRejectedCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4, "'R'"); ?> 

            <table class="table-responsive table  table-hover table-bordered">
                <thead> <tr style="background-color:#BBBBBB;">
                        <th><span class="pull-left"><?php $cat = array('fy' => 'Selected Financial Year', 'cf' => 'Carry Forwarded', 'both' => 'Selected Financial Year & Carry Forwarded');
echo @$cat[$type]; ?></span><span class="pull-right">  <form name="form" id="yuiop" action="" method="POST" > 
	<select name="type" id="typData" class="form-control" >
		    <option value="fy" <?php if($type=="fy"){echo " selected";  }?>>Financial Year</option>
				<option value="cf" <?php if($type=="cf"){echo " selected";} ?>>Carry Forwarded</option>
				<option value="both" <?php if($type=="both"){echo " selected";} ?>>Both</option>
	</select>
                 
            <input type="hidden" name="financial_year" id="fyt" value="<?php echo @$financial_year; ?>">
            </form></span></th>
                        <th style="text-align:center;">District</th>
                        <th style="text-align:center;">State</th>
                        <th style="text-align:center;">Total</th>

                    </tr>
                </thead>

<?php if ($type == "both") { ?>
                    <tr >
                        <th style="background:#f3f4f6">1 : Application Submitted</th>
                        <td title="BOTH"><?php echo $districtCount = $applicationSubmisttedSelectedFYDistrict + $applicationSubmittedCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationSubmisttedSelectedFYState + $applicationSubmittedCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>

                        <?php if ($type == "fy") { ?> <tr>
                        <th style="background:#f3f4f6">1 : Application Submitted </th>
                        <td title="Applications Submitted "><?php echo $applicationSubmisttedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7); ?></td>
                        <td  title="Applications Submitted" ><?php echo $applicationSubmisttedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4); ?></td>  
                        <td  title="Applications Submitted"><?php echo $applicationSubmisttedSelectedFYDistrict + $applicationSubmisttedSelectedFYState; ?></td>
                    </tr><?php } ?>

                        <?php if ($type == "cf") { ?>
                    <tr>
                        <th style="background:#f3f4f6">1 : Application Submitted</th>
                        <td title="Applications Submitted"><?php echo $applicationSubmittedCarryForwadedDistrict; ?> </td>
                        <td  title="Applications Submitted"><?php echo $applicationSubmittedCarryForwadedState; ?> </td>
                        <td  title="Applications Submitted"><?php echo $applicationSubmittedCarryForwadedDistrict + $applicationSubmittedCarryForwadedState; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr>                   
                        <th style="background:#f3f4f6; ">2 : Applications Reverted   </th>
                        <td title="BOTH"><?php 
                       echo $districtCount=($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantCarryForwadedDistrict)+($applicationResponseRecivedFromApplicantCarryForwadedDistrict-$applicationPendingForResponseAtApplicantCarryForwadedDistrict)+($applicationPendingForResponseAtApplicantSelectedFYDistrict + $applicationPendingForResponseAtApplicantCarryForwadedDistrict);
                        
                       // echo $districtCount = $arrfasfyd; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationResponseRecivedFromApplicantSelectedFYState+$applicationResponseRecivedFromApplicantCarryForwadedState+$applicationPendingForResponseAtApplicantSelectedFYState + $applicationPendingForResponseAtApplicantCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>

                        <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6">2 : Applications Reverted  </th>
                        <td title="Responses received from Applicant for Query"> <?php echo $a=($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantSelectedFYDistrict)+$applicationPendingForResponseAtApplicantSelectedFYDistrict; ?>
                        </td>  
                        <td title="Responses received from Applicant for Query"><?php echo $b=($applicationResponseRecivedFromApplicantSelectedFYState+$applicationPendingForResponseAtApplicantSelectedFYState); ?>
                       </td>
                        <td title="Responses received from Applicant for Query"><?php  
                        echo $a+$b;?></td>
                    </tr><?php } ?>
                     <?php if ($type == "cf") { ?><tr> 
                            <th style="background:#f3f4f6" class="padleft60">2 : Applications Reverted </th> 
                        <td title="Responses received from Applicant for Query"><?php echo $a=$applicationResponseRecivedFromApplicantCarryForwadedDistrict+$applicationPendingForResponseAtApplicantCarryForwadedDistrict?> </td>
                        <td title="Responses received from Applicant for Query"><?php echo $b=$applicationResponseRecivedFromApplicantCarryForwadedState+$applicationPendingForResponseAtApplicantCarryForwadedState ?> </td>
                        <td title="Responses received from Applicant for Query"><?php echo $a+$b; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr>                   
                        <th style="background:#f3f4f6;" class="padleft60">2.1 : Responses received from Applicant for Query  </th>
                        <td title="BOTH"><?php 
                       echo $districtCount=($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantCarryForwadedDistrict)+($applicationResponseRecivedFromApplicantCarryForwadedDistrict-$applicationPendingForResponseAtApplicantCarryForwadedDistrict);                        
                       // echo $districtCount = $arrfasfyd; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationResponseRecivedFromApplicantSelectedFYState+$applicationResponseRecivedFromApplicantCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>

                        <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6" class="padleft60">2.1 : Responses received from Applicant for Query </th>
                        <td title="Responses received from Applicant for Query"> <?php echo $a=($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantSelectedFYDistrict); ?>
                        </td>  
                        <td title="Responses received from Applicant for Query"><?php echo $b=$applicationResponseRecivedFromApplicantSelectedFYState ?>
                       </td>
                        <td title="Responses received from Applicant for Query"><?php  
                        echo $a+$b;?></td>
                    </tr><?php } ?>

                        <?php if ($type == "cf") { ?><tr> 
                            <th style="background:#f3f4f6" class="padleft60">2.1 : Responses received from Applicant for Query</th> 
                        <td title="Responses received from Applicant for Query"><?php echo $a=$applicationResponseRecivedFromApplicantCarryForwadedDistrict?> </td>
                        <td title="Responses received from Applicant for Query"><?php echo $b=$applicationResponseRecivedFromApplicantCarryForwadedState ?> </td>
                        <td title="Responses received from Applicant for Query"><?php echo $a+$b; ?></td>
                    </tr><?php } ?>

                     <?php if ($type == "both") { ?><tr title="both">
                        <th style="background:#f3f4f6;"  class="padleft60">2.2 : Pending for response  </th>
                        <td title="BOTH"><?php echo $districtCount = $applicationPendingForResponseAtApplicantSelectedFYDistrict + $applicationPendingForResponseAtApplicantCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationPendingForResponseAtApplicantSelectedFYState + $applicationPendingForResponseAtApplicantCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>

<?php if ($type == "fy") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">2.2 : Pending for response</th>
                        <td title="Pending for response"><?php echo $applicationPendingForResponseAtApplicantSelectedFYDistrict; ?> </td>
                            <td title="Pending for response"><?php echo $applicationPendingForResponseAtApplicantSelectedFYState; ?> </td>
                        <td title="Pending for response"><?php echo @$applicationPendingForResponseAtApplicantSelectedFYDistrict + @$applicationPendingForResponseAtApplicantSelectedFYState; ?></td>
                    </tr><?php } ?>

<?php if ($type == "cf") { ?><tr> 
                        <th style="background:#f3f4f6" class="padleft60">2.2 : Pending for response</th> 
                        <td title="Pending for response"><?php echo $applicationPendingForResponseAtApplicantCarryForwadedDistrict; ?> </td>
                        <td title="Pending for response"><?php echo $applicationPendingForResponseAtApplicantCarryForwadedState; ?> </td>
                        <td title="Pending for response"><?php echo @$applicationPendingForResponseAtApplicantCarryForwadedDistrict + @$applicationPendingForResponseAtApplicantCarryForwadedState; ?></td>
                    </tr><?php } ?>

                <?php if ($type == "both") { ?><tr >
                        <th  style="background:#f3f4f6" >3 : Applications Forwarded to Department  </th>
                        <td title="BOTH"><?php echo $districtCount = $applicationForwardedToDepartmentSelectedFYDistrict + $applicationForwardedToDepartmentCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationForwardedToDepartmentSelectedFYState + $applicationForwardedToDepartmentCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>
                <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6">3 : Applications Forwarded to Department  </th>
                        <td title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentSelectedFYDistrict; ?></td>  
                        <td  title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentSelectedFYState; ?></td>  
                        <td  title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentSelectedFYDistrict + $applicationForwardedToDepartmentSelectedFYState; ?></td>
                    </tr><?php } ?>
                  <?php if ($type == "cf") { ?><tr> 
                        <th style="background:#f3f4f6">3 : Applications Forwarded to Department </th> 
                        <td title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentCarryForwadedDistrict; ?> </td>
                        <td  title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentCarryForwadedState; ?> </td>
                        <td  title="Applications Forwarded to Department"><?php echo $applicationForwardedToDepartmentCarryForwadedDistrict + $applicationForwardedToDepartmentCarryForwadedState; ?></td>
                    </tr><?php } ?>

                 <?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;" >4 : Application Not forwarded to Department </th>
                        <td title="BOTH"><?php echo $districtCount = ($applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalCarryForwadedDistrict)+($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) + ($applicationPendingAtNodalCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict); ?></td>
                        <td title="BOTH"><?php echo $stateCount = ($applicationUnderProcessAtNodalSelectedFYState + $applicationUnderProcessAtNodalCarryForwadedState)+($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) + ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6">4 : Application Not forwarded to Department </th>
                        <td title="Under process at DIC/ DoI"><?php echo $dv=($applicationUnderProcessAtNodalSelectedFYDistrict)+($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict); ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $sv=($applicationUnderProcessAtNodalSelectedFYState)+($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $dv + $sv; ?></td>
                    </tr><?php } ?>

                <?php if ($type == "cf") { ?><tr>
                        <th style="background:#f3f4f6">4 : Application Not forwarded to Department </th> 
                        <td title="Under process at DIC/ DoI"><?php echo $dv=$applicationUnderProcessAtNodalCarryForwadedDistrict+($applicationPendingAtNodalCarryForwadedDistrict-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict); ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $sv=$applicationUnderProcessAtNodalCarryForwadedState+($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState); ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $dv + $sv; ?></td>
                    </tr><?php } ?>
                 <?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;"  class="padleft60">4.1 : Under process at DIC/ DoI</th>
                        <td title="BOTH"><?php echo $districtCount = $applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationUnderProcessAtNodalSelectedFYState + $applicationUnderProcessAtNodalCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6" class="padleft60">4.1 : Under process at DIC/ DoI</th>
                        <td title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalSelectedFYDistrict; ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalSelectedFYState; ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalSelectedFYState; ?></td>
                    </tr><?php } ?>

                <?php if ($type == "cf") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">4.1 : Under process at DIC/ DoI</th> 
                        <td title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalCarryForwadedDistrict; ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalCarryForwadedState; ?> </td>
                        <td  title="Under process at DIC/ DoI"><?php echo $applicationUnderProcessAtNodalCarryForwadedDistrict + $applicationUnderProcessAtNodalCarryForwadedState; ?></td>
                    </tr><?php } ?>
<?php if ($type == "both") { ?>
                    <tr  >
                        <th style="background:#f3f4f6;" class="padleft60">4.2 : Pending at DIC/ DoI  </th>
                        <td title="BOTH"><?php echo $districtCount = ($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) + ($applicationPendingAtNodalCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict); ?></td>
                        <td title="BOTH"><?php echo $stateCount = ($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) + ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>

                <?php if ($type == "fy") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">4.2 : Pending at DIC/ DoI </th>
                        <!-- DIC/DOI PENDING = Over all pending - Empowered Commetie Pending -->
                        <td title="FY"><?php echo $applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict; ?> </td>
                        <td  title="FY"><?php echo $applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; ?> </td>
                        <td  title="FY"><?php echo ($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) + ($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "cf") { ?><tr>
                          <!-- DIC/DOI PENDING = Over all pending - Empowered Commetie Pending -->
                        <th style="background:#f3f4f6" class="padleft60">4.2 : Pending at DIC/ DoI</th> 
                        <td title="CF"><?php echo ($applicationPendingAtNodalCarryForwadedDistrict-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict); ?> </td>
                        <td  title="CF"><?php echo ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState); ?> </td>
                        <td  title="CF"><?php echo ($applicationPendingAtNodalCarryForwadedDistrict-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict) + ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState); ?></td>
                    </tr><?php } ?>

                  <?php if ($type == "both") { ?>
                    <tr  > 
                        <th style="background:#f3f4f6" >5 : Applications Approved for Empowered Committee   </th>
                        <td title="BOTH"><?php echo $districtCount = $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict + $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState + $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr><?php } ?>
                <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6">5 : Applications Approved for Empowered Committee  </th>
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict; ?> </td>
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; ?> </td>
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict+$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; ?> </td>
                    </tr><?php } ?>
                    <?php if ($type == "cf") { ?><tr> 
                        <th style="background:#f3f4f6">5 : Applications Approved for Empowered Committee  </th> 
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict; ?></td>
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; ?> </td>
                        <td title="Applications Approved for Empowered Committee"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; ?> </td>
                    </tr><?php } ?>

                    <?php if ($type == "both") { ?>
                    <tr> 
                        <th style="background:#f3f4f6;">6 : Applications Disposed  </th>
                        <td title="BOTH"><?php echo $districtCount = $applicationApprovedSelectedFYDistrict + $applicationApprovedCarryForwadedDistrict+$applicationRejectedSelectedFYDistrict + $applicationRejectedCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationApprovedSelectedFYState + $applicationApprovedCarryForwadedState+$applicationRejectedSelectedFYState + $applicationRejectedCarryForwadedState ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr>
                    <?php } ?>

                    <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6">6 : Applications Disposed </th>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict + $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "cf") { ?><tr>
                        <th style="background:#f3f4f6">6 : Applications Disposed</th> 
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedDistrict; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedState; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr> 
                        <th style="background:#f3f4f6;" class="padleft60">6.1 : Applications Disposed (Approved )  </th>
                        <td title="BOTH"><?php echo $districtCount = $applicationApprovedSelectedFYDistrict + $applicationApprovedCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationApprovedSelectedFYState + $applicationApprovedCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr>
                    <?php } ?>

                    <?php if ($type == "fy") { ?><tr> 
                        <th style="background:#f3f4f6" class="padleft60">6.1 : Applications Disposed (Approved )  </th>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYDistrict; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYState; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedSelectedFYDistrict + $applicationApprovedSelectedFYState; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "cf") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">6.1 : Applications Disposed (Approved ) </th> 
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedDistrict; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedState; ?> </td>
                        <td title="Applications Disposed (Approved)"><?php echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState; ?></td>
                    </tr><?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr  >
                        <th style="background:#f3f4f6;" class="padleft60">6.2 : Applications Disposed (Rejected ) </th>
                        <td title="BOTH"><?php echo $districtCount = $applicationRejectedSelectedFYDistrict + $applicationRejectedCarryForwadedDistrict; ?></td>
                        <td title="BOTH"><?php echo $stateCount = $applicationRejectedSelectedFYState + $applicationRejectedCarryForwadedState; ?></td>
                        <td title="BOTH"><?php echo $districtCount + $stateCount; ?></td>
                    </tr>

                <?php } ?>
                <?php if ($type == "fy") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">6.2 : Applications Disposed (Rejected )</th>
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedSelectedFYDistrict; ?> </td>
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedSelectedFYState; ?> </td>
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedSelectedFYDistrict + $applicationRejectedSelectedFYState; ?></td>
                    </tr><?php } ?>
<?php if ($type == "cf") { ?><tr>
                        <th style="background:#f3f4f6" class="padleft60">6.2 : Applications Disposed (Rejected ) </th> 
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedCarryForwadedDistrict; ?> </td>
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedCarryForwadedState; ?> </td>
                        <td title="Applications Disposed (Rejected)"><?php echo $applicationRejectedCarryForwadedDistrict + $applicationRejectedCarryForwadedState; ?></td>
                    </tr><?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</section>
<div id="loading-mask"></div>
<script>
    
    $(document).ready(function(){
        $("#typData").change(function(){
           var t1 = $(this).val();
            $("#yuiop").attr('action','/backoffice/admin/default/index/type/'+t1);
            var uj=$("#huik").val();
            //console.log(uj);
            $("#fyt").val(uj);
            $("#yuiop").submit();
          //  alert("==");
        });
        
    })
    </script>