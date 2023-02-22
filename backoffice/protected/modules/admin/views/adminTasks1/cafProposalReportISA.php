<?php /*Note: If you are chnaging any  query or value then you need to change in backoffice/mis/newoverallreport */
//$reportType="admin";
extract($_GET);
include(getcwd().'/themes/investuk/views/layouts/cs_ps_page_bar.php');
$baseUrl=Yii::app()->theme->baseUrl;    
$themePath=Yii::app()->baseUrl."/../../";
$nodalTime=ApplicationV2Ext::getOverallTimeTakenbyNodal('499');
?>
<style type="text/css">
	<?php if(@$reportType=="admin"){ ?> 
	#header-full-top{display:none;}
	#header{display:none;}
	#footer-widgets{display:none;}
	<?php } ?>
	.fa-spin-hover {
		animation: fa-spin 2s infinite linear;
	}
	@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
	@keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
	.portlet.light.bordered {
		border: 0px solid #e7ecf1!important;    
	}
	.dropdown-menu .active > a, .dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-menu li > a:active{
		background-color:#0099da;
	}
	.panel {
		overflow: hidden;
	}
	.panel-body{
		padding: 0px;
	}
	.section-data{
		float: left;
	}
	.section-data li{
		border-left: 1px solid #eee;
		border-bottom: 1px solid #eee;
		padding: 5px 6px;
		text-align: center;
	}
	.header-se{
		height: 50px;
		background: #ccc;
		color: #000;
	}
	.panel{
		background-color: #FFFFFF;
	}
	.thcenter{
		text-align:center;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
		padding: 4px;
	}
	div.DTFC_LeftBodyLiner{
		top:-10px !important;
	}
