<style type="text/css">
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -53px !important;
}
.a_cent{
	text-align:center;
	vertical-align:middle !important;
}
.l_cent{
	text-align:left;
	vertical-align:middle !important;
}
.reserevdname{
	color:red;
}
.reserevdname_allowed{
	color:green;
}
.assignname{
	color:red;
}
</style> 
<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'>
			<i style="font-size:20px;" class='fa fa-users'></i>
			Approved Applications (<?php echo count($approvedData);?>)</div>
		<div class='tools'> </div>
	</div>
<div class="portlet-body">
<table class='table table-striped table-bordered' id='sample_2'>
	<thead>
		<tr>
			<th class="a_cent">S.No</th>
			<th class="l_cent">Application Details</th>	
			<th class="l_cent">Service Name</th>
			<th class="l_cent">Applicant Details</th> 
			<th class="a_cent">Application Status</th>
			<th class="a_cent">Applied On</th>
			<th class="a_cent">Action</th>
		</tr>	
	</thead>
		<?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending')?>
	<?php if(!empty($approvedData)) { 
			foreach($approvedData as $key=>$val){				
				$status = $val['application_status'];
				$submission_id = $val['submission_id'];
				
				$revokdata=Yii::app()->db->createCommand("SELECT * FROM bo_revoke_submission WHERE app_id='$submission_id'")->queryRow();
				$recommenddata=Yii::app()->db->createCommand("SELECT * FROM bo_recomended_name WHERE submission_id='$submission_id'")->queryRow();
				
				$approvedNameSql = "SELECT  * FROM bo_recomended_name where submission_id='$submission_id' AND role_id IN(84, 83) AND withdrawal_status='0' order by role_id DESC";
				$approvedData = Yii::app()->db->createCommand($approvedNameSql)->queryRow();
				$approvedName  = "";
				if($approvedData['assign_new_name']!=''){
					$approvedName = "<br><b>Approved Name: </b>".$approvedData['assign_new_name'];
				}else if($approvedData['recomended_value']!='' && $approvedData['assign_new_name']==''){
					$approvedName = "<br><b>Approved Name: </b>".$approvedData['recomended_value'];
				}
		?>
				<tr>
				<td class="a_cent"><?php echo $key+1;?></td>
				<td class="l_cent">
					<b>SRN:</b> <?php echo $val['submission_id']?>
					<?php echo $approvedName;?>
				</td>	
				<td class="l_cent"><?php echo $val['core_service_name']?></td>
				<td class="l_cent">
				<?php 
				echo "Name: " .$val['first_name'].''.$val['last_name']."<br/>";
				echo "Email ID: " .$val['email']."<br/>";
				echo "Contact No.: " .$val['mobile_number']."<br/>";
				
				?>				
				</td>
				<td class="a_cent"><?php echo @$statusArray[$status]?></td>
				<td class="a_cent"><?php echo date("d-M-Y",strtotime($val['application_updated_date_time']));?></td>		
				<td class="a_cent">
				<?php if(($revokdata['status']=='N' || empty($revokdata['status'])) ){ ?>
					<a href="javascript:void(0);" class="btn btn-success revoke_butt" data-toggle="modal" data-target="#revokeModal" rel="<?php echo $submission_id;?>">Revoke</a></br></br>
				<?php }else{ ?>
					<span style="text-color:green">Notification Sent!</span></br></br>
				<?php }?>
				<?php // && $recommenddata['assign_new_name_status']=='0'
				if(($revokdata['status']=='Y' || empty($revokdata['status']))){			
					$date1 = date_create(date('Y-m-d H:i:s'));
					$date2 = date_create(date('Y-m-d H:i:s',strtotime($revokdata['created'])));
					$diff  = date_diff($date1,$date2);
					$ad	   = $diff->format("%a");
					$abi   =  60-$ad;
					$io = $abi." Days Left";
				
				?>
				<a href="javascript:void(0);" class="btn btn-success new_name_assign_butt" data-toggle="modal" data-target="#newNameModal" rel="<?php echo $submission_id;?>">Assign New Company Name</a>
				<?php } ?>
				</td>		
				</tr>	
			<?php 
		
			}
		}
	?>

</table>
<div class="modal fade" id="revokeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<form name="revokform" id="revokform" method='post' action="">
			<input type="hidden" name="revoke_app_id" id="revoke_app_id" value="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="revokeModalLabel"><b>Revoke Comment:</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
				   <textarea name="revokemsg" id="revokemsg" cols="70" rows="6"></textarea>
				   <div class="error_revoke_msg" style="color:red;"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary font-weight-bold revoke_submit">Submit</button>
				</div>
			</div>
		</form>
    </div>
