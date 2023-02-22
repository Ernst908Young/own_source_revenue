<title>Manage Role</title>
<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
.active-lnk{color:blue;}
.flash-Error{color:red;}
#div_error{text-align:center;}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
</style>
<div class="dashboard-home">
	<div class="applied-status">
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
		    
		</div>
	</div>
</div>
	<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>
<div id="div_error"></div>
<div class="m-wizard__form reservation-form" style="padding: 17px 33px 0px;">
<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/addrole')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php

		
	
		
	/*	$sql1="SELECT 
		tbl_user_service_role.id,tbl_user_service_role.Approver,tbl_user_service_role.Verifier,bo_information_wizard_service_parameters.core_service_name,bo_user.full_name from tbl_user_service_role left join bo_user on tbl_user_service_role.user_id=bo_user.uid left join bo_information_wizard_service_parameters on tbl_user_service_role.service_id=bo_information_wizard_service_parameters.service_id
		where  
		bo_information_wizard_service_parameters.is_active='Y'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryAll();*/
		?>

				 	<div>								<h4 class="form-heading">
							Add Role						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 Role Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="role_name" id="role_name" value="">
					</div>
				</div>
				
				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 Role Description <span style="color:red;">* </span></label>

					<div class="col-md-12">
					<textarea name="role_desc" id="role_desc"></textarea>
					</div>
				</div>

			
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 External<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="is_external" value="Y"> <span>Yes</span> &nbsp; <input type="radio" name="is_external" value="N" checked> <span>No</span>
					</div>
				</div>

			

				
			
				<div class="col-md-12 mb-3">
					  <input type="button" class="btn btn-primary " value="Add Role" name="add_role" id="add_role_btn">
					
				</div>
			</div>
</div>
</form>




              </div>
			  
			  
<?php
$sql = "select * from bo_roles where system_role<>'Y'";
		$res = Yii::app()->db->createCommand($sql)->queryAll();?>
<div class="row">
		<div class="col-md-12">
		   <!-- BEGIN EXAMPLE TABLE PORTLET-->
		   <div class="portlet box green">
			  <div class="portlet-title">
				 <div class="caption">
					<i style="font-size:24px" class="icon-list"></i>
					<span class="caption-subject bold uppercase">Roles List </span>
				 </div>
				 <div class="tools"> 
					<a href="javascript:;" class="collapse"> </a>
				 </div>
			  </div>
			  <div class="portlet-body">
				<table class='table table-striped table-bordered table-hover order-column' id='sample_1'>
				   <thead>
					   <tr>
						   <th>ID</th>
						   <th>Role Name</th>
						   <th>Role Description</th>
						  
						   <th>External</th>
						   <th>Status</th>
						   <th>Action</th>
					   </tr>
				   </thead>
				   <tbody>
				 <?php 				
				if(empty($res)) {
					echo "<hr><h4>No Role Found!</hr></h4>";	
				}
				if(count($res)>0){
					for($i=0;$i<count($res);$i++){
						?>
						<tr>
						   <td><?php echo $res[$i]['role_id'];?></td>
						   <td><?php echo $res[$i]['role_name'];?></td>
						   <td><?php echo $res[$i]['rele_desc'];?></td>
						   <td><?php echo $res[$i]['is_external'];?></td>
						  
						   <td><?php  if($res[$i]['is_role_active']=='Y') echo "<a href='/backoffice/admin/default/rolestatus/?status=deactive&id=".$res[$i]['role_id']."'  class='active-lnk'>Active</a>"; else echo "<a href='/backoffice/admin/default/rolestatus/?status=active&id=".$res[$i]['role_id']."' class='active-lnk'>Deactive</a>"; ?></td>
						   <td><a href='/backoffice/admin/default/editrole/?id=<?php echo $res[$i]['role_id'];?>' class='active-lnk'>Edit</a></td>
					   </tr>
						<?php
					}
					
				}
				?>
				
				   </tbody>
				</table> 
			  </div>
		   </div>
		</div>
	</div>	
</div>	
<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?=$base?>/assets/frontend/dashboard/css/plugins/select2/select2.css">

<script src="<?=$base?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!--<link href="<?=$base?>/css/main-style.css" rel="stylesheet">	-->		  
			 <script>	
			  $("#add_role_btn").click(function(){
				    if(checkValidation()){
						
						$('#s_form').hide();
						$('#s_form').submit();
					}
			   });
			   function checkValidation(){
				    var errors = false;
					$(".errors").remove();
					if(($("#role_name").val()).trim()==""){
			
						$("#role_name").after( "<span class='errors' style='color:red;'>Role name is required.</span>");
						//	$("#password1").focus();
						errors = true;
					}
					if(($("#role_desc").val()).trim()==""){
						$("#role_desc").after( "<span class='errors' style='color:red;'>Role Descripion is required.</span>");
						errors = true;
						
					}
				 
				
				
				
				return !errors;
			   }
			   
 $(document).ready(function(){
			   TableDatatablesButtons.init();
			  });
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
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
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