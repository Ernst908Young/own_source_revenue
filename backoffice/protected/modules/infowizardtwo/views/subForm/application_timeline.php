<title>Service Timeline</title>
<?php
$subID = base64_decode($_GET['subID']);
$sql="SELECT * from bo_infowiz_form_builder_application_log where app_Sub_id=$subID group by action_status,created order by created ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$res = $command->queryAll();
if((isset($_SESSION) && !empty($_SESSION['uid'])) || (isset($_SESSION['RESPONSE']['user_id'])))
{   
    
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
            <?php if(isset($_SESSION['role_id'])){ ?>
                <li><a href="/panchayatiraj/backoffice/admin">Home</a></li>
          <?php }else{ ?>
                <li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>
           <?php } ?>
          
       
          <li>Service Timeline</li>
          </ul>
     <!--  <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
           <h4>Timeline for SRN : <1?= $subID ?></h4>
         
        </div> -->



        <table class="table table-striped table-bordered table-hover" >
            <?php 
            if($subID != '')
            {            
            ?>
                <tr>
                    <td><b>Name Of Investor</b></td>
                    <td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
                    <td><b>IUID</b></td>
                    <td><?php echo @$invData['iuid']; ?></td>
                </tr>
                <tr>
                    <td><b>Contact Detail</b></td>
                    <td><?php echo $invData['mobile_number']." : ".$invData['email']; ?></td>
                    <td><b>SRN</b></td>
                    <td><?php echo $subID; ?></td>
                </tr>

                <tr style="display:none;">
                    <td><b>Unit Name :</b></td>
                    <td><?php   echo @$invData['unit_name'] ?></td>
                    <td><b>Unit District</b></td>
                    <td><?php                         
                    if(!empty($invData['landrigion_id'])){
                        $districtID=$invData['landrigion_id'];
                    }               
                    if(!empty($districtID)){
                        $sql = "SELECT distric_name from bo_district where district_id=$districtID";
                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql);
                        $dname = $command->queryRow();
                        echo $dname['distric_name'];
                    } ?>

                    </td>
                </tr>
            <?php 
            } 
            ?>          
            <tr style="display:none;">
                <td><b>Time taken by Investor</b></td>
                <td id="InvTime"></td>
                <td><b>Time taken by Nodal Agency</b></td>
                <td id="NodTime"></td>                        
            </tr>
        </table>


        <table id="sample_2" width="100%">
            <thead>
                <tr>
                    <th  class="text-center">
                    S.No.
                    </th>
                    <th  class="text-center">Action Taken On</th>
                    <th  class="text-center">Action Taken By</th>
                    <th  class="text-center">Status</th>
                    <th  class="text-center">Remarks</th>                   
                    <th  class="text-center">Time taken</th>
                </tr>
            </thead>
            <tbody class="ticket-item">
               <?php
               /* $sql = "SELECT h.application_status as current_status,h.added_date_time,h.comments,h.role_user_info from  bo_sp_application_history as h LEFT JOIN bo_new_application_submission on h.app_id=bo_new_application_submission.submission_id where h.app_id=$subID";*/

               $sql = "SELECT * from  bo_infowiz_form_builder_application_log where app_Sub_id=$subID";

                $command = $connection->createCommand($sql);
                $apps = $command->queryAll();
                
                $count = 1;
                if (empty($apps)) {

                    echo "<tr><td colspan='5'>No Detail Found</td></tr>";
                } else { 
                    
                    //$apps1 = $apps;
                    $diffapplicant = 0;
                    $diffdept = 0;
                    $diffdept12=0;
                    foreach($apps as $key => $val) 
                    {                        
                       /* $appsgf = $apps['current_status'];
                        $status = $apps['current_status'];*/
                        if($val['action_status'] != "I") 
                        {

                        ?>

                             <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td class="text-center">
                                <?php $create = date('Y-m-d H:i:s', strtotime($val['created']));
                                    echo date('d-M-Y H:i:s', strtotime($val['created']));
                                ?>
                                </td>
                                <td class="text-center">  
                                <?php if($val['department_user_id']){
                                        $depart_user = $connection->createCommand("SELECT CONCAT(full_name,' ',middle_name,' ',last_name) as full_name, email, mobile  from  bo_user where uid=".$val['department_user_id'])->queryRow();
                                       // echo $depart_user['full_name'].'<br>'.$depart_user['email'].'<br>'.$depart_user['mobile'];
                                        echo $depart_user['full_name'];
               
                                }else{
                                    echo 'Applicant';
                                }
                                    ?>                             
                                 
                                </td>
                                <td>
                                    <?php 

                                     switch ($val['action_status']) {
                                            case "I":
                                             echo "Draft";
                                                  break;
                                            case "DP":
                                               echo "Draft";      
                                              break;
                                            case "SP":                      
                                              echo "Signature Pending";                
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
                                </td>
                                                         
                                <td class='text-center'>
                                  
                                <?php  
                                   if($val['form_id']!=1){
                                        if($val['form_id']==3 && $val['action_status']=='H'){
                                         
                                        }else{
                                            echo '<br><b> Comment</b>: '.nl2br(stripcslashes(stripcslashes(stripcslashes(stripcslashes($val['department_comment']))))) ;
                                        }
                                   }else{
                                    echo $val['action_status']=='DP' ? "Application Submitted but Document Pending" : $val['action_message'];
                                   }
                               
                                ?>
                                </td>
                                
                                <td class='text-center'>
                                <?php  
                                   
                                    
                                    if ($key == 0) {                                       
                                            $date = $val['created'];                           
                                    } else {
                                        $keyval = $key - 1;
                                        $date = $apps[$keyval]['created'];
                                    }

                                $diff1 = abs(strtotime($val['created']) - strtotime($date));
                                $diffdept = $diffdept + $diff1;
                                $years = floor($diff1 / (365 * 60 * 60 * 24));
                                $months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                              
                                $allDays = ($months * 30) + $days;
                              
                               printf("%d days", $allDays);
                                   
                                ?>
                                </td>
                            </tr>
                        <?php
                        }

                    }

                }
                ?>       
                <tr>
                    <td class='text-center'><?php echo $count++; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='text-center'><b>Total Time:</b></td>
                   
                    <td class='text-center'> 
                        <?php //Total time of department
                       $years = floor($diffapplicant / (365 * 60 * 60 * 24));
                        $months = floor(($diffdept - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        $days = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));                       
                        $allDaysdept = ($months * 30) + $days;

                       echo "<b>"; 
                     
                       printf("%d days", $allDaysdept); echo "</b>"; 
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>    

</div>
</div>
<?php
}else{
    echo "You are unauthorised to access this url"; 
}
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

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

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
     /* $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');*/

   });

</script>

        