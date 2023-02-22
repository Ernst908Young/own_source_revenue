<?php $nicData = nicMasterController::getniclevel();

//print_r($nicData);die;?><style>
    .errorSummary{color:red;}    
</style>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-nic-master-form',
        'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="act_type"><?php echo $form->labelEx($model,'Parent ID'); ?></label>
			<div class="col-md-8">
		<?php //echo $form->textField($model,'parent_id',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'parent_id'); ?>
                            <select name="NicMaster[parent_id]" class="form-control">
                               <option value=""><?php echo "Please Select"; ?></option> 
                                <?php if(!empty($nicData)){
     foreach ($nicData as $key=>$nicCodes) {
      ?>   <option value="<?php echo $nicCodes['id']; ?>"><?php echo $nicCodes['level']." ".$nicCodes['code']; ?></option> <?php
      if(!empty($nicCodes['level1'])){
          foreach($nicCodes['level1'] as $level2){ ?>
               <option value="<?php echo $level2['id']; ?>"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;-"; echo $level2['level']." ".$level2['code']; ?></option>
        <?php  }
      }    
       if(!empty($level2['level2'])){
          foreach($level2['level2'] as $level3){ ?>
               <option value="<?php echo $level3['id']; ?>"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-"; echo $level3['level']." ".$level3['code']; ?></option>
        <?php  }
      }    
}
} ?>
                            </select>
	</div>
	</div>
	</div>
        <div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="act_type"><?php echo $form->labelEx($model,'level'); ?></label>
			<div class="col-md-8">
                             <select name="NicMaster[level]" class="form-control">
                               <option value="Group">Group</option>
                               <option value="Division">Division</option>
                               <option value="Section">Section</option>
                             </select>
		
                            
	</div>
	</div>
	</div>

<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="Code"><?php echo $form->labelEx($model,'code'); ?></label>
			<div class="col-md-8">
		<?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="act_type"><?php echo $form->labelEx($model,'description'); ?></label>
			<div class="col-md-8">
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	</div>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->