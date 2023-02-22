
<?php 
$pdfurl = "/backoffice/misreports/services/inaslevel2pdf?from_date=$from_date&to_date=$to_date&category=".base64_encode($category);


          $n=1;  $total_app = 0;      $main_array = [];          
 if($category=='Name Reservation or Business Name Registration'){
    $next_array = [];

    $records = Yii::app()->db->createCommand("SELECT a.field_value, a.service_id
      FROM bo_new_application_submission a  
      WHERE DATE(a.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND a.service_id='2.0'
   ")->queryAll();

        foreach ($records as $key => $value) {
              

              $newAppSubArr = json_decode($value['field_value'],true);

              if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                  $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['applications'];

                  $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['applications'=>$count+1,'subservice'=>$newAppSubArr['UK-FCL-00044_0'],'service_id'=>$value['service_id']];

                }else{
                                  
                   $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['applications'=>1,'subservice'=>$newAppSubArr['UK-FCL-00044_0'],'service_id'=>$value['service_id']];
                }
              }
              foreach ($next_array as $k => $val) {
                if($k==1){
                  $core_service_name = 'Name Reservation-Society (Form 15)';
                }else{
                  if($k==2){
                    $core_service_name = 'Name Reservation-Company (Form 33)';
                  }else{
                    if($k==3)
                      $core_service_name = "Business Name Registration (Form 1)";
                    else
                      $core_service_name = 'NA';
                  }
                }  
                $main_array[]=array_merge($val,['core_service_name'=>$core_service_name]);
                $sn_arr[$core_service_name]=$core_service_name;
              }
             }else{
                  foreach ($records as $key => $value) {
                    $main_array[]=$value;
                    $sn_arr[$value['core_service_name']]=$value['core_service_name'];
                  }
             }  
              
         
        ?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="20%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="50%" style="border: 1px solid black; text-align: center;"><strong>Service Name</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Total Srn no.</strong>
			 </th>
		  
	   </tr>
    </thead>
	<tbody>
		 <?php 
          $n=1;  $total_app = 0;                


        foreach ($main_array as $key => $value) {     
        if($sn==NULL || in_array($value['core_service_name'], $sn)){      
    $subservice_id=isset($value['subservice_id']) ? $value['subservice_id'] : NULL;
            
              
         ?>
				   
				   
		
		<tr>
			<td width="20%" style="border: 1px solid black;text-align: center;">
				<?= $n ?>
			</td>

			 <td width="50%" style="border: 1px solid black;text-align: center;">
				  <?= $value['core_service_name'] ?>
			 </td>
			<td width="30%" style="border: 1px solid black;text-align: center;">
			    <?= $value['applications'] ?>
			 </td>

		 </tr>
		<?php
		$n++;
		$total_app = $total_app + $value['applications'];
	  
			 }             
	}
	  ?>
	</tbody>
 
</table>

            