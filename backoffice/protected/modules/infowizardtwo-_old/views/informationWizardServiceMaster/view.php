<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Service Master Detail</div>
 
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label  class="col-lg-6 col-sm-6 control-label" >Service Master Id:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Incidence</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
        if($model->incidence_pre_establishment=="1") {echo "Pre Establishment   ";  } 
        if($model->incidence_pre_operation=="1") {echo "Pre Operation     ";  }
        if($model->incidence_post_operation=="1") {echo "Post Operation     ";  }?> 
	</div>
	</div>
</div>
    
    <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Sector</label></div>
	<div class="col-md-6">
	<?php echo $model->service_sector;?>
	</div>
	</div>
</div>
    
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Type</label></div>
	<div class="col-md-6">
	<?php echo $model->service_type;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Additional Sub Service</label></div>
	<div class="col-md-6">
	<?php echo $model->additional_sub_service  ;?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Periodic Inspection</label></div>
	<div class="col-md-6">
	<?php echo $model->periodic_inspection ;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Checklist Periodic Inspection</label></div>
	<div class="col-md-6">
	<?php echo $model->checklist_periodic_inspection ; ?>
	</div>
	</div>
</div>	

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Created:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->created; ?>
	</div>
	</div>
</div>


</div></div></div></div>