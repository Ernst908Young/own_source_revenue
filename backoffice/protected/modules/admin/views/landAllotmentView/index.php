<div class="site-min-height">
	<div style="margin:-7px -20px 0;" class="page-bar">
       <ul class="page-breadcrumb">
          <li><h2><?php 
		   $deptModel = new DepartmentsExt;
		   $dept  = $deptModel->getDeptbyId($_SESSION['dept_id']);
		  if(DefaultUtility::isDisttApproverUser()){ ?><?php echo $dept['department_name'] ?> Panel - Uttarakhand<?php } ?></h2></li>
       </ul>
       <div class="page-toolbar">
          <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
             <span class="thin uppercase hidden-xs" id="clock"><?=date('d-M Y')?>&nbsp;</span>
             <span class="thin uppercase hidden-xs"></span>&nbsp;
          </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="portlet box green">
              <div class="portlet-title">
                 <div class="caption">
                    <i style="font-size:24px" class="icon-list"></i>
                    <span class="caption-subject bold uppercase"> Applications By Submission Date and Time</span>
                 </div>
              </div>
              <div class="portlet-body">
				<table class='table table-striped table-bordered table-responsive table-hover order-column' id='sample_2'>
					<thead>
						<tr>
							<th>S.No</th>
							<th>Applicant's Name</th>
							<th>Area Required</th>
							<th>Proposed Product</th>
							<th>Plant and Machinery</th>
							<th>Total Project Cost</th>
							<th>Total Employment</th>
							<th>Evaluation Marks</th>
							<th>Application Date</th>
							<!-- <th>Status</th> -->
						</tr>
					</thead>
					<tbody>
						<?php 
						// echo "<pre>"; print_r($Apps); die;
							foreach ($Apps as $k => $App) {
								$fields = json_decode($App['field_value']);
                                $totalMarks=0;
                                $totalMarks+=$this->getEvaluationMarks('edu_cert_qual',$fields->edu_cert_qual);
                                $totalMarks+=$this->getEvaluationMarks('edu_tech_qual',$fields->edu_tech_qual);
                                $totalMarks+=$this->getEvaluationMarks('cert_prof_exp',$fields->cert_prof_exp);
                                $totalMarks+=$this->getEvaluationMarks('cert_equity',$fields->cert_equity);
                                $totalMarks+=$this->getEvaluationMarks('cert_unit_approv_sanct',$fields->cert_unit_approv_sanct);
                                $totalMarks+=$this->getEvaluationMarks('cert_project_cost',$fields->cert_project_cost);
                                $totalMarks+=$this->getEvaluationMarks('cert_debt_cover_ratio',$fields->cert_debt_cover_ratio);
                                $totalMarks+=$this->getEvaluationMarks('cert_poll_cat',$fields->cert_poll_cat);
                                $totalMarks+=$this->getEvaluationMarks('cert_adpt_water_system',$fields->cert_adpt_water_system);
                                $totalMarks+=$this->getEvaluationMarks('cert_usage_local_materail',$fields->cert_usage_local_materail);
                                $totalMarks+=$this->getEvaluationMarks('cert_regist_startup',$fields->cert_regist_startup);
                                $totalMarks+=$this->getEvaluationMarks('edu_certcert_land_acquistion_qual',$fields->cert_land_acquistion);
                                $totalMarks+=$this->getEvaluationMarks('cert_enterprenure_type',$fields->cert_enterprenure_type);
                                $totalMarks+=$this->getEvaluationMarks('cert_unit_type',$fields->cert_unit_type);
                                $totalMarks+=$this->getEvaluationMarks('cert_unit_benifited',$fields->cert_unit_benifited);

								$status="";
								if($App['application_status'] == "P")
									$status = "<span class='label label-info'>Pending</span>";
								if($App['application_status'] == "R")
									$status = "<span class='label label-danger'>Rejected</span>";
								if($App['application_status'] == "H")
									$status = "<span class='label label-warning'>On-Hold</span>";
								$specfic_plot_size = "";	
								if(isset($fields->optional_specific_plot_size) && !empty($fields->optional_specific_plot_size))
								{
										$specfic_plot_size = $fields->optional_specific_plot_size . ' Sq.Mtr';
								}	
								$i=1;
								echo "<tr>
										<td>".$i++."</td>
										<td>$fields->applicant_name</td>
										<td>$specfic_plot_size</td>
										<td>";
										if(isset($fields->proposed_product) && !empty($fields->proposed_product))
										{
											foreach ($fields->proposed_product as $k => $v) {
												echo "$v, ";
											}
										}
								  echo "</td>
								  		<td>$fields->plant_machinery_invst</td>
								  		<td>$fields->total_investment</td>
								  		<td>Male : $fields->total_emp_male<br>Female : $fields->total_emp_female</td>
								  		<td>$totalMarks</td>
								  		<td>".date("d/m/Y h:i",strtotime($App['application_created_date']))."</td>
									</tr>";
							}
						?>
					</tbody>
				</table>
			  </div>
		   </div>
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
                     className: "btn  white btn-outline"
                 },  {
                     extend: "pdf",
                     className: "btn  white btn-outline"
                 }, {
                     extend: "excel",
                     className: "btn  white btn-outline"
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
                         // [0, "asc"]
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