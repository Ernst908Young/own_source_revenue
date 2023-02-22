<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'service_name'); ?>
        <?php echo $form->textField($model,'service_name',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'service_incidence'); ?>
        <?php echo $form->textField($model,'service_incidence',array('size'=>30,'maxlength'=>30)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'service_sector'); ?>
        <?php echo $form->textField($model,'service_sector',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'additional_sub_service'); ?>
        <?php echo $form->textField($model,'additional_sub_service',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'periodic_inspection'); ?>
        <?php echo $form->textField($model,'periodic_inspection',array('size'=>1,'maxlength'=>1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'checklist_periodic_inspection'); ?>
        <?php echo $form->textField($model,'checklist_periodic_inspection',array('size'=>1,'maxlength'=>1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'created'); ?>
        <?php echo $form->textField($model,'created'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'modified'); ?>
        <?php echo $form->textField($model,'modified'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->