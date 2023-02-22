<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
?>

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-form',
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
			<label class="col-lg-4 col-sm-4 control-label" for="role_name" ><?php echo $form->labelEx($model,'role_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'role_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'role_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="rele_desc" ><?php echo $form->labelEx($model,'rele_desc'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textArea($model,'rele_desc',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'rele_desc'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_role_active" ><?php echo $form->labelEx($model,'is_role_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_role_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_role_active'); ?>
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