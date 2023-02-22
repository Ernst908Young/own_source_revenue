<?php
/* @var $this BoLandownerContactController */
/* @var $model BoLandownerContact */

$this->breadcrumbs=array(
	'Bo Landowner Contacts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BoLandownerContact', 'url'=>array('index')),
	array('label'=>'Create BoLandownerContact', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bo-landowner-contact-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bo Landowner Contacts</h1>

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
	'id'=>'bo-landowner-contact-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'land_id',
		'contact_type',
		'owner_name',
		'owner_contact_no',
		/*
		'owner_alternate_no',
		'owner_email',
		'agent_name',
		'agent_contact_no',
		'agent_alternate_no',
		'agent_email',
		'is_active',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
