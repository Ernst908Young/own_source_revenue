

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Entity Name</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Entity Type</strong>
			 </th>
		  <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Reservation Date</strong> 
		   </th>                              
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Dissolved Date</strong>
		   </th>                               
			  
		   
	   </tr>
    </thead>
	<tbody>
			<?php
       $i=1; 
if(count($records)>0){
 
  foreach ($records as $key => $value) {
    if($entity==NULL || in_array($value['service_id'], $entity)){
    ?>
  
               
      <tr>
         <td width="10%" style="border: 1px solid black;text-align: center;">
			<?= $i; ?>
         </td>

        
         <td width="30%" style="border: 1px solid black;text-align: center;">
            <?= $value['latest_entity_name'] ?>
         </td>


           <td width="30%" style="border: 1px solid black;text-align: center;">
           <?php switch ($value['service_id']) {
            case '4.0':
              echo 'Incorporation Of Company';
              break;
             case '5.0':
             echo  'Non Profit Company';
              break;
             case '8.0':
             echo  'External Company';
              break;
             case '9.0':
              echo 'Society';
              break;
            
            default:
              echo $value['service_id'];
              break;
          } ?>
         </td>

         <td width="15%" style="border: 1px solid black;text-align: center;">
           <?= $value['registered_on'] ? date('d-m-Y',strtotime($value['registered_on'])) : "" ?>
         </td>
       
        <td width="15%" style="border: 1px solid black;text-align: center;">
           <?= $value['dissolved_on'] ? date('d-m-Y',strtotime($value['dissolved_on'])) : "" ?>
     
         </td>
     </tr>
<?php  
$i++;
  } }} ?> 

	</tbody>

</table>

            