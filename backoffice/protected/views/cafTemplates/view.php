<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */

$this->breadcrumbs=array(
    'Caf Templates'=>array('index'),
    $model->id,
);

$this->menu=array(
   // array('label'=>'List CafTemplates', 'url'=>array('index')),
    array('label'=>'Create CafTemplates', 'url'=>array('create')),
    array('label'=>'Update CafTemplates', 'url'=>array('update', 'id'=>$model->id)),
   // array('label'=>'Delete CafTemplates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage CafTemplates', 'url'=>array('admin')),
);
/* echo "<pre>";
print_r($allData); */
?>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'><i style=" font-size:20px;" class='fa fa-list'></i>View CafTemplates #<?php echo $model->id; ?></div>
	</div>
	<div class="portlet-body">
		<div class="site-min-height">
			<div class="form form-horizontal" role="form">
				<div class="row">
					<div class="form-group col-md-12">
					<div class="col-md-6">
					<label  class="col-lg-6 col-sm-6 control-label">Department Name :</label></div>
					<div class="col-md-6"><?php echo $allData['department_name']; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
					<div class="col-md-6">
					<label  class="col-lg-6 col-sm-6 control-label">Role Name :</label></div>
					<div class="col-md-6"><?php echo $allData['role_name']; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
					<div class="col-md-6">
					<label  class="col-lg-6 col-sm-6 control-label">Template Message :</label></div>
					<div class="col-md-6"><?php echo $allData['template']; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
					<div class="col-md-6">
					<label  class="col-lg-6 col-sm-6 control-label">Status :</label></div>
					<div class="col-md-6"><?php echo $allData['is_active']; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
					<div class="col-md-6">
					<label  class="col-lg-6 col-sm-6 control-label">Created :</label></div>
					<div class="col-md-6"><?php echo $allData['created']; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>		
<?php /* $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'dept_id',
        'role_id',
        'is_active',
        'created',
    ),
));  */?>