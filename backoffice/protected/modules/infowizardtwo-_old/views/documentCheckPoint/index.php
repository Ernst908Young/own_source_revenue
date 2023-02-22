<!--<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/formCategory/create/')?>"><span>Add New Form Category</span></a>
</div></div>
-->
 <style>
.submit_btn {
    margin-left: 70px !important;
}
 </style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create  Document Check Point Master </div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<form role="form" action="<?php echo Yii::app()->createUrl('infowizard/documentCheckPoint/create'); ?>" enctype="multipart/form-data" method="post" id="submit_form" name="submit_form">

 <?php 
 
 ?>
 
    
	
	
    <div class="row" style="margin:10px 0 10px 0;">
 
	       <label class="col-sm-1 control-label" for="application_name" > 
			 code : <span class="required" aria-required="true">*</span></label>
			<div class="form-group col-md-2">						<input class="form-control" size="50" maxlength="200" autocomplete="off" required="required" readonly="readonly" onclick="return lettersOnly()" name="DocumentCheckPointMaster[code]" id="DocumentCheckPointMaster_code" type="text" value="<?php echo $model->code; ?>">
		    			<?php //echo $form->textField($model,'code',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required','readonly' => 'on','onclick'=>'return lettersOnly()')); ?>
		    <?php //echo $form->error($model,'code'); ?>
		    </div>
			<label class="col-lg-1 col-sm-1 control-label" for="application_name" > 
			 Enter name : <span class="required" aria-required="true">*</span></label>
			<div class="form-group col-md-6">			<textarea class="form-control" rows="6" cols="250" autocomplete="off" required="required" onclick="return lettersOnly()" name="DocumentCheckPointMaster[name]" id="DocumentCheckPointMaster_name"></textarea>			
		    <?php //echo $form->textArea($model,'name',array('class'=>'form-control','rows' => 6, 'cols' => 250,'autocomplete' => 'off','required'=>'required','onclick'=>'return lettersOnly()')); ?>
		    <?php //echo $form->error($model,'name'); ?>
		    </div>
			<label class="col-lg-1 col-sm-1 control-label" for="application_name" >Is active?<span class="required" aria-required="true">*</span></label>
				<div class=" form-group col-md-1">					<select class="form-control" autocomplete="off" required="required" name="DocumentCheckPointMaster[is_active]" id="DocumentCheckPointMaster_is_active">					<option value="Y">Y</option>					<option value="N">N</option>					</select>
										<?php //echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<?php //echo $form->error($model,'is_active'); ?>					<?php //if(isset($_REQUEST['q'])){  ?>										<div style="float:left; width:50px; margin-top:20px;">					<input type="file" style="width:30px;display:none;" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads">						  <label for="doc_uploads" style="margin-right:10px;">							<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file</span>						  </label>					</div>					<?php //} ?>
				</div>
		 
	</div> 

	 
	<div class="row form-group buttons" align="center">
	 <input class="btn btn-primary submit_btn" type="submit" name="yt0" value="Submit">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary submit_btn')); ?>
	</div>

<?php //$this->endWidget(); ?>
</form>
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
        <i style=" font-size:20px;" class='fa fa-list'></i>List of Document Check Point Master</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <tr>
                <th>S.No.</th>
				<!--<th>Department Name </th> --> 
				 
				<th>Code</th>                <th>Name</th> 

                <th>Active</th>
                <th style="text-align:center;">Action</th>
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
						<td><?=@$apps['code']?></td>                         <td><?=@$apps['name']?></td> 

						<td><?=@$apps['is_active']?></td>
						<td>
							<a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/documentCheckPoint/view/id/'.$apps['id'].'')?>" >View </a>  |
							<a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/documentCheckPoint/update/id/'.$apps['id'].'')?>" >Edit </a> 							<?php if($apps['file_path']!=''){ ?>							 | <a target="_blank" href="<?php echo $apps['file_path']; ?>" >View File </a>							<?php } ?>
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