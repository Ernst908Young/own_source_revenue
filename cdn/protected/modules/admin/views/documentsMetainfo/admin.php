<?php
/* @var $this DocumentsMetainfoController */
/* @var $model DocumentsMetainfo */

$this->breadcrumbs=array(
	'Documents Metainfos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DocumentsMetainfo', 'url'=>array('index')),
	array('label'=>'Create DocumentsMetainfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documents-metainfo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Documents Metainfos</h1>

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
	'id'=>'documents-metainfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'info_id',
		'doc_id',
		'uploaded_by',
		'department_id',
		'application_id',
		'uploaded_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
