<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017
// 
//By Rahul Kumar
//Date - 04052018
// Description of Change : New Mapping with sub_service_id 
//echo '<!--<pre>===='; print_r($res_s).'<pre>-->'; 
?>
<style>
    .alert-danger{display:none;}
    a:hover{ color:#000;}
    .dt-buttons {
        margin-top: 60px !important;
    }
    #484_0{display: none;}
    .urlcheckmsg{
		font-size: 14px !important;
		color:#F00;
	}
	.dataTables_wrapper .dt-buttons{
		margin-right: 16px;
		margin-top: -64px !important;
	}

	}
</style>
<?php
$cls = "PES";
if (isset($_GET['is']) && $_GET['is'] != '')
    $is = $_GET['is'];
else
    $is = "no";


if (isset($_GET['is']) && ($_GET['is'] == 'SE')) {
    $cls = "PES";
	if(DefaultUtility::isInvestorLoggedIn())
	{
		include('/var/www/html/backoffice/themes/investuk/views/layouts/pageBarServiceExisting.php');
	}else{
		include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarServiceExisting.php');
	}	
} else {
	if(DefaultUtility::isInvestorLoggedIn())
	{
		include('/var/www/html/backoffice/themes/investuk/views/layouts/pageBarService.php');
	}else{
		include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarService.php');
	}	
}
?>



<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i> <?php
            if ($type == 'BM')
                echo "Application for Name Services";
            if ($type == 'Incop')
                echo "Application for Incorporation Services";
            if ($type == 'Cont')
                echo "Application for Continuance Services";
            if ($type == 'Amal')
                echo "Application for Amalgamation Services";
            if ($type == 'ClS')
                echo "Application for Closure Services";
            if ($type == 'OS')
                echo "Application for Other Services";
            ?>
        </div>
        <div class='tools'> </div>
    </div>
    <div class="portlet-body">
        <div class="panel-body">
				<table class="table table-bordered" width="100%" id="sample_2">
					<thead>
						<tr>
							<th style="width:5%;text-align:center;">ID</th>
							<th style="width:30%">Service Name</th>
							<th style="width:10%;text-align:center;">Type of Service</th>
							<th style="width:10%;text-align:center;">Fee</th>
							<th style="width:10%;text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($res_s)
							foreach ($res_s as $key => $data_arr) {
								$service_id = $data_arr['service_id'];
								$sub_service_id = $data_arr['servicetype_additionalsubservice'];
								if ($data_arr['is_integrated_with_swcs'] == 'Y') {
									$swcs_department_id = $data_arr['department_id'];
									$swcs_service_id = $data_arr['swcs_service_id'];
								} else {
									$swcs_department_id = false;
									$swcs_service_id = false;
								}
								if($data_arr['core_service_name'] != '') 
								{
									if((($type == 'BM') && ($data_arr['business_name_services'] == 1) && $sub_service_id == 0) || 
									(($type == 'Incop') && ($data_arr['incorporation_services'] == 1) && $sub_service_id == 0) || 
									(($type == 'Cont') && ($data_arr['continuance_services'] == 1) && $sub_service_id == 0) || 
									(($type == 'Amal') && ($data_arr['amalgamation_services'] == 1) && $sub_service_id == 0) ||
									(($type == 'ClS') && ($data_arr['closure_service'] == 1) && $sub_service_id == 0) ||

									 (($type == 'OS') && ($data_arr['other_services'] == 1) && $sub_service_id == 0) ||

									(($type == 'PES') && ($data_arr['service_id'] != '484') && ($data_arr['incidence_pre_establishment'] == 1) && $sub_service_id == 0) ||
									(($type == 'POS') && ($sub_service_id == 0) && ($data_arr['incidence_pre_operation'] == 1) && (($data_arr['service_type'] != 'Amendment - Others') || 
									($data_arr['service_type'] != 'Amendment - Surrender') || 
									($data_arr['service_type'] != 'Amendment - Cancellation') || 
									($data_arr['service_type'] != 'Amendment - Cancellation'))) ||
									(($type == 'PO') && (($sub_service_id != 0))) || 
									($type == '') || ($type == 'INC' && $data_arr['is_incentive'] == 1)) 
									{
												
											$serId = $service_id.'.'.$sub_service_id;
											$offline_flag = 0;
											$online_flag = 0;
											$swcs_flag = 0;
											$is_online = $data_arr['is_online'];
											$is_integrated_with_swcs = $data_arr['is_integrated_with_swcs'];
											if($is_online == 'Y' && $is_integrated_with_swcs == 'N') {
												$status_text = "Online";
												$offline_flag = 0;
												$online_flag = 1;
												$swcs_flag = 0;
											}
										?>                                        

										<tr id="<?php echo $service_id . "_" . $sub_service_id; ?>">
											<td style="width:5%;text-align:center;">
											<?php echo $service_id . "." . $sub_service_id; ?>
											
											<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/caf_id/NULL/is/<?php echo $_GET['is']; ?>/type/<?php echo $_GET['type']; ?>" method="GET" id="services_post" target="_blank">
											<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
											<input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />

											<input type="hidden" name="department_id" value='<?php echo $id; ?>' />
											<input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
											<input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
											<input type="hidden" name="new_name" value='<?php echo $data_arr['core_service_name']; ?>' />		
											
											</td>
											<td style="width:30%"><?php echo $data_arr['core_service_name'];  ?></td>
											<td style="width:10%;text-align:center;">
											<?php echo $data_arr['service_type']; ?>
											</td>
											<td style="width:10%;text-align:center;"> 
											$100 BBD
											</td>											
											<td style="width:10%;text-align:center;">
												<?php
												$activeServiceArray = Yii::app()->db->createCommand("SELECT concat(service_id,'.',servicetype_additionalsubservice) as service_id FROM `bo_information_wizard_service_parameters` WHERE `is_active` = 'Y'")->queryAll();
												$list = Array();													
												foreach ($activeServiceArray as $key=>$value) {
												  $list[] = $value['service_id'];
												}						
												if(in_array($serId,$list))
												{
													$appURlData = Yii::app()->db->createCommand("select app_url from bo_sp_all_applications where app_id = '$data_arr[swcs_service_id]'")->queryRow();	
												?>	
													<a href="<?php echo $appURlData['app_url']; ?>" class="btn btn-success">Apply Now</a>
												<?php
												}
												?>
											<input type="hidden" name="type" value='<?php echo @$status_text; ?>' />
											<input type="hidden" name="ptype" value='<?php echo @$status_text; ?>' />
											</form>
											</td>
										</tr>
							<?php 	}
								}
							} 
							?>
					</tbody>
				</table>
			
		</div>		
	</div>
</div>	
    <script type="text/javascript">
		
        function goToNextPage(service_id, sub_service_id, caf_id) {
            window.location.href = '/backoffice/frontuser/ApplyService/DocumentsChecklist/service_id/' + service_id + '/sub_service_id/' + sub_service_id + '/caf_id/' + caf_id;
        }
        $(document).ready(function () {
			<?php if (@$_GET['is'] != "SE") { ?>
                $("#484_0").hide();
			<?php } ?>
			$(".btn-success").on("click",function(){
				//$("#services_post").submit();
			});
        });
        $(window).load(function () {
			<?php if (@$_GET['is'] != "SE") { ?>
                $("#484_0").hide();
			<?php } ?>
        });
    </script>
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
                    className: "btn white btn-outline"
                },  {
                    extend: "pdf",
                    className: "btn white btn-outline"
                }, {
                    extend: "excel",
                    className: "btn white btn-outline"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                        action: function( t, n) {
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});
</script>