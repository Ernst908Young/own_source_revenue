<?php


$base=Yii::app()->theme->baseUrl;
$sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql_d);
$res_d = $command->queryAll();

if(isset($_GET['id']) && $_GET['id']>0){
	$id=$_GET['id'];
	$display="block";
	
	 $sql_s="SELECT *,sp.service_type as p_service_type,sp.service_id as service_id,sp.servicetype_additionalsubservice  FROM bo_information_wizard_service_master as sm
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
              LEFT JOIN bo_information_wizard_inspection as iwi ON iwi.service_id=sm.id           
			  WHERE issuerby_id='$id' ORDER BY service_name ASC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryAll(); 
}else{
   
	$id='';
	$display="none";
        
}
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<div class="row" style="margin:10px 0 10px 0;">
	<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select Department:</label>
	<div class="col-lg-4">	
	<select name="issuerby_id" class="form-control" onchange="window.location='/backoffice/infowizard/offlineStatus/listing/id/'+this.value">
		<option value="">Select Department</option>
		<?php foreach($res_d as $dep_arr){ ?>
		<option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php if($id == $dep_arr['issuerby_id']){echo 'selected';} ?>><?php echo $dep_arr['name']; ?></option>
		<?php } ?>
	</select>
	</div>
	</div>
<section class="panel site-min-height" style="display:<?php echo $display; ?>">
  <header class="panel-heading">
	  :: Offline Services & Status Listing
  </header>
  
  
  <div class="panel-body" style="background: #fff;">
	
	<table class="table table-bordered" width="100%" id="sample_133" style="background: #fff;">
                            <thead>
                              <tr>
                                <th align="center" style="vertical-align:middle;width:10%" >ID</th>
                                <th align="center" style="vertical-align:middle;width:20%">Service Name</th>
                                <th align="center" style="vertical-align:middle;width:20%" >Type Of Service</th>
                                <th align="center" style="vertical-align:middle;width:20%" >Status Of Service</th>
                                <th align="center" style="vertical-align:middle;width:20%" >Status Available</th>
                                <th align="center" style="vertical-align:middle;width:20%" >Action</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php 
							
							$allArr=array();
							foreach($res_s as $key=>$data_ar){
                                                           $service_id 	= $data_ar['service_id'];
								$sub_service_id = $data_ar['servicetype_additionalsubservice'];
                                                               
                                                                $subServiceID=$service_id.".".$sub_service_id;
                                                                  if(!in_array($subServiceID,$allArr) && $data_ar['is_online']=="N"){
                                                                 $allArr[]=$subServiceID;
                                                                $sql_si="SELECT * FROM bo_information_wizard_inspection WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY id DESC LIMIT 1";
                                                                $connection=Yii::app()->db; 
                                                                $command=$connection->createCommand($sql_si);
                                                                $data_arr = $command->queryRow();
                                                                if(count($data_arr)<=0){
                                                                 $data_arr=false;
                                                                }
							?>
							<!--<form action="/backoffice/frontuser/ServiceMaster/documentCheckList/" method="POST">-->
							<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
							
							<tr>
							<td style="vertical-align:middle;"><?php echo $service_id.".".$sub_service_id; ?></td>
							<td style="vertical-align:middle;"><?php echo $data_ar['core_service_name']; ?></td>
							<td style="vertical-align:middle;"><?php echo $data_ar['p_service_type']; ?></td>
							<td  align="center" style="vertical-align:middle;">Offline</td>
                                                        <td  align="left" style="vertical-align:middle;">
                                                            
                                                           <?php $sql_s="SELECT * from bo_information_wizard_offline_status where service_id=$service_id AND servicetype_additionalsubservice=$sub_service_id";
                                                                 $connection=Yii::app()->db; 
	                                                         $command=$connection->createCommand($sql_s);
	                                                         $offlineStatus = $command->queryAll(); 
                                                                 if(!empty($offlineStatus)){
                                                                   $count=1; foreach($offlineStatus as $os){
                                                                       echo $count.") ".$os['status_name'];?><!--<a href="/backoffice/infowizard/offlineStatus/actAs/toDo/remove/id/<?php echo $os['id'];?>"><i class='fa fa-trash'></i></a>--><br>  
                                                                          <?php      $count++;
                                                                    }                                                                      
                                                                 }
                                                                 
                                                                 ?>
                                                            
                                                            
                                                        </td>
                                                        <td  align="center" style="vertical-align:middle;"><a href="#" surl="/backoffice/infowizard/offlineStatus/addStatus/serviceID/<?php echo $service_id; ?>/subServiceID/<?php echo $sub_service_id; ?>" data-toggle="modal" data-target="#model_div" class="btn btn-success onlineStatus">Add Status</a></td>
							 
                                                         
							</tr>
							</form>
                                                        <?php } } ?>  
							  						
							</tbody></table>
  
  </div>
  
									</section>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="model_div" class="modal abc">
	<div class="modal-header alert alert-success">
	  <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" style="margin-right:50px; float:right;">Close</button>
       
  <h4 class="modal-title" style="color:#000;"><b>Add Offline Status</b></h4>
      </div> 
   <div class="model-content" id="model_content" style="margin:10px;">
<div class="container">

    <form class="form-horizontal" id="offlineStatus" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="status">Status:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="status" placeholder="Enter status" name="status" required>
      </div>
    </div>
 
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>





</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>

<style type="">
.modal{
	width:900px;
	margin-left:-400px;
        height:500px;
}

</style>

<script type="text/javascript">
        $(document).ready(function(){           
            $(".onlineStatus").click(function(){
             var surl=$(this).attr("surl");
            // alert(surl);
             $("#offlineStatus").attr("action",surl);
              // alert($("#offlineStatus").html());
            });            
        });
</script>
