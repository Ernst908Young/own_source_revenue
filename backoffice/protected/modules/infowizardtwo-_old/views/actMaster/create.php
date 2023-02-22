<style>
    .error{color:red;}    
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        Create New Act </div>
    <div class="text-right">
        <a href="<?=$this->createUrl('/infowizard/actMaster/index')?>" class="btn btn-info" style="margin-top:3px;"><i class="fa fa-arrow-left"></i>View List Act</a>
	</div>	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

<form name="form" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="type">Select Type<?php //echo $form->labelEx($model,'Act Type'); ?></label>
			<div class="col-md-4">
     <select name="type" id="type" class="form-control" >
		<option value=""><-----Select Type-----></option>
		<option value="Act">Act</option>
		<option value="Policy">Policy</option>
		<option value="Notification">Notification</option>
		</select>
		<div class="error type"></div>
		</div>
		</div>
	
	
		
	</div>

	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_type">Act/Policy/Notification Type<?php //echo $form->labelEx($model,'Act Type'); ?></label>
			<div class="col-md-4">
     <select name="act_type" id="act_type" class="form-control"  onchange="change()" >
		<option value=""><-----Select Act/Policy/Notification Type-----></option>
		<option value="State">State</option>
		<option value="Central">Central</option>
		<option value="Concurrent">Concurrent</option>
		</select>
		<div class="error act_type"></div>
		</div>
		</div>
	
	
		
	</div>

	

<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Name of Act/Policy/Notification (In English)<?php //echo $form->labelEx($model,'Act Name (In English)'); ?><span class="required" aria-required="true">*</span></label>
			<div class="col-md-4">
			<input type="text" name="act_name_english"  id="act_name_english" class="form-control"  size="60" maxlength="255">
		<div class="error act_name_english"></div>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Name of Act/Policy/Notification (In Hindi)<?php // echo $form->labelEx($model,'Act Name(In Hindi)'); ?></label>
			<div class="col-md-4">
			<input type="text" name="act_name_hindi" class="form-control"  size="60" maxlength="255">
                   <div class="error act_name_hindi"></div>
	</div>
	</div>
	</div>
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_internal_english" >Act/Policy/Notification  Upload (English)<?php //echo $form->labelEx($model,'Act Upload (English)'); ?><!--<span class="required" aria-required="true">*</span>--></label>
			<div class="col-md-4">
                            <input type="file" name="act_path_internal_english" id="act_path_internal_english" class="form-control"  >
		<div class="error act_path_internal_english" ></div>
	</div>
	</div>
	</div>
	
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Act/Policy/Notification Upload (Hindi)<?php //echo $form->labelEx($model,'Act Upload (Hindi)'); ?></label>
			<div class="col-md-4">
		
                            <input type="file" name="act_path_internal_hindi" class="form-control">
		<div class="error act_path_internal_hindi"></div>
	</div>
	</div>
	</div>
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_external_english" >External Path of Act/Policy/Notification(English)<?php // echo $form->labelEx($model,'Act External Path (English)'); ?><span class="required" aria-required="true"></span></label>
			<div class="col-md-4">
			<input type="text" name="act_path_external_english" class="form-control" id="act_path_external_english"  size="60" maxlength="255">
		<div class="error act_path_external_english"></div>
	</div>
	</div>
	</div>

<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_external_hindi" >External Path of Act/Policy/Notification (Hindi)<?php //echo $form->labelEx($model,'Act External Path (Hindi)'); ?></label>
			<div class="col-md-4">
			<input type="text" name="act_path_external_hindi" class="form-control"  size="60" maxlength="255">
		<div class="error act_path_external_hindi"></div>
	</div>
	</div>
	</div>
 <div class="row" id="centralRFO1" style="display:none;" >
	<div class="form-group col-md-12" >
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Centre Govt Rule (English)<?php //echo $form->labelEx($model,'Centre Govt Rule (English)'); ?><!--<span class="required" aria-required="true">*</span>--></label>
			<div class="col-md-4" >
			<textarea name="if_central_english" class="form-control" id="if_central_english" size="60" maxlength="255"></textarea>
			<div class="error if_central_english"></div>
	</div>
	</div>
	</div>

	<div class="row" id="centralRFO2" style="display:none;" >
	<div class="form-group col-md-12">
		<label class="col-lg-4 col-sm-4 control-label" for="if_central_hindi" >Centre Govt Rule (Hindi)<?php //echo $form->labelEx($model,'Centre Govt Rule (Hindi)'); ?></label>
			<div class="col-md-4">
			<textarea name="if_central_hindi" class="form-control"  size="60" maxlength="255"></textarea>
		<div class="error if_central_hindi"></div>
	</div>
	</div>
	</div>

	
	
	<div class="row" id="stateRFO1" style="display:none;">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State Govt Rule (English)<?php //echo $form->labelEx($model,'State Govt Rule(English)'); ?><span class="required" aria-required="true"></span></label>
			<div class="col-md-4">
			<textarea type="text" name="if_state_english" class="form-control" id="if_state_english" size="60" maxlength="255"></textarea>
		<div class="error if_state_english"></div>
	</div>
	</div>
	</div>

	<div class="row" id="stateRFO2" style="display:none;">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State Govt Rule (Hindi)<?php //echo $form->labelEx($model,'State Govt Rule (Hindi)'); ?></label>
			<div class="col-md-4">
			<textarea type="text" name="if_state_hindi" class="form-control"  size="60" maxlength="255"></textarea>
		<div class="error if_state_hindi"></div>
	</div>
	</div>
	</div>


	<div class="row" id="staterel" style="display:none;">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Relevent Department (State)
			<span class="required" aria-required="true"></span></label>
			<div class="col-md-4">
			<select name="relevent_departments_state[]" id="relevent_departments_state" class="form-control" multiple="multiple"  >
