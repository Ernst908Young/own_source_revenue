<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */
/* @var $form CActiveForm */
?>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'><i style=" font-size:20px;" class='fa fa-list'></i> <?php if($model->id) { echo "Update Template";} else{ echo "Create Template"; } ?></div>
		<div class='tools'></div>	
	</div>
	<div class="portlet-body">
		<div class="site-min-height">
			<div class="form form-horizontal" role="form">
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'caf-templates-form',
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
							<?php echo $form->labelEx($model,'dept_id',array("class"=>"col-lg-4 col-sm-4 control-label")); ?>
							<div class="col-md-8">
								<?php 
								$sql = "SELECT dept_id,department_name FROM bo_departments where is_department_active=1 order by department_name";
								$connection = Yii::app()->db;
								$command = $connection->createCommand($sql);
								$AllIssuer = $command->queryAll();								
								$listDept = CHtml::listData($AllIssuer, 'dept_id', 'department_name');
								echo $form->dropDownList($model,'dept_id',$listDept,array("class"=>"form-control","empty"=>"--Select Department--")); ?>
								<?php echo $form->error($model,'dept_id'); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
						<?php echo $form->labelEx($model,'role_id',array("class"=>"col-lg-4 col-sm-4 control-label")); ?>
						<div class="col-md-8">
							<?php 
							$sql = "SELECT role_id,role_name FROM bo_roles where is_role_active='Y'";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$AllRoles = $command->queryAll();								
							$listRole = CHtml::listData($AllRoles, 'role_id', 'role_name');
							echo $form->dropDownList($model,'role_id',$listRole,array("class"=>"form-control","empty"=>"--Select Role--")); ?>
							<?php echo $form->error($model,'role_id'); ?>
						</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
						<?php echo $form->labelEx($model,'template',array("class"=>"col-lg-4 col-sm-4 control-label")); ?>
						<div class="col-md-8">
							<?php 							
							echo $form->textArea($model,'template',array('cols'=>10,'rows'=>5,"class"=>"form-control")); ?>
							<?php echo $form->error($model,'template'); ?>
						</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
						<?php echo $form->labelEx($model,'is_active',array("class"=>"col-lg-4 col-sm-4 control-label")); ?>
						<div class="col-md-8">
							<?php 
							$listActive = array('Y'=>'Y','N'=>'N');
							echo $form->dropDownList($model,'is_active',$listActive,array('size'=>1,'maxlength'=>1,"class"=>"form-control")); ?>
							<?php echo $form->error($model,'is_active'); ?>
						</div>	
						</div>
					</div>
					
					<!--<div class="row">
						<div class="form-group col-md-6">
						<?php //echo $form->labelEx($model,'created',array("class"=>"col-lg-4 col-sm-4 control-label")); ?>
						<div class="col-md-8">
							<?php //echo $form->textField($model,'created',array("class"=>"form-control")); ?>
							<?php //echo $form->error($model,'created'); ?>
						</div>	
						</div>	
					</div>-->

					<div class="row buttons" align="center">
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("class"=>"btn btn-primary")); ?>
					</div>

				<?php $this->endWidget(); ?>

				</div><!-- form -->
			</div>
		</div>
	</div>
</div><!-- form -->