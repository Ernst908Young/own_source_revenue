<?php
/* @var $this DepartmentsController */
/* @var $model Departments */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'departments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_name" ><?php echo $form->labelEx($model,'department_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'department_name',array('size'=>60,'maxlength'=>512,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_name'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_unique_code" ><?php echo $form->labelEx($model,'department_unique_code'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'department_unique_code',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_unique_code'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_link" ><?php echo $form->labelEx($model,'department_link'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'department_link',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_link'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_img" ><?php echo $form->labelEx($model,'department_img'); ?></label>
			<div class="col-md-8">
			<?php echo $form->fileField($model,'department_img',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'department_img'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_department_active"><?php echo $form->labelEx($model,'is_department_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_department_active',array('1'=>'Y','0'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_department_active'); ?>
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