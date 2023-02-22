<?php
$subID = base64_decode($_GET['subID']);
$sql="SELECT * from bo_infowiz_form_builder_application_log where app_Sub_id=$subID group by action_status,created order by created ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$res = $command->queryAll();


if((isset($_SESSION) && !empty($_SESSION['uid'])) || (isset($_SESSION['RESPONSE']['user_id'])))
{	
	
?>
<style>

.a_cent{
text-align:center;
vertical-align:middle !important;
}
.v_a{
	vertical-align:middle !important;
}
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -148px !important;
}
</style> 
<?php 
	$connection = Yii::app()->db;
	//$submission_id= $_GET['subID'];
	$sql = "SELECT sso_users.*,sso_profiles.*,bo_new_application_submission.* from sso_users LEFT JOIN sso_profiles on sso_users.user_id=sso_profiles.user_id LEFT JOIN bo_new_application_submission on sso_users.user_id=bo_new_application_submission.user_id where bo_new_application_submission.submission_id=$subID";
	$command = $connection->createCommand($sql);
	$invData = $command->queryRow();  
?>
<div class='portlet box green'>
	<div class='portlet-title'>
		<div class='caption'>
			<i style=" font-size:20px;" class='fa fa-users'></i>Timeline for Application  ID : <?php echo $subID; ?> </div>
		<div class='tools'> </div>
	</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" >
		 <?php if($subID != ''){
			  // if($typ=='LAND'){ print_r($invData);die;   }
        ?>
			<tr>
				<td><b>Name Of Investor</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo @$invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>Contact Detail</b></td>
				<td><?php echo $invData['mobile_number']." : ".$invData['email']; ?></td>
				<td><b>Application ID</b></td>
				<td><?php echo $subID; ?></td>
			</tr>
			
			<tr style="display:none;">
				<td><b>Unit Name :</b></td>
				<td><?php   echo @$invData['unit_name'] ?></td>
				<td><b>Unit District</b></td>
				<td><?php                         
				if(!empty($invData['landrigion_id'])){
					$districtID=$invData['landrigion_id'];
				}				
				if(!empty($districtID)){
					$sql = "SELECT distric_name from bo_district where district_id=$districtID";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$dname = $command->queryRow();
					echo $dname['distric_name'];
				} ?>
			
				</td>
			</tr>
			<?php } ?>
			
			<tr style="display:none;">
				<td><b>Time taken by Investor</b></td>
				<td id="InvTime"></td>
				<td><b>Time taken by Nodal Agency</b></td>
				<td id="NodTime"></td>                        
			</tr>
		</table>


<table class='table table-striped table-bordered' id='sample_2'>
	<thead>
		<tr>
			<th  class="a_cent">S.No</th>
			<th  class="a_cent">Action Taken By</th>
			<th  class="a_cent">Action Taken On</th>
			<th  class="a_cent">Action Type</th>
			<th  class="a_cent">Comments</th>
			<th  class="a_cent">Time Taken By Applicant</th> 
			<th  class="a_cent">Time Taken By Department User</th>
			
		</tr>	
	</thead>
	<?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending')?>
	<?php if(!empty($res)) { 
			foreach($res as $key=>$val){
			$status=$val['action_status'];
	?>      <tr>
				<td class="a_cent"><?php echo $key+1;?></td>
				<td  class="a_cent" title="<?php echo $val['service_id']?>"> <?php echo $val['action_taken_by_name']?></td>
				<td class="v_a"><?php echo date("d-M-Y H:i:s",strtotime($val['created']));?></td>
				<td class="v_a" ><?php echo $val['action_message']?></td>
				<td class="v_a"><?php echo $val['department_comment']?></td>
				<td class="v_a"><?php echo "NA";?></td>
				<td class="v_a"><?php echo "NA"; ?></td>
				 </tr>
	<?php 	}
		}
	?>
	
</table>	




<?php
}else{
	echo "You are unauthorised to access this url";	
//$this->redirect(Yii::app()->request->urlReferrer);
}
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

		