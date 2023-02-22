<?php 
 /*  echo "<pre>";
print_r($resLice);
print_r($_POST);
die; */
?>
<div class="clearfix"></div>
	<div class="fixed-condition-elements">
		<div class="container-fluid">
			
		</div>
	</div>
	<div class="fixed-condition-element1 dashboard-welcome">
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>

	<div style="margin:4px;" class="clearfix"></div>
	<div class="marquee_container">  
   
	</div>
	<div style="margin:4px;" class="clearfix"></div>
	<div class="row">
		<div class="col-md-12">
		   <!-- BEGIN EXAMPLE TABLE PORTLET-->
		   <div class="portlet box green" style="margin-top:4px;">
			  <div class="portlet-title">
				 <div class="caption">
					<i style="font-size:24px" class="icon-list"></i>
					<span class="caption-subject bold uppercase">Licenses (<?php echo '<b class="pendingCountSpan">'.count($resLice).'</b>';  ?>)</span>
				 </div>
				 <div class="tools"> 
					<a href="javascript:;" class="collapse"> </a>
				 </div>
			  </div>
			  <div class="portlet-body">
				<table class='table table-striped table-bordered table-hover order-column' id='sample_1'>
				   <thead>
					   <tr>
						   <th>Sr.No.</th>
						   <th>Service Name</th>
						   <th>Company Name</th>
						   <th>Service Type</th>
						   <th>District</th>
						   <th>Licence Number</th>
						   <th>Last Inspection Date</th>
						   <th>Action</th>
					   </tr>
				   </thead>
				   <tbody>
				   <?php
					if(empty($resLice)){
						echo "<tr><td colspan='8' style='text-align:center;'>No Records Found!</td></tr>";
					}	
				   $i=1; 
					
				   foreach($resLice as $k=>$v) { 
					$service_id = $_POST['service_id'].'.'.$_POST['sub_service_id'];
					$user_id = $_SESSION['RESPONSE']['user_id'];
				    $sqlExistLicence = "SELECT submission_id FROM bo_new_application_submission WHERE service_id = $service_id and user_id = $user_id and application_status IN('H','I','DP','PD') ORDER BY submission_id DESC";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sqlExistLicence);
					$ExistLice = $command->queryRow();
					if(isset($ExistLice) && !empty($ExistLice))
					{
						$stype = "old"; 
					}else{
						$stype = "new"; 
					}	
				   ?>
					<tr>
						<td>
						<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/is/<?php echo $_POST['is']; ?>/type/<?php echo $_POST['type']; ?>/stype/<?php echo $stype;?>" method="GET" id="services_post" target="_blank">
						<!--<input type="hidden" name="is" value='<?php //echo @$_POST['is']; ?>' />
						<input type="hidden" name="type" value='<?php //echo @$_POST['type']; ?>' />-->
						<input type="hidden" name="service_id" value='<?php echo @$_POST['service_id']; ?>' />
						<input type="hidden" name="sub_service_id" value='<?php echo @$_POST['sub_service_id']; ?>' />
						<input type="hidden" name="department_id" value='<?php echo @$_POST['department_id']; ?>' />
						<input type="hidden" name="swcs_department_id" value='<?php echo @$_POST['swcs_department_id']; ?>' />
						<input type="hidden" name="swcs_service_id" value='<?php echo @$_POST['swcs_service_id']; ?>' />
						<input type="hidden" name="new_name" value='<?php echo @$_POST['new_name']; ?>' />
						<input type="hidden" name="caf_id" value='<?php echo @$v['app_id']; ?>' />
						<input type="hidden" name="ptype" value='<?php echo @$_POST['ptype']; ?>' />
											
						<?php echo $i++;?>
						</td>
						<td align='left'><?php echo @$v['core_service_name']; ?></td>
						<td><?php echo @$v['firm_name']; ?></td>
						<td><?php echo @$v['service_type'];?></td>
						<td align='center'><?php echo @$v['distric_name'];?></td>
						<td align='center'><?php echo @$v['licence_number'];?></td>
						<td align='center'><?php echo @$v['last_inspection_date'];?></td>
						<td><button type="submit" class="btn btn-success">Apply Now</button>
						</form>
						</td>
					</tr>
				   <?php 					
				    }
				   ?>
				   </tbody>
				</table> 
			  </div>
		   </div>
		</div>
	</div>	