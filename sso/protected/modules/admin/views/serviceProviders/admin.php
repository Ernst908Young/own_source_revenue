<style type="text/css">
.items{
	color:black;text-shadow:0 0 0 black;
}
</style>
<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */

$this->breadcrumbs=array(
	'Service Providers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ServiceProviders', 'url'=>array('index')),
	array('label'=>'Create ServiceProviders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#service-providers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Service Providers</h1>

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
	'id'=>'service-providers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sp_id',
		'service_provider_name',
		'service_provider_tag',
		'remote_server_ip',
		'secret_key',
		'server_base_url',
		/*
		'is_service_provider_active',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
