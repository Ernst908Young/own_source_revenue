<?php
/* @var $this ServiceFormMappingController */
/* @var $model ServiceFormMapping */
/* @var $form CActiveForm */
/* Rahul Kumar 27042018*/
?>
<style>
  .control-label{
    text-align: left !important;
  }
  .errorMessage{
    color:red;
  }
</style>
<div class='portlet box'>
  <div class="portlet-body">
    <div class="portlet-title" style="">
      <div class="caption">
        <i class="icon-map font-purple-soft">
        </i>
        <span class="caption-subject font-purple-soft bold uppercase"> Service Form Mapping
        </span>
      </div>
    </div>
    <hr>
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            'id' => 'service-form-mapping-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            ));
            ?>
        <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
        <?php //echo $form->errorSummary($model); ?>
        <div class="row">
          <!--Add here land title-->
          <div class="form-group col-md-6">
            <label class="col-md-12 control-label" for="land_title" >Department Name
              <span class="red"> *
              </span>
            </label>
            <div class="col-md-12">
              <?php $department_id=""; if(!empty($model->department_id)){$department_id=$model->department_id;}
                    if(isset($_GET['department_id']) && !empty($_GET['department_id'])) { $department_id = @$_GET['department_id']; }
                    //echo $department_id;die;
                    $departmentList[]="Select Department";
                    $departmentList = Yii::app()->db->createCommand("SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC")->queryAll();
                    if (isset($departmentList) && !empty($departmentList)) {
                    foreach ($departmentList as $departmentData) {
                    ?>
                                  <?php $issuerID=$departmentData['issuerby_id'];
                    $deptList[$issuerID]=$departmentData['name']; 
                    }}
                    echo $form->dropDownList($model, 'department_id', $deptList, array('class' => 'select2-me','id'=>'department_id'));// For Yii 1 Selectected ,array('options' => array("$department_id"=>array('selected'=>true)))  ?>
              <?php echo $form->error($model,'department_id'); ?>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-12 control-label" for="service_id" >Name Of Service
              <span class="red"> *
              </span>
            </label>
            <div class="col-md-12">
              <?php $serviceList['']="Select Service";
                    if(isset($department_id) && $department_id>0){
						/* echo "SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id WHERE issuerby_id='$department_id' AND is_active='Y' ORDER BY service_name ASC"; */
                    $activeServiceList=Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id WHERE issuerby_id='$department_id' AND is_active='Y' ORDER BY service_name ASC")->queryAll(); 
                    } ?>
              <?php
                    if (isset($activeServiceList) && !empty($activeServiceList)) {
                    $service_id=@$_GET['service_id'];
                    foreach ($activeServiceList as $servicedata) {
                    if(!empty($servicedata['core_service_name'])){
                    $serviceID= $servicedata['service_id'].".".$servicedata['servicetype_additionalsubservice'];
                    $serviceList[$serviceID]=$servicedata['core_service_name'];
                    }
                    }
                    } 
                    echo $form->dropDownList($model, 'service_id', $serviceList, array('class' => 'select2-me')); ?>
              <?php echo $form->error($model, 'service_id'); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <!--Add here land title-->
          <div class="form-group col-md-6">
            <label class="col-md-12 control-label" for="form_type" >Form Type
              <span class="red"> *
              </span>
            </label>
            <div class="col-md-12">
              <?php 
                    $formTypeList['']="Select Form Type";
                    $allList=InfowizardQuestionMasterExt::getMasterList('bo_infowiz_forms_type','id','form_type','is_active','Y');
                    foreach($allList as $key=>$value){
                    $formTypeList[$key]=$value; ?>
                                  <?php  } 
                    echo $form->dropDownList($model, 'form_type_id', $formTypeList, array('class' => 'select2-me')); ?>
              <?php echo $form->error($model, 'form_type_id'); ?>
            </div>
          </div>
          <!--Add here land title-->
          <div class="form-group col-md-6">
            <label class="col-md-12 control-label" for="form_name" >Form Name
              <span class="red"> *
              </span>
            </label>
            <div class="col-md-12">
              <?php echo $form->textField($model, 'form_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
              <?php echo $form->error($model, 'form_name'); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-12 control-label" for="is_active" >Is Active
              <span class="red"> *
              </span>
            </label>
            <div class="col-md-12">
              <select name="ServiceFormMapping[is_active]" class="form-control">
                <option value="Y">Y
                </option>
                <option value="N">N
                </option>
              </select> 
              <?php echo $form->error($model, 'is_active'); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <div class="col-md-12" style="text-align: right;">
              <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
            </div>
          </div>
        </div>
        <?php $this->endWidget(); ?>
      </div>
      <!-- form -->
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js">
</script>
<!-- Theme framework -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js">
</script>
<!-- Theme scripts -->
<script>
  $(document).ready(function(){
    if($("#department_id").val("<?php echo @$department_id; ?>").trigger('change')){
      $("#department_id").change(function(){
        window.location= "/backoffice/infowizard/serviceFormMapping/create/department_id/"+$("#department_id").val();
      });
    }
    return false;
  });
</script>






