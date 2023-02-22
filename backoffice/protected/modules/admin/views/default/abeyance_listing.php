<style type="text/css">
    .portlet.box .dataTables_wrapper .dt-buttons {
        margin-top: -53px !important;
        padding-right: 19px;
    }
</style>
<?php
/* echo "<pre>";
  print_r($_SESSION);die; */
$role_id = $_SESSION['role_id'];
$disctrict_id = $_SESSION['district_id'];
$depart_user_id = $_SESSION['uid'];

$resArr = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,form_type_id FROM bo_infowiz_form_builder_configuration where current_role_id=$role_id order by id DESC")->queryAll();


$res = array();
// Abeyance Listing
$sql = "SELECT *,
        bo_infowizard_issuerby_master.name AS DepartmentName, 
        bo_information_wizard_service_parameters.core_service_name ,
        bo_district.distric_name as District 
        FROM bo_new_application_submission 
        INNER JOIN bo_infowiz_form_builder_configuration 
        on bo_infowiz_form_builder_configuration.service_id=bo_new_application_submission.service_id 
        	INNER JOIN bo_district 
		ON bo_district.district_id=bo_new_application_submission.landrigion_id 
		INNER JOIN bo_information_wizard_service_parameters on 
                bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
		INNER JOIN bo_information_wizard_service_master  
                on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
		INNER JOIN bo_infowizard_issuerby_master  
                ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
                where bo_new_application_submission.application_status ='AB' 
        AND bo_new_application_submission.processing_level=bo_infowiz_form_builder_configuration.processing_level 
        AND bo_infowiz_form_builder_configuration.current_role_id=$role_id 
        AND bo_infowiz_form_builder_configuration.can_revert_to_investor='Y'
        AND bo_new_application_submission.landrigion_id='$disctrict_id'
        AND bo_information_wizard_service_parameters.is_active='Y'";
//echo $sql;die; 
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$res = $command->queryAll();
/* echo "<pre>";
print_r($res);die; */
?>
<style>
    .a_cent{
        text-align:center;
        vertical-align:middle !important;
    }
    .l_cent{
        text-align:left;
        vertical-align:middle !important;
    }
</style> 
<?php  $appsModel = new ApplicationVerificationLevelExt;
$AbeyanceApps  = $appsModel->getAbeyanceApplications($_SESSION['uid']); ?>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-users'></i><span class="caption-subject bold uppercase">Abeyance Applications (<?php echo count($res)+count($AbeyanceApps); ?>)</Z></div>
        <div class='tools'> 
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a></div>
    </div>
    <div class="portlet-body">
        <table class='table table-striped table-bordered' id='sample_4'>
            <thead>
                <tr>
                    <th  class="a_cent" style="width:5%">S .No.</th>
                    <th  class="a_cent" style="width:5%" >Application <br/>ID</th>			
                    <th  class="a_cent" style="width:10%">Department <br/>Name</th>
                    <th  class="a_cent" style="width:20%">Service Name</th>			
                    <th  class="a_cent" style="width:10%">Name of Unit</th> 
                    <th  class="a_cent" style="width:10%">District</th>
                    <th  class="a_cent" style="width:10%">Application <br/>Status</th>
                    <th  class="a_cent" style="width:5%">Applied <br/>On</th>
                    <th  class="a_cent" style="width:10%">Action</th>
                </tr>	
            </thead>
            <?php $statusArray = array('A' => 'Approved', 'B' => 'Pending For Payment', 'H' => 'Reverted', 'I' => 'Incomplete', 'R' => 'Rejected', 'F' => 'Forwarded', 'Z' => 'Archived', 'P' => 'Pending', 'AB' => 'Abeyance') ?>
            <?php
			$key = 0;
            if (!empty($res)) {

                foreach ($res as $key => $val) {
                    $status = $val['application_status'];
                    $formtype_id = @$formTypeArr[$val['service_id']];
                    $fieldData = json_decode($val['field_value']);
                    //$ukd='UK-FCL-00146_0';
					
					$subService_id = $val['servicetype_additionalsubservice'];
                    ?>      <tr>
                        <td class="a_cent"><?php echo $key=$key + 1; ?></td>
                        <td class="a_cent" title="<?php echo $val['service_id'] ?>"> <?php echo $val['submission_id'] ?></td>				
                        <td class="l_cent"><?php echo $val['DepartmentName'] ?></td>
                        <td class="l_cent"><?php echo $val['core_service_name'] ?></td>
                        <td class="l_cent"><?php echo $val['unit_name'] ?></td>
                        <td class="a_cent"><?php echo $val['District'] ?></td>
                        <td class="a_cent"><?php echo @$statusArray[$status] ?></td>
                        <td class="a_cent"><?php echo date('d-m-Y H:i:s', strtotime($val['created'])); ?></td>		
                        <td>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/departmentFormView/service_id/" . $val['service_id'].'.'.$subService_id. "/pageID/1/subID/" . $val['submission_id'] . "/formCodeID/" . $val['form_type_id']); ?>">View Application</a>
                            <br/><br/>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/applicationTimeline/subID/" . base64_encode($val['submission_id']) . ""); ?>">View Timeline</a>
                        </td>		
                    </tr>


                    <?php
				}
			} 	
// abeyance old  
              //  $key = $key + 1;
                $deptModel = new DepartmentsExt;
                $dept = $deptModel->getDeptbyId($_SESSION['dept_id']);
 
                if (!empty($AbeyanceApps)) {
                    foreach ($AbeyanceApps as $ab) {
                        $dataAb = (array) json_decode($ab['field_value']);
                        //  print_r($dataAb);die; 
                        ?>
                        <tr>
                            <td class="a_cent"><?php echo $key = $key + 1; ?></td>
                            <td class="a_cent" title=""> <?php echo $ab['submission_id'] ?></td>
                            <td class="l_cent"><?php echo @$dept['department_name']; ?></td>
                            <td class="l_cent"><?php echo "Application for In-principle Approval"; ?></td>
                            <td class="l_cent"><?php echo @$dataAb['company_name'] ?></td>
                            <td class="a_cent"><?php echo $ab['District'] ?></td>
                            <td class="a_cent"><?php echo "Abeyance"; ?></td>
                            <td class="a_cent"><?php echo date('d-m-Y H:i:s', strtotime($ab['application_created_date'])); ?></td>		
                            <td>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/applicationView/viewForwardApplication/application_sub_id/' . $ab['app_sub_id']); ?>">View Application</a>
                                <br/>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/applicationView/viewForwardApplication/application_sub_id/' . $ab['app_sub_id']); ?>">View Timeline</a>
                            </td>		
                        </tr> 
                    <?php
                    }
                }
            
            ?>

        </table>	
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

            var e = $("#sample_5");

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
                        className: "btn white btn-outline"

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
                t = function () {

                    var e = $("#sample_4");

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

                    var e = $("#sample_6"),
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
                                    // [0, "asc"]

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
                        onSuccess: function (e, t) {
                        },
                        onError: function (e) {
                        },
                        onDataLoad: function (e) {
                        },
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
        // TableDatatablesButtons.init();
    });

</script>