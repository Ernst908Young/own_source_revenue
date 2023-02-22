
<style>
.errorSummary { clear:red }
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Mapping for Pre-Requisites : Service ID <?php echo $model->service_id;?></div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'service_id',
		'pre_service_id',
		'status',
		'user_agent',
		'ip_address',
		'created',
	),
)); ?>
  
</div>
</div>
</div>
</div>
