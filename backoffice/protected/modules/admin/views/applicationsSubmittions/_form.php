<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $model ApplicationsSubmittions */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applications-submittions-form',
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
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'application_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'application_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'application_id'); ?>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'user_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'user_id'); ?>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'field_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'field_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'field_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'field_value'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'field_value',array('size'=>60,'maxlength'=>512,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'field_value'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'application_status'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'application_status',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control'))?>
			<?php echo $form->error($model,'application_status'); ?>
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
</div>