<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        Update Professional [<?php echo $model->professional_name;?>] </div>
    <div class="text-right">
        <a href="/backoffice/infowizard/professionalMaster/" class="btn btn-info" style="margin-top:3px;"><i class="fa fa-arrow-left"></i> Go To All Professional</a>
	</div>	
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>