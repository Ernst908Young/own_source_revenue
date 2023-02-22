<?php
/* @var $this ViewAPIAccessLogController */
/* @var $data ApiAccessLog */
?>

<div class="view">

	<b><hr /><?php echo CHtml::encode($data->getAttributeLabel('access_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->access_id), array('view', 'id'=>$data->access_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sp_tag')); ?>:</b>
	<?php echo CHtml::encode($data->sp_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_method')); ?>:</b>
	<?php echo CHtml::encode($data->request_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_uri')); ?>:</b>
	<?php echo CHtml::encode($data->request_uri); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_time')); ?>:</b>
	<?php echo CHtml::encode($data->request_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_info')); ?>:</b>
	<?php echo "<pre>"; print_r(json_decode(CHtml::encode($data->post_info)));echo "</pre>"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_date_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_ip')); ?>:</b>
	<?php echo CHtml::encode($data->remote_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('response_return')); ?>:</b>
	<?php echo CHtml::encode($data->response_return); ?>
	<br />

	*/ ?>

</div>