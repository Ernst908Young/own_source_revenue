<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        Update Professional [<?php echo $model->profession_name;?>] </div>
    <div class="text-right">
        <a href="/backoffice/infowizard/professionalMaster/" class="btn btn-info" style="margin-top:3px;"><i class="fa fa-arrow-left"></i> Go To All Professional</a>
	</div>	
</div><?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $model BoInformationWizardArchitectStructuralEngineerMaster */
/* @var $form CActiveForm */
$ListOfProfessionalBody=ProfessionalMasterController::getAllBodyOfIssuer(3);
 foreach($ListOfProfessionalBody as $key=>$val){
              $proBody=$val['abb']." : ".$val['name'];
              $isuuerbyid=$val['issuerby_id'];
              $professionalBody[$isuuerbyid] =$proBody;
        }

//print_r($professionalBody);die;?>

<style>
    .errorSummary{color:red;}    
</style>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-information-wizard-architect-structural-engineer-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="profession_name"><?php echo $form->labelEx($model,'profession_name'); ?></label>
			<div class="col-md-8">
		
		<?php echo $form->textField($model,'profession_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'profession_name'); ?>
	</div>
	</div>
	</div>
<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="profession_body">   <?php echo $form->labelEx($model, 'profession_body'); ?></label>
			<div class="col-md-8">		
              
   <?php echo $form->dropDownList($model,'profession_body',$professionalBody,array('class'=>'form-control','autocomplete' => 'off','required'=>'required','class'=>'form-control')); ?>
	<?php echo $form->error($model, 'profession_body'); ?>
	</div>
	</div>
	</div>

<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="profession_body">   <?php echo $form->labelEx($model, 'is_active'); ?></label>
			<div class="col-md-8">		
              
		<?php echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ></label>
			<div class="col-md-8">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>"btn btn-success")); ?>
	</div>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
