

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
              <thead>   
   <tr style="font-size: 10;">
     <th width="7%" style="border: 1px solid black; text-align: center;">
            <strong>SR. No.</strong> 
           </th>
             <th width="28%" style="border: 1px solid black; text-align: center;">
            <strong>Service Name</strong>
           </th>
           <th width="18%" style="border: 1px solid black; text-align: center;">
            <strong>Applicant Name</strong>
           </th>           
           <th width="18%" style="border: 1px solid black; text-align: center;">
            <strong>Entity</strong>
           </th>
           <th width="10%" style="border: 1px solid black; text-align: center;">
             <strong>SRN. No.</strong>
           </th>
           <th width="10%" style="border: 1px solid black; text-align: center;">
            <strong>Application Status</strong>
          </th>
           <th width="10%" style="border: 1px solid black; text-align: center;">
            <strong>Created On</strong>
          </th>
  </tr>
   
    </thead>
   <tbody>
    <?php 

    foreach ($records as $key => $value) {
	
		?>
      <tr>
         <td width="7%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ; ?>
         </td>
         <td width="28%" style="border: 1px solid black; text-align: center;">
         <?php if($value['service_id']=='2.0'){
          $newAppSubArr = json_decode($value['field_value'],true);
          if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0'])){
            if($newAppSubArr['UK-FCL-00044_0']==1){
                 echo "Name Reservation-Society (Form 15)";
            }else{
              if($newAppSubArr['UK-FCL-00044_0']==1){
                  echo 'Name Reservation-Company (Form 33)';
              }else{
                if($newAppSubArr['UK-FCL-00044_0']==3){
                    echo 'Business Name Registration (Form 1)';
                }else{
                  echo $value['service_name'];
                }
              }
            }
          }else{
            echo $value['service_name'];
          }
         }else{
         echo $value['service_name'];
         } ?>   
          </td>        
         <td width="18%" style="border: 1px solid black; text-align: center;">
               <?php echo $value['app_name'] ?> 
         </td>

     
          <td width="18%" style="border: 1px solid black; text-align: center;">
             <?php echo isset($value['company_name']) ? $value['company_name'] : 'NA' ?>
          </td>

         <td width="10%" style="border: 1px solid black; text-align: center;">
           <?php echo $value['submission_id'] ?>
         </td>

         <td width="10%" style="border: 1px solid black; text-align: center;">
           <?php  
       switch ($value['application_status']) {
            case "I":
             echo "Draft";
                  break;
            case "DP":
               echo "Draft";      
              break;

             case "PD":                      
              echo "Payment Due";                
              break; 

            case "P":
              echo "Pending for Approval";
              break;
            case "F":
              echo "Pending for Approval";
              break;
            case "FA":
              echo "Pending for Approval";
              break; 
            case "AB":
              echo "Pending for Approval";
              break; 

            case "A":
              echo "Approved";
              break;                                     
                           
            case "H":
              echo "Reverted";    
              break;  
            
            case "R":
              echo "Rejected";
              break;
            case "W":
              echo "Withdrawn";
              break;  
            case "RI":
              echo "Refund Initiated";
              break;  
            case "RS":
              echo "Refund Success";
              break;  
            default:
              echo "No Status";
          }
      ?> 
         </td>
          <td width="10%" style="border: 1px solid black; text-align: center;">
             <?= $value['application_created_date'] ? date('d-m-Y',strtotime($value['application_created_date'])) : '' ?>
          </td>
       
     </tr>

    <?php
    }?> 

 </tbody>

             </table>