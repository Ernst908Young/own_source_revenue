<style>
    .errorSummary { clear:red }
</style>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i><?php echo $model->isNewRecord ? 'Create' : 'Update';?> Mapping for Pre-Requisites</div>
        <div class='tools'>	
        </div>
    </div>
    <div class="portlet-body">

        <div class="site-min-height">
            <div class="form form-horizontal" role="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'information-wizard-pre-service-mapping-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => true,
                ));
                ?>

                <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
                <?php echo $form->errorSummary($model); ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model, 'Service ID'); ?><span class="required">*</span></label>
                        <div class="col-md-8">

                            <?php
                            // All Services from Information Wizard 
                           $sql = "SELECT sp.core_service_name,sp.service_id,sp.servicetype_additionalsubservice,im.name   FROM bo_information_wizard_service_master as sm  
							INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id    
                                                        LEFT JOIN bo_infowizard_issuerby_master as im ON im.issuerby_id=sm.issuerby_id 
							WHERE sm.to_be_used_in_construction_permit='Y' ORDER BY sm.service_name ASC";
                            $allData = Yii::app()->db->createCommand($sql)->queryAll();
                            foreach ($allData as $data) {
                                $k = $data['service_id'] . "." . $data['servicetype_additionalsubservice'];
                                $listData[$k] = $data['core_service_name'];
                            }
                           ?>
                            <?php 
                               $sql2 = "SELECT core_service_name,service_id,servicetype_additionalsubservice from bo_information_wizard_service_parameters where core_service_name!=''";
                              
                                $sql2 = "SELECT sp.core_service_name,sp.service_id,sp.servicetype_additionalsubservice,im.name   FROM bo_information_wizard_service_master as sm  
							INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id 
                                                         LEFT JOIN bo_infowizard_issuerby_master as im ON im.issuerby_id=sm.issuerby_id 
							WHERE sm.to_be_used_in_online_offline='Y' ORDER BY sm.service_name ASC";
                               $allData1 = Yii::app()->db->createCommand($sql2)->queryAll();
                            foreach ($allData1 as $data) {
                                $k = $data['service_id'] . "." . $data['servicetype_additionalsubservice'];
                                $listData1[$k] = $data['core_service_name'];
                                $deptData[$k]=$data['name'];
                            }
                            
                            $serviceID=""; if(!empty($model->service_id)) { $serviceID= $model->service_id; }  //print_r($listData1);die;// print_r($options);die;?>
			
                            <select name="InformationWizardPreServiceMapping[service_id]" id="InformationWizardPreServiceMapping_service_id" class="form-control"  required >
                            <?php 
                            if (isset($listData)) {                              
                            foreach ($listData as $k=>$v){                                
                            ?>
                            <option value="<?php echo $k;?>"  <?php if($k==$serviceID){ echo "selected";} ?>> <?php echo $v; ?></option>
                            <?php
                            }
                            }
                            ?>
                            </select>
                    
                            
                            <?php //echo $form->dropDownList($model, 'service_id', $listData, array('class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')); ?>
                            <?php echo $form->error($model, 'service_id'); ?>
                        </div>
                    </div>
                     <div class="form-group col-md-4">
                      <label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model, 'Status'); ?><span class="required">*</span></label>
                        <div class="col-md-8">
                        <?php echo $form->dropDownList($model, 'status', array('Y' => 'Y', 'N' => 'N'), array('class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')); ?>
                        <?php echo $form->error($model, 'status'); // data-toggle="modal" data-target="#myModalDate" ?>
                        </div>
                    </div>
					
					<div class="form-group col-md-2">
					 
      <a href="javascript:void(0)" class="btn btn-info view" style="width:150px;margin:2px;" >
			View Selected</a>  
                    </div>
                </div>
