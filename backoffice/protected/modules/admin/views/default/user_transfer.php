<title>User Transfer</title>
<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
#div_error{text-align:center;}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
.flash-Error{color:red;}

input#transfer_user{display:none;}
h3.control-label{
	color:rgba(25, 100, 155, 1);
	font-size: 16px;
    font-weight: 500;
}
</style>

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #1683c6;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #ef7b20;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
.user-role-div{display:none;}
.form-part .form-group > div.full-width{max-width:100%;}
.form-part .form-group > div#sample_1_wrapper{    max-width: 100%;}

/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: rgba(25, 100, 155, 1);
	text-transform: uppercase;
	font-size: 13px;
	width: 33.33%;
	font-weight: 500;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 25px;
	line-height: 25px;
	display: block;
	font-size: 12px;
	color: #333;
	background: #ccc;
	border-radius: 3px;
	margin: 0 auto 5px auto;
	position:relative;
	z-index:1;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: #ccc;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index:0; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #ef7b20;
	color: white;
}
.prog-div {
    position: relative;
    margin-top: 40px;
    width: 100%;
    text-align: center;
    margin: 50px auto;
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
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/saveusertransfer')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php

		
	
		$connection=Yii::app()->db; 
		$sql1="SELECT  bo_user.uid,bo_user.full_name,bo_user.middle_name,bo_user.last_name,bo_user.email from bo_user
		where  
		bo_user.is_active='1' and bo_user.system_user='N'";
		
		$command=$connection->createCommand($sql1);
		$users = $command->queryAll();
		
		
		$connection=Yii::app()->db; 
		$sql1="SELECT bo_roles.role_id,bo_roles.role_name,bo_roles.rele_desc from bo_roles
		where  
		bo_roles.is_role_active='Y' AND system_role<>'Y'";
		
		$command1=$connection->createCommand($sql1);
		$roles = $command1->queryAll();
		
		$sql2="SELECT bo_modules.id,bo_modules.module_name from bo_modules
		where  
		bo_modules.is_active='Y' and parent_id=0";
		
		$command=$connection->createCommand($sql2);
		$modules = $command->queryAll();
		
		$sql2="SELECT 
		* from bo_information_wizard_services_category where is_active='1' order by bo_information_wizard_services_category.id ASC";
		$command2=$connection->createCommand($sql2);
		$s_cat = $command2->queryAll();
		
		
		?>

				 	<div>								<h4 class="form-heading">
							User Transfer				</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

								
				<div class="form-group col-md-12 user-div" >
					
					<label class="col-md-12 control-label text-left" >
						 User <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<select name="user_id" id="user_id">
						<option value="">Select User</option>
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

					<div class="form-group col-md-12 user-div" >
					
					<label class="col-md-12 control-label text-left" >
						New User <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<select name="new_user_id" id="new_user_id">
						<option value="">Select User</option>
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
				
	<div class="user-role-div">			
		<h4 class="form-heading">
							Assigned Roles, Privileges and Services to the User				</h4>
							<div class="prog-div">
 <ul id="progressbar">
    <li class="active">Assign Roles</li>
    <li>Manage Privileges</li>
    <li>Assign Service Role</li>
  </ul>
  </div>
	
  <!-- One "tab" for each step in the form: -->
  <div class="tab"> 

   
  <!--Name:
    <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
    <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p> -->
	
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
					
					
				</div>
  </div>
  <div class="tab"> 
   
 
  <div class="form-group col-md-12 ">
					
					<!--<label class="col-md-12 control-label text-left" >
						 Module Name	<span style="color:red;">* </span>	</label> -->

						

						<div class="row services">
							<?php if(count($modules)>0){
								for($r=0;$r<count($modules);$r++){
									
									$sql3="SELECT bo_modules.id,bo_modules.module_name from bo_modules
											where  
											bo_modules.is_active='Y' and parent_id='".$modules[$r]['id']."'";
											
											$command=$connection->createCommand($sql3);
											$smodules = $command->queryAll();
									if(count($smodules)>0){
										echo '<div class="form-group col-md-12" id="div_UK-FCL-00056_0" ><div class="row services">
					
										<label class="col-md-12 control-label text-left" >'
										 .$modules[$r]['module_name'].'</label>';

										for($c=0;$c<count($smodules);$c++){
										echo "<div class='col-md-6'><input type='checkbox' name='module_id[]' value='".$smodules[$c]['id']."' class='chk'> <span>".$smodules[$c]['module_name']."</span></div>";
										}
										echo '</div></div>';
									}
									else{
										echo '<div class="form-group col-md-12" id="div_UK-FCL-00056_0" >';
										echo "<div class='col-md-6'> <label class='col-md-12 control-label text-left' > <input type='checkbox' name='module_id[]' value='".$modules[$r]['id']."' class='chk'>&nbsp;&nbsp;".$modules[$r]['module_name']."</label></div>";
										echo '</div>';
									}
									
								}
							}?>
						</div>
					
				
					
				</div>
  </div>
  <div class="tab">	
 
  
  <div class="form-group col-md-12">
					
					<label class="col-md-12 control-label text-left" >
						 Assign as<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="checkbox" name="role[]" value="83" class='chk'> <span>Verifier</span> &nbsp; <input type="checkbox" name="role[]" value="84" class='chk'> <span>Approver</span>
					</div>
				</div>

			<?php if(count($s_cat)>0){
				foreach($s_cat as $cat){
						$sql1="SELECT 
								service_id,
								core_service_name
								from bo_information_wizard_service_parameters left join bo_information_wizard_service_master on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id 
								where  bo_information_wizard_service_master.sc_id='".$cat['id']."' and
								bo_information_wizard_service_parameters.is_active='Y'";
								
								$command1=$connection->createCommand($sql1);
								$services = $command1->queryAll();
								if(count($services)>0){
					?>
				
				<div class="form-group col-md-12" id="div_UK-FCL-00056_0" >
					
					<label class="col-md-12 control-label text-left" >
						 <?php echo $cat['category_name'];?>	</label>

					
					<div class="row services">
						<?php 
							foreach($services as $s){
								echo "<div class='col-md-6'><input type='checkbox' name='service_id[]' value='".$s['service_id']."' class='chk'> <span>".$s['core_service_name']."</span></div>";
							}
							
						?>
						</div>
					
				</div>
				<?php }}}?>
			
  </div>
  
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
	  <button type="button" name="transfer_user" id="transfer_user">Submit</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</div>
				
		<!--
				<div class="col-md-12 mb-3">
					  <input type="submit" class="btn btn-primary " value="Update" name="transfer_user" id="transfer_user">
					
				</div>-->
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
			
<!--<link href="<?=$base?>/css/main-style.css" rel="stylesheet">	-->	
 <script>	
$(document).ready(function(){
				  $("#new_user_id").select2();  
				  $("#user_id").select2();  
				  $("#user_id").change(function(){
					  $('.user-role-div').show();
					  
				  });
});

 </script>
			
			<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  $(".tab").hide();
  x[n].style.display = "block";
  $("#progressbar li").removeClass("active");
  for(var i=0;i<3;i++){
	  if(i<=n){
		var index=i+1;
		$("#progressbar li:nth-child("+index+")").addClass("active");
	  }
	  else{
		  var index=i+1;
		  $("#progressbar li:nth-child("+index+")").removeClass("active");
	  }
  }
	
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    //document.getElementById("nextBtn").innerHTML = "Submit";
	$("#nextBtn").hide();
	$("#transfer_user").show();
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
	$("#transfer_user").hide();
		$("#nextBtn").show();
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}


