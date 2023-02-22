<?php
 
$this->breadcrumbs=array(
	'Bo Infowizard Issuer Masters'=>array('index'),
	$model->form_type=>array('view','id'=>$model->id),
	'Update',
);

?>

<?php $this->renderPartial('_form1', array('model'=>$model)); ?>