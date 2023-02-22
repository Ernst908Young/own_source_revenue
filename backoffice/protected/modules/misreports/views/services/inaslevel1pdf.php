

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="20%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="50%" style="border: 1px solid black; text-align: center;"><strong>Service Category</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Total no. of  Entities</strong>
			 </th>
		  
	   </tr>
    </thead>
	<tbody>
		 <?php
           $n=1;$total=0;
           if($category==NULL){
               $show='Yes';
               $category = [];
          }else{
            $show = 'No';
          }
       foreach ($f_arr as $key => $value) {

          if($show=='Yes' || in_array($key, $category)){
         
       ?>
				   
				   
		
		<tr>
			<td width="20%" style="border: 1px solid black;">
				<?= $n ?>
			</td>

			 <td width="50%" style="border: 1px solid black;">
				  <?= $key ?>
			 </td>
			<td width="30%" style="border: 1px solid black;">
			   <?= $value ?>
			 </td>

		 </tr>
	<?php
   $n++;
     $total = $total+$value;
      } } ?> 
	</tbody>
 
</table>

            