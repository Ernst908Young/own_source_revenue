
<?php 
                   $main_records = [];
                   foreach($f_record as $k=>$v){ 
                     $comp_detail = Yii::app()->db->createCommand("SELECT cd.*, l.created as registered_on FROM bo_company_details cd
                        INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=cd.srn_no) AND (l.action_status='A')) 
                        WHERE reg_no='".$k."' AND cd.service_id='".$v['service_id']."' ")->queryRow();
                     $entity_name = @$comp_detail['company_name'] ? $comp_detail['company_name'] : "NA" ;

                     $main_records[$k] = array_merge($v, ['entity'=>$entity_name,'address'=>@$comp_detail['address'],'registered_on'=>(@$comp_detail['registered_on'] ? date('d-m-Y',strtotime(@$comp_detail['registered_on'])) : "") ]);

                    $selects = !empty($entity)  ? (in_array($entity_name, $entity) ? 'selected' : '') : '' ;
                    ?>
					<?php } ?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
	   
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Entity Reg.No.</strong>
		   </th>
		   
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Entity Name</strong>
			 </th>
			 
			<th width="20%" style="border: 1px solid black; text-align: center;"><strong>
			 Bussiness Entity Address</strong>
			 </th>
			 
			 <th width="15%" style="border: 1px solid black; text-align: center;"><strong>
			 Date  Of Incorporation</strong>
			 </th>
			 
			 <th width="10%" style="border: 1px solid black; text-align: center;"><strong>
			 Currently Active</strong>
			 </th>
		  
		   
	   </tr>
    </thead>
	<tbody>
			<?php 
           
        $n=1;
        foreach ($main_records as $key => $value) {
          $status = $value['data']=='deactivated' ? 'No' : 'Yes';


          if(($is_active==NULl || $is_active==$status) && ($entity==NULL || in_array($value['entity'], $entity))){
         ?>
		 <tr>
            <td width="10%" style="border: 1px solid black;text-align: center;"> <?= $n ?> </td>
            <td width="15%" style="border: 1px solid black;text-align: center;">  <?= $key ?>   </td>
            <td width="30%" style="border: 1px solid black;text-align: center;">
              <?=
				$value['entity'];
              ?>
            </td>
              <td width="20%" style="border: 1px solid black;text-align: center;">
					<?= $value['address'] ?>
              </td>
              <td width="15%" style="border: 1px solid black;text-align: center;">
					<?= $value['registered_on'] ?>
              </td>
			  <td width="10%" style="border: 1px solid black;text-align: center;">
                <?= $status=='No' ? "<span style='color:red;'>No</span>" : "Yes" ?>
              </td>

       </tr>

 <?php $n++; }} ?>
 

	</tbody>

</table>

            