<title>Revoke Name</title>
<?php 
$role_id = $_SESSION['role_id'];
$userId = $_SESSION['uid'];
	$serviceByUserrole = Yii::app()->db->createCommand("SELECT * FROM tbl_user_service_role WHERE user_id = $userId AND role_id = $role_id AND is_active='Y'")->queryAll(); 
	$checkser_arr = [];
	foreach ($serviceByUserrole as $key => $value) {
	    $checkser_arr[$value['service_id']] = $value['service_id'];
	}

?>
<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>



<?php $pa=0;	
	if(!empty($approvedData)) {                 	
		foreach($approvedData as $key=>$val){
			if(in_array($val['s_id'], $checkser_arr)){
					$pa=$pa+1;
			} ;
		}
	} ?>
	
	<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>List of Companies Incorporated (<?= $pa ?>)</h4>
        
        </div>
<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_1'>
	<thead>
		<tr>
			<th class="text-center">S.No</th>
			<th class="text-center">Entity Number</th>	
			<th class="text-left">Entity Name</th>
			<th class="text-left">Applicant Details</th> 
			<!--<th class="text-center">Application Status</th>-->
			<th class="text-center">Approved On</th>
			<th class="text-center">Action</th>
		</tr>	
	</thead>
		<?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending')?>
		<tbody class="ticket-item"> 
	<?php if(!empty($approvedData)) { 
			foreach($approvedData as $key=>$val){	
			 if(in_array($val['s_id'], $checkser_arr)){			
				$status ="";
				$submission_id = $val['srn_no'];
				$name_related_srn = $val['name_related_srn'];
				$s_id = $val['s_id'];
				
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
				<tr class="ticket-row tableinside" id="<?php echo $key; ?>">
				<td class="text-center"><?php echo $key+1;?></td>
				<td class="text-center">
					<?php echo $val['reg_no']?>					
				</td>	
				<td class="text-left"><?php echo $val['company_name']?></td>
				<td class="text-left">
				<?php 
				echo "Name: " .$val['first_name'].''.$val['last_name']."<br/>";
				echo "Email ID: " .$val['email']."<br/>";
				echo "Contact No.: " .$val['mobile_number']."<br/>";
				echo "SRN No.: " .$val['srn_no']."<br/>";
				
				?>				
				</td>
				<!--<td class="text-center"><?php //echo @$statusArray[$status]?></td>-->
				<td class="text-center"><?php echo date("d-M-Y",strtotime($val['created_on']));?></td>		
				<td class="text-center">
				<?php if(($revokdata['status']=='N' || empty($revokdata['status'])) ){ ?>
					<a href="javascript:void(0);" class="revoke_butt btn btn-success" data-toggle="modal" data-target="#myModal" rel="<?php echo $submission_id;?>" name-related-srn="<?php echo @$name_related_srn;?>" style="color:#fff;">Revoke</a></br></br>
				<?php }else{ ?>
					<span style="text-color:green">Notification Sent!</span></br></br>
				<?php }?>
				<?php // && $recommenddata['assign_new_name_status']=='0'
				if($revokdata['status']=='Y'){			
					$date1 = date_create(date('Y-m-d H:i:s'));
					$date2 = date_create(date('Y-m-d H:i:s',strtotime($revokdata['created'])));
					$diff  = date_diff($date1,$date2);
					$ad	   = $diff->format("%a");
					$timeRemaining   = 60-$ad;
					$io = "<span style='color:red'>".$timeRemaining." Days Left</span>";
					//if($timeRemaining==0){
				?>
						<a href="javascript:void(0);" class="new_name_assign_butt btn btn-success" data-toggle="modal" data-target="#newNameModal" rel="<?php echo $submission_id;?>" style="color:#fff;" service-id="<?php echo $s_id;?>" name-related-srn="<?php echo @$name_related_srn;?>" comp-type="<?php echo $val['company_type'];?>">Assign New Entity Name</a><br/>
					<?php //}else{
							echo $io;
						//}
				} 
				?>
				</td>		
				</tr>	
			<?php 
		
			}
		}
		}
	?>
</table>
<div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<form name="revokform" id="revokform" method='post' action="">
			<input type="hidden" name="revoke_app_id" id="revoke_app_id" value="">
			<input type="hidden" name="revoke_name_related_srn" id="revoke_name_related_srn" value="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="revokeModalLabel"><b>Revoke Comment:</b></h5>
				</div>
				<div class="modal-body">
				   <textarea name="revokemsg" id="revokemsg" class="form-control" rows="6"></textarea>
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
		<form name="newCompanyform" id="newCompanyform" method='post' action="/backoffice/infowizardtwo/subFormCompanyNameReservation/assignNewName">
			<input type="hidden" name="new_app_id" id="new_app_id" value="">
			<input type="hidden" name="comp_type" id="comp_type" value="">
			<input type="hidden" name="name_related_srn" id="name_related_srn" value="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="revokeModalLabel"><b>Assign New Entity Name</b></h5>
					
				</div>
				<div class="modal-body">
				   <input name="new_name_company" id="new_name_company" class="form-control" placeholder="Search Company Name" rel="new_name_company" required></input>
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
									if(result=='CHARITY_NAME'){					
										msg = 	"Proposed name matches with the name of exisiting charity name, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', true);
									}
									if(result=='CHARITY_NAME_PART'){					
										msg = 	"Proposed name is too close to the name of exisiting charity name, please propose another name";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', true);
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
									if(result=='MINISTRY_DEPARTMENT'){	
										msg ="Proposed name matches with the name of exisiting ministry name, please propose another name.";
										$("#"+fieldID).after("<span class='reserevdname'>"+msg+"</span>");	
										$("#new_name_submit_butt").prop('disabled', false);			
									}
									if(result=='MINISTRY_DEPARTMENT_PART'){	
										msg ="Proposed name is too close to the name of exisiting ministry name, please propose another name or you still want to proceed.";
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



  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
	jQuery(document).ready(function() {		
		$('.revoke_butt').on('click',function(){			
			var id = $(this).attr('rel');
			var name_related_srn = $(this).attr('name-related-srn');
			$("#revoke_app_id").val(id);
			$("#revoke_name_related_srn").val(name_related_srn);
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
			var name_related_srn = $(this).attr('name-related-srn');
			var comp_type = $(this).attr('comp-type');
			//alert(name_related_srn);
			$("#new_app_id").val(id);
			$("#comp_type").val(comp_type);
			$("#name_related_srn").val(name_related_srn);
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

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 responsive: !0,

                 order: [

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                    dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

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
			 jQuery().dataTable && (e(),  n())
			}
		}
    }();

	jQuery(document).ready(function() {
		TableDatatablesButtons.init();
		/*$("#sample_1_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_1_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_1_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_1_paginate").attr("style",'margin-top:15px;');*/
	});
</script>	