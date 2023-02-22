<?php 
          $status_count = [];  $srn_no_arr=[];
          foreach ($records as $key => $value) {
            $status_res = Servicecategory::appstatus($value['application_status']);
            if(array_key_exists($status_res, $status_count)){
              $status_count[$status_res] = 1+$status_count[$status_res];
            }else{
              $status_count[$status_res] = 1;
            }   

             $srn_no_arr[$value['submission_id']]=$value['submission_id'];  
             
          }?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
<thead>        
   <tr style="font-size: 10;">
     <th width="20%" style="border: 1px solid black; text-align: center;">
      <strong>SR. No.</strong>
     </th>

     <th width="20%" style="border: 1px solid black; text-align: center;">
      <strong>Applicant Name</strong>
     </th>
    
     <th width="20%" style="border: 1px solid black; text-align: center;">
      <strong>SRN. No.</strong>
     </th>

      

     <th width="20%" style="border: 1px solid black; text-align: center;">
      <strong>Service Status</strong>
     </th>
     
        <th width="20%" style="border: 1px solid black; text-align: center;">
      <strong>Amount (BBD$)</strong>
     </th>
   </tr>
   </thead>
   <tbody>
 
    	<?php 
		  
$paid_amt = 0;
$total_amt = 0;
$total_ref = 0;
$total_net = 0; $i=1;
if(count($records)>0){

                            foreach ($records as $key => $value) {
                               if(($srn_no==NULL || in_array($value['submission_id'], $srn_no))){ 
                             ?>
                            <tr nobr="true">
                                <td width="20%" style="border: 1px solid black; text-align: center;">
                                <?= $i ?>
                               </td>
                           
                                <td  width="20%" style="border: 1px solid black; text-align: center;">
                                  <?php echo $value['first_name'].' '.$value['last_name'].' '.$value['surname'].'<br>'.$value['email'] ?> 
                               </td>
                               
                               
                               <td width="20%" style="border: 1px solid black; text-align: center;">
                                   <?php echo $value['submission_id'] ?>
                               </td>
                                <td width="20%" style="border: 1px solid black; text-align: center;">
                                   <?php  
                               $status_res = Servicecategory::appstatus($value['application_status']);
                            echo $status_res;
                                ?> 
                               </td>
                               
                                <td width="20%" style="border: 1px solid black; text-align: center;"><?php echo round($value['total_amount'],2) ;?></td>
                                
                           </tr>

                           <?php
		$paid_amt =  $paid_amt+$value['paid_amt'];
		$total_ref  = $total_ref+$value['ref_amt'];
	 $i++;	
} }
$total_net =  ($paid_amt - $total_ref);
} ?>
    </tbody>
    <tfoot>
<tr>
   <td  width="95%" colspan="10" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td  width="7%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_net,2) ?></strong>
   </td>
</tfoot>
  
</tr> 
                        
             </table>