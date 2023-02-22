

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="18%" style="border: 1px solid black; text-align: center;"><strong>Full Name</strong> 
       </th>
        <th width="26%" style="border: 1px solid black; text-align: center;"><strong>
          Address</strong>
         </th>
      <th width="25%" style="border: 1px solid black; text-align: center;"><strong>Email</strong> 
       </th>                              
       <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Mobile Number</strong>
       </th>                               
       <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Type of User</strong>
       </th>
       
       
   </tr>
    </thead>
   <tbody>
    <?php 
     
        foreach ($records as $key => $val) {
         
         ?>

      <tr nobr="true">
         <td width="5%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ?>
         </td>
         <td width="18%" style="border: 1px solid black;"><?= $val['full_name'] ?>
         </td>
     
        
          <td width="26%" style="border: 1px solid black; text-align: center;"><?= $val['address'] ?></td>
          <td width="25%" style="border: 1px solid black; text-align: center;"><?= $val['email'] ?></td>

         <td width="15%" style="border: 1px solid black; text-align: center;">
           <?= $val['mobile_no'] ?>
         </td>
         
          <td width="11%" style="border: 1px solid black; text-align: center;">
           <?= $val['user_type'] ?>
         </td>

       
     </tr>

     <?php 
     
 
   } ?> 

 </tbody>

             </table>

            