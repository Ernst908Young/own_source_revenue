<p id="errormsg"></p>
<?php  if(isset($sub_service_name_list) && !empty($sub_service_name_list)){ ?> 
<table class="table table-striped table-responsive">
    <thead>
      <tr>
       <th style="vertical-align:center;text-align: center;">Service ID</th>
       <th style="vertical-align:center;text-align: center;">Sub Service Name</th>
        <th style="vertical-align:center;text-align: center;">CIS</th>
          <th style="vertical-align:center;text-align: center;">Online Offline</th>
          <th style="vertical-align:center;text-align: center;">Infowiz <i class="fa fa-question-circle" title="Service will be shown in HOME PAGE > Know Your Approval > Service Listing"></i></th>
          <th style="vertical-align:center;text-align: center;">CAF-2</th>
          <th style="vertical-align:center;text-align: center;">Inter Departmental Clearances</th>
          <th style="vertical-align:center;text-align: center;"> Sectoral Clearances</th>
          <th style="vertical-align:center;text-align: center;" >DMS</th>
          <th style="vertical-align:center;text-align: center;"> Action </th>
      </tr>
    </thead>
    <tbody >
<?php

           foreach ($sub_service_name_list as  $key=> $value) { ?>
                <?php $serviceID=@$value['service_id'].".".@$value['servicetype_additionalsubservice']; 
                ?>
        <?php if($key==0) { 
            $servicesData=InfowizardQuestionMasterExt::getallsubservicestagmapping($value['service_id']);
            ?>
                        <!--<tr>
                          <form method='POST'   id="tagmappingmodalformservice" class="tagmappingform"/>
                              <?php if (isset($servicesData['id']) && !empty($servicesData['id'])) { ?>
                          <input type="hidden" name="SubserviceTagMapping[id]"  class="tagmappingformservicedata" value='<?php echo @$servicesData['id']; ?>' > <?php }
                              
                          ?><td style='text-align:center'><b><?php echo @$value['service_id']; ?></b></td>
                              <td style='text-align:center'><b><?php echo InfowizardQuestionMasterExt::getMasterName('bo_information_wizard_service_master',$value['service_id'],'service_name','id');  //echo $servicesData['id'];?></b>
                                  <input type="hidden" class="tagmappingformservicedata" name="SubserviceTagMapping[sub_service_id]" value="<?php echo @$value['service_id']; ?>"></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_cis]" value="Y"  <?php if (isset($servicesData['to_be_used_in_cis']) && !empty($servicesData['to_be_used_in_cis']) && $servicesData['to_be_used_in_cis']=='Y') { echo " checked='checked'";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_online_offline]"  value="Y" <?php if (isset($servicesData['to_be_used_in_online_offline']) && !empty($servicesData['to_be_used_in_online_offline']) && $servicesData['to_be_used_in_online_offline']=="Y") {  echo " checked";} ?> ></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_infowiz]"  value="Y" <?php if (isset($servicesData['to_be_used_in_infowiz']) && !empty($servicesData['to_be_used_in_infowiz']) && $servicesData['to_be_used_in_infowiz']=='Y') {  echo " checked";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_caf_2]"  value="Y" <?php if (isset($servicesData['to_be_used_in_caf_2']) && !empty($servicesData['to_be_used_in_caf_2']) && $servicesData['to_be_used_in_caf_2']=='Y') {  echo " checked";} ?> ></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_inter_departmental_clearance]"  value="Y" <?php if (isset($servicesData['to_be_used_in_inter_departmental_clearance']) && !empty($servicesData['to_be_used_in_inter_departmental_clearance']) && $servicesData['to_be_used_in_inter_departmental_clearance']=='Y') { echo " checked";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_sectoral_clearence]"  value="Y" <?php if (isset($servicesData['to_be_used_in_sectoral_clearence']) && !empty($servicesData['to_be_used_in_sectoral_clearence']) && !empty($servicesData['to_be_used_in_sectoral_clearence']=="Y")) {  echo " checked"; } ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingformservicedata" name="SubserviceTagMapping[to_be_used_in_dms]"  value="Y" <?php if (isset($servicesData['to_be_used_in_dms']) && !empty($servicesData['to_be_used_in_dms']) && $servicesData['to_be_used_in_dms']=='Y') {    echo " checked";} ?>></td>
                              <td style='text-align:center'><button type="submit" data-key="servicedata" data-form_id="tagmappingformservicedata" class="submit_page btn btn-success">Save Tags</button></td>
                          </form>

                    </tr>-->
        <?php }
        $servicesData=InfowizardQuestionMasterExt::getallsubservicestagmapping($serviceID);
        ?>
                        <tr>
                          <form method='POST'   id="tagmappingmodalform<?php echo $key; ?>" class="tagmappingform"/>
                              <?php if (isset($servicesData['id']) && !empty($servicesData['id'])) { ?><input type="hidden" name="SubserviceTagMapping[id]" value='<?php echo @$servicesData['id']; ?>' class="tagmappingform<?php echo $key; ?>"> <?php } ?>
                              <td style='text-align:center'><b><?php echo @$serviceID; ?></b></td>                              
                              <td style='text-align:center'><?php echo @$value['core_service_name']; ?> <input type="hidden" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[sub_service_id]" value="<?php echo $serviceID; ?>"></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_cis]" value="Y"  <?php if (isset($servicesData['to_be_used_in_cis']) && !empty($servicesData['to_be_used_in_cis']) && $servicesData['to_be_used_in_cis']=='Y') { echo " checked='checked'";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_online_offline]"  value="Y" <?php if (isset($servicesData['to_be_used_in_online_offline']) && !empty($servicesData['to_be_used_in_online_offline']) && $servicesData['to_be_used_in_online_offline']=="Y") {  echo " checked";} ?> ></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_infowiz]"  value="Y" <?php if (isset($servicesData['to_be_used_in_infowiz']) && !empty($servicesData['to_be_used_in_infowiz']) && $servicesData['to_be_used_in_infowiz']=='Y') {  echo " checked";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_caf_2]"  value="Y" <?php if (isset($servicesData['to_be_used_in_caf_2']) && !empty($servicesData['to_be_used_in_caf_2']) && $servicesData['to_be_used_in_caf_2']=='Y') {  echo " checked";} ?> ></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_inter_departmental_clearance]"  value="Y" <?php if (isset($servicesData['to_be_used_in_inter_departmental_clearance']) && !empty($servicesData['to_be_used_in_inter_departmental_clearance']) && $servicesData['to_be_used_in_inter_departmental_clearance']=='Y') { echo " checked";} ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_sectoral_clearence]"  value="Y" <?php if (isset($servicesData['to_be_used_in_sectoral_clearence']) && !empty($servicesData['to_be_used_in_sectoral_clearence']) && !empty($servicesData['to_be_used_in_sectoral_clearence']=="Y")) {  echo " checked"; } ?>></td>
                              <td style='text-align:center'><input type="checkbox" class="tagmappingform<?php echo $key; ?>" name="SubserviceTagMapping[to_be_used_in_dms]"  value="Y" <?php if (isset($servicesData['to_be_used_in_dms']) && !empty($servicesData['to_be_used_in_dms']) && $servicesData['to_be_used_in_dms']=='Y') {    echo " checked";} ?>></td>
                              <td style='text-align:center'><button type="submit" data-key="<?php echo $key; ?>" data-form_id="tagmappingmodalform<?php echo $key; ?>" class="submit_page btn btn-success">Save Tags</button></td>
                          </form>

                    </tr>

           <?php } ?>
   </tbody>
  </table>
<?php
 }else{ ?>
<p>No sub services are mapped with this service</p>
 <?php
 }
?>
