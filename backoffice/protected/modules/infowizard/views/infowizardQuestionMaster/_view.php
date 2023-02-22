<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $data InfowizardQuestionMaster */
?>

<div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i style="font-size:24px" class="font-dark"></i>
                                            <span class="caption-subject bold uppercase">Category Wise Investment in Crs</span>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
									
	 <table class="table table-striped table-bordered table-hover order-column" id="sample_1">

            <thead>
            <tr>
            <th>Sl No.</th>
            <th>Question</th>
            <th>Active</th>
            </tr>
            </thead>

            <tbody>
                      <tr>
                      <td align="center"><?php echo CHtml::link(CHtml::encode($data->question_id), array('view', 'id'=>$data->question_id)); ?></td>
                      
                      <td align="center"><?php  echo CHtml::encode($data->name);?></td>
                      </tr>								


	<b><?php echo CHtml::encode($data->getAttributeLabel('is_question_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_question_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />


</div>

</div></div></div>