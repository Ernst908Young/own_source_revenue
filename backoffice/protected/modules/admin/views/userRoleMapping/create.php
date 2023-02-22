<?php
/* @var $this UserRoleMappingController */
/* @var $model UserRoleMapping */

$this->breadcrumbs=array(
	'User Role Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRoleMapping', 'url'=>array('index')),
	array('label'=>'Manage UserRoleMapping', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create UserRoleMapping</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>