<title>Dashboard</title>
<?php 
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
$userID = $_SESSION['uid'];

$sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;
 $sta = isset($_GET['sta']) ? $_GET['sta'] : NULL; 

if($sc_id){

  $wheresc = " AND sc_id=$sc_id";
}else{
  $wheresc = " ";
}


$pd_records_succ = Yii::app()->db->createCommand("SELECT tbl_payment.* , p.core_service_name
    from tbl_payment 
    INNER JOIN bo_information_wizard_service_parameters p on CONCAT(p.service_id,'.',p.servicetype_additionalsubservice) = tbl_payment.service_id
     INNER JOIN bo_information_wizard_service_master sm
ON sm.id = tbl_payment.service_id
    where payment_mode=3 $wheresc AND payment_status='success' and p.is_active='Y'  ORDER BY tbl_payment.submission_id DESC")->queryAll(); 
?>
<div class="dashboard-conetnt">                        
    <div class="dashboard-home">
       <?php 


                    
        ?>
        <div class="home-top position-relative">   
         <div class="user-select d-flex justify-content-start my-3">
                <div class="select-wrap">
                      <?php $sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll(); ?>
                    <select onchange="categchang($(this).val())">
                        <option value="">All Services</option>                        
                         <?php 

                         $k=1; foreach($sc_arr as $val){ 

                          $sc_select= $sc_id==$k ? 'selected' : '' ;
                            ?>
                              <option value="<?php echo $k; ?>" <?php echo $sc_select ?>><?php echo $val['category_name']; ?></option>                                    
                         <?php $k++; } ?>
                    </select>
                </div>
                <!-- <div class="select-wrap status">
                    <select onchange="statusegchang($(this).val())">
                        <option value="">All Status</option>                        
                         <1?php 
                            $sta_arr = ['Draft'=>'Draft','Payment Due'=>'Payment Due','Pending for Approval'=>'Pending for Approval','Approved'=>'Approved','Reverted'=>'Reverted','Refund Requested'=>'Refund Requested','Refund Successful'=>'Refund Successful'];
                                
                                foreach($sta_arr as $val){ ?>
                              <option value="<1?php echo $val; ?>"><1?php echo $val; ?></option>                                    
                         <1?php $k++; } ?>
                    </select>
                </div> -->
           </div>               
            <div class="home-row d-flex flex-wrap">
             
            <div class="counter-item bord-3">
               <a style="cursor: pointer;" onclick="tabchange('falink')">
              <div class="data-counter">
                  <div class="counter-left">
                          <span>Payment Success </span>
                          <span class="counter-number font-montserrat">
                            <?= sizeof($pd_records_succ); ?></span>
                      <div class="counter-icon">
                             <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-1.png">
                      </div>
                  </div>
              </div>
            </a>
          </div>
               
            </div>
        </div>

<div class="applied-status">
  <div class="row">
    <div id="tickettab" class="my-5">
        <ul>
         
            <li><a href="#fa" id="falink">Payment Success</a></li>
        </ul>
         
             <div id="fa">
                <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
    <table  id="sample_2" width="100%">
       <thead> 
           <tr>
               <th class="text-center">
                <h5>SRN No.</h5>
               </th>
               <th class="text-center" width="25%">
                <h5>Service Name</h5>
               </th>
                <th class="text-center">
                <h5>Receipt Number</h5>
               </th>
                <th class="text-center">
                <h5>Applied On</h5>
               </th>
               <th class="text-center">
                <h5>Payment Status</h5>
               </th>
              
               <th class="text-center">
                <h5>Action</h5>
               </th>
               
           </tr>
       </thead>
           <tbody class="ticket-item">
           <?php
        if($pd_records_succ){
            foreach($pd_records_succ as $key => $value) 
            {       
             $formName= '';
             if($value['service_id'] == 2.0){  
            $srn_no = $value['submission_id'];
            $sql="SELECT * FROM bo_new_application_submission WHERE submission_id =:srn_no";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindParam(":srn_no",  $srn_no, PDO::PARAM_STR);
            $service_srn=$command->queryRow();   
            $farr = (array) json_decode($service_srn['field_value']);   
            $form_id = $farr['UK-FCL-00044_0']; 
          
          
          if(isset($form_id) && !empty($form_id) && $form_id==3)
          {
            $formName= 'Business Name Registration (Form 1)';
          }
           if(isset($form_id) && !empty($form_id) && $form_id==2)
          {
            $formName= 'Name Reservation-Company (Form 33)';
          }
          if(isset($form_id) && !empty($form_id) && $form_id==1)
          {
            $formName= 'Name Reservation-Society (Form 15)';
          }  
               }        
            ?>    
            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
               <td class="text-center">
                    <?= $value['submission_id'] ?>
               </td>
               <td class="text-left">
               <?php echo ($value['service_id']=='2.0')? $formName : $value['core_service_name']; ?>
               </td>
                <td class="text-center">
                 <?= $value['chalan_no'] ?>
               </td>
               <td class="text-center">
                 <?= $value['created_at'] ?  date('d M Y',strtotime($value['created_at'])) :
                 '' ?>
               </td>
               <td class="text-center">
                 <?= ($value['payment_status']=='success'?'Payment Successful':'') ?>
               </td>
               <td class="text-center">
                   <a  target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('cashier/default/printofflinefeereciept/subID/'.base64_encode($value['submission_id']));?>" title="Print Reciept">
                       <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
                   </a>
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
              

<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script type="text/javascript">  
  function tabchange(id){
    $("#"+id).trigger('click');
  }
  var TableDatatablesButtons = function() {
     var e = function() {

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

                     [0, "desc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                  dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },
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
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


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
                       [0, "desc"]
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
           jQuery().dataTable && (e(), t(), n())
        }
    }
}();

</script>
<script type="text/javascript">
    jQuery(document).ready(function() {

  

   
 TableDatatablesButtons.init();
    

       
});
</script>

<script>  
   function categchang(sc_id){
           var url = "<?php echo Yii::app()->createUrl('/admin/default/index') ?>";
           var param = '/sc_id/'+sc_id;
       window.location.href = url+param; 
    }
        $(function() {  
           $( "#tickettab" ).tabs();  
        });  
         function categchang(sc_id){
           var url = "<?php echo Yii::app()->createUrl('/admin/default/index') ?>";
           var param = '/sc_id/'+sc_id;
       window.location.href = url+param; 
    }
     </script> 