<title>Service Revenue Summary Report</title>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
  .mr-10{
    margin-right:10px;
  }
</style>
<?php $baseUrl = Yii::app()->theme->baseUrl; 
	
?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li>Service Revenue Summary Report Level 1</li>
          </ul>
    

  <div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Service Revenue Summary Report Level 1
            </h4>
        
         
        
      <form method="post">
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
    
            <label>Service Description</label>
              <select name="services_id[]"  multiple='multiple' placeholder="All Services" class="select2-me" id="services_id" labelname="Services">
                    
                   <?php foreach($services as $k=>$v){ 
                      if($min_amt==NULL || $max_amt==NULL || ($v['total_revenue']>=$min_amt && $v['total_revenue']<=$max_amt)){   
                    $selects = !empty($service_id)  ? (in_array($v['service_id'], $service_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v['service_id'] ?>" <?= $selects ?>>
                        <?php echo $v['core_service_name'] ?>
                      </option>
                   <?php } } ?>
              </select>            
          </div>
           <div class="col-lg-4 form-group">
                <label>Graph Type</label>
                  <select name="graph_type[]"  placeholder="select graph" class="select2-me" id="graph_id" labelname="Graph" multiple="true" >
                       
                       <?php 
                       $grap_op = ['line'=>'Line Graph','bar'=>'Bar Graph','pie'=>'Pie Chart','donate'=>'Donut Chart'];
                       foreach ($grap_op as $k => $v) { 
                         $selects = !empty($grap_id)  ? (in_array($k, $grap_id) ? 'selected' : '') : '' ;
                       
                        ?>
                         <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v ?>
                      </option>
                      <?php } ?>
                   
                  
                  </select>
              </div>
              <br><br> <br><br> 
               <div class="col-lg-4 form-group">
                 <label>Minimum Amount (BBD$)</label>
               <input type="number" name="min_amt" value="<?= $min_amt ?>" placeholder="Enter at least 1 or greater than 1" class="form-control"> </div>
               <div class="col-lg-4 form-group">
                 <label>Maximum Amount (BBD$)</label>
               <input type="number" name="max_amt" value="<?= $max_amt ?>" placeholder="Enter amt. greater than min. amt." class="form-control"> 
               </div>
              
               
        
          <div class="col-lg-2 form-group">
            <button type="submit" class="btn-primary">Search</button>
           
          </div>
           </div>
          </form>
          <?php 
              $pdfurl = "/backoffice/misreports/revenue/srspdf?from_date=$from_date&to_date=$to_date";
			  $url_components = parse_url($_SERVER['REQUEST_URI']);
			 
				  if(isset($service_id)){
					 foreach ($service_id as $key => $value) {
					   $pdfurl.='&services_id[]='.$value;
					}
				  }
			  
           /*  $url_components = parse_url($_SERVER['REQUEST_URI']);
			
             if(isset($url_components['query'])){
                parse_str($url_components['query'], $params);
                if(isset($params['services_id'])){
                   foreach ($params['services_id'] as $key => $value) {
                   $pdfurl.='&services_id[]='.$value;
                }
               }  
               if(isset($params['graph_type'])){
                   foreach ($params['graph_type'] as $key => $value) {
                   $pdfurl.='&graph_type[]='.$value;
                }
               }      
             }
     $services = Yii::app()->db->createCommand("SELECT id, service_name
        from bo_information_wizard_service_master WHERE id NOT IN (1,3)")->queryAll(); */
		
    ?>
          <form action="<?= $pdfurl ?>" method="post" target="_blank">
            <div class="form-row row">
              <div class="col-lg-1 form-group">
                <input type="hidden" name="from_date" value="<?= $from_date?>">
                <input type="hidden" name="to_date" value="<?= $to_date?>">
                <input type="hidden" name="min_amt" value="<?= $min_amt?>">
                <input type="hidden" name="max_amt" value="<?= $max_amt?>">
                <input type="hidden" name="services_id" value="<?= json_encode($service_id) ?>">
                <input type="hidden" name="graph_type" value="<?= json_encode($grap_id)?>">
                <textarea name="linegraphdata" id="linegraphdata" hidden="hidden"></textarea>
                <textarea name="bargraphdata" id="bargraphdata" hidden="hidden"></textarea>
                <textarea name="piechartdata" id="piechartdata" hidden="hidden"></textarea>
                <textarea name="donutchartdata" id="donutchartdata" hidden="hidden"></textarea>
              </div>
              <div class="col-lg-2 form-group" style="text-align: center; margin-top: -63px;">
                <button type="submit" class="btn-primary">PDF</button>
              </div>
             </div>
          </form>
        <div class="form-row row">
          <div class="col-lg-12 form-group" style="color: red;">
             <?php echo $error; ?>
          </div>
        </div>
       

      

 


<?php 
if($grap_id!=NULL){
$this->renderPartial('srs_adv',['from_date'=>$from_date,'to_date'=>$to_date,'grap_id'=>$grap_id,'service_id'=>$service_id, 'records'=>$records,'min_amt'=>$min_amt,'max_amt'=>$max_amt,'error'=>$error]);
  }
 ?>

</div>       
</div>
<!-- <div class="reservation-form p-0">
  <div class="form-part bussiness-det">                          
    <h4 class="form-heading">
      Service Revenue Summary
    </h4>
     

 
</div>       
</div> -->
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
          <h5>Total Gross Filings (# SRNs)</h5>
         </th>
          <th class="text-center">
          <h5>Total Refund (# SRNs)</h5>
         </th> 
         <th class="text-center">
          <h5>Total Net Filings (# SRNs)</h5>
         </th>
         <th class="text-center">
          <h5>Gross Revenue Received (BBD$)</h5>
         </th>
          <th class="text-center">
          <h5>Total Revenue Refunded (BBD$)</h5>
         </th> 
                                      
         <th class="text-center">
          <h5>Net Revenue (BBD$)</h5>
         </th>
         
     </tr>
  </thead>
   <tbody class="ticket-item">
    <?php
    $_SESSION['srspreviousurl'] = $_SERVER['REQUEST_URI'];
          $total_refund_count = 0;
      $total_paid_count = 0;   
      $total_ref_amt = 0;
      $total_paid_amt = 0;
          $i=1;
       
     foreach ($records as $key => $value) {

      if($value['service_id']=='2.0'){
         $cnr_records = Yii::app()->db->createCommand("SELECT a.service_id,  p.total_amount, a.submission_id, a.field_value, p.payment_status, p.is_fee_refunded
FROM bo_new_application_submission a
INNER JOIN tbl_payment p
ON a.submission_id=p.submission_id
WHERE DATE(p.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND a.service_id='2.0' AND p.payment_status in ('refund success','success')")->queryAll();

        $next_array = [];
        $refund_count = $paid_count = $ref_amt = $paid_amt = 0;
        foreach ($cnr_records as $key => $v) {
           $newAppSubArr = json_decode($v['field_value'],true);

          if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
       
              if($v['is_fee_refunded']==1){
                  $refund_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['refund_count']+1;
                  $paid_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_count'];
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['total_amount'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                 }else{
                  $refund_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['refund_count'];
                  $paid_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_count']+1;
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['total_amount'];
                 }
              $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['refund_count'=>$refund_count, 'paid_count'=>$paid_count ,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

            }else{
               if($v['is_fee_refunded']==1){
                    $ref_amt = $v['total_amount'];
                    $refund_count = 1;
                 }else{
                  $paid_amt = $v['total_amount'];
                  $paid_count = 1;
                 }
              
               $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['refund_count'=>$refund_count,'paid_count'=>$paid_count,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
            }
        }

        foreach ($next_array as $k => $val) { 
          if($min_amt==NULL || $max_amt==NULL || ($val['paid_amt']>=$min_amt && $val['paid_amt']<=$max_amt)){
          ?>
              <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
               <td class="text-center">
                <p><?= $i ?></p>
               </td>

               <td>
                   <?php $_SESSION['srspreviousurl'] = $_SERVER['REQUEST_URI']; ?>
                    <p><a href="/backoffice/misreports/revenue/srslevel2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&subservice_id=<?php echo $k;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>&min_amt=<?php echo $min_amt;?>&max_amt=<?php echo $max_amt; ?>" style='color:blue;'>
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
                  }  ?></a></p>
               </td>
               <td class="text-center"><?= $val['refund_count']+$val['paid_count'] ?></td>
               <td class="text-center"><?= $val['refund_count'] ?></td>
               <td class="text-center"><?= $val['paid_count'] ?></td>
      

               <td class="text-center">
                  <?php
                    $gross_amt = $val['ref_amt']+$val['paid_amt'];
                   echo round($gross_amt,2); ?>
               </td>
                <td class="text-center">
                  <?php echo round($val['ref_amt'],2); ?>
               </td>
                <td class="text-center">
                  <?php echo round($val['paid_amt'],2); ?>
               </td>

              
           </tr>
       <?php  
        $total_refund_count = $total_refund_count+$val['refund_count'] ;
        $total_paid_count = $total_paid_count+ $val['paid_count'];   
        $total_ref_amt = $total_ref_amt+ $val['ref_amt'] ;
        $total_paid_amt = $total_paid_amt+ $val['paid_amt'];       

       $i++;
     }
     }
  } else{
        if($min_amt==NULL || $max_amt==NULL || ($value['total_revenue']>=$min_amt && $value['total_revenue']<=$max_amt)){
     ?>
      
      
    <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
       <td class="text-center">
        <p><?= $i ?></p>
       </td>

       <td>
        <?php $_SESSION['srspreviousurl'] = $_SERVER['REQUEST_URI']; ?>
         <p><a href="/backoffice/misreports/revenue/srslevel2/type/service/otd/reports?service_id=<?php echo $value['service_id'];?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>&min_amt=<?php echo $min_amt;?>&max_amt=<?php echo $max_amt; ?>" style='color:blue;'><?php echo $value['core_service_name']; ?></a></p>
         
       </td>
       <td class="text-center"><?= $value['total_gross_filling'] ?></td>
       <td class="text-center"><?= $value['total_refund'] ?></td>
       <td class="text-center"><?= $value['total_net_filling'] ?></td>

       <td class="text-center">
          <?php echo round($value['gross_revenue_recived'],2); ?>
       </td>
        <td class="text-center">
          <?php echo round($value['total_revenue_refunded'],2); ?>
       </td>
        <td class="text-center">
          <?php echo round($value['total_revenue'],2); ?>
       </td>

      
   </tr>

   <?php
       $total_refund_count = $total_refund_count + $value['total_refund'];
        $total_paid_count = $total_paid_count + $value['total_net_filling'];   
        $total_ref_amt = $total_ref_amt +  round($value['total_revenue_refunded'],2);
        $total_paid_amt = $total_paid_amt + round($value['total_revenue'],2); 
    $i++;
 }
  }
   
    }  ?> 
      </tbody> 
     <tfoot>
   <tr>
   <td colspan="2" style="text-align: right;">
    <strong>Total</strong>
   </td>

   <td class="text-center">
      <strong><?= $total_refund_count+$total_paid_count ?></strong>
   </td>
   <td class="text-center">
      <strong><?= $total_refund_count ?></strong>
   </td>
    <td class="text-center">
      <strong><?= $total_paid_count ?></strong>
   </td>
   <td class="text-center">
      <strong><?= round(($total_ref_amt+$total_paid_amt),2) ?></strong>
   </td>

   <td class="text-center">
      <strong><?= round($total_ref_amt ,2) ?></strong>
   </td>
 
   <td class="text-center">
    <strong><?= round($total_paid_amt,2) ; ?></strong>
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