<?php
/* @var $this RoleAccessMappingController */
/* @var $model RoleAccessMapping */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'role-access-mapping-form',
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
			<label class="col-lg-4 col-sm-4 control-label" for="role_id" ><?php echo $form->labelEx($model,'role_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'role_id',array('size'=>10,'maxlength'=>10),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'role_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="access_id" ><?php echo $form->labelEx($model,'access_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'access_id',CHtml::listData(RoleAccess::model()->findAll(array('select'=>'access_id,access_name','condition'=>'is_active=:active','params'=>array(':active'=>'Y'))), 'access_id', 'access_name'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'access_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'is_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_active'); ?>
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
<script type="text/javascript">
	$( document ).ready(function() {
		var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
   	    url="<?php echo Yii::app()->createUrl('ajax/getallroles');?>";
   	    getAllRoles(url,'#RoleAccessMapping_role_id');
	});
	

</script>