	
	<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Acts/Rules/Notifications/Policies/Schemes/Guidelines</div>
 <div class="pull-right">
	<a class="btn btn-primary" tabindex="0" style="margin-top:3px;" href="<?=$this->createUrl('/infowizard/actMaster/index/')?>"><span>Back</span></a>
		</div>
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label  class="col-lg-6 col-sm-6 control-label" >Act Master Id</label></div>
	<div class="col-md-7">
	<?php echo $model->id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act Type</label></div>
	<div class="col-md-7">
	<?php echo $model->act_type; ?> 
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act Name (In English)</label></div>
	<div class="col-md-7">
	<?php echo $model->act_name_english; ?> 
	</div>
	</div>
</div>
    
    <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act Name (In Hindi)</label></div>
	<div class="col-md-7">
	<?php  echo $model->act_name_hindi; ?>
	</div>
	</div>
</div>
    
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act Upload (English)</label></div>
	<div class="col-md-7">
	<?php if (!empty( $model->act_path_internal_english)) {  
		echo CHtml::link('View Uploaded',$model['act_path_internal_english'], array('target'=>'_blank')); } ?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act Upload (Hindi)</label></div>
	<div class="col-md-7">
	<?php if (!empty($model->act_path_internal_hindi)) {  
		echo CHtml::link('View Uploaded',$model['act_path_internal_hindi'], array('target'=>'_blank')); }?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act External Path (English)</label></div>
	<div class="col-md-7">
	<?php echo $model->act_path_external_english ;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Act External Path (Hindi)</label></div>
	<div class="col-md-7">
	<?php echo $model->act_path_external_hindi ; ?>
	</div>
	</div>
</div>

<div class="row state">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >State Govt Rule (English)</label></div>
	<div class="col-md-7">
	<?php echo $model->if_state_english ; ?>
	</div>
	</div>
</div>	
<div class="row state">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >State Govt Rule (Hindi)</label></div>
	<div class="col-md-7">
	<?php echo $model->if_state_hindi ; ?>
	</div>
	</div>
</div>		

		
<div class="row central">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Centre Govt Rule (English)</label></div>
	<div class="col-md-7">
	<?php echo $model->if_central_english ; ?>
	</div>
	</div>
</div>	

<div class="row central">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Centre Govt Rule (Hindi)</label></div>
	<div class="col-md-7">
	<?php echo $model->if_central_hindi ; ?>  
	</div>
	</div>
</div>	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Relevent Department (State)</label></div>
	<div class="col-md-7">
	<?php  $options=explode(',',$model->relevent_departments_state); $aa=count($options); for($i=0; $i<$aa ;$i++) {
	 $ss=InfowizardQuestionMasterExt::getViewIssuerBy($options[$i]); echo $ss['name']; if($i!=($aa-1)) echo " ,"; }?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Relevent Department (Central)</label></div>
	<div class="col-md-7">
	<?php $value=explode(',',$model->relevent_departments_central);  $aaa=count($value); for($j=0; $j<$aaa ;$j++) {
	$ss1=InfowizardQuestionMasterExt::getViewIssuerBy($value[$j]); echo $ss1['name']; if($j!=($aaa-1)) echo " ,"; }?>
	</div>
	</div>
</div>


<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-5">
	<label class="col-lg-6 col-sm-6 control-label" >Created</label></div>
	<div class="col-md-7">
	<?php echo $model->created; ?>
	</div>
	</div>
</div>
 <div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/actMaster/index/')?>"><span>View list of Acts/Rules/Notifications/Policies/Schemes/Guidelines</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/actMaster/create/')?>"><span>Add New Acts/Rules/Notifications/Policies/Schemes/Guidelines</span></a>
    </div>

</div></div></div></div>
        
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