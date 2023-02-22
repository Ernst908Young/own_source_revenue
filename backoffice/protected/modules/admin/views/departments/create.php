<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create Departments</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>	