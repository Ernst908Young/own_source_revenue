<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<style>
    .errorMessage{color:red;}    
</style>
<div class="row">
	<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
	   <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/formTypes/index/')?>"><span>Form Type List</span></a>
	</div> 
</div>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Update  Form Type </div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-issuer-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	//echo "<pre/>"; 
	//print_r($model);die;
	?>
		 
		 
   <div class="row" style="margin:10px 0 10px 0;">  
			<label class="col-lg-2 col-sm-2 control-label" for="application_name" > 
			 Enter Form Type: <span class="required" aria-required="true">*</span></label>
			<div class="form-group col-md-8">
		    <?php echo $form->textField($model,'form_type',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required','onclick'=>'return lettersOnly()')); ?>
		    <?php echo $form->error($model,'form_type'); ?>
		    </div> 
	</div> 

	<div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_active ?'); ?><span class="required" aria-required="true">*</span></label>
				<div class=" form-group col-md-8">
					<?php echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<?php echo $form->error($model,'is_active'); ?>
				</div>
		 
	</div>

	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div></div></div>
<!-- form -->
<style>
function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 33 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
          return false;
       }
       return true;
     }
	 </style>