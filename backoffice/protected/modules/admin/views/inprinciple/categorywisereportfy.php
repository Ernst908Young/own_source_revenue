<?php extract($_GET); ?>
<style>.service-rep-item-hd .report-lbl2 {
    font-size: 24px;
    margin: 0;
}
#sample_1 table tr th,td {vertical-align: middle !important;text-align: center ;}
#sample_1 table  tr td,th{vertical-align: middle !important;text-align: center ;}
</style>
<?php $roleArray=array('72','73');if(in_array($_SESSION['role_id'],$roleArray)) { ?>
<div class="page-bar">
	<div class="col-md-8">
	<ul class="page-breadcrumb">
		<li>
		<b><span class="pull-left"><a href="/backoffice/admin" title="Go to Dashboard " class="fa fa-home homeredirect"></a></span> Welcome to State Monitoring Panel - Uttarakhand </b>
		</li>
	</ul>
	</div>
	<div class="col-md-4">
		<span class="pull-right" style="margin-top:5px;"><a href="/backoffice/mis/newReport/OverallNewReport" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
	</div>
</div>
<?php } ?>
<section class="panel site-min-height" style="display:">

    <div class="panel-body">		
        <div class="table">			
            <div class="service-rep-hd">
                <h2>Unit Type : <?php echo ucfirst($unit_type); ?> </h2>
                <h3>Total Applied Under <?php echo ucfirst($unit_type);
echo " : " . @$natureofunitWiseDetail['total']; ?> </h3>
               
            </div>

            <div class="service-rep-items">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="service-rep-items-cnt">
                        <a href="javascript:void(0);">
                            <div class="service-rep-item-hd">
                                <p class="report-lbl2">Manufacturing</p>
                                <p class="report-count"><?php echo @$natureofunitWiseDetail['manufacturing']?></p>
                            </div>
                        </a>	

                    </div>
                </div>				
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="service-rep-items-cnt">
                        <a href="javascript:void(0)">
                            <div class="service-rep-item-hd">
                                <p class="report-lbl2">Service</p>
                                <p class="report-count"><?php echo @$natureofunitWiseDetail['services']?></p>
                            </div>
                        </a>	

                    </div>
                </div>				

                <div class="clearfix"></div>
            </div>
        </div>
        
        
     
    <div class="portlet-body">
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover" id="sample_14">
                    <tr>
                        
                        <th>Pending</th>
                        <th>Inprogress</th>
                        <th>Reverted</th>
                        <th>Approved</th>
                        <th>Rejected</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                       
                        <td><?php echo @$natureofunitWiseDetail['pending'];?></td>
                        <td><?php echo @$natureofunitWiseDetail['inprogress'];?></td>
                        <td><?php echo @$natureofunitWiseDetail['reverted'];?></td>                       
                        <td><?php echo @$natureofunitWiseDetail['approved'];?></td>
                         <td><?php echo @$natureofunitWiseDetail['rejected'];?></td>
                          <td><?php echo @$natureofunitWiseDetail['total'];?></td>
                        
                    </tr>
                </table>
    
</section>
    
<section class="panel site-min-height" style="display:">
    <!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
</style>

<!-- HTML -->
<div id="chartdiv"></div>	
    
    </section>
<section class="panel site-min-height" style="display:">
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'></i>
	  <?php $totalRec =0; echo "Total Applied CAF Under"; ?><?php  echo ucfirst($unit_type)." :"; ?><span id="totalRec"><?php echo count($applicationDetail)?></span>   
    </div>
    <div class='tools'>	
    </div>
    <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; ">
    </div>	
  </div>
  <div class="portlet-body">
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover" id="sample_2">
		<thead>
			<tr>
				<th style='vertical-align: middle;text-align: center;'>SNo</th>
				<th style='vertical-align: middle;text-align: center;'>District</th>
				<th style='vertical-align: middle;text-align: center;'>Nature Of Unit</th>
				<th style='vertical-align: middle;text-align: center;'>CAF Submitted
				<br> By & On 
				</th>
				<th style='vertical-align: middle;text-align: center;'>Investment<br/>(In Cr.)</th>
				<th style='vertical-align: middle;text-align: center;'>NIC Codes</th>
				<th style='vertical-align: middle;text-align: center;'>Overall<br>Status</th>
				<th style='vertical-align: middle;text-align: center;'>Investor<br> Details</th>
				<th style='vertical-align: middle;text-align: center;'>Track</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$count=1;
		$grandTotalInvest = 0;
		$industry_type = '';
