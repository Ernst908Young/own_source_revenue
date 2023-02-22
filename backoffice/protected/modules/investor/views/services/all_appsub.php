<?php 
if($sc_id){
	$wheresc = " AND sc_id=$sc_id";
}else{
	$wheresc = " ";
}

if(isset($ind_user_id)){
	$userID = $ind_user_id;
}
// echo $userID;die;



$ra_ser = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission as a
INNER JOIN bo_information_wizard_service_parameters bosp
ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
INNER JOIN bo_information_wizard_service_master as sm
ON sm.id = bosp.service_id
where  bosp.is_active='Y' $wheresc          
AND a.application_status NOT IN ('Z')
AND a.user_id=$userID ORDER BY application_created_date DESC")->queryAll(); 

$check_action_show = Check_agent::indShow();

/*$url = 'http://52.172.209.7/backoffice/protected/caipo_certificate/CERTIFICATE_809.pdf';
$parse = parse_url($url);
foreach ($parse as $key => $value) {
	echo $key.'<br>';
}*/

?>
          
              
 <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
	<table  id="sample_1" width="100%">
	   <thead> 
		   <tr>
			   <th class="text-center">
				<h5>SRN No.</h5>
			   </th>
			   <th class="text-center" width="25%">
				<h5>Service Name</h5>
			   </th>
				<th class="text-center">
				<h5>Applied On</h5>
			   </th>
			   <th class="text-center">
				<h5>Current Status</h5>
			   </th>
			  
			   <th class="text-center">
				<h5>Action</h5>
			   </th>
			   
		   </tr>
	   </thead>
		   <tbody class="ticket-item">
		   <?php
		if($ra_ser){
			foreach($ra_ser as $key => $value) 
			{ 		
				
				$newAppSubArr = json_decode($value['field_value'],true);
				$formName= '';
				if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==3)
				{
					$formName= 'Business Name Registration (Form 1)';
				}
				if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==2)
				{
					$formName= 'Name Reservation-Company (Form 33)';
				}
				if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==1)
				{
					$formName= 'Name Reservation-Society (Form 15)';
				}
				unset($approvedData);
				unset($approvedNameIncorp);
				if($value['sp_app_id']=='2.0' && isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && ($newAppSubArr['UK-FCL-00044_0']==2 || $newAppSubArr['UK-FCL-00044_0']==1)){

					$approvedNameSql = "SELECT  * FROM bo_banned_words where app_id='$value[submission_id]' AND status='Y' AND process_from='SYSTEM'";
					$approvedData = Yii::app()->db->createCommand($approvedNameSql)->queryRow();

				}else{
					$approvedIncorp = "SELECT company_name FROM bo_company_details where srn_no='$value[submission_id]' AND is_active='1'";
					$approvedNameIncorp = Yii::app()->db->createCommand($approvedIncorp)->queryRow();
				}
				
				
				
				
						
			?>    
			<tr class="ticket-row tableinside" id="<?php echo $key; ?>">
			   <td class="text-center">
				<p><?php echo $value['submission_id']; ?></p>
			   </td>
			   <td class="text-left" width="25%">
				<p><?php echo ($value['sp_app_id']=='2.0')? $formName :$value['app_name']; ?>  
				<br/>
				<?php 
					if(isset($approvedData['banned_words_name']) && !empty($approvedData['banned_words_name']))
					{
						echo "<br><b>Entity Name: </b>".$approvedData['banned_words_name'];
					} 
					elseif(isset($approvedNameIncorp['company_name']) && !empty($approvedNameIncorp['company_name']))
					{
						echo "<br><b>Entity Name: </b>".$approvedNameIncorp['company_name'];
					} 
					?>  
				</p>
			   </td>
			   <td class="text-center">
				<p><?php echo date('d-m-Y H:i:s',strtotime($value['application_created_date'])); ?> </p>
			   </td>
			   <td class="text-center">
				<p class="pending"><?php 
				$alreadypaid = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='pending' AND submission_id=".$value['submission_id'])->queryRow();
				//echo $value['application_status'].' - ';
					switch ($value['application_status']) {
						case "I":
						
								if($check_action_show){
									$app=$value;  
									$revertbackUrl=Yii::app()->createAbsoluteUrl("investor/home/redirectToServiceProviders/service_id/".base64_encode(@$app['service_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));	
									echo "<a href='$revertbackUrl' style='color:blue;'>Draft</a>";
								}else{
									echo 'Draft';
								}
								
							                             
							break;
						case "DP":
						//echo 'Draft';
							if($check_action_show){
								$app=$value;  
								$revertbackUrl=Yii::app()->createAbsoluteUrl("investor/home/redirectToServiceProviders/service_id/".base64_encode(@$app['service_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));	
								echo "<a href='$revertbackUrl' style='color:blue;'>Draft</a>";  
								}else{
									echo 'Draft';
								}                  
						  break;

						   case "SP":
						 	if($check_action_show){
								$app=$value;  
								$revertbackUrl=Yii::app()->createAbsoluteUrl("investor/home/redirectToServiceProviders/service_id/".base64_encode(@$app['service_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));	
								echo "<a href='$revertbackUrl' style='color:blue;'>Draft</a>";  
								}else{
									echo 'Draft';
								}     
								 break;
						 case "PD":
						 	if($check_action_show && empty($alreadypaid)){
							 	$app=$value;  						 
								echo "<a href='/panchayatiraj/backoffice/investor/services/payment/srn_no/".base64_encode(($app['submission_id']))."' style='color:blue;'>Payment Due</a>";
								}else{
									echo 'Payment Due';
								}                     
								break; 

						case "P":
							echo "Pending for Approval";
							break;
						/*case "F":
							echo "Pending for Approval";
							break;*/
						case "FA":
							echo "Pending for Approval";
							break; 
					/*	case "AB":
							echo "Pending for Approval";
							break; */

						case "A":
							echo "Approved";
							break;                                     
													 
						case "H":
							if($check_action_show){
								$app=$value;  
								$revertbackUrl=Yii::app()->createAbsoluteUrl("investor/home/redirectToServiceProviders/service_id/".base64_encode(@$app['service_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));	
								echo "<a href='$revertbackUrl' style='color:blue;'>Reverted</a>";  
								}else{
									echo 'Reverted';
								} 
						 
							break;  
						
						case "R":
							$reject_label = Rejectapplication::rejectstatusLabel(@$value['service_id']);
						    echo $reject_label;							
							break;
						case "W":
							echo "Withdrawn";
							break;  
						case "RI":
							echo "Refund Requested";
							break;  
							case "RS":
							echo "Refund Successful";
							break;
						default:
							echo "No Status";
					}
					?></p>
			   </td>
			   <td class="text-left">
				 <?php 
					/* echo $value['print_app_call_back_url'];
					if($value['service_id']!='2.0' || $value['service_id']!='5.0'){
						$printappurl = str_replace("infowizardtwo", "infowizard", $value['print_app_call_back_url']); 
					}else{*/
						$printappurl =  $value['print_app_call_back_url']; 
					//}
					 ?>
					<a target="_blank" href="<?php echo $printappurl; ?>" title="Print Application">
					   <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">                           
					</a>
					&nbsp;
					 <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizardtwo/subForm/applicationTimeline/subID/'. base64_encode($value['submission_id']));?>" title="View Timeline">
						<img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">
					
					 </a>
					   &nbsp;
					<?php 

					// Aamir revoce this condition $value['application_status']=='R' 15/12/2021

					if($value['application_status']=='P' || $value['application_status']=='F' || $value['application_status']=='H'){  
						  $paid_done = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$value['submission_id'])->queryRow();
						 if($paid_done){ ?>
					   <a href="<?php echo Yii::app()->createAbsoluteUrl('cashier/default/cancelpayment/subID/'. base64_encode($value['submission_id']));?>" title="Apply For Refund">
						 <img src="<?php echo $basePath; ?>/assets/applicant/images/ic_refund.png">					
					 </a>
					   &nbsp;
					   <?php }} ?>
					    <?php if($value['application_status']=='RI'){?>
					   <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('cashier/default/printrefundform/subID/'. base64_encode($value['submission_id']));?>" title="Refund Application">	
					    <img src="<?php echo $basePath; ?>/assets/applicant/images/ic_print_refund.png">										
							
					 </a>
					   &nbsp;
					   <?php } ?>

					   <?php if($value['application_status']=='PD'){
						$paid = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='pending' AND submission_id=".$value['submission_id'])->queryRow();
						 if($paid){ ?>
					   <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('cashier/default/printofflinefeeform/subID/'. base64_encode($value['submission_id']));?>" title="Offline Payment Form">	
					    <img src="<?php echo $basePath; ?>/assets/applicant/images/ic_print_refund.png">										
							
					 </a>
					  &nbsp;

					  <?php }
					  $transaction_detail = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_mode= 1 AND submission_id=".$value['submission_id']." ORDER BY id DESC")->queryRow();
					  $transaction_no = $transaction_detail['transaction_number'];// '21121711360200524758';
					  if($transaction_detail){
					   ?>
					 <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/services/verifyPaymentDetail/tno/'.base64_encode($transaction_no));?>" title="Reverify Payment">
					    R
					    	<!-- <img src="<?php echo $basePath; ?>/assets/applicant/images/verifypayment.png">										  -->
							
					 </a>
					   &nbsp; 
					   <?php } } ?>

<!--Archive or delete application link code-->
		<?php 
				$app_id = $value['submission_id'];
				$bo_infowiz_form_builder_application_log = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id=$app_id AND action_status='P'")->queryRow();

				if(!$bo_infowiz_form_builder_application_log){ ?>

					 <a href="<?php echo Yii::app()->createAbsoluteUrl('investor/services/deleteapp/srn_no/'. base64_encode($value['submission_id']));?>"  title="Delete application" style="color:red; font-size: 20px;" onclick="return confirm('Are you sure? want to delete the application')" >
					

					   <img src="<?php echo $basePath; ?>/assets/applicant/images/Trash-icon.png">
					 </a>

			<?php	}	?>		
<!--End code deleted -->

					 <a href="<?php echo Yii::app()->createAbsoluteUrl('ticketing/default/index/srn_no/'. base64_encode($value['submission_id']));?>"  title="Raise Ticket">
						<img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-grey.png">
					   
					 </a>
					 <?php 
					//echo @$newAppSubArr['UK-FCL-00044_0'];
					 if($value['application_status']=='A' && $value['is_certificate']==1 && !empty($value['download_certificate_call_back_url'])){ 
						$parse = parse_url($value['download_certificate_call_back_url']);
						$certi_path = isset($parse['path']) ? $parse['path'] : '';
					 	?>
					  &nbsp;
						  <a target="_blank" href="/panchayatiraj/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($certi_path); ?>&from=ticket" title="Download Letter / Certificate">
	                           <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
	                      </a>
					
					
					<?php } ?>
					<?php 
						
						if($check_action_show && ($value['application_status']=="A" || $value['application_status']=="W") && (in_array($value['service_id'],array('2.0','4.0','5.0','6.0','7.0','8.0','9.0','10.0'))))
						{
							$sqlRev = "SELECT  * FROM bo_revoke_submission where app_id='$value[submission_id]'";
							$revokeReq = Yii::app()->db->createCommand($sqlRev)->queryRow();
							
							
						?> 
							
							<?php 											
							if($value['application_status']!="W" && empty($approvedData['assign_new_name']) && empty($revokeReq))
							{ 
							?>		
							 &nbsp;							
								<a class="m-btn--custom withdwral_name" rel="<?php echo $value['submission_id'];?>" title="Withdraw Name"><img src="<?php echo $basePath; ?>/assets/applicant/images/withdrawal_s.png"></a>
							<?php 
							}
							$sqlRev = "SELECT  * FROM bo_revoke_submission where app_id='$value[submission_id]' and applicant_take_action='0' and department_take_action!='1'";
							$revokeReq = Yii::app()->db->createCommand($sqlRev)->queryRow();
							
							if(isset($revokeReq) && !empty($revokeReq) && $value['application_status']!="W")
							{
								$date1 = date_create(date('Y-m-d H:i:s'));
								$date2 = date_create(date('Y-m-d H:i:s',strtotime($revokeReq['created'])));
								$diff  = date_diff($date1,$date2);
								$ad	   = $diff->format("%a");
								$abi   = 90-$ad;
								$io = $abi." Days Left";
							?>
							 &nbsp;
								<a class="m-btn--custom revoke_request" id="accept" rel="<?php echo $value['submission_id'];?>" title="Revoked Request" data-msg="<?php echo @$revokeReq['comment'];?>" data-days="<?php echo $io;?>">
									<img src="<?php echo $basePath; ?>/assets/applicant/images/revoke2.svg">
								</a>
							<?php
							}
						} 
						?>

						<?php if($value['application_status']=="A"){ ?>

						<a href="/panchayatiraj/backoffice/investor/documentManagement/documentdownload/subID/<?= base64_encode($value['submission_id']) ?>"> <img src="<?php echo $basePath; ?>/assets/applicant/images/doc_list1.png"></a>
					<?php } ?>
					
			   </td>
		   
		   </tr>                                    
			<?php   }
				}
			?>
		 
	   </tbody> 
	</table>
</div>
                              
<link href="/panchayatiraj/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
<link href="/panchayatiraj/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />
<script src="/panchayatiraj/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>   
<script src="/panchayatiraj/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

 

<script src="<?= $baseUrl ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/> -->
<!-- <script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>   -->





<script type="text/javascript">  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered 1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
            var e = new Datatable;
            e.init({
                src: $("#datatable_ajax"),
                onSuccess: function(e, t) {},
                onError: function(e) {},
                onDataLoad: function(e) {
				$("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
   
  
                },
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 20,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    buttons: []
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
            jQuery().dataTable && (t(),n())
        }
    }
}();

</script>


<!-- <script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script> -->

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
			var data_days = $(this).attr('data-days');
			swal({
				title: "Revoke Request",
				html: revokeMsg+'<br/>'+data_days,
				type: "warning",
				showConfirmButton: !1,
				timer: 1500
			})
		});		
		
		/* $(".revoke_request").click(function(e) {
			var subID = $(this).attr('rel');
			var revokeMsg = $(this).attr('data-msg');
			swal({
				title: "Revoke Request",
				text: revokeMsg,
				type: "warning",
				showCancelButton: false,
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
		});	 */
				
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

	SweetAlert2Demo.init();

   
 TableDatatablesButtons.init();
    

	   
});
</script>