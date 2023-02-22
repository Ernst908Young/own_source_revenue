<?php
/* @var $this ServiceStackholderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Infowizard Service Stackholders',
);

$this->menu=array(
	array('label'=>'Create BoInfowizardServiceStackholder', 'url'=>array('create')),
	array('label'=>'Manage BoInfowizardServiceStackholder', 'url'=>array('admin')),
);
?>

<h1>Bo Infowizard Service Stackholders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
