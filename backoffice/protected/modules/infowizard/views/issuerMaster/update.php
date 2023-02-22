<?php
/* @var $this IssuerMasterController */
/* @var $model BoInfowizardIssuerMaster */

$this->breadcrumbs=array(
	'Bo Infowizard Issuer Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->issuer_id),
	'Update',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>