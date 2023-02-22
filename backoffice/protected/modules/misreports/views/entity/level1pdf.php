
    <?php  
if(!empty($category)){
  $categorys_arr = Servicecategory::categorywithservices($category); 
}

if(!empty($sc)){
  $sc_arr = Servicecategory::categorywithservices($sc); 
}
?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="7%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="45%" style="border: 1px solid black; text-align: center;"><strong>Business Entity Name</strong> 
       </th>
        <th width="12%" style="border: 1px solid black; text-align: center;"><strong>
          Total Number of Service Availed</strong>
         </th>
      <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Amount Received (BBD$)</strong> 
       </th>                              
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Amount Refunded (BBD$)</strong>
       </th>                               
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Revenue (BBD$)</strong>
       </th>
       
   </tr>
   
    </thead>
   <tbody>
    <?php
$total_amt = 0;
$total_ref = 0;
$total_net = 0;
$total_srn = 0;
$n = 0;



//print_r($records);



if(count($records)>0){
    foreach ($records as $key => $value) {
      if($value['entity_name']!=""){
       
        if(!empty($bustype)){
          if(in_array($value['service_id'], ['2.0','4.0','5.0','8.0','9.0'])){
                    $business_type = [];
                  if($value['service_id']=='2.0'){
                    $business_srn = $value['srn_no'];
                  }else{
                    $business_srn = $value['name_related_srn'];
                  }

                  $namereservationrecord = Yii::app()->db->createCommand("
                    SELECT field_value
                    from bo_new_application_submission as s
                     WHERE submission_id=$business_srn
                    ")->queryRow();
                 
                  if($namereservationrecord){
                    if(@$namereservationrecord['field_value']){
                      $field_val = json_decode($namereservationrecord['field_value'],true);

                      switch (@$field_val['UK-FCL-00044_0']) {
                        case 1:
                          if(isset($field_val['UK-FCL-00049_0'])){
                            if(is_array($field_val['UK-FCL-00049_0'])){
                              if(!empty($field_val['UK-FCL-00049_0'])){
                                $business_type = $field_val['UK-FCL-00049_0'];
                              }
                            }
                          }
                          
                          break;
                        case 2:
                        if(isset($field_val['UK-FCL-00013_0'])){
                            if(is_array($field_val['UK-FCL-00013_0'])){
                              if(!empty($field_val['UK-FCL-00013_0'])){
                                $business_type = $field_val['UK-FCL-00013_0'];
                              }
                            }
                          }                 
                          break;
                        case 3:
                        if(isset($field_val['UK-FCL-00057_0'])){
                            if(is_array($field_val['UK-FCL-00057_0'])){
                              if(!empty($field_val['UK-FCL-00057_0'])){
                                $business_type = $field_val['UK-FCL-00057_0'];
                              }
                            }
                          }                
                          break;
                        default:
                          $business_type = [];
                          break;
                      }           
                    }          
                  }
                  $matchrecord = (bool) array_intersect($business_type, $bustype);
                  if($matchrecord==true){
                    $show= 'Yes';
                  }else{
                    $show='No';
                  }
                }else{
                   $show='No';
                }
        }else{
          $show= 'Yes';
        }

        $services_arr = explode(',', $value['services']);

        if(!empty($sc)){          
          $matchrecord_sc = (bool) array_intersect($sc_arr, $services_arr);
         
          if($matchrecord_sc==true){
            $sc_show = 'Yes';
          }else{
            $sc_show = 'No';
          }
        }else{
           $sc_show = 'Yes';
        }
        
        if(!empty($category)){          
          $matchrecord_dnc = (bool) array_intersect($categorys_arr, $services_arr);
         
          if($matchrecord_dnc==true){
            $cat_show = 'No';
          }else{
            $cat_show = 'Yes';
          }
        }else{
           $cat_show = 'Yes';
        }
        

      if($show=='Yes' && $sc_show=='Yes' && $cat_show=='Yes'){

         $n++;
       ?>
      <tr>
         <td width="7%" style="border: 1px solid black; text-align: center;">
          <?= $n; ?>
         </td>
         <td width="45%" style="border: 1px solid black;">
            <?php echo isset($value['entity_name']) ? $value['entity_name'] : 'NA' ?>
         </td>
     
          <td width="12%" style="border: 1px solid black; text-align: center;"><?= $value['total_services'] ?></td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
           <?php echo round($value['total_amount'],2); ?>
         </td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
             <?php $refund = $value['ref_amt'];
                                   echo   round($refund , 2); ?>
         </td>
       
         <td width="12%" style="border: 1px solid black; text-align: center;">
          <?php
                              $net = $value['total_amount'] -  $refund ;
                                 echo  round($net ,2) ; ?>
         </td>
     </tr>

     <?php
    $total_srn = $total_srn+$value['total_services'];
 $total_amt =  $total_amt+$value['total_amount'];
     $total_ref = $total_ref + $value['ref_amt'];
      $total_net =  $total_net + $net;
}
}
}} ?> 

<tr>
   <td  width="52%" colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td  width="12%" style="border: 1px solid black; text-align: center;">
     <strong><?= $total_srn ?></strong>
   </td>
 
   <td  width="12%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_amt,2) ?></strong>
   </td>
 
   <td  width="12%" style="border: 1px solid black; text-align: center;">
   <strong><?= round($total_ref ,2) ?></strong>
   </td>
   <td  width="12%" style="border: 1px solid black; text-align: center;">
   <strong><?= round($total_net,2) ; ?></strong>
   </td>
</tr>
 </tbody>

             </table>