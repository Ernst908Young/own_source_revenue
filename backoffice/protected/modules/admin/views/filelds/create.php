<?php
/* @var $this FileldsController */
/* @var $model Filelds */

$this->breadcrumbs=array(
	'Filelds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Filelds', 'url'=>array('index')),
	array('label'=>'Manage Filelds', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create Fields</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>