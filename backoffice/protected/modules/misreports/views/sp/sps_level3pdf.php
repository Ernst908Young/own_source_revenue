
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
<thead> 

   <tr style="font-size: 10;">
     <th width="4%" style="border: 1px solid black; text-align: center;">
      <strong>SR. No.</strong>
     </th>

     <th width="13%" style="border: 1px solid black; text-align: center;">
      <strong>Applicant Name</strong>
     </th>
    
     <th width="5%" style="border: 1px solid black; text-align: center;">
      <strong>SRN. No.</strong>
     </th>

      <th width="13%" style="border: 1px solid black; text-align: center;">
        <strong>Business Entity</strong>
     </th>

     <th width="6%" style="border: 1px solid black; text-align: center;">
      <strong>Service Status</strong>
     </th>
     <th width="8%" style="border: 1px solid black; text-align: center;">
      <strong>Payment Date</strong>
     </th>


     <th width="8%" style="border: 1px solid black; text-align: center;">
      <strong>Payment Mode</strong>
     </th>

     <th width="16%" style="border: 1px solid black; text-align: center;">
      <strong>Transaction ID</strong>
     </th>

     <th width="13%" style="border: 1px solid black; text-align: center;">
      <strong>Bank Account Name</strong>
     </th>

     <th width="7%" style="border: 1px solid black; text-align: center;">
      <strong>Amount (BBD$)</strong>
     </th>
      <th width="9%" style="border: 1px solid black; text-align: center;">
      <strong>Payment Status</strong>
     </th>
       
   </tr>
   </thead>
   <tbody>
    <?php 
		$paid_amt = 0;
		$total_amt = 0;
		$total_ref = 0;
		$total_net = 0;
			
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
                             ?>
                            <tr>
                                <td width="4%" style="border: 1px solid black; text-align: center;">
                                <?= $key+1 ?>
                               </td>
                           
                                <td width="13%" style="border: 1px solid black; text-align: center;">
                                <?php echo $value['first_name'].' '.$value['last_name'].' '.$value['surname'].'<br>'.$value['email'] ?> 
                               </td>
                               
                               
                               <td width="5%" style="border: 1px solid black; text-align: center;">
                                  <?php echo $value['submission_id'] ?>
                               </td>
                                <td width="13%" style="border: 1px solid black; text-align: center;">
                                  <?php echo isset($value['entity_name']) ? $value['entity_name'] : 'NA' ?>
                               </td>
                                <td width="6%" style="border: 1px solid black; text-align: center;">
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
            case "RI":
              echo "Refund Initiated";
              break;  
            case "RS":
              echo "Refund Success";
              break; 
            default:
              echo "No Status";
          }
                                ?> 
                               </td>

                                <td width="8%" style="border: 1px solid black; text-align: center;"><?php echo $value['created_at'] ? date('d-m-Y',strtotime($value['created_at'])) : ""; ?></td>

                                <?php 
                                if(isset($value['payment_mode'])){
                                  if($value['payment_mode'] == 1){
                                    $payment_mode = 'Online';
                                  }else if($value['payment_mode'] == 2){
                                    $payment_mode = 'Wallet'; 
                                  }else if($value['payment_mode'] == 3){
                                    $payment_mode = 'Offline'; 
                                  }
                                }else{
                                  $payment_mode = '';
                                }
                                  

                                 ?>
								 
								 <?php 
									if($value['is_fee_refunded']==1){
										$style = 'color:blue';
										$sign = '-';
									}
									else {
										$style='';
										$sign='';
									}
								?>

                                <td width="8%" style="border: 1px solid black; text-align: center;"><?php echo $payment_mode;?></td>
                                <td width="16%" style="border: 1px solid black; text-align: center;<?php echo $style?>"><?php echo $value['transaction_number'];?></td>
                                <td width="13%" style="border: 1px solid black; text-align: center;"><?php echo $value['bank_name'];?></td>
                                
                                <td width="7%" style="border: 1px solid black; text-align: center;<?php echo $style?>"><?php echo $sign.''.round($value['total_amount'],2);?></td>
                                 <td width="9%" style="border: 1px solid black; text-align: center;">
                                  <?php echo ucfirst($value['payment_status']) ?>
                                </td>
                           </tr>

                           <?php 
		$paid_amt =  $paid_amt+$value['paid_amt'];
		$total_ref  = $total_ref+$value['ref_amt'];
		}
   } 
$total_net =  $paid_amt - $total_ref;

   ?> 
    </tbody>
    <tfoot>
<tr>
   <td  width="93%" colspan="10" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td  width="9%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_net,2) ?></strong>
   </td>
</tfoot>
  
</tr> 
                        
             </table>