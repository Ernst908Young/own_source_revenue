<?php
/* @var $this ApplicationsFieldsMappingController */
/* @var $model ApplicationsFieldsMapping */

$this->breadcrumbs=array(
	'Applications Fields Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationsFieldsMapping', 'url'=>array('index')),
	array('label'=>'Manage ApplicationsFieldsMapping', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create ApplicationsFieldsMapping</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>