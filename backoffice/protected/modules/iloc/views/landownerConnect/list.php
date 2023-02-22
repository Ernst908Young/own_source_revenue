<style>

    <?php
    // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {
            display: none !important;
        }
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;

        }
<?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE  ?>
</style>
<?php if (isset($_SESSION)){ ?>
<br><br>
			            <div class="page-bar">
			                <div class="col-md-8">
                    <ul class="page-breadcrumb">
                        <li>
                            <span class="pull-left"><a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a><b> <?php 
																if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) {
																	echo "Land Record for Sale/Lease";
																}
																elseif(isset($iuid) && $iuid != ''){																	
																	echo " Details of IUID - ".$iuid ;
																}else{
																	echo "Land Record for Sale/Lease";
																}?> 
                                </b></span> 
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/investorWalkthrough" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
                    </div>
				
		</div>	
<br><br>
<?php } ?>
<div class="portlet-body">
    <div class="tabbable tabbable-tabdrop">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1" data-toggle="tab">List Available Land </a>
            </li>
            <li>
                <a href="#tab2" data-toggle="tab">List Requirement </a>
            </li>
            <li>
                <a href="#tab3" data-toggle="tab">Land Summary </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">

                <div class='portlet box green'>
                    <div class='portlet-title'>
                        <div class='caption'>
                            <i style=" font-size:20px;" class='fa fa-list'></i>Land Record for Sale/Lease</div>
                        <div class='tools'> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2" >
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Published by</th>
                                    <th>District</th>                                    
                                    <th>Type of Land</th>
                                    <th>Land Area (in sq.mtrs)</th>
                                    <th>Address</th>
                                    <th>Owner Name</th>
                                    <th>Available on</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nanital_area = 0;
                                                    $nanital_count =0;
                                            
                                              
                                                    $Haridwar_area = 0;
                                                    $Haridwar_count = 0;
                                            
                                              
                                                    $Dehradun_area =0;
                                                    $Dehradun_count = 0;
                                            
                                              
                                                    $udham_area = 0;
                                                    $udham_count = 0;;
                                            
                                              
                                                    $Chamoli_area = 0;
                                                    $Chamoli_count = 0;
                                            
                                              
                                                    $Rudraprayag_area = 0;
                                                    $Rudraprayag_count = 0;
                                            
                                              
                                                    $Almora_area = 0;
                                                    $Almora_count = 0;;
                                            
                                              
                                                    $Tehri_area = 0;
                                                    $Tehri_count = 0;
                                            
                                             
                                                    $Pauri_area = 0;
                                                    $Pauri_count = 0;
                                            
                                             
                                                    $Bageshwar_area =0;
                                                    $Bageshwar_count =0;
                                            
                                             
                                                    $Pithoragarh_area = 0;
                                                    $Pithoragarh_count = 0;
                                            
                                             
                                                    $Champawat_area = 0;
                                                    $Champawat_count = 0;
                                            
                                             
                                                    $Uttarkashi_area = 0;
                                                    $Uttarkashi_count = 0;
                                //echo '<pre>';print_r($dataProvider); die;
                                $district = array();
                                if (empty($dataProvider)) {
                                    echo "<tr><td colspan='5'>No applications</td></tr>";
                                } else {
                                    $count = 1;
                                    foreach ($dataProvider as $key=>$act) {
                                       // echo '<pre>';print_r($act); die;
                                        ?>
                                        <tr>
                                            <td ><?= $count++; ?></td>
                                           
                                            <td><?php if($act['la_type']=='Pvt') echo 'Private'; 
                                            if($act['la_type']=='Gov') echo 'Government'; ?></td>
                                            <td><?php echo $act['distric_name'] ?></td>
                                            <td><?php echo $act['type_of_land'] ?></td>
                                            <td><?php if($act['area_type']=='Sq. m') {
                                                echo $act['area_sqmt'];
                                                $area1 = $act['area_sqmt'];                          
                                               
                                            }
                                            else{
                                                if($act['area_sqmt'] > 0){
                                                $nw =  LandownerConnectEXT::getLandUnitConversion($act['area_sqmt'],$act['area_type']);
                                                echo $nw;
                                                $area1 = $nw;
                                                }
                                            } 
                                            if($area1!=0){
                                                
                                                $count = 1;
                                             if(($act['distric_name']) == 'Nainital'){
                                                    $nanital_area = $nanital_area +$area1;
                                                    $nanital_count = $nanital_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Haridwar'){
                                                    $Haridwar_area = $Haridwar_area +$area1;
                                                    $Haridwar_count = $Haridwar_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Dehradun'){
                                                    $Dehradun_area = $Dehradun_area +$area1;
                                                    $Dehradun_count = $Dehradun_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Udham Singh Nagar'){
                                                    $udham_area = $udham_area +$area1;
                                                    $udham_count = $udham_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Chamoli'){
                                                    $Chamoli_area = $Chamoli_area +$area1;
                                                    $Chamoli_count = $Chamoli_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Rudraprayag'){
                                                    $Rudraprayag_area = $Rudraprayag_area +$area1;
                                                    $Rudraprayag_count = $Rudraprayag_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Almora'){
                                                    $Almora_area = $Almora_area +$area1;
                                                    $Almora_count = $Almora_count +$count;
                                            }
                                             if(($act['distric_name']) == 'Tehri'){
                                                    $Tehri_area = $Tehri_area +$area1;
                                                    $Tehri_count = $Tehri_count +$count;
                                            }
                                            if(($act['distric_name']) == 'Pauri'){
                                                    $Pauri_area = $Pauri_area +$area1;
                                                    $Pauri_count = $Pauri_count +$count;
                                            }
                                            if(($act['distric_name']) == 'Bageshwar'){
                                                    $Bageshwar_area = $Bageshwar_area +$area1;
                                                    $Bageshwar_count = $Bageshwar_count +$count;
                                            }
                                            if(($act['distric_name']) == 'Pithoragarh'){
                                                    $Pithoragarh_area = $Pithoragarh_area +$area1;
                                                    $Pithoragarh_count = $nanital_count +$count;
                                            }
                                            if(($act['distric_name']) == 'Champawat'){
                                                    $Champawat_area = $Champawat_area +$area1;
                                                    $Champawat_count = $Champawat_count +$count;
                                            }
                                            if(($act['distric_name']) == 'Uttarkashi'){
                                                    $Uttarkashi_area = $Uttarkashi_area +$area1;
                                                    $Uttarkashi_count = $Uttarkashi_count +$count;
                                            }
                                             }
                                           ?></td>
                                             <td><?php echo $act['address'] ?></td>
                                              <td><?php if($act['owner_name'] != '') echo $act['owner_name'];
                                                        else{
                                                           echo $act['first_name'].' '.$act['last_name'];; 
                                                        }
                                              
                                              
                                              ?></td>
                                              <td ><?php if (!empty($act['is_sale']) && $act['is_sale'] == 1) {
                                    echo 'Sell';
                                } if ($act['is_sale'] == 1 && $act['is_lease'] == 1) {
                                    echo ' , ';
                                }
                                if (!empty($act['is_lease']) && $act['is_lease'] == 1) {
                                    echo 'Lease';
                                }
                                ?></td>
                                            
                                           
                                        </tr>
        <?php
    }
}
?>

                            </tbody>

                        </table>

                    </div>
                </div>


            </div>

            <div class="tab-pane" id="tab2">
                <div class="row">
                    
                </div>
                <div class='portlet box green'>
                    <div class='portlet-title'>
                        <div class='caption'>
                            <i style=" font-size:20px;" class='fa fa-list'></i>Land Requirement</div>
                        <div class='tools'> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3" >
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name/Email/Mobile</th>
                                    <th>Type of Land</th>
                                    <th>Area</th>
                                    <th>Sell/Lease</th>
                                    <th>District</th>
                                    <th>Village</th>
                                    <th>Comment</th>
                                    
                                  
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                //print_r($dataProvider); die;
                                if (empty($dataProvider_r)) {
                                    echo "<tr>"
                                    . "<td>No applications</td>"
                                            . "<td></td>"
                                            . "<td></td>"
                                            . "<td></td>"
                                            . "<td></td>"
                                            . "<td></td>"
                                            . "<td></td>"
                                            . "</tr>";
                                } else {
                                    $count = 1;
                                    foreach ($dataProvider_r as $key => $act) {
                                        ?>
                                        <tr>
                                            <td ><?= $count++; ?></td>
                                            <td ><?php echo 'Name-'.$act['first_name'].' '.$act['last_name'].'<br>Email ID-'.$act['email'].'<br> Mobile No.-'.$act['mobile_number']; ?></td>
                                            <td ><?php echo $act['type_of_land']; ?></td>
                                            <td><?php if(($act['area_type']=='Sq. m')|| ($act['area_type']=='Sq Mtr')) {
                                                echo $act['area_sqmt'];
                                            }
                                            else{
                                                if($act['area_sqmt'] > 0){
                                                $nw =  LandownerConnectEXT::getLandUnitConversion($act['area_sqmt'],$act['area_type']);
                                                echo $nw;
                                                }
                                            } 
                                           ?></td>
                                            <td><?php if (!empty($act['is_sale']) && $act['is_sale'] == 1) {
                                            echo 'Sell';
                                        } if ($act['is_sale'] == 1 && $act['is_lease'] == 1) {
                                            echo ' , ';
                                        }
                                        if (!empty($act['is_lease']) && $act['is_lease'] == 1) {
                                            echo 'Lease';
                                        }
                                        ?></td>
                                            <td><?php echo $allList = LandownerConnectEXT::getMasterName('bo_district', $act['district_id'], 'distric_name', 'district_id'); ?></td>


                                                <?php /* Author:Pankaj Kumar Tiwari
                                                  Date:16Feb2018 */ ?>
                                            <td>
                                            <?php
                                            if (isset($act['village']) && !empty($act['village'])) {

                                                $village = LandownerConnectEXT::getMasterName('lg_code_villages', $act['village'], 'village_name', 'village_code');
                                            } else {

                                                $village = '';
                                            } echo $village;
                                            ?> 
                                            </td>
                                            <td><?php echo $act['comment'];?></td>

        <?php /* ------------------------------------------ */ ?>

                                            
                                            
                                        </tr>
        <?php
    }
}
?>

                            </tbody>

                        </table>

                    </div>
                </div>






            </div>
            
            <div class="tab-pane" id="tab3">
                <div class="row">
                    
                </div>
                <div class='portlet box green'>
                    <div class='portlet-title'>
                        <div class='caption'>
                            <i style=" font-size:20px;" class='fa fa-list'></i>Land Summary</div>
                        <div class='tools'> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3" >
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Land Count</th>
                                    <th>Area (in sq.mtrs)</th>

                                    
                                  
                                </tr>
                            </thead>
                            <tbody>
                                 <tr><td > Nanital<td ><?= $nanital_count; ?></td> <td ><?= $nanital_area; ?></td></tr>
                                 <tr><td >Haridwar</td> <td ><?= $Haridwar_count++; ?></td> <td ><?= $Haridwar_area; ?></td></tr>
                                 <tr><td >Dehradun</td> <td ><?= $Dehradun_count++; ?></td> <td ><?= $Dehradun_area++; ?></td></tr>
                                 <tr><td >Udham Singh Nagar</td> <td ><?= $udham_count++; ?></td> <td ><?= $udham_area++; ?></td></tr>
                                 <tr><td >Chamoli</td> <td ><?= $Chamoli_count++; ?></td> <td ><?= $Chamoli_area++; ?></td></tr>
                                 <tr><td >Rudraprayag</td> <td ><?= $Rudraprayag_count++; ?></td> <td ><?= $Rudraprayag_area++; ?></td></tr>
                                 <tr><td >Almora</td> <td ><?= $Almora_count++; ?></td> <td ><?= $Almora_area++; ?></td></tr>
                                 <tr><td >Tehri</td> <td ><?= $Tehri_count++; ?></td> <td ><?= $Tehri_area++; ?></td></tr>
                                 <tr><td >Pauri</td> <td ><?= $Pauri_count++; ?></td> <td ><?= $Pauri_area++; ?></td></tr>
                                 <tr><td >Bageshwar</td> <td ><?= $Bageshwar_count++; ?></td> <td ><?= $Bageshwar_area++; ?></td></tr>
                                 <tr><td >Pithohragarh</td> <td ><?= $Pithoragarh_count++; ?></td> <td ><?= $Pithoragarh_area++; ?></td></tr>
                                 <tr><td> Champawat</td> <td ><?= $Champawat_count++; ?></td><td ><?=  $Champawat_area;?></td></tr>
                                 <tr><td >Uttarkashi</td> <td ><?= $Uttarkashi_count++; ?></td> <td ><?= $Uttarkashi_area++; ?></td></tr>
                                 </tbody>

                        </table></div></div></div>
        </div>
    </div></div>




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
                        var e = $("#sample_3");
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
