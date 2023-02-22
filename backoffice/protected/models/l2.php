<?php
include("/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarStateMonitering.php");
include("/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/filter_financialYear.php");

$status = explode(",", $statusaa); //print_r($status); 
$countvalue = count($status);
?>                 
<style>
<?php if (!in_array("'A'", $status)) { ?> .approved{display: none;}  <?php } ?> 
<?php if (!in_array("'P'", $status)) { ?> .pending{display: none;}  <?php } ?>
<?php if (!in_array("'F'", $status)) { ?> .forwarded{display: none;}  <?php } ?> 
<?php if (!in_array("'R'", $status)) { ?> .rejected{display: none;}  <?php } ?>
<?php if (!in_array("'I'", $status)) { ?> .incomplete{display: none;}  <?php } ?>
<?php if (!in_array("'RBI'", $status)) { ?> .reverted{display: none;}  <?php } ?>
<?php if ($countvalue == 1) { ?> .total{display: none;}  <?php } ?>
</style>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>Service Report
		</div>
        <div class='tools'> </div>
    </div>
    <div class="portlet-body">
        <table class="table table-bordered table-hover" id="sample_2" >
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Department</th>
                    <th>Service</th>
                    <th class="pending">Inprocess</th>
                    <th class="forwarded">Forwarded</th>
                    <th class="reverted">Reverted</th>
                    <th class="rejected">Rejected</th>
                    <th class="approved">Approved</th>                   
                    <th class="total">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count_new = 0;
                if (empty($departmentList)) {
                    echo "<tr><td colspan='8'>No Detail Found</td></tr>";
                } else {
                    $count = 0;
                    $grands=0;
                    $grandp=0;
					$grandf=0;
					$grandr=0;
					$grandrj=0;
					$granda=0;
					$grandt=0;
                    foreach($departmentList as $key => $dephghg) {
                            $count++;
                            $department = $dephghg['infowiz_dept_id'];
                            $service = ServiceMappingController::getServiceList($department);
                            $service_count = count($service);
							$p=0;
                            $f=0;
                            $r=0;
                            $rj=0;
                            $a=0;
                            foreach($service as $keygf => $servicehgfhg) {
                                $serviceId = $servicehgfhg['infowiz_service_id'];
                                $key = $servicehgfhg['infowiz_service_name'];
                            } 
							$pendings = ServiceMappingController::getAllServiceMapping("'P'", $date1,$date2,$department);
							$forwarded =ServiceMappingController::getAllServiceMapping("'F'", $date1,$date2,$department);
							$reverted =ServiceMappingController::getAllServiceMapping("'RBI'", $date1,$date2,$department); 
							$rejected =ServiceMappingController::getAllServiceMapping("'R'", $date1,$date2,$department); 
							$approved =ServiceMappingController::getAllServiceMapping("'A'", $date1,$date2,$department);
							
							
                            ?>
                                <?php $count_new = $count_new + 1; ?>
                            <tr>
                                <td><?php echo $count_new; ?></td>
                                <td title=<?php echo $dephghg['name']; ?>>
									<?php if (isset($dephghg['name'])) {
											echo $dephghg['name'];
									}?>
								</td>
                                <td align="center"><?php echo $service_count; ?></td>
                                <td align="center" class="pending"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/P/d1/' . $date1 . '/d2/' . $date2 . '') ?>" > <?php if(!empty($pendings[0])){ echo $p=count($pendings); }else{echo "0";}?></a>
								</td>
                                <td align="center" class="forwarded"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/F/d1/' . $date1 . '/d2/' . $date2 . '') ?>" ><?php if(!empty($forwarded[0])){  echo $f=count($forwarded);}else{echo "0";} ?></a>								
								</td>
                                <td align="center" class="reverted"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/RBI/d1/' . $date1 . '/d2/' . $date2 . '') ?>" ><?php if(!empty($reverted[0])){ echo $r=count($reverted);}else{ echo "0";} ?></a>
								</td>
                                <td align="center" class="rejected"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/R/d1/' . $date1 . '/d2/' . $date2 . '') ?>" ><?php if(!empty($rejected[0])){echo $rj=count($rejected);}else{ echo "0";} ?></a>
								</td>
                                <td align="center" class="approved"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/A/d1/' . $date1 . '/d2/' . $date2 . '') ?>" ><?php if(!empty($approved[0])){ echo $a=count($approved); }else{echo "0";}?></a>
								</td>
                                <td align="center" class="total"><a href="<?php echo Yii::app()->createAbsoluteUrl('mis/serviceMapping/index/d/' . $department . '/s/T/d1/' . $date1 . '/d2/' . $date2 . '') ?>" >
								<?php echo $p+$f+$r+$rj+$a;
								$grands=$grands+$service_count;	
								$grandp=$grandp+$p;
								$grandf=$grandf+$f;
								$grandr=$grandr+$r;
								$grandrj=$grandrj+$rj;
								$granda=$granda+$a;								
								$grandt=$grandp+$grandf+$grandr+$grandrj+$granda;
								
								?>
								</a>
								</td>

                            <?php 
                    }
                    ?>
                    <tr>
                        <td class="sorting_disabled" style="visibility:hidden"><?php echo ++$count; ?></td>
                        <td align="left" ><b>Grand Total : </b></td>
                        <td align="center"  class="services"><?php echo $grands; ?></td>
                        <td align="center"  class="pending"><b><?php echo $grandp; ?></b></td>
                        <td align="center" class="forwarded" ><b><?php echo $grandf; ?></b></td>
                        <td align="center" class="reverted" ><b><?php echo $grandr; ?></b></td>
                        <td align="center" class="rejected" ><b><?php echo $grandrj; ?></b></td>
                        <td align="center" class="approved" ><b><?php echo $granda; ?></b></td>
                        <td align="center" class="total" ><b><?php echo $grandt; ?></b>
						</td>
                    </tr>
			<?php } ?>
            </tbody>
        </table>
    </div>
    <!------------------------------------------End All----------------->
