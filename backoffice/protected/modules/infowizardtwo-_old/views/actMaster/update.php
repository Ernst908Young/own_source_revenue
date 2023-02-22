<style>
    .error{color:red;}    
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        Update Act </div>
    <div class="text-right">
       <a href="<?=$this->createUrl('/infowizard/actMaster/index')?>" class="btn btn-info" style="margin-top:3px;"><i class="fa fa-arrow-left"></i>View List Act</a>
	</div>	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php //echo $form->errorSummary($model); ?>
<form name="form" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="type">Select Type<?php echo $model['type']; ?></label>  
			<div class="col-md-4">
		<select name="type" id="type" class="form-control" onchange="window.location='/backoffice/infowizard/actMaster/update/id/<?php echo $_GET['id'];?>/type/'+this.value" >
			<option value=""><-----Please Select Type-----></option>
			<option value="Act" <?php if($_GET['type']=='Act'){ echo "selected"; }?> >Act</option>
			<option value="Policy" <?php if($_GET['type']=='Policy') { echo "selected"; } ?> >Policy</option>
			<option value="Notification" <?php if($_GET['type']=='Notification') { echo "selected"; } ?> >Notification</option>
		</select>
		<div class="error type"></div>
		</div>
		</div>
	
	
		
	</div>
	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_type">Act/Policy/Notification Type<?php echo $model['act_type']; ?></label>  
			<div class="col-md-4">
     <select name="act_type" id="act_type" class="form-control"  onchange="change()" >
		<option value=""><-----Please Select Type Of Act/Policy/Notification-----></option>
		<option value="State" <?php if($model['act_type']=='State'){ echo "selected"; }?> >State</option>
		<option value="Central" <?php if($model['act_type']=='Central') { echo "selected"; } ?> >Central</option>
		<option value="Concurrent" <?php if($model['act_type']=='Concurrent'){ echo "selected"; } ?> >Concurrent</option>
		</select>
		<div class="error act_type"></div>
		</div>
		</div>
	
	
		
	</div>

	

<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Name of Act/Policy/Notification (In English)<?php //echo $form->labelEx($model,'Act Name (In English)'); ?><span class="required" aria-required="true">*</span></label>
			<div class="col-md-4">
			<input type="text" name="act_name_english"  id="act_name_english" value="<?php echo $model['act_name_english'];?>" class="form-control"  size="60" maxlength="255">
		<div class="error act_name_english"></div>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Name of Act/Policy/Notification (In Hindi)<?php // echo $form->labelEx($model,'Act Name(In Hindi)'); ?></label>
			<div class="col-md-4">
			<input type="text" name="act_name_hindi" value="<?php echo $model['act_name_hindi'];?>" class="form-control"  size="60" maxlength="255">
                   <div class="error act_name_hindi"></div>
	</div>
	</div>
	</div>
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_internal_english" >Act/Policy/Notification Upload (English)<?php //echo $form->labelEx($model,'Act Upload (English)'); ?></label>
			<div class="col-md-4">
      <input type="file" name="act_path_internal_english" id="act_path_internal_english" class="form-control" style="float:left" value="<?php //echo $model['act_path_internal_english'];?>">
	  <?php if (!empty($model['act_path_internal_english'])) { 
		echo CHtml::link('View Uploaded',$model['act_path_internal_english'], array('target'=>'_blank')); }  ?>
	  
		<div class="error act_path_internal_english" ></div>
	</div>
	</div>
	</div>
	
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Act/Policy/Notification Upload (Hindi)<?php //echo $form->labelEx($model,'Act Upload (Hindi)'); ?></label>
			<div class="col-md-4">
		
      <input type="file" name="act_path_internal_hindi" class="form-control" value="<?php //echo $model['act_path_internal_hindi'];?>">
	   <?php if (!empty( $model['act_path_internal_hindi'])) {  
		echo CHtml::link('View Uploaded',$model['act_path_internal_hindi'], array('target'=>'_blank')); }  ?>
		<div class="error act_path_internal_hindi"></div>
	</div>
	</div>
	</div>
<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_external_english" >External Path of Act/Policy/Notification(English)<?php // echo $form->labelEx($model,'Act External Path (English)'); ?></label>
			<div class="col-md-4">
<input type="text" name="act_path_external_english" class="form-control" id="act_path_external_english" value="<?php 
echo $model['act_path_external_english'];?>" size="60" maxlength="255">
		<div class="error act_path_external_english"></div>
	</div>
	</div>
	</div>

