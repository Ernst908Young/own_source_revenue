

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
              <thead>   
   <tr style="font-size: 10;">
     <th width="7%" style="border: 1px solid black; text-align: center;">
            <strong>SR. No.</strong> 
           </th>
             <th width="28%" style="border: 1px solid black; text-align: center;">
            <strong>Sub User Name</strong>
           </th>
           <th width="28%" style="border: 1px solid black; text-align: center;">
            <strong>Individual Entity Name</strong>
           </th>           
           <th width="12%" style="border: 1px solid black; text-align: center;">
            <strong>Current Status</strong>
           </th>
           <th width="12%" style="border: 1px solid black; text-align: center;">
             <strong>Created On</strong>
           </th>
           <th width="12%" style="border: 1px solid black; text-align: center;">
            <strong>Action Date</strong>
          </th>
  </tr>
   
    </thead>
   <tbody>
    <?php 

    foreach ($records as $key => $val) {
	
		?>
      <tr>
         <td width="7%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ; ?>
         </td>
         <td width="28%" style="border: 1px solid black; text-align: center;">
          <?= $val['subuser_name'] ?>    
          </td>        
         <td width="28%" style="border: 1px solid black; text-align: center;">
                  <?= $val['company_name'] ?>
         </td>

     
          <td width="12%" style="border: 1px solid black; text-align: center;">
             <?php 
             switch ($val['sp_status']) {
          case 'N':
            $status = 'Nominated';
            break;
             case 'O':
            $status = 'Onboarded';
            break;
             case 'R':
            $status = 'Removed';
            break;
             case 'DA':
            $status = 'Deactivated';
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

         <td width="12%" style="border: 1px solid black; text-align: center;">
          <?= $val['created_on'] ? date('d-m-Y',strtotime($val['created_on'])) : '' ?>
         </td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
            <?= $val['action_date'] ? date('d-m-Y',strtotime($val['action_date'])) : '' ?>
         </td>
       
     </tr>

    <?php
    }?> 

 </tbody>

             </table>