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
	<label  class="col-lg-6 col-sm-6 control-label" >Service Parameter Id:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Name</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
        echo $model->service_id;?> 
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
	<label class="col-lg-6 col-sm-6 control-label" >Online?</label></div>
	<div class="col-md-6">
	<?php echo $model->is_online ;?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Integrated With SWCS ?</label></div>
	<div class="col-md-6">
	<?php echo $model->is_integrated_with_swcs ;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >In Uttarakhand Right to Services Act ?</label></div>
	<div class="col-md-6">
	<?php echo $model->is_in_uttarakhand_right_to_service_act  ;?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >In Uttarakhand Single Window Act ?</label></div>
	<div class="col-md-6">
	<?php echo $model->is_in_uttarakhand_right_to_service_act ;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Statutory Forms Available</label></div>
	<div class="col-md-6">
	<?php echo $model->is_statutory_forms_available; ?>
	</div>
	</div>
</div>	
    
    <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Statutory Form No</label></div>
	<div class="col-md-6">
	<?php echo $model->statutory_form_no ; ?>
	</div>
	</div>
</div>
        <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Statutory Forms Upload</label></div>
	<div class="col-md-6">
	<?php echo $model->statutory_form_upload  ; ?>
	</div>
	</div>
</div>
    
          <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Statutory Forms Upload</label></div>
	<div class="col-md-6">
	<?php echo $model->statutory_form_upload  ; ?>
	</div>
	</div>
</div>
    

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Statutory Forms Creation:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->statutory_forms_creation  ; ?>
	</div>
	</div>
</div>

    
    <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Document CheckList:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->document_checkList   ; ?>
	</div>
	</div>
</div>
    
        <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Document Checklist Upload:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->document_checklist_upload    ; ?>
	</div>
	</div>
</div>
    
         <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Document Checklist Creation:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->document_checklist_creation ; ?>
	</div>
	</div>
</div>
    
    
    


</div></div></div></div>