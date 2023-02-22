<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $model InfowizardQuesansMapping */
/* @var $form CActiveForm */
?>

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i><?php if($action == 'edit'){ echo "hi";} ?>Create Question and Answer</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'infowizard-quesans-mapping-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);  print_r($departmentdata);  ?>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Select Department'); ?></label>
			<div class="col-md-8">
			
        <?php echo $form->dropDownList($model,'department_id',CHtml::listData($deptdata,'department_id','name'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
		<?php //echo $form->textField($model,'department_id'); ?>
		<?php echo $form->error($model,'department_id'); ?>
	       </div>
	</div></div>       

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Select Department Wise Services'); ?></label>
			<div class="col-md-8">
			
        <?php echo $form->dropDownList($model,'deptservice_id',CHtml::listData($deptservdata,'deptservice_id','name'),array('class'=>'form-control','autocomplete' => 'off')); ?>
		<?php echo $form->error($model,'deptservice_id'); ?>
	</div></div></div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Select Question'); ?></label>
			<div class="col-md-8">
			
        <?php echo $form->dropDownList($model,'question_id',CHtml::listData($questiondata,'question_id','name'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'question_id'); ?>
	</div></div></div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Select Answer Category'); ?></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'anscat_id',CHtml::listData($anscatdata,'anscat_id','name'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'anscat_id'); ?>
	</div></div></div>
			
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Type Answer'); ?></label>
			<div class="col-md-8">
		<?php echo $form->textField($model,'answer_detail',array('size'=>60,'maxlength'=>500,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'answer_detail'); ?>
	</div></div></div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Type Answer'); ?></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'is_quesans_active',array('Y'=>'Y','N'=>'N'),array('size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_quesans_active'); ?>
	</div></div></div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Select Priority'); ?></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'priority',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),array('size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required'));  ?>
		<?php echo $form->error($model,'priority'); ?>
	</div></div></div>

	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div></div></div><!-- form -->