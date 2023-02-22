<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Document CheckList</div>
 
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label  class="col-lg-6 col-sm-6 control-label" >Checklist ID:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->chklist_id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Checklist Document Name :</label></div>
	<div class="col-md-6">
	<?php $doc=explode(',',$model->doc_id);  $counts=count($doc); 
	for($i=0;$i<$counts;$i++) {
	$sql = "SELECT name from bo_infowizard_docunenttype_master where doc_id='".$doc[$i]."'";
	                      $connection=Yii::app()->db; 
	                      $command=$connection->createCommand($sql);
                          $docid=$command->queryRow();
                 echo $docid['name'];  if($i<($counts-1)){echo " , "; }  }  ?>
	</div>
	</div>
</div>

	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Type of Document :</label></div>
	<div class="col-md-6">
	<?php $sql = "SELECT name from bo_infowizard_docunenttype_master where doc_id='".$model->doc_id."'";
	                      $connection=Yii::app()->db; 
	                      $command=$connection->createCommand($sql);
                          $docid=$command->queryRow();
                    ?> <?=$docid['name']?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Issuer :</label></div>
	<div class="col-md-6">
	<?php $sql = "SELECT name from bo_infowizard_issuer_master where issuer_id='".$model->issuer_id."'";
	                      $connection=Yii::app()->db; 
	                      $command=$connection->createCommand($sql);
                          $issuerid=$command->queryRow();
                    ?><?=$issuerid['name']?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Issued By :</label></div>
	<div class="col-md-6">
	<?php $sql = "SELECT name from bo_infowizard_issuerby_master where issuerby_id='".$model->issuerby_id."'";
	                      $connection=Yii::app()->db; 
	                      $command=$connection->createCommand($sql);
                          $issuerbyid=$command->queryRow();
                    ?><?=$issuerbyid['name']?>
	</div>
	</div>
</div>	

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Created Date :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->created_date; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Is Active:</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->is_docchklist_active; ?>
	</div>
	</div>
</div>

</div></div></div></div>