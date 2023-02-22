<?php
/* @var $this SpAllApplicationsController */
/* @var $model SpAllApplications */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sp-all-applications-form',
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
		<?php echo $form->labelEx($model,'sp_id'); ?>

	<select name="SpAllApplications[sp_id]" id="SpAllApplications_sp_id" class="form-control">
					<option value="">Please select the Service Provider</option>
					
	<?php
		$SpApps=SpApplicationsExt::getAllSSODept();
		if(!empty($SpApps)){
			foreach ($SpApps as $key => $SpApps) {
				?>
					<option value="<?=$SpApps['sp_id']?>"><?=$SpApps['service_provider_name']?></option>

				<?php
			}
		}
	?>
	</select>
		<?php echo $form->error($model,'sp_id'); ?>

	</div>
</div>
	<div class="row">
		<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'app_name'); ?>
		<?php echo $form->textField($model,'app_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'app_name'); ?>
	</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'department_name'); ?>
		<?php echo $form->textField($model,'department_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'department_name'); ?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'department_app_id'); ?>
		<?php echo $form->textField($model,'department_app_id',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'department_app_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'app_url'); ?>
		<?php echo $form->textField($model,'app_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'app_url'); ?>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'is_app_active'); ?>
		<?php echo $form->dropDownList($model,'is_app_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'is_app_active'); ?>
		</div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->