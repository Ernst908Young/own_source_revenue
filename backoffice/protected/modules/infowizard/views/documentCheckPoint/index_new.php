<?php $docs = json_decode($apps['document_checklist_creation'],true); //echo '<pre>'; print_r($docs); die; @extract($_REQUEST);  $sql111 = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$s_id' AND servicetype_additionalsubservice='$sub_id' AND is_active='Y'";	$connection = Yii::app()->db; 	$command = $connection->createCommand($sql111);	$row1111= $command->queryRow(); ?>
	<style>
	.submit_btn{
		 margin-left: -383px;
	}
	</style>
<div class='portlet box green'>


<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Document CheckPoint Mapping - 		<?php echo $row1111['core_service_name']; ?> (<?php echo $s_id.".".$sub_id; ?>)	</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_11" >
            <thead>
            <tr>
                <th>S.No.</th>
				<th>Document Code</th>
				 
                <th>Issued By</th> 
				<th>Document Name</th>				<th>Multiple Version Allowed</th>				<th>Reference No. Required</th>				<th>Validity Required</th>
                <th>Is Document Required</th>                <th>Comment</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              if(empty($docs)){
                echo "<tr><td colspan='7'>NA</td></tr>";

              }
              else{
                $count=1;
                foreach ($docs as $key => $doc) {					$did = $doc['doc_id'];					$sql = "SELECT asm.name as iss_by_name, chk.name as dname, chk.chklist_id,chk.is_multi_version_allowed,chk.is_validity_required,chk.is_document_reference_no_required FROM bo_infowizard_documentchklist as chk INNER JOIN bo_infowizard_issuer_mapping as map ON map.issmap_id=chk.issmap_id INNER JOIN bo_infowizard_issuerby_master as asm ON asm.issuerby_id=map.issuerby_id WHERE chk.docchk_id='$did'";					$connection = Yii::app()->db; 					$command = $connection->createCommand($sql);					$row= $command->queryRow(); 
                    ?>
                    <tr>
						<td align="center"><?=$count++;?></td>  
                        <td><?=@$row['chklist_id']?></td> 
						<td><?=@$row['iss_by_name']?></td> 						<td><?=@$row['dname']?></td> 						<td><?=@$row['is_multi_version_allowed']?></td> 						<td><?=@$row['is_document_reference_no_required']?></td> 						<td><?=@$row['is_validity_required']?></td> 
						<td><?=@$doc['is_required']?></td>						<td><?=@$doc['doc_comment']?></td>
						<td>													<a href="#faqs_div" data-toggle="modal" onclick="openPopup('<?php echo $did; ?>','<?=@$row['chklist_id']?>','<?=@$row['dname']?>');">Document CheckPoint Mapping</a>							
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

<div id="faqs_div" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">	<div class="modal-header">          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>            <h4 class="modal-title">Document Check Points <span id="title_txt" style="font-weight:bold;"></span></h4>			<h5><?php echo $row1111['core_service_name']; ?> (<?php echo $s_id.".".$sub_id; ?>)  <span id="dspan"></span><h5>    </div>		<div class="col-lg-12" id="md_cont">	   <?php //echo '<pre>'; print_r($list_arr); ?>	</div>	</div>
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

<!-- BEGIN PAGE LEVEL PLUGINS --><link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" /><link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" /><!-- END PAGE LEVEL PLUGINS --> <!-- BEGIN PAGE LEVEL PLUGINS --><script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script><script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script><style>#faqs_div{	width:960px !important;	left:35% !important;}</style><!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">function openPopup(did,d_code,d_name){	///$('#md_cont').html(d_name+' ('+ d_code +')');	//var conteeee = load('/backoffice/dms/DepartmentDMS/actionGetDCP');	$('#dspan').html(' - '+d_name+' ( '+ d_code +' )');	$('#md_cont').load('https://caipotesturl.com/backoffice/infowizard/documentCheckPoint/indexNew/did/'+did+'/sub/<?php echo $s_id.".".$sub_id; ?>');}
function openPopupNew(){	$('#md_cont').html('');	var did = $('#did').val();	var sub = $('#sub').val();	var service_id = $('#infowiz_service_id').val();	var sub_service_id = $('#infowiz_sub_service_id').val();	if(did == ''){		alert("Document code is mandatory. Please select document code.");		return false;	}	if(sub == ''){		alert("Infowiz sub-version of document is required.");		return false;	}	if(service_id == ''){		alert("Infowiz service ID for applied service.");		return false;	}	if(sub_service_id == ''){		alert("Infowiz sub service id is mandatory.");		return false;	}}
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
function TestMe(did){		$('#md_cont').load('https://caipotesturl.com/backoffice/infowizard/documentCheckPoint/indexNew/did/'+did+'/sub/<?php echo $s_id.".".$sub_id; ?>/chk/1');	}



</script>