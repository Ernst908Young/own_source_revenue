<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; $basePath="/themes/investuk";

$status_arr=array(""=>"","A"=>"Approved","R"=>"Rejected"); ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
            <li>
            <a href="<?php echo @$_SESSION['oprpreviousurl'] ?>">
             Officer Productivity Report Level 1
            </a>
          </li>
        
            <li> <a href="/backoffice/misreports/officerproductivity/level2/otd/reports?officer_id=<?php echo $officer_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>">Officer Productivity Report Level 2</a></li>
			<li>
			Officer Productivity Report Level 3
			</li>
          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                 Officer Productivity Report Level 3
            </h4>
        <div class="form-row"><?php 
		$officerde = Yii::app()->db->createCommand("SELECT * from bo_user where uid = $officer_id")->queryRow();

       $entity_array = []; $srn_no_arr =[];
          foreach ($records as $key => $value) {           
             $en = isset($value['entity_name'])? $value['entity_name'] : 'NA';
              $entity_array[$en]=$en; 
              $srn_no_arr[$value['submission_id']]=$value['submission_id']; 
          }

		$sserd = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters where CONCAT(service_id,'.',servicetype_additionalsubservice) = $service_id")->queryRow(); ?>
          From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong>  | Official: <strong><?= $officerde['full_name'].' '.$officerde['middle_name'].' '.$officerde['last_name'].'-'.$officerde['email']  ?> </strong> | Service Name: <strong><?= $sserd['core_service_name'] ?></strong><?php if($status!=""){?> | Status:  <strong><?php echo $status_arr[$status];?></strong><?php }?>


        
        <?php 


            $pdfurl = "/backoffice/misreports/officerproductivity/level3pdf?from_date=$from_date&to_date=$to_date&officer_id=$officer_id&service_id=$service_id&status=$status";
            /*$url_components = parse_url($_SERVER['REQUEST_URI']);
             if(isset($url_components['query'])){
                parse_str($url_components['query'], $params);
                if(isset($params['service_id'])){
                   foreach ($params['service_id'] as $key => $value) {
                   $pdfurl.='&service_id[]='.$value;
                }
               }       
             }*/


        ?>
		
		 <form method="get">
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />
             <input type="hidden" name="officer_id" value="<?= $officer_id ?>" />
             <input type="hidden" name="service_id" value="<?= $service_id ?>" />
             <input type="hidden" name="status" value="<?= $status ?>" />
            
             <div class="form-row row">
              <div class="col-lg-3 form-group">
                <label>SRN No.</label>
                <select name="srn_no[]"  multiple='multiple' placeholder="All SRN No." class="select2-me" id="srn_no">
                    
                   <?php                  
                   foreach($srn_no_arr as $k=>$v){ 
                    $selects = !empty($srn_no)  ? (in_array($k, $srn_no) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
              </select> 
              </div>
              <div class="col-lg-3 form-group">
                <label>Payment Mode</label>
                <select name="pay_mode"  class="select2-me" id="pay_mode" labelname="pay_mode">
                   <option>
                      All Payment Mode Status
                  </option>   
                    <option value="1" <?= $pay_mode=='1' ? 'selected' : '' ?>>
                        Online
                      </option>
                      <option value="3" <?= $pay_mode=='3' ? 'selected' : '' ?>>
                        Offline
                    </option>                    
                </select> 
              </div>
              <div class="col-lg-6 form-group">
              <label>Business Entity</label>
             
              <select name="entity[]"  multiple='multiple' placeholder="All Entity" class="select2-me" id="entities" labelname="entities">
                    
  <?php

   foreach($entity_array as $k=>$v){ 
           $selects = !empty($entity)  ? (in_array($v, $entity) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php }   ?>
              </select> 
            </div>
                
          <div class="col-lg-6 form-group">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>"  class="btn-primary">PDF</a>
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

    </style>
<table  id="sample_2" width="100%">
                       <thead> 
                           <tr>
                               <th class="text-center">
                                <h5>SR. No.</h5>
                               </th>

                               <th class="text-center">
                                <h5>Applicant Name</h5>
                               </th>
                             <!--    <th class="text-center">
                                <h5>Applicant User ID</h5>
                               </th> -->
                               <th class="text-center" style="min-width: 100px;">
                                <h5>SRN. No.</h5>
                               </th>
							   <!-- <1?php if($status==""){?>
                               <th class="text-center">
                                <h5>Application Status</h5>
                               </th> 
                  <1?php }?> -->

                                <th class="text-center">
                                <h5>Business Entity</h5>
                               </th>

                             
                               <th class="text-center">
                                <h5>Payment Date</h5>
                               </th>

                             

                               <th class="text-center">
                                <h5>Payment Mode</h5>
                               </th>

                               <th class="text-center">
                                <h5>Transaction ID</h5>
                               </th>

                              <!--  <th class="text-center">
                                <h5>Bank Account Name</h5>
                               </th> -->

                               <th class="text-center">
                                <h5>Amount (BBD$)</h5>
                               </th>
                              
                           </tr>
                       </thead>
                           <tbody class="ticket-item">

                           	<?php 
                            $paid_amt = 0;
$total_amt = 0;
$total_ref = 0;
$total_net = 0; $i=1;
if(count($records)>0){

                            foreach ($records as $key => $value) {
                                if(($entity==NULL || in_array((isset($value['entity_name']) ? $value['entity_name'] : 'NA'), $entity)) &&($srn_no==NULL || in_array($value['submission_id'], $srn_no))){
                             ?>

                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                               <td class="text-center">
                                <p><?= $i ?></p>
                               </td>
                           
                                <td class="text-center">
                                 <?php echo $value['first_name'].'<br>'.$value['email'] ?> 
                               </td>
                                <!-- <td class="text-center">
                                 <1?= $value['iuid']  ?> 
                               </td> -->
                               <td class="text-center">
                               
                    <?php $printappurl =  $value['print_app_call_back_url'];  ?>
                    <a target="_blank" style="color: blue;" href="<?php echo $printappurl; ?>" title="Print Application">
                        <?php echo $value['submission_id'] ?>    
                    </a>
                    <br>
                   
                     <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizardtwo/subForm/applicationTimeline/subID/'. base64_encode($value['submission_id']));?>" title="  View Timeline">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">   
                    </a>
                     
             

                 <?php 
                   if($value['application_status']=='A' && $value['is_certificate']==1 && !empty($value['download_certificate_call_back_url'])){ 
                        $parse = parse_url($value['download_certificate_call_back_url']);
                        $certi_path = isset($parse['path']) ? $parse['path'] : '';
                    ?>
                     
                          <a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($certi_path); ?>&from=ticket" title="Download Letter / Certificate">
                             <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
                          </a>
                    
                    
                    <?php } ?>
                    <?php 
                   if($value['application_status']=='A'){ ?>
                    <a href="/backoffice/investor/documentManagement/documentdownload/subID/<?= base64_encode($value['submission_id']) ?>"> 
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/doc_list1.png">
                    </a>
                    <?php } ?>
               
                </td>
							  <!--  <1?php if($status==""){?>
                               <td class="text-center">
                                <1?php echo $status_arr[$value['action_status']];?>
                               </td> 
<1?php }?> -->
                                <td class="text-center">
                                  <?php echo isset($value['entity_name']) ? $value['entity_name'] : 'NA' ?>
                               </td>
                                
                                <td class="text-center">
                                  <?php echo $value['created_at'] ? date('d-m-Y',strtotime($value['created_at'])) : "" ; ?>
                                    
                                  </td>

                                <?php 
								$payment_mode='';
                                  if($value['payment_mode'] == 1){
                                  	$payment_mode = 'Online';
                                  }else if($value['payment_mode'] == 2){
                                  	$payment_mode = 'Wallet'; 
                                  }else if($value['payment_mode'] == 3){
                                  	$payment_mode = 'Offline'; 
                                  }

                                 ?>

                                <td class="text-center"><?php echo $payment_mode;?></td>

                                <?php 
                  if($value['is_fee_refunded']==1){
                    $style = 'color:blue';
                    $sign = '-';
                     if($value['payment_received_by']>0){
                      $reuser = Yii::app()->db->createCommand("SELECT * FROm bo_user where uid=".$value['payment_received_by'])->queryRow();
                      $crou = $reuser['full_name'].' '.$reuser['middle_name'].' '.$reuser['last_name'].' '.$reuser['email'];
                    }else{
                      $crou = ' NA';
                    }
                  }
                  else {
                    $style='';
                    $sign='';
                        $crou = ' NA';
                  }
                ?>

                                <td class="text-center">
                                  <?php   if($value['is_fee_refunded']==1){ ?>
                                   <a title="<?= $crou ?>" style="<?php echo $style?>"> <?php echo $value['transaction_number'];?>
                                   </a>
                                 <?php }else{ ?>
                                   <?php echo $value['transaction_number'];?>
                                  <?php } ?>
                                    
                                  </td>
                               <!--  <td class="text-center"><1?php echo $value['bank_name'];?></td> -->
                                
                              <td class="text-center" style="<?php echo $style?>">
                                <?php echo $sign.''.round($value['total_amount'],2) ;?>
                                  
                                </td>
                                  
                           </tr>

                        <?php
 $paid_amt =  $paid_amt+$value['paid_amt'];
    $total_ref  = $total_ref+$value['ref_amt'];
    $total_net =  ($paid_amt - $total_ref);
    $i++;
} } }
/*if($status==""){
  $total_colspan = 10;
}else{
  $total_colspan = 9;
}*/
?>
                          </tbody> 
                <tfoot>                     
                  <tr class="ticket-row tableinside" id="total">
                     <td colspan="7" style="text-align: right;">
                      <strong>Total</strong>
                     </td>
                       <td class="text-center">
                        <strong><?= round($total_net,2) ?></strong>
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