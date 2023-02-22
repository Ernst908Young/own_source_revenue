

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="7%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="28%" style="border: 1px solid black; text-align: center;"><strong>Representative Name</strong> 
       </th>
         <th width="20%" style="border: 1px solid black; text-align: center;"><strong> Representative Type</strong> 
       </th> 
	   
	   
         <th width="20%" style="border: 1px solid black; text-align: center;"><strong> Entity Name</strong> 
       </th> 
	   
         <th width="28%" style="border: 1px solid black; text-align: center;"><strong> Total Individual Name/Entity</strong> 
       </th>
      
    <!--    <th width="10%" style="border: 1px solid black; text-align: center;"><strong>
          Total Number of Service Availed</strong>
         </th>
      <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Total Amount Received (BBD$)</strong> 
       </th>                              
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Total Amount Refunded (BBD$)</strong>
       </th>                               
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Total Revenue (BBD$)</strong>
       </th> -->
       
   </tr>
   
    </thead>
   <tbody>
    <?php 
		$total_net = 0;
		$total_entity = 0;
		$n = 0;
		if(count($records)>0){
            foreach ($records as $key => $value) {
				$userID = $value['user_id'];
				$n++;

				$asp_indi_entity = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT a.company_id) as in_entity_count
				FROM agent_service_provider a
				where DATE(a.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND (a.email = '".$value['email']."' OR agent_user_id=$userID)")->queryRow();
		?>
      <tr>
         <td width="7%" style="border: 1px solid black; text-align: center;">
          <?= $n; ?>
         </td>
         <td width="28%" style="border: 1px solid black;"><?php echo isset($value['first_name']) ? ($value['first_name'].' '.$value['last_name'].' '.$value['surname']) : 'NA' ?>            
         </td>
          <td width="20%" style="border: 1px solid black;"><?php echo $value['sp_type'] ?>         
         </td>

     
          <td width="20%" style="border: 1px solid black; text-align: center;"><?= $value['entity_name'] ?></td>
          <td width="28%" style="border: 1px solid black; text-align: center;"><?= $asp_indi_entity['in_entity_count'] ?></td>

       

        
     </tr>

    <?php
		} }
	?> 

 </tbody>

             </table>