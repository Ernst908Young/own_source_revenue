

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
	<tr style="font-size: 10;">
		<th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		</th>
		<th width="10%" style="border: 1px solid black; text-align: center;"><strong>SRN No</strong> 
		</th>
		<th width="30%" style="border: 1px solid black; text-align: center;">
			<strong>Applicant Name</strong>
        </th>
		                            
		<th width="25%" style="border: 1px solid black; text-align: center;"><strong>Business Entity</strong>
		</th>                               
		<th width="25%" style="border: 1px solid black; text-align: center;"><strong>Application Status</strong>
		</th>
	   
       
	</tr>
    </thead>
	<tbody>
	<?php 

		$i=1;
		 foreach ($records as $key => $value) {
			 if(($entity==NULL || in_array((isset($value['company_name'])? $value['company_name'] : 'NA'), $entity))&&($srn_no==NULL || in_array($value['submission_id'], $srn_no))){

	?>
		<tr id="<?php echo $key; ?>">
			<td width="10%" style="border: 1px solid black; text-align: center;">
				<p><?= $key+1 ?></p>
			</td>
	   
			<td width="10%" style="border: 1px solid black; text-align: center;">
				<?php $_SESSION['tll2previousurl'] = $_SERVER['REQUEST_URI']; 
				$sub_id = $value['submission_id'];
				?>
				<p><?php echo $sub_id ?></p>
			</td>
		  
			<td width="30%" style="border: 1px solid black; text-align: center;">
				<?= $value['first_name'].' '.$value['last_name'].' '.$value['surname'] .'<br>'.$value['email']?>
			</td>
			
		   
			<td width="25%" style="border: 1px solid black; text-align: center;">
				<?=  isset($value['company_name'])? $value['company_name'] : 'NA' ?>
			</td>

		
			<td width="25%" style="border: 1px solid black; text-align: center;">
				<?php  
					switch ($value['application_status']) {
					case "I":
						echo "Draft";
						break;
					case "DP":
						echo "Draft";      
						break;

					case "PD":                      
						echo "Payment Due";                
					break; 

					case "P":
						echo "Pending for Approval";
					break;
					case "F":
						  echo "Pending for Approval";
						  break;
					case "FA":
						  echo "Pending for Approval";
						  break; 
					case "AB":
						  echo "Pending for Approval";
						  break; 

					case "A":
						echo "Approved";
						break;                                     
								   
					case "H":
						echo "Reverted";    
						break;  
					
					case "R":
						echo "Rejected";
						break;
					case "W":
						echo "Withdrawn";
						break;  
					default:
						echo "No Status";
				}
				?> 
			</td>
		</tr>

		<?php
			 }
		 } ?>
	</tbody>
</table>