</div>
<?php
$base = Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $base ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $base ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<?php Yii::app()->theme->baseUrl; ?>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
	var TableDatatablesButtons = function () {
		var e = function () {
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
		t = function () {
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
					zeroRecords: "No matching records found",
					bsort: true
				},

				// For Service Module Mapping - Ends Here Rahul Kumar : 02052018
				"fnDrawCallback": function (oSettings) {
					//alert( 'DataTables has redrawn the table' );
					$(".services_list").click(function () {
						var service_id = $(this).data("service_id");
						$.ajax({

							type: "POST",
							url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subServiceTagMapping/subServicelist",

							data: {service_id: service_id},
							success: function (data) { //alert(data);
								$('#sub_service_name_list').html('');
								$('#sub_service_name_list').html(data);

							},
							complete: function (data) {
								submitme();
							}
						});


					});
				},
//For Service Module Mapping - Ends Here Rahul Kumar : 02052018
				"aoColumnDefs": [
					{
						"bSortable": false,
						"aTargets": ["sorting_disabled"]
					}
				],
				buttons: [{

						extend: "print",
						orientation: 'landscape',
						filename: '<?php $fileName = "report";
echo "report" . ".pdf"; ?>',
						className: "btn default",

						exportOptions: {
							columns: ':visible',
						},
						customize: function (win) {
							$(win.document.body).find('table').addClass('display').css('font-size', '10px');
							$(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
								$(this).css('background-color', '#D0D0D0');
							});
							$(win.document.body).find('h1').css('text-align', 'center');
							$(win.document.body).find('h1').css('font-size', '14');
							$(win.document.body).find('h1').css('background-color', '#fff');
							$(win.document.body).find('h1').html("<?php echo $fileName; ?>");
							$(win.document.body).css('background-color', '#fff');
						}

					}, {
						extend: "pdf",
						orientation: 'landscape',
						filename: '<?php echo $fileName . ".pdf"; ?>',
						className: "btn default"
					}, {
						extend: "excel",
						filename: '<?php echo $fileName . ".xls"; ?>',
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
		a = function () {
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
			$("#sample_3_tools > li > a.tool-action").on("click", function () {
				var e = $(this).attr("data-action");
				t.DataTable().button(e).trigger()
			})
		},
		n = function () {
			$(".date-picker").datepicker({
				rtl: App.isRTL(),
				autoclose: !0
			});
			var e = new Datatable;
			e.init({
				src: $("#datatable_ajax"),
				onSuccess: function (e, t) {},
				onError: function (e) {},
				onDataLoad: function (e) {},
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
							action: function (e, t, a, n) {
								t.ajax.reload(), alert("Datatable reloaded!")
							}
						}]
				}
			}), e.getTableWrapper().on("click", ".table-group-action-submit", function (t) {
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
			}), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
				var t = $(this).attr("data-action");
				e.getDataTable().button(t).trigger()
			})
		};
		return {
			init: function () {
				jQuery().dataTable && (e(), t(), a(), n())
			}
		}
	}();
	jQuery(document).ready(function () {
		TableDatatablesButtons.init()
	});
	$(".alert-danger").css('display', 'none');
	$('.caption').css('padding-top', '10px');
</script>