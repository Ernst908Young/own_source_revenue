<?php
/* @var $this IssuerbyMasterController */
/* @var $model BoInfowizardIssuerbyMaster */

$this->breadcrumbs=array(
	'Bo Infowizard Issuerby Masters'=>array('index'),
	'Create',
);
// print_r($Issuerdata);
?>



<?php $this->renderPartial('_form', array('model'=>$model,'Issuerdata'=>$Issuerdata)); ?>