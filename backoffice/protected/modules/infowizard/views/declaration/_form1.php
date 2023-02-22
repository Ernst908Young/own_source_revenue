<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<style>
    .errorMessage{color:red;}    
    .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -52px !important;
}
</style>



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
		 
 <?php 
  $servs =Yii::app()->db->createCommand("SELECT  * FROM  bo_information_wizard_service_master")->queryAll();
$ser_list = [];
  if(isset($servs) && !empty($servs)){ 
	  foreach($servs as $cat_id=>$cat_name){
		  $ser_list[$cat_name['id']]=$cat_name['id'].'.0 - '.$cat_name['service_name'];
	  }
  }

 ?>
 
   <div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" >Service ID : <span class="required" aria-required="true"></span></label>
				<div class=" form-group col-md-4" style="margin-top: 10px;">
					<strong><?php echo  $model->service_id.'.0'; ?></strong>
			
				</div>
		 
	</div>
	
	
    <div class="row" style="margin:10px 0 10px 0;">
 <div class="col-md-12">
	 
			<label  for="application_name" > 
			 Declaration Label:<span class="required" aria-required="true">*</span></label>
			
		    <?php echo $form->textArea($model,'declaration_label',array('class'=>'form-control','rows'=>5,'autocomplete' => 'off','required'=>'required')); ?>
		    <?php echo $form->error($model,'declaration_label'); ?>
		    </div>
		 
	</div> 

<div class="row" style="margin:10px 0 10px 0;">
 
     
            <label class="col-lg-2 col-sm-2 control-label" for="application_name" > 
             Option:<span class="required" aria-required="true">*</span></label>
            <div class="form-group col-md-4">
            <?php echo $form->textField($model,'option',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required')); ?>
            <?php echo $form->error($model,'option'); ?>
            </div>
         
    </div> 


		<!-- <div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" ><1?php echo $form->labelEx($model,'is_active ?'); ?><span class="required" aria-required="true">*</span></label>
				<div class=" form-group col-md-4">
					<1?php echo $form->dropDownList($model,'is_active',array(1=>'Y',0=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<1?php echo $form->error($model,'is_active'); ?>
				</div>
		 
	</div> -->

	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update',array('class'=>'btn btn-primary')); ?>
              

<?php $this->endWidget(); ?>


<!-- form -->
<script type="text/javascript">
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
</script>

