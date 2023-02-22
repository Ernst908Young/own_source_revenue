
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">View Public Document <!--?= $service_id ?--></h3>
		<hr>
	</div>
<br>
<span style="color: red;">Select <b>Document Category</b> and <b>Year of Filing</b> to search for a document. Both fields are mandatory.</span>
<br><br>
<?php $url = Yii::app()->createUrl("/investor/vpd/vpd1/service_id/".base64_encode($service_id)."/reg_no/".base64_encode($reg_no)); ?>
<form id="vpd1-form" action="<?php echo  $url; ?>" method="post" role="form">
 <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
	<div class="row mb-2">		
		<div class="col-md-4" style="text-align: right;">Entity Name : </div>
		<div class="col-md-8 form-group">
			<?= $entity_records['company_name'] ?>
		</div>
	</div>
	<div class="row mb-2">		
		<div class="col-md-4" style="text-align: right;">Service Category :</div>
		<div class="col-md-8 form-group">
			<select name="service_category_sel" prompt='Please select' class="form-control" required>
					<option value="" selected disabled>Select category</option>
					<?php	
					$sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();

					
					foreach ($sc_arr as $sv){ 
					$select_ser_cat = $sv['id'] == $service_category_sel ? 'selected' : '';
						?>
					<option value="<?= $sv['id'] ?>" <?= $select_ser_cat ?>>
						<?= $sv['category_name'] ?>
					</option>
				<?php	} ?>
				</select>
		</div>
	</div>
	<div class="row mb-2">		
		<div class="col-md-4" style="text-align: right;">Year of Filing :</div>
		<div class="col-md-8 form-group">
			<select name="year_sel" prompt='Please select' class="form-control" required>
				<option value="" selected disabled>Select year</option>
				<?php	 
				for ($i=2015; $i <= 2030 ; $i++) { 
					 $select_state = $i == $year_sel ? 'selected' : ''; ?>
					 	<option value="<?= $i ?>" <?= $select_state ?>>
							<?= $i ?>
						</option>
				<?php } ?>					
			</select>
		</div>
	</div>
	
	<div class="row">		
		<div class="col-md-4"></div>
		<div class="col-md-8">
			<button type="submit" class="btn btn-secondary" name="vpd-sfsb" id="vpd-sfsb" style="width:auto;margin:0 auto;">Submit</button>	
			<a href="" class="btn btn-secondary">Clear All</a>
			<a href="/backoffice/investor/vpd/vpd" class="btn btn-secondary">Back</a>
		</div>
	</div>
</form>
<br><br>

<?php if($records_search){ ?>
<?php if($submissiondaterecord){ 
	$doc_count = 0;
	foreach($submissiondaterecord as  $v){ 
					if($v['is_certificate']==1){
						$doc_count = $doc_count +1; 
					 }
					 $doc_count = $doc_count +1; 
				}
	?>

<form id="vpd1-form" action="/backoffice/investor/vpd/vpdaddtocart" method="post" role="form">
<!--  <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/> -->
<div class="row">		
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<span><?= $doc_count ?> results found :</span><br>
		<div style="max-height: 500px; overflow: auto;">
		<table class="table table-bordered">
			<tr>
				<th>Sr. No.</th>
				<th>Document Name</th>
				<th>Date of Filing</th>
				<!-- <th><input type="checkbox" id="selectall" name="selectall" value="selectall" /></th> -->
				<th>Select</th>				
			</tr>
			<?php $i = 1;
			foreach($submissiondaterecord  as $key => $value){ 

					if($value['is_certificate']==1){ ?>
						<tr>
							<td><?= $i ?></td>
				    		<td><?= $value['core_service_name'] ?>  Certificate</td>
				    		<td><?= date('d-m-Y',strtotime($value['application_updated_date_time'])) ?></td>
				    		<td>
				    			<input type="hidden" name="reg_no[<?= $i ?>]" value="<?= $reg_no ?>" />
				    				<input type="hidden" name="ser_id[<?= $i ?>]" value="<?= $service_id ?>" />
				    			<input type="hidden" name="srn[<?= $i ?>]" value="<?= $value['submission_id'] ?>" />
				    			<input type="checkbox" class="case" name="sdoc[<?= $i ?>]" value="certificate" /> 
				    		</td>
				    	</tr>	
				 <?php	$i=$i+1; }	?> 
		    	<tr>
		    		<td><?= $i ?></td>
		    		<td><?= $value['core_service_name'] ?> Application Form</td>
		    		<td><?= date('d-m-Y',strtotime($value['application_updated_date_time'])) ?></td>
		    		<td>
		    			<input type="hidden" name="reg_no[<?= $i ?>]" value="<?= $reg_no ?>" />
		    				<input type="hidden" name="ser_id[<?= $i ?>]" value="<?= $service_id ?>" />
		    			<input type="hidden" name="srn[<?= $i ?>]" value="<?= $value['submission_id'] ?>" />
		    			<input type="checkbox" class="case" name="sdoc[<?= $i ?>]" value="app_pdf" /> 
		    		</td>
		    	</tr>	
			<?php $i=$i+1;  } ?>
		</table>
	</div>
		<div style="text-align: center;">
			<button type="submit" class="btn btn-secondary" name="vpd-sfsb" id="vpd-sfsb" style="width:auto;margin:0 auto;">Add this Entity to Cart</button>	
			
			<a href="/backoffice/investor/vpd/cart/tq" class="btn btn-secondary" >View My Cart</a>
		</div>
	</div>
</div>
</form>

<br>


<?php	}else{
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
		 } } 
?>


</div>


<script type="text/javascript" >
    $(document).ready(function() {
      // add multiple select / deselect functionality
        $("#selectall").click(function() {
        	$('.case').attr('checked', this.checked);
         });
     // if all checkbox are selected, check the selectall checkbox  also        

     $(".case").click(function() {
        if ($(".case").length == $(".case:checked").length) {
        $("#selectall").attr("checked", "checked");
         }
        else {
        $("#selectall").removeAttr("checked");
         }     
         });
     });
    </script>