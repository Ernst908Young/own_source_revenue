<?php 
//include("/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarStateMonitering.php");
include(getcwd().'/themes/investuk/views/layouts/cs_ps_page_bar.php');
?>
<style type="text/css">
div.DTFC_LeftBodyLiner{
		top:-10px !important;
	}
</style>
<div class="row after-fixed-element">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div><input type="checkbox" name="swu" id="swu" checked="checked">Single Window Users&nbsp;
		<input type="checkbox" name="dpu" id="dpu">Departmental Portal Users</div>
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i style="font-size:24px" class="icon-users"></i>
					<span class="caption-subject bold uppercase">Registered Investor Details</span>
				</div>
				<div class="tools"> </div>
				<div class="dto-buttons" style="margin:3px 5px 0 0;float: right; ">  </div>	
			</div>
			<div class="portlet-body">
				 <div class="site-min-height">
				  <div class="form form-horizontal" role="form">
				  </div>
				</div>
				<table class="table table-bordered" id="sample_1">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>IUID</th>
							<th>Investor Detail</th>							
							<th>In-Principle Application (CAF)</th>
							<th>Departmental Clearances</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<tr>
					 <?php  
						  $count=1;
						 
						  if(!empty($data))
							foreach ($data as $userData) {
								
						   /*  $result=Yii::app()->db->createCommand("select user_id from sso_users where iuid=$userData->iuid")->queryRow();
							  echo $user_id = $result['user_id']; 
							  echo "<br/>"; */
							  $user_id = $userData->user_id;
							  //$userID= base64_encode($result['user_id']);
							  $userID = base64_encode($userData->user_id);
							  $iuID = base64_encode($userData->iuid);
						   // print_r($result);die;
							  echo "<td align='center'>".$count++."</td>
									  <td><a href='/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userID/iuid/$iuID'>".$userData->iuid."</a></td>
									  <td><b>Single Window User: </b><br/>".$userData->first_name." ".$userData->last_name."</br>".$userData->email."</br>".$userData->mobile_number."<br/><b>Registered On: </b>";
										echo $userData->created_on ."<br>"; 
										if($userData->is_account_active=='Y'){
											echo "<b>Status: </b><span class='label label-sm label-success'> Activated </span>" ;
										} 
										else{
											echo "<b>Status: </b><span class='label label-sm label-warning'> Inactive </span>" ;
										} 
									  "</td>";
									 
									$result_caf=Yii::app()->db->createCommand("select application_status,user_id,application_id,submission_id from bo_application_submission where user_id = $user_id AND application_id=1")->queryAll();
																			
									if(!empty($result_caf)){										
									 echo "<td align='left'>";
										foreach($result_caf as $key=>$val)
										{
											if(!empty($val['application_status']) && $val['application_status']=='B')
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Pending For Payment</p>';			
											}	
											if(!empty($val['application_status']) && $val['application_status']=='A')
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Approved</p>';
											}
											if(!empty($val['application_status']) && $val['application_status']=='I')
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Incomplete</p>';
											}
											if(!empty($val['application_status']) && $val['application_status']=='R')
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Rejected</p>';
											}
											if(!empty($val['application_status']) && ($val['application_status']=='RBI' || $val['application_status']=='H'))
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Reverted</p>';
											}
											if(!empty($val['application_status']) && $val['application_status']=='Z')
											{
												echo  '<p>CAF ID: '.@$val['submission_id'].', Archived</p>';
											}
										}	
									 "</td>";
									}else{
									  echo "<td align='left'>".'Not Applied Yet'."</td>";  
									}
									echo "<td>";										
										echo "<b>". $userData->name ."<b/><br/><br/>";
										if($userData->infowiz_service_name)
										echo "<span style='font-weight: normal;'>1. ". $userData->infowiz_service_name ."-</span>  <span class='label label-sm label-success'>(".count($userData->infowiz_service_name)."  Nos.)</span>";
									"</td>"; 
									echo "<td><a href='/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/uid/$userID/iuid/$iuID/financial_year/$fy_date'>View Investor Dashboard</a></td>
								  </tr>";
							}
						?>
			 
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- page start-->
<?php
$base=Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript" charset="utf-8">
	var TableDatatablesScroller = function() {
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
                    className: "btn white btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn white btn-outline"
                }, {
                    extend: "excel",
                    className: "btn white btn-outline "
                }],
				order: [
				  [0, "asc"]
				],
				lengthMenu: [
				  [50, 100, 150, 200, -1],
				  [50, 100, 150, 200, "All"]
				],
				pageLength: 50,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            });
			$("#sample_1_tools > li > a.tool-action").on("click", function () {
				var e = $(this).attr("data-action");
				t.DataTable().button(e).trigger()
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
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "Loading..."
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                }, {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "csv",
                    className: "btn default"
                }],
                serverSide: !0,
                ordering: !1,
                searching: !1,
                ajax: function(e, t, n) {
                    for (var o = [], a = e.start, l = e.start + e.length; l > a; a++) o.push([a + "-1", a + "-2", a + "-3", a + "-4", a + "-5"]);
                    setTimeout(function() {
                        t({
                            draw: e.draw,
                            data: o,
                            recordsTotal: 5e6,
                            recordsFiltered: 5e6
                        })
                    }, 50)
                },
                scrollY: 400,
                scroller: {
                    loadingIndicator: !0
                },
                dom: "<'row' <'col-md-12'B>><'table-scrollable't><'row'<'col-md-12'i>>"
            })
        },
        n = function() {
            var e = $("#sample_3");
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
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }],
                scrollY: 300,
                deferRender: !0,
                scroller: !0,
                deferRender: !0,
                scrollX: !0,
                scrollCollapse: !0,
                stateSave: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        o = function() {
            var e = $("#sample_4");
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
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }],
                scrollY: 300,
                deferRender: !0,
                scroller: !0,
                deferRender: !0,
                scrollX: !0,
                scrollCollapse: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        };
    return {
        init: function() {
            jQuery().dataTable && (e(), t(), n(), o())
        }
    }
}();
jQuery(document).ready(function() {	
    TableDatatablesScroller.init();
	$("#sample_1").css("position", "");
});
</script>