//print_r($applicationDetail);die;
		if(isset($applicationDetail) && !empty($applicationDetail)) {
				
			foreach ($applicationDetail as $key => $dept) {
				$detail= json_decode($dept['field_value']);
				$nature = $detail->ntrofunit;
				$natureofType = $detail->ntrofunittype;
				$company_name = $detail->company_name;
				$industry_type = @$detail->industry_type;
				//$nodalTime = InprincipleController::GetTimeTakenInCAF($dept['submission_id']);
                                $nodalTime="";
				$auth_name = $detail->auth_name;
				$auth_designation = $detail->auth_designation;
				$auth_email = $detail->auth_email;
				$auth_mob = $detail->auth_mob;
				
				
                               
				
				
							
				
			$cafindname = ApplicationExt::getIndustryNamefromCAF($dept['submission_id']);
			$url1 = Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id');
			$subID = $dept['submission_id'];
			//if($flag==1 && $flag2==1 && $flag3==1 && $flag4==1 && $flag5 ==1){
				$totalRec = $totalRec + 1;
				$invstmnt_in_total = $detail->invstmnt_in_total;
				$grandTotalInvest = $grandTotalInvest + $invstmnt_in_total[0];
			?>
			<tr>
			<td style="vertical-align: middle; text-align: center;"> 
				<?php echo $count; ?>
			</td>
			<td style="vertical-align: middle; text-align: left !importanmt;" width="1%">
				<?php
					if(!empty($dept['landrigion_id'])) {
						$sql = "SELECT distric_name from bo_district where district_id=$dept[landrigion_id]";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$dname = $command->queryRow();
						echo $dname['distric_name'];
					}
				?>
			</td>
			<td style="vertical-align: middle; text-align: left !importanmt;"><?php echo $nature; ?></br></br><?php if(!empty($natureofType)) { echo "(Unit Type:". ucWords($natureofType).")"; } ?></td>
			<td style="vertical-align: middle; text-align: left !importanmt;" width="18%">
				<?php echo $cafindname ?>
				<hr style="margin:2px;">
				CAF ID:  
				<a target='_balnk' class='hyplink' href=
				   <?php echo $url1 . '/' . $dept['submission_id'] . '/name/CAF' ?>>
				<?php echo $dept['submission_id'] ?> 
				</a>
				<hr style="margin:2px;">
				<?php
					$sql = "SELECT * FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='ISA'";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$flowLogs = $command->queryRow();
					if (!empty($flowLogs)) {
						echo date('d M y H:i:s', strtotime($flowLogs['created_date_time']));
					} else {
						$sql = "SELECT created_date_time FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='F' ORDER BY created_date_time ASC ";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$flowLogs = $command->queryRow();
						if (!empty($flowLogs))
							echo date('d M y H:i:s', strtotime($flowLogs['created_date_time']));
						}
					?>
				</td>
				<td style="vertical-align: middle; text-align: center;"><?php $price = number_format((float)$invstmnt_in_total[0],2); echo '~'.$price;?> </td>
				<td style="vertical-align: middle; text-align: left !importanmt;"> 
					<?php $code = substr($industry_type,0,2);
					$name = InprincipleController::getNicCodeNameBy2DigitCode($code);
					echo $code."-".$name;
					?>
				</td>
				<?php
				$lastFinalAction = date('d M y H:i:s', strtotime($dept['application_updated_date_time']));
				echo
				$appstatus = "";
				if (!empty($dept['application_status'])) {
					$apps = $dept['application_status'];
				}
				 
				if (!empty($pendingAtNodal)) {
					$apps = "P"; // Pending at Nodal
				}
				
				switch ($apps) {
					case "A":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Approved <hr style='margin:2px;'>$lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "B":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Payment ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "P":
					echo "<td style='vertical-align: middle;text-align: center;'> <span> Pending with <br>Nodal Officer </br>(DoI) ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "F":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Forwarded<hr style='margin:2px;'> $lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "Z":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Archived ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "DBD":
					echo "<td style='vertical-align: middle;text-align: center;'> <span> Disposed by<br>Department ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "I":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Incomplete  <hr style='margin:2px;'> $lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "H":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Reverted Back to Investor <hr style='margin:2px;'> $lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "R":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Rejected  <hr style='margin:2px;'> $lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "PAD":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with <br>Department ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					case "PAA":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with Approver(DoI)  <hr style='margin:2px;'> $lastFinalAction ". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
					break;
					default:
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Status Not <br>Available". "<br/><!--<b>Timeline:</b> ".$nodalTime.' Days-->'."</span></td>";
				}
				?>
				<td style="width:5%">
					<?php echo $auth_name; ?>
					<br/>
					Designation: <?php echo $auth_designation; ?>
					<br/>
					Email: <?php echo $auth_email; ?>
					<br/>
					Mobile No.: <?php echo $auth_mob; ?>
				</td>
				<td style="vertical-align: middle; text-align: center;">
				  <a target='_BLANK' href="<?= Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/' . base64_encode($dept['submission_id'])) ?>" class='btn dark btn-sm btn-outline sbold uppercase'>
					<i class='fa fa-share'>	</i> View 
				  </a>
				</td>
								
			</tr>
		<?php
		$count++;
			//} 
		}
		?>
		<tr>
			<td style="visibility:hidden;"><?php echo $count; ?></td>
			<td></td>
			<td></td>			
			<td style="text-align:right;">GrandTotal</td>
			<td style="text-align:center;"><b><?php echo "~".number_format((float)$grandTotalInvest,2); ?></b></td>
			<td></td>
			<td></td>
			<td></td>			
			<td></td>
		</tr>
		<?php
		}else {
			echo "No Record(s) Found.";
		}
		?>
		</tbody>
	</table>
	</div>
