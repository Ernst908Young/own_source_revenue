<?php
/* Rahul Kumar : 13072018 */
//print_r($serviceData);die; 
$base = Yii::app()->theme->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl;
// Making Status Array
$statusArray = array('A' => 'Approved', 'P' => 'Pending', 'F' => 'Forwarded', 'I' => 'Incomplete', 'RBI' => 'Reverted', 'R' => 'Rejected','O'=>'Rejected');
$selectedDepartment=explode(",",$departmentList);
$selectedServices=explode(",",$serviceList);
$selectedStatus=explode(",",$statusList);
?>
<style>
    .modal .modal-header {
        border-bottom: 1px solid #EFEFEF;
        color: #fff;
        background: #36c6d3;
    }
    table th{ vertical-align: midddle;text-align: center;}

    .select2-container .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
        background: #fff;
        height: 30px;
    }
    .select2-container .select2-choice div {
        border-left: 0;
        background: none;
    }
    .select2-container .select2-choice .select2-arrow {
        background: none;
        border: 0;
    }
    .select2-container.select2-drop-above .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
    }
    .select2-container .select2-search-choice-close {
        top: 3px;
    }
    .select2-container .select2-choices {
        background-image: none;
    }
    .select2-container.select2-container-multi .select2-choices {
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        background: #fff;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-field input {
        padding: 9px 5px;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-choice {
        background: #eee;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    .select2-results, .select2-search, .select2-with-searchbox {
        -webkit-border-radius: 0 !important;
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
    }
    .select2-results .select2-highlighted {
        background: rgb(38,194,129) !important;
        color: #fff;
    }

</style>
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<div class='portlet box '>    
    <div class="portlet-body">
        <form method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label>Select Date Range</label>
                    <select class="form-control" name="dateRange">
                        <option>Select Date Range</option>
                        <option></option>
                    </select>
                </div>

                <div class="col-md-6" style="display:none;">
                    <label>Select Financial Year</label>
                                                          <?php
                                        $m = date('m');
                                        $yyy = date('Y');
                                        if ($m > 3) {
                                            $yyy = $yyy - 1;
                                        }
                                        $pp = '2015';
                                        ?>
                                        <select name="fy" class="select2-me">
                                            <option value="" 
                                            <?php if ($fy == "ALL") {
                                                echo "selected='selected'";
                                            } ?> >ALL
                                            </option>
                                            <?php for ($i = $pp; $i <= $yyy + 1; $i++) {
                                                $j = $i + 1;
                                                $k = $i . '-' . $j; 
                                                $kv = $i . '-04-01:' . $j.'-03-31'; 
                                                
                                                ?>
                                                <option value="<?php echo $kv; ?>" 
                                                <?php if ($fy == $kv) {
                                                    echo "selected='selected'";
                                                } ?>>
    <?php echo $k; ?>
                                                </option>
<?php
}?>           
                    </select>
                </div>
                <div class="col-md-6">
                     <label>Select Incidence</label>
                    <select name="incidence[]" class="select2-me"  multiple="multiple">
                        <option value="">All Incidence</option>
                        <option value="pre_establishment" >Pre Establishment</option>
                        <option value="pre_operation">Pre Operation</option>
                        <option value="post_operation">Post Operation</option>                        
                    </select>                    
                </div>
            </div>
            <div class="col-md-12" style="margin-top:15px;">
                <div class="col-md-6">
                    <label>Select Department</label>
                    <select class="select2-me" multiple="multiple" name="department[]">
                          <option value="">All Departments</option>
                        <?php                         
                        $sql="SELECT ssp.sp_id, bd.department_name from sso_service_providers  as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
                         // Gettting values from dattabase as per passed parameters for services
                         $allList = Yii::app()->db->createCommand($sql)->queryAll();
                        // print_r($allList);die;
                        ?>
                         <?php foreach($allList as $k=>$v){ ?>
                          <option value="<?php echo $v['sp_id']; ?>" <?php if(in_array($v['sp_id'],$selectedDepartment)){ echo " selected";}?>><?php echo $v['department_name']; ?></option>  
                        <?php }?>
                    </select>
                </div>
               <?php //print_r($allList);die; ?>
                <div class="col-md-6">
                    <label>Select Service</label>
                        <select class="select2-me" multiple="multiple" name="service[]">
                              <option value="">All Services</option>
                        <?php //$allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master','id','sub_service_name'); 
                        if(!isset($departmentID)){
                        $departmentID="select sp_id From sso_service_providers where is_service_provider_active='Y'";
                        }       
                        $sql="select app_id,app_name from bo_sp_all_applications where sp_id IN ($departmentID) AND is_app_active='Y'";
                         // Gettting values from dattabase as per passed parameters for services 
                         $allList = Yii::app()->db->createCommand($sql)->queryAll();
                        ?>
                         <?php foreach($allList as $k=>$v){ ?>
                          <option value="<?php echo $v['app_id']; ?>" <?php if(in_array($v['app_id'],$selectedServices)){ echo " selected";}?>><?php echo $v['app_name']; ?></option>  
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:15px;">
                <div class="col-md-6">
                    <label>Select Status</label>
                    <select class="select2-me" multiple="multiple" name="serviceStatus[]"> 
                        <option value="">All Status</option>
                        <?php foreach ($statusArray as $key => $status) { ?>
                            <option value="<?php echo $key; ?>" <?php if(in_array($key,$selectedStatus)){ echo " selected"; }?>><?php echo $status; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Select Timeline</label>
                    <select class="select2-me" name="timeline">    
                       <option value="" >All </option>
                       <option value="<16" >With-in 15 Days</option>
                        <option value="15>">More than 15 Days</option>   
                    </select>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:15px;">
                <div class="col-md-6">
                    <label>Application Number</label>
                    <input class="form-control" placeholder="Application Number" name="applicationNumber" <?php if(!empty($applicationNumber)){ ?> value="<?php echo $applicationNumber; ?>" <?php } ?>>
                </div>
                <div class="col-md-6">
                    <label>Unit Name</label>
                    <input class="form-control" placeholder="Unit Name" name="unitName" <?php if(!empty($unitName)){?> value="<?php echo $unitName; ?>" <?php } ?>>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:15px;">
                    <input type="submit" value="Submit" class="btn btn-success" >
                </div>
            </div>
            </form>
    </div>
</div>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>All Applied Services by Investor > Total Applied Services : <?php echo count($serviceData); ?>   </div>
        <div class='tools'>	
        </div>
        <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; "></div>	
    </div>
    <div class="portlet-body">
        <div class="site-min-height">
            <div class="form form-horizontal" role="form">
            </div>
        </div>
        <?php
        if (!empty($serviceData)) {
            ?>
            <table id="sample_2" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name of Department</th>
                        <th>Applied Service Detail</th>
                        <th>Unit Detail</th>
                        <th>Investor Detail</th>
                        <th>Status at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($serviceData as $key => $serviceDetail) { ?>
                        <tr>
                            <td>
                                <?php echo $key + 1; ?>
                            </td>
                            <td>
                                <?php echo @$serviceDetail['Name of Department']; ?>
                            </td>
                            <td>
                                <b title="Application Number"><?php echo @$serviceDetail['Application No.']; ?></b>
                    <br><c title="Service Name"><?php echo @$serviceDetail['Service Name']; ?>
                        <br><c title="applied at"><?php echo @$serviceDetail['Application Date']; ?></c>
                        </td>
                        <td><c title="Unit Name"> <?php echo @$serviceDetail['Unit Name']; ?></c>
                        </br><c title="Unit Location"><?php echo @$serviceDetail['Unit Location']; ?></c>
                        <b><c title="Unit District"><?php echo @$serviceDetail['Unit District']; ?></c></b>
                        </td>
                        <td><?php echo @$serviceDetail['Investor Name']; ?>
                            </br><?php echo @$serviceDetail['Investor Email']; ?>
                            </br><?php echo @$serviceDetail['Investor Mobile Number']; ?>
                        </td>
                        <td><b><?php $status = $serviceDetail['Status'];
                                echo $statusArray[$status];
                                ?> </b>
                            <br><?php echo @$serviceDetail['Last Updated']; ?>
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
        <?php
        } else {
            echo "No Service Found.";
        }
        ?>
    </div>
</div>

<?php
$base = Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $base ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->



<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $base ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

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
</script>