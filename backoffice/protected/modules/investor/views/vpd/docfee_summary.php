<?php 
		$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
?>
<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/admin">Home</a></li>   
      <li>Document Fees</li>
    </ul>
  

  <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
    <table  id="sample_1" width="100%">
       <thead> 
           <tr>
              <th class="text-center">
                <h5>Sr. No.</h5>
               </th>
               <th class="text-center">
                <h5>Applicant Name</h5>
               </th>
               <th class="text-center" width="25%">
                <h5>Entity Name</h5>
               </th>
                <th class="text-center">
                <h5>Document Name</h5>
               </th>
                <th class="text-center">
                <h5>VPD Document Fee</h5>
               </th>
               <th>
                 <h5>Status</h5>
               </th>
               
               <th class="text-center">
                <h5>Created On</h5>
               </th>
              
               <th class="text-center">
                <h5>Action</h5>
               </th>
               
           </tr>
       </thead>
           <tbody class="ticket-item">
           <?php
        if($data){
            foreach($data as $key => $value) 
            {   
               
            ?>    
            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
               <td>
                 <?= $key+1 ?>
               </td>
               <td class="text-center">
                    <?= $value['app_name'] ?>
               </td>
               <td class="text-left">
                   <?= $value['company_name'] ?>
               </td>
                <td class="text-left">
                	<?= $value['ser_name_for_documentname'] ?>
                  <?php if($value['doc_name']=='certificate'){
                        echo 'Certificate';
                      }else{
                        echo 'Application Form';
                      }
                      ?>
               </td>
               <td class="text-center">
                 <?= $value['total_fee'] ?>
               </td>
               <td>
                 <?= $value['payment_status'] ?>
               </td>
               <td class="text-center">
                 <?= $value['created_on'] ?  date('d M Y',strtotime($value['created_on'])) :
                 '' ?>
               </td>
               <td class="text-center">
                <?php if($value['payment_status']=='Success' || $value['payment_status']=='success'){ ?>

                  <a  target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/vpd/printofflinefeereciept/pid/'.base64_encode($value['p_id']));?>" title="Print Reciept">
                       <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
                   </a>

                <?php }else{ ?>
                  <a href='/backoffice/investor/vpd/makepayment/vpd_id/<?= base64_encode($value['id']) ?>' style='color:blue;'>
                        View   
                   </a>
              <?php  } ?>
                   
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

<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script type="text/javascript">  
  function tabchange(id){
    $("#"+id).trigger('click');
  }
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
                       [4, "desc"]
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
           jQuery().dataTable && (t(), n())
        }
    }
}();

</script>
<script type="text/javascript">
    jQuery(document).ready(function() {

  

   
 TableDatatablesButtons.init();
    

       
});
</script>

