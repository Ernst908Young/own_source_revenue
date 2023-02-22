 <?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */

$this->breadcrumbs=array(
    'Bo Information Wizard Service Masters'=>array('index'),
    'Create',
);

//$this->menu=array(
//    array('label'=>'List BoInformationWizardServiceMaster', 'url'=>array('index')),
//    array('label'=>'Manage BoInformationWizardServiceMaster', 'url'=>array('admin')),
//);
?>

<!--<h1>Create BoInformationWizardServiceMaster</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'sectors'=>$sectors)); ?> 