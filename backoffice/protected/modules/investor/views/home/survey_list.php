
<style>
    .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -51px !important;
}
.header{
    background-color: #aedfe4;
}
    
</style><div class="row">

</div>





<div class='portlet box green'>

<div class='portlet-title'>

    <div class='caption'>

        <i style=" font-size:20px;" class='fa fa-list'></i>List of Survey</div>

    <div class='tools'> </div>

</div>

 <div class="portlet-body">

          <table class="table table-striped table-bordered table-hover" id="sample_2" >

              <thead class="header">
                        <tr>
                            <th>S. No.</th>
                            <th>Title</th>
                            <th>Name & Mob & Email</th>          
                            <th>Submited By</th>
                            <th>Rating</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count=1;
                        foreach ($survey_list as $getdata) {
                            $sql = "SELECT * from bo_survey where survey_id=:survey_id";
                            $connection = Yii::app()->db;
                            $command = $connection->createCommand($sql);
                            $command->bindParam(":survey_id", $getdata['survey_id'], PDO::PARAM_INT);
                            $survey_list = $command->queryRow();
                            
                           ?>
                           <tr>
                               <td><?= $count ?></td>
                               <td><?= $survey_list['title'] ?></td>

                               <td>Name : <?= empty($getdata['full_name'])? 'anonymous' : $getdata['full_name'] ?><br>
                                   Email : <?= empty($getdata['email'])? '--' : $getdata['email'] ?><br>
                                   Mobile : <?= empty($getdata['mobile'])? '--' : $getdata['mobile'] ?>
                               </td>
                               <td><?= empty($getdata['submitted_by'])? 'anonymous':$getdata['submitted_by'] ?></td>

                               <td><?= $getdata['over_all_rating'] ?></td>
                               <td><?= date("d-m-Y", strtotime($getdata['created_date'])) ?></td>
                               <td><a target="_blank" href="/backoffice/survey/SurveyReport/printsurveyapplicantwise/subid/<?= $getdata['survey_id'] ?>">View Servey </a></td>
                           </tr>

                        <?php
                        $count++;
                        }
                        ?>
                    </tbody>



        </table>

        

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









</script>