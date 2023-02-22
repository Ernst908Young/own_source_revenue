<style type="text/css">
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -53px !important;
}
.a_cent{
	text-align:center;
	vertical-align:middle !important;
}
.l_cent{
	text-align:left;
	vertical-align:middle !important;
}
</style>
<?php
$role_id = $_SESSION['role_id'];
$district_id = $_SESSION['dist_id'];

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
		bo_infowizard_issuerby_master.name as DepartmentName, 
		bo_information_wizard_service_parameters.core_service_name, 
		bo_new_application_submission.unit_name as unitName,
		bo_new_application_submission.application_status as applicationCurrentStatus, 
		bo_new_application_submission.application_created_date as appliedOn 
		FROM bo_infowiz_formbuilder_application_forward_level  
		INNER JOIN bo_new_application_submission ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id 
		INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
		INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
		INNER JOIN bo_infowizard_issuerby_master  ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id 
		where  
		bo_infowiz_formbuilder_application_forward_level.approv_status='P' 
		AND bo_information_wizard_service_parameters.is_active='Y'
		AND	bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id=$_SESSION[dept_id]   
		AND bo_infowiz_formbuilder_application_forward_level.next_role_id=$role_id
		AND bo_infowiz_formbuilder_application_forward_level.verifier_user_comment='' 
		GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id ORDER BY bo_new_application_submission.submission_id DESC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryAll();
?>

<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'>
			<i style=" font-size:20px;" class='fa fa-users'></i>Pending Applications (<?php echo count($res );?>)</div>
		<div class='tools'> </div>
	</div>
	<div class="portlet-body">
	<table class='table table-striped table-bordered' id='sample_2'>
		<thead>
			<tr>
				<th class="a_cent">S.No.</th>
				<th class="a_cent">SRN</th>
				<th class="l_cent">Service Name</th>
				<th class="a_cent">Application Status</th>
				<th class="a_cent">Applied On</th>
				<th class="a_cent">Action</th>
			</tr>	
		</thead>
			<?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending','FA'=>'Forwarded To Approver')?>
		<?php //echo "<pre>"; print_r($res);die();
		if(!empty($res)) { 
				foreach($res as $key=>$val){
					$formtype_id = $formTypeArr[$val['serviceID']];
					$status=$val['applicationCurrentStatus'];
					$fieldData = json_decode($val['field_value']);
					//$ukd='UK-FCL-00146_0';
			?>
					<tr>
						<td class="a_cent"><?php echo $key+1;?></td>
						<td class="a_cent"><?php echo $val['submission_id']?></td>
						<td class="l_cent"><?php echo $val['core_service_name']?> <br><b> SLA : 90 Days </b></td>
						<td class="a_cent">
						<?php echo @$statusArray[$status];
							$io="";  
							if(!empty($val['appliedOn'])){
								echo "<br>";

								$date1=date_create(date('Y-m-d H:i:s'));
								$date2=date_create(date('Y-m-d H:i:s',strtotime($val['appliedOn'])));
								$diff=date_diff($date2,$date1);
								$ad=$diff->format("%a");
								$abi=90-$ad;
								$io=$abi." Days Left";
								echo "<b>(".$io.")</b>";
							}
						?>
                       </td>
						<td class="a_cent"><?php echo date("d-M-Y",strtotime($val['appliedOn'])); ?></td>		
						<td class="a_cent">
						<?php 
						$action = Yii::app()->db->createCommand("SELECT form_action_controller,form_service_js FROM   bo_infowiz_form_builder_configuration where service_id=$val[serviceID]")->queryRow();
						?>
						<a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/".$action['form_action_controller']."/departmentFormView/service_id/".$val['serviceID']."/pageID/1/subID/".$val['submission_id']."/formCodeID/$formtype_id");?>" class="btn btn-success">View</a>
						<!--<br/><br/>
						<a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/applicationTimeline/subID/".base64_encode($val['submission_id'])."");?>" class="btn btn-success">Timeline</a>-->
						</td>		
					</tr>	
				<?php 	
				}
			}
		?>

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

                         className: "btn white btn-outline"

                     }, {

                         extend: "copy",

                         className: "btn white btn-outline"

                     }, {

                         extend: "pdf",

                         className: "btn white btn-outline"

                     }, {

                         extend: "excel",

                         className: "btn white btn-outline"

                     }, {

                         extend: "csv",

                         className: "btn white btn-outline"

                     }, {

                         text: "Reload",

                         className: "btn white btn-outline",

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