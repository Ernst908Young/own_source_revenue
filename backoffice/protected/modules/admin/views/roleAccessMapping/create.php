<?php
/* @var $this RoleAccessMappingController */
/* @var $model RoleAccessMapping */

$this->breadcrumbs=array(
	'Role Access Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleAccessMapping', 'url'=>array('index')),
	array('label'=>'Manage RoleAccessMapping', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create RoleAccess Mapping</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>