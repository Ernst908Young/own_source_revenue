<?php
/* @Name: Rahul Kumar
  @Date: 11042018
 */
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
<div class="row" style="margin:10px 0 10px 0;">
    <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">Select Department:
        </label>
        <div class="col-md-12">	
            <select name="issuerby_id"  id="deptlist" onchange="window.location = '/backoffice/infowizard/subForm/subFormListing/id/' + this.value + '/' + document.getElementById('addPaging').value + ''">
                <option value="">Select Department
                </option>
                <?php if ($res_d) foreach ($res_d as $dep_arr) { ?>
                        <option value="<?php echo $dep_arr['issuerby_id']; ?>" 
                        <?php
                        if ($id == $dep_arr['issuerby_id']) {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $dep_arr['name']; ?>
                        </option>
    <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">Add More Pages:
        </label>
        <div class="col-md-12">	
            <select id="addPaging"  onchange="window.location = '/backoffice/infowizard/subForm/subFormListing/id/' + document.getElementById('deptlist').value + '/' + this.value">
                <option value="startPaging/1/endPaging/10" 
                        <?php if ($_GET['startPaging'] == "1" && $_GET['endPaging'] == "10") {
                            echo " selected";
                        } ?>>Page 1 to Page 10
                </option>
                <option value="startPaging/11/endPaging/20" 
                    <?php if ($_GET['startPaging'] == "11" && $_GET['endPaging'] == "20") {
                        echo " selected";
                    } ?>>Page 11 to Page 20
                                    </option>
                                    <option value="startPaging/21/endPaging/30" 
                                            <?php if ($_GET['startPaging'] == "21" && $_GET['endPaging'] == "30") {
                                                echo " selected";
                                            } ?>>Page 21 to Page 30
                                    </option>
                                    <option value="startPaging/31/endPaging/40" 
                                            <?php if ($_GET['startPaging'] == "31" && $_GET['endPaging'] == "40") {
                                                echo " selected";
                                            } ?>>Page 31 to Page 40
                                    </option>
                                    <option value="startPaging/41/endPaging/50" 
                                            <?php if ($_GET['startPaging'] == "41" && $_GET['endPaging'] == "50") {
                                                echo " selected";
                                            } ?>>Page 41 to Page 50
                                    </option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputEmail1" class="col-md-12 control-label">&nbsp;-
        </label>
        <div class="col-md-12">
            <a href="/backoffice/infowizard/formTypes/"> Add Form Type 
            </a> &nbsp; &nbsp; 
            <a href="/backoffice/infowizard/formCategory/" class="btn btn-primary" target="blank"> Add Category 
            </a>
        </div>
    </div>
</div>
<section class="panel site-min-height" style="display:">
    <header class="panel-heading">
        Department Services
    </header>
    <div class="panel-body">
        <div class="table">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="width:4%;vertical-align: middle; text-align: center; ">ID
                        </th>
                        <th style="width:20%;vertical-align: middle; text-align: center;">Service Name
                        </th>
                        <th style="width:10%;vertical-align: middle; text-align: center;">Type Of Form
                        </th>
                        <?php
                        $startPaging = @$_GET['startPaging'];
                        $endPaging = @$_GET['endPaging'];
                        for ($i = $startPaging; $i <= $endPaging; $i++) {
                            ?>
                            <th style="width:6%;vertical-align: middle; text-align: center;">Page-
                        <?php echo $i; ?>
                            </th>
                    <?php } ?>
                        <th style="width:16%;vertical-align: middle; text-align: center;">Action
                        </th>  
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($res_s)
                        foreach ($res_s as $key => $data_arr) {
                            $service_id = $data_arr['service_id'];
                            $sub_service_id = $data_arr['servicetype_additionalsubservice'];
                            if($data_arr['core_service_name'] != '') {
                              //  $formType = array('1' => 'Applicant Form', '2' => 'Processing Form','3' => 'Processing Form - 2');
                                $sqlQuery="SELECT id,form_type FROM `bo_infowiz_forms_type` where is_active='Y'";
                                $formType=Yii::app()->db->createCommand($sqlQuery)->queryAll();
								/* echo "<pre>";
								print_r($formType); */
                                
                                ?>
                                <!--<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/" method="GET">
                                    <input type="hidden" name="service_id"      value='<?php echo $service_id; ?>' />
                                    <input type="hidden" name="sub_service_id"  value='<?php echo $sub_service_id; ?>' />
                                    <input type="hidden" name="department_id"   value='<?php echo $id; ?>' />-->
							<?php 
								foreach($formType as $rdf) 
								{
									$key =$rdf['id'];
									$ft =$rdf['form_type'];
							?>
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center;">
                                            <?php echo $service_id . "." . $sub_service_id; ?>
                                            <?php
                                            $offline_flag = 0;
                                            $online_flag = 0;
                                            $swcs_flag = 0;
                                            $is_online = $data_arr['is_online'];
                                            $is_integrated_with_swcs = $data_arr['is_integrated_with_swcs'];
                                            if ($is_online == 'N') {
                                                $status_text = "Offline";
                                                $offline_flag = 1;
                                                $online_flag = 0;
                                                $swcs_flag = 0;
                                            } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'Y') {
                                                $status_text = "Integrated With SWCS";
                                                $offline_flag = 0;
                                                $online_flag = 0;
                                                $swcs_flag = 1;
                                            } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'N') {
                                                $status_text = "Online";
                                                $offline_flag = 0;
                                                $online_flag = 1;
                                                $swcs_flag = 0;
                                            }
                                            $status_text;
                                            $sID = $service_id . "." . $sub_service_id;
                                            $serviceFormData = InfowizardQuestionMasterExt::getServiceFormMapping("$sID", "$key");
											/* echo "<pre>";
											print_r($serviceFormData); */
                                           // $serviceFormID=$serviceFormData->form_id;
                                            ?>
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;" title="<?php echo $status_text; ?>">
                                        <?php echo $data_arr['core_service_name']; ?>
                                            <br>
                                            <a  href="javascript:void(0);" class="addForm" data-toggle="modal" data-target="#myModal2" frm_service_id="<?php echo $sID = $service_id . "." . $sub_service_id; ?>" frm_form_type_id="<?php echo $key; ?>" frm_form_name="<?php if (!empty($serviceFormData)) {  echo $serviceFormData->form_name; } ?>"> 
                                        <?php if (empty($serviceFormData)) {
                                            echo "Form Name";
                                        } else {
                                            echo $serviceFormData->form_name;
                                        } ?>
                                            </a>  
                                            <br> 
                                            <?php if (!empty($serviceFormData->form_code)) {
                                                echo @$serviceFormData->form_code;
                                            } ?>
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">
                                        <?php echo $ft; ?>
                                                                </td>
                                                                    <?php
                                                                    $mapped_docs = json_decode($data_arr['document_checklist_creation'], true);
                                                                    ?>
                                        <?php
                                        $startPaging = $_GET['startPaging'];
                                        $endPaging = $_GET['endPaging'];
                                        $applicationFormId = 1;
                                        for ($i = $startPaging; $i <= $endPaging; $i++) {
                                            ?>
                                            <td style="vertical-align: middle; text-align: center;"> 
                                        <?php $rt = InfowizardQuestionMasterExt::getFormPageId($service_id . "." . $sub_service_id, $key, $i) ? InfowizardQuestionMasterExt::getFormName($service_id . "." . $sub_service_id, $key, $i) : $i; ?>
                                                <a  href="javascript:void(0);" class="addPage" data-toggle="modal" data-target="#myModal" data-id="pg<?php echo $service_id . "_" . $sub_service_id . "_" . $i . "_" . $key; ?>" data-sr_id="<?php echo $service_id . "." . $sub_service_id; ?>" data-page_name="<?php echo $rt; ?>" data-frm_id="<?php echo $key; ?>" data-page_prefrence="<?php echo $i; ?>">
                                            <?php echo $rt; ?> 
                                                                        </a>  
                                            <?php $formpageID = InfowizardQuestionMasterExt::getFormPageId($service_id . "." . $sub_service_id, $key, $i);
                                            if (!empty($formpageID)) {
                                                ?>
                                                                            </hr>
                                                                            <a href="javascript:void(0);"  pageid="<?php echo (INT) $formpageID; ?>" class="addCat" data-toggle="modal" data-target="#myModal3" id="cat<?php echo $service_id . "_" . $sub_service_id . "_" . $i . "_" . $key; ?>" data-rows="10" data-page_cat_map="<?php echo $i; ?>" data-id="cat<?php echo $service_id . "_" . $sub_service_id . "_" . $i . "_" . $key; ?>" data-sr_id="<?php echo $service_id . "." . $sub_service_id; ?>" data-frm_id="<?php echo $key; ?>"  data-page_prefrence="<?php echo $i; ?>" href="javascript:void(0);" tabindex="0" 
                                                                               categoryval='<?php if(!empty($formpageID)){ echo $categoryData = InfowizardQuestionMasterExt::getCategoryServicePageMapping($formpageID);} ?>'> Category+
                                                                            </a>
                                            <?php } ?>
                                                                    </td>  
                                        <?php } ?>
                                        <td style="vertical-align: middle; text-align: center;">
                                        <?php  
										
										if (empty($serviceFormData)) {
                                          $formID = "";
                                          echo "-";
                                        } else {
                                           $formID = $serviceFormData->form_type_id; ?>
                                            <a href="/backoffice/infowizard/formBuilder/createform/service_id/<?php echo $service_id . "." . $sub_service_id; ?>/pageID/1/formCodeID/<?php echo $formID; ?>/formID/<?php echo $applicationFormId; ?>" target="blank">Capture Form-Fields 
                                            </a>
											<?php
											if($formID==1){
											?>	
											 <a href="/backoffice/infowizard/subForm/generateCertificate/service_id/<?php echo $service_id . "." . $sub_service_id; ?>/dept_id/<?php echo $_GET['id']; ?>" target="blank">Generate PDF Certificate 
                                            </a>
											<?php
											}
											?>
                                      <?php  } ?>
                                           
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
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
                            <!--<h4 class="modal-title formfieldheading">Add Categories</h4>-->
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
                                <!-- <input type="hidden" name="cat_form_code"  id="cat_form_code">-->
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
                                                            <option value="">Select category</option>
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
            $(function () {
                $(".addForm").click(function () {
                    var formtypeID = $(this).attr("frm_form_type_id")
                    $("#frm_form_type_id").val(formtypeID);
                    $("#frm_service_id").val($(this).attr("frm_service_id"));
                    $("#frm_form_name").val($(this).attr("frm_form_name"));
                    //$("#frmformtype option[value="+formtypeID+"]").attr("selected", "selected.");
                    $("#frmformtype2").val(formtypeID).trigger('change');
                    $("#frmformtype2").attr("disabled", "disabled");
                    // alert($(this).attr("frm_form_type_id"));
                    // alert($(this).attr("frm_form_type_id"));option[value="3"]').attr("selected", "selected");
                }
                );
                $(".addPage").click(function () {
                    var tyu = $(this).attr('id');
                    // alert(tyu);
                    var sr_id = $(this).data("sr_id");
                    //frm_id
                    var frm_id = $(this).data("frm_id");
                    var page_name = $(this).data("page_name");
                    var page_prefrence = $(this).data("page_prefrence");
                    $("#service_id").val(sr_id);
                    $("#form_id").val(frm_id);
                    $("#page_prefrence").val(page_prefrence);
                    $("#page_name").val(page_name);
                    //$(".formfieldheading").html();
                    get_form_code(sr_id, frm_id, page_prefrence);
                    // $('#myModal').modal('show'); 
                    $('#optionform').on('submit', function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'post',
                            url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subForm/saveAjax',
                            dataType: 'json',
                            data: $('#optionform').serialize(),
                            success: function (data) {
                                if (data.status) {
                                    //alert('form was submitted');
                                    $('#myModal').modal('hide');
                                    $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Save</div>');
                                    // alert( $("#"+tyu).html());
                                    // $("#"+tyu).html(data.page);
                                    location.reload();
                                    return false;
                                } else {
                                    $('#msg').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
                                }
                            }
                        }
                        );
                    }
                    );
                }
                );
            }
            );
            function get_form_code(sr_id, frm_id, page_prefrence) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {
                        service_id: sr_id, form_id: frm_id, prefrence: page_prefrence}
                    ,
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subForm/getFormCodeAjax",
                    success: function (data) {
                        if (data.data.status) {
                            $("#form_code").val(data.data.form_code);
                        }
                    }
                }
                );
            }
            $(document).ready(function () {
                $(".addPage").each(function (e) {
                    $(this).attr("id", "serfrm_" + e);
                }
                );
            }
            )
        </script>
        <script>
            $(function () {
                $(".addCat").click(function () {
                    $("#cat_service_id").val($(this).attr('data-sr_id'));
                    $("#cat_form_id").val($(this).attr('data-frm_id'));
                    $("#cat_page_id").val(parseInt($(this).attr('pageid')));
                    $(".categoryofform").val("").trigger('change'); 
                     $(".categoryhelptextofform").html("");
                    var categoryval = $(this).attr("categoryval");
                    var resultObj=JSON.parse(categoryval);
                   // alert(resultObj.toSource());
                     $.each(resultObj, function(k, v) {
                        //display the key and value pair
                      //  alert(v.toSource());
                       $.each(v, function(k1, v1) {
                           if(k1=="category_id"){
                             //  alert( $("#category_id_"+k).html());
                             $("#category_id_"+k).val(v1).trigger('change');                               
                           }
                            if(k1=="help_text"){
                              $("#category_helptext_id_"+k).html(v1);                                
                           }
                            // alert(k+"----"+k1 + ' is ' + v1);
                         });
                    });
                });
                $('#catform').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/saveAjax',
                        data: $('#catform').serialize(),
                        success: function (data) {
                            if (data) {
                                //alert('form was submitted');
                                $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Save</div>');
                            } else {
                                $('#msg').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
                            }
                        }
                    }
                    );
                }
                );
            }
            );
            function delete_option(id) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {
                        "option_id": id}
                    ,
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/deleteAjax",
                    success: function (data) {
                        if (data.flag) {
                            //alert('form was submitted');
                            $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Delete</div>');
                        } else {
                            $('#msg').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
                        }
                    }
                }
                );
            }
            ;
            function get_options(id, rows) {
                var wrapper = $(".upload_files_row");
                //Fields wrapper 
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    data: {
                        id: id, rows: rows}
                    ,
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/allPageCatAjax",
                    success: function (data) {
                        var option_html = '';
                        var html = '';
                        //console.log(data.data);
                        // html +='<div class="row"><div class="col-md-4" style="text-align:right; margin-bottom:10px;"> &nbsp;</div><div class="col-md-4" style="margin-bottom:10px;">&nbsp;</div><div class="col-md-4"><button class="add_more btn btn-success"><i class="fa fa-plus-square-o"></i> Add More Options</button></div></div>';
                        $(wrapper).html(data);
                    }
                }
                );
            }
            $(".eremove_field").click(function () {
                $(this).closest('tr').remove();
            }
            )
            $('select:not(.normal)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                }
                );
            }
            );
            
           
        
     $(window).load(function(){
                $(".nav-toggle").click(function(e){  
                     $(this).next('ul').toggle();
                });
            });
    </script>
