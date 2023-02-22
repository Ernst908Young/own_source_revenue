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
			<i style=" font-size:20px;" class='fa fa-users'></i>Timeline for SRN : <?php echo $subID; ?> </div>
		<div class='tools'> </div>
	</div>
<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" >
			<?php 
			if($subID != '')
			{			 
			?>
				<tr>
					<td><b>Name Of Investor</b></td>
					<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
					<td><b>UID</b></td>
					<td><?php echo @$invData['iuid']; ?></td>
				</tr>
				<tr>
					<td><b>Contact Detail</b></td>
					<td><?php echo $invData['mobile_number']." : ".$invData['email']; ?></td>
					<td><b>SRN</b></td>
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
			<?php 
			} 
			?>			
			<tr style="display:none;">
				<td><b>Time taken by Investor</b></td>
				<td id="InvTime"></td>
				<td><b>Time taken by Nodal Agency</b></td>
				<td id="NodTime"></td>                        
			</tr>
		</table>
		<table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
				<tr>
					<th style="text-align:center;vertical-align: middle;width:5%">
					S.No.
					</th>
					<th style="text-align:center;vertical-align: middle;width:10% !important ">Action Taken On</th>
					<th style="text-align:center;vertical-align: middle;width:10% !important ">Action Taken By</th>
					<th style="text-align:center;vertical-align: middle; width:8% !important">Status</th>
					<th style="text-align:center;vertical-align: middle;width:35% !important">Remarks on service application <br>displayed in chronological order</th>
					<th style="text-align:center;vertical-align: middle;width:20% !important">Time taken<br>by Applicant</th>
					<th style="text-align:center;vertical-align: middle;width:20% !important">Time taken<br>by Department</th>
				</tr>
            </thead>
            <tbody>
                <?php
				$sql = "SELECT bo_new_application_submission.*,bo_sp_application_history.application_status as current_status,bo_sp_application_history.added_date_time,bo_sp_application_history.comments,bo_sp_application_history.role_user_info from  bo_sp_application_history LEFT JOIN bo_new_application_submission on bo_sp_application_history.app_id=bo_new_application_submission.submission_id where bo_sp_application_history.app_id=$subID";
				$command = $connection->createCommand($sql);
				$apps = $command->queryAll();
				
				$count = 1;
                if (empty($apps)) {

                    echo "<tr><td colspan='5'>No Detail Found</td></tr>";
                } else { 
                    
                    $apps1 = $apps;
                    $diffapplicant = 0;
                    $diffdept = 0;
                    $diffdept12=0;
                    foreach($apps1 as $key => $apps) 
					{                        
                        $appsgf = $apps['current_status'];
                        $status = $apps['current_status'];
                        if($appsgf != "I") 
						{
						?>

                            <tr>
                                <td style="text-align:center;vertical-align: middle;"><?php echo $count++; ?></td>
                                <td style="text-align:center;vertical-align: middle;">
								<?php $create = date('Y-m-d H:i:s', strtotime($apps['added_date_time']));
									echo date('d-M-Y H:i:s', strtotime($apps['added_date_time']));
								?>
								</td>
                                <td align="center">
                                     <?php //echo   ($apps['role_name']?$apps['role_name']:'N.A');?></br>
                                            <?php echo  ($apps['role_user_info']?$apps['role_user_info']:'Applicant');?>
								</td>
                                <?php
                                switch ($appsgf) {
                                    case "A":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-success'><i class='fa fa-check'></i>  Approved</span></td>";
                                        break;
                                    case "B":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span  class='label label'><i class='fa fa-rupee'></i>  Payment</span></td>";
                                        break;
                                    case "P":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-primary'><i class='fa fa-hourglass'></i>  Pending</span></td>";
                                        break;
                                    case "F":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span style='background-color:#F7CA18' class='label label-share'><i class='fa fa-check'></i>  Forward</span></td>";
                                        break;
                                    case "V":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-warning'><i class='fa fa-check'></i>  Verified</span></td>";
                                        break;
                                    case "RBI":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-info'><i class='fa fa-mail-reply'></i>  Reverted</span></td>";
                                        break;
									case "H":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-info'><i class='fa fa-mail-reply'></i>  Reverted</span></td>";
                                        break;	
                                    case "R":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-danger'><i class='fa fa-close'></i>  Rejected</span></td>";
                                        break;
									case "PD":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-danger'><i class='fa fa-close'></i>  Payment Pending</span></td>";
                                        break;	
									 case "FA":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span style='background-color:#F7CA18' class='label label-share'><i class='fa fa-check'></i>  Forward</span></td>";
                                        break;		
									case "DP":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-danger'><i class='fa fa-close'></i>  Document Pending</span></td>";
                                        break;	
									case "PA":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-info'>Provisionally Approved</span></td>";
                                        break;	
									case "W":
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-info'> Withdrawn</span></td>";
                                        break;	
                                    default:
                                        echo "<td style='vertical-align: middle;text-align:center;'> <span class='label label-default'><i class='fa fa-close'></i>No Status</span></td>";
                                }
                                ?>                                
                                <td style='vertical-align: middle;text-align:left;'>
								<?php echo $apps['comments']; ?>
								</td>
                                <td style="text-align: center;">
								<?php
                                    if ($apps['current_status'] == "RBI") 
									{
                                        $keyval = $key - 1;
                                        if ($keyval >= 0) {
                                            $date = $apps1[$keyval]['added_date_time'];
                                        } else {
                                            $date = date('Y-m-d H:i:s');
                                        }
                                        $diff = abs(strtotime($apps['added_date_time']) - strtotime($date));
                                        $diffapplicant = $diffapplicant + $diff;
                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                        $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                        $allDays = ($months * 30) + $days;
										if($years!=0){echo "$years years,";}
										//printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
										printf("%d days", $allDays);
                                    } 
                                    ?>
								</td>
                                <td style="text-align: center;">
								<?php  
									if ($apps['current_status'] != "RBI") {
									
                                        if ($key == 0) {
                                            if ($status == "A" || $status == "R") {
                                                $date = $apps['added_date_time'];
                                            } else {
												
												if(isset($unverifiedDocExist['totalDocV']) && $unverifiedDocExist['totalDocV'] > 0)
												{
													$date = $apps['added_date_time'];
												} else{
													$date = date('Y-m-d H:i:s');
												}
                                            }
                                        } else {
                                            $keyval = $key - 1;
                                            $date = $apps1[$keyval]['added_date_time'];
                                        }

                                        $diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));
                                        $diffdept = $diffdept + $diff1;
                                        $years = floor($diff1 / (365 * 60 * 60 * 24));
                                        $months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                        $hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                        $minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                        $seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                        $allDays = ($months * 30) + $days;
                                        if($years!=0){echo "$years years,";}
                                       // printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
									   printf("%d days", $allDays);
                                    } 
                                ?>
								</td>
							</tr>
                        <?php
                        }
                    }
                }
                ?>       
                <tr>
                    <td style="text-align:center;"><?php echo $count++; ?></td>
                    <td></td>
                    <td></td>
					<td></td>
                    <td  style="text-align:right;"><b>Total Time:</b></td>
                    <td style="text-align: center;">
					<?php 
                        $years = floor($diffapplicant / (365 * 60 * 60 * 24));
                        $months = floor(($diffapplicant - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        $days = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                        $hours = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                        $minuts = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                        $seconds = floor(($diffapplicant - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                        $allDaysapplicant = ($months * 30) + $days;
                        
                        echo "<b>"; if($years!=0){echo "$years years,";} 
					   //printf("%d days, %d hrs, %d min\n", $allDaysapplicant, $hours, $minuts); echo "</b>";
					    printf("%d days", $allDaysapplicant); echo "</b>"; 
                        ?> 
					</td>
                    <td style="text-align: center;"> 
                        <?php //Total time of department
                        $years = floor($diffdept / (365 * 60 * 60 * 24));
                        $months = floor(($diffdept - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        $days = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                        $hours = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                        $minuts = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                        $seconds = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                        $allDaysdept = ($months * 30) + $days;

                       echo "<b>"; if($years!=0){echo "$years years,";} 
					  // printf("%d days, %d hrs, %d min\n", $allDaysdept, $hours, $minuts); echo "</b>"; 
					   printf("%d days", $allDaysdept); echo "</b>"; 
                        ?>
					</td>
                </tr>
            </tbody>
		</table>    

<?php
}else{
	echo "You are unauthorised to access this url";	
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

		