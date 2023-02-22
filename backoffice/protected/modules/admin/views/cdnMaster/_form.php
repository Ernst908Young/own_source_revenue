<?php
/* @var $this CdnMasterController */
/* @var $model CdnMaster */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cdn-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row ">
	    <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="doc_name" ><?php echo $form->labelEx($model,'doc_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'doc_name',array('size'=>60, 'class'=>'form-control','maxlength'=>255)); ?>
			<?php echo $form->error($model,'doc_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="doc_type" ><?php echo $form->labelEx($model,'doc_type'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'doc_type', array('image/jpeg'=>'jpg','doc'=>'doc','pdf'=>'pdf','other'=>'other'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'doc_type'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="doc_max_size" ><?php echo $form->labelEx($model,'doc_max_size'). " (in KB)"; ?></label>
			<div class="col-md-8">
			<?php echo $form->numberField($model,'doc_max_size',array('size'=>20,'class'=>'form-control','maxlength'=>20,'min'=>0)); ?>
			<?php echo $form->error($model,'doc_max_size'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="doc_min_size" ><?php echo $form->labelEx($model,'doc_min_size'). " (in KB)"; ?></label>
			<div class="col-md-8">
			<?php echo $form->numberField($model,'doc_min_size',array('size'=>20,'class'=>'form-control','maxlength'=>20,'min'=>0)); ?>
			<?php echo $form->error($model,'doc_min_size'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_name" ><?php echo $form->labelEx($model,'is_doc_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_doc_active',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_doc_active'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-gruop col-md-6">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<script type="text/javascript">
	$('#CdnMaster_doc_name').keyup(function(){
		var fname=$('#CdnMaster_doc_name').val();
		 fname = fname.replace(' ', '_');
		 fname = fname.replace('/[^A-Za-z\-]/', ''); 
		$('#CdnMaster_doc_name').val(fname);
	})
</script>