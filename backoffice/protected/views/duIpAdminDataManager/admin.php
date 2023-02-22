<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $model DuIpAdminDataManager */

$this->breadcrumbs=array(
	'Du Ip Admin Data Managers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DuIpAdminDataManager', 'url'=>array('index')),
	array('label'=>'Create DuIpAdminDataManager', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#du-ip-admin-data-manager-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Du Ip Admin Data Managers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'du-ip-admin-data-manager-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mrn',
		'company_name',
		'caf_id',
		'application_status',
		'is_a',
		/*
		'is_b',
		'is_c',
		'is_d',
		'created',
		'modified',
		'created_by',
		'is_active',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
