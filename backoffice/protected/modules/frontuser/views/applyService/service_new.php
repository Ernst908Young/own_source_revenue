<style>
    .alert-danger{display:none;}
	.dt-buttons{margin-top:52px !important}
</style>

<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;

if (isset($_GET['financial_year'])) {
    $financial_year = $_GET['financial_year'];
} else {
    $financial_year = 'ALL';
}


if (!isset($_GET['financial_year'])) {
    if (isset($_GET['iuid']) && $_GET['iuid'] != '') {
        $fy = date('Y') . '-' . (date('Y') + 1);
        $financial_year = $fy;
    } else
        $financial_year = 'ALL';
}
?>


<style type="text/css">

    .dashboard-stat.yellow{ background-color: #F1C40F;    }
    .mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
    .mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons {
        margin-top: 14px;
    }

    @media (min-width: 700px){

        .col-lg-3 {

            width: 20%;

        }





    }

    .href_link:hover{

        color:#23527c;

    }

    .href_link1{

        color: #ffffff;

        font-size: 13px;

        font-family: "Open Sans",sans-serif;

        font-weight: 300;

        text-align: center;

        vertical-align: top;

        padding: 2px 5px;

    }        
    .movetoDashboard{
        cursor: pointer;
    }

</style>
<div id="content">
    <style type="text/css">
        .dataTables_wrapper .dt-buttons{
            margin-right: 18px;
        }
        .marquee_container { float:left; margin-right:195px; margin-left: 195px; margin-top: -45px;}
        .marquee_container p {  display:inline; margin-left:16px; color:red; font-size:14.5px; line-height:33px; text-indent:8px; padding:25px;}
        .date_container {color: #fff;float: right;height: 60px;position: absolute;right: 10px;text-align: right;width: 100px;z-index: 999;}
    </style>
    <script type="text/javascript">
        function updateClock( )
        {
            var currentTime = new Date( );
            var currentdate = currentTime.toDateString();
            var currentHours = currentTime.getHours( );
            var currentMinutes = currentTime.getMinutes( );
            var currentSeconds = currentTime.getSeconds( );
            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
            // Convert the hours component to 12-hour format if needed
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            // Convert an hours component of "0" to "12"
            currentHours = (currentHours == 0) ? 12 : currentHours;
            // Compose the string for display
            var currentTimeString = currentdate + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            $("#clock").html(currentTimeString);

        }

        function redirect_url()
        {
            window.location.href = "";
        }

    </script>

    <style>
        .portlet.box .dataTables_wrapper .dt-buttons {
            margin-top: -51px !important;
        }
    </style>


    <div class="site-min-height">

        <style>

            a:hover{color:blue;}
        </style>

        <style type="text/css">
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>



        <!-- BEGIN CONTENT BODY -->
        
<?php
session_start();

if (!empty($_GET['financial_year'])) {
    $fy = "financial_year/" . $_GET['financial_year'];
} else {
    $fy = "";
}

$typo = "" . $fy;
if (!empty(@$_SESSION['RESPONSE']['user_id'])) {
    $userID = @$_SESSION['RESPONSE']['user_id'];
} else if ($_SESSION['role_id'] == 2) {
    $userID = base64_decode($_GET['uid']);
    $typo = "uid/$_GET[uid]/iuid/$_GET[iuid]" . $fy;
} else {
    $userID = 0;
}
$urlI = "/backoffice/frontuser/home/serviceNew/" . $typo;
if (isset($_GET['iuid']))
    $iuid = base64_decode($_GET['iuid']);
?>

<?php //if(isset($_GET['type']) && $_GET['type'] != 'CAF'){ ?>
        <div class="portlet-body">
		<?php $cls="CAF";include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarService.php');?>
        </div>	
<?php
//}
?>






        <style type="text/css">
            .pd_child{ padding-left: 50px !important; }
        </style>
        <div class="portlet-body">












        </div>



    </div>
    <br>

    <div class="row" style="display:none;">
        <div class="portlet light bordered col-md-12" style="margin-bottom:0px !important;">

            <div class="portlet-body">
                <div class="col-md-6"><div class="col-md-6" style="text-align:right;margin-top: 7px;font-weight: bold;">Select Application Type</div> <div class="col-md-6"><select class="form-control"><option>Select Application Type</option></select></div></div>
                <div class="col-md-6"><div class="col-md-6" style="text-align:right;margin-top: 7px;font-weight: bold;">Select Status</div><div class="col-md-6"><select class="form-control"><option>Select Status</option></select></div>  </div>
            </div>
        </div>
    </div>
</div>
<div class="portlet-body">
    <div class="mt-element-step">


    </div>
</div>
<br>
<div class='portlet box green'>

    <div class="portlet-body">

<?php
$result = "listing" . $_GET['type'];
if ($_GET['type'] == "CAF") {
    $fileName = "Investor Monitoring Panel : Applications for In-Principle Approval (CAF)";
}
if ($_GET['type'] == "EU") {
    $fileName = "Investor Monitoring Panel : Applications for Registration of Existing Industries";
}
if ($_GET['type'] == "SERVICES") {
    $fileName = "Investor Monitoring Panel : Applications for Departmental Services";
}
if ($_GET['type'] == "QUERIES") {
    $fileName = "Investor Monitoring Panel : View Asked Questions";
}
if ($_GET['type'] == "TICKETS") {
    $fileName = "Investor Monitoring Panel : Tickets";
}
if ($_GET['type'] == "GRIEVANCE") {
    $fileName = "Investor Monitoring Panel : Grievance";
}
$this->renderPartial($result, array("financial_year" => $financial_year));
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


<style>

    .movetoDashboard{
        cursor: pointer;
    }
</style>

<script>
                                        // alert("==");
                                        $(document).ready(function () {
                                            // alert("==");
                                            $(".mt-step-col").css('cursor', 'pointer');
                                            $(".mt-step-col").click(function () {
                                                var relurl = $(this).attr("relurl");
                                                // alert(relurl);
                                                window.location.href = relurl;
                                            });
                                        });

</script>


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
                                orientation: 'landscape',
                                filename: '<?php echo $fileName . ".pdf"; ?>',
                                className: "btn default",

                                exportOptions: {
                                    columns: ':visible',
                                },
                                customize: function (win) {
                                    $(win.document.body).find('table').addClass('display').css('font-size', '10px');
                                    $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                                        $(this).css('background-color', '#D0D0D0');
                                    });
                                    $(win.document.body).find('h1').css('text-align', 'center');
                                    $(win.document.body).find('h1').css('font-size', '14');
                                    $(win.document.body).find('h1').css('background-color', '#fff');
                                    $(win.document.body).find('h1').html("<?php echo $fileName; ?>");
                                    $(win.document.body).css('background-color', '#fff');
                                }

                            }, {
                                extend: "pdf",
                                orientation: 'landscape',
                                    filename: '<?php echo $fileName . ".pdf"; ?>', 
                                className: "btn default"
                            }, {
                                extend: "excel",
                                   filename: '<?php echo $fileName . ".xls"; ?>',
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



    $(".alert-danger").css('display', 'none');
    $('.caption').css('padding-top', '10px');

</script>