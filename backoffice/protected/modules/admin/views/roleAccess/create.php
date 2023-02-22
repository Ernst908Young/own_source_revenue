<?php
/* @var $this RoleAccessController */
/* @var $model RoleAccess */

$this->breadcrumbs=array(
	'Role Accesses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleAccess', 'url'=>array('index')),
	array('label'=>'Manage RoleAccess', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create RoleAccess</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>	