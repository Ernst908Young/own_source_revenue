

<!--?php echo @$_SESSION['uid'] ?-->

<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Grievance List</h4>
         
        </div>
     <style type="text/css">
    
th, td { white-space: nowrap; }
    </style>
        <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_2'>
					<thead>
						<tr>
							<th class="text-center">SR. No.</th>
							<th style="width:5%;text-align:center;">Grievance ID</th>
							
							<th style="width:20%;text-align:center;">Grievance Type</th>
							<!-- <th style="width:10%;text-align:center;">Subject</th> -->
							<th style="width:10%;text-align:center;">Priority</th>
							<th style="width:10%;text-align:center;">Status</th>
                             <th style="width:20%;text-align:center;">Created On</th>
							<th style="width:10%;text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody class="ticket-item">
<?php
		$grievance = Yii::app()->db->createCommand("SELECT sm.id,
            sm.existing_id,
            sm.priority,
            sm.subject,
            sm.status,
            sm.category,
            sm.created_on,
            sm.currently_assign_to
            FROM grievance as sm 
            order by sm.created_on DESC")->queryAll();

						if($grievance){
							$status_arr = array('O'=>'Open','W'=>'Withdrawn','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated');

                           
							//print_r($tickets);
							$n = 0;
							foreach ($grievance as $key => $val) { 
								$n++;
							?>                                        

                 <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
											<td class="text-center">
												<p><?php echo $n; ?></p>
											</td>

											<td style="width:5%;text-align:center;">
                                            
                                            <?php if($val['currently_assign_to']==$_SESSION['uid'] || $val['currently_assign_to']==0){
  ?>
   <?php echo $val['id'] ?>
<?php }else{ 
    $assto_user = Yii::app()->db->createCommand("SELECT * from bo_user WHere uid=".$val['currently_assign_to'])->queryRow();
    $au =  $assto_user ? ( $assto_user['full_name'].' '.$assto_user['middle_name'].' '.$assto_user['last_name'].' '.$assto_user['email']) : 'NA';
    ?>
     <a title="<?= $au ?>" style="color:blue;"><?php echo $val['id'] ?></a>
<?php } ?>
											</td>
										
                                            <td style="width:20%;text-align:center;">
												<?php echo ($val['category']=="Ticket" || $val['category']=="Query") ? 'Existing '.$val['category'] : $val['category'] ?>	
											</td>
											
											<!-- <td style="width:10%;text-align:center;"> 
												<1?php echo $val['subject'] ?>	
											</td> -->
											<td style="width:10%;text-align:center;"> 
												<?php echo $val['priority'] ?>	
											</td>
											<td style="width:10%;text-align:center;"> 
												<?php                           
                                                    echo (array_key_exists($val['status'],$status_arr) ? $status_arr[$val['status']] : 'NA'); 
                                                ?> 	 
											</td>	
                                             <td style="width:20%;text-align:center;"> 
                                                <?php echo date("d M Y h:i a",strtotime($val['created_on'])) ?>   
                                            </td>   											
											<td style="width:10%;text-align:center;">
<?php //if($val['currently_assign_to']==$_SESSION['uid'] || $val['currently_assign_to']==0){
    $link = Yii::app()->urlManager->createUrl('/grievance/default/supportgrievancedetail/sm_id/'.$val['id']); ?>
		<a href="<?php echo $link  ?>" style="color:blue;">See Detail</a>
<?php //} ?>
											
											</td>
										</tr>
							<?php 	}
								}
							?>
					</tbody>
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
      
        <!-- END PAGE LEVEL PLUGINS -->
	<script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_2");

            e.dataTable({
                scrollX: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "Entries: _MENU_ ",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
               order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                  dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
     $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');

   

});
</script>