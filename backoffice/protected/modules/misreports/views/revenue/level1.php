<title>Service Wise Revenue Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
  .mr-10{
    margin-right:10px;
  }
</style>
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/panchayatiraj/backoffice/admin">Home</a></li>
          <li>Service Wise Revenue Report Level 1</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Service Wise Revenue Report Level 1
            </h4>
        
         
        
      <form method="get">
        <div class="form-row row">
          <div class="col-lg-3 form-group">
            <label>From Date</label>
            <input type="inputType" autocomplete="off" id="from_date" name="from_date" class="datepicker form-control from_date" labelname="from_date" value="<?= $from_date ?>" readonly required />
          </div>
          <div class="col-lg-3 form-group">
            <label>To Date</label>
            <input type="inputType" autocomplete="off" id="to_date" name="to_date" class="datepicker form-control to_date" labelname="to_date" value="<?= $to_date ?>" readonly required />
          </div>
         
          <div class="col-lg-6 form-group">
    <?php 
    $pdfurl = "/panchayatiraj/backoffice/misreports/revenue/level1pdf?from_date=$from_date&to_date=$to_date";
    $url_components = parse_url($_SERVER['REQUEST_URI']);
     if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        if(isset($params['services_id'])){
           foreach ($params['services_id'] as $key => $value) {
           $pdfurl.='&services_id[]='.$value;
        }
       }       
     }
     $services = Yii::app()->db->createCommand("SELECT id,sc_id,service_name
                   from bo_information_wizard_service_master WHERE id NOT IN (1,3)")->queryAll();
    ?>
            <label>Service Description</label>
              <select name="services_id[]"  multiple='multiple' placeholder="All Services" class="select2-me" id="services_id" labelname="Services">
                    
                   <?php foreach($services as $k=>$v){ 
                    $selects = !empty($service_id)  ? (in_array($v['id'], $service_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v['id'] ?>" <?= $selects ?>>
                        <?php echo $v['service_name'] ?>
                      </option>
                   <?php } ?>
              </select>            
          </div>
          <div class="col-lg-6 form-group">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>" target=_blank class="btn-primary">PDF</a>
          </div>
        </div>
      </form>

 
</div>       
</div>
 <style type="text/css">
      tr:nth-child(even) {
  background-color: #f2f2f2;
}

    </style>

<table  id="sample_1" width="100%">
                       <thead> 
                           <tr>
                               <th class="text-center">
                                <h5>SR. No.</h5>
                               </th>

                               <th class="text-center">
                                <h5>Service Description </h5>
                               </th>

                                <th class="text-center">
                                <h5>Total Number of SRN</h5>
                               </th>

                               <th class="text-center">
                                <h5>Total Amount Received (BBD$)</h5>
                               </th>

                               <th class="text-center">
                                <h5>Total Refund Issued (BBD$)</h5>
                               </th>                               
                               <th class="text-center">
                                <h5>Net Revenue (BBD$)</h5>
                               </th>
                               
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                            <?php
                                  $total_amt = 0;
                                  $total_ref = 0;
                                  $total_net = 0;
                                  $total_srn = 0;
                                  $net =0;
                                  $i=1;
                             foreach ($records as $key => $value) {

                              if($value['service_id']=='2.0'){
                                 $cnr_records = Yii::app()->db->createCommand("SELECT 
                                  q.total_amount as total_amount,
                                  (CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
                                  (CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
                                  q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
                                  q.reference_number,q.bank_name,q.reference_name, q.reference_email, 
                                  q.created_at, nas.application_status, cd.company_name as entity_name, nas.submission_id,
                                  s.service_name , u.iuid, q.payment_received_by, nas.field_value
                                  FROM tbl_payment as q
                                    INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
                                    INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id 
                                    INNER JOIN sso_users u ON nas.user_id = u.user_id
                                    LEFT OUTER JOIN bo_company_details cd on cd.reg_no = nas.entity_name
                                    where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
                                    AND q.payment_status IN ('success','refund success') AND q.service_id='2.0' order by q.created_at desc")->queryAll();
                                $next_array = [];
                                $ref_amt = $paid_amt = 0;
                                foreach ($cnr_records as $key => $v) {
                                   $newAppSubArr = json_decode($v['field_value'],true);

                                  if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                                      $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];

                                        if($v['is_fee_refunded']==1){
                                          $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['total_amount'];
                                          $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                                         }else{
                                          $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                                          $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['total_amount'];
                                         }


                                       

                                      $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

                                    }else{
                                       if($v['is_fee_refunded']==1){
                                            $ref_amt = $v['total_amount'];
                                         }else{
                                          $paid_amt = $v['total_amount'];
                                         }
                                       $total_amtc = $v['total_amount'];
                                       $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
                                    }
                                }

                                foreach ($next_array as $k => $val) { ?>
                                      <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
                                       <td class="text-center">
                                        <p><?= $i ?></p>
                                       </td>

                                       <td>
                                           <?php $_SESSION['swrpreviousurl'] = $_SERVER['REQUEST_URI']; ?>
                                        
                                          <p><a href="/panchayatiraj/backoffice/misreports/revenue/level2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&subservice_id=<?php echo $k;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'><?php if($k==1){
                                            echo 'Name Reservation-Society (Form 15)';
                                          }else{
                                            if($k==2){
                                              echo 'Name Reservation-Company (Form 33)';
                                            }else{
                                              if($k==3)
                                                echo "Business Name Registration (Form 1)";
                                              else
                                                echo 'NA';
                                            }
                                          }  ?></a></p>
                                       </td>
                                       <td class="text-center"><?= $val['count'] ?></td>
                              

                                       <td class="text-center">
                                          <?php echo round($val['paid_amt'],2); ?>
                                       </td>

                                       <td class="text-center">
                                          <?php $refund =$val['ref_amt'];
                                           echo   round($refund , 2); ?>
                                       </td>
                                     
                                       <td class="text-center">
                                        <?php
                                      $net = $val['paid_amt'] -  $refund ;
                                         echo  round($net ,2) ; ?>
                                       </td>
                                   </tr>
                               <?php  
                                $total_srn = $total_srn+$val['count'];
                               $total_amt =  $total_amt+$val['paid_amt'];
                               $total_ref  = $total_ref+$val['ref_amt'];
                               $total_net =  $total_net + $net; 

                               $i++;
                             }
                          } else{
                               
                             ?>
                              
                              
                            <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
                               <td class="text-center">
                                <p><?= $i ?></p>
                               </td>

                               <td>
                                   <?php $_SESSION['swrpreviousurl'] = $_SERVER['REQUEST_URI']; ?>
                                
                                  <p><a href="/panchayatiraj/backoffice/misreports/revenue/level2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'><?php echo $value['service_name']; ?></a></p>
                               </td>
                               <td class="text-center"><?= $value['total_services'] ?></td>
                      

                               <td class="text-center">
                                  <?php echo round($value['total_amount'],2); ?>
                               </td>

                               <td class="text-center">
                                  <?php $refund =$value['ref_amt'];
                                   echo   round($refund , 2); ?>
                               </td>
                             
                               <td class="text-center">
                                <?php
                              $net = $value['total_amount'] -  $refund ;
                                 echo  round($net ,2) ; ?>
                               </td>
                           </tr>

                           <?php
                            $total_srn = $total_srn+$value['total_services'];
                           $total_amt =  $total_amt+$value['total_amount'];
                           $total_ref  = $total_ref+$value['ref_amt'];
                            $total_net =  $total_net + $net;

                            $i++;
                         }
                          
                           
                            }  ?> 
                              </tbody> 
                             <tfoot>
                           <tr>
   <td colspan="2" style="text-align: right;">
    <strong>Total</strong>
   </td>

<td class="text-center">
      <strong><?= $total_srn ?></strong>
   </td>
   <td class="text-center">
      <strong><?= round($total_amt,2) ?></strong>
   </td>

   <td class="text-center">
      <strong><?= round($total_ref ,2) ?></strong>
   </td>
 
   <td class="text-center">
    <strong><?= round($total_net,2) ; ?></strong>
   </td>
</tr>              
</tfoot>                     
                        
                     
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
            var e = $("#sample_1");
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