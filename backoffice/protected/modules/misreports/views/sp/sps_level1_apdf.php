

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Individual Name/ Entity</strong> 
       </th>
         <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Current Status</strong> 
       </th> 
	   
	   
         <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Number of Filing</strong> 
       </th> 
	   
        
      
   
       
   </tr>
   
    </thead>
   <tbody>
   <?php 

$sp_s_arr = ['N'=>'Nominated','O'=>'Onboarded','R'=>'Removed','PD'=>'Payment Due','PI'=>'Payment Initiated','NW'=>'Nomination withdrawn'];
$i=1;
 
  foreach ($records as $key => $value) {
//	$service_id = $value['service_id'];
    
 if($status==NULL || in_array($value['sp_status'], $status)){

  $asp_indi_entity = Yii::app()->db->createCommand("SELECT count(a.submission_id) as srn_count
FROM bo_new_application_submission a
where DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND application_status='A' AND agent_user_id=$agent_user_id AND entity_name='".$value['reg_no']."' ")->queryRow();
   ?>
      <tr>
         <td width="10%" style="border: 1px solid black; text-align: center;">
         <?= $i ?>
         </td>
         <td width="30%" style="border: 1px solid black;"> <?= $value['company_name'] ?>           
         </td>
          <td width="30%" style="border: 1px solid black;">    <?php if(array_key_exists($value['sp_status'], $sp_s_arr)){
                
                 echo $sp_s_arr[$value['sp_status']];
                
              }else{
                echo ' No Status';
              } ?>      
         </td>

     
          <td width="20%" style="border: 1px solid black; text-align: center;"><?= $asp_indi_entity['srn_count'] ?> </td>
         

       

        
     </tr>

   <?php
        $i++;
	
    }}
?> 

 </tbody>

             </table>