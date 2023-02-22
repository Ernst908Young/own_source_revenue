<?php


//$base = "/backoffice/themes/swcsNewTheme/"; 
$iw = "";
$view = 'ALL';
$dept_wh = "";
$res_caf = array();
if (isset($_GET['iw']) && $_GET['iw'] == 'Y') {
    $view = "Y";
    $iw = $_GET['iw'];
    $dept_wh = " AND (istm.to_be_used_in_infowiz='Y' OR istm.to_be_used_in_online_offline = 'Y')"; 
}


$sql_d = "SELECT m.* FROM bo_infowizard_issuerby_master as m LEFT JOIN bo_information_wizard_service_master as sm ON sm.issuerby_id=m.issuerby_id "
        . " LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sm.id "
        . " WHERE m.is_issuerby_active='Y' AND m.issuer_id='2' $dept_wh GROUP BY m.issuerby_id ORDER BY m.name ASC";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql_d);
$res_d = $command->queryAll();


if (isset($_GET['id']) && ($_GET['id'] > 0 || $_GET['id'] == 'ALL')) {
    $id = $_GET['id'];
    //print_r($id);die;
    $incentive = ''; //$_GET['incentive'];
    $display = "block";

    $wh_text = "";

    if ($incentive == '1') {
        $wh_text .= " AND sm.is_incentive='1'";
    }
    if ($id > 0) {
        $wh_text .= " AND sm.issuerby_id='$id'";
    }

    // Get list of all services and sub-services
    if ($view == 'Y') {
        // For only display records to be used in IW & is_incentives
        $sql_s = "SELECT sm.*,sp.*,istm.*,im.name as dept_name FROM bo_information_wizard_service_master as sm  
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
			  INNER JOIN bo_infowizard_issuerby_master as im ON im.issuerby_id=sm.issuerby_id 
                          LEFT JOIN bo_infowizard_subservice_tag_mapping as istm ON istm.service_id=sp.service_id AND istm.subservice_id=sp.servicetype_additionalsubservice
			  WHERE (istm.to_be_used_in_infowiz='Y' OR istm.to_be_used_in_online_offline = 'Y') AND sp.is_active='Y' AND istm.is_active='Y' $wh_text  group by istm.sub_service_id ORDER BY sp.servicetype_additionalsubservice ASC,sp.service_id ASC ";
    } else {
        // For All services listing
        $sql_s = "SELECT sm.*,sp.*,im.name as dept_name FROM bo_information_wizard_service_master as sm  
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
			  INNER JOIN bo_infowizard_issuerby_master as im ON im.issuerby_id=sm.issuerby_id	
			  WHERE sp.is_active='Y' $wh_text ORDER BY im.name ASC,sp.service_id ASC";
    }
    echo "<!-- HELLO $sql_s -->";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql_s);
    $res_s = $command->queryAll();
    //echo '<pre>'; print_r($res_s); die;
    //$user_id = $_SESSION['RESPONSE']['user_id'];
    // bo_application_submission
    /* $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id='1' ORDER BY submission_id ASC";
      $connection=Yii::app()->db;
      $command=$connection->createCommand($sql_caf);
      $res_caf = $command->queryAll(); */
//echo '<pre>'; print_r($res_caf); die;
} else {
    $id = '';
    $incentive = '';
    $display = "none";
    $user_id = '11'; //$_SESSION['RESPONSE']['user_id'];
    $sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id='1' ORDER BY submission_id ASC";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql_caf);
    $res_caf = $command->queryAll();
}
?>


<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>List of Services Beta*</div>
        <div class='tools'> </div>

    </div>
    <div class="portlet-body">

        <div class="row" style="margin:0px 0 20px 0;">
            <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label" style="margin-top:8px;">Select Department:</label>
            <div class="col-lg-4">	
                <select name="issuerby_id" class="form-control" onchange="window.location = '/backoffice/infowizard/serviceMaster/listSubServicePage/<?php if ($iw != '') { ?>iw/Y/<?php } ?>id/' + this.value">
                    <option value="">Select Department</option>
                    <?php foreach ($res_d as $dep_arr) { ?>
                        <option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php
                        if ($id == $dep_arr['issuerby_id']) {
                            echo 'selected';
                        }
                        ?>><?php echo $dep_arr['name']; ?></option>
                    <?php } ?>
                    <option value="ALL" <?php
                    if ($id == 'ALL') {
                        echo 'selected';
                    }
                    ?>>ALL Departments</option>
                </select>
            </div>
                       <?php if ($id > 0) { ?>
                <div class="col-lg-2" style="margin-top:8px;">
                    <input type="checkbox" name="is_incentive" id="is_incentive" value="1" <?php
                       if ($incentive == '1') {
                           echo 'checked';
                       }
                       ?> onchange="reloadPage()"> Is Incentives
                </div>
<?php } ?>
        </div>
        
        <table class="table table-striped table-bordered table-hover" id="sample_2">
            <thead>
                <tr>

