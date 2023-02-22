 
 <?php 
        $status_count = [];
        $main_records = [];$entity_array=[]; $srn_no_arr =[];
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
          $status_res = Servicecategory::appstatus($value['application_status']);
            if(array_key_exists($status_res, $status_count)){
              $status_count[$status_res] = 1+$status_count[$status_res];
            }else{
              $status_count[$status_res] = 1;
            }   


            if($service_id=='2.0'){                                   
                          $formName= '';
                          if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==3)
                                {                                
                                  $getentity = Yii::app()->db->createCommand("SELECT reg_no,company_name FROM bo_company_details WHERE  srn_no=".$value['submission_id'])->queryRow();
                                  $formName = (!empty($getentity) ? $getentity['company_name'] : 'NA');
                                }else{
                                  $formName = 'NA';
                                }
                                
                                $entity_name = $formName;
                             
                        }else{
                          $entity_name = isset($value['entity_name'])? $value['entity_name'] : 'NA';
                        }

                        if(($entity==NULL || in_array($entity_name, $entity)) && ($srn_no==NULL || in_array($value['submission_id'], $srn_no))){
                          $main_records[] = array_merge($value,['entity_name'=>$entity_name]);
                        }

                          

                    $srn_no_arr[$value['submission_id']]=$value['submission_id'];  
                    $entity_array[$entity_name] = $entity_name;  


         }
       }

     
      
	   
	 ?>

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
<thead>        
   <tr style="font-size: 10;" nobr="true">
     <th width="4%" style="border: 1px solid black; text-align: center;">
      <strong>SR. No.</strong>
     </th>

     <th width="23%" style="border: 1px solid black; text-align: center;">
      <strong>Applicant Name</strong>
     </th>
     
     <th width="5%" style="border: 1px solid black; text-align: center;">
      <strong>SRN. No.</strong>
     </th>

      <th width="13%" style="border: 1px solid black; text-align: center;">
        <strong> Business Entity</strong>
     </th>

     <th width="16%" style="border: 1px solid black; text-align: center;">
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

     

     <th width="7%" style="border: 1px solid black; text-align: center;">
      <strong>Amount (BBD$)</strong>
     </th>
       
   </tr>
   </thead>
   <tbody>
     	<?php 
          $paid_amt = 0;
          $total_amt = 0;
          $total_ref = 0;
          $total_net = 0;

                            foreach ($main_records as $key => $value) {
                               
                             ?>
                            <tr nobr="true">
                                <td width="4%" style="border: 1px solid black; text-align: center;">
                                <?= $key+1 ?>
                               </td>
                           
                                <td width="23%" style="border: 1px solid black; text-align: center;">
                                   <?php echo $value['reference_name'].'<br>'.$value['reference_email'] ?> 
                               </td>
                                
                               
                               <td width="5%" style="border: 1px solid black; text-align: center;">
                                  <?php echo $value['submission_id'] ?>
                               </td>
                                <td width="13%" style="border: 1px solid black; text-align: center;">
                                  <?php if($service_id=='2.0'){
                                    
                                           $formName= '';
                                    if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==3)
                                          {
                                          
                                            $getentity = Yii::app()->db->createCommand("SELECT reg_no,company_name FROM bo_company_details WHERE  srn_no=".$value['submission_id'])->queryRow();
                                            $formName = (!empty($getentity) ? $getentity['company_name'] : 'NA');
                                          }else{
                                            $formName = 'NA';
                                          }
                                          
                                          echo $formName;
                                         // echo '<br><b>Entity Name: </b>'.(isset($value['entity_name'])? $value['entity_name'] : 'NA');
                                  }else{
                                    echo  isset($value['entity_name'])? $value['entity_name'] : 'NA';
                                  } ?>
                               </td>
                                <td width="16%" style="border: 1px solid black; text-align: center;">
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

                                <td width="8%" style="border: 1px solid black; text-align: center;"><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></td>

                                <?php 
                                  if($value['payment_mode'] == 1){
                                    $payment_mode = 'Online';
                                  }else if($value['payment_mode'] == 2){
                                    $payment_mode = 'Wallet'; 
                                  }else if($value['payment_mode'] == 3){
                                    $payment_mode = 'Offline'; 
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
                               
                                
                                <td width="7%" style="border: 1px solid black; text-align: center;<?php echo $style?>">
									<?php echo $sign.''.round($value['total_amount'],2) ;?>
								</td>
                           </tr>

                           <?php 
		//$total_amt =  $total_amt+$value['total_amount'];
		$total_amt =  $total_amt+$value['paid_amt'];
		$total_ref  = $total_ref+$value['ref_amt'];
		
   } 
$total_net =  ($total_amt - $total_ref);
   ?> 
    </tbody>
    <tfoot>
<tr>
   <td  width="95%" colspan="10" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td  width="7%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_net ?></strong>
   </td>
</tfoot>
  
</tr> 
                        
             </table>