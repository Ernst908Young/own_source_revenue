

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Company Type</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Entity Name</strong>
			 </th>
		  <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Srn</strong> 
		   </th>                              
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Date Of  Reservation</strong>
		   </th>                               
			<th width="12%" style="border: 1px solid black; text-align: center;"><strong>Date Of Expiration</strong>
		   </th> 
		   
		   
	   </tr>
    </thead>
	<tbody>
			<?php
           $i=1;
       foreach ($records as $key => $value) {
        $fieldvalue = json_decode($value['field_value'],true);
        if(isset($fieldvalue['UK-FCL-00044_0'])){
          $form_code = $fieldvalue['UK-FCL-00044_0'];
          if($form_code==1 || $form_code==2){
            if(($entity==NULL || in_array($value['banned_words_name'], $entity)) && ($entity_t==NULL || $entity_t==$form_code) && ($srn_no==NULL || in_array($value['submission_id'], $srn_no))){
            $is_used = Yii::app()->db->createCommand('SELECT submission_id       
                              FROM bo_new_application_submission 
                               WHERE 
                           name_related_srn='.$value['submission_id'])->queryRow();
         ?>

               <tr>
                    <td width="10%" style="border: 1px solid black;text-align: center;">
						<?= $i ?>
					</td>

                   <td width="15%" style="border: 1px solid black;text-align: center;">
                      <?= $form_code==1 ? "Society (Form 15)" : "Company (Form 33)" ?>          
                   </td>
				   
                   <td width="30%" style="border: 1px solid black;text-align: center;">
                     <?= $value['banned_words_name'] ?>      
                   </td>
				   
                    <td width="15%" style="border: 1px solid black;text-align: center;">
                     
                        <?= $value['submission_id'] ?>  
                 
                   </td>

                   <td width="15%" style="border: 1px solid black;text-align: center;">
                    <?= $value['created'] ? date('d-m-Y',strtotime($value['created'] )) : "" ?>
                   </td>

                   <td width="12%" style="border: 1px solid black;">
                    <?php 
                    $exp_date = '';
                    if(empty($is_used)){
                         if($value['created']){
                          $cdate = $value['created'];
                            $exp_date = date('d-m-Y',strtotime("$cdate +90 days"));
                            
                         }                         
                    } 
                      echo $exp_date;
                    ?>
                   
                   </td>
                 
                 
               </tr>


     

     <?php
   $i++;
     }}}
      }  ?> 

	</tbody>

</table>

            