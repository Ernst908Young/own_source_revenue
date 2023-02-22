<?php
/* @var $this HomeController */

$this->breadcrumbs=array(
	'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;
?>




<?php 

		$p_count=0;
		$r_count=0;
		$i_count=0;
		$a_count=0;
		$h_count=0;
		//echo "<h1>Welcome: ".$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name']."</h1>";
  
        ?>
   <style type="text/css">
.dashboard-stat.yellow{
	background-color: #F1C40F;

	   		}

   		@media (min-width: 700px){
	   		.col-lg-3 {
	   		    width: 20%;
	   		}

	   		
   		}
   		.href_link:hover{
   			color:#23527c;
   		}
   </style>
  <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow " href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="incomplete" ></span>
                    </div>
                    <div class="desc">Incomplete</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="pending" ></span></div>
                    <div class="desc">Pending with Dept.</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="reverted" ></span>
                    </div>
                    <div class="desc">Pending with You</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="approved" ></span></div>
                    <div class="desc">Approved</div>
                </div>
            </a>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="rejected" ></span></div>
                    <div class="desc">Rejected </div>
                </div>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>

 <div class="row">


	
	<!--state overview end-->
		<?php
		
      
                      		foreach(Yii::app()->user->getFlashes() as $key => $message) {
                      				if($key=='Error'){
                      					?>
                      					<div class="alert alert-block alert-danger fade in">
                      					    <button data-dismiss="alert" class="close close-sm" type="button">
                      					        <i class="fa fa-times"></i>
                      					    </button>
                      					    </div>
                      				<?php
                      				}
                      				else{
                      					echo "<div class='alert alert-info fade in'>
                      	            	<button data-dismiss='alert' class='close close-sm' type='button'>
                      	            	    <i class='fa fa-times'></i>
                      	            	</button>";
                      				}
                      	            
                      	            echo  $message . "</div>\n";
                      	        }
                      	//echo "</div>";
		if(!isset($_SESSION['sso_token']) && empty($_SESSION['sso_token']) && empty($error))
			echo "Login to Apply for Application";
		elseif(!empty($error)){
			echo "<font color='red'>".$error."</font>";
		}
		else{
			$uid=$_SESSION['RESPONSE']['user_id'];
			//get all the application of the user and their status
			$appmodel= new ApplicationExt;
			$deptmodel= new DepartmentsExt;
			$rolemodel= new RolesExt;
			$cafApp=$appmodel->getUsersCAFIncompleteApplications($uid);
			$SpApps=SpApplicationsExt::getSPApplications($_SESSION['RESPONSE']['user_id']);
			$apps=$appmodel->getUsersApplications($uid);
			// echo "<pre>"; print_r($apps); die;
			$prev_sub_id='';
			?>
								<div class='portlet box green'>
                                    <div class='portlet-title'>
                                        <div class='caption'>
                                            <i style=" font-size:20px;" class='fa fa-users'></i>Investor Dashboard </div>
                                        <div class='tools'> </div>
                                    </div>
 <div class="portlet-body">
			<?php
			  
			if(!empty($apps) || !empty($cafApp) || !empty($SpApps) || !empty($offlineApps)){
				echo "<table class='table table-striped table-bordered' id='sample_2'> <thead><tr><th>Application ID</th><th>Service Name</th><th>Unit Name</th><th>District</th><th>Department</th><th>Status</th> <th>Download</th><th>Print</th></thead>";
				if(!empty($apps)){
					foreach ($apps as $app) {
						$download="NA";
						$name = Yii::app()->basePath."/inprinciple/INPRINCIPLELETTER_".$app['submission_id'].".pdf";
						if(file_exists($name))
							$download="<a class='href_link' href='".Yii::app()->createAbsoluteUrl('/frontuser/home/downaloadInvestorDocuments/app_sub_id/'.base64_encode($app['submission_id']))."' title='Download Documents'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Approval</a>";
						$app_name=$appmodel->getAppNameViaId($app['application_id']);
						$dept_name=$deptmodel->getDeptbyId($app['dept_id']);
						$role_name=$rolemodel->getUserRoleViaId($app['next_role_id']);
						if($prev_sub_id!=$app['submission_id']){
						// echo "<pre>";print_r($app);
							echo "<tr><td><a class='href_link' href='".Yii::app()->createAbsoluteUrl('frontuser/home/timeline/app_id/'.$app['submission_id'].'')."'>".$app['submission_id']."</a></td><td>".$app_name['application_name']."</td><td></td><td></td><td>".$dept_name['department_name']."</td>";
							// <th colspan='5'><i class='fa fa-check'></i> Flow</th>
							// if($app['approv_status']==='V')
							// 	echo "Verified by ".$role_name['role_name']." on $app[created_on]";
							// if($app['approv_status']==='P')
							// 	echo "Pending on".$role_name['role_name']." on $app[created_on]";
							// if($app['approv_status']==='H')
							// 	echo "Hold By".$role_name['role_name']. " Reason: ".$app['created_on'];
							if($app['application_status']=='P'){
								echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
								$p_count++;
							}
							if($app['application_status']=='I'){
								echo "</td><td style='display: table-cell' class='label label-sm label-warning'>Incomplete</td>";
								$i_count++;							
							}
							if($app['application_status']=='A'){
								echo "</td><td style='display: table-cell' class='label label-sm label-success'>Approved</td>";
								$a_count++;							
							}
							if($app['application_status']=='R'){
								echo "</td><td style='display: table-cell' class='label label-sm label-danger'>Reject</td>";
								$r_count++;
							}
							if($app['application_status']=='F'){
								echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
								$p_count++;
							}
							if($app['application_status']=='H'){
								if($app['application_id']!=8)
									echo "</td><td style='display: table-cell;background-color:#8E44AD;'><a class='href_link' style='color:#fff;' href='".Yii::app()->createAbsoluteUrl('/frontuser/application_form/updateHoldapplication/department/'.$app['dept_id'].'/application/'.$app['submission_id'])."'>Reverted</a></td>";
								else
									echo "</td><td style='display: table-cell;background-color:#8E44AD;'><a class='href_link' style='color:#fff;' href='".Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepOne/department/'.$app['submission_id'].'/application/'.$app['submission_id'])."'>Reverted</a></td>";
								$h_count++;
							}
							if($app['required_payment']){
								/*check already paid or not*/
								/*if(ApplicationExt::checkForPayment($_SESSION['RESPONSE']['user_id'],$app['submission_id']))
									echo "<td>Already Paid</td>";
								else
									echo "<td><a href='".Yii::app()->createAbsoluteUrl('payment/paymentDetail/FillPayementDetail/application/'.base64_encode($app['application_id']).'/app_sub_id/'.base64_encode($app['submission_id']))."'>Pay Online</a></td>";*/
							}
							else
								echo "<td>Not Required</td>";
							echo "<td>$download</td>
								<td><a  class='href_link' href='".Yii::app()->createAbsoluteUrl('/frontuser/home/printForm/app_id/'.base64_encode($app['submission_id']))."' target='_blank'  title='Print Application'><i class='fa fa-print'></i> print</a></td>	
							</tr>";
						}
						else{
							// echo "<tr><td colspan='3'></td><td>";
							// if($app['approv_status']==='V')
							// 	echo "Verified by ".$role_name['role_name']." on $app[created_on]";
							// if($app['approv_status']==='P')
							// 	echo "Pending on ".$role_name['role_name'] ." on $app[created_on]";
							// if($app['approv_status']==='H')
							// 	echo "Hold By ".$role_name['role_name']. " Reason: ".$app['created_on'];
							// echo "</td><td colspan='6'>&nbsp;</td></tr>";

						}
						$prev_sub_id=$app['submission_id'];
						// if($app['application_status']=='P')
						// 	echo "P<input type='text' id='p_count' value='".$p_count."'>";

						// if($app['application_status']=='I')
						// 	echo "I<input type='text' id='i_count' value='".$i_count."'>";
							
						// if($app['application_status']=='A')
						// 	echo "A<input type='text' id='a_count' value='".$a_count."'>";
							
						// if($app['application_status']=='R')
						// 	echo "R<input type='text' id='r_count' value='".$r_count."'>";
									
							
					}
				}
				if(!empty($cafApp)){
					foreach ($cafApp as $app) {
						$download="NA";
						// $investor_app_docs=ApplicationExt::getInvestorDocs($app['submission_id']);
						 $name = Yii::app()->basePath."/inprinciple/INPRINCIPLELETTER_".$app['submission_id'].".pdf";
						 // echo $name;die;
						 if(file_exists($name))
							$download="<a class='href_link' href='".Yii::app()->createAbsoluteUrl('/frontuser/home/downaloadInvestorDocuments/app_sub_id/'.base64_encode($app['submission_id']))."' title='Download Documents'>Approval</a>";
						
						$app_name=$appmodel->getAppNameViaId($app['application_id']);
						$dept_name=$deptmodel->getDeptbyId($app['dept_id']);
					   echo "<tr><td>".$app['submission_id']."</td><td>".$app_name['application_name']."</td><td></td><td></td><td>".$dept_name['department_name']."</td><td style='display: table-cell' class='label label-sm label-warning'>";
					   if($app['application_status']=='I')
					   		echo "Incomplete";
					   	elseif ($app['application_status']=='B') {
					   		echo "Pending due to Payment";
					   	}
					   $i_count++;	echo "</td><td>$download</td>
								<td><a class='label label-success label-mini href_link'  href='".Yii::app()->createAbsoluteUrl('/frontuser/home/printForm/app_id/'.base64_encode($app['submission_id']))."' target='_blank'  title='Print Application'><i class='fa fa-print'></i> Print</a></td>	

					   </tr>";
					}
				}

				if(!empty($SpApps)){
					// echo "<pre>";print_r($SpApps);die;
					  foreach ($SpApps as $app) {
					  		$download="NA";
					  		$printurl="NA";
					  		$revertbackUrl="";
					  		$certurl=SpApplicationsExt::ssoCertURL($app['sp_tag']);
							$investor_app_docs=ApplicationExt::getInvestorSSOAppDocs($app['sno']);
							// if($investor_app_docs)

								

							/*if(SpApplicationsExt::ssoSPNAMEViaTag($app['sp_tag'])=='Incentive' && $app['app_status']=='A')
								{
									$download="<a href='".$certurl.$app['app_id']."' title='Download Documents' target='_blank'>Download Certificate</a>";
								}
								else
								{
									$download="<a href='".Yii::app()->createAbsoluteUrl('/frontuser/home/downaloadInvestorDocuments/sso_integrated_dept/1/sp_tag/'.base64_encode($app['sp_tag']).'/application/'.$app['app_id'].'/app_sub_id/'.base64_encode($app['sno']))."' title='Download Documents'>Download Documents</a>";
								}

								//print_r(SpApplicationsExt::ssoSPNAMEViaTag($app['sp_tag']));
								if(SpApplicationsExt::ssoSPNAMEViaTag($app['sp_tag'])=='Labour' && $app['app_status']=='A')
								{
									$download="<a href=http://uklabouracts.in/Reports/EoDB/SA_Certificate.aspx?AppID=2023 title='Download Documents' target='_blank'>Download Documents</a>";
								}*/

					
						/*if($app['app_id']==1223)
							die($app['app_status']);*/



							/* OLD CODE Before V2.0 Upgradation	if($app['app_status']=='A'){
							// die("here");
							$download="<a class='href_link' href='".Yii::app()->createAbsoluteUrl('/frontuser/home/downaloadInvestorDocuments/sso_integrated_dept/1/sp_application_name/'.$app['app_name'].'/sp_tag/'.base64_encode($app['sp_tag']).'/application/'.$app['app_id'].'/app_sub_id/'.base64_encode($app['sno']))."' title='Download Documents'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Download</a>";
						}
								
                            echo "<tr><td><a class='href_link' href='".Yii::app()->createAbsoluteUrl('frontuser/home/timeline/app_id/'.$app['app_id'].'/apptype/SP/spTag/'.base64_encode($app['sp_tag'])."/spAppID/".base64_encode($app['sno']))."'>".$app['app_id']."</a></td><td>".$app['app_name']."</td><td>".SpApplicationsExt::ssoSPNAMEViaTag($app['sp_tag'])."</td>";
					
						if($app['app_status']=='P'){
							echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
							$p_count++;
						}
						elseif($app['app_status']=='I'){
							echo "</td><td style='display: table-cell' class='label label-sm label-warning'>Incomplete</td>";
							$i_count++;							
						}
						elseif($app['app_status']=='A'){
							echo "</td><td style='display: table-cell' class='label label-sm label-success'>Approved</td>";
							$a_count++;							
						}
						elseif($app['app_status']=='R'){
							echo "</td><td style='display: table-cell' class='label label-sm label-danger'>Rejected</td>";
							$r_count++;
						}
						elseif($app['app_status']=='H'){
							// echo "</td><td style='display: table-cell; background-color:#8E44AD; font-size: 13px;' class='label label-sm'><a class='href_link' href='".Yii::app()->createAbsoluteUrl('/frontuser/application_form/updateHoldapplication/department/'.@$app['dept_id'].'/application/'.@$app['submission_id'])."'>Reverted Back</a></td>";
							echo "</td><td style='display: table-cell; background-color:#8E44AD; font-size: 13px;' class='label label-sm'>Reverted</td>";
							$h_count++;
						}
						else{
							echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
							$p_count++;
						}
						echo "<td>$download</td><td>&nbsp;</td></tr>";  OLD Code END HERE*/


						if($app['app_status']=='A'){
							// die("here");
							if(!empty($app['download_certificate_call_back_url']))
							$download="<a class='href_link' target='_blank' href='".$app['download_certificate_call_back_url']."' title='Download Documents'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Approval Certificate</a>";
						if(!empty($app['print_app_call_back_url']))
							$printurl="<a class='href_link' target='_blank' href='".$app['print_app_call_back_url']."' title='Print'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Print</a>";
						}

						if($app['app_status']=='R'){
							// die("here");
							if(!empty($app['download_certificate_call_back_url']))
							$download="<a class='href_link' target='_blank' href='".$app['download_certificate_call_back_url']."' title='Download Documents'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Rejection Letter</a>";
						if(!empty($app['print_app_call_back_url']))
							$printurl="<a class='href_link' target='_blank' href='".$app['print_app_call_back_url']."' title='Print'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Print</a>";
						}

						if($app['app_status']=='RBI'){
							// die("here");
							if(!empty($app['download_certificate_call_back_url']))
							$download="<a class='href_link' target='_blank' href='".$app['download_certificate_call_back_url']."' title='Download Documents'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Objection Letter</a>";
						if(!empty($app['print_app_call_back_url']))
							$printurl="<a class='href_link' target='_blank' href='".$app['print_app_call_back_url']."' title='Print'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Print</a>";
						}

						if($app['app_status']=='P'){
							// die("here");
							
						if(!empty($app['print_app_call_back_url']) && $app['print_app_call_back_url'] !='#' )
							$printurl="<a class='href_link' target='_blank' href='".$app['print_app_call_back_url']."' title='Print'><i style='font-size:18px;' class='fa fa-cloud-download'></i> Print</a>";
						}


								
                            echo "<tr><td><a class='href_link' target='_blank' href='".Yii::app()->createAbsoluteUrl('frontuser/home/timeline/app_id/'.$app['app_id'].'/apptype/SP/spTag/'.base64_encode($app['sp_tag'])."/spAppID/".base64_encode($app['sno']))."'>".$app['app_id']."</a></td><td>".ApplicationExt::getServiceNameFromID($app['sp_app_id'])."</td><td>".$app['unit_name']."</td><td>".$app['app_distt']."</td><td>".SpApplicationsExt::ssoSPNAMEViaTag($app['sp_tag'])."</td>";
					
						if($app['app_status']=='P'){
							echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
							$p_count++;
						}
						elseif($app['app_status']=='I'){
							echo "</td><td style='display: table-cell' class='label label-sm label-warning'><a class='href_link1' target='_blank' href='".$app['reverted_call_back_url']."'>Incomplete</a></td>";
							$i_count++;							
						}
						elseif($app['app_status']=='A'){
							echo "</td><td style='display: table-cell' class='label label-sm label-success'>Approved</td>";
							$a_count++;							
						}
						elseif($app['app_status']=='R'){
							echo "</td><td style='display: table-cell' class='label label-sm label-danger'>Rejected</td>";
							$r_count++;
						}
						elseif($app['app_status']=='RBI'){
							$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['app_id'])."/application_status/".$app['app_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));


							echo "</td><td style='display: table-cell' class='list-group-item bg-purple bg-font-purple'><a class='href_link1' href='".$revertbackUrl."'>Reverted</a></td>";
							$h_count++;
						}
						elseif($app['app_status']=='F'){
							echo "</td><td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
							$p_count++;
						}elseif($app['app_status']=='O'){
							echo "</td><td style='display: table-cell' class='label label-sm label-info'>NA</td>";
							//$p_count++;
						}
						echo "<td>$download</td><td>$printurl</td></tr>";





                    }
				}

			}
			// $i_count=100;
			/*echo "<input type='hidden' id='p_count' value='".$p_count."'>";
			echo "<input type='hidden' id='i_count' value='".$i_count."'>";
			echo "<input type='hidden' id='a_count' value='".$a_count."'>";
			echo "<input type='hidden' id='r_count' value='".$r_count."'>";
			echo "<input type='hidden' id='h_count' value='".$h_count."'>";*/
			
		if(empty($cafApp) && empty($apps))
			echo "<tr><td colspan='6'>No application</td>";
		echo "</table>";	
		
		}
	echo "</div></div>";
	
	
	
	?>
</div></div></div>
	<script type="text/javascript">
		$('.incomplete').data("value","<?=$i_count?>");
		$('.pending').data("value",<?=$p_count?>);
		$('.reverted').data("value",<?=$h_count?>);
		$('.approved').data("value",<?=$a_count?>);
		$('.rejected').data("value",<?=$r_count?>);
		$('.incomplete').append(<?=$i_count?>);
		$('.pending').append(<?=$p_count?>);
		$('.reverted').append(<?=$h_count?>);
		$('.approved').append(<?=$a_count?>);
		$('.rejected').append(<?=$r_count?>);
	</script>

   <?php
$base=Yii::app()->theme->baseUrl;
?>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->


<script type="text/javascript">
  
  var TableDatatablesButtons = function() {
    var e = function() {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }, {
                    extend: "colvis",
                    className: "btn dark btn-outline",
                    text: "Columns"
                }],
                responsive: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        t = function() {
            var e = $("#sample_2");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                },  {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "excel",
                    className: "btn default"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        a = function() {
            var e = $("#sample_3"),
                t = e.dataTable({
                    language: {
                        aria: {
                            sortAscending: ": activate to sort column ascending",
                            sortDescending: ": activate to sort column descending"
                        },
                        emptyTable: "No data available in table",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries found",
                        infoFiltered: "(filtered1 from _MAX_ total entries)",
                        lengthMenu: "_MENU_ entries",
                        search: "Search:",
                        zeroRecords: "No matching records found"
                    },
                    buttons: [{
                        extend: "print",
                        className: "btn dark btn-outline"
                    }, {
                        extend: "copy",
                        className: "btn red btn-outline"
                    }, {
                        extend: "pdf",
                        className: "btn green btn-outline"
                    }, {
                        extend: "excel",
                        className: "btn yellow btn-outline "
                    }, {
                        extend: "csv",
                        className: "btn purple btn-outline "
                    }, {
                        extend: "colvis",
                        className: "btn dark btn-outline",
                        text: "Columns"
                    }],
                    responsive: !0,
                    order: [
                        [0, "asc"]
                    ],
                    lengthMenu: [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"]
                    ],
                    pageLength: 10
                });
            $("#sample_3_tools > li > a.tool-action").on("click", function() {
                var e = $(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        },
        n = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            });
            var e = new Datatable;
            e.init({
                src: $("#datatable_ajax"),
                onSuccess: function(e, t) {},
                onError: function(e) {},
                onDataLoad: function(e) {},
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 10,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    buttons: [{
                        extend: "print",
                        className: "btn default"
                    }, {
                        extend: "copy",
                        className: "btn default"
                    }, {
                        extend: "pdf",
                        className: "btn default"
                    }, {
                        extend: "excel",
                        className: "btn default"
                    }, {
                        extend: "csv",
                        className: "btn default"
                    }, {
                        text: "Reload",
                        className: "btn default",
                        action: function(e, t, a, n) {
                            t.ajax.reload(), alert("Datatable reloaded!")
                        }
                    }]
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {
                t.preventDefault();
                var a = $(".table-group-action-input", e.getTableWrapper());
                "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "No record selected",
                    container: e.getTableWrapper(),
                    place: "prepend"
                })
            }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {
                var t = $(this).attr("data-action");
                e.getDataTable().button(t).trigger()
            })
        };
    return {
        init: function() {
            jQuery().dataTable && (e(), t(), a(), n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
    

});




</script>