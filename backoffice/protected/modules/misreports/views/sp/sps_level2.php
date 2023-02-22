<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
            <li>
            <a href="<?php echo @$_SESSION['spsrpreviousurl'] ?>">
             Representative Summary Report Level 1
            </a>
          </li>
           <li>
            <a href="<?php echo @$_SESSION['spsrpreviousurl_2'] ?>">
             Representative Summary Report Level 2
            </a>
          </li>
        
            <li>Representative Summary Report Level 3</li>
          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                 Representative Summary Report Level 3
            </h4>
        <div class="form-row">
		 <?php 



		 $agent_user = Yii::app()->db->createCommand("SELECT u.user_id, u.sp_type,p.first_name,p.last_name,p.surname from  sso_users as u INNER join sso_profiles p on p.user_id = u.user_id where u.user_id = '".$agent_user_id."'")->queryRow(); ?>
        
          From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong>  | Representative Name: <strong><?=  $agent_user['first_name'].' '.$agent_user['last_name'].' '.$agent_user['surname'] ?></strong>| Representative Type: <strong><?=  $agent_user['sp_type'] ?></strong>
        
        <?php 


            $pdfurl = "/backoffice/misreports/sp/spsummaryreportlevel2pdf?from_date=$from_date&to_date=$to_date&agent_user_id=$agent_user_id";
            $url_components = parse_url($_SERVER['REQUEST_URI']);
             if(isset($url_components['query'])){
                parse_str($url_components['query'], $params);
                if(isset($params['service_id'])){
                  /* foreach ($params['service_id'] as $key => $value) {
                   $pdfurl.='&service_id[]='.$value;
                }*/
               }       
             }


        ?>
            </div>
          <form method="get">
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />
            
             <!--input type="hidden" name="entity_name" value="<1?= $entity_name ?>" /-->
             <input type="hidden" name="agent_user_id" value="<?= $agent_user_id ?>" />
            <input type="hidden" name="entity_name" value="<?= $reg_no ?>" />
             <div class="form-row row">

              <?php $services = Yii::app()->db->createCommand("SELECT id,sc_id,service_name
                   from bo_information_wizard_service_master WHERE id NOT IN (1,3)")->queryAll(); ?>
                   <div class="col-lg-6 form-group">
                   <label>Service Description</label>
              <select name="services_id[]"  multiple='multiple' placeholder="All Services" class="select2-me" id="services_id" labelname="Services">
                    
                   <?php foreach($services as $k=>$v){ 
                    $selects = !empty($services_id)  ? (in_array($v['id'], $services_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v['id'] ?>" <?= $selects ?>>
                        <?php echo $v['service_name'] ?>
                      </option>
                   <?php } ?>
              </select>            
          </div>
                 <div class="col-lg-6 form-group" style="margin-top: 35px;">
                    <button type="submit" class="btn-primary">Search</button>
           
            <a href="<?= $pdfurl ?>" target="_blank"  class="btn-primary">PDF</a>
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
      <h5>Total Number of Service Availed</h5>
     </th>

     <th class="text-center">
      <h5>Total Amount Received (BBD$)</h5>
     </th>

      <th class="text-center">
      <h5>Total Amount Refunded (BBD$)</h5>
     </th>

     <th class="text-center">
      <h5>Total Revenue (BBD$)</h5>
     </th>
     
 </tr>
</thead>
 <tbody class="ticket-item">

 	<?php 
  $_SESSION['swrpreviousurl_3'] = $_SERVER['REQUEST_URI'];
$total_paid = 0;
$total_ref = 0;
$total_net = 0;
$total_srn = 0;
$net =0;
$i=1;

  foreach ($records as $key => $value) {
	$service_id = $value['service_id'];
   if($service_id=='2.0'){
       $cnr_records = Yii::app()->db->createCommand("
        SELECT     
        (CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amt,
        (CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
         s.field_value, q.is_fee_refunded
        from bo_new_application_submission as s
        Right join tbl_payment as q  on q.submission_id = s.submission_id       
        where s.agent_user_id='".$agent_user_id."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.service_id='2.0'")->queryAll();

       $next_array = [];
       $ref_amt = $paid_amt = 0;
     
        foreach ($cnr_records as $key => $v) {
           $newAppSubArr = json_decode($v['field_value'],true);

          if(array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
              $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];

                if($v['is_fee_refunded']==1){
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                 }else{
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['paid_amt'];
                 }
              $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

            }else{
               if($v['is_fee_refunded']==1){
                    $ref_amt = $v['ref_amt'];
                 }else{
                  $paid_amt = $v['paid_amt'];
                 }
              
               $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
            }
        }

         foreach ($next_array as $k => $val) { ?>
              <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
               <td class="text-center">
                <p><?= $i ?></p>
               </td>

               <td>
                  
                
                  <p><a href="/backoffice/misreports/sp/spsummaryreportlevel3/otd/reports?agent_user_id=<?= $agent_user_id;?>&service_id=<?php echo $value['service_id'];?>&subservice_id=<?php echo $k;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'><?php if($k==1){
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
       $total_paid =  $total_paid+$val['paid_amt'];
       $total_ref  = $total_ref+$val['ref_amt'];
       $total_net =  $total_net + $net; 

       $i++;
     }
   }else{
   ?>

  <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
     <td class="text-center">
      <p><?= $i ?></p>
     </td>
    <td>
      <p><a href="/backoffice/misreports/sp/spsummaryreportlevel3/otd/reports?agent_user_id=<?= $agent_user_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>&service_id=<?php echo $service_id; ?>" style='color:blue;'><?= $value['service_name'] ?></a></p>
    </td>
     <td class="text-center">
      <p><?= $value['total_services'] ?></p>
    </td>
    <td class="text-center">
        <?php echo round($value['paid_amount'],2); ?>
     </td>

     <td class="text-center">
        <?php $refund = $value['ref_amt'];
         echo   round($refund , 2); ?>
     </td>
   
     <td class="text-center">
      <?php
    $net = $value['paid_amount'] -  $refund ;
       echo  round($net ,2) ; ?>
     </td>
  </tr>
  <?php
    $total_srn = $total_srn+$value['total_services'];
    $total_paid =  $total_paid+$value['paid_amount'];
    $total_ref  = $total_ref + $value['ref_amt'];
    $total_net =  $total_net + $net;
    $i++;
		 }
    }
?> 
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
      <strong><?= round($total_paid,2) ?></strong>
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