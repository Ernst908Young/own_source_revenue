<title>Ticket/Query</title>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
          <li>Ticket & Query</li>
          </ul>
      <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
           <h4>Welcome to Digital Corporate Registry System</h4>
            <!-- <div class="serach-bar">
                <form>
                    <div class="search-field position-relative">
                        <input type="text" name="" placeholder="Search">
                    <button class="search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    </div>
                </form>
            </div> -->
        </div>
        
        <div class="row">
            <div id="tickettab" class="my-5">
                <ul>
                    <li><a href="#ticketsummary">Ticket Summary</a></li>
                    <li><a href="#querysummary">Query Summary</a></li>
                </ul>
                <div id="ticketsummary">
                    <div class="my-3 p-4 tabcontentbox">
                        <div class="d-flex justify-content-center ticketinnerbox">
                            <div class="summmarybox">
                                <h2 class="color_total"><?php echo $tickets_count['total_t']; ?>
                                    <span>Total Tickets</span>
                                </h2>
                            </div>
                           
                            <div class="summmarybox">
                                <h2 class="color_closed"><?php echo $tickets_count['close_t']; ?>
                                    <span>Closed</span>
                                </h2>
                            </div>
                             <div class="summmarybox">
                                <h2 class="color_active"><?php echo $tickets_count['open_t']; ?>
                                    <span>Open</span>
                                </h2>
                            </div>
                            <div class="summmarybox">
                                <h2 class="color_pending">
                                  <?php echo $tickets_count['rv_t']; ?>
                                  <span>Reverted</span>
                                </h2>
                            </div>
                     
                                                     
                        </div>
                         <div class="d-flex justify-content-center ticketinnerbox">
                            <div class="summmarybox">
                                <h2 class="color_closed"><?php echo $tickets_count['rs_t']; ?>
                                    <span>Resolved</span>
                                </h2>
                            </div>
                             <div class="summmarybox">
                                <h2 class="color_active"><?php echo $tickets_count['ro_t']; ?>
                                    <span>Reopened</span>
                                </h2>
                            </div> 
                            <div class="summmarybox">
                                <h2 class="color_active"><?php echo $tickets_count['esc_t']; ?>
                                    <span>Escalated</span>
                                </h2>
                            </div>  
                         </div>
                        <div class="d-flex justify-content-center align-items-center pt-4">
                            <a href="/backoffice/ticketing/default/index/tq" class="btn-secondary">Create new Ticket</a>
                        </div>
                   </div>

                   <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
                    <table  id="sample_1" width="100%">
                       <thead> 
                           <tr>
								<th class="text-center">
									<h5>SR. No.</h5>
                               </th>
                               <th class="text-center">
                                <h5>Ticket ID</h5>
                               </th>
                               <th class="text-center">
                                <h5>SRN</h5>
                               </th>
                                <th class="text-center">
                                <h5>Ticket Type</h5>
                               </th>
                               <th class="text-center">
                                <h5>Service Category</h5>
                               </th>
                               <th class="text-center">
                                <h5>Service Name</h5>
                               </th>
                               <th class="text-center">
                                <h5>Status</h5>
                               </th>
                               <th class="text-center">
                                <h5>Created on</h5>
                               </th>
                             <!--   <th class="text-center">
                                <h5>Document</h5>
                               </th> -->
                               <th class="text-center">
                                <h5>Action</h5>
                               </th>
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php

                        if($tickets_records){
							$status_arr = array('O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated');
                            $n=1;foreach ($tickets_records as $key => $val) { ?>    
                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
								
                               <td class="text-center">
                                <p><?= $n; ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['supporttypecode'] ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['srn_app_id'] ?>  </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['ticket_type'] ?> </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['category_name'] ?> </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['service_name'] ?></p>
                               </td>
                               <td class="text-center">
                                <p>
                                    <?php                                           
                                               echo (array_key_exists($val['status'],$status_arr) ? $status_arr[$val['status']] : 'NA'); ?> 
                                </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo date("d M Y h:i a",strtotime($val['created_on'])) ?>  </p>
                               </td>
                               <!--  <td class="text-center">
                                <p><1?php if($val['filepath']){?>
                                                <a target="_blank" href="<1?php echo $val['filepath']  ?>"><i class="fa fa-file"></i></a>
                                               <1?php } ?></p>
                               </td> -->
                               <td class="text-center">
                                <?php $link = Yii::app()->urlManager->createUrl('/ticketing/default/ticketdetail/sm_id/'.$val['supportmaincode']); ?>
                                    <a href="<?php echo $link  ?>/tq"><i class="fa fa-eye"></i></a>
                                <!-- <i class="fa fa-ellipsis-h"></i> -->
                               </td>
                           </tr>                                    
                            <?php   $n++;}
                                }
                            ?>
                         
                       </tbody> 
                    </table>
                     </div>
                </div>
                <div id="querysummary">
                    <div class="my-3 p-4 tabcontentbox">
                        <div class="d-flex justify-content-center ticketinnerbox">
                            <div class="summmarybox">
                                <h2 class="color_total"><?php echo $query_count['total_q']; ?>
                                    <span>Total Query</span>
                                </h2>
                            </div>
                           
                            <div class="summmarybox">
                                <h2 class="color_closed"><?php echo $query_count['close_q']; ?>
                                    <span>Closed</span>
                                </h2>
                            </div>
                             <div class="summmarybox">
                                <h2 class="color_active"><?php echo $query_count['open_q']; ?>
                                    <span>Open</span>
                                </h2>
                            </div>
                            <!-- <div class="summmarybox">
                                <h2 class="color_pending">0
                                    <span>Pending</span>
                                </h2>
                            </div> -->
                        </div>
                        <div class="d-flex justify-content-center align-items-center py-4">
                            <a href="/backoffice/queries/default/index/tq" class="btn-secondary">Create new Query</a>
                        </div>
                    </div>
        
                    <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
                    <table  id="sample_2" width="100%">
                       <thead> 
                           <tr>
                               <th class="text-center">
									<h5>SR. No.</h5>
                               </th>
							   <th class="text-center">
                                <h5>Query Id</h5>
                               </th>
                               <th class="text-center">
                                <h5>Query Type</h5>
                               </th>
                               <th class="text-center">
                                <h5>Service Category</h5>
                               </th>
                               <th class="text-center">
                                <h5>Service Name</h5>
                               </th>
                               <th class="text-center">
                                <h5>Status</h5>
                               </th>
                               <th class="text-center">
                                <h5>Created on</h5>
                               </th>                              
                               <th class="text-center">
                                <h5>Action</h5>
                               </th>
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
                        if($query_records){
                            foreach ($query_records as $key => $val) { ?>    
                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                               <td class="text-center">
                                <p><?php echo $key+1 ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['querycode'] ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['query_type'] ?>  </p>
                               </td>
                               <td class="text-center">
                                <p> <?php echo $val['category_name'] ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['service_name'] ?> </p>
                               </td>
                               
                               <td class="text-center">
                                <p>
                                    <?php echo $val['status']==1?'<span class="opentext">Open</span>':'<span class="closetext">Closed</span>' ?>  
                                </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo date("d M Y h:i a",strtotime($val['created_on'])) ?>  </p>
                               </td>
                                
                               <td class="text-center">
                                <?php  $link = Yii::app()->urlManager->createUrl('/queries/default/querydetail/q_id/'.$val['id']); ?>
                                                    <a href="<?php echo $link  ?>/tq"><i class="fa fa-eye"></i></a>
                                <!-- <i class="fa fa-ellipsis-h"></i> -->
                               </td>
                           </tr>                                    
                            <?php   }
                                }
                            ?>
                         
                       </tbody> 
                    </table>
                     </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>  
        $(function() {  
           $( "#tickettab" ).tabs();  
        });  
     </script> 

<?php
$base=Yii::app()->theme->baseUrl;
?>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
       <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
     <!--    <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        
        <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();

  
    /*$("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');*/
  
     TableDatatablesButtons_query.init();
 /*   $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');*/
  
    
});
</script>



 <script type="text/javascript">
  
  var TableDatatablesButtons_query = function() {
   
        qt = function() {
            var e = $("#sample_2");
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
        qn = function() {
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
            jQuery().dataTable && (qt(),qn())
        }
    }
}();

</script>