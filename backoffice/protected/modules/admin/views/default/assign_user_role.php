<title>Assign Role</title>
<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
#div_error{text-align:center;}
.form-part .form-group > div#sample_1_wrapper{
    max-width: 100%;
    margin-bottom: 44px;
}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
.flash-Error{color:red;}
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
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/saveUserrole')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php

		
	
		$connection=Yii::app()->db; 
		$sql1="SELECT bo_roles.role_id,bo_roles.role_name,bo_roles.rele_desc from bo_roles
		where  
		bo_roles.is_role_active='Y' AND system_role<>'Y'";
		
		$command1=$connection->createCommand($sql1);
		$roles = $command1->queryAll();
		
		$sql1="SELECT bo_user.uid,bo_user.full_name,bo_user.middle_name,bo_user.last_name,bo_user.email from bo_user
		where  
		bo_user.is_active='1' and bo_user.uid<>'3' AND system_user<>'Y'";
		
		$command=$connection->createCommand($sql1);
		$users = $command->queryAll();
		?>

				 	<div>								<h4 class="form-heading">
							Assign Role	to Users				</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

			
				
				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 User <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<select name="user_id" id="user_id">
						<option value=""></option>
						<?php if(count($users)>0){
								for($u=0;$u<count($users);$u++){
									$name=$users[$u]['full_name'];
									if($users[$u]['middle_name']!="")
										$name.=' '.$users[$u]['middle_name'];
									$name.=' '.$users[$u]['last_name'];
									
									$name.= ' - '.$users[$u]['email'];
									?>
									<option value="<?php echo $users[$u]['uid'];?>"><?php echo $name;?></option>
									<?php
								}
							}?>
					</select>
					</div>
				</div>

			
				<div class="form-group col-md-12" >
					 <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
	<table  id="sample_1" width="100%">
	   <thead> 
		   <tr>
			   <th class="">
				<h5>&nbsp;</h5>
			   </th>
			   <th class="" width="30%">
				Role Name
			   </th>
			
			  
			   <th class="">
				Role Description
			   </th>
			   
		   </tr>
	   </thead>
			   <tbody class="ticket-item">
			   <?php if(count($roles)>0){
								for($r=0;$r<count($roles);$r++){?>
			   <tr>
			   <td><input type='checkbox' name='role_id[]' value='<?php echo $roles[$r]['role_id'];?>' class='chk'></td>
			   <td><?php echo $roles[$r]['role_name'];?></td>
			   <td><?php echo $roles[$r]['rele_desc'];?></td>
			 
			   </tr>
			     <?php }
			   }?>
			   </tbody>
		   </table>
		   </div>
					<!--<label class="col-md-12 control-label text-left" >
						 Role Name	<span style="color:red;">* </span>	</label>

						<div class="row services">
							
									echo "<div class='col-md-6'><input type='checkbox' name='role_id[]' value='".$roles[$r]['role_id']."' class='chk'> <span>".$roles[$r]['role_name']."</span></div>";
								}
							}?>
						</div> -->
					
				</div>

				
			
				<div class="col-md-12 mb-3">
					  <input type="submit" class="btn btn-primary " value="Assign Role" name="assign_role" id="assign_role_btn">
					
				</div>
			</div>
</div>
</form>




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
$(document).ready(function(){
	 TableDatatablesButtons.init();
				  //$("#role_id").select2();  
				  $("#user_id").select2(); 
	$("#user_id").on("change",function(){
		   if($(this).val()!=""){
		
			$('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
				
			});
			 $.ajax({
            type: "POST",
			data:{user_id:$(this).val()},
			dataType:"json",
            url: "/backoffice/admin/default/getUserRoles",
            success: function(result) {
								
								if(result.roles.length>0){
									for(i=0;i<result.roles.length;i++){
										
										$("input[type=checkbox][value=" + result.roles[i] + "]").prop('checked',true);
									}
								}
				            }
        });
		   }
	});				  
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
			