</style>
<?php
$sql = "Select district_id, distric_name from bo_district";
$depptt = Yii::app()->db->createCommand($sql)->queryAll();
?>
<div class="row after-fixed-element">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i style="font-size:24px"></i>
					<span class="caption-subject bold uppercase">Proposals Under Single Window Clearance System and their Status <?php if(!empty($_GET['unit_type'])) { echo "-".ucwords(@$_GET['unit_type']);} ?> 
					</span>
				</div>
				<div class="tools"></div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered " id="sample_1">
					<thead>						
						<tr>
						<th style="text-align:center;vertical-align:middle;">S.No.</th>
						<th style="text-align:center;vertical-align:middle;">District</th>
						<th style="text-align:center;vertical-align:middle;">Total Submitted</th>
						<th style="text-align:center;vertical-align:middle;">Total Manufacturing</th>
						<th style="text-align:center;vertical-align:middle;">Total Services</th>
						<th style="text-align:center;vertical-align:middle;">Pending with DIC</th>
						<th style="text-align:center;vertical-align:middle;">Reverted back to Investor</th>
						<th style="text-align:center;vertical-align:middle;">Forwarded to Departments</th>
						<th style="text-align:center;vertical-align:middle;">Rejected</th>
						<th style="text-align:center;vertical-align:middle;">Approved</th>
						<th style="text-align:center;vertical-align:middle;">Approved within 15 Days</th>
						<th style="text-align:center;vertical-align:middle;">Pending with Departments</th>
						<th style="text-align:center;vertical-align:middle;">Total Employment (Proposed)</th>
						<th style="text-align:center;vertical-align:middle;">Total Employment (Approved)</th>
						<th style="text-align:center;vertical-align:middle;"> Total Investment <b>in INR Cr.</b> (Proposed)</th>
						<th style="text-align:center;vertical-align:middle;"> Total Investment <b> in INR Cr.</b> (Approved)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$totalArchived = 0;
						$totalPendingForPayment = 0;
						$count = 1;
						$count1 = 0;
						$count2 = 0;
						$count3 = 0;
						$count4 = 0;
						$count5 = 0;
						$count6 = 0;
						$count7 = 0;
						$count8 = 0;
						$count9 = 0;
						$count10 = 0;
						$count11 = 0;
						$count12 = 0;
						$count13=0; // Proposed Employment
						$count14=0;// Proposed Investment
						$countManufacturing=0;// OverallManufacturing
						$c10 = 0;
						$totalDIC48Pending = 0;
						$countmalefemalecount = 0;
						$distApprovedWithIn15Days = 0;
						$countService = 0;
						foreach ($depptt as $key => $dept) {
							$distID = $dept['district_id'];
							$totalCAFrecived = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtSubmitted','',$from_date,$to_date);
							$totalDistrictManufacturing = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtProposedManufacturing','',$from_date,$to_date);
							$totalDistrictService = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtProposedService','',$from_date,$to_date);
							$totalDICPending = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtPending','',$from_date,$to_date);
							$totalReverted = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtReverted','',$from_date,$to_date);
							$totalForwarded = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtForwardedAndDisposed','',$from_date,$to_date);
							$totalApproved = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtApproved','',$from_date,$to_date);
							$totalRejected = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtRejected','',$from_date,$to_date);
							$totalForwardedDept = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID, 'districtForwarded','',$from_date,$to_date);
							$totalMaleEmp = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtMaleEmployment','',$from_date,$to_date);
							$totalFemaleEmp = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtFemaleEmployment','',$from_date,$to_date);
							$totalInvestment = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtInvestment','',$from_date,$to_date);
							$totalProposedDistrictMaleEmployment = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtProposedMaleEmployment','',$from_date,$to_date);
							$totalProposedDistrictFemaleEmployment = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtProposedFemaleEmployment','',$from_date,$to_date);
							$totalProposedDistrictInvestment = ApplicationV2Ext::getConsolidatedCafStatusCountISA($distID,'districtProposedInvestment','',$from_date,$to_date);
							$count1 += $totalCAFrecived;
							$count2 += $totalDICPending;
							$count4 += $totalReverted;
							$count5 += $totalForwarded;
							$count6 += $totalApproved;
							$count7 += $totalRejected;
							$count8 += $totalForwardedDept;
							$countmalefemalecount += $totalMaleEmp + $totalFemaleEmp;
							$count11 += $totalInvestment;
							$count13 +=$totalProposedDistrictMaleEmployment+$totalProposedDistrictFemaleEmployment;
							$count14 +=$totalProposedDistrictInvestment;
							$countManufacturing +=$totalDistrictManufacturing;
							$countService +=$totalDistrictService;
							
							?>
						<tr>	
							<td align="center"><?php echo $count; ?></td>
							<td align="center"><?php echo $dept['distric_name'] ?></td>
							<td align="center"><b><?php echo $totalCAFrecived; ?></b></td>
							<td align="center"><b><?php echo $totalDistrictManufacturing; ?></b></td>
							<td align="center"><b><?php echo $totalDistrictService; ?></b></td>
							<td align="center" style="border-left:2px solid #878787;"><b><?php echo $totalDICPending + $totalDIC48Pending; ?></b></td>
							<td align="center"><b><?php echo $totalReverted; ?></b></td>
							<td align="center"><b><?php echo $totalForwarded; ?></b></td>
							<td align="center" style="border-left:2px solid #878787;">
								<b><?php echo $totalRejected; ?></b>
							</td>
							<td align="center"><b><?php echo $totalApproved; ?></b>
							<?php   $cunt=0; $allArray= ApplicationV2Ext::getConsolidatedCafStatusCountISAArray($distID, 'districtApproved','',$from_date,$to_date); 
							foreach($allArray as $timeTaken){                            
								$total=ApplicationV2Ext::getOverallTimeTakenbyNodal($timeTaken['submission_id']);
								if($total<15){
								   $cunt=$cunt+1; 
								}
							}?>
							</td>
							<td align="center">
							   <b> <?php echo $cunt; $distApprovedWithIn15Days=$distApprovedWithIn15Days+$cunt; ?> </b>
							</td>
							<td align="center" style="border-right:2px solid #878787;">
								<b><?php echo $totalForwardedDept; ?></b>
							</td>						
							<td align="center">
								<b><?php echo $totalProposedDistrictMaleEmployment+$totalProposedDistrictFemaleEmployment; ?></b>
							</td>
							<td align="center">
								<b><?php $c10 += $totalMaleEmp + $totalFemaleEmp;
									echo $totalMaleEmp + $totalFemaleEmp; ?></b>
							</td>
							<td align="center">
								<b><?php echo $totalProposedDistrictInvestment; ?></b>
							</td>
							<td align="center"><b><?php echo $totalInvestment; ?></b></td>
						</tr>
						<?php
						$count++;
						}
						?>
					<tr>
						<th style="visibility:hidden;"><?php echo $count++;?></th>
						<th style="text-align:center;">District Total</th>
						<th style="text-align:center;"><?php echo $count1 + @$totoaldistrictDDN ?></th>
						<th style="text-align:center;"><?php echo $countManufacturing; ?></th>
						<th style="text-align:center;"><?php echo $countService; ?></th>
						<th style="text-align:center;"> <?php echo ($count2 + @$totalDICPendingDDN) + ($count3 + @$totalDIC48PendingDDN); ?> </th>
						<th style="text-align:center;"><?php echo $count4 + @$totalRevertedDDN ?> </th>
						<th style="text-align:center;"><?php echo $count5 + @$totalForwardedDDN ?></th>
						<th style="text-align:center;"><?php echo $count7 + @$totalRejectedDDN ?></th>
						<th style="text-align:center;"><?php echo $count6 + @$totalApprovedDDN ?></th>
						<th style="text-align:center;"><?php echo @$distApprovedWithIn15Days ?></th>
						<th style="text-align:center;"><?php echo $count8 + @$totalForwardedDeptDDN ?> </th>
						<th style="text-align:center;"> <?php echo $count13; ?></th>
						<th style="text-align:center;"><?php echo $c10; ?></th>
						<th style="text-align:center;"> <?php echo $count14; ?></th>
						<th style="text-align:center;"> <?php echo $count11 + @$totalInvestmentDDN ?></th>
					   
					</tr>
				  
						<?php
						$totoaldistrictSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateSubmitted','',$from_date,$to_date);
						$totoalManufacturingSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateProposedManufacturing','',$from_date,$to_date);
						$totoalServiceSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateProposedService','',$from_date,$to_date);
						$totalDICPendingSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'statePending','',$from_date,$to_date);
						$totalRevertedSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateReverted','',$from_date,$to_date);
						$totalForwardedSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateForwardedAndDisposed','',$from_date,$to_date);
						$totalApprovedSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateApproved','',$from_date,$to_date);
						$totalRejectedSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateRejected','',$from_date,$to_date);
						$totalForwardedDeptSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6', 'stateForwarded','',$from_date,$to_date);
						$totalMaleEmpSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateMaleEmployment','',$from_date,$to_date);
						$totalFemaleEmpSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateFemaleEmployment','',$from_date,$to_date);
						$totalInvestmentSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateInvestment','',$from_date,$to_date);
						$totalProposedMaleEmpSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateProposedMaleEmployment','',$from_date,$to_date);
						$totalProposedFemaleEmpSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateProposedFemaleEmployment','',$from_date,$to_date);
						$totalProposedInvestmentSTATEDDN = ApplicationV2Ext::getConsolidatedCafStatusCountISA('6','stateProposedInvestment','',$from_date,$to_date);
					   
						?>
					<tr>
					<td align="center"> <?php echo $count++; ?> </td>
					<td><?php echo 'STATE ' ?></td>
					<td align="center"><?php echo $totoaldistrictSTATEDDN ?> </td>
					<td align="center"><?php echo $totoalManufacturingSTATEDDN ?> </td>
					<td align="center"><?php echo $totoalServiceSTATEDDN ?> </td>
					<td align="center" style="border-left:2px solid #878787;"> <?php echo $totalDICPendingSTATEDDN ?> </td>
					<td align="center" style=""><?php echo $totalRevertedSTATEDDN ?></td>
					<td align="center" style=""><?php echo $totalForwardedSTATEDDN ?> </td>
					<td align="center" style=""><?php echo $totalRejectedSTATEDDN ?></td>
					<td align="center"><?php echo $totalApprovedSTATEDDN ?></td>				   
					<td align="center">
						<?php   $cunt=0; $allArray= ApplicationV2Ext::		getConsolidatedCafStatusCountISAArray(6, 'stateApproved','',$from_date,$to_date); 
						foreach($allArray as $timeTaken){                            
							$total=ApplicationV2Ext::getOverallTimeTakenbyNodal($timeTaken['submission_id']);
							if($total<15){
								$cunt=$cunt+1; 
							}
						}?>
					   <?php echo $cunt; $StateApprovedWithIn15Days=$cunt; ?>
					</td>
					<td align="center"><?php echo $totalForwardedDeptSTATEDDN ?></td>
					<td align="center"> <?php echo $totalProposedMaleEmpSTATEDDN + $totalProposedFemaleEmpSTATEDDN ?></td>
					<td align="center"> <?php echo $totalMaleEmpSTATEDDN + $totalFemaleEmpSTATEDDN ?></td>                    
					<td align="center"><?php echo $totalProposedInvestmentSTATEDDN ?></td>
					<td align="center"><?php echo $totalInvestmentSTATEDDN ?></td>
				  
					</tr>
					<tr>
						<th style="visibility:hidden;"><?php echo $count++;?></th>
						<th style="text-align:left;">Grand Total (District+State) </th>
						<th style="text-align:center;">
							<?php echo $count1 + $totoaldistrictSTATEDDN ?>
						</th>
						<th style="text-align:center;">
							<?php echo $countManufacturing + $totoalManufacturingSTATEDDN; ?>
						</th>
						<th style="text-align:center;">
							<?php echo $countService + $totoalServiceSTATEDDN; ?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo $count2 + $totalDICPendingSTATEDDN?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo $count4 +  $totalRevertedSTATEDDN ?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo $count5 +  $totalForwardedSTATEDDN ?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo $count7 +  $totalRejectedSTATEDDN ?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo $count6 + $totalApprovedSTATEDDN ?>
						</th>
						<th align="center" style="text-align:center;">
							<?php echo @$distApprovedWithIn15Days + @$StateApprovedWithIn15Days ?>
						</th>					   
						<th align="center" style="text-align:center;">
							<?php echo $count8 + $totalForwardedDeptSTATEDDN ?>
						</th>
						<th style="text-align:center">
							<?php echo $count13 + $totalProposedMaleEmpSTATEDDN + $totalProposedFemaleEmpSTATEDDN ?>
						</th>
						<th style="text-align:center">
							<?php echo $c10 + $totalMaleEmpSTATEDDN + $totalFemaleEmpSTATEDDN ?>
						</th>
						<th style="text-align:center">
							<?php echo $count14 +  $totalProposedInvestmentSTATEDDN ?>
						</th>
						
						<th style="text-align:center">
							<?php echo $count11 +  $totalInvestmentSTATEDDN ?>
						</th>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
