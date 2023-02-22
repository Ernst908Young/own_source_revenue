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
			<label class="col-lg-4 col-sm-4 control-label" for="user_id" ><?php echo $form->labelEx($model,'user_id'); ?></label>
			<div class="col-md-8">
			<?php
				$criteria=new CDbCriteria;
				$criteria->condition="is_active=1 AND dept_id =18 AND t.uid NOT IN (select user_id from bo_user_role_module_mapping rlmp where rlmp.is_active='Y')";
				// $criteria->order="uid";
				$Users=User::model()->findAll($criteria);
				echo "<select class='form-control' name='UserRoleModuleMapping[user_id]'>
				<option value=''>Please Select</option>";
				foreach ($Users as $key => $user) {
					echo "
					<option value='".$user->uid."'>".$user->email."</option>";
					# code...
				}
				echo "</select>";
			?>

			<?php echo $form->error($model,'user_id'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="role_id" ><?php echo $form->labelEx($model,'role_id'); ?></label>
			<div class="col-md-8">
			<?php
				$criteria=new CDbCriteria;
				$criteria->condition="is_role_active='Y' AND is_external='Y'" ;
				$criteria->order="role_id DESC";
				$Roles=Roles::model()->findAll($criteria);
				echo "<select class='form-control' name='UserRoleModuleMapping[role_id]'>
				<option value=''>Please Select</option>";
				foreach ($Roles as $key => $role) {
					echo "
					<option value='".$role->role_id."'>".$role->role_name."</option>";
					# code...
				}
				echo "</select>";
			?>

			<?php echo $form->error($model,'role_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="role_id" ><?php echo $form->labelEx($model,'module_id'); ?></label>
			<div class="col-md-8">
			<?php
				$criteria=new CDbCriteria;
				$criteria->condition="is_active='Y'" ;
				// $criteria->order="role_id DESC";
				$modules=IncentiveModules::model()->findAll($criteria);
				echo "<select class='form-control' name='UserRoleModuleMapping[module_id][]' multiple='true'>
				<option value=''>Please Select</option>";

				foreach ($modules as $key => $module) {
					echo "
					<option value='".$module->module_id."'>".$module->module_name."</option>";
					# code...
				}
				echo "</select>";
			?>

			<?php echo $form->error($model,'role_id'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="role_id" ><?php echo $form->labelEx($model,'district_id'); ?></label>
			<div class="col-md-8">
			<?php
				$criteria=new CDbCriteria;
				$criteria->condition="is_active='Y'" ;
				// $criteria->order="role_id DESC";
				$distt=District::model()->findAll($criteria);
				echo "<select class='form-control' name='UserRoleModuleMapping[district_id]'>
				<option value=''>Please Select</option>";

				foreach ($distt as $key => $dist) {
					echo "
					<option value='".$dist->district_id."'>".$dist->distric_name."</option>";
					# code...
				}
				echo "</select>";
			?>

			<?php echo $form->error($model,'district_id'); ?>
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

<script type="text/javascript">
	$( document ).ready(function() {
		var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
   	    getAllDeptAPI(url,'#UserRoleMapping_department_id');
   	    url="<?php echo Yii::app()->createUrl('ajax/getallroles');?>";
   	    getAllRoles(url,'#UserRoleMapping_role_id');
	});
	// $('#UserRoleMapping_department_id').change(function(){
		var url ="<?php echo Yii::app()->createUrl('ajax/alldeptusers');?>";
		var dept_id = 1;
		getAllDeptUsersModule(url,dept_id);
	

</script>