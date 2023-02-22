<?php
/* @var $this DocunenttypeMasterController */
/* @var $model BoInfowizardDocunenttypeMaster */

$this->breadcrumbs=array(
	'Bo Infowizard Docunenttype Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->doc_id),
	'Update',
);


?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>