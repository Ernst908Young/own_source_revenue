<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;
$key = 0;
?>
<style type="text/css">
    .dashboard-stat.yellow{ background-color: #F1C40F;    }
    .mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
    .mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons { margin-top: 14px;}

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
	.dataTables_wrapper .dt-buttons{
		margin-right: 18px;
	}
	.marquee_container { float:left; margin-right:195px; margin-left: 195px; margin-top: -45px;}
	.marquee_container p {  display:inline; margin-left:16px; color:red; font-size:14.5px; line-height:33px; text-indent:8px; padding:25px;}
	.date_container {color: #fff;float: right;height: 60px;position: absolute;right: 10px;text-align: right;width: 100px;z-index: 999;}
	a:hover{color:blue;}
	#chartdiv {
		width: 100%;
		height: 500px;
	}
	.pd_child{ padding-left: 50px !important; }
	.dt-buttons{margin-top: 0px !important;}
	a+a {
	  margin-left: 10px;
	}
	
	[data-title] {  
	  position: relative;
	  cursor: help;
	}
	[data-title]:hover::before {
	  content: attr(data-title);
	  position: absolute;
	  bottom: -30px;
	  display: inline-block;
	  padding: 3px 6px;
	  border-radius: 2px;
	  background: #000;
	  color: #fff;
	  font-size: 12px;
	  font-family: sans-serif;
	  white-space: nowrap;
	}
	[data-title]:hover::after {
	  content: '';
	  position: absolute;
	  bottom: -10px;
	  left: 8px;
	  display: inline-block;
	  color: #fff;
	  border: 8px solid transparent;	
	  border-bottom: 8px solid #000;
	}
</style>
<div id="content">
    <div class="site-min-height">
        <!-- BEGIN CONTENT BODY -->
        <div class="portlet-body">
        </div>
		<div class="portlet-body" style="text-align:center;">		
			<?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					echo '<div class="flash-' . $key . '" style="font-size:22px;color: green;">' . $message . "</div>\n";
				}
			?>
        </div>
        <div class='portlet box green'>
            <div class='portlet-title'>
                <div class='caption' style="padding-top: 14px;">
                    <i style=" font-size:14px;" class='fa fa-file'></i>Applications for Departmental Services</div>
                <div class='tools'> </div>

            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2" >
                    <thead>
                        <tr>
							<th style="text-align:center;width:5%;">S.No.</th>
                            <th style="width:10%;">Service Name</th>
							<th style="width:60%">Application Detail</th>                     
                            <th style="width:10%">Status</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 					
					if(!empty(@$_SESSION['RESPONSE']['user_id'])){
						$userID=@$_SESSION['RESPONSE']['user_id'];
					}else if(isset($_SESSION['role_id']) && $_SESSION['role_id']==2){      
						$userID= base64_decode($_GET['uid']);
					}else{
						$userID=0;
					}									
					$fromToDateCondition = '';
					if(!isset($financial_year)) {
						$financial_year='ALL';
					}
					if($financial_year=="ALL"){ 
						$startdate=date('Y-m-d', strtotime("2015-04-01")); 
						$enddate=date('Y-m-d'); 
					}
					else if($financial_year!="ALL"){
						$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
					}

					else {
						$fDate = date('Y-m-d');
						$keyy=explode("-",$fDate);
						$todayDate=date('Y-m-d', strtotime($fDate));
						$sdate=$keyy[0]."-04-01";
						$DateBegin = date('Y-m-d', strtotime($sdate));
						$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

						if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
						else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
						$data=explode("-",$financial_year);
						$startdate=$data[0]."-04-01";
						$enddate=date('Y-m-d'); 
					}

					$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
					// From Date
					if(isset($startdate)){
						$fromToDateCondition .= " AND DATE(	application_created_date)>='".$startdate."'";
					}
					// To Date
					if(isset($enddate)){
						$fromToDateCondition .= " AND DATE(	application_created_date)<='".$enddate."'";
					}
					$serviceIdArr = "";
					$serviceCond = "";
					if(isset($_GET['stype']) && $_GET['stype']=='BM')
					{
						$serviceIdArr = "'2.0'";
						$serviceCond = " AND service_id IN ($serviceIdArr) ";
					}else if(isset($_GET['stype']) && $_GET['stype']=='Incop'){
					
						$serviceIdArr = "'1.0','4.0','5.0','6.0','7.0','8.0','9.0'";
						$serviceCond = " AND service_id IN ($serviceIdArr) ";
					}else if(isset($_GET['stype']) && $_GET['stype']=='Cont'){
					
						$serviceIdArr = "0.0";
						$serviceCond = " AND service_id IN ($serviceIdArr) ";
					}else if(isset($_GET['stype']) && $_GET['stype']=='Amal'){
					
						$serviceIdArr = "0.0";
						$serviceCond = " AND service_id IN ($serviceIdArr) ";
					}else if(isset($_GET['stype']) && $_GET['stype']=='ClS'){
					
						$serviceIdArr = "0.0";
						$serviceCond = " AND service_id IN ($serviceIdArr) ";
					}
					$statusCond = "";
					if(isset($_GET['status']) && !empty($_GET['status']))
					{					
						$statusCond = " AND application_status = '$_GET[status]' ";
					}
					
					
					$sql = "SELECT  * FROM bo_new_application_submission where user_id='$userID' $serviceCond $statusCond $fromToDateCondition ORDER BY submission_id DESC";
					$apps = Yii::app()->db->createCommand($sql)->queryAll();
					
					
					
					if(empty($apps) || count($apps) == 0) {
					  //  echo "<tr><td colspan='8'>No Detail Found</td></tr>";
					} 
					elseif(count($apps) >0) 
					{
						$count = 1;
						
						foreach($apps as $key => $apps) 
						{							
							$appsgf = $apps['application_status'];							
							$overalldms	= "";
							$diffdept12 = 0;
							$diffapplicant = 0;							
							$serviceTotalTime = "";
							$serviceDepartmentTime = 0;
							$serviceApplicantTime = 0;
							$responseFlag = 1;						
							if ($responseFlag) {														
				?>

								<tr>
									<td align="center">									
										<a href=""> <?php echo $count++; ?></a>
									</td>
									<td align="left">									
										<?php 
										if($apps['sp_app_id'])
										{ 									   
											$serviceData=ApplicationV2Ext::getDepartmentAndServiceDetail($apps['sp_app_id']) ;
											$dsa=$serviceData['department_name']." : ".$serviceData['app_name']." : ".$apps['submission_id'];
											$encodeddsa= base64_encode($dsa);
											echo $serviceData['app_name'];
										} 
										?>
									</td>
									<td>										
									<?php 
										$applicationID = $apps['submission_id'];
										echo "<b># &nbsp; SRN: </b>" . @$apps['submission_id'] . "<br>";
										echo "<i title='Applied On' class='fa fa-history'></i> &nbsp;<b>Applied On:</b> ";
										$create = date('Y-m-d h:i:s', strtotime(@$apps['application_updated_date_time']));
										
										echo date('d-m-Y h:i:s', strtotime($create));
										$fieldVal=json_decode($apps['field_value'],true);
										
										if(isset($fieldVal['UK-FCL-00044_0']) && !empty($fieldVal['UK-FCL-00044_0']))
										{
											$id = $fieldVal['UK-FCL-00044_0'];
											$sqlfor = "SELECT  * FROM bo_application_for where id='$id'";
											$appliedfor = Yii::app()->db->createCommand($sqlfor)->queryRow();
											echo "<br><b>Applied For: </b>".$appliedfor['name'];
										}
										
										$approvedNameSql = "SELECT  * FROM bo_banned_words where app_id='$applicationID' AND status='Y' AND process_from='SYSTEM'";
										$approvedData = Yii::app()->db->createCommand($approvedNameSql)->queryRow();
										
										if($apps['sp_app_id'] == 2)
										{			
											//echo $approvedData['assign_new_name'];
											if($approvedData['assign_new_name']!=''){
												echo "<br><b>Approved Name: </b>".$approvedData['assign_new_name'];
											}else if(isset($approvedData['banned_words_name']) && !empty($approvedData['banned_words_name']))
											{
												echo "<br><b>Approved Name: </b>".$approvedData['banned_words_name'];
											}
										}
									?>
									</b>
									</td>					
																   
									<?php 
								
									switch ($appsgf) {
										case "A":
											echo "<td style='vertical-align: top'>Approved</td>";
											break;										
										case "P":
											echo "<td style='vertical-align: top;'>Submitted</td>";
											break;
										case "F":
											echo "<td style='vertical-align: top;'> Forward</td>";
											break;
										case "FA":
											echo "<td style='vertical-align: top;'> Forward to Approver</td>";
											break;	
										case "I":
											echo "<td style='vertical-align: top;'>"; 
											$app=$apps;  
											$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url']))); 											
											echo "<a href='$revertbackUrl'>Draft</a></td>";
											break;
										case "DP":
											echo "<td style='vertical-align: top;'>"; 
											$app=$apps;  
											$revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url']))); 											
											echo "<a href='$revertbackUrl'>Draft</a></td>";
											break;	
										case "RBI":
											echo "<td style='vertical-align: top;'>"; $app=$apps;  $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));
											echo "<a href='$revertbackUrl'>Pending for Resubmission</a></td>";
											break;
										case "H":
											echo "<td style='vertical-align: top;'>"; $app=$apps;  $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));
											echo "<a href='$revertbackUrl'>Pending for Resubmission</a></td>";
											break;	
										case "PD":
											echo "<td style='vertical-align: top;'>";$app=$apps;  $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/token/".base64_encode(@$_SESSION['RESPONSE']['token'])."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));
											echo "<a href='$revertbackUrl'>Draft</a></td>";
											break;	
										case "R":
											echo "<td style='vertical-align: top;'>Rejected</td>";
											break;
										case "W":
											echo "<td style='vertical-align: top;'>Withdrawn</td>";
											break;	
										default:
											echo "<td style='vertical-align: top;'>No Status</td>";
									}
									?>
									<td style="text-align:left;vertical-align:middle;">
										<a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/subForm/applicationTimeline/subID/'. base64_encode($apps['submission_id']));?>" target="_blank" data-title="View Timeline"><i class="fa fa-history text-success fa-2x"></i></a>

										<a target="_blank" href="<?php echo $apps['print_app_call_back_url'];?>" data-title="Print Application"><i class="fa fa-print text-info fa-2x" aria-hidden="true"></i></a>
										<?php 
										if($apps['application_status']=="A" || $apps['application_status']=="W")
										{
											$sqlRev = "SELECT  * FROM bo_revoke_submission where app_id='$apps[submission_id]'";
											$revokeReq = Yii::app()->db->createCommand($sqlRev)->queryRow();
											
											if($apps['application_status']!="W"){
										?> 
											<a target="_blank" href="<?php echo $apps['download_certificate_call_back_url'];?>" data-title="Download Letter / Certificate"><i class="fa fa-download text-success fa-2x" aria-hidden="true"></i></a>
											<?php 
											}
											if($apps['application_status']!="W" && empty($approvedData['assign_new_name']) && empty($revokeReq))
											{ 
											?>									
												<a class="m-btn--custom withdwral_name" rel="<?php echo $apps['submission_id'];?>" data-title="Withdraw Name"><img src="/backoffice/themes/investuk/images/withdraw_name.png" style="margin:-3px;width: 33px;vertical-align:baseline;"></a>
											<?php 
											}
											$sqlRev = "SELECT  * FROM bo_revoke_submission where app_id='$apps[submission_id]' and applicant_take_action='0' and department_take_action!='1'";
											$revokeReq = Yii::app()->db->createCommand($sqlRev)->queryRow();
											if(isset($revokeReq) && !empty($revokeReq) && $apps['application_status']!="W")
											{
											?>
												<a class="m-btn--custom revoke_request" id="accept" rel="<?php echo $apps['submission_id'];?>" data-title="Revoked Request" data-msg="<?php echo @$revokeReq['comment'];?>"><i class="fa fa-bell text-success fa-2x" aria-hidden="true"></i></a>
											<?php
											}
										} 
										?>
									</td>
								</tr>
							<?php
							}
						}
					}
					
					?>
                    </tbody>
                </table>
            </div>
        </div>	
	</div>
