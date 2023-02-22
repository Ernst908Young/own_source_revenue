<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
           
                  <li>
                    <a href="<?php echo @$_SESSION['inaslevel1previousurl'] ?>">
                     Incorporation Analysis Level 1
                    </a>
                  </li>        
                  <li>Incorporation Analysis Report Level 2</li>
               </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
          Incorporation Analysis Report Level 2
            </h4>
        <div class="form-row">
        
        From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong> | Service Category: <strong><?php 
       
         echo $category;
       

         ?></strong>
        <br>
        <?php 
$pdfurl = "/backoffice/misreports/services/inaslevel2pdf?from_date=$from_date&to_date=$to_date&category=".base64_encode($category);
	$url_components = parse_url($_SERVER['REQUEST_URI']);
     if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        if(isset($params['sn'])){
           foreach ($params['sn'] as $key => $value) {
           $pdfurl.='&sn[]='.$value;
        }
       }       
     }
	 

          $n=1;  $total_app = 0;      $main_array = [];          
 if($category=='Name Reservation or Business Name Registration'){
    $next_array = [];

    $records = Yii::app()->db->createCommand("SELECT a.field_value, a.service_id
      FROM bo_new_application_submission a  
      WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND a.service_id='2.0'
   ")->queryAll();

        foreach ($records as $key => $value) {
              

              $newAppSubArr = json_decode($value['field_value'],true);

              if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                  $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['applications'];

                  $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['applications'=>$count+1,'subservice'=>$newAppSubArr['UK-FCL-00044_0'],'service_id'=>$value['service_id']];

                }else{
                                  
                   $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['applications'=>1,'subservice'=>$newAppSubArr['UK-FCL-00044_0'],'service_id'=>$value['service_id']];
                }
              }
              foreach ($next_array as $k => $val) {
                if($k==1){
                  $core_service_name = 'Name Reservation-Society (Form 15)';
                }else{
                  if($k==2){
                    $core_service_name = 'Name Reservation-Company (Form 33)';
                  }else{
                    if($k==3)
                      $core_service_name = "Business Name Registration (Form 1)";
                    else
                      $core_service_name = 'NA';
                  }
                }  
                $main_array[]=array_merge($val,['core_service_name'=>$core_service_name]);
                $sn_arr[$core_service_name]=$core_service_name;
              }
             }else{
                  foreach ($records as $key => $value) {
                    $main_array[]=$value;
                    $sn_arr[$value['core_service_name']]=$value['core_service_name'];
                  }
             }  
              
         
        ?>
         
      </div>
      
       <form method="get">    
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />
            <input type="hidden" name="category" value="<?= base64_encode($category) ?>" />
            <div class="form-row row">
         <div class="col-lg-6 form-group">
   
            <label>Service Name</label>
              <select name="sn[]"  multiple='multiple' placeholder="service category" class="select2-me" id="sn" labelname="sn">
                    
                 <?php 
               
                   foreach($sn_arr as $k=>$v){ 
                    $selects = !empty($sn)  ? (in_array($k, $sn) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v ?>
                      </option>
                   <?php } ?>

              </select>            
          </div>
           <div class="col-lg-6 form-group" style="margin-top: 35px;">
                <button type="submit" class="btn-primary">Search</button>
                <a href="<?= $pdfurl ?>" target="_blank" class="btn-primary">PDF</a>
              </div>
</div>
</form>

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
         <th class="text-center" width="10%">
          <h5>SR. No.</h5>
         </th>

         <th class="text-center" width="65%">
          <h5>Service Name</h5>
         </th>
         
         <th class="text-center" width="25%">
          <h5>Total SRN. No.</h5>
         </th>
       
        
     </tr>
  </thead>
<tbody class="ticket-item">
<?php $_SESSION['inaslevel2previousurl'] = $_SERVER['REQUEST_URI']; ?>
<?php 
          $n=1;  $total_app = 0;                


        foreach ($main_array as $key => $value) {     
        if($sn==NULL || in_array($value['core_service_name'], $sn)){      
    $subservice_id=isset($value['subservice_id']) ? $value['subservice_id'] : NULL;
            
              
         ?>

        <tr class="ticket-row tableinside" id="<?php echo $n; ?>">
           <td class="text-center">
            <p><?= $n ?></p>
           </td>
       
             <td>
                 
              
                <p><a href="/backoffice/misreports/services/inaslevel3/otd/reports?service_id=<?php echo $value['service_id'];?>&subservice_id=<?php echo $subservice_id;?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'>
                    <?= $value['core_service_name'] ?>
                 </a></p>
             </td>

            <td class="text-center">
           <?= $value['applications'] ?>
           </td>
         

       </tr>

    <?php
    $n++;
    $total_app = $total_app + $value['applications'];
  
         }             
}
  ?>
 
                          </tbody> 
                          <tfoot>
                            
                          
    <tr class="ticket-row tableinside" id="total">
   <td colspan="2" style="text-align: right;">
    <strong>Total</strong>
   </td>
     <td class="text-center">
      <strong><?= $total_app ?></strong>
   </td>
 </tr>            </tfoot>                        
                      
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