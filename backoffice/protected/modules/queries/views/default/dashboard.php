<style>
    .alert-danger{display:none;}
    a:hover{ color:#000;}
    .dt-buttons {
        margin-top: 60px !important;
    }
    #484_0{display: none;}
    .urlcheckmsg{
		font-size: 14px !important;
		color:#F00;
	}
	.dataTables_wrapper .dt-buttons{
		margin-right: 16px;
		margin-top: -64px !important;
	}

	}
</style>
<?php if(Yii::app()->user->hasFlash('success')):?>

    <h2 style="text-align: center; color: green;">

        <?php echo Yii::app()->user->getFlash('success'); ?>

    </h2>

<?php endif; ?>


<div class="site-min-height">
        <div class="dashboard-welcome">
            <h2 class="full-width">
                <div class="dashboard-inner-hd-left">
                    <p class="dashbrd-inner-hd">
                        <!--<a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a>-->
                       Welcome To Digital Corporate Registry System</p>
                </div>
               
                <div class="dashboard-inner-hd-right"><a href="/backoffice/queries/default/index" class="btn btn-primary"> Create New Query</a></div>
                 
                <div class="clearfix"></div>
            </h2>
            <!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;28-Jun-2021</div>-->
            <div class="clearfix"></div>
        </div>
    </div>



<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i> Manage Your Queries
        </div>
        <div class='tools'> </div>
    </div>
    <div class="portlet-body">
        <div class="panel-body">
				<table class="table table-bordered" width="100%" id="sample_2">
					<thead>
						<tr>
							<th style="width:5%;text-align:center;">Query ID</th>
                            <th style="width:5%;text-align:center;">Query Type</th>
							<th style="width:30%;text-align:center;">Service Category</th>
							<th style="width:10%;text-align:center;">Service Name</th>                 
							<!-- <th style="width:10%;text-align:center;">Subject</th> -->
							<th style="width:10%;text-align:center;">Status</th>
                            <th style="width:10%;text-align:center;">Created On</th>
							<th style="width:10%;text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($queries){
							foreach ($queries as $key => $val) { ?>                                        

										<tr id="<?php echo $key; ?>">
											<td style="width:5%;text-align:center;">
												<?php echo $val['querycode'] ?>		
											</td>
                                            <td style="width:5%;text-align:center;">
                                                <?php echo $val['query_type'] ?>     
                                            </td>
											<td style="width:30%;text-align:center;">
												<?php 
                                                   
 echo $val['category_name'] 
                                                ?>	
											</td>
											<td style="width:10%;text-align:center;">
												<?php echo $val['service_name'] ?>	
											</td>                                          
											
											<td style="width:10%;text-align:center;"> 
												<?php echo $val['status']==1?'<span class="label label-success">Open</span>':'<span class="label label-danger">Closed</span>' ?>	
											</td>
                                            <td style="width:10%;text-align:center;"> 
                                                <?php echo date("d, M Y h:i a",strtotime($val['created_on'])) ?>   
                                            </td>												
											<td style="width:10%;text-align:center;">
												<?php $link = Yii::app()->urlManager->createUrl('/queries/default/querydetail/q_id/'.$val['id']); ?>
													<a href="<?php echo $link  ?>" class="btn btn-success">See Detail</a>
											
											
											</td>
										</tr>
							<?php 	}
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
                    className: "btn white btn-outline"
                },  {
                    extend: "pdf",
                    className: "btn white btn-outline"
                }, {
                    extend: "excel",
                    className: "btn white btn-outline"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
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
                        action: function( t, n) {
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});
</script>