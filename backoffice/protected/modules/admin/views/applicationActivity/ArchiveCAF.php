
<?php 


$role_id=array('7','33','4','34','61');
$connection=Yii::app()->db;
//print_r($_SESSION);die;
$sql1="select disctrict_id from bo_user where uid=".$_SESSION['uid'];

$command=$connection->createCommand($sql1);
$userData=$command->queryRow();

 $role_Data=RolesExt::getUserRoleViaId($_SESSION['uid']);
 // print_r($role_Data);die;
$role_id=$role_Data['role_id'];
//$role_id="34";
$districtID=$userData['disctrict_id'];

//$_SESSION['role_id']="61";
if($role_id=="7" || $role_id=="33")
$sql="SELECT * FROM bo_application_submission  WHERE application_status in('I','H','B') and field_value like '%land_disctric".'":"'.$districtID."%'";
if($role_id=="4" || $role_id=="34")
$sql="SELECT * FROM bo_application_submission as s  WHERE s.application_status IN ('I','H','B') AND s.application_id='1'  
                    AND s.user_id !='11' and DATEDIFF(CURDATE(), application_created_date) > 90 AND s.field_value like '%ntrofunittype" . '":"' . 'large' . "%'";
if($role_id=="61")
$sql="SELECT * from  bo_application_submission where application_status in('I','H','B') ";
$command=$connection->createCommand($sql);
$applications=$command->queryAll();
// print_r($applications);die;
?>


                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-globe"></i>CAF Application</div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                                <thead>
                                <tr>
                                    <th align="center">CAF</th>
                                    <th align="center">IUID</th>
                                    <th align="center">Unit</th>
                                   <th align="center">Create Date</th>
                                    <th align="center">Investor's Email</th>
                                    <th align="center">Mobile</th>
                                    <th>Comments</th>
                                    <!--<th class="hidden-phone" align="center">Date &amp; Time</th>-->
                      
                                    <th class="center hidden-phone" align="center">Distt./State</th>
                                    <th class="center hidden-phone" align="center">Status</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                               <?php 
                              if(!empty($applications))
                                foreach ($applications as $apps) {
								if(!empty($apps['field_value'])){
                                   $decode_app = json_decode($apps['field_value']);
                        if (((($role_id==4) || ($role_id==34)) && (isset($decode_app->ntrofunit,$decode_app->invstmnt_in_plant[0]) && (($decode_app->ntrofunit=='Manufacturing' && $decode_app->ntrofunittype=='large' && $decode_app->invstmnt_in_plant[0] >10) || ($decode_app->ntrofunit=='Services' && $decode_app->ntrofunittype=='large' && $decode_app->invstmnt_in_plant[0] > 5)))) || (($role_id!=4) && ($role_id!=34))){ 
                        
                        
                         
                                  $investorinfo=ApplicationExt::getInvestorDetails($apps['user_id']);
                                  $api_hash=hash_hmac('sha1', md5($apps['user_id']), SSO_API_PUBLIC_KEY);
                                  $post_data=array('uid'=>$apps['user_id'],'api_hash'=>$api_hash);
                                  /*$response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserId',$post_data));
                                  $uname='';
                                  if(is_object($response) && (isset($response->STATUS) && $response->STATUS===200))
                                         $uname=$response->RESPONSE;*/
                                  $dist_name=DistrictExt::getDistricNameById($apps['landrigion_id']);
                                  $cafindname= ApplicationExt::getIndustryNamefromCAF($apps['submission_id']);
                                  $revertcomment= ApplicationExt::getRevertedComment($apps['submission_id']);
                                  echo "
                                <tr class='gradeX'>
                                    
                                    <td style='font-size: 13px; vertical-align: middle; text-align: center;' width='1%'>".$apps['submission_id']."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: center;' width='1%'>".$investorinfo['iuid']."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: left;' width='13%'>".$cafindname."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: left;' width='13%'>".$apps['application_created_date']."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: left;' width='5%'>".$investorinfo['email']."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: center;' width='3%'>".$investorinfo['mobile_number']."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: left;' width='45%'>". $revertcomment ."</td>
                                    <td style='font-size: 13px; vertical-align: middle; text-align: center;' width='3%'>".$dist_name."</td>";
                                    
                                      if($apps['application_status']=='F')
                                            echo "<td style='display: table-cell' class='label label-sm label-warning'>Forwarded</td>";
                                          if($apps['application_status']=='P')
                                            echo "<td style='display: table-cell' class='label label-sm label-info'>Pending</td>";
                
                                          if($apps['application_status']=='A')
                                            echo "<td style='display: table-cell' class='label label-sm label-success'>Approved</td>";
                                            
                                          if($apps['application_status']=='B')
                                            echo "<td style='display: table-cell' class='label label-sm label-primary'>Due for Payment</td>";
                                          
                                          if($apps['application_status']=='H')
                                            echo "<td style='display: table-cell' class='label label-sm label-default'>Reverted</td>";
                                            
                                          if($apps['application_status']=='I')
                                            echo "<td style='display: table-cell' class='label label-sm label-warning'>Incomplete</td>";

                                          if($apps['application_status']=='R')
                                            echo "<td style='display: table-cell' class='label label-sm label-danger'>Rejected</td>";
                                        
                                       
                                                    	echo" <td><a data-toggle='modal' class='fields_properties_modal btn btn-shadow btn-info' onclick='addSubId(".$apps['submission_id'].")' href='#forward_to_multi_dept'> <i class='fa fa-mail-forward (alias)'></i> Archive</a></td>";
                                                   
                              echo "                                       </tr>";
                                }}  }

                                ?>
                                </tbody>
                            </table>
                                    </div>
                                </div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forward_to_multi_dept" class="modal fade">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Reason For Archive</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <?php 
                  echo "<div class='row-fluid'>
                  <div class='col-md-10'>
                      <form id='multi_depart_select_msg' action='".Yii::app()->createAbsoluteUrl('admin/ApplicationActivity/ArchiveCAF')."' method='post'>";
                        echo "<textarea name='comments' class='form-control required'></textarea>";
                        echo "<input type='hidden' value='' class='app_sub_id' name='app_sub_id'>";
                echo '</div></div>';
                  ?>
               <div class="row"><span class="select_error" style="color:red"></span></div>
            </div>
         </div>
         <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
            <input type='submit' class="btn btn-success" value="Submit">
            </form>
         </div>
      </div>
   </div>
</div>



      <?php
$base=Yii::app()->theme->baseUrl;
?>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
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
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                },  {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "excel",
                    className: "btn default"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries found",
                        infoFiltered: "(filtered1 from _MAX_ total entries)",
                        lengthMenu: "_MENU_ entries",
                        search: "Search:",
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
                    pageLength: 10
                });
            $("#sample_3_tools > li > a.tool-action").on("click", function() {
                var e = $(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        },
        n = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            });
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
    TableDatatablesButtons.init()
});
function addSubId(id){
    // console.log(id+'Here');
    $('.app_sub_id').val(id);
}



</script>