<?php if ($id == 'ALL') { ?>
                                <th align="center" style="vertical-align:middle" style="width:20%">Department Name</th>
<?php } ?>
                                <th align="center" style="vertical-align:middle; text-align:center; width:30%">Service Name</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:10%">Type Of Service</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:10%">Service ID</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:10%">Pre-Establishment</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:10%">Pre-Operation</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:20%">Status Of Service</th>
                                <th align="center" style="vertical-align:middle; text-align:center; width:10%">Action</th>
                                
                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php
//							$caf_dropdown = '<select name="caf_id" class="form-control">
//								<option value="">Select Approved CAF</option>';
//								foreach($res_caf as $keyc=>$caf_arr){
//									$caf_dropdown .= '<option value="1">CAF ID - '.$caf_arr['submission_id'].'</option>';
//								}
//							$caf_dropdown .= '</select>';

                            foreach ($res_s as $key => $data_arr) {
                                $service_id = $data_arr['service_id'];
                                $sub_service_id = $data_arr['servicetype_additionalsubservice'];
                                ?>
                                <!--<form action="/backoffice/frontuser/ServiceMaster/documentCheckList/" method="POST">-->

                            <input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />

                            <tr>
    <?php if ($id == 'ALL') { ?>
                                    <td style="vertical-align:middle"><?php echo $data_arr['dept_name']; ?></td>
    <?php } ?>
                                <td style="vertical-align:middle"><?php echo $data_arr['core_service_name']; ?></td>
                                <td style="vertical-align:middle"><?php echo $data_arr['service_type']; ?></td>
                                <td style="vertical-align:middle"><?php echo $service_id . "." . $sub_service_id; ?></td>
                                <td align="center" style="vertical-align:middle"><?php echo $data_arr['incidence_pre_establishment'] == '1' ? 'Yes' : 'No'; ?></td>
                                <td align="center" style="vertical-align:middle"><?php echo $data_arr['incidence_pre_operation'] == '1' ? 'Yes' : 'No'; ?></td>

                                <td align="center" style="vertical-align:middle">
                                    <?php
                                    $offline_flag = 0;
                                    $online_flag = 0;
                                    $swcs_flag = 0;

                                    $is_online = $data_arr['is_online'];
                                    $is_integrated_with_swcs = $data_arr['is_integrated_with_swcs'];
                                    if ($is_online == 'N') {
                                        $status_text = "Offline";
                                        $offline_flag = 1;
                                        $online_flag = 0;
                                        $swcs_flag = 0;
                                    } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'Y') {
                                        $status_text = "Integrated With SWCS";
                                        $offline_flag = 0;
                                        $online_flag = 0;
                                        $swcs_flag = 1;
                                    } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'N') {
                                        $status_text = "Online";
                                        $offline_flag = 0;
                                        $online_flag = 1;
                                        $swcs_flag = 0;
                                    }
                                    echo $status_text;
                                    ?>
                                </td>
                                <!--<td>
                                <?php
                                if ($swcs_flag == 1 || $offline_flag == 1) { //echo $caf_dropdown; 
                                }
                                ?>
                                </td> -->
                            <?php
                            $mapped_docs = json_decode($data_arr['document_checklist_creation'], true);
                            ?>
                                        <?php $questioncount = serviceMasterController::getListofSubServiceForm($service_id,$sub_service_id);
                                       // print_r($questioncount);die;
        if ($questioncount > 0) { ?>
                                <td style="vertical-align:middle">
            <a href="/backoffice/infowizard/infowizardQuesansMapping/SubFormQuestionAnswerUpdateNext/serviceID/<?php echo $service_id; ?>/subserviceID/<?php echo $sub_service_id; ?>">Edit Question</a>
</td>
        <?php } else{?>

                                <td style="vertical-align:middle">
            <a href="/backoffice/infowizard/infowizardQuesansMapping/subformquestionanswernext/serviceID/<?php echo $service_id; ?>/subserviceID/<?php echo $sub_service_id; ?>">Add Question</a>
</td> 
         <?php } ?>                    </tr>
                            </form>
