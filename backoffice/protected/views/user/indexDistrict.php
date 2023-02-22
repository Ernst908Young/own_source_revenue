<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$baseUrl = Yii::app()->theme->baseUrl;
$this->breadcrumbs = array(
    'Users',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="dt-buttons" style="margin-bottom: 10px; float: right; "><a class="btn blue btn-outline" tabindex="0" href="javascript:void(0)" style="cursor: not-allowed"><span>Add New </span></a><?php //echo $this->createUrl('/user/createDistrict/') ?>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-eye-slash"></i>
                    <span class="caption-subject bold uppercase">DISTRICT USER - Single Window Act</span>
                </div>


            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                        <tr>
                            <!--Upadeted/Added sequence Sno, DistrictUser, name, Designation, Role, Ofc name, Mobile,  Email, Action-->
                            <th>Sno</th>
                            <th>District</th>
                            <th>Full Name</th> 
                            <th>Designation</th> 
                            <th>Role</th> 
                            <th>Office Name</th> 
                            <th>Email</th> 
                            <th>Mobile</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($datas)) {
                            $sn = 1; //print_r($datas);die;
                            foreach ($datas as $key => $data) {
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td> <?php
                                        $connection = Yii::app()->db;
                                        $isactive = 'Y';
                                        $sql = "SELECT distric_name FROM bo_district where district_id=$data[disctrict_id]";
                                        $command = $connection->createCommand($sql);
                                        $allData = $command->queryAll();
                                        echo @$allData[0]['distric_name'];
                                        ?></td>
                                    <td><?php echo $data['full_name']; ?></td>
                                    <td> <?php ?></td>
                                    <td> <?php if ($data['role_name'] == "Comment_Level_distt") {
                                            echo "Department District Nodal Officer";
                                        } ?></td>
                                    <td> </td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['mobile']; ?></td>
                                   <!-- <td><?php //echo $data['is_active']=='1'?'Y':'N';  ?></td>
                                    <td><?php //echo $data['created_datetime'];  ?></td>-->
                                    <td>

                                        <a class="view" title="Edit" href="<?= $this->createUrl('/user/editDistrict/id/' . base64_encode($data['uid'])); ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a> 


                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7">No record(s) found.</td>

                            </tr>
<?php } ?>

                        </tr>

                    </tbody>

                </table>

            </div>
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
                                    className: "btn  white btn-outline"
                                }, {
                                    extend: "pdf",
                                    className: "btn  white btn-outline"
                                }, {
                                    extend: "excel",
                                    className: "btn  white btn-outline"
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