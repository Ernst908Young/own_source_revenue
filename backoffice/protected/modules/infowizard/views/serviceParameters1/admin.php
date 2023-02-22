<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $model BoInformationWizardServiceParameters */

$this->breadcrumbs=array(
	'Bo Information Wizard Service Parameters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardServiceParameters', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardServiceParameters', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bo-information-wizard-service-parameters-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bo Information Wizard Service Parameters</h1>

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
	'id'=>'bo-information-wizard-service-parameters-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'service_id',
		'service_type',
		'is_online',
		'is_integrated_with_swcs',
		'is_in_uttarakhand_right_to_service_act',
		/*
		'is_statutory_forms_available',
		'statutory_form_no',
		'statutory_form_upload',
		'statutory_forms_creation',
		'document_checkList',
		'document_checklist_upload',
		'document_checklist_creation',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
