<title>Assign Services</title>
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
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/assignServiceRole')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php
$connection=Yii::app()->db; 
$sql="SELECT 
		 bo_user.uid,bo_user.full_name,bo_user.middle_name,bo_user.last_name,bo_user.email
		from bo_user
		where  
		bo_user.is_active='1' and system_user<>'Y' order by full_name ASC";
		//$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$users = $command->queryAll();
		
		$sql2="SELECT 
		* from bo_information_wizard_services_category where is_active='1' order by bo_information_wizard_services_category.id ASC";
		$command2=$connection->createCommand($sql2);
		$s_cat = $command2->queryAll();
		
		
	
		
	/*	$sql1="SELECT 
		tbl_user_service_role.id,tbl_user_service_role.Approver,tbl_user_service_role.Verifier,bo_information_wizard_service_parameters.core_service_name,bo_user.full_name from tbl_user_service_role left join bo_user on tbl_user_service_role.user_id=bo_user.uid left join bo_information_wizard_service_parameters on tbl_user_service_role.service_id=bo_information_wizard_service_parameters.service_id
		where  
		bo_information_wizard_service_parameters.is_active='Y'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryAll();*/
		?>

				 	<div>								<h4 class="form-heading">
							Assign Service Role						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 User	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<select name="user_id" id="user_id" required>
						<option value="">Select User</option>
						<?php if(count($users)>0){
							foreach($users as $u){
								$name=$u['full_name'];
									if($u['middle_name']!="")
										$name.=' '.$u['middle_name'];
									$name.=' '.$u['last_name'];
									
									$name.= ' - '.$u['email'];
								echo "<option value='".$u['uid']."'>".$name."</option>";
							}
							
						}?>
					</select>
					</div>
				</div>

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
			

				
			
				<div class="col-md-12 mb-3">
					  <input type="submit" class="btn btn-primary " value="Assign" name="assign_role" id="assign_role_btn">
					
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
<!--<link href="<?=$base?>/css/main-style.css" rel="stylesheet">	-->		  
			  <script>
			  $("#assign_role_btn").click(function(e){
			
				  var flag=0
				  $("#div_error").html("");
				  if( $("#user_id").val()==""){
					  flag=1;
					
					  $("#div_error").append("<p style='color:red;padding-left:16px;' class='errorDetail'>Please select a user</p>");
						$("#user_id").focus();
						
					 
				  }
				  
				   //if( !$("input[name='role[]']").is(':checked')){
					   if ($("input[name='role[]']").filter(':checked').length < 1){
					  
					  flag=1;
					  $("#div_error").append("<p style='color:red;padding-left:16px;' class='errorDetail'>Please select a role</p>");
					 
						
						
					 
				  }
				 if ($("input[name='service_id[]']").filter(':checked').length < 1){
					   flag=1;
						 $("#div_error").append("<p style='color:red;padding-left:16px;' class='errorDetail'>Please select atleast one service</p>");
						
					
				 }
				 
				 
				  
				  if(flag==1){
					 
					  return false;
				  }
				  
			  });
			  
			  $(document).ready(function(){
				  $("#user_id").select2();
				  $("#user_id").on('change', function() {
			
      if($(this).val()!=""){
		
		  $('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
			});
        $.ajax({
            type: "POST",
			data:{user_id:$(this).val()},
			dataType:"json",
            url: "/panchayatiraj/backoffice/admin/default/getUserServices",
            success: function(result) {
								/*if(result.role!=""){
									$("input[name=role][value=" + result.role + "]").prop('checked',true);
								}*/
								if(result.role.length>0){
									for(i=0;i<result.role.length;i++){
										
										$("input[name='role[]'][value=" + result.role[i] + "]").prop('checked',true);
									}
								}
								if(result.service.length>0){
									for(i=0;i<result.service.length;i++){
										
										$("input[name='service_id[]'][value=" + result.service[i] + "]").prop('checked',true);
									}
								}
				            }
        });
	  }
	  else{
		  $("input[type=radio][name=role]").prop('checked',false);
		  $('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
			});
	  }
    });
	
	
				 
			  });
			  

			  </script>