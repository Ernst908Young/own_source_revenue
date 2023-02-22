<?php
/* @Name: Rahul Kumar
  @Date: 04052018
 */
extract($_GET);
$onchangeUrl="window.location = '/backoffice/infowizard/serviceFormWorkflow/creation/service_id/' + document.getElementById('servicelist').value + '/workflowID/' + document.getElementById('addPaging').value + '/id/'+document.getElementById('deptID').value+''";
?>
<style>
    a:hover{
        color:#000;
    }
    .select2-display-none {
        z-index:10050 !important;
    }
    /* Important part */
    .modal-dialog{
        overflow-y: initial !important
    }
    .modal-body{
        height: 450px;
        overflow-y: auto;
    }
    th{
        vertical-align: middle;
        text-align: center;
    }

</style>
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js">
</script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js">
</script>
<!-- Theme scripts -->
<div class="row" style="margin-bottom:10px;">
    <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">Select Department:
        </label>
        <div class="col-md-12">	
            <select name="issuerby_id"  id="deptID" onchange="<?php echo $onchangeUrl; ?>">
                <option value="">Select Department</option>
                <?php if ($res_d) foreach ($res_d as $dep_arr) { ?>
                        <option value="<?php echo $dep_arr['issuerby_id']; ?>" 
                        <?php
                        if ($id == $dep_arr['issuerby_id']) {  echo 'selected'; }   ?>>
                        <?php echo $dep_arr['name']; ?>
                        </option>
    <?php } ?>
            </select>
        </div>
    </div>
  <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">Select Service:
        </label>
         <div class="col-md-12">
              <?php $serviceList['']="Select Service"; $department_id=0;$department_id=@$_GET['id'];
                    if(isset($department_id) && $department_id>0){
                    $activeServiceList=Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_service_master as sm INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id WHERE issuerby_id='$department_id' AND is_active='Y' ORDER BY service_name ASC")->queryAll(); 
                    } ?>
              <?php
                    if (isset($activeServiceList) && !empty($activeServiceList)) {
                  if(isset($_GET['service_id'])) 
                      $service_id=@$_GET['service_id'];
                  else
                      $service_id=0;
                    foreach ($activeServiceList as $servicedata) {
                    if(!empty($servicedata['core_service_name'])){
                    $serviceID= $servicedata['service_id'].".".$servicedata['servicetype_additionalsubservice'];
                    $serviceList[$serviceID]=$servicedata['core_service_name'];
                    }
                    }
                    }
                    
                   ?>
               <select name="service_id"  id="servicelist" onchange="<?php echo $onchangeUrl;?>">
               
                </option>
                <?php if ($serviceList) foreach ($serviceList as $keyasserviceID=>$valueasServiceName) { ?>
                        <option value="<?php echo $keyasserviceID; ?>" 
                        <?php
                        if (@$service_id== @$keyasserviceID) {
                            echo ' selected';
                        }
                        ?>>
                        <?php echo $valueasServiceName; ?>
                        </option>
    <?php } ?>
            </select>
            </div>
    </div>
    <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">Workflow ID
        </label>
        <div class="col-md-12">	
            <select id="addPaging"  onchange="<?php echo $onchangeUrl; ?>">
                <?php for($i=1;$i<=100;$i++){ ?>
                <option value="<?php echo $i;?>" <?php  if($i==$_GET['workflowID']){ echo " selected"; } ?> "><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
  
</div>
<?php 
 if(isset($serviceID) && $serviceID>0){
$allMappedService=Yii::app()->db->createCommand("SELECT form_name,form_code FROM bo_infowiz_form_mapping where service_id='$service_id'")->queryAll(); 
}
?>
<section class="panel site-min-height" style="display:">
    <header class="panel-heading">
        Department Services
    </header>
    <div class="panel-body">
        <div class="table table-scrollable">
            <table class="table table-bordered table-responsive" width="100%">
                <thead>
                    <tr>
                        <th style="width:4%;vertical-align: middle; text-align: center; ">ID
                        </th>
                        
                        <?php
                        $startPaging = 1;
                        $endPaging = 10;
                        for ($i = $startPaging; $i <= $endPaging; $i++) {
                            ?>
                            <th style="width:6%;vertical-align: middle; text-align: center;">Step-<?php echo $i; ?> </th>
                            <th style="width:6%;vertical-align: middle; text-align: center;">Condition </th>                       
                    <?php } ?>
                          
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                          <?php
                        $startPaging = 1;
                        $endPaging =10;
                        for ($i = $startPaging; $i <= $endPaging; $i++) {
                            ?>
                        <td style="width:6%;vertical-align: middle; text-align: center;"><select><option>Select Form</option><?php if(!empty($allMappedService)) {    print_r($allMappedService);  foreach($allMappedService as $serviceData) { ?><option value="<?php echo @$serviceData['form_code']; ?>"><?php echo @$serviceData['form_name']; ?></option><?php }} ?> </select></td>
                        <td style="width:6%;vertical-align: middle; text-align: center;"><select><option>No Condition</option></select></td>                       
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
            <p style="text-align:center;"><input type="submit" class="btn btn-success" value="Save">
                            </p>
            </section> 
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title formfieldheading">Add Page
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div id="msg"> 
                            </div>
                            <div class="form form-horizontal" role="form"> 
                                <form id="optionform" >
                                    <div class="row">
                                        <div class="padding_left form-group col-md-8">&nbsp;
                                        </div>
                                    </div>
                                    <input type="hidden" name="form_id"    id="form_id">
                                    <input type="hidden" name="service_id" id="service_id">
                                    <input type="hidden" name="prefrence"  id="page_prefrence">
                                    <input type="hidden" name="form_code"  id="form_code">
                                    <div class="row"> 
                                        <div class="form-group">   
                                            <label class="col-md-4 col-sm-4 control-label" for="application_name">Page Name &nbsp;
                                            </label>
                                            <div class="col-md-6 col-sm-6 form-group">
                                                <input type="text" class="form-control" name="page_name" id="page_name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-4  control-label" for="application_name">&nbsp;
                                            </label>
                                            <div class="col-md-4">
                                                <input type="submit" class="btn btn-success" value="Save">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div id="myModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title formfieldheading">Add Form Name
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div id="msg"> 
                            </div>
                            <div class="form form-horizontal" role="form"> 
                                <form id="optionform2" action="<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/SaveServiceFormMapping" method="POST">
                                    <div class="row">
                                        <div class="padding_left form-group col-md-8">&nbsp;
                                        </div>
                                    </div>
                                    <input type="hidden" name="frm_form_type_id"    id="frm_form_type_id">
                                    <input type="hidden" name="frm_service_id" id="frm_service_id">
                                    <div class="row"> 
                                        <div class="form-group">   
                                            <label class="col-md-4 col-sm-4 control-label" for="application_name">Form Name &nbsp;
                                            </label>
                                            <div class="col-md-6 col-sm-6 form-group">
                                                <input type="text" class="form-control" name="form_name" id="frm_form_name" placeholder="Enter Form Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="form-group">   
                                            <label class="col-md-4 col-sm-4 control-label" for="application_name">Form Type &nbsp;
                                            </label>
                                            <div class="col-md-6 col-sm-6 form-group">
                                                <select name="form_type" class=" required" id="frmformtype2">
                                                    <option value=""> Select Type Of Form
                                                    </option>
                                                    <option value="1"> Applicant Form
                                                    </option>
                                                    <option value="2"> Processing Form 
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-4  control-label" for="application_name">&nbsp;
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="submit" class="btn btn-success" value="Save">
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                            <!-- form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------Categories----------->
        <!-- Modal -->
        <div id="myModal3" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/saveCategory" method="POST">   
                        <div class="modal-header" style="border-bottom:0px;padding-bottom: 0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                             <table class="table table-striped table-responsive" style="max-height:300px !important;margin-bottom:0px;">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle; text-align: center; " width="5%">S.No
                                        </th>
                                        <th width="60%">Category Name
                                        </th>
                                        <th width="30%">Category Help-Text
                                        </th>
                                        <th width="5%">Action 
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="modal-body" style="padding-top:0px;">   
                            <div class="form form-horizontal" role="form">
                                <input type="hidden" name="cat_page_id"    id="cat_page_id">
                                <input type="hidden" name="cat_service_id" id="cat_service_id">
                                <input type="hidden" name="cat_prefrence"  id="cat_page_prefrence">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-responsive" style="max-height:300px !important;">
                                            <thead style="display:none;">
                                                <tr>
                                                    <th style="vertical-align: middle; text-align: center; ">S.No
                                                    </th>
                                                    <th width="60%">Category Name
                                                    </th>
                                                    <th width="30%">Category Help-Text
                                                    </th>
                                                    <th width="5%">Action 
                                                    <th>
                                                </tr>
                                            </thead>
                                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                                <tr>
                                                    <td width="5%" >
                                                <?php echo $i + 1; ?>
                                                    </td>
                                                    <td width="60%" >
                                                        <select name="category_id[]" id="category_id_<?php echo $i; ?>" class="select2-me categoryofform" >
                                                            <option value="">Select category
                                                            </option>
                                                                <?php //$allList = InfowizardQuestionMasterExt::getMasterList('bo_infowiz_form_categories', 'id', 'category_name'); ?>
                                                            <?php $allList = InfowizardQuestionMasterExt::getMasterListTwoValue('bo_infowiz_form_categories', 'id', 'category_code','is_active','Y','category_name'); ?>
                                                                <?php foreach ($allList as $k => $v) { ?>
                                                                <option value="<?php echo $k; ?>">
                                                                <?php echo $v; ?>
                                                                </option>  
                                                                <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td width="30%" >
                                                        <textarea rows="1" name="help_text[]" id="category_helptext_id_<?php echo $i; ?>" class="categoryhelptextofform">
                                                        </textarea>
                                                    </td>
                                                    <td width="5%" >
                                                        <a href="javascript:void(0);" id="<?php echo $i; ?>" class="eremove_field">
                                                            <i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;">
                                                            </i> 
                                                        </a> 
                                                    </td>
                                                </tr>  
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- form -->
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Save Categories">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!----- END  -->
        <script>
            
            $(document).ready(function(){
             //   $("#deptID").val("<?php //echo @$_GET['id']?>").trigger('change');
             $('select:not(.normal)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                }
                );
            });
            });
            
           
        
     $(window).load(function(){
                $(".nav-toggle").click(function(e){  
                     $(this).next('ul').toggle();
                });
            });
    </script>
