<style>
.errorMessage { color:red}
</style>

<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Update Header Content</div>
    <div class='tools'>
	
	</div>
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-issuerby-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>	
	<div class="row">
		<div class="col-md-12">
			<div class="form-group col-md-4">
				<label class="col-lg-4 col-sm-4 control-label" for="header_content" ><?php echo $form->labelEx($model,'Header Content'); ?><span class="required" aria-required="true">*</span></label>
			</div>	
			<div class="col-md-8">
				<?php echo $form->textArea($model,'header_content',array('rows'=>20, 'cols'=>10,'value'=>$header_content)); ?>
				<?php echo $form->error($model,'header_content'); ?>
			</div>
		</div>
	</div>
	<br/><br/>		
	<div class="row">
		<div class="col-md-12">
			<div class="row buttons" align="center">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
				<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/IssuerbyMaster/index/')?>"><span>View list of Issued By</span></a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div></div></div></div>
<script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('BoInfowizardIssuerbyMaster_header_content');
</script>
<!-- form -->






