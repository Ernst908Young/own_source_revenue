
<style>
  .errorMessage {
    color:red }
</style>
 <?php $apps=InfowizardQuestionMasterExt::getIWListFormfield();    ?> 


<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
      <!-- select2 -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
	
        <!-- Theme framework -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	
<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4> <?php if($check==1) { echo "Create "; } else { echo  "Update ";} ?>Form Field</h4>
        </div>
        <br>
     
  
        <?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'user-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
'enableAjaxValidation'=>false,
'htmlOptions' => array('autoComplete'=>'off'),
)); ?>
        <div class="row">
    
<div class="col-md-6">
            <label for="application_name" >Parent Form Field
<i class="fa fa-question-circle" style="font-size:20px;" title="Form Field Parrent eg: Applicant Name is 'Parent' and Applicant First Name and Applicant Last Name is 'Child'"></i>
            </label>
         
              <select name="InfowizardFormvariableMaster[parent_id]" id="parent_id" class="select2-me" >
			  <option value="0">No Parent</option>
                <?php  $AllState = Yii::app()->db->createCommand("SELECT formvar_id,name,formchk_id FROM bo_infowizard_formvariable_master WHERE is_formvar_active='Y' AND parent_id=0 Order by name ASC")->queryAll();
					if (isset($AllState)) {
					foreach ($AllState as $v) {  ?>
                                        <option value="<?php echo $v['formvar_id'];?>" <?php if($model->parent_id==$v['formvar_id']){echo " selected";} ?> > <?php echo $v['formchk_id']." : ".$v['name']; ?></option>
					<?php }
					}
					?>
              </select>
          
          </div>
          <div class="col-md-6">
            <label  for="application_name" >Category</label>
          
              <select name="InfowizardFormvariableMaster[category_id]" id="category_id" class="select2-me" >
        <option value="">Select category</option>
                                  <?php $allList=InfowizardQuestionMasterExt::getMasterListTwoValue('bo_infowiz_form_categories','id','category_code','is_active','Y','category_name',' : '); ?>
                         <?php if(!empty($allList)){foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>"  <?php if($model->category_id==$k){ echo " selected";}?>><?php echo $v; ?></option>  
                         <?php }} ?>
              
              </select>
          </div>

		   
        </div>
       
       <br>
   
        <div class="row">
          <div class="col-md-6">
            <label for="application_name" >
              <?php echo $form->labelEx($model,'Form Field'); ?>
               <i class="fa fa-question-circle" style="font-size:20px;" title="This will appears in the form as form field"></i>
    
            </label>
           
              <?php echo $form->textField($model,'name',array('maxlength'=>1000,'autocomplete' => 'off','required'=>'required','class'=>'form-control')); ?>
              <?php echo $form->error($model,'name'); ?>
          
			
          </div>
		 
		
      
          <div class="col-md-6">
            <label  for="application_name">
              <?php echo $form->labelEx($model,'Is Active'); ?>
            </label>
          
              <?php echo $form->dropDownList($model,'is_formvar_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required','class'=>'form-control'));  ?>
              <?php echo $form->error($model,'is_formvar_active'); ?>
           
          </div>
        </div>

      <br>
          <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
      
        <?php $this->endWidget(); ?>
     <style type="text/css">
tr:nth-child(even) {
           background-color: #f2f2f2;
      }
       
    </style>

     <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_2'>
     <thead>

            <tr>

                <th>S.No.</th>

                <th>Form Field ID</th>

    <th>Form Field Name</th>
                
                <th>Category</th>

                <th>Active</th>

                <th>Created On</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            <?php

              if(empty($apps)){ 

                echo "<tr><td colspan='5'>No Form Field Check List</td></tr>";



              }

              else{

                $count=1;

                foreach ($apps as $key => $apps) {

                    ?>

                    <tr>

                <td align="center"><?=$count++;?></td>

        <td><?=$apps['formchk_id']?></td>

                <td><?=$apps['name']?></td>
                
                 <td><?php if($apps['category_id']==0){
                     echo "No Category";                     
                 }else{ 
                     echo $allList=InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories',$apps['category_id'],'category_name','id'); 
                     
                 } ?></td>

                <td><?=$apps['is_formvar_active']?></td>

                <td><?=$apps['created_date']?></td>

                <td><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/infowizardFormvariableMaster/viewlist/id/'.$apps['formvar_id'].'')?>" > View</a>||

                 <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/infowizardFormvariableMaster/update/id/'.$apps['formvar_id'].'')?>" > Edit</a>

                </td>

                

                   </tr>

                 <?php

               }

                }

            ?>



            </tbody>

        </table>
        
</div>


</div>
</div> 









 <?php
$base=Yii::app()->theme->baseUrl;
?>
    <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
      
        <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_2");

            e.dataTable({
                scrollX: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "Entries: _MENU_ ",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
               order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                  dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
            var e = new Datatable;
            e.init({
                src: $("#datatable_ajax"),
                onSuccess: function(e, t) {},
                onError: function(e) {},
                onDataLoad: function(e) {},
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 10,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                   
                    buttons: []
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {
                t.preventDefault();
                var a = $(".table-group-action-input", e.getTableWrapper());
                "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "No record selected",
                    container: e.getTableWrapper(),
                    place: "prepend"
                })
            }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {
                var t = $(this).attr("data-action");
                e.getDataTable().button(t).trigger()
            })
        };
    return {
        init: function() {
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
     $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');

   

});
</script>

<div id="loading-mask"></div>