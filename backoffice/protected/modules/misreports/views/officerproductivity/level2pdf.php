

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Service Name</strong> 
       </th>
       
      <th width="20%" style="border: 1px solid black; text-align: center;"><strong> Total No. of Applications Approved</strong> 
       </th>                              
       <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Total No. of Applications Rejected</strong>
       </th>     
        <th width="20%" style="border: 1px solid black; text-align: center;"><strong>
         Total No. of Applications</strong>
         </th>                              
   </tr>
    </thead>
   <tbody>
	<?php
						 $total_appr = 0;
$total_rej = 0;
$total_apps = 0;
    if($records){
        foreach($records as $key => $value){  
                ?>    
      <tr>
         <td width="10%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ?>
         </td>
         <td width="30%" style="border: 1px solid black; text-align: center;">
            <?= $value['core_service_name'] ?>
         </td>
     
       
         <td width="20%" style="border: 1px solid black; text-align: center;">
            <?= $value['approved'] ?>       
         </td>

         <td width="20%" style="border: 1px solid black; text-align: center;">
           <?= $value['reject'] ?>    
         </td>
       
            <td width="20%" style="border: 1px solid black; text-align: center;">
      <?= (($value['approved']+$value['reject'])) ?>   
      </td>

     </tr>

     <?php   
             $total_appr = $total_appr+ $value['approved']; 
               $total_rej = $total_rej+ $value['reject'];    
                $total_apps = $total_apps+  ($value['approved']+$value['reject']);         
                  }
                }
            ?>
 </tbody>
  <tfoot>
                            
                          
    <tr>
   <td width="40%"  colspan="2" style="border: 1px solid black; text-align: right;">
    <strong>Total</strong>
   </td>
    <td width="20%"  style="border: 1px solid black; text-align: center;">
      <strong><?= $total_appr ?></strong>
   </td>
   <td width="20%"  style="border: 1px solid black; text-align: center;">
      <strong><?=  $total_rej ?></strong>
   </td>

   <td width="20%"  style="border: 1px solid black; text-align: center;">
      <strong><?= $total_apps ?></strong>
   </td>
 </tr>            
</tfoot>   

             </table>