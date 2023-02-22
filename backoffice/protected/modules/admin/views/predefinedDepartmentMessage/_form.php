<?php
/* @var $this PredefinedDepartmentMessageController */
/* @var $model PredefinedDepartmentMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'predefined-department-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="access_name" ><?php echo $form->labelEx($model,'message'); ?></label>
			<div class="col-md-8">
				<?php echo $form->textArea($model,'message',array('size'=>60,'maxlength'=>254,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'message'); ?>
			</div>
		</div>
	</div>
	<div class="row">
			<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="access_name" ><?php echo $form->labelEx($model,'is_active'); ?></label>
				<div class="col-md-8">
		<?php echo $form->dropDownList($model,'is_active',array('Y'=>"Yes",'N'=>"No"),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'is_active'); ?>
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