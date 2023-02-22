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
        
            <li>Representative Summary Report Level 2</li>
          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                 Representative Summary Report Level 2
            </h4>
        <div class="form-row">
		 <?php 
     $sp_s_arr = ['N'=>'Nominated','O'=>'Onboarded','R'=>'Removed','PD'=>'Payment Due','PI'=>'Payment Initiated','NW'=>'Nomination withdrawn'];
      $status_array = [];
          foreach ($records as $key => $value) {   
            if(array_key_exists($value['sp_status'], $sp_s_arr)){                
                  $status_array[$value['sp_status']] = $sp_s_arr[$value['sp_status']];                
              }                 
          }
    

		 $agent_user = Yii::app()->db->createCommand("SELECT u.user_id, u.sp_type,p.first_name,p.last_name,p.surname from  sso_users as u INNER join sso_profiles p on p.user_id = u.user_id where u.user_id = '".$agent_user_id."'")->queryRow(); ?>
        
          From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong>  | Representative Name: <strong><?=  $agent_user['first_name'].' '.$agent_user['last_name'].' '.$agent_user['surname'] ?></strong>| Representative Type: <strong><?=  $agent_user['sp_type'] ?></strong>
        
        <?php 


            $pdfurl = "/backoffice/misreports/sp/sps_level_apdf?from_date=$from_date&to_date=$to_date&agent_user_id=$agent_user_id";
            $url_components = parse_url($_SERVER['REQUEST_URI']);
             if(isset($url_components['query'])){
                parse_str($url_components['query'], $params);
                if(isset($params['status'])){
                  foreach ($params['status'] as $key => $value) {
                   $pdfurl.='&status[]='.$value;
                }
               }       
             }


        ?>
         </div>
          <form method="get">
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />
            
             <!--input type="hidden" name="entity_name" value="<1?= $entity_name ?>" /-->
             <input type="hidden" name="agent_user_id" value="<?= $agent_user_id ?>" />
            
             <div class="form-row row">
              <div class="col-lg-6 form-group">
              <label>Current Status</label>
             
              <select name="status[]"  multiple='multiple' placeholder="All Entity" class="select2-me" id="status" labelname="status">
                    
  <?php

   foreach($status_array as $k=>$v){ 
           $selects = !empty($status)  ? (in_array($k, $status) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php }   ?>
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
</style>

<table  id="sample_2" width="100%">
<thead> 
 <tr>
     <th class="text-center">
      <h5>SR. No.</h5>
     </th>
     <th class="text-center">
      <h5>Individual Name/ Entity</h5>
     </th>
     <th class="text-center">
      <h5>Current Status</h5>
     </th>

     <th class="text-center">
      <h5>Number of Filings</h5>
     </th>

     
 </tr>
</thead>
 <tbody class="ticket-item">

 	<?php 
$_SESSION['spsrpreviousurl_2'] = $_SERVER['REQUEST_URI']; 

$i=1;
 
  foreach ($records as $key => $value) {
//	$service_id = $value['service_id'];
    
 if($status==NULL || in_array($value['sp_status'], $status)){

  $asp_indi_entity = Yii::app()->db->createCommand("SELECT count(a.submission_id) as srn_count
FROM bo_new_application_submission a
where DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND application_status='A' AND agent_user_id=$agent_user_id AND entity_name='".$value['reg_no']."' ")->queryRow();
   ?>

  <tr class="ticket-row tableinside" id="<?php echo $i; ?>">
     <td class="text-center">
      <p><?= $i ?></p>
     </td>
    <td>
        <p><a href="/backoffice/misreports/sp/spsummaryreportlevel2/otd/reports?agent_user_id=<?= $agent_user_id ?>&entity_name=<?= $value['reg_no'] ?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>" style='color:blue;'><?= $value['company_name'] ?></a></p>
    </td>
     <td class="text-center">
      <p>
         <?php if(array_key_exists($value['sp_status'], $sp_s_arr)){
                
                 echo $sp_s_arr[$value['sp_status']];
                
              }else{
                echo ' No Status';
              } ?> 
      </p>
    </td>
    <td class="text-center">
       <?= $asp_indi_entity['srn_count'] ?>
     </td>

  </tr>
  <?php
        $i++;
	
    }}
?> 
                          </tbody> 
                          
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