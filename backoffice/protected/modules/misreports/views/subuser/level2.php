<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li> 
           <li>Reports</li>
           <li> <a href="/backoffice/misreports/subuser/level1/otd/reports?from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>&sp_status=<?php echo $sp_status;?>&company_id=<?php echo $company_id; ?>">Sub User Report Level 1</a></li>
      		<li>
      			Sub User Report Level 2
      		</li>
          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                 Sub User Report Level 2
            </h4>
        <div class="form-row">
			<?php $subuser = Yii::app()->db->createCommand("
          SELECT sum.id,sum.sub_user_id,sum.sp_status,sum.created_on,sum.action_date,
          CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as subuser_name, c.company_name
          FROM agent_service_provider_sub_user_mapping sum
          INNER JOIN agent_service_provider a ON sum.asp_id=a.id
          INNER JOIN sso_profiles p on sum.sub_user_id=p.user_id
          INNER JOIN bo_company_details c ON a.company_id=c.id
          where sum.id=$sum_id")->queryRow(); ?>
        From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong>  | Sub User Name: <strong><?=  $subuser['subuser_name'] ?></strong>| Current Status: <strong><?php   if($subuser['sp_status']=='N') {$status = 'Nominated';}
            else if($subuser['sp_status']=='O') {$status = 'Onboarded';}
            else if($subuser['sp_status']=='R') {$status = 'Removed';}
            else{$status ="";}
            echo $status; ?></strong> | Entity Assign: <strong><?= $subuser['company_name'] ?></strong>
         
        <?php 
            $pdfurl = "/backoffice/misreports/subuser/level2pdf?sum_id=$sum_id&sub_user_id=$sub_user_id&from_date=$from_date&to_date=$to_date";
       ?>
          <form method="get">
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />           
            <input type="hidden" name="sub_user_id" value="<?= $sub_user_id ?>" />
            <input type="hidden" name="sum_id" value="<?= $sum_id ?>" />

             <div class="form-row row">
                 <div class="col-lg-6 form-group">
                   
           
            <a href="<?= $pdfurl ?>" target="_blank"  class="btn-primary">PDF</a>
          </div>
             </div>
          </form>
        
      </div>
   
 
</div>       
</div>
<style type="text/css">
    tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    th, td { white-space: nowrap; }
</style>

<table  id="sample_2" width="100%">
   <thead> 
       <tr>
           <th class="text-center">
            <h5>SR. No.</h5>
           </th>
            <th class="text-center">
            <h5>Service Name</h5>
           </th>
           <th class="text-center">
            <h5>Applicant Name</h5>
           </th>
           <th class="text-center">
            <h5>Entity</h5>
           </th>
          <th class="text-center">
            <h5>SRN. No.</h5>
          </th>
          <th class="text-center">
            <h5>Application Status</h5>
          </th>
          <th class="text-center">
            <h5>Created On</h5>
           </th>
           
       </tr>
   </thead>
<tbody class="ticket-item">

<?php 
    foreach ($records as $key => $value) { ?>

    <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
       <td class="text-center">
        <p><?= $key+1 ?></p>
       </td>
        <td>
         <?php if($value['service_id']=='2.0'){
          $newAppSubArr = json_decode($value['field_value'],true);
          if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0'])){
            if($newAppSubArr['UK-FCL-00044_0']==1){
                 echo "Name Reservation-Society (Form 15)";
            }else{
              if($newAppSubArr['UK-FCL-00044_0']==1){
                  echo 'Name Reservation-Company (Form 33)';
              }else{
                if($newAppSubArr['UK-FCL-00044_0']==3){
                    echo 'Business Name Registration (Form 1)';
                }else{
                  echo $value['service_name'];
                }
              }
            }
          }else{
            echo $value['service_name'];
          }
         }else{
         echo $value['service_name'];
         } ?> 
       </td>
        <td class="text-center">
         <?php echo $value['app_name'] ?> 
       </td>

       
        <td class="text-center">
          <?php echo isset($value['company_name']) ? $value['company_name'] : 'NA' ?>
       </td>
       <td class="text-center">
          <?php echo $value['submission_id'] ?>
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
            case "RI":
              echo "Refund Initiated";
              break;  
            case "RS":
              echo "Refund Success";
              break;  
            default:
              echo "No Status";
          }
      ?> 
     </td>
     <td>
         <?= $value['application_created_date'] ? date('d-m-Y',strtotime($value['application_created_date'])) : '' ?>
     </td>
  </tr>

<?php } ?>
                          </tbody> 
                       
                    </table>
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
            var e = $("#sample_2");
            e.dataTable({
                 scrollX: true,
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
                 buttons: [ 
               /* {

                     extend: "pdf",

                     className: "mr-1 btn-primary mr-1",


                 }, {

                     extend: "excel",

                     className: "mr-1 btn-primary from-group",
                    

                 }*/
                 ],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                /*dom: "<'row'<'col-md-2 col-xs-5 form-group'l><'col-md-4 col-xs-5 form-group'B><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"*/
                 dom: "<'row'r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                   buttons: [  {

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