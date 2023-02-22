<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
	<thead>        
		<tr style="font-size: 10;">
			 <th width="6%" style="border: 1px solid black; text-align: center;">
			  <strong>SR. No.</strong>
			 </th>

			 <th width="12%" style="border: 1px solid black; text-align: center;">
			  <strong>Representative Name</strong>
			 </th>

			 <th width="16%" style="border: 1px solid black; text-align: center;">
			  <strong>Type of Representative</strong>
			 </th>

			  <th width="23%" style="border: 1px solid black; text-align: center;">
				<strong>Entity Name</strong>
			 </th>

			 <th width="23%" style="border: 1px solid black; text-align: center;">
			  <strong>Individual Name/Entity</strong>
			 </th>
			 <th width="10%" style="border: 1px solid black; text-align: center;">
			  <strong>Status</strong>
			 </th>
			 <th width="10%" style="border: 1px solid black; text-align: center;">
			  <strong>Action Date</strong>
			 </th>
		</tr>
   </thead>
   <tbody>
    <?php
		if($records){
			if($sp_type!=''){
        $records_array = [];
          foreach ($records as $key => $value) {

            if($value['agent_user_id']){
              $agent_spdt = Yii::app()->db->createCommand("SELECT u.sp_type FROM sso_users u  WHERE u.user_id=".$value['agent_user_id'])->queryRow();
               $agent_spt = $agent_spdt['sp_type'];
          }else{
            $agent_spt = $value['sp_type'];
          }

            if($agent_spt==$sp_type){
              $records_array[] = $value;
            }
            
          }
      }else{
        $records_array = $records;
      }
			foreach($records_array as $key => $value){ 
				if($value['agent_user_id']){
					$agent_details = Yii::app()->db->createCommand("SELECT u.sp_type, u.entity_type, u.entity_name, p.first_name, p.last_name, p.surname FROM sso_users u INNER JOIN sso_profiles p ON u.user_id=p.user_id WHERE u.user_id=".$value['agent_user_id'])->queryRow();
				}else{
					$agent_details = NULL;
				}
					?>    
                            <tr>
                                <td width="6%" style="border: 1px solid black; text-align: center;">
                                <?= $key+1 ?>
                               </td>
                           
                                <td width="12%" style="border: 1px solid black; text-align: center;">
									<?php echo $agent_details==NULL ? ($value['first_name'].' '.$value['middle_name'].' '.$value['surname']) : ($agent_details['first_name'].' '.$agent_details['last_name'].' '.$agent_details['surname']); ?>
								</td>
                               <td width="16%" style="border: 1px solid black; text-align: center;">
									<?php echo $agent_details==NULL ? ($value['sp_type']) : ($agent_details['sp_type']);  ?>
								</td>
                                <td width="23%" style="border: 1px solid black; text-align: center;">
									<?php echo $agent_details==NULL ? ($value['entity_name']) : ($agent_details['entity_name']); ?>
								</td>
                                

                                <td width="23%" style="border: 1px solid black; text-align: center;">
									<?php echo $value['first_name'].' '.$value['middle_name'].' '.$value['surname']?>
									/
									<?php echo $value['company_id'] ? ($value['company_name']) : 'NA' ?>
								</td>
                                <td width="10%" style="border: 1px solid black; text-align: center;">
									<?php 
										 switch ($value['sp_status']) {
          case 'N':
            $status = 'Nominated';
            break;
             case 'O':
            $status = 'Onboarded';
            break;
             case 'R':
            $status = 'Removed';
            break;
             case 'PD':
            $status = 'Payment Due';
            break;
             case 'PI':
            $status = 'Payment Initiate';
            break;
             case 'NW':
            $status = 'Nomination withdrawn';
            break;
          
          default:
            $status = '';
            break;
        }
					
						echo $status;

									?>
								</td>
								<td width="10%" style="border: 1px solid black; text-align: center;">
									<?= $value['action_date'] ? date('d-m-Y',strtotime($value['action_date'])) : '' ?>
								</td>
                                
                            </tr>

                        <?php } } ?>

                         </tbody>
						  
             </table>