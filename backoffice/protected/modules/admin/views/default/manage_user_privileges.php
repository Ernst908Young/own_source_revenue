<title>Manage Privileges</title>
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
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/saveUserprivileges')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php

		
	
		$connection=Yii::app()->db; 
		$sql1="SELECT bo_roles.role_id,bo_roles.role_name from bo_roles
		where  
		bo_roles.is_role_active='Y' and system_role<>'Y'";
		
		$command1=$connection->createCommand($sql1);
		$roles = $command1->queryAll();
		
		$sql1="SELECT bo_user.uid,bo_user.full_name,bo_user.middle_name,bo_user.last_name,bo_user.email from bo_user
		where  
		bo_user.is_active='1' and bo_user.uid<>'3' And system_user<>'Y'";
		
		$command=$connection->createCommand($sql1);
		$users = $command->queryAll();
		
		$sql2="SELECT bo_modules.id,bo_modules.module_name from bo_modules
		where  
		bo_modules.is_active='Y' and parent_id=0";
		
		$command=$connection->createCommand($sql2);
		$modules = $command->queryAll();
		?>

				 	<div>								<h4 class="form-heading">
							Manage Privileges				</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 User Privileges <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="privi_type" value="role"> Role Based &nbsp;
						<input type="radio" name="privi_type" value="user"> User Based &nbsp;
					</div>
				</div>
				
				<div class="form-group col-md-12 user-div" style="display:none;">
					
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

			
				<div class="form-group col-md-12 role-div" style="display:none;">
					
					<label class="col-md-12 control-label text-left" >
						 Role Name	<span style="color:red;">* </span>	</label>

						<div class="col-md-12">
						<select name="role_id" id="role_id">
							<option value="">Select Role</option>
							<?php if(count($roles)>0){
								for($r=0;$r<count($roles);$r++){
									echo "<option value='".$roles[$r]['role_id']."'>".$roles[$r]['role_name']."</option>";
								}
							}?>
							</select>
						</div>
					
				</div>
				
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
				
				<!--<div class="form-group col-md-12 ">
					
					<label class="col-md-12 control-label text-left" >
						Allowed Actions	<span style="color:red;">* </span>	</label>

						

						<div class="row services">
							
									<div class='col-md-4'><input type='checkbox' name='action[]' value='add' class='chk'> <span>Add</span></div>
									<div class='col-md-4'><input type='checkbox' name='action[]' value='edit' class='chk'> <span>Edit</span></div>
									<div class='col-md-4'><input type='checkbox' name='action[]' value='delete' class='chk'> <span>Delete</span></div>
								
						</div>
					
				
					
				</div> -->

				
			
				<div class="col-md-12 mb-3">
					  <input type="submit" class="btn btn-primary " value="Update" name="manage_access" id="manage_access">
					
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
$(document).ready(function(){
				  //$("#role_id").select2();  
				  //$("#user_id").select2();  
	$("input[type=radio][name=privi_type]").change(function(){
		
		$("#role_id").val($("#role_id option:first").val());
		
		$("#user_id").val($("#user_id option:first").val());
		 $("#role_id").select2();  
		 $("#user_id").select2();  
		
		$('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
				
			});
		if($(this).val()=="role"){
			$(".user-div").hide();
			$(".role-div").show();
		}
		else if($(this).val()=="user"){
			$(".role-div").hide();
			$(".user-div").show();
		}
	});	
	$("#user_id").on("change",function(){
			$('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
				
			});
		   if($(this).val()!=""){
		
		
			 $.ajax({
            type: "POST",
			data:{type:'user',id:$(this).val()},
			dataType:"json",
            url: "/backoffice/admin/default/getUserPrivileges",
            success: function(result) {
								
								if(result.modules.length>0){
									for(i=0;i<result.modules.length;i++){
										
										$("input[type=checkbox][value=" + result.modules[i] + "]").prop('checked',true);
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
		  
		   }
	});		

$("#role_id").on("change",function(){
		$('.chk').each(function(){ //iterate all listed checkbox items
				$(this).prop('checked',false); //change ".checkbox" checked status
				
			});
		   if($(this).val()!=""){
		
		
			 $.ajax({
            type: "POST",
			data:{type:'role',id:$(this).val()},
			dataType:"json",
            url: "/backoffice/admin/default/getUserPrivileges",
            success: function(result) {
								
								if(result.modules.length>0){
									for(i=0;i<result.modules.length;i++){
										
										$("input[type=checkbox][value=" + result.modules[i] + "]").prop('checked',true);
									}
									if(result.action.add=='Y'){
										$("input[type=checkbox][value='add']").prop('checked',true);
									}
									if(result.action.edit=='Y'){
										$("input[type=checkbox][value='edit']").prop('checked',true);
									}
									if(result.action.delete=='Y'){
										$("input[type=checkbox][value='delete']").prop('checked',true);
									}
								}
								
				            }
        });
		  
		   }
	});		
				  //  if($("input[type=radio][name=role]").filter(':checked').length < 1)
});
 </script>
			