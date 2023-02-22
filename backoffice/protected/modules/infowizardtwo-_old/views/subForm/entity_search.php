<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Advanced Entity Name Search</h4>
        </div>
		<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
			<table border="1" cellpadding="10" cellspacing="10" class="table table-striped table-bordered" id="sample_1">
				<thead>
					<tr>
						<th>Sr.No.</th>
						<th>Entity Name</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$reservedNameArr = Yii::app()->db->createCommand("SELECT banned_words_id,banned_words_name FROM bo_banned_words WHERE banned_words_type IN('COMPANY_RESERVED','POLTICAL_PARTY','UNIVERSITY_NAME','MINISTRY_DEPARTMENT','ASSOCIATION_NAME','SOCIETY_NAME','BUSINESS_NAME','CHARITY_NAME') AND status='Y'")->queryAll();
				$j=1;
				foreach($reservedNameArr as $k=>$v){
				?>
				<tr>
					<td><?php echo $j++;?></td>
					<td><?php echo $v['banned_words_name'];?></td>
				</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	</div>	
</div>	
<?php
   $base=Yii::app()->theme->baseUrl;
?>
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
   var TableDatatablesButtons = function() {
     var e = function() {
             var e = $("#sample_1");
             e.dataTable({
                 language: {
                    aria: {
                         sortAscending: ": activate to sort column ascending",
                         sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",
                    zeroRecords: "No matching records found"
                 },
                 buttons: [],
                 responsive: !0,
                 order: [
                     [0, "asc"]
                 ],
                 lengthMenu: [
                     [5, 10, 15, 20, -1],
                     [5, 10, 15, 20, "All"]
                 ],
                 pageLength: 10,
                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
             })
         },
         n = function() {            
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
				 buttons: []
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
                     container: e.getTabeWrapper(),
                     place: "prepend"
                 })

             }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {
                 var t = $(this).attr("data-action");
                 e.getDataTable().button(t).trigger()
             })
         };
     return {
         init: function() {
             jQuery().dataTable && (e(), n())
         }
     }
   }();
   jQuery(document).ready(function() {
     TableDatatablesButtons.init();   
   });
</script>