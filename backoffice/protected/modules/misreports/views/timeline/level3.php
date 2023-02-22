<title>Service Timeline</title>
<?php
$subID = $sub_id;
$sql="SELECT * from bo_infowiz_form_builder_application_log where app_Sub_id=$subID group by action_status,created order by created ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$res = $command->queryAll();
  
    
?>

<?php 
    $connection = Yii::app()->db;
    //$submission_id= $_GET['subID'];
    $sql = "SELECT sso_users.*,sso_profiles.*,bo_new_application_submission.* from sso_users LEFT JOIN sso_profiles on sso_users.user_id=sso_profiles.user_id LEFT JOIN bo_new_application_submission on sso_users.user_id=bo_new_application_submission.user_id where bo_new_application_submission.submission_id=$subID";
    $command = $connection->createCommand($sql);
    $invData = $command->queryRow();  
?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
       
         <li>
            <a href="<?php echo @$_SESSION['tll1previousurl'] ?>">
             Timeline Report Level 1
            </a>
          </li>
         <li>
            <a href="<?php echo @$_SESSION['tll2previousurl'] ?>">
             Timeline Report Level 2
            </a>
          </li>
        
            <li>Timeline Report Level 3</li>

          </ul>
    
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
         Timeline Report Level 3
            </h4>
        <div class="form-row">
       
            <?php 
          
            
      $sername = Yii::app()->db->createCommand("SELECT  s.core_service_name
        FROM bo_information_wizard_service_parameters as s 
   
      where  s.is_active='Y' AND s.service_id='".$service_id."'")->queryRow();         
            ?>
               
               <b>Service Name : </b>
                    <?php echo $sername['core_service_name'] ; ?>
                   |  <b>SRN : </b>
                    <?php echo $subID; ?>
              

            
             
        <br> <br>
        <?php 
$pdfurl = "/backoffice/misreports/timeline/level3pdf?sub_id=$sub_id&service_id=".$service_id;
        ?>
         <a href="<?= $pdfurl ?>"  class="btn-primary">PDF</a>
      </div>
     
 
</div>       
</div>       
<style type="text/css">
      tr:nth-child(even) {
  background-color: #f2f2f2;
}

    </style>

        <table id="sample_2" width="100%">
            <thead>
                <tr>
                    <th  class="text-center">
                    S.No.
                    </th>
					
                     <th  class="text-center">Activity</th>  
                  <!--   <th  class="text-center">Action Taken On</th> -->
                    <th  class="text-center">Action Taken By</th>
                  <!--   <th  class="text-center">Status</th> -->
                                    
                    <th  class="text-center">Timestamp</th>
                </tr>
            </thead>
            <tbody class="ticket-item">
               <?php
                $sql = "SELECT u.first_name,u.last_name,u.surname,sso.email,sso.mobile_no,bo_new_application_submission.*,
					bo_sp_application_history.application_status as current_status,
					bo_sp_application_history.added_date_time,
					bo_sp_application_history.comments,
					bo_sp_application_history.role_user_info,sso.iuid
					from bo_sp_application_history
					LEFT JOIN bo_new_application_submission on bo_sp_application_history.app_id=bo_new_application_submission.submission_id
					left JOIN sso_profiles u on bo_new_application_submission.user_id=u.user_id
					left JOIN sso_users sso on bo_new_application_submission.user_id=sso.user_id
				where bo_sp_application_history.app_id=$subID";
                $command = $connection->createCommand($sql);
                $apps = $command->queryAll();
                
                $count = 1;
                if (empty($apps)) {

                    echo "<tr><td colspan='5'>No Detail Found</td></tr>";
                } else { 
                    
                    $apps1 = $apps;
                    $diffapplicant = 0;
                    $diffdept = 0;
                    $diffdept12=0;
                    foreach($apps1 as $key => $apps) 
                    {                        
                        $appsgf = $apps['current_status'];
                        $status = $apps['current_status'];
                        if($appsgf != "I") 
                        {
                        ?>

                             <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
								<td class="text-center"><?php echo $count++; ?></td>
                               
                             
                                  <td class='text-left'>
                                <?php echo $apps['comments']; ?>
                                </td>
                              <!--   <td class="text-center">
                                <1?php $create = date('Y-m-d H:i:s', strtotime($apps['added_date_time']));
                                    echo date('d-M-Y H:i:s', strtotime($apps['added_date_time']));
                                ?> -->
                                </td>
                                <td class="text-center">                               
                                    <?php if($apps['role_user_info']){
                                        echo $apps['role_user_info'];
                                    }else{
                                        echo $apps['first_name'].' '.$apps['last_name'].' '.$apps['surname'].'<br>'. $apps['email'].'<br>'. $apps['mobile_no'];
                                    } ;?>
                                </td>
                               <!--  <td class="text-center">
                                    <1?php 
                                     switch ($appsgf) {
            case "I":
             echo "Draft";
                  break;
            case "DP":
               echo "Draft";      
              break;

             case "PD":                      
              echo "Payment Due";                
              break; 

            case "P":
              echo "Pending for Approval";
              break;
            case "F":
              echo "Pending for Approval";
              break;
            case "FA":
              echo "Pending for Approval";
              break; 
            case "AB":
              echo "Pending for Approval";
              break; 

            case "A":
              echo "Approved";
              break;                                     
                           
            case "H":
              echo "Reverted";    
              break;  
            
            case "R":
              echo "Rejected";
              break;
            case "W":
              echo "Withdrawn";
              break;  
            default:
              echo "No Status";
          }
                                    ?>
                                </td> -->
                                                          
                              
                               
                                <td class='text-center'>
                                <?php 
echo  date('d-M-Y H:i:s', strtotime($apps['added_date_time']));
                               
                                    /*if ($apps['current_status'] != "RBI") {
                                    
                                        if ($key == 0) {
                                            if ($status == "A" || $status == "R") {
                                                $date = $apps['added_date_time'];
                                            } else {
                                                
                                                if(isset($unverifiedDocExist['totalDocV']) && $unverifiedDocExist['totalDocV'] > 0)
                                                {
                                                    $date = $apps['added_date_time'];
                                                } else{
                                                    $date = date('Y-m-d H:i:s');
                                                }
                                            }
                                        } else {
                                            $keyval = $key - 1;
                                            $date = $apps1[$keyval]['added_date_time'];
                                        }

                                        $diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));
                                        $diffdept = $diffdept + $diff1;
                                        $years = floor($diff1 / (365 * 60 * 60 * 24));
                                        $months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                        $hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                                        $minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                                        $seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                                        $allDays = ($months * 30) + $days;
                                        if($years!=0){echo "$years years,";}
                                        printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);*/
                                      // printf("%d days", $allDays);
                                   // } 
                                ?>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                }
                ?>       
              
            </tbody>
        </table>    

</div>
</div>
<?php

$base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">

   var TableDatatablesButtons = function() {

     var e = function() {

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

                 buttons: [{

                     extend: "print",

                     className: "btn dark btn-outline"

                 }, {

                     extend: "copy",

                     className: "btn red btn-outline"

                 }, {

                     extend: "pdf",

                     className: "btn green btn-outline"

                 }, {

                     extend: "excel",

                     className: "btn yellow btn-outline "

                 }, {

                     extend: "csv",

                     className: "btn purple btn-outline "

                 }, {

                     extend: "colvis",

                     className: "btn dark btn-outline",

                     text: "Columns"

                 }],

                 responsive: !0,

                 order: [

                     [0, "asc"]

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

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                  dom: "<'row'r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

         a = function() {

             var e = $("#sample_3"),

                 t = e.dataTable({

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

                     buttons: [{

                         extend: "print",

                         className: "btn dark btn-outline"

                     }, {

                         extend: "copy",

                         className: "btn red btn-outline"

                     }, {

                         extend: "pdf",

                         className: "btn green btn-outline"

                     }, {

                         extend: "excel",

                         className: "btn yellow btn-outline "

                     }, {

                         extend: "csv",

                         className: "btn purple btn-outline "

                     }, {

                         extend: "colvis",

                         className: "btn dark btn-outline",

                         text: "Columns"

                     }],

                     responsive: !0,

                     order: [

                         // [0, "asc"]

                     ],

                     lengthMenu: [

                         [5, 10, 15, 20, -1],

                         [5, 10, 15, 20, "All"]

                     ],

                     pageLength: 10

                 });

             $("#sample_3_tools > li > a.tool-action").on("click", function() {

                 var e = $(this).attr("data-action");

                 t.DataTable().button(e).trigger()

             })

         },

         n = function() {

            /* $(".date-picker").datepicker({

                 rtl: App.isRTL(),

                 autoclose: !0

             });*/

             var e = new Datatable;

             e.init({

                 src: $("#datatable_ajax"),

                 onSuccess: function(e, t) {},

                 onError: function(e) {},

                 onDataLoad: function(e) {},

                 loadingMessage: "Loading...",

                 dataTable: {

                     bStateSave: !0,

                     lengthMenu: [

                         [10, 20, 50, 100, 150, -1],

                         [10, 20, 50, 100, 150, "All"]

                     ],

                     pageLength: 10,

                     ajax: {

                         url: "../demo/table_ajax.php"

                     },

                     order: [

                         [1, "asc"]

                     ],

                     buttons: [{

                         extend: "print",

                         className: "btn default"

                     }, {

                         extend: "copy",

                         className: "btn default"

                     }, {

                         extend: "pdf",

                         className: "btn default"

                     }, {

                         extend: "excel",

                         className: "btn default"

                     }, {

                         extend: "csv",

                         className: "btn default"

                     }, {

                         text: "Reload",

                         className: "btn default",

                         action: function(e, t, a, n) {

                             t.ajax.reload(), alert("Datatable reloaded!")

                         }

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

             jQuery().dataTable && (e(), t(), a(), n())

         }

     }

   }();
   jQuery(document).ready(function() {

     TableDatatablesButtons.init();
   

   });

</script>

        