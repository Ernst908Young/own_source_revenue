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

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create  Declaration Master </div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">
<div class="site-min-height">
<div class="form form-horizontal" role="form">

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
 
    <div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" >Service<span class="required" aria-required="true"></span></label>
				<div class=" form-group col-md-4">
					<?php echo $form->dropDownList($model,'service_id',$ser_list,array('class'=>'select2-me','autocomplete' => 'off'));  ?>
					<?php echo $form->error($model,'service_id'); ?>
				</div>
		 
	</div>
	
	
    <div class="row" style="margin:10px 0 10px 0;">
 
	 
			<label class="col-lg-2 col-sm-2 control-label" for="application_name" > 
			 Declaration Label:<span class="required" aria-required="true">*</span></label>
			<div class="form-group col-md-4">
		    <?php echo $form->textArea($model,'declaration_label',array('class'=>'form-control','rows'=>5,'autocomplete' => 'off','required'=>'required')); ?>
		    <?php echo $form->error($model,'declaration_label'); ?>
		    </div>
		 
	</div> 

<div class="row" style="margin:10px 0 10px 0;">
 
     
            <label class="col-lg-2 col-sm-2 control-label" for="application_name" > 
             Option:<span class="required" aria-required="true">*</span></label>
            <div class="form-group col-md-4">
            <?php echo $form->textField($model,'option',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required')); ?>
            <?php echo $form->error($model,'option'); ?>
            </div>
         
    </div> 


	<!-- <div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" ><1?php echo $form->labelEx($model,'is_active ?'); ?><span class="required" aria-required="true">*</span></label>
				<div class=" form-group col-md-4">
					<1?php echo $form->dropDownList($model,'is_active',array(1=>'Y',0=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<1?php echo $form->error($model,'is_active'); ?>
				</div>
		 
	</div> -->

	<div class="row form-group buttons" align="center">
	 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary submit_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div></div> 
</div>
<!-- form -->
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

	<style>
	.submit_btn{
		 margin-left: -383px;
	}
	</style>

<div class='portlet box green'>


<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>List of Declaration Master</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
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


 <?php
$base=Yii::app()->theme->baseUrl;
?>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->


<script type="text/javascript">
  
  var TableDatatablesButtons = function() {
    var e = function() {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }, {
                    extend: "colvis",
                    className: "btn dark btn-outline",
                    text: "Columns"
                }],
                responsive: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        t = function() {
            var e = $("#sample_2");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                },  {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "excel",
                    className: "btn default"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        a = function() {
            var e = $("#sample_3"),
                t = e.dataTable({
                    language: {
                        aria: {
                            sortAscending: ": activate to sort column ascending",
                            sortDescending: ": activate to sort column descending"
                        },
                        emptyTable: "No data available in table",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries found",
                        infoFiltered: "(filtered1 from _MAX_ total entries)",
                        lengthMenu: "_MENU_ entries",
                        search: "Search:",
                        zeroRecords: "No matching records found"
                    },
                    buttons: [{
                        extend: "print",
                        className: "btn dark btn-outline"
                    }, {
                        extend: "copy",
                        className: "btn red btn-outline"
                    }, {
                        extend: "pdf",
                        className: "btn green btn-outline"
                    }, {
                        extend: "excel",
                        className: "btn yellow btn-outline "
                    }, {
                        extend: "csv",
                        className: "btn purple btn-outline "
                    }, {
                        extend: "colvis",
                        className: "btn dark btn-outline",
                        text: "Columns"
                    }],
                    responsive: !0,
                    order: [
                        [0, "asc"]
                    ],
                    lengthMenu: [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"]
                    ],
                    pageLength: 10
                });
            $("#sample_3_tools > li > a.tool-action").on("click", function() {
                var e = $(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        },
        n = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            });
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
                    order: [
                        [1, "asc"]
                    ],
                    buttons: [{
                        extend: "print",
                        className: "btn default"
                    }, {
                        extend: "copy",
                        className: "btn default"
                    }, {
                        extend: "pdf",
                        className: "btn default"
                    }, {
                        extend: "excel",
                        className: "btn default"
                    }, {
                        extend: "csv",
                        className: "btn default"
                    }, {
                        text: "Reload",
                        className: "btn default",
                        action: function(e, t, a, n) {
                            t.ajax.reload(), alert("Datatable reloaded!")
                        }
                    }]
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
            jQuery().dataTable && (e(), t(), a(), n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});




</script>