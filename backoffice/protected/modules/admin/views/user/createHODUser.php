<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'submit_form',
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
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'full_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>60,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'full_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'email'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'mobile'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'mobile',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'mobile'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'password'); ?></label>
			<div class="col-md-8">
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'dept_id'); ?></label>
			<div class="col-md-8">
			<select name="User[dept_id]" class="form-control">
				<option value="">--Please Select--</option>
				<?php
					$sql="SELECT * FROM bo_departments 
							WHERE dept_id NOT IN (SELECT dept_id FROM bo_user usr INNER JOIN bo_user_role_mapping rm ON usr.uid=rm.user_id WHERE rm.role_id=62 and usr.is_active=1) and is_department_active=1 and dept_id not in('10','18')";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql);
					$department=$command->queryAll();
					foreach ($department as $key => $deptt)
						echo "<option value='".$deptt['dept_id']."'>".$deptt['department_name']."</option>";
				?>
			</select>
			<?php echo $form->error($model,'dept_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'is_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_active',array('1'=>'Y','0'=>'N'),array('class'=>'form-control')); ?>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>






<script type="text/javascript">
	$( document ).ready(function() {
		var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
   	    getAllDeptAPI(url,'#User_dept_id');
});
</script>