</div
        
        
        
    </div>
</section>
<script>
    
    
    
  var TableDatatablesButtons = function () {
    var e = function () {
      var e = $("#sample_1");
      e.dataTable({
        language: {
          aria: {
            sortAscending: ": activate to sort column ascending",
            sortDescending: ": activate to sort column descending"
          }
          ,
          emptyTable: "No data available in table",
          info: "Showing _START_ to _END_ of _TOTAL_ entries",
          infoEmpty: "No entries found",
          infoFiltered: "(filtered1 from _MAX_ total entries)",
          lengthMenu: "_MENU_ entries",
          search: "Search:",
          zeroRecords: "No matching records found"
        }
        ,
        buttons: [{
          extend: "print",
          className: "btn dark btn-outline"
        }, {
			extend: "copy",
			className: "btn red btn-outline"
		  }
		  , {
			extend: "pdf",
			className: "btn green btn-outline"
		  }
		  , {
			extend: "excel",
			className: "btn yellow btn-outline "
		  }
		  , {
			extend: "csv",
			className: "btn purple btn-outline "
		  }
		  , {
			extend: "colvis",
			className: "btn dark btn-outline",
			text: "Columns"
		  }
		],
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
      });
		$("#sample_1_tools > li > a.tool-action").on("click", function () {
			var e = $(this).attr("data-action");
			t.DataTable().button(e).trigger()
		})
    }
	,t = function () {
          var e = $("#sample_2");
          e.dataTable({
            language: {
              aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
              }
              ,
              emptyTable: "No data available in table",
              info: "Showing _START_ to _END_ of _TOTAL_ entries",
              infoEmpty: "No entries found",
              infoFiltered: "(filtered1 from _MAX_ total entries)",
              lengthMenu: "_MENU_ entries",
              search: "Search:",
              zeroRecords: "No matching records found"
            },
			"infoCallback": function( settings, start, end, max, total, pre ) {
				if(start >0 && end > 0 && max >0)
				{	
				 return "Showing "+start +" to "+ (end-1)+" of "+(max-1)+" entries";
				}else{
				 return "Showing 0 to 0 of 0 entries";			
				}	
			},
            buttons: [{
              extend: "print",
              className: "btn white btn-outline"
            }
			,{
				extend: "pdf",
				className: "btn white btn-outline"
			  }
			  , {
				extend: "excel",
				className: "btn white btn-outline"
			  }
			],
            order: [
              [0, "asc"]
            ],
            lengthMenu: [
             [10, 15, 20, -1],
          [10, 15, 20, "All"]
            ],
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
          });
			$("#sample_2_tools > li > a.tool-action").on("click", function () {
				var e = $(this).attr("data-action");
				t.DataTable().button(e).trigger()
			})
        }
		,
        a = function () {
          var e = $("#sample_3"),
              t = e.dataTable({
                language: {
                  aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                  }
                  ,
                  emptyTable: "No data available in table",
                  info: "Showing _START_ to _END_ of _TOTAL_ entries",
                  infoEmpty: "No entries found",
                  infoFiltered: "(filtered1 from _MAX_ total entries)",
                  lengthMenu: "_MENU_ entries",
                  search: "Search:",
                  zeroRecords: "No matching records found"
                }
                ,
                buttons: [{
                  extend: "print",
                  className: "btn dark btn-outline"
                }
                , {
                            extend: "copy",
                            className: "btn red btn-outline"
                          }
                          , {
                            extend: "pdf",
                            className: "btn green btn-outline"
                          }
                          , {
                            extend: "excel",
                            className: "btn yellow btn-outline "
                          }
                          , {
                            extend: "csv",
                            className: "btn purple btn-outline "
                          }
                          , {
                            extend: "colvis",
                            className: "btn dark btn-outline",
                            text: "Columns"
                          }
                         ],
                responsive: !0,
                order: [
                  [0, "asc"]
                ],
                lengthMenu: [
                 [10, 20, 50, 100, 150, -1],
                [10, 20, 50, 100, 150, "All"]
                ],
                pageLength: 10
              });
          $("#sample_3_tools > li > a.tool-action").on("click", function () {
            var e = $(this).attr("data-action");
            t.DataTable().button(e).trigger()
          })
        }
		,
        n = function () {
          $(".date-picker").datepicker({
            rtl: App.isRTL(),
            autoclose: !0
          }
                                      );
          var e = new Datatable;
          e.init({
            src: $("#datatable_ajax"),
            onSuccess: function (e, t) {
            }
            ,
            onError: function (e) {
            }
            ,
            onDataLoad: function (e) {
            }
            ,
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
              }
              ,
              order: [
                [1, "asc"]
              ],
              buttons: [{
                extend: "print",
                className: "btn default"
              }
				, {
				  extend: "copy",
				  className: "btn default"
				}
				, {
				  extend: "pdf",
				  className: "btn default"
				}
				, {
				  extend: "excel",
				  className: "btn default"
				}
				, {
				  extend: "csv",
				  className: "btn default"
				}
				, {
				  text: "Reload",
				  className: "btn default",
				  action: function (e, t, a, n) {
					t.ajax.reload(), alert("Datatable reloaded!")
				  }
				}
			   ]
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
            }
) : 0 === e.getSelectedRowsCount() && App.alert({
              type: "danger",
              icon: "warning",
              message: "No record selected",
              container: e.getTableWrapper(),
              place: "prepend"
            })
          }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
            var t = $(this).attr("data-action");
            e.getDataTable().button(t).trigger()
          }
                                                                                              )
        };
    return {
      init: function () {
        jQuery().dataTable && (e(), t(), a(), n())
      }
    }
  }
  ();
  jQuery(document).ready(function () {
    TableDatatablesButtons.init()
  });
  
  </script>

<!-- Resources -->
  <script src="/backoffice/themes/investuk/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="/backoffice/themes/investuk/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
   


<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [
      
            <?php foreach($districtCategoryWiseDetail as $dcwd){ ?>{
    "country": "<?php echo $dcwd['distric_name'] ?> (<?php echo $dcwd[$unit_type] ?>)",
    "visits": <?php echo $dcwd[$unit_type] ?>,
    "color": "#4185f2"
  },
      
    <?php } ?>            ],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Applications for <?php echo $unit_type; ?> Category"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});
</script>
