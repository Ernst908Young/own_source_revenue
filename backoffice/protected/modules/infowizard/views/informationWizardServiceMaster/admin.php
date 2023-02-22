<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */

$this->breadcrumbs=array(
    'Bo Information Wizard Service Masters'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List BoInformationWizardServiceMaster', 'url'=>array('index')),
    array('label'=>'Create BoInformationWizardServiceMaster', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#bo-information-wizard-service-master-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Manage Bo Information Wizard Service Masters</h1>

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
    'id'=>'bo-information-wizard-service-master-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'service_name',
        'service_incidence',
        'service_sector',
        'additional_sub_service',
        'periodic_inspection',
        /*
        'checklist_periodic_inspection',
        'created',
        'modified',
        */
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>