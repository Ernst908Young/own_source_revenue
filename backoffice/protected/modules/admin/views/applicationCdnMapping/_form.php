<?php
/* @var $this ApplicationCdnMappingController */
/* @var $model ApplicationCdnMapping */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'application-cdn-mapping-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'application_id'); ?>
			<?php $status='Y';echo $form->DropDownList($model,'application_id',CHtml::listData(Applications::model()->findAll(array(
	                                 'select'=>'application_id, application_name',
	                                 'condition'=>'is_application_active=:status',
	                                 'params'=>array(':status'=>$status),
	                               )),'application_id','application_name'),
	    					array('class'=>'form-control','prompt'=>'Select Application', 'require'=>true));?>
			<?php echo $form->error($model,'application_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'doc_id'); ?>
			<?php $status='Y';echo $form->DropDownList($model,'doc_id',CHtml::listData(CdnMaster::model()->findAll(array(
	                                 'select'=>'doc_id, doc_name',
	                                 'condition'=>'is_doc_active=:status',
	                                 'params'=>array(':status'=>$status),
	                               )),'doc_id','doc_name'),
	    					array('class'=>'form-control','required'=>true,'multiple'=>true));?>
			<?php echo $form->error($model,'doc_id'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">

			<?php echo $form->labelEx($model,'is_mapping_active'); ?>
			<?php echo $form->dropDownList($model,'is_mapping_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control'))?>
			<?php echo $form->error($model,'is_mapping_active'); ?>
		</div>
	</div>

	<div class="row buttons">
		<div class='row'>&nbsp;</div>
		<div class="col-md-2">

			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('class'=>'form-control btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>