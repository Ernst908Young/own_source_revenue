<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">Entity Documents Summary</h3>
    </div>
<br>

<table class="table table-bordered">
	<tr>
		<th>Sr. No.</th>	
		<th>Entity Name</th>
		<th>Type of Service Category</th>
		<th>Total documents downloaded</th>
		<th>Last modified</th>
			
	</tr>
	<?php $i = 1;
	foreach($model  as $key => $v){  ?>
			<tr>
				<td>				    			
	    			<?= $key+1 ?>
	    		</td>
	    		<td>
	    			<a href="/backoffice/investor/vpd/documents1/service_id/<?= base64_encode($v['entity_service_id']) ?>/reg_no/<?= base64_encode($v['entity_reg_no']) ?>/grv" style="color: blue;">
	    				<?= $v['company_name'] ?>
	    			</a>
	    			
	    		</td>

	    		<td>
	    			<?= $v['core_service_name'] ?>
	    		 </td>
	    		 <td>
	    		 	<?= $v['downloades_docs'] ?> out of <?= $v['paid_docs'] ?> 
	    		 	
	    		 </td>
	    		<td><?= date('d-m-Y',strtotime($v['created_on'])) ?></td>
	    		
	    	</tr>		    
	<?php   } ?>
</table>
		