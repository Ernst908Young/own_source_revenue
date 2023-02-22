<?php
/* @var $this UserRoleMappingController */
/* @var $model UserRoleMapping */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-role-mapping-form',
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
			<label class="col-lg-4 col-sm-4 control-label" for="department_id" ><?php echo $form->labelEx($model,'department_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'department_id',array(''=>'Please Select Department'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="user_id" ><?php echo $form->labelEx($model,'user_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'user_id',array(''=>'Please Select User'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'user_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="v" ><?php echo $form->labelEx($model,'role_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'role_id',array(''=>'Please Select Role'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'role_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_mapping_active"><?php echo $form->labelEx($model,'is_mapping_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_mapping_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_mapping_active'); ?>
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
   	    getAllDeptAPI(url,'#UserRoleMapping_department_id');
   	    url="<?php echo Yii::app()->createUrl('ajax/getallroles');?>";
   	    getAllRoles(url,'#UserRoleMapping_role_id');
	});
	$('#UserRoleMapping_department_id').change(function(){
		var url ="<?php echo Yii::app()->createUrl('ajax/alldeptusers');?>";
		var dept_id = $('#UserRoleMapping_department_id').val();
		getAllDeptUsers(url,dept_id);
	})

</script>