var TableDatatablesButtons = function () {
    var e = function () {
    var e = $("#sample_1");
    e.dataTable({
		scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        },
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
				className: "btn white btn-outline"
		}],
		order: [
			[0, "asc"]
		],           
		lengthMenu: [
			[5, 10, 15, 20, - 1],
			[5, 10, 15, 20, "All"]
		],
		pageLength: -1,
			dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
		});
		$("#sample_1_tools > li > a.tool-action").on("click", function () {
			var e = $(this).attr("data-action");
			t.DataTable().button(e).trigger()
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
					zeroRecords: "No matching records found"
					},
					buttons: [{
						extend: "print",
						className: "btn white btn-outline"
					}, {
					extend: "pdf",					
						orientation: 'landscape',
						filename: '<?php echo 'test' . ".pdf"; ?>',
						className: "btn white btn-outline"
					}, {
					extend: "excel",
						className: "btn white btn-outline"
					}],
					order: [
						[0, "asc"]
					],
					lengthMenu: [
						[5, 10, 15, 20, - 1],
						[5, 10, 15, 20, "All"]
					],
					pageLength: 10,
					dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
				$("#sample_2_tools > li > a.tool-action").on("click", function () {
					var e = $(this).attr("data-action");
					t.DataTable().button(e).trigger()
				})
            },
            a = function () {
				var e = $("#sample_3"),
				t = e.dataTable({
				language: {
				
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
					className: "btn white btn-outline"
				}],
				responsive: !0,
				order: [
					[0, "asc"]
				],
				lengthMenu: [
					[5, 10, 15, 20, - 1],
					[5, 10, 15, 20, "All"]
				],
				pageLength: 10,
				dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
				$("#sample_3_tools > li > a.tool-action").on("click", function () {
					var e = $(this).attr("data-action");
					t.DataTable().button(e).trigger()
				})
            },
            n = function () {
           /*  $(".date-picker").datepicker({
            rtl: App.isRTL(),
                    autoclose: !0
            }); */
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
                            [10, 20, 50, 100, 150, - 1],
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
</script>