<?php } ?>  

                        </tbody>

                    </table>

    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->


<style type="">
    .modal{
        width:900px;
        margin-left:-400px;
        height:500px;
    }

</style>


<script type="text/javascript">

    var TableDatatablesButtons = function () {
        var e = function () {
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
                t = function () {
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
                        // For Service Module Mapping - Ends Here Rahul Kumar : 02052018
                        "fnDrawCallback": function (oSettings) {
                            //alert( 'DataTables has redrawn the table' );
                            $(".services_list").click(function () {
                                var service_id = $(this).data("service_id");
                                $.ajax({

                                    type: "POST",
                                    url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subServiceTagMapping/subServicelist",

                                    data: {service_id: service_id},
                                    success: function (data) { //alert(data);
                                        $('#sub_service_name_list').html('');
                                        $('#sub_service_name_list').html(data);

                                    },
                                    complete: function (data) {
                                        submitme();
                                    }
                                });


                            });
                        },
//For Service Module Mapping - Ends Here Rahul Kumar : 02052018
                        buttons: [{
                                extend: "print",
                                className: "btn default"
                            }, {
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
                a = function () {
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
                    $("#sample_3_tools > li > a.tool-action").on("click", function () {
                        var e = $(this).attr("data-action");
                        t.DataTable().button(e).trigger()
                    })
                },
                n = function () {
                    $(".date-picker").datepicker({
                        rtl: App.isRTL(),
                        autoclose: !0
                    });
                    var e = new Datatable;
                    e.init({
                        src: $("#datatable_ajax"),
                        onSuccess: function (e, t) {},
                        onError: function (e) {},
                        onDataLoad: function (e) {},
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
                                    action: function (e, t, a, n) {
                                        t.ajax.reload(), alert("Datatable reloaded!")
                                    }
                                }]
                        }
                    }), e.getTableWrapper().on("click", ".table-group-action-submit", function (t) {
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
                    }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
                        var t = $(this).attr("data-action");
                        e.getDataTable().button(t).trigger()
                    })
                };
        return {
            init: function () {
                jQuery().dataTable && (e(), t(), a(), n())
            }
        }
    }();
    jQuery(document).ready(function () {
        TableDatatablesButtons.init()
    });
    function viewSector(key) {
        $('#mcont').html($('#s_' + key).html());
        $('#questionDiv').modal('show');
    }
</script>


<!-- For Service Module Mapping - Ends Here Rahul Kumar : 02052018 -->
<p id="loading-mask"></p>
<script>

    jQuery(document).ready(function () {



    });

    function submitme() {

        $('.submit_page').click(function () {
            //alert('hi.. submit');
            var gy = $(this);
            var formID = $(this).data('form_id');
            var key = $(this).data('key');
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/addsubservicetagmapping',
                data: $('.tagmappingform' + key).serialize(),
                success: function (data) {
                    if (data != "Data saving failed. Please try again.") {
                        gy.closest('td').html('Data Saved');
                        gy.closest('td').css('color', 'green');
                        $("#errormessageofservicemodulemapping").addClass('alert alert-success');
                        $("#errormessageofservicemodulemapping").html(data);
                        // gy.html('Save Data');
                    } else {
                        // gy.closest('td').html('Data Saved');
                        // gy.closest('td').css('color','green');
                        $("#errormessageofservicemodulemapping").addClass('alert alert-danger');
                        $("#errormessageofservicemodulemapping").html(data);
                    }
                }

            });
        });
    }
</script>
<!-- Modal -->
<div class="modal fade" id="subServiceTagMapping" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content" style="width:100%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Module-Service List</h4>
            </div>
            <div class="modal-body">
                <p id="errormessageofservicemodulemapping"></p>
                <div id="sub_service_name_list">
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- For Service Module Mapping - Ends Here Rahul Kumar : 02052018 -->
