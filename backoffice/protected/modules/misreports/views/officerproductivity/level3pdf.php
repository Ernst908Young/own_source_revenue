<?php $status_arr=array(""=>"","A"=>"Approved","R"=>"Rejected");?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">  
  <thead>   
   <tr style="font-size: 10;">
       <th width="4%" style="border: 1px solid black; text-align: center;">
          <strong>SR. No.</strong>
       </th>
       <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Applicant Name</strong>
       </th>
     <th width="8%" style="border: 1px solid black; text-align: center;">
        <strong>
      Applicant User ID</strong>
     </th>
     <th width="5%" style="border: 1px solid black; text-align: center;">
        <strong>SRN. No.</strong>
     </th>

     <th width="8%" style="border: 1px solid black; text-align: center;">
        <strong>Application Status</strong>
     </th> 


      <th width="12%" style="border: 1px solid black; text-align: center;">
          <strong>Business Entity</strong>
     </th>
  
     <th width="8%" style="border: 1px solid black; text-align: center;">
        <strong>Payment Date</strong>
     </th>


     <th width="7%" style="border: 1px solid black; text-align: center;">
        <strong>Payment Mode</strong>
     </th>

     <th width="16%" style="border: 1px solid black; text-align: center;">
        <strong>Transaction ID</strong>
     </th>

    <th width="12%" style="border: 1px solid black; text-align: center;">
        <strong>Bank Account Name</strong>
     </th>

     <th width="8%" style="border: 1px solid black; text-align: center;">
        <strong>Amount (BBD$)</strong>
     </th>
 </tr>
</thead>
                           <tbody class="ticket-item">

                           	<?php 
                               $paid_amt = 0;
$total_amt = 0;
$total_ref = 0;
$total_net = 0;if(count($records)>0){

   foreach ($records as $key => $value) {    ?>

      <tr>
         <td width="4%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ?>
         </td>
     
          <td width="12%" style="border: 1px solid black; text-align: center;">
           <?php echo $value['first_name'].'<br>'.$value['email'] ?> 
         </td>
          <td width="8%" style="border: 1px solid black; text-align: center;">
           <?= $value['iuid']  ?> 
         </td>
         <td width="5%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['submission_id'] ?>
         </td>

         <td width="8%" style="border: 1px solid black; text-align: center;">
          <?php echo $status_arr[$value['action_status']];?>
         </td> 

          <td width="12%" style="border: 1px solid black; text-align: center;">
            <?php echo isset($value['entity_name']) ? $value['entity_name'] : 'NA' ?>
         </td>
         

          <td width="8%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['created_at'] ?  date('d-m-Y',strtotime($value['created_at'])) : ' '; ?>
          </td>

          <?php 
$payment_mode='';
            if($value['payment_mode'] == 1){
            	$payment_mode = 'Online';
            }else if($value['payment_mode'] == 2){
            	$payment_mode = 'Wallet'; 
            }else if($value['payment_mode'] == 3){
            	$payment_mode = 'Offline'; 
            }

           ?>

          <td width="7%" style="border: 1px solid black; text-align: center;">
            <?php echo $payment_mode;?></td>
          <td width="16%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['transaction_number'];?></td>
          <td width="12%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['bank_name'];?></td>
             <?php 
                  if($value['is_fee_refunded']==1){
                    $style = 'color:blue';
                    $sign = '-';
                     if($value['payment_received_by']>0){
                      $reuser = Yii::app()->db->createCommand("SELECT * FROm bo_user where uid=".$value['payment_received_by'])->queryRow();
                      $crou = $reuser['full_name'].' '.$reuser['middle_name'].' '.$reuser['last_name'].' '.$reuser['email'];
                    }else{
                      $crou = ' NA';
                    }
                  }
                  else {
                    $style='';
                    $sign='';
                        $crou = ' NA';
                  }
                ?>

          <td width="8%" style="border: 1px solid black; text-align: center;">
             <?php echo $sign.''.round($value['total_amount'],2) ;?>
              
            </td>
     </tr>

                        <?php
    $paid_amt =  $paid_amt+$value['paid_amt'];
    $total_ref  = $total_ref+$value['ref_amt'];
    $total_net =  ($paid_amt - $total_ref);
} } ?>
                          </tbody> 
                          <tfoot>
                            
                          
    <tr>
   <td width="92%"  colspan="10"  style="border: 1px solid black; text-align: right;">
    <strong>Total</strong>
   </td>
     <td  width="8%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_net ,2) ?></strong>
   </td>
 </tr>            </tfoot>                        
                      
                    </table>