<style type="text/css">
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -53px !important;
}
.a_cent{
	text-align:center;
	vertical-align:middle !important;
}
table.dataTable tbody th, table.dataTable tbody td {
  
    vertical-align: middle !important;
}
</style>
<?php

$uid = $_SESSION['uid'];
$role_id = $_SESSION['role_id'];
$disctrict_id = $_SESSION['dist_id'];

	$appSubIDArr = Yii::app()->db->createCommand("SELECT app_Sub_id FROM bo_infowiz_formbuilder_application_forward_level where verifier_user_id=$uid GROUP BY app_Sub_id")->queryAll();

	if(!empty($appSubIDArr))
	{
		foreach($appSubIDArr as $key=>$val)
		{
			$appSubArr[] = $val['app_Sub_id'];
		}
		if(!empty($appSubArr))
		{
			$appSubStr = implode(',',$appSubArr);
			$resArr = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,form_type_id FROM bo_infowiz_form_builder_configuration where current_role_id=$role_id")->queryAll();
			$formTypeArr = array();
			foreach($resArr as $key=>$val)
			{
				$formTypeArr[$val['service_id']] = $val['form_type_id'];
			}	
			$sql="SELECT 
				bo_new_application_submission.submission_id,
				bo_new_application_submission.field_value,
				bo_new_application_submission.service_id as serviceID,
				bo_district.distric_name as District, 
				bo_infowizard_issuerby_master.name as DepartmentName, 
				bo_information_wizard_service_parameters.core_service_name, 
				bo_new_application_submission.unit_name as unitName,
				bo_new_application_submission.application_status as applicationCurrentStatus, 
				bo_new_application_submission.application_created_date as appliedOn 
				FROM bo_infowiz_formbuilder_application_forward_level  
				INNER JOIN bo_new_application_submission  
				ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id  
				INNER JOIN bo_district 
				ON bo_district.district_id=bo_new_application_submission.landrigion_id 
				INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
				INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
				INNER JOIN bo_infowizard_issuerby_master  ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id 
				where  
				bo_new_application_submission.submission_id IN($appSubStr)
				AND bo_infowiz_formbuilder_application_forward_level.next_role_id=$role_id	
				GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id";
				/* bo_infowiz_formbuilder_application_forward_level.approv_status='P' AND
				bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id=$_SESSION[dept_id]   
				
				AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment='' 
				AND bo_new_application_submission.landrigion_id=$disctrict_id */
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				$res = $command->queryAll();
		}	
	}		
?>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'>
			<i style=" font-size:20px;" class='fa fa-users'></i>
			Processed Applications (<?php echo count(@$res );?>)</div>
		<div class='tools'> </div>
	</div>
<div class="portlet-body">
<table class='table table-striped table-bordered' id='sample_2'>
	<thead>
		<tr>
			<th class="a_cent">S.No</th>
			<th class="a_cent">Application <br/>ID</th>
			<!-- <th class="a_cent">Department <br/>Name</th> -->
			<th class="a_cent">Service <br/>Name</th>
			<th class="a_cent">Business Name</th> 
			<th class="a_cent">Application <br/>Status</th>
			<th class="a_cent">Applied <br/>On</th>
			<th class="a_cent">Action</th>
		</tr>	
	</thead>
		<?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending')?>
	<?php if(isset($res) && !empty($res)) { 
			foreach($res as $key=>$val){
				$formtype_id = $formTypeArr[$val['serviceID']];
				$status=$val['applicationCurrentStatus'];
				$fieldData = json_decode($val['field_value']);
				//$ukd='UK-FCL-00146_0';
		?>
				<tr>
				<td class="a_cent"><?php echo $key+1;?></td>
				<td class="a_cent"><?php echo $val['submission_id']?></td>				
				<!-- <td class="a_cent"><?php echo $val['DepartmentName']?></td> -->
				<td class="a_cent"><?php echo $val['core_service_name']?></td>
				<td class="a_cent"><?php echo $val['unitName']; ?></td>
				<td class="a_cent"><?php echo @$statusArray[$status]?></td>
				<td class="a_cent"><?php echo date("d-m-Y H:i:s",strtotime($val['appliedOn']));?></td>		
				<td><a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/departmentFormView/service_id/".$val['serviceID']."/pageID/1/subID/".$val['submission_id']."/formCodeID/$formtype_id");?>" class="btn btn-success">View</a>
				<br/><br/>
				<a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/applicationTimeline/subID/".base64_encode($val['submission_id'])."");?>" class="btn btn-success">Timeline</a>
				</td>		
	</tr>	<?php 	}
		}
	?>

</table>
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