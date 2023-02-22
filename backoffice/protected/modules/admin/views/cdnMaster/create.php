<?php
/* @var $this CdnMasterController */
/* @var $model CdnMaster */

$this->breadcrumbs=array(
	'Cdn Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CdnMaster', 'url'=>array('index')),
	array('label'=>'Manage CdnMaster', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create CdnMaster</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>