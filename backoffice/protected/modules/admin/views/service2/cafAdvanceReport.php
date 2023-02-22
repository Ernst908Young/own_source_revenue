<?php
/* Rahul Kumar : 13072018 */
//print_r($serviceData);die; 
$base = Yii::app()->theme->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl;
// Making Status Array
$statusArray = array('A' => 'Approved', 'P' => 'Pending', 'F' => 'Forwarded', 'I' => 'Incomplete', 'RBI' => 'Reverted', 'R' => 'Rejected', 'O' => 'Rejected');
/* $selectedDepartment = explode(",", $departmentList);
$selectedServices = explode(",", $serviceList);
$selectedStatus = explode(",", $statusList); */
?>
<style>
    #filterDiv{display:none;}
    #loaderDiv{display:block;}
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
    .input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn, .input-lg {
        height: 42px;   
    }

</style>

<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/css/bootstrap-datepicker3.css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<div class='portlet box ' id="loaderDiv">    
    <div class="portlet-body" >
    Filters are getting enabled
<img width = "100px" height="100px" src = "/backoffice/themes/swcsNewTheme/img/straight-loader.gif">
</div>
</div>
<div class='portlet box ' id="filterDiv">    
    <div class="portlet-body" >
        <form method="POST">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-6">
                        <!--<label class="col-md-3 control-label">Select Date Range</label>-->
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="date" checked="checked" class="date_range"> Date Range
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios26" value="fy"  class="date_range"> Financial Year
                                <span></span>
                            </label>							
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <span id="dept">
                            <label>Select Date Range</label>                  
                            <div class="input-daterange input-group demo-3" id="datepicker">
                                <input type="text" class="input-lg form-control" name="start" autocomplete="off" value="<?php echo @$start;?>" />
                                <span class="input-group-addon input-lg">to</span>
                                <input type="text" class="input-lg form-control" name="end" autocomplete="off" value="<?php echo @$end;?>"/>
                            </div>
                        </span>

                        <span id="fy_year" style="display:none;">

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
                                <?php
                                if (isset($fy) && $fy == "ALL") {
                                    echo "selected='selected'";
                                }
                                ?> >ALL
                                </option>
                                <?php
                                for ($i = $pp; $i <= $yyy + 1; $i++) {
                                    $j = $i + 1;
                                    $k = $i . '-' . $j;
                                    $kv = $i . '-04-01:' . $j . '-03-31';
                                    ?>
                                    <option value="<?php echo $kv; ?>" 
                                    <?php
                                    if (isset($fy) && $fy == $kv) {
                                        echo "selected='selected'";
                                    }
                                    ?>>
                                                <?php echo $k; ?>
                                    </option>
                                <?php }
                                ?>           
                            </select>

                        </span>
                    </div>
                    <div class="col-md-6">
                        <label>Select District</label>
                        <select name="district[]" class="select2-me"  multiple="multiple"  id="district">
                            <option value="">All District</option>
                           <?php foreach($districtList as $key=>$val){ ?>
							<option value="<?php echo $val['district_id'];?>"><?php echo $val['distric_name'];?></option>
						   <?php }?>
                        </select>                    
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Type of Unit</label>
                        <select class="select2-me" multiple="multiple" name="unit[]" id="unit">
                            <option value="">--Select Unit--</option>
                            <option value="manufacturing">Manufacturing</option>
                            <option value="services">Services</option>
                        </select>
                    </div>
                    <?php //print_r($allList);die;  ?>
                    <div class="col-md-6">
                        <label>Nic Codes</label>
                        <select class="select2-me" multiple="multiple" name="nic_code[]" id="nic_code">
							<option value="">--Select Nic Codes--</option>
							<?php
							$sql = "select II_DIGIT_Code,Description from NIC_II_DIGIT";
							$allNicList = Yii::app()->db->createCommand($sql)->queryAll();
							?>
							<?php foreach($allNicList as $k => $v) { ?>
							<option value="<?php echo $v['II_DIGIT_Code']; ?>">
							<?php echo $v['II_DIGIT_Code'].'-'.$v['Description']; ?>
							</option>  
							<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Industry Type</label>
                        <select class="select2-me" name="industry_type" id="industry_type"> 
							<option value="" >Select Industry Type</option>
                            <option value="micro">Micro</option>                           
                            <option value="medium">Medium</option>                           
                            <option value="small">Small</option>                           
                            <option value="large">Large</option>                           
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Select Timeline</label>
                        <select class="select2-me" name="timeline" id="timeline">    
                            <option value="" >All </option>
                            <option value="TA"  <?php if(isset($timeline) && $timeline=='TA'){ echo "selected"; }?> >TA</option>
                            <option value="TV" <?php if(isset($timeline) && $timeline=='TV'){ echo "selected"; }?> >TV</option>   
                        </select>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Application Number</label>
                        <input class="form-control" placeholder="Application Number" name="applicationNumber" <?php if (!empty($applicationNumber)) { ?> value="<?php echo $applicationNumber; ?>" <?php } ?>>
                    </div>
                    <div class="col-md-6">
                        <label>Unit Name</label>
                        <input class="form-control" placeholder="Unit Name" name="unitName" <?php if (!empty($unitName)) { ?> value="<?php echo $unitName; ?>" <?php } ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:15px;">
                    <input type="submit" value="Submit" class="btn btn-success" >
                    <input type="button" value="Reset" onClick="window.location.reload()" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>All Applied Services by Investor > Total Applied Services : <?php //echo count($serviceData); ?>   </div>
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
                        <th>Applied Service <br/> Detail</th>
                        <th>Incidence</th>
                        <th>Timeline <br/>(in days)</th>
                        <th>Unit Detail</th>                        
                        <th>Status at</th>
                        <th>Timeline<br/>Adhered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($serviceData as $key => $serviceDetail) { ?>
                    
                    <?php //echo '<pre>'; print_r($serviceDetail); ?>
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
							<td>
								<?php echo $getIncedence = Service2Controller::getServiceIncendence($serviceDetail['sp_app_id']);?>
							</td>
							<td>
                            <?php 
                            $applied_date = $serviceDetail['Application Date'];
                            $sql = "SELECT timeline_type_service,timeline_type_service_value from bo_infowizard_service_timeline_new "
                                    . "where core_service_id = $serviceDetail[sp_app_id] and from_date < '".$applied_date."' order by from_date desc limit 1 ";
                            
                            $tline = Yii::app()->db->createCommand($sql)->queryAll();
                            
                            
                            ?>
                            <c title="TimeLine"> <?php echo @$tline[0]['timeline_type_service_value'].' '.@$tline[0]['timeline_type_service']; ?></c>
							</td>
							<td><c title="Unit Name"> <?php echo @$serviceDetail['Unit Name']; ?></c>
							</br><c title="Unit Location"><?php echo @$serviceDetail['Unit Location']; ?></c>
							<b><c title="Unit District"><?php echo @$serviceDetail['Unit District']; ?></c></b>
							<br/><br/>
							<span><b>Investor Detail:</b></span>
							<?php echo @$serviceDetail['Investor Name']; ?>
                            </br><?php echo @$serviceDetail['Investor Email']; ?>
                            </br><?php echo @$serviceDetail['Investor Mobile Number']; ?>
							</td>							
							<td><b><?php
                                $status = $serviceDetail['Status'];
                                echo $statusArray[$status];
                                ?> </b>
                            <br><?php echo @$serviceDetail['Last Updated']; ?>
							</td>
							<td></td>
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


<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/js/bootstrap-datepicker.js"></script>
<script>
                        $('.demo-3').datepicker();
</script>


<script type="text/javascript">
    $(document).ready(function () {
// Show hide Date Range / FY
        $(".date_range").on('click', function () {
            var id_val = $(this).val();
            if (id_val == "date")
            {
                $("#dept").show();
                $("#fy_year").hide();
            } else {
                $("#fy_year").show();
                $("#dept").hide();
            }
        });
        // Show nic code on change Department
        $("#unit").on('change', function () {           
            $.ajax({
                type: 'POST',
                url: '/backoffice/admin/service2/GetNicCodesByUnit',
                data: 'unit=' + encodeURIComponent($(this).val()),
                dataType: 'html'
            })
			.done(function (data) {
				$("#nic_code").html(data);
			})
			.fail(function (data) {
				alert("Something went wrong please try again.");
			})
        });
    });   
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
    
    $(window).load(function(){
       $("#filterDiv").css('display','block'); 
       $("#loaderDiv").css('display','none'); 
    });
</script>