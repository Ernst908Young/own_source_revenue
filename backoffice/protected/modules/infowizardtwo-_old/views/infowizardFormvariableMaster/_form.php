
<style>
  .errorMessage {
    color:red }
</style>



<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
      <!-- select2 -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
	
        <!-- Theme framework -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'>
      </i>
      <?php if($check==1) { echo "Create "; } else { echo  "Update ";} ?>Form Field
    </div>
    <div class='tools'>
    </div>
  </div>
  <div class="portlet-body">
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
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
          <div class="form-group col-md-7">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Parent Form Field</label>
            <div class="col-md-8">
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
          </div>
		    <div class="col-md-5"> <i class="fa fa-question-circle" style="font-size:20px;margin-top:10px;" title="Form Field Parrent eg: Applicant Name is 'Parent' and Applicant First Name and Applicant Last Name is 'Child'"></i></div>
       
        </div>
          <div class="row">
          <div class="form-group col-md-7">
              <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Category</label>
            <div class="col-md-8">
              <select name="InfowizardFormvariableMaster[category_id]" id="category_id" class="select2-me" >
			  <option value="">Select category</option>
                          		    <?php $allList=InfowizardQuestionMasterExt::getMasterListTwoValue('bo_infowiz_form_categories','id','category_code','is_active','Y','category_name',' : '); ?>
                         <?php if(!empty($allList)){foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>"  <?php if($model->category_id==$k){ echo " selected";}?>><?php echo $v; ?></option>  
                         <?php }} ?>
              
              </select>
            </div>
          </div>
              
		<!--<div class="col-md-5"> <i class="fa fa-question-circle" style="font-size:20px;margin-top:10px;" title="Form Field Parrent eg: Applicant Name is 'Parent' and Applicant First Name and Applicant Last Name is 'Child'"></i></div>-->
       
        </div>
        <div class="row">
          <div class="form-group col-md-7">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
              <?php echo $form->labelEx($model,'Form Field'); ?>
            </label>
            <div class="col-md-8">
              <?php echo $form->textField($model,'name',array('maxlength'=>255,'autocomplete' => 'off','required'=>'required','class'=>'form-control')); ?>
              <?php echo $form->error($model,'name'); ?>
            </div>
			
          </div>
		  <div class="col-md-5"> <i class="fa fa-question-circle" style="font-size:20px;margin-top:10px;" title="This will appears in the form as form field"></i></div>
        </div>
		<!--<div class="row" style="display:none;">
          <div class="form-group col-md-7">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
              <?php //echo $form->labelEx($model,'Database Table Field Slug'); ?>
            </label>
            <div class="col-md-8">
              <?php //echo $form->textField($model,'column_name',array('maxlength'=>255,'autocomplete' => 'off','required'=>'required','class'=>'form-control','readonly'=>true)); ?> 
              <?php //echo $form->error($model,'column_name'); ?>
            </div>
          </div>
		   <div class="col-md-5"><i class="fa fa-question-circle" style="font-size:20px;margin-top:10px;" title="This can contain lower case,alphanumeric and underscore only"></i> &nbsp;<i class="fa fa-pencil updateslug" style="font-size:20px;margin-top:10px;cursor:pointer" title="If you wish you can change "></i> </div>
        </div>-->
		 <!--<div class="row">
         <div class="form-group col-md-7">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name">
              <?php //echo $form->labelEx($model,'Is Editable'); ?>
            </label>
            <div class="col-md-8">
              <?php //echo $form->dropDownList($model,'is_editable',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required','class'=>'form-control'));  ?>
              <?php //echo $form->error($model,'is_editable'); ?>
            </div>
          </div>
        </div>-->
        <div class="row">
          <div class="form-group col-md-7">
            <label class="col-lg-4 col-sm-4 control-label" for="application_name">
              <?php echo $form->labelEx($model,'Is Active'); ?>
            </label>
            <div class="col-md-8">
              <?php echo $form->dropDownList($model,'is_formvar_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required','class'=>'form-control'));  ?>
              <?php echo $form->error($model,'is_formvar_active'); ?>
            </div>
          </div>
        </div>
        <div class="row buttons" align="center">
          <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</div>
<!--<script>
$(document).ready(function(){
	// Function for edit slug
	$(".updateslug").click(function(){
	//	$('#InfowizardFormvariableMaster_column_name').removeAttr("readonly");
	});
	// Function for genrate slug on bsed on form label
	$("#InfowizardFormvariableMaster_name").on('blur','keyUp',function(){
	  $.ajax({
                                                    type: "POST",
                                                    data: $("#user-form").serialize(),
                                                    url: "<?=Yii::app()->createAbsoluteUrl("/infowizard/infowizardFormvariableMaster/slugify"); ?>",
                                                    success: function (data) {
                                                     alert(data);
                                                       }
                                                }); 	
	});
	
});
</script>-->
        
    <?php $apps=InfowizardQuestionMasterExt::getIWListFormfield();    ?> 
<style>
    .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -51px !important;
}
    
</style>
<div class="row">

<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardFormvariableMaster/create/')?>"><span>Add New Form Field</span></a>

</div></div>





<div class='portlet box green'>

<div class='portlet-title'>

    <div class='caption'>

        <i style=" font-size:20px;" class='fa fa-list'></i>List of Form Field</div>

    <div class='tools'> </div>

</div>

 <div class="portlet-body">

          <table class="table table-striped table-bordered table-hover" id="sample_2" >

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
<div id="loading-mask"></div>