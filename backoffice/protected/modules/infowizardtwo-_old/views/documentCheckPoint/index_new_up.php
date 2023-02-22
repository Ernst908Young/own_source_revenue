<!--<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/formCategory/create/')?>"><span>Add New Form Category</span></a>
</div></div>
--><?php @extract($_REQUEST);list($s_id, $sub_id) = explode(".",$sub);$sql111 = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$s_id' AND servicetype_additionalsubservice='$sub_id' AND is_active='Y'";	$connection = Yii::app()->db; 	$command = $connection->createCommand($sql111);	$row1111= $command->queryRow();?>
 <style>
.submit_btn {
    margin-left: 70px !important;
}
 </style>
<div class='portlet box green' style="display:;">
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Search Document Check Point </div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-issuer-master-form','action' => Yii::app()->createUrl('infowizard/documentCheckPoint/createNew'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

 <?php 
 
 ?>
 
    
	
	
    <div class="row" style="margin:10px 0 10px 0;">
 
	       <label class="col-sm-1 control-label" for="application_name" > 
			 <b>Code</b> </label>
			<div class="form-group col-md-2">
		    <input type="text" name="dcp_cc" id="dcp_cc" placeholder="DCP Code" class="form-control" onchange="getDCPName(this.value)" />
		    </div>
			<label class="col-sm-1 col-sm-1 control-label" for="application_name" > 
			 <b>Name</b> </label>
			<div class="form-group col-md-6">				<label class="control-label" for="dcp_name"id="dcp_name"> </label>
		    </div>

				<div class=" form-group col-md-2">					<input type="hidden" name="hd_field" id="hd_field" value="" >
					<input type="button" name="create" value="Add" onclick="addMee();" class="btn btn-primary submit_btn">
				</div>
		 
	</div> 

	 
			<div class="row form-group">		<div class="form-group col-md-12">		<hr style="margin-bottom:15px;">		<table class="table table-striped table-bordered table-hover" id="sample_111" >            <thead>            <tr>                <th align="center" style="text-align:center;">Select</th>				<!--<th>Department Name </th> --> 				 				<th>Code</th>                <th>Name</th>                 <th>File</th>                             </tr>            </thead>            <tbody>			<input type="hidden" name="did" id="did" value="<?php echo @$_REQUEST['did']; ?>" >			<input type="hidden" name="sub" id="sub" value="<?php echo @$_REQUEST['sub']; ?>" >            <?php              if(empty($apps)){                echo "<tr><td colspan='4'>No applications</td></tr>";              }              else{                $count=1;				$did = @$_REQUEST['did'];				$service_id = @$_REQUEST['sub'];				$main_arr=$dcp_arr1=$dcp_arr2=array();								$formsDataM =Yii::app()->db->createCommand("SELECT  * FROM  bo_infowiz_document_check_list_mapping WHERE docchk_id='".$did."'")->queryRow();										$formsDataS =Yii::app()->db->createCommand("SELECT  * FROM  bo_infowiz_document_check_list_mapping_new WHERE docchk_id='".$did."' AND service_id='$service_id' AND is_active='1'")->queryRow(); 										if($formsDataS){						$dcp_arr2 = json_decode($formsDataS['document_checklist_id']);					}if($formsDataM){						$dcp_arr1 = json_decode($formsDataM['document_checklist_id']);					}										if(count($dcp_arr1)>0 || count($dcp_arr2)>0){						$main_arr = array_merge($dcp_arr1,$dcp_arr2);						$main_arr = array_unique($main_arr);					}				//echo implode(",",$main_arr);				$i=1;				$leng = count($apps);                foreach ($apps as $key => $apps) {										$id = $apps['id'];					$strTxt='';					if($i == $leng && isset($_REQUEST['chk'])){						$strTxt = 'checked';					}					//echo '<pre>'; print_r($main_arr); 					$displayTxt = 'style="display:none;"';					if(in_array($id, $main_arr)){$displayTxt = 'style="display:;"';}                    ?>                    <tr id="<?=@$apps['code']?>" <?php echo $displayTxt; ?>>						<td align="center"><input id="chbx-<?=@$apps['code']?>" type="checkbox" class="ids" name="dcp_arr[]" value="<?php echo $id; ?>" <?php if(in_array($id, $main_arr)){ ?> checked <?php } ?> <?php echo $strTxt; ?> /></td>						<td><?=@$apps['code']?></td>                         <td><?=@$apps['name']?></td>                         <td>							<?php if($apps['file_path']!=''){ ?>							<a target="_blank" href="<?php echo $apps['file_path']; ?>" >View File </a>							<?php } ?>						</td> 						                     </tr>                 <?php									 $i++;               }                }            ?>			<tr>				<td colspan="4" align="center">					<input type="button" name="saveme" id="saveme" value="Save Mapping" class="btn btn-primary submit_btn" onclick="saveMapping();">				</td>			</tr>            </tbody>        </table>		</div>	</div>

<?php $this->endWidget(); ?>

</div></div></div> 
</div>
<!-- form -->
<script>function addMee(){		if($('#dcp_name').html() == 'NA'){		alert("Please enter valid document checkpoint code.");		return false;	}		$('#'+$('#dcp_cc').val()).show();	$('#chbx-'+$('#dcp_cc').val()).attr('checked','checked');	$('#dcp_name').html('');	$('#dcp_cc').val('');	// $('#dcp_name').load('https://caipotesturl.com/backoffice/infowizard/documentCheckPoint/getDCPNameSave/dcp/'+$('#dcp_cc').val());}function getDCPName(code){	if(code == ''){		alert("Please enter valid DCP code.");		return false;	}	$('#dcp_name').load('https://caipotesturl.com/backoffice/infowizard/documentCheckPoint/getDCPName/dcp/'+code);	}
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
  function saveMapping(){	    var ids = [];		$('.ids:checked').each(function(i, e) {			ids.push($(this).val());		});	  var did = $('#did').val();	  var sub = $('#sub').val();	  //var formData = new FormData(jQuery('#ajaxFrm'));	  jQuery.ajax({				type: "POST",				url: "/backoffice/infowizard/documentCheckPoint/NewCheckpointSave",				data:{did:did,sub:sub,ids:ids},			   success:  function(data) {				  				   if(data == 'success'){						window.location.reload();						return;				   }else{					alert(data);				   }				},			error:function(jqXHR, textStatus, errorThrown){				alert('error::'+errorThrown);			}	   });	    }
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
    TableDatatablesButtons.init();
});

function saveMe(){		var cdo = $('#DocumentCheckPointMaster_code').val();	var cdon = $('#DocumentCheckPointMaster_name').val();	var cdona = $('#DocumentCheckPointMaster_is_active').val();	if(cdon == ''){		alert("Name is required.");		return false;	}	  //var formData = new FormData(jQuery('#ajaxFrm'));	  jQuery.ajax({				type: "POST",				url: "/backoffice/infowizard/documentCheckPoint/NewCheckpointSaveMe",				data:{cdo:cdo,cdon:cdon,cdona:cdona},				//data:formData,			   success:  function(data) {				  TestMe(<?php echo @$_REQUEST['did']; ?>); return;				   if(data == 'success'){						//window.location.reload();						return;				   }else{					alert(data);				   }				},			error:function(jqXHR, textStatus, errorThrown){				alert('error::'+errorThrown);			}	   });	}


</script>