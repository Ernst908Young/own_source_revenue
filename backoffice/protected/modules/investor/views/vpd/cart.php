<?php  $basePath="/themes/investuk"; ?>
<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">Cart</h3>
    </div>
<br>

<span><?= sizeof($cart_records) ?> results found :</span><br>

<form id="checkout-form" action="/backoffice/investor/vpd/checkout" method="post" role="form">

		<table class="table table-bordered">
			<tr>
				<th>#</th>	
				<th>Entity Name</th>
				<th>Document Name</th>
				<th>Date of Filing</th>
				<th>Document Status</th>
				<th>Sample</th>
				<!-- <th><input type="checkbox" id="selectall" name="selectall" value="selectall" /></th> -->
		    </tr>
			<?php $i = 1;
			foreach($cart_records  as $key => $v){  ?>
					<tr>
						<td>				    			
			    			<input type="checkbox" class="case" name="t_vpd[<?= $v['id'] ?>]" value="<?= $v['id'] ?>" /> 
			    		</td>
			    		<td>
			    			<?= $v['company_name'] ?>
			    		</td>
			    		<td><?= $v['core_service_name'] ?>  
			    			<?php if($v['doc_name']=='certificate'){
			    				echo 'Certificate';
			    			}else{
			    				echo 'Application Form';
			    			}
			    			?>
			    		 </td>
			    		<td><?= date('d-m-Y',strtotime($v['application_updated_date_time'])) ?></td>
			    		<td>
			    			<?php if($v['doc_status']=='C'){
			    				echo 'In Cart';
			    			}else{
			    				echo 'Payment Due';
			    			}
			    			?>
			    			
			    		</td>
			    		<td>
			    			<?php if($v['doc_status']=='PD'){ ?>
			    				 <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/vpd/printofflinefeeform/vpd_id/'. base64_encode($v['id']));?>" title="Offline Payment Form">  
			                          <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png">
			                       
			                      </a>
			    			<?php }
			    			?>
			    			
			    		</td>
			    		
			    	</tr>		    
			<?php   } ?>
		</table>
		<div style="text-align: center;">
			<?php if(sizeof($cart_records) >0 ){?>
			<button type="submit" class="btn btn-secondary" name="vpd-sfsb" id="vpd-sfsb" style="width:auto;margin:0 auto;">Make Payment</button>	
		<?php } ?>
			<a class="btn btn-primary backbtn mx-2" href="javascript:;" onclick="window.history.go(-1);">Back</a> 
		</div>
	</form>