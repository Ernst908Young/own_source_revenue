<?php
/* @var $this IssuerbyMasterController */
/* @var $model BoInfowizardIssuerbyMaster */

$this->breadcrumbs=array(
	'Bo Infowizard Issuerby Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->issuerby_id),
	'Update',
);

?>


<?php $this->renderPartial('_form', array('model'=>$model,'Issuerdata'=>$Issuerdata)); ?>