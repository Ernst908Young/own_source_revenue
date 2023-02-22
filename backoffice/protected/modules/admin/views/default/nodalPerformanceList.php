<?php 
include("/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarStateMonitering.php");
?>
    <?php $base = Yii::app()->theme->baseUrl; ?>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'  style="margin-bottom: 16px;">
            <i style=" font-size:18px;" class='fa fa-list'>
                Selected Financial Year District Application Submitted
            </i>
        </div>
        <div class='tools'> 
        </div>
    </div>

    <div class="portlet-body">
      <table class="table table-striped table-bordered table-hover" id="sample_2">
            <thead>
                <tr>
                    <th style='vertical-align: middle;text-align: center;'>SNo</th>
                    <th style='vertical-align: middle;text-align: center;'>District</th>
                    <th style='vertical-align: middle;text-align: center;'>CAF Submitted<br> By & On </th>
                    <th width = "15%" style='vertical-align: middle;text-align: center;'>Overall<br> Status </th>
                    <th style='vertical-align: middle;text-align: center;'>Forwarded<br/>to Dept.</th>
                    <th style='vertical-align: middle;text-align: center;'>Departmental<br>Status </th>
                    <th  style='vertical-align: middle;text-align: center;'>Aging</th>
                    <th  style='vertical-align: middle;text-align: center;'>Comment</th>
                    <th  style='vertical-align: middle;text-align: center;'>Track</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$count=0; 
				$allsub=array();
				$srn=1;    
				/* echo "<pre>";
print_r($applicationData);die();	 */			
                if(isset($applicationData) && !empty($applicationData)) {
                    foreach ($applicationData as $key => $dept) {
                       
						$cafindname = ApplicationExt::getIndustryNamefromCAF($dept['submission_id']);
						$url1 = Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id');
						$urlNew =Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/');
						$sql = "SELECT * FROM `bo_application_verification_level` WHERE next_role_id = 7 AND approval_user_comment IS NULL AND app_Sub_id='$dept[submission_id]'";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$pendingAtNodal = $command->queryRow();

						$sql = "SELECT * FROM `bo_application_verification_level` WHERE next_role_id = 33 AND approval_user_comment IS NULL AND app_Sub_id='$dept[submission_id]'";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$pendingAtApprover = $command->queryRow();

						$sql="SELECT * FROM `bo_application_forward_level` WHERE next_role_id = 3 AND app_Sub_id='$dept[submission_id]' AND forwarded_dept_id=$dept[dept_id] AND comment_date!=''";
						$connection=Yii::app()->db;
						$command=$connection->createCommand($sql);
						$count1=$command->queryAll();
						
						$count11=count($count1);
						
						$subID=$dept['submission_id'];
						$fdshj[$subID]=@$fdshj[$subID]+1;
						
		echo "<tr>";
				?>
          <?php   $gh[$subID]=@$gh[$subID]+1; // echo $gh[$subID];
                 if(!in_array($dept['submission_id'], $allsub)){ //echo $dept['submission_id']."===".$count11;
                  $allsub[]=$dept['submission_id']; 
                 ?>
                  <td style="font-size: 13px; vertical-align: middle; text-align: center;"> <?php echo count($fdshj); if($count11>1){echo ".".$fdshj[$subID];} if($count11==1){echo ".0";} ?></td>
                <?php }else{ ?>
                    <td style="font-size: 13px; vertical-align: middle; text-align: center;"> <?php echo count($fdshj); echo ".".$fdshj[$subID]; ?></td>
              <?php  } ?>
                    <td style="font-size: 13px; vertical-align: middle; text-align: center;" width="1%">
                    <?php 
				if(isset($dept['landrigion_id']) && !empty($dept['landrigion_id'])){
                    $sql = "SELECT distric_name from bo_district where district_id=$dept[landrigion_id]";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $dname = $command->queryRow();
                    echo $dname['distric_name'];
					}else{
					echo "";}
                    ?>
                    </td>

                    <td style="font-size: 13px; vertical-align: middle; text-align: left;" width="18%">
                    <?php echo $cafindname ?>
                        <hr style="margin:2px;">
                        CAF ID:  <!--<a target='_balnk' class='hyplink' href=<?php //echo $url1 . '/' . $dept['submission_id'] . '/name/CAF' ?>>-->
						<a target="_blank" class='hyplink' href="<?php echo $urlNew.'/'. base64_encode($dept['submission_id']); ?>">
                    <?php echo $dept['submission_id'] ?> </a>
                             <hr style="margin:2px;">
                        <?php
						$sql = "SELECT * FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='ISA'";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$flowLogs = $command->queryRow();
						if(!empty($flowLogs)){
							echo date('d M y H:i:s',strtotime($flowLogs['created_date_time']));
						}else{
							$sql = "SELECT * FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='F' ORDER BY created_date_time ASC ";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$flowLogs = $command->queryRow(); 
							if(!empty($flowLogs))
							echo date('d M y H:i:s',strtotime($flowLogs['created_date_time']));
						}
                    ?>
                    </td>

                    <?php  $lastFinalAction=date('d M y H:i:s',strtotime($dept['application_updated_date_time']));
                    echo

                    $appstatus = "";

                    //if ($dept['application_status'] == "F" && $dept['verifier_user_comment'] == "") {
					if ($dept['application_status'] == "F") {
                        $apps = "PAD"; // Pending at department
                    } else if ($dept['application_status'] == "F") {
                        $apps = "DBD"; // Disposed by department
                    } else {
                        $apps = $dept['application_status'];
                    }
                    if (!empty($pendingAtNodal)) {
                        $apps = "P"; // Pending at Nodal
                    }
                    if (!empty($pendingAtApprover)) {
                        $apps = "PAA"; // Pending at Approver
                    }
                    switch ($apps) {
                        case "A":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Approved <hr style='margin:2px;'>$lastFinalAction</span></td>";
                            break;
                        case "B":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Payment</span></td>";
                            break;
                        case "P":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span> Pending with <br>Nodal Officer </br></span></td>";
                            break;
                        case "DBD":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span> Disposed by<br>Department</span></td>";
                            break;
                        case "I":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Incomplete  <hr style='margin:2px;'> $lastFinalAction</span></td>";
                            break;
                        case "H":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Reverted Back to Investor <hr style='margin:2px;'> $lastFinalAction</span></td>";
                            break;
                        case "R":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Rejected  <hr style='margin:2px;'> $lastFinalAction</span></td>";
                            break;
                        case "PAD":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with <br>Department</span></td>";
                            break;
                        case "PAA":
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with Approver(DoI)  <hr style='margin:2px;'> $lastFinalAction</span></td>";
                            break;
                        default:
                            echo "<td style='vertical-align: middle;text-align: center;'> <span>  Status Not <br>Available</span></td>";
                    }
                    ?>
                     <td style="font-size: 13px; vertical-align: middle; text-align: center;" width="13%">                
                        <?php //echo $dept['department_name']."<hr style='margin:2px'>".date('d M y H:i:s',strtotime($dept['created_on'])); 
						echo "<hr style='margin:2px'>".date('d M y H:i:s',strtotime($dept['created_on']));
						?>
                    </td>
                    <td style='vertical-align: middle;text-align: center;'>
                        <?php if ($dept['approv_status'] == "P") { ?><span class='label label-danger'>Pending</span><?php $dept['comment_date_time']=date('Y-m-d H:i:s');} else { ?><span>Disposed <?php echo " <hr style='margin:2px;'>". date('d M y H:i:s',strtotime($dept['comment_date_time'])); ?></span> <?php } ?>
					</td>
              
                   <td style="vertical-align: middle; text-align: center;">
						<!--<?php                        
						$timeInString = abs(strtotime($dept['comment_date_time']) - strtotime($dept['created_on']));
						$years = floor($timeInString / (365 * 60 * 60 * 24));
						$months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
						$days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
						$hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
						$minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
						$seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
						$allDays = ($months * 30) + $days;
						echo "$allDays days, $hours hrs, $minuts min";
                                                
					   
						?>-->
                    </td>
                    <td style="font-size: 13px; vertical-align: middle; text-align: left;" width="45%"> 
						<?php echo @$dept['approval_user_comment'];?>
					</td>
                    <td style="font-size: 13px; vertical-align: middle; text-align: center;">
                        <a target='_BLANK' href="<?= Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/' . base64_encode($dept['submission_id'])) ?>" class='btn dark btn-sm btn-outline sbold uppercase'>
                            <i class='fa fa-share'></i> View </a>
                    </td>
                    </tr>
						<?php
						$count++;
					}
				}
				?>
            </tbody>
        </table>
    </div>