<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="act_path_external_hindi" >External Path of Act/Policy/Notification(Hindi)<?php //echo $form->labelEx($model,'Act External Path (Hindi)'); ?></label>
			<div class="col-md-4">
			<input type="text" name="act_path_external_hindi" class="form-control" value="<?php echo $model['act_path_external_hindi'];?>" size="60" maxlength="255">
		<div class="error act_path_external_hindi"></div>
	</div>
	</div>
	</div>
	
 <div class="row central"  id="centralRFO1" >
	<div class="form-group col-md-12" >
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Centre Govt Rule (English)<?php //echo $form->labelEx($model,'Centre Govt Rule (English)'); ?></label>
			<div class="col-md-4" >
			<textarea name="if_central_english" class="form-control" id="if_central_english" size="60" value="<?php echo $model['if_central_english'];?>" maxlength="255"></textarea>
			<div class="error if_central_english"></div>
	</div>
	</div>
	</div>

	<div class="row central" id="centralRFO2"  >
	<div class="form-group col-md-12">
		<label class="col-lg-4 col-sm-4 control-label" for="if_central_hindi" >Centre Govt Rule (Hindi)<?php //echo $form->labelEx($model,'Centre Govt Rule (Hindi)'); ?></label>
			<div class="col-md-4">
			<textarea name="if_central_hindi" class="form-control" value="<?php echo $model['if_central_hindi'];?>" size="60" maxlength="255"></textarea>
		<div class="error if_central_hindi"></div>
	</div>
	</div>
	</div>

	
	<div class="row state" id="stateRFO1" >
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State Govt Rule (English)<?php //echo $form->labelEx($model,'State Govt Rule(English)'); ?></label>
			<div class="col-md-4">
			<textarea type="text" name="if_state_english" class="form-control" id="if_state_english" size="60" maxlength="255" value="<?php echo $model['if_state_english'];?>" ></textarea>
		<div class="error if_state_english"></div>
	</div>
	</div>
	</div>

	<div class="row state" id="stateRFO2" >
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State Govt Rule (Hindi)<?php //echo $form->labelEx($model,'State Govt Rule (Hindi)'); ?></label>
			<div class="col-md-4">
			<textarea type="text" name="if_state_hindi" value="<?php echo $model['if_state_hindi'];?>" class="form-control"  size="60" maxlength="255"></textarea>
		<div class="error if_state_hindi"></div>
	</div>
	</div>
	</div>


	<div class="row state" id="staterel" >
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Relevent Department (State)
	</label>
			<div class="col-md-4">
			<?php $options=explode(',',$model['relevent_departments_state']); ?>
			<select name="relevent_departments_state[]" id="relevent_departments_state" class="form-control" multiple="multiple"  >
<?php  $sql = "SELECT issuerby_id,name FROM bo_infowizard_issuerby_master WHERE issuer_id='2' and is_issuerby_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllState = $command->queryAll();
if (isset($AllState)) {
foreach ($AllState as $v) {
?>
<option value="<?php echo $v['issuerby_id'];?>"  <?php if(in_array($v['issuerby_id'],$options)){ echo "selected";} ?>> <?php echo $v['name']; ?></option>
<?php
}
}
?>
</select>
        <p>( You can select multiple option by pressing CTRL  ) </p>
		<div class="error relevent_departments_state"></div>
	</div>
	</div>
	</div>
	
	<div class="row central" id="centralrel" >
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Relevent Department (Central)<?php //echo $form->labelEx($model,'Relevent Department (Central)'); ?></label>
			<div class="col-md-4">
			<?php $value=explode(',',$model['relevent_departments_central']); ?>
		<select name="relevent_departments_central[]" id="relevent_departments_central" class="form-control" multiple="multiple"  >
<?php  $sql = "SELECT issuerby_id,name FROM bo_infowizard_issuerby_master WHERE issuer_id='1' and is_issuerby_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllCentral = $command->queryAll();
if (isset($AllCentral)) {
foreach ($AllCentral as $vb) {
?>
<option value="<?php echo $vb['issuerby_id'];?>"  <?php if(in_array($vb['issuerby_id'],$value)){ echo "selected";} ?>> <?php echo $vb['name']; ?></option>
<?php
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
	
	<div class="row">
		<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="set_priority">Set Priority</label>  
			<div class="col-md-4">
				<?php 
					$type = $_GET['type'];
					$sql = "SELECT count(*) as total FROM bo_information_wizard_act_master WHERE type='$type' and is_active='Y'";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$priorityArr = $command->queryAll();
					/* echo "<pre>";
					print_r($priorityArr[0]['total']);die(); */
					$sql = "SELECT priority FROM bo_information_wizard_act_master WHERE priority<1000 and type='$type' and is_active='Y'";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$priority = $command->queryAll();
					$pArr = array();
					foreach($priority as $kp=>$vp){
						$pArr[$kp] =$vp['priority'];
					}
					/* echo "<pre>";
					print_r($pArr);die(); */
				?>
				<select name="set_priority" id="set_priority" class="form-control">
					<option value=""><-----Please Select Priority-----></option>
				<?php
					if(isset($priorityArr)) 
					{
						for($i=1;$i<=$priorityArr[0]['total'];$i++)
						{							
							if(!in_array($i,$pArr))
							{
				?>	
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php   	
							}	
						}
					}
				?>
				</select>
				<div class="error type"></div>
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
<script type="text/javascript">
	//var type = "<?php echo $_GET['type'];?>";
					
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
		
		 var act_path_external_english=$("#act_path_external_english").val();
		if(act_path_external_english==""){$(".act_path_external_english").html("Field Should not be blank");
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
<style>
.state{display:none;}
.central{display:none;}
<?php if($model['act_type']=="State"){ ?>
.state{display:block;}
<?php } ?>
<?php if($model['act_type']=="Central" || $model['act_type']=="Concurrent"){ ?>
.state{display:block;}
.central{display:block;}
<?php } ?>
</style>