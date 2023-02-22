<?php
/* @var $this DocunenttypeMasterController */
/* @var $model BoInfowizardDocunenttypeMaster */
/* @var $form CActiveForm */
?>
<style>
.errorSummary { clear:red }
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Document Type</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-docunenttype-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>
	
<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'Enter Document Type'); ?><span class="required">*</span></label>
			<div class="col-md-8">
		<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>60,'maxlength'=>200,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
		</div>
	</div>
	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'Enter Abbreviations'); ?><span class="required">*</span></label>
			<div class="col-md-8">
		<?php echo $form->textField($model,'abbr',array('class'=>'form-control','size'=>50,'maxlength'=>50,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'abbr'); ?>
		</div>
		</div>
	</div>
	
 <div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_active ?'); ?><span class="required">*</span></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'is_doc_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
		<?php echo $form->error($model,'is_doc_active'); ?>
	</div>
		</div>
	</div>
	
	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div></div></div></div><!-- form -->