</div>	
<style>
	.movetoDashboard{
		cursor: pointer;
	}
</style>
<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
<link href="/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />
<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script>
var SweetAlert2Demo = {
	init: function() { 
		$(".withdwral_name").click(function(e) {
			var subID = $(this).attr('rel');
			swal({
				title: "Withdrawn",
				text: "Are you sure you want to withdraw the name?",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes, I am sure!',
				cancelButtonText: "No, cancel it!"
			}).then(function(e) {
				//alert(e.value);
				if (e.value) {
					swal({
					title: 'Withdrawn',
					text: 'Name withdrawal successful.',
					type: "success",
					}).then(function() {
						 $.ajax({
							type: "POST",
							url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subFormCompanyNameReservation/withdrwalName",
							data: {subID: subID},
							success: function (data) { 
								location.reload();	
							}
						});	 
					});
				} else {
					swal("Cancelled", "Name withdrawal cancelled.", "error");
				}
			})
		});	
		
		$(".revoke_request").click(function(e) {
			var subID = $(this).attr('rel');
			var revokeMsg = $(this).attr('data-msg');
			swal({
				title: "Revoke Request",
				text: revokeMsg,
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Accept',
				cancelButtonText: "Reject"
			}).then(function(e) {
				//alert(e.value);
				if (e.value) {
					swal({
						title: 'Revoke Request',
						text: 'Revoke Request Accepted Successfully.',
						type: "success",
					}).then(function() {
						$.ajax({
							type: "POST",
							url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subFormCompanyNameReservation/applicantRevokeReqAcceptorReject",
							data: {subID: subID,'action':'accept'},
							success: function (data) { 
								location.reload();	
							}
						});	 
					});
				} else {
					swal({
						title: 'Revoke Request',
						text: 'Revoke Request Rejected.',
						type: "error",
					}).then(function() {
						$.ajax({
							type: "POST",
							url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subFormCompanyNameReservation/applicantRevokeReqAcceptorReject",
							data: {subID: subID,'action':'reject'},
							success: function (data) { 
								location.reload();	
							}
						});	
					});
				}
			})
		});	
				
		/* $("#m_sweetalert_demo_1").click(function(e) {
			swal("Good job!")
		}), $("#m_sweetalert_demo_2").click(function(e) {
			swal("Here's the title!", "...and here's the text!")
		}), $("#m_sweetalert_demo_3_1").click(function(e) {
			swal("Good job!", "You clicked the button!", "warning")
		}), $("#m_sweetalert_demo_3_2").click(function(e) {
			swal("Good job!", "You clicked the button!", "error")
		}), $("#m_sweetalert_demo_3_3").click(function(e) {
			swal("Good job!", "You clicked the button!", "success")
		}), $("#m_sweetalert_demo_3_4").click(function(e) {
			swal("Good job!", "You clicked the button!", "info")
		}), $("#m_sweetalert_demo_3_5").click(function(e) {
			swal("Good job!", "You clicked the button!", "question")
		}), $("#m_sweetalert_demo_4").click(function(e) {
			swal({
				title: "Good job!",
				text: "You clicked the button!",
				icon: "success",
				confirmButtonText: "Confirm me!",
				confirmButtonClass: "btn btn-focus m-btn m-btn--pill m-btn--air"
			})
		}), $("#m_sweetalert_demo_5").click(function(e) {
			swal({
				title: "Good job!",
				text: "You clicked the button!",
				icon: "success",
				confirmButtonText: "<span><i class='la la-headphones'></i><span>I am game!</span></span>",
				confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",
				showCancelButton: !0,
				cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>No, thanks</span></span>",
				cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
			})
		}), $("#m_sweetalert_demo_6").click(function(e) {
			swal({
				position: "top-right",
				type: "success",
				title: "Your work has been saved",
				showConfirmButton: !1,
				timer: 1500
			})
		}), $("#m_sweetalert_demo_7").click(function(e) {
			swal({
				title: "jQuery HTML example",
				html: $("<div>").addClass("some-class").text("jQuery is everywhere."),
				animation: !1,
				customClass: "animated tada"
			})
		}), */ 
		/* , $("#m_sweetalert_demo_9").click(function(e) {
			swal({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				type: "warning",
				showCancelButton: !0,
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel!",
				reverseButtons: !0
			}).then(function(e) {
				e.value ? swal("Deleted!", "Your file has been deleted.", "success") : "cancel" === e.dismiss && swal("Cancelled", "Your imaginary file is safe :)", "error")
			})
		}), $("#m_sweetalert_demo_10").click(function(e) {
			swal({
				title: "Sweet!",
				text: "Modal with a custom image.",
				imageUrl: "https://unsplash.it/400/200",
				imageWidth: 400,
				imageHeight: 200,
				imageAlt: "Custom image",
				animation: !1
			})
		}), $("#m_sweetalert_demo_11").click(function(e) {
			swal({
				title: "Auto close alert!",
				text: "I will close in 5 seconds.",
				timer: 5e3,
				onOpen: function() {
					swal.showLoading()
				}
			}).then(function(e) {
				"timer" === e.dismiss && console.log("I was closed by the timer")
			})
		}) */
	}
};
jQuery(document).ready(function() {
	SweetAlert2Demo.init()
});
</script>
		