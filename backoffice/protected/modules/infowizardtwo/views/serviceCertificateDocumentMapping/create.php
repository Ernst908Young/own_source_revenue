<style>
  .errorSummary {
    clear:red }
</style>
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'>
      </i>Document Mapping : Service with their Certificates
    </div>
    <div class='tools'>	
    </div>
  </div>
  <div class="portlet-body">
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
        <?php
$form = $this->beginWidget('CActiveForm', array(
'id' => 'information-wizard-service-certificate-maping',
'enableAjaxValidation' => true,
));
?>
        <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
        <?php //echo $form->errorSummary($model); ?>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Issuer
              <span class="required">*
              </span>
            </label>
            <div class="col-md-8">
              <select name="issuer_id" id="issuer_id" class="form-control"  required>	
                <?php 
$Issuerdata[] = array('issuer_id'=>'','name'=>'--Select Issuer--');
$Issuer = InfowizardQuestionMasterExt::getIssuerForInfoWizard();
foreach($Issuer as $key=>$val){ $Issuerdata[] = $val; }
foreach($Issuerdata as $que){ ?>
                <option value="<?php echo $que['issuer_id'];?>">
                  <?php echo $que['name'];?>
                </option>
                <?php } ?>
              </select>	
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Issued By 
              <span class="required">*
              </span>
            </label>
            <div class="col-md-8">
              <select class="form-control"  name="InformationWizardServiceCertificateMaping[department_id]" id="issuerby_id" >
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
              <?php echo $form->labelEx($model, 'Service'); ?>
              <span class="required">*
              </span>
            </label>
            <div class="col-md-8">
              <?php
// All Services from Information Wizard 
$listData[''] = "Select Service";
$allServices="0";
if(isset($_GET['department_id'])){
$sqldata = "SELECT id from bo_information_wizard_service_master where issuerby_id=".$_GET['department_id']." AND to_be_used_in_online_offline='Y'";
$allServiceData = Yii::app()->db->createCommand($sqldata)->queryAll(); 
foreach($allServiceData as $serviceData){
$allServices=$allServices.",".$serviceData['id'];
}
// print_r($allServiceData);die;
}
$sql = "SELECT core_service_name,service_id,servicetype_additionalsubservice from bo_information_wizard_service_parameters where core_service_name!='' && service_id IN ($allServices)";
$allData = Yii::app()->db->createCommand($sql)->queryAll();
foreach ($allData as $data) {
$k = $data['service_id'] . "." . $data['servicetype_additionalsubservice'];
$listData[$k] = $data['core_service_name'];
}
?>
              <?php $serviceID=""; if(!empty($model->service_id)) { $serviceID= $model->service_id; }  //print_r($allData);die;// print_r($options);die;?>
              <select name="InformationWizardServiceCertificateMaping[final_service_id]" id="InformationWizardPreServiceMapping_service_id" class="form-control"  required >
                <?php 
if (isset($listData)) {                              
foreach ($listData as $k=>$v){                                
?>
                <option value="<?php echo $k;?>"  
                        <?php if($k==$serviceID){ echo "selected";} ?>> 
                <?php echo $v; ?>
                </option>
              <?php
}
}
?>
              </select>
            <?php //echo $form->dropDownList($model, 'service_id', $listData, array('class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')); ?>
            <?php echo $form->error($model, 'final_service_id'); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
            <?php echo $form->labelEx($model, 'Document Checklist'); ?>
            <span class="required">*
            </span>
          </label>
          <div class="col-md-8">
            <?php if(isset($_GET['issuer']) && isset($_GET['department_id']) ){
				$issuer=$_GET['issuer'];
				$issuerByID=$_GET['department_id'];
					// All Services from Information Wizard 
					$sql = "SELECT docchk_id,chklist_id,name from bo_infowizard_documentchklist where is_docchklist_active='Y'  AND issmap_id IN (SELECT issmap_id from bo_infowizard_issuer_mapping where issuer_id=$issuer AND issuerby_id=$issuerByID)";
					$allDocumentData = Yii::app()->db->createCommand($sql)->queryAll();
					foreach ($allDocumentData as $documentData) {
					$k = $documentData['docchk_id'];
					$listDocumentData[$k] = $documentData['chklist_id']." (".$documentData['name'].")";
					}
					?>
            <select name="InformationWizardServiceCertificateMaping[doc_checklist_id]" id="InformationWizardPreServiceMapping_doc_checklist_id" class="form-control"  required >
              <?php 
				if (isset($listDocumentData)) {                              
				foreach ($listDocumentData as $key=>$value){                                
				?>
              <option value="<?php echo $key;?>"  
                      <?php if($key==$serviceID){ echo "selected";} ?>> 
              <?php echo $value; ?>
              </option>
            <?php
}
}
?> </select>
			
			<?php }else{ ?> 			
			 <select name="InformationWizardServiceCertificateMaping[doc_checklist_id]"  class="form-control"  required >
			 <option value="">Select Issuer & Issuer By </option>
			 </select>
			<?php } ?>
          <?php //echo $form->dropDownList($model, 'service_id', $listData, array('class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')); ?>
          <?php echo $form->error($model, 'doc_checklist_id'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
          <?php echo $form->labelEx($model, 'Is Active'); ?>
          <span class="required">*
          </span>
        </label>
        <div class="col-md-8">
          <?php echo $form->dropDownList($model, 'is_active', array('Y' => 'Y', 'N' => 'N'), array('class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')); ?>
          <?php echo $form->error($model, 'is_active'); ?>
        </div>
      </div>
    </div>			
  </div>
  <div class="row" style="padding-top:20px;">
    <div class="form-group col-md-6">
      <div class="col-md-8 buttons"  align="right">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
      </div>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
	    <?php if(!empty($_GET['issuer'])){ ?>
		var str=<?php echo $_GET['issuer']; ?>	
		 $("#issuer_id").val(str);
			getIssuerBY(str);
		<?php } ?>
    $("#issuer_id").change(function(){
       var str=$(this).val();	
	   getIssuerBY(str);
    });
    $("#issuerby_id").change(function(){
      var issuer=$("#issuer_id").val();
      var issuerBy=$(this).val();
      window.location='/backoffice/infowizard/serviceCertificateDocumentMapping/create/department_id/'+issuerBy+'/issuer/'+issuer;
    });
  } );
  
  function getIssuerBY(str){
	 
      $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/InfowizardDocumentchklist/issuermappingall",
        dataType:'json',
        data:
        {
          post_issuerid: str
        }
        ,
        success:  function(data) {
          var $select = $('#issuerby_id');
          $select.html('');
          $.each(data, function(index, element) {
            $select.append('<option value="' + element.issmap_id + '">' + element.name + '</option>');
          });
		   <?php if(!empty($_GET['department_id'])){ ?>
		$("#issuerby_id").val(<?php echo $_GET['department_id']; ?>);
			
		<?php } ?>
		  
        }
        ,
        error:function(jqXHR, textStatus, errorThrown){
          alert('error::'+errorThrown);
        }
      }
            );
  }
</script>
