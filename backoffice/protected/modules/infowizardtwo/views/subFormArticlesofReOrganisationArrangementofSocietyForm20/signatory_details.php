

<table style=" font-size: 12; border-collapse: collapse; ">
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 12;"><strong> SIGNATORY DETAILS</strong></span>           
      </td>
   </tr>
   <br>
   <tr>
      <td>
         <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
            <tr>
               <th class="latabv"><strong>Full Name</strong></th>
               <th class="latabv"><strong>Designation </strong></th>
               <th class="latabv"><strong>Signature </strong></th>
               <th class="latabv"><strong>Date of Signature </strong></th>
            </tr>
            <?php        
               if(isset($signatoryDetails) && count($signatoryDetails) > 0){
                 foreach ($signatoryDetails as $key => $signDetails) {
                   $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
                   echo '<tr>
                           <td class="latabv">'.$signDetails['first_name'].' '.$signDetails['middle_name'].' '.$signDetails['last_name'].'</td>
                           <td class="latabv">'.$signDetails['designation'].'</td>
                           <td class="latabv">Electronically signed</td>
                           <td class="latabv">'.$signDate.'</td>
                       </tr>';
                 }
               }
               ?>         
         </table>
      </td>
   </tr>
</table>
<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<br><br>
