  <style>
    a:hover{ 
		color:#000;
	}
    .dt-buttons {
        margin-top: -52px !important;
    }
    #484_0{
		display: none;
	}
    .urlcheckmsg{
		font-size: 14px !important;
		color:#F00;
	}
    #uldiv{
        margin-left: 200px;
		background: beige;
    }
</style>
<div class='portlet box green'>
    <div class="portlet-body">
        <div class="row" style="margin:10px 0 10px 0;">            
        </div>      
        <div class="row" style="margin:10px 0 10px 0;">
            <section class="panel site-min-height" style="display:">
            <header class="panel-heading">
                Department Service Payment
            </header>

            <div class="panel-body">
                <div class="table">
					
                    <table class="table table-bordered" width="100%" id="sample_2">
                        <thead>
                            <tr>
                                <th style="width:5%">S.No</th>	
                                <th style="width:5%">Service ID</th>	
								<th style="width:15%">Department Name</th>	
                                <th style="width:30%">Name of Service</th>
                                <th style="width:15%">Applicable Fee</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php //echo "<pre>"; print_r($servicelist);
							$i=1;
							/* echo "<pre>";
							print_r($_SESSION); */
							foreach($servicelist as $key=>$val){
							?>
								<tr>
									<!--<form action="https://cts.uk.gov.in/E-Chalan/UTK_DEPT/eChallan.aspx" name="sendPayment" method="post">-->
									<form action="/backoffice/infowizardtwo/otherServicePayment/UnifiedPaymentResponse" name="sendPayment" method="post">
										<?php $fee=$val['fee_detail'];?>
										<input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
										<?php $userName = $_SESSION['RESPONSE']['first_name'].' '.@$_SESSION['RESPONSE']['last_name'];?>
										<input type="hidden" name="user_id" value="<?php echo @$_SESSION['RESPONSE']['user_id'];?>" />
										<input type="hidden" name="user_pass" value="<?php echo $userpass;?>" />							
										<input type="hidden" name="int_type" value="S" />							
										<input type="hidden" name="address" value="<?php echo $_SESSION['RESPONSE']['address'];?>" />
										<input type="hidden" name="d_name" value="<?php echo @$userName;?>" />
										<input type="hidden" name="head_desc" value="<?php echo $val['treasury_head_detail'];?>" />
										<input type="hidden" name="total_Amount" value="<?php echo @$fee;?>" />
										<!--<input type="hidden" name="u_no" value="<?php //echo '12398984';?>" />-->
										<input type="hidden" name="u_no" value="<?php echo $uno;?>" />
										<input type="hidden" name="dept_name" value="<?php echo $val['name'];?>" />
										<input type="hidden" name="estr" value="<?php echo @$fee.$val['treasury_head_detail'].@$userName.@$_SESSION['RESPONSE']['user_id'];?>" />
										
										<td style="text-align:center;"><?php echo $i++;?></td>
										<td style="text-align:center;"><?php echo $val['service_id'].'.'.$val['servicetype_additionalsubservice'];?></td>
										<td><?php echo $val['name'];?></td>
										<td><?php echo $val['core_service_name'];?></td>
										<td style="text-align:left;">$<?php echo @$fee;?> BBD</td>
										<td><input type="submit" name="Pay Now" value="Pay Now" class="btn btn-primary"></td>
									</form>
								</tr>								
							<?php } ?>
                        </tbody>
                    </table>                   
                </div>
            </div>
        </section>  
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
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<script>
    $(document).ready(function(){
      $("#abc").keypress(function(){
        var userid = $('#abc').val();

            $.ajax({
                    type: "GET",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/IwApplyService/GetUser",
                    data: {userid: userid},
                    success: function (data) { 
                     // alert(data);
                        $('#uldiv').html(data);
                    }
                });

        
      });
    });
</script>
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
                }/* ,
                buttons: [{
                    extend: "print",
                    className: "btn default"
                },  {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "excel",
                    className: "btn default"
                }] */,
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

  