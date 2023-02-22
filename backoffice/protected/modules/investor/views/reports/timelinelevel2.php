<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style type="text/css">
  .mr-10{
    margin-right:10px;
  }
</style>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
          <li>Reports</li>
          <li>
            <a href="<?php echo $_SESSION['timelinepreviousurl'] ?>">
               Time Line Report Level 1
            </a>
          </li>
          <li>Timeline Report Level 2</li>
        </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
           Timeline Report Level 2
            </h4>
        <div class="form-row">
         <?php $sserd = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters where CONCAT(service_id,'.',servicetype_additionalsubservice) = $service_id")->queryRow(); ?>
        From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong> | Service: <strong><?= $sserd['core_service_name'] ?></strong>
      </div>
      <!-- <form method="get">
        <div class="form-row row">
          <div class="col-lg-3 form-group">
            <input type="hidden" autocomplete="off" id="services_id" name="services_id" class="datepicker form-control from_date" labelname="from_date" value="<1?= $_GET['services_id']; ?>"  required />
            <label>From Date</label>
            <input type="inputType" autocomplete="off" id="from_date" name="from_date" class="datepicker form-control from_date" labelname="from_date" value="<?= $from_date ?>" readonly required />
          </div>
          <div class="col-lg-3 form-group">
            <label>To Date</label>
            <input type="inputType" autocomplete="off" id="to_date" name="to_date" class="datepicker form-control to_date" labelname="to_date" value="<?= $to_date ?>" readonly required />
          </div>
        
                  
          <div class="col-lg-2 form-group" style="margin-top: 32px;">
            <button type="submit" class="btn-primary">Search</button>
          </div>
        </div>
      </form>
 -->
     
 
</div>       
</div>
 <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
               <table  id="sample_1" width="100%">
                       <thead> 
                           <tr>
                               <th class="text-center">
                                <h5>SRN No.</h5>
                               </th>
                                <th class="text-center">
                                <h5>Application reference ID </h5>
                               </th>
                              
                            
                              <th class="text-center">
                                <h5>Average Application Submission Time</h5>
                               </th>                              
                               <th class="text-center">
                                <h5>Average Application Submission to Payment Approval Time</h5>
                               </th>                               
                               <th class="text-center">
                                <h5>Average Payment Approval to Application Closing Time</h5>
                               </th class="text-center">
                               <th><h5>Average Application Processing Time</h5></th>
                              <th class="text-center">
                                <h5>Application Status</h5>
                               </th> 
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
                        if($records){
                            foreach($records as $key => $value) 
                        {
                        


$total_draft_date = $total_drafttopd_date = $total_app_approve_date = $srn_count = 0 ;
 $drafts = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$value['submission_id']." AND application_status IN ('I','DP','PD') AND service_id=".$_GET['s_id']." GROUP BY app_id")->queryRow();
  $draftd1 = date_create(date('Y-m-d',strtotime($drafts['max_date'])));
  $draftd2 = date_create(date('Y-m-d',strtotime($drafts['min_date'])));
  $diff  = date_diff($draftd1,$draftd2);
  $total_draft_date = $diff->format("%a");

  $ay_approve = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$value['submission_id']." AND application_status IN ('PD','P') AND service_id=".$_GET['s_id']." GROUP BY app_id")->queryRow();

          $draftd_topd1 = date_create(date('Y-m-d',strtotime($ay_approve['max_date'])));
          $draftd_topd2 = date_create(date('Y-m-d',strtotime($ay_approve['min_date'])));
          $diff  = date_diff($draftd_topd1,$draftd_topd2);
          $total_drafttopd_date= $diff->format("%a");


   $app_approve = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$value['submission_id']." AND application_status IN ('P','A') AND service_id=".$_GET['s_id']." GROUP BY app_id")->queryRow();

          $app_approve1 = date_create(date('Y-m-d',strtotime($app_approve['max_date'])));
          $app_approve2 = date_create(date('Y-m-d',strtotime($app_approve['min_date'])));
          $diff  = date_diff($app_approve1,$app_approve2);
          $total_app_approve_date= $diff->format("%a");

                   ?>    
                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                               <td class="text-center">
                                <p><?= $key+1 ?></p>
                               </td>
                               <td class="text-center">
                                <?= $value['submission_id'] ?>
                               </td>
                              <td class="text-center">
                                <?= $total_draft_date.' days' ?>
                               </td>

                               <td class="text-center">
                               <?= $total_drafttopd_date.' days' ?>
                               </td>

                               <td class="text-center">
                               <?= $total_drafttopd_date.' days' ?>
                               </td>
                              <td class="text-center">
                                  <?= $total_draft_date+$total_drafttopd_date+$total_drafttopd_date.' days' ?>
                               </td>
                              <td class="text-center">                              
                                  <?php
                               switch ($value['application_status']) {
            case "I":
             echo "Draft";
                  break;
            case "DP":
               echo "Draft";      
              break;

             case "PD":                      
              echo "Payment Due";                
              break; 

            case "P":
              echo "Pending for Approval";
              break;
            case "F":
              echo "Pending for Approval";
              break;
            case "FA":
              echo "Pending for Approval";
              break; 
            case "AB":
              echo "Pending for Approval";
              break; 

            case "A":
              echo "Approved";
              break;                                     
                           
            case "H":
              echo "Reverted";    
              break;  
            
            case "R":
              echo "Rejected";
              break;
            case "W":
              echo "Withdrawn";
              break;  
            default:
              echo "No Status";
          }
                                ?> 
                               </td>
                               <!-- <td class="text-center">
                                <?php //echo date('d-m-Y',strtotime($value['created_on'])); ?>
                               </td> -->
                           </tr>                                    
                            <?php   }
                                }
                            ?>
                         
                       </tbody> 
                    </table> 
</div>

</div>
</div>

  <script type="text/javascript">
    $(document).ready(function () {
      var date = new Date();
  date.setDate(date.getDate());
      $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
            dateFormat: 'dd-mm-yy',
            autoclose:true,
            maxDate: date
            });
    });
  </script>



<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>



<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


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
                buttons: [{

                     extend: "pdf",

                     className: "mr-10 btn-primary mr-1",


                 }, {

                     extend: "excel",

                     className: "mr-10 btn-primary from-group",
                    

                 }],
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                dom: "<'row'<'col-md-2 col-xs-5 form-group'l><'col-md-4 col-xs-5 form-group'B><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                onDataLoad: function(e) {
                       
    
   
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
   
  
                },
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 20,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    buttons: [ {

                         extend: "pdf",

                         className: "btn-primary"

                     }, {

                         extend: "excel",

                         className: "btn-primary"

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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {

 

   
 TableDatatablesButtons.init();
    

     
});

</script>
