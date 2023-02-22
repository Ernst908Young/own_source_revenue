<title>Officer Productivity Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
          <li>Officer Productivity Report Level 1</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
        Officer Productivity Report Level 1
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
          <!--div class="col-lg-6 form-group">
            <1?php 
              $office_arr = Yii::app()->db->createCommand("SELECT qm.user_id as uid, u.full_name FROM querymessage as qm
                INNER JOIN bo_user u ON u.uid=qm.user_id
               WHERE user_type='BU' GROUP BY qm.user_id")->queryAll();
            ?>
            <label>CAIPO Officer</label>
              <select name="Officer_id" placeholder="Select officer" class="select2-me" id="Officer_id" labelname="CAIPO Officer">       
              <option>Select CAIPO Officer</option>
               <1?php foreach($office_arr as $k=>$v){ ?>
                      <option value="<1?= $v['uid'] ?>" <1?= $v['uid']==$officer_id ? 'selected' : ''?> >
                        <1?php echo $v['full_name'] ?>
                      </option>
                   <1?php } ?>
            </select>
          </div-->
         
    <?php 
    $pdfurl = "/backoffice/misreports/officerproductivity/level1pdf?from_date=$from_date&to_date=$to_date";
    $url_components = parse_url($_SERVER['REQUEST_URI']);
 if(isset($url_components['query'])){
    parse_str($url_components['query'], $params);
     if(isset($params['officer_id'])){
       foreach ($params['officer_id'] as $key => $value) {
       $pdfurl.='&officer_id[]='.$value;
    }
    }
   
 }
?>

 <div class="col-lg-6 form-group">
  <?php 
 $officers = Yii::app()->db->createCommand("SELECT bou.*
                   from bo_user_role_mapping rm INNER JOIN bo_user bou ON bou.uid=rm.user_id WHERE role_id=84")->queryAll();
  ?>
           
                 <label>CAIPO Officer</label>
              <select name="officer_id[]"  multiple='multiple' placeholder="All Officers" class="select2-me" id="services_id" labelname="Services">
                    
                   <?php foreach($officers as $k=>$v){ 
                    $selects = !empty($officer_id)  ? (in_array($v['uid'], $officer_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v['uid'] ?>" <?= $selects ?>>
                        <?php echo $v['full_name'].' '.$v['middle_name'].' '.$v['last_name'].'-'.$v['email'] ?>
                      </option>
                   <?php } ?>
              </select>            
          </div>

          <div class="col-lg-6 form-group" >
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>"  target=_blank class="btn-primary">PDF</a>
          </div>
        </div>
      </form>

     
 <div class="form-row row">
   <div class="col-lg-12">
   
     <strong>Total Pending Applications: </strong><?= $app_count['Pending_For_Approval'] ?> <br>
     <strong>Total Approved/Rejected: </strong>
     <?php $tara = 0;

     foreach($records as $v) {
     $sumar= $v['approved'] + $v['reject'];
       $tara = $tara+$sumar;

     }
     echo  $tara;
     ?>
   </div>
 </div>
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
                                <h5>Officer Name</h5>
                               </th>
                               <th class="text-center">
                                <h5>Total No. of Applications Approved</h5>
                               </th>               
                               <th class="text-center">
                                <h5>Total No. of Applications Rejected</h5>
                               </th>
                                 <th class="text-center">
                                <h5>Total No. of Applications</h5>
                               </th>
                                 <th class="text-center">
                                <h5>Efficiency</h5>
                               </th>
                          </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
						 $total_appr = 0;
$total_rej = 0;
$total_apps = 0;
    if($records){
     
        foreach($records as $key => $value){  
                ?>    
              <tr class="ticket-row tableinside text-left" id="<?php echo $key; ?>">
                <td class="text-left">
                  <?= $key+1 ?>
                 </td>
             
                 <td class="text-left">
                    <?php $_SESSION['oprpreviousurl'] = $_SERVER['REQUEST_URI']; ?>
                  <a href="/backoffice/misreports/officerproductivity/level2/otd/reports?officer_id=<?php echo $value['uid'];?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'><?php echo $value['full_name'].' '.$value['middle_name'].' '.$value['last_name'].'-'.$value['email'] ?></a>

                 
                 </td>
            
                 <td class="text-center">
                    <?= $value['approved'] ?>                         
                 </td>
                 <td class="text-center">
                     <?= $value['reject'] ?>
                 </td>
                 <td class="text-center">
                   <?php 
                    $total_app = $value['approved']+$value['reject'];
                   echo $total_app; ?>
                 </td>
                  <td class="text-center">
                    <?php if($tara>0){
                      echo round(($total_app/$tara)*100,2).'%';
                    }else{
                      echo '0%';
                    } ?>
                 </td>
              </tr>                                    
            <?php   
              $total_appr = $total_appr+ $value['approved']; 
               $total_rej = $total_rej+ $value['reject'];    
                $total_apps = $total_apps+  $total_app;        
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
      <strong><?= $total_appr ?></strong>
   </td>
   <td class="text-center">
      <strong><?=  $total_rej ?></strong>
   </td>

   <td class="text-center">
      <strong><?= $total_apps ?></strong>
   </td>
 <td class="text-center">
   
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