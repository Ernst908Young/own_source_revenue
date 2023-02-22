 <?php extract($_GET); ?>
<style>.service-rep-item-hd .report-lbl2 {
    font-size: 24px;
    margin: 0;
}
#sample_1 table tr th,td {vertical-align: middle !important;text-align: center !important;}
#sample_1 table  tr td,th{vertical-align: middle !important;text-align: center !important;}
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
                                <p class="report-lbl2">Male Emp.</p>
                                <p class="report-count"><?php echo @$maleEmp?></p>
                            </div>
                        </a>	

                    </div>
                </div>				
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="service-rep-items-cnt">
                        <a href="javascript:void(0)">
                            <div class="service-rep-item-hd">
                                <p class="report-lbl2">Female Emp.</p>
                                <p class="report-count"><?php echo @$femaleEmp; ?></p>
                            </div>
                        </a>	

                    </div>
                </div>				

                <div class="clearfix"></div>
            </div>
        </div>
        
        
     
<!--    <div class="portlet-body">
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
    
</section>-->
    
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
	District Wise Employment Report
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
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'></th>
				<th style='vertical-align: middle;text-align: center;'>Total</th>
			</tr>
		</thead>
		<tbody>
		
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
              className: "btn default"
            }
			,{
				extend: "pdf",
				className: "btn default"
			  }
			  , {
				extend: "excel",
				className: "btn default"
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
    "country": "<?php echo $dcwd['distric_name'] ?>",
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
    "balloonText": "<b>[[category]]: [[value]]</b>",
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
