	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>CAF Application Comment </div>
			<div class="tools"> </div>
		</div>
		<div class="portlet-body">
			<table class="table table-bordered" id="sample_2">
				<thead>
					<tr>
						<th>CAF</th>
						<th>IUID</th>
						<th>Unit</th>				
						<th>Investor's Email</th>
						<th>Mobile</th>
						<th>Comments</th>
						<th>Applied On</th>
						<th>Distt./State</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if(!empty($applications))
				{
				foreach ($applications as $apps) {
					if($apps->application_id == 1){
						$investorinfo=ApplicationExt::getInvestorDetails($apps->user_id);
						$api_hash=hash_hmac('sha1', md5($apps->user_id), SSO_API_PUBLIC_KEY);
						$post_data=array('uid'=>$apps->user_id,'api_hash'=>$api_hash);
						// $response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserId',$post_data));
						$uname='';
						//if($response->STATUS===200)
						//$uname=$response->RESPONSE;
						$dist_name=DistrictExt::getDistricNameById($apps->landrigion_id);
						$cafindname= ApplicationExt::getIndustryNamefromCAF($apps->submission_id);
						$revertcomment= ApplicationExt::getRevertedComment($apps->submission_id);
						$applied_on = date("d-m-Y",strtotime($apps->application_created_date));
						?>
						<tr>
							<td style='font-size: 13px; vertical-align: middle; text-align: center;' width='1%'><a target = "_blank" href ="/backoffice/admin/ApplicationView/applicationfulldetail/app_sub_id/<?php echo $apps->submission_id;?>"><?php echo $apps->submission_id;?></a> </td>
							<td style='font-size: 13px; vertical-align: middle; text-align: center;' width='1%'><?php echo $investorinfo['iuid'];?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: left;' width='13%'><?php echo $cafindname;?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: left;' width='5%'><?php echo $investorinfo['email'];?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: center;' width='3%'><?php echo $investorinfo['mobile_number'];?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: left;' width='45%'><?php echo $revertcomment;?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: left;' width='45%'><?php echo $applied_on;?></td>
							<td style='font-size: 13px; vertical-align: middle; text-align: center;' width='3%'><?php echo $dist_name;?></td>
							<?php
							if($apps->application_status=='F')
							{
								$status ="Forwarded";
								$colorClass="label-warning";
							}else if($apps->application_status=='P')
							{
								$status ="Pending";
								$colorClass="label-info";
							}else if($apps->application_status=='A')
							{
								$status ="Approved";
								$colorClass="label-success";
							}else if($apps->application_status=='B')
							{
								$status ="Due for Payment";
								$colorClass="label-primary";
							}else if($apps->application_status=='H')
							{
								$status ="Reverted";
								$colorClass="label-default";
							}else if($apps->application_status=='I')
							{
								$status ="Incomplete";
								$colorClass="label-warning";
							}else if($apps->application_status=='R')
							{	
								$status ="Rejected";
								$colorClass="label-danger";
							}else if($apps->application_status=='Z')
							{
								$status ="Archive";
								$colorClass="label-danger";
							}
							?>
							<td style='display: table-cell' class='label label-sm <?php echo $colorClass;?>'><?php echo $status;?></td>
							<td>				   
								<!--<a target='_BLANK' href="<?php //echo Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/'.base64_encode($apps->submission_id))?>" class='btn dark btn-sm btn-outline sbold uppercase'>-->
								<a target='_BLANK' href="<?= Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/CafTrackingTimeline/application/'. base64_encode($apps->submission_id).'/panel/investor/financial_year/ALL/type/CAF/iuid/'.base64_encode($investorinfo['iuid'])); ?>" class='btn dark btn-sm btn-outline sbold uppercase'>
								<i class='fa fa-share'></i> View </a>
							</td>					
					</tr>
					<?php
					}
				}
			}
			?>
			</tbody>
			</table>
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
    TableDatatablesButtons.init();
});
</script>


