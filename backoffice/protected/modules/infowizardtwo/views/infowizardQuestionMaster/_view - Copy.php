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
									
	 <table class="table table-striped table-bordered table-hover order-column" >

            <thead>
            <tr>
            <th>Sl No.</th>
            <th>Question</th>
            <th>Active</th>
			<th>Created Date</th>
            </tr>
            </thead>

            <tbody> 
                      <tr>
                      <td ><?php echo CHtml::link(CHtml::encode($data->question_id), array('view', 'id'=>$data->question_id)); ?></td>
                      <td><?php  echo CHtml::encode($data->name);?></td>
					  <td><?php echo CHtml::encode($data->is_question_active); ?></td>
					  <td><?php echo CHtml::encode($data->created_date); ?></td>
                      </tr>								
</tbody></table>
</div></div></div></div>

