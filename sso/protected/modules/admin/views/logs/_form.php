<?php
/* @var $this LogsController */
/* @var $model Logs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'logs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event'); ?>
		<?php echo $form->textField($model,'event',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'event'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accessed_from_url'); ?>
		<?php echo $form->textField($model,'accessed_from_url',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'accessed_from_url'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'accessed_from_ip'); ?>
		<?php echo $form->textField($model,'accessed_from_ip',array('size'=>60,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'accessed_from_ip'); ?>
	</div>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'accessed_on'); ?>
		<?php echo $form->textField($model,'accessed_on'); ?>
		<?php echo $form->error($model,'accessed_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->