<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Service Master</div>
 
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label  class="col-lg-6 col-sm-6 control-label" ><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</label></div>
	<div class="col-md-6">
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
  </div>
	</div>
	</div>

   <?php echo CHtml::encode($data->getAttributeLabel('service_name')); ?>:
    <?php echo CHtml::encode($data->service_name); ?>


    <b><?php echo CHtml::encode($data->getAttributeLabel('service_incidence')); ?>:</b>
    <?php echo CHtml::encode($data->service_incidence); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('service_sector')); ?>:</b>
    <?php echo CHtml::encode($data->service_sector); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('additional_sub_service')); ?>:</b>
    <?php echo CHtml::encode($data->additional_sub_service); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('periodic_inspection')); ?>:</b>
    <?php echo CHtml::encode($data->periodic_inspection); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('checklist_periodic_inspection')); ?>:</b>
    <?php echo CHtml::encode($data->checklist_periodic_inspection); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode($data->created); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
    <?php echo CHtml::encode($data->modified); ?>
    <br />

    */ ?>

</div>