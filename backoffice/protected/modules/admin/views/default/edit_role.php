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
<form id="s_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/updaterole')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id'];?>">
<?php

		
$sql1="SELECT 
	* from bo_roles 
		where  
		bo_roles.role_id='".$_REQUEST['id']."'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$role = $command1->queryRow();
		?>

				 	<div>								<h4 class="form-heading">
							Edit Role						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 Role Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="role_name" id="role_name" value="<?php echo $role['role_name'];?>">
					</div>
				</div>
				
				<div class="form-group col-md-12" >
					
					<label class="col-md-12 control-label text-left" >
						 Role Description <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<textarea name="role_desc" id="role_desc"><?php echo $role['rele_desc'];?></textarea>
					</div>
				</div>

			
				
				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 External<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="is_external" value="Y" <?php  if($role['is_external']=='Y') echo "checked";?>> <span>Yes</span> &nbsp; <input type="radio" name="is_external" value="N" <?php  if($role['is_external']=='N') echo "checked";?>> <span>No</span>
					</div>
				</div>

			

				
			
				<div class="col-md-12 mb-3">
					  <input type="button" class="btn btn-primary " value="Update Role" name="update_role" id="update_role_btn">
					
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
			  $("#update_role_btn").click(function(){
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
			   </script>