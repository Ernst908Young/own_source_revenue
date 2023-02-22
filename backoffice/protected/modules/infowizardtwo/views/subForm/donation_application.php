<title>Received Donations</title>
<?php
$basePath="/themes/investuk";
$role_id = $_SESSION['role_id'];
$userId = $_SESSION['uid'];
$disctrict_id = $_SESSION['dist_id'];
?>

<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Total Doners (<?php if(!empty($all)) { echo count($all); } ?>)</h4>
        </div>
      
		<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
			<table width="100%" id='sample_1'>
				<thead>
					<tr>
						<th class="text-center" width="5%">S.No.</th>
						<th class="text-center" width="5%">Donor Name</th>
						<th class="text-center" width="20%">Donor Contact No.</th>
						<th class="text-center" width="20%">Donor Email</th>
						<th class="text-center" width="10%">Donated Amount (IN INR)</th>
						<th class="text-center" width="12%">Donated Date</th>
					</tr>   
				</thead>				
				<tbody class="ticket-item">            
				<?php 
					
					$totalDonate = 0;
					/* echo "<pre>";
					print_r($all); */
					$i = 1;
					foreach($all as $key=>$val){ 
						$totalDonate = $totalDonate + $val['total_amount'];
				?>
						<tr class="ticket-row tableinside">
							<td class="text-center"><?php echo $i;?></td>
							<td class="text-center"><?php echo $val['first_name'].''.$val['surname'];?></td>                   
							<td class="text-center"><?php echo $val['mobile_no'];?></td>                   
							<td class="text-center"><?php echo $val['email'];?></td>                   
							<td class="text-center"><?php echo $val['total_amount'];?></td>                   
							<td class="text-center"><?php echo date('Y-m-d',strtotime($val['created_at']));?></td>
						</tr> 
				<?php 	$i++;	
					}		
				?>
				
						
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" style="text-align: right;">
						<strong>Total Donation Received</strong>
						</td>
						<td class="text-center">
						<strong><?= $totalDonate; ?></strong>
						</td>
					</tr>              
				</tfoot>                     
				
			</table>
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

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

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

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 responsive: !0,

                 order: [

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

     

         n = function() {

            
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

                         [1, "desc"]

                     ],

                     buttons: []

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

             jQuery().dataTable && (e(), n())

         }

     }

   }();

   jQuery(document).ready(function() {

     TableDatatablesButtons.init();

   });

</script>   