


<div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><?php echo $model->profession_name; ?></h3>
                                                </div>
                                                <div class="panel-body">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'profession_name',
		'profession_body',
		'created',
	),
)); ?>

 </div>
    <p class="text-center">  <a href="/backoffice/infowizard/professionalMaster/" class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
    <a href="/backoffice/infowizard/professionalMaster/update/id/<?php echo $model->id; ?>" class="btn btn-info"> Edit <i class="fa fa-pencil"></i></a></p>
                                            </div>
<script>
    $(document).ready(function(){
               $(".detail-view").addClass("table table-striped table-bordered table-hover dataTable no-footer");
    });
    
    </script>
        