<?php  $sql = "SELECT issuerby_id,name FROM bo_infowizard_issuerby_master WHERE issuer_id='2' and is_issuerby_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllState = $command->queryAll();
if (isset($AllState)) {
foreach ($AllState as $v) {
echo "<option value='$v[issuerby_id]'>$v[name]</option>";
}
}
?>
</select>
        <p>( You can select multiple option by pressing CTRL  ) </p>
		<div class="error relevent_departments_state"></div>
	</div>
	</div>
	</div>
	
	<div class="row" id="centralrel" style="display:none;">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Relevent Department (Central)<?php //echo $form->labelEx($model,'Relevent Department (Central)'); ?><!--<span class="required" aria-required="true">*</span>--></label>
			<div class="col-md-4">
		<select name="relevent_departments_central[]" id="relevent_departments_central" class="form-control" multiple="multiple"  >
<?php  $sql = "SELECT issuerby_id,name FROM bo_infowizard_issuerby_master WHERE issuer_id='1' and is_issuerby_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllCentral = $command->queryAll();
if (isset($AllCentral)) {
foreach ($AllCentral as $v) {
echo "<option value='$v[issuerby_id]'>$v[name]</option>";
}
}
?>
</select>
        <p>( You can select multiple option by pressing CTRL  ) </p>
		<div class="error relevent_departments_central"></div>
	</div>
	</div>
	</div>


	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Publish<?php //echo $form->labelEx($model,'Is Active'); ?></label>
			<div class="col-md-4">
		 <select name="is_active" id="is_active" class="form-control"   >
		<option value="Y">Yes</option>
		<option value="N">No</option>
		</select>
		<div class="error is_active"></div>
	</div>
	</div>
	</div>
	
 <div class="row buttons" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div>          
             
	
</form>

</div>
		</div>
		</div>
		
					
					<script>
					
//act_type act_name_english act_path_internal_english act_path_external_english if_central_english if_state_english relevent_departments_state relevent_departments_central
function validateForm()
    { 
	var flag=0;
    
	   var act_type=$("#act_type").val();
		if(act_type==""){$(".act_type").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		 var act_name_english=$("#act_name_english").val();
		if(act_name_english==""){$(".act_name_english").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
	/* var act_path_internal_english=$("#act_path_internal_english").val();
		if(act_path_internal_english==""){$(".act_path_internal_english").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		
		
	if(act_type=='State'){   
		var if_state_english=$("#if_state_english").val();
		if(if_state_english==""){$(".if_state_english").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		var relevent_departments_state=$("#relevent_departments_state").val();
		if(relevent_departments_state==null || relevent_departments_state==NULL){$(".relevent_departments_state").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		              }   
		
		if(act_type=='Central'){
		var if_central_english=$("#if_central_english").val();
		if(if_central_english==""){$(".if_central_english").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		var relevent_departments_central=$("#relevent_departments_central").val();
		if(relevent_departments_central==null || relevent_departments_central==NULL){$(".relevent_departments_central").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		                   }
						   
		if(act_type=='Concurrent'){
		
		var relevent_departments_state=$("#relevent_departments_state").val();
		if(relevent_departments_state==null || relevent_departments_state==NULL){$(".relevent_departments_state").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		var if_central_english=$("#if_central_english").val();
		if(if_central_english==""){$(".if_central_english").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		
		var relevent_departments_central=$("#relevent_departments_central").val();
		if(relevent_departments_central==null || relevent_departments_central==NULL){$(".relevent_departments_central").html("Field Should not be blank");
		if(flag==0){flag=1; }
		}
		                  }*/
						   
		
	if(flag==1){return false;}else{return true;}
	
	
 }
 
					
					
	function change(){     
   if(document.getElementById('act_type').value =='State') 
	 { //state
	document.getElementById('centralRFO1').style.display='none';
	document.getElementById('centralRFO2').style.display='none';
	document.getElementById('stateRFO1').style.display='block';
	document.getElementById('stateRFO2').style.display='block';
    document.getElementById('staterel').style.display='block';
	document.getElementById('centralrel').style.display='none';
	}
	 else if(document.getElementById('act_type').value =='Central' || document.getElementById('act_type').value =='Concurrent') 
	 { //central
	document.getElementById('centralRFO1').style.display='block';
	document.getElementById('centralRFO2').style.display='block';
	document.getElementById('stateRFO1').style.display='block';
	document.getElementById('stateRFO2').style.display='block';
	document.getElementById('staterel').style.display='block';
	document.getElementById('centralrel').style.display='block';
    }
}
					</script>