</div>
<div class="modal fade" id="newNameModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<form name="newCompanyform" id="newCompanyform" method='post' action="/backoffice/infowizard/subFormCompanyNameReservation/assignNewName">
			<input type="hidden" name="new_app_id" id="new_app_id" value="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="revokeModalLabel"><b>Assign New Name of Company</b></h5>
					<button type="button" class="close new_name_close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
				   <input name="new_name_company" id="new_name_company" class="form-control" placeholder="Search Compnay Name" rel="new_name_company" required></input>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary font-weight-bold new_name_submit" id="new_name_submit_butt">Submit</button>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function () {
					$("#new_name_company").on('blur',function(){
						var value = $(this).val();
						var fieldID = $(this).attr('rel');
						if(value){
							$.ajax({
								type: "POST",
								url: "/backoffice/infowizard/subFormCompanyNameReservation/CheckProposedName",
								data: "getProposedWord="+value,
								dataType:"html",
								async:false,
								success: function(result) {
									console.log(result);
									$(".reserevdname").remove();
									$(".reserevdname_allowed").remove();
									if(result=='BANNED_WORDS'){					
										msg = 	"Proposed name matches with banned word, please propose another name";
										//alert($("#"+fieldID));
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', true);
									}									
									if(result=='BANNED_WORDS_PART'){					
										msg = 	"Proposed name is too close to banned word, please propose another name or you still want to proceed";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='COMPANY_RESERVED'){					
										msg = 	"Proposed name matches with the name of exisiting company name, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='COMPANY_RESERVED_PART'){					
										msg = 	"Proposed name is too close to the name of exisiting company name, please propose another name or you still want to proceed";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='SOCIETY_NAME'){					
										msg = 	"Proposed name matches with the name of exisiting society name, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='SOCIETY_NAME_PART'){					
										msg = 	"Proposed name is too close to the name of exisiting society name, please propose another name or you still want to proceed";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='BUSINESS_NAME'){					
										msg = 	"Proposed name matches with the name of exisiting business name, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='BUSINESS_NAME_PART'){					
										msg = 	"Proposed name is too close to the name of exisiting business name, please propose another name or you still want to proceed";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='POLTICAL_PARTY'){							
										msg ="Proposed name matches with the name of exisiting political party, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='POLTICAL_PARTY_PART'){					
										msg ="Proposed name is too close to the existing political party,please propose another name or you still proceed.";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='UNIVERSITY_NAME'){						
										msg ="Proposed name matches with the name of existing university, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='UNIVERSITY_NAME_PART'){						
										msg ="Proposed name is too close to the existing university,please propose another name or you still proceed.";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='ASSOCIATION_NAME'){
										msg ="Proposed name matches with the name of existing professional association, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', true);
									} 
									if(result=='ASSOCIATION_NAME_PART'){						
										msg ="Proposed name is too close to existing professional association,please propose another or you still proceed.";	
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}
									if(result=='0'){
										msg = "";
										//console.log($("#"+fieldID));
										$("#"+fieldID).after("<span class='reserevdname_allowed'>Name is Available!</span>");
										$("#new_name_submit_butt").prop('disabled', false);
									}	
								}									
							});	
						}
					})      
				}); 
			</script>
		</form>
    </div>
</div>
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
	jQuery(document).ready(function() {		
		$('.revoke_butt').on('click',function(){			
			var id = $(this).attr('rel');
			$("#revoke_app_id").val(id);
		});
		
		$('.revoke_submit').on('click',function(){
			$(".error_evoke_msg").html('');
			var revokemsg = $("#revokemsg").val();
			//alert(revokemsg);
			if(revokemsg){
				$("#revokform").submit();
				return true;
			}else{
				$(".error_revoke_msg").html('Please enter message');
				return false;
			}
		});
		
		$('.new_name_assign_butt').on('click',function(){			
			var id = $(this).attr('rel');
			$("#new_app_id").val(id);
		});
		
		$('.new_name_close').on('click',function(){			
			$("#new_name_company").val('');
			location.reload();
		});
		
		$('.new_name_submit').on('click',function(){
			$(".assignname").remove('');
			var new_name_company = $("#new_name_company").val();
			//alert(new_name_company);
			if(new_name_company){
				//alert($(this).attr('url'));
				$("#newCompanyform").submit();
				return true;
			}else{
				$("#new_name_company").after('<span class="assignname">Please enter new name.</span>');
				return false;
			}
		});
	});
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

                     className: "btn white btn-outline"

                 },  {

                     extend: "pdf",

                     className: "btn white btn-outline"

                 }, {

                     extend: "excel",

                     className: "btn white btn-outline"

                 }],

                 order: [

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

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

                         // [0, "asc"]

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

             /* $(".date-picker").datepicker({

                 rtl: App.isRTL(),

                 autoclose: !0

             });
 */
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