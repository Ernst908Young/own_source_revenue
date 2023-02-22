

<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">View Public Document</h3>
		<hr>
	</div>
<br>

<form id="vpd-form" action="<?php echo Yii::app()->createUrl('/investor/vpd/vpd'); ?>" method="post" role="form">
<!--  <input type="hidden" name="YII_CSRF_TOKEN" value="<1?php echo Yii::app()->request->csrfToken; ?>"/> -->
	<div class="row mb-2">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-8 form-group" style="margin-bottom: 10px;">
			<?php $checked= $entity_type=='Company' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Company" required="required" <?= $checked ?>>
			 <span> Company </span>
			
			<?php $checked= $entity_type=='Society' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Society" required="required" <?= $checked ?>> <span >Society</span>

			<?php $checked= $entity_type=='Charity' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Charity" required="required" <?= $checked ?>> <span >Charity</span>

			<?php $checked= $entity_type=='LLP' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="LLP" required="required" <?= $checked ?>> <span >LLP</span>

			<?php $checked= $entity_type=='Business Name Registration' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Business Name Registration" required="required" <?= $checked ?>> <span >Business Name Registration</span>
			<br>
				<span style="color:red" id="sp_type_error"></span>
		</div>

	</div>
	<div class="row mb-2">
		<div class="col-md-4">
			Entity name
		</div>
		<div class="col-md-8 form-group">
			<input type="text" name="company_name" value="<?= $company_name ?>" class="form-control">
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-md-4">
			Entity Registration Number
		</div>
		<div class="col-md-8 form-group">
			<input type="text" name="company_reg_no" value="<?= $company_reg_no ?>" class="form-control">
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-md-4">
			Country of Origin
		</div>
		<div class="col-md-8 form-group">
				<?php $checked= $cofo=='barbados' ? 'checked' : ''; ?>
			<input type="radio" name="cofo" id="cofo" value="barbados" <?= $checked ?>>
			  <span> Barbados </span>

				<?php $checked= $cofo=='foreign' ? 'checked' : ''; ?>
			<input type="radio" name="cofo" id="cofo" value="foreign" <?= $checked ?>> 
			  <span>Foreign</span>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-md-4">
			State/Parish
		</div>
		<div class="col-md-8 form-group">
			<?php $spsd = $cofo == 'barbados' ? '' : 'none'; ?>
			<div id="sp_select_div" style="display: <?= $spsd ?>;">
			<?php 
				$state =Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='state' and parent_id=829 and  lr.is_lr_active='Y'")->queryAll();  
			?>
				<select name="state_parish_sel" prompt='Please select' class="form-control" >
					<option value="" selected>Select state</option>
					<?php	 
					
					foreach ($state as $sv){ 
					$select_state = $sv['lr_id'] == $state_parish_sel ? 'selected' : '';
						?>
					<option value="<?= $sv['lr_id'] ?>" <?= $select_state ?>>
						<?= $sv['lr_name'] ?>
					</option>
				<?php	} ?>
				</select>
			</div>
			<?php $isdn = $cofo=='barbados' ? 'none' : ''; ?>
			<div id="sp_text_div" style="display: <?= $isdn ?>;">
				<input type="text" name="state_parish_txt" value="<?= $state_parish_txt ?>" class="form-control">
			</div>
		</div>
	</div>	
	<div class="row mb-2">
		<div class="col-md-4"></div>
		<div class="col-md-8">
			<button type="submit" class="btn btn-secondary" name="vpd-sfsb" id="vpd-sfsb" style="width:auto;margin:0 auto;">Submit</button>	
			<a href="" class="btn btn-secondary">Clear All</a>
		</div>
	</div>
</form>
<br><br>

<?php if($records_search){ ?>
	<?php if($records){ ?>
<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
	<table  id="sample_1" width="100%">
	   <thead> 
		  <tr>
		<th>Sr. No.</th>
		<th>Reg. No.</th>
		<th>Entity Name</th>
		<th>State/Parish</th>		
	</tr>
	   </thead>
		   <tbody class="ticket-item">
		   <?php
		
			foreach($records  as $key => $value) 
			{ 		
									
			?>    
			<tr class="ticket-row tableinside" id="<?php echo $key; ?>">
			  
			  			
			<td><?= $key+1 ?></td>
			<td><a href="/backoffice/investor/vpd/vpd1/service_id/<?= base64_encode($value['service_id']) ?>/reg_no/<?= base64_encode($value['reg_no']) ?>" style="color: blue;"><?= $value['reg_no'] ?></a></td>
			<td><?= $value['company_name'] ?></td>
			<td><?= $value['state_parish'] ?></td>
	
		   </tr>                                    
			<?php   }	?>
		 
	   </tbody> 
	</table>
</div>
<?php  }else{
	?>

	
<script type="text/javascript">
	
	$(document).ready(function(){
    $("#errorpropmt").trigger('click');
});
</script>

<button  id="errorpropmt" style="display: none;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  
</button>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <!--  <div class="modal-header">
     
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
       No documents are available for the selected category
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>



<?php
} } ?>

</div>
<br><br>



<!-- Modal -->



<script type="text/javascript">
	$("input[id='cofo']").change(function() {
		if($("input[id=cofo]").is(':checked')){			
			if($(this).val()=='barbados'){
				$("#sp_select_div").show();
				$("#sp_text_div").hide();
			}else{
				$("#sp_select_div").hide();
				$("#sp_text_div").show();
			}			
		}
	});
</script>

<?php
$base=Yii::app()->theme->baseUrl;
?>
 <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
 <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
      <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script type="text/javascript">
        $(document).ready(function() {
    $('#sample_1').DataTable();
} );
</script> -->

  <script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
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
                        [1, "desc"]
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
    TableDatatablesButtons.init();    
});
</script>