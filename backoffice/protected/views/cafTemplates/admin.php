<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */

$this->breadcrumbs=array(
    'Caf Templates'=>array('index'),
    'Manage',
);

$this->menu=array(
    //array('label'=>'List CafTemplates', 'url'=>array('index')),
    array('label'=>'Create CafTemplates', 'url'=>array('create')),
);

/* Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#caf-templates-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
"); */
?>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
	'allData'=>$allData
)); ?>
</div><!-- search-form -->

<?php /* $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'caf-templates-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'dept_id',
        'role_id',
        'is_active',
        'created',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); */ ?>