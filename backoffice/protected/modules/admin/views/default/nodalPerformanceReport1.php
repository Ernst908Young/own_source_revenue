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
    <!--<header class="panel-heading" style="background-color: #32c5d2;font-weight:bold;">
        Nodal Agency Performance Report<!--<?php //echo " From " . $startdate . " To " . $enddate; ?>-->
   <!-- </header>-->
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

            <?php 
			// fydas
			$applicationSubmisttedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7); ?>
            <?php $applicationSubmisttedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4); ?>  

            <?php $applicationSubmittedCarryForwadedDistrict = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 7); ?> 
            <?php $applicationSubmittedCarryForwadedState = DefaultController::getNodalPerformenceReportCountOfStatusCarryForward("''", $startdate, $enddate, 4);//V','R','P','Z','RBI','IBD','RB','RBN','F ?>


            <?php
			// fy_apprevert
			$applicationResponseRecivedFromApplicantSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'IBD'", $startdate, $enddate, 7); ?> 
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
                <thead> 
					<tr style="background-color:#BBBBBB;">
                        <th>
							<span class="pull-left"><?php $cat = array('fy' => 'Selected Financial Year', 'cf' => 'Carry Forwarded', 'both' => 'Selected Financial Year & Carry Forwarded');echo @$cat[$type]; ?>
							</span>
							<span class="pull-right">  
							<form name="form" id="yuiop" action="" method="POST" > 
								<select name="type" id="typData" class="form-control" >
									<option value="fy" <?php if($type=="fy"){echo " selected";  }?>>Financial Year</option>
									<option value="cf" <?php if($type=="cf"){echo " selected";} ?>>Carry Forwarded</option>
									<option value="both" <?php if($type=="both"){echo " selected";} ?>>Both</option>
								</select>
								<input type="hidden" name="financial_year" id="fyt" value="<?php echo @$financial_year; ?>">
							</form>
							</span>
						</th>
                        <th style="text-align:center;">District</th>
                        <th style="text-align:center;">State</th>
                        <th style="text-align:center;">Total</th>
                    </tr>
                </thead>
				<tbody>
					<?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6">1 : Application Submitted</th>
                        <td title="BOTH"><?php $districtCount =$applicationSubmisttedSelectedFYDistrict + $applicationSubmittedCarryForwadedDistrict ; ?>
						<?php if(($districtCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount; ?>
							</a> 
						<?php }else{ echo $districtCount; } ?>						
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationSubmisttedSelectedFYState + $applicationSubmittedCarryForwadedState; ?>
						<?php if(($stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $stateCount; ?>
							</a> 
						<?php }else{ echo $stateCount; } ?>
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount + $stateCount; ?>
							</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>
						</td>
                    </tr>
					<?php } ?>

					<?php if ($type == "fy") { ?> 
					<tr>
						<th style="background:#f3f4f6">1 : Application Submitted </th>
						<td title="Applications Submitted ">
							<?php $applicationSubmisttedSelectedFYDistrict = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 7); 
							if($applicationSubmisttedSelectedFYDistrict > 0){
							?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydas/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationSubmisttedSelectedFYDistrict; ?></a>
							<?php }else{ echo $applicationSubmisttedSelectedFYDistrict; } ?>
						</td>
						<td  title="Applications Submitted" >
						<?php $applicationSubmisttedSelectedFYState = DefaultController::getNodalPerformenceReportCountOfStatusSelectedFY("'ISA'", $startdate, $enddate, 4); 
						if($applicationSubmisttedSelectedFYState > 0){
						?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysas/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationSubmisttedSelectedFYState;?> 
						</a>
						<?php }else{  echo $applicationSubmisttedSelectedFYState; } ?>
						</td>  
						<td  title="Applications Submitted">
						<?php 
						if(($applicationSubmisttedSelectedFYDistrict + $applicationSubmisttedSelectedFYState) > 0){
						?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydas_both/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationSubmisttedSelectedFYDistrict + $applicationSubmisttedSelectedFYState; ?>
						</a>
						<?php }else{ echo $applicationSubmisttedSelectedFYDistrict + $applicationSubmisttedSelectedFYState; } ?>
						</td>
					</tr>
					<?php } ?>

                    <?php if ($type == "cf") { ?>
                    <tr>
                        <th style="background:#f3f4f6">1 : Application Submitted</th>
                        <td title="Applications Submitted">
						<?php if($applicationSubmittedCarryForwadedDistrict >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationSubmittedCarryForwadedDistrict; ?>
							</a> 
						<?php }else{ echo $applicationSubmittedCarryForwadedDistrict; } ?>	
						
						</td>
                        <td  title="Applications Submitted">
						<?php if( $applicationSubmittedCarryForwadedState >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationSubmittedCarryForwadedState; ?>
							</a> 
						<?php }else{ echo $applicationSubmittedCarryForwadedState; } ?>	
						</td>
                        <td  title="Applications Submitted">
						<?php if(($applicationSubmittedCarryForwadedDistrict + $applicationSubmittedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_sub/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationSubmittedCarryForwadedDistrict + $applicationSubmittedCarryForwadedState; ?>
							</a> 
						<?php }else{ echo $applicationSubmittedCarryForwadedDistrict + $applicationSubmittedCarryForwadedState; } ?>	
						<?php  ?>
						
						</td>
                    </tr>
					<?php } ?>
                    <?php if($type == "both") { ?>
                    <tr>                   
                        <th style="background:#f3f4f6; ">2 : Applications Reverted   </th>
                        <td title="BOTH">
							<?php 
							   $districtCount=$applicationResponseRecivedFromApplicantSelectedFYDistrict + $applicationResponseRecivedFromApplicantCarryForwadedDistrict +$applicationPendingForResponseAtApplicantSelectedFYDistrict + $applicationPendingForResponseAtApplicantCarryForwadedDistrict;							  					   
						   ?>
						<?php if(($districtCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount; ?>
							</a> 
						<?php }else{ echo $districtCount; } ?>	
					    </td>
                        <td title="BOTH"><?php $stateCount = $applicationResponseRecivedFromApplicantSelectedFYState+$applicationResponseRecivedFromApplicantCarryForwadedState+$applicationPendingForResponseAtApplicantSelectedFYState + $applicationPendingForResponseAtApplicantCarryForwadedState; ?>
						
						<?php if(($stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $stateCount; ?>
							</a> 
						<?php }else{ echo $stateCount; } ?>						
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount + $stateCount; ?>
							</a> 
						<?php }else{ echo ($districtCount + $stateCount); }?>
						</td>
                    </tr>
					<?php } ?>

                    <?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6">2 : Applications Reverted  </th>
                        <td title="Responses received from Applicant for Query"> 										
						<?php $a=($applicationResponseRecivedFromApplicantSelectedFYDistrict + $applicationPendingForResponseAtApplicantSelectedFYDistrict);
						
						/* ($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantSelectedFYDistrict)+$applicationPendingForResponseAtApplicantSelectedFYDistrict; */ ?>
						<?php if(($a) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyd_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $a; ?>
							</a> 
						<?php }else{ echo $a; } ?>	
						
						</td>  
                        <td title="Responses received from Applicant for Query">						
						<?php $b=($applicationResponseRecivedFromApplicantSelectedFYState + $applicationPendingForResponseAtApplicantSelectedFYState); ?>
						<?php if(($b) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fys_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $b; ?>
							</a> 
						<?php }else{ echo $b; } ?>	
                        </td>
                        <td title="Responses received from Applicant for Query">
						<?php if(($a+$b) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyboth_app_rev/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $a+$b; ?>
							</a> 
						<?php }else{ echo $a+$b; } ?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "cf") { ?>
					<tr> 
                        <th style="background:#f3f4f6" class="padleft60">2 : Applications Reverted </th> 
                        <td title="Responses received from Applicant for Query">	
							<?php $a=$applicationResponseRecivedFromApplicantCarryForwadedDistrict+$applicationPendingForResponseAtApplicantCarryForwadedDistrict?> 
						<?php if($a >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_reverted/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $a;?></a>
						<?php }else{echo $a; }?>							
						</td>
                        <td title="Responses received from Applicant for Query"><?php $b=$applicationResponseRecivedFromApplicantCarryForwadedState+$applicationPendingForResponseAtApplicantCarryForwadedState ?>						
						<?php if($b >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_reverted/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $b;?></a>
						<?php }else{echo $b; }?>	
						</td>
                        <td title="Responses received from Applicant for Query">
						<?php if(($a+$b) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_reverted/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $a+$b;?></a>
						<?php }else{echo $a+$b; }?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if($type == "both") { ?>
                    <tr>                   
                        <th style="background:#f3f4f6;" class="padleft60">2.1 : Responses received from Applicant for Query  </th>
                        <td title="BOTH">
						<?php  $districtCount = $applicationResponseRecivedFromApplicantSelectedFYDistrict + $applicationResponseRecivedFromApplicantCarryForwadedDistrict;
						    /* $districtCount=($applicationResponseRecivedFromApplicantSelectedFYDistrict-$applicationPendingForResponseAtApplicantSelectedFYDistrict)+($applicationResponseRecivedFromApplicantCarryForwadedDistrict-$applicationPendingForResponseAtApplicantCarryForwadedDistrict);    */                     
						   // echo $districtCount = $arrfasfyd; 
						?>
						<?php if(($districtCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_res_rec_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount; ?>
							</a> 
						<?php }else{ echo $districtCount; } ?>
					    </td>
                        <td title="BOTH"><?php $stateCount = $applicationResponseRecivedFromApplicantSelectedFYState+$applicationResponseRecivedFromApplicantCarryForwadedState; ?>
						<?php if(($stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_res_rec_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $stateCount; ?>
							</a> 
						<?php }else{ echo $stateCount; } ?>	
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_res_rec_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?></a>
						<?php }else{ echo $districtCount + $stateCount;}?>
						</td>
                    </tr><?php } ?>

                    <?php if ($type == "fy") { ?>
					<tr> 
						<th style="background:#f3f4f6" class="padleft60">2.1 : Responses received from Applicant for Query </th>
						<td title="Responses received from Applicant for Query"> 
						<?php $a=$applicationResponseRecivedFromApplicantSelectedFYDistrict; 
						if($a >0)
						{	
						?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyd_res_rec_from_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $a;?></a>
						<?php }else{ 
							echo $a;
						}
						?>
						</td>  
						<td title="Responses received from Applicant for Query">						
						<?php $b = $applicationResponseRecivedFromApplicantSelectedFYState;						
						if($b >0)
						{
						?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fys_res_rec_from_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $b;?>
						</a>
						<?php }else{ 
							echo $b;
						}
						?>
					   </td>
						<td title="Responses received from Applicant for Query">	
						<?php if(($a+$b) >0)
						{
						?>						
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyboth_res_rec_from_app/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo ($a+$b);?>
						</a>
						<?php }else{ echo $a+$b;} ?>
						</td>
					</tr>
					<?php } ?>

                    <?php if ($type == "cf") { ?>
					<tr> 
					<th style="background:#f3f4f6" class="padleft60">2.1 : Responses received from Applicant for Query</th> 
					<td title="Responses received from Applicant for Query">
					<?php $a=$applicationResponseRecivedFromApplicantCarryForwadedDistrict?> 
					<?php if($a >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_res_rec_app_for_q/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $a;?></a>
					<?php }else{echo $a; }?>
					
					</td>
					<td title="Responses received from Applicant for Query">					
					<?php $b=$applicationResponseRecivedFromApplicantCarryForwadedState ?> 
					<?php if($b >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_res_rec_app_for_q/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $b;?></a>
					<?php }else{echo $b; }?>
					</td>
					<td title="Responses received from Applicant for Query">					
					<?php if(($a+$b) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_res_rec_app_for_q/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $a+$b;?></a>
					<?php }else{echo $a+$b; }?>
					</td>
                    </tr>
					<?php } ?>

                     <?php if ($type == "both") { ?>
						<tr title="both">
							<th style="background:#f3f4f6;"  class="padleft60">2.2 : Pending for response  </th>
							<td title="BOTH"><?php $districtCount = $applicationPendingForResponseAtApplicantSelectedFYDistrict + $applicationPendingForResponseAtApplicantCarryForwadedDistrict; ?>							
							<?php if(($districtCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount; ?>
							</a> 
							<?php }else{ echo $districtCount; } ?>							
							</td>
							<td title="BOTH"><?php $stateCount = $applicationPendingForResponseAtApplicantSelectedFYState + $applicationPendingForResponseAtApplicantCarryForwadedState; ?>
							<?php if(($stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $stateCount; ?>
							</a> 
							<?php }else{ echo $stateCount; } ?>
							
							</td>
							<td title="BOTH">
							<?php if(($districtCount + $stateCount) >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $districtCount + $stateCount; ?>
							</a> 
							<?php }else{ echo $districtCount + $stateCount; } ?>
							
							</td>
						</tr>
					<?php } ?>

					<?php if ($type == "fy") { ?>
						<tr>
							<th style="background:#f3f4f6" class="padleft60">2.2 : Pending for response</th>
							<td title="Pending for response">
							<?php if($applicationPendingForResponseAtApplicantSelectedFYDistrict >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydPfor_response/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationPendingForResponseAtApplicantSelectedFYDistrict; ?> 
							</a>
							<?php }else{ echo $applicationPendingForResponseAtApplicantSelectedFYDistrict;}?>
							</td>
							<td title="Pending for response">
							<?php if($applicationPendingForResponseAtApplicantSelectedFYState > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysPfor_response/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationPendingForResponseAtApplicantSelectedFYState; ?> 
							</a>
							<?php }else{ echo $applicationPendingForResponseAtApplicantSelectedFYState;}?>
							</td>
							<td title="Pending for response">
							<?php if((@$applicationPendingForResponseAtApplicantSelectedFYDistrict + @$applicationPendingForResponseAtApplicantSelectedFYState)>0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothPfor_response/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo @$applicationPendingForResponseAtApplicantSelectedFYDistrict + @$applicationPendingForResponseAtApplicantSelectedFYState; ?>
							</a>
							<?php }else{ echo @$applicationPendingForResponseAtApplicantSelectedFYDistrict + @$applicationPendingForResponseAtApplicantSelectedFYState;}?>
							</td>
						</tr>
					<?php } ?>

					<?php if ($type == "cf") { ?>
					<tr> 
                        <th style="background:#f3f4f6" class="padleft60">2.2 : Pending for response</th> 
                        <td title="Pending for response">
						<?php if(($applicationPendingForResponseAtApplicantCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationPendingForResponseAtApplicantCarryForwadedDistrict;?></a>
						<?php }else{echo $applicationPendingForResponseAtApplicantCarryForwadedDistrict; }?>			
						</td>
                        <td title="Pending for response">
						<?php if(($applicationPendingForResponseAtApplicantCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationPendingForResponseAtApplicantCarryForwadedState;?></a>
						<?php }else{echo $applicationPendingForResponseAtApplicantCarryForwadedState; }?>
						</td>
                        <td title="Pending for response">
						<?php if((@$applicationPendingForResponseAtApplicantCarryForwadedDistrict + @$applicationPendingForResponseAtApplicantCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_pen_res/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo @$applicationPendingForResponseAtApplicantCarryForwadedDistrict + @$applicationPendingForResponseAtApplicantCarryForwadedState;?></a>
						<?php }else{echo @$applicationPendingForResponseAtApplicantCarryForwadedDistrict + @$applicationPendingForResponseAtApplicantCarryForwadedState; }?>
						</td>
                    </tr>
					<?php } ?>

					<?php if ($type == "both") { ?>
					<tr>
                        <th  style="background:#f3f4f6" >3 : Applications Forwarded to Department  </th>
                        <td title="BOTH"><?php $districtCount = $applicationForwardedToDepartmentSelectedFYDistrict + $applicationForwardedToDepartmentCarryForwadedDistrict; ?>
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>
						
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationForwardedToDepartmentSelectedFYState + $applicationForwardedToDepartmentCarryForwadedState; ?>
						
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>
						</td>
                        <td title="BOTH">
						<?php if(($stateCount + $districtCount ) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount + $districtCount ; ?>
						</a> 
						<?php }else{ echo $stateCount + $districtCount ; } ?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6">3 : Applications Forwarded to Department  </th>
                        <td title="Applications Forwarded to Department">
						<?php if($applicationForwardedToDepartmentSelectedFYDistrict >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydapp_forw_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationForwardedToDepartmentSelectedFYDistrict; ?>
						</a>
						<?php }else{ echo $applicationForwardedToDepartmentSelectedFYDistrict; }?>
						</td>  
                        <td title="Applications Forwarded to Department">
						<?php if($applicationForwardedToDepartmentSelectedFYState >0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysapp_forw_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo $applicationForwardedToDepartmentSelectedFYState; ?>
							</a>
						<?php }else{ echo $applicationForwardedToDepartmentSelectedFYState; }?>	
						</td>  
                        <td  title="Applications Forwarded to Department">
						<?php if($applicationForwardedToDepartmentSelectedFYState >0){ ?>	
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothapp_forw_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationForwardedToDepartmentSelectedFYDistrict + $applicationForwardedToDepartmentSelectedFYState; ?>
							</a>
						<?php }else{ echo $applicationForwardedToDepartmentSelectedFYDistrict + $applicationForwardedToDepartmentSelectedFYState;} ?>	
						</td>
                    </tr>
					<?php } ?>
                  <?php if ($type == "cf") { ?>
					<tr> 
                        <th style="background:#f3f4f6">3 : Applications Forwarded to Department </th> 
                        <td title="Applications Forwarded to Department">
						<?php if(($applicationForwardedToDepartmentCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationForwardedToDepartmentCarryForwadedDistrict;?></a>
						<?php }else{echo $applicationForwardedToDepartmentCarryForwadedDistrict; }?>
						</td>
                        <td  title="Applications Forwarded to Department">
						<?php if(($applicationForwardedToDepartmentCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationForwardedToDepartmentCarryForwadedState;?></a>
						<?php }else{echo $applicationForwardedToDepartmentCarryForwadedState; }?>
						</td>
                        <td  title="Applications Forwarded to Department">
						<?php if(($applicationForwardedToDepartmentCarryForwadedDistrict + $applicationForwardedToDepartmentCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationForwardedToDepartmentCarryForwadedDistrict + $applicationForwardedToDepartmentCarryForwadedState;?></a>
						<?php }else{echo $applicationForwardedToDepartmentCarryForwadedDistrict + $applicationForwardedToDepartmentCarryForwadedState; }?>
						</td>
                    </tr>
					<?php } ?>

					<?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;" >4 : Application Not forwarded to Department </th>
                        <td title="BOTH"><?php $districtCount = (($applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalCarryForwadedDistrict)+($applicationPendingAtNodalSelectedFYDistrict + $applicationPendingAtNodalCarryForwadedDistrict));					
						/* ($applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalCarryForwadedDistrict)+($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) + ($applicationPendingAtNodalCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict); */ ?>
						<?php if($districtCount > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2d_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $districtCount;?></a>
						<?php }else{ echo $districtCount; }?>
						</td>
                        <td title="BOTH"><?php $stateCount =($applicationPendingAtNodalSelectedFYState +$applicationPendingAtNodalCarryForwadedState +
						$applicationUnderProcessAtNodalSelectedFYState + $applicationUnderProcessAtNodalCarryForwadedState);


						/* ($applicationUnderProcessAtNodalSelectedFYState + $applicationUnderProcessAtNodalCarryForwadedState)+($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) + ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); */ ?>
						
						
						<?php if($stateCount > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2s_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $stateCount;?></a>
						<?php }else{ echo $stateCount; }?>
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $districtCount + $stateCount;?></a>
						<?php }else{ echo $districtCount + $stateCount; }?>
						</td>
                    </tr>
                    <?php } ?>                    
                    <?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6">4 : Application Not forwarded to Department </th>
                        <td title="Under process at DIC/ DoI">
						
						<?php $dv=($applicationUnderProcessAtNodalSelectedFYDistrict+$applicationPendingAtNodalSelectedFYDistrict);
						//($applicationUnderProcessAtNodalSelectedFYDistrict)+($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict); ?>						
						<?php if(($dv) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyd_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $dv; ?>
						</a> 
						<?php }else{ echo $dv; } ?>
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php $sv=	($applicationUnderProcessAtNodalSelectedFYState)+($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?> 
						<?php if(($sv) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fys_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $sv; ?>
						</a> 
						<?php }else{ echo $sv; }?>
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php if(($dv + $sv) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyboth_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $dv + $sv; ?>
						</a>
						<?php }else{ echo $dv + $sv;}?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "cf") { ?>
					<tr>
                        <th style="background:#f3f4f6">4 : Application Not forwarded to Department </th> 
                        <td title="Under process at DIC/ DoI"><?php $dv=$applicationUnderProcessAtNodalCarryForwadedDistrict+$applicationPendingAtNodalCarryForwadedDistrict; ?> 
					
						<?php if(($dv) > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo ($dv); ?>
							</a>	
						<?php }else{ ?>
							<?php echo ($dv); ?>
						<?php }?>
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php $sv=$applicationUnderProcessAtNodalCarryForwadedState+$applicationPendingAtNodalCarryForwadedState; ?>
						<?php if(($sv) > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo ($sv); ?>
							</a>	
						<?php }else{ ?>
							<?php echo ($sv); ?>
						<?php }?>
						</td>
                        <td  title="Under process at DIC/ DoI"><?php if(($dv + $sv) > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_not_for_dep/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo ($dv + $sv); ?>
							</a>	
						<?php }else{ ?>
							<?php echo ($dv + $sv); ?>
						<?php }?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;"  class="padleft60">4.1 : Under process at DIC/ DoI</th>
                        <td title="BOTH"><?php $districtCount = $applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalCarryForwadedDistrict; ?>						
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_under_pro_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>						
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationUnderProcessAtNodalSelectedFYState + $applicationUnderProcessAtNodalCarryForwadedState; ?>
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_under_pro_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>						
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_under_pro_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?>
						</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>
						</td>
                    </tr>
                    <?php } ?>
                    
                    <?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6" class="padleft60">4.1 : Under process at DIC/ DoI</th>
                        <td title="Under process at DIC/ DoI">
						<?php if($applicationUnderProcessAtNodalSelectedFYDistrict > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydunder_proc/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo $applicationUnderProcessAtNodalSelectedFYDistrict; ?> 
							</a>
						<?php }else{ echo $applicationUnderProcessAtNodalSelectedFYDistrict; } ?>	
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php if($applicationUnderProcessAtNodalSelectedFYState > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysunder_proc/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationUnderProcessAtNodalSelectedFYState; ?> 
							</a>
						<?php }else{ echo $applicationUnderProcessAtNodalSelectedFYState; } ?>	
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php if(($applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalSelectedFYState) > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothunder_proc/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">	
							<?php echo $applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalSelectedFYState; ?>
							</a>
						<?php }else{ echo $applicationUnderProcessAtNodalSelectedFYDistrict + $applicationUnderProcessAtNodalSelectedFYState; } ?>	
						</td>
                    </tr>
					<?php } ?>

					<?php if ($type == "cf") { ?>
					<tr>
                        <th style="background:#f3f4f6" class="padleft60">4.1 : Under process at DIC/ DoI</th> 
                        <td title="Under process at DIC/ DoI">
						<?php if(($applicationUnderProcessAtNodalCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_under_proc_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationUnderProcessAtNodalCarryForwadedDistrict;?></a>
						<?php }else{ echo $applicationUnderProcessAtNodalCarryForwadedDistrict; }?>
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php if(($applicationUnderProcessAtNodalCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_under_proc_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationUnderProcessAtNodalCarryForwadedState;?></a>
						<?php }else{echo $applicationUnderProcessAtNodalCarryForwadedState; }?>
						</td>
                        <td  title="Under process at DIC/ DoI">
						<?php if(($applicationUnderProcessAtNodalCarryForwadedDistrict + $applicationUnderProcessAtNodalCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_under_proc_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationUnderProcessAtNodalCarryForwadedDistrict + $applicationUnderProcessAtNodalCarryForwadedState;?></a>
						<?php }else{echo $applicationUnderProcessAtNodalCarryForwadedDistrict + $applicationUnderProcessAtNodalCarryForwadedState; }?>
					
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;" class="padleft60">4.2 : Pending at DIC/ DoI  </th>
                        <td title="BOTH">						
						<?php $districtCount = ($applicationPendingAtNodalSelectedFYDistrict + $applicationPendingAtNodalCarryForwadedDistrict);
						?>							
						<?php if($districtCount > 0) { ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2d_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a>
						<?php }else{ echo $districtCount; }?>
						
						</td>
                        <td title="BOTH">						
						<?php $stateCount = $applicationPendingAtNodalSelectedFYState +$applicationPendingAtNodalCarryForwadedState
						//($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) + ($applicationPendingAtNodalCarryForwadedState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); ?>
						
						<?php if($stateCount > 0) { ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2s_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a>
						<?php }else{ echo $stateCount; }?>
						
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) > 0) { ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo $districtCount + $stateCount; ?>
							</a>
						<?php }else{ echo $districtCount + $stateCount; }?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "fy") { ?>
					<tr>
                        <th style="background:#f3f4f6" class="padleft60">4.2 : Pending at DIC/ DoI </th>
                        <!-- DIC/DOI PENDING = Over all pending - Empowered Commetie Pending -->
                        <td title="FY">
						<?php if($applicationPendingAtNodalSelectedFYDistrict > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyd_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">	
							<?php echo $applicationPendingAtNodalSelectedFYDistrict; ?> 
							</a>
						<?php }else{ echo $applicationPendingAtNodalSelectedFYDistrict; } ?>	
						</td>
                        <td  title="FY">						
						<?php $applicationFYPendingAtDIC_DOL = $applicationPendingAtNodalSelectedFYState;
						if($applicationFYPendingAtDIC_DOL > 0)
						{
						?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fys_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationFYPendingAtDIC_DOL;?></a>	
						<?php }else{ ?>
							<?php echo $applicationFYPendingAtDIC_DOL;?>
						<?php }?>	
						</td>
                        <td  title="FY">
						<?php if(($applicationPendingAtNodalSelectedFYDistrict +  $applicationPendingAtNodalSelectedFYState) > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fyboth_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationPendingAtNodalSelectedFYDistrict +  $applicationPendingAtNodalSelectedFYState;
						?>
						</a>
						<?php /* ($applicationPendingAtNodalSelectedFYDistrict-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) + ($applicationPendingAtNodalSelectedFYState-$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState); */ ?>
						<?php }else { echo ($applicationPendingAtNodalSelectedFYDistrict +  $applicationPendingAtNodalSelectedFYState); }?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "cf") { ?>
					<tr>
                          <!-- DIC/DOI PENDING = Over all pending - Empowered Commetie Pending -->
                        <th style="background:#f3f4f6" class="padleft60">4.2 : Pending at DIC/ DoI</th>
						
                        <td title="CF">
							<?php $cfdpen = ($applicationPendingAtNodalCarryForwadedDistrict) ?>
							<?php if(($cfdpen) > 0){ ?>
								<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo ($cfdpen); ?>
								</a>	
							<?php }else{ ?>
								<?php echo ($cfdpen); ?>
							<?php }?>
						</td>
                        <td  title="CF">
						<?php $cfspen = ($applicationPendingAtNodalCarryForwadedState);?>
						<?php if(($cfspen) > 0){ ?>
								<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo ($cfspen); ?>
								</a>	
						<?php }else { echo ($cfspen); } ?>						
						</td>
                        <td  title="CF">
						<?php if(($cfdpen + $cfspen) > 0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_pend_dic/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
								<?php echo ($cfdpen + $cfspen); ?>
							</a>
						<?php }else { echo ($cfdpen + $cfspen); } ?>
						</td>
                    </tr>
					<?php } ?>

                  <?php if ($type == "both") { ?>
                    <tr> 
                        <th style="background:#f3f4f6" >5 : Applications Approved for Empowered Committee   </th>
                        <td title="BOTH"><?php $districtCount = $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict + $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict; ?>
						
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>
						
						</td>
                        <td title="BOTH"><?php $stateCount = $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState + $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; ?>						
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?>
						</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6">5 : Applications Approved for Empowered Committee  </th>
                        <td title="Applications Approved for Empowered Committee">
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict) > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydapp_apro_emp_com/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict; ?>
						</a>
						<?php }else{ echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict; } ?>	
						</td>
                        <td title="Applications Approved for Empowered Committee">
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysapp_apro_emp_com/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; ?> 
						</a>
						<?php }else{ echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; }?>
						</td>
                        <td title="Applications Approved for Empowered Committee">
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict+$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState) > 0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothapp_apro_emp_com/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict+$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; ?> 
						</a>
						<?php }else{ echo $ApplicationsApprovedforEmpoweredCommitteeSelectedFYDistrict+$ApplicationsApprovedforEmpoweredCommitteeSelectedFYState; } ?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "cf") { ?>
					<tr> 
                        <th style="background:#f3f4f6">5 : Applications Approved for Empowered Committee  </th> 
                        <td title="Applications Approved for Empowered Committee">						
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict;?></a>
						<?php }else{echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict; }?>
						</td>
                        <td title="Applications Approved for Empowered Committee">
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState;?></a>
						<?php }else{echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; }?>
						</td>
                        <td title="Applications Approved for Empowered Committee">
						<?php if(($ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_appr_emp_comm/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState;?></a>
						<?php }else{echo $ApplicationsApprovedforEmpoweredCommitteeCarryForwadedDistrict+$ApplicationsApprovedforEmpoweredCommitteeCarryForwadedState; }?>
						</td>
                    </tr>
					<?php } ?>

                    <?php if ($type == "both") { ?>
                    <tr> 
                        <th style="background:#f3f4f6;">6 : Applications Disposed  </th>
                        <td title="BOTH"><?php $districtCount = $applicationApprovedSelectedFYDistrict + $applicationApprovedCarryForwadedDistrict+$applicationRejectedSelectedFYDistrict + $applicationRejectedCarryForwadedDistrict; ?>
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_dis/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>						
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationApprovedSelectedFYState + $applicationApprovedCarryForwadedState+$applicationRejectedSelectedFYState + $applicationRejectedCarryForwadedState ?>
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_dis/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>						
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_dis/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?>
						</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>						
						</td>
                    </tr>
                    <?php } ?>

                    <?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6">6 : Applications Disposed </th>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict)>0){?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydapp_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict; ?> 
						</a>
						<?php }else{echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict; }?>
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict)>0){?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysapp_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState; ?></a> 
						<?php }else{ echo $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState;}?>
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict + $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState)>0){?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothapp_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict + $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState; ?>
						</a>
						<?php }else{ echo $applicationApprovedSelectedFYDistrict+$applicationRejectedSelectedFYDistrict + $applicationApprovedSelectedFYState+$applicationRejectedSelectedFYState;}?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "cf") { ?>
					<tr>
                        <th style="background:#f3f4f6">6 : Applications Disposed</th> 
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedDistrict;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedDistrict; }?>
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedState;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedState; }?>
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_disposed/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState; }?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr> 
                        <th style="background:#f3f4f6;" class="padleft60">6.1 : Applications Disposed (Approved)  </th>
                        <td title="BOTH"><?php $districtCount = $applicationApprovedSelectedFYDistrict + $applicationApprovedCarryForwadedDistrict; ?>
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_dis_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationApprovedSelectedFYState + $applicationApprovedCarryForwadedState; ?>
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_dis_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>
						</td>
                        <td title="BOTH"><?php $districtCount + $stateCount; ?>
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_dis_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?>
						</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>
						</td>
                    </tr>
                    <?php } ?>

                    <?php if ($type == "fy") { ?>
					<tr> 
                        <th style="background:#f3f4f6" class="padleft60">6.1 : Applications Disposed (Approved )  </th>
                        <td title="Applications Disposed (Approved)">
						<?php if($applicationApprovedSelectedFYDistrict>0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydapp_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedSelectedFYDistrict; ?> <a/>
						<?php }else{ echo $applicationApprovedSelectedFYDistrict;} ?>
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if($applicationApprovedSelectedFYState>0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysapp_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationApprovedSelectedFYState; ?>
							<a/>
						<?php }else{ echo $applicationApprovedSelectedFYState;}?>	
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedSelectedFYDistrict+$applicationApprovedSelectedFYState)>0){ ?>
							<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothapp_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
							<?php echo $applicationApprovedSelectedFYDistrict + $applicationApprovedSelectedFYState; ?>
							</a>
						<?php }else{ echo $applicationApprovedSelectedFYDistrict + $applicationApprovedSelectedFYState; } ?>	
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "cf") { ?>
					<tr>
                        <th style="background:#f3f4f6" class="padleft60">6.1 : Applications Disposed (Approved ) </th> 
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedDistrict;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedDistrict; }?>					
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedState;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedState; }?>		
						</td>
                        <td title="Applications Disposed (Approved)">
						<?php if(($applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_disposed_appr/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState;?></a>
						<?php }else{echo $applicationApprovedCarryForwadedDistrict + $applicationApprovedCarryForwadedState; }?>
						</td>
                    </tr>
					<?php } ?>
                    <?php if ($type == "both") { ?>
                    <tr>
                        <th style="background:#f3f4f6;" class="padleft60">6.2 : Applications Disposed (Rejected ) </th>
                        <td title="BOTH"><?php $districtCount = $applicationRejectedSelectedFYDistrict + $applicationRejectedCarryForwadedDistrict; ?>
						<?php if(($districtCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/bothd_app_dis_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount; ?>
						</a> 
						<?php }else{ echo $districtCount; } ?>						
						</td>
                        <td title="BOTH"><?php $stateCount = $applicationRejectedSelectedFYState + $applicationRejectedCarryForwadedState; ?>
						<?php if(($stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/boths_app_dis_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $stateCount; ?>
						</a> 
						<?php }else{ echo $stateCount; } ?>
						</td>
                        <td title="BOTH">
						<?php if(($districtCount + $stateCount) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/both2_app_dis_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $districtCount + $stateCount; ?>
						</a> 
						<?php }else{ echo $districtCount + $stateCount; } ?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "fy") { ?>
					<tr>
                        <th style="background:#f3f4f6" class="padleft60">6.2 : Applications Disposed (Rejected )</th>
                        <td title="Applications Disposed (Rejected)">
						<?php if($applicationRejectedSelectedFYDistrict >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fydapp_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationRejectedSelectedFYDistrict; ?></a> 
						<?php }else{ echo $applicationRejectedSelectedFYDistrict;}?>
						</td>
                        <td title="Applications Disposed (Rejected)">
						<?php if($applicationRejectedSelectedFYState >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fysapp_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationRejectedSelectedFYState; ?> </a>
						<?php }else { echo $applicationRejectedSelectedFYState; }?>
						</td>
                        <td title="Applications Disposed (Rejected)">
						<?php if(($applicationRejectedSelectedFYDistrict + $applicationRejectedSelectedFYState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/fybothapp_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>">
						<?php echo $applicationRejectedSelectedFYDistrict + $applicationRejectedSelectedFYState; ?>
						</a>
						<?php }else{ echo $applicationRejectedSelectedFYDistrict + $applicationRejectedSelectedFYState; } ?>
						</td>
                    </tr>
					<?php } ?>
					<?php if ($type == "cf") { ?>
					<tr>
                        <th style="background:#f3f4f6" class="padleft60">6.2 : Applications Disposed (Rejected ) </th> 
                        <td title="Applications Disposed (Rejected)">
						<?php if(($applicationRejectedCarryForwadedDistrict) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfd_app_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationRejectedCarryForwadedDistrict;?></a>
						<?php }else{echo $applicationRejectedCarryForwadedDistrict; }?>	
						</td>
                        <td title="Applications Disposed (Rejected)">	
						<?php if(($applicationRejectedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfs_app_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationRejectedCarryForwadedState;?></a>
						<?php }else{echo $applicationRejectedCarryForwadedState; }?>	
						</td>
                        <td title="Applications Disposed (Rejected)">
						<?php if(($applicationRejectedCarryForwadedDistrict + $applicationRejectedCarryForwadedState) >0){ ?>
						<a href="/backoffice/admin/default/nodalPerformanceList/whattoshow/cfboth_app_disposed_rej/startdate/<?php echo $startdate;?>/enddate/<?php echo $enddate;?>"><?php echo $applicationRejectedCarryForwadedDistrict + $applicationRejectedCarryForwadedState;?></a>
						<?php }else{echo $applicationRejectedCarryForwadedDistrict + $applicationRejectedCarryForwadedState; }?>		
						</td>
                    </tr>
					<?php } ?>
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
			if('<?php echo @$_GET['FY']; ?>'!='')
			{
				$("#yuiop").attr('action','/backoffice/admin/default/index/FY/<?php echo @$_GET['FY'];?>/type/'+t1);
			}else{
				$("#yuiop").attr('action','/backoffice/admin/default/index/type/'+t1);
			}
            var uj=$("#huik").val();
            //console.log(uj);
            $("#fyt").val(uj);
            $("#yuiop").submit();
          //  alert("==");
        });
        
    })
    </script>