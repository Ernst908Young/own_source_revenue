

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Entity Name</strong>
		   </th>
			<th width="20%" style="border: 1px solid black; text-align: center;"><strong>
			 Entity Type</strong>
			 </th>
		  <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Reservation Date</strong> 
		   </th>                              
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Ceased Date</strong>
		   </th>                               
			   
		   
	   </tr>
    </thead>
	<tbody>
			<?php
       
if(count($records)>0){
  foreach ($records as $key => $value) {
		?>
	<tr>
         <td width="15%" style="border: 1px solid black;">
          <?= $key+1; ?>
         </td>

        
         <td width="20%" style="border: 1px solid black;">
            <?= $value['latest_entity_name'] ?>
         </td>


          <td width="20%" style="border: 1px solid black;">
          <?php switch ($value['service_id']) {
            case '2.0':
              'Business';
              break;
            
            default:
              echo '';
              break;
          } ?>
         </td>

         <td width="20%" style="border: 1px solid black;">
           <?= $value['registered_on'] ? date('d-m-Y',strtotime($value['registered_on'])) : "" ?>
         </td>
       
         <td width="15%" style="border: 1px solid black;">
           <?= $value['ceased_on'] ? date('d-m-Y',strtotime($value['ceased_on'])) : "" ?>
     
         </td>
     </tr>
<?php  
  }} ?> 

	</tbody>

</table>

            