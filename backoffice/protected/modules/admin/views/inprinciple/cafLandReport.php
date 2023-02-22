 <?php extract($_GET); ?>
<style>.service-rep-item-hd .report-lbl2 {
    font-size: 24px;
    margin: 0;
}
#sample_1 table tr th,td {vertical-align: middle !important;text-align: center !important;}
#sample_1 table  tr td,th{vertical-align: middle !important;text-align: center !important;}
</style>

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

        

    

<section class="panel site-min-height" style="display:">
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'></i>
	CAF Land Report
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
				<th width = "10%" style='vertical-align: middle;text-align: center;'>S.No</th>
				<th width = "10%"style='vertical-align: middle;text-align: center;'>CAF ID</th>
				<th width = "30%"style='vertical-align: middle;text-align: center;'>Unit Name </th>
				<th width = "20%"style='vertical-align: middle;text-align: center;'>Unit Location</th>
				<th width = "20%"style='vertical-align: middle;text-align: center;'>Type of Land</th>
				<th width = "10%"style='vertical-align: middle;text-align: center;'>Area</th>
				<!--<th style='vertical-align: middle;text-align: center;'>Action</th>-->
			</tr>
		</thead>
		<tbody>
		
		<?php foreach($result as $key=>$data){ 
		$datadecoded=json_decode($data['field_value']);
		$datadecoded=(array) $datadecoded;
		?>
		<tr>
				<td style='vertical-align: middle;'><?php echo $key+1; ?></td>
				<td style='vertical-align: middle;'><?php echo $data['submission_id']; ?></td> 
				<td style='vertical-align: middle;'><?php echo @$datadecoded['company_name']; ?></td>
				<td style='vertical-align: middle;'><?php echo @$data['distric_name']; ?></td>
				<td style='vertical-align: middle;'><?php echo @$datadecoded['Proposed_details_of_Land']; ?></td>
				<td style='vertical-align: middle;'><?php echo @$datadecoded['Land_in_Hectares']; ?></td>
				<!--<td style='vertical-align: middle;'><?php echo @$datadecoded['']; ?></td>-->
				</tr>
				<?php } ?>
		</tbody>
	</table>
	</div>
</div>      
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
