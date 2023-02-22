<tr>

	<td>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->profession_name); ?>
	</td>
        

	<td>
	<?php echo CHtml::encode($data->profession_body); ?>
	</td>
        <td>
	<?php echo CHtml::encode($data->created); ?>
	</td>


</tr>