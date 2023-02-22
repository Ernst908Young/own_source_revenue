<title>Ticket/Query</title>
<?php 
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk"; ?>
<div class="row">
    <div class="col-md-12">
     
        <h2 class="heading">Welcome to Digital Corporate Registry System - Query</h2>
        <!-- <div class="d-flex justify-content-between mb-3">           
            <div class="text-center">
                <div class="form-check form-check-inline">
                    <select id="status_s" onchange="statusegchang($(this).val())">
                        <option>All Status</option>
                        <1?php 
                            $sta_arr = ['Draft'=>'Draft','Payment Due'=>'Payment Due','Pending for Approval'=>'Pending for Approval','Approved'=>'Approved','Reverted'=>'Reverted','Refund Requested'=>'Refund Requested','Refund Successful'=>'Refund Successful'];    
                            foreach($sta_arr as $val){ ?>
                                <option value="<1?php echo $val; ?>"><1?php echo $val; ?></option>              
                         <1?php $k++; } ?>
                    </select>
                </div>
            </div>
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="card position-relative">
            <div class="d-flex justify-content-start dashboard_desc">
                <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Icon awesome-firstdraft.png" class="dashboard_cardicon bg-1">
                <div>
                    <p class="mb-0">Total Query</p>
                    <h4><?php echo $query_count['total_q']; ?></h4>
                </div>
            </div>
            <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Mask Group 3.png" class="dashboard_cardimg">
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="card position-relative">
            <div class="d-flex justify-content-start dashboard_desc">
                <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Icon metro-calendar.png" class="dashboard_cardicon bg-2">
                <div>

                    <p class="mb-0">Closed</p>
                    <h4><?php echo $query_count['close_q']; ?></h4>
                </div>
            </div>
            <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Mask Group 2.png" class="dashboard_cardimg">
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="card position-relative">
            <div class="d-flex justify-content-start dashboard_desc">
                <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Group 59.png" class="dashboard_cardicon bg-3">
                <div>

                    <p class="mb-0">Open</p>
                    <h4><?php echo  $query_count['open_q']; ?></h4>
                </div>
            </div>
            <img src="<?php echo $basePath; ?>/assets/applicant2/assets/img/Mask Group 4.png" class="dashboard_cardimg">
        </div>
    </div>
    
    
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card p-0 mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="my-2">Total Tickets</h4>
                    <div class="pull-right">
                       <a href="/backoffice/queries/default/index/tq" class="btn btn-primary">Create new Query</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive datatablediv">
                <table  id="sample_1" width="100%" class="table">
                     <thead> 
                           <tr>
                              <th class="text-center">
                                SR. No.
                               </th>
                               <th class="text-center">
                                Query ID
                               </th>
                               <th class="text-center">
                                Query Type
                               </th>
                              
                               <th class="text-center">
                                Service Category
                               </th>
                               <th class="text-center">
                                Service Name
                               </th>
                               <th class="text-center">
                                Status
                               </th>
                               <th class="text-center">
                                Created on
                               </th>
                             <!--   <th class="text-center">
                                <h5>Document</h5>
                               </th> -->
                               <th class="text-center">
                                Action
                               </th>
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php

                        if($query_records){
             
                            foreach ($query_records as $key => $val) { ?>    
                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                
                               <td class="text-center">
                                <p><?= $key+1; ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['querycode'] ?></p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['query_type'] ?>  </p>
                               </td>
                              
                               <td class="text-center">
                                <p><?php echo $val['category_name'] ?> </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo $val['service_name'] ?></p>
                               </td>
                               <td class="text-center">
                                <p>
                                   <?php echo $val['status']==1?'<span class="opentext">Open</span>':'<span class="closetext">Closed</span>' ?>  
                                </p>
                               </td>
                               <td class="text-center">
                                <p><?php echo date("d, M Y h:i a",strtotime($val['created_on'])) ?>  </p>
                               </td>
                               <!--  <td class="text-center">
                                <p><1?php if($val['filepath']){?>
                                                <a target="_blank" href="<1?php echo $val['filepath']  ?>"><i class="fa fa-file"></i></a>
                                               <1?php } ?></p>
                               </td> -->
                               <td class="text-center">
                                 <?php  $link = Yii::app()->urlManager->createUrl('/queries/default/querydetail/q_id/'.$val['id']); ?>
                                                    <a href="<?php echo $link  ?>/tq"><i class="fa fa-eye"></i></a>
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
       

<!-- <script>  
        $(function() {  
           $( "#tickettab" ).tabs();  
        });  
     </script>  -->

<?php
$base=Yii::app()->theme->baseUrl;
?>
<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
<link href="/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />
<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>   
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

 

<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        
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
    TableDatatablesButtons_query.init();    
});
</script>


