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
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Issued By </div>
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


	<?php //echo $form->errorSummary($model); ?>
	
	<div class="row">		
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'Select Issuer'); ?><span class="required" aria-required="true">*</span></label>				
			<div class="col-md-6">
			<?php echo $form->dropDownList($model,'issuer_id',CHtml::listData($Issuerdata,'issuer_id','name'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
			<?php echo $form->error($model,'issuer_id'); ?>
			</div>
		</div>	
	</div>
	

	<div class="row">		
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'Enter Issued By '); ?><span class="required" aria-required="true">*</span></label>			
			<div class="col-md-6">
			<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>50,'maxlength'=>500,'autocomplete' => 'off','required'=>'required')); ?>
			<?php echo $form->error($model,'name'); ?>
			</div>
		</div>
	</div>
	
	
	<div class="row">	
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'Enter Abbreviations'); ?><span class="required" aria-required="true">*</span></label>			
			<div class="col-md-6">
			<?php echo $form->textField($model,'abb',array('class'=>'form-control','size'=>50,'maxlength'=>100,'autocomplete' => 'off','required'=>'required')); ?>
			<?php echo $form->error($model,'abb'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="left_department_logo" >
				<?php echo $form->labelEx($model,'Left Side Logo of Department'); ?><span class="required" aria-required="true">*</span>
				</label>			
			<div class="col-md-6">
				<?php echo $form->fileField($model,'left_department_logo',array('class'=>'form-control','autocomplete' => 'off'));  ?>
				<?php 
				
				if(isset($_GET['id']) && !empty($_GET['id']))
				{
					echo CHtml::image(@$model->left_department_logo);
				}
				?>
				<?php echo $form->error($model,'left_department_logo'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="left_department_logo" >
				<?php echo $form->labelEx($model,'Middle Logo of Department'); ?><span class="required" aria-required="true">*</span>
				</label>			
			<div class="col-md-6">
				<?php echo $form->fileField($model,'middle_department_logo',array('class'=>'form-control','autocomplete' => 'off'));  ?>
				<?php 
				
				if(isset($_GET['id']) && !empty($_GET['id']))
				{
					echo CHtml::image(@$model->middle_department_logo);
				}
				?>
				<?php echo $form->error($model,'middle_department_logo'); ?>
			</div>
		</div>
	</div>
	<div class="row">		
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="right_department_logo" >
			<?php echo $form->labelEx($model,'Right Side Logo of Department'); ?><span class="required" aria-required="true">*</span>
			</label>
			
			<div class="col-md-6">
			<?php echo $form->fileField($model,'right_department_logo',array('class'=>'form-control','autocomplete' => 'off'));  ?>
			<?php 
			if(isset($_GET['id']) && !empty($_GET['id']))
			{
				echo CHtml::image(@$model->right_department_logo);
			}
			?>
			<?php echo $form->error($model,'right_department_logo'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
				<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_active ?'); ?><span class="required" aria-required="true">*</span></label>			
			<div class="col-md-6">
				<?php echo $form->dropDownList($model,'is_issuerby_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
				<?php echo $form->error($model,'is_issuerby_active'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row buttons" align="center">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
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






