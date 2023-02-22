<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $model InfowizardQuesansMapping */

$this->breadcrumbs=array(
	'Infowizard Quesans Mappings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InfowizardQuesansMapping', 'url'=>array('index')),
	array('label'=>'Create InfowizardQuesansMapping', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#infowizard-quesans-mapping-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Infowizard Quesans Mappings</h1>

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
	'id'=>'infowizard-quesans-mapping-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'queans_mapp_id',
		'department_id',
		'deptservice_id',
		'question_id',
		'anscat_id',
		'answer_detail',
		/*
		'is_quesans_active',
		'priority',
		'created_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
