

<!--?php echo @$_SESSION['uid'] ?-->

<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Tickets List</h4>
         
        </div>
     <style type="text/css">
    
th, td { white-space: nowrap; }
    </style>
        <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_2'>
					<thead>
						<tr>
                            <th style="width:5%;text-align:center;">Sr. No</th>
							<th style="width:5%;text-align:center;">Query ID</th>
							<th style="width:20%;text-align:center;">Service Category</th>
							<th style="width:10%;text-align:center;">Service</th>
                            <th style="width:10%;text-align:center;">Mobile</th>
                            <th style="width:10%;text-align:center;">Email</th>
							
							<th style="width:10%;text-align:center;">Priority</th>
							<th style="width:10%;text-align:center;">Status</th>
                             <th style="width:10%;text-align:center;">Created On</th>
							<th style="width:10%;text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody class="ticket-item">
						<?php
						$qmain = Yii::app()->db->createCommand("SELECT q.id, q.querycode,
            q.mobile_no,
            q.email,
            q.servicecategory,
            q.service_id,
            q.user_id,
            q.querypriority,
            q.subject,
            q.created_on,
            q.status,
           s.service_name,
            sc.category_name
             FROM querymain as q 
            LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
            LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id   
            order by created_on DESC")->queryAll();

						if($qmain){
                            $i = 1;
							foreach ($qmain as $key => $val) { ?>                                        

									   <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                                            <td style="width:5%;text-align:center;">
                                                <?=$i?>     
                                            </td>
											<td style="width:5%;text-align:center;">
												<?php echo $val['querycode'] ?>		
											</td>
											<td style="width:20%;text-align:center;">
                                               <?php echo $val['category_name'] ?>   
											</td>
											<td style="width:10%;text-align:center;">
												<?php echo $val['service_name'] ?>	
											</td>
                                             <td style="width:10%;text-align:center;">
                                                <?php echo $val['mobile_no'] ?>  
                                            </td>
                                              <td style="width:10%;text-align:center;">
                                                <?php echo $val['email'] ?>  
                                            </td>
											
											<td style="width:10%;text-align:center;"> 
												<?php echo $val['querypriority'] ?>	
											</td>
											<td style="width:10%;text-align:center;"> 
												<?php echo $val['status']==1?'<span class="label label-success">Open</span>':'<span class="label label-danger">Closed</span>' ?>	
											</td>	
                                             <td style="width:10%;text-align:center;"> 
                                                <?php echo date("d M Y h:i a",strtotime($val['created_on'])) ?>   
                                            </td>   											
											<td style="width:10%;text-align:center;">
												<?php $link = Yii::app()->urlManager->createUrl('/queries/default/supportquerydetail/q_id/'.$val['id']); ?>
													<a href="<?php echo $link  ?>" style="color:blue;">See Detail</a>
											
											
											</td>
										</tr>
							<?php 	$i++;}
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
                  /*  order: [
                        [1, "asc"]
                    ],*/
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