<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */

$this->breadcrumbs=array(
	'Sp Applcations Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SpApplcationsDetail', 'url'=>array('index')),
	array('label'=>'Create SpApplcationsDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sp-applcations-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sp Applcations Details</h1>

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
	'id'=>'sp-applcations-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sp_app_id',
		'app_id',
		'timeline_period',
		// 'sp_id',
		'form_download_link',
		'application_created_on',
		/*
		'procedure_link',
		'remote_ip',
		'user_agent',
		'is_active',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
