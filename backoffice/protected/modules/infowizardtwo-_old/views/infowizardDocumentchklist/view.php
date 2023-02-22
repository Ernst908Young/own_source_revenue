<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Document Master</div>
 
	
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
            <?php echo $model->name;?>
	
	</div>
	</div>
</div>

	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Type of Document :</label></div>
	<div class="col-md-6">
	<?php $k=0;$doc=explode(',',$model->doc_id);  $counts=count($doc); 
	for($i=0;$i<$counts;$i++) {
	$sql = "SELECT name from bo_infowizard_docunenttype_master where doc_id='".$doc[$i]."'";
	                      $connection=Yii::app()->db; 
	                      $command=$connection->createCommand($sql);
                          $docid=$command->queryRow();
                 echo $k=$i+1;echo ") ".$docid['name'];  if($i<($counts-1)){echo "<br> "; }  }  ?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Issuer :</label></div>
	<div class="col-md-6">
	<?php $data=InfowizardQuestionMasterExt::getListIssuerMapping($model->issmap_id); 
		  $dataissuer=InfowizardQuestionMasterExt::getViewIssuer($data['issuer_id']); 
           echo $dataissuer['name']; ?></td>
				
	
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Issued By :</label></div>
	<div class="col-md-6">
	<?php $dataissuerby=InfowizardQuestionMasterExt::getViewIssuerby($data['issuerby_id']); 
                echo $dataissuerby['name']; ?></td>
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

<div class="row buttons" align="center">
    
      <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardDocumentchklist/index/')?>"><span>View list of Document Master</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardDocumentchklist/create/')?>"><span>Add New Document Master</span></a>
    </div>
</div></div></div></div>