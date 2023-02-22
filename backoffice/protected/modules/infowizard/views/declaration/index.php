<!--<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<1?=$this->createUrl('/infowizard/formCategory/create/')?>"><span>Add New Form Category</span></a>
</div></div>
-->
 <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js">
</script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js">
</script>

<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Create  Declaration Master</h4>
        </div>
        <br>



    <?php if(Yii::app()->user->hasFlash('error')): ?>

<div style="text-align: center; font-size: 20px; color: red;">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>

<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-issuer-master-form','action' => Yii::app()->createUrl('infowizard/declaration/create'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

 <?php 
  $servs =Yii::app()->db->createCommand("SELECT  * FROM  bo_information_wizard_service_parameters
    WHERE is_active='Y'")->queryAll();
$ser_list = [];
  if(isset($servs) && !empty($servs)){ 
	  foreach($servs as $cat_id=>$cat_name){
		  $ser_list[$cat_name['service_id'].'.'.$cat_name['servicetype_additionalsubservice']]=$cat_name['service_id'].'.'.$cat_name['servicetype_additionalsubservice'].' - '.$cat_name['core_service_name'];
	  }
  }

 ?>
 
    <div class="row">
		<div class="col-md-6">
		   <label  for="application_name" >Service<span class="required" aria-required="true"></span></label>
			
				<?php echo $form->dropDownList($model,'service_id',$ser_list,array('class'=>'select2-me','autocomplete' => 'off'));  ?>
				<?php echo $form->error($model,'service_id'); ?>
<br><br>
                <label  for="application_name">Option:<span class="required" aria-required="true">*</span></label>
           
            <?php echo $form->textField($model,'option',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required')); ?>
            <?php echo $form->error($model,'option'); ?>

		</div>
        <div class="col-md-6">
            <label for="application_name" > 
             Declaration Label:<span class="required" aria-required="true">*</span></label>
            
            <?php echo $form->textArea($model,'declaration_label',array('class'=>'form-control','rows'=>5,'autocomplete' => 'off','required'=>'required')); ?>
            <?php echo $form->error($model,'declaration_label'); ?>
        </div>		 
	
    
     
    
     
            
         
    </div> 

	 
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary submit_btn')); ?>


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
                <!--<th>Department Name </th> --> 
                 
                <th>service_id</th>
                <th>declaration_label</th>
                <th>option</th>
                <th>created_on</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              if(empty($apps)){
                echo "<tr><td colspan='4'>No applications</td></tr>";

              }
              else{
                $count=1;
                foreach ($apps as $key => $apps) {
                    ?>
                    <tr>
                        <td align="center"><?=$count++;?></td>  
                        <td><?=@$apps['service_id'] ?></td> 
                                    
                        <td><?=@$apps['declaration_label']?></td> 
                        <td><?=@$apps['option']?></td>
                                <td><?=@$apps['created_on']?></td>
                        
                        <td>
                            <!-- <a href="<1?php echo Yii::app()->createAbsoluteUrl('infowizard/declaration/view/id/'.$apps['id'].'')?>" >View </a>   -->
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/declaration/update/id/'.$apps['id'].'')?>" >Edit </a>
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

 


<script>
function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 33 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
          return false;
       }
       return true;
     }
	</script>

	



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