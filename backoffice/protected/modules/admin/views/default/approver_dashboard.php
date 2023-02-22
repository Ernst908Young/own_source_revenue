<div class="site-min-height">
<?php

$deptModel = new DepartmentsExt;
$dept      = $deptModel->getDeptbyId($_SESSION['dept_id']);
$role_id = $_SESSION['role_id'];
$u_id = $_SESSION['uid'];

$resCircArr = Yii::app()->db->createCommand("SELECT circle_id FROM bo_user where uid=$u_id")->queryRow();
$circleArr = $resCircArr['circle_id'];
/* $circleStr = implode("','",$circleArr);
echo "<pre>";
print_r($circleArr);
echo $circleStr; */
/* die;  */
$disctrict_id = $_SESSION['district_id'];
$district_id = $_SESSION['dist_id'];

$resArr = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,form_type_id FROM bo_infowiz_form_builder_configuration where current_role_id=$role_id")->queryAll();
$formTypeArr = array();
foreach($resArr as $key=>$val)
{
	$formTypeArr[$val['service_id']] = $val['form_type_id'];
}	

	$resService = Yii::app()->db->createCommand("select service_id from bo_user_service_mapping where user_id='$u_id' AND is_all_district='Y'")->queryRow();
	$service_id=$resService['service_id'];
	/* echo $sql="SELECT 
		bo_new_application_submission.submission_id,
		bo_new_application_submission.field_value,
		bo_new_application_submission.service_id as serviceID,		
		bo_infowizard_issuerby_master.name as DepartmentName, 
		bo_information_wizard_service_parameters.core_service_name, 
		bo_new_application_submission.unit_name as unitName,
		bo_new_application_submission.application_status as applicationCurrentStatus, 
		bo_new_application_submission.application_created_date as appliedOn 
		FROM bo_infowiz_formbuilder_application_forward_level  
		INNER JOIN bo_new_application_submission  
		ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id		
		INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
		INNER JOIN bo_information_wizard_service_master on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
		INNER JOIN bo_infowizard_issuerby_master ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
		where bo_infowiz_formbuilder_application_forward_level.approv_status='P' AND
		bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id=$_SESSION[dept_id]   
		AND bo_infowiz_formbuilder_application_forward_level.next_role_id=$role_id
		AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment='' 
		AND (bo_new_application_submission.service_id IN ('119.0','119.1','119.3','119.5','226.0','226.1','226.3','226.5','226.6') AND bo_new_application_submission.landrigion_id IN (SELECT district_id FROM bo_district WHERE is_active='Y')) 
		AND bo_new_application_submission.service_id IN ('227.0','227.1','227.3','227.5','227.6','228.0','228.1','228.3','228.5','228.6'))
		GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id"; */
		 $sql = "SELECT 
				bo_new_application_submission.submission_id,
				bo_new_application_submission.field_value,
				bo_new_application_submission.service_id as serviceID,		
				bo_infowizard_issuerby_master.name as DepartmentName, 
				bo_district_circle.circle_name as circle_name, 
				bo_information_wizard_service_parameters.core_service_name, 
				bo_new_application_submission.unit_name as unitName,
				bo_new_application_submission.application_status as applicationCurrentStatus, 
				bo_new_application_submission.application_created_date as appliedOn 
				FROM bo_infowiz_formbuilder_application_forward_level  
				INNER JOIN bo_new_application_submission  
				ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id		
				INNER JOIN bo_information_wizard_service_parameters ON bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
				INNER JOIN bo_information_wizard_service_master ON bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
				INNER JOIN bo_infowizard_issuerby_master ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
				INNER JOIN bo_sp_applications ON bo_sp_applications.app_id=bo_new_application_submission.submission_id 
				INNER JOIN bo_district_circle ON bo_district_circle.id=bo_sp_applications.circle_id 
				where bo_infowiz_formbuilder_application_forward_level.approv_status='P' AND
				bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id=$_SESSION[dept_id] 
				 AND bo_infowiz_formbuilder_application_forward_level.next_role_id=$role_id 
				 AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment='' 
				AND(
				   (FIND_IN_SET (bo_new_application_submission.service_id , (select bo_user_service_mapping.service_id from bo_user_service_mapping where user_id=$u_id AND is_all_district='Y'))
				   AND bo_sp_applications.circle_id IN ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'))		   
				OR 
				 (FIND_IN_SET (bo_new_application_submission.service_id , (select bo_user_service_mapping.service_id from  bo_user_service_mapping where user_id=$u_id AND is_all_district='N' ))
				   AND bo_sp_applications.circle_id IN ($circleArr))				  
				) GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$Pendingapp = $command->queryAll();
		
?>	
	<div class="clearfix"></div>
	<div class="fixed-condition-elements">
		<div class="container-fluid">
			
		</div>
	</div>
	<div class="fixed-condition-element1 dashboard-welcome">
		<h2>Welcome to <?php echo $dept['department_name'] ?> Dashboard Panel - Uttarakhand</h2>
		<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>

	<div style="margin:4px;" class="clearfix"></div>
	<div class="marquee_container">  
   
	</div>
	<div style="margin:4px;" class="clearfix"></div>
        
	<!--<div class="portlet light bordered col-md-12">
	 <div class="col-xs-12 col-sm-6 col-md-3 text-center">
		<a href="#">					  
			<div class="round-stats blue">
				<h3 class="number statPending">							 
					<?php //echo count($Pendingapp); ?>
				</h3>						 					 
		   </div>
		   <div><p class="circle_desc">Pendings</p></div>
		</a>
	 </div>
	 <div class="col-xs-12 col-sm-6 col-md-3 text-center">
		<a href="#">					   
		   <div class="round-stats blue">
				<h3 class="number statForward">					
					
				</h3>						  					
		   </div>
		   <div><p class="circle_desc">Forwarded</p></div>
		</a>
	 </div>
	 <div class="col-xs-12 col-sm-6 col-md-3 text-center">
		<a href="#">					   
		   <div class="round-stats blue">
			  <h3 class="number">			 
			  </h3>						  
		   </div>
		   <div><p class="circle_desc">Approved</p></div>
		</a>
	 </div>
	 <div class="col-xs-12 col-sm-6 col-md-3 text-center">
		<a href="#">					  
		   <div class="round-stats blue">
			  <h3 class="number">			
			  </h3>						 
		   </div>
		   <div><p class="circle_desc">Rejected</p></div>
		</a>
	 </div>
	</div>-->

	<div class="row">
		<div class="col-md-12">
		   <!-- BEGIN EXAMPLE TABLE PORTLET-->
		   <div class="portlet box green">
			  <div class="portlet-title">
				 <div class="caption">
					<i style="font-size:24px" class="icon-list"></i>
					<span class="caption-subject bold uppercase">Pending Application (<?php echo '<b class="pendingCountSpan">'.count(@$Pendingapp).'</b>';  ?>)</span>
				 </div>
				 <div class="tools"> 
					<a href="javascript:;" class="collapse"> </a>
				 </div>
			  </div>
			  <div class="portlet-body">
				<table class='table table-striped table-bordered table-hover order-column' id='sample_1'>
				   <thead>
					   <tr>
						   <th>ID</th>
						   <th>Service Name</th>
						   <th>Company Name</th>
						   <th>Circle</th>
						   <th>Submission Date</th>
						   <th>Department</th>
						   <th>Status</th>
						   <th>Action</th>
					   </tr>
				   </thead>
				   <tbody>
				 <?php 				
				if(empty($Pendingapp)) {
					echo "<hr><h4>No Application Found!</hr></h4>";	
				}
				$pendingCount=0; 
				  if(!empty($Pendingapp)) {
						$statusArray = array('A' => 'Approved', 'AB' => 'Abeyance','R' => 'Rejected', 'H' => 'Reverted', 'Z' => 'Archived', 'I' => 'Incomplete', 'P' => 'Pending', 'F' => 'Forwarded','DP'=>'Document Pending','PD'=>'Payment Due','Forwarded','FA'=>'Forwarded to Approver');												 
							$count = 1;
							foreach($Pendingapp as $app) {
									$pendingCount++; 
									$Fields  = json_decode($app['field_value'],true);
									$formtype_id = $formTypeArr[$app['serviceID']];
									
									if($app['serviceID']!='591.0'){										
										$url = Yii::app()->createAbsoluteUrl("/infowizard/subFormOtherService/departmentFormView/service_id/".$app['serviceID']."/pageID/1/subID/".$app['submission_id']."/formCodeID/$formtype_id");
									}else{
										$url = Yii::app()->createAbsoluteUrl("/infowizard/subForm/departmentFormView/service_id/".$app['serviceID']."/pageID/1/subID/".$app['submission_id']."/formCodeID/$formtype_id");
									}			

								  
								echo "<tr><td>" . $app['submission_id'] . "</td>
									<td align='left'>".$app['core_service_name']."</td>
									<td>".@$Fields['UK-FCL-00038_1']."</td>
									<td>".@$app['circle_name']."</td>
									<td align='center'>" . date("d-M-Y H:i:s",strtotime($app['appliedOn'])) . "</td>
									<td align='center'>$dept[department_name]</td>
									<td align='center'>".$statusArray[$app['applicationCurrentStatus']]."</td>
									<td><a href='" . $url . "' title='View Application'>View</a></td>
								   </tr>";
							}
							
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
                 dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
             });
             $("#sample_1_tools > li > a.tool-action").on("click", function() {
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
             });
             $("#sample_2_tools > li > a.tool-action").on("click", function() {
                 var e = $(this).attr("data-action");
                 t.DataTable().button(e).trigger()
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
                     className: "btn white btn-outline"
                 },  {
                     extend: "pdf",
                     className: "btn white btn-outline"
                 }, {
                     extend: "excel",
                     className: "btn white btn-outline"
                 }],
                 responsive: !0,
                 order: [
                    // [0, "asc"]
                 ],
                 lengthMenu: [
                     [5, 10, 15, 20, -1],
                     [5, 10, 15, 20, "All"]
                 ],
                 pageLength: 10,
                 dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
             $("#sample_3_tools > li > a.tool-action").on("click", function() {
                 var e = $(this).attr("data-action");
                 t.DataTable().button(e).trigger()
             })
         },
		 h = function() {
             var e = $("#sample_4"),
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
					 className: "btn white btn-outline"
					},  {
					 extend: "pdf",
					 className: "btn white btn-outline"
					}, {
					 extend: "excel",
					 className: "btn white btn-outline"
					}],
					responsive: 0,
					order: [
					 [0, "asc"]
					],
					lengthMenu: [
					 [5, 10, 15, 20, -1],
					 [5, 10, 15, 20, "All"]
					],
					pageLength: 10,
					dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
				$("#sample_4_tools > li > a.tool-action").on("click", function() {
                 var e = $(this).attr("data-action");
                 t.DataTable().button(e).trigger()
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
                 onSuccess: function(e, t, a, h) {},
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
                         action: function(e, t, a, h, n) {
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
             jQuery().dataTable && (e(), t(), a(), n(), h())
         }
     }
   }();
   jQuery(document).ready(function() {
     TableDatatablesButtons.init();
   });
</script>
<style>
.dataTables_wrapper .dt-buttons {   
    padding-right: 25px !important;
}
</style>