function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
 // if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  /*if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }*/
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
$(function(){
$('#transfer_user').on('click',function(){
	if(validForm()){
		$('#s_form').submit();
	}
	else{
		return false;
	}
});
});

function validForm(){
	$(".errors").remove();
	var errors=false;
	if($("#user_id").val()==""){
		$("#user_id").after( "<span class='errors' style='color:red;'>Please select user.</span>");
		errors=true;
	}
	if($("#new_user_id").val()==""){
		$("#new_user_id").after( "<span class='errors' style='color:red;'>Please select new user.</span>");
		errors=true;
	}
	if($("#user_id").val()==$("#new_user_id").val()){
		$("#new_user_id").after( "<span class='errors' style='color:red;'>Please select different user.</span>");
		errors=true;
	}
	return !errors;
}
$(document).ready(function(){
		$("#user_id").on("change",function(){
		
		   if($(this).val()!=""){
			    currentTab=0;
		showTab(0); 
			$('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
				 $(this).prop('disabled','disabled');
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
										$("input[type=checkbox][value=" + result.roles[i] + "]").prop('disabled',false);
									}
								}
				            }
        });
		
		 $.ajax({
            type: "POST",
			data:{type:'user',id:$(this).val()},
			dataType:"json",
            url: "/backoffice/admin/default/getUserPrivileges",
            success: function(result) {
								
								if(result.modules.length>0){
									for(i=0;i<result.modules.length;i++){
										
										$("input[type=checkbox][value=" + result.modules[i] + "]").prop('checked',true);
										$("input[type=checkbox][value=" + result.modules[i] + "]").prop('disabled',false);
									}
									/*if(result.action.add=='Y'){
										$("input[type=checkbox][value='add']").prop('checked',true);
									}
									if(result.action.edit=='Y'){
										$("input[type=checkbox][value='edit']").prop('checked',true);
									}
									if(result.action.delete=='Y'){
										$("input[type=checkbox][value='delete']").prop('checked',true);
									}*/
								}
								
				            }
        });
		
		 $.ajax({
            type: "POST",
			data:{user_id:$(this).val()},
			dataType:"json",
            url: "/backoffice/admin/default/getUserServices",
            success: function(result) {
								/*if(result.role!=""){
									$("input[name=role][value=" + result.role + "]").prop('checked',true);
								}*/
								if(result.role.length>0){
									for(i=0;i<result.role.length;i++){
										
										$("input[name='role[]'][value=" + result.role[i] + "]").prop('checked',true);
										$("input[name='role[]'][value=" + result.role[i] + "]").prop('disabled',false);
									}
								}
								if(result.service.length>0){
									for(i=0;i<result.service.length;i++){
										
										$("input[name='service_id[]'][value=" + result.service[i] + "]").prop('checked',true);
										$("input[name='service_id[]'][value=" + result.service[i] + "]").prop('disabled',false);
									}
								}
				            }
        });
		  
		
		   }
		   else{
			   $(".user-role-div").hide();
		   }
	});
});
</script>

</body>
</html>
