<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i><?php if($action == 'edit'){ echo "hi";} ?>List of User</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('autoComplete'=>'off'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'full_name'); ?></label>
			<div class="col-md-8">
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
		</div>
	</div>
	

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_question_active'); ?></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'is_question_active',array('1'=>'Y','0'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
		<?php echo $form->error($model,'is_question_active'); ?>
	</div>
		</div>
	</div>

	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div></div></div>
<!-- form -->