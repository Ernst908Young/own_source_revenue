<title>Transaction code summary Report</title>
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
          <li><a href="/backoffice/admin">Home</a></li>
          <li>Transaction code summary Report Level 1</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Transaction code summary Report Level 1
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
    $pdfurl = "/backoffice/misreports/revenue/tcslevel1pdf?from_date=$from_date&to_date=$to_date";
    $url_components = parse_url($_SERVER['REQUEST_URI']);
     if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        if(isset($params['services_id'])){
           foreach ($params['services_id'] as $key => $value) {
           $pdfurl.='&services_id[]='.$value;
        }
       } 

       if(isset($params['fee_type'])){          
           $pdfurl.='&fee_type='.$params['fee_type'];        
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
           <div class="col-lg-3 form-group">
            <label>Fee Type</label>
              <select name="fee_type"  placeholder="All Fee Type" class="select2-me" id="fee_type" labelname="fee_type">  
                  <option value="NULL">
                      All Fee Type
                  </option>        
                  <option value="service fee" <?= $fee_type=='service fee' ? 'selected' : '' ?>>
                      Service Fee
                  </option>
                  <option value="late fee" <?= $fee_type=='late fee' ? 'selected' : '' ?>>
                      Late Fee
                  </option>
              </select>   
          </div>
                 
          <div class="col-lg-6 form-group" style="margin-top: 35px;">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl  ?>"  target=_blank class="btn-primary">PDF</a>
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
            <h5>Payment code</h5>
           </th>
            <th class="text-center">
            <h5>Service Description</h5>
           </th>
           <th class="text-center">
            <h5>Fee Type</h5>
           </th>

            <th class="text-center">
            <h5>Payment count</h5>
           </th>

           <th class="text-center">
            <h5>Unit charge</h5>
           </th>

          <!--  <th class="text-center">
            <h5>Quantity count</h5>
           </th>   -->                             
          <!--  <th class="text-center">
            <h5>Refund amount</h5>
           </th> -->
            <th class="text-center">
            <h5>Net Revenue</h5>
           </th>
           
       </tr>
   </thead>
     <tbody class="ticket-item">
      <?php
   $_SESSION['tcrl1previousurl'] = $_SERVER['REQUEST_URI']; 
           $late_fee_arr = ['12.0','13.0'];
           $i=1;  $total_amt=0;

       foreach ($records as $key => $value) {    
          if($value['service_id']=='2.0'){
              $cnr_records = Yii::app()->db->createCommand("SELECT 
              q.total_amount as total_amount,     
                q.submission_id,
                q.service_id,
                nas.field_value     
                FROM tbl_payment as q 
                INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id   
                where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
                  AND q.payment_status IN ('success') AND q.payment_mode=3 AND q.service_id='2.0'")->queryAll();
                    
             $next_array = [];

              foreach ($cnr_records as $key => $v) {
                 $newAppSubArr = json_decode($v['field_value'],true);

                if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                    $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];
                    $total_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['total_amt'] + $v['total_amount'];
                     

                    $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'total_amt'=>$total_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

                  }else{
                                          
                     $total_amt = $v['total_amount'];
                     $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'total_amt'=>$total_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
                  }
              }   

               foreach ($next_array as $k => $val) { 
                $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='2.0' AND page_form_id=$k")->queryRow();
                if($fee_type==NULl || $fee_type==$fee_master['fee_detail']){
                  
                ?>
                  <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
                     <td class="text-center">
                      <p><?= $i ?></p>
                     </td>
                     <td>
                       
                        <p><a href="/backoffice/misreports/revenue/tcslevel2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&subservice_id=<?php echo $k;?>&payment_code=<?php echo $fee_master['payment_code'] ;?>&fee_detail=<?php echo $fee_master['fee_detail'] ;?>&page_form_id=<?php echo $fee_master['page_form_id'] ;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'>
                           <?= $fee_master['payment_code'] ? $fee_master['payment_code']  : $value['service_id'] ?>
                          
                        </a></p>
                     </td>
                     <td>
                       <?php if($k==1){
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
                        }  ?>
                     </td>
                     <td class="text-center">
                       <?= $fee_master['fee_detail'] ?>
                     </td>
                     <td class="text-center">
                       <?= $val['count'] ?>
                     </td>
                     <td class="text-center">
                       <?= $fee_master['fee_amount'] ?>                                  
                     </td>                   
                      <td class="text-center">
                        <?= $val['total_amt'] ?>        
                     </td>
                 </tr>
              <?php 
                $total_amt = $total_amt+$val['total_amt'];
              $i++;
            }}
               }else{ 

               if(in_array($value['service_id'], $late_fee_arr)){
                  $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='".$value['service_id']."'")->queryAll();
               }else{
                  $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='".$value['service_id']."'")->queryAll();
               }

               foreach ($fee_master as $k=>$val) {
                 if($fee_type==NULl || $fee_type==$val['fee_detail']){
               
       ?>
        
        
      <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
         <td class="text-center">
          <p><?= $i ?></p>
         </td>

         <td>
          <p>
           <a href="/backoffice/misreports/revenue/tcslevel2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&payment_code=<?php echo $val['payment_code'] ;?>&fee_detail=<?php echo $val['fee_detail'] ;?>&page_form_id=<?php echo $val['page_form_id'] ;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'>
              <?= $val['payment_code'] ? $val['payment_code']  : $value['service_id'] ?>
          
            </a></p>
         </td>
         <td>
           <?= $value['core_service_name'] ?>
         </td>
         <td class="text-center">
            <?= $val['fee_detail'] ?>
         </td>

         <td class="text-center">
          <?php if($val['fee_detail']=='late fee'){
            echo $value['late_fee_count'];
          }else{
            echo $value['service_fees_count'];
          } ?>
           
         </td>


         <td class="text-center">
           <?= $val['fee_amount'] ?>
         </td>

       
          <td class="text-center">
          <?php if($val['fee_detail']=='late fee'){
            echo $value['late_fee'];
             $total_amt = $total_amt+$value['late_fee'];
          }else{
            echo $value['service_total_fee'];
            $total_amt = $total_amt+$value['service_total_fee'];
          } ?>
           
         </td>
     </tr>

     <?php
     $i++;

     }}
   }
     
      }  ?> 
        </tbody> 
  <tfoot>
   <tr>
   <td colspan="5" style="text-align: right;">
    <strong>Total</strong>
   </td>

<td class="text-center">
      <strong><?=  $total_amt ?></strong>
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