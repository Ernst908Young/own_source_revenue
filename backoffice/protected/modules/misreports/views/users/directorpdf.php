

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="20%" style="border: 1px solid black; text-align: center;"><strong>Director's full name</strong> 
       </th>
        <th width="25%" style="border: 1px solid black; text-align: center;"><strong>
          Director's Address</strong>
         </th>
      <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Entity Registration No.</strong> 
       </th>                              
       <th width="24%" style="border: 1px solid black; text-align: center;"><strong>Entity Name</strong>
       </th>                               
        <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Registration Date</strong>
       </th> 
       
       
   </tr>
    </thead>
   <tbody>
    <?php 
        $n=1;
        foreach ($records_main as $key => $val) {
         if($dfn==NULL || in_array($val['name'], $dfn)){
         ?>

      <tr nobr="true">
         <td width="5%" style="border: 1px solid black; text-align: center;">
          <?= $n ?>
         </td>
         <td width="20%" style="border: 1px solid black;"> <?= $val['name'] ?>
         </td>
     
        
          <td width="25%" style="border: 1px solid black; text-align: center;"><?= $val['address'] ?></td>
          <td width="15%" style="border: 1px solid black; text-align: center;"><?= $val['entity_reg_no'] ?></td>

         <td width="24%" style="border: 1px solid black; text-align: center;">
           <?= $val['entity_name'] ?>
         </td>
       <td width="12%" style="border: 1px solid black; text-align: center;">
           <?= $val['reg_date'] ? date('d-m-Y',strtotime($val['reg_date'])) : 'NA' ?>
         </td>

       
     </tr>

     <?php 
     $n++;
     }
 
   } ?> 

 </tbody>

             </table>

            