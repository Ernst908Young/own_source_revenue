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
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
           <li>Reports</li>
          <li>Revenue Report</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Revenue Report
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
              $office_arr = Yii::app()->db->createCommand("SELECT sm.usercode as uid, u.full_name FROM supportmessages as sm
                INNER JOIN bo_user u ON u.uid=sm.usercode
               WHERE usertype='BU' GROUP BY sm.usercode")->queryAll();
            ?>
            <label>CAIPO Officer</label>
              <select name="Officer_id" placeholder="Select officer" class="select2-me" id="Officer_id" labelname="CAIPO Officer">       
              <!-- <option>Select CAIPO Officer</option> -->
               <?php foreach($office_arr as $k=>$v){ ?>
                      <option value="<?= $v['uid'] ?>" <?= $v['uid']==$officer_id ? 'selected' : ''?> >
                        <?php echo $v['full_name'] ?>
                      </option>
                   <?php } ?>
            </select>
          </div>
          <div class="col-lg-6 form-group">
    <?php 
       $services = Yii::app()->db->createCommand("SELECT id,sc_id,service_name
                   from bo_information_wizard_service_master WHERE id NOT IN (1,3)")->queryAll();
    ?>
            <label>Service Description</label>
              <select name="services_id[]"  multiple='multiple' placeholder="Select services" class="select2-me" id="services_id" labelname="Services">
                  <option>Please Select </option>
                   <?php foreach($services as $k=>$v){ 
                    $selects = !empty($service_id)  ? (in_array($v['id'], $service_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v['id'] ?>" <?= $selects ?>>
                        <?php echo $v['service_name'] ?>
                      </option>
                   <?php } ?>
              </select>            
          </div>
          <div class="col-lg-6 form-group" style="margin-top: 32px;">
            <button type="submit" class="btn-primary">Search</button>
          </div>
        </div>
      </form>

 
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
                                <h5>Service Description </h5>
                               </th>

                                <th class="text-center">
                                <h5>CAIPO Officer</h5>
                               </th>

                               <th class="text-center">
                                <h5>Total amount received </h5>
                               </th>

                               <th class="text-center">
                                <h5>Total Refund Issued</h5>
                               </th>                               
                               <th class="text-center">
                                <h5>Net revenue</h5>
                               </th>
                               
                           </tr>
                       </thead>
                           <tbody class="ticket-item">
                            <?php foreach ($records as $key => $value) {
                               
                             ?>
                            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                               <td class="text-center">
                                <p><?= $key+1 ?></p>
                               </td>
                               <td class="text-center">
                                  <p><a href="/backoffice/investor/reports/revenuelavel2?services_id=<?php echo $value['service_id'];?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" target="blank"><?php echo $value['service_name']; ?></a></p>
                               </td>
                              <td class="text-center">
                                  <?php echo $officer_id; ?>
                               </td>

                               <td class="text-center">
                                  <?php echo $value['total_amount']; ?>
                               </td>

                               <td class="text-center">
                                  <?php echo  0.0 ?>
                               </td>
                             
                               <td class="text-center">
                                <?php echo $value['total_amount'] - 0.0 ; ?>
                               </td>
                           </tr>

                           <?php } ?>                                    
                        
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
                buttons: [ {

                     extend: "pdf",

                     className: "mr-1 btn-primary mr-1",


                 }, {

                     extend: "excel",

                     className: "mr-1 btn-primary from-group",
                    

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