<div class="row"><div class="col-md-1"></div><div class="col-md-10" style="height:300px;overflow-y: scroll">

                   <table class="table table-bordered table-hover table-striped re" >
                            <thead>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>SR NO.</b></td>
                                    <td><b>Department Name</b></td>
                                    <td><b>Service ID</b></td>
                                    <td><b>Service Name</b></td>                                                                  
                                    <td><b>Is Mandatory</b></td>
                                    <td><b>Comment</b></td>
                                </tr>
                                <tr><td colspan="6"><input class="findmember form-control input-lg" placeholder="Search in Services" type="text"></td></tr>
                                <?php $count = 1;
                                $mappedServices = array();
                                $allSelectedService = json_decode($model->pre_service_id);      
                                    if (!empty($allSelectedService)) {
                                        foreach ($allSelectedService as $oa) {                                            
                                            $serviceID = $oa->mapped_service_id;   
                                            $serviceData=explode(".",$serviceID);
                                            $sql="select core_service_name from bo_information_wizard_service_parameters where service_id=$serviceData[0] AND servicetype_additionalsubservice=$serviceData[1]";
		                             $Fields=Yii::app()->db->createCommand($sql)->queryRow();
                                          ?>
                                        <tr class="userlist <?php $d=strtolower($Fields['core_service_name']);echo  $addeddash= str_replace(" ", "-", $d) ?> " name="<?php echo  $Fields['core_service_name']; ?>">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $deptData[$serviceID]; ?></td>
                                        <td class="service<?php echo $serviceID; ?>" ><?php echo $serviceID; ?></td>
                                        <td class="servicename<?php echo $serviceID; ?>" ><input  vv="<?php echo $oa->mapped_service_id; ?>" value="<?php $mappedServices[] = $serviceID; echo $serviceID; ?>" name='mappingdata[<?php echo $count; ?>][mapped_service_id]' id="mapped_service_id<?php echo $serviceID; ?>" type="checkbox" class="Isservicename" checked /> <?php echo $Fields['core_service_name']; ?> </td>
                                        <td class="mandatory<?php echo $serviceID; ?>" >
                                        <select class="form-control" name="mappingdata[<?php echo $count; ?>][is_required]" id="is_required"><option value="N" <?php if(!empty($oa->is_required) && $oa->is_required == "N") { echo " selected"; } ?>>NO</option>  <option value="Y" <?php if(!empty($oa->is_required) && $oa->is_required == "Y") { echo " selected";} ?>>YES</option></select></td>
                                        <td class="commentdd<?php echo $serviceID; ?>" ><input class="form-control" placeholder="Comment" name="mappingdata[<?php echo $count; ?>][service_comment]" type="text" id="service_comment" value="<?php if (!empty($oa->service_comment)) { echo $oa->service_comment;} ?>"></td>
                                        </tr>
                                        <?php
                                        }
                                        }
                                        if (!empty($listData1)) {
                                        foreach ($listData1 as $k=>$v) {
                                        if(!in_array($k,$mappedServices)){
                                        ?>  
                                        <tr class="userlist <?php $d=strtolower($v);echo  $addeddash= str_replace(" ", "-", $d) ?>" name="<?php echo $addeddash; ?>">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $deptData[$k]; ?></td>
                                        <td class="service<?php echo $k; ?>" ><?php echo $k; ?></td>
                                        <td class="servicename<?php echo $k; ?>"><input value="<?php echo $k; ?>" name='mappingdata[<?php echo $count; ?>][mapped_service_id]' id="mapped_service_id<?php echo $k; ?>" class="Isservicename" type="checkbox" vv="<?php echo $v; ?> "/> <?php echo $v; ?> </td>
                                        <td class="mandatory<?php echo $k; ?>" ><select class="form-control" name="mappingdata[<?php echo $count; ?>][is_required]" id="is_required"> <option value="N">NO</option>  <option value="Y">YES</option></select> </td>
                                        <td class="yu"><input class="form-control" placeholder="Comment" name="mappingdata[<?php echo $count; ?>][service_comment]" type="text" id="commentdd<?php echo $k; ?>"></td>
                                        </tr>
                                        <?php } 
                                            }
                                        }
                                        ?>
                                                
                                        </tbody> 
                                </table>  

    </div><div class="col-md-1"></div>
</div>


<div class="row" style="padding-top:20px;">
                    <div class="form-group col-md-6">
                        <div class="col-md-8 buttons"  align="right">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?> 
            </div>
        </div>
    </div>
</div>
	
	
		<!-----//////////////////////////////////////////////////////////////////////////////////////////////------->
		<!-- Modal -->
<div id="myModalDate" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Mapping for Pre-Requisites</b></h4>
      </div>
      <div class="modal-body">
                        <table class="table table-bordered table-hover table-striped re">
                          <thead>
								 <tr>
                                    <th><b>SR NO.</b></th>
                                    <th><b>Service ID</b></th>
                                    <th><b>Service Name</b></th>                                                                  
                                    <th><b>Is Mandatory</b></th>
                                    <th><b>Comment</b></th>
                                </tr>
								</thead>
				  <tbody id="myData" > </tbody>
								</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>

  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------->
	
	
<script>
//service servicename mandatory comment

    $(document).ready(function() {

        $(".view").click(function(){
			  var html="";
			 $("input:checkbox[class=Isservicename]:checked").each(function (e) {
                        // alert("Id: " + $(this).attr("id") + " Value: " + $(this).val());
			var sid=$(this).val();			
			var ss="servicename"+sid;      
			var Issername=$(this).attr("vv");
			 var ismand= $(this).closest('tr').find('td:eq(3)').find('select').val(); 
			  var iscomm= $(this).closest('tr').find('td:eq(4)').find('input').val(); 
			  var sno=(e)+1;
             html=html+"<tr><td>"+sno+"</td><td>"+sid+"</td><td>"+Issername+"</td><td>"+ismand+"</td><td>"+iscomm+"</td></tr>";
         
			//alert($(this).closest('tr').find('td:eq(3)').find('select').val());
        });
        $("#myData").append(html);
		$("#myModalDate").modal('show');
	   });

  $("#myModalDate").on("hidden.bs.modal", function () {
    $('#myData').html('');
});
$(".findmember").keyup(function(){    
var ename=$(this).val().toLowerCase();if(ename.length==0){$(".userlist").show();}else{$(".userlist").hide();}
//$(".re").find("[name="+ename+"]").show();

//var res = ename.replace(" ", "-");
var res = ename.split(' ').join('-');
//alert(res);
var ename1=$(this).val();
$(".re").find("."+res).show();
});
   });

</script>


