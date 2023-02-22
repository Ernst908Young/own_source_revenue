<tr>

	<td>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->professional_name); ?>
	</td>
        

	<td>
	<?php echo CHtml::encode($data->profession_body); ?>
	</td>
        <td>
	<?php echo CHtml::encode($data->is_active); ?>
	</td>
        <td>
            <a href="/backoffice/infowizard/professionalMaster/update/id/<?php echo $data->id; ?>" class="btn btn-info">Update</a>
	<a href="/backoffice/infowizard/professionalMaster/view/id/<?php echo $data->id; ?>" class="btn btn-success">View</a>
	</td>


</tr>