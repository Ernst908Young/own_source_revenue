<?php
/* @var $this CafTemplatesController */
/* @var $data CafTemplates */
?>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'> <i style=" font-size:20px;" class='fa fa-list'></i>List of Services</div>
    <div class='tools'> </div>	
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
				<tr>
					<th>S.No.</th>
					<th>Department Name</th>
					<th>Role Name</th>
					<th>Template Message</th>
					<th>Active</th>				
					<th>Created On</th>
					<th>Action</th>
				</tr>
            </thead>
            <tbody>
					<tr>
						<th>S.No.</th>
						<th><?php //echo CHtml::encode($data->getAttributeLabel('created')); ?><?php echo CHtml::encode($data->dept_id); ?></th>
						<th><?php echo CHtml::encode($data->role_id); ?></th>
						<th><?php echo CHtml::encode($data->template); ?></th>
						<th><?php echo CHtml::encode($data->is_active); ?></th>				
						<th><?php echo CHtml::encode($data->created); ?></th>
						<th>Action</th>
					</tr>					
			</tbody>
        </table>	
	</div>
</div>	