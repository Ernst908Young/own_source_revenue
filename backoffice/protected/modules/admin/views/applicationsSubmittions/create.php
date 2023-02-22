<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $model ApplicationsSubmittions */

$this->breadcrumbs=array(
	'Applications Submittions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationsSubmittions', 'url'=>array('index')),
	array('label'=>'Manage ApplicationsSubmittions', 'url'=>array('admin')),
);
?>
<div class="panel">
  <header class="panel-heading"><h1>Create Application Submission</h1></header>
  	<div class="panel-body">
  		<div class="row col-md-12">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>