<?php
/* @var $this ApplicationsController */
/* @var $model Applications */

$this->breadcrumbs=array(
	'Applications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Applications', 'url'=>array('index')),
	array('label'=>'Manage Applications', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create Applications</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>	