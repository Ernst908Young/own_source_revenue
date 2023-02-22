

<?php
echo '<section class="panel">';
$criteria=new CDbCriteria;
$criteria->condition="is_active=:active";
$criteria->params=array(":active"=>'Y');
$distt=District::model()->findAll($criteria);
if($distt!=null){
	?>
				<div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>District Wise CAF</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead class="flip-content">
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>District</th>
                                    <th>Pending</th>
                                    <th>Forwarded</th>
                                    <th>Rejected</th>
                                    <th>Approved</th>
                                    <th>Total</th>
                                    <th>Investment (INR Crores)</th>
                                    <th>Male Employees</th>
                                    <th>Female Employees</th>
                                    <th>Total Employment</th>

                                </tr>
                                </thead>
                                <tbody>
                               <?php 
                               $count=1;  
                             	foreach ($distt as $key => $dist) {
                             	 	 $totalPending=ApplicationExt::getTotalDistrictApps($dist->district_id,'P');
                             	 	 $totalForwarded=ApplicationExt::getTotalDistrictApps($dist->district_id,'F');
                             	 	 $totalReject=ApplicationExt::getTotalDistrictApps($dist->district_id,'R');
                             	 	 $totalApproved=ApplicationExt::getTotalDistrictApps($dist->district_id,'A');
                             	 	 $totalApps=$totalApproved + $totalReject + $totalPending + $totalForwarded;
                                 $totalInvestment=ApplicationExt::getProjectTotalInvestment($dist->district_id);
                                 $totalMaleEmp=ApplicationExt::getProjectTotalEMPMale($dist->district_id);
                                 $totalFemaleEmp=ApplicationExt::getProjectTotalEMPFemale($dist->district_id);
                                 $totalEmployement=  $totalMaleEmp+ $totalFemaleEmp;
                                 
                                 $totalForwardedSTATEDDN=ApplicationExt::getTotalOverAllDistrictForwardedSTATEDDNApps('6');



                             	 	 echo "<tr class='gradeA'>
                                    <td style='display:none;''>".$dist->district_id."</td>
                                    <td>".$dist->distric_name."</td>
                                    <td  class='numeric' align='center'>".$totalPending."</td>
                                    <td class='numeric' align='center'>".$totalForwarded."</td>
                                    <td class='numeric' align='center'>".$totalReject."</td>
                                    <td class='numeric' align='center'>".$totalApproved."</td>
                                    <td class='numeric' align='center'>";
                                    if($totalApps>0)
                                    	echo "<b>$totalApps</b>";
                                    else
                                    	echo $totalApps;
                                    echo  "</td>
                                    <td class='numeric' align='center'>".round($totalInvestment,2)."</td>
                                    <td class='numeric' align='center'>".$totalMaleEmp."</td>
                                    <td class='numeric' align='center'>".$totalFemaleEmp."</td>
                                    <td class='numeric' align='center'><b>".$totalEmployement."</b></td>
                                      </tr>";

                             	 } 

                                ?>
                                </tbody>
                            </table>

	<?php
}

?>

                        </div>
                  </div>
