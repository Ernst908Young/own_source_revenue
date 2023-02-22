<div id="loading-mask"></div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i style="font-size:24px" class="font-dark"></i>
                    <span class="caption-subject bold uppercase">Investor Detail</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                    <thead>
                        <tr>
                             <th style="background-color: darkcyan; color:#ffffff;">Sl.</th>
                             <th style="background-color: darkcyan; color:#ffffff;">User ID</th>
                             <th style="background-color: darkcyan; color:#ffffff;">FULL NAME</th> 
                             <th style="background-color: darkcyan; color:#ffffff;">EMAIL</th>
                             <th style="background-color: darkcyan; color:#ffffff;">MOBILE</th>
                             <th style="background-color: darkcyan; color:#ffffff;">DEPARTMENT</th>
                             <th style="background-color: darkcyan; color:#ffffff;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      	$sno=1;
                      	if(!empty($model)){
                      		foreach ($model as $key => $detail) {
                      			echo "<tr>
                      				  <td align='center'>".$sno++."</td>
                      				  <td align='center'>".$detail->uid."</td>
                      				  <td align='center'>".$detail->full_name."</td>
                      				  <td align='center'>".$detail->email."</td>
                      				  <td align='center'>".$detail->mobile."</td>
                                 <td align='center'>". ApplicationExt::getDepartmentNameViaID($detail->dept_id)."</td>
                      				  <td><a href='".Yii::app()->createAbsoluteUrl('admin/user/update/id/'.$detail->uid)."'><i class='fa fa-edit'></i></a></td>";
                      				echo "</tr>";
                      		}
                      	}
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
$base=Yii::app()->theme->baseUrl;
?>
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
        };
    return {
        init: function() {
            jQuery().dataTable && (t())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});

</script>