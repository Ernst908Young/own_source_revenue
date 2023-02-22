 <?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */

$this->breadcrumbs=array(
    'Bo Information Wizard Service Masters'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List BoInformationWizardServiceMaster', 'url'=>array('index')),
    array('label'=>'Create BoInformationWizardServiceMaster', 'url'=>array('create')),
    array('label'=>'View BoInformationWizardServiceMaster', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage BoInformationWizardServiceMaster', 'url'=>array('admin')),
);
?>

<h1>Update BoInformationWizardServiceMaster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?> 