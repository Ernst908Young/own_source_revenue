<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */
/* @var $form CActiveForm */
?>
<style>
    span.required{color:red}
.control-label .required, .form-group .required {
    color: #333;
    font-size: 14px;
    padding-left: 2px;
     font-weight: 400;
}

.required .required{color:red;} 
.errorMessage {
    color: red;
}
</style>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>Create Service Master</div>
        <div class='tools'>

        </div>

    </div>
    <div class="portlet-body">

        <div class="site-min-height">
            <div class="form form-horizontal" role="form">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'bo-information-wizard-service-master-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                ));
                ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                            <?php echo $form->labelEx($model, 'service_name'); ?>
                        </label>

                        <div class="col-md-8">
<?php echo $form->textField($model, 'service_name', array('class'=>'form-control','size' => 60, 'maxlength' => 255,'required'=>'required')); ?>
<?php echo $form->error($model, 'service_name'); ?>
                        </div>
                    </div>
                </div>


                 <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label required" for="service_incidence" >
                          Service Incidence <span class="required"></span>
                        </label>
                        <div class="col-md-8"> 
 <?php //echo $form->dropDownList($model,'service_incidence',array('Pre-Establishment'=>'Pre-Establishment','Pre-Operations'=>'Pre-Operations','Post-Operations'=>'Post-Operations'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
                            <div class="col-md-4"><?php echo $form->checkbox($model,'incidence_pre_establishment'); ?> Pre Establishment  </div>
                            <div class="col-md-4"><?php echo $form->checkbox($model,'incidence_pre_operation'); ?> Pre Operations  </div>
                            <div class="col-md-4"><?php echo $form->checkbox($model,'incidence_post_operation'); ?> Post Operations  </div>
<?php echo $form->error($model, 'service_incidence'); ?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="service_sector" >
                            <?php echo $form->labelEx($model, 'service_sector'); ?></label>
                        <div class="col-md-8">   
   <?php echo $form->dropDownList($model,'service_sector',$sectors,array('class'=>'form-control','autocomplete' => 'off','required'=>'required', 'multiple'=>true)); ?>
	
<?php echo $form->error($model, 'service_sector'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <p>( You can select multiple option by pressing CTRL  ) </p>
                    </div>
                </div>
     <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="service_type" >
                            <?php echo $form->labelEx($model, 'service_type'); ?></label>
                        <div class="col-md-8">   
   <?php echo $form->dropDownList($model,'service_type',array('Approval'=>'Approval','Certificates'=>'Certificates','Intimation'=>'Intimation','License'=>'License','Permission'=>'Permission','Permit'=>'Permit','Registration'=>'Registration'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
	
<?php echo $form->error($model, 'service_type'); ?>
                        </div>
                    </div>
                </div>
          
                 <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="additional_sub_service" >
                            <?php echo $form->labelEx($model, 'additional_sub_service'); ?>
                        </label>
                        <div class="col-md-8"> 
 <?php echo $form->dropDownList($model,'additional_sub_service',array('Cancellation'=>'Cancellation','Surrender'=>'Surrender','Transfer'=>'Transfer','Duplicate Copy'=>'Duplicate Copy','Renewal'=>'Renewal','Return'=>'Return','Maintenance of Register'=>'Maintenance of Register'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required','multiple'=>true)); ?>
		
<?php echo $form->error($model, 'additional_sub_service'); ?>
                        </div>
                    </div>
                      <div class="form-group col-md-6">
                        <p>( You can select multiple option by pressing CTRL ) </p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="periodic_inspection" >
                            <?php echo $form->labelEx($model, 'periodic_inspection'); ?>
                        </label>
                        <div class="col-md-8"> 
 
                            <?php echo $form->dropDownList($model,'periodic_inspection',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		
<?php echo $form->error($model, 'periodic_inspection'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="checklist_periodic_inspection" >
                            <?php echo $form->labelEx($model, 'checklist_periodic_inspection'); ?></label>
                        <div class="col-md-8"> 
                           
                            <?php echo $form->dropDownList($model,'checklist_periodic_inspection',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		
<?php echo $form->error($model, 'checklist_periodic_inspection'); ?>
                        </div>
                    </div>
                </div>


               	<div class="row buttons" align="center">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
                </div>

<?php $this->endWidget(); ?>

        
</div></div></div></div><!-- form -->