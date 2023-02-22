

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Director Full Name</strong>
		   </th>
			<th width="50%" style="border: 1px solid black; text-align: center;"><strong>
			 Director Address</strong>
			 </th>
			 
			<th width="10%" style="border: 1px solid black; text-align: center;"><strong>
			 Total Entity</strong>
			 </th>
		  
		   
	   </tr>
    </thead>
	<tbody>
	<?php
		$n=1;
        foreach ($records as $key => $val) {
         if($dfn==NULL || in_array($key, $dfn)){
       ?>
          <tr>
				<td width="10%" style="border: 1px solid black;text-align: center;">
					<?= $n ?>
				</td>
				
				<td width="30%" style="border: 1px solid black;text-align: center;">
					  <?= $key ?>
				</td>
            
				<td width="50%" style="border: 1px solid black;text-align: center;">           
					 <?php 
					foreach ($val as $key => $value) {
						echo $value['address']!="" ? ($value['address'].',<br>') : "";
					} ?>
				</td>
           
           
				<td width="10%" style="border: 1px solid black;text-align: center;">
					<?= count($val) ?>
				</td>
          </tr>
        <?php  $n++; } } ?>

	</tbody>

</table>

            