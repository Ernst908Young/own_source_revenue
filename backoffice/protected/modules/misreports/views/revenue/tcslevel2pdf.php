

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Srn No.</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Payment Date</strong>
			 </th>
		  <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Transaction Id</strong> 
		   </th>                              
		   <th width="25%" style="border: 1px solid black; text-align: center;"><strong>Amount (BBD$)</strong></th>
		     
		   
	   </tr>
    </thead>
	<tbody>
				<?php 
				
$total_amt=0; $i=1;
    foreach ($records as $key => $value) {
       if($subservice_id!=0){
          $newAppSubArr = json_decode($value['field_value'],true);
           if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==$subservice_id){
              $row = true;
           }else{
             $row = false;
           }
       }else{
         $row = true;
       }

       if($row==true){
          if($fee_detail=='late fee' && $value['late_fee']<=0) {
            $row = false;
          }
       }

      if($row==true){  
      if($srn_no==NULL || in_array($value['submission_id'], $srn_no)){    
     ?>
	 
	 <tr>
       <td width="10%" style="border: 1px solid black;text-align: center;">
			<?= $i ?>
       </td>
   
       <td width="15%" style="border: 1px solid black;text-align: center;">
          <?= $value['submission_id'] ?>
       </td>
      
        <td width="30%" style="border: 1px solid black;text-align: center;">
			<?= $value['created_at'] ? date('d-m-Y',strtotime($value['created_at'])) : '' ?>         
       </td>
	   
		<td width="20%" style="border: 1px solid black;text-align: center;">
        <?= $value['transaction_number'] ?>        
       </td>
        <td width="25%" style="border: 1px solid black;text-align: center;">
        <?php if($fee_detail=='late fee'){
          echo $value['late_fee'];
           $total_amt = $total_amt+$value['late_fee'];
        }else{
          echo $value['service_total_fee'];
           $total_amt = $total_amt+$value['service_total_fee'];
        } ?>         
       </td>
  
   </tr>
<?php  $i++; } }} ?>


	</tbody>

</table>

            