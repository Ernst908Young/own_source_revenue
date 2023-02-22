
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">View Public Document</h3>
		<hr>
		
	</div>
<br>

<form id="vpd-form" action="<?php echo  Yii::app()->createUrl('/site/vpd'); ?>" method="post" role="form">
 <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-6 form-group">
			<?php $checked= $entity_type=='Company' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Company" required="required" <?= $checked ?>>
			 <span style="font-size: 15px;"> Company </span>
			
			<?php $checked= $entity_type=='Society' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Society" required="required" <?= $checked ?>> <span style="font-size: 15px;" >Society</span>

			<?php $checked= $entity_type=='Charity' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Charity" required="required" <?= $checked ?>> <span style="font-size: 15px;" >Charity</span>

			<?php $checked= $entity_type=='LLP' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="LLP" required="required" <?= $checked ?>> <span style="font-size: 15px;" >LLP</span>

			<?php $checked= $entity_type=='Business Name Registration' ? 'checked' : ''; ?>
			<input type="radio" name="entity_type" id="entity_type" value="Business Name Registration" required="required" <?= $checked ?>> <span style="font-size: 15px;" >Business Name Registration</span>
			<br>
				<span style="color:red" id="sp_type_error"></span>
		</div>

	</div>
	<div class="row">
		<div class="col-md-3">
			Entity name
		</div>
		<div class="col-md-6 form-group">
			<input type="text" name="company_name" value="<?= $company_name ?>" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Entity Registration Number
		</div>
		<div class="col-md-6 form-group">
			<input type="text" name="company_reg_no" value="<?= $company_reg_no ?>" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Country of Origin
		</div>
		<div class="col-md-6 form-group">
				<?php $checked= $cofo=='barbados' ? 'checked' : ''; ?>
			<input type="radio" name="cofo" id="cofo" value="barbados" <?= $checked ?>>
			  <span style="font-size: 15px;"> Barbados </span>

				<?php $checked= $cofo=='foreign' ? 'checked' : ''; ?>
			<input type="radio" name="cofo" id="cofo" value="foreign" <?= $checked ?>> 
			  <span style="font-size: 15px;" >Foreign</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			State/Parish
		</div>
		<div class="col-md-6 form-group">
			<?php $spsd = $cofo=='barbados' ? '' : 'none'; ?>
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
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<button type="submit" class="btn btn-secondary" name="vpd-sfsb" id="vpd-sfsb" style="width:auto;margin:0 auto;">Submit</button>	
			<a href="" class="btn btn-secondary">Clear All</a>
		</div>
	</div>
</form>
<br><br>

<?php if($records_search){ ?>
	<?php if($records){ ?>
<table id="sample_1" class="display" style="width:100%">
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
			<td><a href="/sso/site/vpd1/service_id/<?= base64_encode($value['service_id']) ?>/reg_no/<?= base64_encode($value['reg_no']) ?>"><?= $value['reg_no'] ?></a></td>
			<td><?= $value['company_name'] ?></td>
			<td><?= $value['state_parish'] ?></td>
	
		   </tr>                                    
			<?php   }	?>
		 
	   </tbody> 
	</table>
<?php  }else{ 
		//echo '<b style="font-size:16px; color:red;">No documents are available for the selected category</b>';
	?>

	
<script type="text/javascript">
	
	$(document).ready(function(){
    $("#errorpropmt").trigger('click');
});
</script>

<button id="errorpropmt" type="button" style="display: none;" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div style="padding: 25px;">
      		No documents are available for the selected category
      	</div>
      	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
    </div>
  
  </div>
</div>

<?php } } ?>

</div>
<br><br>


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




<script type="text/javascript">
        $(document).ready(function() {
    $('#sample_1').DataTable();
} );
</script>