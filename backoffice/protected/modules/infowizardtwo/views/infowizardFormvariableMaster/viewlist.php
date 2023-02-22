<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Form Field </div>
 
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label  class="col-lg-6 col-sm-6 control-label" >Form Field ID:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->formchk_id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Form Field Name :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->name; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Created Date :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->created_date; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Is Active:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->is_formvar_active; ?>
	</div>
	</div>
</div>

	<div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardFormvariableMaster/listformfield/')?>"><span>View list of Form Field</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardFormvariableMaster/create/')?>"><span>Add New Form Field</span></a>
    </div>
	

</div></div></div></div>