</div>
</div>

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

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

     
<?php 
$sql = "SELECT department_name FROM bo_departments where dept_id=".$applicationData[0]['dept_id'];
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$deptData = $command->queryRow();
$printTitle="All Department : District Level Disposed CAF With Comment : FY - ".@$_GET['bw'];

?>
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
                                orientation: 'landscape',
                                 filename: '<?php echo $printTitle; ?>',
                                className: "btn default",
                                
								exportOptions: {
									columns: ':visible',
								},
								customize: function (win) {
									$(win.document.body).find('table').addClass('display').css('font-size', '10px');
									$(win.document.body).find('tr:nth-child(odd) td').each(function(index){
										$(this).css('background-color','#D0D0D0');
									});
									$(win.document.body).find('h1').css('text-align','center');
									$(win.document.body).find('h1').css('font-size','14');
									$(win.document.body).find('h1').css('background-color','#fff');
									$(win.document.body).find('h1').html("<?php echo $printTitle; ?>");
									 $(win.document.body).css('background-color','#fff');
								}

                            }, {

                                extend: "pdf",
                                filename: '<?php echo $printTitle; ?>',
                                orientation: 'landscape',
                                className: "btn default",

							exportOptions: {
								columns: ':visible',
								search: 'applied',
								order: 'applied'
							},customize: function (doc) {
								//Remove the title created by datatTables
								doc.content.splice(0,1);
								//Create a date string that we use in the footer. Format is dd-mm-yyyy
								var now = new Date();														//alert(now.toSource());
								var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear()+' '+now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();							
								// Set page margins [left,top,right,bottom] or [horizontal,vertical]
								// or one number for equal spread
								// It's important to create enough space at the top for a header !!!
								doc.pageMargins = [20,60,20,30];
								// Set the font size fot the entire document
								doc.defaultStyle.fontSize = 7;
								// Set the fontsize for the table header
								doc.styles.tableHeader.fontSize = 7;
								// Create a header object with 3 columns
								// Left side: Logo
								// Middle: brandname
								// Right side: A document title
							doc['header']=(function() {
								return {
									columns: [									
										{
											alignment: 'center',
											fontSize: 14,
											text: '<?php echo $printTitle; ?>'
										}
									],
									margin: 20
								}
							});
							// Create a footer object with 2 columns
							// Left side: report creation date
							// Right side: current page and total pages
							doc['footer']=(function(page, pages) {
								return {
									columns: [
										{
											alignment: 'left',
											text: ['Created on : ', { text: jsDate.toString() }]
										},
										{
											alignment: 'right',
											text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
										}
									],
									margin: 20
								}
							});
							// Change dataTable layout (Table styling)
							// To use predefined layouts uncomment the line below and comment the custom lines below
							// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
							var objLayout = {};
							objLayout['hLineWidth'] = function(i) { return .5; };
							objLayout['vLineWidth'] = function(i) { return .5; };
							objLayout['hLineColor'] = function(i) { return '#aaa'; };
							objLayout['vLineColor'] = function(i) { return '#aaa'; };
							objLayout['paddingLeft'] = function(i) { return 4; };
							objLayout['paddingRight'] = function(i) { return 4; };
							doc.content[0].layout = objLayout;
						}},                                        
						{
							extend: "excel",
							filename: '<?php echo $printTitle; ?>',
							orientation: 'landscape',
							className: "btn default"

						}],

						order: [

							[0, "asc"]

						],

						lengthMenu: [

							[5, 10, 15, 20, -1],

							[5, 10, 15, 20, "All"]

						],

						pageLength: 20,

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
		$("th").css("text-align","center");
		$("th").css("vertical-align","middle");  
		$(".dt-buttons").css("margin-top","-92px !important");
	})
</script>
